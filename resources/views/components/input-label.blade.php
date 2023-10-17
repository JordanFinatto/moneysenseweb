@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 dark:text-gray-300 ml-2']) }}>
    {{ $value ?? $slot }}
</label>
