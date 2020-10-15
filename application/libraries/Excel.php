<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";
class Excel extends PHPExcel {  

    public function __construct() 
    {
        $this->ci = & get_instance();
        $this->current_site = $_SERVER['REQUEST_URI'];
    }
    public function load($path) {
		$FileType = PHPExcel_IOFactory::identify($path);
		$objReader = PHPExcel_IOFactory::createReader($FileType);
        $this->excel = $objReader->load($path);
    }

}
