<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movie extends MY_Controller {

	public $movie_info;

	private $apikey = '4ce988c229fa5c1d8a105cea521a22eb';
	private $outputType = 'json';
	

	public $movie_subject = '감시자';

	public function __construct()
	{
        parent::__construct();

		$this->meta['title'] = '뉴스토리-영화';
		$this->meta['description'] = '영화, 최신영화, 보고싶은영화, 또보고싶은영화 등 다양한 영화 정보를 볼 수 있습니다.';

		$url = "https://apis.daum.net/contents/movie?apikey={$this->apikey}&q=".urlencode($this->movie_subject)."&output={$this->outputType}"; 

		$ch=curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Your application name');
		
		$getMovie = curl_exec($ch);

		$this->movie_info = json_decode($getMovie);
		
		curl_close($ch);
	}

    public function index()
	{
		$apikey = '4ce988c229fa5c1d8a105cea521a22eb';
		$url = 'https://apis.daum.net/contents/movie';
		$format = 'json';
		$search = '미생';
		

		$pagecode = 800000;

		$data = array(
			'meta'	=> $this->meta,
			'pagecode'	=> $pagecode,
			'menu'		=> $this->menu,
			'mv'		=> $this->movie_info
		);


		$this->load->view('inc/_head',$data);
        $this->load->view('inc/_menu');
        $this->load->view('inc/_page_head');
        $this->load->view('movie/lists_v');
        $this->load->view('inc/_foot');
	}
}