<?php 

  class Public_mod extends CI_Model {

    public function __construct()
    {
      $this->iss          = $this->load->database('db_iss', TRUE);
      $this->ingress      = $this->load->database('ingress', TRUE);
      
    }

    public function new_delete_ingress_data($where = null){
      if(isset($where)) {
        $this->iss->where($where);
      }
      $this->iss->delete('iss_welder_ingress');
    }

    public function new_get_ingress_data($where = null){

      if(isset($where)) {
        $this->ingress->where($where);
      }

      $this->ingress->where("userid !=","0");
      $this->ingress->from('device_transaction_log');

      $query = $this->ingress->get(); 
      return $query->result_array();
    }

    public function insert_ingress_welder($form_data) {
      $this->iss->insert('iss_welder_ingress', $form_data);
    }

    public function check_time_in($date,$userid) {
      $this->iss->select("
          CASE WHEN MAX(cast(checktime as time))> '17:00:00' THEN MAX(checktime) ELSE MIN(checktime) END AS time_in,
          MAX(checktime) as time_in_withoutcase
      ");
      $this->iss->from('iss_welder_ingress');        
      $this->iss->where("checktype","0");
      $this->iss->where("TO_DATE(CAST(checktime as TEXT), 'YYYY-MM-DD') =",$date);
      $this->iss->where("cast(checktime as time) > '04:00:00'");
      $this->iss->where("userid",$userid);
      $query = $this->iss->get();
      return $query->row_array();

  }
  public function check_time_out($date, $userid, $check_in) {
    $data_checkin = date("H:i:s",strtotime($check_in));
    if($data_checkin >= '14:00:00'){
      $date1 = date('Y-m-d',strtotime($date));
      $this->iss->select("COUNT(checktime) as time_out");
      $this->iss->where("TO_DATE(CAST(checktime as TEXT), 'YYYY-MM-DD') =",$date);
      $this->iss->where("userid",$userid);
      $this->iss->where("cast(checktime as time) > '09:00:00' ");
      $this->iss->where("checktype = '1'");
      $query = $this->iss->get("iss_welder_ingress");
      $total_data_normal = $query->row_array();

      if($total_data_normal["time_out"] > 0){

      $date1 = date('Y-m-d',strtotime($date));
       $this->iss->select("max(checktime) as time_out");
       $this->iss->where("TO_DATE(CAST(checktime as TEXT), 'YYYY-MM-DD') =",$date1);
       $this->iss->where("userid",$userid);
      $query = $this->iss->get("iss_welder_ingress");
      return $query->row_array();

          } else { 

       $date1 = date('Y-m-d',strtotime($date . "+1 days"));
       $this->iss->select("min(checktime) as time_out");
      $this->iss->where("TO_DATE(CAST(checktime as TEXT), 'YYYY-MM-DD') =",$date1);
      $this->iss->where("userid",$userid);

      $query = $this->iss->get("iss_welder_ingress");
      $data_timeout = $query->row_array();
    

        if($data_timeout['time_out'] == $data_checkin OR empty($data_timeout['time_out'])){

            $date1 = date('Y-m-d',strtotime($date));
           $this->iss->select("max(checktime) as time_out");
           $this->iss->where("TO_DATE(CAST(checktime as TEXT), 'YYYY-MM-DD') =",$date1);
           $this->iss->where("userid",$userid);

          $query = $this->iss->get("iss_welder_ingress");
          return $query->row_array();

        } else {

            $date1 = date('Y-m-d',strtotime($date . "+1 days"));
           $this->iss->select("min(checktime) as time_out");
          $this->iss->where("TO_DATE(CAST(checktime as TEXT), 'YYYY-MM-DD') =",$date1);
          $this->iss->where("userid",$userid);

          $query = $this->iss->get("iss_welder_ingress");
          return $query->row_array();

        }

    }


   } else {

       $date1 = date('Y-m-d',strtotime($date));
       $this->iss->select("max(checktime) as time_out");
       $this->iss->where("TO_DATE(CAST(checktime as TEXT), 'YYYY-MM-DD') =",$date1);
       $this->iss->where("userid",$userid);

      $query = $this->iss->get("iss_welder_ingress");
      return $query->row_array();

    }    
  }

  public function check_time_out_no_checkin($date,$userid) {  
    $date1 = date('Y-m-d',strtotime($date)); 
    $this->iss->select("min(checktime) as time_out"); 
    $this->iss->where("TO_DATE(CAST(checktime as TEXT), 'YYYY-MM-DD') =",$date1); 
    $this->iss->where("checktype","1"); 
    $this->iss->where("userid",$userid); 
    $query = $this->iss->get("iss_welder_ingress"); 
    $data_timeout = $query->row_array(); 
    if(isset($data_timeout['time_out'])){ 
      $date1 = date('Y-m-d',strtotime($date)); 
        $this->iss->select("max(checktime) as time_out"); 
        $this->iss->where("TO_DATE(CAST(checktime as TEXT), 'YYYY-MM-DD') =",$date1); 
        $this->iss->where("checktype","1"); 
        $this->iss->where("userid",$userid); 
      $query = $this->iss->get("iss_welder_ingress"); 
      return $query->row_array(); 
    } else { 
      $date1 = date('Y-m-d',strtotime($date . "+1 days")); 
        $this->iss->select("min(checktime) as time_out"); 
      $this->iss->where("TO_DATE(CAST(checktime as TEXT), 'YYYY-MM-DD') =",$date1); 
      $this->iss->where("checktype","1"); 
      $this->iss->where("userid",$userid); 
      $query = $this->iss->get("iss_welder_ingress"); 
      return $query->row_array(); 
    }   
  } 

  function passing_time_in_missing($date,$userid) {
    $this->iss->select("min(checktime) as time_in");
    $this->iss->from('iss_welder_ingress');
    $this->iss->where("TO_DATE(CAST(checktime as TEXT), 'YYYY-MM-DD') =",$date);
    $this->iss->where("userid",$userid);
    $query = $this->iss->get();
    return $query->result_array();
  }

  public function check_time_out_night($date,$userid){
    $date1 = date('Y-m-d',strtotime($date . "+1 days"));
    $this->iss->select("min(checktime) as time_out");
    $this->iss->where("TO_DATE(CAST(checktime as TEXT), 'YYYY-MM-DD') =",$date1);
    $this->iss->where("checktype","1");
    $this->iss->where("userid",$userid);

    $query = $this->iss->get("iss_welder_ingress");
    return $query->row_array();
  }

  public function welder_attendance_list($where = null, $order_by = null) {

    if(isset($order_by)) {
      $this->iss->order_by($order_by);
    }

    if(isset($where)) {
      $this->iss->where($where);
    }

    $this->iss->from('iss_welder_attendance');
    $query = $this->iss->get(); 
    return $query->result_array();

  }

  public function insert_welder_attendance($form_data) {
    $this->iss->insert('iss_welder_attendance', $form_data);
  }

  public function update_attendance_welder($form_data, $where = null) {
    if(isset($where)) {
      $this->iss->where($where);
      $this->iss->update('iss_welder_attendance', $form_data);
    }
  }



}

?>