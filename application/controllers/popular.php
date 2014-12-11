<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Popular extends CI_Controller
{

	/**
	* @author  : Yudi Purwanto
	* @link    : http://yudi-purwanto.com
	* @since   : 14 may 2014
	*/

	function __construct()
	{
		parent::__construct();
		session_start();
	}

	public function index()
	{
		$page=$this->uri->segment(3);
		$list=20;
      	$limit=10;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;

		$data['title'] = "List Popular o_0 Yudi-Purwanto";
		$data['pop']   = $this->frontend_model->generate_list_popular($list,$offset);
		$data['popular']   = $this->frontend_model->generate_popular($limit);

		$tot_hal = $this->db->get("tutorial");
		$config['base_url'] = base_url() . 'popular/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $list;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);
		$data["paginator"] = $this->pagination->create_links();

		$this->load->view('frontend/_header',$data);
		$this->load->view('frontend/_listpopular',$data);
		$this->load->view('frontend/_popular',$data);
		$this->load->view('frontend/_footer');

	}
}

/* End of file popular.php */
/* Location: ./application/controllers/popular.php */