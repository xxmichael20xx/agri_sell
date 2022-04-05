<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adminNotifModel extends Model
{
    protected $table = 'admin_notification';

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
