<?php

	class Rescue_model extends CI_Model {

		function createRescue ($data) {
			$this->db->insert('post_rescue', $data);
    		return $this->db->affected_rows();
		} 
	}