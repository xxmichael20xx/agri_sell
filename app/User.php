<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravelista\Comments\Commenter;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, Commenter;


    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'user_id', 'user_name', 'email_verified_at','IsdefaultPassword', 'address', 'barangay', 'town', 'province' ,'mobile', 'bday'

    ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'is_valid'
    ];


    public function shop()
    {
        return $this->hasOne(Shop::class, 'user_id');
    }

    public function role(){
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function rider_staff(){
        return $this->hasOne(deliveryStaffModel::class, 'user_id');
    }

    public function coinsEmployee(){
        return $this->hasOne(coinsEmployee::class, 'emp_user_id', 'id');
    }

    public function payouts() {
        return $this->hasMany( SellerPayout::class );
    }

    public function isAdmin()
    {
        return ($this->role->id == '1') ? true : false;
    }
    public function isSeller()
    {
        return ($this->role->id == '3') ? true : false;
    }
    public function isRider()
    {
        return ($this->role->id == '5') ? true : false;
    }

    public function isCoinsTopUpEmployee()
    {
        return ($this->role->id == '6') ? true : false;
    }
    public function isRegularUser()
    {
        return ($this->role->id == '2') ? true : false;
    }

    public function getIsValidAttribute() {
        $isValid = UserValidId::where( 'user_id', auth()->user()->id )->first();

        if ( ! $isValid ) return false;
        return $isValid->status == 1 ? true : false;
    }
}
