<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ApiTest extends CI_Controller
{

    public function index()
    {

        $username = 'ussc';
        $password = 'qweqweQ1!';

        $authString = base64_encode("$username:$password");

        $curl = curl_init();

        curl_setopt_array($curl, array(
            // refering to the host machine from within a Docker container
            CURLOPT_URL => 'http://host.docker.internal:8000/api',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 10, // Set timeout to 10 seconds
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic $authString"
            ),
        ));

        $response = curl_exec($curl);

        if ($response === false) {
            echo 'Curl error: ' . curl_error($curl);
        } else {
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($http_code == 200) {
                $data['api_response'] = json_decode($response, true);
                if ($data['api_response'] === null) {
                    echo 'Invalid JSON response';
                } else {
                    $this->load->view('dashboard', $data);
                }
            } else {
                echo 'HTTP error: ' . $http_code;
            }
        }

        curl_close($curl);
    }
}
