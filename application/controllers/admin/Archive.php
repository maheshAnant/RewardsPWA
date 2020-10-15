<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Archive extends CI_Controller {
    private $per_page_records = PER_PAGE_RECORDS;
	public function __construct() {
        parent::__construct();
        userLoginAuthorization();
        $this->load->model(array('admin/archive_model','admin/contest_model'));
        $this->load->library(array('pagination','excel_lib'));
        $this->load->config('validation_rules', TRUE);
    }
	public function index(){
		$data = array();
        $config["base_url"] = base_url() . "contest";
        $config["total_rows"] = $this->archive_model->get_count("archive");
        $config["per_page"] = $this->per_page_records;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['result'] = $this->archive_model->get_version($config["per_page"], $page,"","version_list");
        $data['company_id'] = $this->session->userdata("company_id");
        $config["uri_segment"] = 2;  
        $contest_id = encrypt_decrypt('decrypt',$this->input->get('id'));
        $data["contest_details"] = $this->contest_model->get("","",$contest_id);
        $this->view->render('archive/view', $data);
	}
    
    public function download(){
        $export_header_array    =  array("First Name",
                                                "Last Name",
                                                "Mobile Number",
                                                "Points",
                                                "Remark");
       /* $export_header_array [] = "Status";*/
        $version_id = $this->input->get('version');
        $file_name = "Version_".$version_id."-0-0.xlsx";
        $excel_data = $this->archive_model->get_version("","","","list");    
        $this->excel_lib->export($excel_data , $export_header_array, $file_name);
    }

    public function details(){
        $data = array();
        $config["base_url"] = base_url() . "contest";
        $config["total_rows"] = $this->archive_model->get_count("list");
        $config["per_page"] = $this->per_page_records;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['result'] = $this->archive_model->get_version($config["per_page"], $page,"","list");
        $data['company_id'] = $this->session->userdata("company_id");
        $config["uri_segment"] = 2;  
        $contest_id = encrypt_decrypt('decrypt',$this->input->get('id'));
        $data["contest_details"] = $this->contest_model->get("","",$contest_id);
        $this->view->render('tiles/participants', $data);
    }

}
