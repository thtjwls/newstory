<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

    public function index()
    {
        $param = array(
            'pagecode'=>'FFFFFF',
            'gnb'   => $this->gnb
        );

        $this->load->view('inc/_head',$param);

        $this->load->view('users/login_v');

        $this->load->view('inc/_foot');

    }

    public function login_start()
    {
        //로그인 model 호출
        $this->load->model('Login_m');
        $data = $this->input->post(NULL,TRUE);





        if ( $this->Login_m->getRow( $data ) == 1 )
        {			

            if ( ! password_verify($this->input->post('password',TRUE) , $this->Login_m->getPassword($data))) {
                /* 비밀번호 다름 */
                echo '아이디 또는 비밀번호가 다릅니다.';
                return false;
                
            } else {
                /* 세션인증 */
                /*
                $this->session->set_userdata('user_id',$this->input->post('id',TRUE));
                $this->session->set_userdata('is_login',TRUE);
                */

                $remember = $this->input->post('remember',TRUE);


                $exp = ($remember == 'true' )
                    ? 60*60*24*365
                    : 0;

                $cookie[0] = array(
                    'name'   => 'is_login',
                    'value'  => 'true',
                    'expire' => $exp,
                    'domain' => '',
                    'path'   => '/',
                );

                $cookie[1] = array(
                    'name'   => 'newvid_set_Number',
                    'value'  => $this->Login_m->getIdx( $data ),
                    'expire' => $exp,
                    'domain' => '',
                    'path'   => '/',
                );

                set_cookie($cookie[0]);
                set_cookie($cookie[1]);


                echo TRUE;
            }
        } else {
            //아이디 없음.
            echo '아이디가 존재하지 않습니다.';
            return false;
        }

    }

    public function logout()
    {
        delete_cookie('is_login');
        delete_cookie('newvid_set_Number');

        redirect('/');
    }
}
