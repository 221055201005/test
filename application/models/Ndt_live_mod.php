<?php

class Ndt_live_mod extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->db_eng     = $this->load->database('db_eng_mysql', TRUE);
    $this->db_portal  = $this->load->database('db_portal', TRUE);
    $this->db_qms  = $this->load->database('quality', TRUE);
  }

  public function ndt_detail_ut($where = null, $order_by = null)
  {

    if (isset($where)) {
      $this->db->where($where);
    }

    if (isset($order_by)) {
      $this->db->order_by($order_by);
    }

    $this->db->from('pcms_ndt_ut');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function ndt_detail_atc($where = null, $order_by = null)
  {

    $this->db->select('
        a.*,
        b.id_visual AS id_visual,
        b.revision AS revision,
        b.revision_category AS revision_category,
        a.tested_length as tested_length,
    ');

    if (isset($where)) {
      $this->db->where($where);
    }

    if (isset($order_by)) {
      $this->db->order_by($order_by);
    }

    $this->db->from('pcms_ndt_atc a');
    $this->db->join('pcms_visual b', 'b.id_visual = a.id_visual');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function pcms_ndt_all($where = null, $order_by = null)
  {

    if (isset($where)) {
      $this->db->where($where);
    }

    if (isset($order_by)) {
      $this->db->order_by($order_by);
    }

    $this->db->from('pcms_ndt_all');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function quality_inspector_register($where = null, $order_by = null)
  {

    if (isset($where)) {
      $this->db_qms->where($where);
    }

    if (isset($order_by)) {
      $this->db_qms->order_by($order_by);
    }

    $this->db_qms->from('quality_inspector_register');
    $query = $this->db_qms->get();
    return $query->result_array();
  }

  public function quality_inspector_qualification($where = null, $order_by = null)
  {

    if (isset($where)) {
      $this->db_qms->where($where);
    }

    if (isset($order_by)) {
      $this->db_qms->order_by($order_by);
    }

    $this->db_qms->from('quality_inspector_qualification');
    $query = $this->db_qms->get();
    return $query->result_array();
  }

  function insert_ndt_ut($form_data)
  {
    $this->db->insert('pcms_ndt_ut', $form_data);
  }

  function update_ndt_ut($where, $set)
  {
		$set = convert2null($set);
    $this->db->where($where);
    $this->db->update('pcms_ndt_ut', $set);
  }

  function ndt_workpack($method, $where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    $query = $this->db->join('(SELECT id, workpack_id, pos_1, pos_2, class, company_id FROM pcms_joint) pcms_joint', 'pcms_ndt.id_joint = pcms_joint.id');
    $query = $this->db->join('(SELECT id, company_yard FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = pcms_joint.workpack_id');
    $query = $this->db->order_by("rfi_no", "DESC");
    $query = $this->db->get('pcms_ndt_' . strtolower($method) . ' pcms_ndt');

    return $query->result_array();
  }

  function next_rfi_ndt($method, $where = null)
  {
    $this->db->select("MAX(CAST(rfi_no AS INT)) AS rfi_no, pcms_workpack.company_id, pcms_ndt.id_project, pcms_ndt.discipline, pcms_ndt.module, pcms_ndt.type_of_module");
    if (isset($where)) {
      $this->db->where($where);
    }
    $query = $this->db->join('(SELECT id, workpack_id FROM pcms_joint) pcms_joint', 'pcms_ndt.id_joint = pcms_joint.id');
    $query = $this->db->join('(SELECT id, company_id, company_yard FROM pcms_workpack) pcms_workpack', 'pcms_workpack.id = pcms_joint.workpack_id');
    $query = $this->db->group_by("pcms_workpack.company_id, pcms_ndt.id_project, pcms_ndt.discipline, pcms_ndt.module, pcms_ndt.type_of_module");
    $query = $this->db->get('pcms_ndt_' . strtolower($method) . ' pcms_ndt');

    return $query->result_array();
  }

  function insert_ndt($method, $form_data)
  {
    $this->db->insert('pcms_ndt_' . strtolower($method), $form_data);
  }

  function ndt_detail($method, $where)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    $query = $this->db->order_by("id_joint", "DESC");
    $query = $this->db->get('pcms_ndt_' . strtolower($method));
    return $query->result_array();
  }

  function update_ndt_pwht($where, $set)
  {
    $this->db->where($where);
    $this->db->update('pcms_ndt_pwht', $set);
  }

  function ndt_detail_pwht($where = null)
  {
    $this->db->select('
        pcms_ndt_pwht.*,
        pcms_visual.revision AS revision,
        pcms_visual.revision_category AS revision_category,
      ');
    if (isset($where)) {
      $this->db->where($where);
    }
    $query = $this->db->order_by("id_joint", "ASC");
    $query = $this->db->join('pcms_visual', 'pcms_visual.id_visual = pcms_ndt_pwht.id_visual');
    $query = $this->db->from('pcms_ndt_pwht');
    $query = $this->db->get();
    return $query->result_array();
  }

  function ndt_detail_mt($where = null)
  {
    $this->db->select('
        pcms_ndt_mt.*,
        pcms_ndt_mt.status_inspection AS status_inspection,
        pcms_visual.revision AS revision,
        pcms_visual.revision_category AS revision_category,
      ');
    if (isset($where)) {
      $this->db->where($where);
    }
    $query = $this->db->order_by("id_joint", "ASC");
    $query = $this->db->join('pcms_visual', 'pcms_visual.id_visual = pcms_ndt_mt.id_visual');
    $query = $this->db->from('pcms_ndt_mt');
    $query = $this->db->get();
    return $query->result_array();
  }

  function update_ndt_mt($where, $set)
  {
    $set = convert2null($set);
    $this->db->where($where);
    $this->db->update('pcms_ndt_mt', $set);
  }

  // ==================================================
  function ndt_detail_pt($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    $query = $this->db->order_by("id_joint", "DESC");
    $query = $this->db->get('pcms_ndt_pt');
    return $query->result_array();
  }
  // ==================================================


  function update_ndt_pt($where, $set)
  {
    $set = convert2null($set);
    $this->db->where($where);
    $this->db->update('pcms_ndt_pt', $set);
  }

  function master_ctq($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    $query = $this->db->get('master_ctq');
    return $query->result_array();
  }

  function ndt_rt_list($where = null, $limit = null)
  {
    if (isset($where)) {
      foreach ($where as $key => $value) {
        if (strpos($key, ' IN ') !== false && $value != NULL) {
          $column = explode(" IN ", $key);
          $this->db->where_in($column[0], $value);
          unset($where[$key]);
        }
      }
      $this->db->where($where);
    }
    if (isset($limit)) {
      $this->db->limit($limit);
    }
    // $query = $this->db->order_by("import_date", "DESC");
    $query = $this->db->order_by("id_rt", "ASC");
    $query = $this->db->get('pcms_ndt_rt');
    return $query->result_array();
  }

  function ndt_rt_update_process($set, $where)
  {
    $set = convert2null($set);
    $this->db->where($where);
    $this->db->update('pcms_ndt_rt', $set);
  }

  function ndt_rt_film_list($where = null, $limit = null)
  {
    if (isset($where)) {
      foreach ($where as $key => $value) {
        if (strpos($key, ' IN ') !== false && $value != NULL) {
          $column = explode(" IN ", $key);
          $this->db->where_in($column[0], $value);
          unset($where[$key]);
        }
      }
      $this->db->where($where);
    }
    if (isset($limit)) {
      $this->db->limit($limit);
    }
    $query = $this->db->order_by("id", "ASC");
    $query = $this->db->get('pcms_ndt_rt_film');
    return $query->result_array();
  }

  function ndt_rt_film_update_process($set, $where)
  {
    $set = convert2null($set);
    $this->db->where($where);
    $this->db->update('pcms_ndt_rt_film', $set);
  }

  function ndt_rt_film_insert_process($form_data)
  {
    $form_data = convert2null($form_data);
    $this->db->insert('pcms_ndt_rt_film', $form_data);
  }

  public function serverside_ndt_list($type, $where = null, $method)
  {
    $column_order     = ['id_project', 'report_no', 'drawing_no', 'discipline', 'module', 'type_of_module', 'id_vendor', 'import_by', 'import_date', 'status_inspection', 'uniq_id_report'];
    $column_search    = ['report_no', 'drawing_no'];
    $order_by         = ['report_no' => 'DESC'];

    if (isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('
        id_project,
        report_no,
        drawing_no,
        discipline,
        module,
        type_of_module,
        id_vendor,
        import_by,
        MAX(import_date) AS import_date,
        status_inspection,
        uniq_id_report,
        MAX(workpack.company_id) AS real_company_id,
      ');

    $this->db->from('pcms_ndt_' . strtolower($method));

    $query = $this->db->join('(SELECT id, workpack_id FROM pcms_joint) joint', 'joint.id = ' . 'pcms_ndt_' . strtolower($method) . '.id_joint');
    $query = $this->db->join('(SELECT id, company_id FROM pcms_workpack) workpack', 'workpack.id = joint.workpack_id');

    $this->db->group_by('
        id_project,
        report_no,
        drawing_no,
        discipline,
        module,
        type_of_module,
        id_vendor,
        import_by,
        status_inspection,
        uniq_id_report

      ');

    $i = 0;
    foreach ($column_search as $item) {
      if ($_POST['search']['value']) {
        if ($i === 0) {
          $this->db->group_start();
          $this->db->like('CAST(' . $item . ' AS VARCHAR)', $_POST['search']['value']);
        } else {
          $this->db->or_like('CAST(' . $item . ' AS VARCHAR)', $_POST['search']['value']);
        }
        if (count($column_search) - 1 == $i) {
          $this->db->group_end();
        }
      }
      $i++;
    }
    if (isset($_POST['order'])) {
      $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($column_order)) {
      $order = $order_by;
      $this->db->order_by(key($order), $order[key($order)]);
    }

    if ($type == "query") {
      if ($_POST['length'] != -1) {
        $this->db->limit($_POST['length'], $_POST['start']);
      }
      $query = $this->db->get();
      return $query->result_array();
    }

    if ($type == "all") {
      return $this->db->count_all_results();
    }

    if ($type == "filtered") {

      $query = $this->db->get();
      return $query->num_rows();
    }
  }

  var $column_order_transmittal_list_drawing    = array(
    'CAST(a.drawing_no AS varchar)',
    'CAST(a.drawing_type AS varchar)',
    'CAST(a.project AS varchar)',
    'CAST(a.module AS varchar)',
    'CAST(a.discipline AS varchar)',
    'CAST(a.type_of_module AS varchar)',
  );
  var $column_search_transmittal_list_drawing    = array(
    'CAST(a.drawing_no AS varchar)',
    'CAST(a.drawing_type AS varchar)',
    'CAST(a.project AS varchar)',
    'CAST(a.module AS varchar)',
    'CAST(a.discipline AS varchar)',
    'CAST(a.type_of_module AS varchar)',
  );
  var $order_transmittal_list_drawing            = array('a.drawing_type' => 'DESC');

  public function serverside_transmittal_list_drawing($where = NULL)
  {
    $this->_serverside_transmittal_list_drawing($where);
    if ($_POST['length'] != -1) {
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result_array();
  }

  public function count_serverside_transmittal_list_drawing_all($where = NULL)
  {
    $this->_query_serverside_transmittal_list_drawing($where);
    return $this->db->count_all_results();
  }

  public function count_serverside_transmittal_list_drawing_filtered($where = NULL)
  {
    $this->_serverside_transmittal_list_drawing($where);
    $query = $this->db->get();
    return $query->num_rows();
  }

  private function _serverside_transmittal_list_drawing($where = NULL)
  {
    $this->_query_serverside_transmittal_list_drawing($where);
    $i = 0;
    foreach ($this->column_search_transmittal_list_drawing as $item) {
      if ($_POST['search']['value']) {
        if ($i === 0) {
          $this->db->group_start();
          $this->db->like($item, $_POST['search']['value']);
        } else {
          $this->db->or_like($item, $_POST['search']['value']);
        }
        if (count($this->column_search_transmittal_list_drawing) - 1 == $i) {
          $this->db->group_end();
        }
      }
      $i++;
    }
    if (isset($_POST['order'])) {
      $this->db->order_by($this->column_order_transmittal_list_drawing[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($this->order_transmittal_list_drawing)) {
      $order = $this->order_transmittal_list_drawing;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  private function _query_serverside_transmittal_list_drawing($where = NULL)
  {
    $this->db->select('
        a.drawing_no,
        a.drawing_type,
        a.project,
        a.module,
        a.discipline,
        a.type_of_module,
        c.company_id,
        COUNT(a.drawing_no) AS total_joint,
      ');
    if (isset($where)) {
      $this->db->where($where);
    }
    $this->db->where("a.status_delete", 1);
    $this->db->from('pcms_joint a');
    $this->db->join('pcms_visual b', 'a.id = b.id_joint');
    $this->db->join('pcms_workpack c', 'c.id = a.workpack_id');
    $this->db->group_by('
        a.drawing_no,
        a.drawing_type,
        a.project,
        a.module,
        a.discipline,
        a.type_of_module,
        c.company_id,
      ');
  }

  function visual_bucket_list_v2($where = null, $having = NULL)
  {
    $query = $this->db->select("
        a.*,
        b.*,
        a.drawing_wm AS drawing_wm,
        now()::timestamp,
        b.inspection_by AS visual_inspection_by,
        b.inspection_datetime AS visual_inspection_date,
        DATE_PART('day', now()::timestamp - b.time_inspect::timestamp) * 24 + 
                  DATE_PART('hour', now()::timestamp - b.time_inspect::timestamp) AS dif_hours,
              c.status_inspection AS irn_status_inspection,
              d.validator_auth,
              e.company_id,
      ");
    if (isset($where)) {
      $query = $this->db->where($where);
    }
    $query = $this->db->where("a.status_delete", 1);
    $query = $this->db->order_by("CAST(a.joint_no AS text)", "ASC", FALSE);
    $query = $this->db->join('pcms_visual b', 'a.id = b.id_joint');
    $query = $this->db->join('(SELECT id, company_id FROM pcms_workpack) e', 'e.id = a.workpack_id');
    $query = $this->db->join('pcms_irn c', 'a.id = c.id_joint', 'LEFT');
    $query = $this->db->join('pcms_irn_drawing_status d', 'c.submission_id = d.submission_id AND d.drawing_no=a.drawing_no', 'LEFT');
    // $query = $this->db->where('(b.ndt_rt>0 OR b.ndt_mt>0 OR b.ndt_ut>0 OR b.ndt_pa_ut>0 OR b.ndt_ht>0 OR b.ndt_ft>0 OR b.ndt_pt>0 OR b.ndt_pmi>0 OR b.ndt_pwht>0)');
    if (isset($having)) {
      $query = $this->db->having($having);
    }
    $query = $this->db->get('pcms_joint a');
    return $query->result_array();
  }

  function master_ndt($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    $query = $this->db->get('master_ndt_type');
    return $query->result_array();
  }

  function master_ndt_personnel($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    $query = $this->db->get('master_ndt_personnel');
    return $query->result_array();
  }

  public function serverside_pending_rfi($type, $where = null, $method)
  {
    $column_order     = [''];
    $column_search    = [''];
    $order_by         = ['rfi_no' => 'DESC'];

    if (isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('
        uniq_id_rfi,
        id_project,
        id_vendor,
        rfi_no,
        drawing_no,
        discipline,
        module,
        type_of_module,
        transmit_by,
        transmit_date
      ');

    $this->db->from('pcms_ndt_' . strtolower($method) . ' ndt');

    $this->db->group_by('
        uniq_id_rfi,
        id_project,
        id_vendor,
        rfi_no,
        drawing_no,
        discipline,
        module,
        type_of_module,
        transmit_by,
        transmit_date
      ');

    $i = 0;
    foreach ($column_search as $item) {
      if ($_POST['search']['value']) {
        if ($i === 0) {
          $this->db->group_start();
          $this->db->like('CAST(' . $item . ' AS VARCHAR)', $_POST['search']['value']);
        } else {
          $this->db->or_like('CAST(' . $item . ' AS VARCHAR)', $_POST['search']['value']);
        }
        if (count($column_search) - 1 == $i) {
          $this->db->group_end();
        }
      }
      $i++;
    }
    if (isset($_POST['order'])) {
      $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($column_order)) {
      $order = $order_by;
      $this->db->order_by(key($order), $order[key($order)]);
    }

    if ($type == "query") {
      if ($_POST['length'] != -1) {
        $this->db->limit($_POST['length'], $_POST['start']);
      }
      $query = $this->db->get();
      return $query->result_array();
    }

    if ($type == "all") {
      return $this->db->count_all_results();
    }

    if ($type == "filtered") {

      $query = $this->db->get();
      return $query->num_rows();
    }
  }

  public function serverside_rfi($type, $where = null, $method)
  {
    $column_order     = ['id_project', 'id_vendor', 'rfi_no', 'discipline', 'module', 'type_of_module', 'transmit_by', 'transmit_date'];
    $column_search    = ['id_project', 'id_vendor', 'rfi_no', 'discipline', 'module', 'type_of_module', 'transmit_by', 'transmit_date'];
    $order_by         = ['rfi_no' => 'DESC'];

    if (isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('
        uniq_id_rfi,
        id_project,
        id_vendor,
        rfi_no,
        drawing_no,
        discipline,
        module,
        type_of_module,
        MAX(transmit_by) AS transmit_by,
        MAX(transmit_date) AS transmit_date,
        MAX(id_visual) AS id_visual,
        MAX(id_joint) AS id_joint
      ');

    $this->db->from('pcms_ndt_' . strtolower($method));

    $this->db->group_by('
        uniq_id_rfi,
        id_project,
        id_vendor,
        rfi_no,
        drawing_no,
        discipline,
        module,
        type_of_module,
      ');

    $i = 0;
    foreach ($column_search as $item) {
      if ($_POST['search']['value']) {
        if ($i === 0) {
          $this->db->group_start();
          $this->db->like('CAST(' . $item . ' AS VARCHAR)', $_POST['search']['value']);
        } else {
          $this->db->or_like('CAST(' . $item . ' AS VARCHAR)', $_POST['search']['value']);
        }
        if (count($column_search) - 1 == $i) {
          $this->db->group_end();
        }
      }
      $i++;
    }
    if (isset($_POST['order'])) {
      $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($column_order)) {
      $order = $order_by;
      $this->db->order_by(key($order), $order[key($order)]);
    }

    if ($type == "query") {
      if ($_POST['length'] != -1) {
        $this->db->limit($_POST['length'], $_POST['start']);
      }
      $query = $this->db->get();
      return $query->result_array();
    }

    if ($type == "all") {
      return $this->db->count_all_results();
    }

    if ($type == "filtered") {

      $query = $this->db->get();
      return $query->num_rows();
    }
  }

  function ndt_pwth_list($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    $query = $this->db->get('pcms_ndt_pwht');
    return $query->result_array();
  }

  function ndt_ctq_reject($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    $query = $this->db->get('pcms_ctq_reject');
    return $query->result_array();
  }

  function insert_pcms_ctq_reject($form_data)
  {
    $this->db->insert('pcms_ctq_reject', $form_data);
  }

  function delete_pcms_ctq_reject($where)
  {
    $this->db->where($where);
    if ($where) {
      $this->db->delete('pcms_ctq_reject');
    }
  }

  function attachment_add($data)
  {
    $query = $this->db->insert('pcms_ndt_attachment', $data);
  }

  function ndt_attachment_list($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    $query = $this->db->get('pcms_ndt_attachment');
    return $query->result_array();
  }

  function delete_attachment($where)
  {
    $query = $this->db->where($where);
    $query = $this->db->delete('pcms_ndt_attachment');
  }

  function delete_attachment_with_status($form_data, $where = null)
  {
    $this->db->where($where);
    $this->db->update('pcms_ndt_attachment', $form_data);
  }

  public function serverside_joint_list($type, $where = null, $method)
  {
    $column_order     = ['joint_no', 'rfi_no', 'ndt.drawing_no', 'joint.drawing_wm'];
    $column_search    = ['joint_no', 'rfi_no', 'ndt.drawing_no', 'joint.drawing_wm'];
    $order_by         = ['rfi_no' => 'DESC'];
    if (isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('
      	MAX(ndt.id_joint) AS id_joint,
        MAX(ndt.id_project) AS id_project,
        MAX(ndt.id_vendor) AS id_vendor,
        MAX(ndt.rfi_no) AS rfi_no,
        MAX(ndt.uniq_id_rfi) AS uniq_id_rfi,
        MAX(ndt.drawing_no) AS drawing_no,
        MAX(ndt.discipline) AS discipline,
        MAX(ndt.module) AS module,
        MAX(ndt.type_of_module) AS type_of_module,
        MAX(ndt.id_' . strtolower($method) . ') AS id_ndt,

        MAX(joint.drawing_no) AS drawing_no,
        MAX(joint.drawing_wm) AS drawing_wm,
        MAX(joint.joint_no) AS joint_no,
        MAX(joint.deck_elevation) AS deck_elevation,

        MAX(visual.revision) AS revision,
        MAX(visual.revision_category) AS revision_category,
        MAX(visual.id_visual) AS id_visual,
        MAX(workpack.company_id) AS real_company_id,
      ');

    $this->db->from('pcms_visual visual');
    $this->db->join('pcms_ndt_' . strtolower($method) . ' ndt', 'visual.id_visual = ndt.id_visual');
    $this->db->join('pcms_joint joint', 'joint.id = visual.id_joint');
    $this->db->join('pcms_workpack workpack', 'workpack.id = joint.workpack_id', 'LEFT');
    $this->db->group_by('visual.id_visual', 'uniq_id_rfi');

    $i = 0;
    foreach ($column_search as $item) {
      if ($_POST['search']['value']) {
        if ($i === 0) {
          $this->db->group_start();
          $this->db->like('CAST('. $item .' AS VARCHAR)', $_POST['search']['value']);
        } else {
          $this->db->or_like('CAST('. $item .' AS VARCHAR)', $_POST['search']['value']);
        }
        if (count($column_search) - 1 == $i) {
          $this->db->group_end();
        }
      }
      $i++;
    }
    if (isset($_POST['order'])) {
      $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($column_order)) {
      $order = $order_by;
      $this->db->order_by(key($order), $order[key($order)]);
    }

    if ($type == "query") {
      if ($_POST['length'] != -1) {
        $this->db->limit($_POST['length'], $_POST['start']);
      }
      $query = $this->db->get();
      return $query->result_array();
    }

    if ($type == "all") {
      return $this->db->count_all_results();
    }

    if ($type == "filtered") {

      $query = $this->db->get();
      return $query->num_rows();
    }
  }

  public function grouping_drawing($method, $where = NULL)
  {
    $this->db->select('
        ndt.drawing_no,
      ');
    $this->db->from('pcms_ndt_' . strtolower($method) . ' ndt');
    if (isset($where)) {
      $this->db->where($where);
    }
    $this->db->group_by('
        ndt.drawing_no,
      ');
    $this->db->join('pcms_joint joint', 'joint.id = ndt.id_joint');
    $this->db->join('pcms_workpack workpack', 'workpack.id = joint.workpack_id', 'LEFT');
    $query = $this->db->get();
    return $query->result_array();
  }

  function update_ndt($method, $where, $set)
  {
    $this->db->where($where);
    $this->db->update('pcms_ndt_' . strtolower($method), $set);
  }

  function update_ndt_atc($where, $set)
  {
    $this->db->where($where);
    $this->db->update('pcms_ndt', $set);
  }

  public function pcms_ndt_all_joint_visual($method, $where = NULL)
  {
    $this->db->select('
      	visual.*,
      	ndt.*,
      	joint.*,
      	ndt.date_of_inspection AS tested_date_ndt,
      	irn.report_number AS irn_report_number,
      	visual.status_inspection AS visual_status_inspection,
      	ndt.status_inspection AS status_inspection_ndt,
      	visual.report_number AS visual_report_number,
      	workpack.company_id AS real_company_id,
        joint.company_id AS joint_company_id

      ');
    if (isset($where)) {
      $this->db->where($where);
    }
    $this->db->from('pcms_visual visual');
    // $this->db->join('pcms_ndt_' . strtolower($method) . ' ndt', 'visual.id_visual = ndt.id_visual');
    $this->db->join('(SELECT * FROM pcms_ndt_' . strtolower($method) . ' ORDER BY report_no ASC ) ndt', 'visual.id_visual = ndt.id_visual');
    $this->db->join('pcms_joint joint', 'joint.id = visual.id_joint');
    $this->db->join('pcms_irn irn', 'joint.id = irn.id_joint', 'LEFT');
    $this->db->join('pcms_workpack workpack', 'workpack.id = joint.workpack_id', 'LEFT');
    $this->db->order_by('ndt.report_no', 'asc');
    $query = $this->db->get();
    return $query->result_array();
  }
  // public function pcms_ndt_all_joint_visual($method, $where = NULL)
  // {
  //   $this->db->select('
  //     	visual.*,
  //     	ndt.*,
  //     	joint.*,
  //     	ndt.date_of_inspection AS tested_date_ndt,
  //     	irn.report_number AS irn_report_number,
  //     	visual.status_inspection AS visual_status_inspection,
  //     	visual.report_number AS visual_report_number,
  //     	workpack.company_id AS real_company_id
  //     ');
  //   if (isset($where)) {
  //     $this->db->where($where);
  //   }
  //   $this->db->from('pcms_visual visual');
  //   $this->db->join('pcms_ndt_' . strtolower($method) . ' ndt', 'visual.id_visual = ndt.id_visual');
  //   $this->db->join('pcms_joint joint', 'joint.id = visual.id_joint');
  //   $this->db->join('pcms_irn irn', 'joint.id = irn.id_joint', 'LEFT');
  //   $this->db->join('pcms_workpack workpack', 'workpack.id = joint.workpack_id', 'LEFT');
  //   $this->db->order_by('CAST(ndt.rfi_no AS INT)', 'asc');
  //   $query = $this->db->get();
  //   return $query->result_array();
  // }

  function ndt_pwht_list_notification($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    // $query = $this->db->order_by("id_mwtr", "DESC");
    $query = $this->db->get('pcms_ndt_pwht');
    return $query->result_array();
  }

  // public function third_party_mt($where = null){
  //   if(isset($where)){
  //     $query = $this->db->where($where);
  //   } 

  //   $this->db->where('status_inspection', 7);
  //   $query = $this->db->order_by('id_mt', 'asc');
  //   $query = $this->db->get('pcms_ndt_mt');
  //   return $query->result_array();
  // }

  // public function third_party_pt($where = null){
  //   if(isset($where)){
  //     $query = $this->db->where($where);
  //   } 

  //   $this->db->where('status_inspection', 7);
  //   $query = $this->db->order_by('id_pt', 'asc');
  //   $query = $this->db->get('pcms_ndt_pt');
  //   return $query->result_array();
  // }


  function ndt_detail_third_party($method, $where)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    $query = $this->db->order_by("id_joint", "DESC");
    $query = $this->db->get('pcms_ndt_' . strtolower($method));
    return $query->result_array();
  }

  function ndt_detail_pwht_summary($method, $where)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    $query = $this->db->select('
      ndt.uniq_id_rfi as uniq_id_rfi,
      ndt.id_project as id_project,
      ndt.id_vendor as id_vendor,
      ndt.rfi_no as rfi_no, 
      ndt.drawing_no as drawing_no,
      ndt.discipline as discipline,
      ndt.module as module,
      ndt.type_of_module as type_of_module,
      MAX(ndt.transmit_by) AS transmit_by,
      MAX(ndt.transmit_date) AS transmit_date,
      MAX(id_visual) AS id_visual,
      joint.company_id as company_id,
    ');

    $query = $this->db->from('pcms_ndt_' . strtolower($method) . ' ndt');
    $query = $this->db->join('pcms_joint joint', 'joint.id = ndt.id_joint');
    $query = $this->db->group_by('
      ndt.uniq_id_rfi,
      ndt.id_project,
      ndt.id_vendor,
      ndt.rfi_no,
      ndt.drawing_no,
      ndt.discipline,
      ndt.module,
      ndt.type_of_module,
      company_id,
    ');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function pcms_ndt_all_joint_visual_atc($method, $where = NULL)
  {
    $this->db->select('
      	visual.*,
      	ndt.*,
      	joint.*,
      	ndt.date_of_inspection AS tested_date_ndt,
      	irn.report_number AS irn_report_number,
      	visual.status_inspection AS visual_status_inspection,
      	visual.report_number AS visual_report_number,
        workpack.company_id AS real_company_id,
      ');
    if (isset($where)) {
      $this->db->where($where);
    }
    $this->db->from('pcms_visual visual');
    // $this->db->join('pcms_ndt_' . strtolower($method) . ' ndt', 'visual.id_visual = ndt.id_visual');
    $this->db->join('(SELECT * FROM pcms_ndt_' . strtolower($method) . ' ORDER BY report_number ASC ) ndt', 'visual.id_visual = ndt.id_visual');
    $this->db->join('pcms_joint joint', 'joint.id = visual.id_joint');
    $this->db->join('pcms_irn irn', 'joint.id = irn.id_joint', 'LEFT');
    $this->db->join('pcms_workpack workpack', 'workpack.id = joint.workpack_id', 'LEFT');
    $this->db->order_by('ndt.report_number', 'asc');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function pcms_ndt_all_cc($where = null, $order_by = null)
  {

    if (isset($where)) {
      $this->db->where($where);
    }

    if (isset($order_by)) {
      $this->db->order_by($order_by);
    }

    $this->db->from('pcms_ndt');
    $query = $this->db->get();
    return $query->result_array();
  }

  function ndt_all_list($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    $query = $this->db->order_by('id', 'DESC');
    $query = $this->db->get('pcms_ndt_all');
    return $query->result_array();
  }

  function ndt_atc_list($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    $query = $this->db->order_by('id', 'DESC');
    $query = $this->db->get('pcms_ndt_atc');
    return $query->result_array();
  }

  function void_ndt_rfi_rt($data, $where)
  {
    $this->db->where($where);
		$this->db->update("pcms_ndt_rt", $data);
  }
  function void_ndt_rfi_mt($data, $where)
  {
    $this->db->where($where);
		$this->db->update("pcms_ndt_mt", $data);
  }
  function void_ndt_rfi_ut($data, $where)
  {
    $this->db->where($where);
		$this->db->update("pcms_ndt_ut", $data);
  }
  function void_ndt_rfi_utt($data, $where)
  {
    $this->db->where($where);
		$this->db->update("pcms_ndt", $data);
  }

  function delete_void_rt($data, $where)
  {
    $this->db->where($where);
		$this->db->update("pcms_ndt_rt", $data);
  }
  
  function delete_void_rt_empire($data, $where)
  {
    $this->db->where($where);
		$this->db->update("pcms_ndt_rt", $data);
  }

  function delete_void_ut($data, $where)
  {
    $this->db->where($where);
		$this->db->update("pcms_ndt_ut", $data);
  }

  function delete_void_ut_empire($data, $where)
  {
    $this->db->where($where);
		$this->db->update("pcms_ndt_ut", $data);
  }
  
  function delete_void_atc($data, $where)
  {
    $this->db->where($where);
		$this->db->update("pcms_ndt", $data);
  }

  function delete_void_atc_empire($data, $where)
  {
    $this->db->where($where);
		$this->db->update("pcms_ndt", $data);
  }

  function delete_void_mt($data, $where)
  {
    $this->db->where($where);
		$this->db->update("pcms_ndt_mt", $data);
  }

  function delete_void_mt_empire($data, $where)
  {
    $this->db->where($where);
		$this->db->update("pcms_ndt_mt", $data);
  }

  //** END Delete Void **//

  public function pcms_ndt_join_joint($method, $where = NULL, $limit = NULL)
  {
    $this->db->select('
      joint.*,
      ndt.*,
    ');
    $this->db->from('pcms_ndt_' . strtolower($method) . ' ndt');
    if (isset($where)) {
      $this->db->where($where);
    }
    $this->db->join('pcms_joint joint', 'joint.id = ndt.id_joint');
    if (isset($limit)) {
      $this->db->limit($limit);
    }
    $query = $this->db->get();
    return $query->result_array();
  }

  function delete_ndt_data($method, $where)
  {
    $this->db->where($where);
    if ($where) {
      $this->db->delete('pcms_ndt_' . strtolower($method));
    }
  }

  function master_welder($where = null, $limit = NULL)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    if (isset($limit)) {
      $this->db->limit($limit);
    }
    $query = $this->db->get('master_welder');
    return $query->result_array();
  }

  function void_ndt_rfi_pt($data, $where)
  {
    $this->db->where($where);
		$this->db->update("pcms_ndt_pt", $data);
  }

  public function autocomplete_input_fill($where, $column, $method) {
    $this->db->where($where);
    $this->db->select($column);
    $this->db->from('pcms_ndt_' . strtolower($method));
    $this->db->group_by($column);
    $query = $this->db->get(); 
    return $query->result_array();
    
  }

  public function pcms_ndt_atc_summary1($method, $where = NULL)
  {
    $this->db->select('
      	visual.*,
      	ndt.*,
      	joint.*,
      	ndt.date_of_inspection AS tested_date_ndt,
        ndt.id_project as ,
      	irn.report_number AS irn_report_number,
      	visual.status_inspection AS visual_status_inspection,
      	visual.report_number AS visual_report_number,
      	workpack.company_id AS real_company_id
      ');
    if (isset($where)) {
      $this->db->where($where);
    }
    $this->db->from('pcms_ndt_atc ndt');
    // $this->db->from('pcms_visual visual');
    // $this->db->join('pcms_ndt_atc ndt', 'visual.id_visual = ndt.id_visual');
    // $this->db->join('pcms_joint joint', 'joint.id = visual.id_joint');
    // $this->db->join('pcms_irn irn', 'joint.id = irn.id_joint', 'LEFT');
    // $this->db->join('pcms_workpack workpack', 'workpack.id = joint.workpack_id', 'LEFT');
    $this->db->order_by('CAST(ndt.rfi_no AS INT)', 'asc');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function pcms_ndt_atc_summary($where = NULL)
  {
    $this->db->select('
        ndt.*,
      	joint.company_id as company_id,

      ');
    if (isset($where)) {
      $this->db->where($where);
    }
    $this->db->from('pcms_ndt_atc ndt');
    $this->db->join('pcms_joint joint', 'joint.id = ndt.id_joint');
    $this->db->order_by("company_id ASC, CAST(ndt.rfi_no AS INT) ASC");
    $query = $this->db->get();
    return $query->result_array();
  }

  function update_ndt_rt($where, $set)
  {
    $set = convert2null($set);
    $this->db->where($where);
    $this->db->update('pcms_ndt_rt', $set);
  }


  function testing_personel_list_autocomplete($where = null, $limit = null)
	{
		if (isset($where)) {
			$this->db->where($where);
		}
		$this->db->where("status", '0');
		if (isset($limit)) {
			$this->db->limit($limit);
		}
		$query = $this->db->get('master_ndt_personnel');
		return $query->result_array();
	}

  public function joint_ndt($where = null, $order_by = null)
  {

    if (isset($where)) {
      $this->db->where($where);
    }

    if (isset($order_by)) {
      $this->db->order_by($order_by);
    }

    $this->db->from('pcms_joint');
    $query = $this->db->get();
    return $query->result_array();
  }

  function update_client_process($method, $set, $where)
  {
    $set = convert2null($set);
    $this->db->where($where);
    if ($method == 'atc') {
      $this->db->update('pcms_ndt', $set);
    } else {
      $this->db->update('pcms_ndt_' . strtolower($method), $set);
    }
  }
}
