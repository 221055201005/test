<?php

class Material_verification_mod extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->db_wh = $this->load->database('warehouse', TRUE);
    $this->db_portal = $this->load->database('db_portal', TRUE);
    //$this->db_eng     = $this->load->database('db_eng', TRUE);
    $this->db_eng = $this->load->database('db_eng_mysql', TRUE);
  }

  public function data_mis_material($where = null, $order_by = null, $select = null)
  {
    if (isset($where)) {
      $this->db_wh->where($where);
    }

    if (isset($order_by)) {
      $this->db_wh->order_by($order_by);
    }

    if (isset($select)) {
      $this->db_wh->select($select);
    }

    $this->db_wh->from('pcms_wm_mis mis');
    $this->db_wh->join('pcms_wm_mis_detail detail', 'detail.uniq_data = mis.uniq_data');
    $query = $this->db_wh->get();
    return $query->result_array();
  }

  public function mis_detail($where = null)
  {
    if (isset($where)) {
      $this->db_wh->where($where);
    }
    $this->db_wh->select('*');
    $this->db_wh->from('pcms_wm_mis_detail');

    $query = $this->db_wh->get();
    return $query->result_array();
  }

  public function workpack_detail_list($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    $this->db->select('*');
    $this->db->from('pcms_workpack_detail');

    $query = $this->db->get();
    return $query->result_array();
  }

  public function balance_production_list($where = null)
  {
    if (isset($where)) {
      $this->db_wh->where($where);
    }
    $this->db_wh->select('*');
    $this->db_wh->from('pcms_wm_balance_production');

    $query = $this->db_wh->get();
    return $query->result_array();
  }

  public function piecemark_list($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    $this->db->select('*');
    $this->db->from('pcms_piecemark');

    $query = $this->db->get();
    return $query->result_array();
  }

  public function piecemark_workpack_join($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('*');
    $this->db->from('pcms_piecemark');
    $this->db->join('pcms_workpack_detail', 'pcms_piecemark.id = pcms_workpack_detail.id_template', 'LEFT');

    $query = $this->db->get();
    return $query->result_array();
  }


  public function data_mrir_material($where = null, $order_by = null, $select = null)
  {
    if (isset($where)) {
      $this->db_wh->where($where);
    }

    if (isset($order_by)) {
      $this->db_wh->order_by($order_by);
    }

    if (isset($select)) {
      $this->db_wh->select($select);
    } else {
      $this->db_wh->select('*, material.status AS status');
    }


    $this->db_wh->from('qcs_material material');
    $this->db_wh->join('qcs_mrir mrir', 'mrir.unique_no = material.unique_no');
    $query = $this->db_wh->get();
    return $query->result_array();
  }

  public function qcs_material_wm_mat_bal($where = null)
  {
    if (isset($where)) {
      $this->db_wh->where($where);
    }

    $this->db_wh->select('
        mat_bal.*,
        material.*,
        mat_bal.unique_no AS unique_no
      ');

    $this->db_wh->from('qcs_material material');
    $this->db_wh->join('pcms_wm_mat_bal mat_bal', 'mat_bal.unique_no = material.unique_ident_no');
    $query = $this->db_wh->get();
    return $query->result_array();
  }

  public function data_material_catalog($where = null)
  {
    if (isset($where)) {
      $this->db_wh->where($where);
    }

    $this->db_wh->from('pcms_wm_material_catalog');
    $query = $this->db_wh->get();
    return $query->result_array();
  }
  public function steel_category_list($where = null)
  {
    if (isset($where)) {
      $this->db_wh->where($where);
    }

    $this->db_wh->from('pcms_wm_steel_category');
    $query = $this->db_wh->get();
    return $query->result_array();
  }

  public function data_material_catalog_piping($where = null)
  {
    if (isset($where)) {
      $this->db_wh->where($where);
    }

    $this->db_wh->from('pcms_wm_material_pp');
    $query = $this->db_wh->get();
    return $query->result_array();
  }

  public function data_material_balance($where = null)
  {
    if (isset($where)) {
      $this->db_wh->where($where);
    }

    $this->db_wh->from('pcms_wm_mat_bal');
    $query = $this->db_wh->get();
    return $query->result_array();
  }

  public function catalog_category($where = null)
  {
    if (isset($where)) {
      $this->db_wh->where($where);
    }

    $this->db_wh->from('pcms_wm_catalog_category');
    $query = $this->db_wh->get();
    return $query->result_array();
  }

  public function find_material_verification_data($where = null, $start_date = null, $end_date = null, $order_by = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }

    if (isset($order_by)) {
      $this->db->order_by($order_by);
    }

    if ($end_date) {
      $this->db->where("date_request BETWEEN '$start_date' AND '$end_date'");
    }

    //$this->db->limit('1000');

    $this->db->select('*, pcms_material.area AS area, pcms_piecemark.area AS area_size, pcms_material.report_number AS report_number, pcms_workpack.company_id AS company_id, pcms_material.remarks AS remarks');
    $this->db->from('pcms_material');
    $this->db->join('pcms_piecemark', 'pcms_piecemark.id = pcms_material.id_piecemark');
    $this->db->join('(SELECT id, workpack_no, company_id, status AS status_workpack FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = pcms_material.id_workpack');
    $this->db->join('(SELECT id_piecemark as id_piecemark_irn, report_number as irn_report_no FROM pcms_irn) pcms_irn', 'pcms_material.id_piecemark = pcms_irn.id_piecemark_irn', 'left');

    $query = $this->db->get();
    return $query->result_array();
  }

  public function check_unique_from_mis($where = null)
  {
    if (isset($where)) {
      $this->db_wh->where($where);
    }
    $this->db_wh->from('pcms_wm_mis mis');
    $this->db_wh->join('(SELECT MAX(uniq_data) AS uniq_data, status_piping, id_mis_det, unique_no FROM pcms_wm_mis_detail WHERE status = 3 GROUP BY uniq_data, unique_no, status_piping, id_mis_det ) detail', 'mis.uniq_data = detail.uniq_data');
    $this->db_wh->join('(SELECT MAX(mrir_id) AS mrir_id, unique_ident_no, catalog_id, heat_or_series_no FROM qcs_material GROUP BY unique_ident_no, catalog_id, heat_or_series_no, mrir_id) qcs_material', 'qcs_material.unique_ident_no = detail.unique_no');
    $this->db_wh->join('(SELECT report_no, id FROM qcs_mrir GROUP BY id, report_no) qcs_mrir', 'qcs_mrir.id = qcs_material.mrir_id');
    $this->db_wh->join('pcms_wm_material_catalog material', 'material.id = qcs_material.catalog_id');
    $this->db_wh->join('pcms_wm_catalog_category category', 'category.id = material.catalog_category_id');
    $query = $this->db_wh->get();
    return $query->result_array();
  }

  public function check_data_piecemark($module = null, $drawing_no = null, $project_id = null, $discipline = null, $type_of_module = null, $workpack_no = null, $status_submission = null, $status_inspection = null, $drawing_type = null, $submission_id = null, $company_id = null, $where = null)
  {

    if (isset($where)) {
      $this->db->where($where);
    }

    // $this->db->select('*, pcms_piecemark.id AS id, material.area AS area, pcms_workpack.company_id AS company_id');
    $this->db->select('*, pcms_piecemark.id AS id, material.area AS area, pcms_piecemark.company_id AS company_id');
    $this->db->from('pcms_piecemark');


    $this->db->join('(SELECT id_material, submission_id, rejected_client_remarks, status_delete, rejected_remarks, pending_qc_remarks, id_piecemark, id_mis, id_mis_piping, status_inspection, report_number, inspection_by, inspection_datetime, area, company_id, requestor, ga_rev_no, as_rev_no, sp_rev_no, date_request, surveyor_creator, surveyor_created_date, id_workpack, inspection_remarks, area_v2, location_v2, point_v2 FROM pcms_material WHERE status_delete = 0) material', 'material.id_piecemark = pcms_piecemark.id', 'LEFT');

    $this->db->join('(SELECT workpack_no, id, company_id FROM pcms_workpack) pcms_workpack', 'material.id_workpack = pcms_workpack.id');

    if ($drawing_no) {
      if ($drawing_type == '1') {
        // $this->db->where('drawing_ga', $drawing_no);
      } else if ($drawing_type == '2') {
        // $this->db->where('drawing_as', $drawing_no);
      } else {
        // $this->db->where('drawing_ga', $drawing_no);
      }

      $this->db->where("(drawing_ga = '$drawing_no' OR drawing_as = '$drawing_no')");
    } else {
      if (!$status_submission) {
        //$this->db->where('status_inspection', "0");
        $this->db->where_in('status_inspection', [0, 2, 4]);
        $this->db->where('material.status_delete', 0);
      }
    }

    $this->db->where('material.id_piecemark IS NOT NULL', NULL);

    if ($project_id) {
      if (is_array($project_id)) {

        if (!$this->is_admin) {
          $this->db->where_in('project', $project_id);
        }
      } else {
        $this->db->where('project', $project_id);
      }
    }

    if ($discipline) {
      $this->db->where('discipline', $discipline);
    }

    if ($module) {
      $this->db->where('module', $module);
    }

    if ($type_of_module) {
      $this->db->where('type_of_module', $type_of_module);
    }

    // if ($workpack_no) {
    //   $this->db->where('pcms_workpack.workpack_no', $workpack_no);
    // }

    if ($submission_id) {
      $this->db->where_in('submission_id', $submission_id);
    }

    if ($status_submission) {
      if ($status_submission == "ready") {
        $this->db->where('status_inspection', 0);
      } elseif ($status_submission == "submited") {
        $this->db->where('status_inspection', 1);
      } elseif ($status_submission == "approved" || $status_submission == "ready_transmit") {
        $this->db->where('status_inspection', 3);
      } elseif ($status_submission == "rejected") {
        $this->db->where('status_inspection', 2);
      } elseif ($status_submission == "pending_by_qc") {
        $this->db->where('status_inspection', 4);
      } elseif ($status_submission == "transmitted") {
        $this->db->where('status_inspection', 5);
      } elseif ($status_submission == "reject_client") {
        $this->db->where('status_inspection', 6);
      } elseif ($status_submission == "postponed") {
        $this->db->where('status_inspection', 10);
      } elseif ($status_submission == "reoffer") {
        $this->db->where('status_inspection', 11);
      } else {
        // $this->db->where_in('status_inspection',[0,1, 3, 6]);
      }
    }

    //filter company

    if ($company_id) {
      if (is_array($company_id)) {
        if (!$this->is_admin) {
          // $this->db->where_in('pcms_workpack.company_id', $company_id);
          $this->db->where_in('pcms_piecemark.company_id', $company_id);
        }
      } else {
        // $this->db->where('pcms_workpack.company_id', $company_id);
        $this->db->where('pcms_piecemark.company_id', $company_id);
      }
    }

    // if(!isset($company_id)){
    //   if(!in_array($this->user_cookie[11], [1, 14])){
    //     $this->db->where('pcms_workpack.company_id', $this->user_cookie[11]);
    //     //$this->db->where('material.company_id', $this->user_cookie[11]);
    //   }
    // } else {
    //   $this->db->where('pcms_workpack.company_id', $company_id);
    // }


    $this->db->order_by('workpack_no, drawing_ga, drawing_as DESC');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function autocomplete_workpack_no($workpack_no, $where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    $this->db->select('workpack_no');
    $this->db->from('pcms_workpack');
    $this->db->join('pcms_piecemark', 'pcms_workpack.id = pcms_piecemark.workpack_id', 'LEFT');
    $this->db->like('workpack_no', $workpack_no);
    $this->db->group_by('workpack_no');
    $this->db->limit(10);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function find_last_submission_id($where = null)
  {
    $this->db->select('submission_id');
    if (isset($where)) {
      $this->db->where($where);
    }
    $this->db->where('submission_id IS NOT NULL');
    $this->db->from('pcms_material');
    $this->db->order_by('RIGHT(submission_id, 6) DESC');
    $this->db->limit(1);
    $query = $this->db->get();
    $query = $query->row_array();
    if ($query) {
      $submission_id = substr($query['submission_id'], -6);
      $submission_id = str_pad($submission_id + 1, 6, '0', STR_PAD_LEFT);
    } else {
      $submission_id = "000001";
    }

    return $submission_id;
  }

  public function submit_material_verification($form_data)
  {
    $this->db->insert('pcms_material', $form_data);
  }
  public function update_production_balance($form_data_bal, $where)
  {
    if (isset($where)) {
      $this->db_wh->where($where);
    }
    $this->db_wh->update('pcms_wm_balance_production', $form_data_bal);
  }

  var $column_order_inspection_rfi = array('project_code', 'submission_id', 'test_pack_no', 'drawing_no', 'discipline', 'module', 'type_of_module', 'deck_elevation', 'requestor', 'date_request', 'status_inspection', 'resubmit_from_id', 'submission_id');
  var $column_search_inspection_rfi = array('project_code', 'submission_id', 'test_pack_no', 'drawing_no', 'discipline', 'module', 'type_of_module', 'deck_elevation', 'requestor', 'date_request', 'status_inspection', 'resubmit_from_id', 'submission_id');
  var $order_inspection_rfi = array('submission_id' => 'DESC');
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
          $this->db->like('CAST (' . $item . ' AS VARCHAR)', $_POST['search']['value']);
        } else {
          $this->db->or_like('CAST (' . $item . ' AS VARCHAR)', $_POST['search']['value']);
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

  private function _query_serverside_inspection_rfi($where = null)
  {

    if (isset($where)) {
      $this->db->where($where);
    }

    $this->db->select("
      MAX(project_code) AS project_code, 
      MAX(drawing_no) AS drawing_no, 
      MAX(workpack_no) AS workpack_no, 
      submission_id,
      test_pack_no, 
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
      COUNT(id_material) AS total_material,

      COUNT(CASE WHEN status_inspection IN (3,5,6,7,9,10,11) THEN 1 END) AS total_approved,
      COUNT(CASE WHEN status_inspection = 4 THEN 1 END) AS total_pending_qc,
      COUNT(CASE WHEN status_inspection = 2 THEN 1 END) AS total_rejected,
      COUNT(CASE WHEN status_inspection = 1 THEN 1 END) AS pending_approval

      ");

    $this->db->from('pcms_material');
    $this->db->join('(SELECT id, workpack_id, status_internal, test_pack_no FROM pcms_piecemark) pcms_piecemark', 'pcms_piecemark.id = pcms_material.id_piecemark');
    $this->db->join('(SELECT id, workpack_no, company_id, deck_elevation FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = pcms_material.id_workpack');

    $this->db->where('status_inspection != 0');
    $this->db->where('requested_for_update', 0);
    $this->db->group_by('project_code, workpack_no, submission_id,test_pack_no, drawing_no, discipline, module, type_of_module, deck_elevation, pcms_workpack.company_id, requestor, date_request');
    // $this->db->order_by('date_request DESC');
  }

  public function find_portal_user($user_id)
  {
    $this->db_portal->select("full_name");
    $this->db_portal->from('portal_user_db');
    $this->db_portal->where('id_user', $user_id);

    $query = $this->db_portal->get();
    return $query->row_array();
  }

  public function detail_mis($id_mis)
  {
    $this->db->select("*");
    $this->db_wh->from('pcms_wm_mis mis');
    $this->db_wh->join('(SELECT MAX(uniq_data) AS uniq_data, status_piping AS status_piping, id_mis_det, unique_no FROM pcms_wm_mis_detail GROUP BY uniq_data, unique_no, id_mis_det, status_piping ) detail', 'mis.uniq_data = detail.uniq_data');
    $this->db_wh->join('(SELECT MAX(mrir_id) AS mrir_id, unique_ident_no, mill_cert_no, plate_or_tag_no, spec_category, delivery_condition, catalog_id, heat_or_series_no, partial_report_no FROM qcs_material GROUP BY unique_ident_no, mill_cert_no, plate_or_tag_no, spec_category, delivery_condition, catalog_id, heat_or_series_no, mrir_id, partial_report_no) qcs_material', 'qcs_material.unique_ident_no = detail.unique_no');
    $this->db_wh->join('(SELECT report_no, id FROM qcs_mrir GROUP BY id, report_no) qcs_mrir', 'qcs_mrir.id = qcs_material.mrir_id');
    $this->db_wh->join('pcms_wm_material_catalog material', 'material.id = qcs_material.catalog_id');
    $this->db_wh->join('pcms_wm_catalog_category category', 'category.id = material.catalog_category_id');
    $this->db_wh->where_in('detail.id_mis_det', $id_mis);
    $query = $this->db_wh->get();
    return $query->result_array();
  }

  public function detail_inspection_rfi($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('*, pcms_material.area AS area, pcms_material.status_delete AS status_delete_mv, pcms_material.remarks AS remarks, pcms_workpack.company_id AS company_id');
    $this->db->from('pcms_material');
    $this->db->join('pcms_piecemark', 'pcms_piecemark.id = pcms_material.id_piecemark');
    $this->db->join('(SELECT id, workpack_no, company_id FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = pcms_material.id_workpack');

    // $this->db->join('(SELECT id_workpack, evidence_mv, evidence_fu, evidence_vt FROM pcms_workpack_detail) pcms_workpack_detail','pcms_workpack_detail.id_workpack = pcms_piecemark.id');
    // $this->db->join('(SELECT id_workpack, evidence_mv, evidence_fu, evidence_vt FROM pcms_workpack_detail) pcms_workpack_detail','pcms_workpack_detail.id_workpack = pcms_piecemark.id');
    $this->db->order_by('id_material ASC');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function proceed_approval_inspection($form_data, $where)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    $this->db->update('pcms_material', $form_data);
  }

  public function last_report_no($where)
  {
    $this->db->where($where);
    $this->db->select('report_number');
    $this->db->from('pcms_material');
    $this->db->join('(SELECT id, company_id FROM pcms_workpack) wp', 'wp.id = pcms_material.id_workpack', 'LEFT');
    $this->db->join('(SELECT id, deck_elevation, company_id FROM pcms_piecemark) pcms_piecemark', 'pcms_piecemark.id = pcms_material.id_piecemark', 'LEFT');
    $this->db->order_by('report_number DESC');
    $this->db->where('report_number IS NOT NULL');

    $this->db->limit(1);
    $query = $this->db->get();
    $query = $query->row_array();
    if ($query) {
      $report_number = str_pad($query['report_number'] + 1, 6, '0', STR_PAD_LEFT);
    } else {
      $report_number = '000001';
    }

    return $report_number;
  }

  var $column_order_client_rfi = array('CAST(project_code AS VARCHAR)', 'CAST(report_number AS VARCHAR)', 'drawing_no', 'CAST(discipline AS Varchar)', 'CAST(module AS VARCHAR)', 'CAST(type_of_module AS VARCHAR)', 'CAST(deck_elevation AS VARCHAR)', 'CAST(pcms_workpack.company_id AS VARCHAR)', 'CAST(report_no_rev AS VARCHAR)', 'CAST(report_number AS VARCHAR)', 'CAST(transmittal_datetime AS VARCHAR)', 'status_inspection', 'status_invitation', 'submission_id');
  var $column_search_client_rfi = array('CAST(project_code AS VARCHAR)', 'CAST(report_number AS VARCHAR)', 'drawing_no');
  var $order_client_rfi = array('report_number' => 'DESC');
  public function serverside_client_rfi($where = null, $status_inspection, $type, $add_comment)
  {
    $this->_serverside_client_rfi($where, $status_inspection, $type, $add_comment);
    if ($_POST['length'] != -1) {
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result_array();
  }

  public function count_serverside_client_rfi_all($where = null, $status_inspection, $type, $add_comment)
  {
    $this->_query_serverside_client_rfi($where, $status_inspection, $type, $add_comment);
    return $this->db->count_all_results();
  }


  public function count_serverside_client_rfi_filtered($where = null, $status_inspection, $type, $add_comment)
  {
    $this->_serverside_client_rfi($where, $status_inspection, $type, $add_comment);
    $query = $this->db->get();
    return $query->num_rows();
  }


  private function _serverside_client_rfi($where = null, $status_inspection, $type, $add_comment)
  {
    $this->_query_serverside_client_rfi($where, $status_inspection, $type, $add_comment);
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
      // $this->db->order_by(key($order), $order[key($order)]);
      $this->db->order_by("report_number DESC, deck_elevation");
    }
  }

  private function _query_serverside_client_rfi($where = null, $status_inspection, $type, $add_comment)
  {
    //updatemahmud1
    $this->db->select("
        max(submission_id) as submission_id,
        project_code, 
        report_number, 
        drawing_no, 
        project_code, 
        discipline, 
        module, 
        type_of_module, 
        report_no_rev, 
        MAX(transmittal_by) AS transmittal_by,  
        MAX(add_comment) AS add_comment, 
        MAX(pcms_workpack.company_id) AS company_id, 
        MAX(transmittal_datetime) AS transmittal_datetime, 
        MAX(status_invitation) AS status_invitation, 
        MAX(legend_inspection_auth) AS legend_inspection_auth,
        COUNT(CASE WHEN status_inspection = 5 THEN 1 END) AS total_pending,
        COUNT(CASE WHEN status_inspection = 6 THEN 1 END) AS total_reject,
        COUNT(CASE WHEN status_inspection = 7 THEN 1 END) AS total_approved,
        COUNT(CASE WHEN status_inspection = 9 THEN 1 END) AS total_approved_with_comment,
        COUNT(CASE WHEN status_inspection = 10 THEN 1 END) AS total_postponed,
        COUNT(CASE WHEN status_inspection = 11 THEN 1 END) AS total_reoffer,
        COUNT(CASE WHEN status_inspection = 12 THEN 1 END) AS total_returned,
        COUNT(id_material) AS total_material,
        MAX(status_inspection) AS status_inspection,
        max(inspection_by) 	as inspection_by, 
        max(inspection_datetime) 	as inspection_datetime, 
        max(inspection_client_by) 	as inspection_client_by, 
        max(inspection_client_datetime) 	as inspection_client_datetime, 
        deck_elevation as deck_elevation,
        max(requested_for_update) AS requested_for_update,
        max(rejected_client_remarks) AS rejected_client_remarks,
        max(report_resubmit_status) AS report_resubmit_status
        ");
    //updatemahmud1

    $this->db->from('pcms_material');
    $this->db->join('(SELECT id, deck_elevation FROM pcms_piecemark) pcms_piecemark','pcms_piecemark.id = pcms_material.id_piecemark');
    $this->db->join('(SELECT id, company_id FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = pcms_material.id_workpack');
    if (isset($where)) {
      $this->db->where($where);
    }

    if ($type) {
      // $this->db->where('(status_delete = 0 OR (status_delete = 1 AND status_inspection = 12))', null);
      // $this->db->where('report_resubmit_status', 0);

      if ($status_inspection == 5) {
        $this->db->having('COUNT(CASE WHEN status_inspection = 5 THEN 1 END) > 0');
      }

      if ($status_inspection == 6) {
        $this->db->having('
            COUNT(CASE WHEN status_inspection = 5 THEN 1 END) = 0 
            AND COUNT(CASE WHEN status_inspection = 6 THEN 1 END) > 0
          ');
      }

      if ($status_inspection == 7) {
       
        $this->db->having("COUNT(CASE WHEN status_inspection = 5 THEN 1 END) = 0 
            AND COUNT(CASE WHEN status_inspection = 6 THEN 1 END) = 0 
            AND COUNT(CASE WHEN status_inspection = 7 THEN 1 END) > 0
            AND COUNT(CASE WHEN add_comment = $add_comment THEN 1 END) > 0
          ");
      }

      if ($status_inspection == 9) {
        $this->db->having("COUNT(CASE WHEN status_inspection = 9 THEN 1 END) > 0
          ");
      }

      if ($status_inspection == 9) {
        $this->db->having("COUNT(CASE WHEN status_inspection = 9 THEN 1 END) > 0
          ");
      }
      if ($status_inspection == 10) {
        $this->db->having("COUNT(CASE WHEN status_inspection = 10 THEN 1 END) > 0
          ");
      }

      if ($status_inspection == 11) {
        $this->db->having("COUNT(CASE WHEN status_inspection = 11 THEN 1 END) > 0
          ");
      }

      if ($status_inspection == 12) {
        $this->db->having("(COUNT(id_material) = COUNT(CASE WHEN status_inspection = 12 THEN 1 END))");
      }
    } else {
      if ($status_inspection == 5) {
        $this->db->having('COUNT(CASE WHEN status_inspection = 5 THEN 1 END) > 0');
      }

      if ($status_inspection == 6) {
        $this->db->having('
            COUNT(CASE WHEN status_inspection = 5 THEN 1 END) = 0 
            AND COUNT(CASE WHEN status_inspection = 6 THEN 1 END) > 0
          ');
      }

      if ($status_inspection == 7) {
        $this->db->having("COUNT(CASE WHEN status_inspection = 5 THEN 1 END) = 0 
            AND COUNT(CASE WHEN status_inspection = 6 THEN 1 END) = 0 
            AND COUNT(CASE WHEN status_inspection = 7 THEN 1 END) > 0
          ");
      }

      if ($status_inspection == 9) {
        $this->db->having("COUNT(CASE WHEN status_inspection = 9 THEN 1 END) > 0
          ");
      }

      if ($status_inspection == 9) {
        $this->db->having("COUNT(CASE WHEN status_inspection = 9 THEN 1 END) > 0
          ");
      }
      if ($status_inspection == 10) {
        $this->db->having("COUNT(CASE WHEN status_inspection = 10 THEN 1 END) > 0
          ");
      }

      if ($status_inspection == 11) {
        $this->db->having("COUNT(CASE WHEN status_inspection = 11 THEN 1 END) > 0
          ");
      }

      if ($status_inspection == 12) {
        $this->db->having("(COUNT(id_material) = COUNT(CASE WHEN status_inspection = 12 THEN 1 END))");
      }
    }


    // $this->db->where('status_inspection >= 5');



    $this->db->group_by('project_code, report_number, drawing_no, discipline, module, type_of_module, deck_elevation, report_no_rev, pcms_workpack.company_id');
    // $this->db->order_by('transmittal_datetime DESC');
  }

  public function autocomplete_unique($where = 'null', $unique_no = null, $workpack_no = null)
  {
    //$unique_no = strtoupper($unique_no);
    // $this->db_wh->select('unique_no');
    // $this->db_wh->from('pcms_wm_mis');
    // $this->db_wh->join('(SELECT MAX(uniq_data) AS uniq_data, unique_no FROM pcms_wm_mis_detail GROUP BY uniq_data, unique_no) detail','detail.uniq_data = pcms_wm_mis.uniq_data');
    // $this->db_wh->like('unique_no', $unique_no);
    // $this->db_wh->where('workpack_no', $workpack_no);

    // $query = $this->db_wh->get(); 
    // return $query->result_array();

    if (isset($where)) {
      $this->db_wh->where($where);
    }
    $this->db_wh->from('pcms_wm_mis mis');
    $this->db_wh->join('(SELECT MAX(uniq_data) AS uniq_data, id_mis_det, unique_no FROM pcms_wm_mis_detail WHERE status = 3 GROUP BY uniq_data, unique_no, id_mis_det ) detail', 'mis.uniq_data = detail.uniq_data');
    $this->db_wh->join('(SELECT MAX(mrir_id) AS mrir_id, unique_ident_no, catalog_id, heat_or_series_no FROM qcs_material GROUP BY unique_ident_no, catalog_id, heat_or_series_no, mrir_id) qcs_material', 'qcs_material.unique_ident_no = detail.unique_no');
    $this->db_wh->join('(SELECT report_no, id FROM qcs_mrir GROUP BY id, report_no) qcs_mrir', 'qcs_mrir.id = qcs_material.mrir_id');
    $this->db_wh->join('pcms_wm_material_catalog material', 'material.id = qcs_material.catalog_id');
    $this->db_wh->join('pcms_wm_catalog_category category', 'category.id = material.catalog_category_id', 'LEFT');
    $query = $this->db_wh->get();
    return $query->result_array();
  }

  public function autocomplete_unique_2($where = 'null', $unique_no = null, $workpack_no = null)
  {
    //$unique_no = strtoupper($unique_no);
    // $this->db_wh->select('unique_no');
    // $this->db_wh->from('pcms_wm_mis');
    // $this->db_wh->join('(SELECT MAX(uniq_data) AS uniq_data, unique_no FROM pcms_wm_mis_detail GROUP BY uniq_data, unique_no) detail','detail.uniq_data = pcms_wm_mis.uniq_data');
    // $this->db_wh->like('unique_no', $unique_no);
    // $this->db_wh->where('workpack_no', $workpack_no);

    // $query = $this->db_wh->get(); 
    // return $query->result_array();

    if (isset($where)) {
      $this->db_wh->where($where);
    }
    $this->db_wh->from('pcms_wm_mis mis');
    $this->db_wh->join('(SELECT MAX(uniq_data) AS uniq_data, id_mis_det, unique_no FROM pcms_wm_mis_detail WHERE status = 3 GROUP BY uniq_data, unique_no, id_mis_det ) detail', 'mis.uniq_data = detail.uniq_data');
    $this->db_wh->join('(SELECT MAX(mrir_id) AS mrir_id, unique_ident_no, catalog_id, heat_or_series_no, project_id, spec FROM qcs_material GROUP BY unique_ident_no, catalog_id, heat_or_series_no, project_id, mrir_id, spec) qcs_material', 'qcs_material.unique_ident_no = detail.unique_no');
    $this->db_wh->join('(SELECT report_no, id FROM qcs_mrir GROUP BY id, report_no) qcs_mrir', 'qcs_mrir.id = qcs_material.mrir_id');
    $this->db_wh->join('pcms_wm_material_catalog material', 'material.id = qcs_material.catalog_id');
    $this->db_wh->join('pcms_wm_catalog_category category', 'category.id = material.catalog_category_id', 'LEFT');
    $this->db_wh->limit(10);
    $query = $this->db_wh->get();
    return $query->result_array();
  }

  public function unique_balance_production_list($where = null, $order_by = null, $limit = null)
  {
    if (isset($where)) {
      $this->db_wh->where($where);
    }

    if (isset($order_by)) {
      $this->db_wh->order_by($order_by);
    }

    if (isset($limit)) {
      $this->db_wh->limit($limit);
    }

    $this->db_wh->select('bal.unique_no');
    $this->db_wh->from('pcms_wm_balance_production bal');
    // $this->db_wh->join('pcms_wm_mis_detail mis_det','mis_det.unique_no = bal.unique_no');
    $this->db_wh->join('qcs_material mat', 'mat.unique_ident_no = bal.unique_no');
    $query = $this->db_wh->get();
    return $query->result_array();
  }

  public function autocomplete_drawing($drawing_as, $drawing_type = null, $where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('drawing_as,drawing_ga');
    $this->db->from('pcms_piecemark');
    // $this->db->like('drawing_as', $drawing_as);
    // $this->db->or_like('drawing_ga', $drawing_as);
    $this->db->group_by('drawing_as,drawing_ga');
    $this->db->limit(10);
    $query = $this->db->get();
    return $query->result_array();
  }

  function drawing_list($where = null)
  {

    $this->db_eng->where("document_no", $where);
    $this->db_eng->where("status_delete", 1);
    $this->db_eng->limit(1);

    $query = $this->db_eng->get('pcms_eng_activity');
    return $query->result_array();
  }

  function drawing_list_get_db($where = null, $limit = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    if (isset($limit)) {
      $this->db->limit($limit);
    }
    $query = $this->db->get('pcms_piecemark');
    return $query->result_array();
  }

  function get_material($where = null, $limit = null, $order_by = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    if (isset($limit)) {
      $this->db->limit($limit);
    }

    if (isset($order_by)) {
      $this->db->order_by($order_by);
    }

    $query = $this->db->get('pcms_material');
    return $query->result_array();
  }

  public function data_catalog_piping($where = null)
  {
    if (isset($where)) {
      $this->db_wh->where($where);
    }
    $this->db_wh->from('pcms_wm_material_pp material_pp');
    $query = $this->db_wh->get();
    return $query->result_array();
  }

  public function data_revise_history($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }

    $this->db->from('pcms_revise_history');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function insert_request_for_update($form_data)
  {
    $this->db->insert('pcms_revise_history', $form_data);
  }

  public function update_request_for_update($form_data, $where)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    $this->db->update('pcms_revise_history', $form_data);
  }

  var $column_order_request_for_update = array('project_code', 'drawing_no', 'revise.submission_id', 'discipline', 'module', 'type_of_module', 'request_by', 'request_date', 'request_reason', 'last_inspect_by', 'approve_by', 'approve_date', 'update_by', 'update_date', 're_approval_by', 're_approval_date', 'status_revise');
  var $column_search_request_for_update = array('project_code', 'drawing_no', 'revise.submission_id', 'discipline', 'module', 'type_of_module', 'request_by', 'request_date', 'request_reason', 'last_inspect_by', 'approve_by', 'approve_date', 'update_by', 'update_date', 're_approval_by', 're_approval_date', 'status_revise');
  var $order_request_for_update = array('revise.submission_id' => 'DESC');
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


  public function count_serverside_request_for_update_filtered($status_revise, $project_id, $discipline, $module, $type_of_module)
  {
    $this->_serverside_request_for_update($status_revise, $project_id, $discipline, $module, $type_of_module);
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
          $this->db->like(('CAST (' . $item . ' AS VARCHAR)'), $_POST['search']['value']);
        } else {
          $this->db->or_like(('CAST (' . $item . ' AS VARCHAR)'), $_POST['search']['value']);
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

  private function _query_serverside_request_for_update($status_revise, $project_id, $discipline, $module, $type_of_module, $where = NULL)
  {
    if ($where["category"] == 2) {
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
			pcms_material.report_number,
		');
      $this->db->from('pcms_revise_history revise');
      $this->db->join(
        "pcms_material",
        " 
  		CAST(SPLIT_PART(revise.submission_id, ';', 1) AS TEXT) = CAST(pcms_material.project_code AS TEXT) AND
  		CAST(SPLIT_PART(revise.submission_id, ';', 2) AS TEXT) = CAST(pcms_material.discipline AS TEXT) AND
  		CAST(SPLIT_PART(revise.submission_id, ';', 3) AS TEXT) = CAST(pcms_material.module AS TEXT) AND
  		CAST(SPLIT_PART(revise.submission_id, ';', 4) AS TEXT) = CAST(pcms_material.type_of_module AS TEXT) AND
  		CAST(SPLIT_PART(revise.submission_id, ';', 5) AS TEXT) = CAST(pcms_material.report_number AS TEXT) AND
  		CAST(SPLIT_PART(revise.submission_id, ';', 6) AS TEXT) = CAST(pcms_material.company_id AS TEXT)
  	"
      );
      $this->db->join('(SELECT id, company_id FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = pcms_material.id_workpack');
      $this->db->where('fabrication_type', 1);
      $this->db->where('status_revise', $status_revise);

      if ($where) {
        $this->db->where($where);
      }
      if ($project_id) {
        $this->db->where('project_code IN (' . $project_id . ')');
      }
      if ($discipline) {
        $this->db->where('discipline', $discipline);
      }
      if ($module) {
        $this->db->where('module', $module);
      }
      if ($type_of_module) {
        $this->db->where('type_of_module', $type_of_module);
      }
      $this->db->group_by('revise.id, revise.submission_id, project_code, drawing_no, discipline, module, type_of_module, request_by, request_date, request_reason, last_inspect_by, approve_by, approve_date, update_by, update_date, re_approval_by, re_approval_date, status_revise, pcms_material.report_number');
      $this->db->order_by('revise.id DESC');
    } else {
      $this->db->select('revise.id, revise.submission_id, project_code, drawing_no, discipline, module, type_of_module, request_by, request_date, request_reason, last_inspect_by, approve_by, approve_date, update_by, update_date, re_approval_by, re_approval_date, status_revise');
      $this->db->from('pcms_revise_history revise');
      $this->db->join('pcms_material', 'revise.submission_id = pcms_material.submission_id');
      $this->db->join('(SELECT id AS id_wp, company_id FROM pcms_workpack) wp', 'wp.id_wp = pcms_material.id_workpack');
      $this->db->where('fabrication_type', 1);
      $this->db->where('status_revise', $status_revise);

      if ($project_id) {
        $this->db->where('project_code', $project_id);
      }
      if ($this->permission_cookie[0] != 1) {
        $this->db->where_in('project_code', $this->project_alt);
        $this->db->where_in('wp.company_id', $this->company_alt);
      }

      if ($discipline) {
        $this->db->where('discipline', $discipline);
      }

      if ($module) {
        $this->db->where('module', $module);
      }

      if ($type_of_module) {
        $this->db->where('type_of_module', $type_of_module);
      }

      if ($where) {
        $this->db->where($where);
      }

      $this->db->group_by('revise.id, revise.submission_id, project_code, drawing_no, discipline, module, type_of_module, request_by, request_date, request_reason, last_inspect_by, approve_by, approve_date, update_by, update_date, re_approval_by, re_approval_date, status_revise');
      $this->db->order_by('revise.id DESC');
    }
  }

  public function detail_workpack($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }

    $this->db->from('pcms_workpack');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function list_approved_submission_number($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('submission_id');
    $this->db->from('pcms_material');
    $this->db->where_in('status_inspection', [3, 6]);
    $this->db->group_by('submission_id');
    $query = $this->db->get();
    return $query->result_array();
  }


  // ----------- Approval Log ----------- //

  function add_approval_log($data)
  {
    $this->db->insert("approval_log", $data);
  }

  function search_data_approval($project_id, $process)
  {
    $query = $this->db->query("SELECT approval_project,approval_code FROM approval_log WHERE approval_project = '$project_id' AND approval_process = '$process' GROUP BY approval_project,approval_code");
    return $query->result_array();
  }

  function get_approval_log($where = NULL)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    $query = $this->db->get('approval_log');
    return $query->result_array();
  }

  public function insert_attachment_history($form_data)
  {
    $this->db->insert('pcms_attachment_history', $form_data);
  }

  public function attachment_history_list($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }

    $this->db->from('pcms_attachment_history');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function attachment_history_list_join($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('*, history.remarks AS reject_remarks, history.created_by AS created_by, history.created_date AS created_date');
    $this->db->from('pcms_attachment_history history');
    $this->db->join('pcms_material material', 'material.id_material = history.id_process AND process = 1');
    $query = $this->db->get();
    return $query->result_array();
  }

  // ----------- Approval Log ----------- //

  public function autocomplete_inspector($where = null)
  {
    if (isset($where)) {
      $this->db_portal->where($where);
    }

    $this->db_portal->select('id_user, full_name');
    $this->db_portal->from('portal_user_db');
    $this->db_portal->limit(10);
    $query = $this->db_portal->get();
    return $query->result_array();
  }

  public function summary_rfi($where = null)
  {

    if (isset($where)) {
      $this->db->where($where);
    }
    $this->db->select('project_code, report_number, drawing_no, 
    status_invitation,
    COUNT(id_material) AS total_item,
    COUNT(CASE WHEN status_inspection = 1 THEN id_material END) AS total_pending_smoe,
    COUNT(CASE WHEN status_inspection = 2 THEN id_material END) AS total_rejected_smoe,
    COUNT(CASE WHEN status_inspection = 3 THEN id_material END) AS total_approved_smoe,
    COUNT(CASE WHEN status_inspection = 4 THEN id_material END) AS total_hold_smoe,
    COUNT(CASE WHEN status_inspection = 5 THEN id_material END) AS total_pending_client,
    COUNT(CASE WHEN status_inspection = 6 THEN id_material END) AS total_rejected_client,
    COUNT(CASE WHEN status_inspection = 7 THEN id_material END) AS total_approved_client,
    COUNT(CASE WHEN status_inspection = 8 THEN id_material END) AS total_request_for_update,
    COUNT(CASE WHEN status_inspection = 9 THEN id_material END) AS total_approve_comment,
    COUNT(CASE WHEN status_inspection = 10 THEN id_material END) AS total_postponed,
    COUNT(CASE WHEN status_inspection = 11 THEN id_material END) AS total_reoffer,
    COUNT(CASE WHEN status_inspection = 12 THEN id_material END) AS total_void,
    inspector_id, time_inspect, location_inspect, discipline, module, type_of_module, legend_inspection_auth, id_workpack, area_v2, location_v2, point_v2, MAX(area) AS area, report_no_rev,
    MAX(inspection_client_by) AS inspection_client_by,
    MAX(wp.company_id) AS company_id,
    MAX(inspection_client_datetime) AS inspection_client_datetime,
    ');
    $this->db->from('pcms_material');
    $this->db->join('(SELECT id, company_id FROM pcms_workpack) wp', 'wp.id = pcms_material.id_workpack');
    $this->db->group_by('project_code, report_number, drawing_no,inspector_id, time_inspect, location_inspect, discipline, module, type_of_module, legend_inspection_auth, id_workpack, area_v2, location_v2, point_v2, report_no_rev, status_invitation');
    $this->db->order_by('report_number ASC, report_no_rev ASC');
    $query = $this->db->get();
    return $query->result_array();
  }

  function mv_list($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    $query = $this->db->order_by('id_material', 'DESC');
    $query = $this->db->get('pcms_material');
    return $query->result_array();
  }

  public function mv_update_process_db($data, $where)
  {
    $this->db->where($where);
    $this->db->update("pcms_material", $data);
  }

  public function last_rev_report_no($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('MAX(report_no_rev) AS report_no_rev');
    $this->db->from('pcms_material');
    $this->db->order_by('report_no_rev DESC');
    $this->db->limit(1);

    $query = $this->db->get();
    return $query->result_array();
  }

  public function autocomplete_submission_id($submission_id)
  {
    $this->db->select('submission_id');
    $this->db->from('pcms_material');
    $this->db->where($submission_id);
    $this->db->group_by('submission_id');
    $this->db->limit(5);
    $query = $this->db->get();
    return $query->result_array();
  }

  function fitup_inspection_list_cpy($where = null)
  {
    if (isset($where)) {
      $query = $this->db->where($where);
    }
    $query = $this->db->where("b.drawing_no IS NOT NULL", NULL);
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
			max(c.company_id) as wp_company
			");
    $query = $this->db->order_by("b.submission_id", "desc");
    $query = $this->db->group_by("b.submission_id");
    $query = $this->db->join('pcms_material b', 'a.id = b.id_joint', "LEFT");
    $query = $this->db->join('pcms_workpack c', 'a.workpack_id = c.id');
    $query = $this->db->get('pcms_piecemark a');
    return $query->result_array();
  }

  function material_inspection_list_item($where = null)
  {
    if (isset($where)) {
      $query = $this->db->where($where);
    }
    $query = $this->db->where("b.drawing_no IS NOT NULL", NULL);
    $query = $this->db->select("b.id_piecemark");
    $query = $this->db->join('pcms_material b', 'a.id = b.id_piecemark', "LEFT");
    $query = $this->db->join('pcms_workpack c', 'a.workpack_id = c.id');
    $query = $this->db->get('pcms_piecemark a');
    return $query->result_array();
  }

  function mv_list_detail($where = null)
  {
    if (isset($where)) {
      $query = $this->db->where($where);
    }
    $query = $this->db->where("b.drawing_no IS NOT NULL", NULL);
    $query = $this->db->select("part_id, id_material, id_mis, id_mis_piping");
    $query = $this->db->join('pcms_material b', 'a.id = b.id_piecemark', "LEFT");
    $query = $this->db->join('pcms_workpack c', 'a.workpack_id = c.id');
    $query = $this->db->get('pcms_piecemark a');
    return $query->result_array();
  }

  public function data_summary_material($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('
      COUNT(CASE WHEN status_inspection = 0 THEN 1 END) AS total_ready_submit,
      COUNT(CASE WHEN status_inspection = 2 AND pcms_material.status_delete = 0 THEN 1 END) AS total_rejected,
      COUNT(CASE WHEN status_inspection = 1 THEN 1 END) AS total_pending_qc,
      COUNT(CASE WHEN status_inspection >= 3 AND status_inspection != 4 THEN 1 END) AS total_approved_qc,
      COUNT(CASE WHEN status_inspection = 4 THEN 1 END) AS total_hold_qc,
      COUNT(CASE WHEN status_inspection = 5 THEN 1 END) AS total_pending_client,
      COUNT(CASE WHEN status_inspection = 7 THEN 1 END) AS total_approved_client,
     ');

    $this->db->from('pcms_material');
    $this->db->join('pcms_piecemark', 'pcms_material.id_piecemark = pcms_piecemark.id', 'LEFT');
    $this->db->join('pcms_workpack', 'pcms_workpack.id = pcms_material.id_workpack');

    $query = $this->db->get();
    return $query->result_array();
  }

  function insert_attachment_redline($data)
  {
    convert2null($data);
    $this->db->insert("pcms_attachment_redline", $data);
    return $this->db->insert_id();
  }

  public function attachment_list($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }

    $this->db->from('pcms_attachment_redline');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function update_attachment_redline($form_data, $where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    $this->db->update('pcms_attachment_redline', $form_data);
  }

  public function detail_submission_count($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('
      COUNT(CASE WHEN status_inspection = 1 THEN id_material END) AS total_pending,
      COUNT(CASE WHEN status_inspection = 2 THEN id_material END) AS total_rejected,
      COUNT(CASE WHEN status_inspection = 2 AND status_delete = 0 THEN id_material END) AS total_pending_resubmit,
      COUNT(CASE WHEN status_inspection >= 3 AND status_inspection != 4 THEN id_material END) AS total_approved,
      MAX(id_piecemark) AS id_piecemark
    ');

    $this->db->from('pcms_material');
    $this->db->join('(SELECT id, status_internal FROM pcms_piecemark) piecemark', 'piecemark.id = pcms_material.id_piecemark');
    $this->db->join('(SELECT id AS id_wp, company_id FROM pcms_workpack) wp', 'wp.id_wp = pcms_material.id_workpack');
    $query = $this->db->get();
    return $query->result_array();
  }

  function revision_log_list($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    $query = $this->db->get('pcms_update_revision_log');
    return $query->result_array();
  }

  function revise_history_list($where = null, $order_by = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }

    if (isset($order_by)) {
      $this->db->order_by($order_by);
    }

    $query = $this->db->get('pcms_revise_history');



    return $query->result_array();
  }

  var $column_order_transmittal = array('mv.id_material', 'mv.project_code', 'workpack.workpack_no', 'mv.submission_id', 'mv.drawing_no', 'pc.drawing_as', 'pc.drawing_sp', 'pc.rev_sp', 'workpack.company_id', 'mv.discipline', 'mv.module', 'mv.type_of_module', 'pc.part_id', 'pc.thickness', 'pc.grade', 'mv.id_mis', 'mv.inspection_by', 'mv.inspection_datetime', 'mv.area_v2', 'mv.location_v2', 'mv.point_v2', 'mv.inspection_remarks', 'mv.status_inspection', 'mv.rejected_client_remarks', 'mv.id_material', 'pc.deck_elevation');
  var $column_search_transmittal = array('mv.id_material', 'mv.project_code', 'workpack.workpack_no', 'mv.submission_id', 'mv.drawing_no', 'pc.drawing_as', 'pc.drawing_sp', 'pc.rev_sp', 'workpack.company_id', 'mv.discipline', 'mv.module', 'mv.type_of_module', 'pc.part_id', 'pc.thickness', 'pc.grade', 'mv.id_mis', 'mv.inspection_by', 'mv.inspection_datetime', 'mv.area_v2', 'mv.location_v2', 'mv.point_v2', 'mv.inspection_remarks', 'mv.status_inspection', 'mv.rejected_client_remarks', 'mv.id_material', 'pc.deck_elevation');
  var $order_transmittal = array('mv.id_material' => 'DESC');

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


  private function _serverside_transmittal_list($where = null)
  {
    $this->_query_serverside_transmittal_list($where);
    $i = 0;
    foreach ($this->column_search_transmittal as $item) {
      if ($_POST['search']['value']) {
        if ($i === 0) {
          $this->db->group_start();
          $this->db->like('CAST(' . $item . ' AS VARCHAR)', $_POST['search']['value']);
        } else {
          $this->db->or_like('CAST(' . $item . ' AS VARCHAR)', $_POST['search']['value']);
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
      $this->db->order_by('submission_id DESC, mv.drawing_no, pc.drawing_as, pc.drawing_sp');
    }
  }

  private function _query_serverside_transmittal_list($where = null)
  {

    if (isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('
    *,
    mv.project_code AS project_code,
    mv.discipline AS discipline,
    mv.module AS module,
    mv.type_of_module AS Type_of_module,
    mv.drawing_no AS drawing_no,
    mv.area_v2 AS area_v2,
    mv.location_v2 AS location_v2,
    mv.point_v2 AS point_v2,
    pc.company_id AS company_id,
    pc.deck_elevation AS deck_elevation
    ');
    $this->db->from('pcms_material mv');
    $this->db->join('pcms_workpack workpack', 'mv.id_workpack = workpack.id');
    $this->db->join('pcms_piecemark pc', 'pc.id = mv.id_piecemark');
  }

  public function id_mis_list($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('id_mis, id_mis_piping, deck_elevation, mv.discipline, mv.type_of_module');
    $this->db->from('pcms_material mv');
    $this->db->join('pcms_workpack wp', 'wp.id = mv.id_workpack');
    $this->db->group_by('id_mis, id_mis_piping, deck_elevation, mv.discipline, mv.type_of_module');

    $query = $this->db->get();
    return $query->result_array();
  }

  function receiving_cs_detail($where = null, $order_by = null, $select = null)
  {
    if (isset($where)) {
      $this->db_wh->where($where);
    }

    if (isset($order_by)) {
      $this->db_wh->order_by($order_by);
    }

    if (isset($select)) {
      $this->db_wh->select($select);
    }

    $this->db_wh->from('pcms_wm_receiving_cs_detail');
    $query = $this->db_wh->get();
    return $query->result_array();
  }

  public function receiving_attachment_list_document($where = null, $order_by = null, $select = null)
  {
    if (isset($where)) {
      $this->db_wh->where($where);
    }

    if (isset($order_by)) {
      $this->db_wh->order_by($order_by);
    }

    if (isset($select)) {
      $this->db_wh->select($select);
    }

    $this->db_wh->from('pcms_wm_receiving_material_document');
    $this->db_wh->order_by('id DESC');
    $query = $this->db_wh->get();
    return $query->result_array();
  }

  public function mv_joint_template($where = null, $order_by = null, $limit = null)
  {

    if (isset($where)) {
      $this->db->where($where);
    }

    if (isset($order_by)) {
      $this->db->order_by($order_by);
    }

    if (isset($limit)) {
      $this->db->limit($limit);
    }

    $this->db->select('pc.*, mv.id_piecemark');
    $this->db->from('pcms_piecemark pc');
    $this->db->join('pcms_material mv', 'mv.id_piecemark = pc.id', 'LEFT');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function mis_join_mrir($where = null, $order_by = null, $select = null)
  {
    if (isset($where)) {
      $this->db_wh->where($where);
    }

    if (isset($order_by)) {
      $this->db_wh->order_by($order_by);
    }

    if (isset($select)) {
      $this->db_wh->select($select);
    }

    $this->db_wh->from('pcms_wm_mis mis');
    $this->db_wh->join('pcms_wm_mis_detail detail', 'detail.uniq_data = mis.uniq_data');
    $this->db_wh->join('qcs_material', 'qcs_material.unique_ident_no = detail.unique_no');
    $query = $this->db_wh->get();
    return $query->result_array();
  }

  public function summary_report_mv($status_inspection, $where = NULL)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    $this->db->select("
      max(submission_id) as submission_id,
      project_code, 
      report_number, 
      drawing_no, 
      project_code, 
      discipline, 
      module, 
      type_of_module, 
      report_no_rev, 
			invitation_remarks,
      MAX(transmittal_by) AS transmittal_by, 
      MAX(pcms_workpack.company_id) AS company_id, 
      MAX(transmittal_datetime) AS transmittal_datetime, 
      MAX(status_invitation) AS status_invitation, 
      MAX(legend_inspection_auth) AS legend_inspection_auth,
      COUNT(CASE WHEN status_inspection = 5 THEN 1 END) AS total_pending,
      COUNT(id_material) AS total_material,
      MAX(status_inspection) AS status_inspection,
      max(inspection_by) 	as inspection_by, 
			max(inspection_datetime) 	as inspection_datetime, 
			max(inspector_id) 	as inspector_id, 
			max(time_inspect) 	as time_inspect, 
      max(inspection_client_by) 	as inspection_client_by, 
			max(inspection_client_datetime) 	as inspection_client_datetime, 
      max(deck_elevation) AS deck_elevation,
      max(requested_for_update) AS requested_for_update,
      location_v2, 
      area_v2
      ");
    $this->db->from('pcms_material');
    $this->db->join('(SELECT id, deck_elevation, workpack_id FROM pcms_piecemark) pcms_piecemark', 'pcms_piecemark.id = pcms_material.id_piecemark');
    $this->db->join('(SELECT id, company_id FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = pcms_material.id_workpack');

    if ($status_inspection >= 5) {
      $this->db->having('COUNT(CASE WHEN status_inspection = 5 THEN 1 END) > 0');
    }
    // $this->db->where('status_inspection >= 5');
    $this->db->group_by('location_v2, area_v2, project_code, report_number, drawing_no, discipline, module, type_of_module, deck_elevation, report_no_rev, pcms_workpack.company_id, invitation_remarks');


    $this->db->order_by('pcms_workpack.company_id ASC');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function mv_joint_template_v2($where = null, $order_by = null, $limit = null)
  {

    if (isset($where)) {
      $this->db->where($where);
    }

    if (isset($order_by)) {
      $this->db->order_by($order_by);
    }

    if (isset($limit)) {
      $this->db->limit($limit);
    }

    $this->db->select('
    	pc.*, 
    	mv.id_piecemark');
    $this->db->from('pcms_piecemark pc');
    $this->db->join('pcms_material mv', 'mv.id_piecemark = pc.id', 'LEFT');
    $this->db->join('(SELECT workpack_no, id, company_id FROM pcms_workpack) workpack', 'pc.workpack_id = workpack.id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_id_material($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    $query = $this->db->get('pcms_material');
    return $query->result_array();
  }


  public function get_drawing_no($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    $query = $this->db->select('drawing_no');
    $query = $this->db->group_by('drawing_no');
    $query = $this->db->get('pcms_material');

    return $query->result_array();
  }

  function get_material_rt($where = null, $limit = null, $order_by = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    if (isset($limit)) {
      $this->db->limit($limit);
    }

    if (isset($order_by)) {
      $this->db->order_by($order_by);
    }
    $query = $this->db->select('
      pcms_material.*,
      pcms_piecemark.deck_elevation as deck_elevation,
    ');
    $query = $this->db->join('(SELECT id, deck_elevation FROM pcms_piecemark) pcms_piecemark', 'pcms_piecemark.id = pcms_material.id_piecemark');
    $query = $this->db->get('pcms_material');
    return $query->result_array();
  }

  public function re_transmit_list($where = null, $status_inspection = null) {
    $this->_query_serverside_client_rfi($where, $status_inspection, "summary", "");
    $query = $this->db->get(); 
    return $query->result_array();
    
  }
}
