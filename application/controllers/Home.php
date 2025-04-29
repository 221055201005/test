<?php

use FontLib\Table\Type\post;

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->helper('browser');
		$this->load->helper('cookies');
		$data_cookies = helper_cookies(@$this->input->get('user'));

		$this->load->model('home_mod');
		$this->load->model('general_mod');
		$this->load->model('planning_mod');
		$this->load->model('engineering_mod');
		$this->load->model('fitup_mod');
		$this->load->model('visual_mod');
		$this->load->model('material_verification_mod');
		$this->load->model('ndt_mod');

		$this->user_cookie 		  = $data_cookies['data_user'];

		$this->permission_cookie  = $data_cookies['data_permission'];

		$this->legend_workpack_chart = ['Pending Engineering', 'Issued', 'In Progress', 'Overdue', 'Pending Superintendent (Issued)', 'Pending Project / Construction Engineering (Issued)', 'Pending Project / Construction Engineering (Returned)', 'Pending Construction Superintendent (Returned)', 'Completed', 'Void', 'Rejected'];

		$this->project_alt        = $this->user_cookie[13];
		$this->company_alt        = $this->user_cookie[14];
	}

	public function index()
	{
		redirect('home/home_dashboard');
	}

	public function home_dashboard()
	{
		$data['tabmenu'] = $this->dashboard_tabmenu('menu1');

		$data['meta_title']  	 		= 'Home';
		$data['subview']     	 		= 'home/home_dashboard';

		$this->load->view('index', $data);
	}

	public function sidebarCollapse()
	{
		$sidebarCollapse['name'] = 'sidebarCollapse';
		$sidebarCollapse['expire'] = 86400 * 30;
		if ($this->input->cookie('sidebarCollapse') !== NULL) {
			$sidebarCollapse['value'] = ($this->input->cookie('sidebarCollapse') + 1) % 2 + 0;
		} else {
			$sidebarCollapse['value'] = 1;
		}
		$this->input->set_cookie($sidebarCollapse);
	}

	public function home_new()
	{
		redirect('home/home_dashboard');
		return false;

		$weekly_date_chart = [];
		$date_current_week = date("Y-m-d", strtotime("next monday"));
		for ($i = 0; $i < 7; $i++) {
			$date = date("Y-m-d", strtotime($date_current_week . " -" . ($i * 7) . " days"));
			$date_start = [];
			for ($x = 1; $x <= 7; $x++) {
				$date_start[] = date("Y-m-d", strtotime($date . " -" . $x . " days"));
				$weekly_date_chart[$date][] = end($date_start);
			}
		}
		$weekly_date_chart = array_reverse($weekly_date_chart);

		$datadb = $this->planning_mod->plan_measurement_list([
			"phase" => NULL,
			"discipline" => NULL,
			"type_of_module" => NULL,
		]);
		$plan_list = [];
		$month_plan_list = [];
		foreach ($weekly_date_chart as $week => $nothing) {
			foreach ($datadb as $key => $value) {
				if ($value['week_no'] == date("W", strtotime($nothing[0])) && $value['year_week'] == date("Y", strtotime($nothing[0]))) {
					$plan_list[$week] = $value["plan_target"];
				}
			}
		}
		foreach ($datadb as $key => $value) {
			$week_end_days = new DateTime();
			$week_end_days->setISODate($value["year_week"], $value["week_no"]);
			$week_end_days = $week_end_days->format('Y-m-d');
			$week_end_days = date("Y-m-d", strtotime($week_end_days . " +6 days"));
			if (date("Y", strtotime($week_end_days)) == '2022') {
				$month_plan_list[date("n", strtotime($week_end_days))] = $value["plan_target"];
			}
		}

		$datadb = $this->home_mod->data_dashboard(null, 'day');
		$progress_list = [];
		$check_double_actual = [];
		// test_var($datadb);
		foreach ($weekly_date_chart as $week => $nothing) {
			foreach ($datadb as $key => $value) {
				if ($value['day'] != '' && date('Y-m-d', strtotime($value['day'])) <= $week) {
					@$progress_list[$value['part_id']] = ((($value["pf_mv"] * 15 / 100) + ($value["f_fu"] * 30 / 100) + ($value["f_vs"] * 45 / 100) + ($value["f_ndt"] * 10 / 100)) * 0.4 + (($value["as_fu"] * 40 / 100) + ($value["as_vs"] * 50 / 100) + ($value["as_ndt"] * 10 / 100)) * 0.3 + (($value["er_fu"] * 40 / 100) + ($value["er_vs"] * 50 / 100) + ($value["er_ndt"] * 10 / 100)) * 0.3) + 0;
				}
			}
			$cum_actual = 0;
			if (count($progress_list) > 0) {
				$cum_actual = @(@array_sum($progress_list) / @count($progress_list));
				$cum_actual = number_format($cum_actual, 2) + 0;
			}
			$weekly_actual_chart[] = $cum_actual;
		}
		// test_var($weekly_actual_chart);
		$progress_list = [];
		for ($i = 1; $i <= 12; $i++) {
			foreach ($datadb as $key => $value) {
				if ($value['day'] != '' && date('n', strtotime($value['day'])) <= $i) {
					@$progress_list[$value['part_id']] = ((($value["pf_mv"] * 15 / 100) + ($value["f_fu"] * 30 / 100) + ($value["f_vs"] * 45 / 100) + ($value["f_ndt"] * 10 / 100)) * 0.4 + (($value["as_fu"] * 40 / 100) + ($value["as_vs"] * 50 / 100) + ($value["as_ndt"] * 10 / 100)) * 0.3 + (($value["er_fu"] * 40 / 100) + ($value["er_vs"] * 50 / 100) + ($value["er_ndt"] * 10 / 100)) * 0.3) + 0;
				}
			}
			$cum_actual = 0;
			if (date('n') < $i) {
				$cum_actual = 0;
			} elseif (count($progress_list) > 0) {
				$cum_actual = @(@array_sum($progress_list) / @count($progress_list));
				$cum_actual = number_format($cum_actual, 2) + 0;
			}
			$actual_monthly_chart[] = $cum_actual;
		}
		$cum_actual = 0;
		foreach ($weekly_date_chart as $key => $week_list) {
			$weekly_chart[] = @$plan_list[$key] + 0;
		}
		// test_var($weekly_chart);
		$monthly_chart = [];
		for ($i = 1; $i <= 12; $i++) {
			$monthly_chart[] = @$month_plan_list[$i] + 0;
		}

		$weekly_chart = [
			[
				"name" => "Plan Target",
				"data" => $weekly_chart,
				"color" => "#3bc2d4",
			],
			[
				"name" => "Actual",
				"data" => $weekly_actual_chart,
				"color" => "#ff706b",
			]
		];
		// test_var($weekly_chart);

		$monthly_chart = [
			[
				"name" => "Plan Target",
				"data" => $monthly_chart,
				"color" => "#3bc2d4",
			],
			[
				"name" => "Actual",
				"data" => $actual_monthly_chart,
				"color" => "#ff706b",
			]
		];

		$data["weekly_chart"] = $weekly_chart;
		$data["monthly_chart"] = $monthly_chart;

		$data['workpack_list'] = $this->planning_mod->workpack_list(["status_delete" => 1]);

		// ============================ TOTAL MAN HOURS ========================================

		// ----------------------- PHASE -------------------------
		$where["discipline"] 	= 2;
		$data['phase_list'] 	= $this->general_mod->phase($where);
		unset($where);
		// --------------------------------------------------------

		// --------------------- TIMESHEET ------------------------
		$where = NULL;
		// $where['status_delete'] = 1;
		$datadb 				= $this->general_mod->timesheet_list($where);
		foreach ($datadb as $key => $value) {
			$timesheet_list[$value['workpack_id']] = @$timesheet_list[$value['workpack_id']] + $value['manhours'];
		}
		unset($where);

		// print_r($timesheet_list);exit;
		// --------------------------------------------------------

		// ---------------------- WORKPACK ------------------------
		$where = NULL;
		// $where = ;
		// $where['status_delete'] = 1;
		$datadb = $this->general_mod->workpack_list($where);
		foreach ($datadb as $key => $value) {
			if (!@in_array($value['location'], @$arr_location)) {
				$arr_location[] 	= $value['location'];
			}

			foreach ($data['phase_list'] as $phase) {

				if ($value['phase'] == $phase['phase_code']) {
					if (isset($timesheet_list[$value['id']])) {
						$data['location_by_phase'][$value['location']][$phase['id']] = @$data['location_by_phase'][$value['location']][$phase['id']] + $timesheet_list[$value['id']];
					}
				}
			}
		}
		unset($where);

		// print_r($test);exit;
		// print_r($data['location_by_phase'][2]);exit;
		// ---------------------------------------------------------

		// ---------------------- LOCATION -------------------------
		$location_list = [];
		if (isset($arr_location)) {
			$arr_location = array_filter(array_unique($arr_location));

			$where["id IN (" . implode(", ", $arr_location) . ")"] = NULL;
			$location_list = $this->general_mod->master_location($where);
		}
		$data['location_list'] = $location_list;
		// ---------------------------------------------------------

		// =====================================================================================
		$data['meta_title']  	 		= 'Home';
		$data['subview']     	 		= 'home/home_new';
		$data['user_permission'] 		= $this->permission_cookie;

		$this->load->view('index', $data);
	}

	public function data_dashboard()
	{
		$level = $this->input->post("level");

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['id']] = $value;
		}

		$datadb = $this->general_mod->discipline(["production_status" => 1]);
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['id']] = $value;
		}

		$datadb = $this->general_mod->phase();
		$phase_list = [];
		foreach ($datadb as $key => $value) {
			$phase_list[$value['discipline']][$value['phase_code']] = $value;
		}

		$weekly_date_chart = [];
		$date_current_week = date("Y-m-d", strtotime("next sunday"));
		for ($i = 0; $i < 3; $i++) {
			$date = date("Y-m-d", strtotime($date_current_week . " -" . ($i * 7) . " days"));
			$weekly_date_chart[] = $date;
		}

		$datadb = $this->home_mod->data_dashboard(null, 'day');
		$progress_list = [];
		$sum_progress_list = [];
		foreach ($datadb as $key => $value) {
			$progress_list[] = [
				"progress" 				=> (($value["pf_mv"] * 15 / 100) + ($value["f_fu"] * 30 / 100) + ($value["f_vs"] * 45 / 100) + ($value["f_ndt"] * 10 / 100)) + 0,
				"day" 						=> date("Y-m-d", strtotime($value["day"])),
				"project" 				=> $value["project"],
				"type_of_module" 	=> $value["type_of_module"],
				"discipline" 			=> $value["discipline"],
				"part_id" 				=> $value["part_id"],
				"phase" 					=> "FB",
			];
			$progress_list[] = [
				"progress" 				=> (($value["as_fu"] * 40 / 100) + ($value["as_vs"] * 50 / 100) + ($value["as_ndt"] * 10 / 100)) + 0,
				"day" 						=> date("Y-m-d", strtotime($value["day"])),
				"project" 				=> $value["project"],
				"type_of_module" 	=> $value["type_of_module"],
				"discipline" 			=> $value["discipline"],
				"part_id" 				=> $value["part_id"],
				"phase" 					=> "AS",
			];
			$progress_list[] = [
				"progress" 				=> (($value["er_fu"] * 40 / 100) + ($value["er_vs"] * 50 / 100) + ($value["er_ndt"] * 10 / 100)) + 0,
				"day" 						=> date("Y-m-d", strtotime($value["day"])),
				"project" 				=> $value["project"],
				"type_of_module" 	=> $value["type_of_module"],
				"discipline" 			=> $value["discipline"],
				"part_id" 				=> $value["part_id"],
				"phase" 					=> "ER",
			];
		}

		if ($level == "level_2") {
			$plan_list = $this->planning_mod->plan_measurement_list([
				"phase" => NULL,
				"discipline" => NULL,
				"type_of_module IS NOT NULL" => NULL,
			]);
			$progress_total = [];
			$plan_data = [];
			foreach ($weekly_date_chart as $week_date) {
				$progress = [];
				$progress_temp = [];
				foreach ($progress_list as $key => $value) {
					if ($week_date >= $value['day']) {
						@$progress_temp[$value['type_of_module']][$value['part_id']][$value['phase']] = $value['progress'];
					}
				}
				foreach ($progress_temp as $type_of_module => $prog_part_id) {
					if (is_array($prog_part_id)) {
						foreach ($prog_part_id as $part_id => $value) {
							@$progress[$type_of_module][$part_id] = ($value['FB'] * 0.4) + ($value['AS'] * 0.3) + ($value['ER'] * 0.3);
						}
					}
				}
				$progress_temp = $progress;
				$progress = [];
				foreach ($progress_temp as $type_of_module => $value) {
					$progress[$type_of_module] = @(@array_sum($value) / @count($value)) + 0;
					$progress[$type_of_module] = number_format($progress[$type_of_module], 2) + 0;
				}
				$progress_total[] = $progress;

				$cum = 0;
				foreach ($plan_list as $key => $value) {
					$week_end_days = new DateTime();
					$week_end_days->setISODate($value["year_week"], $value["week_no"]);
					$week_end_days = $week_end_days->format('Y-m-d');
					$week_end_days = date("Y-m-d", strtotime($week_end_days . " +6 days"));
					if ($week_end_days == $week_date && date("Y", strtotime($week_end_days)) == '2022') {
						$cum =  $value["plan_target"];
					}
				}
				@$plan_data[$value['type_of_module']][] = $cum;
			}
			// $last_p 		= @number_format($plan_data[$value['id']][2], 2) + 0;
			// test_var($plan_data);

			$table = [];
			foreach ($type_of_module_list as $key => $value) {
				$row = [];
				$row[] = "<td>" . $value["name"] . "</td>";

				$last_p 		= number_format((@$plan_data[$value['id']][1] - @$plan_data[$value['id']][2] + 0), 2, ".", "");
				$current_p 	= number_format((@$plan_data[$value['id']][0] - @$plan_data[$value['id']][1] + 0), 2, ".", "");
				$total_p 		= number_format((@$plan_data[$value['id']][0] + 0), 2, ".", "");
				$last_a 		= number_format((@$progress_total[1][$value['id']] - @$progress_total[2][$value['id']] + 0), 2, ".", "");
				$current_a 	= number_format((@$progress_total[0][$value['id']] - @$progress_total[1][$value['id']] + 0), 2, ".", "");
				$total_a 		= number_format((@$progress_total[0][$value['id']] + 0), 2, ".", "");

				$row[] = "<td>" . $last_p . "%</td>";
				$row[] = "<td>" . $last_a . "%</td>";
				$row[] = "<td>" . ($last_p < $last_a ? '0' : $last_p - $last_a) . "%</td>";

				$row[] = "<td>" . $current_p . "%</td>";
				$row[] = "<td>" . $current_a . "%</td>";
				$row[] = "<td>" . ($current_p < $current_a ? '0' : $current_p - $current_a) . "%</td>";

				$row[] = "<td>" . $total_p . "%</td>";
				$row[] = "<td>" . $total_a . "%</td>";
				$row[] = "<td>" . ($total_p < $total_a ? '0' : $total_p - $total_a) . "%</td>";

				$table[] = "<tr>" . join("", $row) . "</tr>";
			}
		} elseif ($level == "level_3") {
			$plan_list = $this->planning_mod->plan_measurement_list([
				"phase" => NULL,
				"discipline IS NOT NULL" => NULL,
				"type_of_module IS NOT NULL" => NULL,
			]);

			$progress_total = [];
			$plan_data = [];
			foreach ($weekly_date_chart as $week_date) {
				$progress = [];
				$progress_temp = [];
				foreach ($progress_list as $key => $value) {
					if ($week_date >= $value['day']) {
						@$progress_temp[$value['type_of_module']][$value['discipline']][$value['part_id']][$value['phase']] = $value['progress'];
					}
				}
				foreach ($progress_temp as $type_of_module => $prog_tom) {
					foreach ($prog_tom as $discipline => $prog_part_id) {
						if (is_array($prog_part_id)) {
							foreach ($prog_part_id as $part_id => $value) {
								@$progress[$type_of_module][$discipline][$part_id] = ($value['FB'] * 0.4) + ($value['AS'] * 0.3) + ($value['ER'] * 0.3);
							}
						}
					}
				}
				$progress_temp = $progress;
				$progress = [];
				foreach ($progress_temp as $type_of_module => $prog_tom) {
					foreach ($prog_tom as $discipline => $value) {
						$progress[$type_of_module][$discipline] = @(@array_sum($value) / @count($value)) + 0;
						$progress[$type_of_module][$discipline] = number_format($progress[$type_of_module][$discipline], 2) + 0;
					}
				}
				$progress_total[] = $progress;

				$cum = [];
				foreach ($plan_list as $key => $value) {
					$week_end_days = new DateTime();
					$week_end_days->setISODate($value["year_week"], $value["week_no"]);
					$week_end_days = $week_end_days->format('Y-m-d');
					$week_end_days = date("Y-m-d", strtotime($week_end_days . " +6 days"));
					if ($week_end_days == $week_date && date("Y", strtotime($week_end_days)) == '2022') {
						@$cum[$value['type_of_module'] . "|" . $value['discipline']] =  $value["plan_target"] + 0;
					}
				}
				foreach ($cum as $key => $value) {
					$key_arr = explode("|", $key);
					$plan_data[$key_arr[0]][$key_arr[1]][] = $value;
				}
			}

			$table = [];
			foreach ($type_of_module_list as $key => $tom) {
				foreach ($discipline_list as $key => $dis) {
					$row = [];
					$row[] = "<td>" . $tom["name"] . "</td>";
					$row[] = "<td>" . $dis["discipline_name"] . "</td>";

					$last_p 		= number_format((@$plan_data[$tom['id']][$dis['id']][1] - @$plan_data[$tom['id']][$dis['id']][2] + 0), 2, ".", "");
					$current_p 	= number_format((@$plan_data[$tom['id']][$dis['id']][0] - @$plan_data[$tom['id']][$dis['id']][1] + 0), 2, ".", "");
					$total_p 		= number_format((@$plan_data[$tom['id']][$dis['id']][0] + 0), 2, ".", "");

					$last_a 		= number_format((@$progress_total[1][$tom['id']][$dis['id']] - @$progress_total[2][$tom['id']][$dis['id']] + 0), 2, ".", "");
					$current_a 	= number_format((@$progress_total[0][$tom['id']][$dis['id']] - @$progress_total[1][$tom['id']][$dis['id']] + 0), 2, ".", "");
					$total_a 		= number_format((@$progress_total[0][$tom['id']][$dis['id']] + 0), 2, ".", "");

					$row[] = "<td>" . $last_p . "%</td>";
					$row[] = "<td>" . $last_a . "%</td>";
					$row[] = "<td>" . ($last_p < $last_a ? '0' : $last_p - $last_a) . "%</td>";

					$row[] = "<td>" . $current_p . "%</td>";
					$row[] = "<td>" . $current_a . "%</td>";
					$row[] = "<td>" . ($current_p < $current_a ? '0' : $current_p - $current_a) . "%</td>";

					$row[] = "<td>" . $total_p . "%</td>";
					$row[] = "<td>" . $total_a . "%</td>";
					$row[] = "<td>" . ($total_p < $total_a ? '0' : $total_p - $total_a) . "%</td>";

					$table[] = "<tr>" . join("", $row) . "</tr>";
				}
			}
		} elseif ($level == "level_4") {
			$plan_list = $this->planning_mod->plan_measurement_list([
				"phase IS NOT NULL" => NULL,
				"discipline IS NOT NULL" => NULL,
				"type_of_module IS NOT NULL" => NULL,
			]);
			$progress_total = [];
			$plan_data = [];
			foreach ($weekly_date_chart as $week_date) {
				$progress = [];
				$progress_temp = [];
				foreach ($progress_list as $key => $value) {
					if ($week_date >= $value['day']) {
						@$progress_temp[$value['type_of_module']][$value['discipline']][$value['phase']][$value['part_id']] = $value['progress'];
					}
				}
				foreach ($progress_temp as $type_of_module => $prog_tom) {
					foreach ($prog_tom as $discipline => $prog_pha) {
						foreach ($prog_pha as $phase => $value) {
							$progress[$type_of_module][$discipline][$phase] = @(@array_sum($value) / @count($value)) + 0;
							$progress[$type_of_module][$discipline][$phase] = number_format($progress[$type_of_module][$discipline][$phase], 2) + 0;
						}
					}
				}
				$progress_total[] = $progress;

				$cum = [];
				foreach ($plan_list as $key => $value) {
					$week_end_days = new DateTime();
					$week_end_days->setISODate($value["year_week"], $value["week_no"]);
					$week_end_days = $week_end_days->format('Y-m-d');
					$week_end_days = date("Y-m-d", strtotime($week_end_days . " +6 days"));
					if ($week_end_days == $week_date && date("Y", strtotime($week_end_days)) == '2022') {
						@$cum[$value['type_of_module'] . "|" . $value['discipline'] . "|" . $value['phase']] =  $value["plan_target"] + 0;
					}
				}
				foreach ($cum as $key => $value) {
					$key_arr = explode("|", $key);
					$plan_data[$key_arr[0]][$key_arr[1]][$key_arr[2]][] = $value;
				}
			}

			$table = [];
			foreach ($type_of_module_list as $key => $tom) {
				foreach ($discipline_list as $key => $dis) {
					if (isset($phase_list[$dis['id']])) {
						foreach ($phase_list[$dis['id']] as $key => $pha) {
							$row = [];
							$row[] = "<td>" . $tom["name"] . "</td>";
							$row[] = "<td>" . $dis["discipline_name"] . "</td>";
							$row[] = "<td>" . $pha["phase_name"] . "</td>";

							$last_p 		= number_format((@$plan_data[$tom['id']][$dis['id']][$pha['phase_code']][1] - @$plan_data[$tom['id']][$dis['id']][$pha['phase_code']][2] + 0), 2, ".", "");
							$current_p 	= number_format((@$plan_data[$tom['id']][$dis['id']][$pha['phase_code']][0] - @$plan_data[$tom['id']][$dis['id']][$pha['phase_code']][1] + 0), 2, ".", "");
							$total_p 		= number_format((@$plan_data[$tom['id']][$dis['id']][$pha['phase_code']][0] + 0), 2, ".", "");
							$last_a 		= number_format((@$progress_total[1][$tom['id']][$dis['id']][$pha['phase_code']] - @$progress_total[2][$tom['id']][$dis['id']][$pha['phase_code']] + 0), 2, ".", "");
							$current_a 	= number_format((@$progress_total[0][$tom['id']][$dis['id']][$pha['phase_code']] - @$progress_total[1][$tom['id']][$dis['id']][$pha['phase_code']] + 0), 2, ".", "");
							$total_a 		= number_format((@$progress_total[0][$tom['id']][$dis['id']][$pha['phase_code']] + 0), 2, ".", "");

							$row[] = "<td>" . $last_p . "%</td>";
							$row[] = "<td>" . $last_a . "%</td>";
							$row[] = "<td>" . ($last_p < $last_a ? '0' : $last_p - $last_a) . "%</td>";

							$row[] = "<td>" . $current_p . "%</td>";
							$row[] = "<td>" . $current_a . "%</td>";
							$row[] = "<td>" . ($current_p < $current_a ? '0' : $current_p - $current_a) . "%</td>";

							$row[] = "<td>" . $total_p . "%</td>";
							$row[] = "<td>" . $total_a . "%</td>";
							$row[] = "<td>" . ($total_p < $total_a ? '0' : $total_p - $total_a) . "%</td>";

							$table[] = "<tr>" . join("", $row) . "</tr>";
						}
					}
				}
			}
		}
		echo join("", $table);
	}

	public function home()
	{
		redirect('home/home_new');
		// error_reporting(0);
		if (isset($_GET)) {
			$data['get'] = $_GET;
			if ($_GET['desc_assy'] > 0) {
				test_var('level 7');
			} elseif ($_GET['phase'] > 0) {
				test_var('level 6');
			} elseif ($_GET['deck_elevation'] > 0) {
				redirect('home/home_level_5?project=' . $_GET['project'] . '&module=' . $_GET['module'] . '&type_of_module=' . $_GET['type_of_module'] . '&discipline=' . $_GET['discipline'] . '&deck_elevation=' . $_GET['deck_elevation'] . '&phase=' . $_GET['phase'] . '&desc_assy=' . $_GET['desc_assy'] . '&submit=search#');
			} elseif ($_GET['discipline'] > 0) {
				$data['master_deck'] 	= $this->general_mod->deck_elevation();
				$data['total_row']  	= (int)(COUNT($data['master_deck']) / 2);
				$data['level'] = 4;

				$where_m['project'] 		= $_GET['project'];
				$where_m['discipline'] 		= $_GET['discipline'];
				$where_m['module'] 			= $_GET['module'];
				$where_m['type_of_module'] 	= $_GET['type_of_module'];
				$data_pc = $this->general_mod->master_calculation($where_m);

				foreach ($data_pc as $data_pc) {
					$piecemarks[$data_pc['deck_elevation']][] = $data_pc['id_pc'];
				}

				foreach ($piecemarks as $key_de => $piecemark) {
					$where_summ["id_temp_pc IN ('" . implode("','", array_unique($piecemark)) . "')"] = NULL;
					$where_summ["status_delete"] = 1;
					$data['summ'][$key_de] = $this->general_mod->summary_total_level_3($where_summ)[0];
				}
				// test_var($data['summ']);
				foreach ($data['summ'] as $key => $value_sum) {
					if ($_GET['discipline'] == 2) {

						$data['percent'] = [15, 30, 45, 10, 40, 50, 10, 40, 50, 10];

						$sum[$key]['fb']['mv'] = is_nan($value_sum['pf_mv'] / $value_sum['pf_mv_tot']) ? 0 : round(($value_sum['pf_mv'] / $value_sum['pf_mv_tot']) * 15 / 100, 2);
						$sum[$key]['fb']['fu'] = is_nan($value_sum['f_fu'] / $value_sum['f_fu_tot']) ? 0 : round(($value_sum['f_fu'] / $value_sum['f_fu_tot']) * 30 / 100, 2);
						$sum[$key]['fb']['vs'] = is_nan($value_sum['f_vs'] / $value_sum['f_vs_tot']) ? 0 : round(($value_sum['f_vs'] / $value_sum['f_vs_tot']) * 45 / 100, 2);
						$sum[$key]['fb']['ndt'] = is_nan($value_sum['f_ndt'] / $value_sum['f_ndt_tot']) ? 0 : round(($value_sum['f_ndt'] / $value_sum['f_ndt_tot']) * 10 / 100, 2);
						$sum[$key]['fb']['na'] = 100 - ($sum[$key]['fb']['mv'] + $sum[$key]['fb']['fu'] + $sum[$key]['fb']['vs'] + $sum[$key]['fb']['ndt']);

						$sum[$key]['as']['fu'] = is_nan($value_sum['as_fu'] / $value_sum['as_fu_tot']) ? 0 : round(($value_sum['as_fu'] / $value_sum['as_fu_tot']) * 40 / 100, 2);
						$sum[$key]['as']['vs'] = is_nan($value_sum['as_vs'] / $value_sum['as_vs_tot']) ? 0 : round(($value_sum['as_vs'] / $value_sum['as_vs_tot']) * 50 / 100, 2);
						$sum[$key]['as']['ndt'] = is_nan($value_sum['as_ndt'] / $value_sum['as_ndt_tot']) ? 0 : round(($value_sum['as_ndt'] / $value_sum['as_ndt_tot']) * 10 / 100, 2);
						$sum[$key]['as']['na'] = 100 - ($sum[$key]['as']['fu'] + $sum[$key]['as']['vs'] + $sum[$key]['as']['ndt']);

						$sum[$key]['er']['fu'] = is_nan($value_sum['er_fu'] / $value_sum['er_fu_tot']) ? 0 : round(($value_sum['er_fu'] / $value_sum['er_fu_tot']) * 40 / 100, 2);
						$sum[$key]['er']['vs'] = is_nan($value_sum['er_vs'] / $value_sum['er_vs_tot']) ? 0 : round(($value_sum['er_vs'] / $value_sum['er_vs_tot']) * 50 / 100, 2);
						$sum[$key]['er']['ndt'] = is_nan($value_sum['er_ndt'] / $value_sum['er_ndt_tot']) ? 0 : round(($value_sum['er_ndt'] / $value_sum['er_ndt_tot']) * 10 / 100, 2);
						$sum[$key]['er']['na'] = 100 - ($sum[$key]['er']['fu'] + $sum[$key]['er']['vs'] + $sum[$key]['er']['ndt']);
					} elseif ($_GET['discipline'] == 1) {

						$data['percent'] = [20, 25, 45, 10, 'N/A', 'N/A', 'N/A', 60, 30, 10];

						$sum[$key]['fb']['mv'] = is_nan($value_sum['pf_mv'] / $value_sum['pf_mv_tot']) ? 0 : round(($value_sum['pf_mv'] / $value_sum['pf_mv_tot']) * 20 / 100, 2);
						$sum[$key]['fb']['fu'] = is_nan($value_sum['f_fu'] / $value_sum['f_fu_tot']) ? 0 : round(($value_sum['f_fu'] / $value_sum['f_fu_tot']) * 25 / 100, 2);
						$sum[$key]['fb']['vs'] = is_nan($value_sum['f_vs'] / $value_sum['f_vs_tot']) ? 0 : round(($value_sum['f_vs'] / $value_sum['f_vs_tot']) * 45 / 100, 2);
						$sum[$key]['fb']['ndt'] = is_nan($value_sum['f_ndt'] / $value_sum['f_ndt_tot']) ? 0 : round(($value_sum['f_ndt'] / $value_sum['f_ndt_tot']) * 10 / 100, 2);
						$sum[$key]['fb']['na'] = 100 - ($sum[$key]['fb']['mv'] + $sum[$key]['fb']['fu'] + $sum[$key]['fb']['vs'] + $sum[$key]['fb']['ndt']);

						$sum[$key]['er']['fu'] = is_nan($value_sum['er_fu'] / $value_sum['er_fu_tot']) ? 0 : round(($value_sum['er_fu'] / $value_sum['er_fu_tot']) * 60 / 100, 2);
						$sum[$key]['er']['vs'] = is_nan($value_sum['er_vs'] / $value_sum['er_vs_tot']) ? 0 : round(($value_sum['er_vs'] / $value_sum['er_vs_tot']) * 30 / 100, 2);
						$sum[$key]['er']['ndt'] = is_nan($value_sum['er_ndt'] / $value_sum['er_ndt_tot']) ? 0 : round(($value_sum['er_ndt'] / $value_sum['er_ndt_tot']) * 10 / 100, 2);
						$sum[$key]['er']['na'] = 100 - ($sum[$key]['er']['fu'] + $sum[$key]['er']['vs'] + $sum[$key]['er']['ndt']);
					}
				}

				$data['summary'] = $sum;
				// test_var($data['sum']);

			} elseif ($_GET['type_of_module'] > 0) {

				$data['master_discipline'] 	= $this->general_mod->eng_discipline_get_db();
				$data['level'] = 3;

				$where_m['project'] 		= $_GET['project'];
				$where_m['module'] 			= $_GET['module'];
				$where_m['type_of_module'] 	= $_GET['type_of_module'];
				$data_pc = $this->general_mod->pcms_piecemark($where_m);
				// test_var($data_pc);
				foreach ($data_pc as $data_pc) {
					$piecemarks[$data_pc['discipline']][] = $data_pc['id'];
				}
				// test_var(array_unique($piecemarks));
				foreach ($piecemarks as $key_discipline => $piecemark) {
					$where_summ["id_temp_pc IN ('" . implode("','", array_unique($piecemark)) . "')"] = NULL;
					$where_summ["status_delete"] = 1;
					$data['summ'][$key_discipline] = $this->general_mod->summary_total_level_3($where_summ)[0];
				}
				//test_var($data['summ']);
				foreach ($data['summ'] as $key => $value_sum) {
					// test_var($key);
					if ($key == 2) {

						$sum[$key]['fb']['sum_v'] = $value_sum['f_vs'];
						$sum[$key]['fb']['tot_v'] = $value_sum['f_vs_tot'];

						$sum[$key]['fb']['mv'] = is_nan($value_sum['pf_mv'] / $value_sum['pf_mv_tot']) ? 0 : round(($value_sum['pf_mv'] / $value_sum['pf_mv_tot']) * 15 / 100, 2);
						$sum[$key]['fb']['fu'] = is_nan($value_sum['f_fu'] / $value_sum['f_fu_tot']) ? 0 : round(($value_sum['f_fu'] / $value_sum['f_fu_tot']) * 30 / 100, 2);
						$sum[$key]['fb']['vs'] = is_nan($value_sum['f_vs'] / $value_sum['f_vs_tot']) ? 0 : round(($value_sum['f_vs'] / $value_sum['f_vs_tot']) * 45 / 100, 2);
						$sum[$key]['fb']['ndt'] = is_nan($value_sum['f_ndt'] / $value_sum['f_ndt_tot']) ? 0 : round(($value_sum['f_ndt'] / $value_sum['f_ndt_tot']) * 10 / 100, 2);
						$sum[$key]['fb']['na'] = 100 - ($sum[$key]['fb']['mv'] + $sum[$key]['fb']['fu'] + $sum[$key]['fb']['vs'] + $sum[$key]['fb']['ndt']);

						$sum[$key]['as']['fu'] = is_nan($value_sum['as_fu'] / $value_sum['as_fu_tot']) ? 0 : round(($value_sum['as_fu'] / $value_sum['as_fu_tot']) * 40 / 100, 2);
						$sum[$key]['as']['vs'] = is_nan($value_sum['as_vs'] / $value_sum['as_vs_tot']) ? 0 : round(($value_sum['as_vs'] / $value_sum['as_vs_tot']) * 50 / 100, 2);
						$sum[$key]['as']['ndt'] = is_nan($value_sum['as_ndt'] / $value_sum['as_ndt_tot']) ? 0 : round(($value_sum['as_ndt'] / $value_sum['as_ndt_tot']) * 10 / 100, 2);
						$sum[$key]['as']['na'] = 100 - ($sum[$key]['as']['fu'] + $sum[$key]['as']['vs'] + $sum[$key]['as']['ndt']);

						$sum[$key]['er']['fu'] = is_nan($value_sum['er_fu'] / $value_sum['er_fu_tot']) ? 0 : round(($value_sum['er_fu'] / $value_sum['er_fu_tot']) * 40 / 100, 2);
						$sum[$key]['er']['vs'] = is_nan($value_sum['er_vs'] / $value_sum['er_vs_tot']) ? 0 : round(($value_sum['er_vs'] / $value_sum['er_vs_tot']) * 50 / 100, 2);
						$sum[$key]['er']['ndt'] = is_nan($value_sum['er_ndt'] / $value_sum['er_ndt_tot']) ? 0 : round(($value_sum['er_ndt'] / $value_sum['er_ndt_tot']) * 10 / 100, 2);
						$sum[$key]['er']['na'] = 100 - ($sum[$key]['er']['fu'] + $sum[$key]['er']['vs'] + $sum[$key]['er']['ndt']);
					} elseif ($key == 1) {

						$sum[$key]['fb']['mv'] = is_nan($value_sum['pf_mv'] / $value_sum['pf_mv_tot']) ? 0 : round(($value_sum['pf_mv'] / $value_sum['pf_mv_tot']) * 20 / 100, 2);
						$sum[$key]['fb']['fu'] = is_nan($value_sum['f_fu'] / $value_sum['f_fu_tot']) ? 0 : round(($value_sum['f_fu'] / $value_sum['f_fu_tot']) * 25 / 100, 2);
						$sum[$key]['fb']['vs'] = is_nan($value_sum['f_vs'] / $value_sum['f_vs_tot']) ? 0 : round(($value_sum['f_vs'] / $value_sum['f_vs_tot']) * 45 / 100, 2);
						$sum[$key]['fb']['ndt'] = is_nan($value_sum['f_ndt'] / $value_sum['f_ndt_tot']) ? 0 : round(($value_sum['f_ndt'] / $value_sum['f_ndt_tot']) * 10 / 100, 2);
						$sum[$key]['fb']['na'] = 100 - ($sum[$key]['fb']['mv'] + $sum[$key]['fb']['fu'] + $sum[$key]['fb']['vs'] + $sum[$key]['fb']['ndt']);

						$sum[$key]['er']['fu'] = is_nan($value_sum['er_fu'] / $value_sum['er_fu_tot']) ? 0 : round(($value_sum['er_fu'] / $value_sum['er_fu_tot']) * 60 / 100, 2);
						$sum[$key]['er']['vs'] = is_nan($value_sum['er_vs'] / $value_sum['er_vs_tot']) ? 0 : round(($value_sum['er_vs'] / $value_sum['er_vs_tot']) * 30 / 100, 2);
						$sum[$key]['er']['ndt'] = is_nan($value_sum['er_ndt'] / $value_sum['er_ndt_tot']) ? 0 : round(($value_sum['er_ndt'] / $value_sum['er_ndt_tot']) * 10 / 100, 2);
						$sum[$key]['er']['na'] = 100 - ($sum[$key]['er']['fu'] + $sum[$key]['er']['vs'] + $sum[$key]['er']['ndt']);
					}
				}

				$data['level_3'] = $sum;
				// test_var($data['level_3']);
			} elseif ($_GET['module'] > 0) {
				redirect('home/home_level_5?project=' . $_GET['project'] . '&module=' . $_GET['module'] . '&type_of_module=' . $_GET['type_of_module'] . '&discipline=' . $_GET['discipline'] . '&deck_elevation=' . $_GET['deck_elevation'] . '&phase=' . $_GET['phase'] . '&desc_assy=' . $_GET['desc_assy'] . '&submit=search#');
			} elseif ($_GET['project'] > 0) {
				$data['level'] = 1;

				$where_m['project'] 		= $_GET['project'];
				$data_pc = $this->general_mod->pcms_piecemark($where_m);
				// test_var($data_pc);
				foreach ($data_pc as $data_pc) {
					$piecemarks[$data_pc['discipline']][] = $data_pc['id'];
				}

				// test_var($piecemarks);

				// ==================== STR
				if (!isset($piecemarks[2])) {
					$piecemarks[2] = [0];
				}
				$where_summ_str["id_temp_pc IN ('" . implode("','", array_unique($piecemarks[2])) . "')"] = NULL;
				$value_sum_str = $this->general_mod->summary_total_level_3($where_summ_str)[0];
				// test_var($value_sum_str);
				$sum[2]['fb']['mv'] = is_nan($value_sum_str['pf_mv'] / $value_sum_str['total']) ? 0 : round(($value_sum_str['pf_mv'] / $value_sum_str['total']) * 15 / 100, 2);
				$sum[2]['fb']['fu'] = is_nan($value_sum_str['f_fu'] / $value_sum_str['total']) ? 0 : round(($value_sum_str['f_fu'] / $value_sum_str['total']) * 30 / 100, 2);
				$sum[2]['fb']['vs'] = is_nan($value_sum_str['f_vs'] / $value_sum_str['total']) ? 0 : round(($value_sum_str['f_vs'] / $value_sum_str['total']) * 45 / 100, 2);
				$sum[2]['fb']['ndt'] = is_nan($value_sum_str['f_ndt'] / $value_sum_str['total']) ? 0 : round(($value_sum_str['f_ndt'] / $value_sum_str['total']) * 10 / 100, 2);

				$sum[2]['as']['fu'] = is_nan($value_sum_str['as_fu'] / $value_sum_str['total']) ? 0 : round(($value_sum_str['as_fu'] / $value_sum_str['total']) * 40 / 100, 2);
				$sum[2]['as']['vs'] = is_nan($value_sum_str['as_vs'] / $value_sum_str['total']) ? 0 : round(($value_sum_str['as_vs'] / $value_sum_str['total']) * 50 / 100, 2);
				$sum[2]['as']['ndt'] = is_nan($value_sum_str['as_ndt'] / $value_sum_str['total']) ? 0 : round(($value_sum_str['as_ndt'] / $value_sum_str['total']) * 10 / 100, 2);

				$sum[2]['er']['fu'] = is_nan($value_sum_str['er_fu'] / $value_sum_str['total']) ? 0 : round(($value_sum_str['er_fu'] / $value_sum_str['total']) * 40 / 100, 2);
				$sum[2]['er']['vs'] = is_nan($value_sum_str['er_vs'] / $value_sum_str['total']) ? 0 : round(($value_sum_str['er_vs'] / $value_sum_str['total']) * 50 / 100, 2);
				$sum[2]['er']['ndt'] = is_nan($value_sum_str['er_ndt'] / $value_sum_str['total']) ? 0 : round(($value_sum_str['er_ndt'] / $value_sum_str['total']) * 10 / 100, 2);

				// ==================== PIP
				if (!isset($piecemarks[1])) {
					$piecemarks[1] = [0];
				}
				// test_var($piecemarks), 2);
				$where_summ_pip["id_temp_pc IN ('" . implode("','", array_unique($piecemarks[1])) . "')"] = NULL;
				$value_sum_pip = $this->general_mod->summary_total_level_3($where_summ_pip)[0];
				// test_var($value_sum_pip), 2);
				$sum[1]['fb']['mv'] = is_nan($value_sum_pip['pf_mv'] / $value_sum_pip['pf_mv_tot']) ? 0 : round(($value_sum_pip['pf_mv'] / $value_sum_pip['pf_mv_tot']) * 20 / 100, 2);
				$sum[1]['fb']['fu'] = is_nan($value_sum_pip['f_fu'] / $value_sum_pip['f_fu_tot']) ? 0 : round(($value_sum_pip['f_fu'] / $value_sum_pip['f_fu_tot']) * 25 / 100, 2);
				$sum[1]['fb']['vs'] = is_nan($value_sum_pip['f_vs'] / $value_sum_pip['f_vs_tot']) ? 0 : round(($value_sum_pip['f_vs'] / $value_sum_pip['f_vs_tot']) * 45 / 100, 2);
				$sum[1]['fb']['ndt'] = is_nan($value_sum_pip['f_ndt'] / $value_sum_pip['f_ndt_tot']) ? 0 : round(($value_sum_pip['f_ndt'] / $value_sum_pip['f_ndt_tot']) * 10 / 100, 2);

				$sum[1]['er']['fu'] = is_nan($value_sum_pip['er_fu'] / $value_sum_pip['er_fu_tot']) ? 0 : round(($value_sum_pip['er_fu'] / $value_sum_pip['er_fu_tot']) * 60 / 100, 2);
				$sum[1]['er']['vs'] = is_nan($value_sum_pip['er_vs'] / $value_sum_pip['er_vs_tot']) ? 0 : round(($value_sum_pip['er_vs'] / $value_sum_pip['er_vs_tot']) * 30 / 100, 2);
				$sum[1]['er']['ndt'] = is_nan($value_sum_pip['er_ndt'] / $value_sum_pip['er_ndt_tot']) ? 0 : round(($value_sum_pip['er_ndt'] / $value_sum_pip['er_ndt_tot']) * 10 / 100, 2);

				// test_var($sum);
				$data['level_1'] = $sum;
			}
		} else {

			test_var('Try Again');
		}

		$datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['project_code']] = $value;
		}
		$data['project_list'] = $project_list;

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['initial']] = $value;
		}
		$data['discipline_list'] = $discipline_list;

		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['mod_id']] = $value;
		}
		$data['module_list'] = $module_list;

		$datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['project_code']] = $value;
		}
		$data['project_list'] = $project_list;

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
		}
		$data['type_of_module_list'] = $type_of_module_list;

		$datadb = $this->general_mod->deck_elevation();
		$deck_elevation_list = [];
		foreach ($datadb as $key => $value) {
			$deck_elevation_list[$value['code']] = $value;
		}
		$data['deck_elevation_list'] = $deck_elevation_list;

		$datadb = $this->general_mod->desc_assy();
		$desc_assy_list = [];
		foreach ($datadb as $key => $value) {
			$desc_assy_list[$value['code']] = $value;
		}
		$data['desc_assy_list'] = $desc_assy_list;

		$data['meta_title']  	 		= 'Home';
		$data['subview']     	 		= 'home/home';
		$data['user_permission'] 		= $this->permission_cookie;

		$this->load->view('index', $data);
	}

	public function get_drawing_as_ajax()
	{
		// error_reporting(0);
		if ($this->input->post('search') and !empty($this->input->post('search'))) {
			$where["drawing_as ILIKE '%" . $this->input->post('search') . "%'"] = null;
		} else {
			// $where["drawing_as"] = null;
		}
		$data_as = $this->general_mod->drawing_as($where);
		if (sizeof($data_as) > 0) {
			foreach ($data_as as $row) {
				$option_data = array('id' => $row['drawing_as'], 'text' => $row['drawing_as']);
				$arr_result[] = $option_data;
			}
			echo json_encode($arr_result);
		} else {
			$arr_result[] = "Error : Data Not Found";
		}
	}


	public function home_level_5()
	{
		// error_reporting(0);
		$data['filter'] = $this->input->get();
		// test_var($data);
		$datadb = $this->general_mod->project();
		$project_list = [];
		$project_list_data = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['project_code']] = $value;
			$project_list_data[$value['project_code']] = $value;
		}
		$data['project_list'] = $project_list;
		$data['project_list_data'] = $project_list_data;

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		$discipline_list_data = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['initial']] = $value;
			$discipline_list_data[$value['id']] = $value;
		}
		$data['discipline_list'] = $discipline_list;
		$data['discipline_list_data'] = $discipline_list_data;

		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['mod_id']] = $value;
		}
		$data['module_list'] = $module_list;

		$datadb = $this->general_mod->project();
		$project_list = [];
		$project_list_data = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['project_code']] = $value;
			$project_list_data[$value['id']] = $value;
		}
		$data['project_list'] = $project_list;
		$data['project_list_data'] = $project_list_data;

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		$type_of_module_list_data = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
			$type_of_module_list_data[$value['id']] = $value;
		}
		$data['type_of_module_list'] = $type_of_module_list;
		$data['type_of_module_list_data'] = $type_of_module_list_data;
		// test_var($data['type_of_module_list']);
		$datadb = $this->general_mod->deck_elevation();
		// test_var($datadb);
		$deck_elevation_list = [];
		$deck_elevation_list_data = [];
		foreach ($datadb as $key => $value) {
			$deck_elevation_list[$value['code']] = $value;
			$deck_elevation_list_data[$value['id']] = $value;
		}
		// test_var($datadb);
		$data['deck_elevation_list'] 	  = $deck_elevation_list;
		$data['deck_elevation_list_data'] = $deck_elevation_list_data;

		$datadb = $this->general_mod->desc_assy();
		$desc_assy_list = [];
		$desc_assy_list_data = [];
		foreach ($datadb as $key => $value) {
			$desc_assy_list[$value['code']] = $value;
			$desc_assy_list_data[$value['id']] = $value;
		}
		$data['desc_assy_list'] = $desc_assy_list;
		$data['desc_assy_list_data'] = $desc_assy_list_data;


		if (strlen($_GET['drawing_as']) > 0) {
			$where['b.drawing_as'] = $_GET['drawing_as'];
			$where['b.deck_elevation'] = $_GET['deck_elevation'];
			$where['c.phase'] = $_GET['phase'];
			$where['b.discipline'] = $_GET['discipline'];
			$where['b.type_of_module'] = $_GET['type_of_module'];
			$where['b.project'] = $_GET['project'];

			$data['level'] = 6;
			$group_by = "b.project, b.type_of_module, b.discipline, c.phase, b.deck_elevation, b.drawing_as, part_id";
			$select   = "
				count(b.project) as total_data,
				max(b.project) as project,
				max(b.module) as module,
				max(b.type_of_module) as type_of_module,
				max(b.discipline) as discipline,
				max(b.deck_elevation) as deck_elevation,
				max(b.drawing_as) as drawing_as,
				max(b.description_assy) as description_assy,
				max(part_id) as part_id,
				MAX(phase) as phase,
				SUM(pf_mv) as pf_mv,
				SUM(f_fu) as f_fu,
				SUM(f_vs) as f_vs,
				SUM(f_ndt) as f_ndt,
				SUM(as_fu) as as_fu,
				SUM(as_vs) as as_vs,
				SUM(as_ndt) as as_ndt,
				SUM(er_fu) as er_fu,
				SUM(er_vs) as er_vs,
				SUM(er_ndt) as er_ndt,
				MAX(DATE_PART('week',date_of_progress)) as week
			";
		} elseif (strlen($_GET['deck_elevation']) > 0) {
			$where['b.deck_elevation'] = $_GET['deck_elevation'];
			$where['c.phase'] = $_GET['phase'];
			$where['b.discipline'] = $_GET['discipline'];
			$where['b.type_of_module'] = $_GET['type_of_module'];
			$where['b.project'] = $_GET['project'];

			$data['level'] = 5;
			$group_by = "b.project, b.type_of_module, b.discipline, c.phase, b.deck_elevation, b.drawing_as";
			$select   = "
				count(b.project) as total_data,
				max(b.project) as project,
				max(b.module) as module,
				max(b.type_of_module) as type_of_module,
				max(b.discipline) as discipline,
				max(b.deck_elevation) as deck_elevation,
				max(b.drawing_as) as drawing_as,
				max(b.description_assy) as description_assy,
				max(part_id) as part_id,
				MAX(phase) as phase,
				SUM(pf_mv) as pf_mv,
				SUM(f_fu) as f_fu,
				SUM(f_vs) as f_vs,
				SUM(f_ndt) as f_ndt,
				SUM(as_fu) as as_fu,
				SUM(as_vs) as as_vs,
				SUM(as_ndt) as as_ndt,
				SUM(er_fu) as er_fu,
				SUM(er_vs) as er_vs,
				SUM(er_ndt) as er_ndt,
				MAX(DATE_PART('week',date_of_progress)) as week
			";
		} elseif (strlen($_GET['phase']) > 0) {
			$where['c.phase'] = $_GET['phase'];
			$where['b.discipline'] = $_GET['discipline'];
			$where['b.type_of_module'] = $_GET['type_of_module'];
			$where['b.project'] = $_GET['project'];

			$data['level'] = 4;
			$group_by = "b.project, b.type_of_module, b.discipline, c.phase, b.deck_elevation";
			$select   = "
				count(b.project) as total_data,
				max(b.project) as project,
				max(b.module) as module,
				max(b.type_of_module) as type_of_module,
				max(b.discipline) as discipline,
				max(b.deck_elevation) as deck_elevation,
				max(b.drawing_as) as drawing_as,
				max(b.description_assy) as description_assy,
				max(part_id) as part_id,
				MAX(phase) as phase,
				SUM(pf_mv) as pf_mv,
				SUM(f_fu) as f_fu,
				SUM(f_vs) as f_vs,
				SUM(f_ndt) as f_ndt,
				SUM(as_fu) as as_fu,
				SUM(as_vs) as as_vs,
				SUM(as_ndt) as as_ndt,
				SUM(er_fu) as er_fu,
				SUM(er_vs) as er_vs,
				SUM(er_ndt) as er_ndt,
				MAX(DATE_PART('week',date_of_progress)) as week
			";
		} elseif (strlen($_GET['discipline']) > 0) {
			$where['b.discipline'] = $_GET['discipline'];
			$where['b.type_of_module'] = $_GET['type_of_module'];
			$where['b.project'] = $_GET['project'];

			$data['level'] = 3;
			$group_by = "b.project, b.type_of_module, c.phase, b.discipline";
			$select   = "
				count(b.project) as total_data,
				max(b.project) as project,
				max(b.module) as module,
				max(b.type_of_module) as type_of_module,
				max(b.discipline) as discipline,
				max(b.deck_elevation) as deck_elevation,
				max(b.drawing_as) as drawing_as,
				max(b.description_assy) as description_assy,
				max(part_id) as part_id,
				MAX(phase) as phase,
				SUM(pf_mv) as pf_mv,
				SUM(f_fu) as f_fu,
				SUM(f_vs) as f_vs,
				SUM(f_ndt) as f_ndt,
				SUM(as_fu) as as_fu,
				SUM(as_vs) as as_vs,
				SUM(as_ndt) as as_ndt,
				SUM(er_fu) as er_fu,
				SUM(er_vs) as er_vs,
				SUM(er_ndt) as er_ndt,
				MAX(DATE_PART('week',date_of_progress)) as week
			";
		} elseif (strlen($_GET['type_of_module']) > 0) {
			$where['b.type_of_module'] = $_GET['type_of_module'];
			$where['b.project'] = $_GET['project'];

			$data['level'] = 2;
			$group_by = "b.project, b.type_of_module";
			$select   = "
				count(b.project) as total_data,
				max(b.project) as project,
				max(b.module) as module,
				max(b.type_of_module) as type_of_module,
				max(b.discipline) as discipline,
				max(b.deck_elevation) as deck_elevation,
				max(b.drawing_as) as drawing_as,
				max(b.description_assy) as description_assy,
				max(part_id) as part_id,
				MAX(phase) as phase,
				SUM(pf_mv) as pf_mv,
				SUM(f_fu) as f_fu,
				SUM(f_vs) as f_vs,
				SUM(f_ndt) as f_ndt,
				SUM(as_fu) as as_fu,
				SUM(as_vs) as as_vs,
				SUM(as_ndt) as as_ndt,
				SUM(er_fu) as er_fu,
				SUM(er_vs) as er_vs,
				SUM(er_ndt) as er_ndt,
				MAX(DATE_PART('week',date_of_progress)) as week
			";
		} else {
			if ($_GET['project']) {
				$where['b.project'] = $_GET['project'];
			} else {
				$where['b.project'] = $this->user_cookie[10];
			}


			$data['level'] = 1;
			$group_by = "b.project, b.type_of_module";
			$select   = "
				count(b.project) as total_data,
				max(b.project) as project,
				max(b.module) as module,
				max(b.type_of_module) as type_of_module,
				max(b.discipline) as discipline,
				max(b.deck_elevation) as deck_elevation,
				max(b.drawing_as) as drawing_as,
				max(b.description_assy) as description_assy,
				max(part_id) as part_id,
				MAX(phase) as phase,
				SUM(pf_mv) as pf_mv,
				SUM(f_fu) as f_fu,
				SUM(f_vs) as f_vs,
				SUM(f_ndt) as f_ndt,
				SUM(as_fu) as as_fu,
				SUM(as_vs) as as_vs,
				SUM(as_ndt) as as_ndt,
				SUM(er_fu) as er_fu,
				SUM(er_vs) as er_vs,
				SUM(er_ndt) as er_ndt,
				MAX(DATE_PART('week',date_of_progress)) as week
			";
		}

		$where['a.status_delete']  	  = "1";
		$data['pcms_summary'] =  $this->home_mod->search_looping_master_summary($where, $group_by, $select);


		if (isset($data['filter']["project"]) and $data['filter']["project"] != "") {
			$where_l_7['b.project'] = $data['filter']["project"];
			$project_filter = $data['filter']["project"];
		} else {
			$where_l_7['b.project'] = $this->user_cookie[10];
			$project_filter = $this->user_cookie[10];
		}

		if (isset($data['filter']["module"]) and $data['filter']["module"] != "") {
			$where_l_7['b.module']  = $data['filter']["module"];
			$module_filter = $data['filter']["module"];
		} else {
			$module_filter = null;
		}

		if (isset($data['filter']["type_of_module"]) and $data['filter']["type_of_module"] != "") {
			$where_l_7['b.type_of_module']  = $data['filter']["type_of_module"];
			$type_of_module_filter =  $data['filter']["type_of_module"];
		} else {
			$type_of_module_filter =  null;
		}

		if (isset($data['filter']["discipline"]) and $data['filter']["discipline"] != "") {
			$where_l_7['b.discipline'] = $data['filter']["discipline"];
			$discipline_filter =  $data['filter']["discipline"];
		} else {
			$where_l_7['b.discipline'] = "2";
			$discipline_filter =  null;
		}

		if (isset($data['filter']["deck_elevation"]) and $data['filter']["deck_elevation"] != "") {
			$where_l_7['b.deck_elevation']  = $data['filter']["deck_elevation"];
			$deck_elevation_filter =  $data['filter']["deck_elevation"];
		} else {
			$deck_elevation_filter =  null;
		}

		if (isset($data['filter']["drawing_as"]) and $data['filter']["drawing_as"] != "") {
			$where_l_7['b.drawing_as']  = $data['filter']["drawing_as"];
			$desc_assy_filter =  $data['filter']["drawing_as"];
		} else {
			$desc_assy_filter =  null;
		}

		$where_l_7['a.status_delete']  	  = "1";
		$data['pcms_summary_level_7'] =  $this->home_mod->search_looping_master_summary_level_7(
			$where_l_7,
			$_GET['project'],
			$_GET['module'],
			$_GET['type_of_module'],
			$_GET['discipline'],
			$_GET['deck_elevation'],
			$_GET['drawing_as'],
			$_GET['phase']
		);


		// $where["DATE_PART('week',date_of_progress) != ".DATE('W')]  	  = NULL;
		$where["DATE_PART('week',date_of_progress)"]  	  = DATE('W') - 1;
		$pcms_summary_last =  $this->home_mod->search_looping_master_summary($where, $group_by, $select);
		// test_var($data['level']);
		unset($where["DATE_PART('week',date_of_progress)"]);
		foreach ($pcms_summary_last as $key => $value) {

			if ($data['level'] == 6) {
				$data['pcms_summary_last'][$value['project']][$value['type_of_module']][$value['discipline']][$value['phase']][$value['deck_elevation']][$value['drawing_as']][$value['part_id']] = $value;
			}
			if ($data['level'] == 5) {
				$data['pcms_summary_last'][$value['project']][$value['type_of_module']][$value['discipline']][$value['phase']][$value['deck_elevation']][$value['drawing_as']] = $value;
			}
			if ($data['level'] == 4) {
				$data['pcms_summary_last'][$value['project']][$value['type_of_module']][$value['discipline']][$value['phase']][$value['deck_elevation']] = $value;
			}
			if ($data['level'] == 3) {
				$data['pcms_summary_last'][$value['project']][$value['type_of_module']][$value['discipline']][$value['phase']] = $value;
			}
			if ($data['level'] == 2) {
				$data['pcms_summary_last'][$value['project']][$value['type_of_module']][$value['phase']] = $value;
			}
			if ($data['level'] == 1) {
				$data['pcms_summary_last'][$value['project']][$value['type_of_module']] = $value;
			}
		}

		$where["DATE_PART('week',date_of_progress)"]  	  = DATE('W');
		$pcms_summary_now =  $this->home_mod->search_looping_master_summary($where, $group_by, $select);
		foreach ($pcms_summary_now as $key => $value) {

			if ($data['level'] == 6) {
				$data['pcms_summary_now'][$value['project']][$value['type_of_module']][$value['discipline']][$value['phase']][$value['deck_elevation']][$value['drawing_as']][$value['part_id']] = $value;
			}
			if ($data['level'] == 5) {
				$data['pcms_summary_now'][$value['project']][$value['type_of_module']][$value['discipline']][$value['phase']][$value['deck_elevation']][$value['drawing_as']] = $value;
			}
			if ($data['level'] == 4) {
				$data['pcms_summary_now'][$value['project']][$value['type_of_module']][$value['discipline']][$value['phase']][$value['deck_elevation']] = $value;
			}
			if ($data['level'] == 3) {
				$data['pcms_summary_now'][$value['project']][$value['type_of_module']][$value['discipline']][$value['phase']] = $value;
			}
			if ($data['level'] == 2) {
				$data['pcms_summary_now'][$value['project']][$value['type_of_module']][$value['phase']] = $value;
			}
			if ($data['level'] == 1) {
				$data['pcms_summary_now'][$value['project']][$value['type_of_module']] = $value;
			}
		}

		if ($data['level'] <= 3) {
			$where = [];
			$where['type_of_module !='] = null;
			$where['discipline'] 			= null;
			$where['phase'] 					= null;
			$where['elevation'] 			= null;
			if ($data['level'] >= 1) {
				$where['project'] = $_GET['project'];
			} else {
				$where['project'] = $this->user_cookie[10];
			}
			if ($data['level'] >= 2) {
				$where['type_of_module'] = $_GET['type_of_module'];
				$where['discipline !='] = null;
				unset($where['type_of_module !=']);
				unset($where['discipline']);
			}
			if ($data['level'] >= 3) {
				$where['discipline'] = $_GET['discipline'];
				$where['phase !='] = null;
				unset($where['discipline !=']);
				unset($where['phase']);
			}
			$period = [];
			$where["DATE_PART('week', period) <= " . date("W")] = null;
			$datadb =  $this->planning_mod->plan_measurement_list($where);
			$plan_target = [];
			$plan_target_total = [];
			foreach ($datadb as $key => $value) {
				if ($data["level"] == 1) {
					$plan_target[date("W", strtotime($value["period"]))][$value["type_of_module"]] = $value["plan_target"];
					$plan_target_total[$value["type_of_module"]] += $value["plan_target"];
				} elseif ($data["level"] == 2) {
					$plan_target[date("W", strtotime($value["period"]))][$value["type_of_module"]][$value["discipline"]] = $value["plan_target"];
					$plan_target_total[$value["type_of_module"]][$value["discipline"]] += $value["plan_target"];
				} elseif ($data["level"] == 3) {
					$plan_target[date("W", strtotime($value["period"]))][$value["type_of_module"]][$value["discipline"]][$value["phase"]] = $value["plan_target"];
					$plan_target_total[$value["type_of_module"]][$value["discipline"]][$value["phase"]] += $value["plan_target"];
				}
			}
			$data["plan_target"] = $plan_target;
			$data["plan_target_total"] = $plan_target_total;
		}

		$data['meta_title']  	 		= 'Home';
		$data['subview']     	 		= 'home/home_level_5';
		$data['user_permission'] 		= $this->permission_cookie;
		$data['user_cookie'] 			= $this->user_cookie;

		$this->load->view('index', $data);
	}

	public function project_list()
	{
		$datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['project_code']] = $value;
		}
		$data['project_list'] 	 = $project_list;
		$data['user_permission'] = $this->permission_cookie;
		$data['meta_title']  	 = 'Project List';
		$data['subview']     	 = 'home/project_list';

		$this->load->view('index', $data);
	}


	public function plan_dashboard()
	{

		$data['filter'] = $this->input->get();


		$datadb = $this->general_mod->project();
		$project_list = [];
		$project_list_data = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['project_code']] = $value;
			$project_list_data[$value['project_code']] = $value;
		}
		$data['project_list'] = $project_list;
		$data['project_list_data'] = $project_list_data;


		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		$discipline_list_data = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['initial']] = $value;
			$discipline_list_data[$value['id']] = $value;
		}
		$data['discipline_list'] = $discipline_list;
		$data['discipline_list_data'] = $discipline_list_data;


		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['mod_id']] = $value;
		}
		$data['module_list'] = $module_list;


		$datadb = $this->general_mod->project();
		$project_list = [];
		$project_list_data = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['project_code']] = $value;
			$project_list_data[$value['id']] = $value;
		}
		$data['project_list'] = $project_list;
		$data['project_list_data'] = $project_list_data;


		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		$type_of_module_list_data = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
			$type_of_module_list_data[$value['id']] = $value;
		}
		$data['type_of_module_list'] = $type_of_module_list;
		$data['type_of_module_list_data'] = $type_of_module_list_data;


		$datadb = $this->general_mod->deck_elevation();
		$deck_elevation_list = [];
		$deck_elevation_list_data = [];
		foreach ($datadb as $key => $value) {
			$deck_elevation_list[$value['code']] = $value;
			$deck_elevation_list_data[$value['id']] = $value;
		}
		$data['deck_elevation_list'] 	  = $deck_elevation_list;
		$data['deck_elevation_list_data'] = $deck_elevation_list_data;


		$datadb = $this->general_mod->desc_assy();
		$desc_assy_list = [];
		$desc_assy_list_data = [];
		foreach ($datadb as $key => $value) {
			$desc_assy_list[$value['code']] = $value;
			$desc_assy_list_data[$value['id']] = $value;
		}
		$data['desc_assy_list'] = $desc_assy_list;
		$data['desc_assy_list_data'] = $desc_assy_list_data;


		if (isset($data['filter']["project"]) and $data['filter']["project"] != "") {
			$where['b.project'] = $data['filter']["project"];
			$project_filter = $data['filter']["project"];
		} else {
			$where['b.project'] = $this->user_cookie[10];
			$project_filter = $this->user_cookie[10];
		}

		if (isset($data['filter']["module"]) and $data['filter']["module"] != "") {
			$where['b.module']  = $data['filter']["module"];
			$module_filter = $data['filter']["module"];
		} else {
			$module_filter = null;
		}

		if (isset($data['filter']["type_of_module"]) and $data['filter']["type_of_module"] != "") {
			$where['b.type_of_module']  = $data['filter']["type_of_module"];
			$type_of_module_filter =  $data['filter']["type_of_module"];
		} else {
			$type_of_module_filter =  null;
		}

		if (isset($data['filter']["discipline"]) and $data['filter']["discipline"] != "") {
			$where['b.discipline'] = $data['filter']["discipline"];
			$discipline_filter =  $data['filter']["discipline"];
		} else {
			$where['b.discipline'] = "2";
			$discipline_filter =  null;
		}

		if (isset($data['filter']["deck_elevation"]) and $data['filter']["deck_elevation"] != "") {
			$where['b.deck_elevation']  = $data['filter']["deck_elevation"];
			$deck_elevation_filter =  $data['filter']["deck_elevation"];
		} else {
			$deck_elevation_filter =  null;
		}

		if (isset($data['filter']["desc_assy"]) and $data['filter']["desc_assy"] != "") {
			$where['b.description_assy']  = $data['filter']["desc_assy"];
			$desc_assy_filter =  $data['filter']["desc_assy"];
		} else {
			$desc_assy_filter =  null;
		}

		$where['a.status_delete']  	  = "1";
		$data['pcms_summary'] =  $this->home_mod->search_looping_master_summary_plan($where, $project_filter, $module_filter, $type_of_module_filter, $discipline_filter, $deck_elevation_filter, $desc_assy_filter);
		unset($where);

		// $query_Manual = "select * from ( select id_sum, id_temp_pc, pf_mv, f_fu, f_vs, f_ndt, as_fu, as_vs, as_ndt, er_fu, er_vs, er_ndt, status_delete, date_of_progress, progress_by, max(id_sum) over (partition by id_temp_pc) as max_thing from pcms_summary ) t where id_sum = max_thing";
		// $test_manual = $this->home_mod->manual_query_db($query_Manual);
		// unset($query_Manual);

		// test_var($test_manual);			

		$data['meta_title']  	 		= 'Home';
		$data['subview']     	 		= 'home/plan_dashboard';
		$data['user_permission'] 		= $this->permission_cookie;

		$this->load->view('index', $data);
	}

	public function data_dashboard_grafix_progress()
	{
		$post = $this->input->post();
		test_var($post);
	}

	public function kpi_user_pcms_query($colomn, $replacer_str)
	{
		$arr = [];
		$replacer_arr = explode(" as ", $replacer_str);
		foreach ($colomn as $key => $value) {
			$key_arr = explode(" as ", $key);
			$alis = $key_arr[1];
			if ($replacer_arr[1] == $key_arr[1]) {
				$arr[] = $replacer_str;
			} else {
				$arr[] = "$value as $alis";
			}
		}
		return join(", ", $arr);
	}

	public function kpi_user_pcms($date_from, $date_to)
	{
		$colomn = [
			"SUM(num_pc) as num_pc"                   => 0,
			"SUM(num_r_pc) as num_r_pc"               => 0,
			"SUM(num_jt) as num_jt"                   => 0,
			"SUM(num_r_jt) as num_r_jt"               => 0,
			"SUM(num_progress_mv) as num_progress_mv" => 0,
			"SUM(num_progress_fu) as num_progress_fu" => 0,
			"SUM(num_progress_vt) as num_progress_vt" => 0,
			"SUM(num_mv) as num_mv"                   => 0,
			"SUM(num_r_mv) as num_r_mv"               => 0,
			"SUM(num_fu) as num_fu"                   => 0,
			"SUM(num_r_fu) as num_r_fu"               => 0,
			"SUM(num_vt) as num_vt"                   => 0,
			"SUM(num_r_vt) as num_r_vt"               => 0,
		];
		$query_from_arr = [];

		$query_column_str = $this->kpi_user_pcms_query($colomn, "count(created_by) as num_pc");
		$query_from_arr[] = "SELECT created_by, DATE(created_date) as created_date, $query_column_str
		from pcms_piecemark group by created_by, date(created_date)";

		$query_column_str = $this->kpi_user_pcms_query($colomn, "COUNT(id_data) as num_r_pc");
		$query_from_arr[] = "SELECT request_by AS created_by, created_date, $query_column_str 
		FROM (
			SELECT DATE(update_date) AS created_date, request_by, unnest(string_to_array(id_data, ', ')) AS id_data 
			FROM pcms_revise_history WHERE status_revise = 4 AND fabrication_type IN (4)
		) AS tmp GROUP BY request_by, created_date";

		$query_column_str = $this->kpi_user_pcms_query($colomn, "count(created_by) as num_jt");
		$query_from_arr[] = "SELECT created_by, DATE(created_date), $query_column_str from pcms_joint group by created_by, date(created_date)";

		$query_column_str = $this->kpi_user_pcms_query($colomn, "COUNT(id_data) as num_r_jt");
		$query_from_arr[] = "SELECT request_by AS created_by, created_date, $query_column_str  FROM (SELECT DATE(update_date) AS created_date, request_by, unnest(string_to_array(id_data, ', ')) AS id_data FROM pcms_revise_history WHERE status_revise = 4 AND fabrication_type IN (5)) AS tmp GROUP BY request_by, created_date";

		$query_column_str = $this->kpi_user_pcms_query($colomn, "1 as num_progress_mv");
		$query_from_arr[] = "SELECT CAST(surveyor_creator as integer) AS created_by, DATE(surveyor_created_date), $query_column_str from pcms_material group by id_piecemark, id_workpack, device_status, surveyor_creator, date(surveyor_created_date)";

		$query_column_str = $this->kpi_user_pcms_query($colomn, "1 as num_progress_fu");
		$query_from_arr[] = "SELECT CAST(surveyor_creator as integer) AS created_by, DATE(surveyor_created_date), $query_column_str from pcms_fitup group by id_joint, id_workpack, device_status, surveyor_creator, date(surveyor_created_date)";

		$query_column_str = $this->kpi_user_pcms_query($colomn, "1 as num_progress_vt");
		$query_from_arr[] = "SELECT CAST(surveyor_creator as integer) AS created_by, DATE(surveyor_created_date), $query_column_str from pcms_visual group by id_joint, id_workpack, device_status, surveyor_creator, date(surveyor_created_date)";

		$query_column_str = $this->kpi_user_pcms_query($colomn, "count(requestor) as num_mv");
		$query_from_arr[] = "SELECT requestor, DATE(date_created), $query_column_str from pcms_material group by requestor, date(date_created)";

		$query_column_str = $this->kpi_user_pcms_query($colomn, "count(id_data) as num_r_mv");
		$query_from_arr[] = "SELECT request_by AS created_by, created_date, $query_column_str  FROM (SELECT DATE(update_date) AS created_date, request_by, id as id_data FROM pcms_revise_history WHERE status_revise = 4 AND fabrication_type IN (1)) AS tmp GROUP BY request_by, created_date";

		$query_column_str = $this->kpi_user_pcms_query($colomn, "count(requestor) as num_fu");
		$query_from_arr[] = "SELECT requestor, DATE(date_created), $query_column_str from pcms_fitup group by requestor, date(date_created)";

		$query_column_str = $this->kpi_user_pcms_query($colomn, "count(id_data) as num_r_fu");
		$query_from_arr[] = "SELECT request_by AS created_by, created_date, $query_column_str FROM (SELECT DATE(update_date) AS created_date, request_by, id as id_data FROM pcms_revise_history WHERE status_revise = 4 AND fabrication_type IN (2)) AS tmp GROUP BY request_by, created_date";

		$query_column_str = $this->kpi_user_pcms_query($colomn, "count(requestor) as num_vt");
		$query_from_arr[] = "SELECT requestor, DATE(date_created), $query_column_str from pcms_visual group by requestor, date(date_created)";

		$query_column_str = $this->kpi_user_pcms_query($colomn, "count(id_data) as num_r_vt");
		$query_from_arr[] = "SELECT request_by AS created_by, created_date, $query_column_str  FROM (SELECT DATE(request_date) AS created_date, request_by, id as id_data FROM pcms_revise_history WHERE status_revise = 3 AND fabrication_type IN (3)) AS tmp GROUP BY request_by, created_date";
		// test_var($query_from_arr);

		$query_select_str = join(", ", array_keys($colomn));
		$query_from_str = join("
		UNION
		", $query_from_arr);
		$query = "SELECT created_by, created_date, $query_select_str 
		from (
			$query_from_str
		) as tmp
		WHERE created_by NOT IN (1, 2, 76, 146, 1000226, 1000297, 999999)
		GROUP BY created_by, created_date
		HAVING created_date BETWEEN '$date_from' AND '$date_to'
		ORDER BY created_date DESC";
		// test_var($query);
		$datadb_all = $this->general_mod->manual_query_db($query);

		$id_user = [];
		$user_list = [];
		$data_list = [];

		$surveyor_data = [];
		$datadb = $this->general_mod->manual_query_db("SELECT DISTINCT id_piecemark, id_workpack, device_status, surveyor_creator, DATE(surveyor_created_date) as surveyor_created_date FROM pcms_material WHERE DATE(surveyor_created_date) BETWEEN '$date_from' AND '$date_to'");
		foreach ($datadb as $key => $value) {
			@$surveyor_data['MV'][$value['surveyor_creator']][$value['surveyor_created_date']] += 1;
			if (!in_array($value['surveyor_creator'], $id_user)) {
				$id_user[] = $value['surveyor_creator'];
			}
		}
		$datadb = $this->general_mod->manual_query_db("SELECT DISTINCT id_joint, id_workpack, device_status, surveyor_creator, DATE(surveyor_created_date) as surveyor_created_date FROM pcms_fitup WHERE DATE(surveyor_created_date) BETWEEN '$date_from' AND '$date_to'");
		foreach ($datadb as $key => $value) {
			@$surveyor_data['FU'][$value['surveyor_creator']][$value['surveyor_created_date']] += 1;
			if (!in_array($value['surveyor_creator'], $id_user)) {
				$id_user[] = $value['surveyor_creator'];
			}
		}
		$datadb = $this->general_mod->manual_query_db("SELECT DISTINCT id_joint, id_workpack, device_status, surveyor_creator, DATE(surveyor_created_date) as surveyor_created_date FROM pcms_visual WHERE DATE(surveyor_created_date) BETWEEN '$date_from' AND '$date_to'");
		foreach ($datadb as $key => $value) {
			@$surveyor_data['VT'][$value['surveyor_creator']][$value['surveyor_created_date']] += 1;
			if (!in_array($value['surveyor_creator'], $id_user)) {
				$id_user[] = $value['surveyor_creator'];
			}
		}
		$datadb = $this->general_mod->manual_query_db("SELECT DISTINCT id_piecemark, id_workpack, device_status, surveyor_creator, DATE(surveyor_created_date) as surveyor_created_date FROM pcms_itr WHERE DATE(surveyor_created_date) BETWEEN '$date_from' AND '$date_to'");
		foreach ($datadb as $key => $value) {
			@$surveyor_data['ITR'][$value['surveyor_creator']][$value['surveyor_created_date']] += 1;
			if (!in_array($value['surveyor_creator'], $id_user)) {
				$id_user[] = $value['surveyor_creator'];
			}
		}

		foreach ($datadb_all as $key => $value) {
			if (!in_array($value['created_by'], $id_user)) {
				$id_user[] = $value['created_by'];
			}
			$data_list[$value['created_date']][$value['created_by']] = [
				"num_pc" => $value['num_pc'],
				"num_r_pc" => $value['num_r_pc'],
				"num_jt" => $value['num_jt'],
				"num_r_jt" => $value['num_r_jt'],
				"num_progress_mv" => @$surveyor_data['MV'][$value['created_by']][$value['created_date']] + 0,
				"num_progress_fu" => @$surveyor_data['FU'][$value['created_by']][$value['created_date']] + 0,
				"num_progress_vt" => @$surveyor_data['VT'][$value['created_by']][$value['created_date']] + 0,
				"num_progress_itr" => @$surveyor_data['ITR'][$value['created_by']][$value['created_date']] + 0,
				"num_mv" => $value['num_mv'],
				"num_r_mv" => $value['num_r_mv'],
				"num_fu" => $value['num_fu'],
				"num_r_fu" => $value['num_r_fu'],
				"num_vt" => $value['num_vt'],
				"num_r_vt" => $value['num_r_vt'],
			];
		}

		$datadb = $this->general_mod->manual_query_db("SELECT DISTINCT id_material, inspection_by, DATE(inspection_datetime) as create_date FROM pcms_material WHERE DATE(inspection_datetime) BETWEEN '$date_from' AND '$date_to'");
		foreach ($datadb as $key => $value) {
			@$data_list[$value['create_date']][$value['inspection_by']]['num_inspect_mv'] += 1;
			if (!in_array($value['inspection_by'], $id_user)) {
				$id_user[] = $value['inspection_by'];
			}
		}
		$datadb = $this->general_mod->manual_query_db("SELECT DISTINCT id_fitup, inspection_by, DATE(inspection_datetime) as create_date FROM pcms_fitup WHERE DATE(inspection_datetime) BETWEEN '$date_from' AND '$date_to'");
		foreach ($datadb as $key => $value) {
			@$data_list[$value['create_date']][$value['inspection_by']]['num_inspect_fu'] += 1;
			if (!in_array($value['inspection_by'], $id_user)) {
				$id_user[] = $value['inspection_by'];
			}
		}
		$datadb = $this->general_mod->manual_query_db("SELECT DISTINCT id_visual, inspection_by, DATE(inspection_datetime) as create_date FROM pcms_visual WHERE DATE(inspection_datetime) BETWEEN '$date_from' AND '$date_to'");
		foreach ($datadb as $key => $value) {
			@$data_list[$value['create_date']][$value['inspection_by']]['num_inspect_vt'] += 1;
			if (!in_array($value['inspection_by'], $id_user)) {
				$id_user[] = $value['inspection_by'];
			}
		}
		$datadb = $this->general_mod->manual_query_db("SELECT DISTINCT id_material, transmittal_by, DATE(transmittal_datetime) as create_date FROM pcms_material WHERE DATE(transmittal_datetime) BETWEEN '$date_from' AND '$date_to'");
		foreach ($datadb as $key => $value) {
			@$data_list[$value['create_date']][$value['transmittal_by']]['num_transmit_mv'] += 1;
			if (!in_array($value['transmittal_by'], $id_user)) {
				$id_user[] = $value['transmittal_by'];
			}
		}
		$datadb = $this->general_mod->manual_query_db("SELECT DISTINCT id_fitup, transmitted_by, DATE(transmitted_date) as create_date FROM pcms_fitup WHERE DATE(transmitted_date) BETWEEN '$date_from' AND '$date_to'");
		foreach ($datadb as $key => $value) {
			@$data_list[$value['create_date']][$value['transmitted_by']]['num_transmit_fu'] += 1;
			if (!in_array($value['transmitted_by'], $id_user)) {
				$id_user[] = $value['transmitted_by'];
			}
		}
		$datadb = $this->general_mod->manual_query_db("SELECT DISTINCT id_visual, transmittal_by, DATE(transmittal_datetime) as create_date FROM pcms_visual WHERE DATE(transmittal_datetime) BETWEEN '$date_from' AND '$date_to'");
		foreach ($datadb as $key => $value) {
			@$data_list[$value['create_date']][$value['transmittal_by']]['num_transmit_vt'] += 1;
			if (!in_array($value['transmittal_by'], $id_user)) {
				$id_user[] = $value['transmittal_by'];
			}
		}

		$datadb = $this->general_mod->manual_query_db("SELECT DATE(created_date) as create_date, created_by, count(id) as num  FROM pcms_mechanical_completion WHERE DATE(created_date) BETWEEN '$date_from' AND '$date_to' group by DATE(created_date), created_by");
		foreach ($datadb as $key => $value) {
			@$data_list[$value['create_date']][$value['created_by']]['num_mc_data'] += $value['num'];
			if (!in_array($value['created_by'], $id_user)) {
				$id_user[] = $value['created_by'];
			}
		}

		$datadb = $this->general_mod->manual_query_db("SELECT DATE(created_date) as create_date, created_by, count(id) as num  FROM pcms_mechanical_completion_attachment WHERE DATE(created_date) BETWEEN '$date_from' AND '$date_to' group by DATE(created_date), created_by");
		foreach ($datadb as $key => $value) {
			@$data_list[$value['create_date']][$value['created_by']]['num_mc_attachment'] += $value['num'];
			if (!in_array($value['created_by'], $id_user)) {
				$id_user[] = $value['created_by'];
			}
		}

		if (count($id_user) > 0) {
			$user_list = user_name_data($id_user, 1);
		}
		$data['data_list'] = $data_list;
		$data['user_list'] = $user_list;
		$this->load->view('home/kpi_user_pcms', $data);
	}

	public function kpi_user_surveyor_pcms()
	{
		$data_list = $this->general_mod->manual_query_db("SELECT surveyor_creator, month, sum(num_ft) as num_ft, sum(num_vt) as num_vt from (
			(
				SELECT surveyor_creator, month, count(id_joint) as num_ft, 0 as num_vt
				from (
					select id_joint, surveyor_creator, EXTRACT(month FROM surveyor_created_date) as month from pcms_fitup pf 
					where EXTRACT(month FROM surveyor_created_date) in (1, 2) and EXTRACT(year FROM surveyor_created_date) in (2022)
					group by id_joint, surveyor_creator, month
				) as tmp
				group by surveyor_creator, month
			)
			union
			(
				select surveyor_creator, month, 0, count(id_joint)
				from (
					select id_joint, surveyor_creator, EXTRACT(month FROM surveyor_created_date) as month from pcms_visual pv
					where EXTRACT(month FROM surveyor_created_date) in (1, 2) and EXTRACT(year FROM surveyor_created_date) in (2022)
					group by id_joint, surveyor_creator, month
				) as tmp
				group by surveyor_creator, month order by surveyor_creator asc, month asc
			)
			) as tmp
			group by surveyor_creator, month
		");
		$id_user = [];
		$user_list = [];
		foreach ($data_list as $key => $value) {
			if (!in_array($value['surveyor_creator'], $id_user)) {
				$id_user[] = $value['surveyor_creator'];
			}
		}
		if (count($id_user) > 0) {
			$user_list = user_name_data($id_user);
		}
		// test_var($data_list);
		$data['data_list'] = $data_list;
		$data['user_list'] = $user_list;
		$this->load->view('home/kpi_user_pcms', $data);
	}

	public function load_data_status_surveyor($discipline)
	{
		$datadb = $this->general_mod->manual_query_db("SELECT status_surveyor, count(id_fitup) as num
		from pcms_fitup pf
		where status_inspection in (0) 
		and (id_fitup, id_joint) in (select max(id_fitup), id_joint from pcms_fitup pm where discipline = " . $discipline . " group by id_joint)
		group by status_surveyor");
		$surveyor_status_fu_list = [];
		foreach ($datadb as $key => $value) {
			if ($value["status_surveyor"] == "") {
				@$surveyor_status_fu_list[3] += $value['num'];
			} else {
				@$surveyor_status_fu_list[$value['status_surveyor']] += $value['num'];
			}
		}

		$datadb = $this->general_mod->manual_query_db("SELECT status_surveyor, count(id_visual) as num
		from pcms_visual pf
		where status_inspection in (0) 
		and (id_visual, id_joint) in (select max(id_visual), id_joint from pcms_visual pm where discipline = " . $discipline . " group by id_joint)
		group by status_surveyor");
		$surveyor_status_vt_list = [];
		foreach ($datadb as $key => $value) {
			if ($value["status_surveyor"] == "") {
				@$surveyor_status_vt_list[3] += $value['num'];
			} else {
				@$surveyor_status_vt_list[$value['status_surveyor']] += $value['num'];
			}
		}

		$datadb = $this->general_mod->manual_query_db("SELECT count(drawing_wm) as num FROM onprogress_welding_joint where discipline = " . $discipline . "");
		$total_onprogress_welding = 0;
		foreach ($datadb as $key => $value) {
			$total_onprogress_welding += $value['num'];
		}

		$datadb = $this->general_mod->manual_query_db("SELECT count(drawing_wm) as num FROM onprogress_fitting_joint where discipline = " . $discipline . "");
		$total_onprogress_fitting = @$datadb[0]['num'] + 0;

		$datadb = $this->general_mod->manual_query_db("SELECT count(drawing_wm) as num FROM outstanding_material_per_joint where discipline = " . $discipline . "");
		$outstanding_material_per_joint = @$datadb[0]['num'] + 0;

		$datadb = $this->general_mod->master_surveyor_status([
			"status_deleted" => "0",
		]);
		$html = [];
		if ($this->user_cookie[11] == 1) {
			$html[] = "<tr><td><a href='" . base_url("home/surveyor_status_detail/visual/" . strtr($this->encryption->encrypt($discipline), '+=/', '.-~')) . "' class='font-weight-bold'>Onprogress Welding</a></td><td>" . $total_onprogress_welding . "</td></tr>";
		}
		foreach ($datadb as $key => $value) {
			$html[] = "<tr>";
			if ($value["id"] == 3 || $this->user_cookie[11] != 1) {
				$html[] = "<td>" . $value["description"] . "</td>";
			} else {
				$html[] = "<td><a href='" . base_url("home/surveyor_status_detail/visual/" . strtr($this->encryption->encrypt($discipline), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt($value["id"]), '+=/', '.-~')) . "' class='font-weight-bold'>" . $value["description"] . "</a></td>";
			}
			$html[] = "<td>" . (@$surveyor_status_vt_list[$value["id"]] + 0) . "</td>";
			$html[] = "</tr>";
		}
		$output["visual"] = join("", $html);

		$html = [];
		if ($this->user_cookie[11] == 1) {
			$html[] = "<tr><td><a href='" . base_url("home/surveyor_status_detail_material/" . strtr($this->encryption->encrypt($discipline), '+=/', '.-~')) . "' class='font-weight-bold'>Outstanding Material</a></td><td>" . $outstanding_material_per_joint . "</td></tr>";
			$html[] = "<tr><td><a href='" . base_url("home/surveyor_status_detail/fitup/" . strtr($this->encryption->encrypt($discipline), '+=/', '.-~')) . "' class='font-weight-bold'>Onprogress Fitup</a></td><td>" . $total_onprogress_fitting . "</td></tr>";
		}
		foreach ($datadb as $key => $value) {
			if (@$surveyor_status_fu_list[$value["id"]] + 0 > 0 || $value["id"] == 3) {
				$html[] = "<tr>";
				if ($value["id"] == 3 || $this->user_cookie[11] != 1) {
					$html[] = "<td>" . $value["description"] . "</td>";
				} else {
					$html[] = "<td><a href='" . base_url("home/surveyor_status_detail/fitup/" . strtr($this->encryption->encrypt($discipline), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt($value["id"]), '+=/', '.-~')) . "' class='font-weight-bold'>" . $value["description"] . "</a></td>";
				}
				$html[] = "<td>" . (@$surveyor_status_fu_list[$value["id"]] + 0) . "</td>";
				$html[] = "</tr>";
			}
		}
		$output["fitup"] = join("", $html);

		echo json_encode($output);
	}

	public function surveyor_status_detail($process = 'visual', $discipline_enc, $id_surveyor_status_enc = null)
	{
		$column_date_name = "";
		$discipline = $this->encryption->decrypt(strtr($discipline_enc, '.-~', '+=/'));
		if ($id_surveyor_status_enc == null) {
			$data['meta_title']  	 		= 'Welding OnProgress Detail';
			if ($process == 'fitup') {
				$data['meta_title']  	 		= 'Fitup OnProgress Detail';
			}
		} else {
			$id_surveyor_status = $this->encryption->decrypt(strtr($id_surveyor_status_enc, '.-~', '+=/'));
			$datadb = $this->general_mod->master_surveyor_status([
				"id" => $id_surveyor_status,
				"status_deleted" => "0",
			]);
			if (count($datadb) == 0) {
				redirect(base_url());
			}
			$surveyor_status = $datadb[0];
			$data['meta_title'] = $surveyor_status["description"] . " Detail";
			$column_date_name = $surveyor_status["description"] . " Date";
		}

		$data['column_date_name']  	= $column_date_name;
		$data['process']  	 				= $process;
		$data['discipline']  	 			= $discipline_enc;
		$data['id_surveyor_status'] = $id_surveyor_status_enc;
		$data['subview']     	 			= 'home/surveyor_status_detail';
		$this->load->view('index', $data);
	}

	public function surveyor_status_detail_material($discipline_enc)
	{
		$discipline = $this->encryption->decrypt(strtr($discipline_enc, '.-~', '+=/'));

		$data['meta_title']  	 			= 'Outstanding Material Detail';
		$data['discipline']  	 			= $discipline_enc;
		$data['subview']     	 			= 'home/surveyor_status_detail_material';
		$this->load->view('index', $data);
	}

	public function surveyor_status_detail_material_datatable($discipline_enc)
	{
		$discipline = $this->encryption->decrypt(strtr($discipline_enc, '.-~', '+=/'));
		$datadb = $this->general_mod->deck_elevation();
		$deck_elevation_list = [];
		foreach ($datadb as $key => $value) {
			$deck_elevation_list[$value['id']] = $value;
		}

		$where = [
			"discipline" => $discipline,
		];
		$lists = $this->home_mod->surveyor_status_detail_material_datatable_db("data", $where);

		$part_id_list = [];
		foreach ($lists as $list) {
			$part_id_list[] = $list['pos_1'];
			$part_id_list[] = $list['pos_2'];
		}
		$part_id_list = array_unique($part_id_list);

		$datadb = $this->home_mod->outstanding_material_per_piecemark_list(["part_id IN ('" . join("', '", $part_id_list) . "')" => NULL]);
		$material_list = [];
		foreach ($datadb as $key => $value) {
			$material_list[$value['part_id']] = $value;
		}

		$data 	= [];
		foreach ($lists as $list) {
			$row   	= [];
			$row[] = $list['drawing_no'];
			$row[] = $list['drawing_wm'];
			$row[] = $list['joint_no'];
			$row[] = @$deck_elevation_list[$list['deck_elevation']]['name'];
			$row[] = $list['grid_row'];
			$row[] = $list['grid_column'];
			$row[] = $list['weld_length'];

			$status_material = '<span class="badge badge-pill badge-dark">Not Ready</span>';
			if (@$material_list[$list['pos_1']]['status_inspection'] == "0") {
				$status_material = '<span class="badge badge-pill badge-primary">Ready to Submit RFI</span>';
			} elseif (@$material_list[$list['pos_1']]['status_inspection'] == 1) {
				$status_material = '<span class="badge badge-pill badge-info">Pending Approval QC</span>';
			} elseif (@$material_list[$list['pos_1']]['status_inspection'] == 2) {
				$status_material = '<span class="badge badge-pill badge-danger">Rejected by QC</span>';
			} elseif (@$material_list[$list['pos_1']]['status_inspection'] == 3) {
				$status_material = '<span class="badge badge-pill badge-success">Approved by QC</span>';
			} elseif (@$material_list[$list['pos_1']]['status_inspection'] == 4) {
				$status_material = '<span class="badge badge-pill badge-secondary">Pending by QC</span>';
			} elseif (@$material_list[$list['pos_1']]['status_inspection'] == 5) {
				$status_material = '<span class="badge badge-pill badge-info">Pending Approval Client</span>';
			} elseif (@$material_list[$list['pos_1']]['status_inspection'] == 6) {
				$status_material = '<span class="badge badge-pill badge-danger">Rejected by Client</span>';
			} elseif (@$material_list[$list['pos_1']]['status_inspection'] == 7) {
				$status_material = '<span class="badge badge-pill badge-success">Approved by Client</span>';
			} elseif (@$material_list[$list['pos_1']]['status_inspection'] == 8) {
				$status_material = '<span class="badge badge-pill badge-warning">Request for Update</span>';
			} elseif (@$material_list[$list['pos_1']]['status_inspection'] == 9) {
				$status_material = '<span class="badge badge-pill badge-primary">Client RFI - Accepted with Comment</span>';
			} elseif (@$material_list[$list['pos_1']]['status_inspection'] == 10) {
				$status_material = '<span class="badge badge-pill badge-warning">Client RFI - Postponed</span>';
			} elseif (@$material_list[$list['pos_1']]['status_inspection'] == 11) {
				$status_material = '<span class="badge badge-pill badge-warning">Client RFI - Re-Offer</span>';
			} elseif (@$material_list[$list['pos_1']]['status_inspection'] == 12) {
				$status_material = '<span class="badge badge-pill badge-dark">Void</span>';
			}
			$row[] = $list['pos_1'] . '<br>' . $status_material;

			$status_material = '<span class="badge badge-pill badge-dark">Not Ready</span>';
			if (@$material_list[$list['pos_2']]['status_inspection'] == "0") {
				$status_material = '<span class="badge badge-pill badge-primary">Ready to Submit RFI</span>';
			} elseif (@$material_list[$list['pos_2']]['status_inspection'] == 1) {
				$status_material = '<span class="badge badge-pill badge-info">Pending Approval QC</span>';
			} elseif (@$material_list[$list['pos_2']]['status_inspection'] == 2) {
				$status_material = '<span class="badge badge-pill badge-danger">Rejected by QC</span>';
			} elseif (@$material_list[$list['pos_2']]['status_inspection'] == 3) {
				$status_material = '<span class="badge badge-pill badge-success">Approved by QC</span>';
			} elseif (@$material_list[$list['pos_2']]['status_inspection'] == 4) {
				$status_material = '<span class="badge badge-pill badge-secondary">Pending by QC</span>';
			} elseif (@$material_list[$list['pos_2']]['status_inspection'] == 5) {
				$status_material = '<span class="badge badge-pill badge-info">Pending Approval Client</span>';
			} elseif (@$material_list[$list['pos_2']]['status_inspection'] == 6) {
				$status_material = '<span class="badge badge-pill badge-danger">Rejected by Client</span>';
			} elseif (@$material_list[$list['pos_2']]['status_inspection'] == 7) {
				$status_material = '<span class="badge badge-pill badge-success">Approved by Client</span>';
			} elseif (@$material_list[$list['pos_2']]['status_inspection'] == 8) {
				$status_material = '<span class="badge badge-pill badge-warning">Request for Update</span>';
			} elseif (@$material_list[$list['pos_2']]['status_inspection'] == 9) {
				$status_material = '<span class="badge badge-pill badge-primary">Client RFI - Accepted with Comment</span>';
			} elseif (@$material_list[$list['pos_2']]['status_inspection'] == 10) {
				$status_material = '<span class="badge badge-pill badge-warning">Client RFI - Postponed</span>';
			} elseif (@$material_list[$list['pos_2']]['status_inspection'] == 11) {
				$status_material = '<span class="badge badge-pill badge-warning">Client RFI - Re-Offer</span>';
			} elseif (@$material_list[$list['pos_2']]['status_inspection'] == 12) {
				$status_material = '<span class="badge badge-pill badge-dark">Void</span>';
			}
			$row[] = $list['pos_2'] . '<br>' . $status_material;;
			if ($this->user_cookie[11] == 1) {
				$row[] = '<a href="' . base_url() . 'engineering/search_joint?drawing_wm=' . $list['drawing_wm'] . '&joint_no=' . $list['joint_no'] . '" class="btn btn-sm btn-info btn-flat" target="_blank"><i class="fas fa-search"></i> Search</a>';
			} else {
				$row[] = '';
			}

			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->home_mod->surveyor_status_detail_material_datatable_db('count_all', $where),
			"recordsFiltered" => $this->home_mod->surveyor_status_detail_material_datatable_db('count_filter', $where),
			"data" => $data
		);
		echo json_encode($output);
	}

	public function surveyor_status_detail_datatable($process, $discipline_enc, $id_surveyor_status_enc = null)
	{
		$id_surveyor_status = $this->encryption->decrypt(strtr($id_surveyor_status_enc, '.-~', '+=/'));
		$discipline = $this->encryption->decrypt(strtr($discipline_enc, '.-~', '+=/'));
		$datadb = $this->general_mod->deck_elevation();
		$deck_elevation_list = [];
		foreach ($datadb as $key => $value) {
			$deck_elevation_list[$value['id']] = $value;
		}

		$where = [
			"discipline" => $discipline,
		];
		$datadb = $this->home_mod->surveyor_status_detail_datatable_db("data", $process, $id_surveyor_status, $where);

		$data 	= [];
		foreach ($datadb as $list) {
			$row   	= [];
			$row[] = $list['drawing_no'];
			$row[] = $list['drawing_wm'];
			$row[] = $list['joint_no'];
			$row[] = @$deck_elevation_list[$list['deck_elevation']]['name'];
			$row[] = $list['grid_row'];
			$row[] = $list['grid_column'];
			if ($process == 'fitup') {
				$row[] = $list['weld_length'];
			}
			$row[] = $list['inspection_datetime'];
			$row[] = $list['date_part'];
			if ($this->user_cookie[11] == 1) {
				$row[] = '<a href="' . base_url() . 'engineering/search_joint?drawing_wm=' . $list['drawing_wm'] . '&joint_no=' . $list['joint_no'] . '" class="btn btn-sm btn-info btn-flat" target="_blank"><i class="fas fa-search"></i> Search</a>';
			} else {
				$row[] = '';
			}

			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->home_mod->surveyor_status_detail_datatable_db('count_all', $process, $id_surveyor_status, $where),
			"recordsFiltered" => $this->home_mod->surveyor_status_detail_datatable_db('count_filter', $process, $id_surveyor_status, $where),
			"data" => $data
		);
		echo json_encode($output);
	}

	public function load_data_status_surveyor_excel($process, $discipline_enc, $id_surveyor_status_enc = null)
	{
		$discipline = $this->encryption->decrypt(strtr($discipline_enc, '.-~', '+=/'));
		$datadb = $this->general_mod->deck_elevation();
		$deck_elevation_list = [];
		foreach ($datadb as $key => $value) {
			$deck_elevation_list[$value['id']] = $value;
		}

		if ($id_surveyor_status_enc == null) {
			if ($process == 'fitup') {
				$joint_list = $this->home_mod->onprogress_fitting_joint_list([
					"discipline" => $discipline,
				]);
				$column = ['Drawing GA/AS', 'Drawing WM', 'Joint No', 'Deck Elevation / Service Line', 'Row', 'Column', 'Ready to Fitup Date', 'Outstanding Days', 'Weld Lenght'];
				$filename = "Export-OnProgress Fitup-" . date('YmdHis') . ".xlsx";
			} else {
				$joint_list = $this->home_mod->onprogress_welding_joint_list([
					"discipline" => $discipline,
				]);
				$column = ['Drawing GA/AS', 'Drawing WM', 'Joint No', 'Deck Elevation / Service Line', 'Row', 'Column', 'Inspection Date Fit Up', 'Outstanding Days'];
				$filename = "Export-OnProgress Welding-" . date('YmdHis') . ".xlsx";
			}
		} else {
			$id_surveyor_status = $this->encryption->decrypt(strtr($id_surveyor_status_enc, '.-~', '+=/'));
			$datadb = $this->general_mod->master_surveyor_status([
				"id" => $id_surveyor_status,
				"status_deleted" => "0",
			]);
			if (count($datadb) == 0) {
				redirect(base_url());
			}
			$surveyor_status = $datadb[0];
			$joint_list = $this->home_mod->surveyor_status_visual_list([
				"status_surveyor" => $surveyor_status["id"],
				"discipline" => $discipline,
			]);
			$column_date_name = $surveyor_status["description"] . " Date";
			$column = ['Drawing GA/AS', 'Drawing WM', 'Joint No', 'Deck Elevation / Service Line', 'Row', 'Column', $column_date_name, 'Outstanding Days'];
			$filename = "Export-" . $surveyor_status["description"] . "-" . date('YmdHis') . ".xlsx";
		}

		// test_var("END");
		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
		$excel              = new PHPExcel();
		$row                = $excel->setActiveSheetIndex(0);


		$start_column = 'A';
		$finish_column = $start_column;
		foreach ($column as $key => $value) {
			$row->setCellValue($finish_column . "1", $column[$key]);
			$finish_column++;
		}

		$numrow = 2;
		foreach ($joint_list as $key => $value) {
			$status_final = 0;
			$row->setCellValue('A' . $numrow, $value['drawing_no']);
			$row->setCellValue('B' . $numrow, $value['drawing_wm']);
			$row->setCellValue('C' . $numrow, $value['joint_no']);
			$row->setCellValue('D' . $numrow, @$deck_elevation_list[$value['deck_elevation']]['name']);
			$row->setCellValue('E' . $numrow, $value['grid_row']);
			$row->setCellValue('F' . $numrow, $value['grid_column']);
			$row->setCellValue('G' . $numrow, $value['inspection_datetime']);
			$row->setCellValue('H' . $numrow, $value['date_part']);
			if ($process == 'fitup') {
				$row->setCellValue('I' . $numrow, $value['weld_length']);
			}
			$numrow++;
		}
		$numrow--;
		$finish_column--;

		$style = [
			'bold' => ['bold'  => true],
			'center' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER],
			'left' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT],
			'middle' => ['vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER],
			'allborders' => ['allborders' => ["style" => PHPExcel_Style_Border::BORDER_THIN]],
		];
		$excel->getActiveSheet()->getStyle('A1:' . $finish_column . '1')->applyFromArray([
			"borders" => $style['allborders'],
			"alignment" => array_merge($style['center'], $style['middle']),
			"font" => $style['bold'],
		]);
		$excel->getActiveSheet()->getStyle('A2:' . $finish_column . $numrow)->applyFromArray([
			"borders" => $style['allborders'],
			"alignment" => array_merge($style['center'], $style['middle']),
		]);
		for ($i = 'A'; $i !== $finish_column; $i++) {
			$excel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="' . $filename . '"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}

	public function load_data_status_surveyor_material_excel($discipline_enc)
	{
		$discipline = $this->encryption->decrypt(strtr($discipline_enc, '.-~', '+=/'));
		$datadb = $this->general_mod->deck_elevation();
		$deck_elevation_list = [];
		foreach ($datadb as $key => $value) {
			$deck_elevation_list[$value['id']] = $value;
		}

		$joint_list = $this->home_mod->outstanding_material_per_joint_list([
			"discipline" => $discipline,
		]);
		$column = ['Drawing GA/AS', 'Drawing WM', 'Joint No', 'Deck Elevation / Service Line', 'Row', 'Column', 'Weld Lenght', 'POS#1', 'Status POS#1', 'POS#2', 'Status POS#2'];
		$filename = "Export-Outstanding Material-" . date('YmdHis') . ".xlsx";

		// test_var("END");
		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
		$excel              = new PHPExcel();
		$row                = $excel->setActiveSheetIndex(0);

		$start_column = 'A';
		$finish_column = $start_column;
		foreach ($column as $key => $value) {
			$row->setCellValue($finish_column . "1", $column[$key]);
			$finish_column++;
		}

		$part_id_list = [];
		foreach ($joint_list as $list) {
			if (!in_array($list['pos_1'], $part_id_list)) {
				$part_id_list[] = $list['pos_1'];
			}
			if (!in_array($list['pos_2'], $part_id_list)) {
				$part_id_list[] = $list['pos_2'];
			}
		}

		$datadb = $this->home_mod->outstanding_material_per_piecemark_list(["part_id IN ('" . join("', '", $part_id_list) . "')" => NULL]);
		$material_list = [];
		foreach ($datadb as $key => $value) {
			$material_list[$value['part_id']] = $value;
		}

		$numrow = 2;
		foreach ($joint_list as $key => $value) {
			$status_final = 0;
			$row->setCellValue('A' . $numrow, $value['drawing_no']);
			$row->setCellValue('B' . $numrow, $value['drawing_wm']);
			$row->setCellValue('C' . $numrow, $value['joint_no']);
			$row->setCellValue('D' . $numrow, @$deck_elevation_list[$value['deck_elevation']]['name']);
			$row->setCellValue('E' . $numrow, $value['grid_row']);
			$row->setCellValue('F' . $numrow, $value['grid_column']);
			$row->setCellValue('G' . $numrow, $value['weld_length']);

			$status_material = 'Not Ready';
			if (@$material_list[$value['pos_1']]['status_inspection'] == "0") {
				$status_material = 'Ready to Submit RFI';
			} elseif (@$material_list[$value['pos_1']]['status_inspection'] == 1) {
				$status_material = 'Pending Approval QC';
			} elseif (@$material_list[$value['pos_1']]['status_inspection'] == 2) {
				$status_material = 'Rejected by QC';
			} elseif (@$material_list[$value['pos_1']]['status_inspection'] == 3) {
				$status_material = 'Approved by QC';
			} elseif (@$material_list[$value['pos_1']]['status_inspection'] == 4) {
				$status_material = 'Pending by QC';
			} elseif (@$material_list[$value['pos_1']]['status_inspection'] == 5) {
				$status_material = 'Pending Approval Client';
			} elseif (@$material_list[$value['pos_1']]['status_inspection'] == 6) {
				$status_material = 'Rejected by Client';
			} elseif (@$material_list[$value['pos_1']]['status_inspection'] == 7) {
				$status_material = 'Approved by Client';
			} elseif (@$material_list[$value['pos_1']]['status_inspection'] == 8) {
				$status_material = 'Request for Update';
			} elseif (@$material_list[$value['pos_1']]['status_inspection'] == 9) {
				$status_material = 'Client RFI - Accepted with Comment';
			} elseif (@$material_list[$value['pos_1']]['status_inspection'] == 10) {
				$status_material = 'Client RFI - Postponed';
			} elseif (@$material_list[$value['pos_1']]['status_inspection'] == 11) {
				$status_material = 'Client RFI - Re-Offer';
			} elseif (@$material_list[$value['pos_1']]['status_inspection'] == 12) {
				$status_material = 'Void';
			}
			$row->setCellValue('H' . $numrow, $value['pos_1']);
			$row->setCellValue('I' . $numrow, $status_material);

			$status_material = 'Not Ready';
			if (@$material_list[$value['pos_2']]['status_inspection'] == "0") {
				$status_material = 'Ready to Submit RFI';
			} elseif (@$material_list[$value['pos_2']]['status_inspection'] == 1) {
				$status_material = 'Pending Approval QC';
			} elseif (@$material_list[$value['pos_2']]['status_inspection'] == 2) {
				$status_material = 'Rejected by QC';
			} elseif (@$material_list[$value['pos_2']]['status_inspection'] == 3) {
				$status_material = 'Approved by QC';
			} elseif (@$material_list[$value['pos_2']]['status_inspection'] == 4) {
				$status_material = 'Pending by QC';
			} elseif (@$material_list[$value['pos_2']]['status_inspection'] == 5) {
				$status_material = 'Pending Approval Client';
			} elseif (@$material_list[$value['pos_2']]['status_inspection'] == 6) {
				$status_material = 'Rejected by Client';
			} elseif (@$material_list[$value['pos_2']]['status_inspection'] == 7) {
				$status_material = 'Approved by Client';
			} elseif (@$material_list[$value['pos_2']]['status_inspection'] == 8) {
				$status_material = 'Request for Update';
			} elseif (@$material_list[$value['pos_2']]['status_inspection'] == 9) {
				$status_material = 'Client RFI - Accepted with Comment';
			} elseif (@$material_list[$value['pos_2']]['status_inspection'] == 10) {
				$status_material = 'Client RFI - Postponed';
			} elseif (@$material_list[$value['pos_2']]['status_inspection'] == 11) {
				$status_material = 'Client RFI - Re-Offer';
			} elseif (@$material_list[$value['pos_2']]['status_inspection'] == 12) {
				$status_material = 'Void';
			}
			$row->setCellValue('J' . $numrow, $value['pos_2']);
			$row->setCellValue('K' . $numrow, $status_material);
			$numrow++;
		}
		$numrow--;
		$finish_column--;

		$style = [
			'bold' => ['bold'  => true],
			'center' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER],
			'left' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT],
			'middle' => ['vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER],
			'allborders' => ['allborders' => ["style" => PHPExcel_Style_Border::BORDER_THIN]],
		];
		$excel->getActiveSheet()->getStyle('A1:' . $finish_column . '1')->applyFromArray([
			"borders" => $style['allborders'],
			"alignment" => array_merge($style['center'], $style['middle']),
			"font" => $style['bold'],
		]);
		$excel->getActiveSheet()->getStyle('A2:' . $finish_column . $numrow)->applyFromArray([
			"borders" => $style['allborders'],
			"alignment" => array_merge($style['center'], $style['middle']),
		]);
		for ($i = 'A'; $i !== $finish_column; $i++) {
			$excel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="' . $filename . '"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}

	public function load_data_template_new()
	{
		$get = $this->input->get();
 
		
		$datadb = $this->general_mod->manual_query_db("SELECT count(id) as total, sum(weight) as weight from pcms_piecemark pp where company_id = ".$get['company']." and project = ".$get['project']." and status_delete = 1"); //kg
		$piecemark = $datadb[0];

		$datadb = $this->general_mod->manual_query_db("SELECT count(id) as total, sum(weight) as weight from pcms_piecemark pp where company_id = ".$get['company']." and  project = ".$get['project']." and status_delete = 1 and id in (
			select id_piecemark from pcms_material pm
		)"); //kg
		$material = $datadb[0];

		$datadb = $this->general_mod->manual_query_db("SELECT count(id) as total, sum(weight) as weight from pcms_piecemark pp where company_id = ".$get['company']." and  project = ".$get['project']." and status_delete = 1 and id in (
			select id_piecemark from pcms_itr pi2
		)"); //kg
		$itr = $datadb[0];

		$datadb = $this->general_mod->manual_query_db("SELECT count(id) as total, sum(weld_length) as weld_length from pcms_joint pp where company_id = ".$get['company']." and  project = ".$get['project']." and status_delete = 1"); //mm
		$joint = $datadb[0];

		$datadb = $this->general_mod->manual_query_db("SELECT count(id) as total, sum(weld_length) as weld_length from pcms_joint pp where company_id = ".$get['company']." and  project = ".$get['project']." and status_delete = 1 and id in (
			select id_joint from pcms_fitup pf
		)"); //mm
		$fitup = $datadb[0];

		$datadb = $this->general_mod->manual_query_db("SELECT count(id) as total, sum(weld_length) as weld_length from pcms_joint pp where company_id = ".$get['company']." and  project = ".$get['project']." and status_delete = 1 and id in (
			select id_joint from pcms_visual pv
		)"); //mm
		$visual = $datadb[0];

		$data = [
			"total_piecemark" => $piecemark['total'],
			"weight_piecemark" => number_format($piecemark['weight'] / 1000, 2, ".", ""),
			"total_material" => $material['total'],
			"weight_material" => number_format($material['weight'] / 1000, 2, ".", ""),
			"total_itr" => $itr['total'],
			"weight_itr" => number_format($itr['weight'] / 1000, 2, ".", ""),
			"total_joint" => $joint['total'],
			"weld_length_joint" => number_format($joint['weld_length'] / 1000, 2, ".", ""),
			"total_fitup" => $fitup['total'],
			"weld_length_fitup" => number_format($fitup['weld_length'] / 1000, 2, ".", ""),
			"total_visual" => $visual['total'],
			"weld_length_visual" => number_format($visual['weld_length'] / 1000, 2, ".", ""),
		];
		echo json_encode($data);
	}

	public function load_data_template()
	{
		$datadb = $this->engineering_mod->eng_drawing_list([
			"project_id" => 12,
			"status_delete" => 1,
			"transmittal_no !=" => '',
			"drawing_type IN (1, 2)" => NULL,
		]);
		$total_drawing = 0;
		$na_piecemark = 0;
		$na_joint = 0;
		foreach ($datadb as $key => $value) {
			$total_drawing++;
			if ($value['temp_piecemark_status'] == 1) {
				$na_piecemark++;
			}
			if ($value['temp_joint_status'] == 1) {
				$na_joint++;
			}
		}

		$complete_piecemark = 0;
		$datadb = $this->general_mod->manual_query_db("SELECT DISTINCT drawing_ga, drawing_as FROM pcms_piecemark WHERE project = 12");
		foreach ($datadb as $key => $value) {
			$complete_piecemark++;
		}
		$complete_joint = 0;
		$datadb = $this->general_mod->manual_query_db("SELECT DISTINCT drawing_no FROM pcms_joint WHERE project = 12");
		foreach ($datadb as $key => $value) {
			$complete_joint++;
		}
		$data = [
			"piecemark" => [
				["name" => 'OnProgress', "y" => ($total_drawing - $na_piecemark - $complete_piecemark)],
				["name" => 'Complete', "y" => $complete_piecemark],
				["name" => 'NA', "y" => $na_piecemark],
			],
			"joint" => [
				["name" => 'OnProgress', "y" => ($total_drawing - $na_joint - $complete_joint)],
				["name" => 'Complete', "y" => $complete_joint],
				["name" => 'NA', "y" => $na_joint],
			],
		];
		echo json_encode($data);
	}

	public function load_data_workpack_summary()
	{
		$get = $this->input->get();
		
		$workpack_summary = [
			"PF" => [],
			"FB" => [],
			"AS" => [],
			"ER" => [],
		];
		$datadb = $this->planning_mod->workpack_list([
			"status_delete" => 1,
			"project" => $get['project'],
		]);
		foreach ($datadb as $key => $value) {
			if ($value['status'] == 1 && $value['plan_finish_date'] >= date("Y-m-d")) {
				@$workpack_summary[$value['phase']]["inprogress"] += 1;
			} elseif ($value['status'] == 1 && $value['plan_finish_date'] < date("Y-m-d")) {
				@$workpack_summary[$value['phase']]["overdue"] += 1;
			} elseif ($value['status'] == 2) {
				@$workpack_summary[$value['phase']]["complete"] += 1;
			} elseif ($value['status_approval'] == 1) {
				@$workpack_summary[$value['phase']]["pending"] += 1;
			} elseif ($value['status_approval'] == 0) {
				@$workpack_summary[$value['phase']]["draft"] += 1;
			}
		}
		// test_var($workpack_summary);

		$data = [
			["color" => "#d1d8e0", "name" => 'Draft', "data" => [@$workpack_summary['PF']['draft'] + 0, @$workpack_summary['FB']['draft'] + 0, @$workpack_summary['AS']['draft'] + 0, @$workpack_summary['ER']['draft'] + 0]],
			["color" => "#fed330", "name" => 'Pending', "data" => [@$workpack_summary['PF']['pending'] + 0, @$workpack_summary['FB']['pending'] + 0, @$workpack_summary['AS']['pending'] + 0, @$workpack_summary['ER']['pending'] + 0]],
			["color" => "#45aaf2", "name" => 'Progress', "data" => [@$workpack_summary['PF']['inprogress'] + 0, @$workpack_summary['FB']['inprogress'] + 0, @$workpack_summary['AS']['inprogress'] + 0, @$workpack_summary['ER']['inprogress'] + 0]],
			["color" => "#fd9644", "name" => 'Overdue', "data" => [@$workpack_summary['PF']['overdue'] + 0, @$workpack_summary['FB']['overdue'] + 0, @$workpack_summary['AS']['overdue'] + 0, @$workpack_summary['ER']['overdue'] + 0]],
			["color" => "#26de81", "name" => 'Complete', "data" => [@$workpack_summary['PF']['complete'] + 0, @$workpack_summary['FB']['complete'] + 0, @$workpack_summary['AS']['complete'] + 0, @$workpack_summary['ER']['complete'] + 0]],
		];
		echo json_encode($data);
	}

	public function load_data_surveyor()
	{
		$get = $this->input->get();

		$datadb = $this->general_mod->manual_query_db("SELECT 
		SUM(CASE WHEN phase = 'PF' THEN 1 ELSE 0 END) as wp_pf,
		SUM(CASE WHEN phase != 'PF' THEN 1 ELSE 0 END) as wp_n_pf
		FROM pcms_workpack_detail a JOIN pcms_workpack b ON a.id_workpack = b.id
		WHERE a.status_delete = 1 AND b.status_delete = 1 AND a.status != 3 AND company_id = '".$get['company']."' and project = '".$get['project']."'");
		$surveyor = $datadb[0];

		$datadb = $this->general_mod->manual_query_db("SELECT COUNT(status_inspection) as sum_num
		FROM pcms_material
		WHERE (id_material, id_piecemark) in (select max(id_material), id_piecemark from pcms_material pm group by id_piecemark)
		AND status_inspection != 12 AND company_id = '".$get['company']."' and project_code = '".$get['project']."'");
		$mv = $datadb[0];

		$datadb = $this->general_mod->manual_query_db("SELECT COUNT(status_inspection) as sum_num
		FROM pcms_fitup
		WHERE (id_fitup, id_joint) in (select max(id_fitup), id_joint from pcms_fitup pm group by id_joint)
		AND status_inspection != 12 AND company_id = '".$get['company']."' and project_code = '".$get['project']."'");
		$fu = $datadb[0];

		$datadb = $this->general_mod->manual_query_db("SELECT COUNT(status_inspection) as sum_num
		FROM pcms_visual
		WHERE (id_visual, id_joint) in (select max(id_visual), id_joint from pcms_visual pm group by id_joint)
		AND status_inspection != 12 AND company_id = '".$get['company']."' and project_code = '".$get['project']."'");
		$vt = $datadb[0];

		$data = [
			"mv" => [
				["name" => "Not Submitted", "y" => $surveyor['wp_pf'] - $mv['sum_num'] + 0],
				["name" => "Submitted", "y" => $mv['sum_num'] + 0],
			],
			"fu" => [
				["name" => "Not Submitted", "y" => $surveyor['wp_n_pf'] - $fu['sum_num'] + 0],
				["name" => "Submitted", "y" => $fu['sum_num'] + 0],
			],
			"vt" => [
				["name" => "Not Submitted", "y" => $fu['sum_num'] - $vt['sum_num'] + 0],
				["name" => "Submitted", "y" => $vt['sum_num'] + 0],
			],
		];
		echo json_encode($data);
	}

	public function load_data_workpack_manhours()
	{
		$get = $this->input->get();
		
		$datadb = $this->general_mod->manual_query_db("SELECT location, phase, SUM(manhours) as manhours
		FROM pcms_workpack_timesheet a JOIN pcms_workpack b ON a.workpack_id = b.id
		WHERE location_v2 = 0 and company_id = ".$get['company']." and project = ".$get['project']."
		GROUP BY location, phase");
		$manhours = [];
		foreach ($datadb as $key => $value) {
			$manhours[$value['location']][$value['phase']] = $value['manhours'];
			$arr_location[] = $value['location'];
		}
		$location_list = [];
		if (isset($arr_location)) {
			$arr_location = array_filter(array_unique($arr_location));

			$where["id IN (" . implode(", ", $arr_location) . ")"] = NULL;
			$datadb = $this->general_mod->master_location($where);
			foreach ($datadb as $key => $value) {
				$location_list[$value['id']] = $value['location_name'];
			}
		}

		$datadb = $this->general_mod->manual_query_db("SELECT area_v2, location_v2, phase, SUM(manhours) as manhours
		FROM pcms_workpack_timesheet a JOIN pcms_workpack b ON a.workpack_id = b.id
		WHERE location_v2 != 0 and company_id = ".$get['company']." and project = ".$get['project']."
		GROUP BY area_v2, location_v2, phase");
		$manhours_v2 = [];
		foreach ($datadb as $key => $value) {
			$manhours_v2[$value['area_v2'] . "-" . $value['location_v2']][$value['phase']] = $value['manhours'];
		}

		$datadb = $this->general_mod->location_v2();
		$location_v2_list = [];
		foreach ($datadb as $key => $value) {
			$location_v2_list[$value['id']] = $value;
		}

		$datadb = $this->general_mod->area_v2();
		$area_v2_list = [];
		foreach ($datadb as $key => $value) {
			$area_v2_list[$value['id']] = $value;
		}

		$table = [];
		foreach ($location_list as $key => $value) {
			$row = [];
			$row[] = "<td>" . @$value . "</td>";
			$row[] = "<td>" . (@$manhours[$key]['PF'] + 0) . "</td>";
			$row[] = "<td>" . (@$manhours[$key]['FB'] + 0) . "</td>";
			$row[] = "<td>" . (@$manhours[$key]['AS'] + 0) . "</td>";
			$row[] = "<td>" . (@$manhours[$key]['ER'] + 0) . "</td>";
			$table[] = "<tr>" . join("", $row) . "</tr>";
		}
		foreach ($manhours_v2 as $key => $value) {
			$row = [];
			$loc_v2 = explode("-", $key);
			$row[] = "<td>" . @$location_v2_list[$loc_v2[1]]['name'] . "</td>";
			$row[] = "<td>" . (@$manhours_v2[$key]['PF'] + 0) . "</td>";
			$row[] = "<td>" . (@$manhours_v2[$key]['FB'] + 0) . "</td>";
			$row[] = "<td>" . (@$manhours_v2[$key]['AS'] + 0) . "</td>";
			$row[] = "<td>" . (@$manhours_v2[$key]['ER'] + 0) . "</td>";
			$table[] = "<tr>" . join("", $row) . "</tr>";
		}
		echo join("", $table);
	}

	public function load_data_backlog_ndt()
	{
		// $get = $this->input->get();
		
		// $datadb = $this->general_mod->manual_query_db("SELECT location, phase, SUM(manhours) as manhours
		// FROM pcms_workpack_timesheet a JOIN pcms_workpack b ON a.workpack_id = b.id
		// WHERE location_v2 = 0 and project = ".$get['project']."
		// GROUP BY location, phase");
		// $manhours = [];
		// foreach ($datadb as $key => $value) {
		// 	$manhours[$value['location']][$value['phase']] = $value['manhours'];
		// 	$arr_location[] = $value['location'];
		// }
		// $location_list = [];
		// if (isset($arr_location)) {
		// 	$arr_location = array_filter(array_unique($arr_location));

		// 	$where["id IN (" . implode(", ", $arr_location) . ")"] = NULL;
		// 	$datadb = $this->general_mod->master_location($where);
		// 	foreach ($datadb as $key => $value) {
		// 		$location_list[$value['id']] = $value['location_name'];
		// 	}
		// }

		// $datadb = $this->general_mod->manual_query_db("SELECT area_v2, location_v2, phase, SUM(manhours) as manhours
		// FROM pcms_workpack_timesheet a JOIN pcms_workpack b ON a.workpack_id = b.id
		// WHERE location_v2 != 0 and project = ".$get['project']."
		// GROUP BY area_v2, location_v2, phase");
		// $manhours_v2 = [];
		// foreach ($datadb as $key => $value) {
		// 	$manhours_v2[$value['area_v2'] . "-" . $value['location_v2']][$value['phase']] = $value['manhours'];
		// }

		// $datadb = $this->general_mod->location_v2();
		// $location_v2_list = [];
		// foreach ($datadb as $key => $value) {
		// 	$location_v2_list[$value['id']] = $value;
		// }

		// $datadb = $this->general_mod->area_v2();
		// $area_v2_list = [];
		// foreach ($datadb as $key => $value) {
		// 	$area_v2_list[$value['id']] = $value;
		// }

		// $table = [];
		// foreach ($location_list as $key => $value) {
		// 	$row = [];
		// 	$row[] = "<td>" . @$value . "</td>";
		// 	$row[] = "<td>" . (@$manhours[$key]['PF'] + 0) . "</td>";
		// 	$row[] = "<td>" . (@$manhours[$key]['FB'] + 0) . "</td>";
		// 	$row[] = "<td>" . (@$manhours[$key]['AS'] + 0) . "</td>";
		// 	$row[] = "<td>" . (@$manhours[$key]['ER'] + 0) . "</td>";
		// 	$table[] = "<tr>" . join("", $row) . "</tr>";
		// }
		// foreach ($manhours_v2 as $key => $value) {
		// 	$row = [];
		// 	$loc_v2 = explode("-", $key);
		// 	$row[] = "<td>" . @$location_v2_list[$loc_v2[1]]['name'] . "</td>";
		// 	$row[] = "<td>" . (@$manhours_v2[$key]['PF'] + 0) . "</td>";
		// 	$row[] = "<td>" . (@$manhours_v2[$key]['FB'] + 0) . "</td>";
		// 	$row[] = "<td>" . (@$manhours_v2[$key]['AS'] + 0) . "</td>";
		// 	$row[] = "<td>" . (@$manhours_v2[$key]['ER'] + 0) . "</td>";
		// 	$table[] = "<tr>" . join("", $row) . "</tr>";
		// }
		// echo join("", $table);
	}

	public function load_data_chart_progress()
	{
		$year_selected = $this->input->post('year_selected');
		$week_selected = $this->input->post('week_selected');
		$process = $this->input->post('process');
		// test_var($year_selected);
		if ($year_selected == '') {
			$year_selected = 2022;
		}
		if ($week_selected == '') {
			$week_selected = date("Y-m-d");
		}
		$weekly_date_chart = [];
		$date_current_week = date("Y-m-d", strtotime("this monday " . $week_selected));
		for ($i = 0; $i < 7; $i++) {
			$date = date("Y-m-d", strtotime($date_current_week . " -" . ($i * 7) . " days"));
			$date_start = [];
			for ($x = 1; $x <= 7; $x++) {
				$date_start[] = date("Y-m-d", strtotime($date . " -" . $x . " days"));
				$weekly_date_chart[$date][] = end($date_start);
			}
		}
		$weekly_date_chart = array_reverse($weekly_date_chart);

		$datadb = $this->planning_mod->plan_measurement_list([
			"phase" => NULL,
			"discipline" => NULL,
			"type_of_module" => NULL,
		]);
		$plan_list = [];
		$month_plan_list = [];
		foreach ($weekly_date_chart as $week => $nothing) {
			foreach ($datadb as $key => $value) {
				if ($value['week_no'] == date("W", strtotime($nothing[0] . " + 1 day")) && $value['year_week'] == date("Y", strtotime($nothing[0] . " + 1 day"))) {
					$plan_list[$week] = $datadb[$key - 1]["plan_target"];
				}
			}
		}
		foreach ($datadb as $key => $value) {
			$week_end_days = new DateTime();
			$week_end_days->setISODate($value["year_week"], $value["week_no"]);
			$week_end_days = $week_end_days->format('Y-m-d');
			$week_end_days = date("Y-m-d", strtotime($week_end_days . " +6 days"));
			if (date("Y", strtotime($week_end_days)) == $year_selected) {
				$month_plan_list[date("n", strtotime($week_end_days))] = $value["plan_target"];
			}
		}

		$datadb = $this->engineering_mod->joint_list(["status" => 1]);
		$piecemark_phase = [];
		foreach ($datadb as $key => $value) {
			if (!isset($piecemark_phase[$value['pos_1']])) {
				$piecemark_phase[$value['pos_1']] = [];
			}
			if (!in_array($value['phase'], $piecemark_phase[$value['pos_1']])) {
				$piecemark_phase[$value['pos_1']][] = $value['phase'];
			}
			if (!isset($piecemark_phase[$value['pos_2']])) {
				$piecemark_phase[$value['pos_2']] = [];
			}
			if (!in_array($value['phase'], $piecemark_phase[$value['pos_2']])) {
				$piecemark_phase[$value['pos_2']][] = $value['phase'];
			}
		}
		// test_var($piecemark_phase);

		$datadb = $this->home_mod->data_dashboard(["workpack_id IS NOT NULL" => NULL], 'day');
		$progress_list = [];
		$check_double_actual = [];
		// test_var($weekly_date_chart);
		foreach ($datadb as $key => $value) {
			$calc = 0;
			$calc += ((($value["pf_mv"] * 15 / 100) + ($value["f_fu"] * 30 / 100) + ($value["f_vs"] * 45 / 100) + ($value["f_ndt"] * 10 / 100)) * 0.4);
			$calc += ((($value["as_fu"] * 40 / 100) + ($value["as_vs"] * 50 / 100) + ($value["as_ndt"] * 10 / 100)) * 0.3);
			$calc += ((($value["er_fu"] * 40 / 100) + ($value["er_vs"] * 50 / 100) + ($value["er_ndt"] * 10 / 100)) * 0.3);
			foreach ($weekly_date_chart as $week => $nothing) {
				if ($value['day'] != '' && date('Y-m-d', strtotime($value['day'])) <= $week) {
					@$progress_list[$week][$value['part_id']] = $calc;
				}
			}
			for ($i = 1; $i <= 12; $i++) {
				if ($value['day'] != '' && date('Y-m-d', strtotime($value['day'])) <= date("Y-m-t", strtotime($year_selected . "-" . str_pad($i, 2, '0', STR_PAD_LEFT) . "-23"))) {
					@$progress_list[$i][$value['part_id']] = $calc;
				}
			}
		}
		foreach ($weekly_date_chart as $week => $nothing) {
			$cum_actual = 0;
			if (@count($progress_list[$week]) > 0) {
				$cum_actual = @(@array_sum($progress_list[$week]) / @count($progress_list[$week]));
				$cum_actual = number_format($cum_actual, 2) + 0;
			}
			$weekly_actual_chart[] = $cum_actual;
		}
		for ($i = 1; $i <= 12; $i++) {
			$cum_actual = 0;
			if (date('Y-m') < $year_selected . "-" . str_pad($i, 2, '0', STR_PAD_LEFT)) {
				$cum_actual = 0;
			} else {
				if (@count($progress_list[$i]) > 0) {
					$cum_actual = @(@array_sum($progress_list[$i]) / @count($progress_list[$i]));
					$cum_actual = number_format($cum_actual, 2) + 0;
				}
			}
			$actual_monthly_chart[] = $cum_actual;
		}
		// test_var($actual_monthly_chart, 1);
		$cum_actual = 0;
		foreach ($weekly_date_chart as $key => $week_list) {
			$weekly_chart[] = @$plan_list[$key] + 0;
		}
		$monthly_chart = [];
		for ($i = 1; $i <= 12; $i++) {
			$monthly_chart[] = @$month_plan_list[$i] + 0;
		}

		$weekly_chart = [
			[
				"name" => "Plan Target",
				"data" => $weekly_chart,
				"color" => "#45aaf2",
				"dataLabels" => [
					"enabled" => true,
					"format" => '{point.y}%',
				],
			],
			[
				"name" => "Actual",
				"data" => $weekly_actual_chart,
				"color" => "#26de81",
				"dataLabels" => [
					"enabled" => true,
					"format" => '{point.y}%',
				],
			]
		];
		// test_var($weekly_chart);

		$monthly_chart = [
			[
				"name" => "Plan Target",
				"data" => $monthly_chart,
				"color" => "#45aaf2",
				"dataLabels" => [
					"enabled" => true,
					"format" => '{point.y}%',
				],
			],
			[
				"name" => "Actual",
				"data" => $actual_monthly_chart,
				"color" => "#26de81",
				"dataLabels" => [
					"enabled" => true,
					"format" => '{point.y}%',
				],
			]
		];

		$date_for_week_pm = [];
		for ($i = 6; $i >= 0; $i--) {
			$date_for_week_pm[] = date("j M", strtotime($date_current_week . " -" . ($i * 7) . " days"));
		}

		$data = [
			"weekly_chart" => $weekly_chart,
			"monthly_chart" => $monthly_chart,
			"date_for_week_pm" => $date_for_week_pm,
		];
		// test_var($data, 1);
		echo json_encode($data);
	}

	public function load_data_fabrication()
	{
		$process = $this->input->post('process');

		$drawing_list = [];
		if ($process == 'material') { //==========================MATERIAL=====================================================
			$datadb = $this->general_mod->manual_query_db("SELECT status_inspection, status_invitation,
			COUNT(status_inspection) as sum_num
			FROM pcms_material
			WHERE (id_material, id_piecemark) in (select max(id_material), id_piecemark from pcms_material pm group by id_piecemark)
			GROUP BY status_inspection, status_invitation
			ORDER BY status_inspection ASC");
			$mv_list = [];
			foreach ($datadb as $key => $value) {
				@$mv_list[$value['status_inspection']] += $value['sum_num'] + 0;
				if (in_array($value['status_inspection'], [7])) {
					@$mv_list["status_invitation"][($value['status_invitation'] == "" ? 0 : $value['status_invitation'])] += $value['sum_num'] + 0;
				}
			}

			$datadb_mv = $this->general_mod->manual_query_db("SELECT pp.drawing_ga, pp.drawing_as, pp.drawing_sp, status_inspection, id_piecemark FROM pcms_material pm JOIN pcms_piecemark pp ON pm.id_piecemark = pp.id WHERE status_inspection NOT IN (7) AND (id_material, id_piecemark) in (select max(id_material), id_piecemark from pcms_material pm group by id_piecemark)");
			foreach ($datadb_mv as $key => $value) {
				if (!in_array($value['drawing_ga'], $drawing_list)) {
					$drawing_list[] = $value['drawing_ga'];
				}
				if (!in_array($value['drawing_as'], $drawing_list)) {
					$drawing_list[] = $value['drawing_as'];
				}
				if (!in_array($value['drawing_sp'], $drawing_list)) {
					$drawing_list[] = $value['drawing_sp'];
				}
			}
		} elseif ($process == 'fitup') { //==========================FITUP=====================================================
			$datadb = $this->general_mod->manual_query_db("SELECT status_inspection, status_invitation,
			COUNT(status_inspection) as sum_num
			FROM pcms_fitup
			WHERE (id_fitup, id_joint) in (select max(id_fitup), id_joint from pcms_fitup pm group by id_joint)
			GROUP BY status_inspection, status_invitation
			ORDER BY status_inspection ASC");
			$fu_list = [];
			foreach ($datadb as $key => $value) {
				@$fu_list[$value['status_inspection']] += $value['sum_num'] + 0;
				if (in_array($value['status_inspection'], [7])) {
					@$fu_list["status_invitation"][($value['status_invitation'] == "" ? 0 : $value['status_invitation'])] += $value['sum_num'] + 0;
				}
			}

			$datadb_fu = $this->general_mod->manual_query_db("SELECT pj.drawing_no, pj.drawing_wm, status_inspection FROM pcms_fitup pf JOIN pcms_joint pj ON pf.id_joint = pj.id WHERE pf.status_delete is null AND status_inspection NOT IN (7) AND (id_fitup, id_joint) in (select max(id_fitup), id_joint from pcms_fitup pm group by id_joint)");
			foreach ($datadb_fu as $key => $value) {
				if (!in_array($value['drawing_no'], $drawing_list)) {
					$drawing_list[] = $value['drawing_no'];
				}
				if (!in_array($value['drawing_wm'], $drawing_list)) {
					$drawing_list[] = $value['drawing_wm'];
				}
			}
		} elseif ($process == 'visual') { //==========================VISUAL=====================================================
			$datadb = $this->general_mod->manual_query_db("SELECT status_inspection, status_invitation,
			COUNT(status_inspection) as sum_num
			FROM pcms_visual
			WHERE (id_visual, id_joint) in (select max(id_visual), id_joint from pcms_visual pm group by id_joint)
			GROUP BY status_inspection, status_invitation
			ORDER BY status_inspection ASC");
			$vt_list = [];
			foreach ($datadb as $key => $value) {
				@$vt_list[$value['status_inspection']] += $value['sum_num'] + 0;
				if (in_array($value['status_inspection'], [7])) {
					@$vt_list["status_invitation"][($value['status_invitation'] == "" ? 0 : $value['status_invitation'])] += $value['sum_num'] + 0;
				}
			}

			$datadb_vt = $this->general_mod->manual_query_db("SELECT pj.drawing_no, pj.drawing_wm, status_inspection FROM pcms_visual pv JOIN pcms_joint pj ON pv.id_joint = pj.id WHERE pv.status_delete is null AND status_inspection NOT IN (7) AND (id_visual, id_joint) in (select max(id_visual), id_joint from pcms_visual pm group by id_joint)");
			foreach ($datadb_vt as $key => $value) {
				if (!in_array($value['drawing_no'], $drawing_list)) {
					$drawing_list[] = $value['drawing_no'];
				}
				if (!in_array($value['drawing_wm'], $drawing_list)) {
					$drawing_list[] = $value['drawing_wm'];
				}
			}
		} elseif ($process == 'ndt') { //==========================NDT=====================================================
			$datadb = $this->general_mod->manual_query_db("SELECT ndt_type, result,
			COUNT(result) as sum_num
			FROM pcms_ndt
			GROUP BY ndt_type, result
			ORDER BY result ASC");
			$ndt_list = [];
			$ndt_list["type"] = [0, 0, 0, 0];
			foreach ($datadb as $key => $value) {
				@$ndt_list[$value['result']] += $value['sum_num'] + 0;
				if (in_array($value['result'], [3])) {
					@$ndt_list["type"][$value['ndt_type']] += $value['sum_num'] + 0;
				}
			}
			// test_var($ndt_list);
			$datadb = $this->general_mod->manual_query_db("SELECT COUNT(id_visual) as sum_num
			FROM pcms_visual
			WHERE postpone_reoffer_no = 0 
			AND id_visual NOT IN (SELECT DISTINCT id_visual FROM pcms_ndt)
			AND (ndt_rt>0 OR ndt_mt>0 OR ndt_ut>0 OR ndt_pa_ut>0 OR ndt_ht>0 OR ndt_ft>0 OR ndt_pt>0 OR ndt_pmi>0 OR ndt_pwht>0)
			AND ((status_inspection = 7 AND status_invitation = 0) OR (status_inspection >= 5 AND status_invitation = 1))");
			foreach ($datadb as $key => $value) {
				$ndt_list[99] = $value['sum_num'];
			}
		}

		if ($this->user_cookie[7] != 8 && $this->user_cookie[0] != 76) {
			$drawing_list_arr = array_chunk($drawing_list, 500);
			$drawing_list = [];
			foreach ($drawing_list_arr as $key => $value) {
				$datadb = $this->general_mod->drawing_register_list([
					"document_no IN ('" . join("', '", $value) . "')" => NULL,
					"status_delete" => 1,
					"status" => 2,
				]);
				foreach ($datadb as $key => $value) {
					if (!in_array($value['document_no'], $drawing_list)) {
						$drawing_list[] = $value['document_no'];
					}
				}
			}

			if ($process == 'material') { //==========================MATERIAL=====================================================
				$mv_list['pending_transmit'] = [];
				foreach ($datadb_mv as $key => $value) {
					if (in_array($value['drawing_ga'], $drawing_list) && in_array($value['drawing_as'], $drawing_list) && in_array($value['drawing_sp'], $drawing_list)) {
						@$mv_list['pending_transmit']['ready'][$value['status_inspection']] += 1;
					} else {
						@$mv_list['pending_transmit']['not_ready'][$value['status_inspection']] += 1;
					}
				}
			} elseif ($process == 'fitup') { //==========================FITUP=====================================================
				$fu_list['pending_transmit'] = [];
				foreach ($datadb_fu as $key => $value) {
					if (in_array($value['drawing_no'], $drawing_list) && in_array($value['drawing_wm'], $drawing_list)) {
						@$fu_list['pending_transmit']['ready'][$value['status_inspection']] += 1;
					} else {
						@$fu_list['pending_transmit']['not_ready'][$value['status_inspection']] += 1;
					}
				}
			} elseif ($process == 'visual') { //==========================VISUAL=====================================================
				$vt_list['pending_transmit'] = [];
				foreach ($datadb_vt as $key => $value) {
					if (in_array($value['drawing_no'], $drawing_list) && in_array($value['drawing_wm'], $drawing_list)) {
						@$vt_list['pending_transmit']['ready'][$value['status_inspection']] += 1;
					} else {
						@$vt_list['pending_transmit']['not_ready'][$value['status_inspection']] += 1;
					}
				}
			}
		} else {
			if ($process == 'material') { //==========================MATERIAL=====================================================
				foreach ($mv_list as $key => $value) {
					@$mv_list['pending_transmit']['ready'][$key] = $value;
				}
			} elseif ($process == 'fitup') { //==========================FITUP=====================================================
				foreach ($fu_list as $key => $value) {
					@$fu_list['pending_transmit']['ready'][$key] = $value;
				}
			} elseif ($process == 'visual') { //==========================VISUAL=====================================================
				foreach ($vt_list as $key => $value) {
					@$vt_list['pending_transmit']['ready'][$key] = $value;
				}
			}
		}

		$data = [
			"material" => [
				"high_num" => @$mv_list[7] + 0,
				"name" => "Piecemark",
				"witness" => @$mv_list['status_invitation'][0] + 0,
				"activity" => @$mv_list['status_invitation'][1] + 0,
				"data" => [
					[
						"name" => "Piecemark (Drawing is ready)",
						"data" => [
							@$mv_list['pending_transmit']['ready'][0] + @$mv_list['pending_transmit']['ready'][2] + @$mv_list['pending_transmit']['ready'][4] + 0 + @$mv_list['pending_transmit']['ready'][8] + 0,
							@$mv_list['pending_transmit']['ready'][1] + 0,
							@$mv_list['pending_transmit']['ready'][3] + @$mv_list['pending_transmit']['ready'][6] + @$mv_list['pending_transmit']['ready'][9] + @$mv_list['pending_transmit']['ready'][10] + @$mv_list['pending_transmit']['ready'][11] + 0,
							@$mv_list['pending_transmit']['ready'][5] + 0
						],
					], [
						"name" => "Piecemark (Drawing is not ready)",
						"data" => [
							@$mv_list['pending_transmit']['not_ready'][0] + @$mv_list['pending_transmit']['not_ready'][2] + @$mv_list['pending_transmit']['not_ready'][4] + 0 + @$mv_list['pending_transmit']['not_ready'][8] + 0,
							@$mv_list['pending_transmit']['not_ready'][1] + 0,
							@$mv_list['pending_transmit']['not_ready'][3] + @$mv_list['pending_transmit']['not_ready'][6] + @$mv_list['pending_transmit']['not_ready'][9] + @$mv_list['pending_transmit']['not_ready'][10] + @$mv_list['pending_transmit']['not_ready'][11] + 0,
							@$mv_list['pending_transmit']['not_ready'][5] + 0
						],
					],
				],
			],
			"fitup" => [
				"high_num" => @$fu_list[7] + 0,
				"witness" => @$fu_list['status_invitation'][0] + 0,
				"activity" => @$fu_list['status_invitation'][1] + 0,
				"name" => "Joint",
				"data" => [
					[
						"name" => "Joint (Drawing is ready)",
						"data" => [
							@$fu_list['pending_transmit']['ready'][0] + @$fu_list['pending_transmit']['ready'][2] + @$fu_list['pending_transmit']['ready'][4] + 0 + @$fu_list['pending_transmit']['ready'][8] + 0,
							@$fu_list['pending_transmit']['ready'][1] + 0,
							@$fu_list['pending_transmit']['ready'][3] + @$fu_list['pending_transmit']['ready'][6] + @$fu_list['pending_transmit']['ready'][9] + @$fu_list['pending_transmit']['ready'][10] + @$fu_list['pending_transmit']['ready'][11] + 0,
							@$fu_list['pending_transmit']['ready'][5] + 0
						],
					], [
						"name" => "Joint (Drawing is not ready)",
						"data" => [
							@$fu_list['pending_transmit']['not_ready'][0] + @$fu_list['pending_transmit']['not_ready'][2] + @$fu_list['pending_transmit']['not_ready'][4] + 0 + @$fu_list['pending_transmit']['not_ready'][8] + 0,
							@$fu_list['pending_transmit']['not_ready'][1] + 0,
							@$fu_list['pending_transmit']['not_ready'][3] + @$fu_list['pending_transmit']['not_ready'][6] + @$fu_list['pending_transmit']['not_ready'][9] + @$fu_list['pending_transmit']['not_ready'][10] + @$fu_list['pending_transmit']['not_ready'][11] + 0,
							@$fu_list['pending_transmit']['not_ready'][5] + 0
						],
					],
				],
			],
			"visual" => [
				"high_num" => @$vt_list[7] + @0,
				"name" => "Joint",
				"witness" => @$vt_list['status_invitation'][0] + 0,
				"activity" => @$vt_list['status_invitation'][1] + 0,
				"data" => [
					[
						"name" => "Joint (Drawing is ready)",
						"data" => [
							@$vt_list['pending_transmit']['ready'][0] + @$vt_list['pending_transmit']['ready'][2] + @$vt_list['pending_transmit']['ready'][4] + 0 + @$vt_list['pending_transmit']['ready'][8] + 0,
							@$vt_list['pending_transmit']['ready'][1] + 0,
							@$vt_list['pending_transmit']['ready'][3] + @$vt_list['pending_transmit']['ready'][6] + @$vt_list['pending_transmit']['ready'][9] + @$vt_list['pending_transmit']['ready'][10] + @$vt_list['pending_transmit']['ready'][11] + 0,
							@$vt_list['pending_transmit']['ready'][5] + 0
						],
					], [
						"name" => "Joint (Drawing is not ready)",
						"data" => [
							@$vt_list['pending_transmit']['not_ready'][0] + @$vt_list['pending_transmit']['not_ready'][2] + @$vt_list['pending_transmit']['not_ready'][4] + 0 + @$vt_list['pending_transmit']['not_ready'][8] + 0,
							@$vt_list['pending_transmit']['not_ready'][1] + 0,
							@$vt_list['pending_transmit']['not_ready'][3] + @$vt_list['pending_transmit']['not_ready'][6] + @$vt_list['pending_transmit']['not_ready'][9] + @$vt_list['pending_transmit']['not_ready'][10] + @$vt_list['pending_transmit']['not_ready'][11] + 0,
							@$vt_list['pending_transmit']['not_ready'][5] + 0
						],
					],
				],
			],
			"ndt" => [
				"high_num" => @$ndt_list[3] + @$ndt_list[5] + @$ndt_list[7] + 0,
				"data" => [@$ndt_list[99] + 0, @$ndt_list[0] + 0, @$ndt_list[2] + 0],
				"name" => "Joint",
				"type" => @$ndt_list["type"],
			],
		];
		// test_var($data);
		echo json_encode($data);
	}

	public function load_data_fabrication_weld_length()
	{
		$process = $this->input->get('process');

		$get = $this->input->get();

		if ($process == 'material') {
			$datadb = $this->general_mod->manual_query_db("SELECT status_inspection, status_invitation,
			COUNT(status_inspection) as sum_num
			FROM pcms_material
			WHERE (id_material, id_piecemark) in (select max(id_material), id_piecemark from pcms_material pm group by id_piecemark)
			AND company_id = '".$get['company']."' and project_code = '".$get['project']."'
			GROUP BY status_inspection, status_invitation
			ORDER BY status_inspection, status_invitation asc");

			$mv_list = [];
			foreach ($datadb as $key => $value) {
				@$mv_list[$value['status_inspection']] += $value['sum_num'] + 0;
				if (in_array($value['status_inspection'], [7])) {
					@$mv_list["status_invitation"][($value['status_invitation'] == "" ? 0 : $value['status_invitation'])] += $value['sum_num'] + 0;
				}
			}

			$data = [
				"material" => [
					"high_num" => @$mv_list[7] + 0,
					"witness" => @$mv_list['status_invitation'][0] + 0,
					"activity" => @$mv_list['status_invitation'][1] + 0,
					"name" => "Joint",
					"data" => [
						[
							"name" => "Piecemark",
							"data" => [
								@$mv_list[0] + @$mv_list[2] + @$mv_list[4] + 0,
								@$mv_list[1] + 0,
								@$mv_list[3] + @$mv_list[6] + @$mv_list[9] + @$mv_list[10] + @$mv_list[11] + 0,
								@$mv_list[5] + 0
							],
						],
					],
				],
			];
			// test_var($data);
			echo json_encode($data);
		} elseif ($process == 'fitup') {
			$datadb = $this->general_mod->manual_query_db("SELECT status_inspection, status_invitation,
			COUNT(status_inspection) as sum_num,
			SUM(weld_length) as sum_length from pcms_joint pj join pcms_fitup pf on pj.id = pf.id_joint 
			WHERE id_fitup in (select max(id_fitup) from pcms_fitup pm group by id_joint)
			AND pj.company_id = '".$get['company']."' and project_code = '".$get['project']."'
			GROUP BY status_inspection, status_invitation
			ORDER BY status_inspection ASC");

			$fu_list = [];
			$fu_leght_list = [];
			foreach ($datadb as $key => $value) {
				@$fu_list[$value['status_inspection']] += $value['sum_num'] + 0;
				if (in_array($value['status_inspection'], [7])) {
					@$fu_list["status_invitation"][($value['status_invitation'] == "" ? 0 : $value['status_invitation'])] += $value['sum_num'] + 0;
				}
				@$fu_leght_list[$value['status_inspection']] += $value['sum_length'] + 0;
				if (in_array($value['status_inspection'], [7])) {
					@$fu_leght_list["status_invitation"][($value['status_invitation'] == "" ? 0 : $value['status_invitation'])] += $value['sum_length'] + 0;
				}
			}

			$data = [
				"fitup" => [
					"high_num" => @$fu_list[7] + 0,
					"witness" => @$fu_list['status_invitation'][0] + 0,
					"activity" => @$fu_list['status_invitation'][1] + 0,
					"name" => "Joint",
					"data" => [
						[
							"name" => "Joint",
							"data" => [
								@$fu_list[0] + @$fu_list[2] + @$fu_list[4] + 0,
								@$fu_list[1] + 0,
								@$fu_list[3] + @$fu_list[6] + @$fu_list[9] + @$fu_list[10] + @$fu_list[11] + 0,
								@$fu_list[5] + 0
							],
						],
					],
				],
				"fitup_length" => [
					"high_num" => round((@$fu_leght_list[7] + 0) / 1000, 2),
					"witness" => round((@$fu_leght_list['status_invitation'][0] + 0) / 1000, 2),
					"activity" => round((@$fu_leght_list['status_invitation'][1] + 0) / 1000, 2),
					"name" => "Joint",
					"data" => [
						[
							"name" => "Joint",
							"data" => [
								round((@$fu_leght_list[0] + @$fu_leght_list[2] + @$fu_leght_list[4] + 0) / 1000, 2),
								round((@$fu_leght_list[1] + 0) / 1000, 2),
								round((@$fu_leght_list[3] + @$fu_leght_list[6] + @$fu_leght_list[9] + @$fu_leght_list[10] + @$fu_leght_list[11] + 0) / 1000, 2),
								round((@$fu_leght_list[5] + 0) / 1000, 2),
							],
						],
					],
				],
			];
			// test_var($data);
			echo json_encode($data);
		} elseif ($process == 'visual') {
			$datadb = $this->general_mod->manual_query_db("SELECT status_inspection, status_invitation,
			COUNT(status_inspection) as sum_num,
			SUM(weld_length) as sum_length from pcms_joint pj join pcms_visual pv on pj.id = pv.id_joint 
			WHERE id_visual in (select max(id_visual) from pcms_visual pm group by id_joint)
			AND pj.company_id = '".$get['company']."' and project_code = '".$get['project']."'
			GROUP BY status_inspection, status_invitation
			ORDER BY status_inspection ASC");

			$vt_list = [];
			$vt_leght_list = [];
			foreach ($datadb as $key => $value) {
				@$vt_list[$value['status_inspection']] += $value['sum_num'] + 0;
				if (in_array($value['status_inspection'], [7])) {
					@$vt_list["status_invitation"][($value['status_invitation'] == "" ? 0 : $value['status_invitation'])] += $value['sum_num'] + 0;
				}
				@$vt_leght_list[$value['status_inspection']] += $value['sum_length'] + 0;
				if (in_array($value['status_inspection'], [7])) {
					@$vt_leght_list["status_invitation"][($value['status_invitation'] == "" ? 0 : $value['status_invitation'])] += $value['sum_length'] + 0;
				}
			}

			$data = [
				"visual" => [
					"high_num" => @$vt_list[7] + 0,
					"witness" => @$vt_list['status_invitation'][0] + 0,
					"activity" => @$vt_list['status_invitation'][1] + 0,
					"name" => "Joint",
					"data" => [
						[
							"name" => "Joint",
							"data" => [
								@$vt_list[0] + @$vt_list[2] + @$vt_list[4] + 0,
								@$vt_list[1] + 0,
								@$vt_list[3] + @$vt_list[6] + @$vt_list[9] + @$vt_list[10] + @$vt_list[11] + 0,
								@$vt_list[5] + 0
							],
						],
					],
				],
				"visual_length" => [
					"high_num" => round((@$vt_leght_list[7] + 0) / 1000, 2),
					"witness" => round((@$vt_leght_list['status_invitation'][0] + 0) / 1000, 2),
					"activity" => round((@$vt_leght_list['status_invitation'][1] + 0) / 1000, 2),
					"name" => "Joint",
					"data" => [
						[
							"name" => "Joint",
							"data" => [
								round((@$vt_leght_list[0] + @$vt_leght_list[2] + @$vt_leght_list[4] + 0) / 1000, 2),
								round((@$vt_leght_list[1] + 0) / 1000, 2),
								round((@$vt_leght_list[3] + @$vt_leght_list[6] + @$vt_leght_list[9] + @$vt_leght_list[10] + @$vt_leght_list[11] + 0) / 1000, 2),
								round((@$vt_leght_list[5] + 0) / 1000, 2),
							],
						],
					],
				],
			];
			// test_var($data);
			echo json_encode($data);
		}
	}

	public function load_data_ndt()
	{
		$get = $this->input->get();
		
		$datadb = $this->general_mod->manual_query_db("SELECT ndt_type, result,
		COUNT(result) as sum_num
		FROM pcms_ndt a
		JOIN pcms_joint b on a.joint_id = b.id
		WHERE b.project = ".$get['project']."
		GROUP BY ndt_type, result
		ORDER BY result ASC");
		$ndt_list = [];
		$ndt_types = [];
		foreach ($datadb as $key => $value) {
			@$ndt_list[$value['result']][$value['ndt_type']] += $value['sum_num'] + 0;
			if (!in_array($value['ndt_type'], $ndt_types)) {
				$ndt_types[] = $value['ndt_type'];
			}
		}
		sort($ndt_types);
		$dataset = [];
		foreach ($ndt_list as $result => $value) {
			foreach ($ndt_types as $ndt_type) {
				$dataset[$result][] = @$value[$ndt_type] + 0;
			}
		}

		$datadb = $this->general_mod->ndt_type();
		$ndt_type_list = [];
		foreach ($datadb as $key => $value) {
			if (in_array($value['id'], $ndt_types)) {
				$ndt_type_list[] = $value['ndt_initial'];
			}
		}

		$data = [
			[
				"color" => "#45aaf2",
				"name" => 'Pending Vendor',
				"data" => $dataset[0] ?? [],
			],
			[
				"color" => "#fd9644",
				"name" => 'Rejected',
				"data" => $dataset[2] ?? [],
			],
			[
				"color" => "#26de81",
				"name" => 'Accepted',
				"data" => $dataset[3] ?? [],
			],
		];
		$output = [
			"categories" => $ndt_type_list,
			"data" => $data,
		];

		echo json_encode($output);
	}

	public function delete_space_document_no()
	{
		$datadb = $this->engineering_mod->piecemark_list(["project" => 12]);
		// test_var($datadb);
		foreach ($datadb as $key => $value) {
			$new_document_no = preg_replace('/\s/', '', convert2utf8($value['drawing_sp']));
			if ($value['drawing_sp'] !== $new_document_no) {
				test_var($value['drawing_sp'], 1);
				// $form_data = [
				// 	'drawing_sp' => $new_document_no
				// ];
				// $where = [
				// 	'id' => $value['id']
				// ];
				// $this->engineering_mod->piecemark_update_process_db($form_data, $where);
			}
			$new_document_no = preg_replace('/\s/', '', convert2utf8($value['drawing_cp']));
			if ($value['drawing_cp'] !== $new_document_no) {
				test_var($value['drawing_cp'], 1);
				// $form_data = [
				// 	'drawing_cp' => $new_document_no
				// ];
				// $where = [
				// 	'id' => $value['id']
				// ];
				// $this->engineering_mod->piecemark_update_process_db($form_data, $where);
			}
			$new_document_no = preg_replace('/\s/', '', convert2utf8($value['drawing_cl']));
			if ($value['drawing_cl'] !== $new_document_no) {
				test_var($value['drawing_cl'], 1);
				// $form_data = [
				// 	'drawing_cl' => $new_document_no
				// ];
				// $where = [
				// 	'id' => $value['id']
				// ];
				// $this->engineering_mod->piecemark_update_process_db($form_data, $where);
			}
		}

		test_var("===========================WORKPACK========================", 1);

		$datadb = $this->planning_mod->workpack_list(["project" => 12]);
		// test_var($datadb);
		foreach ($datadb as $key => $value) {
			$new_document_no = preg_replace('/\s/', '', convert2utf8($value['drawing_no']));
			if ($value['drawing_no'] !== $new_document_no) {
				test_var($value['drawing_no'], 1);
				// $form_data = [
				// 	'drawing_no' => $new_document_no
				// ];
				// $where = [
				// 	'id' => $value['id']
				// ];
				// $this->planning_mod->workpack_update_process_db($form_data, $where);
			}
		}

		test_var("===========================MIS========================", 1);

		$datadb = $this->general_mod->mis_list(["project_id" => '12']);
		// test_var($datadb);
		foreach ($datadb as $key => $value) {
			$new_document_no = preg_replace('/\s/', '', convert2utf8($value['drawing_no']));
			if ($value['drawing_no'] !== $new_document_no) {
				test_var($value['drawing_no'], 1);
				// $form_data = [
				// 	'drawing_no' => $new_document_no
				// ];
				// $where = [
				// 	'id_mis' => $value['id_mis']
				// ];
				// $this->general_mod->mis_update_process_db($form_data, $where);
			}
		}
	}


	//=-----------------SMART SYSTEM-------------------//

	protected function get_start_end_last_date($year, $week)
	{
		$dateTime             = new DateTime();
		$dateTime->setISODate($year, $week);
		$dateTime->modify('-1 days');
		$result['start_date'] = $dateTime->format('Y-m-d');
		$dateTime->modify('+6 days');
		$result['end_date'] = $dateTime->format('Y-m-d');

		return $result;
	}

	public function home_dashboard_rate($week_based = 0, $class_code = 1, $type_of_module = 0, $d_ndt_type = 3)
	{
		$get = $this->input->get();
		$week_list_kpi      = [];
		$current_year       = date('Y');
		$today_week         = date('W', strtotime(date('Y-m-d')));

		// foreach (range(1, $today_week) as $value) {
		// 	$week_list_kpi[$value]  = $value < 10 ? '0' . $value : $value;
		// 	$week_list_cut_off[$value]  = $this->get_start_end_last_date($current_year, $value);
		// }

		$start_date 						= "2024-01-01";
		$end_date 							= date('Y-m-d');
		$week_list_cut_off 			= $this->get_start_and_end_date($start_date, $end_date);

		$data['week_list_kpi']  = $week_list_kpi;
		$data['tabmenu']    = $this->dashboard_tabmenu('menu2');
		$data['week_based'] = $week_based;
		$data['d_ndt_type'] = $d_ndt_type;
		$data['type_of_module'] = $type_of_module;

		$week_based_column = "tested_date";
		if ($week_based == 1) {
			$week_based_column = "weld_datetime";
		}
		// test_var($week_based_column);
		error_reporting(0);

		if ($type_of_module == 1) {
			$data['id_deck_list'] = [5, 6, 7, 8, 9, 10, 41];
		} elseif ($type_of_module == 2) {
			$data['id_deck_list'] = [11, 16, 18, 25, 26, 27, 28, 29, 31, 32, 33, 34, 35, 36];
		} else {
			$data['id_deck_list'] = [5, 6, 7, 8, 9, 10, 11, 16, 18, 25, 26, 27, 28, 29, 31, 32, 33, 34, 35, 36, 41, 42];
		}

		$where["c.project"] = $get['project'];
		$where["c.company_id"] = $get['company'];
		$where["a.revision IS NULL AND a.revision_category IS NULL"]   = null;
		// $where["c.deck_elevation IN(" . join(", ", $data['id_deck_list']) . ")"]   = null;
		$where["d.ndt_type IN (1,3)"] = NULL;
		// $where["d.result IN (0,1,2,3)"]    = null;
		$where["d.result IN (1,2,3)"]    = null;
		if ($type_of_module) {
			$where["c.type_of_module"]	= $type_of_module; // Type of Module Filter
		}
		$where[$week_based_column . " IS NOT NULL"] = NULL;
		$main_source = $this->home_mod->get_visual_data_new_v21_2($where, $week_based);
		unset($where);

		if (in_array($get['project'], [19,21])) {
			$where["c.project"] = $get['project'];
			$where["c.company_id"] = $get['company'];
			$where["a.revision IS NULL AND a.revision_category IS NULL"]   = null;
			// $where["c.deck_elevation IN(" . join(", ", $data['id_deck_list']) . ")"]   = null;
			$where["g.ndt_type IN (13, 15)"] = NULL;
			// $where["d.result IN (0,1,2,3)"]    = null;
			$where["g.result IN (1,2,3)"]    = null;
			if ($type_of_module) {
				$where["c.type_of_module"]	= $type_of_module; // Type of Module Filter
			}
			$where[$week_based_column . " IS NOT NULL"] = NULL;
			$main_source_cc = $this->home_mod->get_visual_data_new_v21_3($where, $week_based);
			unset($where);

		}


		foreach($main_source_cc as $value) {
			$main_source[] = $value;
		}

		$data['main_source'] = $main_source;

		//  foreach($main_source as $key => $vax){
		// 	if($vax["tested_length"] > $vax["length_of_weld"]){
		// 		$main_sourcex[] = $vax;
		// 	}
		//  }

		//  test_var($main_sourcex);

			// test_var($main_source);
		if (sizeof($main_source) > 0) {
			$where["c.result IN (2)"] = null;
			$where["b.ndt_type IN (1, 3)"] = NULL;
			if ($type_of_module) {
				$where["d.type_of_module"]	= $type_of_module; // Type of Module Filter
			}
			$where["d.project"] = $get['project'];
			$where["d.company_id"] = $get['company'];
			$defect_source = $this->home_mod->get_detail_data_ctq_new_v21($where);
			unset($where);

			if (in_array($get['project'], [19,21])) {
				$where["c.result IN (2)"] = null;
				$where["b.ndt_type IN (13, 15)"] = NULL;
				if ($type_of_module) {
					$where["d.type_of_module"]	= $type_of_module; // Type of Module Filter
				}
				$where["d.project"] = $get['project'];
				$where["d.company_id"] = $get['company'];
				$defect_source_cc = $this->home_mod->get_detail_data_ctq_new_v21_2($where);
				unset($where);
			}
		} else {
			$defect_source = [];
		}

		foreach($defect_source_cc as $value) {
			$defect_source[] = $value;
		}


		$where["b.deck_elevation IN(" . join(", ", $data['id_deck_list']) . ")"]   = null;
		$where["a.revision IS NULL"] = null;
		$where["a.revision_category IS NULL"] = null;
		$where["a.retransmitt_status"] = 0;
		$where["a.status_delete IS NULL"] = null;
		$where["b.project"] = $get['project'];
		$where["b.company_id"] = $get['company'];
		if ($type_of_module) {
			$where["b.type_of_module"]	= $type_of_module; // Type of Module Filter
		}
		$data_visual = $this->home_mod->get_visual_data_all_view($where);
		unset($where);
		foreach ($data_visual as $key => $value) {
			$data["show_total_visual"][$value['deck_elevation']] = $value['total_length'];
		}

		$where["pcms_joint.project"] = $get['project'];
		$where["pcms_joint.company_id"] = $get['company'];
		$total_data_repaired = COUNT($this->home_mod->get_joint_repaired($where));
		// test_var($total_data_repaired);
		unset($where);

		if (in_array($get['project'], [19, 21])) {
			$where["pcms_joint.project"] = $get['project'];
			$where["pcms_joint.company_id"] = $get['company'];
			$total_data_repaired_cc = COUNT($this->home_mod->get_joint_repaired_2($where));
			// test_var($total_data_repaired_cc);
			unset($where);
		}

		if (in_array($get['project'], [19,21])) {
			$data['total_data_repaired'] = $total_data_repaired + $total_data_repaired_cc;
		} else {
			$data['total_data_repaired'] = $total_data_repaired;
		}

		// test_var($data['total_data_repaired']);
		

		$get_deck_elevation = $this->home_mod->get_deck_elevation();
		foreach ($get_deck_elevation as $key => $value) {
			$deck_name[$value['id']] = $value['name'];
		}
		$data['deck_name'] = $deck_name;

		foreach ($defect_source as $key => $value) {
			$array_defect[] = array(
				"deck_elevation" 		=> $value['deck_elevation'],
				"ctq_id" 		 		=> $value['ctq_id'],
				"ctq_initial" 		 	=> $value['ctq_initial'],
				"ndt_type" 		 		=> $value['ndt_type'],
				"ndt_id" 		 		=> $value['ndt_id'],
				"length" 		 		=> $value['length'],
			);
		}


		if (sizeof($main_source) > 0) {
			$where["d.project"] = $get['project'];
			$where["d.company_id"] = $get['company'];
			$where["c.result"]   = 2;
			$where["b.ndt_type IN (1, 3)"] = NULL;
			$id_joint_vs   = array_unique(array_column($main_source, 'id_joint'));
			$where["d.id IN ('" . implode("', '", $id_joint_vs) . "')"] = NULL;
			if (isset($type_of_module) && !empty($type_of_module)) {
				$type_of_module = $this->encryption->decrypt(strtr($type_of_module, '.-~', '+=/'));
				if ($type_of_module != "x") {
					$where["d.type_of_module"]	= $type_of_module; // Type of Module Filter
				}
			}
			$defect_source = $this->home_mod->get_detail_data_ctq_new_v21($where);
			unset($where);

			if (in_array($get['project'], [19,21])) {
				$where["d.project"] = $get['project'];
				$where["d.company_id"] = $get['company'];
				$where["c.result"]   = 2;
				$where["b.ndt_type IN (13, 15)"] = NULL;
				$id_joint_vs   = array_unique(array_column($main_source, 'id_joint'));
				$where["d.id IN ('" . implode("', '", $id_joint_vs) . "')"] = NULL;
				if (isset($type_of_module) && !empty($type_of_module)) {
					$type_of_module = $this->encryption->decrypt(strtr($type_of_module, '.-~', '+=/'));
					if ($type_of_module != "x") {
						$where["d.type_of_module"]	= $type_of_module; // Type of Module Filter
					}
				}
			$defect_source_cc = $this->home_mod->get_detail_data_ctq_new_v21_2($where);
			unset($where);
			}

			foreach($defect_source_cc as $value) {
				$defect_source[] = $value;
			}

			foreach ($defect_source as $key => $val) {
				$find_length_of_defect[$val['ndt_type']][$val['id_joint']][] 		= $val['length'];
			}
		} else {

			$defect_source = array();
		}

		function findDateIndex($array, $date) {
			foreach ($array as $index => $range) {
				$startDate 	= $range['start_date'];
				$endDate 	= $range['end_date'];
				
				// Check if the given date falls within the range
				if ($date >= $startDate && $date <= $endDate) {
					return $index;
				}
			}
			
			return -1; // Date not found in any range
		}

		foreach ($main_source as $key => $value) {

			$datetime1  = new DateTime($value["weld_datetime"]);
			$datetime2  = new DateTime($value["tested_date"]);
			$datetime3  = new DateTime($value["created_date"]);

			$difference = $datetime1->diff($datetime2);
			$difference->d;

			$difference_rfi = $datetime3->diff($datetime2);
			$difference_rfi->d;

			$week_index 	= findDateIndex($week_list_cut_off, $value[$week_based_column]);
			// $week_of_date = date('Y-W', strtotime($value[$week_based_column]));
			$week_of_date	= $week_index;

			// test_var($week_of_date);
			if (date('n', strtotime($value[$week_based_column])) == 1 && date('W', strtotime($value[$week_based_column])) == 52) {
				$week_of_date = (string)(date('Y', strtotime($value[$week_based_column])) - 1) . '-' . date('W', strtotime($value[$week_based_column]));
			}

			$array_deck[] = array(
				"deck_elevation" 		 => $value['deck_elevation'],
				"length_of_weld" 		 => (isset($value['revision_category']) && !empty($value['revision_category']) ? $value['visual_length_weld'] : $value['length_of_weld']) ,
				"tested_length" 		 => $value['tested_length'],
				"reject_length"  		 => @array_sum($find_length_of_defect[$value['ndt_type']][$value['id_joint']])+0,
				"result" 		 		 => $value["result"],
				"id_joint"  	 		 => $value["id_joint"],
				"drawing_wm"  	 		 => $value["drawing_wm"],
				"joint_no"  	 		 => $value["joint_no"],
				"weld_datetime"  	 	 => $value["weld_datetime"],
				"date_of_inspection"  	 => $value["tested_date"],
				"class"  	 		     => $value["class"],
				"week_of_date"  	 	 => $week_of_date,
				"tested_date"  	 	 	 => $value['tested_date'],
				"count_data"  	 		 => 1,
				"NDT_diff_days"  	 	 => $difference->d,
				"RFI_diff_days"  	 	 => $difference_rfi->d,
				"ndt_type" 		 => $value['ndt_type'],
			);
			if ($value["result"] > 0) {
				$array_week_group[] = array(
					"week_of_date" => $week_of_date
				);
			}
			if ($value["result"] > 0) {
				$array_deck_group[] = array(
					"deck_elevation" => $value['deck_elevation']
				);
			}
			if (date('Y-W', strtotime($value["tested_date"])) == "1970-01") {
				$trial_array[] = array(
					"deck_elevation" => $value['deck_elevation'],
					"length_of_weld" => $value['length_of_weld'],
					"tested_length"  => $value['tested_length'],
					"id_joint"  	 => $value['id_joint'],
					"id_ndt"  		 => $value['id_ndt'],
				);
			}
		}
		//--------- Calculation Row -----------//   
		$get_deck_pupulated = array_map("unserialize", array_unique(array_map("serialize", $array_deck_group ?? [])));
		$data["unique_deck"] = $get_deck_pupulated;
		usort($data["unique_deck"], function ($a, $b) {
			return $a['deck_elevation'] <=> $b['deck_elevation'];
		});
		$get_week_pupulated  = array_map("unserialize", array_unique(array_map("serialize", $array_week_group ?? [])));
		$data["unique_week"] = $get_week_pupulated;
		usort($data["unique_week"], function ($c, $d) {
			return $c['week_of_date'] <=> $d['week_of_date'];
		});
		$no = 1;
		// test_var($array_deck);

		foreach ($array_deck ?? [] as $key => $value) {
			// Deck Elevation / Service Line
			$data['array_deck_name'][$value['deck_elevation']] = $deck_name[$value['deck_elevation']];
			@$data['array_deck_length_sum'][$value['deck_elevation']] += $value['length_of_weld'];
			@$data['array_deck_tested_length_sum'][$value['deck_elevation']] += $value['tested_length'];
			@$data['array_deck_defect_length_sum'][$value['deck_elevation']] += $value['reject_length'];
			@$data['array_deck_total_joint_made'][$value['deck_elevation']] += $value['count_data'];
			if ($value['tested_length'] > 0) {
				@$data['array_deck_total_joint_tested'][$value['deck_elevation']] += $value['count_data'];
			}
			@$data['array_deck_total_days'][$value['deck_elevation']] += $value['NDT_diff_days'];
			@$data['array_deck_total_days_rfi'][$value['deck_elevation']] += $value['RFI_diff_days'];
			if (!isset($data['array_deck_total_days_rfi_min'][$value['deck_elevation']])) {
				$data['array_deck_total_days_rfi_min'][$value['deck_elevation']] = $value['RFI_diff_days'];
				$data['array_deck_total_days_rfi_max'][$value['deck_elevation']] = $value['RFI_diff_days'];
				$data['array_deck_total_days_ndt_max'][$value['deck_elevation']] = $value['NDT_diff_days'];
			}
			if ($data['array_deck_total_days_rfi_min'][$value['deck_elevation']] > $value['RFI_diff_days']) {
				$data['array_deck_total_days_rfi_min'][$value['deck_elevation']] = $value['RFI_diff_days'];
			}
			if ($data['array_deck_total_days_rfi_max'][$value['deck_elevation']] < $value['RFI_diff_days']) {
				$data['array_deck_total_days_rfi_max'][$value['deck_elevation']] = $value['RFI_diff_days'];
			}
			if ($data['array_deck_total_days_ndt_max'][$value['deck_elevation']] < $value['NDT_diff_days']) {
				$data['array_deck_total_days_ndt_max'][$value['deck_elevation']] = $value['NDT_diff_days'];
			}
			@$data['array_deck_total_data'][$value['deck_elevation']] += $value['count_data'];

			// Year Week
			@$data['array_week_length_sum'][$value['week_of_date']] += $value['length_of_weld'];
			@$data['array_week_tested_length_sum'][$value['week_of_date']] += $value['tested_length'];
			@$data['array_week_defect_length_sum'][$value['week_of_date']] += $value['reject_length'];
			@$data['array_week_total_days'][$value['week_of_date']] += $value['NDT_diff_days'];
			@$data['array_week_total_data'][$value['week_of_date']] += $value['count_data'];

			@$data['array_week_total_days_class'][$value['week_of_date']][$value['class']] += $value['NDT_diff_days'];
			@$data['array_week_total_data_class'][$value['week_of_date']][$value['class']] += $value['count_data'];

			// Comulative Overall
			@$data['array_week_total_days_all'] += $value['NDT_diff_days'];
			@$data['array_week_total_data_all'] += $value['count_data'];


			// ------------------------------------------------------------------- //

			@$data['array_week_length_sum_class'][$value["class"]][$value['week_of_date']] 		 += $value['length_of_weld'];
			@$data['array_week_tested_length_sum_class'][$value["class"]][$value['week_of_date']] += $value['tested_length'];
			@$data['array_week_defect_length_sum_class'][$value["class"]][$value['week_of_date']] += $value['reject_length'];
			@$data['array_week_total_days_class'][$value["class"]][$value['week_of_date']] += $value['NDT_diff_days'];

			@$data['array_week_total_days_class'][$value["class"]][$value['week_of_date']] += $value['NDT_diff_days'];
			@$data['array_week_total_data_class'][$value["class"]][$value['week_of_date']] += $value['count_data'];

			@$data['array_week_total_days_all_class'][$value['class']] += $value['NDT_diff_days'];
			@$data['array_week_total_data_all_class'][$value['class']] += $value['count_data'];

			// ------------------------------------------------------------------- //
		}

		foreach ($array_deck ?? [] as $key => $value) {

			// Deck Elevation / Service Line
			//3 $data['percent_deck'][$value['deck_elevation']] = round(( $data['array_deck_tested_length_sum'][$value['deck_elevation']] / $data['array_deck_length_sum'][$value['deck_elevation']] )*100,2);  
			$data['percent_defect_deck'][$value['deck_elevation']] = round(($data['array_deck_defect_length_sum'][$value['deck_elevation']] / $data['array_deck_tested_length_sum'][$value['deck_elevation']]) * 100, 2);
			$data['percent_ndt_completed_deck'][$value['deck_elevation']] = round(($data['array_deck_tested_length_sum'][$value['deck_elevation']] / $data['array_deck_length_sum'][$value['deck_elevation']]) * 100, 2);
			$data['ndt_average_time_deck'][$value['deck_elevation']] = round(($data['array_deck_total_days'][$value['deck_elevation']] / $data['array_deck_total_data'][$value['deck_elevation']]), 0);
			$data['rfi_average_time_deck'][$value['deck_elevation']] = round(($data['array_deck_total_days_rfi'][$value['deck_elevation']] / $data['array_deck_total_data'][$value['deck_elevation']]), 0);
			$data['ndt_average_time_all_deck'][$value['deck_elevation']] = round(($data['array_week_total_days_all'] / $data['array_week_total_data_all']), 0);

			// Year Week
			$data['percent_week'][$value['week_of_date']] = round(($data['array_week_tested_length_sum'][$value['week_of_date']] / $data['array_week_length_sum'][$value['week_of_date']]) * 100, 2);
			$data['percent_rate_week'][$value['week_of_date']] = round(($data['array_week_defect_length_sum'][$value['week_of_date']] / $data['array_week_tested_length_sum'][$value['week_of_date']]) * 100, 2);
			$data['ndt_average_time'][$value['week_of_date']] = round(($data['array_week_total_days'][$value['week_of_date']] / $data['array_week_total_data'][$value['week_of_date']]), 0);
			$data['ndt_average_time_all'][$value['week_of_date']] = round(($data['array_week_total_days_all'] / $data['array_week_total_data_all']), 0);

			// ------------------------------------------------------------------- //
			if ($data['array_week_tested_length_sum_class'][$value["class"]][$value['week_of_date']] > 0 && $data['array_week_length_sum_class'][$value["class"]][$value['week_of_date']] > 0) {
				$data['percent_week_class'][$value["class"]][$value['week_of_date']] = round(($data['array_week_tested_length_sum_class'][$value["class"]][$value['week_of_date']] / $data['array_week_length_sum_class'][$value["class"]][$value['week_of_date']]) * 100, 2);
			} else {
				$data['percent_week_class'][$value["class"]][$value['week_of_date']] = 0;
			}

			if ($data['array_week_defect_length_sum_class'][$value["class"]][$value['week_of_date']] > 0) {
				$data['percent_rate_week_class'][$value["class"]][$value['week_of_date']] = round(($data['array_week_defect_length_sum_class'][$value["class"]][$value['week_of_date']] / $data['array_week_tested_length_sum_class'][$value["class"]][$value['week_of_date']]) * 100, 2);
			} else {
				$data['percent_rate_week_class'][$value["class"]][$value['week_of_date']] = 0;
			}

			$data['ndt_average_time_class'][$value["class"]][$value['week_of_date']] = round(($data['array_week_total_days_class'][$value["class"]][$value['week_of_date']] / $data['array_week_total_data_class'][$value["class"]][$value['week_of_date']]), 0);
			$data['ndt_average_time_all_class'][$value["class"]][$value['week_of_date']] = round(($data['array_week_total_days_all_class'][$value["class"]] / $data['array_week_total_data_all_class'][$value["class"]]), 0);

			// ------------------------------------------------------------------- //

		}

		$nox = 1;
		foreach ($data['array_week_length_sum'] ?? [] as $key => $value) {
			$next_no = $nox - 1;
			$temp_data[$nox] = $value;
			if ($nox == 1) {
				$sum_com_week_length[$nox] = $value;
				$data['array_week_com_length_sum'][$key] = $sum_com_week_length[$nox];
			} else {
				$sum_com_week_length[$nox] = ($value + $sum_com_week_length[$next_no]);
				$data['array_week_com_length_sum'][$key] = $sum_com_week_length[$nox];
			}
			$nox++;
		}


		$noc = 1;
		foreach ($data['array_week_tested_length_sum'] ?? [] as $key => $value) {
			$next_no = $noc - 1;
			$temp_data[$noc] = $value;
			if ($noc == 1) {
				$sum_com_week_tested_length[$noc] = $value;
				$data['array_week_tested_com_length_sum'][$key] = $sum_com_week_tested_length[$noc];
			} else {
				$sum_com_week_tested_length[$noc] = ($value + $sum_com_week_tested_length[$next_no]);
				$data['array_week_tested_com_length_sum'][$key] = $sum_com_week_tested_length[$noc];
			}
			$noc++;
		}

		$nod = 1;
		foreach ($data['array_week_defect_length_sum'] ?? [] as $key => $value) {
			$next_no = $nod - 1;
			$temp_data[$nod] = $value;
			if ($nod == 1) {
				$sum_com_week_tested_length[$nod] = $value;
				$data['array_week_defect_com_length_sum'][$key] = $sum_com_week_tested_length[$nod];
			} else {
				$sum_com_week_tested_length[$nod] = ($value + $sum_com_week_tested_length[$next_no]);
				$data['array_week_defect_com_length_sum'][$key] = $sum_com_week_tested_length[$nod];
			}
			$nod++;
		}


		foreach ($data['array_week_length_sum_class'][$class_code] ?? [] as $key => $value) {
			$next_no = $nox - 1;
			$temp_data[$nox] = $value;
			if ($nox == 1) {
				$sum_com_week_length_class[$nox] = $value;
				$data['array_week_com_length_sum_class'][$class_code][$key] = $sum_com_week_length_class[$nox];
			} else {
				$sum_com_week_length_class[$nox] = ($value + @$sum_com_week_length_class[$next_no]);
				$data['array_week_com_length_sum_class'][$class_code][$key] = $sum_com_week_length_class[$nox];
			}
			$nox++;
		}

		$noc = 1;
		foreach ($data['array_week_tested_length_sum_class'][$class_code] ?? [] as $key => $value) {
			$next_no = $noc - 1;
			$temp_data[$noc] = $value;
			if ($noc == 1) {
				$sum_com_week_tested_length_class[$noc] = $value;
				$data['array_week_tested_com_length_sum_class'][$class_code][$key] = $sum_com_week_tested_length_class[$noc];
			} else {
				$sum_com_week_tested_length_class[$noc] = ($value + $sum_com_week_tested_length_class[$next_no]);
				$data['array_week_tested_com_length_sum_class'][$class_code][$key] = $sum_com_week_tested_length_class[$noc];
			}
			$noc++;
		}

		$nod = 1;
		foreach ($data['array_week_defect_length_sum_class'][$class_code] ?? [] as $key => $value) {
			$next_no = $nod - 1;
			$temp_data[$nod] = $value;
			if ($nod == 1) {
				$sum_com_week_tested_length_class[$nod] = $value;
				$data['array_week_defect_com_length_sum_class'][$class_code][$key] = $sum_com_week_tested_length_class[$nod];
			} else {
				$sum_com_week_tested_length_class[$nod] = ($value + $sum_com_week_tested_length_class[$next_no]);
				$data['array_week_defect_com_length_sum_class'][$class_code][$key] = $sum_com_week_tested_length_class[$nod];
			}
			$nod++;
		}


		foreach ($data["unique_week"] as $key => $value) {
			$data['percent_tested_comulative'][$value['week_of_date']] = round(($data['array_week_tested_com_length_sum'][$value['week_of_date']] / $data['array_week_com_length_sum'][$value['week_of_date']]) * 100, 2);
			$data['percent_defect_comulative'][$value['week_of_date']] = round(($data['array_week_defect_com_length_sum'][$value['week_of_date']] / $data['array_week_tested_com_length_sum'][$value['week_of_date']]) * 100, 2);

			//------------------------------------------//

			$key_1 = $key - 1;
			$key_2 = $key - 2;
			$key_3 = $key - 3;
			$key_4 = $key - 4;
			$key_5 = $key - 5;
			$key_6 = $key - 6;
			$key_7 = $key - 7;
			$key_8 = $key - 8;
			$key_9 = $key - 9;
			$key_10 = $key - 10;

			if (isset($data['array_week_tested_com_length_sum_class'][$class_code][$value['week_of_date']])) {
				$calculate_a = $data['array_week_tested_com_length_sum_class'][$class_code][$value['week_of_date']];
			} else {
				if (isset($data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_1]])) {
					$calculate_a = $data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_1]];
				} elseif (isset($data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_2]])) {
					$calculate_a = $data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_2]];
				} elseif (isset($data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_3]])) {
					$calculate_a = $data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_3]];
				} elseif (isset($data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_4]])) {
					$calculate_a = $data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_4]];
				} elseif (isset($data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_5]])) {
					$calculate_a = $data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_5]];
				} elseif (isset($data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_6]])) {
					$calculate_a = $data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_6]];
				} elseif (isset($data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_7]])) {
					$calculate_a = $data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_7]];
				} elseif (isset($data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_8]])) {
					$calculate_a = $data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_8]];
				} elseif (isset($data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_9]])) {
					$calculate_a = $data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_9]];
				} elseif (isset($data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_10]])) {
					$calculate_a = $data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_10]];
				}
			}

			if (@$data['array_week_com_length_sum_class'][$class_code][$value['week_of_date']] > 0) {
				$calculate_b = $data['array_week_com_length_sum_class'][$class_code][$value['week_of_date']];
			} else {
				if (isset($data['array_week_com_length_sum_class'][$class_code][@$data["unique_week"][$key_1]])) {
					$calculate_b = $data['array_week_com_length_sum_class'][$class_code][@$data["unique_week"][$key_1]];
				} elseif (isset($data['array_week_com_length_sum_class'][$class_code][@$data["unique_week"][$key_2]])) {
					$calculate_b = $data['array_week_com_length_sum_class'][$class_code][@$data["unique_week"][$key_2]];
				} elseif (isset($data['array_week_com_length_sum_class'][$class_code][@$data["unique_week"][$key_3]])) {
					$calculate_b = $data['array_week_com_length_sum_class'][$class_code][@$data["unique_week"][$key_3]];
				} elseif (isset($data['array_week_com_length_sum_class'][$class_code][@$data["unique_week"][$key_4]])) {
					$calculate_b = $data['array_week_com_length_sum_class'][$class_code][@$data["unique_week"][$key_4]];
				} elseif (isset($data['array_week_com_length_sum_class'][$class_code][@$data["unique_week"][$key_5]])) {
					$calculate_b = $data['array_week_com_length_sum_class'][$class_code][@$data["unique_week"][$key_5]];
				} elseif (isset($data['array_week_com_length_sum_class'][$class_code][@$data["unique_week"][$key_6]])) {
					$calculate_b = $data['array_week_com_length_sum_class'][$class_code][@$data["unique_week"][$key_6]];
				} elseif (isset($data['array_week_com_length_sum_class'][$class_code][@$data["unique_week"][$key_7]])) {
					$calculate_b = $data['array_week_com_length_sum_class'][$class_code][@$data["unique_week"][$key_7]];
				} elseif (isset($data['array_week_com_length_sum_class'][$class_code][@$data["unique_week"][$key_8]])) {
					$calculate_b = $data['array_week_com_length_sum_class'][$class_code][@$data["unique_week"][$key_8]];
				} elseif (isset($data['array_week_com_length_sum_class'][$class_code][@$data["unique_week"][$key_9]])) {
					$calculate_b = $data['array_week_com_length_sum_class'][$class_code][@$data["unique_week"][$key_9]];
				} elseif (isset($data['array_week_com_length_sum_class'][$class_code][@$data["unique_week"][$key_10]])) {
					$calculate_b = $data['array_week_com_length_sum_class'][$class_code][@$data["unique_week"][$key_10]];
				}
			}

			if (@$calculate_a > 0) {
				$data['percent_tested_comulative_class'][$class_code][$value['week_of_date']] = round(($calculate_a / $calculate_b) * 100, 2);
			} else {
				$data['percent_tested_comulative_class'][$class_code][$value['week_of_date']] =  0;
			}


			if (isset($data['array_week_defect_com_length_sum_class'][$class_code][$value['week_of_date']])) {
				$calculate_c = $data['array_week_defect_com_length_sum_class'][$class_code][$value['week_of_date']];
			} else {
				if (isset($data['array_week_defect_com_length_sum_class'][$class_code][@$data["unique_week"][$key_1]])) {
					$calculate_c = $data['array_week_defect_com_length_sum_class'][$class_code][@$data["unique_week"][$key_1]];
				} elseif (isset($data['array_week_defect_com_length_sum_class'][$class_code][@$data["unique_week"][$key_2]])) {
					$calculate_c = $data['array_week_defect_com_length_sum_class'][$class_code][@$data["unique_week"][$key_2]];
				} elseif (isset($data['array_week_defect_com_length_sum_class'][$class_code][@$data["unique_week"][$key_3]])) {
					$calculate_c = $data['array_week_defect_com_length_sum_class'][$class_code][@$data["unique_week"][$key_3]];
				} elseif (isset($data['array_week_defect_com_length_sum_class'][$class_code][@$data["unique_week"][$key_4]])) {
					$calculate_c = $data['array_week_defect_com_length_sum_class'][$class_code][@$data["unique_week"][$key_4]];
				} elseif (isset($data['array_week_defect_com_length_sum_class'][$class_code][@$data["unique_week"][$key_5]])) {
					$calculate_c = $data['array_week_defect_com_length_sum_class'][$class_code][@$data["unique_week"][$key_5]];
				} elseif (isset($data['array_week_defect_com_length_sum_class'][$class_code][@$data["unique_week"][$key_6]])) {
					$calculate_c = $data['array_week_defect_com_length_sum_class'][$class_code][@$data["unique_week"][$key_6]];
				} elseif (isset($data['array_week_defect_com_length_sum_class'][$class_code][@$data["unique_week"][$key_7]])) {
					$calculate_c = $data['array_week_defect_com_length_sum_class'][$class_code][@$data["unique_week"][$key_7]];
				} elseif (isset($data['array_week_defect_com_length_sum_class'][$class_code][@$data["unique_week"][$key_8]])) {
					$calculate_c = $data['array_week_defect_com_length_sum_class'][$class_code][@$data["unique_week"][$key_8]];
				} elseif (isset($data['array_week_defect_com_length_sum_class'][$class_code][@$data["unique_week"][$key_9]])) {
					$calculate_c = $data['array_week_defect_com_length_sum_class'][$class_code][@$data["unique_week"][$key_9]];
				} elseif (isset($data['array_week_defect_com_length_sum_class'][$class_code][@$data["unique_week"][$key_10]])) {
					$calculate_c = $data['array_week_defect_com_length_sum_class'][$class_code][@$data["unique_week"][$key_10]];
				}
			}

			if (@$data['array_week_tested_com_length_sum_class'][$class_code][$value['week_of_date']] > 0) {
				$calculate_d = $data['array_week_tested_com_length_sum_class'][$class_code][$value['week_of_date']];
			} else {
				if (isset($data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_1]])) {
					$calculate_d = $data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_1]];
				} elseif (isset($data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_2]])) {
					$calculate_d = $data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_2]];
				} elseif (isset($data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_3]])) {
					$calculate_d = $data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_3]];
				} elseif (isset($data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_4]])) {
					$calculate_d = $data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_4]];
				} elseif (isset($data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_5]])) {
					$calculate_d = $data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_5]];
				} elseif (isset($data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_6]])) {
					$calculate_d = $data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_6]];
				} elseif (isset($data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_7]])) {
					$calculate_d = $data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_7]];
				} elseif (isset($data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_8]])) {
					$calculate_d = $data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_8]];
				} elseif (isset($data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_9]])) {
					$calculate_d = $data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_9]];
				} elseif (isset($data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_10]])) {
					$calculate_d = $data['array_week_tested_com_length_sum_class'][$class_code][@$data["unique_week"][$key_10]];
				}
			}

			if (@$calculate_c > 0) {
				$data['percent_defect_comulative_class'][$class_code][$value['week_of_date']] = round(($calculate_c / $calculate_d) * 100, 2);
			} else {
				$data['percent_defect_comulative_class'][$class_code][$value['week_of_date']] = 0;
			}




			//------------------------------------------//
		}

		foreach ($array_defect ?? [] as $key => $value) {
			@$data['calculate_all_defect_by_deck'][$value['ctq_initial']][$value['deck_elevation']] += $value['length'];
		}
		// test_var($data['calculate_all_defect_by_deck']);

		//--------- Calculation Row -----------//

		//--------- Calculation Data Cum Per Deck -----------//
		$data_cum_deck = [];
		$data_cum_all_deck = [];
		foreach ($array_deck ?? [] as $key => $value) {
			if($value['ndt_type'] == $d_ndt_type){
				@$data_cum_all_deck[$value['week_of_date']]['weld_length'] += $value['length_of_weld'];
				@$data_cum_all_deck[$value['week_of_date']]['tested_length'] += $value['tested_length'];
				@$data_cum_all_deck[$value['week_of_date']]['defect_length'] += $value['reject_length'];
			}

			@$data_cum_deck[$value['deck_elevation']]['weld_length'] += $value['length_of_weld'];
			@$data_cum_deck[$value['deck_elevation']]['tested_length'] += $value['tested_length'];
			@$data_cum_deck[$value['deck_elevation']]['defect_length'] += $value['reject_length'];
		}
		$data['data_cum_deck'] = $data_cum_deck;
		$data['data_cum_all_deck'] = $data_cum_all_deck;

		// $date_start = "2024-01-01";
		// $week_list = [];
		// while (date("YW", strtotime($date_start)) <= date("YW")) {
		// 	$week_list[] = date("Y-W", strtotime($date_start));
		// 	$date_start = date("Y-m-d", strtotime($date_start . " +7 days"));
		// }

		$week_list = [];
		foreach($week_list_cut_off as $key => $value) {
			$week_list[] = $key;
		}
		
		$data['week_list'] = $week_list;

		//--------- Calculation Data Cum Per Deck END -----------//

		//--------- CONWEEKLY INSPECTION PROGRESS "OVERALL" -----------//

		$where["id IN ('" . implode("', '", $data["id_deck_list"]) . "')"] = NULL;
		$data["master_deck_elevation"] = $this->home_mod->get_deck_elevation($where);
		unset($where);
		// test_var($data["master_deck_elevation"]);

		//--------- CONWEEKLY INSPECTION PROGRESS "OVERALL" -----------//
		// test_var($data['array_week_com_length_sum']);

		$percent_defect_comulative_bf = 0;
		foreach ($week_list as $key => $value) {
			if(!isset($data['percent_defect_comulative'][$value]) || $data['percent_defect_comulative'][$value] == 0){
				$data['percent_defect_comulative'][$value] = @$percent_defect_comulative_bf+0;
			}
			else{
				$percent_defect_comulative_bf = $data['percent_defect_comulative'][$value];
			}
		}

		$data['class_code']  = $class_code;
		$data['discipline']  = $this->general_mod->discipline();
		$data['meta_title']  = 'Home - Dashboard Rate';
		$data['subview']     = 'home/home_smart_sheet';

		$this->load->view('index', $data);
	}

	protected function get_start_and_end_date($start_date, $end_date) {

		$start_date_unix  = strtotime($start_date);
    $end_date_unix    = strtotime($end_date);

    $weeks_list = [];
		$total_end  = 1;
		$num_week		= [];
    while ($start_date_unix <= $end_date_unix && $total_end <= 2) {
        // Find the start of the week (Sunday)
        $week_start_unix = strtotime('last Sunday', $start_date_unix);
        $week_end_unix   = strtotime('next Saturday', $week_start_unix);
        
        // Ensure the week_end is within the given date range
        if ($week_end_unix > $end_date_unix) {
            $week_end_unix = $end_date_unix;
        }

				$year_start 	= date('Y', strtotime(date('Y-m-d', $week_start_unix)));
				$year_end 		= date('Y', strtotime(date('Y-m-d', $week_end_unix)));

				$year = date('Y', strtotime(date('Y-m-d', $week_start_unix)));
				if($year_start != $year_end) {
					$year = date('Y', strtotime(date('Y-m-d', $week_end_unix)));
				}

				$week_key = $year."-".str_pad(@$num_week[$year] += 1, 2, '0', STR_PAD_LEFT);
        $weeks_list[$week_key] = [
					'week_num'		=> $week_key,
					'start_date' 	=> date('Y-m-d', $week_start_unix),
					'end_date'   	=> date('Y-m-d', $week_end_unix),
        ];

        $start_date_unix = strtotime('+1 week', $week_end_unix);
				if($start_date_unix > $end_date_unix) {
					$end_date_unix = strtotime('next Saturday', $week_end_unix);
					$total_end++;
				}
    }

    return $weeks_list;
	}

	// public function home_dashboard_rate($week_based = 0,$class_code = 1, $type_of_module = 0){

	// 	error_reporting(0);

	// 	$get_deck_elevation = $this->home_mod->get_deck_elevation();  
	// 	foreach($get_deck_elevation as $key => $value){
	// 		$deck_name[$value['id']] = $value['name'];
	// 	}
	// 	$data['deck_name'] = $deck_name; 

	//     $week_list_kpi      = [];
	//     $current_year       = date('Y');
	//     $today_week         = date('W', strtotime(date('Y-m-d')));

	//     foreach(range(1, $today_week) as $value) {
	//       $week_list_kpi[$value]  = $value < 10 ? '0'.$value : $value;
	//       $week_list_cut_off[$value]  = $this->get_start_end_last_date($current_year,$value);
	//     }

	// 	$data['week_list_kpi']  	= $week_list_kpi;
	// 	$data['tabmenu']    		= $this->dashboard_tabmenu('menu2');
	// 	$data['week_based'] 		= $week_based;
	// 	$data['type_of_module'] 	= $type_of_module;

	// 	$week_based_column = "tested_date";
	// 	if($week_based == 1){
	// 		$week_based_column = "weld_datetime";
	// 	}  

	// 	if($type_of_module==1){
	// 		$data['id_deck_list'] = [5,6,7,8,9,10,17]; 
	// 	} elseif($type_of_module==2){
	// 		$data['id_deck_list'] = [25,26,27,28,29,17]; 
	// 	} else {
	// 		$data['id_deck_list'] = [5,6,7,8,9,10,25,26,27,28,29,17];
	// 	}

	// 	$where["b.project"]   						  				   = $this->user_cookie[10];
	// 	$where["a.revision IS NULL AND a.revision_category IS NULL"]   = null;   
	// 	$where["a.status_delete"]   		 = null;   
	// 	$where["a.status_inspection <> 0"]   = null;   
	// 	$where["a.retransmitt_status"]   	 = 0; 
	// 	if($type_of_module){
	// 		$where["b.type_of_module"]	= $type_of_module; // Type of Module Filter
	// 	}  
	// 	$main_source = $this->home_mod->get_overall_visual_data_v21($where, $week_based);  
	// 	unset($where); 


	// 	if(sizeof($main_source) > 0){ 

	// 		$where["b.result"] = 2; 
	// 		$where["b.ndt_type"] = 3; 
	// 		$id_joint_vs   = array_unique(array_column($main_source,'id_joint')); 
	// 		$where["d.id IN ('".implode("', '", $id_joint_vs)."')"] = NULL;  
	// 		if($type_of_module){
	// 			$where["d.type_of_module"]	= $type_of_module; // Type of Module Filter
	// 		} 
	// 		$defect_source = $this->home_mod->get_detail_data_ctq_v21($where);
	// 		unset($where);
	// 		foreach($defect_source as $key => $val){
	// 			$find_length_of_defect[$val['id_joint']][] 		= $val['length'];
	// 		}

	// 		$where["b.id IN ('".implode("', '", $id_joint_vs)."')"] = NULL; 
	// 		$visual_data = $this->home_mod->get_visual_data_v21($where, $week_based);  
	// 		unset($where);
	// 		foreach($visual_data as $key => $val){
	// 			$find_length_of_weld[$val['id_joint']][] 		= $val['length_welded'];
	// 		}

	// 		$where["b.id IN ('".implode("', '", $id_joint_vs)."')"] = NULL; 
	// 		$ndt_data = $this->home_mod->get_ndt_ut_data($where);  
	// 		unset($where); 
	// 		foreach($ndt_data as $key => $val){
	// 			$ndt_tested_date[$val['id_joint']] 		= $val['tested_date'];
	// 			$ndt_transmittal_date[$val['id_joint']] = $val['transmit_date'];
	// 			$ndt_tested_length[$val['id_joint']] 	= $val['tested_length'];
	// 			$ndt_result[$val['id_joint']] 			= $val['result'];
	// 		}

	// 	} else {
	// 		$defect_source = null;
	// 		$visual_data = null;
	// 		$ndt_data = null;
	// 	}    


	// 	foreach($main_source as $key => $value){

	// 		$datetime1  = new DateTime($value["weld_datetime"]); 
	// 		$datetime2  = new DateTime(date("Y-m-d",strtotime($ndt_tested_date[$value['id_joint']])));
	// 		$datetime3  = new DateTime(date("Y-m-d",strtotime($ndt_transmittal_date[$value['id_joint']]))); 

	// 		$difference = $datetime1->diff($datetime2);
	// 		$difference->d;

	// 		$difference_rfi = $datetime3->diff($datetime2);
	// 		$difference_rfi->d;

	// 		if($week_based_column == "tested_date"){ 
	// 			$week_date = $ndt_tested_date[$value['id_joint']]; 
	// 		} else {
	// 			$week_date = $value["weld_datetime"];
	// 		}

	// 		$week_of_date = date('Y-W',strtotime($week_date));
	// 		if(date('n',strtotime($week_date)) == 1 && date('W',strtotime($week_date)) == 52){
	// 			$week_of_date = (string)(date('Y',strtotime($week_date)) - 1).'-'.date('W',strtotime($week_date));
	// 		} 

	// 		$array_deck[] = array(
	// 			"deck_elevation" 		 => $value['deck_elevation'],
	// 			"length_of_weld" 		 => $value['weld_length'],
	// 			"tested_length" 		 => $ndt_tested_length[$value['id_joint']],
	// 			"reject_length"  		 => array_sum($find_length_of_defect[$val['id_joint']]),
	// 			"result" 		 		 => $ndt_result[$value['id_joint']],
	// 			"id_joint"  	 		 => $value["id_joint"],
	// 			"weld_datetime"  	 	 => $value["weld_datetime"],
	// 			"date_of_inspection"  	 => date("Y-m-d",strtotime($ndt_tested_date[$value['id_joint']])),				
	// 			"class"  	 		     => $value["class"],				
	// 			"week_of_date"  	 	 => $week_of_date,
	// 			"count_data"  	 		 => 1,
	// 			"NDT_diff_days"  	 	 => $difference->d,
	// 			"RFI_diff_days"  	 	 => $difference_rfi->d,
	// 		);

	// 		if($ndt_result[$value['id_joint']] > 0){
	// 			$array_week_group[] = array(
	// 				"week_of_date" => $week_of_date 
	// 			);
	// 		} 
	// 		if($ndt_result[$value['id_joint']] > 0){
	// 			$array_deck_group[] = array(
	// 				"deck_elevation" => $value['deck_elevation'] 
	// 			);
	// 		} 

	// 	}

	// 	$get_deck_pupulated = array_map("unserialize", array_unique(array_map("serialize", $array_deck_group)));			
	// 	$data["unique_deck"] = $get_deck_pupulated;
	// 	usort($data["unique_deck"], function($a, $b) {
	// 		return $a['deck_elevation'] <=> $b['deck_elevation'];
	// 	});
	// 	$get_week_pupulated  = array_map("unserialize", array_unique(array_map("serialize", $array_week_group)));
	// 	$data["unique_week"] = $get_week_pupulated;
	// 	usort($data["unique_week"], function($c, $d) {
	// 		return $c['week_of_date'] <=> $d['week_of_date'];
	// 	}); 
	// 	$no = 1;

	// 	error_reporting(0);

	// 	foreach($array_deck as $key => $value){

	// 		// Deck Elevation / Service Line
	// 		$data['array_deck_name'][$value['deck_elevation']] 					 = $deck_name[$value['deck_elevation']];

	// 		$data['array_deck_length_sum'][$value['deck_elevation']] 			 += $value['length_of_weld']; 
	// 		$data['array_deck_tested_length_sum'][$value['deck_elevation']] 	 += $value['tested_length'];
	// 		$data['array_deck_defect_length_sum'][$value['deck_elevation']] 	 += $value['reject_length'];
	// 		$data['array_deck_total_joint_made'][$value['deck_elevation']] 		 += $value['count_data'];
	// 		if($value['tested_length'] > 0){
	// 			$data['array_deck_total_joint_tested'][$value['deck_elevation']] += $value['count_data'];
	// 		}
	// 		$data['array_deck_total_days'][$value['deck_elevation']] 			 += $value['NDT_diff_days'];   
	// 		$data['array_deck_total_days_rfi'][$value['deck_elevation']] 		 += $value['RFI_diff_days'];
	// 		if(!isset($data['array_deck_total_days_rfi_min'][$value['deck_elevation']])){
	// 			$data['array_deck_total_days_rfi_min'][$value['deck_elevation']] = $value['RFI_diff_days'];
	// 			$data['array_deck_total_days_rfi_max'][$value['deck_elevation']] = $value['RFI_diff_days'];
	// 			$data['array_deck_total_days_ndt_max'][$value['deck_elevation']] = $value['NDT_diff_days'];
	// 		} 
	// 		if($data['array_deck_total_days_rfi_min'][$value['deck_elevation']] > $value['RFI_diff_days']){
	// 			$data['array_deck_total_days_rfi_min'][$value['deck_elevation']] = $value['RFI_diff_days'];
	// 		}
	// 		if($data['array_deck_total_days_rfi_max'][$value['deck_elevation']] < $value['RFI_diff_days']){
	// 			$data['array_deck_total_days_rfi_max'][$value['deck_elevation']] = $value['RFI_diff_days'];
	// 		}
	// 		if($data['array_deck_total_days_ndt_max'][$value['deck_elevation']] < $value['NDT_diff_days']){
	// 			$data['array_deck_total_days_ndt_max'][$value['deck_elevation']] = $value['NDT_diff_days'];
	// 		}
	// 		$data['array_deck_total_data'][$value['deck_elevation']] += $value['count_data']; 

	// 		// Year Week
	// 		$data['array_week_length_sum'][$value['week_of_date']] += $value['length_of_weld']; 
	// 		$data['array_week_tested_length_sum'][$value['week_of_date']] += $value['tested_length']; 
	// 		$data['array_week_defect_length_sum'][$value['week_of_date']] += $value['reject_length'];   
	// 		$data['array_week_total_days'][$value['week_of_date']] += $value['NDT_diff_days'];   
	// 		$data['array_week_total_data'][$value['week_of_date']] += $value['count_data']; 

	// 		$data['array_week_total_days_class'][$value['week_of_date']][$value['class']] += $value['NDT_diff_days'];   
	// 		$data['array_week_total_data_class'][$value['week_of_date']][$value['class']] += $value['count_data']; 

	// 		// Comulative Overall
	// 		$data['array_week_total_days_all'] += $value['NDT_diff_days'];   
	// 		$data['array_week_total_data_all'] += $value['count_data'];   


	// 		// ------------------------------------------------------------------- //

	// 		$data['array_week_length_sum_class'][$value["class"]][$value['week_of_date']] 		 += $value['length_of_weld'];
	// 		$data['array_week_tested_length_sum_class'][$value["class"]][$value['week_of_date']] += $value['tested_length']; 
	// 		$data['array_week_defect_length_sum_class'][$value["class"]][$value['week_of_date']] += $value['reject_length'];  
	// 		$data['array_week_total_days_class'][$value["class"]][$value['week_of_date']] += $value['NDT_diff_days'];  

	// 		$data['array_week_total_days_class'][$value["class"]][$value['week_of_date']] += $value['NDT_diff_days'];   
	// 		$data['array_week_total_data_class'][$value["class"]][$value['week_of_date']] += $value['count_data']; 

	// 		$data['array_week_total_days_all_class'][$value['class']] += $value['NDT_diff_days'];   
	// 		$data['array_week_total_data_all_class'][$value['class']] += $value['count_data']; 

	// 		// ------------------------------------------------------------------- //
	// 	}

	// 	foreach($array_deck as $key => $value){

	// 		// Deck Elevation / Service Line
	// 		//3 $data['percent_deck'][$value['deck_elevation']] = round(( $data['array_deck_tested_length_sum'][$value['deck_elevation']] / $data['array_deck_length_sum'][$value['deck_elevation']] )*100,2);  
	// 		$data['percent_defect_deck'][$value['deck_elevation']] = round(( $data['array_deck_defect_length_sum'][$value['deck_elevation']] / $data['array_deck_tested_length_sum'][$value['deck_elevation']] )*100,2);  
	// 		$data['percent_ndt_completed_deck'][$value['deck_elevation']] = round(( $data['array_deck_tested_length_sum'][$value['deck_elevation']] / $data['array_deck_length_sum'][$value['deck_elevation']] )*100,2);  
	// 		$data['ndt_average_time_deck'][$value['deck_elevation']] = round(( $data['array_deck_total_days'][$value['deck_elevation']] / $data['array_deck_total_data'][$value['deck_elevation']] ),0); 
	// 		$data['rfi_average_time_deck'][$value['deck_elevation']] = round(( $data['array_deck_total_days_rfi'][$value['deck_elevation']] / $data['array_deck_total_data'][$value['deck_elevation']] ),0); 
	// 		$data['ndt_average_time_all_deck'][$value['deck_elevation']] = round(( $data['array_week_total_days_all'] / $data['array_week_total_data_all'] ),0); 

	// 		// Year Week
	// 		$data['percent_week'][$value['week_of_date']] = round(( $data['array_week_tested_length_sum'][$value['week_of_date']] / $data['array_week_length_sum'][$value['week_of_date']] )*100,2);  
	// 		$data['percent_rate_week'][$value['week_of_date']] = round(( $data['array_week_defect_length_sum'][$value['week_of_date']] / $data['array_week_tested_length_sum'][$value['week_of_date']] )*100,2); 
	// 		$data['ndt_average_time'][$value['week_of_date']] = round(( $data['array_week_total_days'][$value['week_of_date']] / $data['array_week_total_data'][$value['week_of_date']] ),0); 
	// 		$data['ndt_average_time_all'][$value['week_of_date']] = round(( $data['array_week_total_days_all'] / $data['array_week_total_data_all'] ),0); 

	// 		// ------------------------------------------------------------------- //
	// 		if($data['array_week_tested_length_sum_class'][$value["class"]][$value['week_of_date']] > 0 && $data['array_week_length_sum_class'][$value["class"]][$value['week_of_date']] > 0){
	// 			$data['percent_week_class'][$value["class"]][$value['week_of_date']] = round(( $data['array_week_tested_length_sum_class'][$value["class"]][$value['week_of_date']] / $data['array_week_length_sum_class'][$value["class"]][$value['week_of_date']] )*100,2); 
	// 		} else {
	// 			$data['percent_week_class'][$value["class"]][$value['week_of_date']] = 0;
	// 		}

	// 		if($data['array_week_defect_length_sum_class'][$value["class"]][$value['week_of_date']] > 0){
	// 			$data['percent_rate_week_class'][$value["class"]][$value['week_of_date']] = round(( $data['array_week_defect_length_sum_class'][$value["class"]][$value['week_of_date']] / $data['array_week_tested_length_sum_class'][$value["class"]][$value['week_of_date']] )*100,2); 
	// 		} else {
	// 			$data['percent_rate_week_class'][$value["class"]][$value['week_of_date']] = 0;
	// 		}

	// 		$data['ndt_average_time_class'][$value["class"]][$value['week_of_date']] = round(( $data['array_week_total_days_class'][$value["class"]][$value['week_of_date']] / $data['array_week_total_data_class'][$value["class"]][$value['week_of_date']] ),0); 
	// 		$data['ndt_average_time_all_class'][$value["class"]][$value['week_of_date']] = round(( $data['array_week_total_days_all_class'][$value["class"]] / $data['array_week_total_data_all_class'][$value["class"]] ),0);

	// 		// ------------------------------------------------------------------- //

	// 	} 

	// 	$nox = 1;
	// 		foreach($data['array_week_length_sum'] as $key => $value){ 
	// 			$next_no = $nox - 1;
	// 			$temp_data[$nox] = $value;
	// 			if($nox == 1){
	// 			    $sum_com_week_length[$nox] = $value;
	// 				$data['array_week_com_length_sum'][$key] = $sum_com_week_length[$nox];
	// 			} else {					 
	// 				$sum_com_week_length[$nox] = ( $value + $sum_com_week_length[$next_no] );
	// 				$data['array_week_com_length_sum'][$key] = $sum_com_week_length[$nox];
	// 			}
	// 			$nox++;
	// 		}


	// 		$noc = 1;
	// 		foreach($data['array_week_tested_length_sum'] as $key => $value){ 
	// 			$next_no = $noc - 1;
	// 			$temp_data[$noc] = $value;
	// 			if($noc == 1){
	// 			    $sum_com_week_tested_length[$noc] = $value;
	// 				$data['array_week_tested_com_length_sum'][$key] = $sum_com_week_tested_length[$noc];
	// 			} else {					 
	// 				$sum_com_week_tested_length[$noc] = ( $value + $sum_com_week_tested_length[$next_no] );
	// 				$data['array_week_tested_com_length_sum'][$key] = $sum_com_week_tested_length[$noc];
	// 			}
	// 			$noc++;
	// 		}


	// 		$nod = 1;
	// 		foreach($data['array_week_defect_length_sum'] as $key => $value){ 
	// 			$next_no = $nod - 1;
	// 			$temp_data[$nod] = $value;
	// 			if($nod == 1){
	// 			    $sum_com_week_tested_length[$nod] = $value;
	// 				$data['array_week_defect_com_length_sum'][$key] = $sum_com_week_tested_length[$nod];
	// 			} else {					 
	// 				$sum_com_week_tested_length[$nod] = ( $value + $sum_com_week_tested_length[$next_no] );
	// 				$data['array_week_defect_com_length_sum'][$key] = $sum_com_week_tested_length[$nod];
	// 			}
	// 			$nod++;
	// 		}


	// 		foreach($data['array_week_length_sum_class'][$class_code] as $key => $value){ 
	// 			$next_no = $nox - 1;
	// 			$temp_data[$nox] = $value;
	// 			if($nox == 1){
	// 			    $sum_com_week_length_class[$nox] = $value;
	// 				$data['array_week_com_length_sum_class'][$class_code][$key] = $sum_com_week_length_class[$nox];
	// 			} else {					 
	// 				$sum_com_week_length_class[$nox] = ( $value + $sum_com_week_length_class[$next_no] );
	// 				$data['array_week_com_length_sum_class'][$class_code][$key] = $sum_com_week_length_class[$nox];
	// 			}
	// 			$nox++;
	// 		}

	// 		$noc = 1;
	// 		foreach($data['array_week_tested_length_sum_class'][$class_code] as $key => $value){ 
	// 			$next_no = $noc - 1;
	// 			$temp_data[$noc] = $value;
	// 			if($noc == 1){
	// 			    $sum_com_week_tested_length_class[$noc] = $value;
	// 				$data['array_week_tested_com_length_sum_class'][$class_code][$key] = $sum_com_week_tested_length_class[$noc];
	// 			} else {					 
	// 				$sum_com_week_tested_length_class[$noc] = ( $value + $sum_com_week_tested_length_class[$next_no] );
	// 				$data['array_week_tested_com_length_sum_class'][$class_code][$key] = $sum_com_week_tested_length_class[$noc];
	// 			}
	// 			$noc++;
	// 		}

	// 		$nod = 1;
	// 		foreach($data['array_week_defect_length_sum_class'][$class_code] as $key => $value){ 
	// 			$next_no = $nod - 1;
	// 			$temp_data[$nod] = $value;
	// 			if($nod == 1){
	// 			    $sum_com_week_tested_length_class[$nod] = $value;
	// 				$data['array_week_defect_com_length_sum_class'][$class_code][$key] = $sum_com_week_tested_length_class[$nod];
	// 			} else {					 
	// 				$sum_com_week_tested_length_class[$nod] = ( $value + $sum_com_week_tested_length_class[$next_no] );
	// 				$data['array_week_defect_com_length_sum_class'][$class_code][$key] = $sum_com_week_tested_length_class[$nod];
	// 			}
	// 			$nod++;
	// 		}


	// 		foreach($data["unique_week"] as $key => $value){   
	// 			$data['percent_tested_comulative'][$value['week_of_date']] = round(($data['array_week_tested_com_length_sum'][$value['week_of_date']] / $data['array_week_com_length_sum'][$value['week_of_date']])*100,2);
	// 			$data['percent_defect_comulative'][$value['week_of_date']] = round(($data['array_week_defect_com_length_sum'][$value['week_of_date']] / $data['array_week_tested_com_length_sum'][$value['week_of_date']])*100,2);

	// 			//------------------------------------------//

	// 			$key_1 = $key - 1; 
	// 			$key_2 = $key - 2; 
	// 			$key_3 = $key - 3; 
	// 			$key_4 = $key - 4; 
	// 			$key_5 = $key - 5; 
	// 			$key_6 = $key - 6; 
	// 			$key_7 = $key - 7; 
	// 			$key_8 = $key - 8; 
	// 			$key_9 = $key - 9; 
	// 			$key_10 = $key - 10; 

	// 			if(isset($data['array_week_tested_com_length_sum_class'][$class_code][$value['week_of_date']])){
	// 				$calculate_a = $data['array_week_tested_com_length_sum_class'][$class_code][$value['week_of_date']];
	// 			} else {
	// 				if(isset($data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_1]])){
	// 					$calculate_a = $data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_1]];
	// 				} elseif(isset($data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_2]])){
	// 					$calculate_a = $data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_2]];
	// 				} elseif(isset($data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_3]])){
	// 					$calculate_a = $data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_3]];
	// 				} elseif(isset($data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_4]])){
	// 					$calculate_a = $data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_4]];
	// 				} elseif(isset($data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_5]])){
	// 					$calculate_a = $data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_5]];
	// 				} elseif(isset($data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_6]])){
	// 					$calculate_a = $data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_6]];
	// 				} elseif(isset($data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_7]])){
	// 					$calculate_a = $data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_7]];
	// 				} elseif(isset($data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_8]])){
	// 					$calculate_a = $data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_8]];
	// 				} elseif(isset($data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_9]])){
	// 					$calculate_a = $data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_9]];
	// 				} elseif(isset($data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_10]])){
	// 					$calculate_a = $data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_10]];
	// 				}
	// 			}

	// 			if($data['array_week_com_length_sum_class'][$class_code][$value['week_of_date']] > 0){
	// 				$calculate_b = $data['array_week_com_length_sum_class'][$class_code][$value['week_of_date']];
	// 			} else {
	// 				if(isset($data['array_week_com_length_sum_class'][$class_code][$data["unique_week"][$key_1]])){
	// 					$calculate_b = $data['array_week_com_length_sum_class'][$class_code][$data["unique_week"][$key_1]];
	// 				} elseif(isset($data['array_week_com_length_sum_class'][$class_code][$data["unique_week"][$key_2]])){
	// 					$calculate_b = $data['array_week_com_length_sum_class'][$class_code][$data["unique_week"][$key_2]];
	// 				} elseif(isset($data['array_week_com_length_sum_class'][$class_code][$data["unique_week"][$key_3]])){
	// 					$calculate_b = $data['array_week_com_length_sum_class'][$class_code][$data["unique_week"][$key_3]];
	// 				} elseif(isset($data['array_week_com_length_sum_class'][$class_code][$data["unique_week"][$key_4]])){
	// 					$calculate_b = $data['array_week_com_length_sum_class'][$class_code][$data["unique_week"][$key_4]];
	// 				} elseif(isset($data['array_week_com_length_sum_class'][$class_code][$data["unique_week"][$key_5]])){
	// 					$calculate_b = $data['array_week_com_length_sum_class'][$class_code][$data["unique_week"][$key_5]];
	// 				} elseif(isset($data['array_week_com_length_sum_class'][$class_code][$data["unique_week"][$key_6]])){
	// 					$calculate_b = $data['array_week_com_length_sum_class'][$class_code][$data["unique_week"][$key_6]];
	// 				} elseif(isset($data['array_week_com_length_sum_class'][$class_code][$data["unique_week"][$key_7]])){
	// 					$calculate_b = $data['array_week_com_length_sum_class'][$class_code][$data["unique_week"][$key_7]];
	// 				} elseif(isset($data['array_week_com_length_sum_class'][$class_code][$data["unique_week"][$key_8]])){
	// 					$calculate_b = $data['array_week_com_length_sum_class'][$class_code][$data["unique_week"][$key_8]];
	// 				} elseif(isset($data['array_week_com_length_sum_class'][$class_code][$data["unique_week"][$key_9]])){
	// 					$calculate_b = $data['array_week_com_length_sum_class'][$class_code][$data["unique_week"][$key_9]];
	// 				} elseif(isset($data['array_week_com_length_sum_class'][$class_code][$data["unique_week"][$key_10]])){
	// 					$calculate_b = $data['array_week_com_length_sum_class'][$class_code][$data["unique_week"][$key_10]];
	// 				} 
	// 			}

	// 			if($calculate_a > 0){
	// 				$data['percent_tested_comulative_class'][$class_code][$value['week_of_date']] = round(($calculate_a / $calculate_b)*100,2);
	// 			} else {
	// 				$data['percent_tested_comulative_class'][$class_code][$value['week_of_date']] =  0;
	// 			}


	// 			if(isset($data['array_week_defect_com_length_sum_class'][$class_code][$value['week_of_date']])){
	// 				$calculate_c = $data['array_week_defect_com_length_sum_class'][$class_code][$value['week_of_date']];
	// 			} else {
	// 				if(isset($data['array_week_defect_com_length_sum_class'][$class_code][$data["unique_week"][$key_1]])){
	// 					$calculate_c = $data['array_week_defect_com_length_sum_class'][$class_code][$data["unique_week"][$key_1]];
	// 				} elseif(isset($data['array_week_defect_com_length_sum_class'][$class_code][$data["unique_week"][$key_2]])){
	// 					$calculate_c = $data['array_week_defect_com_length_sum_class'][$class_code][$data["unique_week"][$key_2]];
	// 				} elseif(isset($data['array_week_defect_com_length_sum_class'][$class_code][$data["unique_week"][$key_3]])){
	// 					$calculate_c = $data['array_week_defect_com_length_sum_class'][$class_code][$data["unique_week"][$key_3]];
	// 				} elseif(isset($data['array_week_defect_com_length_sum_class'][$class_code][$data["unique_week"][$key_4]])){
	// 					$calculate_c = $data['array_week_defect_com_length_sum_class'][$class_code][$data["unique_week"][$key_4]];
	// 				} elseif(isset($data['array_week_defect_com_length_sum_class'][$class_code][$data["unique_week"][$key_5]])){
	// 					$calculate_c = $data['array_week_defect_com_length_sum_class'][$class_code][$data["unique_week"][$key_5]];
	// 				} elseif(isset($data['array_week_defect_com_length_sum_class'][$class_code][$data["unique_week"][$key_6]])){
	// 					$calculate_c = $data['array_week_defect_com_length_sum_class'][$class_code][$data["unique_week"][$key_6]];
	// 				} elseif(isset($data['array_week_defect_com_length_sum_class'][$class_code][$data["unique_week"][$key_7]])){
	// 					$calculate_c = $data['array_week_defect_com_length_sum_class'][$class_code][$data["unique_week"][$key_7]];
	// 				} elseif(isset($data['array_week_defect_com_length_sum_class'][$class_code][$data["unique_week"][$key_8]])){
	// 					$calculate_c = $data['array_week_defect_com_length_sum_class'][$class_code][$data["unique_week"][$key_8]];
	// 				} elseif(isset($data['array_week_defect_com_length_sum_class'][$class_code][$data["unique_week"][$key_9]])){
	// 					$calculate_c = $data['array_week_defect_com_length_sum_class'][$class_code][$data["unique_week"][$key_9]];
	// 				} elseif(isset($data['array_week_defect_com_length_sum_class'][$class_code][$data["unique_week"][$key_10]])){
	// 					$calculate_c = $data['array_week_defect_com_length_sum_class'][$class_code][$data["unique_week"][$key_10]];
	// 				}
	// 			}

	// 			if($data['array_week_tested_com_length_sum_class'][$class_code][$value['week_of_date']] > 0){
	// 				$calculate_d = $data['array_week_tested_com_length_sum_class'][$class_code][$value['week_of_date']];
	// 			} else {
	// 				if(isset($data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_1]])){
	// 					$calculate_d = $data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_1]];
	// 				} elseif(isset($data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_2]])){
	// 					$calculate_d = $data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_2]];
	// 				} elseif(isset($data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_3]])){
	// 					$calculate_d = $data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_3]];
	// 				} elseif(isset($data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_4]])){
	// 					$calculate_d = $data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_4]];
	// 				} elseif(isset($data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_5]])){
	// 					$calculate_d = $data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_5]];
	// 				} elseif(isset($data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_6]])){
	// 					$calculate_d = $data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_6]];
	// 				} elseif(isset($data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_7]])){
	// 					$calculate_d = $data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_7]];
	// 				} elseif(isset($data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_8]])){
	// 					$calculate_d = $data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_8]];
	// 				} elseif(isset($data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_9]])){
	// 					$calculate_d = $data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_9]];
	// 				} elseif(isset($data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_10]])){
	// 					$calculate_d = $data['array_week_tested_com_length_sum_class'][$class_code][$data["unique_week"][$key_10]];
	// 				} 
	// 			}

	// 			if($calculate_c > 0){
	// 				$data['percent_defect_comulative_class'][$class_code][$value['week_of_date']] = round(($calculate_c / $calculate_d)*100,2);
	// 			} else {
	// 				$data['percent_defect_comulative_class'][$class_code][$value['week_of_date']] = 0;
	// 			}




	// 			//------------------------------------------//
	// 		}

	// 		foreach($array_defect as $key => $value){
	// 			$data['calculate_all_defect_by_deck'][$value['ctq_initial']][$value['deck_elevation']] += $value['length'];
	// 		}
	// 		// test_var($data['calculate_all_defect_by_deck']);

	// 	//--------- Calculation Row -----------//

	// 	//--------- Calculation Data Cum Per Deck -----------//
	// 		$data_cum_deck = [];
	// 		$data_cum_all_deck = [];
	// 		foreach ($array_deck as $key => $value) {
	// 			@$data_cum_all_deck[$value['week_of_date']]['weld_length'] += $value['length_of_weld'];
	// 			@$data_cum_all_deck[$value['week_of_date']]['tested_length'] += $value['tested_length'];
	// 			@$data_cum_all_deck[$value['week_of_date']]['defect_length'] += $value['reject_length'];

	// 			@$data_cum_deck[$value['deck_elevation']]['weld_length'] += $value['length_of_weld'];
	// 			@$data_cum_deck[$value['deck_elevation']]['tested_length'] += $value['tested_length'];
	// 			@$data_cum_deck[$value['deck_elevation']]['defect_length'] += $value['reject_length'];
	// 		}
	// 		$data['data_cum_deck'] = $data_cum_deck;
	// 		$data['data_cum_all_deck'] = $data_cum_all_deck;

	// 		$date_start = "2021-10-14";
	// 		$week_list = [];
	// 		while (date("YW", strtotime($date_start)) <= date("YW")) {
	// 			$week_list[] = date("Y-W", strtotime($date_start));
	// 			$date_start = date("Y-m-d", strtotime($date_start." +7 days"));
	// 		}
	// 		$data['week_list'] = $week_list;

	// 	//--------- Calculation Data Cum Per Deck END -----------//

	// 	//--------- CONWEEKLY INSPECTION PROGRESS "OVERALL" -----------//

	// 		$where["id IN ('".implode("', '", $data["id_deck_list"])."')"] = NULL; 
	// 		$data["master_deck_elevation"] = $this->home_mod->get_deck_elevation($where);
	// 		unset($where);
	// 		// test_var($data["master_deck_elevation"]);

	// 	//--------- CONWEEKLY INSPECTION PROGRESS "OVERALL" -----------//
	// 	// test_var($data['array_week_com_length_sum']);


	// 	$data['class_code']  = $class_code;
	// 	$data['discipline']  = $this->general_mod->discipline();
	// 	$data['meta_title']  = 'Home - Dashboard Rate';
	// 	$data['subview']     = 'home/home_smart_sheet';

	// 	$this->load->view('index', $data);
	// }

	//=--------------SMART SYSTEM-----------------//

	public function dashboard_monitoring_data()
	{
		$data['tabmenu'] = $this->dashboard_tabmenu('menu99');

		$get = $this->input->get();
		if (!isset($get['date_from'])) {
			$get = [
				"date_from" => date("Y-m-d"),
				"date_to" => date("Y-m-d"),
			];
		}
		$date_from = $get['date_from'];
		$date_to = $get['date_to'];
		$id_user = [];

		$earlier = new DateTime($date_from);
		$later = new DateTime($date_to);
		$abs_diff = $later->diff($earlier)->format("%a"); //3
		if ($abs_diff > 30) {
			$this->session->set_flashdata('error', 'The date gap should not be more than 30 days!');
			redirect($_SERVER["HTTP_REFERER"]);
		}

		$data['template_data'] = [];
		$datadb = $this->engineering_mod->piecemark_list([
			"DATE(created_date) BETWEEN '$date_from' AND '$date_to'" => NULL,
		]);
		foreach ($datadb as $key => $value) {
			@$data['template_data'][$value['created_by']]['piecemark'] += 1;
			@$data['piecemark_sum'] += 1;
			if (!in_array($value['created_by'], $id_user)) {
				$id_user[] = $value['created_by'];
			}
		}

		$datadb = $this->engineering_mod->joint_list([
			"DATE(created_date) BETWEEN '$date_from' AND '$date_to'" => NULL,
		]);
		foreach ($datadb as $key => $value) {
			@$data['template_data'][$value['created_by']]['joint'] += 1;
			@$data['joint_sum'] += 1;
			if (!in_array($value['created_by'], $id_user)) {
				$id_user[] = $value['created_by'];
			}
		}

		$datadb = $this->general_mod->manual_query_db("SELECT module, created_by, count(id_template) as num
		from (
			select distinct module, id_template, created_by, date(created_date), fabrication_type 
			from pcms_update_revision_log purl 
			left join pcms_revise_history prh 
			on purl.id_request_update = prh.id 
			where (module = 1 or (module = 2 and fabrication_type != 8)) and (fabrication_type not in (7) or fabrication_type is null) and date(created_date) BETWEEN '$date_from' AND '$date_to'
			and column_name not in ('status', 'status_inspection')
		) as tmp
		group by module, created_by");
		// test_var($datadb);
		foreach ($datadb as $key => $value) {
			if (!in_array($value['created_by'], $id_user)) {
				$id_user[] = $value['created_by'];
			}
			if ($value['module'] == 1) {
				@$data['template_data'][$value['created_by']]['piecemark_r'] += $value['num'];
				@$data['piecemark_r_sum'] += $value['num'];
			} elseif ($value['module'] == 2) {
				@$data['template_data'][$value['created_by']]['joint_r'] += $value['num'];
				@$data['joint_r_sum'] += $value['num'];
			}
		}

		$data['surveyor_data'] = [];
		$datadb = $this->general_mod->manual_query_db("SELECT DISTINCT id_piecemark, id_workpack, device_status, surveyor_creator FROM pcms_material WHERE DATE(surveyor_created_date) BETWEEN '$date_from' AND '$date_to'");
		foreach ($datadb as $key => $value) {
			@$data['surveyor_data'][$value['surveyor_creator']]['mv' . $value['device_status']] += 1;
			@$data['surveyor_data_sum']['mv' . $value['device_status']] += 1;
			if (!in_array($value['surveyor_creator'], $id_user)) {
				$id_user[] = $value['surveyor_creator'];
			}
		}
		$datadb = $this->general_mod->manual_query_db("SELECT DISTINCT id_joint, id_workpack, device_status, surveyor_creator FROM pcms_fitup WHERE DATE(surveyor_created_date) BETWEEN '$date_from' AND '$date_to'");
		foreach ($datadb as $key => $value) {
			@$data['surveyor_data'][$value['surveyor_creator']]['fu' . $value['device_status']] += 1;
			@$data['surveyor_data_sum']['fu' . $value['device_status']] += 1;
			if (!in_array($value['surveyor_creator'], $id_user)) {
				$id_user[] = $value['surveyor_creator'];
			}
		}
		$datadb = $this->general_mod->manual_query_db("SELECT DISTINCT id_joint, id_workpack, device_status, surveyor_creator FROM pcms_visual WHERE DATE(surveyor_created_date) BETWEEN '$date_from' AND '$date_to'");
		foreach ($datadb as $key => $value) {
			@$data['surveyor_data'][$value['surveyor_creator']]['vt' . $value['device_status']] += 1;
			@$data['surveyor_data_sum']['vt' . $value['device_status']] += 1;
			if (!in_array($value['surveyor_creator'], $id_user)) {
				$id_user[] = $value['surveyor_creator'];
			}
		}
		$datadb = $this->general_mod->manual_query_db("SELECT DISTINCT id_piecemark, id_workpack, device_status, surveyor_creator FROM pcms_itr WHERE DATE(surveyor_created_date) BETWEEN '$date_from' AND '$date_to'");
		foreach ($datadb as $key => $value) {
			@$data['surveyor_data'][$value['surveyor_creator']]['itr' . $value['device_status']] += 1;
			@$data['surveyor_data_sum']['itr' . $value['device_status']] += 1;
			if (!in_array($value['surveyor_creator'], $id_user)) {
				$id_user[] = $value['surveyor_creator'];
			}
		}

		$data['workpack_data'] = [];
		$datadb = $this->planning_mod->workpack_list([
			"submitted_date BETWEEN '$date_from' AND '$date_to'" => NULL,
		]);
		foreach ($datadb as $key => $value) {
			@$data['workpack_data'][$value['submitted_by']]['create'] += 1;
			@$data['workpack_data_sum']['create'] += 1;
			if (!in_array($value['submitted_by'], $id_user)) {
				$id_user[] = $value['submitted_by'];
			}
		}

		$datadb = $this->engineering_mod->revise_history_list([
			"status_revise" => 4,
			"fabrication_type IN (6) AND DATE(update_date) BETWEEN '$date_from' AND '$date_to'" => NULL,
		]);
		foreach ($datadb as $key => $value) {
			@$data['workpack_data'][$value['update_by']]['revise'] += 1;
			@$data['workpack_data_sum']['revise'] += 1;
			if (!in_array($value['update_by'], $id_user)) {
				$id_user[] = $value['update_by'];
			}
		}

		$data['pmt_data'] = [];
		$datadb = $this->general_mod->manual_query_db("SELECT DISTINCT id_material, requestor FROM pcms_material WHERE DATE(date_request) BETWEEN '$date_from' AND '$date_to'");
		foreach ($datadb as $key => $value) {
			@$data['pmt_data'][$value['requestor']]['mv']['submit'] += 1;
			@$data['pmt_data_sum']['mv']['submit'] += 1;
			if (!in_array($value['requestor'], $id_user)) {
				$id_user[] = $value['requestor'];
			}
		}
		$datadb = $this->general_mod->manual_query_db("SELECT DISTINCT id_fitup, requestor FROM pcms_fitup WHERE DATE(date_request) BETWEEN '$date_from' AND '$date_to'");
		foreach ($datadb as $key => $value) {
			@$data['pmt_data'][$value['requestor']]['fu']['submit'] += 1;
			@$data['pmt_data_sum']['fu']['submit'] += 1;
			if (!in_array($value['requestor'], $id_user)) {
				$id_user[] = $value['requestor'];
			}
		}
		$datadb = $this->general_mod->manual_query_db("SELECT DISTINCT id_visual, requestor FROM pcms_visual WHERE DATE(date_request) BETWEEN '$date_from' AND '$date_to'");
		foreach ($datadb as $key => $value) {
			@$data['pmt_data'][$value['requestor']]['vt']['submit'] += 1;
			@$data['pmt_data_sum']['vt']['submit'] += 1;
			if (!in_array($value['requestor'], $id_user)) {
				$id_user[] = $value['requestor'];
			}
		}
		$datadb = $this->engineering_mod->revise_history_list([
			"status_revise" => 4,
			"fabrication_type IN (1, 2, 3) AND DATE(update_date) BETWEEN '$date_from' AND '$date_to'" => NULL,
		]);
		foreach ($datadb as $key => $value) {
			$module = '';
			if ($value['fabrication_type'] == 1) {
				$module = 'mv';
			} elseif ($value['fabrication_type'] == 2) {
				$module = 'fu';
			} elseif ($value['fabrication_type'] == 3) {
				$module = 'vt';
			}
			@$data['pmt_data'][$value['update_by']][$module]['revise'] += 1;
			@$data['pmt_data_sum'][$module]['revise'] += 1;
			if (!in_array($value['update_by'], $id_user)) {
				$id_user[] = $value['update_by'];
			}
		}

		$data['qc_data'] = [];
		$datadb = $this->general_mod->manual_query_db("SELECT DISTINCT id_material, inspection_by FROM pcms_material WHERE DATE(inspection_datetime) BETWEEN '$date_from' AND '$date_to'");
		foreach ($datadb as $key => $value) {
			@$data['qc_data'][$value['inspection_by']]['mv']['inspect'] += 1;
			@$data['qc_data_sum']['mv']['inspect'] += 1;
			if (!in_array($value['inspection_by'], $id_user)) {
				$id_user[] = $value['inspection_by'];
			}
		}
		$datadb = $this->general_mod->manual_query_db("SELECT DISTINCT id_fitup, inspection_by FROM pcms_fitup WHERE DATE(inspection_datetime) BETWEEN '$date_from' AND '$date_to'");
		foreach ($datadb as $key => $value) {
			@$data['qc_data'][$value['inspection_by']]['fu']['inspect'] += 1;
			@$data['qc_data_sum']['fu']['inspect'] += 1;
			if (!in_array($value['inspection_by'], $id_user)) {
				$id_user[] = $value['inspection_by'];
			}
		}
		$datadb = $this->general_mod->manual_query_db("SELECT DISTINCT id_visual, inspection_by FROM pcms_visual WHERE DATE(inspection_datetime) BETWEEN '$date_from' AND '$date_to'");
		foreach ($datadb as $key => $value) {
			@$data['qc_data'][$value['inspection_by']]['vt']['inspect'] += 1;
			@$data['qc_data_sum']['vt']['inspect'] += 1;
			if (!in_array($value['inspection_by'], $id_user)) {
				$id_user[] = $value['inspection_by'];
			}
		}
		$datadb = $this->general_mod->manual_query_db("SELECT DISTINCT id_material, transmittal_by FROM pcms_material WHERE DATE(transmittal_datetime) BETWEEN '$date_from' AND '$date_to'");
		foreach ($datadb as $key => $value) {
			@$data['qc_data'][$value['transmittal_by']]['mv']['transmit'] += 1;
			@$data['qc_data_sum']['mv']['transmit'] += 1;
			if (!in_array($value['transmittal_by'], $id_user)) {
				$id_user[] = $value['transmittal_by'];
			}
		}
		$datadb = $this->general_mod->manual_query_db("SELECT DISTINCT id_fitup, transmitted_by FROM pcms_fitup WHERE DATE(transmitted_date) BETWEEN '$date_from' AND '$date_to'");
		foreach ($datadb as $key => $value) {
			@$data['qc_data'][$value['transmitted_by']]['fu']['transmit'] += 1;
			@$data['qc_data_sum']['fu']['transmit'] += 1;
			if (!in_array($value['transmitted_by'], $id_user)) {
				$id_user[] = $value['transmitted_by'];
			}
		}
		$datadb = $this->general_mod->manual_query_db("SELECT DISTINCT id_visual, transmittal_by FROM pcms_visual WHERE DATE(transmittal_datetime) BETWEEN '$date_from' AND '$date_to'");
		foreach ($datadb as $key => $value) {
			@$data['qc_data'][$value['transmittal_by']]['vt']['transmit'] += 1;
			@$data['qc_data_sum']['vt']['transmit'] += 1;
			if (!in_array($value['transmittal_by'], $id_user)) {
				$id_user[] = $value['transmittal_by'];
			}
		}

		$data['mc_data'] = [];
		$datadb = $this->general_mod->manual_query_db("SELECT created_by, count(id) as num  FROM pcms_mechanical_completion WHERE DATE(created_date) BETWEEN '$date_from' AND '$date_to' group by created_by");
		foreach ($datadb as $key => $value) {
			@$data['mc_data'][$value['created_by']]['data'] = $value['num'];
			@$data['mc_data_sum']['data'] += $value['num'];
			if (!in_array($value['created_by'], $id_user)) {
				$id_user[] = $value['created_by'];
			}
		}

		$datadb = $this->general_mod->manual_query_db("SELECT created_by, count(id) as num  FROM pcms_mechanical_completion_attachment WHERE DATE(created_date) BETWEEN '$date_from' AND '$date_to' group by created_by");
		foreach ($datadb as $key => $value) {
			@$data['mc_data'][$value['created_by']]['attachment'] = $value['num'];
			@$data['mc_data_sum']['attachment'] += $value['num'];
			if (!in_array($value['created_by'], $id_user)) {
				$id_user[] = $value['created_by'];
			}
		}

		$data['user_list'] = user_name_data($id_user);

		$data['get'] = $get;
		$data['meta_title']  	 		= 'Home - Dashboard Rate';
		$data['subview']     	 		= 'home/dashboard_monitoring_data';

		$this->load->view('index', $data);
	}

	public function dashboard_tabmenu($active = "menu1")
	{
		$data['get'] = $this->input->get();
		$data['active'] = $active;
		// test_var($active);
			
		$where[implode_where("id", $this->project_alt)]	= null;
		$data['project_list'] = $this->general_mod->project($where);
		unset($where);

		$where[implode_where("id_company", $this->company_alt)]	= null;
		$data['company_list'] = $this->general_mod->company($where);
		unset($where);

		// test_var($data['company_list']);

		return $this->load->view('home/topmenu_dashboard', $data, true);
		// $current_link = $_SERVER['PATH_INFO'];
		// $current_link = explode("/", $current_link);
		// $current_link = $current_link[2];
		// $allowed_dashboard = [];
		// $tabmenu = '<ul class="nav nav-pills justify-content-center font-weight-bold" id="myTab" role="tablist">';
		// if ($this->permission_cookie[161] == 1) {
		// 	$allowed_dashboard[] = 'home/home_dashboard';
		// 	$tabmenu .= '<li class="nav-item">'
		// 		. '<a class="nav-link ' . ($active == 'menu1' ? 'active' : '') . '"  href="' . base_url() . 'home/home_dashboard">FABRICATION</a>'
		// 		. '</li>';
		// }
		// if ($this->permission_cookie[162] == 1) {
		// 	$allowed_dashboard[] = 'home/home_dashboard_rate';
		// 	$tabmenu .= '<li class="nav-item">'
		// 		. '<a class="nav-link ' . ($active == 'menu2' ? 'active' : '') . '"  href="' . base_url() . 'home/home_dashboard_rate">WELDING & NDT</a>'
		// 		. '</li>';
		// }
		// // if($this->permission_cookie[163] == 1){
		// // 	$allowed_dashboard[] = 'home/dashboard_sector_location';
		// // 	$tabmenu .= '<li class="nav-item">'
		// // 							.'<a class="nav-link  '.($active == 'menu3' ? 'active' : '').'"  href="'.base_url().'home/dashboard_sector_location">SECTOR & LOCATION</a>'
		// // 						.'</li>';
		// // }
		// if ($this->permission_cookie[186] == 1) {
		// 	$allowed_dashboard[] = 'home/dashboard_production';
		// 	$tabmenu .= '<li class="nav-item">'
		// 		. '<a class="nav-link ' . ($active == 'menu4' ? 'active' : '') . '"  href="' . base_url() . 'home/dashboard_production">WORKPACK PRODUCTION</a>'
		// 		. '</li>';
		// }
		// if ($this->permission_cookie[164] == 1) {
		// 	$allowed_dashboard[] = 'home/dashboard_monitoring_data';
		// 	$tabmenu .= '<li class="nav-item">'
		// 		. '<a class="nav-link ' . ($active == 'menu99' ? 'active' : '') . '"  href="' . base_url() . 'home/dashboard_monitoring_data">KPI</a>'
		// 		. '</li>';
		// }
		// $tabmenu .= '</ul>';
		// $is_inarray = false;
		// foreach ($allowed_dashboard as $value) {
		// 	$link = explode("/", '/'.$value);
		// 	$link = $link[2];
		// 	if($current_link == $link){
		// 		$is_inarray = true;
		// 	}
		// }
		// if (!$is_inarray) {
		// 	if (count($allowed_dashboard) > 0) {
		// 		redirect($allowed_dashboard[0]);
		// 	} elseif ($_SERVER['PATH_INFO'] != '/' . 'home/home_dashboard_welcome') {
		// 		redirect('home/home_dashboard_welcome');
		// 	}
		// }

		// $style = '';
		// $style .= '<style>';
		// $style .= '.nav-pills .nav-link {
		// 	color: #000;
		// 	border-bottom: 2px solid #007bff;
		// 	border-radius: 0px;
		// 	min-width: 200px;
		// 	text-align: center;
		// 	box-shadow: inset 0 0 0 0 #007bff;
		// 	-webkit-transition: ease-out 0.2s;
		// 	-moz-transition: ease-out 0.2s;
		// 	transition: ease-out 0.2s;
		// 	font-size: 0.7rem;
		// }
		// .nav-pills .nav-link:hover {
		// 	color: #fff;
		// 	box-shadow: inset 0 -100px 0 0 #007bff;
		// }
		// .nav-pills .nav-link.active,
		// .nav-pills .show>.nav-link {
		// 	color: #fff;
		// 	background: #007bff;
		// 	border-bottom: 2px solid #007bff;
		// 	border-radius: 0px;
		// }
	
		// .nav-pills.min-width-100 .nav-link {
		// 	min-width: 100px;
		// }';
		// $style .= '</style>';

		// return $fitler.$style.$tabmenu;
	}

	public function dashboard_sector_location()
	{
		$get = [
			"type" => "fabrication",
			"deck_elevation" => 5,
		];
		if ($this->input->get('type')) {
			$get = [
				"type" => $this->input->get('type'),
				"deck_elevation" => $this->input->get('deck_elevation'),
			];
		}
		$data['get'] = $get;

		$data['tabmenu'] = $this->dashboard_tabmenu('menu3');

		$datadb = $this->general_mod->deck_elevation([
			"id <=" => 10,
			"id >=" => 5,
		]);
		$deck_elevation_list = [];
		foreach ($datadb as $key => $value) {
			$deck_elevation_list[$value['id']] = $value;
		}
		$data['deck_elevation_list'] = $deck_elevation_list;

		$datadb = $this->general_mod->sector();
		$sector_list = [];
		foreach ($datadb as $key => $value) {
			$sector_list[$value['row'] . $value['column']] = $value['sector'];
		}

		$joint_list = [];
		$datadb = $this->engineering_mod->joint_list([
			"deck_elevation" => $get['deck_elevation'],
		]);
		foreach ($datadb as $key => $value) {
			if (isset($sector_list[$value['grid_row'] . $value['grid_column']])) {
				@$data['data_sector'][$sector_list[$value['grid_row'] . $value['grid_column']]]['total'] += 1;
				$joint_list[$value['id']] = [
					"joint_no" => $value['joint_no'],
					"grid_row" => $value['grid_row'],
					"grid_column" => $value['grid_column'],
					"drawing_no" => $value['drawing_no'],
					"drawing_wm" => $value['drawing_wm'],
					"rt_percent_req" => $value['rt_percent_req'],
					"ut_percent_req" => $value['ut_percent_req'],
					"mt_percent_req" => $value['mt_percent_req'],
				];
			}
		}
		if ($get['type'] == 'fabrication') {
			$vt_list = [];
			$datadb = $this->visual_mod->vt_wp_list([
				"pw.deck_elevation" => $get['deck_elevation'],
			]);
			foreach ($datadb as $key => $value) {
				if (isset($joint_list[$value['id_joint']])) {
					if (!in_array($value['status_inspection'], [0, 1, 2, 4, 6, 8, 12]) && !in_array($value['id_joint'], $vt_list)) {
						$sector = $sector_list[$joint_list[$value['id_joint']]['grid_row'] . $joint_list[$value['id_joint']]['grid_column']];
						@$data['data_sector'][$sector]['complete'] += 1;
						$vt_list[] = $value['id_joint'];
					}
				}
			}
		} elseif ($get['type'] == 'ndt') {
			$ndt_list = [];
			$datadb = $this->ndt_mod->ndt_vt_wp_list([
				"pw.deck_elevation" => $get['deck_elevation'],
				"(pn.result != 4 or pn.result is null)" => null,
			]);
			foreach ($datadb as $key => $value) {
				if (isset($joint_list[$value['id_joint']])) {
					if (!isset($ndt_list[$value['id_joint']][$value['ndt_type']]) && $value['ndt_type'] != "") {
						$ndt_list[$value['id_joint']][$value['ndt_type']] = ($value['result'] == 3 ? 1 : 0);
					}
				}
			}
			foreach ($datadb as $key => $value) {
				if (!isset($ndt_list[$value['id_joint']][1]) && $value['ndt_rt'] == "1") {
					$ndt_list[$value['id_joint']][1] = 0;
				}
				if (!isset($ndt_list[$value['id_joint']][2]) && $value['ndt_mt'] == "1") {
					$ndt_list[$value['id_joint']][2] = 0;
				}
				if (!isset($ndt_list[$value['id_joint']][3]) && $value['ndt_ut'] == "1") {
					$ndt_list[$value['id_joint']][3] = 0;
				}
			}
			foreach ($joint_list as $key => $value) {
				if (!isset($ndt_list[$key])) {
					if ($joint_list[$key]['rt_percent_req'] > 0) {
						$ndt_list[$key][1] = 0;
					}
					if ($joint_list[$key]['mt_percent_req'] > 0) {
						$ndt_list[$key][2] = 0;
					}
					if ($joint_list[$key]['ut_percent_req'] > 0) {
						$ndt_list[$key][3] = 0;
					}
				}
			}
			foreach ($ndt_list as $key => $value) {
				$total_ndt = count($value);
				$total_ndt_complete = 0;
				foreach ($value as $result_ndt) {
					$total_ndt_complete += $result_ndt;
				}
				if ($total_ndt == $total_ndt_complete) {
					$sector = $sector_list[$joint_list[$key]['grid_row'] . $joint_list[$key]['grid_column']];
					@$data['data_sector'][$sector]['complete'] += 1;
				}
			}
		}

		$data['meta_title']  	 		= 'Home - Sector & Location';
		$data['subview']     	 		= 'home/dashboard_sector_location';

		$this->load->view('index', $data);
	}

	public function dashboard_sector_location_detail($deck_elevation, $sector, $type, $excel = 0)
	{
		if ($sector == "unset" && $excel == 0) {
			$this->session->set_flashdata('error', 'Please select sector first!');
			redirect("home/dashboard_sector_location");
		}

		$deck_elevation = $this->encryption->decrypt(strtr($deck_elevation, '.-~', '+=/'));
		$get = [
			"deck_elevation" => $deck_elevation,
			"sector" => $sector,
			"type" => $type,
		];

		$datadb = $this->general_mod->deck_elevation([
			"id <=" => 10,
			"id >=" => 5,
		]);
		$deck_elevation_list = [];
		foreach ($datadb as $key => $value) {
			$deck_elevation_list[$value['id']] = $value;
		}

		$datadb = $this->general_mod->master_surveyor_status([
			"status_deleted" => "0",
		]);
		$surveyor_status_list = [];
		foreach ($datadb as $key => $value) {
			$surveyor_status_list[$value['id']] = $value;
		}

		$datadb = $this->general_mod->sector();
		$sector_list = [];
		foreach ($datadb as $key => $value) {
			$sector_list[$value['row'] . $value['column']] = $value['sector'];
		}

		$joint_list = [];
		$datadb = $this->engineering_mod->joint_list([
			"deck_elevation" => $deck_elevation,
		]);
		foreach ($datadb as $key => $value) {
			$sector_joint = @$sector_list[$value['grid_row'] . $value['grid_column']];
			if (($sector == 'unset' && $sector_joint != '') || ($sector_joint == $sector)) {
				$joint_list[$value['id']] = [
					"joint_no" => $value['joint_no'],
					"grid_row" => $value['grid_row'],
					"grid_column" => $value['grid_column'],
					"drawing_no" => $value['drawing_no'],
					"drawing_wm" => $value['drawing_wm'],
					"rt_percent_req" => $value['rt_percent_req'],
					"ut_percent_req" => $value['ut_percent_req'],
					"mt_percent_req" => $value['mt_percent_req'],
				];
			}
		}

		$status_list = [];
		if ($type == 'fabrication') {
			$double_check = [];
			$datadb = $this->fitup_mod->fu_wp_list([
				"pw.deck_elevation" => $deck_elevation,
			]);
			foreach ($datadb as $key => $value) {
				if (isset($joint_list[$value['id_joint']])) {
					$sector_joint = @$sector_list[$joint_list[$value['id_joint']]['grid_row'] . $joint_list[$value['id_joint']]['grid_column']];
					if ((($sector == 'unset' && $sector_joint != '') || $sector == $sector_joint) && !in_array($value['id_joint'], $double_check)) {
						@$status_list[$value['id_joint']]['fitup'] = [
							"status_inspection" => $value['status_inspection'],
							"status_surveyor" => $value['status_surveyor'],
						];
						$double_check[] = $value['id_joint'];
					}
				}
			}

			$double_check = [];
			$datadb = $this->visual_mod->vt_wp_list([
				"pw.deck_elevation" => $deck_elevation,
			]);
			foreach ($datadb as $key => $value) {
				if (isset($joint_list[$value['id_joint']])) {
					$sector_joint = @$sector_list[$joint_list[$value['id_joint']]['grid_row'] . $joint_list[$value['id_joint']]['grid_column']];
					if ((($sector == 'unset' && $sector_joint != '') || $sector == $sector_joint) && !in_array($value['id_joint'], $double_check)) {
						@$status_list[$value['id_joint']]['visual'] = [
							"status_inspection" => $value['status_inspection'],
							"status_surveyor" => $value['status_surveyor'],
						];
						$double_check[] = $value['id_joint'];
					}
				}
			}
		} elseif ($type == 'ndt') {
			$datadb = $this->ndt_mod->ndt_vt_wp_list([
				"pw.deck_elevation" => $deck_elevation,
				"(pn.result != 4 or pn.result is null)" => null,
			]);
			foreach ($datadb as $key => $value) {
				if (isset($joint_list[$value['id_joint']])) {
					if (!isset($status_list[$value['id_joint']][$value['ndt_type']]) && $value['ndt_type'] != "") {
						$status_list[$value['id_joint']][$value['ndt_type']] = $value['result'];
					}
				}
			}
			foreach ($datadb as $key => $value) {
				if (!isset($status_list[$value['id_joint']][1]) && $value['ndt_rt'] == "1") {
					$status_list[$value['id_joint']][1] = -1;
				}
				if (!isset($status_list[$value['id_joint']][2]) && $value['ndt_mt'] == "1") {
					$status_list[$value['id_joint']][2] = -1;
				}
				if (!isset($status_list[$value['id_joint']][3]) && $value['ndt_ut'] == "1") {
					$status_list[$value['id_joint']][3] = -1;
				}
			}
			foreach ($joint_list as $key => $value) {
				if (!isset($status_list[$key])) {
					if ($joint_list[$key]['rt_percent_req'] > 0) {
						$status_list[$key][1] = -2;
					}
					if ($joint_list[$key]['mt_percent_req'] > 0) {
						$status_list[$key][2] = -2;
					}
					if ($joint_list[$key]['ut_percent_req'] > 0) {
						$status_list[$key][3] = -2;
					}
				}
			}
		}

		if ($excel == 0) {
			$data['get'] = $get;
			$data['joint_list'] = $joint_list;
			$data['status_list'] = $status_list;
			$data['surveyor_status_list'] = $surveyor_status_list;
			// test_var($data['surveyor_status_list']);
			$data['meta_title']  	 		= 'Sector & Location - ' . $deck_elevation_list[$deck_elevation]['name'] . ' | ' . $sector . ' | ' . ucfirst($type);
			$data['subview']     	 		= 'home/dashboard_sector_location_detail';

			$this->load->view('index', $data);
		} else {
			// $this->load->view('home/dashboard_sector_location_detail_excel', $data);

			include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
			$excel              = new PHPExcel();
			$row                = $excel->setActiveSheetIndex(0);

			$column = ['Drawing GA/AS', 'Drawing WM', 'Joint No', 'Sector', 'Grid', 'Column'];
			if ($get['type'] == 'fabrication') {
				$column = array_merge($column, ['Fitup Status', 'Visual Status']);
			} elseif ($get['type'] == 'ndt') {
				$column = array_merge($column, ['RT Status', 'MT Status', 'UT Status']);
			}
			$column = array_merge($column, ['Status']);

			$start_column = 'A';
			$finish_column = $start_column;
			foreach ($column as $key => $value) {
				$row->setCellValue($finish_column . "1", $column[$key]);
				$finish_column++;
			}

			$numrow = 2;
			foreach ($joint_list as $key => $value) {
				$status_final = 0;
				$row->setCellValue('A' . $numrow, $value['drawing_no']);
				$row->setCellValue('B' . $numrow, $value['drawing_wm']);
				$row->setCellValue('C' . $numrow, $value['joint_no']);
				$row->setCellValue('D' . $numrow, @$sector_list[$value['grid_row'] . $value['grid_column']]);
				$row->setCellValue('E' . $numrow, $value['grid_row']);
				$row->setCellValue('F' . $numrow, $value['grid_column']);
				if ($get['type'] == 'fabrication') {
					if (!in_array(@$status_list[$key]['visual']['status_inspection'], [0, 1, 2, 4, 6, 8, 12])) {
						$status_final = 1;
					}

					if (@$status_list[$key]['fitup']['status_inspection'] == "0") {
						if (@$status_list[$key]['fitup']['status_surveyor'] == 3) {
							$text_status = "Ready to Submit RFI";
						} else {
							$text_status = $surveyor_status_list[$status_list[$key]['fitup']['status_surveyor']]['description'];
						}
					} elseif (@$status_list[$key]['fitup']['status_inspection'] == 1) {
						$text_status = "Pending Approval QC";
					} elseif (@$status_list[$key]['fitup']['status_inspection'] == 2) {
						$text_status = "Rejected by QC";
					} elseif (@$status_list[$key]['fitup']['status_inspection'] == 3) {
						$text_status = "Approved by QC";
					} elseif (@$status_list[$key]['fitup']['status_inspection'] == 4) {
						$text_status = "Pending by QC";
					} elseif (@$status_list[$key]['fitup']['status_inspection'] == 5) {
						$text_status = "Pending Approval Client";
					} elseif (@$status_list[$key]['fitup']['status_inspection'] == 6) {
						$text_status = "Rejected by Client";
					} elseif (@$status_list[$key]['fitup']['status_inspection'] == 7) {
						$text_status = "Approved by Client";
					} elseif (@$status_list[$key]['fitup']['status_inspection'] == 8) {
						$text_status = "Request for Update";
					} elseif (@$status_list[$key]['fitup']['status_inspection'] == 9) {
						$text_status = "Client RFI - Accepted with Comment";
					} elseif (@$status_list[$key]['fitup']['status_inspection'] == 10) {
						$text_status = "Client RFI - Postponed";
					} elseif (@$status_list[$key]['fitup']['status_inspection'] == 11) {
						$text_status = "Client RFI - Re-Offer";
					} elseif (@$status_list[$key]['fitup']['status_inspection'] == 12) {
						$text_status = "Void";
					} else {
						$text_status = "Not Ready";
					}
					$row->setCellValue('G' . $numrow, $text_status);
					if (@$status_list[$key]['visual']['status_inspection'] == "0") {
						if (@$status_list[$key]['visual']['status_surveyor'] == 3) {
							$text_status = "Ready to Submit RFI";
						} else {
							$text_status = $surveyor_status_list[$status_list[$key]['visual']['status_surveyor']]['description'];
						}
					} elseif (@$status_list[$key]['visual']['status_inspection'] == 1) {
						$text_status = "Pending Approval QC";
					} elseif (@$status_list[$key]['visual']['status_inspection'] == 2) {
						$text_status = "Rejected by QC";
					} elseif (@$status_list[$key]['visual']['status_inspection'] == 3) {
						$text_status = "Approved by QC";
					} elseif (@$status_list[$key]['visual']['status_inspection'] == 4) {
						$text_status = "Pending by QC";
					} elseif (@$status_list[$key]['visual']['status_inspection'] == 5) {
						$text_status = "Pending Approval Client";
					} elseif (@$status_list[$key]['visual']['status_inspection'] == 6) {
						$text_status = "Rejected by Client";
					} elseif (@$status_list[$key]['visual']['status_inspection'] == 7) {
						$text_status = "Approved by Client";
					} elseif (@$status_list[$key]['visual']['status_inspection'] == 8) {
						$text_status = "Request for Update";
					} elseif (@$status_list[$key]['visual']['status_inspection'] == 9) {
						$text_status = "Client RFI - Accepted with Comment";
					} elseif (@$status_list[$key]['visual']['status_inspection'] == 10) {
						$text_status = "Client RFI - Postponed";
					} elseif (@$status_list[$key]['visual']['status_inspection'] == 11) {
						$text_status = "Client RFI - Re-Offer";
					} elseif (@$status_list[$key]['visual']['status_inspection'] == 12) {
						$text_status = "Void";
					} else {
						$text_status = "Not Ready";
					}
					$row->setCellValue('H' . $numrow, $text_status);
					if (@$status_final == 1) {
						$text_status = "Complete";
					} else {
						$text_status = "In Progress";
					}
					$row->setCellValue('I' . $numrow, $text_status);
				} elseif ($get['type'] == 'ndt') {
					if (@$status_list[$key]['1'] == '') {
						$status_final += 1;
						$text_status = "-";
					} elseif (@$status_list[$key]['1'] == '-1') {
						$text_status = "Not Requested Yet";
					} elseif (@$status_list[$key]['1'] == '0') {
						$text_status = "Pending";
					} elseif (@$status_list[$key]['1'] == '2') {
						$text_status = "Reject";
					} elseif (@$status_list[$key]['1'] == '3') {
						$status_final += 1;
						$text_status = "Approved";
					}
					$row->setCellValue('G' . $numrow, $text_status);

					if (@$status_list[$key]['2'] == '') {
						$status_final += 1;
						$text_status = "-";
					} elseif (@$status_list[$key]['2'] == '-1') {
						$text_status = "Not Requested Yet";
					} elseif (@$status_list[$key]['2'] == '0') {
						$text_status = "Pending";
					} elseif (@$status_list[$key]['2'] == '2') {
						$text_status = "Reject";
					} elseif (@$status_list[$key]['2'] == '3') {
						$status_final += 1;
						$text_status = "Approved";
					}
					$row->setCellValue('H' . $numrow, $text_status);

					if (@$status_list[$key]['3'] == '') {
						$status_final += 1;
						$text_status = "-";
					} elseif (@$status_list[$key]['3'] == '-1') {
						$text_status = "Not Requested Yet";
					} elseif (@$status_list[$key]['3'] == '0') {
						$text_status = "Pending";
					} elseif (@$status_list[$key]['3'] == '2') {
						$text_status = "Reject";
					} elseif (@$status_list[$key]['3'] == '3') {
						$status_final += 1;
						$text_status = "Approved";
					}
					$row->setCellValue('I' . $numrow, $text_status);

					$status_final = $status_final / 3;
					if (@$status_final == 1) {
						$text_status = "Complete";
					} else {
						$text_status = "In Progress";
					}
					$row->setCellValue('J' . $numrow, $text_status);
				}
				$numrow++;
			}
			$numrow--;
			$finish_column--;

			$style = [
				'bold' => ['bold'  => true],
				'center' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER],
				'left' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT],
				'middle' => ['vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER],
				'allborders' => ['allborders' => ["style" => PHPExcel_Style_Border::BORDER_THIN]],
			];
			$excel->getActiveSheet()->getStyle('A1:' . $finish_column . '1')->applyFromArray([
				"borders" => $style['allborders'],
				"alignment" => array_merge($style['center'], $style['middle']),
				"font" => $style['bold'],
			]);
			$excel->getActiveSheet()->getStyle('A2:' . $finish_column . $numrow)->applyFromArray([
				"borders" => $style['allborders'],
				"alignment" => array_merge($style['center'], $style['middle']),
			]);
			for ($i = 'A'; $i !== $finish_column; $i++) {
				$excel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
			}

			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment; filename="Export-Sector Location-' . ucwords($get['type']) . '-' . ucwords($deck_elevation_list[$get['deck_elevation']]['name']) . '-' . date('YmdHis') . '.xlsx"'); // Set nama file excel nya
			header('Cache-Control: max-age=0');
			$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
			$write->save('php://output');
		}
	}

	public function fetch_kpi_by_joint()
	{

		$current_year                   = date('Y');
		$category                       = $this->input->get('category');
		$discipline                     = $this->input->get('discipline');
		$week_val                       = $this->input->get('week_val');
		$project                       = $this->input->get('project');

		if ($week_val) {
			$week_data                    = $this->get_start_end_last_date($current_year, $week_val);
			$start_date_week              = $week_data['start_date'];
			$end_date_week                = $week_data['end_date'];
		}

		if ($category == "primary") {
			// $where_category               = "class IN ('2') AND SUBSTRING(joint.drawing_wm,16,6) NOT IN ('DR-015','DR-020') ";
			$where_category               = "class IN ('2') AND SUBSTRING(joint.drawing_wm,16,6) NOT IN ('DR-015') AND joint.drawing_no NOT IN (SELECT drawing_ga from master_secondary_to_primary) ";
		} elseif ($category == "special") {
			// $where_category               = "class IN ('1') AND SUBSTRING(joint.drawing_wm,16,6) NOT IN ('DR-015','DR-020') ";
			$where_category               = "class IN ('1') ";
		} elseif ($category == "secondary") {
			// $where_category               = "class IN ('3') AND SUBSTRING(joint.drawing_wm,16,6) NOT IN ('DR-015','DR-020') ";
			$where_category               = "class IN ('3') ";
		} else {
			// $where_category               = "SUBSTRING(joint.drawing_wm,16,6) IN ('DR-015','DR-020')";
			$where_category               = "SUBSTRING(joint.drawing_wm,16,6) IN ('DR-015') AND joint.drawing_no IN (SELECT drawing_ga from master_secondary_to_primary) ";
		}

		$where_category               .= " AND joint.status_internal = 0 AND joint.status_delete = 1";

		if ($discipline) {
			$where_category             .= " AND joint.discipline = $discipline";
		}

		$deck_id_list                   = [5, 6, 7, 8, 9, 10];
		$weld_type_id                   = [25, 21, 13, 18, 19, 17];

		$where["id IN ('" . implode("', '", $deck_id_list) . "')"] = NULL;
		$deck_list                      = $this->general_mod->deck_elevation($where);
		unset($where);

		$where["deck_elevation IN ('" . implode("', '", $deck_id_list) . "')"] = NULL;
		$where[$where_category]         = null;

		if ($week_val) {
			$where["DATE(created_date) <= '$end_date_week'"] = null;
		}
		$where['project'] = $project;
		$where['status_delete'] = 1;
		$joint_list                     = $this->home_mod->summary_joint_by_deck($where);
		unset($where);

		if ($joint_list) {
			foreach ($joint_list as $value) {
				$data['join_list'][$value['deck_elevation']]  = $value;
			}
		}

		$where["weld_type IN ('" . implode("', '", $weld_type_id) . "')"] = NULL;
		$where[$where_category]           = null;
		$where["deck_elevation IN ('" . implode("', '", $deck_id_list) . "')"] = NULL;
		if ($week_val) {
			$where["DATE(created_date) <= '$end_date_week'"] = null;
		}
		$where['project'] = $project;
		$summary_weld_type                = $this->home_mod->summary_joint_weld_type_by_deck($where);
		unset($where);

		foreach ($summary_weld_type as $value) {
			$data['summary_weld_type'][$value['deck_elevation']][$value['weld_type']] = $value['total_joint'];
		}

		$where["deck_elevation IN ('" . implode("', '", $deck_id_list) . "')"] = NULL;

		$where['status_inspection != 12'] = null;
		$where["status_resubmit <> 1"] 	  = null;
		$where["status_retransmitted"]  	= 0;
		$where[$where_category]           = null;

		if ($week_val) {
			$where["DATE(document_approval_date) <= '$end_date_week'"] = null;
		}

		$where['project'] = $project;
		$fitup_joint_list                 = $this->home_mod->summary_joint_fitup_by_deck($where);
		unset($where);

		foreach ($fitup_joint_list as $value) {
			$data['fitup'][$value['deck_elevation']]  = $value;
		}

		$where["deck_elevation IN ('" . implode("', '", $deck_id_list) . "')"] = NULL;

		$where['status_inspection != 12'] = null;
		$where["retransmitt_status <> 1"] = null;
		$where['visual.status_delete IS NULL'] = null;
		$where[$where_category]           = null;
		$where['revision IS NULL'] = null;

		if ($week_val) {
			$where["DATE(document_approval_date) <= '$end_date_week'"] = null;
		}
		$where['project'] = $project;
		$visual_joint_list                = $this->home_mod->summary_joint_visual_by_deck($where);
		unset($where);

		foreach ($visual_joint_list as $value) {
			$data['visual'][$value['deck_elevation']]  = $value;
		}

		$where["id IN (" . implode(", ", $weld_type_id) . ")"]  = null;
		$joint_type                     = $this->general_mod->weld_type($where);
		unset($where);


		// $where["re_request IS NULL"]          = null;

		// if($week_val) {
		//   $where["DATE(ndt.date_of_inspection) <= '$end_date_week'"] = null;
		// }

		// $datadb = $this->home_mod->ndt_uniq($where);
		// unset($where);

		// foreach($datadb as $key => $value){
		//   $data['ndt_count'][$value['ndt_type']][$value['deck_elevation']] = $value;
		// }

		$master_ndt_type          = $this->ndt_mod->master_ndt();
		$ndt_id_master            = array_column($master_ndt_type, 'id', 'ndt_initial');

		$list_used_ndt  = ["MT", "UT"];
		foreach ($list_used_ndt as $value) {
			$where["result IN (2, 3)"]            = null;
			$where[$where_category]               = null;
			$where["visual.revision is null"]     = null;
			if ($week_val) {
				$where["DATE(ndt.tested_date) <= '$end_date_week'"] = null;
			}
			$where['project'] = $project;
			$datadb       = $this->home_mod->ndt_dashboard_conweeky(strtolower($value), $where);
			unset($where);

			foreach ($datadb as $v) {
				$data['ndt_count'][$ndt_id_master[$value]][$v['deck_elevation']] = $v;
			}
		}

		$where["weld_type IN ('13','18','19')"] = null;
		$where[$where_category]                 = null;

		if ($week_val) {
			$where["DATE(created_date) <= '$end_date_week'"] = null;
		}
		$where['project'] = $project;
		$datadb                                 = $this->home_mod->pcms_joint_list($where);
		unset($where);

		foreach ($datadb as $value) {
			// if($value['weld_type'] == 13 && intval($value['thickness']) >= 8) {
			//   $data['total_need_ut'][$value['deck_elevation']][]  = 1;
			// } elseif(in_array($value['weld_type'], [18, 19])) {
			//   $data['total_need_ut'][$value['deck_elevation']][]  = 1;
			// }

			if (intval($value['thickness']) >= 8) {
				$data['total_need_ut'][$value['deck_elevation']][]  = 1;

				if ($value['weld_type'] == 13) {
					$data['total_need_ut_wt'][$value['deck_elevation']]['bw'][]  = 1;
				}
				if ($value['weld_type'] == 18) {
					$data['total_need_ut_wt'][$value['deck_elevation']]['tfp'][]  = 1;
				}
				if ($value['weld_type'] == 19) {
					$data['total_need_ut_wt'][$value['deck_elevation']]['tky'][]  = 1;
				}
			}
		}

		$data['deck_list']              = $deck_list;
		$data['category']               = $category;
		$data['joint_type']             = $joint_type;
		$this->load->view('home/dashboard/fetch_kpi_by_joint', $data);
	}

	public function fetch_kpi_by_length()
	{

		$current_year                   = date('Y');
		$category                       = $this->input->get('category');
		$discipline                     = $this->input->get('discipline');
		$week_val                       = $this->input->get('week_val');
		$project                       = $this->input->get('project');

		if ($week_val) {
			$week_data                    = $this->get_start_end_last_date($current_year, $week_val);
			$start_date_week              = $week_data['start_date'];
			$end_date_week                = $week_data['end_date'];
		}

		if ($category == "primary") {
			// $where_category               = "class IN ('2') AND SUBSTRING(joint.drawing_wm,16,6) NOT IN ('DR-015','DR-020') ";
			$where_category               = "class IN ('2') AND SUBSTRING(joint.drawing_wm,16,6) NOT IN ('DR-015') AND joint.drawing_no NOT IN (SELECT drawing_ga from master_secondary_to_primary) ";
		} elseif ($category == "special") {
			// $where_category               = "class IN ('1') AND SUBSTRING(joint.drawing_wm,16,6) NOT IN ('DR-015','DR-020') ";
			$where_category               = "class IN ('1') ";
		} elseif ($category == "secondary") {
			// $where_category               = "class IN ('3') AND SUBSTRING(joint.drawing_wm,16,6) NOT IN ('DR-015','DR-020') ";
			$where_category               = "class IN ('3') ";
		} else {
			// $where_category               = "SUBSTRING(joint.drawing_wm,16,6) IN ('DR-015','DR-020')";
			$where_category               = "SUBSTRING(joint.drawing_wm,16,6) IN ('DR-015') AND joint.drawing_no IN (SELECT drawing_ga from master_secondary_to_primary) ";
		}

		$where_category               .= " AND joint.status_internal = 0 AND joint.status_delete = 1";

		if ($discipline) {
			$where_category             .= " AND joint.discipline = $discipline";
		}

		$deck_id_list                   = [5, 6, 7, 8, 9, 10];
		$weld_type_id                   = [25, 21, 13, 18, 19, 17];

		$where["id IN ('" . implode("', '", $deck_id_list) . "')"] = NULL;
		$deck_list                      = $this->general_mod->deck_elevation($where);
		unset($where);

		$where["deck_elevation IN ('" . implode("', '", $deck_id_list) . "')"] = NULL;
		$where[$where_category]         = null;

		if ($week_val) {
			$where["DATE(created_date) <= '$end_date_week'"] = null;
		}
		$where['project'] = $project;
		$joint_list                     = $this->home_mod->summary_joint_by_deck($where);
		unset($where);

		if ($joint_list) {
			foreach ($joint_list as $value) {
				$data['join_list'][$value['deck_elevation']]  = $value;
			}
		}

		$where["weld_type IN ('" . implode("', '", $weld_type_id) . "')"] = NULL;
		$where[$where_category]           = null;
		$where["deck_elevation IN ('" . implode("', '", $deck_id_list) . "')"] = NULL;

		if ($week_val) {
			$where["DATE(created_date) <= '$end_date_week'"] = null;
		}
		$where['project'] = $project;
		$summary_weld_type                = $this->home_mod->summary_joint_weld_type_by_deck($where);
		unset($where);

		foreach ($summary_weld_type as $value) {
			$data['summary_weld_type'][$value['deck_elevation']][$value['weld_type']] = $value['total_length'];
		}


		$where["deck_elevation IN ('" . implode("', '", $deck_id_list) . "')"] = NULL;

		$where['status_inspection != 12'] = null;
		$where["status_resubmit <> 1"] 	  = null;
		$where["status_retransmitted"]  	= 0;

		$where[$where_category]           = null;

		if ($week_val) {
			$where["DATE(document_approval_date) <= '$end_date_week'"] = null;
		}
		$where['project'] = $project;
		$fitup_joint_list                 = $this->home_mod->summary_joint_fitup_by_deck($where);
		unset($where);

		foreach ($fitup_joint_list as $value) {
			$data['fitup'][$value['deck_elevation']]  = $value;
		}

		$where["deck_elevation IN ('" . implode("', '", $deck_id_list) . "')"] = NULL;

		$where['status_inspection != 12'] = null;
		$where["retransmitt_status <> 1"] = null;
		$where['revision IS NULL'] = null;
		$where['visual.status_delete IS NULL'] = null;

		$where[$where_category]           = null;

		if ($week_val) {
			$where["DATE(document_approval_date) <= '$end_date_week'"] = null;
		}
		$where['project'] = $project;
		$visual_joint_list                = $this->home_mod->summary_joint_visual_by_deck($where);
		unset($where);

		foreach ($visual_joint_list as $value) {
			$data['visual'][$value['deck_elevation']]  = $value;
		}

		$where["id IN (" . implode(", ", $weld_type_id) . ")"]  = null;
		$joint_type                     = $this->general_mod->weld_type($where);
		unset($where);

		// $where["result IN (2, 3)"]            = null;
		// $where[$where_category]               = null;
		// $where["re_request IS NULL"]          = null;
		// $where["visual.revision is null"]     = null;

		// if($week_val) {
		//   $where["DATE(ndt.date_of_inspection) <= '$end_date_week'"] = null;
		// }

		// $datadb = $this->home_mod->ndt_uniq($where);
		// unset($where);

		// foreach($datadb as $key => $value){
		//   $data['ndt_count'][$value['ndt_type']][$value['deck_elevation']] = $value;
		// }

		$master_ndt_type          = $this->ndt_mod->master_ndt();
		$ndt_id_master            = array_column($master_ndt_type, 'id', 'ndt_initial');

		$list_used_ndt  = ["MT", "UT"];
		foreach ($list_used_ndt as $value) {
			$where["result IN (2, 3)"]            = null;
			$where[$where_category]               = null;
			$where["visual.revision is null"]     = null;
			if ($week_val) {
				$where["DATE(ndt.tested_date) <= '$end_date_week'"] = null;
			}
			$where['project'] = $project;
			$datadb       = $this->home_mod->ndt_dashboard_conweeky(strtolower($value), $where);
			unset($where);

			foreach ($datadb as $v) {
				$data['ndt_count'][$ndt_id_master[$value]][$v['deck_elevation']] = $v;
			}
		}


		$where["weld_type IN ('13','18','19')"] = null;
		$where[$where_category]                 = null;

		if ($week_val) {
			$where["DATE(created_date) <= '$end_date_week'"] = null;
		}
		$where['project'] = $project;
		$datadb                                 = $this->home_mod->pcms_joint_list($where);
		unset($where);

		foreach ($datadb as $value) {
			// if($value['weld_type'] == 13 && intval($value['thickness']) >= 8) {
			//   $data['total_need_ut'][$value['deck_elevation']][]  = $value['weld_length'];
			// } elseif(in_array($value['weld_type'], [18, 19])) {
			//   $data['total_need_ut'][$value['deck_elevation']][]  = $value['weld_length'];
			// }
			if (intval($value['thickness']) >= 8) {
				$data['total_need_ut'][$value['deck_elevation']][]  = $value['weld_length'];

				if ($value['weld_type'] == 13) {
					$data['total_need_ut_wt'][$value['deck_elevation']]['bw'][]  = $value['weld_length'];
				}
				if ($value['weld_type'] == 18) {
					$data['total_need_ut_wt'][$value['deck_elevation']]['tfp'][]  = $value['weld_length'];
				}
				if ($value['weld_type'] == 19) {
					$data['total_need_ut_wt'][$value['deck_elevation']]['tky'][]  = $value['weld_length'];
				}
			}
		}

		$data['deck_list']              = $deck_list;
		$data['category']               = $category;
		$data['joint_type']             = $joint_type;
		$this->load->view('home/dashboard/fetch_kpi_by_length', $data);
	}

	public function home_dashboard_welcome()
	{
		$data['tabmenu'] = $this->dashboard_tabmenu('menu1');

		$data['meta_title']  	 		= 'Home';
		$data['subview']     	 		= 'home/home_dashboard_welcome';
		$this->load->view('index', $data);
	}

	public function dashboard_production()
	{
		$data['tabmenu'] = $this->dashboard_tabmenu('menu4');

		$data['meta_title']  	 		= 'Home - Dashboard Production';
		$data['subview']     	 		= 'home/dashboard_production';

		$this->load->view('index', $data);
	}

	public function load_data_workpack_summary_new()
	{
		$get = $this->input->get();
		$workpack_summary = [
			"PF" => [],
			"FB" => [],
			"AS" => [],
			"ER" => [],
		];
		$datadb = $this->planning_mod->workpack_list([
			"status_delete" => 1,
			'type' => 1,
			"project" => $get['project'],
			"company_id" => $get['company'],
		]);
		foreach ($datadb as $key => $value) {
			if ($value['transmit_eng_status'] == 1) {
				@$workpack_summary["Pending Engineering"][$value['phase']] += 1;
			} elseif ($value['status'] == 1 || $value['status'] == 2) {
				@$workpack_summary["Issued"][$value['phase']] += 1;
				if ($value['plan_finish_date'] >= date("Y-m-d")) {
					@$workpack_summary["In Progress"][$value['phase']] +=1;
				} elseif ($value['plan_finish_date'] < date("Y-m-d")) {
					@$workpack_summary["Overdue"][$value['phase']] +=1;
				}
			} elseif ($value['status_return'] == 5) {
				@$workpack_summary["Completed"][$value['phase']] += 1;
			} elseif ($value['status'] == 3) {
				@$workpack_summary["Void"][$value['phase']] += 1;
			} elseif ($value['status_approval'] == 3) {
				@$workpack_summary["Pending Superintendent (Issued)"][$value['phase']] += 1;
			} elseif ($value['status_approval'] == 2) {
				@$workpack_summary["Rejected"][$value['phase']] += 1;
			} elseif ($value['status_approval'] == 1) {
				@$workpack_summary["Pending Project / Construction Engineering (Issued)"][$value['phase']] += 1;
			} elseif ($value['status_approval'] == 0) {
				@$workpack_summary["Draft"][$value['phase']] += 1;
			} elseif ($value['status_return'] == 1) {
				@$workpack_summary["Pending Project / Construction Engineering (Returned)"][$value['phase']] += 1;
			} elseif ($value['status_return'] == 3) {
				@$workpack_summary["Pending Construction Superintendent (Returned)"][$value['phase']] += 1;
			}
		}

		$data = [];
		foreach ($this->legend_workpack_chart as $value) {
			if(in_array($value, ['Draft'])){
				$data['Draft'] = [
					@$data['Draft'][0] + @$workpack_summary[$value]['PF'] + 0, 
					@$data['Draft'][1] + @$workpack_summary[$value]['FB'] + 0, 
					@$data['Draft'][2] + @$workpack_summary[$value]['AS'] + 0, 
					@$data['Draft'][3] + @$workpack_summary[$value]['ER'] + 0,
				];
			}
			elseif(in_array($value, ['Pending Engineering', 'Pending Superintendent (Issued)', 'Pending Project / Construction Engineering (Issued)', 'Pending Project / Construction Engineering (Returned)', 'Pending Construction Superintendent (Returned)'])){
				$data['Pending'] = [
					@$data['Pending'][0] + @$workpack_summary[$value]['PF'] + 0, 
					@$data['Pending'][1] + @$workpack_summary[$value]['FB'] + 0, 
					@$data['Pending'][2] + @$workpack_summary[$value]['AS'] + 0, 
					@$data['Pending'][3] + @$workpack_summary[$value]['ER'] + 0,
				];
			}
			elseif(in_array($value, ['In Progress'])){
				$data['Progress'] = [
					@$data['Progress'][0] + @$workpack_summary[$value]['PF'] + 0, 
					@$data['Progress'][1] + @$workpack_summary[$value]['FB'] + 0, 
					@$data['Progress'][2] + @$workpack_summary[$value]['AS'] + 0, 
					@$data['Progress'][3] + @$workpack_summary[$value]['ER'] + 0,
				];
			}
			elseif(in_array($value, ['Overdue'])){
				$data['Overdue'] = [
					@$data['Overdue'][0] + @$workpack_summary[$value]['PF'] + 0, 
					@$data['Overdue'][1] + @$workpack_summary[$value]['FB'] + 0, 
					@$data['Overdue'][2] + @$workpack_summary[$value]['AS'] + 0, 
					@$data['Overdue'][3] + @$workpack_summary[$value]['ER'] + 0,
				];
			}
			elseif(in_array($value, ['Completed'])){
				$data['Completed'] = [
					@$data['Completed'][0] + @$workpack_summary[$value]['PF'] + 0, 
					@$data['Completed'][1] + @$workpack_summary[$value]['FB'] + 0, 
					@$data['Completed'][2] + @$workpack_summary[$value]['AS'] + 0, 
					@$data['Completed'][3] + @$workpack_summary[$value]['ER'] + 0,
				];
			}
		}

		$data_default = [0, 0, 0, 0];

		$res = [
			["color" => "#d1d8e0", "name" => 'Draft', "data" => $data['Draft'] ?? $data_default,],
			["color" => "#fed330", "name" => 'Pending', "data" => $data['Pending'] ?? $data_default,],
			["color" => "#45aaf2", "name" => 'Progress', "data" => $data['Progress'] ?? $data_default,],
			["color" => "#fd9644", "name" => 'Overdue', "data" => $data['Overdue'] ?? $data_default,],
			["color" => "#26de81", "name" => 'Completed', "data" => $data['Completed'] ?? $data_default,],
		];
		echo json_encode($res);
	}

	public function load_data_table_workpack_summary()
	{
		$get = $this->input->get();
		$datadb = $this->planning_mod->workpack_list([
			'type' => 1,
			'status_delete' => 1,
			"project" => $get['project'],
			"company_id" => $get['company'],
		]);
		$workpack_summary = [];
		foreach ($datadb as $key => $value) {
			if ($value['transmit_eng_status'] == 1) {
				@$workpack_summary["Pending Engineering"][$value['phase']] += 1;
			} elseif ($value['status'] == 1 || $value['status'] == 2) {
				@$workpack_summary["Issued"][$value['phase']] += 1;
				if ($value['plan_finish_date'] >= date("Y-m-d")) {
					@$workpack_summary["In Progress"][$value['phase']] +=1;
				} elseif ($value['plan_finish_date'] < date("Y-m-d")) {
					@$workpack_summary["Overdue"][$value['phase']] +=1;
				}
			} elseif ($value['status_return'] == 5) {
				@$workpack_summary["Completed"][$value['phase']] += 1;
			} elseif ($value['status'] == 3) {
				@$workpack_summary["Void"][$value['phase']] += 1;
			} elseif ($value['status_approval'] == 3) {
				@$workpack_summary["Pending Superintendent (Issued)"][$value['phase']] += 1;
			} elseif ($value['status_approval'] == 2) {
				@$workpack_summary["Rejected"][$value['phase']] += 1;
			} elseif ($value['status_approval'] == 1) {
				@$workpack_summary["Pending Project / Construction Engineering (Issued)"][$value['phase']] += 1;
			} elseif ($value['status_approval'] == 0) {
				@$workpack_summary["Draft"][$value['phase']] += 1;
			} elseif ($value['status_return'] == 1) {
				@$workpack_summary["Pending Project / Construction Engineering (Returned)"][$value['phase']] += 1;
			} elseif ($value['status_return'] == 3) {
				@$workpack_summary["Pending Construction Superintendent (Returned)"][$value['phase']] += 1;
			}
		}

		$data = [];
		foreach ($workpack_summary as $key => $value) {
			if(in_array($key, ['Draft', 'Overdue', 'Completed'])){
				$data[$key] = $value;
			}
			elseif(in_array($key, ['Pending Engineering', 'Pending Superintendent (Issued)', 'Pending Project / Construction Engineering (Issued)', 'Pending Project / Construction Engineering (Returned)', 'Pending Construction Superintendent (Returned)'])){
				foreach ($value as $phase => $total) {
					@$data['Pending'][$phase] += $total;
				}
			}
			elseif(in_array($key, ['In Progress'])){
				foreach ($value as $phase => $total) {
					@$data['Progress'][$phase] += $total;
				}
			}
		}
		

		$table = [];
		foreach (['PF', 'FB', 'AS', 'ER'] as $value) {
			$table[$value] = "".
			"<tr>".
				"<td><a target='_blank' class='font-weight-bold' href='".base_url('planning/workpack_list?submit=search&project='.$this->user_cookie[10].'&phase='.$value.'&status=1')."'>Draft</a></td>".
				"<td>".(0+@$data['Draft'][$value])."</td>".
			"</tr>".
			"<tr>".
				"<td><a target='_blank' class='font-weight-bold' href='".base_url('planning/workpack_list?submit=search&project='.$this->user_cookie[10].'&phase='.$value.'&status=99')."'>Pending</a></td>".
				"<td>".(0+@$data['Pending'][$value])."</td>".
			"</tr>".
			"<tr>".
				"<td><a target='_blank' class='font-weight-bold' href='".base_url('planning/workpack_list?submit=search&project='.$this->user_cookie[10].'&phase='.$value.'&status=6')."'>Progress</a></td>".
				"<td>".(0+@$data['Progress'][$value])."</td>".
			"</tr>".
			"<tr>".
				"<td><a target='_blank' class='font-weight-bold' href='".base_url('planning/workpack_list?submit=search&project='.$this->user_cookie[10].'&phase='.$value.'&status=7')."'>Overdue</a></td>".
				"<td><a target='_blank' class='font-weight-bold' href='".base_url('home/export_workpack_overdue_api?project='.$this->user_cookie[10].'&phase='.$value)."'>".(0+@$data['Overdue'][$value])."</a></td>".
			"</tr>".
			"<tr>".
				"<td><a target='_blank' class='font-weight-bold' href='".base_url('planning/workpack_list?submit=search&project='.$this->user_cookie[10].'&phase='.$value.'&status=4')."'>Completed</a></td>".
				"<td>".(0+@$data['Completed'][$value])."</td>".
			"</tr>".
			"<tr>".
				"<td><a target='_blank' class='font-weight-bold' href='".base_url('planning/workpack_list?submit=search&project='.$this->user_cookie[10].'&phase='.$value.'')."'>All</a></td>".
				"<td>".(0+@$data['Draft'][$value]+@$data['Pending'][$value]+@$data['Progress'][$value]+@$data['Overdue'][$value]+@$data['Completed'][$value])."</td>".
			"</tr>".
			"";
		}

		echo json_encode($table);
		// test_var(html_escape($table));
	}

	public function export_workpack_overdue_api() {
    $get = $this->input->get();

		$post_data = [
			"project" => $get['project'],
			"phase" => $get['phase'],

			"user_id" => $this->user_cookie[0],
			"expired_date" =>date('Y-m-d H:i:s', strtotime("+10 minutes")),
			"client_ip" => $this->user_cookie[12],
		];
		$post_data['api_url'] = '/planning/export_workpack_overdue';
		$post_data['document_name'] = 'Export Workpack Overdue '.date('YmdHis');
		$jwt = encode_jwt($post_data);
		// test_var($jwt);
		redirect(export_link()."/export?data=$jwt");
    return;
  }

	function load_mv_inspection_progress() {
		error_reporting(0);
		$project_id		= $this->input->post('project');
		$company_id		= $this->input->post('company');

		$where['project'] 				= $project_id;
		$where['company_id']			= $company_id;
		$where['status_delete']		= 1;
		$datadb										= $this->engineering_mod->deck_used_piecemark($where);
		unset($where);
		$id_deck_list							= [0];
		foreach($datadb as $value) {
			$id_deck_list[]					= $value['deck_elevation'];
		}

		$where[implode_where("id", $id_deck_list)] = null;
		$datadb				= $this->general_mod->deck_elevation($where);
		unset($where);
		foreach($datadb as $value) {
			$data['deck_list'][$value['id']]	= $value;
		}

		$where[implode_where("deck_elevation", $id_deck_list)] = null;
		$where['project']				= $project_id;
		$where['company_id']		= $company_id;
		$where['status_delete']	= 1;
		$datadb									= $this->general_mod->total_piecemark_by_deck($where);
		unset($where);


		foreach($datadb as $value) {
			$data['total_pc'][$value['deck_elevation']]	= $value['total_piecemark'];
		}

		$where[implode_where("deck_elevation", $id_deck_list)] = null;
		$where['project']						= $project_id;
		$where['pc.company_id']			= $company_id;
		$where['pc.status_delete']	= 1;
		$where['mv.status_inspection != 12'] = null;
		$where['mv.status_delete']	= 0;
		$where['mv.report_resubmit_status']	= 0;
		$datadb											= $this->general_mod->total_mv_by_deck_and_status($where);
		unset($where);

		$data['total_pc_mv']				= [];
		foreach($datadb as $value) {
			$status_inspection				= "waiting_submit";
			if($value['status_inspection'] == 1) {
				$status_inspection			= "pending_approval";
			} elseif(in_array($value['status_inspection'], [2,4])) {
				$status_inspection			= "outstanding_resubmit";
			} elseif(in_array($value['status_inspection'], [3,5,7,9,10,11])) {
				$status_inspection			= "approved_by_qc";
			} 

			@$data['total_pc_mv'][$value['deck_elevation']][$status_inspection] += $value['total_piecemark'];
		}

		$this->load->view('home/dashboard/load_mv_inspection_progress', $data);
	}

	function load_ft_inspection_progress() {
		$project_id		= $this->input->post('project');
		$company_id		= $this->input->post('company');
		$where['project'] 				= $project_id;
		$where['company_id']			= $company_id;
		$where['status_delete']		= 1;
		$datadb										= $this->engineering_mod->deck_used_joint($where);
		unset($where);
		$id_deck_list							= [0];
		foreach($datadb as $value) {
			$id_deck_list[]					= $value['deck_elevation'];
		}
		$where[implode_where("id", $id_deck_list)] = null;
		$datadb				= $this->general_mod->deck_elevation($where);
		unset($where);
		foreach($datadb as $value) {
			$data['deck_list'][$value['id']]	= $value;
		}

		$where["id IN ('1','2','3')"]	= null;
		$datadb				= $this->general_mod->class($where);
		unset($where);
		foreach($datadb as $value) {
			$data['class_list'][$value['id']]	= $value;
		}

		$where[implode_where("deck_elevation", $id_deck_list)] = null;
		$where["class IN ('1','2','3')"]	= null;
		$where['project']						= $project_id;
		$where['company_id']				= $company_id;
		$where['status_delete']			= 1;
		$datadb											= $this->general_mod->total_joint_by_deck_and_class($where);
		unset($where);
		$data['total_jt']						= [];
		$data['total_weld_length']	= [];
		foreach($datadb as $value) {
			@$data['total_jt'][$value['deck_elevation']]	+= $value['total_joint'];
			@$data['total_jt_by_class'][$value['deck_elevation']][$value['class']]	+= $value['total_joint'];

			@$data['total_weld_length'][$value['deck_elevation']]	+= $value['total_weld_length'];
			@$data['total_weld_length_by_class'][$value['deck_elevation']][$value['class']]	+= $value['total_weld_length'];
		}

		$where[implode_where("deck_elevation", $id_deck_list)] = null;
		$where["class IN ('1','2','3')"]	= null;
		$where['project']						= $project_id;
		$where['jt.company_id']			= $company_id;
		$where['jt.status_delete']	= 1;
		$where['ft.status_inspection != 12'] 	= null;
		$where["status_retransmitted"] 			= 0;
		$where['(ft.status_delete = 0 OR ft.status_delete IS NULL)'] = null;
		$datadb											= $this->general_mod->total_ft_by_deck_and_class_and_status($where);
		unset($where);

		$data['total_length_ft']				= [];
		foreach($datadb as $value) {

			$status_inspection				= "waiting_submit";
			if($value['status_inspection'] == 1) {
				$status_inspection			= "pending_approval";
			} elseif(in_array($value['status_inspection'], [2,4])) {
				$status_inspection			= "outstanding_resubmit";
			} elseif(in_array($value['status_inspection'], [3,5,7,9,10,11])) {
				$status_inspection			= "approved_by_qc";
			}

			@$data['total_length_ft'][$value['deck_elevation']][$status_inspection] += $value['total_weld_length'];
			@$data['total_length_ft_by_class'][$value['deck_elevation']][$value['class']][$status_inspection] += $value['total_weld_length'];
		}

		$this->load->view('home/dashboard/load_ft_inspection_progress', $data);
	}


	function load_vs_inspection_progress() {
		$project_id		= $this->input->post('project');
		$company_id		= $this->input->post('company');
		$where['project'] 				= $project_id;
		$where['company_id']			= $company_id;
		$where['status_delete']		= 1;
		$datadb										= $this->engineering_mod->deck_used_joint($where);
		unset($where);
		$id_deck_list							= [0];
		foreach($datadb as $value) {
			$id_deck_list[]					= $value['deck_elevation'];
		}
		$where[implode_where("id", $id_deck_list)] = null;
		$datadb				= $this->general_mod->deck_elevation($where);
		unset($where);
		foreach($datadb as $value) {
			$data['deck_list'][$value['id']]	= $value;
		}

		$where["id IN ('1','2','3')"]	= null;
		$datadb				= $this->general_mod->class($where);
		unset($where);
		foreach($datadb as $value) {
			$data['class_list'][$value['id']]	= $value;
		}

		$where[implode_where("deck_elevation", $id_deck_list)] = null;
		$where["class IN ('1','2','3')"]	= null;
		$where['project']						= $project_id;
		$where['company_id']				= $company_id;
		$where['status_delete']			= 1;
		$datadb											= $this->general_mod->total_joint_by_deck_and_class($where);
		unset($where);
		$data['total_jt']						= [];
		$data['total_weld_length']	= [];
		foreach($datadb as $value) {
			@$data['total_jt'][$value['deck_elevation']]	+= $value['total_joint'];
			@$data['total_jt_by_class'][$value['deck_elevation']][$value['class']]	+= $value['total_joint'];

			@$data['total_weld_length'][$value['deck_elevation']]	+= $value['total_weld_length'];
			@$data['total_weld_length_by_class'][$value['deck_elevation']][$value['class']]	+= $value['total_weld_length'];
		}

		$where[implode_where("deck_elevation", $id_deck_list)] = null;
		$where["class IN ('1','2','3')"]	= null;
		$where['project']						= $project_id;
		$where['jt.company_id']			= $company_id;
		$where['jt.status_delete']	= 1;
		$where['vs.status_inspection != 12'] 	= null;
		$where["vs.retransmitt_status"] 			= 0;
		$where["(vs.status_delete!=1 OR vs.status_delete IS NULL)"] = Null;
		$where["vs.revision IS NULL"]	= null;
		$datadb											= $this->general_mod->total_vs_by_deck_and_class_and_status($where);
		unset($where);

		$data['total_length_vs']				= [];
		foreach($datadb as $value) {

			$status_inspection				= "waiting_submit";
			if($value['status_inspection'] == 1) {
				$status_inspection			= "pending_approval";
			} elseif(in_array($value['status_inspection'], [2,4])) {
				$status_inspection			= "outstanding_resubmit";
			} elseif(in_array($value['status_inspection'], [3,5,7,9,10,11])) {
				$status_inspection			= "approved_by_qc";
			}

			@$data['total_length_vs'][$value['deck_elevation']][$status_inspection] += $value['total_weld_length'];
			@$data['total_length_vs_by_class'][$value['deck_elevation']][$value['class']][$status_inspection] += $value['total_weld_length'];
		}

		$this->load->view('home/dashboard/load_vs_inspection_progress', $data);
	}

}
