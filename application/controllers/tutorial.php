<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tutorial extends CI_Controller 
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

		$data['title']   = "List Tutorial o_0 Yudi Purwanto";
		$data['tutorial'] = $this->frontend_model->generate_list_tutorial($list,$offset);

		$tot_hal = $this->db->get("tutorial");
		$config['base_url'] = base_url() . 'tutorial/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $list;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);
		$data["paginator"] = $this->pagination->create_links();

		$data['popular']   = $this->frontend_model->generate_popular($limit);
		$this->load->view('frontend/_header',$data);
		$this->load->view('frontend/_tutorial/_home',$data);
		$this->load->view('frontend/_popular',$data);
		$this->load->view('frontend/_footer');
	}
}

/* End of file tutorial.php */
/* Location: ./application/controller/tutorial.php */