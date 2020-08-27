<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Requirement;

class CheckRequirementsCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkreq:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check each of the requirements for good viewing conditions';

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
        $requirements = Requirement::all();
        foreach($requirements as $requirement)
        {
            $this->info('Requirements: '.$requirement);
            $results = $requirement->clearSkies();
            $this->info('Requirements: Number of Results: '.sizeof($results));
            if (sizeof($results) != 0 )
            {
                foreach($results as $result)
                {
                    $this->info('Requirements: Result: '.$result['start_time']. ' for '.$result['hours'].' hours');
                }
            }
        }
        
    }
}
