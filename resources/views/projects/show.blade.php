<!DOCTYPE html>
<html class="h-full" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>QATrack - Folder: {{ $project->name }}</title>
    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=JetBrains+Mono:wght@400&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                "primary": "#1e3a8a",
                "primary-container": "#1e40af",
                "surface": "#ffffff",
                "surface-container-lowest": "#ffffff",
                "surface-container-low": "#f8fafc",
                "surface-container": "#f1f5f9",
                "surface-variant": "#f1f5f9",
                "on-surface": "#1e293b",
                "on-surface-variant": "#475569",
                "outline-variant": "#e2e8f0",
                "outline": "#94a3b8",
                "secondary": "#64748b",
                "background": "#F8FAFF",
                "error": "#dc2626",
                "error-container": "#fee2e2",
                "tertiary-container": "#fef3c7",
                "secondary-container": "#eff6ff"
            },
            "spacing": {
                "sidebar-width": "260px",
                "section-padding": "32px",
                "container-gap": "24px",
                "element-gap": "12px",
                "grid-margin": "24px"
            },
            "fontFamily": {
                "body-md": ["Inter"],
                "display-lg": ["Inter"]
            }
          }
        }
      }
    </script>
    <style>
        body, main { background-color: #F8FAFF !important; margin: 0; padding: 0; }
        body { overflow-x: hidden; }
        .bg-surface, .bg-surface-container-lowest, .card-white { background-color: #ffffff !important; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .folder-filled { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="flex text-on-background font-body-md antialiased h-screen overflow-hidden" style="background-color: #F8FAFF;">
    @include('layouts.sidebar')
    
    <div class="flex-1 ml-sidebar-width flex flex-col h-screen relative">
        @include('layouts.header', ['breadcrumb' => 'Projects / ' . $project->name])

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto mt-16 p-section-padding" style="background-color: #F8FAFF;">
            <div class="max-w-7xl mx-auto space-y-6">
                
                <!-- Header & Breadcrumbs -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200">
                    <div>
                        <!-- Breadcrumb Path -->
                        <div class="flex items-center gap-2 text-xs font-semibold text-secondary mb-1.5">
                            <a href="{{ route('projects.index') }}" class="hover:text-primary transition-colors flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[18px] folder-filled text-blue-600">folder</span>
                                <span>Projects</span>
                            </a>
                            <span class="material-symbols-outlined text-[14px] text-slate-400">chevron_right</span>
                            <span class="text-on-surface font-bold">{{ $project->name }}</span>
                        </div>
                        
                        <!-- Folder Title -->
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center border border-blue-100 shrink-0">
                                <span class="material-symbols-outlined text-[26px] folder-filled">folder_open</span>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold" style="color:#1e3a8a">{{ $project->name }}</h2>
                                <div class="flex items-center gap-2 text-xs text-secondary mt-0.5 flex-wrap">
                                    @if($project->description)
                                        <span>{{ $project->description }}</span>
                                        <span class="text-slate-300">&bull;</span>
                                    @endif
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[14px] text-slate-400">person</span>
                                        <span>Dibuat oleh <strong class="text-on-surface font-semibold">{{ $project->creator?->name ?? 'Sistem' }}</strong></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Top CTA: Add Bug Button -->
                    @if(auth()->user()->role !== 'developer')
                        <a href="{{ route('bugs.create', ['project_id' => $project->id]) }}" class="px-5 py-2.5 bg-primary text-white rounded-full text-sm font-semibold hover:opacity-90 shadow-md flex items-center gap-2 active:scale-95 transition-all self-start sm:self-center">
                            <span class="material-symbols-outlined text-[20px]">add</span>
                            <span>Add Bug to {{ $project->name }}</span>
                        </a>
                    @endif
                </div>

                <!-- Alert Notifications -->
                @if (session('success'))
                    <div class="p-3.5 bg-green-50 border border-green-200 text-green-700 rounded-xl font-body-md text-sm flex items-center gap-2 shadow-sm">
                        <span class="material-symbols-outlined text-green-600 text-[20px]">check_circle</span>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Filter Controls (Drive Filter Bar) -->
                <form method="GET" action="{{ route('projects.show', $project) }}" class="flex flex-wrap items-center gap-3 bg-white p-3 rounded-2xl shadow-sm border border-slate-200">
                    <div class="flex items-center gap-1.5 px-2 text-secondary">
                        <span class="material-symbols-outlined text-[18px]">tune</span>
                        <span class="text-xs font-bold uppercase tracking-wider">Filter</span>
                    </div>

                    <!-- Status Filter -->
                    <select name="status" onchange="this.form.submit()" class="bg-slate-50 hover:bg-slate-100 border border-slate-200 rounded-xl py-1.5 pl-3 pr-8 text-xs font-semibold text-on-surface focus:ring-2 focus:ring-primary focus:outline-none cursor-pointer transition-colors">
                        <option value="">Status: All Statuses</option>
                        <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="fixed" {{ request('status') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                        <option value="retest" {{ request('status') == 'retest' ? 'selected' : '' }}>Retest</option>
                        <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>

                    <!-- Priority Filter -->
                    <select name="priority" onchange="this.form.submit()" class="bg-slate-50 hover:bg-slate-100 border border-slate-200 rounded-xl py-1.5 pl-3 pr-8 text-xs font-semibold text-on-surface focus:ring-2 focus:ring-primary focus:outline-none cursor-pointer transition-colors">
                        <option value="">Priority: All</option>
                        <option value="p1" {{ request('priority') == 'p1' ? 'selected' : '' }}>P1 - Critical</option>
                        <option value="p2" {{ request('priority') == 'p2' ? 'selected' : '' }}>P2 - High</option>
                        <option value="p3" {{ request('priority') == 'p3' ? 'selected' : '' }}>P3 - Medium</option>
                    </select>

                    <!-- Developer Filter -->
                    @if (auth()->user()->role !== 'developer')
                        <select name="developer" onchange="this.form.submit()" class="bg-slate-50 hover:bg-slate-100 border border-slate-200 rounded-xl py-1.5 pl-3 pr-8 text-xs font-semibold text-on-surface focus:ring-2 focus:ring-primary focus:outline-none cursor-pointer transition-colors">
                            <option value="">Developer: All</option>
                            @foreach ($developers as $dev)
                                <option value="{{ $dev->name }}" {{ request('developer') == $dev->name ? 'selected' : '' }}>{{ $dev->name }}</option>
                            @endforeach
                        </select>
                    @endif

                    @if (request()->hasAny(['status', 'priority', 'developer']))
                        <a href="{{ route('projects.show', $project) }}" class="text-xs text-primary hover:underline ml-auto font-semibold px-2 py-1">Reset Filters</a>
                    @endif
                </form>

                <!-- Drive File Explorer Table -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    @if ($bugs->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-slate-100 bg-slate-50/70 text-xs font-bold text-secondary uppercase tracking-wider">
                                        <th class="py-3 px-5">Name / Title</th>
                                        <th class="py-3 px-4">Status</th>
                                        <th class="py-3 px-4">Priority</th>
                                        <th class="py-3 px-4">Assignee</th>
                                        <th class="py-3 px-4">Date</th>
                                        <th class="py-3 px-5 text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-sm text-on-surface">
                                    @foreach ($bugs as $bug)
                                        <tr class="hover:bg-slate-50/80 transition-colors group cursor-pointer" onclick="if(!event.target.closest('a') && !event.target.closest('button')) { window.location.href='{{ route('bugs.show', $bug) }}'; }">
                                            <!-- File / Bug Title with Icon -->
                                            <td class="py-3.5 px-5">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center shrink-0">
                                                        <span class="material-symbols-outlined text-[18px]">bug_report</span>
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('bugs.show', $bug) }}" class="font-semibold text-on-surface group-hover:text-primary transition-colors flex items-center gap-1.5">
                                                            <span>{{ $bug->title }}</span>
                                                            @if($bug->attachment)
                                                                <span class="material-symbols-outlined text-[15px] text-slate-400" title="Has Attachment">attach_file</span>
                                                            @endif
                                                        </a>
                                                        <span class="text-xs text-slate-400 font-mono">#{{ 4000 + $bug->id }}</span>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Status -->
                                            <td class="py-3.5 px-4">
                                                @if ($bug->status == 'open')
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-500"></span> Open
                                                    </span>
                                                @elseif ($bug->status == 'in_progress')
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> In Progress
                                                    </span>
                                                @elseif ($bug->status == 'fixed' || $bug->status == 'resolved')
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span> Fixed
                                                    </span>
                                                @elseif ($bug->status == 'retest')
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span> Retest
                                                    </span>
                                                @elseif ($bug->status == 'closed')
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> Closed
                                                    </span>
                                                @endif
                                            </td>

                                            <!-- Priority -->
                                            <td class="py-3.5 px-4">
                                                @if ($bug->priority == 'p1')
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span> P1 - Critical
                                                    </span>
                                                @elseif ($bug->priority == 'p2')
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span> P2 - High
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> P3 - Medium
                                                    </span>
                                                @endif
                                            </td>

                                            <!-- Developer -->
                                            <td class="py-3.5 px-4 text-xs">
                                                @if ($bug->developer)
                                                    <div class="flex items-center gap-2">
                                                        <div class="w-6 h-6 rounded-full bg-blue-100 text-primary flex items-center justify-center text-[10px] font-bold">
                                                            {{ strtoupper(substr($bug->developer, 0, 2)) }}
                                                        </div>
                                                        <span class="font-medium text-on-surface">{{ $bug->developer }}</span>
                                                    </div>
                                                @else
                                                    <span class="text-slate-400 italic">Unassigned</span>
                                                @endif
                                            </td>

                                            <!-- Date -->
                                            <td class="py-3.5 px-4 text-xs text-secondary">
                                                {{ $bug->created_at->format('M d, Y') }}
                                            </td>

                                            <!-- Action -->
                                            <td class="py-3.5 px-5 text-right">
                                                <a href="{{ route('bugs.show', $bug) }}" class="px-3 py-1.5 bg-slate-100 hover:bg-blue-50 text-primary font-semibold text-xs rounded-lg transition-colors">
                                                    Open
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- Empty State inside folder -->
                        <div class="p-12 text-center">
                            <div class="w-16 h-16 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center mx-auto mb-4 text-primary">
                                <span class="material-symbols-outlined text-[32px] folder-filled text-blue-500">folder_open</span>
                            </div>
                            <h3 class="text-base font-bold text-on-surface mb-1">This Folder is Empty</h3>
                            <p class="text-xs text-secondary max-w-sm mx-auto mb-5">No bugs have been reported for {{ $project->name }} yet.</p>
                            @if(auth()->user()->role !== 'developer')
                                <a href="{{ route('bugs.create', ['project_id' => $project->id]) }}" class="inline-flex items-center gap-2 py-2 px-5 bg-primary text-white text-xs font-semibold rounded-full hover:opacity-90 transition-opacity shadow-sm">
                                    <span class="material-symbols-outlined text-[16px]">add</span>
                                    Add First Bug to this Folder
                                </a>
                            @endif
                        </div>
                    @endif
                </div>

            </div>
        </main>
    </div>
</body>
</html>
