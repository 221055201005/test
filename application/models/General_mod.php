<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General_mod extends CI_Model {

	public function __construct()
 	{
	  	parent::__construct();
	    $this->db_portal = $this->load->database('db_portal', TRUE);
	    //$this->db_eng = $this->load->database('db_eng', TRUE);
	    $this->db_eng = $this->load->database('db_eng_mysql', TRUE);
	    $this->db_iss = $this->load->database('db_iss', TRUE);
	    $this->db_wh = $this->load->database('warehouse', TRUE);
	    $this->db_notif = $this->load->database('db_notif', TRUE);
 	}

	function discipline($where = null, $order_by = null){
		if(isset($where)){
			$this->db->where($where);
		}
		else{
			$this->db->where('status_delete', '1');
		}
		if($order_by){
			foreach ($order_by as $key => $value) {
				$this->db->order_by($key, $value);
			}
		}
		$this->db->where(["production_status" => 1]);
		$query = $this->db->get('master_discipline');
		return $query->result_array();
	}

	function master_department($where = null){
		if(isset($where)){
			$this->db_iss->where($where);
		}
		$query = $this->db_iss->get('iss_dept');
		return $query->result_array();
	}

	function discipline_mc($where = null, $order_by = null){
		if(isset($where)){
			$this->db->where($where);
		}
		else{
			$this->db->where('status_delete', '1');
		}
		if($order_by){
			foreach ($order_by as $key => $value) {
				$this->db->order_by($key, $value);
			}
		}
		$this->db->where(["mc_code IS NOT NULL" => NULL]);
		$query = $this->db->get('master_discipline');
		return $query->result_array();
	}

	function portal_user_permission($where = null){
		if(isset($where)){
			$this->db_portal->where($where);
		}
		$query = $this->db_portal->get('portal_user_permission');
		return $query->result_array();
	}

	function portal_permission($where = null){
		if(isset($where)){
			$this->db_portal->where($where);
		}
		$query = $this->db_portal->get('portal_permission');
		return $query->result_array();
	}
	
	function portal_permission_max_index($where){
		$this->db_portal->select_max('index_key');
		$this->db_portal->where($where);
		$query = $this->db_portal->get('portal_permission');
		return $query->result_array();
	}

	function pcms_summary($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_summary');
		return $query->result_array();
	}

	function master_itp($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->order_by('date_affected',"asc");
		$query = $this->db->get('master_itp');
		return $query->result_array();
	}

	function summary_total_level_3($where = NULL){
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
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->from('pcms_summary');
		return $query->get()->result_array();
	}

	function pcms_joint($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_joint');
		return $query->result_array();
	}

	function pcms_piecemark($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_piecemark');
		return $query->result_array();
	}

	function master_calculation($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->get('master_calculation');
		return $query->result_array();
	}

	function master_bnp_activity($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->get('master_bnp_activity');
		return $query->result_array();
	}

	function module($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		else{
			$this->db->where('status_delete', '1');
		}
		$query = $this->db->order_by('mod_desc',"asc");
		$query = $this->db->get('master_module');
		return $query->result_array();
	}

	function master_surveyor_status($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->order_by('description',"ASC");
		$query = $this->db->get('master_surveyor_status');
		return $query->result_array();
	}

	function master_location($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		else{
			// $this->db->where('status_delete', '1');
			// $this->db->where('status', '1');
		}
		$query = $this->db->order_by('location_name', 'ASC');
		$query = $this->db->get('master_location');
		return $query->result_array();
	}

	function master_wps($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		else{
			// $this->db->where('status_delete', '1');
			// $this->db->where('status', '1');
		}
		$query = $this->db->get('pcms_wps');
		return $query->result_array();
	}

	function master_wps_new($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		else{
			// $this->db->where('status_delete', '1');
			// $this->db->where('status', '1');
		}
		$query = $this->db->order_by('wps_no', 'asc');
		$query = $this->db->get('master_wps');
		return $query->result_array();
	}


	function project($where = null){
		if(isset($where)){
			$this->db_portal->where($where);
		}
		else{
			$this->db_portal->where('status', '1');
		}
		$this->db_portal->where_in('id', project_app());
		$query = $this->db_portal->get('portal_project');
		return $query->result_array();
	}

	function material_catalog($where = null, $limit = null){
		if(isset($where)){
			$this->db_wh->where($where);
		}
		if(isset($limit)){
			$this->db_wh->limit($limit);
		}
		$query = $this->db_wh->order_by('id', 'desc');
		$query = $this->db_wh->get('pcms_wm_material_catalog');
		return $query->result_array();
	}

	function catalog_category($where = null){
		if(isset($where)){
			$this->db_wh->where($where);
		}
		$query = $this->db_wh->get('pcms_wm_catalog_category');
		return $query->result_array();
	}

	function paint_system($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		else{
			$this->db->where('status_delete', '1');
		}
		$query = $this->db->get('master_paint_system');
		return $query->result_array();
	}

	function material_grade($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		else{
			$this->db->where('status_delete', '1');
		}
		$query = $this->db->get('master_material_grade');
		return $query->result_array();
	}

	function master_report_number($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->get('master_report_no');
		return $query->result_array();
	}

	function class($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		else{
			$this->db->where('status_delete', '1');
		}
		$query = $this->db->get('master_class');
		return $query->result_array();
	}

	function workpack_section($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		else{
			$this->db->where('status_delete', '1');
		}
		$query = $this->db->get('master_workpack_section');
		return $query->result_array();
	}

	function read_project_name($id){
		$this->db_portal->where('id', $id);
		$this->db_portal->where_in('id', project_app());
		$query = $this->db_portal->get('portal_project');
		return $query->result_array();
	}


	function portal_user_db_list($where = NULL, $order_by = null, $select = null, $limit = NULL){
		if($where){
			$query = $this->db_portal->where($where);
		}

    	if(isset($order_by)) {
			$query = $this->db_portal->order_by($order_by);
    	}

    	if(isset($select)) {
			$query = $this->db_portal->select($select);
    	}

    	if(isset($limit)) {
			$query = $this->db_portal->limit("10");
    	}

		$query = $this->db_portal->get('portal_user_db');
		return $query->result_array();
	}

	function portal_server_list($where = NULL){
		if($where){
			$query = $this->db_portal->where($where);
		}

		$query = $this->db_portal->get('portal_server');
		return $query->result_array();
	}

	function portal_user_db_id($where_in){
		$this->db_portal->select('id_user, full_name');
		$this->db_portal->where_in('id_user', $where_in);
		$query = $this->db_portal->get('portal_user_db');
		return $query->result_array();
	}

	function portal_user_db_no_sign($where = null){
		if($where){
			$query = $this->db_portal->where($where);
		}
		$query =  $this->db_portal->select('id_user, full_name, company');
		$query = $this->db_portal->get('portal_user_db');
		return $query->result_array();
	}

	function portal_user_db_id_all($where_in){
		$this->db_portal->where_in('id_user', $where_in);
		$query = $this->db_portal->get('portal_user_db');
		return $query->result_array();
	}

	function type_of_module($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		else{
			$this->db->where('status_delete', '1');
		}
		$query = $this->db->get('master_type_of_module');
		return $query->result_array();
	}

	function phase($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		else{
			$this->db->where('status_delete', '1');
		}
		$query = $this->db->get('master_phase');
		return $query->result_array();
	}

	function deck_elevation($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		else{
			$this->db->where('status_delete', '1');
		}
		$query = $this->db->order_by('name', 'ASC');
		$query = $this->db->get('master_deck_elevation');
		return $query->result_array();
	}

	function sector($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		else{
			$this->db->where('status_delete', '1');
		}
		$query = $this->db->order_by('sector', 'ASC');
		$query = $this->db->get('master_sector');
		return $query->result_array();
	}

	function column_revision_log($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->get('master_column_revision_log');
		return $query->result_array();
	}

	public function drawing_as($where = null) {
		$this->db->select('drawing_as');
	   	if(isset($where)){
		  $query = $this->db->where($where);
		  $query = $this->db->limit("10");
		}		 
		$query = $this->db->group_by("drawing_as");
		$query = $this->db->get('pcms_piecemark');
		return $query->result_array();
	}

	function drawing_type($where = null){
		if(isset($where)){
			$this->db_eng->where($where);
		}
		else{
			$this->db_eng->where('status_delete', '1');
		}
		$query = $this->db_eng->get('master_drawing_type');
		return $query->result_array();
	}

	function weld_type($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		else{
			$this->db->where('status_delete', '1');
		}
		$query = $this->db->get('master_weld_type');
		return $query->result_array();
	}

	function joint_type($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->get('master_joint_type');
		return $query->result_array();
	}

	function area($where = null) {
		if(isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_area');
		return $query->result_array();
	}

	function company($where = null){
		if(isset($where)) {
			$this->db_portal->where($where);
		}
		$query = $this->db_portal->where("app", 1);
		$query = $this->db_portal->order_by('company_name', 'ASC');
		$query = $this->db_portal->get('portal_company');
		return $query->result_array();
	}

	function company_all($where = null){
		if(isset($where)){
			$this->db_portal->where($where);
		}
		$query = $this->db_portal->order_by('company_name', 'ASC');
		$query = $this->db_portal->get('portal_company');
		return $query->result_array();
	}

	function bonding_process($where = null){
		if(isset($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get('master_bonding_process');
		return $query->result_array();
	}

	function portal_user_get_db($ids = null){
		if(isset($ids)){
		$this->db_portal->where_in('id_user', $ids);
		}
		$query = $this->db_portal->get('portal_user_db');
		return $query->result_array();
	}

	function portal_user_get_db_new($ids = null){
		$this->db_portal->select('id_user,full_name');
		if(isset($ids)){
		$this->db_portal->where_in('id_user', $ids);
		}
		$query = $this->db_portal->get('portal_user_db');
		return $query->result_array();
	}

	function desc_assy($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		else{
			$this->db->where('status', '1');
		}
		$query = $this->db->order_by('code', 'ASC');
		$query = $this->db->get('master_desc_assy');
		return $query->result_array();
	}

	function piping_testing_category($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		else{
			$this->db->where('status_delete', '1');
		}
		$query = $this->db->order_by('id', 'ASC');
		$query = $this->db->get('master_piping_testing_category');
		return $query->result_array();
	}

	function location($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		else{
			$this->db->where('status_delete', '1');
			$this->db->where('status', '1');
		}
		$query = $this->db->get('master_location');
		return $query->result_array();
	}

	public function get_drawing_title($where = null)
    {      

       $query = $this->db_eng->where($where);
       $query = $this->db_eng->get('pcms_eng_activity');
       return $query->result_array();
    }

		public function drawing_list($where = null){      
			if(isset($where)){
				$query = $this->db_eng->where($where);
			}
			$query = $this->db_eng->where("project_id", 12);
			$query = $this->db_eng->get('pcms_eng_activity');
			return $query->result_array();
		}

	public function drawing_register_list($where = null){      
		if(isset($where)){
			$query = $this->db_eng->where($where);
		}
		$query = $this->db_eng->get('pcms_eng_drawing_register');
		return $query->result_array();
	}

	function report_no($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		else{
			$this->db->where('status_delete', '1');
		}
		$query = $this->db->get('master_report_no');
		return $query->result_array();
	}

	function data_project($where = NULL){
		if($where){
			$query = $this->db_portal->where($where);
		}
		//$query = $this->db_portal->where('status = "1"');
		$this->db_portal->where_in('id', project_app());
		$query = $this->db_portal->get('portal_project');
		return $query->result_array();
	}

	function data_module($where = null){
		if($where){
			$query = $this->db->where($where);
		}
 		$query = $this->db->order_by("mod_desc", "asc");
 		$query = $this->db->get('master_module');
		return $query->result_array();
	}

	function eng_discipline_get_db($id = null){
		if(isset($id)){
			$this->db->where('id', $id);
		}
		$this->db->where('status', '1');
		$query = $this->db->get('master_discipline');
		return $query->result_array();
	}

	function eng_module_get_db($id = null){
		if(isset($id)){
			$this->db->where('mod_id', $id);
		}
		$query = $this->db->get('master_module');
		return $query->result_array();
	}

	function type_of_weld($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		else{
			$this->db->where('status_delete', '1');
		}
		$query = $this->db->get('master_weld_type');
		return $query->result_array();
	}

	function employee_list($where = null, $limit = null){
		if(isset($where)){
			$this->db_iss->where($where);
		}
		if(isset($limit)){
			$this->db_iss->limit($limit);
		}
		$query = $this->db_iss->get('iss_employee');
		return $query->result_array();
 	}

	public function employee_update_process_db($data, $where) {
		$data = convert2null($data);
		$this->db_iss->where($where);
		$this->db_iss->update("iss_employee", $data);
	}

	function bank_data_list($where = null, $limit = null){
		if(isset($where)){
			$this->db_iss->where($where);
		}
		if(isset($limit)){
			$this->db_iss->limit($limit);
		}
		$query = $this->db_iss->get('iss_recruitment_bankdata');
		return $query->result_array();
 	}

	public function mis_list($where = null){
		if(isset($where)){
			$this->db_wh->where($where);
		}
		$query = $this->db_wh->get('pcms_wm_mis');
		return $query->result_array();
	}

	public function mis_detail_list($where = null){
		if(isset($where)){
			$this->db_wh->where($where);
		}
		$query = $this->db_wh->get('pcms_wm_mis_detail');
		return $query->result_array();
	}

	public function mis_update_process_db($data, $where) {
		$data = convert2null($data);
		$this->db_wh->where($where);
		$this->db_wh->update("pcms_wm_mis", $data);
	}

	function section_list($where = null, $limit = null){
		if(isset($where)){
			$this->db_iss->where($where);
		}
		if(isset($limit)){
			$this->db_iss->limit($limit);
		}
		$query = $this->db_iss->get('iss_section');
		return $query->result_array();
 	}

 	function fitter_list($where = null, $limit = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		$query = $this->db->get('pcms_fitter');
		return $query->result_array();
 	}

 	function welder_list($where = null, $limit = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		$query = $this->db->get('pcms_welder');
		return $query->result_array();
 	}

 	public function find_email_group($project_id = null) {
		$this->db_portal->select('portal_email_notification.*, portal_email_group.group_name AS group');
		$this->db_portal->from('portal_email_notification');
		$this->db_portal->join('portal_email_group','portal_email_notification.group_name = portal_email_group.id');
		if(isset($project_id)){
			$this->db_portal->where('project', $project_id);
		}
		$this->db_portal->where('portal_email_notification.status_delete',1);
		$query = $this->db_portal->get(); 
		return $query->result_array();
	}

	public function portal_email_list($where = null) {
		if(isset($where)) {
			$this->db_portal->where($where);
		}
		$this->db_portal->from('portal_email_notification');
		$query = $this->db_portal->get(); 
		return $query->result_array();
	}

	// public function find_email_data($where) {
	// 	if($where){
	// 		$query = $this->db_portal->where($where);
	// 	}
	// 	$this->db_portal->from('portal_email_notification');
	// 	$query = $this->db_portal->get(); 
	// 	return $query->result_array();
	// }

	function data_user($where = NULL){
		if($where){
			$query = $this->db_portal->where($where);
		}

		$query = $this->db_portal->get('portal_user_db');
		return $query->result_array();
	}

	
	public function ftp_find_master($ip_source){
		$this->db_portal->where('server_source', $ip_source);
		return $this->db_portal->get('portal_ftp_server')->result_array();
	}

	public function data_plan_group($where = NULL, $group = NULL){
		$query = $this->db->select("SUM(plan_target) as plan_target_sum");
		if(isset($where)){
			$query = $this->db->where($where);
		}
		if(isset($group)){
			$query = $this->db->select($group);
			$query = $this->db->group_by($group);
		}
		$query = $this->db->get('master_plan_measurement');
		return $query->result_array();
	}

	public function ftp_find_master_with_condition($ip_source,$categories){
		$this->db_portal->where('server_source', $ip_source);
		$this->db_portal->where('destination_source', $categories);
		return $this->db_portal->get('portal_ftp_server')->result_array();
	}


	function master_welder_process($where = null, $order_by = null){
		if(isset($where)){
			$this->db->where($where);
		}
		else{
			$this->db->where('status', '1');
		}
		if($order_by){
			foreach ($order_by as $key => $value) {
				$this->db->order_by($key, $value);
			}
		}
		$query = $this->db->get('master_weld_process');
		return $query->result_array();
	}

	function master_welder($where = null, $order_by = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if($order_by){
			foreach ($order_by as $key => $value) {
				$this->db->order_by($key, $value);
			}
		}
		$query = $this->db->get('master_welder');
		return $query->result_array();
	}

	function get_module_name($where = Null){
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->get('master_module');
		return $query->result_array();
	}


	function master_irn_detail($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->order_by('id_irn_detail',"ASC");
		$query = $this->db->get('master_irn_detail');
		return $query->result_array();
	}

	function manual_query_db($query){
		$query = $this->db->query($query);
		return $query->result_array();
	}

	function discipline_list($where = Null){
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->get('master_discipline');
		return $query->result_array();
	}

	function master_data_welder_req($where = Null){
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->get('master_data_welder_req');
		return $query->result_array();
	}

	function master_data_welder_req_cat($where = Null){
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->get('master_data_welder_req_cat');
		return $query->result_array();
	}

	function timesheet_list($where = Null){
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_workpack_timesheet');
		return $query->result_array();
	}

	function workpack_list($where = Null){
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_workpack');
		return $query->result_array();
	}

	function master_ctq($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->get('master_ctq');
		return $query->result_array();
	}

	public function area_v2($where = null) {
		if(isset($where)) {
			$this->db->where($where);
		}
		
		$this->db->from('master_area_v2');
		$query = $this->db->get(); 
		return $query->result_array();

	}

	public function type_of_inspection($where = null) {
		if(isset($where)) {
			$this->db->where($where);
		}
		
		$this->db->from('master_type_of_inspection');
		$query = $this->db->get(); 
		return $query->result_array();

	}

	public function location_v2($where = null) {
		if(isset($where)) {
			$this->db->where($where);
		}
		
		$this->db->from('master_location_v2');
		$query = $this->db->get(); 
		return $query->result_array();
		
	}

	public function point($where = null) {
		if(isset($where)) {
			$this->db->where($where);
		}
		
		$this->db->from('master_point');
		$query = $this->db->get(); 
		return $query->result_array();
		
	}

	public function alocation($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		
		$query = $this->db->get('master_alocation');
		return $query->result_array();
	}

	public function job_no($where = null) {
		if(isset($where)) {
			$this->db->where($where);
		}
		
		$this->db->from('pcms_workpack_job_no');
		$query = $this->db->get(); 
		return $query->result_array();
	}

	public function job_desc($where = null) {
		if(isset($where)) {
			$this->db->where($where);
		}
		
		$this->db->from('pcms_workpack_job_desc');
		$query = $this->db->get(); 
		return $query->result_array();
	}

	public function ndt_type($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		
		$query = $this->db->get('master_ndt_type');
		return $query->result_array();
	}

	public function master_ndt_rt_technique_sketch($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		
		$query = $this->db->get('master_ndt_rt_technique_sketch');
		return $query->result_array();
	}


	public function get_user_data($where)
	{
		 if(isset($where)){
			 $query = $this->db_portal->where($where);
		 }
		 $query = $this->db_portal->get("portal_user_db");
		 return $query->result_array();
	}

	public function getById($id)
    {
        return $this->db_portal->get_where("portal_pass_config", array("id_pass" => $id))->row();
    }

	function select_user_based_on_id($where = NULL){
		if($where){
			$query = $this->db_portal->where($where);
		}

		$query = $this->db_portal->select('id_user,full_name');
		$query = $this->db_portal->get('portal_user_db');
		return $query->result_array();
	}

	function master_group_notif($where = null){
		if(isset($where)){
			$this->db_notif->where($where);
		}
		$query = $this->db_notif->get('master_group_notif');
		return $query->result_array();
 	}

  public function notification_new_process_db($data) {
    $this->db_notif->insert('portal_notification', $data);
		$insert_id = $this->db_notif->insert_id();
		return $insert_id;
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

	function wps_no($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		else{
			$this->db->where('status_delete', '1');
		}
		$query = $this->db->get('master_wps');
		return $query->result_array();
	}

	function iss_bankdata_type($where = null){
		if(isset($where)){
			$this->db_iss->where($where);
		}
		$query = $this->db_iss->get('iss_bankdata_type');
		return $query->result_array();
	}

	function acceptance_criteria($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->get('master_acceptance_criteria');
		return $query->result_array();
	}

	function add_acceptance_criteria($where = null, $data){
		if(isset($where)){
			$this->db->where($where);
		}
		$this->db_notif->insert('portal_notification', $data);
		$insert_id = $this->db_notif->insert_id();
		return $insert_id;
	}

	function welder_wps_cek($where = null) {
		if(isset($where)){
			$this->db->where($where);
		}
		$this->db->select('mwps.wps_no, mw.welder_code, mwprocess.weld_process');
		$this->db->join('master_wps mwps','CAST(mwps.id_wps AS INT) = CAST(mwd.id_wps AS INT)');
		$this->db->join('master_wps_detail mwpsd','CAST(mwpsd.id_main AS INT) = CAST(mwps.id_wps AS INT)');
		$this->db->join('master_weld_process mwprocess','CAST(mwprocess.id AS INT) = CAST(mwpsd.id_weld_process AS INT)');
		$this->db->join('master_welder mw','CAST(mw.id_welder AS INT) = CAST(mwd.id_welder AS INT)');
		$this->db->from('master_welder_detail mwd');
		$query = $this->db->get(); 
		return $query->result_array();



		// $this->db->select('portal_email_notification.*, portal_email_group.group_name AS group');
		// $this->db->from('portal_email_notification');
		// $this->db->join('portal_email_group','portal_email_notification.group_name = portal_email_group.id');
		// if(isset($project_id)){
		// 	$this->db->where('project', $project_id);
		// }
		// $this->db->where('portal_email_notification.status_delete',1);
		// $query = $this->db->get(); 
		// return $query->result_array();
	}

	function welder_wps_array($where = null) {
		if(isset($where)){
			$this->db->where($where);
		}
		$this->db->select('wwa.welder_code, mw.wps_no');
		$this->db->join('master_wps mw','CAST(wwa.wps_array AS INT) = mw.id_wps');
		$this->db->from('welder_wps_array wwa');
		$query = $this->db->get(); 
		return $query->result_array();
	}

	function welder_wps_array_mwtr($where = null) {
		if(isset($where)){
			$this->db->where($where);
		}
		$this->db->from('welder_wps_array');
		$query = $this->db->get(); 
		return $query->result_array();
	}

	function total_piecemark_by_deck($where = null) {
		if(isset($where)){
			$this->db->where($where);
		}

		$this->db->select('COUNT(id) AS total_piecemark, deck_elevation');
		$this->db->from('pcms_piecemark');
		$this->db->group_by('deck_elevation');
		$query = $this->db->get(); 
		return $query->result_array();
	}

	function total_mv_by_deck_and_status($where = null) {
		if(isset($where)){
			$this->db->where($where);
		}

		$this->db->select('COUNT(DISTINCT pc.id) AS total_piecemark, deck_elevation, status_inspection');
		$this->db->from('pcms_piecemark pc');
		$this->db->join('pcms_material mv','mv.id_piecemark = pc.id');
		$this->db->group_by('deck_elevation, status_inspection');
		$query = $this->db->get(); 
		return $query->result_array();
	}

	function total_joint_by_deck_and_class($where = null) {
		if(isset($where)){
			$this->db->where($where);
		}

		$this->db->select('COUNT(id) AS total_joint, SUM(weld_length) AS total_weld_length, deck_elevation, class');
		$this->db->from('pcms_joint');
		$this->db->group_by('deck_elevation, class');
		$query = $this->db->get(); 
		return $query->result_array();
	}

	function total_ft_by_deck_and_class_and_status($where = null) {
		if(isset($where)){
			$this->db->where($where);
		}

		$this->db->select('COUNT(DISTINCT jt.id) AS total_joint, SUM(weld_length) AS total_weld_length, deck_elevation, status_inspection, class');
		$this->db->from('pcms_joint jt');
		$this->db->join('pcms_fitup ft','ft.id_joint = jt.id');
		$this->db->group_by('deck_elevation, status_inspection, class');
		$query = $this->db->get(); 
		return $query->result_array();
	}

	function total_vs_by_deck_and_class_and_status($where = null) {
		if(isset($where)){
			$this->db->where($where);
		}

		$this->db->select('COUNT(DISTINCT jt.id) AS total_joint, SUM(weld_length) AS total_weld_length, deck_elevation, status_inspection, class');
		$this->db->from('pcms_joint jt');
		$this->db->join('pcms_visual vs','vs.id_joint = jt.id');
		$this->db->group_by('deck_elevation, status_inspection, class');
		$query = $this->db->get(); 
		return $query->result_array();
	}


}



/*
	End Model Auth_mod
*/