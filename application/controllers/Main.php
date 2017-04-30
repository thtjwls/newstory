<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	public function index()
	{

	    $this->load->view('inc/_head');
        $this->load->view('inc/_menu');

        $this->load->view('main_v');
        $this->load->view('inc/_foot');
	}
}
