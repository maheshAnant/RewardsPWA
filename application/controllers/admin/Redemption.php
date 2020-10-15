<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redemption extends CI_Controller {
	public function index()
	{
		$data = array();
		$this->view->render('contest/view', $data);
	}
}
