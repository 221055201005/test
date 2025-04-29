<?php 

  class Mts_mod extends CI_Model {

    var $column_order_drawing_list   = array('project','drawing_ga','discipline','module','type_of_module','drawing_ga', 'deck_elevation');
    var $column_search_drawing_list  = array('drawing_ga');
    var $order_drawing_list          = array('drawing_ga' => 'DESC');
    
    public function serverside_drawing_list($where = null)
    {
        $this->_serverside_drawing_list($where);
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_serverside_drawing_list_all($where = null)
    {
        $this->_query_serverside_drawing_list($where);
        return $this->db->count_all_results();
    }


    public function count_serverside_drawing_list_filtered($where = null)
    {
        $this->_serverside_drawing_list($where);
        $query = $this->db->get();
        return $query->num_rows();
    }


    private function _serverside_drawing_list($where = null)
    {
        $this->_query_serverside_drawing_list($where);
        $i = 0;
        foreach ($this->column_search_drawing_list as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
                } else {
                    $this->db->or_like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
                }
                if (count($this->column_search_drawing_list) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_drawing_list[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_drawing_list)) {
            $order = $this->order_drawing_list;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    private function _query_serverside_drawing_list($where = null){

      if(isset($where)) {
        $this->db->where($where);
      }

      $this->db->select('project, drawing_ga, discipline, module, type_of_module, deck_elevation');
      $this->db->from('pcms_piecemark');
      $this->db->group_by('project, drawing_ga, discipline, module, type_of_module, deck_elevation');
    }

    public function mts_signed_list($where = null, $order_by = null) {

      if(isset($where)) {
        $this->db->where($where);
      }

      if(isset($order_by)) {
        $this->db->order_by($order_by);
      }

      $this->db->from('pcms_mts_signed');
      $query = $this->db->get(); 
      return $query->result_array();

    }

    public function insert_mts_signed($form_data) {
      $this->db->insert('pcms_mts_signed', $form_data);
    }

    public function update_mts_signed($form_data, $where = null) {
      if(isset($where)) {
        $this->db->where($where);
      }

      $this->db->update('pcms_mts_signed', $form_data);
    }

    public function mts_signed_join($where = null, $order_by = null) {
      if(isset($where)) {
        $this->db->where($where);
      }

      if(isset($order_by)) {
        $this->db->order_by($order_by);
      }

      $this->db->from('pcms_mts_signed a');
      $this->db->join('pcms_piecemark b','b.id = a.id_piecemark','LEFT');
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


    public function mts_approval_list($where = null, $order_by = null) {

      if(isset($where)) {
        $this->db->where($where);
      }

      if(isset($order_by)) {
        $this->db->order_by($order_by);
      }

      $this->db->select('
        uniq_id,
        drawing_no,
        MAX(id_piecemark) AS id_piecemark,
        company_id,
        project,
        discipline,
        module,
        type_of_module,
        submission_id,
        status_inspection,
        client_remarks,
        postpone_reoffer_no,
        MAX(created_date) AS created_date
      ');

      $this->db->from('pcms_mts_signed');
      $this->db->join('(
        SELECT id AS id_pc, deck_elevation FROM pcms_piecemark
      ) pc','pc.id_pc = id_piecemark');
      $this->db->group_by('
        uniq_id,
        drawing_no,
        company_id,
        project,
        discipline,
        module,
        type_of_module,
        submission_id,
        status_inspection,
        client_remarks,
        postpone_reoffer_no');

      $query = $this->db->get(); 
      return $query->result_array();
    }

    public function attachment_history_list($where = null, $order_by = null) {

      if(isset($where)) {
        $this->db->where($where);
      }

      if(isset($order_by)) {
        $this->db->order_by($order_by);
      }

      $this->db->from('pcms_attachment_history');
      $query = $this->db->get(); 
      return $query->result_array();

    }

    public function insert_attachment_history($form_data) {
      $this->db->insert('pcms_attachment_history', $form_data);
    }

    public function delete_attachment_history($where = null) {
      if(isset($where)) {
        $this->db->where($where);
        $this->db->delete('pcms_attachment_history');
      }
    }
  }

?>