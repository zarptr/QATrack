<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Sign In - QATrack</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "brand-primary": "#1B2CC1",
              "brand-hover": "#14219A",
              "lavender-bg": "#F1F3FA",
            },
            fontFamily: {
              sans: ["Inter", "sans-serif"],
            }
          }
        }
      }
    </script>
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .bg-soft-lavender {
            background-color: #F1F3FA;
        }
        .btn-blue-accent {
            background-color: #1B2CC1;
        }
        .btn-blue-accent:hover {
            background-color: #14219A;
        }
    </style>
</head>
<body class="h-full bg-white antialiased text-slate-900 selection:bg-[#1B2CC1]/15 selection:text-[#1B2CC1]">
    <div class="min-h-screen flex flex-col lg:flex-row">
        <!-- LEFT COLUMN: Soft Lavender (#F1F3FA) with QATrack Logo & Laptop Illustration -->
        <div class="w-full lg:w-[58%] xl:w-[60%] bg-[#F1F3FA] flex flex-col items-center justify-center p-8 sm:p-12 lg:p-14 order-1">
            <div class="w-full max-w-md lg:max-w-lg xl:max-w-xl flex flex-col items-center justify-center text-center">
                <!-- Large Prominent QATrack Logo -->
                <img 
                    src="{{ asset('images/logo.png') }}" 
                    alt="QATrack" 
                    class="h-20 sm:h-24 md:h-28 lg:h-32 w-auto object-contain mb-6 sm:mb-8 transition-transform duration-300 hover:scale-[1.02]"
                />
                
                <!-- Laptop Illustration -->
                <img 
                    src="{{ asset('images/login-illustration.png') }}" 
                    alt="QATrack Bug Tracking Illustration" 
                    class="w-full h-auto max-h-[300px] sm:max-h-[360px] lg:max-h-[420px] xl:max-h-[460px] object-contain drop-shadow-sm transition-transform duration-300 hover:scale-[1.01]"
                />
            </div>
        </div>

        <!-- RIGHT COLUMN: Pure White (#FFFFFF) with Login Card (Narrower width) -->
        <div class="w-full lg:w-[42%] xl:w-[40%] bg-white flex flex-col justify-center items-center p-6 sm:p-10 lg:p-12 order-2">
            <div class="w-full max-w-[380px] sm:max-w-[400px] py-4">
                <!-- Heading Area: Welcome! -->
                <div class="flex flex-col items-center text-center mb-8">
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-[#1B2CC1] tracking-tight mb-2">Welcome!</h1>
                    <p class="text-sm text-slate-500 leading-relaxed">Sign in to manage bugs and testing workflows.</p>
                </div>

                <!-- Flash Status Message -->
                @if (session('status'))
                    <div class="mb-5 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200/80 text-emerald-800 text-xs sm:text-sm flex items-start gap-2.5">
                        <span class="material-symbols-outlined text-[20px] text-emerald-600 shrink-0">check_circle</span>
                        <p class="font-medium pt-0.5 leading-snug">{{ session('status') }}</p>
                    </div>
                @endif

                <!-- Validation Error Message Block -->
                @if ($errors->any() && !$errors->has('reset_email') && !$errors->has('new_password'))
                    <div class="mb-5 p-3.5 rounded-xl bg-red-50 border border-red-200/80 text-red-700 text-xs sm:text-sm flex items-start gap-2.5">
                        <span class="material-symbols-outlined text-[20px] text-red-600 shrink-0">error</span>
                        <div class="flex flex-col gap-1 pt-0.5">
                            @foreach ($errors->all() as $error)
                                @if (!str_contains($error, 'reset') && !str_contains($error, 'Reset'))
                                    <p class="font-medium leading-snug">{{ $error }}</p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Form -->
                <form class="flex flex-col gap-5" action="{{ route('login') }}" method="POST">
                    @csrf
                    <!-- Email or Username Input Group -->
                    <div class="flex flex-col gap-1.5">
                        <label class="text-sm font-medium text-slate-700" for="email">Email or Username</label>
                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute left-3.5 text-slate-400 text-[20px] pointer-events-none select-none">person</span>
                            <input 
                                class="w-full h-11 pl-11 pr-4 bg-white border rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1B2CC1]/20 focus:border-[#1B2CC1] transition-all text-sm text-slate-900 placeholder:text-slate-400 {{ $errors->has('email') ? 'border-red-400 bg-red-50/20' : 'border-slate-200' }}" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                placeholder="admin@company.com or username" 
                                required 
                                type="text"
                                autocomplete="username"
                            />
                        </div>
                    </div>

                    <!-- Password Input Group -->
                    <div class="flex flex-col gap-1.5">
                        <div class="flex justify-between items-center">
                            <label class="text-sm font-medium text-slate-700" for="password">Password</label>
                            <button type="button" onclick="openForgotPasswordModal()" class="text-xs font-medium text-slate-500 hover:text-[#1B2CC1] transition-colors focus:outline-none cursor-pointer">
                                Forgot password?
                            </button>
                        </div>
                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute left-3.5 text-slate-400 text-[20px] pointer-events-none select-none">lock</span>
                            <input 
                                class="w-full h-11 pl-11 pr-11 bg-white border rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1B2CC1]/20 focus:border-[#1B2CC1] transition-all text-sm text-slate-900 placeholder:text-slate-400 {{ $errors->has('password') ? 'border-red-400 bg-red-50/20' : 'border-slate-200' }}" 
                                id="password" 
                                name="password" 
                                placeholder="••••••••" 
                                required 
                                type="password"
                                autocomplete="current-password"
                            />
                            <button 
                                type="button" 
                                id="toggle-password-btn" 
                                onclick="togglePasswordVisibility('password', 'password-eye-icon')" 
                                class="absolute right-3 text-slate-400 hover:text-slate-600 focus:outline-none p-1 flex items-center justify-center transition-colors cursor-pointer"
                                title="Show or hide password"
                                aria-label="Show or hide password"
                            >
                                <span id="password-eye-icon" class="material-symbols-outlined text-[20px] select-none">visibility</span>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me checkbox -->
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="remember" 
                            name="remember" 
                            class="h-4 w-4 text-[#1B2CC1] focus:ring-[#1B2CC1]/30 border-slate-300 rounded cursor-pointer"
                        />
                        <label for="remember" class="ml-2.5 text-sm font-normal text-slate-600 select-none cursor-pointer">Remember me</label>
                    </div>

                    <!-- Submit Button with Blue Accent -->
                    <button 
                        class="w-full h-11 mt-1 flex items-center justify-center text-white rounded-xl font-semibold text-sm shadow-md shadow-[#1B2CC1]/20 transition-all duration-150 cursor-pointer active:scale-[0.99] focus:outline-none focus:ring-2 focus:ring-[#1B2CC1]/40 btn-blue-accent" 
                        type="submit"
                    >
                        Sign In
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Forgot Password Modal Dialog -->
    <div 
        id="forgot-password-modal" 
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-xs transition-opacity duration-200 {{ ($errors->has('reset_email') || $errors->has('new_password') || session('show_reset_modal')) ? '' : 'hidden' }}"
        role="dialog"
        aria-modal="true"
        aria-labelledby="modal-title"
    >
        <div class="bg-white w-full max-w-[420px] rounded-2xl shadow-2xl border border-slate-100 p-6 sm:p-8 relative transform transition-all">
            <!-- Close Button -->
            <button 
                type="button" 
                onclick="closeForgotPasswordModal()" 
                class="absolute right-4 top-4 text-slate-400 hover:text-slate-600 p-1.5 rounded-full hover:bg-slate-100 transition-colors focus:outline-none cursor-pointer"
                aria-label="Close"
            >
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>

            <!-- Modal Header -->
            <div class="flex flex-col items-center text-center mb-6">
                <div class="w-12 h-12 rounded-full bg-[#F1F3FA] text-[#1B2CC1] flex items-center justify-center mb-3">
                    <span class="material-symbols-outlined text-[24px]">lock_reset</span>
                </div>
                <h2 id="modal-title" class="text-lg font-bold text-slate-900">Reset Password</h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Enter your registered email and set a new password for your account.</p>
            </div>

            <!-- Modal Errors -->
            @if ($errors->has('reset_email') || $errors->has('new_password'))
                <div class="mb-4 p-3 rounded-xl bg-red-50 border border-red-200/80 text-red-700 text-xs flex items-start gap-2">
                    <span class="material-symbols-outlined text-[18px] text-red-600 shrink-0">error</span>
                    <div class="flex flex-col gap-0.5">
                        @if ($errors->has('reset_email'))
                            <p class="font-medium">{{ $errors->first('reset_email') }}</p>
                        @endif
                        @if ($errors->has('new_password'))
                            <p class="font-medium">{{ $errors->first('new_password') }}</p>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Modal Form -->
            <form action="{{ route('password.reset.guest') }}" method="POST" class="flex flex-col gap-4">
                @csrf
                <!-- Email Field -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs sm:text-sm font-medium text-slate-700" for="reset_email">Registered Email</label>
                    <div class="relative flex items-center">
                        <span class="material-symbols-outlined absolute left-3.5 text-slate-400 text-[18px] pointer-events-none select-none">mail</span>
                        <input 
                            class="w-full h-10 pl-10 pr-3.5 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1B2CC1]/20 focus:border-[#1B2CC1] text-xs sm:text-sm text-slate-900 placeholder:text-slate-400" 
                            id="reset_email" 
                            name="reset_email" 
                            value="{{ old('reset_email') }}" 
                            placeholder="admin@company.com" 
                            required 
                            type="email"
                        />
                    </div>
                </div>

                <!-- New Password Field -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs sm:text-sm font-medium text-slate-700" for="new_password">New Password</label>
                    <div class="relative flex items-center">
                        <span class="material-symbols-outlined absolute left-3.5 text-slate-400 text-[18px] pointer-events-none select-none">lock</span>
                        <input 
                            class="w-full h-10 pl-10 pr-10 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1B2CC1]/20 focus:border-[#1B2CC1] text-xs sm:text-sm text-slate-900 placeholder:text-slate-400" 
                            id="new_password" 
                            name="new_password" 
                            placeholder="Min. 6 characters" 
                            required 
                            type="password"
                        />
                        <button 
                            type="button" 
                            onclick="togglePasswordVisibility('new_password', 'new-pwd-eye-icon')" 
                            class="absolute right-2.5 text-slate-400 hover:text-slate-600 focus:outline-none p-1 flex items-center justify-center cursor-pointer"
                            aria-label="Toggle password visibility"
                        >
                            <span id="new-pwd-eye-icon" class="material-symbols-outlined text-[18px]">visibility</span>
                        </button>
                    </div>
                </div>

                <!-- Confirm Password Field -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs sm:text-sm font-medium text-slate-700" for="new_password_confirmation">Confirm New Password</label>
                    <div class="relative flex items-center">
                        <span class="material-symbols-outlined absolute left-3.5 text-slate-400 text-[18px] pointer-events-none select-none">lock</span>
                        <input 
                            class="w-full h-10 pl-10 pr-10 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1B2CC1]/20 focus:border-[#1B2CC1] text-xs sm:text-sm text-slate-900 placeholder:text-slate-400" 
                            id="new_password_confirmation" 
                            name="new_password_confirmation" 
                            placeholder="Re-enter new password" 
                            required 
                            type="password"
                        />
                        <button 
                            type="button" 
                            onclick="togglePasswordVisibility('new_password_confirmation', 'confirm-pwd-eye-icon')" 
                            class="absolute right-2.5 text-slate-400 hover:text-slate-600 focus:outline-none p-1 flex items-center justify-center cursor-pointer"
                            aria-label="Toggle password confirmation visibility"
                        >
                            <span id="confirm-pwd-eye-icon" class="material-symbols-outlined text-[18px]">visibility</span>
                        </button>
                    </div>
                </div>

                <!-- Modal Action Buttons -->
                <div class="flex items-center gap-3 mt-3">
                    <button 
                        type="button" 
                        onclick="closeForgotPasswordModal()" 
                        class="w-1/2 h-10 border border-slate-200 hover:bg-slate-50 text-slate-700 font-medium text-xs sm:text-sm rounded-xl transition-colors cursor-pointer"
                    >
                        Cancel
                    </button>
                    <button 
                        type="submit" 
                        class="w-1/2 h-10 text-white font-semibold text-xs sm:text-sm rounded-xl transition-all duration-150 cursor-pointer shadow-sm shadow-[#1B2CC1]/20 btn-blue-accent"
                    >
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Interactive Scripts -->
    <script>
        function togglePasswordVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (!input || !icon) return;

            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility';
            }
        }

        function openForgotPasswordModal() {
            const modal = document.getElementById('forgot-password-modal');
            const loginEmail = document.getElementById('email');
            const resetEmail = document.getElementById('reset_email');
            
            if (loginEmail && resetEmail && !resetEmail.value && loginEmail.value) {
                resetEmail.value = loginEmail.value;
            }
            
            if (modal) {
                modal.classList.remove('hidden');
            }
        }

        function closeForgotPasswordModal() {
            const modal = document.getElementById('forgot-password-modal');
            if (modal) {
                modal.classList.add('hidden');
            }
        }

        // Close modal on Escape key press
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeForgotPasswordModal();
            }
        });

        // Close modal when clicking on backdrop
        document.getElementById('forgot-password-modal')?.addEventListener('click', function(event) {
            if (event.target === this) {
                closeForgotPasswordModal();
            }
        });
    </script>
</body>
</html>
