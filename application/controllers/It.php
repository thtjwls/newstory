<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class It extends MY_Controller {

    private $param;

    public function __construct()
    {
        parent::__construct();

        $this->param  = array (
            'pagecode' => '401000',
            'gnb'   => $this->gnb
        );
    }

    public function index()
    {
        /*
        $param = array(
            'pagecode'  =>'401000',
            'gnb'       => $this->gnb
        );

        $this->load->view('inc/_head',$this->param);

        $this->load->view('inc/_foot');
        */

        $this->lists();
    }

    public function lists()
    {

        $this->load->view('inc/_head',$this->param);



        $this->load->view('inc/_foot');
    }
}