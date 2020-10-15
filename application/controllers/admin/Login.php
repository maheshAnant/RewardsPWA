<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	public function __construct()
    {
        parent::__construct(); 
        $this->load->model('admin/login_model');
    }    

	public function index()
	{
		$data = array();
		$this->load->view('admin/login/login', $data);
	}

	public function chklogin(){
    	$data = array();
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
		if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('admin/login/login');
        }
        else
        {
            $post_data = $this->input->post();
            $login_details = $this->login_model->getLoginDetails($post_data);
            if(!empty($login_details) && $login_details['error'] == 0){

            	$this->setSessionData($login_details['data']);
            	redirect(ADMIN_PATH.'home');
            }else{
            	$data['error'] = $login_details['error'];
            	$data['errormsg'] = $login_details['message'];
            	$this->load->view('admin/login/login',$data);
            }
        }
	}

	public function setSessionData($userdetails){
		$this->session->set_userdata('userId', $userdetails['id']);
		$this->session->set_userdata('first_name', $userdetails['first_name']);
		$this->session->set_userdata('last_name', $userdetails['last_name']);
		$this->session->set_userdata('mobile', $userdetails['mobile']);
		$this->session->set_userdata('email', $userdetails['email']);
		$this->session->set_userdata('company_id', $userdetails['company_id']);
		$this->session->set_userdata('profile_pic', $userdetails['profile_pic']);
		$this->session->set_userdata('is_admin', $userdetails['is_admin']);
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(ADMIN_PATH.'login');
	}
}
