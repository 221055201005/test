<?php 

  class Bnp_mod extends CI_Model {

    public function __construct()
    {
      parent::__construct();
    }

    public function bnp_list($where = null, $order_by = null) {
      $this->db->select("pcms_bnp.*"); 
      if(isset($where)) {
        $this->db->where($where);
      }
      if(isset($order_by)) {
        $this->db->order_by($order_by);
      }

      $this->db->from('pcms_bnp');
      $this->db->join('pcms_workpack_detail','pcms_bnp.workpack_detail_id = pcms_workpack_detail.id');
      $this->db->join('pcms_workpack','pcms_workpack_detail.id_workpack = pcms_workpack.id');
      
      $query = $this->db->get(); 
      return $query->result_array();
    }

    public function bnp_list_complete($where = null, $order_by = null) {
      
      if(isset($where)) {
        $this->db->where($where);
      }

      if(isset($order_by)) {
        $this->db->order_by($order_by);
      }

      $this->db->from('pcms_bnp bnp');
      $this->db->join('pcms_workpack_paint_system ps','ps.id_wp = bnp.id_detail_wp_paint_system');
      $this->db->join('pcms_piecemark pc','pc.id = ps.id_template');

      $query = $this->db->get(); 
      return $query->result_array();

    }

    public function bnp_list_v2($where = null, $order_by = null) {
      $this->db->select("
        *,
        bnp.qty AS qty
      ");
      if(isset($where)) { 
        $this->db->where($where);
      }

      if(isset($order_by)) {
        $this->db->order_by($order_by);
      }

      $this->db->from('pcms_bnp bnp');
      $this->db->join('pcms_workpack_paint_system ps','ps.id_wp = bnp.id_detail_wp_paint_system');

      $query = $this->db->get(); 
      return $query->result_array();
    }

    function show_data_irn_material_v2($where = null){
      if(isset($where)){
        $query = $this->db->where($where);
      }
      $query = $this->db->select(" 
          a.id as id,
          a.project as project,
          a.module as module,
          a.type_of_module as type_of_module,
          a.discipline as discipline,
          a.deck_elevation as deck_elevation,
          a.drawing_ga as drawing_ga,
          a.rev_ga as rev_ga,
          a.drawing_as as drawing_as,
          a.rev_as as rev_as,
          a.drawing_sp as drawing_sp,
          a.rev_sp as rev_sp, 
          a.part_id as part_id, 
          b.id_material as id_material,
          b.id_piecemark as id_piecemark,
          b.id_mis as id_mis,
          b.submission_id as submission_id,
          b.report_number as report_number,
          b.status_inspection as status_inspection,
          c.report_number as irn_report_number, 
          c.status_inspection as irn_status_inspection,  
          c.submission_id as irn_submission_id,  
          c.id_irn as id_irn,  
          c.irn_description,
        ");
        
      $query = $this->db->where("c.category_irn",1);  
      $query = $this->db->order_by("c.id_irn","desc"); 
      $query = $this->db->join('pcms_irn c','a.id = c.id_piecemark',"LEFT"); 
      $query = $this->db->join('(SELECT id_material,id_piecemark,id_mis,submission_id,report_number,status_inspection FROM pcms_material WHERE status_delete <> 1 AND report_resubmit_status = 0) b','a.id = b.id_piecemark'); 
      $query = $this->db->get('pcms_piecemark a');
      return $query->result_array();
    }

    function show_bnp_pcmark_material($where = null){
      if(isset($where)){
        $query = $this->db->where($where);
      }
      $query = $this->db->select(" 
          a.id as id,
          a.project as project,
          a.module as module,
          a.type_of_module as type_of_module,
          a.discipline as discipline,
          a.deck_elevation as deck_elevation,
          a.drawing_ga as drawing_ga,
          a.rev_ga as rev_ga,
          a.drawing_as as drawing_as,
          a.rev_as as rev_as,
          a.drawing_sp as drawing_sp,
          a.rev_sp as rev_sp, 
          a.part_id as part_id, 
          b.id_material as id_material,
          b.id_piecemark as id_piecemark,
          b.id_mis as id_mis,
          b.submission_id as submission_id,
          b.report_number as report_number,
          b.status_inspection as status_inspection,
        ");
      $query = $this->db->join('(SELECT id_material,id_piecemark,id_mis,submission_id,report_number,status_inspection FROM pcms_material WHERE status_delete <> 1 AND report_resubmit_status = 0) b','a.id = b.id_piecemark'); 
      $query = $this->db->get('pcms_piecemark a');
      return $query->result_array();
    }

    public function bnp_detail($where = null, $order_by = null) {

      if(isset($where)) {
        $this->db->where($where);
      }

      if(isset($order_by)) {
        $this->db->order_by($order_by);
      }

      $this->db->from('pcms_bnp_detail');

      $query = $this->db->get(); 
      return $query->result_array();

    }

    public function attachment_list($where = null, $order_by = null) {
      if(isset($where)) {
        $this->db->where($where);
      }

      if(isset($order_by)) {
        $this->db->order_by($order_by);
      }

      $this->db->from('pcms_bnp_attachment');

      $query = $this->db->get(); 
      return $query->result_array();
    }

    public function insert_data_bnp($form_data) {
      $this->db->insert('pcms_bnp', $form_data);
    }

    public function workpack_paint_system($where = null, $order_by = null) {
      if(isset($where)) {
        $this->db->where($where);
      }

      if(isset($order_by)) {
        $this->db->order_by($order_by);
      }

      $this->db->from('pcms_workpack_paint_system');

      $query = $this->db->get(); 
      return $query->result_array();
    }


    public function workpack_list_join($where = null, $order_by = null) {

      if(isset($where)) {
        $this->db->where($where);
      }

      if(isset($order_by)) {
        $this->db->order_by($order_by);
      }

      $this->db->select('
        workpack.*,
        detail.*,
        detail.id AS id,
        detail.id_workpack AS id_workpack,
        ps.*,
        ps.status_submited_bp AS status_submited_bp,
        ps.id_template AS id_template,
        ps.id_wp AS id_detail_wp_paint_system,
        workpack.drawing_no AS drawing_no,
      ');
      $this->db->from('pcms_workpack workpack');
      $this->db->join('pcms_workpack_detail detail','workpack.id = detail.id_workpack');
      $this->db->join('pcms_workpack_paint_system ps','ps.id_workpack = workpack.id');

      $query = $this->db->get(); 
      return $query->result_array();
    }

    public function workpack_list_join_v2($where = null, $order_by = null) {

      if(isset($where)) {
        $this->db->where($where);
      }

      if(isset($order_by)) {
        $this->db->order_by($order_by);
      }

      $this->db->select('
        workpack.*,
        detail.*,
        detail.id AS id,
        detail.id_workpack AS id_workpack,
        ps.*,
        ps.status_submited_bp AS status_submited_bp,
        ps.id_template AS id_template,
        ps.id_wp AS id_detail_wp_paint_system,
        workpack.drawing_no AS drawing_no,
      ');
      $this->db->from('pcms_workpack_paint_system ps');
      $this->db->join('pcms_workpack workpack','ps.id_workpack = workpack.id');
      $this->db->join('pcms_workpack_detail detail','ps.id_workpack_detail = detail.id');

      $query = $this->db->get(); 
      return $query->result_array();
    }

    public function workpack_list_join_left($where = null, $order_by = null) {

      if(isset($where)) {
        $this->db->where($where);
      }

      if(isset($order_by)) {
        $this->db->order_by($order_by);
      }

      $this->db->select('
        workpack.*,
        detail.*,
        detail.id AS id,
        detail.id_workpack AS id_workpack,
        ps.*,
        ps.status_submited_bp AS status_submited_bp,
        ps.id_template AS id_template,
        ps.id_wp AS id_detail_wp_paint_system,
      ');
      $this->db->from('pcms_workpack_paint_system ps');
      $this->db->join('pcms_workpack_detail detail','ps.id_workpack_detail = detail.id_workpack');
      $this->db->join('pcms_workpack workpack','workpack.id = detail.id_workpack');

      $query = $this->db->get(); 
      return $query->result_array();

    }

    public function piecemark_list($where = null, $order_by = null) {

      if(isset($where)) {
        $this->db->where($where);
      }

      if(isset($order_by)) {
        $this->db->order_by($order_by);
      }

      $this->db->from('pcms_piecemark');

      $query = $this->db->get(); 
      return $query->result_array();

    }

    public function list_request_no($where = null) {
      
      $this->db->select('request_no');
      if(isset($where)) {
        $this->db->where($where);
      }
      $this->db->group_by('request_no');
      $this->db->from('pcms_bnp');

      $query = $this->db->get(); 
      return $query->result_array();
    }

    public function list_inspection_bnp($where = null, $order_by = null) {
      
      if(isset($where)) {
        $this->db->where($where);
      }

      if(isset($order_by)) {
        $this->db->order_by($order_by);
      }

      $this->db->select('
        MAX(submission_id) AS submission_id,
        project_id,
        id_paint_system,
        id_activity,
        transmittal_by,
        MAX(created_date) AS created_date,
        status_inspection,
        MAX(id_vendor) AS id_vendor,
        MAX(request_no) AS request_no,
      ');

      $this->db->group_by('project_id, id_paint_system, id_activity, transmittal_by, status_inspection');

      $this->db->from('pcms_bnp');

      $query = $this->db->get(); 
      return $query->result_array();
    }

    public function list_rfi_bnp($where = null, $order_by = null) {
      
      if(isset($where)){
        $this->db->where($where);
      }
      if(isset($order_by)){
        $this->db->order_by($order_by);
      }
      $this->db->select('
        report_number,
        project_id,
        id_paint_system,
        id_activity,
        transmittal_by,
        MAX(discipline) AS discipline,
        MAX(id_vendor) AS id_vendor,
        MAX(type_of_module) AS type_of_module,
        transmittal_date,
        status_inspection,
        transmittal_uniqid,
        MAX(attachment_status) AS attachment_status,
        MAX(status_invitation) AS status_invitation,
        MAX(id_detail_wp_paint_system) AS id_detail_wp_paint_system,
        MAX(invitation_by) AS invitation_by,
        MAX(invitation_datetime) AS invitation_datetime,
        submission_id,
        MAX(request_no) AS request_no,
      ');
      $this->db->group_by('
        report_number,
        project_id,
        id_paint_system,
        id_activity,
        transmittal_by,
        transmittal_date,
        status_inspection,
        transmittal_uniqid,
        submission_id,
      ');
      $this->db->from('pcms_bnp');

      $query = $this->db->get(); 
      return $query->result_array();
    }

    function update_pcms_bpn($where,$set){       
      $this->db->where($where);
      $this->db->update('pcms_bnp', $set);
    }
    
    public function insert_bnp_attachment($form_data) {
      $this->db->insert('pcms_bnp_attachment', $form_data);
    }

    public function insert_pcms_workpack_paint_system($form_data){
      $this->db->insert('pcms_workpack_paint_system', $form_data);
      return $this->db->insert_id();
    }

    public function delete_bnp_attachment($where) {
      $this->db->where($where);
      $this->db->delete("pcms_bnp_attachment");
    }

    public function delete_bnp_detail($where) {
      $this->db->where($where);
      $this->db->delete("pcms_bnp_detail");
    }

    public function insert_bnp_detail_batch($form_data) {
      $this->db->insert_batch('pcms_bnp_detail', $form_data);
    }

    public function insert_bnp_detail($form_data) {
      $this->db->insert('pcms_bnp_detail', $form_data);
    }

    function update_pcms_bpn_detail($where,$set){       
      $this->db->where($where);
      $this->db->update('pcms_bnp_detail', $set);
    }

    public function update_detail_wp_paint_system($form_data, $where = null) {
      if(isset($where)) {
        $this->db->where($where);
      }

      $this->db->update('pcms_workpack_paint_system', $form_data);
    }


    public function list_of_data_bnp_tracecode($where = null, $order_by = null) {
      
      if(isset($where)) {
        $this->db->where($where);
      } 
      if(isset($order_by)) {
        $this->db->order_by($order_by);
      } 
      $this->db->where("a.report_number is not null");
      $this->db->select(" 
            max(a.status_invitation) as status_invitation,
            max(a.attachment_status) as attachment_status,
            a.report_number,
            max(date(b.upload_datetime)) as upload_datetime,
            max(date(a.invitation_datetime)) as invitation_datetime,
            max(date(a.transmittal_date)) as transmittal_date,
            ");
      $this->db->group_by("a.report_number");
      $this->db->join('pcms_bnp_attachment b','a.transmittal_uniqid = b.submission_id','left');
      $this->db->from('pcms_bnp a');

      $query = $this->db->get(); 
      return $query->result_array();
    }

    var $column_order_pmt  = array('detail.id','wp.workpack_no','irn.report_number','wp.project','pc.drawing_ga','pc.drawing_as','pc.drawing_sp','ps.id_paint_system','pc.can_number','pc.part_id','mv.id_mis','pc.profile','pc.diameter','pc.length','pc.area','pc.thickness','mv.status_inspection','detail.id');
    var $column_search_pmt = array('detail.id','wp.workpack_no','irn.report_number','wp.project','pc.drawing_ga','pc.drawing_as','pc.drawing_sp','ps.id_paint_system','pc.can_number','pc.part_id','mv.id_mis','pc.profile','pc.diameter','pc.length','pc.area','pc.thickness','mv.status_inspection','detail.id');

    var $column_order_pmt_wo  = array(
      'wp.workpack_no', // id
      'wp.workpack_no', // wo no
      'wp.workpack_no', // -
      'wp.project', // project
      'wp.drawing_no', // drawing_no
      'wp.drawing_no', // drawing_no
      'wp.drawing_no', // drawing_no
      'ps.id_paint_system', // paint_system
      'ps.id_template',  // -
      'ps.id_template', // -
      'ps.id_template', // unique no
      'ps.id_template', // -
      'ps.id_template', // -
      'ps.id_template', // length
      'ps.id_template', // area
      'ps.id_template', // thk
      'ps.id_template', // -
      'ps.id_template', // -
    );
    var $column_search_pmt_wo = array(
      'wp.workpack_no', // id
      'wp.workpack_no', // wo no
      'wp.workpack_no', // -
      'wp.project', // project
      'wp.drawing_no', // drawing_no
      'wp.drawing_no', // drawing_no
      'wp.drawing_no', // drawing_no
      'ps.id_paint_system', // paint_system
      'ps.id_template',  // -
      'ps.id_template', // -
      'ps.id_template', // unique no
      'ps.id_template', // -
      'ps.id_template', // -
      'ps.id_template', // length
      'ps.id_template', // area
      'ps.id_template', // thk
      'ps.id_template', // -
      'ps.id_template', // -
    );

    var $order_pmt         = array('detail.id' => 'DESC');
    
    public function serverside_pmt_list($where = null,$is_itr = null)
    {
        $this->_serverside_pmt_list($where,$is_itr);
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_serverside_pmt_list_all($where = null,$is_itr = null)
    {
        $this->_query_serverside_pmt_list($where,$is_itr);
        return $this->db->count_all_results();
    }


    public function count_serverside_pmt_list_filtered($where = null,$is_itr = null)
    {
        $this->_serverside_pmt_list($where,$is_itr);
        $query = $this->db->get();
        return $query->num_rows();
    }


    private function _serverside_pmt_list($where = null,$is_itr = null)
    {

      $order_by_using   = $this->column_order_pmt;
      $search_by_using  = $this->column_search_pmt;
      if($where['ps.wp_type']==2) {
        $order_by_using = $this->column_order_pmt_wo;
        $search_by_using = $this->column_search_pmt_wo;
      }

      $this->_query_serverside_pmt_list($where,$is_itr);
      $i = 0;
      foreach ($search_by_using as $item) {
          if ($_POST['search']['value']) {
              if ($i === 0) {
                  $this->db->group_start();
                  $this->db->like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
              } else {
                  $this->db->or_like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
              }
              if (count($this->column_search_pmt) - 1 == $i) {
                  $this->db->group_end();
              }
          }
          $i++;
      }
      
      if (isset($_POST['order'])) {
          $this->db->order_by($order_by_using[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
      } else if (isset($this->order_pmt)) {
          $order = $this->order_pmt;
          $this->db->order_by(key($order), $order[key($order)]);
      }
    }

    private function _query_serverside_pmt_list($where = null,$is_itr = null){

      if(isset($where)) {
        $this->db->where($where);
      }
      if($where['ps.wp_type']==2) {  
        $this->db->select('
          ps.id_template,
          wp.project AS project,
          detail.id AS id,
          wp.id AS id_workpack,
          wp.company_id AS company_id,
          wp.categories_irn AS categories_irn,
          ps.id_template AS id_template,
          ps.id_paint_system AS id_paint_system,
          wp.workpack_no AS workpack_no,
          irn.report_number AS irn_report_number,
          irn.submission_id AS submission_id_irn,
          wp.drawing_no AS drawing_ga,
          wp.drawing_no AS drawing_as,
          wp.drawing_no AS drawing_sp,
          wp.discipline AS discipline,
          wp.module AS module,
          wp.type_of_module AS type_of_module,
        ');
      } else if($is_itr == 1){ 
        $this->db->select('
          wp.project AS project,
          detail.id AS id,
          wp.id AS id_workpack,
          wp.company_id AS company_id,
          wp.categories_irn AS categories_irn,
          ps.id_template AS id_template,
          ps.id_paint_system AS id_paint_system,
          wp.workpack_no AS workpack_no,
          irn.report_number AS irn_report_number,
          irn.submission_id AS submission_id_irn,
          pc.drawing_ga AS drawing_ga,
          pc.drawing_as AS drawing_as,
          pc.drawing_sp AS drawing_sp,
          mv.status_inspection AS status_inspection_mv,
          mv.report_number AS report_number_mv,
          mv.submission_id AS submission_id_mv,
          mv.id_itr,
          mv.id_mis,
          pc.can_number,
          pc.part_id,
          pc.profile,
          pc.diameter,
          pc.length,
          pc.area,
          pc.thickness,

          MAX(mv.discipline) AS discipline,
          MAX(mv.module) AS module,
          MAX(mv.type_of_module) AS type_of_module,
       ');

      } else {
        
        $this->db->select('
          wp.project AS project,
          detail.id AS id,
          wp.id AS id_workpack,
          wp.company_id AS company_id,
          wp.categories_irn AS categories_irn,
          ps.id_template AS id_template,
          ps.id_paint_system AS id_paint_system,
          wp.workpack_no AS workpack_no,
          irn.report_number AS irn_report_number,
          irn.submission_id AS submission_id_irn,
          pc.drawing_ga AS drawing_ga,
          pc.drawing_as AS drawing_as,
          pc.drawing_sp AS drawing_sp,

          mv.status_inspection AS status_inspection_mv,
          mv.report_number AS report_number_mv,
          mv.submission_id AS submission_id_mv,
          mv.id_material,
          mv.id_mis,
          pc.can_number,
          pc.part_id,
          pc.profile,
          pc.diameter,
          pc.length,
          pc.area,
          pc.thickness,

          MAX(mv.discipline) AS discipline,
          MAX(mv.module) AS module,
          MAX(mv.type_of_module) AS type_of_module,
       ');

      }

       $this->db->from('pcms_workpack_paint_system ps');
       $this->db->join('pcms_workpack_detail detail','detail.id = ps.id_workpack_detail', 'LEFT');
       // $this->db->join('pcms_workpack wp','wp.id = detail.id_workpack', 'LEFT');
       $this->db->join('pcms_workpack wp','wp.id = ps.id_workpack', 'LEFT');
       if($where['ps.wp_type']!=2) {
        $this->db->join('pcms_piecemark pc','pc.id = ps.id_template', 'LEFT');
        if($is_itr == 1){ 
          $this->db->join('(
            SELECT
            id_itr,
            submission_id,
            report_number,
            project_code,
            discipline,
            module,
            type_of_module,
            report_no_rev,
            id_mis,
            id_piecemark,
            status_inspection

            FROM pcms_itr
            WHERE status_delete = 0 AND report_resubmit_status = 0
            
          ) mv','mv.id_piecemark = pc.id', 'LEFT');
         } else {
          $this->db->join('(
            SELECT
            id_material,
            submission_id,
            report_number,
            project_code,
            discipline,
            module,
            type_of_module,
            report_no_rev,
            id_mis,
            id_piecemark,
            status_inspection

            FROM pcms_material
            WHERE status_delete = 0 AND report_resubmit_status = 0
            
          ) mv','mv.id_piecemark = pc.id', 'LEFT');
         }
       }
 
       $this->db->join('
        (SELECT 
        MAX(report_number) AS report_number, 
        MAX(submission_id) AS submission_id 
        FROM pcms_irn WHERE irn_type = 2 GROUP BY report_number) irn','irn.report_number = wp.irn_report_no', 'LEFT');

        if($where['ps.wp_type'] == 2){ 
          $this->db->group_by('
            ps.id_template,
            wp.project,
            detail.id,
            irn_report_number,
            wp.id,
            ps.id_template,
            ps.id_paint_system,
            wp.workpack_no,
            irn.report_number,
            irn.submission_id,
            wp.drawing_no
          '); 
        } elseif($is_itr == 1){ 
          $this->db->group_by('
            wp.project,
            detail.id,
            irn_report_number,
            wp.id,
            ps.id_template,
            ps.id_paint_system,
            wp.workpack_no,
            irn.report_number,
            irn.submission_id,
            pc.drawing_ga,
            pc.drawing_as,
            pc.drawing_sp,
            mv.status_inspection,
            mv.report_number,
            mv.submission_id,
            mv.id_itr,
            mv.id_mis,
            pc.can_number,
            pc.part_id,
            pc.profile,
            pc.diameter,
            pc.length,
            pc.area,
            pc.thickness
          '); 
        } else {
          $this->db->group_by('
            wp.project,
            detail.id,
            irn_report_number,
            wp.id,
            ps.id_template,
            ps.id_paint_system,
            wp.workpack_no,
            irn.report_number,
            irn.submission_id,
            pc.drawing_ga,
            pc.drawing_as,
            pc.drawing_sp,
            mv.status_inspection,
            mv.report_number,
            mv.submission_id,
            mv.id_material,
            mv.id_mis,
            pc.can_number,
            pc.part_id,
            pc.profile,
            pc.diameter,
            pc.length,
            pc.area,
            pc.thickness
          ');
        }
      }

      public function delete_bnp_list($where = null) {
        if(isset($where)) {
          $this->db->where($where);
          $this->db->delete("pcms_bnp");
        }
      }
      // Serverside QC
      var $column_order_qc  = array(
        'id_bnp',
        'detail.id',
        'ps.id_activity',
        'ps.id_paint_system',
        'wp.workpack_no',
        'irn.report_number',
        'irn.submission_id',
        'pc.drawing_ga',
        'pc.drawing_as',
        'pc.drawing_sp',
        'bnp.submission_id',
        'bnp.request_no',
        'pc.part_id',
        'mv.id_mis'
      );
      var $column_search_qc = array(
        'id_bnp',
        'detail.id',
        'ps.id_activity',
        'ps.id_paint_system',
        'wp.workpack_no',
        'irn.report_number',
        'irn.submission_id',
        'pc.drawing_ga',
        'pc.drawing_as',
        'pc.drawing_sp',
        'bnp.submission_id',
        'bnp.request_no',
        'pc.part_id',
        'mv.id_mis'
      );
      var $order_qc         = array('ps.id_wp' => 'DESC');
      
      public function serverside_qc_list($where = null)
      {
          $this->_serverside_qc_list($where);
          if ($_POST['length'] != -1) {
              $this->db->limit($_POST['length'], $_POST['start']);
          }
          $query = $this->db->get();
          return $query->result_array();
      }

      public function count_serverside_qc_list_all($where = null)
      {
          $this->_query_serverside_qc_list($where);
          return $this->db->count_all_results();
      }


      public function count_serverside_qc_list_filtered($where = null)
      {
          $this->_serverside_qc_list($where);
          $query = $this->db->get();
          return $query->num_rows();
      }


      private function _serverside_qc_list($where = null)
      {
          $this->_query_serverside_qc_list($where);
          $i = 0;
          foreach ($this->column_search_qc as $item) {
              if ($_POST['search']['value']) {
                  if ($i === 0) {
                      $this->db->group_start();
                      $this->db->like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
                  } else {
                      $this->db->or_like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
                  }
                  if (count($this->column_search_qc) - 1 == $i) {
                      $this->db->group_end();
                  }
              }
              $i++;
          }
          if (isset($_POST['order'])) {
              $this->db->order_by($this->column_order_qc[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
          } else if (isset($this->order_qc)) {
              $order = $this->order_qc;
              $this->db->order_by(key($order), $order[key($order)]);
          }
      }

      private function _query_serverside_qc_list($where = null){

        if(isset($where)) {
          $this->db->where($where);
        }

        $this->db->select('
          id_bnp,
          detail.id AS id,
          ps.id_activity AS id_activity,
          ps.id_paint_system AS id_paint_system,
          wp.workpack_no AS workpack_no,
          irn.report_number AS irn_report_number,
          irn.submission_id AS submission_id_irn,
          pc.drawing_ga AS drawing_ga,
          pc.drawing_as AS drawing_as,
          pc.drawing_sp AS drawing_sp,
          bnp.submission_id AS submission_id,
          bnp.request_no AS request_no,
          pc.part_id,
          mv.id_mis,
          id_detail_wp_paint_system,
          ps.id_workpack,
          categories_irn
        ');
         $this->db->from('pcms_bnp bnp');

         $this->db->join('pcms_workpack_paint_system ps', 'bnp.id_detail_wp_paint_system=ps.id_wp');

         $this->db->join('pcms_workpack_detail detail','detail.id = ps.id_workpack_detail');
         $this->db->join('pcms_workpack wp','wp.id = detail.id_workpack');
         $this->db->join('pcms_piecemark pc','pc.id = ps.id_template');
         $this->db->join('(
          SELECT
          submission_id,
          report_number,
          project_code,
          discipline,
          module,
          type_of_module,
          report_no_rev,
          id_mis,
          id_piecemark,
          status_inspection

          FROM pcms_material
          WHERE status_delete = 0 AND report_resubmit_status = 0
          
         ) mv','mv.id_piecemark = pc.id');
         $this->db->join('
          (SELECT 
          MAX(report_number) AS report_number, 
          MAX(submission_id) AS submission_id 
          FROM pcms_irn GROUP BY report_number) irn','irn.report_number = wp.irn_report_no');
        // $this->db->group_by('
        //   bnp.submission_id,
        //   ps.id_wp,
        // ');
        }

    public function bnp_request_list($where = null) {

      if(isset($where)) {
        $this->db->where($where);
      }

      $this->db->select('
        pc.part_id,
        pc.drawing_ga,
        pc.profile,
        bp.id_paint_system,
        wp.irn_report_no,
        irn.irn_description
      ');

      $this->db->from('pcms_bnp bp');
      $this->db->join('pcms_workpack_paint_system ps','ps.id_wp = bp.id_detail_wp_paint_system');
      $this->db->join('pcms_piecemark pc','pc.id = ps.id_template');
      $this->db->join('pcms_workpack wp','wp.id = ps.id_workpack');
      $this->db->join('pcms_irn irn','irn.report_number = wp.irn_report_no');
        $this->db->group_by('
        pc.part_id,
        pc.drawing_ga,
        pc.profile,
        bp.id_paint_system,
        wp.irn_report_no,
        irn.irn_description
      ');
      $query = $this->db->get(); 
      return $query->result_array();

    }
        
    // =======================================================================================
    var $column_order_rfi  = array(
      'CAST(MAX(project_id) AS TEXT)',
      'CAST(MAX(request_no) AS TEXT)',
      'CAST(MAX(report_number) AS TEXT)',
      'CAST(MAX(id_detail_wp_paint_system) AS TEXT)',
      'CAST(MAX(id_detail_wp_paint_system) AS TEXT)',
      'CAST(MAX(id_detail_wp_paint_system) AS TEXT)',
      'CAST(MAX(id_activity) AS TEXT)',
      'CAST(MAX(id_vendor) AS TEXT)',
      'CAST(MAX(invitation_by) AS TEXT)',
      'CAST(MAX(invitation_datetime) AS TEXT)',
      'CAST(MAX(invitation_datetime) AS TEXT)',
    );
    var $column_search_rfi = array(
      'CAST(project_id AS TEXT)',
      'CAST(request_no AS TEXT)',
      'CAST(report_number AS TEXT)',
      'CAST(id_detail_wp_paint_system AS TEXT)',
      'CAST(id_detail_wp_paint_system AS TEXT)',
      'CAST(id_detail_wp_paint_system AS TEXT)',
      'CAST(id_activity AS TEXT)',
      'CAST(id_vendor AS TEXT)',
      'CAST(invitation_by AS TEXT)',
      'CAST(invitation_datetime AS TEXT)',
      'CAST(invitation_datetime AS TEXT)',
    );
    var $order         = array('report_number' => 'DESC');
    
    public function serverside_rfi_list($where = null)
    {
      $this->_serverside_rfi_list($where);
      if ($_POST['length'] != -1) {
        $this->db->limit($_POST['length'], $_POST['start']);
      }
      $query = $this->db->get();
      return $query->result_array();
    }

    public function count_serverside_rfi_list_all($where = null)
    { 
      $this->_query_serverside_rfi_list($where);
      return $this->db->count_all_results();
    }


    public function count_serverside_rfi_list_filtered($where = null)
    {
      $this->_serverside_rfi_list($where);
      $query = $this->db->get();
      return $query->num_rows();
    }


    private function _serverside_rfi_list($where = null)
    {
      $this->_query_serverside_rfi_list($where);
      $i = 0;
      foreach ($this->column_search_rfi as $item) {
        if ($_POST['search']['value']) {
          if ($i === 0) {
            $this->db->group_start();
            $this->db->like($item, $_POST['search']['value']);
          } else {
            $this->db->or_like($item, $_POST['search']['value']);
          }
          if (count($this->column_search_rfi) - 1 == $i) {
            $this->db->group_end();
          }
        }
        $i++;
      }
      if (isset($_POST['order'])) {
        $this->db->order_by($this->column_order_rfi[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
      } else if (isset($this->order)) {
        $order = $this->order;
        $this->db->order_by(key($order), $order[key($order)]);
      }
    }

    private function _query_serverside_rfi_list($where = null){

      if(isset($where)){
        $this->db->where($where);
      }
      $this->db->select('
        pcms_bnp.report_number,
        pcms_bnp.project_id,
        pcms_bnp.id_paint_system,
        pcms_bnp.id_activity,
        pcms_bnp.transmittal_by,
        MAX(pcms_bnp.discipline) AS discipline,
        MAX(pcms_bnp.module) AS module,
        MAX(pcms_bnp.id_vendor) AS id_vendor,
        MAX(pcms_bnp.type_of_module) AS type_of_module,
        pcms_bnp.transmittal_date,
        pcms_bnp.status_inspection,
        pcms_bnp.transmittal_uniqid,
        MAX(pcms_bnp.attachment_status) AS attachment_status,
        MAX(pcms_bnp.status_invitation) AS status_invitation,
        MAX(pcms_bnp.id_detail_wp_paint_system) AS id_detail_wp_paint_system,
        MAX(pcms_bnp.invitation_by) AS invitation_by,
        MAX(pcms_bnp.invitation_datetime) AS invitation_datetime,
        MAX(pcms_bnp.submission_id) AS submission_id,
        MAX(pcms_bnp.request_no) AS request_no,

        pcms_workpack.company_id AS company_id,
      '); 
      $this->db->group_by('
        pcms_bnp.report_number,
        pcms_bnp.project_id,
        pcms_bnp.id_paint_system,
        pcms_bnp.id_activity,
        pcms_bnp.transmittal_by,
        pcms_bnp.transmittal_date,
        pcms_bnp.status_inspection,
        pcms_bnp.transmittal_uniqid,
        pcms_bnp.request_no,
        pcms_workpack.company_id,
      ');
      $this->db->from('pcms_bnp');
      $this->db->join('pcms_workpack_detail','pcms_bnp.workpack_detail_id = pcms_workpack_detail.id');
      $this->db->join('pcms_workpack','pcms_workpack_detail.id_workpack = pcms_workpack.id');
    }


    function get_material_itr($where = null, $limit = null){
      if(isset($where)){
        $this->db->where($where);
      }
      if(isset($limit)){
        $this->db->limit($limit);
      }
      $query = $this->db->get('pcms_itr');
      return $query->result_array();
    }

    function show_data_irn_material_v2_itr($where = null){
      if(isset($where)){
        $query = $this->db->where($where);
      }
      $query = $this->db->select(" 
          a.id as id,
          a.project as project,
          a.module as module,
          a.type_of_module as type_of_module,
          a.discipline as discipline,
          a.deck_elevation as deck_elevation,
          a.drawing_ga as drawing_ga,
          a.rev_ga as rev_ga,
          a.drawing_as as drawing_as,
          a.rev_as as rev_as,
          a.drawing_sp as drawing_sp,
          a.rev_sp as rev_sp, 
          a.part_id as part_id, 
          b.id_itr as id_material,
          b.id_piecemark as id_piecemark,
          b.id_mis as id_mis,
          b.submission_id as submission_id,
          b.report_number as report_number,
          b.status_inspection as status_inspection,
          c.report_number as irn_report_number, 
          c.status_inspection as irn_status_inspection,  
          c.submission_id as irn_submission_id,  
          c.id_irn as id_irn,  
          c.irn_description,
        ");
        
      $query = $this->db->where("c.category_irn",1);  
      $query = $this->db->order_by("c.id_irn","desc"); 
      $query = $this->db->join('pcms_irn c','a.id = c.id_piecemark',"LEFT"); 
      $query = $this->db->join('(SELECT id_itr,id_piecemark,id_mis,submission_id,report_number,status_inspection FROM pcms_itr WHERE status_delete <> 1 AND report_resubmit_status = 0) b','a.id = b.id_piecemark'); 
      $query = $this->db->get('pcms_piecemark a');
      return $query->result_array();
    }

  }

 

?>