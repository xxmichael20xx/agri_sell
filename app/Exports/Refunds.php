<?php

namespace App\Exports;

use App\Helpers;
use App\refundModelOrder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Refunds implements FromCollection, WithHeadings
{
    protected $type, $interval, $month, $collection;

    public function __construct( $type, $interval, $month )
    {
        $this->type = $type;
        $this->interval = $interval;
        $this->month = $month;
        $this->collection = new Collection();
    }

    public function headings(): array
    {
        $headers = [ "Name", "Proof", "Date Confirmed", "Product", "Amount", "Reason", "Name of Shop" ];

        switch ( $this->type ) {
            case 'confirmed':
                $headers[2] = 'Date Confirmed';
                break;
            
            case 'rejected':
                $headers[2] = 'Date Rejected';
                break;

            default:
                $headers[2] = 'Date Requested';
                break;
        }

        return [ [ "List of Customer Refunds" ], $headers ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $refunds = refundModelOrder::latest();

        if ( $this->interval == 'full' ) {
            $refunds = $refunds->get();

        } else {
            $refunds = $refunds->whereMonth( 'created_at', $this->month )->get();
        }

        foreach ( $refunds as $index => $refund ) {
            $boolean = false;
            $_data = [
                $refund->customer->name,
                '',
                '',
                $refund->order->suborder_ent->order->items[0]->name,
                'Peso ' . Helpers::numeric( $refund->order_item->price * $refund->order_item->quantity ),
                $refund->refund_reason_prod_txt,
                $refund->product->shop->name
            ];

            switch ( $this->type ) {
                case 'confirmed':
                    if ( $refund->status == '1' || $refund->status == '3' ) {
                        $_data[2] = Carbon::parse( $refund->updated_at )->format( 'M d, Y h:iA' );
                        $boolean = true;
                    }
                    break;
                
                case 'rejected':
                    if ( $refund->status == '2' || $refund->status == '4' ) {
                        $_data[2] = Carbon::parse( $refund->updated_at )->format( 'M d, Y h:iA' );
                        $boolean = true;
                    }
                    break;
    
                default:
                    if ( $refund->status == '0' ) {
                        $_data[2] = Carbon::parse( $refund->created_at )->format( 'M d, Y h:iA' );
                        $boolean = true;
                    }
                    break;
            }
            $data = ( object ) $_data;
            if ( $boolean ) $this->collection->push( $data );
        }

        return $this->collection;
    }
}
