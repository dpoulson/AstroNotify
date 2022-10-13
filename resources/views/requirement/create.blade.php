<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:bg-black dark:text-gray-200 leading-tight">
            {{ __('Requirements') }}
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-5 sm:px-6 lg:px-8">
        <p>Here you can select the details of your personal alert. Select your location, then add in the maximium wind speed (in mph), percentage of cloud cover, number of days ahead you want alerts for, and the
        minimum number of consecutive hours you want for your observations. </p>
        <p>With the days ahead, bear in mind that the higher number you put here, the less accurate the forecasts are. I recommend a max of 5 days, which should give you enough of a heads up to plan a night.
    </div>

    <div>
        <div class="max-w-3xl mx-auto py-5 sm:px-3 lg:px-4">
                <livewire:requirement-form />
        </div>
    </div>
</x-app-layout>
