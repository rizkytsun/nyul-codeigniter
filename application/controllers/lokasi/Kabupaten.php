<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH . '/libraries/REST_Controller.php');
require (APPPATH . 'libraries/Format.php');
use chriskacerguis\RestServer\RestController;

class Kabupaten extends RestController {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Member_model');
    }

    // Menampilkan data kabupaten berdasar Kode Provinsi
    public function index_get() {
    	$x_kode_prov = $this->get('x_kode_prov');

    	$data = $this->db->query(
    		'SELECT * FROM kab_kota WHERE x_kode_prov = '.$x_kode_prov
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