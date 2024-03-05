<?php
class Api_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_data() {
        $query = $this->db->get('tbl_sample');
        return $query->result();
    }

    public function insert_data($data) {
        return $this->db->insert('tbl_sample', $data);
    }

}