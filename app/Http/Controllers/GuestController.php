<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuestController extends Controller
{
    public function registerValidate( Request $request ) {
        $validator = Validator::make( $request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'middle_initial' => ['nullable', 'string', 'max:1'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'mobile' => ['required', 'regex:/^[0-9]{11}+$/'],
            'address' => ['required', 'string', 'max:255'],
            'bday' => ['required'],
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
