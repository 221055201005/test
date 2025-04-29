<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bonder extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('browser');
		$this->load->helper('cookies');
		$data_cookies = helper_cookies(@$this->input->get('user'));

		$this->load->model('general_mod');
		$this->load->model('visual_mod');
		$this->load->model('master/welder_mod', 'm_welder_mod');

		$this->user_cookie 		  	= $data_cookies['data_user'];
		$this->permission_cookie  = $data_cookies['data_permission'];
    $this->ftp                = ftp_config_syn();
    $this->sidebar 	          = "master/sidebar";
    $this->user_id            = $this->user_cookie[0];
    $this->timestamp          = date('Y-m-d H:i:s');
	}

	public function index(){
    redirect('master/bonder/bonder_list');
	}

  public function bonder_list($download = null,$project_id = null,$company_id = null){


    $data['post'] = $this->input->post();
    
    $datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['id']] = $value;
		}
		$data['discipline_list'] = $discipline_list;

    $data['project_lists'] = $this->general_mod->project();
		$project_list = [];
		foreach ($data['project_lists'] as $key => $value) {
			$data['project'][$value['id']] = $value;
		}
    
    $datadb = $this->general_mod->company();
    $company_list = [];
    foreach($datadb as $key => $value){
      $company[$value['id_company']] = $value;
    } 
    $data['company_list'] = $company;

    $datadb = $this->general_mod->bonding_process();
    foreach ($datadb as $key => $value) {
      $data['process'][$value['id']] = $value['name'];
    }

    $where['project_id'] = (isset($data['post']['project']) && !empty($data['post']['project']) ? $data['post']['project'] : $this->user_cookie[10]);
    if(isset($data['post']['company']) && !empty(@$data['post']['company'])){
      $where['id_company'] = (isset($data['post']['company']) && !empty(@$data['post']['company']) ? $data['post']['company'] : "1");
    }  
    $bonder_list = $this->m_welder_mod->bonder_list($where);
    unset($where);

    $data['bonder_list'] = $bonder_list;

    if($bonder_list) {
      $bank_data_list   	  = array_column($bonder_list, 'id_bank_data');
      $where_bank_data["badge_id IN ('".implode("', '", $bank_data_list)."') OR CAST (data_id AS VARCHAR) IN ('".implode("', '", $bank_data_list)."')"] = NULL;
      $bank_data_result       = $this->m_welder_mod->bankdata_list($where_bank_data);
      foreach($bank_data_result as $value){
        $data["bankdata_data_id"][$value['data_id']]  = $value;
      }
      unset($where_bank_data);

      $list_bonder_id       = array_column($bonder_list, 'id');
      $where[implode_where("bonder_id", $list_bonder_id)] = null;
      $where['status_delete'] = 1;
      $att_list               = $this->m_welder_mod->bonder_attachment_list($where);
      unset($where);

      foreach($att_list as $value) {
        $data['att'][$value['bonder_id']][] = $value;
      }
    }

    $data['meta_title'] = 'Bonder Register';

    $data['subview']  = 'master/bonder/bonder_list';
    $this->load->view('index', $data);
   
  }

  public function bonder_new($id = null){

    $data['discipline_list'] = $this->general_mod->discipline();
    $data['company_list'] = $this->general_mod->company();
    $data['master_bonding_process'] = $this->general_mod->bonding_process();
    $data['project_list'] = $this->general_mod->project();

    $data['meta_title']   = 'New Bonder';
		$data['subview']      = 'master/bonder/bonder_new';
		$this->load->view('index', $data);

  }

  public function bankdata_sdelect2_ajax(){  
    $post = $this->input->post(); 

    $wheres["(badge_id ILIKE '%".$post['search']."%' OR nama ILIKE '%".$post['search']."%' OR CAST(data_id AS TEXT) ILIKE '%".$post['search']."%')"] = NULL;
    $wheres["company"] = '1';
    $wheres["type_name"] = 'SMOE';
    $wheres["status"] = 0;
    $datadb = $this->m_welder_mod->bankdata_list_ajax($wheres);

    if(sizeof($datadb) > 0){
      foreach ($datadb as $row){
        $option_data = array(
          'id' => $row['data_id'],
          'text' => $row['badge_id'].' - '.$row['nama']
        );              
        $arr_result[] = $option_data;
      }
    } else {
      $arr_result[] = "Error : Data Not Found";
    }
    echo json_encode($arr_result);
  }

  public function proceed_add_bonder(){
    $post = $this->input->post();

    $form['bonder_id']    = $post['bonder_id'];
    $form['rwe_code']     = $post['rwe_code'];
    $form['id_company']   = $post['company'];
    $form['project_id']   = $post['project'];
    $form['id_bank_data'] = $post['id_bank_data'];
    $form['discipline']   = $post['discipline'];
    $form['process_id']   = $post['process'];
    $form['vsd']          = $post['vsd'];
    $form['ved']          = $post['ved'];

    
    
    $bonder_id            = $this->m_welder_mod->bonder_new_process_db($form);

    if(isset($_FILES)) {
      require_once(APPPATH.'third_party/Net/SFTP.php');
      $ftp                        = $this->ftp;
      $sftp                       = new Net_SFTP($ftp['hostname']);
      $destination_source         = '/PCMS/pcms_v2/';

      if (!$sftp->login($ftp['username'], $ftp['password'])) {
        $this->session->set_flashdata('error','FTP Server Not Working');
        redirect($_SERVER['HTTP_REFERER']);
      } 

      foreach($_FILES['attachment']['name'] as $key => $value) {
        $original_name            = $value;
        $attachment_name          = uniqid().'_'.$_FILES['attachment']['name'][$key];
        $filepath                 = 'upload/';
        move_uploaded_file($_FILES['attachment']['tmp_name'][$key], $filepath.$attachment_name);
        $source                   = $filepath.$attachment_name;
        $destination              = $destination_source."bonder_attachment/".$attachment_name;
        $sftp->put($destination , $source, NET_SFTP_LOCAL_FILE);

        $form_data                = [
          'bonder_id'             => $bonder_id,
          'attachment_name'       => $attachment_name,
          'filename_original'     => $original_name,
          'description'           => $post['description'][$key],
          'created_by'            => $this->user_id,
          'created_date'          => $this->timestamp
        ];

        $this->m_welder_mod->insert_attachment_bonder($form_data);
        unset($form_data);
      }

    }

    $this->session->set_flashdata('success','Data Inserted!');
    redirect('master/bonder/bonder_list');
  }

  public function bonder_update($id){
    $id = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));

    $where["id"] = $id;
    $data['detail'] = $this->m_welder_mod->bonder_list($where)[0];
    unset($where);

    $where['data_id'] = $data['detail']['id_bank_data'];
    $data['bankdata'] = $this->m_welder_mod->bankdata_list($where)[0];
    unset($where);

    $data['discipline_list'] = $this->general_mod->discipline();
    $data['company_list'] = $this->general_mod->company();
    $data['master_bonding_process'] = $this->general_mod->bonding_process();
    $data['project_list'] = $this->general_mod->project();

    $where['bonder_id']     = $id;
    $where['status_delete'] = 1;
    $data['att_list']       = $this->m_welder_mod->bonder_attachment_list($where);
    unset($where);

    $data['meta_title']   = 'Bonder Update';
    $data['subview']      = 'master/bonder/bonder_update';
    $this->load->view('index', $data);
  }

  public function proceed_update_bonder(){
    $post = $this->input->post();

    $where["id"]          = $post['id'];
    $data['bonder_id']    = $post['bonder_id'];
    $data['rwe_code']     = $post['rwe_code'];
    $data['id_company']   = $post['company'];
    $data['project_id']   = $post['project'];
    $data['discipline']   = $post['discipline'];
    $data['process_id']   = $post['process'];
    $data['vsd']          = $post['vsd'];
    $data['ved']          = $post['ved'];

    $this->m_welder_mod->bonder_update_process_db($data, $where);
    unset($data, $where);

    // ADDED BY IQBAL UPDATE ATTACHMENT
    $id_att               = $this->input->post('id_att');
    $description          = $this->input->post('description');


    if(isset($_FILES)) {
      require_once(APPPATH.'third_party/Net/SFTP.php');
      $ftp                        = $this->ftp;
      $sftp                       = new Net_SFTP($ftp['hostname']);
      $destination_source         = '/PCMS/pcms_v2/';

      if (!$sftp->login($ftp['username'], $ftp['password'])) {
        $this->session->set_flashdata('error','FTP Server Not Working');
        redirect($_SERVER['HTTP_REFERER']);
      }
    } 

    if($id_att) {
      $new_row                    = 0;
      foreach($id_att as $key => $value) {
        if($value != 0) {
          $form_data              = [
            'description'         => $description[$key]
          ];
          $where['id']            = $value;
          $this->m_welder_mod->update_bonder_attachment($form_data, $where);
          unset($form_data, $where);
        } else {

          if($_FILES['attachment']['name'][$new_row] != "") {
            $original_name            = $_FILES['attachment']['name'][$new_row];
            $attachment_name          = uniqid().'_'.$_FILES['attachment']['name'][$new_row];
            $filepath                 = 'upload/';
            move_uploaded_file($_FILES['attachment']['tmp_name'][$new_row], $filepath.$attachment_name);
            $source                   = $filepath.$attachment_name;
            $destination              = $destination_source."bonder_attachment/".$attachment_name;
            $sftp->put($destination , $source, NET_SFTP_LOCAL_FILE);
    
            $form_data                = [
              'bonder_id'             => $post['id'],
              'attachment_name'       => $attachment_name,
              'filename_original'     => $original_name,
              'description'           => $description[$key],
              'created_by'            => $this->user_id,
              'created_date'          => $this->timestamp
            ];

            $this->m_welder_mod->insert_attachment_bonder($form_data);
            unset($form_data);
          }

          $new_row++;

        }
      }
    }

    $this->session->set_flashdata('success','Data Updated!');
    redirect($_SERVER['HTTP_REFERER']);
  }

  public function delete_attachment() {
    $id_enc                     = $this->input->post('id_enc');
    $id                         = decrypt($id_enc);

    if($id) {
      $where['id']              = $id;
      $form_data                = [
        'status_delete'         => 0,
        'deleted_by'            => $this->user_id,
        'deleted_date'          => $this->timestamp
      ];

      $this->m_welder_mod->update_bonder_attachment($form_data, $where);
      unset($form_data, $where);
    }

    echo json_encode([
      'success'     => true
    ]);
  }

}