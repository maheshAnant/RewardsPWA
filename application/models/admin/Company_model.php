<?php

class Company_model extends CI_Model {
    private $table_name = 'company';
    function __construct() {
        parent::__construct();
    }

    function validateData() {
        $arr = $this->config->item('company', 'validation_rules');
        $this->form_validation->set_rules($this->config->item('company', 'validation_rules'));
        if ($this->form_validation->run() == FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function store() {
        $postData = $this->input->post('company');
        $postData['created_at'] = date('Y-m-d H:i:s');
        $postData['updated_at'] = date('Y-m-d H:i:s');
        $result = $this->db->insert($this->table_name, $postData);
        if($result)
            return true;
        else
            return false;
    }

    public function get($limit="",$start="",$id="") {
        $this->db->select('company.*,country.name as country_name');
        if($id!=""){
            $this->db->where('company.id',$id);
        }
        else{
            $this->db->where('is_deleted','0');
            if(!empty($limit)){
                $this->db->limit($limit, $start);
            }
        }  
        $this->db->join('country','company.country_id = country.id','inner');  
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
        $result = $this->db->update($this->table_name,$postData['company']);
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

    public function getCountry(){
        $this->db->select('*');
        $this->db->from('country');
        $result = $this->db->get()->result_array();
        return $result;
    }
}
