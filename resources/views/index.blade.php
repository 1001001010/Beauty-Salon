@extends('layouts.app')
@section('title')
    {{ config('app.APP_NAME') }} - Главная
@endsection

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-cream">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-cream sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block">Откройте свою</span>
                            <span class="block text-mauve">естественную красоту</span>
                        </h1>
                        <p
                            class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Испытайте роскошные процедуры, которые подарят вам ощущение свежести, молодости и красоты внутри
                            и снаружи
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="mt-3 sm:mt-0">
                                <a href="#"
                                    class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-mauve bg-cream hover:bg-blush hover:text-white md:py-4 md:text-lg md:px-10">
                                    Наши услуги
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
                src="https://images.unsplash.com/photo-1560750588-73207b1ef5b8?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80"
                alt="Beauty salon">
        </div>
    </div>

    <!-- Why Choose Us Section -->
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base text-mauve font-semibold tracking-wide uppercase">Почему выбирают нас?</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Элегантность опыта
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    Мы верим в необходимость предоставления комплексного подхода к красоте, который заботится как о теле,
                    так и о душе
                </p>
            </div>

            <div class="mt-10">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="pt-6">
                        <div class="flow-root bg-cream rounded-lg px-6 pb-8 h-full">
                            <div class="-mt-6">
                                <div>
                                    <span class="inline-flex items-center justify-center p-3 bg-mauve rounded-md shadow-lg">
                                        <i class="fas fa-award text-white text-2xl"></i>
                                    </span>
                                </div>
                                <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">Премиум качество</h3>
                                <p class="mt-5 text-base text-gray-500">
                                    Мы используем только продукцию и оборудование высочайшего качества для всех наших
                                    процедур
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <div class="flow-root bg-cream rounded-lg px-6 pb-8 h-full">
                            <div class="-mt-6">
                                <div>
                                    <span class="inline-flex items-center justify-center p-3 bg-mauve rounded-md shadow-lg">
                                        <i class="fas fa-user-md text-white text-2xl"></i>
                                    </span>
                                </div>
                                <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">Экспертные специалисты
                                </h3>
                                <p class="mt-5 text-base text-gray-500">
                                    В нашей команде сертифицированные профессионалы с многолетним опытом работы в индустрии
                                    красоты
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <div class="flow-root bg-cream rounded-lg px-6 pb-8 h-full">
                            <div class="-mt-6">
                                <div>
                                    <span class="inline-flex items-center justify-center p-3 bg-mauve rounded-md shadow-lg">
                                        <i class="fas fa-heart text-white text-2xl"></i>
                                    </span>
                                </div>
                                <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">Персонализированный уход
                                </h3>
                                <p class="mt-5 text-base text-gray-500">
                                    Каждая процедура индивидуально подбирается с учётом ваших уникальных потребностей и
                                    предпочтений
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <div class="flow-root bg-cream rounded-lg px-6 pb-8 h-full">
                            <div class="-mt-6">
                                <div>
                                    <span class="inline-flex items-center justify-center p-3 bg-mauve rounded-md shadow-lg">
                                        <i class="fas fa-leaf text-white text-2xl"></i>
                                    </span>
                                </div>
                                <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">Эко-дружелюбность</h3>
                                <p class="mt-5 text-base text-gray-500">
                                    Мы стремимся использовать устойчивые, не тестируемые на животных продукты и практики
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div class="py-12 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base text-mauve font-semibold tracking-wide uppercase">Услуги</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Роскошные процедуры для вас
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    Выберите из нашего широкого ассортимента премиальных бьюти-услуг
                </p>
            </div>

            <div class="mt-10">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="pt-6">
                        <div class="flow-root bg-white rounded-lg px-6 pb-8 shadow-md h-full">
                            <div class="-mt-6">
                                <div>
                                    <span class="inline-flex items-center justify-center p-3 bg-mauve rounded-md shadow-lg">
                                        <i class="fas fa-spa text-white text-2xl"></i>
                                    </span>
                                </div>
                                <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">Уход за лицом</h3>
                                <p class="mt-5 text-base text-gray-500">
                                    Омолодите кожу с нашими премиальными процедурами для лица, подобранными в зависимости от
                                    типа вашей кожи
                                </p>
                                <a href="#" class="mt-4 inline-flex items-center text-mauve hover:text-blush">
                                    Узнать больше
                                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <div class="flow-root bg-white rounded-lg px-6 pb-8 shadow-md h-full">
                            <div class="-mt-6">
                                <div>
                                    <span class="inline-flex items-center justify-center p-3 bg-mauve rounded-md shadow-lg">
                                        <i class="fas fa-cut text-white text-2xl"></i>
                                    </span>
                                </div>
                                <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">Укладка волос</h3>
                                <p class="mt-5 text-base text-gray-500">
                                    Получите идеальный образ с помощью наших услуг по укладке волос, окрашиванию и уходу
                                </p>
                                <a href="#" class="mt-4 inline-flex items-center text-mauve hover:text-blush">
                                    Узнать больше
                                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <div class="flow-root bg-white rounded-lg px-6 pb-8 shadow-md h-full">
                            <div class="-mt-6">
                                <div>
                                    <span class="inline-flex items-center justify-center p-3 bg-mauve rounded-md shadow-lg">
                                        <i class="fas fa-hand-sparkles text-white text-2xl"></i>
                                    </span>
                                </div>
                                <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">Маникюр и педикюр</h3>
                                <p class="mt-5 text-base text-gray-500">
                                    Побалуйте свои руки и ноги нашими роскошными услугами по уходу за ногтями
                                </p>
                                <a href="#" class="mt-4 inline-flex items-center text-mauve hover:text-blush">
                                    Узнать больше
                                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <!-- Pricing Section -->
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base text-mauve font-semibold tracking-wide uppercase">Цены</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Прозрачные цены, премиальные результаты
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    Наши самые популярные услуги на первый взгляд. Свяжитесь с нами для получения полного списка цен.
                </p>
            </div>

            <div class="mt-10">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Цены на процедуры для лица -->
                    <div class="bg-cream rounded-lg overflow-hidden shadow-md">
                        <div class="px-6 py-8 bg-mauve text-white text-center">
                            <h3 class="text-2xl font-bold">Уход за лицом</h3>
                        </div>
                        <ul class="divide-y divide-gray-200">
                            <li class="px-6 py-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-900">Классический уход</span>
                                    <span class="font-medium text-mauve">$75</span>
                                </div>
                                <p class="text-sm text-gray-500">60 минут</p>
                            </li>
                            <li class="px-6 py-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-900">Антивозрастной уход</span>
                                    <span class="font-medium text-mauve">$95</span>
                                </div>
                                <p class="text-sm text-gray-500">75 минут</p>
                            </li>
                            <li class="px-6 py-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-900">Уход для увлажнения</span>
                                    <span class="font-medium text-mauve">$85</span>
                                </div>
                                <p class="text-sm text-gray-500">60 минут</p>
                            </li>
                        </ul>
                        <div class="px-6 py-4">
                            <a href="#"
                                class="block w-full text-center px-4 py-2 border border-mauve rounded-md text-mauve bg-white hover:bg-blush hover:text-white hover:border-blush">
                                Смотреть все процедуры для лица
                            </a>
                        </div>
                    </div>

                    <!-- Цены на услуги для волос -->
                    <div class="bg-cream rounded-lg overflow-hidden shadow-md">
                        <div class="px-6 py-8 bg-mauve text-white text-center">
                            <h3 class="text-2xl font-bold">Услуги для волос</h3>
                        </div>
                        <ul class="divide-y divide-gray-200">
                            <li class="px-6 py-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-900">Стрижка и укладка для женщин</span>
                                    <span class="font-medium text-mauve">$65+</span>
                                </div>
                                <p class="text-sm text-gray-500">45 минут</p>
                            </li>
                            <li class="px-6 py-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-900">Окрашивание и мелирование</span>
                                    <span class="font-medium text-mauve">$120+</span>
                                </div>
                                <p class="text-sm text-gray-500">120 минут</p>
                            </li>
                            <li class="px-6 py-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-900">Фен-укладка</span>
                                    <span class="font-medium text-mauve">$45</span>
                                </div>
                                <p class="text-sm text-gray-500">30 минут</p>
                            </li>
                        </ul>
                        <div class="px-6 py-4">
                            <a href="#"
                                class="block w-full text-center px-4 py-2 border border-mauve rounded-md text-mauve bg-white hover:bg-blush hover:text-white hover:border-blush">
                                Смотреть все услуги для волос
                            </a>
                        </div>
                    </div>

                    <!-- Цены на услуги для ногтей -->
                    <div class="bg-cream rounded-lg overflow-hidden shadow-md">
                        <div class="px-6 py-8 bg-mauve text-white text-center">
                            <h3 class="text-2xl font-bold">Услуги для ногтей</h3>
                        </div>
                        <ul class="divide-y divide-gray-200">
                            <li class="px-6 py-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-900">Классический маникюр</span>
                                    <span class="font-medium text-mauve">$35</span>
                                </div>
                                <p class="text-sm text-gray-500">30 минут</p>
                            </li>
                            <li class="px-6 py-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-900">Гель-маникюр</span>
                                    <span class="font-medium text-mauve">$50</span>
                                </div>
                                <p class="text-sm text-gray-500">45 минут</p>
                            </li>
                            <li class="px-6 py-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-900">Делюкс педикюр</span>
                                    <span class="font-medium text-mauve">$65</span>
                                </div>
                                <p class="text-sm text-gray-500">60 минут</p>
                            </li>
                        </ul>
                        <div class="px-6 py-4">
                            <a href="#"
                                class="block w-full text-center px-4 py-2 border border-mauve rounded-md text-mauve bg-white hover:bg-blush hover:text-white hover:border-blush">
                                Смотреть все услуги для ногтей
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    <!-- Meet Our Team Section -->
    <div class="py-12 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base text-mauve font-semibold tracking-wide uppercase">Наши Эксперты</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Познакомьтесь с нашей талантливой командой
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    Наши специалисты приносят годы опыта и страсти в каждую процедуру
                </p>
            </div>

            <div class="mt-10">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                    <!-- Член команды 1 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md">
                        <img class="w-full h-64 object-cover object-center"
                            src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80"
                            alt="София Уильямс">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900">София Уильямс</h3>
                            <p class="text-mauve">Мастер-стилист</p>
                            <p class="mt-3 text-gray-500 text-sm">
                                С более чем 10-летним опытом работы, София специализируется на современных техниках
                                стрижки и окрашивания волос
                            </p>
                            <div class="mt-4 flex space-x-3">
                                <a href="#" class="text-gray-400 hover:text-mauve">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-mauve">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-mauve">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Член команды 2 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md">
                        <img class="w-full h-64 object-cover object-center"
                            src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=761&q=80"
                            alt="Эмма Джонсон">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900">Эмма Джонсон</h3>
                            <p class="text-mauve">Эстетист</p>
                            <p class="mt-3 text-gray-500 text-sm">
                                Эмма — наш эксперт по уходу за кожей, специализируется на антивозрастных процедурах и
                                персонализированных программах ухода
                            </p>
                            <div class="mt-4 flex space-x-3">
                                <a href="#" class="text-gray-400 hover:text-mauve">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-mauve">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-mauve">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Член команды 3 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md">
                        <img class="w-full h-64 object-cover object-center"
                            src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=688&q=80"
                            alt="Оливия Дэвис">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900">Оливия Дэвис</h3>
                            <p class="text-mauve">Нейл-специалист</p>
                            <p class="mt-3 text-gray-500 text-sm">
                                Оливия создаёт потрясающее искусство на ногтях и предоставляет безупречные услуги маникюра и
                                педикюра
                            </p>
                            <div class="mt-4 flex space-x-3">
                                <a href="#" class="text-gray-400 hover:text-mauve">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-mauve">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-mauve">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Член команды 4 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md">
                        <img class="w-full h-64 object-cover object-center"
                            src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80"
                            alt="Изабелла Мартинес">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900">Изабелла Мартинес</h3>
                            <p class="text-mauve">Массажист</p>
                            <p class="mt-3 text-gray-500 text-sm">
                                Изабелла специализируется на терапевтических и расслабляющих массажах, которые помогают
                                вам расслабиться и восстановить силы
                            </p>
                            <div class="mt-4 flex space-x-3">
                                <a href="#" class="text-gray-400 hover:text-mauve">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-mauve">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-mauve">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Testimonials -->
    <div class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base text-mauve font-semibold tracking-wide uppercase">Отзывы</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Что говорят наши клиенты
                </p>
            </div>
            <div class="mt-10">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <div class="bg-cream p-6 rounded-lg shadow-md">
                        <div class="flex items-center mb-4">
                            <img class="h-12 w-12 rounded-full" src="https://randomuser.me/api/portraits/women/32.jpg"
                                alt="Клиент">
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-gray-900">Сара Джонсон</h4>
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 italic">"Процедура по уходу за кожей была потрясающей! Моя кожа
                            почувствовала
                            себя обновленной, а персонал был невероятно профессионален."</p>
                    </div>

                    <div class="bg-cream p-6 rounded-lg shadow-md">
                        <div class="flex items-center mb-4">
                            <img class="h-12 w-12 rounded-full" src="https://randomuser.me/api/portraits/women/44.jpg"
                                alt="Клиент">
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-gray-900">Эмили Дэвис</h4>
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 italic">"Я в восторге от моей новой прически! Стилист действительно понял,
                            чего я
                            хотела, и превзошел все мои ожидания."</p>
                    </div>

                    <div class="bg-cream p-6 rounded-lg shadow-md">
                        <div class="flex items-center mb-4">
                            <img class="h-12 w-12 rounded-full" src="https://randomuser.me/api/portraits/women/68.jpg"
                                alt="Клиент">
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-gray-900">Мишель Томпсон</h4>
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 italic">"Услуга маникюра и педикюра была такой расслабляющей. Мои ногти
                            никогда
                            не выглядели так хорошо!"</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Blog/Beauty Tips Section -->
    <div class="py-12 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base text-mauve font-semibold tracking-wide uppercase">Бьюти Блог</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Последние советы и тренды красоты
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    Оставайтесь в курсе последних советов по уходу за собой от наших экспертов
                </p>
            </div>

            <div class="mt-10">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    <!-- Статья 1 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md">
                        <img class="w-full h-48 object-cover"
                            src="https://images.unsplash.com/photo-1596178060810-72f53ce9a65c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80"
                            alt="Уход за кожей">
                        <div class="p-6">
                            <div class="text-xs text-mauve font-semibold uppercase tracking-wide">Уход за кожей</div>
                            <h3 class="mt-2 text-lg font-semibold text-gray-900">10 шагов к идеальной коже: ваш ежедневный
                                уход</h3>
                            <p class="mt-3 text-gray-500 text-sm">
                                Узнайте основные шаги для поддержания здоровой и сияющей кожи круглый год
                            </p>
                            <div class="mt-4">
                                <a href="#" class="text-mauve hover:text-blush font-medium">Читать далее →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Статья 2 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md">
                        <img class="w-full h-48 object-cover"
                            src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1469&q=80"
                            alt="Уход за волосами">
                        <div class="p-6">
                            <div class="text-xs text-mauve font-semibold uppercase tracking-wide">Уход за волосами</div>
                            <h3 class="mt-2 text-lg font-semibold text-gray-900">Как сохранить яркость окрашенных волос
                            </h3>
                            <p class="mt-3 text-gray-500 text-sm">
                                Узнайте лучшие способы поддержания цвета волос и сохранения их свежести
                            </p>
                            <div class="mt-4">
                                <a href="#" class="text-mauve hover:text-blush font-medium">Читать далее →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Статья 3 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md">
                        <img class="w-full h-48 object-cover"
                            src="https://images.unsplash.com/photo-1607779097040-26e80aa78e66?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80"
                            alt="Нейл-арт">
                        <div class="p-6">
                            <div class="text-xs text-mauve font-semibold uppercase tracking-wide">Нейл-арт</div>
                            <h3 class="mt-2 text-lg font-semibold text-gray-900">Самые горячие тренды ногтей этого сезона
                            </h3>
                            <p class="mt-3 text-gray-500 text-sm">
                                Исследуйте последние дизайны ногтей и цвета, которые популярны в этом сезоне
                            </p>
                            <div class="mt-4">
                                <a href="#" class="text-mauve hover:text-blush font-medium">Читать далее →</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-10 text-center">
                    <a href="#"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-mauve hover:bg-blush">
                        Смотреть все статьи
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                <span class="block">Готовы испытать роскошь?</span>
                <span class="block text-mauve">Запишитесь на прием сегодня.</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                    <a href="#"
                        class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-mauve hover:bg-blush">
                        Записаться
                    </a>
                </div>
                <div class="ml-3 inline-flex rounded-md shadow">
                    <a href="#"
                        class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-mauve bg-white hover:bg-cream">
                        Связаться с нами
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
