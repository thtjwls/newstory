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

    public function getCategorys( $pid = null )
    {		
		if ( $pid != null ) {
		
			$sql = "
				SELECT * FROM nb_category
				WHERE idx = {$pid}
			";

			return $this->db->query( $sql );
		}

        return $this->db->query("SELECT * FROM nb_category ORDER BY idx ASC");
    }

	public function getPageName( $pagecode ) 
	{
		$sql = "
			SELECT * FROM nb_category
			WHERE idx = {$pagecode}
		";

		return $this->db->query( $sql );
	}

    public function getHomeLists( $search = array() )
    {
        $query = "
        SELECT
            nb_list.*,
            nb_members.id,nb_members.nick,nb_members.name,
            nb_category.name,nb_category.path
            FROM nb_list
            LEFT JOIN nb_members
            ON nb_list.writer = nb_members.idx  
            LEFT JOIN nb_category
            ON nb_list.FK_category = nb_category.idx			
			WHERE
        ";

		if ( count( $search ) > 0 ) {

			for ( $i = 0; $i < count($search); $i++ ) {

				if ( $i == count( $search ) - 1 ) {
					$query .= " nb_list.subject LIKE '%{$search[$i]}%' or
								nb_list.contents LIKE '%{$search[$i]}%' and 
							";

					continue;
				}

				$query .= " nb_list.subject LIKE '%{$search[$i]}%' or
							nb_list.contents LIKE '%{$search[$i]}%' or
				";
			}

		}		

		$query .= "
			nb_list.in_use = 1
			ORDER BY nb_list.idx DESC;
		";
        return $this->db->query($query);
    }

	public function getLists( $cate )
	{
		$query = "
		SELECT
		a.*,
		b.name, b.name,
		c.name,c.nick
		FROM
		nb_list a
		LEFT JOIN nb_category b
			ON a.FK_category = b.idx
		LEFT JOIN nb_members c
			ON a.writer = c.idx
		WHERE a.FK_category = '{$cate}' and
		a.in_use = 1
		ORDER BY a.idx DESC
		";

		return $this->db->query( $query );
	}

	public function getCate( $idx )
	{
		$query = "
		SELECT
		name
		FROM nb_list
		LEFT JOIN nb_category
			ON nb_list.FK_category = nb_category.idx
		WHERE nb_list.idx = {$idx}
		";

		return $this->db->query( $query );
	}

	public function getViews( $idx, $cate = '' )
	{
		$query = "
		SELECT 
		a.idx,a.subject,a.contents,a.writer,a.views,a.regist,a.in_use,a.in_secret,a.FK_category,
		b.name,b.nick,
		c.name
		FROM nb_list a
		LEFT JOIN nb_category c
			ON a.FK_category = c.idx
		LEFT JOIN nb_members b
			ON a.writer = b.idx	
		WHERE a.idx = {$idx}
		";

		return $this->db->query( $query );
	}

    /**
     * @param $idx
     * @param $post
     * @return mixed
     * @comment 점검중 2017-06-01
     */
	public function update( $idx, $post ) {

        //$ck_tx = htmlspecialchars($post['ck_tx']);

        $post['ck_tx'] = addslashes( $post['ck_tx']);

		$query = "
		UPDATE nb_list SET
		subject = \"{$post['subject']}\",
		FK_category = \"{$post['nb_category']}\",
		contents = \"{$post['ck_tx']}\"		
		WHERE idx = {$idx}
		";

		return $this->db->query( $query );
	}

	public function getComment( $idx, $paging = '' )
	{
		$query = "
		SELECT 
		a.idx,a.pid,a.contents,a.regist,
		b.name,b.nick
		FROM nb_comment a
		LEFT JOIN nb_members b
			ON a.writer = b.idx
		WHERE a.pid = {$idx}
		ORDER BY a.idx DESC
		";

		if ( is_array( $paging ) == true ) {
			$query .= " LIMIT {$paging['coStart_record']}, {$paging['coScale']}";
		}

		return $this->db->query( $query );
	}

	public function getRe( $co_idx )
	{
		$query = "
		SELECT 
		a.contents,a.regist,a.writer,
		b.name,b.nick
		FROM nb_comment_re a
		LEFT JOIN nb_members b
			ON a.writer = b.idx
		WHERE a.pid = '{$co_idx}'
		ORDER BY a.idx DESC
		";

		return $this->db->query( $query );
	}

	public function setList( $data )
	{
		$data['regist'] = date('Y-m-d H:i:s');

		$data['ck_tx'] = addslashes($data['ck_tx']);

		$query = "
		INSERT INTO nb_list (FK_category,subject,contents,writer,regist)
		VALUES
		({$data['nb_category']},'{$data['subject']}','{$data['ck_tx']}',{$data['idx']},'{$data['regist']}')
		";

		//return $data;

		return $this->db->query( $query );
	}

	public function putView( $idx )
	{
		$query = "
		UPDATE nb_list SET views = views+1 WHERE idx = {$idx}
		";

		return $this->db->query( $query );
	}

	public function viewDel( $idx ) {
		$query = "
		UPDATE nb_list SET in_use = 0 WHERE idx = {$idx}
		";

		return $this->db->query($query);
	}

	/**
	 *@param idx : idx, fk_member : $this->session->sess_idx
	 */
	public function putLikeList( $arr )
	{
		$query = "
			SELECT pid, FK_member
			FROM nb_likes
			WHERE pid = {$arr['idx']}
			and FK_member = {$arr['fk_member']}
		";

		return $this->db->query( $query );
	}

	public function putLike( $arr )
	{
		$regist_day = date('Y-m-d H:i:s');
		$query = "
		INSERT INTO nb_likes (pid,FK_member,likes_regist)
		VALUES ({$arr['idx']},{$arr['fk_member']},'{$regist_day}')
		";

		return $this->db->query( $query );
	}

	public function getLike( $idx )
	{
		$query = "
		SELECT idx
		FROM nb_likes
		WHERE pid = {$idx}
		";

		return $this->db->query( $query );
	}

	public function upload_file_insert ( $arr ) {
		$query = "
		INSERT INTO nb_files
		(pid,file_name,file_type,file_regist)
		VALUES
		('','','','')
		";
	}

	public function setComment( $coIdx, $data )
	{
		$regist_day = date('Y-m-d H:i:s');
		$query = "
		INSERT INTO nb_comment
		(pid, contents, regist, writer)
		VALUES
		({$coIdx},'{$data['contents']}','{$regist_day}','{$data['writer']}')
		";

		return $this->db->query( $query );
	}

	public function setRe( $data )
	{
		$regist_day = date('Y-m-d H:i:s');
		$writer = $this->session->sess_idx;
		$query = "
		INSERT INTO nb_comment_re 
		( pid,contents,regist,writer )
		VALUES
		( '{$data['idx']}','{$data['re_contents']}','{$regist_day}','{$writer}')
		";


		return $this->db->query( $query );
	}

	public function getNew( $idx )
	{
		$query = "
		SELECT idx FROM nb_list
		WHERE FK_category = '{$idx}' AND
		in_use = 1
		";

		return $this->db->query( $query );
	}

}