<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Phase extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('browser');
		$this->load->helper('cookies');
		$data_cookies = helper_cookies(@$this->input->get('user'));

		$this->load->model('general_mod');
		$this->load->model('master/phase_mod', 'm_phase_mod');

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

  public function phase_list(){
    $datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['id']] = $value;
		}
		$data['discipline_list'] = $discipline_list;

    $phase_list = $this->m_phase_mod->phase_list();
    $data['phase_list']			= $phase_list;

    $data['meta_title']   = 'Phase List';
		$data['subview']      = 'master/phase/phase_list';
    $data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
  }

  public function phase_new($id = null){
    $datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['id']] = $value;
		}
		$data['discipline_list'] = $discipline_list;

    $module = "new";
    if($id){
      $module = "update";
      $id = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
      $phase_list = $this->m_phase_mod->phase_list([
        "id" => $id,
      ]);
      $data['phase']			= $phase_list[0];
    }

    $data['module']       = $module;

    $data['meta_title']   = ucfirst($module).' Phase';
		$data['subview']      = 'master/phase/phase_new';
    $data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
  }

  public function phase_new_process(){
    $post = $this->input->post();

    $form_data = [
      "phase_code" => $post["phase_code"],
      "phase_name" => $post["phase_name"],
      "discipline" => $post["discipline"],
      "status_delete" => $post["status_delete"],
    ];
    $this->m_phase_mod->phase_new_process_db($form_data);
    
    $this->session->set_flashdata('success', 'New Phase are created!');
		redirect($_SERVER["HTTP_REFERER"]);
  }

  public function phase_update_process(){
    $post = $this->input->post();

    $form_data = [
      "phase_code" => $post["phase_code"],
      "phase_name" => $post["phase_name"],
      "discipline" => $post["discipline"],
      "status_delete" => $post["status_delete"],
    ];
    $this->m_phase_mod->phase_update_process_db($form_data, [
      "id" => $post["id"]
    ]);
    
    $this->session->set_flashdata('success', 'Your data has been updated!');
		redirect($_SERVER["HTTP_REFERER"]);
  }
}