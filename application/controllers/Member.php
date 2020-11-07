<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH . '/libraries/REST_Controller.php');
require (APPPATH . 'libraries/Format.php');
use chriskacerguis\RestServer\RestController;

class Member extends RestController {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Member_model');
    }

    //Menampilkan data login
    public function index_get() {
        $tipe = $this->get('tipe');

        $data = $this->db->query(
            'SELECT * FROM member WHERE tipe = '. $tipe     
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
                    "data"   => "Pastikan ID User dan password sudah benar."
                ],
                404
            );
        }
    }

    public function index_delete() {
        $kode = $this->delete('kode');

        if($kode === null) {
            $this->response([
                'result'  => false,
                'data'    => 'Masukkan kode'
            ]);
        } else {
            if($this->Member_model->deleteMember($kode)) {
                // ok
                $this->response([
                    'result' => true,
                    'data'   => 'Terhapus'
                ],200);
            } else {
                // kode not found
                $this->response([
                    'result' => false,
                    'data' => 'kode tidak ditemukan'
                ],404);
            }
        }
    }

    public function index_post() {
        $data = [
            'kode'          => $this->post('kode'),
            'nama'          => $this->post('nama'),
            'email'         => $this->post('email'),
            'hp_telepon'    => $this->post('hp_telepon'),
            'alamat'        => $this->post('alamat'),
            'x_prov'        => $this->post('x_prove'),
            'x_kota'        => $this->post('x_kota'),
            'tipe'          => $this->post('tipe')
        ];

        if( $this->Member_model->createMember($data)) {
            $this->response([
                'result'   => true,
                'data'     => 'data baru telah ditambahkan.',
            ],200);
        } else {
            $this->response ([
                'result'   => false,
                'data'     => 'gagal menambah data baru!'
            ],404);
        }    
    }
}
        // $data = $this->db->query (
        //     'INSERT INTO member (kode, nama, email, hp_telepon, alamat, x_prov, x_kota, tipe) VALUSE (USR0000100, Mohamad Rizky, Rizkytsun@gmail.com, 6276611, Pagelaran, '3','3', '3'); '

        // )->result();

        // // return json with response
        // if($data) {
        //     $this->response (
        //         [
        //             "result" => true,
        //             "data" => $data
        //         ],
        //         200
        //     );

        // } else {
        //     $this->response (
        //         [
        //             "result" => false,
        //             "data" => "Data tidak terkirim."
        //         ],
        //         404
        //     );
        // }               
