<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	public function index()
	{
		$this->load->view('inc/_head');
		$this->load->view('inc/_page_head');

		$this->load->view('inc/_foot');
	}

	//테스트
	public function init()
    {
        $this->load->view('inc/_head');
        $this->load->view('inc/_page_head');
        $this->load->view('users/membership_v');
        $this->load->view('inc/_foot');
    }
}
