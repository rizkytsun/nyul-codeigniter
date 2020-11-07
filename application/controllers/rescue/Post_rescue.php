<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH . '/libraries/REST_Controller.php');
require (APPPATH . 'libraries/Format.php');
use chriskacerguis\RestServer\RestController;

	class Post_rescue extends RestController {
		function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Rescue_model');
    }

    public function index_get () {
    	$judul				= $this->get('judul');
    	$deskripsi			= $this->get('deskripsi');
    	$tanggal_posting	= $this->get('tanggal_posting');
    	$urgensi			= $this->get('urgensi');
    	$tanggal_expired	= $this->get('tanggal_expired');
    	$alamat_detail		= $this->get('alamat_detail');

    	$data = $this->db->query (
    		'SELECT judul, deskripsi, tanggal_posting, urgensi, tanggal_expired, alamat_detail FROM post_rescue'
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

    public function index_post () {
    	$data = [
    		'kode_request_rescue'	=> $this->post('kode_request_rescue'),
    		'judul'					=> $this->post('judul'),
    		'foto_img_url'			=> $this->post('foto_img_url'),
    		'jenis_hewan'			=> $this->post('jenis_hewan'),
    		'deskripsi'				=> $this->post('deskripsi'),
    		'x_kode_member'			=> $this->post('x_kode_member'),
    		'tanggal_posting'		=> $this->post('tanggal_posting'),
    		'urgensi'				=> $this->post('urgensi'),
    		'tanggal_expired'		=> $this->post('tanggal_expired'),
    		'lokasi_map'			=> $this->post('lokasi_map'),
    		'alamat_detail'			=> $this->post('alamat_detail'),
    		'x_prov'				=> $this->post('x_prov'),
    		'x_kota'				=> $this->post('x_kota')
    	];

    if( $this->Rescue_model->createRescue($data)) {
    	$this->response([
    			'result' => true,
            	'data' 	 => 'data baru telah ditambahkan.',
            ],200);
        } else {
            $this->response ([
                'result' => false,
                'data' => 'gagal menambah data baru!'
            ],404);
        }
    }
}