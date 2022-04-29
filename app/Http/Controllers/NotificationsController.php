<?php

namespace App\Http\Controllers;

use App\notification;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    /**
     * Get the notification count by calling the function display_new_notifications_count()
     * @param request Request model
     * @param id User id
     * @return JSON Data of the notification
     */
    public function getNotificationsCount( Request $request, $id ) {
        $display_new_notifications_counter = 0;
        $notifs = notification::where( 'user_id', $id )->get();

        foreach ( $notifs as $notif ) {

            $delta_time = time() - strtotime( $notif->created_at );
            $hours = floor( $delta_time / 3600 );
            $delta_time %= 3600;
            $minutes = floor( $delta_time / 60 );

            if ( ( $hours < 1 && $minutes < 59 ) && ( $notif->is_seen == 'no' || $notif->is_seen == '' ) ) {
                $display_new_notifications_counter++;
            }

        }

        return response()->json( [
            'success' => true,
            'message' => 'Notifications count has been fetched',
            'count' => $display_new_notifications_counter
        ] );
    }

}
