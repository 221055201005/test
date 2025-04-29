<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welding_rfi_mod extends CI_Model {

	public function __construct(){
	  parent::__construct();
		$this->db_wh      = $this->load->database('warehouse', TRUE);
		$this->db_portal  = $this->load->database('db_portal', TRUE);
		//$this->db_eng     = $this->load->database('db_eng', TRUE);
		$this->db_eng     = $this->load->database('db_eng_mysql', TRUE);
	  // $this->db_wh      = $this->load->database('warehouse', TRUE);
 	}

	public function welding_rfi_list($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		// $query = $this->db->order_by('period', 'asc');
		$query = $this->db->get('welding_rfi');
		return $query->result_array();
	}

	public function welding_rfi_new_process_db($data) {
		convert2null($data);
		$this->db->insert('welding_rfi', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function welding_rfi_update_process_db($data, $where) {
		convert2null($data);
		$this->db->where($where);
		$this->db->update("welding_rfi", $data);
	}

	public function welding_rfi_detail_list($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		// $query = $this->db->order_by('period', 'asc');
		$query = $this->db->get('welding_rfi_detail');
		return $query->result_array();
	}

	public function welding_rfi_detail_new_process_db($data) {
		convert2null($data);
		$this->db->insert('welding_rfi_detail', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function welding_rfi_detail_update_process_db($data, $where) {
		convert2null($data);
		$this->db->where($where);
		$this->db->update("welding_rfi_detail", $data);
	}

	public function welding_attachment_list($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		// $query = $this->db->order_by('period', 'asc');
		$query = $this->db->get('welding_attachment');
		return $query->result_array();
	}

	public function welding_attachment_new_process_db($data) {
		convert2null($data);
		$this->db->insert('welding_attachment', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function welding_attachment_update_process_db($data, $where) {
		convert2null($data);
		$this->db->where($where);
		$this->db->update("welding_attachment", $data);
	}

	public function mrir_detail_list($where = null) {
		if(isset($where)) {
			$this->db_wh->where($where);
		}

		$this->db_wh->from('qcs_material');
		$query = $this->db_wh->get(); 
		return $query->result_array();
	}

	public function mrir_document_list($where = null) {
	 if(isset($where)) {
		 $this->db_wh->where($where);
	 }

	 $this->db_wh->from('qcs_material_document');
	 $query = $this->db_wh->get(); 
	 return $query->result_array();
 }

	public function material_catalog_list($where = null) {
	 if(isset($where)) {
		 $this->db_wh->where($where);
	 }

	 $this->db_wh->from('pcms_wm_material_catalog');
	 $query = $this->db_wh->get(); 
	 return $query->result_array();
 }

	public function autocomplete_heat_no($where = null) {
		if(isset($where)) {
			$this->db_wh->where($where);
		}

		$this->db_wh->select('heat_or_series_no');
		$this->db_wh->from('qcs_material');
		$this->db_wh->group_by('heat_or_series_no');
		$this->db_wh->limit(10);
		$query = $this->db_wh->get(); 
		return $query->result_array();
	}

	public function data_cutting_list($where = null) {
		if(isset($where)) {
			$this->db->where($where);
		}
		$this->db->from('pcms_cutting');
		$query = $this->db->get(); 
		return $query->result_array();
	}

	public function insert_data_cutting($formdata) {
		$this->db->insert('pcms_cutting', $formdata);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}

	public function update_data_cutting($formdata, $where = null) {
		if(isset($where)) {
			$this->db->where($where);
		}

		$this->db->update('pcms_cutting', $formdata);
	}
	
	public function cutting_attachment_list($where = null) {
		if(isset($where)) {
			$this->db->where($where);
		}

		$this->db->from('pcms_cutting_attachment');
		$query = $this->db->get(); 
		return $query->result_array();
	}

	public function insert_cutting_attachment($formdata) {
		$this->db->insert('pcms_cutting_attachment', $formdata);
	}

	public function delete_detail_cutting($where = null) {
		if(isset($where)) {
			$this->db->where($where);
			$this->db->delete('pcms_cutting', $where);
		}
	}

	public function update_cutting_attachment($formdata, $where = null) {
		if(isset($where)) {
			$this->db->where($where);
		}

		$this->db->update('pcms_cutting_attachment', $formdata);
	}

	public function delete_detail_attachment($where = null) {
		if(isset($where)) {
			$this->db->where($where);
			$this->db->delete('pcms_cutting_attachment', $where);
		}
	}

	public function welding_rfi_list_join($where = null,$limit = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		if(isset($limit)){
			$query = $this->db->limit($limit);
		}
		$query = $this->db->order_by('b.id',"asc");
		$query = $this->db->select('*,a.id as id_rfi');
		$query = $this->db->join('welding_rfi_detail b', 'a.id = b.id_welding_rfi',"LEFT");
		$query = $this->db->get('welding_rfi a');
		return $query->result_array();
	}

}
/*
End Model Auth_mod
*/