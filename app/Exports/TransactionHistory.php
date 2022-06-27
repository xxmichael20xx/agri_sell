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
    protected $interval, $helpers;

    public function __construct( $interval )
    {
        $this->interval = $interval;
        $this->helpers = new Helpers;
    }

    public function headings(): array
    {
        $headers = [ "Transaction #", "Name", "Transaction type", "Amount", "Transaction Reference ID", "Date" ];
        return $headers;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $collection = new Collection();
        $transactions = TransHistModel::orderByDesc('created_at');

        if ( $this->interval == "full" ) {
            $transactions = $transactions->get();
        } else {
            $transactions = $transactions->whereMonth( "created_at", Carbon::now()->month )->get();
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
                    $transaction->created_at
                ];

                $data = (object) $_data;
                $collection->push( $data );
            }
        }

        return $collection;
    }
}
