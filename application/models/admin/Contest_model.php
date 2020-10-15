<?php

class Contest_model extends CI_Model {
    private $table_name = 'contest';
    function __construct() {
        parent::__construct();
    }

    function validateData() {
        $arr = $this->config->item('contest', 'validation_rules');
        $this->form_validation->set_rules($this->config->item('contest', 'validation_rules'));
        if ($this->form_validation->run() == FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function store() {
        $postData = $this->input->post('contest');
        $postData['created_at'] = date('Y-m-d H:i:s');
        $postData['updated_at'] = date('Y-m-d H:i:s');
        $postData['contest_year'] = date('Y');
        $result = $this->db->insert($this->table_name, $postData);
        if($result)
            return true;
        else
            return false;
    }

    public function get($limit="",$start="",$id="") {
        $this->db->order_by('id','desc');
        if($id!=""){
            $this->db->where('id',$id);
        }
        else{
            $this->db->where('is_deleted','0');
            if($limit!="")
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
        $result = $this->db->update($this->table_name,$postData['contest']);
        if($result)
            return true;
        else
            return false;
    }

    public function delete(){
        $id = encrypt_decrypt('decrypt',$this->input->get('id'));
        $this->db->where('id',$id);  
        $result = $this->db->update($this->table_name,array('is_deleted'=>'1'));
        if($result)
            return true;
        else
            return false;
    }
}
