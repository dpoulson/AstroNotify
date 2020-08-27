@extends('layouts.app')

@section('content')

<div class="row my-4">
  <div class="col-lg-12 mx-5">
      {{ $location->name }} (ID: {{ $location->id }})
  </div>
</div>

@foreach($forecast_data as $forecast)
  
@endforeach

@endsection