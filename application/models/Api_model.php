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
	
}
