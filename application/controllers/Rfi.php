<?php 

class Rfi extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->helper('browser');
    $this->load->helper('cookies');
    $data_cookies = helper_cookies(@$this->input->get('user'));

    $this->load->model('home_mod');
    $this->load->model('general_mod');
    $this->load->model('engineering_mod');
    $this->load->model('planning_mod');
    $this->load->model('material_verification_mod');
    $this->load->model('fitup_mod');
    $this->load->model('visual_mod');
    $this->load->model('wtr_mod');
    $this->load->model('rfi_mod');

    $this->user_cookie 		  	= $data_cookies['data_user'];
    $this->permission_cookie  = $data_cookies['data_permission'];
    $this->sidebar 	          = "rfi/sidebar";
  }

  public function index() {
    redirect('rfi/rfi_client_pending_list');
  }

  public function export_rfi() {
    $data['user_permission']  = $this->permission_cookie;
    $data['meta_title']       = 'Export Rfi';
    $data['subview']          = 'rfi/export_rfi';
    $data['sidebar']          = $this->sidebar;
    $this->load->view('index', $data);
  }

  public function export_data_rfi() {
    error_reporting(0);
    $inspector_id_list                  = [];
    $process                            = $this->input->post('process');
    $history_included                   = $this->input->post('history_included');
    $history_included                   = intval($history_included);

    if($process == '' || $process == "mv") {
      $where['report_number IS NOT NULL'] = null;

      if($history_included != 1) {
        $where['status_delete']           = 0;
        $where['report_resubmit_status']  = 0;
        
      }

      if($this->user_cookie[7] == 8) {
        if($this->user_cookie[11] == 13) {
          $where['wp.company_id'] = 13;
        } else {
          $where['wp.company_id != 13'] = null;
        }
      }

      $summary_mv_list           = $this->material_verification_mod->summary_rfi($where);
      unset($where);

      if($summary_mv_list) {
        $list_report_number     = array_column($summary_mv_list, 'report_number');
        $where['status_inspection >= 5'] = null;
        $where["report_number IN ('".implode("', '", $list_report_number)."')"] = NULL;
        $data_mv                = $this->material_verification_mod->get_material($where);
        unset($where);
        if($data_mv) {

          $list_id_process      = array_column($data_mv, 'id_material');
          $where["id_process IN ('".implode("', '", $list_id_process)."')"] = NULL;
          $where['process']     = 1;
          $data_comment         = $this->material_verification_mod->attachment_history_list_join($where);
          unset($where);

          if($data_comment) {
            $list_piecemark_id  = array_column($data_comment, 'id_piecemark');
              $where["id IN ('".implode("', '", $list_piecemark_id)."')"] = NULL;
              $data_piecemark     = $this->engineering_mod->piecemark_list($where);
              unset($where);

              if($data_piecemark) {
                foreach($data_piecemark as $value) {
                  $piecemark_item[$value['id']] = $value;
                }
              }
            foreach($data_comment as $value) {

              $comment_mv[$value['report_number']][$value['report_no_rev']][] = $value;
              $inspector_id_list[]  = $value['created_by'];
            }
          }

          foreach($data_mv as $value) {
            $total_detail_mv[$value['report_number']][] = $value['id_material'];
            $inspector_id_list[]  = $value['inspector_id'];
          }

          foreach($summary_mv_list as $value) {
            $inspector_id_list[]  = $value['inspection_client_by'] ? $value['inspection_client_by'] : 0;
          }

        }

        $list_workpack_id       = array_column($summary_mv_list, 'id_workpack');
        $where["id IN ('".implode("', '", $list_workpack_id)."')"] = NULL;
        $workpack_list          = $this->planning_mod->workpack_list($where);
        unset($where);

        if($workpack_list) {
          foreach($workpack_list as $v) {
            $wp_mv[$v['id']]  = $v;
          }
        }

      }
    }

    if($process == '' || $process == "ft") {

      $where['report_number IS NOT NULL'] = null;

      if($history_included != 1) {
        $where['status_resubmit != 1']    = null;
        $where['status_retransmitted']    = 0;

      }

      if($this->user_cookie[7] == 8) {
        if($this->user_cookie[11] == 13) {
          $where['wp.company_id'] = 13;
        } else {
          $where['wp.company_id != 13'] = null;
        }
      }

      $summary_ft_list           = $this->fitup_mod->summary_rfi($where);
      unset($where);

      if($summary_ft_list) {
        $list_report_number     = array_column($summary_ft_list, 'report_number');
        $where['status_inspection >= 5'] = null;
        $where["report_number IN ('".implode("', '", $list_report_number)."')"] = NULL;
        $data_ft                = $this->fitup_mod->fitup_list($where);
        unset($where);

        if($data_ft) {

          $list_id_process      = array_column($data_ft, 'id_fitup');
          $where["id_process IN ('".implode("', '", $list_id_process)."')"] = NULL;
          $where['process']     = 2;
          $data_comment         = $this->fitup_mod->attachment_history_list_join($where);
          unset($where);

          if($data_comment) {
              $list_id_joint  = array_column($data_comment, 'id_joint');
              $where["id IN ('".implode("', '", $list_id_joint)."')"] = NULL;
              $data_joint     = $this->engineering_mod->joint_list($where);
              unset($where);

              if($data_joint) {
                foreach($data_joint as $value) {
                  $joint_item[$value['id']] = $value;
                }
              }

            foreach($data_comment as $value) {
              $comment_fitup[$value['report_number']][] = $value;
              $inspector_id_list[]  = $value['created_by'];
            }
          }

          foreach($data_ft as $value) {
            $total_detail_ft[$value['report_number']][] = $value['id_fitup'];
            $inspector_id_list[]  = intval($value['inspector_id']);

          }

          foreach($summary_ft_list as $value) {
            $inspector_id_list[]  = intval($value['inspection_client_by']);
          }

        }

        $list_workpack_id       = array_column($summary_ft_list, 'id_workpack');
        $where["id IN ('".implode("', '", $list_workpack_id)."')"] = NULL;
        $workpack_list          = $this->planning_mod->workpack_list($where);
        unset($where);

        if($workpack_list) {
          foreach($workpack_list as $v) {
            $wp_ft[$v['id']]  = $v;
          }
        }

      }

    }

    if($process == '' || $process == "vs") {

      $where['report_number IS NOT NULL'] = null;

      if($history_included != 1) {
        // $where['status_delete is null']    = null;
        $where['retransmitt_status != 1']    = null;
      }

      if($this->user_cookie[7] == 8) {
        if($this->user_cookie[11] == 13) {
          $where['wp.company_id'] = 13;
        } else {
          $where['wp.company_id != 13'] = null;
        }
      }


      $summary_vs_list           = $this->visual_mod->summary_rfi($where);
      unset($where);
      if($summary_vs_list) {
        $list_report_number     = array_column($summary_vs_list, 'report_number');
        $where['status_inspection >= 5'] = null;
        $where["report_number IN ('".implode("', '", $list_report_number)."')"] = NULL;
        $data_vs                = $this->visual_mod->visual_list($where);
        unset($where);
        
        if($data_vs) {

          $list_id_process      = array_column($data_vs, 'id_visual');
          $where["id_process IN ('".implode("', '", $list_id_process)."')"] = NULL;
          $where['process']     = 3;
          $data_comment         = $this->visual_mod->attachment_history_list_join($where);
          unset($where);
          if($data_comment) {

              $list_id_joint  = array_column($data_comment, 'id_joint');
              $where["id IN ('".implode("', '", $list_id_joint)."')"] = NULL;
              $data_joint     = $this->engineering_mod->joint_list($where);
              unset($where);

              if($data_joint) {
                foreach($data_joint as $value) {
                  $joint_item[$value['id']] = $value;
                }
              }
            foreach($data_comment as $value) {
              $comment_visual[$value['report_number']][$value['postpone_reoffer_no']][] = $value;
              $inspector_id_list[]  = $value['created_by'];
            }
          }

          foreach($data_vs as $value) {
            $total_detail_vs[$value['report_number']][] = $value['id_visual'];
            $inspector_id_list[]  = $value['inspector_id'];
          }

          foreach($summary_vs_list as $value) {
            $inspector_id_list[]  = $value['inspection_client_by'] ? $value['inspection_client_by'] : 0;
          }
        }

        $list_workpack_id       = array_column($summary_vs_list, 'id_workpack');
        $where["id IN ('".implode("', '", $list_workpack_id)."')"] = NULL;
        $workpack_list          = $this->planning_mod->workpack_list($where);
        unset($where);

        if($workpack_list) {
          foreach($workpack_list as $v) {
            $wp_vs[$v['id']]  = $v;
          }
        }

      }
    }

    if(count($inspector_id_list) > 0) {
      $where["id_user IN ('".implode("', '", array_unique($inspector_id_list))."')"] = NULL;
      $data_user                = $this->general_mod->portal_user_db_list($where);
      unset($where);
      foreach($data_user as $value) {
        $user[$value['id_user']]  = $value;
      }
    }

    $project_list             = $this->general_mod->project();
    foreach($project_list as $value) {
      $project[$value['id']]  = $value;
    }

    $area_list                = $this->general_mod->area();
    foreach($area_list as $value) {
      $area[$value['id']]     = $value;
    }

    $datadb = $this->general_mod->report_no();
    $report_no_list = [];
    foreach($datadb as $value) {
      $report_no_list[$value['category']][$value['project']][$value['discipline']][$value['module']][$value['type_of_module']] = $value['report_no'];
    }
    // $data['report_no_list']  = $report_no_list;

    // $data['summary_mv_list']  = $summary_mv_list;
    // $data['summary_ft_list']  = $summary_ft_list;
    // $data['summary_vs_list']  = $summary_vs_list;

    $deck_elevation_list      = $this->general_mod->deck_elevation();
    foreach($deck_elevation_list as $value) {
      $deck[$value['id']] = $value;
    }

    $area_v2_list                  = $this->general_mod->area_v2();
    foreach($area_v2_list as $value) {
      $area_v2[$value['id']]  = $value;
    }

    $location_v2_list               = $this->general_mod->location_v2();
    foreach($location_v2_list as $value) {
      $location_v2[$value['id']]  = $value;
    }

    $point_v2_list                  = $this->general_mod->point();
    foreach($point_v2_list as $value) {
      $point_v2[$value['id']]  = $value;
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

    $sheet->setCellValue('A1', 'PROJECT');
		$sheet->setCellValue('B1', 'RFI NO');
		$sheet->setCellValue('C1', 'REPORT REVISION NO');
		$sheet->setCellValue('D1', 'Deck Elevation / Service Line'); 
		$sheet->setCellValue('E1', 'PROCESS'); 
		$sheet->setCellValue('F1', 'DRAWING NO'); 
		$sheet->setCellValue('G1', 'INSPECTOR NAME'); 
		$sheet->setCellValue('H1', 'INSPECTION LOCATION'); 
		$sheet->setCellValue('I1', 'INSPECTION DATE TIME'); 
		$sheet->setCellValue('J1', 'TOTAL ITEM'); 
		$sheet->setCellValue('K1', 'STATUS'); 
		$sheet->setCellValue('L1', 'REJECT HISTORY'); 
		$sheet->setCellValue('M1', 'INSPECTION AUTHORITY'); 
		$sheet->setCellValue('N1', 'REVIEWED / APPROVAL CLIENT BY'); 

		$excel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($styleArray);
		unset($styleArray);

		foreach(range('A','N') as $value) {
        $excel->getActiveSheet()->getColumnDimension($value)->setAutoSize(true);
		}


		$start  = 2;

		foreach($summary_mv_list as $value) {
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

        $area_mv = '';

        if($value['area_v2']) {
          $area_mv .= $area_v2[$value['area_v2']]['name'];

          if($value['location_v2']) {
            $area_mv .= ', '.$location_v2[$value['location_v2']]['name'];

            if($value['point_v2']) {
              $area_mv .= ', '.$point_v2[$value['point_v2']]['name'];
            }

          }

        } else {
          $area_mv = $area[$value['area']]['area_name'];
        }

        $total_item_mv  = $value['total_item'];
        $status_rfi_mv  = '';

        if($value['total_pending_smoe'] > 0) {
          $status_rfi_mv = 'Pending Approval QC SMOE';
        } elseif($value['total_pending_smoe'] == 0) {

          if($value['total_rejected_smoe'] > 0) {
            $status_rfi_mv = 'Rejected By QC SMOE';
          } elseif($total_item_mv == $value['total_approved_smoe']) {
            $status_rfi_mv  = "Approved By QC SMOE";
          } elseif($value['total_hold_smoe'] > 0) {
            $status_rfi_mv  = "Hold By QC SMOE";
          } elseif($value['total_pending_client'] > 0) {
            $status_rfi_mv  = "Pending Approval Client";
          } elseif($value['total_pending_client'] == 0) {


            if($value['total_rejected_client'] > 0) {
              $status_rfi_mv  = "Rejected By Client";
            } elseif($total_item_mv == $value['total_approved_client']) {
              $status_rfi_mv   = "Accepted By Client";

              if($value['status_invitation'] == 1) {
                $status_rfi_mv   = "Reviewed By Client";
              }
            } elseif($value['total_approve_comment'] > 0) {
              $status_rfi_mv = "Accepted And Released With Comments";
            } elseif($value['total_postponed'] > 0) {
              $status_rfi_mv = "Postponed By Client";
            } elseif($value['total_reoffer'] > 0) {
              $status_rfi_mv = "Re-Offer By Client";
            } elseif($value['total_void'] == $total_item_mv) {
              $status_rfi_mv = "Void";
            }

          }

        }

        $reject_mv_list = [];
        
        if(isset($comment_mv[$value['report_number']][$value['report_no_rev']])) {
          foreach($comment_mv[$value['report_number']][$value['report_no_rev']] as $v) {
            $rejected_by = $user[$v['created_by']]['full_name'];
            $reject_mv_list[] = "Rejected By : $rejected_by \n Comments : ".$v['reject_remarks']." \n Rejected Date ".$v['created_date']." \n Rejected Item ".$piecemark_item[$v['id_piecemark']]['part_id']." ";
          }
        }

        $legend_ins  = explode(";", $value['legend_inspection_auth']);

        $legend_text = '';
        $legend_text .= $legend_ins[0] == 1 ? 'Hold Point /' : '';
        $legend_text .= $legend_ins[1] == 1 ? 'Witness /' : '';
        $legend_text .= $legend_ins[2] == 1 ? 'Monitoring /' : '';
        $legend_text .= $legend_ins[3] == 1 ? 'Review' : '';

        

        $report_no_format             = $report_no_list['mv_no_rfi'][$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']]."-".$value['report_number'];

        if($value['company_id'] ==13) {
          $report_no_format             = $report_no_list['mv_no_rfi_smop'][$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']]."-".$value['report_number'];
        }

				$sheet->setCellValue('A'.$start, $project[$value['project_code']]['project_name']);
				$sheet->setCellValue('B'.$start, $report_no_format);
				$sheet->setCellValue('C'.$start, $value['report_no_rev']);
				$sheet->setCellValue('D'.$start, $deck[$wp_mv[$value['id_workpack']]['deck_elevation']]['name']);
				$sheet->setCellValue('E'.$start, "Material Verification");
				$sheet->setCellValue('F'.$start, $value['drawing_no']);
				$sheet->setCellValue('G'.$start, isset($user[$value['inspector_id']]['full_name']) ? $user[$value['inspector_id']]['full_name'] : '-');
				$sheet->setCellValue('H'.$start, $area_mv);
				$sheet->setCellValue('I'.$start, $value['time_inspect']);
				$sheet->setCellValue('J'.$start, $value['total_item']);
				$sheet->setCellValue('K'.$start, $status_rfi_mv);
				$sheet->setCellValue('L'.$start, implode("\n", $reject_mv_list));
				$sheet->setCellValue('M'.$start, $legend_text);
				$sheet->setCellValue('N'.$start, isset($user[$value['inspection_client_by']]) ? $user[$value['inspection_client_by']]['full_name'] : '-');
        
				$excel->getActiveSheet()->getStyle('A'.$start.':N'.$start)->applyFromArray($styleArray);
				unset($styleArray);
				$start++;
			}

      $start_ft = $start;

      foreach($summary_ft_list as $value) {
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

        $area_ft = '';

        if($value['area_v2']) {
          $area_ft .= $area_v2[$value['area_v2']]['name'];

          if($value['location_v2']) {
            $area_ft .= ', '.$location_v2[$value['location_v2']]['name'];

            if($value['point_v2']) {
              $area_ft .= ', '.$point_v2[$value['point_v2']]['name'];
            }

          }

        } else {
          $area_ft = $area[$value['area']]['area_name'];
        }

        $total_item_ft  = $value['total_item'];
        $status_rfi_ft  = '';

        if($value['total_pending_smoe'] > 0) {
          $status_rfi_ft = 'Pending Approval QC SMOE';
        } elseif($value['total_pending_smoe'] == 0) {

          if($value['total_rejected_smoe'] > 0) {
            $status_rfi_ft = 'Rejected By QC SMOE';
          } elseif($total_item_ft == $value['total_approved_smoe']) {
            $status_rfi_ft  = "Approved By QC SMOE";
          } elseif($value['total_hold_smoe'] > 0) {
            $status_rfi_ft  = "Hold By QC SMOE";
          } elseif($value['total_pending_client'] > 0) {
            $status_rfi_ft  = "Pending Approval Client";
          } elseif($value['total_pending_client'] == 0) {


            if($value['total_rejected_client'] > 0) {
              $status_rfi_ft  = "Rejected By Client";
            } elseif($total_item_ft == $value['total_approved_client']) {
              $status_rfi_ft   = "Accepted By Client";

              if($value['status_invitation'] == 1) {
                $status_rfi_ft   = "Reviewed By Client";
              }
            } elseif($value['total_approve_comment'] > 0) {
              $status_rfi_ft = "Accepted And Released With Comments";
            } elseif($value['total_postponed'] > 0) {
              $status_rfi_ft = "Postponed By Client";
            } elseif($value['total_reoffer'] > 0) {
              $status_rfi_ft = "Re-Offer By Client";
            } elseif($value['total_void'] == $total_item_ft) {
              $status_rfi_ft = "Void";
            }

          }

        }

        $reject_ft_list = [];
        
        if(isset($comment_fitup[$value['report_number']][$value['postpone_reoffer_no']])) {
          foreach($comment_fitup[$value['report_number']][$value['postpone_reoffer_no']] as $v) {
            $rejected_by = $user[$v['created_by']]['full_name'];
            $reject_ft_list[] = "Rejected By : $rejected_by \n Comments : ".$v['reject_remarks']." \n Rejected Date ".$v['created_date']." \n Rejected Item Joint : ".$joint_item[$v['id_joint']]['joint_no']." ";
          }
        }

        $legend_ins  = explode(";", $value['legend_inspection_auth']);

        $legend_text = '';
        $legend_text .= $legend_ins[0] == 1 ? 'Hold Point /' : '';
        $legend_text .= $legend_ins[1] == 1 ? 'Witness /' : '';
        $legend_text .= $legend_ins[2] == 1 ? 'Monitoring /' : '';
        $legend_text .= $legend_ins[3] == 1 ? 'Review' : '';

        $report_no_format             = $report_no_list['fitup_rfi'][$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']].$value['report_number'];

        if($value['company_id'] ==13) {
          $report_no_format             = $report_no_list['fitup_rfi_scm'][$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']].$value['report_number'];
        }


				$sheet->setCellValue('A'.$start_ft, $project[$value['project_code']]['project_name']);
				$sheet->setCellValue('B'.$start_ft, $report_no_format);
				$sheet->setCellValue('C'.$start_ft, $value['postpone_reoffer_no']);
				$sheet->setCellValue('D'.$start_ft, $deck[$wp_ft[$value['id_workpack']]['deck_elevation']]['name']);
				$sheet->setCellValue('E'.$start_ft, "Fitup");
				$sheet->setCellValue('F'.$start_ft, $value['drawing_no']);
				$sheet->setCellValue('G'.$start_ft, isset($user[$value['inspector_id']]['full_name']) ? $user[$value['inspector_id']]['full_name'] : '-');
				$sheet->setCellValue('H'.$start_ft, $area_ft);
				$sheet->setCellValue('I'.$start_ft, $value['time_inspect']);
				$sheet->setCellValue('J'.$start_ft, $value['total_item']);
				$sheet->setCellValue('K'.$start_ft, $status_rfi_ft);
				$sheet->setCellValue('L'.$start_ft, implode("\n", $reject_ft_list));
				$sheet->setCellValue('M'.$start_ft, $legend_text);
				$sheet->setCellValue('N'.$start_ft, isset($user[$value['inspection_client_by']]) ? $user[$value['inspection_client_by']]['full_name'] : '-');

				$excel->getActiveSheet()->getStyle('A'.$start_ft.':N'.$start_ft)->applyFromArray($styleArray);
				unset($styleArray);
				$start_ft++;
			}

      $start_vs = $start_ft;

      foreach($summary_vs_list as $value) {
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

        $area_vs = '';

        if($value['area_v2']) {
          $area_vs .= $area_v2[$value['area_v2']]['name'];

          if($value['location_v2']) {
            $area_vs .= ', '.$location_v2[$value['location_v2']]['name'];

            if($value['point_v2']) {
              $area_vs .= ', '.$point_v2[$value['point_v2']]['name'];
            }

          }

        } else {
          $area_vs = $area[$value['area']]['area_name'];
        }

        $total_item_vs  = $value['total_item'];
        $status_rfi_vs  = '';

        if($value['total_pending_smoe'] > 0) {
          $status_rfi_vs = 'Pending Approval QC SMOE';
        } elseif($value['total_pending_smoe'] == 0) {

          if($value['total_rejected_smoe'] > 0) {
            $status_rfi_vs = 'Rejected By QC SMOE';
          } elseif($total_item_vs == $value['total_approved_smoe']) {
            $status_rfi_vs  = "Approved By QC SMOE";
          } elseif($value['total_hold_smoe'] > 0) {
            $status_rfi_vs  = "Hold By QC SMOE";
          } elseif($value['total_pending_client'] > 0) {
            $status_rfi_vs  = "Pending Approval Client";
          } elseif($value['total_pending_client'] == 0) {


            if($value['total_rejected_client'] > 0) {
              $status_rfi_vs  = "Rejected By Client";
            } elseif($total_item_vs == $value['total_approved_client']) {
              $status_rfi_vs   = "Accepted By Client";

              if($value['status_invitation'] == 1) {
                $status_rfi_vs   = "Reviewed By Client";
              }
            } elseif($value['total_approve_comment'] > 0) {
              $status_rfi_vs = "Accepted And Released With Comments";
            } elseif($value['total_postponed'] > 0) {
              $status_rfi_vs = "Postponed By Client";
            } elseif($value['total_reoffer'] > 0) {
              $status_rfi_vs = "Re-Offer By Client";
            } elseif($value['total_void'] == $total_item_vs) {
              $status_rfi_vs = "Void";
            }

          }

        }

        $reject_vs_list = [];
        
        if(isset($comment_visual[$value['report_number']][$value['postpone_reoffer_no']])) {
          foreach($comment_visual[$value['report_number']][$value['postpone_reoffer_no']] as $v) {
            $rejected_by = $user[$v['created_by']]['full_name'];
            $reject_vs_list[] = "Rejected By : $rejected_by \n Comments : ".$v['client_remarks']." \n Rejected Date ".$v['created_date']." \n Rejected Item Joint : ".$joint_item[$v['id_joint']]['joint_no']." ";
          }
        }
        $legend_inspection_auth = explode(';', $value['legend_inspection_auth']);
        if($post['legend_inspection_auth'] || $legend_inspection_auth) {
          $inspection_authority = [];
          if(in_array(1, $post['legend_inspection_auth']) OR in_array(1, $legend_inspection_auth)) {
            $inspection_authority[] = 'Hold Point ';
          }
      
          if(in_array(2, $post['legend_inspection_auth']) OR in_array(2, $legend_inspection_auth)) {
            $inspection_authority[] = 'Witness ';
          }
      
          if(in_array(3, $post['legend_inspection_auth']) OR in_array(3, $legend_inspection_auth)) {
            $inspection_authority[] = 'Monitoring ';
          }
      
          if(in_array(4, $post['legend_inspection_auth']) OR in_array(4, $legend_inspection_auth)) {
            $inspection_authority[] = 'Review ';
          } 
      
        } else {
          $inspection_authority = '-';
        }

        $report_no_format             = $report_no_list['visual_rfi'][$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']].$value['report_number'];

        if($value['company_id'] ==13) {
          $report_no_format             = $report_no_list['visual_rfi_13'][$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']].$value['report_number'];
        }


				$sheet->setCellValue('A'.$start_vs, $project[$value['project_code']]['project_name']);
				$sheet->setCellValue('B'.$start_vs, $report_no_format);
				$sheet->setCellValue('C'.$start_vs, $value['postpone_reoffer_no']);
				$sheet->setCellValue('D'.$start_vs, $deck[$wp_vs[$value['id_workpack']]['deck_elevation']]['name']);
				$sheet->setCellValue('E'.$start_vs, "Visual");
				$sheet->setCellValue('F'.$start_vs, $value['drawing_no']);
				$sheet->setCellValue('G'.$start_vs, isset($user[$value['inspector_id']]['full_name']) ? $user[$value['inspector_id']]['full_name'] : '-');
				$sheet->setCellValue('H'.$start_vs, $area_vs);
				$sheet->setCellValue('I'.$start_vs, $value['time_inspect']);
				$sheet->setCellValue('J'.$start_vs, $value['total_item']);
				$sheet->setCellValue('K'.$start_vs, $status_rfi_vs);
				$sheet->setCellValue('L'.$start_vs, implode("\n", $reject_vs_list));
				$sheet->setCellValue('M'.$start_vs, implode('/', $inspection_authority));
				$sheet->setCellValue('N'.$start_vs, isset($user[$value['inspection_client_by']]) ? $user[$value['inspection_client_by']]['full_name'] : '-');

				$excel->getActiveSheet()->getStyle('A'.$start_vs.':N'.$start_vs)->applyFromArray($styleArray);
				unset($styleArray);
				$start_vs++;
			}

			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="Export Status RFI.xlsx"');
			$data = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
			$data->save('php://output');
			exit;


    // $this->load->view('rfi/export_data_rfi', $data);
  }
  
  public function rfi_client_pending_list($category = null) {
    error_reporting(0);
 
    $category                 = $this->encryption->decrypt(strtr($category, '.-~', '+=/'));

    if(!$category) {
      $category               = "mv";
    }

    $data['category']         = $category;

    $data['meta_title']       = 'Pending Approval';
    $data['subview']          = 'rfi/rfi_client_pending_list';
    $data['sidebar']          = $this->sidebar;
    $this->load->view('index', $data);
  }

  public function serverside_rfi_mv() {
    error_reporting(0);
    $data                     = [];
    $where_rfi                = null;

    $where_rfi['status_inspection']         = 5;
    $where_rfi['report_number IS NOT NULL'] = null;
    $where_rfi['report_resubmit_status']    = 0;

    if($this->user_cookie[7] == 8) {
      if($this->user_cookie[11] == 13) {
        $where_rfi['wp.company_id'] = 13;
      } else {
        $where_rfi['wp.company_id != 13'] = null;
      }
    }

    $list                     = $this->rfi_mod->serverside_rfi_mv($where_rfi);

    if($list) {
      $project_list           = $this->general_mod->project();
      foreach($project_list as $value) {
        $project[$value['id']]  = $value;
      }

      $where["category IN ('mv_no', 'mv_no_smop')"]      = null;
      $list_report_number     = $this->general_mod->report_no($where);
      unset($where);
  
      foreach($list_report_number as $value) {
        $report_no_format[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']][$value['category']] = $value['report_no'];
      }

    }

    foreach($list as $value) {
      $row                    = [];

      $report_no              = $value['report_number'];

      if($value['company_id'] == 13) {
        $running_report         = $report_no_format[$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']]['mv_no_smop'];
      } else {
        $running_report         = $report_no_format[$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']]['mv_no'];
      }

      $running_report           = $running_report.'-'.$report_no;

      $encrypt_project_id     = strtr($this->encryption->encrypt($value['project_code']), '+=/', '.-~');
      $encrypt_discipline     = strtr($this->encryption->encrypt($value['discipline']), '+=/', '.-~');
      $encrypt_type_of_module = strtr($this->encryption->encrypt($value['type_of_module']), '+=/', '.-~');
      $encrypt_module         = strtr($this->encryption->encrypt($value['module']), '+=/', '.-~');
      $encrypt_report_number  = strtr($this->encryption->encrypt($value['report_number']), '+=/', '.-~');
      $encrypt_report_no_rev  = strtr($this->encryption->encrypt($value['report_no_rev']), '+=/', '.-~');
      $encrypt_drawing_no     = strtr($this->encryption->encrypt($value['drawing_no']), '+=/', '.-~');

      $button                 = '<a target="_blank" href='.site_url('material_verification/detail_client_rfi/'.$encrypt_project_id.'/'.$encrypt_discipline.'/'.$encrypt_type_of_module.'/'.$encrypt_module.'/'.$encrypt_report_number.'/'.$encrypt_report_no_rev.'/NULL/'.$encrypt_drawing_no).' class="btn btn-primary"><i class="fas fa-list"></i> Detail</a>';


      $row[]                  = $project[$value['project_code']]['project_name'];
      $row[]                  = $running_report;
      $row[]                  = "Material Verification";
      $row[]                  = $value['drawing_no'];
      $row[]                  = $value['transmittal_datetime'];
      $row[]                  = $value['total_item'];
      $row[]                  = $button;

      $data[]                 = $row;
    }

    $result         			= [
      "draw"              => $_POST['draw'],
      "recordsTotal"      => $this->rfi_mod->count_serverside_rfi_mv_all($where_rfi),
      "recordsFiltered"   => $this->rfi_mod->count_serverside_rfi_mv_filtered($where_rfi),
      "data"              => $data
    ];

    echo json_encode($result);
    unset($where_rfi);


  }

  public function serverside_rfi_ft() {
    error_reporting(0);
    $data                     = [];
    $where_rfi                = null;

    $where_rfi['status_inspection']         = 5;
    $where_rfi['submission_id IS NOT NULL'] = null;
    $where_rfi['report_number IS NOT NULL'] = null;
    $where_rfi['status_retransmitted != 1']    = null;

    if($this->user_cookie[7] == 8) {
      if($this->user_cookie[11] == 13) {
        $where_rfi['wp.company_id'] = 13;
      } else {
        $where_rfi['wp.company_id != 13'] = null;
      }
    }

    $list                     = $this->rfi_mod->serverside_rfi_ft($where_rfi);

    if($list) {
      $project_list           = $this->general_mod->project();
      foreach($project_list as $value) {
        $project[$value['id']]  = $value;
      }

      $where["category IN ('fitup_report','fitup_report_scm')"]      = null;
      $list_report_number     = $this->general_mod->report_no($where);
      unset($where);
  
      foreach($list_report_number as $value) {
        $report_no_format[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']][$value['category']] = $value['report_no'];
      }

    }

    foreach($list as $value) {
      $row                    = [];

      $report_no              = $value['report_number'];

      if($value['company_id'] == 13) {
        $running_report         = $report_no_format[$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']]['fitup_report_scm'];
      } else {
        $running_report         = $report_no_format[$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']]['fitup_report'];
      }

      $running_report           = $running_report.$report_no;

      $encrypt_project_id     = strtr($this->encryption->encrypt($value['project_code']), '+=/', '.-~');
      $encrypt_discipline     = strtr($this->encryption->encrypt($value['discipline']), '+=/', '.-~');
      $encrypt_type_of_module = strtr($this->encryption->encrypt($value['type_of_module']), '+=/', '.-~');
      $encrypt_module         = strtr($this->encryption->encrypt($value['module']), '+=/', '.-~');
      $encrypt_report_number  = strtr($this->encryption->encrypt($value['report_number']), '+=/', '.-~');

      $button                 = '<a target="_blank" href='.site_url('fitup/client_inspection/'.$encrypt_project_id.'/'.$encrypt_discipline.'/'.$encrypt_module.'/'.$encrypt_type_of_module.'/'.$encrypt_report_number).' class="btn btn-primary"><i class="fas fa-list"></i> Detail</a>';


      $row[]                  = $project[$value['project_code']]['project_name'];
      $row[]                  = $running_report;
      $row[]                  = "Fitup";
      $row[]                  = $value['drawing_no'];
      $row[]                  = $value['transmittal_datetime'];
      $row[]                  = $value['total_item'];
      $row[]                  = $button;

      $data[]                 = $row;
    }

    $result         			= [
      "draw"              => $_POST['draw'],
      "recordsTotal"      => $this->rfi_mod->count_serverside_rfi_ft_all($where_rfi),
      "recordsFiltered"   => $this->rfi_mod->count_serverside_rfi_ft_filtered($where_rfi),
      "data"              => $data
    ];

    echo json_encode($result);
    unset($where_rfi);


  }


  public function serverside_rfi_vs() {
    error_reporting(0);
    $data                     = [];
    $where_rfi                = null;

    $where_rfi['status_inspection']         = 5;
    $where_rfi['submission_id IS NOT NULL'] = null;
    $where_rfi['report_number IS NOT NULL'] = null;
    $where_rfi['retransmitt_status != 1']    = null;

    if($this->user_cookie[7] == 8) {
      if($this->user_cookie[11] == 13) {
        $where_rfi['wp.company_id'] = 13;
      } else {
        $where_rfi['wp.company_id != 13'] = null;
      }
    }

    $list                     = $this->rfi_mod->serverside_rfi_vs($where_rfi);

    if($list) {
      $project_list           = $this->general_mod->project();
      foreach($project_list as $value) {
        $project[$value['id']]  = $value;
      }

      $where["category IN ('visual_report', 'visual_report_13')"]      = null;
      $list_report_number     = $this->general_mod->report_no($where);
      unset($where);
  
      foreach($list_report_number as $value) {
        $report_no_format[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']][$value['category']] = $value['report_no'];
      }

    }

    foreach($list as $value) {
      $row                    = [];

      $report_no              = $value['report_number'];

      if($value['company_id'] == 13) {
        $running_report         = $report_no_format[$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']]['visual_report_13'];
      } else {
        $running_report         = $report_no_format[$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']]['visual_report'];
      }

      $running_report           = $running_report.$report_no;

      $button                 = '<a target="_blank" href='.site_url('visual/detail_inspection/'.$value['report_number'].'/client/'.$value['drawing_no'].'/NULL/'.$value['postpone_reoffer_no']).' class="btn btn-primary"><i class="fas fa-list"></i> Detail</a>';


      $row[]                  = $project[$value['project_code']]['project_name'];
      $row[]                  = $running_report;
      $row[]                  = "Visual";
      $row[]                  = $value['drawing_no'];
      $row[]                  = $value['transmittal_datetime'];
      $row[]                  = $value['total_item'];
      $row[]                  = $button;

      $data[]                 = $row;
    }

    $result         			= [
      "draw"              => $_POST['draw'],
      "recordsTotal"      => $this->rfi_mod->count_serverside_rfi_vs_all($where_rfi),
      "recordsFiltered"   => $this->rfi_mod->count_serverside_rfi_vs_filtered($where_rfi),
      "data"              => $data
    ];

    echo json_encode($result);
    unset($where_rfi);


  }

}  

?>