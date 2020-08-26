@extends('layouts.app')

@section('content')

<script type="application/javascript">
    function getSubCountry(val) {
    	$.ajax({
    	type: "GET",
    	url: "{{ route('subcountries.get_by_country') }}?country=" + val,
    	success: function(data){
    		$("#subcountry").html(data);
        getLocation();
    	}
    	});
    }
    
    function getLocation(val) {
    	$.ajax({
    	type: "GET",
    	url: "{{ route('locations.get_by_subcountry') }}?subcountry=" + val,
    	success: function(data){
    		$("#location").html(data);
    	}
    	});
    }
</script>


<div class="row">
    <div class="col-lg-6 margin-tb mx-5">
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
    <div class="col-lg-6 mx-5">
      <div class="form-group">
        <strong>Location:</strong>
        <select name="country" id="country" class="form-control" onChange="getSubCountry(this.value);">
          @foreach($countries as $country)
            <option value="{{ $country }}">{{ $country }}</option>
          @endforeach
        </select>
        <select name="subcountry" id="subcountry" class="form-control" onChange="getLocation(this.value);">
        </select>
        <select name="location" id="location" class="form-control">
        </select>          
      </div>
    </div>
  </div>  
  
  <div class="row">
    <div class="col-lg-6 mx-5">
      <div class="form-group">
        <strong>Wind Speed:</strong>
        <input type="text" name="wind_speed" class="form-control">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6 mx-5">
      <div class="form-group">
        <strong>Cloud Cover:</strong>
        <input type="text" name="cloud_cover" class="form-control">
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-6 mx-5">
      <div class="form-group">
        <strong>Days Ahead:</strong>
        <input type="text" name="days_ahead" class="form-control">
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-6 mx-5">
      <div class="form-group">
        <strong>Min Hours:</strong>
        <input type="text" name="min_hours" class="form-control">
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-6 mx-5">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>

</form>


@endsection