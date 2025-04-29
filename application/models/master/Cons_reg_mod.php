<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cons_reg_mod extends CI_Model {

	public function __construct(){
	  parent::__construct();
		$this->db_wh      = $this->load->database('warehouse', TRUE);
		$this->db_portal  = $this->load->database('db_portal', TRUE);
		$this->db_eng     = $this->load->database('db_eng', TRUE); 
 	}

    public function master_consumable_register_list($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		$query = $this->db->order_by('a.id_register', 'asc');
		$query = $this->db->join('master_detail_cons_register b',"a.id_register = b.id_register");
		$query = $this->db->get('master_consumable_register a');
		return $query->result_array();
	}

	public function master_consumable_register($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		$query = $this->db->order_by('id_register', 'asc');
		$query = $this->db->get('master_consumable_register');
		return $query->result_array();
	}

    public function master_detail_cons_register($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		$query = $this->db->order_by('id_detail_register', 'asc');
		$query = $this->db->get('master_detail_cons_register');
		return $query->result_array();
	} 

    public function get_wps_active_list($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		} 
		$query = $this->db->get('master_wps');
		return $query->result_array();
	}

    public function master_detail_cons_wps_register($where = null){
		if(isset($where)){
			$query = $this->db->where($where);
		}
		$query = $this->db->order_by('a.id_cons_wps', 'asc');
        $query = $this->db->join('master_wps b',"a.id_wps = b.id_wps");
		$query = $this->db->get('master_detail_cons_wps_register a');
		return $query->result_array();
	}


    public function insert_master_consumable_register($data) {
		convert2null($data);
		$this->db->insert('master_consumable_register', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

    public function insert_master_detail_cons_register($data) {
		convert2null($data);
		$this->db->insert('master_detail_cons_register', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

    public function insert_master_detail_cons_wps_register($data) {
		convert2null($data);
		$this->db->insert('master_detail_cons_wps_register', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

    public function update_master_consumable_register($data, $where) {
		convert2null($data);
		$this->db->where($where);
		$this->db->update('master_consumable_register', $data);
	}

    public function update_master_detail_cons_register($data, $where) {
		convert2null($data);
		$this->db->where($where);
		$this->db->update('master_detail_cons_register', $data);
	}

    public function update_master_detail_cons_wps_register($data, $where) {
		convert2null($data);
		$this->db->where($where);
		$this->db->update('master_detail_cons_wps_register', $data);
	}

    
	public function wps_delete_update_data($where){
	    $this->db->where($where);
	    $this->db->delete('master_detail_cons_wps_register');
	}

  
}
/*
End Model Auth_mod
*/