<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fitup_mod extends CI_Model {

	public function __construct(){
	  parent::__construct();
		//$this->db_eng 			= $this->load->database('db_eng', TRUE);
		$this->db_eng 		= $this->load->database('db_eng_mysql', TRUE);
		$this->db_eng_mysql = $this->load->database('db_eng_mysql', TRUE);
		$this->db_wh 		= $this->load->database('warehouse', TRUE);
 	}

	public function get_last_submission_id_company_based($project_code,$discipline,$mod_id,$type_of_module,$company_id,$deck_elevation = null){
	$this->db->select('pcms_fitup.submission_id'); 
    $this->db->where('pcms_fitup.project_code',$project_code);
    $this->db->where('pcms_fitup.discipline',$discipline);
    $this->db->where('pcms_fitup.module',$mod_id);
    $this->db->where('pcms_fitup.type_of_module',$type_of_module);        
    $this->db->where('pcms_fitup.submission_id IS NOT NULL',NULL);        
    $this->db->where('pcms_workpack.company_id',$company_id);
	if(in_array($project_code, project_by_deck())) {
		$this->db->join('(SELECT id AS id_jt, deck_elevation from pcms_joint) jt','jt.id_jt = pcms_fitup.id_joint');
		$this->db->where('jt.deck_elevation',$deck_elevation);
	}    
    $this->db->limit(1);
	$this->db->order_by('right(pcms_fitup.submission_id, 6) DESC'); 
    $this->db->join('(SELECT id, company_id FROM pcms_workpack) pcms_workpack','pcms_workpack.id = pcms_fitup.id_workpack');	 
    $this->db->join('(SELECT id as id_joint_for_deck, deck_elevation FROM pcms_joint) pcms_joint','pcms_joint.id_joint_for_deck = pcms_fitup.id_joint');	 
 		return $this->db->get("pcms_fitup")->result_array();
	}

 	public function get_last_submission_id($project_code,$discipline,$mod_id,$type_of_module){
		$this->db->select('submission_id');
        $this->db->from('pcms_fitup');
        $this->db->where('project_code',$project_code);
        $this->db->where('discipline',$discipline);
        $this->db->where('module',$mod_id);
        $this->db->where('type_of_module',$type_of_module);        
        $this->db->where('submission_id IS NOT NULL',NULL);        
        $this->db->limit(1);
		$this->db->order_by('submission_id',"DESC");
   		return $this->db->get()->result_array();
	}

	public function get_last_report_number($project_code,$discipline,$mod_id,$type_of_module){
		$this->db->select('*');
        $this->db->from('pcms_fitup');
        $this->db->where('report_number IS NOT NULL');
        $this->db->where('project_code',$project_code);
        $this->db->where('discipline',$discipline);
        $this->db->where('module',$mod_id);
        $this->db->where('type_of_module',$type_of_module);       
        $this->db->limit(1);
		$this->db->order_by('report_number',"DESC");
   		return $this->db->get()->result_array();
	}

	public function get_last_report_number_company_based($project_code,$discipline,$mod_id,$type_of_module,$company_id, $deck_elevation = null){
		$this->db->where('pcms_fitup.report_number IS NOT NULL');
        $this->db->where('pcms_fitup.project_code',$project_code);
        $this->db->where('pcms_fitup.discipline',$discipline);
        $this->db->where('pcms_fitup.module',$mod_id);
        $this->db->where('pcms_fitup.type_of_module',$type_of_module); 
		$this->db->where('pcms_workpack.company_id',$company_id);          
        $this->db->limit(1);
		$this->db->order_by('pcms_fitup.report_number',"DESC");

		if(in_array($project_code, project_by_deck())) {
			$this->db->join('(SELECT id AS id_jt, deck_elevation from pcms_joint) jt','jt.id_jt = pcms_fitup.id_joint');
			$this->db->where('jt.deck_elevation',$deck_elevation);
		}
		
		$this->db->join('(SELECT id, company_id FROM pcms_workpack) pcms_workpack','pcms_workpack.id = pcms_fitup.id_workpack');
   		return $this->db->get("pcms_fitup")->result_array();
	}

	function insert_fitup_data($data){
		convert2null($data);
		$this->db->insert("pcms_fitup", $data);
		return $this->db->insert_id();
	}
	


	public function piecemark_import_process_db($data) {
	  $this->db->insert_batch('pcms_piecemark', $data);
	}

	function joint_list($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		$query = $this->db->select("
			*,
		 	a.drawing_type,
		 	b.drawing_no as drawing_no,
		 	c.company_id as wp_company,
		 	a.rev_no as rev_no_drawing_asga_template,
			b.id_fitup,
		 	b.location_v2 as location_v2,
		 	b.area_v2 as area_v2,
		 	b.point_v2 as point_v2,
		 	b.latest_inspection_status as latest_inspection_status,
		 	CAST(b.remarks AS TEXT) as remarks,
		 	a.drawing_no as drawing_no_tmp,
		 	a.discipline as discipline_tmp,
		 	a.module as module_tmp,
		 	a.type_of_module as type_of_module_tmp,
		 	b.requested_for_update,
		 	a.id as id,
		 	b.status_delete as status_delete_fu,
			a.deck_elevation as deck_elevation,
			a.discipline as discipline,
			a.module as module,
			b.type_of_module as type_of_module,
			a.spool_no as spool_no,
			b.status_inspection as status_inspection,
			b.postpone_reoffer_no as postpone_reoffer_no,
			b.report_number as report_number,
		");
		$query = $this->db->where("a.status_delete", 1);
		$query = $this->db->order_by("a.drawing_no,CAST(a.joint_no AS varchar)","ASC", FALSE);			
		$query = $this->db->order_by("b.id_fitup","DESC", FALSE);			
		$query = $this->db->join('pcms_fitup b','a.id = b.id_joint');
		$query = $this->db->join('pcms_workpack c','b.id_workpack = c.id');
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}

	function joint_fitup_list($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		$query = $this->db->select("
			*,
		");
		$query = $this->db->where("a.status_delete", 1);
		$query = $this->db->order_by("a.drawing_no,CAST(a.joint_no AS varchar)","ASC", FALSE);			
		$query = $this->db->join('pcms_fitup b','a.id = b.id_joint');
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}

	function joint_list_excel($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}

		// $query = $this->db->where("e.irn_report_no IS NOT NULL",null);
		// $this->db->limit('1000');

		$query = $this->db->select("*,b.drawing_no as drawing_no,b.status_surveyor as status_surveyor, b.status_invitation as status_invitation_fitup, d.status_inspection as status_inspection_visual, b.area_v2 as area_v2,b.location_v2 as location_v2,a.drawing_no as drawing_no_tmp,a.discipline as discipline_tmp,a.module as module_tmp,a.type_of_module as type_of_module_tmp,b.requested_for_update,c.company_id as company_id, b.status_inspection AS status_inspection");
		$query = $this->db->order_by("a.drawing_no,a.joint_no","ASC", FALSE);
		$query = $this->db->where("a.status_delete", 1);
		$query = $this->db->join('pcms_joint a','a.id = b.id_joint',"LEFT");
		$query = $this->db->join('pcms_workpack c','b.id_workpack = c.id',"LEFT");
		$query = $this->db->join('(SELECT status_inspection,id_joint FROM pcms_visual WHERE status_delete IS NULL AND retransmitt_status = 0 AND revision is null) d','a.id = d.id_joint',"LEFT");
		$query = $this->db->join('(SELECT id_joint as id_joint_irn, report_number as irn_report_no FROM pcms_irn) e','b.id_joint = e.id_joint_irn','left');
		$query = $this->db->get('pcms_fitup b');
		return $query->result_array();
  	}

	function piecemark_list($where = null){
		$query = $this->db->select("a.*, b.*, pcms_workpack.company_id AS company_id");

		if(isset($where)){
			$query = $this->db->where($where);
		}
		$query = $this->db->order_by("a.part_id","ASC", FALSE);
		$query = $this->db->join('(select * from pcms_material where status_delete = 0 AND status_inspection <> 12 AND report_resubmit_status = 0) b','a.id = b.id_piecemark',"LEFT");
		$this->db->join('(SELECT id, company_id FROM pcms_workpack) pcms_workpack','pcms_workpack.id = b.id_workpack');
		$query = $this->db->get('pcms_piecemark a');
		return $query->result_array();
	}

	

	function piecemark_list_with_itr($where = null){
		 if(isset($where)){
			 $query = $this->db->where($where);
		 }
		 
		 $query = $this->db->order_by("a.part_id","ASC", FALSE);
		 $query = $this->db->join('(select * from pcms_itr where status_delete = 0 AND status_inspection <> 12 AND report_resubmit_status = 0) b','a.id = b.id_piecemark',"LEFT");
		 $query = $this->db->get('pcms_piecemark a');
		 return $query->result_array();
	}



	function warehouse_mis_mrir($where = null){		
		if(isset($where)){
			$query = $this->db_wh->where($where);
		}
		$query = $this->db_wh->join('qcs_material b','a.unique_no = b.unique_ident_no');
		$query = $this->db_wh->get('pcms_wm_mis_detail a');
		return $query->result_array();
	}



	public function joint_new_process_db($data) {
	    $this->db->insert('joint', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	function drawing_list($where = null, $limit = null){
		if(isset($where)){
			$this->db_eng->where($where);
		}
		$this->db_eng->where("transmittal_status", 1);
		$this->db_eng->where("status_delete", 1);
		if(isset($limit)){
			$this->db_eng->limit($limit);
		}
		$query = $this->db_eng->get('pcms_eng_activity');
		return $query->result_array();
 	}

 	function drawing_register_list_mysql($where = null, $limit = null){
		if(isset($where)){
			$this->db_eng_mysql->where($where);
		}
		//$this->db_eng_mysql->where("transmittal_status", 1);
		$this->db_eng_mysql->where("status_delete", 1);
		if(isset($limit)){
			$this->db_eng_mysql->limit($limit);
		}
		$query = $this->db_eng_mysql->order_by('document_no ASC, transmittal_date DESC');
		$query = $this->db_eng_mysql->get('pcms_eng_drawing_register');
		return $query->result_array();
 	}

 	function drawing_list_mysql($where = null, $limit = null){
		if(isset($where)){
			$this->db_eng_mysql->where($where);
		}
		//$this->db_eng_mysql->where("transmittal_status", 1);
		$this->db_eng_mysql->where("status_delete", 1);
		if(isset($limit)){
			$this->db_eng_mysql->limit($limit);
		}
		$query = $this->db_eng_mysql->order_by('document_no ASC, transmittal_date DESC');
		$query = $this->db_eng_mysql->get('pcms_eng_activity');

		return $query->result_array();
 	}

 	public function fitter_code($where = null) {
	   	if(isset($where)){
		  $query = $this->db->where($where);
		  $query = $this->db->limit("10");
		}	
		$query = $this->db->where("status","1");	 
		$query = $this->db->order_by("fit_up_badge","asc");
		$query = $this->db->get('pcms_fitter');
		return $query->result_array();
	}

	public function welder_code($where = null) {
	   	if(isset($where)){
		  $query = $this->db->where($where);
		  $query = $this->db->limit("10");
		}	
		//$query = $this->db->where("status","1");	 
		$query = $this->db->order_by("wel_code","asc");
		$query = $this->db->get('pcms_welder');
		return $query->result_array();
	}

	public function welder_code_version2($where = null) {
	   	if(isset($where)){
		  $query = $this->db->where($where);
		  $query = $this->db->limit("10");
		}	
		$query = $this->db->where("a.status_actived","1");	 
		$query = $this->db->order_by("a.welder_code","asc");
		$query = $this->db->join('master_welder_detail b','a.id_welder = b.id_welder');
		$query = $this->db->get('master_welder a');
		return $query->result_array();
	}

	public function welder_code_version_view_only($where = null) {
		if(isset($where)){
			$query = $this->db->where($where);
			$query = $this->db->limit("10");
		}	
		
		$query = $this->db->order_by("a.welder_code","asc");
		$query = $this->db->join('master_welder_detail b','a.id_welder = b.id_welder');
		$query = $this->db->get('master_welder a');
		return $query->result_array();
	}

	public function wps_code($where = null) {
	   	if(isset($where)){
		  $query = $this->db->where($where);
		  $query = $this->db->limit("10");
		}	
		$query = $this->db->where("status","1");
		$query = $this->db->order_by("wps_code","asc");
		$query = $this->db->get('pcms_wps');
		return $query->result_array();
	}

	public function wps_code_version2($where = null) {
	   	if(isset($where)){
		  $query = $this->db->where($where);
		  $query = $this->db->limit("10");
		}	
		$query = $this->db->where("status_wps","1");
		$query = $this->db->order_by("wps_no","asc");
		$query = $this->db->get('master_wps');
		return $query->result_array();
	}

	public function wps_code_version2_nolimt($where = null) {
	   	if(isset($where)){
		  $query = $this->db->where($where);
		}	
		$query = $this->db->where("status_wps","1");
		$query = $this->db->order_by("wps_no","asc");
		$query = $this->db->get('master_wps');
		return $query->result_array();
	}

	public function wps_code_version_report($where = null) {
		if(isset($where)){
		$query = $this->db->where($where);
		$query = $this->db->limit("10");
		}		  
		$query = $this->db->order_by("wps_no","asc");
		$query = $this->db->get('master_wps');
		return $query->result_array();
	}

	public function area_name() {
	   	$query = $this->db->where("status","1");	 
		$query = $this->db->order_by("area_name","asc");
		$query = $this->db->get('master_area');
		return $query->result_array();
	}

	function drawing_joint_list($where = null){
		if(isset($where)){
			$this->db->where($where);
		}	
		$this->db->select("
			pcms_joint.drawing_no,
			pcms_joint.drawing_wm,
		");
		$this->db->where("pcms_joint.status_delete", 1);

		$this->db->join('pcms_fitup','pcms_joint.id = pcms_fitup.id_joint',"LEFT");
		$this->db->join('(SELECT id, deck_elevation, company_id FROM pcms_workpack) pcms_workpack','pcms_workpack.id = pcms_fitup.id_workpack');

		$this->db->group_by("
			pcms_joint.drawing_no,
			pcms_joint.drawing_wm,
		");
		$this->db->order_by("pcms_joint.drawing_no","asc");
		$this->db->limit(10);
		
		$query = $this->db->get('pcms_joint');
		return $query->result_array();
 	}


 	function fitup_inspection_list($where = null){
		 if(isset($where)){
			 $query = $this->db->where($where);
		 }
		 //$query = $this->db->where("status_inspection","1");
		 $query = $this->db->select(" 
		 	max(project_code) as project_code,
		 	max(drawing_no) as drawing_no,
		 	max(discipline) as discipline,
		 	max(module) as module,
		 	max(type_of_module) as type_of_module,
		 	max(company) as company,
		 	max(requestor) as requestor,
		 	max(date_request) as date_request,
		 	max(submission_id) as submission_id,
		 	max(status_inspection) as status_inspection,
		 	max(status_resubmit) as status_resubmit
		 	");
		 $query = $this->db->order_by("submission_id","desc");
		 $query = $this->db->group_by("submission_id");
		 $query = $this->db->get('pcms_fitup');
		 return $query->result_array();
	}

	function fitup_inspection_list_cpy($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		$query = $this->db->where("b.drawing_no IS NOT NULL",NULL);
		$query = $this->db->select(" 
			max(b.project_code) as project_code,
			max(b.drawing_no) as drawing_no,
			max(b.discipline) as discipline,
			max(b.module) as module,
			max(b.type_of_module) as type_of_module,
			max(b.company) as company,
			max(b.requestor) as requestor,
			max(b.date_request) as date_request,
			max(b.submission_id) as submission_id,
			max(b.status_inspection) as status_inspection,
			max(b.status_resubmit) as status_resubmit,
			max(b.status_delete) as status_delete,
			max(c.company_id) as wp_company,
			max(c.workpack_no) as workpack_no,
			");
		$query = $this->db->order_by("b.submission_id","desc");
		$query = $this->db->group_by("b.submission_id");
		$query = $this->db->join('pcms_fitup b','a.id = b.id_joint',"LEFT");
		$query = $this->db->join('pcms_workpack c','b.id_workpack = c.id',"LEFT");
		$query = $this->db->where("a.status_delete", 1);
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
   }

	function update_status_inspection($id,$data){       
		$this->db->where('id_fitup', $id);
        $this->db->update('pcms_fitup', $data);
    }

    function update_status_inspection_where($where,$data){       
		$this->db->where($where);
        $this->db->update('pcms_fitup', $data);
    }


  function fitup_client_list($where = null){
		if(isset($where)){
		  $query = $this->db->where($where);
		}
		$query = $this->db->select("
			project_code,
			pcms_fitup.drawing_no,
			pcms_fitup.discipline,
			pcms_fitup.module,
			pcms_fitup.type_of_module,
			max(company) 	 as company,
			max(pcms_joint.deck_elevation) 	 as deck_elevation,
			postpone_reoffer_no,
			status_retransmitted,	
			report_number,
			max(transmitted_by) 	 as transmitted_by,
			max(transmitted_date)  as transmitted_date,			
			max(id_joint) 				 as id_joint,
			max(pcms_fitup.drawing_type)      as drawing_type,
			max(status_inspection) as status_inspection,
			max(status_invitation) as status_invitation,
			max(legend_inspection_auth) as legend_inspection_auth,
			max(client_inspection_by) 	as client_inspection_by,
			max(client_inspection_date) as client_inspection_date,
			max(postpone_remarks) as postpone_remarks,
			max(reoffer_remarks) 	as reoffer_remarks,			
			max(approve_comment) 	as approve_comment,			
			max(client_remarks) 	as client_remarks,
			max(inspection_by) 	as inspection_by,
			max(inspection_datetime) 	as inspection_datetime,
			max(pcms_joint.company_id) as company_wp,
			max(pcms_fitup.postpone_reoffer_no) as postpone_reoffer_no,
		");
		$query = $this->db->group_by("project_code,pcms_fitup.drawing_no,pcms_fitup.discipline,pcms_fitup.module,pcms_fitup.type_of_module,report_number,postpone_reoffer_no,status_retransmitted");
		// $query = $this->db->join('(SELECT id, company_id FROM pcms_workpack) pcms_workpack','pcms_workpack.id = pcms_fitup.id_workpack');
		$query = $this->db->join('pcms_joint', 'pcms_joint.id = pcms_fitup.id_joint');
		$query = $this->db->get('pcms_fitup');
		return $query->result_array();
	}

	function get_detail_of_material_st($project_id = null){
        if(isset($project_id)){
          $this->db_wh->where('a.project_id', $project_id);
        }        
        $this->db_wh->join('pcms_wm_material_catalog b','a.catalog_id = b.id',"LEFT");	    
	    	$this->db_wh->join('pcms_wm_catalog_category c','b.catalog_category_id = c.id',"LEFT");	    
        $this->db_wh->from('qcs_material a');
        $this->db_wh->where('a.status', 5);
        return $this->db_wh->get()->result_array();
    }

    function get_detail_of_material_pp($project_id = null){
        if(isset($project_id)){
          $this->db_wh->where('a.project_id', $project_id);
        }                
	    $this->db_wh->join('pcms_wm_material_pp d','a.catalog_id = d.id',"LEFT");	    
        $this->db_wh->from('qcs_material a');
        $this->db_wh->where('a.status', 5);
        return $this->db_wh->get()->result_array();
    }

  function drawing_list_get_db($where = null, $limit = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		$query = $this->db->where("pcms_joint.status_delete", 1);
		$query = $this->db->get('pcms_joint');
		return $query->result_array();
 	}

	public function fitup_list($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_fitup');
		return $query->result_array();
	}

	// ------------------ server side - request udpate list -------------//
		var $column_order_request_for_update    = array('project_code', 'drawing_no', 'discipline', 'module', 'type_of_module', 'request_by', 'request_date', 'request_reason', 'last_inspect_by', 'approve_by', 'approve_date', 'update_by', 'update_date', 're_approval_by', 're_approval_date', 'status_revise');
		var $column_search_request_for_update   = array('project_code', 'drawing_no', 'discipline', 'module', 'type_of_module', 'request_by', 'request_date', 'request_reason', 'last_inspect_by', 'approve_by', 'approve_date', 'update_by', 'update_date', 're_approval_by', 're_approval_date', 'status_revise');
		var $order_request_for_update           = array('submission_id' => 'DESC');

		public function serverside_request_for_update($status_revise, $project_id, $discipline, $module, $type_of_module, $where = NULL)
		{
		    $this->_serverside_request_for_update($status_revise, $project_id, $discipline, $module, $type_of_module, $where);
		    if ($_POST['length'] != -1) {
		        $this->db->limit($_POST['length'], $_POST['start']);
		    }
		    $query = $this->db->get();
		    return $query->result_array();
		}

		public function count_serverside_request_for_update_all($status_revise, $project_id, $discipline, $module, $type_of_module, $where = NULL)
		{
		    $this->_query_serverside_request_for_update($status_revise, $project_id, $discipline, $module, $type_of_module, $where);
		    return $this->db->count_all_results();
		}


		public function count_serverside_request_for_update_filtered($status_revise, $project_id, $discipline, $module, $type_of_module, $where = NULL)
		{
		    $this->_serverside_request_for_update($status_revise, $project_id, $discipline, $module, $type_of_module, $where);
		    $query = $this->db->get();
		    return $query->num_rows();
		}


		private function _serverside_request_for_update($status_revise, $project_id, $discipline, $module, $type_of_module, $where = NULL)
		{
		    $this->_query_serverside_request_for_update($status_revise, $project_id, $discipline, $module, $type_of_module, $where);
		    $i = 0;
		    foreach ($this->column_search_request_for_update as $item) {
		        if ($_POST['search']['value']) {
		            if ($i === 0) {
		                $this->db->group_start();
		                $this->db->like(('CAST ('.$item.' AS VARCHAR)'), $_POST['search']['value']);
		            } else {
		                $this->db->or_like(('CAST ('.$item.' AS VARCHAR)'), $_POST['search']['value']);
		            }
		            if (count($this->column_search_request_for_update) - 1 == $i) {
		                $this->db->group_end();
		            }
		        }
		        $i++;
		    }
		    if (isset($_POST['order'])) {
		        $this->db->order_by($this->column_order_request_for_update[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		    } else if (isset($this->order_request_for_update)) {
		        $order = $this->order_request_for_update;
		        $this->db->order_by(key($order), $order[key($order)]);
		    }
		}

		private function _query_serverside_request_for_update($status_revise, $project_id, $discipline,$module, $type_of_module, $where = NULL){
			if($where["category"]==2){
				$this->db->select('
			  	revise.id, 
			  	revise.submission_id, 
			  	project_code, 
			  	drawing_no, 
			  	discipline, 
			  	module, 
			  	type_of_module, 
			  	request_by, 
			  	request_date, 
			  	request_reason, 
			  	last_inspect_by, 
			  	approve_by, 
			  	approve_date, 
			  	update_by, 
			  	update_date, 
			  	re_approval_by, 
			  	re_approval_date, 
			  	status_revise,
			  	MAX(pcms_workpack.company_id) AS company_id,
			  	pcms_fitup.report_number,
			  '); 
			  $this->db->from('pcms_revise_history revise');
		  	$this->db->join("pcms_fitup",
		  	" 
		  		CAST(SPLIT_PART(revise.submission_id, ';', 1) AS TEXT) = CAST(pcms_fitup.project_code AS TEXT) AND
		  		CAST(SPLIT_PART(revise.submission_id, ';', 2) AS TEXT) = CAST(pcms_fitup.discipline AS TEXT) AND
		  		CAST(SPLIT_PART(revise.submission_id, ';', 3) AS TEXT) = CAST(pcms_fitup.module AS TEXT) AND
		  		CAST(SPLIT_PART(revise.submission_id, ';', 4) AS TEXT) = CAST(pcms_fitup.type_of_module AS TEXT) AND
		  		CAST(SPLIT_PART(revise.submission_id, ';', 5) AS TEXT) = CAST(pcms_fitup.report_number AS TEXT) AND
		  		CAST(SPLIT_PART(revise.submission_id, ';', 6) AS TEXT) = CAST(pcms_fitup.company_id AS TEXT)
		  	");
	    	$this->db->join('(SELECT id, company_id FROM pcms_workpack) pcms_workpack','pcms_workpack.id = pcms_fitup.id_workpack');
			  $this->db->where('fabrication_type', 2);
			  $this->db->where('status_revise', $status_revise);

			  if($where) {
			    $this->db->where($where);
			  }
			  if($project_id) {
			    $this->db->where('project_code IN ('.$project_id.')');
			  }
			  if($discipline) {
			    $this->db->where('discipline', $discipline);
			  }
			  if($module) {
			    $this->db->where('module', $module);
			  }
			  if($type_of_module) {
			    $this->db->where('type_of_module', $type_of_module);
			  }
			  
			  $this->db->group_by('revise.id, revise.submission_id, project_code, drawing_no, discipline, module, type_of_module, request_by, request_date, request_reason, last_inspect_by, approve_by, approve_date, update_by, update_date, re_approval_by, re_approval_date, status_revise, pcms_fitup.report_number');
			  $this->db->order_by('revise.id DESC');
		  } else {
		  	$this->db->select('
			  	revise.id, 
			  	revise.submission_id, 
			  	project_code, 
			  	drawing_no, 
			  	discipline, 
			  	module, 
			  	type_of_module, 
			  	request_by, 
			  	request_date, 
			  	request_reason, 
			  	last_inspect_by, 
			  	approve_by, 
			  	approve_date, 
			  	update_by, 
			  	update_date, 
			  	re_approval_by, 
			  	re_approval_date, 
			  	status_revise,
			  	MAX(pcms_workpack.company_id) AS company_id,
			  '); 
			  $this->db->from('pcms_revise_history revise');
		  	$this->db->join('pcms_fitup','revise.submission_id = pcms_fitup.submission_id');
	    	$this->db->join('(SELECT id, company_id FROM pcms_workpack) pcms_workpack','pcms_workpack.id = pcms_fitup.id_workpack');
			  $this->db->where('fabrication_type', 2);
			  $this->db->where('status_revise', $status_revise);

			  if($where) {
			    $this->db->where($where);
			  }
			  if($project_id) {
			    $this->db->where('project_code IN ('.$project_id.')');
			  }
			  if($discipline) {
			    $this->db->where('discipline', $discipline);
			  }
			  if($module) {
			    $this->db->where('module', $module);
			  }
			  if($type_of_module) {
			    $this->db->where('type_of_module', $type_of_module);
			  }
			  
			  $this->db->group_by('revise.id, revise.submission_id, project_code, drawing_no, discipline, module, type_of_module, request_by, request_date, request_reason, last_inspect_by, approve_by, approve_date, update_by, update_date, re_approval_by, re_approval_date, status_revise');
			  $this->db->order_by('revise.id DESC');
		  }
		}
	// ------------------ server side - request udpate list -------------//

	public function insert_request_for_update($form_data) {
	  $this->db->insert('pcms_revise_history', $form_data);
	}

	public function proceed_approval_inspection($form_data, $where){
      $this->db->where($where);
      $this->db->update('pcms_fitup', $form_data);
    }

    public function update_request_for_update($form_data, $where) {
	 if(isset($where)) {
	   $this->db->where($where);
	 }
	 $this->db->update('pcms_revise_history', $form_data);
	}

	public function search_last_id($submission_id){
		  $this->db->from('pcms_revise_history');
		  $this->db->where('fabrication_type', 2);
		  $this->db->where('submission_id', $submission_id);
	}

	function pcms_revise_history($where = NULL){
		if(isset($where)){
		$this->db->where($where);
		}
		$query = $this->db->get('pcms_revise_history');
		return $query->result_array();
	}

	// ----------- Approval Log ----------- //

	function add_approval_log($data){
		$this->db->insert("approval_log", $data); 
	}

	function search_data_approval($project_id,$process){
		$query = $this->db->query("SELECT approval_project,approval_code FROM approval_log WHERE approval_project = '$project_id' AND approval_process = '$process' GROUP BY approval_project,approval_code");
		return $query->result_array();
	}

	function get_approval_log($where = NULL){
		if(isset($where)){
		$this->db->where($where);
		}
		$query = $this->db->get('approval_log');
		return $query->result_array();
	}
	
	// ----------- Approval Log ----------- //

	public function insert_attachment_history($form_data) {
		$this->db->insert('pcms_attachment_history', $form_data);
	}

	public function attachment_history_list($where = null) {
		if(isset($where)) {
		$this->db->where($where);
		}

	$this->db->from('pcms_attachment_history');
		$query = $this->db->get(); 
		return $query->result_array();
	}


	public function search_last_id_revise($submission_id){
		$this->db->from('pcms_revise_history');
		$this->db->where('fabrication_type', 2);
		$this->db->where('submission_id', $submission_id);
		$query = $this->db->get(); 
		return $query->result_array();
  	}

		public function attachment_history_list_join($where = null) {
		if(isset($where)) {
		$this->db->where($where);
		}

		$this->db->select('*, history.remarks AS reject_remarks, history.created_by AS created_by, history.created_date AS created_date');
		$this->db->from('pcms_attachment_history history');
		$this->db->join('pcms_fitup fitup','fitup.id_fitup = history.id_process AND process = 2');
		$query = $this->db->get(); 
		return $query->result_array();
	}


	public function get_data_image_surveyor($where = null) {
		if(isset($where)) {
			$this->db->where($where);
		} 
		$query = $this->db->from('pcms_workpack_detail'); 
		$query = $this->db->where("status_delete","1");
		$query = $this->db->get(); 
		return $query->result_array();
	}

	public function get_data_workpack($where = null) {
	
		if(isset($where)) {
		$this->db->where($where);
		}

		$this->db->from('pcms_workpack');

		$query = $this->db->get(); 
		return $query->result_array();
	}

		public function summary_rfi($where = null) {

		if(isset($where)) {
		$this->db->where($where);
		}
		$this->db->select('project_code, report_number, drawing_no, MAX(client_remarks) AS client_remarks,
			status_invitation,
			COUNT(id_fitup) AS total_item, 
			COUNT(CASE WHEN status_inspection = 1 THEN id_fitup END) AS total_pending_smoe,
		COUNT(CASE WHEN status_inspection = 2 THEN id_fitup END) AS total_rejected_smoe,
		COUNT(CASE WHEN status_inspection = 3 THEN id_fitup END) AS total_approved_smoe,
		COUNT(CASE WHEN status_inspection = 4 THEN id_fitup END) AS total_hold_smoe,
		COUNT(CASE WHEN status_inspection = 5 THEN id_fitup END) AS total_pending_client,
		COUNT(CASE WHEN status_inspection = 6 THEN id_fitup END) AS total_rejected_client,
		COUNT(CASE WHEN status_inspection = 7 THEN id_fitup END) AS total_approved_client,
		COUNT(CASE WHEN status_inspection = 8 THEN id_fitup END) AS total_request_for_update,
		COUNT(CASE WHEN status_inspection = 9 THEN id_fitup END) AS total_approve_comment,
		COUNT(CASE WHEN status_inspection = 10 THEN id_fitup END) AS total_postponed,
		COUNT(CASE WHEN status_inspection = 11 THEN id_fitup END) AS total_reoffer,
		COUNT(CASE WHEN status_inspection = 12 THEN id_fitup END) AS total_void,
			inspector_id, time_inspect, location_inspect, discipline, module, type_of_module,legend_inspection_auth, MAX(id_workpack) AS id_workpack, area_v2, location_v2, point_v2, MAX(area) AS area, postpone_reoffer_no,
			MAX(client_inspection_by) AS inspection_client_by,
			MAX(wp.company_id) AS company_id,
		MAX(client_inspection_date) AS inspection_client_datetime,
			');
		$this->db->from('pcms_fitup');
    $this->db->join('(SELECT id, company_id FROM pcms_workpack) wp','wp.id = pcms_fitup.id_workpack');
		$this->db->group_by('project_code, report_number, drawing_no,inspector_id, time_inspect, location_inspect, discipline, module, type_of_module,legend_inspection_auth, area_v2, location_v2, point_v2, postpone_reoffer_no, status_invitation');
		$this->db->order_by('report_number ASC, postpone_reoffer_no ASC');
		$query = $this->db->get(); 
		return $query->result_array();
	}

		function fu_list($where = null){
		if(isset($where)){
		$this->db->where($where);
		}
		$query = $this->db->order_by('id_fitup', 'DESC');
		$query = $this->db->get('pcms_fitup');
		return $query->result_array();
	}

		function fu_wp_list($where = null){
			if(isset($where)){
				$this->db->where($where);
			}
      $query = $this->db->select('*,pf.drawing_no as drawing_no, pw.company_id AS company_id');
			$query = $this->db->order_by('id_fitup', 'DESC');
			$query = $this->db->join('pcms_workpack pw', 'pf.id_workpack = pw.id');
			$query = $this->db->get('pcms_fitup pf');
			return $query->result_array();
		}

	public function fu_update_process_db($data, $where) {
		$this->db->where($where);
		$this->db->update("pcms_fitup", $data);
	}


	function template_revision_history($where = null){

			if(isset($where)){
				$query = $this->db->where($where);
			}
			$query = $this->db->get('pcms_update_revision_log');
			return $query->result_array();

		}

		public function autocomplete_submission_id($submission_id) {
			$this->db->select('submission_id');
			$this->db->from('pcms_fitup');
			$this->db->where($submission_id);
			$this->db->group_by('submission_id');
			$this->db->limit(5);
			$query = $this->db->get(); 
			return $query->result_array();
		}

		function show_attachment_redline($where = null){	
			if(isset($where)){	
				$query = $this->db->where($where);
			}
			$query = $this->db->get('pcms_attachment_redline');
			return $query->result_array();
		}  

		function insert_attachment_redline($data){
			convert2null($data);
			$this->db->insert("pcms_attachment_redline", $data);
			return $this->db->insert_id();
		}

		public function delete_attachment_redline($id){
			$this->db->where('id_redline', $id);
			$this->db->delete('pcms_attachment_redline');
		}

		function update_attachment_redline($id,$data){       
			$this->db->where('id_redline', $id);
			$this->db->update('pcms_attachment_redline', $data);
		}

		function fitup_client_list_summary($where = null){
			if(isset($where)){
			$query = $this->db->where($where);
			}
			$query = $this->db->select("
				project_code,
				drawing_no,
				discipline,
				module,
				type_of_module,
				max(company) 	 as company,
				max(deck_elevation) 	 as deck_elevation,
				postpone_reoffer_no,
				status_retransmitted,	
				report_number,
				max(transmitted_by) 	 as transmitted_by,
				max(transmitted_date)  as transmitted_date,			
				max(id_joint) 				 as id_joint,
				max(drawing_type)      as drawing_type,
				max(status_inspection) as status_inspection,
				max(status_invitation) as status_invitation,
				max(legend_inspection_auth) as legend_inspection_auth,
				max(client_inspection_by) 	as client_inspection_by,
				max(client_inspection_date) as client_inspection_date,
				max(postpone_remarks) as postpone_remarks,
				max(reoffer_remarks) 	as reoffer_remarks,			
				max(approve_comment) 	as approve_comment,			
				max(client_remarks) 	as client_remarks,
				max(inspection_by) 	as inspection_by,
				max(inspection_datetime) 	as inspection_datetime,
				
				");
			$query = $this->db->group_by("project_code,drawing_no,discipline,module,type_of_module,report_number,postpone_reoffer_no,status_retransmitted");
			$query = $this->db->join('(SELECT id, deck_elevation FROM pcms_workpack) pcms_workpack','pcms_workpack.id = pcms_fitup.id_workpack');
			$query = $this->db->get('pcms_fitup');
			return $query->result_array();
		}

		function get_report_no($where = null, $limit = null){
			if(isset($where)){
				$query = $this->db->where($where);
			}
			if(isset($limit)){
				$query = $this->db->limit($limit);
			}
			$query = $this->db->join('(SELECT id, company_id FROM pcms_workpack) pcms_workpack','pcms_workpack.id = pcms_fitup.id_workpack');
			$query = $this->db->get('pcms_fitup');
			return $query->result_array();
		}

		function fitup_inspection_list_cpy_drawing($where = null){
			if(isset($where)){
				$query = $this->db->where($where);
			}
			$query = $this->db->where("b.drawing_no IS NOT NULL",NULL);
			$query = $this->db->select(" 
				max(b.project_code) as project_code,
				max(b.drawing_no) as drawing_no,
				max(b.discipline) as discipline,
				max(b.module) as module,
				max(b.type_of_module) as type_of_module,
				max(b.company) as company,
				max(b.requestor) as requestor,
				max(b.date_request) as date_request,
				max(b.submission_id) as submission_id,
				max(b.status_inspection) as status_inspection,
				max(b.status_resubmit) as status_resubmit,
				max(c.company_id) as wp_company,
				max(c.workpack_no) as workpack_no,
				max(a.drawing_wm) as drawing_wm,
				max(a.drawing_no) as drawing_no,
				max(b.reoffer_remarks) as reoffer_remarks,
				");
			$query = $this->db->order_by("b.submission_id","desc");
			$query = $this->db->group_by("b.submission_id,a.drawing_no,a.drawing_wm");
			$query = $this->db->join('pcms_fitup b','a.id = b.id_joint',"LEFT");
			$query = $this->db->join('pcms_workpack c','b.id_workpack = c.id',"LEFT");
			$query = $this->db->where("a.status_delete", 1);

			$query = $this->db->get('pcms_joint a');
			return $query->result_array();
	}


	function fitup_client_list_summary_drawing($where = null){
		if(isset($where)){
		$query = $this->db->where($where);
		}
		$query = $this->db->select("
			project_code,
			drawing_no,
			max(drawing_wm) as drawing_wm,
			discipline,
			module,
			type_of_module,
			max(company) 	 as company,
			max(deck_elevation) 	 as deck_elevation,
			postpone_reoffer_no,
			status_retransmitted,	
			report_number,
			max(transmitted_by) 	 as transmitted_by,
			max(transmitted_date)  as transmitted_date,			
			max(id_joint) 				 as id_joint,
			max(drawing_type)      as drawing_type,
			max(status_inspection) as status_inspection,
			max(status_invitation) as status_invitation,
			max(legend_inspection_auth) as legend_inspection_auth,
			max(client_inspection_by) 	as client_inspection_by,
			max(client_inspection_date) as client_inspection_date,
			max(postpone_remarks) as postpone_remarks,
			max(reoffer_remarks) 	as reoffer_remarks,			
			max(approve_comment) 	as approve_comment,			
			max(client_remarks) 	as client_remarks,
			max(inspection_by) 	as inspection_by,
			max(inspection_datetime) 	as inspection_datetime,
			max(reoffer_remarks) as reoffer_remarks,
			
			");
		$query = $this->db->group_by("project_code,drawing_no,discipline,module,type_of_module,report_number,postpone_reoffer_no,status_retransmitted,drawing_wm");
		$query = $this->db->join('(SELECT id, deck_elevation FROM pcms_workpack) pcms_workpack','pcms_workpack.id = pcms_fitup.id_workpack');
		$query = $this->db->join('(SELECT id, drawing_wm FROM pcms_joint) pcms_joint','pcms_joint.id = pcms_fitup.id_joint');
		$query = $this->db->get('pcms_fitup');
		return $query->result_array();
	}


	function fitup_inspection_list_counting_status($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		$query = $this->db->where("drawing_no IS NOT NULL",NULL);	
		$query = $this->db->join('(SELECT id,status_internal from pcms_joint) b',"a.id_joint = b.id","left");
		$query = $this->db->get('pcms_fitup a');
		return $query->result_array();
	}

	function fitup_inspection_list_counting_status_num_rows($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		// $query = $this->db->select("count(a.id_joint) as total_joint",NULL);	
		$query = $this->db->select("a.id_joint as total_joint",NULL);	
		$query = $this->db->where("drawing_no IS NOT NULL",NULL);	
		$query = $this->db->join('(SELECT id,status_internal from pcms_joint) b',"a.id_joint = b.id","left");
		$query = $this->db->get('pcms_fitup a');
		return $query->num_rows();
	}

	public function get_last_status_revise_history($where){	 
		$this->db->from('pcms_update_revision_log a');
		$this->db->join('pcms_revise_history b',"a.id_request_update = b.id",'left');
		$this->db->where($where);   
		//$this->db->limit(1);
		//$this->db->order_by('a.id',"DESC");
		return $this->db->get()->result_array();
	} 

	function drawing_register_table($where = null, $limit = null){
		if(isset($where)){
			$this->db_eng_mysql->where($where);
		}  
		$query = $this->db_eng_mysql->get('pcms_eng_drawing_register');
		return $query->result_array();
	}

	function select_itp_revision_master($where = null){
		if(isset($where)){
			$this->db->where($where);
		}	 
		$query = $this->db->order_by('date_affected','ASC');
		$query = $this->db->get('master_itp');
		return $query->result_array();
	}

	// -------------------Server Side Client----------------------  //

	var $column_order_client_rfi    = array('CAST(project_code AS VARCHAR)','CAST(report_number AS VARCHAR)','drawing_no','CAST(discipline AS Varchar)','CAST(module AS VARCHAR)','CAST(type_of_module AS VARCHAR)','CAST(deck_elevation AS VARCHAR)','CAST(postpone_reoffer_no AS VARCHAR)','CAST(transmitted_by AS VARCHAR)','CAST(transmitted_date AS VARCHAR)','status_inspection','status_invitation','submission_id');
    var $column_search_client_rfi  = array('CAST(project_code AS VARCHAR)','CAST(report_number AS VARCHAR)','drawing_no');
    var $order_client_rfi          = array('report_number' => 'DESC');
    public function serverside_client_rfi($where = null, $status_inspection, $type, $company_id)
    {
        $this->_serverside_client_rfi($where, $status_inspection, $type, $company_id);
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

	public function count_serverside_client_rfi_all($where = null, $status_inspection, $type, $company_id)
    {
        $this->_query_serverside_client_rfi($where, $status_inspection, $type, $company_id);
        return $this->db->count_all_results();
    }

	public function count_serverside_client_rfi_filtered($where = null, $status_inspection, $type, $company_id)
    {
        $this->_serverside_client_rfi($where, $status_inspection, $type, $company_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

	private function _serverside_client_rfi($where = null, $status_inspection, $type, $company_id)
    {
        $this->_query_serverside_client_rfi($where, $status_inspection, $type, $company_id);
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

	private function _query_serverside_client_rfi($where = null, $status_inspection, $type, $company_id){
		$this->db->select("
			max(submission_id) as submission_id,
			project_code, 
			report_number, 
			drawing_no, 
			project_code, 
			discipline, 
			module, 
			type_of_module, 
			postpone_reoffer_no, 
			MAX(transmitted_by) AS transmittal_by, 
			MAX(transmitted_date) AS transmittal_datetime, 
			MAX(status_invitation) AS status_invitation, 
			MAX(legend_inspection_auth) AS legend_inspection_auth,
			MAX(document_approval_by) AS document_approval_by,
			COUNT(CASE WHEN status_inspection = 5 THEN 1 END) AS total_pending,
			COUNT(CASE WHEN status_inspection = 6 THEN 1 END) AS total_reject,
			COUNT(CASE WHEN status_inspection = 7 THEN 1 END) AS total_approved,
			COUNT(CASE WHEN status_inspection = 9 THEN 1 END) AS total_approved_with_comment,
			COUNT(CASE WHEN status_inspection = 10 THEN 1 END) AS total_postponed,
			COUNT(CASE WHEN status_inspection = 11 THEN 1 END) AS total_reoffer,
			COUNT(CASE WHEN status_inspection = 12 THEN 1 END) AS total_returned,
			COUNT(id_fitup) AS total_material,
			MAX(status_inspection) AS status_inspection,
			max(inspection_by) 	as inspection_by, 
			max(inspection_datetime) 		as inspection_datetime, 
			max(client_inspection_by) 		as inspection_client_by, 
			max(client_inspection_date) 	as inspection_client_datetime,		
			max(document_approval_date) 	as document_approval_date,		
			max(deck_elevation) AS deck_elevation,
			max(company_id_wp) AS company_id,
			max(requested_for_update) AS requested_for_update,
			max(add_comment) AS add_comment,
			max(status_retransmitted) AS status_retransmitted,
		");
		$this->db->from('pcms_fitup');  
		// $this->db->join('(SELECT id, deck_elevation, company_id as company_id_wp FROM pcms_workpack WHERE company_id = '.$company_id.') pcms_workpack','pcms_workpack.id = pcms_fitup.id_workpack'); 
		$this->db->join('(SELECT id, company_id as company_id_wp FROM pcms_workpack) pcms_workpack','pcms_workpack.id = pcms_fitup.id_workpack'); 
		$this->db->join('(SELECT id as id_joint_temp,  deck_elevation, status_delete FROM pcms_joint) pcms_joint','pcms_joint.id_joint_temp = pcms_fitup.id_joint');
		if(isset($where)) {
		  $this->db->where($where);
		}
   
		$this->db->where('pcms_joint.status_delete <> 0', null); 
		$this->db->where('report_number is not null', null); 

		 
	//   $this->db->where('(status_resubmit <> 1 AND status_retransmitted = 0)', null); 
	  $this->db->where('status_inspection <> 12', null); 
	  
	  if ($type != "summary") {
		$this->db->where('status_inspection IN (5)', null); 
	  }
	 

	  if($status_inspection == 5) {
		$this->db->having('COUNT(CASE WHEN status_inspection = 5 THEN 1 END) > 0');
	  }

	  if($status_inspection == 6) {
		$this->db->having('
		  COUNT(CASE WHEN status_inspection = 5 THEN 1 END) = 0 
		  AND COUNT(CASE WHEN status_inspection = 6 THEN 1 END) > 0
		');
	  }

	  if($status_inspection == 7) {
		$this->db->having("COUNT(CASE WHEN status_inspection = 5 THEN 1 END) = 0 
		  AND COUNT(CASE WHEN status_inspection = 6 THEN 1 END) = 0 
		  AND COUNT(CASE WHEN status_inspection = 7 THEN 1 END) > 0
		");
	  }

	  if($status_inspection == 9) {
		$this->db->having("COUNT(CASE WHEN status_inspection = 9 THEN 1 END) > 0
		");
	  }

	  if($status_inspection == 9) {
		$this->db->having("COUNT(CASE WHEN status_inspection = 9 THEN 1 END) > 0
		");
	  }
	  if($status_inspection == 10) {
		$this->db->having("COUNT(CASE WHEN status_inspection = 10 THEN 1 END) > 0
		");
	  }

	  if($status_inspection == 11) {
		$this->db->having("COUNT(CASE WHEN status_inspection = 11 THEN 1 END) > 0
		");
	  }

	  if($status_inspection == 12) {
		$this->db->having("(COUNT(id_fitup) = COUNT(CASE WHEN status_inspection = 12 THEN 1 END))");
	  } 
		
		$this->db->group_by('project_code, report_number, drawing_no, discipline, module, type_of_module, postpone_reoffer_no, pcms_workpack.company_id_wp, deck_elevation'); 
	  }


	// ----------------Server side Client--------------------  //

	// ---------------Server Side Inspection---------------------  //


	var $column_order_inspection_rfi    = array('CAST(project_code AS VARCHAR)','workpack_no','submission_id','drawing_no','CAST(discipline AS Varchar)','CAST(module AS VARCHAR)','CAST(type_of_module AS VARCHAR)','CAST(requestor AS VARCHAR)','CAST(date_request AS VARCHAR)','status_inspection','submission_id','submission_id');
	var $column_search_inspection_rfi  = array('CAST(project_code AS VARCHAR)','workpack_no','submission_id','drawing_no','CAST(discipline AS Varchar)','CAST(module AS VARCHAR)','CAST(type_of_module AS VARCHAR)','CAST(requestor AS VARCHAR)','CAST(date_request AS VARCHAR)','CAST(status_inspection AS VARCHAR)','CAST(submission_id AS VARCHAR)','submission_id');
	var $order_inspection_rfi          = array('submission_id' => 'DESC');
	public function serverside_inspection_rfi($where = null)
	{
		$this->_serverside_inspection_rfi($where);
		if ($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	public function count_serverside_inspection_rfi_all($where = null)
	{
		$this->_query_serverside_inspection_rfi($where);
		return $this->db->count_all_results();
	}


	public function count_serverside_inspection_rfi_filtered($where = null)
	{
		$this->_serverside_inspection_rfi($where);
		$query = $this->db->get();
		return $query->num_rows();
	}


	private function _serverside_inspection_rfi($where = null)
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

	private function _query_serverside_inspection_rfi($where = null){

		if(isset($where)) {
		$this->db->where($where);
		}

		$this->db->select("
			MAX(project_code) AS project_code, 
			MAX(drawing_no) AS drawing_no, 
			MAX(workpack_no) AS workpack_no, 
			submission_id, 
			MAX(pcms_workpack.company_id) AS company_id, 
			MAX(discipline) AS discipline, 
			MAX(module) AS module, 
			MAX(type_of_module) AS type_of_module, 
			MAX(requestor) AS requestor ,
			MAX(date_request) AS date_request,
			MIN(status_inspection) AS status_inspection,  
			MAX(revision_status_inspection) AS revision_status_inspection,      
			COUNT(id_fitup) AS total_material,
			MAX(status_resubmit) AS status_resubmit,
			MAX(pcms_joint.deck_elevation) AS deck_elevation,

			COUNT(CASE WHEN status_inspection IN (3,5,6,7,9,10,11) THEN 1 END) AS total_approved,
			COUNT(CASE WHEN status_inspection = 4 THEN 1 END) AS total_pending_qc,
			COUNT(CASE WHEN status_inspection = 2 THEN 1 END) AS total_rejected,
			COUNT(CASE WHEN status_inspection = 1 THEN 1 END) AS pending_approval,
			MAX(pcms_workpack.company_id) AS company_id,
			MAX(test_pack_no) AS test_pack_no,
			MAX(postpone_reoffer_no) AS postpone_reoffer_no,
		");

		$this->db->from('pcms_fitup');
		$this->db->join('(SELECT id, workpack_id,status_internal,deck_elevation, test_pack_no FROM pcms_joint) pcms_joint','pcms_joint.id = pcms_fitup.id_joint');
		$this->db->join('(SELECT id, workpack_no, company_id FROM pcms_workpack) pcms_workpack','pcms_workpack.id = pcms_fitup.id_workpack');

		$this->db->where('status_inspection != 0');
		$this->db->where('requested_for_update', 0);
		$this->db->group_by('submission_id');
		// $this->db->order_by('date_request DESC');
	}


	// ---------------Server Side Inspection---------------------  //

	public function get_array_report_number($where){
		$this->db->select('report_number');
		$this->db->from('pcms_fitup');
		$this->db->where($where); 
		$this->db->where('report_number IS NOT NULL',NULL); 
		$this->db->group_by('report_number');
		return $this->db->get()->result_array();
	}

	function template_piecemark_list($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		
		$query = $this->db->select("a.ref_pos_1,a.part_id,a.id"); 
		$query = $this->db->order_by("a.part_id","ASC", FALSE); 
		$query = $this->db->get('pcms_piecemark a');
		return $query->result_array();
   }

  public function master_surveyor_status($where = null) {
		if(isset($where)){
			$query = $this->db->where($where); 
		}		   
		$query = $this->db->get('master_surveyor_status');
		return $query->result_array();
	}

	public function master_joint_type($where = null) {
		if(isset($where)){
			$query = $this->db->where($where); 
		}		   
		$query = $this->db->get('master_joint_type');
		return $query->result_array();
	}

	public function fitup_list_remarks($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->order_by("id_fitup","DESC", FALSE); 
		$query = $this->db->limit("1"); 
		$query = $this->db->get('pcms_fitup');
		return $query->result_array();
	}

	function joint_list_excel_view($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		} 
		$query = $this->db->get('pcms_fu_excel');
		return $query->result_array();
  	}

	  public function autocomplete_workpack_no($where= null,$workpack_no) {
		if(isset($where)){
			$query = $this->db->where($where);
		} 
		$this->db->select('workpack_no');
		$this->db->from('pcms_workpack');
		$this->db->join('pcms_joint','pcms_workpack.id = pcms_joint.workpack_id');
		$this->db->like('workpack_no', $workpack_no);
		$this->db->group_by('workpack_no');
		$this->db->limit(10);
		$query = $this->db->get(); 
		return $query->result_array();
	 }

	 function piecemark_list_itr($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		
		$query = $this->db->order_by("a.part_id","ASC", FALSE);
		$query = $this->db->join('(select * from pcms_itr where status_delete = 0 AND status_inspection <> 12 AND report_resubmit_status = 0) b','a.id = b.id_piecemark',"LEFT");
		$query = $this->db->get('pcms_piecemark a');
		return $query->result_array();
   }

	public function fit_up_notification($where = null)
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
			company_id,
			area_v2,
			location_v2,
			point_v2,
			invitation_remarks,
			MAX(postpone_reoffer_no) AS postpone_reoffer_no,
			MAX(transmitted_by) AS transmittal_by, 
			MAX(transmitted_date) AS transmittal_datetime, 
			MAX(status_invitation) AS status_invitation, 
			MAX(legend_inspection_auth) AS legend_inspection_auth,
			MAX(status_inspection) AS status_inspection,
			max(inspection_by) 	as inspection_by, 
			max(inspector_id) 	as inspector_id, 
			max(time_inspect) 	as time_inspect, 
			max(inspection_datetime) as inspection_datetime, 
			max(client_inspection_by) as inspection_client_by, 
			max(client_inspection_date) as inspection_client_datetime,
			pcms_joint.deck_elevation as deck_elevation,

			");
		$query = $this->db->group_by("project_code,drawing_no,discipline,module,type_of_module,report_number,company_id, deck_elevation, area_v2, location_v2, point_v2, invitation_remarks");
		$query = $this->db->order_by("company_id", "asc");
		$query = $this->db->order_by("deck_elevation", "asc");
		$this->db->join('(SELECT id as id_joint_temp, deck_elevation FROM pcms_joint) pcms_joint','pcms_joint.id_joint_temp = pcms_fitup.id_joint');
		$query = $this->db->get('pcms_fitup');
		return $query->result_array();
	}

	function drawing_list_get_db_v2($where = null, $limit = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}

		$query = $this->db->select('pcms_joint.*, pcms_workpack.company_id as company_id');
		$query = $this->db->where("pcms_joint.status_delete", 1);
		$query = $this->db->from('pcms_joint');
		$query = $this->db->join('pcms_fitup', 'pcms_fitup.id_joint = pcms_joint.id', 'LEFT');
		$query = $this->db->join('pcms_workpack', 'pcms_workpack.id = pcms_joint.workpack_id');
		return $query->get()->result_array();
 	}

	 public function get_id_fitup($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_fitup');
		return $query->result_array();
	}

	function fitup_data($where = NULL, $order_by = null){
		if($where){
			$query = $this->db->where($where);
		}

    if(isset($order_by)) {
      $this->db->order_by($order_by);
    }

		$query = $this->db->get('pcms_fitup');
		return $query->result_array();
	}

	public function fitup_template($where = null, $order_by = null){  
		if(isset($where)) {
			$this->db->where($where);
		}
		if(isset($order_by)) {
			$this->db->order_by($order_by);
		}

		$this->db->select('
			pcms_fitup.id_fitup,
			pcms_joint.project,
			pcms_joint.discipline,
			pcms_joint.module,
			pcms_joint.type_of_module, 
			pcms_joint.joint_no, 
			pcms_joint.drawing_no as drawing_no, 
			pcms_joint.drawing_wm as drawing_wm, 
			pcms_joint.company_id,
			pcms_joint.deck_elevation as deck_elevation,

		'); 
		
		$this->db->join('pcms_joint','pcms_joint.id = pcms_fitup.id_joint');
		$this->db->limit(30);
		return $this->db->get("pcms_fitup")->result_array();
	}

	function update_fitup_by_excel($where,$data){       
		$this->db->where($where);
        $this->db->update('pcms_fitup', $data);
    }

	public function fitup_list_drawing($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		$this->db->select('
			drawing_no,
		');
		$query = $this->db->group_by('drawing_no');
		$query = $this->db->get('pcms_fitup');
		return $query->result_array();
	}

	public function fitup_list_v2($where = null){
		if(isset($where)){
			$this->db->where($where);
		}

		$this->db->select('
			pcms_fitup.*,
			pcms_joint.deck_elevation,

		'); 
		$query = $this->db->join('pcms_joint', 'pcms_joint.id = pcms_fitup.id_joint');
		$query = $this->db->order_by('id_fitup', 'ASC');
		$query = $this->db->get('pcms_fitup');
		return $query->result_array();
	}



}
/*
	End Model Auth_mod
*/