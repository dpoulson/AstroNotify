<?php

use Illuminate\Database\Seeder;
use JeroenZwart\CsvSeeder\CsvSeeder;

class LocationsSeeder extends CsvSeeder
{
  
    public function __construct()
    {
        $this->file = '/database/seeds/csvs/locations.csv';
        $this->delimiter = ',';
    }  
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        parent::run();
    }
}
