<?php 

  class Welder_activity_mod extends CI_Model {

    public function  __construct()
    {
      parent::__construct();
      $this->iss      = $this->load->database('db_iss', TRUE);
    }

    public function master_weld_category($where = null, $order_by = null) {
      if(isset($where)) {
        $this->db->where($where);
      }

      if(isset($order_by)) {
        $this->db->order_by($order_by);
      }

      $this->db->from('wa_weld_category');
      $query = $this->db->get(); 
      return $query->result_array();
    }

    public function welder_activity_list($where = null, $order_by = null) {

      if(isset($where)) {
        $this->db->where($where);
      }

      if(isset($order_by)) {
        $this->db->order_by($order_by);
      }

      $this->db->from('wa_welder_activity');
      $query = $this->db->get(); 
      return $query->result_array();

    }

    public function welder_activity_join($where = null, $order_by = null) {

      if(isset($where)) {
        $this->db->where($where);
      }

      if(isset($order_by)) {
        $this->db->order_by($order_by);
      }

      $this->db->from('wa_welder_activity act');
      $this->db->join('master_welder welder','welder.id_welder = act.id_welder');
      $query = $this->db->get(); 
      return $query->result_array();

    }

    public function weld_length_activity($where = null, $order_by = null) {

      if(isset($where)) {
        $this->db->where($where);
      }

      if(isset($order_by)) {
        $this->db->order_by($order_by);
      }

      $this->db->from('wa_weld_length_activity');
      $query = $this->db->get(); 
      return $query->result_array();

    }
    public function data_tvs($where = null, $order_by = null) {

        if(isset($where)) {
          $this->iss->where($where);
          $this->iss->from('iss_time_verify');
          $query = $this->iss->get(); 
          return $query->result_array();
        }

    }

    public function welder_attendance_list($where = null, $order_by = null) {
      if(isset($where)) {
        $this->iss->where($where);
      }

      if(isset($order_by)) {
        $this->iss->order_by($order_by);
      }

      $this->iss->from('iss_welder_attendance');
      $query = $this->iss->get(); 
      return $query->result_array();
    }

    public function total_welder_attendance($where = null) {
      if(isset($where)) {
        $this->iss->where($where);
      }

      if(isset($order_by)) {
        $this->iss->order_by($order_by);
      }

      $this->iss->select('
        COUNT(CASE WHEN status_active = 1 THEN 1 END) AS total_active,
        COUNT(CASE WHEN status_attendance = 0 AND status_active = 1 THEN 1 END) AS total_attendance
      
      ');
      $this->iss->from('iss_welder_attendance');
      $query = $this->iss->get(); 
      return $query->result_array();
    }

    public function total_welder_activity($where = null) {
      if(isset($where)) {
        $this->db->where($where);
      }

      $this->db->select('
        COUNT(distinct id_welder) AS total_welder
      ');
      $this->db->from('wa_welder_activity');
      $query = $this->db->get(); 
      return $query->result_array();
    }

    public function transfer_welder_list($where = null, $order_by = null) {
      if(isset($where)) {
        $this->db->where($where);
      }

      if(isset($order_by)) {
        $this->db->order_by($order_by);
      }

      $this->db->from('wa_transfer_welder');
      $query = $this->db->get(); 
      return $query->result_array();
    }

    // SERVERSIDE TRANSFER WELDER

    var $column_order_transfer_welder  = array('created_by','created_date','id_foreman_from','id_foreman_to','remarks','welder_badge','welder_code','welder_name','status_request');
    var $column_search_transfer_welder = array('welder_badge','welder_code','welder_name','remarks','created_date');
    var $order_transfer_welder         = array('id' => 'DESC');
    
    public function serverside_transfer_welder($where = null)
    {
        $this->_serverside_transfer_welder($where);
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_serverside_transfer_welder_all($where = null)
    {
        $this->_query_serverside_transfer_welder($where);
        return $this->db->count_all_results();
    }


    public function count_serverside_transfer_welder_filtered($where = null)
    {
        $this->_serverside_transfer_welder($where);
        $query = $this->db->get();
        return $query->num_rows();
    }


    private function _serverside_transfer_welder($where = null)
    {
        $this->_query_serverside_transfer_welder($where);
        $i = 0;
        foreach ($this->column_search_transfer_welder as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
                } else {
                    $this->db->or_like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
                }
                if (count($this->column_search_transfer_welder) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_transfer_welder[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_transfer_welder)) {
            $order = $this->order_transfer_welder;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    private function _query_serverside_transfer_welder($where = null){
        if(isset($where)) {
            $this->db->where($where);
        }

        $this->db->from('wa_transfer_welder tf');
        $this->db->join('master_welder welder','welder.id_welder = tf.id_welder');
    }

     // SERVERSIDE WELDER ACTIVITY

     var $column_order_activity_list  = array('activity.created_date','id_spv','created_by','welder_badge','welder_name','welder_code','id_weld_category','id_wp','job_no','weld_map','joint_no','activity_desc','total_length','status_complete');
     var $column_search_activity_list = array('activity.created_date','workpack_no','wp_no','job_no','drawing_wm','joint_no','activity_desc','welder_badge','welder_name','welder_code');
     var $order_activity_list         = array('activity.id' => 'DESC');
     
     public function serverside_activity_list($where = null)
     {
         $this->_serverside_activity_list($where);
         if ($_POST['length'] != -1) {
             $this->db->limit($_POST['length'], $_POST['start']);
         }
         $query = $this->db->get();
         return $query->result_array();
     }
 
     public function count_serverside_activity_list_all($where = null)
     {
         $this->_query_serverside_activity_list($where);
         return $this->db->count_all_results();
     }
 
 
     public function count_serverside_activity_list_filtered($where = null)
     {
         $this->_serverside_activity_list($where);
         $query = $this->db->get();
         return $query->num_rows();
     }
 
 
     private function _serverside_activity_list($where = null)
     {
         $this->_query_serverside_activity_list($where);
         $i = 0;
         foreach ($this->column_search_activity_list as $item) {
             if ($_POST['search']['value']) {
                 if ($i === 0) {
                     $this->db->group_start();
                     $this->db->like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
                 } else {
                     $this->db->or_like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
                 }
                 if (count($this->column_search_activity_list) - 1 == $i) {
                     $this->db->group_end();
                 }
             }
             $i++;
         }
         if (isset($_POST['order'])) {
             $this->db->order_by($this->column_order_activity_list[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
         } else if (isset($this->order_activity_list)) {
             $order = $this->order_activity_list;
             $this->db->order_by(key($order), $order[key($order)]);
         }
     }
 
     private function _query_serverside_activity_list($where = null){
         if(isset($where)) {
             $this->db->where($where);
         }
         $this->db->from('wa_welder_activity activity');
         $this->db->join('master_welder welder','welder.id_welder = activity.id_welder');
         $this->db->join('(SELECT id AS id_workpack, workpack_no FROM pcms_workpack) wp','wp.id_workpack = activity.id_wp', 'LEFT');
         $this->db->join('(SELECT id_welder_activity, SUM(total_length) AS total_length FROM wa_weld_length_activity WHERE status_delete = 1 GROUP BY id_welder_activity) detail','detail.id_welder_activity = activity.id','LEFT');
         $this->db->join('(SELECT id AS id_joint, joint_no, drawing_wm FROM pcms_joint) joint','joint.id_joint = activity.id_joint', 'LEFT');
     }

     public function weekly_welder_assignment($where = null) {

      if(isset($where)) {
        $this->db->where($where);
      }

      $this->db->select("
        COUNT(distinct id_welder) AS total_welder,
        date_trunc('week', created_date) AS week_date,
        SUM(total_length) AS total_length
      ");
      $this->db->from('wa_welder_activity activity');
      $this->db->join('(SELECT total_length, id_welder_activity FROM wa_weld_length_activity) detail','detail.id_welder_activity = activity.id','LEFT');
      $this->db->group_by('week_date');

      $query = $this->db->get(); 
      return $query->result_array();

     }
     
     public function welder_attendance_summary($where = null) {

      if(isset($where)) {
        $this->iss->where($where);
      }

      $this->iss->select("
        COUNT(badge) AS total_welder,
        COUNT(CASE WHEN status_attendance = 0 AND status_active = 1 THEN 1 END) AS total_attendance,
        date_trunc('week', attendance_date) AS week_date,
      ");
      $this->iss->from('iss_welder_attendance');
      $this->iss->group_by('week_date');

      $query = $this->iss->get(); 
      return $query->result_array();

     }

     public function summary_welder_manhours($where = null) {

      if(isset($where)) {
        $this->iss->where($where);
      }

      $this->iss->select("
        COUNT(badge) AS total_welder,
        COUNT(CASE WHEN status_attendance = 0 AND status_active = 1 THEN 1 END) AS total_attendance,
        date_trunc('week', attendance_date) AS week_date,
        SUM(difference) AS total_manhours
      ");
      $this->iss->from('welder_attendance_status');
      $this->iss->group_by('week_date');

      $query = $this->iss->get(); 
      return $query->result_array();

     }

     public function foreman_weekly_summary($where = null) {

      if(isset($where)) {
        $this->db->where($where);
      }

      $this->db->select("
        created_by,
        COUNT(distinct id_welder) AS total_welder,
        date_trunc('week', created_date) AS week_date,
        SUM(total_length) AS total_length
      ");
      $this->db->from('wa_welder_activity activity');
      $this->db->join('(SELECT total_length, id_welder_activity FROM wa_weld_length_activity) detail','detail.id_welder_activity = activity.id','LEFT');
      $this->db->group_by('created_by, week_date');

      $query = $this->db->get(); 
      return $query->result_array();

     }

     public function spv_weekly_summary($where = null) {

      if(isset($where)) {
        $this->db->where($where);
      }

      $this->db->select("
        id_spv,
        COUNT(distinct created_by) AS total_foreman,
        COUNT(distinct id_welder) AS total_welder,
        date_trunc('week', created_date) AS week_date,
        SUM(total_length) AS total_length
      ");
      $this->db->from('wa_welder_activity activity');
      $this->db->join('(SELECT total_length, id_welder_activity FROM wa_weld_length_activity) detail','detail.id_welder_activity = activity.id','LEFT');
      $this->db->group_by('id_spv, week_date');

      $query = $this->db->get(); 
      return $query->result_array();

     }


     public function supervisor_list($where = null) {
      if(isset($where)) {
        $this->db->where($where);
      }

      $this->db->select('id_spv');
      $this->db->from('wa_welder_activity');
      $this->db->group_by('id_spv');
      $query = $this->db->get(); 
      return $query->result_array();
     }

     public function foreman_list($where = null) {
      if(isset($where)) {
        $this->db->where($where);
      }

      $this->db->select('created_by');
      $this->db->from('wa_welder_activity');
      $this->db->group_by('created_by');
      $query = $this->db->get(); 
      return $query->result_array();
     }
 
     public function transfer_requestor_list($where = null) {
      if(isset($where)) {
        $this->db->where($where);
      }

      $this->db->select('created_by');
      $this->db->from('wa_transfer_welder');
      $this->db->group_by('created_by');
      $query = $this->db->get(); 
      return $query->result_array();
     }


  }

?>