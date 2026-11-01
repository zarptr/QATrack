<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>QATrack - User Management</title>
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
        .bg-surface, .bg-surface-container-lowest, .card-white { background-color: #ffffff !important; }
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
                        <h2 class="text-display-lg font-display-lg" style="color:#1e3a8a">User Management</h2>
                        <p class="text-body-md font-body-md text-on-surface-variant mt-1">Manage and provision team accounts and roles.</p>
                    </div>
                    <a href="{{ route('users.create') }}" class="text-white font-label-md text-label-md py-2.5 px-5 rounded-lg flex items-center gap-2 hover:opacity-90 active:scale-95 duration-150 shadow-[0_2px_4px_rgba(0,0,0,0.04)] cursor-pointer" style="background-color:#1e3a8a;">
                        <span class="material-symbols-outlined text-[18px]">add</span>
                        Add New User
                    </a>
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

                <!-- Data Table Container -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/80 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/80 border-b border-slate-200/80">
                                    <th class="py-3 px-4 font-label-md text-label-md text-secondary uppercase tracking-wider font-medium">User</th>
                                    <th class="py-3 px-4 font-label-md text-label-md text-secondary uppercase tracking-wider font-medium">Email</th>
                                    <th class="py-3 px-4 font-label-md text-label-md text-secondary uppercase tracking-wider font-medium">Role</th>
                                    <th class="py-3 px-4 font-label-md text-label-md text-secondary uppercase tracking-wider font-medium">Created Date</th>
                                    <th class="py-3 px-4 font-label-md text-label-md text-secondary uppercase tracking-wider font-medium text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant">
                                @forelse ($users as $user)
                                    <tr class="bg-white hover:bg-slate-50 transition-colors group">
                                        <td class="py-4 px-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-bold text-sm">
                                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                                </div>
                                                <span class="font-body-md text-body-md text-on-surface font-medium">{{ $user->name }}</span>
                                                @if (auth()->id() === $user->id)
                                                    <span class="px-2 py-0.5 rounded-full bg-primary-fixed text-on-primary-fixed text-[10px] font-bold">YOU</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="py-4 px-4 font-body-md text-body-md text-on-surface-variant">{{ $user->email }}</td>
                                        <td class="py-4 px-4">
                                            @if ($user->role === 'super_admin')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-error-container text-on-error-container font-label-md text-label-md border border-error/20">
                                                    <span class="w-2 h-2 rounded-full bg-error"></span> Super Admin
                                                </span>
                                            @elseif ($user->role === 'support_dev')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-tertiary-container text-on-tertiary-container font-label-md text-label-md border border-tertiary/20">
                                                    <span class="w-2 h-2 rounded-full bg-tertiary"></span> Support / QA
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-surface-variant text-on-surface-variant font-label-md text-label-md border border-outline-variant">
                                                    <span class="w-2 h-2 rounded-full bg-secondary"></span> Developer
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-4 font-body-md text-body-md text-on-surface-variant">{{ $user->created_at->format('M d, Y') }}</td>
                                        <td class="py-4 px-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="{{ route('users.edit', $user) }}" class="p-1 text-on-surface-variant hover:text-primary transition-colors cursor-pointer" title="Edit User">
                                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                                </a>
                                                
                                                @if (auth()->id() !== $user->id)
                                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirmModal(event, 'Apakah Anda yakin ingin menghapus user ini? Tindakan ini tidak dapat dibatalkan.', 'Hapus User', 'danger', 'Ya, Hapus');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="p-1 text-on-surface-variant hover:text-error transition-colors cursor-pointer" title="Delete User">
                                                            <span class="material-symbols-outlined text-[20px]">delete</span>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-on-surface-variant font-medium">No users found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
