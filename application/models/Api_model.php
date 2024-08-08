<?php
class Api_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_data($id)
    {
        if ($id !== null) {
            $this->db->where('id', $id);
            $query = $this->db->get('tbl_sample');
        } else {
            $query = $this->db->get('tbl_sample');
        }
        return $query->result();
    }

    public function insert_data($data)
    {
        return $this->db->insert('tbl_sample', $data);
    }

    public function update_data($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_sample', $data);
        return $this->db->affected_rows() > 0;
    }

    public function email_exists_except_id($email, $id)
    {
        $this->db->where('email', $email);
        $this->db->where('id !=', $id);
        $query = $this->db->get('tbl_sample');
        return $query->num_rows() > 0;
    }

    public function delete_data($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_sample');
        return $this->db->affected_rows() > 0;
    }
}
