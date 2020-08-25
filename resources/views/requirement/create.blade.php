@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mx-5">
        <div class="pull-left">
            <h2>Add New Requirement</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('user.show', Auth::user()->id ) }}"> Back</a>
        </div>
    </div>
</div>

<form action="{{ route('requirement.store') }}" method="POST">
  @csrf
  
  
  <div class="row">
    <div class="col-lg-12 mx-5">
      <div class="form-group">
        <strong>Location:</strong>
        <input type="text" name="location_id" class="form-control">
      </div>
    </div>
  </div>  
  
  <div class="row">
    <div class="col-lg-12 mx-5">
      <div class="form-group">
        <strong>Wind Speed:</strong>
        <input type="text" name="wind_speed" class="form-control">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12 mx-5">
      <div class="form-group">
        <strong>Cloud Cover:</strong>
        <input type="text" name="cloud_cover" class="form-control">
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-12 mx-5">
      <div class="form-group">
        <strong>Days Ahead:</strong>
        <input type="text" name="days_ahead" class="form-control">
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-12 mx-5">
      <div class="form-group">
        <strong>Min Hours:</strong>
        <input type="text" name="min_hours" class="form-control">
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-12 mx-5">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>

</form>
@endsection