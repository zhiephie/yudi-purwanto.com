<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Controller
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
      	$limit=10;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;

		$data['title']   = "Work o_0 Yudi Purwanto";
		$data['project'] = $this->frontend_model->generate_project($limit,$offset);

		$tot_hal = $this->db->get("project");
		$config['base_url'] = base_url() . 'project/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);
		$data["paginator"] = $this->pagination->create_links();
		$data['popular']   = $this->frontend_model->generate_popular($limit);

		$this->load->view('frontend/_header',$data);
		$this->load->view('frontend/_project/_home',$data);
		$this->load->view('frontend/_popular',$data);
		$this->load->view('frontend/_footer');
	}

	public function show()
	{
		$slug = '';
		$idtutorial = '';
		if ($this->uri->segment(3) === FALSE)
		{
    		$slug='';
		}
		else
		{
    		$slug = $this->uri->segment(3);
		}
		$limit=10;
		$data1 = $this->frontend_model->generate_detail_project($slug);
		if($data1->num_rows()>0)
		{
		foreach ($data1->result() as $d)
		{
			$judul = $d->title;
		}
		$data['title'] = $judul." o_0 Yudi Purwanto";
		$data['show'] = $this->frontend_model->generate_detail_project($slug);
		$data['random'] = $this->frontend_model->generate_random($idtutorial);
		$data['popular'] = $this->frontend_model->generate_popular($limit);
		$data['freebie'] = $this->frontend_model->popular_ebook();
		
		$this->load->view('frontend/_header',$data);
		$this->load->view('frontend/_project/_detail',$data);
		$this->load->view('frontend/_popular',$data);
		$this->load->view('frontend/_footer');
	  }
	  else{
	  	echo "Sorry Not Found Baby o_0";
	  }
	}
}

/* End of file project.php */
/* Location: ./application/controllers/project.php */