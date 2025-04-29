<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdb extends CI_Controller {

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

		$this->ftp  = ftp_config_syn();
		
	}

	public function index(){
		$data['deck_elevation'] = $this->mdb_mod->deck_elevation(["id IN (5,6,7,8,9,10)" => NULL]);

	  $data['meta_title']           = 'MDB List';
		$data['subview']              = 'mdb/dashboard';
		$data['sidebar']              = $this->sidebar;
		$this->load->view('index', $data);
	}

	public function mdb_deck_new($id = 5){
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

    $this->load->view($data['subview'], $data);
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

   public function ht_dossier($deck){
    $where["b.project"]                   = 12;
    $where["b.discipline != '1'"]         = NULL;
    $where["c.company_id != 13"]          = NULL;
    $where["b.deck_elevation"]            = $deck;
    $where["a.type_of_report"]            = 0;
    $where["a.report_number IS NOT NULL"] = null; 
    $where["b.status_delete"]             = 1;  
    
    $datadb  = $this->mdb_mod->ht_dossier($where);
    foreach ($datadb as $key => $value) {
      $enc_redline = strtr($this->encryption->encrypt($value['attachment_file']), '+=/', '.-~'); 
      $enc_path   = strtr($this->encryption->encrypt('/PCMS/pcms_v2/additional_attachment/'), '+=/', '.-~'); 

      $output[$value['type_of_module']][] = [
        "discipline"      => $value['discipline'],
        "company_id"      => $value['company_id'],
        "report_number"   => $value['report_number'],
        "ecodoc_no"   => $value['ecodoc_no'],
        "book_volume"   => $value['book_volume'],
        "link_ecodoc"   => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
        "link"            => site_url('irn/open_file/'.$enc_redline.'/'.$enc_path),
      ];
    }
    return $output;
  }

	public function dimension_dossier($deck = NULL){

		$list_drawing                     = $this->drawing_jacket();
    $list_drawing                     = $list_drawing['all'];
    $arr_list_drawing                 = array_column($list_drawing, 'document_no');
		
		$where[implode_where("a.drawing_no", $arr_list_drawing)] = null;
    $where["a.project_id"]                        = 12;
    $where["a.discipline != '1'"]                 = NULL;
    $where["a.requestor_company ILIKE '%SMOE%' "] = NULL;
    if($deck){
    	$where["a.deck_elevation"]                    = $deck;
    }
    $where['a.type_of_report']                    = 1;
    $where['b.report_number IS NOT NULL']         = NULL;
    $datadb = $this->dimension_mod->data_dc($where);
    // test_var($where, 1);
    // test_var($datadb);
    
    foreach ($datadb as $key => $value) {
      $enc_id = strtr($this->encryption->encrypt($value['attachment']), '+=/', '.-~');
      $enc_redline = strtr($this->encryption->encrypt($value['attachment']), '+=/', '.-~'); 
      $enc_path   = strtr($this->encryption->encrypt('/PCMS/pcms_v2/additional_attachment/dimension_control/'), '+=/', '.-~'); 

      $id_cat             = $list_drawing[$value['drawing_no']]['desc_assy'];

      if($deck){
      	$output[$value['type_of_module']][] = [
	        "discipline"      => $value['discipline'],
	        "ecodoc_no"      => $value['ecodoc_no'],
	        "link_ecodoc"      => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
	        "book_volume"      => $value['book_volume'],
	        // "company_id"      => $value['company_id'],
	        "report_number"   => $value['report_number'],
	        "link"            => site_url('irn/open_file/'.$enc_redline.'/'.$enc_path),
	      ];
      } else {

      	if($id_cat==19){	
      		$id_cats = 225;
      	} elseif($id_cat==22){	
					$id_cats = 226;
				} elseif($id_cat==29){	
					$id_cats = 228;
				}
				
      	$output[$id_cats][] = [
      		"id_cats"				=> $id_cats,
	        "discipline"      => $value['discipline'],
	        "ecodoc_no"      => $value['ecodoc_no'],
	        "link_ecodoc"      => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
	        "book_volume"      => $value['book_volume'],
	        "report_number"   => $value['report_number'],
	        "link"            => site_url('irn/open_file/'.$enc_redline.'/'.$enc_path),
	      ];
      }
      
    }
    return $output ?? [];
  }

  public function irn_dossier($deck){

    $where["pcms_joint.project"] = 12;
    $where["pcms_joint.discipline != 1"] = NULL;
		$where["pcms_workpack.company_id != 13"] = NULL;
    $where["pcms_joint.deck_elevation"] = $deck;
		$where["pcms_irn.report_number IS NOT NULL"] = NULL;
		$datadb = $this->mdb_mod->irn_dossier($where);
		
		foreach ($datadb as $key => $value) {

      if($value['company_id'] == 13){
        $report_no = $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['irn_report_scm'].$value['report_number'];
      } else {
        $report_no = $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['irn_report'].$value['report_number'];
      }

			$enc_id = strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~');
			$output[$value['type_of_module']][] = [
        "discipline"      => $value['discipline'],
        "company_id"      => $value['company_id'],
        "report_number"   => $report_no,
        "ecodoc_no"       => $value['ecodoc_no'],
				"book_volume" 	  => $value['book_volume'],
        'link_ecodoc'     => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
				"link"				=> site_url('irn/show_irn_detail/').$enc_id,
			];
		}
		return $output;
	}

	public function ndt_dossier($deck){
		$where["pcms_joint.project"] = 12;
    $where["pcms_joint.discipline != 1"] = NULL;
		$where["pcms_joint.deck_elevation"] = $deck;
    $where["pcms_workpack.company_id != 13"] = NULL;
    $where["pcms_ndt.report_number IS NOT NULL"] = NULL;
		$datadb = $this->mdb_mod->ndt_dossier($where);
		foreach ($datadb as $key => $value) {
			$output[$value['type_of_module']][$value['ndt_type']][] = [
        "discipline"      => $value['discipline'],
        "company_id"      => $value['company_id'],
        "report_number"   => $value['report_number'],
        "book_volume"   => $value['book_volume'],
				"ecodoc_no" 	=> $value['ecodoc_no'],
        'link_ecodoc'           => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
				"link"				    => site_url('ndt/open_atc/').$value["filename"].'/'.$value["filename"],
			];
		}
		return $output;
	}

	public function visual_dossier($deck){
    $where["pcms_visual.project_code"] = 12;
    $where["pcms_visual.status_inspection != 12"] = NULL;
    $where["pcms_visual.report_number IS NOT NULL"] = NULL;
		$where["pcms_visual.discipline != 1"] = NULL;
    $where["pcms_workpack.company_id != 13"] = NULL;
		$where["pcms_joint.deck_elevation"] = $deck;
		$datadb = $this->mdb_mod->visual_dossier($where);

		foreach ($datadb as $key => $value) { 

      if($value['company_id'] == 13){
        $report_no = $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['visual_report_13'].$value['report_number'];
      } else {
        $report_no = $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['visual_report'].$value['report_number'];
      }

			$output[$value['type_of_module']][] = [
        "company_id"      => $value['company_id'],        
        "discipline"      => $value['discipline'],
				"report_number"   => $report_no,
				"ecodoc_no"       => $value['ecodoc_no'],
				"book_volume"     => $value['book_volume'],
        'link_ecodoc'     => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
				"link"			      => site_url('visual/visual_pdf/'.$value['report_number']).'/client/'.$value['drawing_no'].'/'.$value['postpone_reoffer_no'],
			];
		}
		return $output;
	}

	public function shopdrawing_dossier($deck){
		$output = [];

		$where["project_id"] = 12;
		$where["status_delete"] = 1;
		$where["deck_elevation"] = $deck;
		$where["type_of_module"] = 1;
		$where["discipline !="] = 1;
		$where["drawing_type in (1, 2, 9, 14)"] = NULL;
		$datadb = $this->mdb_mod->shopdrawing_dossier($where);
		// test_var($datadb);
		foreach ($datadb as $key => $value) {
			$drawing_type = "GA";
			if(in_array($value['drawing_type'], [9, 14])){
				$drawing_type = "WM";
			}
			// if(@count($output[$value['discipline']][$value['type_of_module']][$drawing_type]) > 20){
			// 	continue;
			// }
			$output[$drawing_type][] = [
				"report_number" => $value['document_no'],
				"ecodoc_no"  => $value['client_doc_no'],
				"link_ecodoc"  => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['client_doc_no']), '+=/', '.-~'),
				"book_volume"  => $value['book_volume'],
				"link"  => base_url_ftp_eng()."public_smoe/open_atc/2/".strtr($this->encryption->encrypt($value['id']), '+=/', '.-~'),
			];
		}
		// test_var($output);
		return $output;
	}

	public function shopdrawing_dossier_jacket(){
		$output = [];

		$where["project_id"] = 12;
		$where["status_delete"] = 1;
		$where["type_of_module"] = 2;
		$where["discipline !="] = 1;
		$where["drawing_type in (1, 2, 9, 14)"] = NULL;
		$datadb = $this->mdb_mod->shopdrawing_dossier($where);
		// test_var($datadb);
		foreach ($datadb as $key => $value) {
			$drawing_type = "GA";
			if(in_array($value['drawing_type'], [9, 14])){
				$drawing_type = "WM";
			}
			// if(@count($output[$value['discipline']][$value['type_of_module']][$drawing_type]) > 20){
			// 	continue;
			// }
			$output[$drawing_type][$value['desc_assy']][] = [
				"report_number" => $value['document_no'],
				"ecodoc_no"  => $value['client_doc_no'],
				"link_ecodoc"  => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['client_doc_no']), '+=/', '.-~'),
				"book_volume"  => $value['book_volume'],
				"link"  => base_url_ftp_eng()."public_smoe/open_atc/2/".strtr($this->encryption->encrypt($value['id']), '+=/', '.-~'),
			];
		}
		// test_var($output);
		return $output;
	}

  public function mv_dossier_deck($deck, $action = "view") {
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

        // if(@count($output) > 20) {
        //   continue;
        // }

        $rep_cat           = "mv_no";

        $output[] = [
          "report_number" => $this->report[$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']][$rep_cat].'-'.$value['report_number'],
          "ecodoc_no"       => $value['ecodoc_no'],
          'link_ecodoc'                 => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".encrypt($value['ecodoc_no']),
          "book_volume"     => $value['book_volume'],

          "link"			    => site_url('material_verification/material_verification_pdf_client/'.encrypt($value['project_code']).'/'.encrypt($value['discipline']).'/'.encrypt($value['type_of_module']).'/'.encrypt($value['module']).'/'.encrypt($value['report_number']).'/'.encrypt($value['report_no_rev']).'/'.encrypt($value['drawing_no'])),
          'deck_elevation' => $value['deck_elevation']
        ];        
        
        if($action == "save") {

          $file_loc                   = 'file/download_mdb/'.$this->user_cookie[0].'/MDB/MDB INDEX B/'.$datadb[0]['name'].'/1. TOPSIDE FABRICATION/B. STRUCTURE FABRICATION DOSSIER/B.1 Material Verification Report';
          $file_loc                   = encrypt($file_loc);

          $this->mv_pdf(encrypt($value['project_code']),encrypt($value['discipline']),encrypt($value['type_of_module']),encrypt($value['module']),encrypt($value['report_number']),encrypt($value['report_no_rev']),encrypt($value['drawing_no']), $file_loc);
        }
      }
    }

    return $output;

  }

  public function additional_attachment($deck = null) {

    if($deck) {
      $where['deck_elevation']          = intval($deck);
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
        'report_number'                   => $value['original_name'],
        'ecodoc_no'                   => $value['ecodoc_no'],
        'link_ecodoc'                 => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".encrypt($value['ecodoc_no']),
        'book_volume'                 => $value['book_volume'],
        'link'                        => $link_file               
      ];
    }

    return $output;
    
  }

  public function offline($deck = NULL) {

    // INDEX B BY DECK

    $user_id                        = $this->user_cookie[0];

    $permission                     = 0777;
    $recursive                      = true;

    if(!$deck){
      $where["id IN (5,6,7,8,9,10)"]  = null;
    } else {
      $where["id"]  = $deck;
    }
    $deck_list                      = $this->general_mod->deck_elevation($where);
    unset($where);

    $this->mv_dossier_deck($value['id'], 'save');

  }


  public function mv_pdf($project_id, $discipline, $type_of_module, $module,  $report_no = null, $report_no_rev = null, $drawing_no = null, $file_loc = null) {
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
    $this->load->library('Pdfgenerator_download');

    $file_name                = $file_name.'.pdf';

		$this->pdfgenerator_download->generate($html,$file_name,$app_nos, $file_loc, "potrait");

  }

  public function fitup_dossier($deck){
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
 
 
		foreach ($datadb as $key => $value) {

      $button                = site_url('fitup/pdf_files/'.strtr($this->encryption->encrypt($value['project']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['discipline']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['module']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['type_of_module']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['report_number']),'+=/', '.-~')).'/'.strtr($this->encryption->encrypt($value['company_id']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['company_id']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['company_id']),'+=/', '.-~');

      if($value['company_id'] == 13){
        $report_no = $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['fitup_report_scm'].$value['report_number'];
      } else {
        $report_no = $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['fitup_report'].$value['report_number'];
      }
			$output[] = [
        "report_number"       => $report_no,         
				"ecodoc_no"           => $value['ecodoc_no'],
        "deck_elevation"      => $value['deck_elevation'],
				"book_volume"      => $value['book_volume'],
        'link_ecodoc'           => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
				"link"			          => $button, 
			];
		}
		return $output;
	}

	public function mdb_general($mode = 'online'){
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
			$value['link_ecodoc'] = base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~');
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

		$data['assets'] = [
			"favicon" => base_url().'img/favicon.png',
			"css" => [
				base_url().'assets/fontawesome-free/css/all.min.css',
			],
			"js" => [
				base_url().'assets/jquery/jquery-3.4.1.min.js',
			],
		];

    $data['meta_title']         = 'MDB GENERAL – GENERAL FABRICATION PROCEDURE';
    $data['subview']            = 'mdb/mdb_general';
    // $data['sidebar']            = $this->sidebar;

		if($mode == 'online'){
			$this->load->view($data['subview'], $data);
		}
		elseif($mode == 'offline'){
			$this->mdb_general_offline($data);
		}
		else{
			return false;
		}
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


          $key_data                     = $value['mill_cert_no'].'_'.$cat_name;

          if(in_array($key_data, $temp)) {
            continue;
          }

					$row = [
						"attachment" => $certificate[$value['receiving_id']][$value['mill_cert_no']]['attachment_name'],
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

	public function mdb_jacket_new(){
		$ecodoc_no_arr = [];

		$datadb = $this->additional_attachment_mod->master_mdb_general_list([
			"category" => 'MDB JACKET',
		], [
			"volume" => "ASC",
			"section::int" => "ASC",
			"subsection::int" => "ASC",
		]);

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

		$datadb 	= $this->dimension_dossier(NULL);
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

		$data['file_list']['fitup_structure']  = $this->fitup_jacket_all();
		$data['file_list']['visual_structure'] = $this->visual_jacket_all();
		$data['file_list']['irn_structure']    = $this->irn_jacket_all();
		$data['file_list']['mv_structure']     = $this->mv_jacket_all();
		$data['file_list']['wtr_structure']    =  $this->wtr_jacket_all();

		// test_var($data['file_list']);
    // $data['file_list'] = array_merge($data['file_list'] ?? [], $this->material_certificate());

    $data['meta_title']         = 'MDB INDEX B (SPECIFIC) JACKET';
    $data['subview']            = 'mdb/mdb_jacket_new';
    // $data['sidebar']            = $this->sidebar;

    $this->load->view($data['subview'], $data);
	}

  public function mdb_jacket() {
		$data['shopdrawing_dossier'] 	= $this->shopdrawing_dossier_jacket();
    
    // BY DRAWING CATEGORY
      $data['fitup_dossier']  = $this->fitup_jacket();
      $data['visual_dossier'] = $this->visual_jacket();
      $data['ndt_dossier']    = $this->ndt_jacket();
      $data['irn_dossier']    = $this->irn_jacket();
      $data['mv_dossier']     = $this->mv_jacket();
      $data['wtr_dossier']    =  $this->wtr_jacket();

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

  public function fitup_jacket_all(){
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
        "company_id"      => $value['company_id'],        
        "discipline"      => $value['discipline'],
        "report_number"   => $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['fitup_report'.($value['company_id']==13 ? '_scm' : '')].$value['report_number'],
        "link"            => $link,
        'link_ecodoc'           => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
        "ecodoc_no"       => $value['ecodoc_no'],
        "book_volume"       => $value['book_volume'],
      ];
    }
    return $output;
  }

  public function fitup_jacket(){
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
    $where[implode_where("pcms_joint.drawing_no", $arr_list_drawing)] = null;
    $datadb = $this->mdb_mod->fitup_dossier($where);

    foreach ($datadb as $key => $value) {
      
      $id_cat = $list_drawing[$value['drawing_no']]['desc_assy'];
      
      $link   = site_url('fitup/pdf_files/'.strtr($this->encryption->encrypt($value['project']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['discipline']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['module']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['type_of_module']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['report_number']),'+=/', '.-~')).'/'.strtr($this->encryption->encrypt($value['company_id']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['company_id']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['company_id']),'+=/', '.-~');

      $output[$id_cat][] = [
        "company_id"      => $value['company_id'],        
        "discipline"      => $value['discipline'],
        "report_number"   => $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['fitup_report'.($value['company_id']==13 ? '_scm' : '')].$value['report_number'],
        "link"            => $link,
        'link_ecodoc'           => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
        "ecodoc_no"       => $value['ecodoc_no'],
        "book_volume"       => $value['book_volume'],
      ];
    }
    return $output;
  }

  public function mv_jacket_all(){

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
          "report_number" => $this->report[$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']][$rep_cat].'-'.$value['report_number'],
          "ecodoc_no"     => $value['ecodoc_no'],
          'link_ecodoc'                 => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".encrypt($value['ecodoc_no']),
          "book_volume"     => $value['book_volume'],

          "link"			    => site_url('material_verification/material_verification_pdf_client/'.encrypt($value['project_code']).'/'.encrypt($value['discipline']).'/'.encrypt($value['type_of_module']).'/'.encrypt($value['module']).'/'.encrypt($value['report_number']).'/'.encrypt($value['report_no_rev']).'/'.encrypt($value['drawing_no'])),
          'deck_elevation' => $value['deck_elevation']
        ];        
       
      }
    }

    return $output;
  }

  public function irn_jacket_all(){
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

      $enc_id = strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~');
      $output[] = [
        "discipline"      => $value['discipline'],
        "company_id"      => $value['company_id'],
        "report_number"   => $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['irn_report'.($value['company_id']==13 ? '_scm' : '')].$value['report_number'],
        "link"            => site_url('irn/show_irn_detail/').$enc_id,
        'link_ecodoc'           => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
        "ecodoc_no"       => $value['ecodoc_no'],
        "book_volume"       => $value['book_volume'],
      ];
    }
    return $output;
  }

  public function irn_jacket(){
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
      // test_var($this->report);
      $enc_id = strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~');
      $output[$id_cat][] = [
        "discipline"      => $value['discipline'],
        "company_id"      => $value['company_id'],
        "report_number"   => $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['irn_report'.($value['company_id']==13 ? '_scm' : '')].$value['report_number'],
        "link"            => site_url('irn/show_irn_detail/').$enc_id,
        'link_ecodoc'           => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
        "book_volume"       => $value['book_volume'],
        "ecodoc_no"       => $value['ecodoc_no'],
      ];
    }
    return $output;
  }

  public function ndt_jacket_all(){
    error_reporting(0);

    $list_drawing                     = $this->drawing_jacket();
    $list_drawing                     = $list_drawing['all'];
    $arr_list_drawing                 = array_column($list_drawing, 'document_no');

    $where["pcms_joint.drawing_no NOT IN ('".implode("', '", array_unique($arr_list_drawing))."')"] = null;
    $where["pcms_joint.project"] = 12;
    $where["pcms_joint.type_of_module"] = 2;
    $where["pcms_workpack.company_id != 13"] = NULL;
    $where["pcms_ndt.report_number IS NOT NULL"] = NULL;
    $datadb = $this->mdb_mod->ndt_dossier($where);
    foreach ($datadb as $key => $value) {
      $id_cat             = $list_drawing[$value['drawing_no']]['desc_assy'];

      $output[$value['ndt_type']][] = [
        "discipline"      => $value['discipline'],
        "company_id"      => $value['company_id'],
        "report_number"   => $value['report_number'],
        "link"            => site_url('ndt/open_atc/').$value["filename"].'/'.$value["filename"],
        "ecodoc_no"       => $value['ecodoc_no'],
        'link_ecodoc'           => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
        "book_volume"       => $value['book_volume'],
      ];
    }
    return $output;
  }

  public function ndt_jacket(){
    error_reporting(0);

    $list_drawing                     = $this->drawing_jacket();
    $list_drawing                     = $list_drawing['all'];
    $arr_list_drawing                 = array_column($list_drawing, 'document_no');

    $where[implode_where("pcms_joint.drawing_no", $arr_list_drawing)] = null;
    $where["pcms_joint.project"] = 12;
    $where["pcms_joint.type_of_module"] = 2;
    $where["pcms_workpack.company_id != 13"] = NULL;
    $where["pcms_ndt.report_number IS NOT NULL"] = NULL;
    $datadb = $this->mdb_mod->ndt_dossier($where);
    foreach ($datadb as $key => $value) {
      $id_cat             = $list_drawing[$value['drawing_no']]['desc_assy'];

      $output[$id_cat][$value['ndt_type']][] = [
        "discipline"      => $value['discipline'],
        "company_id"      => $value['company_id'],
        "report_number"   => $value['report_number'],
        "link"            => site_url('ndt/open_atc/').$value["filename"].'/'.$value["filename"],
        "ecodoc_no"       => $value['ecodoc_no'],
        'link_ecodoc'           => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
        "book_volume"       => $value['book_volume'],
      ];
    }
    return $output;
  }

  public function visual_jacket_all(){
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
    foreach ($datadb as $key => $value) {
      
      $id_cat             = $list_drawing[$value['drawing_no']]['desc_assy'];
      
      $output[] = [
        "company_id"      => $value['company_id'],        
        "discipline"      => $value['discipline'],
        "report_number"   => $this->report[$value['project']][$value['discipline']][$value['module']][$value['type_of_module']]['visual_report'.($value['company_id']==13 ? '_13' : '')].$value['report_number'],
        "link"            => site_url('visual/visual_pdf/'.$value['report_number']).'/client/'.$value['drawing_no'].'/'.$value['postpone_reoffer_no'],
        "ecodoc_no"       => $value['ecodoc_no'],
        'link_ecodoc'           => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
        "book_volume"       => $value['book_volume'],
      ];
    }
    return $output;
  }

  public function visual_jacket(){
    error_reporting(0);

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
    }
    return $output;
  }

  public function drawing_jacket() {

    // 19 = J-TUBE 22 = GROUTING 29 = MUDMATS
    $desc_assy_list                   = [19,22,29];
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
      $list[$value['desc_assy']][]      = $value['document_no'];
      $list_all[$value['document_no']]  = $value;
    }
    
    foreach($desc_assy_list as $value) {
      $output[$value]                 = @$list[$value];
    }
    $output["all"]                    = $list_all;

    return $output;
  }

  public function mv_jacket() {
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
          "report_number" => $this->report[$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']][$rep_cat].'-'.$value['report_number'],
          "ecodoc_no"     => $value['ecodoc_no'],
          'link_ecodoc'                 => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".encrypt($value['ecodoc_no']),
          "book_volume"     => $value['book_volume'],

          "link"			    => site_url('material_verification/material_verification_pdf_client/'.encrypt($value['project_code']).'/'.encrypt($value['discipline']).'/'.encrypt($value['type_of_module']).'/'.encrypt($value['module']).'/'.encrypt($value['report_number']).'/'.encrypt($value['report_no_rev']).'/'.encrypt($value['drawing_no'])),
          'deck_elevation' => $value['deck_elevation']
        ];        
       
      }
    }

    return $output;


  }

  public function wtr_dossier($deck) {
    $where['deck_elevation']        = $deck;
    // $where['status_deleted']        = 1;
    // $where['status_inspection']     = 7;
    $where['jt.project']           = 12;
    $where['jt.type_of_module']    = 1;
    $where['jt.discipline != 1']   = null;
    $datadb                         = $this->mdb_mod->wtr_dossier($where);
    // test_var($datadb);
    unset($where);  

    $output                         = [];
    foreach($datadb as $value) {
      $output[] = [
        'report_number'         => $value['drawing_no'],
        'ecodoc_no'             => $value['ecodoc_no'],
        'book_volume'           => $value['book_volume'],
        'link_ecodoc'           => base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($value['ecodoc_no']), '+=/', '.-~'),
        'link'                  => site_url('wtr/show_irn_detail_wtr_signed/'.encrypt($value['uniq_id']))
      ];
    }

    return $output;

  }

  public function wtr_jacket_all() {

    $list_drawing                     = $this->drawing_jacket();
    $list_drawing                     = $list_drawing['all'];
    $arr_list_drawing                 = array_column($list_drawing, 'document_no');
    $output                           = [];

    $where["jt.drawing_no NOT IN ('".implode("', '", array_unique($arr_list_drawing))."')"] = null;
    // $where['status_deleted']        = 1;
    // $where['status_inspection']     = 7;
    $where['jt.project']           = 12;
    $where['jt.type_of_module']    = 2;
    $where['jt.discipline != 1']   = null;
    $datadb                         = $this->mdb_mod->wtr_dossier($where);
    unset($where);  

    $output                         = [];
    foreach($datadb as $value) {

    	$project 				= encrypt($value['project']);
    	$drawing_no 		= encrypt($value['drawing_no']);
    	$drawing_type 	= encrypt($value['drawing_type']);
    	$discipline 		= encrypt($value['discipline']);
    	$module 				= encrypt($value['module']);
    	$type_of_module = encrypt($value['type_of_module']);

    	$link_wtr = site_url('wtr/wtr_list_detail/').$project.'/'.$drawing_no.'/'.$drawing_type.'/'.$discipline.'/'.$module.'/'.$type_of_module;

      $output[] = [
        'drawing_no'            => $value['drawing_no'],
        'report_number'            => $value['drawing_no'],
        'ecodoc_no'             => $value['ecodoc_no'],
        // 'link'                  => site_url('wtr/show_irn_detail_wtr_signed/'.encrypt($value['uniq_id'])),
        'link'                  => $link_wtr,
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

    $where[implode_where("jt.drawing_no", $arr_list_drawing)] = null;
    // $where['status_deleted']        = 1;
    // $where['status_inspection']     = 7;
    $where['jt.project']           = 12;
    $where['jt.type_of_module']    = 2;
    $where['jt.discipline != 1']   = null;
    $datadb                         = $this->mdb_mod->wtr_dossier($where);
    unset($where);  

    $output                         = [];
    foreach($datadb as $value) {

    	$project 				= encrypt($value['project']);
    	$drawing_no 		= encrypt($value['drawing_no']);
    	$drawing_type 	= encrypt($value['drawing_type']);
    	$discipline 		= encrypt($value['discipline']);
    	$module 				= encrypt($value['module']);
    	$type_of_module = encrypt($value['type_of_module']);

    	$link_wtr = site_url('wtr/wtr_list_detail/').$project.'/'.$drawing_no.'/'.$drawing_type.'/'.$discipline.'/'.$module.'/'.$type_of_module;
    	
      $id_cat                   = $list_drawing[$value['drawing_no']]['desc_assy'];

      $output[$id_cat][] = [
        'report_number'            => $value['drawing_no'],
      	
        'drawing_no'            => $value['drawing_no'],
        'ecodoc_no'             => $value['ecodoc_no'],
        // 'link'                  => site_url('wtr/show_irn_detail_wtr_signed/'.encrypt($value['uniq_id'])),
        'link'                  => $link_wtr,
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

	public function mdb_offline(){
		$data['meta_title']         = 'MDB Offline';
    $data['subview']            = 'mdb/mdb_offline';
    $data['sidebar']            = $this->sidebar;
    $this->load->view('index', $data);
	}

	public function mdb_offline_process(){
		$category = $this->input->post('category');
		if($category == 'mdb_assets'){
			redirect('mdb_offline/mdb_assets');
		}
		elseif($category == 'mdb_general'){
			redirect('mdb_offline/mdb_general/offline');
		}
		elseif($category == 'mdb_dashboard'){
			redirect('mdb_offline/mdb_dashboard_offline');
		}
		elseif($category == 'mdb_deck'){
			redirect('mdb_offline/offline');
		}
		elseif(strpos($category, 'mdb_deck_') !== false) {
			$id = explode("_", $category);
			$id = end($id);
			redirect('mdb_offline/offline/'.$id);
		}
		elseif(strpos($category, 'mdb_jacket') !== false) {
			redirect('mdb_offline/offline_jacket');
		}
	}

}