<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Module_mod extends CI_Model {

	public function __construct(){
	  parent::__construct();
		$this->db_wh      = $this->load->database('warehouse', TRUE);
		$this->db_portal  = $this->load->database('db_portal', TRUE);
		$this->db_eng     = $this->load->database('db_eng', TRUE);
	  // $this->db_wh      = $this->load->database('warehouse', TRUE);
 	}

	public function module_list($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		$query = $this->db->order_by('mod_id', 'asc');
		$query = $this->db->get('master_module');
		return $query->result_array();
	}

	public function module_new_process_db($data) {
		convert2null($data);
		$this->db->insert('master_module', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function module_update_process_db($data, $where) {
		convert2null($data);
		$this->db->where($where);
		$this->db->update('master_module', $data);
	}
  
}
/*
End Model Auth_mod
*/