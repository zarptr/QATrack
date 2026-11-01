<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>QATrack - Report Bug</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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

    <!-- Main Content -->
    <main class="ml-sidebar-width mt-16 w-full h-[calc(100vh-64px)] overflow-y-auto p-section-padding" style="background-color: #F8FAFF;">
        <div class="max-w-4xl mx-auto">
            <div class="mb-8">
                <h2 class="text-display-lg font-display-lg" style="color:#1e3a8a">Report New Bug</h2>
                <p class="text-body-md font-body-md text-secondary mt-1">Provide detailed information to help the team reproduce and fix the issue.</p>
            </div>

            <!-- Validation Errors Block -->
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

            <!-- Form -->
            <form class="bg-white rounded-xl shadow-sm border border-slate-200/80 p-container-gap" action="{{ route('bugs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    @if($selectedProject)
                        <!-- Locked Project Folder Banner -->
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

                        <!-- Title Input Full Width -->
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
                        <!-- Title & Project Selector Grid -->
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

                    <!-- Dropdowns -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Priority -->
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-2" for="priority">Priority</label>
                            <select class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5 text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-shadow cursor-pointer" id="priority" name="priority">
                                <option value="p3" {{ old('priority') == 'p3' ? 'selected' : '' }}>P3 - Low</option>
                                <option value="p2" {{ old('priority') == 'p2' ? 'selected' : '' }}>P2 - Medium</option>
                                <option value="p1" {{ old('priority') == 'p1' ? 'selected' : '' }}>P1 - High (Critical)</option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-2" for="status">Status</label>
                            <select class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5 text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-shadow cursor-pointer" id="status" name="status">
                                <option value="new" {{ old('status', 'new') == 'new' ? 'selected' : '' }}>New</option>
                                <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="done_by_development" {{ old('status') == 'done_by_development' ? 'selected' : '' }}>Done by Development</option>
                                <option value="done_by_support_qa" {{ old('status') == 'done_by_support_qa' ? 'selected' : '' }}>Done by Support/QA</option>
                            </select>
                        </div>

                        <!-- Assignee -->
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-2" for="assignee">Assign Developer</label>
                            <select class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5 text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-shadow cursor-pointer" id="assignee" name="developer">
                                <option value="" {{ old('developer') == '' ? 'selected' : '' }}>Unassigned</option>
                                @foreach ($developers as $dev)
                                    <option value="{{ $dev->name }}" {{ old('developer') == $dev->name ? 'selected' : '' }}>{{ $dev->name }} (Developer)</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block font-label-md text-label-md text-on-surface mb-2" for="description">Description &amp; Steps to Reproduce <span class="text-error">*</span></label>
                        <textarea 
                            class="w-full bg-surface-container-lowest border rounded-lg px-4 py-3 text-body-md font-mono-code focus:outline-none focus:ring-1 transition-shadow placeholder-outline resize-y {{ $errors->has('description') ? 'border-error focus:border-error focus:ring-error/20' : 'border-outline-variant focus:border-primary focus:ring-primary' }}" 
                            id="description" 
                            name="description" 
                            placeholder="Tuliskan deskripsi dan langkah-langkah untuk mereproduksi bug..." 
                            required 
                            rows="5"
                        >{{ old('description') }}</textarea>
                    </div>

                    <!-- Attachments -->
                    <div>
                        <label class="block font-label-md text-label-md text-on-surface mb-2">Attachments</label>
                        
                        <!-- Hidden File Input -->
                        <input type="file" id="attachment" name="attachment" class="hidden" accept="image/*,.pdf,.txt,.log,.zip">

                        <!-- Drag & Drop Zone -->
                        <div id="drop-zone" class="border-2 border-dashed border-outline-variant rounded-xl p-8 flex flex-col items-center justify-center bg-surface hover:bg-surface-container-low transition-all cursor-pointer group relative">
                            <!-- Default State -->
                            <div id="upload-prompt" class="flex flex-col items-center justify-center pointer-events-none">
                                <div class="w-12 h-12 rounded-full bg-surface-container-highest flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-200">
                                    <span class="material-symbols-outlined text-primary text-[24px]">cloud_upload</span>
                                </div>
                                <p class="font-label-md text-label-md text-on-surface text-center mb-1">Drag and drop screenshots or files here</p>
                                <p class="font-body-md text-body-md text-secondary text-center">or click to browse files (Max 5MB)</p>
                            </div>

                            <!-- Selected File Preview -->
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

                <!-- Footer Buttons -->
                <div class="mt-8 pt-6 border-t border-outline-variant/30 flex justify-end gap-4">
                    <a href="{{ route('bugs') }}" class="px-6 py-2.5 rounded-button font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high transition-colors flex items-center justify-center" type="button">
                        Cancel
                    </a>
                    <button class="px-6 py-2.5 rounded-button font-label-md text-label-md text-white shadow-sm hover:opacity-90 active:scale-95 transition-all cursor-pointer" style="background-color:#1e3a8a;" type="submit">
                        Submit Bug
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- File Upload Interaction Script -->
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

            // Open file picker on click (unless clicking remove button)
            dropZone.addEventListener('click', function (e) {
                if (e.target.closest('#remove-file-btn')) return;
                fileInput.click();
            });

            // Handle file selection from picker
            fileInput.addEventListener('change', function () {
                if (fileInput.files && fileInput.files[0]) {
                    handleFile(fileInput.files[0]);
                }
            });

            // Drag & drop events
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

            // Remove selected file
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
                // Check size (Max 5MB)
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
    </script>
</body>
</html>
