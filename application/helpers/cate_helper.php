<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('cate') ) {
	function cate( $uri_segment ) {
	
		$pagecode = 100000;

		switch ($uri_segment) {
			case 'home' : $pagecode = 100000; break;
			case 'hobby' : $pagecode = 200000; break;
			case 'culture' : $pagecode = 300000; break;
			case 'lecture' : $pagecode = 400000; break;
			case 'it' : $pagecode = 500000; break;
			case 'design' : $pagecode = 600000; break;
			case 'travel' : $pagecode = 700000; break;
			default : $pagecode = 800000; break;
		}

		return $pagecode;
	}
}
