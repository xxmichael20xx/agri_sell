<?php

namespace App\Console\Commands;

use App\Events\MyEvent;
use App\User;
use App\UserValidId;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Command';

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
        $this->info( "Deleting Valid IDs except for Seller" );
        UserValidId::where( 'id', '!=', 3 )->delete();
        $this->info( "Valid IDs deleted except for Seller" );
    }
}
