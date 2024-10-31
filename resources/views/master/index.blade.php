@extends('layouts.app')
@section('title')
    {{ config('app.APP_NAME') }} - Список записей
@endsection

@section('content')
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <caption
                class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white  dark:bg-zinc-900 dark:ring-zinc-800">
                Ваши записи
            </caption>
            <thead
                class="text-xs text-gray-700 uppercase bg-gray-50  dark:bg-zinc-900 dark:ring-zinc-800 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Клиент
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Дата и время
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                    <tr class="border-t dark:bg-zinc-900 dark:ring-zinc-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $record->client->name }} - {{ $record->client->email }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $record->datetime }}
                        </td>
                        <td class="px-6 py-4">
                            Laptop PC
                        </td>
                        <td class="px-6 py-4">
                            $1999
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
