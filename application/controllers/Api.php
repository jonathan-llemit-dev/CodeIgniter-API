<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Api_model');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
    }

    private function authorize()
    {
        // Check for the token in the Authorization header
        $headers = $this->input->get_request_header('Authorization', TRUE);
        if (!$headers) {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(401)
                ->set_output(json_encode(array('message' => 'Authorization required')));
            return false;
        }

        $expectedToken = 'qweqweQ1!';

        // Check if the token matches the expected token
        if ($headers !== 'Bearer ' . $expectedToken) {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(401)
                ->set_output(json_encode(array('message' => 'Unauthorized')));
            return false;
        }

        return true;
    }

    public function index($id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(405)
                ->set_output(json_encode(array('message' => 'Method Not Allowed')));
            return;
        }

        // Check for authorization
        if (!$this->authorize()) {
            return;
        }

        $data = $this->Api_model->get_data($id);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function insert()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(405)
                ->set_output(json_encode(array('message' => 'Method Not Allowed')));
            return;
        }

        // Check for authorization
        if (!$this->authorize()) {
            return;
        }

        // Decode JSON data from the request body
        $input_data = json_decode(trim(file_get_contents('php://input')), true);

        // Set validation rules
        $this->form_validation->set_data($input_data);
        $this->form_validation->set_rules('first_name', 'First Name', 'required', array('required' => 'The %s field is required. '));
        $this->form_validation->set_rules('last_name', 'Last Name', 'required', array('required' => 'The %s field is required. '));
        $this->form_validation->set_rules('age', 'Age', 'required|numeric', array(
            'required' => 'The %s field is required.',
            'numeric' => 'The %s field must contain only numbers.'
        ));
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tbl_sample.email]', array(
            'required' => 'The %s field is required.',
            'valid_email' => 'The %s field must contain a valid email address.',
            'is_unique' => 'The %s field must contain a unique value.'
        ));

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
            'last_name' => $input_data['last_name'],
            'age' => $input_data['age'],
            'email' => $input_data['email']
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

    public function update($id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(405)
                ->set_output(json_encode(array('message' => 'Method Not Allowed')));
            return;
        }

        // Check for authorization
        if (!$this->authorize()) {
            return;
        }

        if (!$id) {
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
        $this->form_validation->set_rules('age', 'Age', 'required|numeric', array(
            'required' => 'The %s field is required.',
            'numeric' => 'The %s field must contain only numbers.'
        ));

        $unique_email_rule = 'required|valid_email|is_unique[tbl_sample.email,id,' . $id . ']';
        $this->form_validation->set_rules('email', 'Email', $unique_email_rule, array(
            'required' => 'The %s field is required.',
            'valid_email' => 'The %s field must contain a valid email address.',
            'is_unique' => 'The %s field must contain a unique value.'
        ));

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
            'last_name' => $input_data['last_name'],
            'age' => $input_data['age'],
            'email' => $input_data['email']
        );

        try {
            // Perform the update operation
            if ($this->Api_model->update_data($id, $update_data)) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200) // 200 OK
                    ->set_output(json_encode(array('message' => 'Data updated successfully')));
            } else {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(404) // 404 Not Found
                    ->set_output(json_encode(array('message' => 'Data not found')));
            }
        } catch (Exception $e) {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(500) // 500 Internal Server Error
                ->set_output(json_encode(array('message' => 'Failed to update data')));
        }
    }

    public function delete($id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(405)
                ->set_output(json_encode(array('message' => 'Method Not Allowed')));
            return;
        }

        // Check for authorization
        if (!$this->authorize()) {
            return;
        }

        // Check if the id parameter is present
        if (!$id) {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode(array('message' => 'ID parameter is required.')));
            return;
        }

        try {
            // Perform the delete operation
            if ($this->Api_model->delete_data($id)) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200) // 200 OK
                    ->set_output(json_encode(array('message' => 'Data deleted successfully')));
            } else {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(404) // 404 Not Found
                    ->set_output(json_encode(array('message' => 'Data not found or already deleted')));
            }
        } catch (Exception $e) {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(500) // 500 Internal Server Error
                ->set_output(json_encode(array('message' => 'Failed to delete data')));
        }
    }
}
