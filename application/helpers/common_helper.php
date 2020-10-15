<?php 

function all_navigation_links(){
   $links = array(  "company"=>array("action"=>"company",
                                 "title"=>"Companies",
                                 "icon"=>"mdi-home",
                              ),
                     "user"=>array("action"=>"user",
                                 "title"=>"Users",
                                 "icon"=>"mdi-account",
                              ),
                     "voucher"=>array("action"=>"voucher",
                                 "title"=>"Vouchers",
                                 "icon"=>"mdi-popcorn",
                              ),
                     "contest"=>array("action"=>"contest",
                                 "title"=>"Contests",
                                 "icon"=>"mdi-wallet",
                              ),
                     "redemption"=>array("action"=>"redemption",
                                 "title"=>"Redemtion Ratio Criteria",
                                 "icon"=>"mdi-wallet",
                              ),

            );
   return $links;
}
function navigation_links(){
   $ci = &get_instance();
   $admin_flag = $ci->session->userdata('is_admin');
   $all_links = all_navigation_links();
   switch ($admin_flag) {
   case '0':
      $nivigation_arr = array(                         
                           $all_links['user'], 
                           $all_links['company'],
                           $all_links['voucher']
                        );
      break;
   
   case '1':
      $nivigation_arr = array(                         
                           $all_links['user'], 
                           $all_links['contest']/*,
                           $all_links['redemption']*/
                        );
     break;

   case '2':
     # code...
     break;  
   default:
     # code...
     break;
   }
   return $nivigation_arr;
}

function get_active_links($module=""){
	$ci = &get_instance();
  if($module == "contest" && $ci->uri->segment(1) == "participant")
    return "active";
	if($ci->uri->segment(1) == $module)
		return "active";
	else
		return "";

}

function userLoginAuthorization(){
	$ci = &get_instance();
	if(!empty($ci->session->userdata('email')) && ($ci->session->userdata('is_admin') ==0 || $ci->session->userdata('is_admin') ==1) ){
		return true;
	}else{
		redirect(ADMIN_PATH.'login');
	}
}

function uploadImage($file_name,$folder){
	  $ci = &get_instance();
	  createFolderbyname($folder);
	  $config['upload_path']          = "./uploads/admin/".$folder;
    $config['allowed_types']        = 'gif|jpg|png';
    $config['max_size']             = 0;
    $ci->load->library('upload', $config);
    $ci->upload->initialize($config);
    if ( ! $ci->upload->do_upload($file_name)){
        $error = array('error' => $ci->upload->display_errors());
        return false;
    }else{
        $data = array('upload_data' => $ci->upload->data());
        return true;
    }
}

function renameUploadFile($data) {
    $search = array("'", "  ", " ", "(", ")", "&", "-", "\"", "\\", "?", ":", "/");
    $replace = array("", "_", "_", "", "", "", "", "", "", "", "", "", "");
    $new_data = str_replace($search, $replace, $data);
    return strtolower($new_data);
}


 function createFolderbyname($folderName) {
    $targetPath = dirname(dirname(dirname(__FILE__))) . "/uploads/admin/" . $folderName . "/";
    if (!is_dir($targetPath)) {
        mkdir($targetPath, 0777, true);
    }
}

function checkImage($type,$image=""){
   // $image = "";
   $src = ADMIN_ASSETS_PATH."images/default_pic.png";  
   switch ($type) {
     case 'profile':
         if($image!="")
             $src = ADMIN_UPLOAD_IMAGES.'profile/'.$image;         
     break;
         case 'icon_img':
         if($image!="")
             $src = ADMIN_UPLOAD_IMAGES.'icons/'.$image;
         
     
     default:
         # code...
         break;
   }
   return $src;
}

function uploadPic($name,$folder){
   $ci = &get_instance();
   if(isset($_FILES[$name])){
      $image_type_arr = array('image/jpeg','image/jpg','image/png');
      if(!in_array($_FILES[$name]['type'], $image_type_arr)){
          $response_data['status'] = 'failure';
          $response_data['data'] = '';
          $response_data['error'] = array($name=>"Please enter valid file format!");
          $ci->view->render('user/add', $response_data);   
      }else{

          $_FILES[$name]['name'] = date("YmdHis") . "_" . renameUploadFile($_FILES[$name]['name']);
          $uploadData = uploadImage($name,$folder);    
      }
   }
 }

if (!function_exists('encrypt_decrypt')) {
   function encrypt_decrypt($action, $string) {
      $output = false;
      $encrypt_method = "AES-256-CBC";
      $secret_key = '900150983cd2tic@tc@mstic4fb0d6963f7d28e17f72$'; //900150983cd24fb0d6963f7d28e17f72(example key)
      $secret_iv = '900150983cd2@tic4fb0d6963f7d2tic@#$88####'; //098f6bcd4621d373cade4e832627b4f6(example iv)
      // hash
      $key = hash('sha256', $secret_key);
      // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
      $iv = substr(hash('sha256', $secret_iv), 0, 16);
      if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
      } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
      }
      return $output;
    }
}

function redirect_back() {
    if(isset($_SERVER['HTTP_REFERER'])) {
      $url=$_SERVER['HTTP_REFERER'];  
    }
    else {
      $url=base_url();
    }
    redirect($url);
}

function authenticatePage($type){
      
}

function checkUserListFlagByLogin(){
   $ci = &get_instance();
   $admin_flag = $ci->session->userdata('is_admin');
   if($admin_flag == "0")
      return '1';
   else if($admin_flag == '1')
      return '2';
} 

function is_company_user(){
   $ci = &get_instance();
   $admin_flag = $ci->session->userdata('is_admin');
   if($admin_flag == "1")
      return true;
   return false;
}

function is_admin_user(){
   $ci = &get_instance();
   $admin_flag = $ci->session->userdata('is_admin');
   if($admin_flag == "0")
      return true;
   return false;
}

function get_login_name(){
   $ci = &get_instance();
   return ucfirst($ci->session->userdata('first_name'))." ".ucfirst($ci->session->userdata('last_name'));
}

function get_login_user_role(){
   $ci = &get_instance();
   $admin_flag = '2';   
   if(!empty($ci->session->userdata('is_admin')))
      $admin_flag = $ci->session->userdata('is_admin');
   if($admin_flag == "0")
      return "Admin";
   if($admin_flag == "1")
      return "Company User";
   return  "Participant";
}

function contest_status($status){
   $status_arr = array( "0" =>"Not Started",
                        "1" =>"Started",
                        "2" =>"Completed");
   return $status_arr[$status];
}

function check_participant_error_log($rows){
  if($rows>0)
    return true;
  return false;
}

function view_date_format($date){
    if($date == "0000-00-00 00:00:00")
      return "-";
    return date('d M, Y',strtotime($date));
}