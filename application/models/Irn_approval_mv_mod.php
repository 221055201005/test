<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Irn_approval_mv_mod extends CI_Model {

	public function __construct(){
	 	parent::__construct();
		//$this->db_eng = $this->load->database('db_eng', TRUE);
		$this->db_eng = $this->load->database('db_eng_mysql', TRUE);
		$this->db_portal = $this->load->database('db_portal', TRUE);
		$this->db_wh = $this->load->database('warehouse', TRUE);
		$this->db_punchlist = $this->load->database('db_punchlist', TRUE);
 	}

 	public function irn_mv_datatable_db($cat, $where = NULL){
      $table          = 'pcms_irn';
      $column         = array('id_irn');

      $this->db->from($table);

      if(isset($where)){
        $this->db->where($where);
      }

      if($cat == 'count_all'){
        return $this->db->count_all_results();
      }
      
      $i = 0;
      $_POST['search']['value'] = convert2utf8($_POST['search']['value']);
      
      if (isset($_POST['order'])){
        $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
      }
      else if (isset($column)){
        $this->db->order_by('id_irn', 'DESC');
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

    function update_status_approval($where,$data){       
		$this->db->where($where);
        $this->db->update('pcms_irn', $data);
    }

    function irn_mv_distinct_list($where){       
        $this->db->select('DISTINCT(report_number), project_id, discipline, module, type_of_module');
        $this->db->from('pcms_irn');
        $this->db->where($where);        
        // $this->db->group_by('report_number');
        return $this->db->get()->result_array();
    }


}
/*
	End Model Auth_mod
*/