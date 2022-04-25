<?php

namespace App;

class Helpers {

    /**
     * Check if value is number
     * If it's a number, convert it to a number format with comma
     * 
     * @param value Number or string
     * @return String/Number
     */
    public static function numeric( $value ) {
        $data = $value;
        if ( $value && is_numeric( $value ) ) {
            $data = number_format( $value );
        }

        return $data;
    }

    public static function humanDate( $date ) {
        return date( 'M d, y @ h:i a', strtotime( $date ) );
    }

    public static function filterStatus( $data, $id ) {
        if ( $data->name == 'not_pickup' ) return false;
        return true;
    }
}
