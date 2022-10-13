<div>
    @php
        $results = 0;
    @endphp
    @foreach($requirements as $requirement)
        @if ($requirement->clearSkies() != NULL)
            @php
                $results++
            @endphp 
            <li>{{ $requirement->clearSkies()[0]['hours']}} hour(s) at {{ $requirement->clearSkies()[0]['start_time']}}. Location: {{ $requirement->location->name }}
        @endif
    @endforeach
    @if ( $results == 0 )
        No results. :(
    @endif
</div>
