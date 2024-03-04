<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Api_model');
    }

    public function index(){
        $data = $this->Api_model->get_data();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

}

 