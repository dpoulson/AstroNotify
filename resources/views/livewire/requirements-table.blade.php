<div>
        @if ($requirements->count())
        <table class="min-w-max w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="p-3 p-6 text-center">Location</th>
                    <th class="p-3 p-6 text-center">Wind Speed</th>
                    <th class="p-3 p-6 text-center">Cloud Cover</th>
                    <th class="p-3 p-6 text-center">Days Ahead</th>
                    <th class="p-3 p-6 text-center">Min Hours</th>
                    <th class="p-3 p-6 text-center"></th>
                </tr>
            </thead>
            <tbody class="text-gray-300 text-sm font-light">
                @foreach ($requirements as $requirement)
                    <tr class="border-b border-gray-300 hover:bg-gray-700">
                        <td class="p-3 p-6 text-center whitespace-nowrap">
                            <a href="{{ route('location.show', ['location' => $requirement->location->id] )}}">
                                {{ $requirement->location->name }}
                            </a>
                        </td>
                        <td class="p-3 p-6 text-center whitespace-nowrap">{{ $requirement->wind_speed }}</td>
                        <td class="p-3 p-6 text-center whitespace-nowrap">{{ $requirement->cloud_cover }}</td>
                        <td class="p-3 p-6 text-center whitespace-nowrap">{{ $requirement->days_ahead }}</td>
                        <td class="p-3 p-6 text-center whitespace-nowrap">{{ $requirement->min_hours }}</td>
                        <td>
                        <x-jet-danger-button wire:click="$emit('confirmDelete', {{ $requirement->id }})" wire:loading.attr="disabled">
                            Delete
                            </x-jet-danger-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <div class="alert alert-warning">
                Your query returned zero results.
            </div>
        @endif

        <div class="float-left mt-5">
            <x-action-link href="{{ route('requirement.create') }}">Create New Requirement</x-action-link>
        </div>
  
</div>
