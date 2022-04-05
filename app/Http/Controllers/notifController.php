<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\notification;
use Auth;
class notifController extends Controller
{
    public function index(){
        $notifs = notification::where('user_id', Auth::user()->id)->latest()->get();
        return view('notifications_area.index')->with('notifs', $notifs);
    }

}
