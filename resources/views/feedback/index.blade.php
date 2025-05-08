@extends('layouts.app')
@section('title')
    {{ config('app.APP_NAME') }} - Отзывы
@endsection

@section('content')
    <div class="min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Отзывы наших клиентов</h1>
                <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">Узнайте, что говорят о нас наши клиенты</p>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Сайдбар с сортировкой -->
                <div class="w-full lg:w-1/4 xl:w-1/5">
                    <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-sm p-6 sticky top-24">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-mauve" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                            </svg>
                            Сортировка
                        </h3>
                        <div class="space-y-1">
                            <a href={{ route('feedback.index', ['sort' => 'desc']) }}
                                class="block py-2 px-3 rounded-md text-gray-700 dark:text-gray-300 hover:bg-cream hover:text-mauve dark:hover:bg-gray-800 dark:hover:text-white transition-colors duration-200 {{ request()->get('sort') == 'desc' || !request()->has('sort') ? 'bg-cream text-mauve dark:bg-gray-800 dark:text-white font-medium' : '' }}">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                    </svg>
                                    Сначала новые
                                </div>
                            </a>
                            <a href={{ route('feedback.index', ['sort' => 'asc']) }}
                                class="block py-2 px-3 rounded-md text-gray-700 dark:text-gray-300 hover:bg-cream hover:text-mauve dark:hover:bg-gray-800 dark:hover:text-white transition-colors duration-200 {{ request()->get('sort') == 'asc' ? 'bg-cream text-mauve dark:bg-gray-800 dark:text-white font-medium' : '' }}">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                    </svg>
                                    Сначала старые
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Основной контент -->
                <div class="w-full lg:w-3/4 xl:w-4/5">
                    @if (count($feedback) > 0)
                        <div class="grid grid-cols-1 gap-6">
                            @foreach ($feedback as $item)
                                <div
                                    class="bg-white dark:bg-zinc-900 rounded-lg shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
                                    <div class="flex flex-col md:flex-row">
                                        <div class="md:w-1/3 lg:w-1/4 relative">
                                            <img class="w-full h-64 md:h-full object-cover"
                                                src="{{ asset('storage/' . $item->photo) }}" alt="Фото к отзыву">
                                            <div
                                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4 md:hidden">
                                                <div class="flex items-center">
                                                    <div class="ml-3">
                                                        <p class="text-sm font-medium text-white">
                                                            {{ $item->user->name ?? 'Пользователь' }}</p>
                                                        <p class="text-xs text-gray-300">
                                                            {{ $item->created_at->format('d.m.Y H:i') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="md:w-2/3 lg:w-3/4 p-6">
                                            <div class="flex items-center mb-4 hidden md:flex">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                        {{ $item->user->name ?? 'Пользователь' }}</p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                                        {{ $item->created_at->format('d.m.Y H:i') }}</p>
                                                </div>
                                            </div>

                                            <div class="prose prose-sm max-w-none dark:prose-invert mb-4">
                                                <div class="flex items-center mb-2">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $item->rating)
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20"
                                                                fill="currentColor">
                                                                <path
                                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                            </svg>
                                                        @else
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="h-4 w-4 text-gray-300 dark:text-gray-600"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path
                                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                            </svg>
                                                        @endif
                                                    @endfor
                                                    <span
                                                        class="ml-1 text-xs text-gray-500 dark:text-gray-400">({{ $item->rating }}/5)</span>
                                                </div>
                                                <p class="text-gray-700 dark:text-gray-300">{{ $item->comment }}</p>
                                            </div>

                                            <div
                                                class="flex items-center justify-between mt-6 pt-4 border-t border-gray-100 dark:border-gray-800">
                                                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    <span>{{ $item->created_at->diffForHumans() }}</span>
                                                </div>

                                                @if (Auth::user() && $item->user->id == Auth::id())
                                                    <div class="flex space-x-2">
                                                        {{-- <a href="{{ route('feedback.edit', $item->id) }}" --}}
                                                        <a href="/"
                                                            class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve dark:bg-zinc-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-zinc-700">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                            Изменить
                                                        </a>

                                                        <form action="{{ route('feedback.destroy') }}" method="post"
                                                            class="inline">
                                                            @csrf
                                                            @method('delete')
                                                            <input type="hidden" name="feedback_id"
                                                                value="{{ $item->id }}">
                                                            <button type="submit"
                                                                class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-xs font-medium rounded text-red-600 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:bg-zinc-800 dark:border-gray-700 dark:text-red-400 dark:hover:bg-red-900/20">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="h-3.5 w-3.5 mr-1" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                                Удалить
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Пагинация -->
                        @if ($feedback instanceof \Illuminate\Pagination\LengthAwarePaginator && $feedback->hasPages())
                            <div class="mt-6">
                                <div
                                    class="bg-white dark:bg-zinc-900 px-4 py-3 flex items-center justify-between border-t border-gray-200 dark:border-gray-800 sm:px-6 rounded-lg shadow-sm">
                                    <div class="flex-1 flex justify-between sm:hidden">
                                        @if ($feedback->onFirstPage())
                                            <span
                                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-400 bg-gray-50 cursor-not-allowed dark:bg-zinc-800 dark:border-gray-700 dark:text-gray-500">
                                                Предыдущая
                                            </span>
                                        @else
                                            <a href="{{ $feedback->previousPageUrl() }}"
                                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-zinc-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-zinc-700">
                                                Предыдущая
                                            </a>
                                        @endif

                                        @if ($feedback->hasMorePages())
                                            <a href="{{ $feedback->nextPageUrl() }}"
                                                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-zinc-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-zinc-700">
                                                Следующая
                                            </a>
                                        @else
                                            <span
                                                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-400 bg-gray-50 cursor-not-allowed dark:bg-zinc-800 dark:border-gray-700 dark:text-gray-500">
                                                Следующая
                                            </span>
                                        @endif
                                    </div>
                                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                        <div>
                                            <p class="text-sm text-gray-700 dark:text-gray-300">
                                                Показано с <span class="font-medium">{{ $feedback->firstItem() }}</span>
                                                по <span class="font-medium">{{ $feedback->lastItem() }}</span> из <span
                                                    class="font-medium">{{ $feedback->total() }}</span> отзывов
                                            </p>
                                        </div>
                                        <div>
                                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                                aria-label="Pagination">
                                                <!-- Предыдущая страница -->
                                                @if ($feedback->onFirstPage())
                                                    <span
                                                        class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-300 cursor-not-allowed dark:bg-zinc-800 dark:border-gray-700 dark:text-gray-600">
                                                        <span class="sr-only">Предыдущая</span>
                                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </span>
                                                @else
                                                    <a href="{{ $feedback->previousPageUrl() }}"
                                                        class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 dark:bg-zinc-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-zinc-700">
                                                        <span class="sr-only">Предыдущая</span>
                                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </a>
                                                @endif

                                                <!-- Номера страниц -->
                                                @for ($i = 1; $i <= $feedback->lastPage(); $i++)
                                                    @if ($i == $feedback->currentPage())
                                                        <span
                                                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-cream text-sm font-medium text-mauve dark:bg-gray-700 dark:text-white dark:border-gray-600">{{ $i }}</span>
                                                    @else
                                                        <a href="{{ $feedback->url($i) }}"
                                                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 dark:bg-zinc-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-zinc-700">{{ $i }}</a>
                                                    @endif
                                                @endfor

                                                <!-- Следующая страница -->
                                                @if ($feedback->hasMorePages())
                                                    <a href="{{ $feedback->nextPageUrl() }}"
                                                        class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 dark:bg-zinc-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-zinc-700">
                                                        <span class="sr-only">Следующая</span>
                                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </a>
                                                @else
                                                    <span
                                                        class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-300 cursor-not-allowed dark:bg-zinc-800 dark:border-gray-700 dark:text-gray-600">
                                                        <span class="sr-only">Следующая</span>
                                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </span>
                                                @endif
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-sm p-12 text-center">
                            <div class="flex flex-col items-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-16 w-16 text-gray-300 dark:text-gray-600 mb-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                                <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-2">Отзывов пока нет</h3>
                                <p class="text-gray-500 dark:text-gray-400 mb-6">Будьте первым, кто оставит отзыв о нашем
                                    салоне!</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
