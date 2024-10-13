@extends('layouts.app')
@section('title')
    {{ config('app.APP_NAME') }} - Панель администратора
@endsection

@section('content')
    <div class="grid gap-3 lg:grid-cols-1 lg:gap-8">
        <div class="lg:col-span-1">
            <div
                class="flex flex-col items-start gap-3 h-min overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:focus-visible:ring-[#FF2D20]">
                <div class="relative flex items-center gap-6 lg:items-end">
                    <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col">
                        <div class="pt-3 sm:pt-5 lg:pt-0">
                            <h2 class="text-xl font-semibold text-black dark:text-white">Список услуг</h2>
                            <x-modal-new-service></x-modal-new-service>
                            <div class="w-full">
                                <x-service-card></x-service-card>
                                <x-service-card></x-service-card>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div
                class="flex flex-col items-start gap-3 h-min overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                <div class="relative flex items-center gap-6 lg:items-end">
                    <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col">
                        <div class="pt-3 sm:pt-5 lg:pt-0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
