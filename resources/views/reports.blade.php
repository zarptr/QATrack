<!DOCTYPE html>
<html class="h-full" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>QATrack - Reports &amp; Export</title>
    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=JetBrains+Mono:wght@400&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
                    "headline-sm": [
                            "Inter"
                    ],
                    "display-lg": [
                            "Inter"
                    ],
                    "mono-code": [
                            "jetbrainsMono"
                    ],
                    "headline-md": [
                            "Inter"
                    ],
                    "label-md": [
                            "Inter"
                    ],
                    "body-md": [
                            "Inter"
                    ],
                    "body-lg": [
                            "Inter"
                    ]
            },
            "fontSize": {
                    "headline-sm": [
                            "18px",
                            {
                                    "lineHeight": "28px",
                                    "fontWeight": "600"
                            }
                    ],
                    "display-lg": [
                            "32px",
                            {
                                    "lineHeight": "40px",
                                    "letterSpacing": "-0.02em",
                                    "fontWeight": "600"
                            }
                    ],
                    "mono-code": [
                            "13px",
                            {
                                    "lineHeight": "20px",
                                    "fontWeight": "400"
                            }
                    ],
                    "headline-md": [
                            "24px",
                            {
                                    "lineHeight": "32px",
                                    "letterSpacing": "-0.01em",
                                    "fontWeight": "600"
                            }
                    ],
                    "label-md": [
                            "12px",
                            {
                                    "lineHeight": "16px",
                                    "letterSpacing": "0.02em",
                                    "fontWeight": "500"
                            }
                    ],
                    "body-md": [
                            "14px",
                            {
                                    "lineHeight": "20px",
                                    "fontWeight": "400"
                            }
                    ],
                    "body-lg": [
                            "16px",
                            {
                                    "lineHeight": "24px",
                                    "fontWeight": "400"
                            }
                    ]
            }
          }
        }
      }
    </script>
    <style>
        .material-symbols-outlined {
          font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .material-symbols-outlined[data-weight="fill"] {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body, main { background-color: #F8FAFF !important; margin: 0; padding: 0; }
        body { overflow-x: hidden; }
        .bg-surface, .bg-surface-container-lowest, .card-white { background-color: #ffffff !important; }
        /* Soft shadows for depth */
        .shadow-level-1 {
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
        }
    </style>
</head>
<body class="flex text-on-background font-body-md antialiased h-screen overflow-hidden" style="background-color: #F8FAFF;">
    @include('layouts.sidebar')

    <!-- Main Content Area Wrapper -->
    <div class="flex-1 ml-sidebar-width flex flex-col h-screen relative">
        @include('layouts.header', ['breadcrumb' => 'Reports & Export'])

        <!-- Canvas / Content -->
        <main class="flex-1 overflow-y-auto mt-16 p-section-padding" style="background-color: #F8FAFF;">
            <div class="max-w-7xl mx-auto space-y-container-gap">
                <!-- Page Header & Filters -->
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                    <div>
                        <h2 class="text-display-lg font-display-lg" style="color:#1e3a8a">Analytics Summary</h2>
                        <p class="text-body-lg font-body-lg text-on-surface-variant mt-1">Review system performance and export data.</p>
                    </div>

                    <!-- Interactive Filter Controls -->
                    <form method="GET" action="{{ route('reports') }}" class="flex flex-wrap items-center gap-2.5 bg-white p-2.5 rounded-xl shadow-xs border border-slate-200/80">
                        <div class="flex items-center gap-1.5 px-2 border-r border-outline-variant pr-3 text-on-surface-variant">
                            <span class="material-symbols-outlined text-[18px] text-outline">tune</span>
                            <span class="text-label-md font-label-md uppercase tracking-wider text-xs font-semibold text-secondary">Filter</span>
                        </div>

                        <!-- Date Period Selector -->
                        <select name="period" onchange="this.form.submit()" class="bg-surface border border-outline-variant rounded-lg py-1.5 pl-3.5 pr-9 text-body-md font-medium text-on-surface focus:ring-2 focus:ring-primary focus:outline-none cursor-pointer">
                            <option value="30days" {{ request('period', '30days') === '30days' ? 'selected' : '' }}>30 Hari Terakhir</option>
                            <option value="7days" {{ request('period') === '7days' ? 'selected' : '' }}>7 Hari Terakhir</option>
                            <option value="90days" {{ request('period') === '90days' ? 'selected' : '' }}>90 Hari Terakhir</option>
                            <option value="this_year" {{ request('period') === 'this_year' ? 'selected' : '' }}>Tahun Ini</option>
                            <option value="all" {{ request('period') === 'all' ? 'selected' : '' }}>Semua Waktu</option>
                        </select>

                        <!-- Project Selector -->
                        @if ($projects->count() > 0)
                            <select name="project" onchange="this.form.submit()" class="bg-surface border border-outline-variant rounded-lg py-1.5 pl-3.5 pr-9 text-body-md font-medium text-on-surface focus:ring-2 focus:ring-primary focus:outline-none cursor-pointer">
                                <option value="">Semua Project</option>
                                @foreach ($projects as $proj)
                                    <option value="{{ $proj }}" {{ request('project') === $proj ? 'selected' : '' }}>{{ $proj }}</option>
                                @endforeach
                            </select>
                        @endif

                        <!-- Priority Selector -->
                        <select name="priority" onchange="this.form.submit()" class="bg-surface border border-outline-variant rounded-lg py-1.5 pl-3.5 pr-9 text-body-md font-medium text-on-surface focus:ring-2 focus:ring-primary focus:outline-none cursor-pointer">
                            <option value="">Semua Prioritas</option>
                            <option value="p1" {{ request('priority') === 'p1' ? 'selected' : '' }}>P1 - Critical</option>
                            <option value="p2" {{ request('priority') === 'p2' ? 'selected' : '' }}>P2 - High</option>
                            <option value="p3" {{ request('priority') === 'p3' ? 'selected' : '' }}>P3 - Medium</option>
                        </select>

                        <!-- Status Selector -->
                        <select name="status" onchange="this.form.submit()" class="bg-surface border border-outline-variant rounded-lg py-1.5 pl-3.5 pr-9 text-body-md font-medium text-on-surface focus:ring-2 focus:ring-primary focus:outline-none cursor-pointer">
                            <option value="">Semua Status</option>
                            <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>New</option>
                            <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="done_by_development" {{ request('status') === 'done_by_development' ? 'selected' : '' }}>Done by Development</option>
                            <option value="done_by_support_qa" {{ request('status') === 'done_by_support_qa' ? 'selected' : '' }}>Done by Support/QA</option>
                            <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>

                        @if (request()->hasAny(['project', 'priority', 'status']) || (request('period') && request('period') !== '30days'))
                            <a href="{{ route('reports') }}" class="px-2 py-1 text-xs text-primary font-semibold hover:underline flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]">refresh</span>
                                Reset
                            </a>
                        @endif
                    </form>
                </div>

                <!-- Summary Statistics Bento Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-element-gap">
                    <!-- Stat 1 -->
                    <div class="bg-white p-6 rounded-[12px] shadow-xs border border-slate-200/80 flex flex-col justify-between h-32">
                        <div class="flex justify-between items-start">
                            <p class="text-label-md font-label-md text-secondary uppercase tracking-wider">Avg Resolution Time</p>
                            <span class="material-symbols-outlined text-primary bg-primary-container/10 p-1.5 rounded-full">timer</span>
                        </div>
                        <div class="flex items-baseline gap-2">
                            <h3 class="text-display-lg font-display-lg text-on-surface">{{ $avgResolutionTime }}</h3>
                            <span class="text-body-md font-body-md text-secondary">days</span>
                        </div>
                    </div>
                    <!-- Stat 2 -->
                    <div class="bg-white p-6 rounded-[12px] shadow-xs border border-slate-200/80 flex flex-col justify-between h-32">
                        <div class="flex justify-between items-start">
                            <p class="text-label-md font-label-md text-secondary uppercase tracking-wider">Total Bugs Logged</p>
                            <span class="material-symbols-outlined text-error bg-error-container/30 p-1.5 rounded-full">bug_report</span>
                        </div>
                        <div class="flex items-baseline gap-2">
                            <h3 class="text-display-lg font-display-lg text-on-surface">{{ $totalBugsCount }}</h3>
                            @if ($resolvedCount > 0 && $totalBugsCount > 0)
                                <span class="text-body-md font-body-md text-emerald-600 flex items-center gap-0.5 text-xs font-semibold">
                                    <span class="material-symbols-outlined text-[15px]">check_circle</span>
                                    {{ round(($resolvedCount / $totalBugsCount) * 100) }}% resolved
                                </span>
                            @endif
                        </div>
                    </div>
                    <!-- Stat 3 -->
                    <div class="bg-white p-6 rounded-[12px] shadow-xs border border-slate-200/80 flex flex-col justify-between h-32">
                        <div class="flex justify-between items-start">
                            <p class="text-label-md font-label-md text-secondary uppercase tracking-wider">Bugs per Developer</p>
                            <span class="material-symbols-outlined text-tertiary bg-tertiary-container/10 p-1.5 rounded-full">person</span>
                        </div>
                        <div class="flex items-baseline gap-2">
                            <h3 class="text-display-lg font-display-lg text-on-surface">{{ $bugsPerDev }}</h3>
                            <span class="text-body-md font-body-md text-secondary">avg</span>
                        </div>
                    </div>
                </div>

                <!-- Export Section -->
                <div class="bg-white rounded-[12px] shadow-xs border border-slate-200/80 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                        <div>
                            <h3 class="text-headline-sm font-headline-sm text-on-surface">Data Export</h3>
                            <p class="text-body-md font-body-md text-on-surface-variant mt-1">Generate comprehensive reports for stakeholder review.</p>
                        </div>
                    </div>
                    <div class="p-8 flex flex-col items-center justify-center bg-white">
                        <!-- Excel Export Card -->
                        <div class="flex flex-col items-center p-8 border border-emerald-500/20 rounded-2xl bg-white hover:bg-emerald-50/30 transition-all max-w-md w-full shadow-xs text-center">
                            <div class="w-16 h-16 rounded-2xl bg-emerald-600 text-white flex items-center justify-center mb-4 shadow-md shadow-emerald-600/20 transition-transform">
                                <span class="material-symbols-outlined text-[32px]">table_chart</span>
                            </div>
                            <h4 class="text-headline-sm font-headline-sm text-on-surface font-bold">Export to Excel</h4>
                            <p class="text-body-md font-body-md text-on-surface-variant mt-2 max-w-xs">
                                Unduh seluruh data laporan bug dalam format spreadsheet Excel / CSV lengkap dengan rincian status dan penugasan.
                            </p>
                            <a href="{{ route('reports.export.excel', request()->query()) }}" class="mt-6 w-full py-3 text-white rounded-xl font-label-md text-label-md flex items-center justify-center gap-2 hover:bg-emerald-700 transition-all active:scale-[0.98] shadow-md shadow-emerald-600/20 cursor-pointer bg-emerald-600">
                                <span class="material-symbols-outlined text-[20px]">download</span>
                                Download Excel Report
                            </a>
                            <span class="text-[11px] text-secondary mt-3">Kompatibel dengan Microsoft Excel, Google Sheets, & Apple Numbers</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
