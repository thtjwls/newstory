<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {

    public function __construct()
    {
        parent::__construct();		
        $this->load->model('Members_m');
    }

    public function index()
    {
        $this->login();
    }

   public function login()
   {

       $this->session->is_login == true
           ? redirect('/')
           : '';

       $this->load->view('login_v');
   }

   public function addMember()
   {
       $this->load->view('addMember_v');
   }

   public function check( $type )
   {
       $get = $this->input->get($type);
       $result = $this->Members_m->getCount( $get, $type );

        print_r($result);
   }

   public function joinMember()
   {
        $postData = $this->input->post(NULL,TRUE);
        $result = $this->Members_m->joinMember( $postData );

        if ( $result ) {
			$msg = '가입되었습니다.<br>로그인 후 이용 해 주세요.';
            alert($msg,'/');
        }
   }

   public function logout()
   {
        unset(
            $_SESSION['sess_name'],
            $_SESSION['sess_id'],
            $_SESSION['sess_nick'],
            $_SESSION['sess_idx'],
            $_SESSION['is_login']
        );
   }

   public function loginGo()
   {
       $data = $this->input->post(NULL,TRUE);

       $result = $this->Members_m->login( $data );


       $is_id = $result->num_rows();       


       /**
        * error code 3
        * 아이디 존재 하지 않을때
        */
       if ( $is_id == 0 ) {
           echo 3;
           exit;
       };

		$row = $result->result_array()[0];

       /**
        * error code 2
        * 비밀번호가 맞지 않음
        */
        if ( ! password_verify($data['password'] , $row['password'] ) ) {
            echo 2;
            exit;
        }

       /**
        * return true
        * 검증완료. 세션생성
        */
       if ( password_verify($data['password'] , $row['password'] ) ) {
           echo 1;

           $userdata = array(
               'sess_name' => $row['name'],
               'sess_id' => $row['id'],
               'sess_nick' => $row['nick'],
               'sess_idx'   => $row['idx'],
               'is_login'   => true
           );

           $this->session->set_userdata( $userdata );
           exit;
       }
   }
}
