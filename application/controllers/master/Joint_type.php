<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Joint_type extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('browser');
		$this->load->helper('cookies');
		$data_cookies = helper_cookies(@$this->input->get('user'));

		$this->load->model('general_mod');
		$this->load->model('master/joint_type_mod', 'm_joint_type_mod');

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

  public function joint_type_list(){
    $joint_type_list = $this->m_joint_type_mod->joint_type_list();
    $data['joint_type_list']			= $joint_type_list;

    $data['meta_title']   = 'Joint Type List';
		$data['subview']      = 'master/joint_type/joint_type_list';
    $data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
  }

  public function joint_type_new($id = null){
    $module = "new";
    if($id){
      $module = "update";
      $id = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
      $joint_type_list = $this->m_joint_type_mod->joint_type_list([
        "id" => $id,
      ]);
      $data['joint_type']			= $joint_type_list[0];
    }

    $data['module']       = $module;

    $data['meta_title']   = ucfirst($module).' Joint Type';
		$data['subview']      = 'master/joint_type/joint_type_new';
    $data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
  }

  public function joint_type_new_process(){
    $post = $this->input->post();

    $form_data = [
      "joint_type_code" => $post["joint_type_code"],
      "joint_type" => $post["joint_type"],
      "status_delete" => $post["status_delete"],
    ];
    $this->m_joint_type_mod->joint_type_new_process_db($form_data);
    
    $this->session->set_flashdata('success', 'New Joint Type are created!');
		redirect($_SERVER["HTTP_REFERER"]);
  }

  public function joint_type_update_process(){
    $post = $this->input->post();

    $form_data = [
      "joint_type_code" => $post["joint_type_code"],
      "joint_type" => $post["joint_type"],
      "status_delete" => $post["status_delete"],
    ];
    $this->m_joint_type_mod->joint_type_update_process_db($form_data, [
      "id" => $post["id"]
    ]);
    
    $this->session->set_flashdata('success', 'Your data has been updated!');
		redirect($_SERVER["HTTP_REFERER"]);
  }
}