<?php 

  Class Rfi_mod extends CI_Model {

    var $column_order_rfi_mv  = array('project_code','report_number','report_number','drawing_no','MAX(transmittal_datetime)','total_item','report_number');
    var $column_search_rfi_mv = array('project_code','report_number','report_number','drawing_no','transmittal_datetime');
    var $order_rfi_mv         = array('report_number' => 'DESC');
    
    public function serverside_rfi_mv($where = null)
    {
        $this->_serverside_rfi_mv($where);
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_serverside_rfi_mv_all($where = null)
    {
        $this->_query_serverside_rfi_mv($where);
        return $this->db->count_all_results();
    }


    public function count_serverside_rfi_mv_filtered($where = null)
    {
        $this->_serverside_rfi_mv($where);
        $query = $this->db->get();
        return $query->num_rows();
    }


    private function _serverside_rfi_mv($where = null)
    {
        $this->_query_serverside_rfi_mv($where);
        $i = 0;
        foreach ($this->column_search_rfi_mv as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
                } else {
                    $this->db->or_like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
                }
                if (count($this->column_search_rfi_mv) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_rfi_mv[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_rfi_mv)) {
            $order = $this->order_rfi_mv;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    private function _query_serverside_rfi_mv($where = null){
        if(isset($where)) {
            $this->db->where($where);
        }

        $this->db->select('
          mv.project_code,
          mv.discipline,
          mv.module,
          mv.type_of_module,
          mv.report_number,
          mv.drawing_no,
          MAX(mv.transmittal_datetime) AS transmittal_datetime,
          wp.company_id,
          report_no_rev,
          COUNT(id_material) AS total_item
        ');
        $this->db->from('pcms_material mv');
        $this->db->join('(SELECT id, company_id, deck_elevation FROM pcms_workpack) wp','wp.id = mv.id_workpack');
        $this->db->group_by('
        project_code, report_number, drawing_no, discipline, module, type_of_module, deck_elevation, report_no_rev, wp.company_id
        ');
        
    }

    var $column_order_rfi_vs  = array('project_code','report_number','report_number','drawing_no','MAX(transmittal_datetime)','total_item','report_number');
    var $column_search_rfi_vs = array('project_code','report_number','report_number','drawing_no','transmittal_datetime');
    var $order_rfi_vs         = array('report_number' => 'DESC');
    
    public function serverside_rfi_vs($where = null)
    {
        $this->_serverside_rfi_vs($where);
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_serverside_rfi_vs_all($where = null)
    {
        $this->_query_serverside_rfi_vs($where);
        return $this->db->count_all_results();
    }


    public function count_serverside_rfi_vs_filtered($where = null)
    {
        $this->_serverside_rfi_vs($where);
        $query = $this->db->get();
        return $query->num_rows();
    }


    private function _serverside_rfi_vs($where = null)
    {
        $this->_query_serverside_rfi_vs($where);
        $i = 0;
        foreach ($this->column_search_rfi_vs as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
                } else {
                    $this->db->or_like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
                }
                if (count($this->column_search_rfi_vs) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_rfi_vs[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_rfi_vs)) {
            $order = $this->order_rfi_vs;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    private function _query_serverside_rfi_vs($where = null){
        if(isset($where)) {
            $this->db->where($where);
        }

        $this->db->select('
          vs.project_code,
          vs.discipline,
          vs.module,
          vs.type_of_module,
          vs.report_number,
          vs.drawing_no,
          MAX(vs.transmittal_datetime) AS transmittal_datetime,
          wp.company_id,
          postpone_reoffer_no,
          COUNT(id_visual) AS total_item
        ');
        $this->db->from('pcms_visual vs');
        $this->db->join('(SELECT id, company_id FROM pcms_workpack) wp','wp.id = vs.id_workpack');
        $this->db->group_by('
        project_code, 
        report_number, 
        drawing_no, 
        discipline, 
        module, 
        type_of_module, 
        postpone_reoffer_no, 
        wp.company_id
        ');
        
    }

    var $column_order_rfi_ft  = array('project_code','report_number','report_number','drawing_no','MAX(transmitted_date)','total_item','report_number');
    var $column_search_rfi_ft = array('project_code','report_number','report_number','drawing_no','transmitted_date');
    var $order_rfi_ft         = array('report_number' => 'DESC');
    
    public function serverside_rfi_ft($where = null)
    {
        $this->_serverside_rfi_ft($where);
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_serverside_rfi_ft_all($where = null)
    {
        $this->_query_serverside_rfi_ft($where);
        return $this->db->count_all_results();
    }


    public function count_serverside_rfi_ft_filtered($where = null)
    {
        $this->_serverside_rfi_ft($where);
        $query = $this->db->get();
        return $query->num_rows();
    }


    private function _serverside_rfi_ft($where = null)
    {
        $this->_query_serverside_rfi_ft($where);
        $i = 0;
        foreach ($this->column_search_rfi_ft as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
                } else {
                    $this->db->or_like('CAST('.$item.' AS VARCHAR)', $_POST['search']['value']);
                }
                if (count($this->column_search_rfi_ft) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_rfi_ft[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_rfi_ft)) {
            $order = $this->order_rfi_ft;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    private function _query_serverside_rfi_ft($where = null){
        if(isset($where)) {
            $this->db->where($where);
        }

        $this->db->select('
          ft.project_code,
          ft.discipline,
          ft.module,
          ft.type_of_module,
          ft.report_number,
          ft.drawing_no,
          MAX(ft.transmitted_date) AS transmittal_datetime,
          wp.company_id,
          postpone_reoffer_no,
          COUNT(id_fitup) AS total_item
        ');
        $this->db->from('pcms_fitup ft');
        $this->db->join('(SELECT id, company_id, deck_elevation FROM pcms_workpack) wp','wp.id = ft.id_workpack');
        $this->db->group_by('
        project_code, 
        report_number, 
        drawing_no, 
        discipline, 
        module, 
        deck_elevation,
        type_of_module, 
        postpone_reoffer_no, 
        wp.company_id
        ');
        
    }
    


  }

?>