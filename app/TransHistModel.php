<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransHistModel extends Model
{
    protected $table = "trans_hist";

    public function user_master(){
        return $this->belongsTo(User::class, 'user_id_master', 'id');
    }

    public function user_slave(){
        return $this->belongsTo(User::class, 'user_id_slave');
    }
}
