<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hobby extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->param = array(
            'pagecode'=>'101000',
            'gnb'   => $this->gnb
        );
    }

    public function index()
    {

        $this->lists();
    }

    public function lists()
    {
        $this->load->view('inc/_head',$this->param);

        
        $this->load->view('hobby/hobby_v');
        $this->load->view('inc/_foot');
    }
}