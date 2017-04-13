<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-04-05
 * Time: 오후 6:39
 */
class MY_Controller extends CI_Controller
{
    /**
     * MY_Controller constructor.
     */
    public $gnb;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Category');

        $this->gnb = $this->category->Gnb();

    }
}