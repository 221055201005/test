<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Engineering extends CI_Controller
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
		$this->load->model('fitup_mod');
		$this->load->model('visual_mod');
		$this->load->model('ndt_mod');
		$this->load->model('irn_mod');
		$this->load->model('bondstrand_mod');
		$this->load->model('material_verification_mod');
		$this->load->model('itr_mod');
		$this->load->model('ndt_live_mod');

		$this->user_cookie 		  	= $data_cookies['data_user'];
		$this->permission_cookie  = $data_cookies['data_permission'];

		$this->sidebar 	= "engineering/sidebar";
	}

	public $detail_show_div = 'X';

	public function index()
	{
		redirect('engineering/status_drawing_list');
	}

	public function piecemark_list()
	{
		$data['get']   = $this->input->get();

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
			$desc_assy_list[$value['id']] = $value;
		}
		$data['desc_assy_list'] = $desc_assy_list;

		$datadb = $this->general_mod->company();
		$company_list = [];
		foreach ($datadb as $key => $value) {
			$company_list[$value['id_company']] = $value;
		}
		$data['company_list'] = $company_list;

		$data['user_permission'] = $this->permission_cookie;
		$data['meta_title']   = 'Piecemark List';
		$data['subview']      = 'engineering/piecemark_list';
		$data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
	}

	public function piecemark_list_datatable()
	{
		$piecemark_list = [];
		$post   = $this->input->post();
		if ($this->input->post('submit')) {
			$where = NULL;
			foreach ($post as $key => $value) {
				if ($value != "" && !in_array($key, ["submit", "status", "draw", "columns", "start", "length", "page", "search", "order"])) {
					$where[$key] = $value;
				}
			}
			if (!isset($post['status'])) {
				$post['status'] = "outstanding";
			}
			if ($post['status'] == "submitted") {
				$where["workpack_id IS NOT NULL"] = NULL;
				$where["workpack_id !="] = 0;
				$where["status_delete"] = 1;
			} elseif ($post['status'] == "deleted") {
				$where["status_delete"] = 0;
			} else {
				$where["workpack_id"] = NULL;
				$where["status_delete"] = 1;
			}
			$piecemark_list = $this->engineering_mod->piecemark_list_datatable_db("data", $where);
		}
		$data['piecemark_list'] = $piecemark_list;

		$id_piecemark = [];
		$id_piecemark_ref = [];
		$id_piecemark_irn_checked = [];
		foreach ($piecemark_list as $key => $value) {
			$id_piecemark[] = $value['id'];
			if ($value['ref_pos_1'] != '') {
				$id_piecemark_ref = array_merge($id_piecemark_ref, explode(", ", $value['ref_pos_1']));
			}
		}

		$piecemark_refrence_list = [];
		if (count($id_piecemark_ref) > 0) {
			$datadb = $this->engineering_mod->piecemark_list([
				"id IN (" . join(", ", $id_piecemark_ref) . ")" => null,
			]);
			foreach ($datadb as $key => $value) {
				$piecemark_refrence_list[$value['id']] = $value['part_id'];
			}
		}

		if (count($id_piecemark) > 0) {
			$datadb = $this->irn_mod->irn_raw_list([
				"id_piecemark IN (" . join(", ", $id_piecemark) . ")" => NULL,
				"status_inspection IN (7, 9)" => NULL,
			]);
			foreach ($datadb as $key => $value) {
				$id_piecemark_irn_checked[] = $value['id_piecemark'];
			}
		}

		$datadb = $this->general_mod->material_grade();
		$material_grade_list = [];
		foreach ($datadb as $key => $value) {
			$material_grade_list[$value['id']] = $value;
		}

		$datadb = $this->general_mod->desc_assy();
		$desc_assy_list = [];
		foreach ($datadb as $key => $value) {
			$desc_assy_list[$value['id']] = $value;
		}

		$datadb = $this->general_mod->piping_testing_category();
		$piping_testing_category_list = [];
		foreach ($datadb as $key => $value) {
			$piping_testing_category_list[$value['id']] = $value;
		}

		$data 	= [];
		foreach ($piecemark_list as $list) {
			$row   	= [];

			$status_revision_template = 0;
			if ($list['revise_id'] != '') {
				$status_revision_template = 1;
			}
			$status_irn_template = 0;
			if (in_array($list['id'], $id_piecemark_irn_checked)) {
				$status_irn_template = 1;
			}
			$row[] = $list['id'] . "|" . $status_revision_template . "|" . $status_irn_template;

			$row[] = $list['drawing_ga'];
			$row[] = $list['rev_ga'];
			$row[] = $list['drawing_as'];
			$row[] = $list['rev_as'];
			$row[] = $list['drawing_sp'];
			$row[] = $list['rev_sp'];
			$row[] = $list['part_id'];
			$ref_pos_1 = [''];
			if ($list['ref_pos_1'] != '') {
				$ref_pos_1 = [];
				$piecemark_refrence = explode(", ", $list['ref_pos_1']);
				foreach ($piecemark_refrence as $value) {
					$ref_pos_1[] = @$piecemark_refrence_list[$value];
				}
			}
			$row[] = join(", ", $ref_pos_1);
			$row[] = @$desc_assy_list[$list['description_assy']]['code'] . " - " . @$desc_assy_list[$list['description_assy']]['name'];
			$row[] = $list["drawing_cp"];
			$row[] = $list['rev_cp'];
			$row[] = $list["drawing_cl"];
			$row[] = $list['rev_cl'];
			$row[] = $list["profile"];
			$row[] = $list["material"];
			$row[] = @$material_grade_list[$list["grade"]]['material_grade'];
			$row[] = $list["diameter"];
			$row[] = $list["thickness"];
			$row[] = $list["sch"];
			$row[] = $list["length"];
			$row[] = $list["height"];
			$row[] = $list["width"];
			$row[] = number_format($list["weight"], 2, ".", "");
			$row[] = number_format($list["area"], 2, ".", "");
			$row[] = $list["can_number"];
			$row[] = $list["test_pack_no"];
			$row[] = $list["remarks"];
			$row[] = $list["item_code"];
			$row[] = $list["spool_no"];
			$row[] = $list["beam_chnl_thk"];
			$row[] = $list["strain_age_test_dt"];
			$row[] = $list["strain_age_test_yn"];
			$row[] = $list["through_thickness"];
			$row[] = @$piping_testing_category_list[$list['piping_testing_category']]['name'];
			$row[] = '<button type="button" class="btn btn-secondary btn-sm" onclick="open_history_log(' . $list['id'] . ')"><i class="fas fa-history"></i></button>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->engineering_mod->piecemark_list_datatable_db('count_all', $where),
			"recordsFiltered" => $this->engineering_mod->piecemark_list_datatable_db('count_filter', $where),
			"data" => $data
		);
		echo json_encode($output);
	}

	public function piecemark_update($method = '')
	{
		$post = $this->input->post();
		$post['id'] = explode(", ", $post['id']);
		if (count($post['id']) < 1) {
			$this->session->set_flashdata('error', 'No data selected!');
			redirect($_SERVER["HTTP_REFERER"]);
			return false;
		}
		if (count($post['id']) > 30) {
			$this->session->set_flashdata('error', 'Max selected item is 30!');
			redirect($_SERVER["HTTP_REFERER"]);
			return false;
		}
		if (!isset($post['submit'])) {
			$post['submit'] = 'edit';
		}
		if (@$post['action'] == "delete") {
			$datadb = $this->general_mod->manual_query_db("SELECT * FROM pcms_workpack_detail pwd JOIN pcms_workpack pw ON pwd.id_workpack = pw.id WHERE pw.phase = 'PF' AND pwd.status_delete = 1 AND pwd.status != 3 AND pwd.id_template IN (" . join(", ", $post['id']) . ")");
			if (count($datadb) > 0) {
				redirect($_SERVER["HTTP_REFERER"]);
			} else {
				foreach ($post['id'] as $key => $value) {
					$delete_permanent = 0;
					$datadb1 = $this->general_mod->manual_query_db("SELECT * FROM pcms_workpack_detail pwd JOIN pcms_workpack pw ON pwd.id_workpack = pw.id WHERE pw.phase = 'PF' AND pwd.id_template = " . $value . "");
					$datadb2 = $this->material_verification_mod->mv_list([
						'id_piecemark' => $value
					]);
					if (count($datadb1) == 0 && count($datadb2) == 0) {
						$delete_permanent = 1;
					}

					if ($delete_permanent == 0) {
						$where = ["id IN (" . join(", ", $post['id']) . ")" => NULL];
						$form_data = [
							"status_delete" => 0,
						];
						$this->engineering_mod->piecemark_update_process_db($form_data, $where);
					} else {
						$where = ["id IN (" . join(", ", $post['id']) . ")" => NULL];
						$this->engineering_mod->piecemark_delete_process_db($where);

						$where_meas = ["id_temp_pc IN (" . join(", ", $post['id']) . ")" => NULL];
						$this->engineering_mod->piecemark_measurement_delete_process_db($where_meas);
					}
				}

				$this->session->set_flashdata('success', 'Your data has been deleted!');
				redirect($_SERVER["HTTP_REFERER"]);
				return false;
			}
		}

		$where = [
			"id IN (" . join(", ", $post['id']) . ")" => NULL,
		];
		$data['piecemark_list'] = $this->engineering_mod->piecemark_list($where);
		$get = $data['piecemark_list'][0];

		$different_validation = $data['piecemark_list'][0]['description_assy'] . " - " . $data['piecemark_list'][0]['deck_elevation'] . " - " . $data['piecemark_list'][0]['status_internal'];
		$error = "";
		foreach ($data['piecemark_list'] as $key => $value) {
			if ($different_validation != $value['description_assy'] . " - " . $value['deck_elevation'] . " - " . $value['status_internal']) {
				$error = "Error : You select different Desc Assy or Deck or Status Internal";
			}
		}

		if ($method == "revise") {
			if (@$post['revise_id'] != '') {
				$request_list = $this->engineering_mod->revise_history_list([
					"id" => $post['revise_id'],
				]);
				$data['request_list'] = $request_list[0];
			} else {
				$error = "Error : Revise request data not found!";
			}
		}

		if ($error != "") {
			$this->session->set_flashdata('error', $error);
			redirect($_SERVER["HTTP_REFERER"]);
		}

		$piecemark_refrence_list = [];
		$datadb = $this->engineering_mod->piecemark_list([
			"drawing_ga" => $get['drawing_ga'],
		]);
		foreach ($datadb as $key => $value) {
			$piecemark_refrence_list[] = [
				"id" => $value['id'],
				"part_id" => $value['part_id'],
			];
		}
		$data['piecemark_refrence_list'] = $piecemark_refrence_list;

		$piecemark_refrence_list = [];
		$temp_piecemark_refrence_list = [];
		$datadb = $this->engineering_mod->piecemark_list([
			"drawing_ga" => $get['drawing_ga'],
			"status_delete" => 1,
		]);
		foreach ($datadb as $key => $value) {
			if (!isset($temp_piecemark_refrence_list[$value['id']])) {
				$temp_piecemark_refrence_list[$value['id']] = $value['part_id'];
			}
		}
		$data['piecemark_refrence_list'] = $temp_piecemark_refrence_list;
		// if(count($temp_piecemark_refrence_list) > 0){
		// 	$datadb = $this->material_verification_mod->mv_list([
		// 		"id_piecemark IN (".join(", ", array_keys($temp_piecemark_refrence_list)).")" => null,
		// 	]);
		// 	// test_var($datadb);
		// 	foreach ($datadb as $key => $value) {
		// 		if(isset($temp_piecemark_refrence_list[$value['id_piecemark']])){
		// 			$piecemark_refrence_list[$value['id_piecemark']] = $temp_piecemark_refrence_list[$value['id_piecemark']];
		// 		}
		// 	}
		// }
		// $data['piecemark_refrence_list'] = $piecemark_refrence_list;

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

		$datadb = $this->general_mod->material_grade();
		$material_grade_list = [];
		foreach ($datadb as $key => $value) {
			$material_grade_list[$value['id']] = $value;
		}
		$data['material_grade_list'] = $material_grade_list;

		$datadb = $this->general_mod->desc_assy();
		$desc_assy_list = [];
		foreach ($datadb as $key => $value) {
			$desc_assy_list[$value['id']] = $value;
		}
		$data['desc_assy_list'] = $desc_assy_list;

		$datadb = $this->general_mod->piping_testing_category();
		$piping_testing_category_list = [];
		foreach ($datadb as $key => $value) {
			$piping_testing_category_list[$value['id']] = $value;
		}
		$data['piping_testing_category_list'] = $piping_testing_category_list;

		$data['get'] = $get;
		// test_var($get);

		$data['method']   		= $method;

		$data['module']   		= 'Update';
		$data['meta_title']   = 'Update Piecemark for ' . $get['drawing_ga'];
		$data['subview']      = 'engineering/piecemark_new';
		$data['user_permission'] = $this->permission_cookie;
		$data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
	}

	public function piecemark_update_process()
	{
		$post = $this->input->post();
		$num = 0;
		$column_int = ['diameter', 'thickness', 'thickness', 'length', 'height', 'width', 'weight', 'area'];
		$piecemark_old = [];
		$piecemark_updated = [];
		$date_now = date("Y-m-d H:i:s");
		$fu_revise = [];
		$vt_revise = [];
		$mv_revise = [];

		$datadb = $this->general_mod->column_revision_log(["template" => 1]);
		$column_revision_log_list = [];
		foreach ($datadb as $key => $value) {
			$column_revision_log_list[$value['column_name']] = $value;
		}

		$datadb = $this->engineering_mod->piecemark_list(["id IN (" . join(", ", $post['id']) . ")" => NULL]);
		foreach ($datadb as $key => $value) {
			$piecemark_old[$value['id']] = $value;
			$revise_id = $value['revise_id'];
		}
		if ($post['method'] == "revise") {
			$request_list = $this->engineering_mod->revise_history_list([
				"id" => $revise_id,
			]);
			$request_list = $request_list[0];
		}

		foreach ($post['id'] as $key => $value) {
			foreach ($column_int as $column_no => $column_name) {
				if ($post[$column_name][$key] == '') {
					$post[$column_name][$key] = 0;
				}
			}

			$ref_pos_1 = null;
			if (isset($post['ref_pos_1'][$key]) && count($post['ref_pos_1'][$key]) > 0) {
				$ref_pos_1 = join(", ", $post['ref_pos_1'][$key]);
			}
			$form_data = [
				"description_assy" 			=> $post['description_assy'],
				"deck_elevation" 				=> $post['deck_elevation'],
				"status_internal" 			=> $post['status_internal'],
				"is_itr" 								=> $post['is_itr'],

				"rev_ga" 								=> $post['rev_ga'][$key],
				"drawing_as" 						=> trim($post['drawing_as'][$key]),
				"rev_as" 								=> $post['rev_as'][$key],
				"drawing_sp" 						=> trim($post['drawing_sp'][$key]),
				"rev_sp" 								=> $post['rev_sp'][$key],
				// "part_id" 							=> $post['part_id'][$key],
				"ref_pos_1" 						=> $ref_pos_1,
				"drawing_cp" 						=> trim($post['drawing_cp'][$key]),
				"rev_cp" 								=> $post['rev_cp'][$key],
				"drawing_cl" 						=> trim($post['drawing_cl'][$key]),
				"rev_cl" 								=> $post['rev_cl'][$key],
				"profile" 							=> $post['profile'][$key],
				"material" 							=> $post['material'][$key],
				"grade" 								=> $post['grade'][$key],
				"diameter" 							=> $post['diameter'][$key],
				"thickness" 						=> $post['thickness'][$key],
				"sch" 									=> $post['sch'][$key],
				"length" 								=> $post['length'][$key],
				"height" 								=> $post['height'][$key],
				"width" 								=> $post['width'][$key],
				"weight" 								=> $post['weight'][$key],
				"area" 									=> $post['area'][$key],
				"can_number" 						=> $post['can_number'][$key],
				"test_pack_no" 					=> $post['test_pack_no'][$key],
				"remarks" 							=> $post['remarks'][$key],
				"item_code" 						=> $post['item_code'][$key],
				"spool_no" 							=> $post['spool_no'][$key],
				"beam_chnl_thk" 				=> $post['beam_chnl_thk'][$key],
				"strain_age_test_dt" 		=> $post['strain_age_test_dt'][$key],
				"strain_age_test_yn" 		=> $post['strain_age_test_yn'][$key],
				"through_thickness" 		=> $post['through_thickness'][$key],
				"piping_testing_category" => $post['piping_testing_category'][$key],
			];

			$where = ["id" => $post['id'][$key]];
			if ($post['method'] == "revise") {
				// unset($form_data['description_assy']);
				unset($form_data['deck_elevation']);
				unset($form_data['status_internal']);
				unset($form_data['is_itr']);
				// unset($form_data['drawing_cp']);
				unset($form_data['drawing_cl']);
			}
			$this->engineering_mod->piecemark_update_process_db($form_data, $where);
			$num++;

			foreach ($form_data as $column => $new_data) {
				if ($new_data != $piecemark_old[$post['id'][$key]][$column]) {
					$name = ucwords(strtr($column, "_", " "));
					$name = explode(" ", $name);

					foreach ($name as $no_word => $word) {
						if (in_array(strtolower($word), ["ga", "as", "sp", "id", "cp", "cl", "wm", "pos", "wps"])) {
							$name[$no_word] = strtoupper($word);
						}
					}
					$name = join(" ", $name);
					$piecemark_updated[] = [
						"id_template" => $post['id'][$key],
						"module" => 1,
						"name" => $name,
						"column_name" => $column,
						"data_before" => $piecemark_old[$post['id'][$key]][$column],
						"data_after" => $new_data,
						"created_by" => $this->user_cookie[0],
						"created_date" => $date_now,
						"id_request_update" => $piecemark_old[$post['id'][$key]]['revise_id'],
					];
					if ($post['method'] == "revise") {
						if (isset($column_revision_log_list[$column])) {
							// if ($column_revision_log_list[$column]['mv'] == 1) {
							// 	$mv_revise[] = $post['id'][$key];
							// }
							// if ($column_revision_log_list[$column]['fu'] == 1) {
							// 	$fu_revise[] = $post['id'][$key];
							// }
							// if ($column_revision_log_list[$column]['vt'] == 1) {
							// 	$vt_revise[] = $post['id'][$key];
							// }
						}
					}
				}
			}
		}
		if ($post['method'] == "revise") {
			if (count($mv_revise) > 0) {
				$mv_list = $this->material_verification_mod->mv_list([
					"id_piecemark IN (" . join(", ", $mv_revise) . ")" => NULL,
					"status_delete" => 0,
				]);
				$id_material_arr = [];
				if (count($mv_list) > 0) {
					foreach ($mv_list as $key => $value) {
						if (!in_array($value['status_inspection'], [0, 1, 2, 4, 6]) && !isset($id_material_arr[$value['id_piecemark']])) {
							$id_material_arr[$value['id_piecemark']] = $value['id_material'];
							$status_inspection = $value['status_inspection'];
							if ($status_inspection == 7) {
								$status_inspection = 11;
							}
							$form_data = [
								"status_inspection" => 1,
								"revision_status_inspection" => 1,
								"inspection_client_by" => 999999,
								"inspection_client_datetime" => $date_now,
								"rejected_client_remarks" => $request_list['request_reason'],
							];
							if ($value['revision_status_inspection'] != '1') {
								$form_data["latest_inspection_status"] = $status_inspection;
							}
							$this->material_verification_mod->mv_update_process_db($form_data, [
								"id_material" => $value['id_material']
							]);
							if ($value['report_number'] != '' && $value['status_inspection'] == 7) {
								$mv_all_list = $this->material_verification_mod->mv_list([
									"project_code" => $value['project_code'],
									"report_number" => $value['report_number'],
									"discipline" => $value['discipline'],
									"report_no_rev" => $value['report_no_rev'],
									"status_delete" => 0,
									"id_piecemark !=" => $value['id_piecemark'],
								]);
								if (count($mv_all_list) > 0) {
									$id_material_all_arr = [];
									foreach ($mv_all_list as $key => $mv_all) {
										if ($mv_all['status_inspection'] == 7 && !isset($id_material_all_arr[$mv_all['id_piecemark']])) {
											$id_material_all_arr[$mv_all['id_piecemark']] = $mv_all['id_material'];
											$this->material_verification_mod->mv_update_process_db([
												"status_inspection" => 11,
												"inspection_client_by" => 999999,
												"inspection_client_datetime" => $date_now,
												// "rejected_client_remarks" => $request_list['request_reason'],
												"revision_status_inspection" => 0,
											], [
												"id_material" => $mv_all['id_material']
											]);
										}
									}
								}
							}

							$link_notif_encrypt = site_url('material_verification/detail_inspection_rfi/' . strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~') . '/' . strtr($this->encryption->encrypt($value['revision_status_inspection']), '+=/', '.-~'));
							$link_notif_encrypt = getenv('LINK_PCMS_PORTAL') . "/jump_url/redirect/" . strtr($this->encryption->encrypt($link_notif_encrypt), '+=/', '.-~');
							$link_notif_encrypt = strtr($this->encryption->encrypt($link_notif_encrypt), '+=/', '.-~');
							push_notification([
								"category_apps" => "Production & Quality",
								"designation_apps" => "MV",
								"user_designation" => "QC",
								"link_encrypt" => $link_notif_encrypt,
								"project_id" => $value['project_code'],
								"notification_text" => $this->user_cookie[1] . " Updated Piecemark " . $piecemark_old[$value['id_piecemark']]['part_id'] . " And Needs To Be Reviewed on Material Submission.",
							], $this->user_cookie);
						}
					}
				}
			}

			if (count($fu_revise) > 0) {
				$datadb = $this->engineering_mod->piecemark_list([
					"id IN (" . join(", ", $fu_revise) . ")" => NULL
				]);
				$part_id_arr = [];
				foreach ($datadb as $key => $value) {
					$part_id_arr[] = $value['part_id'];
				}
				$datadb = $this->engineering_mod->joint_list([
					"(pos_1 IN ('" . join("', '", $part_id_arr) . "') OR pos_2 IN ('" . join("', '", $part_id_arr) . "'))" => NULL,
					"status_delete" => 1,
				]);
				$id_joint_arr = [];
				foreach ($datadb as $key => $value) {
					$id_joint_arr[] = $value['id'];
				}

				if (count($id_joint_arr) > 0) {
					$datadb = $this->fitup_mod->fu_list([
						"id_joint IN (" . join(", ", $id_joint_arr) . ")" => NULL,
						"status_delete" => NULL,
					]);
					$id_fitup_arr = [];
					if (count($datadb) > 0) {
						foreach ($datadb as $key => $fitup) {
							if (!in_array($fitup['status_inspection'], [0, 1, 2, 4, 6]) && !isset($id_fitup_arr[$fitup['id_joint']])) {
								$id_fitup_arr[$fitup['id_joint']] = $fitup['id_fitup'];
								$status_inspection = $fitup['status_inspection'];
								if ($status_inspection == 7) {
									$status_inspection = 11;
								}
								$form_data = [
									"status_inspection" => 1,
									"revision_status_inspection" => 1,
									"client_inspection_by" => 999999,
									"client_inspection_date" => $date_now,
									"reoffer_remarks" => $request_list['request_reason'],
								];
								if ($fitup['revision_status_inspection'] != "1") {
									$form_data['latest_inspection_status'] = $status_inspection;
								}
								$this->fitup_mod->fu_update_process_db($form_data, [
									"id_fitup" => $fitup['id_fitup']
								]);

								if ($fitup['report_number'] != '' && $fitup['status_inspection'] == 7) {
									$fu_all_list = $this->fitup_mod->fu_list([
										"project_code" => $fitup['project_code'],
										"report_number" => $fitup['report_number'],
										"discipline" => $fitup['discipline'],
										"postpone_reoffer_no" => $fitup['postpone_reoffer_no'],
										"status_delete" => NULL,
										"id_joint !=" => $fitup['id_joint'],
									]);
									if (count($fu_all_list) > 0) {
										$id_fitup_all_arr = [];
										foreach ($fu_all_list as $key => $fu_all) {
											if ($fu_all['status_inspection'] == 7 && !isset($id_fitup_all_arr[$fu_all['id_joint']])) {
												$id_fitup_all_arr[$fu_all['id_joint']] = $fu_all['id_fitup'];
												$this->fitup_mod->fu_update_process_db([
													"status_inspection" => 11,
													"client_inspection_by" => 999999,
													"client_inspection_date" => $date_now,
													"reoffer_remarks" => $request_list['request_reason'],
													"revision_status_inspection" => 0,
												], [
													"id_fitup" => $fu_all['id_fitup']
												]);
											}
										}
									}
								}
							}
						}
					}
				}

				// if(count($id_joint_arr) > 0){
				// 	$datadb = $this->fitup_mod->fu_list([
				// 		"id_joint IN (".join(", ", $id_joint_arr).")" => NULL
				// 	]);
				// 	$id_fitup_arr = [];
				// 	if(count($datadb) > 0){
				// 		foreach ($datadb as $key => $value) {
				// 			if(!in_array($value['status_inspection'], [0, 1, 2, 4, 6]) && !isset($id_fitup_arr[$value['id_joint']])){
				// 				$id_fitup_arr[$value['id_joint']] = $value['id_fitup'];
				// 				$this->fitup_mod->fu_update_process_db([
				// 					"status_inspection" => 1,
				// 					"revision_status_inspection" => 1,
				// 					"latest_inspection_status" => $value['status_inspection'],
				// 				], [
				// 					"id_fitup" => $value['id_fitup']
				// 				]);
				// 			}
				// 		}
				// 	}
				// }
			} //

			$where = [
				"id IN (" . join(", ", $post['id']) . ")" => NULL,
			];
			$datadb = $this->engineering_mod->piecemark_list(["id" => $post['id'][0]]);
			$datadb = $datadb[0];
			$form_data = ["revise_id" => NULL];
			$where = ["revise_id" => $datadb["revise_id"]];
			$this->engineering_mod->piecemark_update_process_db($form_data, $where);

			$form_data = [
				"update_by" 	=> $this->user_cookie[0],
				"update_date" 	=> date("Y-m-d H:i:s"),
				"status_revise" 	=> 4,
			];
			$where = [
				"id" 	=> $datadb["revise_id"],
			];
			$this->engineering_mod->revise_history_update_process_db($form_data, $where);
			$get_text[] = "status=submitted";
		}

		if (count($piecemark_updated) > 0) {
			$this->engineering_mod->revision_log_import_process_db($piecemark_updated);
		}

		if ($num > 0) {
			$get_text[] = "drawing_ga=" . $post['drawing_ga_search'];
			$get_text[] = "discipline=" . $post['discipline'];
			$get_text[] = "module=" . $post['module'];
			$get_text[] = "project=" . $post['project'];
			$get_text[] = "drawing_as=" . $post['drawing_as_search'];
			$get_text[] = "type_of_module=" . $post['type_of_module'];
			$get_text[] = "deck_elevation=" . $post['deck_elevation'];
			$get_text[] = "submit=search";
			$this->session->set_flashdata('success', 'The Data has been Updated!');
			redirect("engineering/piecemark_list?" . join("&", $get_text));
		} else {
			$this->session->set_flashdata('error', 'No Data inputed!');
			redirect($_SERVER["HTTP_REFERER"]);
			return false;
		}
	}

	public function import_template()
	{
		$data['meta_title']   = 'Import Template';
		$data['user_permission'] = $this->permission_cookie;
		$data['subview']      = 'engineering/import_template';
		$data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
	}

	public function import_piecemark_preview()
	{
		error_reporting(0);

		$config['upload_path']          = 'file/engineering/';
		$config['file_name']            = 'excel_' . $this->user_cookie[0];
		$config['allowed_types']        = 'xlsx';
		$config['overwrite'] 						= TRUE;

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
		$drawing_check = array();
		$piecemark_refrence = array();
		$numrow = 1;
		foreach ($sheet as $no_row => $row) {
			if ($numrow > 1) {
				$data_check[] = $row['A'];

				foreach ($row as $key => $value) {
					if (in_array($key, ['G', 'I', 'K', 'M'])) {
						$sheet[$no_row][$key] = trim($value);
					} else {
						$sheet[$no_row][$key] = trim($value);
						if (in_array($key, ['H', 'J', 'L', 'Q', 'S']) && $value != '') {
							$sheet[$no_row][$key] = str_pad(trim($value), 2, '0', STR_PAD_LEFT);
						}
					}

					if (in_array($key, ['G', 'I', 'K', 'P', 'R']) && $sheet[$no_row][$key] != "") {
						$drawing_check[] = $sheet[$no_row][$key];
					}

					if (in_array($key, ['AS']) && $sheet[$no_row][$key] != "") {
						$unique_check[] = $sheet[$no_row][$key];
					}
					if (in_array($key, ['V']) && $sheet[$no_row][$key] != "") {
						$grade_check[] = $sheet[$no_row][$key];
					}
					if (in_array($key, ['AT']) && $sheet[$no_row][$key] != "") {
						$inspect_by_check[] = $this->encryption->decrypt(strtr($sheet[$no_row][$key], '.-~', '+=/'));
					}
					if (in_array($key, ['AT', 'AU']) && $sheet[$no_row][$key] != "") {
						$inspector_check[] = $sheet[$no_row][$key];
					}
				}

				$pos_list = explode(", ", $row['N']);
				if (count($pos_list) > 0 && $pos_list[0] != '') {
					foreach ($pos_list as $key => $value) {
						if (!in_array($value, $piecemark_refrence)) {
							$piecemark_refrence[] = $value;
						}
					}
				}
			}
			$numrow++;
		}

		$piecemark_refrence_list = [];
		if (count($piecemark_refrence) > 0) {
			$datadb = $this->engineering_mod->piecemark_list([
				"part_id IN ('" . join("', '", $piecemark_refrence) . "')" => null,
				"status_delete" => 1,
			]);
			foreach ($datadb as $key => $value) {
				if (!isset($temp_piecemark_refrence_list[$value['id']])) {
					$temp_piecemark_refrence_list[$value['id']] = $value['part_id'];
				}
			}
			if (count($temp_piecemark_refrence_list) > 0) {

				$datadb = $this->material_verification_mod->mv_list([
					"id_piecemark IN (" . join(", ", array_keys($temp_piecemark_refrence_list)) . ")" => null,
				]);
				foreach ($datadb as $key => $value) {
					if (isset($temp_piecemark_refrence_list[$value['id_piecemark']])) {
						$piecemark_refrence_list[$temp_piecemark_refrence_list[$value['id_piecemark']]] = $value['id_piecemark'];
					}
				}
			}
		}
		$data['piecemark_refrence_list'] = $piecemark_refrence_list;

		$existing_drawing = [];
		if (count($drawing_check) > 0) {
			$datadb = $this->engineering_mod->eng_drawing_list([
				"document_no IN ('" . join("', '", $drawing_check) . "')" => NULL,
				"status_delete" => 1,
				// "transmittal_status" => 1,
			]);
			foreach ($datadb as $key => $value) {
				$existing_drawing[] = $value['document_no'];
			}
		}
		$data['existing_drawing'] = $existing_drawing;

		$existing_unique = [];
		if (count($unique_check) > 0) {
			$datadb = $this->engineering_mod->wh_production_balance([
				"unique_no IN ('" . join("', '", $unique_check) . "')" => NULL,
				// "transmittal_status" => 1,
			]);
			foreach ($datadb as $key => $value) {
				$existing_unique[] = $value['unique_no'];
			}
		}
		// test_var($datadb);
		$data['existing_unique'] = $existing_unique;

		$existing_grade_unique = [];
		if (count($unique_check) > 0) {
			$datadb = $this->engineering_mod->qcs_material_list([
				"unique_ident_no IN ('" . join("', '", $existing_unique) . "')" => NULL,
			]);
			foreach ($datadb as $key => $value) {
				$existing_grade_unique[$value['unique_ident_no']] = $value['spec'];
			}
		}

		// test_var($existing_grade_unique);
		$data['existing_grade_unique'] = $existing_grade_unique;

		$mis_detail = [];
		if (count($unique_check) > 0) {
			$datadb = $this->engineering_mod->mis_detail_list_v2([
				"unique_ident_no IN ('" . join("', '", $existing_unique) . "')" => NULL,
			]);
			foreach ($datadb as $key => $value) {
				$mis_detail[$value['project_id']][$value['unique_ident_no']] = $value['id_mis_det'];
			}
		}
		// test_var($mis_detail);
		$data['id_mis_det'] = $mis_detail;



		// $where["document_no IN ('".join("', '", $data_check)."')"] = NULL;
		// $where['status_delete'] = 1;
		$document_duplicate		= $this->engineering_mod->piecemark_list([
			"status_delete" => 1,
		]);
		$d = array();
		foreach ($document_duplicate as $value) {
			$d[] = $value['part_id'];
		}
		$data['sheet'] = $sheet;
		$data['document_duplicate']		= $d;

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['initial']] = $value;
		}
		$data['discipline_list'] = $discipline_list;

		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['project_id']][$value['mod_desc']] = $value;
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
			$desc_assy_list[$value['id']] = $value;
		}
		$data['desc_assy_list'] = $desc_assy_list;

		$datadb = $this->general_mod->piping_testing_category();
		$piping_testing_category_list = [];
		foreach ($datadb as $key => $value) {
			$piping_testing_category_list[$value['id']] = $value;
		}
		$data['piping_testing_category_list'] = $piping_testing_category_list;

		$datadb = $this->general_mod->material_grade();
		$material_grade_list = [];
		foreach ($datadb as $key => $value) {
			$material_grade_list[$value['material_grade']] = $value;
		}
		$data['material_grade_list'] = $material_grade_list;

		$datadb = $this->general_mod->company();
		$company_list = [];
		foreach ($datadb as $key => $value) {
			$company_list[$value['company_name']] = $value;
		}
		$data['company_list'] = $company_list;

		if (count($inspector_check) > 0) {
			$where["id_user IN ('" . implode("', '", $inspect_by_check) . "')"] = NULL;
			$datadb = $this->general_mod->portal_user_db_list($where);
			// test_var($datadb);
			$user_list = [];
			foreach ($datadb as $key => $value) {
				$user_list[$value['id_user']] = $value;
			}
		}

		$data['user_list'] = $user_list;
		// test_var($user_list);

		$data['meta_title']   = 'Import Piecemark Preview';
		$data['subview']      = 'engineering/import_piecemark_preview';
		$data['sidebar']      = $this->sidebar;
		$data['user_permission'] = $this->permission_cookie;
		$this->load->view('index', $data);
	}

	public function import_piecemark_process()
	{
		error_reporting(0);


		$post = $this->input->post();
		// test_var($post);
		$form_data = [];
		$form_data_mv = [];
		$column_int = ['diameter', 'thickness', 'thickness', 'length', 'height', 'width', 'weight', 'area'];

		$key_workpack = [];
		foreach ($post['part_id'] as $key => $value) {
			$key_data	= $post['project'][$key] . '_' . $post['company_id'][$key] . '_' . $post['deck_elevation'][$key];
			$key_workpack[$key_data] = [
				'project'					=> $post['project'][$key],
				'company_id'			=> $post['company_id'][$key],
				'deck_elevation'	=> $post['deck_elevation'][$key]
			];
		}

		foreach ($key_workpack as $key => $value) {
			$form_data_wp = [
				"project" => $value['project'],
				"company_id" => $value['company_id'],
				"company_yard" => $value['company_id'],
				"deck_elevation" => $value['deck_elevation'],
				"company_third_party" => $value['company_id'],
			];

			$workpack_id[$value['project'] . '_' . $value['company_id'] . '_' . $value['deck_elevation']] = $this->planning_mod->workpack_new_process_db($form_data_wp);
		}

		$datadb                     = $this->general_mod->discipline();
		foreach ($datadb as $value) {
			$discipline[$value['id']] = $value;
		}

		$datadb                     = $this->general_mod->module();
		foreach ($datadb as $value) {
			$module[$value['mod_id']] = $value;
		}

		$datadb                     = $this->general_mod->type_of_module();
		foreach ($datadb as $value) {
			$type_of_module[$value['id']] = $value;
		}

		// create submission_id
		$submission_list = [];
		foreach ($post['part_id'] as $key => $value) {
			$key_data2	= $post['drawing_ga'][$key] . '_' . $post['project'][$key] . '_' . $post['discipline'][$key] . '_' . $post['module'][$key] . '_' . $post['type_of_module'][$key];
			$submission_list[$key_data2] = [
				"drawing_ga"		=> $post['drawing_ga'][$key],
				"project" 			=> $post['project'][$key],
				"module" 			=> $post['module'][$key],
				"type_of_module" 	=> $post['type_of_module'][$key],
				"discipline" 		=> $post['discipline'][$key],
				"project_code" 		=> $post['project_code'][$key],

			];
		}
		$temp_submission = [];
		foreach ($submission_list as $key => $value) {
			$discipline_name            = $discipline[$value['discipline']]['initial'];
			$discipline_name            = strtoupper($discipline_name);

			if ($discipline_name == "ST") {
				$discipline_name          = "STR";
			}

			$module_name 				= $module[$value['module']]['mod_desc'];
			$type_of_module_name		= $type_of_module[$value['type_of_module']]['code'];

			$where['project_code']      = $value['project'];
			$where['discipline']        = $value['discipline'];
			$where['module']            = $value['module'];
			$where['type_of_module']    = $value['type_of_module'];
			$where["submission_id not ILIKE	'%MVR%'"] = null;
			$last_submission_id         = $this->material_verification_mod->find_last_submission_id($where);

			$key_submission				= $value['drawing_ga'] . '_' . $value['project'] . '_' . $value['discipline'] . '_' . $value['module'] . '_' . $value['type_of_module'];
			$format_submission			= $value['project_code'] . '-' . $discipline_name . '-' . $module_name . '-' . $type_of_module_name . '-' . $last_submission_id;

			if (in_array($format_submission, $temp_submission)) {
				$parts 				= explode("-", $format_submission);
				$number 			= intval(end($parts));
				$number 			= str_pad($number + 1, 6, '0', STR_PAD_LEFT);
				$parts[count($parts) - 1]	= $number;
				$format_submission	= implode("-", $parts);
			}
			$temp_submission[]			= $format_submission;
			$submission_id[$key_submission] = $format_submission;

			unset($where);
		}

		foreach ($post['part_id'] as $key => $value) {
			foreach ($column_int as $column_no => $column_name) {
				if ($post[$column_name][$key] == '') {
					$post[$column_name][$key] = 0;
				}
			}

			$form_data = [
				"project" 							=> $post['project'][$key],
				"module" 							=> $post['module'][$key],
				"type_of_module" 					=> $post['type_of_module'][$key],
				"discipline" 						=> $post['discipline'][$key],
				"deck_elevation" 					=> $post['deck_elevation'][$key],
				"drawing_ga" 						=> $post['drawing_ga'][$key],
				"rev_ga" 							=> $post['rev_ga'][$key],
				"drawing_as" 						=> $post['drawing_as'][$key],
				"rev_as" 							=> $post['rev_as'][$key],
				"drawing_sp" 						=> $post['drawing_sp'][$key],
				"rev_sp" 							=> $post['rev_sp'][$key],
				"part_id" 							=> $post['part_id'][$key],
				"ref_pos_1" 						=> $post['ref_pos_1'][$key],
				"drawing_cp" 						=> $post['drawing_cp'][$key],
				"rev_cp" 							=> $post['rev_cp'][$key],
				"drawing_cl" 						=> $post['drawing_cl'][$key],
				"rev_cl" 							=> $post['rev_cl'][$key],
				"profile" 							=> $post['profile'][$key],
				"material" 							=> $post['material'][$key],
				"grade" 							=> $post['grade'][$key],
				"diameter" 							=> $post['diameter'][$key],
				"thickness" 						=> $post['thickness'][$key],
				"sch" 								=> $post['sch'][$key],
				"length" 							=> $post['length'][$key],
				"height" 							=> $post['height'][$key],
				"width" 							=> $post['width'][$key],
				"weight" 							=> $post['weight'][$key],
				"area" 								=> $post['area'][$key],
				"can_number" 						=> $post['can_number'][$key],
				"test_pack_no" 						=> $post['test_pack_no'][$key],
				"remarks" 							=> $post['remarks'][$key],
				"item_code" 						=> $post['item_code'][$key],
				"spool_no" 							=> $post['spool_no'][$key],
				"beam_chnl_thk" 					=> $post['beam_chnl_thk'][$key],
				"strain_age_test_dt" 				=> $post['strain_age_test_dt'][$key],
				"strain_age_test_yn" 				=> $post['strain_age_test_yn'][$key],
				"through_thickness" 				=> $post['through_thickness'][$key],
				"status_internal" 					=> ($post['status_internal'][$key]  ? $post['status_internal'][$key] : 0),
				"is_itr" 							=> $post['is_itr'][$key],
				"piping_testing_category" 			=> $post['piping_testing_category'][$key],
				"company_id" 						=> $post['company_id'][$key],

				"description_assy" 					=> $post['desc_assy'][$key],

				"created_by" 						=> $this->user_cookie[0],
				"workpack_id"						=> $workpack_id[$post['project'][$key] . '_' . $post['company_id'][$key] . '_' . $post['deck_elevation'][$key]],

				"service_line" 						=> $post['service_line'][$key],
			];

			if (count($form_data) < 1) {
				$this->session->set_flashdata('error', 'No Data inputed!');
				redirect($_SERVER["HTTP_REFERER"]);
				return false;
			}
			$id_template = $this->engineering_mod->piecemark_import_process_db_nobatch($form_data);
			//test_var($id_template);
			$insert_measure['id_temp_pc'] 	= $id_template;
			$insert_measure['pf_mv'] 		= 0;
			$insert_measure['f_fu'] 		= 0;
			$insert_measure['f_vs'] 		= 0;
			$insert_measure['f_ndt'] 		= 0;
			$insert_measure['as_fu'] 		= 0;
			$insert_measure['as_vs'] 		= 0;
			$insert_measure['as_ndt'] 		= 0;
			$insert_measure['er_fu'] 		= 0;
			$insert_measure['er_vs'] 		= 0;
			$insert_measure['er_ndt'] 		= 0;
			$this->engineering_mod->insert_pcms_summary($insert_measure);

			if (empty($post['inspect_by'][$key])) {
				$form_data_mv = [
					"project_code"				=> $post['project'][$key],
					"drawing_no"				=> $post['drawing_ga'][$key],
					"discipline"				=> $post['discipline'][$key],
					"module"					=> $post['module'][$key],
					"type_of_module"			=> $post['type_of_module'][$key],
					"drawing_type"				=> 1,
					"id_piecemark"				=> $id_template,
					"id_mis"					=> !empty($post['id_mis'][$key]) ? $post['id_mis'][$key] : 0,
					"status_inspection"			=> empty($post['request_date'][$key]) ? 0 : 1,
					"date_created"				=> DATE("Y-m-d H:i:s"),
					"surveyor_creator"			=> $this->user_cookie[0],
					"surveyor_created_date"		=> DATE("Y-m-d H:i:s"),
					"company_id"				=> $post['company_id'][$key],
					"id_workpack"				=> $workpack_id[$post['project'][$key] . '_' . $post['company_id'][$key] . '_' . $post['deck_elevation'][$key]],
				];
				$this->material_verification_mod->submit_material_verification($form_data_mv);

				// Count Production Balance
				if (!empty($post['unique_no'][$key])) {
					$list_balance_production = $this->material_verification_mod->balance_production_list(['unique_no' => $post['unique_no'][$key]]);
					$list_piecemark_workpack_detail = $this->material_verification_mod->piecemark_list(['id' => $id_template]);

					$total_length_bal = $list_balance_production[0]['bal_length'] - $list_piecemark_workpack_detail[0]['length'];
					$total_weight_bal = $list_balance_production[0]['bal_weight'] - $list_piecemark_workpack_detail[0]['weight'];

					$form_data_bal = [
						'bal_length' => $list_balance_production[0]['bal_length'] == 0 ? 0 : $total_length_bal,
						'bal_weight' => $list_balance_production[0]['bal_weight'] == 0 ? 0 : $total_weight_bal,
					];

					$where['unique_no'] = $post['unique_no'][$key];
					$this->material_verification_mod->update_production_balance($form_data_bal, $where);
					unset($form_data_bal, $where);
				}
			} else {
				$form_data_mv = [
					"project_code"				=> $post['project'][$key],
					"drawing_no"				=> $post['drawing_ga'][$key],
					"discipline"				=> $post['discipline'][$key],
					"module"					=> $post['module'][$key],
					"type_of_module"			=> $post['type_of_module'][$key],
					"drawing_type"				=> 1,
					"id_piecemark"				=> $id_template,
					"id_mis"					=> $post['id_mis'][$key],
					"status_inspection"			=> 3,
					"date_created"				=> DATE("Y-m-d H:i:s"),
					"surveyor_creator"			=> $this->user_cookie[0],
					"surveyor_created_date"		=> DATE("Y-m-d H:i:s"),
					"company_id"				=> $post['company_id'][$key],
					"id_workpack"				=> $workpack_id[$post['project'][$key] . '_' . $post['company_id'][$key] . '_' . $post['deck_elevation'][$key]],

					"requestor"					=> $this->user_cookie[0],
					"date_request"				=> $post['request_date'][$key] != '' ? $post['request_date'][$key] : null,
					"inspection_by"				=> $post['inspect_by'][$key],
					"inspection_datetime"		=> $post['inspection_date'][$key],
					"submission_id"				=> $submission_id[$post['drawing_ga'][$key] . '_' . $post['project'][$key] . '_' . $post['discipline'][$key] . '_' . $post['module'][$key] . '_' . $post['type_of_module'][$key]],
				];
				$this->material_verification_mod->submit_material_verification($form_data_mv);

				// Count Production Balance
				$list_balance_production = $this->material_verification_mod->balance_production_list(['unique_no' => $post['unique_no'][$key]]);
				$list_piecemark_workpack_detail = $this->material_verification_mod->piecemark_list(['id' => $id_template]);

				$total_length_bal = $list_balance_production[0]['bal_length'] - $list_piecemark_workpack_detail[0]['length'];
				$total_weight_bal = $list_balance_production[0]['bal_weight'] - $list_piecemark_workpack_detail[0]['weight'];

				$form_data_bal = [
					'bal_length' => $total_length_bal <= 0 ? 0 : $total_length_bal,
					'bal_weight' => $total_weight_bal <= 0 ? 0 : $total_weight_bal,
				];

				$where['unique_no'] = $post['unique_no'][$key];
				$this->material_verification_mod->update_production_balance($form_data_bal, $where);
				unset($form_data_bal, $where);
			}
		}

		$this->session->set_flashdata('success', 'The Data has been Imported!');
		redirect("engineering/import_template");
	}

	public function import_joint_preview()
	{
		error_reporting(0);
		$config['upload_path']          = 'file/engineering/';
		$config['file_name']            = 'excel_' . $this->user_cookie[0];
		$config['allowed_types']        = 'xlsx';
		$config['overwrite'] 						= TRUE;

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
		$data['sheet'] = $sheet;
		if (count($sheet) < 3) {
			$this->session->set_flashdata('error', 'No Data that listed in excel template!');
			redirect($_SERVER["HTTP_REFERER"]);
			return false;
		} elseif (count($sheet) > 303) {
			$this->session->set_flashdata('error', 'Maximum import is 300 row!');
			redirect($_SERVER["HTTP_REFERER"]);
			return false;
		}

		$data_check = array();
		$drawing_check = array();
		$user_id = [1000226];
		$numrow = 1;

		foreach ($sheet as $no_row => $row) {
			if ($numrow > 2) {
				$data_check[] = $row['A'];

				foreach ($row as $key => $value) {
					if (in_array($key, ['M'])) {
						$sheet[$no_row][$key] = trim($value);
					} else {
						$sheet[$no_row][$key] = trim($value);
						if (in_array($key, ['I', 'K']) && $value != '') {
							$sheet[$no_row][$key] = str_pad(trim($value), 2, '0', STR_PAD_LEFT);
						}
					}

					if (in_array($key, ['H', 'J']) && $sheet[$no_row][$key] != "") {
						$drawing_check[] = $sheet[$no_row][$key];
					}

					if (in_array($key, ['L']) && $sheet[$no_row][$key] != "") {
						$joint_check[] = $sheet[$no_row][$key];
					}

					if (in_array($key, ['G']) && $sheet[$no_row][$key] != "") {
						$drawing_type_check[] = $sheet[$no_row][$key];
					}

					if (in_array($key, ['M']) && $sheet[$no_row][$key] != "") {
						$ref_check1[] = $sheet[$no_row][$key];
					}
					if (in_array($key, ['O']) && $sheet[$no_row][$key] != "") {
						$ref_check2[] = $sheet[$no_row][$key];
					}

					if (in_array($key, ['N']) && $sheet[$no_row][$key] != "") {
						$piecemark_arr = $sheet[$no_row][$key];
						$piecemark_arr = explode(";", $piecemark_arr);
						$pos_check1 = array_merge($pos_check1 ?? [], $piecemark_arr);
					}
					if (in_array($key, ['P']) && $sheet[$no_row][$key] != "") {
						$piecemark_arr = $sheet[$no_row][$key];
						$piecemark_arr = explode(";", $piecemark_arr);
						$pos_check2 = array_merge($pos_check2 ?? [], $piecemark_arr);
					}

					if (in_array($key, ['AP']) && $sheet[$no_row][$key] != "") {
						$user_id[] = decrypt($sheet[$no_row][$key]);
					}
					if (in_array($key, ['AZ']) && $sheet[$no_row][$key] != "") {
						$user_id[] = decrypt($sheet[$no_row][$key]);
					}
				}
			}
			$numrow++;
		}

		$pos_check1 = array_unique(array_unique($pos_check1));
		$pos_check2 = array_unique(array_unique($pos_check2));

		$existing_pos1 = [];
		if (array_intersect($drawing_type_check, ['GA', 'MS', 'NDT - GA', 'PS', 'ISO', 'NDT - AS'])) {
			$datadb = $this->engineering_mod->piecemark_list([
				// "(part_id LIKE '".$pos_check1."' OR part_id LIKE '".$pos_check2."')" => NULL,
				"part_id IN ('" . join("', '", $pos_check1) . "')" => NULL,
				// "drawing_ga IN ('" . join("', '", $drawing_check) . "')" => NULL,
				// "ref_pos_1 IN ('".join("', '", NULL)."')" => NULL,
				// "ref_pos_2 IN ('".join("', '", $ref_check2)."')" => NULL,
			]);
			// test_var($datadb);
			foreach ($datadb as $key => $value) {
				$id_piecemark[] = $value["id"];
				$data['master_piecemark'][$value["id"]] = $value["part_id"];
				$data['master_piecemarks'][$value["part_id"]] = $value["id"];
				$existing_pos1[] = $value['part_id'];
			}
		} else {
			$datadb = $this->engineering_mod->piecemark_list([
				// "(part_id LIKE '".$pos_check1."' OR part_id LIKE '".$pos_check2."')" => NULL,
				"part_id IN ('" . join("', '", $pos_check1) . "')" => NULL,
				// "drawing_as IN ('" . join("', '", $drawing_check) . "')" => NULL,
				// "ref_pos_1 IN ('".join("', '", NULL)."')" => NULL,
				// "ref_pos_2 IN ('".join("', '", $ref_check2)."')" => NULL,
			]);
			foreach ($datadb as $key => $value) {
				$id_piecemark[] = $value["id"];
				$data['master_piecemark'][$value["id"]] = $value["part_id"];
				$data['master_piecemarks'][$value["part_id"]] = $value["id"];
				$existing_pos1[] = $value['part_id'];
			}
		}

		$data['existing_pos1'] = $existing_pos1;

		$existing_pos2 = [];
		if (array_intersect($drawing_type_check, ['GA', 'MS', 'NDT - GA', 'PS', 'ISO', 'NDT - AS'])) {
			$datadb = $this->engineering_mod->piecemark_list([
				// "(part_id LIKE '".$pos_check1."' OR part_id LIKE '".$pos_check2."')" => NULL,
				"part_id IN ('" . join("', '", $pos_check2) . "')" => NULL,
				// "drawing_ga IN ('" . join("', '", $drawing_check) . "')" => NULL,
				// "ref_pos_1 IN ('".join("', '", NULL)."')" => NULL,
				// "ref_pos_2 IN ('".join("', '", $ref_check2)."')" => NULL,
			]);
			foreach ($datadb as $key => $value) {
				$id_piecemark[] = $value["id"];
				$data['master_piecemark'][$value["id"]] = $value["part_id"];
				$data['master_piecemarks'][$value["part_id"]] = $value["id"];
				$existing_pos2[] = $value['part_id'];
			}
		} else {
			$datadb = $this->engineering_mod->piecemark_list([
				// "(part_id LIKE '".$pos_check1."' OR part_id LIKE '".$pos_check2."')" => NULL,
				"part_id IN ('" . join("', '", $pos_check2) . "')" => NULL,
				// "drawing_as IN ('" . join("', '", $drawing_check) . "')" => NULL,
				// "ref_pos_1 IN ('".join("', '", NULL)."')" => NULL,
				// "ref_pos_2 IN ('".join("', '", $ref_check2)."')" => NULL,
			]);
			foreach ($datadb as $key => $value) {
				$id_piecemark[] = $value["id"];
				$data['master_piecemark'][$value["id"]] = $value["part_id"];
				$data['master_piecemarks'][$value["part_id"]] = $value["id"];
				$existing_pos2[] = $value['part_id'];
			}
		}

		$data['existing_pos2'] = $existing_pos2;

		if ($id_piecemark) {
			$datadb = $this->material_verification_mod->mv_list(["id_piecemark IN (" . implode(", ", $id_piecemark) . ")" => NULL]);
			foreach ($datadb as $key => $value) {
				$data["mv_valid"][$data['master_piecemark'][$value["id_piecemark"]]] = $value;
			}
		}
		// test_var($datadb);

		$existing_joint = [];
		$datadb = $this->engineering_mod->joint_list([
			"joint_no IN ('" . join("', '", $joint_check) . "')" => NULL,
			"drawing_wm IN ('" . join("', '", $drawing_check) . "')" => NULL,
			"status_delete" => 1,
		]);
		if (count($datadb) > 0) {
			foreach ($datadb as $key => $value) {
				$existing_joint[] = $value['drawing_wm'] . ';' . $value['joint_no'];
			}
		}

		$welder_wps_array_cek = [];
		$datadb = $this->general_mod->welder_wps_array();
		foreach ($datadb as $key => $value) {
			$welder_wps_array_cek[$value['welder_code']][] = $value['wps_no'];
		}
		$data['welder_wps_array_cek'] = $welder_wps_array_cek;

		$data['existing_joint'] = $existing_joint;

		$existing_drawing = [];
		if (count($drawing_check) > 0) {
			$datadb = $this->engineering_mod->eng_drawing_list([
				"document_no IN ('" . join("', '", $drawing_check) . "')" => NULL,
				"status_delete" => 1,
				// "transmittal_status" => 1,
			]);
			foreach ($datadb as $key => $value) {
				$existing_drawing[] = $value['document_no'];
			}
		}

		$data['existing_drawing'] = $existing_drawing;

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['initial']] = $value;
		}
		$data['discipline_list'] = $discipline_list;

		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['project_id']][$value['mod_desc']] = $value;
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
			$desc_assy_list[$value['id']] = $value;
		}

		$data['desc_assy_list'] = $desc_assy_list;

		$datadb = $this->general_mod->drawing_type();
		$drawing_type_list = [];
		foreach ($datadb as $key => $value) {
			$drawing_type_list[$value['code']] = $value;
		}
		$data['drawing_type_list'] = $drawing_type_list;

		$datadb = $this->general_mod->joint_type();
		$joint_type_list = [];
		foreach ($datadb as $key => $value) {
			$joint_type_list[$value['joint_type_code']] = $value;
		}
		$data['joint_type_list'] = $joint_type_list;

		$datadb = $this->general_mod->master_wps_new();
		$wps_list = [];
		foreach ($datadb as $key => $value) {
			$wps_list[$value['wps_no']] = $value;
		}
		$data['wps_list'] = $wps_list;

		$datadb = $this->general_mod->weld_type();
		foreach ($datadb as $value) {
			$data['weld_type'][$value['weld_type_code']]  = $value;
		}

		$datadb = $this->general_mod->joint_type();
		foreach ($datadb as $value) {
			$data['joint_type'][$value['joint_type_code']]  = $value;
		}

		$datadb = $this->general_mod->class();
		foreach ($datadb as $value) {
			$data['data_class'][$value['id']]  = $value;

			$datadb = $this->general_mod->type_of_weld();
			$type_of_weld_list = [];
			foreach ($datadb as $key => $value) {
				$type_of_weld_list[$value['id']] = $value;
			}
			$data['type_of_weld_list'] = $type_of_weld_list;
		}

		if ($user_id) {
			$data['master_user'] = user_name_data($user_id);
		}

		$datadb = $this->general_mod->master_welder();

		foreach ($datadb as $key => $value) {
			$data["welder"][$value["project_id"]][] = $value;
			$data["valid_welder"][$value["welder_code"]][] = $value;
		}

		$datadb = $this->general_mod->company();
		$company_list = [];
		foreach ($datadb as $key => $value) {
			$company_list[$value['company_name']] = $value;
		}
		$data['company_list'] = $company_list;

		$data['meta_title']   = 'Import Joint Preview';
		$data['subview']      = 'engineering/import_joint_preview';
		$data['sidebar']      = $this->sidebar;
		$data['user_permission'] = $this->permission_cookie;
		$this->load->view('index', $data);
	}

	public function import_joint_process()
	{
		error_reporting(0);
		$post = $this->input->post();

		$date_now = date("Y-m-d H:i:s");
		$form_data = [];
		$column_int = ['thickness', 'diameter', 'length', 'weld_length', 'class', 'mt_percent_req', 'pt_percent_req', 'ut_percent_req', 'rt_percent_req', 'pwht_percent_req'];
		foreach ($post['joint_no'] as $key => $value) {
			foreach ($column_int as $column_no => $column_name) {
				if ($post[$column_name][$key] == '') {
					$post[$column_name][$key] = 0;
				}
			}
			// print_r($post['drawing_no'][$key]);
			$wps = [];
			foreach ($post['wps'][$key + 2] as $wps_input) {
				if ($wps_input != -1) {
					$wps[] = $wps_input;
				}
			}

			// print_r();

			$form_data = [

				"drawing_no" 			=> $post['drawing_no'][$key],
				"rev_no" 					=> $post['rev_no'][$key],
				"discipline" 			=> $post['discipline'][$key],
				"module" 					=> $post['module'][$key],
				"project" 				=> $post['project'][$key],
				"drawing_wm" 			=> $post['drawing_wm'][$key],
				"rev_wm" 					=> $post['rev_wm'][$key],
				"drawing_type" 		=> $post['drawing_type'][$key],
				"type_of_module" 	=> $post['type_of_module'][$key],
				"deck_elevation" 	=> $post['deck_elevation'][$key],
				"is_bondstrand" 	=> $post['is_bondstrand'][$key] == 'NO' ? 1 : 0,

				"description_assy" 	=> $post['desc_assy'][$key],

				"joint_no" 			=> $post['joint_no'][$key],
				"pos_1" 			=> $post['pos_1'][$key],
				"ref_1" 			=> $post['ref_1'][$key],
				"pos_2" 			=> $post['pos_2'][$key],
				"ref_2" 			=> $post['ref_2'][$key],
				"weld_type" 		=> $post['weld_type'][$key],
				"thickness" 		=> $post['thickness'][$key],
				"diameter" 			=> $post['diameter'][$key],
				"sch" 				=> $post['sch'][$key],
				"length" 			=> $post['length'][$key],
				"weld_length" 		=> $post['weld_length'][$key],
				"joint_type" 		=> $post['joint_type'][$key],
				"test_pack_no" 		=> $post['test_pack_no'][$key],
				"spool_no" 			=> $post['spool_no'][$key],
				"service_line" 		=> $post['service_line'][$key],
				"pid_drawing" 		=> $post['pid_drawing'][$key],
				"class" 			=> $post['class'][$key],
				"grid_row" 			=> $post['grid_row'][$key],
				"grid_column" 			=> $post['grid_column'][$key],
				"mt_percent_req" 	=> $post['mt_percent_req'][$key],
				"pt_percent_req" 	=> $post['pt_percent_req'][$key],
				"ut_percent_req" 	=> $post['ut_percent_req'][$key],
				"rt_percent_req" 	=> $post['rt_percent_req'][$key],
				"pwht_percent_req" 	=> $post['pwht_percent_req'][$key],
				"remarks" 			=> $post['remarks'][$key],
				"wps" 			=> join(";", $wps),
				"phase" 			=> $post['phase'][$key],
				"status" 			=> 1,
				"created_by" 		=> $this->user_cookie[0],
				"created_date" 		=> $date_now,
				"company_id" 		=> $post['company_id'][$key],
			];

			$id_joint_arr[] = $this->engineering_mod->joint_new_process_db($form_data);

			if (count($form_data) < 1) {
				$this->session->set_flashdata('error', 'No Data inputed!');
				redirect($_SERVER["HTTP_REFERER"]);
				return false;
			}
		}
		// test_var($form_data);


		$this->session->set_flashdata('success', 'The Data has been Imported!');
		redirect("engineering/import_template");
	}

	public function joint_list()
	{
		$data['get']   = $this->input->get();
		$joint_list = [];
		if ($this->input->get('submit')) {
			if ($this->input->get('submit') == 'add') {
				// $this->session->set_flashdata('get', $this->input->get());
				$get_text = [];
				foreach ($this->input->get() as $key => $value) {
					$get_text[] = $key . "=" . $value;
				}
				redirect("engineering/joint_new?" . join("&", $get_text));
				return false;
			}
		}

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

		$datadb = $this->general_mod->drawing_type();
		$drawing_type_list = [];
		foreach ($datadb as $key => $value) {
			$drawing_type_list[$value['code']] = $value;
		}
		$data['drawing_type_list'] = $drawing_type_list;

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['id']] = $value;
		}
		$data['type_of_module_list'] = $type_of_module_list;

		$datadb = $this->general_mod->deck_elevation();
		$deck_elevation_list = [];
		foreach ($datadb as $key => $value) {
			$deck_elevation_list[$value['id']] = $value;
		}
		$data['deck_elevation_list'] = $deck_elevation_list;

		$datadb = $this->general_mod->desc_assy();
		$desc_assy_list = [];
		foreach ($datadb as $key => $value) {
			$desc_assy_list[$value['id']] = $value;
		}
		$data['desc_assy_list'] = $desc_assy_list;

		$datadb = $this->general_mod->company();
		$company_list = [];
		foreach ($datadb as $key => $value) {
			$company_list[$value['id_company']] = $value;
		}
		$data['company_list'] = $company_list;

		$data['meta_title']   = 'Joint List';
		$data['subview']      = 'engineering/joint_list';
		$data['sidebar']      = $this->sidebar;
		$data['user_permission'] = $this->permission_cookie;
		$this->load->view('index', $data);
	}

	public function joint_list_datatable()
	{
		$joint_list = [];
		$post   = $this->input->post();
		if ($this->input->post('submit')) {
			$where = NULL;
			foreach ($post as $key => $value) {
				if ($value != "" && !in_array($key, ["submit", "status", "draw", "columns", "start", "length", "page", "search", "order"])) {
					$where[$key] = $value;
				}
				if (!isset($post['status'])) {
					$post['status'] = "draft";
				}

				$where["status_delete"] = 1;
				if ($post['status'] == "submitted") {
					$where["workpack_id IS NOT NULL"] = NULL;
					$where["workpack_id !="] = 0;
					$where["status"] = 1;
				} elseif ($post['status'] == "deleted") {
					$where["status_delete"] = 0;
				} elseif ($post['status'] == "draft") {
					$where["status"] = 0;
				} else {
					$where["workpack_id"] = NULL;
					$where["status"] = 1;
				}
			}
			$joint_list = $this->engineering_mod->joint_list_datatable_db("data", $where);
		}

		$id_joint = [];
		$id_joint_irn_checked = [];
		foreach ($joint_list as $key => $value) {
			$id_joint[] = $value['id'];
		}
		if (count($id_joint) > 0) {
			$datadb = $this->engineering_mod->check_irn_template([
				"pi.id_joint IN (" . join(", ", $id_joint) . ")" => NULL,
				"pi.category_irn" => 0,
				"(pids.validator_auth = 1 OR pi.status_inspection IN (7, 9))" => NULL,
			]);
			foreach ($datadb as $key => $value) {
				$id_joint_irn_checked[] = $value['id_joint'] . $value['drawing_no'];;
			}
		}

		$datadb = $this->general_mod->weld_type();
		$weld_type = [];
		foreach ($datadb as $key => $value) {
			$weld_type[$value['id']] = $value;
		}

		$datadb = $this->general_mod->joint_type();
		$joint_type = [];
		foreach ($datadb as $key => $value) {
			$joint_type[$value['id']] = $value;
		}

		$datadb = $this->general_mod->class();
		$class_list = [];
		foreach ($datadb as $key => $value) {
			$class_list[$value['id']] = $value;
		}

		$datadb = $this->general_mod->desc_assy();
		$desc_assy_list = [];
		foreach ($datadb as $key => $value) {
			$desc_assy_list[$value['id']] = $value;
		}

		$data 	= [];
		foreach ($joint_list as $list) {

			$view_p1 = str_replace(";", "<hr/>", $list['pos_1']);

			$view_p2 = str_replace(";", "<hr/>", $list['pos_2']);

			$row   	= [];

			$status_revision_template = 0;
			if ($list['revise_id'] != '') {
				$status_revision_template = 1;
			}
			$status_irn_template = 0;
			if (in_array($list['id'] . $list['drawing_no'], $id_joint_irn_checked)) {
				$status_irn_template = 1;
			}
			$row[] = $list['id'] . "|" . $status_revision_template . "|" . $status_irn_template;
			$row[] = $list['drawing_no'];
			$row[] = $list['rev_no'];
			$row[] = $list['drawing_wm'];
			$row[] = $list['rev_wm'];
			$row[] = $list['joint_no'];
			$row[] = $view_p1;
			$row[] = $view_p2;
			$row[] = @$weld_type[$list['weld_type']]['weld_type_code'];
			$row[] = @$desc_assy_list[$list['description_assy']]['code'] . " - " . @$desc_assy_list[$list['description_assy']]['name'];
			$row[] = $list['phase'];
			$row[] = $list['thickness'];
			$row[] = $list['diameter'];
			$row[] = $list['sch'];
			$row[] = $list['length'];
			$row[] = number_format($list['weld_length'], 1);
			$row[] = @$joint_type[$list['joint_type']]['joint_type_code'];
			$row[] = $list['test_pack_no'];
			$row[] = $list['spool_no'];
			$row[] = $list['service_line'];
			$row[] = $list['pid_drawing'];
			$row[] = @$class_list[$list['class']]['class_code'];
			$row[] = $list['grid_row'];
			$row[] = $list['grid_column'];
			$row[] = $list['mt_percent_req'];
			$row[] = $list['pt_percent_req'];
			$row[] = $list['ut_percent_req'];
			$row[] = $list['rt_percent_req'];
			$row[] = $list['pwht_percent_req'];
			$row[] = $list['pmi_percent_req'];
			$row[] = $list['remarks'];
			$row[] = '<button type="button" class="btn btn-secondary btn-sm" onclick="open_history_log(' . $list['id'] . ')"><i class="fas fa-history"></i></button>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->engineering_mod->joint_list_datatable_db('count_all', $where),
			"recordsFiltered" => $this->engineering_mod->joint_list_datatable_db('count_filter', $where),
			"data" => $data
		);
		echo json_encode($output);
	}

	public function joint_new()
	{
		if ($this->input->get('submit') == TRUE) {
			$get = $this->input->get();
		} else {
			redirect('engineering/joint_list');
		}
		$data['get']   = $get;

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

		$datadb = $this->general_mod->drawing_type();
		$drawing_type_list = [];
		foreach ($datadb as $key => $value) {
			$drawing_type_list[$value['code']] = $value;
		}
		$data['drawing_type_list'] = $drawing_type_list;

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['id']] = $value;
		}
		$data['type_of_module_list'] = $type_of_module_list;

		$datadb = $this->general_mod->deck_elevation();
		$deck_elevation_list = [];
		foreach ($datadb as $key => $value) {
			$deck_elevation_list[$value['id']] = $value;
		}
		$data['deck_elevation_list'] = $deck_elevation_list;

		$datadb = $this->general_mod->weld_type();
		$weld_type_list = [];
		foreach ($datadb as $key => $value) {
			$weld_type_list[$value['id']] = $value;
		}
		$data['weld_type_list'] = $weld_type_list;

		$datadb = $this->general_mod->joint_type();
		$joint_type_list = [];
		foreach ($datadb as $key => $value) {
			$joint_type_list[$value['id']] = $value;
		}
		$data['joint_type_list'] = $joint_type_list;

		$datadb = $this->general_mod->desc_assy();
		$desc_assy_list = [];
		foreach ($datadb as $key => $value) {
			$desc_assy_list[$value['id']] = $value;
		}
		$data['desc_assy_list'] = $desc_assy_list;

		$datadb = $this->general_mod->class();
		$class_list = [];
		foreach ($datadb as $key => $value) {
			$class_list[$value['id']] = $value;
		}
		$data['class_list'] = $class_list;

		$datadb = $this->general_mod->master_wps_new([
			"project_id" => $get['project'],
			"discipline" => $get['discipline'],
		]);
		$wps_list = [];
		foreach ($datadb as $key => $value) {
			$wps_list[$value['id_wps']] = $value['wps_no'];
		}
		$data['wps_list'] = $wps_list;

		$data['module']   		= 'New';
		$data['method']   		= "";
		$data['meta_title']   = 'Add New Joint for ' . $get['drawing_no'];
		$data['subview']      = 'engineering/joint_new';
		$data['sidebar']      = $this->sidebar;
		$data['user_permission'] = $this->permission_cookie;
		$this->load->view('index', $data);
	}

	public function joint_new_process()
	{
		$post = $this->input->post();

		// insert workpack main
		$form_data = [
			"drawing_no" 	  => trim($post['drawing_no']),
			"project" 		  => $post['project'],
			"discipline" 	  => $post['discipline'],
			"module" 		  => $post['module'],
			"type_of_module"  => $post['type_of_module'],
			"deck_elevation"  => $post['deck_elevation'],
			"phase" 		  => $post['phase'][0],
			"desc_assy" 	  => $post['description_assy'],
			"type" 			  => 1,
			"company_id" 	  => $post['company_id'],
			"company_yard" 	  => $post['company_id'],
			"workpack_no" 	  => uniqid(),
		];
		$workpack_id = $this->planning_mod->workpack_new_process_db($form_data);
		unset($form_data);

		$rebuild_array_pos_1 = array_values($post["pos_1"]);
		$rebuild_array_pos_2 = array_values($post["pos_2"]);
		$rebuild_array_wps   = array_values($post["wps"]);

		$num = 0;
		$id_joint_arr = [];
		$duplicate_now = [];
		$date_now = date("Y-m-d H:i:s");
		$column_int = ['thickness', 'diameter', 'length', 'weld_length', 'class', 'mt_percent_req', 'pt_percent_req', 'ut_percent_req', 'rt_percent_req', 'pwht_percent_req'];
		foreach ($post['joint_no'] as $key => $value) {
			if ($post['joint_no'][$key] != '') {
				$datadb = $this->engineering_mod->joint_list([
					// "drawing_no" 			=> $post['drawing_no'],
					// "discipline" 			=> $post['discipline'],
					// "module" 				=> $post['module'],
					// "project" 				=> $post['project'],
					"drawing_wm" 			=> $post['drawing_wm'],
					// "drawing_type" 			=> $post['drawing_type'],
					// "type_of_module" 		=> $post['type_of_module'],
					// "deck_elevation" 		=> $post['deck_elevation'],
					// "description_assy" 		=> $post['description_assy'],
					"joint_no" 		=> $post['joint_no'][$key],
					"status_delete" => 1,
				]);
				$duplicate = false;
				if (count($datadb) > 0) {
					$duplicate = true;
				}
				if ($duplicate == false) {
					foreach ($column_int as $column_no => $column_name) {
						if ($post[$column_name][$key] == '') {
							$post[$column_name][$key] = 0;
						}
					}
					// $datadb = $this->engineering_mod->joint_list([
					// 	// "(joint_no = '".$post["joint_no"]."' OR (pos_1 = '".$post["pos_1"]."' AND pos_2 = '".$post["pos_2"]."'))" => NULL,
					// 	"joint_no" 				=> $post['joint_no'][$key],
					// 	"drawing_no" 			=> $post["drawing_no"],
					// 	"discipline" 			=> $post["discipline"],
					// 	"module" 					=> $post["module"],
					// 	"project" 				=> $post["project"],
					// 	// "drawing_wm" 			=> $post["drawing_wm"],
					// 	"drawing_type" 		=> $post["drawing_type"],
					// 	"type_of_module" 	=> $post["type_of_module"],
					// 	"deck_elevation" 	=> $post["deck_elevation"],
					// ]);

					$wps = [];
					foreach ($rebuild_array_wps[$key] as $wps_input) {
						if ($wps_input != -1) {
							$wps[] = $wps_input;
						}
					}

					$pos_1 = [];
					foreach ($rebuild_array_pos_1[$key] as $pos_1_input) {
						if ($pos_1_input != -1) {
							$pos_1[] = $pos_1_input;
						}
					}

					$pos_2 = [];
					foreach ($rebuild_array_pos_2[$key] as $pos_2_input) {
						if ($pos_2_input != -1) {
							$pos_2[] = $pos_2_input;
						}
					}

					$form_data = [
						"drawing_no" 		=> $post['drawing_no'],
						"rev_no" 			=> $post['rev_no'][$key],
						"discipline" 		=> $post['discipline'],
						"module" 			=> $post['module'],
						"project" 			=> $post['project'],
						"drawing_wm" 		=> $post['drawing_wm'],
						"rev_wm" 			=> $post['rev_wm'][$key],
						"drawing_type" 		=> $post['drawing_type'],
						"type_of_module" 	=> $post['type_of_module'],
						"deck_elevation" 	=> $post['deck_elevation'],
						"is_bondstrand" 	=> $post['is_bondstrand'],
						"description_assy" 	=> $post['description_assy'],
						"joint_no" 			=> $post['joint_no'][$key],
						"pos_1" 			=> join(";", $pos_1),
						"ref_1" 			=> (isset($post['ref_1'][$key]) && !empty($post['ref_1'][$key]) ? $post['ref_1'][$key] : null),
						"pos_2" 			=> join(";", $pos_2),
						"ref_2" 			=> (isset($post['ref_2'][$key]) && !empty($post['ref_2'][$key]) ? $post['ref_2'][$key] : null),
						"weld_type" 		=> $post['weld_type'][$key],
						"thickness" 		=> $post['thickness'][$key],
						"diameter" 			=> $post['diameter'][$key],
						"sch" 				=> $post['sch'][$key],
						"length" 			=> $post['length'][$key],
						"weld_length" 		=> $post['weld_length'][$key],
						"joint_type" 		=> $post['joint_type'][$key],
						"test_pack_no" 		=> $post['test_pack_no'][$key],
						"spool_no" 			=> $post['spool_no'][$key],
						"service_line" 		=> $post['service_line'][$key],
						"pid_drawing" 		=> $post['pid_drawing'][$key],
						"class" 			=> $post['class'][$key],
						"grid_row" 			=> $post['grid_row'][$key],
						"grid_column" 		=> $post['grid_column'][$key],
						"mt_percent_req" 	=> $post['mt_percent_req'][$key],
						"pt_percent_req" 	=> $post['pt_percent_req'][$key],
						"ut_percent_req" 	=> $post['ut_percent_req'][$key],
						"rt_percent_req" 	=> $post['rt_percent_req'][$key],
						"pwht_percent_req" 	=> $post['pwht_percent_req'][$key],
						"workpack_id" 		=> $workpack_id,
						"remarks" 			=> $post['remarks'][$key],
						"wps" 				=> join(";", $wps),
						"phase" 			=> $post['phase'][$key],
						"status" 			=> 0,
						"created_by" 		=> $this->user_cookie[0],
						"created_date" 		=> $date_now,
					];
					$id_joint_arr[] = $this->engineering_mod->joint_new_process_db($form_data);
					$num++;
					// if(count($datadb) == 0){
					// }
					// else{
					// 	$duplicate_now[] = $post['joint_no'][$key];
					// }
				}
			}
		}



		foreach ($id_joint_arr as $keyx => $var) {
			// insert workpack detail
			$form_data = [
				'id_workpack' 	=> $workpack_id,
				'id_template' 	=> $var,
				'manual_close' 	=> 0,
				'status_delete' => 0,
				'created_date' 	=> date("Y-m-d H:i:s"),
				'created_by' 	=> $this->user_cookie[0],
				'progress_itr' 	=> 100,
			];
			$this->planning_mod->insert_workpack_detail($form_data);
			unset($form_data);
			// insert fitup
			$form_data = array(
				'project_code' 				=> $post['project'],
				'surveyor_creator' 			=> $this->user_cookie[0],
				'surveyor_created_date' 	=> date("Y-m-d H:i:s"),
				'drawing_no' 				=> trim($post['drawing_no']),
				'discipline' 				=> $post['discipline'],
				'module' 					=> $post['module'],
				'type_of_module' 			=> $post['type_of_module'],
				'drawing_type' 				=> $post['drawing_type'],
				'requestor' 				=> $this->user_cookie[0],
				'company_id' 				=> $post['company_id'],
				'id_joint' 					=> $var,
				'remarks' 					=> null,
				'date_created' 				=> date("Y-m-d H:i:s"),
				'status_inspection' 		=> 0,
				'id_workpack' 				=> $workpack_id,
				'area_v2' 					=> null,
				'location_v2' 				=> null,
				'status_surveyor' 			=> 3,
				'last_surveyor_update_by' 	=> $this->user_cookie[0],
				'last_surveyor_update_date' => date("Y-m-d H:i:s"),
			);
			$fitup = $this->fitup_mod->insert_fitup_data($form_data);
			unset($form_data);
			// insert visual
			$form = [
				'surveyor_creator' 			=> $this->user_cookie[0],
				'surveyor_created_date'		=> date("Y-m-d H:i:s"),
				'remarks'					=> null,
				'status_inspection'			=> 0,
				'project_code' 				=> $post['project'],
				'drawing_no' 				=> trim($post['drawing_no']),
				'discipline' 				=> $post['discipline'],
				'module' 					=> $post['module'],
				'type_of_module' 			=> $post['type_of_module'],
				'drawing_type' 				=> $post['drawing_type'],
				'company_id'				=> $post['company_id'],
				'cons_lot_no' 				=> null,
				'wps_no_rh' 				=> null,
				'wps_no_fc'					=> null,
				'weld_process_rh' 			=> null,
				'weld_process_fc' 			=> null,
				'weld_datetime' 			=> null,
				'length_of_weld' 			=> $post['weld_length'][$keyx],
				'id_workpack' 				=> $workpack_id,
				'area_v2' 					=> null,
				'location_v2' 				=> null,
				'status_surveyor' 			=> 3,
				'last_surveyor_update_by' 	=> $this->user_cookie[0],
				'last_surveyor_update_date' => date("Y-m-d H:i:s"),
				'id_joint' 					=> $var,
				'date_created' 				=> DATE('Y-m-d H:i:s'),
			];
			$id_visual = $this->visual_mod->input_visual($form);
			unset($form);
		}


		if ($num > 0) {
			$this->session->set_flashdata('success', 'The Data has been Updated!');
			redirect('engineering/joint_update//' . strtr($this->encryption->encrypt(join(', ', $id_joint_arr) . "|edit"), '+=/', '.-~'));
			// $get_text[] = "drawing_no=".$post['drawing_no'];
			// $get_text[] = "discipline=".$post['discipline'];
			// $get_text[] = "module=".$post['module'];
			// $get_text[] = "project=".$post['project'];
			// // $get_text[] = "drawing_wm=".$post['drawing_wm'];
			// $get_text[] = "drawing_type=".$post['drawing_type'];
			// $get_text[] = "type_of_module=".$post['type_of_module'];
			// $get_text[] = "deck_elevation=".$post['deck_elevation'];
			// $get_text[] = "description_assy=".$post['description_assy'];
			// $get_text[] = "submit=search";
			// if(count($duplicate_now) > 0){
			// 	$this->session->set_flashdata('error', 'Some data joint input due duplication data!');
			// }
			// else{
			// 	$this->session->set_flashdata('success', 'The Data has been inputed!');
			// }
			// redirect("engineering/joint_list?".join("&", $get_text));
		} else {
			$this->session->set_flashdata('error', 'No Data inputed!');
			redirect($_SERVER["HTTP_REFERER"]);
			return false;
		}
	}

	public function joint_update($method = '', $data_post = '')
	{
		if ($method != '' && $method != 'revise' && $data_post == '') {
			$data_post = $method;
			$method = '';
		}
		$data_post = $this->encryption->decrypt(strtr($data_post, '.-~', '+=/'));
		if ($data_post == '' && ($method == '' || $method == 'revise')) {
			$post = $this->input->post();
			redirect('engineering/joint_update/' . $method . '/' . strtr($this->encryption->encrypt($post['id'] . "|" . $post['submit'] . "|" . @$post['action'] . "|" . @$post['revise_id']), '+=/', '.-~'));
		} elseif ($data_post != '') {
			$data_post = explode("|", $data_post);
			$post['id'] = $data_post[0];
			$post['submit'] = $data_post[1];
			$post['action'] = @$data_post[2];
			$post['revise_id'] = @$data_post[3];
		} else {
			redirect($_SERVER["HTTP_REFERER"]);
		}
		$post['id'] = explode(", ", $post['id']);
		if (count($post['id']) < 1) {
			$this->session->set_flashdata('error', 'No data selected!');
			redirect($_SERVER["HTTP_REFERER"]);
			return false;
		} elseif (count($post['id']) > 30) {
			$this->session->set_flashdata('error', 'Max selected item is 30!');
			redirect($_SERVER["HTTP_REFERER"]);
			return false;
		}
		if (!isset($post['submit'])) {
			$post['submit'] = 'edit';
		}
		if (@$post['action'] == "delete") {
			$datadb = $this->general_mod->manual_query_db("SELECT * FROM pcms_workpack_detail pwd JOIN pcms_workpack pw ON pwd.id_workpack = pw.id WHERE pw.phase IN ('FB', 'AS', 'ER', 'BAA') AND pwd.status_delete = 1 AND pwd.status != 3 AND pwd.id_template IN (" . join(", ", $post['id']) . ")");
			if (count($datadb) > 0) {
				redirect($_SERVER["HTTP_REFERER"]);
			} else {
				foreach ($post['id'] as $key => $value) {
					$delete_permanent = 1;
					$datadb = $this->general_mod->manual_query_db("SELECT * FROM pcms_workpack_detail pwd JOIN pcms_workpack pw ON pwd.id_workpack = pw.id WHERE pw.phase IN ('FB', 'AS', 'ER', 'BAA') AND pwd.status_delete = 1 AND pwd.status = 3 AND pwd.id_template = " . $value . "");
					if (count($datadb) > 0) {
						$delete_permanent = 0;
					} else {
						$datadb = $this->fitup_mod->fu_list([
							'id_joint' => $value
						]);
						if (count($datadb) > 0) {
							$delete_permanent = 0;
						} else {
							$datadb = $this->visual_mod->vt_list([
								'id_joint' => $value
							]);
							if (count($datadb) > 0) {
								$delete_permanent = 0;
							}
						}
					}
					if ($delete_permanent == 0) {
						$where = ["id IN (" . join(", ", $post['id']) . ")" => NULL];
						$form_data = [
							"status_delete" => 0,
						];
						$this->engineering_mod->joint_update_process_db($form_data, $where);
					} else {
						$where = [
							"id IN (" . join(", ", $post['id']) . ")" => NULL,
						];
						$this->engineering_mod->joint_delete_process_db($where);
					}
				}

				$this->session->set_flashdata('success', 'Your data has been deleted!');
				redirect($_SERVER["HTTP_REFERER"]);
				return false;
			}
		}

		$where = [
			"id IN (" . join(", ", $post['id']) . ")" => NULL,
		];
		$data['joint_list'] = $this->engineering_mod->joint_list($where, null, ["id" => "asc"]);

		$piecemark_arr = [];
		$joint_data = $data['joint_list'][0]['drawing_wm'] . " - " . $data['joint_list'][0]['description_assy'] . " - " . $data['joint_list'][0]['deck_elevation'] . " - " . $data['joint_list'][0]['status_internal'];
		$error = "";
		if ($method == "revise") {
			if (@$post['revise_id'] != '') {
				$request_list = $this->engineering_mod->revise_history_list([
					"id" => $post['revise_id'],
				]);
				$data['request_list'] = $request_list[0];
			} else {
				$error = "Error : Revise request data not found!";
			}
		}

		foreach ($data['joint_list'] as $key => $value) {
			if (!in_array($value["pos_1"], $piecemark_arr)) {
				$piecemark_arr[] = $value["pos_1"];
			}
			if (!in_array($value["pos_2"], $piecemark_arr)) {
				$piecemark_arr[] = $value["pos_2"];
			}
			if ($joint_data != $value['drawing_wm'] . " - " . $value['description_assy'] . " - " . $value['deck_elevation'] . " - " . $value['status_internal']) {
				$error = "Error : You select different Drawing WM, Status Internal, Deck & Desc Assy";
			}
		}

		if ($error != "") {
			$this->session->set_flashdata('error', $error);
			redirect($_SERVER["HTTP_REFERER"]);
		}

		$datadb = $this->engineering_mod->piecemark_list(["part_id IN ('" . join("', '", $piecemark_arr) . "')" => NULL]);
		$piecemark_list = [];
		foreach ($datadb as $key => $value) {
			$piecemark_list[$value['part_id']] = $value;
		}
		$data['piecemark_list'] = $piecemark_list;

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

		$datadb = $this->general_mod->drawing_type();
		$drawing_type_list = [];
		foreach ($datadb as $key => $value) {
			$drawing_type_list[$value['code']] = $value;
		}
		$data['drawing_type_list'] = $drawing_type_list;

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['id']] = $value;
		}
		$data['type_of_module_list'] = $type_of_module_list;

		$datadb = $this->general_mod->deck_elevation();
		$deck_elevation_list = [];
		foreach ($datadb as $key => $value) {
			$deck_elevation_list[$value['id']] = $value;
		}
		$data['deck_elevation_list'] = $deck_elevation_list;

		$datadb = $this->general_mod->weld_type();
		$weld_type_list = [];
		foreach ($datadb as $key => $value) {
			$weld_type_list[$value['id']] = $value;
		}
		$data['weld_type_list'] = $weld_type_list;

		$datadb = $this->general_mod->class();
		$class_list = [];
		foreach ($datadb as $key => $value) {
			$class_list[$value['id']] = $value;
		}
		$data['class_list'] = $class_list;

		$datadb = $this->general_mod->master_wps_new([
			"project_id" => $data['joint_list'][0]['project'],
			"discipline" => $data['joint_list'][0]['discipline'],
		]);
		$wps_list = [];
		foreach ($datadb as $key => $value) {
			$wps_list[$value['id_wps']] = $value['wps_no'];
		}
		$data['wps_list'] = $wps_list;

		$datadb = $this->general_mod->joint_type();
		$joint_type_list = [];
		foreach ($datadb as $key => $value) {
			$joint_type_list[$value['id']] = $value;
		}
		$data['joint_type_list'] = $joint_type_list;

		$datadb = $this->general_mod->desc_assy();
		$desc_assy_list = [];
		foreach ($datadb as $key => $value) {
			$desc_assy_list[$value['id']] = $value;
		}
		$data['desc_assy_list'] = $desc_assy_list;

		$get = $data['joint_list'][0];
		$data['get'] = $get;

		$data['method']   		= $method;

		$data['module']   		= 'Update';
		$data['meta_title']   = 'Update Joint for ' . $get['drawing_no'];
		$data['subview']      = 'engineering/joint_new';
		$data['sidebar']      = $this->sidebar;
		$data['user_permission'] = $this->permission_cookie;
		$this->load->view('index', $data);
	}

	public function joint_update_process()
	{
		$post = $this->input->post();
		$num = 0;
		$joint_old = [];
		$joint_updated = [];
		$date_now = date("Y-m-d H:i:s");
		$fu_revise = [];
		$vt_revise = [];
		$mv_revise = [];

		$rebuild_array_pos_1 = array_values($post["pos_1"]);
		$rebuild_array_pos_2 = array_values($post["pos_2"]);
		$rebuild_array_wps   = array_values($post["wps"]);

		$datadb = $this->general_mod->column_revision_log(["template" => 2]);
		$column_revision_log_list = [];
		foreach ($datadb as $key => $value) {
			$column_revision_log_list[$value['column_name']] = $value;
		}
		$id_joint_arr = [];
		foreach ($post['id'] as $key => $value) {
			if ($value != '') {
				$id_joint_arr[] = $value;
			}
		}
		$datadb = $this->engineering_mod->joint_list(["id IN (" . join(", ", $id_joint_arr) . ")" => NULL]);
		foreach ($datadb as $key => $value) {
			$joint_old[$value['id']] = $value;
			$revise_id = $value['revise_id'];
		}

		if ($post['method'] == "revise") {
			$request_list = $this->engineering_mod->revise_history_list([
				"id" => $revise_id,
			]);
			$request_list = $request_list[0];
		}


		foreach ($post['joint_no'] as $key => $value) {

			$pos_1 = [];
			foreach ($rebuild_array_pos_1[$key] as $pos_1_input) {
				if ($pos_1_input != -1) {
					$pos_1[] = $pos_1_input;
				}
			}

			$pos_2 = [];
			foreach ($rebuild_array_pos_2[$key] as $pos_2_input) {
				if ($pos_2_input != -1) {
					$pos_2[] = $pos_2_input;
				}
			}

			if ($post['joint_no'][$key] != '') {
				if ($post['id'][$key] == "") {
					$datadb = $this->engineering_mod->joint_list([
						// "(joint_no = '".$post["joint_no"]."' OR (pos_1 = '".$post["pos_1"]."' AND pos_2 = '".$post["pos_2"]."'))" => NULL,
						"joint_no" 				=> $post['joint_no'][$key],
						// "drawing_no" 			=> $post["drawing_no"],
						// "discipline" 			=> $post["discipline"],
						// "module" 					=> $post["module"],
						// "project" 				=> $post["project"],
						"drawing_wm" 			=> $post["drawing_wm"],
						// "drawing_type" 		=> $post["drawing_type"],
						// "type_of_module" 	=> $post["type_of_module"],
						// "deck_elevation" 	=> $post["deck_elevation"],
						"status_delete" => 1,
					]);
					if (count($datadb) == 0) {
						$form_data = [
							"drawing_no" 		=> $post['drawing_no'],
							"rev_no" 			=> $post['rev_no'][$key],
							"discipline" 		=> $post['discipline'],
							"module" 			=> $post['module'],
							"project" 			=> $post['project'],
							"drawing_wm" 		=> $post['drawing_wm'],
							"rev_wm" 			=> $post['rev_wm'][$key],
							"drawing_type" 		=> $post['drawing_type'],
							"type_of_module" 	=> $post['type_of_module'],
							"deck_elevation" 	=> $post['deck_elevation'],
							"description_assy" 	=> $post['description_assy'],
							"status_internal" 	=> $post['status_internal'],
							"is_bondstrand" 	=> $post['is_bondstrand'],
							"joint_no" 			=> $post['joint_no'][$key],
							"pos_1" 			=> join(";", $pos_1),
							// "ref_1" 			=> $post['ref_1'][$key],
							"pos_2" 			=> join(";", $pos_2),
							// "ref_2" 			=> $post['ref_2'][$key],
							"weld_type" 		=> $post['weld_type'][$key],
							"thickness" 		=> $post['thickness'][$key],
							"diameter" 			=> $post['diameter'][$key],
							"sch" 				=> $post['sch'][$key],
							"length" 			=> $post['length'][$key],
							"weld_length" 		=> $post['weld_length'][$key],
							"joint_type" 		=> $post['joint_type'][$key],
							"test_pack_no" 		=> $post['test_pack_no'][$key],
							"spool_no" 			=> $post['spool_no'][$key],
							"service_line" 		=> $post['service_line'][$key],
							"pid_drawing" 		=> $post['pid_drawing'][$key],
							"class" 			=> $post['class'][$key],
							"grid_row" 			=> $post['grid_row'][$key],
							"grid_column" 		=> $post['grid_column'][$key],
							"mt_percent_req" 	=> $post['mt_percent_req'][$key],
							"pt_percent_req" 	=> $post['pt_percent_req'][$key],
							"ut_percent_req" 	=> $post['ut_percent_req'][$key],
							"rt_percent_req" 	=> $post['rt_percent_req'][$key],
							"pwht_percent_req" 	=> $post['pwht_percent_req'][$key],
							"remarks" 			=> $post['remarks'][$key],
							"phase" 			=> $post['phase'][$key],
							"status" 			=> 0,
							"created_by" 		=> $this->user_cookie[0],
							"created_date" 		=> $date_now,
						];
						$id_joint_arr[] = $this->engineering_mod->joint_new_process_db($form_data);
					}
				} else {
					$wps = [];
					foreach ($rebuild_array_wps[$key] as $id_wps) {
						if ($id_wps != -1) {
							$wps[] = $id_wps;
						}
					}

					$form_data = [
						"description_assy" 	=> $post['description_assy'],
						"deck_elevation" 	=> $post['deck_elevation'],
						"drawing_wm" 		=> $post['drawing_wm'],
						"status_internal" 	=> $post['status_internal'],
						"is_bondstrand" 	=> $post['is_bondstrand'],
						"rev_wm" 			=> $post['rev_wm'][$key],
						"rev_no" 			=> $post['rev_no'][$key],
						"pos_1" 			=> join(";", $pos_1),
						// "ref_1" 			=> $post['ref_1'][$key],
						"pos_2" 			=> join(";", $pos_2),
						// "ref_2" 			=> $post['ref_2'][$key],
						"weld_type" 		=> $post['weld_type'][$key],
						"thickness" 		=> $post['thickness'][$key],
						"diameter" 			=> $post['diameter'][$key],
						"sch" 				=> $post['sch'][$key],
						"length" 			=> $post['length'][$key],
						"weld_length" 		=> $post['weld_length'][$key],
						"joint_type" 		=> $post['joint_type'][$key],
						"test_pack_no" 		=> $post['test_pack_no'][$key],
						"spool_no" 			=> $post['spool_no'][$key],
						"service_line" 		=> $post['service_line'][$key],
						"pid_drawing" 		=> $post['pid_drawing'][$key],
						"class" 			=> $post['class'][$key],
						"grid_row" 			=> $post['grid_row'][$key],
						"grid_column" 		=> $post['grid_column'][$key],
						"mt_percent_req" 	=> $post['mt_percent_req'][$key],
						"pt_percent_req" 	=> $post['pt_percent_req'][$key],
						"ut_percent_req" 	=> $post['ut_percent_req'][$key],
						"rt_percent_req" 	=> $post['rt_percent_req'][$key],
						"pwht_percent_req" 	=> $post['pwht_percent_req'][$key],
						"wps" 				=> @join(";", $wps),
						"remarks" 			=> $post['remarks'][$key],
						"phase" 			=> $post['phase'][$key],
					];
					if ($post['submit'] == 'submit') {
						$form_data['status'] = 1;
					} elseif ($post['submit'] == 'draft') {
						$form_data['status'] = 0;
					}
					$where = ["id" => $post['id'][$key]];
					if ($post['method'] == "revise") {
						unset($form_data['description_assy']);
						unset($form_data['deck_elevation']);
						unset($form_data['status_internal']);
						unset($form_data['is_bondstrand']);
					}
					if ($joint_old[$post['id'][$key]]['workpack_id'] != $post['joint_no'][$key] && $post['method'] != "revise" && $post['joint_no'][$key] != '') {
						$datadb = $this->engineering_mod->joint_list([
							"joint_no" 				=> $post['joint_no'][$key],
							"drawing_wm" 			=> $post["drawing_wm"],
							"status_delete" => 1,
						]);
						if (count($datadb) == 0) {
							$form_data['joint_no'] = $post['joint_no'][$key];
						}
					}
					// test_var($key, 1);
					// test_var($form_data, 1);
					// test_var($where, 1);
					$this->engineering_mod->joint_update_process_db($form_data, $where);


					foreach ($form_data as $column => $new_data) {
						if ($new_data != $joint_old[$post['id'][$key]][$column] && $column != 'status') {
							$name = ucwords(strtr($column, "_", " "));
							$name = explode(" ", $name);
							foreach ($name as $no_word => $word) {
								if (in_array(strtolower($word), ["ga", "as", "sp", "id", "cp", "cl", "wm", "pos", "wps"])) {
									$name[$no_word] = strtoupper($word);
								}
							}
							$name = join(" ", $name);
							$joint_updated[] = [
								"id_template" => $post['id'][$key],
								"module" => 2,
								"name" => $name,
								"column_name" => $column,
								"data_before" => $joint_old[$post['id'][$key]][$column],
								"data_after" => $new_data,
								"created_by" => $this->user_cookie[0],
								"created_date" => $date_now,
								"id_request_update" => ($post['method'] == "revise" ? $joint_old[$post['id'][$key]]['revise_id'] : 0),
							];

							if ($post['method'] == "revise") {
								if (isset($column_revision_log_list[$column])) {
									// if ($column_revision_log_list[$column]['mv'] == 1) {
									// 	$mv_revise[] = $post['id'][$key];
									// }
									// if ($column_revision_log_list[$column]['fu'] == 1) {
									// 	$fu_revise[] = $post['id'][$key];
									// }
									// if ($column_revision_log_list[$column]['vt'] == 1) {
									// 	$vt_revise[] = $post['id'][$key];
									// }
								}
							}
						}
					}
				}
				$num++;
				if (@$form_data['status'] != '' && @$form_data['status'] != $joint_old[$post['id'][$key]]['status']) {
					$joint_change_status_draft = [
						"id_template" => $post['id'][$key],
						"module" => 2,
						"name" => "Status Template",
						"column_name" => 'status',
						"data_before" => $joint_old[$post['id'][$key]]['status'],
						"data_after" => $form_data['status'],
						"created_by" => $this->user_cookie[0],
						"created_date" => $date_now,
					];
					$this->engineering_mod->revision_log_new_process_db($joint_change_status_draft);
				}

				if ($post['method'] == "revise") {
					foreach ($form_data as $column => $new_data) {
						if ($new_data != $joint_old[$post['id'][$key]][$column]) {
							$name = ucwords(strtr($column, "_", " "));
							$name = explode(" ", $name);
							foreach ($name as $no_word => $word) {
								if (in_array(strtolower($word), ["ga", "as", "sp", "id", "cp", "cl", "wm", "pos", "wps"])) {
									$name[$no_word] = strtoupper($word);
								}
							}
							$name = join(" ", $name);
							$joint_updated[] = [
								"id_template" => $post['id'][$key],
								"module" => 2,
								"name" => $name,
								"column_name" => $column,
								"data_before" => $joint_old[$post['id'][$key]][$column],
								"data_after" => $new_data,
								"created_by" => $this->user_cookie[0],
								"created_date" => $date_now,
								"id_request_update" => $joint_old[$post['id'][$key]]['revise_id'],
							];

							// if(isset($column_revision_log_list[$column])){
							// 	if($column_revision_log_list[$column]['mv'] == 1){
							// 		$mv_revise[] = $post['id'][$key];
							// 	}
							// 	if($column_revision_log_list[$column]['fu'] == 1){
							// 		$fu_revise[] = $post['id'][$key];
							// 	}
							// 	if($column_revision_log_list[$column]['vt'] == 1){
							// 		$vt_revise[] = $post['id'][$key];
							// 	}
							// }
						}
					}
				}
			}
		}
		// test_var("#NE");

		if ($post['method'] == "revise") {
			// if (count($fu_revise) > 0) {
			// 	$datadb = $this->fitup_mod->fu_list([
			// 		"id_joint IN (" . join(", ", $id_joint_arr) . ")" => NULL,
			// 		"status_delete" => NULL,
			// 	]);
			// 	$id_fitup_arr = [];
			// 	if (count($datadb) > 0) {
			// 		foreach ($datadb as $key => $fitup) {
			// 			if (!in_array($fitup['status_inspection'], [0, 1, 2, 4, 6]) && !isset($id_fitup_arr[$fitup['id_joint']])) {
			// 				$id_fitup_arr[$fitup['id_joint']] = $fitup['id_fitup'];
			// 				$status_inspection = $fitup['status_inspection'];
			// 				if ($status_inspection == 7) {
			// 					$status_inspection = 11;
			// 				}
			// 				$form_data = [
			// 					"status_inspection" => 1,
			// 					"revision_status_inspection" => 1,
			// 					"client_inspection_by" => 999999,
			// 					"client_inspection_date" => $date_now,
			// 					"reoffer_remarks" => $request_list['request_reason'],
			// 				];
			// 				if ($fitup['revision_status_inspection'] != '1') {
			// 					$form_data["latest_inspection_status"] = $status_inspection;
			// 				}
			// 				$this->fitup_mod->fu_update_process_db($form_data, [
			// 					"id_fitup" => $fitup['id_fitup']
			// 				]);

			// 				if ($fitup['report_number'] != '' && $fitup['status_inspection'] == 7) {
			// 					$fu_all_list = $this->fitup_mod->fu_list([
			// 						"project_code" => $fitup['project_code'],
			// 						"report_number" => $fitup['report_number'],
			// 						"discipline" => $fitup['discipline'],
			// 						"postpone_reoffer_no" => $fitup['postpone_reoffer_no'],
			// 						"status_delete" => NULL,
			// 						"id_joint !=" => $fitup['id_joint'],
			// 					]);
			// 					if (count($fu_all_list) > 0) {
			// 						$id_fitup_all_arr = [];
			// 						foreach ($fu_all_list as $key => $fu_all) {
			// 							if ($fu_all['status_inspection'] == 7 && !isset($id_fitup_all_arr[$fu_all['id_joint']])) {
			// 								$id_fitup_all_arr[$fu_all['id_joint']] = $fu_all['id_fitup'];
			// 								$this->fitup_mod->fu_update_process_db([
			// 									"status_inspection" => 11,
			// 									"client_inspection_by" => 999999,
			// 									"client_inspection_date" => $date_now,
			// 									"reoffer_remarks" => $request_list['request_reason'],
			// 									"revision_status_inspection" => 0,
			// 								], [
			// 									"id_fitup" => $fu_all['id_fitup']
			// 								]);
			// 							}
			// 						}
			// 					}
			// 				}

			// 				$link_notif_encrypt = site_url('fitup/joint_inspection_list/' . strtr($this->encryption->encrypt($fitup['submission_id']), '+=/', '.-~') . '/' . strtr($this->encryption->encrypt("1904199102102021010891"), '+=/', '.-~') . '/' . 'revise' . '/' . strtr($this->encryption->encrypt('external'), '+=/', '.-~'));
			// 				$link_notif_encrypt = getenv('LINK_PCMS_PORTAL') . "/jump_url/redirect/" . strtr($this->encryption->encrypt($link_notif_encrypt), '+=/', '.-~');
			// 				$link_notif_encrypt = strtr($this->encryption->encrypt($link_notif_encrypt), '+=/', '.-~');
			// 				push_notification([
			// 					"category_apps" => "Production & Quality",
			// 					"designation_apps" => "FU",
			// 					"user_designation" => "QC",
			// 					"link_encrypt" => $link_notif_encrypt,
			// 					"project_id" => $value['project_code'],
			// 					"notification_text" => $this->user_cookie[1] . " Updated Joint " . $joint_old[$fitup['id_joint']]['joint_no'] . " on Drawing " . $joint_old[$fitup['id_joint']]['drawing_wm'] . " And Needs To Be Reviewed on Fitup Submission.",
			// 				], $this->user_cookie);
			// 			}
			// 		}
			// 	}
			// }

			// if (count($vt_revise) > 0) {
			// 	$datadb = $this->visual_mod->vt_list([
			// 		"id_joint IN (" . join(", ", $id_joint_arr) . ")" => NULL,
			// 		"revision_category" => NULL,
			// 		"status_delete" => NULL,
			// 	]);
			// 	$id_visual_arr = [];
			// 	if (count($datadb) > 0) {
			// 		foreach ($datadb as $key => $visual) {
			// 			if (!in_array($visual['status_inspection'], [0, 1, 2, 4, 6]) && !isset($id_visual_arr[$visual['id_joint']])) {
			// 				$id_visual_arr[$visual['id_joint']] = $visual['id_visual'];
			// 				$status_inspection = $visual['status_inspection'];
			// 				if ($status_inspection == 7) {
			// 					$status_inspection = 11;
			// 				}
			// 				$form_data = [
			// 					"status_inspection" => 1,
			// 					"revision_status_inspection" => 1,
			// 					"inspection_client_by" => 999999,
			// 					"inspection_client_datetime" => $date_now,
			// 					"client_remarks" => $request_list['request_reason'],
			// 				];
			// 				if ($visual['revision_status_inspection'] != '1') {
			// 					$form_data["latest_inspection_status"] = $status_inspection;
			// 				}
			// 				$this->visual_mod->vt_update_process_db($form_data, [
			// 					"id_visual" => $visual['id_visual']
			// 				]);

			// 				if ($visual['report_number'] != '' && $visual['status_inspection'] == 7) {
			// 					$vt_all_list = $this->visual_mod->vt_list([
			// 						"revision_category" => NULL,
			// 						"project_code" => $visual['project_code'],
			// 						"report_number" => $visual['report_number'],
			// 						"discipline" => $visual['discipline'],
			// 						"postpone_reoffer_no" => $visual['postpone_reoffer_no'],
			// 						"status_delete" => NULL,
			// 						"id_joint !=" => $visual['id_joint'],
			// 					]);
			// 					if (count($vt_all_list) > 0) {
			// 						$id_visual_all_arr = [];
			// 						foreach ($vt_all_list as $key => $vt_all) {
			// 							if ($vt_all['status_inspection'] == 7 && !isset($id_visual_all_arr[$vt_all['id_joint']])) {
			// 								$id_visual_all_arr[$vt_all['id_joint']] = $vt_all['id_visual'];
			// 								$this->visual_mod->vt_update_process_db([
			// 									"status_inspection" => 11,
			// 									"inspection_client_by" => 999999,
			// 									"inspection_client_datetime" => $date_now,
			// 									"client_remarks" => $request_list['request_reason'],
			// 									"revision_status_inspection" => 0,
			// 								], [
			// 									"id_visual" => $vt_all['id_visual']
			// 								]);
			// 							}
			// 						}
			// 					}
			// 				}

			// 				$link_notif_encrypt = site_url('visual/detail_inspection/' . $visual['submission_id'] . '/qc/' . $visual['drawing_no'] . '/0');
			// 				$link_notif_encrypt = getenv('LINK_PCMS_PORTAL') . "/jump_url/redirect/" . strtr($this->encryption->encrypt($link_notif_encrypt), '+=/', '.-~');
			// 				$link_notif_encrypt = strtr($this->encryption->encrypt($link_notif_encrypt), '+=/', '.-~');
			// 				push_notification([
			// 					"category_apps" => "Production & Quality",
			// 					"designation_apps" => "VS",
			// 					"user_designation" => "QC",
			// 					"project_id" => $value['project_code'],
			// 					"link_encrypt" => $link_notif_encrypt,
			// 					"notification_text" => $this->user_cookie[1] . " Updated Joint " . $joint_old[$visual['id_joint']]['joint_no'] . " on Drawing " . $joint_old[$visual['id_joint']]['drawing_wm'] . " And Needs To Be Reviewed on Visual Submission.",
			// 				], $this->user_cookie);
			// 			}
			// 		}
			// 	}
			// }

			$where = [
				"id IN (" . join(", ", $post['id']) . ")" => NULL,
			];
			$datadb = $this->engineering_mod->joint_list(["id" => $post['id'][0]]);
			$datadb = $datadb[0];
			$form_data = ["revise_id" => NULL];
			$where = ["revise_id" => $datadb["revise_id"]];
			$this->engineering_mod->joint_update_process_db($form_data, $where);

			$form_data = [
				"update_by" 	=> $this->user_cookie[0],
				"update_date" 	=> date("Y-m-d H:i:s"),
				"status_revise" 	=> 4,
			];
			$where = [
				"id" 	=> $datadb["revise_id"],
			];
			$this->engineering_mod->revise_history_update_process_db($form_data, $where);
			$get_text[] = "status=submitted";
		}

		if (count($joint_updated) > 0) {
			$this->engineering_mod->revision_log_import_process_db($joint_updated);
		}

		if ($post['submit'] == 'draft') {
			$this->session->set_flashdata('success', 'The Data has been Updated!');
			redirect('engineering/joint_update/' . $post['method'] . '/' . strtr($this->encryption->encrypt(join(', ', $id_joint_arr) . "|edit"), '+=/', '.-~'));
		} elseif ($num > 0) {
			$get_text[] = "drawing_no=" . $post['drawing_no'];
			$get_text[] = "discipline=" . $post['discipline'];
			$get_text[] = "module=" . $post['module'];
			$get_text[] = "project=" . $post['project'];
			$get_text[] = "drawing_wm=" . $post['drawing_wm'];
			$get_text[] = "drawing_type=" . $post['drawing_type'];
			$get_text[] = "type_of_module=" . $post['type_of_module'];
			$get_text[] = "deck_elevation=" . $post['deck_elevation'];
			$get_text[] = "description_assy=" . $post['description_assy'];
			$get_text[] = "is_bondstrand=" . $post['is_bondstrand'];
			if ($post['submit'] == 'submit' && $post['method'] == 'revise') {
				$get_text[] = "status=submitted";
			} else {
				$get_text[] = "status=outstanding";
			}
			$get_text[] = "submit=search";
			$this->session->set_flashdata('success', 'The Data has been Updated!');
			redirect("engineering/joint_list?" . join("&", $get_text));
		} else {
			$this->session->set_flashdata('error', 'No Data inputed!');
			redirect($_SERVER["HTTP_REFERER"]);
			return false;
		}
	}

	public function autocomplete_drawing($drawing_type_spec = NULL)
	{
		$get = $this->input->get();
		$drawing_type = [0];
		if ($drawing_type_spec) {
			$drawing_type = [$drawing_type_spec];
		} elseif ($get['drawing_type'] == 1) {
			$drawing_type = [1, 2, 7, 9, 12, 13, 14, 3];
		} elseif ($get['drawing_type'] == 2) {
			$drawing_type = [1, 7, 9, 14, 12, 13, 3];
		} elseif ($get['drawing_type'] == 3) {
			$drawing_type = [1, 2, 10, 11, 13, 15, 16, 17];
		} elseif ($get['drawing_type'] == 4) { //Create Workpack
			$drawing_type = [1, 2, 9, 10, 11, 13, 15, 16, 17];
		}
		$where = [
			"document_no LIKE '%" . $get['term'] . "%'" => NULL,
			"drawing_type IN (" . join(", ", $drawing_type) . ")" => NULL,
			"project_id IN (" . join(", ", $this->user_cookie[13]) . ")" => NULL,
			"company IN (" . join(", ", $this->user_cookie[14]) . ")" => NULL,
		];

		// $datadb = $this->engineering_mod->eng_drawing_list($where, 10);
		$datadb = $this->engineering_mod->drawing_list_mysql($where, 10);

		$output = [];
		if (count($datadb) > 0) {
			foreach ($datadb as $key => $value) {
				$output[] = $value["document_no"];
			}
		} else {
			$output[] = "No Data.";
		}
		echo json_encode($output);
	}

	public function autocomplete_spool_no($drawing_type_spec = NULL)
	{
		$get = $this->input->get();
		$where = [
			"spool_no LIKE '%" . $get['term'] . "%'" => NULL,
			"project IN (" . join(", ", $this->user_cookie[13]) . ")" => NULL,
		];
		$datadb = $this->engineering_mod->spool_no_list($where, 10);

		// $datadb = $this->engineering_mod->eng_drawing_list($where, 10);

		// $datadb = $this->engineering_mod->joint_list($where, 10);
		// $datadb = $this->general_mod->manual_query_db("SELECT DISTINCT spool_no FROM pcms_joint WHERE project = 12 AND spool_no LIKE '%".$get['term']."%' LIMIT 10");

		$output = [];
		if (count($datadb) > 0) {
			foreach ($datadb as $key => $value) {
				$output[] = $value["spool_no"];
			}
		} else {
			$output[] = "No Data.";
		}
		echo json_encode($output);
	}

	public function autocomplete_piecemark()
	{
		$get = $this->input->get();
		$where = [
			"part_id LIKE '%" . $get['term'] . "%'" => NULL,
			"status_delete" => 1,
			// "is_itr" => 0,
		];
		if ($get['reference'] != "") {
			$where["(drawing_ga = '" . $get['reference'] . "' OR drawing_as = '" . $get['reference'] . "')"] = NULL;
		} else {
			if ($get['drawing_type'] == 2) {
				$where['drawing_as'] = $get['drawing_no'];
			} else {
				$where['drawing_ga'] = $get['drawing_no'];
			}
		}
		$datadb = $this->engineering_mod->piecemark_list($where, 10);
		$output = [];
		if (count($datadb) > 0) {
			foreach ($datadb as $key => $value) {
				$output[] = $value["part_id"];
			}
		} else {
			$output[] = "No Data.";
		}
		echo json_encode($output);
	}

	public function get_data_drawing()
	{
		$get = $this->input->get();
		$drawing_type = 0;
		// $where = ["drawing_ga = '".$get['document_no']."' OR drawing_as = '".$get['document_no']."' OR drawing_sp = '".$get['document_no']."' OR drawing_cp = '".$get['document_no']."' OR drawing_cl = '".$get['document_no']."'" => NULL];
		// $datadb = $this->engineering_mod->piecemark_list($where);
		// if(count($datadb) > 0){
		// 	$document = $datadb[0];
		// 	if($get['document_no'] ==  $document["drawing_ga"]){
		// 		$drawing_type = 1;
		// 	}
		// 	elseif($get['document_no'] ==  $document["drawing_as"]){
		// 		$drawing_type = 2;
		// 	}
		// 	elseif($get['document_no'] ==  $document["drawing_sp"]){
		// 		$drawing_type = 3;
		// 	}
		// 	elseif($get['document_no'] ==  $document["drawing_cp"]){
		// 		$drawing_type = 10;
		// 	}
		// 	elseif($get['document_no'] ==  $document["drawing_cl"]){
		// 		$drawing_type = 11;
		// 	}
		// 	$output = [
		// 		"module" => $document["module"],
		// 		"discipline" => $document["discipline"],
		// 		"project" => $document["project"],
		// 		"drawing_type" => $drawing_type,
		// 		"type_of_module" => $document["type_of_module"],
		// 		"deck_elevation" => $document["deck_elevation"],
		// 	];
		// }
		// else{
		// 	$where = ["drawing_no = '".$get['document_no']."' OR drawing_wm = '".$get['document_no']."'" => NULL];
		// 	$datadb = $this->engineering_mod->joint_list($where);
		// 	if(count($datadb) > 0){
		// 		$document = $datadb[0];
		// 		if($get['document_no'] ==  $document["drawing_no"]){
		// 			$drawing_type = $document["drawing_type"];
		// 		}
		// 		elseif($get['document_no'] ==  $document["drawing_wm"]){
		// 			if($document["drawing_type"] == 1){
		// 				$drawing_type = 9;
		// 			}
		// 			if($document["drawing_type"] == 2){
		// 				$drawing_type = 14;
		// 			}
		// 		}
		// 		$output = [
		// 			"module" 					=> $document["module"],
		// 			"discipline" 			=> $document["discipline"],
		// 			"project" 				=> $document["project"],
		// 			"drawing_type" 		=> $drawing_type,
		// 			"type_of_module" 	=> $document["type_of_module"],
		// 			"deck_elevation" 	=> $document["deck_elevation"],
		// 		];
		// 	}
		// 	else{
		$where = ["document_no" => $get['document_no']];
		$datadb = $this->engineering_mod->drawing_list_mysql($where);
		if (count($datadb) > 0) {
			$document = $datadb[0];
			$output = [
				"module" => $document["module"],
				"discipline" => $document["discipline"],
				"project" => $document["project_id"],
				"drawing_type" => $document["drawing_type"],
				"type_of_module" => ($document["module"] == 59 ? 1 : ($document["module"] == 58 ? 2 : 0)),
				"deck_elevation" => $document["deck_elevation"],
				"module" => 60,
			];
		} else {
			$output = "Error : No Data.";
		}
		// 	}
		// }

		echo json_encode($output);
	}

	public function get_data_piecemark()
	{
		$get = $this->input->get();
		$where = ["part_id" => $get['part_id']];
		$datadb = $this->engineering_mod->piecemark_list($where);
		if (count($datadb) > 0) {
			$document = $datadb[0];
			$output = [
				"thickness" => $document["thickness"],
			];
		} else {
			$output = "Error : No Data.";
		}
		echo json_encode($output);
	}

	public function revise_history_list()
	{
		$data['get']   = $this->input->get();
		$request_list = [];
		$piecemark_list = [];
		$joint_list = [];
		if ($this->input->get('submit')) {
			$where = NULL;
			foreach ($data['get'] as $key => $value) {
				if ($key != "submit" && $value != "" && $key != "status") {
					$where[$key] = $value;
				}
			}
			$request_list = $this->engineering_mod->revise_history_list($where);
		}
		$data['request_list'] = $request_list;

		$id_user = [];
		$id_piecemark = [];
		$id_joint = [];
		$id_request = [];
		foreach ($request_list as $key => $value) {
			if (!in_array($value['request_by'], $id_user)) {
				$id_user[] = $value['request_by'];
			}
			if ($value['update_by'] != "" && !in_array($value['update_by'], $id_user)) {
				$id_user[] = $value['update_by'];
			}
			if ($value['approve_by'] != "" && !in_array($value['approve_by'], $id_user)) {
				$id_user[] = $value['approve_by'];
			}
			if ($data['get']['fabrication_type'] == 8) {
				$id_piecemark[] = $value['id_data'];
			}
			if ($data['get']['fabrication_type'] == 16) {
				$id_joint[] = $value['id_data'];
			}
			if ($data['get']['fabrication_type'] == 9) {
				$id_joint[] = $value['id_data'];
			}
			$id_request[] = $value['id'];
		}
		$data['user_list'] = user_name_data($id_user);
		if (count($id_piecemark) > 0) {
			$where = [
				"id IN (" . join(", ", $id_piecemark) . ")" => NULL,
			];
			$datadb = $this->engineering_mod->piecemark_list($where);
			foreach ($datadb as $key => $value) {
				$piecemark_list[$value['id']] = [
					'part_id' => $value['part_id'],
					'drawing_sp' => $value['drawing_sp'],
				];
			}
		}
		if (count($id_joint) > 0) {
			$where = [
				"id IN (" . join(", ", $id_joint) . ")" => NULL,
			];
			$datadb = $this->engineering_mod->joint_list($where);
			foreach ($datadb as $key => $value) {
				$joint_list[$value['id']] = [
					'drawing_wm' => $value['drawing_wm'],
					'joint_no' => $value['joint_no'],
				];
			}
		}

		$history_list = [];
		if (@$data['get']['fabrication_type'] == 8 && @$data['get']['status_revise'] == 4 && count($id_request) > 0) {
			$datadb = $this->engineering_mod->revision_log_list([
				"id_request_update IN (" . join(", ", $id_request) . ")" => NULL,
				"module" => 1,
			]);
			foreach ($datadb as $key => $value) {
				$history_list[$value['id_request_update']][$value['column_name']] = $value;
			}
		} elseif (@$data['get']['fabrication_type'] == 16 && @$data['get']['status_revise'] == 4 && count($id_request) > 0) {
			$datadb = $this->engineering_mod->revision_log_list([
				"id_request_update IN (" . join(", ", $id_request) . ")" => NULL,
				"module" => 2,
			]);
			foreach ($datadb as $key => $value) {
				$history_list[$value['id_request_update']][$value['column_name']] = $value;
			}
		}

		$data['piecemark_list'] = $piecemark_list;
		$data['joint_list'] = $joint_list;
		$data['history_list'] = $history_list;

		$data['meta_title']   = 'Request List';
		$data['subview']      = 'engineering/revise_history_list';
		$data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
	}

	public function revise_history_new_process() // Fitur request void pada joint list yang lama, dan ini harus pakai approval 1 1
	{
		$post = $this->input->post();

		$post['id'] = explode(", ", $post['id']);
		if (count($post['id']) < 1) {
			$this->session->set_flashdata('error', 'No data selected!');
			redirect($_SERVER["HTTP_REFERER"]);
			return false;
		} elseif (count($post['id']) > 30) {
			$this->session->set_flashdata('error', 'Max selected item is 30!');
			redirect($_SERVER["HTTP_REFERER"]);
			return false;
		}

		$joint_old_list = [];
		$piecemark_old_list = [];
		$error = "";
		if ($post['fabrication_type'] == 4) {
			$where = [
				"id IN (" . join(", ", $post['id']) . ")" => NULL,
			];
			$piecemark_list = $this->engineering_mod->piecemark_list($where);
			$different_validation = $piecemark_list[0]['description_assy'] . ' - ' . $piecemark_list[0]['deck_elevation'] . ' - ' . $piecemark_list[0]['status_internal'];
			foreach ($piecemark_list as $key => $value) {
				$piecemark_old_list[$value['id']] = $value;
				if ($different_validation != $value['description_assy'] . ' - ' . $value['deck_elevation'] . ' - ' . $value['status_internal']) {
					$error = "Error : You select different Desc Assy, Deck Elevation / Service Line or Status Internal";
				}
			}

			$id_piecemark_irn_checked = [];
			$datadb = $this->irn_mod->irn_raw_list([
				"id_piecemark IN (" . join(", ", $post['id']) . ")" => NULL,
				"status_inspection IN (7, 9)" => NULL,
			]);
			foreach ($datadb as $key => $value) {
				$id_piecemark_irn_checked[] = $value['id_piecemark'];
			}
			if (count($id_piecemark_irn_checked) > 0 && count($id_piecemark_irn_checked) < count($post['id'])) {
				$error = "Error : Some piecemark already IRN and checked by client!";
			}
			if (count($id_piecemark_irn_checked) == count($post['id'])) {
				$post['fabrication_type'] = 14;
			}
		} elseif (in_array($post['fabrication_type'], [5, 9])) {
			$where = [
				"id IN (" . join(", ", $post['id']) . ")" => NULL,
			];
			$joint_list = $this->engineering_mod->joint_list($where);
			$joint_data = $joint_list[0]['drawing_wm'] . " - " . $joint_list[0]['description_assy'] . " - " . $joint_list[0]['deck_elevation'] . " - " . $joint_list[0]['status_internal'];
			foreach ($joint_list as $key => $value) {
				$joint_old_list[$value['id']] = $value;
				if ($joint_data != $value['drawing_wm'] . " - " . $value['description_assy'] . " - " . $value['deck_elevation'] . " - " . $value['status_internal']) {
					$error = "Error : You select different Drawing WM, Status Internal, Desc Assy or Deck Elevation / Service Line";
				}
			}

			$id_joint_irn_checked = [];
			$datadb = $this->engineering_mod->check_irn_template([
				"pi.id_joint IN (" . join(", ", $post['id']) . ")" => NULL,
				"pi.category_irn" => 0,
				"(pids.validator_auth = 1 OR pi.status_inspection IN (7, 9))" => NULL,
			]);
			foreach ($datadb as $key => $value) {
				if (@$joint_old_list[$value['id_joint']]['drawing_no'] == $value['drawing_no'] && !in_array($value['id_joint'], $id_joint_irn_checked)) {
					$id_joint_irn_checked[] = $value['id_joint'];
				}
			}
			if (count($id_joint_irn_checked) > 0 && $post['fabrication_type'] == 9) {
				$error = "Error : Some piecemark already IRN and checked by client!";
			} else if (count($id_joint_irn_checked) > 0 && count($id_joint_irn_checked) < count($post['id'])) {
				$error = "Error : Some piecemark already IRN and checked by client!";
			}
			if (count($id_joint_irn_checked) == count($post['id']) && $post['fabrication_type'] == 5) {
				$post['fabrication_type'] = 11;
			}
		}

		if ($error != "") {
			$this->session->set_flashdata('error', $error);
			redirect($_SERVER["HTTP_REFERER"]);
		}

		if (in_array($post['fabrication_type'], [4, 5, 14, 11])) {
			$form_data = [
				"fabrication_type" 	=> $post['fabrication_type'],
				"submission_id" 		=> $post['submission_id'],
				"request_by" 				=> $this->user_cookie[0],
				"request_reason" 		=> $post['request_reason'],
				"status_revise" 		=> 1,
				"id_data" 					=> join(", ", $post['id']),
			];
			$revise_id = $this->engineering_mod->revise_history_new_process_db($form_data);

			if (in_array($post['fabrication_type'], [4, 14])) {
				$form_data = ["revise_id" => $revise_id];
				$where = ["id IN (" . join(", ", $post['id']) . ")" => NULL];
				$this->engineering_mod->piecemark_update_process_db($form_data, $where);
			} elseif (in_array($post['fabrication_type'], [5, 11])) {
				$form_data = ["revise_id" => $revise_id];
				$where = ["id IN (" . join(", ", $post['id']) . ")" => NULL];
				$this->engineering_mod->joint_update_process_db($form_data, $where);
			}
		} elseif ($post['fabrication_type'] == 9) {
			foreach ($post['id'] as $key => $value) {
				$form_data = [
					"fabrication_type" 	=> $post['fabrication_type'],
					"submission_id" 		=> $joint_old_list[$value]['joint_no'],
					"request_by" 				=> $this->user_cookie[0],
					"request_reason" 		=> $post['request_reason'],
					"status_revise" 		=> 1,
					"id_data" 					=> $value,
				];
				$revise_id = $this->engineering_mod->revise_history_new_process_db($form_data);

				$form_data = ["revise_id" => $revise_id];
				$where = ["id" => $value];
				$this->engineering_mod->joint_update_process_db($form_data, $where);
			}
		}

		$this->session->set_flashdata('success', "Your request has been successed!");
		redirect($_SERVER["HTTP_REFERER"]);
	}

	public function revise_history_approve_process($id, $action)
	{
		$id = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
		$action = $this->encryption->decrypt(strtr($action, '.-~', '+=/'));

		if ($action == 3) {
			$form_data = [
				"approve_by" 	=> $this->user_cookie[0],
				"approve_date" 	=> date("Y-m-d H:i:s"),
				"status_revise" 	=> 3,
			];
			$where = [
				"id" 	=> $id,
			];
			$this->engineering_mod->revise_history_update_process_db($form_data, $where);
			$this->session->set_flashdata('success', "Your request has been approved!");
			redirect($_SERVER["HTTP_REFERER"]);
		} elseif ($action == 2) {
			$form_data = [
				"approve_by" 	=> $this->user_cookie[0],
				"approve_date" 	=> date("Y-m-d H:i:s"),
				"status_revise" 	=> 2,
			];
			$where = [
				"id" 	=> $id,
			];
			$this->engineering_mod->revise_history_update_process_db($form_data, $where);

			$form_data = ["revise_id" => NULL];
			$where = ["revise_id" => $id];
			$this->engineering_mod->piecemark_update_process_db($form_data, $where);

			$form_data = ["revise_id" => NULL];
			$where = ["revise_id" => $id];
			$this->engineering_mod->joint_update_process_db($form_data, $where);

			$this->session->set_flashdata('success', "Your request has been rejected!");
			redirect($_SERVER["HTTP_REFERER"]);
		}
	}

	public function revise_history_get_data_process()
	{
		$request_list = $this->engineering_mod->revise_history_list([
			"id" => $this->input->post('id')
		]);
		$id_arr = [];
		$request_list = $request_list[0];
		if (in_array($request_list['fabrication_type'], [4, 14])) {
			$datadb = $this->engineering_mod->piecemark_list([
				"workpack_id IS NOT NULL" => NULL,
				"workpack_id !=" 					=> 0,
				"revise_id" 							=> $request_list['id'],
			]);
		}
		if (in_array($request_list['fabrication_type'], [5, 11])) {
			$datadb = $this->engineering_mod->joint_list([
				"workpack_id IS NOT NULL" => NULL,
				"workpack_id !=" 					=> 0,
				"revise_id" 							=> $request_list['id'],
				"status_delete" 					=> 1,
			]);
		}
		if (count($datadb) > 0) {
			foreach ($datadb as $key => $value) {
				$id_arr[] = $value['id'];
			}
			echo join(", ", $id_arr);
		} else {
			$request_list = $this->engineering_mod->revise_history_update_process_db([
				"status_revise" => 5
			], [
				"id" => $this->input->post('id')
			]);

			$form_data = ["revise_id" => NULL];
			$where = ["revise_id" => $this->input->post('id')];
			$this->engineering_mod->piecemark_update_process_db($form_data, $where);
			$this->engineering_mod->joint_update_process_db($form_data, $where);

			echo "Error: Something Wrong! Please Reload and Try Again!";
		}
	}

	public function checking_joint()
	{
		$post = $this->input->post();

		$datadb = $this->engineering_mod->joint_list([
			// "(joint_no = '".$post["joint_no"]."' OR (pos_1 = '".$post["pos_1"]."' AND pos_2 = '".$post["pos_2"]."'))" => NULL,
			"joint_no" => $post["joint_no"],
			// "drawing_no" => $post["drawing_no"],
			// "discipline" => $post["discipline"],
			// "module" => $post["module"],
			// "project" => $post["project"],
			"drawing_wm" => $post["drawing_wm"],
			// "drawing_type" => $post["drawing_type"],
			// "type_of_module" => $post["type_of_module"],
			// "deck_elevation" => $post["deck_elevation"],
			"status_delete" => 1,
		]);
		if (count($datadb) > 0 && $post['id'] == '') {
			echo "Error: Duplicate Joint No";
			// if($datadb[0]['joint_no'] == $post["joint_no"]){
			// 	echo "Error: Duplicate Joint No";
			// }
			// elseif($datadb[0]['pos_1'].$datadb[0]['pos_2'] == $post["pos_1"].$post["pos_2"]){
			// 	echo "Error: Duplicate Piecemark";
			// }
		}

		// else {
		// 	$columndrawing = "(";
		// 	if (in_array($post["drawing_type"], [1, 7, 9, 12, 13, 14])) {
		// 		$columndrawing .= "drawing_ga = '" . $post["drawing_no"] . "'";
		// 	} else {
		// 		$columndrawing .= "drawing_as = '" . $post["drawing_no"] . "'";
		// 	}
		// 	$ref_arr = [];
		// 	if ($post["ref_1"] != "") {
		// 		$ref_arr[] = $post["ref_1"];
		// 	}
		// 	if ($post["ref_2"] != "") {
		// 		$ref_arr[] = $post["ref_2"];
		// 	}
		// 	if (count($ref_arr) > 0) {
		// 		$columndrawing .= " OR drawing_ga IN ('" . join("', '", $ref_arr) . "')";
		// 		$columndrawing .= " OR drawing_as IN ('" . join("', '", $ref_arr) . "')";
		// 	}
		// 	$columndrawing .= ")";

		// 	$datadb = $this->engineering_mod->piecemark_list([
		// 		"(part_id LIKE '" . $post["pos_1"] . "' OR part_id LIKE '" . $post["pos_2"] . "')" => NULL,
		// 		$columndrawing => NULL,
		// 		// "discipline" => $post["discipline"],
		// 		"module" => $post["module"],
		// 		"project" => $post["project"],
		// 		// "type_of_module" => $post["type_of_module"],
		// 		// "is_itr" => 0,
		// 		// "deck_elevation" => $post["deck_elevation"],
		// 	]);
		// 	$pos1 = 0;
		// 	$pos2 = 0;
		// 	foreach ($datadb as $key => $value) {
		// 		if ($value['part_id'] == $post["pos_1"]) {
		// 			$pos1 = 1;
		// 		}
		// 		if ($value['part_id'] == $post["pos_2"]) {
		// 			$pos2 = 1;
		// 		}
		// 	}
		// 	if ($pos1 == 0) {
		// 		echo "Error: Piecemark#1 Not Found";
		// 	} elseif ($pos2 == 0) {
		// 		echo "Error: Piecemark#2 Not Found";
		// 	} else {
		// 		echo "Nope";
		// 	}
		// }
	}

	public function export_excel()
	{
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

		$datadb = $this->general_mod->company();
		$company_list = [];
		foreach ($datadb as $key => $value) {
			$company_list[$value['id_company']] = $value;
		}
		$data['company_list'] = $company_list;

		$data['meta_title']   = 'Export Data';
		$data['subview']      = 'engineering/export_excel';
		$data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
	}

	public function export_excel_process()
	{
		$get = $this->input->get();

		// $datediff = strtotime($get['date_to']) - strtotime($get['date_from']);
		// $datediff = round($datediff / (60 * 60 * 24));
		// if($datediff > 30){
		// 	$this->session->set_flashdata('error', 'Max range data is 31 days!');
		// 	redirect($_SERVER['HTTP_REFERER']);
		// }

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['id']] = $value['discipline_name'];
		}

		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['mod_id']] = $value['mod_desc'];
		}

		$datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['id']] = $value['project_name'];
		}

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['id']] = $value['name'];
		}

		$datadb = $this->general_mod->deck_elevation();
		$deck_elevation_list = [];
		foreach ($datadb as $key => $value) {
			$deck_elevation_list[$value['id']] = $value['name'];
		}

		$datadb = $this->general_mod->material_grade();
		$material_grade_list = [];
		foreach ($datadb as $key => $value) {
			$material_grade_list[$value['id']] = $value;
		}

		$datadb = $this->general_mod->weld_type();
		$weld_type_list = [];
		foreach ($datadb as $key => $value) {
			$weld_type_list[$value['id']] = $value;
		}

		$datadb = $this->general_mod->joint_type();
		$joint_type_list = [];
		foreach ($datadb as $key => $value) {
			$joint_type_list[$value['id']] = $value;
		}

		$datadb = $this->general_mod->class();
		$class_list = [];
		foreach ($datadb as $key => $value) {
			$class_list[$value['id']] = $value;
		}

		$datadb = $this->general_mod->desc_assy();
		$desc_assy_list = [];
		foreach ($datadb as $key => $value) {
			$desc_assy_list[$value['id']] = $value;
		}

		$datadb = $this->general_mod->piping_testing_category();
		$piping_testing_category_list = [];
		foreach ($datadb as $key => $value) {
			$piping_testing_category_list[$value['id']] = $value;
		}

		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
		$excel              = new PHPExcel();
		$row                = $excel->setActiveSheetIndex(0);

		if ($get['submit'] == "piecemark") {
			$column = ['Project', 'Discipline', 'Module', 'Type Of Module', 'Deck Elevation / Service Line', 'Desc Assy', 'Drawing GA', 'Rev GA', 'Drawing AS', 'Rev AS', 'Drawing SP', 'Rev SP', 'Part ID As', 'Reference POS', 'Cutting Plan', 'Rev CP', 'Cutting List', 'Rev CL', 'Profile', 'Material', 'Grade', 'Diameter', 'Thickness', 'Schedule', 'Length (mm)', 'Height', 'Width', 'Weight (kg)', 'Area (m2)', 'Can Number', 'Test Pack Number', 'Remarks', 'Item Code (Piping Material)', 'Spool No', 'Beam/Channel (Thk)', 'Strain Age Test (D/T)', 'Strain Age Test (Yes/No)', 'Through Thickness', 'Activity ID', 'Input By', 'Input Date', 'Status Internal', 'Is ITR', 'Piping Testing Category', 'Status'];
		} elseif ($get['submit'] == "joint") {
			$column = ['Project', 'Discipline', 'Module', 'Type Of Module', 'Deck Elevation / Service Line', 'Drawing GA/AS', 'Ecodoc GA/AS', 'Rev GA/AS', 'Drawing WM', 'Ecodoc WM', 'Rev WM', 'Joint No.', 'Piecemark#1', 'Piecemark#2', 'Weld Type Code', 'Desc Assy', 'Phase', 'Thickness', 'Diameter', 'Schedule', 'Length', 'Weld Length', 'Joint Type Code', 'Test Pack Number', 'Spool Number', 'Service Line', 'P&ID Drawing', 'Class Code', 'Row', 'Column', 'MT Req (%)', 'PT Req (%)', 'UT Req (%)', 'RT Req (%)', 'PWHT Req (%)', 'Remarks', 'Input By', 'Input Date', 'Status Internal', 'Status'];
		}
		$start_column = 'A';
		$finish_column = $start_column;
		foreach ($column as $key => $value) {
			$row->setCellValue($finish_column . "1", $column[$key]);
			$finish_column++;
		}

		$where = NULL;
		foreach ($get as $key => $value) {
			if ($value != "" && !in_array($key, ["submit", "status", "draw", "columns", "start", "length", "page", "search", "order", "date_from", "date_to"])) {
				$where[$key] = $value;
			}
		}
		if ($get['date_from'] != "" && $get['date_to'] != "") {
			$where["(DATE(created_date) BETWEEN '" . $get['date_from'] . "' AND '" . $get['date_to'] . "')"] = NULL;
		}
		if ($get['submit'] == "piecemark") {
			if ($get['status'] == "submitted") {
				$where["workpack_id IS NOT NULL"] = NULL;
				$where["workpack_id !="] = 0;
			} elseif ($get['status'] == "outstanding") {
				$where["workpack_id"] = NULL;
			}
			if ($get['status'] == "void") {
				$where["status_delete"] = 0;
			} elseif ($get['status'] != "") {
				$where["status_delete"] = 1;
			}
			$template_list = $this->engineering_mod->piecemark_list($where);
			$id_user = [];
			$id_void = [];

			$id_piecemark_ref = [];

			foreach ($template_list as $key => $value) {
				if ($value['created_by'] != "" && !in_array($value['created_by'], $id_user)) {
					$id_user[] = $value['created_by'];
				}
				if ($value['status_delete'] == 0) {
					$id_void[] = $value['id'];
				}
				if ($value['ref_pos_1'] != '') {
					$id_piecemark_ref = array_merge($id_piecemark_ref, explode(", ", $value['ref_pos_1']));
				}
			}
			$id_piecemark_ref = array_unique($id_piecemark_ref);

			$piecemark_refrence_list = [];
			if (count($id_piecemark_ref) > 0) {
				$datadb = $this->engineering_mod->piecemark_list([
					"id IN (" . join(", ", $id_piecemark_ref) . ")" => null,
				]);
				foreach ($datadb as $key => $value) {
					$piecemark_refrence_list[$value['id']] = $value['part_id'];
				}
			}

			$reason_void = [];
			if ($get['status'] == "void") {
				$datadb = $this->engineering_mod->revise_history_list([
					"id_data IN ('" . join("', '", $id_void) . "')" => NULL,
					"fabrication_type" => 9,
				]);
				foreach ($datadb as $key => $value) {
					$reason_void[$value['id_data']] = $value['request_reason'];
				}
			}
			if (count($id_user) > 0) {
				$user_list = user_name_data($id_user);
			}
			$numrow = 2;
			foreach ($template_list as $key => $value) {
				$row->setCellValue('A' . $numrow, @$project_list[$value['project']]);
				$row->setCellValue('B' . $numrow, @$discipline_list[$value['discipline']]);
				$row->setCellValue('C' . $numrow, @$module_list[$value['module']]);
				$row->setCellValue('D' . $numrow, @$type_of_module_list[$value['type_of_module']]);
				$row->setCellValue('E' . $numrow, @$deck_elevation_list[$value['deck_elevation']]);
				$row->setCellValue('F' . $numrow, @$desc_assy_list[$value['description_assy']]['code'] . " - " . @$desc_assy_list[$value['description_assy']]['name']);
				$row->setCellValue('G' . $numrow, $value['drawing_ga']);
				$row->setCellValue('H' . $numrow, $value['rev_ga']);
				$row->setCellValue('I' . $numrow, $value['drawing_as']);
				$row->setCellValue('J' . $numrow, $value['rev_as']);
				$row->setCellValue('K' . $numrow, $value['drawing_sp']);
				$row->setCellValue('L' . $numrow, $value['rev_sp']);
				$row->setCellValue('M' . $numrow, $value['part_id']);
				$ref_pos_1 = [''];
				if ($value['ref_pos_1'] != '') {
					$ref_pos_1 = [];
					$piecemark_refrence = explode(", ", $value['ref_pos_1']);
					foreach ($piecemark_refrence as $value) {
						$ref_pos_1[] = @$piecemark_refrence_list[$value];
					}
				}
				$row->setCellValue('N' . $numrow, join(", ", $ref_pos_1));
				$row->setCellValue('O' . $numrow, $value["drawing_cp"]);
				$row->setCellValue('P' . $numrow, $value["rev_cp"]);
				$row->setCellValue('Q' . $numrow, $value["drawing_cl"]);
				$row->setCellValue('R' . $numrow, $value["rev_cl"]);
				$row->setCellValue('S' . $numrow, $value["profile"]);
				$row->setCellValue('T' . $numrow, $value["material"]);
				$row->setCellValue('U' . $numrow, @$material_grade_list[$value["grade"]]['material_grade']);
				$row->setCellValue('V' . $numrow, $value["diameter"]);
				$row->setCellValue('W' . $numrow, $value["thickness"]);
				$row->setCellValue('X' . $numrow, $value["sch"]);
				$row->setCellValue('Y' . $numrow, $value["length"]);
				$row->setCellValue('Z' . $numrow, $value["height"]); //==================
				$row->setCellValue('AA' . $numrow, $value["width"]);
				$row->setCellValue('AB' . $numrow, number_format($value["weight"], 2, ".", ""));
				$row->setCellValue('AC' . $numrow, number_format($value["area"], 2, ".", ""));
				$row->setCellValue('AD' . $numrow, $value["can_number"]);
				$row->setCellValue('AE' . $numrow, $value["test_pack_no"]);
				$row->setCellValue('AF' . $numrow, $value["remarks"]);
				$row->setCellValue('AG' . $numrow, $value["item_code"]);
				$row->setCellValue('AH' . $numrow, $value["spool_no"]);
				$row->setCellValue('AI' . $numrow, $value["beam_chnl_thk"]);
				$row->setCellValue('AJ' . $numrow, $value["strain_age_test_dt"]);
				$row->setCellValue('AK' . $numrow, $value["strain_age_test_yn"]);
				$row->setCellValue('AL' . $numrow, $value["through_thickness"]);
				$row->setCellValue('AM' . $numrow, $value["activity_id"]);
				$row->setCellValue('AN' . $numrow, @$user_list[$value["created_by"]]);
				$row->setCellValue('AO' . $numrow, date("Y-m-d H:i:s", strtotime($value["created_date"])));
				$row->setCellValue('AP' . $numrow, $value['status_internal'] == 0 ? 'External' : 'Internal');
				$row->setCellValue('AQ' . $numrow, $value['is_itr'] == 1 ? 'Yes' : 'No');
				$row->setCellValue('AR' . $numrow, @$piping_testing_category_list[$value['piping_testing_category']]['name']);
				$row->setCellValue('AS' . $numrow, ($value['status_delete'] == 1 ? ($value['workpack_id'] != '' && $value['workpack_id'] != '0' ? 'Submitted' : 'Outstanding') : 'Void'));
				$numrow++;
			}
		} elseif ($get['submit'] == "joint") {
			if ($get['status'] == "submitted") {
				$where["status"] = 1;
				$where["workpack_id IS NOT NULL"] = NULL;
				$where["workpack_id !="] = 0;
			} elseif ($get['status'] == "outstanding") {
				$where["status"] = 1;
				$where["workpack_id"] = NULL;
			} elseif ($get['status'] == "draft") {
				$where["status"] = 0;
			}
			if ($get['status'] == "void") {
				$where["status_delete"] = 0;
			} elseif ($get['status'] != "") {
				$where["status_delete"] = 1;
			}
			unset($where["is_itr"]);
			$template_list = $this->engineering_mod->joint_list($where);
			$id_user = [];
			$id_void = [];
			foreach ($template_list as $key => $value) {
				if ($value['created_by'] != "" && !in_array($value['created_by'], $id_user)) {
					$id_user[] = $value['created_by'];
				}
				$id_void[] = $value['id'];
			}
			$reason_void = [];
			if ($get['status'] == "void") {
				$datadb = $this->engineering_mod->revise_history_list([
					"id_data IN ('" . join("', '", $id_void) . "')" => NULL,
					"fabrication_type" => 9,
				]);
				foreach ($datadb as $key => $value) {
					$reason_void[$value['id_data']] = $value['request_reason'];
				}
			}
			if (count($id_user) > 0) {
				$user_list = user_name_data($id_user);
			}
			$datadb = $this->engineering_mod->eng_drawing_list([
				"status_delete" => 1,
				"client_doc_no !=" => '',
			]);
			$ecodoc_list = [];
			foreach ($datadb as $key => $value) {
				$ecodoc_list[$value['document_no']] = $value['client_doc_no'];
			}
			$numrow = 2;
			foreach ($template_list as $key => $value) {
				$row->setCellValue('A' . $numrow, @$project_list[$value['project']]);
				$row->setCellValue('B' . $numrow, @$discipline_list[$value['discipline']]);
				$row->setCellValue('C' . $numrow, @$module_list[$value['module']]);
				$row->setCellValue('D' . $numrow, @$type_of_module_list[$value['type_of_module']]);
				$row->setCellValue('E' . $numrow, @$deck_elevation_list[$value['deck_elevation']]);
				$row->setCellValue('F' . $numrow, $value['drawing_no']);
				$row->setCellValue('G' . $numrow, @$ecodoc_list[$value['drawing_no']]);
				$row->setCellValue('H' . $numrow, $value['rev_no']);
				$row->setCellValue('I' . $numrow, $value['drawing_wm']);
				$row->setCellValue('J' . $numrow, @$ecodoc_list[$value['drawing_wm']]);
				$row->setCellValue('K' . $numrow, $value['rev_wm']);
				$row->setCellValue('L' . $numrow, $value['joint_no']);
				$row->setCellValue('M' . $numrow, $value['pos_1']);
				$row->setCellValue('N' . $numrow, $value['pos_2']);
				$row->setCellValue('O' . $numrow, @$weld_type_list[$value['weld_type']]['weld_type_code']);
				$row->setCellValue('P' . $numrow, @$desc_assy_list[$value['description_assy']]['code'] . " - " . @$desc_assy_list[$value['description_assy']]['name']);
				$row->setCellValue('Q' . $numrow, $value['phase']);
				$row->setCellValue('R' . $numrow, $value['thickness']);
				$row->setCellValue('S' . $numrow, $value['diameter']);
				$row->setCellValue('T' . $numrow, $value['sch']);
				$row->setCellValue('U' . $numrow, $value['length']);
				$row->setCellValue('V' . $numrow, $value['weld_length']);
				$row->setCellValue('W' . $numrow, @$joint_type_list[$value['joint_type']]['joint_type_code']);
				$row->setCellValue('X' . $numrow, $value['test_pack_no']);
				$row->setCellValue('Y' . $numrow, $value['spool_no']);
				$row->setCellValue('Z' . $numrow, ($value['service_line'] == "" ? "" : "'" . $value['service_line']));
				$row->setCellValue('AA' . $numrow, $value['pid_drawing']);
				$row->setCellValue('AB' . $numrow, @$class_list[$value['class']]['class_code']);
				$row->setCellValue('AC' . $numrow, $value['grid_row']);
				$row->setCellValue('AD' . $numrow, $value['grid_column']);
				$row->setCellValue('AE' . $numrow, $value['mt_percent_req']);
				$row->setCellValue('AF' . $numrow, $value["pt_percent_req"]);
				$row->setCellValue('AG' . $numrow, $value["ut_percent_req"]);
				$row->setCellValue('AH' . $numrow, $value["rt_percent_req"]);
				$row->setCellValue('AI' . $numrow, $value["pwht_percent_req"]);
				$row->setCellValue('AJ' . $numrow, $value["remarks"] . (isset($reason_void[$value['id']]) ? ' (Void Reason : ' . $reason_void[$value['id']] . ')' : ''));
				$row->setCellValue('AK' . $numrow, @$user_list[$value["created_by"]]);
				$row->setCellValue('AL' . $numrow, date("Y-m-d H:i:s", strtotime($value["created_date"])));
				$row->setCellValue('AM' . $numrow, $value['status_internal'] == 0 ? 'External' : 'Internal');
				$row->setCellValue('AN' . $numrow, ($value['status_delete'] == 1 ? ($value['status'] == 0 ? 'Draft' : ($value['workpack_id'] != '' && $value['workpack_id'] != '0' ? 'Submitted' : 'Outstanding')) : 'Void'));
				$numrow++;
			}
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
		header('Content-Disposition: attachment; filename="Export-' . ucwords($get['submit']) . '-' . date('YmdHis') . '.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}

	public function activity_id_import()
	{
		$data['meta_title']   		= 'Import Activity ID';
		$data['subview']      		= 'engineering/import_activity_id';
		$data['sidebar']      		= $this->sidebar;
		$this->load->view('index', $data);
	}

	public function import_activity_id_preview()
	{
		$config['upload_path']          = 'file/engineering/';
		$config['file_name']            = 'excel_' . $this->user_cookie[0];
		$config['allowed_types']        = 'xlsx';
		$config['overwrite'] 						= TRUE;

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

		$data_template = [];
		$data_part_id = [];
		foreach ($sheet as $key => $value) {
			$data_template[] = [
				"part_id" 		=> $value["L"],
				"activity_id" => $value["AL"],
			];
			$data_part_id[] = $value["L"];
		}

		$data["data_template"] = $data_template;

		$data['meta_title']   = 'Import Piecemark Preview';
		$data['subview']      = 'engineering/import_activity_id_preview';
		$data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
	}

	public function import_activity_id_process()
	{
		$post = $this->input->post();
		foreach ($post['part_id'] as $key => $value) {
			$form_data = [
				"activity_id" => $post['activity_id'][$key]
			];
			$where = [
				"part_id" => $post['part_id'][$key],
				"status_delete" => 1,
				"project" => 12,
			];
			$this->engineering_mod->piecemark_update_process_db($form_data, $where);
		}

		$this->session->set_flashdata('success', 'The Data has been Imported!');
		redirect("engineering/activity_id_import");
	}

	public function search_piecemark()
	{
		$get = $this->input->get();
		if (@$get['part_id'] != '') {
			// $get['part_id'] = preg_replace('/\s/', '', $get['part_id']);
			$data['get'] = $get;

			$datadb = $this->engineering_mod->piecemark_list([
				"part_id" => $get['part_id'],
				"status_delete" => 1,
			]);
			if (count($datadb) > 0) {
				$piecemark = $datadb[0];
				$data['piecemark'] = $piecemark;

				$workpack_list = [];
				$datadb = $this->planning_mod->workpack_detail_list(["id_template" => $piecemark['id'], "status_delete" => 1]);
				foreach ($datadb as $key => $value) {
					$wp = $this->planning_mod->workpack_list(["id" => $value['id_workpack']]);
					$wp = $wp[0];
					if ($wp['phase'] == 'PF' || $wp['phase'] == 'ITR') {
						$workpack_list[] = [$wp, $value];
					}
				}
				$data['workpack_list'] = $workpack_list;

				$itr_list = [];
				$datadb = $this->itr_mod->itr_list(["id_piecemark" => $piecemark['id']]);
				foreach ($datadb as $key => $value) {
					if (!isset($itr_list[$value['submission_id']])) {
						$itr_list[$value['submission_id']] = $value;
					}
				}
				$data['itr_list'] = array_reverse($itr_list);

				$material_list = [];
				$datadb = $this->material_verification_mod->mv_list(["id_piecemark" => $piecemark['id']]);
				foreach ($datadb as $key => $value) {
					if (!isset($material_list[$value['submission_id']])) {
						$material_list[$value['submission_id']] = $value;
					}
				}
				$data['material_list'] = array_reverse($material_list);

				$joint_list = [];
				$id_joint_arr = [];
				$id_workpack_joint_arr = [];
				$fitup_list = [];
				$visual_list = [];
				$company_workpack_list = [];
				$datadb = $this->engineering_mod->joint_list([
					"(pos_1 LIKE '" . $piecemark['part_id'] . "' OR pos_2 LIKE '" . $piecemark['part_id'] . "')" => NULL,
					"status_delete" => 1,
				]);
				foreach ($datadb as $key => $value) {
					$joint_list[] = $value;
					$id_joint_arr[] = $value['id'];
					$fitup_list[$value['id']] = [];
					$visual_list[$value['id']] = [];
					$bondstrand_list[$value['id']] = [];
					if ($value['workpack_id'] != '') {
						$id_workpack_joint_arr[] = $value['workpack_id'];
					}
				}
				$data['joint_list'] = $joint_list;

				if (count($joint_list) > 0) {
					$datadb = $this->fitup_mod->fu_list([
						"id_joint IN (" . join(", ", $id_joint_arr) . ")" => NULL
					]);
					foreach ($datadb as $key => $value) {
						if (!isset($fitup_list[$value['id_joint']][$value['submission_id']])) {
							$fitup_list[$value['id_joint']][$value['submission_id']] = $value;
						}
					}
					foreach ($fitup_list as $key => $value) {
						$fitup_list[$key] = array_reverse($fitup_list[$key]);
					}

					$datadb = $this->visual_mod->vt_list([
						"id_joint IN (" . join(", ", $id_joint_arr) . ")" => NULL
					]);
					foreach ($datadb as $key => $value) {
						if (!isset($visual_list[$value['id_joint']][$value['submission_id']])) {
							$visual_list[$value['id_joint']][$value['submission_id']] = $value;
						}
					}
					foreach ($visual_list as $key => $value) {
						$visual_list[$key] = array_reverse($visual_list[$key]);
					}

					$datadb = $this->bondstrand_mod->bondstrand_list([
						"id_joint IN (" . join(", ", $id_joint_arr) . ")" => NULL
					]);
					foreach ($datadb as $key => $value) {
						if (!isset($bondstrand_list[$value['id_joint']][$value['submission_id']])) {
							$bondstrand_list[$value['id_joint']][$value['submission_id']] = $value;
						}
					}
					foreach ($bondstrand_list as $key => $value) {
						$bondstrand_list[$key] = array_reverse($bondstrand_list[$key]);
					}
				}
				$data['bondstrand_list'] = $bondstrand_list;
				$data['fitup_list'] = $fitup_list;
				$data['visual_list'] = $visual_list;


				if (count($id_workpack_joint_arr) > 0) {
					$datadb = $this->planning_mod->workpack_list(["id IN (" . join(", ", $id_workpack_joint_arr) . ")" => NULL]);
					foreach ($datadb as $key => $value) {
						$company_workpack_list[$value['id']] = $value['company_id'];
					}
				}
				$data['company_workpack_list'] = $company_workpack_list;


				$irn_list = $this->irn_mod->irn_list([
					"id_piecemark" => $piecemark['id'],
				]);
				$data['irn_list'] = $irn_list;
				// test_var([$joint_list, $fitup_list]);
			}
		}

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['id']] = $value;
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
			$project_list[$value['id']] = $value;
		}
		$data['project_list'] = $project_list;
		unset($where);

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['id']] = $value;
		}
		$data['type_of_module_list'] = $type_of_module_list;
		$datadb = $this->general_mod->company();
		$company_list = [];
		foreach ($datadb as $key => $value) {
			$company_list[$value['id_company']] = $value;
		}
		$data['company_list'] = $company_list;

		$datadb = $this->general_mod->deck_elevation();
		$deck_elevation_list = [];
		foreach ($datadb as $key => $value) {
			$deck_elevation_list[$value['id']] = $value;
		}
		$data['deck_elevation_list'] = $deck_elevation_list;

		$datadb = $this->general_mod->desc_assy();
		$desc_assy_list = [];
		foreach ($datadb as $key => $value) {
			$desc_assy_list[$value['id']] = $value;
		}
		$data['desc_assy_list'] = $desc_assy_list;

		$data['meta_title']   = 'Search Piecemark';
		$data['subview']      = 'engineering/search_piecemark';
		$data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
	}

	public function search_joint()
	{
		$get = $this->input->get();
		if (@$get['joint_no'] != '' && (@$get['drawing_wm'] != '' || @$get['spool_no'] != '')) {
			$get['joint_no'] = preg_replace('/\s/', '', $get['joint_no']);
			$get['drawing_wm'] = preg_replace('/\s/', '', $get['drawing_wm']);
			$data['get'] = $get;

			$where = [
				"status_delete" => 1,
				"joint_no" => $get['joint_no'],
			];
			if (@$get['drawing_wm']) {
				$where['drawing_wm'] = $get['drawing_wm'];
			}
			if (@$get['spool_no']) {
				$where['spool_no'] = $get['spool_no'];
			}
			$datadb = $this->engineering_mod->joint_list($where);
			if (count($datadb) > 0) {
				$joint = $datadb[0];
				$data['joint'] = $joint;

				$workpack_list = [];
				$company_workpack_list = [];
				$datadb = $this->planning_mod->workpack_detail_list(["id_template" => $joint['id'], "status_delete" => 1]);
				foreach ($datadb as $key => $value) {
					$wp = $this->planning_mod->workpack_list(["id" => $value['id_workpack']]);
					$wp = $wp[0];
					if ($wp['phase'] != 'PF' && $wp['phase'] != 'ITR' && $wp['phase'] != 'B&P') {
						$workpack_list[] = [$wp, $value];
						if (!isset($company_workpack_list[$wp['id']])) {
							$company_workpack_list[$wp['id']] = $wp['company_id'];
						}
					}
				}
				$data['company_workpack_list'] = $company_workpack_list;
				$data['workpack_list'] = $workpack_list;

				$id_piecemark_arr = [];
				$piecemark_list = [];
				$material_list = [];
				$datadb = $this->engineering_mod->piecemark_list(["part_id = '" . $joint['pos_1'] . "' OR part_id = '" . $joint['pos_2'] . "'" => NULL]);
				foreach ($datadb as $key => $value) {
					$piecemark_list[] = $value;
					$id_piecemark_arr[] = $value['id'];
					$material_list[$value['id']] = [];
				}
				$data['piecemark_list'] = $piecemark_list;

				if (count($piecemark_list) > 0) {
					$datadb = $this->material_verification_mod->mv_list(["id_piecemark IN (" . join(", ", $id_piecemark_arr) . ")" => null]);
					foreach ($datadb as $key => $value) {
						if (!isset($material_list[$value['id_piecemark']][$value['submission_id']])) {
							$material_list[$value['id_piecemark']][$value['submission_id']] = $value;
						}
					}
					foreach ($material_list as $key => $value) {
						$material_list[$key] = array_reverse($material_list[$key]);
					}
				}
				$data['material_list'] = $material_list;

				$fitup_list = [];
				$datadb = $this->fitup_mod->fu_list(["id_joint" => $joint['id']]);
				foreach ($datadb as $key => $value) {
					if (!isset($fitup_list[$value['submission_id']])) {
						$fitup_list[$value['submission_id']] = $value;
					}
				}
				$data['fitup_list'] = array_reverse($fitup_list);

				$visual_list = [];
				$datadb = $this->visual_mod->vt_list(["id_joint" => $joint['id']]);
				foreach ($datadb as $key => $value) {
					if (!isset($visual_list[$value['submission_id']])) {
						$visual_list[$value['submission_id']] = $value;
					}
					$visual_ndt_list[$value['id_visual']] = [
						"revision_category" => $value["revision_category"],
						"revision" => $value["revision"],
					];
				}
				$data['visual_list'] = array_reverse($visual_list);

				$bondstrand_list = [];
				$datadb = $this->bondstrand_mod->bondstrand_list(["id_joint" => $joint['id']]);
				foreach ($datadb as $key => $value) {
					if (!isset($bondstrand_list[$value['submission_id']])) {
						$bondstrand_list[$value['submission_id']] = $value;
					}
				}
				$data['bondstrand_list'] = array_reverse($bondstrand_list);

				$datadb = $this->ndt_mod->master_ndt();
				foreach ($datadb as $value) {
					$data['ndt_type'][$value['id']]	= $value;
					$data['ndt_arr'][$value['ndt_initial']] = $value['id'];
				}


				$data_ndt_all = $this->ndt_mod->pcms_ndt_all_nowelder(["id_joint" => $joint['id']]);
				$data_ndt_atc = $this->ndt_mod->pcms_ndt_all_nowelder_attachment(["id_joint" => $joint['id']]);

				$ndt_list_all = [];
				$ndt_list_atc = [];
				// test_var($datadb);
				foreach ($data_ndt_all as $key => $value) {
					$row = $value;
					$row["revision_category"] = @$visual_ndt_list[$value["id_visual"]]["revision_category"];
					$row["revision"] = @$visual_ndt_list[$value["id_visual"]]["revision"];
					$ndt_list_all[] = $row;
				}

				foreach ($data_ndt_atc as $key => $value) {
					$row = $value;
					$row["revision_category"] = @$visual_ndt_list[$value["id_visual"]]["revision_category"];
					$row["revision"] = @$visual_ndt_list[$value["id_visual"]]["revision"];
					$ndt_list_atc[] = $row;
				}

				$data['ndt_list_all'] = array_reverse($ndt_list_all);
				$data['ndt_list_atc'] = array_reverse($ndt_list_atc);

				$irn_list = $this->irn_mod->irn_list([
					"id_joint" => $joint['id'],
				]);
				$data['irn_list'] = $irn_list;
			}
		}

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['id']] = $value;
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
			$project_list[$value['id']] = $value;
		}
		$data['project_list'] = $project_list;
		unset($where);

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['id']] = $value;
		}
		$data['type_of_module_list'] = $type_of_module_list;
		$datadb = $this->general_mod->company();
		$company_list = [];
		foreach ($datadb as $key => $value) {
			$company_list[$value['id_company']] = $value;
		}
		$data['company_list'] = $company_list;

		$datadb = $this->general_mod->deck_elevation();
		$deck_elevation_list = [];
		foreach ($datadb as $key => $value) {
			$deck_elevation_list[$value['id']] = $value;
		}
		$data['deck_elevation_list'] = $deck_elevation_list;

		$datadb = $this->general_mod->desc_assy();
		$desc_assy_list = [];
		foreach ($datadb as $key => $value) {
			$desc_assy_list[$value['id']] = $value;
		}
		$data['desc_assy_list'] = $desc_assy_list;

		$datadb = $this->ndt_mod->master_ndt();
		$ndt_type_list = [];
		foreach ($datadb as $key => $value) {
			$ndt_type_list[$value['id']] = $value;
		}
		$data['ndt_type_list'] = $ndt_type_list;

		$datadb = $this->general_mod->master_surveyor_status([
			"status_deleted" => "0",
		]);
		$surveyor_status_list = [];
		foreach ($datadb as $key => $value) {
			$surveyor_status_list[$value['id']] = $value;
		}
		$data['surveyor_status_list'] = $surveyor_status_list;

		$datadb = $this->general_mod->sector();
		$sector_list = [];
		foreach ($datadb as $key => $value) {
			$sector_list[$value['row'] . $value['column']] = $value['sector'];
		}
		$data['sector_list'] = $sector_list;

		$data['meta_title']   = 'Search Joint';
		$data['subview']      = 'engineering/search_joint';
		$data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
	}

	function display_piecemark()
	{
		$post = $this->input->post();
		$where = [
			"part_id ILIKE ('%' || replace('" . $post['term'] . "', ' ', '') || '%')" => NULL,
			"status_delete" => 1,
			"project IN (" . join(", ", $this->user_cookie[13]) . ")" => NULL,
			"company_id IN (" . join(", ", $this->user_cookie[14]) . ")" => NULL,
		];
		// test_var($where);
		$datadb = $this->engineering_mod->piecemark_list($where, 10);
		$output = [];
		if (count($datadb) > 0) {
			foreach ($datadb as $key => $value) {
				$output[] = $value["part_id"];
			}
		} else {
			$output[] = "No Data.";
		}
		echo json_encode($output);
	}

	public function check_piecemark()
	{
		error_reporting(0);
		$pos = $this->input->post('pos');

		$where['part_id'] = $pos;
		// $where['pcms_material.status_delete'] = 0;
		$template = $this->material_verification_mod->drawing_list_get_db($where)[0];
		unset($where);

		$where["pos_1 ILIKE '%" . $pos . "%' OR pos_2 ILIKE '%" . $pos . "%'"] = NULL;
		$joint = $this->general_mod->pcms_joint($where);
		unset($where);

		foreach ($joint as $key => $value) {
			$id_joint[] = $value['id'];
		}

		if (COUNT($id_joint) == 0) {
			$id_joint[] = 999999;
		}

		$where["id_joint IN (" . implode(', ', $id_joint) . ")"] = NULL;
		$fitup = $this->fitup_mod->joint_list($where);
		unset($where);

		$where['part_id'] = $pos;
		$where['pcms_material.status_delete'] = 0;
		$workpack = $this->material_verification_mod->find_material_verification_data($where)[0];
		unset($where);

		// test_var($template);

		$datadb = $this->general_mod->type_of_module();
		foreach ($datadb as $key => $value) {
			$type_of_module[$value['id']] = $value['name'];
		}

		$datadb = $this->general_mod->discipline();
		foreach ($datadb as $key => $value) {
			$discipline[$value['id']] = $value['discipline_name'];
		}

		$datadb = $this->general_mod->module();
		foreach ($datadb as $key => $value) {
			$module[$value['mod_id']] = $value['mod_desc'];
		}

		$datadb = $this->general_mod->deck_elevation();
		foreach ($datadb as $key => $value) {
			$deck[$value['id']] = $value['name'];
		}

		$project_enc = strtr($this->encryption->encrypt($template['project_code']), '+=/', '.-~');
		$discipline_enc = strtr($this->encryption->encrypt($template['discipline']), '+=/', '.-~');
		$type_of_module_enc = strtr($this->encryption->encrypt($template['type_of_module']), '+=/', '.-~');
		$module_enc = strtr($this->encryption->encrypt($template['module']), '+=/', '.-~');

		$link_tmp = base_url('engineering/piecemark_list/') . '?drawing_ga=' . $template['drawing_ga'] . '&project=' . $template['project'] . '&discipline=' . $template['discipline'] . '&module=' . $template['module'] . '&type_of_module=' . $template['type_of_module'] . '&drawing_as=' . $template['drawing_as'] . '&deck_elevation=' . $template['deck_elevation'] . '&status=submitted&submit=search';

		$main = "<hr/>";
		$main .= "
  		  <div class='row'>
		    <div class='col'>
		      <div class='card shadow my-3 rounded-0'>
		        <div class='card-header'>
		          <h6 class='m-0'><strong><center><a href='" . $link_tmp . "' target='_blank'>" . $pos . "</a></center></strong></h6>
		        </div>
		        <div class='card-body bg-white overflow-auto'>  
		                                         
		            <div class='row'>

		              <div class='col-6'>
		                <div class='form-group row'>
		                  <label class='col-md-4 col-lg-3 col-form-label '>Drawing GA</label>
		                  <div class='col-xl'>
		                   <input type='text' class='form-control' value='" . $template['drawing_ga'] . "' readonly>
		                  </div>
		                </div>
		              </div>

		              <div class='col-6'>
		                <div class='form-group row'>
		                  <label class='col-md-4 col-lg-3 col-form-label '>Drawing AS</label>
		                  <div class='col-xl'>
		                   <input type='text' class='form-control' value='" . $template['drawing_as'] . "' readonly>
		                  </div>
		                </div>
		              </div>

		              <div class='col-6'>
		                <div class='form-group row'>
		                  <label class='col-md-4 col-lg-3 col-form-label '>Drawing SP</label>
		                  <div class='col-xl'>
		                   <input type='text' class='form-control' value='" . $template['drawing_sp'] . "' readonly>
		                  </div>
		                </div>
		              </div>

		              <div class='col-6'>
		                <div class='form-group row'>
		                  <label class='col-md-4 col-lg-3 col-form-label '>Drawing CP</label>
		                  <div class='col-xl'>
		                   <input type='text' class='form-control' value='" . $template['drawing_cp'] . "' readonly>
		                  </div>
		                </div>
		              </div>

		              <div class='col-6'>
		                <div class='form-group row'>
		                  <label class='col-md-4 col-lg-3 col-form-label '>Drawing CL</label>
		                  <div class='col-xl'>
		                   <input type='text' class='form-control' value='" . $template['drawing_cl'] . "' readonly>
		                  </div>
		                </div>
		              </div>

		              <div class='col-6'></div>

		              <div class='col-6'>
		                <div class='form-group row'>
		                  <label class='col-md-4 col-lg-3 col-form-label '>Discipline</label>
		                  <div class='col-xl'>
		                   <input type='text' class='form-control' value='" . $discipline[$template['discipline']] . "' readonly>
		                  </div>
		                </div>
		              </div>

		              <div class='col-6'>
		                <div class='form-group row'>
		                  <label class='col-md-4 col-lg-3 col-form-label '>Module</label>
		                  <div class='col-xl'>
		                   <input type='text' class='form-control' value='" . $module[$template['module']] . "' readonly>
		                  </div>
		                </div>
		              </div>

		              <div class='col-6'>
		                <div class='form-group row'>
		                  <label class='col-md-4 col-lg-3 col-form-label '>Module Type</label>
		                  <div class='col-xl'>
		                   <input type='text' class='form-control' value='" . $type_of_module[$template['type_of_module']] . "' readonly>
		                  </div>
		                </div>
		              </div>

		              <div class='col-6'>
		                <div class='form-group row'>
		                  <label class='col-md-4 col-lg-3 col-form-label '>Deck Elevation / Service Line</label>
		                  <div class='col-xl'>
		                   <input type='text' class='form-control' value='" . $deck[$template['deck_elevation']] . "' readonly>
		                  </div>
		                </div>
		              </div>

		            </div>            
		        <div class='fl-scrolls fl-scrolls-hidden' data-orientation='horizontal' style='width: 899px; left: 21px;'><div style='width: 899px;'>
		        </div>
		        </div>
		        </div>
		      </div>
		    </div>
		  </div>
	  		";

		echo $main;
	}

	public function check_piecemark_2()
	{
		error_reporting(0);
		$pos = $this->input->post('pos');

		$where['part_id'] = $pos;
		$where['pcms_material.status_delete'] = 0;
		$template = $this->planning_mod->piecemark_list($where)[0];
		unset($where);

		$where["pos_1 ILIKE '%" . $pos . "%' OR pos_2 ILIKE '%" . $pos . "%'"] = NULL;
		$joint = $this->general_mod->pcms_joint($where);
		unset($where);

		foreach ($joint as $key => $value) {
			$id_joint[] = $value['id'];
		}

		if (COUNT($id_joint) == 0) {
			$id_joint[] = 999999;
		}

		$where["id_joint IN (" . implode(', ', $id_joint) . ")"] = NULL;
		$fitup = $this->fitup_mod->joint_list($where);
		unset($where);

		$where['part_id'] = $pos;
		// $where['pcms_material.status_delete'] = 0;
		$workpack = $this->planning_mod->piecemark_list($where)[0];
		if ($this->user_cookie[0] == 1000226) {
			// test_var($workpack);
		}
		unset($where);

		$datadb = $this->general_mod->type_of_module();
		foreach ($datadb as $key => $value) {
			$type_of_module[$value['id']] = $value['name'];
		}

		$datadb = $this->general_mod->discipline();
		foreach ($datadb as $key => $value) {
			$discipline[$value['id']] = $value['discipline_name'];
		}

		$datadb = $this->general_mod->module();
		foreach ($datadb as $key => $value) {
			$module[$value['mod_id']] = $value['mod_desc'];
		}

		$datadb = $this->general_mod->deck_elevation();
		foreach ($datadb as $key => $value) {
			$deck[$value['id']] = $value['name'];
		}

		$project_enc = strtr($this->encryption->encrypt($template['project_code']), '+=/', '.-~');
		$discipline_enc = strtr($this->encryption->encrypt($template['discipline']), '+=/', '.-~');
		$type_of_module_enc = strtr($this->encryption->encrypt($template['type_of_module']), '+=/', '.-~');
		$module_enc = strtr($this->encryption->encrypt($template['module']), '+=/', '.-~');
		$report_number_enc = strtr($this->encryption->encrypt($template['report_number']), '+=/', '.-~');
		$report_no_rev_enc = strtr($this->encryption->encrypt($template['report_no_rev']), '+=/', '.-~');

		$link_wp = base_url('planning/workpack_detail/') . strtr($this->encryption->encrypt($workpack['workpack_id']), '+=/', '.-~');
		$link_mv = base_url('material_verification/detail_inspection_rfi/') . strtr($this->encryption->encrypt($template['submission_id']), '+=/', '.-~');
		$link_mv_client = base_url('material_verification/detail_client_rfi/') . $project_enc . '/' . $discipline_enc . '/' . $type_of_module_enc . '/' . $module_enc . '/' . $report_number_enc . '/' . $report_no_rev_enc;

		$link_tmp = base_url('engineering/piecemark_list/') . '?drawing_ga=' . $template['drawing_ga'] . '&project=' . $template['project'] . '&discipline=' . $template['discipline'] . '&module=' . $template['module'] . '&type_of_module=' . $template['type_of_module'] . '&drawing_as=' . $template['drawing_as'] . '&deck_elevation=' . $template['deck_elevation'] . '&status=submitted&submit=search';

		if ($template['status_inspection'] == 0) {
			$status_mv = "<span class='btn btn-primary'>Production RFI</span>";
		} elseif ($template['status_inspection'] == 1) {
			$status_mv = "<span class='btn btn-warning'>Inspection RFI - Pending Approval</span>";
		} elseif ($template['status_inspection'] == 2) {
			$status_mv = "<span class='btn btn-danger'>Inspection RFI - Rejected</span>";
		} elseif ($template['status_inspection'] >= 3) {
			$status_mv = "<span class='btn btn-success'>Inspection RFI - Approved</span>";
		} elseif ($template['status_inspection'] >= 4) {
			$status_mv = "<span class='btn btn-primary'>Inspection RFI - Pending by QC</span>";
		}

		if ($template['status_inspection'] == 5) {
			$status_mv_client = "<span class='btn btn-warning'>Client RFI - Pending Approval</span>";
		} elseif ($template['status_inspection'] == 6) {
			$status_mv_client = "<span class='btn btn-danger'>Client RFI - Rejected</span>";
		} elseif ($template['status_inspection'] == 7) {
			$status_mv_client = "<span class='btn btn-success'>Client RFI - Accepted</span>";
		} elseif ($template['status_inspection'] == 9) {
			$status_mv_client = "<span class='btn btn-primary'>Client RFI - Accepted with Comment</span>";
		} elseif ($template['status_inspection'] == 10) {
			$status_mv_client = "<span class='btn btn-warning'>Client RFI - Postponed</span>";
		} elseif ($template['status_inspection'] == 11) {
			$status_mv_client = "<span class='btn btn-warning'>Client RFI - Re-Offer</span>";
		} else {
			$status_mv_client = "<span class='btn btn-warning'>N/A</span>";
		}

		$detail = "

	  		<style>
		  		.nav-pills .nav-link.active, .nav-pills .show > .nav-link {
				    color: #fff;
				    background-color: #008060;
				}
				.nav-link {
					color: #008060;
				}
	  		</style>

	  		<div>
		  		<ul class='nav nav-tabs nav-pills nav-justified' id='myTab' role='tablist'>
				  <li class='nav-item'>
				    <a class='nav-link active' id='workpack-tab' data-toggle='tab' href='#workpack' role='tab' aria-controls='workpack' aria-selected='false'>Workpack</a>
				  </li>
				  <li class='nav-item'>
				    <a class='nav-link' id='material-tab' data-toggle='tab' href='#material' role='tab' aria-controls='material' aria-selected='false'>Material Verification</a>
				  </li>
				  <li class='nav-item'>
				    <a class='nav-link' id='fitup-tab' data-toggle='tab' href='#fitup' role='tab' aria-controls='fitup' aria-selected='false'>Fit-Up Inspection</a>
				  </li>
				</ul>
				<div class='tab-content' id='myTabContent'>
				  <div class='tab-pane fade show active' id='workpack' role='tabpanel' aria-labelledby='workpack-tab'>
			
	  		";

		if ($workpack['workpack_no']) {
			$detail .= "<hr/>";
			$detail .= "
					<table width='100%'>					
						<tr>
							<td colspan='3'><b>Workpack</b></td>
						</tr>
						<tr>
							<td style='width:150px !important'>Workpack No</td>
							<td style='width:15px !important'>:</td>
							<td><a href=" . $link_wp . "><b><u>" . $workpack['workpack_no'] . "</a></b></u></td>
						</tr>
						<tr>
							<td style='width:150px !important'>Phase</td>
							<td style='width:15px !important'>:</td>
							<td>" . $workpack['phase'] . "</td>
						</tr>
						<tr>
							<td style='width:150px !important'>Plan Start</td>
							<td style='width:15px !important'>:</td>
							<td>" . $workpack['plan_start_date'] . "</td>
						</tr>
						<tr>
							<td style='width:150px !important'>Plan Finish</td>
							<td style='width:15px !important'>:</td>
							<td>" . $workpack['plan_finish_date'] . "</td>
						</tr>
						<tr>
							<td style='width:150px !important'>Progress</td>
							<td style='width:15px !important'>:</td>
							<td>" . $workpack['progress_mv'] . " %</td>
						</tr>
					</table>";
		}

		$detail .= "</div>";

		// $detail .= "
		//   <div class='tab-pane fade' id='workpack' role='tabpanel' aria-labelledby='workpack-tab'>...</div>
		//   <div class='tab-pane fade' id='material' role='tabpanel' aria-labelledby='material-tab'>...</div>
		//   <div class='tab-pane fade' id='fitup' role='tabpanel' aria-labelledby='fitup-tab'>...</div>
		// </div>";
		// $detail .= "</div>";

		$detail .= "<div class='tab-pane fade' id='material' role='tabpanel' aria-labelledby='material-tab'>";
		if ($workpack['status_inspection'] > 0) {
			$detail .= "<hr/>";
			$detail .= "
					<table width='100%'>					
						<tr>
							<td colspan='3'><b>Material Verification</b></td>
						</tr>
						<tr>
							<td style='width:150px !important'>Submission ID</td>
							<td style='width:15px !important'>:</td>
							<td><a href=" . $link_mv . "><b><u>" . $workpack['submission_id'] . "</a></b></u></td>
						</tr>
						<tr>
							<td style='width:150px !important'>Inspection Status (SMOE)</td>
							<td style='width:15px !important'>:</td>
							<td>" . $status_mv . "</td>
						</tr>
						<tr>
							<td style='width:150px !important'>Report No</td>
							<td style='width:15px !important'>:</td>
							<td><a href=" . $link_mv_client . "><b><u>" . $workpack['report_number'] . "</a></b></u></td>
						</tr>
						<tr>
							<td style='width:150px !important'>Inspection Status (CPY)</td>
							<td style='width:15px !important'>:</td>
							<td>" . $status_mv_client . "</td>
						</tr>
					</table>";
		}
		$detail .= "</div>";

		$detail .= "<div class='tab-pane fade' id='fitup' role='tabpanel' aria-labelledby='fitup-tab'>";
		foreach ($fitup as $key => $value) {

			$report_number_fi_enc = strtr($this->encryption->encrypt($value['report_number']), '+=/', '.-~');
			$link_fi = base_url('fitup/joint_inspection_list/') . strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~');
			$link_fi_client = base_url('fitup/client_inspection/') . $project_enc . '/' . $discipline_enc . '/' . $module_enc . '/' . $type_of_module_enc . '/' . $report_number_fi_enc;

			if ($value['status_inspection'] == 0) {
				$status_fi = "<span class='btn btn-primary'>Production RFI</span>";
			} elseif ($value['status_inspection'] == 1) {
				$status_fi = "<span class='btn btn-warning'>Inspection RFI - Pending Approval</span>";
			} elseif ($value['status_inspection'] == 2) {
				$status_fi = "<span class='btn btn-danger'>Inspection RFI - Rejected</span>";
			} elseif ($value['status_inspection'] >= 3) {
				$status_fi = "<span class='btn btn-success'>Inspection RFI - Approved</span>";
			} elseif ($value['status_inspection'] >= 4) {
				$status_fi = "<span class='btn btn-primary'>Inspection RFI - Pending by QC</span>";
			}

			if ($value['status_inspection'] == 5) {
				$status_fi_client = "<span class='btn btn-warning'>Client RFI - Pending Approval</span>";
			} elseif ($value['status_inspection'] == 6) {
				$status_fi_client = "<span class='btn btn-danger'>Client RFI - Rejected</span>";
			} elseif ($value['status_inspection'] == 7) {
				$status_fi_client = "<span class='btn btn-success'>Client RFI - Accepted</span>";
			} elseif ($value['status_inspection'] == 9) {
				$status_fi_client = "<span class='btn btn-primary'>Client RFI - Accepted with Comment</span>";
			} elseif ($value['status_inspection'] == 10) {
				$status_fi_client = "<span class='btn btn-warning'>Client RFI - Postponed</span>";
			} elseif ($value['status_inspection'] == 11) {
				$status_fi_client = "<span class='btn btn-warning'>Client RFI - Re-Offer</span>";
			} else {
				$status_fi_client = "<span class='btn btn-warning'>N/A</span>";
			}

			$detail .= "<hr/>";
			$detail .= "
				<table width='100%'>					
					<tr>
						<td colspan='3'><b>Fitup Inspection</b></td>
					</tr>
					<tr>
						<td style='width:150px !important'>Joint No</td>
						<td style='width:15px !important'>:</td>
						<td>" . $value['joint_no'] . "</td>
					</tr>

					<tr>
						<td style='width:150px !important'>POS #1</td>
						<td style='width:15px !important'>:</td>
						<td>" . $value['pos_1'] . "</td>
					</tr>
					<tr>
						<td style='width:150px !important'>POS #2</td>
						<td style='width:15px !important'>:</td>
						<td>" . $value['pos_2'] . "</td>
					</tr>

					<tr>
						<td style='width:150px !important'>Submission ID</td>
						<td style='width:15px !important'>:</td>
						<td><a href=" . $link_fi . "><b><u>" . $value['submission_id'] . "</a></b></u></td>
					</tr>
					<tr>
						<td style='width:150px !important'>Inspection Status (SMOE)</td>
						<td style='width:15px !important'>:</td>
						<td>" . $status_fi . "</td>
					</tr>";
			if ($value['status_inspection'] >= 5) {
				$detail .=   "<tr>
						<td style='width:150px !important'>Report No</td>
						<td style='width:15px !important'>:</td>
						<td><a href=" . $link_fi_client . "><b><u>" . $value['report_number'] . ' Rev.' . str_pad($value['postpone_reoffer_no'], 2, 0, STR_PAD_LEFT) . "</a></b></u></td>
					</tr>
					<tr>
						<td style='width:150px !important'>Inspection Status (CPY)</td>
						<td style='width:15px !important'>:</td>
						<td>" . $status_fi_client . "</td>
					</tr>";
			}
			$detail .= "</table>";
			unset($status_fi, $status_fi_client);
		}

		$detail .= "</div>";
		$detail .= "</div>";
		$detail .= "</div>";

		print_r($detail);
	}

	public function get_table_history_log()
	{
		$post = $this->input->post();

		$datadb = $this->general_mod->material_grade();
		foreach ($datadb as $key => $value) {
			$material_grade_list[$value['id']] = $value;
		}

		$history_list = [];
		$user_arr = [];
		$datadb = $this->engineering_mod->revision_log_list([
			"id_template" => $post["id_template"],
			"module" => $post["module"],
		]);
		foreach ($datadb as $key => $value) {
			$user_arr[] = $value['created_by'];
			$temp = $value;
			$temp['status_review'] = 0;
			$history_list[] = $temp;
		}
		$datadb = $this->engineering_mod->revision_log_temp_list([
			"id_template" => $post["id_template"],
			"module" => $post["module"],
		]);
		foreach ($datadb as $key => $value) {
			$user_arr[] = $value['created_by'];
			$temp = $value;
			$temp['status_review'] = 1;
			$history_list[] = $temp;
		}
		if (count($user_arr) > 0) {
			$user_list = user_name_data($user_arr);
		}

		$table 	= "<table class='table table-bordered text-center'>" .
			"<thead class='bg-green-smoe text-white'>" .
			"<tr>" .
			"<th>No.</th>" .
			"<th>Data Change</th>" .
			"<th>Change From</th>" .
			"<th>Change To</th>" .
			"<th>Changed By</th>" .
			"<th>Changed Date</th>" .
			"</tr>" .
			"</thead>" .
			"<tbody>";
		if (count($user_arr) > 0) {
			$no = 1;
			foreach ($history_list as $key => $value) {
				$data_before = $value['data_before'];
				$data_after = $value['data_after'];
				if ($value['name'] == 'Status Template' && $value['column_name'] == 'status') {
					$master = [
						0 => 'Draft',
						1 => 'Outstanding',
					];
					$data_before = $master[$data_before];
					$data_after = $master[$data_after];
				}
				if ($value['column_name'] == 'grade') {
					$data_before = @$material_grade_list[$data_before]['material_grade'];
					$data_after = @$material_grade_list[$data_after]['material_grade'];
				}
				if ($value['column_name'] == 'status_inspection') {
					if ($value["data_before"] == 0) {
						$data_before = '<span class="badge badge-pill badge-info">Submit RFI</span>';
					} else if ($value["data_before"] == 1) {
						$data_before = '<span class="badge badge-pill badge-info">Submitted</span>';
					} else if ($value["data_before"] == 2) {
						$data_before = '<span class="badge badge-pill badge-info">Rejected by QC</span>';
					} else if ($value["data_before"] == 3) {
						$data_before = '<span class="badge badge-pill badge-info">Approved By QC</span>';
					} else if ($value["data_before"] == 5) {
						$data_before = '<span class="badge badge-pill badge-info">Pending Approval Client</span>';
					} else if ($value["data_before"] == 6) {
						$data_before = '<span class="badge badge-pill badge-info">Rejected by Client</span>';
					} else if ($value["data_before"] == 7) {
						$data_before = '<span class="badge badge-pill badge-info">Approved by Client</span>';
					} else if ($value["data_before"] == 12) {
						$data_before = '<span class="badge badge-pill badge-dark">Void</span>';
					}
				}

				if ($value['column_name'] == 'status_inspection') {
					if ($value["data_after"] == 0) {
						$data_after = '<span class="badge badge-pill badge-info">Submit RFI</span>';
					} else if ($value["data_after"] == 1) {
						$data_after = '<span class="badge badge-pill badge-info">Submitted</span>';
					} else if ($value["data_after"] == 2) {
						$data_after = '<span class="badge badge-pill badge-info">Rejected by QC</span>';
					} else if ($value["data_after"] == 3) {
						$data_after = '<span class="badge badge-pill badge-info">Approved By QC</span>';
					} else if ($value["data_after"] == 5) {
						$data_after = '<span class="badge badge-pill badge-info">Pending Approval Client</span>';
					} else if ($value["data_after"] == 6) {
						$data_after = '<span class="badge badge-pill badge-info">Rejected by Client</span>';
					} else if ($value["data_after"] == 7) {
						$data_after = '<span class="badge badge-pill badge-info">Approved by Client</span>';
					} else if ($value["data_after"] == 12) {
						$data_after = '<span class="badge badge-pill badge-dark">Void</span>';
					}
				}
				$no_text = "On Review<br>Client";
				if ($value["status_review"] == 0) {
					$no_text = $no++;
				}
				$table .=	"<tr>" .
					"<td>" . $no_text . "</td>" .
					"<td>" . $value['name'] . "</td>" .
					"<td>" . $data_before . "</td>" .
					"<td>" . $data_after . "</td>" .
					"<td>" . $user_list[$value['created_by']] . "</td>" .
					"<td>" . $value['created_date'] . "</td>" .
					"</tr>";
			}
		} else {
			$table .=	"<tr>" .
				"<td colspan='6'>No Data</td>" .
				"</tr>";
		}
		$table .=		"</tbody>" .
			"</table>";
		echo $table;
	}

	public function check_joint()
	{
		error_reporting(0);

		$datadb = $this->general_mod->type_of_module();
		foreach ($datadb as $key => $value) {
			$type_of_module[$value['id']] = $value['name'];
		}

		$datadb = $this->general_mod->discipline();
		foreach ($datadb as $key => $value) {
			$discipline[$value['id']] = $value['discipline_name'];
		}

		$datadb = $this->general_mod->module();
		foreach ($datadb as $key => $value) {
			$module[$value['mod_id']] = $value['mod_desc'];
		}

		$datadb = $this->general_mod->deck_elevation();
		foreach ($datadb as $key => $value) {
			$deck[$value['id']] = $value['name'];
		}

		$datadb = $this->visual_mod->master_area();
		foreach ($datadb as $key => $value) {
			$area[$value['id']] = $value['area_name'];
		}

		$where['drawing_no'] 		= $_POST['drawing_no'];
		if ($_POST['drawing_wm'] > 0) {
			$where['drawing_wm'] 		= $_POST['drawing_wm'];
		}
		$where['discipline'] 		= $_POST['discipline'];
		$where['module'] 			= $_POST['modules'];
		$where['type_of_module'] 	= $_POST['type_of_module'];
		$where['joint_no'] 			= $_POST['joint_no'];
		$where['project'] 			= $_POST['project'];
		$list = $this->engineering_mod->joint_list($where)[0];
		unset($where);

		$project_enc = strtr($this->encryption->encrypt($list['project_code']), '+=/', '.-~');
		$discipline_enc = strtr($this->encryption->encrypt($list['discipline']), '+=/', '.-~');
		$type_of_module_enc = strtr($this->encryption->encrypt($list['type_of_module']), '+=/', '.-~');
		$module_enc = strtr($this->encryption->encrypt($list['module']), '+=/', '.-~');

		$where['id_joint'] = $list['id'];
		$fitup = $this->visual_mod->fitup_list($where);
		unset($where);

		$where['id_joint'] = $list['id'];
		$visual = $this->visual_mod->vt_list($where);
		unset($where);

		$where['a.id'] = $list['workpack_id'];
		$where['id_template'] = $list['id'];
		$workpack = $this->planning_mod->workpack_list_complete($where)[0];
		unset($where);

		$link_tmp = base_url('engineering/joint_list/') . '?project=' . $list['project_code'] . '&discipline=' . $list['discipline'] . '&drawing_no=' . $list['drawing_no'] . '&drawing_type=' . $list['drawing_type'] . '&type_of_module=' . $list['type_of_module'] . '&deck_elevation=' . $list['deck_elevation'] . '&module=' . $list['module'] . '&description_assy=' . $list['description_assy'] . '&drawing_wm=' . $list['drawing_wm'] . '&status=submitted&submit=search';

		$main = "
  		  <div class='row'>
		    <div class='col'>
		      <div class='card shadow my-3 rounded-0'>
		        <div class='card-header'>
		          <h6 class='m-0'><strong><center>Joint : <a href='" . $link_tmp . "' target='_blank'>" . $list['joint_no'] . "</a></center></strong></h6>
		        </div>
		        <div class='card-body bg-white overflow-auto'>  
		                                         
		            <div class='row'>

		              <div class='col-6'>
		                <div class='form-group row'>
		                  <label class='col-md-4 col-lg-3 col-form-label '>Drawing No.</label>
		                  <div class='col-xl'>
		                   <input type='text' class='form-control' value='" . $list['drawing_no'] . "' readonly>
		                  </div>
		                </div>
		              </div>

		              <div class='col-6'>
		                <div class='form-group row'>
		                  <label class='col-md-4 col-lg-3 col-form-label '>Drawing WM.</label>
		                  <div class='col-xl'>
		                   <input type='text' class='form-control' value='" . $list['drawing_wm'] . "' readonly>
		                  </div>
		                </div>
		              </div>

		              <div class='col-6'>
		                <div class='form-group row'>
		                  <label class='col-md-4 col-lg-3 col-form-label '>Discipline</label>
		                  <div class='col-xl'>
		                   <input type='text' class='form-control' value='" . $discipline[$list['discipline']] . "' readonly>
		                  </div>
		                </div>
		              </div>

		              <div class='col-6'>
		                <div class='form-group row'>
		                  <label class='col-md-4 col-lg-3 col-form-label '>Module Type</label>
		                  <div class='col-xl'>
		                   <input type='text' class='form-control' value='" . $type_of_module[$list['type_of_module']] . "' readonly>
		                  </div>
		                </div>
		              </div>

		              <div class='col-6'>
		                <div class='form-group row'>
		                  <label class='col-md-4 col-lg-3 col-form-label '>Module</label>
		                  <div class='col-xl'>
		                   <input type='text' class='form-control' value='" . $module[$list['module']] . "' readonly>
		                  </div>
		                </div>
		              </div>

		              <div class='col-6'>
		                <div class='form-group row'>
		                  <label class='col-md-4 col-lg-3 col-form-label '>Deck Elevation / Service Line</label>
		                  <div class='col-xl'>
		                   <input type='text' class='form-control' value='" . $deck[$list['deck_elevation']] . "' readonly>
		                  </div>
		                </div>
		              </div>

		            </div>            
		        <div class='fl-scrolls fl-scrolls-hidden' data-orientation='horizontal' style='width: 899px; left: 21px;'><div style='width: 899px;'>
		        </div>
		        </div>
		        </div>
		      </div>
		    </div>
		  </div>
	  		";

		echo $main;

		$detail = "

	  		<style>
		  		.nav-pills .nav-link.active, .nav-pills .show > .nav-link {
				    color: #fff;
				    background-color: #008060;
				}
				.nav-link {
					color: #008060;
				}
	  		</style>

	  		<div>
		  		<ul class='nav nav-tabs nav-pills nav-justified' id='myTab' role='tablist'>
				  <li class='nav-item'>
				    <a class='nav-link active' id='workpack-tab' data-toggle='tab' href='#workpack' role='tab' aria-controls='workpack' aria-selected='false'>Workpack</a>
				  </li>
				  <li class='nav-item'>
				    <a class='nav-link' id='fitup-tab' data-toggle='tab' href='#fitup' role='tab' aria-controls='fitup' aria-selected='false'>Fit-Up Inspection</a>
				  </li>
				  <li class='nav-item'>
				    <a class='nav-link' id='visual-tab' data-toggle='tab' href='#visual' role='tab' aria-controls='visual' aria-selected='false'>Visual Testing Inspection</a>
				  </li>
				  <li class='nav-item'>
				    <a class='nav-link' id='ndt-tab' data-toggle='tab' href='#ndt' role='tab' aria-controls='ndt' aria-selected='false'>NDT Progress</a>
				  </li>
				</ul>
				<div class='tab-content' id='myTabContent'>
				  <div class='card shadow my-3 rounded-0 tab-pane fade show active' id='workpack' role='tabpanel' aria-labelledby='workpack-tab'>
			
	  		";

		$link_wp = base_url('planning/workpack_detail/') . strtr($this->encryption->encrypt($list['workpack_id']), '+=/', '.-~');
		if ($workpack) {
			$detail .= "
					<div class='card-header'>
			          <h6 class='m-0'>Workpack</h6>
			        </div>
			        <div class='card-body bg-white overflow-auto'>
						<table width='100%'>	
							<tr>
								<td style='width:150px !important'>Drawing No</td>
								<td style='width:15px !important'>:</td>
								<td>" . $list['drawing_no'] . "</td>
							</tr>
							<tr>
								<td style='width:150px !important'>Weld Map</td>
								<td style='width:15px !important'>:</td>
								<td>" . $list['drawing_wm'] . "</td>
							</tr>
							<tr>
								<td style='width:150px !important'>Joint No.</td>
								<td style='width:15px !important'>:</td>
								<td>" . $list['joint_no'] . "</td>
							</tr>
							<tr>
								<td style='width:150px !important'>Discipline Name</td>
								<td style='width:15px !important'>:</td>
								<td>" . $discipline[$list['discipline']] . "</td>
							</tr>
							<tr>
								<td style='width:150px !important'>Module Name</td>
								<td style='width:15px !important'>:</td>
								<td>" . $module[$list['module']] . "</td>
							</tr>

							<tr>
								<td style='width:150px !important'>Workpack No</td>
								<td style='width:15px !important'>:</td>
								<td><a href=" . $link_wp . "><b><u>" . $workpack['workpack_no'] . "</a></b></u></td>
							</tr>
							<tr>
								<td style='width:150px !important'>Phase</td>
								<td style='width:15px !important'>:</td>
								<td>" . $workpack['phase'] . "</td>
							</tr>
							<tr>
								<td style='width:150px !important'>Plan Start</td>
								<td style='width:15px !important'>:</td>
								<td>" . $workpack['plan_start_date'] . "</td>
							</tr>
							<tr>
								<td style='width:150px !important'>Plan Finish</td>
								<td style='width:15px !important'>:</td>
								<td>" . $workpack['plan_finish_date'] . "</td>
							</tr>
							<tr>
								<td style='width:150px !important'>Progress Fitup</td>
								<td style='width:15px !important'>:</td>
								<td>" . $workpack['progress_fu'] . " %</td>
							</tr>
							<tr>
								<td style='width:150px !important'>Progress Visual</td>
								<td style='width:15px !important'>:</td>
								<td>" . $workpack['progress_vt'] . " %</td>
							</tr>
						</table>
				</div></div>";
		}

		$detail .= "
			<div class='card shadow my-3 rounded-0 tab-pane fade' id='fitup' role='tabpanel' aria-labelledby='fitup-tab'>
				<div class='card-header'>
					<h6 class='m-0'>Fit-Up</h6>
				</div>
				<div class='card-body bg-white overflow-auto'>
		";
		foreach ($fitup as $key => $value) {
			$report_number_fi_enc = strtr($this->encryption->encrypt($value['report_number']), '+=/', '.-~');
			$link_fi = base_url('fitup/joint_inspection_list/') . strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~');
			$link_fi_client = base_url('fitup/client_inspection/') . $project_enc . '/' . $discipline_enc . '/' . $module_enc . '/' . $type_of_module_enc . '/' . $report_number_fi_enc;

			$status_submission_fitup = 'N/A';
			$status_report_fitup = 'N/A';

			if ($value['status_inspection'] == 0) {
				$status_submission_fitup = "<span class='btn btn-primary'>Production RFI</span>";
			} elseif ($value['status_inspection'] == 1) {
				$status_submission_fitup = "<span class='btn btn-warning'>Inspection RFI - Pending Approval</span>";
			} elseif ($value['status_inspection'] == 2) {
				$status_submission_fitup = "<span class='btn btn-danger'>Inspection RFI - Rejected</span>";
			} elseif ($value['status_inspection'] == 4) {
				$status_submission_fitup = "<span class='btn btn-primary'>Inspection RFI - Pending by QC</span>";
			} elseif ($value['status_inspection'] >= 3) {
				$status_submission_fitup = "<span class='btn btn-success'>Inspection RFI - Approved</span>";
			}

			if ($value['status_inspection'] == 5) {
				$status_report_fitup = "<span class='btn btn-warning'>Client RFI - Pending Approval</span>";
			} elseif ($value['status_inspection'] == 6) {
				$status_report_fitup = "<span class='btn btn-danger'>Client RFI - Rejected</span>";
			} elseif ($value['status_inspection'] == 7) {
				$status_report_fitup = "<span class='btn btn-success'>Client RFI - Accepted</span>";
			} elseif ($value['status_inspection'] == 9) {
				$status_report_fitup = "<span class='btn btn-primary'>Client RFI - Accepted with Comment</span>";
			} elseif ($value['status_inspection'] == 10) {
				$status_report_fitup = "<span class='btn btn-warning'>Client RFI - Postponed</span>";
			} elseif ($value['status_inspection'] == 11) {
				$status_report_fitup = "<span class='btn btn-warning'>Client RFI - Re-Offer</span>";
			}
			$detail .= "<hr>";
			$detail .= "
				<table width='100%'>
					<tr>
						<td style='width:150px !important'>Drawing No</td>
						<td style='width:15px !important'>:</td>
						<td>" . $list['drawing_no'] . "</td>
					</tr>
					<tr>
						<td style='width:150px !important'>Weld Map</td>
						<td style='width:15px !important'>:</td>
						<td>" . $list['drawing_wm'] . "</td>
					</tr>
					<tr>
						<td style='width:150px !important'>Joint No.</td>
						<td style='width:15px !important'>:</td>
						<td>" . $list['joint_no'] . "</td>
					</tr>
					<tr>
						<td style='width:150px !important'>Discipline Name</td>
						<td style='width:15px !important'>:</td>
						<td>" . $discipline[$list['discipline']] . "</td>
					</tr>
					<tr>
						<td style='width:150px !important'>Module Name</td>
						<td style='width:15px !important'>:</td>
						<td>" . $module[$list['module']] . "</td>
					</tr>

					<tr>
						<td style='width:150px !important'>Submission ID</td>
						<td style='width:15px !important'>:</td>
						<td><a href=" . $link_fi . "><b><u>" . $value['submission_id'] . "</a></b></u></td>
					</tr>
					<tr>
						<td style='width:150px !important'>Area</td>
						<td style='width:15px !important'>:</td>
						<td>" . $area[$value['area']] . "</td>
					</tr>
					<tr>
						<td style='width:150px !important'>Status Submission</td>
						<td style='width:15px !important'>:</td>
						<td>" . $status_submission_fitup . "</td>
					</tr>
					<tr>
						<td style='width:150px !important'>Report Number</td>
						<td style='width:15px !important'>:</td>
						<td><a href=" . $link_fi_client . "><b><u>" . $value['report_number'] . ' Rev.' . str_pad($value['postpone_reoffer_no'], 2, 0, STR_PAD_LEFT) . "</a></b></u></td>
					</tr>
					<tr>
						<td style='width:150px !important'>Status Report</td>
						<td style='width:15px !important'>:</td>
						<td>" . $status_report_fitup . "</td>
					</tr>
				</table>";
		}
		$detail .= "</div></div>";

		$detail .= "
			<div class='card shadow my-3 rounded-0 tab-pane fade' id='visual' role='tabpanel' aria-labelledby='visual-tab'>
				<div class='card-header'>
					<h6 class='m-0'>Visual Testing</h6>
				</div>
				<div class='card-body bg-white overflow-auto'>
		";

		foreach ($visual as $key => $value) {
			$id_visual[] = $value['id_visual'];
			$detail .= "<hr>";
			$link_vi = base_url('visual/detail_inspection/') . $value['submission_id'] . '/dc/' . $value['drawing_no'] . '/' . $value['postpone_reoffer_no'];
			$link_vi_client = base_url('visual/detail_inspection/') . $value['report_number'] . '/client/' . $value['drawing_no'] . '/NULL/' . $value['postpone_reoffer_no'];

			$status_submission_visual = 'N/A';
			$status_report_visual = 'N/A';
			if ($value['status_inspection'] == 0) {
				$status_submission_visual = "<span class='btn btn-primary'>Production RFI</span>";
			} elseif ($value['status_inspection'] == 1) {
				$status_submission_visual = "<span class='btn btn-warning'>Inspection RFI - Pending Approval</span>";
			} elseif ($value['status_inspection'] == 2) {
				$status_submission_visual = "<span class='btn btn-danger'>Inspection RFI - Rejected</span>";
			} elseif ($value['status_inspection'] == 4) {
				$status_submission_visual = "<span class='btn btn-primary'>Inspection RFI - Pending by QC</span>";
			} elseif ($value['status_inspection'] >= 3) {
				$status_submission_visual = "<span class='btn btn-success'>Inspection RFI - Approved</span>";
			}

			if ($value['status_inspection'] == 5) {
				$status_report_visual = "<span class='btn btn-warning'>Client RFI - Pending Approval</span>";
			} elseif ($value['status_inspection'] == 6) {
				$status_report_visual = "<span class='btn btn-danger'>Client RFI - Rejected</span>";
			} elseif ($value['status_inspection'] == 7) {
				$status_report_visual = "<span class='btn btn-success'>Client RFI - Accepted</span>";
			} elseif ($value['status_inspection'] == 9) {
				$status_report_visual = "<span class='btn btn-primary'>Client RFI - Accepted with Comment</span>";
			} elseif ($value['status_inspection'] == 10) {
				$status_report_visual = "<span class='btn btn-warning'>Client RFI - Postponed</span>";
			} elseif ($value['status_inspection'] == 11) {
				$status_report_visual = "<span class='btn btn-warning'>Client RFI - Re-Offer</span>";
			}
			$detail .= "
				<table width='100%'>
					<tr>
						<td style='width:150px !important'>Drawing No</td>
						<td style='width:15px !important'>:</td>
						<td>" . $list['drawing_no'] . "</td>
					</tr>
					<tr>
						<td style='width:150px !important'>Weld Map</td>
						<td style='width:15px !important'>:</td>
						<td>" . $list['drawing_wm'] . "</td>
					</tr>
					<tr>
						<td style='width:150px !important'>Joint No.</td>
						<td style='width:15px !important'>:</td>
						<td>" . $list['joint_no'] . $value['revision_category'] . $value['revision'] . "</td>
					</tr>
					<tr>
						<td style='width:150px !important'>Discipline Name</td>
						<td style='width:15px !important'>:</td>
						<td>" . $discipline[$list['discipline']] . "</td>
					</tr>
					<tr>
						<td style='width:150px !important'>Module Name</td>
						<td style='width:15px !important'>:</td>
						<td>" . $module[$list['module']] . "</td>
					</tr>

					<tr>
						<td style='width:150px !important'>Submission ID</td>
						<td style='width:15px !important'>:</td>
						<td><a href=" . $link_vi . "><b><u>" . $value['submission_id'] . "</a></b></u></td>
					</tr>
					<tr>
						<td style='width:150px !important'>Area</td>
						<td style='width:15px !important'>:</td>
						<td>" . $area[$value['area']] . "</td>
					</tr>
					<tr>
						<td style='width:150px !important'>Status Submission</td>
						<td style='width:15px !important'>:</td>
						<td>" . $status_submission_visual . "</td>
					</tr>
					<tr>
						<td style='width:150px !important'>Report Number</td>
						<td style='width:15px !important'>:</td>
						<td><a href=" . $link_vi_client . "><b><u>" . $value['report_number'] . ' Rev.' . str_pad($value['postpone_reoffer_no'], 2, 0, STR_PAD_LEFT) . "</a></b></u></td>
					</tr>
					<tr>
						<td style='width:150px !important'>Status Report</td>
						<td style='width:15px !important'>:</td>
						<td>" . $status_report_visual . "</td>
					</tr>
				</table>
				";
		}

		$detail .= "</div></div>";

		$detail .= "
			<div class='card shadow my-3 rounded-0 tab-pane fade' id='ndt' role='tabpanel' aria-labelledby='ndt-tab'>
				<div class='card-header'>
					<h6 class='m-0'>NDT Progress</h6>
				</div>
				<div class='card-body bg-white overflow-auto'>
		";
		if ($id_visual) {
			$where['a.id_visual IN (' . implode(', ', $id_visual) . ')'] = NULL;
			$ndt = $this->ndt_mod->ndt_list_general($where);
			unset($where);

			$ndetes = $this->ndt_mod->master_ndt();
			foreach ($ndetes as $keys => $value_ndts) {
				$master_ndt[$value_ndts['id']] = $value_ndts;
			}

			foreach ($ndt as $key => $value) {
				// test_var($value);
				$result_ndt = NULL;
				if ($value['result'] == 2) {
					$result_ndt = "<span class='btn btn-danger'>Rejected</span>";
				} elseif ($value['result'] == 3) {
					$result_ndt = "<span class='btn btn-success'>Approved</span>";
				}
				$link_ndt = base_url('ndt/ndt_detail/') . $master_ndt[$value['ndt_type']]['ndt_initial'] . '/' . $list['drawing_no'] . '/' . $value['report_number'] . '/' . $value['submission_id'];

				$detail .= "<hr>";
				$detail .= "
				<table width='100%'>
					<tr>
						<td style='width:150px !important'>NDT Type</td>
						<td style='width:15px !important'>:</td>
						<td>" . $master_ndt[$value['ndt_type']]['ndt_description'] . "</td>
					</tr>
					<tr>
						<td style='width:150px !important'>Drawing No</td>
						<td style='width:15px !important'>:</td>
						<td>" . $list['drawing_no'] . "</td>
					</tr>
					<tr>
						<td style='width:150px !important'>Weld Map</td>
						<td style='width:15px !important'>:</td>
						<td>" . $list['drawing_wm'] . "</td>
					</tr>
					<tr>
						<td style='width:150px !important'>Joint No.</td>
						<td style='width:15px !important'>:</td>
						<td>" . $list['joint_no'] . $value['revision_category'] . $value['revision'] . "</td>
					</tr>
					<tr>
						<td style='width:150px !important'>Discipline Name</td>
						<td style='width:15px !important'>:</td>
						<td>" . $discipline[$list['discipline']] . "</td>
					</tr>
					<tr>
						<td style='width:150px !important'>Module Name</td>
						<td style='width:15px !important'>:</td>
						<td>" . $module[$list['module']] . "</td>
					</tr>
					<tr>
						<td style='width:150px !important'>Report Number</td>
						<td style='width:15px !important'>:</td>
						<td><a href=" . $link_ndt . "><b><u>" . $value['report_number'] . "</a></b></u></td>
					</tr>
					<tr> 
						<td style='width:150px !important'>Status Inspection</td>
						<td style='width:15px !important'>:</td>
						<td>" . $result_ndt . "</td>
					</tr>
				</table>
				";
			}
		}

		$detail .= "</div><hr>";
		$detail .= "</div></div>";
		echo $detail;
	}


	public function test_query()
	{
		$datadb = $this->general_mod->manual_query_db("SELECT * FROM pcms_material where id_piecemark IN (select id from pcms_piecemark where part_id = 'SP-D1-P-PLT-0068-01') ORDER BY id_material DESC");
	}

	public function status_drawing_list()
	{
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

		$datadb = $this->general_mod->company();
		$company_list = [];
		foreach ($datadb as $key => $value) {
			$company_list[$value['id_company']] = $value;
		}
		$data['company_list'] = $company_list;

		$data['meta_title']   = 'Status Drawing List';
		$data['subview']      = 'engineering/status_drawing_list';
		$data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
	}

	public function status_drawing_list_datatable()
	{
		$post   = $this->input->post();
		// test_var($post);
		$status_drawing_list = [];

		if (!$this->input->post('project') || !$this->input->post('submit')) {
			$post["submit"] = "search";
		}

		// test_var($post);
		if (isset($post["submit"])) {
			$where = [
				"project_id IN (" . join(", ", $this->user_cookie[13]) . ")" => NULL,
				"company IN (" . join(", ", $this->user_cookie[14]) . ")" => NULL,
			];
			if ($this->input->post('project')) {
				$where['project_id'] = $post['project'];
			}
			if ($this->input->post('company_id')) {
				$where['company'] = $post['company_id'];
			}
			if ($this->input->post('discipline')) {
				$where['discipline'] = $post['discipline'];
			}
			if ($this->input->post('module')) {
				$where['module'] = $post['module'];
			}
			if ($this->input->post('drawing_type')) {
				$where['drawing_type'] = $post['drawing_type'];
			} else {
				$where['drawing_type IN (1, 2, 7, 9, 12, 13, 14)'] = NULL;
			}
			// if($this->input->post('type_of_module')){
			// 	$where['type_of_module'] = $post['type_of_module'];
			// }
			// if($this->input->post('deck_elevation')){
			// 	$where['deck_elevation'] = $post['deck_elevation'];
			// }
			$where['status_delete'] = 1;
			$status_drawing_list = $this->engineering_mod->status_drawing_list_datatable_db("data", $where);
		}

		$datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['id']] = $value;
		}

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['id']] = $value;
		}

		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['mod_id']] = $value;
		}

		// $datadb = $this->general_mod->company();
		// $company_list = [];
		// foreach ($datadb as $key => $value) {
		// 	$company_list[$value['id_company']] = $value;
		// }

		$drawing_ga = [];
		$drawing_as = [];
		$drawing_no_list = [];
		$drawing_iso = [];
		$check_piecemark = [];
		$check_joint = [];
		$rev_list = [];
		foreach ($status_drawing_list as $list) {
			if ($list['drawing_type'] == 2) {
				$drawing_as[] = $list['document_no'];
			} else {
				$drawing_ga[] = $list['document_no'];
			}
			$drawing_no_list[] = $list['document_no'];
		}

		if (count($drawing_ga) > 0) {
			$datadb = $this->engineering_mod->piecemark_list([
				"drawing_ga IN ('" . join("', '", $drawing_ga) . "')" => NULL,
				"(drawing_as IS NULL OR drawing_as = '')" => NULL,
			]);
			foreach ($datadb as $key => $value) {
				$check_piecemark[$value['drawing_ga']][] = $value;
				$rev_list[] = $value['drawing_ga'];
				$rev_list[] = $value['drawing_as'];
				$rev_list[] = $value['drawing_sp'];
				$rev_list[] = $value['drawing_cp'];
				$rev_list[] = $value['drawing_cl'];
			}

			$datadb = $this->engineering_mod->joint_list([
				"drawing_no IN ('" . join("', '", $drawing_ga) . "')" => NULL,
				// "drawing_type" => 1,
				"status_delete" => 1,
			]);
			foreach ($datadb as $key => $value) {
				$check_joint[$value['drawing_no']][] = $value;
				$rev_list[] = $value['drawing_no'];
				$rev_list[] = $value['drawing_wm'];
			}
		}
		if (count($drawing_as) > 0) {
			$datadb = $this->engineering_mod->piecemark_list([
				"drawing_as IN ('" . join("', '", $drawing_as) . "')" => NULL,
			]);
			foreach ($datadb as $key => $value) {
				$check_piecemark[$value['drawing_as']][] = $value;
				$rev_list[] = $value['drawing_ga'];
				$rev_list[] = $value['drawing_as'];
				$rev_list[] = $value['drawing_sp'];
				$rev_list[] = $value['drawing_cp'];
				$rev_list[] = $value['drawing_cl'];
			}

			$datadb = $this->engineering_mod->joint_list([
				"drawing_no IN ('" . join("', '", $drawing_as) . "')" => NULL,
				// "drawing_type" => 2,
				"status_delete" => 1,
			]);
			foreach ($datadb as $key => $value) {
				$check_joint[$value['drawing_no']][] = $value;
				$rev_list[] = $value['drawing_no'];
				$rev_list[] = $value['drawing_wm'];
			}
		}
		$rev_list = array_unique($rev_list);
		$rev_list = array_diff($rev_list, [""]);
		@$datadb = $this->engineering_mod->drawing_list(["document_no IN ('" . join("', '", $rev_list) . "')" => NULL]);
		$rev_list = [];
		foreach ($datadb as $key => $value) {
			$rev_list[$value['document_no']] = $value['last_revision_no'];
		}

		$total_piecemark = [];
		$datadb = $this->engineering_mod->piecemark_list([
			"status_delete" => 1,
			"((drawing_ga IN ('" . join("', '", $drawing_no_list) . "') AND (drawing_as IS NULL OR drawing_as = '')) OR drawing_as IN ('" . join("', '", $drawing_no_list) . "'))" => NULL,
		]);
		foreach ($datadb as $key => $value) {
			if ($value['drawing_as'] != '') {
				@$total_piecemark[$value['drawing_as']] += 1;
			} else {
				@$total_piecemark[$value['drawing_ga']] += 1;
			}
		}

		$total_joint = [];
		$datadb = $this->engineering_mod->joint_list([
			"status_delete" => 1,
			"drawing_no IN ('" . join("', '", $drawing_no_list) . "')" => NULL,
		]);
		foreach ($datadb as $key => $value) {
			@$total_joint[$value['drawing_no']] += 1;
		}

		$data 	= [];
		foreach ($status_drawing_list as $list) {
			$row   	= [];

			if ($list['notif_template'] == 1 && $this->permission_cookie[3] == 1 && $this->permission_cookie[9] == 1) {
				$row[] = '<span class="badge badge-danger" style="cursor: pointer" onclick="notif_template_clicked(this, ' . $list['id'] . ')">New</span>';
			} else {
				$row[] = "";
			}
			$row[] = $list['document_no'];
			$row[] = $list['title'];
			$row[] = $list['last_revision_no'];
			$row[] = $project_list[$list['project_id']]['project_name'];
			$row[] = "OCP";
			$row[] = @$discipline_list[$list['discipline']]['discipline_name'];

			if ($list['transmittal_no'] != "") {
				$transmittal_status = '<span class="badge badge-success">Completed</span>';
			} else {
				$transmittal_status = '<span class="badge badge-danger">On-Progress</span>';
			}
			$row[] = $transmittal_status;

			if ($list['temp_piecemark_status'] == 0) {
				if (isset($check_piecemark[$list['document_no']])) {
					$rev_status = 0;
					foreach ($check_piecemark[$list['document_no']] as $value) {
						if ($rev_status == 0) {
							if (@$value['rev_ga'] != @$rev_list[$value['drawing_ga']]) {
								$rev_status = 1;
							}
							if (@$value['rev_as'] != @$rev_list[$value['drawing_as']]) {
								$rev_status = 1;
							}
							if (@$value['rev_sp'] != @$rev_list[$value['drawing_sp']]) {
								$rev_status = 1;
							}
							if (@$value['rev_cp'] != @$rev_list[$value['drawing_cp']]) {
								$rev_status = 1;
							}
							if (@$value['rev_cl'] != @$rev_list[$value['drawing_cl']]) {
								$rev_status = 1;
							}
						}
					}
					if ($rev_status == 1) {
						$temp_piecemark_status	= '<span class="badge badge-warning">Update Revision</span>';
					} else {
						$temp_piecemark_status	= '<span class="badge badge-success">Completed</span>';
					}
				} else {
					$temp_piecemark_status	= '<span class="badge badge-danger">On-Progress</span>';
				}
			} else {
				$temp_piecemark_status	= '<span class="badge badge-secondary">Not Available</span>';
			}
			$row[] = $temp_piecemark_status;

			if ($list['temp_joint_status'] == 0) {
				if (isset($check_joint[$list['document_no']])) {
					$rev_status = 0;
					foreach ($check_joint[$list['document_no']] as $value) {
						if ($rev_status == 0) {
							if (@$value['rev_no'] != @$rev_list[$value['drawing_no']]) {
								$rev_status = 1;
							}
							if (@$value['rev_wm'] != @$rev_list[$value['drawing_wm']]) {
								$rev_status = 1;
							}
						}
					}
					if ($rev_status == 1) {
						$temp_joint_status	= '<span class="badge badge-warning">Update Revision</span>';
					} else {
						$temp_joint_status	= '<span class="badge badge-success">Completed</span>';
					}
				} else {
					$temp_joint_status	= '<span class="badge badge-danger">On-Progress</span>';
				}
			} else {
				$temp_joint_status	= '<span class="badge badge-secondary">Not Available</span>';
			}
			$row[] = $temp_joint_status;

			$row[] = (@$total_piecemark[$list['document_no']] + 0) . ($list['total_piecemark'] > 0 ? ' of ' . $list['total_piecemark'] : '');
			$row[] = (@$total_joint[$list['document_no']] + 0) . ($list['total_joint'] > 0 ? ' of ' . $list['total_joint'] : '');

			if ($list['drawing_type'] == 2) {
				$link_piecemark = base_url() . "engineering/piecemark_list?status=outstanding&submit=search&drawing_as=" . $list['document_no'] . '&company_id=' . $list['company'];
			} else {
				$link_piecemark = base_url() . "engineering/piecemark_list?status=outstanding&submit=search&drawing_ga=" . $list['document_no'] . '&company_id=' . $list['company'];
			}

			$link_joint = base_url() . "engineering/joint_list?status=outstanding&submit=search&drawing_no=" . $list['document_no'] . '&company_id=' . $list['company'];

			$link_detail = base_url() . "engineering/drawing_detail/" . strtr($this->encryption->encrypt($list['id']), '+=/', '.-~');
			$action_column = "";
			if ($this->permission_cookie[8] == 1) {
				$action_column .= "<a href='$link_piecemark' target='_blank' title='Piecemark' class='btn btn-sm btn-info btn-flat'><b>&nbsp;P&nbsp;</b></a> ";
			}
			if ($this->permission_cookie[2] == 1) {
				$action_column .= "<a href='$link_joint' target='_blank' title='Joint' class='btn btn-sm btn-primary btn-flat'><b>&nbsp;J&nbsp;</b></a> ";
			}
			if ($this->permission_cookie[8] == 1 && $this->permission_cookie[2] == 1) {
				$action_column .= "<a href='$link_detail' target='_blank' title='Detail' class='btn btn-sm btn-dark btn-flat'><i class='fas fa-list'></i></a>";
			}
			$row[] = $action_column;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->engineering_mod->status_drawing_list_datatable_db('count_all', $where),
			"recordsFiltered" => $this->engineering_mod->status_drawing_list_datatable_db('count_filter', $where),
			"data" => $data
		);
		echo json_encode($output);
	}

	public function notif_template_clicked()
	{
		$post = $this->input->post();
		$form_data = [
			'notif_template' 				=> 0,
		];
		$this->engineering_mod->eng_drawing_update_process_db($form_data, ['id' => $post['id_activity']]);
	}

	public function drawing_detail($id)
	{
		$id = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
		$rev_list = $this->engineering_mod->drawing_register([
			"id_activity" => $id,
			"status_delete" => 1,
		]);

		$drawing_list = $this->engineering_mod->eng_drawing_list([
			"id" => $id,
			"status_delete" => 1,
		]);
		$drawing_list = $drawing_list[0];

		$piecemark = $this->engineering_mod->piecemark_list([
			"status_delete" => 1,
			"((drawing_ga = '" . $drawing_list['document_no'] . "' AND (drawing_as IS NULL OR drawing_as = '')) OR drawing_as = '" . $drawing_list['document_no'] . "')" => NULL,
		]);
		$data['total_piecemark'] = count($piecemark);

		$joint = $this->engineering_mod->joint_list([
			"status_delete" => 1,
			"drawing_no" => $drawing_list['document_no'],
		]);
		$data['total_joint'] = count($joint);

		$datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['id']] = $value;
		}
		$data['project_list'] = $project_list;

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['id']] = $value;
		}
		$data['discipline_list'] = $discipline_list;

		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['mod_id']] = $value;
		}
		$data['module_list'] = $module_list;

		$data['rev_list']   				= $rev_list;
		$data['drawing'] 						= $drawing_list;
		$data['meta_title']   			= 'Drawing ' . $drawing_list['document_no'];
		$data['subview']      			= 'engineering/drawing_detail';
		$data['sidebar']      			= $this->sidebar;
		$this->load->view('index', $data);
	}

	public function update_total_template_drawing_process()
	{
		$post = $this->input->post();

		$form_data = [
			"total_piecemark" => $post['total_piecemark'],
			"total_joint" => $post['total_joint'],
		];
		$this->engineering_mod->eng_drawing_update_process_db($form_data, ['id' => $post['id']]);

		$this->session->set_flashdata('success', 'Your data has been Updated!');
		redirect($_SERVER["HTTP_REFERER"]);
	}

	public function drawing_detail_process()
	{
		$form_data = [
			"temp_piecemark_status" => ($this->input->post('temp_piecemark_status') ? '1' : ''),
			"temp_joint_status" => ($this->input->post('temp_joint_status') ? '1' : ''),
		];
		$this->engineering_mod->eng_drawing_update_process_db($form_data, ['id' => $this->input->post('id')]);

		$this->session->set_flashdata('success', 'Your data has been Updated!');
		redirect($_SERVER["HTTP_REFERER"]);
	}

	public function drawing_list_excel_process()
	{
		$post = $this->input->post();
		if (isset($post["submit"])) {
			$where = [
				"project_id" => $post['project'],
			];
			if ($this->input->post('discipline')) {
				$where['discipline'] = $post['discipline'];
			}
			if ($this->input->post('module')) {
				$where['module'] = $post['module'];
			}
			if ($this->input->post('drawing_type')) {
				$where['drawing_type'] = $post['drawing_type'];
			} else {
				$where['drawing_type IN (1, 2, 7, 13)'] = NULL;
			}
			// if($this->input->post('type_of_module')){
			// 	$where['type_of_module'] = $post['type_of_module'];
			// }
			// if($this->input->post('deck_elevation')){
			// 	$where['deck_elevation'] = $post['deck_elevation'];
			// }
			$where['status_delete'] = 1;
			$status_drawing_list = $this->engineering_mod->eng_drawing_list($where);
		}
		$datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['id']] = $value;
		}

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['id']] = $value;
		}

		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['mod_id']] = $value;
		}

		$check_piecemark = [];
		$check_joint = [];
		$rev_list = [];

		$where = [
			"status_delete" => 1,
			"project" => $post['project'],
		];
		if ($this->input->post('discipline')) {
			$where['discipline'] = $post['discipline'];
		}
		if ($this->input->post('module')) {
			$where['module'] = $post['module'];
		}
		$where['status_delete'] = 1;
		$datadb = $this->engineering_mod->piecemark_list($where);
		foreach ($datadb as $key => $value) {
			if ($value['drawing_as'] == '') {
				$check_piecemark[$value['drawing_ga']][] = $value;
			} else {
				$check_piecemark[$value['drawing_as']][] = $value;
			}
			$rev_list[] = $value['drawing_ga'];
			$rev_list[] = $value['drawing_as'];
			$rev_list[] = $value['drawing_sp'];
			$rev_list[] = $value['drawing_cp'];
			$rev_list[] = $value['drawing_cl'];
		}
		$datadb = $this->engineering_mod->joint_list($where);
		foreach ($datadb as $key => $value) {
			$check_joint[$value['drawing_no']][] = $value;
			$rev_list[] = $value['drawing_no'];
			$rev_list[] = $value['drawing_wm'];
		}
		$rev_list = array_unique($rev_list);
		$rev_list = array_diff($rev_list, [""]);
		$datadb = $this->engineering_mod->drawing_list([
			"status_delete" => 1,
			"project_id" => $post['project'],
		]);
		$drawing_rev_list = $rev_list;
		$rev_list = [];
		foreach ($datadb as $key => $value) {
			if (in_array($value['document_no'], $drawing_rev_list)) {
				$rev_list[$value['document_no']] = $value['last_revision_no'];
			}
		}

		$data_excel 	= [];
		foreach ($status_drawing_list as $list) {
			$row   	= [];

			$row[] = $list['document_no'];
			$row[] = $list['title'];
			$row[] = $list['last_revision_no'];
			$row[] = $project_list[$list['project_id']]['project_name'];
			$row[] = "OCP";
			$row[] = $discipline_list[$list['discipline']]['discipline_name'];

			if ($list['transmittal_no'] != "") {
				$transmittal_status = '<span class="badge badge-success">Completed</span>';
			} else {
				$transmittal_status = '<span class="badge badge-danger">On-Progress</span>';
			}
			$row[] = $transmittal_status;

			if ($list['temp_piecemark_status'] == 0) {
				if (isset($check_piecemark[$list['document_no']])) {
					$rev_status = 0;
					foreach ($check_piecemark[$list['document_no']] as $value) {
						if ($rev_status == 0) {
							if (@$value['rev_ga'] != @$rev_list[$value['drawing_ga']]) {
								$rev_status = 1;
							}
							if (@$value['rev_as'] != @$rev_list[$value['drawing_as']]) {
								$rev_status = 1;
							}
							if (@$value['rev_sp'] != @$rev_list[$value['drawing_sp']]) {
								$rev_status = 1;
							}
							if (@$value['rev_cp'] != @$rev_list[$value['drawing_cp']]) {
								$rev_status = 1;
							}
							if (@$value['rev_cl'] != @$rev_list[$value['drawing_cl']]) {
								$rev_status = 1;
							}
						}
					}
					if ($rev_status == 1) {
						$temp_piecemark_status	= '<span class="badge badge-warning">Update Revision</span>';
					} else {
						$temp_piecemark_status	= '<span class="badge badge-success">Completed</span>';
					}
				} else {
					$temp_piecemark_status	= '<span class="badge badge-danger">On-Progress</span>';
				}
			} else {
				$temp_piecemark_status	= '<span class="badge badge-secondary">Not Available</span>';
			}
			$row[] = $temp_piecemark_status;

			if ($list['temp_joint_status'] == 0) {
				if (isset($check_joint[$list['document_no']])) {
					$rev_status = 0;
					foreach ($check_joint[$list['document_no']] as $value) {
						if ($rev_status == 0) {
							if (@$value['rev_no'] != @$rev_list[$value['drawing_no']]) {
								$rev_status = 1;
							}
							if (@$value['rev_wm'] != @$rev_list[$value['drawing_wm']]) {
								$rev_status = 1;
							}
						}
					}
					if ($rev_status == 1) {
						$temp_joint_status	= '<span class="badge badge-warning">Update Revision</span>';
					} else {
						$temp_joint_status	= '<span class="badge badge-success">Completed</span>';
					}
				} else {
					$temp_joint_status	= '<span class="badge badge-danger">On-Progress</span>';
				}
			} else {
				$temp_joint_status	= '<span class="badge badge-secondary">Not Available</span>';
			}
			$row[] = $temp_joint_status;

			$data_excel[] = $row;
		}
		$data['data_excel'] = $data_excel;
		$this->load->view('engineering/drawing_list_excel', $data);
	}

	public function autocomplete_joint()
	{
		$get = $this->input->post();

		$where = [
			"joint_no ILIKE '%" . $get['term'] . "%'" => NULL,
			"status_delete" => 1,
		];
		if (@$get['drawing_wm']) {
			$where["drawing_wm"] = $get['drawing_wm'];
		}
		if (@$get['spool_no']) {
			$where["spool_no"] = $get['spool_no'];
		}
		$datadb = $this->engineering_mod->joint_list($where, 10);
		// test_var($datadb);

		$output = [];
		if (count($datadb) > 0) {
			foreach ($datadb as $key => $value) {
				$output[] = $value["joint_no"];
			}
		} else {
			$output[] = "No Data.";
		}
		echo json_encode($output);
	}

	public function request_rename_piecemark_preview()
	{
		$post = $this->input->post();
		$post['id'] = explode(", ", $post['id']);
		if (count($post['id']) < 1 || $post['id'][0] == '') {
			$this->session->set_flashdata('error', 'No data selected!');
			redirect($_SERVER["HTTP_REFERER"]);
			return false;
		} elseif (count($post['id']) > 30) {
			$this->session->set_flashdata('error', 'Max selected item is 30!');
			redirect($_SERVER["HTTP_REFERER"]);
			return false;
		}

		$where = [
			"id IN (" . join(", ", $post['id']) . ")" => NULL,
		];
		$data['piecemark_list'] = $this->engineering_mod->piecemark_list($where);

		$id_piecemark_irn_checked = [];

		$datadb = $this->irn_mod->irn_raw_list([
			"id_piecemark IN (" . join(", ", $post['id']) . ")" => NULL,
			"status_inspection IN (7, 9)" => NULL,
		]);
		foreach ($datadb as $key => $value) {
			$id_piecemark_irn_checked[] = $value['id_piecemark'];
		}
		if (count($id_piecemark_irn_checked) > 0) {
			foreach ($data['piecemark_list'] as $key => $value) {
				if (in_array($value['id'], $id_piecemark_irn_checked)) {
					$this->session->set_flashdata('error', $value['part_id'] . ' Already in IRN and has been checked by client!');
					redirect($_SERVER["HTTP_REFERER"]);
					return false;
				}
			}
		}

		$data['post'] = $post;

		$data['meta_title']   = 'Rename Piecemark';
		$data['subview']      = 'engineering/request_rename_piecemark_preview';
		$data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
	}

	public function request_rename_joint_preview()
	{
		$post = $this->input->post();
		$post['id'] = explode(", ", $post['id']);
		if (count($post['id']) < 1 || $post['id'][0] == '') {
			$this->session->set_flashdata('error', 'No data selected!');
			redirect($_SERVER["HTTP_REFERER"]);
			return false;
		} elseif (count($post['id']) > 30) {
			$this->session->set_flashdata('error', 'Max selected item is 30!');
			redirect($_SERVER["HTTP_REFERER"]);
			return false;
		}

		$where = [
			"id IN (" . join(", ", $post['id']) . ")" => NULL,
		];
		$data['joint_list'] = $this->engineering_mod->joint_list($where);

		$id_joint_irn_checked = [];

		$datadb = $this->irn_mod->irn_raw_list([
			"id_joint IN (" . join(", ", $post['id']) . ")" => NULL,
			"status_inspection IN (7, 9)" => NULL,
		]);
		foreach ($datadb as $key => $value) {
			$id_joint_irn_checked[] = $value['id_joint'];
		}
		if (count($id_joint_irn_checked) > 0) {
			foreach ($data['joint_list'] as $key => $value) {
				if (in_array($value['id'], $id_joint_irn_checked)) {
					$this->session->set_flashdata('error', $value['part_id'] . ' Already in IRN and has been checked by client!');
					redirect($_SERVER["HTTP_REFERER"]);
					return false;
				}
			}
		}

		$data['post'] = $post;

		$data['meta_title']   = 'Rename Joint';
		$data['subview']      = 'engineering/request_rename_joint_preview';
		$data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
	}

	public function request_rename_piecemark_process()
	{
		$post = $this->input->post();
		$drawing_ga = '';
		$where = [
			"id IN (" . join(", ", $post['id']) . ")" => NULL,
		];
		$datadb = $this->engineering_mod->piecemark_list($where);
		foreach ($datadb as $key => $value) {
			$drawing_ga = $value['drawing_ga'];
			if ($value['revise_id'] != '') {
				$this->session->set_flashdata('error', $value['part_id'] . ' is onprogress revision!');
				redirect($_SERVER["HTTP_REFERER"]);
				return false;
			}
		}
		foreach ($post['part_id'] as $key => $value) {
			$where = [
				"part_id" => $value,
				"status_delete" => 1,
			];
			$datadb = $this->engineering_mod->piecemark_list($where);
			if (count($datadb) > 0) {
			} else {
				$form_data = [
					"fabrication_type" 	=> 8,
					"submission_id" 		=> $value . "|" . $post['drawing_sp'][$key],
					"request_by" 				=> $this->user_cookie[0],
					"request_reason" 		=> $post['request_reason'][$key],
					"status_revise" 		=> 1,
					"id_data" 					=> $post['id'][$key],
				];
				$revise_id = $this->engineering_mod->revise_history_new_process_db($form_data);

				$form_data = ["revise_id" => $revise_id];
				$where = ["id" => $post['id'][$key]];
				$this->engineering_mod->piecemark_update_process_db($form_data, $where);
			}
		}

		$this->session->set_flashdata('success', "Your request has been successed!");
		redirect('engineering/piecemark_list?drawing_ga=' . $drawing_ga . '&submit=search');
	}

	public function request_rename_joint_process()
	{
		$post = $this->input->post();
		$drawing_no = '';
		$drawing_wm = '';
		$where = [
			"id IN (" . join(", ", $post['id']) . ")" => NULL,
		];
		$datadb = $this->engineering_mod->joint_list($where);
		foreach ($datadb as $key => $value) {
			$drawing_no = $value['drawing_no'];
			$drawing_wm = $value['drawing_wm'];
			if ($value['revise_id'] != '') {
				$this->session->set_flashdata('error', $value['drawing_wm'] . ' ' . $value['joint_no'] . ' is onprogress revision!');
				redirect($_SERVER["HTTP_REFERER"]);
				return false;
			}
		}
		foreach ($post['joint_no'] as $key => $value) {
			$where = [
				"drawing_wm" => $drawing_wm,
				"joint_no" => $value,
				"status_delete" => 1,
			];
			$datadb = $this->engineering_mod->joint_list($where);
			if (count($datadb) > 0) {
			} else {
				$form_data = [
					"fabrication_type" 	=> 16,
					"submission_id" 		=> $value . "|" . $drawing_wm,
					"request_by" 				=> $this->user_cookie[0],
					"request_reason" 		=> $post['request_reason'][$key],
					"status_revise" 		=> 1,
					"id_data" 					=> $post['id'][$key],
				];
				$revise_id = $this->engineering_mod->revise_history_new_process_db($form_data);

				$form_data = ["revise_id" => $revise_id];
				$where = ["id" => $post['id'][$key]];
				$this->engineering_mod->joint_update_process_db($form_data, $where);
			}
		}

		$this->session->set_flashdata('success', "Your request has been successed!");
		redirect('engineering/joint_list?drawing_no=' . $drawing_no . '&drawing_wm=' . $drawing_wm . '&submit=search');
	}

	public function rename_piecemark_process($revise_id, $action)
	{
		$revise_id = $this->encryption->decrypt(strtr($revise_id, '.-~', '+=/'));
		$action = $this->encryption->decrypt(strtr($action, '.-~', '+=/'));
		$date_now = date("Y-m-d H:i:s");

		$request_list = $this->engineering_mod->revise_history_list([
			"id" => $revise_id,
		]);
		$request_list = $request_list[0];

		$piecemark_old = [];
		$datadb = $this->engineering_mod->piecemark_list([
			"id" => $request_list['id_data']
		]);
		$piecemark_old = $datadb[0];
		foreach ($datadb as $key => $value) {
			$piecemark_old[$value['id']] = $value;
		}

		$data_new = explode("|", $request_list['submission_id']);
		$form_data = [
			"part_id" => $data_new[0],
			"drawing_sp" => @$data_new[1],
			"revise_id" => NULL
		];
		$where = [
			"id" => $request_list['id_data'],
		];
		$this->engineering_mod->piecemark_update_process_db($form_data, $where);

		$history_update[] = [
			"id_template" => $request_list['id_data'],
			"module" => 1,
			"name" => 'Part ID',
			"column_name" => 'part_id',
			"data_before" => $piecemark_old['part_id'],
			"data_after" => $data_new[0],
			"created_by" => $this->user_cookie[0],
			"created_date" => $date_now,
			"id_request_update" => $revise_id,
		];
		if (@$data_new[1] != $piecemark_old['drawing_sp']) {
			$history_update[] = [
				"id_template" => $request_list['id_data'],
				"module" => 1,
				"name" => 'Drawing SP',
				"column_name" => 'drawing_sp',
				"data_before" => $piecemark_old['drawing_sp'],
				"data_after" => @$data_new[1],
				"created_by" => $this->user_cookie[0],
				"created_date" => $date_now,
				"id_request_update" => $revise_id,
			];
		}

		// $mv_list = $this->material_verification_mod->mv_list([
		// 	"id_piecemark" => $request_list['id_data'],
		// 	"status_delete" => 0,
		// ]);
		// $id_material_arr = [];
		// if (count($mv_list) > 0) {
		// 	foreach ($mv_list as $key => $value) {
		// 		if (!in_array($value['status_inspection'], [0, 1, 2, 4, 6]) && !isset($id_material_arr[$value['id_piecemark']])) {
		// 			$id_material_arr[$value['id_piecemark']] = $value['id_material'];
		// 			$status_inspection = $value['status_inspection'];
		// 			if ($status_inspection == 7) {
		// 				$status_inspection = 11;
		// 			}
		// 			$form_data = [
		// 				"status_inspection" => 1,
		// 				"revision_status_inspection" => 1,
		// 				"inspection_client_by" => 999999,
		// 				"inspection_client_datetime" => $date_now,
		// 				"rejected_client_remarks" => $request_list['request_reason'],
		// 			];
		// 			if ($value['revision_status_inspection'] != "1") {
		// 				$form_data["latest_inspection_status"] = $status_inspection;
		// 			}
		// 			$this->material_verification_mod->mv_update_process_db($form_data, [
		// 				"id_material" => $value['id_material']
		// 			]);

		// 			if ($value['report_number'] != '' && $value['status_inspection'] == 7) {
		// 				$mv_all_list = $this->material_verification_mod->mv_list([
		// 					"project_code" => $value['project_code'],
		// 					"report_number" => $value['report_number'],
		// 					"discipline" => $value['discipline'],
		// 					"report_no_rev" => $value['report_no_rev'],
		// 					"status_delete" => 0,
		// 					"id_piecemark !=" => $request_list['id_data'],
		// 				]);
		// 				if (count($mv_all_list) > 0) {
		// 					$id_material_all_arr = [];
		// 					foreach ($mv_all_list as $key => $mv_all) {
		// 						if ($mv_all['status_inspection'] == 7 && !isset($id_material_all_arr[$mv_all['id_piecemark']])) {
		// 							$id_material_all_arr[$mv_all['id_piecemark']] = $mv_all['id_material'];
		// 							$this->material_verification_mod->mv_update_process_db([
		// 								"status_inspection" => 11,
		// 								"inspection_client_by" => 999999,
		// 								"inspection_client_datetime" => $date_now,
		// 								"rejected_client_remarks" => $request_list['request_reason'],
		// 								"revision_status_inspection" => 0,
		// 							], [
		// 								"id_material" => $mv_all['id_material']
		// 							]);
		// 						}
		// 					}
		// 				}
		// 			}
		// 		}
		// 	}
		// }

		$datadb = $this->engineering_mod->joint_list([
			"(pos_1 = '" . $piecemark_old['part_id'] . "' OR pos_2 = '" . $piecemark_old['part_id'] . "')" => NULL,
			"status_delete" => 1,
		]);
		$id_joint_arr = [];
		$joint_old = [];
		foreach ($datadb as $key => $joint) {
			$id_joint_arr[] = $joint['id'];
			$joint_old[$joint['id']] = $joint;

			if ($joint['pos_1'] == $piecemark_old['part_id']) {
				$column = 'pos_1';
			}
			if ($joint['pos_2'] == $piecemark_old['part_id']) {
				$column = 'pos_2';
			}

			$where = ["id" => $joint['id']];
			$form_data = [$column => $data_new[0]];
			$this->engineering_mod->joint_update_process_db($form_data, $where);

			$name = ucwords(strtr($column, "_", " "));
			$name = explode(" ", $name);
			foreach ($name as $no_word => $word) {
				if (in_array(strtolower($word), ["ga", "as", "sp", "id", "cp", "cl", "wm", "pos", "wps"])) {
					$name[$no_word] = strtoupper($word);
				}
			}

			$name = join(" ", $name);
			$history_update[] = [
				"id_template" => $joint['id'],
				"module" => 2,
				"name" => $name,
				"column_name" => $column,
				"data_before" => $joint_old[$joint['id']][$column],
				"data_after" => $data_new[0],
				"created_by" => $this->user_cookie[0],
				"created_date" => $date_now,
				"id_request_update" => $revise_id,
			];
		}
		// if (count($id_joint_arr) > 0) {
		// 	$datadb = $this->fitup_mod->fu_list([
		// 		"id_joint IN (" . join(", ", $id_joint_arr) . ")" => NULL,
		// 		"status_delete" => NULL,
		// 	]);
		// 	$id_fitup_arr = [];
		// 	if (count($datadb) > 0) {
		// 		foreach ($datadb as $key => $fitup) {
		// 			if (!in_array($fitup['status_inspection'], [0, 1, 2, 4, 6]) && !isset($id_fitup_arr[$fitup['id_joint']])) {
		// 				$id_fitup_arr[$fitup['id_joint']] = $fitup['id_fitup'];
		// 				$status_inspection = $fitup['status_inspection'];
		// 				if ($status_inspection == 7) {
		// 					$status_inspection = 11;
		// 				}
		// 				$form_data = [
		// 					"status_inspection" => 1,
		// 					"revision_status_inspection" => 1,
		// 					"client_inspection_by" => 999999,
		// 					"client_inspection_date" => $date_now,
		// 					"reoffer_remarks" => $request_list['request_reason'],
		// 				];
		// 				if ($fitup['revision_status_inspection'] != 1) {
		// 					$form_data["latest_inspection_status"] = $status_inspection;
		// 				}
		// 				$this->fitup_mod->fu_update_process_db($form_data, [
		// 					"id_fitup" => $fitup['id_fitup']
		// 				]);

		// 				if ($fitup['report_number'] != '' && $fitup['status_inspection'] == 7) {
		// 					$fu_all_list = $this->fitup_mod->fu_list([
		// 						"project_code" => $fitup['project_code'],
		// 						"report_number" => $fitup['report_number'],
		// 						"discipline" => $fitup['discipline'],
		// 						"postpone_reoffer_no" => $fitup['postpone_reoffer_no'],
		// 						"status_delete" => NULL,
		// 						"id_joint !=" => $fitup['id_joint'],
		// 					]);
		// 					if (count($fu_all_list) > 0) {
		// 						$id_fitup_all_arr = [];
		// 						foreach ($fu_all_list as $key => $fu_all) {
		// 							if ($fu_all['status_inspection'] == 7 && !isset($id_fitup_all_arr[$fu_all['id_joint']])) {
		// 								$id_fitup_all_arr[$fu_all['id_joint']] = $fu_all['id_fitup'];
		// 								$this->fitup_mod->fu_update_process_db([
		// 									"status_inspection" => 11,
		// 									"client_inspection_by" => 999999,
		// 									"client_inspection_date" => $date_now,
		// 									"reoffer_remarks" => $request_list['request_reason'],
		// 									"revision_status_inspection" => 0,
		// 								], [
		// 									"id_fitup" => $fu_all['id_fitup']
		// 								]);
		// 							}
		// 						}
		// 					}
		// 				}
		// 			}
		// 		}
		// 	}
		// }

		$this->engineering_mod->revision_log_import_process_db($history_update);

		$form_data = [
			"approve_by" 	=> $this->user_cookie[0],
			"approve_date" 	=> date("Y-m-d H:i:s"),
			"status_revise" 	=> 4,
		];
		$where = [
			"id" 	=> $revise_id,
		];
		$this->engineering_mod->revise_history_update_process_db($form_data, $where);

		$this->session->set_flashdata('success', "Your request has been Approved!");
		redirect($_SERVER["HTTP_REFERER"]);
	}

	public function rename_joint_process($revise_id, $action)
	{
		$revise_id = $this->encryption->decrypt(strtr($revise_id, '.-~', '+=/'));
		$action = $this->encryption->decrypt(strtr($action, '.-~', '+=/'));
		$date_now = date("Y-m-d H:i:s");

		$request_list = $this->engineering_mod->revise_history_list([
			"id" => $revise_id,
		]);
		$request_list = $request_list[0];

		$joint_old = [];
		$datadb = $this->engineering_mod->joint_list([
			"id" => $request_list['id_data']
		]);
		$joint_old = $datadb[0];
		foreach ($datadb as $key => $value) {
			$joint_old[$value['id']] = $value;
		}

		$data_new = explode("|", $request_list['submission_id']);
		$form_data = [
			"joint_no" => $data_new[0],
			"revise_id" => NULL
		];
		$where = [
			"id" => $request_list['id_data'],
		];
		$this->engineering_mod->joint_update_process_db($form_data, $where);

		$history_update[] = [
			"id_template" => $request_list['id_data'],
			"module" => 2,
			"name" => 'Joint No',
			"column_name" => 'joint_no',
			"data_before" => $joint_old['joint_no'],
			"data_after" => $data_new[0],
			"created_by" => $this->user_cookie[0],
			"created_date" => $date_now,
			"id_request_update" => $revise_id,
		];
		// if (@$data_new[1] != $joint_old['drawing_sp']) {
		// 	$history_update[] = [
		// 		"id_template" => $request_list['id_data'],
		// 		"module" => 2,
		// 		"name" => 'Drawing SP',
		// 		"column_name" => 'drawing_sp',
		// 		"data_before" => $joint_old['drawing_sp'],
		// 		"data_after" => @$data_new[1],
		// 		"created_by" => $this->user_cookie[0],
		// 		"created_date" => $date_now,
		// 		"id_request_update" => $revise_id,
		// 	];
		// }

		$this->engineering_mod->revision_log_import_process_db($history_update);

		$form_data = [
			"approve_by" 	=> $this->user_cookie[0],
			"approve_date" 	=> date("Y-m-d H:i:s"),
			"status_revise" 	=> 4,
		];
		$where = [
			"id" 	=> $revise_id,
		];
		$this->engineering_mod->revise_history_update_process_db($form_data, $where);

		$this->session->set_flashdata('success', "Your request has been Approved!");
		redirect($_SERVER["HTTP_REFERER"]);
	}

	public function joint_void_process($revise_id)
	{
		$revise_id = $this->encryption->decrypt(strtr($revise_id, '.-~', '+=/'));
		$date_now = date("Y-m-d H:i:s");

		$request_list = $this->engineering_mod->revise_history_list([
			"id" => $revise_id,
		]);
		$request_list = $request_list[0];

		$datadb = $this->engineering_mod->joint_list([
			"id" => $request_list['id_data']
		]);
		$joint_old = $datadb[0];

		$form_data = [
			"status" => 2,
			"status_delete" => 0,
			"revise_id" => NULL
		];
		$where = [
			"id" => $request_list['id_data'],
		];
		$this->engineering_mod->joint_update_process_db($form_data, $where);

		$history_update[] = [
			"id_template" => $request_list['id_data'],
			"module" => 1,
			"name" => 'Status',
			"column_name" => 'status',
			"data_before" => $joint_old['status'],
			"data_after" => 2,
			"created_by" => $request_list['request_by'],
			"created_date" => $date_now,
			"id_request_update" => $revise_id,
		];

		$datadb = $this->planning_mod->workpack_detail_list([
			"id_template" => $joint_old['id'],
			"id_workpack" => $joint_old['workpack_id'],
			"status_delete" => 1,
			"status !=" => 4,
		]);
		if (count($datadb) > 0) {
			foreach ($datadb as $key => $value) {
				$datadb = $this->planning_mod->workpack_detail_update_process_db([
					"status" => 4,
					"remarks" => ($value['remarks'] != '' ? $value['remarks'] . "<br>" : '') . "Void From Tempalte: " . $request_list['request_reason'],
				], [
					"id" => $value['id'],
				]);
			}
		}

		$datadb = $this->fitup_mod->fu_list([
			"id_joint" => $request_list['id_data'],
			"status_delete" => NULL,
		]);
		if (count($datadb) > 0) {
			$fitup = $datadb[0];
			$this->fitup_mod->fu_update_process_db([
				"status_inspection" => 12,
				"void_by" => $request_list['request_by'],
				"void_date" => $request_list['request_date'],
				"void_remarks" => $request_list['request_reason'],
				"latest_inspection_status" => $fitup['status_inspection'],
			], [
				"id_fitup" => $fitup['id_fitup']
			]);

			$history_update[] = [
				"id_template" => $request_list['id_data'],
				"module" => 2,
				"name" => 'Status Inspection Fitup',
				"column_name" => 'status_inspection',
				"data_before" => $fitup['status_inspection'],
				"data_after" => 12,
				"created_by" => $request_list['request_by'],
				"created_date" => $date_now,
				"id_request_update" => $revise_id,
			];

			// if ($fitup['report_number'] != '' && $fitup['status_inspection'] == 7) {
			// 	$fu_all_list = $this->fitup_mod->fu_list([
			// 		"project_code" => $fitup['project_code'],
			// 		"report_number" => $fitup['report_number'],
			// 		"discipline" => $fitup['discipline'],
			// 		"postpone_reoffer_no" => $fitup['postpone_reoffer_no'],
			// 		"status_delete" => NULL,
			// 		"id_joint !=" => $fitup['id_joint'],
			// 	]);
			// 	if (count($fu_all_list) > 0) {
			// 		$id_fitup_all_arr = [];
			// 		foreach ($fu_all_list as $key => $fu_all) {
			// 			if ($fu_all['status_inspection'] == 7 && !isset($id_fitup_all_arr[$fu_all['id_joint']])) {
			// 				$id_fitup_all_arr[$fu_all['id_joint']] = $fu_all['id_fitup'];
			// 				$this->fitup_mod->fu_update_process_db([
			// 					"status_inspection" => 11,
			// 					"client_inspection_by" => 999999,
			// 					"client_inspection_date" => $date_now,
			// 					"reoffer_remarks" => $request_list['request_reason'],
			// 					"revision_status_inspection" => 0,
			// 				], [
			// 					"id_fitup" => $fu_all['id_fitup']
			// 				]);
			// 			}
			// 		}
			// 	}
			// }
		}

		$datadb = $this->visual_mod->vt_list([
			"id_joint" => $request_list['id_data'],
			"status_delete" => NULL,
		]);
		$id_visual_arr = [];
		if (count($datadb) > 0) {
			foreach ($datadb as $key => $visual) {
				if (!isset($id_visual_arr[$visual['id_joint'] . $visual['revision_category'] . $visual['revision']])) {
					$id_visual_arr[$visual['id_joint'] . $visual['revision_category'] . $visual['revision']] = $visual['id_visual'];
					$this->visual_mod->vt_update_process_db([
						"status_inspection" => 12,
						"void_by" => $request_list['request_by'],
						"void_date" => $request_list['request_date'],
						"void_remarks" => $request_list['request_reason'],
						"latest_inspection_status" => $visual['status_inspection'],
					], [
						"id_visual" => $visual['id_visual']
					]);

					if ($visual['revision_category'] . $visual['revision'] == '') {
						$history_update[] = [
							"id_template" => $request_list['id_data'],
							"module" => 2,
							"name" => 'Status Inspection Visual',
							"column_name" => 'status_inspection',
							"data_before" => $visual['status_inspection'],
							"data_after" => 12,
							"created_by" => $request_list['request_by'],
							"created_date" => $date_now,
							"id_request_update" => $revise_id,
						];
					}

					// if ($visual['report_number'] != '' && $visual['status_inspection'] == 7) {
					// 	$vt_all_list = $this->visual_mod->vt_list([
					// 		"project_code" => $visual['project_code'],
					// 		"report_number" => $visual['report_number'],
					// 		"discipline" => $visual['discipline'],
					// 		"postpone_reoffer_no" => $visual['postpone_reoffer_no'],
					// 		"status_delete" => NULL,
					// 		"id_joint !=" => $visual['id_joint'],
					// 	]);
					// 	if (count($vt_all_list) > 0) {
					// 		$id_visual_all_arr = [];
					// 		foreach ($vt_all_list as $key => $vt_all) {
					// 			if ($vt_all['status_inspection'] == 7 && !isset($id_visual_all_arr[$vt_all['id_joint'] . $vt_all['revision_category'] . $vt_all['revision']])) {
					// 				$id_visual_all_arr[$vt_all['id_joint'] . $vt_all['revision_category'] . $vt_all['revision']] = $vt_all['id_visual'];
					// 				$this->visual_mod->vt_update_process_db([
					// 					"status_inspection" => 11,
					// 					"inspection_client_by" => 999999,
					// 					"inspection_client_datetime" => $date_now,
					// 					"client_remarks" => $request_list['request_reason'],
					// 					"revision_status_inspection" => 0,
					// 				], [
					// 					"id_visual" => $vt_all['id_visual']
					// 				]);
					// 			}
					// 		}
					// 	}
					// }
				}
			}
		}

		$this->engineering_mod->revision_log_import_process_db($history_update);

		$form_data = [
			"approve_by" 	=> $this->user_cookie[0],
			"approve_date" 	=> date("Y-m-d H:i:s"),
			"status_revise" 	=> 4,
		];
		$where = [
			"id" 	=> $revise_id,
		];
		$this->engineering_mod->revise_history_update_process_db($form_data, $where);

		$this->session->set_flashdata('success', "Your request has been Approved!");
		redirect($_SERVER["HTTP_REFERER"]);
	}

	public function request_approval_client_process($revise_id)
	{
		$post = $this->input->post();
		$date_now = date("Y-m-d H:i:s");
		$num = 0;

		$request_list = $this->engineering_mod->revise_history_list([
			"id" => $revise_id,
		]);
		$request_list = $request_list[0];

		$id_workpack_arr = [];
		if ($request_list['fabrication_type'] == 14) {
			$column_int = ['diameter', 'thickness', 'thickness', 'length', 'height', 'width', 'weight', 'area'];
			$piecemark_old = [];
			$piecemark_updated = [];

			$datadb = $this->engineering_mod->piecemark_list(["id IN (" . join(", ", $post['id']) . ")" => NULL]);
			foreach ($datadb as $key => $value) {
				$piecemark_old[$value['id']] = $value;
				$id_workpack_arr[$value['id']] = $value['workpack_id'];
			}

			foreach ($post['id'] as $key => $value) {
				foreach ($column_int as $column_no => $column_name) {
					if ($post[$column_name][$key] == '') {
						$post[$column_name][$key] = 0;
					}
				}

				$ref_pos_1 = null;
				if (isset($post['ref_pos_1'][$key]) && count($post['ref_pos_1'][$key]) > 0) {
					$ref_pos_1 = join(", ", $post['ref_pos_1'][$key]);
				}

				$form_data = [
					"rev_ga" 								=> $post['rev_ga'][$key],
					"drawing_as" 						=> $post['drawing_as'][$key],
					"rev_as" 								=> $post['rev_as'][$key],
					"drawing_sp" 						=> $post['drawing_sp'][$key],
					"rev_sp" 								=> $post['rev_sp'][$key],
					// "part_id" 							=> $post['part_id'][$key],
					"ref_pos_1" 						=> $ref_pos_1,

					"drawing_cp" 						=> $post['drawing_cp'][$key],
					"rev_cp" 								=> $post['rev_cp'][$key],
					"drawing_cl" 						=> $post['drawing_cl'][$key],
					"rev_cl" 								=> $post['rev_cl'][$key],
					"profile" 							=> $post['profile'][$key],
					"material" 							=> $post['material'][$key],
					"grade" 								=> $post['grade'][$key],
					"diameter" 							=> $post['diameter'][$key],
					"thickness" 						=> $post['thickness'][$key],
					"sch" 									=> $post['sch'][$key],
					"length" 								=> $post['length'][$key],
					"height" 								=> $post['height'][$key],
					"width" 								=> $post['width'][$key],
					"weight" 								=> $post['weight'][$key],
					"area" 									=> $post['area'][$key],
					"can_number" 						=> $post['can_number'][$key],
					"test_pack_no" 					=> $post['test_pack_no'][$key],
					"remarks" 							=> $post['remarks'][$key],
					"item_code" 						=> $post['item_code'][$key],
					"spool_no" 							=> $post['spool_no'][$key],
					"beam_chnl_thk" 				=> $post['beam_chnl_thk'][$key],
					"strain_age_test_dt" 		=> $post['strain_age_test_dt'][$key],
					"strain_age_test_yn" 		=> $post['strain_age_test_yn'][$key],
					"through_thickness" 		=> $post['through_thickness'][$key],
				];

				$num++;

				foreach ($form_data as $column => $new_data) {
					if ($new_data != $piecemark_old[$post['id'][$key]][$column]) {
						$name = ucwords(strtr($column, "_", " "));
						$name = explode(" ", $name);

						foreach ($name as $no_word => $word) {
							if (in_array(strtolower($word), ["ga", "as", "sp", "id", "cp", "cl", "wm", "pos", "wps"])) {
								$name[$no_word] = strtoupper($word);
							}
						}
						$name = join(" ", $name);
						$piecemark_updated[] = [
							"id_template" => $post['id'][$key],
							"module" => 1,
							"name" => $name,
							"column_name" => $column,
							"data_before" => $piecemark_old[$post['id'][$key]][$column],
							"data_after" => $new_data,
							"created_by" => $this->user_cookie[0],
							"created_date" => $date_now,
							"id_request_update" => $piecemark_old[$post['id'][$key]]['revise_id'],
						];
					}
				}
			}
		} elseif ($request_list['fabrication_type'] == 11) {
			$joint_old = [];
			$joint_updated = [];


			$datadb = $this->engineering_mod->joint_list(["id IN (" . join(", ", $post['id']) . ")" => NULL]);
			foreach ($datadb as $key => $value) {
				$joint_old[$value['id']] = $value;
				$id_workpack_arr[$value['id']] = $value['workpack_id'];
			}

			foreach ($post['id'] as $key => $value) {
				$form_data = [
					"drawing_wm" 				=> $post['drawing_wm'],

					"rev_wm" 				=> $post['rev_wm'][$key],
					"rev_no" 				=> $post['rev_no'][$key],
					"pos_1" 				=> implode(";", $post['pos_1'][$key]),
					"ref_1" 				=> @$post['ref_1'][$key],
					"pos_2" 				=> implode(";", $post['pos_2'][$key]),
					"ref_2" 				=> @$post['ref_2'][$key],
					"weld_type" 			=> $post['weld_type'][$key],
					"thickness" 			=> $post['thickness'][$key],
					"diameter" 				=> $post['diameter'][$key],
					"sch" 					=> $post['sch'][$key],
					"length" 				=> $post['length'][$key],
					"weld_length" 			=> $post['weld_length'][$key],
					"joint_type" 			=> $post['joint_type'][$key],
					"test_pack_no" 			=> $post['test_pack_no'][$key],
					"spool_no" 				=> $post['spool_no'][$key],
					"service_line" 			=> $post['service_line'][$key],
					"pid_drawing" 			=> $post['pid_drawing'][$key],
					"class" 				=> $post['class'][$key],
					"grid_row" 				=> $post['grid_row'][$key],
					"grid_column" 				=> $post['grid_column'][$key],
					"mt_percent_req" 		=> $post['mt_percent_req'][$key],
					"pt_percent_req" 		=> $post['pt_percent_req'][$key],
					"ut_percent_req" 		=> $post['ut_percent_req'][$key],
					"rt_percent_req" 		=> $post['rt_percent_req'][$key],
					"pwht_percent_req" 		=> $post['pwht_percent_req'][$key],
					"remarks" 				=> $post['remarks'][$key],
					"phase" 				=> $post['phase'][$key],
				];


				foreach ($form_data as $column => $new_data) {

					if ($new_data != $joint_old[$post['id'][$key]][$column]) {
						$name = ucwords(strtr($column, "_", " "));
						$name = explode(" ", $name);
						foreach ($name as $no_word => $word) {
							if (in_array(strtolower($word), ["ga", "as", "sp", "id", "cp", "cl", "wm", "pos", "wps"])) {
								$name[$no_word] = strtoupper($word);
							}
						}
						$name = join(" ", $name);
						$joint_updated[] = [
							"id_template" => $post['id'][$key],
							"module" => 2,
							"name" => $name,
							"column_name" => $column,
							"data_before" => $joint_old[$post['id'][$key]][$column],
							"data_after" => $new_data,
							"created_by" => $this->user_cookie[0],
							"created_date" => $date_now,
							"id_request_update" => $joint_old[$post['id'][$key]]['revise_id'],
						];
					}
				}
			}
		}

		$id_template_mail_arr = [];
		if (count($id_workpack_arr) > 0) {
			$datadb = $this->planning_mod->workpack_list([
				"id IN (" . join(", ", array_unique($id_workpack_arr)) . ")" => NULL,
			]);
			foreach ($datadb as $key => $value) {
				$workpack_company[$value['id']] = $value['company_yard'];
			}
			foreach ($id_workpack_arr as $key => $value) {
				if ($workpack_company[$value] == 1) {
					$id_template_mail_arr[] = $key;
				}
			}
		}

		if (@count($piecemark_updated) > 0 || @count($joint_updated) > 0) {
			if (@count($piecemark_updated) > 0) {
				$this->engineering_mod->revision_log_temp_import_process_db($piecemark_updated);
				$data['link_address_smoe'] = base_url() . 'irn/revision_irn_list/14';
				$out_link = getenv('LINK_PCMSV2_OUTSIDE') . "/irn/revision_irn_list/14";
				if (@count($id_template_mail_arr) > 0) {
					$datadb = $this->irn_mod->irn_raw_list([
						"id_piecemark IN (" . join(", ", $id_template_mail_arr) . ")" => NULL,
						"status_inspection IN (7, 9)" => NULL,
					]);
				} else {
					$datadb = [];
				}
			}
			if (@count($joint_updated) > 0) {

				$this->engineering_mod->revision_log_temp_import_process_db($joint_updated);
				$data['link_address_smoe'] = base_url() . 'irn/revision_irn_list/11';
				$out_link = getenv('LINK_PCMSV2_OUTSIDE') . "/irn/revision_irn_list/11";
				if (@count($id_template_mail_arr) > 0) {
					$datadb = $this->engineering_mod->check_irn_template([
						"pi.id_joint IN (" . join(", ", $id_template_mail_arr) . ")" => NULL,
						"pi.category_irn" => 0,
						"(pids.validator_auth = 1 OR pi.status_inspection IN (7, 9))" => NULL,
					]);
				} else {
					$datadb = [];
				}
			}
			$irn_list = [];
			foreach ($datadb as $key => $value) {
				$irn_list[$value['report_number']] = [
					"rfi_no" => $value['report_number'],
					"report_no" => $value['report_number'],
					"project_id" => $value['project_id'],
					"discipline" => $value['discipline'],
					"module" => $value['module'],
					"type_of_module" => $value['type_of_module'],
				];
			}
			foreach ($irn_list as $report_number => $value) {
				$report = $this->general_mod->master_report_number([
					"project" => $value['project_id'],
					"discipline" => $value['discipline'],
					"module" => $value['module'],
					"type_of_module" => $value['type_of_module'],
					"category IN ('irn_rfi')" => NULL,
				]);
				$rfi_no = $report[0]['report_no'] . $report_number;
				$report_no = $report[0]['report_no'] . $report_number;

				if (@$out_link != '') {
					$email_list = $this->general_mod->portal_email_list([
						'process' => 'revision_template_after_irn',
					]);
					$email_list = $email_list[0];

					$data['rfi_no_mail'] = $rfi_no;
					$data['report_no_mail'] = $report_no;
					$date_arr = explode(' ', $date_now);
					$data['date_inspect'] = $date_arr[0];
					$data['time_inspect'] = $date_arr[1];
					$out_link = strtr($this->encryption->encrypt($out_link), '+=/', '.-~');
					$data['link_address_client'] = getenv('LINK_PCMS_PORTAL_OUTSIDE') . "/jump_url/redirect/" . $out_link;;
					$html = $this->load->view('engineering/email_revision_template_client', $data, true);
					$subject = "NOTIFICATION FOR ACTIVITY - " . $rfi_no;

					$email = [
						"to" => explode(', ', $email_list['email_to']),
						"cc" => explode(', ', $email_list['email_cc']),
						"bcc" => explode(', ', $email_list['email_bcc']),
						"subject" => $subject,
						"message" => $html,
					];
					send_email_smtp($email);
				}
			}

			$form_data = [
				"update_by" 	=> $this->user_cookie[0],
				"update_date" 	=> $date_now,
				"status_revise" 	=> 6,
			];
			$where = [
				"id" 	=> $revise_id,
			];
			$this->engineering_mod->revise_history_update_process_db($form_data, $where);

			$this->session->set_flashdata('success', "Your request has been Update!");
			redirect("engineering/revise_history_list?fabrication_type=" . $request_list['fabrication_type'] . "&status_revise=3&submit=search");
		} else {
			$form_data = ["revise_id" => NULL];
			$where = ["revise_id" => $revise_id];
			$this->engineering_mod->piecemark_update_process_db($form_data, $where);
			$this->engineering_mod->joint_update_process_db($form_data, $where);

			$form_data = [
				"update_by" 	=> $this->user_cookie[0],
				"update_date" 	=> date("Y-m-d H:i:s"),
				"status_revise" 	=> 4,
			];
			$where = [
				"id" 	=> $revise_id,
			];
			$this->engineering_mod->revise_history_update_process_db($form_data, $where);

			$this->session->set_flashdata('success', "Your request has been Completed!");
			redirect("engineering/revise_history_list?fabrication_type=" . $request_list['fabrication_type'] . "&status_revise=3&submit=search");
		}
	}

	public function revision_approval_client_process($id, $action)
	{
		$id = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
		$action = $this->encryption->decrypt(strtr($action, '.-~', '+=/'));
		$template_updated = [];
		$date_now = date("Y-m-d");

		$request_list = $this->engineering_mod->revise_history_list([
			"id" => $id,
		]);
		$request_list = $request_list[0];

		if ($action == 3) {
			$datadb = $this->engineering_mod->revision_log_temp_list([
				"id_request_update" => $id
			]);
			$update_templete = [];
			foreach ($datadb as $key => $value) {
				$update_templete[$value['id_template']][$value['column_name']] = $value['data_after'];
				$template_updated[] = [
					"id_template" => $value['id_template'],
					"module" => $value['module'],
					"name" => $value['name'],
					"column_name" => $value['column_name'],
					"data_before" => $value['data_before'],
					"data_after" => $value['data_after'],
					"created_by" => $value['created_by'],
					"created_date" => $date_now,
					"id_request_update" => $value['id_request_update'],
				];
			}
			foreach ($update_templete as $key => $value) {
				if ($request_list['fabrication_type'] == 14) {
					$this->engineering_mod->piecemark_update_process_db($value, [
						"id" => $key
					]);
				} elseif ($request_list['fabrication_type'] == 11) {
					$this->engineering_mod->joint_update_process_db($value, [
						"id" => $key
					]);
				}
			}

			$this->engineering_mod->revision_log_import_process_db($template_updated);

			$form_data = [
				"approve_by" 	=> $this->user_cookie[0],
				"approve_date" 	=> date("Y-m-d H:i:s"),
				"status_revise" 	=> 4,
			];
			$where = [
				"id" 	=> $id,
			];
			$this->engineering_mod->revise_history_update_process_db($form_data, $where);
		} elseif ($action == 6) {
			$form_data = [
				"approve_by" 	=> $this->user_cookie[0],
				"approve_date" 	=> date("Y-m-d H:i:s"),
				"status_revise" 	=> 6,
			];
			$where = [
				"id" 	=> $id,
			];
			$this->engineering_mod->revise_history_update_process_db($form_data, $where);
		}

		$this->engineering_mod->revision_log_temp_delete_process_db([
			"id_request_update" => $id
		]);

		$form_data = ["revise_id" => NULL];
		$where = ["revise_id" => $id];
		$this->engineering_mod->piecemark_update_process_db($form_data, $where);

		$form_data = ["revise_id" => NULL];
		$where = ["revise_id" => $id];
		$this->engineering_mod->joint_update_process_db($form_data, $where);

		redirect('irn/revision_irn_list/' . $request_list['fabrication_type']);
	}

	public function export_template_api()
	{
		$post = $this->input->post();

		$post_data = [
			"project" => $post['project'],
			"discipline" => $post['discipline'],
			"module" => $post['module'],
			"type_of_module" => $post['type_of_module'],
			"deck_elevation" => $post['deck_elevation'],
			"status" => $post['status'],
			"date_from" => $post['date_from'],
			"date_to" => $post['date_to'],
			"status_internal" => $post['status_internal'],
			"is_itr" => $post['is_itr'],
			"is_bondstrand" => $post['is_bondstrand'],
			"company_id" => $post['company_id'],
			"user_id" => $this->user_cookie[0],
			"expired_date" => date('Y-m-d H:i:s', strtotime("+10 minutes")),
			"client_ip" => $this->user_cookie[12],
		];
		// test_var($post_data);
		if ($post['submit'] == 'piecemark') {
			$post_data['api_url'] = '/engineering/export_piecemark';
			$post_data['document_name'] = 'Export Template Piecemark ' . date('YmdHis');
		} elseif ($post['submit'] == 'joint') {
			$post_data['api_url'] = '/engineering/export_joint';
			$post_data['document_name'] = 'Export Template Joint ' . date('YmdHis');
		}
		$jwt = encode_jwt($post_data);
		redirect(export_link() . "/export?data=$jwt");
		return;
	}

	public function drawing_list_excel_api()
	{
		$post = $this->input->post();

		$post_data = [
			"project" => $post['project'],
			"discipline" => $post['discipline'],
			"module" => $post['module'],
			"company" => $post['company_id'],
			// "type_of_module" => $post['type_of_module'],
			// "deck_elevation" => $post['deck_elevation'],
			"drawing_type" => $post['drawing_type'],

			"user_id" => $this->user_cookie[0],
			"expired_date" => date('Y-m-d H:i:s', strtotime("+10 minutes")),
			"client_ip" => $this->user_cookie[12],

			"api_url" => '/engineering/export_status_drawing',
			"document_name" => 'Export Status Drawing ' . date('YmdHis'),
		];
		// test_var($post_data);
		$jwt = encode_jwt($post_data);
		redirect(export_link() . "/export?data=$jwt");
		return;
	}

	public function send_test_mail()
	{
		$data['rfi_no_mail'] = 'SOF-OCP-SMO-TS-STR-RFI-IRN-000000';
		$data['report_no_mail'] = 'SOF-OCP-SMO-TS-STR-IRN-000000';
		$data['date_inspect'] = '2023-01-21';
		$data['time_inspect'] = '10:23:05';
		$data['link_address_client'] = 'https://www.smoebatam.com';
		$data['link_address_smoe'] = 'https://10.5.252.116/smoe_portal';
		$html = $this->load->view('engineering/email_revision_template_client', $data, true);

		echo $html;

		$email = [
			"to" => [
				'habib.syuhada@smoe.com',
			], "cc" => [
				'habib.syuhada@smoe.com',
			],
			"subject" => "TEST 1",
			"message" => "asdasdasd",
		];
		// send_email_smtp($email);

		test_var("END1");
	}

	function change_ga()
	{
		$data_req = [
			[
				'drawing_sp' => '2013J310012-C218-SM-N-XG-00062-01-SP-M3B-S-PLT-039',
				'drawing_ga_old' => '2013J310012-C218-SM-N-XG-00062-01-GA-001',
				'drawing_ga_new' => '2013J310012-C218-SM-N-XG-00062-01-GA-002',
			],
			[
				'drawing_sp' => '2013J310012-C218-SM-N-XG-00062-01-SP-M3B-S-PLT-040',
				'drawing_ga_old' => '2013J310012-C218-SM-N-XG-00062-01-GA-001',
				'drawing_ga_new' => '2013J310012-C218-SM-N-XG-00062-01-GA-002',
			],
			[
				'drawing_sp' => '2013J310012-C218-SM-N-XG-00062-01-SP-M3D-S-PLT-012',
				'drawing_ga_old' => '2013J310012-C218-SM-N-XG-00062-01-GA-001',
				'drawing_ga_new' => '2013J310012-C218-SM-N-XG-00062-01-GA-004',
			],
			[
				'drawing_sp' => '2013J310012-C218-SM-N-XG-00062-01-SP-M3D-S-PLT-078',
				'drawing_ga_old' => '2013J310012-C218-SM-N-XG-00062-01-GA-001',
				'drawing_ga_new' => '2013J310012-C218-SM-N-XG-00062-01-GA-004',
			],
			[
				'drawing_sp' => '2013J310012-C218-SM-N-XG-00062-01-SP-M3D-S-PLT-079',
				'drawing_ga_old' => '2013J310012-C218-SM-N-XG-00062-01-GA-001',
				'drawing_ga_new' => '2013J310012-C218-SM-N-XG-00062-01-GA-004',
			],
		];
		$temp = [];
		foreach ($data_req as $key => $value) {
			if (!in_array($value, $temp)) {
				$temp[] = $value;
			}
		}
		$data_req = $temp;

		$piecemark_list = [];
		$workpack_id_arr = [];

		foreach ($data_req as $key => $value) {
			$datadb = $this->engineering_mod->piecemark_list([
				"drawing_sp" => $value['drawing_sp'],
				"drawing_ga" => $value['drawing_ga_old'],
			]);
			foreach ($datadb as $key2 => $value2) {
				$value2['drawing_ga_new'] = $value['drawing_ga_new'];
				$value2['drawing_ga_old'] = $value['drawing_ga_old'];
				$piecemark_list[] = $value2;
				$workpack_id_arr[] = $value2['workpack_id'];
			}
			if (count($datadb) == 0) {
				// test_var($value['drawing_sp'], 1);
			}
		}

		$worpack_check_drawing = [];
		$workpack_id_arr = array_filter(array_unique($workpack_id_arr));
		if (count($workpack_id_arr) > 0) {
			$datadb = $this->planning_mod->workpack_list([
				"id IN (" . join(", ", $workpack_id_arr) . ")" => NULL,
			]);
			foreach ($datadb as $key => $value) {
				$worpack_check_drawing[$value['id']] = $value['drawing_no'];
			}
		}

		// test_var($piecemark_list);
		// test_var(join(", ", array_column($piecemark_list, "id")));
		// test_var($worpack_check_drawing);

		$piecemark_cp_cl_list = [];
		$piecemark_ga_list = [];
		$workpack_detail_id_list = [];
		foreach ($piecemark_list as $piecemark) {
			if ($piecemark['workpack_id'] == '') {
				$form_data = [
					"drawing_ga" => $piecemark['drawing_ga_new'],
				];
				test_var([$piecemark["id"], $piecemark["part_id"]], 1);
				// $this->engineering_mod->piecemark_update_process_db($form_data, [
				// 	"id" => $piecemark["id"],
				// ]);
			} else {
				if ($piecemark['drawing_cp'] == $worpack_check_drawing[$piecemark['workpack_id']] || $piecemark['drawing_cl'] == $worpack_check_drawing[$piecemark['workpack_id']]) {
					$form_data = [
						"drawing_ga" => $piecemark['drawing_ga_new'],
					];
					// $workpack_detail_id_list[$piecemark['workpack_id']][] = $piecemark['id'];
					$piecemark_cp_cl_list[] = $piecemark;
					// $this->engineering_mod->piecemark_update_process_db($form_data, [
					// 	"id" => $piecemark["id"],
					// ]);
				} else {
					$piecemark_ga_list[] = $piecemark;
					$workpack_detail_id_list[$piecemark['workpack_id']][] = $piecemark['id'];
					// test_var($piecemark['workpack_id'], 1);
				}
			}
		}
		// test_var(join(", ", array_keys($workpack_detail_id_list)));

		$where = [];
		foreach ($workpack_detail_id_list as $key => $value) {
			$where[] = "(id_workpack = $key AND id_template in (" . join(", ", $value) . "))";
		}
		// test_var(join(" OR ", $where));	
		// test_var($piecemark_ga_list);
		// test_var(join(", ", array_column($piecemark_ga_list, "id")));
	}

	public function import_joint_process_ext()
	{
		error_reporting(0);
		$post = $this->input->post();
		// test_var($post);

		if (in_array(19, $post['project']) && in_array(1, $post['company_id'])) {
			$this->session->set_flashdata('error', "Data cannot be inputted due to only for external!");
			redirect('engineering/import_template');
			return;
		}

		foreach ($post['drawing_no'] as $key => $value) {
			foreach ($post as $keys => $values) {
				$grouping_by_drawing[$value][$keys][] = $post[$keys][$key];
			}
		}
		// test_var($grouping_by_drawing);

		// MASTER DATA
		$datadb = $this->general_mod->company();
		$company_list = [];
		foreach ($datadb as $key => $value) {
			$company_name[$value['id_company']] = $value["company_name"];
		}

		$datadb = $this->general_mod->master_report_number();
		$master_report_number = [];
		foreach ($datadb as $key => $value) {
			$data["master_report_number"][$value['project']][$value['company_id']][$value['discipline']][$value['type_of_module']][$value['category']] = $value['report_no'];
			$save_new_submission_no[$value['project']][$value['company_id']][$value['discipline']][$value['type_of_module']][$value['category']] = $value['report_no'];
		}

		$date_now = date("Y-m-d H:i:s");
		$form_data = [];
		$column_int = ['thickness', 'diameter', 'length', 'weld_length', 'class', 'mt_percent_req', 'pt_percent_req', 'ut_percent_req', 'rt_percent_req', 'pwht_percent_req', 'pmi_percent_req'];
		foreach ($grouping_by_drawing as $key_g => $value_g) {
			// test_var($value_g);
			$search_last_id = $this->fitup_mod->get_last_submission_id_company_based($value_g['project'][0], $value_g['discipline'][0], $value_g['module'][0], $value_g['type_of_module'][0], $value_g['company_id'][0]);
			if (sizeof($search_last_id) == 0 or !isset($search_last_id[0]['submission_id'])) {
				$last_id = '000001';
			} else {
				$last_id = str_pad(substr($search_last_id[0]['submission_id'], -6) + 1, 6, '0', STR_PAD_LEFT);
			}
			$submission_id_fu = $save_new_submission_no[$value_g['project'][0]][$value_g['company_id'][0]][$value_g['discipline'][0]][$value_g['type_of_module'][0]]["fitup_rfi"] . $last_id;
			$search_last_id = $this->visual_mod->get_last_submission_id_company_based($value_g['project'][0], $value_g['discipline'][0], $value_g['module'][0], $value_g['type_of_module'][0], $value_g['company_id'][0]);
			if (sizeof($search_last_id) == 0 or !isset($search_last_id[0]['submission_id'])) {
				$last_id = '000001';
			} else {
				$last_id = str_pad(substr($search_last_id[0]['submission_id'], -6) + 1, 6, '0', STR_PAD_LEFT);
			}
			$submission_id_vs = $save_new_submission_no[$value_g['project'][0]][$value_g['company_id'][0]][$value_g['discipline'][0]][$value_g['type_of_module'][0]]["visual_rfi"] . $last_id;

			// foreach ($value_g['joint_no'] as $key => $value) {

			foreach ($value_g['joint_no'] as $key => $value) {
				foreach ($column_int as $column_no => $column_name) {
					if ($value_g[$column_name][$key] == '') {
						$value_g[$column_name][$key] = 0;
					}
				}
				// print_r($value_g['drawing_no'][$key]);
				$wps = [];
				foreach ($value_g['wps'][$key + 2] as $wps_input) {
					if ($wps_input != -1) {
						$wps[] = $wps_input;
					}
				}

				if ($key == 0) {


					$form_data_workpack = [
						'description' 			=> 'Underground',
						"drawing_no" 			=> $value_g['drawing_no'][$key],
						"project" 				=> $value_g['project'][$key],
						"discipline" 			=> $value_g['discipline'][$key],
						"module" 				=> $value_g['module'][$key],
						"type_of_module" 		=> $value_g['type_of_module'][$key],
						"phase"					=> "FB",
						"status"				=> "2",
						"company_yard" 			=> $value_g['company_id'][$key],
						"company_id" 			=> $value_g['company_id'][$key],
					];
					$id_wp = $this->planning_mod->workpack_new_process_db($form_data_workpack);
				}

				$form_data_template = [
					"workpack_id" 		=> $id_wp,

					"drawing_no" 		=> $value_g['drawing_no'][$key],
					"rev_no" 			=> $value_g['rev_no'][$key],
					"discipline" 		=> $value_g['discipline'][$key],
					"module" 			=> $value_g['module'][$key],
					"project" 			=> $value_g['project'][$key],
					"drawing_wm" 		=> $value_g['drawing_wm'][$key],
					"rev_wm" 			=> $value_g['rev_wm'][$key],
					"drawing_type" 		=> $value_g['drawing_type'][$key],
					"type_of_module" 	=> $value_g['type_of_module'][$key],
					"deck_elevation" 	=> $value_g['deck_elevation'][$key],
					"is_bondstrand" 	=> $value_g['is_bondstrand'][$key] == 'NO' ? 1 : 0,

					"description_assy" 	=> $value_g['desc_assy'][$key],

					"joint_no" 			=> $value_g['joint_no'][$key],
					"pos_1" 			=> $value_g['pos_1'][$key],
					"ref_1" 			=> $value_g['ref_1'][$key],
					"pos_2" 			=> $value_g['pos_2'][$key],
					"ref_2" 			=> $value_g['ref_2'][$key],
					"weld_type" 		=> $value_g['weld_type'][$key],
					"thickness" 		=> $value_g['thickness'][$key],
					"diameter" 			=> $value_g['diameter'][$key],
					"sch" 				=> $value_g['schedule'][$key],
					"length" 			=> $value_g['length'][$key],
					"weld_length" 		=> $value_g['weld_length'][$key],
					"joint_type" 		=> $value_g['joint_type'][$key],
					"test_pack_no" 		=> $value_g['test_pack_no'][$key],
					"spool_no" 			=> $value_g['spool_no'][$key],
					"service_line" 		=> $value_g['service_line'][$key],
					"pid_drawing" 		=> $value_g['pid_drawing'][$key],
					"class" 			=> $value_g['class'][$key],
					"grid_row" 			=> $value_g['grid_row'][$key],
					"grid_column" 		=> $value_g['grid_column'][$key],
					"mt_percent_req" 	=> $value_g['mt_percent_req'][$key],
					"pt_percent_req" 	=> $value_g['pt_percent_req'][$key],
					"ut_percent_req" 	=> $value_g['ut_percent_req'][$key],
					"rt_percent_req" 	=> $value_g['rt_percent_req'][$key],
					"pwht_percent_req" 	=> $value_g['pwht_percent_req'][$key],
					"pmi_percent_req" 	=> $value_g['pmi_percent_req'][$key],
					"remarks" 			=> $value_g['remarks'][$key],
					"wps" 				=> join(";", $wps),
					"phase" 			=> $value_g['phase'][$key],
					"status" 			=> 1,
					"created_by" 		=> $this->user_cookie[0],
					"created_date" 		=> $date_now,
					"company_id" 		=> $value_g['company_id'][$key],
				];
				$id_joint_arr = $this->engineering_mod->joint_new_process_db($form_data_template);

				$where_mv["b.status_inspection >= 3"] = NULL;
				if ($value_g['pos_1'][$key] == $value_g['pos_2'][$key]) {
					$val_check_mv = 1;
				} else {
					$val_check_mv = 2;
				}
				$where_mv["a.part_id IN ('" . $value_g['pos_1'][$key] . "', '" . $value_g['pos_2'][$key] . "')"] = NULL;
				$check_mv = $this->material_verification_mod->material_inspection_list_item($where_mv);
				unset($where_mv);
				// test_var(COUNT($check_mv));

				// FITUP ====================================================================================================
				$form_data_fitup = [
					"submission_id" => ($value_g["fitup_inspection_by"][$key] and COUNT($check_mv) >= $val_check_mv) ? $submission_id_fu : NULL,
					"project_code" => $value_g['project'][$key],
					"drawing_no" =>  $value_g['drawing_no'][$key],
					"discipline" => $value_g['discipline'][$key],
					"module" => $value_g['module'][$key],
					"type_of_module" => $value_g['type_of_module'][$key],
					"drawing_type" => $value_g['drawing_type'][$key],
					"requestor" => $this->user_cookie[0],
					"company" => $company_name[$value_g['company_id'][$key]],
					"company_id" => $value_g['company_id'][$key],
					"date_request" => $value_g["fitup_date_request"][$key] ? $value_g["fitup_date_request"][$key] . " " . DATE("H:i:s") : NULL,
					"wps_no" => implode(";", $value_g["fitup_wps"][$key]),
					"status_inspection" => ($value_g["fitup_inspection_by"][$key] and COUNT($check_mv) >= $val_check_mv) ? 3 : 0,
					"inspection_by" => $value_g["fitup_inspection_by"][$key] ? $value_g["fitup_inspection_by"][$key] : NULL,
					"inspection_datetime" => $value_g["fitup_inspection_datetime"][$key] ? $value_g["fitup_inspection_datetime"][$key] : NULL,
					"date_created" => DATE("Y-m-d H:i:s"),
					"surveyor_creator" => $this->user_cookie[0],
					"surveyor_created_date" => DATE("Y-m-d H:i:s"),
					"status_surveyor" => 3,
					'id_joint' => $id_joint_arr,
					'id_workpack' => $id_wp,
				];
				$id_fu = $this->fitup_mod->insert_fitup_data($form_data_fitup);

				// VISUAL ====================================================================================================
				$form_data_visual = [
					"submission_id" => ($value_g["visual_inspection_by"][$key] && $form_data_fitup["status_inspection"] == 3) ? $submission_id_vs : NULL,
					"project_code" => $value_g['project'][$key],
					"drawing_no" => $value_g['drawing_no'][$key],
					"discipline" => $value_g['discipline'][$key],
					"module" => $value_g['module'][$key],
					"type_of_module" => $value_g['type_of_module'][$key],
					"drawing_type" => $value_g['drawing_type'][$key],
					"requestor" => $this->user_cookie[0],
					"company_id" => $value_g['company_id'][$key],
					"date_request" => !empty($value_g["visual_date_request"][$key]) && isset($value_g["visual_date_request"][$key]) ? $value_g["visual_date_request"][$key] . " " . DATE("H:i:s") : NULL,
					"id_joint" => $id_joint_arr,
					"weld_datetime" => !empty($value_g["visual_weld_datetime"][$key]) && isset($value_g["visual_weld_datetime"][$key]) ? $value_g["visual_weld_datetime"][$key] . " " . DATE("H:i:s") : NULL,
					"length_of_weld" => $value_g['visual_length_of_weld'][$key] == '' ? $value_g['weld_length'][$key] : $value_g['visual_length_of_weld'][$key],
					"cons_lot_no" => $value_g['visual_cons_lot_no'][$key],
					"wps_no_rh" => implode(";", $value_g['visual_wps_rh'][$key]),
					"wps_no_fc" => implode(";", $value_g['visual_wps_fc'][$key]),
					"status_inspection" => ($value_g["visual_inspection_by"][$key] && $form_data_fitup["status_inspection"] == 3) ? 3 : 0,
					"inspection_by" => $value_g["visual_inspection_by"][$key] ? $value_g["visual_inspection_by"][$key] : NULL,
					"inspection_datetime" => $value_g["visual_inspection_datetime"][$key] ? $value_g["visual_inspection_datetime"][$key] : NULL,
					"date_created" => DATE("Y-m-d H:i:s"),
					"surveyor_creator" => $this->user_cookie[0],
					"surveyor_created_date" => DATE("Y-m-d H:i:s"),
					"id_workpack" => $id_wp,
					"status_surveyor" => 3,
					"company" => $company_name[$value_g['company_id'][$key]],
					"company_id" => $value_g['company_id'][$key],
					"weld_process_rh" => implode(";", $value_g['visual_weld_process_rh'][$key]),
					"weld_process_fc" => implode(";", $value_g['visual_weld_process_fc'][$key]),
				];
				$id_vs = $this->visual_mod->input_visual($form_data_visual);
				foreach ($value_g["visual_welder_rh"][$key] as $key_v_welder_rh => $value_v_welder_rh) {
					$form_data_visual_detail = [
						"id_visual" => $id_vs,
						"status_rh_fc" => 0,
						"id_welder" => $value_v_welder_rh,
						"length_welded" => 0,
						"created_by" => $this->user_cookie[0],
					];
					$id_vs_dw = $this->visual_mod->input_visual_detail_welder($form_data_visual_detail);
				}
				foreach ($value_g["visual_welder_fc"][$key] as $key_v_welder_fc => $value_v_welder_fc) {
					$form_data_visual_detail = [
						"id_visual" => $id_vs,
						"status_rh_fc" => 1,
						"id_welder" => $value_v_welder_fc,
						"length_welded" => 0,
						"created_by" => $this->user_cookie[0],
					];
					$id_vs_dw = $this->visual_mod->input_visual_detail_welder($form_data_visual_detail);
				}
			}
		}
		// test_var($id_joint_arr);

		$this->session->set_flashdata('success', 'The Data has been Inserted!');
		redirect("engineering/import_template");
	}


	public function autocomplete_piecemark_new()
	{
		$get = $this->input->get();

		$where = [
			"part_id LIKE '%" . $get['q'] . "%'" => NULL,
			"status_delete" => 1,
			// "is_itr" => 0,
		];
		$datadb = $this->engineering_mod->piecemark_list($where, 10);
		$output = [];
		if (count($datadb) > 0) {
			foreach ($datadb as $key => $value) {

				$output[] = [
					'id' => $value["part_id"],  // The ID of the option
					'text' => $value["part_id"]  // The displayed text in the dropdown
				];
			}
		} else {
			$output[] = "No Data.";
		}
		echo json_encode($output);
	}

	public function import_piecemark_preview_for_to_void()
	{
		error_reporting(0);
		$post = $this->input->post();
		$id_template[] = $post['id'];
		$where["id IN (" . implode(", ", $id_template) . ")"] = NULL;
		$where['status_delete'] = 1;
		$data['data_piecemark'] = $this->engineering_mod->piecemark_list($where);
		unset($where);
		$where["id_piecemark IN (" . implode(", ", $id_template) . ")"] = NULL;
		$data_material = $this->material_verification_mod->get_material($where);
		foreach ($data_material as $key => $value) {
			$data['data_material'][$value['id_piecemark']] = $value;
		}
		unset($where);

		$where["category IN ('mv_no', 'mv_no_rfi')"]      = null;
		$list_report_number     = $this->general_mod->report_no($where);
		unset($where);
		foreach ($list_report_number as $value) {
			$data['report_no_format'][$value['project']][$value['company_id']][$value['discipline']][$value['module']][$value['type_of_module']][$value['deck_elevation']][$value['category']] = $value['report_no'];
		}

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['id']] = $value;
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
			$project_list[$value['id']] = $value;
		}
		$data['project_list'] = $project_list;

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['id']] = $value;
		}
		$data['type_of_module_list'] = $type_of_module_list;

		$datadb = $this->general_mod->deck_elevation();
		$deck_elevation_list = [];
		foreach ($datadb as $key => $value) {
			$deck_elevation_list[$value['id']] = $value;
		}
		$data['deck_elevation_list'] = $deck_elevation_list;

		$datadb = $this->general_mod->desc_assy();
		$desc_assy_list = [];
		foreach ($datadb as $key => $value) {
			$desc_assy_list[$value['id']] = $value;
		}
		$data['desc_assy_list'] = $desc_assy_list;

		$datadb = $this->general_mod->piping_testing_category();
		$piping_testing_category_list = [];
		foreach ($datadb as $key => $value) {
			$piping_testing_category_list[$value['id']] = $value;
		}
		$data['piping_testing_category_list'] = $piping_testing_category_list;

		$datadb = $this->general_mod->material_grade();
		$material_grade_list = [];
		foreach ($datadb as $key => $value) {
			$material_grade_list[$value['id']] = $value;
		}
		$data['material_grade_list'] = $material_grade_list;

		$datadb = $this->general_mod->company();
		$company_list = [];
		foreach ($datadb as $key => $value) {
			$company_list[$value['id_company']] = $value;
		}
		$data['company_list'] = $company_list;

		$data['meta_title']   = 'Piecemark Preview to Void';
		$data['subview']      = 'engineering/piecemark_preview_to_void';
		$data['sidebar']      = $this->sidebar;
		$data['user_permission'] = $this->permission_cookie;
		$this->load->view('index', $data);
	}

	public function import_joint_preview_for_to_void()
	{
		error_reporting(0);
		$post = $this->input->post();
		$id_template[] = $post['id'];
		$where["id IN (" . implode(", ", $id_template) . ")"] = NULL;
		$where['status_delete'] = 1;
		$data['data_joint'] = $this->engineering_mod->joint_list($where);
		unset($where);

		$id_template[] = $post['id'];
		$where["id_joint IN (" . implode(", ", $id_template) . ")"] = NULL;

		// FITUP
		$data_ft = $this->fitup_mod->fitup_list($where);
		foreach ($data_ft as $key => $value) {
			$data['data_ft'][$value['id_joint']] = $value;
		}

		// VISUAL
		$data_vt = $this->visual_mod->visual_list($where);
		foreach ($data_vt as $key => $value) {
			$data['data_vt'][$value['id_joint']] = $value;
		}
		unset($where);

		// NDT
		$datadb = $this->ndt_live_mod->master_ndt(['status_internal' => 0]);
		foreach ($datadb as $key => $value) {
			$data['ndt_type_list']['id'] = $value;
		}

		$id_template[] = $post['id'];
		$where["id_joint IN (" . implode(", ", $id_template) . ")"] = NULL;
		$datadb = $this->ndt_live_mod->pcms_ndt_all($where);
		foreach ($datadb as $key => $value) {
			$data['ndt_data'][$value['id_joint']][$value['ndt_type']] = $value;
		}

		unset($where);
		$id_template[] = $post['id'];
		$where["a.id_joint IN (" . implode(", ", $id_template) . ")"] = NULL;
		$data_ndt_atc = $this->ndt_live_mod->ndt_detail_atc($where);
		foreach ($data_ndt_atc as $key => $value) {
			$data['data_ndt_atc'][$value['id_joint']] = $value;
		}
		unset($where);

		$where["category IN ('fitup_report', 'fitup_report_scm')"]      = null;
		$datadb = $this->general_mod->report_no($where);
		unset($where);
		foreach ($datadb as $key => $value) {
			$data["master_report_ft"][$value['project']][$value['company_id']][$value['discipline']][$value['module']][$value['type_of_module']][$value['deck_elevation']][$value['category']] = $value['report_no'];
		}

		$where["category IN ('visual_report', 'visual_report_scm')"]      = null;
		$datadb = $this->general_mod->report_no($where);
		unset($where);
		foreach ($datadb as $key => $value) {
			$data["master_report_vt"][$value['project']][$value['company_id']][$value['discipline']][$value['module']][$value['type_of_module']][$value['deck_elevation']][$value['category']] = $value['report_no'];
		}

		$where_master_report["category ILIKE '%ndt_rfi%'"]  = null;
		$master_report_list       = $this->general_mod->master_report_number($where_master_report);
		unset($where_master_report);
		foreach ($master_report_list as $value) {
			$data["master_rfi_ndt"][$value['project']][$value['company_id']][$value['discipline']][$value['module']][$value['type_of_module']][$value['deck_elevation']]  = $value['report_no'];
		}



		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['id']] = $value;
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
			$project_list[$value['id']] = $value;
		}
		$data['project_list'] = $project_list;

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['id']] = $value;
		}
		$data['type_of_module_list'] = $type_of_module_list;

		$datadb = $this->general_mod->deck_elevation();
		$deck_elevation_list = [];
		foreach ($datadb as $key => $value) {
			$deck_elevation_list[$value['id']] = $value;
		}
		$data['deck_elevation_list'] = $deck_elevation_list;

		$datadb = $this->general_mod->desc_assy();
		$desc_assy_list = [];
		foreach ($datadb as $key => $value) {
			$desc_assy_list[$value['id']] = $value;
		}
		$data['desc_assy_list'] = $desc_assy_list;
		$datadb = $this->general_mod->company();
		$company_list = [];
		foreach ($datadb as $key => $value) {
			$company_list[$value['id_company']] = $value;
		}
		$data['company_list'] = $company_list;

		$datadb = $this->general_mod->type_of_weld();
		$type_of_weld_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_weld_list[$value['id']] = $value;
		}
		$data['type_of_weld_list'] = $type_of_weld_list;

		$datadb = $this->general_mod->company();
		$company_list = [];
		foreach ($datadb as $key => $value) {
			$company_list[$value['id_company']] = $value;
		}
		$data['company_list'] = $company_list;

		$data['meta_title']   = 'Joint Preview to Void';
		$data['subview']      = 'engineering/joint_preview_to_void';
		$data['sidebar']      = $this->sidebar;
		$data['user_permission'] = $this->permission_cookie;
		$this->load->view('index', $data);
	}

	public function process_piecemark_joint_preview_to_void() // Fitur request void pada joint list yang baru dan isa memilih berapa banyak data yang akan di void
	{
		$post = $this->input->post();
		$id_template = $post['id'];
		$date_now = date("Y-m-d H:i:s");
		if ($post['fabrication_type'] == 'pre_fab') {
			foreach ($id_template as $key => $value) {
				$where["id_piecemark"] = $value;
				$form_data = [
					"latest_inspection_status" => $post['status_inspection'][$key],
					"status_inspection" => 12,
				];
				$this->material_verification_mod->mv_update_process_db($form_data, $where);
				unset($form_data, $where);
			}
			$where["id IN (" . implode(", ", $id_template) . ")"] = NULL;
			$form_data = [
				"status_delete" => 0,
			];
			$this->engineering_mod->piecemark_update_process_db($form_data, $where);
			unset($form_data, $where);
			foreach ($id_template as $key => $value) {
				$piecemark_updated = [
					"id_template" 	=> $value,
					"module" 		=> 1,
					"name" 			=> 'Status template piecemark',
					"column_name" 	=> 'status_delete',
					"data_before" 	=> 1,
					"data_after" 	=> 0,
					"created_by" 	=> $this->user_cookie[0],
					"created_date" 	=> $date_now,
					"id_request_update" => NULL,
				];
				$this->engineering_mod->revision_log_new_process_db($piecemark_updated);
				unset($piecemark_updated);
			}
			$this->session->set_flashdata('success', "Process void has been successed!");
			redirect("engineering/joint_list");
		} elseif ($post['fabrication_type'] == 'fab') {
			foreach ($id_template as $key => $value) {
				$where["id_joint"] = $value;
				$form_data_ft = [
					"status_inspection" => 12,
					"latest_inspection_status" => $post['status_inspection_ft'][$key],
				];
				$this->fitup_mod->fu_update_process_db($form_data_ft, $where);
				$form_data_vt = [
					"status_inspection" => 12,
					"latest_inspection_status" => $post['status_inspection_vt'][$key],
				];
				$this->visual_mod->vt_update_process_db($form_data_vt, $where);

				$set["status_inspection"]   = 12;
				$this->ndt_live_mod->update_ndt_ut($where, $set);
				$this->ndt_live_mod->update_ndt_mt($where, $set);
				$this->ndt_live_mod->update_ndt_pt($where, $set);
				$this->ndt_live_mod->update_ndt_rt($where, $set);
				unset($where);
				$where["joint_id"] = $value;
				$this->ndt_live_mod->update_ndt_atc($where, $set);
				unset($where, $set);
			}

			$where["id IN (" . implode(", ", $id_template) . ")"] = NULL;
			$form_data = [
				"status_delete" => 0,
			];
			$this->engineering_mod->joint_update_process_db($form_data, $where);
			unset($form_data, $where);



			foreach ($id_template as $key => $value) {
				$history_form = [
					"id_template"        => $value,
					"module"             => 2,
					"name"               => "Status template joint",
					"column_name"        => "status_delete",
					"data_before"        => 1,
					"data_after"         => 0,
					"created_by"         => $this->user_cookie[0],
					"created_date"       => $date_now,
					"id_request_update"  => NULL,
				];
				$this->engineering_mod->revision_log_new_process_db($history_form);
				unset($history_form);
			}
			$this->session->set_flashdata('success', "Process void has been successed!");
			redirect("engineering/piecemark_list");
		}
	}
}
