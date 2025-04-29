<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdb_offline extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->helper('browser');
		$this->load->helper('cookies');
		$data_cookies = helper_cookies(@$this->input->get('user'));

		$this->load->model('home_mod');
		$this->load->model('general_mod');
		$this->load->model('engineering_mod');
		$this->load->model('planning_mod');
		$this->load->model('fitup_mod');
		$this->load->model('material_verification_mod');
		$this->load->model('visual_mod');
		$this->load->model('ndt_mod');
		$this->load->model('wtr_mod');
		$this->load->model('irn_mod');
    $this->load->model('mdb_mod');
		$this->load->model('dimension_mod');
		$this->load->model('additional_attachment_mod');

		$this->user_cookie 		  	= $data_cookies['data_user'];
		$this->permission_cookie  = $data_cookies['data_permission'];
	    $this->sidebar 				    = "mdb/sidebar";

	    $master_report            = $this->general_mod->master_report_number();
	    foreach($master_report as $value) {
	      $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']][$value['category']]  = $value['report_no'];
	    }

		$this->smtp  = smtp_config();

		$datadb = $this->general_mod->portal_server_list();
		foreach ($datadb as $key => $value) {
			$this->server_app[] = $value['ip_address'];
		}

		if($this->user_cookie[12] == getenv('IP_FIREWALL_GATEWAY')){
			$this->link_server = getenv('LINK_SERVER_OUTSIDE');
		} else { 
			$this->link_server = getenv('LINK_SERVER');
		}

		$this->ftp              = ftp_config_syn();
    $this->ecodoc_no_list   = [];

	}

	public function index(){
		$data['deck_elevation'] = $this->mdb_mod->deck_elevation(["id IN (5,6,7,8,9,10)" => NULL]);

	  $data['meta_title']           = 'MDB List';
		$data['subview']              = 'mdb/dashboard';
		$data['sidebar']              = $this->sidebar;
		$this->load->view('index', $data);
	}

	public function mdb_deck_new($id = 5, $params = null){
		$ecodoc_no_arr = [];

		$datadb = $this->additional_attachment_mod->master_mdb_general_list([
			"category" => 'MDB DECK',
		], [
			"volume" => "ASC",
			"section::int" => "ASC",
			"subsection::int" => "ASC",
		]);
		// test_var($datadb);
		$data['mdb_general_volume_list'] = [];
		$data['mdb_general_section_list'] = [];
		$data['mdb_general_subsection_list'] = [];
		foreach ($datadb as $key => $value) {
			if($value['volume'] != '' && $value['section'] == '' && $value['subsection'] == ''){
				$data['mdb_general_volume_list'][] = $value;
			}
			elseif($value['volume'] != '' && $value['section'] != '' && $value['subsection'] == ''){
				$data['mdb_general_section_list'][$value['volume']][] = $value;
			}
			elseif($value['volume'] != '' && $value['section'] != '' && $value['subsection'] != ''){
				$data['mdb_general_subsection_list'][$value['volume']][$value['section']][] = $value;
			}

			if($value['ecodoc_no'] != ''){
				$ecodoc_no_arr[] = $value['ecodoc_no'];
			}
		}
		$data['file_list'] = [];

		$datadb 	= $this->shopdrawing_dossier($id);
		foreach ($datadb as $key => $value) {
			$data['file_list']['shopdrawing_dossier_'.$key] = $value;
		}

    $data['file_list']['mv_dossier'] = $this->mv_dossier_deck($id);
    $data['file_list']['wtr_dossier'] = $this->wtr_dossier($id);
    $data['file_list']['fitup_dossier'] = $this->fitup_dossier($id);

		$datadb 	= $this->visual_dossier($id);
		foreach ($datadb as $key => $value) {
			$data['file_list']['visual_dossier_'.$key] = $value;
		}
		
    $data['ndt_dossier'] 	  	    = $this->ndt_dossier($id);
		$datadb 	= $this->ndt_dossier($id);
		foreach ($datadb as $key => $value) {
			foreach ($value as $key2 => $value2) {
				$data['file_list']['ndt_dossier_'.$key.'_'.$key2] = $value2;
			}
		}

		$datadb 	= $this->dimension_dossier($id);
		foreach ($datadb as $key => $value) {
			$data['file_list']['dimension_dossier_'.$key] = $value;
		}

		$datadb 	= $this->irn_dossier($id);
		foreach ($datadb as $key => $value) {
			$data['file_list']['irn_dossier_'.$key] = $value;
		}

		$datadb 	= $this->ht_dossier($id);
		foreach ($datadb as $key => $value) {
			$data['file_list']['ht_dossier_'.$key] = $value;
		}

		$datadb 	= $this->additional_attachment($id);
		foreach ($datadb as $key => $value) {
			$data['file_list']['additional_att_'.$key] = $value;
		}


		$data['deck_elevation'] = $this->mdb_mod->deck_elevation(["id" => $id]);

    $data['meta_title']           = strtoupper('MDB INDEX B (SPECIFIC) '.$data['deck_elevation'][0]['name']);
    $data['subview']              = 'mdb/mdb_list_new';
    // $data['sidebar']              = $this->sidebar;

    if(isset($params)) {
      if($params['offline']) {
        return $this->generate_index_deck($data, $params);
      }
    }
  

    $this->load->view($data['subview'], $data);
	}

  protected function generate_index_deck($data, $params) {
    error_reporting(0);
    $index_name                   = $params['index_loc'].'/index.html';
    $myfile                       = fopen($index_name, "w");
    $data['params']               = $params;
    $view                         = $this->load->view('mdb/offline/mdb_list', $data, true);
    fwrite($myfile, $view);
  }

	public function mdb_deck($id = 5){

    $data['deck_elevation'] = $this->mdb_mod->deck_elevation(["id" => $id]);

    $data['shopdrawing_dossier'] 	= $this->shopdrawing_dossier($id);

    $data['fitup_dossier'] 	      = $this->fitup_dossier($id);  
    $data['visual_dossier'] 	    = $this->visual_dossier($id);
    $data['ndt_dossier'] 	  	    = $this->ndt_dossier($id);
    $data['irn_dossier'] 	  	    = $this->irn_dossier($id);
    $where['deck_elevation']      = $id;
    $data['mv_dossier']           = $this->mv_dossier_deck($id);
    $data['wtr_dossier']          = $this->wtr_dossier($id);

    $data['additional_att']       = $this->additional_attachment($id);
    $data['dimension_dossier']    = $this->dimension_dossier($id);
    $data['ht_dossier']           = $this->ht_dossier($id);

    unset($where);

    $data['meta_title']           = strtoupper('MDB INDEX B (SPECIFIC) '.$data['deck_elevation'][0]['name']);
    $data['subview']              = 'mdb/mdb_list';
    // $data['sidebar']              = $this->sidebar;

    $this->load->view($data['subview'], $data);
	}

  public function wtr_dossier($deck, $action = "view", $file_loc = null) {
    $where['deck_elevation']        = $deck;
    $where['status_deleted']        = 1;
    $where['status_inspection']     = 7;
    $where['wtr.project']           = 12;
    $where['wtr.type_of_module']    = 1;
    $where['wtr.discipline != 1']   = null;
    $datadb                         = $this->mdb_mod->wtr_dossier($where);
    unset($where);  


    $output                         = [];
    foreach($datadb as $value) {
      $output[] = [
        'report_number'         => $value['drawing_no'],
        'att_link'              => $value['drawing_no'].'.html',
        'ecodoc_no'             => $value['ecodoc_no'],
        'book_volume'           => $value['book_volume'],
        'link_ecodoc'           => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
        'link'                  => site_url('wtr/show_irn_detail_wtr_signed/'.encrypt($value['uniq_id']))
      ];

      if($action == "save") {
        $this->wtr_html(encrypt($value['uniq_id']), $file_loc);
      }
    }

    return $output;

  }

   public function ht_dossier($deck, $action = "view", $offline_loc = null, $sftp = null){
    $where["b.project"]                   = 12;
    $where["b.discipline != '1'"]         = NULL;
    $where["c.company_id != 13"]          = NULL;
    $where["b.deck_elevation"]            = $deck;
    $where["a.type_of_report"]            = 0;
    $where["a.report_number IS NOT NULL"] = null; 
    $where["b.status_delete"]             = 1;  
    
    $datadb  = $this->mdb_mod->ht_dossier($where);

    $output = [];
    foreach ($datadb as $key => $value) {
      $enc_redline = strtr($this->encryption->encrypt($value['attachment_file']), '+=/', '.-~'); 
      $enc_path   = strtr($this->encryption->encrypt('/PCMS/pcms_v2/additional_attachment/'), '+=/', '.-~');
      
      if(@count($output[$value['type_of_module']]) > 20) {
        continue;
      }

      $output[$value['type_of_module']][] = [
        "discipline"      => $value['discipline'],
        "company_id"      => $value['company_id'],
        "report_number"   => $value['report_number'],
        "att_link"        => $value['report_number'].'.pdf',
        "ecodoc_no"   => $value['ecodoc_no'],
        "book_volume"   => $value['book_volume'],
        "link_ecodoc"   => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
        "link"            => site_url('irn/open_file/'.$enc_redline.'/'.$enc_path),
      ];

      if($action == "save") {
        $local_file       = $offline_loc."/".$value['report_number'].'.pdf';
        $remote_file      = "/PCMS/pcms_v2/additional_attachment/".$value["attachment_file"];
        $sftp->get($remote_file, $local_file);
      }

      $this->ecodoc_no_list[] = $value['ecodoc_no'];

    }
    return $output;
  }

	public function dimension_dossier($deck = NULL, $action = "view", $offline_loc = null, $sftp = null, $jacket = NULL){
    $where["a.project_id"]                        = 12;
    $where["a.discipline != '1'"]                 = NULL;
    $where["a.requestor_company ILIKE '%SMOE%' "] = NULL; 
    if($deck){
    	$where["a.deck_elevation"] = $deck;
    } else {
    	$list_drawing                     = $this->drawing_jacket();
    	$list_drawing                     = $list_drawing['all'];
    	$arr_list_drawing                 = array_column($list_drawing, 'document_no');
    	if($jacket=='ALL'){
				$where["a.drawing_no NOT IN ('".implode("', '", array_unique($arr_list_drawing))."')"] = null;
    	} else {
				$where["a.drawing_no IN ('".implode("', '", array_unique($arr_list_drawing))."')"] = null;
    	}

    	$where["a.type_of_module"] = 2;
    }
    $where['a.type_of_report']                    = 1;
    $where['b.report_number IS NOT NULL']         = NULL;
    $datadb = $this->dimension_mod->data_dc($where);

    $output = [];
    foreach ($datadb as $key => $value) {
      $enc_id = strtr($this->encryption->encrypt($value['attachment']), '+=/', '.-~');
      $enc_redline = strtr($this->encryption->encrypt($value['attachment']), '+=/', '.-~'); 
      $enc_path   = strtr($this->encryption->encrypt('/PCMS/pcms_v2/additional_attachment/dimension_control/'), '+=/', '.-~'); 

      if(@count($output[$value['type_of_module']]) > 20) {
        continue;
      }

      if($deck){
      	$output[$value['type_of_module']][] = [
	        "discipline"      	=> $value['discipline'],
	        "ecodoc_no"      		=> $value['ecodoc_no'],
	        "link_ecodoc"      	=> base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
	        "book_volume"      	=> $value['book_volume'],
	        "report_number"   	=> $value['report_number'],
	        "att_link"        	=> $value['report_number'].'.pdf',
	        "link"            	=> site_url('irn/open_file/'.$enc_redline.'/'.$enc_path),
	      ];
			} else {
      	if($id_cat==19){	
      		$id_cats = 225;
      	} elseif($id_cat==22){	
					$id_cats = 226;
				} elseif($id_cat==29){	
					$id_cats = 228;
				}
    		if($jacket=='ALL'){
    			$output[] = [
	        "discipline"      	=> $value['discipline'],
	        "ecodoc_no"      		=> $value['ecodoc_no'],
	        "link_ecodoc"      	=> base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
	        "book_volume"      	=> $value['book_volume'],
	        "report_number"   	=> $value['report_number'],
	        "att_link"        	=> $value['report_number'].'.pdf',
	        "link"            	=> site_url('irn/open_file/'.$enc_redline.'/'.$enc_path),
	      ];
    		} else {
	      	$output[$id_cats][] = [
		        "discipline"      	=> $value['discipline'],
		        "ecodoc_no"      		=> $value['ecodoc_no'],
		        "link_ecodoc"      	=> base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
		        "book_volume"      	=> $value['book_volume'],
		        "report_number"   	=> $value['report_number'],
		        "att_link"        	=> $value['report_number'].'.pdf',
		        "link"            	=> site_url('irn/open_file/'.$enc_redline.'/'.$enc_path),
		      ];
		    }
      }

      if($action == "save") {
        $local_file       = $offline_loc."/".$value['report_number'].'.pdf';
        $remote_file      = "/PCMS/pcms_v2/additional_attachment/dimension_control/".$value["attachment"];
        $sftp->get($remote_file, $local_file);
      }

      $this->ecodoc_no_list[] = $value['ecodoc_no'];


    }
    return $output;
  }

  public function irn_dossier($deck, $action = "view", $offline_loc = null){
    $where["pcms_joint.project"] = 12;
    $where["pcms_joint.discipline != 1"] = NULL;
		$where["pcms_workpack.company_id != 13"] = NULL;
    $where["pcms_joint.deck_elevation"] = $deck;
		$where["pcms_irn.report_number IS NOT NULL"] = NULL;
		$datadb = $this->mdb_mod->irn_dossier($where);
  $output = [];
		foreach ($datadb as $key => $value) {
			$enc_id = strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~');

      if(@count($output[$value['type_of_module']]) > 20) {
        continue;
      }

      if($value['company_id'] == 13){
        $report_no = $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['irn_report_scm'].$value['report_number'];
      } else {
        $report_no = $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['irn_report'].$value['report_number'];
      }

			$output[$value['type_of_module']][] = [
        "discipline"      => $value['discipline'],
        "company_id"      => $value['company_id'],
        "report_number"   => $report_no,
        "att_link"      => $report_no.'.pdf',
        "ecodoc_no"   => $value['ecodoc_no'],
				"book_volume" 	=> $value['book_volume'],
        'link_ecodoc'           => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
				"link"				=> site_url('irn/show_irn_detail/').$enc_id,
			];

      if($action == "save") {
        $this->irn_pdf($enc_id,$report_no, $offline_loc);
      }

      
		}
		return $output;
	}

	public function ndt_dossier($deck,  $action = "view", $offline_loc = null, $ndt_type = null, $sftp = null){
		$where["pcms_joint.project"] = 12;
    $where["pcms_joint.discipline != 1"] = NULL;
		$where["pcms_joint.deck_elevation"] = $deck;
    $where["pcms_workpack.company_id != 13"] = NULL;
    $where["pcms_ndt.report_number IS NOT NULL"] = NULL;

    if($ndt_type) {
      $where["pcms_ndt.ndt_type"] = $ndt_type;
    }

		$datadb = $this->mdb_mod->ndt_dossier($where);
    $output = [];
		foreach ($datadb as $key => $value) {

      if(@count($output[$value['type_of_module']][$value['ndt_type']]) > 20) {
        continue;
      }

			$output[$value['type_of_module']][$value['ndt_type']][] = [
        "discipline"      => $value['discipline'],
        "company_id"      => $value['company_id'],
        "report_number"   => $value['report_number'],
        "att_link"        => $value['report_number'].'.pdf',
        "book_volume"     => $value['book_volume'],
				"ecodoc_no" 	    => $value['ecodoc_no'],
        'link_ecodoc'           => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
				"link"				    => site_url('ndt/open_atc/').$value["filename"].'/'.$value["filename"],
			];

      if($action == "save") {
        $local_file       = $offline_loc."/".$value['report_number'].'.pdf';
        $remote_file      = "/PCMS/NDT/upload/ndt/".$value["filename"];
        $sftp->get($remote_file, $local_file);
      }

      $this->ecodoc_no_list[] = $value['ecodoc_no'];

     
		}
		return $output;
	}

	public function visual_dossier($deck, $action = "view", $offline_loc = null){
    $where["pcms_visual.project_code"] = 12;
    $where["pcms_visual.status_inspection != 12"] = NULL;
    $where["pcms_visual.report_number IS NOT NULL"] = NULL;
		$where["pcms_visual.discipline != 1"] = NULL;
    $where["pcms_workpack.company_id != 13"] = NULL;
		$where["pcms_joint.deck_elevation"] = $deck;
		$datadb = $this->mdb_mod->visual_dossier($where);
    $output = [];
		foreach ($datadb as $key => $value) {

      if(@count($output[$value['type_of_module']]) > 20) {
        continue;
      }

      if($value['company_id'] == 13){
        $report_no = $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['visual_report_13'].$value['report_number'];
      } else {
        $report_no = $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['visual_report'].$value['report_number'];
      }


			$output[$value['type_of_module']][] = [
        "company_id"      => $value['company_id'],        
        "discipline"      => $value['discipline'],
				"report_number"   => $report_no,
				"att_link"        => $report_no.'.pdf',
				"ecodoc_no"   => $value['ecodoc_no'],
				"book_volume"   => $value['book_volume'],
        'link_ecodoc'           => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
				"link"			      => site_url('visual/visual_pdf/'.$value['report_number']).'/client/'.$value['drawing_no'].'/'.$value['postpone_reoffer_no'],
			];

      if($action == "save") {
        $this->visual_pdf($value['report_number'], "client", $value['drawing_no'], $value['postpone_reoffer_no'], $offline_loc);
      }
      

		}
		return $output;
	}

	public function shopdrawing_dossier($deck, $action = "view", $offline_loc = null, $dr_type = null, $sftp = null){
		$output = [];

		$where["project_id"] = 12;
		$where["status_delete"] = 1;
		$where["deck_elevation"] = $deck;
		$where["type_of_module"] = 1;
		$where["discipline !="] = 1;

    if($dr_type) {
      if($dr_type == "GA") {
        $where["drawing_type in (1, 2)"] = NULL;
      } elseif($dr_type == "WM") {
        $where["drawing_type in (9, 14)"] = NULL;
      }
    } else {
      $where["drawing_type in (1, 2, 9, 14)"] = NULL;
    }

		$datadb = $this->mdb_mod->shopdrawing_dossier($where);

    if($action == "save") {
      if($datadb) {
        $where_dr[implode_where("id_activity", array_column($datadb, 'id'))] = null;
        $where_dr['status != 1']  = null;
        $dr_list = $this->mdb_mod->drawing_register_list($where_dr);
        unset($where_dr);
        $dr_list  = array_column($dr_list, null, 'id_activity');
      }

    }
    
		// test_var($datadb);
		foreach ($datadb as $key => $value) {
			$drawing_type = "GA";
			if(in_array($value['drawing_type'], [9, 14])){
				$drawing_type = "WM";
			}
			// if(@count($output[$value['discipline']][$value['type_of_module']][$drawing_type]) > 20){
			// 	continue;
			// }

      if(@count($output[$drawing_type]) > 20) {
        continue;
      }

			$output[$drawing_type][] = [
				"report_number" => $value['document_no'],
        "att_link"      => $value['document_no'].'.pdf',
				"ecodoc_no"  => $value['client_doc_no'],
				"link_ecodoc"  => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['client_doc_no']), '+=/', '.-~'),
				"book_volume"  => $value['book_volume'],
				"link"  => base_url_ftp_eng()."public_smoe/open_atc/2/".strtr($this->encryption->encrypt($value['id']), '+=/', '.-~'),
			];

      if($action == "save") {
        if(isset($dr_list[$value['id']])) {
          $local_file       = $offline_loc."/".$value['document_no'].'.pdf';
          $remote_file      = "/PCMS/pcms_ori/upload/activity_revision/".$dr_list[$value['id']]['attachment'];
          $sftp->get($remote_file, $local_file);
        }
      }
      $this->ecodoc_no_list[] = $value['client_doc_no'];

		}
		// test_var($output);
		return $output;
	}

	public function shopdrawing_dossier_jacket($action = "view", $offline_loc = null, $dr_type = null, $sftp = null){

		$output = [];

		$where["project_id"] = 12;
		$where["status_delete"] = 1;
		$where["type_of_module"] = 2;
		$where["discipline !="] = 1;

		if($dr_type) {
      if($dr_type == "GA") {
        $where["drawing_type in (1, 2)"] = NULL;
      } elseif($dr_type == "WM") {
        $where["drawing_type in (9, 14)"] = NULL;
      }
    } else {
      $where["drawing_type in (1, 2, 9, 14)"] = NULL;
    }

		$datadb = $this->mdb_mod->shopdrawing_dossier($where);

		if($action == "save") {
      if($datadb) {
        $where_dr[implode_where("id_activity", array_column($datadb, 'id'))] = null;
        $where_dr['status != 1']  = null;
        $dr_list = $this->mdb_mod->drawing_register_list($where_dr);
        unset($where_dr);
        $dr_list  = array_column($dr_list, null, 'id_activity');
      }
    }

    // test_var($dr_list);

		foreach ($datadb as $key => $value) { 
			$drawing_type = "GA";
			if(in_array($value['drawing_type'], [9, 14])){
				$drawing_type = "WM";
			}
			$output[$drawing_type][$value['desc_assy']][] = [ 
        "att_link"      => $value['document_no'].'.pdf',
				"report_number" => $value['document_no'],
				"ecodoc_no"  => $value['client_doc_no'],
				"link_ecodoc"  => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['client_doc_no']), '+=/', '.-~'),
				"book_volume"  => $value['book_volume'],
				"link"  => base_url_ftp_eng()."public_smoe/open_atc/2/".strtr($this->encryption->encrypt($value['id']), '+=/', '.-~'),
			];

			if($action == "save"){
        if(isset($dr_list[$value['id']])) {
          $local_file       = $offline_loc."/".$value['document_no'].'.pdf';
          $remote_file      = "/PCMS/pcms_ori/upload/activity_revision/".$dr_list[$value['id']]['attachment'];
          $sftp->get($remote_file, $local_file);
        }

      	$this->ecodoc_no_list[] = $value['ecodoc_no'];
      }

		}
		// test_var($output);
		return $output;
	}
  public function mv_dossier_deck($deck, $action = "view", $offline_loc = null) {
    $output                           = [];

    $where["(status_delete = 0 OR (status_delete = 1 AND status_inspection = 12))"] = null;
    $where["report_resubmit_status"]  = 0;
    $where['report_number IS NOT NULL'] = null;
    $where['deck_elevation']          = $deck;
    $where['project_code']            = 12;
    $where['type_of_module']          = 1;
    $where['status_inspection']       = 7;
    $where['discipline != 1']         = null;
    $where['wp.company_id != 13']        = null;
    $data_list                        = $this->mdb_mod->mv_dossier_deck($where);
    unset($where);

    if($data_list) {

      $where['id']                    = $deck;
      $datadb                         = $this->general_mod->deck_elevation($where);
      unset($where);

      foreach($data_list as $key => $value) {

        if(@count($output) > 20) {
          break;
        }

        $rep_cat           = "mv_no";
        $report_form       = $this->report[$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']][$rep_cat].'-'.$value['report_number'];

        $output[$key] = [
          "report_number" => $report_form,
          "att_link"      => $report_form.'.pdf',
          "ecodoc_no"     => $value['ecodoc_no'],
          'link_ecodoc'   => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".encrypt($value['ecodoc_no']),
          "book_volume"   => $value['book_volume'],

          "link"			    => site_url('material_verification/material_verification_pdf_client/'.encrypt($value['project_code']).'/'.encrypt($value['discipline']).'/'.encrypt($value['type_of_module']).'/'.encrypt($value['module']).'/'.encrypt($value['report_number']).'/'.encrypt($value['report_no_rev']).'/'.encrypt($value['drawing_no'])),
          'deck_elevation'  => $value['deck_elevation'],
        ];        
        
        if($action == "save") {
          $file_loc                       = encrypt($offline_loc);
          $this->mv_pdf(encrypt($value['project_code']),encrypt($value['discipline']),encrypt($value['type_of_module']),encrypt($value['module']),encrypt($value['report_number']),encrypt($value['report_no_rev']),encrypt($value['drawing_no']), $file_loc);
        }

        $this->ecodoc_no_list[] = $value['ecodoc_no'];
      }
    }

    // test_var($output);
    return $output;

  }

  public function additional_attachment($deck = null, $action = "view", $offline_loc = null, $id_type = null, $sftp = null) {

    if($deck) {
      $where['deck_elevation']          = intval($deck);
    }

    if($id_type) {
      $where['id_type']                 = intval($id_type);
    }

    $where['status_delete']           = 1;
    $datadb                           = $this->additional_attachment_mod->attachment_list($where);
    unset($where);

    $output                           = [];

    foreach($datadb as $value) {

      // if(@count($output[$value['id_type']]) > 20) {
      //   continue;
      // }

      $enc_redline  = encrypt($value['attachment_name']);
      $enc_path     = encrypt('/PCMS/pcms_v2/additional_attachment/');
      $link_file    = site_url('irn/open_file/' . $enc_redline . '/' . $enc_path);

      $output[$value['id_type']][]    = [
        'file_name'                   => $value['original_name'],
        'report_number'               => $value['original_name'],
        "att_link"                    => $value['attachment_name'],
        'ecodoc_no'                   => $value['ecodoc_no'],
        'link_ecodoc'                 => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".encrypt($value['ecodoc_no']),
        'book_volume'                 => $value['book_volume'],
        'link'                        => $link_file               
      ];

      if($action == "save") {
        $local_file       = $offline_loc."/".$value['attachment_name'];
        $remote_file      = "/PCMS/pcms_v2/additional_attachment/".$value['attachment_name'];

        $sftp->get($remote_file, $local_file);
      }

      $this->ecodoc_no_list[] = $value['ecodoc_no'];

    }

    return $output;
    
  }

  public function offline() {

    // INDEX B BY DECK
    $start_time                     = microtime(true);
    $permission                     = 0777;
    $recursive                      = true;
    $user_id                        = $this->user_cookie[0];

    $dir_home                       = 'C:/MDB_OFFLINE/';

    $where["id IN (5)"]    = null;
    // $where["id IN (5)"]             = null;
    $deck_list                        = $this->general_mod->deck_elevation($where);
    unset($where);

    $datadb = $this->additional_attachment_mod->master_mdb_general_list([
			"category" => 'MDB DECK',
		], [
			"volume" => "ASC",
			"section::int" => "ASC",
			"subsection::int" => "ASC",
		]);
	
		foreach ($datadb as $key => $value) {
			if($value['volume'] != '' && $value['section'] == '' && $value['subsection'] == ''){
				$mdb_general_volume_list[] = $value;
			}
			elseif($value['volume'] != '' && $value['section'] != '' && $value['subsection'] == ''){
				$mdb_general_section_list[$value['volume']][] = $value;
			}
			elseif($value['volume'] != '' && $value['section'] != '' && $value['subsection'] != ''){
				$mdb_general_subsection_list[$value['volume']][$value['section']][] = $value;
			}
		}

    // if(!is_dir('file/temp_download/'.$user_id)) {
    //   mkdir('file/temp_download/'.$user_id, $permission, $recursive);
    // }

    if(!is_dir($dir_home.$user_id)) {
      mkdir($dir_home.$user_id, $permission, $recursive);
    }

    $index_b                        = "$dir_home"."$user_id/MDB/MDB INDEX B";
    $ecodoc_loc                     = $index_b."/ECODOC";
    $assets_loc                     = $index_b."/WEB_ASSETS";
    
    @mkdir($index_b, $permission, $recursive);
    @mkdir($ecodoc_loc, $permission, $recursive);
    @mkdir($assets_loc, $permission, $recursive);

    // COPYING ASSETS JQUERY
    $jquery_file                    = scandir('assets/jquery');
    $jquery_file                    = array_diff($jquery_file, array('.', '..'));

    foreach($jquery_file as $value) {
      copy('assets/jquery/'.$value, $assets_loc.'/'.$value);
    }

    $ftp                      = $this->ftp;
    require_once(APPPATH.'third_party/Net/SFTP.php');
    $sftp = new Net_SFTP($ftp['hostname']);
    $sftp->login($ftp['username'], $ftp['password']);
    $params                   = [];

    foreach($deck_list as $value) {
      
      @mkdir($index_b.'/'.$value['name'], $permission, $recursive);
      $deck_loc                     = $index_b.'/'.$value['name'];
      @mkdir($deck_loc.'/1. TOPSIDE FABRICATION', $permission, $recursive);

      $dir_main_ori                 = '1. TOPSIDE FABRICATION';
      $dir_main                     = $deck_loc.'/'.$dir_main_ori;

      foreach($mdb_general_volume_list as $volume) {
        $first                      = $volume['volume'].'. '.$volume['document_description'];
        $first_level                = $dir_main.'/'.$first;
        $first_level_ori            = $dir_main_ori.'/'.$first;

        @mkdir($first_level, $permission, $recursive);

        if(isset($mdb_general_section_list[$volume['volume']])) {
          foreach($mdb_general_section_list[$volume['volume']] as $section) {
            $second                 = $section['volume'].'.'.$section['section'].' '.$section['document_description'];
            $second_level           = $first_level.'/'.$second;
            $second_level_ori       = $first_level_ori.'/'.$second;

            @mkdir($second_level, $permission, $recursive);

            if($section['var_code'] == "mv_dossier") {
              $this->mv_dossier_deck($value['id'], 'save', $second_level);
            } elseif(strpos($section['var_code'], "shopdrawing_dossier") !== false) {
              $dr_type            = explode("_", $section['var_code']);
              $dr_type            = end($dr_type);
              $this->shopdrawing_dossier($value['id'], 'save', $second_level, $dr_type, $sftp);
            } elseif(strpos($section['var_code'], "additional_att") !== false) {
              $id_type_att        = explode("_", $section['var_code']);
              $id_type_att        = end($id_type_att);
              $this->additional_attachment($value['id'], 'save', $second_level, $id_type_att, $sftp);
            } elseif(strpos($section['var_code'], "ndt_dossier") !== false) {
              $ndt_type           = explode("_", $section['var_code']);
              $ndt_type           = end($ndt_type);
              $this->ndt_dossier($value['id'], 'save', $second_level, $ndt_type, $sftp);
            } elseif(strpos($section['var_code'], "ht_dossier") !== false) {
              $this->ht_dossier($value['id'], 'save', $second_level, $sftp);
            } elseif(strpos($section['var_code'], "dimension_dossier") !== false) {
              $this->dimension_dossier($value['id'], 'save', $second_level, $sftp);
            } elseif(strpos($section['var_code'], "fitup_dossier") !== false) {
              $this->fitup_dossier($value['id'], 'save', $second_level);
            } elseif(strpos($section['var_code'], "visual_dossier") !== false) {
              $this->visual_dossier($value['id'], 'save', $second_level);
            } elseif(strpos($section['var_code'], "irn_dossier") !== false) {
              $this->irn_dossier($value['id'], 'save', $second_level);
            } elseif(strpos($section['var_code'], "wtr_dossier") !== false) {
              $this->wtr_dossier($value['id'], "save", $second_level);
            }

            $params[$value['id']]['link_'.$section['var_code']] = $second_level_ori;
          }
        }
      }

      $params[$value['id']]['offline']              = true;
      $params[$value['id']]['index_loc']            = $deck_loc;
    }

    $list_ecodoc_no                   = array_filter(array_unique($this->ecodoc_no_list));
    if($list_ecodoc_no) {
      $where[implode_where("client_doc_no", $list_ecodoc_no)] = null;
      $where['mrd.attachment IS NOT NULL']  = null;
      $datadb                           = $this->mdb_mod->mdr_document_list($where);
      unset($where);

      $duplicate_check                  = [];
      foreach($datadb as $value) {
        if(!in_array($value['id_document'], $duplicate_check)) {
          $mdr_list[]                   = $value;
        }
        $duplicate_check[]              = $value['id_document'];
      }

      foreach($mdr_list as $value) {
        $ext              = pathinfo($value['attachment'], PATHINFO_EXTENSION);
        $local_file       = $ecodoc_loc."/".$value['client_doc_no'].'.'.$ext;
        $remote_file      = "/PCMS/pcms_ori/upload/production_design/file/".$value["attachment"];
        $sftp->get($remote_file, $local_file);

        $this->ecodoc_no_list[$value['client_doc_no']]  = '../ECODOC/'.$value['client_doc_no'].'.'.$ext;
      }
    }

    foreach($deck_list as $value) {
      $this->mdb_deck_new($value['id'], $params[$value['id']]);
    }

    $end_time                     = microtime(true);
    $execution_time               = ($end_time - $start_time)/60;
    echo "FILE HAS BEEN DOWNLOADED SUCCESSFULLY!! Execution Time : $execution_time Minutes";
      // $zip      = new ZipArchive();
      // $filename = "myzipfile.zip";

      // if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
      //   exit("cannot open <$filename>\n");
      // }
      // $temp_folder  = 'file/download_mdb/'.$user_id;
      // $filename     = "MDB INDEX B.zip";
      // $loc_zip      = "file/temp_download/".$user_id."/".$filename;
      // zipData($temp_folder, $loc_zip);
      // delete_recursive($temp_folder);

      // header("Content-Type: application/octet-stream");
      // header("Content-Disposition: attachment; filename=$filename"); 
      // header('Content-length: '.filesize($loc_zip));
      // flush();
      // readfile("$loc_zip");
      // unlink($loc_zip);
  }


  protected function mv_pdf($project_id, $discipline, $type_of_module, $module,  $report_no = null, $report_no_rev = null, $drawing_no = null, $file_loc = null) {
    error_reporting(0);
    $project_id               = decrypt($project_id);
    $discipline               = decrypt($discipline);
    $type_of_module           = decrypt($type_of_module);
    $module                   = decrypt($module);
    $report_no                = decrypt($report_no);
    $report_no_rev            = decrypt($report_no_rev);
    $drawing_no               = decrypt($drawing_no);
    $file_loc                 = decrypt($file_loc);

    $data['report_no']        = $report_no;

    $app_nos                  = "";

    $where['pcms_material.project_code']    = $project_id;
    $where['pcms_material.discipline']      = $discipline;
    $where['pcms_material.type_of_module']  = $type_of_module;
    $where['pcms_material.module']          = $module;
    $where['report_number']                 = $report_no;
    $where['report_no_rev']                 = $report_no_rev;

    if($drawing_no) {
      $where['drawing_no']                    = $drawing_no;
    }

    $where['pcms_material.status_delete']   = 0;
    $detail                                 = $this->material_verification_mod->detail_inspection_rfi($where);
    unset($where);
    $total_approved           = [];
    $total_approved_client    = [];
    $id_mis                   = [];
    foreach($detail as $value) {
      if(in_array($value['status_inspection'], [3,5,7])) {
        $total_approved[]           = 1;
      }

      if($value['status_inspection'] == 7) {
        $total_approved_client[]     = 1;
      }

      $id_mis[]               = intval($value['id_mis']);
      if($value['id_mis_piping']) {
        foreach(explode(";", $value['id_mis_piping']) as $v) {
          $id_mis[]   = intval($v);
        }
      }
    }

    if(array_sum($total_approved) == count($detail)) {
      $data['sign_contractor']  = true;

      $where['id_user']         = $detail[0]['inspection_by'];
      $detail_user              = $this->general_mod->portal_user_db_list($where);
      unset($where);
      $data['user']             = $detail_user[0];

    } else {
      $data['sign_contractor']  = false;
    }

    if(array_sum($total_approved_client) == count($detail)) {
      $data['sign_client']      = true;
      $where['id_user']         = $detail[0]['inspection_client_by'];
      $detail_user              = $this->general_mod->portal_user_db_list($where);
      unset($where);
      $data['user_client']      = $detail_user[0];
    } else {
      $data['sign_client']      = false;
    }
    
    $status_inspection        = array_column($detail, 'status_inspection');
    $total_status             = array_count_values($status_inspection);
    $total_transmit           = isset($total_status['5']) ? $total_status['5'] : 0;

    if($total_transmit == count($detail)) {
      $data['inspection']     = false;
    } else {
      $data['inspection']     = true;
    }
    
    $mis_piping               = [];
    if($id_mis) {
      $detail_mis             = $this->material_verification_mod->detail_mis($id_mis);

      foreach($detail_mis as $value) {
        $data['detail_mis'][$value['id_mis_det']] = $value;
        if($value['status_piping'] == 1) {
          $mis_piping[]         = $value['catalog_id'];
        }
      }
  
      if($mis_piping) {
          $where["id IN ('".implode("', '", $mis_piping)."')"] = NULL;
          $data_catalog_piping  = $this->material_verification_mod->data_catalog_piping($where);
          unset($where);
          
          foreach($data_catalog_piping as $value) {
            $data['material_piping'][$value['id']]  = $value;
          }
      }
    }
    
    $project_id               = 12;
    $where['id']              = $project_id;
    $data_project             = $this->general_mod->project($where);
    unset($where);

    $module_list              = $this->general_mod->module();
    foreach($module_list as $value) {
      $data['module_name'][$value['mod_id']]  = $value['mod_desc'];
    }

    $area_list                = $this->general_mod->area();
    foreach($area_list as $value) {
      $data['area_name'][$value['id']]        = $value['area_name'];
    }

    $material_grade_list      = $this->general_mod->material_grade();
    foreach($material_grade_list as $value) {
      $data['material_grade'][$value['id']]   = $value['material_grade'];
    }

    $where["category IN ('mv_no', 'mv_no_smop')"]      = null;
    $list_report_number     = $this->general_mod->report_no($where);
    unset($where);

    foreach($list_report_number as $value) {
      $data['report_no_format'][$value['project']][$value['discipline']][$value['module']][$value['type_of_module']][$value['category']] = $value['report_no'];
    }

    if($detail) {

      foreach($detail as $value) {
        $document_no_list[] = $value['drawing_no'] != '' ? $value['drawing_no'] : 0;
        $document_no_list[] = $value['drawing_as'] != '' ? $value['drawing_as'] : 0;
      }

      $where["document_no IN ('".implode("', '", array_unique($document_no_list))."')"] = NULL;
      $where['status_delete'] = 1;
      $data_drawing           = $this->wtr_mod->data_drawing_list_mysql($where);
      unset($where);

      if($data_drawing) {
        foreach($data_drawing as $value) {
          $data['drawing_rev'][$value['document_no']] = $value['last_revision_no'];
          $data['client_doc_no'][$value['document_no']] = $value['client_doc_no'];
        }
      }
      
    }

    $area_v2                  = $this->general_mod->area_v2();
    foreach($area_v2 as $value) {
      $data['area_v2'][$value['id']]  = $value;
    }

    $location_v2               = $this->general_mod->location_v2();
    foreach($location_v2 as $value) {
      $data['location_v2'][$value['id']]  = $value;
    }

    $point_v2                   = $this->general_mod->point();
    foreach($point_v2 as $value) {
      $data['point_v2'][$value['id']]  = $value;
    }

    $data['is_client']        = true;
    $data['user_permission']  = $this->permission_cookie;
    $data['detail_material']  = $detail;
    $data['main_material']    = $detail[0];
    $data['data_project']     = $data_project[0];

    $file_name                = $data['report_no_format'][$data['main_material']['project_code']][$data['main_material']['discipline']][$data['main_material']['module']][$data['main_material']['type_of_module']]['mv_no'] . '-' . $report_no;

		$html                     = $this->load->view('material_verification/pdf/material_verification_pdf', $data, true);

    ob_start();
    $this->load->library('Pdfgenerator_download');
    $file_name                = $file_name.'.pdf';

		$this->pdfgenerator_download->generate($html,$file_name,$app_nos, $file_loc, "potrait");
    ob_clean();

  }

  protected function visual_pdf($report_number = Null, $access = Null, $drawing_no = Null, $postpone_reoffer_no = NULL, $file_loc = null){

		$datadb = $this->visual_mod->master_location_v2();
		foreach ($datadb as $key => $value) {
			$data['master_location_v2'][$value['id']] = $value;
		}

		$datadb = $this->visual_mod->master_area_v2();
		foreach ($datadb as $key => $value) {
			$data['master_area_v2'][$value['id']] = $value;
		}

		$data['access'] = $access;

		$where['status_inspection != 12'] = NULL;
		if($access=='client' || $access=='clients'){
			$where['report_number'] = $report_number;
			$where['a.drawing_no'] 	= $drawing_no;
			$where['b.status_delete IS NULL'] = NULL;

			$where_first_app['report_number'] = $report_number;
			$where_first_app['drawing_no'] 	= $drawing_no;

			$where['postpone_reoffer_no'] = (int)$postpone_reoffer_no;
		} elseif($access=='qc'){
			$where['submission_id'] = $report_number;

			$where_first_app['submission_id'] = $report_number;

			$where['retransmitt_status'] = 0;
		}

		$datadb = $this->general_mod->joint_type();
		foreach ($datadb as $key => $value) {
			$data['master_joint_type'][$value['id']] = $value;
		}

		$data['visual_report'] = $this->visual_mod->visual_overall_list_v2($where);

			// test_var($where, 1);
			// test_var($data['visual_report']);

      $datadb = $this->visual_mod->master_report_no(["category ILIKE '%visual_report%'" => NULL]);
    foreach ($datadb as $key => $value) {
      $master_report_no[$value['discipline']][$value['module']][$value['type_of_module']][$value['category']] = $value['report_no'];
    }

		$client_report_number = $master_report_no[$data['visual_report'][0]['discipline']][$data['visual_report'][0]['module']][$data['visual_report'][0]['type_of_module']]['visual_report'.($data['visual_report'][0]['company_id']==13 ? '_13' : '')];

		$date_inspect = array_column($data['visual_report'], 'time_inspect');

		foreach ($date_inspect as $key => $value) {
			if($value!=''){
				$date_inspect_2[] = $value;
			}
		}

		if($data['visual_report'][0]['time_inspect']!=''){
			$where_itp["date_affected >= '".$date_inspect_2[0]."'"] = NULL;
			$data['revision_itp'] = $this->general_mod->master_itp($where_itp)[0]['revision_no'];
			if(!$data['revision_itp']){
				$datadb = $this->general_mod->master_itp();
				$data['revision_itp'] = $datadb[COUNT($datadb)-1]['revision_no'];
			}
		} else {
			$data['revision_itp'] = '05';
		}

		foreach ($data['visual_report'] as $key => $value) {
			$document_no[] = $value['drawing_wm'];
		}

		$first_app_date = $this->visual_mod->first_app_date($where_first_app)[0]['first_app_date'];
		$data['approval_date'] = $first_app_date;

		$where_sign_inspector['id_user'] = (int)$data['visual_report'][0]['inspection_by'];
		$data['user_sign']['inspector'] = @$this->general_mod->portal_user_db_list($where_sign_inspector)[0];

		$where_sign_client['id_user'] = (int)$data['visual_report'][0]['inspection_client_by'];
		$data['user_sign']['client'] = @$this->general_mod->portal_user_db_list($where_sign_client)[0];

		$datadb = $this->visual_mod->master_discipline();
		foreach ($datadb as $key => $value) {
			$data['master_discipline'][$value['id']] = $value;
		}

		$datadb = $this->visual_mod->master_class();
		foreach ($datadb as $key => $value) {
			$data['master_class'][$value['id']] = $value;
		}

		$datadb = $this->visual_mod->master_weld_type();
		foreach ($datadb as $key => $value) {
			$data['master_weld_type'][$value['id']] = $value;
		}

		$where_eng['document_no'] = $drawing_no;
		$datadb = $this->visual_mod->drawing_list($where_eng);
		foreach ($datadb as $key => $value) {
			$data['master_drawing'][$value['document_no']] = $value;
		}

		$where_wm["document_no IN ('".implode("', '", $document_no)."')"] = NULL;
		$datadb = $this->visual_mod->drawing_list($where_wm);
		foreach ($datadb as $key => $value) {
			$data['master_drawing_wm'][$value['document_no']] = $value;
		}

		$datadb = $this->general_mod->master_wps_new();
		foreach ($datadb as $key => $value) {
			$data['master_wps'][$value['id_wps']] = $value;
		}

		$datadb = $this->visual_mod->master_welder_new();
		foreach ($datadb as $key => $value) {
			$data['master_welder'][$value['id_welder']] = $value;
		}

		$datadb = $this->visual_mod->master_project();
		foreach ($datadb as $key => $value) {
			$data['master_project'][$value['id']] = $value;
		}

		$datadb = $this->visual_mod->master_module();
		foreach ($datadb as $key => $value) {
			$data['master_module'][$value['mod_id']] = $value;
		}

		$datadb = $this->visual_mod->master_type_of_module();
		foreach ($datadb as $key => $value) {
			$data['master_type_of_module'][$value['id']] = $value;
		}

		$datadb = $this->visual_mod->master_discipline();
		foreach ($datadb as $key => $value) {
			$data['master_discipline'][$value['id']] = $value;
		}

		$renox = $data['visual_report'][0]['report_number']>0 ? ($client_report_number.$data['visual_report'][0]['report_number']) : $report_number;
		$data['renox'] = $renox;

    $this->load->library('Pdfgenerator_download');

		$html = $this->load->view('visual/visual_pdf_structural', $data, true);

		$this->pdfgenerator_download->generate($html,$renox.'.pdf',"", $file_loc, "landscape");

	}
  
  public function irn_pdf($submission_id = null, $report_format = null,$file_loc = null){

    $submission_id = $this->encryption->decrypt(strtr($submission_id, '.-~', '+=/'));	
       
    $where['a.submission_id'] = $submission_id;
    
    $where['b.status_delete'] = 1;
    $data["show_pcms_irn"] 				= $this->irn_mod->show_pcms_irn($where);
    unset($where['b.status_delete']);
    // test_var($data['show_pcms_irn']);

    $data["show_pcms_irn_description"] 	= $this->irn_mod->show_pcms_irn_description($where);		
    $data["show_pcms_irn_punchlist"] 	= $this->irn_mod->show_pcms_irn_punchlist($where); 
    $data["show_pcms_irn_detail"] 		= $this->irn_mod->show_pcms_irn_detail($where);  
    $data["show_pcms_irn_dc"] 			= $this->irn_mod->show_irn_dc($where); 
    unset($where);

    $datadb = $this->general_mod->master_report_number();
    $master_report_number = [];
    foreach ($datadb as $key => $value) {
      $data["master_report_number"][$value['project']][$value['discipline']][$value['type_of_module']][$value['category']] = $value['report_no'];
      $save_new_submission_no[$value['project']][$value['discipline']][$value['type_of_module']][$value['category']] = $value['report_no'];
    }

    $where["submission_id"] = $submission_id; 
    $validated_data = $this->irn_mod->select_irn_drawing_status($where);
    unset($where);

    foreach($validated_data as $key => $value){
      $data['irn_drawing_status'][$value["submission_id"]][$value["drawing_no"]] = $value;
    }

      $data['drawing_unique'] = array_unique(array_column($data["show_pcms_irn"], 'drawing_no'));   
      $where["document_no IN ('".implode("', '", $data['drawing_unique'])."')"] = NULL;   
      $where["status_delete"] = 1;   
      $datadb = $this->wtr_mod->data_drawing_list($where);
      unset($where);
      if (sizeof($datadb) > 0) {
        foreach ($datadb as $key => $value) {
          $drawing_detail[$value['project_id']][$value['document_no']] = $value;
          $data['activity_eng'][$value['document_no']] = $value;
        }
        $data['drawing_detail'] = $drawing_detail;			
      } else {
        $data['drawing_detail'] = NULL;
      }
    
    $data["project_data_portal"]     = $this->general_mod->read_project_name($data["show_pcms_irn"][0]['project_id']);

    if(sizeof($data["show_pcms_irn_dc"]) > 0){
      $id_dc     = array_column($data["show_pcms_irn_dc"], 'id_detail_dimension'); 
      $pos_merge = array_unique($id_dc); 
      $where["b.id IN ('".implode("', '", $pos_merge)."')"] = NULL; 
      $data_check = $this->irn_mod->data_dc($where);
      unset($where);
      foreach($data_check as $key => $value){
        $data['data_dc_show'][$value['id_dc_detail_attach']] = $value;
      }
    } 
 
 
    //-------------- IRN FORM DETAIL -----------------//

    $where['e.submission_id'] = $submission_id; 
    $result =  $this->irn_mod->show_data_irn_joint($where);
    unset($where);  

    $id_joint     = array_column($result, 'id'); 
    $where["a.joint_id IN ('".implode("', '", $id_joint)."')"] = NULL; 
    $where["a.result IN (2,3) "]   	= null;
    $ndt = $this->wtr_mod->ndt_list_data_m($where); 
      foreach ($ndt as $key => $value) {
        $data['ndt'][$value['id_joint_visual']][$value['ndt_type']] = $value;  			
        $data['ndt_all'][$value['id_joint_visual']][$value['ndt_type']][] = $value;  			
      }
      unset($where); 
  
    $pos_1     = array_column($result, 'pos_1');
    $pos_2     = array_column($result, 'pos_2');
    $pos_merge = array_unique(array_merge($pos_1,$pos_2)); 
    $where["part_id IN ('".implode("', '", $pos_merge)."')"] = NULL; 
    $where["b.status_delete"] 	= 0;
    $datadb  = $this->fitup_mod->piecemark_list($where);
    unset($where);  
    foreach ($datadb as $key => $value) {
      $data['status_piecemark'][$value['part_id']] = $value;
    }
    
    $where["part_id IN ('".implode("', '", $pos_merge)."')"] = NULL; 
    $where["b.status_delete"] 	= 0;
    $datadb  = $this->fitup_mod->piecemark_list_with_itr($where);
    unset($where);  
    foreach ($datadb as $key => $value) {
      if(!isset($data['status_piecemark'][$value['part_id']]) || ($value['id_mis'] != NULL && $data['status_piecemark'][$value['part_id']]['id_mis'] = NULL)){
        $data['status_piecemark'][$value['part_id']] = $value;
      }
    }

    $id_mis     = array_column($data['status_piecemark'], 'id_mis'); 
    // $where["b.project_id"] 	= 0;
    $where["a.id_mis_det IN ('".implode("', '", $id_mis)."')"] = NULL; 
    $datadb = $this->fitup_mod->warehouse_mis_mrir($where);
    unset($where); 
    foreach ($datadb as $key => $value) {
      $data['warehouse_mis_mrir'][$value['id_mis_det']] = $value;
    }

    //-------------- IRN FORM DETAIL -----------------//
     
    if(sizeof($data["show_pcms_irn_detail"]) > 0){
      foreach ($data["show_pcms_irn_detail"] as $key => $value) {
      $data['irn_pcms_detail'][$value['id_master_irn_detail']]  = $value;
      }
    }

    $data["master_irn_detail"]      = $this->general_mod->master_irn_detail();
    foreach ($data["master_irn_detail"] as $value) {
      $data['detail_irn'][$value['id_irn_detail']] = $value;
    }
     
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $select                   = "id_user, full_name, sign_approval";
    
    $id_user_list             = array_merge(array_column($data['show_pcms_irn'], 'smoe_approval_by'), array_column($data['show_pcms_irn'], 'client_approval_by'));
    $id_user_list             = array_filter(array_unique($id_user_list));

    if($id_user_list) {
      $where_user[implode_where("id_user", $id_user_list)] = null;
      $detail_user              = $this->general_mod->portal_user_db_list($where_user, null, $select);
      unset($where_user);
      
      foreach ($detail_user as $key => $value) {
        $data['user'][$value['id_user']] = $value;
      }
    }
  
    $material_grade_list      = $this->general_mod->material_grade();
    foreach ($material_grade_list as $value) {
      $data['grade'][$value['id']]                = $value['material_grade'];
    } 
  
    $project_list             = $this->general_mod->project();
    foreach($project_list as $value) {   
      $data['project_name'][$value['id']] = $value;

      $data['project_namex'][$value['id']] = $value['project_name'];
      $data['project_desc'][$value['id']] = $value['description'];
      $data['project_logo'][$value['id']] = $value['project_logo'];
      $data['client_logo'][$value['id']]  = $value['client_logo'];
      $data['client'][$value['id']]       = $value['client'];
    }
  
    $discipline_list          = $this->general_mod->discipline();
    foreach($discipline_list as $value) {
      $data['discipline_name'][$value['id']]      = $value['discipline_name'];
    }
  
    $module_list              = $this->general_mod->module();
    foreach($module_list as $value) {
      $data['mod_desc'][$value['mod_id']]         = $value['mod_desc'];
    } 
   
    $company_list             = $this->general_mod->company();
    foreach($company_list as $value) {
      $data['company_name'][$value['id_company']] = $value['company_name'];
    }
  
    $type_of_module_list      = $this->general_mod->type_of_module();
    foreach ($type_of_module_list as $key => $value) {
      $data['module_type'][$value['id']]          = $value['name'];
    } 

    $joint_type_list = $this->general_mod->joint_type();
    foreach($joint_type_list as $value) {
      $data['joint_type'][$value['id']]	= $value['joint_type'];
    }
    
    //-------- Area New V2 ------//

    $datadb = $this->planning_mod->master_area_v2();
    foreach ($datadb as $key => $value) {
      $area_name_list_v2[$value['id']] = $value;
      $data['area_name_arr_v2'][$value['id']] = $value['name'];
    }
    $data['area_name_list_v2'] = $area_name_list_v2;

    $datadb = $this->planning_mod->master_location_v2();
    foreach ($datadb as $key => $value) {
      $location_name_list_v2[$value['id']] = $value;
      $data['location_name_arr_v2'][$value['id']] = $value['name'];
    }
    $data['location_name_list_v2'] = $location_name_list_v2;

    //-------- Area New V2 ------//

    $data["show_data_irn_list"] = $result; 
    $file_name                = $report_format.'.pdf';

    $data['meta_title'] 	 = "IRN Inspection"; 

    // $this->load->library('pdfgenerator_download');
    // $html = $this->load->view('irn/irn_pdf',$data, true);	
    // $app_nos                  = "";
		// $this->pdfgenerator_download->generate($html,$file_name,$app_nos, $file_loc, "landscape");

    $data['meta_title'] 	  = "IRN Inspection"; 
    $paper                  = 'A4'; 
    $orientation            = "portrait"; 
    $this->load->library('pdfgenerator_new');
    $html = $this->load->view('irn/irn_pdf',$data, true);	
    $this->pdfgenerator_new->generate($html, $file_name,$paper,$orientation, false, $file_loc); 

    
  }

  function fitup_pdf($project,$discipline,$module,$type_of_module,$report_number=null,$submission_id = null,$revise = null,$company_id = null, $file_loc = null){
		error_reporting(0);

		$project 		= $this->encryption->decrypt(strtr($project, '.-~', '+=/'));
		$discipline 	= $this->encryption->decrypt(strtr($discipline, '.-~', '+=/'));
		$module 		= $this->encryption->decrypt(strtr($module, '.-~', '+=/'));
		$type_of_module = $this->encryption->decrypt(strtr($type_of_module, '.-~', '+=/'));
		$report_number 	= $this->encryption->decrypt(strtr($report_number, '.-~', '+=/'));
		$submission_id 	= $this->encryption->decrypt(strtr($submission_id, '.-~', '+=/'));
		$company_id 	= $this->encryption->decrypt(strtr($company_id, '.-~', '+=/'));

		$datadb  = $this->general_mod->type_of_weld();
		foreach ($datadb as $value) {
			$data["weld_type_code"][$value['id']] = $value['weld_type_code'];
			$data["weld_type_name"][$value['id']] = $value['weld_type'];
		}

		$datadb = $this->general_mod->class();
		$class_list = [];
		foreach ($datadb as $key => $value) {
			$class_list[$value['id']] = $value['class_code'];
		}
		$data['class_list'] = $class_list;	
		$data['list_of_class'] = $datadb;

		$datadb = $this->general_mod->material_grade();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$data["material_grade"][$value['id']] = $value;
		}	

		$array_report_list = array("fitup_report","fitup_report_scm");
		$where["category IN ('".implode("', '", $array_report_list)."')"] = NULL;
		$datadb = $this->general_mod->report_no($where);
		unset($where); 
		$master_report_number = [];
		foreach ($datadb as $key => $value) {
			$data["master_report_number"][$value['project']][$value['discipline']][$value['type_of_module']][$value['category']] = $value['report_no'];
		}  

		$datadb = $this->fitup_mod->master_joint_type();
		foreach ($datadb as $key => $value) {
			$data['master_joint_type'][$value['id']] = $value;
		}
		
		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['initial']] = $value;
			$data['discipline_code'][$value['id']] = $value['initial'];
			$data['discipline_name'][$value['id']] = $value['discipline_name'];
		}

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
			$data['type_of_module_code'][$value['id']] = $value['code'];
			$data['type_of_module_name'][$value['id']] = $value['name'];
		}

		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['mod_id']] = $value;
			$data['module_code'][$value['mod_id']] = $value['mod_desc'];
		}

		$datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['project_code']] = $value;
			$data['project_code'][$value['id']] = $value['project_code'];
		}

		$datadb = $this->general_mod->drawing_type();
		$drawing_type_list = [];
		foreach ($datadb as $key => $value) {
			$drawing_type_list[$value['code']] = $value;
		}

		$datadb = $this->fitup_mod->fitter_code();
		foreach ($datadb as $key => $value) {
			$data['fitter_code_arr'][$value['id_fitter']] = $value['fit_up_badge'];
		}

		$datadb = $this->fitup_mod->welder_code_version_view_only();
		foreach ($datadb as $key => $value) {
			$data['welder_code_arr'][$value['id_welder']] = $value['welder_code'];
			$data['rwe_code_arr'][$value['id_welder']] = $value['rwe_code'];
		}

		$datadb = $this->fitup_mod->wps_code_version_report();
		foreach ($datadb as $key => $value) {
			$data['wps_code_arr'][$value['id_wps']] = $value['wps_no'];
		}

		$datadb = $this->fitup_mod->area_name();
		foreach ($datadb as $key => $value) {
			$area_name_list[$value['area_name']] = $value;
			$data['area_name_arr'][$value['id']] = $value['area_name'];
		}

		//-------- Area New V2 ------//

		$datadb = $this->planning_mod->master_area_v2();
		foreach ($datadb as $key => $value) {
			$area_name_list_v2[$value['id']] = $value;
			$data['area_name_arr_v2'][$value['id']] = $value['name'];
		}
		$data['area_name_list_v2'] = $area_name_list_v2;

		$datadb = $this->planning_mod->master_location_v2();
		foreach ($datadb as $key => $value) {
			$location_name_list_v2[$value['id']] = $value;
			$data['location_name_arr_v2'][$value['id']] = $value['name'];
		}
		$data['location_name_list_v2'] = $location_name_list_v2;

		//-------- Area New V2 ------//

		$where["b.project_code"]   = $project;		
		$where["b.discipline"]     = $discipline;		
		$where["b.module"]		   = $module;		
		$where["b.type_of_module"] = $type_of_module;	
		$where["c.company_id"] = $company_id;	
		$where["b.status_resubmit <> 1"] = null;	
		$where["b.status_retransmitted"] = 0;	
		$where["b.status_inspection <> 12"] 	= null;
		if(isset($report_number) AND $report_number != 'marz'){	
			$where["b.report_number"]  = $report_number;
		} else {
			$where["b.submission_id"]  = $submission_id;
		}	

		$where["b.status_inspection <> 12"]    = null;
		$where["a.status_delete <> 0"]    	= null; 

		$data['joint_list']  = $this->fitup_mod->joint_list($where);
		$remarks = array_column($data['joint_list'], 'remarks');
		// test_var($remarks);
		// test_var($data['joint_list']);

		$piecemark_list_submit_1 = array();
		$piecemark_list_submit_2 = array();
		foreach ($data['joint_list'] as $key => $value) {
			$piecemark_list_submit_1[] =  $value['pos_1'];
			$piecemark_list_submit_2[] =  $value['pos_2'];
		}
		
		$list_of_pc = array_merge($piecemark_list_submit_1,$piecemark_list_submit_2);
		unset($where);
 
		if(sizeof(@$data['joint_list']) > 0){    
			$id_user_1   = array_column($data['joint_list'], 'requestor');  
			$id_user_2   = array_column($data['joint_list'], 'inspection_by');  
			$id_user_3   = array_column($data['joint_list'], 'transmitted_by');  
			$id_user_4   = array_column($data['joint_list'], 'client_inspection_by');  
			$id_user_5   = array_column($data['joint_list'], 'surveyor_creator');  
			$id_user_6   = array_column($data['joint_list'], 'latest_update_by');  
			$id_user_7   = array_column($data['joint_list'], 'document_approval_by');  
			$id_user_8   = array_column($data['joint_list'], 'void_by');  
			$id_user_9   = array_column($data['joint_list'], 'last_surveyor_update_by');  
  
			$id_user_all = array_unique(array_filter(array_merge($id_user_1,$id_user_2,$id_user_3,$id_user_4,$id_user_5,$id_user_6,$id_user_7,$id_user_8,$id_user_9)));  
			$where_user["id_user IN ('".implode("', '", $id_user_all)."')"] = NULL;   
			$datadb  = $this->general_mod->portal_user_db_list($where_user);  
			foreach ($datadb as $value) {  
				$user_list[$value['id_user']] = $value['full_name'];  
				$data["user_list"][$value['id_user']] = $value['full_name'];  
				$data['user'][$value['id_user']] = $value;  
				$data["sign_approval"][$value['id_user']] = $value['sign_approval'];
			}  
			unset($where_user);  
		}  
		
		if($data['joint_list']) {
			foreach($data['joint_list'] as $value) {
			  $document_no_list[] = $value['drawing_no'] != '' ? $value['drawing_no'] : 0;
			  $document_no_list[] = $value['drawing_wm'] != '' ? $value['drawing_wm'] : 0;
			}
			
			$max_approval_date 			= max(array_column($data['joint_list'], 'inspection_datetime'));
			$max_document_approval_date = max(array_column($data['joint_list'], 'document_approval_date'));
			
			$data["max_array_date_inspection"] 		  = $max_approval_date;
			$data["max_array_date_document_approval"] = $max_document_approval_date;
	  
			$where["document_no IN ('".implode("', '", array_unique($document_no_list))."')"] = NULL;
			$where["status_delete"] = 1;
			$data_drawing  = $this->wtr_mod->data_drawing_list_mysql($where);
			unset($where);

			if($data_drawing) {
			  foreach($data_drawing as $value) {
				$data['drawing_rev'][$value['document_no']] 	= $value['last_revision_no'];
				$data['client_doc_no'][$value['document_no']] 	= $value['client_doc_no'];
			  }
			}

			$data["revision_master"] = $this->fitup_mod->select_itp_revision_master();  
			$total_data_rev_master = sizeof($data["revision_master"]); 
			$default_rev = "06"; 
			$no = 1;  
			foreach($data["revision_master"] as $key => $val){ 
				if($no < $total_data_rev_master){ 
					$key_n = $key+1; 
				} else if($no == $total_data_rev_master){ 
					$key_n = $key; 
				} 
				$max_document_approval_date = date("Y-m-d",strtotime($max_document_approval_date)); 
				$max_approval_date = date("Y-m-d",strtotime($max_approval_date)); 
				$date_affected = date("Y-m-d",strtotime($val["date_affected"])); 
				$date_affected_next = date("Y-m-d",strtotime($data["revision_master"][$key_n]["date_affected"])); 
				$xxx[] =  $max_approval_date." - ".$date_affected." - ".$date_affected_next;   
				if($data["joint_list"][0]['ticked_report_date'] == 1){					  
					if( ($max_document_approval_date >= $date_affected) ){ 
						$data["rev_no_show"] = $val["revision_no"];                 
					} else {
						$data["rev_no_show"] = $default_rev;
					}					  
				} else {					 
					if(($max_approval_date >= $date_affected) && ($max_approval_date < $date_affected_next)){ 
						$data["rev_no_show"] = $val["revision_no"];                    
					} else {
						$data["rev_no_show"] = $default_rev;
					}					  
				} 
				$no++; 
			} 
		}
   
    
		$wherex["part_id IN ('".implode("', '", $list_of_pc)."')"] = NULL; 
		$wherex["a.status_delete <> 0"] 	= null;  
		$wherex["a.ref_pos_1 <> ''"] 	= null;  
		$wherex["a.ref_pos_1 IS NOT NULL"] 	= null;  
		$datadb  = $this->fitup_mod->template_piecemark_list($wherex);  
		unset($wherex);   
		$array_group = array(); 
		foreach ($datadb as $key => $value) { 
			$push[$key] = explode(", ",$value['ref_pos_1']);  
			if(sizeof($push[$key]) > 0){ 
				foreach($push[$key] as $vals){ 
					array_push($array_group,$vals); 
				} 
			} 

			$data['status_piecemark_ref'][$value['part_id']] = $value;  
		}   
			
		if(sizeof($array_group) > 0){ 
			$wherex["a.id IN ('".implode("', '", $array_group)."') OR a.part_id IN ('".implode("', '", $list_of_pc)."')"] = NULL;  
		} else { 
			$wherex["a.part_id IN ('".implode("', '", $list_of_pc)."')"] = NULL;  
		} 
		$wherex["b.status_delete"] 	= 0; 
		$wherex["b.status_inspection <> 12"] 	= null; 
		$wherex["b.report_resubmit_status = 0"] 	= null;     
		$datadb  = $this->fitup_mod->piecemark_list($wherex);  
		foreach ($datadb as $key => $value) { 
			$data['status_piecemark'][$value['part_id']] = $value; 
			$data['status_piecemark_ref_1'][$value['id']] = $value; 
		} 
		unset($where); 
		unset($wherex);  

		if(sizeof($array_group) > 0){ 
			$wherex["a.id IN ('".implode("', '", $array_group)."') OR a.part_id IN ('".implode("', '", $list_of_pc)."')"] = NULL;  
		} else { 
			$wherex["a.part_id IN ('".implode("', '", $list_of_pc)."')"] = NULL;  
		} 
		$wherex["b.status_delete"] 	= 0; 
		$wherex["b.status_inspection <> 12"] 	= null;  
		$wherex["b.report_resubmit_status = 0"] 	= null;    
		$datadb_itr  = $this->fitup_mod->piecemark_list_itr($wherex);   
		foreach ($datadb_itr as $key => $value) { 
			$data['status_piecemark_itr'][$value['part_id']] = $value; 
			$data['status_piecemark_ref_1_itr'][$value['id']] = $value; 
		}  
		unset($where); 
		unset($wherex); 

		if(sizeof(@$data['joint_list']) > 0){
			$id_mis_itr  = array_filter(array_column($datadb_itr, 'id_mis')); 
			$id_mis      = array_filter(array_column($datadb, 'id_mis')); 
			$merge_array = array_merge($id_mis_itr,$id_mis);
			$filter_mis  = array_unique($merge_array);  
			$where_mis["id_mis_det IN ('".implode("', '", $filter_mis)."')"] = NULL;  
			$datadb = $this->fitup_mod->warehouse_mis_mrir($where_mis);  
			foreach ($datadb as $key => $value) {  
				$data['warehouse_mis_mrir'][$value['id_mis_det']] = $value;  
			}  
			unset($where_mis);  
		}  
  
		$where["document_no"] = $data['joint_list'][0]['drawing_no']; 
		$data["eng_detail"]  = $this->general_mod->get_drawing_title($where);
		unset($where);
 
		$data["project_data_portal"]     = $this->general_mod->read_project_name($project);

		if(isset($report_number) AND $report_number != 'marz'){	
			$data['report_number']  = $report_number;
			$report_number_filename = $report_number.".pdf";
		} else {
			$data['submission_data_id']  = $submission_id;	
			$report_number_filename = $submission_id.".pdf";
		}

		$where_eng['document_no'] = $data['joint_list'][0]['drawing_no'];
		$datadb = $this->visual_mod->drawing_list($where_eng);
		unset($where_eng);
		foreach ($datadb as $key => $value) {
			$data['master_drawing'][$value['document_no']] = $value;
		}

    $file_name                = $data['master_report_number'][$data['joint_list'][0]['project_code']][$data['joint_list'][0]['discipline']][$data['joint_list'][0]['type_of_module']]['fitup_report'].$report_number;

    $this->load->library('Pdfgenerator_download');
		$html                     = $this->load->view('fitup/pdf_files', $data, true);

    $file_name                = $file_name.'.pdf';

    $app_nos                  = "";
		$this->pdfgenerator_download->generate($html,$file_name,$app_nos, $file_loc, "landscape");

	}

  public function fitup_dossier($deck, $action = "view", $offline_loc = null){
		$where["pcms_joint.project"]                    = 12;
		$where["pcms_joint.status_delete <> 0"]         = NULL;
		$where["pcms_joint.status_internal"]            = 0;
		$where["pcms_joint.type_of_module"]             = 1;
		$where["pcms_joint.discipline <> 1"]            = NULL;
		$where["pcms_joint.deck_elevation"]             = $deck;
    $where["pcms_fitup.status_resubmit <> 1"] 	    = null;
		$where["pcms_fitup.status_retransmitted"] 	    = 0;
		$where["pcms_fitup.report_number IS NOT NULL"]  = NULL;
		$where["pcms_fitup.status_inspection >= 5"]     = NULL;
		$where["pcms_workpack.company_id <> 13"]     = NULL;
		$datadb = $this->mdb_mod->fitup_dossier($where);
    unset($where); 
 
    $output                                     = [];
		foreach ($datadb as $key => $value) {

      $button                = site_url('fitup/pdf_files/'.strtr($this->encryption->encrypt($value['project']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['discipline']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['module']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['type_of_module']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['report_number']),'+=/', '.-~')).'/'.strtr($this->encryption->encrypt($value['company_id']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['company_id']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['company_id']),'+=/', '.-~');

      if($value['company_id'] == 13){
        $report_no = $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['fitup_report_scm'].$value['report_number'];
      } else {
        $report_no = $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['fitup_report'].$value['report_number'];
      }

      if(@count($output) > 20) {
        break;
      }

			$output[] = [
        "report_number"       => $report_no,         
        "att_link"            => $report_no.'.pdf',         
				"ecodoc_no"           => $value['ecodoc_no'],
        "deck_elevation"      => $value['deck_elevation'],
				"book_volume"      => $value['book_volume'],
        'link_ecodoc'           => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
				"link"			          => $button, 
			];

      if($action == "save") {
        $this->fitup_pdf(encrypt($value['project']),encrypt($value['discipline']),encrypt($value['module']),encrypt($value['type_of_module']),encrypt($value['report_number']),encrypt($value['company_id']), encrypt($value['company_id']), encrypt($value['company_id']), $offline_loc);
      }

		}
		return $output;
	}

	public function mdb_general(){
		$ecodoc_no_arr = [];

		$datadb = $this->additional_attachment_mod->master_mdb_general_list([
			"category" => 'MDB GENERAL',
		], [
			"volume::int" => "ASC",
			"section::int" => "ASC",
			"subsection::int" => "ASC",
		]);
		// test_var($datadb);
		$data['mdb_general_volume_list'] = [];
		$data['mdb_general_section_list'] = [];
		$data['mdb_general_subsection_list'] = [];
		foreach ($datadb as $key => $value) {
			if($value['volume'] != '' && $value['section'] == '' && $value['subsection'] == ''){
				$data['mdb_general_volume_list'][] = $value;
			}
			elseif($value['volume'] != '' && $value['section'] != '' && $value['subsection'] == ''){
				$data['mdb_general_section_list'][$value['volume']][] = $value;
			}
			elseif($value['volume'] != '' && $value['section'] != '' && $value['subsection'] != ''){
				$data['mdb_general_subsection_list'][$value['volume']][$value['section']][] = $value;
			}

			if($value['ecodoc_no'] != ''){
				$ecodoc_no_arr[] = $value['ecodoc_no'];
			}
		}
		// test_var($data);

    $data['file_list'] = array_merge($data['file_list'] ?? [], $this->material_certificate());

    $data['meta_title']         = 'MDB GENERAL – GENERAL FABRICATION PROCEDURE';
    $data['subview']            = 'mdb/mdb_general';
    // $data['sidebar']            = $this->sidebar;

    $this->load->view($data['subview'], $data);
	}

  public function material_certificate() {

    $catalog_category_list      = $this->mdb_mod->catalog_category_list();
    foreach($catalog_category_list as $value) {
      $category[$value['id']]   = $value['catalog_category'];
    }

    $where["category != 'CM'"]  = null;
    $data_list                  = $this->mdb_mod->mrir_list($where);
    unset($where);

    $output                     = [];
    $temp                       = [];

    if($data_list) {

      $list_receiving_id        = array_column($data_list, 'receiving_id');
      $where[implode_where("receiving_id", $list_receiving_id)] = null;
      $attachment_list          = $this->mdb_mod->receiving_document_list($where);
      unset($where);

      foreach($attachment_list as $value) {
        $certificate[$value['receiving_id']][$value['certificate_number']]  = $value;
      }

      foreach($data_list as $value) {

        $cat_name                       = strtoupper($category[$value['catalog_category_id']]);
        $value['catalog_category_name'] = $cat_name;

        if(isset($certificate[$value['receiving_id']][$value['mill_cert_no']])) {

          $enc_cert_name                = encrypt($certificate[$value['receiving_id']][$value['mill_cert_no']]['attachment_name']);
          $enc_path_name                = encrypt('/PCMS/warehouse/receiving');
          $value['link']                = site_url('irn/open_file/'.$enc_cert_name.'/'.$enc_path_name);
          $value['ecodoc_no']           = $certificate[$value['receiving_id']][$value['mill_cert_no']]['ecodoc_no'];
          $value['book_volume']         = $certificate[$value['receiving_id']][$value['mill_cert_no']]['book_volume'];


          $key_data                     = $value['receiving_id'].'_'.$value['mill_cert_no'].'_'.$cat_name;

          if(in_array($key_data, $temp)) {
            continue;
          }

					$row = [
						"link" => $value['link'],
						"document_no" => $value['mill_cert_no'],
						"ecodoc_no"   => $value['ecodoc_no'],
            'link_ecodoc' => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".encrypt($value['ecodoc_no']),
						"book_volume" => $value['book_volume'],
					];
          if(strpos($cat_name, 'PLATE') !== false) {
            $output["certificate_plate"][]    = $row;
          } elseif(strpos($cat_name, 'PIPE') !== false) {
            $output["certificate_pipe"][]    = $row;
          } else {
            $output["certificate_others"][]    = $row;
          }

          $temp[]                     = $key_data;
        }

      }

    }
    return $output; 
  }

	public function mdb_jacket_new($params){
		$ecodoc_no_arr = [];

		$datadb = $this->additional_attachment_mod->master_mdb_general_list([
			"category" => 'MDB JACKET',
		], [
			"volume" => "ASC",
			"section::int" => "ASC",
			"subsection::int" => "ASC",
		]);
		// test_var($datadb);
		$data['mdb_general_volume_list'] = [];
		$data['mdb_general_section_list'] = [];
		$data['mdb_general_subsection_list'] = [];
		foreach ($datadb as $key => $value) {
			if($value['volume'] != '' && $value['section'] == '' && $value['subsection'] == ''){
				$data['mdb_general_volume_list'][] = $value;
			}
			elseif($value['volume'] != '' && $value['section'] != '' && $value['subsection'] == ''){
				$data['mdb_general_section_list'][$value['volume']][] = $value;
			}
			elseif($value['volume'] != '' && $value['section'] != '' && $value['subsection'] != ''){
				$data['mdb_general_subsection_list'][$value['volume']][$value['section']][] = $value;
			}

			if($value['ecodoc_no'] != ''){
				$ecodoc_no_arr[] = $value['ecodoc_no'];
			}
		}
		// test_var($data);
		$data['file_list'] = [];

		$datadb 	= $this->shopdrawing_dossier_jacket();
		foreach ($datadb as $key => $value) {
			foreach ($value as $key2 => $value2) {
				$data['file_list']['shopdrawing_dossier_'.$key.'_'.$key2] = $value2;
			}
		}
		$data['file_list']['shopdrawing_dossier_GA_26_10'] = array_merge($data['file_list']['shopdrawing_dossier_GA_26'] ?? [],$data['file_list']['shopdrawing_dossier_GA_10'] ?? []);
		unset($data['file_list']['shopdrawing_dossier_GA_26']);
		unset($data['file_list']['shopdrawing_dossier_GA_10']);
		$data['file_list']['shopdrawing_dossier_GA_22_27'] = array_merge($data['file_list']['shopdrawing_dossier_GA_22'] ?? [],$data['file_list']['shopdrawing_dossier_GA_27'] ?? []);
		unset($data['file_list']['shopdrawing_dossier_GA_22']);
		unset($data['file_list']['shopdrawing_dossier_GA_27']);

		$data['file_list']['shopdrawing_dossier_WM_26_10'] = array_merge($data['file_list']['shopdrawing_dossier_WM_26'] ?? [],$data['file_list']['shopdrawing_dossier_WM_10'] ?? []);
		unset($data['file_list']['shopdrawing_dossier_WM_26']);
		unset($data['file_list']['shopdrawing_dossier_WM_10']);
		$data['file_list']['shopdrawing_dossier_WM_22_27'] = array_merge($data['file_list']['shopdrawing_dossier_WM_22'] ?? [],$data['file_list']['shopdrawing_dossier_WM_27'] ?? []);
		unset($data['file_list']['shopdrawing_dossier_WM_22']);
		unset($data['file_list']['shopdrawing_dossier_WM_27']);

		$datadb    = $this->ndt_jacket_all();
		foreach ($datadb as $key => $value) {
			$data['file_list']['ndt_structure_'.$key] = $value;
		}

		$datadb    = $this->additional_attachment();
		foreach ($datadb as $key => $value) {
			$data['file_list']['additional_att_'.$key] = $value;
		}

		$datadb 	= $this->dimension_dossier(NULL, NULL, NULL, NULL, NULL);
		foreach ($datadb as $key => $value) {
			$data['file_list']['additional_att_'.$key] = $value;
		}

		$datadb    = $this->mv_jacket();
		foreach ($datadb as $key => $value) {
			$data['file_list']['mv_dossier_'.$key] = $value;
		}
		
		$datadb  = $this->fitup_jacket();
		foreach ($datadb as $key => $value) {
			$data['file_list']['fitup_dossier_'.$key] = $value;
		}

		$datadb = $this->visual_jacket();
		foreach ($datadb as $key => $value) {
			$data['file_list']['visual_dossier_'.$key] = $value;
		}

		$datadb    = $this->ndt_jacket();
		foreach ($datadb as $id_cat => $ndt_type_list) {
			foreach ($ndt_type_list as $ndt_type => $value) {
				$data['file_list']['ndt_dossier_'.$id_cat.'_'.$ndt_type] = $value;
			}
		}

		$datadb    = $this->irn_jacket();
		foreach ($datadb as $key => $value) {
			$data['file_list']['irn_dossier_'.$key] = $value;
		}

		$datadb    =  $this->wtr_jacket();
		foreach ($datadb as $key => $value) {
			$data['file_list']['wtr_dossier_'.$key] = $value;
		}

		// test_var($datadb);

		$data['file_list']['fitup_structure']  	= $this->fitup_jacket_all();
		$data['file_list']['visual_structure'] 	= $this->visual_jacket_all();
		$data['file_list']['irn_structure']    	= $this->irn_jacket_all();
		$data['file_list']['mv_structure']     	= $this->mv_jacket_all();
		$data['file_list']['wtr_structure']    	= $this->wtr_jacket_all();
		$data['file_list']['dimension_all']		 	= $this->dimension_dossier(NULL, NULL, NULL, NULL, NULL);

		// test_var($data['file_list']['irn_structure']);
		// test_var($data['file_list']);
    // $data['file_list'] = array_merge($data['file_list'] ?? [], $this->material_certificate());

    $data['meta_title']         = 'MDB INDEX B (SPECIFIC) JACKET';
    $data['subview']            = 'mdb/mdb_jacket_new';
    // $data['sidebar']            = $this->sidebar;

    if(isset($params)) {
      if($params['offline']) {
        return $this->generate_index_jacket($data, $params);
      }
    }

    $this->load->view($data['subview'], $data);
	}

	protected function generate_index_jacket($data, $params) {

    $index_name                   = $params['index_loc'].'/index.html';
    $myfile                       = fopen($index_name, "w");
    $data['params']               = $params;
    $view                         = $this->load->view('mdb/offline/mdb_jacket', $data, true);
    fwrite($myfile, $view);
  }

  public function mdb_jacket() {
		$data['shopdrawing_dossier'] 	= $this->shopdrawing_dossier_jacket();
    
    // BY DRAWING CATEGORY
      $data['fitup_dossier']  = $this->fitup_jacket();
      $data['visual_dossier'] = $this->visual_jacket();
      $data['ndt_dossier']    = $this->ndt_jacket();
      $data['irn_dossier']    = $this->irn_jacket();
      $data['mv_dossier']     = $this->mv_jacket();
      $data['wtr_dossier']    = $this->wtr_jacket();

    // BY ALL STRUCTURE
      $data['fitup_structure']  = $this->fitup_jacket_all();
      $data['visual_structure'] = $this->visual_jacket_all();
      $data['ndt_structure']    = $this->ndt_jacket_all();
      $data['irn_structure']    = $this->irn_jacket_all();
      $data['mv_structure']     = $this->mv_jacket_all();
      $data['wtr_structure']    =  $this->wtr_jacket_all();

    $data['additional_att'] = $this->additional_attachment();
    $data['meta_title'] = 'MDB INDEX B (SPECIFIC) JACKET';
    $this->load->view('mdb/mdb_jacket', $data);
  }

  public function fitup_jacket_all($action = "view", $offline_loc = null){
    error_reporting(0);

    $list_drawing                     = $this->drawing_jacket();
    $list_drawing                     = $list_drawing['all'];
    $arr_list_drawing                 = array_column($list_drawing, 'document_no');

    $where["pcms_joint.project"]                    = 12;
    $where["pcms_joint.status_delete <> 0"]         = NULL;
    $where["pcms_joint.status_internal"]            = 0;
    $where["pcms_joint.type_of_module"]             = 2;
    $where["pcms_fitup.status_resubmit <> 1"]       = null;
    $where["pcms_fitup.status_retransmitted"]       = 0;
    $where["pcms_fitup.report_number IS NOT NULL"]  = NULL;
    $where["pcms_fitup.status_inspection >= 5"]     = NULL;
    $where["pcms_workpack.company_id <> 13"]     = NULL;
    $where["pcms_joint.drawing_no NOT IN ('".implode("', '", array_unique($arr_list_drawing))."')"] = null;
    $datadb = $this->mdb_mod->fitup_dossier($where);

    foreach ($datadb as $key => $value) {
      
      $link   = site_url('fitup/pdf_files/'.strtr($this->encryption->encrypt($value['project']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['discipline']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['module']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['type_of_module']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['report_number']),'+=/', '.-~')).'/'.strtr($this->encryption->encrypt($value['company_id']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['company_id']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['company_id']),'+=/', '.-~');

      $output[] = [
        "att_link"   => $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['fitup_report'.($value['company_id']==13 ? '_scm' : '')].$value['report_number'].'.pdf',

        "company_id"      => $value['company_id'],        
        "discipline"      => $value['discipline'],
        "report_number"   => $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['fitup_report'.($value['company_id']==13 ? '_scm' : '')].$value['report_number'],
        "link"            => $link,
        'link_ecodoc'           => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
        "ecodoc_no"       => $value['ecodoc_no'],
        "book_volume"       => $value['book_volume'],
      ]; 

      if($action == "save") {
      	$this->ecodoc_no_list[] = $value['ecodoc_no'];
        $this->fitup_pdf(
        	encrypt($value['project']),
        	encrypt($value['discipline']),
        	encrypt($value['module']),
        	encrypt($value['type_of_module']),
        	encrypt($value['report_number']),
        	encrypt($value['report_no_rev']),
        	encrypt($value['drawing_no']),
        	encrypt($value['company_id']),
        	$offline_loc
        );
      }  

    }
    return $output;
  }

  public function fitup_jacket($action = "view", $offline_loc = null){
    error_reporting(0);

    // test_var($offline_loc);

    $list_drawing                     = $this->drawing_jacket();
    $list_drawing                     = $list_drawing['all'];
    $arr_list_drawing                 = array_column($list_drawing, 'document_no');

    $where["pcms_joint.project"]                    = 12;
    $where["pcms_joint.status_delete <> 0"]         = NULL;
    $where["pcms_joint.status_internal"]            = 0;
    $where["pcms_joint.type_of_module"]             = 2;
    $where["pcms_fitup.status_resubmit <> 1"]       = null;
    $where["pcms_fitup.status_retransmitted"]       = 0;
    $where["pcms_fitup.report_number IS NOT NULL"]  = NULL;
    $where["pcms_fitup.status_inspection >= 5"]     = NULL;
    $where["pcms_workpack.company_id <> 13"]     = NULL;
    $where[implode_where("pcms_joint.drawing_no", $arr_list_drawing)] = null;
    $datadb = $this->mdb_mod->fitup_dossier($where);

    foreach ($datadb as $key => $value) {
      
      $id_cat = $list_drawing[$value['drawing_no']]['desc_assy'];
      
      $link   = site_url('fitup/pdf_files/'.strtr($this->encryption->encrypt($value['project']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['discipline']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['module']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['type_of_module']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['report_number']),'+=/', '.-~')).'/'.strtr($this->encryption->encrypt($value['company_id']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['company_id']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['company_id']),'+=/', '.-~');

      $output[$id_cat][] = [
        "att_link"   => $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['fitup_report'.($value['company_id']==13 ? '_scm' : '')].$value['report_number'].'.pdf',

        "company_id"      => $value['company_id'],        
        "discipline"      => $value['discipline'],
        "report_number"   => $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['fitup_report'.($value['company_id']==13 ? '_scm' : '')].$value['report_number'],
        "link"            => $link,
        'link_ecodoc'           => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
        "ecodoc_no"       => $value['ecodoc_no'],
        "book_volume"       => $value['book_volume'],
      ];

      if($action == "save") {
      	$this->ecodoc_no_list[] = $value['ecodoc_no'];
        $this->fitup_pdf(
        	encrypt($value['project']),
        	encrypt($value['discipline']),
        	encrypt($value['module']),
        	encrypt($value['type_of_module']),
        	encrypt($value['report_number']),
        	encrypt($value['report_no_rev']),
        	encrypt($value['drawing_no']),
        	encrypt($value['company_id']),
        	$offline_loc
        );
      }  

    }
    return $output;
  }

  public function mv_jacket_all($action = "view", $offline_loc = null){

    error_reporting(0);
    $list_drawing                     = $this->drawing_jacket();
    $list_drawing                     = $list_drawing['all'];
    $arr_list_drawing                 = array_column($list_drawing, 'document_no');

    $output                           = [];

    $where["mv.drawing_no NOT IN ('".implode("', '", array_unique($arr_list_drawing))."')"] = null;
    $where["(status_delete = 0 OR (status_delete = 1 AND status_inspection = 12))"] = null;
    $where["report_resubmit_status"]      = 0;
    $where['report_number IS NOT NULL']   = null;
    $where['project_code']                = 12;
    $where['type_of_module']              = 2;
    $where['status_inspection']           = 7;
    $where['wp.company_id != 13']         = null;

    $data_list                        = $this->mdb_mod->mv_dossier_deck($where);
    unset($where);

    if($data_list) {
      foreach($data_list as $key => $value) {

        $rep_cat            = "mv_no";

        $output[]   = [

        	"att_link" => $this->report[$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']][$rep_cat].'-'.$value['report_number'].'.pdf',

          "report_number" => $this->report[$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']][$rep_cat].'-'.$value['report_number'],
          "ecodoc_no"     => $value['ecodoc_no'],
          'link_ecodoc'                 => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".encrypt($value['ecodoc_no']),
          "book_volume"     => $value['book_volume'],

          "link"			    => site_url('material_verification/material_verification_pdf_client/'.encrypt($value['project_code']).'/'.encrypt($value['discipline']).'/'.encrypt($value['type_of_module']).'/'.encrypt($value['module']).'/'.encrypt($value['report_number']).'/'.encrypt($value['report_no_rev']).'/'.encrypt($value['drawing_no'])),
          'deck_elevation' => $value['deck_elevation']
        ];      

        if($action == "save"){
        	$this->ecodoc_no_list[] = $value['ecodoc_no'];
          $file_loc                       = encrypt($offline_loc);
          $this->mv_pdf(encrypt($value['project_code']),encrypt($value['discipline']),encrypt($value['type_of_module']),encrypt($value['module']),encrypt($value['report_number']),encrypt($value['report_no_rev']),encrypt($value['drawing_no']), $file_loc);
        }  
       
      }
    }

    return $output;
  }

  public function irn_jacket_all($action = "view", $offline_loc = null){ 
    $list_drawing                     = $this->drawing_jacket();
    $list_drawing                     = $list_drawing['all'];
    $arr_list_drawing                 = array_column($list_drawing, 'document_no');

    $where["pcms_joint.drawing_no NOT IN ('".implode("', '", array_unique($arr_list_drawing))."')"] = null;
    $where["pcms_joint.project"] = 12;
    $where["pcms_joint.discipline != 1"] = NULL;
    $where["pcms_workpack.company_id != 13"] = NULL;
    $where["pcms_joint.type_of_module"] = 2;
    $where["pcms_irn.report_number IS NOT NULL"] = NULL;
    $datadb = $this->mdb_mod->irn_dossier($where);
    foreach ($datadb as $key => $value) {
      $id_cat             = $list_drawing[$value['drawing_no']]['desc_assy'];
      $this->ecodoc_no_list[] = $value['ecodoc_no'];

      $enc_id = strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~');
      $output[] = [
        "discipline"      => $value['discipline'],
        "company_id"      => $value['company_id'],
        "att_link"   => $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['irn_report'.($value['company_id']==13 ? '_scm' : '')].$value['report_number'].'.pdf',
        "report_number"   => $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['irn_report'.($value['company_id']==13 ? '_scm' : '')].$value['report_number'],
        "link"            => site_url('irn/show_irn_detail/').$enc_id,
        'link_ecodoc'           => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
        "ecodoc_no"       => $value['ecodoc_no'],
        "book_volume"       => $value['book_volume'],
      ];

      if($action == "save") {
      	$this->ecodoc_no_list[] = $value['ecodoc_no'];

        $file_loc = encrypt($offline_loc);
        $this->irn_pdf(
        	$enc_id, 
        	$this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['irn_report'.($value['company_id']==13 ? '_scm' : '')].$value['report_number'], 
        	$offline_loc
        );
      } 
    }
    return $output;
  }

  public function irn_jacket($action = "view", $offline_loc = null){
    $list_drawing                     = $this->drawing_jacket();
    $list_drawing                     = $list_drawing['all'];
    $arr_list_drawing                 = array_column($list_drawing, 'document_no');

    $where[implode_where("pcms_joint.drawing_no", $arr_list_drawing)] = null;
    $where["pcms_joint.project"] = 12;
    $where["pcms_joint.discipline != 1"] = NULL;
    $where["pcms_workpack.company_id != 13"] = NULL;
    $where["pcms_joint.type_of_module"] = 2;
    $where["pcms_irn.report_number IS NOT NULL"] = NULL;
    $datadb = $this->mdb_mod->irn_dossier($where);
    foreach ($datadb as $key => $value) {
      $id_cat             = $list_drawing[$value['drawing_no']]['desc_assy'];
      $this->ecodoc_no_list[] = $value['ecodoc_no'];

      $enc_id = strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~');
      $report_no = $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['irn_report'.($value['company_id']==13 ? '_scm' : '')].$value['report_number'];

      $output[$id_cat][] = [
        "discipline"      => $value['discipline'],
        "company_id"      => $value['company_id'],
        "report_number"   => $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['irn_report'.($value['company_id']==13 ? '_scm' : '')].$value['report_number'],
        "link"            => site_url('irn/show_irn_detail/').$enc_id,
        'link_ecodoc'           => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
        "book_volume"       => $value['book_volume'],
        "ecodoc_no"       => $value['ecodoc_no'],
        "att_link"      => $report_no.'.pdf',
      ];

      if($action == "save") {
      	$this->ecodoc_no_list[] = $value['ecodoc_no'];

        $file_loc                       = encrypt($offline_loc);
        $this->irn_pdf(
        	$enc_id, 
        	$report_no, 
        	$offline_loc
        );
      } 

    }
    return $output;
  }

  public function ndt_jacket_all($action = "view", $offline_loc = null, $ndt_type = null, $sftp = null){
    error_reporting(0);

    $list_drawing                     = $this->drawing_jacket();
    $list_drawing                     = $list_drawing['all'];
    $arr_list_drawing                 = array_column($list_drawing, 'document_no');

    $where["pcms_joint.drawing_no NOT IN ('".implode("', '", array_unique($arr_list_drawing))."')"] = null;
    $where["pcms_joint.project"] = 12;
    $where["pcms_joint.type_of_module"] = 2;
    $where["pcms_workpack.company_id != 13"] = NULL;
    $where["pcms_ndt.report_number IS NOT NULL"] = NULL;
    $where["pcms_ndt.ndt_type"] = $ndt_type;
    $datadb = $this->mdb_mod->ndt_dossier($where);
    foreach ($datadb as $key => $value) {
      $id_cat             = $list_drawing[$value['drawing_no']]['desc_assy'];

      $output[$value['ndt_type']][] = [
        "discipline"      => $value['discipline'],
        "company_id"      => $value['company_id'],
        "report_number"   => $value['report_number'], 
        "att_link"        => $value['report_number'].'.pdf',
        "link"            => site_url('ndt/open_atc/').$value["filename"].'/'.$value["filename"],
        "ecodoc_no"       => $value['ecodoc_no'],
        'link_ecodoc'           => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
        "book_volume"       => $value['book_volume'],
      ];

      if($action == "save") {
      	$this->ecodoc_no_list[] = $value['ecodoc_no'];

        $local_file       = $offline_loc."/".$value['report_number'].'.pdf';
        $remote_file      = "/PCMS/NDT/upload/ndt/".$value["filename"];
        $sftp->get($remote_file, $local_file);
      }

    }
    return $output;
  }

  public function ndt_jacket($action = "view", $offline_loc = null, $ndt_type = null, $sftp = null){
    error_reporting(0);

    $list_drawing                     = $this->drawing_jacket();
    $list_drawing                     = $list_drawing['all'];
    $arr_list_drawing                 = array_column($list_drawing, 'document_no');

    $where[implode_where("pcms_joint.drawing_no", $arr_list_drawing)] = null;
    $where["pcms_joint.project"] = 12;
    $where["pcms_joint.type_of_module"] = 2;
    $where["pcms_workpack.company_id != 13"] = NULL;
    $where["pcms_ndt.report_number IS NOT NULL"] = NULL;
    $where["pcms_ndt.ndt_type"] = $ndt_type;

    $datadb = $this->mdb_mod->ndt_dossier($where);
    foreach ($datadb as $key => $value) {
      $id_cat             = $list_drawing[$value['drawing_no']]['desc_assy'];

      $output[$id_cat][$value['ndt_type']][] = [
        "att_link"        => $value['report_number'].'.pdf',
        "discipline"      => $value['discipline'],
        "company_id"      => $value['company_id'],
        "report_number"   => $value['report_number'],
        "link"            => site_url('ndt/open_atc/').$value["filename"].'/'.$value["filename"],
        "ecodoc_no"       => $value['ecodoc_no'],
        'link_ecodoc'           => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
        "book_volume"       => $value['book_volume'],
      ];

      if($action == "save") {
      	$this->ecodoc_no_list[] = $value['ecodoc_no'];

        $local_file       = $offline_loc."/".$value['report_number'].'.pdf';
        $remote_file      = "/PCMS/NDT/upload/ndt/".$value["filename"];
        $sftp->get($remote_file, $local_file);
      }

    }
    return $output;
  }

  public function visual_jacket_all($action = "view", $offline_loc = null){
    error_reporting(0);

    $list_drawing                     = $this->drawing_jacket();
    $list_drawing                     = $list_drawing['all'];
    $arr_list_drawing                 = array_column($list_drawing, 'document_no');

    $where["pcms_visual.project_code"] = 12;
    $where["pcms_visual.status_inspection != 12"] = NULL;
    $where["pcms_visual.report_number IS NOT NULL"] = NULL;
    $where["pcms_visual.type_of_module"] = 2;
    $where["pcms_workpack.company_id != 13"] = NULL;
    $where["pcms_joint.drawing_no NOT IN ('".implode("', '", array_unique($arr_list_drawing))."')"] = null;

    $datadb = $this->mdb_mod->visual_dossier($where);
    foreach ($datadb as $key => $value){
      
      $id_cat             = $list_drawing[$value['drawing_no']]['desc_assy'];
      
      $output[] = [
        "att_link" => $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['visual_report'.($value['company_id']==13 ? '_13' : '')].$value['report_number'].'.pdf',      	

        "company_id"      => $value['company_id'],     
        "discipline"      => $value['discipline'],
        "report_number"   => $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['visual_report'.($value['company_id']==13 ? '_13' : '')].$value['report_number'],
        "link"            => site_url('visual/visual_pdf/'.$value['report_number']).'/client/'.$value['drawing_no'].'/'.$value['postpone_reoffer_no'],
        "ecodoc_no"       => $value['ecodoc_no'],
        'link_ecodoc'           => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
        "book_volume"       => $value['book_volume'],
      ];

      if($action == "save") {
      	$this->ecodoc_no_list[] = $value['ecodoc_no'];

        $file_loc = $offline_loc;
        $this->visual_pdf(
        	$value['report_number'], 'client', $value['drawing_no'], $value['postpone_reoffer_no'],
        	$file_loc
        );
      }

    }
    return $output;
  }

  public function visual_jacket($action = "view", $offline_loc = null){ 
    // error_reporting(0);

    $list_drawing                     = $this->drawing_jacket();
    $list_drawing                     = $list_drawing['all'];
    $arr_list_drawing                 = array_column($list_drawing, 'document_no');

    $where["pcms_visual.project_code"] = 12;
    $where["pcms_visual.status_inspection != 12"] = NULL;
    $where["pcms_visual.report_number IS NOT NULL"] = NULL;
    $where["pcms_visual.type_of_module"] = 2;
    $where["pcms_workpack.company_id != 13"] = NULL;
    $where[implode_where("pcms_joint.drawing_no", $arr_list_drawing)] = null;
    $datadb = $this->mdb_mod->visual_dossier($where);
    foreach ($datadb as $key => $value) {
      
      $id_cat             = $list_drawing[$value['drawing_no']]['desc_assy'];
      
      $output[$id_cat][] = [
        "company_id"      => $value['company_id'],        
        "discipline"      => $value['discipline'],
        "report_number"   => $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['visual_report'.($value['company_id']==13 ? '_13' : '')].$value['report_number'],
        "link"            => site_url('visual/visual_pdf/'.$value['report_number']).'/client/'.$value['drawing_no'].'/'.$value['postpone_reoffer_no'],
        "ecodoc_no"       => $value['ecodoc_no'],
        'link_ecodoc'           => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
        "book_volume"       => $value['book_volume'],
      ];

      if($action == "save") {
      	$this->ecodoc_no_list[] = $value['ecodoc_no'];

        $file_loc                       = $offline_loc;
        $this->visual_pdf(
        	$value['report_number'], 'client', $value['drawing_no'], $value['postpone_reoffer_no'],
        	$file_loc
        );
      }

    }
    return $output;
  }

  public function drawing_jacket() {

    // 19 = J-TUBE
    // 22 = GROUTING
    // 29 = MUDMATS

    $desc_assy_list                   = [19, 22, 29];
    $where[implode_where("desc_assy", $desc_assy_list)] = null;
    $where['status_delete']           = 1;
    $where['project_id']              = 12;

    $list                             = [];
    $list_all                         = [];
    $output                           = [];

    $select                           = "id, document_no, desc_assy";
    $datadb                           = $this->mdb_mod->drawing_activity_list($where, null, $select);
    unset($where);

    foreach($datadb as $value) {
    	$this->ecodoc_no_list[] = $value['ecodoc_no'];

      $list[$value['desc_assy']][]      = $value['document_no'];
      $list_all[$value['document_no']]  = $value;
    }
    
    foreach($desc_assy_list as $value) {
      $output[$value]                 = $list[$value];
    }
    $output["all"]                    = $list_all;

    return $output;
  }

  public function mv_jacket($action = "view", $offline_loc = null) {
    error_reporting(0);
    $list_drawing                     = $this->drawing_jacket();
    $list_drawing                     = $list_drawing['all'];
    $arr_list_drawing                 = array_column($list_drawing, 'document_no');

    $output                           = [];

    $where[implode_where("mv.drawing_no", $arr_list_drawing)] = null;
    $where["(status_delete = 0 OR (status_delete = 1 AND status_inspection = 12))"] = null;
    $where["report_resubmit_status"]      = 0;
    $where['report_number IS NOT NULL']   = null;
    $where['project_code']                = 12;
    $where['type_of_module']              = 2;
    $where['status_inspection']           = 7;
    $where['wp.company_id != 13']         = null;
    $data_list                        = $this->mdb_mod->mv_dossier_deck($where);
    unset($where);

    if($data_list) {
      foreach($data_list as $key => $value) {

        $rep_cat            = "mv_no";
        $id_cat             = $list_drawing[$value['drawing_no']]['desc_assy'];

        $output[$id_cat][]   = [

        	"att_link" => $this->report[$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']][$rep_cat].'-'.$value['report_number'].'.pdf',

          "report_number" => $this->report[$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']][$rep_cat].'-'.$value['report_number'],
          "ecodoc_no"     => $value['ecodoc_no'],
          'link_ecodoc'                 => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".encrypt($value['ecodoc_no']),
          "book_volume"     => $value['book_volume'],

          "link"			    => site_url('material_verification/material_verification_pdf_client/'.encrypt($value['project_code']).'/'.encrypt($value['discipline']).'/'.encrypt($value['type_of_module']).'/'.encrypt($value['module']).'/'.encrypt($value['report_number']).'/'.encrypt($value['report_no_rev']).'/'.encrypt($value['drawing_no'])),
          'deck_elevation' => $value['deck_elevation']
        ];  

        if($action == "save") {
        	$this->ecodoc_no_list[] = $value['ecodoc_no'];

          $file_loc                       = encrypt($offline_loc);
          $this->mv_pdf(encrypt($value['project_code']),encrypt($value['discipline']),encrypt($value['type_of_module']),encrypt($value['module']),encrypt($value['report_number']),encrypt($value['report_no_rev']),encrypt($value['drawing_no']), $file_loc);
        }      
       
      }
    }
    return $output;
  }

  public function wtr_jacket_all() {

    $list_drawing                     = $this->drawing_jacket();
    $list_drawing                     = $list_drawing['all'];
    $arr_list_drawing                 = array_column($list_drawing, 'document_no');
    $output                           = [];

    $where["wtr.drawing_no NOT IN ('".implode("', '", array_unique($arr_list_drawing))."')"] = null;
    $where['status_deleted']        = 1;
    $where['status_inspection']     = 7;
    $where['wtr.project']           = 12;
    $where['wtr.type_of_module']    = 2;
    $where['wtr.discipline != 1']   = null;
    $datadb                         = $this->mdb_mod->wtr_dossier($where);
    unset($where);  

    $output                         = [];
    foreach($datadb as $value) {
    	$this->ecodoc_no_list[] = $value['ecodoc_no'];

      $output[] = [
        'drawing_no'            => $value['drawing_no'],
        'ecodoc_no'             => $value['ecodoc_no'],
        'link'                  => site_url('wtr/show_irn_detail_wtr_signed/'.encrypt($value['uniq_id'])),
        'link_ecodoc'           => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
        "book_volume"       => $value['book_volume'],
      ];
    }

    return $output;

  }

  public function wtr_jacket() {

    $list_drawing                     = $this->drawing_jacket();
    $list_drawing                     = $list_drawing['all'];
    $arr_list_drawing                 = array_column($list_drawing, 'document_no');
    $output                           = [];

    $where[implode_where("wtr.drawing_no", $arr_list_drawing)] = null;
    $where['status_deleted']        = 1;
    $where['status_inspection']     = 7;
    $where['wtr.project']           = 12;
    $where['wtr.type_of_module']    = 2;
    $where['wtr.discipline != 1']   = null;
    $datadb                         = $this->mdb_mod->wtr_dossier($where);
    unset($where);  

    $output                         = [];
    foreach($datadb as $value) {

      $id_cat                   = $list_drawing[$value['drawing_no']]['desc_assy'];
      $this->ecodoc_no_list[] = $value['ecodoc_no'];

      $output[$id_cat][] = [
        'drawing_no'            => $value['drawing_no'],
        'ecodoc_no'             => $value['ecodoc_no'],
        'link'                  => site_url('wtr/show_irn_detail_wtr_signed/'.encrypt($value['uniq_id'])),
        'link_ecodoc'           => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
        "book_volume"       => $value['book_volume'],
      ];
    }

    return $output;

  }

  public function master_mdb_ecodoc_list() {
    $data['mdb_list']          = $this->additional_attachment_mod->master_mdb_general_list();

    $data['meta_title']         = 'MDB Master List';
    $data['subview']            = 'mdb/master_mdb_ecodoc_list';
    $data['sidebar']            = $this->sidebar;
    $this->load->view('index', $data);
  }

	public function master_mdb_ecodoc_new(){
    $data['meta_title']         = 'Craete New MDB Master';
    $data['subview']            = 'mdb/master_mdb_ecodoc_new';
    $data['sidebar']            = $this->sidebar;
    $this->load->view('index', $data);
	}

	public function master_mdb_ecodoc_new_process(){
		$post = $this->input->post();

		$form_data = [
			'category' => $post['category'],
			'volume' => $post['volume'],
			'section' => $post['section'],
			'subsection' => $post['subsection'],
			'document_description' => $post['document_description'],
			'ecodoc_no' => $post['ecodoc_no'],
			'book_volume' => $post['book_volume'],
    ];
    $this->additional_attachment_mod->master_mdb_general_new_process($form_data);

    $this->session->set_flashdata('success','Success Add Data');
    redirect('mdb/master_mdb_ecodoc_list');
	}

	public function master_mdb_ecodoc_edit($id){
		$id = $this->encryption->decrypt(strtr($id, '.-~', '+=/'));
		
		$data['mdb_list'] = $this->additional_attachment_mod->master_mdb_general_list([
			'id' => $id,
		]);
		$data['mdb_list'] = $data['mdb_list'][0];

    $data['meta_title']         = 'Update MDB Master';
    $data['subview']            = 'mdb/master_mdb_ecodoc_edit';
    $data['sidebar']            = $this->sidebar;
    $this->load->view('index', $data);
	}

	public function master_mdb_ecodoc_edit_process(){
		$post = $this->input->post();
		$post['id'] = $this->encryption->decrypt(strtr($post['id'], '.-~', '+=/'));

		$form_data = [
			'category' => $post['category'],
			'volume' => $post['volume'],
			'section' => $post['section'],
			'subsection' => $post['subsection'],
			'document_description' => $post['document_description'],
			'ecodoc_no' => $post['ecodoc_no'],
			'book_volume' => $post['book_volume'],
			'status_delete' => $post['status_delete'],
    ];
    $this->additional_attachment_mod->master_mdb_general_edit_process($form_data, [
			'id' => $post['id'],
		]);

    $this->session->set_flashdata('success','Success Update Data');
    redirect($_SERVER["HTTP_REFERER"]);
	}





	// ==========================================================================
	// ==========================================================================
	public function offline_jacket() {

    // INDEX B BY DECK

    $user_id                        = $this->user_cookie[0];

    $permission                     = 0777;
    $recursive                      = true;

    $datadb = $this->additional_attachment_mod->master_mdb_general_list([
			"category" => 'MDB JACKET',
		], [
			"volume" => "ASC",
			"section::int" => "ASC",
			"subsection::int" => "ASC",
		]);
		// test_var($datadb);
	
		foreach ($datadb as $key => $value) {
			if($value['volume'] != '' && $value['section'] == '' && $value['subsection'] == ''){
				$mdb_general_volume_list[] = $value;
			}
			elseif($value['volume'] != '' && $value['section'] != '' && $value['subsection'] == ''){
				$mdb_general_section_list[$value['volume']][] = $value;
			}
			elseif($value['volume'] != '' && $value['section'] != '' && $value['subsection'] != ''){
				$mdb_general_subsection_list[$value['volume']][$value['section']][] = $value;
			}
		}

    if(!is_dir('file/temp_download/'.$user_id)) {
      mkdir('file/temp_download/'.$user_id, $permission, $recursive);
    }

    if(!is_dir('file/download_mdb/'.$user_id)) {
      mkdir('file/download_mdb/'.$user_id, $permission, $recursive);
    }

    $index_b                        = "file/download_mdb/$user_id/MDB/MDB JACKET";
    $ecodoc_loc                     = $index_b."/ECODOC";

    @mkdir($ecodoc_loc, $permission, $recursive);
    @mkdir($index_b, $permission, $recursive);

    $ftp                      = $this->ftp;
    require_once(APPPATH.'third_party/Net/SFTP.php');
    $sftp = new Net_SFTP($ftp['hostname']);
    $sftp->login($ftp['username'], $ftp['password']);

    // foreach($deck_list as $value) {

      $params                       = [];
      
      @mkdir($index_b.'/'.'JKT', $permission, $recursive);
      $deck_loc                     = $index_b.'/'.'JKT';
      @mkdir($deck_loc.'/2. JACKET FABRICATION', $permission, $recursive);

      $dir_main_ori                 = '2. JACKET FABRICATION';
      $dir_main                     = $deck_loc.'/'.$dir_main_ori;

      foreach($mdb_general_volume_list as $volume) {
        $first                      = $volume['volume'].'. '.$volume['document_description'];
        $first_level                = $dir_main.'/'.$first;
        $first_level_ori            = $dir_main_ori.'/'.$first;

        @mkdir($first_level, $permission, $recursive);

        // test_var($mdb_general_section_list[$volume['volume']], 1);
        // test_var($volume, 1);

        if(isset($mdb_general_section_list[$volume['volume']])) {
          foreach($mdb_general_section_list[$volume['volume']] as $section) {
          	// test_var($section);

            $second                 = $section['volume'].'.'.$section['section'].' '.$section['document_description'];
            $second_level           = $first_level.'/'.$second;
            $second_level_ori       = $first_level_ori.'/'.$second;

            @mkdir($second_level, $permission, $recursive);

						// irn_jacket
						// wtr_jacket
						// irn_jacket_all
						// wtr_jacket_all

						if($section['var_code'] == "mv_structure") {
              $this->mv_jacket_all('save', $second_level);
            } elseif(in_array($section['var_code'], ['mv_dossier_19', 'mv_dossier_22', 'mv_dossier_29']) ){
              $this->mv_jacket('save', $second_level);
            } elseif($section['var_code'] == "visual_structure") {
              $this->visual_jacket_all('save', $second_level);
            } elseif(in_array($section['var_code'], ['visual_dossier_19', 'visual_dossier_22', 'visual_dossier_29']) ){
              $this->visual_jacket('save', $second_level);
            } elseif($section['var_code'] == "fitup_structure") {
              $this->fitup_jacket_all('save', $second_level);
            } elseif(in_array($section['var_code'], ['fitup_dossier_19', 'fitup_dossier_22', 'fitup_dossier_29']) ){
              $this->fitup_jacket('save', $second_level);
            } elseif(in_array($section['var_code'], ['ndt_structure_3', 'ndt_structure_1', 'ndt_structure_2', 'ndt_structure_7']) ){
            	$ndt_type           = explode("_", $section['var_code']);
              $ndt_type           = end($ndt_type);
              $this->ndt_jacket_all('save', $second_level, $ndt_type, $sftp);
            } elseif(in_array($section['var_code'], ['ndt_dossier_19_3', 'ndt_dossier_19_1', 'ndt_dossier_19_2', 'ndt_dossier_19_7','ndt_dossier_22_3', 'ndt_dossier_22_1', 'ndt_dossier_22_2', 'ndt_dossier_22_7','ndt_dossier_29_3', 'ndt_dossier_29_1', 'ndt_dossier_29_2', 'ndt_dossier_29_7',]) ){
            	$ndt_type           = explode("_", $section['var_code']);
              $ndt_type           = end($ndt_type);
              $this->ndt_jacket('save', $second_level, $ndt_type, $sftp);
            } elseif(in_array($section['var_code'], ['additional_att_223', 'additional_att_231', 'additional_att_221', 'additional_att_224', 'additional_att_234', 'additional_att_233', 'additional_att_229', 'additional_att_230', 'additional_att_227', 'additional_att_232', 'additional_att_222'])) {
              $id_type_att        = explode("_", $section['var_code']);
              $id_type_att        = end($id_type_att);
              $this->additional_attachment(NULL, 'save', $second_level, $id_type_att, $sftp);
            } elseif(in_array($section['var_code'], ['additional_att_225', 'additional_att_226', 'additional_att_228'])) {
              $this->dimension_dossier(NULL, 'save', $second_level, $sftp);
            } elseif(in_array($section['var_code'], ['additional_att_225', 'additional_att_226', 'additional_att_228'])) {
              $this->dimension_dossier(NULL, 'save', $second_level, $sftp, NULL);
            } elseif(in_array($section['var_code'], ['dimension_all'])) {
              $this->dimension_dossier(NULL, 'save', $second_level, $sftp, NULL);
            } elseif(in_array($section['var_code'], ['irn_structure'])) {
							$this->irn_jacket_all('save', $second_level);
            } elseif(in_array($section['var_code'], ['irn_dossier_19', 'irn_dossier_22', 'irn_dossier_29'])) {
							$this->irn_jacket('save', $second_level);
            } 

            // for third level
            foreach ($mdb_general_subsection_list[$volume['volume']][$section['section']] as $key_subsec => $value_subsec) {
            	$third                 = $section['volume'].'.'.$section['section'].' '.$value_subsec['subsection'].' '.$value_subsec['document_description'];
	            $third_level           = $second_level.'/'.$third;
	            $third_level_ori       = $second_level_ori.'/'.$third;

	            @mkdir($third_level, $permission, $recursive);

            	if(
	            	in_array($value_subsec['var_code'], [
		            	'shopdrawing_dossier_GA_6',
		            	'shopdrawing_dossier_GA_29',
		            	'shopdrawing_dossier_GA_19',
		            	'shopdrawing_dossier_GA_34',
		            	'shopdrawing_dossier_GA_46',
		            	'shopdrawing_dossier_GA_12',
		            	'shopdrawing_dossier_GA_13',
		            	'shopdrawing_dossier_WM_6',
		            	'shopdrawing_dossier_WM_29',
		            	'shopdrawing_dossier_WM_19',
		            	'shopdrawing_dossier_WM_34',
		            	'shopdrawing_dossier_WM_46', 
		            	'shopdrawing_dossier_WM_12',
		            	'shopdrawing_dossier_WM_13',
		            	'shopdrawing_dossier_WM_26_10', 
		            	'shopdrawing_dossier_WM_22_27',
		            	'shopdrawing_dossier_GA_26_10',
		            	'shopdrawing_dossier_GA_22_27',
	            	])
	            ){
	            	$dr_type            = explode("_", $value_subsec['var_code']);
	              $dr_type            = $dr_type[2];
	              
	              $this->shopdrawing_dossier_jacket('save', $third_level, $dr_type, $sftp);
	            }
            	$params['link_'.$value_subsec['var_code']] = $third_level_ori;
            }

            $params['link_'.$section['var_code']] = $second_level_ori;
          }
        }
      }

      $list_ecodoc_no                   = array_filter(array_unique($this->ecodoc_no_list));
	    if($list_ecodoc_no) {
	      $where[implode_where("client_doc_no", $list_ecodoc_no)] = null;
	      $where['mrd.attachment IS NOT NULL']  = null;
	      $datadb                           = $this->mdb_mod->mdr_document_list($where);
	      unset($where);

	      $duplicate_check                  = [];
	      foreach($datadb as $value) {
	        if(!in_array($value['id_document'], $duplicate_check)) {
	          $mdr_list[]                   = $value;
	        }
	        $duplicate_check[]              = $value['id_document'];
	      }

	      foreach($mdr_list as $value) {
	        $ext              = pathinfo($value['attachment'], PATHINFO_EXTENSION);
	        $local_file       = $ecodoc_loc."/".$value['client_doc_no'].'.'.$ext;
	        $remote_file      = "/PCMS/pcms_ori/upload/production_design/file/".$value["attachment"];
	        $sftp->get($remote_file, $local_file);

	        $this->ecodoc_no_list[$value['client_doc_no']]  = '../ECODOC/'.$value['client_doc_no'].'.'.$ext;
	      }
	    }

      $params['offline']              = true;
      $params['index_loc']            = $deck_loc;
      $this->mdb_jacket_new($params);
    // }

    test_var("DONE!");
    return;

    $zip      = new ZipArchive();
    $filename = "myzipfile.zip";

    if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
      exit("cannot open <$filename>\n");
    }
    $temp_folder  = 'file/download_mdb/'.$user_id;
    $filename     = "MDB JACKET.zip";
    $loc_zip      = "file/temp_download/".$user_id."/".$filename;
    zipData($temp_folder, $loc_zip);
    // delete_recursive($temp_folder);

    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=$filename"); 
    header('Content-length: '.filesize($loc_zip));
    flush();
    readfile("$loc_zip");
    // unlink($loc_zip);
  }

public function wtr_html($uniq_id = null, $offline_loc = null){

		$uniq_id = $this->encryption->decrypt(strtr($uniq_id, '.-~', '+=/')); 

		$data["show_att"] = 1;

		// -------------------------------------------------------------------------------------------------------------------------------- Library // 
		$data['attachment'] = $this->visual_mod->pcms_attachment_history(["uniq_id" => $uniq_id]);


		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['mod_id']] = $value;
			$data['module_code'][$value['mod_id']] = $value['mod_desc'];
			$data['mod_desc'][$value['mod_id']]         = $value['mod_desc'];
		}
		$data['module_list'] = $module_list;
 
 
		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
			$data['type_of_module_code'][$value['id']] = $value['code'];
			$data['type_of_module_name'][$value['id']] = $value['name'];
			$data['module_type'][$value['id']]          = $value['name'];
		}
		$data['type_of_module_list'] = $type_of_module_list;
 

		$datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['initial']] = $value;
			$data['discipline_code'][$value['id']] = $value['initial'];
			$data['discipline_name'][$value['id']] = $value['discipline_name'];
		}
		$data['discipline_list'] = $discipline_list;  

		$datadb = $this->general_mod->class(); 
		$class_list = []; 
		foreach ($datadb as $key => $value) { 
			$class_list[$value['id']] = $value['class_code']; 
		} 
		$data['class_list'] = $class_list;	 
		$data['list_of_class'] = $datadb; 
 
		$material_grade_list      = $this->general_mod->material_grade();
		foreach ($material_grade_list as $value) {
		  $data['grade'][$value['id']]                = $value['material_grade'];
		  $data["material_grade"][$value['id']] = $value;
		}   
  
		$datadb = $this->general_mod->fitter_list();
		foreach ($datadb as $key => $value) {
			$data['fitter_code_arr'][$value['id_fitter']] = $value['fit_up_badge'];
			$master_fitter[$value['id_fitter']] = $value;
		}
		$data['master_fitter'] = $master_fitter; 

		$datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['project_code']] = $value;
			$data['project_code'][$value['id']]   = $value['project_code'];
			$data['project_name'][$value['id']]   = $value['project_name'];  
			$data['project_client'][$value['id']] = $value['client'];
			$data['project_client_logo'][$value['id']] = $value['client_logo'];
			$data['project_client_description'][$value['id']] = $value['description'];
			$data['project_desc'][$value['id']] = $value['description'];
			$data['project_logo'][$value['id']] = $value['project_logo'];
			$data['client_logo'][$value['id']]  = $value['client_logo'];
			$data['client'][$value['id']]       = $value['client'];
		}
		$data['project_list'] = $project_list;
 
		$joint_type_list = $this->general_mod->weld_type();
		foreach($joint_type_list as $value) {
			$data['joint_type'][$value['id']]	= $value['weld_type_code'];
		} 

		$datadb = $this->general_mod->weld_type();
		foreach ($datadb as $key => $value) {
			$master_weld_type[$value['id']] = $value;
		}
		$data['master_weld_type'] = $master_weld_type;

		$datadb = $this->fitup_mod->wps_code_version_report();
		foreach ($datadb as $key => $value) {
			$data['wps_code_arr'][$value['id_wps']] = $value['wps_no'];
		}

		$datadb = $this->fitup_mod->welder_code_version_view_only();
		foreach ($datadb as $key => $value) {
			$master_welder[$value['id_welder']] = $value;
		}
		$data['master_welder'] = $master_welder; 

		$company_list             = $this->general_mod->company();
		foreach($company_list as $value) {
		  $data['company_name'][$value['id_company']] = $value['company_name'];
		}
    
		$datadb = $this->wtr_mod->area_name();
		foreach ($datadb as $key => $value) {
			$area_name_list[$value['area_name']] = $value;
			$data['area_name_arr'][$value['id']] = $value['area_name'];
		}
		$data['area_name_list'] = $area_name_list;

		$datadb = $this->planning_mod->master_area_v2();
		foreach ($datadb as $key => $value) {
			$area_name_list_v2[$value['id']] = $value;
			$data['area_name_arr_v2'][$value['id']] = $value['name'];
		}
		$data['area_name_list_v2'] = $area_name_list_v2;

		$datadb = $this->planning_mod->master_location_v2();
		foreach ($datadb as $key => $value) {
			$location_name_list_v2[$value['id']] = $value;
			$data['location_name_arr_v2'][$value['id']] = $value['name'];
		}
		$data['location_name_list_v2'] = $location_name_list_v2; 

		// ---------------------------------------------------------------------------------------------------------- Library //
		
		 
		$where['b.uniq_id'] = $uniq_id;
		$where['b.status_deleted'] = 1;
		$data["show_pcms_irn"]    = $this->wtr_mod->mwtr_data_list($where);
		unset($where);

		if(sizeof($data["show_pcms_irn"]) <= 0){
			redirect(base_url()."Wtr/wtr_list/".strtr($this->encryption->encrypt(2), '+=/', '.-~'));
		}

		if(isset($data["show_pcms_irn"][0]['smoe_approval_by'])){

		$array_user = array($data["show_pcms_irn"][0]['client_approval_by'],$data["show_pcms_irn"][0]['smoe_approval_by']);
		$id_user_all = array_unique(array_filter(array_merge($array_user)));  
		$where_user["id_user IN ('".implode("', '", $id_user_all)."')"] = NULL;   
		$datadb  = $this->general_mod->portal_user_db_list($where_user);  
		foreach ($datadb as $value) {  
			$user_list[$value['id_user']] = $value['full_name'];  
			$data["user_list"][$value['id_user']] = $value['full_name'];  
			$data['user'][$value['id_user']] = $value;  
			$data["sign_approval"][$value['id_user']] = $value['sign_approval'];
		}  
		unset($where_user);  

		}
 
		//-------------- IRN FORM DETAIL -----------------//
		 
		$where['g.uniq_id'] = $uniq_id; 
		$where['g.status_deleted_wtr_sign'] = 1; 
		$result =  $this->wtr_mod->show_data_irn_joint_mwtr_data($where); 
		unset($where);   

		$id_joint     = array_column($result, 'id'); 
		$where["a.joint_id IN ('".implode("', '", $id_joint)."')"] = NULL; 
		$where["a.result IN (0,2,3) "]   	= null;
		$ndt = $this->wtr_mod->ndt_list_data_m($where); 
		foreach ($ndt as $key => $value) {
			$data['ndt_wtr'][$value['id_joint_visual']][$value['ndt_type']] = $value;  			
			$data['ndt_all_wtr'][$value['id_joint_visual']][$value['ndt_type']][] = $value;  
		$data['ndt'][$value['id_joint_visual']][$value['ndt_type']] = $value;  			
		$data['ndt_all'][$value['id_joint_visual']][$value['ndt_type']][] = $value; 			
		$data['ndt_all_2'][$value['id_joint_visual']][$value['ndt_type']][$value["revision_category"]][$value["revision"]][] = $value; 			
		}
		unset($where); 
  

		$data["show_data_irn_list"] = $result;
		$populated_drawing = array();
		foreach ($result as $key => $value){
			$populated_drawing[] = array(
				"drawing_no" 	 => $value['drawing_no'],
				"project" 		 => $value['project'],
				"discipline" 	 => $value['discipline'],
				"module" 		 => $value['module'],
				"type_of_module" => $value['type_of_module'],
				"deck_elevation" => $value['deck_elevation'],
			);
		}
		$drawing_no_filter = array_map("unserialize", array_unique(array_map("serialize", $populated_drawing))); 
		 

		$data["show_data_irn_list_filter"] = array($drawing_no_filter[0]);  

		//---------------- WTR DATABASE ------------// 
 
			$id_joint   	 = array_column($result, 'id'); 
			$document_unique = array_unique($id_joint); 
			$where["a.id IN ('".implode("', '", $document_unique)."')"] = NULL; 
			$where["f.status_deleted"] = 1; 
			$data['wtr_list']  = $this->wtr_mod->wtr_all_of_joint_list($where);	
			unset($where);  

			$data['joint_list'] = $data['wtr_list'];
		
			$piecemark_list_submit_1 = array(); 
			$piecemark_list_submit_2 = array(); 
			foreach ($data['joint_list'] as $key => $value) { 
				$piecemark_list_submit_1[] =  $value['pos_1']; 
				$piecemark_list_submit_2[] =  $value['pos_2']; 
			}		 
			$list_of_pc = array_merge($piecemark_list_submit_1,$piecemark_list_submit_2); 
			$list_of_pc = array_unique($list_of_pc);   
			$wherex["part_id IN ('".implode("', '", $list_of_pc)."')"] = NULL; 
			$wherex["a.status_delete <> 0"] 	= null;  
			$wherex["a.ref_pos_1 <> ''"] 	= null;  
			$wherex["a.ref_pos_1 IS NOT NULL"] 	= null;  
			$datadb  = $this->fitup_mod->template_piecemark_list($wherex);  
			unset($wherex);   
			$array_group = array(); 
			foreach ($datadb as $key => $value) { 
					$push[$key] = explode(", ",$value['ref_pos_1']);  
					if(sizeof($push[$key]) > 0){ 
							foreach($push[$key] as $vals){ 
								array_push($array_group,$vals); 
							} 
					} 
		
					$data['status_piecemark_ref'][$value['part_id']] = $value;  
			}   
 
			if(sizeof($array_group) > 0){ 
				$wherex["a.id IN ('".implode("', '", $array_group)."') OR a.part_id IN ('".implode("', '", $list_of_pc)."')"] = NULL;  
			} else { 
				$wherex["a.part_id IN ('".implode("', '", $list_of_pc)."')"] = NULL;  
			} 
			$wherex["b.status_delete"] 	= 0; 
			$wherex["b.status_inspection <> 12"] 	= null;    
			$datadb  = $this->fitup_mod->piecemark_list($wherex);  
			foreach ($datadb as $key => $value) { 
				$data['status_piecemark'][$value['part_id']] = $value; 
				$data['status_piecemark_ref_1'][$value['id']] = $value; 
			} 
			unset($where); 
			unset($wherex); 

			if(sizeof(array_filter(array_column($datadb, 'id_mis'))) > 0){

				$id_mis     = array_filter(array_column($datadb, 'id_mis'));  
				$where["id_mis_det IN ('".implode("', '", $id_mis)."')"] = NULL; 
				$datadb = $this->fitup_mod->warehouse_mis_mrir($where);
				unset($where); 
				foreach ($datadb as $key => $value) {
					$data['warehouse_mis_mrir'][$value['id_mis_det']] = $value;
				}

			} 
 
			$where['project_id']   	 = $result[0]['project'];
			$drawing_nox   	= array_column($data['wtr_list'], 'drawing_no'); 
			$drawing_no_wmx  = array_column($data['wtr_list'], 'drawing_wm'); 
			$document_merge = array_unique(array_merge($drawing_nox,$drawing_no_wmx));
			$where["document_no IN ('".implode("', '", $document_merge)."')"] = NULL;   
			$where["status_delete"] = 1;   
			$datadb = $this->wtr_mod->data_drawing_list($where);
			unset($where);
			if (sizeof($datadb) > 0) {
				foreach ($datadb as $key => $value) {
					$drawing_detail[$value['project_id']][$value['document_no']] = $value;
					$data['activity_eng'][$value['document_no']] = $value;
				}
				$data['drawing_detail'] = $drawing_detail;			
			} else {
				$data['drawing_detail'] = NULL;
			}
  

			$list_report_number     = $this->general_mod->report_no();
			foreach($list_report_number as $value) {
			$data['report_no_mv'][$value['project']][$value['discipline']][$value['type_of_module']][$value['category']]	= $value['report_no'];
			$data['report_no_fu'][$value['project']][$value['discipline']][$value['type_of_module']][$value['category']] 	= $value['report_no'];
			$data['report_no_vs'][$value['project']][$value['discipline']][$value['type_of_module']][$value['category']] 	= $value['report_no'];
			$data['report_no_irn'][$value['project']][$value['discipline']][$value['type_of_module']][$value['category']] 	= $value['report_no'];
			}

		//---------------- WTR DATABASE ------------//
			
		// $data['meta_title'] 	 = "PCMS - MWTR";			
		// $data['for_mwtr_signed'] 	 = true;			
		// $html = $this->load->view('irn/irn_pdf_joint_landscape',$data);	 


    $html_name                   = $offline_loc.'/'.$data["show_pcms_irn"][0]['drawing_no'].'.html';
    $myfile                       = fopen($html_name, "w");
    $view                         = $this->load->view('irn/irn_pdf_joint_landscape', $data, true);
    fwrite($myfile, $view);
			 
	}


}