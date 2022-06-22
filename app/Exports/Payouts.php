<?php

namespace App\Exports;

use App\Helpers;
use App\SellerPayoutRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Payouts implements FromCollection, WithHeadings
{
    protected $status_id, $interval, $columns;

    public function __construct( $status_id, $interval, $columns )
    {
        $this->status_id = $status_id;
        $this->interval = $interval;
        $this->columns = $columns;
    }

    public function headings(): array
    {
        $headers = [ "Payout Number", "Name", "Amount", "GCash Name", "GCash Number", $this->columns['header'], "{reason}" ];

        if ( $this->columns['type'] !== 'Rejected' ) {
            unset( $headers[6] );
        }

        return $headers;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $collection = new Collection();
        $payouts = SellerPayoutRequest::where( 'status', $this->status_id );

        if ( $this->interval == "full" ) {
            $payouts = $payouts->get();

        } else {
            $payouts = $payouts->whereMonth( $this->columns['column'], Carbon::now()->month )->get();
        }

        foreach ( $payouts as $payout_index => $payout ) {
            $_data = [
                "#" . $payout->id,
                $payout->seller->name,
                "Peso " . Helpers::numeric( $payout->amount ),
                $payout->gcash_name,
                $payout->gcash_number,
                $payout->{$this->columns['column']},
                $payout->reject_reason
            ];

            if ( $this->columns['type'] !== 'Rejected' ) {
                unset( $_data[6] );
            }

            $data = ( object ) $_data;
            $collection->push( $data );
        }


        return $collection;
    }
}
