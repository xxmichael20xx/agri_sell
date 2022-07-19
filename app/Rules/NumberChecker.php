<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NumberChecker implements Rule
{
    private $key, $request;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct( $key, $request = null )
    {
        $this->key = $key;
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ( $this->request && $this->request->is_wholesale == 'on' ) {
            if ( ! is_numeric( $value ) ) return false;
            if ( $value < 0 ) return false;
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
        $key = str_replace( '_', ' ', $this->key );
        return "The {$key} must be a number and at least greater than 1.";
    }
}
