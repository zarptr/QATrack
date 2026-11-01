<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>QATrack - Edit User</title>
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
        body, main { background-color: #F8FAFF !important; margin: 0; padding: 0; }
        body { overflow-x: hidden; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="flex text-on-background font-body-md antialiased h-screen overflow-hidden" style="background-color: #F8FAFF;">
    @include('layouts.sidebar')
    <div class="flex-1 ml-sidebar-width flex flex-col h-screen relative">
        @include('layouts.header')

        <!-- Main Scrollable Area -->
        <main class="flex-1 overflow-y-auto mt-16 p-section-padding" style="background-color: #F8FAFF;">
            <div class="max-w-3xl mx-auto space-y-container-gap">
                <!-- Page Breadcrumbs & Header -->
                <div>
                    <div class="flex items-center gap-3 text-label-md font-label-md text-secondary mb-2">
                        <a class="hover:text-primary transition-colors font-medium" href="{{ route('users.index') }}">User Management</a>
                        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                        <span>Edit User</span>
                    </div>
                    <h2 class="text-display-lg font-display-lg" style="color:#1e3a8a">Edit User: {{ $user->name }}</h2>
                    <p class="text-body-md font-body-md text-on-surface-variant mt-1">Modify team member account information or rotate roles.</p>
                </div>

                <!-- Error Messages -->
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

                <!-- User Editing Card -->
                <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant p-8">
                    <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <!-- Name Input -->
                        <div class="flex flex-col gap-2">
                            <label for="name" class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Full Name</label>
                            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required class="w-full bg-surface border border-outline-variant rounded-lg py-2.5 px-4 text-body-md font-body-md text-on-surface focus:ring-2 focus:ring-primary focus:outline-none placeholder:text-outline-variant" placeholder="e.g. Luke Skywalker"/>
                        </div>

                        <!-- Email Input -->
                        <div class="flex flex-col gap-2">
                            <label for="email" class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Email Address</label>
                            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required class="w-full bg-surface border border-outline-variant rounded-lg py-2.5 px-4 text-body-md font-body-md text-on-surface focus:ring-2 focus:ring-primary focus:outline-none placeholder:text-outline-variant" placeholder="e.g. luke@jedi.com"/>
                        </div>

                        <!-- Password Input -->
                        <div class="flex flex-col gap-2">
                            <label for="password" class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Password (Optional)</label>
                            <input id="password" name="password" type="password" class="w-full bg-surface border border-outline-variant rounded-lg py-2.5 px-4 text-body-md font-body-md text-on-surface focus:ring-2 focus:ring-primary focus:outline-none placeholder:text-outline-variant" placeholder="Leave blank to keep existing password"/>
                        </div>

                        <!-- Role Select -->
                        <div class="flex flex-col gap-2">
                            <label for="role" class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Role</label>
                            <select id="role" name="role" required class="w-full bg-surface border border-outline-variant rounded-lg py-2.5 px-4 text-body-md font-body-md text-on-surface focus:ring-2 focus:ring-primary focus:outline-none">
                                <option value="developer" {{ old('role', $user->role) === 'developer' ? 'selected' : '' }}>Developer (Assigned Bugs view only)</option>
                                <option value="support_dev" {{ old('role', $user->role) === 'support_dev' ? 'selected' : '' }}>Support / QA (Report Bugs and Retest)</option>
                                <option value="super_admin" {{ old('role', $user->role) === 'super_admin' ? 'selected' : '' }}>Super Admin (Full Access & CRUD)</option>
                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-outline-variant/50">
                            <a href="{{ route('users.index') }}" class="px-5 py-2.5 border border-outline-variant rounded-lg text-on-surface hover:bg-surface-container-low transition-colors font-label-md text-label-md">
                                Cancel
                            </a>
                            <button type="submit" class="px-5 py-2.5 text-white rounded-lg hover:opacity-90" style="background-color:#1e3a8a; active:scale-[0.98] transition-all font-label-md text-label-md flex items-center gap-2 cursor-pointer shadow-sm">
                                <span class="material-symbols-outlined text-[18px]">save</span> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
