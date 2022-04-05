<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\adminNotifModel;
class adminNotifController extends Controller
{
    public function index(){
        $notifs = adminNotifModel::latest()->get();
        return view('admin.notifications.index')->with('notifs', $notifs)->with('panel_name', 'notifications');
    }


}
