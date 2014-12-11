<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	* @author  : Yudi Purwanto
	* @link    : http://yudi-purwanto.com
	* @since   : 14 may 2014
	*/
	
class Error extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('zonk/error_404');
	}
}

/* End of file error.php */
/* Location: ./application/controller/error.php */