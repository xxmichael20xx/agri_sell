<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    protected $table = 'notification_table';

    public function from_user(){
        return $this->belongsTo(User::class, 'frm_user_id', 'id');
    }
}
