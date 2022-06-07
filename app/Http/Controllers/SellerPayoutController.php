<?php

namespace App\Http\Controllers;

use App\Events\PayoutEvent;
use App\SubOrder;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers as Helper;
use App\notification;
use App\SellerPayout;
use App\SellerPayoutRequest;

class SellerPayoutController extends Controller
{
    public function index( Request $request ) {
        $payouts = SellerPayoutRequest::where( 'user_id', Auth::user()->id )->get();
        $panel_name = 'payout';

        return view( 'sellerPanel.payout.index', compact(
            'panel_name',
            'payouts'
        ) );
    }

    public function show( $id ) {
        $panel_name = "payout";
        $payout = SellerPayoutRequest::findOrFail( $id );

        if ( $payout && $payout->user_id !== auth()->user()->id ) {
            $layout = 'sellerPanel.front';
            $backUrl = '/sellerpanel/payout';
            $panel_name = 'Unauthorized';
            return view( '401' )->with( compact( 'layout', 'backUrl', 'panel_name' ) );
        }

        return view( 'sellerPanel.payout.show', compact( 'panel_name', 'payout', 'id' ) );
    }

    public function verify( Request $request ) {
        $payouts = User::find( $request->user_id )->payouts;
        $data = array(
            'success' => true,
        );

        if ( count( $payouts ) < 1 ) {
            return response()->json([
                'success' => true,
                'message' => 'No Payout'
            ]);
        }

        foreach ( $payouts as $index => $payout ) {
            $day = Carbon::parse( Carbon::now() );
            $start = Carbon::parse( $payout->week_start );
            $end = Carbon::parse( $payout->week_end );

            if ( $day->isSameDay( $start ) || $day->isSameDay( $end ) ) {
                return response()->json([
                    'success' => false,
                    'message' => 'Start / End has the same date today',
                    'data' => [ $day, $start, $end ]
                ]);
                break;
            }

            if ( $day->between( $start, $end ) ) {
                return response()->json([
                    'success' => false,
                    'message' => 'Between ranges',
                    'data' => [ $day, $start, $end ]
                ]);
                break;
            }
        }

        return response()->json( $data );
    }

    public function new( Request $request, $id = NULL ) {
        if ( ! isset( $_COOKIE['payout_agree'] ) ) {
            return redirect( '/sellerpanel/payout' )->with( 'info', 'Payout Request Agreement Required');
        }
        $payout = NULL;
        if ( $id ) {
            $payout = SellerPayoutRequest::find( $id );

            if ( $payout->status !== 2 ) {
                return redirect( '/sellerpanel/payout' );
            }
        } 

        $panel_name = 'payout';
        return view( 'sellerPanel.payout.new', compact(
            'panel_name',
            'payout'
        ) );
    }

    public function validation( Request $request ) {
        $seller = User::find( $request->user_id );
        $passwordCheck = Hash::check( $request->password, $seller->password );
        /* $refExists = SellerPayoutRequest::where( 'gcash_ref', $request->payoutRef )->get()->count();

        if ( $refExists > 0 ) {
            return response()->json( [
                'success' => false,
                'message' => "GCash Reference Number has been already used!"
            ] );
        } */

        if ( ! $passwordCheck ) {
            return response()->json( [
                'success' => false,
                'message' => "Password is incorrect!"
            ] );
        }

        $isPhoneValid = preg_match( '/^[0-9]{11}+$/', $request->number );
        if ( ! $isPhoneValid ) {
            return response()->json( [
                'success' => false,
                'message' => "Please enter a valid Phone Number",
                'validation' => $request->number
            ] );
        }

        $total_sales = 0;
        $subOrders = SubOrder::where('seller_id', $request->user_id )->get();
        foreach ( $subOrders as $order ) {
            if ( $order->status == 'completed' && ! $order->payout_request && count( $order->items ) > 0 ) {
                foreach( $order->items as $item ) {
                    $item_pivot = $item->pivot;
                    $total_sales += $item_pivot->price * $item_pivot->quantity;
                }
            }
        }

        $payouts = SellerPayoutRequest::where( 'user_id', $request->user_id )->get();
        $payoutTotal = 0;

        if ( $payouts->count() > 0 ) {
            foreach( $payouts as $payout_index => $payout ) {
                $payoutTotal += $payout->amount;
            }
        }

        $total_sales = $total_sales - $payoutTotal;

        if ( $total_sales < $request->amount ) {
            $total_sales = "₱ " . Helper::numeric( $total_sales, 2 );

            return response()->json( [
                'success' => false,
                'message' => "You dont' have enough sales to payout. <br> Maximum: {$total_sales}"
            ] );
        }

        return response()->json( [
            'success' => true,
            'message' => "Payout request continue"
        ] );
    }

    public function createRequest( Request $request ) {
        $admin_id = User::where( 'email', 'agrisell2077@gmail.com' )->first();
        $seller = User::find( $request->user_id );
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');

        if ( $request->payout_request_id ) return $this->updateRequest( $request );

        $sellerPayout = SellerPayoutRequest::create( $request->all() );

        if ( ! $sellerPayout ) {
            return response()->json( [
                'success' => false,
                'message' => "Failed to submit payout request."
            ] );
        }

        $payout = new SellerPayout;
        $payout->user_id = $request->user_id;
        $payout->payout_request_id = $sellerPayout->id;
        $payout->amount = $request->amount;
        $payout->week_day = $now;
        $payout->week_start = $weekStartDate;
        $payout->week_end = $weekEndDate;
        $payout->save();

        $adminNotification = new notification();
        $adminNotification->user_id = $admin_id->id;
        $adminNotification->frm_user_id = $request->user_id;
        $adminNotification->notification_title = "[Seller] New Payout Request";
        $adminNotification->notification_txt = "Payout request from Seller '{$seller->name}'";
        $adminNotification->save();

        event( new PayoutEvent( [ 'user_id' => $admin_id->id ] ) );

        return response()->json( [
            'success' => true,
            'message' => "Please wait for Admins approval."
        ] );
    }

    public function updateRequest( Request $request ) {
        $admin_id = User::where( 'email', 'agrisell2077@gmail.com' )->first();
        $seller = User::find( $request->user_id );

        $sellerPayout = SellerPayoutRequest::find( $request->payout_request_id );
        $sellerPayout->gcash_name = $request->gcash_name;
        $sellerPayout->gcash_number = $request->gcash_number;
        // $sellerPayout->gcash_ref = $request->gcash_ref;
        $sellerPayout->amount = $request->amount;
        $sellerPayout->reject_reason = NULL;
        $sellerPayout->status = 0;
        $sellerPayout->save();

        if ( ! $sellerPayout ) {
            return response()->json( [
                'success' => false,
                'message' => "Failed to update payout request"
            ] );
        }

        $payout = SellerPayout::find( $sellerPayout->id );
        $payout->amount = $request->amount;
        $payout->save();

        $adminNotification = new notification();
        $adminNotification->user_id = $admin_id->id;
        $adminNotification->frm_user_id = $request->user_id;
        $adminNotification->notification_title = "[Seller] Update Payout Request";
        $adminNotification->notification_txt = "Payout request from Seller '{$seller->name}'";
        $adminNotification->save();

        event( new PayoutEvent( [ 'user_id' => $admin_id->id ] ) );

        return response()->json( [
            'success' => true,
            'message' => "Please for Admins approval."
        ] );
    }
}
