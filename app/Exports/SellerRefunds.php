<?php

namespace App\Exports;

use App\Helpers;
use App\refundModelOrder;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class SellerRefunds implements FromCollection, WithHeadings, WithDrawings, WithCustomStartCell
{
    protected  $type, $interval, $helpers, $collection, $month;

    public function __construct( $type, $interval, $month )
    {
        $this->type = $type;
        $this->interval = $interval;
        $this->month = $month;
        $this->collection = new Collection();
        $this->helpers = new Helpers;
    }

    public function headings(): array
    {
        $headers = [ "Refund Number", "Name", "Reason", "Date", "Status" ];
        return [ [ "List of Customer Refunds" ], $headers ];
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
        $refunds = refundModelOrder::latest()->whereIn( 'status', [ 1, 3, 4 ] );

        if ( $this->interval == "full" ) {
            $refunds = $refunds->get();

        } else {
            $refunds = $refunds->whereMonth( 'created_at', $this->month )->get();
        }

        foreach ( $refunds as $refund_index => $refund ) {
            $dateStatus = [];

            switch ( $this->type ) {
                case 'confirmed':
                    if ( $refund->status == '3' ) {
                        $amount = $refund->order_item->price * $refund->order_item->quantity;
                        $dateStatus = [
                            "Confirmed: " . $this->helpers->humanDate( $refund->created_at, true ),
                            "Refund has been confirmed with an amount of: Peso " . $this->helpers->numeric( $amount / 2 )
                        ];
                    }
                    break;

                case 'rejected':
                    if ( $refund->status == '4' ) {
                        $dateStatus = [
                            "Rejected: " . $this->helpers->humanDate( $refund->updated_at, true ),
                            "Reason: " . $refund->reason
                        ];
                    }
                    break;
                
                default:
                    if ( $refund->status == '1' ) {
                        $dateStatus = [
                            "Requested @ " . $this->helpers->humanDate( $refund->created_at, true ),
                            "Pending Request"
                        ];
                    }
                    break;
            }

            if ( ! $dateStatus ) continue;
            $_data = [
                '#' . $refund->id,
                $refund->customer->name,
                $refund->refund_reason_prod_txt,
                $dateStatus[0] ?? '',
                $dateStatus[1] ?? '',
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
