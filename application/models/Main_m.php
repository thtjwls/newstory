<?php

/**
 * Created by PhpStorm.
 * User: my
 * Date: 2017-04-18
 * Time: 오전 12:12
 */
class Main_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getLists($category)
    {
        $query = $this->db->query('SELECT * FROM `nb_list` where FK_category = "100000" left join nb_category on nb_list.FK_category = nb_category.idx');
    }
}