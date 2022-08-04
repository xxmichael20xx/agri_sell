<?php

namespace App\Exports;

use App\Helpers;
use App\TransHistModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class TransactionHistory implements FromCollection, WithHeadings, WithDrawings, WithCustomStartCell
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

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/img/agri_logo.png'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('C1');

        return $drawing;
    }

    public function startCell(): string {
        return 'A6';
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
