<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Type_of_module_mod extends CI_Model {

	public function __construct(){
	  parent::__construct();
		$this->db_wh      = $this->load->database('warehouse', TRUE);
		$this->db_portal  = $this->load->database('db_portal', TRUE);
		$this->db_eng     = $this->load->database('db_eng', TRUE);
	  // $this->db_wh      = $this->load->database('warehouse', TRUE);
 	}

	public function type_of_module_list($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		$query = $this->db->order_by('id', 'asc');
		$query = $this->db->get('master_type_of_module');
		return $query->result_array();
	}

	public function type_of_module_new_process_db($data) {
		convert2null($data);
		$this->db->insert('master_type_of_module', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function type_of_module_update_process_db($data, $where) {
		convert2null($data);
		$this->db->where($where);
		$this->db->update('master_type_of_module', $data);
	}
  
}