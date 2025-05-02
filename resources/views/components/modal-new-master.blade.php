<x-primary-button data-modal-target="crud-modal-master" data-modal-toggle="crud-modal-master" class="mt-4">
    Добавить
</x-primary-button>

<!-- Main modal -->
<div id="crud-modal-master" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black bg-opacity-25">
    <div class="relative p-4 w-full max-w-xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-zinc-900 dark:ring-zinc-800">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-[#f9f5f1]">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Добавление мастера
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-[#f9f5f1] hover:text-[#d6a2c1] rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="crud-modal-master">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Закрыть</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="master-form" class="p-4 md:p-5" method="POST" action={{ route('master.upload') }}
                enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="surname"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Фамилия</label>
                        <input type="text" name="surname" id="surname"
                            class="bg-[#f9f5f1] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#d6a2c1] focus:border-[#d6a2c1] block w-full p-2.5 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#d6a2c1] dark:focus:border-[#d6a2c1]"
                            placeholder="Фамилия" required>
                    </div>
                    <div class="col-span-2">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Имя</label>
                        <input type="text" name="name" id="name"
                            class="bg-[#f9f5f1] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#d6a2c1] focus:border-[#d6a2c1] block w-full p-2.5 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#d6a2c1] dark:focus:border-[#d6a2c1]"
                            placeholder="Имя" required>
                    </div>
                    <div class="col-span-2">
                        <label for="fathername"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Отчество</label>
                        <input type="text" name="fathername" id="fathername"
                            class="bg-[#f9f5f1] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#d6a2c1] focus:border-[#d6a2c1] block w-full p-2.5 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#d6a2c1] dark:focus:border-[#d6a2c1]"
                            placeholder="Отчество" required>
                    </div>

                    <div class="col-span-2">
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" id="email" name="email" placeholder="Email"
                            class="bg-[#f9f5f1] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#d6a2c1] focus:border-[#d6a2c1] block w-full p-2.5 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#d6a2c1] dark:focus:border-[#d6a2c1]"
                            required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Пароль</label>
                        <input type="password" id="password" name="password"
                            class="bg-[#f9f5f1] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#d6a2c1] focus:border-[#d6a2c1] block w-full p-2.5 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#d6a2c1] dark:focus:border-[#d6a2c1]"
                            required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <label for="password_confirmation"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Подтверждение
                            пароль</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="bg-[#f9f5f1] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#d6a2c1] focus:border-[#d6a2c1] block w-full p-2.5 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#d6a2c1] dark:focus:border-[#d6a2c1]"
                            required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="file_input">Зарузка фото</label>
                        <input name="photo" id="file_input"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-[#f9f5f1] dark:text-gray-400 focus:outline-none dark:bg-black dark:border-gray-600 dark:placeholder-gray-400"
                            type="file">
                    </div>
                </div>
                <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Выполянет услуги:</h3>
                <ul
                    class="text-sm w-full font-medium text-gray-900 bg-[#f9f5f1] border border-gray-200 rounded-lg dark:bg-black dark:border-gray-600 dark:text-white">
                    @if (count($services) > 0)
                        @foreach ($services as $item)
                            <li class="w-full border-gray-200 rounded-t-lg dark:border-gray-600">
                                <div class="flex items-center ps-3">
                                    <input id={{ $item->id }} type="checkbox" value={{ $item->id }}
                                        name='services[]'
                                        class="w-4 h-4 text-[#d6a2c1] bg-gray-100 border-gray-300 rounded focus:ring-[#d6a2c1] dark:focus:ring-[#d6a2c1] dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for={{ $item->id }}
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $item->name }}</label>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <li class="w-full border-gray-200 rounded-t-lg dark:border-gray-600">
                            <div class="flex items-center ps-3">
                                <label class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Нет
                                    доступных услуг</label>
                            </div>
                        </li>
                    @endif
                </ul>
                <div class="flex justify-end pt-4">
                    <x-primary-button>Добавить</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
