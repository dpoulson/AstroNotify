<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Forecast;
use App\Models\Sun;

class LocationTable extends Component
{

    public function mount($location)
    {
        $this->location = $location;
    }

    public function render()
    {

        $forecast = Forecast::where('location_id', $this->location->id)->get();
        $sun = Sun::where('location_id', $this->location->id)->get();
        $days = [];

        $offset = Carbon::now($this->location->timezone)->offsetHours;
        $today_timestamp = strtotime(date("Y-m-d"))-($offset*3600);

        $current_timestamp = $today_timestamp;

        $first = $forecast->first();
        $day_data = array();
        $day = 0;
        $hour = 0;
        while($current_timestamp < $first->time) {
            $x = array("Wind Speed"=>"", "Cloud Cover"=>"", "Night"=>"", "Time"=>$current_timestamp);
            $day_data[$day][$hour] = $x;
            $hour++;
            $current_timestamp += 3600;
            if($hour == 24) {
                $day++;
                $hour = 0;
            }

        }

        foreach($forecast as $data) {
            $x = array("Wind Speed"=>intval($data->wind_speed), "Cloud Cover"=>intval($data->cloud_cover*100));
            $sun = Sun::where('location_id', $this->location->id)
                    ->where('day' , "<=",  $current_timestamp)
                    ->orderBy('day', 'desc')
                    ->first();
            if($current_timestamp <= $sun->sunrise || $current_timestamp >= $sun->sunset)
                $x['Night'] = True;
            else 
                $x['Night'] = False;
            $x['Time'] = $current_timestamp;
            $day_data[$day][$hour] = $x;
            $hour++;
            $current_timestamp += 3600;
            if($hour == 24) {
                $day++;
                $hour = 0;
            }           
        }

        return view('livewire.location-table', compact('day_data'));
    }
}
