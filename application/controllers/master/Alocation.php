<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alocation extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('browser');
		$this->load->helper('cookies');
		$data_cookies = helper_cookies(@$this->input->get('user'));

		$this->load->model('general_mod');
		$this->load->model('master/alocation_mod', 'm_alocation_mod');

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

  public function alocation_list(){
    $datadb = $this->general_mod->area_v2();
		$area_v2_list = [];
		foreach ($datadb as $key => $value) {
			$area_v2_list[$value['id']] = $value;
		}
		$data['area_v2_list'] = $area_v2_list;

    $datadb = $this->general_mod->location_v2();
		$location_v2_list = [];
		foreach ($datadb as $key => $value) {
			$location_v2_list[$value['id']] = $value;
		}
		$data['location_v2_list'] = $location_v2_list;

    $datadb = $this->general_mod->point();
		$point_list = [];
		foreach ($datadb as $key => $value) {
			$point_list[$value['id']] = $value;
		}
		$data['point_list'] = $point_list;

    $alocation_list = $this->m_alocation_mod->alocation_list();
    $data['alocation_list']			= $alocation_list;

    $data['meta_title']   = 'Alocation List';
		$data['subview']      = 'master/alocation/alocation_list';
    $data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
  }

  public function alocation_new($id = null){
    $datadb = $this->general_mod->area_v2();
		$area_v2_list = [];
		foreach ($datadb as $key => $value) {
			$area_v2_list[$value['id']] = $value;
		}
		$data['area_v2_list'] = $area_v2_list;

    $datadb = $this->general_mod->location_v2();
		$location_v2_list = [];
		foreach ($datadb as $key => $value) {
			$location_v2_list[$value['id']] = $value;
		}
		$data['location_v2_list'] = $location_v2_list;

    $datadb = $this->general_mod->point();
		$point_list = [];
		foreach ($datadb as $key => $value) {
			$point_list[$value['id']] = $value;
		}
		$data['point_list'] = $point_list;
    
    $module = "new";
    if($id){
      $module = "update";
      $id = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
      $alocation_list = $this->m_alocation_mod->alocation_list([
        "id" => $id,
      ]);
      $data['alocation']			= $alocation_list[0];
    }

    $data['module']       = $module;

    $data['meta_title']   = ucfirst($module).' Alocation';
		$data['subview']      = 'master/alocation/alocation_new';
    $data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
  }

  public function alocation_new_process(){
    $post = $this->input->post();

    $form_data = [
      "id_point" => $post["point"],
      "name" => $post["name"],
      "created_by" => $this->user_cookie[0],
      "status_delete" => $post["status_delete"],
    ];
    $this->m_alocation_mod->alocation_new_process_db($form_data);
    
    $this->session->set_flashdata('success', 'New Alocation are created!');
    redirect($_SERVER["HTTP_REFERER"]."?area_v2=".$post['area_v2']."&location_v2=".$post['location_v2']."&point=".$post['point']);
  }

  public function alocation_update_process(){
    $post = $this->input->post();

    $form_data = [
      "id_point" => $post["point"],
      "name" => $post["name"],
      "status_delete" => $post["status_delete"],
    ];
    $this->m_alocation_mod->alocation_update_process_db($form_data, [
      "id" => $post["id"]
    ]);
    
    $this->session->set_flashdata('success', 'Your data has been updated!');
		redirect($_SERVER["HTTP_REFERER"]);
  }
}