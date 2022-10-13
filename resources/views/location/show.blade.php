<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:bg-black dark:text-gray-200 leading-tight">
            {{ __('Location') }} : {{ $location->name }}, {{ $location->subcountry }}, {{ $location->country }}
        </h2>
        <h2 class="font-semibold text-xl text-gray-800 dark:bg-black dark:text-gray-200 leading-tight">
            Timezone: {{ $location->timezone }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <livewire:location-table :location="$location"/>
        </div>
    </div>
</x-app-layout>