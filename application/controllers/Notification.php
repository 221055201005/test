<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

	public function __construct() {
			
		parent::__construct();
		$this->load->helper('browser');
		$this->load->helper('cookies');
		$data_cookies = helper_cookies(@$this->input->get('user'));

		$this->load->model('home_mod');
		$this->load->model('general_mod');
		$this->load->model('engineering_mod');
		$this->load->model('fitup_mod');
		$this->load->model('visual_mod');
		$this->load->model('planning_mod');
		$this->load->model('wtr_mod');
		$this->load->model('notification_mod');

		$this->user_cookie 		  = $data_cookies['data_user'];
		$this->permission_cookie  = $data_cookies['data_permission'];
		$this->is_admin           = $this->permission_cookie[0];
    	$this->sidebar 	= "fitup/sidebar";

		$this->smtp  = smtp_config();
		$this->prod_server        = [];
		$this->server_list        = $this->general_mod->portal_server_list();
		$this->prod_server        = array_column($this->server_list, 'ip_address');
		$this->ip_server          = $_SERVER['SERVER_ADDR'];
		$this->ftp                = ftp_config_syn();
 

		if($this->input->ip_address() == "10.5.248.215"){ 
			if($_SERVER['REMOTE_ADDR'] == getenv('IP_FIREWALL_GATEWAY')){
				$this->link_server = getenv('LINK_SERVER_OUTSIDE');
			} else { 
				$this->link_server = getenv('LINK_SERVER');
			}
		} else {
			if($this->user_cookie[12] == getenv('IP_FIREWALL_GATEWAY')){
				$this->link_server = getenv('LINK_SERVER_OUTSIDE');
			} else { 
				$this->link_server = getenv('LINK_SERVER');
			}
		} 
	}

	public function index(){
		 redirect('notification/notif_list');	
	}


	public function notif_list(){

		$where['id_user'] = $this->user_cookie[0];
        $where["length(link_encrypt) > 0"] = null;
		$where["status_read"] = 0;
        $data["notif_list"] = $this->notification_mod->get_all_notification($where,100);
        unset($where); 
        foreach($data["notif_list"] as $key => $value){  
            $master_group_id[] =  $value["master_group_id"]; 
            $created_date[]    = date("Y-m-d",strtotime($value["created_date"])); 
            $data["date_notif_all"][date("Y-m-d",strtotime($value["created_date"]))][] = $value;
        }
         
        $data["date_notif"] = array_unique($created_date); 
        ksort($data["date_notif"]);


        $data["master_group_notif"] = $this->notification_mod->get_data_master_group_notif($where = null);
        unset($where);
        foreach($data["master_group_notif"] as $key => $value){   
            $data["master_notif"][$value['id_master']] = $value;
        }

		$data['meta_title']  	 		= 'System Notification';
		$data['user_cookie'] 	 		= $this->user_cookie;
		$data['user_permission'] 		= $this->permission_cookie; 
		$data['subview']     	 		= 'notification/notif_list';
    	$data['sidebar']     	 		= $this->sidebar;
		$this->load->view('index', $data);

	}

	public function update_status_read(){ 
		$get = $this->input->get(); 
    $link_decrypt = $this->encryption->decrypt(strtr($get['link'], '.-~', '+=/')); 

		$where['id_notif'] = $get['id_notif'];
    $datadb = $this->notification_mod->get_all_notification($where);
    unset($where);
    
		if(count($datadb) > 0){  
      $where['id_notif'] = $get['id_notif'];
      $data_update = array(
          "status_read" => 1
      );
      $process_update = $this->notification_mod->update_status_notif($data_update,$where);
      unset($where); 
      unset($data_update); 

      $where['id_user'] = $this->user_cookie[0];
      $where["length(link_encrypt) > 0"] = null;
      $where["status_read"] = 0;
      $datadb_notif = $this->notification_mod->get_all_notification($where);
      unset($where);  

			$output = [
				"success" => "success", 
				"link" => $link_decrypt, 
				"total_notif" => sizeof($datadb_notif), 
			];
		} else {
      $output = [
				"success" => "fail",  
			];
		}
		echo json_encode($output);
	}

	public function get_notification(){ 
		$get = $this->input->get(); 
        $id_user = $this->encryption->decrypt(strtr($get['id_user'], '.-~', '+=/')); 

		$where['id_user'] = $id_user;
		$where["length(link_encrypt) > 0"] = null;
		$where["status_read"] = 0; 
        $datadb = $this->notification_mod->get_all_notification($where);
        unset($where);
		if(count($datadb) > 0){   

			$master_group_notifx = $this->notification_mod->get_data_master_group_notif($where = null);
			unset($where);
			foreach($master_group_notifx as $key => $value){   
				$master_notif[$value['id_master']] = $value;
			}
  
			 foreach($datadb as $key => $val){  
				$data_notification[] = array(
				  "id_notif" => $val['id_notif'],
				  "total_unread"      => sizeof($datadb),
				  "main_title"        => $master_notif[$val['master_group_id']]['designation_apps_desc'],
				  "mini_title"        => $master_notif[$val['master_group_id']]['category_apps']." - ".date("d F y",strtotime($val['created_date'])),
				  "created_date"      => $val['created_date'],
				  "notification_desc" => $val['notification_text'],
				  "link"              => $val['link_encrypt'],
				  "status_read"       => $val['status_read'],
				);
			}

			$output = [
				"success" 	 	=> "success", 
				"data_notif" 	=> $data_notification,  
				"total_notif" 	=> sizeof($datadb), 
			];
		} else {
            $output = [
				"success" => "fail",  
			];
		}
		echo json_encode($output);
	}


	public function procees_send_notification(){ 
        
        $where["length(link_encrypt) > 0"] = null;
        $where["status_push"] = 1;
        $this->data["notif_list"] = $this->notification_mod->get_all_notification($where,20);
        unset($where);  
		
        if(sizeof($this->data["notif_list"]) > 0){

            $id_user_1   = array_column($this->data["notif_list"], 'id_user');  
            $id_user_all = array_unique(array_filter($id_user_1)); 
            $where_user["id_user IN ('".implode("', '", $id_user_all)."')"] = NULL;  
            $datadb  = $this->notification_mod->get_token_firebase($where_user); 
            foreach ($datadb as $value) {  
                $data['user'][$value['id_user']] = $value['token_firebase']; 
            } 
            unset($where_user);  

            $this->data["master_group_notif"] = $this->notification_mod->get_data_master_group_notif($where = null);
            unset($where);
            foreach($this->data["master_group_notif"] as $key => $value){   
                $this->data["master_notif"][$value['id_master']] = $value;
            } 

            foreach($this->data["notif_list"] as $key => $value){
                $title   = $this->data["master_notif"][$value["master_group_id"]]["category_apps"] ." - ".$this->data["master_notif"][$value["master_group_id"]]["designation_apps"];
                $message = $value["notification_text"];
                $link    = $this->encryption->decrypt(strtr($value['link_encrypt'], '.-~', '+=/'));
                $token   = isset($data['user'][$value['id_user']]) ? $data['user'][$value['id_user']] : null;

                if(isset($token)){
                    $get_result[] = sendNotification($message,$title,$link,$token);
                } else {
                    $get_result[] = "Token not found";
                }

                $where["id_user"] = $value['id_user'];
                $form_update =  array(
                    "status_push" => 2,
                ); 
                $this->notification_mod->update_status_notif($form_update,$where);
                unset($where);
                unset($form_update);
            } 

            test_var($get_result);

        } else {
            echo "Tidak ada notification terbaru.";
        }
 
    }
 
 

}