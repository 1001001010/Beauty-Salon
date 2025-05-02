@extends('layouts.app')
@section('title')
    {{ config('app.APP_NAME') }} - Список услуг
@endsection

@section('content')
    @if ($errors->any())
        <div
            class="bg-red-50 border border-red-200 text-red-800 rounded-lg p-4 mb-4 dark:bg-red-900/10 dark:border-red-500/20 dark:text-red-400">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="py-10">
        <header>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold text-gray-900">Список услуг</h1>
            </div>
        </header>
        <main>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="px-4 py-8 sm:px-0">
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 flex items-center justify-between">
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Доступные услуги</h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">Выберите услугу для записи</p>
                            </div>
                            <form class="flex items-center" method="POST" action={{ route('search') }}>
                                @csrf
                                <div class="relative">
                                    <input type="text" name="word"
                                        class="bg-cream border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-mauve focus:border-mauve block w-full ps-10 p-2.5"
                                        placeholder="Поиск услуг" required />
                                </div>
                                <button type="submit"
                                    class="ml-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-mauve hover:bg-blush focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
                                    Искать
                                </button>
                            </form>
                        </div>
                        <div class="border-t border-gray-200">
                            <div class="bg-cream px-4 py-5">
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
        </main>
    </div>
@endsection
