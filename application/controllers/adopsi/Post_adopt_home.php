<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH . '/libraries/REST_Controller.php');
require (APPPATH . 'libraries/Format.php');
use chriskacerguis\RestServer\RestController;

class Post_adopt_home extends RestController {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Adopt_model');
    }

    public function index_get() {
    	$x_jenis = $this->get('x_jenis');

    	$sql = 'SELECT judul, x_ras, umur, alamat, metode_adopsi FROM post_adopt ORDER BY tgl_posting DESC LIMIT 5';
    	$data = $this->db->query ($sql
        )->result();

    	$data = $this->db->query(
            'SELECT * FROM post_adopt WHERE x_jenis = '. $x_jenis     
        )->result();

        // return json with response
        if($data){
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
                    "data"   => "Informasi yang anda masukkan tidak benar"
                ],
                   404
            );
        }
	}
}