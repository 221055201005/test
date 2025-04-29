<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification_mod extends CI_Model {

	public function __construct(){
	  parent::__construct(); 
	  $this->db_portal = $this->load->database('db_notif', TRUE); 
	  $this->db_user = $this->load->database('db_portal', TRUE); 
 	}

	 public function get_all_notification($where = null,$limit= null)
    { 
        if(isset($where)){
            $query = $this->db_portal->where($where);
        }
        if(isset($limit)){
            $query = $this->db_portal->limit($limit);
        }
        $query = $this->db_portal->order_by('portal_notification.id_notif', 'DESC'); 
        $query = $this->db_portal->get("portal_notification");
        return $query->result_array();
    }

    public function get_data_master_group_notif($where = null)
    { 
        if(isset($where)){
            $query = $this->db_portal->where($where);
        } 
        $query = $this->db_portal->get("master_group_notif");
        return $query->result_array();
    }

    public function update_status_notif($data, $where = null) {
        if(isset($where)){
             $this->db_portal->where($where);
        }
        return $this->db_portal->update("portal_notification", $data);
    }

    public function update_token_firebase($data, $where = null) {
        if(isset($where)){
             $this->db_user->where($where);
        }
        return $this->db_user->update("portal_user_db", $data);
    }

    public function get_token_firebase($where = null,$limit= null)
    { 
        if(isset($where)){
            $query = $this->db_user->where($where);
        }
        if(isset($limit)){
            $query = $this->db_user->limit($limit);
        } 
        $query = $this->db_user->get("portal_user_db");
        return $query->result_array();
    }
}
/*
	End Model Auth_mod
*/