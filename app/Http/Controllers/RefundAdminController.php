<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RefundAdminController extends Controller
{
    public function index() {
        $panel_name = "refunds";

        return view( 'admin.refunds.index', compact( 'panel_name' ) );
    }
}
