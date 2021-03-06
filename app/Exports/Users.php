<?php

namespace App\Exports;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Users implements FromCollection, WithHeadings
{
    protected $interval, $role_id, $month, $collection;

    public function __construct( $interval, $role_id, $month )
    {
        $this->interval = $interval;
        $this->role_id = $role_id;
        $this->month = $month;
        $this->collection = new Collection();
    }

    public function headings(): array
    {
        $headers = [ "User number", "Name", "Email", "Mobile Number", "Birthday", "Address" ];
        return [ [ "List of Users" ], $headers ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $users = User::where( 'role_id', $this->role_id );

        if ( $this->interval == "full" ) {
            $users = $users->get();

        } else {
            $users = $users->whereMonth( 'created_at', $this->month )->get();
        }

        foreach ( $users as $user_index => $user ) {
            $_data = [
                "#" . $user->id,
                $user->name,
                $user->email,
                $user->mobile,
                $user->bday,
                "{$user->address} {$user->barangay} {$user->town}, {$user->province}"
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
