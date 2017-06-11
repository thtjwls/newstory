<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-04-11
 * Time: 오후 2:12
 */
class Category_m extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 모든 데이터를 배열로 받음
     */
    public function getData()
    {
        $query = $this->db->query('SELECT * FROM nb_category WHERE public = 1 ORDER BY idx ASC');
        //$result = $query->result_array();

        return $query;
    }

    public function getCategoryInfo( $select )
    {
        $sql = "SELECT idx FROM nb_category WHERE path = '/" . $select . "'";

        //return $sql;
        return $this->db->query( $sql )->result_array();
    }

}