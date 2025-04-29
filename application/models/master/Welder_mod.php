<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welder_mod extends CI_Model {

	public function __construct(){
	  parent::__construct();
		$this->db_wh      = $this->load->database('warehouse', TRUE);
		$this->db_portal  = $this->load->database('db_portal', TRUE);
		$this->db_eng     = $this->load->database('db_eng', TRUE);
		$this->db_iss     = $this->load->database('db_iss', TRUE);
	  	//$this->db_wh      = $this->load->database('warehouse', TRUE);
 	}

	public function welder_list($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		} 
		$query = $this->db->order_by('welder_code', 'asc');
		$query = $this->db->get('master_welder');
		return $query->result_array();
	}

	public function bonder_list($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		} 
		$query = $this->db->order_by('bonder_id', 'asc');
		$query = $this->db->get('master_bonder');
		return $query->result_array();
	}

	public function welder_detail_list($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		} 
		$query = $this->db->order_by('id_welder', 'asc');
		$query = $this->db->get('master_welder_detail');
		return $query->result_array();
	}

  public function master_welder_join($where = null, $order_by = null) {
    if(isset($where)) {
      $this->db->where($where);
    }

    if(isset($order_by)) {
      $this->db->order_by($order_by);
    }

		$this->db->select('
			main.id_welder, 
			welder_code, 
			welder_badge, 
			project_id, 
			welder_name, 
			discipline, 
			vsd, 
			ved, 
			status_actived, 
			last_activity, 
			rwe_code, 
			company_id, 
			ndt_val_1, 
			ndt_val_2, 
			ndt_val_3, 
			bank_data_badge, 
			auto_expired_date, 
			remarks_auto_disabled, 
			non_active_by, 
			non_active_date, 
			welder_process, 
			welder_position, 
			MAX(create_by) AS create_by, 
			MAX(create_date) AS create_date, 
			MAX(latest_activity) AS latest_activity, 
			MAX(f_no) AS f_no, 
			MAX(position_range) AS position_range, 
			MAX(diameter_range) AS diameter_range, 
			MAX(thickness_range) AS thickness_range, 
			MAX(backing) AS backing, 
			MAX(detail.cwm) AS cwm, 
			MAX(validity_start_date) AS validity_start_date, 
			MAX(validity_end_date) AS validity_end_date,
			id_wps,
		');
    $this->db->from('master_welder main');
    $this->db->join('master_welder_detail detail','main.id_welder = detail.id_welder');
		$this->db->group_by('main.id_welder, welder_code, welder_badge, project_id, welder_name, discipline, vsd, ved, status_actived, last_activity, rwe_code, company_id, ndt_val_1, ndt_val_2, ndt_val_3, bank_data_badge, auto_expired_date, remarks_auto_disabled, non_active_by, non_active_date, welder_process, welder_position, create_by, create_date, latest_activity, f_no, position_range, diameter_range, thickness_range, backing, detail.cwm, validity_start_date, validity_end_date, id_wps');
    $query = $this->db->get(); 
    return $query->result_array();
  }

	public function welder_new_process_db($data) {
		convert2null($data);
		$this->db->insert('master_welder', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function bonder_new_process_db($data) {
		convert2null($data);
		$this->db->insert('master_bonder', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function welder_new_req_process_db($data) {
		convert2null($data);
		$this->db->insert('master_welder_detail', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function welder_update_process_db($data, $where) {
		convert2null($data);
		$this->db->where($where);
		$this->db->update('master_welder', $data);
	}

	public function bonder_update_process_db($data, $where) {
		convert2null($data);
		$this->db->where($where);
		$this->db->update('master_bonder', $data);
	}

	public function delete_detail_welder($where = null) {
		if(isset($where)) {
			$this->db->where($where);
			$this->db->delete('master_welder_detail', $where);
		}
	}

	public function update_welder($formdata, $where = null) {
		if(isset($where)) {
			$this->db->where($where);
		}
		$this->db->update('master_welder', $formdata);
	}

	public function update_welder_detail($formdata, $where = null) {
		if(isset($where)) {
			$this->db->where($where);
		}
		$this->db->update('master_welder_detail', $formdata);
	}

	public function bankdata_list($where = null) {
		if(isset($where)) {
			$this->db_iss->where($where);
		} 
		// $this->db_iss->from('iss_recruitment_bankdata');
		$this->db_iss->from('master_bankdata_with_type');
		$query = $this->db_iss->get(); 
		return $query->result_array();		 
	}

	public function bankdata_list_ajax($where = null) {
		if(isset($where)) {
			$this->db_iss->where($where);
		} 
		$this->db_iss->from('master_bankdata_with_type')->limit(10);
		$query = $this->db_iss->get(); 
		return $query->result_array();		 
	}

	public function get_visual_data_all($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		} 
			  
		$query = $this->db->select('b.id as id_ndt, a.id_visual,welder_ref_rh,welder_ref_fc,length_of_weld,b.result as ndt_result,b.tested_length as ndt_tested_length');
		$query = $this->db->join('pcms_visual a','a.id_visual = b.id_visual',"LEFT");
		$query = $this->db->get('pcms_ndt b');
		return $query->result_array();
	}

	public function get_visual_data($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		} 
			  
		$query = $this->db->select('
			a.id_visual as id_visual,
			a.id_joint as id_joint,
			a.submission_id as submisison_visual,
			a.report_number as report_number,
			a.drawing_no as drawing_no,
			a.postpone_reoffer_no as postpone_reoffer_no,
			a.status_inspection as status_inspection,
			a.welder_ref_rh,
			a.welder_ref_fc,
			a.length_of_weld,
			b.id,
			b.ndt_type,
			b.result
		');
		$query = $this->db->join('pcms_joint c','c.id = a.id_joint',"LEFT");
		$query = $this->db->join('pcms_visual a','a.id_visual = b.id_visual');
		$query = $this->db->get('pcms_ndt b');
		return $query->result_array();
	}

	public function get_visual_data_welder_reg_old($where = null){
		 
		if(isset($where)){
			$query = $this->db->where($where);
		}   

		$query = $this->db->select('
			a.id_visual as id_visual, 
			a.id_joint as id_joint,
			a.submission_id as submisison_visual,
			a.report_number as report_number,
			a.drawing_no as drawing_no,
			a.postpone_reoffer_no as postpone_reoffer_no,
			a.status_inspection as status_inspection,
			a.welder_ref_rh as welder_ref_rh,
			a.welder_ref_fc as welder_ref_fc,
			a.length_of_weld as length_of_weld,
			b.id as id,
			b.ndt_type as ndt_type,
			b.result as result
		'); 
 
		$query = $this->db->join('pcms_visual a','a.id_visual = b.id_visual',"LEFT"); 
		$query = $this->db->get('pcms_ndt b');
		return $query->result_array();
	}

	public function get_visual_data_welder_reg($where = null){
		 
		if(isset($where)){
			$query = $this->db->where($where);
		}   

		$query = $this->db->select('
			a.id_visual as id_visual, 
			a.id_joint as id_joint,
			a.submission_id as submisison_visual,
			a.report_number as report_number,
			a.drawing_no as drawing_no,
			a.postpone_reoffer_no as postpone_reoffer_no,
			a.status_inspection as status_inspection,
			a.length_of_weld as length_of_weld,
			b.id as id,
			b.ndt_type as ndt_type,
			b.result as result,
		'); 
 
		$query = $this->db->join('pcms_visual a','a.id_visual = b.id_visual',"LEFT");
		$query = $this->db->join('pcms_visual_detail_welder c','b.id_visual = c.id_visual',"LEFT");
		$query = $this->db->get('pcms_ndt_all b');
		return $query->result_array();
	}


	public function get_joint_data($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}		
		$query = $this->db->get('pcms_joint');
		return $query->result_array();
	}

	public function get_ndt_data($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		} 
		$query = $this->db->select("*,a.id as id_ndt,a.ndt_type as ndt_type");
		$query = $this->db->join('pcms_visual c','a.id_visual = c.id_visual',"LEFT");
		$query = $this->db->join('pcms_ctq_reject b','a.submission_id = b.submission_id and a.ndt_type = b.ndt_type',"LEFT");		
		$query = $this->db->get('pcms_ndt_all a');
		return $query->result_array();
	}

	public function get_detail_data_ctq($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		} 			  
		
		$query = $this->db->join('pcms_ctq_reject b','a.id = b.ctq_id',"LEFT");
		$query = $this->db->join('pcms_ndt_all c','b.ndt_id = c.id',"LEFT");
		$query = $this->db->join('pcms_visual d','c.id_visual = d.id_visual',"LEFT");
		$query = $this->db->get('master_ctq a');
		return $query->result_array();
	}

	public function get_ndt_attachment($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		} 

		$query = $this->db->select('
			a.ndt_type as ndt_type,
			a.id_visual as id_visual,
			b.filename as filename,
			a.report_number as report_number,
			a.id as id_ndt,
			a.uniq_id_report as uniq_id_report,
		');
			  
		$query = $this->db->join('pcms_ndt_attachment b','b.submission_id = a.submission_id and b.ndt_type = a.ndt_type',"LEFT");
		$query = $this->db->get('pcms_ndt_all a');
		return $query->result_array();
	}

  public function summary_electrode($where = null) {
    if(isset($where)) {
      $this->db_wh->where($where);
    }

    $this->db_wh->select('SUM(qty) AS total_qty');
    $this->db_wh->from('pcms_wm_transfer_cons tr');
    $this->db_wh->join('pcms_wm_material_consumable catalog','catalog.id = tr.catalog');
    $query = $this->db_wh->get();
		return $query->result_array();
  }

  public function bonder_attachment_list($where = null, $order_by = null) {

    if(isset($where)) {
      $this->db->where($where);
    }

    if(isset($order_by)) {
      $this->db->order_by($order_by);
    }

    $this->db->from('master_bonder_attachment');
    $query = $this->db->get(); 
    return $query->result_array();

  }

  public function insert_attachment_bonder($form_data) {
    $this->db->insert('master_bonder_attachment', $form_data);
  }

  public function update_bonder_attachment($form_data, $where = null) {
    if(isset($where)) {
      $this->db->where($where);
      $this->db->update('master_bonder_attachment', $form_data);
    }

  }

  public function master_data_cat_list($where = null, $order_by = null) {
    if(isset($where)) {
      $this->db->where($where);
    }

    if(isset($order_by)) {
      $this->db->order_by($order_by);
    }

    $this->db->from('master_data_welder_req_cat');
    $query = $this->db->get(); 
    return $query->result_array();
  }

  public function master_welder_req_list($where = null, $order_by = null) {
    if(isset($where)) {
      $this->db->where($where);
    }

    if(isset($order_by)) {
      $this->db->order_by($order_by);
    }

    $this->db->from('master_data_welder_req');
    $query = $this->db->get(); 
    return $query->result_array();
  }

  public function insert_master_data_welder_req($form_data) {
    $this->db->insert('master_data_welder_req', $form_data);
  }

  public function update_master_welder_req($form_data, $where = null) {
    if(isset($where)) {
      $this->db->where($where);
      $this->db->update('master_data_welder_req', $form_data);
    }
  }
	
  // SERVERSIDE WELDER REGISTER LIST

  public function serverside_welder_register($type, $where = null) {
    $column_order     = ['welder_code','rwe_code','company_id','project','welder_badge','welder_name','id_welder','id_welder','discipline','id_welder','id_welder','id_welder','id_welder','id_welder','id_welder','id_welder','id_welder', 'id_welder','vsd','ved','status_actived','id_welder','bank_data_badge','ndt_val_1','ndt_val_2','ndt_val_3'];
    $column_search    = ['welder_code','rwe_code','welder_badge','welder_name','bank_data_badge'];
    $order_by         = ['welder_code' => 'ASC'];

    if(isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('main.id_welder, welder_code, welder_badge, project_id, welder_name, discipline, vsd, ved, status_actived, last_activity, rwe_code, company_id, ndt_val_1, ndt_val_2, ndt_val_3, bank_data_badge, auto_expired_date, remarks_auto_disabled, non_active_by, non_active_date, welder_process, welder_position, MAX(detail.attachment) as attachment, f_no, position_range, diameter_range, thickness_range, backing, detail.cwm, validity_start_date, validity_end_date');
    $this->db->from('master_welder main');
    $this->db->join('master_welder_detail detail','main.id_welder = detail.id_welder');
    $this->db->group_by('main.id_welder, welder_code, welder_badge, project_id, welder_name, discipline, vsd, ved, status_actived, last_activity, rwe_code, company_id, ndt_val_1, ndt_val_2, ndt_val_3, bank_data_badge, auto_expired_date, remarks_auto_disabled, non_active_by, non_active_date, welder_process, welder_position, f_no, position_range, diameter_range, thickness_range, backing, detail.cwm, validity_start_date, validity_end_date');

    $i = 0;
    foreach ($column_search as $item) {
      if ($_POST['search']['value']) {
        if ($i === 0) {
            $this->db->group_start();
            $this->db->like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
        } else {
            $this->db->or_like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
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

    if($type == "query") {
      if ($_POST['length'] != -1) {
        $this->db->limit($_POST['length'], $_POST['start']);
      }
      $query = $this->db->get();
      return $query->result_array();
    }

    if($type == "all") {
      return $this->db->count_all_results();
    }

    if($type == "filtered") {

      $query = $this->db->get();
      return $query->num_rows();
    }

  }

	public function visual_welder_list($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		} 

		$query = $this->db->select('pvdw.id_welder, COUNT(pv.id_joint) as joint_welded, COUNT(pna.id) as joint_tested, COUNT(pcr.id) as joint_repaired, SUM(pv.length_of_weld) as length_welded, SUM(pna.tested_length) as length_tested, SUM(pcr.length) as length_rejected');
		$query = $this->db->group_by('pvdw.id_welder');
		$query = $this->db->join('pcms_visual_detail_welder pvdw', 'pv.id_visual = pvdw.id_visual', 'LEFT');
		$query = $this->db->join('pcms_ndt_all pna', 'pv.id_visual = pna.id_visual', 'LEFT');
		$query = $this->db->join('pcms_ctq_reject pcr', 'pcr.ndt_id = pna.id', 'LEFT');
		$query = $this->db->get('pcms_visual pv');
		return $query->result_array();
	}

	public function welder_ctq_list($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		} 

		$query = $this->db->select('welder, ctq_id, SUM(length)');
		$query = $this->db->group_by('welder, ctq_id');
		$query = $this->db->join('pcms_ndt_all pna', 'pcr.ndt_id = pna.id');
		$query = $this->db->join('pcms_visual pv', 'pv.id_visual = pna.id_visual');
		$query = $this->db->get('pcms_ctq_reject pcr');
		return $query->result_array();
	}

	function welder_visual_calc($where = NULL) {
		$where[] = "pvdw.length_welded is not null";
		$where[] = "pvdw.status_delete = 0";
		// $where[] = "pvdw.length_welded != ''";
		if($where){
			$where = "WHERE ".join(" AND ", $where);
		}
		$query = "SELECT pvdw.id_welder, count(pv.id_joint) as joint_welded, sum(pvdw.length_welded) as length_welded
		from pcms_visual pv
		join pcms_visual_detail_welder pvdw on pv.id_visual = pvdw.id_visual 
		left join (
			select id_visual, max(date_of_inspection) as date_of_inspection
			from pcms_ndt_all
			group by id_visual
		) as pna on pv.id_visual = pna.id_visual
		$where
		group by pvdw.id_welder";

		$query = $this->db->query($query);
		return $query->result_array();
	}

	function welder_ndt_calc($where = NULL) {
		$where[] = "tested_by is not null";
		$where[] = "result in (1)";
		if($where){
			$where = "WHERE ".join(" AND ", $where);
		}
		$query = "SELECT pna.id_welder, count(DISTINCT pna.id_joint) as joint_tested, sum(pna.tested_length) as length_tested
		from pcms_ndt_all pna 
		join pcms_visual pv on pna.id_visual = pv.id_visual
		$where
		group by id_welder";

		$query = $this->db->query($query);
		return $query->result_array();
	}

  //  ADD BY IQBAL

	public function visual_wp_list_v2($where = null, $where_date = null) {
    if (isset($where)) {
			$this->db->where($where);
	}

	
	$this->db->select('
			res.id_welder,
			res.total_length_of_weld,
			res.total_joint_welded,
			res.total_joint_tested,
			res.total_length_tested
	');
	
	$this->db->from("(
			SELECT 
        a.id_welder,
        SUM(v.length_of_weld) AS total_length_of_weld,
        COUNT(DISTINCT a.id_visual) AS total_joint_welded,
        MAX(COALESCE(ndt.total_joint_tested, 0)) AS total_joint_tested,
        MAX(COALESCE(ndt.total_length_tested, 0)) AS total_length_tested
    FROM 
        (
            SELECT DISTINCT id_visual, id_welder
            FROM pcms_visual_detail_welder
            WHERE status_delete = 0
        ) a
    JOIN 
        pcms_visual v ON v.id_visual = a.id_visual
    LEFT JOIN (
        SELECT  
            id_welder,
            COUNT(id_visual) AS total_joint_tested,
            SUM(tested_length) AS total_length_tested
        FROM 
            pcms_ndt_all
        WHERE 
            ndt_type IN (1, 3) 
            AND result IS NOT NULL 
            AND result NOT IN (0, 4) 
            AND status_inspection != 12
        GROUP BY id_welder
    ) ndt ON ndt.id_welder = a.id_welder
		
		$where_date


    GROUP BY 
        a.id_welder
	) res"); // Note: the alias 'res' is added here correctly
	
	$query = $this->db->get(); 
	return $query->result_array();
	
  }

	public function visual_wp_reject_list_v2($where = null, $where_date = null) {
    if (isset($where)) {
			$this->db->where($where);
	}

	
	$this->db->select('
			res.id_welder,
			res.total_length_of_weld,
			res.total_joint_repaired,
			res.total_length_reject,
			ctq_id
			
	');
	
	$this->db->from("(
			SELECT 
        a.id_welder,
				MAX(COALESCE(ndt.total_length_reject, 0)) AS total_length_reject,
        COUNT(DISTINCT a.id_visual) AS total_joint_repaired,
				ctq_id
				
    FROM 
        (
            SELECT DISTINCT id_visual, id_welder
            FROM pcms_visual_detail_welder
            WHERE status_delete = 0
        ) a
    JOIN 
        pcms_visual v ON v.id_visual = a.id_visual
    LEFT JOIN (
        SELECT  
            id_welder,
						ctq_id,
            COUNT(id_visual) AS total_joint_repaired,
            SUM(pcr.length) AS total_length_reject
        FROM 
            pcms_ndt_all ndt
						JOIN pcms_ctq_reject pcr ON pcr.submission_id = ndt.uniq_id_report
        WHERE 
            ndt.ndt_type IN (1, 3) 
            AND result IS NOT NULL 
            AND result NOT IN (0, 4) 
            AND status_inspection != 12
        GROUP BY id_welder, ctq_id
    ) ndt ON ndt.id_welder = a.id_welder

		
		
		$where_date


    GROUP BY 
        a.id_welder, ctq_id
	) res"); // Note: the alias 'res' is added here correctly
	
	$query = $this->db->get(); 
	return $query->result_array();
	
  }


  public function visual_wp_list($where = null) {
    if(isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('
      pvdw.id_welder,
      pv.id_visual,
      MAX(pv.length_of_weld) AS length_of_weld,
      MAX(total_welder) AS total_welder,
      MAX(total_joint_tested) AS total_joint_tested,
      MAX(total_length_tested) AS total_length_tested
    ');

    $this->db->from('pcms_visual pv');
    $this->db->join('
      (
        SELECT COUNT(DISTINCT id_welder) AS total_welder, id_visual FROM pcms_visual_detail_welder WHERE status_delete = 0 GROUP BY id_visual
      ) pvdw2
    ','pvdw2.id_visual = pv.id_visual');
    $this->db->join('(
      SELECT id_welder, id_visual FROM pcms_visual_detail_welder WHERE status_delete = 0
    ) pvdw','pvdw.id_visual = pv.id_visual');
    $this->db->join('
      (
        SELECT MAX(date_of_inspection) AS date_of_inspection,
        id_visual AS id_visual_ndt,
        COUNT(id_visual) AS total_joint_tested,
        SUM(tested_length) AS total_length_tested,
        id_welder
        FROM pcms_ndt_all
        WHERE ndt_type IN (1,3) AND result IS NOT NULL AND result NOT IN (0,4)
        GROUP BY id_visual, id_welder
      ) ndt
    ','ndt.id_visual_ndt = pv.id_visual AND ndt.id_welder = pvdw.id_welder','LEFT');
    $this->db->group_by('
      pvdw.id_welder,
      pv.id_visual,
    ');

    $query = $this->db->get(); 
    return $query->result_array();
  }

  public function visual_wp_reject_list($where = null) {
    if(isset($where)) {
      $this->db->where($where);
    }

    $this->db->select('
      pcr.welder,
      v.id_visual,
      pcr.length,
      pcr.ctq_id,
      pcr.datum,
    ');

    $this->db->from('pcms_visual v');
    $this->db->join('
      (
        SELECT COUNT(DISTINCT id_welder) AS total_welder, id_visual FROM pcms_visual_detail_welder WHERE status_delete = 0 GROUP BY id_visual
      ) pvdw2
    ','pvdw2.id_visual = v.id_visual');
    $this->db->join('(
      SELECT id_welder, id_visual FROM pcms_visual_detail_welder WHERE status_delete = 0
    ) pvdw','pvdw.id_visual = v.id_visual');
    $this->db->join('
      (
        SELECT date_of_inspection,
        id_visual AS id_visual_ndt,
        id_welder,
        uniq_id_report
        FROM pcms_ndt_all
        WHERE ndt_type IN (1,3) AND result IS NOT NULL AND result NOT IN (0,4) AND status_inspection != 12
      ) ndt
    ','ndt.id_visual_ndt = v.id_visual AND ndt.id_welder = pvdw.id_welder','LEFT');
    $this->db->join('pcms_ctq_reject pcr','pcr.submission_id = ndt.uniq_id_report AND pcr.welder = CAST(pvdw.id_welder AS VARCHAR)');
    $this->db->group_by('
      pcr.welder,
      v.id_visual,
      pcr.length,
      pcr.ctq_id,
      pcr.datum,


    ');

    $query = $this->db->get(); 
    return $query->result_array();
  }

}
/*
End Model Auth_mod
*/