<?php

namespace FleetCart\Console\Commands;

use Illuminate\Console\Command;
use Modules\Import\Http\Controllers\Admin\ImporterController;
use Illuminate\Support\Facades\Log;

// use Slim\Log;

class Facebook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'facebook:feed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Facebook Feed';

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
        Log::info('Showing the user profile for user');
        $export = new ImporterController;
        $export->createFeed();
        return "done";
    }
}
