<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('membership/membership_m');
    }

    public function index()
    {
        $param = array(
            'pagecode'=>'FFFFFF',
            'gnb'   => $this->gnb
        );

        $this->load->view('inc/_head',$param);


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

        $result = $this->membership_m->add($data);

        try {
            if ( $result ) {
                $this->add_success();
            } else {
                
            }
        } catch (Exception $e) {
            $e->getMessage();
        }

        //print_r($data);
        //$id = 1;
        //$this->load->view('test',array('id'=>$id));
    }

    //로그인 성공시 리다이렉트
    public function add_success()
    {
        $this->load->view('inc/_head');

        $this->load->view('users/add_success');
        $this->load->view('inc/_foot');
    }

    public function test()
    {

    }

}
