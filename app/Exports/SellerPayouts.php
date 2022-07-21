<?php

namespace App\Exports;

use App\Helpers;
use App\refundModelOrder;
use App\SellerPayoutRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SellerPayouts implements FromCollection, WithHeadings
{
    protected  $interval, $helpers, $collection, $month;

    public function __construct( $interval, $month )
    {
        $this->interval = $interval;
        $this->month = $month;
        $this->collection = new Collection();
        $this->helpers = new Helpers;
    }

    public function headings(): array
    {
        $headers = [ "Payout #", "Type", "Amount", "Week Range", "Date Requested", "Status" ];
        return [ [ "List of Seller Payout" ], $headers ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $payouts = SellerPayoutRequest::where( 'user_id', auth()->user()->id )->latest();

        if ( $this->interval == "full" ) {
            $payouts = $payouts->get();

        } else {
            $payouts = $payouts->whereMonth( 'created_at', $this->month )->get();
        }

        foreach ( $payouts as $payout_index => $payout ) {
            switch ( $payout->status ) {
                case '0':
                    $status = 'PENDING';
                    break;

                case '1':
                    $status = 'CONFIRMED';
                    break;

                default:
                    $status = 'REJECTED - ' . $payout->reject_reason;
                    break;
            }

            $_data = [
                "#" . $payout->id,
                $payout->metadata['type'],
                "Peso " . $this->helpers->numeric( $payout->amount ),
                $this->helpers->humanDate( $payout->payout->week_start, false ) . " - " . $this->helpers->humanDate( $payout->payout->week_end, false ),
                $this->helpers->humanDate( $payout->created_at ),
                $status
            ];

            $data = (object) $_data;
            $this->collection->push( $data );
        }

        foreach ( range( 1, 5 ) as $num ) {
            $space = [];
            foreach( range( 1, count( $this->headings()[1] ) ) as $_ ) {
                $space[] = "";
            }

            if ( $num == 5 ) {
                $lastIndex = array_key_last( $space );
                $space[$lastIndex] = "Validated by: Agrisell Admin";
            }
            $this->collection->push( (object) $space );
        }

        return $this->collection;
    }
}
