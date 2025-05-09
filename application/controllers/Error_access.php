<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error_access extends CI_Controller {

	public function __construct() {
			
		parent::__construct();
		$data_cookies = helper_cookies(@$this->input->get('user'));
		$this->user_cookie 		  = $data_cookies['data_user'];
		$this->permission_cookie  = explode(";",$this->input->cookie('portal_pcms'));
		$this->permission_eng_act = explode(";",$this->input->cookie('portal_pcms'));	
	}

	public function error_page(){
		
		$data['read_cookies'] 	  = $this->user_cookie;
		$data['meta_title'] 	  = 'Access Denied!';
		$data['subview']    	  = 'home/error_pages';
		$data['read_permission']  = $this->permission_cookie;



		$this->session->set_flashdata('message','<script type="text/javascript">swal.fire({title: "Access Denied!",html: "Please Contact SMOE - Portal Administrator",type: "error"}).then(function() { window.location = "'.($this->user_cookie[9] != "" ? $this->user_cookie[9] : $_SERVER['HTTP_HOST']).'"});</script>');

		$this->load->view('index', $data);
	}

}