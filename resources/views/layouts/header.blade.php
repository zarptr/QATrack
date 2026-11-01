@php
    $currentUser = auth()->user();
    $initialNotifications = $currentUser ? $currentUser->notifications()->latest()->take(20)->get() : collect();
    $initialUnreadCount = $currentUser ? $currentUser->unreadNotifications()->count() : 0;
@endphp

<header class="h-16 fixed top-0 right-0 z-30 bg-surface border-b border-outline-variant flex justify-between items-center w-[calc(100%-260px)] px-grid-margin transition-all duration-200">
    <!-- Left Side: Search or Breadcrumb -->
    <div class="flex-1 flex items-center">
        <button id="sidebar-toggle-btn" class="text-on-surface-variant hover:text-primary transition-all p-1.5 rounded-lg hover:bg-surface-container-low mr-3 flex items-center justify-center cursor-pointer active:scale-95 duration-100" title="Toggle Sidebar">
            <span class="material-symbols-outlined text-[22px]">menu</span>
        </button>
        @if (isset($breadcrumb))
            <div class="flex items-center gap-2 text-on-surface-variant font-body-md">
                <span class="font-bold text-on-surface">{{ $breadcrumb }}</span>
            </div>
        @else
            <div class="relative w-96 focus-within:ring-2 focus-within:ring-primary rounded-md transition-all">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">search</span>
                <input class="w-full bg-surface-container-low border border-outline-variant rounded-md py-2 pl-10 pr-4 text-body-md font-body-md text-on-surface placeholder:text-outline focus:outline-none focus:border-primary" placeholder="Search across QATrack Console..." type="text"/>
            </div>
        @endif
    </div>

    <!-- Right Side: Trailing Actions -->
    <div class="flex items-center gap-5">
        <div class="flex items-center gap-2 relative">
            <!-- Notification Bell Trigger & Dropdown Container -->
            <div class="relative" id="notification-wrapper">
                <button id="notification-bell-btn" type="button" class="text-on-surface-variant hover:text-primary hover:bg-surface-container-low p-2 rounded-xl transition-all relative flex items-center justify-center cursor-pointer active:scale-95 duration-100" title="Notifikasi" aria-label="Notifikasi" aria-expanded="false">
                    <span class="material-symbols-outlined text-[24px]">notifications</span>
                    
                    <!-- Notification Badge Indicator -->
                    <span id="notification-badge" class="{{ $initialUnreadCount > 0 ? '' : 'hidden' }} absolute top-1.5 right-1.5 flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-error opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-error"></span>
                    </span>
                </button>

                <!-- Notification Dropdown Menu -->
                <div id="notification-dropdown" class="hidden absolute right-0 mt-2 w-80 sm:w-[420px] bg-surface-container-lowest border border-outline-variant rounded-2xl shadow-2xl z-50 overflow-hidden flex flex-col transition-all duration-200 origin-top-right">
                    <!-- Dropdown Header -->
                    <div class="p-4 border-b border-outline-variant/60 flex items-center justify-between bg-surface-container-low/40">
                        <div class="flex items-center gap-2">
                            <h3 class="font-headline-sm text-headline-sm text-on-surface text-base">Notifikasi</h3>
                            <span id="unread-count-pill" class="{{ $initialUnreadCount > 0 ? '' : 'hidden' }} text-[11px] font-semibold px-2 py-0.5 rounded-full bg-neutral-100 text-neutral-900 border border-neutral-200">
                                {{ $initialUnreadCount }} Baru
                            </span>
                        </div>
                        <div class="flex items-center gap-1 text-xs">
                            <button id="mark-all-read-btn" type="button" class="px-2 py-1 rounded-md text-secondary hover:text-primary hover:bg-surface-container-high transition-colors flex items-center gap-1 cursor-pointer" title="Tandai semua telah dibaca">
                                <span class="material-symbols-outlined text-[16px]">check</span>
                                <span class="hidden sm:inline">Tandai dibaca</span>
                            </button>
                            <button id="clear-all-btn" type="button" class="px-2 py-1 rounded-md text-secondary hover:text-error hover:bg-error-container/30 transition-colors flex items-center gap-1 cursor-pointer" title="Hapus semua notifikasi">
                                <span class="material-symbols-outlined text-[16px]">delete</span>
                                <span class="hidden sm:inline">Hapus</span>
                            </button>
                        </div>
                    </div>

                    <!-- Filter Tabs -->
                    <div class="flex border-b border-outline-variant/50 px-4 pt-1 bg-surface-bright text-xs">
                        <button id="tab-all" type="button" class="tab-btn active-tab py-2 px-3 border-b-2 border-primary font-semibold text-primary flex items-center gap-1.5 transition-colors cursor-pointer">
                            Semua
                            <span id="tab-all-count" class="text-[10px] px-1.5 py-0.2 rounded-full bg-surface-container text-secondary">{{ $initialNotifications->count() }}</span>
                        </button>
                        <button id="tab-unread" type="button" class="tab-btn py-2 px-3 border-b-2 border-transparent font-medium text-secondary hover:text-on-surface flex items-center gap-1.5 transition-colors cursor-pointer">
                            Belum Dibaca
                            <span id="tab-unread-count" class="text-[10px] px-1.5 py-0.2 rounded-full bg-surface-container text-secondary">{{ $initialUnreadCount }}</span>
                        </button>
                    </div>

                    <!-- Notification Items Container -->
                    <div id="notification-list" class="max-h-[360px] overflow-y-auto divide-y divide-outline-variant/30">
                        @forelse($initialNotifications as $notif)
                            @php
                                $data = $notif->data ?? [];
                                $isRead = $notif->read_at !== null;
                                $icon = $data['icon'] ?? 'notifications';
                                $badgeColor = $data['badge_color'] ?? 'primary';
                                $url = $data['url'] ?? (!empty($data['bug_id']) ? route('bugs.show', $data['bug_id']) : null);
                            @endphp
                            <div class="notification-item group relative flex items-start gap-3 p-3.5 hover:bg-surface-container-low transition-colors cursor-pointer {{ $isRead ? 'opacity-80' : 'bg-neutral-50' }}"
                                 data-id="{{ $notif->id }}"
                                 data-read="{{ $isRead ? 'true' : 'false' }}"
                                 data-url="{{ $url }}">
                                <!-- Icon Badge -->
                                <div class="shrink-0 w-9 h-9 rounded-xl flex items-center justify-center
                                    @if($badgeColor === 'error') bg-error-container text-on-error-container
                                    @elseif($badgeColor === 'emerald') bg-emerald-100 text-emerald-700
                                    @elseif($badgeColor === 'secondary') bg-secondary-container text-on-secondary-container
                                    @else bg-neutral-100 text-neutral-900 @endif">
                                    <span class="material-symbols-outlined text-[19px]">{{ $icon }}</span>
                                </div>

                                <!-- Text Details -->
                                <div class="flex-1 min-w-0 pr-6">
                                    <div class="flex items-center justify-between gap-1 mb-0.5">
                                        <p class="text-xs font-semibold text-on-surface truncate {{ $isRead ? '' : 'font-bold text-primary' }}">
                                            {{ $data['title'] ?? 'Notifikasi' }}
                                        </p>
                                    </div>
                                    <p class="text-xs text-on-surface-variant line-clamp-2 leading-relaxed">
                                        {{ $data['message'] ?? '' }}
                                    </p>
                                    <div class="flex items-center gap-2 mt-1.5 text-[11px] text-secondary">
                                        <span class="material-symbols-outlined text-[13px]">schedule</span>
                                        <span>{{ $notif->created_at ? $notif->created_at->diffForHumans() : '' }}</span>
                                    </div>
                                </div>

                                <!-- Right Actions: Unread dot & Delete button -->
                                <div class="absolute right-3 top-3.5 flex flex-col items-center gap-2">
                                    @if(!$isRead)
                                        <span class="unread-dot w-2 h-2 rounded-full bg-neutral-900 ring-2 ring-neutral-900/20"></span>
                                    @endif
                                    <button type="button" class="delete-notif-btn opacity-0 group-hover:opacity-100 p-1 text-secondary hover:text-error rounded transition-opacity" title="Hapus notifikasi" data-id="{{ $notif->id }}">
                                        <span class="material-symbols-outlined text-[15px]">close</span>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state py-12 px-6 text-center flex flex-col items-center justify-center">
                                <div class="w-12 h-12 rounded-full bg-surface-container flex items-center justify-center text-secondary mb-3">
                                    <span class="material-symbols-outlined text-[26px]">notifications_off</span>
                                </div>
                                <p class="text-sm font-semibold text-on-surface">Tidak ada notifikasi</p>
                                <p class="text-xs text-secondary mt-1">Seluruh aktivitas dan update sistem akan muncul di sini.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Dropdown Footer -->
                    <div class="p-2.5 bg-surface-container-low/60 border-t border-outline-variant/60 text-center">
                        <a href="{{ route('bugs') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-primary hover:text-primary-fixed-variant transition-colors py-1 px-3 rounded-lg hover:bg-surface-container-high">
                            <span>Buka Daftar Bug & Tiket</span>
                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>

        

        <div class="w-px h-6 bg-outline-variant"></div>

        <!-- User Profile Dropdown Container -->
        <div class="relative" id="user-profile-wrapper">
            <button id="user-profile-btn" type="button" class="flex items-center gap-2 px-2.5 py-1.5 rounded-xl hover:bg-surface-container-low transition-colors cursor-pointer active:scale-95 duration-100" title="{{ $currentUser->name }}" aria-expanded="false">
                <div class="text-right">
                    <span class="text-on-surface font-semibold text-xs block leading-tight">{{ $currentUser->name }}</span>
                    <span class="text-[10px] text-secondary font-medium uppercase tracking-wider">
                        @if($currentUser->role === 'super_admin') Super Admin
                        @elseif($currentUser->role === 'support_dev') Support / QA
                        @else Developer @endif
                    </span>
                </div>
                <span class="material-symbols-outlined text-[18px] text-secondary transition-transform duration-200" id="profile-chevron">expand_more</span>
            </button>

            <!-- User Profile Dropdown Menu -->
            <div id="user-profile-dropdown" class="hidden absolute right-0 mt-2 w-56 bg-surface-container-lowest border border-outline-variant rounded-xl shadow-xl z-50 overflow-hidden flex flex-col transition-all duration-200 origin-top-right">
                <!-- User Summary -->
                <div class="p-3.5 border-b border-outline-variant/60 bg-surface-container-low/40">
                    <p class="text-xs font-semibold text-on-surface truncate">{{ $currentUser->name }}</p>
                    <p class="text-[11px] text-secondary truncate mt-0.5">{{ $currentUser->email }}</p>
                    <div class="mt-2">
                        <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-blue-50 text-blue-900 border border-blue-200">
                            @if($currentUser->role === 'super_admin') Super Admin
                            @elseif($currentUser->role === 'support_dev') Support / QA
                            @else Developer @endif
                        </span>
                    </div>
                </div>

                <!-- Menu Links -->
                <div class="p-1.5 flex flex-col gap-0.5">
                    <a href="{{ route('settings') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs font-medium text-on-surface rounded-lg hover:bg-surface-container-high transition-colors {{ request()->routeIs('settings') ? 'bg-blue-50 font-bold text-primary' : '' }}">
                        <span class="material-symbols-outlined text-[18px] text-secondary">person</span>
                        <span>Profile</span>
                    </a>
                </div>

                <!-- Logout Link -->
                <div class="p-1.5 border-t border-outline-variant/60">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('header-logout-form').submit();" class="flex items-center gap-2.5 px-3 py-2 text-xs font-medium text-error rounded-lg hover:bg-error-container/30 transition-colors cursor-pointer">
                        <span class="material-symbols-outlined text-[18px] text-error">logout</span>
                        <span>Logout</span>
                    </a>
                    <form id="header-logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Notification & Profile Dropdown Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const bellBtn = document.getElementById('notification-bell-btn');
        const dropdown = document.getElementById('notification-dropdown');
        const badge = document.getElementById('notification-badge');
        const unreadPill = document.getElementById('unread-count-pill');
        const listContainer = document.getElementById('notification-list');
        const tabAll = document.getElementById('tab-all');
        const tabUnread = document.getElementById('tab-unread');
        const tabAllCount = document.getElementById('tab-all-count');
        const tabUnreadCount = document.getElementById('tab-unread-count');
        const markAllReadBtn = document.getElementById('mark-all-read-btn');
        const clearAllBtn = document.getElementById('clear-all-btn');

        const profileBtn = document.getElementById('user-profile-btn');
        const profileDropdown = document.getElementById('user-profile-dropdown');
        const profileChevron = document.getElementById('profile-chevron');

        const csrfToken = '{{ csrf_token() }}';
        let currentFilter = 'all';

        // Toggle user profile dropdown
        if (profileBtn && profileDropdown) {
            profileBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                const isOpen = !profileDropdown.classList.contains('hidden');
                if (isOpen) {
                    closeProfileDropdown();
                } else {
                    openProfileDropdown();
                    if (dropdown && !dropdown.classList.contains('hidden')) {
                        closeDropdown();
                    }
                }
            });

            document.addEventListener('click', function (e) {
                if (!profileDropdown.contains(e.target) && !profileBtn.contains(e.target)) {
                    closeProfileDropdown();
                }
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    closeProfileDropdown();
                }
            });
        }

        function openProfileDropdown() {
            profileDropdown.classList.remove('hidden');
            profileBtn.setAttribute('aria-expanded', 'true');
            if (profileChevron) profileChevron.style.transform = 'rotate(180deg)';
        }

        function closeProfileDropdown() {
            profileDropdown.classList.add('hidden');
            profileBtn.setAttribute('aria-expanded', 'false');
            if (profileChevron) profileChevron.style.transform = 'rotate(0deg)';
        }

        // Toggle notification dropdown open/close
        if (bellBtn && dropdown) {
            bellBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                const isOpen = !dropdown.classList.contains('hidden');
                if (isOpen) {
                    closeDropdown();
                } else {
                    openDropdown();
                    if (profileDropdown && !profileDropdown.classList.contains('hidden')) {
                        closeProfileDropdown();
                    }
                }
            });

            // Close when clicking outside
            document.addEventListener('click', function (e) {
                if (!dropdown.contains(e.target) && !bellBtn.contains(e.target)) {
                    closeDropdown();
                }
            });

            // Close on Escape key
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    closeDropdown();
                }
            });
        }

        function openDropdown() {
            dropdown.classList.remove('hidden');
            bellBtn.setAttribute('aria-expanded', 'true');
            // Refresh notifications when opened
            fetchNotifications(currentFilter);
        }

        function closeDropdown() {
            dropdown.classList.add('hidden');
            bellBtn.setAttribute('aria-expanded', 'false');
        }

        // Tab Switching
        if (tabAll && tabUnread) {
            tabAll.addEventListener('click', function () {
                switchTab('all');
            });
            tabUnread.addEventListener('click', function () {
                switchTab('unread');
            });
        }

        function switchTab(filter) {
            currentFilter = filter;
            if (filter === 'all') {
                tabAll.classList.add('border-primary', 'text-primary', 'font-semibold');
                tabAll.classList.remove('border-transparent', 'text-secondary');
                tabUnread.classList.remove('border-primary', 'text-primary', 'font-semibold');
                tabUnread.classList.add('border-transparent', 'text-secondary');
            } else {
                tabUnread.classList.add('border-primary', 'text-primary', 'font-semibold');
                tabUnread.classList.remove('border-transparent', 'text-secondary');
                tabAll.classList.remove('border-primary', 'text-primary', 'font-semibold');
                tabAll.classList.add('border-transparent', 'text-secondary');
            }
            filterVisibleItems();
        }

        function filterVisibleItems() {
            const items = listContainer.querySelectorAll('.notification-item');
            let visibleCount = 0;

            items.forEach(function (item) {
                const isRead = item.getAttribute('data-read') === 'true';
                if (currentFilter === 'unread' && isRead) {
                    item.style.display = 'none';
                } else {
                    item.style.display = 'flex';
                    visibleCount++;
                }
            });

            const emptyState = listContainer.querySelector('.empty-state');
            if (visibleCount === 0) {
                if (!emptyState) {
                    renderEmptyState();
                } else {
                    emptyState.style.display = 'block';
                }
            } else if (emptyState) {
                emptyState.style.display = 'none';
            }
        }

        function renderEmptyState() {
            const emptyHtml = `
                <div class="empty-state py-12 px-6 text-center flex flex-col items-center justify-center">
                    <div class="w-12 h-12 rounded-full bg-surface-container flex items-center justify-center text-secondary mb-3">
                        <span class="material-symbols-outlined text-[26px]">notifications_off</span>
                    </div>
                    <p class="text-sm font-semibold text-on-surface">Tidak ada notifikasi ${currentFilter === 'unread' ? 'belum dibaca' : ''}</p>
                    <p class="text-xs text-secondary mt-1">Seluruh laporan dan aktivitas akan muncul di sini.</p>
                </div>
            `;
            listContainer.insertAdjacentHTML('beforeend', emptyHtml);
        }

        // Handle item click & mark as read
        listContainer.addEventListener('click', function (e) {
            const deleteBtn = e.target.closest('.delete-notif-btn');
            if (deleteBtn) {
                e.stopPropagation();
                const notifId = deleteBtn.getAttribute('data-id');
                deleteNotification(notifId, deleteBtn.closest('.notification-item'));
                return;
            }

            const item = e.target.closest('.notification-item');
            if (item) {
                const notifId = item.getAttribute('data-id');
                const isRead = item.getAttribute('data-read') === 'true';
                const targetUrl = item.getAttribute('data-url');

                if (!isRead) {
                    markAsRead(notifId, item);
                }

                if (targetUrl && targetUrl !== '' && targetUrl !== '#') {
                    window.location.href = targetUrl;
                }
            }
        });

        // Mark single notification as read
        function markAsRead(id, itemElement) {
            fetch(`/notifications/${id}/read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (itemElement) {
                    itemElement.setAttribute('data-read', 'true');
                    itemElement.classList.add('opacity-85');
                    itemElement.classList.remove('bg-primary/[0.03]');
                    const dot = itemElement.querySelector('.unread-dot');
                    if (dot) dot.remove();
                    const title = itemElement.querySelector('.truncate');
                    if (title) {
                        title.classList.remove('font-bold', 'text-primary');
                        title.classList.add('font-semibold');
                    }
                }
                updateUnreadUI(data.unread_count);
                if (currentFilter === 'unread') {
                    filterVisibleItems();
                }
            })
            .catch(err => console.error('Error marking as read:', err));
        }

        // Mark all as read
        if (markAllReadBtn) {
            markAllReadBtn.addEventListener('click', function () {
                fetch('/notifications/read-all', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(() => {
                    const items = listContainer.querySelectorAll('.notification-item');
                    items.forEach(function (item) {
                        item.setAttribute('data-read', 'true');
                        item.classList.add('opacity-85');
                        item.classList.remove('bg-primary/[0.03]');
                        const dot = item.querySelector('.unread-dot');
                        if (dot) dot.remove();
                        const title = item.querySelector('.truncate');
                        if (title) {
                            title.classList.remove('font-bold', 'text-primary');
                            title.classList.add('font-semibold');
                        }
                    });
                    updateUnreadUI(0);
                    if (currentFilter === 'unread') {
                        filterVisibleItems();
                    }
                })
                .catch(err => console.error('Error marking all as read:', err));
            });
        }

        // Delete single notification
        function deleteNotification(id, itemElement) {
            fetch(`/notifications/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (itemElement) {
                    itemElement.remove();
                }
                updateUnreadUI(data.unread_count);
                if (tabAllCount) tabAllCount.textContent = data.total_count;
                filterVisibleItems();
            })
            .catch(err => console.error('Error deleting notification:', err));
        }

        // Clear all notifications
        if (clearAllBtn) {
            clearAllBtn.addEventListener('click', function () {
                window.showConfirmModal({
                    title: 'Hapus Semua Notifikasi',
                    message: 'Apakah Anda yakin ingin menghapus semua riwayat notifikasi?',
                    confirmText: 'Ya, Hapus Semua',
                    cancelText: 'Batal',
                    type: 'danger',
                    onConfirm: function () {
                        fetch('/notifications', {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        })
                        .then(res => res.json())
                        .then(() => {
                            listContainer.innerHTML = '';
                            renderEmptyState();
                            updateUnreadUI(0);
                            if (tabAllCount) tabAllCount.textContent = '0';
                        })
                        .catch(err => console.error('Error clearing notifications:', err));
                    }
                });
            });
        }

        // Update badge and count labels
        function updateUnreadUI(count) {
            if (badge) {
                if (count > 0) {
                    badge.classList.remove('hidden');
                } else {
                    badge.classList.add('hidden');
                }
            }
            if (unreadPill) {
                if (count > 0) {
                    unreadPill.classList.remove('hidden');
                    unreadPill.textContent = `${count} Baru`;
                } else {
                    unreadPill.classList.add('hidden');
                }
            }
            if (tabUnreadCount) {
                tabUnreadCount.textContent = count;
            }
        }

        // Fetch fresh notifications via AJAX
        function fetchNotifications(filter) {
            fetch(`/notifications?filter=${filter}`, {
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                updateUnreadUI(data.unread_count);
                if (tabAllCount) tabAllCount.textContent = data.total_count;
            })
            .catch(err => console.error('Error fetching notifications:', err));
        }

        // Poll in background every 30 seconds for new notifications
        setInterval(function () {
            fetchNotifications(currentFilter);
        }, 30000);
    });
</script>

@include('layouts.modal')

