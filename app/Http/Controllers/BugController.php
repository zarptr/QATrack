<?php

namespace App\Http\Controllers;

use App\Models\Bug;
use App\Models\Project;
use App\Models\User;
use App\Notifications\BugNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BugController extends Controller
{
    /**
     * Display a listing of the bugs.
     */
    public function index(Request $request)
    {
        $query = Bug::query();
        $user = $request->user();
        if ($user->role === 'support_dev') {
            $query->where('reporter_id', $user->id);
        } elseif ($user->role === 'developer') {
            $query->where('developer', $user->name);
        }

        // Apply filtering if parameters are present
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('developer') && $user->role !== 'developer') {
            $query->where('developer', $request->developer);
        }

        if ($request->filled('project_id')) {
            $query->where('project_id', $request->project_id);
        } elseif ($request->filled('project')) {
            $query->where('project', $request->project);
        }

        // Bug automatically rises to top if priority is high/important (P1 Critical -> P2 High -> P3 Medium), then newest created
        $bugs = $query->orderByRaw("CASE priority WHEN 'p1' THEN 1 WHEN 'p2' THEN 2 WHEN 'p3' THEN 3 ELSE 4 END ASC")
            ->orderBy('created_at', 'desc')
            ->get();

        $developers = User::where('role', 'developer')->orderBy('name')->get();
        $projects = Project::with('creator')->orderBy('name')->get();

        // Priority distribution metrics for the bugs view (Distribution by Priority)
        $priorityStatsQuery = Bug::query();
        if ($user->role === 'support_dev') {
            $priorityStatsQuery->where('reporter_id', $user->id);
        } elseif ($user->role === 'developer') {
            $priorityStatsQuery->where('developer', $user->name);
        }

        $p1Count = (clone $priorityStatsQuery)->where('priority', 'p1')->count();
        $p2Count = (clone $priorityStatsQuery)->where('priority', 'p2')->count();
        $p3Count = (clone $priorityStatsQuery)->where('priority', 'p3')->count();
        $totalPriorityCount = max($p1Count + $p2Count + $p3Count, 1);
        $p1Percent = min(100, round(($p1Count / $totalPriorityCount) * 100));
        $p2Percent = min(100, round(($p2Count / $totalPriorityCount) * 100));
        $p3Percent = min(100, round(($p3Count / $totalPriorityCount) * 100));

        return view('bugs', compact('bugs', 'developers', 'projects', 'p1Count', 'p2Count', 'p3Count', 'p1Percent', 'p2Percent', 'p3Percent'));
    }

    /**
     * Show the form for creating a new bug.
     */
    public function create(Request $request)
    {
        if ($request->user()->role === 'developer') {
            abort(403, 'Developers are not authorized to report bugs.');
        }

        $developers = User::where('role', 'developer')->orderBy('name')->get();
        $projects = Project::with('creator')->orderBy('name')->get();
        $selectedProject = null;

        if ($request->filled('project_id')) {
            $selectedProject = Project::with('creator')->find($request->project_id);
        } elseif ($request->filled('project')) {
            $selectedProject = Project::with('creator')->where('name', $request->project)->first();
        }

        return view('bugs-create', compact('developers', 'projects', 'selectedProject'));
    }

    /**
     * Store a newly created bug in storage.
     */
    public function store(Request $request)
    {
        if ($request->user()->role === 'developer') {
            abort(403, 'Developers are not authorized to report bugs.');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'project_id' => ['nullable', 'exists:projects,id'],
            'project' => ['nullable', 'string', 'max:255'],
            'priority' => ['required', 'string', 'in:p1,p2,p3'],
            'status' => ['required', 'string', 'in:new,in_progress,done_by_development,done_by_support_qa,open,fixed,retest,closed,resolved'],
            'developer' => ['nullable', 'string'],
            'description' => ['required', 'string'],
            'attachment' => ['nullable', 'file', 'max:5120'],
        ]);

        // Auto-group into project folder directly by the system
        if (! empty($validated['project_id'])) {
            $projectObj = Project::find($validated['project_id']);
            if ($projectObj) {
                $validated['project'] = $projectObj->name;
            }
        } elseif (! empty($validated['project'])) {
            $projectObj = Project::firstOrCreate(
                [
                    'name' => trim($validated['project']),
                    'created_by' => $request->user()->id,
                ],
                [
                    'description' => 'Folder project untuk '.trim($validated['project']),
                ]
            );
            $validated['project_id'] = $projectObj->id;
            $validated['project'] = $projectObj->name;
        } else {
            // Default project folder managed directly by the system
            $projectObj = Project::first() ?? Project::create([
                'name' => 'General System',
                'description' => 'Folder project sistem untuk tiket umum',
                'created_by' => $request->user()->id,
            ]);
            $validated['project_id'] = $projectObj->id;
            $validated['project'] = $projectObj->name;
        }

        $validated['reporter_id'] = $request->user()->id;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $validated['attachment'] = $file->store('attachments', 'public');
            $validated['attachment_name'] = $file->getClientOriginalName();
            $validated['attachment_size'] = $file->getSize();
        }

        $bug = Bug::create($validated);
        $projectLabel = $bug->project ? "[{$bug->project}] " : '';

        // Notify Super Admins
        $superAdmins = User::where('role', 'super_admin')->where('id', '!=', $request->user()->id)->get();
        foreach ($superAdmins as $admin) {
            $admin->notify(new BugNotification(
                title: 'Bug Baru Dilaporkan',
                message: "{$request->user()->name} melaporkan bug #{$bug->id}: {$projectLabel}'{$bug->title}' (Prioritas: ".strtoupper($bug->priority).')',
                type: 'bug_created',
                bugId: $bug->id,
                icon: 'bug_report',
                badgeColor: $bug->priority === 'p1' ? 'error' : 'primary'
            ));
        }

        // If developer is assigned, notify the assigned developer
        if (! empty($bug->developer)) {
            $assignedDev = User::where('name', $bug->developer)->first();
            if ($assignedDev && $assignedDev->id !== $request->user()->id) {
                $assignedDev->notify(new BugNotification(
                    title: 'Penugasan Bug Baru',
                    message: "Anda telah ditugaskan untuk menangani bug #{$bug->id}: '{$bug->title}'",
                    type: 'assigned',
                    bugId: $bug->id,
                    icon: 'person_add',
                    badgeColor: 'primary'
                ));
            }
        }

        // If priority is P1 (Critical), notify all other developers as urgent alert
        if ($bug->priority === 'p1') {
            $otherDevs = User::where('role', 'developer')
                ->when(! empty($bug->developer), fn ($q) => $q->where('name', '!=', $bug->developer))
                ->where('id', '!=', $request->user()->id)
                ->get();
            foreach ($otherDevs as $dev) {
                $dev->notify(new BugNotification(
                    title: 'Alert Bug Kritis (P1)',
                    message: "Bug prioritas tinggi dilaporkan: '{$bug->title}'. Memerlukan perhatian tim.",
                    type: 'critical',
                    bugId: $bug->id,
                    icon: 'warning',
                    badgeColor: 'error'
                ));
            }
        }

        if ($request->boolean('from_project') && $bug->project_id) {
            return redirect()->route('projects.show', $bug->project_id)->with('success', 'Bug reported successfully.');
        }

        return redirect()->route('bugs')->with('success', 'Bug reported successfully.');
    }

    /**
     * Display the specified bug.
     */
    public function show(Request $request, Bug $bug)
    {
        $user = $request->user();
        if ($user->role === 'developer' && $bug->developer !== $user->name) {
            abort(403, 'Unauthorized.');
        }

        $developers = User::where('role', 'developer')->orderBy('name')->get();

        return view('bugs-show', compact('bug', 'developers'));
    }

    /**
     * Update the status of a bug.
     */
    public function updateStatus(Request $request, Bug $bug)
    {
        $user = $request->user();
        if ($user->role === 'developer' && $bug->developer !== $user->name) {
            abort(403, 'Unauthorized.');
        }

        $validated = $request->validate([
            'status' => ['required', 'string', 'in:new,in_progress,done_by_development,done_by_support_qa,open,fixed,retest,closed'],
            'developer' => ['nullable', 'string'],
            'priority' => ['nullable', 'string', 'in:p1,p2,p3'],
        ]);

        if ($user->role === 'developer') {
            if (! in_array($validated['status'], ['new', 'open', 'in_progress', 'done_by_development', 'fixed'])) {
                return redirect()->back()->withErrors(['status' => 'Developer is not allowed to set this status.']);
            }
            unset($validated['developer']);
            unset($validated['priority']);
        }

        $oldStatus = $bug->status;
        $oldDeveloper = $bug->developer;
        $oldPriority = $bug->priority;

        $bug->update($validated);

        // Check if priority changed by QA or Admin
        if (! empty($validated['priority']) && $oldPriority !== $bug->priority) {
            $priorityLabels = ['p1' => 'P1 (Critical)', 'p2' => 'P2 (High)', 'p3' => 'P3 (Medium/Low)'];
            $newPriorityLabel = $priorityLabels[$bug->priority] ?? strtoupper($bug->priority);

            if (! empty($bug->developer)) {
                $assignedDev = User::where('name', $bug->developer)->first();
                if ($assignedDev && $assignedDev->id !== $user->id) {
                    $assignedDev->notify(new BugNotification(
                        title: 'Prioritas Bug Diperbarui',
                        message: "{$user->name} mengubah prioritas bug #{$bug->id} ('{$bug->title}') menjadi {$newPriorityLabel}.",
                        type: $bug->priority === 'p1' ? 'critical' : 'status_updated',
                        bugId: $bug->id,
                        icon: 'priority_high',
                        badgeColor: $bug->priority === 'p1' ? 'error' : 'primary'
                    ));
                }
            }

            if ($bug->priority === 'p1') {
                $otherDevs = User::where('role', 'developer')
                    ->when(! empty($bug->developer), fn ($q) => $q->where('name', '!=', $bug->developer))
                    ->where('id', '!=', $user->id)
                    ->get();
                foreach ($otherDevs as $dev) {
                    $dev->notify(new BugNotification(
                        title: 'Alert Bug Eskalasi ke P1 Kritis',
                        message: "Bug #{$bug->id} ('{$bug->title}') dinaikkan ke prioritas P1 Critical oleh {$user->name}.",
                        type: 'critical',
                        bugId: $bug->id,
                        icon: 'warning',
                        badgeColor: 'error'
                    ));
                }
            }
        }

        // Check if developer assignment changed
        $newDeveloper = $bug->developer;
        if ($newDeveloper && $newDeveloper !== $oldDeveloper) {
            $assignedDev = User::where('name', $newDeveloper)->first();
            if ($assignedDev && $assignedDev->id !== $user->id) {
                $assignedDev->notify(new BugNotification(
                    title: 'Bug Ditugaskan Kepada Anda',
                    message: "{$user->name} menugaskan Anda ke bug #{$bug->id}: '{$bug->title}'",
                    type: 'assigned',
                    bugId: $bug->id,
                    icon: 'person_add',
                    badgeColor: 'primary'
                ));
            }
        }

        // Check if status changed
        if ($oldStatus !== $bug->status) {
            $statusLabels = [
                'open' => 'Open',
                'new' => 'New',
                'in_progress' => 'In Progress',
                'fixed' => 'Fixed',
                'retest' => 'Retest',
                'closed' => 'Closed',
                'done_by_development' => 'Done by Development',
                'done_by_support_qa' => 'Done by Support/QA',
            ];
            $statusLabel = $statusLabels[$bug->status] ?? ucfirst($bug->status);

            // 1. Notify reporter (support_dev) if someone else updated it
            if ($bug->reporter_id && $bug->reporter_id !== $user->id) {
                $reporter = User::find($bug->reporter_id);
                if ($reporter) {
                    $reporter->notify(new BugNotification(
                        title: 'Status Bug Diperbarui',
                        message: "{$user->name} memperbarui status bug #{$bug->id} ('{$bug->title}') menjadi '{$statusLabel}'.",
                        type: 'status_updated',
                        bugId: $bug->id,
                        icon: in_array($bug->status, ['fixed', 'closed']) ? 'check_circle' : 'sync',
                        badgeColor: in_array($bug->status, ['fixed', 'closed']) ? 'emerald' : 'primary'
                    ));
                }
            }

            // 2. Notify assigned developer if someone else updated it
            if (! empty($bug->developer)) {
                $assignedDev = User::where('name', $bug->developer)->first();
                if ($assignedDev && $assignedDev->id !== $user->id && $assignedDev->id !== $bug->reporter_id) {
                    $assignedDev->notify(new BugNotification(
                        title: 'Status Bug Diperbarui',
                        message: "Status bug #{$bug->id} ('{$bug->title}') diubah menjadi '{$statusLabel}' oleh {$user->name}.",
                        type: 'status_updated',
                        bugId: $bug->id,
                        icon: 'sync',
                        badgeColor: 'primary'
                    ));
                }
            }

            // 3. Notify Super Admins (if not the one who updated)
            $superAdmins = User::where('role', 'super_admin')->where('id', '!=', $user->id)->get();
            foreach ($superAdmins as $admin) {
                $admin->notify(new BugNotification(
                    title: 'Update Aktivitas Bug',
                    message: "{$user->name} mengubah status bug #{$bug->id} ('{$bug->title}') menjadi '{$statusLabel}'.",
                    type: 'status_updated',
                    bugId: $bug->id,
                    icon: 'history',
                    badgeColor: 'secondary'
                ));
            }
        }

        if ($request->boolean('from_show')) {
            return redirect()->route('bugs.show', $bug)->with('success', 'Status dan prioritas bug berhasil diperbarui.');
        }

        return redirect()->route('bugs')->with('success', 'Bug status updated successfully.');
    }

    /**
     * Remove the specified bug from storage.
     */
    public function destroy(Request $request, Bug $bug)
    {
        $user = $request->user();
        if ($user->role !== 'super_admin' && $bug->reporter_id !== $user->id) {
            abort(403, 'Unauthorized.');
        }

        if ($bug->attachment && Storage::disk('public')->exists($bug->attachment)) {
            Storage::disk('public')->delete($bug->attachment);
        }

        $bug->delete();

        return redirect()->route('bugs')->with('success', 'Bug deleted successfully.');
    }
}
