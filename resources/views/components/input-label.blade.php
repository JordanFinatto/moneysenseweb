@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-500 ml-2']) }}>
    {{ $value ?? $slot }}
</label>
