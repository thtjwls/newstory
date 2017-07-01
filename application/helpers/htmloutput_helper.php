<?
if ( !function_exists( 'htmloutput') ) {

	/**
	 * 한글, 문자, 숫자만 추출하는 헬퍼
	 */

	function htmloutput($str, $len = 40) {

	    $replace = array(
            '&nbsp;','&lsquo;','&rsquo;','&lt;','&gt;'
        );

	    for ($i = 0; $i < count($replace); $i++) {
	        $str = str_replace($replace[$i],'',$str);
        }

	    $str = str_replace('&nbsp;','',$str);

	    $str = strip_tags( $str );
        $str = htmlspecialchars( $str );
        $str = trim( $str );
        //$str=str_replace("\t", "", $str);
        $str=str_replace("\n", "", $str);

        for ($i = 0; $i < count($replace); $i++) {
            $str = str_replace($replace[$i],'',$str);
        }

        if ( mb_strlen( $str,'utf-8' ) > $len ) {
            $str = kstring($str,$len);
        }


        return $str;
		
	}
}