<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Planning_mod extends CI_Model {

	public function __construct(){
	  parent::__construct();
	    $this->db_wh      	= $this->load->database('warehouse', TRUE);
		//$this->db_eng = $this->load->database('db_eng', TRUE);
		$this->db_eng 		= $this->load->database('db_eng_mysql', TRUE);
		$this->db_punchlist = $this->load->database('db_punchlist', TRUE);
		$this->db_iss 		= $this->load->database('db_iss', TRUE);
 	}

	function workpack_list($where = null, $limit = null){
	    if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		$query = $this->db->order_by('created_date', 'desc');
		$query = $this->db->get('pcms_workpack');
		return $query->result_array();
	}

	public function workpack_list_datatable_db($cat, $where = NULL){
		$table      		= 'pcms_workpack';
		$column     		= array('test_pack_no','drawing_no','workpack_no','phase','description','company_id','module','type_of_module','discipline','deck_elevation','desc_assy','plan_start_date','plan_start_date','id','status_approval','id','type','assigned_to','assigned_date', 'irn_report_no');

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
			$this->db->order_by('created_date', 'DESC');
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

	public function workpack_new_process_db($data) {
		$data = convert2null($data);
		$this->db->insert('pcms_workpack', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function workpack_update_process_db($data, $where) {
		$data = convert2null($data);
		$this->db->where($where);
		$this->db->update("pcms_workpack", $data);
	}

	public function workpack_no_generate_process_db($where) {
		$this->db->select('RIGHT(workpack_no,3) as kode', FALSE);
		$this->db->order_by('RIGHT(workpack_no,3) DESC', NULL);
		$this->db->limit(1);
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_workpack');
		if($query->num_rows() <> 0){
		  $data = $query->row();
		  $kode = intval($data->kode) + 1;
		} else {
		  $kode = 1;
		}
		$kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
		return $kodemax;
	}

	function budget_manhours_list($where = null, $limit = null){
		 if(isset($where)){
			 $this->db->where($where);
		 }
		 if(isset($limit)){
			 $this->db->limit($limit);
		 }
		 $query = $this->db->order_by('created_date', 'asc');
		 $query = $this->db->get('pcms_workpack_manhours');
		 return $query->result_array();
	}

	public function budget_manhours_new_process_db($data) {
		$data = convert2null($data);
		$this->db->insert("pcms_workpack_manhours", $data);
	}

	public function budget_manhours_update_process_db($data, $where) {
		$data = convert2null($data);
		$this->db->where($where);
		$this->db->update("pcms_workpack_manhours", $data);
	}

	function workpack_attachment_list($where = null, $limit = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		$query = $this->db->order_by('created_date', 'desc');
		$query = $this->db->get('pcms_workpack_attachment');
		return $query->result_array();
 }

 public function workpack_attachment_new_process_db($data) {
	 $data = convert2null($data);
	 $this->db->insert("pcms_workpack_attachment", $data);
 }

 public function workpack_attachment_update_process_db($data, $where) {
	 $data = convert2null($data);
	 $this->db->where($where);
	 $this->db->update("pcms_workpack_attachment", $data);
 }

	function workpack_grade_list($where = null, $limit = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		$query = $this->db->order_by('created_date', 'asc');
		$query = $this->db->get('pcms_workpack_grade');
		return $query->result_array();
 }

 public function workpack_grade_new_process_db($data) {
	 $data = convert2null($data);
	 $this->db->insert("pcms_workpack_grade", $data);
 }

 public function workpack_grade_update_process_db($data, $where) {
	 $data = convert2null($data);
	 $this->db->where($where);
	 $this->db->update("pcms_workpack_grade", $data);
 }

	function consumable_list($where = null, $limit = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		$query = $this->db->order_by('created_date', 'asc');
		$query = $this->db->get('pcms_workpack_consumable');
		return $query->result_array();
 	}

 	public function consumable_new_process_db($data) {
		$data = convert2null($data);
		$this->db->insert("pcms_workpack_consumable", $data);
 	}

 	public function consumable_update_process_db($data, $where) {
		$data = convert2null($data);
		$this->db->where($where);
		$this->db->update("pcms_workpack_consumable", $data);
 	}

	function painting_list($where = null, $limit = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		$query = $this->db->order_by('created_date', 'asc');
		$query = $this->db->get('pcms_workpack_painting');
		return $query->result_array();
 	}

 	public function painting_new_process_db($data) {
		$data = convert2null($data);
		$this->db->insert("pcms_workpack_painting", $data);
 	}

 	public function painting_update_process_db($data, $where) {
		$data = convert2null($data);
		$this->db->where($where);
		$this->db->update("pcms_workpack_painting", $data);
 	}

	function workpack_timesheet_list($where = null, $limit = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		$query = $this->db->order_by('date', 'desc');
		$query = $this->db->order_by('badge', 'desc');
		$query = $this->db->get('pcms_workpack_timesheet');
		return $query->result_array();
	}

	public function workpack_timesheet_new_process_db($data) {
		$data = convert2null($data);
		$this->db->insert('pcms_workpack_timesheet', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function workpack_timesheet_update_process_db($data, $where) {
		$data = convert2null($data);
		$this->db->where($where);
		$this->db->update("pcms_workpack_timesheet", $data);
	}

	function workpack_manpower_list($where = null, $limit = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		$query = $this->db->order_by('badge', 'asc');
		$query = $this->db->get('pcms_workpack_manpower');
		return $query->result_array();
	}

	public function workpack_manpower_new_process_db($data) {
		$this->db->insert('pcms_workpack_manpower', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function workpack_manpower_update_process_db($data, $where) {
		$data = convert2null($data);
		$this->db->where($where);
		$this->db->update("pcms_workpack_manpower", $data);
	}

	function workpack_detail_list($where = null, $limit = null){
		if(isset($where)){
			foreach ($where as $key => $value) {
				if(strpos($key, ' IN ') !== false && $value != NULL){
					$column = explode(" IN ", $key);
					$this->db->where_in($column[0], $value);
					unset($where[$key]);
				}
			}
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		$query = $this->db->order_by('id_workpack', 'asc');
		$query = $this->db->order_by('id', 'asc');
		$query = $this->db->get('pcms_workpack_detail');
		return $query->result_array();
	}
	 
	public function workpack_detail_new_process_db($data) {
	 $data = convert2null($data); 
	 $this->db->insert("pcms_workpack_detail", $data);
	}
	 
	public function workpack_detail_update_process_db($data, $where) {
	 $data = convert2null($data); 
	 $this->db->where($where);
	 $this->db->update("pcms_workpack_detail", $data);
	}

  public function workpack_detail_delete_process_db($where) {
    $this->db->where($where);
    $this->db->delete("pcms_workpack_detail");
  }

	function detail_list($where = null){
		if(isset($where)){
		 $this->db->where($where);
		}
		$query = $this->db->order_by('created_date', 'desc');
		$query = $this->db->get('pcms_workpack');
		return $query->result_array();
	}

	function pc_detail($where = null){
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

  function material_balance_list($where = null) {
    if(isset($where)){
			$this->db_wh->where($where);
		}
    $this->db_wh->from('pcms_wm_mat_bal');
    $query = $this->db_wh->get(); 
    return $query->result_array();
  }

  function production_balance_list($where = null) {
    if(isset($where)){
			$this->db_wh->where($where);
		}
    $this->db_wh->from('pcms_wm_balance_production');
    $query = $this->db_wh->get(); 
    return $query->result_array();
  }

	public function material_list($where = null){
		if(isset($where)){
			$this->db_wh->where($where);
		}
		$query = $this->db_wh->select('*');
		$query = $this->db_wh->join('qcs_material','pcms_wm_mat_bal.unique_no = qcs_material.unique_ident_no',"LEFT");
		$query = $this->db_wh->get('pcms_wm_mat_bal');
		return $query->result_array();
	}

	function piecemark_list($where = null, $limit = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}	
		$query = $this->db->where("pcms_piecemark.status_delete","1");
		$query = $this->db->where("pcms_workpack_detail.status_delete","1");
		$query = $this->db->select('*,pcms_piecemark.id AS id_pc_temp,pcms_workpack.id AS id_wp_main,pcms_workpack_detail.id as workpack_detail_id');
		$query = $this->db->join('pcms_workpack_detail','(pcms_piecemark.id = pcms_workpack_detail.id_template AND pcms_piecemark.workpack_id = pcms_workpack_detail.id_workpack)',"LEFT");
		$query = $this->db->join('pcms_material','(pcms_piecemark.id = pcms_material.id_piecemark AND pcms_piecemark.workpack_id = pcms_material.id_workpack)',"LEFT");
		$query = $this->db->join('pcms_workpack','pcms_piecemark.workpack_id = pcms_workpack.id',"LEFT");
		$query = $this->db->get('pcms_piecemark');
		return $query->result_array();
	}


	function count_progress($workpack_no) {		
		$query = $this->db->where("pcms_workpack.workpack_no",$workpack_no);		
		$query = $this->db->join('pcms_material','pcms_piecemark.id = pcms_material.id_piecemark',"LEFT");
		$query = $this->db->join('pcms_workpack','pcms_piecemark.workpack_id = pcms_workpack.id',"LEFT");
		$query = $this->db->get('pcms_piecemark');	
		$data_db = $query->result_array();
		$no_ok = 0;
		foreach ($data_db as $key => $value) {

			if(isset($value["status_inspection"])){
				$no_ok++;
			}
		}
		$total_item = sizeof($data_db);
		$progress_status = ($no_ok / $total_item) * 100;
		$progress_view = $progress_status."%";
		return $progress_view;
	}

	function get_mis_issued_detail($workpack_no = null){

		$query = $this->db_wh->select("*,detail.workpack_no AS workpack_number,detail.unique_no as mis_unique_no,detail.id_mis as id_mis,detail.id_mis_det as id_mis_detail");
		$query = $this->db_wh->join("(SELECT a.workpack_no,b.unique_no,a.id_mis,b.id_mis_det FROM pcms_wm_mis a LEFT JOIN pcms_wm_mis_detail b ON a.uniq_data = b.uniq_data WHERE a.workpack_no = '".$workpack_no."') detail","mrir.unique_ident_no = detail.unique_no");
		$query = $this->db_wh->get('qcs_material mrir');
		return $query->result_array();
	}

	public function insert_into_mis($form_data) {
		$this->db_wh->insert('pcms_wm_mis', $form_data);
	}


  public function insert_into_mis_detail($form_data) {
		$this->db_wh->insert('pcms_wm_mis_detail', $form_data);
	}

	public function mis_list($where = null, $order_by = null){
		if(isset($where)){
			$this->db_wh->where($where);
		}

    if(isset($order_by)){
			$this->db_wh->order_by($order_by);
		}

		$query = $this->db_wh->get('pcms_wm_mis');
		return $query->result_array();
	}

	public function mis_update_process_db($data, $where) {
		$data = convert2null($data);
		$this->db_wh->where($where);
		$this->db_wh->update("pcms_wm_mis", $data);
	}

	public function mis_detail_list($where = null){
		if(isset($where)){
			$this->db_wh->where($where);
		}
		$query = $this->db_wh->get('pcms_wm_mis_detail');
		return $query->result_array();
	}

	function search_percent_detail($where = null, $limit = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}

		$query = $this->db->get('pcms_workpack_detail');
		return $query->result_array();
	}

	public function insert_workpack_detail($data) {
	    $this->db->insert('pcms_workpack_detail', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function update_workpack_detail($data, $where) {
			$data = convert2null($data);

	    $this->db->where($where);
	    $this->db->update("pcms_workpack_detail", $data);
	}


	function joint_list($where = null, $limit = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		
		$query = $this->db->select('
					*,
					pcms_joint.drawing_no AS drawing_no_template,
					pcms_joint.drawing_wm AS drawing_wm_template,
					pcms_joint.drawing_type AS drawing_type_template,
					pcms_joint.id AS id_jn_temp,
					pcms_workpack.id AS id_wp_main,
					pcms_workpack.id AS id_workpack,
					pcms_fitup.status_inspection as status_inspection_svy,
					pcms_fitup.inspection_by as inspection_by_svy,
					pcms_fitup.inspection_datetime as inspection_date_svy,
					pcms_fitup.client_inspection_by as client_inspection_by_svy,
					pcms_fitup.submission_id as submission_id,
					pcms_fitup.client_inspection_date as client_inspection_date_svy
		');
		$query = $this->db->select('*,pcms_joint.id as id_joint_template');
		$query = $this->db->order_by('pcms_joint.drawing_no,pcms_joint.joint_no,pcms_fitup.submission_id',"asc");
		$query = $this->db->join('pcms_workpack_detail','(pcms_joint.id = pcms_workpack_detail.id_template AND pcms_joint.workpack_id = pcms_workpack_detail.id_workpack)',"LEFT");
		$query = $this->db->join('(SELECT * FROM pcms_fitup WHERE status_resubmit <> 1 AND status_retransmitted = 0 AND status_inspection <> 12  ) pcms_fitup','(pcms_joint.id = pcms_fitup.id_joint AND pcms_joint.workpack_id = pcms_fitup.id_workpack)',"LEFT");
		$query = $this->db->join('pcms_workpack','pcms_joint.workpack_id = pcms_workpack.id',"LEFT");
		$query = $this->db->get('pcms_joint');
		return $query->result_array();
	}

	function joint_list_visual($where = null, $limit = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		
		$query = $this->db->select('
				*,
				pcms_visual.id_visual as id_visual,
				pcms_visual.location_v2 as vs_location,
				pcms_visual.status_inspection as vs_status,
				pcms_joint.drawing_type AS drawing_type_template,
				pcms_joint.id AS id_jn_temp,
				pcms_workpack.id AS id_wp_main,
				pcms_workpack.id AS id_workpack,
				pcms_joint.drawing_wm AS drawing_wm,
				pcms_visual.status_inspection as status_inspection_svy,
				pcms_visual.inspection_by as inspection_by_svy,
				pcms_visual.inspection_datetime as inspection_date_svy,
				pcms_visual.inspection_client_by as client_inspection_by_svy,
				pcms_visual.submission_id as submission_id,				
				pcms_visual.inspection_client_datetime as client_inspection_date_svy,
				pcms_fitup.legend_inspection_auth as fitup_legend,
				pcms_fitup.status_invitation as fitup_status_invitation,
				pcms_fitup.status_inspection as fitup_status_inspection_svy,
				pcms_fitup.inspection_datetime as fitup_inspection_datetime,
				pcms_fitup.time_inspect as fitup_time_inspect,
				pcms_joint.status_internal as status_internal
		');
		$query = $this->db->order_by('pcms_joint.drawing_no,pcms_joint.joint_no,pcms_visual.submission_id',"asc");
		$query = $this->db->join('pcms_workpack_detail','(pcms_joint.id = pcms_workpack_detail.id_template AND pcms_joint.workpack_id = pcms_workpack_detail.id_workpack)',"LEFT");
		$query = $this->db->join('(SELECT * FROM pcms_fitup WHERE status_resubmit <> 1 AND status_retransmitted = 0 AND status_inspection <> 12) pcms_fitup','pcms_joint.id = pcms_fitup.id_joint');
		$query = $this->db->join('(SELECT * FROM pcms_visual WHERE retransmitt_status = 0 AND status_delete IS NULL AND status_inspection <> 12) pcms_visual','(pcms_joint.id = pcms_visual.id_joint AND pcms_joint.workpack_id = pcms_visual.id_workpack)',"LEFT");
		$query = $this->db->join('pcms_workpack','pcms_joint.workpack_id = pcms_workpack.id',"LEFT");
		$query = $this->db->get('pcms_joint');
		return $query->result_array();
	}
	

	public function process_delete_fitup_detail($id){
	    $this->db->where('id_fitup', $id);
	    $this->db->delete('pcms_fitup');
	}

	public function process_delete_visual_detail($id){
	    $this->db->where('id_visual', $id);
	    $this->db->delete('pcms_visual');
	}

	function Level_5($where = null, $limit = null){

		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}

		$query = $this->db->select('sum(pcms_workpack_detail.progress_mv) as total_progress_mv,count(pcms_piecemark.part_id) as total_pc,pcms_piecemark.project as pc_project,pcms_piecemark.module as pc_module,pcms_piecemark.type_of_module as pc_type_of_module,pcms_piecemark.discipline as pc_discipline,pcms_piecemark.deck_elevation as pc_deck_elevation');
		$query = $this->db->group_by('pcms_piecemark.project,pcms_piecemark.module,pcms_piecemark.type_of_module,pcms_piecemark.discipline,pcms_piecemark.deck_elevation');
		$query = $this->db->join('pcms_workpack_detail','(pcms_piecemark.id = pcms_workpack_detail.id_template AND pcms_piecemark.workpack_id = pcms_workpack_detail.id_workpack)');
		$query = $this->db->join('pcms_workpack','pcms_piecemark.workpack_id = pcms_workpack.id',"LEFT");
		$query = $this->db->get('pcms_piecemark');	
		return $query->result_array();
		
	}

	function Level_5_joint($where = null, $limit = null){

		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}

		$query = $this->db->select('sum(pcms_workpack_detail.progress_fu) as total_progress_fu,sum(pcms_workpack_detail.progress_vt) as total_progress_vt,count(pcms_joint.joint_no) as total_joint,pcms_joint.project as pc_project,pcms_joint.module as pc_module,pcms_joint.type_of_module as pc_type_of_module,pcms_joint.discipline as pc_discipline,pcms_joint.deck_elevation as pc_deck_elevation');
		$query = $this->db->group_by('pcms_joint.project,pcms_joint.module,pcms_joint.type_of_module,pcms_joint.discipline,pcms_joint.deck_elevation');
		$query = $this->db->join('pcms_workpack_detail','(pcms_joint.id = pcms_workpack_detail.id_template AND pcms_joint.workpack_id = pcms_workpack_detail.id_workpack)');
		$query = $this->db->join('pcms_workpack','pcms_joint.workpack_id = pcms_workpack.id',"LEFT");
		$query = $this->db->get('pcms_joint');	
		return $query->result_array();
	}

	public function get_punchlist($where = NULL){
		if(isset($where)){
			$this->db_punchlist->where($where);
		}
		$query = $this->db_punchlist->get('pcms_punchlist');
		return $query->result_array();
	}

	public function update_punchlist($set, $where) {
	    $this->db_punchlist->where($where);
	    $this->db_punchlist->update("pcms_punchlist", $set);
	}

	public function insert_punchlist_activity($data) {
		$this->db_punchlist->insert('pcms_punchlist_activity', $data);
		$insert_id = $this->db_punchlist->insert_id();
		return $insert_id;
	}

	public function update_pcms_summary($data, $where) {
		$data = convert2null($data);
	    $this->db->where($where);
	    $this->db->update("pcms_summary", $data);
	}

	public function display_piecemark_status($where) {
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->join('master_wp_progress b','a.id_joint = b.id_template','LEFT');
		$query = $this->db->get('master_calculation a');
		return $query->result_array();
	}

	public function search_id_temp_pc($where) {
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->select('id');
		$query = $this->db->get('pcms_piecemark');
		return $query->result_array();
	}

	function jt_detail($where = null){
		if(isset($where)){
		 $this->db->where($where);
		}
		$query = $this->db->get('pcms_joint');
		return $query->result_array();
	}

	public function piecemark_update_measurement($data, $where) {
		$this->db->where($where);
		$this->db->update("pcms_summary", $data);
	  }

	public function search_last_data_summary($where, $data_sum = null) {
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($data_sum)){
			$query = $this->db->order_by("id_sum","DESC");
			$query = $this->db->limit(1);
		}
		$query = $this->db->get('pcms_summary');
		return $query->result_array();
	}

	public function insert_measurement($form_data) {
		$this->db->insert('pcms_summary', $form_data);
	}

	public function plan_measurement_list($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		$query = $this->db->order_by('year_week', 'asc');
		$query = $this->db->order_by('week_no', 'asc');
		$query = $this->db->get('master_plan_measurement');
		return $query->result_array();
	}

	public function plan_measurement_new_process_db($data) {
		$data = convert2null($data);
		$this->db->insert('master_plan_measurement', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function plan_measurement_update_process_db($data, $where) {
		$data = convert2null($data);
		$this->db->where($where);
		$this->db->update("master_plan_measurement", $data);
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

	function revise_history_list($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->get('pcms_revise_history');
		return $query->result_array();
 	}

  public function revise_history_new_process_db($data) {
    $this->db->insert('pcms_revise_history', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
  }

  public function revise_history_update_process_db($data, $where) {
    $this->db->where($where);
    $this->db->update("pcms_revise_history", $data);
  }

	function revision_log_list($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->order_by('created_date', 'desc');
		$query = $this->db->get('pcms_update_revision_log');
		return $query->result_array();
 	}

  public function revision_log_new_process_db($data) {
    $this->db->insert('pcms_update_revision_log', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
  }

  function autocomplete_uniq_bnp($where = null){
		if(isset($where)){
		 $this->db_wh->where($where);
		}
		$query = $this->db_wh->get('pcms_wm_ready_material');
		return $query->result_array();
	}

	function get_uom_details($where = null){
		if(isset($where)){
		 $this->db_wh->where($where);
		}
		$query = $this->db_wh->get('pcms_wm_master_uom');
		return $query->result_array();
	}

	public function get_last_submission_irn_id($project){
		$this->db->select('irn_transmitted_no');
    $this->db->from('pcms_irn');
    $this->db->where('irn_project',$project);
    $this->db->limit(1);
		$this->db->order_by('irn_transmitted_no',"DESC");
		return $this->db->get()->result_array();
	}

	public function insert_id_irn_main($data) {
		$this->db->insert('pcms_irn', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function insert_id_irn_detail($data) {
		$this->db->insert('pcms_irn_detail', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function get_irn_detail($where = null){
		if(isset($where)){
			$this->db->where($where);
		}
		$query = $this->db->select('*');
		$query = $this->db->join('pcms_irn_detail b','a.id_irn = b.id_irn_main',"LEFT");
		$query = $this->db->get('pcms_irn a');
		return $query->result_array();
	}

	public function update_irn_detail($data, $where) {
		$data = convert2null($data);
		$this->db->where($where);
		$this->db->update("pcms_irn_detail", $data);
	}

	function workpack_list_complete($where = null, $limit = null){
	    if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		$query = $this->db->from('pcms_workpack a');
		$query = $this->db->join('pcms_workpack_detail b', 'a.id=b.id_workpack', LEFT);
		return $query->get()->result_array();
	}

	function job_register_list($where = null, $limit = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		$query = $this->db->order_by('job_no', 'asc');
		$query = $this->db->get('pcms_workpack_job_no');
		return $query->result_array();
	}

	public function job_register_new_process_db($data) {
		$data = convert2null($data);
		$this->db->insert('pcms_workpack_job_no', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function job_register_update_process_db($data, $where) {
		$data = convert2null($data);
		$this->db->where($where);
		$this->db->update("pcms_workpack_job_no", $data);
	}

	function search_data_subcont($where = null, $limit = null){
		if(isset($where)){
			$this->db_iss->where($where);
		}		
		if(isset($limit)){
			$this->db_iss->limit($limit);
		}
		$this->db_iss->where("status","0");
		$query = $this->db_iss->order_by('badge_id', 'asc');
		$query = $this->db_iss->get('iss_recruitment_bankdata');
		return $query->result_array();
	}

	function iss_project_data(){
		$this->db_iss->where("status","1");
		$query = $this->db_iss->get('iss_project');
		return $query->result_array();
	}

		function master_area_v2($where = null){
		if(isset($where)){
				$this->db->where($where);
			}
			$query = $this->db->get('master_area_v2');
			return $query->result_array();
		}	
		 
		function master_location_v2($where = null){
		if(isset($where)){
				$this->db->where($where);
			}
			$query = $this->db->get('master_location_v2');
			return $query->result_array();
		}


		public function select_data_piecemarks($where) {
			if(isset($where)){
				$this->db->where($where);
			} 
			$query = $this->db->limit(1);
			$query = $this->db->get('pcms_piecemark');
			return $query->result_array();
		}

		public function select_data_fitup($where) {
			if(isset($where)){
				$this->db->where($where);
			} 
			$query = $this->db->limit(1);
			$query = $this->db->get('pcms_fitup');
			return $query->result_array();
		}

		public function select_data_visual($where) {
			if(isset($where)){
				$this->db->where($where);
			} 
			$query = $this->db->limit(1);
			$query = $this->db->get('pcms_visual');
			return $query->result_array();
		}

		function workpack_list_data($where = null, $limit = null){
			if(isset($where)){
				$this->db->where($where);
			}
			if(isset($limit)){
				$this->db->limit($limit);
			} 
			$query = $this->db->get('pcms_workpack');
			return $query->result_array();
		}

		function workpack_sub_list_data($where = null, $limit = null){
			if(isset($where)){
				$this->db->where($where);
			}
			if(isset($limit)){
				$this->db->limit($limit);
			} 
			$query = $this->db->select('pws.workpack_no, pw.phase, pw.description, pw.module, pw.type_of_module, pw.discipline, pw.deck_elevation, pw.desc_assy, pw.location, pw.work_detail, pw.plan_start_date, pw.plan_finish_date, pw.type, pw.id, pws.id_workpack, pws.activity');
			$query = $this->db->join('pcms_workpack_subactivity pws', 'pw.id = pws.id_workpack');
			$query = $this->db->group_by('pws.workpack_no, pw.phase, pw.description, pw.module, pw.type_of_module, pw.discipline, pw.deck_elevation, pw.desc_assy, pw.location, pw.work_detail, pw.plan_start_date, pw.plan_finish_date, pw.type, pw.id, pws.id_workpack, pws.activity');
			$query = $this->db->get('pcms_workpack pw');
			return $query->result_array();
		}

		function get_paint_system($where = null, $limit = null){
			if(isset($where)){
				$this->db->where($where);
			}
			if(isset($limit)){
				$this->db->limit($limit);
			} 
			$query = $this->db->get('master_paint_system');
			return $query->result_array();
		}

		function get_master_bnp_activity($where = null, $limit = null){
			if(isset($where)){
				$this->db->where($where);
			}
			if(isset($limit)){
				$this->db->limit($limit);
			} 
			$query = $this->db->get('master_bnp_activity');
			return $query->result_array();
		}

		function get_irn_approved_list($where = null, $limit = null){
			if(isset($where)){
				$this->db->where($where);
			}
			if(isset($limit)){
				$this->db->limit($limit);
			} 
			$query = $this->db->select('report_number, discipline, max(id_joint) as id_joint, max(id_piecemark) as id_piecemark, max(category_irn) as category_irn');
			$query = $this->db->group_by('report_number,discipline');
			$query = $this->db->order_by('report_number',"desc");
			$query = $this->db->get('pcms_irn');
			return $query->result_array();
		}

		function get_irn_approved_list_material($where = null, $limit = null){
			if(isset($where)){
				$this->db->where($where);
			}
			if(isset($limit)){
				$this->db->limit($limit);
			} 
			$query = $this->db->select('max(b.is_itr) as is_itr,max(a.status_inspection) as status_inspection, a.report_number, b.project, b.discipline, b.module, b.type_of_module, max(a.id_joint) as id_joint, max(a.id_piecemark) as id_piecemark, max(a.category_irn) as category_irn');
			$query = $this->db->group_by('a.report_number, b.project, b.discipline, b.module, b.type_of_module');
			$query = $this->db->order_by('a.report_number',"desc");
			$query = $this->db->join('pcms_piecemark b','a.id_piecemark = b.id',"LEFT");
			$query = $this->db->get('pcms_irn a');
			return $query->result_array();
		}

		function get_irn_approved_list_joint($where = null, $limit = null){
			if(isset($where)){
				$this->db->where($where);
			}
			if(isset($limit)){
				$this->db->limit($limit);
			} 
			$query = $this->db->select('max(a.status_inspection) as status_inspection, a.report_number, b.project, b.discipline, b.module, b.type_of_module, max(a.id_joint) as id_joint, max(a.id_piecemark) as id_piecemark, max(a.category_irn) as category_irn');
			$query = $this->db->group_by('a.report_number, b.project, b.discipline, b.module, b.type_of_module');
			$query = $this->db->order_by('a.report_number',"desc");
			$query = $this->db->join('pcms_joint b','a.id_joint = b.id',"LEFT");
			$query = $this->db->get('pcms_irn a');
			return $query->result_array();
		}

		function get_irn_approved_material_data($where = null, $limit = null){
			if(isset($where)){
				$this->db->where($where);
			}
			if(isset($limit)){
				$this->db->limit($limit);
			}   
			$query = $this->db->where("c.status_delete",0);
			$query = $this->db->where("c.report_resubmit_status",0); 
			$query = $this->db->join('pcms_material c','a.id_piecemark = c.id_piecemark',"LEFT");
			$query = $this->db->join('pcms_piecemark b','a.id_piecemark = b.id',"LEFT");
			$query = $this->db->get('pcms_irn a');
			return $query->result_array();
		}

		function get_irn_approved_joint_data($where = null, $limit = null){
			if(isset($where)){
				$this->db->where($where);
			}
			if(isset($limit)){
				$this->db->limit($limit);
			}    
			//$query = $this->db->join('pcms_workpack_detail e','a.id_joint = e.id_template',"LEFT");
			// $query = $this->db->join('pcms_fitup d','a.id_joint = d.id_joint',"LEFT");
			// $query = $this->db->join('pcms_visual c','a.id_joint = c.id_joint',"LEFT");
			$query = $this->db->join('pcms_joint b','a.id_joint = b.id',"LEFT");
			$query = $this->db->get('pcms_irn a');
			return $query->result_array();
		}

		function get_irn_approved_material_data_workpack($where = null, $limit = null){
			if(isset($where)){
				$this->db->where($where);
			}
			if(isset($limit)){
				$this->db->limit($limit);
			}     
			$query = $this->db->select("*,c.id as wp_detail_id");
			$query = $this->db->where("d.status_delete",0);
			$query = $this->db->where("c.status_delete",1);
			$query = $this->db->where("d.report_resubmit_status",0);
			$query = $this->db->join('pcms_material d','a.id_piecemark = d.id_piecemark',"LEFT");
			$query = $this->db->join('pcms_workpack_detail c','a.id_piecemark = c.id_template',"LEFT");
			$query = $this->db->join('pcms_piecemark b','a.id_piecemark = b.id',"LEFT");
			$query = $this->db->get('pcms_irn a');
			return $query->result_array();
		}

		public function update_fitup_data_surveyor($data, $where) {
			$data = convert2null($data);
			$this->db->where($where);
			$this->db->update("pcms_fitup", $data);
		}

		function get_master_surveyor_status($where = null, $limit = null){
			if(isset($where)){
				$this->db->where($where);
			}
			if(isset($limit)){
				$this->db->limit($limit);
			}     
			 
			$query = $this->db->get('master_surveyor_status');
			return $query->result_array();
		}

		function joint_list_visual_surveyor($where = null, $limit = null){
			if(isset($where)){
				$this->db->where($where);
			}
			if(isset($limit)){
				$this->db->limit($limit);
			}
			
			$query = $this->db->select('
					*,
					pcms_visual.id_visual as id_visual,
					pcms_visual.location as vs_location,
					pcms_visual.status_inspection as vs_status,
					pcms_joint.drawing_type AS drawing_type_template,
					pcms_joint.id AS id_jn_temp,
					pcms_workpack.id AS id_wp_main,
					pcms_workpack.id AS id_workpack,
					pcms_joint.drawing_wm AS drawing_wm,
					pcms_visual.status_inspection as status_inspection_svy,
					pcms_visual.inspection_by as inspection_by_svy,
					pcms_visual.inspection_datetime as inspection_date_svy,
					pcms_visual.inspection_client_by as client_inspection_by_svy,
					pcms_visual.submission_id as submission_id,				
					pcms_visual.inspection_client_datetime as client_inspection_date_svy, 
			');
			$query = $this->db->order_by('pcms_joint.drawing_no,pcms_joint.joint_no,pcms_visual.submission_id',"asc");
			$query = $this->db->join('pcms_workpack_detail','(pcms_joint.id = pcms_workpack_detail.id_template AND pcms_joint.workpack_id = pcms_workpack_detail.id_workpack)',"LEFT");
			 $query = $this->db->join('pcms_visual','(pcms_joint.id = pcms_visual.id_joint AND pcms_joint.workpack_id = pcms_visual.id_workpack)',"LEFT");
			$query = $this->db->join('pcms_workpack','pcms_joint.workpack_id = pcms_workpack.id',"LEFT");
			$query = $this->db->get('pcms_joint');
			return $query->result_array();
		}


		public function update_visual_data_surveyor($data, $where) {
			$data = convert2null($data);
			$this->db->where($where);
			$this->db->update("pcms_visual", $data);
		}

		public function workpack_detail_paint_system_new_process_db($data) {
			$data = convert2null($data); 
			$this->db->insert("pcms_workpack_paint_system", $data);
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}

		public function workpack_detail_paint_system_edit_process_db($data, $where) {
			$data = convert2null($data);
			$this->db->where($where);
			$this->db->update("pcms_workpack_paint_system", $data);
		}

		public function workpack_detail_new_process_db_bnp($data) {
			$data = convert2null($data); 
			$this->db->insert("pcms_workpack_detail", $data);
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}

		function workpack_list_paint_system($where = null){
			$query = $this->db->select("
				pcms_workpack_paint_system.*
			");
			if(isset($where)){
				$this->db->where($where);
			}
			$query = $this->db->order_by("id_paint_system","asc");
			$query = $this->db->order_by("id_activity","asc");
			$query = $this->db->join('pcms_workpack','pcms_workpack.id = pcms_workpack_paint_system.id_workpack');
			$query = $this->db->get('pcms_workpack_paint_system');
			return $query->result_array();
		}

		function workpack_paint_system_list($where = null){
			$query = $this->db->select("
				pcms_workpack_paint_system.*
			");
			if(isset($where)){
				$this->db->where($where);
			}
			$query = $this->db->order_by("id_template","asc");
			$query = $this->db->order_by("id_paint_system","asc");
			$query = $this->db->order_by("id_activity","asc");
			$query = $this->db->get('pcms_workpack_paint_system');
			return $query->result_array();
		}

		public function workpack_detail_pnt_delete_process_db($where) {
			$this->db->where($where);
			$this->db->delete("pcms_workpack_paint_system");
		}

		public function get_matrix_for_bnp($where = null){
			if(isset($where)){
				$this->db->where($where);
			} 
			$query = $this->db->order_by("code_activity","asc");
			$query = $this->db->join('master_bnp_activity b','a.id = b.id_paint_system',"LEFT");
			$query = $this->db->get('master_paint_system a');
			return $query->result_array();
		}

		public function get_data_submition_pcms_bnp($where = null){
			$query = $this->db->select("
				pcms_bnp.*
			");
			if(isset($where)){
				$this->db->where($where);
			}  
			$query = $this->db->join('pcms_workpack_paint_system','pcms_workpack_paint_system.id_wp = pcms_bnp.id_detail_wp_paint_system');
			$query = $this->db->join('pcms_workpack','pcms_workpack.id = pcms_workpack_paint_system.id_workpack');
			$query = $this->db->get('pcms_bnp');
			return $query->result_array();
		}

		public function get_data_material_all($where = null){

			if(isset($where)){
				$this->db->where($where);
			}   

			$where['b.status_delete']           = 0;
      		$where['b.report_resubmit_status']  = 0;
			$query = $this->db->select("*, a.area as total_area");
			$query = $this->db->join("pcms_material b","a.id = b.id_piecemark","LEFT");
			$query = $this->db->get("pcms_piecemark a");
			return $query->result_array();

		}

		public function get_data_submition_pcms_bnp_all($where = null){
			if(isset($where)){
				$this->db->where($where);
			}  

			$query = $this->db->select('*,a.id_paint_system as id_paint_system,a.id_activity as id_activity,a.id_activity as id_activity');
			$query = $this->db->join('pcms_bnp b','b.id_detail_wp_paint_system = a.id_wp', 'LEFT');
			$query = $this->db->get('pcms_workpack_paint_system a');
			return $query->result_array();
		}

		public function update_status_bp_workpack_paint_system($data, $where) {
			$data = convert2null($data);
			$this->db->where($where);
			$this->db->update("pcms_workpack_paint_system", $data);
		}

		public function update_pcms_workpack_paint_system($data, $where) {
			$data = convert2null($data);
			$this->db->where($where);
			$this->db->update("pcms_workpack_paint_system", $data);
		}

		function workpack_list_workpack_based($where = null){
			if(isset($where)){
				$this->db->where($where);
			} 
			$query = $this->db->join('pcms_workpack b','a.id_workpack = b.id', 'LEFT');
			$query = $this->db->get('pcms_workpack_paint_system a');
			return $query->result_array();
		}

		function validation_create_workpackbnp($where = null, $limit = null){ 
			if(isset($where)){
				$this->db->where($where);
			}
			if(isset($limit)){
				$this->db->limit($limit);
			}  
			$query = $this->db->join('pcms_workpack_detail b','a.id = b.id_workpack','LEFT');
			$query = $this->db->get('pcms_workpack a');	
			return $query->result_array();
		}

		function get_mis_issued_detail_all($where = null){
			if(isset($where)){
				$this->db_wh->where($where);
			}
			$query = $this->db_wh->select("*,detail.workpack_no AS workpack_number,detail.unique_no as mis_unique_no,detail.id_mis as id_mis,detail.id_mis_det as id_mis_detail");
			$query = $this->db_wh->join("(SELECT a.workpack_no,b.unique_no,a.id_mis,b.id_mis_det FROM pcms_wm_mis a LEFT JOIN pcms_wm_mis_detail b ON a.uniq_data = b.uniq_data') detail","mrir.unique_ident_no = detail.unique_no");
			$query = $this->db_wh->get('qcs_material mrir');
			return $query->result_array();
		}

		public function process_delete_material_detail($id){
			$this->db->where('id_material', $id);
			$this->db->delete('pcms_material');
		}


		public function select_pcms_joint($where){
			if(isset($where)){
				$query =  $this->db->where($where);
			}
			$query = $this->db->limit(1);
			$query = $this->db->get('pcms_joint');	
			return $query->result_array();
		}

		public function select_pcms_piecemark($where){
			if(isset($where)){
				$query =  $this->db->where($where);
			}
			$query = $this->db->limit(1);
			$query = $this->db->get('pcms_piecemark');	
			return $query->result_array();
		}

		function export_excel_bnp($where = null){
			if(isset($where)){
				$query = $this->db->where($where);
			} 

			$query = $this->db->select("*,d.area as total_area,a.remarks as bnp_remark,a.id_paint_system as id_paint_system,a.id_activity as id_activity");
			// $query = $this->db->limit(1);
			$query = $this->db->order_by('workpack_no','desc');
			$query = $this->db->join('pcms_material e','e.id_piecemark = a.id_template');
			$query = $this->db->join('pcms_piecemark d','d.id = a.id_template');
			$query = $this->db->join('pcms_bnp c','c.id_detail_wp_paint_system = a.id_wp','LEFT');
			$query = $this->db->join('pcms_workpack b','b.id = a.id_workpack');
			$query = $this->db->get('pcms_workpack_paint_system a');
			return $query->result_array();
		}


		function piecemark_list_itr($where = null, $limit = null){
			if(isset($where)){
				$this->db->where($where);
			}
			if(isset($limit)){
				$this->db->limit($limit);
			}	
			$query = $this->db->where("pcms_piecemark.status_delete","1");
			$query = $this->db->select('*,pcms_piecemark.id AS id_pc_temp,pcms_workpack.id AS id_wp_main,pcms_workpack_detail.id as workpack_detail_id');
			$query = $this->db->join('pcms_workpack_detail','(pcms_piecemark.id = pcms_workpack_detail.id_template AND pcms_piecemark.workpack_id = pcms_workpack_detail.id_workpack)',"LEFT");
			$query = $this->db->join('pcms_itr','(pcms_piecemark.id = pcms_itr.id_piecemark AND pcms_piecemark.workpack_id = pcms_itr.id_workpack)',"LEFT");
			$query = $this->db->join('pcms_workpack','pcms_piecemark.workpack_id = pcms_workpack.id',"LEFT");
			$query = $this->db->get('pcms_piecemark');
			return $query->result_array();
		}

		public function submit_itr_data($form_data) {
			$this->db->insert('pcms_itr', $form_data);
		}

		public function get_last_submission_id_company_based($project_code,$discipline,$mod_id,$type_of_module,$company_id){
			$this->db->select('pcms_itr.submission_id'); 
			$this->db->where('pcms_itr.project_code',$project_code);
			$this->db->where('pcms_itr.discipline',$discipline);
			$this->db->where('pcms_itr.module',$mod_id);
			$this->db->where('pcms_itr.type_of_module',$type_of_module);        
			$this->db->where('pcms_itr.submission_id IS NOT NULL',NULL);        
			$this->db->where('pcms_workpack.company_id',$company_id);        
			$this->db->limit(1);
			$this->db->order_by('pcms_itr.submission_id',"DESC"); 
			$this->db->join('(SELECT id, company_id FROM pcms_workpack) pcms_workpack','pcms_workpack.id = pcms_itr.id_workpack');	 
			return $this->db->get("pcms_itr")->result_array();
		}

		function itr_submission_list($where = null, $limit = null){
			if(isset($where)){
				$this->db->where($where);
			}
			if(isset($limit)){
				$this->db->limit($limit);
			}	
			
			$query = $this->db->select('
				max(b.project) as project,
				max(b.discipline) as discipline,
				max(b.module) as module,
				max(b.type_of_module) as type_of_module,
				max(b.deck_elevation) as deck_elevation,
				max(b.drawing_ga) as drawing_ga,
				max(b.rev_ga) as rev_ga,
				max(c.workpack_no) as workpack_no,
				max(c.company_id) as company_id,
				max(a.surveyor_creator) as surveyor_creator,
				max(a.surveyor_created_date) as surveyor_created_date,
				max(a.inspection_by) as inspection_by,
				max(a.inspection_datetime) as inspection_datetime,
				a.submission_id as submission_id
			');
			$query = $this->db->order_by('a.submission_id','desc');
			$query = $this->db->group_by('a.submission_id');
			$query = $this->db->join('pcms_workpack c','a.id_workpack = c.id');
			$query = $this->db->join('pcms_piecemark b','a.id_piecemark = b.id');
			$query = $this->db->get('pcms_itr a');
			return $query->result_array();
		}

		function itr_submission_list_detail($where = null, $limit = null){
			if(isset($where)){
				$this->db->where($where);
			}
			if(isset($limit)){
				$this->db->limit($limit);
			}	
			
			$query = $this->db->select('
				b.project,
				b.discipline, 
				b.module,
				b.type_of_module,
				b.deck_elevation,
				b.drawing_ga,
				b.rev_ga,
				b.part_id,
				b.grade,
				c.id as id_workpack,
				c.workpack_no,
				c.company_id,
				a.drawing_no as drawing_no,
				a.id_itr as id_itr,
				a.submission_id as submission_id,
				a.requestor as requestor,
				a.date_request as date_request,
				a.id_piecemark as id_piecemark,
				a.id_mis as id_mis,
				a.inspection_by,
				a.inspection_datetime,
				a.surveyor_creator,
				a.surveyor_created_date,
				a.cons_lot_no,
				a.welder_id,
				a.wps_id,
				a.ga_rev_no,
				a.area,
				a.area_v2,
				a.location_v2,
				a.point_v2,
				a.status_inspection,
				a.status_delete,
			');
			$query = $this->db->order_by('a.submission_id','desc'); 
			$query = $this->db->join('pcms_workpack c','a.id_workpack = c.id');
			$query = $this->db->join('pcms_piecemark b','a.id_piecemark = b.id');
			$query = $this->db->get('pcms_itr a');
			return $query->result_array();
		}

		public function itr_update_data($data, $where) {
			$data = convert2null($data);
			$this->db->where($where);
			$this->db->update("pcms_itr", $data);
		}

	public function data_mis_material($where = null) {
		$this->db_wh->select('mis.*, detail.*, mis.status as mis_status, detail.status as misdet_status, detail.issued_status as misdet_issued_status');
		if(isset($where)) {
			$this->db_wh->where($where);
		}

		$this->db_wh->from('pcms_wm_mis mis');
		$this->db_wh->join('pcms_wm_mis_detail detail','detail.uniq_data = mis.uniq_data', 'left');
		$query = $this->db_wh->get(); 
		return $query->result_array();
	}

	function get_irn_approved_material_data_itr($where = null, $limit = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}   
		$query = $this->db->where("c.status_delete",0);
		$query = $this->db->where("c.report_resubmit_status",0); 
		$query = $this->db->join('pcms_itr c','a.id_piecemark = c.id_piecemark',"LEFT");
		$query = $this->db->join('pcms_piecemark b','a.id_piecemark = b.id',"LEFT");
		$query = $this->db->get('pcms_irn a');
		return $query->result_array();
	}


	function get_irn_approved_material_data_workpack_itr($where = null, $limit = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}     
		$query = $this->db->select("*,c.id as wp_detail_id");
		$query = $this->db->where("d.status_delete",0);
		$query = $this->db->where("d.report_resubmit_status",0);
		$query = $this->db->join('pcms_itr d','a.id_piecemark = d.id_piecemark',"LEFT");
		$query = $this->db->join('pcms_workpack_detail c','a.id_piecemark = c.id_template',"LEFT");
		$query = $this->db->join('pcms_piecemark b','a.id_piecemark = b.id',"LEFT");
		$query = $this->db->get('pcms_irn a');
		return $query->result_array();
	}

	function search_unique_list($where = null, $limit = null, $order_by = null){
		if(isset($where)){
			$this->db_wh->where($where);
		}
		if(isset($limit)){
			$this->db_wh->limit($limit);
		}
		$this->db_wh->select('mb.unique_no, mb.mb_id');
		$this->db_wh->order_by('mb.unique_no', 'ASC');
		$this->db_wh->from('pcms_wm_mat_bal mb');
		$this->db_wh->join('qcs_material mrir','mb.unique_no = mrir.unique_ident_no');
		$query = $this->db_wh->get();
		return $query->result_array();
	}

	public function wh_material_balance_mrir_list($where = null){
		if(isset($where)){
			$this->db_wh->where($where);
		}
		$this->db_wh->from('pcms_wm_mat_bal mb');
		$this->db_wh->join('qcs_material mrir','mb.unique_no = mrir.unique_ident_no');
		$this->db_wh->order_by('mb.unique_no', 'ASC');
		$query = $this->db_wh->get();
		return $query->result_array();
	}

	function joint_list_bonstrand($where = null, $limit = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		
		$query = $this->db->select('
					*,
					pcms_joint.drawing_no AS drawing_no_temp,
					pcms_joint.drawing_type AS drawing_type_template,
					pcms_joint.id AS id_jn_temp, 
					pcms_joint.diameter AS jn_diameter,
					pcms_joint.spool_no AS jn_spool_no,
					pcms_workpack.id AS id_wp_main,
					pcms_workpack.id AS id_workpack,
					pcms_bondstrand.bonder_id as bonder_id,
					pcms_bondstrand.status_inspection as status_inspection_svy,
					pcms_bondstrand.inspection_by as inspection_by_svy,
					pcms_bondstrand.inspection_date as inspection_date_svy, 
					pcms_bondstrand.submission_id as submission_id, 
					pcms_bondstrand.remarks as remarks_baa, 
		');
		$query = $this->db->select('*,pcms_joint.id as id_joint_template');
		$query = $this->db->order_by('pcms_joint.drawing_no,pcms_joint.joint_no,pcms_bondstrand.submission_id',"asc");
		$query = $this->db->join('pcms_workpack_detail','(pcms_joint.id = pcms_workpack_detail.id_template AND pcms_joint.workpack_id = pcms_workpack_detail.id_workpack)',"LEFT");
		$query = $this->db->join('(SELECT * FROM pcms_bondstrand WHERE status_delete = 1 AND status_inspection <> 12) pcms_bondstrand','(pcms_joint.id = pcms_bondstrand.id_joint AND pcms_joint.workpack_id = pcms_bondstrand.id_workpack)',"LEFT");
		$query = $this->db->join('pcms_workpack','pcms_joint.workpack_id = pcms_workpack.id',"LEFT");
		$query = $this->db->get('pcms_joint');
		return $query->result_array();
	}

	public function bondstrand_register($where = null) {
		if(isset($where)){
			$query = $this->db->where($where);
			$query = $this->db->limit("10");
		}	
		$query = $this->db->where("status","1");	 
		$query = $this->db->order_by("bonder_id","asc");
		$query = $this->db->get('master_bonder');
		return $query->result_array();
	}

	public function select_data_bondstrant($where) {
		if(isset($where)){
			$this->db->where($where);
		} 
		$query = $this->db->limit(1);
		$query = $this->db->get('pcms_bondstrand');
		return $query->result_array();
	}

	function insert_bonstrand_data($data){
		convert2null($data);
		$this->db->insert("pcms_bondstrand", $data);
		return $this->db->insert_id();
	}


	public function get_last_submission_id_company_based_baa($project_code,$discipline,$mod_id,$type_of_module,$company_id){
		$this->db->select('pcms_bondstrand.submission_id'); 
		$this->db->where('pcms_bondstrand.project',$project_code);
		$this->db->where('pcms_bondstrand.discipline',$discipline);
		$this->db->where('pcms_bondstrand.module',$mod_id);
		$this->db->where('pcms_bondstrand.type_of_module',$type_of_module);        
		$this->db->where('pcms_bondstrand.submission_id IS NOT NULL',NULL);        
		$this->db->where('pcms_workpack.company_id',$company_id);        
		$this->db->limit(1);
		$this->db->order_by('pcms_bondstrand.submission_id',"DESC"); 
		$this->db->join('(SELECT id, company_id FROM pcms_workpack) pcms_workpack','pcms_workpack.id = pcms_bondstrand.id_workpack');	 
		return $this->db->get("pcms_bondstrand")->result_array();
	}

	public function update_bondstrand_data($data, $where) {
		$data = convert2null($data);
		$this->db->where($where);
		$this->db->update("pcms_bondstrand", $data);
	}

	public function workpack_subactivity_new_process_db($data) {
		$data = convert2null($data);
		$this->db->insert('pcms_workpack_subactivity', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function workpack_subactivity_update_process_db($data, $where) {
		$data = convert2null($data);
		$this->db->where($where);
		$this->db->update("pcms_workpack_subactivity", $data);
	}

	function workpack_subactivity_list($where = null, $limit = null){
	    if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		$query = $this->db->order_by('id', 'asc');
		$query = $this->db->get('pcms_workpack_subactivity');
		return $query->result_array();
	}

	public function workpack_pic_history_new_process_db($data) {
		$data = convert2null($data);
		$this->db->insert('pcms_workpack_pic_history', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function workpack_pic_history_update_process_db($data, $where) {
		$data = convert2null($data);
		$this->db->where($where);
		$this->db->update("pcms_workpack_pic_history", $data);
	}

	function workpack_pic_history_list($where = null, $limit = null){
	    if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		$query = $this->db->order_by('id', 'asc');
		$query = $this->db->get('pcms_workpack_pic_history');
		return $query->result_array();
	}

	public function unique_search($where, $limit = null){
		$this->db_wh->where($where);
		if(isset($limit)){
			$this->db_wh->limit($limit);
		}
		$this->db_wh->select('mrir.unique_ident_no, mrir.spec');
		$this->db_wh->from('pcms_wm_mat_bal mb');
		$this->db_wh->join('qcs_material mrir','mb.unique_no = mrir.unique_ident_no');
		$this->db_wh->order_by('mb.unique_no', 'ASC');
		$query = $this->db_wh->get();
		return $query->result_array();
	}

	public function unique_search_prod($where, $limit = null){
		$this->db_wh->where($where);
		if(isset($limit)){
			$this->db_wh->limit($limit);
		}
		$this->db_wh->select('mrir.unique_ident_no, mrir.spec');
		$this->db_wh->from('pcms_wm_balance_production mb');
		$this->db_wh->join('qcs_material mrir','mb.unique_no = mrir.unique_ident_no');
		$this->db_wh->order_by('mb.unique_no', 'ASC');
		$query = $this->db_wh->get();
		return $query->result_array();
	}

	function workpack_job_desc_list($where = null, $limit = null){
		if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		$query = $this->db->get('pcms_workpack_job_desc');
		return $query->result_array();
	}
	
  public function workpack_project($where = null) {
    $this->db->select('project');
    $this->db->from('pcms_workpack');
    $this->db->where('status_delete', 1);
    $this->db->group_by('project');
    $query = $this->db->get(); 
    return $query->result_array();
  }

  public function balance_production_join($where = null) {
    if(isset($where)) {
        $this->db_wh->where($where);
    }
    $this->db_wh->select('*');
    $this->db_wh->from('pcms_wm_balance_production balance');
    $this->db_wh->join('(
        SELECT 
        unique_ident_no,
        catalog_id,
        uom,
        heat_or_series_no,
        mill_cert_no,
        plate_or_tag_no,
        mrir_id,
        spec,
        spec_category   

        FROM qcs_material
    ) qcs_material','balance.unique_no = qcs_material.unique_ident_no');
    $this->db_wh->join('(
        SELECT
        report_no,
        id AS mrir_id,
        company_id AS company_id

        FROM qcs_mrir
    ) qcs_mrir','qcs_mrir.mrir_id = qcs_material.mrir_id');
    $this->db_wh->join('(
        SELECT
        id AS catalog_id,
        material,
        catalog_category_id,
        length_m,
        width_m,
        weight,
        od,
        thk_mm,
        sch

        FROM pcms_wm_material_catalog 

    ) catalog','catalog.catalog_id = qcs_material.catalog_id');
    $query = $this->db_wh->get(); 
    return $query->result_array();

}

  public function uom_list($where = NULL) {
    if($where){
        $query = $this->db_wh->where($where);
    }
    $query = $this->db_wh->get('pcms_wm_master_uom');
    return $query->result_array();
  }

  public function material_category_data($where = NULL){
    if($where){
        $query = $this->db_wh->where($where);
    }
    $query = $this->db_wh->get('pcms_wm_catalog_category');
    return $query->result_array();
  }


}
/*
End Model Auth_mod
*/