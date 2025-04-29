<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_mod extends CI_Model {

	public function __construct(){
  	parent::__construct();
    $this->db_portal = $this->load->database('db_portal', TRUE);
 	}

// Counting Duration on Dashboard

// End Counting Duration

 	function joint_list($where = null){

		if(isset($where)){
			$query = $this->db->where($where);
		}
		$query = $this->db->select("
			count(a.joint_no) as total_joint,
			SUM(CASE WHEN a.workpack_id IS NULL THEN 1 ELSE 0 END) as joint_wp,
			SUM(CASE WHEN b.status_inspection = 0 THEN 1 ELSE 0 END) as fitup_pmt_rfi,
			SUM(CASE WHEN b.status_inspection = 1 THEN 1 ELSE 0 END) as fitup_smoe_inspection,
			SUM(CASE WHEN b.status_inspection = 3 THEN 1 ELSE 0 END) as fitup_qc_transmital
			");
		$query = $this->db->join('pcms_visual c','a.id = c.id_joint',"LEFT");
		$query = $this->db->join('pcms_fitup b','a.id = b.id_joint',"LEFT");		
		$query = $this->db->join('pcms_workpack d','a.workpack_id = d.id',"LEFT");
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();

	}

	function surveyor_joint($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}		 
		$query = $this->db->select("
			SUM(CASE WHEN c.progress_fu IS NULL OR c.progress_fu <100 THEN 1 ELSE 0 END) as fitup_surveyor
			");
		$query = $this->db->where("a.phase IN ('FB','AS','ER')",null);
		$query = $this->db->where("c.status_delete","1");
		$query = $this->db->where("a.status","1");
		$query = $this->db->join('pcms_workpack_detail c','a.id = c.id_workpack',"LEFT");
		$query = $this->db->join('pcms_joint b','a.id = b.workpack_id',"LEFT");
		$query = $this->db->get('pcms_workpack a');
		return $query->result_array();
	}

	function search_looping_master_summary_backup($where = null,$project_filter = null,$module_filter = null,$type_of_module_filter = null,$discipline_filter = null,$deck_elevation_filter = null,$desc_assy_filter = null){

		if(isset($project_filter)){ $val_grp_1 = "project"; } else { $val_grp_1 = null; }
		if(isset($module_filter)){ $val_grp_2 = "module"; } else { $val_grp_2 = null; }
		if(isset($type_of_module_filter)){ $val_grp_3 = "type_of_module"; } else { $val_grp_3 = null; }
		if(isset($discipline_filter)){ $val_grp_4 = "discipline"; } else { $val_grp_4 = null; }
		if(isset($deck_elevation_filter)){ $val_grp_5 = "deck_elevation"; } else { $val_grp_5 = null; }
		if(isset($desc_assy_filter)){ $val_grp_6 = "description_assy"; } else { $val_grp_6 = null; }

		$array_filter = array($val_grp_1,$val_grp_2,$val_grp_3,$val_grp_4,$val_grp_5,$val_grp_6);
		$array_group = array_filter($array_filter);

		  if(isset($val_grp_1) && !isset($val_grp_2) && !isset($val_grp_3) && !isset($val_grp_4) && !isset($val_grp_5) && !isset($val_grp_6)){
		  	 $level = "0";
	         array_push($array_group,"module");
		  } elseif(isset($val_grp_1) && isset($val_grp_2) && !isset($val_grp_3) && !isset($val_grp_4) && !isset($val_grp_5) && !isset($val_grp_6)){
	         $level = "1";
	         array_push($array_group,"type_of_module");
	      } else if(isset($val_grp_1) && isset($val_grp_2) && isset($val_grp_3) && !isset($val_grp_4) && !isset($val_grp_5) && !isset($val_grp_6)){
	         $level = "2";
	         array_push($array_group,"discipline");
	      } else if(isset($val_grp_1) && isset($val_grp_2) && isset($val_grp_3) && isset($val_grp_4) && !isset($val_grp_5) && !isset($val_grp_6)){
	         $level = "3";   
	         array_push($array_group,"deck_elevation");
	      } else if(isset($val_grp_1) && isset($val_grp_2) && isset($val_grp_3) && isset($val_grp_4) && isset($val_grp_5) && !isset($val_grp_6)){
	         $level = "4";
	         array_push($array_group,"description_assy");
	      } else if(isset($val_grp_1) && isset($val_grp_2) && isset($val_grp_3) && isset($val_grp_4) && isset($val_grp_5) && !isset($val_grp_6)){
	         $level = "5"; 
	         array_push($array_group,"part_id");
	      } else if(isset($val_grp_1) && isset($val_grp_2) && isset($val_grp_3) && isset($val_grp_4) && isset($val_grp_5) && isset($val_grp_6)){
	         $level = "6"; 
	         array_push($array_group,"part_id");
	      } 
	     
		if(isset($where)){
			$query = $this->db->where($where);
		}

		$query = $this->db->select("
				count(project) as total_data,
				max(project) as project,
				max(module) as module,
				max(type_of_module) as type_of_module,
				max(discipline) as discipline,
				max(deck_elevation) as deck_elevation,
				max(description_assy) as description_assy,
				max(part_id) as part_id,
				sum(pf_mv) as pf_mv,
				sum(f_fu) as f_fu,
				sum(f_vs) as f_vs,
				sum(f_ndt) as f_ndt,
				sum(as_fu) as as_fu,
				sum(as_vs) as as_vs,
				sum(as_ndt) as as_ndt,
				sum(er_fu) as er_fu,
				sum(er_vs) as er_vs,
				sum(er_ndt) as er_ndt"
			);

		$query = $this->db->group_by($array_group);
		$query = $this->db->join('pcms_piecemark b','a.id_temp_pc = b.id',"LEFT");
		$query = $this->db->get('pcms_summary a');
		return $query->result_array();
	}

	function search_looping_master_summary_level_7($where = null,$project_filter = null,$module_filter = null,$type_of_module_filter = null,$discipline_filter = null,$deck_elevation_filter = null,$drawing_as_filter = null,$phase = null){

		if(isset($project_filter)){ $val_grp_1 = "b.project"; } else { $val_grp_1 = null; }
		if(isset($type_of_module_filter)){ $val_grp_2 = "b.type_of_module"; } else { $val_grp_2 = null; }
		if(isset($discipline_filter)){ $val_grp_3 = "b.discipline"; } else { $val_grp_3 = null; }
		if(isset($deck_elevation_filter)){ $val_grp_4 = "b.deck_elevation"; } else { $val_grp_4 = null; }
		if(isset($drawing_as_filter)){ $val_grp_5 = "b.drawing_as"; } else { $val_grp_5 = null; }
		if(isset($phase)){ $val_grp_6 = "phase"; } else { $val_grp_6 = null; }

		$array_filter = array($val_grp_1,$val_grp_2,$val_grp_3,$val_grp_4,$val_grp_5,$val_grp_6);
		$array_group = array_filter($array_filter);
			// test_var($array_group);
		  if(isset($val_grp_5)){
		  	 $level = "7";
	         array_push($array_group,"part_id");
		  }
	     	// test_var($level);
		if(isset($where)){
			$query = $this->db->where($where);
		}

		$query = $this->db->select("
				count(b.project) as total_data,
				max(b.project) as project,
				max(b.module) as module,
				max(b.type_of_module) as type_of_module,
				max(b.discipline) as discipline,
				max(b.deck_elevation) as deck_elevation,
				max(b.drawing_as) as drawing_as,
				max(b.description_assy) as description_assy,
				max(part_id) as part_id,
				MAX(phase) as phase,
				SUM(pf_mv) as pf_mv,
				SUM(f_fu) as f_fu,
				SUM(f_vs) as f_vs,
				SUM(f_ndt) as f_ndt,
				SUM(as_fu) as as_fu,
				SUM(as_vs) as as_vs,
				SUM(as_ndt) as as_ndt,
				SUM(er_fu) as er_fu,
				SUM(er_vs) as er_vs,
				SUM(er_ndt) as er_ndt,
			"
			);

		$query = $this->db->group_by($array_group);
		$query = $this->db->join('pcms_piecemark b','a.id_temp_pc = b.id',"LEFT");
		$query = $this->db->join('master_calculation c','b.part_id = c.piecemark');
		$query = $this->db->get('pcms_summary a');
		return $query->result_array();
	}

	function search_looping_master_summary($where = null, $group_by = NULL, $select){
	     
		if(isset($where)){
			$query = $this->db->where($where);
		}

		$query = $this->db->select($select);
		if(isset($group_by)){
			$query = $this->db->group_by($group_by);
		}
		// $query = $this->db->group_by("DATE_PART('week',date_of_progress)");
		$query = $this->db->join('pcms_piecemark b','a.id_temp_pc = b.id',"LEFT");
		$query = $this->db->join('master_calculation c','b.part_id = c.piecemark');
		$query = $this->db->get('pcms_summary a');
		return $query->result_array();
	}

	public function sum_plan_target(){
		$query = $this->db->select("period, SUM(plan_target) as plan");
		$query = $this->db->group_by(["period"]);
		$query = $this->db->order_by("period", "ASC");
		$query = $this->db->get('master_plan_measurement');
		return $query->result_array();
	}

	public function data_dashboard($where = null, $module = 'week'){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		
		if($module == 'week'){
			$query = $this->db->select("c.project, c.type_of_module, c.discipline, c.part_id, DATE_PART('week',date_of_progress) as week, MAX(pf_mv) as pf_mv, MAX(f_fu) as f_fu, MAX(f_vs) as f_vs, MAX(f_ndt) as f_ndt, MAX(as_fu) as as_fu, MAX(as_vs) as as_vs, MAX(as_ndt) as as_ndt, MAX(er_fu) as er_fu, MAX(er_vs) as er_vs, MAX(er_ndt) as er_ndt");
			$query = $this->db->group_by("c.project, c.type_of_module, c.discipline, c.part_id, DATE_PART('week',date_of_progress)");
			$query = $this->db->order_by("week", "ASC");
		}
		elseif($module == 'month'){
			$query = $this->db->select("c.project, c.type_of_module, c.discipline, c.part_id, DATE_PART('month',date_of_progress) as month, MAX(pf_mv) as pf_mv, MAX(f_fu) as f_fu, MAX(f_vs) as f_vs, MAX(f_ndt) as f_ndt, MAX(as_fu) as as_fu, MAX(as_vs) as as_vs, MAX(as_ndt) as as_ndt, MAX(er_fu) as er_fu, MAX(er_vs) as er_vs, MAX(er_ndt) as er_ndt");
			$query = $this->db->group_by("c.project, c.type_of_module, c.discipline, c.part_id, DATE_PART('month',date_of_progress)");
			$query = $this->db->order_by("month", "ASC");
		}
		elseif($module == 'day'){
			$query = $this->db->select("c.project, c.type_of_module, c.discipline, c.part_id, CASE WHEN date_of_progress IS NULL THEN '2021-09-01 00:00:00' ELSE date_of_progress END as day, (pf_mv) as pf_mv, (f_fu) as f_fu, (f_vs) as f_vs, (f_ndt) as f_ndt, (as_fu) as as_fu, (as_vs) as as_vs, (as_ndt) as as_ndt, (er_fu) as er_fu, (er_vs) as er_vs, (er_ndt) as er_ndt");
			$query = $this->db->order_by("day", "ASC");
		}
		$query = $this->db->join('pcms_piecemark c','a.id_temp_pc = c.id');
		$query = $this->db->get('pcms_summary a');


		// $query = $this->db->query("SELECT c.project, c.type_of_module, c.discipline, c.part_id, 
		// CASE WHEN date_of_progress IS NULL THEN '2021-09-01 00:00:00' ELSE date_of_progress END as day, 
		// (pf_mv) as pf_mv, (f_fu) as f_fu, (f_vs) as f_vs, (f_ndt) as f_ndt, (as_fu) as as_fu, (as_vs) as as_vs, (as_ndt) as as_ndt, (er_fu) as er_fu, (er_vs) as er_vs, (er_ndt) as er_ndt
		// from pcms_piecemark as c
		// join (
		// 	SELECT a.id_temp_pc, date_of_progress,
		// 	(pf_mv) as pf_mv, (f_fu) as f_fu, (f_vs) as f_vs, (f_ndt) as f_ndt, (as_fu) as as_fu, (as_vs) as as_vs, (as_ndt) as as_ndt, (er_fu) as er_fu, (er_vs) as er_vs, (er_ndt) as er_ndt 
		// 	FROM pcms_summary AS a
		// 	join (
		// 		SELECT id_temp_pc, MAX(date_of_progress) as max_date
		// 		FROM pcms_summary AS b
		// 		group by id_temp_pc
		// 	) as tmp
		// 	on a.id_temp_pc = tmp.id_temp_pc and a.date_of_progress = tmp.max_date
		// ) as a
		// ON a.id_temp_pc = c.id;");
		return $query->result_array();
	}


	function search_looping_master_summary_plan($where = null,$project_filter = null,$module_filter = null,$type_of_module_filter = null,$discipline_filter = null,$deck_elevation_filter = null,$desc_assy_filter = null){

		if(isset($project_filter)){ $val_grp_1 = "project"; } else { $val_grp_1 = null; }
		if(isset($module_filter)){ $val_grp_2 = "module"; } else { $val_grp_2 = null; }
		if(isset($type_of_module_filter)){ $val_grp_3 = "type_of_module"; } else { $val_grp_3 = null; }
		if(isset($discipline_filter)){ $val_grp_4 = "discipline"; } else { $val_grp_4 = null; }
		if(isset($deck_elevation_filter)){ $val_grp_5 = "deck_elevation"; } else { $val_grp_5 = null; }
		if(isset($desc_assy_filter)){ $val_grp_6 = "description_assy"; } else { $val_grp_6 = null; }

		$array_filter = array($val_grp_1,$val_grp_2,$val_grp_3,$val_grp_4,$val_grp_5,$val_grp_6);
		$array_group = array_filter($array_filter);

		  if(isset($val_grp_1) && !isset($val_grp_2) && !isset($val_grp_3) && !isset($val_grp_4) && !isset($val_grp_5) && !isset($val_grp_6)){
		  	 $level = "0";
	         array_push($array_group,"module");
		  } elseif(isset($val_grp_1) && isset($val_grp_2) && !isset($val_grp_3) && !isset($val_grp_4) && !isset($val_grp_5) && !isset($val_grp_6)){
	         $level = "1";
	         array_push($array_group,"type_of_module");
	      } else if(isset($val_grp_1) && isset($val_grp_2) && isset($val_grp_3) && !isset($val_grp_4) && !isset($val_grp_5) && !isset($val_grp_6)){
	         $level = "2";
	         array_push($array_group,"discipline");
	      } else if(isset($val_grp_1) && isset($val_grp_2) && isset($val_grp_3) && isset($val_grp_4) && !isset($val_grp_5) && !isset($val_grp_6)){
	         $level = "3";   
	         array_push($array_group,"deck_elevation");
	      } else if(isset($val_grp_1) && isset($val_grp_2) && isset($val_grp_3) && isset($val_grp_4) && isset($val_grp_5) && !isset($val_grp_6)){
	         $level = "4";
	         array_push($array_group,"description_assy");
	      } else if(isset($val_grp_1) && isset($val_grp_2) && isset($val_grp_3) && isset($val_grp_4) && isset($val_grp_5) && !isset($val_grp_6)){
	         $level = "5"; 
	         array_push($array_group,"part_id");
	      } else if(isset($val_grp_1) && isset($val_grp_2) && isset($val_grp_3) && isset($val_grp_4) && isset($val_grp_5) && isset($val_grp_6)){
	         $level = "6"; 
	         array_push($array_group,"part_id");
	      } 
	     
		if(isset($where)){
			$query = $this->db->where($where);
		}

		$query = $this->db->select("
				count(project) as total_data,
				max(project) as project,
				max(module) as module,
				max(type_of_module) as type_of_module,
				max(discipline) as discipline,
				max(deck_elevation) as deck_elevation,
				max(description_assy) as description_assy,
				max(part_id) as part_id,
				sum(pf_mv) as pf_mv,
				sum(f_fu) as f_fu,
				sum(f_vs) as f_vs,
				sum(f_ndt) as f_ndt,
				sum(as_fu) as as_fu,
				sum(as_vs) as as_vs,
				sum(as_ndt) as as_ndt,
				sum(er_fu) as er_fu,
				sum(er_vs) as er_vs,
				sum(er_ndt) as er_ndt");

		$query = $this->db->group_by($array_group);
		$query = $this->db->join('pcms_piecemark b','a.id_temp_pc = b.id',"LEFT");
		$query = $this->db->get('master_summary a');
		return $query->result_array();
	}


	function manual_query_db($query){
		$query = $this->db->query($query);
		return $query->result_array();
	}


	//----------------------------------------------------------------------------------------------//

	public function get_visual_data_all_view($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}   
		$query = $this->db->select('b.deck_elevation,SUM(b.weld_length) as total_length');   
		$query = $this->db->group_by('b.deck_elevation'); 
		$query = $this->db->join('pcms_joint b','b.id = a.id_joint'); 
		$query = $this->db->get('pcms_visual a');
		return $query->result_array();
	}

	public function get_visual_data($where = null, $week_based){
		if(isset($where)){
			$query = $this->db->where($where);
		} 
		
			  
		$query = $this->db->select('
            a.id_visual,
            a.drawing_no,
            a.discipline,
            a.module,
            a.type_of_module,
            a.report_number as visual_report,
			c.deck_elevation,
			c.joint_no,
			c.class,
			a.length_of_weld,
			a.postpone_reoffer_no,
            d.submission_id, 
            a.length_of_weld,
            d.id as id_ndt,
            d.tested_length,
            d.reject_length_rh,
            d.reject_length_fc,
            a.submission_id,
            a.id_joint,
            e.ndt_initial,
            d.result,
            d.report_number,
            d.re_request,
            date(a.weld_datetime) as weld_datetime,            
            date(d.date_of_inspection) as date_of_inspection,            
            date(d.created_date) as created_date,            
		');
		if($week_based == 0){
			$query = $this->db->order_by('d.date_of_inspection','ASC');
		}
		elseif($week_based == 1){
			$query = $this->db->order_by('a.weld_datetime','ASC');
		}
		$query = $this->db->join('pcms_joint c','c.id = a.id_joint',"LEFT");
		$query = $this->db->join('pcms_ndt d','a.id_visual = d.id_visual' );
		$query = $this->db->join('master_ndt_type e','e.id = d.ndt_type',"LEFT");
		$query = $this->db->get('pcms_visual a');
		return $query->result_array();
	}

	public function get_detail_data_ctq($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		} 			  
		 
		$query = $this->db->select(' a.ctq_initial,  b.length, d.deck_elevation, b.ndt_id, b.ctq_id, c.ndt_type');
		$query = $this->db->join('pcms_ctq_reject b','a.id = b.ctq_id',"LEFT");
		$query = $this->db->join('pcms_ndt c','b.ndt_id = c.id',"LEFT");
		$query = $this->db->join('pcms_joint d','c.joint_id = d.id',"LEFT");
		$query = $this->db->get('master_ctq a');
		return $query->result_array();
	}

	public function get_deck_elevation($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}  
		$query = $this->db->get('master_deck_elevation');
		return $query->result_array();
	}

	//----------------------------------------------------------------------------------------------//

	function onprogress_welding_joint_list($where = null, $limit = null, $order = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		if(isset($order)){
			foreach ($order as $key => $value) {
				$this->db->order_by($key, $value);
			}
		}
		$query = $this->db->get('onprogress_welding_joint');
		return $query->result_array();
 	}

 	function master_secondary_to_primary($where = null, $limit = null, $order = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		if(isset($order)){
			foreach ($order as $key => $value) {
				$this->db->order_by($key, $value);
			}
		}
		$query = $this->db->get('master_secondary_to_primary');
		return $query->result_array();
 	}

	function onprogress_fitting_joint_list($where = null, $limit = null, $order = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		if(isset($order)){
			foreach ($order as $key => $value) {
				$this->db->order_by($key, $value);
			}
		}
		$query = $this->db->get('onprogress_fitting_joint');
		return $query->result_array();
 	}

	function outstanding_material_per_joint_list($where = null, $limit = null, $order = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		if(isset($order)){
			foreach ($order as $key => $value) {
				$this->db->order_by($key, $value);
			}
		}
		$query = $this->db->get('outstanding_material_per_joint');
		return $query->result_array();
 	}

	function surveyor_status_visual_list($where = null, $limit = null, $order = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		if(isset($order)){
			foreach ($order as $key => $value) {
				$this->db->order_by($key, $value);
			}
		}
		$query = $this->db->get('surveyor_status_visual_list');
		return $query->result_array();
 	}

	public function surveyor_status_detail_datatable_db($cat, $process, $id_surveyor_status = NULL, $where = NULL){
		$table      		= 'onprogress_welding_joint';
		$column     		= array('drawing_no','drawing_wm','joint_no','deck_elevation','grid_row','grid_column','inspection_datetime','date_part','joint_no');
		if($process == 'fitup'){
			$table      		= 'onprogress_fitting_joint';
			$column     		= array('drawing_no','drawing_wm','joint_no','deck_elevation','grid_row','grid_column','weld_length','inspection_datetime','date_part','joint_no');
		}
		if($id_surveyor_status){
			$table      		= 'surveyor_status_visual_list';
			$this->db->where("status_surveyor", $id_surveyor_status);
		}

		$this->db->from($table);
		if(isset($where)){
			$this->db->where($where);
		}

		if($cat == 'count_all'){
			return $this->db->count_all_results();
		}
		
		$i = 0;
		$_POST['search']['value'] = convert2utf8($_POST['search']['value']);
		foreach ($column as $key => $item){
			if ($_POST['search']['value']){
				if ($i === 0){
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like('CAST('.$column[$key].' AS VARCHAR)', $_POST['search']['value']);
				}
				else{
					$this->db->or_like('CAST('.$column[$key].' AS VARCHAR)', $_POST['search']['value']);
				}
				if (count($column) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if (isset($_POST['order'])){
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if (isset($column)){
			$this->db->order_by('inspection_datetime', 'DESC');
		}

		if($cat == 'data'){
			if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);

			$query = $this->db->get();
			return $query->result_array();
		}
		elseif($cat == 'count_filter'){
			$query = $this->db->get();
			return $query->num_rows();
		}
	}

	public function surveyor_status_detail_material_datatable_db($cat, $where = NULL){
		$table      		= 'outstanding_material_per_joint';
		$column     		= array('drawing_no','drawing_wm','joint_no','deck_elevation','grid_row','grid_column','weld_length','pos_1','pos_2','joint_no');

		$this->db->from($table);
		if(isset($where)){
			$this->db->where($where);
		}

		if($cat == 'count_all'){
			return $this->db->count_all_results();
		}
		
		$i = 0;
		$_POST['search']['value'] = convert2utf8($_POST['search']['value']);
		foreach ($column as $key => $item){
			if ($_POST['search']['value']){
				if ($i === 0){
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like('CAST('.$column[$key].' AS VARCHAR)', $_POST['search']['value']);
				}
				else{
					$this->db->or_like('CAST('.$column[$key].' AS VARCHAR)', $_POST['search']['value']);
				}
				if (count($column) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if (isset($_POST['order'])){
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if (isset($column)){
			$this->db->order_by('inspection_datetime', 'DESC');
		}

		if($cat == 'data'){
			if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);

			$query = $this->db->get();
			return $query->result_array();
		}
		elseif($cat == 'count_filter'){
			return $this->db->count_all_results();
		}
	}
 
  public function outstanding_material_per_piecemark_list($where = null) {
    if(isset($where)) {
      $this->db->where($where);
    }

    $this->db->from('outstanding_material_per_piecemark');
    $query = $this->db->get();
    return $query->result_array();
  }
 
  public function joint_list_view($where = null) {
    if(isset($where)) {
      $this->db->where($where);
    }

    $this->db->from('pcms_joint_view');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function summary_joint_by_deck($where = null) {

    if(isset($where)) {
      $this->db->where($where);
    }
    
    $this->db->select('COUNT(id) AS total_joint, SUM(weld_length) AS total_length, deck_elevation');
    $this->db->from('pcms_joint joint');
    $this->db->group_by('deck_elevation');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function summary_joint_fitup_by_deck($where = null) {
    if(isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('
    COUNT(joint.id) AS total_joint_all,
    COUNT(CASE WHEN submission_id IS NOT NULL THEN joint.id END) AS total_joint_submission, 
    COUNT(CASE WHEN status_inspection IN (3,5,6,7,9,10,11) THEN joint.id END) AS total_joint_approved, 
    COUNT(CASE WHEN status_inspection = 2 AND status_resubmit != 1 THEN joint.id END) AS total_joint_reject,

    SUM(joint.weld_length) AS total_length_all, 
    SUM(CASE WHEN submission_id IS NOT NULL THEN joint.weld_length END) AS total_length_submission, 
    SUM(CASE WHEN status_inspection IN (3,5,6,7,9,10,11) THEN joint.weld_length END) AS total_length_approved, 
    SUM(CASE WHEN status_inspection = 2 AND status_resubmit != 1 THEN joint.weld_length END) AS total_length_reject, 
    deck_elevation');
    $this->db->from('pcms_fitup fitup');
    $this->db->join('pcms_joint joint','fitup.id_joint = joint.id');
    $this->db->group_by('deck_elevation');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function summary_joint_visual_by_deck($where = null) {
    if(isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('
    COUNT(joint.id) AS total_joint_all,
    COUNT(CASE WHEN submission_id IS NOT NULL THEN joint.id END) AS total_joint_submission, 
    COUNT(CASE WHEN status_inspection IN (3,5,6,7,9,10,11) THEN joint.id END) AS total_joint_approved, 
    COUNT(CASE WHEN status_inspection = 2 AND replacing_visual_id IS NULL THEN joint.id END) AS total_joint_reject,
     
    SUM(joint.weld_length) AS total_length_all, 
    SUM(CASE WHEN submission_id IS NOT NULL THEN joint.weld_length END) AS total_length_submission, 
    SUM(CASE WHEN status_inspection IN (3,5,6,7,9,10,11) THEN joint.weld_length END) AS total_length_approved, 
    SUM(CASE WHEN status_inspection = 2 AND replacing_visual_id IS NULL THEN joint.weld_length END) AS total_length_reject, 
    deck_elevation');
    $this->db->from('pcms_visual visual');
    $this->db->join('pcms_joint joint','visual.id_joint = joint.id');
    $this->db->group_by('deck_elevation');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function summary_joint_weld_type_by_deck($where = null) {
    if(isset($where)) {
      $this->db->where($where);
    }
    $this->db->select('COUNT(id) AS total_joint, SUM(weld_length) AS total_length, weld_type, deck_elevation');
    $this->db->from('pcms_joint joint');
    $this->db->group_by('weld_type, deck_elevation');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function ndt_uniq($where = Null){
    if(isset($where)) {
      $this->db->where($where);
    }
    $this->db->select('
      ndt_type,
      deck_elevation,
      MAX(ndt.id) AS id,
      MAX(joint.weld_length) AS weld_length,
      max(result) AS result,
      COUNT(ndt_type) AS total,
      SUM(joint.weld_length) AS total_length
    ');
    $this->db->from('pcms_ndt ndt');
    $this->db->join('pcms_visual visual','visual.id_visual = ndt.id_visual');
    $this->db->join('pcms_joint joint','ndt.joint_id = joint.id');
    $this->db->group_by('ndt.ndt_type, joint.deck_elevation');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function ndt_dashboard_conweeky($tbl_initial, $where = null) {

    if(isset($where)) {
      $this->db->where($where);
    }

    $this->db->select("
      deck_elevation,
      MAX(ndt.id_$tbl_initial) AS id,
      MAX(joint.weld_length) AS weld_length,
      max(result) AS result,
      COUNT(ndt.id_joint) AS total,
      SUM(joint.weld_length) AS total_length
    ");

    $this->db->from("pcms_ndt_$tbl_initial ndt");
    $this->db->join('pcms_visual visual','visual.id_visual = ndt.id_visual');
    $this->db->join('pcms_joint joint','ndt.id_joint = joint.id');
    $this->db->group_by('joint.deck_elevation');
    $query = $this->db->get();
    return $query->result_array();
  }

  function pcms_joint_list($where = null, $limit = null, $order = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		if(isset($order)){
			foreach ($order as $key => $value) {
				$this->db->order_by($key, $value);
			}
		}
		$query = $this->db->get('pcms_joint joint');
		return $query->result_array();
 	}


	 public function get_overall_visual_data_v21($where = null, $week_based){
		if(isset($where)){
			$query = $this->db->where($where);
		}  
		$query = $this->db->select('
            a.id_visual, 
            a.report_number as visual_report,
			a.length_of_weld,
			a.postpone_reoffer_no, 
            a.length_of_weld, 
            a.submission_id, 
			date(a.weld_datetime) as weld_datetime,   
			b.project,
			b.drawing_no,
            b.discipline,
            b.module,
            b.type_of_module,
			b.id as id_joint,
			b.deck_elevation,
			b.joint_no,
			b.weld_length,
			b.class 
		');  
		 
		$query = $this->db->join('pcms_joint b','b.id = a.id_joint',"LEFT");  
		$query = $this->db->get('pcms_visual a');
		return $query->result_array();
	}


	 public function get_visual_data_v21($where = null, $week_based){
		if(isset($where)){
			$query = $this->db->where($where);
		}  
		$query = $this->db->select('
            a.id_visual, 
            a.report_number as visual_report,
			a.length_of_weld,
			a.postpone_reoffer_no, 
            a.length_of_weld, 
            a.submission_id, 
			date(a.weld_datetime) as weld_datetime,   
			b.project,
			b.drawing_no,
            b.discipline,
            b.module,
            b.type_of_module,
			b.id as id_joint,
			b.deck_elevation,
			b.joint_no,
			b.class,
			c.status_rh_fc,
			c.id_welder,
			c.length_welded
		');  
		$query = $this->db->join('pcms_visual_detail_welder c','c.id_visual = a.id_visual',"LEFT");  
		$query = $this->db->join('pcms_joint b','b.id = a.id_joint',"LEFT");  
		$query = $this->db->get('pcms_visual a');
		return $query->result_array();
	}

	public function get_detail_data_ctq_v21($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		} 			  
		 
		$query = $this->db->select('
			d.id as id_joint, 
			d.deck_elevation, 
			d.type_of_module, 
			b.tested_date, 
			a.ctq_initial,  
			b.length, 
			d.deck_elevation, 
			b.ndt_id, 
			b.ctq_id, 
			b.ndt_type
		');
		$query = $this->db->join('ndt_ut_reject b','a.id = b.ctq_id',"LEFT"); 
		$query = $this->db->join('pcms_joint d','b.id_joint = d.id',"LEFT");
		$query = $this->db->get('master_ctq a');
		return $query->result_array();
	}

	public function get_ndt_ut_data($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		} 			  
		 
		$query = $this->db->select('
			b.id as id_joint, 
			b.deck_elevation, 
			b.type_of_module, 
			a.tested_date,  
			a.transmit_date,  
			a.tested_length,  
			a.result,  
		'); 
		$query = $this->db->join('pcms_joint b','a.id_joint = b.id',"LEFT");
		$query = $this->db->get('pcms_ndt_ut a');
		return $query->result_array();
	}

	public function get_visual_data_new_v21($where = null, $week_based){

		if(isset($where)){
			$query = $this->db->where($where);
		} 
		
		if($week_based == 0){
			$query = $this->db->order_by('d.tested_date','ASC');
		}
		elseif($week_based == 1){
			$query = $this->db->order_by('a.weld_datetime','ASC');
		}
		$query = $this->db->join('pcms_joint c','c.id = a.id_joint',"LEFT");
		
		$select = '
			a.id_visual,
			a.drawing_no,
			a.discipline,
			a.module,
			a.type_of_module,
			a.report_number as visual_report,
			a.length_of_weld,
			a.postpone_reoffer_no, 
			a.length_of_weld,  
			a.id_joint,
			e.ndt_initial, 
			date(a.weld_datetime) as weld_datetime, 
			c.deck_elevation,
			c.joint_no,
			c.class,  
			d.tested_length,
			d.result,
			d.report_no,         
			date(d.tested_date) as tested_date,
			date(d.transmit_date) as created_date,
			d.id as id_ndt,
			d.ndt_type,
		';
		$query = $this->db->join('(
			SELECT
				MAX(tested_length) AS tested_length,
				MAX(result) AS result,
				MAX(report_no) AS report_no,
				MAX(id) AS id,
				MAX(ndt_type) AS ndt_type,
				MAX(id_visual) AS id_visual,
				MAX(tested_date) AS tested_date,
				MAX(transmit_date) AS transmit_date
			from
			pcms_ndt_all WHERE ndt_type IN (1,3) group by id_joint, id_visual ) d','a.id_visual = d.id_visual' );
		$query = $this->db->select($select);
		$query = $this->db->join('master_ndt_type e','e.id = d.ndt_type',"LEFT");
		$query = $this->db->get('pcms_visual a');
		return $query->result_array();
	}

	public function get_visual_data_new_v21_2($where = null, $week_based){

		if(isset($where)){
			$query = $this->db->where($where);
		} 
		
		if($week_based == 0){
			$query = $this->db->order_by('d.tested_date','ASC');
		}
		elseif($week_based == 1){
			$query = $this->db->order_by('a.weld_datetime','ASC');
		}
		$query = $this->db->join('pcms_joint c','c.id = a.id_joint',"LEFT");
		
		$select = '
			a.id_visual,
			a.drawing_no,
			a.discipline,
			a.module,
			a.type_of_module,
			a.report_number as visual_report,
			a.length_of_weld as visual_length_weld,
			a.postpone_reoffer_no, 
			a.id_joint,
			a.revision_category,
			e.ndt_initial, 
			date(a.weld_datetime) as weld_datetime, 
			c.deck_elevation,
			c.drawing_wm,
			c.joint_no,
			c.class,  
			d.tested_length,
			d.result,
			d.report_no,         
			date(d.tested_date) as tested_date,
			date(d.transmit_date) as created_date,
			d.id as id_ndt,
			d.ndt_type,
			f.weld_length as length_of_weld,
			f.project,
		';
		$query = $this->db->join('(
			SELECT
				MAX(tested_length) AS tested_length,
				MAX(result) AS result,
				MAX(report_no) AS report_no,
				MAX(id) AS id,
				MAX(ndt_type) AS ndt_type,
				MAX(id_visual) AS id_visual,
				MAX(tested_date) AS tested_date,
				MAX(transmit_date) AS transmit_date
			from
			pcms_ndt_all WHERE ndt_type IN (1,3) group by id_joint, id_visual, ndt_type ) d','a.id_visual = d.id_visual' );
		$query = $this->db->select($select);
		$query = $this->db->join('master_ndt_type e','e.id = d.ndt_type',"LEFT");
		$query = $this->db->join('pcms_joint f','f.id = a.id_joint',"LEFT");
		$query = $this->db->get('pcms_visual a');
		return $query->result_array();
	}

	public function get_visual_data_new_v21_3($where = null, $week_based){

		if(isset($where)){
			$query = $this->db->where($where);
		} 
		
		if($week_based == 0){
			$query = $this->db->order_by('g.tested_date','ASC');
		}
		elseif($week_based == 1){
			$query = $this->db->order_by('a.weld_datetime','ASC');
		}
		$query = $this->db->join('pcms_joint c','c.id = a.id_joint',"LEFT");
		
		$select = '
			a.id_visual,
			a.drawing_no,
			a.discipline,
			a.module,
			a.type_of_module,
			a.report_number as visual_report,
			a.length_of_weld as visual_length_weld,
			a.postpone_reoffer_no, 
			a.id_joint,
			a.revision_category,
			e.ndt_initial, 
			date(a.weld_datetime) as weld_datetime, 
			c.deck_elevation,
			c.joint_no,
			c.class,  
			g.tested_length,
			g.result,
			g.report_number AS report_no,         
			date(g.tested_date) as tested_date,
			date(g.transmit_date) as created_date,
			g.id as id_ndt,
			g.ndt_type,
			f.weld_length as length_of_weld,
			f.project,
		';
		$query = $this->db->join('(
			SELECT
				MAX(tested_length) AS tested_length,
				MAX(result) AS result,
				MAX(report_number) AS report_number,
				MAX(id) AS id,
				MAX(ndt_type) AS ndt_type,
				MAX(id_visual) AS id_visual,
				MAX(date_of_inspection) AS tested_date,
				MAX(transmit_date) AS transmit_date
			from
			pcms_ndt WHERE ndt_type IN (13,15) group by joint_id, id_visual, ndt_type ) g','a.id_visual = g.id_visual' );
		$query = $this->db->select($select);
		$query = $this->db->join('master_ndt_type e','e.id = g.ndt_type',"LEFT");
		$query = $this->db->join('pcms_joint f','f.id = a.id_joint',"LEFT");
		$query = $this->db->get('pcms_visual a');
		return $query->result_array();
	}

	public function get_detail_data_ctq_new_v21($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		} 			  
		 
		$query = $this->db->select('c.id_joint, a.ctq_initial,  b.length, d.deck_elevation, d.type_of_module, b.ndt_id, b.ctq_id, c.ndt_type, c.tested_date');
		$query = $this->db->join('pcms_ctq_reject b','a.id = b.ctq_id',"LEFT");
		$query = $this->db->join('pcms_ndt_all c','b.ndt_id = c.id',"LEFT");
		
		$query = $this->db->join('pcms_joint d','c.id_joint = d.id',"LEFT");
		$query = $this->db->group_by('b.id, c.id_joint, a.ctq_initial,  b.length, b.welder, b.datum, b.depth, b.planarity, d.deck_elevation, d.type_of_module, b.ndt_id, b.ctq_id, c.ndt_type, c.tested_date');
		$query = $this->db->get('master_ctq a');
		return $query->result_array();
	}

	public function get_detail_data_ctq_new_v21_2($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		} 			  
		 
		$query = $this->db->select('c.joint_id as id_joint, a.ctq_initial,  b.length, d.deck_elevation, d.type_of_module, b.ndt_id, b.ctq_id, c.ndt_type, c.date_of_inspection as tested_date');
		$query = $this->db->join('pcms_ctq_reject b','a.id = b.ctq_id',"LEFT");
		$query = $this->db->join('pcms_ndt c','b.ndt_id = c.id',"LEFT");
		
		$query = $this->db->join('pcms_joint d','c.joint_id = d.id',"LEFT");
		$query = $this->db->group_by('b.id, c.joint_id, a.ctq_initial,  b.length, b.welder, b.datum, b.depth, b.planarity, d.deck_elevation, d.type_of_module, b.ndt_id, b.ctq_id, c.ndt_type, c.date_of_inspection');
		$query = $this->db->get('master_ctq a');
		return $query->result_array();
	}

	public function get_joint_repaired($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}

		$query = $this->db->select('pcms_ndt_all.uniq_id_report as joint_repaired, pcms_visual.id_visual');
		$query = $this->db->join('pcms_ndt_all', 'pcms_ndt_all.uniq_id_report = pcms_ctq_reject.submission_id', "LEFT");
		$query = $this->db->join('pcms_visual', 'pcms_ndt_all.id_visual = pcms_visual.id_visual', "LEFT");
		$query = $this->db->join('pcms_joint', 'pcms_visual.id_joint = pcms_joint.id', "LEFT");

		$query = $this->db->group_by('pcms_visual.id_visual, joint_repaired');
		$query = $this->db->get('pcms_ctq_reject');
		return $query->result_array();
	}

	public function get_joint_repaired_2($where = null)
	{
		if (isset($where)) {
			$query = $this->db->where($where);
		}

		$query = $this->db->select('pcms_ndt.submission_id as joint_repaired, pcms_visual.id_visual');
		$query = $this->db->join('pcms_ndt', 'pcms_ndt.submission_id = pcms_ctq_reject.submission_id', "LEFT");
		$query = $this->db->join('pcms_visual', 'pcms_ndt.id_visual = pcms_visual.id_visual', "LEFT");
		$query = $this->db->join('pcms_joint', 'pcms_visual.id_joint = pcms_joint.id', "LEFT");

		$query = $this->db->group_by('pcms_visual.id_visual, joint_repaired');
		$query = $this->db->get('pcms_ctq_reject');
		return $query->result_array();
	}

}
/*
	End Model Auth_mod
*/