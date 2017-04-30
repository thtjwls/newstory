<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership_m extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

    public function add( $data )
    {
        /* password hash */
        $password = password_hash($data['password'],PASSWORD_BCRYPT);

        $insert = array(
            'name'      => $data['name'],
            'id'        => $data['id'],
            'password'  => $password,
            'email'     => $data['email'],
            'tel'       => $data['tel']
        );
        $result = $this->db->insert('nb_members',$insert);

        return $result;
    }
}