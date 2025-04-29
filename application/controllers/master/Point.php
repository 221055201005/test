<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Point extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('browser');
		$this->load->helper('cookies');
		$data_cookies = helper_cookies(@$this->input->get('user'));

		$this->load->model('general_mod');
		$this->load->model('master/point_mod', 'm_point_mod');

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

  public function point_list(){
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

    $point_list = $this->m_point_mod->point_list();
    $data['point_list']			= $point_list;

    $data['meta_title']   = 'Point List';
		$data['subview']      = 'master/point/point_list';
    $data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
  }

  public function point_new($id = null){
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
    
    $module = "new";
    if($id){
      $module = "update";
      $id = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
      $point_list = $this->m_point_mod->point_list([
        "id" => $id,
      ]);
      $data['point']			= $point_list[0];
    }

    $data['module']       = $module;

    $data['meta_title']   = ucfirst($module).' Point';
		$data['subview']      = 'master/point/point_new';
    $data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
  }

  public function point_new_process(){
    $post = $this->input->post();

    $form_data = [
      "id_location" => $post["location_v2"],
      "name" => $post["name"],
      "created_by" => $this->user_cookie[0],
      "status_delete" => $post["status_delete"],
    ];
    $this->m_point_mod->point_new_process_db($form_data);
    
    $this->session->set_flashdata('success', 'New Point are created!');
		redirect($_SERVER["HTTP_REFERER"]."?area_v2=".$post['area_v2']."&location_v2=".$post['location_v2']);
  }

  public function point_update_process(){
    $post = $this->input->post();

    $form_data = [
      "id_location" => $post["location_v2"],
      "name" => $post["name"],
      "status_delete" => $post["status_delete"],
    ];
    $this->m_point_mod->point_update_process_db($form_data, [
      "id" => $post["id"]
    ]);
    
    $this->session->set_flashdata('success', 'Your data has been updated!');
		redirect($_SERVER["HTTP_REFERER"]);
  }
}