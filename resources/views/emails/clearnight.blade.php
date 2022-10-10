Hi, {{ $user->name }}

<h2>@yield('page_title', config('app.name', 'Laravel')) - Notification</h2>

<p>There are potential good viewing nights coming up for your location ( {{ $location->name }} ): </p>

<ul>
@foreach($results as $result)
  <li>Possible clear night starting at {{ $result['start_time'] }} for {{ $result['hours'] }} hours.</li>  
@endforeach
</ul>

To view the raw data, <a href="{{ route('location.show',$location->id) }}">click here</a>

Forecast information provided by: <a href="https://www.visualcrossing.com/">Visual Crossing</a>
<hr>
To check your details, <a href="{{ route('user.show',$user->id) }}">click here</a><br />
