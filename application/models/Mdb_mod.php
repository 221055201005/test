<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mdb_mod extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->db_portal = $this->load->database('db_portal', TRUE);
		//$this->db_eng = $this->load->database('db_eng', TRUE);
		$this->db_eng = $this->load->database('db_eng', TRUE);
		$this->db_mdr = $this->load->database('db_mdr', TRUE);
		$this->db_iss = $this->load->database('db_iss', TRUE);
		$this->db_wh = $this->load->database('warehouse', TRUE);
		$this->db_notif = $this->load->database('db_notif', TRUE);
	}

	function discipline($where = null, $order_by = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		} else {
			$this->db->where('status_delete', '1');
		}
		if ($order_by) {
			foreach ($order_by as $key => $value) {
				$this->db->order_by($key, $value);
			}
		}
		$this->db->where(["production_status" => 1]);
		//$this->db->limit(5);
		$query = $this->db->get('master_discipline');
		return $query->result_array();
	}

	function pcms_summary($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		//$this->db->limit(5);
		$query = $this->db->get('pcms_summary');
		return $query->result_array();
	}

	function master_itp($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->order_by('date_affected', "asc");
		//$this->db->limit(5);
		$query = $this->db->get('master_itp');
		return $query->result_array();
	}

	function summary_total_level_3($where = NULL)
	{
		$this->db->select('
			SUM(pf_mv) as pf_mv,
			COUNT(pf_mv) as total,
			COUNT(pf_mv) as pf_mv_tot,

			SUM(f_fu) as f_fu,
			SUM(f_vs) as f_vs,
			SUM(f_ndt) as f_ndt,
			COUNT(f_fu) as f_fu_tot,
			COUNT(f_vs) as f_vs_tot,
			COUNT(f_ndt) as f_ndt_tot,

			SUM(as_fu) as as_fu,
			SUM(as_vs) as as_vs,
			SUM(as_ndt) as as_ndt,
			COUNT(as_fu) as as_fu_tot,
			COUNT(as_vs) as as_vs_tot,
			COUNT(as_ndt) as as_ndt_tot,

			SUM(er_fu) as er_fu,
			SUM(er_vs) as er_vs,
			SUM(er_ndt) as er_ndt,
			COUNT(er_fu) as er_fu_tot,
			COUNT(er_vs) as er_vs_tot,
			COUNT(er_ndt) as er_ndt_tot
		');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->from('pcms_summary');
		return $query->get()->result_array();
	}

	function pcms_joint($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		//$this->db->limit(5);
		$query = $this->db->get('pcms_joint');
		return $query->result_array();
	}

	function pcms_piecemark($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		//$this->db->limit(5);
		$query = $this->db->get('pcms_piecemark');
		return $query->result_array();
	}

	function master_calculation($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		//$this->db->limit(5);
		$query = $this->db->get('master_calculation');
		return $query->result_array();
	}

	function master_bnp_activity($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		//$this->db->limit(5);
		$query = $this->db->get('master_bnp_activity');
		return $query->result_array();
	}

	function module($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		} else {
			$this->db->where('status_delete', '1');
		}
		$query = $this->db->order_by('mod_desc', "asc");
		//$this->db->limit(5);
		$query = $this->db->get('master_module');
		return $query->result_array();
	}

	function master_surveyor_status($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->order_by('description', "ASC");
		//$this->db->limit(5);
		$query = $this->db->get('master_surveyor_status');
		return $query->result_array();
	}

	function master_location($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		} else {
			// $this->db->where('status_delete', '1');
			// $this->db->where('status', '1');
		}
		$query = $this->db->order_by('location_name', 'ASC');
		//$this->db->limit(5);
		$query = $this->db->get('master_location');
		return $query->result_array();
	}

	function master_wps($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		} else {
			// $this->db->where('status_delete', '1');
			// $this->db->where('status', '1');
		}
		//$this->db->limit(5);
		$query = $this->db->get('pcms_wps');
		return $query->result_array();
	}

	function master_wps_new($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		} else {
			// $this->db->where('status_delete', '1');
			// $this->db->where('status', '1');
		}
		//$this->db->limit(5);
		$query = $this->db->get('master_wps');
		return $query->result_array();
	}


	function project($where = null)
	{
		if (isset($where)) {
			$this->db_portal->where($where);
		} else {
			$this->db_portal->where('status', '1');
		}
		$this->db_portal->where_in('id', project_app());
		$query = $this->db_portal->get('portal_project');
		return $query->result_array();
	}

	function material_catalog($where = null, $limit = null)
	{
		if (isset($where)) {
			$this->db_wh->where($where);
		}
		if (isset($limit)) {
			$this->db_wh->limit($limit);
		}
		$query = $this->db_wh->order_by('id', 'desc');
		$query = $this->db_wh->get('pcms_wm_material_catalog');
		return $query->result_array();
	}

	function catalog_category($where = null)
	{
		if (isset($where)) {
			$this->db_wh->where($where);
		}
		$query = $this->db_wh->get('pcms_wm_catalog_category');
		return $query->result_array();
	}

	function paint_system($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		} else {
			$this->db->where('status_delete', '1');
		}
		//$this->db->limit(5);
		$query = $this->db->get('master_paint_system');
		return $query->result_array();
	}

	function material_grade($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		} else {
			$this->db->where('status_delete', '1');
		}
		//$this->db->limit(5);
		$query = $this->db->get('master_material_grade');
		return $query->result_array();
	}

	function master_report_number($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		//$this->db->limit(5);
		$query = $this->db->get('master_report_no');
		return $query->result_array();
	}

	function class($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		} else {
			$this->db->where('status_delete', '1');
		}
		//$this->db->limit(5);
		$query = $this->db->get('master_class');
		return $query->result_array();
	}

	function workpack_section($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		} else {
			$this->db->where('status_delete', '1');
		}
		//$this->db->limit(5);
		$query = $this->db->get('master_workpack_section');
		return $query->result_array();
	}

	function read_project_name($id)
	{
		$this->db_portal->where('id', $id);
		$this->db_portal->where_in('id', project_app());
		$query = $this->db_portal->get('portal_project');
		return $query->result_array();
	}


	function portal_user_db_list($where = NULL)
	{
		if ($where) {
			$query = $this->db_portal->where($where);
		}

		$query = $this->db_portal->get('portal_user_db');
		return $query->result_array();
	}

	function portal_server_list($where = NULL)
	{
		if ($where) {
			$query = $this->db_portal->where($where);
		}

		$query = $this->db_portal->get('portal_server');
		return $query->result_array();
	}

	function portal_user_db_id($where_in)
	{
		$this->db_portal->select('id_user, full_name');
		$this->db_portal->where_in('id_user', $where_in);
		$query = $this->db_portal->get('portal_user_db');
		return $query->result_array();
	}

	function portal_user_db_id_all($where_in)
	{
		$this->db_portal->where_in('id_user', $where_in);
		$query = $this->db_portal->get('portal_user_db');
		return $query->result_array();
	}

	function type_of_module($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		} else {
			$this->db->where('status_delete', '1');
		}
		//$this->db->limit(5);
		$query = $this->db->get('master_type_of_module');
		return $query->result_array();
	}

	function phase($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		} else {
			$this->db->where('status_delete', '1');
		}
		//$this->db->limit(5);
		$query = $this->db->get('master_phase');
		return $query->result_array();
	}

	function deck_elevation($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		} else {
			$this->db->where('status_delete', '1');
		}
		$query = $this->db->order_by('name', 'ASC');
		//$this->db->limit(5);
		$query = $this->db->get('master_deck_elevation');
		return $query->result_array();
	}

	function sector($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		} else {
			$this->db->where('status_delete', '1');
		}
		$query = $this->db->order_by('sector', 'ASC');
		//$this->db->limit(5);
		$query = $this->db->get('master_sector');
		return $query->result_array();
	}

	function column_revision_log($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		//$this->db->limit(5);
		$query = $this->db->get('master_column_revision_log');
		return $query->result_array();
	}

	public function drawing_as($where = null)
	{
		$this->db->select('drawing_as');
		if (isset($where)) {
			$query = $this->db->where($where);
			$query = $this->db->limit("10");
		}
		$query = $this->db->group_by("drawing_as");
		//$this->db->limit(5);
		$query = $this->db->get('pcms_piecemark');
		return $query->result_array();
	}

	function drawing_type($where = null)
	{
		if (isset($where)) {
			$this->db_eng->where($where);
		} else {
			$this->db_eng->where('status_delete', '1');
		}
		// //$this->db_eng->limit(5);
		$query = $this->db_eng->get('master_drawing_type');
		return $query->result_array();
	}

	function weld_type($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		} else {
			$this->db->where('status_delete', '1');
		}
		//$this->db->limit(5);
		$query = $this->db->get('master_weld_type');
		return $query->result_array();
	}

	function joint_type($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		//$this->db->limit(5);
		$query = $this->db->get('master_joint_type');
		return $query->result_array();
	}

	function area($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		//$this->db->limit(5);
		$query = $this->db->get('master_area');
		return $query->result_array();
	}

	function company($where = null)
	{
		if (isset($where)) {
			$this->db_portal->where($where);
		}
		$query = $this->db_portal->order_by('company_name', 'ASC');
		$query = $this->db_portal->get('portal_company');
		return $query->result_array();
	}

	function bonding_process($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		//$this->db->limit(5);
		$query = $this->db->get('master_bonding_process');
		return $query->result_array();
	}

	function portal_user_get_db($ids = null)
	{
		if (isset($ids)) {
			$this->db_portal->where_in('id_user', $ids);
		}
		$query = $this->db_portal->get('portal_user_db');
		return $query->result_array();
	}

	function portal_user_get_db_new($ids = null)
	{
		$this->db_portal->select('id_user,full_name');
		if (isset($ids)) {
			$this->db_portal->where_in('id_user', $ids);
		}
		$query = $this->db_portal->get('portal_user_db');
		return $query->result_array();
	}

	function desc_assy($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		} else {
			$this->db->where('status', '1');
		}
		$query = $this->db->order_by('code', 'ASC');
		//$this->db->limit(5);
		$query = $this->db->get('master_desc_assy');
		return $query->result_array();
	}

	function piping_testing_category($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		} else {
			$this->db->where('status_delete', '1');
		}
		$query = $this->db->order_by('id', 'ASC');
		//$this->db->limit(5);
		$query = $this->db->get('master_piping_testing_category');
		return $query->result_array();
	}

	function location($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		} else {
			$this->db->where('status_delete', '1');
			$this->db->where('status', '1');
		}
		//$this->db->limit(5);
		$query = $this->db->get('master_location');
		return $query->result_array();
	}

	function mdr_document_list($where = null)
	{
		$this->db_mdr->select('md.ref_no, md.client_doc_no, mrd.attachment, mrd.transmittal_date, mrd.id_document');
		$this->db_mdr->from('mdr_document md');
		$this->db_mdr->join('mdr_reviewer_detail mrd', 'md.id = mrd.id_document');
		if (isset($where)) {
			foreach ($where as $key => $value) {
				if (strpos($key, ' IN ') !== false && $value != NULL) {
					$column = explode(" IN ", $key);
					$this->db_mdr->where_in($column[0], $value);
					unset($where[$key]);
				}
			}
			$this->db_mdr->where($where);
		}
		$this->db_mdr->where([
			'md.status_delete' => 1,
			'mrd.status_delete' => 1,
			'mrd.attachment IS NOT NULL' => NULL,
		]);
		$this->db_mdr->order_by("md.ref_no", "ASC");
		$this->db_mdr->order_by("mrd.transmittal_date", "DESC");
		$query = $this->db_mdr->get();
		return $query->result_array();
	}

	public function get_drawing_title($where = null)
	{

		$query = $this->db_eng->where($where);
		//$this->db_eng->limit(5);
		$query = $this->db_eng->get('pcms_eng_activity');
		return $query->result_array();
	}

	public function drawing_list($where = null)
	{
		if (isset($where)) {
			$query = $this->db_eng->where($where);
		}
		$query = $this->db_eng->where("project_id", 12);
		//$this->db_eng->limit(5);
		$query = $this->db_eng->get('pcms_eng_activity');
		return $query->result_array();
	}

	public function drawing_register_list($where = null)
	{
		if (isset($where)) {
			$query = $this->db_eng->where($where);
		}
		$query = $this->db_eng->order_by('document_no', 'ASC');
		$query = $this->db_eng->order_by('transmittal_date', 'DESC');
		//$this->db_eng->limit(5);
		$query = $this->db_eng->get('pcms_eng_drawing_register');
		return $query->result_array();
	}

	function report_no($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		} else {
			$this->db->where('status_delete', '1');
		}
		//$this->db->limit(5);
		$query = $this->db->get('master_report_no');
		return $query->result_array();
	}

	function data_project($where = NULL)
	{
		if ($where) {
			$query = $this->db_portal->where($where);
		}
		//$query = $this->db_portal->where('status = "1"');
		$this->db_portal->where_in('id', project_app());
		$query = $this->db_portal->get('portal_project');
		return $query->result_array();
	}

	function data_module($where = null)
	{
		if ($where) {
			$query = $this->db->where($where);
		}
		$query = $this->db->order_by("mod_desc", "asc");
		//$this->db->limit(5);
		$query = $this->db->get('master_module');
		return $query->result_array();
	}

	function eng_discipline_get_db($id = null)
	{
		if (isset($id)) {
			$this->db->where('id', $id);
		}
		$this->db->where('status', '1');
		//$this->db->limit(5);
		$query = $this->db->get('master_discipline');
		return $query->result_array();
	}

	function eng_module_get_db($id = null)
	{
		if (isset($id)) {
			$this->db->where('mod_id', $id);
		}
		//$this->db->limit(5);
		$query = $this->db->get('master_module');
		return $query->result_array();
	}

	function type_of_weld($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		} else {
			$this->db->where('status_delete', '1');
		}
		//$this->db->limit(5);
		$query = $this->db->get('master_weld_type');
		return $query->result_array();
	}

	function employee_list($where = null, $limit = null)
	{
		if (isset($where)) {
			$this->db_iss->where($where);
		}
		if (isset($limit)) {
			$this->db_iss->limit($limit);
		}
		$query = $this->db_iss->get('iss_employee');
		return $query->result_array();
	}

	public function employee_update_process_db($data, $where)
	{
		$data = convert2null($data);
		$this->db_iss->where($where);
		$this->db_iss->update("iss_employee", $data);
	}

	function bank_data_list($where = null, $limit = null)
	{
		if (isset($where)) {
			$this->db_iss->where($where);
		}
		if (isset($limit)) {
			$this->db_iss->limit($limit);
		}
		$query = $this->db_iss->get('iss_recruitment_bankdata');
		return $query->result_array();
	}

	public function mis_list($where = null)
	{
		if (isset($where)) {
			$this->db_wh->where($where);
		}
		$query = $this->db_wh->get('pcms_wm_mis');
		return $query->result_array();
	}

	public function mis_detail_list($where = null)
	{
		if (isset($where)) {
			$this->db_wh->where($where);
		}
		$query = $this->db_wh->get('pcms_wm_mis_detail');
		return $query->result_array();
	}

	public function mis_update_process_db($data, $where)
	{
		$data = convert2null($data);
		$this->db_wh->where($where);
		$this->db_wh->update("pcms_wm_mis", $data);
	}

	function section_list($where = null, $limit = null)
	{
		if (isset($where)) {
			$this->db_iss->where($where);
		}
		if (isset($limit)) {
			$this->db_iss->limit($limit);
		}
		$query = $this->db_iss->get('iss_section');
		return $query->result_array();
	}

	function fitter_list($where = null, $limit = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		if (isset($limit)) {
			$this->db->limit($limit);
		}
		//$this->db->limit(5);
		$query = $this->db->get('pcms_fitter');
		return $query->result_array();
	}

	function welder_list($where = null, $limit = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		if (isset($limit)) {
			$this->db->limit($limit);
		}
		//$this->db->limit(5);
		$query = $this->db->get('pcms_welder');
		return $query->result_array();
	}

	public function find_email_group($project_id = null)
	{
		$this->db_portal->select('portal_email_notification.*, portal_email_group.group_name AS group');
		$this->db_portal->from('portal_email_notification');
		$this->db_portal->join('portal_email_group', 'portal_email_notification.group_name = portal_email_group.id');
		if (isset($project_id)) {
			$this->db_portal->where('project', $project_id);
		}
		$this->db_portal->where('portal_email_notification.status_delete', 1);
		$query = $this->db_portal->get();
		return $query->result_array();
	}

	public function portal_email_list($where = null)
	{
		if (isset($where)) {
			$this->db_portal->where($where);
		}
		$this->db_portal->from('portal_email_notification');
		$query = $this->db_portal->get();
		return $query->result_array();
	}

	function data_user($where = NULL)
	{
		if ($where) {
			$query = $this->db_portal->where($where);
		}

		$query = $this->db_portal->get('portal_user_db');
		return $query->result_array();
	}


	public function ftp_find_master($ip_source)
	{
		$this->db_portal->where('server_source', $ip_source);
		return $this->db_portal->get('portal_ftp_server')->result_array();
	}

	public function data_plan_group($where = NULL, $group = NULL)
	{
		$query = $this->db->select("SUM(plan_target) as plan_target_sum");
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		if (isset($group)) {
			$query = $this->db->select($group);
			$query = $this->db->group_by($group);
		}
		//$this->db->limit(5);
		$query = $this->db->get('master_plan_measurement');
		return $query->result_array();
	}

	public function ftp_find_master_with_condition($ip_source, $categories)
	{
		$this->db_portal->where('server_source', $ip_source);
		$this->db_portal->where('destination_source', $categories);
		return $this->db_portal->get('portal_ftp_server')->result_array();
	}


	function master_welder_process($where = null, $order_by = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		} else {
			$this->db->where('status', '1');
		}
		if ($order_by) {
			foreach ($order_by as $key => $value) {
				$this->db->order_by($key, $value);
			}
		}
		//$this->db->limit(5);
		$query = $this->db->get('master_weld_process');
		return $query->result_array();
	}

	function get_module_name($where = Null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		//$this->db->limit(5);
		$query = $this->db->get('master_module');
		return $query->result_array();
	}


	function master_irn_detail($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->order_by('id_irn_detail', "ASC");
		//$this->db->limit(5);
		$query = $this->db->get('master_irn_detail');
		return $query->result_array();
	}

	function manual_query_db($query)
	{
		$query = $this->db->query($query);
		return $query->result_array();
	}

	function discipline_list($where = Null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		//$this->db->limit(5);
		$query = $this->db->get('master_discipline');
		return $query->result_array();
	}

	function timesheet_list($where = Null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		//$this->db->limit(5);
		$query = $this->db->get('pcms_workpack_timesheet');
		return $query->result_array();
	}

	function workpack_list($where = Null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		//$this->db->limit(5);
		$query = $this->db->get('pcms_workpack');
		return $query->result_array();
	}

	function master_ctq($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		//$this->db->limit(5);
		$query = $this->db->get('master_ctq');
		return $query->result_array();
	}

	public function area_v2($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}

		$this->db->from('master_area_v2');
		//$this->db->limit(5);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function master_dossier($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}

		$this->db->from('master_dossier');
		//$this->db->limit(5);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function location_v2($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}

		$this->db->from('master_location_v2');
		//$this->db->limit(5);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function point($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}

		$this->db->from('master_point');
		//$this->db->limit(5);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function alocation($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}

		//$this->db->limit(5);
		$query = $this->db->get('master_alocation');
		return $query->result_array();
	}

	public function ndt_type($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}

		//$this->db->limit(5);
		$query = $this->db->get('master_ndt_type');
		return $query->result_array();
	}


	public function get_user_data($where)
	{
		if (isset($where)) {
			$query = $this->db_portal->where($where);
		}
		$query = $this->db_portal->get("portal_user_db");
		return $query->result_array();
	}

	public function getById($id)
	{
		return $this->db_portal->get_where("portal_pass_config", array("id_pass" => $id))->row();
	}

	function select_user_based_on_id($where = NULL)
	{
		if ($where) {
			$query = $this->db_portal->where($where);
		}

		$query = $this->db_portal->select('id_user,full_name');
		$query = $this->db_portal->get('portal_user_db');
		return $query->result_array();
	}

	function master_group_notif($where = null)
	{
		if (isset($where)) {
			$this->db_notif->where($where);
		}
		$query = $this->db_notif->get('master_group_notif');
		return $query->result_array();
	}

	public function notification_new_process_db($data)
	{
		$this->db_notif->insert('portal_notification', $data);
		$insert_id = $this->db_notif->insert_id();
		return $insert_id;
	}

	public function irn_dossier($where = NULL)
	{
		if ($where) {
			$query = $this->db->where($where);
		}

		$query = $this->db->join('pcms_joint', 'pcms_irn.id_joint = pcms_joint.id');
		$query = $this->db->from('pcms_irn');
		$query = $this->db->join('(SELECT id_joint, id_workpack FROM pcms_visual) pcms_visual', 'pcms_visual.id_joint = pcms_joint.id');
		$query = $this->db->join('(SELECT id, company_id, deck_elevation FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = pcms_visual.id_workpack');

		$this->db->join('(SELECT id, discipline_name FROM master_discipline) dc', 'dc.id = pcms_joint.discipline');
		$this->db->order_by('MAX(dc.discipline_name) ASC, pcms_irn.report_number ASC');

		$query = $this->db->select('
			MAX(pcms_joint.deck_elevation) AS deck_elevation,
			pcms_joint.discipline,
			pcms_joint.type_of_module,
			pcms_irn.report_number,
			MAX(pcms_joint.drawing_no) AS drawing_no,
			pcms_irn.submission_id,
			pcms_workpack.company_id,
			pcms_joint.project,
			pcms_joint.module,
			MAX(pcms_irn.ecodoc_no) AS ecodoc_no,
			MAX(pcms_irn.book_volume) AS book_volume,
		');
		$query = $this->db->group_by('
			pcms_joint.discipline,
			pcms_joint.type_of_module,
			pcms_irn.report_number,
			pcms_irn.submission_id,
			pcms_workpack.company_id,
			pcms_joint.project,
			pcms_joint.module,
		');
		//$this->db->limit(5);
		$query = $this->db->get();
		return $query->result_array();
	}

	function ht_dossier($where = NULL)
	{
		if ($where) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("
			a.rfi_number,
			a.report_number,
			a.submission_id,
			a.ecodoc_no,
			a.book_volume,
			max(b.drawing_no) as drawing_no,
			max(b.discipline) as discipline,
			max(b.module) as module,
			max(b.type_of_module) as type_of_module,
			max(b.deck_elevation) as deck_elevation,
			max(a.create_by) as create_by,
			max(a.created_date) as created_date,				
			max(a.attachment_file) as attachment_file,
			max(a.date_of_inspection) as date_of_inspection,
			max(a.type_of_report) as type_of_report, 
			max(c.company_id) as company_id, 
		");
		$query = $this->db->group_by("a.submission_id,a.report_number,a.rfi_number,a.ecodoc_no,a.book_volume");
		$query = $this->db->join('pcms_joint b', 'a.id_joint = b.id', 'LEFT');
		$query = $this->db->join('(SELECT id, company_id, deck_elevation FROM pcms_workpack) c', 'c.id = b.workpack_id');
		//$this->db->limit(5);
		$query = $this->db->get('pcms_additional_report_joint a');
		return $query->result_array();
	}

	public function ndt_dossier($where = NULL)
	{
		if ($where) {
			$query = $this->db->where($where);
		}

		$query = $this->db->join('pcms_joint', 'pcms_ndt.joint_id = pcms_joint.id');
		$query = $this->db->join('pcms_ndt_attachment', 'pcms_ndt_attachment.submission_id = pcms_ndt.submission_id');
		$query = $this->db->join('(SELECT id_joint, id_workpack FROM pcms_visual) pcms_visual', 'pcms_visual.id_joint = pcms_joint.id');
		$query = $this->db->join('(SELECT id, company_id, deck_elevation FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = pcms_visual.id_workpack');
		$query = $this->db->from('pcms_ndt');

		$query = $this->db->select('
			MAX(pcms_joint.deck_elevation) AS deck_elevation,
			pcms_joint.discipline,
			pcms_joint.type_of_module,
			pcms_ndt.report_number,
			pcms_joint.drawing_no,
			pcms_ndt.submission_id,
			MAX(pcms_ndt_attachment.filename) AS filename,
			pcms_ndt.ndt_type,
			pcms_joint.project,
			pcms_joint.module,
			pcms_workpack.company_id,
			MAX(pcms_ndt.ecodoc_no) AS ecodoc_no,
			MAX(pcms_ndt.book_volume) AS book_volume,
		');
		$query = $this->db->group_by('
			pcms_joint.discipline,
			pcms_joint.type_of_module,
			pcms_ndt.report_number,
			pcms_joint.drawing_no,
			pcms_ndt.submission_id,
			pcms_ndt.ndt_type,
			pcms_joint.project,
			pcms_joint.module,
			pcms_workpack.company_id,
		');

		//$this->db->limit(5);
		$query = $this->db->get();
		return $query->result_array();
	}

	function shopdrawing_dossier($where)
	{
		// $this->db_eng->select('*');
		$this->db_eng->select('id, document_no, drawing_type, client_doc_no, desc_assy, book_volume');
		$this->db_eng->from('pcms_eng_activity');
		$this->db_eng->where($where);

		$this->db_eng->order_by("type_of_module", "ASC");
		$this->db_eng->order_by("discipline", "ASC");
		$this->db_eng->order_by("drawing_type", "ASC");
		$this->db_eng->order_by("document_no", "ASC");

		//$this->db_eng->limit(5);

		$query = $this->db_eng->get();
		return $query->result_array();
	}

	function shopdrawing_discipline_dossier($where)
	{
		// $this->db_eng->select('*');
		$this->db_eng->distinct();
		$this->db_eng->select('type_of_module, discipline');
		$this->db_eng->from('pcms_eng_activity');
		$this->db_eng->where($where);
		// $this->db_eng->limit(10);
		//$this->db_eng->limit(5);
		$query = $this->db_eng->get();
		return $query->result_array();
	}

	public function visual_dossier($where = NULL)
	{
		if ($where) {
			$query = $this->db->where($where);
		}

		$query = $this->db->join('pcms_joint', 'pcms_visual.id_joint = pcms_joint.id');
		$query = $this->db->join('(SELECT id, company_id, deck_elevation FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = pcms_visual.id_workpack');

		$query = $this->db->join('(SELECT id, discipline_name FROM master_discipline) dc', 'dc.id = pcms_joint.discipline');
		$query = $this->db->order_by('MAX(dc.discipline_name) ASC, pcms_visual.report_number ASC');

		$query = $this->db->from('pcms_visual');

		$query = $this->db->select('
			MAX(pcms_joint.deck_elevation) AS deck_elevation,
			pcms_joint.discipline,
			pcms_joint.type_of_module,
			pcms_visual.report_number,
			pcms_joint.drawing_no,
			pcms_visual.ecodoc_no,

			pcms_joint.project,
			MAX(pcms_visual.postpone_reoffer_no) AS postpone_reoffer_no,
			pcms_joint.module,
			pcms_workpack.company_id,
			MAX(pcms_visual.ecodoc_no) AS ecodoc_no,
			MAX(pcms_visual.book_volume) AS book_volume,
		');
		$query = $this->db->group_by('
			pcms_joint.discipline,
			pcms_joint.type_of_module,
			pcms_visual.report_number,
			pcms_joint.drawing_no,
			pcms_visual.ecodoc_no,
			
			pcms_joint.project,
			pcms_joint.module,
			pcms_workpack.company_id,
		');

		//$this->db->limit(5);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function mv_dossier_deck($where = null, $order_by = null)
	{

		if (isset($where)) {
			$this->db->where($where);
		}

		if (isset($order_by)) {
			$this->db->order_by($order_by);
		}

		$this->db->select('
      mv.report_number,
      mv.project_code,
      mv.discipline,
      mv.drawing_no,
      mv.module,
      mv.transmittal_datetime,
      mv.type_of_module,
      mv.drawing_no,
      mv.report_no_rev,
      mv.ecodoc_no,
      mv.book_volume,
      wp.deck_elevation,
      wp.company_id,
      mv.id_mis,
      mv.id_piecemark
    ');

		$this->db->from('pcms_material mv');
		$this->db->join('(SELECT id, company_id, deck_elevation FROM pcms_workpack) wp', 'wp.id = mv.id_workpack');
		$this->db->group_by('
      mv.report_number,
      mv.project_code,
      mv.discipline,
      mv.drawing_no,
      mv.module,
      mv.transmittal_datetime,
      mv.type_of_module,
      mv.drawing_no,
      mv.report_no_rev,
      mv.ecodoc_no,
      mv.book_volume,
      wp.deck_elevation,
      wp.company_id,
      dc.discipline_name,
      dc.discipline_name,
   	  mv.id_mis,
	  mv.id_piecemark
    ');

		$this->db->join('(SELECT id, discipline_name FROM master_discipline) dc', 'dc.id = mv.discipline');
		$this->db->order_by('dc.discipline_name ASC, mv.report_number ASC');

		//$this->db->limit(5);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function fitup_dossier($where = null, $order_by = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		if (isset($order_by)) {
			$this->db->order_by($order_by);
		} else {
			$this->db->order_by('pcms_fitup.report_number', "ASC");
		}
		$this->db->select('
			pcms_joint.project,
			pcms_joint.discipline,
			pcms_joint.module,
			pcms_joint.type_of_module, 
			max(pcms_joint.drawing_no) as drawing_no, 
			pcms_workpack.company_id,
			pcms_fitup.report_number,
			max(pcms_fitup.postpone_reoffer_no) as postpone_reoffer_no,
			max(pcms_fitup.ecodoc_no) as ecodoc_no,
			max(pcms_joint.deck_elevation) as deck_elevation,
			max(pcms_fitup.book_volume) as book_volume,
		');

		$this->db->join('pcms_joint', 'pcms_joint.id = pcms_fitup.id_joint', "LEFT");
		$this->db->join('(SELECT id, company_id FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = pcms_fitup.id_workpack', "LEFT");

		$this->db->join('(SELECT id, discipline_name FROM master_discipline) dc', 'dc.id = pcms_joint.discipline');
		$this->db->order_by('MAX(dc.discipline_name) ASC, pcms_fitup.report_number ASC');

		$this->db->group_by('
			pcms_joint.project,
			pcms_joint.discipline,
			pcms_joint.module,
			pcms_joint.type_of_module,
			pcms_workpack.company_id,
			pcms_fitup.report_number,
		');
		//$this->db->limit(5);
		return $this->db->get("pcms_fitup")->result_array();
	}

	public function wtr_dossier($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}

		$this->db->select('
    	jt.drawing_no, 
    	MAX(wtr.uniq_id) AS uniq_id, 
    	wtr.ecodoc_no, 
    	wtr.book_volume, 
    	wtr.uniq_id,

    	MAX(jt.project) AS project,
    	MAX(jt.drawing_no) AS drawing_no,
    	MAX(jt.drawing_type) AS drawing_type,
    	MAX(jt.discipline) AS discipline,
    	MAX(jt.module) AS module,
    	MAX(jt.type_of_module) AS type_of_module,
    ');

		$this->db->from('pcms_joint jt');
		$this->db->join('pcms_mwtr_signed wtr', '(jt.id = wtr.id_joint OR jt.drawing_no = wtr.drawing_no)', 'LEFT');

		$this->db->join('(SELECT id, discipline_name FROM master_discipline) dc', 'dc.id = jt.discipline');
		$this->db->order_by('MAX(dc.discipline_name) ASC, jt.drawing_no ASC');

		$this->db->group_by('jt.drawing_no, wtr.ecodoc_no, wtr.book_volume, wtr.uniq_id');
		//$this->db->limit(5);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function mrir_list($where = null)
	{
		if (isset($where)) {
			$this->db_wh->where($where);
		}

		$this->db_wh->select('
      a.mill_cert_no,
      a.unique_ident_no,
      a.receiving_detail_id,
      a.catalog_id,
      b.receiving_id,
      c.catalog_category_id
    ');

		$this->db_wh->from('qcs_material a');
		$this->db_wh->join('pcms_wm_receiving_cs_detail b', 'b.id = a.receiving_detail_id');
		$this->db_wh->join('pcms_wm_material_catalog c', 'c.id = a.catalog_id');
		$this->db_wh->order_by('a.mill_cert_no ASC');

		$query = $this->db_wh->get();
		return $query->result_array();
	}

	public function receiving_document_list($where = null)
	{
		if (isset($where)) {
			$this->db_wh->where($where);
		}

		$this->db_wh->from('pcms_wm_receiving_material_document');
		$this->db_wh->order_by('certificate_number ASC');
		$query = $this->db_wh->get();
		return $query->result_array();
	}

	public function catalog_category_list($where = null)
	{
		if (isset($where)) {
			$this->db_wh->where($where);
		}

		$this->db_wh->from('pcms_wm_catalog_category');
		$query = $this->db_wh->get();
		return $query->result_array();
	}

	public function drawing_activity_list($where = null, $order_by = null, $select = null)
	{
		if (isset($where)) {
			$this->db_eng->where($where);
		}

		if (isset($order_by)) {
			$this->db_eng->order_by($order_by);
		}

		if (isset($select)) {
			$this->db_eng->select($select);
		}

		$this->db_eng->from('pcms_eng_activity');
		//$this->db_eng->limit(5);
		$query = $this->db_eng->get();
		return $query->result_array();
	}
}

/*
	End Model Auth_mod
*/