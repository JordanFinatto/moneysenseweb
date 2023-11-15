<button {{
    $attributes->merge(
        [
            'type' => 'submit',
            'class' => 'w-full justify-center inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring transition ease-in-out duration-150'
        ]
    )}}
>
    {{ $slot }}
</button>
