<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	* @author  : Yudi Purwanto
	* @link    : http://yudi-purwanto.com
	* @since   : 14 may 2014
	*/

class backend_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	// --------------------------------------------------------------------
	// Backend Model : Generate tutorial
	// --------------------------------------------------------------------
	function generate_tutorial($limit,$offset)
	{
		$query = $this->db->query("SELECT a.idtutorial, a.id_category, a.title, a.slug, a.text, a.image, a.date, a.publish, a.author, a.counter, b.name, (select c.name from login c where c.idlogin=a.author) as idlogin
		FROM tutorial a LEFT OUTER JOIN categorytutorial b ON b.idcategorytutorial = a.id_category WHERE a.idtutorial=idtutorial ORDER BY idtutorial DESC LIMIT $offset,$limit");
		return $query;
	}

	// --------------------------------------------------------------------
	// Backend Model : Insert tutorial
	// --------------------------------------------------------------------
	function store_tutorial($data)
    {
		$insert = $this->db->insert('tutorial', $data);
	    return $insert;
	}

    // --------------------------------------------------------------------
	// Backend Model : Get tutorial by his is @param int $tutorial_id
	// @return array
	// --------------------------------------------------------------------
    function get_tutorial_by_id($idtutorial)
    {
		$this->db->select('*');
		$this->db->from('tutorial');
		$this->db->where('idtutorial', $idtutorial);
		$query = $this->db->get();
		if($query->num_rows() > 0 )
		{
		return $query->result_array();
		}
		else{
			redirect('backend/home');
		}
    }

    // --------------------------------------------------------------------
	// Backend Model : Update tutorial array $data -  associative array
	// --------------------------------------------------------------------
    function update_tutorial($idtutorial, $data)
    {
		$this->db->where('idtutorial', $idtutorial);
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
	// Backend Model : Category tutorial
	// --------------------------------------------------------------------
	function get_category()
	{
		$this->db->select('*');
		$this->db->from('categorytutorial');
		$query = $this->db->get();
		
		return $query->result_array();
	}

    // --------------------------------------------------------------------
	// Backend Model : Category tutorial by his is int $category_id
	// @return array
	// --------------------------------------------------------------------
    function get_category_by_id($idcategorytutorial)
    {
		$this->db->select('*');
		$this->db->from('categorytutorial');
		$this->db->where('idcategorytutorial', $idcategorytutorial);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		return $query->result_array();
		}
		else{
			redirect('backend/home');
		} 
    }

    // --------------------------------------------------------------------
	// Backend Model : Generate Image tutorial
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
			$hasil .= '<div class="form-group col-lg-4">
						<div class="col-lg-8">
						<img class="img-thumbnail" src="'.base_url().'assets/uploads/thumb/'.$h->image.'">
						</div>
					   </div>';
			$i++;
			if($i>3)
			{
				$i=0;
			}
		}
		return $hasil;
	}
	// --------------------------------------------------------------------
	// Backend Model : End tutorial
	// --------------------------------------------------------------------

	// --------------------------------------------------------------------
	// Backend Model : Generate Ebooks
	// --------------------------------------------------------------------
	function generate_ebook($limit,$offset)
	{
		$query = $this->db->query("SELECT * FROM ebook WHERE idebook=idebook ORDER BY counter DESC LIMIT $offset,$limit");
		return $query;
	}

    // --------------------------------------------------------------------
	// Backend Model : Get Ebooks by his is int $ebook_id return array
	// --------------------------------------------------------------------
    function get_ebook_by_id($idebook)
    {
		$this->db->select('*');
		$this->db->from('ebook');
		$this->db->where('idebook', $idebook);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		return $query->result_array();
		}
		else{
			redirect('backend/home');
		}
    }

    // --------------------------------------------------------------------
	// Backend Model : Update Ebooks - associative array
	// --------------------------------------------------------------------
    function edit_ebook($idebook, $data)
    {
		$this->db->where('idebook', $idebook);
		$this->db->update('ebook', $data);
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
	// Backend Model : End Ebooks
	// --------------------------------------------------------------------

	// --------------------------------------------------------------------
	// Backend Model : Generate Project
	// --------------------------------------------------------------------
    function generate_project($limit,$offset)
    {
    	 $query = $this->db->query("SELECT * FROM project LEFT OUTER JOIN category ON category.idcategory = project.idcategory ORDER BY idproject DESC LIMIT $offset,$limit");
   		 return $query;
    }

    // --------------------------------------------------------------------
	// Backend Model : Get project int $project_id return array
	// --------------------------------------------------------------------
    function get_project_by_id($idproject)
    {
		$this->db->select('*');
		$this->db->from('project');
		$this->db->where('idproject', $idproject);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		return $query->result_array();
		}
		else{
			redirect('backend/home');
		}
    }

    // --------------------------------------------------------------------
	// Backend Model : Insert data project
	// --------------------------------------------------------------------
    function store_project($data)
    {
		$insert = $this->db->insert('project', $data);
	    return $insert;
	}

    // --------------------------------------------------------------------
	// Backend Model : Update project array data -  associative array
	// --------------------------------------------------------------------
    function update_project($idproject, $data)
    {
		$this->db->where('idproject', $idproject);
		$this->db->update('project', $data);
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
	// Backend Model : Category project
	// --------------------------------------------------------------------
	function get_category_p()
	{
		$this->db->select('*');
		$this->db->from('category');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		return $query->result_array();
		}
		else{
			redirect('backend/home');
		}
	}

	// --------------------------------------------------------------------
	// Backend Model : Generate Image project show
	// --------------------------------------------------------------------
	function generate_image($id_param)
	{
		$hasil = "";
		
		$where['idproject'] = $id_param;
		
		$w = $this->db->get_where("project",$where);
		$i = 0;
		foreach($w->result() as $h)
		{	
			if($i==0)
			{
				$hasil .= '</div>';
				$hasil .= '<div class="cleaner_h20"></div>';
				$hasil .= '<div class="row-fluid product_listing">';
			}
			$hasil .= '<div class="form-group col-lg-4">
						<div class="col-lg-8">
						<img class="img-thumbnail" src="'.base_url().'assets/uploads/thumb-portfolio'.$h->image.'">
						</div>
					   </div>';
			$i++;
			if($i>3)
			{
				$i=0;
			}
		}
		return $hasil;
	}

    // --------------------------------------------------------------------
	// Backend Model : Get category project by his is int $category_id
	// --------------------------------------------------------------------
    function get_category_project_id($idcategory)
    {
		$this->db->select('*');
		$this->db->from('category');
		$this->db->where('idcategory', $idcategory);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		return $query->result_array();
		}
		else{
			redirect('backend/home');
		}
    }

    // --------------------------------------------------------------------
	// Backend Model : Get about by his int $about_id
	// --------------------------------------------------------------------
    function get_about_id($idabout)
    {
		$this->db->select('*');
		$this->db->from('about');
		$this->db->where('idabout', $idabout);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		return $query->result_array();
		}
		else{
			redirect('backend/home');
		}
    }

    // --------------------------------------------------------------------
	// Backend Model : Get users by status user
	// --------------------------------------------------------------------
    function users($limit,$offset)
    {
    	$query = $this->db->query("SELECT * FROM login ORDER BY hit DESC LIMIT $offset,$limit");
    	return $query;
    }

}

	// --------------------------------------------------------------------
	// Backend Model : End Backend Model
	// --------------------------------------------------------------------

/* End of file backend_model.php */
/* Location: ./application/model/backend_model.php */