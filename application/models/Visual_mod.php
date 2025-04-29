<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Visual_mod extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		//$this->db_eng = $this->load->database('db_eng', TRUE);
		$this->db_eng = $this->load->database('db_eng_mysql', TRUE);
		$this->db_portal = $this->load->database('db_portal', TRUE);
	}

	function joint_list($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->where("pcms_joint.status_delete", 1);
		$query = $this->db->get('pcms_joint');
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

	function drawing_list($where = null)
	{
		if (isset($where)) {
			$this->db_eng->where($where);
		}
		$query = $this->db_eng->get('pcms_eng_activity');
		return $query->result_array();
	}

	function drawing_list_based_on_joint($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->where("pcms_joint.status_delete", 1);
		$query = $this->db->get('pcms_joint');
		return $query->result_array();
	}

	function drawing_register_validation($where = null, $limit = null)
	{
		$this->db_eng->select('id_activity, MAX(document_no) AS document_no, MAX(status) AS status');
		if (isset($where)) {
			$this->db_eng->where($where);
		}
		$this->db_eng->where("status_delete", 1);
		if (isset($limit)) {
			$this->db_eng->limit($limit);
		}
		$query = $this->db_eng->group_by('id_activity');
		$query = $this->db_eng->get('pcms_eng_drawing_register');
		return $query->result_array();
	}

	function drawing_register($where = null, $limit = null)
	{
		if (isset($where)) {
			$this->db_eng->where($where);
		}
		$this->db_eng->where("status_delete", 1);
		if (isset($limit)) {
			$this->db_eng->limit($limit);
		}
		$query = $this->db_eng->get('pcms_eng_drawing_register');
		return $query->result_array();
	}

	function autocomplete_drawing($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->select("
			pcms_joint.drawing_no,
			pcms_joint.drawing_wm,
		");
		$this->db->where("pcms_joint.status_delete", 1);
		$this->db->join('pcms_fitup', 'pcms_joint.id = pcms_fitup.id_joint', "LEFT");
		$this->db->join('(SELECT id, deck_elevation, company_id FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = pcms_fitup.id_workpack');

		$this->db->group_by("
			pcms_joint.drawing_no,
			pcms_joint.drawing_wm,
		");
		$this->db->order_by("pcms_joint.drawing_no", "asc");
		$this->db->limit(10);

		$query = $this->db->get('pcms_joint');
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
		$this->db->select('
			*,
			a.drawing_no AS drawing_no,
			a.drawing_wm AS drawing_wm,
			a.rev_wm AS rev_wm,
			a.drawing_wm AS save_drawing_wm,
			b.drawing_wm_rev AS save_drawing_wm_rev,
			a.thickness AS thickness,
			a.rev_no as rev_ga_template,
			a.rev_wm as rev_wm_template,
			b.drawing_wm_rev AS transmit_wm_rev,
			b.drawing_rev_no AS transmit_gaas_rev,
			pcms_workpack.company_id AS company_id,
		');
		if (isset($where)) {
			$query = $this->db->where($where);
		}

		$query = $this->db->order_by("a.drawing_no", "ASC", FALSE);
		$query = $this->db->order_by("a.joint_no", "ASC", FALSE);
		$query = $this->db->join('pcms_visual b', 'a.id = b.id_joint');
		$query = $this->db->where("a.status_delete", 1);
		$query = $this->db->join('(SELECT company_id, id FROM pcms_workpack) pcms_workpack', 'a.workpack_id = pcms_workpack.id');
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}

	function visual_overall_list_v2($where = null)
	{
		$this->db->select('
			*, 
			a.drawing_no AS drawing_no,
			c.company_id AS company_id, 
			a.id AS id,
			a.drawing_wm AS drawing_wm,
			a.rev_wm AS rev_wm,
			a.drawing_wm AS visual_drawing_wm,
			b.drawing_wm_rev AS visual_rev_wm,
			b.status_delete AS visual_status_delete,
			a.rev_no as rev_ga_template,
			a.rev_wm as rev_wm_template,
			b.drawing_wm_rev AS transmit_wm_rev,
			b.drawing_rev_no AS transmit_gaas_rev,
			a.drawing_no AS drawing_no,
			b.area_v2,
			b.location_v2,
			b.point_v2,
			b.remarks AS remarks,
			a.deck_elevation AS deck_elevation,
			a.module as module,
			a.discipline as discipline,
			a.type_of_module as type_of_module,
			a.spool_no as spool_no,
		');
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->order_by('b.status_inspection', "ASC", FALSE);
		$query = $this->db->order_by("a.drawing_no", "ASC", FALSE);
		$query = $this->db->order_by("a.joint_no", "ASC", FALSE);
		$query = $this->db->join('pcms_visual b', 'a.id = b.id_joint');
		$query = $this->db->join('pcms_workpack c', 'b.id_workpack = c.id');
		$query = $this->db->join('(SELECT id_joint as id_joint_irn, report_number as irn_report_no FROM pcms_irn) d', 'a.id = d.id_joint_irn', 'LEFT');
		$query = $this->db->where("a.status_delete", 1);
		$query = $this->db->get('pcms_joint a');

		return $query->result_array();
	}

	function visual_overall_list_v3($where = null, $limit = NULL)
	{
		$query = $this->db->select('
			*,
			a.drawing_no AS drawing_no,
			c.company_id AS company_id, 
			a.id AS id,
			a.drawing_wm AS drawing_wm,
			a.rev_wm AS rev_wm,
			a.drawing_wm AS visual_drawing_wm,
			b.drawing_wm_rev AS visual_rev_wm,
			b.length_of_weld AS visual_weld_length,
			b.area_v2 AS area_v2,
			b.location_v2 AS location_v2,
			b.point_v2 AS point_v2,
			b.remarks AS remarks,
			a.discipline AS discipline,
			a.module AS module,
			a.type_of_module AS type_of_module,
			a.deck_elevation AS deck_elevation,
			a.spool_no AS spool_no,
		');
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->order_by('b.status_inspection', "ASC", FALSE);
		$query = $this->db->order_by("a.drawing_no", "ASC", FALSE);
		$query = $this->db->order_by("a.joint_no", "ASC", FALSE);
		$query = $this->db->join('pcms_visual b', 'a.id = b.id_joint');
		$query = $this->db->join('pcms_workpack c', 'b.id_workpack = c.id');
		if (isset($limit)) {
			$query = $this->db->limit($limit);
		}
		$query = $this->db->where("a.status_delete", 1);
		$query = $this->db->get('pcms_joint a');

		return $query->result_array();
	}

	function production_rfi_count($where = NULL)
	{
		$this->db->select("
			COUNT(
				CASE
					WHEN status_inspection=0 AND status_surveyor ILIKE '%3%' THEN 1
				END
			) as pending,
			COUNT(
				CASE
					WHEN status_inspection=2 THEN 1
				END
			) as reject,
			COUNT(
				CASE
					WHEN status_inspection=4 THEN 1
				END
			) as pending_qc,
			COUNT(
				CASE
					WHEN status_surveyor NOT ILIKE '%3%' AND status_inspection=0 THEN 1
				END
			) as all_without_readytoinspect,
		");
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->where("b.status_delete", 1);
		$query = $this->db->join('pcms_joint b', 'b.id = a.id_joint');
		$query = $this->db->get('pcms_visual a');
		return $query->result_array();
	}

	// ------- SEVERSIDE INS RFI
	var $column_order_inspection_rfi    = array(
		'CAST(pcms_visual.submission_id AS TEXT)',
		'CAST(pcms_visual.submission_id AS TEXT)',
		'CAST(pcms_visual.discipline AS TEXT)',
		'CAST(pcms_visual.module AS TEXT)',
		'CAST(pcms_visual.requestor AS TEXT)',
		'CAST(pcms_visual.date_request AS TEXT)',
		'CAST(pcms_visual.type_of_module AS TEXT)',
		'CAST(pcms_visual.drawing_no AS TEXT)',
		'CAST(c.company_id AS TEXT)'
	);
	var $column_search_inspection_rfi  	= array(
		'CAST(pcms_visual.submission_id AS TEXT)',
		'CAST(pcms_visual.date_request AS TEXT)',
		'CAST(pcms_visual.drawing_no AS TEXT)',
	);
	var $order_inspection_rfi          	= array('pcms_visual.submission_id' => 'DESC');

	public function serverside_inspection_rfi($where)
	{
		$this->_serverside_inspection_rfi($where);
		if ($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	public function count_serverside_inspection_rfi_all($where)
	{
		$this->_query_serverside_inspection_rfi($where);
		return $this->db->count_all_results();
	}

	public function count_serverside_inspection_rfi_filtered($where)
	{
		$this->_serverside_inspection_rfi($where);
		$query = $this->db->get();
		return $query->num_rows();
	}

	private function _serverside_inspection_rfi($where)
	{
		$this->_query_serverside_inspection_rfi($where);
		$i = 0;
		foreach ($this->column_search_inspection_rfi as $item) {
			if ($_POST['search']['value']) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if (count($this->column_search_inspection_rfi) - 1 == $i) {
					$this->db->group_end();
				}
			}
			$i++;
		}
		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order_inspection_rfi[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order_inspection_rfi)) {
			$order = $this->order_inspection_rfi;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	private function _query_serverside_inspection_rfi($where)
	{
		$this->db->select('
      		MAX(workpack_no) AS workpack_no,
      		MAX(project_code) AS project_code,
      		pcms_visual.submission_id, 
	      	pcms_visual.discipline, 
	      	pcms_visual.module, 
	      	pcms_visual.requestor, 
	      	pcms_visual.type_of_module, 
	      	pcms_visual.drawing_no, 
			COUNT(pcms_visual.id_visual) AS total_joint,
			COUNT(
				CASE
					WHEN pcms_visual.status_inspection=2 THEN 1
				END

			) as total_reject,
			COUNT(
				CASE
					WHEN pcms_visual.status_inspection=3 OR pcms_visual.status_inspection=3 OR pcms_visual.status_inspection=5 OR pcms_visual.status_inspection=6 OR pcms_visual.status_inspection=7 OR pcms_visual.status_inspection=9 OR pcms_visual.status_inspection=10 OR pcms_visual.status_inspection=11 THEN 1
				END

			) as total_approve,
			COUNT(
				CASE
					WHEN pcms_visual.status_inspection=1 THEN 1
				END

			) as total_pending,
			COUNT(
				CASE
					WHEN pcms_visual.status_inspection=4 THEN 1
				END

			) as total_pending_qc,
			COUNT(
				CASE
					WHEN pcms_visual.status_inspection=6 THEN 1
				END

			) as total_reject_client,
			COUNT(
				CASE
					WHEN pcms_visual.status_inspection=7 THEN 1
				END

			) as total_approve_client,
			MAX(pcms_visual.replacing_visual_id) AS replacing_visual_id,
			MAX(pcms_visual.date_request) AS date_request,
			MAX(pcms_visual.id_joint) AS id_joint,
			MAX(c.company_id) AS company_id,
			MAX(b.rev_no) AS revision_drawing_no,
			MAX(b.deck_elevation) AS deck_elevation,
			MAX(b.test_pack_no) AS test_pack_no,
		');
		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->where("b.status_delete", 1);
		$this->db->join('pcms_joint b', 'b.id = pcms_visual.id_joint');
		$this->db->join('pcms_workpack c', 'b.workpack_id = c.id');

		$this->db->from('pcms_visual');
		$this->db->group_by('pcms_visual.submission_id, pcms_visual.discipline, pcms_visual.module, pcms_visual.requestor, pcms_visual.type_of_module, pcms_visual.drawing_no, c.company_id');
		// $this->db->order_by('pcms_visual.date_request DESC');
	}

	// cl
	var $column_order_client_rfi    = array(
		'CAST(a.report_number AS varchar)', 'CAST(a.report_number AS varchar)', 'CAST(a.drawing_no AS varchar)', 'CAST(a.discipline AS varchar)', 'CAST(a.module AS varchar)', 'CAST(a.type_of_module AS varchar)', 'CAST(deck_elevation AS varchar)', 'CAST(postpone_reoffer_no AS varchar)', 'CAST(inspection_by AS varchar)', 'CAST(inspection_datetime AS varchar)', 'CAST(status_inspection AS varchar)', 'CAST(status_invitation AS varchar)'
	);

	var $column_search_client_rfi  	= array(
		'CAST(a.project_code AS varchar)', 'CAST(a.report_number AS varchar)', 'CAST(a.drawing_no AS varchar)', 'CAST(inspection_datetime AS varchar)'
	);

	var $column_order_client_summary_rfi    = array(
		'CAST(a.report_number AS varchar)', 'CAST(a.report_number AS varchar)', 'CAST(a.report_number AS varchar)', 'CAST(a.drawing_no AS varchar)', 'CAST(a.discipline AS varchar)', 'CAST(a.module AS varchar)', 'CAST(a.type_of_module AS varchar)', 'CAST(deck_elevation AS varchar)', 'CAST(postpone_reoffer_no AS varchar)', 'CAST(inspection_by AS varchar)', 'CAST(inspection_datetime AS varchar)', 'CAST(status_inspection AS varchar)', 'CAST(status_invitation AS varchar)', 'CAST(status_invitation AS varchar)'
	);

	var $column_search_client_summary_rfi  	= array(
		'CAST(a.report_number AS varchar)', 'CAST(a.report_number AS varchar)', 'CAST(a.drawing_no AS varchar)', 'CAST(inspection_datetime AS varchar)'
	);

	var $order_client_rfi          	= array('a.report_number' => 'DESC');

	public function serverside_client_rfi($where = NULL)
	{
		$this->_serverside_client_rfi($where);
		if ($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		// test_var($this->db);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function count_serverside_client_rfi_all($where = NULL)
	{
		$this->_query_serverside_client_rfi($where);
		return $this->db->count_all_results();
	}

	public function count_serverside_client_rfi_filtered($where = NULL)
	{
		$this->_serverside_client_rfi($where);
		$query = $this->db->get();
		return $query->num_rows();
	}

	private function _serverside_client_rfi($where = NULL)
	{
		$this->_query_serverside_client_rfi($where);
		$i = 0;
		foreach ($this->column_search_client_rfi as $item) {
			if ($_POST['search']['value']) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if (count($this->column_search_client_rfi) - 1 == $i) {
					$this->db->group_end();
				}
			}
			$i++;
		}
		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order_client_rfi[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order_client_rfi)) {
			$order = $this->order_client_rfi;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	private function _query_serverside_client_rfi($where = NULL)
	{
		// here
		// test_var($where);

		$this->db->select('
    		a.report_number,
    		MAX(c.drawing_no) AS drawing_no,
    		a.discipline,
    		a.module,
    		a.type_of_module,
    		a.company,
    		a.project_code,
    		COUNT(a.id_visual) AS total_joint,
    		COUNT(
				CASE
					WHEN a.status_inspection=5 THEN 1
				END

				) as total_pending_client,
				COUNT(
					CASE
						WHEN a.status_inspection=6 THEN 1
					END

				) as total_reject_client,
				COUNT(
					CASE
						WHEN a.status_inspection=7 THEN 1
					END

				) as total_approve_client,

				COUNT(
					CASE
						WHEN a.status_inspection=9 THEN 1
					END

				) as total_acc_comment_client,
				COUNT(
					CASE
						WHEN a.status_inspection=10 THEN 1
					END

				) as total_postpone_client,
				COUNT(
					CASE
						WHEN a.status_inspection=11 THEN 1
					END

				) as total_reoffer_client,
				a.status_invitation,
				a.legend_inspection_auth,
				a.postpone_reoffer_no,
				MAX(a.add_comment) AS add_comment,
				MIN(a.status_inspection) AS status_inspection,
				MAX(a.inspection_by) AS inspection_by,
				MIN(a.inspection_by) AS inspection_by,
				MAX(a.inspection_datetime) AS inspection_datetime,
				MIN(a.inspection_datetime) AS inspection_datetime,
				MAX(c.deck_elevation) AS deck_elevation,
				MAX(a.transmittal_datetime) AS transmittal_datetime,
				MAX(a.time_inspect) AS time_inspect,
				MAX(a.latest_inspection_status) AS latest_inspection_status,
				MAX(a.submission_id) AS max_submission_id,
				MIN(a.submission_id) AS min_submission_id,

				c.company_id,
    	');
		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->where("c.status_delete", 1);
		$this->db->join('pcms_workpack b', 'b.id = a.id_workpack');
		$this->db->join('pcms_joint c', 'c.id = a.id_joint');
		$this->db->from('pcms_visual a');

		if ($where['a.project_code'] == 21) {
			$this->db->group_by('
					a.report_number,
					a.discipline,
					a.module,
					a.type_of_module,
					a.company,
					a.project_code,
					a.status_invitation,
					a.legend_inspection_auth,
					a.postpone_reoffer_no,
					c.company_id,
					c.deck_elevation,
					a.inspection_by,
					a.inspection_datetime,
					a.status_inspection
				');
		} else {
			$this->db->group_by('
					a.report_number,
					a.discipline,
					a.module,
					a.type_of_module,
					a.company,
					a.project_code,
					a.status_invitation,
					a.legend_inspection_auth,
					a.postpone_reoffer_no,
					c.company_id,
					a.inspection_by,
					a.inspection_datetime,
					a.status_inspection
				');
		}

		// $this->db->order_by('a.report_number DESC','a.postpone_reoffer_no DESC');
	}

	public function serverside_client_summary_rfi($where = NULL)
	{
		$this->_serverside_client_summary_rfi($where);
		if ($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	public function count_serverside_client_summary_rfi_all($where = NULL)
	{
		$this->db->select('
      		a.report_number,
      		a.drawing_no,
      		a.discipline,
      		a.module,
      		a.type_of_module,
      		MAX(a.company) AS company,
      		a.project_code,
			c.company_id,
      		COUNT(a.id_visual) AS total_joint,
      		COUNT(
				CASE
					WHEN a.status_inspection=5 THEN 1
				END

			) as total_pending_client,
			COUNT(
				CASE
					WHEN a.status_inspection=6 THEN 1
				END

			) as total_reject_client,
			COUNT(
				CASE
					WHEN a.status_inspection=7 THEN 1
				END

			) as total_approve_client,

			COUNT(
				CASE
					WHEN a.status_inspection=9 THEN 1
				END

			) as total_acc_comment_client,
			COUNT(
				CASE
					WHEN a.status_inspection=10 THEN 1
				END

			) as total_postpone_client,
			COUNT(
				CASE
					WHEN a.status_inspection=11 THEN 1
				END

			) as total_reoffer_client,
			COUNT(
				CASE
					WHEN a.status_inspection=12 THEN 1
				END

			) as total_void_visual,
			MIN(a.status_inspection) AS status_inspection,
			a.status_invitation,
			a.legend_inspection_auth,
			a.postpone_reoffer_no,
			MAX(a.inspection_by) AS inspection_by,
			MAX(a.inspection_datetime) AS inspection_datetime,
			MAX(b.deck_elevation) AS deck_elevation,
			MAX(time_inspect) AS time_inspect, 
      	');
		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->from('pcms_visual a');
		$this->db->join('pcms_workpack b', 'b.id = a.id_workpack');
		$this->db->join('pcms_joint c', 'c.id = a.id_joint');
		if ($where['a.project_code'] == 21) {
			$this->db->group_by('
								a.report_number,
								  a.drawing_no,
								  a.discipline,
								  a.module,
								  a.type_of_module,
								  a.project_code,
								  a.status_invitation,
								  a.legend_inspection_auth,
								  a.postpone_reoffer_no,
								  c.company_id,
								  b.deck_elevation
							  ');
		} else {
			$this->db->group_by('
								a.report_number,
								  a.drawing_no,
								  a.discipline,
								  a.module,
								  a.type_of_module,
								  a.project_code,
								  a.status_invitation,
								  a.legend_inspection_auth,
								  a.postpone_reoffer_no,
								  c.company_id
							  ');
		}
		return $this->db->count_all_results();
	}

	public function count_serverside_client_summary_rfi_filtered($where = NULL)
	{
		$this->_serverside_client_summary_rfi($where);
		$query = $this->db->get();
		return $query->num_rows();
	}

	private function _serverside_client_summary_rfi($where = NULL)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		// test_var($where);
		$this->db->select('
      		a.report_number,
      		a.drawing_no,
      		a.discipline,
      		a.module,
      		a.type_of_module,
      		MAX(a.company) AS company,
      		a.project_code,
      		COUNT(a.id_visual) AS total_joint,
      		COUNT(
				CASE
					WHEN a.status_inspection=5 THEN 1
				END

			) as total_pending_client,
			COUNT(
				CASE
					WHEN a.status_inspection=6 THEN 1
				END

			) as total_reject_client,
			COUNT(
				CASE
					WHEN a.status_inspection=7 THEN 1
				END

			) as total_approve_client,

			COUNT(
				CASE
					WHEN a.status_inspection=9 THEN 1
				END

			) as total_acc_comment_client,
			COUNT(
				CASE
					WHEN a.status_inspection=10 THEN 1
				END

			) as total_postpone_client,
			COUNT(
				CASE
					WHEN a.status_inspection=11 THEN 1
				END

			) as total_reoffer_client,
			COUNT(
				CASE
					WHEN a.status_inspection=12 THEN 1
				END

			) as total_void_visual,
			MIN(a.status_inspection) AS status_inspection,
			a.status_invitation,
			a.legend_inspection_auth,
			a.postpone_reoffer_no,
			MAX(a.inspection_by) AS inspection_by,
			MAX(a.inspection_datetime) AS inspection_datetime,
			MAX(c.deck_elevation) AS deck_elevation,
			MAX(time_inspect) AS time_inspect,
			MAX(b.company_id) AS company_id,
      	');

		$this->db->from('pcms_visual a');
		$this->db->join('pcms_workpack b', 'b.id = a.id_workpack');
		$this->db->join('pcms_joint c', 'c.id = a.id_joint');

		if ($where['a.project_code'] == 21) {
			// test_var(1);
			$this->db->group_by('
			a.report_number,
	  		a.drawing_no,
	  		a.discipline,
	  		a.module,
	  		a.type_of_module,
	  		a.project_code,
	  		a.status_invitation,
	  		a.legend_inspection_auth,
			a.postpone_reoffer_no,
			c.deck_elevation,
			a.inspection_by,
			a.inspection_datetime,
			a.status_inspection
		  ');
		} else {
			// test_var(2);

			$this->db->group_by('
			a.report_number,
			a.drawing_no,
			a.discipline,
			a.module,
			a.type_of_module,
			a.project_code,
			a.status_invitation,
			a.legend_inspection_auth,
			a.postpone_reoffer_no,
			a.inspection_by,
			a.inspection_datetime,
			a.status_inspection
			');
		}
		// test_var($where['a.project_code']);

		$i = 0;
		foreach ($this->column_search_client_rfi as $item) {
			if ($_POST['search']['value']) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if (count($this->column_search_client_rfi) - 1 == $i) {
					$this->db->group_end();
				}
			}
			$i++;
		}
		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order_client_summary_rfi[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order_client_rfi)) {
			$order = $this->order_client_rfi;
			$this->db->order_by(key($order), $order[key($order)]);
		} else {
			$this->db->order_by('a.report_number ASC');
		}
	}

	private function _query_serverside_client_summary_rfi($where)
	{
		// here
		$this->db->select('
      		a.report_number,
      		a.drawing_no,
      		a.discipline,
      		a.module,
      		a.type_of_module,
      		a.company,
      		a.project_code,
      		COUNT(a.id_visual) AS total_joint,
      		COUNT(
				CASE
					WHEN a.status_inspection=5 THEN 1
				END

			) as total_pending_client,
			COUNT(
				CASE
					WHEN a.status_inspection=6 THEN 1
				END

			) as total_reject_client,
			COUNT(
				CASE
					WHEN a.status_inspection=7 THEN 1
				END

			) as total_approve_client,

			COUNT(
				CASE
					WHEN a.status_inspection=9 THEN 1
				END

			) as total_acc_comment_client,
			COUNT(
				CASE
					WHEN a.status_inspection=10 THEN 1
				END

			) as total_postpone_client,
			COUNT(
				CASE
					WHEN a.status_inspection=11 THEN 1
				END

			) as total_reoffer_client,
			MIN(a.status_inspection) AS status_inspection,
			a.status_invitation,
			a.legend_inspection_auth,
			a.postpone_reoffer_no,
			MAX(a.inspection_by) AS inspection_by,
			MAX(a.inspection_datetime) AS inspection_datetime,
			MAX(b.deck_elevation) AS deck_elevation,
      	');
		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->from('pcms_visual a');
		$this->db->join('pcms_workpack b', 'b.id = a.id_workpack');
		$this->db->group_by('
							a.report_number,
				      		a.drawing_no,
				      		a.discipline,
				      		a.module,
				      		a.type_of_module,
				      		a.company,
				      		a.project_code,
				      		a.status_invitation,
				      		a.legend_inspection_auth,
				      		a.postpone_reoffer_no,
				      	');
		// $this->db->order_by('a.report_number ASC');
	}

	public function counting_inspec($where = NULL)
	{
		// here
		$this->db->select('
      		submission_id
			discipline,
			module,
			type_of_module,
			drawing_no,
			company_id,
      		COUNT(
				CASE
					WHEN status_inspection=2 THEN 1
				END

			) as total_reject,
			COUNT(
				CASE
					WHEN status_inspection>=3 AND status_inspection!=4 THEN 1
				END

			) as total_approve,
			COUNT(
				CASE
					WHEN status_inspection=1 THEN 1
				END

			) as total_pending,
			COUNT(
				CASE
					WHEN status_inspection=4 THEN 1
				END

			) as total_pending_qc,
      	');
		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->from('pcms_visual');
		$this->db->group_by('
							submission_id
							,discipline
							,module
							,type_of_module
							,drawing_no
							,company_id
				      	');
		return $this->db->get()->result_array();
	}

	public function counting_inspec_v2($where = NULL)
	{
		// here
		$this->db->select('
      		
      		COUNT(
				CASE
					WHEN status_inspection=2 THEN 1
				END

			) as reject,
			COUNT(
				CASE
					WHEN status_inspection=2 AND status_delete IS NULL THEN 1
				END

			) as reject_fresh,
			COUNT(
				CASE
					WHEN status_inspection>=3 AND status_inspection!=4 THEN 1
				END

			) as approve,
			COUNT(
				CASE
					WHEN status_inspection=1 THEN 1
				END

			) as pending,
			COUNT(
				CASE
					WHEN status_inspection=4 THEN 1
				END

			) as total_pending_qc,
      	');
		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->from('pcms_visual');
		$this->db->join('(SELECT id AS id_wp, company_id from pcms_workpack) pcms_workpack', 'pcms_visual.id_workpack = pcms_workpack.id_wp');

		return $this->db->get()->result_array();
	}

	// ------- SEVERSIDE END

	function visual_ready_to_client_drawing($where = NULL)
	{
		$this->db->select('
    		COUNT(project_code) AS total,
			project_code,
			drawing_no,
			discipline,
			module,
			type_of_module
		');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->from('pcms_visual');
		$query = $this->db->group_by('
			project_code,
			drawing_no,
			discipline,
			module,
			type_of_module
		');
		$query = $this->db->get();
		return $query->result_array();
	}

	function visual_ready_to_client_drawing_v2($where = NULL)
	{
		$this->db->select('
    		COUNT(visual.project_code) AS total,
			visual.project_code,
			visual.drawing_no,
			b.drawing_wm,
			visual.discipline,
			visual.module,
			visual.type_of_module,
			MAX(workpack.company_id) AS company_id,
		');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->where("b.status_delete", 1);
		$query = $this->db->join('pcms_joint b', 'b.id = visual.id_joint');
		$query = $this->db->join('pcms_workpack workpack', 'workpack.id = b.workpack_id');
		$query = $this->db->from('pcms_visual visual');
		$query = $this->db->group_by('
			visual.project_code,
			visual.drawing_no,
			b.drawing_wm,
			visual.discipline,
			visual.module,
			visual.type_of_module
		');
		$query = $this->db->get();
		return $query->result_array();
	}

	function visual_ready_to_client_drawing_v3($where = NULL)
	{
		$this->db->select('
    		COUNT(visual.project_code) AS total,
			visual.project_code,
			visual.drawing_no,
			b.drawing_wm,
			b.deck_elevation,
			visual.discipline,
			visual.module,
			visual.type_of_module,
			MAX(workpack.company_id) AS company_id,
		');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->where("b.status_delete", 1);
		$query = $this->db->join('pcms_joint b', 'b.id = visual.id_joint');
		$query = $this->db->join('pcms_workpack workpack', 'workpack.id = b.workpack_id');
		$query = $this->db->from('pcms_visual visual');
		$query = $this->db->group_by('
			visual.project_code,
			visual.drawing_no,
			b.drawing_wm,
			visual.discipline,
			visual.module,
			visual.type_of_module,
			b.deck_elevation,
		');
		$query = $this->db->get();
		return $query->result_array();
	}

	function visual_ready_to_client_list($where = null, $group_by = NULL)
	{
		$this->db->select("
			a.drawing_no, 
			a.drawing_wm, 
			a.discipline, 
			a.module, 
			b.report_number, 
			b.id_visual, 
			b.status_inspection, 
			b.submission_id, 
			b.type_of_module, 
			b.id_joint, 
			a.rev_no as rev_ga_template,
		 	a.rev_wm as rev_wm_template,
			joint_no, 
			revision, 
			revision_category, 
			class, 
			weld_type, 
			cons_lot_no, 
			diameter, 
			thickness, 
			length_of_weld, 
			weld_datetime, 
			inspection_by, 
			inspection_datetime, 
			b.location_v2, 
			inspection_client_by, 
			inspection_client_datetime,  
			client_remarks,
			id_workpack,
			workpack.company_id,
			b.wps_no_rh AS wps_no_rh,
			b.wps_no_fc AS wps_no_fc,
			a.joint_type AS joint_type,
			a.deck_elevation as deck_elevation
		");

		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->join('pcms_visual b', 'a.id = b.id_joint');
		$query = $this->db->join('pcms_workpack workpack', 'workpack.id = a.workpack_id');
		$query = $this->db->where("a.status_delete", 1);
		$query = $this->db->from('pcms_joint a');
		$query = $this->db->order_by('b.drawing_no ASC');
		$query = $this->db->order_by('a.joint_no ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	function visual_ready_to_client_list_v2($where = null, $group_by = NULL)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		// $query = $this->db->order_by("CAST(a.joint_no AS integer)","ASC", FALSE);
		$query = $this->db->join('pcms_visual', 'a.id = pcms_visual.id_joint');
		$query = $this->db->where("a.status_delete", 1);
		$query = $this->db->from('pcms_joint a');
		$query = $this->db->order_by('pcms_visual.drawing_no ASC');
		$query = $this->db->order_by('a.joint_no ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	function visual_ready_to_client_list_v4($where = null, $group_by = NULL)
	{
		$this->db->select("replacing_visual_id");
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		// $query = $this->db->order_by("CAST(a.joint_no AS integer)","ASC", FALSE);
		$query = $this->db->join('pcms_visual', 'a.id = pcms_visual.id_joint');
		$query = $this->db->where("a.status_delete", 1);
		$query = $this->db->from('pcms_joint a');
		$query = $this->db->order_by('pcms_visual.drawing_no ASC');
		$query = $this->db->order_by('a.joint_no ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	function visual_ready_to_client_list_v3($where = null, $group_by = NULL)
	{
		$query = $this->db->select("
			*,
			a.drawing_wm AS drawing_wm,
			");
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		// $query = $this->db->order_by("CAST(a.joint_no AS integer)","ASC", FALSE);
		$query = $this->db->join('pcms_visual', 'a.id = pcms_visual.id_joint');
		$query = $this->db->where("a.status_delete", 1);
		$query = $this->db->from('pcms_joint a');
		$query = $this->db->order_by('pcms_visual.drawing_no ASC');
		$query = $this->db->order_by('a.joint_no ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	function visual_postpone_reoffer($where = null, $having = null)
	{
		$this->db->select('
				b.drawing_no,
				b.project_code,
				b.discipline,
				b.module,
				b.type_of_module,
				b.report_number,

				b.postpone_reoffer_no,
				b.status_invitation,
				b.legend_inspection_auth,
				COUNT(CASE WHEN b.status_inspection = 5 THEN 1 END ) as total_pending_client,
				COUNT(CASE WHEN b.status_inspection = 6 THEN 1 END ) as total_reject_client,
				COUNT(CASE WHEN b.status_inspection = 7 THEN 1 END ) as total_approve_client,
				COUNT(CASE WHEN b.status_inspection = 9 THEN 1 END ) as total_acc_comment_client,
				COUNT(CASE WHEN b.status_inspection = 10 THEN 1 END ) as total_postpone_client,
				COUNT(CASE WHEN b.status_inspection = 11 THEN 1 END ) as total_reoffer_client,

				MIN(status_inspection) AS status_inspection_min,
				MAX(status_inspection) AS status_inspection_max,
				
				MAX(workpack.company_id) AS company_id,
				a.deck_elevation,
			');
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->join('pcms_visual b', 'a.id = b.id_joint');
		$query = $this->db->join('(SELECT company_id, id FROM pcms_workpack) workpack', 'a.workpack_id = workpack.id');
		$query = $this->db->where("a.status_delete", 1);
		$query = $this->db->from('pcms_joint a');
		$query = $this->db->order_by('b.report_number ASC');
		$query = $this->db->order_by('b.postpone_reoffer_no ASC');

		$query = $this->db->group_by('
				b.drawing_no,
				b.project_code,
				b.discipline,
				b.module,
				b.type_of_module,
				b.report_number,
				
				b.postpone_reoffer_no,
				b.status_invitation,
				b.legend_inspection_auth,

				a.deck_elevation,
			');
		// if (isset($having)) {
		// 	$having = $this->db->having($having);
		// }

		$this->db->having("
	
		COUNT(CASE WHEN status_inspection = 5 THEN 1 END) = 0 
		AND COUNT(CASE WHEN status_inspection IN (6,9,10,11) THEN 1 END) > 0 
		");

		$query = $this->db->get();
		return $query->result_array();
	}


	function visual_list($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->order_by("id_visual", "DESC");
		$query = $this->db->get('pcms_visual');
		return $query->result_array();
	}

	function visual_list_joint_workpack($where = null)
	{
		$query = $this->db->select('
		pcms_visual.*,
		joint.*, 
		workpack.company_id AS company_id');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->order_by("id_visual", "DESC");
		$query = $this->db->from('pcms_visual');
		$this->db->where("joint.status_delete", 1);
		$this->db->join('pcms_joint joint', 'joint.id = pcms_visual.id_joint');
		$this->db->join('pcms_workpack workpack', 'workpack.id = joint.workpack_id');
		return $query->get()->result_array();
	}

	function visual_list_v2($where = null)
	{
		$query = $this->db->select('
			pcms_visual.*, 
			workpack.company_id AS company_id,
			joint.deck_elevation,
			joint.status_delete,

		
			');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->order_by("id_visual", "DESC");
		$query = $this->db->from('pcms_visual');
		$this->db->where("joint.status_delete", 1);
		$this->db->join('pcms_joint joint', 'joint.id = pcms_visual.id_joint');
		$this->db->join('pcms_workpack workpack', 'workpack.id = joint.workpack_id');
		return $query->get()->result_array();
	}

	function last_revision($where = null)
	{
		$this->db->select('MAX(revision) as revision');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->from('pcms_visual');
		$query = $this->db->order_by("revision", "DESC");
		return $query->get()->result_array();
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
		$this->db->select('submission_id, discipline, module, requestor, date_request, type_of_module, drawing_no, company, 
			COUNT(id_visual) AS total_joint,
			COUNT(
				CASE
					WHEN status_inspection=2 THEN 1
				END

			) as total_reject,
			COUNT(
				CASE
					WHEN status_inspection=3 OR status_inspection=5 OR status_inspection=6 OR status_inspection=7 THEN 1
				END

			) as total_approve,
			COUNT(
				CASE
					WHEN status_inspection=1 THEN 1
				END

			) as total_pending,
			COUNT(
				CASE
					WHEN status_inspection=6 THEN 1
				END

			) as total_reject_client,
			COUNT(
				CASE
					WHEN status_inspection=7 THEN 1
				END

			) as total_approve_client');
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

	function visual_group_by_drawing($where = null)
	{
		$this->db->select('pcms_visual.drawing_no');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->from('pcms_visual');
		$query = $this->db->join('(SELECT id AS id_wp, company_id FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id_wp = pcms_visual.id_workpack');
		$query = $this->db->group_by('pcms_visual.drawing_no')->get();
		return $query->result_array();
	}

	function first_app_date($where = null)
	{
		$this->db->select('
			pcms_visual.discipline, 
			pcms_visual.module, 
			pcms_visual.requestor, 
			pcms_visual.type_of_module, 
			pcms_visual.drawing_no, 
			pcms_visual.company, 
			pcms_visual.report_number, 
			MIN(
				CASE
					WHEN pcms_visual.document_approval_date IS NOT NULL
					THEN pcms_visual.document_approval_date
					ELSE pcms_visual.inspection_datetime
				END
			) AS first_app_date
		');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->join('pcms_joint a', 'a.id = pcms_visual.id_joint');
		$query = $this->db->from('pcms_visual');
		$query = $this->db->group_by('pcms_visual.discipline, pcms_visual.module, pcms_visual.requestor, pcms_visual.type_of_module, pcms_visual.drawing_no, pcms_visual.company, pcms_visual.report_number')->get();
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

	function master_report_no($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_report_no');
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

	function master_module($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_module');
		return $query->result_array();
	}

	function master_ndt($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_ndt_type');
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

	function input_visual($data)
	{
		$query = $this->db->insert('pcms_visual', $data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}

	function master_area($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_area');
		return $query->result_array();
	}

	function master_area_v2($where = null)
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

	function master_location_v2($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_location_v2');
		return $query->result_array();
	}

	function master_point_v2($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_point');
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

	function master_welder_new($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_welder');
		return $query->result_array();
	}

	function master_weld_process($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_weld_process');
		return $query->result_array();
	}

	function master_joint_type($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_joint_type');
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
		$query = $this->db->get('master_wps');
		return $query->result_array();
	}
	function master_wps_detail($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_wps_detail');
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
		$this->db->select('MAX(report_number)');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->from('pcms_visual');
		//$query = $this->db->group_by('drawing_no, discipline, module, type_of_module, report_number');
		return $query->get()->result_array();
	}

	function get_last_rn_joint_workpack($where = null)
	{
		$this->db->select('MAX(report_number)');
		$this->db->join('pcms_joint joint', 'joint.id = pcms_visual.id_joint');
		// $this->db->where("joint.status_delete", 1);
		$this->db->join('pcms_workpack workpack', 'workpack.id = joint.workpack_id');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->from('pcms_visual');
		//$query = $this->db->group_by('drawing_no, discipline, module, type_of_module, report_number');
		return $query->get()->result_array();
	}

	function get_last_submission($where = null)
	{
		//$this->db->select('drawing_no');
		$this->db->select('submission_id AS max');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->from('pcms_visual');
		// $query = $this->db->group_by('drawing_no, discipline, module, type_of_module');
		$query = $this->db->order_by('submission_id', 'desc');
		$query = $this->db->limit('1');
		return $query->get()->result_array();
	}

	public function pcms_visual_detail_welder($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->where("status_delete", 0);
		$query = $this->db->get('pcms_visual_detail_welder');
		return $query->result_array();
	}
	public function update_pcms_visual_detail_welder($set, $where)
	{
		$this->db->where($where);
		$this->db->update('pcms_visual_detail_welder', $set);
	}

	public function approval_inspection($set, $where)
	{
		$this->db->where($where);
		$this->db->update('pcms_visual', $set);
	}

	public function update_revise_history($set, $where)
	{
		$this->db->where($where);
		$this->db->update('pcms_revise_history', $set);
	}

	public function delete_inspection($where)
	{
		$this->db->where($where);
		$this->db->delete('pcms_visual');
	}

	function attachment_history_add($data)
	{
		$query = $this->db->insert('pcms_attachment_history', $data);
	}

	function attachment_add($data)
	{
		$query = $this->db->insert('pcms_visual_attachment', $data);
	}

	function revise_history($data)
	{
		$query = $this->db->insert('pcms_revise_history', $data);
	}

	function pcms_attachment_history($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_attachment_history');
		return $query->result_array();
	}

	public function delete_attachment_history($where)
	{
		$this->db->where($where);
		$this->db->delete('pcms_attachment_history');
	}

	public function attachment_history_list_join($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}

		$this->db->select('*, history.remarks AS reject_remarks, history.created_by AS created_by, history.created_date AS created_date');
		$this->db->from('pcms_attachment_history history');
		$this->db->join('pcms_visual visual', 'visual.id_visual = history.id_process AND process = 3');
		$query = $this->db->get();
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

	function revise_history_list($where = null, $group_by = NULL)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_revise_history as a');
		return $query->result_array();
	}

	function log_history($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->from('pcms_update_revision_log as a');
		$query = $this->db->join('pcms_revise_history as b', 'a.id_request_update=b.id');
		$query = $this->db->get();
		return $query->result_array();
	}

	function template_history_list($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_update_revision_log');
		return $query->result_array();
	}

	function revise_history_list_v2($where = null)
	{
		// test_var($where);
		if ($where["category"] == 2) {
			$query = $this->db->select('
				MAX(drawing_no) AS drawing_no,
				MAX(discipline) AS discipline,
				MAX(module) AS module,

				a.submission_id,
				drawing_no,
				request_by,
				request_date,
				request_reason,
				a.id,
				MAX(b.project_code) AS project_code,
				MAX(pcms_workpack.company_id) AS company_id,
				b.report_number,
			');
			if (isset($where)) {
				$this->db->where($where);
			}
			$query = $this->db->from('pcms_revise_history as a');
			$query = $this->db->join(
				"pcms_visual as b",
				" 
		  		CAST(SPLIT_PART(a.submission_id, ';', 1) AS TEXT) = CAST(b.project_code AS TEXT) AND
		  		CAST(SPLIT_PART(a.submission_id, ';', 2) AS TEXT) = CAST(b.discipline AS TEXT) AND
		  		CAST(SPLIT_PART(a.submission_id, ';', 3) AS TEXT) = CAST(b.module AS TEXT) AND
		  		CAST(SPLIT_PART(a.submission_id, ';', 4) AS TEXT) = CAST(b.type_of_module AS TEXT) AND
		  		CAST(SPLIT_PART(a.submission_id, ';', 5) AS TEXT) = CAST(b.report_number AS TEXT) AND
		  		CAST(SPLIT_PART(a.submission_id, ';', 6) AS TEXT) = CAST(b.company_id AS TEXT)
		  	"
			);
			$query = $this->db->join('(SELECT id AS id_wp, company_id FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id_wp = b.id_workpack');
			$query = $this->db->group_by('
				a.submission_id,
				drawing_no,
				request_by,
				request_date,
				request_reason,
				a.id,
				b.report_number
			');
		} else {
			$query = $this->db->select('
				MAX(drawing_no) AS drawing_no,
				MAX(discipline) AS discipline,
				MAX(module) AS module,

				a.submission_id,
				drawing_no,
				request_by,
				request_date,
				request_reason,
				a.id,
				MAX(b.project_code) AS project_code,
				MAX(pcms_workpack.company_id) AS company_id,
			');
			if (isset($where)) {
				$this->db->where($where);
			}
			$query = $this->db->from('pcms_revise_history as a');
			$query = $this->db->join('pcms_visual as b', 'a.submission_id=b.submission_id');
			$query = $this->db->join('(SELECT id AS id_wp, company_id FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id_wp = b.id_workpack');
			$query = $this->db->group_by('
				a.submission_id,
				drawing_no,
				request_by,
				request_date,
				request_reason,
				a.id
			');
		}
		return $query->get()->result_array();
	}

	public function ftp_find_master($ip_source)
	{
		$this->db_portal->where('server_source', $ip_source);
		return $this->db_portal->get('portal_ftp_server')->result_array();
	}

	public function ftp_master($where = NULL)
	{
		if (isset($where)) {
			$this->db_portal->where($where);
		}
		return $this->db_portal->get('portal_ftp_server')->result_array();
	}

	// ----------- Approval Log ----------- //

	function add_approval_log($data)
	{
		$this->db->insert("approval_log", $data);
	}

	function search_data_approval($project_id, $process)
	{
		$query = $this->db->query("SELECT approval_project,approval_code FROM approval_log WHERE approval_project = '$project_id' AND approval_process = '$process' GROUP BY approval_project,approval_code");
		return $query->result_array();
	}

	function get_approval_log($where = NULL)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('approval_log');
		return $query->result_array();
	}

	// ----------- Approval Log ----------- //


	function get_image_from_surveyor($where = null)
	{
		$this->db->select('*');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->from('pcms_joint a');
		$query = $this->db->where("a.status_delete", 1);
		$query = $this->db->join('pcms_workpack_detail b', 'a.workpack_id = b.id_workpack');
		return $query->get()->result_array();
	}

	function workpack_all($where = null)
	{
		$this->db->select('*');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->from('pcms_workpack a');
		$query = $this->db->join('pcms_workpack_detail b', 'a.id = b.id_workpack', "LEFT");
		return $query->get()->result_array();
	}

	function pcms_workpack($where = null)
	{
		$this->db->select('*');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->from('pcms_workpack a');
		return $query->get()->result_array();
	}

	function workpack_detail_all($where = null)
	{
		$this->db->select('*');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->from('pcms_workpack_detail a');
		$query = $this->db->join('pcms_workpack b', 'b.id = a.id_workpack', LEFT);
		return $query->get()->result_array();
	}

	public function summary_rfi($where = null)
	{

		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->select('project_code, report_number, drawing_no,
			status_invitation,
		 	COUNT(id_visual) AS total_item, 
		 	COUNT(CASE WHEN status_inspection = 1 THEN id_visual END) AS total_pending_smoe,
			COUNT(CASE WHEN status_inspection = 2 THEN id_visual END) AS total_rejected_smoe,
			COUNT(CASE WHEN status_inspection = 3 THEN id_visual END) AS total_approved_smoe,
			COUNT(CASE WHEN status_inspection = 4 THEN id_visual END) AS total_hold_smoe,
			COUNT(CASE WHEN status_inspection = 5 THEN id_visual END) AS total_pending_client,
			COUNT(CASE WHEN status_inspection = 6 THEN id_visual END) AS total_rejected_client,
			COUNT(CASE WHEN status_inspection = 7 THEN id_visual END) AS total_approved_client,
			COUNT(CASE WHEN status_inspection = 8 THEN id_visual END) AS total_request_for_update,
			COUNT(CASE WHEN status_inspection = 9 THEN id_visual END) AS total_approve_comment,
			COUNT(CASE WHEN status_inspection = 10 THEN id_visual END) AS total_postponed,
			COUNT(CASE WHEN status_inspection = 11 THEN id_visual END) AS total_reoffer,
			COUNT(CASE WHEN status_inspection = 12 THEN id_visual END) AS total_void,
		 inspector_id, MAX(time_inspect) AS time_inspect,, location_inspect, discipline, module, type_of_module, legend_inspection_auth, MAX(id_workpack) AS id_workpack, area_v2, location_v2, point_v2, postpone_reoffer_no,
		 MAX(area) AS area,
		 MAX(inspection_client_by) AS inspection_client_by,
		 MAX(wp.company_id) AS company_id,
		 MAX(inspection_client_datetime) AS inspection_client_datetime
		 ');
		$this->db->from('pcms_visual');
		$this->db->join('(SELECT id, company_id FROM pcms_workpack) wp', 'wp.id = pcms_visual.id_workpack');
		$this->db->group_by('project_code, report_number, drawing_no,inspector_id,  location_inspect, discipline, module, type_of_module, legend_inspection_auth, area_v2, location_v2, point_v2,postpone_reoffer_no, status_invitation');
		$this->db->order_by('report_number ASC, postpone_reoffer_no ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	function vt_list($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->order_by('id_visual', 'DESC');
		$query = $this->db->get('pcms_visual');
		return $query->result_array();
	}

	function vt_wp_list($where = null)
	{
		$this->db->select('*, pw.company_id AS company_id');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->select('*, pw.company_id AS company_id');
		$query = $this->db->order_by('id_visual', 'DESC');
		$query = $this->db->join('pcms_workpack pw', 'pv.id_workpack = pw.id');
		$query = $this->db->get('pcms_visual pv');
		return $query->result_array();
	}

	public function vt_update_process_db($data, $where)
	{
		$this->db->where($where);
		$this->db->update("pcms_visual", $data);
	}

	public function autocomplete_workpack_no($workpack_no, $where = NULL)
	{
		$this->db->select('workpack_no');
		$this->db->from('pcms_workpack');
		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->where("pcms_joint.status_delete", 1);
		$this->db->join('pcms_joint', 'pcms_workpack.id = pcms_joint.workpack_id');
		$this->db->like('workpack_no', $workpack_no);
		$this->db->group_by('workpack_no');
		$this->db->limit(10);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function dashboard_visual()
	{
		$this->db->select("
			COUNT(
				CASE
					WHEN status_inspection = 0
					THEN 1
				END
			) AS ready_submission,
			COUNT(
				CASE
					WHEN status_inspection = 1
					THEN 1
				END
			) AS pending_qc,
			COUNT(
				CASE
					WHEN status_inspection >= 3
					THEN 1
				END
			) AS approve_qc,
			COUNT(
				CASE
					WHEN status_inspection = 5
					THEN 1
				END
			) AS pending_cpy,
			COUNT(
				CASE
					WHEN status_inspection = 7
					THEN 1
				END
			) AS approved_cpy,
			");
		$this->db->from('pcms_visual');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function dashboard_ndt()
	{
		$this->db->select("
			COUNT(
				CASE
					WHEN status_inspection = 0
					THEN 1
				END
			) AS ready_submission,
			COUNT(
				CASE
					WHEN status_inspection = 1
					THEN 1
				END
			) AS pending_qc,
			COUNT(
				CASE
					WHEN status_inspection >= 3
					THEN 1
				END
			) AS approve_qc,
			COUNT(
				CASE
					WHEN status_inspection = 5
					THEN 1
				END
			) AS pending_cpy,
			COUNT(
				CASE
					WHEN status_inspection = 7
					THEN 1
				END
			) AS approved_cpy,
			");
		$this->db->from('pcms_ndt');
		$query = $this->db->get();
		return $query->result_array();
	}

	// ------- SEVERSIDE Visual List
	var $column_order_visual_list    = array(
		'CAST(a.drawing_no AS TEXT)', 'CAST(company AS TEXT)', 'CAST(workpack_no AS TEXT)', 'CAST(a.drawing_no AS TEXT)', 'CAST(a.drawing_wm AS TEXT)', 'CAST(joint_no AS TEXT)', 'CAST(deck_elevation AS TEXT)', 'CAST(class AS TEXT)', 'CAST(weld_type AS TEXT)', 'CAST(cons_lot_no AS TEXT)', 'CAST(process_gtaw_rh AS TEXT)', 'CAST(process_gtaw_fc AS TEXT)', 'CAST(welder_ref_rh AS TEXT)', 'CAST(welder_ref_fc AS TEXT)', 'CAST(wps_no_rh AS TEXT)', 'CAST(wps_no_fc AS TEXT)', 'CAST(ndt_mt AS TEXT)', 'CAST(diameter AS TEXT)', 'CAST(sch AS TEXT)', 'CAST(weld_length AS TEXT)', 'CAST(weld_datetime AS TEXT)', 'CAST(surveyor_creator AS TEXT)', 'CAST(reject_remarks AS TEXT)', 'CAST(status_inspection AS TEXT)'
	);
	var $column_search_visual_list  	= array(
		'CAST(a.drawing_no AS TEXT)', 'CAST(company AS TEXT)', 'CAST(workpack_no AS TEXT)', 'CAST(a.drawing_no AS TEXT)', 'CAST(a.drawing_wm AS TEXT)', 'CAST(joint_no AS TEXT)', 'CAST(a.deck_elevation AS TEXT)', 'CAST(class AS TEXT)', 'CAST(weld_type AS TEXT)', 'CAST(cons_lot_no AS TEXT)', 'CAST(process_gtaw_rh AS TEXT)', 'CAST(process_gtaw_fc AS TEXT)', 'CAST(welder_ref_rh AS TEXT)', 'CAST(welder_ref_fc AS TEXT)', 'CAST(wps_no_rh AS TEXT)', 'CAST(wps_no_fc AS TEXT)', 'CAST(ndt_mt AS TEXT)', 'CAST(diameter AS TEXT)', 'CAST(sch AS TEXT)', 'CAST(weld_length AS TEXT)', 'CAST(weld_datetime AS TEXT)', 'CAST(surveyor_creator AS TEXT)', 'CAST(reject_remarks AS TEXT)', 'CAST(status_inspection AS TEXT)'
	);
	var $order_visual_list          	= array('joint_no' => 'DESC');

	public function serverside_visual_list($where)
	{
		$this->_serverside_visual_list($where);
		if ($where['drawing_no'] == '') {
			if ($_POST['length'] != -1) {
				$this->db->limit($_POST['length'], $_POST['start']);
			}
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	public function count_serverside_visual_list_all($where)
	{
		$this->_query_serverside_visual_list($where);
		return $this->db->count_all_results();
	}

	public function count_serverside_visual_list_filtered($where)
	{
		$this->_serverside_visual_list($where);
		$query = $this->db->get();
		return $query->num_rows();
	}

	private function _serverside_visual_list($where)
	{
		$this->_query_serverside_visual_list($where);
		$i = 0;
		foreach ($this->column_search_visual_list as $item) {
			if ($_POST['search']['value']) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if (count($this->column_search_visual_list) - 1 == $i) {
					$this->db->group_end();
				}
			}
			$i++;
		}
		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order_visual_list[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order_visual_list)) {
			$order = $this->order_visual_list;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	private function _query_serverside_visual_list($where)
	{
		$this->db->select('
			*, 
			c.company_id AS company_id, 
			a.id AS id,
			a.drawing_wm AS drawing_wm,
			a.drawing_no AS drawing_no,
			a.rev_wm AS rev_wm,
			a.drawing_wm AS visual_drawing_wm,
			b.drawing_wm_rev AS visual_rev_wm,
			b.length_of_weld AS visual_weld_length,
			b.area_v2 AS area_v2,
			b.location_v2 AS location_v2,
			b.point_v2 AS point_v2,
			a.deck_elevation AS deck_elevation,
			a.discipline AS discipline,
		');
		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->where("a.status_delete", 1);
		$this->db->from('pcms_joint a');
		$this->db->join('pcms_visual b', 'a.id = b.id_joint');
		$this->db->join('pcms_workpack c', 'b.id_workpack = c.id');
	}

	function welder_with_wps_autocomplete($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->select("
			master_welder.welder_code,
			master_welder.id_welder,
		");
		// $this->db->where("master_wps_detail.status_delete", 1);
		$this->db->join('master_welder_detail', 'master_welder_detail.id_welder = master_welder.id_welder');
		$this->db->join('master_wps', 'master_welder_detail.id_wps = master_wps.id_wps');
		$this->db->order_by("master_welder.welder_code", "asc");
		$this->db->limit(10);
		$this->db->distinct();

		$query = $this->db->get('master_welder');
		return $query->result_array();
	}

	function input_visual_detail_welder($data)
	{
		if (!isset($data['created_by'])) {
			$data['created_by'] = $this->user_cookie[0];
		}
		$query = $this->db->insert('pcms_visual_detail_welder', $data);
	}

	function visual_report_list($where = null, $order_by = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}

		if (isset($order_by)) {
			$this->db->order_by($order_by);
		}

		$this->db->select('
    		a.report_number,
    		MAX(c.drawing_no) AS drawing_no,
    		a.discipline,
    		a.module,
    		a.type_of_module,
    		a.company,
    		a.project_code,
    		COUNT(a.id_visual) AS total_joint,
    		COUNT(
				CASE
					WHEN a.status_inspection=5 THEN 1
				END

				) as total_pending_client,
				COUNT(
					CASE
						WHEN a.status_inspection=6 THEN 1
					END

				) as total_reject_client,
				COUNT(
					CASE
						WHEN a.status_inspection=7 THEN 1
					END

				) as total_approve_client,

				COUNT(
					CASE
						WHEN a.status_inspection=9 THEN 1
					END

				) as total_acc_comment_client,
				COUNT(
					CASE
						WHEN a.status_inspection=10 THEN 1
					END

				) as total_postpone_client,
				COUNT(
					CASE
						WHEN a.status_inspection=11 THEN 1
					END

				) as total_reoffer_client,
				a.status_invitation,
				a.legend_inspection_auth,
				a.postpone_reoffer_no,
				MAX(a.inspection_by) AS inspection_by,
				MAX(a.inspection_datetime) AS inspection_datetime,
				MAX(c.deck_elevation) AS deck_elevation,
				MAX(a.transmittal_datetime) AS transmittal_datetime,
				MAX(a.time_inspect) AS time_inspect,
				MAX(a.latest_inspection_status) AS latest_inspection_status,
				MAX(a.submission_id) AS max_submission_id,
				MIN(a.submission_id) AS min_submission_id,
				MIN(a.third_party_approval_status) AS third_party_approval_status,

				b.company_id,
    	');
		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->where("c.status_delete", 1);
		$this->db->join('pcms_workpack b', 'b.id = a.id_workpack');
		$this->db->join('pcms_joint c', 'c.id = a.id_joint');
		$this->db->from('pcms_visual a');
		$this->db->group_by('
				a.report_number,
	  		a.discipline,
	  		a.module,
	  		a.type_of_module,
	  		a.company,
	  		a.project_code,
	  		a.status_invitation,
	  		a.legend_inspection_auth,
	  		a.postpone_reoffer_no,
	  		b.company_id,
	  	');

		$query = $this->db->get();
		return $query->result_array();
	}

	function visual_notification($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->select("

			max(submission_id) as submission_id,
			project_code,
			drawing_no,
			discipline,  
			module,
			type_of_module,
			report_number,  
			area_v2,
			location_v2,
			point_v2,
			postpone_reoffer_no,
			invitation_remarks,
			MAX(status_invitation) AS status_invitation, 
			MAX(legend_inspection_auth) AS legend_inspection_auth,
			MAX(status_inspection) AS status_inspection,
			max(inspection_by) 	as inspection_by, 
			max(inspection_datetime) as inspection_datetime, 
			max(inspector_id) as inspector_id, 
			max(time_inspect) as time_inspect, 
			pcms_joint.deck_elevation as deck_elevation,
			pcms_joint.company_id as company_id,

			");
		$query = $this->db->group_by("project_code,drawing_no,discipline,module,type_of_module,report_number,pcms_joint.company_id, deck_elevation, area_v2, location_v2, point_v2, postpone_reoffer_no, invitation_remarks");
		$query = $this->db->order_by("company_id", "asc");
		$query = $this->db->order_by("deck_elevation", "asc");
		$this->db->join('(SELECT id as id_joint_temp, deck_elevation, company_id FROM pcms_joint) pcms_joint', 'pcms_joint.id_joint_temp = pcms_visual.id_joint');
		$query = $this->db->get('pcms_visual');
		return $query->result_array();
	}

	function drawing_list_get_db_v2($where = null, $limit = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		if (isset($limit)) {
			$this->db->limit($limit);
		}

		$query = $this->db->select('pcms_joint.*, pcms_workpack.company_id as company_id');
		$query = $this->db->where("pcms_joint.status_delete", 1);
		$query = $this->db->from('pcms_joint');
		$query = $this->db->join('pcms_visual', 'pcms_visual.id_joint = pcms_joint.id', 'LEFT');
		$query = $this->db->join('pcms_workpack', 'pcms_workpack.id = pcms_joint.workpack_id');
		return $query->get()->result_array();
	}

	function get_last_submission_v2($where = null)
	{
		$this->db->select('submission_id AS max');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->from('pcms_visual');
		$query = $this->db->join('(SELECT id, deck_elevation, company_id FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = pcms_visual.id_workpack');
		$query = $this->db->order_by('submission_id', 'desc');
		$query = $this->db->limit('1');
		return $query->get()->result_array();
	}

	function get_last_submission_v3($where = null)
	{
		$this->db->select('submission_id AS max');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->from('pcms_visual');
		$query = $this->db->join('(SELECT id AS id_jt, deck_elevation, company_id FROM pcms_joint) pcms_joint', 'pcms_joint.id_jt = pcms_visual.id_joint');
		$query = $this->db->order_by('RIGHT(submission_id, 6) DESC');
		$query = $this->db->limit('1');
		return $query->get()->result_array();
	}

	function visual_workpack($where = null)
	{
		$this->db->select('*');
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->from('pcms_visual');
		$query = $this->db->join('(SELECT id, deck_elevation, company_id FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = pcms_visual.id_workpack');
		$query = $this->db->order_by('submission_id', 'desc');
		$query = $this->db->limit('1');
		return $query->get()->result_array();
	}

	public function get_last_submission_id_company_based($project_code, $discipline, $mod_id, $type_of_module, $company_id)
	{
		$this->db->select('pcms_visual.submission_id');
		$this->db->where('pcms_visual.project_code', $project_code);
		$this->db->where('pcms_visual.discipline', $discipline);
		$this->db->where('pcms_visual.module', $mod_id);
		$this->db->where('pcms_visual.type_of_module', $type_of_module);
		$this->db->where('pcms_visual.submission_id IS NOT NULL', NULL);
		$this->db->where('pcms_workpack.company_id', $company_id);
		$this->db->limit(1);
		$this->db->order_by('pcms_visual.submission_id', "DESC");
		$this->db->join('(SELECT id, company_id FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = pcms_visual.id_workpack');
		return $this->db->get("pcms_visual")->result_array();
	}

	public function get_id_visual($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_visual');
		return $query->result_array();
	}

	function autocomplete_drawing_visual($where = null)
	{

		$this->db->select('drawing_no');
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->group_by("drawing_no");
		$query = $this->db->get('pcms_visual');
		return $query->result_array();
	}

	function pcms_visual_joint($where = null, $group_by = NULL)
	{
		$query = $this->db->select("
			a.*,
			pcms_visual.id_visual,
			pcms_visual.status_inspection,
			");
		if (isset($where)) {
			$query = $this->db->where($where);
		}
		$query = $this->db->join('pcms_visual', 'a.id = pcms_visual.id_joint');
		// $query = $this->db->where("a.status_delete", 1);
		$query = $this->db->from('pcms_joint a');
		$query = $this->db->order_by('pcms_visual.drawing_no ASC');
		$query = $this->db->order_by('a.joint_no ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	function welder_with_wps_autocomplete_new($where = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->select("
			welder_wps_array.welder_code,
			welder_wps_array.id_welder,
		");
		$this->db->join('master_wps', 'CAST(welder_wps_array.wps_array AS integer) = master_wps.id_wps');
		$this->db->order_by("welder_wps_array.welder_code", "asc");
		$this->db->limit(10);
		$this->db->distinct();

		$query = $this->db->get('welder_wps_array');
		return $query->result_array();
	}





	// Servesode versi baru untuk summary report 
	var $column_order_client_rfi_terbaru = array(
	'CAST(a.project_code AS VARCHAR)', 
	'CAST(c.company_id AS VARCHAR)', 
	'CAST(report_number AS VARCHAR)', 
	'drawing_no', 
	'CAST(c.discipline AS Varchar)', 
	'CAST(c.module AS VARCHAR)', 
	'CAST(c.type_of_module AS VARCHAR)', 
	'CAST(c.deck_elevation AS VARCHAR)',
	'CAST(postpone_reoffer_no AS VARCHAR)', 
	'CAST(a.inspection_by AS VARCHAR)',
	'CAST(a.inspection_datetime AS VARCHAR)', 
	'status_inspection', 
	'status_invitation', 
	'report_number');
	var $column_search_client_rfi_terbaru = array('CAST(project_code AS VARCHAR)', 'CAST(report_number AS VARCHAR)', 'c.drawing_no');
	var $order_client_rfi_terbaru = array('report_number' => 'DESC');
	public function serverside_client_rfi_terbaru($where = null, $status_inspection, $type, $add_comment)
	{
		$this->_serverside_client_rfi_terbaru($where, $status_inspection, $type, $add_comment);
		if ($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	public function count_serverside_client_rfi_all_terbaru($where = null, $status_inspection, $type, $add_comment)
	{
		$this->_query_serverside_client_rfi($where, $status_inspection, $type, $add_comment);
		return $this->db->count_all_results();
	}

	public function count_serverside_client_rfi_filtered_terbaru($where = null, $status_inspection, $type, $add_comment)
	{
		$this->_serverside_client_rfi_terbaru($where, $status_inspection, $type, $add_comment);
		$query = $this->db->get();
		return $query->num_rows();
	}


	private function _serverside_client_rfi_terbaru($where = null, $status_inspection, $type, $add_comment)
	{
		$this->_query_serverside_client_rfi_terbaru($where, $status_inspection, $type, $add_comment);
		$i = 0;
		foreach ($this->column_search_client_rfi_terbaru as $item) {
			if ($_POST['search']['value']) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if (count($this->column_search_client_rfi_terbaru) - 1 == $i) {
					$this->db->group_end();
				}
			}
			$i++;
		}
		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order_client_rfi_terbaru[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order_client_rfi_terbaru)) {
			$order = $this->order_client_rfi_terbaru;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	private function _query_serverside_client_rfi_terbaru($where = null, $status_inspection, $type, $add_comment)
	{
		$this->db->select('
    		a.report_number,
    		MAX(c.drawing_no) AS drawing_no,
    		c.discipline,
    		c.module,
    		c.type_of_module,
    		a.project_code,
    		COUNT(a.id_visual) AS total_joint,
    		COUNT(CASE WHEN a.status_inspection=5 THEN 1 END ) as total_pending_client,
			COUNT(CASE WHEN a.status_inspection=6 THEN 1 END ) as total_reject_client,
			COUNT(CASE WHEN a.status_inspection=7 THEN 1 END ) as total_approve_client,
			COUNT(CASE WHEN a.status_inspection=9 THEN 1 END ) as total_acc_comment_client,
			COUNT(CASE WHEN a.status_inspection=10 THEN 1 END ) as total_postpone_client,
			COUNT(CASE WHEN a.status_inspection=11 THEN 1 END ) as total_reoffer_client,
			a.status_invitation,
			a.legend_inspection_auth,
			a.retransmitt_status,
			a.postpone_reoffer_no,
			MAX(a.postpone_reoffer_no) AS latest_revision,
			MAX(a.add_comment) AS add_comment,
			MIN(a.status_inspection) AS status_inspection,
			MAX(a.inspection_by) AS inspection_by,
			MIN(a.inspection_by) AS inspection_by,
			MAX(a.inspection_datetime) AS inspection_datetime,
			MIN(a.inspection_datetime) AS inspection_datetime,
			MAX(c.deck_elevation) AS deck_elevation,
			MAX(a.transmittal_datetime) AS transmittal_datetime,
			MAX(a.time_inspect) AS time_inspect,
			MAX(a.latest_inspection_status) AS latest_inspection_status,
			MAX(a.submission_id) AS max_submission_id,
			MIN(a.submission_id) AS min_submission_id,
			c.company_id,
			a.status_delete
    	');

		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->join('pcms_workpack b', 'b.id = a.id_workpack');
		$this->db->join('pcms_joint c', 'c.id = a.id_joint');
		$this->db->from('pcms_visual a');

		if ($type) {
			// $this->db->where('(status_delete = 0 OR (status_delete = 1 AND status_inspection = 12))', null);
			// $this->db->where('report_resubmit_status', 0);

			if ($status_inspection == 5) {
				$this->db->having('COUNT(CASE WHEN status_inspection = 5 THEN 1 END) > 0');
			}

			if ($status_inspection == 6) {
				$this->db->having('
				  COUNT(CASE WHEN status_inspection = 5 THEN 1 END) = 0 
				  AND COUNT(CASE WHEN status_inspection = 6 THEN 1 END) > 0
				');
			}

			if ($status_inspection == 7) {
				$this->db->having("
			  	COUNT(CASE WHEN status_inspection = 5 THEN 1 END) = 0 
				  AND COUNT(CASE WHEN status_inspection = 6 THEN 1 END) = 0 
				  AND COUNT(CASE WHEN status_inspection = 7 THEN 1 END) > 0
				  AND COUNT(CASE WHEN add_comment = " . $add_comment . " THEN 1 END) > 0
				");
			}

			if ($status_inspection == 9) {
				$this->db->having("COUNT(CASE WHEN status_inspection = 9 THEN 1 END) > 0
				");
			}

			if ($status_inspection == 9) {
				$this->db->having("COUNT(CASE WHEN status_inspection = 9 THEN 1 END) > 0
				");
			}
			if ($status_inspection == 10) {
				$this->db->having("COUNT(CASE WHEN status_inspection = 10 THEN 1 END) > 0
				");
			}

			if ($status_inspection == 11) {
				$this->db->having("COUNT(CASE WHEN status_inspection = 11 THEN 1 END) > 0
				");
			}

			if ($status_inspection == 12) {
				$this->db->having("(COUNT(id_visual) = COUNT(CASE WHEN status_inspection = 12 THEN 1 END))");
			}
		} else {
			if ($status_inspection == 5) {
				$this->db->having('COUNT(CASE WHEN status_inspection = 5 THEN 1 END) > 0');
			}

			if ($status_inspection == 6) {
				$this->db->having('
				  COUNT(CASE WHEN status_inspection = 5 THEN 1 END) = 0 
				  AND COUNT(CASE WHEN status_inspection = 6 THEN 1 END) > 0
				');
			}

			if ($status_inspection == 7) {
				$this->db->having("COUNT(CASE WHEN status_inspection = 5 THEN 1 END) = 0 
				  AND COUNT(CASE WHEN status_inspection = 6 THEN 1 END) = 0 
				  AND COUNT(CASE WHEN status_inspection = 7 THEN 1 END) > 0
				");
			}

			if ($status_inspection == 9) {
				$this->db->having("COUNT(CASE WHEN status_inspection = 9 THEN 1 END) > 0
				");
			}

			if ($status_inspection == 9) {
				$this->db->having("COUNT(CASE WHEN status_inspection = 9 THEN 1 END) > 0
				");
			}
			if ($status_inspection == 10) {
				$this->db->having("COUNT(CASE WHEN status_inspection = 10 THEN 1 END) > 0
				");
			}

			if ($status_inspection == 11) {
				$this->db->having("COUNT(CASE WHEN status_inspection = 11 THEN 1 END) > 0
				");
			}

			if ($status_inspection == 12) {
				$this->db->having("(COUNT(id_visual) = COUNT(CASE WHEN status_inspection = 12 THEN 1 END))");
			}
		}

		$this->db->group_by('a.project_code, report_number, c.drawing_no, c.discipline, c.module, c.type_of_module, c.deck_elevation, postpone_reoffer_no, c.company_id, a.status_invitation, a.legend_inspection_auth, a.status_delete, a.retransmitt_status');
	}
	// 
}
/*
	End Model Auth_mod
*/