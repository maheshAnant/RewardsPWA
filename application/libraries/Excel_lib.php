<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Excel_lib {
	public function __construct() {
	    $this->ci = & get_instance();
	    $this->current_site = $_SERVER['REQUEST_URI'];
      $this->ci->load->library('excel');
      $this->foreignkeys = array();
      $this->main_heading = false;
  	}
  public function import($table_name,$file_data,$heading_row="1"){
    if(empty($table_name)){
     // die('Please provide table name in parameter !');
      $data['result'] = $this->upload_excel_without_table($file_data,$heading_row);
      $data['status'] = 'success';
    }
    else{
    $columns = $this->get_table_columns($table_name);
    $difference = $this->match_columns($columns,$file_data,$heading_row);
    if(empty($difference)){
      $data['result'] = $this->upload_excel($table_name,$file_data,$heading_row);
      $data['status'] = 'success';
    }else{
      $data['difference'] = $this->remove_underscore($difference);
      $data['status'] = 'failure';
    }
  }
   return $data;
   // print_r($data);
    //exit();
  }

  private function get_table_columns($table_name){
    $result = $this->ci->db->list_fields($table_name);
    return $result;
  }

  private function match_columns($columns,$file_data,$heading_row){
    try {
      $sheetData = $this->get_sheetdata($file_data);
      $diff=array_diff($this->filter_excel_headings($sheetData[$heading_row]),$this->filter_database_columns($columns));
      $diff = $this->unset_params($diff);
      return array_unique($diff);
    } catch(Exception $e) {
      die($e->getMessage());
    }
  }

  private function filter_database_columns($array){
    
    $array = array_filter($array, 'strlen');  //removes null values but leaves "0"
    $array = array_filter($array);
    $strtolower = array_map('strtolower',$array);
    $strtolower = array_map('trim',$strtolower);
    return array_map(function($strtolower){
      if (strpos($strtolower, '_id') !== false) {
          if(!in_array($strtolower, $this->foreignkeys)){
            array_push($this->foreignkeys, $strtolower);
          }
        }
      //$strtolower = str_replace(' ', '_', $strtolower);
      return str_replace('_id', '', $strtolower);
      return $strtolower;
    },$strtolower);
  }

  private function filter_excel_headings($array){
    $array = array_filter($array, 'strlen');  //removes null values but leaves "0"
    $array = array_filter($array);
    $strtolower = array_map('strtolower',$array);
    $strtolower = array_map('trim',$strtolower);
    return array_map(function($strtolower){
      $strtolower = preg_replace('!\s+!', ' ', $strtolower);

      $speical_char_array = array('.',"(",")");
      $strtolower = str_replace($speical_char_array, '', $strtolower);
     
      $strtolower = str_replace(' ', '_', $strtolower);

      return str_replace('_id', '', $strtolower);
    },$strtolower);
  }

  private function unset_params($array){ 
    unset( $array[array_search( 'id', $array )] );
    unset( $array[array_search( 'encrypted', $array )] );
    unset( $array[array_search( 'updated_at', $array )] );
    unset( $array[array_search( 'created_at', $array )] );
    unset( $array[array_search( 'intendedwh', $array )] );
    unset( $array[array_search( 'karat', $array )] );
    unset( $array[array_search( 'total_stn_qty', $array )] );
    unset( $array[array_search( 'stone_rate/cts', $array )] );
    unset( $array[array_search( 'labour_chg_/_gram', $array )] );
    unset( $array[array_search( 'wastage_%', $array )] );
    return $array;
  }

  private function remove_underscore($array){
    $ucfirst = array_map('ucfirst',$array);
    $trim = array_map('trim',$ucfirst);
    return array_map(function($trim){
      return $trim = str_replace('_', ' ', $trim);
    },$trim);
  }

  private function get_sheetdata($file_data){
    $inputFile = $file_data['tmp_name'];
    $inputFileType = PHPExcel_IOFactory::identify($inputFile);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFile);
    $sheet = $objPHPExcel->getSheet(0); 
    $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
    return $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
    
  }
  private function upload_excel($table_name,$excel_file,$heading_row){
    $insert_array = array();
    $sheetData = $this->get_sheetdata($excel_file);
    $columns = $this->get_table_columns($table_name);
    $get_excel_columns = $this->filter_excel_headings($sheetData[$heading_row]);
    
    $get_database_columns = $this->unset_params($this->filter_database_columns($columns));
    foreach ($get_excel_columns as $key => $value) {
        if(in_array($value ,$get_database_columns)){
      $get_excel_columns[$key] = $value;
        }else{
          unset($get_excel_columns[$key]);
        }
    }


    $k=0;
    for ($i=$heading_row+1; $i <= count($sheetData); $i++) {
      foreach ($get_excel_columns as $column_key => $column_value) {
        if(in_array($column_value.'_id',$this->foreignkeys)){
          $column_value = $column_value.'_id';
        }

        $insert_array[$k][$column_value] = $sheetData[$i][$column_key];
      }
    $k++;
    
    }

    return $insert_array;
  }
  private function upload_excel_without_table($excel_file,$heading_row){

    $insert_array = array();
    $sheetData = $this->get_sheetdata($excel_file);
    $total_rows = count($sheetData);
    $sheetData = $this->trimArray($sheetData);
    $k=0;
    foreach ($sheetData as $column_key => $column_value) {
      if(isset($sheetData[$column_key]) && !empty($sheetData[$column_key])){
        $cname = $this->get_header_row($sheetData[$column_key],$column_key);
        if($cname==true){
          $header_row_no = $column_key;
          $insert_array= $this->filter_excel_headings($sheetData[$column_key]);
        }
        
      }
    }

    $insert_arr = $this->create_insert_arr($header_row_no,$sheetData,$total_rows,$insert_array);
    $k++;
    return $insert_arr;
  }
  public function create_insert_arr($header_row,$sheetData,$total_rows,$array)
  {
    $k=0;
    $total_rows += 1;
    for ($i=$header_row; $i < $total_rows; $i++) {
      if(isset($sheetData[$i]) && !empty($sheetData[$i]))
      {
        $cnt1=$header_row;
        foreach ($array as $column_key => $column_value) {
          if($cnt1>$header_row){
            if(!empty($sheetData[$i][$column_key]))
            $insert_array[$k][$column_value] = $sheetData[$i][$column_key];
          }
          $cnt1++;
        }
      }
      $k++;
    }
     return $insert_array;
  }
  public function get_header_row($sheetData,$rowno)
  {
    foreach ($sheetData as $column_key => $column_value) {
      if(isset($sheetData[$column_key]) && !empty($sheetData[$column_key])){
        if($sheetData[$column_key]=='Sr No'){
          return true;
        }
        
      }
    }
  }
  public function trimArray($excelData){
    $originalData = $excelData;     
    foreach($excelData as $key1=>$singleArray){
      foreach($singleArray as $key=>$dataArray){
        $dataArray = trim($dataArray);
        if(empty($dataArray) || is_null($dataArray) || $dataArray == "" || $dataArray == NULL || strlen($dataArray)== 0){
            unset($originalData[$key1][$key]);
        }
      }
      if(sizeOf($originalData[$key1]) == 0){
        unset($originalData[$key1]);
      }
    }
    return $originalData;
    }

  public function export($data,$headings,$filename,$main_heading=array(),$image=array(),$save=false){
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle("Products");
        if(!empty($main_heading)){
        $multiarr='0';
        $rowno='0'; 
        $c = count($main_heading);
        for ($k=0;$k<$c;$k++) {
              if(isset($main_heading[$k]) && is_array($main_heading[$k])) 
              {
                 $c1 = count($main_heading[$k]);
                for ($j=0;$j<$c1;$j++) {
                  if(is_array($main_heading[$j])) 
                    $multiarr='1';
                }
                
              }

          }
         if($multiarr=='1'){
           
            for ($i=0;$i<$c;$i++) {
              if(is_array($main_heading[$i])) 
                $this->create_header($objPHPExcel, 'A', $i+1,$headings,$data,$main_heading[$i]);
              }
              $this->create_header($objPHPExcel, 'A', $i+1,$headings,$data,'');
              $rowno=$c+2;

            } 
        else{  
           // echo "0"; die();
          $rowno=$j+3;
            $this->create_header($objPHPExcel, 'A', 1,$headings,$data,$main_heading);
            $this->create_header($objPHPExcel, 'A', 2,$headings,$data,'');
          }
        }

        if(empty($main_heading)){
          $this->create_header($objPHPExcel, 'A', 1,$headings,$data,'');
          $this->addData($objPHPExcel, $data, 2,$image);
        }
        else
          $this->addData($objPHPExcel, $data, $rowno,$image);

        $this->create_excel($objPHPExcel,$filename,$save);
  }
    
   private function create_header(&$objPHPExcel, $column, $rowCount, $headings,$data,$main_heading=array()) {
      //if(!empty($main_heading))
       // $rowCount++;
        array_unshift($headings,'Sr No');
        for ($i = 0; $i < count($headings); $i++) {
            $this->headingDesign($objPHPExcel,$column,$rowCount,ucwords(str_replace("_"," ",$headings[$i])));
            if(!empty($main_heading))
            $this->create_main_heading($objPHPExcel,$main_heading,$headings[$i],$rowCount,$column);
             
            $column++; 
        }
        return true;
    }

  private function create_main_heading(&$objPHPExcel, $main_heading,$heading, $rowCount,$column) {
    $this->main_heading = true;
    $title = $this->get_main_title($main_heading,$heading);
    $this->headingDesign($objPHPExcel,$column,$rowCount,$title);
    
  }

  private function headingDesign(&$objPHPExcel,$column,$rowCount,$heading){
    $objPHPExcel->getActiveSheet()->getStyle($column . $rowCount)->applyFromArray(
        array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        )
    );
    $objPHPExcel->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension($column)->setWidth(50);
    $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(40);
    $objPHPExcel->getActiveSheet()->getStyle($column . $rowCount)->getFont()->setSize(12);
    $objPHPExcel->getActiveSheet()->getStyle($column . $rowCount)->getFont()->setBold(true);
    // background color
    $objPHPExcel->getActiveSheet()->getStyle($column . $rowCount)->getFill()->applyFromArray(
            array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array('rgb' => '9DC3E6'),
                 'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                )
            )
    );
    //border color
    $styleArray = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN
        )
      )
    );
    $objPHPExcel->getActiveSheet()->getStyle($column . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($column . $rowCount)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//vertical
    $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, ucwords(str_replace("_"," ",$heading)));
  }
    
  private function get_main_title($main_heading,$heading){
    foreach ($main_heading as $key => $value) {
      if(in_array($heading, $value))
        return $key;
    }
    return "";
  }
    
  private function addData($objPHPExcel, $result, $rowCount,$image) {
        if($this->main_heading == false){
          $k=2;
        }else{
          $objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(40);
          $k=3;
        }
        $j = 0;
        foreach ($result as $key => $value) {
          $objPHPExcel->getActiveSheet()->getRowDimension($k)->setRowHeight(40);
            $j++;
            $column = 'A';
            array_unshift($value, $j);
            if(!empty($image) && $image[0] == 'true')
            {
              //$img = explode('.', $value[$image[1]]);
              $value['image'] = $image[2].$value[$image[1]];
            }
            foreach($value as $v_key => $data){
                $objPHPExcel->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getStyle($column . $rowCount)->getFont()->setSize(10);
                $objPHPExcel->getActiveSheet()->getStyle($column . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                if($v_key === 'image'){
                  $objDrawing = new PHPExcel_Worksheet_Drawing();
                  $objDrawing->setResizeProportional(true);
                  $objDrawing->setPath($data);
                  $objDrawing->setCoordinates($column . $rowCount);
                  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
                }else{
                  $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, $data);
                }
                $column++;
            }
            $rowCount++;
            $k++;
        }
    }
    
  private function create_excel(&$obj,$filename,$save='') {
    $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the
    header('Cache-Control: max-age=0'); //no cache
    
    ob_end_clean();
    if($save == true){
      $filepath = FCPATH."uploads/excel/".$filename;
      if(!is_dir(FCPATH."uploads/excel")){
        mkdir(FCPATH."uploads/excel/",0777);
      }
      $objWriter->save($filepath);
      echo json_encode(ADMIN_PATH.'/uploads/excel/'.$filename);
    }else{
      $objWriter->save('php://output');
    }
  }

}
?>