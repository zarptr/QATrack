<!DOCTYPE html>
<html class="h-full" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>QATrack - Project Folders</title>
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
        @include('layouts.header', ['breadcrumb' => 'Project Folders'])

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto mt-16 p-section-padding" style="background-color: #F8FAFF;">
            <div class="max-w-7xl mx-auto space-y-6">
                
                <!-- Top Action Bar -->
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-2">
                    <!-- Title -->
                    <div>
                        <h2 class="text-2xl font-bold text-on-surface flex items-center gap-2" style="color:#1e3a8a">
                            <span>Project Folders</span>
                            <span class="text-xs px-2.5 py-0.5 rounded-full bg-blue-100 text-primary font-semibold">{{ $projects->count() }} folders</span>
                        </h2>
                    </div>

                    <!-- Search Bar & New Folder CTA Button -->
                    <div class="flex items-center gap-3 flex-wrap">
                        <!-- Search Bar -->
                        <form method="GET" action="{{ route('projects.index') }}" class="relative w-72">
                            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-outline text-[20px]">search</span>
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}" 
                                placeholder="Cari folder project..." 
                                class="w-full pl-10 pr-8 py-2 bg-slate-100 hover:bg-slate-200/80 focus:bg-white border border-transparent focus:border-primary/40 rounded-full text-sm text-on-surface placeholder:text-secondary focus:ring-2 focus:ring-primary/20 focus:outline-none transition-all shadow-inner"
                            />
                            @if(request('search'))
                                <a href="{{ route('projects.index') }}" class="absolute right-3 top-1/2 -translate-y-1/2 text-secondary hover:text-on-surface" title="Clear">
                                    <span class="material-symbols-outlined text-[16px]">close</span>
                                </a>
                            @endif
                        </form>

                        <!-- Google Drive Style "+ New Folder" Button (Super Admin & QA/Support) -->
                        @if(auth()->user()->role !== 'developer')
                            <button onclick="document.getElementById('new-project-modal').classList.remove('hidden')" class="px-5 py-2.5 bg-white hover:bg-slate-50 text-on-surface hover:shadow-md border border-slate-200/90 rounded-full text-sm font-semibold flex items-center gap-2.5 shadow-sm transition-all active:scale-95 cursor-pointer group">
                                <span class="material-symbols-outlined text-primary text-[22px] group-hover:rotate-90 transition-transform">add_circle</span>
                                <span class="text-primary font-bold">New Folder</span>
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Alert Notifications -->
                @if (session('success'))
                    <div class="p-3.5 bg-green-50 border border-green-200 text-green-700 rounded-xl font-body-md text-sm flex items-center gap-2 shadow-sm">
                        <span class="material-symbols-outlined text-green-600 text-[20px]">check_circle</span>
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="p-3.5 bg-red-50 border border-red-200 text-red-700 rounded-xl font-body-md text-sm flex flex-col gap-1 shadow-sm">
                        @foreach ($errors->all() as $error)
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-red-600 text-[18px]">error</span>
                                <span>{{ $error }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Section: Folders Grid (Google Drive Style) -->
                <div>
                    <div class="flex items-center justify-between mb-3 text-xs font-semibold text-secondary uppercase tracking-wider">
                        <span>Folders</span>
                        <span>{{ $projects->count() }} items</span>
                    </div>

                    @if($projects->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($projects as $project)
                                <div class="bg-white hover:bg-slate-50/80 border border-slate-200/90 rounded-2xl p-4 shadow-sm hover:shadow-md hover:border-blue-300 transition-all group flex flex-col justify-between h-44 cursor-pointer relative" onclick="if(!event.target.closest('button') && !event.target.closest('a')) { window.location.href='{{ route('projects.show', $project) }}'; }">
                                    
                                    <!-- Card Header: Icon & 3-Dots Action -->
                                    <div class="flex items-start justify-between">
                                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                            <span class="material-symbols-outlined text-[26px] folder-filled">folder</span>
                                        </div>
                                        
                                        <div class="flex items-center gap-1">
                                            @if(auth()->user()->role !== 'developer')
                                                <a href="{{ route('bugs.create', ['project_id' => $project->id]) }}" class="p-1 text-secondary hover:text-primary hover:bg-blue-50 rounded-lg transition-colors opacity-0 group-hover:opacity-100" title="Add Bug to {{ $project->name }}">
                                                    <span class="material-symbols-outlined text-[18px]">add</span>
                                                </a>
                                            @endif
                                            @if(auth()->user()->role === 'super_admin' || $project->created_by === auth()->id())
                                                <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus folder {{ $project->name }}?');" class="opacity-0 group-hover:opacity-100 transition-opacity">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-1 text-secondary hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete Folder">
                                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Folder Name & Desc & Creator Info -->
                                    <div class="my-1.5">
                                        <a href="{{ route('projects.show', $project) }}" class="text-sm font-bold text-on-surface group-hover:text-primary transition-colors line-clamp-1 block" title="{{ $project->name }}">
                                            {{ $project->name }}
                                        </a>
                                        <p class="text-xs text-secondary line-clamp-1 mt-0.5">{{ $project->description ?: 'No description' }}</p>

                                        <!-- Creator attribution badge -->
                                        <div class="flex items-center gap-1.5 mt-2 text-[11px] text-secondary">
                                            <div class="w-4 h-4 rounded-full bg-blue-100 text-primary flex items-center justify-center text-[9px] font-bold shrink-0">
                                                {{ strtoupper(substr($project->creator?->name ?? 'S', 0, 1)) }}
                                            </div>
                                            <span class="truncate">Dibuat oleh <strong class="text-on-surface font-semibold">{{ $project->creator?->name ?? 'Sistem' }}</strong></span>
                                        </div>
                                    </div>

                                    <!-- Bottom Mini Stats Bar -->
                                    <div class="pt-2 border-t border-slate-100 flex items-center justify-between text-xs text-secondary">
                                        <span class="font-medium flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[14px]">bug_report</span>
                                            {{ $project->bugs_count }} {{ Str::plural('bug', $project->bugs_count) }}
                                        </span>
                                        <div class="flex items-center gap-1.5">
                                            @if($project->open_bugs_count > 0)
                                                <span class="px-1.5 py-0.5 rounded-full bg-red-100 text-red-700 font-semibold text-[10px]" title="Open Bugs">
                                                    {{ $project->open_bugs_count }} open
                                                </span>
                                            @endif
                                            <span class="material-symbols-outlined text-[16px] text-slate-400 group-hover:text-primary transition-colors">chevron_right</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Google Drive Style Empty State -->
                        <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center shadow-sm">
                            <div class="w-16 h-16 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center mx-auto mb-4 text-primary">
                                <span class="material-symbols-outlined text-[36px] folder-filled text-blue-500">folder_open</span>
                            </div>
                            <h3 class="text-lg font-bold text-on-surface mb-1">Belum Ada Folder Project</h3>
                            <p class="text-sm text-secondary max-w-md mx-auto mb-6">Folder project dikelompokkan secara otomatis oleh sistem ketika tiket bug dilaporkan.</p>
                            @if(auth()->user()->role !== 'developer')
                                <button onclick="document.getElementById('new-project-modal').classList.remove('hidden')" class="inline-flex items-center gap-2 py-2.5 px-6 bg-primary text-white text-sm font-semibold rounded-full hover:opacity-90 transition-opacity shadow-md">
                                    <span class="material-symbols-outlined text-[20px]">create_new_folder</span>
                                    Buat Folder Project Baru
                                </button>
                            @endif
                        </div>
                    @endif
                </div>

            </div>
        </main>
    </div>

    <!-- Modal Create New Project Folder (Google Drive Style) -->
    <div id="new-project-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-black/40 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-200 animate-in fade-in duration-200">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-blue-50 text-primary flex items-center justify-center">
                        <span class="material-symbols-outlined text-[22px] folder-filled">create_new_folder</span>
                    </div>
                    <h3 class="text-base font-bold text-on-surface">New Project Folder</h3>
                </div>
                <button onclick="document.getElementById('new-project-modal').classList.add('hidden')" class="text-secondary hover:text-on-surface p-1 rounded-full hover:bg-slate-100">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>
            
            <form action="{{ route('projects.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="projectName" class="block text-xs font-semibold text-secondary uppercase tracking-wider mb-1.5">Folder Name <span class="text-error">*</span></label>
                        <input 
                            type="text" 
                            id="projectName" 
                            name="name" 
                            required 
                            autofocus
                            placeholder="e.g. Instagram, Web Banking, POS System" 
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-on-surface focus:bg-white focus:ring-2 focus:ring-primary focus:outline-none transition-all"
                        />
                        <p class="text-[11px] text-secondary mt-1.5 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[13px] text-primary">person</span>
                            <span>Pembuat folder: <strong class="text-on-surface font-semibold">{{ auth()->user()->name }}</strong></span>
                        </p>
                    </div>
                    <div>
                        <label for="projectDesc" class="block text-xs font-semibold text-secondary uppercase tracking-wider mb-1.5">Description (Optional)</label>
                        <textarea 
                            id="projectDesc" 
                            name="description" 
                            rows="3" 
                            placeholder="Add notes or details about this project..." 
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-on-surface focus:bg-white focus:ring-2 focus:ring-primary focus:outline-none transition-all"
                        ></textarea>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="document.getElementById('new-project-modal').classList.add('hidden')" class="px-4 py-2 rounded-full text-sm font-semibold text-secondary hover:bg-slate-100 transition-colors">Cancel</button>
                    <button type="submit" class="px-5 py-2.5 bg-primary text-white rounded-full text-sm font-semibold hover:opacity-90 shadow-md flex items-center gap-1.5 active:scale-95 transition-all">
                        <span class="material-symbols-outlined text-[18px]">check</span>
                        Create Folder
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
