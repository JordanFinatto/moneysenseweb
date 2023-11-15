<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="p-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-950">
                {{ __("Você esta logado!") }}
            </div>
        </div>
    </div>
</x-app-layout>
