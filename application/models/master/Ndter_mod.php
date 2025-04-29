<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ndter_mod extends CI_Model {

	public function __construct(){
	  parent::__construct();
		$this->db_wh      = $this->load->database('warehouse', TRUE);
		$this->db_portal  = $this->load->database('db_portal', TRUE);
		$this->db_eng     = $this->load->database('db_eng', TRUE);
	  // $this->db_wh      = $this->load->database('warehouse', TRUE);
 	}

	public function personnel_list($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		$query = $this->db->order_by('status asc');
		$query = $this->db->get('master_ndt_personnel');
		return $query->result_array();
	}

	public function personnel_new_process_db($data) {
		convert2null($data);
		$this->db->insert('master_ndt_personnel', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function personnel_update_process_db($data, $where) {
		convert2null($data);
		$this->db->where($where);
		$this->db->update('master_ndt_personnel', $data);
	}


	public function master_ndt_tech_designation($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		$query = $this->db->order_by('id_designation', 'asc');
		$query = $this->db->get('master_ndt_tech_designation');
		return $query->result_array();
	}

	public function master_ndt_tech_qualitifcation($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		$query = $this->db->order_by('id_qualification', 'asc');
		$query = $this->db->get('master_ndt_tech_qualitifcation');
		return $query->result_array();
	}

	public function kpi_ndt_personnel($where = NULL){
		$this->db->select("
			COUNT(id) AS total_joint,
			SUM(tested_length) AS total_length,
			COUNT(
				CASE
					WHEN result=2 THEN 1
				END
			) as reject,
			COUNT(
				CASE
					WHEN result=3 THEN 1
				END
			) as accept,
			SUM(
				CASE
					WHEN result=2 THEN tested_length
				END
			) as reject_length,
			SUM(
				CASE
					WHEN result=3 THEN tested_length
				END
			) as accept_length,
			tested_by
		");
		if(isset($where)) {
      $this->db->where($where);
    }

    $this->db->from('pcms_ndt_all');
    $this->db->group_by('tested_by');
    $query = $this->db->get(); 
    return $query->result_array();
	}
  
}
/*
End Model Auth_mod
*/