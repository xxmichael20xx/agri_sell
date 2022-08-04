<?php

namespace App\Exports;

use App\adminNotifModel;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ActivityLogs implements FromCollection, WithHeadings, WithStrictNullComparison, WithDrawings, WithCustomStartCell
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
        $notifs = adminNotifModel::latest()->get();
        $regex = '/<[^>]*>[^<]*<[^>]*>/';

        foreach ( $notifs as $notif ) {
            $action = $notif->action_type;

            if ( $action == 'User regisration' ) {
                $content = explode( ':', $notif->action_description );
                $email = $content[1];
                $tempUser = User::where( 'email', $email )->first();
            }

            if ( $action == 'User regisration' && $tempUser ) {
                $userAccount = $tempUser->name;
            } else {
                $userAccount = $notif->user->name ?? '';
            }

            $data = (object) [
                $notif->action_type,
                preg_replace( $regex, '', $notif->action_description ),
                $userAccount,
                Carbon::parse( $notif->created_at )->format( 'M d, Y h:iA' )
            ];
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
