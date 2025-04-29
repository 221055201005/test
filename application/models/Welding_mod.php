<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welding_mod extends CI_Model {

	public function __construct(){
	  parent::__construct();
		//$this->db_eng = $this->load->database('db_eng', TRUE);
		$this->db_eng = $this->load->database('db_eng_mysql', TRUE);
		$this->db_wh = $this->load->database('warehouse', TRUE);
 	}


 	public function we_fitup_list($where = null){
				
		if(isset($where)){
    	$this->db->where($where);
    }

		$this->db->select('
			MAX(rfi_id_no) as rfi_id_no,
			MAX(report_no) as report_no,
			MAX(drawing_no) as drawing_no,
			MAX(description) as description,
			MAX(module) as module,
			MAX(request_by) as request_by,
			MAX(request_date) as request_date,
			MAX(last_updated_by) as last_updated_by,
			MAX(last_updated_date) as last_updated_date,
			');
    $this->db->from('welding_fitup');        
    $this->db->group_by('rfi_id_no,report_no');
		return $this->db->get()->result_array();

	}

	public function delete_we_fitup($id){
	    $this->db->where('id_fitup_we', $id);
	    $this->db->delete('welding_fitup');
	}

	public function we_fitup_detail($where = null){
				
		if(isset($where)){
    	$this->db->where($where);
    }

		$this->db->select('*');
    $this->db->from('welding_fitup');  
		return $this->db->get()->result_array();

	}

	function update_title_fitup_data($where,$data){       
		$this->db->where($where);
    $this->db->update('welding_fitup', $data);
  }

	function insert_fitup_detail_db($data){
		$this->db->insert("welding_fitup", $data);
		return $this->db->insert_id();
  }

  	public function we_visual_list($where = null){
				
		if(isset($where)){
    	$this->db->where($where);
    }

		$this->db->select('
			MAX(rfi_id_no) as rfi_id_no,
			MAX(report_no) as report_no,
			MAX(drawing_no) as drawing_no,
			MAX(description) as description,
			MAX(module) as module,
			MAX(request_by) as request_by,
			MAX(request_date) as request_date,
			MAX(last_updated_by) as last_updated_by,
			MAX(last_updated_date) as last_updated_date,
			');
    $this->db->from('welding_visual');        
    $this->db->group_by('rfi_id_no,report_no');
		return $this->db->get()->result_array();

	}

	public function delete_we_visual($id){
	    $this->db->where('id_visual_we', $id);
	    $this->db->delete('welding_visual');
	}

	public function we_visual_detail($where = null){
				
		if(isset($where)){
    	$this->db->where($where);
    }

		$this->db->order_by('id_visual_we', 'ASC');
		$this->db->select('*');
    $this->db->from('welding_visual');  
		return $this->db->get()->result_array();

	}

	function update_title_visual_data($where,$data){       
		$this->db->where($where);
    $this->db->update('welding_visual', $data);
  }

	function insert_visual_detail_db($data){
		$this->db->insert("welding_visual", $data);
		return $this->db->insert_id();
  }



	function get_all_fitter_v2(){
    $this->db->where('ved >',date("Y-m-d"));
    $this->db->from('pcms_fitter');
    return $this->db->get()->result();    
  }

  function get_all_welder_v2(){
    $this->db->where('ved >',date("Y-m-d"));
    $this->db->from('pcms_welder');
    return $this->db->get()->result();    
  }

   function check_wps_code($where){
        $query = $this->db->where($where);
        $query = $this->db->get('master_wps');
        return $query->result_array();
    }

    public function wps_code($where = null) {
	   	if(isset($where)){
		  $query = $this->db->where($where);
		  $query = $this->db->limit("10");
		}	
		$query = $this->db->where("status_wps","1");
		$query = $this->db->order_by("wps_no","asc");
		$query = $this->db->get('master_wps');
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

}
/*
	End Model Auth_mod
*/