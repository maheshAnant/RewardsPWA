<?php

class User_model extends CI_Model {
    private $table_name = 'users';
    private $table_name2 = 'company';
    function __construct() {
        parent::__construct();
    }

    function validateData($page_type) {
        $arr = $this->config->item($page_type, 'validation_rules');
        //$this->form_validation->set_message('checkName', 'Please provide valid name');
        $this->form_validation->set_rules($this->config->item($page_type, 'validation_rules'));
        if ($this->form_validation->run() == FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function store() {
        $postData = $this->input->post('user');
        $postData['password'] = md5($postData['password']);
        $postData['created_at'] = date('Y-m-d H:i:s');
        $postData['updated_at'] = date('Y-m-d H:i:s');
        if(is_company_user())
            $postData['company_id'] = $this->session->userdata('company_id');

        $postData['is_admin'] = checkUserListFlagByLogin();
        $result = $this->db->insert($this->table_name, $postData);
        if($result)
            return true;
        else
            return false;
    }

    public function get($limit,$start,$id="") {
        $this->db->select('u.*,cmp.name as company_name');
        $this->db->from($this->table_name." u");
        $this->db->join($this->table_name2." cmp",'cmp.id =u.company_id', 'Inner');
        if($id!="")
            $this->db->where('u.id',$id);
        else    
            $this->db->limit($limit, $start);
        $this->db->order_by('u.id','desc');
        $getParam = $this->input->get();
        if(!empty($getParam)){
            if(isset($getParam['name']) && !empty($getParam['name'])){
                $this->db->where('u.first_name like "%'.$getParam['name'].'%" OR u.last_name like "%'.$getParam['name'].'%"');  
            }
            if(isset($getParam['email']) && !empty($getParam['email'])){
                $this->db->where('u.email',$getParam['email']);  
            }
           if(isset($getParam['company_name']) && !empty($getParam['company_name'])){
                $this->db->where('cmp.name',$getParam['company_name']);  
            }      
        }
        $this->db->where('u.is_deleted','0');  
        $this->db->where('u.is_admin',checkUserListFlagByLogin());  
        $query = $this->db->get();
        if($id!="")
            return $query->row_array();
        else
           return $query->result_array();     
    }

    public function get_count() {
        $this->db->where('is_deleted','0');  
        $this->db->where('is_admin',checkUserListFlagByLogin());  
        return $this->db->get($this->table_name)->num_rows();
    }

    public function update(){
        $postData = $this->input->post();
        $this->db->where('id',$postData['id']);  
        if(is_company_user())
            $postData['user']['company_id'] = $this->session->userdata('company_id');
        $result = $this->db->update($this->table_name,$postData['user']);
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
