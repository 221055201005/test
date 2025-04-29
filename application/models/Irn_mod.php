<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Irn_mod extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		//$this->db_eng = $this->load->database('db_eng', TRUE);
		$this->db_eng = $this->load->database('db_eng_mysql', TRUE);
		$this->db_portal = $this->load->database('db_portal', TRUE);
		$this->db_wh = $this->load->database('warehouse', TRUE);
		$this->db_punchlist = $this->load->database('db_punchlist', TRUE);
	}

	function data_drawing_list($where = null)
	{
		if (isset($where)) {
			$this->db_eng->where($where);
		}
		$query = $this->db_eng->get('pcms_eng_activity');
		return $query->result_array();
	}

	function master_weld_type($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_weld_type');
		return $query->result_array();
	}

	function master_wps($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_wps');
		return $query->result_array();
	}

	function warehouse_mis_mrir($where = null)
	{
		$query = $this->db_wh->join('qcs_material b', 'a.unique_no = b.unique_ident_no');
		$query = $this->db_wh->get('pcms_wm_mis_detail a');
		return $query->result_array();
	}

	public function fitter_code($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
			$query = $this->db->limit("10");
		}
		$query = $this->db->where("status", "1");
		$query = $this->db->order_by("fit_up_badge", "asc");
		$query = $this->db->get('pcms_fitter');
		return $query->result_array();
	}

	public function welder_code($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
			$query = $this->db->limit("10");
		}
		$query = $this->db->where("status", "1");
		$query = $this->db->order_by("wel_code", "asc");
		$query = $this->db->get('pcms_welder');
		return $query->result_array();
	}

	public function wps_code($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
			$query = $this->db->limit("10");
		}
		$query = $this->db->where("status", "1");
		$query = $this->db->order_by("wps_code", "asc");
		$query = $this->db->get('pcms_wps');
		return $query->result_array();
	}

	public function area_name()
	{
		$query = $this->db->where("status", "1");
		$query = $this->db->order_by("area_name", "asc");
		$query = $this->db->get('master_area');
		return $query->result_array();
	}

	function irn_drawing_list($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("max(a.id) as id,max(a.status_irn_transmitted) as status_transmittal,max(a.irn_inspection_result) as status_irn,a.project, a.irn_transmitted_no, max(a.discipline) as discipline, max(a.module) as module, max(a.type_of_module) as type_of_module, max(a.drawing_type) as drawing_type");
		$query = $this->db->group_by("a.project, a.irn_transmitted_no");
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}

	function irn_piping_list($where = null)
	{
		$this->db->select('drawing_no, discipline, module, project');
		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->where('discipline', 1);
		$query = $this->db->from('pcms_joint');
		$query = $this->db->group_by('drawing_no, discipline, module, project')->get();
		return $query->result_array();
	}


	function piecemark_list_m($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}

		$query = $this->db->order_by("a.part_id", "ASC", FALSE);
		$query = $this->db->join('pcms_material b', 'a.id = b.id_piecemark', "LEFT");
		$query = $this->db->get('pcms_piecemark a');
		return $query->result_array();
	}


	function wtr_list($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_joint');
		return $query->result_array();
	}

	function wtr_list_reject($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->from("pcms_joint a");
		$query = $this->db->join("pcms_visual b", "a.id = b.id_joint");
		$query = $this->db->where("b.revision > 0");
		$query = $this->db->where("b.revision_category IN ('R', 'RW')");
		return $query->get()->result_array();
	}

	function visual_list($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_visual');
		return $query->result_array();
	}

	function fitup_list($where = null, $order = null)
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
		if (isset($order)) {
			foreach ($order as $key => $value) {
				$this->db->order_by($key, $value);
			}
		}
		$query = $this->db->get('pcms_fitup');
		return $query->result_array();
	}

	function verification_list($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_material');
		return $query->result_array();
	}

	function piecemark_list($where = null)
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
		$query = $this->db->get('pcms_piecemark');
		return $query->result_array();
	}

	function fitter_list($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_fitter');
		return $query->result_array();
	}

	function welder_list($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_welder');
		return $query->result_array();
	}

	function ndt_list($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_ndt');
		return $query->result_array();
	}

	function master_material_grade($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_material_grade');
		return $query->result_array();
	}

	function material_list($where = null)
	{
		if (isset($where)) {
			$this->db_wh->where($where);
		}
		$query = $this->db_wh->get('qcs_material');
		return $query->result_array();
	}

	function mis_list($where = null)
	{
		if (isset($where)) {
			$this->db_wh->where($where);
		}
		$query = $this->db_wh->get('pcms_wm_mis_detail');
		return $query->result_array();
	}

	function material_pp_list($where = null)
	{
		if (isset($where)) {
			$this->db_wh->where($where);
		}
		$query = $this->db_wh->get('pcms_wm_material_pp');
		return $query->result_array();
	}

	function material_catalog_list($where = null)
	{
		if (isset($where)) {
			$this->db_wh->where($where);
		}
		$query = $this->db_wh->get('pcms_wm_material_catalog');
		return $query->result_array();
	}



	function module_list($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_module');
		return $query->result_array();
	}

	function discipline_list($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_discipline');
		return $query->result_array();
	}

	function project_list($where = null)
	{
		if (isset($where)) {
			$this->db_portal->where($where);
		}
		$this->db_portal->where('status', '1');
		$this->db_portal->where_in('id', project_app());
		$query = $this->db_portal->get('portal_project');
		return $query->result_array();
	}

	function ndt_list_data_m($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->select('*,a.report_number as report_number');
		$query = $this->db->join('pcms_visual b', 'a.id_visual = b.id_visual');
		$query = $this->db->get('pcms_ndt a');
		return $query->result_array();
	}

	public function wps_code_m($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}

		$query = $this->db->order_by("wps_code", "asc");
		$query = $this->db->get('pcms_wps');
		return $query->result_array();
	}

	public function get_last_submission_irn_id($project, $discipline, $mod_id, $type_of_module)
	{
		$this->db->select('irn_transmitted_no');
		$this->db->from('pcms_joint');
		$this->db->where('project', $project);
		$this->db->where('discipline', $discipline);
		$this->db->where('module', $mod_id);
		$this->db->where('type_of_module', $type_of_module);
		$this->db->where('irn_transmitted_no IS NOT NULL', NULL);
		$this->db->limit(1);
		$this->db->group_by("irn_transmitted_no,project,discipline,module,type_of_module");
		$this->db->order_by('irn_transmitted_no', "DESC");
		return $this->db->get()->result_array();
	}

	function update_wtr_to_irn($where, $data)
	{
		$this->db->where($where);
		$this->db->update('pcms_joint', $data);
	}

	function approval_irn($where, $data)
	{
		$this->db->where($where);
		$this->db->update('pcms_joint', $data);
	}


	function get_ready_for_irn_raw($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("*,a.id as id_detail");
		$query = $this->db->join('pcms_workpack b', 'a.id_workpack = b.id', "LEFT");
		$query = $this->db->get('pcms_workpack_detail a');
		return $query->result_array();
	}

	function irn_raw_list($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->get('pcms_irn');
		return $query->result_array();
	}

	function irn_raw_list_detail($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->join('pcms_irn_detail b', 'a.id_irn = b.id_irn_main', "LEFT");
		$query = $this->db->get('pcms_irn a');
		return $query->result_array();
	}

	// ------------------------------------------------------------------------------------------ //

	public function get_last_submission_irn_id_new($project, $discipline, $category_irn)
	{
		$this->db->select('report_number,project_id,discipline,MAX(category_irn) AS category_irn');
		$this->db->from('pcms_irn');
		$this->db->where('project_id', $project);
		$this->db->where('discipline', $discipline);
		$this->db->where('report_number IS NOT NULL', NULL);
		$this->db->limit(1);
		$this->db->group_by("report_number,project_id,discipline");
		$this->db->order_by('report_number', "DESC");
		return $this->db->get()->result_array();
	}

	function check_joint_history($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		// $query = $this->db->select(" 
		// 		a.id as id,
		// 		a.joint_no as joint_no,
		// 		a.pos_1 as pos_1,
		// 		a.pos_2 as pos_2,
		// 		a.drawing_no as drawing_no,
		// 		a.drawing_wm as drawing_wm,
		// 		a.project as project,
		// 		a.discipline as discipline,
		// 		a.module as module,
		// 		a.type_of_module as type_of_module,
		// 		a.deck_elevation as deck_elevation,
		// 		a.mt_percent_req as mt_percent_req,
		// 		a.pt_percent_req as pt_percent_req,
		// 		a.ut_percent_req as ut_percent_req,
		// 		a.rt_percent_req as rt_percent_req,
		// 		b.id_fitup as id_fitup,
		// 		b.id_joint as id_joint_fitup,
		// 		b.submission_id as submission_id_fitup,
		// 		b.report_number as report_number_fitup,
		// 		b.status_inspection as status_inspection_fitup,
		// 		c.id_visual as id_visual,
		// 		c.id_joint as id_joint_visual,
		// 		c.submission_id as submission_id_visual,
		// 		c.report_number as report_number_visual,
		// 		c.status_inspection as status_inspection_visual,
		// 		d.id_ndt as id_ndt,
		// 		d.joint_id as id_joint_ndt,
		// 		d.submission_id as submission_id_ndt,
		// 		d.report_number as report_number_ndt,
		// 		d.id_vendor as id_vendor_ndt,
		// 		d.result as result_ndt,

		// 		f.id_baa as id_baa,
		// 		f.id_joint as id_joint_baa,
		// 		f.submission_id as submission_id_baa,
		// 		f.report_number as report_number_baa,
		// 		f.status_inspection as status_inspection_baa,
		// 	");
		$query = $this->db->select("*");
		$query = $this->db->order_by("a.id", "desc");

		// FITUP
		$query = $this->db->join('(SELECT id_fitup,id_joint,submission_id,report_number,status_inspection FROM pcms_fitup WHERE status_resubmit <> 1 AND status_retransmitted = 0) b', 'a.id = b.id_joint', "LEFT");
		// VISUAL
		$query = $this->db->join('(SELECT id_visual,id_joint,submission_id,report_number,status_inspection FROM pcms_visual WHERE retransmitt_status = 0 AND status_delete IS NULL) c', 'a.id = c.id_joint', "LEFT");
		// NDT
		$query = $this->db->join('(SELECT id as id_ndt, result, joint_id, submission_id, report_number, id_vendor FROM pcms_ndt WHERE result IN (2,3)) d', 'a.id = d.joint_id', "LEFT");
		// BONDSTRAN
		$query = $this->db->join('(SELECT id_baa,id_joint,submission_id,report_number,status_inspection FROM pcms_bondstrand WHERE status_delete = 1) f', 'a.id = f.id_joint', "LEFT");

		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}


	function insert_pcms_irn_description($data)
	{
		convert2null($data);
		$this->db->insert("pcms_irn_description", $data);
		return $this->db->insert_id();
	}

	function insert_pcms_irn($data)
	{
		convert2null($data);
		$this->db->insert("pcms_irn", $data);
		return $this->db->insert_id();
	}

	public function insert_data_irn_punchlist($form_data)
	{
		$this->db->insert('pcms_irn_punchlist', $form_data);
	}

	function irn_new_list_joint($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("
						max(a.project) as project,
						max(a.discipline) as discipline,
						max(a.module) as module,
						max(a.type_of_module) as type_of_module,
						max(b.status_inspection) as status_inspection,
						max(b.irn_description) as irn_description,
						b.report_number,
						b.submission_id
						");
		$query = $this->db->where("b.category_irn", 0);
		$query = $this->db->join('pcms_irn b', 'b.id_joint = a.id', "LEFT");
		$query = $this->db->group_by("submission_id,report_number");
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}

	function irn_new_list_joint_new($where = null , $project = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("
						max(c.company_id) as company_id,
						max(a.project) as project,
						max(a.discipline) as discipline,
						max(a.module) as module,
						max(a.type_of_module) as type_of_module,
						max(b.status_inspection) as status_inspection,
						max(b.irn_description) as irn_description,
						max(b.transmittal_date) as submission_date,
						max(b.status_document) as status_document,
						max(b.status_document_by) as status_document_by,
						max(b.status_document_date) as status_document_date,
						max(b.third_party_approval_status) as third_party_approval_status,
						max(b.third_party_approval_by) as third_party_approval_by,
						max(b.irn_type) as irn_type,
						b.report_number,
						b.submission_id,
						max(a.deck_elevation) as deck_elevation,
						");
		$query = $this->db->where("b.category_irn", 0);
		$query = $this->db->join('pcms_irn b', 'b.id_joint = a.id', "LEFT");
		$query = $this->db->join('(SELECT id, company_id FROM pcms_workpack) c', 'c.id = a.workpack_id');
		if ($project == 21) {
			$query = $this->db->group_by("b.submission_id,b.report_number,a.project,a.module,a.discipline,a.type_of_module,c.company_id, b.irn_type, a.deck_elevation");
		} else {
			$query = $this->db->group_by("b.submission_id,b.report_number,a.project,a.module,a.discipline,a.type_of_module,c.company_id, b.irn_type");
		}
		$query = $this->db->order_by('c.company_id ASC');
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}

	function irn_joint_notification($where = null , $project = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("
						max(c.company_id) as company_id,
						max(a.project) as project,
						max(a.discipline) as discipline,
						max(a.module) as module,
						max(a.type_of_module) as type_of_module,
						max(a.drawing_no) as drawing_no,
						max(b.status_inspection) as status_inspection,
						max(b.irn_description) as irn_description,
						max(b.transmittal_date) as submission_date,
						max(b.status_document) as status_document,
						max(b.status_document_by) as status_document_by,
						max(b.status_document_date) as status_document_date,
						max(b.third_party_approval_status) as third_party_approval_status,
						max(b.third_party_approval_by) as third_party_approval_by,
						max(b.irn_type) as irn_type,
						max(b.submission_id) as submission_id,
						max(d.rfi_date) as rfi_date,
						b.report_number,
						b.submission_id,
						b.smoe_approval_date as smoe_approval_date,
						max(a.deck_elevation) as deck_elevation,
						b.smoe_approval_by as smoe_approval_by,
						b.area_v2 as area_v2,
						b.location_v2 as location_v2,
						");
		$query = $this->db->where("b.category_irn", 0);
		$query = $this->db->join('pcms_irn b', 'b.id_joint = a.id', "LEFT");
		$query = $this->db->join('pcms_irn_description d', 'd.submission_id = b.submission_id', "LEFT");
		$query = $this->db->join('(SELECT id, company_id FROM pcms_workpack) c', 'c.id = a.workpack_id');
		if ($project == 21) {
			$query = $this->db->group_by("b.submission_id,b.report_number,a.project,a.module,a.discipline,a.type_of_module,c.company_id, b.irn_type, b.area_v2, b.location_v2, b.smoe_approval_by, b.smoe_approval_date, a.deck_elevation");
		} else {
			$query = $this->db->group_by("b.submission_id,b.report_number,a.project,a.module,a.discipline,a.type_of_module,c.company_id, b.irn_type, b.area_v2, b.location_v2, b.smoe_approval_by, b.smoe_approval_date");
		}
		$query = $this->db->order_by('c.company_id ASC');
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}

	function show_pcms_irn_new($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("*,b.submission_id as submission_id");
		$query = $this->db->join('(SELECT id, company_id FROM pcms_workpack) c', 'c.id = a.workpack_id');
		$query = $this->db->join('pcms_irn b', 'b.id_joint = a.id', "LEFT");
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}


	function show_pcms_irn($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("*,a.submission_id as submission_id, b.status_delete AS status_delete_joint, b.company_id AS company_id");
		$query = $this->db->join('pcms_joint b', 'b.id = a.id_joint', "LEFT");
		$query = $this->db->join('(SELECT id, company_id FROM pcms_workpack) c', 'c.id = b.workpack_id');
		$query = $this->db->get('pcms_irn a');
		return $query->result_array();
	}

	function draft_approval_list($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("
				a.report_number,
				a.project_id,
				a.discipline,
				a.module,
				a.type_of_module,
				c.company_id,
				MAX(c.postpone_reoffer_no) AS postpone_reoffer_no,
			");
		$query = $this->db->join('pcms_joint b', 'b.id = a.id_joint');
		$query = $this->db->join('pcms_visual c', 'c.id_joint = b.id');
		$query = $this->db->group_by("
		   		a.report_number,
		   		a.project_id,
				a.discipline,
				a.module,
				a.type_of_module,
				c.company_id,
		   	");
		$query = $this->db->get('pcms_irn a');
		return $query->result_array();
	}

	function draft_approval_detail($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("
				*,
				b.drawing_wm AS drawing_wm,
				c.submission_id AS visual_submission_id,
				c.report_number AS visual_report_no,
			");
		$query = $this->db->join('pcms_joint b', 'b.id = a.id_joint');
		$query = $this->db->join('pcms_visual c', 'c.id_joint = b.id');
		$query = $this->db->get('pcms_irn a');
		return $query->result_array();
	}

	function show_pcms_joint_wp($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("a.*");
		$query = $this->db->join('pcms_workpack b', 'b.id = a.workpack_id');
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}

	function show_pcms_material($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("*,a.submission_id as submission_id");
		$query = $this->db->join('pcms_piecemark b', 'b.id = a.id_piecemark', "LEFT");
		$query = $this->db->get('pcms_irn a');
		return $query->result_array();
	}

	function show_pcms_irn_description($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->get('pcms_irn_description a');
		return $query->result_array();
	}

	function show_pcms_irn_detail($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->get('pcms_irn_detail a');
		return $query->result_array();
	}

	function missing_attachment_3($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->get('pcms_bnp_attachment');
		return $query->result_array();
	}

	function missing_bnp_2023()
	{
		return $this->db->query("
			  select 
					MAX(pb.report_number) as report_number,
					MAX(mps.code) as paint_system,
					MAX(mba.description_of_activity) as description_of_activity,
					MAX(pb.id_activity),
					MAX(pb.id_paint_system),
					pb.transmittal_uniqid,
					pba.filename 
				from pcms_bnp pb 
				join pcms_bnp_attachment pba on pb.transmittal_uniqid = pba.submission_id 
				join master_paint_system mps on cast(mps.id as text) = cast(pb.id_paint_system as text) 
				join master_bnp_activity mba on cast(mba.id_activity  as text) = cast(pb.id_activity  as text) 
				where 
					cast(upload_datetime as TEXT) ilike '2023-%'
				group by
					pb.transmittal_uniqid,
					pba.filename 
				")->result_array();
	}

	function show_pcms_irn_punchlist_v2($where = null)
	{
		$query = $this->db->select("
				a.pnc_desc,
				a.pnc_attachment,
				b.report_number,
				a.input_by_datetime,
				b.category_irn,
				(CASE WHEN CAST(b.category_irn AS TEXT)='0' THEN 'FAB' ELSE 'MAT' END) AS type,
				MAX(d.discipline_name) AS discipline_name,
				MAX(e.name) AS name,
				MAX(b.irn_description) AS irn_description,
			");

		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->from('pcms_irn_punchlist a');
		$query = $this->db->Join('pcms_irn b', "a.submission_id=b.submission_id");
		$query = $this->db->Join('pcms_joint c', "b.id_joint=c.id");
		$query = $this->db->Join('master_discipline d', "d.id=c.discipline");
		$query = $this->db->Join('master_type_of_module e', "e.id=c.type_of_module");
		$query = $this->db->group_by('
				a.pnc_desc,
				a.pnc_attachment,
				b.report_number,
				a.input_by_datetime,
				b.category_irn,
				c.discipline,
				c.type_of_module,
			');

		$query = $this->db->get();

		return $query->result_array();
	}

	function show_pcms_irn_punchlist_v3($where = null)
	{
		$query = $this->db->select("
				a.pnc_desc,
				a.pnc_attachment,
				b.report_number,
				a.input_by_datetime,
				b.category_irn,
				(CASE WHEN CAST(b.category_irn AS TEXT)='0' THEN 'FAB' ELSE 'MAT' END) AS type,
				MAX(d.discipline_name) AS discipline_name,
				MAX(e.name) AS name,
				MAX(b.irn_description) AS irn_description,
			");

		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->from('pcms_irn_punchlist a');
		$query = $this->db->Join('pcms_irn b', "a.submission_id=b.submission_id");
		$query = $this->db->Join('pcms_piecemark c', "b.id_piecemark=c.id");
		$query = $this->db->Join('master_discipline d', "d.id=c.discipline");
		$query = $this->db->Join('master_type_of_module e', "e.id=c.type_of_module");
		$query = $this->db->group_by('
				a.pnc_desc,
				a.pnc_attachment,
				b.report_number,
				a.input_by_datetime,
				b.category_irn,
				c.discipline,
				c.type_of_module,
			');

		$query = $this->db->get();

		return $query->result_array();
	}

	public function insert_data_pcms_irn_detail($form_data)
	{
		$this->db->insert('pcms_irn_detail', $form_data);
	}

	function show_pcms_irn_punchlist($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->get('pcms_irn_punchlist a');
		return $query->result_array();
	}



	function show_data_irn_joint($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select(" 
					a.id as id,
					a.joint_no as joint_no,
					a.pos_1 as pos_1,
					a.pos_2 as pos_2,
					a.drawing_no as drawing_no,
					a.drawing_wm as drawing_wm,
					a.project as project,
					a.discipline as discipline,
					a.module as module,
					a.type_of_module as type_of_module,
					a.deck_elevation as deck_elevation,
					a.mt_percent_req as mt_percent_req,
					a.pt_percent_req as pt_percent_req,
					a.ut_percent_req as ut_percent_req,
					a.rt_percent_req as rt_percent_req,
					a.joint_type AS joint_type,

					b.id_fitup as id_fitup,
					b.id_joint as id_joint_fitup,
					b.submission_id as submission_id_fitup,
					b.report_number as report_number_fitup,
					b.status_inspection as status_inspection_fitup,

					c.id_visual as id_visual,
					c.id_joint as id_joint_visual,
					c.submission_id as submission_id_visual,
					c.report_number as report_number_visual,
					c.status_inspection as status_inspection_visual,
					c.weld_process_rh, 
					c.weld_process_fc,

					d.id_ndt as id_ndt,
					d.id_joint as id_joint_ndt,
					d.submission_id as submission_id_ndt,
					d.report_number as report_number_ndt,
					d.id_vendor as id_vendor_ndt,
					d.result as result_ndt,

					e.id_irn as id_irn,
					e.id_joint as id_joint_irn,
					e.submission_id as submission_id_irn,
					e.report_number as report_number_irn,
					e.status_inspection as status_inspection_irn,
					e.smoe_approval_by as smoe_approval_by_irn,
					e.smoe_approval_date as smoe_approval_date_irn,
					e.smoe_remarks as smoe_remarks_irn,
					e.client_approval_by as client_approval_by_irn,
					e.client_approval_date as client_approval_date_irn,
					e.client_remarks as client_remarks_irn,
					e.client_2nd_inspection_by as client_2nd_inspection_by_irn,
					e.client_2nd_inspection_date as client_2nd_inspection_date_irn,

					f.id_baa as id_baa,
					f.id_joint as id_joint_baa,
					f.submission_id as submission_id_baa,
					f.report_number as report_number_baa,
					f.status_inspection as status_inspection_baa,
				");

		$query = $this->db->order_by("a.id", "desc");
		// IRN
		$query = $this->db->join('(SELECT id_irn,id_joint,submission_id,report_number,status_inspection,smoe_approval_by,smoe_approval_date,smoe_remarks,client_approval_by,client_approval_date,client_remarks,client_2nd_inspection_by,client_2nd_inspection_date FROM pcms_irn) e', 'a.id = e.id_joint', "LEFT");
		// FITUP
		$query = $this->db->join('(SELECT id_fitup,id_joint,submission_id,report_number,status_inspection FROM pcms_fitup WHERE status_resubmit <> 1 AND status_retransmitted = 0) b', 'a.id = b.id_joint', "LEFT");
		// VISUAL
		$query = $this->db->join('(SELECT id_visual,id_joint,submission_id,report_number,status_inspection, weld_process_rh, weld_process_fc FROM pcms_visual WHERE retransmitt_status = 0 AND status_delete IS NULL) c', 'a.id = c.id_joint', "LEFT");
		// NDT
		$query = $this->db->join('(SELECT id as id_ndt, result, id_joint, submission_id, report_number, id_vendor FROM pcms_ndt_all WHERE result IN (2,3)) d', 'a.id = d.id_joint', "LEFT");
		// BONDSTRAN
		$query = $this->db->join('(SELECT id_baa,id_joint,submission_id,report_number,status_inspection FROM pcms_bondstrand WHERE status_delete = 1) f', 'a.id = f.id_joint', "LEFT");

		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}


	public function delete_data_pcms_irn_list($id)
	{
		$this->db->where('id_irn', $id);
		$this->db->delete('pcms_irn');
	}


	public function delete_data_pcms_irn_description($id)
	{
		$this->db->where('id_description', $id);
		$this->db->delete('pcms_irn_description');
	}


	function update_status_inspection_pmcs_irn($where, $data)
	{
		$this->db->where($where);
		$this->db->update('pcms_irn', $data);
	}

	public function delete_data_irn_punchlist($id)
	{
		$this->db->where('id_irn_pnc', $id);
		$this->db->delete('pcms_irn_punchlist');
	}

	public function search_part_id($where)
	{
		$query = $this->db->limit('5');
		$query = $this->db->where($where);
		$query = $this->db->select('drawing_ga,discipline,module,part_id,max(id) as id');
		$query = $this->db->group_by('drawing_ga,discipline,module,part_id');
		$query = $this->db->get('pcms_piecemark');

		return $query->result_array();
	}

	public function search_drawing_material($where)
	{
		$query = $this->db->where($where);
		$query = $this->db->limit('5');
		$query = $this->db->select('drawing_ga,discipline,module');
		$query = $this->db->group_by('drawing_ga,discipline,module');
		$query = $this->db->get('pcms_piecemark');

		return $query->result_array();
	}


	function check_part_id_history($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select(" 
					a.id as id,
					a.project as project,
					a.module as module,
					a.type_of_module as type_of_module,
					a.discipline as discipline,
					a.deck_elevation as deck_elevation,
					a.drawing_ga as drawing_ga,
					a.rev_ga as rev_ga,
					a.drawing_as as drawing_as,
					a.rev_as as rev_as,
					a.drawing_sp as drawing_sp,
					a.rev_sp as rev_sp, 
					a.part_id as part_id, 
					b.id_material as id_material,
					b.id_piecemark as id_piecemark,
					b.id_mis as id_mis,
					b.submission_id as submission_id,
					b.report_number as report_number,
					b.status_inspection as status_inspection, 
				");
		$query = $this->db->order_by("a.id", "desc");
		$query = $this->db->join('(SELECT id_material,id_piecemark,id_mis,submission_id,report_number,status_inspection FROM pcms_material WHERE status_delete <> 1 AND report_resubmit_status = 0) b', 'a.id = b.id_piecemark', "LEFT");
		$query = $this->db->get('pcms_piecemark a');
		return $query->result_array();
	}

	function show_data_irn_material($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select(" 
					a.id as id,
					a.project as project,
					a.module as module,
					a.type_of_module as type_of_module,
					a.discipline as discipline,
					a.deck_elevation as deck_elevation,
					a.drawing_ga as drawing_ga,
					a.rev_ga as rev_ga,
					a.drawing_as as drawing_as,
					a.rev_as as rev_as,
					a.drawing_sp as drawing_sp,
					a.rev_sp as rev_sp, 
					a.part_id as part_id, 
					b.id_material as id_material,
					b.id_piecemark as id_piecemark,
					b.id_mis as id_mis,
					b.submission_id as submission_id,
					b.report_number as report_number,
					b.status_inspection as status_inspection,
					c.report_number as irn_report_number, 
					c.status_inspection as irn_status_inspection,  
					c.submission_id as irn_submission_id,  
					c.smoe_approval_by as irn_smoe_approval_by,  
					c.smoe_approval_date as irn_smoe_approval_date,  
					c.smoe_remarks as irn_smoe_remarks,  
					c.client_approval_by as irn_client_approval_by,  
					c.client_approval_date as irn_client_approval_date,  
					c.client_remarks as irn_client_remarks,  
					c.transmittal_by as irn_transmittal_by,  
					c.transmittal_date as irn_transmittal_date,
					c.irn_type,
				");

		$query = $this->db->where("c.category_irn", 1);
		$query = $this->db->order_by("c.id_irn", "desc");
		$query = $this->db->join('pcms_irn c', 'a.id = c.id_piecemark', "LEFT");
		$query = $this->db->join('(SELECT id_material,id_piecemark,id_mis,submission_id,report_number,status_inspection FROM pcms_material WHERE status_delete <> 1 AND report_resubmit_status = 0) b', 'a.id = b.id_piecemark', "LEFT");
		$query = $this->db->get('pcms_piecemark a');
		return $query->result_array();
	}

	function show_data_irn_material_v2($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select(" 
					a.id as id,
					a.project as project,
					a.module as module,
					a.type_of_module as type_of_module,
					a.discipline as discipline,
					a.deck_elevation as deck_elevation,
					a.drawing_ga as drawing_ga,
					a.rev_ga as rev_ga,
					a.drawing_as as drawing_as,
					a.rev_as as rev_as,
					a.drawing_sp as drawing_sp,
					a.rev_sp as rev_sp, 
					a.part_id as part_id, 
					b.id_material as id_material,
					b.id_piecemark as id_piecemark,
					b.id_mis as id_mis,
					b.submission_id as submission_id,
					b.report_number as report_number,
					b.status_inspection as status_inspection,
					c.report_number as irn_report_number, 
					c.status_inspection as irn_status_inspection,  
					c.submission_id as irn_submission_id,  
					c.id_irn as id_irn,  
					c.irn_description,
				");

		$query = $this->db->where("c.category_irn", 1);
		$query = $this->db->order_by("c.id_irn", "desc");
		$query = $this->db->join('pcms_irn c', 'a.id = c.id_piecemark', "LEFT");
		$query = $this->db->join('(SELECT id_material,id_piecemark,id_mis,submission_id,report_number,status_inspection FROM pcms_material WHERE status_delete <> 1 AND report_resubmit_status = 0) b', 'a.id = b.id_piecemark', "LEFT");
		$query = $this->db->get('pcms_piecemark a');
		return $query->result_array();
	}

	function irn_new_list_material($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("
						max(a.project) as project,
						max(a.discipline) as discipline,
						max(a.module) as module,
						max(a.type_of_module) as type_of_module,
						max(b.status_inspection) as status_inspection,
						max(b.irn_description) as irn_description,
						b.report_number,
						b.submission_id
						");
		$query = $this->db->where("b.category_irn", 1);
		$query = $this->db->join('pcms_irn b', 'b.id_piecemark = a.id', "LEFT");
		$query = $this->db->group_by("b.submission_id,b.report_number");
		$query = $this->db->get('pcms_piecemark a');
		return $query->result_array();
	}

	function irn_new_list_material_new($where = null, $project = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("
						max(c.company_id) as company_id,
						max(a.project) as project,
						max(a.discipline) as discipline,
						max(a.module) as module,
						max(a.type_of_module) as type_of_module,
						max(b.status_inspection) as status_inspection,
						max(b.irn_description) as irn_description,
						max(a.is_itr) as is_itr, 
						max(b.status_inspection) as status_inspection,
						max(b.irn_description) as irn_description,
						max(b.transmittal_date) as submission_date,
						max(b.status_document) as status_document,
						max(b.status_document_by) as status_document_by,
						max(b.status_document_date) as status_document_date,
						max(b.third_party_approval_status) as third_party_approval_status,
						max(b.third_party_approval_by) as third_party_approval_by,
						max(b.irn_type) as irn_type,
						b.report_number,
						b.submission_id,
						max(a.deck_elevation) as deck_elevation,
						");
		// test_var($query);
		$query = $this->db->where("b.category_irn", 1);
		$query = $this->db->join('pcms_irn b', 'b.id_piecemark = a.id', "LEFT");
		if ($project == 21) {
			$query = $this->db->group_by("b.submission_id, b.report_number, a.project, a.discipline, a.module, a.type_of_module, c.company_id, b.irn_type, a.deck_elevation");
		} else {
			$query = $this->db->group_by("b.submission_id, b.report_number, a.project, a.discipline, a.module, a.type_of_module, c.company_id, b.irn_type");
		}
		$query = $this->db->join('(SELECT id, company_id FROM pcms_workpack) c', 'c.id = a.workpack_id');
		$query = $this->db->get('pcms_piecemark a');
		return $query->result_array();
	}

	function irn_material_notification($where = null, $project = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("
						max(c.company_id) as company_id,
						max(a.project) as project,
						max(a.discipline) as discipline,
						max(a.module) as module,
						max(a.type_of_module) as type_of_module,
						max(a.drawing_ga) as drawing_no,
						max(b.status_inspection) as status_inspection,
						max(b.irn_description) as irn_description,
						max(a.is_itr) as is_itr, 
						max(b.status_inspection) as status_inspection,
						max(b.irn_description) as irn_description,
						max(b.transmittal_date) as submission_date,
						max(b.status_document) as status_document,
						max(b.status_document_by) as status_document_by,
						max(b.status_document_date) as status_document_date,
						max(b.third_party_approval_status) as third_party_approval_status,
						max(b.third_party_approval_by) as third_party_approval_by,
						max(b.irn_type) as irn_type,
						max(b.submission_id) as submission_id,
						max(d.rfi_date) as rfi_date,
						b.report_number,
						b.submission_id,
						b.smoe_approval_date as smoe_approval_date,
						b.smoe_approval_by as smoe_approval_by,
						b.area_v2 as area_v2,
						b.location_v2 as location_v2,
						max(a.deck_elevation) as deck_elevation,
						");
		// test_var($query);
		$query = $this->db->where("b.category_irn", 1);
		$query = $this->db->join('pcms_irn b', 'b.id_piecemark = a.id', "LEFT");
		$query = $this->db->join('pcms_irn_description d', 'd.submission_id = b.submission_id', "LEFT");
		if ($project == 21) {
			$query = $this->db->group_by("b.area_v2, b.location_v2, b.submission_id, b.report_number, a.project, a.discipline, a.module, a.type_of_module, c.company_id, b.irn_type, b.smoe_approval_by,b.smoe_approval_date, a.deck_elevation");
		} else {
			$query = $this->db->group_by("b.area_v2, b.location_v2, b.submission_id, b.report_number, a.project, a.discipline, a.module, a.type_of_module, c.company_id, b.irn_type, b.smoe_approval_by,b.smoe_approval_date");
		}
		$query = $this->db->join('(SELECT id, company_id FROM pcms_workpack) c', 'c.id = a.workpack_id');
		$query = $this->db->get('pcms_piecemark a');
		return $query->result_array();
	}

	function show_pcms_irn_material($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("*, a.submission_id as submission_id, b.company_id AS company_id");
		$query = $this->db->join('pcms_piecemark b', 'b.id = a.id_piecemark', "LEFT");
		$query = $this->db->join('(SELECT id, company_id FROM pcms_workpack) c', 'c.id = b.workpack_id');
		$query = $this->db->get('pcms_irn a');
		return $query->result_array();
	}


	function receiving_cs_detail($where = null)
	{
		if (isset($where)) {
			$this->db_wh->where($where);
		}

		$this->db_wh->from('pcms_wm_receiving_cs_detail');
		$query = $this->db_wh->get();
		return $query->result_array();
	}

	function receiving_ss_detail($where = null)
	{
		if (isset($where)) {
			$this->db_wh->where($where);
		}

		$this->db_wh->from('pcms_wm_receiving_cs_detail');
		$query = $this->db_wh->get();
		return $query->result_array();
	}


	public function receiving_attachment_list_document($where = null)
	{
		if (isset($where)) {
			$this->db_wh->where($where);
		}

		$this->db_wh->from('pcms_wm_receiving_material_document');
		$this->db_wh->order_by('id DESC');
		$query = $this->db_wh->get();
		return $query->result_array();
	}


	function warehouse_qcs_material($where = null)
	{
		if (isset($where)) {
			$query = $this->db_wh->where($where);
		}
		$query = $this->db_wh->join('qcs_material_document b', 'b.material_id = a.mrir_id', "LEFT");
		$query = $this->db_wh->get('qcs_material a');
		return $query->result_array();
	}

	function show_irn_dc($where = NULL)
	{
		if ($where) {
			$query = $this->db->where($where);
		}
		$query = $this->db->get('pcms_irn_dc a');
		return $query->result_array();
	}

	function data_dc($where = NULL)
	{
		if ($where) {
			$query = $this->db->where($where);
		}
		$query = $this->db->where("a.type_of_report", 1);
		$query = $this->db->select("*,b.id as id_dc_detail_attach,b.report_number as detail_report_number");
		$query = $this->db->join('pcms_dimension_control_attach b', 'a.submission_id = b.submission_id', 'LEFT');
		$query = $this->db->get('pcms_dimension_control a');
		return $query->result_array();
	}

	function insert_pcms_irn_dc($data)
	{
		convert2null($data);
		$this->db->insert("pcms_irn_dc", $data);
		return $this->db->insert_id();
	}

	public function delete_data_irn_dc($id)
	{
		$this->db->where('id_irn_dc', $id);
		$this->db->delete('pcms_irn_dc');
	}

	function get_approval_log($where = NULL)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('approval_log');
		return $query->result_array();
	}

	public function search_joint_number($where)
	{
		$query = $this->db->where($where);
		$query = $this->db->select('drawing_no,discipline,module,joint_no,max(id) as id');
		$query = $this->db->group_by('drawing_no,discipline,module,joint_no');
		$query = $this->db->get('pcms_joint');
		return $query->result_array();
	}

	function wtr_all_of_joint_list($where = null, $overall = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		if (isset($overall)) {
			$query = $this->db->order_by("drawing_wm,joint_no", "ASC");
		} else {
			$query = $this->db->order_by("a.drawing_no,a.joint_no", "ASC", FALSE);
		}

		$query = $this->db->where("d.category_irn", 0);
		$query = $this->db->where("a.status_delete <> 0", null);
		$query = $this->db->select(" 
					a.pos_1,
					a.pos_2,
					a.weld_length,
					
					a.irn_transmitted_no,
					a.irn_approval_by_datetime,
					a.irn_approval_by_client,
					a.deck_elevation,
					
					d.report_number as report_no_irn,
					d.submission_id as submission_id_irn,
					d.client_approval_date as client_approval_date_irn,
					d.status_inspection as status_inspection_irn,

					c.process_saw_rh,
					c.process_fcaw_rh,
					c.process_smaw_rh,
					c.process_gmaw_rh,
					c.process_gtaw_rh,
					c.welder_ref_rh,
					c.wps_no_rh,
	
					c.process_saw_fc,
					c.process_fcaw_fc,
					c.process_smaw_fc,
					c.process_gmaw_fc,
					c.process_gtaw_fc,
					c.welder_ref_fc,
					c.wps_no_fc,
	
					c.id_visual,
					c.id_joint as id_joint_visual,
					c.revision_category,
					c.revision,
					c.cons_lot_no,
					c.weld_datetime,		 	
					c.postpone_reoffer_no as rev_postpone_visual,		 	
					c.report_number as visual_report_no,
					c.inspection_datetime as visual_inspection_datetime,
					c.status_inspection as visual_status_inspection,
					c.remarks as visual_remarks,
	
					b.report_number as fitup_report_no,
					b.inspection_datetime as fitup_inspection_datetime,
					b.status_inspection as fitup_status_inspection,
					b.fitter_id,
					b.tack_weld_id,
	
					a.id as id_joint,
					a.remarks,
					a.mt_percent_req,
					a.pt_percent_req,
					a.ut_percent_req,
					a.rt_percent_req,
					a.thickness,
					a.diameter,
					a.sch,
					a.class,
					a.drawing_wm,
					a.rev_wm,
					a.joint_no,
					a.weld_type,
					a.project,
					a.drawing_type,
					a.drawing_no,
					a.discipline,
					a.module,
					a.type_of_module,
					a.drawing_type
					");
		$query = $this->db->join('(SELECT * FROM pcms_visual WHERE retransmitt_status = 0 AND status_delete IS NULL AND status_inspection <> 12) c', 'a.id = c.id_joint', "LEFT");
		$query = $this->db->join('(SELECT * FROM pcms_fitup WHERE status_resubmit <> 1 AND status_retransmitted = 0 AND status_inspection <> 12) b', 'a.id = b.id_joint', "LEFT");
		$query = $this->db->join('pcms_irn d', 'a.id = d.id_joint', "LEFT");
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}

	// ------------------------------------------------------------------------------------------ //

	function report_number_manual_validation($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select('report_number');
		$query = $this->db->group_by('report_number');
		$query = $this->db->get('pcms_irn');
		return $query->result_array();
	}

	function reset_irn_report_number($where, $data)
	{
		$this->db->where($where);
		$this->db->update('pcms_irn', $data);
	}

	function update_pcms_irn_data($data, $where)
	{
		$this->db->where($where);
		$this->db->update('pcms_irn', $data);
	}

	function update_pcms_irn_desc_data($data, $where)
	{
		$this->db->where($where);
		$this->db->update('pcms_irn_description', $data);
	}

	public function update_data_pcms_irn_detail($data, $where)
	{
		$query = $this->db->where($where);
		$query = $this->db->update('pcms_irn_detail', $data);
	}

	public function update_data_pcms_irn_desc($data, $where)
	{
		$query = $this->db->where($where);
		$query = $this->db->update('pcms_irn_description', $data);
	}

	public function update_data_pcms_irn_punchlist($data, $where)
	{
		$query = $this->db->where($where);
		$query = $this->db->update('pcms_irn_punchlist', $data);
	}

	public function update_data_pcms_irn_dc($data, $where)
	{
		$query = $this->db->where($where);
		$query = $this->db->update('pcms_irn_dc', $data);
	}

	function insert_irn_drawing_status($data)
	{
		convert2null($data);
		$this->db->insert("pcms_irn_drawing_status", $data);
		return $this->db->insert_id();
	}

	public function update_irn_drawing_status($data, $where)
	{
		$query = $this->db->where($where);
		$query = $this->db->update('pcms_irn_drawing_status', $data);
	}

	function select_irn_drawing_status($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->get('pcms_irn_drawing_status');
		return $query->result_array();
	}

	function get_data_punchlist_main($where = null)
	{
		if (isset($where)) {
			$query = $this->db_punchlist->where($where);
		}
		$query = $this->db_punchlist->get('pcms_punchlist_main');
		return $query->result_array();
	}

	public function irn_list($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		if (isset($limit)) {
			$this->db->limit($limit);
		}
		$query = $this->db->get('pcms_irn');
		return $query->result_array();
	}

	public function delete_drawing_status($submission_id)
	{
		$this->db->where('submission_id', $submission_id);
		$this->db->delete('pcms_irn_drawing_status');
	}

	public function remove_draft_data_main($submission_id)
	{
		$this->db->where('submission_id', $submission_id);
		$this->db->delete('pcms_irn');
	}

	public function remove_draft_data_dc($submission_id)
	{
		$this->db->where('submission_id', $submission_id);
		$this->db->delete('pcms_irn_dc');
	}

	public function remove_draft_data_description($submission_id)
	{
		$this->db->where('submission_id', $submission_id);
		$this->db->delete('pcms_irn_description');
	}

	public function remove_draft_data_detail($submission_id)
	{
		$this->db->where('submission_id', $submission_id);
		$this->db->delete('pcms_irn_detail');
	}

	public function remove_draft_data_drawing_status($submission_id)
	{
		$this->db->where('submission_id', $submission_id);
		$this->db->delete('pcms_irn_drawing_status');
	}

	public function remove_draft_data_punchlist($submission_id)
	{
		$this->db->where('submission_id', $submission_id);
		$this->db->delete('pcms_irn_punchlist');
	}

	function search_number_on_joint($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("b.report_number");
		$query = $this->db->where("b.category_irn", 0);
		$query = $this->db->join('pcms_irn b', 'b.id_joint = a.id', "LEFT");
		$query = $this->db->join('(SELECT id, company_id FROM pcms_workpack) c', 'c.id = a.workpack_id');
		$query = $this->db->group_by("report_number");
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}

	function search_number_on_material($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("b.report_number");
		$query = $this->db->where("b.category_irn", 1);
		$query = $this->db->join('pcms_irn b', 'b.id_piecemark = a.id', "LEFT");
		$query = $this->db->group_by("b.report_number");
		$query = $this->db->join('(SELECT id, company_id FROM pcms_workpack) c', 'c.id = a.workpack_id');
		$query = $this->db->get('pcms_piecemark a');
		return $query->result_array();
	}

	function update_irn_joint($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("a.project, a.discipline, a.module, a.type_of_module, c.company_id, b.id_irn");
		$query = $this->db->where("b.category_irn", 0);
		$query = $this->db->join('pcms_irn b', 'b.id_joint = a.id', "LEFT");
		$query = $this->db->join('(SELECT id, company_id FROM pcms_workpack) c', 'c.id = a.workpack_id');
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}

	function update_irn_material($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("a.project, a.discipline, a.module, a.type_of_module, c.company_id, b.id_irn");
		$query = $this->db->where("b.category_irn", 1);
		$query = $this->db->join('pcms_irn b', 'b.id_piecemark = a.id', "LEFT");
		$query = $this->db->join('(SELECT id, company_id FROM pcms_workpack) c', 'c.id = a.workpack_id');
		$query = $this->db->get('pcms_piecemark a');
		return $query->result_array();
	}

	function piecemark_list_itr($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}

		$query = $this->db->order_by("a.part_id", "ASC", FALSE);
		$query = $this->db->join('(select * from pcms_itr where status_delete = 0 AND status_inspection <> 12 AND report_resubmit_status = 0) b', 'a.id = b.id_piecemark', "LEFT");
		$query = $this->db->get('pcms_piecemark a');
		return $query->result_array();
	}

	function check_part_id_history_itr($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select(" 
					a.id as id,
					a.project as project,
					a.module as module,
					a.type_of_module as type_of_module,
					a.discipline as discipline,
					a.deck_elevation as deck_elevation,
					a.drawing_ga as drawing_ga,
					a.rev_ga as rev_ga,
					a.drawing_as as drawing_as,
					a.rev_as as rev_as,
					a.drawing_sp as drawing_sp,
					a.rev_sp as rev_sp, 
					a.part_id as part_id, 
					b.id_itr as id_itr,
					b.id_piecemark as id_piecemark,
					b.id_mis as id_mis,
					b.submission_id as submission_id,
					b.report_number as report_number,
					b.status_inspection as status_inspection, 
					c.company_id as company_id, 
				");
		$query = $this->db->order_by("a.id", "desc");
		$query = $this->db->join('(SELECT id_itr,id_piecemark,id_mis,submission_id,report_number,status_inspection FROM pcms_itr WHERE status_delete <> 1 AND report_resubmit_status = 0) b', 'a.id = b.id_piecemark', "LEFT");
		$query = $this->db->join('(SELECT id, company_id FROM pcms_workpack) c', 'c.id = a.workpack_id');
		$query = $this->db->get('pcms_piecemark a');
		return $query->result_array();
	}

	public function search_itr_report_no($where)
	{
		$query = $this->db->where($where);
		$query = $this->db->limit('5');
		$query = $this->db->select('pcms_itr.report_number');
		$query = $this->db->join('(SELECT id, workpack_no, company_id FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = pcms_itr.id_workpack');
		$query = $this->db->group_by('pcms_itr.project_code, pcms_itr.discipline, pcms_itr.module, pcms_itr.type_of_module, pcms_workpack.company_id, pcms_itr.report_number');
		$query = $this->db->get('pcms_itr');
		return $query->result_array();
	}


	function show_data_irn_material_itr($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select(" 
					a.id as id,
					a.project as project,
					a.module as module,
					a.type_of_module as type_of_module,
					a.discipline as discipline,
					a.deck_elevation as deck_elevation,
					a.drawing_ga as drawing_ga,
					a.rev_ga as rev_ga,
					a.drawing_as as drawing_as,
					a.rev_as as rev_as,
					a.drawing_sp as drawing_sp,
					a.rev_sp as rev_sp, 
					a.part_id as part_id, 
					b.id_itr as id_itr,
					b.id_piecemark as id_piecemark,
					b.id_mis as id_mis,
					b.submission_id as submission_id,
					b.report_number as report_number,
					b.status_inspection as status_inspection,
					c.report_number as irn_report_number, 
					c.status_inspection as irn_status_inspection,  
					c.submission_id as irn_submission_id,  
					c.id_irn as id_irn,  
				");

		$query = $this->db->where("c.category_irn", 1);
		$query = $this->db->order_by("c.id_irn", "desc");
		$query = $this->db->join('pcms_irn c', 'a.id = c.id_piecemark', "LEFT");
		$query = $this->db->join('(SELECT id_itr,id_piecemark,id_mis,submission_id,report_number,status_inspection FROM pcms_itr WHERE status_delete <> 1 AND report_resubmit_status = 0) b', 'a.id = b.id_piecemark', "LEFT");
		$query = $this->db->get('pcms_piecemark a');
		return $query->result_array();
	}


	public function search_drawing_material_new($where)
	{
		// test_var($where);
		$query = $this->db->where($where);
		$query = $this->db->limit('5');
		if ($where['pcms_piecemark.project'] == 21) {
			$query = $this->db->select('pcms_piecemark.drawing_ga,pcms_piecemark.discipline,pcms_piecemark.module,pcms_piecemark.project,pcms_piecemark.deck_elevation');
			$query = $this->db->group_by('pcms_piecemark.drawing_ga,pcms_piecemark.discipline,pcms_piecemark.module,pcms_piecemark.project,pcms_piecemark.deck_elevation');
		} else {
			$query = $this->db->select('pcms_piecemark.drawing_ga,pcms_piecemark.discipline,pcms_piecemark.module,pcms_piecemark.project');
			$query = $this->db->group_by('pcms_piecemark.drawing_ga,pcms_piecemark.discipline,pcms_piecemark.module,pcms_piecemark.project');
		}
		$query = $this->db->join('(SELECT id, workpack_no, company_id FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = pcms_piecemark.workpack_id');
		$query = $this->db->get('pcms_piecemark');

		return $query->result_array();
	}

	public function search_part_id_new($where)
	{
		$query = $this->db->limit('5');
		$query = $this->db->where($where);
		$query = $this->db->select('pcms_piecemark.drawing_ga,pcms_piecemark.discipline,pcms_piecemark.module,part_id,max(pcms_piecemark.id) as id');
		$query = $this->db->group_by('pcms_piecemark.drawing_ga,pcms_piecemark.discipline,pcms_piecemark.module,pcms_piecemark.part_id');
		$query = $this->db->join('(SELECT id, workpack_no, company_id FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = pcms_piecemark.workpack_id');
		$query = $this->db->get('pcms_piecemark');

		return $query->result_array();
	}

	function check_part_id_history_new($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select(" 
					a.id as id,
					a.project as project,
					a.module as module,
					a.type_of_module as type_of_module,
					a.discipline as discipline,
					a.deck_elevation as deck_elevation,
					a.drawing_ga as drawing_ga,
					a.rev_ga as rev_ga,
					a.drawing_as as drawing_as,
					a.rev_as as rev_as,
					a.drawing_sp as drawing_sp,
					a.rev_sp as rev_sp, 
					a.part_id as part_id, 
					b.id_material as id_material,
					b.id_piecemark as id_piecemark,
					b.id_mis as id_mis,
					b.submission_id as submission_id,
					b.report_number as report_number,
					b.status_inspection as status_inspection, 
					pcms_workpack.company_id as company_id, 
				");
		$query = $this->db->order_by("a.id", "desc");
		$query = $this->db->join('(SELECT id_material,id_piecemark,id_mis,submission_id,report_number,status_inspection FROM pcms_material WHERE status_delete <> 1 AND report_resubmit_status = 0) b', 'a.id = b.id_piecemark', "LEFT");
		$query = $this->db->join('(SELECT id, workpack_no, company_id FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = a.workpack_id');
		$query = $this->db->get('pcms_piecemark a');
		return $query->result_array();
	}

	function joint_list($where = null)
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
		$query = $this->db->get('pcms_joint');
		return $query->result_array();
	}

	function fitup_pending_qc_irn_list($where = null, $limit = null)
	{
		$query = $this->db->from("(SELECT distinct (case when report_number is null then 'Draft-'||submission_id else report_number end) as irn_no, submission_id, pi2.project_id, pi2.discipline, pi2.module, pi2.type_of_module, pw.company_id
			from pcms_irn pi2
			join pcms_joint pj on pj.id = pi2.id_joint
			join pcms_workpack pw on pj.workpack_id = pw.id 
			where id_joint in (
				select id_joint
				from pcms_fitup 
				where status_inspection = 1
				and report_number IS NULL
				and status_resubmit != 1
				and status_retransmitted = 0
				and revision_status_inspection = 0
			)
		) as tmp");
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
			$query = $this->db->limit($limit);
		}
		$query = $this->db->order_by('irn_no', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	function fitup_pending_client_irn_list($where = null, $limit = null)
	{
		$query = $this->db->from("(SELECT distinct (case when report_number is null then 'Draft-'||submission_id else report_number end) as irn_no, submission_id, pi2.project_id, pi2.discipline, pi2.module, pi2.type_of_module, pw.company_id
			from pcms_irn pi2
			join pcms_joint pj on pj.id = pi2.id_joint
			join pcms_workpack pw on pj.workpack_id = pw.id 
			where id_joint in (
				select id_joint
				from pcms_fitup 
				where status_inspection = 5
				and report_number IS NOT NULL
				and status_resubmit != 1
				and status_retransmitted = 0
			)
		) as tmp");
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
			$query = $this->db->limit($limit);
		}
		$query = $this->db->order_by('irn_no', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function pcms_irn_joint($where)
	{
		$query = $this->db->select("
			a.report_number,
			a.status_inspection,
			a.category_irn,
			a.discipline,
			a.type_of_module,
			a.project_id,
			a.module, 
			a.status_inspection, 
			a.category_irn, 
			max(a.status_document) as status_document, 
			max(a.status_document_by) as status_document_by, 
			max(a.status_document_date) as status_document_date, 
			max(irn_description) as irn_desc, 
			max(transmittal_date) as submission_date, 
			max(smoe_approval_by) as smoe_approval_by, 
			max(smoe_approval_date) as smoe_approval_date, 
			max(client_approval_by) as client_approval_by, 
			max(client_approval_date) as client_approval_date, 
			max(client_remarks) as client_remarks, 
			MAX(pcms_irn_description.room) AS room, 
			pcms_joint.drawing_no,
			max(pcms_irn_detail.remarks) as smoe_remarks,
			
			MAX(pcms_joint.drawing_wm) AS drawing_wm,
			MAX(pcms_joint.deck_elevation) AS deck_elevation,

			MAX(total_joint) AS total_joint,
			MAX(need_ndt) AS need_ndt, 

			MAX(pcms_workpack.company_id) AS company_id,
			MAX(a.irn_type) AS irn_type,

			MIN(a.create_by) AS draft_by,
			MIN(a.create_date) AS draft_date,
		");
		$query = $this->db->join("pcms_irn_description", "a.submission_id=pcms_irn_description.submission_id", "LEFT");
		$query = $this->db->join("pcms_irn_detail", "a.submission_id=pcms_irn_detail.submission_id", "LEFT");
		$query = $this->db->join("pcms_joint", "a.id_joint=pcms_joint.id");
		$query = $this->db->join('(SELECT id, company_id, company_yard FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = pcms_joint.workpack_id');
		$query = $this->db->join("(
			select 
				drawing_no, 
				COUNT(drawing_no) AS total_joint,
				COUNT( CASE WHEN (mt_percent_req > 0 OR pt_percent_req > 0 OR ut_percent_req > 0 OR rt_percent_req > 0 OR pwht_percent_req > 0 ) THEN 1 END ) as need_ndt
			from pcms_joint group by drawing_no
		) joint", "joint.drawing_no=pcms_joint.drawing_no");
		$query = $this->db->group_by("
			a.report_number,
			a.status_inspection,
			a.category_irn,
			a.discipline,
			a.type_of_module,
			a.project_id, 
			a.module,
			pcms_joint.drawing_no,
			a.irn_type
		");
		$query = $this->db->from("pcms_irn a");
		if (isset($where)) {
			$this->db->where($where);
		}
		// $query = $this->db->order_by('irn_no', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function ndt_group_custom($where)
	{
		$query = $this->db->select("drawing_no, COUNT(drawing_no) AS total");
		$query = $this->db->group_by("drawing_no");
		$query = $this->db->from('(SELECT joint_id, MAX(result) AS result FROM pcms_ndt group by joint_id) pcms_ndt');
		$query = $this->db->join('pcms_joint', 'pcms_joint.id = pcms_ndt.joint_id');
		$query = $this->db->where($where);
		return $query->get()->result_array();
	}

	public function visual_group_custom($where)
	{
		$query = $this->db->select("pcms_joint.drawing_no, COUNT(pcms_joint.drawing_no) AS total");
		$query = $this->db->group_by("pcms_joint.drawing_no");
		$query = $this->db->from('pcms_visual');
		$query = $this->db->join('pcms_joint', 'pcms_joint.id = pcms_visual.id_joint');
		$query = $this->db->where($where);
		return $query->get()->result_array();
	}

	public function fitup_group_custom($where)
	{
		$query = $this->db->select("pcms_joint.drawing_no, COUNT(pcms_joint.drawing_no) AS total");
		$query = $this->db->group_by("pcms_joint.drawing_no");
		$query = $this->db->from('pcms_fitup');
		$query = $this->db->join('pcms_joint', 'pcms_joint.id = pcms_fitup.id_joint');
		$query = $this->db->where($where);
		return $query->get()->result_array();
	}


	function summary_irn_notif($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("
					max(c.company_id) as company_id,
					max(a.project) as project,
					max(a.discipline) as discipline,
					max(a.module) as module,
					max(a.type_of_module) as type_of_module,
					max(b.status_inspection) as status_inspection,
					max(b.irn_description) as irn_description,
					max(b.transmittal_date) as submission_date,
					max(b.status_document) as status_document,
					max(b.status_document_by) as status_document_by,
					max(b.status_document_date) as status_document_date,
					max(b.third_party_approval_status) as third_party_approval_status,
					max(b.third_party_approval_by) as third_party_approval_by,
					max(b.irn_type) as irn_type,
					b.report_number,
					b.submission_id
					");
		$query = $this->db->where("b.category_irn", 0);
		$query = $this->db->join('pcms_irn b', 'b.id_joint = a.id', "LEFT");
		$query = $this->db->join('(SELECT id, company_id FROM pcms_workpack) c', 'c.id = a.workpack_id');
		$query = $this->db->group_by("b.submission_id,b.report_number,a.project,a.module,a.discipline,a.type_of_module,c.company_id, b.irn_type");
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}
}
/*
	End Model Auth_mod
*/