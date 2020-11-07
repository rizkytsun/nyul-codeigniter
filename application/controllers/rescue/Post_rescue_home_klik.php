<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH . '/libraries/REST_Controller.php');
require (APPPATH . 'libraries/Format.php');
use chriskacerguis\RestServer\RestController;

	class Post_rescue_home_klik extends RestController {
		function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Rescue_model');
    }

    public function index_get() {
    	$kode_request_rescue	= $this->get('kode_request_rescue');

    	$data = $this->db->query (
    		'SELECT * FROM post_rescue WHERE kode_request_rescue = "'. $kode_request_rescue .'"'
    	)->result();

    	// Return json nya dengan response

    	if($data) {
    		$this->response ([
    			'result' => true,
    			'data'   => $data
    		],200);
    	} else {
    		$this->response ([
    			'result' => false,
    			'data'   => 'Informasi yang anda masukkan salah!'
    		],404);
		}
	}
}