<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiTest extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Api_model');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
    }

    public function index(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost:8000/api',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic dXNzYzpxd2Vxd2VRMSE='
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $data['response'] = $response;
        $this->load->view('dashboard', $data);

    }

}

 