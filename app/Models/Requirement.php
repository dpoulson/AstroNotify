<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Location;
use App\Models\Forecast;
use App\Models\Sun;

class Requirement extends Model
{
    protected $guarded = [
    ];  
    
    public function user() 
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function location()
    {
        return $this->belongsTo('App\Models\Location');
    }
    
    public function clearSkies()
    {
        $good_night = 0;
        $result = array();
        $tz = new \DateTimeZone($this->location->timezone);
        $forecast_data = Forecast::where('location_id', $this->location_id)->get();
        $sun_data = Sun::where('location_id', $this->location_id)->get();
        for($d = 0; $d < $this->days_ahead; $d++)
        {
            $consecutive = 0;
            foreach($forecast_data as $night)
            {
                $dt = new \DateTime("now", $tz);
                $dt->setTimestamp($night->time);
                if($night->time > $sun_data[$d]['sunset'] && $night->time+3600 < $sun_data[$d+1]['sunrise']-3600 && $this->wind_speed >= $night->wind_speed && ($this->cloud_cover)/100 >= $night->cloud_cover) 
                {
					if ($consecutive != 1) 
                    {
					    $start = $night->time;
					}
					$consecutive = 1;
                } elseif ($consecutive == 1) 
                {
				    $dtstart = new \DateTime("now", $tz);
				    $dtstart->setTimestamp($start);
				    $start_string = $dtstart->format('D d/m/y, H:i:s');
				    $hours = ($night->time - $start)/3600;
				    if($hours >= $this->min_hours) 
                    {
				        $single_result = array('start_time' => $start_string, 'hours' => $hours, 'location_id' => $this->location_id);
                        array_push($result, $single_result);
				        $good_night = 1;
				    }
				    $consecutive = 0;
				}
            }
        }
        return $result;
    }
}
