<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class It extends MY_Controller {

    public function index()
    {
        $param = array(
            'pagecode'  =>'401000',
            'gnb'       => $this->gnb
        );

        $this->load->view('inc/_head',$param);

        $this->load->view('inc/_foot');
    }
}