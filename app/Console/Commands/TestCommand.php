<?php

namespace App\Console\Commands;

use App\Exports\Shop;
use App\Jobs\SendEmailJob;
use App\Mail\NotificationEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

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
        $data = [
            'to' => 'test.test@mailinator.com',
            'subject' => 'Test Subject',
            'details' => "WITH DATA"
        ];
        dispatch( new SendEmailJob( $data ) );
    }
}
