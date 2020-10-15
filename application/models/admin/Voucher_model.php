<?php

class Voucher_model extends CI_Model {
    private $table_name = 'voucher';
    function __construct() {
        parent::__construct();
    }

    function validateData() {
        $arr = $this->config->item('voucher', 'validation_rules');
        $this->form_validation->set_rules($this->config->item('voucher', 'validation_rules'));
        if ($this->form_validation->run() == FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function store() {
        $postData = $this->input->post('voucher');
        $postData['created_at'] = date('Y-m-d H:i:s');
        $postData['updated_at'] = date('Y-m-d H:i:s');
        $postData['company_id'] = implode(',', $postData['company_id']);
        $result = $this->db->insert($this->table_name, $postData);
        if($result)
            return true;
        else
            return false;
    }

    public function get($limit,$start,$id="") {
        if($id!=""){
            $this->db->where('id',$id);
        }
        else{
            $this->db->where('is_deleted','0');
            $this->db->limit($limit, $start);
        }    
        $query = $this->db->get($this->table_name);
        if($id!="")
            return $query->row_array();
        else
           return $query->result_array();     
    }

    public function get_count() {
        $query = $this->db->where('is_deleted','0')->get($this->table_name);
        return $query->num_rows();
        return $this->db->count_all($this->table_name);
    }

    public function update(){
        $postData = $this->input->post();
        $this->db->where('id',$postData['id']); 
        $postData['voucher']['company_id'] = implode(',', $postData['voucher']['company_id']); 
        $result = $this->db->update($this->table_name,$postData['voucher']);
        if($result)
            return true;
        else
            return false;
    }

    public function delete(){
        $id = $this->input->get('id');
        $this->db->where('id',$id);  
        $result = $this->db->update($this->table_name,array('is_deleted'=>'1'));
        if($result)
            return true;
        else
            return false;
    }
}
