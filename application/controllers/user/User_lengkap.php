<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH . '/libraries/REST_Controller.php');
require (APPPATH . 'libraries/Format.php');
use chriskacerguis\RestServer\RestController;

class User_lengkap extends RestController {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Member_model');
    }

    // menampilkan data login
    public function index_get() {
    	$kode = $this->get('kode');

    	$data = $this->db->query(
    		'SELECT * FROM member WHERE kode = "'. $kode .'"'
    	)->result();

    	//return JSON with response
    	if($data) {
    		$this->response(
    			[
                    "result" => true,
                    "data"   => $data
                ],
                200
            );
        }else{
            $this->response(
                [
                    "result" => false,
                    "data"   => "Pastikan ID User dan password sudah benar."
                ],
                404
            );
        }
    }
}