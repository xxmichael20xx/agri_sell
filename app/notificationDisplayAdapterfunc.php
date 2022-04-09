<?php

namespace App;

use App\notification;
class notificationDisplayAdapterfunc
{
    public static function display_new_notifications_count(){
        $display_new_notifications_counter = 0;
        $notifs = notification::where('user_id', auth()->id())->get();
        foreach ($notifs as $notif){
            $delta_time = time() - strtotime($notif->created_at);
            $hours = floor($delta_time / 3600);
            $delta_time %= 3600;
            $minutes = floor($delta_time / 60);
            if (($hours < 1 && $minutes < 59) || $notif->is_seen == 'no'){
                $display_new_notifications_counter++;
            }
        }
        return $display_new_notifications_counter;
    }
}
