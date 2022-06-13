<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuestController extends Controller
{
    public function registerValidate( Request $request ) {
        $validator = Validator::make( $request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'mobile' => ['required', 'regex:/^[0-9]{11}+$/'],
        ] );

        if ( $validator->fails() ) {
            return response()->json( [
                'success' => false,
                'errors' => $validator->errors()
            ] );
        }

        return response()->json( [
            'success' => true
        ] );
    }
}
