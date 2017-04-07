<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('inc/_head');


        $this->load->view('admin/intro_v');
        $this->load->view('inc/_foot');
    }

    public function ci_sessionTable()
    {
        $query1 = "CREATE TABLE IF NOT EXISTS ci_sessions (
                   session_id varchar(40) DEFAULT 0 NOT NULL PRIMARY KEY,
                   ip_address varchar(40) DEFAULT 0 NOT NULL,
                   user_agent varchar(120) NOT NULL,
                   last_activity int(10) unsigned DEFAULT 0 NOT NULL,
                   user_data text NOT NULL,
                   KEY last_activity_idx (last_activity)
                   )";

        $db = $this->db->query($query1);

        echo $db->result('arr');

        //echo $query1;
    }

    public function ci_usesrTable()
    {

    }
}
