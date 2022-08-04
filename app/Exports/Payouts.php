<?php

namespace App\Exports;

use App\Helpers;
use App\SellerPayoutRequest;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class Payouts implements FromCollection, WithHeadings, WithDrawings, WithCustomStartCell
{
    protected $status_id, $interval, $columns, $month, $collection;

    public function __construct( $status_id, $interval, $columns, $month )
    {
        $this->status_id = $status_id;
        $this->interval = $interval;
        $this->columns = $columns;
        $this->month = $month;
        $this->collection = new Collection();
    }

    public function headings(): array
    {
        $headers = [ "Name", "Amount", "Type", "Name", "Number", $this->columns['header'], "Reason" ];

        if ( $this->columns['type'] !== 'Rejected' ) {
            unset( $headers[7] );
        }

        return [ [ "List of Seller Payout" ], $headers ];
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
        $payouts = SellerPayoutRequest::where( 'status', $this->status_id );

        if ( $this->interval == "full" ) {
            $payouts = $payouts->get();

        } else {
            $payouts = $payouts->whereMonth( $this->columns['column'], $this->month )->get();
        }

        foreach ( $payouts as $payout_index => $payout ) {
            $type = "GCash";

            if ( isset( $payout->metadata['type'] ) ) {
               $type = $payout->metadata['type'];
            }

            $_data = [
                $payout->seller->name,
                "Peso " . Helpers::numeric( $payout->amount ),
                $type,
                $payout->gcash_name,
                $payout->gcash_number,
                $payout->{$this->columns['column']},
                $payout->reject_reason
            ];

            if ( $this->columns['type'] !== 'Rejected' ) {
                unset( $_data[6] );
            }

            $data = ( object ) $_data;
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
