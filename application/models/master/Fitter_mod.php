<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Fitter_mod extends CI_Model {

	public function __construct(){
	  parent::__construct();
		$this->db_wh      = $this->load->database('warehouse', TRUE);
		$this->db_portal  = $this->load->database('db_portal', TRUE);
		$this->db_eng     = $this->load->database('db_eng', TRUE);
 	}

	public function fitter_list($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		} 
		$query = $this->db->order_by('id_fitter', 'asc');
		$query = $this->db->get('pcms_fitter');
		return $query->result_array();
	}
	
	public function fitter_new_process_db($data) {
		convert2null($data);
		$this->db->insert('pcms_fitter', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	

	public function fitter_update_process_db($data, $where) {
		convert2null($data);
		$this->db->where($where);
		$this->db->update('pcms_fitter', $data);
	}


	public function update_fitter($formdata, $where = null) {
		if(isset($where)) {
			$this->db->where($where);
		}
		$this->db->update('pcms_fitter', $formdata);
	}
  
}

/*
End Model Auth_mod
*/