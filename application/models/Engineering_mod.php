<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Engineering_mod extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->db_eng = $this->load->database('db_eng_mysql', TRUE);
		//$this->db_eng = $this->load->database('db_eng', TRUE);
		$this->db_eng_mysql = $this->load->database('db_eng_mysql', TRUE);
		$this->db_wh      = $this->load->database('warehouse', TRUE);
	}

	function piecemark_list($where = null, $limit = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		if (isset($limit)) {
			$this->db->limit($limit);
		}
		$query = $this->db->order_by("created_date", "DESC");
		$query = $this->db->get('pcms_piecemark');
		return $query->result_array();
	}

	public function piecemark_list_datatable_db($cat, $where = NULL)
	{
		$table      		= 'pcms_piecemark';
		$column     		= array('id', 'company_id', 'drawing_ga', 'rev_ga', 'drawing_as', 'rev_as', 'drawing_sp', 'rev_sp', 'part_id', 'ref_pos_1', 'description_assy', 'drawing_cp', 'rev_cp', 'drawing_cl', 'rev_cl', 'profile', 'material', 'grade', 'diameter', 'thickness', 'sch', 'length', 'height', 'width', 'weight', 'area', 'can_number', 'test_pack_no', 'remarks', 'item_code', 'spool_no', 'beam_chnl_thk', 'strain_age_test_dt', 'strain_age_test_yn', 'through_thickness', 'id');

		$this->db->from($table);
		if (isset($where)) {
			$this->db->where($where);
		}

		if ($cat == 'count_all') {
			return $this->db->count_all_results();
		}

		$i = 0;
		$_POST['search']['value'] = convert2utf8($_POST['search']['value']);
		foreach ($column as $key => $item) {
			if ($_POST['search']['value']) {
				if ($i === 0) {
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like('CAST(' . $column[$key] . ' AS VARCHAR)', $_POST['search']['value']);
				} else {
					$this->db->or_like('CAST(' . $column[$key] . ' AS VARCHAR)', $_POST['search']['value']);
				}
				if (count($column) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($column)) {
			$this->db->order_by('created_date', 'DESC');
		}

		if ($cat == 'data') {
			if ($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);

			$query = $this->db->get();
			return $query->result_array();
		} elseif ($cat == 'count_filter') {
			$query = $this->db->get();
			return $query->num_rows();
		}
	}

	public function piecemark_update_process_db($data, $where)
	{
		$this->db->where($where);
		$this->db->update("pcms_piecemark", $data);
	}

	public function piecemark_update_measurement($data, $where)
	{
		$this->db->where($where);
		$this->db->update("pcms_summary", $data);
	}

	public function piecemark_measurement_delete_process_db($where)
	{
		$this->db->where($where);
		$this->db->delete("pcms_summary");
	}

	public function piecemark_import_process_db($data)
	{
		$this->db->insert_batch('pcms_piecemark', $data);
	}

	public function piecemark_import_process_db_nobatch($data)
	{
		$data = convert2null($data);
		$insert_id = $this->db->insert('pcms_piecemark', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function insert_pcms_summary($data)
	{
		$insert_id = $this->db->insert('pcms_summary', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function piecemark_delete_process_db($where)
	{
		$this->db->where($where);
		$this->db->delete("pcms_piecemark");
	}

	function joint_list($where = null, $limit = null, $order = null)
	{
		if (isset($where)) {
			foreach ($where as $key => $value) {
				if (strpos($key, ' IN ') !== false && $value != NULL) {
					$column = explode(" IN ", $key);
					$this->db->where_in($column[0], $value);
					unset($where[$key]);
				}
			}
			$this->db->where($where);
		}
		if (isset($limit)) {
			$this->db->limit($limit);
		}
		if (isset($order)) {
			foreach ($order as $key => $value) {
				$this->db->order_by($key, $value);
			}
		}
		$query = $this->db->get('pcms_joint');
		return $query->result_array();
	}

	public function joint_new_process_db($data)
	{
		$data = convert2null($data);
		$this->db->insert('pcms_joint', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function joint_list_datatable_db($cat, $where = NULL)
	{
		$table      		= 'pcms_joint';
		$column     		= array('id', 'drawing_no', 'rev_no', 'drawing_wm', 'rev_wm', 'joint_no', 'pos_1', 'pos_2', 'weld_type', 'description_assy', 'phase', 'thickness', 'diameter', 'sch', 'length', 'weld_length', 'joint_type', 'test_pack_no', 'spool_no', 'service_line', 'class', 'grid_row', 'grid_column', 'mt_percent_req', 'pt_percent_req', 'ut_percent_req', 'rt_percent_req', 'pwht_percent_req', 'pmi_percent_req', 'remarks', 'id');

		$this->db->from($table);
		if (isset($where)) {
			$this->db->where($where);
		}

		if ($cat == 'count_all') {
			return $this->db->count_all_results();
		}

		$i = 0;
		$_POST['search']['value'] = convert2utf8($_POST['search']['value']);
		foreach ($column as $key => $item) {
			if ($_POST['search']['value']) {
				if ($i === 0) {
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like('CAST(' . $column[$key] . ' AS VARCHAR)', $_POST['search']['value']);
				} else {
					$this->db->or_like('CAST(' . $column[$key] . ' AS VARCHAR)', $_POST['search']['value']);
				}
				if (count($column) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($column)) {
			$this->db->order_by('created_date', 'DESC');
		}

		if ($cat == 'data') {
			if ($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);

			$query = $this->db->get();
			return $query->result_array();
		} elseif ($cat == 'count_filter') {
			$query = $this->db->get();
			return $query->num_rows();
		}
	}

	public function joint_update_process_db($data, $where)
	{
		$data = convert2null($data);
		$this->db->where($where);
		$this->db->update("pcms_joint", $data);
	}

	public function joint_delete_process_db($where)
	{
		$this->db->where($where);
		$this->db->delete("pcms_joint");
	}

	public function status_drawing_list_datatable_db($cat, $where = NULL)
	{
		$table = 'pcms_eng_activity';
		$column_order = array('notif_template', 'document_no', 'title', 'last_revision_no', 'project_id', 'module', 'discipline', 'transmittal_status', 'temp_piecemark_status', 'temp_joint_status', 'id');
		$column_search = array('document_no', 'title');

		$this->db_eng->from($table);
		if (isset($where)) {
			$this->db_eng->where($where);
		}

		if ($cat == 'count_all') {
			return $this->db_eng->count_all_results();
		}

		$i = 0;
		$_POST['search']['value'] = convert2utf8($_POST['search']['value']);
		foreach ($column_search as $key => $item) {
			if ($_POST['search']['value']) {
				if ($i === 0) {
					$this->db_eng->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db_eng->like('CAST(' . $column_search[$key] . ' AS VARCHAR)', $_POST['search']['value']);
				} else {
					$this->db_eng->or_like('CAST(' . $column_search[$key] . ' AS VARCHAR)', $_POST['search']['value']);
				}
				if (count($column_search) - 1 == $i) //last loop
					$this->db_eng->group_end(); //close bracket
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db_eng->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else {
			$this->db_eng->order_by('notif_template', 'DESC');
			$this->db_eng->order_by('transmittal_date', 'DESC');
		}

		if ($cat == 'data') {
			if ($_POST['length'] != -1)
				$this->db_eng->limit($_POST['length'], $_POST['start']);

			$query = $this->db_eng->get();
			return $query->result_array();
		} elseif ($cat == 'count_filter') {
			$query = $this->db_eng->get();
			return $query->num_rows();
		}
	}

	function drawing_list($where = null, $limit = null)
	{
		if (isset($where)) {
			$this->db_eng->where($where);
		}
		$this->db_eng->where("transmittal_status", 1);
		$this->db_eng->where("status_delete", 1);
		if (isset($limit)) {
			$this->db_eng->limit($limit);
		}
		$query = $this->db_eng->get('pcms_eng_activity');
		return $query->result_array();
	}

	function drawing_register($where = null, $limit = null)
	{
		if (isset($where)) {
			$this->db_eng->where($where);
		}
		if (isset($limit)) {
			$this->db_eng->limit($limit);
		}
		$query = $this->db_eng->order_by('transmittal_date', 'desc');
		$query = $this->db_eng->get('pcms_eng_drawing_register');
		return $query->result_array();
	}

	function eng_drawing_list($where = null, $limit = null)
	{
		if (isset($where)) {
			$this->db_eng->where($where);
		}
		if (isset($limit)) {
			$this->db_eng->limit($limit);
		}
		$query = $this->db_eng->get('pcms_eng_activity');
		return $query->result_array();
	}

	public function eng_drawing_update_process_db($data, $where)
	{
		$this->db_eng->where($where);
		$this->db_eng->update("pcms_eng_activity", $data);
	}

	function drawing_list_mysql($where = null, $limit = null)
	{
		if (isset($where)) {
			$this->db_eng_mysql->where($where);
		}
		$this->db_eng_mysql->where("status_delete", 1);
		if (isset($limit)) {
			$this->db_eng_mysql->limit($limit);
		}
		$query = $this->db_eng_mysql->get('pcms_eng_activity');
		return $query->result_array();
	}

	function revise_history_list($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('pcms_revise_history');
		return $query->result_array();
	}

	public function revise_history_new_process_db($data)
	{
		$this->db->insert('pcms_revise_history', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function revise_history_update_process_db($data, $where)
	{
		$this->db->where($where);
		$this->db->update("pcms_revise_history", $data);
	}

	function revision_log_list($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->order_by('created_date', 'desc');
		$query = $this->db->get('pcms_update_revision_log');
		return $query->result_array();
	}

	public function revision_log_new_process_db($data)
	{
		$this->db->insert('pcms_update_revision_log', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function revision_log_update_process_db($data, $where)
	{
		$this->db->where($where);
		$this->db->update("pcms_update_revision_log", $data);
	}

	public function revision_log_delete_process_db($where)
	{
		$this->db->where($where);
		$this->db->delete("pcms_update_revision_log");
	}

	public function revision_log_import_process_db($data)
	{
		$this->db->insert_batch('pcms_update_revision_log', $data);
	}

	public function check_irn_template($where)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->join('pcms_irn_drawing_status pids', 'pi.submission_id = pids.submission_id');
		$query = $this->db->get('pcms_irn pi');
		return $query->result_array();
	}

	public function revision_log_temp_import_process_db($data)
	{
		$this->db->insert_batch('pcms_temp_update_revision', $data);
	}

	function revision_log_temp_list($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->order_by('id_template', 'desc');
		$query = $this->db->order_by('created_date', 'desc');
		$query = $this->db->get('pcms_temp_update_revision');
		return $query->result_array();
	}

	public function revision_log_temp_delete_process_db($where)
	{
		$this->db->where($where);
		$this->db->delete("pcms_temp_update_revision");
	}

	function check_duplicate_piecemark_list($where = null, $limit = null)
	{
		if (isset($where)) {
			foreach ($where as $key => $value) {
				if (strpos($key, ' IN ') !== false && $value != NULL) {
					$column = explode(" IN ", $key);
					$this->db->where_in($column[0], $value);
					unset($where[$key]);
				}
			}
			$this->db->where($where);
		}
		$query = $this->db->get('check_duplicate_piecemark');
		return $query->result_array();
	}

	function check_duplicate_joint_list($where = null, $limit = null)
	{
		if (isset($where)) {
			foreach ($where as $key => $value) {
				if (strpos($key, ' IN ') !== false && $value != NULL) {
					$column = explode(" IN ", $key);
					$this->db->where_in($column[0], $value);
					unset($where[$key]);
				}
			}
			$this->db->where($where);
		}
		$query = $this->db->get('check_duplicate_joint');
		return $query->result_array();
	}

	function spool_no_list($where = null, $limit = null, $order = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		if (isset($limit)) {
			$this->db->limit($limit);
		}
		if (isset($order)) {
			foreach ($order as $key => $value) {
				$this->db->order_by($key, $value);
			}
		}
		$query = $this->db->select('spool_no');
		$query = $this->db->group_by('spool_no');
		$query = $this->db->get('pcms_joint');
		return $query->result_array();
	}

	function piecemark_worpack_import_list($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->order_by("project", "ASC");
		$query = $this->db->order_by("module", "ASC");
		$query = $this->db->order_by("type_of_module", "ASC");
		$query = $this->db->order_by("discipline", "ASC");
		$query = $this->db->order_by("deck_elevation", "ASC");
		$query = $this->db->order_by("description_assy", "ASC");
		$query = $this->db->order_by("status_internal", "ASC");
		$query = $this->db->order_by("piping_testing_category", "ASC");
		$query = $this->db->order_by("drawing_cl", "ASC");
		$query = $this->db->order_by("drawing_ga", "ASC");
		$query = $this->db->order_by("grade", "ASC");
		$query = $this->db->order_by("part_id", "ASC");
		$query = $this->db->get('pcms_piecemark');
		return $query->result_array();
	}

	function joint_worpack_import_list($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->order_by("project", "ASC");
		$query = $this->db->order_by("module", "ASC");
		$query = $this->db->order_by("type_of_module", "ASC");
		$query = $this->db->order_by("discipline", "ASC");
		$query = $this->db->order_by("deck_elevation", "ASC");
		$query = $this->db->order_by("description_assy", "ASC");
		$query = $this->db->order_by("status_internal", "ASC");
		$query = $this->db->order_by("phase", "ASC");
		$query = $this->db->order_by("drawing_no", "ASC");
		$query = $this->db->order_by("joint_no", "ASC");
		$query = $this->db->get('pcms_joint');
		return $query->result_array();
	}

	function wh_production_balance($where = null, $limit = null)
	{
		if (isset($where)) {
			$this->db_wh->where($where);
		}
		if (isset($limit)) {
			$this->db_wh->limit($limit);
		}
		$query = $this->db_wh->get('pcms_wm_balance_production');
		return $query->result_array();
	}

	function qcs_material_list($where = null, $limit = null)
	{
		if (isset($where)) {
			$this->db_wh->where($where);
		}
		if (isset($limit)) {
			$this->db_wh->limit($limit);
		}
		$query = $this->db_wh->get('qcs_material');
		return $query->result_array();
	}

	function mis_detail_list($where = null, $limit = null)
	{
		if (isset($where)) {
			$this->db_wh->where($where);
		}
		if (isset($limit)) {
			$this->db_wh->limit($limit);
		}
		$query = $this->db_wh->get('pcms_wm_mis_detail');
		return $query->result_array();
	}

	function mis_detail_list_v2($where = null, $limit = null)
	{
		if (isset($where)) {
			$this->db_wh->where($where);
		}
		if (isset($limit)) {
			$this->db_wh->limit($limit);
		}
		$query = $this->db_wh->join('qcs_material', 'pcms_wm_mis_detail.unique_no = qcs_material.unique_ident_no');
		$query = $this->db_wh->get('pcms_wm_mis_detail');
		return $query->result_array();
	}

	public function deck_used_piecemark($where = null) {
		if(isset($where)) {
			$this->db->where($where);
		}
		$this->db->select('deck_elevation');
		$this->db->from('pcms_piecemark');
		$this->db->group_by('deck_elevation');
		$query = $this->db->get(); 
		return $query->result_array();
	}

	public function deck_used_joint($where = null) {
		if(isset($where)) {
			$this->db->where($where);
		}
		$this->db->select('deck_elevation');
		$this->db->from('pcms_joint');
		$this->db->group_by('deck_elevation');
		$query = $this->db->get(); 
		return $query->result_array();
	}
}
/*
	End Model Auth_mod
*/