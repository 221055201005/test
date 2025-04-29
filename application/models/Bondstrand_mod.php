<?php 

  Class Bondstrand_mod extends CI_Model {

    public function __construct()
    {
      
    }

    public function bondstrand_list($where = null, $order_by = null) {

      if(isset($where)) {
        $this->db->where($where);
      }

      if(isset($order_by)) {
        $this->db->order_by($order_by);
      }

      $this->db->from('pcms_bondstrand');
      $query = $this->db->get(); 
      return $query->result_array();
    }

    public function update_bondstrand($form_data, $where) {
      $this->db->where($where);

      $this->db->update('pcms_bondstrand', $form_data);
    }

    var $column_order_inspection_list   = array('project','id_workpack','submission_id','drawing_no','discipline','module','type_of_module','deck_elevation','pcms_workpack.company_id');
    var $column_search_inspection_list  = array('workpack_no','drawing_no','submission_id');
    var $order_inspection_list          = array('submission_id' => 'DESC');

    public function serverside_inspection_list($where = null)
    {
        $this->_serverside_inspection_list($where);
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_serverside_inspection_list_all($where = null)
    {
        $this->_query_serverside_inspection_list($where);
        return $this->db->count_all_results();
    }


    public function count_serverside_inspection_list_filtered($where = null)
    {
        $this->_serverside_inspection_list($where);
        $query = $this->db->get();
        return $query->num_rows();
    }


    private function _serverside_inspection_list($where = null)
    {
        $this->_query_serverside_inspection_list($where);
        $i = 0;
        foreach ($this->column_search_inspection_list as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
                } else {
                    $this->db->or_like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
                }
                if (count($this->column_search_inspection_list) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_inspection_list[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_inspection_list)) {
            $order = $this->order_inspection_list;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    private function _query_serverside_inspection_list($where = null){

      if(isset($where)) {
        $this->db->where($where);
      }

      $this->db->select("
      MAX(project) AS project, 
      MAX(drawing_no) AS drawing_no, 
      MAX(workpack_no) AS workpack_no, 
      submission_id, 
      MAX(pcms_workpack.company_id) AS company_id, 
      MAX(discipline) AS discipline, 
      MAX(deck_elevation) AS deck_elevation, 
      MAX(module) AS module, 
      MAX(type_of_module) AS type_of_module, 
      MAX(submit_by) AS submit_by ,
      MAX(submit_date) AS submit_date,
      MIN(status_inspection) AS status_inspection, 
      MAX(resubmit_from_id) AS resubmit_from_id, 
      MAX(revision_status_inspection) AS revision_status_inspection,      
      COUNT(id_baa) AS total_baa,

      COUNT(CASE WHEN status_inspection IN (3,5,6,7,9,10,11) THEN 1 END) AS total_approved,
      COUNT(CASE WHEN status_inspection = 4 THEN 1 END) AS total_pending_qc,
      COUNT(CASE WHEN status_inspection = 2 THEN 1 END) AS total_rejected,
      COUNT(CASE WHEN status_inspection = 1 THEN 1 END) AS pending_approval

      ");

      $this->db->from('pcms_bondstrand');
      $this->db->join('(SELECT id, workpack_id, status_internal FROM pcms_joint) pcms_joint','pcms_joint.id = pcms_bondstrand.id_joint');
      $this->db->join('(SELECT id, workpack_no, company_id, deck_elevation FROM pcms_workpack) pcms_workpack','pcms_workpack.id = pcms_bondstrand.id_workpack');

      $this->db->group_by('project, workpack_no, submission_id, id_workpack, drawing_no, discipline, module, type_of_module, deck_elevation, pcms_workpack.company_id, submit_by, submit_date');
    }

    public function bonder_list($where = null, $order_by = null) {
      if(isset($where)) {
        $this->db->where($where);
      }

      if(isset($order_by)) {
        $this->db->order_by($order_by);
      }

      $this->db->from('master_bonder');
      $query = $this->db->get(); 
      return $query->result_array();
    }

    public function group_report_numb($where = null){
      
      if(isset($where)) {
        $this->db->where($where);
      }
      $this->db->select('
      project, 
      report_number, 
      
      drawing_no, 
      discipline, 
      module, 
      type_of_module, 
      MAX(transmittal_by) AS transmittal_by, 
      company, 
      MAX(revision_status_inspection) AS revision_status_inspection, 
      MAX(transmittal_datetime) AS transmittal_datetime, 
      MAX(status_inspection) AS status_inspection,
      max(inspection_by)  as inspection_by, 
      max(inspection_date)  as inspection_date, 
      MAX(thirdparty_inspection_status) AS thirdparty_inspection_status,
      ');
      $this->db->from('pcms_bondstrand');
      $this->db->group_by('project, 
      report_number, 
      drawing_no, 
      discipline, 
      module, 
      type_of_module, company'); 
      $query = $this->db->get();

      return $query->result_array();
    }

    public function check_data_piecemark_btr($module = null, $drawing_no = null, $project_id = null, $discipline = null, $type_of_module = null, $workpack_no = null, $status_submission = null, $status_inspection = null, $drawing_type = null, $submission_id = null, $company_id = null, $where = null){

      if(isset($where)) {
        $this->db->where($where);
      }
     
      $this->db->select('*, pcms_piecemark.id AS id, pcms_bondstrand.area AS area, pcms_workpack.company_id AS company_id');
      $this->db->from('pcms_piecemark');
      $this->db->join('(SELECT id_baa, submission_id, status_delete, id_piecemark, status_inspection, report_number, inspection_by, inspection_datetime, area, company_id, surveyor_creator, surveyor_created_date, id_workpack, inspection_remarks, area, location FROM pcms_bondstrand WHERE status_delete = 0) pcms_bondstrand','pcms_bondstrand.id_piecemark = pcms_piecemark.id', 'LEFT');
      $this->db->join('(SELECT workpack_no, id, company_id FROM pcms_workpack) pcms_workpack','pcms_bondstrand.id_workpack = pcms_workpack.id');
      
      if($drawing_no){
        if($drawing_type == '1'){
        } else if($drawing_type == '2'){
        } else {
        }        
      } else {
        if(!$status_submission) {
          $this->db->where_in('status_inspection',[0,2,4]);
          $this->db->where('pcms_bondstrand.status_delete',0);
        }
      }
  
      $this->db->where('pcms_bondstrand.id_piecemark IS NOT NULL', NULL);
  
      if($project_id) {
        $this->db->where('project', $project_id);
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
  
      if($workpack_no) {
        $this->db->where('pcms_workpack.workpack_no', $workpack_no);
      }
  
      if($submission_id) {
        $this->db->where_in('submission_id', $submission_id);
      }
  
      if($status_submission) {
        if($status_submission == "ready") {
          $this->db->where('status_inspection', 0);
        } elseif($status_submission == "submited") {
          $this->db->where('status_inspection', 1);
        } elseif($status_submission == "approved" || $status_submission == "ready_transmit") {
          $this->db->where('status_inspection', 3);
        } elseif($status_submission == "rejected") {
          $this->db->where('status_inspection', 2);
        } elseif($status_submission == "pending_by_qc") {
          $this->db->where('status_inspection', 4);
        } elseif($status_submission == "transmitted") {
          $this->db->where('status_inspection', 5);
        } elseif($status_submission == "reject_client") {
          $this->db->where('status_inspection', 6);
        } elseif($status_submission == "postponed") {
          $this->db->where('status_inspection', 10);
        } elseif($status_submission == "reoffer") {
          $this->db->where('status_inspection', 11);
        } else {
          // $this->db->where_in('status_inspection',[0,1, 3, 6]);
        }
      } 
  
      //filter company
			if(!isset($company_id)){
        if(!in_array($this->user_cookie[11], [1, 14])){
					$this->db->where('pcms_workpack.company_id IN ('.join(', ', $this->user_cookie[14]).')', NULL);
        }
      } else {
        $this->db->where('pcms_workpack.company_id', $company_id);
      }
      
     
      $this->db->order_by('workpack_no, drawing_ga, drawing_as DESC');
      $query = $this->db->get(); 
      return $query->result_array();
    }

    public function last_report_no($where) {
      $this->db->where($where);
      $this->db->select('report_number');
      $this->db->from('pcms_bondstrand');
      $this->db->join('(select id, company_id FROM pcms_workpack) wp','wp.id = pcms_bondstrand.id_workpack','LEFT');
      $this->db->order_by('report_number DESC');
      $this->db->where('report_number IS NOT NULL');
      $this->db->limit(1);
      $query = $this->db->get(); 
      $query = $query->row_array();
      if($query) {
        
        $report_number = str_pad($query['report_number'] + 1, 6, '0', STR_PAD_LEFT);
      } else {
        $report_number = '000001';
      }
      return $report_number;
    }

    public function check_report_exist($where) {
      $this->db->where($where);
      $this->db->select('report_number');
      $this->db->from('pcms_bondstrand');
      $this->db->join('(select id, company_id FROM pcms_workpack) wp','wp.id = pcms_bondstrand.id_workpack','LEFT');
      $this->db->order_by('report_number DESC');
      $this->db->where('report_number IS NOT NULL');
      $query = $this->db->get(); 
      return $query->result_array();
    }


    function get_btr($where = null, $limit = null){
      if(isset($where)){
        $this->db->where($where);
      }
      if(isset($limit)){
        $this->db->limit($limit);
      }
      $query = $this->db->get('pcms_bondstrand');
      return $query->result_array();
    }
    var $column_order_request_for_update    = array('project', 'drawing_no','revise.submission_id', 'discipline', 'module', 'type_of_module', 'request_by', 'request_date', 'request_reason', 'last_inspect_by', 'approve_by', 'approve_date', 'update_by', 'update_date', 're_approval_by', 're_approval_date', 'status_revise');
  var $column_search_request_for_update   = array('project', 'drawing_no','revise.submission_id', 'discipline', 'module', 'type_of_module', 'request_by', 'request_date', 'request_reason', 'last_inspect_by', 'approve_by', 'approve_date', 'update_by', 'update_date', 're_approval_by', 're_approval_date', 'status_revise');
  var $order_request_for_update           = array('revise.submission_id' => 'DESC');
public function serverside_request_for_update($status_revise)
{
    $this->_serverside_request_for_update($status_revise);
    if ($_POST['length'] != -1) {
        $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result_array();
}

public function count_serverside_request_for_update_all($status_revise)
{
    $this->_query_serverside_request_for_update($status_revise);
    return $this->db->count_all_results();
}


public function count_serverside_request_for_update_filtered($status_revise)
{
    $this->_serverside_request_for_update($status_revise);
    $query = $this->db->get();
    return $query->num_rows();
}


private function _serverside_request_for_update($status_revise)
{
    $this->_query_serverside_request_for_update($status_revise);
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

private function _query_serverside_request_for_update($status_revise){
  $this->db->select('revise.id, revise.submission_id, project, drawing_no, discipline, module, type_of_module, request_by, request_date, request_reason, last_inspect_by, approve_by, approve_date, update_by, update_date, re_approval_by, re_approval_date, status_revise');
  $this->db->from('pcms_revise_history revise');
  $this->db->join('pcms_bondstrand','revise.submission_id = pcms_bondstrand.submission_id');
  $this->db->where('fabrication_type', 15);
  $this->db->where('status_revise', $status_revise);
  
  $this->db->group_by('revise.id, revise.submission_id, project, drawing_no, discipline, module, type_of_module, request_by, request_date, request_reason, last_inspect_by, approve_by, approve_date, update_by, update_date, re_approval_by, re_approval_date, status_revise');
  $this->db->order_by('revise.id DESC');
}



  }

?>