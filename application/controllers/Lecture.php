<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lecture extends MY_Controller {

    public function index()
    {
        $param = array(
            'pagecode'=>'301000',
            'gnb'   => $this->gnb
        );

        $this->load->view('inc/_head',$param);

        $this->load->view('inc/_foot');
    }
}