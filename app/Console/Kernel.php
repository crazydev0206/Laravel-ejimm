<?php

namespace FleetCart\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\ScaffoldModuleCommand::class,
        Commands\Facebook::class,
        Commands\ScaffoldEntityCommand::class,
        Commands\CreateCat::class,
        Commands\ProductCreateWithCsv::class,
        Commands\ProductCreateWithMisioo::class,
        Commands\ProPlusProducts::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
     
        $schedule->command('facebook:feed')->daily();
        $schedule->command('create:cat')->daily();
        // $schedule->command('facebook:feed')->everyMinute();
        // $schedule->command('create:cat')->everyMinute();
        
        //$schedule->command('products:create:with:csv')->everyMinute();
        //$schedule->command('products:create:with:misioo')->everyMinute();

        //$schedule->command('pro:plus:products')->everyMinute();
        //$schedule->command('scaffold:module')->everyMinute();
        //$schedule->command('scaffold:entity')->everyMinute();
    }
}
