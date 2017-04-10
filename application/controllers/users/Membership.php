<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('membership/Membership_m');
    }

    public function index()
    {
        $this->load->view('inc/_head');
		$this->load->view('inc/_page_head');


        $this->load->view('users/membership_v');

        $this->load->view('inc/_foot');
    }

	public function idCheck()
	{
		$id = $this->input->post('id',TRUE);
		$query = $this->db->get_where('users', array('id' => $id));

		echo $query->num_rows();
	}

	public function add()
    {
        $data = $this->input->post(NULL,TRUE);

        //$this->membership_m->add($data);

        //print_r($data);
        //$id = 1;
        //$this->load->view('test',array('id'=>$id));
    }

}
