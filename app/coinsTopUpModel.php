<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coinsTopUpModel extends Model
{
    protected $table = 'coins_top_up';
    public $timestamps = false;
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function approved_by(){
        return $this->belongsTo(User::class, 'approved_by_user_id', 'id');
    }
}
