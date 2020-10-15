<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher extends CI_Controller {
    private $per_page_records = PER_PAGE_RECORDS;
	public function __construct() {
        parent::__construct();
        userLoginAuthorization();
        $this->load->model(array('admin/voucher_model','admin/company_model'));
        $this->load->library('pagination');
        $this->load->config('validation_rules', TRUE);
    }
	public function index(){
		$data = array();
        $config["base_url"] = base_url() . "voucher";
        $config["total_rows"] = $this->voucher_model->get_count();
        $config["per_page"] = $this->per_page_records;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['result'] = $this->voucher_model->get($config["per_page"], $page);
        $config["uri_segment"] = 2;  
		$this->view->render('voucher/view', $data);
	}

	public function add(){
		$data = array();
		$data['company'] = $this->company_model->get();
		$this->view->render('voucher/add', $data);
	}
	public function edit(){
        $id = $this->input->get('id');
        $data = $this->voucher_model->get("","",$id);
        $data['companies'] = explode(',', $data['company_id']);
		$data['company'] = $this->company_model->get();

		$this->view->render('voucher/edit', $data);
	}
    
    public function store(){
      	$postData = $this->input->post();
      	$this->form_validation->set_data($postData);
        $validation_result = $this->voucher_model->validateData();
        if ($validation_result == FALSE) {
            $response_data['status'] = 'failure';
            $response_data['data'] = '';
            $response_data['error'] = array(
                'first_name' => strip_tags(form_error('user[first_name]')),
                'last_name' => strip_tags(form_error('user[last_name]')),
                'username' => strip_tags(form_error('user[username]')),
                'email' => strip_tags(form_error('ka_user[email]'))
            );
            $response_data['company'] = $this->company_model->get();
            $this->view->render('voucher/add', $response_data);
        } else {
            $responce = $this->voucher_model->store();
            $this->session->set_flashdata('msg', 'voucher Added Succefully');
            redirect('admin/voucher');
        }    				
    }

	public function delete(){
		$data = array();
		$responce = $this->voucher_model->delete();
        $this->session->set_flashdata('msg', 'Record Deleted Succefully');
        redirect('admin/voucher');
	}

	public function update(){
		$postData = $this->input->post();
        $this->form_validation->set_data($postData);
        $validation_result = $this->voucher_model->validateData();
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
            $response_data = $this->voucher_model->get("","",$postData['id']);
            $response_data['company'] = $this->company_model->get();
            $this->view->render('voucher/edit', $response_data);
        } else {
            $responce = $this->voucher_model->update();
            $this->session->set_flashdata('msg', 'Company Updated Succefully');
            redirect('admin/voucher');
        }
	}

}
