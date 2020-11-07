<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH . '/libraries/REST_Controller.php');
require (APPPATH . 'libraries/Format.php');
use chriskacerguis\RestServer\RestController;

	class post_rescue_home extends RestController {
		function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Rescue_model');
    }

    public function index_get() {
    	$urgensi	= $this->get('urgensi');

    	$data = $this->db->query (
    		'SELECT * FROM post_rescue WHERE urgensi = '. $urgensi
    	)-> result();

    	// return json with response
        if($data){
            $this->response(
                [
                    "result" => true,
                    "data"   => $data
                ],
                200
            );
        } else {
            $this->response(
                [
                    "result" => false,
                    "data"   => "Data yang anda masukkan salah"
                ],
                404
            );
        }
    }
}