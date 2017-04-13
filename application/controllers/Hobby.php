<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hobby extends MY_Controller {

    public function index()
    {
        $param = array(
            'pagecode'=>'101000',
            'gnb'   => $this->gnb
        );

        $this->load->view('inc/_head',$param);

        $this->load->view('inc/_foot');
    }
}