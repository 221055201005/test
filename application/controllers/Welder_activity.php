<?php

use FontLib\Table\Type\post;

class Welder_activity extends CI_Controller {

    public function __construct(){
      parent::__construct();
      $this->load->helper('browser');
      $this->load->helper('cookies');
      $data_cookies = helper_cookies(@$this->input->get('user'));

      $this->load->model('home_mod');
      $this->load->model('general_mod');
      $this->load->model('engineering_mod');
      $this->load->model('planning_mod');
		  $this->load->model('master/welder_mod', 'm_welder_mod');
      $this->load->model('welder_activity_mod');

      $this->user_cookie 		  	= $data_cookies['data_user'];
      $this->permission_cookie  = $data_cookies['data_permission'];
      $this->sidebar 	          = "welder_activity/sidebar";

      $this->is_admin           = $this->permission_cookie[0];
      $this->smtp					      = smtp_config();
      $this->ftp                = ftp_config_syn();
      $this->prod_server        = [];
      $this->server_list        = $this->general_mod->portal_server_list();
      $this->prod_server        = array_column($this->server_list, 'ip_address');

      $this->ip_server          = $_SERVER['SERVER_ADDR'];
    }

    public function index() {
      redirect('welder_activity/dashboard');
    }

    public function dashboard() {

      $data['meta_title']       = "Welder Activity - Dashboard";
      $data['subview']          = "welder_activity/dashboard";
      $data['user_permission']  = $this->permission_cookie;
      $data['sidebar']          = $this->sidebar;
      $data['user_cookie']      = $this->user_cookie;

      $this->load->view('index', $data);

    }

    protected function get_week() {
      $week_list                = [];

      $week_day_number          = date('N');

      $range_list               = range(4, 1);
      if($week_day_number == 1) {
        $range_list             = range(3, 0);
      }

      foreach($range_list as $value) {
        $start_week_date        = date('Y-m-d', strtotime("-$value monday"));
        $week_num               = date("W", strtotime($start_week_date));
        $week_list[$week_num]   = $start_week_date;
      }

      return $week_list;

      
    }

    public function load_count_dashboard() {
      $date_filter              = $this->input->post('date_filter');
      if(!$date_filter) {
        $date_filter            = date('Y-m-d');
      }
      $output                       = [];

      $where['attendance_date']     = $date_filter;
      $attendance_list              = $this->welder_activity_mod->total_welder_attendance($where);
      unset($where);


      $total_attendance             = $attendance_list[0]['total_attendance'];
      $total_attendance_active      = $attendance_list[0]['total_active'];

      $where['DATE(created_date) = '] = $date_filter;
      $where['transferred_status']  = 0;
      $total_welder_daily           = $this->welder_activity_mod->total_welder_activity($where);
      unset($where);

      $total_welder                 = $total_welder_daily[0]['total_welder'];

      $total_not_assigned           = $total_attendance - $total_welder;
      $total_not_assigned           = $total_not_assigned < 0 ? 0 : $total_not_assigned;


      $output                       = [
        'total_available'           => $total_attendance,
        'total_assigned'            => $total_welder,
        'total_not_assigned'        => $total_not_assigned,
        'total_welder_active'       => $total_attendance_active
      ];

      echo json_encode($output);


    }

