<!-- Mobile Overlay Backdrop -->
<div id="sidebar-backdrop" class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-40 hidden transition-opacity"></div>

<aside id="main-sidebar" class="w-sidebar-width h-screen fixed left-0 top-0 bg-white shadow-sm z-50 lg:z-20 flex flex-col py-6 px-element-gap border-r border-outline-variant">

    <div class="mb-8 px-2 flex items-center justify-between">
        <a href="{{ route('dashboard') }}" class="flex items-center justify-center flex-1" title="QATrack">
            <img src="{{ asset('images/logo.png') }}" alt="QATrack" class="h-12 max-h-12 w-auto object-contain">
        </a>
        <button id="sidebar-close-btn" type="button" class="lg:hidden p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition-colors" title="Tutup Menu">
            <span class="material-symbols-outlined text-[20px]">close</span>
        </button>
    </div>

    @if(auth()->user()->role !== 'developer')
        <div class="mb-6 px-2 sidebar-cta-container">
            <a href="{{ route('bugs.create') }}" class="w-full font-label-md text-label-md py-3 px-4 rounded-lg flex items-center justify-center gap-2 active:scale-95 duration-150 transition-all shadow-sm cursor-pointer shrink-0" style="background-color:#1e3a8a;color:#ffffff;" onmouseover="this.style.backgroundColor='#1e40af'" onmouseout="this.style.backgroundColor='#1e3a8a'" title="Report Bug">
                <span class="material-symbols-outlined text-[18px] shrink-0">add</span>
                <span class="sidebar-text">Report Bug</span>
            </a>
        </div>
    @endif

    <nav class="flex flex-col gap-1 flex-1 overflow-y-auto">
        @if(auth()->user()->role === 'super_admin' || auth()->user()->role === 'support_dev')
            <a class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors active:scale-95 duration-150 font-body-md text-body-md {{ request()->routeIs('dashboard') ? 'font-bold bg-blue-50' : 'hover:bg-blue-50' }}" style="color:#1e3a8a;" href="{{ route('dashboard') }}" title="Dashboard">
                <span class="material-symbols-outlined shrink-0">dashboard</span>
                <span class="sidebar-text">Dashboard</span>
            </a>
        @endif
        @if(auth()->user()->role === 'super_admin')
            <a class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors active:scale-95 duration-150 font-body-md text-body-md {{ request()->routeIs('users*') ? 'font-bold bg-blue-50' : 'hover:bg-blue-50' }}" style="color:#1e3a8a;" href="{{ route('users.index') }}" title="User Management">
                <span class="material-symbols-outlined shrink-0">group</span>
                <span class="sidebar-text">User Management</span>
            </a>
        @endif
        <a class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors active:scale-95 duration-150 font-body-md text-body-md {{ request()->routeIs('projects*') ? 'font-bold bg-blue-50' : 'hover:bg-blue-50' }}" style="color:#1e3a8a;" href="{{ route('projects.index') }}" title="Projects">
            <span class="material-symbols-outlined shrink-0" style="font-variation-settings: 'FILL' {{ request()->routeIs('projects*') ? 1 : 0 }};">folder</span>
            <span class="sidebar-text">Projects</span>
        </a>
        <a class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors active:scale-95 duration-150 font-body-md text-body-md {{ request()->routeIs('bugs*') ? 'font-bold bg-blue-50' : 'hover:bg-blue-50' }}" style="color:#1e3a8a;" href="{{ route('bugs') }}" title="Bugs">
            <span class="material-symbols-outlined shrink-0" style="font-variation-settings: 'FILL' {{ request()->routeIs('bugs*') ? 1 : 0 }};">bug_report</span>
            <span class="sidebar-text">Bugs</span>
        </a>
        @if(auth()->user()->role === 'super_admin' || auth()->user()->role === 'support_dev')
            <a class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors active:scale-95 duration-150 font-body-md text-body-md {{ request()->routeIs('reports') ? 'font-bold bg-blue-50' : 'hover:bg-blue-50' }}" style="color:#1e3a8a;" href="{{ route('reports') }}" title="Reports">
                <span class="material-symbols-outlined shrink-0">assessment</span>
                <span class="sidebar-text">Reports</span>
            </a>
        @endif
    </nav>
</aside>

