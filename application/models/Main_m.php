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
        $query = $this->db->query('SELECT * FROM `newstory_list` where FK_category = "100000" left join newstory_category on newstory_list.FK_category = newstory_category.idx');
    }
}