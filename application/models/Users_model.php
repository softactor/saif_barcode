<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {
    
    public function duplicate_entry_check($chck_data)
    {
        $query = $this->db->select('*');
        if(isset($chck_data['where'])){
            $query = $this->db->where($chck_data['where']);
        }
        if(isset($chck_data['where_not_in'])){
            $query = $this->db->where_not_in($chck_data['where_not_in']);
        }
        $query = $this->db->get($chck_data['table']);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }        
}
