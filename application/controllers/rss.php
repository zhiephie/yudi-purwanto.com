<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rss extends CI_Controller{

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('xml','text'));
		$this->load->model('rss_model');
    }
	
	public function index() {

		$data = array(
			'encoding' 			=> 'utf-8',
			'feed_name' 		=> 'Blog Yudi Purwanto',
			'feed_url' 			=> 'http://www.yudi-purwanto.com/rss/',
			'page_description' 	=> 'yudi-purwanto.com, Hanya tulisan seeorang web development biasa yang ingin berbagi ala kadarnya.',
			'page_language' 	=> 'en-ca',
			'creator_email' 	=> 'purwantoyudi42@gmail.com',
			'posts' 			=> $this->rss_model->get_posts()
		);

		$this->load->view('rss',$data);
		header("Content-Type: application/rss+xml");
	}
}

