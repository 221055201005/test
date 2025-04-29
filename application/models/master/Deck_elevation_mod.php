<?php 

  Class Deck_elevation_mod extends CI_Model {

    public function deck_elevation_list($where = null) {
      if(isset($where)) {
        $this->db->where($where);
      }

      $this->db->from('master_deck_elevation');
      $this->db->order_by('id ASC');
      $query = $this->db->get(); 
      return $query->result_array();
    }

    public function insert_deck_elevation($form_data) {
      $this->db->insert('master_deck_elevation', $form_data);
    }

    public function update_deck_elevation($form_data, $where = null) {
      if(isset($where)) {
        $this->db->where($where);
      }

      $this->db->update('master_deck_elevation', $form_data);
    }

  }

?>