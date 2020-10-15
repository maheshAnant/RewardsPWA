<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class View{
  public $current_site = "";
  public function __construct() {
    $this->ci = & get_instance();
    $this->current_site = $_SERVER['REQUEST_URI'];
  }

  public function render($view, $data = array()){
    $this->loadHeader($data);
    $this->loadContentView($view);
    $this->loadFooter();
  }

  private function loadHeader($data){
    $this->ci->load->view($this->check_login_type_view('common/header'),$data);  
  }
  private function loadNavigation(){
    $this->ci->load->view($this->check_login_type_view('common/navigation'));          
  }

  private function loadContentView($view){
    $this->loadNavigation();
    $this->ci->load->view($this->check_login_type_view($view));
  }
  
  private function loadFooter(){
    $this->ci->load->view($this->check_login_type_view('common/footer'));    
  }

  public function check_login_type_view($view){
    //if(get_login_user_role() != "Participant")
        return "admin/".$view;
    return $view;
  }
}
