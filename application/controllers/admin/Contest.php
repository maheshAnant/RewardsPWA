<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contest extends CI_Controller {
    private $per_page_records = PER_PAGE_RECORDS;
	public function __construct() {
        parent::__construct();
        userLoginAuthorization();
        $this->load->model(array('admin/contest_model','admin/participant_model'));
        $this->load->library('pagination');
        $this->load->config('validation_rules', TRUE);
    }
	public function index(){
		$data = array();
        $config["base_url"] = base_url() . "contest";
        $config["total_rows"] = $this->contest_model->get_count();
        $config["per_page"] = $this->per_page_records;
        $config["uri_segment"] = 2; 
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['result'] = $this->contest_model->get($config["per_page"], $page);
        $data['company_id'] = $this->session->userdata("company_id");
        $data['error_log'] =$this->participant_model->error_log_count();
		$this->view->render('contest/view', $data);
	}

	public function add(){
		$data = array();
		$this->view->render('contest/add', $data);
	}
	public function edit(){
        $id = encrypt_decrypt('decrypt',$this->input->get('id'));
        $data = $this->contest_model->get("","",$id);
		$this->view->render('contest/edit', $data);
	}
    
    public function store(){
      	$postData = $this->input->post();
      	$this->form_validation->set_data($postData);
        $validation_result = $this->contest_model->validateData();
        if ($validation_result == FALSE) {
            $response_data['status'] = 'failure';
            $this->view->render('contest/add', $response_data);
        } else {
            
           if(isset($_FILES['icon_img']) && !empty(($_FILES['icon_img']['name']))){
                uploadPic("icon_img","icons");
                $_POST['contest']['icon'] = $_FILES['icon_img']['name'];
            }  
            $responce = $this->contest_model->store();
            $this->session->set_flashdata('msg', 'Contest Added Succefully');
            redirect('admin/contest');
        }    				
    }

	public function delete(){
		$data = array();
		$responce = $this->contest_model->delete();
        $this->session->set_flashdata('msg', 'Record Deleted Succefully');
        redirect('admin/contest');
	}

	public function update(){
		$postData = $this->input->post();
        $this->form_validation->set_data($postData);
        $validation_result = $this->contest_model->validateData();
        if ($validation_result == FALSE) {
            $response_data['status'] = 'failure';
            $response_data['data'] = '';
            $response_data['error'] = array(
                'first_name' => strip_tags(form_error('user[first_name]')),
                'last_name' => strip_tags(form_error('user[last_name]')),
                'username' => strip_tags(form_error('user[username]')),
                'email' => strip_tags(form_error('ka_user[email]'))
            );
            $response_data['id'] = $postData['id'];
            $response_data = $this->contest_model->get("","",$postData['id']);
            $this->view->render('contest/edit', $response_data);
        } else {
            if(isset($_FILES['icon_img']) && !empty(($_FILES['icon_img']['name']))){
                uploadPic("icon_img","icons");
                $_POST['contest']['icon'] = $_FILES['icon_img']['name'];
            }  
            $responce = $this->contest_model->update();
            $this->session->set_flashdata('msg', 'Contest Updated Succefully');
            redirect('admin/contest');
        }
	}

    public function upload(){
        echo "hererer";die;
    }

    public function participant(){
        $contest_id = encrypt_decrypt('decrypt',$this->input->get('id'));
        $this->view->render('contest/participant', $data);
    }

}
