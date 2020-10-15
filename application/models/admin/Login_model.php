<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
	function __construct()
    {
        parent::__construct();
        $this->users_table 		= 'users';
    }

    public function getLoginDetails($userdata){
    	$userExist = $this->isUserExist($userdata['email']);
    	if(!empty($userExist)){
    		if($userExist['is_deleted'] == 0){
    			$validUser = $this->isValidUser($userdata);
    			if(!empty($validUser)){
    				$response = ['error' => 0, 'message' => '', 'data'=>$validUser];
    			}else{
    				$response = ['error' => 1, 'message' => 'Sorry, user credentials are wrong.'];
    			}
    		}else{
    			$response = ['error' => 1, 'message' => 'Sorry, you are not active user.'];
    		}
    	}else{
    		$response = ['error' => 1, 'message' => 'Sorry, you are not registered user.'];
    	}
    	return $response;
    }

    public function isUserExist($email){
    	$this->db->select('*');
    	$this->db->from($this->users_table);
    	$this->db->where('email',$email);
    	$userdata = $this->db->get()->row_array();
    	return $userdata;
    }

    public function isValidUser($userdata){
    	$this->db->select('*');
    	$this->db->from($this->users_table);
    	$this->db->where('email',$userdata['email']);
    	$this->db->where('password',md5($userdata['password']));
    	$this->db->where('is_deleted','0');
    	$validDetails = $this->db->get()->row_array();
    	return $validDetails;
    }
}