<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Show extends CI_Controller
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

	public function detail()
	{
		$slug = '';
		$idtutorial='';

		if ($this->uri->segment(3) === FALSE)
		{
    		$slug='';
		}
		else
		{
    		$slug = $this->uri->segment(3);
		}
		$limit=10;
		
		$data1 = $this->frontend_model->generate_detail_tutorial($slug);
		foreach ($data1->result() as $d)
		{
			$judul = $d->title;
		}

		$data['title']   = $judul." o_0 Yudi Purwanto";
		$data['detail']  = $this->frontend_model->generate_detail_tutorial($slug);
		$data['random']  = $this->frontend_model->generate_random($idtutorial);
		$data['popular'] = $this->frontend_model->generate_popular($limit);
		$data['freebie'] = $this->frontend_model->popular_ebook();
		$this->frontend_model->generate_counter($slug);

		$this->load->view('frontend/_header',$data);
		$this->load->view('frontend/_detail',$data);
		$this->load->view('frontend/_popular',$data);
		$this->load->view('frontend/_footer');
	}
}

/* End of file show.php */
/* Location: ./application/controller/show.php */