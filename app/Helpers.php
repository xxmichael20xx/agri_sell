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
    public static function numeric( $value, $format = 0 ) {
        $data = $value;
        if ( $value && is_numeric( $value ) ) {
            $data = number_format( $value, $format );
        }

        return $data;
    }

    /**
     * Convert timestamp to human date
     * 
     * @param date Timestamp
     * @return String
     */
    public static function humanDate( $date, $hasTime = true ) {
        $format = "M d, Y";
        if ( $hasTime ) $format .= " @ h:i a";
        return date( $format, strtotime( $date ) );
    }

    /**
     * Check if order is pickup or not
     * 
     * @param data Status data
     * @param id Status id
     * @return Boolean
     */
    public static function filterStatus( $data, $id ) {
        if ( $data->name == 'not_pickup' ) return false;
        return true;
    }

    /**
     * Convert the slug to words
     * 
     * @param string Slug to conver
     * @return String
     */
    public function toWords( $string ) {
        $string = ucwords( str_replace( "_", " ", $string ) );

        return $string;
    }
}
