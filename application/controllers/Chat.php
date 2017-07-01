<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-05-30
 * Time: 오후 6:56
 */
class Chat extends CI_Controller
{
    public $version = '1.0.0';

    public function __construct()
    {
        parent::__construct();
        $config['base_path'] = $_SERVER['SERVER_NAME'] . '3000';
    }

    public function _remap( $method )
    {
        $h_data = array(
            'version' => $this->version
        );
        $this->load->view('chat/inc/_head',$h_data);
        $this->load->view('chat/inc/page_head');

        if ( ! method_exists( $this, $method ) )
        {
            print_r($this);
            $this->{$method}();
        }

        $this->load->view('chat/inc/_foot');
    }

    public function index()
    {
        $this->load->view('chat/chat_v');
    }
}