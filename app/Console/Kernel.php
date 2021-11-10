<?php

namespace App\Console;

use App\Console\Commands\BillCharge;
use App\Console\Commands\SyncProductStatusCommand;
use App\Jobs\BillChargeJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    
    protected $commands = [
        // SyncProductStatusCommand::class
        BillCharge::class
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('billcharge:command')->daily();
        // $schedule->command('billcharge:command')->everyMinute();
        // $schedule->job(new BillChargeJob)->everyMinute();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
