<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members_m extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

    /**
     * @param $get
     * @param $type
     * @return mixed
     * @comment 회원가입 아이디, 닉네임 중복 검사
     */
	public function getCount( $get, $type )
    {
        $query = "SELECT {$type} FROM nb_members WHERE {$type} = '{$get}'";
        $result = $this->db->query( $query );

        return $result->num_rows();
    }

    public function joinMember( $data )
    {
        $password = PASSWORD_HASH($data['password'],PASSWORD_BCRYPT);

        $array = array(
            'name' => $data['name'],
            'nick' => $data['nick'],
            'id'    => $data['id'],
            'password' => $password,
            'email' => $data['email'],
            'in_use'    => TRUE,
            'regist_day'    => date('Y-m-d H:i:s'),
            'regist_ip' => $_SERVER['REMOTE_ADDR'] . ':' .$_SERVER['REMOTE_PORT']
        );

        return $this->db->insert('nb_members',$array);
    }

    public function login( $data )
    {
        $str = "SELECT * FROM nb_members WHERE id = '{$data['id']}'";

		return $query = $this->db->query( $str );
    }
}