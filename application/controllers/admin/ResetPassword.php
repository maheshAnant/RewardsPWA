<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ResetPassword extends CI_Controller {
    private $per_page_records = PER_PAGE_RECORDS;
	public function __construct() { 
        parent::__construct();
        userLoginAuthorization();
        $this->load->model(array('admin/reset_password_model'));
        $this->load->config('validation_rules', TRUE);
    }
	public function index(){
        $data = $this->reset_password_model->get();
        $this->view->render('resetPassword/reset', $data);
	}

	public function update(){
		$postData = $this->input->post(); 
        if(empty($postData))
            redirect('admin/user');
        $this->form_validation->set_data($postData);
        $validation_result = $this->reset_password_model->validateData();
        if ($validation_result == FALSE) {
            $response_data = $this->reset_password_model->get();
            $response_data['status'] = "failure";
            $this->view->render('resetPassword/reset', $response_data);
        } else {
            $responce = $this->reset_password_model->update();
            $this->session->set_flashdata('msg', 'Password Updated Succefully');
            redirect('admin/user');
        }
	}

}
