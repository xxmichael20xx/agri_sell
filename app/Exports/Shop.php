<?php

namespace App\Exports;

use App\Shop as AppShop;
use App\SubOrder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Shop implements FromCollection, WithHeadings
{
    protected $interval, $type;

    public function __construct( $interval, $type )
    {
        $this->interval = $interval;
        $this->type = $type;
    }

    public function headings(): array
    {
        $headers = [ "Shop Number", "Shop Name", "Description", "Approved Date", "Shop Owner", "Owner Email", "Owner Mobile Number", "Total Orders" ];
        return $headers;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $collection = new Collection();
        $shops = AppShop::where( 'is_active', 1 );

        if ( $this->interval == 'full' ) {
            $shops = $shops->get();

        } else {
            $shops = $shops->whereMonth( 'date_approved', Carbon::now()->month )->get();
        }

        foreach ( $shops as $shop_index => $shop ) {
            $order_count = SubOrder::where('seller_id', $shop->owner->id)->count();
            $_data = [
                'id' => "#" . $shop->id,
                'name' => $shop->name,
                'description' => $shop->description,
                'date_approved' => $shop->date_approved,
                'owner_name' => $shop->owner->name,
                'owner_email' => $shop->owner->email,
                'owner_mobile' => $shop->owner->mobile,
                'order' => $order_count ?? 0
            ];

            $data = ( object ) $_data;
            $collection->push( $data );
        }

        if ( $this->type == 'top' ) {
            $_collection = $collection->sortByDesc( 'order' );
        }

        return $_collection ?? $collection;
    }
}