<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

    public $cate;

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Category_m');
        $cate = $this->Category_m->getData();
        $this->cate = $cate->result_array();
    }

    public function _remap( $method , $id )
    {
        switch ( $method ) {
            case 'index' : $pagecode = '100000'; break;
            case 'write' : $pagecode = 'A00000'; break;
            case 'getUpdate' : $pagecode = 'A00000'; break;
			case 'test' : $pagecode = 'Z00000'; break;
            default : $pagecode = $this->Category_m->getCategoryInfo( $id[0] )[0]['idx']; break;
        }

        $menu = array(
            'menu' => $this->cate,
            'pagecode' => $pagecode
        );

		$this->meta['title'] = '뉴스토리';
		$this->meta['description'] = '여행 맛집 문화 강의 IT 분야별 커뮤니티 블로그';

		if( $method == 'views' ) {
			$metaR = $this->Main_m->getViews( $this->uri->segment(4) );
			$this->meta['title'] = $metaR->result_array()[0]['subject'];
			$mtContents = $metaR->result_array()[0]['contents'];
			$ct = preg_replace('/\r\n|\r|\n/','',$mtContents);
			$ct = str_replace("&nbsp;"," ",$ct);
			$ct = strip_tags($ct);
			$this->meta['description'] = $ct;
		}

		$this->load->view('inc/_head');
        $this->load->view('inc/_menu', $menu );

        $this->load->view('inc/_page_head');
        if ( method_exists($this,$method) ) {


            $this->{$method}();

        } else {
            $this->index();
        }

        $this->load->view('inc/_foot');
    }

    public function test()
    {
		$this->load->helper('iscontents');
		$lt = $this->Main_m->getViews(70);

		$data = array(
			'lt' => $lt	
		);
		
        $this->load->view('test',$data);
    }

    public function index()
	{
        $pagecode = 100000;

		$search_str = array();

		if ( isset( $_GET['search'] ) ) {
			$str = explode(' ',$_GET['search']);

			for( $i = 0; $i < count( $str ); $i++ ){
				$search_str[$i] = $str[$i];
			}

		}

        /**
         * db 에서 리스트 추출
         */
        $result = $this->Main_m->getHomeLists( $search_str );

        /* row 갯수 추출 */
        $count = $result->num_rows();
        $lt = $result->result_array();
		$strpos = '/upload/user/';

	    $data = array(
	        'menu' => $this->menu,
            'pagecode' => $pagecode,
            'count' => $count,
            'lt'    => $lt,
			'strpos'=> $strpos,
			'meta'	=> $this->meta
        );


        $this->load->view('main_v',$data);
	}


	public function lists()
    {
        $pagecode = cate($this->uri->segment(3));

		$lt = $this->Main_m->getLists( $pagecode );

		$pagename = $this->Main_m->getPageName( $pagecode )->result_array()[0]['name'];


		$data = array(
	        'menu' => $this->menu,
            'pagecode' => $pagecode,
			'pageName'	=> $pagename,
			'lt'	=> $lt
        );

		if ( $lt->num_rows() == 0 ) {
		    $this->load->view('temp/empty');
        } else {
            $this->load->view('list_v',$data);
        }

    }

    /**
     * @param $idx
     * @return bool
     * @Ajax 컨트롤러로 이동
     */
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
				echo $this->getLike( $idx );
			} else {
				echo '치명적인 오류가 발견되었어요...';
			}
		} else {
			echo '이미 좋아하셨어요!!';
		}
	}

	public function getLike( $idx )
	{
		$result = $this->Main_m->getLike( $idx );

		return $result->num_rows();
	}

    public function views()
    {
		
		$pagecode = cate($this->uri->segment(3));		

		//카테고리, idx 셋팅
		$cate = $this->uri->segment(3);
		$idx = $this->uri->segment(4);

		/**
		 * 조회수 카운트
		 */		
			 			


		 if ( ! get_cookie( 'viewID'.$idx ) ) {
			$this->Main_m->putView( $idx );
			$expire = 3600;
			$setView = array(
				 'name'		=> 'viewID'.$idx,
				 'value'	=>	true,
				 'expire'	=> $expire,
				 'domain'	=> '.newvid.co.kr',
				 'path'		=> '/'
			);

			set_cookie($setView);
		 }
		 				

		/* 뷰 카테고리 */
		$ca = $this->Main_m->getCate( $idx );
		/* 뷰 내용 */
		$vw = $this->Main_m->getViews( $idx );	
		/* 댓글 */
		$co = $this->Main_m->getComment( $idx );		

		/**
		 * 댓글 페이징 처리
		 */
		$paging['coPage'] = isset( $_GET['coPage'] ) == true
			? $_GET['coPage']
			: 1;

		$paging['coScale'] = isset( $_GET['coScale'] ) == true
			? $_GET['coScale']
			: 10;

		$paging['coPageNum'] = isset( $_GET['coPageNum'] ) == true
			? $_GET['coPageNum']
			: 5;

		$paging['coTotal_record'] = $co->num_rows();
		$paging['coTotal_page_block'] = ceil($paging['coTotal_record'] / $paging['coScale'] );
		$paging['coStart_record'] = ( $paging['coPage'] * $paging['coScale']) - $paging['coScale'];
		$paging['coNow_block'] = ceil( $paging['coPage'] / $paging['coPageNum'] );
		$paging['coStart_page'] = ( ( $paging['coNow_block'] - 1 ) * $paging['coPageNum'] ) + 1;
		$paging['coEnd_page'] = $paging['coStart_page'] + $paging['coPageNum'];
		if ( $paging['coEnd_page'] > $paging['coTotal_page_block'] ) $paging['coEnd_page'] = $paging['coTotal_page_block'];

		$co_limit = $this->Main_m->getComment( $idx, $paging );

		$this->meta['title'] = strip_tags($vw->result_array()[0]['subject']);

		$this->meta['description'] = htmloutput($vw->result_array()[0]['contents']);


        $data = array(
            'pagecode' => $pagecode,
            'menu'  => $this->menu,
			'vw'	=> $vw->result_array()[0],
			'co'	=> $co,
			'co_limit'	=> $co_limit,
			'ca'	=> $ca->result_array()[0]['name'],
			'co_paging'	=> $paging,
			'meta'		=> $this->meta
        );

        $this->load->view('views_v',$data);
    }



	public function write()
    {
		if ( $this->session->is_login != TRUE ) redirect('/');

		$pagecode = 'A00000';

		$data = array(
			'menu'		=> $this->menu,
			'pagecode'	=> $pagecode,
			'meta'		=> $this->meta
		);

        $this->load->view('write_v',$data);

    }

	public function getUpdate() {
		
		if ( $this->session->is_login != TRUE ) alert('로그인 후 이용 해 주세요.','/');

		$idx = $this->uri->segment(3);
		
		$vw = $this->Main_m->getViews( $idx );

		$pagecode = 'B00000';


		$data = array(
			'menu'		=> $this->menu,
			'pagecode'	=> $pagecode,
			'vw'		=> $vw->result_array()[0]
		);
		
		//$this->load->view('inc/_head');
        //$this->load->view('inc/_menu');
        //$this->load->view('inc/_page_head',);
        $this->load->view('modify_v',$data);
        //$this->load->view('inc/_foot');
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

	public function insert()
	{
		$data = $this->input->post(NULL,FALSE);

		$data['idx'] = $this->session->sess_idx;

		$result = $this->Main_m->setList( $data );

		if ( $result == true ) {

			$data = array(
				'msg'	=> '등록 되었어요!',
				'url'	=> '/'
			);


			$this->load->view('inc/_head',$this->meta);
			$this->load->view('temp/success', $data);
			$this->load->view('inc/_foot');
		}
	}


}