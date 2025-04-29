<?php 

  class Consumable_mod extends CI_Model {
    
    public function  __construct()
    {
      parent::__construct();
      $this->db_wh      = $this->load->database('warehouse', TRUE);

    }

    public function consumable_list($where = null, $order_by = null) {

      if(isset($where)) {
        $this->db->where($where);
      }

      if(isset($order_by)) {
        $this->db->order_by($order_by);
      }

      $this->db->from('master_cons_lot_no');
      $query = $this->db->get(); 
      return $query->result_array();

    }

    public function consumable_list_detail($where = null, $order_by = null) {

      if(isset($where)) {
        $this->db->where($where);
      }

      if(isset($order_by)) {
        $this->db->order_by($order_by);
      }

      $this->db->from('master_cons_lot_no_detail');
      $query = $this->db->get(); 
      return $query->result_array();

    }

    public function qcs_material_list($where = null, $order_by = null) {

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

    public function material_consumable_list($where = null, $order_by = null) {

      if(isset($where)) {
        $this->db_wh->where($where);
      }

      if(isset($order_by)) {
        $this->db_wh->order_by($order_by);
      }

      $this->db_wh->from('pcms_wm_material_consumable');
      $query = $this->db_wh->get(); 
      return $query->result_array();

    }

    public function master_wh_brand($where = null, $order_by = null) {

      if(isset($where)) {
        $this->db_wh->where($where);
      }

      if(isset($order_by)) {
        $this->db_wh->order_by($order_by);
      }

      $this->db_wh->from('master_brand');
      $query = $this->db_wh->get(); 
      return $query->result_array();

    }


    function lot_no_list($where = null, $order_by = null, $limit = null) {
      if(isset($where)) {
        $this->db_wh->where($where);
      }

      if(isset($order_by)) {
        $this->db_wh->order_by($order_by);
      }

      if(isset($limit)) {
        $this->db_wh->limit($limit);
      }
      $this->db_wh->select('heat_or_series_no');
      $this->db_wh->from('qcs_material');
      $this->db_wh->group_by('heat_or_series_no');

      $query = $this->db_wh->get(); 
      return $query->result_array();
    }

    public function insert_consumable_lot_no($form_data) {
      $this->db->insert('master_cons_lot_no', $form_data);
      return $this->db->insert_id();
    }

    public function insert_consumable_lot_no_detail($form_data) {
      $this->db->insert('master_cons_lot_no_detail', $form_data);
      return $this->db->insert_id();
    }

  }

?>