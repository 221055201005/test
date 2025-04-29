<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Irn_approval_mv extends CI_Controller {

	public function __construct() {
			
		parent::__construct();
		$this->load->helper('browser');
		$this->load->helper('cookies');
		$data_cookies = helper_cookies(@$this->input->get('user'));

		$this->load->model('home_mod');
		$this->load->model('general_mod');
		$this->load->model('irn_approval_mv_mod');

		$this->user_cookie 		  	= $data_cookies['data_user'];
		$this->permission_cookie  	= $data_cookies['data_permission'];
	    $this->sidebar 				= "irn/sidebar";

		$this->smtp  = smtp_config();

		$datadb = $this->general_mod->portal_server_list();
		foreach ($datadb as $key => $value) {
			$this->server_app[] = $value['ip_address'];
		}

		if($this->user_cookie[12] == getenv('IP_FIREWALL_GATEWAY')){
			$this->link_server = getenv('LINK_SERVER_OUTSIDE');
		} else { 
			$this->link_server = getenv('LINK_SERVER');
		}

		$this->ftp  = ftp_config_syn();
		
	}

	public function irn_list($status_inspection = null){ 

		$data['post']   = $this->input->post();

		$status_inspection = $this->encryption->decrypt(strtr(@$status_inspection, '.-~', '+=/'));	


		// ========================= DATA REPORT NO =========================
		$where = [];
		$where["category"] 		= "irn_rfi_scm";
		$where["status_delete"] = 1;
		$datadb = $this->general_mod->master_report_number($where);
		foreach ($datadb as $key => $value) {
			$report_no_list[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']] = $value;
		}
		unset($where);
		// ==================================================================

		// =========================== PROJECT ==============================
		$data_project = [];

		$where = [];
		$where["status"] = 1;
		$datadb = $this->general_mod->data_project($where);
		foreach ($datadb as $key => $value) {
			$data_project[] = $value;
		}
		unset($where);

		$data['data_project'] = $data_project;
		// ==================================================================

		// ========================= DISCIPLINE =============================
		$data_discipline = [];

		$where = [];
		$where["status"] = 1;
		$where["status_delete"] = 1;
		$where["production_status"] = 1;
		$datadb = $this->general_mod->discipline_list($where);
		foreach ($datadb as $key => $value) {
			$data_discipline[] = $value;
		}
		unset($where);

		$data['data_discipline'] = $data_discipline;
		// ==================================================================

		// =========================== MODULE ===============================
		$data_module = [];

		$where = [];
		$where["status"] = 1;
		$where["status_delete"] = 1;
		$datadb = $this->general_mod->data_module($where);
		foreach ($datadb as $key => $value) {
			$data_module[] = $value;
		}
		unset($where);

		$data['data_module'] = $data_module;
		// ==================================================================

		// ====================== TYPE OF MODULE ============================
		$data_type_of_module = [];

		$where = [];
		$where["status_delete"] = 1;
		$datadb = $this->general_mod->type_of_module($where);
		foreach ($datadb as $key => $value) {
			$data_type_of_module[] = $value;
		}
		unset($where);

		$data['data_type_of_module'] = $data_type_of_module;
		// ==================================================================

		// ========================= COMPANY ================================
		$data_company = [];

		$where = [];
		$where["status_delete"] = 1;
		$datadb = $this->general_mod->company($where);
		foreach ($datadb as $key => $value) {
			$data_company[] = $value;
		}
		unset($where);

		$data['data_company'] = $data_company;
		// ==================================================================


		$data_report_no = [];

		$where = [];
		$where["status_inspection"] = $status_inspection;
		$where["category_irn"] 		= 1;
		$where["id_piecemark IS NOT NULL"] = NULL;
		$datadb = $this->irn_approval_mv_mod->irn_mv_distinct_list($where);
		foreach ($datadb as $key => $value) {
			$_report_no = $report_no_list[$value['project_id']][$value['discipline']][$value['module']][$value['type_of_module']]['report_no'];

			$data_report_no[] = array(
				'report_no' => @$value['report_number'],
				'name' => @$_report_no.''.$value['report_number']
			);
		}
		unset($where);

		$data['data_report_no'] = $data_report_no;

		$data['serverside']     		= 'irn_approval_mv/irn_list_serverside';
		$data['status_inspection'] 	= $status_inspection;
		$data['user_cookie'] 	 			= $this->user_cookie;
		$data['user_permission'] 		= $this->permission_cookie;
		$data['meta_title']  	 			= 'IRN Material List';
		$data['subview']     	 			= 'irn_approval_mv/irn_list';
    	$data['sidebar']     	 		= $this->sidebar;
		$this->load->view('index', $data); 
	}

	public function irn_list_serverside(){
      // error_reporting(0);

		$post = $this->input->post();

		$report_no = $post['report_no'];

		$project = $post['project'];
		$discipline = $post['discipline'];
		$module = $post['module'];
		$type_of_module = $post['type_of_module'];
		$company = $post['company'];

		$status_inspection = $post['status_inspection'];

		$check_all = $post['check_all'];

		$exclude = $post['exclude'];
		$include = $post['include'];

		$exclude = explode(";", $exclude);
		$include = explode(";", $include);

		$data                     = [];

		$where_datatable = [];

		if($report_no){
			$where_datatable["report_number"] = $report_no;
		}

		if($project){
			$where_datatable["project_id"] = $project;
		}

		if($discipline){
			$where_datatable["discipline"] = $discipline;
		}

		if($type_of_module){
			$where_datatable["type_of_module"] = $type_of_module;
		}

		if($company){
			$where_datatable["company"] = $company;
		}
 
		$where_datatable["id_piecemark IS NOT NULL"] = null;
		$where_datatable["category_irn"] = 1;
		$where_datatable["status_inspection"] = $status_inspection;

		if($this->permission_cookie[0]!=1){ // Permission for Project and Company
			$where_datatable["project_id"] = $this->user_cookie[10];
		}

		// ====================== REPORT NO ============================
        $where["category"] 		= "irn_rfi_scm";
        $where["status_delete"] = 1;
        $datadb = $this->general_mod->master_report_number($where);
        unset($where);
  
        foreach($datadb as $value) {
        	$report_no_list[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']] = $value;
        }
        // =============================================================


		$list = $this->irn_approval_mv_mod->irn_mv_datatable_db('data', $where_datatable);

		if($list) {

	      	// ====================== PIECEMARK ============================
	        $_data    = array_column($list, 'id_piecemark');
	        $where["id IN ('".implode("', '", $_data)."')"] = NULL;
	        $datadb = $this->general_mod->pcms_piecemark($where);
	        unset($where);
	  
	        foreach($datadb as $value) {
	        	$piecemark_list[$value['id']] = $value;

	        	$arr_part_id[] 	= $value['part_id'];
	        	$arr_workpack[] = $value['workpack_id'];
	        }
	        // =============================================================

	        // ====================== WORKPACK ================================
	        if(isset($arr_workpack)){
		        $where["id IN ('".implode("', '", $arr_workpack)."')"] = NULL;
		        $datadb = $this->general_mod->workpack_list($where);
		        unset($where);
		  
		        foreach($datadb as $value) {
		        	$workpack_list[$value['id']] = $value;

		        	$arr_workpack_no[] = $value['workpack_no'];
		        }
	        }
	        // =============================================================

	        // ======================== MIS ================================
	        if(isset($arr_workpack_no)){
		        $where["part_no IN ('".implode("', '", $arr_workpack_no)."')"] = NULL;
		        $datadb = $this->general_mod->mis_detail_list($where);
		        unset($where);
		  
		        foreach($datadb as $value) {
		        	$mis_detail_list[$value['part_no']] = $value;
		        }
	        }
	        // =============================================================

	        // ====================== DISCIPLINE ===========================
	        $_data    = array_column($list, 'discipline');
	        $where["id IN ('".implode("', '", $_data)."')"] = NULL;
	        $datadb = $this->general_mod->discipline_list($where);
	        unset($where);
	  
	        foreach($datadb as $value) {
	        	$discipline_list[$value['id']] = $value;
	        }
	        // =============================================================

	        // ======================== MODULE =============================
	        $_data    = array_column($list, 'module');
	        $where["mod_id IN ('".implode("', '", $_data)."')"] = NULL;
	        $datadb = $this->general_mod->data_module($where);
	        unset($where);
	  
	        foreach($datadb as $value) {
	        	$module_list[$value['mod_id']] = $value;
	        }
	        // =============================================================

	        // ================== TYPE OF MODULE ===========================
	        $_data    = array_column($list, 'type_of_module');
	        $where["id IN ('".implode("', '", $_data)."')"] = NULL;
	        $datadb = $this->general_mod->type_of_module($where);
	        unset($where);
	  
	        foreach($datadb as $value) {
	        	$type_of_module_list[$value['id']] = $value;
	        }
	        // =============================================================
		}

      $status_inspection_list[1] = "<span class='badge badge-primary'>Ready To Inspect</span>";

      foreach($list as $value) {

      	$report_no = $report_no_list[$value['project_id']][$value['discipline']][$value['module']][$value['type_of_module']]['report_no'];

      	$status_checked = 0;
      	if($check_all == 1){
      		$status_checked = 1;
      		if(in_array($value['id_irn'], $exclude)){
      			$status_checked = 0;
      		}
      	} 

      	else {
      		if(in_array($value['id_irn'], $include)){
      			$status_checked = 1;
      		}
      	}

        $row                    = [];

        $_input = [];
        $_input[] = "<input type='hidden' name='id' value='".$value['id_irn']."' />";
        $_input[] = "<input type='checkbox' class='cb-element' onchange='checkbox_change(this)' style='width:20px; height:20px' ".($status_checked == 1 ? "checked" : "")." >";
        $_input = implode("", $_input);

        $row[]                  = $_input;
        $row[]                  = $report_no.''.$value['report_number'];
        $row[]                  = $value['irn_description'];
        $row[]                  = @$discipline_list[$value['discipline']]['discipline_name'];
        $row[]                  = @$module_list[$value['module']]['mod_desc'];
        $row[]                  = @$type_of_module_list[$value['type_of_module']]['name'];
        $row[]                  = @$piecemark_list[$value['id_piecemark']]['drawing_ga'];
        // $row[]                  = @$value['tag_no'];
        $row[]                  = @$piecemark_list[$value['id_piecemark']]['drawing_wm'];
        // $row[]                  = @$piecemark_list[$value['id_piecemark']]['joint_no'];
        $row[]                  = @$piecemark_list[$value['id_piecemark']]['part_id'];
        $row[]                  = @$mis_detail_list[$workpack_list[$piecemark_list[$value['id_piecemark']]['workpack_id']]['workpack_no']]['unique_no'];
        $row[]                  = @$piecemark_list[$value['id_piecemark']]['profile'];
        $row[]                  = @$piecemark_list[$value['id_piecemark']]['diameter'];
        $row[]                  = @$piecemark_list[$value['id_piecemark']]['length'];
        $row[]                  = @$piecemark_list[$value['id_piecemark']]['area'];
        $row[]                  = @$piecemark_list[$value['id_piecemark']]['thk'];
        $row[]                  = @$status_inspection_list[$value['status_inspection']];

        $data[]                 = $row;
      }

      	$result         					= [
			"draw"              		=> $_POST['draw'],
			"recordsTotal"      		=> $this->irn_approval_mv_mod->irn_mv_datatable_db('count_all', $where_datatable),
			"recordsFiltered"   		=> $this->irn_approval_mv_mod->irn_mv_datatable_db('count_filter', $where_datatable),
			"data"              		=> $data
		]; 

     	unset($where_datatable);
     	echo json_encode($result);
    }

	public function submit_approval_qc(){
		$post = $this->input->post();

		$check_all 	= $post['check_all'];
		$exclude 	= $post['exclude'];
		$include 	= $post['include'];

		$exclude = explode(";", $exclude);
		$include = explode(";", $include);

		$exclude = array_filter($exclude);
		$include = array_filter($include);

		$exclude = array_unique($exclude);
		$include = array_unique($include);

		if($check_all == 1){

			$where_update = [];

			$where_update["category_irn = 1"] = NULL;
			$where_update["id_piecemark IS NOT NULL"] = NULL;
			$where_update["status_inspection"] = 1;

			if(sizeof($exclude) > 0){
				$where_update["id_irn NOT IN ('".implode("', '", $exclude)."') "] = NULL;

			}

			$data_update = array(
				"status_inspection" 	=> 3,
				"smoe_approval_by" 		=> $this->user_cookie[0],
				"smoe_approval_date" 	=> date("Y-m-d H:i:s"),
			);

			$this->irn_approval_mv_mod->update_status_approval($where_update, $data_update);

		} 

		else{

			foreach ($include as $key => $value) {
				
				$data_update = array(
					"status_inspection" 	=> 3,
					"smoe_approval_by" 		=> $this->user_cookie[0],
					"smoe_approval_date" 	=> date("Y-m-d H:i:s"),
				);

				$where_update['id_irn'] = $value;
				$this->irn_approval_mv_mod->update_status_approval($where_update, $data_update);

			}

		}

		$this->session->set_flashdata('success','Approval Successful!');
		echo "<script>javascript:window.location = document.referrer;</script>";

	}

	public function submit_approval_client(){
		$post = $this->input->post();

		$check_all 	= $post['check_all'];
		$exclude 	= $post['exclude'];
		$include 	= $post['include'];

		$exclude = explode(";", $exclude);
		$include = explode(";", $include);

		$exclude = array_filter($exclude);
		$include = array_filter($include);

		$exclude = array_unique($exclude);
		$include = array_unique($include);

		if($check_all == 1){

			$where_update = [];

			$where_update["category_irn = 1"] = NULL;
			$where_update["id_piecemark IS NOT NULL"] = NULL;
			$where_update["status_inspection"] = 5;
			$where_update["smoe_approval_by IS NOT NULL"] = NULL;
			$where_update["client_approval_by IS NULL"] = NULL;

			if(sizeof($exclude) > 0){
				$where_update["id_irn NOT IN ('".implode("', '", $exclude)."') "] = NULL;

			}

			$data_update = array(
				"status_inspection" 	=> 7,
				"client_approval_by" 	=> $this->user_cookie[0],
				"client_approval_date" 	=> date("Y-m-d H:i:s"),
			);

			$this->irn_approval_mv_mod->update_status_approval($where_update, $data_update);

		} 

		else{

			foreach ($include as $key => $value) {
				
				$data_update = array(
					"status_inspection" 	=> 7,
					"client_approval_by" 	=> $this->user_cookie[0],
					"client_approval_date" 	=> date("Y-m-d H:i:s"),
				);

				$where_update['id_irn'] = $value;
				$this->irn_approval_mv_mod->update_status_approval($where_update, $data_update);

			}

		}

		$this->session->set_flashdata('success','Approval Successful!');
		echo "<script>javascript:window.location = document.referrer;</script>";

	}
 

}