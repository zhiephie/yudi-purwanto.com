<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
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
	// User : encrypt type sha1+md5
	// --------------------------------------------------------------------
    function __encrypt($password)
    {
        return sha1(md5($password));
    }
	
	// --------------------------------------------------------------------
	// User : signup
	// --------------------------------------------------------------------
	function index()
	{
		if($this->session->userdata('logged_in')!="")
		{
			redirect(base_url());
		}
		else
		{
			$data['title'] = "Create Account o_0 Yudi Purwanto";
			$this->load->view('frontend/_user/_signup',$data);
		}
	}

    // --------------------------------------------------------------------
	// User : Create new user and store it in the database
	// --------------------------------------------------------------------
	function create_member()
	{
		if($this->session->userdata('logged_in')!="")
		{
			redirect(base_url());
		}
		else
		{
			// field name, error message, validation rules
		    $this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

		if($this->form_validation->run() == FALSE)
		{
			$data['title'] = "Create Account o_0 Yudi Purwanto";
			$this->load->view('frontend/_user/_signup',$data);
		}
		else
		{			
			if($query = $this->user_model->create_member())
			{
				$data['title'] = "Congrats!  Your account has now been created.";
			    $this->load->view('frontend/_user/_signup',$data);
			}
			else
			{
				$data['title'] = "Create Account o_0 Yudi Purwanto";
			    $this->load->view('frontend/_user/_signup',$data);	
			}
		  }
	    }
	}

	// --------------------------------------------------------------------
	// User : Reset password
	// --------------------------------------------------------------------
	function reset()
	{
		if($this->session->userdata('logged_in')!="")
		{
			redirect(base_url());
		}
		else
		{	//field email, error message, validasion rules
			$this->form_validation->set_rules('email', '<p data-control="flash-message" class="error" data-interval="5">Email Address', 'trim|required|valid_email');
			$this->form_validation->set_error_delimiters('<p data-control="flash-message" class="error" data-interval="5">', '</p>');
			if($this->form_validation->run() == FALSE)
			{
				$data['title'] = "Reset password o_0 Yudi Purwanto";
			    $this->load->view('frontend/_user/_restore',$data);
			}
			else
			{
				if($query = $this->user_model->generate_reset())
			{
				$data['title'] = "Congrats!  Your reset has now been saved.";
			    $this->load->view('frontend/_user/_restore',$data);
			}
			else
			{
				$data['title'] = "Reset password o_0 Yudi Purwanto";
			    $this->load->view('frontend/_user/_restore',$data);
			}
		  }
		}
	}

	// --------------------------------------------------------------------
	// User : Restore
	// --------------------------------------------------------------------
	function restore()
	{
		if($this->session->userdata('logged_in')!="")
		{
			redirect(base_url());
		}
		else
		{
		$data['title'] = "Lost Password o_0 Yudi Purwanto";
		$this->load->view('frontend/_user/_restore',$data);
	    }
	}
		
	// --------------------------------------------------------------------
	// User : Activasi user
	// --------------------------------------------------------------------
	function activasi()
	{
		$kode='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$kode='gagal';
		}
		else
		{
    			$kode = $this->uri->segment(3);
		}
		if($this->session->userdata('logged_in')!="")
		{
			redirect(base_url());
		}
		else{
			$nama="";
			$id="";
			$cari = $this->user_model->aktivasi_member($kode);
			if (count($cari->result())>0){
				foreach($cari->result() as $c){
					$nama = $c->name;
					$id   = $c->username;
				}
				$data['title'] = "Congrats! o_0 Yudi Purwanto";
				$data['message'] =  "Congrats, ".$nama.". Your account has been active.<br>Thanks You.";
				$this->user_model->update_aktivasi($id);
			}
			else{
				$data['title'] = "Error Mbloo! o_0 Yudi Purwanto";
				$data['message'] =  "Whoops....!!!! Code confirm not found.";
			}
		  $this->load->view('frontend/_user/_activasi',$data);
		}
	}

	// --------------------------------------------------------------------
	// User : Set password reset
	// --------------------------------------------------------------------
	function set_pass()
	{
		//get kode uri segment 3//
		$kode='';
		if ($this->uri->segment(3) === FALSE)
		{
    			$kode='gagal';
		}
		else
		{
    			$kode = $this->uri->segment(3);
		}
		//session
		if($this->session->userdata('logged_in')!="")
		{
		   redirect(base_url());
		}
		else{
			//found kode
			$data['kode'] = $kode;
			$data['title'] = "Reset password o_0 Yudi Purwanto";
			$cari = $this->user_model->aktivasi_member($kode);
			if (count($cari->result())>0){
				$this->load->view('frontend/_user/_input_reset',$data);
			}
			//not found kode
			else{
				$data['pesan'] =  "Whoops....!!!! Something went wrong, please check email again.";
				$this->load->view('frontend/_user/_wrong_reset',$data);
			}
		}
	}

	// --------------------------------------------------------------------
	// User : Update reset password
	// --------------------------------------------------------------------
	function update_reset()
	{
		//get kode uri segment 3//
		$kode='';
		if ($this->uri->segment(3) === FALSE)
		{
    		$kode='gagal';
		}
		else{
    		$kode = $this->uri->segment(3);
		}
		//session
		if($this->session->userdata('logged_in')!="")
		{
			redirect(base_url());
		}
		else{
			//validation error//
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
			$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
		if($this->form_validation->run() == FALSE)
		{
			$data['kode'] = $kode;
			$data['title'] = "Reset Password o_0 Yudi Purwanto";
			$this->load->view('frontend/_user/_input_reset',$data);
		}
		else{
			if($query = $this->user_model->generate_update())
			{
				$data['title'] = "Congrats!  Your password has now been updated.";
			    $this->load->view('frontend/_user/_success_reset',$data);
			}
			else{
				$data['kode'] = $kode;
				$data['title'] = "Reset password o_0 Yudi Purwanto";
			    $this->load->view('frontend/_user/_input_reset',$data);	
			}
		 }
	   }
	}
	
	// --------------------------------------------------------------------
	// User : password update
	// --------------------------------------------------------------------
	function password()
	{
		if($this->session->userdata('logged_in')!="")
		{
		$this->load->view('frontend/_user/_password');
		}
		else {
			redirect(base_url());
		}
	}
	
	// --------------------------------------------------------------------
	// User : Get update password
	// --------------------------------------------------------------------
	function updatepassword()
	{
		if($this->session->userdata('logged_in')!="")
		{
		$username = $this->session->userdata('username');
		$psw = $this->__encrypt($this->input->post('pwd'));
		$psw_lama = $this->__encrypt($this->input->post('pwd_lama'));
		$hasil = $this->db->query("select * from login where username='$username' and password='$psw_lama'");
		if(count($hasil->result()) <= 0)
		{
			?>
			<script>
				alert('password incorrect..!!!');
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."user/password'>";
		}
		else if($psw!="" AND $psw_lama!=""){
			//$this->db->get('login',$username,$psw);
			$this->db->query("update login set password='$psw' where username='$username'");
			echo "<font size='2' face='arial'>Congrats!<br> Your password has now been updated.</font><b/>";
		}
		else{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."user/password'>";
		}
	  }else{
	 	redirect(base_url());
	  }
	}
}
	// --------------------------------------------------------------------
	// User : End User Controller
	// --------------------------------------------------------------------

/* End of file user.php */
/* Location: ./application/controller/user.php */