<div class="pt-4 w-full">
    <div
        class="flex w-full items-start max-md:flex-col gap-4 rounded-lg bg-white p-2 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] duration-300 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-zinc-900 dark:ring-zinc-800 dark:focus-visible:ring-[#FF2D20] hover:text-black/70 hover:ring-black/20 dark:hover:text-white/70 dark:hover:ring-zinc-700 transition">
        <img class="object-cover w-full rounded-lg h-96 md:h-auto md:w-48" src={{ asset('storage/' . $service->photo) }}
            alt="">
        <div class="flex flex-col justify-between p-4 leading-normal w-full">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $service->name }}
            </h5>
            <p class="mb-3 font-bold text-gray-700 dark:text-gray-400">От ₽{{ $service->price }}</p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $service->description }}</p>
            @if ($variant == 'client')
                <form action={{ route() }} method="post">
                    <div class="flex flex-start gap-4">
                        <!-- Календарь -->
                        <div class="relative max-w-sm">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input datepicker id="datepicker-{{ $service->id }}" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Выберите дату">
                        </div>
                        <!-- Часы -->
                        <div class="max-w-[8rem]">
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="time" id="time"
                                    class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    min="08:00" max="21:00" value="00:00" required />
                            </div>
                        </div>
                        <!-- Кнопка -->
                        @if (count($masters) > 0)
                            <x-primary-button class="max-sm:w-full">Записаться</x-primary-button>
                        @else
                            <x-primary-button class="max-sm:w-full" disabled>Записаться</x-primary-button>
                        @endif
                    </div>
                </form>
            @else
                <div class="flex gap-4 max-sm:flex-col">
                    @component('components.modal-edit-service', [
                        'service' => $service,
                    ])
                    @endcomponent
                    {{-- <x-primary-button>Редактировать</x-primary-button> --}}
                    <form action="{{ route('service.destroy') }}" method="post" class="d-none">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                        <x-primary-button class="max-sm:w-full">Удалить</x-primary-button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
