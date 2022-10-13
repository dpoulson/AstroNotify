<div>
    <form wire:submit.prevent="save">
    <div class="row">
    <div class="col-lg-6 mx-5">
    <div>
    <div class="mb-3 row">

        <label for="country">Country</label>

        <div class="col-md-6">
            <select wire:model="selectedCountry" class="mt-1 block w-full dark:text-gray-800">
                <option value="" selected>Select Country</option>
                @foreach($countries as $country)
                    <option value="{{ $country }}">{{ $country }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @if (!is_null($selectedCountry))
        <div class="mb-3 row">
            <label for="state">State</label>

            <div class="col-md-6">
                <select wire:model="selectedState" class="mt-1 block w-full dark:text-gray-800">
                    <option value="" selected>Choose State</option>
                    @foreach($states as $state)
                        <option value="{{ $state }}">{{ $state }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif

    @if (!is_null($selectedState))
        <div class="mb-3 row">
            <label for="city">City</label>

            <div class="col-md-6">
                <select wire:model="location_id" class="mt-1 block w-full dark:text-gray-800" id="location_id" name="location_id">
                    <option value="test" selected>Choose City</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif

  </div>  
  
  <div class="row">
    <div class="col-lg-6 mx-5">
      <div class="form-group">
        <label for="wind_speed">Wind Speed (mph):</label>
        <input type="number" name="wind_speed" id="wind_speed" class="mt-1 block w-full dark:text-gray-800" wire:model="wind_speed">
        @error('wind_speed') <span class="text-danger">{{ $message }}</span> @enderror
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6 mx-5">
      <div class="form-group">
      <label for="cloud_cover">Cloud Cover (%):</label>
        <input type="number" name="cloud_cover" id="cloud_cover" class="mt-1 block w-full dark:text-gray-800" wire:model="cloud_cover">
        @error('cloud_cover') <span class="text-danger">{{ $message }}</span> @enderror
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-6 mx-5">
      <div class="form-group">
        <label for="days_ahead">Days Ahead:</label>
        <input type="number" name="days_ahead" id="days_ahead" class="mt-1 block w-full dark:text-gray-800" wire:model="days_ahead">
        @error('days_ahead') <span class="text-danger">{{ $message }}</span> @enderror
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-6 mx-5">
      <div class="form-group">
        <label for="min_hours">Min Hours:</label>
        <input type="number" name="min_hours" id="min_hours" class="mt-1 block w-full dark:text-gray-800" wire:model="min_hours">
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
