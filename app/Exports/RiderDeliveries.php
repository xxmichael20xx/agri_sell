<?php

namespace App\Exports;

use App\Helpers;
use App\SubOrder;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class RiderDeliveries implements FromCollection, WithHeadings
{
    use Exportable;

    protected  $type, $helpers, $collection;

    public function __construct( $type )
    {
        $this->type = $type;
        $this->collection = new Collection();
        $this->helpers = new Helpers;
    }

    public function headings(): array
    {
        $headers = [ "Customer Name", "Address", "Order Total", "Is Order Paid", "Status", "Delivered by", "Date Ordered" ];
        return [ [ "List of Delivery - " . ucwords( $this->type ) ], $headers ];
    }

    /* public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/img/agri_logo.png'));
        $drawing->setHeight(90);
        $drawing->setWidth(120);
        $drawing->setCoordinates('B10');

        return $drawing;
    } */

    /* public function registerEvents(): array {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $workSheet = $event->sheet->getDelegate();

                // insert images
                $this->drawings()->setWorksheet($workSheet);
            },
        ];
    } */

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // $ids = $this->type ? $this->setIds( $this->type ) : array( 3, 4, 5, 6, 9 );
        $orders = SubOrder::where( 'is_pick_up', 'no' )->whereIn( 'status_id', $this->setIds( $this->type ) );

        switch ( $this->type ) {
            case 'today':
                $orders = $orders->whereDate( 'created_at', Carbon::today() )->get();
                break;

            case 'monthly':
                $orders = $orders->whereMonth( 'created_at', Carbon::parse( now() )->month )->get();
                break;

            case 'yearly':
                $orders = $orders->whereYear( 'created_at', Carbon::parse( now() )->year )->get();
                break;

            case 'completed':
                $orders = $orders->get();
                break;
            
            default:
                $orders = $orders->get();
                break;
        }

        $isAdmin = auth()->user()->role_id == 1 ? true : false;
        $my_rider_id = 0;

        if ( ! $isAdmin ) $my_rider_id = auth()->user()->rider_staff->id;

        foreach ( $orders as $index => $order ) {
            if ( ! $order->order ) {
                $orders->forget( $index );
                continue;

            } else if ( ! $isAdmin && $order->order->rider_id !== $my_rider_id ) {
                $orders->forget( $index );
                continue;
            }

            $method = $order->order->payment_method;
            $isPaid = $method == 'agrisell_coins' || $order->order->is_paid;

            $_user = User::find( $order->order->user_id );
            $_data = [
                $order->order->shipping_fullname,
                $_user ? "{$_user->address} {$_user->barangay}, {$_user->town}" : "",
                "Peso " . $this->helpers->numeric( $order->order->grand_total ),
                $isPaid ? "Paid" : "Unpaid",
                $this->setStatus( $order ),
                $order->order->rider->user->name,
                $this->helpers->humanDate( $order->created_at, true )
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

    public function setIds( $type ) {
        $ids = [];

        switch ( $type) {
            case 'to-pick-up':
                $ids = [ 9 ];
                break;

            case 'pick-up-success':
                $ids = [ 3 ];
                break;

            case 'on-out-for-delivery':
                $ids = [ 4 ];
                break;

            case 'completed':
                $ids = [ 5, 6 ];
                break;

            case 'failed':
                $ids = [ 6 ];
                break;
            
            default:
                $ids = [ 3, 4, 5, 6, 9 ];
                break;
        }

        return $ids;
    }

    public function setStatus( $order ) {
        switch ( $order->status_id ) {
            case 9:
                $status = "Ready for pickup";
                break;

            case 3:
                $status = "Pick up success";
                break;

            case 4:
                $status = "On out delivery";
                break;

            case 5:
                $status = "Delivery Success";
                break;

            case 6:
                $status = "Delivery Failed";
                $status .= " - Reason: " . $order->order_notes;
                break;
            
            default:
                $status = "Status";
                break;
        }

        return $status;
    }
}
