<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    private $per_page_records = PER_PAGE_RECORDS;
	public function __construct() {
        parent::__construct();
        userLoginAuthorization();
        $this->load->model(array('admin/user_model','admin/company_model'));
        $this->load->library('pagination');
        $this->load->config('validation_rules', TRUE);
    }
	public function index(){
        $config["base_url"] = base_url() . "user";
        $config["total_rows"] = $this->user_model->get_count();
        $config["per_page"] = $this->per_page_records;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['result'] = $this->user_model->get($config["per_page"], $page);
        $config["uri_segment"] = 2;  
		$this->view->render('user/view', $data);
	}

	public function add(){
        $data['companies'] = $this->company_model->get();
		$this->view->render('user/add', $data);
	}
	public function edit(){
        $id = encrypt_decrypt('decrypt',$this->input->get('id'));
        $data = $this->user_model->get("","",$id);
        $data['companies'] = $this->company_model->get();
		$this->view->render('user/edit', $data);
	}
    
    public function store(){
      	$postData = $this->input->post();
      	$this->form_validation->set_data($postData);
        $validation_result = $this->user_model->validateData('userAdd');
        if ($validation_result == FALSE) {
            $response_data['companies'] = $this->company_model->get();
            $response_data['status'] = 'failure';
            $response_data['data'] = '';
            $response_data['error'] = array(
                'first_name' => strip_tags(form_error('user[first_name]')),
                'last_name' => strip_tags(form_error('user[last_name]')),
                'username' => strip_tags(form_error('user[username]')),
                'email' => strip_tags(form_error('ka_user[email]'))
            );
            $this->view->render('user/add', $response_data);
        } else {           
            if(isset($_FILES['profile_pic'])){         
                uploadPic("profile_pic","profile");
                $_POST['user']['profile_pic'] = $_FILES['profile_pic']['name'];
            }           
            $responce = $this->user_model->store();
            $this->session->set_flashdata('msg', 'User Added Succefully');
            redirect('admin/user');     
        }    				
    }

	public function delete(){
		$data = array();
		$responce = $this->user_model->delete();
        $this->session->set_flashdata('msg', 'Record Deleted Succefully');
        redirect('user');
	}

	public function update(){
		$postData = $this->input->post(); 
        if(empty($postData))
            redirect('user');
        $this->form_validation->set_data($postData);
        $validation_result = $this->user_model->validateData("userEdit");
        if ($validation_result == FALSE) {
            $response_data = $this->user_model->get("","",$postData['id']);
            $response_data['companies'] = $this->company_model->get();
            $response_data['status'] = 'failure';
            $response_data['data'] = '';
            $response_data['error'] = array(
                'first_name' => strip_tags(form_error('user[first_name]')),
                'last_name' => strip_tags(form_error('user[last_name]')),
                'username' => strip_tags(form_error('user[username]')),
                'email' => strip_tags(form_error('ka_user[email]'))
            );
            $this->view->render('user/edit', $response_data);
        } else {
            if(isset($_FILES['profile_pic']) && !empty(($_FILES['profile_pic']['name']))){
                uploadPic("profile_pic","profile");
                $_POST['user']['profile_pic'] = $_FILES['profile_pic']['name'];
            }  
            $responce = $this->user_model->update();
            $this->session->set_flashdata('msg', 'User Updated Succefully');
            redirect('admin/user');
        }
	}

}
