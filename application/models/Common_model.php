<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {
    
    public function duplicate_entry_check($chck_data)
    {
        $query = $this->db->select('*');
        if(isset($chck_data['where'])){
            $query = $this->db->where($chck_data['where']);
        }
        if(isset($chck_data['where_not_in'])){
            $query = $this->db->where_not_in('id',$chck_data['where_not_in']);
        }
        $query = $this->db->get($chck_data['table']);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function common_table_data_read($get_data, $limit=null, $single = false)
    {
        $this->db->select('*');
        if(isset($get_data['where']) && !empty($get_data['where'])){
            $this->db->where($get_data['where']);
        }
        if(isset($get_data['where_in']) && !empty($get_data['where_in'])){
            $this->db->where_in($get_data['where_in']['field'],$get_data['where_in']['values']);
        }
        if(isset($limit)){
            $this->db->limit($limit);
         }
        $this->db->order_by('id','desc');
        $result = $this->db->get($get_data['table']);
        //echo $this->db->last_query();
        if($result->num_rows() > 0){
            $feedback = [
                'status'=>'success',
                'message'=>'Data Found',
                'data'=>(($single) ? $result->row() : $result->result())
            ];
        }else{
           $feedback = [
                'status'=>'error',
                'message'=>'Data Not Found',
                'data'=>''
            ];
        }
        return $feedback;
    }
    
    public function common_table_data_search($get_data)
    {
        $this->db->select('*');
        $this->db->like($get_data['like']);
        $this->db->limit($get_data['limit']);
        $result = $this->db->get($get_data['table']);
        if($result->num_rows() > 0){
            $feedback = [
                'status'=>'success',
                'message'=>'Data Found',
                'data'=>$result->result()
            ];
        }else{
           $feedback = [
                'status'=>'error',
                'message'=>'Data Not Found',
                'data'=>''
            ];
        }
        return $feedback;
    }
    
    public function common_table_data_insert($instert_data)
    {
        $this->db->insert($instert_data['table'], $instert_data['fields']);
        if($this->db->affected_rows() > 0){
            return $this->db->insert_id();
        }else{
           return false; 
        }
    }
    
    public function common_table_data_update($update_data)
    {
        $this->db->where($update_data['where'])
            ->update($update_data['table'], $update_data['fields']);
        if ($this->db->affected_rows() != '-1') {
            return true;
        } else {
            return false;
        }
    }
    
    public function common_table_data_delete($delete_data)
    {
        $this->db->where($delete_data['where']);
        $this->db->delete($delete_data['table']);
        if ($this->db->affected_rows() != '-1') {
            return true;
        } else {
            return false;
        }
    }
    
    public function get_all_data($data, $order_by_type = "asc", $join_type = 'inner'){
        $this->db->select('*')
            ->where($data['where']);

        if (array_key_exists("join_type", $data)) {
            $join_type = $data['join_type'];
        }

        if (array_key_exists("join_table", $data)) {
            $this->db->join($data['join_table'], $data['join_by'], $join_type);
        }

        if (array_key_exists("sorting", $data)) {
            $this->db->order_by('sorting', $data['sorting']);
        }

        if (array_key_exists("order_by_type", $data)) {
            $order_by_type = $data['order_by_type'];
        }

        if (array_key_exists("order_by", $data)) {
            $this->db->order_by($data['order_by'], $order_by_type);
        }

        if (array_key_exists("group_by", $data)) {
            $this->db->group_by($data['group_by']);
        }

        if (array_key_exists("or_where", $data)) {
            $this->db->or_where($data['or_where']);
        }

        if (array_key_exists("where_in", $data)) {
            $this->db->where_in($data['where_in'][0], $data['where_in'][1]);
        }

        if (array_key_exists("where_raw", $data)) {
            $this->db->where($data['where_raw']);
        }

        $result = $this->db->get($data['table']);

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }
    }
    
    public function get_last_row_id($param){
        $row = $this->db->select("*")->limit(1)->order_by('id',"DESC")->get($param['table'])->row();
        if(isset($row) && !empty($row)){
            return $row->id + 1;
        }else{
            return 1;
        }
    }
    public function sheetno_from_qrhistory(){
        $this->db->select('sheet_id');
        $this->db->group_by('sheet_id');
        $this->db->from('qrcode_history');
        $query = $this->db->get();
        return $query->result();
    }
}
