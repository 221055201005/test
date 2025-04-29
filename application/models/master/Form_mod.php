<?php 

  class Form_mod extends CI_Model {
    
    public function  __construct()
    {
      parent::__construct();
      $this->quality      = $this->load->database('quality', TRUE);
    }

    public function form_register_list($where = null, $order_by = null) {
      if(isset($where)) {
        $this->quality->where($where);
      }

      if(isset($order_by)) {
        $this->quality->order_by($order_by);
      }

      $query = $this->quality->get(); 
      return $query->result_array();
    }

    public function form_register_join($where = null, $order_by = null) {
      if(isset($where)) {
        $this->quality->where($where);
      }

      if(isset($order_by)) {
        $this->quality->order_by($order_by);
      }

      $this->quality->from('quality_form_register main');
      $this->quality->join('quality_form_project_assign detail','detail.form_id = main.id');
      $query = $this->quality->get(); 
      return $query->result_array();
    }

  }

?>