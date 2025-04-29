<?php 

  Class Location_mod extends CI_Model {

    public function location_list($where = null) {
      if(isset($where)) {
        $this->db->where($where);
      }

      $this->db->from('master_location_v2');
      $this->db->order_by('id ASC');
      $query = $this->db->get(); 
      return $query->result_array();
    }

    public function insert_location($form_data) {
      $this->db->insert('master_location_v2', $form_data);
    }

    public function update_location($form_data, $where = null) {
      if(isset($where)) {
        $this->db->where($where);
      }

      $this->db->update('master_location_v2', $form_data);
    }

  }

?>