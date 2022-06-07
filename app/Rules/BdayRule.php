<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class BdayRule implements Rule
{
    protected $status;
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
    public function passes($attribute, $value)
    {
        $now = Carbon::now();
        $date = Carbon::parse( $value );

        if ( $date->isAfter( $now ) ) {
            $this->status = "after";
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
        switch ( $this->status) {
            case "after":
                return "Birth date can't be a future date.";
                break;
            
            default:
                return "Please enter a valid birth date";
                break;
        }
    }
}
