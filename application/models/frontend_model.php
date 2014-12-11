<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class frontend_model extends CI_Model
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
	// Frontend model : Generate tutorial
	// --------------------------------------------------------------------
	function generate_tutorial($limit,$offset)
	{
		$query = $this->db->query("SELECT a.idtutorial, a.id_category, a.title, a.slug, a.text, a.image, a.tag, a.date, a.publish, a.author, a.counter, b.name, b.slug_cat, (select c.name from login c where c.idlogin=a.author) as idlogin
		FROM tutorial a LEFT OUTER JOIN categorytutorial b ON b.idcategorytutorial = a.id_category WHERE a.idtutorial=idtutorial AND a.publish='yes' ORDER BY idtutorial DESC LIMIT $offset,$limit");
		return $query;
	}

	// --------------------------------------------------------------------
	// Frontend model : Generate detail tutorial
	// --------------------------------------------------------------------
	function generate_detail_tutorial($slug)
	{
		$query = $this->db->query("SELECT a.idtutorial, a.id_category, a.title, a.slug, a.text, a.image, a.tag, a.date, a.publish, a.author, a.counter, b.name, b.slug_cat, c.text as tentang, c.images, c.twitter, c.plus, c.github, (select d.name from login d where d.idlogin=a.author) as idlogin
		FROM tutorial a LEFT JOIN categorytutorial b ON b.idcategorytutorial = a.id_category LEFT OUTER JOIN about c ON c.login_id = a.author WHERE a.slug='$slug' AND publish='yes'");
		if($query->num_rows() > 0)
		{
		return $query;
		}
		else{
			redirect(base_url());
		}
	}

	// --------------------------------------------------------------------
	// Frontend model : Generate category tutorial
	// --------------------------------------------------------------------
	function generate_category($slug,$limit,$offset)
	{
		$query = $this->db->query("SELECT a.idtutorial, a.id_category, a.title, a.slug, a.text, a.image, a.tag, a.date, a.publish, a.author, a.counter, b.name, (select c.name from login c where c.idlogin=a.author) as idlogin
		FROM tutorial a LEFT JOIN categorytutorial b ON b.idcategorytutorial = a.id_category WHERE b.slug_cat='".$slug."' AND a.publish='yes' ORDER BY idtutorial DESC LIMIT $offset,$limit");
		if($query->num_rows() > 0)
		{
			return $query;
		}
		else{
			redirect(base_url());
		}
	}

	// --------------------------------------------------------------------
	// Frontend model : Generate category tutorial
	// --------------------------------------------------------------------
	function generate_cat($slug)
	{
		$this->db->select('name,slug_cat');
		$this->db->from('categorytutorial');
		$this->db->where('slug_cat', $slug);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		   return $query;
		}
		else{
		redirect(base_url());
		}
	}

	// --------------------------------------------------------------------
	// Frontend model : Generate Title Tag
	// --------------------------------------------------------------------
	function tag($tag)
	{
		$this->db->select(explode(',','tag'));
		$this->db->from('tutorial');
		$this->db->like('tag', $tag);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query;
		}
		else{
		    redirect(base_url());
		}
	}

	// --------------------------------------------------------------------
	// Frontend model : Generate List by tags
	// --------------------------------------------------------------------
	function generate_tags($tag)
	{
		$this->db->select('*');
		$this->db->from('tutorial');
		$this->db->like('tag',$tag);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		return $query->result();
		}
		else{
			redirect(base_url());
		}
	}

	// --------------------------------------------------------------------
	// Frontend model : Generate random tutorial
	// --------------------------------------------------------------------
	function generate_random($idtutorial)
	{
		$query = $this->db->query("SELECT * FROM tutorial WHERE idtutorial!='$idtutorial' AND publish='yes' order by RAND() LIMIT 6");
		return $query;
	}

	// --------------------------------------------------------------------
	// Frontend model : Generate tutorial by author
	// --------------------------------------------------------------------
	function generate_tutorial_by_author($author,$limit,$offset)
	{
		$query = $this->db->query("SELECT a.idtutorial, a.id_category, a.title, a.slug, a.text, a.image, a.tag, a.date, a.publish, a.author, a.counter, b.name, b.slug_cat, (select c.name from login c where c.idlogin=a.author) as idlogin
		FROM tutorial a LEFT OUTER JOIN categorytutorial b ON b.idcategorytutorial = a.id_category WHERE a.author='$author' AND a.publish='yes' ORDER BY idtutorial DESC LIMIT $offset,$limit");
		if($query->num_rows() > 0)
		{
		return $query->result();
		}
		else{
			redirect(base_url());
		}
	}

	// --------------------------------------------------------------------
	// Frontend model : Generate author by id
	// --------------------------------------------------------------------
	function generate_author($author)
	{
		$this->db->select('name');
		$this->db->from('login');
		$this->db->where('idlogin',$author);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		return $query->result();
		}
		else{
			redirect(base_url());
		}
	}

	// --------------------------------------------------------------------
	// Frontend model : Generate counter tutorial
	// --------------------------------------------------------------------
	function generate_counter($slug)
	{
		$query = $this->db->query("UPDATE tutorial SET counter=counter+1 WHERE slug='$slug'");
		return $query;
	}

	// --------------------------------------------------------------------
	// Frontend model : Generate popular tutorial
	// --------------------------------------------------------------------
	function generate_popular($limit)
	{
		$popular = $this->db->query("SELECT * FROM tutorial WHERE publish='yes' ORDER BY counter DESC LIMIT $limit");
		return $popular;
	}

	// --------------------------------------------------------------------
	// Frontend model : Generate list tutorial
	// --------------------------------------------------------------------
	function generate_list_tutorial($list,$offset)
	{
		$query = $this->db->query("SELECT a.idtutorial, a.id_category, a.title, a.slug, a.text, a.image, a.tag, a.date, a.publish, a.author, a.counter, b.name, b.slug_cat, (select c.name from login c where c.idlogin=a.author) as idlogin
		FROM tutorial a LEFT OUTER JOIN categorytutorial b ON b.idcategorytutorial = a.id_category WHERE a.idtutorial=idtutorial AND a.publish='yes' ORDER BY idtutorial DESC LIMIT $offset,$list");
		return $query;
	}

	// --------------------------------------------------------------------
	// Frontend model : Generate list popular
	// --------------------------------------------------------------------
	function generate_list_popular($list,$offset)
	{
		$popular = $this->db->query("SELECT a.idtutorial, a.id_category, a.title, a.slug, a.text, a.tag, a.image, a.date, a.publish, a.author, a.counter, b.name, b.slug_cat, (select c.name from login c where c.idlogin=a.author) as idlogin
		FROM tutorial a LEFT OUTER JOIN categorytutorial b ON b.idcategorytutorial = a.id_category WHERE a.publish='yes' ORDER BY counter DESC LIMIT $offset,$list");
		return $popular;
	}
	// --------------------------------------------------------------------
	// Frontend model : End tutorial
	// --------------------------------------------------------------------

	// --------------------------------------------------------------------
	// Frontend model : Generate project
	// --------------------------------------------------------------------
	function generate_project($limit,$offset)
	{
		$query = $this->db->query("SELECT * FROM project x LEFT OUTER JOIN category y ON y.idcategory = x.idcategory WHERE x.idproject=idproject ORDER BY idproject DESC LIMIT $offset,$limit");
		return $query;
	}

	// --------------------------------------------------------------------
	// Frontend model : Generate detail project
	// --------------------------------------------------------------------
	function generate_detail_project($slug)
	{
		$query = $this->db->query("SELECT x.idproject, x.idcategory, x.title, x.slug, x.text, x.image, x.date, x.author, y.name, (select c.name from login c where c.idlogin = x.author) as idlogin FROM project x LEFT OUTER JOIN category y ON y.idcategory = x.idcategory WHERE x.slug='$slug'");
		if($query->num_rows() > 0)
		{
		return $query;
		}
		else{
			redirect(base_url());
		}
	}
	// --------------------------------------------------------------------
	// Frontend model : End generate project
	// --------------------------------------------------------------------

	// --------------------------------------------------------------------
	// Frontend model : Generate Ebooks
	// --------------------------------------------------------------------
	function generate_ebook($limit,$offset)
	{
		$query = $this->db->query("SELECT * FROM ebook WHERE idebook=idebook ORDER BY idebook DESC LIMIT $offset,$limit");
		return $query;
	}

	// --------------------------------------------------------------------
	// Frontend model : Generate counter ebook
	// --------------------------------------------------------------------
	function update_counter_ebook($id)
	{
		$query = $this->db->query("UPDATE ebook SET counter=counter+1 WHERE idebook='$id'");
		return $query;
	}

	// --------------------------------------------------------------------
	// Frontend model : Generate popular ebook
	// --------------------------------------------------------------------
	function popular_ebook()
	{
		$query = $this->db->query("SELECT * FROM ebook ORDER BY idebook DESC LIMIT 3");
		return $query;
	}

	// --------------------------------------------------------------------
	// Frontend model : Get ebook where id
	// --------------------------------------------------------------------
	function get_ebook($id)
	{
		$this->db->select('*');
		$this->db->from('ebook');
		$this->db->where('idebook',$id);
		$query = $this->db->get();
		return $query->result();
	}
	// --------------------------------------------------------------------
	// Frontend model : End ebook
	// --------------------------------------------------------------------

	// --------------------------------------------------------------------
	// Frontend model : Generate Searching tutorial
	// --------------------------------------------------------------------
	function generate_search($limit,$offset,$kata)
	{
	$this->db->select('*');
	$this->db->from('tutorial');
	if(!empty($kata)) {
		$this->db->like('title',$kata);
	}
	   $this->db->order_by('idtutorial','DESC');
	   $getData = $this->db->get('',$limit,$offset);

	   if($getData->num_rows() > 0)
		return $getData->result_array();
	   else
		return null;
	}

	// --------------------------------------------------------------------
	// Frontend model : Generate About Us
	// --------------------------------------------------------------------
	function generate_about($limit,$offset)
	{
		$query = $this->db->query("SELECT a.idabout, a.login_id, a.text, a.images, a.twitter, a.plus, a.github, b.name, b.status
		FROM about a LEFT OUTER JOIN login b ON b.idlogin = a.login_id WHERE b.status='admin' ORDER BY idabout LIMIT $offset, $limit");
		return $query->result();
	}

}
	// --------------------------------------------------------------------
	// Frontend model : End Frontend model
	// --------------------------------------------------------------------

/* End of file frontend_model.php */
/* Location: ./application/model/frontend_model.php */