<?php

class Memberlogin_model extends CI_Model {

	function memberLogin ($data) {
		$this->db->insert('Member_login', $data);
		return $this->db->affected_rows();
	}
}