<div class="pt-4 w-full">
    <div
        class="flex w-full items-start gap-4 rounded-lg bg-white p-2 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] duration-300 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-zinc-900 dark:ring-zinc-800 dark:focus-visible:ring-[#FF2D20] hover:text-black/70 hover:ring-black/20 dark:hover:text-white/70 dark:hover:ring-zinc-700 transition">
        <img class="object-cover w-full rounded-lg h-96 md:h-auto md:w-48" src={{ asset('storage/' . $service->photo) }}
            alt="">
        <div class="flex flex-col justify-between p-4 leading-normal w-full">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $service->name }}
            </h5>
            <p class="mb-3 font-bold text-gray-700 dark:text-gray-400">От ₽{{ $service->price }}</p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $service->description }}</p>
            <div class="flex gap-4">
                @component('components.modal-edit-service', [
                    'service' => $service,
                ])
                @endcomponent
                {{-- <x-primary-button>Редактировать</x-primary-button> --}}
                <form action="{{ route('service.destroy') }}" method="post" class="d-none">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                    <x-primary-button>Удалить</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</div>
