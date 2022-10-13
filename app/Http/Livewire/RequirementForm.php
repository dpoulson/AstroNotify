<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Location;
use App\Models\User;
use DB;

class RequirementForm extends Component
{

    public $location_id;
    public $wind_speed;
    public $cloud_cover;
    public $days_ahead;
    public $min_hours;

    public $countries;
    public $states;
    public $cities;

    public $selectedCountry = null;
    public $selectedState = null;
    public $selectedCity = null;

    public function render()
    {
        //$countries = Location::distinct('country')->orderBy('country')->pluck('country')->prepend('Please Select');

        return view('livewire.requirement-form');
    }

    public function mount($selectedCity = null)
    {
        $this->countries = Location::distinct('country')->orderBy('country')->pluck('country');
        $this->states = collect();
        $this->cities = collect();
        $this->selectedCity = $selectedCity;

        if (!is_null($selectedCity)) {
            $city = Location::where('name', $selectedCity);
            if ($city) {
                $this->cities = Location::where('subcountry', $city->subcountry)->orderBy('name')->get();
                $this->states = Location::distinct('subcountry')->where('country', $city->state->country)->orderBy('subcountry')->pluck('subcountry');
                $this->selectedCountry = $city->state->country_id;
                $this->selectedState = $city->state_id;
            }
        }
    }

    public function updatedSelectedCountry($country)
    {
        $this->states = Location::distinct('subcountry')->where('country', $country)->orderBy('subcountry')->pluck('subcountry');
        $this->selectedState = NULL;
    }

    public function updatedSelectedState($state)
    {
        if (!is_null($state)) {
            $this->cities = Location::where('subcountry', $state)->orderBy('name')->get();
        }
    }

    public function save()
    {
        $validated = $this->validate([
            'location_id' => 'required|integer',
            'wind_speed' => 'required|integer',
            'cloud_cover' => 'required|integer|max:100',
            'days_ahead' => 'required|integer|max:10',
            'min_hours' => 'required|integer|max:10',
        ]);

        $user = User::find(auth()->user()->id);
        $result = $user->requirement()->create([
            'location_id' => $validated['location_id'],
            'wind_speed' => $validated['wind_speed'],
            'cloud_cover' => $validated['cloud_cover'],
            'days_ahead' => $validated['days_ahead'],
            'min_hours' => $validated['min_hours']
        ]);

        $location = Location::find($validated['location_id']);
        if($location->lat == "") 
        {
            $url = "http://api.geonames.org/getJSON?username=dpoulson&geonameId=".$location->id;
					  $json = file_get_contents($url);
					  $raw = json_decode($json);
            $updated = DB::table('locations')
                        ->where('id', $location->id)
                        ->update([
                          'lat' => $raw->lat,
                          'lon' => $raw->lng,
                          'timezone' => $raw->timezone->timeZoneId
                        ]);

        }
        return redirect()->route('dashboard')
                        ->with('success','Requirement created successfully.');
    }

}
