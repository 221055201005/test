<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('browser');
		$this->load->helper('cookies');
		$data_cookies = helper_cookies(@$this->input->get('user'));

		$this->load->model('general_mod');
		$this->load->model('master/location_mod', 'm_location_mod');

		$this->user_cookie 		  	  = $data_cookies['data_user'];
		$this->permission_cookie    = $data_cookies['data_permission'];

    $this->sidebar 	= "master/sidebar";

    $this->category_list = [
      1 => 'OFFICE',
      2 => 'OPEN YARD',
    ];
	}

  public function index() {
    redirect('master/location/location_list');
  }

  public function location_list() {
    $datadb = $this->general_mod->area_v2();
		$area_v2_list = [];
		foreach ($datadb as $key => $value) {
			$area_v2_list[$value['id']] = $value;
		}
		$data['area_v2_list'] = $area_v2_list;
		$data['category_list'] = $this->category_list;

    $where['status_delete']            = 1;
    $data['location_list']      = $this->m_location_mod->location_list($where);
    unset($where);

    $data['user_permission']    = $this->permission_cookie;
    $data['meta_title']         = 'location List';
    $data['subview']            = 'master/location/location_list';
    $data['sidebar']            = $this->sidebar;
    $this->load->view('index', $data);
  }

  public function add_location() {
    $datadb = $this->general_mod->area_v2();
		$area_v2_list = [];
		foreach ($datadb as $key => $value) {
			$area_v2_list[$value['id']] = $value;
		}
		$data['area_v2_list'] = $area_v2_list;
		$data['category_list'] = $this->category_list;

    $data['user_permission']    = $this->permission_cookie;
    $data['meta_title']         = 'Add New location';
    $data['subview']            = 'master/location/add_location';
    $data['sidebar']            = $this->sidebar;
    $this->load->view('index', $data);
  }

  public function proceed_add_location() {
    $timestamp                  = date('Y-m-d H:i:s');
    $user_id                    = $this->user_cookie[0];
    $name                  = $this->input->post('name');
    $area_v2                  = $this->input->post('area_v2');

    $form_data                  = [
      'name'           => $name,
      'id_area'           => $area_v2,
      // 'status'                  => 1,
      'status_delete'           => 1,
      'created_by'              => $user_id,
      'created_date'            => $timestamp
    ];
    
    $this->m_location_mod->insert_location($form_data);
    unset($form_data);

    $this->session->set_flashdata('success','Success Add Data');
    redirect('master/location/location_list');
  }

  public function update_location($id) {
    $datadb = $this->general_mod->area_v2();
		$area_v2_list = [];
		foreach ($datadb as $key => $value) {
			$area_v2_list[$value['id']] = $value;
		}
		$data['area_v2_list'] = $area_v2_list;
		$data['category_list'] = $this->category_list;
    
    $id                         = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
    $where['id']                = $id;
    $data_location                  = $this->m_location_mod->location_list($where);

    if($data_location) {
      $data['detail']           = $data_location[0];
      $data['user_permission']  = $this->permission_cookie;
      $data['meta_title']       = 'Update location';
      $data['subview']          = 'master/location/update_location';
      $data['sidebar']          = $this->sidebar;
      $this->load->view('index', $data);
    }

  }

  public function proceed_update_location() {
    $id                         = $this->input->post('id');
    $name                  = $this->input->post('name');
    $category                  = $this->input->post('category');
    $status_delete              = $this->input->post('status_delete');
    $area_v2              = $this->input->post('area_v2');

    $form_data                  = [
      'name'               => $name,
      'category'               => $category,
      'status_delete'           => $status_delete,
      'id_area'           => $area_v2,
    ];

    $where['id']                = $id;

    $this->m_location_mod->update_location($form_data, $where);
    unset($form_data, $where);

    $this->session->set_flashdata('success','Success Update Data');
    redirect($_SERVER['HTTP_REFERER']);
  }
	
}