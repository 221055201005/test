<?php

use FontLib\Table\Type\post;

defined('BASEPATH') or exit('No direct script access allowed');

class Welder extends CI_Controller
{

	public function __construct()
	{
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
		$this->sidebar 	          = "master/welder/sidebar";
		$this->is_admin           = $this->permission_cookie[0];

		$this->project_alt        = $this->user_cookie[13];
		$this->company_alt        = $this->user_cookie[14];
		$this->user_id            = $this->user_cookie[0];
		$this->timestamp          = date('Y-m-d H:i:s');

		$where['id != 8']         = null;
		$this->master_data_cat    = $this->m_welder_mod->master_data_cat_list($where);
		unset($where);
	}

	public function index()
	{
		$data['sidebar']      = $this->sidebar;
		// $data['meta_title']   = 'Blank';
		// $data['subview']      = 'master/blank';
		// $data['sidebar']      = $this->sidebar;
		// $this->load->view('index', $data);
		redirect('master/welder/welder_list');
	}

	public function welder_import(){
		$data['meta_title']   = 'Import Template';
		$data['user_permission'] = $this->permission_cookie;
		$data['subview']      = 'master/welder/welder_import';
    $data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
	}

	public function master_data_list($id_cat = null)
	{
		$data['id_main_enc']  = $id_cat;
		$id_cat               = decrypt($id_cat);
		if (!$id_cat) {
			$id_cat             = 1;
		}

		$where['id']          = $id_cat;
		$data['main']         = $this->m_welder_mod->master_data_cat_list($where);
		unset($where);

		$where['id_main']     = $id_cat;
		$order_by             = "id ASC";
		$data['detail_list']  = $this->m_welder_mod->master_welder_req_list($where, $order_by);
		unset($where);

		$data['id_main']      = $id_cat;
		$data['sidebar']      = $this->sidebar;
		$data['meta_title']   = 'Master Data Welder Register';
		$data['subview']      = 'master/welder/master_data_list';
		$this->load->view('index', $data);
	}

	public function add_master_data()
	{
		$id_main              = $this->input->post('id_main');
		$id_main              = decrypt($id_main);
		if (!$id_main) {
			test_var("Something Wrong :1");
		}

		$data['id_main']      = $id_main;
		$this->load->view('master/welder/add_master_data', $data);
	}

