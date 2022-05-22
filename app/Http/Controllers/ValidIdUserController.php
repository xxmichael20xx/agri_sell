<?php

namespace App\Http\Controllers;

use App\UserValidId;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidIdUserController extends Controller
{
    public function showForm( $id ) {
        $validID = UserValidId::findOrFail( $id );

        if ( $validID->user_id !== Auth::user()->id ) {
            $layout = 'layouts.front';
            $backUrl = '/home';
            $panel_name = 'Unauthorized';
            return view( '401' )->with( compact( 'layout', 'backUrl', 'panel_name' ) );
        }

        if ( $validID->is_valid !== 0 ) return redirect( '/' );

        return view( 'update_id' )->with( compact( 'validID', 'id' ) );
    }

    public function updateId( Request $request, $id ) {
        $validID = UserValidId::find( $id );

        if ( $request->has( 'upload_file' ) ) {
            $image = $request->file( 'upload_file' );
            $imageSave = time() . uniqid() . "-upload_file." . $image->getClientOriginalExtension();

            $upload_path = 'storage/user-valid-ids/' . date( 'FY' ) . '/';
            $upload_path_url = 'user-valid-ids\\' . date( 'FY' ) . '\\';

            $imageUrl = $upload_path_url . $imageSave;
            $image->move( $upload_path, $imageSave );

            $validID->is_valid = 2;
            $validID->valid_id_path = $imageUrl;
            $validID->save();

            return redirect()->route( 'home' )->withMessage( 'Account ID has been updated.' );

        } else {
            return back()->with( 'warning', '_' );

        }
    }
}
