<?php

namespace App\Exports;

use App\adminNotifModel;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ActivityLogs implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [ "ID", "Action type", "Decription", "User account name", "Created at" ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $collection = new Collection();
        $notifs = adminNotifModel::latest()->get();
        $regex = '/<[^>]*>[^<]*<[^>]*>/';

        foreach ( $notifs as $notif ) {
            $data = (object) [
                "#" . $notif->id,
                $notif->action_type,
                preg_replace( $regex, '', $notif->action_description ),
                $notif->user->name ?? '',
                $notif->created_at
            ];
            $collection->push( $data );
        }

        return $collection;
    }
}
