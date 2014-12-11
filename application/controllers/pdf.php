<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	* @author  : Yudi Purwanto
	* @link    : http://yudi-purwanto.com
	* @since   : 14 may 2014
	*/

class Pdf extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->helper(array('dompdf', 'file'));
	}

	function generate()
	{
		$slug = $this->uri->segment(3);
		$idtutorial='';
		//$limit = 10;
		$data1 = $this->frontend_model->generate_detail_tutorial($slug);
		foreach ($data1->result() as $d)
		{
			$judul = $d->title;
		}
		$data['title'] = $judul. " yudi purwanto";
		$data['detail'] = $this->frontend_model->generate_detail_tutorial($slug);

     	// page info here, db calls, etc.

     	$html = $this->load->view('pdf_message', $data, true);

     	pdf_create($html, url_title($data['title']), 'dash', TRUE);
     	
     }
}

/* End of file pdf.php */
/* Location: ./application/controller/pdf.php */