<?php

class Participant_model extends CI_Model {
    private $holding_table = 'holding_contest_participants';
    private $table_name = 'contest_participants';
    private $table_name1 = 'contest_participants_archive';
    function __construct() {
        parent::__construct();
    }

    function validateData() {
        $arr = $this->config->item('contest_participants', 'validation_rules');
        $this->form_validation->set_rules($this->config->item('contest_participants', 'validation_rules'));
        if ($this->form_validation->run() == FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function store($data) {
        //$postData = $this->input->post('contest_participants');
        $this->db->query(" TRUNCATE holding_contest_participants ");
        $result = $this->db->insert_batch($this->holding_table, $data);
        
        // Check Archive Data
        $this->db->query(" UPDATE holding_contest_participants hcp
                                    INNER JOIN contest_participants cp
                                    ON hcp.mobile_number = cp.mobile_number 
                                        AND  hcp.contest_id = cp.contest_id 
                                        AND  hcp.company_id = cp.company_id     
                                    SET hcp.error_flag = '2'
                                ");

      /*  // Check new data
        $this->db->query("  UPDATE holding_contest_participants 
                                    INNER JOIN contest_participants 
                                    ON holding_contest_participants.mobile_number != contest_participants.mobile_number 
                                        AND  holding_contest_participants.contest_id != contest_participants.contest_id 
                                        AND  holding_contest_participants.company_id != contest_participants.company_id 
                                    SET holding_contest_participants.error_flag = '0'
                                ");*/
        // Insert new data
        $this->db->query("  INSERT INTO  contest_participants(   first_name,last_name,mobile_number,points,remark,contest_id,company_id)
                                    SELECT first_name,last_name,mobile_number,points,remark,contest_id,company_id
                                    FROM holding_contest_participants 
                                    WHERE error_flag = '0' 
                                ");

        // Insert into archive file 
        $this->db->query("  INSERT INTO  contest_participants_archive(   first_name,last_name,mobile_number,points,remark,contest_id,company_id,version)
                                    SELECT hcp.first_name,hcp.last_name,hcp.mobile_number,hcp.points,hcp.remark,hcp.contest_id,hcp.company_id,if(hcp.error_flag='0',1,MAX(cpa.version)+1)
                                    FROM holding_contest_participants hcp 
                                    LEFT JOIN contest_participants_archive cpa
                                        ON hcp.mobile_number = cpa.mobile_number 
                                            AND  hcp.contest_id = cpa.contest_id 
                                            AND  hcp.company_id = cpa.company_id    
                                    WHERE error_flag = '0' OR error_flag = '2' 
                                    GROUP BY hcp.mobile_number,hcp.contest_id,hcp.company_id 
                                ");


        // Update data participants data
         $this->db->query(" UPDATE contest_participants,(
                                    SELECT holding_contest_participants.* from contest_participants 
                                    INNER JOIN holding_contest_participants ON holding_contest_participants.mobile_number = contest_participants.mobile_number 
                                    AND  holding_contest_participants.contest_id = contest_participants.contest_id 
                                    AND  holding_contest_participants.company_id = contest_participants.company_id 
                                    WHERE error_flag='2')as p1
                            SET contest_participants.first_name = p1.first_name,
                                contest_participants.last_name = p1.last_name,
                                contest_participants.mobile_number = p1.mobile_number,
                                contest_participants.points = p1.points,
                                contest_participants.remark = p1.remark,
                                contest_participants.contest_id = p1.contest_id,
                                contest_participants.company_id = p1.company_id
                            WHERE  contest_participants.mobile_number = p1.mobile_number 
                                AND contest_participants.contest_id = p1.contest_id 
                                AND contest_participants.company_id = p1.company_id      
                            ");

        if($sql)
            return true;
        else
            return false;
    }

    public function error_log_count(){
        $this->db->where('error_flag','1'); 
        $query = $this->db->get($this->holding_table);
        return $query->num_rows();
    }
    public function get($limit="",$start="",$id="",$data_type="") {
        $contest_id = encrypt_decrypt('decrypt',$this->input->get('id'));
        $this->db->select('cp.*');
        if($id!=""){ 
            if(!empty($limit)){
                $this->db->limit($limit, $start);
            }
        }    
        $this->db->where('cp.contest_id',$contest_id);
        $query = $this->db->get($this->table_name. " cp");
        if($id!="")
            return $query->row_array();
        else
           return $query->result_array();     
    }

    public function get_count($type="") {
        $contest_id = encrypt_decrypt('decrypt',$this->input->get('id'));
        $this->db->where('contest_id',$contest_id);
        $query = $this->db->get($this->table_name);
        return $query->num_rows();
    }

    public function update(){
        $postData = $this->input->post();
        $this->db->where('id',$postData['id']);  
        $result = $this->db->update($this->table_name,$postData['company']);
        if($result)
            return true;
        else
            return false;
    }

    public function delete(){
        $id = $this->input->get('id');
        $this->db->where('id',$id);  
        $result = $this->db->update($this->table_name,array('is_deleted'=>1));
        if($result)
            return true;
        else
            return false;
    }
    
    public function get_error_log(){
        $this->db->select("first_name,last_name,mobile_number,points,remark,data_remarks");
        $this->db->where('error_flag','1'); 
        $query = $this->db->get($this->holding_table);
        return $query->result_array();
    }
}
