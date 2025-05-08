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
                     <a href="#"
                         class="ml-8 border-transparent text-gray-500 hover:border-blush hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                         Галерея
                     </a>
                     <a href="{{ route('feedback.index') }}"
                         class="ml-8 border-transparent text-gray-500 hover:border-blush hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
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
                     <a href="{{ route('profile.index') }}"
                         class="text-gray-500 hover:text-mauve px-3 py-2 rounded-md text-sm font-medium">Профиль</a>
                 @endguest
             </div>
             <div class="-mr-2 flex items-center sm:hidden">
                 <button type="button"
                     class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-mauve"
                     aria-expanded="false">
                     <span class="sr-only">Open main menu</span>
                     <i class="fas fa-bars"></i>
                 </button>
             </div>
         </div>
     </div>
 </nav>
