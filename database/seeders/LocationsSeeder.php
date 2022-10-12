<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use JeroenZwart\CsvSeeder\CsvSeeder;

class LocationsSeeder extends CsvSeeder
{
  
    public function __construct()
    {
        $this->file = '/database/seeders/csvs/locations.csv';
        $this->delimiter = ',';
    }  
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        parent::run();
    }
}