    public function load_weekly_welder() {
      $date_week_list               = $this->get_week();
      $range_start                  = min($date_week_list);
      $today_date                   = date('Y-m-d');
      
      $where['status_delete']       = 1;
      $where['transferred_status']  = 0;
      $where["DATE(created_date) BETWEEN '$range_start' AND '$today_date'"] = null;
      
      $attendance_list              = $this->welder_activity_mod->weekly_welder_assignment($where);
      unset($where);

      foreach($attendance_list as $value) {
        $value['week_date']           = date('Y-m-d', strtotime($value['week_date']));

        $where['status_delete']       = 1;
        $where['transferred_status']  = 0;
        $where["DATE(created_date) BETWEEN '$range_start' AND '$today_date'"] = null;
        $where["date_trunc('week', created_date) = "] = $value['week_date'];
        $welder_list                  = $this->welder_activity_mod->welder_activity_join($where);
        unset($where);

        $list_badge                   = array_unique(array_column($welder_list, 'welder_badge'));
        if($list_badge) {
          $where["badge IN ('".implode("', '", $list_badge)."')"] = NULL;
          $where["date_trunc('week', attendance_date) = "] = $value['week_date'];
          $manhours_list              = $this->welder_activity_mod->summary_welder_manhours($where);
          unset($where);

          foreach($manhours_list as $v) {
            $v['week_date']             = date('Y-m-d', strtotime($v['week_date']));
            $manhours[$v['week_date']]  = $v;
          }
        }

        $summary[$value['week_date']] = $value;
      }

      $output_chart                 = [];
      $label_list                   = [];

      $total_welder_all             = [];
      $total_length_all             = [];
      $total_manhours_all           = [];
      
      foreach($date_week_list as $key => $value) {
        $label_list[]               = "WK#".$key;
        $total_welder               = 0;
        $total_length               = 0;
        $total_manhours             = 0;

        if(isset($summary[$value])) {
          $total_welder             = intval($summary[$value]['total_welder']);
          $total_length             = intval($summary[$value]['total_length']);
        }

        if(isset($manhours[$value])) {
          $total_manhours           = intval($manhours[$value]['total_manhours']);
        }

        $total_welder_all[]         = $total_welder;
        $total_length_all[]         = $total_length;
        $total_manhours_all[]       = $total_manhours;

      }

      $output_chart[] = [
        'name'        => "Total Welder",
        'data'        => $total_welder_all,
        'type'        => 'column'
  
      ];

      
      $output_chart[] = [
        'name'        => "Total Length (MM)",
        'yAxis'       => 1,
        'data'        => $total_length_all,
        'type'        => 'spline'
      ];

      
      $output_chart[] = [
        'name'        => "Total Manhours",
        'data'        => $total_manhours_all,
        'yAxis'       => 2,
        'type'        => 'spline'
      ];

      $data['output']           = json_encode($output_chart);
      $data['label_list']       = json_encode($label_list);

      $this->load->view('welder_activity/chart/load_weekly_welder', $data);
    }

    public function load_weekly_welder_not_assigned() {
      $date_week_list               = $this->get_week();

      $range_start                  = min($date_week_list);
      $today_date                   = date('Y-m-d');

      $where["DATE(attendance_date) BETWEEN '$range_start' AND '$today_date'"] = null;
      $attendance_list              = $this->welder_activity_mod->welder_attendance_summary($where);
      unset($where);

      foreach($attendance_list as $value) {
        $value['week_date']         = date('Y-m-d', strtotime($value['week_date']));
        $attendance[$value['week_date']]  = $value;
      }

      $where['status_delete']       = 1;
      $where['transferred_status']  = 0;
      $where["DATE(created_date) BETWEEN '$range_start' AND '$today_date'"] = null;

      $attendance_list              = $this->welder_activity_mod->weekly_welder_assignment($where);
      unset($where);

      foreach($attendance_list as $value) {
        $value['week_date']           = date('Y-m-d', strtotime($value['week_date']));
        $summary[$value['week_date']] = $value;
      }

      $output_chart                 = [];
      $label_list                   = [];

      $total_all                    = [];


      foreach($date_week_list as $key => $value) {
        $label_list[]               = "WK#".$key;
        $total_att                  = 0;
        $total_assigned             = 0;

        if(isset($attendance[$value])) {
          $total_att                = $attendance[$value]['total_attendance'];
        }

        if(isset($summary[$value])) {
          $total_assigned           = $summary[$value]['total_welder'];
        }

        $total_sum                  = $total_att - $total_assigned;

        $total_all[]                = $total_sum < 0 ? 0 : $total_sum;

      }

      $output_chart[] = [
        'name'        => "Total Welder",
        'data'        => $total_all,
        'type'        => 'column'
      ];

      
      $data['output']           = json_encode($output_chart);
      $data['label_list']       = json_encode($label_list);

      $this->load->view('welder_activity/chart/load_weekly_welder_not_assigned', $data);

    }

