<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coinsTopUpEmployeeEntry extends Model
{
    protected $table = 'coins_top_up_emp_entry';

    public function employee()
    {
        return $this->belongsTo(User::class, 'emp_user_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'cust_user_id', 'id');
    }

    public function coins_top_up()
    {
        return $this->belongsTo(coinsTopUpModel::class, 'cust_trans_id', 'trans_id');
    }

    

}