	public function proceed_add_master_data()
	{
		$id_main              = $this->input->post('id_main');
		$value                = $this->input->post('value');

		$where['id']          = $id_main;
		$main                 = $this->m_welder_mod->master_data_cat_list($where);
		unset($where);

		$form_data            = [
			'id_main'           => $main[0]['id'],
			'initial_main'      => $main[0]['initial'],
			'value'             => $value,
			'display_text'      => $value,
			'created_by'        => $this->user_id,
			'created_date'      => $this->timestamp
		];

		$this->m_welder_mod->insert_master_data_welder_req($form_data);
		unset($where);

		$this->session->set_flashdata('success', 'Success Create Data');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function update_master_data()
	{
		$id_enc              = $this->input->post('id_enc');
		$id                   = decrypt($id_enc);
		if (!$id) {
			test_var("Something Wrong :1");
		}

		$where['id']          = $id;
		$data['detail']       = $this->m_welder_mod->master_welder_req_list($where);
		unset($where);


		$data['id']         = $id;
		$this->load->view('master/welder/update_master_data', $data);
	}

	public function proceed_update_master_data()
	{
		$id                   = $this->input->post('id');
		$value                = $this->input->post('value');
		$form_data            = [
			'value'             => $value,
			'updated_by'        => $this->user_id,
			'updated_date'      => $this->timestamp
		];

		$where['id']          = $id;
		$this->m_welder_mod->update_master_welder_req($form_data, $where);
		unset($where);

		$this->session->set_flashdata('success', 'Success Update Data');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function welder_list()
	{

		$submit               = $this->input->get('submit');
		if ($submit == "download") {
			return $this->download_welder_register();
		}

		$data['project_list'] = $this->general_mod->project();
		$data['company_list'] = $this->general_mod->company_all();
		$data['serverside'] = "master/welder/serverside_welder_register";
		$data['sidebar']      = $this->sidebar;
		$data['meta_title'] = 'Welder Register';

		$data['subview']  = 'master/welder/welder_list';
		$this->load->view('index', $data);
	}

	protected function download_welder_register()
	{
		error_reporting(0);
		$project_post             = $this->input->get('project');
		$company_id_post          = $this->input->get('company');

		$where_wl                 = null;
		if ($project_post) {
			$where_wl['project_id']    = $project_post;
		}

		if ($company_id_post) {
			$where_wl['company_id']    = $company_id_post;
		}

		$order_by             = "main.id_welder ASC";
		$list                 = $this->m_welder_mod->master_welder_join($where_wl, $order_by);
		unset($where);

		if ($list) {
			foreach ($list as $value) {
				$list_company_id[]    = intval($value['company_id']);
				$list_user_id[]       = intval($value['non_active_by']);
				$list_bankdata[]      = $value['bank_data_badge'];
			}

			$where[implode_where("badge_id", $list_bankdata) . ' OR ' . implode_where("CAST (data_id AS VARCHAR)", $list_bankdata)] = null;
			$datadb                 = $this->m_welder_mod->bankdata_list($where);

			foreach ($datadb as $value) {
				$bankdata_badge[$value['badge_id']]   = $value['data_id'];
				$bankdata_data_id[$value['data_id']]  = $value['data_id'];
			}
			unset($where);

			$where[implode_where("id_user", $list_user_id)] = null;
			$select                 = "id_user, full_name";
			$datadb                 = $this->general_mod->portal_user_db_list($where, null, $select);
			unset($where);
			foreach ($datadb as $value) {
				$user_list[$value['id_user']] = $value;
			}

			$where[implode_where("id_company", $list_company_id)] = null;
			$datadb                 = $this->general_mod->company($where);
			unset($where);
			foreach ($datadb as $value) {
				$company[$value['id_company']]  = $value;
			}

			$datadb                = $this->general_mod->project();
			foreach ($datadb as $value) {
				$project[$value['id']]  = $value;
			}

			$datadb               = $this->general_mod->discipline();
			foreach ($datadb as $value) {
				$discipline[$value['id']] = $value;
			}

			$datadb = $this->general_mod->master_welder_process();
			foreach ($datadb as $value) {
				$welder_process[$value['id']] = $value;
			}

			$datadb = $this->general_mod->master_wps_new();
			foreach ($datadb as $value) {
				$wps[$value['id_wps']]  = $value;
			}

			$master_welder_req            = $this->m_welder_mod->master_welder_req_list($where);
			unset($where);

			foreach ($master_welder_req as $value) {
				$master_req[$value['initial_main']][$value['value']] = $value;
			}
		}

		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

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

		$sheet->setCellValue('A1', 'WELDER CODE');
		// $sheet->setCellValue('B1', 'RWE CODE');
		$sheet->setCellValue('B1', 'COMPANY');
		$sheet->setCellValue('C1', 'PROJECT');
		$sheet->setCellValue('D1', 'WELDER BADGE');
		$sheet->setCellValue('E1', 'WELDER NAME');
		$sheet->setCellValue('F1', 'CLASS MATERIAL');
		$sheet->setCellValue('G1', 'DISCIPLINE');
		$sheet->setCellValue('H1', 'PROCESS');
		$sheet->setCellValue('I1', 'F NUMBER');
		$sheet->setCellValue('J1', 'POSITION');
		$sheet->setCellValue('K1', 'POSITION RANGE');
		$sheet->setCellValue('L1', 'DIAMETER RANGE');
		$sheet->setCellValue('M1', 'THICKNESS RANGE');
		$sheet->setCellValue('N1', 'BACKING');
		$sheet->setCellValue('O1', 'VALIDITY START DATE');
		$sheet->setCellValue('P1', 'VALIDITY END DATE');
		$sheet->setCellValue('Q1', 'STATUS');

		$excel->getActiveSheet()->getStyle('A1:S1')->applyFromArray($styleArray);
		unset($styleArray);

		$skipped_column   = ["G", "H", "J", "K", "L", "M", "N", "O", "P"];

		foreach (range('A', 'S') as $value) {
			if (!in_array($value, $skipped_column)) {
				$excel->getActiveSheet()->getColumnDimension($value)->setAutoSize(true);
			} else {
				$excel->getActiveSheet()->getColumnDimension($value)->setWidth(33);
			}
		}

		$excel->getDefaultStyle()->getAlignment()->setWrapText(true);

		$start  = 2;
		foreach ($list as $value) {
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

			$multi_list    = [];
			if ($value['f_no']) {
				foreach (explode(",", $value['f_no']) as $v) {
					$multi_list['f_no'][] = $v;
				}
			}

			if ($value['welder_position']) {
				foreach (explode(",", $value['welder_position']) as $v) {
					$multi_list['welder_position'][] = $v;
				}
			}

			$status_welder          = $master_req['status_actived'][$value['status_actived']]['display_text'];

			$sheet->setCellValue('A' . $start, $value['welder_code']);
			// $sheet->setCellValue('B' . $start, $value['rwe_code']);
			$sheet->setCellValue('B' . $start, $company[$value["company_id"]]['company_name']);
			$sheet->setCellValue('C' . $start, $project[$value['project_id']]['project_name']);
			$sheet->setCellValue('D' . $start, $value['welder_badge']);
			$sheet->setCellValue('E' . $start, $value['welder_name']);
			$sheet->setCellValue('F' . $start, $value['cwm']);
			$sheet->setCellValue('G' . $start, $discipline[$value['discipline']]['discipline_name']);
			$sheet->setCellValue('H' . $start,  $welder_process[$value['welder_process']]['name_process']);
			$sheet->setCellValue('I' . $start,  isset($multi_list['f_no']) ? implode(",\n", $multi_list['f_no']) : '');
			$sheet->setCellValue('J' . $start,  isset($multi_list['welder_position']) ? implode(",\n", $multi_list['welder_position']) : '');
			$sheet->setCellValue('K' . $start,  $value['position_range']);
			$sheet->setCellValue('L' . $start,  $value['diameter_range']);
			$sheet->setCellValue('M' . $start,  $value['thickness_range']);
			$sheet->setCellValue('N' . $start,  $value['backing']);
			$sheet->setCellValue('O' . $start,  $value['validity_start_date']);
			$sheet->setCellValue('P' . $start,  $value['validity_end_date']);
			$sheet->setCellValue('Q' . $start,  $status_welder);

			$excel->getActiveSheet()->getStyle('A' . $start . ':S' . $start)->applyFromArray($styleArray);
			unset($styleArray);
			$start++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Export Welder Register ' . date('YmdHis') . '.xlsx"');
		$data = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$data->save('php://output');
		exit;
	}

	public function import_preview(){
		error_reporting(0);
		$config['upload_path']          = 'file/welder/';
		$config['file_name']            = 'excel_'.$this->user_cookie[0];
		$config['allowed_types']        = 'xlsx';
		$config['overwrite'] 						= TRUE;

		$this->load->library('upload');
		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload('file')){
			$this->session->set_flashdata('error', $this->upload->display_errors());
			redirect($_SERVER["HTTP_REFERER"]);
			return false;
		}

		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load($config['upload_path'].$this->upload->data('file_name')); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		if(count($sheet) < 2){
			$this->session->set_flashdata('error', 'No Data that listed in excel template!');
			redirect($_SERVER["HTTP_REFERER"]);
			return false;
		}
		foreach($sheet as $key => $value) {
			$sheet_detail[$value["A"].'X'.$value["B"].'X'.$value["C"].'X'.$value["D"]][] = $value;

			$sheets[$value["A"].'X'.$value["B"].'X'.$value["C"].'X'.$value["D"]] = $value;
		}
		$data["sheet"] = $sheets;
		$data["sheet_detail"] = $sheet_detail;

		$welder_code = array_column($sheets, "C");
		$datadb = $this->m_welder_mod->welder_list(["welder_code IN ('".implode("', '", $welder_code)."')" => NULL]);
		$welder_list = [];
		foreach ($datadb as $key => $value) {
			$welder_list[$value['welder_code']] = $value;
		}
		$data['welder_list'] = $welder_list;

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['id']] = $value;
		}

		$data['discipline_list'] = $discipline_list;

		$datadb = $this->general_mod->company_all();
		$company_list = [];
		foreach ($datadb as $key => $value) {
			$company[$value['id_company']] = $value;
		}
		$data['company_list'] = $company;

		$datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['id']] = $value;
		}
		$data['project_list'] = $project_list;

		$datadb = $this->general_mod->master_welder_process();
		$welder_process_list = [];
		foreach ($datadb as $key => $value) {
			$welder_process_list[$value['id']] = $value;
		}
		$data['welder_process_list'] = $welder_process_list;

		$where['status_delete']       = 1;

		$order_by                     = "id_main ASC, id ASC";
		$master_welder_req            = $this->m_welder_mod->master_welder_req_list($where, $order_by);
		unset($where);

		foreach ($master_welder_req as $value) {
			$data['master_req'][$value['initial_main']][] = $value;
		}
		// $data['module']       = $module;
		$data['wps_list']     = $this->general_mod->master_wps_new();

		$data['meta_title']   = 'Import Welder Preview';
		$data['subview']      = 'master/welder/import_preview';
		$data['sidebar']      = $this->sidebar;
		$data['user_permission'] = $this->permission_cookie;
		$this->load->view('index', $data);
	}

	public function serverside_welder_register()
	{
		error_reporting(0);
		$data                     = [];

		$project_post             = $this->input->post('project');
		$company_id_post          = $this->input->post('company_id');

		$where_wl                 = null;
		if ($project_post) {
			$where_wl['project_id']    = $project_post;
		}
		else{
			$where_wl['project_id']    = $this->user_cookie[10];
		}

		if ($company_id_post) {
			$where_wl['company_id']    = $company_id_post;
		}
		$list                     = $this->m_welder_mod->serverside_welder_register("query", $where_wl);

		if ($list) {
			foreach ($list as $value) {
				$list_company_id[]    = intval($value['company_id']);
				$list_user_id[]       = intval($value['non_active_by']);
				$list_bankdata[]      = $value['bank_data_badge'];
			}

			$where[implode_where("badge_id", $list_bankdata) . ' OR ' . implode_where("CAST (data_id AS VARCHAR)", $list_bankdata)] = null;
			$datadb                 = $this->m_welder_mod->bankdata_list($where);

			foreach ($datadb as $value) {
				$bankdata_badge[$value['badge_id']]   = $value['data_id'];
				$bankdata_data_id[$value['data_id']]  = $value['data_id'];
			}
			unset($where);

			$where[implode_where("id_user", $list_user_id)] = null;
			$select                 = "id_user, full_name";
			$datadb                 = $this->general_mod->portal_user_db_list($where, null, $select);
			unset($where);
			foreach ($datadb as $value) {
				$user_list[$value['id_user']] = $value;
			}

			$where[implode_where("id_company", $list_company_id)] = null;
			$datadb                 = $this->general_mod->company_all($where);
			unset($where);
			foreach ($datadb as $value) {
				$company[$value['id_company']]  = $value;
			}

			$datadb                = $this->general_mod->project();
			foreach ($datadb as $value) {
				$project[$value['id']]  = $value;
			}

			$datadb               = $this->general_mod->discipline();
			foreach ($datadb as $value) {
				$discipline[$value['id']] = $value;
			}

			$datadb = $this->general_mod->master_welder_process();
			foreach ($datadb as $value) {
				$welder_process[$value['id']] = $value;
			}

			$datadb = $this->general_mod->master_wps_new();
			foreach ($datadb as $value) {
				$wps[$value['id_wps']]  = $value;
			}

			$master_welder_req            = $this->m_welder_mod->master_welder_req_list($where);
			unset($where);

			foreach ($master_welder_req as $value) {
				$master_req[$value['initial_main']][$value['value']] = $value;
			}
		}

		foreach ($list as $value) {

			$row                    = [];

			$detail_data            = [];

			if ($value['f_no']) {
				foreach (explode(",", $value['f_no']) as $v) {
					$detail_data['f_no'][]            = $v;
				}
			}

			if ($value['welder_position']) {
				foreach (explode(",", $value['welder_position']) as $v) {
					$detail_data['welder_position'][]            = $v;
				}
			}

			$color_span             = "badge-success";
			if ($value['status_actived'] != 1) {
				$color_span           = "badge-danger";
			}

			$status_welder          = $master_req['status_actived'][$value['status_actived']]['display_text'];
			$span_status            = '<span class="badge badge-pill ' . $color_span . '">' . $status_welder . '</span>';

			if ($value['remarks_auto_disabled']) {
				// $span_status         .= "<br><span style='font-size:10px !important;font-weight:bold;font-style: italic;'>" . $value['remarks_auto_disabled'] . "</span><br/><span style='font-size:10px !important;font-weight:bold;font-style: italic;'>" . $value['auto_expired_date'] . "</span>";
			}

			if ($value['non_active_by']) {
				$span_status         .= "<br/><span style='font-size:10px !important;font-weight:bold;font-style: italic;'>" . $user_list[$value['non_active_by']]['full_name'] . "</span><br/><span style='font-size:10px !important;font-weight:bold;font-style: italic;'>" . date("Y-m-d", strtotime($value['non_active_date'])) . "</span>";
			}

			$btn_update             = '';
			if ($this->permission_cookie[114] == 1) {
				$btn_update           = '<a href="' . site_url('master/welder/welder_update_pages/' . encrypt($value['id_welder'])) . '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Update</a>';
			}

			if (isset($bankdata_badge[$value["bank_data_badge"]])) {
				$bank_data = $bankdata_badge[$value["bank_data_badge"]];
			} elseif (isset($bankdata_data_id[$value["bank_data_badge"]])) {
				$bank_data = $bankdata_data_id[$value["bank_data_badge"]];
			}

			$qr                     = 'N/A';
			if ($bank_data) {
				$qr                   = ' <a href="' . site_url('master/welder/generated_qr_code/' . encrypt($bank_data)) . '" class="btn btn-secondary"><i class="fas fa-qrcode"></i></a>';
			}

			$enc_loc_ndt            = encrypt('/PCMS/pcms_v2/welder_attachment/ndt_validity/');
			$ndt_1                  = '-';
			if ($value['ndt_val_1']) {
				$enc_att_name         = encrypt($value['nt_val_1']);
				$url_1                = site_url('public_smoe/open_file_syn/' . $enc_att_name . '/' . $enc_loc_ndt);
				$ndt_1                = '<a target="_blank" href="' . $url_1 . '" class="btn btn-info btn-sm"><i class="fas fa-certificate"></i> File</a>';
			}

			$ndt_2                  = '-';
			if ($value['ndt_val_2']) {
				$enc_att_name         = encrypt($value['nt_val_2']);
				$url_2                = site_url('public_smoe/open_file_syn/' . $enc_att_name . '/' . $enc_loc_ndt);
				$ndt_2                = '<a target="_blank" href="' . $url_2 . '" class="btn btn-info btn-sm"><i class="fas fa-certificate"></i> File</a>';
			}

			$ndt_3                  = '-';
			if ($value['ndt_val_3']) {
				$enc_att_name         = encrypt($value['nt_val_3']);
				$url_3                = site_url('public_smoe/open_file_syn/' . $enc_att_name . '/' . $enc_loc_ndt);
				$ndt_3                = '<a target="_blank" href="' . $url_3 . '" class="btn btn-info btn-sm"><i class="fas fa-certificate"></i> File</a>';
			}

			$att_cert = '';
			if ($value['attachment']) {
				if ($this->permission_cookie[110] == '1') {
					$enc_att_name                     = encrypt($value['attachment']);
					$enc_path                         = encrypt('/PCMS/pcms_v2/welder_attachment/');
					$url_att                          = site_url('public_smoe/open_file_syn/' . $enc_att_name . '/' . $enc_path);
					$att_cert                        = '<a href="' . $url_att . '" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-paperclip"></i> File</a>';
				}
			}


			$row[]                  = $value['welder_code'];
			// $row[]                  = $value['rwe_code'];
			$row[]                  = $company[$value["company_id"]]['company_name'];
			$row[]                  = $project[$value['project_id']]['project_name'];
			$row[]                  = $value['welder_badge'];
			$row[]                  = $value['welder_name'];

			$row[]                  = $value['cwm'];
			$row[]                  = $discipline[$value['discipline']]['discipline_name'];
			$row[]                  = $welder_process[$value['welder_process']]['name_process'];
			$row[]                  = isset($detail_data['f_no']) ? implode(",<br>", $detail_data['f_no']) : '';
			$row[]                  = isset($detail_data['welder_position']) ? implode(",<br>", $detail_data['welder_position']) : '';
			$row[]                  = $value['position_range'];
			$row[]                  = $value['diameter_range'];
			$row[]                  = $value['thickness_range'];
			$row[]                  = $value['backing'];
			$row[]                  = $att_cert;

			$row[]                  = $value['validity_start_date'];
			$row[]                  = $value['validity_end_date'];
			$row[]                  = $span_status;
			$row[]                  = $btn_update;
			$row[]                  = $qr;
			$row[]                  = $ndt_1;
			$row[]                  = $ndt_2;
			$row[]                  = $ndt_3;

			$data[]                 = $row;
		}

		$result         					= [
			"draw"              		=> $_POST['draw'],
			"recordsTotal"      		=> $this->m_welder_mod->serverside_welder_register("all", $where_wl),
			"recordsFiltered"   		=> $this->m_welder_mod->serverside_welder_register("filtered", $where_wl),
			"data"              		=> $data
		];

		echo json_encode($result);
		unset($where_wl);
	}

	public function welder_new($id = null)
	{

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['id']] = $value;
		}
		$data['discipline_list'] = $discipline_list;

		$datadb = $this->general_mod->company();
		$company_list = [];
		foreach ($datadb as $key => $value) {
			$company[$value['id_company']] = $value;
		}
		$data['company_list'] = $company;

		$datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['id']] = $value;
		}
		$data['project_list'] = $project_list;

		$datadb = $this->general_mod->master_welder_process();
		$welder_process_list = [];
		foreach ($datadb as $key => $value) {
			$welder_process_list[$value['id']] = $value;
		}
		$data['welder_process_list'] = $welder_process_list;

		$where['status_delete']       = 1;

		$order_by                     = "id_main ASC, id ASC";
		$master_welder_req            = $this->m_welder_mod->master_welder_req_list($where, $order_by);
		unset($where);

		foreach ($master_welder_req as $value) {
			$data['master_req'][$value['initial_main']][] = $value;
		}

		$module = "new";
		if ($id) {
			$module = "update";
			$id = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
			$welder_list = $this->m_welder_mod->welder_list([
				"id" => $id,
			]);
			$data['welder']			= $welder_list[0];
		}

		$data['module']       = $module;
		$data['wps_list']     = $this->general_mod->master_wps_new();

		$data['sidebar']      = $this->sidebar;
		$data['meta_title']   = ucfirst($module) . ' Welder';
		$data['subview']      = 'master/welder/welder_new';
		$this->load->view('index', $data);
	}

	public function welder_save_process()
	{
		error_reporting(0);
		$welder_code      = $this->input->post('welder_code');
		$rwe_code         = $this->input->post('rwe_code');
		$company_id       = $this->input->post('company');
		$project_id       = $this->input->post('project_id');
		$welder_badge     = $this->input->post('welder_badge');
		$welder_name      = $this->input->post('welder_name');
		$cwm              = $this->input->post('cwm');
		$discipline       = $this->input->post('discipline');

		$welder_process   = $this->input->post('welder_process');
		$welder_position  = $this->input->post('welder_position');

		$f_no             = $this->input->post('f_no');
		$position_range   = $this->input->post('position_range');
		$diameter_range   = $this->input->post('diameter_range');
		$thickness_range  = $this->input->post('thickness_range');
		$backing          = $this->input->post('backing');

		$vsd              = $this->input->post('vsd');
		$ved              = $this->input->post('ved');
		$status_actived   = $this->input->post('status_actived');

		$id_req           = $this->input->post('id_req');

		$bank_data_badge  = $this->input->post('bank_data_badge');

		$non_active_date  = $this->input->post('non_active_date');
		$wps_welder       = $this->input->post('wps_welder');

		$validity_start_date        = $this->input->post('validity_start_date');
		$validity_end_date          = $this->input->post('validity_end_date');



		if ($welder_code) {

			foreach ($welder_code as $key => $value) {

				if ($_FILES['attachment_1']['name'][$key] != "") {

					require_once(APPPATH . 'third_party/Net/SFTP.php');
					$ftp                        = $this->ftp;
					$sftp                       = new Net_SFTP($ftp['hostname']);
					$destination_source         = '/PCMS/pcms_v2/welder_attachment/';

					if (!$sftp->login($ftp['username'], $ftp['password'])) {
						$this->session->set_flashdata('error', 'FTP Server Not Working');
						redirect($_SERVER['HTTP_REFERER']);
					}

					$filetype           = pathinfo($_FILES['attachment_1']['name'][$key]);
					$filetype           = $filetype['extension'];

					if ($filetype == "pdf") {

						$filename           = 'welder_attachment_' . uniqid() . '_.' . $filetype;
						$attach_line_name   = $filename;
						$filepath           = 'upload/';
						move_uploaded_file($_FILES['attachment_1']['tmp_name'][$key], $filepath . $attach_line_name);
						$fileName                 = $attach_line_name;
						$source                   = $filepath . $attach_line_name;
						$destination              = $destination_source . $attach_line_name;
						$sftp->put($destination, $source, NET_SFTP_LOCAL_FILE);
						@unlink($source);

					} else {
						$this->session->set_flashdata('error', 'Only For PDF File..! 1');
						redirect($_SERVER['HTTP_REFERER']);
					}

					$attachment_1 = $filename;
				} else {
					$attachment_1 = null;
				}

				if ($_FILES['ndt_val_1']['name'][$key] != "") {
					// $ndt_val_1             = uniqid().'_Welder_'.$_FILES['ndt_val_1']['name'][$key];
					// $ndt_val_1             = str_replace(" ","_", $ndt_val_1);
					// $ndt_val_1             = str_replace("#","_", $ndt_val_1);
					// $filepath                 = 'upload/wps/';
					// move_uploaded_file($_FILES['ndt_val_1']['tmp_name'][$key], $filepath.$ndt_val_1);

					// require_once(APPPATH.'third_party/Net/SFTP.php');

					// $sftp                     = new Net_SFTP($dataftp[0]['hostname']);
					// $fileName                 = $ndt_val_1;

					// if (!$sftp->login($dataftp[0]['username'], $dataftp[0]['password'])) {
					//     $this->load->library('ftp');
					//     $source                 = 'upload/wps/'.$fileName;
					//     $ftp_config['hostname'] = $dataftp[0]['hostname']; 
					//     $ftp_config['username'] = $dataftp[0]['username'];
					//     $ftp_config['password'] = $dataftp[0]['password'];
					//     $ftp_config['debug']    = TRUE;

					//     $this->ftp->connect($ftp_config);
					//     $destination            = 'pcms_v2_photo/welder_file/ndt_validity/'.$fileName;
					//     $this->ftp->upload($source, $destination);
					//     $this->ftp->close();
					//     @unlink($source);
					// }  else { 
					//     $destination_source      = 'pcms_v2_photo';
					//     $source                  = 'upload/wps/'.$fileName;
					//     $destination             = '/var/www/'.$destination_source.'/welder_file/ndt_validity/'.$fileName;
					//     $sftp->put($destination , $source, NET_SFTP_LOCAL_FILE);
					//     @unlink($source);
					// }

					require_once(APPPATH . 'third_party/Net/SFTP.php');
					$ftp                        = $this->ftp;
					$sftp                       = new Net_SFTP($ftp['hostname']);
					$destination_source         = '/PCMS/pcms_v2/welder_attachment/ndt_validity/';

					if (!$sftp->login($ftp['username'], $ftp['password'])) {
						$this->session->set_flashdata('error', 'FTP Server Not Working');
						redirect($_SERVER['HTTP_REFERER']);
					}

					$filetype           = pathinfo($_FILES['ndt_val_1']['name'][$key]);
					$filetype           = $filetype['extension'];

					if ($filetype == "pdf") {

						$filename           = 'welder_attachment_ndt_val_1_' . uniqid() . '_.' . $filetype;
						$attach_line_name   = $filename;
						$filepath           = 'upload/';
						move_uploaded_file($_FILES['ndt_val_1']['tmp_name'][$key], $filepath . $attach_line_name);
						$fileName                 = $attach_line_name;
						$source                   = $filepath . $attach_line_name;
						$destination              = $destination_source . $attach_line_name;
						$sftp->put($destination, $source, NET_SFTP_LOCAL_FILE);
						// @unlink($source);

					} else {
						$this->session->set_flashdata('error', 'Only For PDF File..! 2');
						redirect($_SERVER['HTTP_REFERER']);
					}

					$ndt_val_1 = $filename;
				} else {
					$ndt_val_1 = null;
				}

				if ($_FILES['ndt_val_2']['name'][$key] != "") {
					// $ndt_val_2             = uniqid().'_Welder_'.$_FILES['ndt_val_2']['name'][$key];
					// $ndt_val_2             = str_replace(" ","_", $ndt_val_2);
					// $ndt_val_2             = str_replace("#","_", $ndt_val_2);
					// $filepath                 = 'upload/wps/';
					// move_uploaded_file($_FILES['ndt_val_2']['tmp_name'][$key], $filepath.$ndt_val_2);

					// require_once(APPPATH.'third_party/Net/SFTP.php');

					// $sftp                     = new Net_SFTP($dataftp[0]['hostname']);
					// $fileName                 = $ndt_val_2;

					// if (!$sftp->login($dataftp[0]['username'], $dataftp[0]['password'])) {
					//     $this->load->library('ftp');
					//     $source                 = 'upload/wps/'.$fileName;
					//     $ftp_config['hostname'] = $dataftp[0]['hostname']; 
					//     $ftp_config['username'] = $dataftp[0]['username'];
					//     $ftp_config['password'] = $dataftp[0]['password'];
					//     $ftp_config['debug']    = TRUE;

					//     $this->ftp->connect($ftp_config);
					//     $destination            = 'pcms_v2_photo/welder_file/ndt_validity/'.$fileName;
					//     $this->ftp->upload($source, $destination);
					//     $this->ftp->close();
					//     @unlink($source);
					// }  else { 
					//     $destination_source      = 'pcms_v2_photo';
					//     $source                  = 'upload/wps/'.$fileName;
					//     $destination             = '/var/www/'.$destination_source.'/welder_file/ndt_validity/'.$fileName;
					//     $sftp->put($destination , $source, NET_SFTP_LOCAL_FILE);
					//     @unlink($source);
					// }

					require_once(APPPATH . 'third_party/Net/SFTP.php');
					$ftp                        = $this->ftp;
					$sftp                       = new Net_SFTP($ftp['hostname']);
					$destination_source         = '/PCMS/pcms_v2/welder_attachment/ndt_validity/';

					if (!$sftp->login($ftp['username'], $ftp['password'])) {
						$this->session->set_flashdata('error', 'FTP Server Not Working');
						redirect($_SERVER['HTTP_REFERER']);
					}

					$filetype           = pathinfo($_FILES['ndt_val_2']['name'][$key]);
					$filetype           = $filetype['extension'];

					if ($filetype == "pdf") {

						$filename           = 'welder_attachment_ndt_val_2_' . uniqid() . '_.' . $filetype;
						$attach_line_name   = $filename;
						$filepath           = 'upload/';
						move_uploaded_file($_FILES['ndt_val_2']['tmp_name'][$key], $filepath . $attach_line_name);
						$fileName                 = $attach_line_name;
						$source                   = $filepath . $attach_line_name;
						$destination              = $destination_source . $attach_line_name;
						$sftp->put($destination, $source, NET_SFTP_LOCAL_FILE);
						// @unlink($source);

					} else {
						$this->session->set_flashdata('error', 'Only For PDF File..! 3');
						redirect($_SERVER['HTTP_REFERER']);
					}

					$ndt_val_2 = $filename;
				} else {
					$ndt_val_2 = null;
				}

				if ($_FILES['ndt_val_3']['name'][$key] != "") {
					// $ndt_val_3             = uniqid().'_Welder_'.$_FILES['ndt_val_3']['name'][$key];
					// $ndt_val_3             = str_replace(" ","_", $ndt_val_3);
					// $ndt_val_3             = str_replace("#","_", $ndt_val_3);
					// $filepath                 = 'upload/wps/';
					// move_uploaded_file($_FILES['ndt_val_3']['tmp_name'][$key], $filepath.$ndt_val_3);

					// require_once(APPPATH.'third_party/Net/SFTP.php');

					// $sftp                     = new Net_SFTP($dataftp[0]['hostname']);
					// $fileName                 = $ndt_val_3;

					// if (!$sftp->login($dataftp[0]['username'], $dataftp[0]['password'])) {
					//     $this->load->library('ftp');
					//     $source                 = 'upload/wps/'.$fileName;
					//     $ftp_config['hostname'] = $dataftp[0]['hostname']; 
					//     $ftp_config['username'] = $dataftp[0]['username'];
					//     $ftp_config['password'] = $dataftp[0]['password'];
					//     $ftp_config['debug']    = TRUE;

					//     $this->ftp->connect($ftp_config);
					//     $destination            = 'pcms_v2_photo/welder_file/ndt_validity/'.$fileName;
					//     $this->ftp->upload($source, $destination);
					//     $this->ftp->close();
					//     @unlink($source);
					// }  else { 
					//     $destination_source      = 'pcms_v2_photo';
					//     $source                  = 'upload/wps/'.$fileName;
					//     $destination             = '/var/www/'.$destination_source.'/welder_file/ndt_validity/'.$fileName;
					//     $sftp->put($destination , $source, NET_SFTP_LOCAL_FILE);
					//     @unlink($source);
					// }

					require_once(APPPATH . 'third_party/Net/SFTP.php');
					$ftp                        = $this->ftp;
					$sftp                       = new Net_SFTP($ftp['hostname']);
					$destination_source         = '/PCMS/pcms_v2/welder_attachment/ndt_validity/';

					if (!$sftp->login($ftp['username'], $ftp['password'])) {
						$this->session->set_flashdata('error', 'FTP Server Not Working');
						redirect($_SERVER['HTTP_REFERER']);
					}

					$filetype           = pathinfo($_FILES['ndt_val_3']['name'][$key]);
					$filetype           = $filetype['extension'];

					if ($filetype == "pdf") {

						$filename           = 'welder_attachment_ndt_val_3_' . uniqid() . '_.' . $filetype;
						$attach_line_name   = $filename;
						$filepath           = 'upload/';
						move_uploaded_file($_FILES['ndt_val_3']['tmp_name'][$key], $filepath . $attach_line_name);
						$fileName                 = $attach_line_name;
						$source                   = $filepath . $attach_line_name;
						$destination              = $destination_source . $attach_line_name;
						$sftp->put($destination, $source, NET_SFTP_LOCAL_FILE);
						// @unlink($source);

					} else {
						$this->session->set_flashdata('error', 'Only For PDF File..! 4');
						redirect($_SERVER['HTTP_REFERER']);
					}

					$ndt_val_3 = $filename;
				} else {
					$ndt_val_3 = null;
				}

				$form_data = [
					"welder_code"       => $welder_code[$key],
					"rwe_code"          => $rwe_code[$key],
					"company_id"        => $company_id[$key],
					"project_id"        => $project_id[$key],
					"welder_badge"      => $welder_badge[$key],
					"bank_data_badge"   => $bank_data_badge[$key],
					"welder_name"       => $welder_name[$key],
					"discipline"        => $discipline[$key],
					// "vsd"               => $vsd[$key],
					// "ved"               => $ved[$key],
					"attachment"        => @$attachment_1,
					"ndt_val_1"         => $ndt_val_1,
					"ndt_val_2"         => $ndt_val_2,
					"ndt_val_3"         => $ndt_val_3,
					"status_actived"    => $status_actived[$key],
					"non_active_by"     => $this->user_cookie[0],
					"non_active_date"   => $non_active_date[$key],
					'wps_welder'				=> implode(";", $wps_welder[$key])
				];


				$insert_welder  =  $this->m_welder_mod->welder_new_process_db($form_data);
				unset($form_data);

				$no = 1;
				foreach ($id_req[$key] as $k => $v) {

					$dataftp_detail  = $this->general_mod->ftp_find_master_with_condition($_SERVER["SERVER_ADDR"], "10.5.252.116/pcms_v2_photo");

					if ($_FILES['attachment_detail']['name'][$key][$k] != "") {
						// $attachment_detail             = uniqid().'_Welder_'.$_FILES['attachment_detail']['name'][$key][$k];
						// $attachment_detail             = str_replace(" ","_", $attachment_detail);
						// $attachment_detail             = str_replace("#","_", $attachment_detail);
						// $filepath                 = 'upload/wps/';
						// move_uploaded_file($_FILES['attachment_detail']['tmp_name'][$key][$k], $filepath.$attachment_detail);

						// require_once(APPPATH.'third_party/Net/SFTP.php');

						// $sftp                     = new Net_SFTP($dataftp_detail[0]['hostname']);
						// $fileName                 = $attachment_detail;

						// if (!$sftp->login($dataftp_detail[0]['username'], $dataftp_detail[0]['password'])) {
						//     $this->load->library('ftp');
						//     $source                 = 'upload/wps/'.$fileName;
						//     $ftp_config['hostname'] = $dataftp_detail[0]['hostname']; 
						//     $ftp_config['username'] = $dataftp_detail[0]['username'];
						//     $ftp_config['password'] = $dataftp_detail[0]['password'];
						//     $ftp_config['debug']    = TRUE;

						//     $this->ftp->connect($ftp_config);
						//     $destination            = 'pcms_v2_photo/welder_file/'.$fileName;
						//     $this->ftp->upload($source, $destination);
						//     $this->ftp->close();
						//     @unlink($source);
						// }  else { 
						//     $destination_source      = 'pcms_v2_photo';
						//     $source                  = 'upload/wps/'.$fileName;
						//     $destination             = '/var/www/'.$destination_source.'/welder_file/'.$fileName;
						//     $sftp->put($destination , $source, NET_SFTP_LOCAL_FILE);
						//     @unlink($source);
						// }

						require_once(APPPATH . 'third_party/Net/SFTP.php');
						$ftp                        = $this->ftp;
						$sftp                       = new Net_SFTP($ftp['hostname']);
						$destination_source         = '/PCMS/pcms_v2/welder_attachment/';

						if (!$sftp->login($ftp['username'], $ftp['password'])) {
							$this->session->set_flashdata('error', 'FTP Server Not Working');
							redirect($_SERVER['HTTP_REFERER']);
						}

						$filetype           = pathinfo($_FILES['attachment_detail']['name'][$key][$k]);
						$filetype           = $filetype['extension'];

						if ($filetype == "pdf") {

							$filename           = 'welder_attachment_detail_' . uniqid() . '_.' . $filetype;
							$attach_line_name   = $filename;
							$filepath           = 'upload/';
							move_uploaded_file($_FILES['attachment_detail']['tmp_name'][$key][$k], $filepath . $attach_line_name);
							$fileName                 = $attach_line_name;
							$source                   = $filepath . $attach_line_name;
							$destination              = $destination_source . $attach_line_name;
							$sftp->put($destination, $source, NET_SFTP_LOCAL_FILE);
							// @unlink($source);

						} else {
							$this->session->set_flashdata('error', 'Only For PDF File..! 5');
							redirect($_SERVER['HTTP_REFERER']);
						}

						$attachment_detail = $filename;
					} else {
						$attachment_detail = null;
					}



					$position_save = implode(",", $welder_position[$key][$no]);
					$f_no_save = implode(",", $f_no[$key][$no]);

					$form_data_req = [
						"id_welder"       => $insert_welder,
						"welder_process"  => $welder_process[$key][$k],
						"welder_position" => $position_save,
						"cwm"             => $cwm[$key][$k],
						"f_no"            => $f_no_save,
						"position_range"  => $position_range[$key][$k],
						"diameter_range"  => $diameter_range[$key][$k],
						"thickness_range" => $thickness_range[$key][$k],
						// "id_wps"          => intval($welder_wps[$key][$k]),
						"validity_start_date" => $validity_start_date[$key][$k] != "" ? $validity_start_date[$key][$k] : null,
						"validity_end_date"   => $validity_end_date[$key][$k] != "" ? $validity_end_date[$key][$k] : null,
						"backing"         => $backing[$key][$k],
						"attachment"      => $attachment_detail,
						"create_by"       => $this->user_cookie[0],
						"create_date"     => date("Y-m-d H:i:s"),
					];

					$insert_welder_detail  =  $this->m_welder_mod->welder_new_req_process_db($form_data_req);
					unset($form_data_req);

					$no++;
				}
			}
		}

		$this->session->set_flashdata('success', 'New Welder are created!');
		redirect($_SERVER["HTTP_REFERER"]);
	}

	public function welder_save_process_import(){
		// error_reporting(0);
		// test_var($_POST);
		$welder_code      = $this->input->post('welder_code');
		$company_id       = $this->input->post('company');
		$project_id       = $this->input->post('project_id');
		$welder_badge     = $this->input->post('welder_badge');
		$welder_name      = $this->input->post('welder_name');
		$cwm              = $this->input->post('cwm');
		$discipline       = $this->input->post('discipline');

		$welder_process   = $this->input->post('welder_process');
		$welder_position  = $this->input->post('welder_position');

		$f_no             = $this->input->post('f_no');
		$position_range   = $this->input->post('position_range');
		$diameter_range   = $this->input->post('diameter_range');
		$thickness_range  = $this->input->post('thickness_range');
		$backing          = $this->input->post('backing');

		$vsd              = $this->input->post('vsd');
		$ved              = $this->input->post('ved');
		$status_actived   = $this->input->post('status_actived');

		$id_req           = $this->input->post('id_req');

		$bank_data_badge  = $this->input->post('bank_data_badge');

		$non_active_date  = $this->input->post('non_active_date');
		$wps_welder       = $this->input->post('wps_welder');

		$validity_start_date        = $this->input->post('validity_start_date');
		$validity_end_date          = $this->input->post('validity_end_date');


		if ($welder_code) {

			foreach ($welder_code as $key => $value) {

				$form_data = [
					"welder_code"       => $welder_code[$key],
					"company_id"        => $company_id[$key],
					"project_id"        => $project_id[$key],
					"welder_badge"      => $welder_badge[$key],
					"bank_data_badge"   => $bank_data_badge[$key],
					"welder_name"       => $welder_name[$key],
					"discipline"        => $discipline[$key],
					'wps_welder'				=> implode(";", $wps_welder[$key]),
					"status_actived"    => '1',
					// "non_active_by"     => $this->user_cookie[0],
					// "non_active_date"   => $non_active_date[$key],
				];
				// test_var($form_data, 1);
				$insert_welder  =  $this->m_welder_mod->welder_new_process_db($form_data);
				unset($form_data);

				$no = 1;
				foreach ($id_req[$key] as $k => $v) {

					$dataftp_detail  = $this->general_mod->ftp_find_master_with_condition($_SERVER["SERVER_ADDR"], "10.5.252.116/pcms_v2_photo");

					$position_save = implode(",", $welder_position[$key][$k]);
					$f_no_save = implode(",", $f_no[$key][$k]);

					$form_data_req = [
						"id_welder"       => $insert_welder,
						"welder_process"  => $welder_process[$key][$k],
						"welder_position" => $position_save,
						"cwm"             => $cwm[$key][$k],
						"f_no"            => $f_no_save,
						"position_range"  => $position_range[$key][$k],
						"diameter_range"  => $diameter_range[$key][$k],
						"thickness_range" => $thickness_range[$key][$k],
						// "id_wps"          => intval($welder_wps[$key][$k]),
						"validity_start_date" => $validity_start_date[$key][$k] != "" ? $validity_start_date[$key][$k] : null,
						"validity_end_date"   => $validity_end_date[$key][$k] != "" ? $validity_end_date[$key][$k] : null,
						"backing"         => $backing[$key][$k],
						"create_by"       => $this->user_cookie[0],
						"create_date"     => date("Y-m-d H:i:s"),
					];
					$id_detail = $this->m_welder_mod->welder_new_req_process_db($form_data_req);
					unset($form_data_req);
					// test_var($id_detail, 1);

					$no++;
				}
			}
		}
		// test_var('d');
		$this->session->set_flashdata('success', 'New Welder are created!');
		redirect("master/welder"); 
	}


	public function welder_update_process()
	{
		error_reporting(0);
		$id_welder_main     = $this->input->post('id_welder_main');
		$welder_code      = $this->input->post('welder_code');
		$rwe_code         = $this->input->post('rwe_code');
		$project_id       = $this->input->post('project_id');
		$welder_badge     = $this->input->post('welder_badge');
		$welder_name      = $this->input->post('welder_name');
		$cwm              = $this->input->post('cwm');
		$discipline       = $this->input->post('discipline');

		$welder_process   = $this->input->post('welder_process');
		$welder_position  = $this->input->post('welder_position');

		$f_no             = $this->input->post('f_no');
		$position_range   = $this->input->post('position_range');
		$diameter_range   = $this->input->post('diameter_range');
		$thickness_range  = $this->input->post('thickness_range');
		$backing          = $this->input->post('backing');

		$vsd              = $this->input->post('vsd');
		$ved              = $this->input->post('ved');
		$status_actived   = $this->input->post('status_actived');

		$id_req           = $this->input->post('id_req');

		$company           = $this->input->post('company');
		$bank_data_badge   = $this->input->post('bank_data_badge');

		$non_active_date    = $this->input->post('non_active_date');
		$wps_welder         = $this->input->post('wps_welder');
		$validity_start_date          = $this->input->post('validity_start_date');
		$validity_end_date            = $this->input->post('validity_end_date');



		//test_var($welder_position);
		// test_var($id_req);

		//test_var($f_no);


		if ($welder_code) {

			foreach ($welder_code as $key => $value) {
				$dataftp  = $this->general_mod->ftp_find_master_with_condition($_SERVER["SERVER_ADDR"], "10.5.252.116/pcms_v2_photo");

				if ($_FILES['attachment_1']['name'][$key] != "") {
					// $attachment_1             = uniqid().'_Welder_'.$_FILES['attachment_1']['name'][$key];
					// $attachment_1             = str_replace(" ","_", $attachment_1);
					// $attachment_1             = str_replace("#","_", $attachment_1);
					// $filepath                 = 'upload/wps/';
					// move_uploaded_file($_FILES['attachment_1']['tmp_name'][$key], $filepath.$attachment_1);

					// require_once(APPPATH.'third_party/Net/SFTP.php');

					// $sftp                     = new Net_SFTP($dataftp[0]['hostname']);
					// $fileName                 = $attachment_1;

					// if (!$sftp->login($dataftp[0]['username'], $dataftp[0]['password'])) {
					//     $this->load->library('ftp');
					//     $source                 = 'upload/wps/'.$fileName;
					//     $ftp_config['hostname'] = $dataftp[0]['hostname']; 
					//     $ftp_config['username'] = $dataftp[0]['username'];
					//     $ftp_config['password'] = $dataftp[0]['password'];
					//     $ftp_config['debug']    = TRUE;

					//     $this->ftp->connect($ftp_config);
					//     $destination            = 'pcms_v2_photo/welder_file/'.$fileName;
					//     $this->ftp->upload($source, $destination);
					//     $this->ftp->close();
					//     @unlink($source);
					// }  else { 
					//     $destination_source      = 'pcms_v2_photo';
					//     $source                  = 'upload/wps/'.$fileName;
					//     $destination             = '/var/www/'.$destination_source.'/welder_file/'.$fileName;
					//     $sftp->put($destination , $source, NET_SFTP_LOCAL_FILE);
					//     @unlink($source);
					// }

					require_once(APPPATH . 'third_party/Net/SFTP.php');
					$ftp                        = $this->ftp;
					$sftp                       = new Net_SFTP($ftp['hostname']);
					$destination_source         = '/PCMS/pcms_v2/welder_attachment/';

					if (!$sftp->login($ftp['username'], $ftp['password'])) {
						$this->session->set_flashdata('error', 'FTP Server Not Working');
						redirect($_SERVER['HTTP_REFERER']);
					}

					$filetype           = pathinfo($_FILES['attachment_1']['name'][$key]);
					$filetype           = $filetype['extension'];

					if ($filetype == "pdf") {

						$filename           = 'welder_attachment_' . uniqid() . '_.' . $filetype;
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


				if ($_FILES['ndt_val_1']['name'][$key] != "") {
					// $ndt_val_1             = uniqid().'_Welder_'.$_FILES['ndt_val_1']['name'][$key];
					// $ndt_val_1             = str_replace(" ","_", $ndt_val_1);
					// $ndt_val_1             = str_replace("#","_", $ndt_val_1);
					// $filepath                 = 'upload/wps/';
					// move_uploaded_file($_FILES['ndt_val_1']['tmp_name'][$key], $filepath.$ndt_val_1);

					// require_once(APPPATH.'third_party/Net/SFTP.php');

					// $sftp                     = new Net_SFTP($dataftp[0]['hostname']);
					// $fileName                 = $ndt_val_1;

					// if (!$sftp->login($dataftp[0]['username'], $dataftp[0]['password'])) {
					//     $this->load->library('ftp');
					//     $source                 = 'upload/wps/'.$fileName;
					//     $ftp_config['hostname'] = $dataftp[0]['hostname']; 
					//     $ftp_config['username'] = $dataftp[0]['username'];
					//     $ftp_config['password'] = $dataftp[0]['password'];
					//     $ftp_config['debug']    = TRUE;

					//     $this->ftp->connect($ftp_config);
					//     $destination            = 'pcms_v2_photo/welder_file/ndt_validity/'.$fileName;
					//     $this->ftp->upload($source, $destination);
					//     $this->ftp->close();
					//     @unlink($source);
					// }  else { 
					//     $destination_source      = 'pcms_v2_photo';
					//     $source                  = 'upload/wps/'.$fileName;
					//     $destination             = '/var/www/'.$destination_source.'/welder_file/ndt_validity/'.$fileName;
					//     $sftp->put($destination , $source, NET_SFTP_LOCAL_FILE);
					//     @unlink($source);
					// }

					require_once(APPPATH . 'third_party/Net/SFTP.php');
					$ftp                        = $this->ftp;
					$sftp                       = new Net_SFTP($ftp['hostname']);
					$destination_source         = '/PCMS/pcms_v2/welder_attachment/ndt_validity/';

					if (!$sftp->login($ftp['username'], $ftp['password'])) {
						$this->session->set_flashdata('error', 'FTP Server Not Working');
						redirect($_SERVER['HTTP_REFERER']);
					}

					$filetype           = pathinfo($_FILES['ndt_val_1']['name'][$key]);
					$filetype           = $filetype['extension'];

					if ($filetype == "pdf") {

						$filename           = 'welder_attachment_ndt_val_1_' . uniqid() . '_.' . $filetype;
						$attach_line_name   = $filename;
						$filepath           = 'upload/';
						move_uploaded_file($_FILES['ndt_val_1']['tmp_name'][$key], $filepath . $attach_line_name);
						$fileName                 = $attach_line_name;
						$source                   = $filepath . $attach_line_name;
						$destination              = $destination_source . $attach_line_name;
						$sftp->put($destination, $source, NET_SFTP_LOCAL_FILE);
						// @unlink($source);

					} else {
						$this->session->set_flashdata('error', 'Only For PDF File..!');
						redirect($_SERVER['HTTP_REFERER']);
					}

					$ndt_val_1 = $filename;
				}

				if ($_FILES['ndt_val_2']['name'][$key] != "") {
					// $ndt_val_2             = uniqid().'_Welder_'.$_FILES['ndt_val_2']['name'][$key];
					// $ndt_val_2             = str_replace(" ","_", $ndt_val_2);
					// $ndt_val_2             = str_replace("#","_", $ndt_val_2);
					// $filepath                 = 'upload/wps/';
					// move_uploaded_file($_FILES['ndt_val_2']['tmp_name'][$key], $filepath.$ndt_val_2);

					// require_once(APPPATH.'third_party/Net/SFTP.php');

					// $sftp                     = new Net_SFTP($dataftp[0]['hostname']);
					// $fileName                 = $ndt_val_2;

					// if (!$sftp->login($dataftp[0]['username'], $dataftp[0]['password'])) {
					//     $this->load->library('ftp');
					//     $source                 = 'upload/wps/'.$fileName;
					//     $ftp_config['hostname'] = $dataftp[0]['hostname']; 
					//     $ftp_config['username'] = $dataftp[0]['username'];
					//     $ftp_config['password'] = $dataftp[0]['password'];
					//     $ftp_config['debug']    = TRUE;

					//     $this->ftp->connect($ftp_config);
					//     $destination            = 'pcms_v2_photo/welder_file/ndt_validity/'.$fileName;
					//     $this->ftp->upload($source, $destination);
					//     $this->ftp->close();
					//     @unlink($source);
					// }  else { 
					//     $destination_source      = 'pcms_v2_photo';
					//     $source                  = 'upload/wps/'.$fileName;
					//     $destination             = '/var/www/'.$destination_source.'/welder_file/ndt_validity/'.$fileName;
					//     $sftp->put($destination , $source, NET_SFTP_LOCAL_FILE);
					//     @unlink($source);
					// }

					require_once(APPPATH . 'third_party/Net/SFTP.php');
					$ftp                        = $this->ftp;
					$sftp                       = new Net_SFTP($ftp['hostname']);
					$destination_source         = '/PCMS/pcms_v2/welder_attachment/ndt_validity/';

					if (!$sftp->login($ftp['username'], $ftp['password'])) {
						$this->session->set_flashdata('error', 'FTP Server Not Working');
						redirect($_SERVER['HTTP_REFERER']);
					}

					$filetype           = pathinfo($_FILES['ndt_val_2']['name'][$key]);
					$filetype           = $filetype['extension'];

					if ($filetype == "pdf") {

						$filename           = 'welder_attachment_ndt_val_2_' . uniqid() . '_.' . $filetype;
						$attach_line_name   = $filename;
						$filepath           = 'upload/';
						move_uploaded_file($_FILES['ndt_val_2']['tmp_name'][$key], $filepath . $attach_line_name);
						$fileName                 = $attach_line_name;
						$source                   = $filepath . $attach_line_name;
						$destination              = $destination_source . $attach_line_name;
						$sftp->put($destination, $source, NET_SFTP_LOCAL_FILE);
						// @unlink($source);

					} else {
						$this->session->set_flashdata('error', 'Only For PDF File..!');
						redirect($_SERVER['HTTP_REFERER']);
					}

					$ndt_val_2 = $filename;
				}

				if ($_FILES['ndt_val_3']['name'][$key] != "") {
					// $ndt_val_3             = uniqid().'_Welder_'.$_FILES['ndt_val_3']['name'][$key];
					// $ndt_val_3             = str_replace(" ","_", $ndt_val_3);
					// $ndt_val_3             = str_replace("#","_", $ndt_val_3);
					// $filepath                 = 'upload/wps/';
					// move_uploaded_file($_FILES['ndt_val_3']['tmp_name'][$key], $filepath.$ndt_val_3);

					// require_once(APPPATH.'third_party/Net/SFTP.php');

					// $sftp                     = new Net_SFTP($dataftp[0]['hostname']);
					// $fileName                 = $ndt_val_3;

					// if (!$sftp->login($dataftp[0]['username'], $dataftp[0]['password'])) {
					//     $this->load->library('ftp');
					//     $source                 = 'upload/wps/'.$fileName;
					//     $ftp_config['hostname'] = $dataftp[0]['hostname']; 
					//     $ftp_config['username'] = $dataftp[0]['username'];
					//     $ftp_config['password'] = $dataftp[0]['password'];
					//     $ftp_config['debug']    = TRUE;

					//     $this->ftp->connect($ftp_config);
					//     $destination            = 'pcms_v2_photo/welder_file/ndt_validity/'.$fileName;
					//     $this->ftp->upload($source, $destination);
					//     $this->ftp->close();
					//     @unlink($source);
					// }  else { 
					//     $destination_source      = 'pcms_v2_photo';
					//     $source                  = 'upload/wps/'.$fileName;
					//     $destination             = '/var/www/'.$destination_source.'/welder_file/ndt_validity/'.$fileName;
					//     $sftp->put($destination , $source, NET_SFTP_LOCAL_FILE);
					//     @unlink($source);
					// }
					require_once(APPPATH . 'third_party/Net/SFTP.php');
					$ftp                        = $this->ftp;
					$sftp                       = new Net_SFTP($ftp['hostname']);
					$destination_source         = '/PCMS/pcms_v2/welder_attachment/ndt_validity/';

					if (!$sftp->login($ftp['username'], $ftp['password'])) {
						$this->session->set_flashdata('error', 'FTP Server Not Working');
						redirect($_SERVER['HTTP_REFERER']);
					}

					$filetype           = pathinfo($_FILES['ndt_val_3']['name'][$key]);
					$filetype           = $filetype['extension'];

					if ($filetype == "pdf") {

						$filename           = 'welder_attachment_ndt_val_3_' . uniqid() . '_.' . $filetype;
						$attach_line_name   = $filename;
						$filepath           = 'upload/';
						move_uploaded_file($_FILES['ndt_val_3']['tmp_name'][$key], $filepath . $attach_line_name);
						$fileName                 = $attach_line_name;
						$source                   = $filepath . $attach_line_name;
						$destination              = $destination_source . $attach_line_name;
						$sftp->put($destination, $source, NET_SFTP_LOCAL_FILE);
						// @unlink($source);

					} else {
						$this->session->set_flashdata('error', 'Only For PDF File..!');
						redirect($_SERVER['HTTP_REFERER']);
					}

					$ndt_val_3 = $filename;
				}

				// ----------- Start - Process Update Main Welder Data  ------------- //

				if ($_FILES['ndt_val_1']['name'][$key] != "" or $_FILES['ndt_val_2']['name'][$key] != "" or $_FILES['ndt_val_3']['name'][$key] != "") {
					$form_data = [
						"welder_code"     => $welder_code[$key],
						"rwe_code"        => $rwe_code[$key],
						"company_id"      => $company[$key],
						"project_id"      => $project_id[$key],
						"welder_badge"    => $welder_badge[$key],
						"bank_data_badge" => $bank_data_badge[$key],
						"welder_name"     => $welder_name[$key],
						// "cwm"             => $cwm[$key],
						"discipline"      => $discipline[$key],
						"wps_welder"      => implode(";", $wps_welder[$key]),
						// "vsd"             => $vsd[$key],
						// "ved"             => $ved[$key],
						"attachment"      => $attachment_1,
						"ndt_val_1"       => $ndt_val_1,
						"ndt_val_2"       => $ndt_val_2,
						"ndt_val_3"       => $ndt_val_3,
						"status_actived"  => $status_actived[$key],
						"non_active_by"   => $this->user_cookie[0],
						"non_active_date" => $non_active_date[$key],
					];
				} else {
					$form_data = [
						"welder_code"     => $welder_code[$key],
						"rwe_code"        => $rwe_code[$key],
						"company_id"      => $company[$key],
						"project_id"      => $project_id[$key],
						"welder_badge"    => $welder_badge[$key],
						"bank_data_badge" => $bank_data_badge[$key],
						"welder_name"     => $welder_name[$key],
						// "cwm"             => $cwm[$key],
						"discipline"      => $discipline[$key],
						"wps_welder"      => implode(";", $wps_welder[$key]),

						// "vsd"             => $vsd[$key],
						// "ved"             => $ved[$key],
						"status_actived"  => $status_actived[$key],
						"non_active_by"   => $this->user_cookie[0],
						"non_active_date" => $non_active_date[$key],
					];
				}

				$where['id_welder'] = $id_welder_main[$key];
				$insert_welder  = $this->m_welder_mod->update_welder($form_data, $where);
				unset($form_data, $where);

				// ----------- End - Process Update Main Welder Data  ------------- //

				// ----------- Start - Process Update Detail Welder Data  ------------- //

				$no = 1;
				foreach ($id_req[$key] as $k => $v) {


					$dataftp_detail  = $this->general_mod->ftp_find_master_with_condition($_SERVER["SERVER_ADDR"], "10.5.252.116/pcms_v2_photo");

					if ($_FILES['attachment_detail']['name'][$key][$k] != "") {

						// $attachment_detail             = uniqid().'_Welder_'.$_FILES['attachment_detail']['name'][$key][$k];
						// $attachment_detail             = str_replace(" ","_", $attachment_detail);
						// $attachment_detail             = str_replace("#","_", $attachment_detail);
						// $filepath                 = 'upload/wps/';
						// move_uploaded_file($_FILES['attachment_detail']['tmp_name'][$key][$k], $filepath.$attachment_detail);

						// require_once(APPPATH.'third_party/Net/SFTP.php');

						// $sftp                     = new Net_SFTP($dataftp_detail[0]['hostname']);
						// $fileName                 = $attachment_detail;

						// if (!$sftp->login($dataftp_detail[0]['username'], $dataftp_detail[0]['password'])) {
						//     $this->load->library('ftp');
						//     $source                 = 'upload/wps/'.$fileName;
						//     $ftp_config['hostname'] = $dataftp_detail[0]['hostname']; 
						//     $ftp_config['username'] = $dataftp_detail[0]['username'];
						//     $ftp_config['password'] = $dataftp_detail[0]['password'];
						//     $ftp_config['debug']    = TRUE;

						//     $this->ftp->connect($ftp_config);
						//     $destination            = 'pcms_v2_photo/welder_file/'.$fileName;
						//     $this->ftp->upload($source, $destination);
						//     $this->ftp->close();
						//     @unlink($source);
						// }  else { 
						//     $destination_source      = 'pcms_v2_photo';
						//     $source                  = 'upload/wps/'.$fileName;
						//     $destination             = '/var/www/'.$destination_source.'/welder_file/'.$fileName;
						//     $sftp->put($destination , $source, NET_SFTP_LOCAL_FILE);
						//     @unlink($source);
						// }

						require_once(APPPATH . 'third_party/Net/SFTP.php');
						$ftp                        = $this->ftp;
						$sftp                       = new Net_SFTP($ftp['hostname']);
						$destination_source         = '/PCMS/pcms_v2/welder_attachment/';

						if (!$sftp->login($ftp['username'], $ftp['password'])) {
							$this->session->set_flashdata('error', 'FTP Server Not Working');
							redirect($_SERVER['HTTP_REFERER']);
						}

						$filetype           = pathinfo($_FILES['attachment_detail']['name'][$key][$k]);
						$filetype           = $filetype['extension'];

						if ($filetype == "pdf") {

							$filename           = 'welder_attachment_detail_' . uniqid() . '_.' . $filetype;
							$attach_line_name   = $filename;
							$filepath           = 'upload/';
							move_uploaded_file($_FILES['attachment_detail']['tmp_name'][$key][$k], $filepath . $attach_line_name);
							$fileName                 = $attach_line_name;
							$source                   = $filepath . $attach_line_name;
							$destination              = $destination_source . $attach_line_name;
							$sftp->put($destination, $source, NET_SFTP_LOCAL_FILE);
							// @unlink($source);

						} else {
							$this->session->set_flashdata('error', 'Only For PDF File..!');
							redirect($_SERVER['HTTP_REFERER']);
						}

						$attachment_detail = $filename;
					} else {

						$attachment_detail = null;
					}



					$position_save = implode(",", $welder_position[$key][$no]);
					$f_no_save = implode(",", $f_no[$key][$no]);

					if ($id_req[$key][$k] == "new_row") {

						if (isset($attachment_detail)) {

							$form_data_req = [
								"id_welder"       => $id_welder_main[$key],
								"welder_process"  => $welder_process[$key][$k],
								"welder_position" => $position_save,
								"f_no"            => $f_no_save,
								"cwm"             => $cwm[$key][$k],
								"position_range"  => $position_range[$key][$k],
								"diameter_range"  => $diameter_range[$key][$k],
								"thickness_range" => $thickness_range[$key][$k],
								// "id_wps"      => intval($welder_wps[$key][$k]),
								"validity_start_date" => $validity_start_date[$key][$k] != "" ? $validity_start_date[$key][$k] : null,
								"validity_end_date" => $validity_end_date[$key][$k] != "" ? $validity_end_date[$key][$k] : null,
								"backing"         => $backing[$key][$k],
								"attachment"      => $attachment_detail,
								"create_by"       => $this->user_cookie[0],
								"create_date"     => date("Y-m-d H:i:s"),
							];
						} else {

							$form_data_req = [
								"id_welder"       => $id_welder_main[$key],
								"welder_process"  => $welder_process[$key][$k],
								"welder_position" => $position_save,
								"f_no"            => $f_no_save,
								"cwm"             => $cwm[$key][$k],
								"position_range"  => $position_range[$key][$k],
								"diameter_range"  => $diameter_range[$key][$k],
								"thickness_range" => $thickness_range[$key][$k],
								// "id_wps"      => intval($welder_wps[$key][$k]),
								"validity_start_date" => $validity_start_date[$key][$k] != "" ? $validity_start_date[$key][$k] : null,
								"validity_end_date" => $validity_end_date[$key][$k] != "" ? $validity_end_date[$key][$k] : null,
								"backing"         => $backing[$key][$k],
								"create_by"       => $this->user_cookie[0],
								"create_date"     => date("Y-m-d H:i:s"),
							];
						}

						$insert_welder_detail  =  $this->m_welder_mod->welder_new_req_process_db($form_data_req);
						unset($form_data_req);
					} else {

						if (isset($attachment_detail)) {

							$where['id_welder_detail'] = $id_req[$key][$k];
							$form_data_req = [
								"id_welder"       => $id_welder_main[$key],
								"welder_process"  => $welder_process[$key][$k],
								"welder_position" => $position_save,
								"f_no"            => $f_no_save,
								"cwm"             => $cwm[$key][$k],
								"position_range"  => $position_range[$key][$k],
								"diameter_range"  => $diameter_range[$key][$k],
								"thickness_range" => $thickness_range[$key][$k],
								"id_wps"      => intval($welder_wps[$key][$k]),
								"validity_start_date" => $validity_start_date[$key][$k] != "" ? $validity_start_date[$key][$k] : null,
								"validity_end_date" => $validity_end_date[$key][$k] != "" ? $validity_end_date[$key][$k] : null,
								"backing"         => $backing[$key][$k],
								"attachment" => $attachment_detail,
							];
						} else {

							$where['id_welder_detail'] = $id_req[$key][$k];
							$form_data_req = [
								"id_welder"       => $id_welder_main[$key],
								"welder_process"  => $welder_process[$key][$k],
								"welder_position" => $position_save,
								"f_no"            => $f_no_save,
								"cwm"             => $cwm[$key][$k],
								"position_range"  => $position_range[$key][$k],
								"diameter_range"  => $diameter_range[$key][$k],
								"thickness_range" => $thickness_range[$key][$k],
								"id_wps"      => intval($welder_wps[$key][$k]),
								"validity_start_date" => $validity_start_date[$key][$k] != "" ? $validity_start_date[$key][$k] : null,
								"validity_end_date" => $validity_end_date[$key][$k] != "" ? $validity_end_date[$key][$k] : null,
								"backing"         => $backing[$key][$k],
							];
						}

						$insert_welder_detail  = $this->m_welder_mod->update_welder_detail($form_data_req, $where);
						unset($form_data, $where);
					}

					// ----------- End - Process Update Detail Welder Data  ------------- //

					$no++;
				}
			}
		}

		$this->session->set_flashdata('success', 'New Welder are created!');
		redirect($_SERVER["HTTP_REFERER"]);
	}



	public function welder_update_pages($id = null)
	{

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['id']] = $value;
		}
		$data['discipline_list'] = $discipline_list;

		$datadb = $this->general_mod->master_welder_process();
		$welder_process_list = [];
		foreach ($datadb as $key => $value) {
			$welder_process_list[$value['id']] = $value;
		}
		$data['welder_process_list'] = $welder_process_list;

		$id = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
		$welder_list = $this->m_welder_mod->welder_list(["id_welder" => $id,]);
		$data['welder_list']      = $welder_list;

		$datadb = $this->general_mod->company();
		$company_list = [];
		foreach ($datadb as $key => $value) {
			$company[$value['id_company']] = $value;
		}
		$data['company_list'] = $company;

		$datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['id']] = $value;
		}
		$data['project_list'] = $project_list;

		$detail_list = $this->m_welder_mod->welder_detail_list(["id_welder" => $id,]);
		foreach ($detail_list as $key => $value) {
			$data['welder_detail_list'][$value['id_welder']][] = $value;
		}

		$order_by                     = "id_main ASC, id ASC";
		$where['status_delete']       = 1;
		$master_welder_req            = $this->m_welder_mod->master_welder_req_list($where, $order_by);
		unset($where);

		foreach ($master_welder_req as $value) {
			$data['master_req'][$value['initial_main']][] = $value;
		}

		$data['discipline_list']      = $this->general_mod->discipline();
		$data['wps_list']             = $this->general_mod->master_wps_new();

		$data['sidebar']      = $this->sidebar;
		$data['meta_title']   = 'Welder Update';
		$data['subview']      = 'master/welder/welder_update';
		// $data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
	}


	public function delete_detail_welder()
	{
		$id_welder_detail           = $this->input->post('id_welder_detail');
		$where['id_welder_detail']  = $id_welder_detail;
		$this->m_welder_mod->delete_detail_welder($where);
		unset($where);

		echo json_encode([
			'success'     => true
		]);
	}


	public function check_welder_register($welder_no, $status = null)
	{

		if (isset($status)) {

			$where_no['welder_code'] = $welder_no;
			$database = $this->m_welder_mod->welder_list($where_no);
			unset($where_no);

			if (sizeof($database) > 0) {
				if ($status == $database[0]['id_welder']) {
					echo json_encode(0);
				} else {
					echo json_encode(1);
				}
			} else {
				$where_no['welder_code'] = $welder_no;
				$databasex = $this->m_welder_mod->welder_list($where_no);
				echo json_encode(sizeof($databasex));
				unset($where_no);
			}
		} else {

			$where_no['welder_code'] = $welder_no;
			$database = $this->m_welder_mod->welder_list($where_no);
			echo json_encode(sizeof($database));
			unset($where_no);
		}
	}

	public function check_welder_badge($welder_no, $status = null, $wel_code = null)
	{

		if (isset($status)) {

			$where_no['welder_code']  = $wel_code;
			$where_no['welder_badge'] = $welder_no;
			$database = $this->m_welder_mod->welder_list($where_no);
			unset($where_no);

			if (sizeof($database) > 0) {
				if ($status == $database[0]['id_welder']) {
					echo json_encode(0);
				} else {
					echo json_encode(1);
				}
			} else {
				$where_no['welder_code']  = $wel_code;
				$where_no['welder_badge'] = $welder_no;
				$databasex = $this->m_welder_mod->welder_list($where_no);
				echo json_encode(sizeof($databasex));
				unset($where_no);
			}
		} else {
			$where_no['welder_code']  = $wel_code;
			$where_no['welder_badge'] = $welder_no;
			$database = $this->m_welder_mod->welder_list($where_no);
			echo json_encode(sizeof($database));
			unset($where_no);
		}
	}

	public function delete_detail_attachment()
	{

		$id_welder_detail = $this->input->post("id_welder_detail");

		$where['id_welder_detail'] = $id_welder_detail;
		$form_data_req = ["attachment" => null,];

		$insert_welder_detail  = $this->m_welder_mod->update_welder_detail($form_data_req, $where);
		unset($form_data, $where);

		echo json_encode([
			'success'     => true
		]);
	}


	public function delete_ndt_validity()
	{

		$id_welder = $this->input->post("id_welder");
		$col_id    = $this->input->post("col_id");
		$filename  = $this->input->post("filename");

		$where['id_welder'] = $id_welder;
		if ($col_id == "1") {
			$form_data_req = ["ndt_val_1" => null,];
		} else if ($col_id == "2") {
			$form_data_req = ["ndt_val_2" => null,];
		} else if ($col_id == "3") {
			$form_data_req = ["ndt_val_3" => null,];
		}
		$udpate_welder  = $this->m_welder_mod->update_welder($form_data_req, $where);
		unset($form_data, $where);

		echo json_encode([
			'success'     => true
		]);
	}

	public function generated_qr_code($id_bank_data)
	{

		$id_bank_data = $this->encryption->decrypt(strtr($id_bank_data, '.-~', '+=/'));

		$where_bank_data['data_id'] = $id_bank_data;
		$bank_data_result       = $this->m_welder_mod->bankdata_list($where_bank_data);
		unset($where_bank_data);

		$links = getenv('LINK_ISS_OUTSIDE') . "/public_iss/detail_training_qr/" . $id_bank_data;
		$file_name = $bank_data_result[0]["badge_id"] . "_" . $bank_data_result[0]["nama"];

		if ($bank_data_result[0]['type'] > 0) {
			$file_name = $bank_data_result[0]["register_id"] . "_" . $bank_data_result[0]["nama"];
		}

		// $this->load->library('ciqrcode');

		// $filename           = $file_name . '.png';
		// $params['data']     = $links;
		// $params['level']    = 'H';
		// $params['size']     = 12;
		// $params['savename'] = 'file/welder_qr/' . $filename;
		// $this->ciqrcode->generate($params);
		// $redirect_link      = base_url() . $params['savename'];
		// $filePath           = $params['savename'];

    $this->load->library('ciqrcode');
    $filename           = $file_name . '.png';
    $params['data']     = $links;
    $params['level']    = 'H';
    $params['size']     = 12;

    // Capture the output buffer
    ob_start();
    $this->ciqrcode->generate($params);
    $image_data = ob_get_contents();
    ob_end_clean();

    // Convert the image data to base64
    $base64_image       = base64_encode($image_data);
    $image_data         = base64_decode($base64_image);

		require_once(APPPATH . 'third_party/Net/SFTP.php');

		$ftp                        = $this->ftp;
		$sftp                       = new Net_SFTP($ftp['hostname']);
		$destination_source         = '/PCMS/pcms_v2/qr_code/';


		if (!$sftp->login($ftp['username'], $ftp['password'])) {
			$this->session->set_flashdata('error', 'FTP Server Not Working');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$destination                = $destination_source . $filename;

		// $sftp->put($destination, $filePath, NET_SFTP_LOCAL_FILE);
		$sftp->put($destination, $image_data);
		// @unlink($filePath);

		$encrypt_filename             = strtr($this->encryption->encrypt($filename), '+=/', '.-~');
		$encrypt_filepath             = strtr($this->encryption->encrypt($destination_source), '+=/', '.-~');

		$action                       = "download";

		open_file_sync($encrypt_filename, $encrypt_filepath, $action);


		// if(file_exists($filePath)) {
		//     $fileName = basename($filePath);
		//     $fileSize = filesize($filePath);

		//     // Output headers.
		//     header("Cache-Control: private");
		//     header("Content-Type: application/stream");
		//     header("Content-Length: ".$fileSize);
		//     header("Content-Disposition: attachment; filename=".$fileName);

		//     // Output file.
		//     readfile ($filePath);                   
		//     exit();
		// }
		// else {
		//     die('The provided file path is not valid.');
		// }

	}

	// public function welder_performance($download = null,$project_id = null,$company_id = null){

	//   error_reporting(0);

	//   $data['post'] = $this->input->post();

	//   $datadb = $this->general_mod->master_welder_process();
	//   $welder_process_list = [];
	//   foreach ($datadb as $key => $value) {
	//     $welder_process_list[$value['id']] = $value;
	//   }
	//   $data['welder_process_list'] = $welder_process_list;

	//   $project_list = $this->general_mod->project();
	//   foreach($project_list as $value) {
	//     $data['project'][$value['id']]  = $value;
	//   }

	//   $where        = null;
	//   if(!$this->is_admin) {
	//     $where[implode_where("id", $this->project_alt)] = null;
	//   }

	//   $datadb = $this->general_mod->project($where);
	//   unset($where);
	// 	$project_list = [];
	// 	foreach ($datadb as $key => $value) {
	// 		$project_list[$value['project_code']] = $value;
	// 		$data['project_code'][$value['id']] = $value['project_code'];
	// 	}
	// 	$data['project_list'] = $project_list;

	//   $where    = null;
	//   if(!$this->is_admin) {
	//     $where[implode_where("id_company", $this->company_alt)] = null;
	//   }
	//   $datadb = $this->general_mod->company($where);
	//   unset($where);

	//   $company_list = [];
	//   foreach($datadb as $key => $value){
	//     $company[$value['id_company']] = $value;
	//   } 
	//   $data['company_list'] = $company;

	//   $datadb = $this->general_mod->master_ctq();
	//   $master_ctq = [];
	//   foreach($datadb as $key => $value){
	//     $master_ctq[$value['id']] = $value;
	//   } 
	//   $data['master_ctq'] = $master_ctq;

	//   // ----------------------- Source Data Visual --------------------------------- //

	//   if($data['post']["filter_date"] == '1'){
	//     if(isset($data["post"]['start_date']) AND !empty($data["post"]['start_date']) AND isset($data["post"]['end_date']) AND !empty($data["post"]['end_date'])){
	//       $where["date(a.weld_datetime) BETWEEN '".$data["post"]['start_date']."' AND '".$data["post"]['end_date']."'"]  = NULL;
	//     }
	//   } else if($data['post']["filter_date"] == '0'){
	//     if(isset($data["post"]['start_date']) AND !empty($data["post"]['start_date']) AND isset($data["post"]['end_date']) AND !empty($data["post"]['end_date'])){
	//       $where["date(b.date_of_inspection) BETWEEN '".$data["post"]['start_date']."' AND '".$data["post"]['end_date']."'"]  = NULL;
	//     }
	//   }

	//   //$where["a.status_delete IS NULL"]  = null;
	//   //$where["a.retransmitt_status = 0"] = null;
	//   $where["b.tested_length IS NOT NULL"] = null;
	//   $where["b.result NOT IN (0,4)"] = null;
	//   $where["b.ndt_type IN(1,3)"]  = null;
	//     $data['visual_data'] = $this->m_welder_mod->get_visual_data_all($where);   
	//     unset($where);    
	//     foreach ($data['visual_data'] as $key => $value) {  
	//           $data_wl[] = array(
	//               "weld_id"           => $value["welder_ref_fc"].";".$value["welder_ref_rh"], 
	//               "id_ndt"            => $value["id_ndt"], 
	//               "weld_length"       => $value["length_of_weld"], 
	//               "ndt_status"        => $value["ndt_result"], 
	//               "ndt_tested_length" => $value["ndt_tested_length"], 
	//               "id_visual"         => $value["id_visual"], 
	//           );       
	//     }
	//   // ----------------------- Source Data Visual --------------------------------- //
	//    //test_var($data_wl);
	//   // ----------------------- Source Data CTQ NDT --------------------------------- //

	//   if($data['post']["filter_date"] == '1'){
	//     if(isset($data["post"]['start_date']) AND !empty($data["post"]['start_date']) AND isset($data["post"]['end_date']) AND !empty($data["post"]['end_date'])){
	//       $where["date(d.weld_datetime) BETWEEN '".$data["post"]['start_date']."' AND '".$data["post"]['end_date']."'"]  = NULL;
	//     }
	//   } else if($data['post']["filter_date"] == '0'){
	//     if(isset($data["post"]['start_date']) AND !empty($data["post"]['start_date']) AND isset($data["post"]['end_date']) AND !empty($data["post"]['end_date'])){
	//       $where["date(c.date_of_inspection) BETWEEN '".$data["post"]['start_date']."' AND '".$data["post"]['end_date']."'"]  = NULL;
	//     }
	//   }

	//     $where['welder IS NOT NULL'] = null;
	//     $where['c.ndt_type in (1,3)'] = null;
	//     $where["c.result NOT IN (0,4)"] = null;
	//     $data['ctq_data_list'] = $this->m_welder_mod->get_detail_data_ctq($where);   
	//     unset($where);    
	//     foreach ($data['ctq_data_list'] as $key => $value) {  
	//           $data_ctq[] = array(
	//               "welder_id"         => $value["welder"], 
	//               "ctq_id"            => $value["ctq_id"], 
	//               "ctq_length"        => $value["length"]
	//           );       
	//     }

	//   //  test_var($data['ctq_data_list']);


	//   // ----------------------- Source Data CTQ NDT --------------------------------- //
	//   foreach ($data_ctq as $key => $value) {

	//     $create_arr_welder_ctq = explode(";",$value['welder_id']);
	//     $remove_zero_ctq       = array_filter($create_arr_welder_ctq);
	//     $total_welder_ctq      = sizeof($remove_zero_ctq);     
	//     $xdata_ctq[]           = $total_welder_ctq;
	//     $divide_weld_total_ctq[$key] = $value['ctq_length'] /  $total_welder_ctq; 

	//     $data_sum_all_ctq[] = array(
	//       "welder_id" => $remove_zero_ctq,
	//       "total_welder" => $total_welder_ctq,
	//       "weld_length" => $value["ctq_length"], 
	//       "result_divide" => $divide_weld_total_ctq[$key], 
	//     ); 

	//     foreach($remove_zero_ctq as $kw => $vl){
	//         $wl_id_ctq[] = array(
	//           "welder_id" => $vl,
	//           "ctq_id" => $value["ctq_id"],
	//           "result_divide" => $divide_weld_total_ctq[$key]
	//         );
	//     }  

	//   }

	//   $sums_ctq         = [];
	//   $count_ctq        = [];
	//   foreach($wl_id_ctq as $key => $value) {
	//       if(!isset($sums_ctq[$value['welder_id']][$value['ctq_id']])) {
	//           $sums_ctq[$value['welder_id']][$value['ctq_id']] = 0;
	//       }    
	//       $sums_ctq[$value['welder_id']][$value['ctq_id']] += $value['result_divide'];
	//   }
	//   foreach($wl_id_ctq as $key => $value) {
	//     $data_final_a_ctq[] = array(
	//       "weld_id"       => $value['welder_id'],
	//       "ctq_id"        => $value['ctq_id'],
	//       "total_length"  => $sums_ctq[$value['welder_id']][$value['ctq_id']]
	//     );
	//   }

	//   foreach($data_final_a_ctq as $key => $value){
	//     $data['ctq_length_data'][$value['weld_id']][$value['ctq_id']] = $value;
	//   }

	//   // ----------------------- Source Data CTQ NDT --------------------------------- //
	//   // ----------------------- Search Total Joint Welded and Total Welded Length --------------------------------- //

	//     foreach ($data_wl as $key => $value) {
	//         $create_arr_welder = explode(";",$value['weld_id']);
	//         $remove_zero       =  array_filter($create_arr_welder);
	//         $total_welder      = sizeof($remove_zero);
	//         $xdata[] = $total_welder;
	//         // $divide_weld_total[$key] = $value['weld_length'] /  $total_welder;
	//         $divide_weld_total[$key] = $value['weld_length'];
	//         if(isset($value['ndt_tested_length'])){
	//           // $divide_weld_tested_total[$key] = $value['ndt_tested_length'] /  $total_welder;
	//           $divide_weld_tested_total[$key] = $value['ndt_tested_length'];
	//         } else {
	//           $divide_weld_tested_total[$key] = 0; 
	//         }

	//         $data_sum_all[] = array(
	//           "welder_id" => $remove_zero,
	//           "total_welder" => $total_welder,
	//           "weld_length" => $value["weld_length"], 
	//           "result_divide" => $divide_weld_total[$key], 
	//           "ndt_tested_length" =>  $value['ndt_tested_length'] , 
	//           "result_divide_tested" => $divide_weld_tested_total[$key], 
	//         );        
	//         foreach($remove_zero as $kw => $vl){
	//             $wl_id[] = array(
	//               "welder_id" => $vl,
	//               "result_divide" => $divide_weld_total[$key],
	//               "result_divide_tested" => $divide_weld_tested_total[$key],
	//             );

	//             if($divide_weld_tested_total[$key] > 0){
	//               $wl_id_tested[] = array(
	//                 "welder_id" => $vl,
	//                 "result_divide" => $divide_weld_total[$key],
	//                 "result_divide_tested" => $divide_weld_tested_total[$key],
	//                 "id_visual" => $value['id_visual'],
	//                 "id_ndt" => $value['id_ndt'],
	//               );
	//             }
	//         }        
	//     }
	//     //test_var($total_reject_ndt);
	//     //test_var($wl_id_tested);

	//     $sums         = [];
	//     $count        = [];
	//     foreach($wl_id as $key => $value) {
	//         if(!isSet($sums[$value['welder_id']])) {
	//             $sums[$value['welder_id']] = 0;
	//         }
	//         if(!isSet($count[$value['welder_id']])) {
	//           $count[$value['welder_id']] = 0;
	//         }      
	//         $sums[$value['welder_id']] += $value['result_divide'];
	//         $count[$value['welder_id']] += 1;
	//     }
	//     foreach($wl_id as $key => $value) {
	//       $data_final_a[] = array(
	//         "weld_id"       => $value['welder_id'],
	//         "total_joint"   => $count[$value['welder_id']],
	//         "total_length"  => $sums[$value['welder_id']]
	//       );
	//     }   
	//     foreach($data_final_a as $key => $value){
	//       $data['joint_welded'][$value['weld_id']] = $value;
	//     }

	//     $data_input_wl_id_tested = array_values(array_unique($wl_id_tested, SORT_REGULAR));

	//     //test_var($data_input_wl_id_tested);

	//     $sums_tested  = [];
	//     $count_tested = [];
	//     foreach($data_input_wl_id_tested as $key => $value) {         
	//         if(!isSet($sums_tested[$value['welder_id']])) {
	//           $sums_tested[$value['welder_id']] = 0;
	//         }
	//         if(!isSet($count_tested[$value['welder_id']])) {
	//           $count_tested[$value['welder_id']] = 0;
	//         }      
	//         $sums_tested[$value['welder_id']] += $value['result_divide_tested'];
	//         $count_tested[$value['welder_id']] += 1;
	//     }
	//     foreach($data_input_wl_id_tested as $key => $value) {
	//       $data_final_b[] = array(
	//         "weld_id"       => $value['welder_id'],
	//         "total_joint_tested"   => $count_tested[$value['welder_id']],
	//         "total_length_tested"  => $sums_tested[$value['welder_id']]
	//       );
	//     }   

	//     //test_var($data_final_b);

	//     foreach($data_final_b as $key => $value){
	//       $data['joint_tested'][$value['weld_id']] = $value;
	//     }
	//   // ----------------------- Search Total Joint Welded and Total Welded Length --------------------------------- //

	//   // ----------------------- Get data NDT Rejected --------------------------------- //
	//     if($data['post']["filter_date"] == '1'){
	//       if(isset($data["post"]['start_date']) AND !empty($data["post"]['start_date']) AND isset($data["post"]['end_date']) AND !empty($data["post"]['end_date'])){
	//         $where["date(c.weld_datetime) BETWEEN '".$data["post"]['start_date']."' AND '".$data["post"]['end_date']."'"]  = NULL;
	//       }
	//     } else if($data['post']["filter_date"] == '0'){
	//       if(isset($data["post"]['start_date']) AND !empty($data["post"]['start_date']) AND isset($data["post"]['end_date']) AND !empty($data["post"]['end_date'])){
	//         $where["date(a.date_of_inspection) BETWEEN '".$data["post"]['start_date']."' AND '".$data["post"]['end_date']."'"]  = NULL;
	//       }
	//     }
	//     $where['a.result']   = 2;
	//     $where['a.ndt_type IN (1,3)']   = null;
	//     $data['ndt_data'] = $this->m_welder_mod->get_ndt_data($where);   
	//     unset($where);    

	//     foreach($data['ndt_data'] as $key => $value){
	//       $dt_rndt[] = array(
	//         "submission_id"    => $value['submission_id'], 
	//         "welder_reject"    => $value['welder'], 
	//         "length_reject"    => $value["length"], 
	//       );       
	//     }

	//     foreach ($dt_rndt as $key => $value) {
	//       $create_arr_welder_reject       = explode(";",$value['welder_reject']);
	//       $remove_zero_reject_list        = array_filter($create_arr_welder_reject);
	//       $total_welder_reject            = sizeof($remove_zero_reject_list);
	//       $xdata_reject[]                 = $total_welder_reject;
	//       $divide_weld_total_reject[$key] = $value['length_reject'] /  $total_welder_reject;

	//       $data_sum_all_reject[] = array(
	//         "welder_id"     => $remove_zero,
	//         "total_welder"  => $total_welder,
	//         "weld_length"   => $value["length_reject"], 
	//         "result_divide" => (isset($divide_weld_total[$key]) ? $divide_weld_total[$key] : 0), 
	//       );        
	//       foreach($remove_zero_reject_list as $kw => $vl){
	//           $wl_id_reject[] = array(
	//             "submission_id"  => $value["submission_id"], 
	//             "welder_id"      => $vl,
	//             "result_divide"  => $divide_weld_total_reject[$key],
	//           );

	//           $wl_id_reject_joint[] = array(
	//             "submission_id"  => $value["submission_id"], 
	//             "welder_id"      => $vl,
	//           );
	//       }        
	//     }

	//     $sums_reject         = [];
	//     foreach($wl_id_reject as $key => $value) {
	//         if(!isSet($sums_reject[$value['welder_id']])) {
	//             $sums_reject[$value['welder_id']] = 0;
	//         }              
	//         $sums_reject[$value['welder_id']] += $value['result_divide'];         
	//     } 

	//     $data_length = array();
	//     foreach($wl_id_reject as $key => $value) {
	//         if(!isset($data_length[$value['welder_id']])){
	//           $data_length[$value['welder_id']] = 0;
	//         }     
	//         $data_length[$value['welder_id']] += $value['result_divide'];
	//     }

	//     $data_count_joint = array_values(array_unique($wl_id_reject_joint, SORT_REGULAR));
	//     $data_joint = array();
	//     foreach($data_count_joint as $key => $value) {      
	//         if(!isset($data_joint[$value['submission_id']][$value['welder_id']])){
	//           $data_joint[$value['submission_id']][$value['welder_id']] = 0;
	//         }       
	//         $data_joint[$value['submission_id']][$value['welder_id']] += 1;
	//     }

	//     $data_joint_reject = array();
	//     foreach($data_count_joint as $key => $value) {      
	//         if(!isset($data_joint_reject[$value['welder_id']])){
	//           $data_joint_reject[$value['welder_id']] = 0;
	//         }       
	//         $data_joint_reject[$value['welder_id']] += 1;
	//     }


	//     foreach($wl_id_reject as $key => $value) {
	//       $data_final_c[] = array(
	//         "welder_id"     => $value['welder_id'],
	//         "total_length"  => $data_length[$value['welder_id']],
	//         // "total_joint"   => $data_joint[$value['submission_id']][$value['welder_id']],
	//         "total_joint"   => $data_joint_reject[$value['welder_id']],
	//       );
	//     }

	//     $data_final_ndt_reject = array_values(array_unique($data_final_c, SORT_REGULAR));

	//     foreach($data_final_ndt_reject as $key => $value){
	//       $data['joint_reject_ndt'][$value['welder_id']] = $value;
	//     }


	//   // ----------------------- Get data NDT Rejected --------------------------------- //

	//     // $where['project_id'] = (isset($data['post']['project']) && !empty($data['post']['project']) ? $data['post']['project'] : $this->user_cookie[10]);
	//     // $where['company_id'] = (isset($data['post']['company']) && !empty(@$data['post']['company']) ? $data['post']['company'] : "1");


	//     $project_post     = $this->input->post('project');
	//     $company_id_post  = $this->input->post('company');

	//     if($project_post != "") {
	//       $where['project_id']  = $project_post;
	//     } else {
	//       if(!$this->is_admin) {
	//         $where[implode_where("project_id", $this->project_alt)] = null;
	//       }
	//     }

	//     if($company_id_post != "") {
	//       $where['company_id']  = $company_id_post;
	//     } else {
	//       if(!$this->is_admin) {
	//         $where[implode_where("company_id", $this->company_alt)] = null;
	//       }
	//     }

	//     $where['status_actived'] = "1";
	//     $welder_list = $this->m_welder_mod->welder_list($where);
	//     $data['welder_list'] = $welder_list;

	//     $detail_list = $this->m_welder_mod->welder_detail_list();
	//     foreach($detail_list as $key => $value){
	//       $data['welder_detail_list'][$value['id_welder']][] = $value;
	//     }

	//     $data['sidebar']      = $this->sidebar;
	//     $data['meta_title'] = 'Welder Performance';
	//     if(isset($data['post']['button_excel']) && !empty($data['post']['button_excel'])){
	//       $data['subview']  = 'master/welder/welder_performance_xls';
	//       $this->load->view($data['subview'], $data);
	//     } else {
	//       $data['subview']  = 'master/welder/welder_performance';
	//       $this->load->view('index', $data);
	//     }


	// }


	public function welder_list_cheker()
	{

		$where['status_actived'] = "1";
		$welder_list = $this->m_welder_mod->welder_list();
		unset($where);
		$data['welder_list'] = $welder_list;

		$today = date("Y-m-d");
		$today_save = date("Y-m-d H:i:s");

		foreach ($data['welder_list'] as $key => $value) {

			if ($today > $value['ved'] and $value['status_actived'] == 1) {
				$formdata = array(
					"status_actived" => "0",
					"auto_expired_date" => $today_save,
					"remarks_auto_disabled" => "Expired",
				);
			} else {
				$formdata = array(
					"auto_expired_date" => null,
					"remarks_auto_disabled" => null,
				);
			}
			$where['id_welder'] = $value['id_welder'];
			$this->m_welder_mod->welder_update_process_db($formdata, $where);
			unset($formdata);
			unset($where);
		}
	}

	public function welder_perform_audit($welder_id = null, $start_date = null, $end_date = null, $filter_date = null)
	{
		error_reporting(0);

		$welder_id     = $this->encryption->decrypt(strtr($welder_id, '.-~', '+=/'));
		$start_date    = $this->encryption->decrypt(strtr($start_date, '.-~', '+=/'));
		$end_date      = $this->encryption->decrypt(strtr($end_date, '.-~', '+=/'));
		$filter_date   = $this->encryption->decrypt(strtr($filter_date, '.-~', '+=/'));

		$datadb = $this->general_mod->master_welder_process();
		$welder_process_list = [];
		foreach ($datadb as $key => $value) {
			$welder_process_list[$value['id']] = $value;
		}
		$data['welder_process_list'] = $welder_process_list;

		$project_list = $this->general_mod->project();
		foreach ($project_list as $value) {
			$data['project'][$value['id']]  = $value;
		}

		$datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['project_code']] = $value;
			$data['project_code'][$value['id']] = $value['project_code'];
		}
		$data['project_list'] = $project_list;

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['initial']] = $value;
			$data['discipline_list_data'][$value['id']] = $value;
			$data['discipline_code'][$value['id']] = $value['initial'];
		}
		$data['discipline_list'] = $discipline_list;

		$datadb = $this->visual_mod->master_welder_new();
		foreach ($datadb as $key => $value) {
			$data["master_welder"][$value['id_welder']] = $value;
		}

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
			$data['type_of_module_code'][$value['id']] = $value['code'];
		}
		$data['type_of_module_list'] = $type_of_module_list;

		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['mod_id']] = $value;
			$data['module_code'][$value['mod_id']] = $value['mod_desc'];
		}
		$data['module_list'] = $module_list;

		$datadb = $this->general_mod->company();
		$company_list = [];
		foreach ($datadb as $key => $value) {
			$company[$value['id_company']] = $value;
		}
		$data['company_list'] = $company;

		$datadb = $this->general_mod->master_ctq();
		$master_ctq = [];
		foreach ($datadb as $key => $value) {
			$master_ctq[$value['id']] = $value;
		}
		$data['master_ctq'] = $master_ctq;

		$data['welder_id'] = $welder_id;

		$where['id_welder'] = $welder_id;
		$welder_list = $this->m_welder_mod->welder_list($where);
		$data['welder_list'] = $welder_list;
		unset($where);

		$where['badge_id']            = $data['welder_list'][0]['welder_badge'];
		$bankdata                     = $this->m_welder_mod->bankdata_list($where);
		unset($where);

		$data['prefix_bd']            = $bankdata[0]['register_id'] . ' / ' . $bankdata[0]['badge_id'] . ' / ' . $bankdata[0]['nama'];

		$where['badge']               = $data['welder_list'][0]['welder_badge'];
		$where['tr.status_delete']    = 1;
		$where['cat_cons']            = 3;
		$data['electrode']            = $this->m_welder_mod->summary_electrode($where);
		unset($where);

		// ----------------------- Source Data Visual --------------------------------- //
		if ($filter_date == "1") {
			if (isset($start_date) and !empty($start_date) and isset($end_date) and !empty($end_date)) {
				$where["date(a.weld_datetime) BETWEEN '" . $start_date . "' AND '" . $end_date . "'"]  = NULL;
			}
		} else if ($filter_date == "0") {
			if (isset($start_date) and !empty($start_date) and isset($end_date) and !empty($end_date)) {
				$where["date(b.date_of_inspection) BETWEEN '" . $start_date . "' AND '" . $end_date . "'"]  = NULL;
			}
		}
		// $where["(CONCAT(';', a.welder_ref_fc, ';') ILIKE '%;" . $welder_id . "%;' OR CONCAT(';', a.welder_ref_rh, ';') ILIKE '%;" . $welder_id . "%;')"] = null;
		$where["b.id_welder"] = $welder_id;
		$where["b.result NOT IN (0,4)"] = null;
		$where["b.tested_length IS NOT NULL"]  = null;
		$where["b.ndt_type IN(1,3)"]  = null;
		$where["b.status_inspection != 12"] = null;
		$visual_data                  = $this->m_welder_mod->get_visual_data_welder_reg($where);
		unset($where);

		if($visual_data) {
      $temp_key         = [];
      foreach($visual_data as $key => $value) {
        $key_loop       = $value['id_visual'].'_'.$value['ndt_type'];
        if(in_array($key_loop, $temp_key)) {
          continue;
        }
        $temp_key[]     = $key_loop;
        $data['visual_data'][$key]  = $value;
      }
      $data_ut_loop = array();
      $data_rt_loop = array();

      $list_id_visual         = [];

      foreach ($data['visual_data'] as $key => $value) {
        if ($value['ndt_type'] == '3') {
          $data_ut_loop[] = $value;
          $list_id_visual[] = $value['id_visual'];
        }

        if ($value['ndt_type'] == '1') {
          $data_rt_loop[] = $value;
          $list_id_visual[] = $value['id_visual'];
        }
      }

      $data['loop_ut'] = $data_ut_loop;
      $data['loop_rt'] = $data_rt_loop;

      // CHECK TOTAL WELDER PER VISUAL
      if($list_id_visual) {
        $where[implode_where("id_visual", $list_id_visual)] = null;
        $welder_visual    = $this->visual_mod->pcms_visual_detail_welder($where);
        unset($where);

        if($welder_visual) {
          $temp_wldr      = [];
          foreach($welder_visual as $value) {
            $data['welder_ref'][$value['id_visual']][$value['status_rh_fc']][] = $value['id_welder'];
            $key_wldr     = $value['id_visual'].'_'.$value['id_welder'];
            if(in_array($key_wldr, $temp_wldr)) {
              continue;
            }
            $temp_wldr[]  = $key_wldr;
            @$data['total_welder_vis'][$value['id_visual']] += 1;
          }
        }
      }

      // ----------------------- Source Data Visual --------------------------------- //

      // ----------------------- Source Template Joint --------------------------------- //

      $id_visual_in_attachment  = array_column($data['visual_data'], 'id_joint');
      $where = [
        "id IN (".join(", ", $id_visual_in_attachment).")" => NULL
      ];
      $data['temp_joint'] = $this->m_welder_mod->get_joint_data($where);
      unset($where);
      foreach ($data['temp_joint'] as $key => $value) {
        $data["temp_joint"][$value['id']] = $value;
      }

      // ----------------------- Source Template Joint --------------------------------- //

      //test_var($wl_id);
      // ----------------------- Source Data Attachment NDt --------------------------------- //

      $id_visual_in_attachment  = $list_id_visual;
      $where["a.id_visual IN ('" . implode("', '", $id_visual_in_attachment) . "')"] = NULL;
      $data['ndt_data_attachment'] = $this->m_welder_mod->get_ndt_attachment($where);
      unset($where);

      foreach ($data['ndt_data_attachment'] as $key => $value) {
        $data['ndt_attach_file'][$value['ndt_type']][$value['id_visual']][$value['id_ndt']]   = $value['filename'];
        $data['ndt_report_no'][$value['ndt_type']][$value['id_visual']][$value['id_ndt']]     = $value['report_number'];
        $data['ndt_detail'][$value['ndt_type']][$value['id_visual']]     = $value;
      }


      //test_var($data['ndt_data_attachment']);

      // ----------------------- Source Data Attachment NDt --------------------------------- //

      // ----------------------- Source Data CTQ NDT --------------------------------- //

      $id_visual_in  = $list_id_visual;
      $where["a.id_visual IN ('" . implode("', '", $id_visual_in) . "')"] = NULL;
      $where["a.tested_length IS NOT NULL"] = NULL;
      $where["a.result NOT IN (0,4)"] = NULL;
      $where["a.ndt_type IN (1,3)"] = NULL;
			$where["a.status_inspection != 12"] = null;
			$where["a.id_welder"]					= $welder_id;
      $data['ndt_data'] = $this->m_welder_mod->get_ndt_data($where);
      unset($where);

      foreach ($data['ndt_data'] as $key => $value) {
        $data['tested_length'][$value['ndt_type']][$value['id_visual']][$value['id_ndt']]   = $value['tested_length'];
        $data['rejected_length'][$value['ndt_type']][$value['id_visual']][$value['id_ndt']] = $value['length'];
      }

      foreach ($data['ndt_data'] as $key => $value) {
        $dt_rndt[] = array(
          "submission_id"    => $value['submission_id'],
          "id_visual"        => $value['id_visual'],
          "id_ndt"           => $value['id_ndt'],
          "ndt_type"         => $value['ndt_type'],
          "welder_reject"    => $value['welder'],
          "length_reject"    => $value["length"],
        );
      }

      foreach ($dt_rndt ?? [] as $key => $value) {
        $create_arr_welder_reject       = explode(";", $value['welder_reject']);
        $remove_zero_reject_list        = array_filter($create_arr_welder_reject);
        $total_welder_reject            = sizeof($remove_zero_reject_list);
        $xdata_reject[]                 = $total_welder_reject;
        if ($value['length_reject'] > 0) {
          $divide_weld_total_reject[$key] = $value['length_reject'] /  $total_welder_reject;
        } else {
          $divide_weld_total_reject[$key] = 0;
        }

        $data_sum_all_reject[] = array(
          "welder_id"     => $remove_zero_reject_list,
          "total_welder"  => $total_welder_reject,
          "ndt_type"      => $value["ndt_type"],
          "weld_length"   => $value["length_reject"],
          "result_divide" => $divide_weld_total_reject[$key],
        );

        foreach ($remove_zero_reject_list as $kw => $vl) {
          $wl_id_reject[] = array(
            "submission_id"  => $value["submission_id"],
            "id_visual"      => $value['id_visual'],
            "id_ndt"         => $value['id_ndt'],
            "welder_id"      => $vl,
            "ndt_type"       => $value["ndt_type"],
            "result_divide"  => $divide_weld_total_reject[$key],
          );

          $wl_id_reject_joint[] = array(
            "submission_id"  => $value["submission_id"],
            "id_visual"      => $value['id_visual'],
            "ndt_type"       => $value["ndt_type"],
            "welder_id"      => $vl,
          );
        }
      }

      $sums_reject         = [];
      foreach ($wl_id_reject ?? [] as $key => $value) {
        if (!isset($sums_reject[$value['ndt_type']][$value['id_visual']][$value['id_ndt']][$value['welder_id']])) {
          $sums_reject[$value['ndt_type']][$value['id_visual']][$value['id_ndt']][$value['welder_id']] = 0;
        }
        $sums_reject[$value['ndt_type']][$value['id_visual']][$value['id_ndt']][$value['welder_id']] += $value['result_divide'];
      }

      $data_length = array();
      foreach ($wl_id_reject ?? [] as $key => $value) {
        if (!isset($data_length[$value['ndt_type']][$value['id_visual']][$value['id_ndt']][$value['welder_id']])) {
          $data_length[$value['ndt_type']][$value['id_visual']][$value['id_ndt']][$value['welder_id']] = 0;
        }
        $data_length[$value['ndt_type']][$value['id_visual']][$value['id_ndt']][$value['welder_id']] += $value['result_divide'];
      }

      $data_count_joint = array_values(array_unique($wl_id_reject_joint ?? [], SORT_REGULAR));
      $data_joint = array();
      foreach ($data_count_joint as $key => $value) {
        if (!isset($data_joint[$value['ndt_type']][$value['submission_id']][$value['welder_id']])) {
          $data_joint[$value['ndt_type']][$value['submission_id']][$value['welder_id']] = 0;
        }
        $data_joint[$value['ndt_type']][$value['submission_id']][$value['welder_id']] += 1;
      }

      foreach ($wl_id_reject ?? [] as $key => $value) {
        $data_final_c[] = array(
          "id_visual"     => $value['id_visual'],
          "id_ndt"        => $value['id_ndt'],
          "ndt_type"      => $value['ndt_type'],
          "welder_id"     => $value['welder_id'],
          "total_length"  => $data_length[$value['ndt_type']][$value['id_visual']][$value['id_ndt']][$value['welder_id']],
          "total_joint"   => $data_joint[$value['ndt_type']][$value['submission_id']][$value['welder_id']],
        );
      }

      $data_final_ndt_reject = array_values(array_unique($data_final_c ?? [], SORT_REGULAR));

      foreach ($data_final_ndt_reject as $key => $value) {
        $data['joint_reject_ndt'][$value['ndt_type']][$value['welder_id']][$value['id_visual']][$value['id_ndt']] = $value;
      }

      // ----------------------- Source Data CTQ NDT --------------------------------- //

      // ----------------------- Source Data CTQ NDT --------------------------------- //
      if ($filter_date == "1") {
        if (isset($start_date) and !empty($start_date) and isset($end_date) and !empty($end_date)) {
          $where["date(d.weld_datetime) BETWEEN '" . $start_date . "' AND '" . $end_date . "'"]  = NULL;
        }
      } else if ($filter_date == "0") {
        if (isset($start_date) and !empty($start_date) and isset($end_date) and !empty($end_date)) {
          $where["date(c.date_of_inspection) BETWEEN '" . $start_date . "' AND '" . $end_date . "'"]  = NULL;
        }
      }

      $where['welder IS NOT NULL']  = null;
      $where["b.welder"]            = $welder_id;
	    $where["c.ndt_type IN(1,3)"]  = null;

      $data['ctq_data_list'] = $this->m_welder_mod->get_detail_data_ctq($where);
      unset($where);
      foreach ($data['ctq_data_list'] as $key => $value) {
        $data_ctq[] = array(
          "welder_id"         => $value["welder"],
          "ctq_id"            => $value["ctq_id"],
          "ctq_length"        => $value["length"]
        );
      }

      //test_var($data['ctq_data_list']);


      // ----------------------- Source Data CTQ NDT --------------------------------- //
      foreach ($data_ctq ?? [] as $key => $value) {

        $create_arr_welder_ctq = explode(";", $value['welder_id']);
        $remove_zero_ctq       = array_filter($create_arr_welder_ctq);
        $total_welder_ctq      = sizeof($remove_zero_ctq);
        $xdata_ctq[]           = $total_welder_ctq;
        $divide_weld_total_ctq[$key] = $value['ctq_length'] /  $total_welder_ctq;

        $data_sum_all_ctq[] = array(
          "welder_id"     => $remove_zero_ctq,
          "total_welder"  => $total_welder_ctq,
          "weld_length"   => $value["ctq_length"],
          "result_divide" => $divide_weld_total_ctq[$key],
        );

        foreach ($remove_zero_ctq as $kw => $vl) {
          $wl_id_ctq[] = array(
            "welder_id"     => $vl,
            "ctq_id"        => $value["ctq_id"],
            "result_divide" => $divide_weld_total_ctq[$key]
          );
        }
      }

      $sums_ctq         = [];
      $count_ctq        = [];
      foreach ($wl_id_ctq ?? [] as $key => $value) {
        if (!isset($sums_ctq[$value['welder_id']][$value['ctq_id']])) {
          $sums_ctq[$value['welder_id']][$value['ctq_id']] = 0;
        }
        $sums_ctq[$value['welder_id']][$value['ctq_id']] += $value['result_divide'];
      }
      foreach ($wl_id_ctq ?? [] as $key => $value) {
        $data_final_a_ctq[] = array(
          "weld_id"       => $value['welder_id'],
          "ctq_id"        => $value['ctq_id'],
          "total_length"  => $sums_ctq[$value['welder_id']][$value['ctq_id']]
        );
      }

      foreach ($data_final_a_ctq ?? [] as $key => $value) {
        $data['ctq_length_data'][$value['weld_id']][$value['ctq_id']] = $value;
      }
    }

		$data['sidebar']      = $this->sidebar;
		$data['meta_title']   = 'Welder Performance - Data Audit';
		$data['subview']      = 'master/welder/welder_audit';
		$this->load->view('index', $data);
	}


	public function welder_performance($download = null, $project_id = null, $company_id = null)
	{
		// error_reporting(0);
		$data['post'] = $this->input->post();
		
		$datadb = $this->general_mod->master_welder_process();
		$welder_process_list = [];
		foreach ($datadb as $key => $value) {
			$welder_process_list[$value['id']] = $value;
		}
		$data['welder_process_list'] = $welder_process_list;
		
		$project_list = $this->general_mod->project();
		foreach ($project_list as $value) {
			$data['project'][$value['id']]  = $value;
		}
		
		$where        = null;
		if (!$this->is_admin) {
			$where[implode_where("id", $this->project_alt)] = null;
		}

		
		$datadb = $this->general_mod->project($where);
		unset($where);
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['project_code']] = $value;
			$data['project_code'][$value['id']] = $value['project_code'];
		}
		$data['project_list'] = $project_list;
		
		$where    = null;
		if (!$this->is_admin) {
			$where[implode_where("id_company", $this->company_alt)] = null;
		}
		$datadb = $this->general_mod->company($where);
		unset($where);
		
		foreach ($datadb as $key => $value) {
			$company[$value['id_company']] = $value;
		}
		$data['company_list'] = $company;
		
		$datadb = $this->general_mod->master_ctq();
		$master_ctq = [];
		foreach ($datadb as $key => $value) {
			$master_ctq[$value['id']] = $value;
		}
		$data['master_ctq'] = $master_ctq;
		
		// ----------------------- Source Data Visual --------------------------------- //
		
		// if (@$data['post']["filter_date"] == '1') {
		// 	if (isset($data["post"]['start_date']) and !empty($data["post"]['start_date']) and isset($data["post"]['end_date']) and !empty($data["post"]['end_date'])) {
		// 		$where["date(a.weld_datetime) BETWEEN '" . $data["post"]['start_date'] . "' AND '" . $data["post"]['end_date'] . "'"]  = NULL;
		// 	}
		// } else if (@$data['post']["filter_date"] == '0') {
		// 	if (isset($data["post"]['start_date']) and !empty($data["post"]['start_date']) and isset($data["post"]['end_date']) and !empty($data["post"]['end_date'])) {
		// 		$where["date(b.date_of_inspection) BETWEEN '" . $data["post"]['start_date'] . "' AND '" . $data["post"]['end_date'] . "'"]  = NULL;
		// 	}
		// }
		
		$where['status_actived'] = "1";
		$where["project_id in ('".join("','", $this->user_cookie[13])."')"] = NULL;
		if($this->input->post('project') != ''){
			$where["project_id"] = $this->input->post('project');
		}

		if($this->input->post('company') != ''){
			$where["company_id"] = $this->input->post('company');
		}

		$data['welder_list'] = $this->m_welder_mod->welder_list($where);
		// test_var("END");
		
		$datadb = $this->m_welder_mod->welder_detail_list();
		$duplicate_check = [];
		foreach ($datadb as $key => $value) {
			if (!in_array([$value['welder_process'], $value['f_no'], $value['welder_position']], $duplicate_check[$value['id_welder']] ?? [])) {
				$data['welder_detail_list'][$value['id_welder']][] = [
					"welder_process" => $value['welder_process'],
					"f_no" => $value['f_no'],
					"welder_position" => $value['welder_position'],
				];
				$duplicate_check[$value['id_welder']][] = [$value['welder_process'], $value['f_no'], $value['welder_position']];
			}
		}

		$where = null;
		if (@$data['post']["filter_date"] == '1') {
			if (isset($data["post"]['start_date']) and !empty($data["post"]['start_date']) and isset($data["post"]['end_date']) and !empty($data["post"]['end_date'])) {
				$where = [
					"date(pv.weld_datetime) BETWEEN '" . $data["post"]['start_date'] . "' AND '" . $data["post"]['end_date'] . "'" => NULL,
				];
			}
		} else if (@$data['post']["filter_date"] == '0') {
			if (isset($data["post"]['start_date']) and !empty($data["post"]['start_date']) and isset($data["post"]['end_date']) and !empty($data["post"]['end_date'])) {
				$where["date(pna.date_of_inspection) BETWEEN '" . $data["post"]['start_date'] . "' AND '" . $data["post"]['end_date'] . "'"]  = NULL;
			}
		}
		$data['no_weld_status'] = [];
		$datadb = $this->m_welder_mod->visual_welder_list($where);
    unset($where);

		// foreach ($datadb as $key => $value) {
		// 	$data['no_weld_status'][$value['id_welder']] = $value;
		// }
		
		// if (@$data['post']["filter_date"] == '1') {
		// 	if (isset($data["post"]['start_date']) and !empty($data["post"]['start_date']) and isset($data["post"]['end_date']) and !empty($data["post"]['end_date'])) {
		// 		$where = [
		// 			"date(pv.weld_datetime) BETWEEN '" . $data["post"]['start_date'] . "' AND '" . $data["post"]['end_date'] . "'",
		// 		];
		// 	}
		// } else if (@$data['post']["filter_date"] == '0') {
		// 	if (isset($data["post"]['start_date']) and !empty($data["post"]['start_date']) and isset($data["post"]['end_date']) and !empty($data["post"]['end_date'])) {
		// 		$where = ["date(pna.date_of_inspection) BETWEEN '" . $data["post"]['start_date'] . "' AND '" . $data["post"]['end_date'] . "'"];
		// 	}
		// }
		// $data['visual_data_welder'] = [];

		// $datadb = $this->m_welder_mod->welder_visual_calc($where);
		// foreach ($datadb as $key => $value) {
		// 	$data['visual_data_welder'][$value['id_welder']] = $value;
		// }

		// $data['ndt_data_welder'] = [];
		// $datadb = $this->m_welder_mod->welder_ndt_calc($where);
		// foreach ($datadb as $key => $value) {
		// 	$data['ndt_data_welder'][$value['id_welder']] = $value;
		// }

    $filter_date        = $this->input->post('filter_date');
    $start_date         = $this->input->post('start_date');
    $end_date           = $this->input->post('end_date');
    $where              = null;
		$where_date					= null;
    if($filter_date == 1) {
      if($start_date && $end_date) {
        $where_date	= "WHERE date(v.weld_datetime) BETWEEN '$start_date' AND '$end_date' ";
      }
    } elseif($filter_date == 0) {
      if($start_date && $end_date) {
        $where_date = "WHERE date(ndt.date_of_inspection) BETWEEN '$start_date' AND '$end_date' ";
      }
    }


   // $wl_list            = $this->m_welder_mod->visual_wp_list($where);
    $wl_list            = $this->m_welder_mod->visual_wp_list_v2($where, $where_date);

		if($where_date) {
			$where[str_replace("WHERE ", "", $where_date)] = null;
		}

    $wl_rej_list        = $this->m_welder_mod->visual_wp_reject_list($where);
    // $wl_rej_list        = $this->m_welder_mod->visual_wp_reject_list_v2($where);
    unset($where);

    $output             = [];
    $output_ndt         = [];
    $temp_ndt           = [];

		foreach($wl_list as $value) {
			@$output[$value['id_welder']]['length_welded'] += $value['total_length_of_weld']; 
			@$output[$value['id_welder']]['joint_welded'] += $value['total_joint_welded']; 
			@$output_ndt[$value['id_welder']]['joint_tested'] += $value['total_joint_tested'];
			@$output_ndt[$value['id_welder']]['length_tested'] += $value['total_length_tested'];
		}

    // foreach($wl_list as $value) {
    //   @$output[$value['id_welder']]['length_welded'] += $value['length_of_weld']; 
    //   // @$output[$value['id_welder']]['length_welded'] += $value['length_of_weld'] / $value['total_welder']; 
    //   @$output[$value['id_welder']]['joint_welded'] += 1; 
    //   $key_ndt          = $value['id_visual'].'_'.$value['id_welder'];
    //   if(!in_array($key_ndt, $temp_ndt)) {
    //     @$output_ndt[$value['id_welder']]['joint_tested'] += $value['total_joint_tested'];
    //     @$output_ndt[$value['id_welder']]['length_tested'] += $value['total_length_tested'];
    //     // @$output_ndt[$value['id_welder']]['length_tested'] += $value['total_length_tested'] / $value['total_welder'];
    //   }

    //   $temp_ndt[]       = $key_ndt;
    // }


    $temp_ndt_rej       = [];
    $output_rej         = [];
    foreach($wl_rej_list as $value) {
      @$output_rej[$value['welder']]['length_rejected'] += $value['length']; 
      @$output_rej[$value['welder']]['joint_repaired'] += 1; 
      @$data['breakdown_defect'][$value['welder']][$value['ctq_id']] += $value['length'];
    }

    $data['visual_data_welder'] = $output;
    $data['ndt_data_welder']    = $output_ndt;

		// $datadb = $this->m_welder_mod->welder_ctq_list();
		// foreach ($datadb as $key => $value) {
		// 	$data['breakdown_defect'][$value['welder']][$value['ctq_id']] = $value['sum'];
		// }
		// test_var($data['breakdown_defect']);
		$data['no_weld_status'] = $output_rej;
		$data['sidebar']        = $this->sidebar;
		$data['meta_title']     = 'Welder Performance';
		if (isset($data['post']['button_excel']) && !empty($data['post']['button_excel'])) {
			return $this->download_welder_performance($data);
			// $data['subview']      = 'master/welder/welder_performance_xls';
			// $this->load->view($data['subview'], $data);
		} else {
			$data['subview']  = 'master/welder/welder_performance';
			$this->load->view('index', $data);
		}
	}

	protected function download_welder_performance($data) {
		error_reporting(0);
		extract($data);
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

			for ($i= 'P'; $i !== 'ZZ' ; $i++) { 
        $letters[]  =  $i;
      }

      $sheet->setCellValue('A1', 'WELDER CODE');
      $sheet->setCellValue('B1', 'COMPANY');
      $sheet->setCellValue('C1', 'PROJECT'); 
      $sheet->setCellValue('D1', 'EMPLOYEE ID'); 
      $sheet->setCellValue('E1', 'WELDER NAME'); 
      $sheet->setCellValue('F1', 'WELDER QUALIFICATION'); 
      $sheet->mergeCells('F1:H1');
      $sheet->setCellValue('F2', 'PROCESS'); 
      $sheet->setCellValue('G2', 'F NUMBER'); 
      $sheet->setCellValue('H2', 'POSITION'); 
      $sheet->setCellValue('I1', 'NUMBER OF WELD STATUS'); 
      $sheet->mergeCells('I1:N1');
      $sheet->setCellValue('I2', 'JOINT WELDED'); 
      $sheet->setCellValue('J2', 'JOINT TESTED'); 
      $sheet->setCellValue('K2', 'JOINT REPAIRED'); 
      $sheet->setCellValue('L2', 'WELDED (MM)'); 
      $sheet->setCellValue('M2', 'TESTED (MM)'); 
      $sheet->setCellValue('N2', 'REJECTED (MM)'); 
      $sheet->setCellValue('O1', 'RATE'); 
      $sheet->setCellValue('P1', 'BREAKDOWN OF DEFECTS REJECTED'); 
			$index = 0;
			foreach($master_ctq as $key => $value) {
        $sheet->setCellValue($letters[$index].'2', $value['ctq_initial']);
        $last_range = $letters[$index];
				$index++;
      }
      $sheet->mergeCells('P1:'.$last_range.'1');
      $sheet->setCellValue($letters[$index].'1', 'SMOE STATUS'); 
      $sheet->setCellValue($letters[$index + 1].'1', 'KPI STATUS'); 
      $sheet->setCellValue($letters[$index + 2].'1', 'DATA AUDIT'); 
			

			$header_merge					= ["A","B","C","D","E","O",$letters[$index],$letters[$index + 1],$letters[$index + 2]];
			foreach($header_merge as $v) {
				$sheet->mergeCells($v.'1:'.$v.'2');
			}

      $excel->getActiveSheet()->getStyle('A1:'.$letters[$index + 2].'2')->applyFromArray($styleArray);
      unset($styleArray);

      foreach(range('A','ZZ') as $value) {
        $excel->getActiveSheet()->getColumnDimension($value)->setAutoSize(true);
      }

      $start  = 3;
      foreach($welder_list as $value) {
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

					@$total_joint_welded += @$visual_data_welder[$value["id_welder"]]['joint_welded'] + 0 ;
					@$total_length_welded += @$visual_data_welder[$value["id_welder"]]['length_welded'] + 0 ;

					@$total_joint_tested += @$ndt_data_welder[$value["id_welder"]]['joint_tested'] + 0 ;
					@$total_length_tested += @$ndt_data_welder[$value["id_welder"]]['length_tested'] + 0 ;

					@$total_joint_reject += @$no_weld_status[$value["id_welder"]]['joint_repaired'] + 0 ;
					@$total_length_rejected += @$no_weld_status[$value["id_welder"]]['length_rejected'] + 0 ;

					$arr_weld_process 	= [];
					$arr_f_no 					= [];
					$arr_weld_position 	= [];
					foreach($welder_detail_list[$value['id_welder']] as $v) {
						$arr_weld_process[]		= $welder_process_list[$v['welder_process']]['name_process'];
						$arr_f_no[]						= $v['f_no'];
						$arr_weld_position[]	= $v['welder_position'];
					}

          $sheet->setCellValue('A'.$start, $value["welder_code"]);
          $sheet->setCellValue('B'.$start, $company_list[$value["company_id"]]['company_name']);
          $sheet->setCellValue('C'.$start, $project[$value["project_id"]]['project_name']);
          $sheet->setCellValue('D'.$start, $value["welder_badge"]);
          $sheet->setCellValue('E'.$start, $value["welder_name"]);

          $sheet->setCellValue('F'.$start, implode("\n,", $arr_weld_process));
          $sheet->setCellValue('G'.$start, implode("\n,", $arr_f_no));
          $sheet->setCellValue('H'.$start, implode("\n,", $arr_weld_position));
          $sheet->setCellValue('I'.$start, @$visual_data_welder[$value['id_welder']]['joint_welded']+0);
          $sheet->setCellValue('J'.$start, @$ndt_data_welder[$value['id_welder']]['joint_tested']+0);
          $sheet->setCellValue('K'.$start, @$no_weld_status[$value['id_welder']]['joint_repaired']+0);
          $sheet->setCellValue('L'.$start, @$visual_data_welder[$value['id_welder']]['length_welded']+0);
          $sheet->setCellValue('M'.$start, @$ndt_data_welder[$value['id_welder']]['length_tested']+0);
          $sheet->setCellValue('N'.$start, @$no_weld_status[$value['id_welder']]['length_rejected']+0);

					$var_joint_tested 		= @$ndt_data_welder[$value['id_welder']]['length_tested']+0;
					$var_joint_reject_ndt = @$no_weld_status[$value['id_welder']]['length_rejected']+0;
					$total_rate						= 0;
					if ($var_joint_reject_ndt > 0) {
						$total_rate = round(($var_joint_reject_ndt / $var_joint_tested) * 100, 2);
					}
          $sheet->setCellValue('O'.$start, $total_rate.' %');

					$index = 0;
					foreach($master_ctq as $k => $v) {
						@$total_reject[$k] += @$breakdown_defect[$value["id_welder"]][$v['id']] + 0;

						$sheet->setCellValue($letters[$index].$start, round(@$breakdown_defect[$value["id_welder"]][$v['id']] + 0, 2));
						$last_range = $letters[$index];
						$index++;
					}

					$smoe_status = "NON-ACTIVE";
					if($value['status_actived'] == 1) {
						$smoe_status = "ACTIVE";
					}

					$result = '';

					if ($total_rate < 1) {
							$result = 'GOOD';
					} elseif ($total_rate >= 1.8) {
							$result = 'TRAINING';
					} elseif ($total_rate >= 1.5) {
							$result = 'MONITORING';
					} elseif ($total_rate > 1) {
							$result = 'BRIEF';
					}

					$sheet->setCellValue($letters[$index].$start, $smoe_status); 
					$sheet->setCellValue($letters[$index + 1].$start, $result); 
					$link_audit = '';
					if(isset($visual_data_welder[$value['id_welder']]['joint_welded'])) {
						$link_audit = site_url('master/welder/welder_perform_audit/'.encrypt($value["id_welder"]).'/'.encrypt($start_date).'/'.encrypt($end_date));

						$sheet->setCellValue($letters[$index + 2].$start, '_LINK_')->getCell($letters[$index + 2].$start)->getHyperlink()->setUrl($link_audit);
					} else {
					
						$sheet->setCellValue($letters[$index + 2].$start, ''); 
					}

					
          $excel->getActiveSheet()->getStyle('A'.$start.':'.$letters[$index + 2].$start)->applyFromArray($styleArray);
          unset($styleArray);
          $start++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				$filename = "Export Welder Performance ".date('YmdHis');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
        $data = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $data->save('php://output');
        exit;
	}

	public function generate_template_import_welder() {
		error_reporting(0);
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
        // 'color' => array('rgb' => 'FFFFFF')
      ),
     
    );

    $background_color         = array(
      'pl' => ['fill' => array(
          'type' => PHPExcel_Style_Fill::FILL_SOLID,
          'color' => array('rgb' => 'ade08d')
      ) ],

      'mt' => ['fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => '21a334')
    ) ],

    'rec' => ['fill' => array(
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'e3c97b')
    ) ],

    );

    $url_master_data = base_url() . 'public_smoe';
    
    $sheet->setCellValue('A1', 'PROJECT CODE (CLICK FOR MASTER DATA)')->getCell('A1')->getHyperlink()->setUrl($url_master_data . '/project_list');
    $sheet->setCellValue('B1', 'DISCIPLINE');
    $sheet->setCellValue('C1', 'WELDER CODE');
    $sheet->setCellValue('D1', 'WELDER BADGE');
    $sheet->setCellValue('E1', 'WELDER NAME');
    $sheet->setCellValue('F1', 'WPS (MULTIPLE, USE ";" AS SEPARATOR) (CLICK FOR MASTER DATA)')->getCell('F1')->getHyperlink()->setUrl($url_master_data . '/wps_list');
    $sheet->setCellValue('G1', 'WELD PROCESS (CLICK FOR MASTER DATA)')->getCell('G1')->getHyperlink()->setUrl($url_master_data . '/weld_process_list');
    $sheet->setCellValue('H1', 'WELDER POSITION (CLICK FOR MASTER DATA)')->getCell('H1')->getHyperlink()->setUrl($url_master_data . '/master_data_welder_req/1');
    $sheet->setCellValue('I1', 'F NUMBER (CLICK FOR MASTER DATA)')->getCell('I1')->getHyperlink()->setUrl($url_master_data . '/master_data_welder_req/2');
    $sheet->setCellValue('J1', 'POSITION RANGE (CLICK FOR MASTER DATA)')->getCell('J1')->getHyperlink()->setUrl($url_master_data . '/master_data_welder_req/4');
    $sheet->setCellValue('K1', 'DIAMETER RANGE (CLICK FOR MASTER DATA)')->getCell('K1')->getHyperlink()->setUrl($url_master_data . '/master_data_welder_req/5');
    $sheet->setCellValue('L1', 'THICKNESS RANGE (CLICK FOR MASTER DATA)')->getCell('L1')->getHyperlink()->setUrl($url_master_data . '/master_data_welder_req/6');
    $sheet->setCellValue('M1', 'BACKING (CLICK FOR MASTER DATA)')->getCell('M1')->getHyperlink()->setUrl($url_master_data . '/master_data_welder_req/7');
    $sheet->setCellValue('N1', 'CLASS OF MATERIAL (CLICK FOR MASTER DATA)')->getCell('N1')->getHyperlink()->setUrl($url_master_data . '/master_data_welder_req/3');
    $sheet->setCellValue('O1', 'VALIDITY START DATE (YYYY-MM-DD)');
    $sheet->setCellValue('P1', 'VALIDITY END DATE (YYYY-MM-DD)');
    $sheet->setCellValue('Q1', 'COMPANY (CLICK FOR MASTER DATA)')->getCell('Q1')->getHyperlink()->setUrl($url_master_data . '/company_list');
   
    $excel->getActiveSheet()->getStyle('A1:Q1')->applyFromArray($styleArray);
    unset($styleArray);

    $excel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($background_color['pl']);
    $excel->getActiveSheet()->getStyle('F1:Q1')->applyFromArray($background_color['rec']);

    $start = 2;
    foreach(range(1,5) as $value) {

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
       
      );

      $excel->getActiveSheet()->getStyle('O' . $start)->getNumberFormat()->setFormatCode('yyyy-mm-dd');
      $excel->getActiveSheet()->getStyle('P' . $start)->getNumberFormat()->setFormatCode('yyyy-mm-dd');
      $excel->getActiveSheet()->getStyle('A'.$start.':Q'.$start)->applyFromArray($styleArray);
      unset($styleArray);

      $start++;
    }
    for ($i='A'; $i !== 'ZZ' ; $i++) { 
      if($i != "A") {
        $excel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
      } else {
        $excel->getActiveSheet()->getColumnDimension($i)->setWidth(30);
      }
    }

    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Template Import Welder Register.xlsx"');
    $data = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $data->save('php://output');
    exit;
	}

}
