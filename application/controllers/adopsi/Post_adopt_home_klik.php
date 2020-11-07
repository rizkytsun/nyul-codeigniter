<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH . '/libraries/REST_Controller.php');
require (APPPATH . 'libraries/Format.php');
use chriskacerguis\RestServer\RestController;

class Post_adopt_home_klik extends RestController {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Adopt_model');
    }

    public function index_get () {
    	$
    }