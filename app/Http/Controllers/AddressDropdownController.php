<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class AddressDropdownController extends Controller
{
    public function index()
    {
    $provinces = DB::table("provinces")->pluck("name","id");
    return view('auth.register_address_dropdown',compact('provinces'));
    }
    
    public function getMunicipality(Request $request)
    {
    $municipalities = DB::table("municipalities")
    ->where("province_id",$request->province_id)
    ->pluck("name","id");
    return response()->json($municipalities);
    }
    
    public function getBarangay(Request $request)
    {
    $barangays = DB::table("barangays")
    ->where("municipality_id",$request->municipality_id)
    ->pluck("name","id");
    return response()->json($barangays);
    }
}
