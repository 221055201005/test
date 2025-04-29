<?php

class Dimension_mod extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->db2 = $this->load->database('db_portal', TRUE);
		$this->db3 = $this->load->database('db_eng_mysql', TRUE); 
	}

	function data_material_verification($status,$project_id = null){
		$this->db->select('*');
        $this->db->from('qcs_mat_verify');
        if(isset($project_id)){
       	 	$this->db->where('project_code', $project_id);
    	}
        $this->db->where('status', $status);
        $this->db->order_by('mat_verid',"DESC");
        return $this->db->get()->result();
	}

	function data_discipline(){
		$this->db->select('*');
        $this->db->from('master_discipline');
        return $this->db->get()->result();
	}

	function data_module(){
		$this->db->select('*');
        $this->db->from('master_module');
        return $this->db->get()->result();
	}

	//LIST DIMENSION CONTROL
	function data_dc($where = NULL){
		if($where){
			$query = $this->db->where($where);
		}

		$query = $this->db->select("b.rfi_no, b.report_number, a.drawing_no, b.dc_status , a.discipline, a.module, a.type_of_module, a.deck_elevation, a.requestor_company, a.requestor, a.option_date, b.attachment, a.submission_id, b.id as id_dc_detail_attach, c.id as id_rfi");
 		$query = $this->db->join('pcms_dimension_control_attach b','a.submission_id = b.submission_id','LEFT');
 		$query = $this->db->join('rfi_additional_report c','b.id = c.id_main','LEFT');
 		$query = $this->db->order_by('a.id desc');
 		$query = $this->db->get('pcms_dimension_control a');
		return $query->result_array();
	}
	//24 AUG FOR dc FIlter
	function data_dc_filter($prjc = NULL, $dscpln = NULL, $mdl = NULL){
		 
		if($prjc){
			$query = $this->db->where('project_id', $prjc);
		} 
		if($dscpln){
			$query = $this->db->where('discipline', $dscpln);
		} 
		if($mdl){
			$query = $this->db->where('module', $mdl);
		}

 		$query = $this->db->get('pcms_dimension_control');
		return $query->result_array();
	}
	//ADD 25 AUG for add attach dc
	function dc_attachment_add($data){
		$this->db->insert("pcms_dimension_control_attach", $data);}

	function data_dc_attch($where = NULL){
		if($where){
			$query = $this->db->where($where);
		}

 		$query = $this->db->get('pcms_dimension_control_attach');
		return $query->result_array();
	}
	//======================

	function get_last_batch_no(){
		$this->db->select('*');
        $this->db->from('pcms_dimension_control');
        $this->db->limit(1);
		$this->db->order_by('id',"DESC");
        return $this->db->get()->result();
	}

	function delete_dc_attch($where = NULL){
		if($where){
			$query = $this->db->where($where);
		}

		$query = $this->db->delete('pcms_dimension_control_attach');
	}


	//ADD DIMENSION CONTROL========================
	function dimension_control_add($data){
		$this->db->insert("pcms_dimension_control", $data);
		return $this->db->insert_id();
	}

	function dimension_control_add_attch($data, $log = null){
		$this->db->insert("pcms_dimension_control_attach", $data);
		return $this->db->insert_id();
	}
	//=============================================

	function dimension_control_approval($log = null, $id, $data,$report_no = null){
		$this->db->where('id', $id);
        $this->db->update('pcms_dimension_control', $data);

       

	}

	function data_draw_eng($where = NULL){
		if($where){
			$query = $this->db->where($where);
		}
		
		$query = $this->db->get('eng_drawing');
		return $query->result_array();
	}

	function data_draw_dc($where = NULL){
		if($where){
			$query = $this->db->where($where);
		}
		
		$query = $this->db->get('pcms_dimension_control');
		return $query->result_array();
	}

	function search_drawing($drawing){
        $this->db->like('drawing_no', $drawing);
        $this->db->order_by('drawing_no', 'ASC');
        $this->db->limit(20);
        return $this->db->get('eng_drawing')->result_array();
	}

	function attachment_delete($id){
        $this->db->where('id', $id);
        $this->db->delete("pcms_dimension_control_attach");
        return true;
    }

	// ----------- Try Datatables ------ //

	// MAHMUD : DATA TABLES AJAX QUERY FOR GROUP DATA DISPOSITION GROUP// 
    
	var $table_drawing_list_dt		  = 'pcms_eng_activity';
	var $column_order_drawing_list_dt   = array('document_no','document_no', 'document_no', 'document_no', 'document_no', 'document_no','document_no');
	var $column_search_drawing_list_dt  = array('document_no','document_no', 'document_no', 'document_no', 'document_no', 'document_no','document_no');
	var $order_drawing_list_dt 		  = array('document_no' => 'asc'); // default order 
  
	private function _get_datatables_drawing_list_dt_query($where = null)
	{
		$this->db3->select('project_id,document_no,discipline,module,deck_elevation');     
		$this->db3->from($this->table_drawing_list_dt);  
		if(isset($where)){
		  $this->db3->where($where);
		} 
		$this->db3->where("status_delete",1);       
		$i = 0;
		
		foreach ($this->column_search_drawing_list_dt as $item) // loop column 
		{
			if ($_POST['search']['value']) // if datatable send POST for search
			{
				
				if ($i === 0) // first loop
				{
					$this->db3->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db3->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db3->or_like($item, $_POST['search']['value']);
				}
				
				if (count($this->column_search_drawing_list_dt) - 1 == $i) //last loop
					$this->db3->group_end(); //close bracket
			}
			$i++;
		}
		
		if (isset($_POST['order'])) // here order processing
		{
		  $this->db3->order_by($this->column_order_drawing_list_dt[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		  $this->db3->select('project_id,document_no,discipline,module,deck_elevation');  
		  $this->db3->group_by("project_id,document_no,discipline,module,deck_elevation");   
		}
		else if (isset($this->order_drawing_list_dt))
		{
			$order = $this->order_drawing_list_dt;
			$this->db3->order_by(key($order), $order[key($order)]);
			$this->db3->group_by("project_id,document_no,discipline,module,deck_elevation");
		}
	}
  
  
	function get_datatables_drawing_list_dt($where = null)
	{
		$this->_get_datatables_drawing_list_dt_query($where);
		$this->db3->select('project_id,document_no,discipline,module,deck_elevation');     
		if ($_POST['length'] != -1)
		$this->db3->limit($_POST['length'], $_POST['start']);
		
		$query = $this->db3->get();
		return $query->result();
	}
  
	public function count_all_drawing_list_dt($where = null)
	{
		$this->db3->from($this->table_drawing_list_dt); 
		if(isset($where)){
		  $this->db3->where($where);
		} 
		$this->db3->select('project_id,document_no,discipline,module,deck_elevation');     
		$this->db3->group_by("project_id,document_no,discipline,module,deck_elevation");
		return $this->db3->count_all_results();
	}
  
	function count_filtered_drawing_list_dt($where=null)
	{
		$this->_get_datatables_drawing_list_dt_query($where);
		$this->db3->select('project_id,document_no,discipline,module,deck_elevation');     
		 $query = $this->db3->get();
		return $query->num_rows();
	} 
   
  // MAHMUD : DATA TABLES AJAX GROUP DATA DISPOSITION GROUP//



function delete_dc_data($where = NULL){
	if($where){
		$query = $this->db->where($where);
	}

	$query = $this->db->delete('pcms_dimension_control');
  }

  function dimension_update($submission_id = null,$data){
	$this->db->where('submission_id', $submission_id);
	$this->db->update('pcms_dimension_control', $data);
  }

  function additional_report_delete($submission_id = null, $data)
  {
	  $this->db->where('submission_id', $submission_id);
	  $this->db->update('pcms_additional_report_joint', $data);
  }

  function dimension_update_attach($submission_id = null,$data){
	$this->db->where('submission_id', $submission_id);
	$this->db->update('pcms_dimension_control_attach', $data);
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
	$query = $this->db->get('pcms_joint');
	return $query->result_array();
 }

	function data_additional_report($where = NULL){
		if($where){
			$query = $this->db->where($where);
		}
		$query = $this->db->select("
					a.rfi_number,
					a.report_number,
					a.submission_id,
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
					max(b.project) as project_id,
				");
		$query = $this->db->group_by("a.submission_id,a.report_number,a.rfi_number");
		$query = $this->db->join('pcms_joint b','a.id_joint = b.id','LEFT');
		$query = $this->db->get('pcms_additional_report_joint a');
		return $query->result_array();
	}

	function data_additional_report_joint($where = NULL, $type_of_report = null){
		if($where){
			$query = $this->db->where($where);
		}
		$query = $this->db->select('*,a.drawing_wm as drawing_wm');
		// $query = $this->db->join('(SELECT * FROM pcms_visual WHERE (status_inspection <> 12 AND status_inspection >= 3) AND (revision IS NULL AND revision_category IS NULL)) c','a.id = c.id_joint');
		$query = $this->db->join('(SELECT * FROM pcms_additional_report_joint WHERE type_of_report = '.$type_of_report.') b','a.id = b.id_joint','LEFT');
		$query = $this->db->get('pcms_joint a');
		return $query->result_array();
	}

	function insert_additional_report($data){
		$data = convert2null($data);
		$this->db->insert("pcms_additional_report_joint", $data);
		return $this->db->insert_id();
	}

	function update_additional_report($where, $data){
		$data = convert2null($data);
		$this->db->where($where);
        $this->db->update('pcms_additional_report_joint', $data);  
	}

	function rfi_additional_report_list($where = NULL){
		if($where){
			$query = $this->db->where($where);
		}
		
		$query = $this->db->get('rfi_additional_report');
		return $query->result_array();
	}

	function rfi_additional_report_insert_process($data){
		$data = convert2null($data);
		$this->db->insert("rfi_additional_report", $data);
		return $this->db->insert_id();
	}

	function rfi_additional_report_update_process($data, $where){
		$data = convert2null($data);
		$this->db->where($where);
		$this->db->update('rfi_additional_report', $data);  
	}

	function rfi_detail_additional_report_list($where = NULL){
		if($where){
			$query = $this->db->where($where);
		}
		
		$query = $this->db->get('rfi_detail_additional_report');
		return $query->result_array();
	}

	function rfi_detail_additional_report_insert_process($data){
		$data = convert2null($data);
		$this->db->insert("rfi_detail_additional_report", $data);
		return $this->db->insert_id();
	}
	
	function rfi_detail_additional_report_update_process($data, $where){
		$this->db->where($where);
		$this->db->update('rfi_detail_additional_report', $data);  
	}

	function pcms_dimension_control_update_process($data, $where){
		$this->db->where($where);
		$this->db->update('pcms_dimension_control', $data);  
	}

	function pcms_dimension_control_attach_update_process($data, $where){
		$this->db->where($where);
		$this->db->update('pcms_dimension_control_attach', $data);  
	}

	public function dc_notification_list($where = null){
		if(isset($where)){
			$this->db->where($where);
		}

		$query = $this->db->select("

			a.*,
			b.id as id_dc_detail_attach,

			");
 		$query = $this->db->join('pcms_dimension_control_attach b','a.rfi_no = b.rfi_no','LEFT');
		$query = $this->db->get('rfi_additional_report a');
		return $query->result_array();
	}
}
?>