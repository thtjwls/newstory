<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	public function index()
	{
	    $param = array(
	        'pagecode'=>'000000',
            'gnb'   => $this->gnb
        );

		$this->load->view('inc/_head',$param);
//		$this->load->view('inc/_page_head');

        $this->load->view('home/home');

		$this->load->view('inc/_foot');
	}
}
