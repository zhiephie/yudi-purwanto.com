<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class rss_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function get_posts()
	{
                $this->db->limit(10);
                $this->db->order_by("idtutorial", "desc");
		$query = $this->db->get('tutorial')->result();
		return $query;
	}
	
}