    public function foreman_weekly_summary() {
      $date_week_list               = $this->get_week();

      $range_start                  = min($date_week_list);
      $today_date                   = date('Y-m-d');

      

      $where["DATE(created_date) BETWEEN '$range_start' AND '$today_date' "] = null;
      $where['status_delete']       = 1;
      $where['transferred_status']  = 0;
      $summary_list                 = $this->welder_activity_mod->foreman_weekly_summary($where);
      unset($where);

      if($summary_list) {
        $list_id_foreman            = array_unique(array_column($summary_list, 'created_by'));
        foreach($summary_list as $value) {
          $value['week_date']       = date('Y-m-d', strtotime($value['week_date']));

          $where['status_delete']       = 1;
          $where['transferred_status']  = 0;
          $where['act.created_by']      = $value['created_by'];
          $where["date_trunc('week', created_date) = "] = $value['week_date'];
          $welder_list                  = $this->welder_activity_mod->welder_activity_join($where);
          unset($where);
          $list_badge                   = array_unique(array_column($welder_list, 'welder_badge'));
          if($list_badge) {
            $where["badge IN ('".implode("', '", $list_badge)."')"] = NULL;
            $where["date_trunc('week', attendance_date) = "] = $value['week_date'];
            $manhours_list              = $this->welder_activity_mod->summary_welder_manhours($where);
            unset($where);
    
            foreach($manhours_list as $v) {
              $v['week_date']             = date('Y-m-d', strtotime($v['week_date']));
              $manhours[$value['created_by']][$v['week_date']]  = $v;
            }
          }

          $summary[$value['created_by']][$value['week_date']]   = $value;
    
        }

        $data['list_id_foreman']    = $list_id_foreman;

        $where["id_user IN ('".implode("', '", $list_id_foreman)."')"] = NULL;
        $user_list              = $this->general_mod->portal_user_db_list($where);
        unset($where);
        foreach($user_list as $value) {
          $data['user'][$value['id_user']]  = $value;
        }

        foreach($date_week_list as $key => $value) {
          $label_list[]               = "WK#".$key;
        }

        $output_chart           = [];

        foreach($list_id_foreman as $value) {
          $total_welder_all       = [];
          $total_length_all       = [];
          $total_manhours_all     = [];

          foreach($date_week_list as $v) {
            $total_welder         = 0;
            $total_length         = 0;
            $total_manhours       = 0;
            if(isset($summary[$value][$v])) {
              $total_welder     = $summary[$value][$v]['total_welder'];
              $total_length     = $summary[$value][$v]['total_length'];
              $total_manhours   = $manhours[$value][$v]['total_manhours'];
            }

            $total_welder_all[]        = intval($total_welder);
            $total_length_all[]        = intval($total_length);
            $total_manhours_all[]      = intval($total_manhours);
          }

          $output_chart[$value][] = [
            'name'        => "Total Welder",
            'data'        => $total_welder_all,
            'type'        => 'column'
          ];

          $output_chart[$value][] = [
            'name'        => "Total Length (MM)",
            'yAxis'       => 1,
            'data'        => $total_length_all,
            'type'        => 'spline'
          ];

          $output_chart[$value][] = [
            'name'        => "Total Manhours",
            'data'        => $total_manhours_all,
            'yAxis'       => 2,
            'type'        => 'spline'
          ];

        }


        $data['output']           = $output_chart;
        $data['label_list']       = json_encode($label_list);
      }

      $this->load->view('welder_activity/chart/foreman_weekly_summary', $data);

    }

    public function spv_weekly_summary() {

      $date_week_list               = $this->get_week();

      $range_start                  = min($date_week_list);
      $today_date                   = date('Y-m-d');

      $where["DATE(created_date) BETWEEN '$range_start' AND '$today_date' "] = null;
      $where['status_delete']       = 1;
      $where['transferred_status']  = 0;
      $summary_list                 = $this->welder_activity_mod->spv_weekly_summary($where);
      unset($where);

      if($summary_list) {
        $list_id_spv                = array_unique(array_column($summary_list, 'id_spv'));
        foreach($summary_list as $value) {
          $value['week_date']       = date('Y-m-d', strtotime($value['week_date']));

          $where['status_delete']       = 1;
          $where['transferred_status']  = 0;
          $where['act.id_spv']          = $value['id_spv'];
          $where["date_trunc('week', created_date) = "] = $value['week_date'];
          $welder_list                  = $this->welder_activity_mod->welder_activity_join($where);
          unset($where);
          $list_badge                   = array_unique(array_column($welder_list, 'welder_badge'));
          if($list_badge) {
            $where["badge IN ('".implode("', '", $list_badge)."')"] = NULL;
            $where["date_trunc('week', attendance_date) = "] = $value['week_date'];
            $manhours_list              = $this->welder_activity_mod->summary_welder_manhours($where);
            unset($where);
    
            foreach($manhours_list as $v) {
              $v['week_date']             = date('Y-m-d', strtotime($v['week_date']));
              $manhours[$value['id_spv']][$v['week_date']]  = $v;
            }
          }

          $summary[$value['id_spv']][$value['week_date']] = $value;
        }

        $data['list_id_spv']    = $list_id_spv;

        $where["id_user IN ('".implode("', '", $list_id_spv)."')"] = NULL;
        $user_list              = $this->general_mod->portal_user_db_list($where);
        unset($where);
        foreach($user_list as $value) {
          $data['user'][$value['id_user']]  = $value;
        }

        foreach($date_week_list as $key => $value) {
          $label_list[]               = "WK#".$key;
        }

        $output_chart           = [];

        foreach($list_id_spv as $value) {
          $total_foreman_all    = [];
          $total_welder_all     = [];
          $total_length_all     = [];
          $total_manhours_all   = [];

          foreach($date_week_list as $v) {
            $total_foreman      = 0;
            $total_welder       = 0;
            $total_length       = 0;
            $total_manhours     = 0;
            if(isset($summary[$value][$v])) {
              $total_foreman            = $summary[$value][$v]['total_foreman'];
              $total_welder             = $summary[$value][$v]['total_welder'];
              $total_length             = $summary[$value][$v]['total_length'];
              $total_manhours           = $manhours[$value][$v]['total_manhours'];
            }

            $total_foreman_all[]       = intval($total_foreman);
            $total_welder_all[]        = intval($total_welder);
            $total_length_all[]        = intval($total_length);
            $total_manhours_all[]      = intval($total_manhours);
          }

          $output_chart[$value][] = [
            'name'        => "Total Foreman",
            'data'        => $total_foreman_all,
            'type'        => 'column'
          ];

          $output_chart[$value][] = [
            'name'        => "Total Welder",
            'data'        => $total_welder_all,
            'type'        => 'column'
          ];

          $output_chart[$value][] = [
            'name'        => "Total Length (MM)",
            'yAxis'       => 1,
            'data'        => $total_length_all,
            'type'        => 'spline'
          ];

          $output_chart[$value][] = [
            'name'        => "Total Manhours",
            'yAxis'       => 2,
            'data'        => $total_manhours_all,
            'type'        => 'spline'
          ];

        }

        $data['output']           = $output_chart;
        $data['label_list']       = json_encode($label_list);

      }

      $this->load->view('welder_activity/chart/spv_weekly_summary', $data);
    }

