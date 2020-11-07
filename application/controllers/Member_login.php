<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH . '/libraries/REST_Controller.php');
require (APPPATH . 'libraries/Format.php');
use chriskacerguis\RestServer\RestController;

class Member_login extends RestController {
        function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Member_model');
    }

    //Menampilkan data login        
    public function index_get() {
        $id       = $this->get('id');
        $username = $this->get('username');
        $password = $this->get('password');

        $data = $this->db->query (
    		'SELECT id, username, password FROM member_login WHERE username= "'. $username . '" AND password= "'. $password .'"'
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
}