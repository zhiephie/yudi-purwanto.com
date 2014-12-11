<?php

class demo_model extends CI_Model
{
	function gets(){	
		$this->db->select("title, slug, text");
		$this->db->from('tutorial');
		$this->db->limit(10);
		$query = $this->db->get();
		return $query->result();			
	}
}