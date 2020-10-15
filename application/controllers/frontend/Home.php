<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    private $per_page_records = PER_PAGE_RECORDS;
	public function __construct() {
        parent::__construct();
    }
	public function index(){
        $this->load->view('frontend/home/index', $data);
	}
}
