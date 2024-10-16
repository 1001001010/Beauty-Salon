@extends('layouts.app')
@section('title')
    {{ config('app.APP_NAME') }} - Список услуг
@endsection

@section('content')
    <div class="flex flex-col lg:flex-row h-screen">
        <!-- Основной контент -->
        <div class="w-full p-4 flex flex-col flex-grow">
            <div class="flex-grow">
                <div id="section1" class="mb-8">
                    <div
                        class="flex flex-col items-start gap-3 h-min overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:focus-visible:ring-[#FF2D20] w-full">
                        <div class="relative flex items-center gap-6 lg:items-end w-full">
                            <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col w-full">
                                <div class="pt-3 sm:pt-5 lg:pt-0 w-full">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">Список услуг</h2>

                                    <form class="flex items-center max-w-sm pt-4" method="POST"
                                        action={{ route('search') }}>
                                        @csrf
                                        <label for="simple-search" class="sr-only">Поиск</label>
                                        <div class="relative w-full">
                                            <div
                                                class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
                                                </svg>
                                            </div>
                                            <input type="text" id="simple-search" name="word"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Введите ключевое слово" required />
                                        </div> <x-primary-button class="p-2.5 mx-2 py-2.5 h-max">
                                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                            </svg>
                                            <span class="sr-only">Искать</span>
                                        </x-primary-button>
                                    </form>

                                    <div class="w-full">
                                        @foreach ($services as $service)
                                            @component('components.service-card', [
                                                'service' => $service,
                                                'variant' => 'client',
                                                'masters' => $masters,
                                            ])
                                            @endcomponent
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
