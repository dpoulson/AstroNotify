Hi, {{ $user->name }}

<h2>@yield('page_title', config('app.name', 'Laravel')) - Notification</h2>

<p>There are potential good viewing nights coming up for your location ( {{ $location->name }} ): </p>

<ul>
@foreach($results as $result)
  <li>Possible clear night starting at {{ $result['start_time'] }} for {{ $result['hours'] }}.</li>  
@endforeach
</ul>

To view the raw data, <a href="{{ route('location.show',$location->id) }}">click here</a>

Forecast information provided by: <br />

<a href="https://darksky.net/poweredby/">
<img width=400 
src="https://darksky.net/dev/img/attribution/poweredby-oneline.png">
</a>
<hr>
To check your details, <a href="{{ route('user.show',$user->id) }}">click here</a><br />
