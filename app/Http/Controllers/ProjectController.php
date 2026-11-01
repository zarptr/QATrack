<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the project folders.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Project::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('description', 'like', '%'.$request->search.'%');
        }

        $projects = $query->with('creator')->withCount([
            'bugs',
            'bugs as open_bugs_count' => function ($q) use ($user) {
                $q->where('status', 'open');
                if ($user->role === 'developer') {
                    $q->where('developer', $user->name);
                } elseif ($user->role === 'support_dev') {
                    $q->where('reporter_id', $user->id);
                }
            },
            'bugs as in_progress_bugs_count' => function ($q) use ($user) {
                $q->where('status', 'in_progress');
                if ($user->role === 'developer') {
                    $q->where('developer', $user->name);
                } elseif ($user->role === 'support_dev') {
                    $q->where('reporter_id', $user->id);
                }
            },
            'bugs as resolved_bugs_count' => function ($q) use ($user) {
                $q->whereIn('status', ['fixed', 'closed', 'resolved']);
                if ($user->role === 'developer') {
                    $q->where('developer', $user->name);
                } elseif ($user->role === 'support_dev') {
                    $q->where('reporter_id', $user->id);
                }
            },
        ])->orderBy('name')->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Store a newly created project folder in storage.
     */
    public function store(Request $request)
    {
        if ($request->user()->role === 'developer') {
            abort(403, 'Developers are not authorized to create projects.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $validated['created_by'] = $request->user()->id;

        $project = Project::create($validated);

        return redirect()->route('projects.show', $project)->with('success', "Project folder '{$project->name}' created successfully.");
    }

    /**
     * Display the specified project folder and its bugs.
     */
    public function show(Request $request, Project $project)
    {
        $project->load('creator');
        $user = $request->user();
        $query = $project->bugs();

        if ($user->role === 'support_dev') {
            $query->where('reporter_id', $user->id);
        } elseif ($user->role === 'developer') {
            $query->where('developer', $user->name);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('developer') && $user->role !== 'developer') {
            $query->where('developer', $request->developer);
        }

        // Bug automatically rises to top if priority is high/important (P1 Critical -> P2 High -> P3 Medium)
        $bugs = $query->orderByRaw("CASE priority WHEN 'p1' THEN 1 WHEN 'p2' THEN 2 WHEN 'p3' THEN 3 ELSE 4 END ASC")
            ->orderBy('created_at', 'desc')
            ->get();
        $developers = User::where('role', 'developer')->orderBy('name')->get();

        return view('projects.show', compact('project', 'bugs', 'developers'));
    }

    /**
     * Remove the specified project folder from storage.
     */
    public function destroy(Request $request, Project $project)
    {
        if ($request->user()->role !== 'super_admin' && $project->created_by !== $request->user()->id) {
            abort(403, 'Unauthorized.');
        }

        $projectName = $project->name;
        $project->delete();

        return redirect()->route('projects.index')->with('success', "Project folder '{$projectName}' deleted successfully.");
    }
}
