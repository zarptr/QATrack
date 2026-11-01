<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>QATrack - Account Settings</title>
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
        body, main { background-color: #F8FAFF !important; margin: 0; padding: 0; }
        body { overflow-x: hidden; }
        .bg-surface, .bg-surface-container-lowest, .card-white { background-color: #ffffff !important; }
        .custom-shadow {
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
        }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="flex text-on-background font-body-md antialiased h-screen overflow-hidden" style="background-color: #F8FAFF;">
    @include('layouts.sidebar')
    <div class="flex-1 ml-sidebar-width flex flex-col h-screen relative">
        @include('layouts.header')

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto mt-16 p-section-padding" style="background-color: #F8FAFF;">
            <div class="max-w-7xl mx-auto space-y-container-gap">
                <!-- Page Header -->
                <div class="mb-8">
                    <h2 class="text-display-lg font-display-lg" style="color:#1e3a8a">Account Settings</h2>
                    <p class="text-body-md font-body-md text-secondary mt-1">Manage your profiles, change passwords, and configure account parameters.</p>
                </div>

                <!-- Toast Notifications -->
                @if (session('status') === 'profile-updated')
                    <div class="mb-6 p-4 bg-primary-container/10 border border-primary/20 text-primary text-xs rounded-xl flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">check_circle</span>
                        <span class="font-medium">Profile information updated successfully.</span>
                    </div>
                @endif

                @if (session('status') === 'password-updated')
                    <div class="mb-6 p-4 bg-primary-container/10 border border-primary/20 text-primary text-xs rounded-xl flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">check_circle</span>
                        <span class="font-medium">Password updated successfully.</span>
                    </div>
                @endif

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

                <!-- Layout Split columns -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-container-gap">
                    <!-- Profile Details -->
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200/80 p-6 flex flex-col justify-between">
                        <div>
                            <h3 class="text-headline-sm font-headline-sm text-on-surface mb-2">Profile Information</h3>
                            <p class="text-body-md text-secondary mb-6">Update your account's profile information and email address.</p>
                            
                            <form action="{{ route('settings.profile.update') }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PATCH')
                                
                                <div>
                                    <label class="block font-label-md text-label-md text-on-surface mb-2" for="name">Name</label>
                                    <input 
                                        type="text" 
                                        id="name" 
                                        name="name" 
                                        value="{{ old('name', auth()->user()->name) }}" 
                                        class="w-full bg-white border border-outline-variant rounded-lg px-4 py-2 text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-shadow" 
                                        required
                                    />
                                </div>
                                
                                <div>
                                    <label class="block font-label-md text-label-md text-on-surface mb-2" for="email">Email address</label>
                                    <input 
                                        type="email" 
                                        id="email" 
                                        name="email" 
                                        value="{{ old('email', auth()->user()->email) }}" 
                                        class="w-full bg-white border border-outline-variant rounded-lg px-4 py-2 text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-shadow" 
                                        required
                                    />
                                </div>

                                <div class="pt-4">
                                    <button type="submit" class="px-5 py-2.5 text-white rounded-button" style="background-color:#1e3a8a; font-label-md text-label-md shadow-sm hover:scale-[0.98] transition-transform cursor-pointer">
                                        Update Profile
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Password Security -->
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200/80 p-6 flex flex-col justify-between">
                        <div>
                            <h3 class="text-headline-sm font-headline-sm text-on-surface mb-2">Update Password</h3>
                            <p class="text-body-md text-secondary mb-6">Ensure your account is using a long, random password to stay secure.</p>
                            
                            <form action="{{ route('settings.password.update') }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')
                                
                                <div>
                                    <label class="block font-label-md text-label-md text-on-surface mb-2" for="current_password">Current Password</label>
                                    <input 
                                        type="password" 
                                        id="current_password" 
                                        name="current_password" 
                                        class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2 text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-shadow" 
                                        required
                                    />
                                </div>
                                
                                <div>
                                    <label class="block font-label-md text-label-md text-on-surface mb-2" for="password">New Password</label>
                                    <input 
                                        type="password" 
                                        id="password" 
                                        name="password" 
                                        class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2 text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-shadow" 
                                        required
                                    />
                                </div>
                                
                                <div>
                                    <label class="block font-label-md text-label-md text-on-surface mb-2" for="password_confirmation">Confirm Password</label>
                                    <input 
                                        type="password" 
                                        id="password_confirmation" 
                                        name="password_confirmation" 
                                        class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2 text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-shadow" 
                                        required
                                    />
                                </div>

                                <div class="pt-4">
                                    <button type="submit" class="px-5 py-2.5 text-white rounded-button" style="background-color:#1e3a8a; font-label-md text-label-md shadow-sm hover:scale-[0.98] transition-transform cursor-pointer">
                                        Update Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
