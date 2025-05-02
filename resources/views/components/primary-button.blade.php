<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-mauve hover:bg-blush focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve']) }}>
    {{ $slot }}
</button>
