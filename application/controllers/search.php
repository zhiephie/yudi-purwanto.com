<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	* @author  : Yudi Purwanto
	* @link    : http://yudi-purwanto.com
	* @since   : 14 may 2014
	*/

class Search extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		session_start();
	}

	// --------------------------------------------------------------------
	// Search : redirect to base_url
	// --------------------------------------------------------------------
	public function index()
	{
		redirect(base_url());
	}

	// --------------------------------------------------------------------
	// Search : function result searching
	// --------------------------------------------------------------------
	public function result()
	{
		$page=$this->uri->segment(3);
      	$limit=10;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;

		$data['kata']="";
			if(isset($_POST['keyword']))
			{
				$data['kata'] = $this->input->post('keyword');
				$this->session->set_userdata('simpan_kata', $data['kata']);
			} else {
				$data['kata'] = $this->session->userdata('simpan_kata');
			}

		$data['title']   ="Searching Result o_0 Yudi Purwanto";
		$data['hasil']   = $this->frontend_model->generate_search($limit,$offset,$data['kata']);

		$tot_hal = $this->db->query("select * from tutorial where title like '%".$data['kata']."%'");
		$config['base_url'] = base_url() . 'search/result/';
        $config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
       	$this->pagination->initialize($config);
		$data["paginator"] =$this->pagination->create_links();
		
		$data['popular'] = $this->frontend_model->generate_popular($limit);
		$this->load->view('frontend/_header',$data);
		$this->load->view('frontend/_result_search',$data);
		$this->load->view('frontend/_popular',$data);
		$this->load->view('frontend/_footer');
	}
}

	// --------------------------------------------------------------------
	// Search : End search controller
	// --------------------------------------------------------------------

/* End of file search.php */
/* Location: ./application/controller/search.php */