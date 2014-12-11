<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Demo extends CI_Controller
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
		$this->load->model('demo_model');
	}

	function index()
	{
		$query = $this->demo_model->gets();
		$data = json_encode (array($query));
		$this->load->view('demo', $data);
	}
}

/* End of file demo.php */
/* Location: ./application/controller/demo.php */