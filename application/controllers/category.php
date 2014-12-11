<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller 
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
	// Category : show category
	// --------------------------------------------------------------------
	public function show($param='')
	{
		$slug = $this->uri->segment(3);
		
		$page=$this->uri->segment(4);
      	$limit=10;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;

		$data1 = $this->frontend_model->generate_cat($slug);
		foreach($data1->result() as $dp)
		{
			$judul = 'Category ' .$dp->name;
		}

		$data['title']   = $judul." o_0 Yudi Purwanto";
		$data['category'] = $this->frontend_model->generate_category($slug,$limit,$offset);
		$data['popular'] = $this->frontend_model->generate_popular($limit);

		$where['slug_cat'] = $param;
		$tot_hal = $this->db->get_where("categorytutorial",$where);
		$config['base_url'] = base_url() . 'category/show/'.$param.'/';
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
		$this->load->view('frontend/_category',$data);
		$this->load->view('frontend/_popular',$data);
		$this->load->view('frontend/_footer');
	}
}
	// --------------------------------------------------------------------
	// category : End category Controller
	// --------------------------------------------------------------------

/* End of file category.hp */
/* Location: ./application/controller/category.php */