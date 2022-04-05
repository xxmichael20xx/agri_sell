<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deliveryStaffModel extends Model
{
    protected $table = 'deliverystaff';
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
