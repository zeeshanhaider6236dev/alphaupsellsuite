<?php

namespace App\Console\Commands;

use App\Jobs\BillChargeJob;
use Illuminate\Console\Command;

class BillCharge extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'billcharge:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        BillChargeJob::dispatch();   
    }
}
