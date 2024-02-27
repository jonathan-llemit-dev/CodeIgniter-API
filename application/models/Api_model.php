<?php
class Api_model extends CI_Model {

    function fetch_all(){
        $this->db->order_by('id', 'DESC');
        return $this->db->get('tbl_sample');
    }

    function insert_api($data){
        $this->db->insert('tbl_sample', $data);

        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function fetch_single_user($user_id){
        $this->db->where("id", $user_id);
        $query = $this->db->get('tbl_sample');
        return $query->result_array();
    }
	
}
