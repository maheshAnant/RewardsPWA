<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {
    public function check_email(){
   	    $ci = & get_instance();
        $postData = $ci->input->post();
        $email_id = strtolower($postData['user']['email']);
        $ci->db->select('id');
        $ci->db->where('u.email', $email_id);
         if(!empty($postData['id'])){
            $ci->db->where('id!='.$postData['id']);
        }
        $ci->db->from('users u');
        $query = $ci->db->get();

        if ($query->num_rows() > 0) {
            $ci->form_validation->set_message('check_email', 'Email id already exists!');
            return false;
        } else {
            return true;
        }
    }
    public function checkName($str) {
        $ci = & get_instance();
        if (!preg_match("/^[a-zA-Z’'. ]+$/", $str)) {
            $ci->form_validation->set_message('checkName', 'Please provide valid name');
            return FALSE;
        } else {
            return TRUE;
        }
    }  

    public function is_contest_name_exist(){
        $ci = & get_instance();
        $postData = $ci->input->post();
        $contest_name = $postData['contest']['name'];
        $ci->db->select('id');
        $ci->db->where('name', $contest_name);
        if(!empty($postData['id'])){
            $ci->db->where('id!='.$postData['id']);
        }
        $ci->db->from('contest c');
        $query = $ci->db->get();
        if ($query->num_rows() > 0) {
            $ci->form_validation->set_message('is_contest_name_exist', 'Contest already exists!');
            return false;
        } else {
            return true;
        }
    }
    function contest_end_date(){
        $ci = & get_instance();
        $postData = $ci->input->post('contest');
        $start_date = $postData['start_date'];
        $end_date = $postData['end_date']; 
        if ($start_date>$end_date ) {
            $ci->form_validation->set_message('contest_end_date', 'Contest End date should be greater then start date!');
            return false;
        } else {
            return true;
        }
    }   

    function redemption_end_date(){
        $ci = & get_instance();
        $postData = $ci->input->post('contest');
        $start_date = $postData['start_date'];
        $end_date = $postData['end_date'];
        $redem_end_date = $postData['redem_end_date']; 
        if ($start_date > $redem_end_date) {
            $ci->form_validation->set_message('redemption_end_date', 'Redemption End date should be greater then start date and less then end date!');
            return false;
        } else {
            return true;
        }
    }
}
