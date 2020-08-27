@extends('layouts.app')

@section('content')

<div class="row my-4">
  <div class="col-lg-12 mx-5">
    <table>
      <tr><th>Name: </th><td>{{ $user->name }}</td></tr>
      <tr><th>Email: </th><td>{{ $user->email }}</td></tr>
    </table>
  </div>
</div>

<div class="row my-4">
  <div class="col-lg-12 mx-5">
    <table class="table table-hover">
      <tr>
        <th>Location</th>
        <th>Wind Speed</th>
        <th>Cloud Cover</th>
        <th>Days Ahead</th>
        <th>Min Hours</th>
        <th>Action</th>
      </tr>
      @foreach($user->requirement as $requirement )
      <tr>
        <td>{{ $requirement->location->name }} ( {{ $requirement->location->country }} )</td>
        <td>{{ $requirement->wind_speed }}mph</td>
        <td>{{ $requirement->cloud_cover }}%</td>
        <td>{{ $requirement->days_ahead }}</td>
        <td>{{ $requirement->min_hours }}</td>
        <td>
          <form action="{{ route('requirement.destroy',$requirement->id) }}" method="POST">
            <a class="btn btn-primary" href="{{ route('requirement.edit',$requirement->id) }}">Edit</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>

<div class="row">
  <div class="col-lg-12 mx-5">
    <a class="btn btn-success" href="{{ route('requirement.create') }}"> Create New Requirement</a>
  </div>
</div>

@endsection