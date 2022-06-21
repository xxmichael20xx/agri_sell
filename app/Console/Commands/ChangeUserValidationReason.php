<?php

namespace App\Console\Commands;

use App\invalidIdreason;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ChangeUserValidationReason extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:user-validation-reasons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the rows for the users validation reasons';

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
        $this->info( "Deleting table rows for `invalid_id_reasons` table." );
        DB::table( 'invalid_id_reasons' )->truncate();

        $this->info( "Adding new table rows for `invalid_id_reasons` table." );
        $newReasons = [
            [
                "slug" => "bad_quality",
                "display_name" => "Bad Quality",
                "description" => "The quality of the image is bad."
            ],
            [
                "slug" => "cut_off_photo",
                "display_name" => "Cut off photo",
                "description" => "The provided ID has been cut off."
            ],
            [
                "slug" => "text_not_clear",
                "display_name" => "Text not clear",
                "description" => "The text on the provided ID isn't clear"
            ],
            [
                "slug" => "details_mismatch",
                "display_name" => "Details Mismatch",
                "description" => "The details on the privided ID doesn't match what you entered."
            ],
        ];

        foreach ( $newReasons as $newReason ) {
            $reason = invalidIdreason::create( $newReason );
        }
        $this->info( "New reason has been added to `invalid_id_reasons` table." );
    }
}
