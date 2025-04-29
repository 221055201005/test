<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desc_assy extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('browser');
		$this->load->helper('cookies');
		$data_cookies = helper_cookies(@$this->input->get('user'));

		$this->load->model('general_mod');
		$this->load->model('master/desc_assy_mod', 'm_desc_assy_mod');

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

  public function desc_assy_list(){
    $desc_assy_list = $this->m_desc_assy_mod->desc_assy_list();
    $data['desc_assy_list']			= $desc_assy_list;

    $data['meta_title']   = 'Description Assembly List';
		$data['subview']      = 'master/desc_assy/desc_assy_list';
    $data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
  }

  public function desc_assy_new($id = null){
    $module = "new";
    if($id){
      $module = "update";
      $id = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
      $desc_assy_list = $this->m_desc_assy_mod->desc_assy_list([
        "id" => $id,
      ]);
      $data['desc_assy']			= $desc_assy_list[0];
    }

    $data['module']       = $module;

    $data['meta_title']   = ucfirst($module).' Description Assembly';
		$data['subview']      = 'master/desc_assy/desc_assy_new';
    $data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
  }

  public function desc_assy_new_process(){
    $post = $this->input->post();

    $form_data = [
      "code" => $post["code"],
      "name" => $post["name"],
      "status" => $post["status"],
    ];
    $this->m_desc_assy_mod->desc_assy_new_process_db($form_data);
    
    $this->session->set_flashdata('success', 'New Description Assembly are created!');
		redirect($_SERVER["HTTP_REFERER"]);
  }

  public function desc_assy_update_process(){
    $post = $this->input->post();

    $form_data = [
      "code" => $post["code"],
      "name" => $post["name"],
      "status" => $post["status"],
    ];
    $this->m_desc_assy_mod->desc_assy_update_process_db($form_data, [
      "id" => $post["id"]
    ]);
    
    $this->session->set_flashdata('success', 'Your data has been updated!');
		redirect($_SERVER["HTTP_REFERER"]);
  }
}