<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type_of_module extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('browser');
		$this->load->helper('cookies');
		$data_cookies = helper_cookies(@$this->input->get('user'));

		$this->load->model('general_mod');
		$this->load->model('master/type_of_module_mod', 'm_type_of_module_mod');

		$this->user_cookie 		  	= $data_cookies['data_user'];
		$this->permission_cookie  = $data_cookies['data_permission'];

    $this->sidebar 	= "master/sidebar";
	}

	public function index(){
		$data['meta_title']   = 'Blank';
		$data['subview']      = 'master/blank';
    $data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
	}

  public function type_of_module_list(){
    $type_of_module_list = $this->m_type_of_module_mod->type_of_module_list();
    $data['type_of_module_list']			= $type_of_module_list;

    $data['meta_title']   = 'Type of Module List';
		$data['subview']      = 'master/type_of_module/type_of_module_list';
    $data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
  }

  public function type_of_module_new($id = null){
    $module = "new";
    if($id){
      $module = "update";
      $id = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
      $type_of_module_list = $this->m_type_of_module_mod->type_of_module_list([
        "id" => $id,
      ]);
      $data['type_of_module']			= $type_of_module_list[0];
    }

    $data['module']       = $module;

    $data['meta_title']   = ucfirst($module).' Type of Module';
		$data['subview']      = 'master/type_of_module/type_of_module_new';
    $data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
  }

  public function type_of_module_new_process(){
    $post = $this->input->post();

    $form_data = [
      "code" => $post["code"],
      "name" => $post["name"],
      "status_delete" => $post["status_delete"],
    ];
    $this->m_type_of_module_mod->type_of_module_new_process_db($form_data);
    
    $this->session->set_flashdata('success', 'New Type of Module are created!');
		redirect($_SERVER["HTTP_REFERER"]);
  }

  public function type_of_module_update_process(){
    $post = $this->input->post();

    $form_data = [
      "code" => $post["code"],
      "name" => $post["name"],
      "status_delete" => $post["status_delete"],
    ];
    $this->m_type_of_module_mod->type_of_module_update_process_db($form_data, [
      "id" => $post["id"]
    ]);
    
    $this->session->set_flashdata('success', 'Your data has been updated!');
		redirect($_SERVER["HTTP_REFERER"]);
  }
}