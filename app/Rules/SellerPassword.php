<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class SellerPassword implements Rule
{
    protected $request;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct( $request )
    {
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes( $attribute, $value )
    {
        $seller = User::find( $this->request->user_id );
        $passwordCheck = Hash::check( $this->request->payout_password, $seller->password );

        if ( ! $passwordCheck ) {
            $this->message = "Password is incorrect!";
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
