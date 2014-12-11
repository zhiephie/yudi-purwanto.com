<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	* @author  : Yudi Purwanto
	* @link    : http://yudi-purwanto.com
	* @since   : 14 may 2014
	*/

class Backend extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		session_start();
	}

	// --------------------------------------------------------------------
	// Backend : Jebakan Betmen
	// --------------------------------------------------------------------
	public function index()
	{
		if ($this->session->userdata('logged_in')!="")
		{
			redirect(base_url());
		}
		else{
			$this->load->view('zonk/error_404');
		}
	}

	// --------------------------------------------------------------------
	// Backend : Home
	// --------------------------------------------------------------------
	public function home()
	{
		if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
		{
			$data=array();
			foreach($this->db->get('tutorial')->result_array() as $row)
			$data[] = (int) generate_tanggal($row['date']);

			$this->load->view('backend/_header');
			$this->load->view('backend/_menu');
			$this->load->view('backend/_main', array('data'=>$data));
			$this->load->view('backend/_footer');
		}else{
			redirect(base_url());
		}
	}

	// --------------------------------------------------------------------
	// Backend : Show tutorial limit 10
	// --------------------------------------------------------------------
	public function tutorial()
	{
		if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
	    {
	      $page=$this->uri->segment(3);
      	  $limit=10;
		  if(!$page):
		  $offset = 0;
		  else:
		  $offset = $page;
		  endif;

		  $data['query'] = $this->backend_model->generate_tutorial($limit,$offset);
		  $tot_hal = $this->db->get("tutorial");
		  $config['base_url'] = base_url() . 'backend/tutorial';
		  $config['total_rows'] = $tot_hal->num_rows();
		  $config['per_page'] = $limit;
		  $config['uri_segment'] = 3;
		  $config['first_link'] = 'First';
		  $config['last_link'] = 'Last';
		  $config['next_link'] = 'Next';
		  $config['prev_link'] = 'Prev';
		  $this->pagination->initialize($config);
		  $data["paginator"] =$this->pagination->create_links();

		  $this->load->view('backend/_header');
		  $this->load->view('backend/_menu');
		  $this->load->view('backend/_content',$data);
		  $this->load->view('backend/_footer');
	    }else{
		   redirect(base_url());
	   }
    }

    // --------------------------------------------------------------------
	// Backend : Add tutorial
	// --------------------------------------------------------------------
    public function add()
    {
    	if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
    	{
    		//form validation
            $this->form_validation->set_rules('category_id', 'category_id', 'required');
            $this->form_validation->set_rules('title', 'title', 'required');
            $this->form_validation->set_rules('text', 'text', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
              $config['upload_path']    = './assets/uploads/';
			  $config['allowed_types']  = 'gif|jpg|png|jpeg';
			  $config['encrypt_name']	= TRUE;
			  $config['remove_spaces']	= TRUE;	
			  $config['max_size']       = '2000';
			  $config['max_width']  	= '2000';
			  $config['max_height']  	= '2000';

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
				$destination_thumb = "./assets/uploads/thumb/";
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
            
            //fetch category data to populate the select field
       		 $data['category'] = $this->backend_model->get_category();
       		 $this->load->view('backend/_header');
		  	 $this->load->view('backend/_menu');
             $this->load->view('backend/_add_tutorial',$data);
             $this->load->view('backend/_footer');
    	}
    	else{
    		redirect(base_url());
    	}
    }

    // --------------------------------------------------------------------
	// Backend : Update or edit tutorial
	// --------------------------------------------------------------------
    public function update($id_param='')
    {
    	if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
    	{
    	//tutorial id 
        $idtutorial = $this->uri->segment(3);
        	//form validation
            $this->form_validation->set_rules('category_id', 'category_id', 'required');
            $this->form_validation->set_rules('title', 'title', 'required');
            $this->form_validation->set_rules('text', 'text', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
              //image not update
              if(empty($_FILES['userfile']['name']))
              {
              	/* stored to database */
              	$data_to_store = array(
                    'id_category' => $this->input->post('category_id'),
                    'title' => $this->input->post('title'),
                    'slug' => url_title($this->input->post('title'), 'dash', TRUE),
                    'text' => $this->input->post('text')
                );
                //if the insert has returned true then we show the flash message
                if($this->backend_model->update_tutorial($idtutorial, $data_to_store) == TRUE){
                   $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('backend/update/'.$idtutorial.'');
              }
              else{
              $config['upload_path']    = './assets/uploads/';
			  $config['allowed_types']  = 'gif|jpg|png|jpeg';
			  $config['encrypt_name']	= TRUE;
			  $config['remove_spaces']	= TRUE;	
			  $config['max_size']       = '2000';
			  $config['max_width']  	= '2000';
			  $config['max_height']  	= '2000';

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

				/* stored to database */
				$data_to_store = array(
                    'id_category' => $this->input->post('category_id'),
                    'title' => $this->input->post('title'),
                    'slug' => url_title($this->input->post('title'), 'dash', TRUE),
                    'text' => $this->input->post('text'),
                    'image' => $data['file_name']
                );
                //if the insert has returned true then we show the flash message
                if($this->backend_model->update_tutorial($idtutorial, $data_to_store) == TRUE){
                   $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('backend/update/'.$idtutorial.'');
			   }
			 }
            }
            
           //if we are updating, and the data did not pass trough the validation
           //the code below wel reload the current data
           //tutorial data 
           $data['gambar'] = $this->backend_model->generate_gambar($id_param);
           $data['tutorial'] = $this->backend_model->get_tutorial_by_id($idtutorial);
           //fetch category data to populate the select field
           $data['category'] = $this->backend_model->get_category();
       	   $this->load->view('backend/_header');
		   $this->load->view('backend/_menu');
           $this->load->view('backend/_edit_tutorial',$data);
           $this->load->view('backend/_footer');
        }
    	else{
    		redirect(base_url());
    	}
    }

    // --------------------------------------------------------------------
	// Backend : Delete tutorial where id="$id"
	// --------------------------------------------------------------------
    public function destroy($id='')
	{
	  if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
	{
		$del = $this->db->query("select * from tutorial where idtutorial='$id'");
		foreach ($del->result() as $value)
		{
			unlink('assets/uploads/'.$value->image.'');
			unlink('assets/uploads/thumb/'.$value->image.'');
		}
		$this->db->delete('tutorial', array('idtutorial' => $id));
		redirect('backend/tutorial');
	}
	else{
		redirect(base_url());
	  }
	}

	// --------------------------------------------------------------------
	// Backend : Set publish 'yes' or publish 'no'
	// --------------------------------------------------------------------
    public function set_pup($id_param,$set)
    {
    	if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
    	{
    		//set up
    		$id['idtutorial'] = $id_param;
			$up['publish'] = $set;
			$this->db->update("tutorial", $up, $id);
			redirect('backend/tutorial');
    	}
    	else{
    		redirect(base_url());
    	}
    }
	// --------------------------------------------------------------------
	// Backend : End tutorial
	// --------------------------------------------------------------------

	// --------------------------------------------------------------------
	// Backend : Category tutorial
	// --------------------------------------------------------------------
	public function category()
	{
		if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
		{
			//form validation
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
				$data_to_store = array(
                    'name' => $this->input->post('name'),
                    'slug_cat' => url_title($this->input->post('name'), 'dash', TRUE)
                );
                //if the insert has returned true then we show the flash message
                if($this->db->insert('categorytutorial', $data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }
            }
		  		$data['query'] = $this->db->get('categorytutorial');
			    $this->load->view('backend/_header');
			    $this->load->view('backend/_menu');
			    $this->load->view('backend/_categ_tutorial',$data);
			    $this->load->view('backend/_footer');
		}
		else{
			redirect(base_url());
		}
	}

	// --------------------------------------------------------------------
	// Backend : Edit category tutorial
	// --------------------------------------------------------------------
	public function editcateg()
    {
    	if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
    	{
    	//category id
        $idcategorytutorial = $this->uri->segment(3);
        	//form validation
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
				$data_to_store = array(
                    'name' => $this->input->post('name'),
                    'slug_cat' => url_title($this->input->post('name'), 'dash', TRUE)
                );
                //if the insert has returned true then we show the flash message
                if($this->db->where('idcategorytutorial', $idcategorytutorial)->update('categorytutorial', $data_to_store) == TRUE){
                   $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('backend/editcateg/'.$idcategorytutorial.'');
           }
           //if we are updating, and the data did not pass trough the validation
           //the code below wel reload the current data
           //ebook data 
           $data['categ'] = $this->backend_model->get_category_by_id($idcategorytutorial);
       	   $this->load->view('backend/_header');
		   $this->load->view('backend/_menu');
           $this->load->view('backend/_edit_categ_tutorial',$data);
           $this->load->view('backend/_footer');
        }
    	else{
    		redirect(base_url());
    	}
    }

    // --------------------------------------------------------------------
	// Backend : Delete category tutorial
	// --------------------------------------------------------------------
	public function destroy_cat($id='')
	{
	 if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
	{
		$this->db->delete('categorytutorial', array('idcategorytutorial' => $id));
		redirect('backend/category');
	}
	else{
		redirect(base_url());
	  }
	}
	// --------------------------------------------------------------------
	// Backend : End category
	// --------------------------------------------------------------------

	// --------------------------------------------------------------------
	// Backend : Upload and show ebooks
	// --------------------------------------------------------------------
	public function upload()
    {
    	if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
    	{
    		//form validation
            $this->form_validation->set_rules('title', 'title', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $config['upload_path'] = './assets/ebooks';
				$config['allowed_types'] = 'zip|xls|ppt|doc|docx|xlsx|pdf';
				$config['encrypt_name']	= TRUE;
				$config['remove_spaces']= TRUE;
				$config['max_size']     = '20000';

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
				$source = "./assets/ebooks/".$data['file_name'];
				// Permission Configuration
				chmod($source, 0777);

				$data_to_store = array(
                    'title' => $this->input->post('title'),
                    'file' => $data['file_name'],
                    'date' => time()+3600*7,
                    'counter' => 0
                );
                //if the insert has returned true then we show the flash message
                if($this->db->insert('ebook', $data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }
			  }
            }

            $page=$this->uri->segment(3);
      	  	$limit=10;
		  	if(!$page):
		  	$offset = 0;
		  	else:
		  	$offset = $page;
		  	endif;

		  	$data['query'] = $this->backend_model->generate_ebook($limit,$offset);
		  	$tot_hal = $this->db->get("ebook");

		    $config['base_url'] = base_url() . 'backend/upload';
		    $config['total_rows'] = $tot_hal->num_rows();
		    $config['per_page'] = $limit;
		    $config['uri_segment'] = 3;
		    $config['first_link'] = 'First';
		    $config['last_link'] = 'Last';
		    $config['next_link'] = 'Next';
		    $config['prev_link'] = 'Prev';
		    $this->pagination->initialize($config);
		    $data["paginator"] =$this->pagination->create_links();
            //load view
       		 $this->load->view('backend/_header');
		  	 $this->load->view('backend/_menu');
             $this->load->view('backend/_add_ebook',$data);
             $this->load->view('backend/_footer');
    	}
    	else{
    		redirect(base_url());
    	}
    }

    // --------------------------------------------------------------------
	// Backend : Edit upload ebook
	// --------------------------------------------------------------------
    public function edit()
    {
    	if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
    	{
    	//tutorial id
        $idebook = $this->uri->segment(3);
        	//form validation
            $this->form_validation->set_rules('title', 'title', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
              if(empty($_FILES['userfile']['name']))
              {
              	$data_to_store = array(
              		'title' => $this->input->post('title')
              	);
              	//if the insert has returned true then we show the flash message
                if($this->backend_model->edit_ebook($idebook, $data_to_store) == TRUE){
                   $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('backend/edit/'.$idebook.'');
              }
              else{
              $config['upload_path'] = './assets/ebooks';
			  $config['allowed_types'] = 'zip|xls|ppt|doc|docx|xlsx|pdf';
			  $config['encrypt_name']	= TRUE;
			  $config['remove_spaces']= TRUE;
			  $config['max_size']     = '20000';

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
				$source = "./assets/ebooks/".$data['file_name'];
				// Permission Configuration
				chmod($source, 0777);
				
				$data_to_store = array(
                    'title' => $this->input->post('title'),
                    'file' => $data['file_name']
                );
                //if the insert has returned true then we show the flash message
                if($this->backend_model->edit_ebook($idebook, $data_to_store) == TRUE){
                   $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('backend/edit/'.$idebook.'');
			   }
			  }
            }
           //if we are updating, and the data did not pass trough the validation
           //the code below wel reload the current data
           //ebook data 
           $data['ebook'] = $this->backend_model->get_ebook_by_id($idebook);
           //fetch category data to populate the select field
           $data['category'] = $this->backend_model->get_category();
       	   $this->load->view('backend/_header');
		   $this->load->view('backend/_menu');
           $this->load->view('backend/_edit_ebook',$data);
           $this->load->view('backend/_footer');
        }
    	else{
    		redirect(base_url());
    	}
    }

    // --------------------------------------------------------------------
	// Backend : Delete upload ebook where idebook='$id'
	// --------------------------------------------------------------------
    public function destroy_ebook($id='')
	{
	  if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
	{
		$del = $this->db->query("select * from ebook where idebook='$id'");
		foreach($del->result() as $val)
		{
			unlink('assets/ebooks/'.$val->file.'');
		}
		$this->db->delete('ebook', array('idebook' => $id));
		redirect('backend/upload');
	}
	else{
		redirect(base_url());
	  }
	}
	// --------------------------------------------------------------------
	// Backend : End Ebooks
	// --------------------------------------------------------------------

	// --------------------------------------------------------------------
	// Backend : Show list project
	// --------------------------------------------------------------------
	public function project()
	{
		if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
	    {
	      $page=$this->uri->segment(3);
      	  $limit=10;
		  if(!$page):
		  $offset = 0;
		  else:
		  $offset = $page;
		  endif;

		  $data['query'] = $this->backend_model->generate_project($limit,$offset);
		  
		  $tot_hal = $this->db->get("project");
		  $config['base_url'] = base_url() . 'backend/project';
		  $config['total_rows'] = $tot_hal->num_rows();
		  $config['per_page'] = $limit;
		  $config['uri_segment'] = 3;
		  $config['first_link'] = 'First';
		  $config['last_link'] = 'Last';
		  $config['next_link'] = 'Next';
		  $config['prev_link'] = 'Prev';
		  $this->pagination->initialize($config);
		  $data["paginator"] =$this->pagination->create_links();

		  $this->load->view('backend/_header');
		  $this->load->view('backend/_menu');
		  $this->load->view('backend/_project',$data);
		  $this->load->view('backend/_footer');
	    }else{
		   redirect(base_url());
	   }
    }

    // --------------------------------------------------------------------
	// Backend : Add project
	// --------------------------------------------------------------------
    public function addproject()
    {
    	if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
    	{
    		//form validation
            $this->form_validation->set_rules('category', 'category', 'required');
            $this->form_validation->set_rules('title', 'title', 'required');
            $this->form_validation->set_rules('text', 'text', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
              $config['upload_path']    = './assets/uploads/';
			  $config['allowed_types']  = 'gif|jpg|png|jpeg';
			  $config['encrypt_name']	= TRUE;
			  $config['remove_spaces']	= TRUE;	
			  $config['max_size']       = '2000';
			  $config['max_width']  	= '2000';
			  $config['max_height']  	= '2000';

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
				$destination_thumb = "./assets/uploads/thumb-portfolio/";
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
                    'idcategory' => $this->input->post('category'),
                    'title' => $this->input->post('title'),
                    'slug' => url_title($this->input->post('title'), 'dash', TRUE),
                    'text' => $this->input->post('text'),          
                    'image' => $data['file_name'],
                    'date' => time()+3600*7,
                    'author' => 1
                );
                //if the insert has returned true then we show the flash message
                if($this->backend_model->store_project($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }
			  }
            }
            
            //fetch category data to populate the select field
       		 $data['category'] = $this->backend_model->get_category_p();
       		 $this->load->view('backend/_header');
		  	 $this->load->view('backend/_menu');
             $this->load->view('backend/_add_project',$data);
             $this->load->view('backend/_footer');
    	}
    	else{
    		redirect(base_url());
    	}
    }

    // --------------------------------------------------------------------
	// Backend : Edit Porject/portfolio
	// --------------------------------------------------------------------
    public function portfolio($id_param='')
    {
    	if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
    	{
    	//project id 
        $idproject = $this->uri->segment(3);
        	//form validation
            $this->form_validation->set_rules('category', 'category', 'required');
            $this->form_validation->set_rules('title', 'title', 'required');
            $this->form_validation->set_rules('text', 'text', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
              if(empty($_FILES['userfile']['name']))
              {
              	$data_to_store = array(
                    'idcategory' => $this->input->post('category'),
                    'title' => $this->input->post('title'),
                    'slug' => url_title($this->input->post('title'), 'dash', TRUE),
                    'text' => $this->input->post('text')
                );
                //if the insert has returned true then we show the flash message
                if($this->backend_model->update_project($idproject, $data_to_store) == TRUE){
                   $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('backend/portfolio/'.$idproject.'');
              }
              else{
              $config['upload_path']    = './assets/uploads/';
			  $config['allowed_types']  = 'gif|jpg|png|jpeg';
			  $config['encrypt_name']	= TRUE;
			  $config['remove_spaces']	= TRUE;	
			  $config['max_size']       = '2000';
			  $config['max_width']  	= '2000';
			  $config['max_height']  	= '2000';

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
				$destination_thumb = "./assets/uploads/thumb-portfolio/";
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
                    'idcategory' => $this->input->post('category'),
                    'title' => $this->input->post('title'),
                    'slug' => url_title($this->input->post('title'), 'dash', TRUE),
                    'text' => $this->input->post('text'),
                    'image' => $data['file_name']
                );
                //if the insert has returned true then we show the flash message
                if($this->backend_model->update_project($idproject, $data_to_store) == TRUE){
                   $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('backend/portfolio/'.$idproject.'');
			  }
			 }
            }
            
           //if we are updating, and the data did not pass trough the validation
           //the code below wel reload the current data
           //project data 
           $data['gambar'] = $this->backend_model->generate_image($id_param);
           $data['project'] = $this->backend_model->get_project_by_id($idproject);
           //fetch category data to populate the select field
           $data['category'] = $this->backend_model->get_category_p();
       	   $this->load->view('backend/_header');
		   $this->load->view('backend/_menu');
           $this->load->view('backend/_edit_project',$data);
           $this->load->view('backend/_footer');
        }
    	else{
    		redirect(base_url());
    	}
    }

    // --------------------------------------------------------------------
	// Backend : Delete project where id
	// --------------------------------------------------------------------
    public function destroy_project($id='')
    {
    	if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
    	{
    		$del = $this->db->query("select * from project where idproject='$id'");
    		foreach($del->result() as $ok)
    		{
    			unlink('assets/uploads/'.$ok->image.'');
    			unlink('assets/uploads/thumb-portfolio/'.$ok->image.'');
    		}
    		$this->db->delete('project', array('idproject' => $id));
			redirect('backend/project');
    	}
    	else{
    		redirect(base_url());
    	}
    }
    // --------------------------------------------------------------------
	// Backend : End project
	// --------------------------------------------------------------------

    // --------------------------------------------------------------------
	// Backend : Show list category project
	// --------------------------------------------------------------------
	public function category_pro()
	{
		if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
		{
			//form validation
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
				$data_to_store = array(
                    'name' => $this->input->post('name')
                );
                //if the insert has returned true then we show the flash message
                if($this->db->insert('category', $data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }
            }
		  		$data['query'] = $this->db->get('category');
			    $this->load->view('backend/_header');
			    $this->load->view('backend/_menu');
			    $this->load->view('backend/_categ_project',$data);
			    $this->load->view('backend/_footer');
		}
		else{
			redirect(base_url());
		}
	}

	// --------------------------------------------------------------------
	// Backend : Edit category project
	// --------------------------------------------------------------------
	public function editcateg_pro()
    {
    	if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
    	{
    	//category project id
        $idcategory = $this->uri->segment(3);
        	//form validation
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
				$data_to_store = array(
                    'name' => $this->input->post('name')
                );
                //if the insert has returned true then we show the flash message
                if($this->db->where('idcategory', $idcategory)->update('category', $data_to_store) == TRUE){
                   $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('backend/editcateg_pro/'.$idcategory.'');
           }
           //if we are updating, and the data did not pass trough the validation
           //the code below wel reload the current data
           //ebook data 
           $data['categ'] = $this->backend_model->get_category_project_id($idcategory);
       	   $this->load->view('backend/_header');
		   $this->load->view('backend/_menu');
           $this->load->view('backend/_edit_categ_project',$data);
           $this->load->view('backend/_footer');
        }
    	else{
    		redirect(base_url());
    	}
    }

    // --------------------------------------------------------------------
	// Backend : Delete category project
	// --------------------------------------------------------------------
	public function destroy_cat_p($id='')
	{
	  if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
	{
		$this->db->delete('category', array('idcategory' => $id));
		redirect('backend/category_pro');
	}
	else{
		redirect(base_url());
	  }
	}
	// --------------------------------------------------------------------
	// Backend : End category project
	// --------------------------------------------------------------------

	// --------------------------------------------------------------------
	// Backend : About or account admin
	// --------------------------------------------------------------------
	public function about()
	{
		if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
		{
			$data['d'] = $this->db->select('*')->from('about')->join('login', 'idlogin = login_id')->get();
			$this->load->view('backend/_header');
		    $this->load->view('backend/_menu');
			$this->load->view('backend/_list_account',$data);
			$this->load->view('backend/_footer');
		}
		else{
			redirect(base_url());
		}
	}

	// --------------------------------------------------------------------
	// Backend : Edit About or account admin
	// --------------------------------------------------------------------
	public function account()
    {
    	if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
    	{
    	//about id
        $idabout = $this->uri->segment(3);
        	//form validation
            $this->form_validation->set_rules('text', 'text', 'required');
            $this->form_validation->set_rules('image', 'url image', 'required');
            $this->form_validation->set_rules('twitter', 'url twitter', 'required');
            $this->form_validation->set_rules('plus', 'url google plus', 'required');
            $this->form_validation->set_rules('github', 'url github', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
				$data_to_store = array(
                    'text' => $this->input->post('text'),
                    'images' => $this->input->post('image'),
                    'twitter' => $this->input->post('twitter'),
                    'plus' => $this->input->post('plus'),
                    'github' => $this->input->post('github')
                );
                //if the insert has returned true then we show the flash message
                if($this->db->where('idabout', $idabout)->update('about', $data_to_store) == TRUE){
                   $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('backend/account/'.$idabout.'');
           }
           //if we are updating, and the data did not pass trough the validation
           //the code below wel reload the current data
           //data about or account admin
           $data['field'] = $this->backend_model->get_about_id($idabout);
       	   $this->load->view('backend/_header');
		   $this->load->view('backend/_menu');
           $this->load->view('backend/_account',$data);
           $this->load->view('backend/_footer');
        }
    	else{
    		redirect(base_url());
    	}
    }
    // --------------------------------------------------------------------
	// Backend : End about or account admin
	// --------------------------------------------------------------------

    // --------------------------------------------------------------------
	// Backend : List show users account
	// --------------------------------------------------------------------
    public function users()
    {
    	if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
    	{
    		$page=$this->uri->segment(3);
      	    $limit=10;
		    if(!$page):
		    $offset = 0;
		    else:
		    $offset = $page;
		    endif;
    		$data['user'] = $this->backend_model->users($limit,$offset);
    		$tot_hal = $this->db->get("login");
		    $config['base_url'] = base_url() . 'backend/users';
		    $config['total_rows'] = $tot_hal->num_rows();
		    $config['per_page'] = $limit;
		    $config['uri_segment'] = 3;
		    $config['first_link'] = 'First';
		    $config['last_link'] = 'Last';
		    $config['next_link'] = 'Next';
		    $config['prev_link'] = 'Prev';
		    $this->pagination->initialize($config);
		    $data["paginator"] =$this->pagination->create_links();
    		$this->load->view('backend/_header');
    		$this->load->view('backend/_menu');
    		$this->load->view('backend/_user',$data);
    		$this->load->view('backend/_footer');
    	}
    	else{
    		redirect(base_url());
    	}
    }

    // --------------------------------------------------------------------
	// Backend : Set active and non active users @param $idlogin
	// --------------------------------------------------------------------
    public function set($id_param,$set)
    {
    	if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
    	{
    		//set up aktifasi
    		$id['idlogin'] = $id_param;
			$up['active'] = $set;
			$this->db->update("login", $up, $id);
			redirect('backend/users');
    	}
    	else{
    		redirect(base_url());
    	}
    }

    // --------------------------------------------------------------------
	// Backend : Delete user where idlogin
	// --------------------------------------------------------------------
    public function deluser($id='')
    {
    	if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
    	{
    		//del and redirect
    		$this->db->delete('login', array('idlogin' => $id));
    		redirect('backend/users');
    	}
    	else{
    		redirect(base_url());
    	}
    }

    // --------------------------------------------------------------------
	//Library Google Analyst Api
	// --------------------------------------------------------------------

	function analyst()
	{
	  if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
	  {
		// première requête
		$this->ga_api->dimension('city')->metric('visits, pageviews');
		$this->ga_api->when('2 month ago')->limit(20);
		$data['cities'] = $this->ga_api->get_object();
		$data['referrers'] = $this->ga_api->dimension('source')->clear('limit, when')->get_object();

		$this->load->view('backend/_header');
    	$this->load->view('backend/_menu');
		$this->load->view('backend/_analytics', $data);
		$this->load->view('backend/_footer');
	  }
	  else{
		redirect(base_url());
	    }
	}
	
	// --------------------------------------------------------------------
	// pagination google analyst
	// --------------------------------------------------------------------
	function paginate($offset = 1)
	{	
	  if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
	  {
		$this->ga_api->dimension('city')
					 ->metric('visits, pageviews')
					 ->when('2 month ago')
					 ->limit(50)
					 ->offset($offset);
		
		$data['cities'] = $this->ga_api->get_object();
		$config['base_url'] 	= site_url('analytics/paginate/');
		$config['uri_segment'] 	= 3;
		$config['total_rows'] 	= $data['cities']['summary']->totalResults;
		$config['per_page'] 	= $data['cities']['summary']->itemsPerPage;
		$this->load->library('pagination', $config);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('backend/_header');
    	$this->load->view('backend/_menu');
		$this->load->view('backend/_analytics', $data);
		$this->load->view('backend/_footer');
	  }
	  else{
		redirect(base_url());
	  }			
    }
	
	// --------------------------------------------------------------------
	// Cache google analyst
	// --------------------------------------------------------------------
	function cache($offset = 1)
	{
	  if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
	  {
		//$config['cache_folder'] = ''; // dossier cache
		$config['cache_data']	= TRUE; // activation du cache
		$config['clear_cache']	= array('date', '2 minutes ago'); // durée de vie du cache
		$this->ga_api->initialize($config);
		$data['cities'] = $this->ga_api->offset($offset)->dimension('city')->metric('visits, pageviews')->get_object();

		$config['base_url'] 	= site_url('analytics/cache/');
		$config['uri_segment'] 	= 3;
		$config['total_rows'] 	= $data['cities']['summary']->totalResults;
		$config['per_page'] 	= $data['cities']['summary']->itemsPerPage;
		$this->load->library('pagination', $config);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('backend/_header');
    	$this->load->view('backend/_menu');
		$this->load->view('backend/_analytics', $data);
		$this->load->view('backend/_footer');
	  }
	  else{
	  	redirect(base_url());
	  }
	}
	
	// --------------------------------------------------------------------
	// List profile google analyst.
	// --------------------------------------------------------------------
	function accounts($profile = false)
	{	
	  if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
	  {	
		if ($profile) {
			$config['profile_id'] = 'ga:'.$profile;
			$this->ga_api->clear('login')->initialize($config);
			$data['cities'] = $this->ga_api->dimension('city')->metric('visits, pageviews')->get_object();
		}
		else {
			$data['accounts'] = $this->ga_api->login()->get_accounts();
			//print_r($data);			
		}
		$this->load->view('backend/_header');
    	$this->load->view('backend/_menu');
		$this->load->view('backend/_analytics', $data);
		$this->load->view('backend/_footer');
	  }
	  else{
	 	redirect(base_url());
	   }
	}

	// ---------------------------------------------------------------------------
	// Backend : add and list file
	// ---------------------------------------------------------------------------
	function file()
	{
		if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
		{	
			$this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('userfile', 'image');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			//if the form has passed through the validation
            if ($this->form_validation->run())
            {
              $config['upload_path']    = './assets/file/';
			  $config['allowed_types']  = 'zip|txt|pdf|png|jpg|jpeg';
			  $config['encrypt_name']	= TRUE;
			  $config['remove_spaces']	= TRUE;
			  $config['max_size']       = '50000';

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
				$source = "./assets/file/".$data['file_name'];

				// Permission Configuration
				chmod($source, 0777);
				
				$data_to_store = array(
                    'title'    => $this->input->post('title'),
                    'tutorial' => $this->input->post('tutorial'),
                    'demo'     => $this->input->post('demo'),      
                    'file'     => $data['file_name']
                );
                //if the insert has returned true then we show the flash message
                if($this->db->insert('file',$data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }
			  }
            }
       		$page=$this->uri->segment(3);
      	  	$limit=10;
		  	if(!$page):
		  	$offset = 0;
		  	else:
		  	$offset = $page;
		  	endif;
       		$data['query'] = $this->db->get('file',$limit,$offset);
		  	$tot_hal = $this->db->get("file");
		    $config['base_url'] = base_url() . 'backend/file';
		    $config['total_rows'] = $tot_hal->num_rows();
		    $config['per_page'] = $limit;
		    $config['uri_segment'] = 3;
		    $config['first_link'] = 'First';
		    $config['last_link'] = 'Last';
		    $config['next_link'] = 'Next';
		    $config['prev_link'] = 'Prev';
		    $this->pagination->initialize($config);
		    $data["paginator"] =$this->pagination->create_links();

       		 $this->load->view('backend/_header');
       		 $this->load->view('backend/_menu');
		  	 $this->load->view('backend/_unduh',$data);
			 $this->load->view('backend/_footer');
		}
		else
		{
			redirect(base_url());
		}
	}

	// ---------------------------------------------------------------------------
	// Backend : Delete file where id
	// ---------------------------------------------------------------------------
    public function destroy_file($id='')
	{
	  if ($this->session->userdata('logged_in')!="" AND $this->session->userdata('status')=="admin")
	  {
		$del = $this->db->query("select * from file where id='$id'");
		foreach ($del->result() as $value)
		{
			unlink('assets/file/'.$value->file.'');
		}
		$this->db->delete('file', array('id' => $id));
		redirect('backend/file');
	  }
	  else{
		redirect(base_url());
	  }
	}
}
	// --------------------------------------------------------------------
	// Backend : End Backend
	// --------------------------------------------------------------------

/* End of file backend.php */
/* Location: ./application/controller/backend.php */