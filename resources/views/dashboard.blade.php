<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Current Clear Skies
    </h3>
    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-black overflow-hidden shadow-xl sm:rounded-lg">
            <livewire:results-table />
            </div>
        </div>
    </div>

    <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Current Notification Requirements
    </h3>
    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-black overflow-hidden shadow-xl sm:rounded-lg">
            <livewire:requirements-table />
            </div>
        </div>
    </div>


</x-app-layout>
