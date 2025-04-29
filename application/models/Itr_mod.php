<?php 

class Itr_mod extends CI_Model {

  public function __construct(){
    parent::__construct();
    $this->db_wh      = $this->load->database('warehouse', TRUE);
    $this->db_portal  = $this->load->database('db_portal', TRUE);
    $this->db_eng     = $this->load->database('db_eng_mysql', TRUE);
  }

  public function itr_list($where = null, $order_by = null) {
    if(isset($where)) {
      $this->db->where($where);
    }

    if(isset($order_by)) {
      $this->db->order_by($order_by);
    }

    $this->db->from('pcms_itr');
    $query = $this->db->get(); 
    return $query->result_array();
  }

  public function insert_itr($form_data) {
    $this->db->insert('pcms_itr', $form_data);
  }

  public function update_itr($form_data, $where = null) {
    if(isset($where)) {
      $this->db->where($where);
      $this->db->update('pcms_itr', $form_data);
    }
  }

  public function detail_inspection_rfi($where = null) {
    if(isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('*, pcms_itr.area AS area, pcms_itr.status_delete AS status_delete_mv, pcms_itr.remarks AS remarks, pcms_workpack.company_id AS company_id');
    $this->db->from('pcms_itr');
    $this->db->join('pcms_piecemark','pcms_piecemark.id = pcms_itr.id_piecemark');
    $this->db->join('(SELECT id, workpack_no, company_id FROM pcms_workpack) pcms_workpack','pcms_workpack.id = pcms_itr.id_workpack');
    $this->db->order_by('id_itr ASC');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function detail_mis($id_mis){
    $this->db->select("*");
    $this->db_wh->from('pcms_wm_mis mis');
    $this->db_wh->join('(SELECT MAX(uniq_data) AS uniq_data, status_piping AS status_piping, id_mis_det, unique_no FROM pcms_wm_mis_detail GROUP BY uniq_data, unique_no, id_mis_det, status_piping ) detail','mis.uniq_data = detail.uniq_data');
    $this->db_wh->join('(SELECT MAX(mrir_id) AS mrir_id, unique_ident_no, mill_cert_no, catalog_id, heat_or_series_no, partial_report_no FROM qcs_material GROUP BY unique_ident_no, mill_cert_no, catalog_id, heat_or_series_no, mrir_id, partial_report_no) qcs_material','qcs_material.unique_ident_no = detail.unique_no');
    $this->db_wh->join('(SELECT report_no, id FROM qcs_mrir GROUP BY id, report_no) qcs_mrir','qcs_mrir.id = qcs_material.mrir_id');
    $this->db_wh->join('pcms_wm_material_catalog material', 'material.id = qcs_material.catalog_id');
    $this->db_wh->join('pcms_wm_catalog_category category', 'category.id = material.catalog_category_id');
    $this->db_wh->where_in('detail.id_mis_det', $id_mis);
    $query = $this->db_wh->get(); 
    return $query->result_array();
  }


  // INSPECTION LIST SERVERSIDE

  var $column_order_inspection_list   = array('project_code','id_workpack','submission_id','drawing_no','discipline','module','type_of_module','deck_elevation','pcms_workpack.company_id');
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
    MAX(project_code) AS project_code, 
    MAX(drawing_no) AS drawing_no, 
    MAX(workpack_no) AS workpack_no, 
    submission_id, 
    MAX(pcms_workpack.company_id) AS company_id, 
    MAX(discipline) AS discipline, 
    MAX(deck_elevation) AS deck_elevation, 
    MAX(module) AS module, 
    MAX(type_of_module) AS type_of_module, 
    MAX(requestor) AS requestor ,
    MAX(date_request) AS date_request,
    MIN(status_inspection) AS status_inspection, 
    MAX(resubmit_from_id) AS resubmit_from_id, 
    MAX(revision_status_inspection) AS revision_status_inspection,      
    COUNT(id_itr) AS total_itr,

    COUNT(CASE WHEN status_inspection IN (3,5,6,7,9,10,11) THEN 1 END) AS total_approved,
    COUNT(CASE WHEN status_inspection = 4 THEN 1 END) AS total_pending_qc,
    COUNT(CASE WHEN status_inspection = 2 THEN 1 END) AS total_rejected,
    COUNT(CASE WHEN status_inspection = 1 THEN 1 END) AS pending_approval

    ");

    $this->db->from('pcms_itr');
    $this->db->join('(SELECT id, workpack_id, status_internal FROM pcms_piecemark) pcms_piecemark','pcms_piecemark.id = pcms_itr.id_piecemark');
    $this->db->join('(SELECT id, workpack_no, company_id, deck_elevation FROM pcms_workpack) pcms_workpack','pcms_workpack.id = pcms_itr.id_workpack');

    $this->db->where('status_inspection != 0');
    $this->db->where('requested_for_update', 0);
    $this->db->group_by('project_code, workpack_no, id_workpack, submission_id, drawing_no, discipline, module, type_of_module, deck_elevation, pcms_workpack.company_id, requestor, date_request');
  }

  // Client Serverside
  var $column_order_itr_summary    = array('project_code','report_number','drawing_no','discipline','module','type_of_module','deck_elevation','company_id','inspection_by','inspection_datetime','status_inspection','report_no');
  var $column_search_itr_summary  = array('drawing_no','report_number');
  var $order_itr_summary          = array('report_number' => 'DESC');
  public function serverside_itr_summary($where = null)
  {
      $this->_serverside_itr_summary($where);
      if ($_POST['length'] != -1) {
          $this->db->limit($_POST['length'], $_POST['start']);
      }
      $query = $this->db->get();
      return $query->result_array();
  }

  public function count_serverside_itr_summary_all($where = null)
  {
      $this->_query_serverside_itr_summary($where);
      return $this->db->count_all_results();
  }


  public function count_serverside_itr_summary_filtered($where = null)
  {
      $this->_serverside_itr_summary($where);
      $query = $this->db->get();
      return $query->num_rows();
  }


  private function _serverside_itr_summary($where = null)
  {
      $this->_query_serverside_itr_summary($where);
      $i = 0;
      foreach ($this->column_search_itr_summary as $item) {
          if ($_POST['search']['value']) {
              if ($i === 0) {
                  $this->db->group_start();
                  $this->db->like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
              } else {
                  $this->db->or_like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
              }
              if (count($this->column_search_itr_summary) - 1 == $i) {
                  $this->db->group_end();
              }
          }
          $i++;
      }
      if (isset($_POST['order'])) {
          $this->db->order_by($this->column_order_itr_summary[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
      } else if (isset($this->order_itr_summary)) {
          $order = $this->order_itr_summary;
          $this->db->order_by(key($order), $order[key($order)]);
      }
  }

  private function _query_serverside_itr_summary($where = null){
    $this->db->select("
    max(submission_id) as submission_id,
    project_code, 
    report_number, 
    drawing_no, 
    project_code, 
    discipline, 
    module, 
    type_of_module, 
    MAX(transmittal_by) AS transmittal_by, 
    MAX(pcms_workpack.company_id) AS company_id, 
    MAX(transmittal_datetime) AS transmittal_datetime, 
    MAX(status_inspection) AS status_inspection,
    max(inspection_by)  as inspection_by, 
    max(inspection_datetime)  as inspection_datetime, 
    max(deck_elevation) AS deck_elevation,
    transmittal_uniqid
    ");
    $this->db->from('pcms_itr');
    $this->db->join('(SELECT id, deck_elevation, company_id FROM pcms_workpack) pcms_workpack','pcms_workpack.id = pcms_itr.id_workpack');
    if(isset($where)) {
      $this->db->where($where);
    }
    
    $this->db->group_by('project_code, report_number, drawing_no, discipline, module, type_of_module, deck_elevation,  pcms_workpack.company_id, transmittal_uniqid');
  }

  function get_itr($where = null, $limit = null){
    if(isset($where)){
      $this->db->where($where);
    }
    if(isset($limit)){
      $this->db->limit($limit);
    }
    $query = $this->db->get('pcms_itr');
    return $query->result_array();
  }

  public function proceed_approval_inspection($form_data, $where){
    $this->db->where($where);
    $this->db->update('pcms_itr', $form_data);
  }

  public function update_ndt_itr($form_data, $where){
    $this->db->where($where);
    $this->db->update('pcms_itr_ndt', $form_data);
  }

  var $column_order_transmittal  = array('itr.id_itr','itr.project_code','workpack.workpack_no','itr.submission_id','itr.drawing_no','pc.drawing_as','pc.drawing_sp','pc.rev_sp','workpack.company_id','itr.discipline','itr.module','itr.type_of_module','pc.part_id','itr.id_mis','itr.wps_id','itr.cons_lot_no','itr.welder_id','itr.inspection_by','itr.inspection_datetime','itr.area_v2','itr.location_v2','itr.point_v2','itr.inspection_remarks','itr.status_inspection','itr.id_itr');
   var $column_search_transmittal = array('itr.id_itr','itr.project_code','workpack.workpack_no','itr.submission_id','itr.drawing_no','pc.drawing_as','pc.drawing_sp','pc.rev_sp','workpack.company_id','itr.discipline','itr.module','itr.type_of_module','pc.part_id','itr.id_mis','itr.wps_id','itr.cons_lot_no','itr.welder_id','itr.inspection_by','itr.inspection_datetime','itr.area_v2','itr.location_v2','itr.point_v2','itr.inspection_remarks','itr.status_inspection','itr.id_itr');
   var $order_transmittal         = array('itr.id_itr' => 'DESC');
   
   public function serverside_transmittal_list($where = null)
   {
       $this->_serverside_transmittal_list($where);
       if ($_POST['length'] != -1) {
           $this->db->limit($_POST['length'], $_POST['start']);
       }
       $query = $this->db->get();
       return $query->result_array();
   }

   public function count_serverside_transmittal_list_all($where = null)
   {
       $this->_query_serverside_transmittal_list($where);
       return $this->db->count_all_results();
   }


   public function count_serverside_transmittal_list_filtered($where = null)
   {
       $this->_serverside_transmittal_list($where);
       $query = $this->db->get();
       return $query->num_rows();
   }

  private function _serverside_transmittal_list($where = null){
     $this->_query_serverside_transmittal_list($where);
     $i = 0;
     foreach ($this->column_search_transmittal as $item) {
         if ($_POST['search']['value']) {
             if ($i === 0) {
                 $this->db->group_start();
                 $this->db->like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
             } else {
                 $this->db->or_like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
             }
             if (count($this->column_search_transmittal) - 1 == $i) {
                 $this->db->group_end();
             }
         }
         $i++;
     }
     if (isset($_POST['order'])) {
         $this->db->order_by($this->column_order_transmittal[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
     } else if (isset($this->order_transmittal)) {
         $order = $this->order_transmittal;
         $this->db->order_by('submission_id DESC, itr.drawing_no, pc.drawing_as, pc.drawing_sp');
     }
   }

  private function _query_serverside_transmittal_list($where = null){

    if(isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('
      *,
      itr.project_code AS project_code,
      itr.discipline AS discipline,
      itr.module AS module,
      itr.type_of_module AS Type_of_module,
      itr.drawing_no AS drawing_no,
      itr.area_v2 AS area_v2,
      itr.location_v2 AS location_v2,
      itr.point_v2 AS point_v2,
      workpack.company_id AS company_id
    ');
    $this->db->from('pcms_itr itr');
    $this->db->join('pcms_workpack workpack','itr.id_workpack = workpack.id');
    $this->db->join('pcms_piecemark pc','pc.id = itr.id_piecemark');
      
  }

  public function list_approved_submission_number($where = null) {
    if(isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('submission_id');
    $this->db->from('pcms_itr');
    $this->db->where_in('status_inspection', [3,6]);
    $this->db->group_by('submission_id');
    $query = $this->db->get(); 
    return $query->result_array();
  }

  public function check_data_piecemark($module = null, $drawing_no = null, $project_id = null, $discipline = null, $type_of_module = null, $workpack_no = null, $status_submission = null, $status_inspection = null, $drawing_type = null, $submission_id = null, $company_id = null, $where = null){

    if(isset($where)) {
      $this->db->where($where);
    }
   
    $this->db->select('*, pcms_piecemark.id AS id, itr.area AS area, pcms_workpack.company_id AS company_id');
    $this->db->from('pcms_piecemark');

    
    $this->db->join('(SELECT id_itr, submission_id, rejected_client_remarks, status_delete, rejected_remarks, pending_qc_remarks, id_piecemark, id_mis, status_inspection, report_number, inspection_by, inspection_datetime, area, company_id, requestor, ga_rev_no, as_rev_no, sp_rev_no, date_request, surveyor_creator, surveyor_created_date, id_workpack, inspection_remarks, area_v2, location_v2, point_v2 FROM pcms_itr WHERE status_delete = 0) itr','itr.id_piecemark = pcms_piecemark.id', 'LEFT');

    $this->db->join('(SELECT workpack_no, id, company_id FROM pcms_workpack) pcms_workpack','itr.id_workpack = pcms_workpack.id');
    
    if($drawing_no){
      if($drawing_type == '1'){
        // $this->db->where('drawing_ga', $drawing_no);
      } else if($drawing_type == '2'){
        // $this->db->where('drawing_as', $drawing_no);
      } else {
        // $this->db->where('drawing_ga', $drawing_no);
      }        
    } else {
      if(!$status_submission) {
        //$this->db->where('status_inspection', "0");
        $this->db->where_in('status_inspection',[0,2,4]);
        $this->db->where('itr.status_delete',0);
      }
    }

    $this->db->where('itr.id_piecemark IS NOT NULL', NULL);

    if($project_id) {
      $this->db->where('project', $project_id);
    } else {

      if(!$this->is_admin) {
        $this->db->where_in('project', $this->project_alt);
      }

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
    // if(!isset($company_id)){
    //   if(!in_array($this->user_cookie[11], [1, 14])){
    //     $this->db->where('pcms_workpack.company_id', $this->user_cookie[11]);
    //     //$this->db->where('material.company_id', $this->user_cookie[11]);
    //   }
    // } else {
    //   $this->db->where('pcms_workpack.company_id', $company_id);
    // }

    if($company_id) {
      $this->db->where('pcms_workpack.company_id', $this->project_alt);
    } else {
      if(!$this->is_admin) {
        $this->db->where_in('pcms_workpack.company_id', $this->project_alt);
      }
    }
    
   
    $this->db->order_by('workpack_no, drawing_ga, drawing_as DESC');
    $query = $this->db->get(); 
    return $query->result_array();
  }

  public function last_report_no($where) {
    $this->db->where($where);
    $this->db->select('report_number');
    $this->db->from('pcms_itr');
    $this->db->join('(select id, company_id FROM pcms_workpack) wp','wp.id = pcms_itr.id_workpack','LEFT');
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

  public function find_itr_data($where = null, $start_date = null, $end_date = null, $order_by = null) {
     if(isset($where)) {
       $this->db->where($where);
     }

     if(isset($order_by)) {
      $this->db->order_by($order_by);
    }

     if($end_date) {
       $this->db->where("date_request BETWEEN '$start_date' AND '$end_date'");
     }

     //$this->db->limit('1000');

     $this->db->select('*, pcms_itr.area AS area, pcms_piecemark.area AS area_size, pcms_itr.report_number AS report_number, pcms_workpack.company_id AS company_id, pcms_itr.remarks AS remarks');
     $this->db->from('pcms_itr');
     $this->db->join('pcms_piecemark','pcms_piecemark.id = pcms_itr.id_piecemark');
     $this->db->join('(SELECT id, workpack_no, company_id, status AS status_workpack FROM pcms_workpack) pcms_workpack','pcms_workpack.id = pcms_itr.id_workpack');
     $this->db->join('(SELECT id_piecemark as id_piecemark_irn, report_number as irn_report_no FROM pcms_irn) pcms_irn','pcms_itr.id_piecemark = pcms_irn.id_piecemark_irn','left');

     $query = $this->db->get(); 
     return $query->result_array();

  }

  public function last_rev_report_no($where = null) {
    if(isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('MAX(report_no_rev) AS report_no_rev');
    $this->db->from('pcms_itr');
    $this->db->order_by('report_no_rev DESC');
    $this->db->limit(1);

    $query = $this->db->get(); 
    return $query->result_array();
  }

  public function submit_itr($form_data) {
    $this->db->insert('pcms_itr', $form_data);
  }

  var $column_order_request_for_update    = array('project_code', 'drawing_no','revise.submission_id', 'discipline', 'module', 'type_of_module', 'request_by', 'request_date', 'request_reason', 'last_inspect_by', 'approve_by', 'approve_date', 'update_by', 'update_date', 're_approval_by', 're_approval_date', 'status_revise');
  var $column_search_request_for_update   = array('project_code', 'drawing_no','revise.submission_id', 'discipline', 'module', 'type_of_module', 'request_by', 'request_date', 'request_reason', 'last_inspect_by', 'approve_by', 'approve_date', 'update_by', 'update_date', 're_approval_by', 're_approval_date', 'status_revise');
  var $order_request_for_update           = array('revise.submission_id' => 'DESC');
public function serverside_request_for_update($where = null)
{
    $this->_serverside_request_for_update($where);
    if ($_POST['length'] != -1) {
        $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result_array();
}

public function count_serverside_request_for_update_all($where = null)
{
    $this->_query_serverside_request_for_update($where);
    return $this->db->count_all_results();
}


public function count_serverside_request_for_update_filtered($where = null)
{
    $this->_serverside_request_for_update($where);
    $query = $this->db->get();
    return $query->num_rows();
}


private function _serverside_request_for_update($where = null)
{
    $this->_query_serverside_request_for_update($where);
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

private function _query_serverside_request_for_update($where = null){
  $this->db->select('revise.id, revise.submission_id, project_code, drawing_no, discipline, module, type_of_module, request_by, request_date, request_reason, last_inspect_by, approve_by, approve_date, update_by, update_date, re_approval_by, re_approval_date, status_revise');
  $this->db->from('pcms_revise_history revise');
  $this->db->join('pcms_itr','revise.submission_id = pcms_itr.submission_id');
  $this->db->join('(SELECT id AS id_wp, company_id FROM pcms_workpack) wp','wp.id_wp = pcms_itr.id_workpack');
  $this->db->where('fabrication_type', 13);

  if(isset($where)) {
    $this->db->where($where);
  }

  $this->db->group_by('revise.id, revise.submission_id, project_code, drawing_no, discipline, module, type_of_module, request_by, request_date, request_reason, last_inspect_by, approve_by, approve_date, update_by, update_date, re_approval_by, re_approval_date, status_revise');
  $this->db->order_by('revise.id DESC');
}

public function update_request_for_update($form_data, $where) {
  if(isset($where)) {
    $this->db->where($where);
  }
  $this->db->update('pcms_revise_history', $form_data);
}

public function data_revise_history($where = null) {
  if(isset($where)) {
    $this->db->where($where);
  }

  $this->db->from('pcms_revise_history');
  $query = $this->db->get(); 
  return $query->result_array();
}

public function ndt_itr_list($where = null) {
  if(isset($where)) {
    $this->db->where($where);
  }
  $this->db->order_by('ndt_rfi_no', 'DESC');
  $this->db->from('pcms_itr_ndt'); 
  $query = $this->db->get(); 
  return $query->result_array();
}

public function ndt_itr_list_v2($where = null) {
  if(isset($where)) {
    $this->db->where($where);
  }
  $this->db->order_by('ndt_rfi_no', 'DESC');
  $this->db->from('pcms_itr_ndt'); 
  $this->db->join('pcms_itr','pcms_itr.transmittal_uniqid = pcms_itr_ndt.transmittal_uniqid');
  $query = $this->db->get(); 
  return $query->result_array();
}

public function insert_itr_ndt($form_data) {
  $this->db->insert('pcms_itr_ndt', $form_data);
}

var $column_order_itr_ndt    = array('project_code','report_number','ndt_rfi_no','ndt_type','vendor_id','drawing_no','itr.discipline','itr.module','itr.type_of_module','deck_elevation','total_attachment','itr_ndt.created_by','itr_ndt.created_date','ndt_rfi_no');
  var $column_search_itr_ndt   = array('project_code','report_number','ndt_rfi_no','ndt_type','vendor_id','drawing_no','itr.discipline','itr.module','itr.type_of_module','deck_elevation','total_attachment','itr_ndt.created_by','itr_ndt.created_date','ndt_rfi_no');
  var $order_itr_ndt           = array('itr_ndt.ndt_rfi_no' => 'DESC');
public function serverside_itr_ndt($where = null)
{
    $this->_serverside_itr_ndt($where);
    if ($_POST['length'] != -1) {
        $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result_array();
}

public function count_serverside_itr_ndt_all($where = null)
{
    $this->_query_serverside_itr_ndt($where);
    return $this->db->count_all_results();
}


public function count_serverside_itr_ndt_filtered($where = null)
{
    $this->_serverside_itr_ndt($where);
    $query = $this->db->get();
    return $query->num_rows();
}


private function _serverside_itr_ndt($where = null)
{
    $this->_query_serverside_itr_ndt($where);
    $i = 0;
    foreach ($this->column_search_itr_ndt as $item) {
        if ($_POST['search']['value']) {
            if ($i === 0) {
                $this->db->group_start();
                $this->db->like(('CAST ('.$item.' AS VARCHAR)'), $_POST['search']['value']);
            } else {
                $this->db->or_like(('CAST ('.$item.' AS VARCHAR)'), $_POST['search']['value']);
            }
            if (count($this->column_search_itr_ndt) - 1 == $i) {
                $this->db->group_end();
            }
        }
        $i++;
    }
    if (isset($_POST['order'])) {
        $this->db->order_by($this->column_order_itr_ndt[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($this->order_itr_ndt)) {
        $order = $this->order_itr_ndt;
        $this->db->order_by(key($order), $order[key($order)]);
    }
}

private function _query_serverside_itr_ndt($where = null){
  if(isset($where)) {
    $this->db->where($where);
  }

  $this->db->select('
  MAX(itr_ndt.id) AS id,
  project_code,
  drawing_no,
  report_number,
  ndt_rfi_no,
  ndt_type,
  vendor_id,
  discipline,
  module,
  att.total_attachment,
  type_of_module,
  deck_elevation,
  inspection_by,
  MAX(inspection_datetime) AS inspection_datetime,
  itr_ndt.created_by,
  itr_ndt.created_date
  ');
  $this->db->from('pcms_itr_ndt itr_ndt');
  $this->db->join('pcms_itr itr','itr.transmittal_uniqid = itr_ndt.transmittal_uniqid');
  $this->db->join('(SELECT id, workpack_no, company_id, deck_elevation FROM pcms_workpack) pcms_workpack','pcms_workpack.id = itr.id_workpack');

  $this->db->join('
    ( SELECT
      COUNT(id) AS total_attachment,
      MAX(ndt_itr_id) AS ndt_itr_id,
      ndt_itr_rfi_no
      FROM pcms_ndt_attachment
      WHERE itr_status = 1
      GROUP BY ndt_itr_rfi_no
    ) att
  ','att.ndt_itr_rfi_no = itr_ndt.ndt_rfi_no','LEFT');

  $this->db->group_by('
    project_code,
    drawing_no,
    report_number,
    ndt_rfi_no,
    ndt_type,
    vendor_id,
    discipline,
    module,
    att.total_attachment,
    type_of_module,
    deck_elevation,
    inspection_by,
    itr_ndt.created_by,
    itr_ndt.created_date
  ');
}

    
}

?>