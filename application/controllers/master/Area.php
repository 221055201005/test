<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('browser');
		$this->load->helper('cookies');
		$data_cookies = helper_cookies(@$this->input->get('user'));

		$this->load->model('general_mod');
		$this->load->model('master/area_mod', 'm_area_mod');

		$this->user_cookie 		  	  = $data_cookies['data_user'];
		$this->permission_cookie    = $data_cookies['data_permission'];

    $this->sidebar 	= "master/sidebar";
	}

  public function index() {
    redirect('master/area/area_list');
  }

  public function area_list() {
    $where['status_delete']            = 1;
    $data['area_list']          = $this->m_area_mod->area_list($where);
    unset($where);

    $data['user_permission']    = $this->permission_cookie;
    $data['meta_title']         = 'Area List';
    $data['subview']            = 'master/area/area_list';
    $data['sidebar']            = $this->sidebar;
    $this->load->view('index', $data);
  }

  public function add_area() {
    $data['user_permission']    = $this->permission_cookie;
    $data['meta_title']         = 'Add New Area';
    $data['subview']            = 'master/area/add_area';
    $data['sidebar']            = $this->sidebar;
    $this->load->view('index', $data);
  }

  public function proceed_add_area() {
    $timestamp                  = date('Y-m-d H:i:s');
    $user_id                    = $this->user_cookie[0];
    $name                  = $this->input->post('name');

    $form_data                  = [
      'name'               => $name,
      // 'status'                  => 1,
      // 'timestamp'               => $timestamp,
      'status_delete'           => 1,
      'created_by'              => $user_id,
      // 'created_date'            => $timestamp
    ];
    
    $this->m_area_mod->insert_area($form_data);
    unset($form_data);

    $this->session->set_flashdata('success','Success Add Data');
    redirect('master/area/area_list');
  }

  public function update_area($id) {
    $id                         = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
    $where['id']                = $id;
    $data_area                  = $this->m_area_mod->area_list($where);

    if($data_area) {
      $data['detail']           = $data_area[0];
      $data['user_permission']  = $this->permission_cookie;
      $data['meta_title']       = 'Update Area';
      $data['subview']          = 'master/area/update_area';
      $data['sidebar']          = $this->sidebar;
      $this->load->view('index', $data);
    }

  }

  public function proceed_update_area() {
    $id                         = $this->input->post('id');
    $name                  = $this->input->post('name');
    $status_delete              = $this->input->post('status_delete');

    $form_data                  = [
      'name'               => $name,
      'status_delete'           => $status_delete
    ];

    $where['id']                = $id;

    $this->m_area_mod->update_area($form_data, $where);
    unset($form_data, $where);

    $this->session->set_flashdata('success','Success Update Data');
    redirect($_SERVER['HTTP_REFERER']);
  }

  public function export_download(){
    $data['meta_title']       = 'Export & Download Area & Location';
    $data['subview']          = 'master/area/export_download';
    $data['sidebar']          = $this->sidebar;
    $this->load->view('index', $data);
  }

  public function export_download_process(){
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

    $datadb = $this->general_mod->alocation();
		$alocation_list = [];
		foreach ($datadb as $key => $value) {
			$alocation_list[$value['id']] = $value;
		}
		$data['alocation_list'] = $alocation_list;

    $this->load->view('master/area/export_download_process', $data);
  }
	
}