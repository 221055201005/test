<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cons_lot_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->db_wh      = $this->load->database('warehouse', TRUE);
		$this->db_portal  = $this->load->database('db_portal', TRUE);
		$this->db_eng     = $this->load->database('db_eng', TRUE);
		// $this->db_wh      = $this->load->database('warehouse', TRUE);
	}

	public function cons_lot_list($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->order_by('id_lot', 'asc');
		$query = $this->db->get('master_consumable_lot_register');
		return $query->result_array();
	}


	public function cons_lot_new_process_db($data)
	{
		$data = convert2null($data);
		$this->db->insert('master_consumable_lot_register', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}


	public function cons_lot_update_process_db($data, $where)
	{
		$data = convert2null($data);
		$this->db->where($where);
		$this->db->update('master_consumable_lot_register', $data);
	}


	public function update_wps($formdata, $where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}

		$this->db->update('master_consumable_lot_register', $formdata);
	}

	public function qcs_mrir_list($where = null)
	{
		if (isset($where)) {
			$query = $this->db_wh->where($where);
		}
		$query = $this->db_wh->order_by('id', 'asc');
		$query = $this->db_wh->get('qcs_mrir');
		return $query->result_array();
	}

	public function qcs_material_list($where = null)
	{
		if (isset($where)) {
			$query = $this->db_wh->where($where);
		}
		$query = $this->db_wh->order_by('heat_or_series_no', 'asc');
		$query = $this->db_wh->get('qcs_material');
		return $query->result_array();
	}

	public function qcs_material_list_search($where)
	{
		$query = $this->db_wh->select('heat_or_series_no');
		$query = $this->db_wh->where($where);
		$query = $this->db_wh->order_by('heat_or_series_no', 'asc');
		$query = $this->db_wh->group_by('heat_or_series_no');
		$query = $this->db_wh->limit(10);
		$query = $this->db_wh->get('qcs_material');
		return $query->result_array();
	}

	public function brand_list($where = null)
	{
		if (isset($where)) {
			$query = $this->db_wh->where($where);
		}
		$query = $this->db_wh->order_by('brand_name', 'asc');
		$query = $this->db_wh->get('master_brand');
		return $query->result_array();
	}

	public function catalog_list($where = null)
	{
		if (isset($where)) {
			$query = $this->db_wh->where($where);
		}
		$query = $this->db_wh->order_by('id', 'asc');
		$query = $this->db_wh->get('pcms_wm_material_consumable');
		return $query->result_array();
	}
}
/*
End Model Auth_mod
*/