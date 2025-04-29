<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discipline extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('browser');
		$this->load->helper('cookies');
		$data_cookies = helper_cookies(@$this->input->get('user'));

		$this->load->model('general_mod');
		$this->load->model('master/discipline_mod', 'm_discipline_mod');

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

  public function discipline_list(){
    $discipline_list = $this->m_discipline_mod->discipline_list();
    $data['discipline_list']			= $discipline_list;

    $data['meta_title']   = 'Discipline List';
		$data['subview']      = 'master/discipline/discipline_list';
    $data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
  }

  public function discipline_new($id = null){
    $module = "new";
    if($id){
      $module = "update";
      $id = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
      $discipline_list = $this->m_discipline_mod->discipline_list([
        "id" => $id,
      ]);
      $data['discipline']			= $discipline_list[0];
    }

    $data['module']       = $module;

    $data['meta_title']   = ucfirst($module).' Discipline';
		$data['subview']      = 'master/discipline/discipline_new';
    $data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
  }

  public function discipline_new_process(){
    $post = $this->input->post();

    $form_data = [
      "discipline_code" => $post["discipline_code"],
      "discipline_name" => $post["discipline_name"],
      "initial" => $post["initial"],
      "production_status" => $post["production_status"],
      "status_delete" => $post["status_delete"],
    ];
    $this->m_discipline_mod->discipline_new_process_db($form_data);
    
    $this->session->set_flashdata('success', 'New Discipline are created!');
		redirect($_SERVER["HTTP_REFERER"]);
  }

  public function discipline_update_process(){
    $post = $this->input->post();

    $form_data = [
      "discipline_code" => $post["discipline_code"],
      "discipline_name" => $post["discipline_name"],
      "initial" => $post["initial"],
      "production_status" => $post["production_status"],
      "status_delete" => $post["status_delete"],
    ];
    $this->m_discipline_mod->discipline_update_process_db($form_data, [
      "id" => $post["id"]
    ]);
    
    $this->session->set_flashdata('success', 'Your data has been updated!');
		redirect($_SERVER["HTTP_REFERER"]);
  }
}