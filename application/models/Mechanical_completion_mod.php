<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mechanical_completion_mod extends CI_Model {

	public function __construct(){
	  parent::__construct();
		$this->db_eng = $this->load->database('db_eng_mysql', TRUE);
		$this->db_mdr = $this->load->database('db_mdr', TRUE);
		//$this->db_eng = $this->load->database('db_eng', TRUE);
		$this->db_eng_mysql = $this->load->database('db_eng_mysql', TRUE);
    $this->db_wh      = $this->load->database('warehouse', TRUE);

 	}

	function mechanical_completion_list($where = null, $limit = null){
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
		$query = $this->db->order_by("created_date", "DESC");
		$query = $this->db->get('pcms_mechanical_completion');
		return $query->result_array();
	}

	public function mechanical_completion_edit_process_db($data, $where) {
		$data = convert2null($data);
    $this->db->where($where);
    $this->db->update("pcms_mechanical_completion", $data);
  }

  public function mechanical_completion_import_process_db($data) {
		$data = convert2null($data);
    $this->db->insert_batch('pcms_mechanical_completion', $data);
  }

	public function mechanical_completion_list_datatable_db($cat, $where = NULL){
		$table      		= 'pcms_mechanical_completion';
		$column     		= array('id', 'project', 'module', 'type_of_module', 'discipline', 'event_id_no', 'cert_id', 'cert_description', 'tag_no', 'system', 'subsystem', 'description', 'site', 'target_date', 'last_update_date', 'subsystem_description', 'rev_no', 'status', 'status', 'id');

		$this->db->from($table);
		if(isset($where)){
      foreach ($where as $key => $value) {
        if(strpos($key, ' IN ') !== false && $value != NULL){
          $column_name = explode(" IN ", $key);
          $this->db->where_in($column_name[0], $value);
          unset($where[$key]);
        }
      }
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
			$this->db->order_by('id', 'DESC');
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

	function mechanical_completion_document_register_list($where = null, $limit = null){
    if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		$query = $this->db->order_by("created_date", "ASC");
		$query = $this->db->get('pcms_mechanical_completion_document_register');
		return $query->result_array();
	}

  public function mechanical_completion_document_register_new_process_db($data) {
    $this->db->insert('pcms_mechanical_completion_document_register', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
  }

	public function mechanical_completion_document_register_edit_process_db($data, $where) {
    $this->db->where($where);
    $this->db->update("pcms_mechanical_completion_document_register", $data);
  }

	function mechanical_completion_attachment_list($where = null, $limit = null){
    if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		$query = $this->db->order_by("created_date", "DESC");
		$query = $this->db->get('pcms_mechanical_completion_attachment');
		return $query->result_array();
	}

  public function mechanical_completion_attachment_new_process_db($data) {
    $this->db->insert('pcms_mechanical_completion_attachment', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
  }

	public function mechanical_completion_attachment_edit_process_db($data, $where) {
    $this->db->where($where);
    $this->db->update("pcms_mechanical_completion_attachment", $data);
  }

  function mechanical_completion_rfi_list($where = null, $limit = null){
    if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		// $query = $this->db->order_by("rfi_category", "ASC");
		$query = $this->db->order_by("id", "ASC");
		$query = $this->db->get('pcms_mechanical_completion_rfi');
		return $query->result_array();
	}

  public function mechanical_completion_rfi_new_process_db($data) {
    $this->db->insert('pcms_mechanical_completion_rfi', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
  }

	public function mechanical_completion_rfi_edit_process_db($data, $where) {
    $this->db->where($where);
    $this->db->update("pcms_mechanical_completion_rfi", $data);
  }

  function mechanical_completion_rfi_attachment_list($where = null, $limit = null){
    if(isset($where)){
			$this->db->where($where);
		}
		if(isset($limit)){
			$this->db->limit($limit);
		}
		$query = $this->db->order_by("created_date", "DESC");
		$query = $this->db->get('pcms_mechanical_completion_rfi_attachment');
		return $query->result_array();
	}

  public function mechanical_completion_rfi_attachment_new_process_db($data) {
    $this->db->insert('pcms_mechanical_completion_rfi_attachment', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
  }

	public function mechanical_completion_rfi_attachment_edit_process_db($data, $where) {
    $this->db->where($where);
    $this->db->update("pcms_mechanical_completion_rfi_attachment", $data);
  }

  public function receiving_list($where = null, $order_by = null) {
    if(isset($where)) {
      $this->db_wh->where($where);
    }

    if(isset($order_by)) {
      $this->db_wh->order_by($order_by);
    }

    $this->db_wh->from('pcms_wm_receiving_cs');
    $query = $this->db_wh->get(); 
    return $query->result_array();

  }

  public function receiving_attachment_list($where = null, $order_by = null) {
    if(isset($where)) {
        $this->db_wh->where($where);
    }

    if(isset($order_by)) {
      $this->db_wh->order_by($order_by);
    }

    $this->db_wh->from('pcms_wm_receiving_material_document doc');
    $query = $this->db_wh->get(); 
    return $query->result_array();
  }

  public function receiving_attachment_list_document($where = null, $order_by = null) {
    if(isset($where)) {
        $this->db_wh->where($where);
    }

    if(isset($order_by)) {
      $this->db_wh->order_by($order_by);
    }

    $this->db_wh->from('pcms_wm_receiving_material_document doc');
    $this->db_wh->join('(SELECT id, shipment_no, project, company AS id_vendor, company_id AS receiving_company FROM pcms_wm_receiving_cs) rec','rec.id = doc.receiving_id');
    $query = $this->db_wh->get(); 
    return $query->result_array();
  }

  public function warehouse_vendor_list($where = null, $order_by = null) {

    if(isset($where)) {
      $this->db_wh->where($where);
    }

    if(isset($order_by)) {
      $this->db_wh->order_by($order_by);
    }

    $this->db_wh->from('pcms_wm_master_vendor');
    $query = $this->db_wh->get(); 
    return $query->result_array();

  }

  public function receiving_detail_list($where = null, $order_by = null) {

    if(isset($where)) {
      $this->db_wh->where($where);
    }

    if(isset($order_by)) {
      $this->db_wh->order_by($order_by);
    }

    $this->db_wh->from('pcms_wm_receiving_cs_detail');
    $query = $this->db_wh->get(); 
    return $query->result_array();
  }

  public function mrir_detail_list($where = null, $order_by = null) {

    if(isset($where)) {
      $this->db_wh->where($where);
    }

    if(isset($order_by)) {
      $this->db_wh->order_by($order_by);
    }

    $this->db_wh->from('qcs_material');
    $query = $this->db_wh->get(); 
    return $query->result_array();
  }

  public function list_attachment_mrir($where = null, $order_by = null) {
    if(isset($where)) {
      $this->db_wh->where($where);
    }

    if(isset($order_by)) {
      $this->db_wh->order_by($order_by);
    }
    
    $this->db_wh->from('qcs_material_document');
    $query = $this->db_wh->get(); 
    return $query->result_array();
  }

  public function osd_attachment_list($where = null, $order_by = null) {
    if(isset($where)) {
      $this->db_wh->where($where);
    }

    if(isset($order_by)) {
      $this->db_wh->order_by($order_by);
    }
    
    $this->db->select('*, doc.created_by AS created_by, doc.created_date AS created_date, doc.remarks AS remarks');
    $this->db_wh->from('pcms_wm_osd_attachment doc');
    $this->db_wh->join('pcms_wm_osd osd','osd.osd_id = doc.osd_id');

    $query = $this->db_wh->get(); 
    return $query->result_array();
}

	public function shopdrawing_list_datatable($cat, $where = NULL){
		$column     		= array('pa.client_doc_no', 'pdr.document_no', 'pdr.last_revision_no', 'pdr.title', 'pdr.transmittal_by', 'pdr.transmittal_date', 'pdr.id');

		$this->db_eng->from('pcms_eng_activity pa');
		$this->db_eng->join('pcms_eng_drawing_register pdr', 'pa.id = pdr.id_activity');
		if(isset($where)){
			$this->db_eng->where($where);
		}

		if($cat == 'count_all'){
			return $this->db_eng->count_all_results();
		}

    $i = 0;
		$_POST['search']['value'] = convert2utf8($_POST['search']['value']);
		foreach ($column as $key => $item){
			if ($_POST['search']['value']){
				if ($i === 0){
					$this->db_eng->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db_eng->like($column[$key], $_POST['search']['value']);
				}
				else{
					$this->db_eng->or_like($column[$key], $_POST['search']['value']);
				}
				if (count($column) - 1 == $i) //last loop
					$this->db_eng->group_end(); //close bracket
			}
			$i++;
		}

    if (isset($_POST['order'])){
			$this->db_eng->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if (isset($column)){
			$this->db_eng->order_by('pdr.transmittal_date', 'DESC');
		}

		if($cat == 'data'){
			if ($_POST['length'] != -1)
			$this->db_eng->limit($_POST['length'], $_POST['start']);

			$query = $this->db_eng->get();
			return $query->result_array();
		}
		elseif($cat == 'count_filter'){
			// $query = $this->db_eng->get();
			// return $query->num_rows();
			return $this->db_eng->count_all_results();
		}
	}

	public function mdr_list_datatable($cat, $where = NULL){
		$column     		= array('md.client_doc_no', 'md.ref_no', 'md.contractor_no', 'mdr.revision_no', 'md.description', 'mdr.revision_by', 'mdr.revision_date', 'md.id', 'mdr.attachment');

		$this->db_mdr->from('mdr_document md');
		$this->db_mdr->join('mdr_document_revision mdr', 'md.id = mdr.id_document');
		if(isset($where)){
			$this->db_mdr->where($where);
		}

		if($cat == 'count_all'){
			return $this->db_mdr->count_all_results();
		}

    $i = 0;
		$_POST['search']['value'] = convert2utf8($_POST['search']['value']);
		foreach ($column as $key => $item){
			if ($_POST['search']['value']){
				if ($i === 0){
					$this->db_mdr->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db_mdr->like('CAST('.$column[$key].' AS VARCHAR)', $_POST['search']['value']);
				}
				else{
					$this->db_mdr->or_like('CAST('.$column[$key].' AS VARCHAR)', $_POST['search']['value']);
				}
				if (count($column) - 1 == $i) //last loop
					$this->db_mdr->group_end(); //close bracket
			}
			$i++;
		}

    if (isset($_POST['order'])){
			$this->db_mdr->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if (isset($column)){
			$this->db_mdr->order_by('mdr.revision_date', 'DESC');
		}

		if($cat == 'data'){
			if ($_POST['length'] != -1)
			$this->db_mdr->limit($_POST['length'], $_POST['start']);

			$query = $this->db_mdr->get();
			return $query->result_array();
		}
		elseif($cat == 'count_filter'){
			$query = $this->db_mdr->get();
			return $query->num_rows();
		}
	}


  var $column_search_attachment_mrir = array('qcs_mrir.report_no','unique_ident_no','plate_or_tag_no','heat_or_series_no','plate_or_tag_no','mill_cert_no','qcs_material.remarks');
  var $column_order_attachment_mrir  = array('qcs_material.project_id','qcs_mrir.report_no','qcs_material.receiving_company','qcs_material.discipline','qcs_material.material_allocation','qcs_material.unique_ident_no','plate_or_tag_no','heat_or_series_no','mill_cert_no','qcs_material.id','qcs_material.remarks','qcs_material.created_by','qcs_material.created_date');

  var $order_attachment_mrir         = array('qcs_material.id' => 'DESC');
  
  public function serverside_attachment_mrir_list($where = null)
  {
      $this->_serverside_attachment_mrir_list($where);
      if ($_POST['length'] != -1) {
          $this->db_wh->limit($_POST['length'], $_POST['start']);
      }
      $query = $this->db_wh->get();
      return $query->result_array();
  }

  public function count_serverside_attachment_mrir_list_all($where = null)
  {
      $this->_query_serverside_attachment_mrir_list($where);
      return $this->db_wh->count_all_results();
  }


  public function count_serverside_attachment_mrir_list_filtered($where = null)
  {
      $this->_serverside_attachment_mrir_list($where);
      $query = $this->db_wh->get();
      return $query->num_rows();
  }


  private function _serverside_attachment_mrir_list($where = null)
  {
      $this->_query_serverside_attachment_mrir_list($where);
      $i = 0;
      foreach ($this->column_search_attachment_mrir as $item) {
          if ($_POST['search']['value']) {
              if ($i === 0) {
                  $this->db_wh->group_start();
                  $this->db_wh->like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
              } else {
                  $this->db_wh->or_like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
              }
              if (count($this->column_search_attachment_mrir) - 1 == $i) {
                  $this->db_wh->group_end();
              }
          }
          $i++;
      }
      if (isset($_POST['order'])) {
          $this->db_wh->order_by($this->column_order_attachment_mrir[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
      } else if (isset($this->order_attachment_mrir)) {
          $order = $this->order_attachment_mrir;
          $this->db_wh->order_by(key($order), $order[key($order)]);
      }
  }

  private function _query_serverside_attachment_mrir_list($where = null){

    if(isset($where)) {
      $this->db_wh->where($where);
    }

    $this->db_wh->select('*, qcs_mrir.report_no AS report_no');
    $this->db_wh->from('qcs_mrir');
    $this->db_wh->join('qcs_material','qcs_mrir.id = qcs_material.mrir_id');
    }

  public function load_data_dashboard($where = null) {
    if(isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('
      COUNT(id) AS total_all,
      COUNT(CASE WHEN status = 0 THEN 1 END) AS total_draft,
      COUNT(CASE WHEN status = 1 THEN 1 END) AS total_inprogress,
      COUNT(CASE WHEN status = 2 THEN 1 END) AS total_completed_pmt,
      COUNT(CASE WHEN status = 3 THEN 1 END) AS total_pending_qc,
      COUNT(CASE WHEN status = 4 THEN 1 END) AS total_invite_client,
      COUNT(CASE WHEN status = 5 THEN 1 END) AS total_completed,
      COUNT(CASE WHEN status = 6 THEN 1 END) AS total_approved_qc,
      COUNT(CASE WHEN status = 7 THEN 1 END) AS total_rejected_qc,
      COUNT(CASE WHEN status = 8 THEN 1 END) AS total_punch_client,
      COUNT(CASE WHEN status = 9 THEN 1 END) AS total_approved_client,
      COUNT(CASE WHEN status = 10 THEN 1 END) AS total_review_document_client
    ');

    $this->db->from('pcms_mechanical_completion');
    $query = $this->db->get(); 
    return $query->result_array();
  }

  public function load_data_dashboard_discipline($where = null) {
    if(isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('discipline,
      COUNT(id) AS total_all,
      COUNT(CASE WHEN status = 0 THEN 1 END) AS total_draft,
      COUNT(CASE WHEN status = 1 THEN 1 END) AS total_inprogress,
      COUNT(CASE WHEN status = 2 THEN 1 END) AS total_completed_pmt,
      COUNT(CASE WHEN status = 3 THEN 1 END) AS total_pending_qc,
      COUNT(CASE WHEN status = 4 THEN 1 END) AS total_invite_client,
      COUNT(CASE WHEN status = 5 THEN 1 END) AS total_completed,
      COUNT(CASE WHEN status = 6 THEN 1 END) AS total_approved_qc,
      COUNT(CASE WHEN status = 7 THEN 1 END) AS total_rejected_qc,
      COUNT(CASE WHEN status = 8 THEN 1 END) AS total_punch_client,
      COUNT(CASE WHEN status = 9 THEN 1 END) AS total_approved_client,
      COUNT(CASE WHEN status = 10 THEN 1 END) AS total_review_document_client
    ');

    $this->db->from('pcms_mechanical_completion');
    $this->db->group_by('discipline');
    $query = $this->db->get(); 
    return $query->result_array();
  }

  public function system_list($where = null) {
    if(isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('system');
    $this->db->from('pcms_mechanical_completion');
    $this->db->group_by('system');
    $query = $this->db->get(); 
    return $query->result_array();
  }

  public function subsystem_list($where = null) {
    if(isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('subsystem');
    $this->db->from('pcms_mechanical_completion');
    $this->db->group_by('subsystem');
    $query = $this->db->get(); 
    return $query->result_array();
  }

}
/*
	End Model Auth_mod
*/