<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-04-11
 * Time: 오후 2:12
 */
class Login_m extends CI_Model
{

	private $table = 'nb_members';

    public function __construct()
    {
        parent::__construct();
    }


    public function getRow( $data )
    {
        $query = $this->db->get_where($this->nb_members,array('id'=>$data['id']));

        return $query->num_rows();
    }

    public function getId($query)
    {
        /* */
    }

    public function getIdx( $data )
    {
        $query = $this->db->get_where($this->nb_members,array('id'=>$data['id']));

        return $query->row()->idx;
    }

    public function getPassword( $data )
    {
        $query = $this->db->get_where($this->nb_members,array('id'=>$data['id']));

        return $query->row()->password;
    }

    public function getEmail( $data )
    {
        $query = $this->db->get_where($this->nb_members,array('id'=>$data['id']));

        return $query->row()->getEmail;
    }

    public function getTel( $data )
    {
        $query = $this->db->get_where($this->nb_members,array('id'=>$data['id']));

        return $query->row()->getTel;
    }

    public function getParams( $table )
    {
        return $this->db->query("SELECT * FROM {$table}")->result();
    }

}