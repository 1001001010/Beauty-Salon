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
