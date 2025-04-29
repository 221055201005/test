<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ndt_mod extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		//$this->db_eng = $this->load->database('db_eng', TRUE);
		$this->db_eng = $this->load->database('db_eng_mysql', TRUE);
		$this->db_portal = $this->load->database('db_portal', TRUE);
	}

	function ndt_list($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->order_by('id', 'DESC');
		$query = $this->db->order_by('ndt_type', 'DESC');
		$query = $this->db->get('pcms_ndt');
		return $query->result_array();
	}

	function pcms_ndt_all($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_ndt_all');
		return $query->result_array();
	}

	function pcms_ndt_all_nowelder($where = null)
	{
		$this->db->select('id_visual, id_joint, result, ndt_type, submission_id, report_number, rfi_no, report_no, date_of_inspection, tested_length, transmit_date, tested_date, tested_by, status_inspection');
		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->group_by('id_visual, id_joint, result, ndt_type, submission_id, report_number, rfi_no, report_no, date_of_inspection, tested_length, transmit_date, tested_date, tested_by, status_inspection');
		$query = $this->db->get('pcms_ndt_all');
		return $query->result_array();
	}

	function pcms_ndt_all_nowelder_attachment($where = null)
	{
		$this->db->select('id_visual, id_joint, result, ndt_type, submission_id, report_number, rfi_no, report_no, date_of_inspection, tested_length, transmit_date, tested_date, tested_by, status_inspection');
		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->group_by('id_visual, id_joint, result, ndt_type, submission_id, report_number, rfi_no, report_no, date_of_inspection, tested_length, transmit_date, tested_date, tested_by, status_inspection');
		$query = $this->db->get('pcms_ndt_atc');
		return $query->result_array();
	}

	function ndt_list_v2($where = null)
	{
		$this->db->select('pcms_ndt.*, pcms_visual.project_code');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->order_by('id', 'DESC');
		$query = $this->db->order_by('ndt_type', 'DESC');
		$query = $this->db->join('pcms_visual', 'pcms_ndt.id_visual=pcms_visual.id_visual');
		$query = $this->db->get('pcms_ndt');
		return $query->result_array();
	}

	function revise_history_list_v2($where = null)
	{
		$this->db->select('
			MAX(c.drawing_no) AS drawing_no,
			MAX(b.discipline) AS discipline,
			MAX(b.module) AS module,
			MAX(b.report_number) AS report_number,
			a.submission_id,
			c.drawing_no,
			request_by,
			request_date,
			request_reason,
			a.id,
			MAX(ndt_type) AS ndt_type,
		');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->from('pcms_revise_history as a');
		$query = $this->db->join('pcms_ndt as b', 'a.submission_id=b.submission_id');
		$query = $this->db->join('pcms_visual as c', 'b.id_visual=c.id_visual');
		$query = $this->db->join('(SELECT id AS id_wp, company_id FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id_wp = c.id_workpack');
		$this->db->group_by('
			a.submission_id,
			c.drawing_no,
			request_by,
			request_date,
			request_reason,
			a.id
		');
		return $query->get()->result_array();
	}

	function attachment_grouping($where = null)
	{
		$this->db->select('
			ndt_type,
			report_number,
			discipline,
			module,
			type_of_module,
		');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->from('pcms_ndt_attachment');
		$this->db->group_by('
			ndt_type,
			report_number,
			discipline,
			module,
			type_of_module,
		');
		return $query->get()->result_array();
	}

	function ndt_vt_wp_list($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->order_by('pn.id', 'DESC');
		$query = $this->db->order_by('ndt_type', 'DESC');
		$query = $this->db->join('pcms_ndt pn', 'pn.id_visual = pv.id_visual', 'left');
		$query = $this->db->join('pcms_workpack pw', 'pw.id = pv.id_workpack', 'left');
		$query = $this->db->get('pcms_visual pv');
		return $query->result_array();
	}

	function ndt_report_detail($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_ndt_detail');
		return $query->result_array();
	}

	function master_weld_process($where = null, $or_where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		if (isset($or_where)) {
			$this->db->or_where($or_where);
		}
		$query = $this->db->get('master_weld_process');
		return $query->result_array();
	}

	function ndt_list_general($where = null)
	{
		$query = $this->db->select('
			a.*,
			b.project_code,
			b.discipline,
			b.type_of_module,
			b.module,
			b.id_joint,
			b.drawing_no
		');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->join('pcms_visual b', 'a.id_visual = b.id_visual');
		$query = $this->db->get('pcms_ndt a');
		return $query->result_array();
	}

	function ndt_visual_list($where = null)
	{
		$query = $this->db->select('
			*,
			a.id AS id_ndt,
			a.created_date AS ndt_created_date,
			a.created_by AS ndt_created_by,
			b.remarks AS remarks,
			a.inspection_datetime AS ndt_inspection_datetime,
			b.drawing_wm AS visual_drawing_wm,
			a.location_v2 AS location_v2,
			a.area_v2 AS area_v2,
			a.point_v2 AS point_v2,
		');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->where("c.status_delete", 1);
		$query = $this->db->join('pcms_visual b', 'a.id_visual = b.id_visual');
		$query = $this->db->join('pcms_joint c', 'b.id_joint = c.id');
		$query = $this->db->join('(SELECT id AS id_wp, company_id FROM pcms_workpack) d', 'b.id_workpack = d.id_wp');
		$query = $this->db->order_by("CAST(c.joint_no AS TEXT)", "ASC", FALSE);
		$query = $this->db->get('pcms_ndt a');

		return $query->result_array();
	}

	function ndt_visual_list_v2($where = null)
	{
		$query = $this->db->select('
			a.*,
			b.*,
			c.*,
			a.id AS id_ndt,
			a.created_date AS ndt_created_date,
			a.created_by AS ndt_created_by,
			b.remarks AS remarks,
			a.inspection_datetime AS ndt_inspection_datetime,
			b.drawing_wm AS visual_drawing_wm,
			a.location_v2 AS location_v2,
			a.area_v2 AS area_v2,
			a.point_v2 AS point_v2,
			d.status_inspection AS irn_status_inspection,
			e.validator_auth,
		');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->join('pcms_visual b', 'a.id_visual = b.id_visual');
		$query = $this->db->join('pcms_joint c', 'b.id_joint = c.id');

		$query = $this->db->join('pcms_irn d', 'c.id = d.id_joint', 'LEFT');
		$query = $this->db->join('pcms_irn_drawing_status e', 'd.submission_id = e.submission_id AND e.drawing_no=c.drawing_no', 'LEFT');

		$query = $this->db->order_by("CAST(c.joint_no AS TEXT)", "ASC", FALSE);
		$query = $this->db->get('pcms_ndt a');

		return $query->result_array();
	}

	// ===============================================================================
	// ===============================================================================
	// ===============================================================================
	function submit_ndt_list($where = null)
	{
		$query = $this->db->select('
			drawing_no, 
			discipline,
			module,
			a.report_number as report_number,
			a.date_of_inspection,
			a.ndt_type,
			a.submission_id,
			smoe_approval_status,
			client_approval_status,
			type_of_module,
			project_code,
			request_for_update,
			MAX(result) AS result,
			MAX(created_by) AS created_by,
			MAX(created_date) AS created_date,
			MAX(drawing_rev_no) AS drawing_rev_no,
			MAX(total_item) AS total_item,
			MAX(vendor_created_by) AS vendor_created_by,
			MAX(id_vendor) AS id_vendor,
			MAX(vendor_created_datetime) AS vendor_created_datetime,
			MAX(status_revise) AS status_revise,
		');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->join('pcms_visual b', 'a.id_visual = b.id_visual');
		$query = $this->db->join('(
			SELECT status_revise , submission_id
			from pcms_revise_history
			WHERE status_revise IN (0, 1, 3)
		) c', 'a.submission_id = c.submission_id', 'LEFT');
		$query = $this->db->from('(select 
			MIN(result) AS result,
			MAX(id_visual) AS id_visual,
			MAX(report_number) AS report_number,
			MAX(date_of_inspection) AS date_of_inspection,
			MAX(ndt_type) AS ndt_type,
			MAX(submission_id) AS submission_id, 
			MAX(smoe_approval_status) AS smoe_approval_status,
			MAX(client_approval_status) AS client_approval_status,
			MAX(request_for_update) AS request_for_update,
			MAX(created_by) AS created_by,
			MAX(created_date) AS created_date,
			COUNT(module) AS total_item,
			MAX(approval_by) AS vendor_created_by,
			MAX(approval_datetime) AS vendor_created_datetime,
			MAX(id_vendor) AS id_vendor
				FROM pcms_ndt 
			GROUP BY submission_id
		) a');
		$query = $this->db->group_by('drawing_no, discipline, module, a.report_number, a.date_of_inspection, ndt_type, a.submission_id, smoe_approval_status, client_approval_status, type_of_module, project_code, request_for_update');
		$query = $this->db->order_by("a.report_number", "DESC", FALSE);
		return $query->get()->result_array();
	}

	var $column_order_ndt_submit    = array(
		'CAST(project_code AS varchar)',
		'CAST(a.report_number AS varchar)',
		'CAST(drawing_no AS varchar)',
		'CAST(discipline AS varchar)',
		'CAST(project_code AS varchar)',
		'CAST(module AS varchar)',
		'CAST(type_of_module AS varchar)',
		'CAST(id_vendor AS varchar)',
		'CAST(date_of_inspection AS varchar)',
		'CAST(result AS varchar)',
		'CAST(a.submission_id AS varchar)',
		'CAST(a.submission_id AS varchar)',
	);
	var $column_search_ndt_submit  	= array(
		'CAST(a.report_number AS varchar)',
		'CAST(drawing_no AS varchar)',
		'CAST(date_of_inspection AS varchar)',
	);
	var $order_ndt_submit          	= array('report_number' => 'DESC');

	public function serverside_ndt_submit($where = NULL)
	{
		$this->_serverside_ndt_submit($where);
		if ($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	public function count_serverside_ndt_submit_all($where = NULL)
	{
		$this->_query_serverside_ndt_submit($where);
		return $this->db->count_all_results();
	}

	public function count_serverside_ndt_submit_filtered($where = NULL)
	{
		$this->_serverside_ndt_submit($where);
		$query = $this->db->get();
		return $query->num_rows();
	}

	private function _serverside_ndt_submit($where = NULL)
	{
		$this->_query_serverside_ndt_submit($where);
		$i = 0;
		foreach ($this->column_search_ndt_submit as $item) {
			if ($_POST['search']['value']) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if (count($this->column_search_ndt_submit) - 1 == $i) {
					$this->db->group_end();
				}
			}
			$i++;
		}
		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order_ndt_submit[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order_ndt_submit)) {
			$order = $this->order_ndt_submit;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	private function _query_serverside_ndt_submit($where = NULL)
	{
		$this->db->select('
			drawing_no,
			b.discipline,
			b.module,
			a.report_number as report_number,
			a.date_of_inspection,
			a.ndt_type,
			a.submission_id,
			smoe_approval_status,
			client_approval_status,
			a.type_of_module,
			b.project_code,
			request_for_update,
			MAX(result) AS result,
			MAX(created_by) AS created_by,
			MAX(created_date) AS created_date,
			MAX(drawing_rev_no) AS drawing_rev_no,
			COUNT(drawing_no) AS total_item,
			MAX(a.approval_by) AS vendor_created_by,
			MAX(id_vendor) AS id_vendor,
			MAX(a.approval_datetime) AS vendor_created_datetime,
			MAX(pcms_workpack.company_id) AS company_id,
			MAX(c.test_pack_no) AS test_pack_no,
		');
		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->where("c.status_delete", 1);
		$this->db->join('pcms_visual b', 'a.id_visual = b.id_visual');
		$this->db->join('(SELECT id, company_id FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = b.id_workpack');

		$this->db->join('(SELECT id, test_pack_no, status_delete FROM pcms_joint) c', 'c.id = b.id_joint');
		$this->db->from('pcms_ndt a');
		$this->db->group_by('
			b.drawing_no,
			b.discipline,
			b.module,
			a.report_number,
			a.date_of_inspection,
			a.ndt_type,
			a.submission_id,
			a.smoe_approval_status,
			a.client_approval_status,
			a.type_of_module,
			b.project_code,
			request_for_update,
		');
	}

	// ======================================================================================
	// ======================================================================================
	// ======================================================================================

	public function company_registered()
	{
		$query = $this->db->select('company_id');
		$query = $this->db->group_by('company_id');
		$query = $this->db->from('pcms_workpack');
		$query = $this->db->where('company_id IS NOT NULL');
		return $query->get()->result_array();
	}

	function ndt_detail($where = null)
	{
		$query = $this->db->select('
			
			a.report_number as report_number,
			a.date_of_inspection as date_of_inspection,
			a.ndt_type,
			a.id,
			a.submission_id,
			a.result as result,
			a.approval_by,
			a.approval_datetime,
			a.remarks,
			a.pwht_status,
			a.tested_length AS tested_length,
			a.reject_length_rh AS reject_length_rh,
			a.reject_length_fc AS reject_length_fc,
			a.visual_transmittal_no AS visual_transmittal_no,
			a.inspection_datetime AS publish_week,
			a.created_date AS created_date,
			a.inspection_note AS inspection_note,
			a.re_request AS re_request,
			a.id_vendor AS id_vendor,

			b.revision as revision,
			b.revision_category as revision_category,
			b.weld_datetime AS weld_datetime,
			b.length_of_weld AS length_of_weld,
			b.project_code,
			b.type_of_module,
			b.process_gtaw_rh,
			b.process_gmaw_rh,
			b.process_smaw_rh,
			b.process_fcaw_rh,
			b.process_saw_rh,
			b.process_gtaw_fc,
			b.process_gmaw_fc,
			b.process_smaw_fc,
			b.process_fcaw_fc,
			b.process_saw_fc,
			b.welder_ref_rh,
			b.welder_ref_fc,
			b.wps_no_rh,
			b.wps_no_fc,
			b.area,
			b.status_inspection,
			b.inspection_datetime AS visual_inspection_date,
			b.report_number AS visual_report_number,
			b.cons_lot_no AS cons_lot_no,
			b.id_visual AS id_visual,

			c.joint_type as joint_type,
			c.joint_no,
			c.diameter as diameter,
			c.sch as sch,
			c.thickness as thickness,
			c.weld_length as total_length,
			c.class as class,
			c.drawing_wm,
			c.drawing_no,
			c.discipline,
			c.module,
			c.deck_elevation,
			c.weld_type,
			c.rev_wm,

			d.company_id AS company_id,

			e.status_inspection AS irn_status_inspection,
            e.report_number as irn_report_no,

            f.validator_auth,
			');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->where("c.status_delete", 1);
		$query = $this->db->join('pcms_visual b', 'a.id_visual = b.id_visual');
		$query = $this->db->join('pcms_joint c', 'c.id = b.id_joint');
		$query = $this->db->join('pcms_workpack d', 'c.workpack_id = d.id');

		$query = $this->db->join('pcms_irn e', 'c.id = e.id_joint', 'LEFT');
		$query = $this->db->join('pcms_irn_drawing_status f', 'e.submission_id = f.submission_id AND f.drawing_no=c.drawing_no', 'LEFT');

		$query = $this->db->from('pcms_ndt a');
		$query = $this->db->order_by("a.report_number", "DESC");
		return $query->get()->result_array();
	}

	function ndt_detail_new($where = null, $group_by = NULL)
	{
		$query = $this->db->select('
			a.id,
			a.submission_id,
			a.report_number as report_number,
			a.date_of_inspection as date_of_inspection,
			a.ndt_type,
			a.result as result,
			a.approval_by,
			a.approval_datetime,
			a.remarks,
			a.pwht_status,
			a.tested_length,
			a.smoe_approval_status,
			a.client_approval_status,
			a.visual_transmittal_no as ndt_rfi,
			a.density_iqi,
			a.density_max,
			a.density_min,
			a.sensitivity,
			a.discontinue_type,
			a.smoe_approval_remarks,
			a.smoe_approval_by,
			a.client_approval_remarks,
			a.client_approval_by,
			a.smoe_approval_date,
			a.client_approval_date,
			a.created_by,
			a.created_date,

			b.id_visual as id_visual,
			b.project_code as project_code,
			b.revision as revision,
			b.revision_category as revision_category,
			b.process_gtaw_rh as gtaw,
			b.process_gmaw_rh as gmaw,
			b.process_smaw_rh as smaw,
			b.process_fcaw_rh as fcaw,
			b.process_saw_rh as saw,
			b.welder_ref_rh as welder,
			b.project_code,

			c.drawing_wm,
			c.drawing_no,
			c.discipline,
			c.module,
			c.joint_no,
			c.joint_type as joint_type,
			c.diameter as diameter,
			c.sch as sch,
			c.thickness as thickness,
			c.weld_length as total_length,
			c.class as class,
			c.type_of_module as type_of_module,

			d.ctq_id as id_deffect,
			d.length as deffect_length,
			d.welder as deffect_welder,
			d.planarity as deffect_planar,
			d.datum as datum,

			');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->join('pcms_visual b', 'a.id_visual = b.id_visual');
		$query = $this->db->join('pcms_joint c', 'c.id = b.id_joint');
		$query = $this->db->join('pcms_ctq_reject d', 'd.ndt_id = a.id', 'LEFT');
		$query = $this->db->from('pcms_ndt a');
		if (isset($group_by)) {
			$this->db->group_by($group_by);
		}
		return $query->get()->result_array();
	}

	function ndt_rfi_number($where = null, $group_by = NULL)
	{
		$query = $this->db->select('
			MAX(a.visual_transmittal_no) as ndt_rfi,
			a.ndt_type,
			c.discipline,
			c.module,
			c.type_of_module,
			d.company_id,
			');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->join('pcms_visual b', 'a.id_visual = b.id_visual', 'LEFT');
		$query = $this->db->join('pcms_joint c', 'c.id = b.id_joint', 'LEFT');
		$query = $this->db->join('pcms_workpack d', 'd.id = c.workpack_id', 'LEFT');
		$query = $this->db->from('pcms_ndt a');
		if (isset($group_by)) {
			$this->db->group_by($group_by);
		}
		return $query->get()->result_array();
	}

	function ndt_report_number($where = null, $group_by = NULL)
	{
		$query = $this->db->select('
			MAX(a.report_number) as report_number,
			a.ndt_type,
			c.discipline,
			c.module,
			c.type_of_module
			');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->join('pcms_visual b', 'a.id_visual = b.id_visual', 'LEFT');
		$query = $this->db->join('pcms_joint c', 'c.id = b.id_joint', 'LEFT');
		$query = $this->db->from('pcms_ndt a');
		if (isset($group_by)) {
			$this->db->group_by($group_by);
		}
		return $query->get()->result_array();
	}

	function update_ndt_detail($where, $set)
	{
		$this->db->where($where);
		$this->db->update('pcms_ndt_detail', $set);
	}

	function revise_history_list($where = null)
	{
		$this->db->select('*');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->from('pcms_revise_history');
		return $query->get()->result_array();
	}

	function update_ndt($where, $set)
	{
		$this->db->where($where);
		$this->db->update('pcms_ndt', $set);
	}

	function master_ndt($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_ndt_type');
		return $query->result_array();
	}

	function master_class($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_class');
		return $query->result_array();
	}

	function master_company($where = null)
	{
		if (isset($where)) {
			$this->db_portal->where($where);
		}
		$query = $this->db_portal->get('portal_company');
		return $query->result_array();
	}

	function ndt_ctq_reject($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_ctq_reject');
		return $query->result_array();
	}

	function master_ctq($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_ctq');
		return $query->result_array();
	}

	function drawing_list($where = null)
	{
		if (isset($where)) {
			$this->db_eng->where($where);
		}
		$query = $this->db_eng->get('pcms_eng_activity');
		return $query->result_array();
	}

	function user_list($where = null)
	{
		if (isset($where)) {
			$this->db_portal->where($where);
		}
		$query = $this->db_portal->get('portal_user_db');
		return $query->result_array();
	}

	function visual_overall_list($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}

		$query = $this->db->order_by("CAST(a.joint_no AS text)", "ASC", FALSE);
		$query = $this->db->join('pcms_visual b', 'a.id = b.id_joint', "LEFT");
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}

	function visual_ready_to_vendor_list($where = null, $having = NULL)
	{

		// $query = $this->db->select("
		// 	*,
		// 	now()::timestamp,
		// 	b.inspection_by AS visual_inspection_by,
		// 	b.inspection_datetime AS visual_inspection_date,
		// 	b.location AS visual_location,
		// 	DATE_PART('day', now()::timestamp - b.time_inspect::timestamp) * 24 + 
		//  DATE_PART('hour', now()::timestamp - b.time_inspect::timestamp) AS dif_hours
		// ");

		$query = $this->db->select("
			ndt_transmittal_datetime, 
			ndt_rt, 
			ndt_mt, 
			ndt_ut, 
			ndt_pa_ut, 
			ndt_ht, 
			ndt_ft, 
			ndt_pt, 
			ndt_pmi, 
			ndt_pwht, 
			b.drawing_no, 
			b.id_visual,  
			b.project_code, 
			b.type_of_module, 
			b.discipline, 
			b.report_number, 
			postpone_reoffer_no, 
			status_inspection, 
			revision_status_inspection, 
			status_invitation, 
			id_joint, 
			revision, 
			revision_category, 
			welder_ref_rh, 
			welder_ref_fc, 
			length_of_weld, 
			weld_datetime, 
			area_v2, 
			location_v2, 

			now()::timestamp,
			b.inspection_by AS visual_inspection_by,
			b.inspection_datetime AS visual_inspection_date,
			b.location AS visual_location,
			DATE_PART('day', now()::timestamp - b.time_inspect::timestamp) * 24 + 
              	DATE_PART('hour', now()::timestamp - b.time_inspect::timestamp) AS dif_hours
		");

		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->where('status_inspection >= 3');
		$query = $this->db->order_by("CAST(a.joint_no AS text)", "ASC", FALSE);
		$query = $this->db->join('pcms_visual b', 'a.id = b.id_joint', 'LEFT');
		$query = $this->db->where('b.id_visual NOT IN (SELECT id_visual from pcms_ndt WHERE result!=4 group by id_visual)');
		if (isset($having)) {
			$query = $this->db->having($having);
		}
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}

	function visual_submitted_to_vendor_list_and_process($where = null)
	{
		$query = $this->db->select("
			result
			,status_inspection
			,revision_category
			,revision
			,welder_ref_rh
			,welder_ref_fc
			,id_joint
			,length_of_weld
			,weld_datetime
			,ndt_transmittal_datetime
			,ndt_rt
			,ndt_mt
			,ndt_ut
			,ndt_pa_ut
			,ndt_ht
			,ndt_ft
			,ndt_pt
			,ndt_pmi
			,ndt_pwht
			,joint_no
			,b.report_number
			,b.discipline
			,b.project_code
			,b.type_of_module
			,b.status_invitation
			,c.visual_transmittal_no,
			MAX(b.time_inspect) AS visual_inspection_datetime,
			DATE_PART('day', now()::timestamp - MAX(b.time_inspect)::timestamp) * 24 + 
          	DATE_PART('hour', now()::timestamp - MAX(b.time_inspect)::timestamp) AS dif_hours
		");
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->order_by("CAST(a.joint_no AS text)", "ASC", FALSE);
		$query = $this->db->join('pcms_visual b', 'a.id = b.id_joint');
		$query = $this->db->join('pcms_ndt c', 'b.id_visual = c.id_visual');
		// $query = $this->db->where('(b.ndt_rt>0 OR b.ndt_mt>0 OR b.ndt_ut>0 OR b.ndt_pa_ut>0 OR b.ndt_ht>0 OR b.ndt_ft>0 OR b.ndt_pt>0 OR b.ndt_pmi>0 OR b.ndt_pwht>0)');
		$query = $this->db->group_by("
			result
			,status_inspection
			,revision_category
			,revision
			,welder_ref_rh
			,welder_ref_fc
			,id_joint
			,length_of_weld
			,weld_datetime
			,ndt_transmittal_datetime
			,ndt_rt
			,ndt_mt
			,ndt_ut
			,ndt_pa_ut
			,ndt_ht
			,ndt_ft
			,ndt_pt
			,ndt_pmi
			,ndt_pwht
			,joint_no
			,b.report_number
			,b.discipline
			,b.project_code
			,b.type_of_module
			,b.status_invitation
			,c.visual_transmittal_no
		");
		$query = $this->db->from('pcms_joint a')->get();
		return $query->result_array();
	}

	function visual_submitted_to_vendor_list_and_process_where_or_where($where = null, $or_where = null)
	{
		$query = $this->db->select("
			result
			,status_inspection
			,revision_category
			,revision
			,welder_ref_rh
			,welder_ref_fc
			,id_joint
			,length_of_weld
			,weld_datetime
			,ndt_transmittal_datetime
			,ndt_rt
			,ndt_mt
			,ndt_ut
			,ndt_pa_ut
			,ndt_ht
			,ndt_ft
			,ndt_pt
			,ndt_pmi
			,ndt_pwht
			,joint_no
			,b.report_number
			,b.discipline
			,b.project_code
			,b.type_of_module
			,b.status_invitation
			,c.visual_transmittal_no,
			MAX(b.time_inspect) AS visual_inspection_datetime,
			DATE_PART('day', now()::timestamp - MAX(b.time_inspect)::timestamp) * 24 + 
          	DATE_PART('hour', now()::timestamp - MAX(b.time_inspect)::timestamp) AS dif_hours
		");
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		if (isset($or_where)) {
			$query = $this->db->or_where($or_where);
		}
		$query = $this->db->order_by("CAST(a.joint_no AS text)", "ASC", FALSE);
		$query = $this->db->join('pcms_visual b', 'a.id = b.id_joint');
		$query = $this->db->join('pcms_ndt c', 'b.id_visual = c.id_visual');
		$query = $this->db->group_by("
			result
			,status_inspection
			,revision_category
			,revision
			,welder_ref_rh
			,welder_ref_fc
			,id_joint
			,length_of_weld
			,weld_datetime
			,ndt_transmittal_datetime
			,ndt_rt
			,ndt_mt
			,ndt_ut
			,ndt_pa_ut
			,ndt_ht
			,ndt_ft
			,ndt_pt
			,ndt_pmi
			,ndt_pwht
			,joint_no
			,b.report_number
			,b.discipline
			,b.project_code
			,b.type_of_module
			,b.status_invitation
			,c.visual_transmittal_no
		");
		$query = $this->db->from('pcms_joint a')->get();
		return $query->result_array();
	}

	function visual_submitted_to_vendor_list($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->order_by("CAST(a.joint_no AS text)", "ASC", FALSE);
		$query = $this->db->join('pcms_visual b', 'a.id = b.id_joint');
		$query = $this->db->where('b.id_visual IN (SELECT id_visual from pcms_ndt group by id_visual)');
		$query = $this->db->where('(b.ndt_rt>0 OR b.ndt_mt>0 OR b.ndt_ut>0 OR b.ndt_pa_ut>0 OR b.ndt_ht>0 OR b.ndt_ft>0 OR b.ndt_pt>0 OR b.ndt_pmi>0 OR b.ndt_pwht>0)');
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}

	function ndt_list_overall($where = null)
	{
		$query = $this->db->select('
			a.*, 
			b.*, 
			c.*, 
			a.created_date as submit_to_vendor_date, 
			a.id as id_ndt, 
			d.company_id AS company_id,

			e.status_inspection AS irn_status_inspection,
        	f.validator_auth,
		');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->where("c.status_delete", 1);
		$query = $this->db->join('pcms_visual b', 'a.id_visual = b.id_visual');
		$query = $this->db->join('pcms_joint c', 'b.id_joint = c.id');
		$query = $this->db->join('pcms_workpack d', 'b.id_workpack = d.id', 'LEFT');

		$query = $this->db->join('pcms_irn e', 'c.id = e.id_joint', 'LEFT');
		$query = $this->db->join('pcms_irn_drawing_status f', 'e.submission_id = f.submission_id AND f.drawing_no=c.drawing_no', 'LEFT');
		$query = $this->db->get('pcms_ndt a');
		return $query->result_array();
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

	function visual_list_inspection($where = null)
	{
		$this->db->select('submission_id, discipline, module, requestor, date_request, type_of_module, drawing_no, company');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->from('pcms_visual');
		$query = $this->db->group_by('submission_id, discipline, module, requestor, date_request, type_of_module, drawing_no, company')->get();
		return $query->result_array();
	}

	function visual_list_client($where = null)
	{
		$this->db->select('discipline, module, requestor, type_of_module, drawing_no, company, report_number');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->from('pcms_visual');
		$query = $this->db->group_by('discipline, module, requestor, type_of_module, drawing_no, company, report_number')->get();
		return $query->result_array();
	}

	function master_type_of_module($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_type_of_module');
		return $query->result_array();
	}

	public function master_joint_type($where = NULL)
	{
		if ($where) {
			$query = $this->db->where($where);
		}
		$query = $this->db->get('master_joint_type');
		$query = $query->result_array();
		return $query;
	}

	function master_module($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_module');
		return $query->result_array();
	}

	function master_wps_group($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_wps');
		return $query->result_array();
	}

	function input_ndt($data)
	{
		$query = $this->db->insert('pcms_ndt', $data);
	}

	function input_batch_ndt($data)
	{
		$query = $this->db->insert_batch('pcms_ndt', $data);
	}

	function input_ndt_detail($data)
	{
		$query = $this->db->insert('pcms_ndt_detail', $data);
	}

	function delete_ctq_reject($where)
	{
		$query = $this->db->where($where);
		$query = $this->db->delete('pcms_ctq_reject');
	}

	function delete_attachment($where)
	{
		$query = $this->db->where($where);
		$query = $this->db->delete('pcms_ndt_attachment');
	}

	function input_ndt_ctq_reject($data)
	{
		$query = $this->db->insert('pcms_ctq_reject', $data);
	}

	function master_area($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_area_v2');
		return $query->result_array();
	}

	function master_location($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_location');
		return $query->result_array();
	}

	function master_welder($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_welder');
		return $query->result_array();
	}

	function welder_autocomplete($tag)
	{
		$this->db->where("wel_code LIKE '%" . $tag . "%'");
		$query = $this->db->get('pcms_welder');
		return $query->result_array();
	}

	function welder_autocomplete_new($tag, $where = NULL, $or_where = NULL)
	{
		$this->db->select('welder_code');
		if (isset($where)) {
			$this->db->where($where);
		}
		if (isset($or_where)) {
			$this->db->or_where($or_where);
		}
		$this->db->where('status_actived', '1');
		$this->db->where("(CAST(welder_code AS TEXT) ILIKE '%" . $tag . "%' OR CAST(welder_badge AS TEXT) ILIKE '%" . $tag . "%')");
		$this->db->join("master_welder_detail b", "CAST(a.id_welder AS TEXT)=CAST(b.id_welder AS TEXT)");
		$query = $this->db->group_by('welder_code');
		$query = $this->db->limit(10);
		$query = $this->db->get('master_welder a');
		return $query->result_array();
	}

	function welder_autocomplete_new_select2($tag, $where = NULL, $or_where = NULL)
	{
		$this->db->select('*');
		if (isset($where)) {
			$this->db->where($where);
		}
		if (isset($or_where)) {
			$this->db->or_where($or_where);
		}
		$this->db->where('status_actived', '1');
		$this->db->where("(CAST(welder_code AS TEXT) ILIKE '%" . $tag . "%' OR CAST(welder_badge AS TEXT) ILIKE '%" . $tag . "%')");
		$this->db->join("master_welder_detail b", "CAST(a.id_welder AS TEXT)=CAST(b.id_welder AS TEXT)");
		// $query = $this->db->group_by('welder_code');
		$query = $this->db->get('master_welder a');
		return $query->result_array();
	}

	function wps_autocomplete($tag, $or_where = NULL)
	{
		if (isset($or_where)) {
			$this->db->or_where($or_where);
		}
		$this->db->where("CAST(wps_no as TEXT) ILIKE '%" . $tag . "%'");
		$query = $this->db->join('master_wps_detail b', 'a.id_wps = CAST(b.id_main as integer)');
		$query = $this->db->get('master_wps a');
		return $query->result_array();
	}

	function master_discipline($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_discipline');
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

	function master_weld_type($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_weld_type');
		return $query->result_array();
	}

	function master_project($where = null)
	{
		if (isset($where)) {
			$this->db_portal->where($where);
		}
		$this->db_portal->where_in('id', project_app());
		$query = $this->db_portal->get('portal_project');
		return $query->result_array();
	}

	function get_last_rn($where = null)
	{
		$this->db->select('drawing_no');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->from('pcms_visual');
		$query = $this->db->group_by('drawing_no, discipline, module, type_of_module, report_number');
		return $query->get()->result_array();
	}

	function get_last_submission($where = null)
	{
		$this->db->select('drawing_no');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->from('pcms_visual');
		$query = $this->db->group_by('drawing_no, discipline, module, type_of_module');
		return $query->get()->result_array();
	}

	public function approval_inspection($set, $where)
	{
		$this->db->where($where);
		$this->db->update('pcms_visual', $set);
	}

	public function delete_inspection($where)
	{
		$this->db->where($where);
		$this->db->delete('pcms_visual');
	}

	function attachment_add($data)
	{
		$query = $this->db->insert('pcms_ndt_attachment', $data);
	}

	function ndt_attachment_list($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_ndt_attachment');
		return $query->result_array();
	}

	function visual_attachment_list($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_visual_attachment');
		return $query->result_array();
	}

	public function ftp_find_master($ip_source)
	{
		$this->db_portal->where('server_source', $ip_source);
		return $this->db_portal->get('portal_ftp_server')->result_array();
	}

	public function ndt_report_with_attachment($where = NULL)
	{
		$query = $this->db->select("
			a.ndt_type,
			b.project_code,
			a.report_number,
			b.drawing_no,
			b.discipline,
			b.module,
			b.type_of_module,
			c.deck_elevation,
			a.inspection_by,
			a.inspection_datetime,
			a.result,
			a.inspection_authority,
			a.inspection_invitation_type
		");
		$query = $this->db->join('pcms_ndt a', 'a.submission_id = att.submission_id');
		$query = $this->db->join('pcms_visual b', 'a.id_visual = b.id_visual');
		$query = $this->db->join('pcms_joint c', 'b.id_joint = c.id');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->from('pcms_ndt_attachment att')->get();
		return $query->result_array();
	}

	public function ndt_rfi($where = NULL)
	{
		$query = $this->db->select('
			MAX(a.inspection_invitation_type) AS inspection_invitation_type,
			MAX(a.inspection_authority) AS inspection_authority,
			MAX(b.ndt_transmittal_datetime) AS ndt_transmittal_datetime,
			MAX(b.ndt_transmittal_by) AS ndt_transmittal_by,
			MAX(c.drawing_no) AS drawing_no,
			MAX(c.drawing_wm) AS drawing_wm,
			b.discipline,
			b.module,
			b.type_of_module,
			a.ndt_type,
			a.id_vendor,
			a.visual_transmittal_no,
			d.deck_elevation,
		');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->join('pcms_visual b', 'a.id_visual = b.id_visual', 'LEFT');
		$query = $this->db->join('pcms_joint c', 'b.id_joint = c.id', 'LEFT');
		$query = $this->db->join('pcms_workpack d', 'b.id_workpack = d.id', 'LEFT');
		$query = $this->db->from('pcms_ndt a');
		$query = $this->db->group_by('
			b.discipline,
			b.module,
			b.type_of_module,
			a.ndt_type,
			a.id_vendor,
			a.visual_transmittal_no,
			d.deck_elevation, 
		');
		$query = $this->db->order_by("visual_transmittal_no", "DESC", FALSE);
		return $query->get()->result_array();
	}

	function ndt_rfi_export($where = null)
	{
		$query = $this->db->select("
				result
				,a.drawing_no
				,a.drawing_wm
				,c.id_vendor
				,c.inspection_note
				,b.module
				,status_inspection
				,revision_category
				,revision
				,welder_ref_rh
				,welder_ref_fc
				,id_joint
				,length_of_weld
				,weld_datetime
				,ndt_transmittal_datetime
				,ndt_rt
				,ndt_mt
				,ndt_ut
				,ndt_pa_ut
				,ndt_ht
				,ndt_ft
				,ndt_pt
				,ndt_pmi
				,ndt_pwht
				,joint_no
				,b.report_number
				,b.discipline
				,b.project_code
				,b.type_of_module
				,b.status_invitation
				,c.visual_transmittal_no
				,c.ndt_type
				,MAX(a.deck_elevation) AS deck_elevation,
				,MAX(a.joint_type) AS joint_type,
			");
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->where("a.status_delete", 1);
		$query = $this->db->order_by("CAST(c.visual_transmittal_no AS integer)", "ASC", FALSE);
		$query = $this->db->join('pcms_visual b', 'a.id = b.id_joint');
		$query = $this->db->join('pcms_ndt c', 'b.id_visual = c.id_visual');
		$query = $this->db->join('(SELECT id, company_id, company_yard FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = b.id_workpack');
		$query = $this->db->group_by("
				result
				,a.drawing_no
				,a.drawing_wm
				,c.id_vendor
				,c.inspection_note
				,b.module
				,status_inspection
				,revision_category
				,revision
				,welder_ref_rh
				,welder_ref_fc
				,id_joint
				,length_of_weld
				,weld_datetime
				,ndt_transmittal_datetime
				,ndt_rt
				,ndt_mt
				,ndt_ut
				,ndt_pa_ut
				,ndt_ht
				,ndt_ft
				,ndt_pt
				,ndt_pmi
				,ndt_pwht
				,joint_no
				,b.report_number
				,b.discipline
				,b.project_code
				,b.type_of_module
				,b.status_invitation
				,c.visual_transmittal_no
				,c.ndt_type
			");
		$query = $this->db->from('pcms_joint a')->get();
		return $query->result_array();
	}

	function insert_request_void($data)
	{
		$query = $this->db->insert('pcms_ndt_void', $data);
	}

	function void_list($where = null)
	{
		$query = $this->db->select("
				pcms_ndt_void.*,
				pcms_joint.project,
				pcms_workpack.company_id,
			");
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->from('pcms_ndt_void');
		$query = $this->db->join('pcms_ndt', '
				pcms_ndt_void.ndt_type = pcms_ndt.ndt_type AND
				pcms_ndt_void.visual_transmittal_no = pcms_ndt.visual_transmittal_no AND
				pcms_ndt_void.module = pcms_ndt.module AND
				pcms_ndt_void.type_of_module = pcms_ndt.type_of_module AND
				pcms_ndt_void.discipline = pcms_ndt.discipline
			');
		$query = $this->db->join('(SELECT id, project FROM pcms_joint) pcms_joint', 'pcms_ndt.joint_id = pcms_joint.id');
		$query = $this->db->join('(SELECT id_visual, id_workpack FROM pcms_visual) pcms_visual', 'pcms_ndt.id_visual = pcms_visual.id_visual');
		$query = $this->db->join('(SELECT id, company_id FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = pcms_visual.id_workpack');

		$query = $this->db->get();
		return $query->result_array();
	}

	function update_ndt_voids($where, $set)
	{
		$this->db->where($where);
		$this->db->update('pcms_ndt_void', $set);
	}

	// ======================================================================================================

	function visual_bucket_list($where = null, $having = NULL)
	{
		$query = $this->db->select("
			*,
			a.drawing_wm AS drawing_wm,
			now()::timestamp,
			b.inspection_by AS visual_inspection_by,
			b.inspection_datetime AS visual_inspection_date,
			b.location AS visual_location,
			DATE_PART('day', now()::timestamp - b.time_inspect::timestamp) * 24 + 
              	DATE_PART('hour', now()::timestamp - b.time_inspect::timestamp) AS dif_hours
		");
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->order_by("CAST(a.joint_no AS text)", "ASC", FALSE);
		$query = $this->db->join('pcms_visual b', 'a.id = b.id_joint');
		$query = $this->db->where('(b.ndt_rt>0 OR b.ndt_mt>0 OR b.ndt_ut>0 OR b.ndt_pa_ut>0 OR b.ndt_ht>0 OR b.ndt_ft>0 OR b.ndt_pt>0 OR b.ndt_pmi>0 OR b.ndt_pwht>0)');
		if (isset($having)) {
			$query = $this->db->having($having);
		}
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}

	function visual_bucket_list_v2($where = null, $having = NULL)
	{
		$query = $this->db->select("
			a.*,
			b.*,
			a.drawing_wm AS drawing_wm,
			now()::timestamp,
			b.inspection_by AS visual_inspection_by,
			b.inspection_datetime AS visual_inspection_date,
			b.location AS visual_location,
			DATE_PART('day', now()::timestamp - b.time_inspect::timestamp) * 24 + 
              	DATE_PART('hour', now()::timestamp - b.time_inspect::timestamp) AS dif_hours,
            c.status_inspection AS irn_status_inspection,
            d.validator_auth,
            e.company_id,
		");
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->where("a.status_delete", 1);
		$query = $this->db->order_by("CAST(a.joint_no AS text)", "ASC", FALSE);
		$query = $this->db->join('pcms_visual b', 'a.id = b.id_joint');
		$query = $this->db->join('(SELECT id, company_id FROM pcms_workpack) e', 'e.id = a.workpack_id');
		$query = $this->db->join('pcms_irn c', 'a.id = c.id_joint', 'LEFT');
		$query = $this->db->join('pcms_irn_drawing_status d', 'c.submission_id = d.submission_id AND d.drawing_no=a.drawing_no', 'LEFT');
		// $query = $this->db->where('(b.ndt_rt>0 OR b.ndt_mt>0 OR b.ndt_ut>0 OR b.ndt_pa_ut>0 OR b.ndt_ht>0 OR b.ndt_ft>0 OR b.ndt_pt>0 OR b.ndt_pmi>0 OR b.ndt_pwht>0)');
		if (isset($having)) {
			$query = $this->db->having($having);
		}
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}

	function visual_by_drawing($where = null)
	{
		$query = $this->db->select('
			a.drawing_no,
			a.drawing_type,
			a.project,
			a.module,
			a.discipline,
			a.type_of_module,
			COUNT(a.drawing_no) AS total_joint,
		');
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->join('pcms_visual b', 'a.id = b.id_joint', "LEFT");
		$query = $this->db->group_by('
			a.drawing_no,
			a.drawing_type,
			a.project,
			a.module,
			a.discipline,
			a.type_of_module,
		');
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}

	var $column_order_visual_by_drawing    = array(
		'CAST(a.drawing_no AS varchar)',
		'CAST(a.drawing_type AS varchar)',
		'CAST(a.project AS varchar)',
		'CAST(a.module AS varchar)',
		'CAST(a.discipline AS varchar)',
		'CAST(a.type_of_module AS varchar)',
	);
	var $column_search_visual_by_drawing  	= array(
		'CAST(a.drawing_no AS varchar)',
		'CAST(a.drawing_type AS varchar)',
		'CAST(a.project AS varchar)',
		'CAST(a.module AS varchar)',
		'CAST(a.discipline AS varchar)',
		'CAST(a.type_of_module AS varchar)',
	);
	var $order_visual_by_drawing          	= array('a.drawing_type' => 'DESC');

	public function serverside_visual_by_drawing($where = NULL)
	{
		$this->_serverside_visual_by_drawing($where);
		if ($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	public function count_serverside_visual_by_drawing_all($where = NULL)
	{
		$this->_query_serverside_visual_by_drawing($where);
		return $this->db->count_all_results();
	}

	public function count_serverside_visual_by_drawing_filtered($where = NULL)
	{
		$this->_serverside_visual_by_drawing($where);
		$query = $this->db->get();
		return $query->num_rows();
	}

	private function _serverside_visual_by_drawing($where = NULL)
	{
		$this->_query_serverside_visual_by_drawing($where);
		$i = 0;
		foreach ($this->column_search_visual_by_drawing as $item) {
			if ($_POST['search']['value']) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if (count($this->column_search_visual_by_drawing) - 1 == $i) {
					$this->db->group_end();
				}
			}
			$i++;
		}
		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order_visual_by_drawing[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order_visual_by_drawing)) {
			$order = $this->order_visual_by_drawing;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	private function _query_serverside_visual_by_drawing($where = NULL)
	{
		$this->db->select('
			a.drawing_no,
			a.drawing_type,
			a.project,
			a.module,
			a.discipline,
			a.type_of_module,
			c.company_id,
			COUNT(a.drawing_no) AS total_joint,
		');
		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->where("a.status_delete", 1);
		$this->db->from('pcms_joint a');
		$this->db->join('pcms_visual b', 'a.id = b.id_joint');
		$this->db->join('pcms_workpack c', 'c.id = a.workpack_id');
		$this->db->group_by('
			a.drawing_no,
			a.drawing_type,
			a.project,
			a.module,
			a.discipline,
			a.type_of_module,
			c.company_id,
		');
	}

	// RFI LIST SERVERSIDE START
	var $column_order_ndt_rfi    = array(
		'CAST(a.visual_transmittal_no AS TEXT)',
		'CAST(MAX(c.drawing_no) AS TEXT)',
		'CAST(MAX(c.drawing_wm) AS TEXT)',
		'CAST(MAX(discipline.discipline_name) AS TEXT)',
		'CAST(MAX(b.module) AS TEXT)',
		'CAST(MAX(b.type_of_module) AS TEXT)',
		'CAST(MAX(d.deck_elevation) AS TEXT)',
		'CAST(MAX(a.ndt_type) AS TEXT)',
		'CAST(MAX(a.id_vendor) AS TEXT)',
		'CAST(MAX(b.ndt_transmittal_datetime) AS TEXT)',
		'CAST(MAX(a.inspection_invitation_type) AS TEXT)',
		'CAST(MAX(b.ndt_transmittal_datetime) AS TEXT)',
	);
	var $column_search_ndt_rfi  	= array(
		'CAST(a.visual_transmittal_no AS TEXT)',
		'CAST(c.drawing_no AS TEXT)',
		'CAST(c.drawing_wm AS TEXT)',
		'CAST(discipline.discipline_name AS TEXT)',
		'CAST(b.module AS TEXT)',
		'CAST(b.type_of_module AS TEXT)',
		'CAST(d.deck_elevation AS TEXT)',
		'CAST(a.ndt_type AS TEXT)',
		'CAST(a.id_vendor AS TEXT)',
		'CAST(b.ndt_transmittal_datetime AS TEXT)',
		'CAST(a.inspection_invitation_type AS TEXT)',
		'CAST(b.ndt_transmittal_datetime AS TEXT)',
	);
	var $order_ndt_rfi          	= array('visual_transmittal_no' => 'DESC');

	public function serverside_ndt_rfi($where = NULL)
	{
		$this->_serverside_ndt_rfi($where);
		if ($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	public function count_serverside_ndt_rfi_all($where = NULL)
	{
		$this->_query_serverside_ndt_rfi($where);
		return $this->db->count_all_results();
	}

	public function count_serverside_ndt_rfi_filtered($where = NULL)
	{
		$this->_serverside_ndt_rfi($where);
		$query = $this->db->get();
		return $query->num_rows();
	}

	private function _serverside_ndt_rfi($where = NULL)
	{
		$this->_query_serverside_ndt_rfi($where);
		$i = 0;
		foreach ($this->column_search_ndt_rfi as $item) {
			if (@$_POST['search']['value']) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if (count($this->column_search_ndt_rfi) - 1 == $i) {
					$this->db->group_end();
				}
			}
			$i++;
		}
		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order_ndt_rfi[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order_ndt_rfi)) {
			$order = $this->order_ndt_rfi;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	private function _query_serverside_ndt_rfi($where = NULL)
	{
		$this->db->select('
			MAX(a.inspection_invitation_type) AS inspection_invitation_type,
			MAX(a.inspection_authority) AS inspection_authority,
			
			MAX(c.drawing_no) AS drawing_no,
			MAX(c.drawing_wm) AS drawing_wm,
			b.discipline,
			b.module,
			b.type_of_module,
			a.ndt_type,
			a.id_vendor,
			a.visual_transmittal_no,
			d.deck_elevation,
			d.company_id AS company_id,
			MAX(discipline.discipline_name) AS discipline_name,
			MAX(c.project) AS project,
			MAX(c.test_pack_no) AS test_pack_no,
		');
		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->where("c.status_delete", 1);
		$this->db->join('pcms_visual b', 'a.id_visual = b.id_visual');
		$this->db->join('pcms_joint c', 'b.id_joint = c.id');
		$this->db->join('master_discipline discipline', 'c.discipline = discipline.id');
		$this->db->join('pcms_workpack d', 'b.id_workpack = d.id', 'LEFT');
		$this->db->from('pcms_ndt a');
		$this->db->group_by('
			b.discipline,
			b.module,
			b.type_of_module,
			a.ndt_type,
			a.id_vendor,
			a.visual_transmittal_no,
			d.deck_elevation,
			d.company_id,
		');
		$this->db->order_by("visual_transmittal_no", "DESC", FALSE);
	}
	// RFI LIST SERVERSIDE END

	// =============================================
	// =============================================
	// =============================================
	// =============================================
	// =============================================
	var $column_order_ndt_report_attachment    = array(
		"CAST(a.ndt_type AS TEXT)",
		"CAST(b.project_code AS TEXT)",
		"CAST(a.report_number AS TEXT)",
		"CAST(b.drawing_no AS TEXT)",
		"CAST(b.discipline AS TEXT)",
		"CAST(b.module AS TEXT)",
		"CAST(b.type_of_module AS TEXT)",
		"CAST(c.deck_elevation AS TEXT)",
		"CAST(a.inspection_by AS TEXT)",
		"CAST(a.inspection_datetime AS TEXT)",
		"CAST(a.result AS TEXT)",
		"CAST(a.inspection_authority AS TEXT)",
		"CAST(a.inspection_invitation_type AS TEXT)",
	);
	var $column_search_ndt_report_attachment  	= array(
		"CAST(a.ndt_type AS TEXT)",
		"CAST(b.project_code AS TEXT)",
		"CAST(a.report_number AS TEXT)",
		"CAST(b.drawing_no AS TEXT)",
		"CAST(b.discipline AS TEXT)",
		"CAST(b.module AS TEXT)",
		"CAST(b.type_of_module AS TEXT)",
		"CAST(c.deck_elevation AS TEXT)",
		"CAST(a.inspection_by AS TEXT)",
		"CAST(a.inspection_datetime AS TEXT)",
		"CAST(a.result AS TEXT)",
		"CAST(a.inspection_authority AS TEXT)",
		"CAST(a.inspection_invitation_type AS TEXT)",
	);
	var $order_ndt_report_attachment          	= array('CAST(b.drawing_no AS TEXT)' => 'DESC');

	public function serverside_ndt_report_attachment($where = NULL)
	{
		$this->_serverside_ndt_report_attachment($where);
		if ($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	public function count_serverside_ndt_report_attachment_all($where = NULL)
	{
		$this->_query_serverside_ndt_report_attachment($where);
		return $this->db->count_all_results();
	}

	public function count_serverside_ndt_report_attachment_filtered($where = NULL)
	{
		$this->_serverside_ndt_report_attachment($where);
		$query = $this->db->get();
		return $query->num_rows();
	}

	private function _serverside_ndt_report_attachment($where = NULL)
	{
		$this->_query_serverside_ndt_report_attachment($where);
		$i = 0;
		foreach ($this->column_search_ndt_report_attachment as $item) {
			if ($_POST['search']['value']) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if (count($this->column_search_ndt_report_attachment) - 1 == $i) {
					$this->db->group_end();
				}
			}
			$i++;
		}
		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order_ndt_report_attachment[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order_ndt_report_attachment)) {
			$order = $this->order_ndt_report_attachment;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	private function _query_serverside_ndt_report_attachment($where = NULL)
	{
		$this->db->select("
			a.ndt_type,
			b.project_code,
			a.report_number,
			b.drawing_no,
			b.discipline,
			b.module,
			b.type_of_module,
			c.deck_elevation,
			a.inspection_by,
			a.inspection_datetime,
			a.result,
			a.inspection_authority,
			a.inspection_invitation_type,
			a.approval_by,
			att.filename,
		");
		$this->db->join('pcms_ndt a', 'a.submission_id = att.submission_id');
		$this->db->join('pcms_visual b', 'a.id_visual = b.id_visual');
		$this->db->join('pcms_joint c', 'b.id_joint = c.id');
		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->from('pcms_ndt_attachment att');
	}
	// =============================================
	// =============================================
	// =============================================
	// =============================================
	// =============================================

	// BUCKE LIST SERVERSIDE START
	var $column_order_bucket_list    = array(
		'CAST(b.discipline AS TEXT)',
		'CAST(b.module AS TEXT)',
		'CAST(b.type_of_module AS TEXT)',
		'CAST(a.ndt_type AS TEXT)',
		'CAST(a.id_vendor AS TEXT)',
		'CAST(a.visual_transmittal_no AS TEXT)',
		'CAST(b.discipline AS TEXT)',
		'CAST(b.module AS TEXT)',
		'CAST(b.type_of_module AS TEXT)',
		'CAST(a.ndt_type AS TEXT)',
		'CAST(a.id_vendor AS TEXT)',
		'CAST(a.visual_transmittal_no AS TEXT)',
		'CAST(d.deck_elevation AS TEXT)',
	);
	var $column_search_bucket_list  	= array(
		'CAST(b.discipline AS TEXT)',
		'CAST(b.module AS TEXT)',
		'CAST(b.type_of_module AS TEXT)',
		'CAST(a.ndt_type AS TEXT)',
		'CAST(a.id_vendor AS TEXT)',
		'CAST(a.visual_transmittal_no AS TEXT)',
		'CAST(b.discipline AS TEXT)',
		'CAST(b.module AS TEXT)',
		'CAST(b.type_of_module AS TEXT)',
		'CAST(a.ndt_type AS TEXT)',
		'CAST(a.id_vendor AS TEXT)',
		'CAST(a.visual_transmittal_no AS TEXT)',
		'CAST(d.deck_elevation AS TEXT)',
	);
	var $order_bucket_list          	= array('visual_transmittal_no' => 'DESC');

	public function serverside_bucket_list($where = NULL)
	{
		$this->_serverside_bucket_list($where);
		if ($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	public function count_serverside_bucket_list_all($where = NULL)
	{
		$this->_query_serverside_bucket_list($where);
		return $this->db->count_all_results();
	}

	public function count_serverside_bucket_list_filtered($where = NULL)
	{
		$this->_serverside_bucket_list($where);
		$query = $this->db->get();
		return $query->num_rows();
	}

	private function _serverside_bucket_list($where = NULL)
	{
		$this->_query_serverside_bucket_list($where);
		$i = 0;
		foreach ($this->column_search_bucket_list as $item) {
			if ($_POST['search']['value']) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if (count($this->column_search_bucket_list) - 1 == $i) {
					$this->db->group_end();
				}
			}
			$i++;
		}
		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order_bucket_list[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order_bucket_list)) {
			$order = $this->order_bucket_list;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	private function _query_serverside_bucket_list($where = NULL)
	{
		$this->db->select("
			result
			,status_inspection
			,revision_category
			,revision
			,welder_ref_rh
			,welder_ref_fc
			,id_joint
			,length_of_weld
			,weld_datetime
			,ndt_transmittal_datetime
			,ndt_rt
			,ndt_mt
			,ndt_ut
			,ndt_pa_ut
			,ndt_ht
			,ndt_ft
			,ndt_pt
			,ndt_pmi
			,ndt_pwht
			,joint_no
			,b.report_number
			,b.discipline
			,b.project_code
			,b.type_of_module
			,b.status_invitation
			,c.visual_transmittal_no,
			MAX(b.time_inspect) AS visual_inspection_datetime,
			DATE_PART('day', now()::timestamp - MAX(b.time_inspect)::timestamp) * 24 + 
          	DATE_PART('hour', now()::timestamp - MAX(b.time_inspect)::timestamp) AS dif_hours,
          	MAX(b.drawing_no) AS drawing_no,
          	MAX(a.drawing_wm) AS drawing_wm,
          	MAX(a.joint_no) AS joint_no,
          	MAX(a.class) AS class,
          	MAX(a.diameter) AS diameter,
          	MAX(a.thickness) AS thickness,
          	MAX(a.thickness) AS thickness,
		");
		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->order_by("CAST(a.joint_no AS text)", "ASC", FALSE);
		$this->db->join('pcms_visual b', 'a.id = b.id_joint');
		$this->db->join('pcms_ndt c', 'b.id_visual = c.id_visual');
		$this->db->group_by("
			result
			,status_inspection
			,revision_category
			,revision
			,welder_ref_rh
			,welder_ref_fc
			,id_joint
			,length_of_weld
			,weld_datetime
			,ndt_transmittal_datetime
			,ndt_rt
			,ndt_mt
			,ndt_ut
			,ndt_pa_ut
			,ndt_ht
			,ndt_ft
			,ndt_pt
			,ndt_pmi
			,ndt_pwht
			,joint_no
			,b.report_number
			,b.discipline
			,b.project_code
			,b.type_of_module
			,b.status_invitation
			,c.visual_transmittal_no
		");
		$this->db->from('pcms_joint a');
	}
	// RFI LIST SERVERSIDE END

	function ndt_detail_cc($where = null)
	{
		$query = $this->db->select('
			
			a.report_number as report_number,
			a.date_of_inspection as date_of_inspection,
			a.ndt_type,
			a.id,
			a.submission_id,
			a.result as result,
			a.remarks,
			a.pwht_status,
			a.tested_length AS tested_length,
			a.visual_transmittal_no AS visual_transmittal_no,
			a.inspection_datetime AS publish_week,
			a.created_date AS created_date,
			a.inspection_note AS inspection_note,
			a.re_request AS re_request,
			a.id_vendor AS id_vendor,
			a.status_inspection AS status_inspection_ndt,
			a.tested_by AS tested_by,

			b.revision as revision,
			b.revision_category as revision_category,
			b.weld_datetime AS weld_datetime,
			b.length_of_weld AS length_of_weld,
			b.project_code,
			b.type_of_module,
			b.weld_process_rh,
			b.weld_process_fc,
			b.wps_no_rh,
			b.wps_no_fc,
			b.area_v2,
			b.cons_lot_no,
			b.length_of_weld,
			b.status_inspection,
			b.inspection_datetime AS visual_inspection_date,
			b.report_number AS visual_report_number,
			b.cons_lot_no AS cons_lot_no,
			b.id_visual AS id_visual,

			c.joint_type as joint_type,
			c.joint_no,
			c.diameter as diameter,
			c.sch as sch,
			c.thickness as thickness,
			c.weld_length as total_length,
			c.class as class,
			c.drawing_wm,
			c.drawing_no,
			c.discipline,
			c.module,
			c.deck_elevation,
			c.weld_type,
			c.rev_wm,

			d.company_id AS company_id,
			c.company_id AS joint_company_id,

			e.status_inspection AS irn_status_inspection,
            e.report_number as irn_report_no,

            f.validator_auth,

			');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->where("c.status_delete", 1);
		$query = $this->db->join('pcms_visual b', 'a.id_visual = b.id_visual');
		$query = $this->db->join('pcms_joint c', 'c.id = b.id_joint');
		$query = $this->db->join('pcms_workpack d', 'c.workpack_id = d.id');

		$query = $this->db->join('pcms_irn e', 'c.id = e.id_joint', 'LEFT');
		$query = $this->db->join('pcms_irn_drawing_status f', 'e.submission_id = f.submission_id AND f.drawing_no=c.drawing_no', 'LEFT');
		// $query = $this->db->join('pcms_visual_detail_welder g', 'g.id_visual = b.id_visual', 'LEFT'); 

		$query = $this->db->from('pcms_ndt a');
		$query = $this->db->order_by("a.report_number", "DESC");
		return $query->get()->result_array();
	}

	function detail_welder($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_visual_detail_welder');
		return $query->result_array();
	}
}
/*
	End Model Auth_mod
*/