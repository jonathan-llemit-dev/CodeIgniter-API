<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Api_model');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
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

    public function insert(){
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(405)
                ->set_output(json_encode(array('message' => 'Method Not Allowed')));
            return;
        }

        // Decode JSON data from the request body
        $input_data = json_decode(trim(file_get_contents('php://input')), true);

        // Set validation rules
        $this->form_validation->set_data($input_data);
        $this->form_validation->set_rules('first_name', 'First Name', 'required', array('required' => 'The %s field is required. '));
        $this->form_validation->set_rules('last_name', 'Last Name', 'required', array('required' => 'The %s field is required. '));


        // Validate the input data
        if ($this->form_validation->run() == false) {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode(array('message' => str_replace("\n", "", validation_errors()))));
            return;
        }

        // Insert data into the database
        $insert_data = array(
            'first_name' => $input_data['first_name'],
            'last_name' => $input_data['last_name']
        );

        if ($this->Api_model->insert_data($insert_data)) {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(201) // 201 Created
                ->set_output(json_encode(array('message' => 'Data inserted successfully')));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(500) // 500 Internal Server Error
                ->set_output(json_encode(array('message' => 'Failed to insert data')));
        }
    }

    public function update($id = null){
        if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(405)
                ->set_output(json_encode(array('message' => 'Method Not Allowed')));
            return;
        }

        if(!$id){
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode(array('message' => 'ID parameter required.')));
            return;
        }

        // Decode JSON data from the request body
        $input_data = json_decode(trim(file_get_contents('php://input')), true);

        // Set validation rules
        $this->form_validation->set_data($input_data);
        $this->form_validation->set_rules('first_name', 'First Name', 'required', array('required' => 'The %s field is required. '));
        $this->form_validation->set_rules('last_name', 'Last Name', 'required', array('required' => 'The %s field is required. '));


        // Validate the input data
        if ($this->form_validation->run() == false) {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode(array('message' => str_replace("\n", "", validation_errors()))));
            return;
        }

        // Update data in the database
        $update_data = array(
            'first_name' => $input_data['first_name'],
            'last_name' => $input_data['last_name']
        );

        if ($this->Api_model->update_data($id, $update_data)) {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(200) // 200 OK
                ->set_output(json_encode(array('message' => 'Data updated successfully')));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(500) // 500 Internal Server Error
                ->set_output(json_encode(array('message' => 'Failed to update data')));
        }
    }

}

 