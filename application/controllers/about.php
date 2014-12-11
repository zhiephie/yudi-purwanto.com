<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	* @author  : Yudi Purwanto
	* @link    : http://yudi-purwanto.com
	* @since   : 14 may 2014
	*/

class About extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		session_start();
	}

	function index()
	{	
		$page=$this->uri->segment(3);
		$limit = 10;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		
		$data['title'] = "About o_0 Yudi Purwanto";
		$data['authors'] = $this->frontend_model->generate_about($limit,$offset);
		$data['popular'] = $this->frontend_model->generate_popular($limit);

		$tot_hal = $this->db->get("about");
		$config['base_url'] = base_url() . 'about/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);
		$data["paginator"] =$this->pagination->create_links();

		$this->load->view('frontend/_header', $data);
		$this->load->view('frontend/_about',$data);
		$this->load->view('frontend/_popular', $data);
		$this->load->view('frontend/_footer');
	}
}

/* End of file about.php */
/* Location: ./application/controller/about.php */