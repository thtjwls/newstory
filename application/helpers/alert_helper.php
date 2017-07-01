<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function alert($msg = '', $url = '', $mod = 'success') {
	$CI =& get_instance();

	$data = array(
		'msg'	=> $msg,
		'url'	=> $url,
		'mod'	=> $mod
	);

	$CI->load->view('temp/success' ,$data);
}