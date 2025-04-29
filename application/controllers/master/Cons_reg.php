<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cons_reg extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('browser');
		$this->load->helper('cookies');
		$data_cookies = helper_cookies(@$this->input->get('user'));

		$this->load->model('general_mod');
		$this->load->model('master/cons_reg_mod', 'cons_reg_mod');

		$this->user_cookie 		  	= $data_cookies['data_user'];
		$this->permission_cookie  = $data_cookies['data_permission'];

    $this->sidebar 	= "master/sidebar";
	}

	public function index(){
		// $data['meta_title']   = 'Blank';
		// $data['subview']      = 'master/blank';
		// $this->load->view('index', $data);

        redirect(base_url()."master/cons_reg/consumable_list");
	}

  public function consumable_list(){

    $data["post"] = $this->input->post();

    $dataLib = $this->general_mod->project();
    foreach($dataLib as $key => $value){ 
      $project_name[] = $value;
      $data["project_name"][$value["id"]] = $value["project_name"];
    }
    $data["project_list"] = $project_name;  

    if(isset($data["post"]['project_id']) && !empty($data["post"]['project_id'])){
      $where['project_id'] = $data["post"]['project_id'];
    }
    
    $where['a.status_delete'] = "0";
    $data['consumable_register'] = $this->cons_reg_mod->master_consumable_register_list($where); 
    unset($where);  
    
    $where['a.status_delete'] = "0";
    $data['wps_register_list'] = $this->cons_reg_mod->master_detail_cons_wps_register($where); 
    unset($where);

    foreach($data['wps_register_list'] as $key => $value){
        $data["list_of_wps"][$value["id_detail_cons_register"]][] = $value["wps_no"];
    } 

    $data['meta_title']   = 'Welding Consumable Register Structure';

    if(isset($data["post"]['submit']) && !empty($data["post"]['submit']) && $data["post"]['submit'] == "download_excel"){
      $data['subview']      = 'master/cons_reg/cons_list_excel';
      $this->load->view($data['subview'], $data);
    } else { 
      $data['subview']      = 'master/cons_reg/cons_list';
      $this->load->view('index', $data);
      
    }
  }

  public function cons_new($id = null,$id_detail = null){
  
    $data["show_project"] = $this->general_mod->project();

    $where['status_wps'] = "1";
    $data['wps_register_list'] = $this->cons_reg_mod->get_wps_active_list($where); 
    unset($where); 
   
    $module = "new";
    if($id){
      $module = "update";
      
      $id = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
      $id_detail = $this->encryption->decrypt(strtr($id_detail, '.-~', '+=/'));
      $consumable_list = $this->cons_reg_mod->master_consumable_register([
        "id_register" => $id,
      ]);
      $data['cons_list'] = $consumable_list[0];
 
      $detail_consumable_list = $this->cons_reg_mod->master_detail_cons_register([
        "id_detail_register" => $id_detail,
      ]);
      $data['detail_consumable_list'] = $detail_consumable_list; 
  
      $id_detail_register = array_column($detail_consumable_list, 'id_detail_register');
      $where["id_detail_cons_register IN ('".implode("', '", $id_detail_register)."')"] = NULL;
      $wps_consumable_list = $this->cons_reg_mod->master_detail_cons_wps_register($where);
      unset($where); 
      $data['detail_wps'] = array_column($wps_consumable_list, 'id_wps');
    }

    #test_var($data['detail_consumable_list']);
 
    $data['module']       = $module; 
    $data['meta_title']   = ucfirst($module).' Consumable Lot Register';
	$data['subview']      = 'master/cons_reg/cons_new';
    $this->load->view('index', $data);
  }

  public function cons_new_process(){

    $post = $this->input->post();

    $date_cur = date("Y-m-d H:i:s"); 

    $form_data = [
      "project_id"          => $post["project_id"],
      "welding_process"     => $post["welding_process"], 
      "brand_trade_name"    => $post["brand_trade_name"], 
      "manufacture"         => $post["manufacture"],  
      "create_by"           => $this->user_cookie[0],  
      "create_date"         => $date_cur, 
    ];
    $insert_1 = $this->cons_reg_mod->insert_master_consumable_register($form_data);
    unset($form_data);

    if(sizeof($post["diameter_size"]) > 0){
    
        foreach($post["diameter_size"] as $key => $value){ 
            $form_data = [
                "id_register"            => $insert_1,
                "diameter_size"          => $post["diameter_size"][$key],
                "batch_lot_number"       => $post["batch_lot_number"][$key],  
                "create_by"           => $this->user_cookie[0],  
                "create_date"         => $date_cur, 
            ];
            $insert_2 = $this->cons_reg_mod->insert_master_detail_cons_register($form_data);
            unset($form_data); 

            if(sizeof($post['id_wps'][$key]) > 0){ 

                foreach($post['id_wps'][$key] as $kex => $vax){
                    $form_data = [
                        "id_detail_cons_register"  => $insert_2,
                        "id_wps"                   => $post["id_wps"][$key][$kex], 
                        "create_by"                => $this->user_cookie[0],  
                        "created_date"              => $date_cur, 
                    ];
                    $insert_3 = $this->cons_reg_mod->insert_master_detail_cons_wps_register($form_data);
                    unset($form_data); 
                }

            }

        }

    }

    
    $this->session->set_flashdata('success', 'New Personnel are created!');
		redirect($_SERVER["HTTP_REFERER"]);
  }

  public function cons_update_process(){

    $post = $this->input->post();
    $date_cur = date("Y-m-d H:i:s");  

      $where["id_register"] =  $post["id"];
      $form_data = [
        "project_id"          => $post["project_id"],
        "welding_process"     => $post["welding_process"], 
        "brand_trade_name"    => $post["brand_trade_name"], 
        "manufacture"         => $post["manufacture"],  
        "create_by"           => $this->user_cookie[0],  
        "create_date"         => $date_cur, 
      ];
      $insert_1 = $this->cons_reg_mod->update_master_consumable_register($form_data,$where);
      unset($form_data); 
      unset($where); 

      if(sizeof($post["diameter_size"]) > 0){
    
        foreach($post["diameter_size"] as $key => $value){

            $where["id_detail_register"] =  $post["id_detail_register"][$key];
            $form_data = [
                "id_register"      => $post["id"],
                "diameter_size"    => $post["diameter_size"][$key],
                "batch_lot_number" => $post["batch_lot_number"][$key],  
                "create_by"        => $this->user_cookie[0],  
                "create_date"      => $date_cur, 
            ];
            $insert_2 = $this->cons_reg_mod->update_master_detail_cons_register($form_data,$where);
            unset($form_data); 
            unset($where); 

            if(sizeof($post['id_wps'][$key]) > 0){
                
                $where["id_detail_cons_register"] = $post["id_detail_register"][$key]; 
                $this->cons_reg_mod->wps_delete_update_data($where);
                unset($where);

                foreach($post['id_wps'][$key] as $kex => $vax){ 
                     
                        $form_data = [
                            "id_detail_cons_register"  => $post["id_detail_register"][$key],
                            "id_wps"                   => $post["id_wps"][$key][$kex], 
                            "create_by"                => $this->user_cookie[0],  
                            "created_date"             => $date_cur, 
                        ]; 
  
                        $insert_3 = $this->cons_reg_mod->insert_master_detail_cons_wps_register($form_data);
                        unset($form_data);  

                }

            }

        }

    }
      
    
    $this->session->set_flashdata('success', 'Your data has been updated!');
	redirect($_SERVER["HTTP_REFERER"]);
    
  }
}