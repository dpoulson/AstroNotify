<div>
        @if ($requirements->count())
        <table class="table-auto">
            <thead>
                <tr>
                    <th>Location</th>
                    <th>Wind Speed</th>
                    <th>Cloud Cover</th>
                    <th>Days Ahead</th>
                    <th>Min Hours</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requirements as $requirement)
                    <tr>
                        <td>{{ $requirement->location->name }}</td>
                        <td>{{ $requirement->wind_speed }}</td>
                        <td>{{ $requirement->cloud_cover }}</td>
                        <td>{{ $requirement->days_ahead }}</td>
                        <td>{{ $requirement->min_hours }}</td>
                        <td>
                        <x-action-link href="{{ route('dashboard', ['requirement' => $requirement]) }}">
                            Edit
                            </x-action-link>
                        </td>
                        <td>
                        <x-jet-danger-button wire:click="confirmDelete({{ $requirement->id }})" wire:loading.attr="disabled">
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
  
</div>
