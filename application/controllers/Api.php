<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Api_model');
    }

    public function index(){
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(405)
                ->set_output(json_encode(array('message' => 'Method Not Allowed')));
            return;
        }

        $data = $this->Api_model->get_data();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

}

 