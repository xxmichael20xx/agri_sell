<?php

namespace App\Exports;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Users implements FromCollection, WithHeadings
{
    protected $interval, $role_id;

    public function __construct( $interval, $role_id )
    {
        $this->interval = $interval;
        $this->role_id = $role_id;
    }

    public function headings(): array
    {
        $headers = [ "User number", "Name", "Email", "Mobile Number", "Birthday", "Address" ];
        return $headers;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $collection = new Collection();
        $users = User::where( 'role_id', $this->role_id );

        if ( $this->interval == "full" ) {
            $users = $users->get();

        } else {
            $users = $users->whereMonth( 'created_at', Carbon::now()->month )->get();
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
            $collection->push( $data );
        }

        return $collection;
    }
}
