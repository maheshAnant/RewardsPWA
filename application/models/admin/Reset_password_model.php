<?php

class Reset_password_model extends CI_Model {
    private $table_name = 'users';
    function __construct() {
        parent::__construct();
    }

    function validateData() {
        $arr = $this->config->item('reset_password', 'validation_rules');
        $this->form_validation->set_rules($this->config->item('reset_password', 'validation_rules'));
        if ($this->form_validation->run() == FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function update() {
        $postData = $this->input->post();
        $updateData['password'] = md5($postData['password']);
        $updateData['updated_at'] = date('Y-m-d H:i:s'); 
        $this->db->where('id',$postData['id']);
        $result = $this->db->update($this->table_name, $updateData);
        if($result)
            return true;
        else
            return false;
    }

    public function get() {
        $id = encrypt_decrypt('decrypt',$this->input->get('id'));
        if($id=="")
            $id = $this->input->post('id');
        $this->db->where('id',$id);
        $query = $this->db->get($this->table_name);
        return $query->row_array();  
    }

}
