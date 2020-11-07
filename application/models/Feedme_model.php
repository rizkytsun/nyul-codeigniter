<?php

	class Feedme_model extends CI_Model {

		function createFeedme ($data) {
			$this->db->insert('post_feed_me', $data);
    		return $this->db->affected_rows();
		} 

	}