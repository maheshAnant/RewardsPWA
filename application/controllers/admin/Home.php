<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
        parent::__construct();
        userLoginAuthorization();
        $this->load->model(array('admin/company_model',
        						 'admin/user_model'));
    }

	public function index(){
		$data = array();
		$data['total_companies']	= $this->company_model->get_count();
		$data['total_users']		= $this->user_model->get_count();
		$data['total_contest']		= 0;
		$this->view->render('index', $data);
	}
}
