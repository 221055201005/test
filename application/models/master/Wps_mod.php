<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Wps_mod extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->db_wh      = $this->load->database('warehouse', TRUE);
		$this->db_portal  = $this->load->database('db_portal', TRUE);
		$this->db_eng     = $this->load->database('db_eng', TRUE);
		// $this->db_wh      = $this->load->database('warehouse', TRUE);
	}

	public function wps_list($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->order_by('id_wps', 'asc');
		$query = $this->db->get('master_wps');
		return $query->result_array();
	}

	public function wps_detail_list($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->order_by('id_wps', 'asc');
		$query = $this->db->get('master_wps_detail');
		return $query->result_array();
	}

	public function wps_list_insert($form_data)
	{
		$insert_id = $this->db->insert('master_wps', $form_data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function wps_detail_list_insert($detail_data)
	{
		$insert_id = $this->db->insert('master_wps_detail', $detail_data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}


	public function wps_new_process_db($data)
	{
		convert2null($data);
		$this->db->insert('master_wps', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function wps_new_req_process_db($data)
	{
		convert2null($data);
		$this->db->insert('master_wps_detail', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function wps_update_process_db($data, $where)
	{
		convert2null($data);
		$this->db->where($where);
		$this->db->update('master_wps', $data);
	}

	public function delete_detail_wps($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
			$this->db->delete('master_wps_detail', $where);
		}
	}

	public function delete_wps_list($data, $where)
	{
		$this->db->where($where);
		$this->db->update("master_wps", $data);
	}

	public function update_wps($formdata, $where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}

		$this->db->update('master_wps', $formdata);
	}

	public function update_wps_detail($formdata, $where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}

		$this->db->update('master_wps_detail', $formdata);
	}

	public function wps_template_joint($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}

		$this->db->select('wps');
		$this->db->where('wps IS NOT NULL');
		$this->db->from('pcms_joint');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function wps_template_joint_fitup($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}

		$this->db->select('wps_no');
		$this->db->where('wps_no IS NOT NULL');
		$this->db->from('pcms_fitup');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function wps_template_joint_visual($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}

		$this->db->select('wps_no_rh, wps_no_fc');
		$this->db->where('wps_no_rh IS NOT NULL OR wps_no_fc IS NOT NULL');
		$this->db->from('pcms_visual');
		$query = $this->db->get();
		return $query->result_array();
	}
}
/*
End Model Auth_mod
*/