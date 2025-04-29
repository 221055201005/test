<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Class_data extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('browser');
		$this->load->helper('cookies');
		$data_cookies = helper_cookies(@$this->input->get('user'));

		$this->load->model('general_mod');
		$this->load->model('master/class_mod', 'm_class_mod');

		$this->user_cookie 		  	  = $data_cookies['data_user'];
		$this->permission_cookie    = $data_cookies['data_permission'];

    $this->sidebar 	= "master/sidebar";
	}

  public function index() {
    redirect('master/class_data/class_list');
  }

  public function class_list() {
    $data['class_list']         = $this->m_class_mod->class_list();
    $data['user_permission']    = $this->permission_cookie;
    $data['meta_title']         = 'class List';
    $data['subview']            = 'master/class/class_list';
    $data['sidebar']            = $this->sidebar;
    $this->load->view('index', $data);
  }

  public function add_class() {
    $data['user_permission']    = $this->permission_cookie;
    $data['meta_title']         = 'Add New Class';
    $data['subview']            = 'master/class/add_class';
    $data['sidebar']            = $this->sidebar;
    $this->load->view('index', $data);
  }

  public function proceed_add_class() {
    $timestamp                  = date('Y-m-d H:i:s');
    $user_id                    = $this->user_cookie[0];
    $class_name                 = $this->input->post('class_name');
    $class_code                 = $this->input->post('class_code');

    $form_data                  = [
      'class_name'              => $class_name,
      'class_code'              => $class_code,
      'status_delete'           => 1,
      'created_by'              => $user_id,
      'created_date'            => $timestamp
    ];
    
    $this->m_class_mod->insert_class($form_data);
    unset($form_data);

    $this->session->set_flashdata('success','Success Add Data');
    redirect('master/class_data/class_list');
  }

  public function update_class($id) {
    $id                         = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
    $where['id']                = $id;
    $data_class                 = $this->m_class_mod->class_list($where);

    if($data_class) {
      $data['detail']           = $data_class[0];
      $data['user_permission']  = $this->permission_cookie;
      $data['meta_title']       = 'Update class';
      $data['subview']          = 'master/class/update_class';
      $data['sidebar']          = $this->sidebar;
      $this->load->view('index', $data);
    }

  }

  public function proceed_update_class() {
    $id                         = $this->input->post('id');
    $class_name                 = $this->input->post('class_name');
    $class_code                 = $this->input->post('class_code');
    $status_delete              = $this->input->post('status_delete');

    $form_data                  = [
      'class_name'              => $class_name,
      'class_code'              => $class_code,
      'status_delete'           => $status_delete
    ];

    $where['id']                = $id;

    $this->m_class_mod->update_class($form_data, $where);
    unset($form_data, $where);

    $this->session->set_flashdata('success','Success Update Data');
    redirect($_SERVER['HTTP_REFERER']);
  }
	
}