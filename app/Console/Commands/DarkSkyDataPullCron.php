<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Requirement;
use App\Models\Location;
use App\Models\Forecast;
use App\Models\Sun;

class DarkSkyDataPullCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'darksky:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull in data from Dark Skies API';

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
        $this->info('DarkSky:Cron command');
        $this->info('DarkSky:Cron truncating tables');
        Forecast::truncate();
        Sun::truncate();
        $locations = Requirement::distinct('location')->pluck('location_id');
        foreach($locations as $location)
        {
            $this->info('DarkSky:Cron getting location id '.$location);
            $location_data = Location::find($location);
            $url = $this->getUrl($location_data->lat, $location_data->lon);
            $data = json_decode(file_get_contents($url));
            foreach ($data as $key=>$value) {
                if ($key == "hourly") 
                {
                    foreach ($value as $data=>$info)
                    {
                        if ($data == "data")
                        {
                            foreach($info as $forecast)
                            {
                                $entry = new Forecast;
                                $entry->time        = $forecast->time;
                                $entry->location_id = $location;
                                $entry->cloud_cover = $forecast->cloudCover;
                                $entry->precip_prob = $forecast->precipProbability;
                                $entry->wind_speed  = $forecast->windSpeed;  
                                $entry->save();                              
                            }
                        }
                    }
                } elseif ($key == "daily")
                {
                    foreach ($value as $data=>$info)
                    {
                        if ($data == "data")
                        {
                            foreach($info as $forecast)
                            {
                                $entry = new Sun;
                                $entry->day         = $forecast->time;
                                $entry->location_id = $location;
                                $entry->sunrise     = $forecast->sunriseTime;
                                $entry->sunset      = $forecast->sunsetTime;
                                $entry->save();
                            }
                        }
                    }
                }
            }
        }
        
    }
    
    private function getUrl($lat, $lon)
    {
        $key = env('DARKSKYAPI');
        $url = 'https://api.darksky.net/forecast/'.$key.'/'.$lat.','.$lon.'?exclude=currently,minutely,alerts,flags&extend=hourly';

        if (! filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \Exception("Invalid URL '$url'");
        }

        return $url;
    }
}
