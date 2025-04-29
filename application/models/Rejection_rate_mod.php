<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rejection_rate_mod extends CI_Model {

	public function __construct(){
	  parent::__construct();
		$this->db_eng 		= $this->load->database('db_eng_mysql', TRUE);
		$this->db_eng_mysql = $this->load->database('db_eng_mysql', TRUE);
		$this->db_wh 		= $this->load->database('warehouse', TRUE);
 	}

    public function get_visual_data($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		} 
			  
		$query = $this->db->select('
            a.id_visual,
            d.re_request,
            a.drawing_no,
            a.discipline,
            a.module,
            a.type_of_module,
            a.report_number as visual_report,
            c.joint_no,
            a.length_of_weld,
            a.postpone_reoffer_no,
            d.submission_id, 
            a.length_of_weld,
            d.tested_length,
            d.reject_length_rh,
            d.reject_length_fc,
            a.submission_id,
            a.id_joint,
            e.ndt_initial,
            d.result,
            d.report_number,
            date(a.weld_datetime) as weld_datetime,            
            date(d.date_of_inspection) as date_of_inspection,            
		');
		$query = $this->db->join('pcms_joint c','c.id = a.id_joint',"LEFT");
		$query = $this->db->join('pcms_ndt d','a.id_visual = d.id_visual' );
		$query = $this->db->join('master_ndt_type e','e.id = d.ndt_type',"LEFT");
		$query = $this->db->get('pcms_visual a');
		return $query->result_array();
	}


    public function get_ndt_data($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		} 			  
		$query = $this->db->select('a.id_visual,b.length,a.tested_length,a.reject_length_rh,a.reject_length_fc,a.submission_id,a.date_of_inspection');
		$query = $this->db->join('pcms_ctq_reject b','a.submission_id = b.submission_id',"LEFT");
		$query = $this->db->get('pcms_ndt a');
		return $query->result_array();
	}

	public function get_overall_visual_data_v21($where = null){
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
			a.revision,

			b.project,
			b.drawing_no,
            b.discipline,
            b.module,
            b.type_of_module,
			b.id as id_joint,
			b.deck_elevation,
			b.joint_no,
			b.weld_length,
			b.class, 

			c.tested_date as ut_tested_date,
			c.result as ut_result,
		');  
		 
		$query = $this->db->join('pcms_ndt_ut c','c.id_visual = a.id_visual');  
		$query = $this->db->join('pcms_joint b','b.id = a.id_joint',"LEFT");  
		$query = $this->db->get('pcms_visual a');
		return $query->result_array();
	}

	public function get_visual_data_new_v21($where = null){

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
			a.length_of_weld,
			a.postpone_reoffer_no, 
            a.length_of_weld,  
            a.id_joint,
			date(a.weld_datetime) as weld_datetime,

            e.ndt_initial, 

			c.deck_elevation,
			c.joint_no,
			c.class,  

            d.id_ut as id_ut,
            d.tested_length,
			d.result,
            d.report_no,           
            date(d.tested_date) as tested_date,            
            date(d.transmit_date) as created_date,         
		');
		$query = $this->db->order_by('d.tested_date','ASC');
		$query = $this->db->join('pcms_joint c','c.id = a.id_joint',"LEFT");  
		$query = $this->db->join('pcms_ndt_ut d','a.id_visual = d.id_visual',"LEFT");
		$query = $this->db->join('master_ndt_type e','e.id = d.ndt_type',"LEFT");
		$query = $this->db->get('pcms_visual a');
		return $query->result_array();
	}

	public function get_visual_data_new_v21_bak($where = null){

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
			a.length_of_weld,
			a.postpone_reoffer_no, 
            a.length_of_weld,  
            a.id_joint,
			date(a.weld_datetime) as weld_datetime,

            e.ndt_initial, 

			c.deck_elevation,
			c.joint_no,
			c.class,  

            d.id_ut as id_ut,
            d.tested_length as tested_length_ut,
			d.result as result_ut,
            d.report_no as report_no_ut,           
            date(d.tested_date) as tested_date_ut,            
            date(d.transmit_date) as created_date_ut, 

			f.id_rt as id_rt,
            f.tested_length as tested_length_rt,
			f.result as result_rt,
            f.report_no as report_no_rt,        
            date(f.tested_date) as tested_date_rt,            
            date(f.transmit_date) as created_date_rt             
		');
		$query = $this->db->order_by('d.tested_date,f.tested_date','ASC');
		$query = $this->db->join('pcms_joint c','c.id = a.id_joint',"LEFT");
		$query = $this->db->join('pcms_ndt_rt f','a.id_visual = f.id_visual',"LEFT");
		$query = $this->db->join('pcms_ndt_ut d','a.id_visual = d.id_visual',"LEFT");
		$query = $this->db->join('master_ndt_type e','e.id = d.ndt_type',"LEFT");
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
			b.ndt_type,
			b.rh_fc_type
		');
		$query = $this->db->join('ndt_ut_reject b','a.id = b.ctq_id',"LEFT"); 
		$query = $this->db->join('pcms_joint d','b.id_joint = d.id',"LEFT");
		$query = $this->db->get('master_ctq a');
		return $query->result_array();
	}

	public function get_ndt_data_v21($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		} 			  
		$query = $this->db->select('
		a.id_visual,
		b.length,
		a.tested_length,  
		a.tested_date');
		$query = $this->db->join('pcms_ctq_reject b','a.id_ut = b.ndt_id',"LEFT");
		$query = $this->db->get('pcms_ndt_ut a');
		return $query->result_array();
	}

	public function get_welder_data_visual_v21($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}  
		$query = $this->db->get('pcms_visual_detail_welder');
		return $query->result_array();
	}


 	


}
/*
	End Model Auth_mod
*/