<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welder_process extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('browser');
		$this->load->helper('cookies');
		$data_cookies = helper_cookies(@$this->input->get('user'));

		$this->load->model('general_mod');
		$this->load->model('master/welder_process_mod', 'm_welder_process_mod');

		$this->user_cookie 		  	= $data_cookies['data_user'];
		$this->permission_cookie  = $data_cookies['data_permission'];

    $this->sidebar 	= "master/sidebar";
	}

	public function index(){
		// $data['meta_title']   = 'Blank';
		// $data['subview']      = 'master/blank';
  //   $data['sidebar']      = $this->sidebar;
		// $this->load->view('index', $data);

    redirect('master/welder_process/welder_process_list');
	}

  public function welder_process_list(){
    $datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['id']] = $value;
		}
		$data['discipline_list'] = $discipline_list;

    $welder_process_list = $this->m_welder_process_mod->welder_process_list();
    $data['welder_process_list']			= $welder_process_list;

    $data['meta_title']   = 'Welder Process List';
		$data['subview']      = 'master/welder_process/welder_process_list';
    $data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
  }

  public function welder_process_new($id = null){
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
      $welder_process_list = $this->m_welder_process_mod->welder_process_list([
        "id" => $id,
      ]);
      $data['welder_process']			= $welder_process_list[0];
    }

    $data['module']       = $module;

    $data['meta_title']   = ucfirst($module).' Welder_process';
		$data['subview']      = 'master/welder_process/welder_process_new';
    $data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
  }

  public function welder_process_new_process(){
    $post = $this->input->post();

    $form_data = [
      "name_process" => $post["name_process"],
      "status" => $post["status"],
    ];
    $this->m_welder_process_mod->welder_process_new_process_db($form_data);
    
    $this->session->set_flashdata('success', 'New Welder_process are created!');
		redirect($_SERVER["HTTP_REFERER"]);
  }

  public function welder_process_update_process(){
    $post = $this->input->post();

     $form_data = [
      "name_process" => $post["name_process"],
      "status" => $post["status"],
    ];
    $this->m_welder_process_mod->welder_process_update_process_db($form_data, [
      "id" => $post["id"]
    ]);
    
    $this->session->set_flashdata('success', 'Your data has been updated!');
		redirect($_SERVER["HTTP_REFERER"]);
  }
}