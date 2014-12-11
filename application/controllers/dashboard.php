<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	* @author  : Yudi Purwanto
	* @link    : http://yudi-purwanto.com
	* @since   : 14 may 2014
	*/

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		session_start();
	}

	// --------------------------------------------------------------------
	// Dashboard : List Contrib tutorial from users
	// --------------------------------------------------------------------
	public function index()
	{
		if ($this->session->userdata('logged_in')!="")
		{

		$page=$this->uri->segment(3);
      	$limit=10;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;

		$data['title'] = "Dashboard";
		$data['query'] = $this->user_model->kontrib($limit,$offset);
		
		$tot_hal = $this->db->get("tutorial");
		$config['base_url'] = base_url() . 'user/dashboard';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);
		$data["paginator"] =$this->pagination->create_links();
		$data['popular']   = $this->frontend_model->generate_popular($limit);
		
		$this->load->view('frontend/_header',$data);
		$this->load->view('frontend/_user/_dashboard_menu');
		$this->load->view('frontend/_user/_dashboard',$data);
		$this->load->view('frontend/_popular');
		$this->load->view('frontend/_footer');	
		}
		else{
			redirect(base_url());
		}
	}

	// --------------------------------------------------------------------
	// Dashboard : Add Contrib tutorial from users
	// --------------------------------------------------------------------
	public function add()
	{
		if ($this->session->userdata('logged_in')!="")
    	{
    		//form validation
            $this->form_validation->set_rules('category_id', 'category', 'required');
            $this->form_validation->set_rules('title', 'title', 'required');
            $this->form_validation->set_rules('text', 'text', 'required');
            $this->form_validation->set_rules('userfile', 'image');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
              $config['upload_path']    = './assets/uploads/';
			  $config['allowed_types']  = 'gif|jpg|png|jpeg';
			  $config['encrypt_name']	= TRUE;
			  $config['remove_spaces']	= TRUE;
			  $config['max_size']       = '5000';
			  $config['max_width']  	= '5000';
			  $config['max_height']  	= '5000';

			  $this->load->library('upload', $config);
			  if(!$this->upload->do_upload())
			  {
			  	 echo '<div class="alert alert-error">';
           		 echo '<a class="close" data-dismiss="alert">×</a>';
            	 echo $this->upload->display_errors();
          		 echo '</div>';
			  }else{
				 $data = $this->upload->data();

				/* PATH */
				$source = "./assets/uploads/".$data['file_name'];
				$destination_thumb	= "./assets/uploads/thumb/";

				// Permission Configuration
				chmod($source, 0777);

				/* Resizing Processing */
				// Configuration Of Image Manipulation :: Static
				$img['image_library'] = 'GD2';
				$img['create_thumb']  = TRUE;
				$img['maintain_ratio']= TRUE;
				$img['width']	 = 1200;
				$img['height']	= 500;
	 
				/// Limit Width Resize
				$limit_thumb    = 1200;
	 
				// Size Image Limit was using (LIMIT TOP)
				$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
	 
				// Percentase Resize
				if ($limit_use > $limit_thumb) {
					$percent_thumb  = $limit_thumb/$limit_use;
				}
	 
				//// Making THUMBNAIL ///////
				$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
				$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
	 
				// Configuration Of Image Manipulation :: Dynamic
				$img['thumb_marker'] = '';
				$img['quality']      = '80%';
				$img['source_image'] = $source;
				$img['new_image']    = $destination_thumb;
	 
				// Do Resizing
				$this->image_lib->initialize($img);
				$this->image_lib->resize();
				$this->image_lib->clear();

				$data_to_store = array(
                    'id_category' => $this->input->post('category_id'),
                    'title' => $this->input->post('title'),
                    'slug' => url_title($this->input->post('title'), 'dash', TRUE),
                    'text' => $this->input->post('text'),          
                    'image' => $data['file_name'],
                    'tag'  => strtolower($this->input->post('tags')),
                    'date' => time()+3600*7,
                    'publish' => 'no',
                    'author' => $this->session->userdata('idlogin'),
                    'counter' => 0
                );

                $data_tags = array(
                	'name' => $this->input->post('tags')
                	);
                $this->db->insert('tag', $data_tags);
                //if the insert has returned true then we show the flash message
                if($this->backend_model->store_tutorial($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }
			  }
            }
            $data['title'] = "add kontrib tutorial o_0 Dashboard";
            //fetch category data to populate the select field
       		 $data['category'] = $this->backend_model->get_category();
       		 $limit=10;
       		 $data['popular'] = $this->frontend_model->generate_popular($limit);

       		 $this->load->view('frontend/_header',$data);
		  	 $this->load->view('frontend/_user/_addtutorial',$data);
             $this->load->view('frontend/_popular',$data);
			 $this->load->view('frontend/_footer');
    	}
    	else{
    		redirect(base_url());
    	}
	}

	// --------------------------------------------------------------------
	// Dashboard : Edit and update Contrib tutorial from users
	// --------------------------------------------------------------------
	public function update($id_param='')
    {
    	if ($this->session->userdata('logged_in')!="")
    	{
    		//tutorial id 
        	$idtutorial = $this->uri->segment(3);
        	//form validation
            $this->form_validation->set_rules('category_id', 'category_id', 'required');
            $this->form_validation->set_rules('title', 'title', 'required');
            $this->form_validation->set_rules('text', 'text', 'required');
            $this->form_validation->set_rules('userfile', 'image');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {

              if(empty($_FILES['userfile']['name']))
              {
              	$data_to_store = array(
                    'id_category' => $this->input->post('category_id'),
                    'title' => $this->input->post('title'),
                    'slug' => url_title($this->input->post('title'), 'dash', TRUE),
                    'text' => $this->input->post('text')
                );
                //if the insert has returned true then we show the flash message
                if($this->user_model->update_tutorial($idtutorial, $data_to_store) == TRUE){
                   $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('dashboard/update/'.$idtutorial.'');
              }
              else{
              $config['upload_path']    = './assets/uploads/';
			  $config['allowed_types']  = 'gif|jpg|png|jpeg';
			  $config['encrypt_name']	= TRUE;
			  $config['remove_spaces']	= TRUE;
			  $config['max_size']       = '5000';
			  $config['max_width']  	= '5000';
			  $config['max_height']  	= '5000';

			  $this->load->library('upload', $config);
			  if(!$this->upload->do_upload())
			  {
			  	 echo '<div class="alert alert-error">';
           		 echo '<a class="close" data-dismiss="alert">×</a>';
            	 echo $this->upload->display_errors();
          		 echo '</div>';
			  }else{
				 $data = $this->upload->data();
				/* PATH */
				$source = "./assets/uploads/".$data['file_name'];
				$destination_thumb	= "./assets/uploads/thumb/";

				// Permission Configuration
				chmod($source, 0777);

				/* Resizing Processing */
				// Configuration Of Image Manipulation :: Static
				$img['image_library'] = 'GD2';
				$img['create_thumb']  = TRUE;
				$img['maintain_ratio']= TRUE;
				$img['width']	 = 1200;
				$img['height']	= 500;
	 
				/// Limit Width Resize
				$limit_thumb    = 1200;
	 
				// Size Image Limit was using (LIMIT TOP)
				$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
	 
				// Percentase Resize
				if ($limit_use > $limit_thumb) {
					$percent_thumb  = $limit_thumb/$limit_use;
				}
	 
				//// Making THUMBNAIL ///////
				$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
				$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
	 
				// Configuration Of Image Manipulation :: Dynamic
				$img['thumb_marker'] = '';
				$img['quality']      = '80%';
				$img['source_image'] = $source;
				$img['new_image']    = $destination_thumb;
	 
				// Do Resizing
				$this->image_lib->initialize($img);
				$this->image_lib->resize();
				$this->image_lib->clear();

				$data_to_store = array(
                    'id_category' => $this->input->post('category_id'),
                    'title' => $this->input->post('title'),
                    'slug' => url_title($this->input->post('title'), 'dash', TRUE),
                    'text' => $this->input->post('text'),
                    'image' => $data['file_name']
                );
                //if the insert has returned true then we show the flash message
                if($this->user_model->update_tutorial($idtutorial, $data_to_store) == TRUE){
                   $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('dashboard/update/'.$idtutorial.'');
			    } 
              }
            }
           //if we are updating, and the data did not pass trough the validation
           //the code below wel reload the current data
           //tutorial data
           $data['gambar'] = $this->user_model->generate_gambar($id_param);
           $data['tutorial'] = $this->user_model->get_tutorial_by_id($idtutorial);
           $data['title'] = "update tutorial o_0 Dashboard";
           //fetch category data to populate the select field
           $data['category'] = $this->backend_model->get_category();
           $limit=10;
           $data['popular'] = $this->frontend_model->generate_popular($limit);

       	   $this->load->view('frontend/_header',$data);
           $this->load->view('frontend/_user/_edittutorial',$data);
           $this->load->view('frontend/_popular',$data);
		   $this->load->view('frontend/_footer');
        }
    	else{
    		redirect(base_url());
    	}
    }

    // ---------------------------------------------------------------------------
	// Dashboard : Delete Contrib tutorial from users where idtutorial and idlogin
	// ---------------------------------------------------------------------------
    public function destroy($id='')
	{
	  if ($this->session->userdata('logged_in')!="")
	{
		$idlogin = $this->session->userdata('idlogin');
		$del = $this->db->query("select * from tutorial where idtutorial='$id' and author='$idlogin'");
		foreach ($del->result() as $value)
		{
			unlink('assets/uploads/'.$value->image.'');
			unlink('assets/uploads/thumb/'.$value->image.'');
		}
		$this->db->delete('tutorial', array('idtutorial' => $id, 'author' => $idlogin));
		redirect('dashboard');
	}
	else{
		redirect(base_url());
	  }
	}

	// ---------------------------------------------------------------------------
	// Dashboard : add or update about and name in login
	// ---------------------------------------------------------------------------
	public function account()
	{
		if ($this->session->userdata('logged_in')!="")
		{
		//about id
		$limit=10;
		$login = $this->session->userdata('idlogin');
        $idabout = $this->uri->segment(3);
        	//form validation
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('text', 'text', 'required');
            $this->form_validation->set_rules('image', 'image', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
            	$data_name = array(
            		'name' => $this->input->post('name')
            	);
            	$this->db->where('idlogin', $login)->update('login', $data_name);

				$data_to_store = array(
                    'text' => $this->input->post('text'),
                    'images' => $this->input->post('image'),
                    'twitter' => $this->input->post('twitter'),
                    'plus' => $this->input->post('plus'),
                    'github' => $this->input->post('github')
                );
                //if the insert has returned true then we show the flash message
                if($this->db->where('idabout', $idabout)->where('login_id', $login)->update('about', $data_to_store) == TRUE){
                   $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('dashboard/account/'.$idabout.'');
           }

           	$data['title'] = "Account o_0 Yudi Purwanto";
			$data['field'] = $this->user_model->account($idabout);
       		$data['popular'] = $this->frontend_model->generate_popular($limit);

			$this->load->view('frontend/_header',$data);
		  	$this->load->view('frontend/_user/_account',$data);
            $this->load->view('frontend/_popular',$data);
			$this->load->view('frontend/_footer');
		}
		else{
			redirect(base_url());
		}
	}
	
}

	// --------------------------------------------------------------------
	// Dashboard : End Contrib tutorial from users
	// --------------------------------------------------------------------

/* End of file dashboard.php */
/* Location: ./application/controller/dashboard.php */