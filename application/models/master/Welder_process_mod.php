<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welder_process_mod extends CI_Model {

	public function __construct(){
	  parent::__construct();
		$this->db_wh      = $this->load->database('warehouse', TRUE);
		$this->db_portal  = $this->load->database('db_portal', TRUE);
		$this->db_eng     = $this->load->database('db_eng', TRUE);
	  // $this->db_wh      = $this->load->database('warehouse', TRUE);
 	}

	public function welder_process_list($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		$query = $this->db->order_by('id', 'asc');
		$query = $this->db->get('master_weld_process');
		return $query->result_array();
	}

	public function welder_process_new_process_db($data) {
		convert2null($data);
		$this->db->insert('master_weld_process', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function welder_process_update_process_db($data, $where) {
		convert2null($data);
		$this->db->where($where);
		$this->db->update('master_weld_process', $data);
	}
  
}
/*
End Model Auth_mod
*/