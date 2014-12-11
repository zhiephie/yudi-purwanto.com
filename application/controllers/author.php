<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Author extends CI_Controller
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

	// --------------------------------------------------------------------
	// Author : show author by id
	// --------------------------------------------------------------------
	public function id($param='')
	{
		$author = $this->uri->segment(3);

		$page=$this->uri->segment(4);
      	$limit=10;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;

		$data1 = $this->frontend_model->generate_author($author);
		foreach($data1 as $dp)
		{
			$judul = 'Contributions by ' .$dp->name;
		}

		$data['title']   = $judul." o_0 Yudi Purwanto";
		$data['nick'] = $this->frontend_model->generate_tutorial_by_author($author,$limit,$offset);
		$data['popular'] = $this->frontend_model->generate_popular($limit);

		$where['author'] = $param;
		$tot_hal = $this->db->get_where("tutorial",$where);
		$config['base_url'] = base_url() . 'author/id/'.$param.'/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);
		$data["paginator"] =$this->pagination->create_links();

		$this->load->view('frontend/_header',$data);
		$this->load->view('frontend/_by_author',$data);
		$this->load->view('frontend/_popular',$data);
		$this->load->view('frontend/_footer');
	}
}

/* End of file author.php */
/* Location: ./application/controller/author.php */