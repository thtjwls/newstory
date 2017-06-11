<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2017-05-30
 * Time: 오전 12:28
 */
class Me extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        $this->load->view('inc/_menu');
        $this->load->view('inc/_page_head');
        $this->load->view('welcome_message');
        $this->load->view('inc/_foot');
    }
}