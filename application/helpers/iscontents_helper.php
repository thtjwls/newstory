<?php
if ( !function_exists( 'iscontents') ) {
	/**
	 * 담아낸 컨텐츠에 이미지 또는 영상이 있는지 확인
	 */
	function iscontents( $data ) {
		
		$pattern = '/src=\"(.[^"]+)"/';		
		$image = array(
			'.jpg','.png','.gif'
		);

		//$int = preg_match_all($pattern[$type], $data, $src_location);

		preg_match_all($pattern, $data, $src);

		$le_src = substr($src[1][0], -4);
		$pos = in_array($le_src,$image);
		
		if ( $pos == true ) {
			$post['type'] = 'image'
		}
		

		return $pos;
		
	}
}