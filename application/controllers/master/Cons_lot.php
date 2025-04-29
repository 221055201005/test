<?php

use FontLib\Table\Type\post;

defined('BASEPATH') or exit('No direct script access allowed');

class Cons_lot extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('browser');
		$this->load->helper('cookies');
		$data_cookies = helper_cookies(@$this->input->get('user'));

		$this->load->model('general_mod');
		$this->load->model('master/cons_lot_model', 'm_cons_lot_mod');

		$this->user_cookie 		  	= $data_cookies['data_user'];
		$this->permission_cookie  = $data_cookies['data_permission'];

		$this->sidebar 	= "master/sidebar";

		$this->ftp    = ftp_config_syn();
	}

	public function index()
	{

		redirect("master/cons_lot/cons_lot_list");
	}

	public function cons_lot_list($download = null)
	{

		$datadb = $this->general_mod->project();
		foreach ($datadb as $key => $value) {
			$data['master_project'][$value['id']] = $value;
		}

		$where['status'] = "1";
		$datadb = $this->general_mod->master_welder_process($where);
		unset($where);
		foreach ($datadb as $key => $value) {
			$data['master_welder_process'][$value['id']] = $value['name_process'];
		}

		$cons_lot_list = $this->m_cons_lot_mod->cons_lot_list([
			"status_delete" => '1',
			"project_id IN (".join(",", $this->user_cookie[13]).")" => NULL,
		]);
		$data['cons_lot_list']			   = $cons_lot_list;

		if ($data['cons_lot_list']) {
			foreach ($data['cons_lot_list'] as $value) {
				$list_lot_no[]  = $value['batch_lot_no'];
			}

			$where['project_id']  = 17;
			$where[implode_where("heat_or_series_no", $list_lot_no)]  = null;
			$where['category']		= "CM";
			$datadb               = $this->m_cons_lot_mod->qcs_material_list($where);
			unset($where);

			foreach ($datadb as $value) {
				$list_mrir_id[]     = intval($value['mrir_id']);
				$list_id_brand[]    = $value['brand'];
				$list_catalog_id[]  = $value['catalog_id'];
				$data['mrir'][$value['heat_or_series_no']]  = $value;
			}

			$where[implode_where("id", $list_mrir_id)]  = null;
			$datadb               = $this->m_cons_lot_mod->qcs_mrir_list($where);
			unset($where);
			foreach ($datadb as $value) {
				$data['mrir_main'][$value['id']]  = $value;
			}


			$where[implode_where("id", $list_id_brand)]  = null;
			$datadb               = $this->m_cons_lot_mod->brand_list($where);
			unset($where);
			foreach ($datadb as $value) {
				$data['brand'][$value['id']]  = $value;
			}

			$where[implode_where("id", $list_catalog_id)]  = null;
			$datadb               = $this->m_cons_lot_mod->catalog_list($where);
			unset($where);
			foreach ($datadb as $value) {
				$data['catalog'][$value['id']]  = $value;
			}
		}

		$data['meta_title']     = 'Consumable Lot Register';
		if (isset($download)) {
			$data['subview']      = 'master/cons_lot/cons_lot_excel';
			$this->load->view($data['subview'], $data);
		} else {
			$data['subview']      = 'master/cons_lot/cons_lot_list';
			$this->load->view('index', $data);
		}
	}

	public function cons_lot_new()
	{

		$datadb = $this->general_mod->project();
		foreach ($datadb as $key => $value) {
			$data['master_project'][$value['id']] = $value;
		}
		$data['project'] = $datadb;


		$where['status'] = "1";
		$datadb = $this->general_mod->master_welder_process($where);
		unset($where);
		foreach ($datadb as $key => $value) {
			$data['master_welder_process'][$value['id']] = $value['name_process'];
		}
		$data['welding_process'] = $datadb;

		$cons_lot_list = $this->m_cons_lot_mod->cons_lot_list([
			"status_delete" => '1'
		]);
		$data['cons_lot_list']			   = $cons_lot_list;

		if ($data['cons_lot_list']) {
			foreach ($data['cons_lot_list'] as $value) {
				$list_lot_no[]  = $value['batch_lot_no'];
			}

			$where['project_id']  = 17;
			$where[implode_where("heat_or_series_no", $list_lot_no)]  = null;
			$where['category']		= "CM";
			$datadb               = $this->m_cons_lot_mod->qcs_material_list($where);
			unset($where);

			foreach ($datadb as $value) {
				$list_mrir_id[]     = intval($value['mrir_id']);
				$list_id_brand[]    = $value['brand'];
				$list_catalog_id[]  = $value['catalog_id'];
				$data['mrir'][$value['heat_or_series_no']]  = $value;
			}

			$where[implode_where("id", $list_mrir_id)]  = null;
			$datadb               = $this->m_cons_lot_mod->qcs_mrir_list($where);
			unset($where);
			foreach ($datadb as $value) {
				$data['mrir_main'][$value['id']]  = $value;
			}


			$where[implode_where("id", $list_id_brand)]  = null;
			$datadb               = $this->m_cons_lot_mod->brand_list($where);
			unset($where);
			foreach ($datadb as $value) {
				$data['brand'][$value['id']]  = $value;
			}

			$where[implode_where("id", $list_catalog_id)]  = null;
			$datadb               = $this->m_cons_lot_mod->catalog_list($where);
			unset($where);
			foreach ($datadb as $value) {
				$data['catalog'][$value['id']]  = $value;
			}
		}

		$data['meta_title']     = 'Consumable Lot Register';

		$data['subview']      = 'master/cons_lot/cons_lot_new';
		$this->load->view('index', $data);
	}

	public function cons_lot_wh_autocomplete()
	{
		$post = $this->input->post();

		$datadb = $this->m_cons_lot_mod->qcs_material_list_search([
			// "project_id IN (".join(", ", $this->user_cookie[13]).")" => NULL,
			"project_id" => 17,
			"heat_or_series_no ILIKE '%".$post['term']."%'" => NULL,
			"category" => 'CM',
		]);
		
		$output = [];
		if(count($datadb) > 0){
			foreach ($datadb as $key => $value) {
				$output[] = $value["heat_or_series_no"];
			}
		}
		else{
			$output[] = "No Data.";
		}
		echo json_encode($output);
	}

	public function cons_lot_wh_check()
	{
		$batch_lot_no = $this->input->post('batch_lot_no');
		$error = '';
		$output = '';

		$datadb = $this->m_cons_lot_mod->cons_lot_list([
			"batch_lot_no" => $batch_lot_no,
		]);
		if(count($datadb) > 0){
			$error = 'Error: Lot Number Duplicate!';
		}

		$datadb = $this->m_cons_lot_mod->qcs_material_list([
			// "project_id IN (".join(", ", $this->user_cookie[13]).")" => NULL,
			"project_id" => 17,
			'category' => "CM",
			"heat_or_series_no" => $batch_lot_no,
		]);
		if(count($datadb) == 0){
			$error = 'Error: Lot Number Not Found!';
		}
		else{
			$value = $datadb[0];
			
			$datadb = $this->m_cons_lot_mod->catalog_list([
				"id" => $value['catalog_id'],
			]);
			$catalog = @$datadb[0]['material'];
			$spesification = $datadb[0]['spesification'];
			$diameter = @$datadb[0]['size'];
			
			$datadb = $this->m_cons_lot_mod->brand_list([
				"id" => $value['brand'],
			]);
			$brand = @$datadb[0]['brand_name'];

			$datadb               = $this->m_cons_lot_mod->qcs_mrir_list([
				"id" => intval($value['mrir_id']),
			]);
			$mrir_main = @$datadb[0];

			$output = "";
			$output .= "<tr>";
			$output .= "<input type='hidden' name='lot_no[]' value='".$batch_lot_no."'>";
			$output .= "<td>".$value['heat_or_series_no']."</td>";
			$output .= "<td>".$catalog."<br><strong>".$spesification."</strong></td>";
			$output .= "<td>".$brand."</td>";
			$output .= "<td>".$diameter."</td>";
			$output .= "<td>".$mrir_main['report_no']."</td>";
			$output .= "<td><button type='button' class='btn btn-sm btn-danger' onclick='delete_item(this)' data-lotno='".$batch_lot_no."'><i class='fas fa-times'></i></td>";
			$output .= "</tr>";
		}

		if($error != ''){
			echo $error;
		}
		else{
			$result = [
				'output' => $output,
				'batch_lot_no' => $batch_lot_no,
			];
			echo json_encode($result);
		}
	}

	public function cons_lot_new_process()
	{
		$post = $this->input->post();

		foreach ($post['lot_no'] as $key => $value) {
			$form_data = [
				'item_description' => $post['item_description'],
				'consumable_strengh' => $post['consumable_strengh'],
				'batch_lot_no' => $value,
				'remarks' => $post['remarks'],
				'project_id' => $post['project_id'],
				'weld_process' => $post['weld_process'],
			];
			$this->m_cons_lot_mod->cons_lot_new_process_db($form_data);
		}

    $this->session->set_flashdata('success', 'Your data has been inserted!');
		redirect($_SERVER["HTTP_REFERER"]);
	}

	public function cons_lot_update($id_lot)
	{
		$id_lot = decrypt($id_lot);

		$datadb = $this->general_mod->project();
		foreach ($datadb as $key => $value) {
			$data['master_project'][$value['id']] = $value;
		}
		$data['project'] = $datadb;


		$where['status'] = "1";
		$datadb = $this->general_mod->master_welder_process($where);
		unset($where);
		foreach ($datadb as $key => $value) {
			$data['master_welder_process'][$value['id']] = $value['name_process'];
		}
		$data['welding_process'] = $datadb;

		$cons_lot = $this->m_cons_lot_mod->cons_lot_list([
			"id_lot" => $id_lot,
			"status_delete" => '1',
		]);
		$cons_lot = $cons_lot[0];
		$data['cons_lot'] = $cons_lot;

		$datadb = $this->m_cons_lot_mod->qcs_material_list([
			// "project_id IN (".join(", ", $this->user_cookie[13]).")" => NULL,
			"project_id" => 17,
			'category' => "CM",
			"heat_or_series_no" => $cons_lot['batch_lot_no'],
		]);
		$mrir = $datadb[0];
			
		$datadb = $this->m_cons_lot_mod->catalog_list([
			"id" => $mrir['catalog_id'],
		]);
		$catalog = @$datadb[0]['material'];
		$spesification = $datadb[0]['spesification'];
		$diameter = @$datadb[0]['size'];
		
		$datadb = $this->m_cons_lot_mod->brand_list([
			"id" => $mrir['brand'],
		]);
		$brand = @$datadb[0]['brand_name'];

		$datadb               = $this->m_cons_lot_mod->qcs_mrir_list([
			"id" => intval($mrir['mrir_id']),
		]);
		$mrir_main = @$datadb[0];

		$output = "";
		$output .= "<tr>";
		$output .= "<td>".$mrir['heat_or_series_no']."</td>";
		$output .= "<td>".$catalog."<br><strong>".$spesification."</strong></td>";
		$output .= "<td>".$brand."</td>";
		$output .= "<td>".$diameter."</td>";
		$output .= "<td>".$mrir_main['report_no']."</td>";
		$output .= "</tr>";
		$data['output'] = $output;

		$data['meta_title'] = 'Consumable Lot Update';
		$data['subview'] = 'master/cons_lot/cons_lot_update';
		$this->load->view('index', $data);
	}

	public function cons_lot_update_process()
	{
		$post = $this->input->post();

		$form_data = [
			'item_description' => $post['item_description'],
			'consumable_strengh' => $post['consumable_strengh'],
			'remarks' => $post['remarks'],
			'project_id' => $post['project_id'],
			'weld_process' => $post['weld_process'],
		];
		$this->m_cons_lot_mod->cons_lot_update_process_db($form_data, [
			'id_lot' => $post['id_lot'],
		]);

    $this->session->set_flashdata('success', 'Your data has been updated!');
		redirect($_SERVER["HTTP_REFERER"]);
	}
}
