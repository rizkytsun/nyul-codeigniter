<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH . '/libraries/REST_Controller.php');
require (APPPATH . 'libraries/Format.php');
use chriskacerguis\RestServer\RestController;

	class Post_feedme_klik extends RestController {
		function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Feedme_model');
    }

    public function index_get() {
    	$kode_post_feed_me = $this->get('kode_post_feed_me');

    	$data = $this->db->query(
    		'SELECT * FROM post_feed_me WHERE kode_post_feed_me = "'. $kode_post_feed_me .'"'
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