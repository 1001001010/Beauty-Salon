@extends('layouts.app')
@section('title')
    {{ config('app.APP_NAME') }} - Профиль
@endsection

@section('content')
    <div class="flex flex-col lg:flex-row h-screen">
        <!-- Сайдбар с якорями -->
        <div class="w-full lg:w-2/12 p-4 sticky top-0">
            <h3 class="text-lg font-semibold mb-4 text-black dark:text-white">Сортировка</h3>
            <ul>
                <li>
                    <a href={{ route('feedback.index', ['sort' => 'desc']) }}
                        class="block py-2 text-black dark:text-white hover:text-blue-500 dark:hover:text-blue-400">Сначала
                        новые</a>
                </li>
                <li>
                    <a href={{ route('feedback.index', ['sort' => 'asc']) }}
                        class="block py-2 text-black dark:text-white hover:text-blue-500 dark:hover:text-blue-400">Снача
                        старые</a>
                </li>
            </ul>
        </div>

        <!-- Основной контент -->
        <div id="section2" class="mb-8 w-full">
            <div
                class="flex flex-col items-start gap-3 h-min overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:focus-visible:ring-[#FF2D20] w-full">
                <div class="relative flex items-center gap-6 lg:items-end w-full">
                    <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col w-full">
                        @if (count($feedback) > 0)
                            @foreach ($feedback as $item)
                                <div class="pt-4 w-full">
                                    <div
                                        class="flex w-full items-start max-md:flex-col gap-4 rounded-lg bg-white p-2 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] duration-300 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-zinc-900 dark:ring-zinc-800 dark:focus-visible:ring-[#FF2D20] hover:text-black/70 hover:ring-black/20 dark:hover:text-white/70 dark:hover:ring-zinc-700 transition">
                                        <img class="object-cover w-full rounded-lg h-96 md:h-auto md:w-48"
                                            src="{{ asset('storage/' . $item->photo) }}" alt="Фото мастера">
                                        <div class="flex flex-col justify-between p-4 leading-normal w-full">
                                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                                {{ $item->comment }}
                                            </p>
                                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                                <b>Дата публикация:</b> {{ $item->created_at }}
                                            </p>
                                            @if (Auth::user() && $item->user->id == Auth::id())
                                                <form action="{{ route('feedback.destroy') }}" method="post"
                                                    class="d-none">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="feedback_id" value="{{ $item->id }}">
                                                    <x-primary-button class="max-md:w-full">Удалить</x-primary-button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                            @endforeach
                        @else
                            <h5>Комментариев нет!</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
