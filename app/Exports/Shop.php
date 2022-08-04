<?php

namespace App\Exports;

use App\Shop as AppShop;
use App\SubOrder;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class Shop implements FromCollection, WithHeadings, WithDrawings, WithCustomStartCell
{
    protected $interval, $type, $month, $props, $collection;

    public function __construct( $interval, $type, $month, $props = [] )
    {
        $this->interval = $interval;
        $this->type = $type;
        $this->month = $month;
        $this->props = $props;
        $this->collection = new Collection();
    }

    public function headings(): array
    {
        $headers = [ "Shop Name", "Description", "Approved Date", "Shop Owner", "Owner Email", "Owner Mobile Number", "Total Orders" ];

        if ( $this->isPDFFull() ) {
            unset( $headers[6] );
            array_values( $headers );
        }

        if ( $this->validateKey( 'type', 'pdf' ) && $this->type == 'top' ) {
            unset( $headers[5] );
            array_values( $headers );
        }

        return [ [ "List of Approved Shops" ], $headers ];
    }

    public function isPDFFull() {
        $boolean = $this->validateKey( 'type', 'pdf' ) && $this->type == 'full';
        return $boolean;
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
        $shops = AppShop::where( 'is_active', 1 );

        if ( $this->interval == 'full' ) {
            $shops = $shops->get();

        } else {
            $shops = $shops->whereMonth( 'date_approved', $this->month )->get();
        }

        foreach ( $shops as $shop_index => $shop ) {
            if ( ! $shop->owner ) continue;
            $order_count = SubOrder::where( 'seller_id', $shop->owner->id )->count();
            $_data = [
                'name' => $shop->name,
                'description' => $shop->description,
                'date_approved' => $shop->date_approved,
                'owner_name' => $shop->owner->name,
                'owner_email' => $shop->owner->email,
                'owner_mobile' => $shop->owner->mobile,
                'order' => $order_count ?? 0
            ];

            if ( $this->isPDFFull() ) {
                unset( $_data['order'] );
                array_values( $_data );
            }

            if ( $this->validateKey( 'type', 'pdf' ) && $this->type == 'top' ) {
                unset( $_data['owner_mobile'] );
                array_values( $_data );
            }

            $data = ( object ) $_data;
            $this->collection->push( $data );
        }

        if ( $this->type == 'top' ) {
            $this->collection = $this->collection->sortByDesc( 'order' );
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

    public function validateKey( $key, $compare ) {
        $exist = isset( $this->props[$key] );

        if ( ! $exist ) return false;
        return ( $this->props[$key] == $compare ) ? true : false;
    }
}
