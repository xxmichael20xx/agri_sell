<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ArtisanCommands extends Controller
{
    public function optimize() {
        Artisan::call( 'optimize:clear' );
        dd( Artisan::output() );
    }

    public function storageLink() {
        Artisan::call( 'storage:link' );
        dd( Artisan::output() );
    }

    public function migrate() {
        Artisan::call( 'migrate' );
        dd( Artisan::output() );
    }
}
