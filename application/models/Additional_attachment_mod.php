<?php 

  class Additional_attachment_mod extends CI_Model {

    public function master_attachment_list($where = null, $order_by = null) {

      if(isset($where)) {
        $this->db->where($where);
      }

      if(isset($order_by)) {
        $this->db->order_by($order_by);
      }
			else{
				$this->db->order_by("id", "ASC");
			}

      $this->db->from('master_attachment');
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

      $this->db->from('pcms_additional_attachment');
      $query = $this->db->get(); 
      return $query->result_array();

    }

    public function insert_attachment($form_data) {
      $this->db->insert('pcms_additional_attachment', $form_data);
    }

    // ============================================================================
    // ============================================================================
    // ============================================================================
    var $column_order_additional_attachment    = array(
      'CAST(original_name AS varchar)',
      'CAST(deck_elevation AS varchar)',
      'CAST(ecodoc_no AS varchar)',
      'CAST(book_volume AS varchar)',
      'CAST(created_by AS varchar)',
      'CAST(created_date AS varchar)',
    );
    var $column_search_additional_attachment   = array(
      'CAST(original_name AS varchar)',
      'CAST(deck_elevation AS varchar)',
      'CAST(ecodoc_no AS varchar)',
      'CAST(book_volume AS varchar)',
      'CAST(created_by AS varchar)',
      'CAST(created_date AS varchar)',
    );
    var $order_additional_attachment           = array('id' => 'DESC');

    public function serverside_additional_attachment($where = NULL){
        $this->_serverside_additional_attachment($where);
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_serverside_additional_attachment_all($where = NULL){
        $this->_query_serverside_additional_attachment($where);
        return $this->db->count_all_results();
    }

    public function count_serverside_additional_attachment_filtered($where = NULL){
        $this->_serverside_additional_attachment($where);
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _serverside_additional_attachment($where = NULL)
    {
        $this->_query_serverside_additional_attachment($where);
        $i = 0;
        foreach ($this->column_search_additional_attachment as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_additional_attachment) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_additional_attachment[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_additional_attachment)) {
            $order = $this->order_additional_attachment;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    private function _query_serverside_additional_attachment($where = NULL){
      $this->db->select('*');
      if(isset($where)){
        $this->db->where($where);
      }
      $this->db->from('pcms_additional_attachment');
    }
    // ============================================================================
    // ============================================================================
    // ============================================================================

    public function update_attachment($data, $where) {
      $this->db->where($where);
      $this->db->update("pcms_additional_attachment", $data);
    }

    public function master_mdb_general_list($where = null, $order = null) {
      if(isset($where)) {
        $this->db->where($where);
      }

			if(isset($order)) {
				foreach ($order as $key => $value) {
					$this->db->order_by($key, $value, FALSE);
				}
			}
			
			// $this->db->order_by("volume::int", "ASC", FALSE);
			// $this->db->order_by("section::int", "ASC", FALSE);
			// $this->db->order_by("subsection::int", "ASC", FALSE);

      $this->db->from('master_mdb_general');
      $query = $this->db->get(); 
      return $query->result_array();
    }

    public function master_mdb_general_new_process($form_data) {
			$form_data = convert2null($form_data); 
      $this->db->insert('master_mdb_general', $form_data);
    }

    public function master_mdb_general_edit_process($form_data, $where) {
			$form_data = convert2null($form_data); 
      $this->db->where($where);
      $this->db->update('master_mdb_general', $form_data);
    }

  }

?>