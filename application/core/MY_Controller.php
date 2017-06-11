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
	public $menu;

	public $meta;

    public function __construct()
    {
        parent::__construct();
		$this->load->model("Main_m");

		$result = $this->Main_m->getCategorys();
        $this->menu = $result->result_array();
		
    }
}