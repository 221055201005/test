<?php 

  class Mts extends CI_Controller {

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
      $this->load->model('wtr_mod');
      $this->load->model('irn_mod');
      $this->load->model('mts_mod');
      $this->load->model('material_verification_mod');
      $this->load->model('master/welder_mod', 'm_welder_mod');


      $this->user_cookie          = $data_cookies['data_user'];
      $this->permission_cookie    = $data_cookies['data_permission'];
      $this->sidebar              = "mts/sidebar";
      $this->is_admin             = $this->permission_cookie[0];
      $this->smtp                 = smtp_config();

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

      $where["category ILIKE '%mv%'"] = null;
      $master_report              = $this->general_mod->master_report_number($where);
      unset($where);

      foreach($master_report as $value) {
        if(in_array($value['project'], project_by_deck())) {
          $this->format_report[$value['project']][$value['company_id']][$value['discipline']][$value['module']][$value['type_of_module']][$value['deck_elevation']][$value['category']] = $value['report_no'];

        } else {
          $this->format_report[$value['project']][$value['company_id']][$value['discipline']][$value['module']][$value['type_of_module']][$value['category']] = $value['report_no'];
        }
      }

      $this->project_alt        = $this->user_cookie[13];
      $this->company_alt        = $this->user_cookie[14];

      $this->allowed_user         = [1, 1000297, 1000226, 1000487];
    }

    public function index(){
      redirect('mts/mts_list');
    }

    public function mts_list(){ 
      $where                    = null;
      if(!$this->is_admin) {
        $where[implode_where("id", $this->project_alt)] = null;
      }
      $data['project_list']     = $this->general_mod->project($where);
      unset($where);

      $data['discipline_list']          = $this->general_mod->discipline();

      $where['status_delete']           = 1;
      $module_list                      = $this->general_mod->module();
      unset($where);
      foreach($module_list as $value) {
        $data['module_list'][$value['project_id']][]  = $value;
      }

      $data['deck_list']                    = $this->general_mod->deck_elevation();

      $data['type_of_module_list']      = $this->general_mod->type_of_module();

      $data['serverside']       = "mts/serverside_drawing_list";
      $data['meta_title']       = 'Material Traceability Summary';
      $data['subview']          = "mts/mts_list";
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
    $deck_elevation_filter    = $this->input->post('deck_elevation');

    $where_mts                = null;

    if($project_id != "") {
      $where_mts["project"]     = $project_id;
    } else {
      if(!$this->is_admin) {
        $where_mts[implode_where("project", $this->project_alt)]  = null;
      }
    }

    if(!$this->is_admin) {
      $where_mts[implode_where("company_id", $this->company_alt)]  = null;
    }

    if($discipline_filter != "") {
      $where_mts["discipline"]      = $discipline_filter;
    }

    if($module_filter != "") {
      $where_mts["module"]          = $module_filter;
    }

    if($type_of_module_filter != "") {
      $where_mts["type_of_module"]      = $type_of_module_filter;
    }

    if(trim($drawing_no) != "") {
      $where_mts["drawing_ga ILIKE '%$drawing_no%'"]      = null;
    }

    if($deck_elevation_filter != "") {
      $where_mts["deck_elevation"]      = $deck_elevation_filter;
    }

    $list                       = $this->mts_mod->serverside_drawing_list($where_mts);

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
      $deck_list             = $this->general_mod->deck_elevation();
      foreach ($deck_list as $value) {
        $deck[$value['id']]  = $value;
      }
    }

    foreach ($list as $value) {
      $encrypt_drawing_no     = encrypt($value['drawing_ga']);
      $encrypt_deck_elevation = encrypt($value['deck_elevation']);

      $button_list            = '<div class="btn-group">';
      $button_list            .= '<a href="' . site_url('mts/detail_mts/' . $encrypt_drawing_no . '/' . $encrypt_deck_elevation) . '"  class="btn btn-primary"><i class="fas fa-list"></i> Detail</a>';
      $button_list            .= '</div>';

      $row                    = [];
      $row[]                  = $project[$value['project']]['project_name'];
      $row[]                  = $value['drawing_ga'];
      $row[]                  = $discipline[$value['discipline']]['discipline_name'];
      $row[]                  = $module[$value['module']]['mod_desc'];
      $row[]                  = $type_of_module[$value['type_of_module']]['name'];
      $row[]                  = $deck[$value['deck_elevation']]['name'];
      $row[]                  = $button_list;

      $data[]                 = $row;
    }

    $result                   = [
      "draw"                  => $_POST['draw'],
      "recordsTotal"          => $this->mts_mod->count_serverside_drawing_list_all($where_mts),
      "recordsFiltered"       => $this->mts_mod->count_serverside_drawing_list_filtered($where_mts),
      "data"                  => $data
    ];

    unset($where_mts);
    echo json_encode($result);
  }

  public function detail_mts($drawing_no_enc = null, $deck_elevation_enc = null)
  {
    $drawing_no               = decrypt($drawing_no_enc);
    $deck_elevation           = decrypt($deck_elevation_enc);
    if (!$drawing_no) {
      redirect('mts/mts_list');
    }

    $where['deck_elevation']  = $deck_elevation;
    $where['drawing_ga']      = $drawing_no;
    $where['status_delete']   = 1;

    $order_by                 = ["id" => "asc"];
    $pc_list                  = $this->engineering_mod->piecemark_list($where, null, $order_by);
    unset($where);


    if ($pc_list) {

      foreach ($pc_list as $key => $value) {
        $list_id_piecemark[]    = $value['id'];
        $list_part_id[]         = $value['part_id'];
        $value['id_piecemark']  = $value['id'];
        $value['drawing_no']    = $value['drawing_ga'];
        $data['pc_list'][$key]  = $value;
        $list_drawing_no[]      = $value['drawing_ga'];
        $list_drawing_no[]      = $value['drawing_as'];
        $list_drawing_no[]      = $value['drawing_sp'];
        $list_drawing_no[]      = $value['drawing_cp'];
      }

      $where[implode_where("document_no", $list_drawing_no)]  = null;
      $data_drawing           = $this->wtr_mod->data_drawing_list_mysql($where);
      unset($where);

      if ($data_drawing) {
        foreach ($data_drawing as $value) {
          $data['data_drawing'][$value['document_no']] = $value;
        }
      }

      $where[implode_where("pcms_material.id_piecemark", $list_id_piecemark)]  = null;
      $where["pcms_material.status_delete"]   = 0;
      $where["status_inspection <> 12"] 	    = null;   
      $where["report_resubmit_status = 0"]    = null;
      $mv_list                                = $this->material_verification_mod->find_material_verification_data($where);
      unset($where);

      $list_id_mis   = [];

      foreach($mv_list as $value) {
        $data['mv'][$value['id_piecemark']] = $value;
        $list_id_mis[]                      = $value['id_mis'];
      }

      if($list_id_mis) {
        $mis_list                           = $this->material_verification_mod->detail_mis($list_id_mis);

        
        foreach($mis_list as $value) {
          $data['mis'][$value['id_mis_det']]  = $value;
          $list_mrir_id[]                   = $value['mrir_id'];
        }

        if(@$list_mrir_id) {
          $where[implode_where("mrir_id", $list_mrir_id)] = null;
          $mrir_list                          = $this->material_verification_mod->data_mrir_material($where);
          unset($where);
          foreach($mrir_list as $value) {
            $data['unique_detail'][$value['unique_ident_no']] = $value;
            $list_rec_det_id[]        = $value['receiving_detail_id'];
          }

          $where[implode_where("id", $list_rec_det_id)]  = null;
          $rec_list = $this->irn_mod->receiving_cs_detail($where);
          unset($where);

          if($rec_list) {
            foreach($rec_list as $value) {
              $list_rec_id[]        = $value['receiving_id'];
              $data['rec_det'][$value['id']]  = $value;
            }

            $where[implode_where("receiving_id", $list_rec_id)]  = null;
            $att_list = $this->irn_mod->receiving_attachment_list_document($where);
            unset($where);
            foreach($att_list as $value) {
              $data['att_rec'][$value['receiving_id']][$value['certificate_number']]  = $value['attachment_name'];
            }

          }
        }

        $datadb                   = $this->material_verification_mod->steel_category_list();
        foreach($datadb as $value) {
          $data['steel_category'][$value['id']] = $value['steel_category'];
        }
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


      $where[implode_where("pos_1", $list_part_id).' OR '.implode_where("pos_2", $list_part_id)]  = null;
      $joint_list               = $this->engineering_mod->joint_list($where);
      unset($where);

      if($joint_list) {
        foreach($joint_list as $value) {
          $list_id_joint[]              = $value['id'];
          $data['joint'][$value['id']]  = $value;
          $data['list_part_joint'][$value['pos_1']][] = $value;
          $data['list_part_joint'][$value['pos_2']][] = $value;
        }
        // CHECK IRN FABRICATION
        $where[implode_where("id_joint", $list_id_joint)]  = null;
        $irn_list                 = $this->irn_mod->irn_list($where);
        unset($where);
        foreach($irn_list as $value) {
          $data['irn_list_joint'][$value['id_joint']]  = $value;
        }
      }


      // CHECK IRN

      $where[implode_where("id_piecemark", $list_id_piecemark)]  = null;
      $irn_list                 = $this->irn_mod->irn_list($where);
      $data['irn']              = $irn_list;
      unset($where);
      foreach($irn_list as $value) {
        $data['irn_list'][$value['id_piecemark']]  = $value;
      }

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

      $grade_list                 = $this->general_mod->material_grade();
      foreach($grade_list as $value) {
        $data['grade'][$value['id']]  = $value;
      }

      $datadb = $this->general_mod->master_report_number(["category ILIKE '%irn_report%'" => NULL]);

      foreach ($datadb as $key => $value) {
        $data["master_report_number"][$value['project']][$value['discipline']][$value['type_of_module']][$value['category']] = $value['report_no'];
      } 


    }
    $data['from_signed']        = 0;
    $data['meta_title']         = "Detail MTS";
    $this->load->view('mts/detail_mts', $data);
  }



    public function import_piecemark($drawing_no = null, $uniq_id = null) {
      $data['drawing_no_mts']   = decrypt($drawing_no);
      $data['uniq_id_mts']      = decrypt($uniq_id);

      $data['meta_title']       = "MTS - Import Piecemark";
      $data['subview']          = "mts/import_piecemark";
      $data['user_permission']  = $this->permission_cookie;
      $data['sidebar']          = $this->sidebar;
      $data['user_cookie']      = $this->user_cookie;
  
      $this->load->view('index', $data);
    }


    public function template_import_mts() {
      include APPPATH.'third_party/PHPExcel/PHPExcel.php';
      $excel = new PHPExcel();
      $excel->setActiveSheetIndex(0);
      $sheet = $excel->getActiveSheet()->setTitle('data');

      $styleArray = array(
        'borders' => array(
          'allborders' 	=> array(
            'style' 		=> PHPExcel_Style_Border::BORDER_THIN
          )
        ),
        'alignment' => array(
            'horizontal' 	=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' 		=> PHPExcel_Style_Alignment::VERTICAL_CENTER
        ),
 
        'font'  => array(
          'bold'  => true,
          'color' => array('rgb' => 'FFFFFF'),
        ),
        'fill' => array(
          'type' => PHPExcel_Style_Fill::FILL_SOLID,
          'color' => array('rgb' => '28A745')
        )
      );


      $sheet->setCellValue('A1', 'DRAWING GA');
      $sheet->setCellValue('B1', 'PIECEMARK NO (CASE SENSITIVE)');
      
      $excel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($styleArray);
      unset($styleArray);

      foreach(range('A','B') as $value) {
        $excel->getActiveSheet()->getColumnDimension($value)->setAutoSize(true);
      }

      $firstRowHeight = 30;
      $excel->getActiveSheet()->getRowDimension(1)->setRowHeight($firstRowHeight);


      $start  = 2;
      foreach(range(1, 5) as $value) {

        $styleArray = array(
        'borders' => array(
          'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
          )
          ),
          'alignment' => array(
            'horizontal' 	=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' 		=> PHPExcel_Style_Alignment::VERTICAL_CENTER
          ),
       
        );

        $sheet->setCellValue('A'.$start, '');
        $sheet->setCellValue('B'.$start, '');

        $excel->getActiveSheet()->getStyle('A'.$start.':B'.$start)->applyFromArray($styleArray);
        unset($styleArray);
        $start++;
      }

      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="Template Import MTS.xlsx"');
      $data = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
      $data->save('php://output');
      exit;
    }

    public function preview_import_mts() {

      $id_user                  = $this->user_cookie;
      $config['upload_path']    = 'upload/';
      $config['file_name']      = 'excel_ntr_'.$id_user[0];
      $config['allowed_types']  = 'xlsx';
      $config['overwrite'] 			= TRUE;

      $data['drawing_no_mts']   = $this->input->post('drawing_no_mts');
      $data['uniq_id_mts']      = $this->input->post('uniq_id_mts');
  
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
  
      if ( ! $this->upload->do_upload('file')){
        $this->session->set_flashdata('error', $this->upload->display_errors());
        redirect("mts/import_piecemark");
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
  
      $where[implode_where("drawing_ga", $list_drawing_no)] = null;
      $where['status_delete']   = 1;
      $datadb                   = $this->engineering_mod->piecemark_list($where);
      unset($where);
  
      foreach($datadb as $value) {
        $data['pc'][$value['drawing_ga']][$value['part_id']]  = $value;
      }

      $where[implode_where("a.drawing_ga", $list_drawing_no)] = null;
      $where['a.status_delete'] = 1;
      $datadb                   = $this->wtr_mod->show_pcms_piecemark_wp($where);
      unset($where);
  
      foreach ($datadb as $key => $value) {
        $data['wp'][$value['drawing_ga']][$value['part_id']] = $value;
      }
      

      $where[implode_where("a.drawing_no", $list_drawing_no)] = null;
      $where['a.status_deleted']  = 1;
      $datadb                     = $this->mts_mod->mts_signed_join($where);
      unset($where);
  
      foreach ($datadb as $key => $value) {
        $data['mts'][$value['drawing_no']][$value['part_id']] = $value;
      }

      $datadb                   = $this->general_mod->deck_elevation();
      foreach($datadb as $value) {
        $data['deck'][$value['id']] = $value;
      }
  
      $data['sheet']            = $sheet;
  
      $data['meta_title']       = "MTS - Preview Import Piecemark";
      $data['subview']          = "mts/preview_import_mts";
      $data['user_permission']  = $this->permission_cookie;
      $data['sidebar']          = $this->sidebar;
      $data['user_cookie']      = $this->user_cookie;
  
      $this->load->view('index', $data);
    }
  
    public function proceed_import_mts() {
      $drawing_no               = $this->input->post('drawing_no');
      $uniq_id                  = $this->input->post('uniq_id');
      $id_piecemark             = $this->input->post('id_piecemark');
      $project                  = $this->input->post('project');
      $discipline               = $this->input->post('discipline');
      $module                   = $this->input->post('module');
      $type_of_module           = $this->input->post('type_of_module');
      $company_id               = $this->input->post('company_id');

      $drawing_no_mts           = $this->input->post('drawing_no_mts');
      $uniq_id_mts              = $this->input->post('uniq_id_mts');
      $deck_elevation           = $this->input->post('deck_elevation');

      if(!$drawing_no) {
        $this->session->set_flashdata('error','No Data to Submit');
        return redirect($_SERVER['HTTP_REFERER']);
      }

      foreach($drawing_no as $key => $value) {
        if(in_array($project[$key], project_by_deck())) {
          $uniq_id[$key]        = $uniq_id[$key].'_'.$deck_elevation[$key];
        }
        $form_data            = [
          "uniq_id" 		      => $uniq_id_mts != "" ? $uniq_id_mts : $uniq_id[$key],
          "project" 		      => $project[$key],
          "discipline" 	      => $discipline[$key],
          "module" 		        => $module[$key],
          "type_of_module"    => $type_of_module[$key],
          "company_id" 	      => $company_id[$key], 
          "drawing_no" 	      => $drawing_no_mts != "" ? $drawing_no_mts : $value, 
          "id_piecemark" 	  	=> $id_piecemark[$key], 
          "created_by" 	      => $this->user_id, 
          "created_date" 	    => $this->timestamp, 
        ];

        $where['status_inspection'] = 1;
        $where['status_deleted']    = 1;
        $where['uniq_id']           = $uniq_id_mts;
        $current_mts                = $this->mts_mod->mts_signed_list($where);
        unset($where);

        if($current_mts) {
          $form_data['submission_id']       = $current_mts[0]['submission_id'];
          $form_data['submit_to_qc_by']     = $this->user_id;
          $form_data['submit_to_qc_date']   = $this->timestamp;
          $form_data['status_inspection']   = 1;
        }

        $this->mts_mod->insert_mts_signed($form_data);
        unset($form_data);
      }

      $this->session->set_flashdata('success','Success Insert Data');
      redirect('mts/import_piecemark');
    }

    public function mts_approval($status = null){
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
      if(@$get_data['deck_elevation'] != "") {
        $where["deck_elevation"]         = $get_data['deck_elevation'];
      }


      $order_by                   = "submission_id DESC";
      $data['list']               = $this->mts_mod->mts_approval_list($where, $order_by);
      unset($where);

      if($data['list']) {
        foreach($data['list'] as $value) {
          $id_piecemark_list[]        = intval($value['id_piecemark']);
        }

        $where[implode_where("id", $id_piecemark_list)] = null;
        $piecemark_list               = $this->engineering_mod->piecemark_list($where);
        unset($where);

        foreach($piecemark_list as $value) {
          $data['pc'][$value['id']]  = $value;
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

      $where['status_delete']   = 1;
      $module_list              = $this->general_mod->module($where);
      unset($where);
      foreach($module_list as $value) {
        $data['module_list'][$value['project_id']][] = $value;
        $data['module'][$value['mod_id']]  = $value;
      }

      $type_of_module_list      = $this->general_mod->type_of_module();
      foreach($type_of_module_list as $value) {
        $data['type_of_module'][$value['id']] = $value;
      }

      $datadb                   = $this->general_mod->deck_elevation();
      foreach($datadb as $value) {
        $data['deck'][$value['id']] = $value;
      } 

      $data['meta_title']       = 'MTS Approval';
      $data['subview']          = "mts/mts_approval";
      $data['user_permission']  = $this->permission_cookie;
      $data['sidebar']          = $this->sidebar;
      $data['user_cookie']      = $this->user_cookie;

      $this->load->view('index', $data);
    }

    public function detail_mts_signed($uniq_id) {
      $uniq_id                  = decrypt($uniq_id);
      if(!$uniq_id) {
        redirect('mts');
      }
      $where['uniq_id']         = $uniq_id;
      $where['status_deleted']  = 1;

      $order_by                 = "id_mts ASC";
      $data['pc_list']          = $this->mts_mod->mts_signed_join($where, $order_by);
      $data['signed_list']      = $this->mts_mod->mts_signed_list($where);

      unset($where);
  
      if($data['pc_list']) {
  
        $where['uniq_id']         = $uniq_id;
        $data['attachment_list']  = $this->mts_mod->attachment_history_list($where);
        unset($where);

        foreach ($data['pc_list'] as $value) {
          $list_id_piecemark[]    = $value['id_piecemark'];
          $list_part_id[]         = $value['part_id'];
          $list_drawing_no[]      = $value['drawing_ga'];
          $list_drawing_no[]      = $value['drawing_as'];
          $list_drawing_no[]      = $value['drawing_sp'];
          $list_drawing_no[]      = $value['drawing_cp'];
          $list_drawing_no[]      = $value['drawing_cl'];
          $list_user_id[]         = intval($value['smoe_approval_by']);
          $list_user_id[]         = intval($value['client_approval_by']);
        }

        $where[implode_where("document_no", $list_drawing_no)]  = null;
        $data_drawing           = $this->wtr_mod->data_drawing_list_mysql($where);
        unset($where);

        if ($data_drawing) {
          foreach ($data_drawing as $value) {
            $data['data_drawing'][$value['document_no']] = $value;
          }
        }


        $where[implode_where("pos_1", $list_part_id).' OR '.implode_where("pos_2", $list_part_id)]  = null;
        $joint_list               = $this->engineering_mod->joint_list($where);
        unset($where);

        if($joint_list) {
          foreach($joint_list as $value) {
            $list_id_joint[]              = $value['id'];
            $data['joint'][$value['id']]  = $value;
            $data['list_part_joint'][$value['pos_1']][] = $value;
            $data['list_part_joint'][$value['pos_2']][] = $value;
          }
          // CHECK IRN FABRICATION
          $where[implode_where("id_joint", $list_id_joint)]  = null;
          $irn_list                 = $this->irn_mod->irn_list($where);
          unset($where);
          foreach($irn_list as $value) {
            $data['irn_list_joint'][$value['id_joint']]  = $value;
          }
        }

        // CHECK IRN MATERIAL
        $where[implode_where("id_piecemark", $list_id_piecemark)]  = null;
        $irn_list                 = $this->irn_mod->irn_list($where);
        unset($where);
        foreach($irn_list as $value) {
          $data['irn_list'][$value['id_piecemark']]  = $value;
        }


        $where[implode_where("pcms_material.id_piecemark", $list_id_piecemark)]  = null;
        $where["pcms_material.status_delete"]   = 0;
        $where["status_inspection <> 12"] 	    = null;   
        $where["report_resubmit_status = 0"]    = null;
        $mv_list                                = $this->material_verification_mod->find_material_verification_data($where);
        unset($where);

        foreach($mv_list as $value) {
          $data['mv'][$value['id_piecemark']] = $value;
          $list_id_mis[]                      = $value['id_mis'];
        }

        if($list_id_mis) {
          $mis_list                           = $this->material_verification_mod->detail_mis($list_id_mis);
          foreach($mis_list as $value) {
            $data['mis'][$value['id_mis_det']]  = $value;
            $list_mrir_id[]                   = $value['mrir_id'];
          }
  
          $where[implode_where("mrir_id", $list_mrir_id)] = null;
          $mrir_list                          = $this->material_verification_mod->data_mrir_material($where);
          unset($where);
          foreach($mrir_list as $value) {
            $data['unique_detail'][$value['unique_ident_no']] = $value;
            $list_rec_det_id[]        = $value['receiving_detail_id'];
          }
  
          $where[implode_where("id", $list_rec_det_id)]  = null;
          $rec_list = $this->irn_mod->receiving_cs_detail($where);
          unset($where);
  
          if($rec_list) {
            foreach($rec_list as $value) {
              $list_rec_id[]        = $value['receiving_id'];
              $data['rec_det'][$value['id']]  = $value;
            }
  
            $where[implode_where("receiving_id", $list_rec_id)]  = null;
            $att_list = $this->irn_mod->receiving_attachment_list_document($where);
            unset($where);
            foreach($att_list as $value) {
              $data['att_rec'][$value['receiving_id']][$value['certificate_number']]  = $value['attachment_name'];
            }
  
          }
        }
    
        $where[implode_where("document_no", $list_drawing_no)]  = null;
        $where['status_delete']   = 1;
        $drawing_list             = $this->wtr_mod->data_drawing_list($where);
        unset($where);
    
        foreach($drawing_list as $value) {
          $data['drawing'][$value['document_no']] = $value;
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

        $grade_list                 = $this->general_mod->material_grade();
        foreach($grade_list as $value) {
          $data['grade'][$value['id']]  = $value;
        }

        $datadb = $this->general_mod->master_report_number(["category ILIKE '%irn_report%'" => NULL]);
        foreach ($datadb as $key => $value) {
          $data["master_report_number"][$value['project']][$value['discipline']][$value['type_of_module']][$value['category']] = $value['report_no'];
        } 

      }
      $data['from_signed']        = 1;
      $data['meta_title']         = "Detail MTS";
      $this->load->view('mts/detail_mts', $data);
    
    }
  
    public function submit_data_mts_signed() {
      $checked_uniq               = $this->input->post('checked_uniq');
      $deck_elevation             = $this->input->post('deck_elevation');
      if(!$checked_uniq) {
        $this->session->set_flashdata('error','No Data to Proceed');
        return redirect($_SERVER['HTTP_REFERER']);
      }

  
      $where["category IN ('mts_rfi','mts_rfi_scm')"] = null;
      $master_report              = $this->general_mod->master_report_number($where);
      unset($where);
  
      foreach($master_report as $value) {
        if(in_array($value['project'], project_by_deck())) {
          $report_format[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']][$value['company_id']][$value['deck_elevation']][$value['category']] = $value['report_no'];
        } else {
          $report_format[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']][$value['company_id']][$value['category']] = $value['report_no'];
        }
      }

      foreach($checked_uniq as $value) {
        $where['uniq_id']             = $value;
        $where['status_deleted']      = 1;
        $where['status_inspection']   = 0;
        $data_list                    = $this->mts_mod->mts_signed_list($where);
        unset($where);
  
        if($data_list) {
          $data_list                  = $data_list[0];
  
          $where['a.project']           = $data_list['project'];
          $where['a.discipline']        = $data_list['discipline'];
          $where['a.module']            = $data_list['module'];
          $where['a.type_of_module']    = $data_list['type_of_module'];
          $where['a.company_id']        = $data_list['company_id'];

          if(in_array($data_list['project'], project_by_deck())) {
            $where['deck_elevation']    = $deck_elevation;
          }

          $where['submission_id IS NOT NULL'] = null;
          $order_by                   = "submission_id DESC";
          $datadb                     = $this->mts_mod->mts_signed_join($where, $order_by);
  
          // check missing submission
          $order_by                   = "submission_id ASC";
          $datadb2                    = $this->mts_mod->mts_signed_join($where, $order_by);
          $datadb2                    = array_column($datadb2, 'submission_id', 'submission_id');
          unset($where);
  
          $missing_submission         = "";
  
          $category_rep               = "mts_rfi";
          if($data_list['company_id'] == 13) {
            $category_rep             = "mts_rfi_scm";
          }
  
  
          if($datadb2) {
            foreach($datadb2 as $v) {
              $sub                    = explode("-", $v);
              $sub                    = intval(end($sub));
              $list_all_sub[]         = $sub;
            }
  
            foreach($this->missing_number($list_all_sub) as $v) {
              $missing_submission     = str_pad($v, 6, '0', STR_PAD_LEFT);
              if(in_array($data_list['project'], project_by_deck())) {
                $missing_submission     = $report_format[$data_list['project']][$data_list['discipline']][$data_list['module']][$data_list['type_of_module']][$data_list['company_id']][$deck_elevation][$category_rep].$missing_submission;
              } else {
                $missing_submission     = $report_format[$data_list['project']][$data_list['discipline']][$data_list['module']][$data_list['type_of_module']][$data_list['company_id']][$category_rep].$missing_submission;

              }
              break;
            }
            
          }
  
          $submission_id              = "000001";
          if($datadb) {
            $running_no               = explode("-", $datadb[0]['submission_id']);
            $running_no               = end($running_no);
            $submission_id            = str_pad($running_no  + 1, 6, '0', STR_PAD_LEFT);
          }

          if(in_array($data_list['project'], project_by_deck())) {
            $submission_id     = $report_format[$data_list['project']][$data_list['discipline']][$data_list['module']][$data_list['type_of_module']][$data_list['company_id']][$deck_elevation][$category_rep].$submission_id;
          } else {
            $submission_id     = $report_format[$data_list['project']][$data_list['discipline']][$data_list['module']][$data_list['type_of_module']][$data_list['company_id']][$category_rep].$submission_id;

          }
 
  
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
  
          $this->mts_mod->update_mts_signed($form_data, $where);
          unset($form_data, $where);
        }
  
      }
  
      $this->session->set_flashdata('success','Success Submit Data');
      redirect($_SERVER['HTTP_REFERER']);
  
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
        $this->mts_mod->update_mts_signed($form_data, $where);
        unset($where, $form_data);
        $output                   = [
          'success'               => true
        ];
      }
  
      echo json_encode($output);
      
    }

    public function delete_joint_mts() {
      $id_enc                     = $this->input->post('id_enc');
      $id                         = decrypt($id_enc);
  
      $output                 = [];
      if(!$id) {
        $output               = [
          'success'           => false,
          'msg'               =>'something went wrong!'
        ];
  
      } else {
  
        $where['id_mts']          = $id;
  
        $form_data                = [
          'status_deleted'        => 0,
          'deleted_by'            => $this->user_cookie[0],
          'deleted_date'          => date('Y-m-d H:i:s')
        ];
  
        $this->mts_mod->update_mts_signed($form_data, $where);
        unset($where, $form_data);
  
        $output                   = [
          'success'               => true
        ];
      }
  
      echo json_encode($output);
  
    }

    public function approval_mts_signed() {
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
  
      $this->mts_mod->update_mts_signed($form_data, $where);
      unset($form_data, $where);
  
       echo json_encode([
        'success'     => true
       ]);
    }

    public function transmit_data_mts_signed() {

      $checked_uniq           = $this->input->post('checked_uniq');
      if(!$checked_uniq) {
        $this->session->set_flashdata('error','No Data to Proceed');
        return redirect($_SERVER['HTTP_REFERER']);
      }
  
      $where['uniq_id']         = $checked_uniq[0];
      $where['status_deleted']  = 1;
  
      $data_list                = $this->mts_mod->mts_signed_list($where);
  
      $form_data              = [
        "status_inspection"   => 5, 
        "transmit_by"         => $this->user_cookie[0],
        "transmit_date"       => date("Y-m-d H:i:s"), 
      ];
  
      if(in_array($data_list[0]['status_inspection'], [9,11])) {
        $form_data['postpone_reoffer_no']  = intval($data_list[0]['postpone_reoffer_no']) + 1;
      }
  
  
  
      $this->mts_mod->update_mts_signed($form_data, $where);
      unset($where, $form_data);
  
      $this->session->set_flashdata('success','Success Transmit Data');
      redirect($_SERVER['HTTP_REFERER']);
  
    }
  
    public function approval_mts_signed_client() {
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
  
      $this->mts_mod->update_mts_signed($form_data, $where);
      unset($form_data, $where);
  
       echo json_encode([
        'success'     => true
       ]);
  
    }

    public function update_notes() {
      $uniq_id             = $this->input->post('uniq_id');
      $notes               = $this->input->post('notes');

      $where['uniq_id']           = $uniq_id;
      $where['status_deleted']    = 1;
  
      $form_data                = [
        'notes_updated_by'      => $this->user_id,
        'notes_updated_date'    => $this->timestamp,
        'notes'                 => $notes
      ];
  
      $this->mts_mod->update_mts_signed($form_data, $where);
      unset($form_data, $where);

      echo json_encode([
        'success'     => true
       ]);
       

    }

    public function mts_export() {
      $where                    = null;
      if(!$this->is_admin) {
        $where[implode_where("id", $this->project_alt)] = null;
      }
      $data['project_list']     = $this->general_mod->project($where);
      unset($where);

      $data['discipline_list']          = $this->general_mod->discipline();

      $where['status_delete']           = 1;
      $module_list                      = $this->general_mod->module();
      unset($where);
      foreach($module_list as $value) {
        $data['module_list'][$value['project_id']][]  = $value;
      }

      $data['type_of_module_list']      = $this->general_mod->type_of_module();

      $data['deck_list']                    = $this->general_mod->deck_elevation();

      $data['meta_title']       = 'Export - Material Traceability Summary';
      $data['subview']          = "mts/mts_export";
      $data['user_permission']  = $this->permission_cookie;
      $data['sidebar']          = $this->sidebar;
      $data['user_cookie']      = $this->user_cookie;
      $this->load->view('index', $data);
    }

    public function proceed_export_mts() {
      error_reporting(0);
      $project_id_filter        = $this->input->post('project_id');
      $drawing_no_filter        = $this->input->post('drawing_no');
      $discipline_filter        = $this->input->post('discipline');
      $module_filter            = $this->input->post('module');
      $type_of_module_filter    = $this->input->post('type_of_module');
      $deck_elevation_filter    = $this->input->post('deck_elevation');

      $where['status_delete']  = 1;

      if($project_id_filter) {
        $where['project']       = $project_id_filter;
      }

      
      if($discipline_filter) {
        $where['discipline']       = $discipline_filter;
      }

      if($drawing_no_filter) {
        $where['drawing_ga']       = $drawing_no_filter;
      }

      if($module_filter) {
        $where['module']       = $module_filter;
      }

      if($deck_elevation_filter) {
        $where['deck_elevation']     = $deck_elevation_filter;
      }

      if($type_of_module_filter) {
        $where['type_of_module']       = $type_of_module_filter;
      }
      if(!$this->is_admin) {
        $where[implode_where("company_id", $this->company_alt)]  = null;
      }

      $order_by                 = "drawing_ga, drawing_as, drawing_sp, drawing_cp, deck_elevation";
      $mts_list                 = $this->mts_mod->piecemark_list($where, $order_by);
      unset($where);

      if($mts_list) {
        foreach ($mts_list as $value) {
          $list_id_piecemark[]    = $value['id'];
          $list_part_id[]         = $value['part_id'];
          $list_drawing_no[]      = $value['drawing_ga'];
          $list_drawing_no[]      = $value['drawing_as'];
          $list_drawing_no[]      = $value['drawing_sp'];
        }

        $where[implode_where("pcms_material.id_piecemark", $list_id_piecemark)]  = null;
        $where["pcms_material.status_delete"]   = 0;
        $where["status_inspection <> 12"] 	    = null;   
        $where["report_resubmit_status = 0"]    = null;
        $mv_list                                = $this->material_verification_mod->find_material_verification_data($where);
        unset($where);

        foreach($mv_list as $value) {
          $mv[$value['id_piecemark']] = $value;
          $list_id_mis[]                      = $value['id_mis'];
        }

        if($list_id_mis) {
          $mis_list                           = $this->material_verification_mod->detail_mis($list_id_mis);
          foreach($mis_list as $value) {
            $mis[$value['id_mis_det']]  = $value;
            $list_mrir_id[]                   = $value['mrir_id'];
          }
  
          $where[implode_where("mrir_id", $list_mrir_id)] = null;
          $mrir_list                          = $this->material_verification_mod->data_mrir_material($where);
          unset($where);
          foreach($mrir_list as $value) {
            $unique_detail[$value['unique_ident_no']] = $value;
          }

          $datadb                   = $this->material_verification_mod->steel_category_list();
          foreach($datadb as $value) {
            $steel_category[$value['id']] = $value['steel_category'];
          }


        }

        $project_list             = $this->general_mod->project();
        foreach ($project_list as $value) {
          $project[$value['id']]  = $value;
        }
    
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
    
        $company_list             = $this->general_mod->company();
        foreach ($company_list as $value) {
          $company[$value['id_company']]  = $value;
        }
    
        $area_list                = $this->general_mod->area_v2();
        foreach ($area_list as $value) {
          $area[$value['id']] = $value;
        }
    
        $location_list            = $this->general_mod->location_v2();
        foreach ($location_list as $value) {
          $location[$value['id']] = $value;
        }

        $grade_list                 = $this->general_mod->material_grade();
        foreach($grade_list as $value) {
          $grade[$value['id']]  = $value;
        }

        $datadb = $this->general_mod->master_report_number(["category ILIKE '%irn_report%'" => NULL]);
        foreach ($datadb as $key => $value) {
          $master_report_number[$value['project']][$value['discipline']][$value['type_of_module']][$value['category']] = $value['report_no'];
        }

        $deck_list                = $this->general_mod->deck_elevation();
        foreach ($deck_list as $value) {
          $deck[$value['id']] = $value;
        }

      }

      include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        $excel = new PHPExcel();
        $excel->setActiveSheetIndex(0);
        $sheet = $excel->getActiveSheet()->setTitle('data');
    
        $styleArray = array(
          'borders' => array(
            'allborders' 	=> array(
              'style' 		=> PHPExcel_Style_Border::BORDER_THIN
            )
          ),
          'alignment' => array(
              'horizontal' 	=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
              'vertical' 		=> PHPExcel_Style_Alignment::VERTICAL_CENTER
          ),
          'font'  => array(
            'bold'  => true,
            'color' => array('rgb' => 'FFFFFF'),
          ),
          'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '28A745')
          )
        );

        $column_name = "SINGLE PART";

        if($project_id_filter == 21) {
          $column_name = "CUTTING PLAN";
        }

        // set title kolom
        $sheet->setCellValue('A1', 'S/N');
        $sheet->setCellValue('B1', 'DRAWING NUMBER (GA)');
        $sheet->setCellValue('C1', 'DRAWING NUMBER (GA) REV');
        $sheet->setCellValue('D1', 'DRAWING NUMBER (ASSEMBLY)');
        $sheet->setCellValue('E1', 'DRAWING NUMBER (ASSEMBLY) REV.');
        $sheet->setCellValue('F1', 'DRAWING NUMBER ('.$column_name.')');
        $sheet->setCellValue('G1', 'DRAWING NUMBER ('.$column_name.') REV.');
        $sheet->setCellValue('H1', 'MATERIAL DESCRIPTION');
        $sheet->setCellValue('I1', 'PROFILE');
        $sheet->setCellValue('J1', 'PIECE MARK NUMBER');
        $sheet->setCellValue('K1', 'QTY');
        $sheet->setCellValue('L1', 'UNIQUE NUMBER');
        $sheet->setCellValue('M1', 'MILL CERT. NO');
        $sheet->setCellValue('N1', 'HEAT NUMBER');
        $sheet->setCellValue('O1', 'PRODUCT TEST NO.');
        $sheet->setCellValue('P1', 'MATERIAL GRADE');
        $sheet->setCellValue('Q1', 'MATERIAL CLASS');
        $sheet->setCellValue('R1', 'DELIVERY CONDITION');
        $sheet->setCellValue('S1', 'SIZE (Inch)');
        $sheet->setCellValue('T1', 'DIAMETER (mm)');
        $sheet->setCellValue('U1', 'THK (mm)');
        $sheet->setCellValue('V1', 'WIDTH (mm)');
        $sheet->setCellValue('W1', 'LENGTH (mm)');
        $sheet->setCellValue('X1', 'MRIR REPORT NUMBER');
        $sheet->setCellValue('Y1', 'MV REPORT NUMBER');
        $sheet->setCellValue('Z1', 'MV APPROVED DATE');
        $sheet->setCellValue('AA1', 'MV INSPECTION STATUS');
        $sheet->setCellValue('AB1', 'REMARKS');
        $sheet->setCellValue('AC1', 'DECK ELEVATION');
    
        $excel->getActiveSheet()->getStyle('A1:AC1')->applyFromArray($styleArray);
        unset($styleArray);

        for ($i='A'; $i !== 'ZZ' ; $i++) { 
          $excel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
        }
        
        $start  = 2;
        $row_no = 1;

        foreach($mts_list as $value) {
          $styleArray = array(
          'borders' => array(
            'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN
            )
            ),
            'alignment' => array(
              'horizontal' 	=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
              'vertical' 		=> PHPExcel_Style_Alignment::VERTICAL_CENTER
            )
          );

          $data_mv        = $mv[$value['id']];
          $data_mis       = $mis[$data_mv['id_mis']];
          $mrir_report    = explode("/", $data_mis['report_no'])[1];

          if ($data_mis['partial_report_no'] > 0) {
            $mrir_report  .= '-' . $data_mis['partial_report_no'];
          }



          if ($data_mv) {

            if(in_array($data_mv['project_code'], project_by_deck())) {
              $running_report = $this->format_report[$data_mv['project_code']][$data_mv['company_id']][$data_mv['discipline']][$data_mv['module']][$data_mv['type_of_module']][$data_mv['deck_elevation']]['mv_no'];

            } else {
              $running_report = $this->format_report[$data_mv['project_code']][$data_mv['company_id']][$data_mv['discipline']][$data_mv['module']][$data_mv['type_of_module']]['mv_no'];

            }


            if ($data_mv['company_id'] == 13) {
              $running_report = $this->format_report[$data_mv['project_code']][$data_mv['company_id']][$data_mv['discipline']][$data_mv['module']][$data_mv['type_of_module']]['mv_no_smop'];
            }

            $running_report         = $running_report . '-' . $data_mv['report_number'];

            if ($data_mv['report_no_rev'] > 0) {
              $running_report       .= ' Rev. ' . $data_mv['report_no_rev'];
            }
          }


          $mv_status = "";
          if ($data_mv['status_inspection'] == 1) {
            $mv_status = "OS";
          } elseif($data_mv['status_inspection'] == 2) {
            $mv_status = "REJ";
          } elseif($data_mv['status_inspection'] >= 3) {
            $mv_status = "ACC";
          }

          $drawing_second       = $value['drawing_sp'];
          $drawing_second_rev   = $value['rev_sp'];

          if($project_id_filter == 21) {
            $drawing_second       = $value['drawing_cp'];
            $drawing_second_rev   = $value['rev_cp'];
          }

          $sheet->setCellValue('A'.$start, $row_no);
          $sheet->setCellValue('B'.$start, $value['drawing_ga']);
          $sheet->setCellValue('C'.$start, $value['rev_ga']);
          $sheet->setCellValue('D'.$start, $value['drawing_as']);
          $sheet->setCellValue('E'.$start, $value['rev_as']);

          $sheet->setCellValue('F'.$start, $drawing_second);
          $sheet->setCellValue('G'.$start, $drawing_second_rev);

          $sheet->setCellValue('H'.$start, $value['material']);
          $sheet->setCellValue('I'.$start, $value['profile']);
          $sheet->setCellValue('J'.$start, $value['part_id']);
          $sheet->setCellValue('K'.$start, 1);
          $sheet->setCellValue('L'.$start, $data_mis['unique_no']);
          $sheet->setCellValue('M'.$start, $data_mis['mill_cert_no']);
          $sheet->setCellValue('N'.$start, $data_mis['heat_or_series_no']);
          $sheet->setCellValue('O'.$start, $data_mis['plate_or_tag_no']);
          $sheet->setCellValue('P'.$start, $grade[$value['grade']]['material_grade']);
          $sheet->setCellValue('Q'.$start, $steel_category[$data_mis['steel_category']]);
          $sheet->setCellValue('R'.$start, $data_mis['delivery_condition']);
          $sheet->setCellValue('S'.$start, $value['size']);
          $sheet->setCellValue('T'.$start, $value['diameter']);
          $sheet->setCellValue('U'.$start, $value['thickness']);
          $sheet->setCellValue('V'.$start, $value['width']);
          $sheet->setCellValue('W'.$start, $value['length']);
          $sheet->setCellValue('X'.$start, $mrir_report);
          $sheet->setCellValue('Y'.$start, $data_mv['report_number'] ? $running_report : null);
          $sheet->setCellValue('Z'.$start, $data_mv['inspection_datetime'] ? date('Y-m-d', strtotime($data_mv['inspection_datetime'])) : null);
          $sheet->setCellValue('AA'.$start, $mv_status);
          $sheet->setCellValue('AB'.$start, '');
          $sheet->setCellValue('AC'.$start, $deck[$value['deck_elevation']]['name']);


          $excel->getActiveSheet()->getStyle('A'.$start.':AC'.$start)->applyFromArray($styleArray);
          unset($styleArray);
          $start++;
          $row_no++;
        }
    
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Export Material Traceability Summary List.xlsx"');
        $data = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $data->save('php://output');
        exit;


    }

    protected function missing_number($array_num) {
      $new_arr = range($array_num[0],max($array_num));                                                    
      return array_diff($new_arr, $array_num);
    }



  }

?>