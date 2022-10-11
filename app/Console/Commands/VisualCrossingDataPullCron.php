<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Requirement;
use App\Location;
use App\Forecast;
use App\Sun;

class VisualCrossingDataPullCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visualcrossing:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull in data from Visual Crossing API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('VisualCrossing:Cron command');
        $this->info('VisualCrossing:Cron truncating tables');
        Forecast::truncate();
        Sun::truncate();
        $locations = Requirement::distinct('location')->pluck('location_id');
        foreach($locations as $location)
        {
            $this->info('VisualCrossing:Cron getting location id '.$location);
            $location_data = Location::find($location);
            $url = $this->getUrl($location_data->lat, $location_data->lon);
            $this->info('VisualCrossing:Cron url: '.$url);
            $data = json_decode(file_get_contents($url));
            foreach ($data as $key=>$value) {
                if ($key == "location") 
                {
                    foreach ($value as $data=>$info)
                    {
                        if ($data == "values")
                        {
                            $last_cloud = 0;
                            $last_precip = 0;
                            $last_wind = 0;
                            $last_sunrise = "";
                            foreach($info as $forecast)
                            {
                                
                                // Main Forecast
                                $entry = new Forecast;
                                $entry->time        = ($forecast->datetime)/1000;
                                $entry->location_id = $location;
                                if ($forecast->cloudcover == NULL) {
                                  $entry->cloud_cover = $last_cloud;
                                } else {
                                  $entry->cloud_cover = ($forecast->cloudcover)/100;
                                  $last_cloud = ($forecast->cloudcover)/100;
                                }
                                if ($forecast->pop == NULL) {
                                  $entry->precip_prob = $last_precip;
                                } else {
                                  $entry->precip_prob = $forecast->pop;
                                  $last_precip = $forecast->pop;
                                }
                                if ($forecast->wspd == NULL) {
                                  $entry->wind_speed = $last_wind;
                                } else {
                                  $entry->wind_speed = $forecast->wspd;
                                  $last_wind = $forecast->wspd;
                                } 
                                $entry->save(); 
                                
                                if ($forecast->sunrise != $last_sunrise && $forecast->sunrise != NULL)
                                {
                                    $sun_entry = new Sun;
                                    $sun_entry->location_id = $location;
                                    $sun_entry->day = ($forecast->datetime)/1000;
                                    $sun_entry->sunrise = strtotime($forecast->sunrise);
                                    $sun_entry->sunset = strtotime($forecast->sunset);
                                    $sun_entry->save();
                                    $last_sunrise = $forecast->sunrise;
                                }                         
                            }
                        }
                    }
                }
            }
        }
        
    }
    
    private function getUrl($lat, $lon)
    {
        $key = env('VISUALCROSSINGAPI');
        $url = 'https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/weatherdata/forecast?aggregateHours=1&combinationMethod=aggregate&contentType=json&includeAstronomy=true&unitGroup=metric&locationMode=single&key='.$key.'&locations='.$lat.','.$lon;

        if (! filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \Exception("Invalid URL '$url'");
        }

        return $url;
    }
}
