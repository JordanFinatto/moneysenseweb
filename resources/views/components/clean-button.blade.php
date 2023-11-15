<button {{
    $attributes->merge(
        [
            'type' => 'submit',
            'class' => 'w-full justify-center inline-flex items-center px-4 py-2 bg-neutral-100 hover:bg-neutral-200 border-1 border-gray-400 rounded-md font-semibold text-xs text-gray-600 uppercase tracking-widest focus:outline-none focus:ring transition ease-in-out duration-150'
        ]
    )}}
>
    {{ $slot }}
</button>
