<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH . '/libraries/REST_Controller.php');
require (APPPATH . 'libraries/Format.php');
use chriskacerguis\RestServer\RestController;

class Post_adopt extends RestController {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Adopt_model');
    }

    public function index_get () {
        $fungsi          = $this->get('fungsi');

        if( $fungsi == 1) {
            $sql = 'SELECT judul, umur, alamat, metode_adopsi FROM post_adopt';
        } elseif ($fungsi = 2) {
            $kode = $this->get('kode');
            $sql = ' SELECT * FROM post_adopt WHERE kode =  "'. $kode . '"';
        }

        $data = $this->db->query ($sql)->result();

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

    public function index_post () {
        $namaavatar   = $_FILES['foto_img_url']['name'];
        $tmp          = $_FILES['foto_img_url']['tmp_name'];
        $direktori    = "uploads/post_adopt/".$namaavatar;

		$data = [
            'kode' 				=> $this->post('kode'),
            'judul' 			=> $this->post('judul'),
            'foto_img_url' 		=> $this->post('foto_img_url'),
            'deskripsi' 		=> $this->post('deskripsi'),
            'umur' 				=> $this->post('umur'),
            'x_jenis'			=> $this->post('x_jenis'),
            'x_ras' 			=> $this->post('x_ras'), 
            'ras_lainnya'		=> $this->post('ras_lainnya'),
            'pedigree_img_url'	=> $this->post('pedigree_img_url'),
            'jenis_kelamin' 	=> $this->post('jenis_kelamin'),
            'vaksin' 			=> $this->post('vaksin'),
            'steril' 			=> $this->post('steril'),
            
        ];

        if( $this->Adopt_model->createAdopt($data)) {
            move_uploaded_file($tmp, $direktori);
            $this->response([
                'result' => true,
                'data' => 'data baru telah ditambahkan.',
            ],200);
        } else {
            $this->response ([
                'result' => false,
                'data' => 'gagal menambah data baru!'
            ],404);
        }    
    } 

    // public function upload_img() {
    //     $image = base64_decode($this->input->post("foto_img_url"));
    //     $image_name = md5(uniqid(rand(), true));
    //     $filename = $image_name . '.' . 'jpg';
    //     //rename file name with random number
    //     $path = "./uploads/post_adopt/".$filename;
    //     //image uploading folder path
    //     file_put_contents($path . $filename, $image);
    //     // image is bind and upload to respective folde

    //     $data_insert = array('foto_img_url'=>$filename);

    //     $success = $this->Adopt_model->insert_img($data);
    //         if($success){
    //             $b = "User Registered Successfully..";
    //     } else {
    //         $b = "Some Error Occured. Please Try Again..";
    //     } 
    //         echo json_encode($b);
    // }
}
