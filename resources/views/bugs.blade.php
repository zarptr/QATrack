<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>QATrack - Bugs List</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet"/>
    <!-- Tailwind Theme Configuration -->
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {                    "colors": {
                        "on-primary-container": "#dbeafe",
                        "tertiary-fixed-dim": "#fde68a",
                        "inverse-on-surface": "#ffffff",
                        "surface-container-lowest": "#ffffff",
                        "secondary": "#71717a",
                        "surface-bright": "#ffffff",
                        "on-error-container": "#991b1b",
                        "primary-container": "#1e40af",
                        "on-secondary-fixed-variant": "#3f3f46",
                        "on-tertiary-fixed": "#78350f",
                        "surface": "#ffffff",
                        "primary-fixed-dim": "#e4e4e7",
                        "on-secondary-fixed": "#18181b",
                        "outline-variant": "#e4e4e7",
                        "secondary-fixed": "#f4f4f5",
                        "tertiary": "#78350f",
                        "surface-container-highest": "#e4e4e7",
                        "error": "#dc2626",
                        "on-tertiary-container": "#92400e",
                        "tertiary-container": "#fef3c7",
                        "inverse-primary": "#e4e4e7",
                        "on-surface": "#18181b",
                        "surface-tint": "#1e40af",
                        "background": "#F8FAFF",
                        "surface-dim": "#f4f4f5",
                        "secondary-fixed-dim": "#e4e4e7",
                        "on-secondary-container": "#1e3a8a",
                        "surface-container": "#f4f4f5",
                        "primary": "#1e3a8a",
                        "surface-variant": "#f4f4f5",
                        "on-background": "#18181b",
                        "tertiary-fixed": "#fef3c7",
                        "on-surface-variant": "#52525b",
                        "primary-fixed": "#f4f4f5",
                        "secondary-container": "#eff6ff",
                        "on-primary": "#ffffff",
                        "error-container": "#fee2e2",
                        "on-secondary": "#ffffff",
                        "inverse-surface": "#1e3a8a",
                        "outline": "#a1a1aa",
                        "on-tertiary": "#ffffff",
                        "on-primary-fixed-variant": "#3f3f46",
                        "surface-container-high": "#e4e4e7",
                        "surface-container-low": "#fafafa",
                        "on-error": "#ffffff",
                        "on-primary-fixed": "#18181b",
                        "on-tertiary-fixed-variant": "#92400e"
                    },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            "spacing": {
                    "sidebar-width": "260px",
                    "grid-gutter": "16px",
                    "element-gap": "12px",
                    "section-padding": "32px",
                    "container-gap": "24px",
                    "grid-margin": "24px"
            },
            "fontFamily": {
                    "headline-sm": ["Inter"],
                    "display-lg": ["Inter"],
                    "mono-code": ["jetbrainsMono"],
                    "headline-md": ["Inter"],
                    "label-md": ["Inter"],
                    "body-md": ["Inter"],
                    "body-lg": ["Inter"]
            },
            "fontSize": {
                    "headline-sm": ["18px", {"lineHeight": "28px", "fontWeight": "600"}],
                    "display-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "600"}],
                    "mono-code": ["13px", {"lineHeight": "20px", "fontWeight": "400"}],
                    "headline-md": ["24px", {"lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                    "label-md": ["12px", {"lineHeight": "16px", "letterSpacing": "0.02em", "fontWeight": "500"}],
                    "body-md": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                    "body-lg": ["16px", {"lineHeight": "24px", "fontWeight": "400"}]
            }
          }
        }
      }
    </script>
    <style>
        /* Base styles to ensure clean layout */
        body, main { background-color: #F8FAFF !important; margin: 0; padding: 0; }
        body { overflow-x: hidden; }
        .bg-surface-container-lowest, .bg-surface, .card-white { background-color: #ffffff !important; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="flex text-on-background font-body-md antialiased h-screen overflow-hidden" style="background-color: #F8FAFF;">
    @include('layouts.sidebar')
    <div class="flex-1 ml-sidebar-width flex flex-col h-screen relative">
        @include('layouts.header')

        <!-- Main Scrollable Area -->
        <main class="flex-1 overflow-y-auto mt-16 p-section-padding" style="background-color: #F8FAFF;">
            <div class="max-w-7xl mx-auto space-y-container-gap">
                <!-- Page Header -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-display-lg font-display-lg" style="color:#1e3a8a">Bugs</h2>
                        <p class="text-body-md font-body-md text-on-surface-variant mt-1">Manage, track, and resolve system issues.</p>
                    </div>
                    @if(auth()->user()->role !== 'developer')
                        <a href="{{ route('bugs.create') }}" class="text-white font-label-md text-label-md py-2.5 px-5 rounded-lg flex items-center gap-2 active:scale-95 duration-150 shadow-[0_2px_4px_rgba(0,0,0,0.04)] cursor-pointer hover:opacity-90 transition-opacity" style="background-color:#1e3a8a;">
                            <span class="material-symbols-outlined text-[18px]">add</span>
                            Add New Bug
                        </a>
                    @endif
                </div>

                <!-- Alert Notifications -->
                @if (session('success'))
                    <div class="p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg font-body-md text-body-md flex items-center gap-2">
                        <span class="material-symbols-outlined text-green-600">check_circle</span>
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg font-body-md text-body-md flex flex-col gap-1">
                        @foreach ($errors->all() as $error)
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-red-600 text-[18px]">error</span>
                                <span>{{ $error }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Distribution by Priority Section (Dev Priority Tracking & Auto-Escalation) -->
                <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-200/80">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="font-headline-sm text-headline-sm text-on-background">Distribution by Priority</h3>
                                <span class="text-xs px-2.5 py-0.5 rounded-full bg-blue-100 text-primary font-bold">
                                    {{ $bugs->count() }} Tiket
                                </span>
                            </div>
                            <p class="text-xs text-secondary mt-0.5">Distribusi prioritas tiket bug. Sistem secara otomatis menaikkan bug dengan prioritas tinggi/kritis ke urutan teratas antrean pengerjaan.</p>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            <span class="inline-flex items-center gap-1.5 text-xs font-bold px-3 py-1 rounded-full bg-red-50 text-error border border-red-200 shadow-xs">
                                <span class="material-symbols-outlined text-[15px] animate-bounce">arrow_upward</span>
                                <span>Prioritas Tinggi Otomatis Naik</span>
                            </span>
                        </div>
                    </div>

                    <!-- Priority Bars Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- P1 Critical Card -->
                        <a href="{{ request()->fullUrlWithQuery(['priority' => 'p1']) }}" class="p-4 rounded-xl border {{ request('priority') == 'p1' ? 'border-error bg-red-50/70 ring-2 ring-error/20' : 'border-slate-200/80 hover:border-error/60 bg-white hover:bg-red-50/30' }} transition-all flex flex-col justify-between group cursor-pointer shadow-xs">
                            <div class="flex justify-between items-start mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-error animate-pulse"></span>
                                    <span class="font-bold text-sm text-on-surface group-hover:text-error transition-colors">P1 Critical</span>
                                    <span class="text-[10px] font-bold px-1.5 py-0.2 rounded bg-error text-white uppercase tracking-wider flex items-center gap-0.5">
                                        <span class="material-symbols-outlined text-[11px]">arrow_upward</span> Top Rank
                                    </span>
                                </div>
                                <span class="font-mono-code font-bold text-xl text-error">{{ $p1Count ?? 0 }}</span>
                            </div>
                            <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden mt-1.5">
                                <div class="bg-error h-full rounded-full transition-all duration-500" style="width: {{ $p1Percent ?? 0 }}%"></div>
                            </div>
                            <div class="flex justify-between items-center text-[11px] text-secondary mt-2.5">
                                <span>{{ $p1Percent ?? 0 }}% dari total bug</span>
                                <span class="text-error font-semibold group-hover:underline flex items-center gap-0.5">Filter P1 <span class="material-symbols-outlined text-[13px]">chevron_right</span></span>
                            </div>
                        </a>

                        <!-- P2 High Card -->
                        <a href="{{ request()->fullUrlWithQuery(['priority' => 'p2']) }}" class="p-4 rounded-xl border {{ request('priority') == 'p2' ? 'border-amber-500 bg-amber-50/70 ring-2 ring-amber-500/20' : 'border-slate-200/80 hover:border-amber-400 bg-white hover:bg-amber-50/30' }} transition-all flex flex-col justify-between group cursor-pointer shadow-xs">
                            <div class="flex justify-between items-start mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                                    <span class="font-bold text-sm text-on-surface group-hover:text-amber-700 transition-colors">P2 High</span>
                                    <span class="text-[10px] font-bold px-1.5 py-0.2 rounded bg-amber-500 text-white uppercase tracking-wider flex items-center gap-0.5">
                                        <span class="material-symbols-outlined text-[11px]">arrow_upward</span> Priority
                                    </span>
                                </div>
                                <span class="font-mono-code font-bold text-xl text-amber-600">{{ $p2Count ?? 0 }}</span>
                            </div>
                            <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden mt-1.5">
                                <div class="bg-amber-500 h-full rounded-full transition-all duration-500" style="width: {{ $p2Percent ?? 0 }}%"></div>
                            </div>
                            <div class="flex justify-between items-center text-[11px] text-secondary mt-2.5">
                                <span>{{ $p2Percent ?? 0 }}% dari total bug</span>
                                <span class="text-amber-700 font-semibold group-hover:underline flex items-center gap-0.5">Filter P2 <span class="material-symbols-outlined text-[13px]">chevron_right</span></span>
                            </div>
                        </a>

                        <!-- P3 Medium Card -->
                        <a href="{{ request()->fullUrlWithQuery(['priority' => 'p3']) }}" class="p-4 rounded-xl border {{ request('priority') == 'p3' ? 'border-blue-500 bg-blue-50/70 ring-2 ring-blue-500/20' : 'border-slate-200/80 hover:border-blue-400 bg-white hover:bg-blue-50/30' }} transition-all flex flex-col justify-between group cursor-pointer shadow-xs">
                            <div class="flex justify-between items-start mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-slate-400"></span>
                                    <span class="font-bold text-sm text-on-surface group-hover:text-primary transition-colors">P3 Medium</span>
                                </div>
                                <span class="font-mono-code font-bold text-xl text-secondary">{{ $p3Count ?? 0 }}</span>
                            </div>
                            <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden mt-1.5">
                                <div class="bg-slate-400 h-full rounded-full transition-all duration-500" style="width: {{ $p3Percent ?? 0 }}%"></div>
                            </div>
                            <div class="flex justify-between items-center text-[11px] text-secondary mt-2.5">
                                <span>{{ $p3Percent ?? 0 }}% dari total bug</span>
                                <span class="text-primary font-semibold group-hover:underline flex items-center gap-0.5">Filter P3 <span class="material-symbols-outlined text-[13px]">chevron_right</span></span>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Filters & Controls Bar -->
                <form method="GET" action="{{ route('bugs') }}" class="bg-white p-4 rounded-xl shadow-sm border border-slate-200/80 flex flex-wrap items-center gap-4">
                    <div class="flex items-center gap-2 border-r border-outline-variant pr-4">
                        <span class="material-symbols-outlined text-outline">filter_list</span>
                        <span class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Filters</span>
                    </div>
                    <select name="status" onchange="this.form.submit()" class="bg-surface border border-outline-variant rounded-md py-1.5 pl-3.5 pr-9 text-body-md font-body-md text-on-surface focus:ring-2 focus:ring-primary focus:outline-none min-w-[140px]">
                        <option value="">All Statuses</option>
                        <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="done_by_development" {{ request('status') == 'done_by_development' ? 'selected' : '' }}>Done by Development</option>
                        <option value="done_by_support_qa" {{ request('status') == 'done_by_support_qa' ? 'selected' : '' }}>Done by Support/QA</option>
                        <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                    <select name="priority" onchange="this.form.submit()" class="bg-surface border border-outline-variant rounded-md py-1.5 pl-3.5 pr-9 text-body-md font-body-md text-on-surface focus:ring-2 focus:ring-primary focus:outline-none min-w-[140px]">
                        <option value="">All Priorities</option>
                        <option value="p1" {{ request('priority') == 'p1' ? 'selected' : '' }}>P1 - Critical (Top)</option>
                        <option value="p2" {{ request('priority') == 'p2' ? 'selected' : '' }}>P2 - High</option>
                        <option value="p3" {{ request('priority') == 'p3' ? 'selected' : '' }}>P3 - Medium</option>
                    </select>
                    @if (auth()->user()->role !== 'developer')
                        <select name="developer" onchange="this.form.submit()" class="bg-surface border border-outline-variant rounded-md py-1.5 pl-3.5 pr-9 text-body-md font-body-md text-on-surface focus:ring-2 focus:ring-primary focus:outline-none min-w-[140px]">
                            <option value="">All Developers</option>
                            @foreach ($developers as $dev)
                                <option value="{{ $dev->name }}" {{ request('developer') == $dev->name ? 'selected' : '' }}>{{ $dev->name }}</option>
                            @endforeach
                        </select>
                    @endif
                    @if (isset($projects) && $projects->count() > 0)
                        <select name="project_id" onchange="this.form.submit()" class="bg-surface border border-outline-variant rounded-md py-1.5 pl-3.5 pr-9 text-body-md font-body-md text-on-surface focus:ring-2 focus:ring-primary focus:outline-none min-w-[140px]">
                            <option value="">All Projects</option>
                            @foreach ($projects as $proj)
                                <option value="{{ $proj->id }}" {{ request('project_id') == $proj->id ? 'selected' : '' }}>📁 {{ $proj->name }}{{ $proj->creator ? ' (oleh ' . $proj->creator->name . ')' : '' }}</option>
                            @endforeach
                        </select>
                    @endif
                    @if (request()->hasAny(['status', 'priority', 'developer', 'project_id', 'project']))
                        <a href="{{ route('bugs') }}" class="text-xs text-primary hover:underline ml-auto font-medium">Reset Filters</a>
                    @endif
                </form>
                <!-- Data Table Container -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/80 overflow-hidden">
                    <div class="px-4 py-2.5 bg-slate-50 border-b border-outline-variant flex items-center justify-between text-xs text-secondary">
                        <span class="flex items-center gap-1.5 font-medium">
                            <span class="material-symbols-outlined text-[15px] text-error">sort</span>
                            Urutan Prioritas: <strong>P1 Critical</strong> &rarr; <strong>P2 High</strong> &rarr; <strong>P3 Medium</strong> (Otomatis naik berdasarkan urgensi)
                        </span>
                        <span class="text-slate-400">Total: {{ $bugs->count() }} tiket</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/80 border-b border-slate-200/80">
                                    <th class="py-3 px-4 font-label-md text-label-md text-secondary uppercase tracking-wider font-medium">Bug ID</th>
                                    <th class="py-3 px-4 font-label-md text-label-md text-secondary uppercase tracking-wider font-medium">Title</th>
                                    <th class="py-3 px-4 font-label-md text-label-md text-secondary uppercase tracking-wider font-medium">Priority</th>
                                    <th class="py-3 px-4 font-label-md text-label-md text-secondary uppercase tracking-wider font-medium">Status</th>
                                    <th class="py-3 px-4 font-label-md text-label-md text-secondary uppercase tracking-wider font-medium">Developer</th>
                                    <th class="py-3 px-4 font-label-md text-label-md text-secondary uppercase tracking-wider font-medium">Created Date</th>
                                    <th class="py-3 px-4 font-label-md text-label-md text-secondary uppercase tracking-wider font-medium text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant">
                                @forelse ($bugs as $bug)
                                    <tr class="bg-white hover:bg-slate-50 transition-colors group {{ $bug->priority == 'p1' ? 'bg-red-50/25 border-l-4 border-l-error' : ($bug->priority == 'p2' ? 'border-l-4 border-l-amber-400' : '') }}">
                                        <td class="py-4 px-4 font-mono-code text-mono-code text-on-surface-variant">BUG-{{ 4000 + $bug->id }}</td>
                                        <td class="py-4 px-4">
                                            <div class="font-body-md text-body-md text-on-surface font-medium flex items-center gap-2">
                                                <span>{{ $bug->title }}</span>
                                                @if($bug->priority == 'p1')
                                                    <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-red-100 text-error">PRIORITY</span>
                                                @endif
                                            </div>
                                            @if ($bug->project)
                                                <div class="inline-flex items-center gap-1 mt-1 px-2 py-0.5 rounded bg-blue-50 text-blue-700 text-[11px] font-medium border border-blue-100">
                                                    <span class="material-symbols-outlined text-[13px]">folder</span>
                                                    <span>{{ $bug->project }}</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="py-4 px-4">
                                            @if ($bug->priority == 'p1')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-error text-white font-bold text-xs shadow-sm">
                                                    <span class="material-symbols-outlined text-[13px]">arrow_upward</span> P1 Critical
                                                </span>
                                            @elseif ($bug->priority == 'p2')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-amber-500 text-white font-semibold text-xs shadow-sm">
                                                    <span class="material-symbols-outlined text-[13px]">arrow_upward</span> P2 High
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-surface-variant text-on-surface-variant font-medium text-xs border border-outline-variant">
                                                    <span class="w-2 h-2 rounded-full bg-secondary"></span> P3 Medium
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-4">
                                            @if ($bug->status == 'new' || $bug->status == 'open')
                                                <span class="inline-flex px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-md text-label-md">New</span>
                                            @elseif ($bug->status == 'in_progress')
                                                <span class="inline-flex px-3 py-1 rounded-full bg-primary-container text-on-primary-container font-label-md text-label-md">In Progress</span>
                                            @elseif ($bug->status == 'done_by_development' || $bug->status == 'fixed' || $bug->status == 'resolved')
                                                <span class="inline-flex px-3 py-1 rounded-full bg-surface-tint text-on-primary font-label-md text-label-md">Done by Dev</span>
                                            @elseif ($bug->status == 'done_by_support_qa' || $bug->status == 'retest')
                                                <span class="inline-flex px-3 py-1 rounded-full bg-tertiary-container text-on-tertiary-container font-label-md text-label-md">Done by QA</span>
                                            @else
                                                <span class="inline-flex px-3 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-md text-label-md">Closed</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-4 font-body-md text-body-md text-on-surface-variant flex items-center gap-2">
                                            @if ($bug->developer && $bug->developer !== 'Unassigned')
                                                <div class="w-6 h-6 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center text-[10px] font-bold">
                                                    {{ strtoupper(substr($bug->developer, 0, 2)) }}
                                                </div>
                                                {{ $bug->developer }}
                                            @else
                                                <div class="w-6 h-6 rounded-full bg-surface-container text-secondary flex items-center justify-center text-[10px] font-bold">
                                                    --
                                                </div>
                                                Unassigned
                                            @endif
                                        </td>
                                        <td class="py-4 px-4 font-body-md text-body-md text-on-surface-variant">{{ $bug->created_at->format('M d, Y') }}</td>
                                        <td class="py-4 px-4 text-right whitespace-nowrap">
                                            <div class="flex items-center justify-end gap-1.5">
                                                <a href="{{ route('bugs.show', $bug) }}" class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg text-primary hover:bg-blue-50 border border-outline-variant/60 transition-colors text-xs font-semibold cursor-pointer" title="Lihat Detail">
                                                    <span class="material-symbols-outlined text-[16px]">visibility</span>
                                                    <span>Detail</span>
                                                </a>
                                                @if(auth()->user()->role === 'super_admin' || auth()->user()->id === $bug->reporter_id)
                                                    <form action="{{ route('bugs.destroy', $bug) }}" method="POST" class="inline" onsubmit="return confirmModal(event, 'Apakah Anda yakin ingin menghapus bug ini? Tindakan ini tidak dapat dibatalkan.', 'Hapus Bug', 'danger', 'Ya, Hapus');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="p-1.5 text-secondary hover:text-error hover:bg-error-container/20 rounded-lg transition-colors cursor-pointer" title="Hapus Bug">
                                                            <span class="material-symbols-outlined text-[18px]">delete</span>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-8 text-center text-on-surface-variant font-medium">No bugs found matching current filters.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Table Footer / Pagination Placeholder -->
                    <div class="bg-surface-container-low border-t border-outline-variant p-4 flex items-center justify-between">
                        <p class="text-body-md font-body-md text-on-surface-variant">Showing 1 to {{ $bugs->count() }} of {{ $bugs->count() }} entries</p>
                        <div class="flex gap-2">
                            <button class="px-3 py-1 rounded border border-outline-variant text-secondary hover:bg-surface-container-highest transition-colors disabled:opacity-50 cursor-pointer" disabled="">Previous</button>
                            <button class="px-3 py-1 rounded border border-outline-variant text-secondary hover:bg-surface-container-highest transition-colors cursor-pointer">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
