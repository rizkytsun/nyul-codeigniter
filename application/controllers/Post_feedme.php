<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH . '/libraries/REST_Controller.php');
require (APPPATH . 'libraries/Format.php');
use chriskacerguis\RestServer\RestController;

	class Post_feedme extends RestController {
		function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Feedme_model');
    }

    public function index_get () {
    	$judul		= $this->get('judul');
    	$deskripsi	= $this->get('deskripsi');
    	$lokasi_map	= $this->get('lokasi_map');
    	$alamat		= $this->get('alamat');
    	$tanggal	= $this->get('tanggal');
    	$jam		= $this->get('jam');

    	$data = $this->db->query (
    		'SELECT judul, deskripsi, lokasi_map, alamat, tanggal, jam FROM post_feed_me'
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
    		'kode_post_feed_me' => $this->post('kode_post_feed_me'),
    		'judul' 			=> $this->post('judul'),
    		'deskripsi' 		=> $this->post('deskripsi'),
    		'x_kode_member' 	=> $this->post('x_kode_member'),
    		'lokasi_map' 		=> $this->post('lokasi_map'),
    		'alamat' 			=> $this->post('alamat'),
    		'x_prov' 			=> $this->post('x_prov'),
    		'x_kota' 			=> $this->post('x_kota'),
    		'tanggal' 			=> $this->post('tanggal'),
    		'jam' 				=> $this->post('jam')			
    	];

    if( $this->Feedme_model->createFeedme($data)) {
    	$this->response ([
    			'result' => true,
    			'data' 	 => 'data Feedme baru telah ditambahkan.',
            ],200);
        } else {
            $this->response ([
                'result' => false,
                'data' 	 => 'gagal menambah data Feedme baru!'
            ],404);
        }
    }
}