<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\coinsEmployee;
use App\coinsTopUpEmployeeEntry;
use App\agcoins;
use App\coinsTopUpModel;
use DB;
class CoinsPanelController extends Controller
{
    function index(){
        // agcoins::coins_auto_top_validate();
         $users = coinsTopUpModel::all();
        // $users = DB::table('coins_top_up')->get();
        $ag_coins_spends_total = DB::table('coins_transaction')->sum('value');
        $userCoinsTopUps = coinsTopUpModel::all();
        $ag_coins_topped_up_total = DB::table('coins_top_up')->where('remarks', '1')->sum('value');
        $coinsTopUps = coinsTopUpEmployeeEntry::all();
        return view('coinsTopUpEmpPanel.dashboard')->with('panel_name', 'dashboard')->with(compact('coinsTopUps', 'ag_coins_topped_up_total', 'ag_coins_spends_total', 'userCoinsTopUps', 'users'));
    } 

    function coins_entry_form(){
        agcoins::coins_auto_top_validate();
        $coinsTopUps = coinsTopUpEmployeeEntry::all();
        return view('coinsTopUpEmpPanel.encode')->with('panel_name', 'dashboard')->with(compact('coinsTopUps'));
    }

    function coins_refund(){
        agcoins::coins_auto_top_validate();
        $coinsTopUps = coinsTopUpEmployeeEntry::all();
        return view('coinsTopUpEmpPanel.refund')->with('panel_name', 'coins_refund')->with(compact('coinsTopUps'));
    }

    function coins_status(){

        agcoins::coins_auto_top_validate();
        $coinsTopUps = coinsTopUpEmployeeEntry::all();
        $userCoinsTopUps = coinsTopUpModel::all();

        return view('coinsTopUpEmpPanel.status')->with('panel_name', 'coins_status')->with(compact('coinsTopUps', 'userCoinsTopUps'));
    }

    function autoValidateCronJobs(){
        agcoins::coins_auto_top_validate();
        
    }
    function coins_top_up_submit(Request $request){
        $coinsTopUpEmployeeEntry = new coinsTopUpEmployeeEntry(); 
        $coinsTopUpEmployeeEntry->emp_user_id = $request->emp_user_id;
        $coinsTopUpEmployeeEntry->coins_trans_type = $request->coins_top_up_cat;
        $coinsTopUpEmployeeEntry->cust_trans_id = $request->reference_number;
        $coinsTopUpEmployeeEntry->value = $request->amount;
        $coinsTopUpEmployeeEntry->save();
        return back();
    }

    function coins_top_up_delete($coins_top_up_id){
        $coinsTopUpEmployeeEntry = coinsTopUpEmployeeEntry::find($coins_top_up_id);
        $coinsTopUpEmployeeEntry->delete();
        return back();
    }
}
