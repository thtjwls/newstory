<?php

if ( ! function_exists( 'kstring') ) {

    function kstring ($string, $length = 400 ) {
        preg_match('/([\x00-\x7e]|..)*/', mb_substr($string,0,$length,"utf-8"), $return);  //먼저 자르고 한글 아닌 것은 두글자씩 나머지는 영문기준 한 글자씩 처리한다.

        if ( $length < strlen($string) ) $return[0].="...";    //문자열이 길면 " ... " 을 붙인다.

        return $return[0];
    }
}