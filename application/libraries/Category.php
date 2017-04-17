<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category {

    /**
     * 메뉴 코드 정의
     * @return array
     * @comment 대메뉴
     * array('$code','$name','$subcategory count','$path(CI)');
     */
    public function Gnb()
    {
        /*
         *
         * $CI->load->database();
         */
        $CI =& get_instance();
        $CI->load->model('Category_m');

        $menu1 = $CI->Category_m->getData();

        return $menu1;

        /*
        $menu1 = array(
            array('000000','HOME','0','/'),
            array('100000','취미·유머','0','/hobby'),
            array('200000','문화','0','/culture'),
            array('300000','강의','0','/lecture'),
            array('400000','IT','0','/it'),
            array('500000','Design','0','/design'),
            array('600000','여행·맛집','0','/travel')
        );

        return $menu1;
        */
    }

    /**
     * @return array
     * @comment 중메뉴
     */
    public function Lnb()
    {
        
    }

    /**
     * @return array
     * @comment 소메뉴
     */
    public function Snb()
    {

    }
}