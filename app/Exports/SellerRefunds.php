<?php

namespace App\Exports;

use App\Helpers;
use App\refundModelOrder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SellerRefunds implements FromCollection, WithHeadings
{
    protected  $interval, $helpers, $collection;

    public function __construct( $interval )
    {
        $this->interval = $interval;
        $this->collection = new Collection();
        $this->helpers = new Helpers;
    }

    public function headings(): array
    {
        $headers = [ "Refund Number", "Name", "Reason", "Date", "Status" ];
        return $headers;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $refunds = refundModelOrder::latest()->whereIn( 'status', [ 1, 3, 4 ] );

        if ( $this->interval == "full" ) {
            $refunds = $refunds->get();

        } else {
            $refunds = $refunds->whereMonth( 'created_at', Carbon::parse( now() )->month )->get();
        }

        foreach ( $refunds as $refund_index => $refund ) {
            $dateStatus = [];

            switch ( $refund->status ) {
                case '3':
                    $amount = $refund->order_item->price * $refund->order_item->quantity;
                    $dateStatus = [
                        "Confirmed: " . $this->helpers->humanDate( $refund->created_at, true ),
                        "Refund has been confirmed with an amount of: Peso" . $this->helpers->numeric( $amount / 2 )
                    ];
                    break;

                case '4':
                        $dateStatus = [
                            "Rejected: " . $this->helpers->humanDate( $refund->updated_at, true ),
                            "Reason: " . $refund->reason
                        ];
                        break;
                
                default:
                    $dateStatus = [
                        "Requested @ " . $this->helpers->humanDate( $refund->created_at, true ),
                        "Pending Request"
                    ];
                    break;
            }

            $_data = [
                '#' . $refund->id,
                $refund->customer->name,
                $refund->refund_reason_prod_txt,
                $dateStatus[0],
                $dateStatus[1],
            ];

            $data = (object) $_data;
            $this->collection->push( $data );
        }

        return $this->collection;
    }
}
