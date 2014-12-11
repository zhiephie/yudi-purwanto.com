<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
    * @author  : Yudi Purwanto
    * @link    : http://yudi-purwanto.com
    * @since   : 14 may 2014
    */

class Contact extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		session_start();
	}

	public function index()
	{
		$this->load->view('frontend/_contact');
	}

	public function send()
	{
		if(isset($this->input->post["page"]) && !empty($this->input->post["page"]))
		{
		//form validation
        $this->form_validation->set_rules('names', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('subject', 'text', 'required');
        $this->form_validation->set_rules('messages', 'Message', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
        //if the form has passed through the validation
        if ($this->form_validation->run())
        {
        	$data_to_store = array(
                    'name' => $this->input->post('names'),
                    'email' => $this->input->post('email'),
                    'subject' => $this->input->post('subject'),          
                    'message' => $$this->input->post('messages'),
                    'date' => time()+3600*7
                );
                //if the insert has returned true then we show the flash message
                if($this->db->insert('contact', $data_to_store)){
                    echo "<div class='info'>Sorry, you have to fill in all the fields to proceed. Thanks.</div>";
                }else{
                    echo "<div class='info'>Sorry, the operation was unsuccessful.<br>Please try again or contact this website admin to report this error message if the problem persist. Thanks.</div>";
               }
           }
	   }
   }
}

/* End of file contact.php */
/* Location: ./application/controller/contact.php */