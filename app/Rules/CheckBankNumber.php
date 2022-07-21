<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckBankNumber implements Rule
{
    protected $message;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $length = strlen( $value );

        if ( ! is_numeric( $value ) ) {
            $this->message = 'Account number must be a valid number';
            return false;
        }

        if ( $length >= 8 && $length <= 18 ) {
            return true;
        }

        $this->message = 'Account number must be between 8 and 18';
        return false;
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
