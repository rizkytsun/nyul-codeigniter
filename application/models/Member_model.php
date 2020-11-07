<?php

class Member_model extends CI_Model {

    function deleteMember ($kode) {
    	$this->db->where('kode',$kode);
    	$this->db->delete('member');
    	return $this->db->affected_rows();
    }

    function createMember ($data) {
    	$this->db->insert('member', $data);
    	return $this->db->affected_rows();
    }
}