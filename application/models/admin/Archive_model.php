<?php

class Archive_model extends CI_Model {
    private $holding_table = 'holding_contest_participants';
    private $table_name = 'contest_participants';
    private $table_name1 = 'contest_participants_archive';
    function __construct() {
        parent::__construct();
    }

    function validateData() {
        $arr = $this->config->item('contest_participants', 'validation_rules');
        $this->form_validation->set_rules($this->config->item('contest_participants', 'validation_rules'));
        if ($this->form_validation->run() == FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
   
    public function get($limit="",$start="",$id="",$data_type="") {
        $contest_id = encrypt_decrypt('decrypt',$this->input->get('id'));
        $this->db->select('cp.*');
        if($id!=""){ 
            if(!empty($limit)){
                $this->db->limit($limit, $start);
            }
        }    
        $this->db->where('cp.contest_id',$contest_id);
        if($data_type == "archive"){
             $query = $this->db->get($this->table_name1. " cp");
        }else{
             $query = $this->db->get($this->table_name. " cp");
        }    
        if($id!="")
            return $query->row_array();
        else
           return $query->result_array();     
    }

    public function get_version($limit="",$start="",$id="",$type=""){
        $contest_id = encrypt_decrypt('decrypt',$this->input->get('id'));
        
        if($type == "version_list"){
            $this->db->select('*');
            $this->db->order_by('cp.version','DESC');
            $this->db->group_by('cp.version');
        }   
        if($type == "list"){
            $this->db->select('first_name,last_name,mobile_number,points,remark');
            $version_id = $this->input->get('version');
            $this->db->where('cp.version',$version_id);
        }
        if($id!=""){ 
            if(!empty($limit)){
                $this->db->limit($limit, $start);
            }
        }    
        $this->db->where('cp.contest_id',$contest_id);
        $query = $this->db->get($this->table_name1. " cp"); 
        if($id!="")
            return $query->row_array();
        else
           return $query->result_array();   
    }

    public function get_count($type="") {
        $contest_id = encrypt_decrypt('decrypt',$this->input->get('id'));
        $this->db->where('contest_id',$contest_id);
        if($type == "archive"){
            $this->db->group_by('contest_id,version');
            $query = $this->db->get($this->table_name1);
        }else{
             $query = $this->db->get($this->table_name);
        }
        return $query->num_rows();
    }

    public function update(){
        $postData = $this->input->post();
        $this->db->where('id',$postData['id']);  
        $result = $this->db->update($this->table_name,$postData['company']);
        if($result)
            return true;
        else
            return false;
    }

    public function delete(){
        $id = $this->input->get('id');
        $this->db->where('id',$id);  
        $result = $this->db->update($this->table_name,array('is_deleted'=>1));
        if($result)
            return true;
        else
            return false;
    }
}
