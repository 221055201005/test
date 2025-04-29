<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fitter extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('browser');
		$this->load->helper('cookies');
		$data_cookies = helper_cookies(@$this->input->get('user'));

		$this->load->model('general_mod');
		$this->load->model('master/fitter_mod', 'm_fitter_mod');

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

  public function fitter_list($download = null){
    
    $fitter_list = $this->m_fitter_mod->fitter_list([
			"project in ('".join("','", $this->user_cookie[13])."')" => NULL,
		]);
    $data['fitter_list']  = $fitter_list;
    $data['meta_title']   = 'Fitter Register';

    $datadb  = $this->general_mod->portal_user_get_db();
		foreach ($datadb as $value) {
			$user_list[$value['id_user']] = $value['full_name'];
			$data["user_list"][$value['id_user']] = $value['full_name'];
		}

    $data['company_list'] = $this->general_mod->company();
		foreach($data['company_list'] as $value) {
			$data['company_name'][$value['id_company']] = $value['company_name'];
		}

    $datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['project_code']] = $value;
			$data['project_code'][$value['id']] = $value['project_code'];
		}
		$data['project_list'] = $project_list;

    $datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
			$data['type_of_module_code'][$value['id']] = $value['code'];
		}
		$data['type_of_module_list'] = $type_of_module_list;

    if(isset($download)){
		  $data['subview']      = 'master/fitter/fitter_excel';
      $this->load->view($data['subview'], $data);
    } else {
      $data['subview']      = 'master/fitter/fitter_list';       
      $this->load->view('index', $data);
    }
   
  }

  public function fitter_new($id = null){    

    $data['company_list'] = $this->general_mod->company();
		foreach($data['company_list'] as $value) {
			$data['company_name'][$value['id_company']] = $value['company_name'];
		}

    $datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['project_code']] = $value;
			$data['project_code'][$value['id']] = $value['project_code'];
		}
		$data['project_list'] = $project_list;

    $datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
			$data['type_of_module_code'][$value['id']] = $value['code'];
		}
		$data['type_of_module_list'] = $type_of_module_list;

    // test_var($data['type_of_module_list']);

    $data['meta_title']   = 'Create New Fitter';
		$data['subview']      = 'master/fitter/fitter_new';
		$this->load->view('index', $data);

  }

  public function fitter_save_process(){  

    $company      = $this->input->post('company');
    $project      = $this->input->post('project');
    $module       = $this->input->post('type_of_module');
    $update_date  = date("Y-m-d H:i:s");
    $update_by    = $this->user_cookie['0'];

    $fit_up_badge = $this->input->post('fit_up_badge');
    $fitup_name   = $this->input->post('fitup_name');
    $vsd          = $this->input->post('vsd');
    $ved          = $this->input->post('ved');
    $status       = $this->input->post('status');

    if($fit_up_badge) {

      foreach($fit_up_badge as $key => $value) {
       
        $form_data = [
          "company"       => $company[$key],
          "project"       => $project[$key],
          "module"        => $module[$key],
          "update_date"   => $update_date,
          "update_by"     => $update_by,

          "fit_up_badge"  => $fit_up_badge[$key],          
          "fitup_name"    => $fitup_name[$key],          
          "vsd"           => $vsd[$key],
          "ved"           => $ved[$key],
          "status"        => $status[$key],
        ];

        $insert_fitter  =  $this->m_fitter_mod->fitter_new_process_db($form_data);
        unset($form_data);  

      }

    }

    $this->session->set_flashdata('success', 'New Fitter are created!');
    redirect($_SERVER["HTTP_REFERER"]);

  }


  public function fitter_update_process(){  

    $id_fitter    = $this->input->post('id_fitter');
    $fit_up_badge = $this->input->post('fit_up_badge');
    $fitup_name   = $this->input->post('fitup_name');
    $vsd          = $this->input->post('vsd');
    $ved          = $this->input->post('ved');
    $status       = $this->input->post('status');   

    $company      = $this->input->post('company');
    $project      = $this->input->post('project');
    $module       = $this->input->post('type_of_module');
    $update_date  = date("Y-m-d H:i:s");
    $update_by    = $this->user_cookie['0'];

    if($fit_up_badge) {
      foreach($fit_up_badge as $key => $value) {
        // ----------- Start - Process Update Main Fitter Data  ------------- //
      
            $form_data = [
              "fit_up_badge"  => $fit_up_badge[$key],
              "fitup_name"    => $fitup_name[$key],          
              "vsd"           => $vsd[$key],
              "ved"           => $ved[$key],
              "status"        => $status[$key],
              "company"       => $company[$key],
              "project"       => $project[$key],
              "module"        => $module[$key],
              "update_date"   => $update_date,
              "update_by"     => $update_by,
            ]; 
            $where['id_fitter'] = $id_fitter[$key];
            $insert_fitter  = $this->m_fitter_mod->update_fitter($form_data,$where);
            unset($form_data,$where);

        // ----------- End - Process Update Main Fitter Data  ------------- //
      }
    }

    $this->session->set_flashdata('success', 'New Fitter are created!');
    redirect($_SERVER["HTTP_REFERER"]);

  }

  public function fitter_update_pages($id = null){

      $id = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
      $fitter_list = $this->m_fitter_mod->fitter_list(["id_fitter" => $id,]);
      $data['fitter_list']  = $fitter_list;

      $data['company_list'] = $this->general_mod->company();
      foreach($data['company_list'] as $value) {
        $data['company_name'][$value['id_company']] = $value['company_name'];
      }

      $datadb = $this->general_mod->project();
      $project_list = [];
      foreach ($datadb as $key => $value) {
        $project_list[$value['project_code']] = $value;
        $data['project_code'][$value['id']] = $value['project_code'];
      }
      $data['project_list'] = $project_list;

      $datadb = $this->general_mod->type_of_module();
      $type_of_module_list = [];
      foreach ($datadb as $key => $value) {
        $type_of_module_list[$value['code']] = $value;
        $data['type_of_module_code'][$value['id']] = $value['code'];
      }
      $data['type_of_module_list'] = $type_of_module_list;

      $data['meta_title']   = 'Fitter Update';
      $data['subview']      = 'master/fitter/fitter_update';
     
      $this->load->view('index', $data);

  }


}