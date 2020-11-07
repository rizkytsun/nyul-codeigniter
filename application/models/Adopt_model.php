<?php

class Adopt_model extends CI_Model {

	function createAdopt ($data) {
		$this->db->insert('post_adopt', $data);
		return $this->db->affected_rows();
	}
 	
 	function insert_img($data) {
		$this->db->insert('post_adopt', $data);
		return $this->db->affected_rows();
	}	
}