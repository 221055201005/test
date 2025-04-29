<?php 

  Class Class_mod extends CI_Model {

    public function class_list($where = null) {
      if(isset($where)) {
        $this->db->where($where);
      }

      $this->db->from('master_class');
      $this->db->order_by('id ASC');
      $query = $this->db->get(); 
      return $query->result_array();
    }

    public function insert_class($form_data) {
      $this->db->insert('master_class', $form_data);
    }

    public function update_class($form_data, $where = null) {
      if(isset($where)) {
        $this->db->where($where);
      }

      $this->db->update('master_class', $form_data);
    }

  }

?>