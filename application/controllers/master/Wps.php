<?php

use FontLib\Table\Type\post;

defined('BASEPATH') or exit('No direct script access allowed');

class Wps extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('browser');
    $this->load->helper('cookies');
    $data_cookies = helper_cookies(@$this->input->get('user'));

    $this->load->model('general_mod');
    $this->load->model('master/wps_mod', 'm_wps_mod');

    $this->user_cookie         = $data_cookies['data_user'];
    $this->permission_cookie  = $data_cookies['data_permission'];

    $this->sidebar   = "master/sidebar";

    $this->ftp    = ftp_config_syn();
  }

  public function index()
  {

    $data['meta_title']   = 'Blank';
    $data['subview']      = 'master/blank';
    $data['sidebar']      = $this->sidebar;
    $this->load->view('index', $data);
  }

  public function wps_list($download = null)
  {

    $datadb = $this->general_mod->discipline();
    $discipline_list = [];
    foreach ($datadb as $key => $value) {
      $discipline_list[$value['id']] = $value;
    }
    $data['discipline_list'] = $discipline_list;

    $where_id['status_register'] = "1";
    $datadb = $this->general_mod->material_grade($where_id);
    $material_grade_list = [];
    foreach ($datadb as $key => $value) {
      $material_grade_list[$value['id']] = $value;
    }
    $data['material_grade_list'] = $material_grade_list;
    unset($where_id);

    $where['status'] = "1";
    $datadb = $this->general_mod->master_welder_process($where);
    unset($where);
    foreach ($datadb as $key => $value) {
      $data['master_welder_process'][$value['id']] = $value['name_process'];
    }

    $where_id['status_register'] = "1";
    $datadb = $this->general_mod->joint_type($where_id);
    $joint_type_list = [];
    foreach ($datadb as $key => $value) {
      $joint_type_list[$value['id']] = $value;
    }
    $data['joint_type_list'] = $joint_type_list;
    unset($where_id);

    $where["project_id IN (" . join(",", $this->user_cookie[13]) . ")"] = NULL;
    // test_var($_POST);

    $post = $this->input->post();
    if (@$post['company_id'] != '') {
      $where['company_id'] = @$post['company_id'];
    }
    if (@$post['project_id'] != '') {
      $where['project_id'] = @$post['project_id'];
    }
    if (@$post['discipline'] != '') {
      $where['discipline'] = @$post['discipline'];
    }

    $where['status_delete'] = 1;
    $wps_list = $this->m_wps_mod->wps_list($where);
    $data['wps_list']         = $wps_list;
    unset($where);

    $datadb = $this->general_mod->project();
    // test_var($datadb);
    foreach ($datadb as $key => $value) {
      $data['master_project'][$value['id']] = $value;
    }

    $detail_list = $this->m_wps_mod->wps_detail_list();
    foreach ($detail_list as $key => $value) {
      $data['wps_detail_list'][$value['id_main']][] = $value;
    }

    $company_list = $this->general_mod->company();
    foreach ($company_list as $value) {
      $data['company_list'][$value['id_company']] = $value;
    }

    $data['meta_title']     = 'WPS Register';
    if (isset($download)) {
      $data['subview']      = 'master/wps/wps_excel';
      $this->load->view($data['subview'], $data);
    } else {
      $data['subview']      = 'master/wps/wps_list';
      $this->load->view('index', $data);
    }
  }

  public function wps_new($id = null)
  {

    $datadb = $this->general_mod->discipline();
    $discipline_list = [];
    foreach ($datadb as $key => $value) {
      $discipline_list[$value['id']] = $value;
    }
    $data['discipline_list'] = $discipline_list;

    $where['status'] = "1";
    $data['master_weld_process'] = $this->general_mod->master_welder_process($where);

    $where_id['status_register'] = "1";
    $datadb = $this->general_mod->material_grade($where_id);
    $material_grade_list = [];
    foreach ($datadb as $key => $value) {
      $material_grade_list[$value['id']] = $value;
    }
    $data['material_grade_list'] = $material_grade_list;
    unset($where_id);

    $where_id['status_register'] = "1";
    $datadb = $this->general_mod->joint_type($where_id);
    $joint_type_list = [];
    foreach ($datadb as $key => $value) {
      $joint_type_list[$value['id']] = $value;
    }
    $data['joint_type_list'] = $joint_type_list;
    unset($where_id);

    $module = "new";
    if ($id) {
      $module = "update";
      $id = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
      $wps_list = $this->m_wps_mod->wps_list([
        "id" => $id,
      ]);
      $data['wps']        = $wps_list[0];
    }

    $data['module']       = $module;

    $data['company_list'] = $this->general_mod->company();
    $data['project_list'] = $this->general_mod->project();

    $data['meta_title']   = ucfirst($module) . ' Wps';
    $data['subview']      = 'master/wps/wps_new';
    $this->load->view('index', $data);
  }

  public function wps_save_process()
  {

    $wps_no             = $this->input->post('wps_no');
    $wps_revision       = $this->input->post('wps_revision');
    $discipline         = $this->input->post('discipline');
    $remarks            = $this->input->post('remarks');
    $status_wps         = $this->input->post('status_wps');
    $client_doc_no         = $this->input->post('client_doc_no');
    $pqr_no         = $this->input->post('pqr_no');
    $position_welding_progression         = $this->input->post('position_welding_progression');
    $ctod_requirement         = $this->input->post('ctod_requirement');
    $consumable_brand         = $this->input->post('consumable_brand');
    $consumable_classification         = $this->input->post('consumable_classification');
    $document_pwps_wps         = $this->input->post('document_pwps_wps');

    $process            = $this->input->post('process');
    $material_grade     = $this->input->post('material_grade');
    $thickness          = $this->input->post('thickness');
    $diameter           = $this->input->post('diameter');
    $type_of_joint      = $this->input->post('type_of_joint');

    $id_req             = $this->input->post('id_req');
    $company_id         = $this->input->post('company_id');
    $project_id         = $this->input->post('project_id');
    // test_var($_POST);

    if ($wps_no) {

      foreach ($wps_no as $key => $value) {

        // $dataftp  = $this->general_mod->ftp_find_master_with_condition($_SERVER["SERVER_ADDR"], "10.5.252.116/pcms_v2_photo");

        if ($_FILES['attachment_1']['name'][$key] != "") {

          require_once(APPPATH . 'third_party/Net/SFTP.php');
          $ftp                        = $this->ftp;
          $sftp                       = new Net_SFTP($ftp['hostname']);
          $destination_source         = '/PCMS/pcms_v2/wps_attachment/';

          if (!$sftp->login($ftp['username'], $ftp['password'])) {
            $this->session->set_flashdata('error', 'FTP Server Not Working');
            redirect($_SERVER['HTTP_REFERER']);
          }

          $filetype           = pathinfo($_FILES['attachment_1']['name'][$key]);
          $filetype           = $filetype['extension'];

          if ($filetype == "pdf") {
            $filename           = 'WPS_attachment_' . uniqid() . '_.' . $filetype;
            $attach_line_name   = $filename;
            $filepath           = 'upload/';
            move_uploaded_file($_FILES['attachment_1']['tmp_name'][$key], $filepath . $attach_line_name);
            $fileName                 = $attach_line_name;
            $source                   = $filepath . $attach_line_name;
            $destination              = $destination_source . $attach_line_name;
            $sftp->put($destination, $source, NET_SFTP_LOCAL_FILE);
            // @unlink($source);
          } else {
            $this->session->set_flashdata('error', 'Only For PDF File..!');
            redirect($_SERVER['HTTP_REFERER']);
          }
          $attachment_1 = $filename;
        } else {
          $attachment_1 = null;
        }

        $form_data = [
          "wps_no"        => $wps_no[$key],
          "company_id"    => intval($company_id[$key]),
          "project_id"    => intval($project_id[$key]),
          "wps_revision"  => $wps_revision[$key],
          "discipline"    => $discipline[$key],
          "remarks"       => $remarks[$key],
          "attachment"    => $attachment_1,
          "status_wps"    => $status_wps[$key],
          "client_doc_no"    => $client_doc_no[$key],
          "pqr_no"    => $pqr_no[$key],
          "position_welding_progression"    => $position_welding_progression[$key],
          "ctod_requirement"    => $ctod_requirement[$key],
          "consumable_brand"    => $consumable_brand[$key],
          "consumable_classification"    => $consumable_classification[$key],
          "document_pwps_wps"    => $document_pwps_wps[$key],
          "create_by"     => $this->user_cookie[0],
          "create_date"   => DATE("Y-m-d H:i:s"),
        ];
        $insert_wps  =  $this->m_wps_mod->wps_new_process_db($form_data);
        unset($form_data);

        foreach ($id_req[$key] as $k => $v) {
          $form_data_req = [
            "id_main"         => $insert_wps,
            // "process"         => $process[$key][$k],
            "id_weld_process" => $process[$key][$k],
            "material_grade"  => $material_grade[$key][$k],
            "thickness"       => $thickness[$key][$k],
            "diameter"        => $diameter[$key][$k],
            "type_of_joint"   => $type_of_joint[$key][$k],
          ];
          $insert_wps_detail  =  $this->m_wps_mod->wps_new_req_process_db($form_data_req);
          unset($form_data_req);
        }
      }
    }

    $this->session->set_flashdata('success', 'New Wps are created!');
    redirect($_SERVER["HTTP_REFERER"]);
  }

  public function wps_update_process()
  {

    $id_wps_main        = $this->input->post('id_wps_main');

    $wps_no             = $this->input->post('wps_no');
    $wps_revision       = $this->input->post('wps_revision');

    $discipline         = $this->input->post('discipline');
    $remarks            = $this->input->post('remarks');
    $status_wps         = $this->input->post('status_wps');

    $process            = $this->input->post('process');
    $material_grade     = $this->input->post('material_grade');
    $thickness          = $this->input->post('thickness');
    $diameter           = $this->input->post('diameter');
    $type_of_joint      = $this->input->post('type_of_joint');
    $company_id         = $this->input->post('company_id');
    $project_id         = $this->input->post('project_id');

    $client_doc_no         = $this->input->post('client_doc_no');
    $pqr_no         = $this->input->post('pqr_no');
    $position_welding_progression         = $this->input->post('position_welding_progression');
    $ctod_requirement         = $this->input->post('ctod_requirement');
    $consumable_brand         = $this->input->post('consumable_brand');
    $consumable_classification         = $this->input->post('consumable_classification');
    $document_pwps_wps         = $this->input->post('document_pwps_wps');

    $id_req             = $this->input->post('id_req');
    if ($wps_no) {

      foreach ($wps_no as $key => $value) {

        if ($_FILES['attachment_1']['name'][$key] != "") {

          require_once(APPPATH . 'third_party/Net/SFTP.php');
          $ftp                        = $this->ftp;
          $sftp                       = new Net_SFTP($ftp['hostname']);
          $destination_source         = '/PCMS/pcms_v2/wps_attachment/';

          if (!$sftp->login($ftp['username'], $ftp['password'])) {
            $this->session->set_flashdata('error', 'FTP Server Not Working');
            redirect($_SERVER['HTTP_REFERER']);
          }

          $filetype           = pathinfo($_FILES['attachment_1']['name'][$key]);
          $filetype           = $filetype['extension'];

          if ($filetype == "pdf") {

            $filename           = 'WPS_attachment_' . uniqid() . '_.' . $filetype;
            $attach_line_name   = $filename;
            $filepath           = 'upload/';
            move_uploaded_file($_FILES['attachment_1']['tmp_name'][$key], $filepath . $attach_line_name);
            $fileName                 = $attach_line_name;
            $source                   = $filepath . $attach_line_name;
            $destination              = $destination_source . $attach_line_name;
            $sftp->put($destination, $source, NET_SFTP_LOCAL_FILE);
            // @unlink($source);

          } else {
            $this->session->set_flashdata('error', 'Only For PDF File..!');
            redirect($_SERVER['HTTP_REFERER']);
          }

          $attachment_1 = $filename;
        }

        // ----------- Start - Process Update Main WPS Data  ------------- //

        $form_data = [
          "wps_no"         => $wps_no[$key],
          "wps_revision"   => $wps_revision[$key],
          "company_id"      => intval($company_id[$key]),
          "project_id"      => intval($project_id[$key]),
          "discipline"     => $discipline[$key],
          "remarks"        => $remarks[$key],
          "status_wps"     => $status_wps[$key],
          "client_doc_no"     => $client_doc_no[$key],
          "pqr_no"     => $pqr_no[$key],
          "position_welding_progression"     => $position_welding_progression[$key],
          "ctod_requirement"     => $ctod_requirement[$key],
          "consumable_brand"     => $consumable_brand[$key],
          "consumable_classification"     => $consumable_classification[$key],
          "document_pwps_wps"     => $document_pwps_wps[$key],
        ];
        if ($_FILES['attachment_1']['name'][$key] != "") {
          $form_data["attachment"] = $attachment_1;
        }

        $where['id_wps'] = $id_wps_main[$key];
        $insert_wps  = $this->m_wps_mod->update_wps($form_data, $where);
        unset($form_data, $where);

        // ----------- End - Process Update Main WPS Data  ------------- //

        // ----------- Start - Process Update Detail WPS Data  ------------- //

        foreach ($id_req[$key] as $k => $v) {

          $form_data_req = [
            "id_main"        => $id_wps_main[$key],
            // "process"        => $process[$key][$k],
            "id_weld_process"   => $process[$key][$k],
            "material_grade" => $material_grade[$key][$k],
            "thickness"      => $thickness[$key][$k],
            "diameter"       => $diameter[$key][$k],
            "type_of_joint"  => $type_of_joint[$key][$k],
          ];

          if ($id_req[$key][$k] == "new_row") {
            $insert_wps_detail  =  $this->m_wps_mod->wps_new_req_process_db($form_data_req);
            unset($form_data_req);
          } else {
            $where['id_wps'] = $id_req[$key][$k];
            $insert_wps  = $this->m_wps_mod->update_wps_detail($form_data_req, $where);
            unset($form_data, $where);
          }

          // ----------- End - Process Update Detail WPS Data  ------------- //

        }
      }
    }

    $this->session->set_flashdata('success', 'New Wps are created!');
    redirect($_SERVER["HTTP_REFERER"]);
  }

  public function wps_import()
  {
    $data['meta_title']       = 'Import Template';
    $data['user_permission']  = $this->permission_cookie;
    $data['subview']          = 'master/wps/wps_import';
    $this->load->view('index', $data);
  }

  public function import_wps_register_preview()
  {
    $config['upload_path']          = 'file/wps/';
    $config['file_name']            = 'excel_' . $this->user_cookie[0];
    $config['allowed_types']        = 'xlsx';
    $config['overwrite']             = TRUE;

    $this->load->library('upload');
    $this->upload->initialize($config);

    if (!$this->upload->do_upload('file')) {
      $this->session->set_flashdata('error', $this->upload->display_errors());
      redirect($_SERVER["HTTP_REFERER"]);
      return false;
    }

    include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

    $excelreader = new PHPExcel_Reader_Excel2007();
    $loadexcel = $excelreader->load($config['upload_path'] . $this->upload->data('file_name')); // Load file yang telah diupload ke folder excel
    $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
    if (count($sheet) < 2) {
      $this->session->set_flashdata('error', 'No Data that listed in excel template!');
      redirect($_SERVER["HTTP_REFERER"]);
      return false;
    }

    $data_check = array();
    $wps_check = array();
    $numrow = 1;
    foreach ($sheet as $no_row => $row) {
      if ($numrow > 1) {
        $data_check[] = $row['A'];
        foreach ($row as $key => $value) {
          if (in_array($key, ['A']) && $sheet[$no_row][$key] != "") {
            $wps_check[] = $sheet[$no_row][$key];
          }
        }
      }
      $numrow++;
    }
    $existing_wps = [];
    if (count($wps_check) > 0) {
      $datadb = $this->m_wps_mod->wps_list([
        "wps_no IN ('" . join("', '", $wps_check) . "')" => NULL,
        // "status_delete" => 1,
      ]);
      foreach ($datadb as $key => $value) {
        $existing_wps[] = $value['wps_no'];
      }
    }
    $data['existing_wps'] = $existing_wps;

    // $document_duplicate		= $this->m_wps_mod->wps_list([
    // 	"status_delete" => 1,
    // ]);
    // $d = array();
    // foreach ($document_duplicate as $value) {
    // 	$d[] = $value['part_id'];
    // }
    $data['sheet'] = $sheet;
    // $data['document_duplicate']		= $d;

    $datadb = $this->general_mod->discipline();
    $discipline_list = [];
    foreach ($datadb as $key => $value) {
      $discipline_list[$value['initial']] = $value;
    }
    $data['discipline_list'] = $discipline_list;

    $datadb = $this->general_mod->project();
    $project_list = [];
    foreach ($datadb as $key => $value) {
      $project_list[$value['project_code']] = $value;
    }
    $data['project_list'] = $project_list;

    $datadb = $this->general_mod->company();
    $company_list = [];
    foreach ($datadb as $key => $value) {
      $company_list[$value['id_company']] = $value;
    }
    $data['company_list'] = $company_list;

    $datadb = $this->general_mod->master_welder_process();
    $welder_process_list = [];
    foreach ($datadb as $key => $value) {
      $welder_process_list[$value['id']] = $value;
    }
    $data['welder_process_list'] = $welder_process_list;

    $datadb = $this->general_mod->joint_type();
    $joint_type_list = [];
    foreach ($datadb as $key => $value) {
      $joint_type_list[$value['joint_type_code']] = $value;
    }
    $data['joint_type_list'] = $joint_type_list;

    $datadb = $this->general_mod->material_grade();
    $material_grade_list = [];
    foreach ($datadb as $key => $value) {
      $material_grade_list[$value['material_grade']] = $value;
    }
    $data['material_grade_list'] = $material_grade_list;

    $data['meta_title']   = 'Import WPS Register Preview';
    $data['subview']      = 'master/wps/import_wps_register_preview';
    $data['user_permission'] = $this->permission_cookie;
    $this->load->view('index', $data);
  }

  public function import_wps_register_process()
  {
    $post = $this->input->post();
    $form_data = [];
    $date_now = date('Y-m-d H:i:s');
    $id_wps_cache = [];


    foreach ($post['wps_no'] as $key => $value) {
      $form_data = [
        "wps_no"                => $post['wps_no'][$key],
        "company_id"            => $post['company'][$key],
        "project_id"            => $post['project'][$key],
        "wps_revision"          => $post['wps_revision'][$key],
        "discipline"            => $post['discipline'][$key],
        "remarks"               => $post['remarks'][$key],
        "status_wps"            => $post['wps_status'][$key] == 'Actived' ? '1' : '2',
        "create_date"           => $date_now,
        "create_by"             => $this->user_cookie[0],
      ];

      // test_var($form_data);

      // if (count($form_data) < 1) {
      //   $this->session->set_flashdata('error', 'No Data inputed!');
      //   redirect($_SERVER["HTTP_REFERER"]);
      //   return false;
      // }
      $cache_key = md5(serialize($form_data));
      if (isset($id_wps_cache[$cache_key])) {
        $id_wps = $id_wps_cache[$cache_key];
      } else {
        // If not, insert into 'master_wps' and store the id_wps in the cache
        $id_wps = $this->m_wps_mod->wps_list_insert($form_data);
        $id_wps_cache[$cache_key] = $id_wps;
      }

      // $id_wps = $this->m_wps_mod->wps_list_insert($form_data);

      $detail_data = [
        "id_main"               => $id_wps,
        "id_weld_process"       => $post['process'][$key],
        "type_of_joint"         => $post['type_of_joint'][$key],
        "material_grade"        => $post['material_grade'][$key],
        "thickness"             => $post['thickness_range'][$key],
        "diameter"              => $post['diameter_range'][$key],
      ];
      $this->m_wps_mod->wps_detail_list_insert($detail_data);
    }

    $this->session->set_flashdata('success', 'The Data has been Imported!');
    redirect("master/wps/wps_import");
  }



  public function wps_update_pages($id = null)
  {

    $datadb = $this->general_mod->discipline();
    $discipline_list = [];
    foreach ($datadb as $key => $value) {
      $discipline_list[$value['id']] = $value;
    }
    $data['discipline_list'] = $discipline_list;

    $where['status'] = "1";
    $data['master_weld_process'] = $this->general_mod->master_welder_process($where);

    $where_id['status_register'] = "1";
    $datadb = $this->general_mod->material_grade($where_id);
    $material_grade_list = [];
    foreach ($datadb as $key => $value) {
      $material_grade_list[$value['id']] = $value;
    }
    $data['material_grade_list'] = $material_grade_list;
    unset($where_id);

    $where_id['status_register'] = "1";
    $datadb = $this->general_mod->joint_type($where_id);
    $joint_type_list = [];
    foreach ($datadb as $key => $value) {
      $joint_type_list[$value['id']] = $value;
    }
    $data['joint_type_list'] = $joint_type_list;
    unset($where_id);

    $id = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
    $wps_list = $this->m_wps_mod->wps_list(["id_wps" => $id,]);
    $data['wps_list']      = $wps_list;

    $detail_list = $this->m_wps_mod->wps_detail_list(["id_main" => $id,]);
    foreach ($detail_list as $key => $value) {
      $data['wps_detail_list'][$value['id_main']][] = $value;
    }

    $data['company_list'] = $this->general_mod->company();
    $data['project_list'] = $this->general_mod->project();

    $data['meta_title']   = 'WPS Update';
    $data['subview']      = 'master/wps/wps_update';
    //$data['sidebar']      = $this->sidebar;
    $this->load->view('index', $data);
  }


  public function delete_detail_wps()
  {
    $id_wps           = $this->input->post('id_wps');
    $where['id_wps']  = $id_wps;
    $this->m_wps_mod->delete_detail_wps($where);
    unset($where);

    echo json_encode([
      'success'     => true
    ]);
  }

  public function delete_wps_list()
  {
    $list_existing_wps  = [];

    $wps_in_template    = $this->m_wps_mod->wps_template_joint();
    foreach ($wps_in_template as $value) {
      $explode          = explode(";", $value['wps']);
      foreach ($explode as $v) {
        if (!in_array($v, $list_existing_wps)) {
          $list_existing_wps[] = $v;
        }
      }
    }

    $wps_in_template_fitup    = $this->m_wps_mod->wps_template_joint_fitup();
    foreach ($wps_in_template_fitup as $value) {
      $explode          = explode(";", $value['wps_no']);
      foreach ($explode as $v) {
        if (!in_array($v, $list_existing_wps)) {
          $list_existing_wps[] = $v;
        }
      }
    }

    $wps_in_template_visual    = $this->m_wps_mod->wps_template_joint_visual();
    foreach ($wps_in_template_visual as $value) {
      $explode1          = explode(";", $value['wps_no_rh']);
      $explode2          = explode(";", $value['wps_no_fc']);
      foreach ($explode1 as $v) {
        if (!in_array($v, $list_existing_wps)) {
          $list_existing_wps[] = $v;
        }
      }

      foreach ($explode2 as $v) {
        if (!in_array($v, $list_existing_wps)) {
          $list_existing_wps[] = $v;
        }
      }
    }

    $id          = $this->input->post('id_wps');

    if (in_array($id, $list_existing_wps)) {
      echo json_encode([
        'success'     => false,
        'message'     => "WPS Already Submitted"
      ]);
    } else {
      $form_data = [
        "status_delete" => 0,
      ];

      $this->m_wps_mod->delete_wps_list($form_data, [
        "id_wps"       => $id,
      ]);

      echo json_encode([
        'success'     => true
      ]);
    }
  }


  public function check_wps_register($wps_no, $status = null)
  {

    if (isset($status)) {

      $where_no['wps_no'] = $wps_no;
      $database = $this->m_wps_mod->wps_list($where_no);
      unset($where_no);

      if (sizeof($database) > 0) {
        if ($status == $database[0]['id_wps']) {
          echo json_encode(0);
        } else {
          echo json_encode(1);
        }
      } else {
        $where_no['wps_no'] = $wps_no;
        $databasex = $this->m_wps_mod->wps_list($where_no);
        echo json_encode(sizeof($databasex));
        unset($where_no);
      }
    } else {

      $where_no['wps_no'] = $wps_no;
      $database = $this->m_wps_mod->wps_list($where_no);
      echo json_encode(sizeof($database));
      unset($where_no);
    }
  }
}
