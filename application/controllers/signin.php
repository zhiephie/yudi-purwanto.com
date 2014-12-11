<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signin extends CI_Controller
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

	function __encrypt($password)
    {
        return sha1(md5($password));
    }

	public function index()
	{
		if ($this->session->userdata('logged_in')!="")
		{
			redirect(base_url());
		}
		else
		{
			$data['title'] = "SignIn o_0 Yudi Purwanto";
			$this->load->view('frontend/_user/_login',$data);
		}
	}

	public function set()
	{
		$username  = stripcslashes(strip_tags(htmlspecialchars($this->input->post('username',ENT_QUOTES))));
		$password  = stripcslashes(strip_tags(htmlspecialchars($this->__encrypt($this->input->post('password',ENT_QUOTES)))));
		$cek_login = $this->user_model->login($username,$password);
		if (!ctype_alnum($username) OR !ctype_alnum($password))
		{
				?>
				<script type="text/javascript">
				alert("Protected mbloo...!!!");
				</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."auth/signin'>";
		}
		else if($cek_login->num_rows()>0)
		{
			foreach($cek_login->result() as $ok)
			{
				$sess_data['logged_in'] = 'SuccessLoginMbloo';
				$sess_data['idlogin']   = $ok->idlogin;
				$sess_data['username']  = $ok->username;
				$sess_data['nama']      = $ok->name;
				$sess_data['email']     = $ok->email;
				$sess_data['status']    = $ok->status;

				$this->db->query("update login set hit=hit+1 where idlogin='$ok->idlogin'");
				$this->session->set_userdata($sess_data);
			}
			redirect(base_url());
		}
		else
		{
			$data['title'] = "SignIn o_0 Yudi Purwanto";
			$data['message_error'] = TRUE;
			$this->load->view('frontend/_user/_login',$data);
		}
	}

	public function logout()
	{
	$this->session->sess_destroy();
	redirect(base_url());
	}
}

/* End of file signin.php */
/* Location: ./application/controller/signin.php */