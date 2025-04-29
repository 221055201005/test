<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Wtr_mod extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		//$this->db_eng = $this->load->database('db_eng', TRUE);
		$this->db_eng = $this->load->database('db_eng_mysql', TRUE);
		$this->db_eng_mysql = $this->load->database('db_eng_mysql', TRUE);
		$this->db_portal = $this->load->database('db_portal', TRUE);
		$this->db_wh = $this->load->database('warehouse', TRUE);
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

	function pcms_additional_report_joint($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_additional_report_joint');
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

	function wtr_drawing_list($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("
		 	max(a.id) as id,
		 	max(a.status_irn_transmitted) as status_irn,
		 	a.project,
		 	a.drawing_type,
		 	a.drawing_no,
		 	a.discipline,
		 	a.module,
		 	a.type_of_module,
		 	a.drawing_type,
		 	MAX(pcms_workpack.company_id) AS company_id,
		 	max(a.test_pack_no) AS test_pack_no,
		 ");
		$query = $this->db->group_by("
		 	a.project,
		 	a.drawing_type,
		 	a.drawing_no,
		 	a.discipline,
		 	a.module,
		 	a.type_of_module,
		 	a.drawing_type
		 ");
		$query = $this->db->join('(SELECT id_joint, id_workpack FROM pcms_fitup) pcms_fitup', 'a.id = pcms_fitup.id_joint', "LEFT");
		$query = $this->db->join('(SELECT id, company_id FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = pcms_fitup.id_workpack', "LEFT");

		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}

	function wtr_piping_list($where = null)
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


	function wtr_all_of_joint_list($where = null, $overall = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		//$query = $this->db->where("status_inspection","7");
		if (isset($overall)) {
			$query = $this->db->order_by("drawing_wm,joint_no", "ASC");
		} else {
			$query = $this->db->order_by("a.drawing_no,a.joint_no", "ASC", FALSE);
		}

		// $query = $this->db->where("c.status_inspection <> 12", NULL);
		// $query = $this->db->where("b.status_inspection <> 12", NULL);
		$query = $this->db->where("a.status_delete <> 0", NULL);
		//$query = $this->db->where("f.status_deleted", 1);

		$query = $this->db->select("

		 	a.pos_1,
		 	a.pos_2,
		 	a.weld_length,
		 	a.joint_type,
		 	
		 	a.irn_transmitted_no,
		 	a.irn_approval_by_datetime,
		 	a.irn_approval_by_client,

		 	a.is_bondstrand,
		 	
		 	c.wps_no_rh,
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
			c.submission_id as visual_submission_id,
			c.weld_process_rh as weld_process_rh,
			c.weld_process_fc as weld_process_fc,

		 	b.report_number as fitup_report_no,
		 	b.submission_id as fitup_submission_id,
		 	b.inspection_datetime as fitup_inspection_datetime,
		 	b.status_inspection as fitup_status_inspection,
		 	b.fitter_id,
			b.postpone_reoffer_no as postpone_reoffer_no,

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
		 	a.drawing_type,
		 	a.spool_no,
		 	a.test_pack_no,
			a.job_no,
			a.deck_elevation,

			d.report_number as irn_report_no,
			d.submission_id as irn_submission_id,
			d.status_inspection as irn_status_inspection,
			d.client_approval_date as irn_client_approval_date, 
			d.smoe_approval_date as irn_smoe_approval_date, 
			a.company_id as company_id, 

			f.status_inspection as mwtr_signed_status_inspection, 
			f.uniq_id as mwtr_signed_uniq_id, 
			f.submission_id as mwtr_signed_submission_id, 

			f.smoe_approval_by as mwtr_signed_smoe_approval_by, 
			f.smoe_approval_date as mwtr_signed_smoe_approval_date, 
			f.client_approval_by as mwtr_signed_client_approval_by, 
			f.client_approval_date as mwtr_signed_client_approval_date, 
			f.smoe_remarks as smoe_remarks,
			f.rfi_inspect_by,
			f.rfi_submitted_date,

			c.weld_process_rh,
			c.weld_process_fc,

			rt_percent_req, mt_percent_req, pt_percent_req, ut_percent_req, pwht_percent_req,
			d.irn_type

		 	");
		$query = $this->db->join('pcms_mwtr_signed f', 'a.id = f.id_joint', "LEFT");
		$query = $this->db->join('pcms_irn d', 'a.id = d.id_joint', "LEFT");
		$query = $this->db->join('(SELECT * FROM pcms_visual WHERE retransmitt_status = 0 AND status_delete IS NULL AND status_inspection <> 12) c', 'a.id = c.id_joint', "LEFT");
		$query = $this->db->join('(SELECT * FROM pcms_fitup WHERE status_resubmit <> 1 AND status_retransmitted = 0 AND status_inspection <> 12) b', 'a.id = b.id_joint', "LEFT");
		$query = $this->db->join('(SELECT id, company_id as company_id_wp FROM pcms_workpack where status not in (0,3)) e', 'e.id = a.workpack_id', "LEFT");

		//   if(ENVIRONMENT=='development'){
		// 		 	$query = $this->db->limit('1');
		// 		}

		$query = $this->db->get('pcms_joint a');
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

	function fitup_list($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
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
		$this->db_portal->where_in('id', project_app());
		$this->db_portal->where('status', '1');
		$query = $this->db_portal->get('portal_project');
		return $query->result_array();
	}

	function ndt_list_data_m($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->select('
			*,
			a.report_number as report_number,
			a.ndt_type as ndt_type,
			b.id_joint as id_joint_visual,
			c.revision AS attachment_revision,
		');
		$query = $this->db->join('pcms_ndt_attachment c', 'a.submission_id = c.submission_id', "LEFT");
		$query = $this->db->join('pcms_visual b', 'a.id_visual = b.id_visual', "LEFT");
		$query = $this->db->get('pcms_ndt a');
		return $query->result_array();
	}

	function ndt_list_data_m_v2($method = 'mt', $where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$select = [
			'a.report_no as report_number',
			'b.id_visual',
			'b.id_joint as id_joint_visual',
			'c.revision AS attachment_revision',
			'b.revision_category',
			'b.revision',
			'c.filename',
			'a.date_of_inspection',
			'a.ndt_type',
		];
		$query = $this->db->select($select);
		$query = $this->db->join('pcms_ndt_attachment c', 'a.rfi_no = c.submission_id', "LEFT");
		$query = $this->db->join('pcms_visual b', 'a.id_visual = b.id_visual', "LEFT");
		$query = $this->db->get('pcms_ndt_' . strtolower($method) . ' a');
		// $query = $this->db->get('pcms_ndt a');
		return $query->result_array();
	}

	function ndt_list_data_m_v3($method = 'mt', $where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$select = [
			'a.report_no as report_number',
			'b.id_visual',
			'b.id_joint as id_joint_visual',
			'b.revision_category',
			'b.revision',
			'a.date_of_inspection',
			'a.ndt_type',
			'a.tested_by',
			'a.id_vendor',
			'a.tested_length as tested_length',
			'MAX(a.result) AS result',
			'MAX(a.uniq_id_report) AS uniq_id_report',
			'MAX(a.status_inspection) AS status_inspection',
		];
		$query = $this->db->select($select);
		$query = $this->db->join('pcms_visual b', 'a.id_visual = b.id_visual', "LEFT");
		$query = $this->db->group_by("
			a.report_no,
			b.id_visual,
			b.id_joint,
			b.revision_category,
			b.revision,
			a.tested_by,
			a.id_vendor,
			a.date_of_inspection,
			a.ndt_type,
			a.tested_length,	
		");
		$query = $this->db->get('pcms_ndt_' . strtolower($method) . ' a');
		return $query->result_array();
	}

	function ndt_defect_list($where = null){
		$query = $this->db->select('*');
		$query = $this->db->join('pcms_ctq_reject pcr', 'pcr.ndt_id = pna.id AND pcr.ndt_type = pna.ndt_type AND pcr.submission_id = pna.submission_id');
		$query = $this->db->from('pcms_ndt_all pna');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	function ndt_upload_defect_list($where = null){
		$query = $this->db->select('*');
		$query = $this->db->join('pcms_ctq_reject pcr', 'pcr.ndt_id = pna.id AND pcr.ndt_type = pna.ndt_type AND pcr.submission_id = pna.submission_id');
		$query = $this->db->from('pcms_ndt pna');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get();
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
		//$this->db->where('discipline',$discipline);
		//$this->db->where('module',$mod_id);
		//$this->db->where('type_of_module',$type_of_module);        
		$this->db->where('irn_transmitted_no IS NOT NULL', NULL);
		$this->db->limit(1);
		//$this->db->group_by("irn_transmitted_no,project,discipline,module,type_of_module");
		$this->db->group_by("irn_transmitted_no,project");
		$this->db->order_by('irn_transmitted_no', "DESC");
		return $this->db->get()->result_array();
	}

	function update_wtr_to_irn($where, $data)
	{
		$this->db->where($where);
		$this->db->update('pcms_joint', $data);
	}


	function data_list_of_drawing_joint($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("
			max(irn_inspection_result) as irn_inspection_result, 
		 	max(irn_remarks)as irn_remarks, 
		 	max(irn_transmitted_no)as irn_transmitted_no, 
		 	max(irn_transmitted_by) as irn_transmitted_by,
		 	max(irn_transmitted_datetime) as irn_transmitted_datetime,
		 	max(irn_approval_by) as irn_approval_by,
		 	max(irn_approval_by_datetime) as irn_approval_by_datetime,
		 	max(irn_approval_by_client) as irn_approval_by_client,
		 	max(irn_approval_by_client_datetime) as irn_approval_by_client_datetime,
		 	max(pos_1) as pos_1,
		 	max(pos_2) as pos_2,
		 	project,
		 	drawing_no,
		 	max(drawing_type) as drawing_type,
		 	discipline,
		 	module,
		 	type_of_module
		 	");
		$this->db->group_by("project,drawing_no,discipline,module,type_of_module");
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}

	function company_workpack()
	{
		$query = $this->db->select(" 
		 	company_id,
		 ");
		$this->db->where("status_delete", 1);
		$this->db->group_by("company_id");
		$query = $this->db->get('pcms_workpack');
		return $query->result_array();
	}

	function data_drawing_list_mysql($where = null)
	{
		if (isset($where)) {
			$this->db_eng_mysql->where($where);
		}
		$query = $this->db_eng_mysql->get('pcms_eng_activity');
		return $query->result_array();
	}


	function data_list_of_drawing_joint_data($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("pos_1,pos_2");
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}

	public function search_drawing($where)
	{
		$query = $this->db->where($where);
		$query = $this->db->limit('5');
		$query = $this->db->select('drawing_no,drawing_wm,discipline,module');
		$query = $this->db->group_by('drawing_no,drawing_wm,discipline,module');
		$query = $this->db->get('pcms_joint');

		return $query->result_array();
	}

	public function search_joint_number($where)
	{
		$query = $this->db->where($where);
		$query = $this->db->select('drawing_no,discipline,module,joint_no');
		$query = $this->db->group_by('drawing_no,discipline,module,joint_no');
		$query = $this->db->get('pcms_joint');

		return $query->result_array();
	}

	public function validated_joint_number($where)
	{
		$query = $this->db->where($where);
		$query = $this->db->get('pcms_joint');

		return $query->result_array();
	}


	public function get_last_submission_irn_id_new($project, $discipline)
	{
		$this->db->select('irn_transmitted_no,project,discipline');
		$this->db->from('pcms_joint');
		$this->db->where('project', $project);
		$this->db->where('discipline', $discipline);
		$this->db->where('irn_transmitted_no IS NOT NULL', NULL);
		$this->db->limit(1);
		$this->db->group_by("irn_transmitted_no,project,discipline");
		$this->db->order_by('irn_transmitted_no', "DESC");
		return $this->db->get()->result_array();
	}

	function update_irn_details_on_template($data, $where)
	{
		$this->db->where($where);
		$this->db->update('pcms_joint', $data);
	}

	public function insert_data_pcms_irn_detail($form_data)
	{
		$this->db->insert('pcms_irn_detail', $form_data);
	}

	public function get_data_irn_data_detail($where)
	{
		$query = $this->db->where($where);
		$query = $this->db->get('pcms_irn_detail');

		return $query->result_array();
	}

	public function update_data_pcms_irn_detail($data, $where)
	{
		$query = $this->db->where($where);
		$query = $this->db->update('pcms_irn_detail', $data);
	}


	public function insert_data_irn_dc($form_data)
	{
		$this->db->insert('pcms_irn_dc', $form_data);
	}

	public function insert_data_irn_punchlist($form_data)
	{
		$this->db->insert('pcms_irn_punchlist', $form_data);
	}

	public function get_data_irn_dc($where)
	{
		$query = $this->db->where($where);
		$query = $this->db->get('pcms_irn_dc');

		return $query->result_array();
	}

	public function get_data_irn_punchlist($where)
	{
		$query = $this->db->where($where);
		$query = $this->db->get('pcms_irn_punchlist');

		return $query->result_array();
	}

	public function irn_report_list($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}

		$this->db->select('MAX(id_irn) AS id_irn, jt.project, jt.discipline, jt.module, jt.type_of_module, wp.company_id, report_number');
		$this->db->from('pcms_irn irn');
		$this->db->join('pcms_joint jt', 'jt.id = irn.id_joint');
		$this->db->join('pcms_workpack wp', 'wp.id = jt.workpack_id');
		$this->db->where('report_number IS NOT NULL');
		$this->db->group_by('jt.project, jt.discipline, jt.module, jt.type_of_module, wp.company_id, report_number');
		$this->db->order_by('report_number');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function piecemark_itr_list($where = null, $order_by = null)
	{
		$query = $this->db->select("itr.*, pc.*, pcms_workpack.company_id AS company_id");
		if (isset($where)) {
			$query = $this->db->where($where);
		}

		if (isset($order_by)) {
			$query = $this->db->order_by($order_by);
		}

		$query = $this->db->from('pcms_itr itr');
		$query = $this->db->join('pcms_piecemark pc', 'pc.id = itr.id_piecemark');

		$query = $this->db->join('(SELECT id, company_id FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = itr.id_workpack');


		$query = $this->db->get();
		return $query->result_array();
	}

	function mwtr_approval_list($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("
		max(a.id) as id,
		max(b.status_inspection) as status_inspection,
		a.project,
		a.discipline,  
		a.module,
		a.type_of_module, 
		c.company_id_wp,
		a.drawing_no,
		max(b.submission_id) as submission_id,
		b.uniq_id,
		max(c.company_id_wp)  as company_id_wp,
		max(b.client_remarks)  as client_remarks,
		max(b.postpone_reoffer_no)  as postpone_reoffer_no,
		c.company_id_wp AS company_id,
		max(a.test_pack_no) AS test_pack_no,
	");
		$query = $this->db->group_by("
		a.project,
		a.discipline,
		a.module,
		a.type_of_module,  
		c.company_id_wp,
		a.drawing_no,
		b.uniq_id,
	");
		$query = $this->db->join('(SELECT id, company_id as company_id_wp FROM pcms_workpack where status not in (0,3)) c', 'c.id = a.workpack_id', "LEFT");
		$query = $this->db->join('pcms_mwtr_signed b', 'a.id = b.id_joint');
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}

	function show_pcms_piecemark_wp($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("a.*,b.company_id as company_id_wp");
		$query = $this->db->join('pcms_workpack b', 'b.id = a.workpack_id');
		$query = $this->db->get('pcms_piecemark a');
		return $query->result_array();
	}

	function show_pcms_joint_wp($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->select("a.*,b.company_id as company_id_wp");
		$query = $this->db->join('pcms_workpack b', 'b.id = a.workpack_id');
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}

	public function insert_pcms_mwtr_sign_data($form_data)
	{
		$this->db->insert('pcms_mwtr_signed', $form_data);
	}

	function mwtr_data_list($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}

		$query = $this->db->join('(SELECT id, company_id FROM pcms_workpack) c', 'c.id = a.workpack_id');
		$query = $this->db->join('pcms_mwtr_signed b', 'a.id = b.id_joint');
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}

	function show_data_irn_joint_mwtr_data($where = null)
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
				d.id_ndt as id_ndt,
				d.joint_id as id_joint_ndt,
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
				a.joint_type AS joint_type,

				f.id_baa as id_baa,
				f.id_joint as id_joint_baa,
				f.submission_id as submission_id_baa,
				f.report_number as report_number_baa,
				f.status_inspection as status_inspection_baa,
			");
		$query = $this->db->order_by("a.id", "desc");
		// IRN
		$query = $this->db->join('(SELECT uniq_id, submission_id, drawing_no as drawing_no_wtr_sign, id_joint, status_deleted as status_deleted_wtr_sign FROM pcms_mwtr_signed) g', 'a.id = g.id_joint', "LEFT");
		// IRN
		$query = $this->db->join('(SELECT id_irn,id_joint,submission_id,report_number,status_inspection,smoe_approval_by,smoe_approval_date,smoe_remarks,client_approval_by,client_approval_date,client_remarks FROM pcms_irn) e', 'a.id = e.id_joint', "LEFT");
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

	public function get_last_submission_id_company_based_mwtr($project_code, $discipline, $mod_id, $type_of_module, $company_id)
	{
		$this->db->select('pcms_mwtr_signed.submission_id');
		$this->db->where('pcms_mwtr_signed.project', $project_code);
		$this->db->where('pcms_mwtr_signed.discipline', $discipline);
		$this->db->where('pcms_mwtr_signed.module', $mod_id);
		$this->db->where('pcms_mwtr_signed.type_of_module', $type_of_module);
		$this->db->where('pcms_mwtr_signed.submission_id IS NOT NULL', NULL);
		$this->db->where('pcms_workpack.company_id', $company_id);
		$this->db->limit(1);
		$this->db->order_by('pcms_mwtr_signed.submission_id', "DESC");

		$this->db->join('pcms_joint', 'pcms_joint.id = pcms_mwtr_signed.id_joint');
		$this->db->join('(SELECT id, company_id FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = pcms_joint.workpack_id');
		return $this->db->get("pcms_mwtr_signed")->result_array();
	}

	function update_wtr_signed_data($where, $data)
	{
		$this->db->where($where);
		$this->db->update('pcms_mwtr_signed', $data);
	}

	function check_data_mwtr_sign($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$this->db->join('pcms_joint', 'pcms_joint.id = pcms_mwtr_signed.id_joint');
		$query = $this->db->get('pcms_mwtr_signed');
		return $query->result_array();
	}

	public function mwtr_signed_list($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}

		$this->db->from('pcms_mwtr_signed');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function wtr_all($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->select('
    	jt.drawing_no, 
    	MAX(wtr.uniq_id) AS uniq_id, 
    	wtr.ecodoc_no, 
    	wtr.book_volume,
    	MAX(jt.project) AS project,
			MAX(jt.discipline) AS discipline,
			MAX(jt.module) AS module,
			MAX(jt.type_of_module) AS type_of_module,
    ');
		$this->db->from('pcms_joint jt');
		$this->db->join('pcms_mwtr_signed wtr', 'jt.id = wtr.id_joint', 'LEFT');
		$this->db->group_by('jt.drawing_no, wtr.ecodoc_no, wtr.book_volume');
		$query = $this->db->get();
		return $query->result_array();
	}

	function pcms_ndt_type_joint($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_ndt');
		return $query->result_array();
	}

	public function wtr_add_job_number($data, $where)
	{
		$this->db->where($where);
		$this->db->update("pcms_joint", $data);
	}

	public function mwtr_notification($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->select("
			project,
			discipline,  
			module,
			type_of_module,
			drawing_no,  
			company_id,
			MAX(retransmit_by) AS transmittal_by, 
			MAX(retransmit_date) AS transmittal_datetime, 
			MAX(status_invitation) AS status_invitation, 
			MAX(legend_inspection_auth) AS legend_inspection_auth,
			MAX(status_inspection) AS status_inspection,
			max(inspection_by) 	as inspection_by, 
			max(inspection_datetime) as inspection_datetime, 
			max(client_inspection_by) as inspection_client_by, 
			max(client_inspection_date) as inspection_client_datetime,

			");
		$query = $this->db->group_by("project_code,discipline,module,type_of_module,report_number,company_id");
		$query = $this->db->order_by("report_number", "asc");
		$query = $this->db->get('pcms_fitup');
		return $query->result_array();
	}

	function mwtr_list_notification($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		
	// 	$query = $this->db->select("
	// 	max(a.id) as id,
	// 	max(b.status_inspection) as status_inspection,
	// 	a.project,
	// 	a.discipline,  
	// 	a.module,
	// 	a.type_of_module, 
	// 	c.company_id,
	// 	a.drawing_no,
	// 	max(b.submission_id) as submission_id,
	// 	b.uniq_id,
	// 	max(b.client_remarks)  as client_remarks,
	// 	max(b.postpone_reoffer_no)  as postpone_reoffer_no,
	// 	c.company_id AS company_id,
	// ");
	// 	$query = $this->db->group_by("
	// 	a.project,
	// 	a.discipline,
	// 	a.module,
	// 	a.type_of_module,  
	// 	c.company_id,
	// 	a.drawing_no,
	// 	b.uniq_id,
	// ");
	// 	$query = $this->db->join('pcms_workpack  c', 'c.id = a.workpack_id', "LEFT");
	// 	$query = $this->db->join('pcms_mwtr_signed b', 'a.id = b.id_joint');
	// 	$query = $this->db->get('pcms_joint a');
	// 	return $query->result_array();

	$query = $this->db->select("

			max(submission_id) as submission_id,
			project,
			uniq_id,
			drawing_no,
			discipline,  
			module,
			type_of_module, 
			company_id,
			rfi_inspect_by,
			rfi_submitted_date,
			rfi_inspect_area,
			rfi_inspect_location,
			max(client_remarks)  as client_remarks,
			max(postpone_reoffer_no)  as postpone_reoffer_no,

			");
		$query = $this->db->group_by("project,drawing_no,discipline,module,type_of_module,company_id,uniq_id, rfi_inspect_by, rfi_submitted_date, rfi_inspect_area, rfi_inspect_location");
		$query = $this->db->order_by("company_id", "asc");
		$query = $this->db->get('pcms_mwtr_signed');
		return $query->result_array();
	}

	function company_joint()
	{
		$query = $this->db->select(" 
		 	company_id,
		 ");
		$this->db->where("status_delete", 1);
		$this->db->group_by("company_id");
		$query = $this->db->get('pcms_joint');
		return $query->result_array();
	}

}
/*
	End Model Auth_mod
*/