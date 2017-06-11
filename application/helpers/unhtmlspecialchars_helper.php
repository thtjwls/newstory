<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-05-31
 * Time: 오후 12:32
 */
if ( ! function_exists('unhtmlspecialchars') ) {
    function unhtmlspecialchars( $string )
    {
        $string = str_replace ( '&amp;', '&', $string );
        $string = str_replace ( '&#039;', '\'', $string );
        $string = str_replace ( '&quot;', '\"', $string );
        $string = str_replace ( '&lt;', '<', $string );
        $string = str_replace ( '&gt;', '>', $string );

        return $string;
    }
}