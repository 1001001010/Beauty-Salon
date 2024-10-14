@extends('layouts.app')
@section('title')
    {{ config('app.APP_NAME') }} - Панель администратора
@endsection

@section('content')
    {{-- <div class="flex"> --}}
    <!-- Сайдбар с якорями -->
    <div class="w-1/4 p-4 fixeded h-full overflow-y-auto">
        <h3 class="text-lg font-semibold mb-4 text-black dark:text-white">Разделы</h3>
        <ul>
            <li><a href="#section1"
                    class="block py-2 text-black dark:text-white hover:text-blue-500 dark:hover:text-blue-400">Список
                    услуг</a></li>
            <li><a href="#section2"
                    class="block py-2 text-black dark:text-white hover:text-blue-500 dark:hover:text-blue-400">Другой
                    раздел</a></li>
        </ul>
    </div>

    <!-- Основной контент -->
    <div class="w-full ml-auto p-4">
        <div id="section1" class="grid gap-3 lg:grid-cols-1 lg:gap-8 w-full">
            <div class="lg:col-span-1 w-full">
                <div
                    class="flex flex-col items-start gap-3 h-min overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:focus-visible:ring-[#FF2D20] w-full">
                    <div class="relative flex items-center gap-6 lg:items-end w-full">
                        <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col w-full">
                            <div class="pt-3 sm:pt-5 lg:pt-0 w-full">
                                <h2 class="text-xl font-semibold text-black dark:text-white">Список услуг</h2>
                                <x-modal-new-service></x-modal-new-service>
                                <div class="w-full">
                                    @foreach ($services as $service)
                                        @component('components.service-card', [
                                            'service' => $service,
                                        ])
                                        @endcomponent
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="section2" class="lg:col-span-1 w-full">
                <div
                    class="flex flex-col items-start gap-3 h-min overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20] w-full">
                    <div class="relative flex items-center gap-6 lg:items-end w-full">
                        <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col w-full">
                            <div class="pt-3 sm:pt-5 lg:pt-0 w-full">
                                <h2 class="text-xl font-semibold text-black dark:text-white">Другой раздел</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}

    <style>
        .fixeded {
            position: fixed;
            top: 10%;
            left: 5%;
            height: 100vh;
        }
    </style>

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
@endsection
