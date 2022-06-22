<?php

namespace App\Exports;

use App\Shop as AppShop;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Shop implements FromCollection, WithHeadings
{
    protected $type, $interval;

    public function __construct( $type, $interval )
    {
        $this->type = $type;
        $this->interval = $interval;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $collection = new Collection();
        $shops = AppShop::where( 'is_active', 1 );
    }
}
