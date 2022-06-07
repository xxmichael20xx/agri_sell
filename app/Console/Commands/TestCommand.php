<?php

namespace App\Console\Commands;

use App\Events\MyEvent;
use App\User;
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
        $users = User::all();

        foreach ( $users as $user ) {
            if ( ! $user->barangay ) {
                $user->barangay = "Amamperez";
            }

            if ( ! $user->town ) {
                $user->town = "Villasis";
            }

            if ( ! $user->province ) {
                $user->province = "Pangasinan";
            }

            if ( $user->address == 'not defined' ) {
                $user->address = 'Purok 6';
            }

            $user->save();
        }
    }
}
