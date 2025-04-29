<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Point_mod extends CI_Model {

	public function __construct(){
	  parent::__construct();
		$this->db_wh      = $this->load->database('warehouse', TRUE);
		$this->db_portal  = $this->load->database('db_portal', TRUE);
		$this->db_eng     = $this->load->database('db_eng', TRUE);
	  // $this->db_wh      = $this->load->database('warehouse', TRUE);
 	}

	public function point_list($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		$query = $this->db->order_by('id', 'asc');
		$query = $this->db->get('master_point');
		return $query->result_array();
	}

	public function point_new_process_db($data) {
		convert2null($data);
		$this->db->insert('master_point', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function point_update_process_db($data, $where) {
		convert2null($data);
		$this->db->where($where);
		$this->db->update('master_point', $data);
	}
  
}