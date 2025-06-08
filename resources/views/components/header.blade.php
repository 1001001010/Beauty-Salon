<!-- Navigation -->
<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <span class="text-mauve font-serif text-2xl font-bold">Elegance</span>
                </div>
                <div class="hidden sm:ml-6 sm:flex">
                    <a href="{{ route('index') }}"
                        class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium {{ request()->routeIs('index') ? 'border-mauve text-gray-900' : 'border-transparent text-gray-500 hover:border-blush hover:text-gray-700' }}">
                        Главная
                    </a>
                    <a href="{{ route('service.index') }}"
                        class="ml-8 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium {{ request()->routeIs('service.index') ? 'border-mauve text-gray-900' : 'border-transparent text-gray-500 hover:border-blush hover:text-gray-700' }}">
                        Услуги
                    </a>
                    <a href="{{ route('feedback.index') }}"
                        class="ml-8 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium {{ request()->routeIs('feedback.index') ? 'border-mauve text-gray-900' : 'border-transparent text-gray-500 hover:border-blush hover:text-gray-700' }}">
                        Отзывы
                    </a>
                    @if (Auth::user() && Auth::user()->role == 'admin')
                        <a href="{{ route('admin') }}"
                            class="ml-8 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium {{ request()->routeIs('admin') ? 'border-mauve text-gray-900' : 'border-transparent text-gray-500 hover:border-blush hover:text-gray-700' }}">
                            Панель администратора
                        </a>
                    @endif
                    @if (Auth::user() && Auth::user()->role == 'master')
                        <a href="{{ route('master.list') }}"
                            class="ml-8 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium {{ request()->routeIs('admin') ? 'border-mauve text-gray-900' : 'border-transparent text-gray-500 hover:border-blush hover:text-gray-700' }}">
                            Записи
                        </a>
                    @endif
                </div>
            </div>
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                @guest
                    <a href="{{ route('login') }}"
                        class="text-gray-500 hover:text-mauve px-3 py-2 rounded-md text-sm font-medium">Вход</a>
                    <a href="{{ route('register') }}"
                        class="bg-mauve text-white hover:bg-blush px-4 py-2 rounded-md text-sm font-medium ml-3">Регистрация</a>
                @else
                    <!-- Уведомления -->
                    <div class="relative mr-3" id="notification-dropdown">
                        <button id="notification-button"
                            class="text-gray-500 hover:text-mauve p-2 rounded-md focus:outline-none">
                            <i class="fas fa-bell"></i>
                            <span id="notification-badge"
                                class="hidden absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">0</span>
                        </button>
                        <div id="notification-menu"
                            class="hidden absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg z-20">
                            <div class="p-3 border-b border-gray-200 flex justify-between items-center">
                                <h3 class="font-semibold">Уведомления</h3>
                                <button id="mark-all-read" class="text-sm text-mauve hover:underline">Отметить все как
                                    прочитанные</button>
                            </div>
                            <div id="notification-list" class="max-h-80 overflow-y-auto">
                                <div class="p-4 text-center text-gray-500" id="no-notifications">
                                    Нет новых уведомлений
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('profile.index') }}"
                        class="text-gray-500 hover:text-mauve px-3 py-2 rounded-md text-sm font-medium">Профиль</a>
                @endguest
            </div>
            <div class="-mr-2 flex items-center sm:hidden">
                <button type="button" id="mobile-menu-button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-mauve"
                    aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Мобильное меню -->
    <div class="sm:hidden hidden" id="mobile-menu">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('index') }}"
                class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('index') ? 'border-mauve text-mauve bg-cream' : 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50 hover:border-gray-300' }}">
                Главная
            </a>
            <a href="{{ route('service.index') }}"
                class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('service.index') ? 'border-mauve text-mauve bg-cream' : 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50 hover:border-gray-300' }}">
                Услуги
            </a>
            <a href="{{ route('feedback.index') }}"
                class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('feedback.index') ? 'border-mauve text-mauve bg-cream' : 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50 hover:border-gray-300' }}">
                Отзывы
            </a>
            @if (Auth::user() && Auth::user()->role == 'admin')
                <a href="{{ route('admin') }}"
                    class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('admin') ? 'border-mauve text-mauve bg-cream' : 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50 hover:border-gray-300' }}">
                    Панель администратора
                </a>
            @endif
            @if (Auth::user() && Auth::user()->role == 'master')
                <a href="{{ route('master.list') }}"
                    class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50 hover:border-gray-300">
                    Записи
                </a>
            @endif
        </div>
        <div class="pt-4 pb-3 border-t border-gray-200">
            @guest
                <div class="space-y-1">
                    <a href="{{ route('login') }}"
                        class="block pl-3 pr-4 py-2 text-base font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-50">
                        Вход
                    </a>
                    <a href="{{ route('register') }}"
                        class="block pl-3 pr-4 py-2 text-base font-medium text-white bg-mauve hover:bg-blush rounded-md mx-3">
                        Регистрация
                    </a>
                </div>
            @else
                <div class="space-y-1">
                    <a href="{{ route('profile.index') }}"
                        class="block pl-3 pr-4 py-2 text-base font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-50">
                        Профиль
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Мобильное меню
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
                mobileMenuButton.setAttribute('aria-expanded', mobileMenu.classList.contains('hidden') ?
                    'false' : 'true');
            });
        }

        @auth
        // Уведомления (существующий код)
        const notificationButton = document.getElementById('notification-button');
        const notificationMenu = document.getElementById('notification-menu');
        const notificationBadge = document.getElementById('notification-badge');
        const notificationList = document.getElementById('notification-list');
        const noNotifications = document.getElementById('no-notifications');
        const markAllReadButton = document.getElementById('mark-all-read');

        function fetchNotifications() {
            fetch('/notifications/get')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateNotifications(data.notifications, data.unread_count);
                    }
                })
                .catch(error => console.error('Ошибка при получении уведомлений:', error));
        }

        function updateNotifications(notifications, unreadCount) {
            if (unreadCount > 0) {
                notificationBadge.textContent = unreadCount;
                notificationBadge.classList.remove('hidden');
            } else {
                notificationBadge.classList.add('hidden');
            }

            notificationList.innerHTML = '';

            if (notifications.length === 0) {
                const noNotificationsClone = noNotifications.cloneNode(true);
                notificationList.appendChild(noNotificationsClone);
            } else {
                notifications.forEach(notification => {
                    const notificationItem = document.createElement('div');
                    notificationItem.className =
                        `p-3 border-b border-gray-100 ${notification.read ? 'bg-white' : 'bg-cream'}`;

                    const date = new Date(notification.created_at);
                    const formattedDate = `${date.toLocaleDateString()} ${date.toLocaleTimeString()}`;

                    notificationItem.innerHTML = `
                    <div class="flex justify-between items-start">
                        <p class="text-sm">${notification.message}</p>
                        ${!notification.read ? `
                                    <button class="mark-read-button text-xs text-mauve hover:underline" data-id="${notification.id}">
                                        Отметить как прочитанное
                                    </button>
                                ` : ''}
                    </div>
                    <p class="text-xs text-gray-500 mt-1">${formattedDate}</p>
                `;

                    notificationList.appendChild(notificationItem);
                });

                document.querySelectorAll('.mark-read-button').forEach(button => {
                    button.addEventListener('click', function() {
                        const notificationId = this.dataset.id;
                        markAsRead(notificationId);
                    });
                });
            }
        }

        function markAsRead(notificationId) {
            fetch('/notifications/mark-read', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        notification_id: notificationId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        fetchNotifications();
                    }
                });
        }

        function markAllAsRead() {
            fetch('/notifications/mark-all-read', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        fetchNotifications();
                    }
                });
        }

        notificationButton.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            notificationMenu.classList.toggle('hidden');
            if (!notificationMenu.classList.contains('hidden')) {
                fetchNotifications();
            }
        });

        markAllReadButton.addEventListener('click', function() {
            markAllAsRead();
        });

        document.addEventListener('click', function(e) {
            if (!document.getElementById('notification-dropdown').contains(e.target)) {
                notificationMenu.classList.add('hidden');
            }
        });

        fetchNotifications();
        setInterval(fetchNotifications, 30000);
    @endauth
    });
</script>
