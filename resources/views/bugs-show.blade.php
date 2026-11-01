<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Bug Detail - QATrack</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=JetBrains+Mono:wght@400;500&amp;display=swap" rel="stylesheet"/>
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
                        "mono-code": ["JetBrains Mono"],
                        "headline-md": ["Inter"],
                        "label-md": ["Inter"],
                        "body-md": ["Inter"],
                        "body-lg": ["Inter"]
                    },
                    "fontSize": {
                        "headline-sm": ["18px", { "lineHeight": "28px", "fontWeight": "600" }],
                        "display-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "600" }],
                        "mono-code": ["13px", { "lineHeight": "20px", "fontWeight": "400" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                        "label-md": ["12px", { "lineHeight": "16px", "letterSpacing": "0.02em", "fontWeight": "500" }],
                        "body-md": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                        "body-lg": ["16px", { "lineHeight": "24px", "fontWeight": "400" }]
                    }
                }
            }
        }
    </script>
    <style>
        body, main { background-color: #F8FAFF !important; }
        .bg-surface-container-lowest, .bg-surface, .card-white { background-color: #ffffff !important; }
    </style>
</head>
<body class="text-on-background font-body-md antialiased min-h-screen" style="background-color: #F8FAFF;">
    @include('layouts.sidebar')
    @include('layouts.header')

    <!-- Main Content Canvas -->
    <main class="ml-sidebar-width mt-16 p-section-padding min-h-[calc(100vh-64px)] max-w-7xl mx-auto" style="background-color: #F8FAFF;">
        @if (session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px] text-emerald-600">check_circle</span>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-800">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-xs flex items-start gap-2 shadow-xs">
                <span class="material-symbols-outlined text-[20px] text-red-600 shrink-0">error</span>
                <div class="flex flex-col gap-0.5">
                    @foreach ($errors->all() as $error)
                        <p class="font-medium">{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Header Section -->
        <div class="flex justify-between items-start mb-container-gap">
            <div class="flex flex-col gap-2">
                <div class="flex items-center gap-3 text-label-md font-label-md text-secondary">
                    <a class="hover:text-primary transition-colors" href="{{ route('bugs') }}">Bugs</a>
                    <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                    <span>#{{ 4000 + $bug->id }}</span>
                </div>
                <h2 class="text-display-lg font-display-lg" style="color:#1e3a8a">{{ $bug->title }}</h2>
                <div class="flex items-center gap-4 mt-2">
                    @if (strtolower($bug->priority) == 'p1')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-error-container text-on-error-container font-label-md text-label-md">
                            <span class="w-2 h-2 rounded-full bg-error"></span> High Priority (P1)
                        </span>
                    @elseif (strtolower($bug->priority) == 'p2')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-tertiary-container text-on-tertiary-container font-label-md text-label-md border border-tertiary/20">
                            <span class="w-2 h-2 rounded-full bg-tertiary"></span> Medium Priority (P2)
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-variant text-on-surface-variant font-label-md text-label-md border border-outline-variant">
                            <span class="w-2 h-2 rounded-full bg-secondary"></span> Low Priority (P3)
                        </span>
                    @endif

                    @if ($bug->status == 'new' || $bug->status == 'open')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-md text-label-md border border-outline-variant">
                            <span class="material-symbols-outlined text-[14px]">fiber_new</span> New
                        </span>
                    @elseif ($bug->status == 'in_progress')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-container-highest text-primary font-label-md text-label-md border border-outline-variant">
                            <span class="material-symbols-outlined text-[14px]">progress_activity</span> In Progress
                        </span>
                    @elseif ($bug->status == 'done_by_development' || $bug->status == 'fixed' || $bug->status == 'resolved')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-tint text-on-primary font-label-md text-label-md">
                            <span class="material-symbols-outlined text-[14px]">check_circle</span> Done by Development
                        </span>
                    @elseif ($bug->status == 'done_by_support_qa' || $bug->status == 'retest')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-tertiary-container text-on-tertiary-container font-label-md text-label-md border border-outline-variant">
                            <span class="material-symbols-outlined text-[14px]">verified</span> Done by Support/QA
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-md text-label-md">
                            <span class="material-symbols-outlined text-[14px]">lock</span> Closed
                        </span>
                    @endif

                    <span class="text-secondary font-body-md text-body-md flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                        Created {{ $bug->created_at->format('M d, Y') }}
                    </span>

                    @if ($bug->project)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 text-blue-700 font-label-md text-label-md border border-blue-200">
                            <span class="material-symbols-outlined text-[14px]">folder</span>
                            <span>{{ $bug->project }}</span>
                        </span>
                    @endif
                </div>
            </div>
            <div class="flex items-center gap-3">
                @php
                    $role = auth()->user()->role;
                @endphp

                <!-- Developer Actions -->
                @if ($role === 'developer')
                    <form action="{{ route('bugs.status.update', $bug) }}" method="POST" class="flex flex-wrap items-center gap-3 bg-white p-2 border border-slate-200/80 rounded-xl shadow-xs">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="from_show" value="1"/>

                        <!-- Status Selector -->
                        <div class="flex items-center gap-2 pl-2">
                            <label for="dev-status-select" class="text-[11px] font-semibold text-secondary uppercase tracking-wider">Status:</label>
                            <select id="dev-status-select" name="status" class="bg-surface-container-low border border-outline-variant/60 rounded-lg py-1.5 pl-3 pr-8 font-medium text-xs text-on-surface focus:ring-2 focus:ring-primary focus:outline-none cursor-pointer">
                                <option value="new" {{ in_array($bug->status, ['new', 'open']) ? 'selected' : '' }}>New</option>
                                <option value="in_progress" {{ $bug->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="done_by_development" {{ in_array($bug->status, ['done_by_development', 'fixed']) ? 'selected' : '' }}>Done by Development</option>
                            </select>
                        </div>

                        <!-- Apply Button -->
                        <button type="submit" class="px-4 py-1.5 text-white rounded-lg hover:opacity-90 font-medium text-xs flex items-center gap-1.5 cursor-pointer shadow-xs active:scale-95 transition-all ml-1" style="background-color:#1e3a8a;">
                            <span class="material-symbols-outlined text-[16px]">save</span>
                            <span>Apply</span>
                        </button>
                    </form>

                @endif

                <!-- Support Dev / QA & Super Admin Actions -->
                @if ($role === 'super_admin' || $role === 'support_dev')
                    <form action="{{ route('bugs.status.update', $bug) }}" method="POST" class="flex flex-wrap items-center gap-3 bg-white p-2 border border-slate-200/80 rounded-xl shadow-xs">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="from_show" value="1"/>
                        
                        <!-- Status Selector -->
                        <div class="flex items-center gap-2 pl-2">
                            <label for="status-select" class="text-[11px] font-semibold text-secondary uppercase tracking-wider">Status:</label>
                            <select id="status-select" name="status" class="bg-surface-container-low border border-outline-variant/60 rounded-lg py-1.5 pl-3 pr-8 font-medium text-xs text-on-surface focus:ring-2 focus:ring-primary focus:outline-none cursor-pointer">
                                <option value="new" {{ $bug->status === 'new' || $bug->status === 'open' ? 'selected' : '' }}>New</option>
                                <option value="in_progress" {{ $bug->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="done_by_development" {{ $bug->status === 'done_by_development' || $bug->status === 'fixed' ? 'selected' : '' }}>Done by Development</option>
                                <option value="done_by_support_qa" {{ $bug->status === 'done_by_support_qa' || $bug->status === 'retest' ? 'selected' : '' }}>Done by Support/QA</option>
                                <option value="closed" {{ $bug->status === 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>
                        
                        <div class="h-6 w-px bg-outline-variant/60 hidden sm:block"></div>

                        <!-- Priority Selector -->
                        <div class="flex items-center gap-2">
                            <label for="priority-select" class="text-[11px] font-semibold text-secondary uppercase tracking-wider">Priority:</label>
                            <select id="priority-select" name="priority" class="bg-surface-container-low border border-outline-variant/60 rounded-lg py-1.5 pl-3 pr-8 font-medium text-xs text-on-surface focus:ring-2 focus:ring-primary focus:outline-none cursor-pointer">
                                <option value="p1" {{ strtolower($bug->priority) === 'p1' ? 'selected' : '' }}>P1 (Critical)</option>
                                <option value="p2" {{ strtolower($bug->priority) === 'p2' ? 'selected' : '' }}>P2 (High)</option>
                                <option value="p3" {{ strtolower($bug->priority) === 'p3' ? 'selected' : '' }}>P3 (Low)</option>
                            </select>
                        </div>
                        
                        <div class="h-6 w-px bg-outline-variant/60 hidden sm:block"></div>
                        
                        <!-- Assignee Selector -->
                        <div class="flex items-center gap-2">
                            <label for="developer-select" class="text-[11px] font-semibold text-secondary uppercase tracking-wider">Assignee:</label>
                            <select id="developer-select" name="developer" class="bg-surface-container-low border border-outline-variant/60 rounded-lg py-1.5 pl-3 pr-8 font-medium text-xs text-on-surface focus:ring-2 focus:ring-primary focus:outline-none cursor-pointer">
                                <option value="" {{ empty($bug->developer) ? 'selected' : '' }}>Unassigned</option>
                                @foreach ($developers as $dev)
                                    <option value="{{ $dev->name }}" {{ $bug->developer === $dev->name ? 'selected' : '' }}>{{ $dev->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Apply Button -->
                        <button type="submit" class="px-4 py-1.5 text-white rounded-lg hover:opacity-90 font-medium text-xs flex items-center gap-1.5 cursor-pointer shadow-xs active:scale-95 transition-all ml-1" style="background-color:#1e3a8a;">
                            <span class="material-symbols-outlined text-[16px]">save</span>
                            <span>Apply</span>
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-container-gap">
            <!-- Left Column: Details & Attachments -->
            <div class="lg:col-span-2 flex flex-col gap-container-gap">
                <!-- Description Card -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/80 p-6">
                    <h3 class="text-headline-sm font-headline-sm text-on-surface mb-4">Description</h3>
                    <div class="text-body-lg font-body-lg text-on-surface-variant leading-relaxed whitespace-pre-line">
                        {{ $bug->description }}
                    </div>
                </div>

                <!-- Attachments Card -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/80 p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-headline-sm font-headline-sm text-on-surface">Attachments</h3>
                    </div>
                    @if ($bug->attachment)
                        @php
                            $ext = strtolower(pathinfo($bug->attachment, PATHINFO_EXTENSION));
                            $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg']);
                            $attachmentUrl = asset('storage/' . $bug->attachment);
                            $formattedSize = $bug->attachment_size ? round($bug->attachment_size / 1048576, 2) . ' MB' : '';
                        @endphp
                        @if ($isImage)
                            <div class="border border-outline-variant rounded-lg overflow-hidden bg-surface-bright group relative">
                                <div class="aspect-video w-full bg-surface-container-low flex items-center justify-center relative">
                                    <img alt="Error Screenshot" class="w-full h-full object-contain bg-neutral-900" src="{{ $attachmentUrl }}"/>
                                    <div class="absolute inset-0 bg-inverse-surface/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <a href="{{ $attachmentUrl }}" target="_blank" class="bg-surface-container-lowest text-on-surface px-4 py-2 rounded-lg font-label-md flex items-center gap-2 shadow-sm cursor-pointer hover:bg-surface-container-high transition-colors">
                                            <span class="material-symbols-outlined text-[18px]">zoom_in</span> View Full
                                        </a>
                                    </div>
                                </div>
                                <div class="p-3 border-t border-outline-variant flex items-center justify-between bg-surface-container-lowest">
                                    <div class="flex items-center gap-2 text-body-md font-body-md text-on-surface-variant truncate mr-2">
                                        <span class="material-symbols-outlined text-[18px]">image</span>
                                        <span class="truncate">{{ $bug->attachment_name ?? basename($bug->attachment) }}</span>
                                    </div>
                                    @if($formattedSize)
                                        <span class="text-label-md font-label-md text-secondary shrink-0">{{ $formattedSize }}</span>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="border border-outline-variant rounded-xl p-4 bg-surface-container-lowest flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-surface-container flex items-center justify-center text-primary">
                                        <span class="material-symbols-outlined text-[24px]">description</span>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-on-surface truncate">{{ $bug->attachment_name ?? basename($bug->attachment) }}</p>
                                        @if($formattedSize)
                                            <p class="text-[11px] text-secondary mt-0.5">{{ $formattedSize }}</p>
                                        @endif
                                    </div>
                                </div>
                                <a href="{{ $attachmentUrl }}" target="_blank" download class="px-3 py-1.5 rounded-lg border border-outline-variant hover:bg-surface-container-high text-primary text-xs font-semibold flex items-center gap-1.5 transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">download</span> Unduh
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="border border-dashed border-outline-variant rounded-xl p-8 flex flex-col items-center justify-center bg-surface hover:bg-surface-container-low transition-colors cursor-pointer group">
                            <span class="material-symbols-outlined text-outline-variant text-[32px] mb-2">upload_file</span>
                            <p class="font-label-md text-label-md text-secondary text-center">No files attached to this bug.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Column: Meta & Timeline -->
            <div class="flex flex-col gap-container-gap">
                <!-- Meta Info Card -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/80 p-6">
                    <h3 class="text-headline-sm font-headline-sm text-on-surface mb-4">Informasi Bug</h3>
                    <div class="space-y-4">
                        @if ($bug->project)
                            <div class="flex justify-between items-center pb-3 border-b border-outline-variant/50">
                                <span class="text-label-md font-label-md text-secondary">Project</span>
                                <span class="text-body-md font-body-md text-blue-700 font-semibold flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[15px]">folder</span>
                                    {{ $bug->project }}
                                </span>
                            </div>
                        @endif
                        <div class="flex justify-between items-center pb-3 border-b border-outline-variant/50">
                            <span class="text-label-md font-label-md text-secondary">Assignee</span>
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full text-white flex items-center justify-center text-[10px] font-bold" style="background-color:#1e3a8a;">
                                    {{ strtoupper(substr($bug->developer ?? 'UA', 0, 2)) }}
                                </div>
                                <span class="text-body-md font-body-md text-on-surface font-medium">{{ $bug->developer ?? 'Unassigned' }}</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-outline-variant/50">
                            <span class="text-label-md font-label-md text-secondary">Reporter</span>
                            <span class="text-body-md font-body-md text-on-surface font-medium">{{ $bug->reporter->name ?? 'User' }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-outline-variant/50">
                            <span class="text-label-md font-label-md text-secondary">Priority</span>
                            <div>
                                @if (strtolower($bug->priority) === 'p1')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-error text-white font-bold text-xs shadow-xs">
                                        <span class="material-symbols-outlined text-[13px]">arrow_upward</span> P1 Critical
                                    </span>
                                @elseif (strtolower($bug->priority) === 'p2')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-amber-500 text-white font-bold text-xs shadow-xs">
                                        <span class="material-symbols-outlined text-[13px]">arrow_upward</span> P2 High
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-surface-variant text-on-surface-variant font-medium text-xs border border-outline-variant">
                                        <span class="w-2 h-2 rounded-full bg-secondary"></span> P3 Low
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-outline-variant/50">
                            <span class="text-label-md font-label-md text-secondary">Status</span>
                            <span class="text-body-md font-body-md text-primary font-semibold uppercase">{{ str_replace('_', ' ', $bug->status) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-label-md font-label-md text-secondary">Dibuat</span>
                            <span class="text-body-md font-body-md text-on-surface">{{ $bug->created_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- History Timeline -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/80 p-6">
                    <h3 class="text-headline-sm font-headline-sm text-on-surface mb-6">Activity Timeline</h3>
                    <div class="relative space-y-6 before:absolute before:top-4 before:bottom-4 before:left-[15px] before:w-[2px] before:bg-outline-variant/70">
                        @if ($bug->status !== 'open')
                            <!-- Timeline Item: Status Change -->
                            <div class="relative flex items-start gap-4">
                                <div class="w-8 h-8 rounded-full bg-surface-container-lowest border-2 border-primary flex items-center justify-center shrink-0 z-10 shadow-xs">
                                    <span class="material-symbols-outlined text-[16px] text-primary">sync</span>
                                </div>
                                <div class="flex-1 min-w-0 pt-0.5">
                                    <p class="text-body-md font-body-md text-on-surface leading-snug">
                                        Status diubah menjadi <span class="font-semibold text-primary uppercase">{{ str_replace('_', ' ', $bug->status) }}</span>
                                    </p>
                                    <span class="text-label-md font-label-md text-secondary mt-0.5 block">{{ $bug->updated_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @endif

                        @if ($bug->developer && $bug->developer !== 'Unassigned')
                            <!-- Timeline Item: Assignment -->
                            <div class="relative flex items-start gap-4">
                                <div class="w-8 h-8 rounded-full bg-surface-container-lowest border-2 border-blue-600 flex items-center justify-center shrink-0 z-10 shadow-xs">
                                    <span class="material-symbols-outlined text-[16px] text-blue-600">person_add</span>
                                </div>
                                <div class="flex-1 min-w-0 pt-0.5">
                                    <p class="text-body-md font-body-md text-on-surface leading-snug">
                                        Ditugaskan ke <span class="font-semibold text-primary">{{ $bug->developer }}</span>
                                    </p>
                                    <span class="text-label-md font-label-md text-secondary mt-0.5 block">{{ $bug->updated_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @endif

                        <!-- Timeline Item: Created -->
                        <div class="relative flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-surface-container-lowest border-2 border-outline-variant flex items-center justify-center shrink-0 z-10 shadow-xs">
                                <span class="material-symbols-outlined text-[16px] text-secondary">bug_report</span>
                            </div>
                            <div class="flex-1 min-w-0 pt-0.5">
                                <p class="text-body-md font-body-md text-on-surface leading-snug">
                                    <span class="font-semibold">{{ $bug->reporter->name ?? 'User' }}</span> membuat laporan bug
                                </p>
                                <span class="text-label-md font-label-md text-secondary mt-0.5 block">{{ $bug->created_at->format('d M Y - H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
