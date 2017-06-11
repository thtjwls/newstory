<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-05-30
 * Time: 오후 4:24
 */
class Ajax extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Main_m');
    }

    public function putLike( $idx )
    {

        if ( !$this->session->is_login ) {
            echo '로그인 후 이용 해 주세요.';
            return false;
        }

        $data = array(
            'idx' => $idx,
            'fk_member' => $this->session->sess_idx
        );

        $result = $this->Main_m->putLikeList( $data );

        if ( $result->num_rows() == 0 ) {
            $like = $this->Main_m->putLike( $data );

            //정상 쿼리가 돌면 다시 쿼리를 보내서 카운트 합니다.
            if ( $like == true ) {
                echo $this->Main_m->getLike( $idx )->num_rows();
            } else {
                echo '치명적인 오류가 발견되었어요...';
            }
        } else {
            echo '이미 좋아하셨어요!!';
        }
    }

    public function setComment( $idx )
    {
        $data = $this->input->post(NULL,TRUE);

        $result = $this->Main_m->setComment( $idx, $data );

        if ( ! $result ) {
            echo '알수없는 문제로 작성에 실패하였습니다. 잠시 후 다시 시도 해 주세요.';
        } else {
            echo true;
        }
    }

    public function setRe( $idx )
    {
        $data = $this->input->post(NULL,TRUE);
        $data['idx'] = $idx;


        $result = $this->Main_m->setRe( $data );

        if ( $this->session->is_login != true ) {
            echo '로그인 후 이용 해 주세요.';
            exit;
        }

        if ( $result == true ) {
            echo true;
        }
    }

    public function update() {
        $idx = $this->uri->segment(3);
        $post = $this->input->post(NULL,FALSE);


        $result = $this->Main_m->update( $idx, $post );


        $category = $this->Main_m->getCategorys( $post['nb_category'] )->result_array()[0];

        if( $result == true ){
            $msg = '게시물이 변경되었습니다.';
            $url = '/main/views' . $category['path'] . '/' . $this->uri->segment(3);

            alert($msg,$url,'success');
        }
    }

    public function upload_receive()
    {

        $upload_dir = './upload/user/' . $this->session->sess_id;

        if( ! is_dir( $upload_dir ) ){
            @mkdir( $upload_dir, 0777 );
        }

        $config['upload_path'] = $upload_dir;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        //$config['max_size'] = '1000';
        $config['max_width']  = '1024';
        //$config['max_height']  = '768';


        $this->load->library('upload', $config);


        if ( ! $this->upload->do_upload('upload') )
        {
            echo "<script>alert('업로드에 실패 하였습니다. 사진 용량은 10MB, 1024 폭 이하로 업로드 해주세요.');</script>";

        }
        else
        {
            $data = $this->upload->data();

            /**
             *$fileinfo array
             *Array
             *(
             *    [file_name] => logo_main1.png
             *    [file_type] => image/png
             *    [file_path] => /home/newvid/blog.newvid.co.kr/upload/user/thtjwls/
             *    [full_path] => /home/newvid/blog.newvid.co.kr/upload/user/thtjwls/logo_main1.png
             *    [raw_name] => logo_main1
             *    [orig_name] => logo_main.png
             *    [client_name] => logo_main.png
             *    [file_ext] => .png
             *    [file_size] => 7.41
             *    [is_image] => 1
             *    [image_width] => 500
             *    [image_height] => 184
             *    [image_type] => png
             *    [image_size_str] => width="500" height="184"
             *)
             */

            $fileinfo = $data;

            $filename = $data['file_name'];

            $result = $this->Main_m->upload_file_insert( $fileinfo );


            $url = '/upload/user/'. $this->session->sess_id. '/' . $filename;

            $CKEditorFuncNum = $this->input->get('CKEditorFuncNum');

            echo"<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('{$CKEditorFuncNum}', '{$url}', '등록되었습니다.')</script>";
        }
    }

    public function insert()
    {
        $data = $this->input->post(NULL,FALSE);

        //$data['ck_tx'] = str_replace("'","\'",$data['ck_tx']);

        $data['idx'] = $this->session->sess_idx;

        $result = $this->Main_m->setList( $data );

        if ( $result == true ) {

            $data = array(
                'msg'	=> '등록 되었어요!',
                'url'	=> '/'
            );


            $this->load->view('temp/success', $data);
        }
    }

    public function viewDel( $idx ){

        echo $result = $this->Main_m->viewDel( $idx );
    }

}