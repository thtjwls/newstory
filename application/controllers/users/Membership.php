<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership extends MY_Controller {

    public function index()
    {
        $this->load->view('inc/_head');


        $this->load->view('users/membership_v');

        $this->load->view('inc/_foot');
    }
}
