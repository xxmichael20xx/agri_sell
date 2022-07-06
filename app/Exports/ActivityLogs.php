<?php

namespace App\Exports;

use App\adminNotifModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class ActivityLogs implements FromCollection, WithHeadings, WithStrictNullComparison
{
    protected $collection;

    public function __construct()
    {
        $this->collection = new Collection();
    }

    public function headings(): array
    {
        $headers = [ "Action type", "Decription", "User account name", "Created at" ];
        return [ [ "List of Activity Logs" ], $headers ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $notifs = adminNotifModel::latest()->get();
        $regex = '/<[^>]*>[^<]*<[^>]*>/';

        foreach ( $notifs as $notif ) {
            $data = (object) [
                $notif->action_type,
                preg_replace( $regex, '', $notif->action_description ),
                $notif->user->name ?? 'User has been removed',
                Carbon::parse( $notif->created_at )->format( 'M d, Y h:iA' )
            ];
            $this->collection->push( $data );
        }

        return $this->collection;
    }
}
