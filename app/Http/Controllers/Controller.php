<?php

namespace App\Http\Controllers;

use App\Events\OrderEvent;
use App\notification;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Get the user id of the current user
     * @return Number/Null
     */
    public function userId() {
        $user_id = Auth::check() ? Auth::user()->id : null;
        return $user_id;
    }

    /**
     * Creates a new notification and trigger a event
     * @param notificationData Array data for new notification
     * @param hasEvent Boolean value if notification will trigger event
     */
    public function newNotificationWithEvent( $notificationData, $hasEvent = false, $eventData = [] ) {
        $notification_ent = new notification();
        $notification_ent->user_id = $notificationData['user_id'];
        $notification_ent->frm_user_id = $notificationData['frm_user_id'];
        $notification_ent->notification_title = $notificationData['notification_title'];
        $notification_ent->notification_txt = $notificationData['notification_txt'];
        $notification_ent->save();

        if ( $hasEvent ) event( new OrderEvent( $eventData ) );
    }
}
