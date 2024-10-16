<section class="w-1/2">
    <form method="post" action="{{ route('profile.update') }}" class="space-y-6 w-full">
        @csrf
        @method('patch')

        <div class="w-full">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Имя</label>
            <input type="text" id="name" name="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required value={{ $user->name }} />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="text" id="email" name="email"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required value={{ $user->email }} />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Сохранить') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Успешно сохранено') }}</p>
            @endif
        </div>
    </form>
</section>