    public function activity_list() {

      $submit                   = $this->input->get('submit');
      if($submit == "download") {
        return $this->download_activity_list();
      }

      $where['status_delete']       = 1;
      $where['transferred_status']  = 0;
      $data['supervisor_list']      = $this->welder_activity_mod->supervisor_list($where);
      $data['foreman_list']         = $this->welder_activity_mod->foreman_list($where);
      unset($where);

      $list_user_id                 = [0];
      foreach($data['supervisor_list'] as $value) {
        $list_user_id[]             = intval($value['id_spv']);
      }

      foreach($data['foreman_list'] as $value) {
        $list_user_id[]             = intval($value['created_by']);
      }

      $where["id_user IN ('".implode("', '", $list_user_id)."')"] = NULL;
      $user_list                  = $this->general_mod->portal_user_db_list($where);
      unset($where);
      foreach($user_list as $value) {
        $data['user'][$value['id_user']]  = $value;
      }



      $data['meta_title']       = "Welder Activity - Activity List";
      $data['subview']          = "welder_activity/activity_list";
      $data['user_permission']  = $this->permission_cookie;
      $data['sidebar']          = $this->sidebar;
      $data['user_cookie']      = $this->user_cookie;
      $data['serverside']       = "welder_activity/serverside_activity_list";

      $this->load->view('index', $data);
    }

