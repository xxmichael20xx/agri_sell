<?php

namespace App\Rules;

use App\Helpers;
use App\Order;
use App\refundModelOrder;
use App\SellerPayoutRequest;
use App\SubOrder;
use App\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class SellerPayoutAmount implements Rule
{
    protected $request, $message;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct( $request )
    {
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes( $attribute, $value )
    {

        $seller = User::find( $this->request->user_id );
        $passwordCheck = Hash::check( $this->request->payout_password, $seller->password );

        if ( ! $passwordCheck ) {
            $this->message = "Payout amount validation failed! Please provide correct password";
            return false;
        }

        $total_sales = 0;
        $order_items = SubOrder::where('seller_id', $this->request->user_id )->get();
        foreach ( $order_items as $order_item ) {
            $mainOrder = Order::find( $order_item->order_id );
            if ( ! $mainOrder ) continue;
            if ( $mainOrder->payment_method !== 'agrisell_coins' ) continue;
            if ( $order_item->status == 'completed' && $order_item->payout_request && count( $order_item->items ) > 0 ) {
                foreach( $order_item->items as $item ) {
                    $item_pivot = $item->pivot;
                    $total_sales += $item_pivot->price * $item_pivot->quantity;
                }
            }
        }

        $payouts = SellerPayoutRequest::where( 'user_id', $this->request->user_id )->get();
        $_refunds = refundModelOrder::where( 'status', 3 )->get();
        $payoutTotal = 0;
        $refundsAmount = 0;

        foreach( $_refunds as $refund ) {
            if ( $refund->product->product_user_id == $this->request->user_id ) {
                $amount = ( $refund->order_item->price * $refund->order_item->quantity / 2 );
                $refundsAmount += $amount;
            }
        }

        if ( $payouts->count() > 0 ) {
            foreach( $payouts as $payout_index => $payout ) {
                if ( $payout->status == '1' ) {
                    $payoutTotal += $payout->amount;

                    if ( $payout->metadata && $payout->metadata['type'] == 'Remit' ) {
                        $remitt_amount = isset( $payout->metadata['remitt_amount'] ) ? $payout->metadata['remitt_amount'] : 0;
                        $payoutTotal += intval( $remitt_amount );
                    }
                }

            }
        }

        $total_sales = $total_sales - $payoutTotal - $refundsAmount;
        if ( $total_sales < 1 ) $total_sales = 0;

        $is_remittance = $this->request->payout_type == 'remit';
        $_amount = $this->request->amount;
        $remittances = config( 'remittance.code' );
        $remittance_amount = 0;

        if ( $is_remittance ) {
            foreach( $remittances as $remittance ) {
                $min = intval( $remittance[0] );
                $max = intval( $remittance[1] );
                $remit = intval( $remittance[2] );

                if ( $_amount >= $min && $_amount <= $max ) {
                    $_amount += $remit;
                    $remittance_amount = $remit;
                    break;
                }
            }
        }

        if ( $total_sales < $_amount ) {
            // $total_sales = "₱ " . Helpers::numeric( $total_sales, 2 );
            // $this->message = "You don't have enough sales to request a payout. <br> Maximum: {$total_sales}";
            $this->message = "You don't have enough sales to request a payout.";
            
            if ( $is_remittance ) {
                $this->message .= " Additional ₱{$remittance_amount} payment is added based on the amount.";
            }

            return false;
        }

        if ( $this->request->amount < 1 ) {
            $this->message = "Payout amount must be at least ₱ 1";
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
