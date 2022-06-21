<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invalidIdreason extends Model
{
    protected $table = 'invalid_id_reasons';
    public $timestamps = false;

    protected $fillable = [
        'slug', 'display_name', 'description'
    ];
}
