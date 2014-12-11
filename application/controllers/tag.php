<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	* @author  : Yudi Purwanto
	* @link    : http://yudi-purwanto.com
	* @since   : 14 may 2014
	*/

	// --------------------------------------------------------------------
	// Tags : show tags
	// --------------------------------------------------------------------
class Tag extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		session_start();
	}

	function show()
	{
		$tag = $this->uri->segment(3);

		$limit = 10;
		$data1 = $this->frontend_model->tag($tag);
		foreach($data1->result() as $dp)
		{
			$judul = 'Tag ' .$tag;
		}
		$data['title']   = $judul." o_0 Yudi Purwanto";
		$data['tags'] = $this->frontend_model->generate_tags($tag);
		$data['popular'] = $this->frontend_model->generate_popular($limit);
		
		$this->load->view('frontend/_header',$data);
		$this->load->view('frontend/_tags', $data);
		$this->load->view('frontend/_popular',$data);
		$this->load->view('frontend/_footer');
	}
}

/* End of file tag.php */
/* Location: ./application/controller/tag.php */