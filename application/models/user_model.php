<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user_model extends CI_Model
{
	/**
	* @author  : Yudi Purwanto
	* @link    : http://yudi-purwanto.com
	* @since   : 14 may 2014
	*/

	function __construct()
	{
		parent::__construct();
	}

	// --------------------------------------------------------------------
	// User Model : Encrypt sha1+Md5
	// --------------------------------------------------------------------
    function __encrypt($password)
    {
        return sha1(md5($password));
    }

    // --------------------------------------------------------------------
	// User Model : Serialize the session data stored in the database, 
    // store it in a new array and return it to the controller 
	// --------------------------------------------------------------------
	function get_db_session_data()
	{
		$query = $this->db->select('user_data')->get('ci_sessions');
		$user = array(); /* array to store the user data we fetch */
		foreach ($query->result() as $row)
		{
		    $udata = unserialize($row->user_data);
		    /* put data in array using username as key */
		    $user['username'] = $udata['username']; 
		    $user['logged_in'] = $udata['logged_in']; 
		}
		return $user;
	}
	
	// --------------------------------------------------------------------
	// User Model : check username and password in login
	// --------------------------------------------------------------------
	function login($username,$password)
	{
		$cek['username'] = trim(stripslashes(strip_tags(htmlspecialchars($username,ENT_QUOTES))));
		$cek['password'] = trim(stripslashes(strip_tags(htmlspecialchars($password,ENT_QUOTES))));
		$cek['active'] 	 = 1;
		$query = $this->db->get_where('login', $cek);
		return $query;
	}

	// --------------------------------------------------------------------
	// User Model : Update profile member
	// --------------------------------------------------------------------
	function update_profil_member($upd)
	{
		$query=$this->db->query($upd);
		return $query;
	}

	// --------------------------------------------------------------------
	// User Model : Create account member and send to email
	// --------------------------------------------------------------------
	function create_member()
	{

		$this->db->where('username', $this->input->post('username'));
		$query = $this->db->get('login');

        if($query->num_rows > 0){
        	echo '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>';
			  echo "Username already taken";
			echo '</strong></div>';
		}
		$this->db->where('email', $this->input->post('email'));
		$query = $this->db->get('login');

		if($query->num_rows > 0){
        	echo '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>';
			  echo "Email already taken";
			echo '</strong></div>';
		}else{
			$acak = $this->encrypt->set_cipher(1,999999999);
			$new_member_insert_data = array(
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'name' => $this->input->post('name'),
				'password' => $this->__encrypt($this->input->post('password')),
				'status' => 'user',
				'active' => 0,
				'kodeactivation' => $this->__encrypt($acak.$this->input->post('username'))
			);

			$insert = $this->db->insert('login', $new_member_insert_data);

			$auto   = $this->db->query("SELECT max(idabout) AS maxID FROM about");
			foreach($auto->result() as $row)
			{
			$idMax  = $row->maxID;
			$noUrut = $idMax;
			$noUrut++;
			$idauto = $noUrut;
			}

			$data_about = array(
					'idabout'  => $idauto,
					'login_id' => $idauto,
                	'text'     => 'Your Description',
                	'images'   => 'http://yudi-purwanto.com/assets/images/no-image.jpg',
                	'twitter'  => 'https://twitter.com/',
                	'plus'     => 'https://plus.google.com/',
                	'github'   => 'https://github.com/'
            );

            $this->db->insert('about', $data_about);

			$this->email->from("admin@yudi-purwanto.com", "yudi-purwanto.com");
			$this->email->to($new_member_insert_data['email']);
			$this->email->set_mailtype('html');
			$this->email->subject('Confirm Your account o_0 yudi-purwanto.com');
			$this->email->message('Thanks You '.$new_member_insert_data['name'].', We need to verify that this is your email address. Please click the link below to confirm your account. 
			<br>http://yudi-purwanto.com/user/activasi/'.$new_member_insert_data['kodeactivation'].'');
			$ml = $this->email->send();
			$ml = true;
			if($ml==TRUE)
			{	
				echo '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong>';
			  	  echo "Please check your email for Confirm account";
				echo '</strong></div>';
			}
		    return $insert;
		}
	      
	}

	// --------------------------------------------------------------------
	// User Model : Generate reset password and send to email
	// --------------------------------------------------------------------
	function generate_reset()
	{
		$this->db->where('email', $this->input->post('email'));
		$query = $this->db->get('login');

        if(count($query->result())<1){
        	echo '<p data-control="flash-message" class="error" data-interval="5">';
			  echo "Email not found.";
			echo '</p>';
		}
		else{
			$acak  = $this->encrypt->set_cipher(1,999999999);
			$where = $this->input->post('email');
			$reset = $this->__encrypt($acak.$where);
            $update = "update login set kodeactivation='".$reset."' where email='".$where."'";
			$this->user_model->update_profil_member($update);
			$this->email->from("admin@yudi-purwanto.com", "yudi-purwanto.com");
			$this->email->to($where);
			$this->email->set_mailtype('html');
			$this->email->subject('Reset password o_0 yudi-purwanto.com');
			$this->email->message('Successfully, Your reset code is '.$reset.'. Please click the link below to reset your password. 
			<br>http://yudi-purwanto.com/user/set_pass/'.$reset.'');
			$ml = $this->email->send();
			$ml = true;
			if($ml==TRUE)
			{
				echo '<p data-control="flash-message" class="success" data-interval="5">';
			  		echo "Please check your email.";
				echo '</p>';
			}
			return $update;
		}
	}

	// --------------------------------------------------------------------
	// User Model : Generate update kodeactivation
	// --------------------------------------------------------------------
	function generate_update()
	{
		$this->db->where('kodeactivation', $this->input->post('kodeactivation'));
		$query = $this->db->get('login');

        if(count($query->result())<1){
        	$data['title'] = "Whoops....!!!! Something went wrong.";
        	$this->load->view('frontend/_user/_wrong_reset',$data);
		}
		else
		{
			$bersih = $this->__encrypt($this->input->post('password'));
			$id = "";
			$cek = $this->user_model->aktivasi_member($this->input->post('kode'));
			foreach($cek->result() as $ka)
			{
				$id = $ka->idlogin;
			}
			if(count($cek->result())>0)
			{
				$update = "update login set password='".$bersih."', kodeactivation='' where idlogin='".$id."'";
				$this->user_model->update_profil_member($update);
				echo '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>';
			  	  echo "Congrats!  Your password has now been updated.";
				echo '</strong></div>';
			return $update;
			}
		}
	}
	
	// --------------------------------------------------------------------
	// User Model : activasi member
	// --------------------------------------------------------------------
	function aktivasi_member($kode)
	{
		$query=$this->db->query("SELECT * FROM login WHERE kodeactivation='$kode'");
		return $query;
	}
	
	// --------------------------------------------------------------------
	// User Model : Update activasi set active = 1
	// --------------------------------------------------------------------
	function update_aktivasi($kode)
	{
		$query=$this->db->query("UPDATE login SET active='1', kodeactivation='' WHERE username='$kode'");
		return $query;
	}

	// --------------------------------------------------------------------
	// User Model : kontrib tutorial from user
	// --------------------------------------------------------------------
	function kontrib($limit,$offset)
	{
		$idlogin = $this->session->userdata('idlogin');
		$query = $this->db->query("SELECT a.idtutorial, a.id_category, a.title, a.slug, a.text, a.image, a.date, a.publish, a.author, a.counter, b.name, (select c.name from login c where c.idlogin=a.author) as idlogin
		FROM tutorial a LEFT OUTER JOIN categorytutorial b ON b.idcategorytutorial = a.id_category WHERE a.author='$idlogin' ORDER BY counter DESC LIMIT $offset,$limit");
		return $query;
	}

    // --------------------------------------------------------------------
	// User Model : Update tutorial $data array - assosiative array
	// --------------------------------------------------------------------
    function update_tutorial($idtutorial, $data)
    {
    	$login = $this->session->userdata('idlogin');

		$this->db->where('idtutorial', $idtutorial);
		$this->db->where('author', $login);
		$this->db->update('tutorial', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

    // --------------------------------------------------------------------
	// User Model : Get tutorial by his is int $tutorial_id
	// --------------------------------------------------------------------
    function get_tutorial_by_id($idtutorial)
    {
    	$login = $this->session->userdata('idlogin');
		$this->db->select('*');
		$this->db->from('tutorial');
		$this->db->where('idtutorial', $idtutorial);
		$this->db->where('author', $login);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		return $query->result_array();
		}else{
			redirect('dashboard');
		}
    }

    // --------------------------------------------------------------------
	// User Model : Generate Image tutorial
	// --------------------------------------------------------------------
	function generate_gambar($id_param)
	{
		$hasil = "";
		
		$where['idtutorial'] = $id_param;
		
		$w = $this->db->get_where("tutorial",$where);
		$i = 0;
		foreach($w->result() as $h)
		{	
			if($i==0)
			{
				$hasil .= '</div>';
				$hasil .= '<div class="cleaner_h20"></div>';
				$hasil .= '<div class="row-fluid product_listing">';
			}
			$hasil .= '
						<div class="col-lg-2">
						<img class="img-thumbnail" src="'.base_url().'assets/uploads/thumb/'.$h->image.'">
						
					   </div>';
			$i++;
			if($i>3)
			{
				$i=0;
			}
		}
		return $hasil;
	}

	function account($idabout)
    {
    	$login = $this->session->userdata('idlogin');
		$this->db->select('*');
		$this->db->from('about');
		$this->db->join('login', 'idlogin = login_id');
		$this->db->where('idabout', $idabout);
		$this->db->where('login_id', $login);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		return $query->result_array();
		}
		else{
			redirect('dashboard');
		}
    }
}

	// --------------------------------------------------------------------
	// User Model : End User Model
	// --------------------------------------------------------------------

/* End of file user_model.php */
/* Location: ./application/model/user_model.php */