<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ebooks extends CI_Controller
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
		$idebook='';		
		if ($this->uri->segment(3) === FALSE)
		{
    		$idebook='';
		}
		else
		{
    		$idebook = $this->uri->segment(3);
		}

		$page=$this->uri->segment(3);
		$limit=10;
		if(!$page):
		$offset=0;
		else:
		$offset = $page;
		endif;

		$data['title'] = "Free Ebook o_0 Yudi Purwanto";
		$data['ebook'] = $this->frontend_model->generate_ebook($limit,$offset);

		$this->frontend_model->update_counter_ebook($idebook);
		$tot_hal = $this->db->get('ebook');
		$config['base_url'] = base_url() . 'ebook/index/';
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
		$this->load->view('frontend/_ebooks',$data);
		$this->load->view('frontend/_popular',$data);
		$this->load->view('frontend/_footer');
	}

	public function get($id='')
	{
		if ($this->session->userdata('logged_in')!="")
		{
			//get id
			//$d = $this->input->post($id);
			if(empty($id))
			 {   //redirect where param not found
				redirect(base_url());
			 }
			else
			{
			 //found, where id and get file
			 $get = $this->frontend_model->get_ebook($id);
			 $this->frontend_model->update_counter_ebook($id);
			 $file="";
			 foreach ($get as $value)
			 {
				$file = $value->file;
			 }
			    if(empty($file))
			    {
			     redirect(base_url());
			    }
			    else{
			   redirect(base_url('assets/ebooks/'.$file.''));
			  }
		    }
		}
		else{
			redirect('auth/signin');
		}
	}
}

/* End of file ebooks.php */
/* Location: ./application/controller/ebooks.php */