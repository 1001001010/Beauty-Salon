@extends('layouts.app')
@section('title')
    {{ config('app.APP_NAME') }} - Профиль
@endsection

@section('content')
    <div class="grid gap-3 lg:grid-cols-3 lg:gap-8">
        <div class="lg:col-span-1">
            <div
                class="flex flex-col items-start gap-3 h-min overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                <div class="relative flex items-center gap-6 lg:items-end">
                    <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col">
                        <div class="pt-3 sm:pt-5 lg:pt-0">
                            <h2 class="text-xl font-semibold text-black dark:text-white">{{ $user->name }}
                                {{ $user->surname }}
                            </h2>
                            <h2 class="text-xl font-semibold text-black dark:text-white"></h2>

                            <p class="mt-4 text-sm/relaxed">
                                Почта: {{ $user->email }}
                            </p>
                            <p class="text-sm/relaxed">
                                Дата регистрации: {{ $user->created_at }}
                            </p>
                            <div class="mt-3 flex gap-4">
                                <x-primary-button
                                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Выход
                                </x-primary-button>
                                <a href={{ route('profile.edit') }}>
                                    <x-primary-button>Редактировать</x-primary-button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div
                class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800  dark:focus-visible:ring-[#FF2D20]">
                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                    <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <g fill="#FF2D20">
                            <path
                                d="M8.75 4.5H5.5c-.69 0-1.25.56-1.25 1.25v4.75c0 .69.56 1.25 1.25 1.25h3.25c.69 0 1.25-.56 1.25-1.25V5.75c0-.69-.56-1.25-1.25-1.25Z" />
                            <path
                                d="M24 10a3 3 0 0 0-3-3h-2V2.5a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2V20a3.5 3.5 0 0 0 3.5 3.5h17A3.5 3.5 0 0 0 24 20V10ZM3.5 21.5A1.5 1.5 0 0 1 2 20V3a.5.5 0 0 1 .5-.5h14a.5.5 0 0 1 .5.5v17c0 .295.037.588.11.874a.5.5 0 0 1-.484.625L3.5 21.5ZM22 20a1.5 1.5 0 1 1-3 0V9.5a.5.5 0 0 1 .5-.5H21a1 1 0 0 1 1 1v10Z" />
                            <path
                                d="M12.751 6.047h2a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-2A.75.75 0 0 1 12 7.3v-.5a.75.75 0 0 1 .751-.753ZM12.751 10.047h2a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-2A.75.75 0 0 1 12 11.3v-.5a.75.75 0 0 1 .751-.753ZM4.751 14.047h10a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-10A.75.75 0 0 1 4 15.3v-.5a.75.75 0 0 1 .751-.753ZM4.75 18.047h7.5a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-7.5A.75.75 0 0 1 4 19.3v-.5a.75.75 0 0 1 .75-.753Z" />
                        </g>
                    </svg>
                </div>

                <div class="pt-3 sm:pt-5 w-full">
                    <h2 class="text-xl font-semibold text-black dark:text-white">История услуг</h2>
                    Предстоящие записи:
                    @foreach ($upcomingRecords as $item)
                        <div class="pt-4 w-full">
                            <div
                                class="flex w-full items-start max-md:flex-col gap-4 rounded-lg bg-white p-2 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] duration-300 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-zinc-900 dark:ring-zinc-800 dark:focus-visible:ring-[#FF2D20] hover:text-black/70 hover:ring-black/20 dark:hover:text-white/70 dark:hover:ring-zinc-700 transition">
                                <div class="flex flex-col justify-between p-4 leading-normal w-full">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        {{ $item->service->name }}
                                    </h5>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                        Дата и время: {{ $item->datetime }}
                                    </p>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                        Мастер: {{ $item->master->name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    Прошедшие записи:
                    {{-- @foreach ($pastRecords as $item)
                        <div
                            class="flex max-md:flex-col w-full items-start gap-4 rounded-lg bg-white p-2 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] duration-300 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-zinc-900 dark:ring-zinc-800 dark:focus-visible:ring-[#FF2D20] hover:text-black/70 hover:ring-black/20 dark:hover:text-white/70 dark:hover:ring-zinc-700 transition">
                            <p>{{ $item->id }}</p>
                        </div>
                    @endforeach --}}
                </div>
            </div>
        </div>
    </div>
@endsection
