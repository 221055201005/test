<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deck_elevation extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('browser');
		$this->load->helper('cookies');
		$data_cookies = helper_cookies(@$this->input->get('user'));

		$this->load->model('general_mod');
		$this->load->model('master/deck_elevation_mod', 'm_deck_elevation_mod');

		$this->user_cookie 		  	  = $data_cookies['data_user'];
		$this->permission_cookie    = $data_cookies['data_permission'];

    $this->sidebar 	= "master/sidebar";
	}

  public function index() {
    redirect('master/deck_elevation/deck_elevation_list');
  }

  public function deck_elevation_list() {
    $data['deck_elevation_list']  = $this->m_deck_elevation_mod->deck_elevation_list();
    $data['user_permission']      = $this->permission_cookie;
    $data['meta_title']           = 'Deck Elevation / Service Line List';
    $data['subview']              = 'master/deck_elevation/deck_elevation_list';
    $data['sidebar']              = $this->sidebar;
    $this->load->view('index', $data);
  }

  public function add_deck_elevation() {
    $data['user_permission']    = $this->permission_cookie;
    $data['meta_title']         = 'Add New Deck Elevation / Service Line';
    $data['subview']            = 'master/deck_elevation/add_deck_elevation';
    $data['sidebar']            = $this->sidebar;
    $this->load->view('index', $data);
  }

  public function proceed_add_deck_elevation() {
    $timestamp                  = date('Y-m-d H:i:s');
    $user_id                    = $this->user_cookie[0];
    $name                       = $this->input->post('name');
    $code                       = $this->input->post('code');

    $form_data                  = [
      'name'                    => $name,
      'code'                    => $code,
      'status_delete'           => 1,
      'created_by'              => $user_id,
      'created_date'            => $timestamp
    ];
    
    $this->m_deck_elevation_mod->insert_deck_elevation($form_data);
    unset($form_data);

    $this->session->set_flashdata('success','Success Add Data');
    redirect('master/deck_elevation/deck_elevation_list');
  }

  public function update_deck_elevation($id) {
    $id                         = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
    $where['id']                = $id;
    $data_deck_elevation        = $this->m_deck_elevation_mod->deck_elevation_list($where);

    if($data_deck_elevation) {
      $data['detail']           = $data_deck_elevation[0];
      $data['user_permission']  = $this->permission_cookie;
      $data['meta_title']       = 'Update deck_elevation';
      $data['subview']          = 'master/deck_elevation/update_deck_elevation';
      $data['sidebar']          = $this->sidebar;
      $this->load->view('index', $data);
    }

  }

  public function proceed_update_deck_elevation() {
    $id                         = $this->input->post('id');
    $name                       = $this->input->post('name');
    $code                       = $this->input->post('code');
    $status_delete              = $this->input->post('status_delete');

    $form_data                  = [
      'name'                    => $name,
      'code'                    => $code,
      'status_delete'           => $status_delete
    ];

    $where['id']                = $id;

    $this->m_deck_elevation_mod->update_deck_elevation($form_data, $where);
    unset($form_data, $where);

    $this->session->set_flashdata('success','Success Update Data');
    redirect($_SERVER['HTTP_REFERER']);
  }
	
}