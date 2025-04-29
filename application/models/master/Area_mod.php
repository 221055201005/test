<?php 

  Class Area_mod extends CI_Model {

    public function area_list($where = null) {
      if(isset($where)) {
        $this->db->where($where);
      }

      $this->db->from('master_area_v2');
      $this->db->order_by('id ASC');
      $query = $this->db->get(); 
      return $query->result_array();
    }

    public function insert_area($form_data) {
      $this->db->insert('master_area_v2', $form_data);
    }

    public function update_area($form_data, $where = null) {
      if(isset($where)) {
        $this->db->where($where);
      }

      $this->db->update('master_area_v2', $form_data);
    }

  }

?>