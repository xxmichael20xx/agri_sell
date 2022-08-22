<?php

namespace App\Jobs;

use App\Mail\NotificationEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $data = [] )
    {
        if ( count( $data ) > 0 ) {
            $this->data = $data;

        } else {
            $this->data = [
                'to' => 'test.test@mailinator.com',
                'subject' => 'Default Subject',
                'details' => NULL
            ];
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new NotificationEmail( $this->data );
        Mail::to( $this->data['to'] )->send( $email );
        Log::info( json_encode( Mail::failures() ) );
    }
}
