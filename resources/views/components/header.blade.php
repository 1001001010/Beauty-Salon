<header class="items-center gap-2 py-6 w-full">
    @if (Route::has('login'))
        <nav class="flex flex-col md:flex-row justify-between">
            <div class="flex flex-col md:flex-row gap-3">
                <a href={{ route('index') }}
                    class="rounded-md px-3 py-2 text-black transition hover:text-black/70 dark:text-white dark:hover:text-white/80">
                    Главная
                </a>
                <a href="{{ route('service.index') }}"
                    class="rounded-md px-3 py-2 text-black transition hover:text-black/70 dark:text-white dark:hover:text-white/80">
                    Каталог услуг
                </a>
                <a href="{{ route('feedback.index', ['sort' => 'desc']) }}"
                    class="rounded-md px-3 py-2 text-black transition hover:text-black/70 dark:text-white dark:hover:text-white/80">
                    Отзывы
                </a>
                @auth
                    @if (Auth::user()->role == 'admin')
                        <a href="{{ route('admin') }}"
                            class="rounded-md px-3 py-2 text-black transition hover:text-black/70 dark:text-white dark:hover:text-white/80">
                            Админка
                        </a>
                    @endif
                    @if (Auth::user()->role == 'master')
                        <a href="{{ route('master.list') }}"
                            class="rounded-md px-3 py-2 text-black transition hover:text-black/70 dark:text-white dark:hover:text-white/80">
                            Записи
                        </a>
                    @endif
                @endauth
            </div>
            <div class="flex flex-col md:flex-row gap-3">
                <button id="theme-toggle" type="button"
                    class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 100 2h1z"
                            fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>
                @auth
                    <a href="{{ route('profile.index') }}"
                        class="rounded-md px-3 py-2 text-black transition hover:text-black/70 dark:text-white dark:hover:text-white/80">
                        Личный кабинет
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-black transition hover:text-black/70 dark:text-white dark:hover:text-white/80">
                        Вход
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="rounded-md px-3 py-2 text-black transition hover:text-black/70 dark:text-white dark:hover:text-white/80">
                            Регистрация
                        </a>
                    @endif
                @endauth
            </div>
        </nav>
    @endif
</header>
