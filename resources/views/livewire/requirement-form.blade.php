<div>
    <form wire:submit.prevent="save">
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
        <select name="location_id" id="location_id" class="form-control">
        </select>          
      </div>
    </div>
  </div>  
  
  <div class="row">
    <div class="col-lg-6 mx-5">
      <div class="form-group">
        <label for="wind_speed">Wind Speed (mph):</label>
        <input type="number" name="wind_speed" id="wind_speed" class="form-control" wire:model="wind_speed">
        @error('wind_speed') <span class="text-danger">{{ $message }}</span> @enderror
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6 mx-5">
      <div class="form-group">
      <label for="cloud_cover">Cloud Cover (%):</label>
        <input type="number" name="cloud_cover" id="cloud_cover" class="form-control" wire:model="cloud_cover">
        @error('cloud_cover') <span class="text-danger">{{ $message }}</span> @enderror
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-6 mx-5">
      <div class="form-group">
        <label for="days_ahead">Days Ahead:</label>
        <input type="number" name="days_ahead" id="days_ahead" class="form-control" wire:model="days_ahead">
        @error('days_ahead') <span class="text-danger">{{ $message }}</span> @enderror
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-6 mx-5">
      <div class="form-group">
        <label for="min_hours">Min Hours:</label>
        <input type="number" name="min_hours" id="min_hours" class="form-control" wire:model="min_hours">
        @error('min_hours') <span class="text-danger">{{ $message }}</span> @enderror
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-6 mx-5">
      <x-jet-button type="submit" class="btn btn-primary">Submit</x-jet-button>
    </div>
  </div>

    </form>
</div>
