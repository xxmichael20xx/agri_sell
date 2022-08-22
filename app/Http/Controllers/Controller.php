<?php

namespace App\Http\Controllers;

use App\Events\OrderEvent;
use App\Events\ShopEvent;
use App\Jobs\SendEmailJob;
use App\notification;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

        $emailData = [
            'id' => $notification_ent->user_id,
            'subject' => $notification_ent->notification_title,
            'details' => $notification_ent->notification_txt
        ];
        $this->sendEmailNotif( $emailData );

        if ( $hasEvent ) event( new OrderEvent( $eventData ) );
    }

    /**
     * Creates a new notification and trigger an event for admin
     * @param notificationData Array data for new notification
     */
    public function adminPushNotifications( $notificationData ) {
        $admin = User::where( 'email', 'agrisell2077@gmail.com' )->first();
        $notification_ent = new notification();
        $notification_ent->user_id = $admin->id;
        $notification_ent->frm_user_id = auth()->user()->id ?? 0;
        $notification_ent->notification_title = $notificationData['title'];
        $notification_ent->notification_txt = $notificationData['message'];
        $notification_ent->save();

        $emailData = [
            'id' => $notification_ent->user_id,
            'subject' => $notification_ent->notification_title,
            'details' => $notification_ent->notification_txt
        ];
        $this->sendEmailNotif( $emailData );

        event( new ShopEvent( [ 'customer_id' => $admin->id ] ) );
    }

    /**
     * Query the user data and check if role can access
     * 
     * @param user_id User id of the user
     * @param role Number value of the role
     * @return Boolean
     */
    public function userCan( $user_id, $role ) {
        $user = User::find( $user_id );
        if ( ! $user ) return false;
        
        return $user->role_id == $role ? true : false;
    }

    /**
     * Show a page template for Web Errors / Information pages
     * 
     * @param data Array containing data for the page template
     * @return View
     */
    public function showWebPages( Array $data ) {
        $layout = $data['layout'];
        $backUrl = $data['backUrl'];
        $panel_name = $data['panel_name'];
        $view = $data['view'];
        $title = $data['title'] ?? false;

        return view( $view )->with( compact( 'layout', 'backUrl', 'title', 'panel_name' ) );
    }

    public function sendEmailNotif( $data, $dev = false ) {
        switch ( $dev ) {
            case true:
                $email = 'test.test@mailinator.com';
                break;

            default:
                $user = User::find( $data['id'] );
                $email = $user->email ?? 'test.test@mailinator.com';
                break;
        }
        $data['to'] = $email;

        Log::info( json_encode( $data ) );
        dispatch( new SendEmailJob( $data ) );
    }
}
