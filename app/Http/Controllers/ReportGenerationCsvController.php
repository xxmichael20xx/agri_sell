<?php

namespace App\Http\Controllers;

use App\Exports\ActivityLogs;
use App\Exports\Refunds;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportGenerationCsvController extends Controller
{
    public function time() {
        $time = Carbon::parse( time() )->format( 'M_d_Y_h_i_s' );

        return $time;
    }
    public function activityLogs( Request $request ) {
        $fileName = $this->time() . "_Activity_Logs.csv";
        return \Excel::download( new ActivityLogs, $fileName );
    }

    public function refunds( Request $request, $type, $interval ) {
        $fileName = $this->time() . "_Refunds_" . ucwords( $type ) . ".csv";
        return \Excel::download( new Refunds( $type, $interval ), $fileName );
    }
}