    public function download_activity_list() {
      error_reporting(0);
      $status_complete          = $this->input->get('status_complete');
      $start_date               = $this->input->get('start_date');
      $end_date                 = $this->input->get('end_date');
      $id_spv                   = $this->input->get('id_spv');
      $id_foreman               = $this->input->get('id_foreman');
      
      if($start_date != "" && $end_date != "") {
        $where["DATE(created_date) BETWEEN '$start_date' AND '$end_date'"] = null;
      }

      if($id_spv) {
        $where["id_spv"]                = $id_spv;
      }

      if($id_foreman) {
        $where["created_by"]            = $id_foreman;
      }
      if($status_complete != "") {
        $where["status_complete"] = $status_complete;
      }

      $where['status_delete']       = 1;
      $where['transferred_status']  = 0;
      $where['id_welder IS NOT NULL'] = null;

      $order_by                     = "id DESC";
      $activity_list                = $this->welder_activity_mod->welder_activity_list($where, $order_by);
      unset($where);

      if($activity_list) {
        foreach($activity_list as $value) {
          $list_id_activity[]       = intval($value['id']);
          $list_id_joint[]          = intval($value['id_joint']);
          $list_id_wp[]             = intval($value['id_wp']);
          $list_id_welder[]         = intval($value['id_welder']);
          $list_user_id[]           = intval($value['id_spv']);
          $list_user_id[]           = intval($value['created_by']);
        }

        $where["id_welder_activity IN ('".implode("', '", $list_id_activity)."')"] = NULL;
        $where['status_delete']     = 1;
        $detail_list                = $this->welder_activity_mod->weld_length_activity($where);
        unset($where);

        foreach($detail_list as $value) {
          $detail[$value['id_welder_activity']][] = $value;
        }

        $where["id_welder IN ('".implode("', '", $list_id_welder)."')"] = NULL;
        $welder_list                = $this->m_welder_mod->welder_list($where);
        unset($where);
        foreach($welder_list as $value) {
          $welder[$value['id_welder']] = $value;
        }

        $where["id_user IN ('".implode("', '", $list_user_id)."')"] = NULL;
        $user_list                  = $this->general_mod->portal_user_db_list($where);
        unset($where);
        foreach($user_list as $value) {
          $user[$value['id_user']]  = $value;
        }

        $where["id IN ('".implode("', '", $list_id_joint)."')"] = NULL;
        $joint_list                 = $this->engineering_mod->joint_list($where);
        unset($where);

        foreach($joint_list as $value) {
          $joint[$value['id']]  = $value;
        }

        $where["id IN ('".implode("', '", $list_id_wp)."')"] = NULL;
        $wp_list                  = $this->planning_mod->workpack_list($where);
        unset($where);

        foreach($wp_list as $value) {
          $wp[$value['id']]  = $value;
        }

        $weld_category_list     = $this->welder_activity_mod->master_weld_category();
        foreach($weld_category_list as $value) {
          $weld_category[$value['id']]  = $value;
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
        )
      );

      $sheet->setCellValue('A1', 'ACTIVITY DATE');
      $sheet->setCellValue('B1', 'SUPERVISOR');
      $sheet->setCellValue('C1', 'FOREMAN'); 
      $sheet->setCellValue('D1', 'WELDER BADGE'); 
      $sheet->setCellValue('E1', 'WELDER STAMP'); 
      $sheet->setCellValue('F1', 'WELDER NAME'); 
      $sheet->setCellValue('G1', 'WELD CATEGORY');
      $sheet->setCellValue('H1', 'WORKPACK NO'); 
      $sheet->setCellValue('I1', 'JOB NO'); 
      $sheet->setCellValue('J1', 'WELD MAP'); 
      $sheet->setCellValue('K1', 'JOINT NO'); 
      $sheet->setCellValue('L1', 'ACTIVITY DESCRIPTION'); 
      $sheet->setCellValue('M1', 'TOTAL LENGTH (MM)'); 
      $sheet->setCellValue('N1', 'STATUS'); 

      $excel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($styleArray);
      unset($styleArray);

      foreach(range('A','N') as $value) {
        $excel->getActiveSheet()->getColumnDimension($value)->setAutoSize(true);
      }

      $start  = 2;
      foreach($activity_list as $value) {
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

          $workpack_no      = $value['wp_no'];
          if(isset($wp[$value['id_wp']])) {
            $workpack_no    = $wp[$value['id_wp']]['workpack_no'];
          }

          $total_weld_length  = "";

          if(isset($detail[$value['id']])) {
            $total_weld_length  = array_sum(array_column($detail[$value['id']], 'total_length'));
          }

          $status             = "On Progress";
          if($value['status_complete'] == 1) {
            $status           = "Completed";
          }

          $sheet->setCellValue('A'.$start, $value['created_date']);
          $sheet->setCellValue('B'.$start, $user[$value['id_spv']]['full_name']);
          $sheet->setCellValue('C'.$start, $user[$value['created_by']]['full_name']);
          $sheet->setCellValue('D'.$start, $welder[$value['id_welder']]['welder_badge']);
          $sheet->setCellValue('E'.$start, $welder[$value['id_welder']]['welder_code']);
          $sheet->setCellValue('F'.$start, $welder[$value['id_welder']]['welder_name']);
          $sheet->setCellValue('G'.$start, $weld_category[$value['id_weld_category']]['name']);
          $sheet->setCellValue('H'.$start, $workpack_no);
          $sheet->setCellValue('I'.$start, $value['job_no']);
          $sheet->setCellValue('J'.$start, isset($joint[$value['id_joint']])   ?$joint[$value['id_joint']]['drawing_wm'] : '');
          $sheet->setCellValue('K'.$start, isset($joint[$value['id_joint']])   ?$joint[$value['id_joint']]['joint_no'] : '');
          $sheet->setCellValue('L'.$start, $value['activity_desc']);
          
          $sheet->setCellValue('M'.$start, $total_weld_length);
          $sheet->setCellValue('N'.$start, $status);
 
          $excel->getActiveSheet()->getStyle('A'.$start.':N'.$start)->applyFromArray($styleArray);
          unset($styleArray);
          $start++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Export Welder Activity List.xlsx"');
        $data = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $data->save('php://output');
        exit;
    }

    public function transfer_welder_list() {

      $submit                   = $this->input->get('submit');

      if($submit == "download") {
        return $this->download_transfer_welder_list();
      }

      $where['status_delete']   = 1;
      $data['requestor_list']   = $this->welder_activity_mod->transfer_requestor_list($where);
      unset($where);

      $list_user_id                 = [0];
      foreach($data['requestor_list'] as $value) {
        $list_user_id[]             = intval($value['created_by']);
      }

      $where['company_id']          = '1';
      $data['welder_list']          = $this->m_welder_mod->welder_list($where);
      unset($where);

      $where["id_user IN ('".implode("', '", $list_user_id)."')"] = NULL;
      $user_list                  = $this->general_mod->portal_user_db_list($where);
      unset($where);
      foreach($user_list as $value) {
        $data['user'][$value['id_user']]  = $value;
      }

      $data['meta_title']       = "Welder Activity - Transfer Welder List";
      $data['subview']          = "welder_activity/transfer_welder_list";
      $data['user_permission']  = $this->permission_cookie;
      $data['sidebar']          = $this->sidebar;
      $data['user_cookie']      = $this->user_cookie;

      $data['serverside']       = "welder_activity/serverside_transfer_welder";

      $this->load->view('index', $data);
    }

    public function download_transfer_welder_list() {
      error_reporting(0);
      $status                   = $this->input->get('status');
      $start_date               = $this->input->get('start_date');
      $end_date                 = $this->input->get('end_date');
      $id_requestor             = $this->input->get('id_requestor');
      $id_welder                = $this->input->get('id_welder');

      $where                      = null;
      $where['status_delete']     = 1;

      if($start_date != "" && $end_date != "") {
        $where["DATE(created_date) BETWEEN '$start_date' AND '$end_date'"] = null;
      }

      if($id_requestor) {
        $where["created_by"]   = $id_requestor;
      }

      if($id_welder) {
        $where["id_welder"]    = $id_welder;
      }

      if($status != "") {
        $where['status']        = $status;
      }

      $data_transfer            = $this->welder_activity_mod->transfer_welder_list($where);
      unset($where);

      if($data_transfer) {
        foreach($data_transfer as $value) {
          $list_id_welder[]     = $value['id_welder'];
          $list_user_id[]       = $value['id_foreman_from'];
          $list_user_id[]       = $value['id_foreman_to'];
          $list_user_id[]       = $value['created_by'];
        }

        $where["id_welder IN ('".implode("', '", $list_id_welder)."')"] = NULL;
        $welder_list            = $this->m_welder_mod->welder_list($where);
        unset($where);
        foreach($welder_list as $value) {
          $welder[$value['id_welder']] = $value;
        }

        $where["id_user IN ('".implode("', '", $list_user_id)."')"] = NULL;
        $user_list              = $this->general_mod->portal_user_db_list($where);
        unset($where);
        foreach($user_list as $value) {
          $user[$value['id_user']]  = $value;
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
        )
      );


      $sheet->setCellValue('A1', 'REQUESTED BY'); 
      $sheet->setCellValue('B1', 'REQUESTED DATE'); 
      $sheet->setCellValue('C1', 'REASON'); 

      $sheet->setCellValue('D1', 'WELDER BADGE');
      $sheet->setCellValue('E1', 'WELDER STAMP');
      $sheet->setCellValue('F1', 'WELDER NAME'); 
      $sheet->setCellValue('G1', 'FOREMAN FROM'); 
      $sheet->setCellValue('H1', 'FOREMAN TO'); 
      $sheet->setCellValue('I1', 'STATUS REQUEST'); 
      

      $excel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($styleArray);
      unset($styleArray);

      foreach(range('A','I') as $value) {
        $excel->getActiveSheet()->getColumnDimension($value)->setAutoSize(true);
      }

      $start  = 2;
      foreach($data_transfer as $value) {
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

          $status_req = "Pending Approval";

          if($value['status'] == 2) {
            $status_req = "Rejected";
          } elseif($value['status'] == 3) {
            $status_req = "Approved";
          }

          $sheet->setCellValue('A'.$start, $user[$value['created_by']]['full_name']);
          $sheet->setCellValue('B'.$start, $value['created_date']);
          $sheet->setCellValue('C'.$start, $value['remarks']);

          $sheet->setCellValue('D'.$start, $welder[$value['id_welder']]['welder_badge']);
          $sheet->setCellValue('E'.$start, $welder[$value['id_welder']]['welder_code']);
          $sheet->setCellValue('F'.$start, $welder[$value['id_welder']]['welder_name']);
          $sheet->setCellValue('G'.$start, $user[$value['id_foreman_from']]['full_name']);
          $sheet->setCellValue('H'.$start, $user[$value['id_foreman_to']]['full_name']);
          $sheet->setCellValue('I'.$start, $status_req);
          
       
 
          $excel->getActiveSheet()->getStyle('A'.$start.':I'.$start)->applyFromArray($styleArray);
          unset($styleArray);
          $start++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Export Transfer Welder List.xlsx"');
        $data = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $data->save('php://output');
        exit;


    }

    public function serverside_transfer_welder() {
      error_reporting(0);
      $data                     = [];
      $status_request           = $this->input->post('status_request');
      $start_date               = $this->input->post('start_date');
      $end_date                 = $this->input->post('end_date');
      $id_requestor             = $this->input->post('id_requestor');
      $id_welder                = $this->input->post('id_welder');
      
      $where_db                 = null;

      if($start_date != "" && $end_date != "") {
        $where_db["DATE(created_date) BETWEEN '$start_date' AND '$end_date'"] = null;
      }

      if($id_requestor) {
        $where_db["created_by"]   = $id_requestor;
      }

      if($id_welder) {
        $where_db["tf.id_welder"]    = $id_welder;
      }

      $where_db['status_delete']  = 1;
      if($status_request != "") {
        $where_db['status']        = $status_request;
      }
      $list                     = $this->welder_activity_mod->serverside_transfer_welder($where_db);

      if($list) {
        foreach($list as $value) {
          $list_user_id[]       = $value['id_foreman_from'];
          $list_user_id[]       = $value['id_foreman_to'];
          $list_user_id[]       = $value['created_by'];
        }

        $where["id_user IN ('".implode("', '", $list_user_id)."')"] = NULL;
        $user_list              = $this->general_mod->portal_user_db_list($where);
        unset($where);

        foreach($user_list as $value) {
          $user[$value['id_user']]  = $value;
        }

      }

      foreach($list as $value) {
        $row                    = [];

        $status                 = '<span class="badge badge-pill badge-primary">Pending Approval</span>';

        if($value['status'] == 2) {
          $status                 = '<span class="badge badge-pill badge-danger">Rejected</span>';
        } elseif($value['status'] == 3) {
          $status                 = '<span class="badge badge-pill badge-success">Approved</span>';
        }
        $row[]                  = $user[$value['created_by']]['full_name'];
        $row[]                  = $value['created_date'];
        $row[]                  = $user[$value['id_foreman_from']]['full_name'];
        $row[]                  = $user[$value['id_foreman_to']]['full_name'];
        $row[]                  = $value['remarks'] ? $value['remarks'] : '-';
        $row[]                  = $value['welder_badge'];
        $row[]                  = $value['welder_code'];
        $row[]                  = $value['welder_name'];
        $row[]                  = $status;
       
        

        $data[]                 = $row;
      }

      $result         			= [
        "draw"              => $_POST['draw'],
        "recordsTotal"      => $this->welder_activity_mod->count_serverside_transfer_welder_all($where_db),
        "recordsFiltered"   => $this->welder_activity_mod->count_serverside_transfer_welder_filtered($where_db),
        "data"              => $data
      ];
  
      echo json_encode($result);
      unset($where_db);
    }

    public function serverside_activity_list() {
      error_reporting(0);
      $data                     = [];
      $start_date               = $this->input->post('start_date');
      $end_date                 = $this->input->post('end_date');
      $id_spv                   = $this->input->post('id_spv');
      $id_foreman               = $this->input->post('id_foreman');
      $status_complete          = $this->input->post('status_complete');
      $where_db                 = null;

      if($start_date != "" && $end_date != "") {
        $where_db["DATE(created_date) BETWEEN '$start_date' AND '$end_date'"] = null;
      }

      if($id_spv) {
        $where_db["id_spv"]                = $id_spv;
      }

      if($id_foreman) {
        $where_db["created_by"]            = $id_foreman;
      }

      $where_db['status_delete']        = 1;
      $where_db['transferred_status']   = 0;
      if($status_complete != "") {
        $where_db['status_complete']  = $status_complete;
      }

      $list                     = $this->welder_activity_mod->serverside_activity_list($where_db);

      if($list) {
        foreach($list as $value) {
          $list_user_id[]       = $value['id_spv'];
          $list_user_id[]       = $value['created_by'];
        }

        $where["id_user IN ('".implode("', '", $list_user_id)."')"] = NULL;
        $user_list              = $this->general_mod->portal_user_db_list($where);
        unset($where);

        foreach($user_list as $value) {
          $user[$value['id_user']]  = $value;
        }

        $weld_category_list     = $this->welder_activity_mod->master_weld_category();
        foreach($weld_category_list as $value) {
          $weld_category[$value['id']]  = $value;
        }

      }

      foreach($list as $value) {
        $row                    = [];

        $status                 = '<span class="badge badge-pill badge-primary">Pending Approval</span>';

        if($value['status'] == 2) {
          $status                 = '<span class="badge badge-pill badge-danger">Rejected</span>';
        } elseif($value['status'] == 3) {
          $status                 = '<span class="badge badge-pill badge-success">Approved</span>';
        }

        $workpack_no            = $value['workpack_no'];
        if($value['id_weld_category'] == 6) {
          $workpack_no          = $value['wp_no'];
        }

        $status_complete        = '<span class="badge badge-primary badge-pill">On Progress</span>';

        if($value['status_complete'] == 1) {
          $status_complete        = '<span class="badge badge-success badge-pill">Completed</span>';
        }

        $id_enc                 = strtr($this->encryption->encrypt($value['id']), '+=/', '.-~');

        $button_list            = '<div class="btn-group">';
        $button_list            .= "<button class='btn btn-primary' onclick='show_detail(this, \"$id_enc\")'><i class='fas fa-list'></i> Detail</button>";
        $button_list            .= '</div>';

        $row[]                  = $value['created_date'];
        $row[]                  = $user[$value['id_spv']]['full_name'];
        $row[]                  = $user[$value['created_by']]['full_name'];
        $row[]                  = $value['welder_badge'];
        $row[]                  = $value['welder_code'];
        $row[]                  = $value['welder_name'];
        $row[]                  = $weld_category[$value['id_weld_category']]['name'];
        $row[]                  = $workpack_no ? $workpack_no : '-';
        $row[]                  = $value['job_no'] ? $value['job_no'] : '-';
        $row[]                  = $value['drawing_wm'] ? $value['drawing_wm'] : '-';
        $row[]                  = $value['joint_no'] ? $value['joint_no'] : '-';
        $row[]                  = $value['activity_desc'] ? $value['activity_desc'] : '-'; 
     
        $row[]                  = $value['total_length'] ? $value['total_length'] : '-';
        
        $row[]                  = $status_complete;
        $row[]                  = $button_list;

        

        $data[]                 = $row;
      }

      $result         			= [
        "draw"              => $_POST['draw'],
        "recordsTotal"      => $this->welder_activity_mod->count_serverside_activity_list_all($where_db),
        "recordsFiltered"   => $this->welder_activity_mod->count_serverside_activity_list_filtered($where_db),
        "data"              => $data
      ];

      echo json_encode($result);
      unset($where_db);
    }

   public function detail_dashboard_daily() {
    error_reporting(0);
    $date_activity        = $this->input->get('date_activity');
    $status               = $this->input->get('status');
    $status               = $this->encryption->decrypt(strtr($status, '.-~', '+=/'));

    if(!$status) {
      return redirect('welder_activity/dashboard');
    }

    $list_badge               = [];

    $where['attendance_date'] = $date_activity;
    $where["status_active"]   = 1;

    $attendance_list        = $this->welder_activity_mod->welder_attendance_list($where);
    unset($where);

    $data['list']           = $attendance_list;
    $list_badge             = array_column($attendance_list, 'badge');
    
    $where['status_delete']       = 1;
    $where['transferred_status']  = 0;
    $where['DATE(created_date)']  = $date_activity;
    $activity_list                = $this->welder_activity_mod->welder_activity_join($where);
    unset($where);

    foreach($activity_list as $value) {
      $data['activity'][$value['welder_badge']] = $value;
    }

    $where["welder_badge IN ('".implode("', '", $list_badge)."')"] = NULL;
    $welder_list            = $this->m_welder_mod->welder_list($where);
    unset($where);

    foreach($welder_list as $value) {
      $data['welder'][$value['welder_badge']] = $value;
    }

    $project_list             = $this->general_mod->project();
    foreach($project_list as $value) {
      $data['project'][$value['id']]  = $value;
    }

    $company_list             = $this->general_mod->company();
    foreach($company_list as $value) {
      $data['company'][$value['id_company']]  = $value;
    }

    $data['status_view']      = $status;
    $data['date_activity']    = $date_activity;

    $data['meta_title']       = "Welder Activity - Detail Welder Dashboard ";
    $data['subview']          = "welder_activity/detail_dashboard_daily";
    $data['user_permission']  = $this->permission_cookie;
    $data['sidebar']          = $this->sidebar;
    $data['user_cookie']      = $this->user_cookie;

    $this->load->view('index', $data);
  }

  public function sum_total_time() {
    $time1        = strtotime('2023-01-04 06:56:03'); 
    $time2        = strtotime('2023-01-04 20:41:49'); 
    $difference   = round(abs($time2 - $time1  -2700) / 3600,2); 

    test_var($difference);
  }



  }
