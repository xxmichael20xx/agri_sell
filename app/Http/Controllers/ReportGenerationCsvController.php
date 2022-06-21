<?php

namespace App\Http\Controllers;

use App\Exports\ActivityLogs;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportGenerationCsvController extends Controller
{
    public function activityLogs( Request $request ) {
        $time = Carbon::parse( time() )->format( 'M_d_Y_h_i_s' );
        $fileName = $time . "_Activity_Logs.csv";
        return \Excel::download( new ActivityLogs, $fileName );
    }
}
