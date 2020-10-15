<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Participant extends CI_Controller {
    private $per_page_records = PER_PAGE_RECORDS;
	public function __construct() {
        parent::__construct();
        userLoginAuthorization();
        $this->load->model(array('admin/participant_model','admin/contest_model'));
        $this->load->library(array('pagination','excel_lib'));
        $this->load->config('validation_rules', TRUE);
    }
	public function index(){
		$data = array();
        $config["base_url"] = base_url() . "contest";
        $config["total_rows"] = $this->participant_model->get_count();
        $config["per_page"] = $this->per_page_records;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['result'] = $this->participant_model->get($config["per_page"], $page);
        $data['company_id'] = $this->session->userdata("company_id");
        $contest_id = encrypt_decrypt('decrypt',$this->input->get('id'));
        $data["contest_details"] = $this->contest_model->get("","",$contest_id);
        $config["uri_segment"] = 2;  
		$this->view->render('tiles/participants', $data);
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

	public function upload(){
        $post_data = $this->input->post();
        $result = $this->excel_lib->import('', $_FILES['upload_participants']);
        if ($result['status'] == "success") {
            $excel_data = $result['result'];
            unset($excel_data[0]);
            $company_id =  $post_data['company_id'];
            $contest_id =  $post_data['contest_id'];
            $excel_data = array_map(function($arr) use ($contest_id){
                return $arr + ['contest_id' => $contest_id];
            }, $excel_data);
            $excel_data = array_map(function($arr) use ($company_id){
                return $arr + ['company_id' => $company_id];
            }, $excel_data);
            $this->participant_model->store($excel_data);
            $this->session->set_flashdata('msg', 'Participant Uploaded succefully..');
        } else {
           $this->session->set_flashdata('msg', 'Please Provide Excel');    
        } 
        redirect('admin/contest');   
    }

    public function download() {
        $data['main_title'] = 'Download Template';
        $data['page_title'] = 'Download Template';
        $data['head_title'] = 'Download Template';  
        $export_header_array    =  array("First Name",
                                                "Last Name",
                                                "Mobile Number",
                                                "Points",
                                                "Remark");
       /* $export_header_array [] = "Status";*/
        $file_name = "UploadFormat.xlsx";
        $excel_data = array();
        $this->excel_lib->export($excel_data , $export_header_array, $file_name);
  
    }

    public function error_log(){
        $export_header_array    =  array("First Name",
                                                "Last Name",
                                                "Mobile Number",
                                                "Points",
                                                "Remark",
                                                "Erorr Remark");
       /* $export_header_array [] = "Status";*/
        $file_name = "Error.xlsx";
        
        $excel_data = $this->participant_model->get_error_log();    
        $this->excel_lib->export($excel_data , $export_header_array, $file_name);
    }

    public function archive(){
        $data = array();
        $config["base_url"] = base_url() . "contest";
        $config["total_rows"] = $this->participant_model->get_count("archive");
        $config["per_page"] = $this->per_page_records;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['result'] = $this->participant_model->get_version($config["per_page"], $page,"","version_list");
        $data['company_id'] = $this->session->userdata("company_id");
        $config["uri_segment"] = 2;  
        $contest_id = encrypt_decrypt('decrypt',$this->input->get('id'));
        $data["contest_details"] = $this->contest_model->get("","",$contest_id);
        $this->view->render('participant/archive', $data);
    }

    public function version(){
        $export_header_array    =  array("First Name",
                                                "Last Name",
                                                "Mobile Number",
                                                "Points",
                                                "Remark");
       /* $export_header_array [] = "Status";*/
        $version_id = $this->input->get('version');
        $file_name = "Version_".$version_id."-0-0.xlsx";
        $excel_data = $this->participant_model->get_version("","","","list");    
        $this->excel_lib->export($excel_data , $export_header_array, $file_name);
    }

}