<style>
    /* Transition rules */
    #main-sidebar, .ml-sidebar-width, header {
        transition: width 0.25s cubic-bezier(0.4, 0, 0.2, 1),
                    margin-left 0.25s cubic-bezier(0.4, 0, 0.2, 1),
                    left 0.25s cubic-bezier(0.4, 0, 0.2, 1),
                    transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Mobile & Tablet Styles (< 1024px) */
    @media (max-width: 1023px) {
        #main-sidebar {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            bottom: 0 !important;
            height: 100vh !important;
            width: 260px !important;
            transform: translateX(-100%);
            z-index: 50 !important;
        }

        body.mobile-sidebar-open #main-sidebar {
            transform: translateX(0) !important;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.25);
        }

        body.mobile-sidebar-open #sidebar-backdrop {
            display: block !important;
        }

        .ml-sidebar-width {
            margin-left: 0 !important;
            width: 100% !important;
        }

        header {
            left: 0 !important;
            width: 100% !important;
        }
    }

    /* Small Mobile Screen Optimizations (< 768px) */
    @media (max-width: 767px) {
        .p-section-padding {
            padding: 16px !important;
        }
        .p-container-gap {
            padding: 16px !important;
        }
        .gap-container-gap {
            gap: 16px !important;
        }
        .mb-container-gap {
            margin-bottom: 16px !important;
        }
        .text-display-lg {
            font-size: 22px !important;
            line-height: 28px !important;
        }
        .text-headline-sm {
            font-size: 16px !important;
            line-height: 22px !important;
        }
    }

    /* Desktop & Laptop Styles (>= 1024px) */
    @media (min-width: 1024px) {
        #sidebar-backdrop {
            display: none !important;
        }

        #main-sidebar {
            transform: translateX(0) !important;
        }

        .sidebar-collapsed #main-sidebar {
            width: 72px !important;
        }

        .sidebar-collapsed .sidebar-text,
        .sidebar-collapsed .sidebar-brand-text {
            opacity: 0;
            display: none !important;
        }

        .sidebar-collapsed #main-sidebar nav a,
        .sidebar-collapsed #main-sidebar .mt-auto a {
            justify-content: center !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .sidebar-collapsed #main-sidebar .mb-8 {
            justify-content: center !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .sidebar-collapsed #main-sidebar img {
            max-width: 36px !important;
            height: auto !important;
        }

        .sidebar-collapsed #main-sidebar .sidebar-cta-container {
            padding-left: 0 !important;
            padding-right: 0 !important;
            display: flex;
            justify-content: center;
        }

        .sidebar-collapsed #main-sidebar .sidebar-cta-container a {
            width: 40px !important;
            height: 40px !important;
            padding: 0 !important;
            border-radius: 9999px !important;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-collapsed .ml-sidebar-width {
            margin-left: 72px !important;
        }

        .sidebar-collapsed header {
            width: calc(100% - 72px) !important;
            left: 72px !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('sidebar-toggle-btn');
        const closeBtn = document.getElementById('sidebar-close-btn');
        const backdrop = document.getElementById('sidebar-backdrop');

        function isMobile() {
            return window.innerWidth < 1024;
        }

        if (toggleBtn) {
            toggleBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                if (isMobile()) {
                    document.body.classList.toggle('mobile-sidebar-open');
                } else {
                    document.body.classList.toggle('sidebar-collapsed');
                    localStorage.setItem('sidebar-collapsed', document.body.classList.contains('sidebar-collapsed'));
                }
            });
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                document.body.classList.remove('mobile-sidebar-open');
            });
        }

        if (backdrop) {
            backdrop.addEventListener('click', function() {
                document.body.classList.remove('mobile-sidebar-open');
            });
        }

        // Close mobile drawer when clicking a navigation link
        const navLinks = document.querySelectorAll('#main-sidebar nav a');
        navLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                if (isMobile()) {
                    document.body.classList.remove('mobile-sidebar-open');
                }
            });
        });

        // Reset mobile drawer on window resize
        window.addEventListener('resize', function() {
            if (!isMobile()) {
                document.body.classList.remove('mobile-sidebar-open');
            }
        });

        if (!isMobile() && localStorage.getItem('sidebar-collapsed') === 'true') {
            document.body.classList.add('sidebar-collapsed');
        }
    });
</script>
