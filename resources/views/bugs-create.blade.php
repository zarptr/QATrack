<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>QATrack - Report Bug</title>
    <script src="{{ asset('js/tailwind.min.js') }}"></script>
    <script>window.tailwind || document.write('<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"><\/script>')</script>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=JetBrains+Mono:wght@400&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
                        "full": "9999px",
                        "button": "10px"
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
        .custom-shadow {
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
        }
    </style>
</head>
<body class="font-body-md text-on-surface antialiased flex overflow-hidden" style="background-color: #F8FAFF;">
    @include('layouts.sidebar')
    @include('layouts.header')

    <main class="ml-sidebar-width mt-16 w-full h-[calc(100vh-64px)] overflow-y-auto p-section-padding" style="background-color: #F8FAFF;">
        <div class="max-w-4xl mx-auto">
            <div class="mb-8">
                <h2 class="text-display-lg font-display-lg" style="color:#1e3a8a">Report New Bug</h2>
                <p class="text-body-md font-body-md text-secondary mt-1">Provide detailed information to help the team reproduce and fix the issue.</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-[#ffdad6] border border-[#ba1a1a]/20 text-[#93000a] text-xs flex items-start gap-2">
                    <span class="material-symbols-outlined text-[18px] shrink-0">error</span>
                    <div class="flex flex-col gap-0.5">
                        @foreach ($errors->all() as $error)
                            <p class="font-medium">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            <form class="bg-white rounded-xl shadow-sm border border-slate-200/80 p-container-gap" action="{{ route('bugs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">

                    <!-- Panduan & Standar SOP Pelaporan (Pusat Fokus User) -->
                    <div class="rounded-xl border border-blue-900/10 bg-gradient-to-r from-[#1e3a8a] via-[#1e40af] to-[#2563eb] text-white p-4 sm:p-5 shadow-sm">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="flex items-start gap-3.5">
                                <div class="w-10 h-10 rounded-lg bg-white/15 border border-white/20 flex items-center justify-center shrink-0 text-amber-300">
                                    <span class="material-symbols-outlined text-[24px]">menu_book</span>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <h4 class="text-sm font-bold text-white tracking-wide">Panduan &amp; Standar Pelaporan Bug (SOP)</h4>
                                        <span class="text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded-full bg-white/20 text-white border border-white/25">QA Guidelines</span>
                                    </div>
                                    <p class="text-xs text-blue-100/90 mt-1 leading-relaxed">
                                        Pastikan tiket sesuai standar: penentuan prioritas (P1-P3), SLA batas pengerjaan, dan format langkah reproduksi bug.
                                    </p>
                                </div>
                            </div>
                            <button
                                type="button"
                                onclick="openGuideModal()"
                                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-white text-[#1e3a8a] hover:bg-blue-50 text-xs font-bold shadow-md transition-all active:scale-95 cursor-pointer shrink-0 self-stretch sm:self-auto justify-center"
                            >
                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                                <span>Buka Panduan SOP</span>
                            </button>
                        </div>
                    </div>
                    @if($selectedProject)

                        <input type="hidden" name="project_id" value="{{ $selectedProject->id }}"/>
                        <input type="hidden" name="project" value="{{ $selectedProject->name }}"/>
                        <input type="hidden" name="from_project" value="1"/>
                        <div class="p-4 bg-blue-50 border border-blue-200 rounded-xl flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-blue-100 text-primary flex items-center justify-center">
                                    <span class="material-symbols-outlined text-[24px]" style="font-variation-settings: 'FILL' 1;">folder</span>
                                </div>
                                <div>
                                    <span class="text-xs font-semibold text-secondary uppercase tracking-wider block">Project Folder</span>
                                    <h4 class="text-base font-bold text-primary">{{ $selectedProject->name }}</h4>
                                    <p class="text-xs text-secondary mt-0.5">Dibuat oleh: <strong class="text-on-surface font-semibold">{{ $selectedProject->creator?->name ?? 'Sistem' }}</strong></p>
                                </div>
                            </div>
                            <span class="text-xs px-2.5 py-1 rounded-full bg-blue-200/60 text-primary font-semibold">Otomatis Terkunci</span>
                        </div>

                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-2" for="bugTitle">Bug Title <span class="text-error">*</span></label>
                            <input
                                class="w-full bg-surface-container-lowest border rounded-lg px-4 py-2.5 text-body-md focus:outline-none focus:ring-1 transition-shadow placeholder-outline {{ $errors->has('title') ? 'border-error focus:border-error focus:ring-error/20' : 'border-outline-variant focus:border-primary focus:ring-primary' }}"
                                id="bugTitle"
                                name="title"
                                value="{{ old('title') }}"
                                placeholder="Judul bug"
                                required
                                type="text"
                            />
                        </div>
                    @else

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-2">
                                <label class="block font-label-md text-label-md text-on-surface mb-2" for="bugTitle">Bug Title <span class="text-error">*</span></label>
                                <input
                                    class="w-full bg-surface-container-lowest border rounded-lg px-4 py-2.5 text-body-md focus:outline-none focus:ring-1 transition-shadow placeholder-outline {{ $errors->has('title') ? 'border-error focus:border-error focus:ring-error/20' : 'border-outline-variant focus:border-primary focus:ring-primary' }}"
                                    id="bugTitle"
                                    name="title"
                                    value="{{ old('title') }}"
                                    placeholder="Judul bug"
                                    required
                                    type="text"
                                />
                            </div>
                            <div>
                                <label class="block font-label-md text-label-md text-on-surface mb-2" for="project_id">Project / Aplikasi <span class="text-error">*</span></label>
                                <select id="project_id" name="project_id" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5 text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary cursor-pointer transition-shadow" onchange="handleProjectChange(this.value)">
                                    <option value="">Pilih Project...</option>
                                    @foreach($projects as $proj)
                                        <option value="{{ $proj->id }}" {{ old('project_id') == $proj->id ? 'selected' : '' }}>{{ $proj->name }}{{ $proj->creator ? ' (oleh ' . $proj->creator->name . ')' : '' }}</option>
                                    @endforeach
                                    <option value="custom" {{ old('project') ? 'selected' : '' }}>+ Input Project Baru...</option>
                                </select>
                                <div id="custom-project-wrapper" class="{{ old('project') ? '' : 'hidden' }} mt-2">
                                    <input
                                        class="w-full bg-surface-container-lowest border rounded-lg px-4 py-2.5 text-body-md focus:outline-none focus:ring-1 transition-shadow placeholder-outline border-outline-variant focus:border-primary focus:ring-primary"
                                        id="project"
                                        name="project"
                                        value="{{ old('project') }}"
                                        placeholder="Ketik nama project baru (contoh: Core Banking, POS System)"
                                        type="text"
                                    />
                                </div>
                                <p class="text-[11px] text-secondary mt-1.5 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[13px] text-primary">auto_awesome</span>
                                    <span>Sistem otomatis mengelompokkan ke folder project masing-masing.</span>
                                </p>
                            </div>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-2" for="priority">Priority</label>
                            <select class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5 text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-shadow cursor-pointer" id="priority" name="priority">
                                <option value="p3" {{ old('priority') == 'p3' ? 'selected' : '' }}>P3 - Low</option>
                                <option value="p2" {{ old('priority') == 'p2' ? 'selected' : '' }}>P2 - Medium</option>
                                <option value="p1" {{ old('priority') == 'p1' ? 'selected' : '' }}>P1 - High (Critical)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-2" for="status">Status</label>
                            <select class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5 text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-shadow cursor-pointer" id="status" name="status">
                                <option value="new" {{ old('status', 'new') == 'new' ? 'selected' : '' }}>New</option>
                                <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="done_by_development" {{ old('status') == 'done_by_development' ? 'selected' : '' }}>Done by Development</option>
                                <option value="done_by_support_qa" {{ old('status') == 'done_by_support_qa' ? 'selected' : '' }}>Done by Support/QA</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-2" for="assignee">Assign Developer</label>
                            <select class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5 text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-shadow cursor-pointer" id="assignee" name="developer">
                                <option value="" {{ old('developer') == '' ? 'selected' : '' }}>Unassigned</option>
                                @foreach ($developers as $dev)
                                    <option value="{{ $dev->name }}" {{ old('developer') == $dev->name ? 'selected' : '' }}>{{ $dev->name }} (Developer)</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-2 flex items-center gap-1" for="deadline">
                                <span class="material-symbols-outlined text-[15px] text-primary">event</span>
                                <span>Deadline Pengerjaan</span>
                            </label>
                            <input
                                class="w-full bg-surface-container-lowest border rounded-lg px-4 py-2.5 text-body-md focus:outline-none focus:ring-1 transition-shadow cursor-pointer {{ $errors->has('deadline') ? 'border-error focus:border-error focus:ring-error/20' : 'border-outline-variant focus:border-primary focus:ring-primary' }}"
                                id="deadline"
                                name="deadline"
                                value="{{ old('deadline') }}"
                                type="date"
                            />
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label class="block font-label-md text-label-md text-on-surface" for="description">Description &amp; Steps to Reproduce <span class="text-error">*</span></label>
                            <button
                                type="button"
                                onclick="applyBugTemplate()"
                                class="text-xs text-primary hover:text-blue-900 font-semibold flex items-center gap-1 hover:underline cursor-pointer"
                                title="Klik untuk menyisipkan format standar pelaporan bug"
                            >
                                <span class="material-symbols-outlined text-[15px]">post_add</span>
                                <span>Gunakan Template Format QA</span>
                            </button>
                        </div>
                        <textarea
                            class="w-full bg-surface-container-lowest border rounded-lg px-4 py-3 text-body-md font-mono-code focus:outline-none focus:ring-1 transition-shadow placeholder-outline resize-y {{ $errors->has('description') ? 'border-error focus:border-error focus:ring-error/20' : 'border-outline-variant focus:border-primary focus:ring-primary' }}"
                            id="description"
                            name="description"
                            placeholder="Tuliskan deskripsi dan langkah-langkah untuk mereproduksi bug..."
                            required
                            rows="5"
                        >{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label class="block font-label-md text-label-md text-on-surface mb-2">Attachments</label>

                        <input type="file" id="attachment" name="attachment" class="hidden" accept="image/*,.pdf,.txt,.log,.zip">

                        <div id="drop-zone" class="border-2 border-dashed border-outline-variant rounded-xl p-8 flex flex-col items-center justify-center bg-surface hover:bg-surface-container-low transition-all cursor-pointer group relative">

                            <div id="upload-prompt" class="flex flex-col items-center justify-center pointer-events-none">
                                <div class="w-12 h-12 rounded-full bg-surface-container-highest flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-200">
                                    <span class="material-symbols-outlined text-primary text-[24px]">cloud_upload</span>
                                </div>
                                <p class="font-label-md text-label-md text-on-surface text-center mb-1">Drag and drop screenshots or files here</p>
                                <p class="font-body-md text-body-md text-secondary text-center">or click to browse files (Max 5MB)</p>
                            </div>

                            <div id="file-preview-card" class="hidden w-full max-w-md bg-surface-container-lowest border border-outline-variant rounded-xl p-3.5 flex items-center justify-between shadow-sm">
                                <div class="flex items-center gap-3 overflow-hidden">
                                    <div id="preview-thumbnail-container" class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center overflow-hidden shrink-0 border border-outline-variant/60">
                                        <img id="preview-image" class="w-full h-full object-cover hidden" alt="Preview"/>
                                        <span id="preview-icon" class="material-symbols-outlined text-primary text-[24px]">description</span>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p id="preview-filename" class="text-xs font-semibold text-on-surface truncate">filename.png</p>
                                        <p id="preview-filesize" class="text-[11px] text-secondary mt-0.5">0 KB</p>
                                    </div>
                                </div>
                                <button type="button" id="remove-file-btn" class="p-1.5 rounded-lg text-secondary hover:text-error hover:bg-error-container/20 transition-colors ml-2 cursor-pointer" title="Remove file">
                                    <span class="material-symbols-outlined text-[18px]">close</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-outline-variant/30 flex flex-col-reverse sm:flex-row justify-end gap-3 sm:gap-4">
                    <a href="{{ route('bugs') }}" class="w-full sm:w-auto px-6 py-2.5 rounded-button font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high transition-colors flex items-center justify-center" type="button">
                        Cancel
                    </a>
                    <button class="w-full sm:w-auto px-6 py-2.5 rounded-button font-label-md text-label-md text-white shadow-sm hover:opacity-90 active:scale-95 transition-all cursor-pointer" style="background-color:#1e3a8a;" type="submit">
                        Submit Bug
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Modal Panduan Pelaporan Bug -->
    <div id="guide-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" onclick="closeGuideModal()"></div>

        <!-- Modal Box -->
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border border-slate-200">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-indigo-900 px-6 py-5 text-white flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center border border-white/20">
                            <span class="material-symbols-outlined text-[24px]">menu_book</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold leading-6" id="modal-title">Panduan &amp; Standar Pelaporan Bug</h3>
                            <p class="text-xs text-blue-200 mt-0.5">Pedoman QA &amp; SOP Pelaporan Tiket Sistem (IEEE / ISO 29119)</p>
                        </div>
                    </div>
                    <button type="button" onclick="closeGuideModal()" class="text-white/70 hover:text-white rounded-lg p-1.5 hover:bg-white/10 transition-colors cursor-pointer">
                        <span class="material-symbols-outlined text-[22px]">close</span>
                    </button>
                </div>

                <!-- Body Content -->
                <div class="px-6 py-6 max-h-[70vh] overflow-y-auto space-y-6 text-on-surface">
                    
                    <!-- 1. Kriteria Priority -->
                    <div>
                        <h4 class="text-sm font-bold text-on-surface uppercase tracking-wider flex items-center gap-2 mb-3">
                            <span class="w-6 h-6 rounded-lg bg-red-50 text-red-600 flex items-center justify-center text-xs font-bold">1</span>
                            Kriteria Penentuan Prioritas (Priority Matrix)
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 text-xs">
                            <div class="p-3.5 rounded-xl border border-red-200 bg-red-50/40">
                                <span class="inline-flex items-center gap-1 font-bold text-red-700 mb-1">
                                    <span class="w-2 h-2 rounded-full bg-red-600"></span> P1 - High (Critical)
                                </span>
                                <p class="text-slate-600 leading-relaxed text-[11px]">
                                    Sistem crash total, data hilang, transaksi utama terhenti (blocker), atau isu keamanan vital. Tidak ada alternatif (workaround).
                                </p>
                            </div>

                            <div class="p-3.5 rounded-xl border border-amber-200 bg-amber-50/40">
                                <span class="inline-flex items-center gap-1 font-bold text-amber-800 mb-1">
                                    <span class="w-2 h-2 rounded-full bg-amber-500"></span> P2 - Medium (High)
                                </span>
                                <p class="text-slate-600 leading-relaxed text-[11px]">
                                    Fitur penting mengalami malfungsi atau validasi error, namun pengguna masih bisa menggunakan fungsi lain atau ada workaround.
                                </p>
                            </div>

                            <div class="p-3.5 rounded-xl border border-blue-200 bg-blue-50/40">
                                <span class="inline-flex items-center gap-1 font-bold text-blue-700 mb-1">
                                    <span class="w-2 h-2 rounded-full bg-blue-500"></span> P3 - Low (Medium/Minor)
                                </span>
                                <p class="text-slate-600 leading-relaxed text-[11px]">
                                    Isu kosmetik antarmuka (UI/UX), kesalahan pengetikan (typo), alignment icon, atau usulan penyempurnaan minor.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Format Penulisan Deskripsi -->
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="text-sm font-bold text-on-surface uppercase tracking-wider flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-blue-50 text-primary flex items-center justify-center text-xs font-bold">2</span>
                                Format Deskripsi &amp; Steps to Reproduce
                            </h4>
                            <button
                                type="button"
                                onclick="applyBugTemplate(); closeGuideModal();"
                                class="text-xs px-3 py-1.5 rounded-lg bg-primary text-white hover:bg-blue-900 font-semibold flex items-center gap-1 transition-all cursor-pointer shadow-xs active:scale-95"
                            >
                                <span class="material-symbols-outlined text-[15px]">post_add</span>
                                <span>Terapkan Template</span>
                            </button>
                        </div>
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 font-mono-code text-xs text-slate-700 space-y-2">
                            <p class="font-bold text-primary">// Format standar pelaporan bug QA:</p>
                            <p><strong class="text-slate-900">[STEPS TO REPRODUCE]</strong></p>
                            <p class="text-slate-600">1. Masuk ke halaman login dengan role QA/Tester.<br/>2. Buka menu X dan pilih data Y.<br/>3. Klik tombol 'Submit' tanpa mengisi field Z.</p>
                            <p class="mt-2"><strong class="text-slate-900">[EXPECTED RESULT]</strong></p>
                            <p class="text-slate-600">- Sistem menampilkan pesan validasi "Field Wajib Diisi".</p>
                            <p class="mt-2"><strong class="text-slate-900">[ACTUAL RESULT]</strong></p>
                            <p class="text-slate-600">- Terjadi blank screen (Error 500: Undefined variable).</p>
                            <p class="mt-2"><strong class="text-slate-900">[TEST ENVIRONMENT]</strong></p>
                            <p class="text-slate-600">- Browser: Chrome v130 | OS: Windows 11 | Akun: support_dev</p>
                        </div>
                    </div>

                    <!-- 3. Ketentuan Lampiran -->
                    <div>
                        <h4 class="text-sm font-bold text-on-surface uppercase tracking-wider flex items-center gap-2 mb-3">
                            <span class="w-6 h-6 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs font-bold">3</span>
                            Ketentuan Lampiran Bukti (Attachments)
                        </h4>
                        <ul class="text-xs text-slate-600 space-y-1.5 list-disc pl-5">
                            <li>Format yang didukung: <strong>JPG, PNG, PDF</strong> dengan ukuran maksimum <strong>5 MB</strong>.</li>
                            <li>Sertakan screenshot layar penuh yang menampilkan <strong>pesan error, URL browser, atau console log</strong> terkait.</li>
                            <li>Hindari memotong screenshot terlalu kecil agar developer dapat mengidentifikasi konteks halaman.</li>
                        </ul>
                    </div>

                    <!-- 4. Deadline & SLA Pengerjaan -->
                    <div class="p-4 rounded-xl bg-amber-50/60 border border-amber-200/80 text-xs">
                        <div class="flex items-center gap-2 font-bold text-amber-900 mb-1">
                            <span class="material-symbols-outlined text-[18px] text-amber-700">timer</span>
                            <span>Pedoman Batas Waktu (Deadline) Pengerjaan:</span>
                        </div>
                        <p class="text-slate-600 leading-relaxed">
                            Tetapkan <strong>Deadline Pengerjaan</strong> yang realistis sesuai tingkat prioritas: P1 disarankan maksimal <strong>1 x 24 Jam</strong>, P2 maksimal <strong>3 Hari Kerja</strong>, dan P3 maksimal <strong>7 Hari Kerja</strong>.
                        </p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-slate-50 border-t border-slate-200 px-6 py-4 flex flex-col sm:flex-row justify-between items-center gap-3">
                    <span class="text-xs text-secondary flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px] text-primary">verified</span>
                        Standar Quality Assurance &amp; Software Testing
                    </span>
                    <div class="flex items-center gap-2">
                        <button
                            type="button"
                            onclick="applyBugTemplate(); closeGuideModal();"
                            class="px-4 py-2 rounded-xl text-primary bg-blue-100 hover:bg-blue-200 text-xs font-semibold transition-colors cursor-pointer"
                        >
                            Gunakan Template &amp; Tutup
                        </button>
                        <button
                            type="button"
                            onclick="closeGuideModal()"
                            class="px-4 py-2 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-800 text-xs font-semibold transition-colors cursor-pointer"
                        >
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function handleProjectChange(val) {
            const wrapper = document.getElementById('custom-project-wrapper');
            const input = document.getElementById('project');
            if (!wrapper || !input) return;
            if (val === 'custom') {
                wrapper.classList.remove('hidden');
                input.required = true;
                input.focus();
            } else {
                wrapper.classList.add('hidden');
                input.required = false;
                input.value = '';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const dropZone = document.getElementById('drop-zone');
            const fileInput = document.getElementById('attachment');
            const uploadPrompt = document.getElementById('upload-prompt');
            const previewCard = document.getElementById('file-preview-card');
            const previewImage = document.getElementById('preview-image');
            const previewIcon = document.getElementById('preview-icon');
            const previewFilename = document.getElementById('preview-filename');
            const previewFilesize = document.getElementById('preview-filesize');
            const removeBtn = document.getElementById('remove-file-btn');

            if (!dropZone || !fileInput) return;

            dropZone.addEventListener('click', function (e) {
                if (e.target.closest('#remove-file-btn')) return;
                fileInput.click();
            });

            fileInput.addEventListener('change', function () {
                if (fileInput.files && fileInput.files[0]) {
                    handleFile(fileInput.files[0]);
                }
            });

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    dropZone.classList.add('border-primary', 'bg-blue-50/50');
                });
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    dropZone.classList.remove('border-primary', 'bg-blue-50/50');
                });
            });

            dropZone.addEventListener('drop', function (e) {
                const dt = e.dataTransfer;
                if (dt.files && dt.files[0]) {
                    fileInput.files = dt.files;
                    handleFile(dt.files[0]);
                }
            });

            if (removeBtn) {
                removeBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    fileInput.value = '';
                    uploadPrompt.classList.remove('hidden');
                    previewCard.classList.add('hidden');
                    previewImage.classList.add('hidden');
                    previewIcon.classList.remove('hidden');
                });
            }

            function handleFile(file) {

                if (file.size > 5 * 1024 * 1024) {
                    window.showAlertModal({
                        title: 'Ukuran File Terlalu Besar',
                        message: 'Ukuran file attachment maksimum adalah 5MB. Silakan pilih file dengan ukuran yang lebih kecil.',
                        type: 'warning',
                        buttonText: 'Mengerti'
                    });
                    fileInput.value = '';
                    return;
                }

                previewFilename.textContent = file.name;
                previewFilesize.textContent = formatBytes(file.size);

                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewImage.src = e.target.result;
                        previewImage.classList.remove('hidden');
                        previewIcon.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewImage.classList.add('hidden');
                    previewIcon.classList.remove('hidden');
                }

                uploadPrompt.classList.add('hidden');
                previewCard.classList.remove('hidden');
            }

            function formatBytes(bytes, decimals = 1) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const dm = decimals < 0 ? 0 : decimals;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
            }
        });

        function openGuideModal() {
            const modal = document.getElementById('guide-modal');
            if (modal) {
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }
        }

        function closeGuideModal() {
            const modal = document.getElementById('guide-modal');
            if (modal) {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        }

        function applyBugTemplate() {
            const textarea = document.getElementById('description');
            if (!textarea) return;

            const template = `[STEPS TO REPRODUCE]
1. Masuk ke halaman ...
2. Buka menu ...
3. Lakukan aksi ...

[EXPECTED RESULT]
- Hasil yang seharusnya terjadi sesuai spesifikasi sistem.

[ACTUAL RESULT]
- Hasil atau pesan error yang sebenarnya terjadi.

[TEST ENVIRONMENT]
- Browser: Chrome / Edge
- OS: Windows
- Role / Akun: QA / Tester`;

            if (!textarea.value.trim() || confirm('Sisipkan format template standar bug ke dalam deskripsi?')) {
                textarea.value = textarea.value.trim() ? textarea.value + "\n\n" + template : template;
                textarea.focus();
            }
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeGuideModal();
            }
        });
    </script>
</body>
</html>

