<?php

namespace App\Http\Controllers;

use App\refundModelOrder;
use Illuminate\Http\Request;

class RefundAdminController extends Controller
{
    public function index() {
        $panel_name = "refunds";
        $requests = refundModelOrder::where( 'status', 0 )->get();

        return view( 'admin.refunds.index', compact( 'panel_name', 'requests' ) );
    }
}
