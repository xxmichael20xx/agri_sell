<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class UserValidId extends Model
{
    protected $table = "user_valid_ids";
    public $timestamps = false;

    public function owner(){
        return $this->belongsTo(User::class, 'user_email', 'email');
    }

    public function invalid_reason(){
        return $this->belongsTo(invalidIdreason::class, 'invalid_reason_id', 'id');
    }

}
