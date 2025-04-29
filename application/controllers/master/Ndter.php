<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ndter extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('browser');
		$this->load->helper('cookies');
		$data_cookies = helper_cookies(@$this->input->get('user'));

		$this->load->model('general_mod');
		$this->load->model('ndt_live_mod');
		$this->load->model('master/ndter_mod', 'm_ndter_mod');
		$this->load->model('master/welder_mod', 'm_welder_mod');

		$this->user_cookie 		  	= $data_cookies['data_user'];
		$this->permission_cookie  = $data_cookies['data_permission'];
    $this->ftp                = ftp_config_syn();

    $this->sidebar 	= "master/sidebar";
	}

	public function index(){
		$data['meta_title']   = 'Blank';
		$data['subview']      = 'master/blank';
		$this->load->view('index', $data);
	}

  public function personnel_list(){

    $data["post"] = $this->input->post();
 
    $dataLib = $this->m_ndter_mod->master_ndt_tech_designation();
    foreach($dataLib as $key => $value){
      $designation_name[] = $value;
      $data["designation_name"][$value["id_designation"]] = $value["designation_name"];
    }
    $data["designation_list"] = $designation_name;

    $dataLib = $this->m_ndter_mod->master_ndt_tech_qualitifcation();
    foreach($dataLib as $key => $value){
      $qualification_name[] = $value;
      $data["qualification_name"][$value["id_qualification"]] = $value["qualification_name"];
    }
    $data["qualification_list"] = $qualification_name;
 
    $dataLib = $this->general_mod->company();
    foreach($dataLib as $key => $value){ 
      $company_name[] = $value;
      $data["company_name"][$value["id_company"]] = $value["company_name"];
    } 
    $data["company_list"] = $company_name;

    $dataLib = $this->general_mod->project();
    foreach($dataLib as $key => $value){ 
      $project_name[] = $value;
      $data["project_name"][$value["id"]] = $value["project_name"];
    }
    $data["project_list"] = $project_name;  

		$where['project_id'] = $this->user_cookie[10];
    if(isset($data["post"]['project_id']) && !empty($data["post"]['project_id'])){
      $where['project_id'] = $data["post"]['project_id'];
    }

    if(isset($data["post"]['company']) && !empty($data["post"]['company'])){
      $where['company'] = $data["post"]['company'];
    }

    if(isset($data["post"]['designation']) && !empty($data["post"]['designation'])){
      $where['designation'] = $data["post"]['designation'];
    }

    if(isset($data["post"]['qualification']) && !empty($data["post"]['qualification'])){
      $where['qualification'] = $data["post"]['qualification'];
    }
    
    // $where['status'] = "0";
    // $where = NULL;
    $personnel_list = $this->m_ndter_mod->personnel_list($where);
    $data['personnel_list']			= $personnel_list;
    unset($where);

    $where["result IN (2, 3)"] = NULL;
    $where["tested_by IS NOT NULL"] = NULL;
    $kpi = $this->m_ndter_mod->kpi_ndt_personnel($where);
    foreach ($kpi as $key => $value) {
    	$data['kpi'][$value['tested_by']] = $value;
    }
    // test_var($data['kpi']);

    unset($where);
    if($kpi){
	    $where[implode_where("id_user", array_filter(array_column($kpi, 'tested_by')))] = null;
	    $select                 = "id_user, full_name, sign_approval, badge_no";
	    $user_list              = $this->general_mod->portal_user_db_list($where, null, $select);
	    unset($where);
	    foreach($user_list as $value) {
	      $data['user'][$value['badge_no']]  = $value;
	    }
	  }

    $data['meta_title']   = 'Personnel List';

    if(isset($data["post"]['submit']) && !empty($data["post"]['submit']) && $data["post"]['submit'] == "download_excel"){
      $data['subview']      = 'master/ndter/personnel_list_excel';
      $this->load->view($data['subview'], $data);
    } else { 
      $data['subview']      = 'master/ndter/personnel_list';
      $this->load->view('index', $data);
      
    }
  }

  public function export_personnel_qr($id) {
    $id             = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));

    if(!$id) {
      $this->session->set_flashdata('error','Data Not Found');
      redirect($_SERVER['HTTP_REFERER']);
    }

    $where['id']    = $id;
    $personnel_list = $this->m_ndter_mod->personnel_list($where);
    unset($where);

    if($personnel_list[0]['sip_no'] == '') {
      $this->session->set_flashdata('error','Please Update SIP No First');
      redirect($_SERVER['HTTP_REFERER']);
    }

    $id_bank_data = $personnel_list[0]['sip_no'];

    $where_bank_data['data_id'] = $id_bank_data;
    $bank_data_result           = $this->m_welder_mod->bankdata_list($where_bank_data);
    unset($where_bank_data);

    $links = getenv('LINK_ISS_OUTSIDE')."/public_iss/detail_training_qr/".$id_bank_data;
    $file_name = 'NDT_TECH-'.$bank_data_result[0]["badge_id"]."_".$bank_data_result[0]["nama"];

    if($bank_data_result[0]['type'] > 0) {
      $file_name = 'NDT_TECH-'.$bank_data_result[0]["register_id"]."_".$bank_data_result[0]["nama"];
    }

    $this->load->library('ciqrcode');
    $filename           = $file_name.'.png';
    $params['data']     = $links;
    $params['level']    = 'H';
    $params['size']     = 12;
    $params['savename'] = 'file/welder_qr/'.$filename;
    $this->ciqrcode->generate($params);
    $redirect_link      = base_url().$params['savename'];
    $filePath           = $params['savename'];

    require_once(APPPATH.'third_party/Net/SFTP.php');

    $ftp                        = $this->ftp;
    $sftp                       = new Net_SFTP($ftp['hostname']);
    $destination_source         = '/PCMS/pcms_v2/qr_code/';


    if (!$sftp->login($ftp['username'], $ftp['password'])) {
      $this->session->set_flashdata('error','FTP Server Not Working');
      redirect($_SERVER['HTTP_REFERER']);
    }

    $destination                  = $destination_source.$filename;

    $sftp->put($destination , $filePath, NET_SFTP_LOCAL_FILE);
    // @unlink($filePath);

    $encrypt_filename             = strtr($this->encryption->encrypt($filename), '+=/', '.-~');
    $encrypt_filepath             = strtr($this->encryption->encrypt($destination_source), '+=/', '.-~');

    $action                       = "download";

    open_file_sync($encrypt_filename, $encrypt_filepath, $action);

  }

  public function download_all_qr_code() {

    $where['sip_no IS NOT NULL']    = null;
    $where["sip_no != ''"]          = null;
    $personnel_list                 = $this->m_ndter_mod->personnel_list($where);
    unset($where);

    $list_data_id                   = array_column($personnel_list, 'sip_no');
    $where["CAST(data_id AS VARCHAR) IN ('".implode("', '", $list_data_id)."')"] = NULL;
    $data_bankdata                  = $this->m_welder_mod->bankdata_list($where);
    unset($where);

    $image_list = [];

    foreach($data_bankdata as $value) {

      $links = getenv('LINK_ISS_OUTSIDE')."/public_iss/detail_training_qr/".$value['data_id'];
      $file_name = 'NDT_TECH-'.$value["badge_id"]."_".$value["nama"];

      if($value['type'] > 0) {
        $file_name = 'NDT_TECH-'.$value["register_id"]."_".$value["nama"];
      }

      $this->load->library('ciqrcode');
      $params['data'] = $links;
      $params['level'] = 'H';
      $params['size'] = 12;
      $params['savename'] = 'file/welder_qr/'.$file_name.'.png';
      $this->ciqrcode->generate($params);
    }

    foreach($data_bankdata as $value) {
      $links = getenv('LINK_ISS_OUTSIDE')."/public_iss/detail_training_qr/".$value['data_id'];
      $file_name = 'NDT_TECH-'.$value["badge_id"]."_".$value["nama"];

      if($value['type'] > 0) {
        $file_name = 'NDT_TECH-'.$value["register_id"]."_".$value["nama"];
      }
      $image_list[]         = 'file/welder_qr/'.$file_name.'.png';

    }

    $files                    = $image_list;

    $filename                 = "NDT TECHNICIAN QR CODE.zip";
    $filePath                 = "file/welder_qr/".$filename;

    $zip                      = new ZipArchive;
    $zip->open($filePath, ZipArchive::CREATE);
    foreach ($files as $file) {
      $zip->addFile($file);
    }

    $zip->close();

    foreach($image_list as $v) {
      unlink($v);
    }

    require_once(APPPATH.'third_party/Net/SFTP.php');

    $ftp                        = $this->ftp;
    $sftp                       = new Net_SFTP($ftp['hostname']);
    $destination_source         = '/PCMS/pcms_v2/qr_code/';

    if (!$sftp->login($ftp['username'], $ftp['password'])) {
      $this->session->set_flashdata('error','FTP Server Not Working');
      redirect($_SERVER['HTTP_REFERER']);
    }

    $destination                  = $destination_source.$filename;

    $sftp->put($destination , $filePath, NET_SFTP_LOCAL_FILE);
    // @unlink($filePath);

    $encrypt_filename             = strtr($this->encryption->encrypt($filename), '+=/', '.-~');
    $encrypt_filepath             = strtr($this->encryption->encrypt($destination_source), '+=/', '.-~');

    $action                       = "download";

    open_file_sync($encrypt_filename, $encrypt_filepath, $action);
  }

  public function personnel_new($id = null){

    $where['status_delete'] = 0;
    $dataLib = $this->m_ndter_mod->master_ndt_tech_designation($where);
    foreach($dataLib as $key => $value){
      $show_list_designation[] = $value;
      $data["designation_name"][$value["id_designation"]] = $value["designation_name"];
    }
    $data["show_list_designation"] = $show_list_designation;

    $dataLib = $this->m_ndter_mod->master_ndt_tech_qualitifcation($where);
    foreach($dataLib as $key => $value){
      $show_list_qualitifcation[] = $value;
      $data["qualification_name"][$value["id_qualification"]] = $value["qualification_name"];
    }
    $data["show_list_qualitifcation"] = $show_list_qualitifcation;
    unset($where);

    $where["status_delete"] = 1;
    $dataLib = $this->general_mod->company($where);
    foreach($dataLib as $key => $value){
      $show_list_company[] = $value;
      $data["company_name"][$value["id_company"]] = $value["company_name"];
    }
    $data["show_list_company"] = $show_list_company;
    unset($where);
  
    $data["show_project"] = $this->general_mod->project();
  
    $module = "new";
    if($id){
      $module = "update";
      $id = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
      $personnel_list = $this->m_ndter_mod->personnel_list([
        "id" => $id,
      ]);
      $data['personnel']			= $personnel_list[0];
    }

    $data['module']       = $module;

    $data['meta_title']   = ucfirst($module).' Personnel';
		$data['subview']      = 'master/ndter/personnel_new';
		$this->load->view('index', $data);
  }

  public function personnel_new_process(){

    $post = $this->input->post();

    $mockup_save = implode(";",$post["mtr"]); 

    $attachment = '';
    if(!empty($_FILES['file']['name'])){
      // $config['upload_path']          = 'upload/ndt_personnel/';
      // $config['file_name']            = 'welding_atc_'.date("YmdHis").'-'.$this->user_cookie[0];
      // $config['allowed_types']        = '*';
      // $config['overwrite'] 						= TRUE;
  
      // $this->load->library('upload');
      // $this->upload->initialize($config);
  
      // if ( ! $this->upload->do_upload('file')){
      //   $this->session->set_flashdata('error', $this->upload->display_errors());
      //   redirect($_SERVER["HTTP_REFERER"]);
      //   return false;
      // }
      // upload_ftp_server($config['upload_path']."/".$this->upload->data('file_name'), $config['upload_path']."/".$this->upload->data('file_name'));
      // $attachment = $this->upload->data('file_name');

            require_once(APPPATH.'third_party/Net/SFTP.php');
            $ftp                        = $this->ftp;
            $sftp                       = new Net_SFTP($ftp['hostname']);
            $destination_source         = '/PCMS/pcms_v2/ndt_personnel/';

            if (!$sftp->login($ftp['username'], $ftp['password'])) {
            $this->session->set_flashdata('error','FTP Server Not Working');
            redirect($_SERVER['HTTP_REFERER']);
            }  

            $filetype           = pathinfo($_FILES['file']['name']);
            $filetype           = $filetype['extension'];

            if($filetype == "pdf"){
            
              $filename           = 'NDT_personel_'.uniqid().'_.'.$filetype;
              $attach_line_name   = $filename;
              $filepath           = 'upload/';
              move_uploaded_file($_FILES['file']['tmp_name'], $filepath.$attach_line_name);
              $fileName                 = $attach_line_name;
              $source                   = $filepath.$attach_line_name;
              $destination              = $destination_source.$attach_line_name;
              $sftp->put($destination , $source, NET_SFTP_LOCAL_FILE);
              // @unlink($source);

            } else {
              $this->session->set_flashdata('error','Only For PDF File..!');
              redirect($_SERVER['HTTP_REFERER']);
            }

            $attachment = $filename;

      
    }

    $form_data = [
      "project_id"          => $post["project_id"],
      "personel_name"       => $post["personel_name"],
      "designation"         => $post["designation"],
      "qualification"       => $post["qualification"],
      "certificate_number"  => $post["certificate_number"],
      "attachment"          => $post["attachment"],
      "pcn_number"          => $post["pcn_number"],
      "iso_number"          => $post["iso_number"],
      "date_of_issue"       => $post["date_of_issue"],
      "date_of_expired"     => $post["date_of_expired"],
      "mock_up_test_result" => $mockup_save,
      "status"              => $post["status"],
      "sip_no"              => $post["sip_no"],
      "company"             => $post["company"],
      "attachment"          => $attachment,
      "remarks"             => $post["remarks"],
    ];

    if($post['status'] == 0){
      $form_data["issue_date"]    = $post["issue_date"];
      $form_data["expired_date"]  = $post["expired_date"];
    }

    $this->m_ndter_mod->personnel_new_process_db($form_data);
    
    $this->session->set_flashdata('success', 'New Personnel are created!');
		redirect($_SERVER["HTTP_REFERER"]);
  }

  public function personnel_update_process(){
    $post = $this->input->post();

    $mockup_save = implode(";",$post["mtr"]); 

    $attachment = '';
    if(!empty($_FILES['file']['name'])){
      // $config['upload_path']          = 'upload/ndt_personnel/';
      // $config['file_name']            = 'welding_atc_'.date("YmdHis").'-'.$this->user_cookie[0];
      // $config['allowed_types']        = '*';
      // $config['overwrite'] 						= TRUE;
  
      // $this->load->library('upload');
      // $this->upload->initialize($config);
  
      // if ( ! $this->upload->do_upload('file')){
      //   $this->session->set_flashdata('error', $this->upload->display_errors());
      //   redirect($_SERVER["HTTP_REFERER"]);
      //   return false;
      // }
      // upload_ftp_server($config['upload_path']."/".$this->upload->data('file_name'), $config['upload_path']."/".$this->upload->data('file_name'));
      // $attachment = $this->upload->data('file_name');
            require_once(APPPATH.'third_party/Net/SFTP.php');
            $ftp                        = $this->ftp;
            $sftp                       = new Net_SFTP($ftp['hostname']);
            $destination_source         = '/PCMS/pcms_v2/ndt_personnel/';

            if (!$sftp->login($ftp['username'], $ftp['password'])) {
            $this->session->set_flashdata('error','FTP Server Not Working');
            redirect($_SERVER['HTTP_REFERER']);
            }  

            $filetype           = pathinfo($_FILES['file']['name']);
            $filetype           = $filetype['extension'];

            if($filetype == "pdf"){
            
              $filename           = 'NDT_personel_'.uniqid().'_.'.$filetype;
              $attach_line_name   = $filename;
              $filepath           = 'upload/';
              move_uploaded_file($_FILES['file']['tmp_name'], $filepath.$attach_line_name);
              $fileName                 = $attach_line_name;
              $source                   = $filepath.$attach_line_name;
              $destination              = $destination_source.$attach_line_name;
              $sftp->put($destination , $source, NET_SFTP_LOCAL_FILE);
              // @unlink($source);

            } else {
              $this->session->set_flashdata('error','Only For PDF File..!');
              redirect($_SERVER['HTTP_REFERER']);
            }

            $attachment = $filename;
    }

    $form_data = [
      "project_id"          => $post["project_id"],
      "personel_name"       => $post["personel_name"],
      "designation"         => $post["designation"],
      "qualification"       => $post["qualification"],
      "certificate_number"  => $post["certificate_number"],
      "attachment"          => $post["attachment"],
      "pcn_number"          => $post["pcn_number"],
      "iso_number"          => $post["iso_number"],
      "date_of_issue"       => $post["date_of_issue"],
      "date_of_expired"     => $post["date_of_expired"],
      "mock_up_test_result" => $mockup_save,
      "status"              => $post["status"],
      "sip_no"              => $post["sip_no"],
      "company"             => $post["company"],
      "issue_date"          => $post["issue_date"],
      "expired_date"        => $post["expired_date"],
      "attachment"          => $attachment,
      "remarks"             => $post["remarks"],
    ];
    if($attachment != ''){
      $form_data['attachment'] = $attachment;
    }
    $this->m_ndter_mod->personnel_update_process_db($form_data, [
      "id" => $post["id"]
    ]);
    
    $this->session->set_flashdata('success', 'Your data has been updated!');
		redirect($_SERVER["HTTP_REFERER"]);
  }
}