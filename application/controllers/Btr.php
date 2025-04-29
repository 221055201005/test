<?php

class Btr extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('browser');
    $this->load->helper('cookies');
    $data_cookies = helper_cookies(@$this->input->get('user'));

    $this->load->model('home_mod');
    $this->load->model('general_mod');

    $this->load->model('engineering_mod');
    $this->load->model('planning_mod');
    $this->load->model('bondstrand_mod');
    $this->load->model('wtr_mod');
    $this->load->model('irn_mod');
    $this->load->model('btr_mod');
    $this->load->model('bondstrand_mod');
    $this->load->model('master/welder_mod', 'm_welder_mod');


    $this->user_cookie         = $data_cookies['data_user'];
    $this->permission_cookie  = $data_cookies['data_permission'];
    $this->sidebar             = "btr/sidebar";
    $this->is_admin           = $this->permission_cookie[0];
    $this->smtp                = smtp_config();

    $this->ftp                = ftp_config_syn();
    $this->prod_server        = [];
    $this->server_list        = $this->general_mod->portal_server_list();
    $this->prod_server        = array_column($this->server_list, 'ip_address');
    $this->ip_server          = $_SERVER['SERVER_ADDR'];
    $this->user_id            = $this->user_cookie[0];
    $this->timestamp          = date('Y-m-d H:i:s');

    $status_list[0]             = [
      'text'                    => "Draft",
      'color'                   => "secondary"
    ];

    $status_list[1]             = [
      'text'                    => "Pending By QC",
      'color'                   => "warning"
    ];

    $status_list[3]             = [
      'text'                    => "Approved by QC",
      'color'                   => "success"
    ];

    $status_list[5]             = [
      'text'                    => "Pending by Client",
      'color'                   => "warning"
    ];

    $status_list[7]             = [
      'text'                    => "Approved by Client",
      'color'                   => "success"
    ];

    $status_list[9]             = [
      'text'                    => "Acc. And Released With Comments",
      'color'                   => "primary"
    ];

    $status_list[11]             = [
      'text'                    => "Re-Offer by Client",
      'color'                   => "warning"
    ];

    $this->status_list          = $status_list;

    $where["category ILIKE '%bonstrand%'"] = null;
    $master_report              = $this->general_mod->master_report_number($where);
    unset($where);

    foreach($master_report as $value) {
      $this->format_report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']][$value['category']] = $value['report_no'];
    }

    $this->project_alt        = $this->user_cookie[13];
    $this->company_alt        = $this->user_cookie[14];
    $this->allowed_user         = [1, 1000297, 1000226, 1000487];

  }

  public function index()
  {
    redirect('btr/btr_list');
  }

  public function btr_list()
  { 
    $where                    = null;
    if(!$this->is_admin) {
      $where[implode_where("id", $this->project_alt)] = null;
    }
    $data['project_list']     = $this->general_mod->project($where);
    unset($where);

    $data['discipline_list']  = $this->general_mod->discipline();
    $data['module_list']      = $this->general_mod->module();
    $data['type_of_module']   = $this->general_mod->type_of_module();

    $data['serverside']       = "btr/serverside_drawing_list";
    $data['meta_title']       = 'Bonding Traceability Report';
    $data['subview']          = "btr/btr_list";
    $data['user_permission']  = $this->permission_cookie;
    $data['sidebar']          = $this->sidebar;
    $data['user_cookie']      = $this->user_cookie;

    $this->load->view('index', $data);
  }

  public function serverside_drawing_list()
  {
    error_reporting(0);
    $data                     = [];

    $project_id               = $this->input->post('project_id');
    $discipline_filter        = $this->input->post('discipline');
    $module_filter            = $this->input->post('module');
    $type_of_module_filter    = $this->input->post('type_of_module');
    $drawing_no               = $this->input->post('drawing_no');

    $where_btr                = null;

    if($project_id != "") {
      $where_btr["project"]     = $project_id;
    } else {
      if(!$this->is_admin) {
        $where_btr[implode_where("project", $this->project_alt)]  = null;
      }
    }

    if($discipline_filter != "") {
      $where_btr["discipline"]      = $discipline_filter;
    }

    if($module_filter != "") {
      $where_btr["module"]          = $module_filter;
    }

    if($type_of_module_filter != "") {
      $where_btr["type_of_module"]      = $type_of_module_filter;
    }

    if(trim($drawing_no) != "") {
      $where_btr["drawing_no ILIKE '%$drawing_no%'"]      = null;
    }

    $where_btr['is_bondstrand'] = 1;
    $list                       = $this->btr_mod->serverside_drawing_list($where_btr);

    if ($list) {
      $discipline_list          = $this->general_mod->discipline();
      foreach ($discipline_list as $value) {
        $discipline[$value['id']] = $value;
      }

      $module_list              = $this->general_mod->module();
      foreach ($module_list as $value) {
        $module[$value['mod_id']] = $value;
      }

      $type_of_module_list      = $this->general_mod->type_of_module();
      foreach ($type_of_module_list as $value) {
        $type_of_module[$value['id']] = $value;
      }

      $drawing_type_list        = $this->general_mod->drawing_type();
      foreach ($drawing_type_list as $value) {
        $drawing_type[$value['id']] = $value;
      }

      $project_list             = $this->general_mod->project();
      foreach ($project_list as $value) {
        $project[$value['id']]  = $value;
      }
    }

    foreach ($list as $value) {
      $encrypt_drawing_no     = encrypt($value['drawing_no']);

      $button_list            = '<div class="btn-group">';
      $button_list            .= '<a href="' . site_url('btr/detail_btr/' . $encrypt_drawing_no) . '"  class="btn btn-primary"><i class="fas fa-list"></i> Detail</a>';
      $button_list            .= '</div>';

      $row                    = [];
      $row[]                  = $project[$value['project']]['project_name'];
      $row[]                  = $value['drawing_no'];
      $row[]                  = $drawing_type[$value['drawing_type']]['description'];
      $row[]                  = $value['test_pack_no'];
      $row[]                  = $discipline[$value['discipline']]['discipline_name'];
      $row[]                  = $module[$value['module']]['mod_desc'];
      $row[]                  = $type_of_module[$value['type_of_module']]['name'];
      $row[]                  = $button_list;

      $data[]                 = $row;
    }

    $result                   = [
      "draw"                  => $_POST['draw'],
      "recordsTotal"          => $this->btr_mod->count_serverside_drawing_list_all($where_btr),
      "recordsFiltered"       => $this->btr_mod->count_serverside_drawing_list_filtered($where_btr),
      "data"                  => $data
    ];

    unset($where_btr);
    echo json_encode($result);
  }

  public function detail_btr($drawing_no_enc = null)
  {
    $drawing_no               = decrypt($drawing_no_enc);
    if (!$drawing_no) {
      redirect('btr/btr_list');
    }

    $where['document_no']     = $drawing_no;
    $data_drawing           = $this->wtr_mod->data_drawing_list_mysql($where);
    unset($where);

    if ($data_drawing) {
      foreach ($data_drawing as $value) {
        $data['data_drawing'][$value['document_no']] = $value;
      }
    }

    $where['drawing_no']      = $drawing_no;
    $where['is_bondstrand']   = 1;
    $where['status_delete']   = 1;

    $order_by                 = ["id" => "asc"];
    $data['joint_list']       = $this->engineering_mod->joint_list($where, null, $order_by);
    unset($where);

    if ($data['joint_list']) {

      foreach ($data['joint_list'] as $value) {
        $list_id_joint[]        = $value['id'];
        $list_part_id[]         = $value['pos_1'];
        $list_part_id[]         = $value['pos_2'];
        $list_drawing_no[]      = $value['drawing_no'];
      }

      $where[implode_where("document_no", $list_drawing_no)]  = null;
      $where['status_delete']   = 1;
			$drawing_list             = $this->wtr_mod->data_drawing_list($where);
      unset($where);

      foreach($drawing_list as $value) {
        $data['drawing'][$value['document_no']] = $value;
      }

      $where[implode_where("part_id", $list_part_id)] = NULL;
      $piecemark_list       = $this->engineering_mod->piecemark_list($where);
      unset($where);
      foreach ($piecemark_list as $value) {
        $data['piecemark'][$value['part_id']] = $value;
      }

      $where[implode_where("id_joint", $list_id_joint)] = NULL;
      $where['status_delete']   = 1;
      $baa_list                 = $this->bondstrand_mod->bondstrand_list($where);
      unset($where);

      foreach ($baa_list as $value) {
        $data['baa'][$value['id_joint']]  = $value;
      }

      // CHECK IRN

      $where[implode_where("id_joint", $list_id_joint)] = null;
      $irn_list                 = $this->irn_mod->irn_list($where);
      unset($where);

      $data['irn_list']         = $irn_list;

      if($irn_list) {
        foreach($irn_list as $value) {
          $list_user_id[]         = intval($value['smoe_approval_by']);
          $list_user_id[]         = intval($value['client_approval_by']);
        }
  
        if($list_user_id) {
          $where[implode_where('id_user', $list_user_id)] = null;
          $select                 = "id_user, full_name, sign_approval";
          $user_list              = $this->general_mod->portal_user_db_list($where, null, $select);
          unset($where);

          if($user_list) {
            foreach($user_list as $value) {
              $data['user'][$value['id_user']]  = $value;
            }
          }
        }
      }

      $project_list             = $this->general_mod->project();
      foreach ($project_list as $value) {
        $data['project'][$value['id']]  = $value;
      }

      $discipline_list          = $this->general_mod->discipline();
      foreach ($discipline_list as $value) {
        $data['discipline'][$value['id']] = $value;
      }

      $module_list              = $this->general_mod->module();
      foreach ($module_list as $value) {
        $data['module'][$value['mod_id']] = $value;
      }

      $type_of_module_list      = $this->general_mod->type_of_module();
      foreach ($type_of_module_list as $value) {
        $data['type_of_module'][$value['id']] = $value;
      }

      $company_list             = $this->general_mod->company();
      foreach ($company_list as $value) {
        $data['company'][$value['id_company']]  = $value;
      }

      $area_list                = $this->general_mod->area_v2();
      foreach ($area_list as $value) {
        $data['area'][$value['id']] = $value;
      }

      $location_list            = $this->general_mod->location_v2();
      foreach ($location_list as $value) {
        $data['location'][$value['id']] = $value;
      }

      $bonder_list              = $this->bondstrand_mod->bonder_list();
      foreach ($bonder_list as $value) {
        $data['bonder'][$value['id']] = $value;
      }
    }
    $data['from_signed']        = 0;
    $data['meta_title']         = "Detail BTR";
    $this->load->view('btr/detail_btr', $data);
  }

  public function btr_export() {

    $where                    = null;
    if(!$this->is_admin) {
      $where[implode_where("id", $this->project_alt)] = null;
    } 

    $data['project_list']     = $this->general_mod->project($where);
    unset($where);

    $data['discipline_list']  = $this->general_mod->discipline();
    $module_list              = $this->general_mod->module();

    foreach($module_list as $value) {
      $data['module'][$value['project_id']][] = $value;
    }

    $data['type_of_module']   = $this->general_mod->type_of_module();

    $data['meta_title']       = 'Bonding Traceability Report - Export';
    $data['subview']          = "btr/btr_export";
    $data['user_permission']  = $this->permission_cookie;
    $data['sidebar']          = $this->sidebar;
    $data['user_cookie']      = $this->user_cookie;

    $this->load->view('index', $data);
  }

  public function export_api() {
    error_reporting(0);
    $post_data                = $this->input->post();
    $project_id               = encode_jwt($post_data['project_id']);
    $discipline               = encode_jwt($post_data['discipline']);
    $module                   = encode_jwt($post_data['module']);
    $type_of_module           = encode_jwt($post_data['type_of_module']);
    $drawing_no               = encode_jwt($post_data['drawing_no']);
    $user_id_enc              = encode_jwt($this->user_cookie[0]);

    $expired_date             = date('Y-m-d H:i:s', strtotime("+10 minutes"));
    $expired_date             = encode_jwt($expired_date);
    $client_ip                = encode_jwt($this->user_cookie[12]);

    redirect(export_link()."/btrexport?project_id=$project_id&discipline=$discipline&module=$module&type_of_module=$type_of_module&drawing_no=$drawing_no&user_id=$user_id_enc&expired_date=$expired_date&client_ip=$client_ip");
    return;
  }

  public function import_joint($drawing_no = null, $uniq_id = null) {

    $data['drawing_no_btr']   = decrypt($drawing_no);
    $data['uniq_id_btr']      = decrypt($uniq_id);

    $data['meta_title']       = "BTR - Import Joint";
    $data['subview']          = "btr/import_joint";
    $data['user_permission']  = $this->permission_cookie;
    $data['sidebar']          = $this->sidebar;
    $data['user_cookie']      = $this->user_cookie;

    $this->load->view('index', $data);
  }

  public function preview_import_joint() {

    $id_user                  = $this->user_cookie;
    $config['upload_path']    = 'upload/';
    $config['file_name']      = 'excel_ntr_'.$id_user[0];
    $config['allowed_types']  = 'xlsx';
    $config['overwrite'] 			= TRUE;

    $data['drawing_no_btr']   = $this->input->post('drawing_no_btr');
    $data['uniq_id_btr']      = $this->input->post('uniq_id_btr');

    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if ( ! $this->upload->do_upload('file')){
      $this->session->set_flashdata('error', $this->upload->display_errors());
      redirect("btr/import_joint");
      return false;
    }

    include APPPATH.'third_party/PHPExcel/PHPExcel.php';
    $excelreader 			      = new PHPExcel_Reader_Excel2007();
    $loadexcel 				      = $excelreader->load('upload/'.$this->upload->data('file_name'));
    $sheet 					        = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

    unlink('upload/'.$this->upload->data('file_name'));

    $list_drawing_no        = [];
    $list_uniq_id           = [];

    foreach($sheet as $key => $value) {
      $value['A']           = trim($value['A']);
      $value['B']           = trim($value['B']);
      $value['C']           = trim($value['C']);

      if($key > 1 && trim($value['A']) != "") {
        $list_drawing_no[]          = $value['A'];
        $list_uniq_id[$value['A']]  = uniqid();
      }

      $sheet[$key]          = $value;
    }


    if(!$list_drawing_no) {
      $this->session->set_flashdata('error','No Data to Proceed');
      redirect($_SERVER['HTTP_REFERER']);
    }

    $data['list_uniq_id']       = $list_uniq_id;

    $where[implode_where("b.drawing_no", $list_drawing_no)] = null;
    $where['b.status_delete'] = 1;
    $where['b.is_bondstrand'] = 1;
    $datadb                   = $this->irn_mod->show_pcms_irn($where);
    unset($where);

    foreach($datadb as $value) {
      $data['irn'][$value['drawing_no']][$value['drawing_wm']][$value['joint_no']]  = $value;
    }

    $where[implode_where("a.drawing_no", $list_drawing_no)] = null;
    $where['a.status_delete'] = 1;
    $where['a.is_bondstrand'] = 1;
    $datadb                   = $this->wtr_mod->show_pcms_joint_wp($where);
    unset($where);

		foreach ($datadb as $key => $value) {
			$data['wp'][$value['drawing_no']][$value['drawing_wm']][$value['joint_no']] = $value;
		}

    $where[implode_where("a.drawing_no", $list_drawing_no)] = null;
    $where['a.status_deleted']  = 1;
    $datadb                     = $this->btr_mod->btr_signed_join($where);
    unset($where);

		foreach ($datadb as $key => $value) {
			$data['btr'][$value['drawing_no']][$value['drawing_wm']][$value['joint_no']] = $value;
		}

    $data['sheet']            = $sheet;

    $data['meta_title']       = "BTR - Preview Import Joint";
    $data['subview']          = "btr/preview_import_joint";
    $data['user_permission']  = $this->permission_cookie;
    $data['sidebar']          = $this->sidebar;
    $data['user_cookie']      = $this->user_cookie;

    $this->load->view('index', $data);
  }

  public function proceed_import_joint() {
    $drawing_no               = $this->input->post('drawing_no');
    $uniq_id                  = $this->input->post('uniq_id');
    $drawing_wm               = $this->input->post('drawing_wm');
    $id_joint                 = $this->input->post('id_joint');
    $project                  = $this->input->post('project');
    $discipline               = $this->input->post('discipline');
    $module                   = $this->input->post('module');
    $type_of_module           = $this->input->post('type_of_module');
    $company_id               = $this->input->post('company_id');

    $drawing_no_btr           = $this->input->post('drawing_no_btr');
    $uniq_id_btr              = $this->input->post('uniq_id_btr');

    if(!$drawing_no) {
      $this->session->set_flashdata('error','No Data to Submit');
      return redirect($_SERVER['HTTP_REFERER']);
    }

    foreach($drawing_no as $key => $value) {
      $form_data            = [
        "uniq_id" 		      => $uniq_id_btr != "" ? $uniq_id_btr : $uniq_id[$key],
				"project" 		      => $project[$key],
				"discipline" 	      => $discipline[$key],
				"module" 		        => $module[$key],
				"type_of_module"    => $type_of_module[$key],
				"company_id" 	      => $company_id[$key], 
				"drawing_no" 	      => $drawing_no_btr != "" ? $drawing_no_btr : $value, 
				"id_joint" 	  	    => $id_joint[$key], 
				"created_by" 	      => $this->user_id, 
				"created_date" 	    => $this->timestamp, 
      ];

      $where['status_inspection'] = 1;
      $where['status_deleted']    = 1;
      $where['uniq_id']           = $uniq_id_btr;
      $current_btr                = $this->btr_mod->btr_signed_list($where);
      unset($where);

      if($current_btr) {

        $form_data['submission_id']       = $current_btr[0]['submission_id'];
        $form_data['submit_to_qc_by']     = $this->user_id;
        $form_data['submit_to_qc_date']   = $this->timestamp;
        $form_data['status_inspection']   = 1;
      
      }

      $this->btr_mod->insert_btr_signed($form_data);
      unset($form_data);
    }

    $this->session->set_flashdata('success','Success Insert Data');
    redirect('btr/import_joint');

  }

  public function btr_approval($status = null)
  {
    $status                   = decrypt($status);

    if($status == "") {
      $status                 = 0;
    }

    $data['status']             = $status;

    if($status == "summary_rfi") {
      $where['status_inspection >= 5'] = null;
    } elseif($status == "ready_transmit") {
      $where["status_inspection IN (3,9,11)"] = null;
    } else {
      $where['status_inspection'] = $status;
    }

    $where['status_deleted']    = 1;

    $get_data                   = $this->input->get();

    if(@$get_data['project_id'] != "") {
      $where["project"]         = $get_data['project_id'];
    } else {
      if(!$this->is_admin) {
       $where[implode_where("project", $this->project_alt)] = null;
      }
    }

    if(@$get_data['discipline'] != "") {
      $where["discipline"]         = $get_data['discipline'];
    }

    if(@$get_data['module'] != "") {
      $where["module"]         = $get_data['module'];
    }

    if(@$get_data['type_of_module'] != "") {
      $where["type_of_module"]         = $get_data['type_of_module'];
    }

    if(@$get_data['drawing_no'] != "") {
      $where["drawing_no"]         = $get_data['drawing_no'];
    }

    $order_by                   = "submission_id DESC";
    $data['list']               = $this->btr_mod->btr_approval_list($where, $order_by);
    unset($where);

    

    if($data['list']) {
      foreach($data['list'] as $value) {
        $id_joint_list[]        = intval($value['id_joint']);
      }

      $where[implode_where("id", $id_joint_list)] = null;
      $joint_list               = $this->engineering_mod->joint_list($where);
      unset($where);

      foreach($joint_list as $value) {
        $data['joint'][$value['id']]  = $value;
      }

    }

    $where                    = null;
    if(!$this->is_admin) {
      $where[implode_where("id", $this->project_alt)] = null;
		}
		$project_list             = $this->general_mod->project($where);
    	unset($where);

    foreach($project_list as $value) {
      $data['project'][$value['id']]  = $value;
    }

    $discipline_list          = $this->general_mod->discipline();
    foreach($discipline_list as $value) {
      $data['discipline'][$value['id']] = $value;
    }

    $module_list              = $this->general_mod->module();
    foreach($module_list as $value) {
      $data['module'][$value['mod_id']] = $value;
    }

    $type_of_module_list      = $this->general_mod->type_of_module();
    foreach($type_of_module_list as $value) {
      $data['type_of_module'][$value['id']] = $value;
    }

    $data['serverside']       = "btr/serverside_btr_list";
    $data['meta_title']       = 'BTR Approval';
    $data['subview']          = "btr/btr_approval";
    $data['user_permission']  = $this->permission_cookie;
    $data['sidebar']          = $this->sidebar;
    $data['user_cookie']      = $this->user_cookie;

    $this->load->view('index', $data);
  }

  public function detail_btr_signed($uniq_id) {
    $uniq_id                  = decrypt($uniq_id);
    if(!$uniq_id) {
      redirect('btr');
    }

    $where['uniq_id']         = $uniq_id;
    $where['status_deleted']  = 1;
    $data['joint_list']       = $this->btr_mod->btr_signed_join($where);
    $data['signed_list']      = $this->btr_mod->btr_signed_list($where);

    unset($where);

    if($data['joint_list']) {

      $where['uniq_id']         = $uniq_id;
      $data['attachment_list']  = $this->btr_mod->attachment_history_list($where);
      unset($where);

      foreach ($data['joint_list'] as $value) {
        $list_id_joint[]        = $value['id'];
        $list_part_id[]         = $value['pos_1'];
        $list_part_id[]         = $value['pos_2'];
        $list_drawing_no[]      = $value['drawing_no'];
        $list_user_id[]         = intval($value['smoe_approval_by']);
        $list_user_id[]         = intval($value['client_approval_by']);
      }
  
      $where[implode_where("document_no", $list_drawing_no)]  = null;
      $where['status_delete']   = 1;
      $drawing_list             = $this->wtr_mod->data_drawing_list($where);
      unset($where);
  
      foreach($drawing_list as $value) {
        $data['drawing'][$value['document_no']] = $value;
      }
  
      $where[implode_where("part_id", $list_part_id)] = NULL;
      $piecemark_list       = $this->engineering_mod->piecemark_list($where);
      unset($where);
      foreach ($piecemark_list as $value) {
        $data['piecemark'][$value['part_id']] = $value;
      }
  
      $where[implode_where("id_joint", $list_id_joint)] = NULL;
      $where['status_delete']   = 1;
      $baa_list                 = $this->bondstrand_mod->bondstrand_list($where);
      unset($where);
  
      foreach ($baa_list as $value) {
        $data['baa'][$value['id_joint']]  = $value;
      }
  
      // CHECK IRN
  
      // $where[implode_where("id_joint", $list_id_joint)] = null;
      // $irn_list                 = $this->irn_mod->irn_list($where);
      // unset($where);
  
      // $data['irn_list']         = $irn_list;
  
      // if($irn_list) {
      //   foreach($irn_list as $value) {
      //     $list_user_id[]         = intval($value['smoe_approval_by']);
      //     $list_user_id[]         = intval($value['client_approval_by']);
      //   }
  
        
      // }

      if($list_user_id) {
        $where[implode_where('id_user', $list_user_id)] = null;
        $select                 = "id_user, full_name, sign_approval";
        $user_list              = $this->general_mod->portal_user_db_list($where, null, $select);
        unset($where);

        if($user_list) {
          foreach($user_list as $value) {
            $data['user'][$value['id_user']]  = $value;
          }
        }
      }

  
      $project_list             = $this->general_mod->project();
      foreach ($project_list as $value) {
        $data['project'][$value['id']]  = $value;
      }
  
      $discipline_list          = $this->general_mod->discipline();
      foreach ($discipline_list as $value) {
        $data['discipline'][$value['id']] = $value;
      }
  
      $module_list              = $this->general_mod->module();
      foreach ($module_list as $value) {
        $data['module'][$value['mod_id']] = $value;
      }
  
      $type_of_module_list      = $this->general_mod->type_of_module();
      foreach ($type_of_module_list as $value) {
        $data['type_of_module'][$value['id']] = $value;
      }
  
      $company_list             = $this->general_mod->company();
      foreach ($company_list as $value) {
        $data['company'][$value['id_company']]  = $value;
      }
  
      $area_list                = $this->general_mod->area_v2();
      foreach ($area_list as $value) {
        $data['area'][$value['id']] = $value;
      }
  
      $location_list            = $this->general_mod->location_v2();
      foreach ($location_list as $value) {
        $data['location'][$value['id']] = $value;
      }
  
      $bonder_list              = $this->bondstrand_mod->bonder_list();
      foreach ($bonder_list as $value) {
        $data['bonder'][$value['id']] = $value;
      }
  
    }

    $data['from_signed']        = 1;
    $data['meta_title']         = "Detail BTR";
    $this->load->view('btr/detail_btr', $data);
  
  }

  public function submit_data_btr_signed() {
    $checked_uniq               = $this->input->post('checked_uniq');
    if(!$checked_uniq) {
      $this->session->set_flashdata('error','No Data to Proceed');
      return redirect($_SERVER['HTTP_REFERER']);
    }

    $where["category IN ('btr_rfi','btr_rfi_scm')"] = null;
    $master_report              = $this->general_mod->master_report_number($where);
    unset($where);

    foreach($master_report as $value) {
      $report_format[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']][$value['category']] = $value['report_no'];
    }

    foreach($checked_uniq as $value) {
      $where['uniq_id']             = $value;
      $where['status_deleted']      = 1;
      $where['status_inspection']   = 0;
      $data_list                    = $this->btr_mod->btr_signed_list($where);
      unset($where);

      if($data_list) {
        $data_list                  = $data_list[0];

        $where['project']           = $data_list['project'];
        $where['discipline']        = $data_list['discipline'];
        $where['module']            = $data_list['module'];
        $where['type_of_module']    = $data_list['type_of_module'];
        $where['company_id']        = $data_list['company_id'];

        $where['submission_id IS NOT NULL'] = null;
        $order_by                   = "submission_id DESC";
        $datadb                     = $this->btr_mod->btr_signed_list($where, $order_by);

        // check missing submission
        $order_by                   = "submission_id ASC";
        $datadb2                    = $this->btr_mod->btr_signed_list($where, $order_by);
        $datadb2                    = array_column($datadb2, 'submission_id', 'submission_id');
        unset($where);

        $missing_submission         = "";

        $category_rep               = "btr_rfi";
        if($data_list['company_id'] == 13) {
          $category_rep             = "btr_rfi_scm";
        }


        if($datadb2) {
          foreach($datadb2 as $v) {
            $sub                    = explode("-", $v);
            $sub                    = intval(end($sub));
            $list_all_sub[]         = $sub;
          }


          foreach($this->missing_number($list_all_sub) as $v) {
            $missing_submission     = str_pad($v, 6, '0', STR_PAD_LEFT);
            $missing_submission     = $report_format[$data_list['project']][$data_list['discipline']][$data_list['module']][$data_list['type_of_module']][$category_rep].$missing_submission;
            break;
          }
          
        }



        $submission_id              = "000001";
        if($datadb) {
          $running_no               = explode("-", $datadb[0]['submission_id']);
          $running_no               = end($running_no);
          $submission_id            = str_pad($running_no  + 1, 6, '0', STR_PAD_LEFT);
        }

        $submission_id              = $report_format[$data_list['project']][$data_list['discipline']][$data_list['module']][$data_list['type_of_module']][$category_rep].$submission_id;

        if($missing_submission != "") {
          $submission_id              = $missing_submission;
        }


        $where['uniq_id']             = $value;
        $where['status_deleted']      = 1;
        $where['status_inspection']   = 0;
        
        $form_data                    = [
          'submission_id'             => $submission_id,
          'submit_to_qc_by'           => $this->user_id,
          'submit_to_qc_date'         => $this->timestamp,
          'status_inspection'         => 1
        ];


        $this->btr_mod->update_btr_signed($form_data, $where);
        unset($form_data, $where);
      }

    }

    $this->session->set_flashdata('success','Success Submit Data');
    redirect($_SERVER['HTTP_REFERER']);

  }

  public function approval_btr_signed() {
    $status                 = $this->input->post('status');
    $uniq_id                = $this->input->post('uniq_id');

    $where['uniq_id']           = $uniq_id;
    $where['status_deleted']    = 1;
    $where['status_inspection'] = 1;

    $form_data              = [
      'status_inspection'   => $status,
      'smoe_approval_by'    => $this->user_id,
      'smoe_approval_date'  => $this->timestamp,
      'status_inspection'   => $status
    ];

    $this->btr_mod->update_btr_signed($form_data, $where);
    unset($form_data, $where);

     echo json_encode([
      'success'     => true
     ]);
  }

  public function transmit_data_btr_signed() {

    $checked_uniq           = $this->input->post('checked_uniq');
    if(!$checked_uniq) {
      $this->session->set_flashdata('error','No Data to Proceed');
      return redirect($_SERVER['HTTP_REFERER']);
    }

    $where['uniq_id']         = $checked_uniq[0];
    $where['status_deleted']  = 1;

    $data_list                = $this->btr_mod->btr_signed_list($where);

    $form_data              = [
      "status_inspection"   => 5, 
			"transmit_by"         => $this->user_cookie[0],
			"transmit_date"       => date("Y-m-d H:i:s"), 
    ];

    if(in_array($data_list[0]['status_inspection'], [9,11])) {
      $form_data['postpone_reoffer_no']  = intval($data_list[0]['postpone_reoffer_no']) + 1;
    }



    $this->btr_mod->update_btr_signed($form_data, $where);
    unset($where, $form_data);

    $this->session->set_flashdata('success','Success Transmit Data');
    redirect($_SERVER['HTTP_REFERER']);

  }

  public function approval_btr_signed_client() {
    $uniq_id                = $this->input->post('uniq_id');
    $status                 = $this->input->post('status');
    $remarks_client         = $this->input->post('remarks_client');

    $where['uniq_id']           = $uniq_id;
    $where['status_deleted']    = 1;

    $form_data                = [
      'status_inspection'     => $status,
      'client_approval_by'    => $this->user_id,
      'client_approval_date'  => $this->timestamp,
      'status_inspection'     => $status,
      'client_remarks'        => $remarks_client
    ];

    $this->btr_mod->update_btr_signed($form_data, $where);
    unset($form_data, $where);

     echo json_encode([
      'success'     => true
     ]);

  }

  public function upload_attachment() {
    $uniq_id                  =  $this->input->post('uniq_id');
    require_once(APPPATH.'third_party/Net/SFTP.php');
    $sftp                       = new Net_SFTP(getenv('FTP_SINOLOGI_HOST'));

    if (!$sftp->login(getenv('FTP_SINOLOGI_USER'), getenv('FTP_SINOLOGI_PASS'))) {
      $this->session->set_flashdata('error','FTP Server Not Working');
      redirect($_SERVER['HTTP_REFERER']);
    }

    if($_FILES['attachment']['name'] != "") {
      $file_name                = uniqid().'_'.$_FILES['attachment']['name'];
      $filepath                 = 'upload/';
      move_uploaded_file($_FILES['attachment']['tmp_name'], $filepath.$file_name);
      $source                   = $filepath.$file_name;
      $destination              = "/PCMS/pcms_v2/mwtr/".$file_name;
      $sftp->put($destination , $source, NET_SFTP_LOCAL_FILE);
      //unlink($source);

      $form_data                = [
        'process'               => 4,
        'uniq_id'               => $uniq_id,
        'filename'              => $file_name,
        'created_by'            => $this->user_id,
        'created_date'          => $this->timestamp
      ];

      $this->btr_mod->insert_attachment_history($form_data);
      unset($form_data);
    }

    redirect($_SERVER['HTTP_REFERER']);
  }

  public function delete_att() {
    $id_enc               = $this->input->post('id_enc');
    $id                   = decrypt($id_enc);

    $where['id']          = $id;
    $this->btr_mod->delete_attachment_history($where);
    unset($where);

    echo json_encode([
      'success'     => true
    ]);


  }

  protected function missing_number($array_num) {
    $new_arr = range($array_num[0],max($array_num));                                                    
    return array_diff($new_arr, $array_num);
  }

  public function return_to_draft() {
    $enc_submission_id      = $this->input->post('enc_submission_id');
    $submission_id          = decrypt($enc_submission_id);

    $output                 = [];
    if(!$submission_id) {
      $output               = [
        'success'           => false,
        'msg'               =>'something went wrong!'
      ];

    } else {
      $where['submission_id']     = $submission_id;
      $where['status_deleted']    = 1;
  
      $form_data['status_inspection'] = 0;
      $form_data['submission_id']     = null;
      $this->btr_mod->update_btr_signed($form_data, $where);
      unset($where, $form_data);
      $output                   = [
        'success'               => true
      ];
    }

    echo json_encode($output);
    
  }

  public function delete_joint_btr() {
    $id_enc                     = $this->input->post('id_enc');
    $id                         = decrypt($id_enc);

    $output                 = [];
    if(!$id) {
      $output               = [
        'success'           => false,
        'msg'               =>'something went wrong!'
      ];

    } else {

      $where['id_btr']          = $id;

      $form_data                = [
        'status_deleted'        => 0,
        'deleted_by'            => $this->user_cookie[0],
        'deleted_date'          => date('Y-m-d H:i:s')
      ];

      $this->btr_mod->update_btr_signed($form_data, $where);
      unset($where, $form_data);

      $output                   = [
        'success'               => true
      ];
    }

    echo json_encode($output);

  }

  public function find_unused_folder()
  {
    include APPPATH . 'third_party/Net/SFTP.php';
    $sftp = new Net_SFTP(getenv('FTP_SINOLOGI_HOST'));
    $sftp->login(getenv('FTP_SINOLOGI_USER'), getenv('FTP_SINOLOGI_PASS'));

    $suspicious = [];
    $broken = [];
    $directory = '/PCMS/referal_welder/file'; // DIUBAH SESUAI DIRECTORY YG DIGUNAKAN

    $arr_dir  = $sftp->rawlist($directory);
    // test_var($arr_dir);
    foreach ($arr_dir as $key => $value) {
      if (!in_array($key, ['.', '..'])) {
        $ext = explode(".", $key)[1];
        test_var($ext);
        if (!in_array($ext, [
          '.', '..',
          'pdf', 'img', 'png', 'jpg', 'jpeg', 'xlsx',
          'PDF', 'IMG', 'PNG', 'JPG', 'JPEG', 'XLSX',
          // LIST EXTENSION YG BOLEH ADA DISERVER, DITAMBAHKAN BILA KURANG
        ])) {
          $suspicious[] = $directory . "/" . $key;
        }
        if ($value["size"] == 0) {
          $broken[] = $directory . "/" . $key;
        }
      }
    }
  }

}

