<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Module extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('browser');
		$this->load->helper('cookies');
		$data_cookies = helper_cookies(@$this->input->get('user'));

		$this->load->model('general_mod');
		$this->load->model('master/module_mod', 'm_module_mod');

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

  public function module_list(){
    $module_list = $this->m_module_mod->module_list(['project_id !=' => 0]);
    $data['module_list']			= $module_list;

    $datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['id']] = $value;
		}
		$data['project_list'] = $project_list;

    $data['meta_title']   = 'Module List';
		$data['subview']      = 'master/module/module_list';
    $data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
  }

  public function module_new($id = null){
    $mod_method = "new";
    if($id){
      $mod_method = "update";
      $id = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
      $module_list = $this->m_module_mod->module_list([
        "mod_id" => $id,
      ]);
      $data['module']			= $module_list[0];
    }
    $data['mod_method']       = $mod_method;

    $datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['id']] = $value;
		}
		$data['project_list'] = $project_list;

    $data['meta_title']   = ucfirst($mod_method).' Module';
		$data['subview']      = 'master/module/module_new';
    $data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
  }

  public function module_new_process(){
    $post = $this->input->post();

    $form_data = [
      "project_id" => $post["project_id"],
      "mod_desc" => $post["mod_desc"],
      "status_delete" => $post["status_delete"],
    ];
    $this->m_module_mod->module_new_process_db($form_data);
    
    $this->session->set_flashdata('success', 'New Module are created!');
		redirect($_SERVER["HTTP_REFERER"]);
  }

  public function module_update_process(){
    $post = $this->input->post();

    $form_data = [
      "project_id" => $post["project_id"],
      "mod_desc" => $post["mod_desc"],
      "status_delete" => $post["status_delete"],
    ];
    $this->m_module_mod->module_update_process_db($form_data, [
      "mod_id" => $post["mod_id"]
    ]);
    
    $this->session->set_flashdata('success', 'Your data has been updated!');
		redirect($_SERVER["HTTP_REFERER"]);
  }
}