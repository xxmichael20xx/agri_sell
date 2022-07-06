<?php

namespace App\Exports;

use App\Helpers;
use App\TransHistModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionHistory implements FromCollection, WithHeadings
{
    protected $collection, $interval, $helpers, $month;

    public function __construct( $interval, $month )
    {
        $this->interval = $interval;
        $this->month = $month;
        $this->helpers = new Helpers;
        $this->collection = new Collection();
    }

    public function headings(): array
    {
        $headers = [ "Transaction #", "Name", "Transaction type", "Amount", "Transaction Reference ID", "Date" ];
        return [ [ "List of Transactions" ], $headers ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $transactions = TransHistModel::orderByDesc('created_at');

        if ( $this->interval == "full" ) {
            $transactions = $transactions->get();
        } else {
            $transactions = $transactions->whereMonth( "created_at", $this->month )->get();
        }

        foreach ( $transactions as $transaction_index => $transaction ) {
            if ( $transaction->user_master ) {
                $amount = "Peso " . $this->helpers->numeric( $transaction->amount );

                if ( $transaction->amount == 'not applicable' || $transaction->amount == '0' ) {
                    $amount = "Peso 0 ( no payment )";
                }
                $_data = [
                    '#' . $transaction->id,
                    $transaction->user_master->name,
                    $transaction->trans_type,
                    $amount,
                    $transaction->trans_ref_id,
                    Carbon::parse( $transaction->created_at )->format( 'M d, Y h:iA' )
                ];

                $data = (object) $_data;
                $this->collection->push( $data );
            }
        }

        return $this->collection;
    }
}
