<?php

namespace App\Http\Controllers;

use App\orderDeliveryStatusModel;
use App\TransHistModel;
use Illuminate\Http\Request;

class TransactionHist extends Controller
{
    function index(){
        $trans = TransHistModel::orderByDesc('created_at')->get();       
        return view('admin.transaction_history.index')->with(compact('trans'))->with('panel_name', 'transaction_hist');
    }
}
