<?php

date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') or exit('No direct script access allowed');

class Additional extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->helper('browser');
		$this->load->helper('cookies');
		$data_cookies = helper_cookies(@$this->input->get('user'));

		$this->load->helper('approval');

		$this->load->model('home_mod');
		$this->load->model('general_mod');
		$this->load->model('dimension_mod');
		$this->load->model('mdb_mod');
		$this->load->model('irn_mod');

		$this->user_cookie 		  = $data_cookies['data_user'];
		$this->permission_cookie  = $data_cookies['data_permission'];
		$this->sidebar = "dimension/sidebar";

		$this->ftp                = ftp_config_syn();
		if ($this->user_cookie[12] == getenv('IP_FIREWALL_GATEWAY')) {
			$this->link_server = getenv('LINK_SERVER_OUTSIDE');
		} else {
			$this->link_server = getenv('LINK_SERVER');
		}
	}

	public function index($type_of_report = null)
	{
		redirect('additional/dc_list/' . strtr($this->encryption->encrypt($type_of_report), '+=/', '.-~'));
	}

	//GO TO PAGE =======================================================
	function dc_add($drawing_no, $discipline, $module, $project_id = null)
	{

		$drawing_no = $this->encryption->decrypt(strtr($drawing_no, '.-~', '+=/'));
		$discipline = $this->encryption->decrypt(strtr($discipline, '.-~', '+=/'));
		$module 	= $this->encryption->decrypt(strtr($module, '.-~', '+=/'));
		$project_id = $this->encryption->decrypt(strtr($project_id, '.-~', '+=/'));

		$datadb = $this->general_mod->eng_module_get_db();
		foreach ($datadb as $value) {
			$data['module_list'][$value['mod_id']] = $value['mod_desc'];
		}

		$datadb  = $this->general_mod->eng_discipline_get_db();
		foreach ($datadb as $value) {
			$data['discipline_list'][$value['id']] = $value['discipline_name'];
		}

		if ($type_of_report == 1) {
			$meta = "Dimension Control";
		} else if ($type_of_report == 2) {
			$meta = "Correction Of Distortion";
		} else if ($type_of_report == 3) {
			$meta = "Excavation";
		} else if ($type_of_report == 4) {
			$meta = "Buttering";
		} else {
			$meta = "Additional Report";
		}
		$data['meta_title'] 	 = $meta;

		$data['drawing_no'] 		= $drawing_no;
		$data['discipline'] 		= $discipline;
		$data['module'] 			= $module;
		$data['project_id'] 		= $project_id;

		$data['read_cookies'] 		= $this->user_cookie;
		$data['subview']    		= 'dimension/dimension_control_add';
		$data['sidebar']    		= $this->sidebar;
		$data['read_permission']  	= $this->permission_cookie;

		//GET DATA DB
		$data['q_module']  		= $this->general_mod->eng_module_get_db();
		$data['q_discipline']  	= $this->general_mod->discipline_list();

		$this->load->view('index', $data);
	}

	function dc_add_attch($project = null, $drawing_no = null, $discipline = null, $module = null, $type_of_module = null, $deck_elevation = null, $type_of_report = null)
	{

		$data["project"] 	 	 = $this->encryption->decrypt(strtr($project, '.-~', '+=/'));
		$data["drawing_no"] 	 = $this->encryption->decrypt(strtr($drawing_no, '.-~', '+=/'));
		$data["discipline"] 	 = $this->encryption->decrypt(strtr($discipline, '.-~', '+=/'));
		$data["module"] 		 = $this->encryption->decrypt(strtr($module, '.-~', '+=/'));
		$data["type_of_module"]  = $this->encryption->decrypt(strtr($type_of_module, '.-~', '+=/'));
		$data["deck_elevation"]  = $this->encryption->decrypt(strtr($deck_elevation, '.-~', '+=/'));
		$data["type_of_report"]  = $this->encryption->decrypt(strtr($type_of_report, '.-~', '+=/'));

		$where["drawing_no"] = $data["drawing_no"];
		$src_drawing_detail = $this->dimension_mod->pcms_joint_list($where);
		unset($where);
		if (sizeof($src_drawing_detail)) {
			$data["drawing_detail"] = $src_drawing_detail[0];
		} else {
			$data["drawing_detail"] = null;
		}

		$datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['project_code']] = $value;
			$data['project_code'][$value['id']] = $value['project_code'];
		}
		$data['project_list'] = $project_list;

		$datadb  = $this->general_mod->portal_user_get_db();
		foreach ($datadb as $value) {
			$data['user_list'][$value['id_user']] = $value['full_name'];
		}

		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['mod_id']] = $value;
			$data['module_code'][$value['mod_id']] = $value['mod_desc'];
		}
		$data['module_list'] = $module_list;

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['initial']] = $value;
			$data['discipline_code'][$value['id']] = $value['initial'];
			$data['discipline_name'][$value['id']] = $value['discipline_name'];
		}
		$data['discipline_list'] = $discipline_list;

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
			$data['type_of_module_code'][$value['id']] = $value['code'];
			$data['type_of_module_name'][$value['id']] = $value['name'];
		}
		$data['type_of_module_list'] = $type_of_module_list;

		$where['status_delete']   = 1;
		$data['deck_list']        = $this->general_mod->deck_elevation($where);
		foreach ($data['deck_list'] as $value) {
			$data['deck_elevation_show'][$value['id']] = $value['name'];
		}
		unset($where);

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
			$data['type_of_module_code'][$value['id']] = $value['code'];
			$data['type_of_module_name'][$value['id']] = $value['name'];
		}
		$data['type_of_module_list'] = $type_of_module_list;

		$type_of_report = $data["type_of_report"];

		if ($type_of_report == 1) {
			$meta = "Dimension Control";
		} else if ($type_of_report == 2) {
			$meta = "Correction Of Distortion";
		} else if ($type_of_report == 3) {
			$meta = "Excavation";
		} else if ($type_of_report == 4) {
			$meta = "Buttering";
		} else {
			$meta = "Additional Report";
		}
		$data['meta_title'] 	 = $meta;

		$data['sidebar']    	 = $this->sidebar;
		$data['read_permission'] = $this->permission_cookie;
		$data['read_cookies'] 	 = $this->user_cookie;

		$data['subview']    	 = 'dimension/dimension_control_add_attch';

		$this->load->view('index', $data);
	}

	public function draw_list($type_of_report = null)
	{

		$data["type_of_report"] = $this->encryption->decrypt(strtr($type_of_report, '.-~', '+=/'));
		$type_of_report = $this->encryption->decrypt(strtr($type_of_report, '.-~', '+=/'));

		$datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['project_code']] = $value;
			$data['project_code'][$value['id']] = $value['project_code'];
		}
		$data['project_list'] = $project_list;

		$datadb  = $this->general_mod->portal_user_get_db();
		foreach ($datadb as $value) {
			$data['user_list'][$value['id_user']] = $value['full_name'];
		}

		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['mod_id']] = $value;
			$data['module_code'][$value['mod_id']] = $value['mod_desc'];
		}
		$data['module_list'] = $module_list;

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['initial']] = $value;
			$data['discipline_code'][$value['id']] = $value['initial'];
			$data['discipline_name'][$value['id']] = $value['discipline_name'];
		}
		$data['discipline_list'] = $discipline_list;

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
			$data['type_of_module_code'][$value['id']] = $value['code'];
			$data['type_of_module_name'][$value['id']] = $value['name'];
		}
		$data['type_of_module_list'] = $type_of_module_list;

		$where['status_delete']   = 1;
		$data['deck_list']        = $this->general_mod->deck_elevation($where);
		foreach ($data['deck_list'] as $value) {
			$data['deck_elevation_show'][$value['id']] = $value['name'];
		}
		unset($where);

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
			$data['type_of_module_code'][$value['id']] = $value['code'];
			$data['type_of_module_name'][$value['id']] = $value['name'];
		}
		$data['type_of_module_list'] = $type_of_module_list;

		//test_var($this->input->post("dc_status"));

		$data['post'] = $this->input->post();

		if ($type_of_report == 1) {
			$meta = "Dimension Control";
		} else if ($type_of_report == 2) {
			$meta = "Correction Of Distortion";
		} else if ($type_of_report == 3) {
			$meta = "Excavation";
		} else if ($type_of_report == 4) {
			$meta = "Buttering";
		} else {
			$meta = "Additional Report";
		}
		$data['meta_title'] 	 = 'Drawing List - ' . $meta;

		$data['read_cookies'] 		= $this->user_cookie;
		$data['subview']    		= 'dimension/draw_list';
		$data['sidebar']    		= $this->sidebar;
		$data['read_permission']  	= $this->permission_cookie;

		$this->load->view('index', $data);
	}


	//ADDED 24 AUG for Filter
	function draw_list_filter()
	{
		//error_reporting(0);

		$datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['project_code']] = $value;
			$data['project_code'][$value['id']] = $value['project_code'];
		}
		$data['project_list'] = $project_list;

		$datadb  = $this->general_mod->portal_user_db_no_sign();
		foreach ($datadb as $value) {
			$data['user_list'][$value['id_user']] = $value['full_name'];
		}

		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['mod_id']] = $value;
			$module_code[$value['mod_id']] = $value['mod_desc'];
		}
		$data['module_list'] = $module_list;

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['initial']] = $value;
			$data['discipline_code'][$value['id']] = $value['initial'];
			$discipline_name[$value['id']] = $value['discipline_name'];
		}
		$data['discipline_list'] = $discipline_list;

		$where['status_delete']   = 1;
		$data['deck_list']        = $this->general_mod->deck_elevation($where);
		foreach ($data['deck_list'] as $value) {
			$deck_elevation_show[$value['id']] = $value['name'];
		}
		unset($where);

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
			$data['type_of_module_code'][$value['id']] = $value['code'];
			$data['type_of_module_name'][$value['id']] = $value['name'];
		}
		$data['type_of_module_list'] = $type_of_module_list;

		$data['post'] = $this->input->post();

		if (!empty($data['post']["type_of_report"])) {
			$type_of_report = $data['post']["type_of_report"];
		} else {
			$type_of_report = null;
		}

		if (!empty($data['post']["project"])) {
			$where["project_id"] = $data['post']["project"];
		} else {
			$where["project_id"] = $this->user_cookie[10];
		}

		if (!empty($data['post']["discipline"])) {
			$where["discipline"] = $data['post']["discipline"];
		}

		if (!empty($data['post']["deck_elevation"])) {
			$where["deck_elevation"] = $data['post']["deck_elevation"];
		}

		$where["drawing_type IN (1,2,9,14)"] = null;
		$where["status_delete"] = 1;
		$list = $this->dimension_mod->get_datatables_drawing_list_dt($where);

		$data = array();
		$no   = $_POST['start'];
		foreach ($list as $list) {
			// $links = base_url() . "dimension/dc_add_attch/" . strtr($this->encryption->encrypt($list->project_id), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt($list->document_no), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt($list->discipline), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt(null), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt(null), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt($list->deck_elevation), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt($type_of_report), '+=/', '.-~');

			$links = base_url()."dimension/create_new_rfi/".encrypt($list->document_no);

			$no++;
			$row   = array();

			$row[] = $list->document_no;
			$row[] = (isset($discipline_name[$list->discipline]) ? $discipline_name[$list->discipline] : "-");
			$row[] = (isset($deck_elevation_show[$list->deck_elevation]) ? $deck_elevation_show[$list->deck_elevation] : "-");
			$row[] = "<a href='" . $links . "' target='_blank' class='btn btn-primary text-white' title='Detail'><i class='fas fa-plus-circle'></i> Add</a>";

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->dimension_mod->count_all_drawing_list_dt($where),
			"recordsFiltered" => $this->dimension_mod->count_filtered_drawing_list_dt($where),
			"data" => $data
		);

		//output to json format
		echo json_encode($output);
		unset($where);
	}

	//END ADDED 24 AUG for Filter


	function dc_list($type_of_report = NULL)
	{

		$type_of_report = $this->encryption->decrypt(strtr($type_of_report, '.-~', '+=/'));

		$datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['project_code']] = $value;
			$data['project_code'][$value['id']] = $value['project_code'];
		}
		$data['project_list'] = $project_list;

		$datadb  = $this->general_mod->portal_user_get_db();
		foreach ($datadb as $value) {
			$data['user_list'][$value['id_user']] = $value['full_name'];
		}

		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['mod_id']] = $value;
			$data['module_code'][$value['mod_id']] = $value['mod_desc'];
		}
		$data['module_list'] = $module_list;

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['initial']] = $value;
			$data['discipline_code'][$value['id']] = $value['initial'];
			$data['discipline_name'][$value['id']] = $value['discipline_name'];
		}
		$data['discipline_list'] = $discipline_list;

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
			$data['type_of_module_code'][$value['id']] = $value['code'];
			$data['type_of_module_name'][$value['id']] = $value['name'];
		}
		$data['type_of_module_list'] = $type_of_module_list;

		$where['status_delete']   = 1;
		$data['deck_list']        = $this->general_mod->deck_elevation($where);
		foreach ($data['deck_list'] as $value) {
			$data['deck_elevation_show'][$value['id']] = $value['name'];
		}
		unset($where);

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
			$data['type_of_module_code'][$value['id']] = $value['code'];
			$data['type_of_module_name'][$value['id']] = $value['name'];
		}
		$data['type_of_module_list'] = $type_of_module_list;

		$data['post'] = $this->input->post();

		// test_var($data['post']);

		$submit	= $this->input->post('submit');

		//test_var($type_of_report);

		if ($submit == "export_excel") {
			return $this->export_data_additional_report($data['post'], $type_of_report);
		}

		$where["a.project_id IN (" . join(", ", $this->user_cookie[13]) . ")"] = NULL;
		if (!empty($this->input->post("project"))) {
			$where["a.project_id"]	= $this->input->post("project");
		}

		if (!empty($this->input->post("dc_status"))) {
			$where["b.dc_status"]	= $this->input->post("dc_status");
		}

		if (!empty($this->input->post("discipline"))) {
			$where["a.discipline"] 	= $this->input->post("discipline");
		}

		if (!empty($this->input->post("module"))) {
			$where["a.module"] 	= $this->input->post("module");
		}

		if (!empty($this->input->post("type_of_module"))) {
			$where["a.type_of_module"] 	= $this->input->post("type_of_module");
		}

		if (!empty($this->input->post("deck_elevation"))) {
			$where["a.deck_elevation"] 	= $this->input->post("deck_elevation");
		}

		if (!empty($type_of_report) && isset($type_of_report)) {
			$where["a.type_of_report"] = $type_of_report;
		}

		$where["b.report_number IS NOT NULL"] = null;
		$where["a.status_delete"] 	= 0;
		$data['data_dc']			= $this->dimension_mod->data_dc($where);
		// test_var($data['data_dc']);
		unset($where);

		if ($type_of_report == 1) {
			$meta = "Dimension Control";
		} else if ($type_of_report == 2) {
			$meta = "Correction Of Distortion";
		} else if ($type_of_report == 3) {
			$meta = "Excavation";
		} else if ($type_of_report == 4) {
			$meta = "Buttering";
		} else {
			$meta = "Additional Report";
		}
		$data['meta_title'] 	 = $meta;

		$data['type_of_report']  = $type_of_report;
		$data['read_cookies'] 	 = $this->user_cookie;
		$data['subview']    	 = 'dimension/dimension_control_list';
		$data['sidebar']    	 = $this->sidebar;
		$data['read_permission'] = $this->permission_cookie;

		$this->load->view('index', $data);
	}

	// filter function for dc 24 AUG 2020
	function dc_list_filter()
	{

		// if($param == "draft"){
		// 	$where['result'] = 0;
		// } else if($param == "request"){
		// 	$where['result'] = 1;
		// } else if($param == "rejected"){
		// 	$where['result'] = 2;
		// } else if($param == "approved"){
		// 	$where['result'] = 3;
		// }

		if (!empty($this->input->get("project"))) {
			$project_id 	= $this->input->get("project");
		} else {
			if ($this->permission_cookie[0] == 1) {
				$project_id = null;
			} else {
				$project_id = $this->user_cookie[10];
			}
		}

		if (!empty($this->input->get("drawing_type"))) {
			$drawing_type 	= $this->input->get("drawing_type");
		} else {
			$drawing_type 	= null;
		}

		if (!empty($this->input->get("dc_status"))) {
			$dc_status 	= $this->input->get("dc_status");
		} else {
			$dc_status 	= null;
		}

		if (!empty($this->input->get("discipline"))) {
			$discipline 	= $this->input->get("discipline");
		} else {
			$discipline 	= null;
		}

		if (!empty($this->input->get("module"))) {
			$module 	= $this->input->get("module");
		} else {
			$module 	= null;
		}

		//START CHAINING
		$whr['status'] = 1;
		$data = array(
			'project_chain' 		 => $this->general_mod->data_project($whr),
			'module_chain' 			 => $this->general_mod->data_module(null),
			'project_chain_selected' => '',
			'module_chain_selected'  => ''
		);
		unset($whr);

		$data["active_project"]  = $this->general_mod->project();
		//END CHAINING


		$data['read_cookies'] 		= $this->user_cookie;
		$data['meta_title'] 		= 'Dimension Control List ';
		$data['subview']    		= 'dimension/dimension_control_list';
		$data['sidebar']    		= $this->sidebar;
		$data['read_permission']  	= $this->permission_cookie;
		// $data['status_dc']			= $param;

		$data['data_dc']			= $this->dimension_mod->data_dc_filter($project_id, $discipline, $module);
		// unset($where);

		$datadb  = $this->general_mod->portal_user_get_db();
		foreach ($datadb as $value) {
			$data['user_list'][$value['id_user']] = $value['full_name'];
		}

		$datadb = $this->general_mod->eng_module_get_db();
		foreach ($datadb as $value) {
			$data['module_list'][$value['mod_id']] = $value['mod_desc'];
		}

		$datadb  = $this->general_mod->eng_discipline_get_db();
		foreach ($datadb as $value) {
			$data['discipline_list'][$value['id']] = $value['discipline_name'];
		}

		$this->load->view('index', $data);
	}
	// end filter fucntion for dc 24 AUG 2020


	function dc_detail($submission_id)
	{

		$submission_id = $this->encryption->decrypt(strtr($submission_id, '.-~', '+=/'));

		$data['read_cookies'] 		= $this->user_cookie;
		$data['meta_title'] 		= 'Dimension Control Detail';
		$data['subview']    		= 'dimension/dimension_control_detail';
		$data['sidebar']    		= $this->sidebar;
		$data['read_permission']  	= $this->permission_cookie;

		$where['a.submission_id']		= $submission_id;
		$data['data_dc']			= $this->dimension_mod->data_dc($where);
		// $data['data_dc_attch']		= $this->dimension_mod->data_dc_attch($where);
		unset($where);

		$datadb  = $this->general_mod->portal_user_get_db();
		foreach ($datadb as $value) {
			$data['user_list'][$value['id_user']] = $value['full_name'];
		}

		$datadb = $this->general_mod->eng_module_get_db();
		foreach ($datadb as $value) {
			$data['module_list'][$value['mod_id']] = $value['mod_desc'];
		}

		$datadb  = $this->general_mod->eng_discipline_get_db();
		foreach ($datadb as $value) {
			$data['discipline_list'][$value['id']] = $value['discipline_name'];
		}

		$this->load->view('index', $data);
	}

	//ADD 25 AUG FOR UPLOAD ATTACHMENT
	function upload_new_attachment()
	{

		$data['read_cookies'] 		= $this->user_cookie;
		$data['meta_title'] 		= 'Dimension Control Detail';
		$data['subview']    		= 'dimension/dimension_control_detail';
		$data['sidebar']    		= $this->sidebar;
		$data['read_permission']  	= $this->permission_cookie;

		$report_number 	= $this->input->post('report_number');
		$submission_id 	 	= $this->input->post('submission_id');
		$upload_date 	= date("Y-m-d H:i:s");
		$upload_by 	 	= $this->user_cookie[0];
		$remarks 	 	= $this->input->post('remarks');

		//ATTACHMENT =======================================================================

		// $path = $_FILES['file_attachment']['name'];
		// $ext  = pathinfo($path, PATHINFO_EXTENSION);

		// $file_name_attach = $this->user_cookie[0].'-'.$submission_id.'-'.date('Ymd_His').".".$ext;
		// $file_input_name  = 'file_attachment';

		// $config['upload_path']   = 'upload/dimension_control';
		// $config['file_name']     = $file_name_attach;
		// $config['allowed_types'] = '*';
		// $config['max_size']      = '5000';

		// $this->load->library('upload', $config);
		// $this->upload->initialize($config);

		// if ( ! $this->upload->do_upload($file_input_name)){
		//     $this->session->set_flashdata('error', $this->upload->display_errors());
		//     echo "<script>javascript:window.location = document.referrer;</script>";
		// 	return false;

		// }

		//END ATTACHMENT ==================================================================


		$data_rdo = array(
			'project_id'    => '7',
			'report_number' => '7',
			'project_id'    => '7',
			'submission_id' 	    => $submission_id,
			'attachment'    => $file_name_attach,
			'remarks'	    => $remarks,
			'uploaded_by'   => $upload_by,
			'upload_on'	    => $upload_date
		);

		$this->dimension_mod->dc_attachment_add($data_rdo);

		echo "<script>javascript:window.location = document.referrer;</script>";
	}
	//END ADD 25 AUG FOR UPLOAD ATTACHMENT 

	//===================================================================================

	//ADD FUNCTION ======================================================================


	function dimension_control_add_process()
	{

		$type_of_report		= $this->input->post('type_of_report');
		$project 			= $this->input->post('project');
		$drawing_no			= $this->input->post('drawing_no');
		$discipline			= $this->input->post('discipline');
		$module				= $this->input->post('module');
		$type_of_module		= $this->input->post('type_of_module');
		$deck_elevation		= $this->input->post('deck_elevation');
		$requestor_company	= $this->input->post('requestor_company');
		$submit_date 		= date('Y-m-d', strtotime($this->input->post('submit_date')));
		$report_number		= $this->input->post('report_number');
		$dc_status			= $this->input->post('dc_status');
		$remarks_file		= $this->input->post('remarks_file');
		$requestor 			= $this->input->post('id_user');
		$rfi_no 			= $this->input->post('rfi_no');

		//=========================
		$dt_batch_no = $this->dimension_mod->get_last_batch_no();
		if (sizeof($dt_batch_no) == 0) {
			$submission_id = '000001';
		} else {
			$submission_id = str_pad($dt_batch_no[0]->submission_id + 1, 6, '0', STR_PAD_LEFT);
		}
		//==========================

		//QCS Dimension Control
		$data_dimension = array(
			'type_of_report'  	=> $type_of_report,
			'submission_id'  	=> $submission_id,
			'project_id' 	 	=> $project,
			'drawing_no'	 	=> $drawing_no,
			'discipline' 	 	=> $discipline,
			'module' 		 	=> $module,
			'type_of_module' 	=> $type_of_module,
			'deck_elevation' 	=> $deck_elevation,
			'requestor' 		=> $requestor,
			'requestor_company' => $requestor_company,
			'option_date' 		=> $submit_date,
			'result'			=> 0
		);
		$this->dimension_mod->dimension_control_add($data_dimension);
		//======================

		//Attachment
		$count = 0;

		$id_file_attch 		= $this->input->post('id_file_attch');
		$remarks_file 		= $this->input->post('remarks_file');

		$dataftp  = $this->general_mod->ftp_find_master($_SERVER["SERVER_ADDR"]);

		foreach ($id_file_attch as $key => $id_file) {

			//--------------------------------------------------------------//

			if ($_FILES['attachment_client']['name'][$key] != "") {

				// $attachment_client_name       = 'DC_'.uniqid().'_'.$this->user_cookie[0].'_'.$_FILES['attachment_client']['name'][$key];
				// $filepath                     = 'upload/';
				// move_uploaded_file($_FILES['attachment_client']['tmp_name'][$key], $filepath.$attachment_client_name);
				// require_once(APPPATH.'third_party/Net/SFTP.php');
				// $sftp       = new Net_SFTP($dataftp[0]['hostname']);
				// $fileName   = $attachment_client_name;			
				// if (!$sftp->login($dataftp[0]['username'], $dataftp[0]['password'])) {
				// 	$this->load->library('ftp');
				// 	$source                 = 'upload/'.$fileName;
				// 	$ftp_config['hostname'] = $dataftp[0]['hostname']; 
				// 	$ftp_config['username'] = $dataftp[0]['username'];
				// 	$ftp_config['password'] = $dataftp[0]['password'];
				// 	$ftp_config['debug']    = TRUE;
				// 	$this->ftp->connect($ftp_config);
				// 	$destination 			= 'pcms_v2_photo/dimension_control/'.$fileName;
				// 	$this->ftp->upload($source, $destination);
				// 	$this->ftp->close();
				// 	@unlink($source);
				// }  else { 
				// 	$destination_source = 'pcms_v2_photo';
				// 	$source             = 'upload/'.$fileName;
				// 	$destination        = '/var/www/'.$destination_source.'/dimension_control/'.$fileName;
				// 	$sftp->put($destination , $source, NET_SFTP_LOCAL_FILE);
				// 	@unlink($source);					
				// } 

				require_once(APPPATH . 'third_party/Net/SFTP.php');
				$ftp                        = $this->ftp;
				$sftp                       = new Net_SFTP($ftp['hostname']);
				$destination_source         = '/PCMS/pcms_v2/additional_attachment/dimension_control/';
				if (!$sftp->login($ftp['username'], $ftp['password'])) {
					$this->session->set_flashdata('error', 'FTP Server Not Working');
					redirect($_SERVER['HTTP_REFERER']);
				}
				$filetype           = pathinfo($_FILES['attachment_client']['name'][$key]);
				$filetype           = $filetype['extension'];
				if ($filetype == "pdf") {
					$filename           = 'Dimension_control_attachment_' . $this->user_cookie[0] . '_' . uniqid() . '_.' . $filetype;
					$attach_line_name   = $filename;
					$filepath           = 'upload/';
					move_uploaded_file($_FILES['attachment_client']['tmp_name'][$key], $filepath . $attach_line_name);
					$fileName                 = $attach_line_name;
					$source                   = $filepath . $attach_line_name;
					$destination              = $destination_source . $attach_line_name;
					$sftp->put($destination, $source, NET_SFTP_LOCAL_FILE);
					// @unlink($source); 
				} else {
					$this->session->set_flashdata('error', 'Only For PDF File..!');
					redirect($_SERVER['HTTP_REFERER']);
				}

				if ($type_of_report == 1) {
					$form_data = [
						'project_id' 	=> $project,
						'dc_status' 	=> $dc_status[$key],
						'report_number' => $report_number[$key],
						'rfi_no' 		=> $rfi_no[$key],
						'submission_id' => $submission_id,
						'attachment' 	=> $fileName,
						'remarks'		=> $remarks_file[$key],
						'uploaded_by' 	=> $this->user_cookie[0],
						'upload_on'		=> date('Y-m-d H:i:s')
					];
				} else {
					$form_data = [
						'project_id' 	=> $project,
						'report_number' => $report_number[$key],
						'rfi_no' 		=> $rfi_no[$key],
						'submission_id' => $submission_id,
						'attachment' 	=> $fileName,
						'remarks'		=> $remarks_file[$key],
						'uploaded_by' 	=> $this->user_cookie[0],
						'upload_on'		=> date('Y-m-d H:i:s')
					];
				}


				$this->dimension_mod->dimension_control_add_attch($form_data);
				unset($form_data);
			}

			//--------------------------------------------------------------//

			$count++;
		}

		$this->session->set_flashdata('success', 'Data created successful!');
		redirect('additional/dc_list/' . strtr($this->encryption->encrypt($type_of_report), '+=/', '.-~'));
	}

	function dc_update()
	{
		//Attachment
		$count = 0;

		$id 				= $this->input->post('id_dc');
		$submission_id 			= $this->input->post('submission_id');
		$id_file_attch 		= $this->input->post('id_file_attch');
		$remarks_file 		= $this->input->post('remarks_file');
		$uploaded_by 		= $this->input->post('uploaded_by');
		$uploaded_on 		= $this->input->post('uploaded_on');
		$result 			= $this->input->post('submit');

		$id_user			= $this->user_cookie;

		if (empty($_FILES['file_attch_1']['name'])) { //KALAU FILE ATTACH KOSONG
			if ($result == 1) {
				$data_status = array(
					'result' 	=> $result
				);

				$log = array(
					'project_code'	=> $id_user[10],
					'discipline'	=> '0'
				);
				$this->dimension_mod->dimension_control_approval($log, $id, $data_status);
			}
		} else { //KALAU ADA FILE ATTACH
			foreach ($id_file_attch as $id_file) {
				$name_file 			= $id_user[0] . '-' . $submission_id . '-' . date('YmdHis') . '-' . $count;

				$config['upload_path']          = 'upload/dimension_control';
				$config['file_name']            = $name_file;
				$config['allowed_types']        = 'pdf';
				$config['max_size']        		= '2000';

				$this->load->library('upload', $config);

				$this->upload->initialize($config);

				if (!$this->upload->do_upload('file_attch_' . $id_file)) {

					$this->session->set_flashdata('error', $this->upload->display_errors());

					redirect('additional/dc_list/draft');
					return false;
				}

				$data_attch = array(
					'submission_id' 		=> $submission_id,
					'attachment' 	=> $this->upload->data('file_name'),
					'remarks'		=> $remarks_file[$count],
					'uploaded_by' 	=> $id_user[0],
					'upload_on'		=> date('Y-m-d H:i:s')
				);

				$log = array(
					'project_code'	=> $id_user[10],
					'discipline'	=> '0'
				);

				$this->dimension_mod->dimension_control_add_attch($data_attch, $log);

				$count++;
			}

			if ($result == 1) {

				$data_status = array(
					'result' 	=> $result
				);

				$this->dimension_mod->dimension_control_approval($log, $id, $data_status);
			}
		}

		$this->session->set_flashdata('success', 'Data updated successful!');

		redirect('additional/dc_list/draft');
		//////////////
	}

	function dc_approval_proccess()
	{

		$id_user = $this->user_cookie;

		$id = $this->input->post('id_dc');

		$status_approval = $this->input->post('status_approval');

		if ($status_approval == 3) {

			$module 	= $this->input->post('module');
			$user_id 	= $this->input->post('user_id');
			$report_no  = $this->input->post('report_no');

			redirect('additional/manual_sign/' . $module . '/' . $user_id . '/' . $report_no . '/' . $id);
		} else if ($status_approval == 2) {

			$remarks_reject = $this->input->post('remarks_reject');
			$approved_by = 0;
			$rejected_by = $id_user[0];
			$str_status = "rejected";

			$data_approval = array(
				'result' 		=> $status_approval,
				'reject_remarks' => $remarks_reject,
				'approved_by'	=> $approved_by,
				'rejected_by'	=> $rejected_by
			);

			$log = array(
				'project_code'	=> $id_user[10],
				'discipline'	=> '0'
			);
			$this->dimension_mod->dimension_control_approval($log, $id, $data_approval);

			$this->session->set_flashdata('success', 'Data updated successful!');

			redirect('additional/dc_list/' . $str_status);
		}
	}


	public function manual_sign($module = null, $user_id = null, $report_no = null, $id_dc = null)
	{


		if (!empty($this->input->post('save'))) {

			$id = $this->input->post('id_dc');
			$report_no = $this->input->post('report_no');

			$id_user		= $this->user_cookie;

			$remarks_reject = "";
			$approved_by 	= $id_user[0];
			$rejected_by 	= 0;
			$str_status 	= "approved";

			$data_approval = array(
				'result' 		=> 3,
				'reject_remarks' => $remarks_reject,
				'approved_by'	=> $approved_by,
				'rejected_by'	=> $rejected_by
			);

			//print_r($id);
			//return false;

			$log = array(
				'project_code'	=> $id_user[10],
				'discipline'	=> '0'
			);

			$this->dimension_mod->dimension_control_approval($log, $id, $data_approval, $report_no);

			$this->session->set_flashdata('success', 'Data updated successful IT!');

			redirect('additional/dc_list/' . $str_status);
		}

		$data['read_cookies'] 	 = $this->user_cookie;
		$data['read_permission'] = $this->permission_cookie;

		$data['meta_title'] 	= 'Material Verify';
		$data['subview']    	= 'dimension/manual_approval';
		$data['sidebar']    	= $this->sidebar;
		$data['module']    		= $module;
		$data['user_id']    	= $user_id;
		$data['id_dc']    		= $id_dc;
		$data['report_no']    	= $report_no;

		$this->load->view('index', $data);
	}
	//===================================================================================

	//SEARCH DATA =======================================================================
	function check_draw_no_by_input()
	{
		$draw_no = $this->input->post('draw_no');
		$where['drawing_no'] = $draw_no;
		$data_draw_on_eng = $this->dimension_mod->data_draw_eng($where);
		$data_draw_on_dc = $this->dimension_mod->data_draw_dc($where);
		unset($where);

		$nilai = 0;
		$msg = "Error: Drawing Number Not Found";
		$drawing_no = "";

		if (sizeof($data_draw_on_eng) != 0) {
			if (sizeof($data_draw_on_dc) == 0) {
				$drawing_no = $data_draw_on_eng[0]['drawing_no'];
				$nilai = 1;
				$msg = "";

				// FOR DISCIPLINE ====================================
				$id_discipline = $data_draw_on_eng[0]['discipline'];
				$where['id'] = $id_discipline;
				$dt_discipline = $this->general_mod->discipline_list($where);
				unset($where);
				$name_discipline = $dt_discipline[0]['discipline_name'];
				//====================================================

				// FOR MODULE ========================================
				$id_module = $data_draw_on_eng[0]['module'];
				$where['mod_id'] = $id_module;
				$dt_module = $this->general_mod->data_module($where);
				unset($where);
				$name_module = $dt_module[0]['mod_desc'];
				//====================================================

			} else {
				$msg = "Error: Duplicate Drawing Number";
			}
		}

		$pesan = json_encode(array(
			"nilai" => $nilai,
			"msg" => $msg,
			"drawing_no" => $drawing_no,
			"id_discipline" => @$id_discipline,
			"name_discipline" => @$name_discipline,
			"id_module" => @$id_module,
			"name_module" => @$name_module
		));

		echo $pesan;
	}
	//===================================================================================

	//DELETE FUNCTION ===================================================================

	function delete_file_attch_process()
	{
		$id = $this->input->post('id_file');

		$where['id'] = $id;
		$this->dimension_mod->delete_dc_attch($where);
		unset($where);
	}

	//===================================================================================

	// AUTOCOMPLETE DRAWING NO ==========================================================
	function dc_check_drawing()
	{
		$drawing_no = $this->input->post('drawing_no');
		if (isset($_GET['term'])) {
			$result = $this->dimension_mod->search_drawing($_GET['term'], $drawing_no);
			if ($result == TRUE) {
				foreach ($result as $row)
					$arr_result[] = $row['drawing_no'];
				echo json_encode($arr_result);
			} else {
				$arr_result[] = "Drawing Not Found";
				echo json_encode($arr_result);
			}
		}
	}
	//===================================================================================
	public function attachment_delete($id, $attachment_filename, $batch_detail = Null)
	{

		if ($this->dimension_mod->attachment_delete($id)) {
			#unlink("upload/dimension_control/".$attachment_filename);
		}

		redirect('dimension/dc_detail/' . $batch_detail);
	}

	public function export_data_additional_report($get_filter = null, $type_of_report = null)
	{
		error_reporting(0);
		$datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['project_code']] = $value;
			$data['project_code'][$value['id']] = $value['project_code'];
		}
		$data['project_list'] = $project_list;

		$datadb  = $this->general_mod->portal_user_get_db();
		foreach ($datadb as $value) {
			$data['user_list'][$value['id_user']] = $value['full_name'];
		}

		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['mod_id']] = $value;
			$data['module_code'][$value['mod_id']] = $value['mod_desc'];
		}
		$data['module_list'] = $module_list;

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['initial']] = $value;
			$data['discipline_code'][$value['id']] = $value['initial'];
			$data['discipline_name'][$value['id']] = $value['discipline_name'];
		}
		$data['discipline_list'] = $discipline_list;

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
			$data['type_of_module_code'][$value['id']] = $value['code'];
			$data['type_of_module_name'][$value['id']] = $value['name'];
		}
		$data['type_of_module_list'] = $type_of_module_list;

		$where['status_delete']   = 1;
		$data['deck_list']        = $this->general_mod->deck_elevation($where);
		foreach ($data['deck_list'] as $value) {
			$data['deck_elevation_show'][$value['id']] = $value['name'];
		}
		unset($where);

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
			$data['type_of_module_code'][$value['id']] = $value['code'];
			$data['type_of_module_name'][$value['id']] = $value['name'];
		}
		$data['type_of_module_list'] = $type_of_module_list;

		$data['post'] = $get_filter;

		$where["a.project_id IN (" . join(", ", $this->user_cookie[13]) . ")"] = NULL;
		if (!empty($data['post']["project"])) {
			$where["a.project_id"]	= $data['post']["project"];
		}

		if (!empty($data['post']["dc_status"]) && isset($data['post']["dc_status"])) {
			$where["b.dc_status"]	= $data['post']["dc_status"];
		}

		if (!empty($data['post']["discipline"]) && isset($data['post']["discipline"])) {
			$where["a.discipline"] 	= $data['post']["discipline"];
		}

		if (!empty($data['post']["module"]) && isset($data['post']["module"])) {
			$where["a.module"] 	= $data['post']["module"];
		}

		if (!empty($data['post']["type_of_module"]) && isset($data['post']["type_of_module"])) {
			$where["a.type_of_module"] 	= $data['post']["type_of_module"];
		}

		if (!empty($data['post']["deck_elevation"]) && isset($data['post']["deck_elevation"])) {
			$where["a.deck_elevation"] 	= $data['post']["deck_elevation"];
		}

		if (!empty($type_of_report) && isset($type_of_report)) {
			$where["a.type_of_report"] = $type_of_report;
		}

		$where["b.report_number IS NOT NULL"] = null;
		$where["a.status_delete"] 	= 0;
		$data['data_dc']			= $this->dimension_mod->data_dc($where);
		unset($where);


		$id_detail_dimension = [];
		$submission_id_arr = [];
		$datadb = $this->irn_mod->show_irn_dc([
			"categories_attach" => '0',
		]);
		foreach ($datadb as $key => $value) {
			$id_detail_dimension[$value['id_detail_dimension']][] = $value['submission_id'];
			$submission_id_arr[] = $value['submission_id'];
		}
		$submission_id_arr = array_unique($submission_id_arr);

		$room_list = [];
		$datadb = $this->irn_mod->show_pcms_irn_description();
		foreach ($datadb as $key => $value) {
			if ($value['room'] != '' && in_array($value['submission_id'], $submission_id_arr)) {
				$room_list[$value['submission_id']] = $value['room'];
			}
		}

		$datadb = $this->general_mod->master_report_number([
			"report_no ilike '%irn%'" => NULL,
		]);
		$master_report_number = [];
		foreach ($datadb as $key => $value) {
			$master_report_number[$value['project']][$value['discipline']][$value['type_of_module']][$value['category']] = $value['report_no'];
		}

		$irn_list = [];
		$datadb = $this->irn_mod->irn_new_list_joint_new([
			"category_irn" => 0,
			"report_number IS NOT NULL" => NULL,
		]);
		foreach ($datadb as $key => $value) {
			if ($value['company_id'] != 13) {
				$irn_list[$value['submission_id']] = $master_report_number[$value['project']][$value['discipline']][$value['type_of_module']]["irn_report"] . $value['report_number'];
			} else {
				$irn_list[$value['submission_id']] = $master_report_number[$value['project']][$value['discipline']][$value['type_of_module']]["irn_report_scm"] . $value['report_number'];
			}
		}

		if ($type_of_report == 1) {
			$meta = "Dimension Control";
		} else if ($type_of_report == 2) {
			$meta = "Correction Of Distortion";
		} else if ($type_of_report == 3) {
			$meta = "Excavation";
		} else if ($type_of_report == 4) {
			$meta = "Buttering";
		} else {
			$meta = "Additional Report";
		}


		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
		$objPHPExcel    = @new PHPExcel();
		$row = $objPHPExcel->setActiveSheetIndex(0);

		$styleArray_headerTab                     = array(
			'borders'                   => array(
				'allborders'              => array(
					'style'                 => PHPExcel_Style_Border::BORDER_THIN
				)
			),
			'alignment'                 => array(
				'horizontal'            => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'ffffff')
			),
			'font' => array(
				'color' => array('rgb' => '000000')
			)
		);
		$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($styleArray_headerTab);
		$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getAlignment()->setWrapText(true);

		$row->setCellValue('A1',  'No');
		$row->setCellValue('B1',  'RFI Number');
		$row->setCellValue('C1',  'Report Number');
		$row->setCellValue('D1',  'Drawing Number');
		$row->setCellValue('E1',  'Discipline');
		$row->setCellValue('F1',  'Module');
		$row->setCellValue('G1',  'Type Of Module');
		$row->setCellValue('H1',  'Deck Elevation / Service Line');
		$row->setCellValue('I1',  'Request Company');
		$row->setCellValue('J1',  'Requestor');
		$row->setCellValue('K1',  'Date');
		$row->setCellValue('L1',  'Link');
		$row->setCellValue('M1',  'IRN No.');
		$row->setCellValue('N1',  'Room No.');

		$styleArray                     = array(
			'borders'                   => array(
				'allborders'              => array(
					'style'                 => PHPExcel_Style_Border::BORDER_THIN
				)
			)
		);

		$row_num = 2;
		$no = 1;
		foreach ($data['data_dc'] as $key => $value) :

			$objPHPExcel->getActiveSheet()->getStyle('A' . $row_num . ':N' . $row_num . '')->applyFromArray($styleArray);

			$links = "https://www.smoebatam.com/pcms_v2_photo/dimension_control/" . $value['attachment'];

			$row->setCellValue('A' . $row_num,  $no);
			$row->setCellValue('B' . $row_num,  $value['rfi_no']);
			$row->setCellValue('C' . $row_num,  $value['report_number']);
			$row->setCellValue('D' . $row_num,  $value['drawing_no']);
			$row->setCellValue('E' . $row_num, (isset($data['discipline_name'][$value['discipline']]) ? $data['discipline_name'][$value['discipline']] : '-'));
			$row->setCellValue('F' . $row_num, (isset($data['module_code'][$value['module']]) ? $data['module_code'][$value['module']] : '-'));
			$row->getStyle('F' . $row_num)->getAlignment()->setWrapText(true);
			$row->setCellValue('G' . $row_num, (isset($data['type_of_module_name'][$value['type_of_module']]) ? $data['type_of_module_name'][$value['type_of_module']] : '-'));
			$row->setCellValue('H' . $row_num, (isset($data['deck_elevation_show'][$value['deck_elevation']]) ? $data['deck_elevation_show'][$value['deck_elevation']] : '-'));
			$row->setCellValue('I' . $row_num,  $value['requestor_company']);
			$row->setCellValue('J' . $row_num, (isset($data['user_list'][$value['requestor']]) ? $data['user_list'][$value['requestor']] : '-'));
			$row->setCellValue('K' . $row_num,  date('Y-m-d', strtotime($value['option_date'])));
			$row->setCellValue('L' . $row_num,  "Download File");
			$row->getHyperlink('L' . $row_num)->setUrl($links);
			$row->getStyle('L' . $row_num)->getAlignment()->setWrapText(true);

			$row_irn = [];
			$row_room = [];
			foreach ($id_detail_dimension[$value['id_dc_detail_attach']] ?? [] as $submission_id) {
				$row_irn[] = @$irn_list[$submission_id];
				$row_room[] = @$room_list[$submission_id];
			}
			$row->setCellValue('M' . $row_num,  join(", \r", $row_irn));
			$row->setCellValue('N' . $row_num,  join(", \r", $row_room));

			$no++;
			$row_num++;
		endforeach;

		for ($i = "A"; $i !== "O"; $i++) {
			$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setWrapText(true);
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment;filename=Additional_report_Download.xlsx");
		header('Cache-Control: max-age=0');
		header('Cache-Control: max-age=1');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
		header('Cache-Control: cache, must-revalidate');
		header('Pragma: public'); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		unset($objPHPExcel);
	}

	public function delete_submission($submission_id)
	{

		$submission_id = $this->encryption->decrypt(strtr($submission_id, '.-~', '+=/'));

		$data_update =  array(
			"status_delete" => '1',
		);

		$delete_dc_data   = $this->dimension_mod->dimension_update($submission_id, $data_update);
		$delete_dc_attach = $this->dimension_mod->dimension_update_attach($submission_id, $data_update);
		unset($where);
		unset($data_update);

		$this->session->set_flashdata('success', 'Data has been deleted!');

		echo "<script>javascript:window.location = document.referrer;</script>";
	}

	function additional_report($type_of_report = NULL)
	{

		$type_of_report = $this->encryption->decrypt(strtr($type_of_report, '.-~', '+=/'));

		$datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['project_code']] = $value;
			$data['project_code'][$value['id']] = $value['project_code'];
		}
		$data['project_list'] = $project_list;

		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['mod_id']] = $value;
			$data['module_code'][$value['mod_id']] = $value['mod_desc'];
		}
		$data['module_list'] = $module_list;

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['initial']] = $value;
			$data['discipline_code'][$value['id']] = $value['initial'];
			$data['discipline_name'][$value['id']] = $value['discipline_name'];
		}
		$data['discipline_list'] = $discipline_list;

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
			$data['type_of_module_code'][$value['id']] = $value['code'];
			$data['type_of_module_name'][$value['id']] = $value['name'];
		}
		$data['type_of_module_list'] = $type_of_module_list;

		$where['status_delete']   = 1;
		$data['deck_list']        = $this->general_mod->deck_elevation($where);
		foreach ($data['deck_list'] as $value) {
			$data['deck_elevation_show'][$value['id']] = $value['name'];
		}
		unset($where);

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
			$data['type_of_module_code'][$value['id']] = $value['code'];
			$data['type_of_module_name'][$value['id']] = $value['name'];
		}
		$data['type_of_module_list'] = $type_of_module_list;

		$data['post'] = $this->input->post();
		$submit		  =	$this->input->post('submit');


		if ($submit == "export_excel") {
			return $this->export_additional_report($type_of_report, $data['post']);
		}

		$where["b.project IN (" . join(", ", $this->user_cookie[13]) . ")"] = NULL;
		if (!empty($this->input->post("project"))) {
			$where["b.project"] 	= $this->input->post("project");
		}

		if (!empty($this->input->post("discipline"))) {
			$where["b.discipline"] 	= $this->input->post("discipline");
		}

		if (!empty($this->input->post("module"))) {
			$where["b.module"] 	= $this->input->post("module");
		}

		if (!empty($this->input->post("type_of_module"))) {
			$where["b.type_of_module"] 	= $this->input->post("type_of_module");
		}

		if (!empty($this->input->post("deck_elevation"))) {
			$where["b.deck_elevation"] 	= $this->input->post("deck_elevation");
		}


		$where["a.type_of_report"]	= $type_of_report;
		$where["a.report_number IS NOT NULL"] = null;
		$where["b.status_delete"] 	= 1;
		$data['data_additional_report']	 = $this->dimension_mod->data_additional_report($where);
		unset($where);

		if (sizeof($data['data_additional_report']) > 0) {
			$id_user_1   = array_column($data['data_additional_report'], 'create_by');
			$id_user_all = array_unique(array_filter($id_user_1));
			$where_user["id_user IN ('" . implode("', '", $id_user_all) . "')"] = NULL;
			$datadb  = $this->general_mod->portal_user_db_list($where_user);
			foreach ($datadb as $value) {
				$data['user_list'][$value['id_user']] = $value['full_name'];
			}
		}


		if ($type_of_report == 0) {
			$meta = "Hardness Testing";
		} else if ($type_of_report == 1) {
			$meta = "Correction Of Distortion";
		} else if ($type_of_report == 2) {
			$meta = "Excavation";
		} else if ($type_of_report == 3) {
			$meta = "Buttering";
		} else if ($type_of_report == 4) {
			$meta = "Borescope Survey Reports";
		} else {
			$meta = "-";
		}
		$data['meta_title'] 	 = $meta;

		$data['type_of_report']  = $type_of_report;
		$data['read_cookies'] 	 = $this->user_cookie;
		$data['subview']    	 = 'dimension/additional_attach';
		$data['sidebar']    	 = $this->sidebar;
		$data['read_permission'] = $this->permission_cookie;

		$this->load->view('index', $data);
	}

	function add_additional($type_of_report = NULL)
	{

		$type_of_report = $this->encryption->decrypt(strtr($type_of_report, '.-~', '+=/'));

		$datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['project_code']] = $value;
			$data['project_code'][$value['id']] = $value['project_code'];
		}
		$data['project_list'] = $project_list;


		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['mod_id']] = $value;
			$data['module_code'][$value['mod_id']] = $value['mod_desc'];
		}
		$data['module_list'] = $module_list;

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['initial']] = $value;
			$data['discipline_code'][$value['id']] = $value['initial'];
			$data['discipline_name'][$value['id']] = $value['discipline_name'];
		}
		$data['discipline_list'] = $discipline_list;

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
			$data['type_of_module_code'][$value['id']] = $value['code'];
			$data['type_of_module_name'][$value['id']] = $value['name'];
		}
		$data['type_of_module_list'] = $type_of_module_list;

		$where['status_delete']   = 1;
		$data['deck_list']        = $this->general_mod->deck_elevation($where);
		foreach ($data['deck_list'] as $value) {
			$data['deck_elevation_show'][$value['id']] = $value['name'];
		}
		unset($where);

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
			$data['type_of_module_code'][$value['id']] = $value['code'];
			$data['type_of_module_name'][$value['id']] = $value['name'];
		}
		$data['type_of_module_list'] = $type_of_module_list;

		$data['post'] = $this->input->post();

		$submit	= $this->input->post('submit');

		if (!empty($this->input->post("discipline"))) {
			$where["a.discipline"] 	= $this->input->post("discipline");
		}

		if (!empty($this->input->post("module"))) {
			$where["a.module"] 	= $this->input->post("module");
		}

		if (!empty($this->input->post("type_of_module"))) {
			$where["a.type_of_module"] 	= $this->input->post("type_of_module");
		}

		if (!empty($this->input->post("deck_elevation"))) {
			$where["a.deck_elevation"] 	= $this->input->post("deck_elevation");
		}

		if (!empty($this->input->post("drawing_no")) && !empty($this->input->post("drawing_wm"))) {

			$where["a.drawing_no"] 	= $this->input->post("drawing_no");
			$where["a.drawing_wm"] 	= $this->input->post("drawing_wm");
			$where["a.status_delete"] 	= 1;
			$data['data_additional_report']			= $this->dimension_mod->data_additional_report_joint($where, $type_of_report);
			unset($where);
		} else {
			$data['data_additional_report']			= null;
		}


		if ($type_of_report == 0) {
			$meta = "Hardness Testing";
		} else if ($type_of_report == 1) {
			$meta = "Correction Of Distortion";
		} else if ($type_of_report == 2) {
			$meta = "Excavation";
		} else if ($type_of_report == 3) {
			$meta = "Buttering";
		} else if ($type_of_report == 4) {
			$meta = "Borescope Survey Reports";
		} else {
			$meta = "-";
		}
		$data['meta_title'] 	 = $meta;

		$data['type_of_report']  = $type_of_report;
		$data['read_cookies'] 	 = $this->user_cookie;
		$data['subview']    	 = 'dimension/additional_attach_new';
		$data['sidebar']    	 = $this->sidebar;
		$data['read_permission'] = $this->permission_cookie;

		$this->load->view('index', $data);
	}


	function save_additional_report()
	{

		$post = $this->input->post();
		$data['post'] = $post;
		// test_var($post);

		if ($post["count_checked"] > 0) {

			$path = $_FILES['attachment_file']['name'];
			$ext  = pathinfo($path, PATHINFO_EXTENSION);


			$file_name_attach = $this->user_cookie[0] . '-' . $post["type_of_report"] . '-' . date('Ymd_His') . "." . $ext;
			$file_input_name  = 'attachment_file';

			$config['upload_path']   = 'upload/ndt/';
			$config['file_name']     = $file_name_attach;
			$config['allowed_types'] = 'pdf';
			// $config['max_size']      = '10000';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload($file_input_name)) {
				$this->session->set_flashdata('error', $this->upload->display_errors());
				echo "<script>javascript:window.location = document.referrer;</script>";
				return false;
			}

			$upload_data = $this->upload->data();
			$fileName = $file_name_attach;
			include APPPATH . 'third_party/Net/SFTP.php';
			$sftp = new Net_SFTP(getenv('FTP_SINOLOGI_HOST'));
			if (!$sftp->login(getenv('FTP_SINOLOGI_USER'), getenv('FTP_SINOLOGI_PASS'))) {
				test_var("CANNOT LOGIN SFTP");
			}
			$source = 'upload/ndt/' . $file_name_attach;
			$destination  = '/PCMS/pcms_v2/additional_attachment/' . $fileName;
			$sftp->put($destination, $source, NET_SFTP_LOCAL_FILE);

			// @unlink($source); 
			$arr_directory_rt	= $sftp->rawlist('/PCMS/pcms_v2/additional_attachment/');

			if (!$arr_directory_rt[$fileName]) {
				$this->session->set_flashdata('error', 'Failed to Upload File!');
				echo "<script>javascript:window.location = document.referrer;</script>";
				return;
			}

			$uniq_id = uniqid();
			$current_date = date("Y-m-d H:i:s");

			foreach ($post["check_status"] as $key => $value) {
				if ($value == 1) {

					$data_file = array(
						"id_joint"		 		=> $post["id_joint_temp"][$key],
						"rfi_number" 			=> $post["rfi_no"],
						"report_number" 		=> $post["report_no"],
						"type_of_report" 		=> $post["type_of_report"],
						"submission_id"			=> $uniq_id,
						"date_of_inspection" 	=> $post["inspection_actual_date"],
						"create_by" 			=> $this->user_cookie[0],
						"created_date" 			=> $current_date,
						"attachment_file" 		=> $file_name_attach,
					);

					$save = $this->dimension_mod->insert_additional_report($data_file);
				}
			}

			$form_data = [
				"submission_id" => $uniq_id,
				'category' => $post["type_of_report"],
				'rfi_no' => $post['rfi_no'],
				'drawing_no' => $post['drawing_no'],
				'project' => $post['project_id'],
				'discipline' => $post['discipline'],
				'module' => $post['module'],
				'type_of_module' => $post['type_of_module'],
				'company_id' => $post['company'],
				'remarks' => $post['remarks'],
				'created_by' => $this->user_cookie[0],
			];
			$id_rfi = $this->dimension_mod->rfi_additional_report_insert_process($form_data);

			$this->session->set_flashdata('success', 'Submit Success!');
			echo "<script>javascript:window.location = document.referrer;</script>";
		} else {
			$this->session->set_flashdata('error', 'Error!');
			echo "<script>javascript:window.location = document.referrer;</script>";
		}
	}

	public function open_atc($filename)
	{

		$encrypt_certif       = strtr($this->encryption->encrypt($filename), '+=/', '.-~');
		$encrypt_remote_loc   = strtr($this->encryption->encrypt('/PCMS/pcms_v2/additional_attachment'), '+=/', '.-~');

		redirect('irn/open_file/' . $encrypt_certif . '/' . $encrypt_remote_loc . '/download');
	}

	function detail_additional($type_of_report, $submission_id)
	{

		$submission_id = $this->encryption->decrypt(strtr($submission_id, '.-~', '+=/'));
		$type_of_report = $this->encryption->decrypt(strtr($type_of_report, '.-~', '+=/'));

		$datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['project_code']] = $value;
			$data['project_code'][$value['id']] = $value['project_code'];
		}
		$data['project_list'] = $project_list;

		$datadb  = $this->general_mod->portal_user_get_db();
		foreach ($datadb as $value) {
			$data['user_list'][$value['id_user']] = $value['full_name'];
		}

		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['mod_id']] = $value;
			$data['module_code'][$value['mod_id']] = $value['mod_desc'];
		}
		$data['module_list'] = $module_list;

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['initial']] = $value;
			$data['discipline_code'][$value['id']] = $value['initial'];
			$data['discipline_name'][$value['id']] = $value['discipline_name'];
		}
		$data['discipline_list'] = $discipline_list;

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
			$data['type_of_module_code'][$value['id']] = $value['code'];
			$data['type_of_module_name'][$value['id']] = $value['name'];
		}
		$data['type_of_module_list'] = $type_of_module_list;

		$where['status_delete']   = 1;
		$data['deck_list']        = $this->general_mod->deck_elevation($where);
		foreach ($data['deck_list'] as $value) {
			$data['deck_elevation_show'][$value['id']] = $value['name'];
		}
		unset($where);

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
			$data['type_of_module_code'][$value['id']] = $value['code'];
			$data['type_of_module_name'][$value['id']] = $value['name'];
		}
		$data['type_of_module_list'] = $type_of_module_list;

		$where["b.submission_id"] = $submission_id;
		$data['data_additional_report']	 = $this->dimension_mod->data_additional_report_joint($where, $type_of_report);
		unset($where);




		if ($type_of_report == 0) {
			$meta = "Hardness Testing";
		} else if ($type_of_report == 1) {
			$meta = "Correction Of Distortion";
		} else if ($type_of_report == 2) {
			$meta = "Excavation";
		} else if ($type_of_report == 3) {
			$meta = "Buttering";
		} else {
			$meta = "-";
		}
		$data['meta_title'] 	 = $meta;

		$data['type_of_report']  = $type_of_report;
		$data['read_cookies'] 	 = $this->user_cookie;
		$data['subview']    	 = 'dimension/additional_attach_detail';
		$data['sidebar']    	 = $this->sidebar;
		$data['read_permission'] = $this->permission_cookie;

		$this->load->view('index', $data);
	}


	function update_additional_report()
	{

		$data["post"] = $this->input->post();

		if ($data["post"]["submission_id"]) {


			if ($_FILES['attachment_file']['name'] != "") {

				$path = $_FILES['attachment_file']['name'];
				$ext  = pathinfo($path, PATHINFO_EXTENSION);


				$file_name_attach = $this->user_cookie[0] . '-' . $data["post"]["type_of_report"] . '-' . date('Ymd_His') . "." . $ext;
				$file_input_name  = 'attachment_file';

				$config['upload_path']   = 'upload/ndt/';
				$config['file_name']     = $file_name_attach;
				$config['allowed_types'] = 'pdf';
				// $config['max_size']      = '10000';

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (!$this->upload->do_upload($file_input_name)) {
					$this->session->set_flashdata('error', $this->upload->display_errors());
					echo "<script>javascript:window.location = document.referrer;</script>";
					return false;
				}

				$upload_data = $this->upload->data();
				$fileName = $file_name_attach;
				include APPPATH . 'third_party/Net/SFTP.php';
				$sftp = new Net_SFTP(getenv('FTP_SINOLOGI_HOST'));
				if (!$sftp->login(getenv('FTP_SINOLOGI_USER'), getenv('FTP_SINOLOGI_PASS'))) {
					test_var("CANNOT LOGIN SFTP");
				}
				$source = 'upload/ndt/' . $file_name_attach;
				$destination  = '/PCMS/pcms_v2/additional_attachment/' . $fileName;
				$sftp->put($destination, $source, NET_SFTP_LOCAL_FILE);

				// @unlink($source); 
				$arr_directory_rt	= $sftp->rawlist('/PCMS/pcms_v2/additional_attachment/');

				if (!$arr_directory_rt[$fileName]) {
					$this->session->set_flashdata('error', 'Failed to Upload File!');
					echo "<script>javascript:window.location = document.referrer;</script>";
					return;
				}

				$data_file = array(
					"rfi_number" 			=> $data["post"]["rfi_number"],
					"report_number" 		=> $data["post"]["report_number"],
					"type_of_report" 		=> $data["post"]["type_of_report"],
					"date_of_inspection" 	=> $data["post"]["date_of_inspection"],
					"attachment_file" 		=> $file_name_attach,
				);
			} else {
				$data_file = array(
					"rfi_number" 			=> $data["post"]["rfi_number"],
					"report_number" 		=> $data["post"]["report_number"],
					"type_of_report" 		=> $data["post"]["type_of_report"],
					"date_of_inspection" 	=> $data["post"]["date_of_inspection"],
				);
			}

			$where["submission_id"] = $data["post"]["submission_id"];

			$save = $this->dimension_mod->update_additional_report($where, $data_file);
			unset($data_file);
			unset($where);

			$this->session->set_flashdata('success', 'Submit Success!');
			echo "<script>javascript:window.location = document.referrer;</script>";
		} else {
			$this->session->set_flashdata('error', 'Error!');
			echo "<script>javascript:window.location = document.referrer;</script>";
		}
	}

	function export_additional_report($type_of_report, $data_post)
	{

		$datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['project_code']] = $value;
			$data['project_code'][$value['id']] = $value['project_code'];
		}
		$data['project_list'] = $project_list;

		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['mod_id']] = $value;
			$data['module_code'][$value['mod_id']] = $value['mod_desc'];
		}
		$data['module_list'] = $module_list;

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['initial']] = $value;
			$data['discipline_code'][$value['id']] = $value['initial'];
			$data['discipline_name'][$value['id']] = $value['discipline_name'];
		}
		$data['discipline_list'] = $discipline_list;

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
			$data['type_of_module_code'][$value['id']] = $value['code'];
			$data['type_of_module_name'][$value['id']] = $value['name'];
		}
		$data['type_of_module_list'] = $type_of_module_list;

		$where['status_delete']   = 1;
		$data['deck_list']        = $this->general_mod->deck_elevation($where);
		foreach ($data['deck_list'] as $value) {
			$data['deck_elevation_show'][$value['id']] = $value['name'];
		}
		unset($where);

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
			$data['type_of_module_code'][$value['id']] = $value['code'];
			$data['type_of_module_name'][$value['id']] = $value['name'];
		}
		$data['type_of_module_list'] = $type_of_module_list;

		$where["b.project IN (" . join(", ", $this->user_cookie[13]) . ")"] = NULL;
		if (!empty($data_post["project"])) {
			$where["b.project"] 	= $data_post["project"];
		}

		if (!empty($data_post["discipline"])) {
			$where["b.discipline"] 	= $data_post["discipline"];
		}

		if (!empty($data_post["module"])) {
			$where["b.module"] 	= $data_post["module"];
		}

		if (!empty($data_post["type_of_module"])) {
			$where["b.type_of_module"] 	= $data_post["type_of_module"];
		}

		if (!empty($data_post["deck_elevation"])) {
			$where["b.deck_elevation"] 	= $data_post["deck_elevation"];
		}


		$where["a.type_of_report"]	= $type_of_report;
		$where["a.report_number IS NOT NULL"] = null;
		$where["b.status_delete"] 	= 1;
		$data['data_additional_report']	 = $this->dimension_mod->data_additional_report($where);
		unset($where);

		if (sizeof($data['data_additional_report']) > 0) {
			$id_user_1   = array_column($data['data_additional_report'], 'create_by');
			$id_user_all = array_unique(array_filter($id_user_1));
			$where_user["id_user IN ('" . implode("', '", $id_user_all) . "')"] = NULL;
			$datadb  = $this->general_mod->portal_user_db_list($where_user);
			foreach ($datadb as $value) {
				$data['user_list'][$value['id_user']] = $value['full_name'];
			}
		}


		if ($type_of_report == 0) {
			$meta = "HardnessTesting";
		} else if ($type_of_report == 1) {
			$meta = "CorrectionOfDistortion";
		} else if ($type_of_report == 2) {
			$meta = "Excavation";
		} else if ($type_of_report == 3) {
			$meta = "Buttering";
		} else if ($type_of_report == 4) {
			$meta = "BorescopeSurveyReports";
		} else {
			$meta = "-";
		}
		$data['meta_title'] 	 = $meta;

		$data['type_of_report']  = $type_of_report;
		$data['read_cookies'] 	 = $this->user_cookie;
		$data['subview']    	 = 'dimension/export_excel_additional';
		$data['sidebar']    	 = $this->sidebar;
		$data['read_permission'] = $this->permission_cookie;

		$this->load->view($data['subview'], $data);
	}

	public function ht_update_ecodoc($tor)
	{

		$tor_dec = $this->encryption->decrypt(strtr($tor, '.-~', '+=/'));
		if ($tor_dec == 1) {
			$meta = "Dimension Control";
		} else if ($tor_dec == 2) {
			$meta = "Correction Of Distortion";
		} else if ($tor_dec == 3) {
			$meta = "Excavation";
		} else if ($tor_dec == 4) {
			$meta = "Buttering";
		} else if ($tor_dec == 5) {
			$meta = "Hardness Testing";
		}

		$data['tor']	  		  = $tor;
		$data['type_of_report']	  = $tor_dec;
		$data['meta_title']       = $meta . " - Update Ecodoc";
		$data['subview']          = "dimension/update_ecodoc";
		$data['user_permission']  = $this->permission_cookie;
		$data['sidebar']          = $this->sidebar;
		$data['user_cookie']      = $this->user_cookie;

		$this->load->view('index', $data);
	}

	public function dc_update_ecodoc($tor)
	{

		$tor_dec = $this->encryption->decrypt(strtr($tor, '.-~', '+=/'));
		if ($tor_dec == 1) {
			$meta = "Dimension Control";
		} else if ($tor_dec == 2) {
			$meta = "Correction Of Distortion";
		} else if ($tor_dec == 3) {
			$meta = "Excavation";
		} else if ($tor_dec == 4) {
			$meta = "Buttering";
		}

		$data['tor']	  		  = $tor;
		$data['type_of_report']	  = $tor_dec;
		$data['meta_title']       = $meta . " - Update Ecodoc";
		$data['subview']          = "dimension/update_ecodoc";
		$data['user_permission']  = $this->permission_cookie;
		$data['sidebar']          = $this->sidebar;
		$data['user_cookie']      = $this->user_cookie;

		$this->load->view('index', $data);
	}

	public function template_file_ecodoc($type_of_report)
	{
		error_reporting(0);

		$type_of_report = $this->encryption->decrypt(strtr($type_of_report, '.-~', '+=/'));

		if ($type_of_report == 1) {
			$where['type_of_report'] 			= $type_of_report;
			$where['b.report_number IS NOT NULL'] = NULL;
			$data_list                          = $this->dimension_mod->data_dc($where);
		} else { // $type_of_report==5
			$where["a.type_of_report"]	= 0; // Additional Report Joint for Hardness Testing
			$where["a.report_number IS NOT NULL"] = null;
			$where["b.status_delete"] 	= 1;
			$data_list                          = $this->dimension_mod->data_additional_report($where);
		}
		unset($where);

		// test_var($data_list);

		$deck_list                          = $this->general_mod->deck_elevation();
		foreach ($deck_list as $value) {
			$deck[$value['id']] = $value;
		}

		$project_list                       = $this->general_mod->project();
		foreach ($project_list as $value) {
			$project[$value['id']]            = $value;
		}

		$discipline_list          = $this->general_mod->discipline();
		foreach ($discipline_list as $value) {
			$discipline[$value['id']]  = $value;
		}

		$module_list              = $this->general_mod->module();
		foreach ($module_list as $value) {
			$module[$value['mod_id']]  = $value;
		}

		$type_of_module_list       = $this->general_mod->type_of_module();
		foreach ($type_of_module_list as $value) {
			$type_module[$value['id']]      = $value;
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
			'font' => array(
				'color' => array('rgb' => '000000'),
				'bold'  => true,
			),

		);
		// set title kolom
		$sheet->setCellValue('A1', "KEY DATA \n (DO NOT DELETE / EDIT THIS COLUMN)");
		$sheet->setCellValue('B1', 'PROJECT');
		$sheet->setCellValue('C1', 'DISCIPLINE');
		$sheet->setCellValue('D1', 'MODULE');
		$sheet->setCellValue('E1', 'TYPE OF MODULE');
		$sheet->setCellValue('F1', 'Deck Elevation / Service Line');
		$sheet->setCellValue('G1', 'REPORT NUMBER');
		$sheet->setCellValue('H1', 'RFI NUMBER');
		$sheet->setCellValue('I1', 'ECODOC NUMBER');
		$sheet->setCellValue('J1', 'BOOK VOLUME');

		$excel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($styleArray);
		unset($styleArray);


		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(45);

		$excel->getActiveSheet()->getStyle('A1:A1')
			->getAlignment()->setWrapText(true);


		for ($i = 'B'; $i !== 'K'; $i++) {
			$excel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
		}

		$start  = 2;

		foreach ($data_list as $value) {
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

			if ($type_of_report == 5) {
				$key_data             = [
					'rfi_no' 			=> $value['rfi_number'],
					'submission_id' 	=> $value['submission_id'],
					'report_number' 	=> $value['report_number'],
				];
			} else {
				$key_data             = [
					'id'           		=> $value['id'],
					'rfi_no' 			=> $value['rfi_no'],
					'submission_id' 	=> $value['submission_id'],
					'report_number' 	=> $value['report_number'],
				];
			}

			$sheet->setCellValue('A' . $start, encrypt(json_encode($key_data)));
			$sheet->setCellValue('B' . $start, $project[$value['project_id']]['project_name']);
			$sheet->setCellValue('C' . $start, $discipline[$value['discipline']]['discipline_name']);
			$sheet->setCellValue('D' . $start, $module[$value['module']]['mod_desc']);
			$sheet->setCellValue('E' . $start, $type_module[$value['type_of_module']]['name']);
			$sheet->setCellValue('F' . $start, $deck[$value['deck_elevation']]['name']);
			$sheet->setCellValue('G' . $start, $value['report_number']);
			if ($type_of_report == 5) {
				$sheet->setCellValue('H' . $start, $value['rfi_number']);
			} else {
				$sheet->setCellValue('H' . $start, $value['rfi_no']);
			}
			$sheet->setCellValue('I' . $start, $value['ecodoc_no']);
			$sheet->setCellValue('J' . $start, $value['book_volume']);

			$excel->getActiveSheet()->getStyle('A' . $start . ':J' . $start)->applyFromArray($styleArray);
			unset($styleArray);
			$start++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="template_file_ecodoc.xlsx"');
		$data = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$data->save('php://output');
		exit;
	}

	public function preview_update_ecodoc($tor)
	{
		error_reporting(0);

		$tor_dec = $this->encryption->decrypt(strtr($tor, '.-~', '+=/'));
		if ($tor_dec == 1) {
			$meta = "Dimension Control";
		} else if ($tor_dec == 2) {
			$meta = "Correction Of Distortion";
		} else if ($tor_dec == 3) {
			$meta = "Excavation";
		} else if ($tor_dec == 4) {
			$meta = "Buttering";
		} else if ($tor_dec == 5) {
			$meta = "hardness Testing";
		}

		$id_user                  = $this->user_cookie;
		$config['upload_path']    = 'upload/';
		$config['file_name']      = 'excel_dc_' . $id_user[0];
		$config['allowed_types']  = 'xlsx';
		$config['overwrite'] 			= TRUE;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('file')) {
			$this->session->set_flashdata('error', $this->upload->display_errors());
			redirect("material_verification/update_ecodoc");
			return false;
		}

		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
		$excelreader 			      = new PHPExcel_Reader_Excel2007();
		$loadexcel 				      = $excelreader->load('upload/' . $this->upload->data('file_name'));
		$sheet 					        = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

		// unlink('upload/'.$this->upload->data('file_name'));

		$data['type_of_report']   = $tor_dec;
		$data['sheet']            = $sheet;
		$data['meta_title']       = $meta . " - Preview Update Ecodoc";
		$data['subview']          = "dimension/preview_update_ecodoc";
		$data['user_permission']  = $this->permission_cookie;
		$data['sidebar']          = $this->sidebar;
		$data['user_cookie']      = $this->user_cookie;

		$this->load->view('index', $data);
	}

	public function proceed_update_ecodoc($type_of_report = NULL)
	{
		$key_data                 = $this->input->post('key_data');
		$ecodoc_no                = $this->input->post('ecodoc_no');
		$book_volume                = $this->input->post('book_volume');

		foreach ($ecodoc_no as $key => $value) {
			if ($value != "") {

				$kd = json_decode($key_data[$key], true);
				$form_data['ecodoc_no'] = $value;
				$form_data['book_volume'] = $book_volume[$key];

				if ($type_of_report == 5) {
					$where['rfi_number'] 	= $kd['rfi_no'];
					$where['submission_id']	= $kd['submission_id'];
					$where['report_number']	= $kd['report_number'];
					$this->dimension_mod->update_additional_report($where, $form_data);
				} else {
					$this->dimension_mod->dimension_update($kd['submission_id'], $form_data);
				}
				unset($form_data, $where);
			}
		}

		$this->session->set_flashdata('success', 'Success Update Ecodoc Number');
		redirect('additional/dc_list');
	}

	function rfi_other_detail($type_of_report, $submission_id) {
		$type_of_report = decrypt($type_of_report);
		$submission_id = decrypt($submission_id);

		$datadb	 = $this->dimension_mod->data_additional_report_joint([
			"b.submission_id" => $submission_id,
		], $type_of_report);
		if(count($datadb) == 0){
			redirect('dimension/dc_list');
		}
		$dc_list = $datadb;

		$datadb = $this->dimension_mod->rfi_additional_report_list([
			"submission_id" => $submission_id,
		]);
		$rfi = $datadb[0];

		$rfi_detail_list = $this->dimension_mod->rfi_detail_additional_report_list([
			"id_rfi" => $rfi['id'],
			"status_delete" => 1,
		]);

		$datadb = $this->general_mod->discipline();
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['id']] = $value;
		}
		$data['discipline_list'] = $discipline_list;
  	$data['project_list'] = $this->general_mod->project();
		
		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['mod_id']] = $value;
		}
		$data['module_list'] = $module_list;

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

    $data['user_list']     = $this->general_mod->portal_user_db_no_sign([
			"status_user" => 1,
		]);

		$data['company_list'] = $this->general_mod->company();

		$datadb = $this->general_mod->location_v2();
		$location_v2_list = [];
		foreach ($datadb as $key => $value) {
			$location_v2_list[$value['id']] = $value;
		}
		$data['location_v2_list'] = $location_v2_list;

		$datadb = $this->general_mod->area_v2();
		$area_v2_list = [];
		foreach ($datadb as $key => $value) {
			$area_v2_list[$value['id']] = $value;
		}
		$data['area_v2_list'] = $area_v2_list;

		$datadb = $this->general_mod->type_of_inspection();
		$type_of_inspection_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_inspection_list[$value['id']] = $value;
		}
		$data['type_of_inspection_list'] = $type_of_inspection_list;

		$data['dc_list'] = $dc_list;
		$data['rfi'] = $rfi;
		$data['rfi_detail_list'] = $rfi_detail_list;

		// test_var($data);

		$data['subview']      = 'dimension/rfi_other_detail';
    $data['meta_title']   = 'RFI Details';
    $data['sidebar']      = $this->sidebar;
    $this->load->view('index', $data);
	}

	function update_rfi_process() {
		$post = $this->input->post();
		// test_var($post);

		$fileName = '';
		if (!empty($_FILES['userfile']['name'])) {
			require_once(APPPATH . 'third_party/Net/SFTP.php');
			$ftp                        = $this->ftp;
			$sftp                       = new Net_SFTP($ftp['hostname']);
			$destination_source         = '/PCMS/pcms_v2/additional_attachment/dimension_control/';
			if (!$sftp->login($ftp['username'], $ftp['password'])) {
				$this->session->set_flashdata('error', 'FTP Server Not Working');
				redirect($_SERVER['HTTP_REFERER']);
			}
			$filetype           = pathinfo($_FILES['attachment']['name']);
			$filetype           = $filetype['extension'];
			if ($filetype == "pdf") {
				$filename           = 'Dimension_control_attachment_' . $this->user_cookie[0] . '_' . uniqid() . '_.' . $filetype;
				$attach_line_name   = $filename;
				$filepath           = 'upload/';
				move_uploaded_file($_FILES['attachment']['tmp_name'], $filepath . $attach_line_name);
				$fileName                 = $attach_line_name;
				$source                   = $filepath . $attach_line_name;
				$destination              = $destination_source . $attach_line_name;
				$sftp->put($destination, $source, NET_SFTP_LOCAL_FILE);
				// @unlink($source); 
			} else {
				$this->session->set_flashdata('error', 'Only For PDF File..!');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}

		$form_data = array(
			"rfi_number" 			=> $post["rfi_no"],
			"report_number" 		=> $post["report_no"],
			"date_of_inspection" 	=> $post["inspection_actual_date"],
		);
		if($fileName != ''){
			$form_data['attachment_file'] = $fileName;
		}
		$this->dimension_mod->update_additional_report([
			"submission_id" => $post['submission_id'],
		], $form_data);

		$form_data = [
			'rfi_no' => $post['rfi_no'],
			'drawing_no' => $post['drawing_no'],
			'project' => $post['project_id'],
			'discipline' => $post['discipline'],
			'module' => $post['module'],
			'type_of_module' => $post['type_of_module'],
			'company_id' => $post['company'],
			'submitted_date' => $post['submitted_date'],
			'inspection_date' => $post['inspection_date'],
			'inspection_date_to' => $post['inspection_date_to'],
			'inspector_id' => $post['inspector_id'],
			'itp_authority' => join(";", $post['itp'] ?? []),
			'type_of_inspection' => join(";", $post['type_of_inspection'] ?? []),
			'remarks' => $post['remarks'],
			'inspection_actual_date' => $post['inspection_actual_date'],
		];
		$this->dimension_mod->rfi_additional_report_update_process($form_data, [
			"id" => $post['id_rfi']
		]);

		foreach ($post["tag_no"] as $key => $value) {
			if(@$post["id_rfi_item"][$key] != ''){
				$form_data = [
					"tag_no" => $post["tag_no"][$key],
					"tag_description" => $post["tag_description"][$key],
					"expected_time" => $post["expected_time"][$key],
				];
				$this->dimension_mod->rfi_detail_additional_report_update_process($form_data, [
					"id" => $post["id_rfi_item"][$key]
				]);
			}
			else{
				if($post["tag_no"][$key] != ''){
					$form_data = [
						"id_rfi" => $post['id_rfi'],
						"tag_no" => $post["tag_no"][$key],
						"tag_description" => $post["tag_description"][$key],
						"expected_time" => $post["expected_time"][$key],
						"created_by" => $this->user_cookie[0],
					];
					$this->dimension_mod->rfi_detail_additional_report_insert_process($form_data);
				}
			}
		}

		$this->session->set_flashdata('success', 'Data updated successful!');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function rfi_other_pdf($type_of_report, $submission_id) {
		$type_of_report = decrypt($type_of_report);
		$submission_id = decrypt($submission_id);

		$datadb	 = $this->dimension_mod->data_additional_report_joint([
			"b.submission_id" => $submission_id,
		], $type_of_report);
		if(count($datadb) == 0){
			redirect('dimension/dc_list');
		}
		$dc_list = $datadb;

		$datadb = $this->dimension_mod->rfi_additional_report_list([
			"submission_id" => $submission_id,
		]);
		$rfi = $datadb[0];

		$rfi_detail_list = $this->dimension_mod->rfi_detail_additional_report_list([
			"id_rfi" => $rfi['id'],
			"status_delete" => 1,
		]);

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['id']] = $value;
		}
		$data['discipline_list'] = $discipline_list;

		$datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['id']] = $value;
		}
		$data['project_list'] = $project_list;
		
		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['mod_id']] = $value;
		}
		$data['module_list'] = $module_list;

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

		$datadb = $this->general_mod->location_v2();
		$location_v2_list = [];
		foreach ($datadb as $key => $value) {
			$location_v2_list[$value['id']] = $value;
		}
		$data['location_v2_list'] = $location_v2_list;

		$datadb = $this->general_mod->area_v2();
		$area_v2_list = [];
		foreach ($datadb as $key => $value) {
			$area_v2_list[$value['id']] = $value;
		}
		$data['area_v2_list'] = $area_v2_list;

		$datadb = $this->general_mod->type_of_inspection();
		$type_of_inspection_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_inspection_list[$value['id']] = $value;
		}
		$data['type_of_inspection_list'] = $type_of_inspection_list;

		$client_text = 'employer';
		if(in_array($rfi['project'], [19, 21])){
			$client_text = 'company';
		}
		if($rfi['project'] == 17){
			$is_changhua = 1;
		}
		$sign_list = [
			"contractor" => [
				"id_user" => $rfi['created_by'],
				"date" => $rfi['created_date'],
			],
			$client_text => [
				"id_user" => NULL,
				"date" => NULL,
				"is_changhua" => @$is_changhua,
			],
			"third party" => [
				"id_user" => NULL,
				"date" => NULL,
			],
		];
		if($rfi['company_id'] == $company_list[5]['company_name']){ //IF DSAW
			$sign_list = [
				"dsaw" => [
					"id_user" => $rfi['created_by'],
					"date" => $rfi['created_date'],
				],
				"contractor" => [
					"id_user" => NULL,
					"date" => NULL,
				],
				$client_text => [
					"id_user" => NULL,
					"date" => NULL,
					"is_changhua" => @$is_changhua,
				],
				"third party" => [
					"id_user" => NULL,
					"date" => NULL,
				],
			];
		}

		$id_user_arr = array_column($sign_list, "id_user");
		$data['user_list']     = user_name_data($id_user_arr, 1);

		$data['dc'] = $dc_list[0];
		$data['dc_list'] = $dc_list;
		$data['rfi'] = $rfi;
		$data['rfi_detail_list'] = $rfi_detail_list;
		$data['sign_list'] = $sign_list;
		// $this->load->view('dimension/rfi_other_pdf', $data);

		$this->load->library('Pdfgenerator_client');
		$html = $this->load->view('dimension/rfi_other_pdf', $data, true);
		$this->pdfgenerator_client->generate($html, $rfi['rfi_no'], NULL);
	}
}
