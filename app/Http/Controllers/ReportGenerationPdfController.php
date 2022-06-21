<?php

namespace App\Http\Controllers;

use App\adminNotifModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ReportGenerationPdfController extends Controller
{
    public function activityLogs( Request $request ) {
        $time = Carbon::parse( time() )->format( 'M_d_Y_h_i_s' );
        $fileName = $time . "_Activity_Logs.pdf";

        $collection = new Collection();
        $notifs = adminNotifModel::latest()->get();
        $regex = '/<[^>]*>[^<]*<[^>]*>/';

        foreach ( $notifs as $notif ) {
            $data = (object) [
                "#" . $notif->id,
                $notif->action_type,
                preg_replace( $regex, '', $notif->action_description ),
                $notif->user->name ?? '',
                $notif->created_at
            ];
            $collection->push( $data );
        }

        $pdf = \PDF::loadView( 'admin.export.pdf.activity_logs', compact( 'notifs' ) );
        return $pdf->download( $fileName );
    }
}
