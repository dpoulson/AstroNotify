<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Location;
use App\Models\Requirement;
use DB;

class RequirementForm extends Component
{

    public $location_id;
    public $wind_speed;
    public $cloud_cover;
    public $days_ahead;
    public $min_hours;

    public function render()
    {
        $countries = Location::distinct('country')->orderBy('country')->pluck('country')->prepend('Please Select');

        return view('livewire.requirement-form', compact('countries'));
    }

    public function save()
    {
        $validated = $this->validate([
            //'location_id' => 'required|integer',
            'wind_speed' => 'required|integer',
            'cloud_cover' => 'required|integer|max:100',
            'days_ahead' => 'required|integer|max:10',
            'min_hours' => 'required|integer|max:10',
        ]);
        $validated['location_id'] = 1120985;
        //$requirement = new Requirement($validated->all());

        $result = auth()->user()->requirement()->create([
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
        return redirect()->route('user.show', auth()->user()->id )
                        ->with('success','Requirement created successfully.');
    }
}
