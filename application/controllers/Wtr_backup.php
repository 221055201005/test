<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wtr extends CI_Controller {

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

		$this->user_cookie 		  	= $data_cookies['data_user'];
		$this->permission_cookie  = $data_cookies['data_permission'];
    $this->sidebar 						= "wtr/sidebar";
	}

	public function index(){
		redirect('Wtr/wtr_overall_export');
	}

	public function wtr_overall_export(){
		$data['project_list']			=	$this->general_mod->project();
		$data['discipline_list']	= $this->general_mod->discipline();
		$data['type_of_module']		= $this->general_mod->type_of_module();
    $data['meta_title']   		= 'WTR Excel Export';
		$data['subview']      		= 'wtr/wtr_overall_export';
		$data['sidebar']      		= $this->sidebar;
		$this->load->view('index', $data);
  	}

  	public function wtr_piping_list(){

  		$list = $this->wtr_mod->wtr_piping_list();
  		$data['list'] = $list;

  		$data['modules'] = $this->wtr_mod->module_list();
  		foreach ($data['modules'] as $key => $value) {
  			$data['module_list'][$value['mod_id']] = $value;
  		}

  		$datadb = $this->wtr_mod->discipline_list();
  		foreach ($datadb as $key => $value) {
  			$data['discipline_list'][$value['id']] = $value;
  		}

  		$data['projects'] = $this->wtr_mod->project_list();
  		foreach ($data['projects'] as $key => $value) {
  			$data['project_list'][$value['id']] = $value;
  		}

  		$data['meta_title']   = 'WTR | Piping';
		$data['subview']      = 'wtr/wtr_piping_list';
		$data['sidebar']      = $this->sidebar;
		$this->load->view('index', $data);
  	}

  	public function wtr_piping_list_detail($drawing, $module, $discipline, $pdf = Null){
  		error_reporting(0);

  		$where_d['document_no'] = $drawing;
  		$data['drawing_detail'] = $this->wtr_mod->data_drawing_list($where_d)[0];

  		$data['projects'] = $this->wtr_mod->project_list();
  		foreach ($data['projects'] as $key => $value) {
  			$data['project_list'][$value['id']] = $value;
  		}

  		$data['modules'] = $this->wtr_mod->module_list();
  		foreach ($data['modules'] as $key => $value) {
  			$data['module_list'][$value['mod_id']] = $value;
  		}

  		$data['master_weld_type'] = $this->wtr_mod->master_weld_type();
  		foreach ($data['master_weld_type'] as $key => $value) {
  			$data['weld_type_desc'][$value['id']] = $value['weld_type'];
  		}

  		$where_visual['drawing_no']	= $drawing;
  		$where_visual['discipline']	= $discipline;
  		$where_visual['module']		= $module;
  		$visual = $this->wtr_mod->visual_list($where_visual);
  		foreach ($visual as $key => $value) {
  			$data['visual'][$value['id_joint']] = $value;
  		}

  		$where_fitup['drawing_no']	= $drawing;
  		$where_fitup['discipline']	= $discipline;
  		$where_fitup['module']		= $module;
  		$fitup = $this->wtr_mod->fitup_list($where_fitup);
  		foreach ($fitup as $key => $value) {
  			$data['fitup'][$value['id_joint']] = $value;
  		}
  			//test_var($data['fitup']);
  		$where_verif['drawing_no']	= $drawing;
  		$where_verif['discipline']	= $discipline;
  		$where_verif['module']		= $module;
  		$verif = $this->wtr_mod->verification_list($where_verif);
  		foreach ($verif as $key => $value) {
  			$data['verif'][$value['id_piecemark']] = $value;
  		}

  		$fitter = $this->wtr_mod->fitter_list($where_fitter);
  		foreach ($fitter as $key => $value) {
  			$data['fitter'][$value['id_fitter']] = $value;
  		}

  		$welder = $this->wtr_mod->welder_list($where_welder);
  		foreach ($welder as $key => $value) {
  			$data['welder'][$value['id_welder']] = $value;
  		}

  		$wps = $this->wtr_mod->master_wps($where_wps);
  		foreach ($wps as $key => $value) {
  			$data['wps'][$value['id_wps']] = $value;
  		}

  		$ndt = $this->wtr_mod->ndt_list($where_ndt);
  		foreach ($ndt as $key => $value) {
  			if($value['pwht_status']!=1){
  				$data['ndt'][$value['id_visual']][$value['ndt_type']] = $value;
  			} else {
  				$data['ndt_apwht'][$value['id_visual']][$value['ndt_type']] = $value;
  			}
  		}

  		//test_var($verif);

  		$where_pmark['drawing_ga']	= $drawing;
  		$where_pmark['discipline']	= $discipline;
  		$where_pmark['module']		= $module;
  		$pmark = $this->wtr_mod->piecemark_list($where_pmark);
  		foreach ($pmark as $key => $value) {
  			$data['pmark'][$value['part_id']] = $value;
  		}

  		//$where_mis['status_piping']	= 1;
  		$mis = $this->wtr_mod->mis_list($where_mis);
  		foreach ($mis as $key => $value) {
  			$data['mis'][$value['id_mis_det']] = $value;
  		}

  		$where_material["category != 'CM'"]	= NULL;
  		$material = $this->wtr_mod->material_list($where_material);
  		foreach ($material as $key => $value) {
  			$data['material'][$value['unique_ident_no']] = $value;
  		}

  		$material_pp = $this->wtr_mod->material_pp_list($where_material);
  		foreach ($material_pp as $key => $value) {
  			$data['material_pp'][$value['id']] = $value;
  		}

  		$material_grade = $this->wtr_mod->master_material_grade();
  		foreach ($material_grade as $key => $value) {
  			$data['material_grade'][$value['id']] = $value;
  		}

  		$where['drawing_no'] 	= $drawing;
  		$where['module'] 		= $module;
  		$where['discipline'] 	= $discipline;
  		$list = $this->wtr_mod->wtr_list($where);
  		$data['list'] = $list;

  		$where_r['a.drawing_no'] 	= $drawing;
  		$where_r['a.module'] 		= $module;
  		$where_r['a.discipline'] 	= $discipline;
  		$list_reject = $this->wtr_mod->wtr_list_reject($where_r);
  		$data['list_reject'] = $list_reject;
  		//test_var($data['list_reject']);

  		$data['drawing_no'] 	= $drawing;
  		$data['module'] 		= $module;
  		$data['discipline'] 	= $discipline;
		$data['meta_title']   = 'WTR | Piping';

		if($pdf=='pdf'){
			$this->load->library('pdf');
			$html = $this->load->view('wtr/wtr_piping_list_detail_pdf', $data, TRUE);
			$this->pdf->generate_pdf_landscape($html, 'WTR-Piping');
		} elseif($pdf=='xcl'){
			include APPPATH.'third_party/PHPExcel/PHPExcel.php';
			$objPHPExcel              = new PHPExcel();
			$row                      = $objPHPExcel->setActiveSheetIndex(0); 
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

			$style_array_left = array(
				'borders' => array(
					'allborders' 	=> array(
						'style' 		=> PHPExcel_Style_Border::BORDER_THIN
					)
				),
				'alignment' => array(
					'horizontal' 	=> PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
					'vertical' 		=> PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
				'font'  => array(
					'bold'  => true,
				)
			);
			
			$objPHPExcel->getActiveSheet()->getStyle('A7:A9')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('B7:B9')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('C7:C9')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('D7:D9')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('E7:E9')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('F7:F9')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('G7:G9')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('H7:H9')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('I7:I9')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('J7:J9')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('K7:K9')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('L7:L9')->applyFromArray($styleArray);
			for ($i = 'A'; $i !== 'BW'; $i++){
				$col = $i.'7:'.$i.'9';
				$objPHPExcel->getActiveSheet()->getStyle($col)->applyFromArray($styleArray);
			}

			unset($style_array_left);

			$row->setCellValue('A1', 'PROJECT NAME');
			$row->setCellValue('A2', 'CLIENT');
			$row->setCellValue('A3', 'MODULE');
			$row->setCellValue('A4', 'DRAWING NO');
			$row->setCellValue('A5', 'REV');
			$row->setCellValue('A6', 'DESCRIPTION');

			$row->setCellValue('C1', ':');
			$row->setCellValue('C2', ':');
			$row->setCellValue('C3', ':');
			$row->setCellValue('C4', ':');
			$row->setCellValue('C5', ':');
			$row->setCellValue('C6', ':');

			$row->setCellValue('D1', strtoupper($data['project_list'][$list[0]['project']]['project_name']));
			$row->setCellValue('D2', strtoupper($data['project_list'][$list[0]['project']]['client']));
			$row->setCellValue('D3', strtoupper($data['module_list'][$list[0]['module']]['mod_desc']));
			$row->setCellValue('D4', strtoupper($data['drawing_no']));
			$row->setCellValue('D5', strtoupper(str_pad($data['drawing_detail']['revision'],2,0,STR_PAD_LEFT)));
			$row->setCellValue('D6', strtoupper($data['drawing_detail']['title']));
			
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D1:BV1');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D2:BV2');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D3:BV3');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D4:BV4');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D5:BV5');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D6:BV6');

			$row->setCellValue('A7', 'S/N');
			
			$row->setCellValue('B7', 'Drawing GA/ASSY Number');

			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setVisible(false);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setVisible(false);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setVisible(false);

			$row->setCellValue('C7', 'Drawing / Weld Map No');
			$row->setCellValue('D7', 'Drawing Title');
			$row->setCellValue('E7', 'Rev No');
			$row->setCellValue('F7', 'Joint No');
			$row->setCellValue('G7', 'Joint Location');
			$row->setCellValue('H7', 'Type Of Weld');
			$row->setCellValue('I7', 'Spool No');
			$row->setCellValue('J7', 'Size (inch)');
			$row->setCellValue('K7', 'Thk (MM)');

			$row->setCellValue('L7', 'Material Traceability');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('L7:Y7');

			$row->setCellValue('L8', 'Part 1');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('L8:R8');

			$row->setCellValue('S8', 'Part 2');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('S8:Y8');

			$row->setCellValue('L9', 'Piecemark');
			$row->setCellValue('M9', 'Item Code');
			$row->setCellValue('N9', 'Mtr No.');
			$row->setCellValue('O9', 'Grade / Spec');
			$row->setCellValue('P9', 'Unique No');
			$row->setCellValue('Q9', 'Heat No');
			$row->setCellValue('R9', 'Sch');

			

			$row->setCellValue('S9', 'Description');
			$row->setCellValue('T9', 'Item Code');
			$row->setCellValue('U9', 'Mtr No.');
			$row->setCellValue('V9', 'Grade / Spec');
			$row->setCellValue('W9', 'Unique No');
			$row->setCellValue('X9', 'Heat No');
			$row->setCellValue('Y9', 'Sch');


			// $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setVisible(false);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setVisible(false);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setVisible(false);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setVisible(false);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setVisible(false);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setVisible(false);

			$row->setCellValue('Z7', 'Fitup');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('Z7:AB8');

			$row->setCellValue('Z9',  'Report');
			$row->setCellValue('AA9', 'Date');
			$row->setCellValue('AB9', 'Result');

			$row->setCellValue('AC7', 'Fitter Code');
			$row->setCellValue('AD7', 'Tack Weld ID');
			$row->setCellValue('AE7', 'WPS No');
			$row->setCellValue('AF7', 'Consumable / Lot No');
			$row->setCellValue('AG7', 'Welded Date');

			$row->setCellValue('AH7', 'Weld Process');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AH7:AI8');
			$row->setCellValue('AH9', 'R/H');
			$row->setCellValue('AI9', 'F/C');


			$row->setCellValue('AJ7', 'Welder ID');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AJ7:AK8');
			$row->setCellValue('AJ9', 'R/H');
			$row->setCellValue('AK9', 'F/C');

			$row->setCellValue('AL7', 'Visual');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AL7:AN8');
			$row->setCellValue('AL9', 'Report');
			$row->setCellValue('AM9', 'Date');
			$row->setCellValue('AN9', 'Result');

			$row->setCellValue('AO7', 'Non Destructive Examination');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AO7:BQ7');

			$row->setCellValue('AO8', 'MPI');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AO8:AQ8');
			$row->setCellValue('AO9', 'Report');
			$row->setCellValue('AP9', 'Date');
			$row->setCellValue('AQ9', 'Result');

			$row->setCellValue('AR8', 'PT');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AR8:AT8');
			$row->setCellValue('AR9', 'Report');
			$row->setCellValue('AS9', 'Date');
			$row->setCellValue('AT9', 'Result');

			$row->setCellValue('AU8', 'UT');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AU8:AW8');
			$row->setCellValue('AU9', 'Report');
			$row->setCellValue('AV9', 'Date');
			$row->setCellValue('AW9', 'Result');

			$row->setCellValue('AX8', 'RT');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AX8:AZ8');
			$row->setCellValue('AX9', 'Report');
			$row->setCellValue('AY9', 'Date');
			$row->setCellValue('AZ9', 'Result');

			$row->setCellValue('BA8', 'PMI');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BA8:BC8');
			$row->setCellValue('BA9', 'Report');
			$row->setCellValue('BB9', 'Date');
			$row->setCellValue('BC9', 'Result');

			// PWHT
			$row->setCellValue('BD8', 'PWHT');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BD8:BQ8');
			$row->setCellValue('BD9', 'YES');
			$row->setCellValue('BE9', 'NO');
			$row->setCellValue('BF9', 'PWHT');
			$row->setCellValue('BG9', 'Date');
			$row->setCellValue('BH9', 'Result');
			$row->setCellValue('BI9', 'MT APWHT');
			$row->setCellValue('BJ9', 'Date');
			$row->setCellValue('BK9', 'Result');
			$row->setCellValue('BL9', 'RT APWHT');
			$row->setCellValue('BM9', 'Date');
			$row->setCellValue('BN9', 'Result');
			$row->setCellValue('BO9', 'UT APWHT');
			$row->setCellValue('BP9', 'Date');
			$row->setCellValue('BQ9', 'Result');

			// DESTRUCTIVE TEST
			$row->setCellValue('BR7', 'Destructive Test');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BR7:BT7');
			
			$row->setCellValue('BR8', 'HER');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BR8:BT8');
			
			$row->setCellValue('BR9', 'Report');
			$row->setCellValue('BS9', 'Date');
			$row->setCellValue('BT9', 'Result');

			// REMARKS
			$row->setCellValue('BU7', 'Remarks');

			// TEST PACK NUMBER
			$row->setCellValue('BV7', 'Test Pack Number');

			$start_reject = count($list)+10;
			$number_reject = count($list)+1;

			$detail_wtr_data	=	$data['drawing_fitup'];
			$start              = 10;
			$number				= 1;

			foreach($list as $value) {

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


				$row->setCellValue('A'.$start, $number);
				$row->setCellValue('B'.$start, 'REMOVE');
				$row->setCellValue('C'.$start, $value['drawing_wm']);
				$row->setCellValue('D'.$start, "$drawing_title");
				$row->setCellValue('E'.$start, $value['rev_wm']);
				$row->setCellValue('F'.$start, $value['joint_no']);
				$row->setCellValue('G'.$start, 'REMOVE');
				$row->setCellValue('H'.$start, $data['weld_type_desc'][$value['weld_type']]);
				$row->setCellValue('I'.$start, $value['spool_no']);
				$row->setCellValue('J'.$start, $value['diameter']);
				$row->setCellValue('K'.$start, $value['thickness']);

				// POS 1
				$row->setCellValue('L'.$start, $value['pos_1']);
				$row->setCellValue('M'.$start, $data['material_pp'][$data['material'][$data['mis'][$data['verif'][$data['pmark'][$value['pos_1']]['id']]['id_mis']]['unique_no']]['catalog_id']]['code_material']);
				$row->setCellValue('N'.$start, $data['verif'][$data['pmark'][$value['pos_1']]['id']]['report_number']);
				$row->setCellValue('O'.$start, $data['material_grade'][$data['material_pp'][$data['material'][$data['mis'][$data['verif'][$data['pmark'][$value['pos_1']]['id']]['id_mis']]['unique_no']]['catalog_id']]['material_grade']]['material_grade']);
				$row->setCellValue('P'.$start, $data['mis'][$data['verif'][$data['pmark'][$value['pos_1']]['id']]['id_mis']]['unique_no']);
				$row->setCellValue('Q'.$start, $data['material'][$data['mis'][$data['verif'][$data['pmark'][$value['pos_1']]['id']]['id_mis']]['unique_no']]['heat_or_series_no']);
				$row->setCellValue('R'.$start, $data['pmark'][$value['pos_1']]['thickness']);

				// POS 2
				$row->setCellValue('S'.$start, $value['pos_2']);
				$row->setCellValue('T'.$start, $data['material_pp'][$data['material'][$data['mis'][$data['verif'][$data['pmark'][$value['pos_2']]['id']]['id_mis']]['unique_no']]['catalog_id']]['code_material']);
				$row->setCellValue('U'.$start, $data['verif'][$data['pmark'][$value['pos_2']]['id']]['report_number']);
				$row->setCellValue('V'.$start, $data['material_grade'][$data['material_pp'][$data['material'][$data['mis'][$data['verif'][$data['pmark'][$value['pos_2']]['id']]['id_mis']]['unique_no']]['catalog_id']]['material_grade']]['material_grade']);
				$row->setCellValue('W'.$start, $data['mis'][$data['verif'][$data['pmark'][$value['pos_2']]['id']]['id_mis']]['unique_no']);
				$row->setCellValue('X'.$start, $data['material'][$data['mis'][$data['verif'][$data['pmark'][$value['pos_2']]['id']]['id_mis']]['unique_no']]['heat_or_series_no']);
				$row->setCellValue('Y'.$start, $data['pmark'][$value['pos_2']]['thickness']);

				$row->setCellValue('Z'.$start, $data['fitup'][$value['id']]['report_number']);
				$row->setCellValue('AA'.$start, $data['fitup'][$value['id']]['date_request']);
				$row->setCellValue('AB'.$start, $data['fitup'][$value['id']]['status_inspection']);

					$ftr = explode(';', $data['fitup'][$value['id']]['fitter_id']);
                      if(isset($data['fitup'][$value['id']]['report_number'])){
                        foreach ($ftr as $ftr) {
                        	$arr_f[$start][] = $data['fitter'][$ftr]['fit_up_badge'];
                         } 
                      } else {
                        $arr_f[$start][] = "-";
                      }
				$row->setCellValue('AC'.$start, implode(", \n", $arr_f[$start]));

                     if(isset($data['fitup'][$value['id']]['report_number'])){
                        $tack_weld_id = explode(';', $data['fitup'][$value['id']]['tack_weld_id']);
                        foreach ($tack_weld_id as $tack_weld_id) {
                           $arr_twf[$start][] = $data['welder'][$tack_weld_id]['wel_code'];
                         } 
                      } else {
                        $arr_twf[$start][] = '-';
                      }
				$row->setCellValue('AD'.$start, implode(", \n", $arr_twf[$start]));

					if(isset($data['fitup'][$value['id']]['report_number'])){
                        $wps[$tart] = explode(';', $data['fitup'][$value['id']]['wps_no']);
                        foreach ($wps[$tart] as $wps[$tart]) {
                           $arr_wps[$start][] = $data['wps'][$wps[$tart]]['wps_code'];
                         } 
                      } else {
                        $arr_wps[$start][] = '-';
                      }
				$row->setCellValue('AE'.$start, implode(", \n", $arr_wps[$start]));
				$row->setCellValue('AF'.$start, isset($data['visual'][$value['id']]['cons_lot_no']) ? $data['visual'][$value['id']]['cons_lot_no'] : '-');
				$row->setCellValue('AG'.$start, isset($data['visual'][$value['id']]['weld_datetime']) ? $data['visual'][$value['id']]['weld_datetime'] : '-');

				$row->setCellValue('AH'.$start, ($data['visual'][$value['id']]['process_gtaw_rh'] == 1 ? "GTAW,\n" : '').($data['visual'][$value['id']]['process_gmaw_rh'] == 1 ? "GMAW,\n" : '').($data['visual'][$value['id']]['process_smaw_rh'] == 1 ? "SMAW,\n" : '').($data['visual'][$value['id']]['process_fcaw_rh'] == 1 ? "FCAW,\n" : '').($data['visual'][$value['id']]['process_saw_rh'] == 1 ? "SAW,\n" : ''));
				$row->setCellValue('AI'.$start, ($data['visual'][$value['id']]['process_gtaw_fc'] == 1 ? "GTAW,\n" : '').($data['visual'][$value['id']]['process_gmaw_fc'] == 1 ? "GMAW,\n" : '').($data['visual'][$value['id']]['process_smaw_fc'] == 1 ? "SMAW,\n" : '').($data['visual'][$value['id']]['process_fcaw_fc'] == 1 ? "FCAW,\n" : '').($data['visual'][$value['id']]['process_saw_fc'] == 1 ? "SAW,\n" : ''));

				
				 if(isset($data['fitup'][$value['id']]['report_number'])){
	                $welder_ref_rh = explode(';', $data['visual'][$value['id']]['welder_ref_rh']);
	                foreach ($welder_ref_rh as $welder_ref_rh) {
	                  $arr_welder_rh[$start][] = $data['welder'][$welder_ref_rh]['wel_code'];
	                } 
	              } else {
	                $arr_welder_rh[$start][] = "-";
	              }
				$row->setCellValue('AJ'.$start, implode(", \n", $arr_welder_rh[$start]));

				if(isset($data['fitup'][$value['id']]['report_number'])){
	                $welder_ref_fc = explode(';', $data['visual'][$value['id']]['welder_ref_fc']);
	                foreach ($welder_ref_fc as $welder_ref_fc) {
	                  $arr_welder_fc[$start][] = $data['welder'][$welder_ref_fc]['wel_code'];
	                } 
	              } else {
	                $arr_welder_fc[$start][] = "-";
	              }
				$row->setCellValue('AK'.$start, implode(", \n", $arr_welder_fc[$start]));


				$row->setCellValue('AL'.$start, isset($data['visual'][$value['id']]['report_number']) ? $data['visual'][$value['id']]['report_number'] : '-');
				$row->setCellValue('AM'.$start, isset($data['visual'][$value['id']]['date_request']) ? $data['visual'][$value['id']]['date_request'] : '-');
				$row->setCellValue('AN'.$start, isset($data['visual'][$value['id']]['report_number']) ? $data['visual'][$value['id']]['status_inspection'] : '-');

				$row->setCellValue('AO'.$start, $data['ndt'][$data['visual'][$value['id']]['id_visual']][2]['report_number']);
				$row->setCellValue('AP'.$start, $data['ndt'][$data['visual'][$value['id']]['id_visual']][2]['date_of_inspection']);
				$row->setCellValue('AQ'.$start, $data['ndt'][$data['visual'][$value['id']]['id_visual']][2]['result']==3 ? 'ACC' : ($data['ndt'][$data['visual'][$value['id']]['id_visual']][2]['result']==2 ? 'REJECT' : ''));

				$row->setCellValue('AR'.$start, $data['ndt'][$data['visual'][$value['id']]['id_visual']][7]['report_number']);
				$row->setCellValue('AS'.$start, $data['ndt'][$data['visual'][$value['id']]['id_visual']][7]['date_of_inspection']);
				$row->setCellValue('AT'.$start, $data['ndt'][$data['visual'][$value['id']]['id_visual']][7]['result']==3 ? 'ACC' : ($data['ndt'][$data['visual'][$value['id']]['id_visual']][7]['result']==2 ? 'REJECT' : ''));

				$row->setCellValue('AU'.$start, $data['ndt'][$data['visual'][$value['id']]['id_visual']][1]['report_number']);
				$row->setCellValue('AV'.$start, $data['ndt'][$data['visual'][$value['id']]['id_visual']][1]['date_of_inspection']);
				$row->setCellValue('AW'.$start, $data['ndt'][$data['visual'][$value['id']]['id_visual']][1]['result']==3 ? 'ACC' : ($data['ndt'][$data['visual'][$value['id']]['id_visual']][1]['result']==2 ? 'REJECT' : ''));

				$row->setCellValue('AX'.$start, $data['ndt'][$data['visual'][$value['id']]['id_visual']][3]['report_number']);
				$row->setCellValue('AY'.$start, $data['ndt'][$data['visual'][$value['id']]['id_visual']][3]['date_of_inspection']);
				$row->setCellValue('AZ'.$start, $data['ndt'][$data['visual'][$value['id']]['id_visual']][3]['result']==3 ? 'ACC' : ($data['ndt'][$data['visual'][$value['id']]['id_visual']][3]['result']==2 ? 'REJECT' : ''));

				$row->setCellValue('BA'.$start, $data['ndt'][$data['visual'][$value['id']]['id_visual']][8]['report_number']);
				$row->setCellValue('BB'.$start, $data['ndt'][$data['visual'][$value['id']]['id_visual']][8]['date_of_inspection']);
				$row->setCellValue('BC'.$start, $data['ndt'][$data['visual'][$value['id']]['id_visual']][8]['result']==3 ? 'ACC' : ($data['ndt'][$data['visual'][$value['id']]['id_visual']][8]['result']==2 ? 'REJECT' : ''));

				$row->setCellValue('BD'.$start, $data['visual'][$value['id']]['ndt_pwht']==1 ? 'YES' : '' );
				$row->setCellValue('BE'.$start, $data['visual'][$value['id']]['ndt_pwht']==1 ? '-' : ($data['visual'][$value['id']]['ndt_pwht']!=1 ? 'NO' : '-'));


				$row->setCellValue('BF'.$start, $data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][9]['report_number']);
				$row->setCellValue('BG'.$start, $data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][9]['date_of_inspection']);
				$row->setCellValue('BH'.$start, $data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][9]['result']==3 ? 'ACC' : ($data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][9]['result']==2 ? 'REJECT' : ''));

				$row->setCellValue('BI'.$start, $data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][2]['report_number']);
				$row->setCellValue('BJ'.$start, $data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][2]['date_of_inspection']);
				$row->setCellValue('BK'.$start, $data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][2]['result']==3 ? 'ACC' : ($data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][2]['result']==2 ? 'REJECT' : ''));

				$row->setCellValue('BL'.$start, $data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][1]['report_number']);
				$row->setCellValue('BM'.$start, $data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][1]['date_of_inspection']);
				$row->setCellValue('BN'.$start, $data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][1]['result']==3 ? 'ACC' : ($data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][1]['result']==2 ? 'REJECT' : ''));

				$row->setCellValue('BO'.$start, $data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][3]['report_number']);
				$row->setCellValue('BP'.$start, $data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][3]['date_of_inspection']);
				$row->setCellValue('BQ'.$start, $data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][3]['result']==3 ? 'ACC' : ($data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][3]['result']==2 ? 'REJECT' : ''));

				$row->setCellValue('BR'.$start, $data['ndt'][$data['visual'][$value['id']]['id_visual']][5]['report_number']);
				$row->setCellValue('BS'.$start, $data['ndt'][$data['visual'][$value['id']]['id_visual']][5]['date_of_inspection']);
				$row->setCellValue('BT'.$start, $data['ndt'][$data['visual'][$value['id']]['id_visual']][5]['result']==3 ? 'ACC' : ($data['ndt'][$data['visual'][$value['id']]['id_visual']][5]['result']==2 ? 'REJECT' : ''));

				$row->setCellValue('BU'.$start, '');
				$row->setCellValue('BV'.$start, $value['test_pack_no']);
			
				$objPHPExcel->getActiveSheet()->getStyle('AC'.$start)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('AD'.$start)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('AE'.$start)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('AH'.$start)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('AI'.$start)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('AJ'.$start)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('AK'.$start)->getAlignment()->setWrapText(true);

				$objPHPExcel->getActiveSheet()->getStyle('E'.$start)->setQuotePrefix(true);
				$objPHPExcel->getActiveSheet()->getStyle('N'.$start)->setQuotePrefix(true);
				$objPHPExcel->getActiveSheet()->getStyle('U'.$start)->setQuotePrefix(true);
				$objPHPExcel->getActiveSheet()->getStyle('Z'.$start)->setQuotePrefix(true);
				$objPHPExcel->getActiveSheet()->getStyle('AL'.$start)->setQuotePrefix(true);

				$objPHPExcel->getActiveSheet()->getStyle('A'.$start.':BV'.$start)->applyFromArray($styleArray);
				unset($styleArray);

				$number++;
				$start++;
			}

			foreach($list_reject as $value) {

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


				$row->setCellValue('A'.$start_reject, $number_reject);
				$row->setCellValue('B'.$start_reject, 'REMOVE');
				$row->setCellValue('C'.$start_reject, $value['drawing_wm']);
				$row->setCellValue('D'.$start_reject, "$drawing_title");
				$row->setCellValue('E'.$start_reject, $value['rev_wm']);
				$row->setCellValue('F'.$start_reject, $value['joint_no'].'('.$value['revision_category'].$value['revision'].')');
				$row->setCellValue('G'.$start_reject, 'REMOVE');
				$row->setCellValue('H'.$start_reject, $data['weld_type_desc'][$value['weld_type']]);
				$row->setCellValue('I'.$start_reject, $value['spool_no']);
				$row->setCellValue('J'.$start_reject, $value['diameter']);
				$row->setCellValue('K'.$start_reject, $value['thickness']);

				// POS 1
				$row->setCellValue('L'.$start_reject, $value['pos_1']);
				$row->setCellValue('M'.$start_reject, $data['material_pp'][$data['material'][$data['mis'][$data['verif'][$data['pmark'][$value['pos_1']]['id']]['id_mis']]['unique_no']]['catalog_id']]['code_material']);
				$row->setCellValue('N'.$start_reject, $data['verif'][$data['pmark'][$value['pos_1']]['id']]['report_number']);
				$row->setCellValue('O'.$start_reject, $data['material_grade'][$data['material_pp'][$data['material'][$data['mis'][$data['verif'][$data['pmark'][$value['pos_1']]['id']]['id_mis']]['unique_no']]['catalog_id']]['material_grade']]['material_grade']);
				$row->setCellValue('P'.$start_reject, $data['mis'][$data['verif'][$data['pmark'][$value['pos_1']]['id']]['id_mis']]['unique_no']);
				$row->setCellValue('Q'.$start_reject, $data['material'][$data['mis'][$data['verif'][$data['pmark'][$value['pos_1']]['id']]['id_mis']]['unique_no']]['heat_or_series_no']);
				$row->setCellValue('R'.$start_reject, $data['pmark'][$value['pos_1']]['thickness']);

				// POS 2
				$row->setCellValue('S'.$start_reject, $value['pos_2']);
				$row->setCellValue('T'.$start_reject, $data['material_pp'][$data['material'][$data['mis'][$data['verif'][$data['pmark'][$value['pos_2']]['id']]['id_mis']]['unique_no']]['catalog_id']]['code_material']);
				$row->setCellValue('U'.$start_reject, $data['verif'][$data['pmark'][$value['pos_2']]['id']]['report_number']);
				$row->setCellValue('V'.$start_reject, $data['material_grade'][$data['material_pp'][$data['material'][$data['mis'][$data['verif'][$data['pmark'][$value['pos_2']]['id']]['id_mis']]['unique_no']]['catalog_id']]['material_grade']]['material_grade']);
				$row->setCellValue('W'.$start_reject, $data['mis'][$data['verif'][$data['pmark'][$value['pos_2']]['id']]['id_mis']]['unique_no']);
				$row->setCellValue('X'.$start_reject, $data['material'][$data['mis'][$data['verif'][$data['pmark'][$value['pos_2']]['id']]['id_mis']]['unique_no']]['heat_or_series_no']);
				$row->setCellValue('Y'.$start_reject, $data['pmark'][$value['pos_2']]['thickness']);

				$row->setCellValue('Z'.$start_reject, $data['fitup'][$value['id']]['report_number']);
				$row->setCellValue('AA'.$start_reject, $data['fitup'][$value['id']]['date_request']);
				$row->setCellValue('AB'.$start_reject, $data['fitup'][$value['id']]['status_inspection']);

					$ftr = explode(';', $data['fitup'][$value['id']]['fitter_id']);
                      if(isset($data['fitup'][$value['id']]['report_number'])){
                        foreach ($ftr as $ftr) {
                        	$arr_f[$start_reject][] = $data['fitter'][$ftr]['fit_up_badge'];
                         } 
                      } else {
                        $arr_f[$start_reject][] = "-";
                      }
				$row->setCellValue('AC'.$start_reject, implode(", \n", $arr_f[$start_reject]));

                     if(isset($data['fitup'][$value['id']]['report_number'])){
                        $tack_weld_id = explode(';', $data['fitup'][$value['id']]['tack_weld_id']);
                        foreach ($tack_weld_id as $tack_weld_id) {
                           $arr_twf[$start_reject][] = $data['welder'][$tack_weld_id]['wel_code'];
                         } 
                      } else {
                        $arr_twf[$start_reject][] = '-';
                      }
				$row->setCellValue('AD'.$start_reject, implode(", \n", $arr_twf[$start_reject]));

					if(isset($data['fitup'][$value['id']]['report_number'])){
                        $wps[$tart] = explode(';', $data['fitup'][$value['id']]['wps_no']);
                        foreach ($wps[$tart] as $wps[$tart]) {
                           $arr_wps[$start_reject][] = $data['wps'][$wps[$tart]]['wps_code'];
                         } 
                      } else {
                        $arr_wps[$start_reject][] = '-';
                      }
				$row->setCellValue('AE'.$start_reject, implode(", \n", $arr_wps[$start_reject]));
				$row->setCellValue('AF'.$start_reject, isset($data['visual'][$value['id']]['cons_lot_no']) ? $data['visual'][$value['id']]['cons_lot_no'] : '-');
				$row->setCellValue('AG'.$start_reject, isset($data['visual'][$value['id']]['weld_datetime']) ? $data['visual'][$value['id']]['weld_datetime'] : '-');

				$row->setCellValue('AH'.$start_reject, ($data['visual'][$value['id']]['process_gtaw_rh'] == 1 ? "GTAW,\n" : '').($data['visual'][$value['id']]['process_gmaw_rh'] == 1 ? "GMAW,\n" : '').($data['visual'][$value['id']]['process_smaw_rh'] == 1 ? "SMAW,\n" : '').($data['visual'][$value['id']]['process_fcaw_rh'] == 1 ? "FCAW,\n" : '').($data['visual'][$value['id']]['process_saw_rh'] == 1 ? "SAW,\n" : ''));
				$row->setCellValue('AI'.$start_reject, ($data['visual'][$value['id']]['process_gtaw_fc'] == 1 ? "GTAW,\n" : '').($data['visual'][$value['id']]['process_gmaw_fc'] == 1 ? "GMAW,\n" : '').($data['visual'][$value['id']]['process_smaw_fc'] == 1 ? "SMAW,\n" : '').($data['visual'][$value['id']]['process_fcaw_fc'] == 1 ? "FCAW,\n" : '').($data['visual'][$value['id']]['process_saw_fc'] == 1 ? "SAW,\n" : ''));

				
				 if(isset($data['fitup'][$value['id']]['report_number'])){
	                $welder_ref_rh = explode(';', $data['visual'][$value['id']]['welder_ref_rh']);
	                foreach ($welder_ref_rh as $welder_ref_rh) {
	                  $arr_welder_rh[$start_reject][] = $data['welder'][$welder_ref_rh]['wel_code'];
	                } 
	              } else {
	                $arr_welder_rh[$start_reject][] = "-";
	              }
				$row->setCellValue('AJ'.$start_reject, implode(", \n", $arr_welder_rh[$start_reject]));

				if(isset($data['fitup'][$value['id']]['report_number'])){
	                $welder_ref_fc = explode(';', $data['visual'][$value['id']]['welder_ref_fc']);
	                foreach ($welder_ref_fc as $welder_ref_fc) {
	                  $arr_welder_fc[$start_reject][] = $data['welder'][$welder_ref_fc]['wel_code'];
	                } 
	              } else {
	                $arr_welder_fc[$start_reject][] = "-";
	              }
				$row->setCellValue('AK'.$start_reject, implode(", \n", $arr_welder_fc[$start_reject]));


				$row->setCellValue('AL'.$start_reject, isset($data['visual'][$value['id']]['report_number']) ? $data['visual'][$value['id']]['report_number'] : '-');
				$row->setCellValue('AM'.$start_reject, isset($data['visual'][$value['id']]['date_request']) ? $data['visual'][$value['id']]['date_request'] : '-');
				$row->setCellValue('AN'.$start_reject, isset($data['visual'][$value['id']]['report_number']) ? $data['visual'][$value['id']]['status_inspection'] : '-');

				$row->setCellValue('AO'.$start_reject, $data['ndt'][$data['visual'][$value['id']]['id_visual']][2]['report_number']);
				$row->setCellValue('AP'.$start_reject, $data['ndt'][$data['visual'][$value['id']]['id_visual']][2]['date_of_inspection']);
				$row->setCellValue('AQ'.$start_reject, $data['ndt'][$data['visual'][$value['id']]['id_visual']][2]['result']==3 ? 'ACC' : ($data['ndt'][$data['visual'][$value['id']]['id_visual']][2]['result']==2 ? 'REJECT' : ''));

				$row->setCellValue('AR'.$start_reject, $data['ndt'][$data['visual'][$value['id']]['id_visual']][7]['report_number']);
				$row->setCellValue('AS'.$start_reject, $data['ndt'][$data['visual'][$value['id']]['id_visual']][7]['date_of_inspection']);
				$row->setCellValue('AT'.$start_reject, $data['ndt'][$data['visual'][$value['id']]['id_visual']][7]['result']==3 ? 'ACC' : ($data['ndt'][$data['visual'][$value['id']]['id_visual']][7]['result']==2 ? 'REJECT' : ''));

				$row->setCellValue('AU'.$start_reject, $data['ndt'][$data['visual'][$value['id']]['id_visual']][1]['report_number']);
				$row->setCellValue('AV'.$start_reject, $data['ndt'][$data['visual'][$value['id']]['id_visual']][1]['date_of_inspection']);
				$row->setCellValue('AW'.$start_reject, $data['ndt'][$data['visual'][$value['id']]['id_visual']][1]['result']==3 ? 'ACC' : ($data['ndt'][$data['visual'][$value['id']]['id_visual']][1]['result']==2 ? 'REJECT' : ''));

				$row->setCellValue('AX'.$start_reject, $data['ndt'][$data['visual'][$value['id']]['id_visual']][3]['report_number']);
				$row->setCellValue('AY'.$start_reject, $data['ndt'][$data['visual'][$value['id']]['id_visual']][3]['date_of_inspection']);
				$row->setCellValue('AZ'.$start_reject, $data['ndt'][$data['visual'][$value['id']]['id_visual']][3]['result']==3 ? 'ACC' : ($data['ndt'][$data['visual'][$value['id']]['id_visual']][3]['result']==2 ? 'REJECT' : ''));

				$row->setCellValue('BA'.$start_reject, $data['ndt'][$data['visual'][$value['id']]['id_visual']][8]['report_number']);
				$row->setCellValue('BB'.$start_reject, $data['ndt'][$data['visual'][$value['id']]['id_visual']][8]['date_of_inspection']);
				$row->setCellValue('BC'.$start_reject, $data['ndt'][$data['visual'][$value['id']]['id_visual']][8]['result']==3 ? 'ACC' : ($data['ndt'][$data['visual'][$value['id']]['id_visual']][8]['result']==2 ? 'REJECT' : ''));

				$row->setCellValue('BD'.$start_reject, $data['visual'][$value['id']]['ndt_pwht']==1 ? 'YES' : '' );
				$row->setCellValue('BE'.$start_reject, $data['visual'][$value['id']]['ndt_pwht']==1 ? '-' : ($data['visual'][$value['id']]['ndt_pwht']!=1 ? 'NO' : '-'));


				$row->setCellValue('BF'.$start_reject, $data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][9]['report_number']);
				$row->setCellValue('BG'.$start_reject, $data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][9]['date_of_inspection']);
				$row->setCellValue('BH'.$start_reject, $data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][9]['result']==3 ? 'ACC' : ($data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][9]['result']==2 ? 'REJECT' : ''));

				$row->setCellValue('BI'.$start_reject, $data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][2]['report_number']);
				$row->setCellValue('BJ'.$start_reject, $data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][2]['date_of_inspection']);
				$row->setCellValue('BK'.$start_reject, $data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][2]['result']==3 ? 'ACC' : ($data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][2]['result']==2 ? 'REJECT' : ''));

				$row->setCellValue('BL'.$start_reject, $data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][1]['report_number']);
				$row->setCellValue('BM'.$start_reject, $data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][1]['date_of_inspection']);
				$row->setCellValue('BN'.$start_reject, $data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][1]['result']==3 ? 'ACC' : ($data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][1]['result']==2 ? 'REJECT' : ''));

				$row->setCellValue('BO'.$start_reject, $data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][3]['report_number']);
				$row->setCellValue('BP'.$start_reject, $data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][3]['date_of_inspection']);
				$row->setCellValue('BQ'.$start_reject, $data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][3]['result']==3 ? 'ACC' : ($data['ndt_apwht'][$data['visual'][$value['id']]['id_visual']][3]['result']==2 ? 'REJECT' : ''));

				$row->setCellValue('BR'.$start_reject, $data['ndt'][$data['visual'][$value['id']]['id_visual']][5]['report_number']);
				$row->setCellValue('BS'.$start_reject, $data['ndt'][$data['visual'][$value['id']]['id_visual']][5]['date_of_inspection']);
				$row->setCellValue('BT'.$start_reject, $data['ndt'][$data['visual'][$value['id']]['id_visual']][5]['result']==3 ? 'ACC' : ($data['ndt'][$data['visual'][$value['id']]['id_visual']][5]['result']==2 ? 'REJECT' : ''));

				$row->setCellValue('BU'.$start_reject, '');
				$row->setCellValue('BV'.$start_reject, $value['test_pack_no']);
			
				$objPHPExcel->getActiveSheet()->getStyle('AC'.$start_reject)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('AD'.$start_reject)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('AE'.$start_reject)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('AH'.$start_reject)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('AI'.$start_reject)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('AJ'.$start_reject)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('AK'.$start_reject)->getAlignment()->setWrapText(true);

				$objPHPExcel->getActiveSheet()->getStyle('E'.$start_reject)->setQuotePrefix(true);
				$objPHPExcel->getActiveSheet()->getStyle('N'.$start_reject)->setQuotePrefix(true);
				$objPHPExcel->getActiveSheet()->getStyle('U'.$start_reject)->setQuotePrefix(true);
				$objPHPExcel->getActiveSheet()->getStyle('Z'.$start_reject)->setQuotePrefix(true);
				$objPHPExcel->getActiveSheet()->getStyle('AL'.$start_reject)->setQuotePrefix(true);

				$objPHPExcel->getActiveSheet()->getStyle('A'.$start_reject.':BV'.$start_reject)->applyFromArray($styleArray);
				unset($styleArray);

				$number_reject++;
				$start_reject++;
			}


			for ($i = 'A'; $i !== 'L'; $i++){
				$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
			}
			$objPHPExcel->getActiveSheet()->calculateColumnWidths();

			for ($i = 'A'; $i !== 'L'; $i++){
				$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(false);
			}

			for ($i = 'A'; $i !== 'L'; $i++){
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells($i.'7:'.$i.'9');
			}

			// MATERIAL TRACEABILITY
			for ($i = 'L'; $i !== 'AC'; $i++){
				$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
			}
			// FOR FITUP
			for ($i = 'Z'; $i !== 'AD'; $i++){
				$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
			}

			for ($i = 'AC'; $i !== 'BV'; $i++){
				$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
			}
			$objPHPExcel->getActiveSheet()->calculateColumnWidths();

			for ($i = 'AC'; $i !== 'BV'; $i++){
				$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(false);
			}

			for ($i = 'AC'; $i !== 'AH'; $i++){
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells($i.'7:'.$i.'9');
			}

			for ($i = 'BU'; $i !== 'BW'; $i++){
				$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
			}
			$objPHPExcel->getActiveSheet()->calculateColumnWidths();

			for ($i = 'BU'; $i !== 'BW'; $i++){
				$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(false);
			}

			for ($i = 'BU'; $i !== 'BW'; $i++){
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells($i.'7:'.$i.'9');
			}

			$objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(10);
			// for ($i = 'A'; $i !== 'BW'; $i++){
			// 	$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header("Content-Disposition: attachment;filename=Export Overall WTR Piping.xlsx");
			header('Cache-Control: max-age=0');
			header('Cache-Control: max-age=1');
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
			header ('Cache-Control: cache, must-revalidate'); 
			header ('Pragma: public'); // HTTP/1.0
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
			unset($objPHPExcel);

		} else {
			$data['subview']      = 'wtr/wtr_piping_list_detail';
			$data['sidebar']      = $this->sidebar;
			$this->load->view('index', $data);
		}
		
  	}

	public function proceed_export_wtr_overall() {
		$post											= $this->input->post();

		if($post['discipline'] == 1) {
			return $this->export_wtr_piping_overall($post);
		}
		elseif($post['discipline'] == 2) {
			return $this->export_wtr_structure_overall($post);
		}
	}

	public function export_wtr_structure_overall($post){
		if($post['submit'] == "excel") {
			include APPPATH.'third_party/PHPExcel/PHPExcel.php';
			$excel              = new PHPExcel();
			$row                = $excel->setActiveSheetIndex(0);
			
			$step_code = "Setup Header";
			if($step_code){
				$column = ['Project', 'Discipline', 'Type Of Module', 'Module'];
				$no = 0;
				for ($i = 1; $i !== 5; $i++){
					$row->setCellValue('A'.$i, $column[$no]); 
					$row->mergeCells('A'.$i.':B'.$i);
					$no++;
				}
				for ($i = 1; $i !== 5; $i++){
					$row->mergeCells('C'.$i.':AW'.$i);
					$no++;
				}
				 
				$column = ['S/N', 'Drawing GA / ASSY Number', 'Drawing / Weld Map No', 'Rev No', 'Joint No', 'Type Of Weld', 'Class', 'Dia (mm)', 'Thk/Sch'];
				$no = 0;
				$start_column = 'A';
				$finish_column = $start_column;
				foreach ($column as $key => $value) {
					$finish_column++;
				}
				for ($i = $start_column; $i !== $finish_column; $i++){
					$row->setCellValue($i.'5', $column[$no]); 
					$row->mergeCells($i.'5:'.$i.'7');
					$no++;
				}
				
				$column = ['Piece Mark', 'Mtr No.', 'Grade /Spec', 'Unique No', 'Heat No', 'THK (MM)'];
				$no = 0;
				$start_column = $finish_column;
				foreach ($column as $key => $value) {
					$finish_column++;
				}
				$row->setCellValue($start_column.'5', 'Material Traceability');
				$row->mergeCells($start_column.'5:U5');
				$row->setCellValue($start_column.'6', 'Part 1');
				$row->mergeCells($start_column.'6:O6');
				for ($i = $start_column; $i !== $finish_column; $i++){
					$row->setCellValue($i.'7', $column[$no]); 
					$no++;
				}
				$no = 0;
				$start_column = $finish_column;
				foreach ($column as $key => $value) {
					$finish_column++;
				}
				$row->setCellValue($start_column.'6', 'Part 2');
				$row->mergeCells($start_column.'6:U6');
				for ($i = $start_column; $i !== $finish_column; $i++){
					$row->setCellValue($i.'7', $column[$no]); 
					$no++;
				}
	
				$column_single = ['Report', 'Date', 'Result'];
				$column_merge = ['Fitter Code', 'Tack Weld ID', 'WPS No', 'Consumable / Lot no', 'Welded Date'];
				$column = array_merge($column_single, $column_merge);
				$no = 0;
				$start_column = $finish_column;
				foreach ($column as $key => $value) {
					$finish_column++;
				}
				$row->mergeCells($start_column.'5:X6');
				$row->setCellValue($start_column.'5', 'Fitup');
				for ($i = $start_column; $i !== $finish_column; $i++){
					if(in_array($column[$no], $column_single)){
						$row->setCellValue($i.'7', $column[$no]); 
					}
					elseif(in_array($column[$no], $column_merge)){
						$row->setCellValue($i.'5', $column[$no]); 
						$row->mergeCells($i.'5:'.$i.'7');
					}
					$no++;
				}
	
				$column = ['R/H', 'F/C', 'R/H', 'F/C', 'Report', 'Date', 'Result'];
				$no = 0;
				$start_column = $finish_column;
				foreach ($column as $key => $value) {
					$finish_column++;
				}
				$row->mergeCells('AD5:AE6');
				$row->setCellValue('AD5', 'Weld Process');
				$row->mergeCells('AF5:AG6');
				$row->setCellValue('AF5', 'Welder ID');
				$row->mergeCells('AH5:AJ6');
				$row->setCellValue('AH5', 'Visual');
				for ($i = $start_column; $i !== $finish_column; $i++){
					$row->setCellValue($i.'7', $column[$no]); 
					$no++;
				}
	
				$column = ['Report', 'Date', 'Result', 'Report', 'Date', 'Result', 'Report', 'Date', 'Result', 'Report', 'Date', 'Result'];
				$no = 0;
				$start_column = $finish_column;
				foreach ($column as $key => $value) {
					$finish_column++;
				}
				$row->mergeCells('AK5:AV5');
				$row->setCellValue('AK5', 'Non Destructive Examination');
				$row->mergeCells('AK6:AM6');
				$row->setCellValue('AK6', 'MPI');
				$row->mergeCells('AN6:AP6');
				$row->setCellValue('AN6', 'PT');
				$row->mergeCells('AQ6:AS6');
				$row->setCellValue('AQ6', 'UT');
				$row->mergeCells('AT6:AV6');
				$row->setCellValue('AT6', 'RT');
				for ($i = $start_column; $i !== $finish_column; $i++){
					$row->setCellValue($i.'7', $column[$no]); 
					$no++;
				}

				$row->mergeCells($finish_column.'5:'.$finish_column.'7');
				$row->setCellValue($finish_column.'5', 'Remarks');
			}
			
			$step_code = "Setup Data";
			if($step_code){
				$project 					= $this->general_mod->project(['id' => $post['project_code']])[0];
				$discipline 			= $this->general_mod->discipline(['id' => $post['discipline']])[0];
				$type_of_module 	= $this->general_mod->type_of_module(['id' => $post['type_of_module']])[0];
				$module 					= $this->general_mod->module(['mod_id' => $post['module']])[0];

				$column = [$project['project_name'], $discipline['discipline_name'], $type_of_module['name'], $module['mod_desc']];
				$no = 0;
				for ($i=1; $i <= 4; $i++) {
					$row->setCellValue('C'.$i, $column[$no]); 
					$no++;
				}

				$joint_list = $this->engineering_mod->joint_list([
					"project" 				=> $post['project_code'],
					"discipline" 			=> $post['discipline'],
					"type_of_module" 	=> $post['type_of_module'],
					"module" 					=> $post['module'],
				]);

				$datadb = $this->engineering_mod->piecemark_list([
					"project" 				=> $post['project_code'],
					"discipline" 			=> $post['discipline'],
					"type_of_module" 	=> $post['type_of_module'],
					"module" 					=> $post['module'],
				]);
				$piecemark_list = [];
				foreach ($datadb as $key => $value) {
					$piecemark_list[$value["part_id"]] = [
						"id" => $value["id"],
						"part_id" => $value["part_id"],
						"thickness" => $value["thickness"],
						"grade" => $value["grade"],
					];
				}

				$datadb = $this->general_mod->material_grade();
				$material_grade_list = [];
				foreach ($datadb as $key => $value) {
					$material_grade_list[$value['id']] = $value['material_grade'];
				}

				$datadb = $this->material_verification_mod->find_material_verification_data([
					"project_code" 		=> $post['project_code'],
					"pcms_material.discipline" 			=> $post['discipline'],
					"pcms_material.type_of_module" 	=> $post['type_of_module'],
					"pcms_material.module" 					=> $post['module'],
				]);
				$mv_list = [];
				$arr_mis = [];
				foreach ($datadb as $key => $value) {
					if(!in_array($value["id_mis"], $arr_mis)){
						$arr_mis[] = $value["id_mis"];
					}
					$mv_list[$value["id_piecemark"]] = [
						"id_mis" => $value["id_mis"],
						"report_number" => $value["report_number"],
					];
				}

				$datadb = $this->material_verification_mod->detail_mis($arr_mis);
				$mis_list = [];
				foreach ($datadb as $key => $value) {
					$mis_list[$value["id_mis_det"]] = [
						"unique_no" => $value["unique_no"],
						"heat_or_series_no" => $value["heat_or_series_no"],
					];
				}

				$fab_status = [
					7 => "ACC",
					6 => "REJECT",
				];

				$datadb = $this->fitup_mod->fitter_code();
				$fitter_code = [];
				foreach ($datadb as $key => $value) {
					$fitter_code[$value['id_fitter']] = $value['fit_up_badge'];
				}

				$datadb = $this->fitup_mod->welder_code();
				$welder_code = [];
				foreach ($datadb as $key => $value) {
					$welder_code[$value['id_welder']] = $value['wel_code'];
				}

				$datadb = $this->fitup_mod->wps_code();
				$wps_code = [];
				foreach ($datadb as $key => $value) {
					$wps_code[$value['id_wps']] = $value['wps_code'];
				}

				$datadb = $this->fitup_mod->fitup_list([
					"project_code" 		=> $post['project_code'],
					"discipline" 			=> $post['discipline'],
					"type_of_module" 	=> $post['type_of_module'],
					"module" 					=> $post['module'],
				]);
				$fitup_list = [];
				foreach ($datadb as $key => $value) {
					$fitup_list[$value["id_joint"]] = [
						"report_number" 			=> $value["report_number"],
						"inspection_datetime" => ($value["inspection_datetime"] != '' ? date("Y-m-d", strtotime($value["inspection_datetime"])) : ''),
						"status_inspection" 	=> (isset($fab_status[$value["status_inspection"]]) ? $fab_status[$value["status_inspection"]] : 'N/A'),
					];
					foreach (explode(";", $value["fitter_id"]) as $fitter_id) {
						$fitup_list[$value["id_joint"]]['fitter_id'][] = $fitter_code[$fitter_id];
					}
					foreach (explode(";", $value["tack_weld_id"]) as $tack_weld_id) {
						$fitup_list[$value["id_joint"]]['tack_weld_id'][] = $welder_code[$tack_weld_id];
					}
					foreach (explode(";", $value["wps_no"]) as $wps_no) {
						$fitup_list[$value["id_joint"]]['wps_no'][] = $wps_code[$wps_no];
					}
				}

				$datadb = $this->visual_mod->visual_list([
					"project_code" 		=> $post['project_code'],
					"discipline" 			=> $post['discipline'],
					"type_of_module" 	=> $post['type_of_module'],
					"module" 					=> $post['module'],
				]);
				$visual_list = [];
				foreach ($datadb as $key => $value) {
					if($value['id_visual'] == 22){
						$visual_list[$value["id_joint"]] = [
							"id_visual" 					=> $value["id_visual"],
							"cons_lot_no" 				=> $value["cons_lot_no"],
							"weld_datetime" 			=> ($value["weld_datetime"] != '' ? date("Y-m-d", strtotime($value["weld_datetime"])) : ''),
							"report_number" 			=> $value["report_number"],
							"inspection_datetime" => ($value["inspection_datetime"] != '' ? date("Y-m-d", strtotime($value["inspection_datetime"])) : ''),
							"status_inspection" 	=> (isset($fab_status[$value["status_inspection"]]) ? $fab_status[$value["status_inspection"]] : 'N/A'),
						];
						if($value['process_gtaw_rh'] == 1){
							$visual_list[$value['id_joint']]['welder_process_rh'][] = "GTAW";
						}
						if($value['process_gmaw_rh'] == 1){
							$visual_list[$value['id_joint']]['welder_process_rh'][] = "GMAW";
						}
						if($value['process_smaw_rh'] == 1){
							$visual_list[$value['id_joint']]['welder_process_rh'][] = "SMAW";
						}
						if($value['process_fcaw_rh'] == 1){
							$visual_list[$value['id_joint']]['welder_process_rh'][] = "FCAW";
						}
						if($value['process_saw_rh'] == 1){
							$visual_list[$value['id_joint']]['welder_process_rh'][] = "SAW";
						}
						if($value['process_gtaw_fc'] == 1){
							$visual_list[$value['id_joint']]['welder_process_fc'][] = "GTAW";
						}
						if($value['process_gmaw_fc'] == 1){
							$visual_list[$value['id_joint']]['welder_process_fc'][] = "GMAW";
						}
						if($value['process_smaw_fc'] == 1){
							$visual_list[$value['id_joint']]['welder_process_fc'][] = "SMAW";
						}
						if($value['process_fcaw_fc'] == 1){
							$visual_list[$value['id_joint']]['welder_process_fc'][] = "FCAW";
						}
						if($value['process_saw_fc'] == 1){
							$visual_list[$value['id_joint']]['welder_process_fc'][] = "SAW";
						}
						
						foreach (explode(";", $value["welder_ref_rh"]) as $welder_ref_rh) {
							$visual_list[$value["id_joint"]]['welder_ref_rh'][] = @$welder_code[$welder_ref_rh];
						}
						foreach (explode(";", $value["welder_ref_fc"]) as $welder_ref_fc) {
							$visual_list[$value["id_joint"]]['welder_ref_fc'][] = @$welder_code[$welder_ref_fc];
						}
					}
					
				}

				$datadb = $this->ndt_mod->ndt_list_general([
					"b.project_code" 		=> $post['project_code'],
					"b.discipline" 			=> $post['discipline'],
					"b.type_of_module" 	=> $post['type_of_module'],
					"b.module" 					=> $post['module'],
				]);
				$ndt_list = [];

				$ndt_status = [
					3 => "ACC",
					2 => "REJECT",
				];
				foreach ($datadb as $key => $value) {
					$ndt_list[$value['id_visual']][$value['ndt_type']] = [
						"result" 							=> (isset($ndt_status[$value["result"]]) ? $ndt_status[$value["result"]] : 'N/A'),
						"date_of_inspection" 	=> $value["date_of_inspection"],
						"report_number" 			=> $value["report_number"],
					];
				}
				
				$numrow = 8;
				$column = [];
				$asdasd = 'TEST DATA WTR OVERALL';
				foreach ($joint_list as $key => $joint) {
					$row->setCellValue('A'.$numrow, ($key+1));
					$row->setCellValue('B'.$numrow, $joint['drawing_no']);
					$row->setCellValue('C'.$numrow, $joint['drawing_wm']);
					$row->setCellValue('D'.$numrow, '="'.$joint['rev_wm'].'"');
					$row->setCellValue('E'.$numrow, $joint['joint_no']);
					$row->setCellValue('F'.$numrow, $joint['weld_type']);
					$row->setCellValue('G'.$numrow, $joint['class']);
					$row->setCellValue('H'.$numrow, $joint['diameter']);
					$row->setCellValue('I'.$numrow, $joint['thickness']);
					$row->setCellValue('J'.$numrow, $joint['pos_1']);
					$row->setCellValue('K'.$numrow, @$mv_list[$piecemark_list[$joint['pos_1']]['id']]['report_number']);
					$row->setCellValue('L'.$numrow, @$material_grade_list[@$piecemark_list[$joint['pos_1']]['grade']]);
					$row->setCellValue('M'.$numrow, @$mis_list[$mv_list[$piecemark_list[$joint['pos_1']]['id']]['id_mis']]['unique_no']);
					$row->setCellValue('N'.$numrow, @$mis_list[$mv_list[$piecemark_list[$joint['pos_1']]['id']]['id_mis']]['heat_or_series_no']);
					$row->setCellValue('O'.$numrow, @$piecemark_list[$joint['pos_1']]['thickness']);
					$row->setCellValue('P'.$numrow, $joint['pos_2']);
					$row->setCellValue('Q'.$numrow, @$mv_list[$piecemark_list[$joint['pos_2']]['id']]['report_number']);
					$row->setCellValue('R'.$numrow, @$material_grade_list[@$piecemark_list[$joint['pos_2']]['grade']]);
					$row->setCellValue('S'.$numrow, @$mis_list[$mv_list[$piecemark_list[$joint['pos_2']]['id']]['id_mis']]['unique_no']);
					$row->setCellValue('T'.$numrow, @$mis_list[$mv_list[$piecemark_list[$joint['pos_2']]['id']]['id_mis']]['heat_or_series_no']);
					$row->setCellValue('U'.$numrow, @$piecemark_list[$joint['pos_2']]['thickness']);
					$row->setCellValue('V'.$numrow, @$fitup_list[$joint['id']]['report_number']);
					$row->setCellValue('W'.$numrow, @$fitup_list[$joint['id']]['inspection_datetime']);
					$row->setCellValue('X'.$numrow, @$fitup_list[$joint['id']]['status_inspection']);
					$row->setCellValue('Y'.$numrow, @join(", ", $fitup_list[$joint['id']]['fitter_id']));
					$row->setCellValue('Z'.$numrow, @join(", ", $fitup_list[$joint['id']]['tack_weld_id']));
					$row->setCellValue('AA'.$numrow, @join(", ", $fitup_list[$joint['id']]['wps_no']));
					$row->setCellValue('AB'.$numrow, @$visual_list[$joint['id']]['cons_lot_no']);
					$row->setCellValue('AC'.$numrow, @$visual_list[$joint['id']]['weld_datetime']);
					$row->setCellValue('AD'.$numrow, @join(", ", $visual_list[$joint['id']]['welder_process_rh']));
					$row->setCellValue('AE'.$numrow, @join(", ", $visual_list[$joint['id']]['welder_process_fc']));
					$row->setCellValue('AF'.$numrow, @join(", ", $visual_list[$joint['id']]['welder_ref_rh']));
					$row->setCellValue('AG'.$numrow, @join(", ", $visual_list[$joint['id']]['welder_ref_fc']));
					$row->setCellValue('AH'.$numrow, @$visual_list[$joint['id']]['report_number']);
					$row->setCellValue('AI'.$numrow, @$visual_list[$joint['id']]['inspection_datetime']);
					$row->setCellValue('AJ'.$numrow, @$visual_list[$joint['id']]['status_inspection']);
					$row->setCellValue('AK'.$numrow, @$ndt_list[$visual_list[$joint['id']]['id_visual']][2]['report_number']);
					$row->setCellValue('AL'.$numrow, @$ndt_list[$visual_list[$joint['id']]['id_visual']][2]['date_of_inspection']);
					$row->setCellValue('AM'.$numrow, @$ndt_list[$visual_list[$joint['id']]['id_visual']][2]['result']);
					$row->setCellValue('AN'.$numrow, @$ndt_list[$visual_list[$joint['id']]['id_visual']][7]['report_number']);
					$row->setCellValue('AO'.$numrow, @$ndt_list[$visual_list[$joint['id']]['id_visual']][7]['date_of_inspection']);
					$row->setCellValue('AP'.$numrow, @$ndt_list[$visual_list[$joint['id']]['id_visual']][7]['result']);
					$row->setCellValue('AQ'.$numrow, @$ndt_list[$visual_list[$joint['id']]['id_visual']][3]['report_number']);
					$row->setCellValue('AR'.$numrow, @$ndt_list[$visual_list[$joint['id']]['id_visual']][3]['date_of_inspection']);
					$row->setCellValue('AS'.$numrow, @$ndt_list[$visual_list[$joint['id']]['id_visual']][3]['result']);
					$row->setCellValue('AT'.$numrow, @$ndt_list[$visual_list[$joint['id']]['id_visual']][1]['report_number']);
					$row->setCellValue('AU'.$numrow, @$ndt_list[$visual_list[$joint['id']]['id_visual']][1]['date_of_inspection']);
					$row->setCellValue('AV'.$numrow, @$ndt_list[$visual_list[$joint['id']]['id_visual']][1]['result']);
					$row->setCellValue('AW'.$numrow, "      ");

					$numrow++;
				}
			}
			$numrow--;

			$style = [
				'bold' => ['bold'  => true],
				'center' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER],
				'left' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT],
				'middle' => ['vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER],
				'allborders' => ['allborders' => ["style" => PHPExcel_Style_Border::BORDER_THIN]],
			];
			$excel->getActiveSheet()->getStyle('A1:B4')->applyFromArray([
				"borders" => $style['allborders'],
				"alignment" => array_merge($style['left'], $style['middle']),
				"font" => $style['bold'],
			]);
			$excel->getActiveSheet()->getStyle('C1:AW4')->applyFromArray([
				"borders" => $style['allborders'],
				"alignment" => array_merge($style['left'], $style['middle']),
			]);
			$excel->getActiveSheet()->getStyle('A5:AW7')->applyFromArray([
				"borders" => $style['allborders'],
				"alignment" => array_merge($style['center'], $style['middle']),
				"font" => $style['bold'],
			]);
			$excel->getActiveSheet()->getStyle('A8:AW'.$numrow)->applyFromArray([
				"borders" => $style['allborders'],
				"alignment" => array_merge($style['center'], $style['middle']),
			]);
			for ($i = 'A'; $i !== 'AX'; $i++){
				$excel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
			}

			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment; filename="MDR-Report-'.date('YmdHis').'.xlsx"'); // Set nama file excel nya
			header('Cache-Control: max-age=0');
			$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
			$write->save('php://output');
		}
	}

	public function export_wtr_piping_overall($post_data) {
		error_reporting(0);
		$project_code								= $post_data['project_code'];
		$discipline									= $post_data['discipline'];
		$type_of_module							= $post_data['type_of_module'];
		$module											= $post_data['module'];
		$submit											= $post_data['submit'];
		$where['id']								= $project_code;
		$data['data_project']				= $this->general_mod->project($where);
		unset($where);

		$where['mod_id']						= $module;
		$data['data_module']				= $this->general_mod->module($where);
		unset($where);

		$where['discipline']				= $discipline;
		$where['project_code']			= $project_code;
		$where['status_inspection']	= 7;
		$where['type_of_module']		= $type_of_module;
		$where['module']						= $module;

		$data['drawing_fitup']			= $this->wtr_mod->fitup_list($where);
		unset($where);

		$id_joint_list							= array_column($data['drawing_fitup'], 'id_joint');

		if($id_joint_list) {
			$where["id IN ('".implode("', '", $id_joint_list)."')"] = NULL;
			$data['template_joint']		= $this->wtr_mod->wtr_list($where);
			unset($where);
			$post_1_list							= array_column($data['template_joint'],'pos_1');
			$post_2_list							= array_column($data['template_joint'],'pos_2');
			$part_id_list							= array_unique(array_merge($post_1_list, $post_2_list));

			if($part_id_list) {
				foreach($data['template_joint'] as $value) {
					$data['data_template_joint'][$value['id']]	= $value;
				}

				$document_no_list				= array_column($data['data_template_joint'] ,'drawing_no');
				if($document_no_list) {
					$where["document_no IN ('".implode("', '", $document_no_list)."')"] = NULL;
					$where['project_id']		= $project_code;
					$where['discipline']		= $discipline;
					$where['module']				= $module;
					$data_drawing						= $this->wtr_mod->data_drawing_list($where);
					unset($where);

					foreach($data_drawing as $value) {
						$data['data_drawing'][$value['document_no']][$value['discipline']][$value['module']]	= $value;
					}
				}
	
				$where["part_id IN ('".implode("', '", $part_id_list)."')"] = NULL;
				$template_piecemark					= $this->wtr_mod->piecemark_list($where);
				foreach($template_piecemark as $value) {
					$data['data_template_piecemark'][$value['part_id']] = $value;
				}
				unset($where);
	
				$id_piecemark_list					= array_column($template_piecemark, 'id');
				if($id_piecemark_list) {
					$material_grade_piecemark	= array_column($template_piecemark, 'grade');
					$where["id_piecemark IN ('".implode("', '", $id_piecemark_list)."')"] = NULL;
					$material_list						= $this->wtr_mod->verification_list($where);
					unset($where);
		
					if($material_list) {
						foreach($material_list as $value) {
							$data['material'][$value['id_piecemark']]	= $value;
						}
			
						$id_mis_detail_lis				= array_column($material_list, 'id_mis');
						$where["id_mis_det IN ('".implode("', '", $id_mis_detail_lis)."')"] = NULL;
						$mis_detail_list					= $this->wtr_mod->mis_list($where);
						unset($where);
			
						foreach($mis_detail_list as $value) {
							$data['mis_detail'][$value['id_mis_det']] = $value;
						}
			
						$unique_no_list						= array_column($mis_detail_list, 'unique_no');
						$where["unique_ident_no IN ('".implode("', '", $unique_no_list)."')"] = NULL;
			
						$qcs_material_list				= $this->wtr_mod->material_list($where);
						unset($where);
						foreach($qcs_material_list as $value) {
							$data['qcs_material'][$value['unique_ident_no']]	= $value;
						}			
			
						$catalog_id_list					= array_column($qcs_material_list, 'catalog_id');
			
						$where["id IN ('".implode("', '", $catalog_id_list)."')"] = NULL;
			
						$catalog_piping_list			= $this->wtr_mod->material_pp_list($where);
						unset($where);
			
						foreach($catalog_piping_list as $value) {
							$data['catalog_piping'][$value['id']]	= $value;
						}
			
						// FOR NON PIPING
						$where["id IN ('".implode("', '", $catalog_id_list)."')"] = NULL;
			
						$catalog_material_list			= $this->wtr_mod->material_catalog_list($where);
						unset($where);
			
						foreach($catalog_material_list as $value) {
							$data['catalog_material'][$value['id']]	= $value;
						}
			
						// DATA VISUAL NON REJECT
						$where["id_joint IN ('".implode("', '", $id_joint_list)."')"] = NULL;
						$where['revision IS NULL'] 					= null;
						$data_visual_list										= $this->wtr_mod->visual_list($where);
						unset($where);
						if($data_visual_list) {
							$id_visual_list										= array_column($data_visual_list, 'id_visual');
							foreach($data_visual_list as $value) {
								
								$data['data_visual'][$value['id_joint']] = $value;
							}
							$where["id_visual IN ('".implode("', '", $id_visual_list)."')"] = NULL;
							$data_ndt													= $this->wtr_mod->ndt_list($where);
							unset($where);
							if($data_ndt) {
								foreach($data_ndt as $value) {
									if($value['pwht_status'] == 1) {
										$data['data_ndt_apwht'][$value['ndt_type']][$value['id_visual']]	= $value;
									} else {
										$data['data_ndt'][$value['ndt_type']][$value['id_visual']]				= $value;
									}
								}
							}
						}

						// DATA VISUAL REJECT
						$where["id_joint IN ('".implode("', '", $id_joint_list)."')"] = NULL;
						$where['revision IS NOT NULL'] 			= null;
						$data_visual_reject_list										= $this->wtr_mod->visual_list($where);
						unset($where);
						if($data_visual_reject_list) {
							$id_visual_reject_list										= array_column($data_visual_reject_list, 'id_visual');
							foreach($data_visual_reject_list as $value) {
								$data['data_visual_reject'][$value['id_joint']][$value['revision']][$value['revision_category']] = $value;
								$data['reject_visual'][]	= $value;
							}
							$where["id_visual IN ('".implode("', '", $id_visual_reject_list)."')"] = NULL;
							$data_ndt_reject													= $this->wtr_mod->ndt_list($where);
							unset($where);
							if($data_ndt_reject) {
								foreach($data_ndt_reject as $value) {
									if($value['pwht_status'] == 1) {
										$data['data_ndt_reject_apwht'][$value['ndt_type']][$value['id_visual']]	= $value;
									} else {
										$data['data_ndt_reject'][$value['ndt_type']][$value['id_visual']]				= $value;
									}
								}
							}
						}

						$where["id IN ('".implode("', '", $material_grade_piecemark)."')"] = NULL;
						$material_grade_list								= $this->general_mod->material_grade($where);
						unset($where);
						foreach($material_grade_list as $value) {
							$data['material_grade'][$value['id']]	= $value['material_grade'];
						}
					}
				}
			}
		}

		$joint_type_list						= $this->general_mod->joint_type();
		foreach($joint_type_list as $value) {
			$data['joint_type'][$value['id']]	= $value['joint_type'];
		}

		$weld_type_list							= $this->general_mod->weld_type();
		foreach($weld_type_list as $value) {
			$data['weld_type'][$value['id']]	= $value['weld_type'];
		}

		$fitter_list								= $this->wtr_mod->fitter_list();
		foreach($fitter_list as $value) {
			$data['data_fitter'][$value['id_fitter']]	= $value['fit_up_badge'];
		}
		// $where['discipline']				= $discipline;
		$where['project_id']				= $project_code;
		$welder_list								= $this->wtr_mod->welder_list($where);
		unset($where);

		foreach($welder_list as $value) {
			$data['data_welder'][$value['id_welder']]	= $value['wel_code'];
		}

		$wps_list										= $this->general_mod->master_wps();
		foreach($wps_list as $value) {
			$data['wps'][$value['wps_id']]	= $value['wps_code'];
		}

		$data['detail_wtr_data']	= $data['drawing_fitup'];


		if($submit == "excel") {
			include APPPATH.'third_party/PHPExcel/PHPExcel.php';
			$objPHPExcel              = new PHPExcel();
			$row                      = $objPHPExcel->setActiveSheetIndex(0); 
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

			$style_array_left = array(
				'borders' => array(
					'allborders' 	=> array(
						'style' 		=> PHPExcel_Style_Border::BORDER_THIN
					)
				),
				'alignment' => array(
					'horizontal' 	=> PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
					'vertical' 		=> PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
				'font'  => array(
					'bold'  => true,
				)
			);
			
			$objPHPExcel->getActiveSheet()->getStyle('A1:BV3')->applyFromArray($style_array_left);
			unset($style_array_left);

			$objPHPExcel->getActiveSheet()->getStyle('A4:BV6')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('B1:B3')->applyFromArray($styleArray);
			unset($styleArray);

			$row->setCellValue('A1', 'PROJECT NAME');
			$row->setCellValue('A2', 'CLIENT');
			$row->setCellValue('A3', 'MODULE');

			$row->setCellValue('B1', ':');
			$row->setCellValue('B2', ':');
			$row->setCellValue('B3', ':');

			$row->setCellValue('C1', strtoupper($data['data_project'][0]['project_name']));
			$row->setCellValue('C2', strtoupper($data['data_project'][0]['client']));
			$row->setCellValue('C3', strtoupper($data['data_module'][0]['mod_desc']));
			
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C1:BV1');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C2:BV2');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C3:BV3');

			$row->setCellValue('A4', 'S/N');
			$row->setCellValue('B4', 'Drawing GA/ASSY Number');
			$row->setCellValue('C4', 'Drawing / Weld Map No');
			$row->setCellValue('D4', 'Drawing Title');
			$row->setCellValue('E4', 'Rev No');
			$row->setCellValue('F4', 'Joint No');
			$row->setCellValue('G4', 'Joint Location');
			$row->setCellValue('H4', 'Type Of Weld');
			$row->setCellValue('I4', 'Spool No');
			$row->setCellValue('J4', 'Size (inch)');
			$row->setCellValue('K4', 'Thk (MM)');

			$row->setCellValue('L4', 'Material Traceability');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('L4:Y4');

			$row->setCellValue('L5', 'Part 1');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('L5:R5');

			$row->setCellValue('S5', 'Part 2');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('S5:Y5');

			$row->setCellValue('L6', 'Description');
			$row->setCellValue('M6', 'Item Code');
			$row->setCellValue('N6', 'Mtr No.');
			$row->setCellValue('O6', 'Grade / Spec');
			$row->setCellValue('P6', 'Unique No');
			$row->setCellValue('Q6', 'Heat No');
			$row->setCellValue('R6', 'Sch');

			$row->setCellValue('S6', 'Description');
			$row->setCellValue('T6', 'Item Code');
			$row->setCellValue('U6', 'Mtr No.');
			$row->setCellValue('V6', 'Grade / Spec');
			$row->setCellValue('W6', 'Unique No');
			$row->setCellValue('X6', 'Heat No');
			$row->setCellValue('Y6', 'Sch');

			$row->setCellValue('Z4', 'Fitup');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('Z4:AB5');

			$row->setCellValue('Z6', 	'Report');
			$row->setCellValue('AA6', 'Date');
			$row->setCellValue('AB6', 'Result');

			$row->setCellValue('AC4', 'Fitter Code');
			$row->setCellValue('AD4', 'Tack Weld ID');
			$row->setCellValue('AE4', 'WPS No');
			$row->setCellValue('AF4', 'Consumable / Lot No');
			$row->setCellValue('AG4', 'Welded Date');

			$row->setCellValue('AH4', 'Weld Process');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AH4:AI5');
			$row->setCellValue('AH6', 'R/H');
			$row->setCellValue('AI6', 'F/C');


			$row->setCellValue('AJ4', 'Welder ID');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AJ4:AK5');
			$row->setCellValue('AJ6', 'R/H');
			$row->setCellValue('AK6', 'F/C');

			$row->setCellValue('AL4', 'Visual');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AL4:AN5');
			$row->setCellValue('AL6', 'Report');
			$row->setCellValue('AM6', 'Date');
			$row->setCellValue('AN6', 'Result');

			$row->setCellValue('AO4', 'Non Destructive Examination');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AO4:BQ4');

			$row->setCellValue('AO5', 'MPI');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AO5:AQ5');
			$row->setCellValue('AO6', 'Report');
			$row->setCellValue('AP6', 'Date');
			$row->setCellValue('AQ6', 'Result');

			$row->setCellValue('AR5', 'PT');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AR5:AT5');
			$row->setCellValue('AR6', 'Report');
			$row->setCellValue('AS6', 'Date');
			$row->setCellValue('AT6', 'Result');

			$row->setCellValue('AU5', 'UT');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AU5:AW5');
			$row->setCellValue('AU6', 'Report');
			$row->setCellValue('AV6', 'Date');
			$row->setCellValue('AW6', 'Result');

			$row->setCellValue('AX5', 'RT');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AX5:AZ5');
			$row->setCellValue('AX6', 'Report');
			$row->setCellValue('AY6', 'Date');
			$row->setCellValue('AZ6', 'Result');

			$row->setCellValue('BA5', 'PMI');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BA5:BC5');
			$row->setCellValue('BA6', 'Report');
			$row->setCellValue('BB6', 'Date');
			$row->setCellValue('BC6', 'Result');

			// PWHT
			$row->setCellValue('BD5', 'PWHT');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BD5:BQ5');
			$row->setCellValue('BD6', 'YES');
			$row->setCellValue('BE6', 'NO');
			$row->setCellValue('BF6', 'PWHT');
			$row->setCellValue('BG6', 'Date');
			$row->setCellValue('BH6', 'Result');
			$row->setCellValue('BI6', 'MT APWHT');
			$row->setCellValue('BJ6', 'Date');
			$row->setCellValue('BK6', 'Result');
			$row->setCellValue('BL6', 'RT APWHT');
			$row->setCellValue('BM6', 'Date');
			$row->setCellValue('BN6', 'Result');
			$row->setCellValue('BO6', 'UT APWHT');
			$row->setCellValue('BP6', 'Date');
			$row->setCellValue('BQ6', 'Result');

			// DESTRUCTIVE TEST
			$row->setCellValue('BR4', 'Destructive Test');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BR4:BT4');
			
			$row->setCellValue('BR5', 'HER');
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BR5:BT5');
			
			$row->setCellValue('BR6', 'Report');
			$row->setCellValue('BS6', 'Date');
			$row->setCellValue('BT6', 'Result');

			// REMARKS
			$row->setCellValue('BU4', 'Remarks');

			// TEST PACK NUMBER
			$row->setCellValue('BV4', 'Test Pack Number');


			$detail_wtr_data					=	$data['drawing_fitup'];
			$start                    = 7;
			$number										= 1;
			foreach($detail_wtr_data as $value) {

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
				if(isset($data['data_drawing'][$value['drawing_no']][$value['discipline']][$value['module']])) {
					$drawing_title						= $data['data_drawing'][$value['drawing_no']][$value['discipline']][$value['module']]['title'];
				} else {
					$drawing_title						= "";
				}

				// RESULT FITUP

				if($value['inspection_datetime']) {
					$fitup_date								= date('Y-m-d', strtotime($value['inspection_datetime']));
				} else {
					$fitup_date								= '';
				}

				if($value['status_inspection'] == 7) {
					$result_fitup							= "ACC";
				} elseif($value['status_inspection'] == 6) {
					$result_fitup							= "REJECT";
				} else {
					$result_fitup							= "N/A";
				}

				//  FITUP WELDER

				$fitter_fitup								= explode(';', $value['fitter_id']);
				$fitter_fitup_list					= [];
				foreach($fitter_fitup as $v) {
					$fitter_fitup_list[]			= $data['data_fitter'][$v];
				} 

				$tack_weld_fitup							= explode(';', $value['tack_weld_id']);
				$tack_weld_fitup_list					= [];
				foreach($tack_weld_fitup as $v) {
					$tack_weld_fitup_list[]			= $data['data_welder'][$v];
				} 

				$wps_fitup									= explode(';', $value['wps_no']);
				$wps_list_fitup							= [];
				foreach ($wps_fitup as $v) {
					$wps_list_fitup[]					= $data['wps'][$v];
				}

				// VISUAL

				$welder_process_rh					= [];
				if($data['data_visual'][$value['id_joint']]['process_gtaw_rh'] == 1) {
					$welder_process_rh[]			= "GTAW";
				}
				if($data['data_visual'][$value['id_joint']]['process_gmaw_rh'] == 1) {
					$welder_process_rh[]			= "GMAW";
				}
				if($data['data_visual'][$value['id_joint']]['process_smaw_rh'] == 1) {
					$welder_process_rh[]			= "SMAW";
				}
				if($data['data_visual'][$value['id_joint']]['process_fcaw_rh'] == 1) {
					$welder_process_rh[]			= "FCAW";
				}
				if($data['data_visual'][$value['id_joint']]['process_saw_rh'] == 1) {
					$welder_process_rh[]			= "SAW";
				}

				$welder_process_fc					= [];
				if($data['data_visual'][$value['id_joint']]['process_gtaw_fc'] == 1) {
					$welder_process_fc[]			= "GTAW";
				}
				if($data['data_visual'][$value['id_joint']]['process_gmaw_fc'] == 1) {
					$welder_process_fc[]			= "GMAW";
				}
				if($data['data_visual'][$value['id_joint']]['process_smaw_fc'] == 1) {
					$welder_process_fc[]			= "SMAW";
				}
				if($data['data_visual'][$value['id_joint']]['process_fcaw_fc'] == 1) {
					$welder_process_fc[]			= "FCAW";
				}
				if($data['data_visual'][$value['id_joint']]['process_saw_fc'] == 1) {
					$welder_process_fc[]			= "SAW";
				}

				$welder_id_rh								= explode(';', $data['data_visual'][$value['id_joint']]['welder_ref_rh']);
				$welder_id_rh_list					= [];
				foreach($welder_id_rh as $v) {
					$welder_id_rh_list[]		 	= $data['data_welder'][$v];
				}

				$welder_id_fc								= explode(';', $data['data_visual'][$value['id_joint']]['welder_ref_fc']);
				$welder_id_fc_list					= [];
				foreach($welder_id_fc as $v) {
					$welder_id_fc_list[]		 	= $data['data_welder'][$v];
				}

				if($data['data_visual'][$value['id_joint']]['weld_datetime']) {
					$welded_date							= date('Y-m-d', strtotime($data['data_visual'][$value['id_joint']]['weld_datetime']));
				} else {
					$welded_date							= '';
				}

				if($data['data_visual'][$value['id_joint']]['inspection_datetime']) {
					$visual_date							= date('Y-m-d', strtotime($data['data_visual'][$value['id_joint']]['inspection_datetime']));
				} else {
					$visual_date							= '';
				}

				if($data['data_visual'][$value['id_joint']]['status_inspection'] == 7) {
					$result_visual						= "ACC";
				} elseif($$data['data_visual'][$value['id_joint']]['status_inspection'] == 6) {
					$result_visual						= "REJECT";
				} else {
					$result_visual						= "N/A";
				}

				// RT NDT (PWHT OR NON PWHT)
				$report_rt_non_pwht	= $data['data_ndt']['1'][$data['data_visual'][$value['id_joint']]['id_visual']]['report_number'];
				$date_rt						=	$data['data_ndt']['1'][$data['data_visual'][$value['id_joint']]['id_visual']]['date_of_inspection'];

				if($date_rt) {
					$date_rt_non_pwht	= date('Y-m-d', strtotime($date_rt));
				} else {
					$date_rt_non_pwht	= '';
				}

				$result_rt_1				= $data['data_ndt']['1'][$data['data_visual'][$value['id_joint']]['id_visual']]['result'];
				if($result_rt_1 == 3) {
					$result_rt_non_pwht	= "ACC";
				} elseif($result_rt_1 == 2) {
					$result_rt_non_pwht	= "REJECT";
				} else {
					$result_rt_non_pwht	= "N/A";
				}

				if(isset($data['data_ndt_apwht']['1'][$data['data_visual'][$value['id_joint']]['id_visual']])) {
					$report_rt_pwht			= $data['data_ndt_apwht']['1'][$data['data_visual'][$value['id_joint']]['id_visual']]['report_number'];
					$date_rt						=	$data['data_ndt_apwht']['1'][$data['data_visual'][$value['id_joint']]['id_visual']]['date_of_inspection'];

					if($date_rt) {
						$date_rt_pwht	= date('Y-m-d', strtotime($date_rt));
					} else {
						$date_rt_pwht	= '';
					}

					$result_rt_2					= $data['data_ndt_apwht']['1'][$data['data_visual'][$value['id_joint']]['id_visual']]['result'];
					if($result_rt_2 == 3) {
						$result_rt_pwht	= "ACC";
					} elseif($result_rt_2 == 2) {
						$result_rt_pwht	= "REJECT";
					} else {
						$result_rt_pwht	= "N/A";
					}
				} else {
					$report_rt_pwht		= "";
					$date_rt_pwht			= "";
					$result_rt_pwht		= "";
				}


				// MAGNETIC PARTICLE NDT (PWHT OR NON PWHT)
					$report_magnetic_non_pwht	= $data['data_ndt']['2'][$data['data_visual'][$value['id_joint']]['id_visual']]['report_number'];
					$date_magnetic						=	$data['data_ndt']['2'][$data['data_visual'][$value['id_joint']]['id_visual']]['date_of_inspection'];

					if($date_magnetic) {
						$date_magnetic_non_pwht	= date('Y-m-d', strtotime($date_magnetic));
					} else {
						$date_magnetic_non_pwht	= '';
					}

					$result_magnetic_1				= $data['data_ndt']['2'][$data['data_visual'][$value['id_joint']]['id_visual']]['result'];
					if($result_magnetic_1 == 3) {
						$result_magnetic_non_pwht	= "ACC";
					} elseif($result_magnetic_1 == 2) {
						$result_magnetic_non_pwht	= "REJECT";
					} else {
						$result_magnetic_non_pwht	= "N/A";
					}

					if(isset($data['data_ndt_apwht']['2'][$data['data_visual'][$value['id_joint']]['id_visual']])) {
						$report_magnetic_pwht			= $data['data_ndt_apwht']['2'][$data['data_visual'][$value['id_joint']]['id_visual']]['report_number'];
						$date_magnetic						=	$data['data_ndt_apwht']['2'][$data['data_visual'][$value['id_joint']]['id_visual']]['date_of_inspection'];

						if($date_magnetic) {
							$date_magnetic_pwht	= date('Y-m-d', strtotime($date_magnetic));
						} else {
							$date_magnetic_pwht	= '';
						}

						$result_magnetic_2					= $data['data_ndt_apwht']['2'][$data['data_visual'][$value['id_joint']]['id_visual']]['result'];
						if($result_magnetic_2 == 3) {
							$result_magnetic_pwht	= "ACC";
						} elseif($result_magnetic_2 == 2) {
							$result_magnetic_pwht	= "REJECT";
						} else {
							$result_magnetic_pwht	= "N/A";
						}
					} else {
						$report_magnetic_pwht		= "";
						$date_magnetic_pwht			= "";
						$result_magnetic_pwht		= "";
					}

					// ULTRASONIC NDT (PWHT OR NON PWHT)
					$report_ut_non_pwht	= $data['data_ndt']['3'][$data['data_visual'][$value['id_joint']]['id_visual']]['report_number'];
					$date_ut						=	$data['data_ndt']['3'][$data['data_visual'][$value['id_joint']]['id_visual']]['date_of_inspection'];

					if($date_ut) {
						$date_ut_non_pwht	= date('Y-m-d', strtotime($date_ut));
					} else {
						$date_ut_non_pwht	= '';
					}

					$result_ut_1				= $data['data_ndt']['3'][$data['data_visual'][$value['id_joint']]['id_visual']]['result'];
					if($result_ut_1 == 3) {
						$result_ut_non_pwht	= "ACC";
					} elseif($result_ut_1 == 2) {
						$result_ut_non_pwht	= "REJECT";
					} else {
						$result_ut_non_pwht	= "N/A";
					}

					if(isset($data['data_ndt_apwht']['3'][$data['data_visual'][$value['id_joint']]['id_visual']])) {
						$report_ut_pwht			= $data['data_ndt_apwht']['3'][$data['data_visual'][$value['id_joint']]['id_visual']]['report_number'];
						$date_ut						=	$data['data_ndt_apwht']['3'][$data['data_visual'][$value['id_joint']]['id_visual']]['date_of_inspection'];

						if($date_ut) {
							$date_ut_pwht	= date('Y-m-d', strtotime($date_ut));
						} else {
							$date_ut_pwht	= '';
						}

						$result_ut_2					= $data['data_ndt_apwht']['3'][$data['data_visual'][$value['id_joint']]['id_visual']]['result'];
						if($result_ut_2 == 3) {
							$result_ut_pwht	= "ACC";
						} elseif($result_ut_2 == 2) {
							$result_ut_pwht	= "REJECT";
						} else {
							$result_ut_pwht	= "N/A";
						}
					} else {
						$report_ut_pwht		= "";
						$date_ut_pwht			= "";
						$result_ut_pwht		= "";
					}

					// HARDNESS NDT (PWHT OR NON PWHT)
					$report_hardness_non_pwht	= $data['data_ndt']['5'][$data['data_visual'][$value['id_joint']]['id_visual']]['report_number'];
					$date_hardness						=	$data['data_ndt']['5'][$data['data_visual'][$value['id_joint']]['id_visual']]['date_of_inspection'];

					if($date_hardness) {
						$date_hardness_non_pwht	= date('Y-m-d', strtotime($date_hardness));
					} else {
						$date_hardness_non_pwht	= '';
					}

					$result_hardness_1				= $data['data_ndt']['5'][$data['data_visual'][$value['id_joint']]['id_visual']]['result'];
					if($result_hardness_1 == 3) {
						$result_hardness_non_pwht	= "ACC";
					} elseif($result_hardness_1 == 2) {
						$result_hardness_non_pwht	= "REJECT";
					} else {
						$result_hardness_non_pwht	= "N/A";
					}


					// PENETRANT NDT (PWHT OR NON PWHT)
					$report_pt_non_pwht	= $data['data_ndt']['7'][$data['data_visual'][$value['id_joint']]['id_visual']]['report_number'];
					$date_pt						=	$data['data_ndt']['7'][$data['data_visual'][$value['id_joint']]['id_visual']]['date_of_inspection'];

					if($date_pt) {
						$date_pt_non_pwht	= date('Y-m-d', strtotime($date_pt));
					} else {
						$date_pt_non_pwht	= '';
					}

					$result_pt_1				= $data['data_ndt']['7'][$data['data_visual'][$value['id_joint']]['id_visual']]['result'];
					if($result_pt_1 == 3) {
						$result_pt_non_pwht	= "ACC";
					} elseif($result_pt_1 == 2) {
						$result_pt_non_pwht	= "REJECT";
					} else {
						$result_pt_non_pwht	= "N/A";
					}

					// PMI NDT (PWHT OR NON PWHT)
					$report_pmi_non_pwht	= $data['data_ndt']['8'][$data['data_visual'][$value['id_joint']]['id_visual']]['report_number'];
					$date_pmi						=	$data['data_ndt']['8'][$data['data_visual'][$value['id_joint']]['id_visual']]['date_of_inspection'];

					if($date_pmi) {
						$date_pmi_non_pwht	= date('Y-m-d', strtotime($date_pmi));
					} else {
						$date_pmi_non_pwht	= '';
					}

					$result_pmi_1				= $data['data_ndt']['8'][$data['data_visual'][$value['id_joint']]['id_visual']]['result'];
					if($result_pmi_1 == 3) {
						$result_pmi_non_pwht	= "ACC";
					} elseif($result_pmi_1 == 2) {
						$result_pmi_non_pwht	= "REJECT";
					} else {
						$result_pmi_non_pwht	= "N/A";
					}

					// PWHT NDT (PWHT OR NON PWHT)
					if(isset($data['data_ndt']['9'][$data['data_visual'][$value['id_joint']]['id_visual']])) {
						$status_pwht					= "YES";
						$report_pwht					= $data['data_ndt']['9'][$data['data_visual'][$value['id_joint']]['id_visual']]['report_number'];
						$date_pwht						=	$data['data_ndt']['9'][$data['data_visual'][$value['id_joint']]['id_visual']]['date_of_inspection'];

						if($date_pwht) {
							$date_pwht	= date('Y-m-d', strtotime($date_pwht));
						} else {
							$date_pwht	= '';
						}

						$result_pwht_1				= $data['data_ndt']['9'][$data['data_visual'][$value['id_joint']]['id_visual']]['result'];
						if($result_pwht_1 == 3) {
							$result_pwht	= "ACC";
						} elseif($result_pwht_1 == 2) {
							$result_pwht	= "REJECT";
						} else {
							$result_pwht	= "N/A";
						}
					} else {
						$status_pwht		= "NO";
						$report_pwht		= "";
						$date_pwht			= "";
						$result_pwht		= "";
					}
					


				$row->setCellValue('A'.$start, $number);
				$row->setCellValue('B'.$start, $data['data_template_joint'][$value['id_joint']]['drawing_no']);
				$row->setCellValue('C'.$start, $data['data_template_joint'][$value['id_joint']]['drawing_wm']);
				$row->setCellValue('D'.$start, $drawing_title);
				$row->setCellValue('E'.$start, $data['data_template_joint'][$value['id_joint']]['rev_wm']);
				$row->setCellValue('F'.$start, $data['data_template_joint'][$value['id_joint']]['joint_no']);
				$row->setCellValue('G'.$start, $data['joint_type'][$data['data_template_joint'][$value['id_joint']]['joint_type']]);
				$row->setCellValue('H'.$start, $data['weld_type'][$data['data_template_joint'][$value['id_joint']]['weld_type']]);
				$row->setCellValue('I'.$start, $data['data_template_joint'][$value['id_joint']]['spool_no']);
				$row->setCellValue('J'.$start, $data['data_template_joint'][$value['id_joint']]['diameter']);
				$row->setCellValue('K'.$start, $data['data_template_joint'][$value['id_joint']]['thickness']);
				// POS 1
				$row->setCellValue('L'.$start, $data['data_template_joint'][$value['id_joint']]['pos_1']);
				$row->setCellValue('M'.$start, $data['data_template_piecemark'][$data['data_template_joint'][$value['id_joint']]['pos_1']]['item_code']);
				$row->setCellValue('N'.$start, $data['material'][$data['data_template_piecemark'][$data['data_template_joint'][$value['id_joint']]['pos_1']]['id']]['report_number']);
				$row->setCellValue('O'.$start, $data['material_grade'][$data['data_template_piecemark'][$data['data_template_joint'][$value['id_joint']]['pos_1']]['grade']]);
				$row->setCellValue('P'.$start, $data['qcs_material'][$data['mis_detail'][$data['material'][$data['data_template_piecemark'][$data['data_template_joint'][$value['id_joint']]['pos_1']]['id']]['id_mis']]['unique_no']]['unique_ident_no']);
				$row->setCellValue('Q'.$start, $data['qcs_material'][$data['mis_detail'][$data['material'][$data['data_template_piecemark'][$data['data_template_joint'][$value['id_joint']]['pos_1']]['id']]['id_mis']]['unique_no']]['heat_or_series_no']);
				$row->setCellValue('R'.$start, $data['data_template_piecemark'][$data['data_template_joint'][$value['id_joint']]['pos_1']]['sch']);

				// POS 2
				$row->setCellValue('S'.$start, $data['data_template_joint'][$value['id_joint']]['pos_2']);
				$row->setCellValue('T'.$start, $data['data_template_piecemark'][$data['data_template_joint'][$value['id_joint']]['pos_2']]['item_code']);
				$row->setCellValue('U'.$start, $data['material'][$data['data_template_piecemark'][$data['data_template_joint'][$value['id_joint']]['pos_2']]['id']]['report_number']);
				$row->setCellValue('V'.$start, $data['material_grade'][$data['data_template_piecemark'][$data['data_template_joint'][$value['id_joint']]['pos_2']]['grade']]);
				$row->setCellValue('W'.$start, $data['qcs_material'][$data['mis_detail'][$data['material'][$data['data_template_piecemark'][$data['data_template_joint'][$value['id_joint']]['pos_2']]['id']]['id_mis']]['unique_no']]['unique_ident_no']);
				$row->setCellValue('X'.$start, $data['qcs_material'][$data['mis_detail'][$data['material'][$data['data_template_piecemark'][$data['data_template_joint'][$value['id_joint']]['pos_2']]['id']]['id_mis']]['unique_no']]['heat_or_series_no']);
				$row->setCellValue('Y'.$start, $data['data_template_piecemark'][$data['data_template_joint'][$value['id_joint']]['pos_2']]['sch']);

				$row->setCellValue('Z'.$start, $value['report_number']);
				$row->setCellValue('AA'.$start, $fitup_date);
				$row->setCellValue('AB'.$start, $result_fitup);
				$row->setCellValue('AC'.$start, implode(", \n", $fitter_fitup_list));
				$row->setCellValue('AD'.$start, implode(", \n", $tack_weld_fitup_list));
				$row->setCellValue('AE'.$start, implode(", \n", $wps_list_fitup));
				$row->setCellValue('AF'.$start, $data['data_visual'][$value['id_joint']]['cons_lot_no']);
				$row->setCellValue('AG'.$start, $welded_date);
				$row->setCellValue('AH'.$start, implode(", \n", $welder_process_rh));
				$row->setCellValue('AI'.$start, implode(", \n", $welder_process_fc));
				$row->setCellValue('AJ'.$start, implode(", \n", $welder_id_rh_list));
				$row->setCellValue('AK'.$start, implode(", \n", $welder_id_fc_list));
				$row->setCellValue('AL'.$start, $data['data_visual'][$value['id_joint']]['report_number']);
				$row->setCellValue('AM'.$start, $visual_date);
				$row->setCellValue('AN'.$start, $result_visual);

				$row->setCellValue('AO'.$start, $report_magnetic_non_pwht);
				$row->setCellValue('AP'.$start, $date_magnetic_non_pwht);
				$row->setCellValue('AQ'.$start, $result_magnetic_non_pwht);

				$row->setCellValue('AR'.$start, $report_pt_non_pwht);
				$row->setCellValue('AS'.$start, $date_pt_non_pwht);
				$row->setCellValue('AT'.$start, $result_pt_non_pwht);

				$row->setCellValue('AU'.$start, $report_ut_non_pwht);
				$row->setCellValue('AV'.$start, $date_ut_non_pwht);
				$row->setCellValue('AW'.$start, $result_ut_non_pwht);

				$row->setCellValue('AX'.$start, $report_rt_non_pwht);
				$row->setCellValue('AY'.$start, $date_rt_non_pwht);
				$row->setCellValue('AZ'.$start, $result_rt_non_pwht);

				$row->setCellValue('BA'.$start, $report_pmi_non_pwht);
				$row->setCellValue('BB'.$start, $date_pmi_non_pwht);
				$row->setCellValue('BC'.$start, $result_pmi_non_pwht);

				$row->setCellValue('BD'.$start, $status_pwht == "YES" ? $status_pwht : "");
				$row->setCellValue('BE'.$start, $status_pwht == "NO" ? $status_pwht : "");

				$row->setCellValue('BF'.$start, $report_pwht);
				$row->setCellValue('BG'.$start, $date_pwht);
				$row->setCellValue('BH'.$start, $result_pwht);

				$row->setCellValue('BI'.$start, $report_magnetic_pwht);
				$row->setCellValue('BJ'.$start, $date_magnetic_pwht);
				$row->setCellValue('BK'.$start, $result_magnetic_pwht);

				$row->setCellValue('BL'.$start, $report_rt_pwht);
				$row->setCellValue('BM'.$start, $date_rt_pwht);
				$row->setCellValue('BN'.$start, $result_rt_pwht);

				$row->setCellValue('BO'.$start, $report_ut_pwht);
				$row->setCellValue('BP'.$start, $date_ut_pwht);
				$row->setCellValue('BQ'.$start, $result_ut_pwht);

				$row->setCellValue('BR'.$start, $report_hardness_non_pwht);
				$row->setCellValue('BS'.$start, $date_hardness_non_pwht);
				$row->setCellValue('BT'.$start, $result_hardness_non_pwht);

				$row->setCellValue('BU'.$start, $value);
				$row->setCellValue('BV'.$start, $data['data_template_joint'][$value['id_joint']]['test_pack_no']);
			
				$objPHPExcel->getActiveSheet()->getStyle('AC'.$start)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('AD'.$start)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('AE'.$start)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('AH'.$start)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('AI'.$start)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('AJ'.$start)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('AK'.$start)->getAlignment()->setWrapText(true);

				$objPHPExcel->getActiveSheet()->getStyle('E'.$start)->setQuotePrefix(true);
				$objPHPExcel->getActiveSheet()->getStyle('N'.$start)->setQuotePrefix(true);
				$objPHPExcel->getActiveSheet()->getStyle('U'.$start)->setQuotePrefix(true);
				$objPHPExcel->getActiveSheet()->getStyle('Z'.$start)->setQuotePrefix(true);
				$objPHPExcel->getActiveSheet()->getStyle('AL'.$start)->setQuotePrefix(true);

				$objPHPExcel->getActiveSheet()->getStyle('A'.$start.':BV'.$start)->applyFromArray($styleArray);
				unset($styleArray);

				$number++;
				$start++;
			}
			foreach($data['reject_visual'] as $value) {
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

				if(isset($data['data_drawing'][$value['drawing_no']][$value['discipline']][$value['module']])) {
					$drawing_title						= $data['data_drawing'][$value['drawing_no']][$value['discipline']][$value['module']]['title'];
				} else {
					$drawing_title						= "";
				}

				if($value['inspection_datetime']) {
					$fitup_date								= date('Y-m-d', strtotime($value['inspection_datetime']));
				} else {
					$fitup_date								= '';
				}

				if($value['status_inspection'] == 7) {
					$result_fitup							= "ACC";
				} elseif($value['status_inspection'] == 6) {
					$result_fitup							= "REJECT";
				} else {
					$result_fitup							= "N/A";
				}

				//  FITUP WELDER

				$fitter_fitup								= explode(';', $value['fitter_id']);
				$fitter_fitup_list					= [];
				foreach($fitter_fitup as $v) {
					$fitter_fitup_list[]			= $data['data_fitter'][$v];
				} 

				$tack_weld_fitup							= explode(';', $value['tack_weld_id']);
				$tack_weld_fitup_list					= [];
				foreach($tack_weld_fitup as $v) {
					$tack_weld_fitup_list[]			= $data['data_welder'][$v];
				} 

				$wps_fitup									= explode(';', $value['wps_no']);
				$wps_list_fitup							= [];
				foreach ($wps_fitup as $v) {
					$wps_list_fitup[]					= $data['wps'][$v];
				}

				// VISUAL

				$welder_process_rh					= [];
				if($data['data_visual'][$value['id_joint']]['process_gtaw_rh'] == 1) {
					$welder_process_rh[]			= "GTAW";
				}
				if($data['data_visual'][$value['id_joint']]['process_gmaw_rh'] == 1) {
					$welder_process_rh[]			= "GMAW";
				}
				if($data['data_visual'][$value['id_joint']]['process_smaw_rh'] == 1) {
					$welder_process_rh[]			= "SMAW";
				}
				if($data['data_visual'][$value['id_joint']]['process_fcaw_rh'] == 1) {
					$welder_process_rh[]			= "FCAW";
				}
				if($data['data_visual'][$value['id_joint']]['process_saw_rh'] == 1) {
					$welder_process_rh[]			= "SAW";
				}

				$welder_process_fc					= [];
				if($data['data_visual'][$value['id_joint']]['process_gtaw_fc'] == 1) {
					$welder_process_fc[]			= "GTAW";
				}
				if($data['data_visual'][$value['id_joint']]['process_gmaw_fc'] == 1) {
					$welder_process_fc[]			= "GMAW";
				}
				if($data['data_visual'][$value['id_joint']]['process_smaw_fc'] == 1) {
					$welder_process_fc[]			= "SMAW";
				}
				if($data['data_visual'][$value['id_joint']]['process_fcaw_fc'] == 1) {
					$welder_process_fc[]			= "FCAW";
				}
				if($data['data_visual'][$value['id_joint']]['process_saw_fc'] == 1) {
					$welder_process_fc[]			= "SAW";
				}

				$welder_id_rh								= explode(';', $data['data_visual'][$value['id_joint']]['welder_ref_rh']);
				$welder_id_rh_list					= [];
				foreach($welder_id_rh as $v) {
					$welder_id_rh_list[]		 	= $data['data_welder'][$v];
				}

				$welder_id_fc								= explode(';', $data['data_visual'][$value['id_joint']]['welder_ref_fc']);
				$welder_id_fc_list					= [];
				foreach($welder_id_fc as $v) {
					$welder_id_fc_list[]		 	= $data['data_welder'][$v];
				}

				if($data['data_visual'][$value['id_joint']]['weld_datetime']) {
					$welded_date							= date('Y-m-d', strtotime($data['data_visual'][$value['id_joint']]['weld_datetime']));
				} else {
					$welded_date							= '';
				}

				if($data['data_visual'][$value['id_joint']]['inspection_datetime']) {
					$visual_date							= date('Y-m-d', strtotime($data['data_visual'][$value['id_joint']]['inspection_datetime']));
				} else {
					$visual_date							= '';
				}

				if($data['data_visual'][$value['id_joint']]['status_inspection'] == 7) {
					$result_visual						= "ACC";
				} elseif($$data['data_visual'][$value['id_joint']]['status_inspection'] == 6) {
					$result_visual						= "REJECT";
				} else {
					$result_visual						= "N/A";
				}

				// RT NDT (PWHT OR NON PWHT)
				$report_rt_non_pwht	= $data['data_ndt']['1'][$data['data_visual'][$value['id_joint']]['id_visual']]['report_number'];
				$date_rt						=	$data['data_ndt']['1'][$data['data_visual'][$value['id_joint']]['id_visual']]['date_of_inspection'];

				if($date_rt) {
					$date_rt_non_pwht	= date('Y-m-d', strtotime($date_rt));
				} else {
					$date_rt_non_pwht	= '';
				}

				$result_rt_1				= $data['data_ndt']['1'][$data['data_visual'][$value['id_joint']]['id_visual']]['result'];
				if($result_rt_1 == 3) {
					$result_rt_non_pwht	= "ACC";
				} elseif($result_rt_1 == 2) {
					$result_rt_non_pwht	= "REJECT";
				} else {
					$result_rt_non_pwht	= "N/A";
				}

				if(isset($data['data_ndt_apwht']['1'][$data['data_visual'][$value['id_joint']]['id_visual']])) {
					$report_rt_pwht			= $data['data_ndt_apwht']['1'][$data['data_visual'][$value['id_joint']]['id_visual']]['report_number'];
					$date_rt						=	$data['data_ndt_apwht']['1'][$data['data_visual'][$value['id_joint']]['id_visual']]['date_of_inspection'];

					if($date_rt) {
						$date_rt_pwht	= date('Y-m-d', strtotime($date_rt));
					} else {
						$date_rt_pwht	= '';
					}

					$result_rt_2					= $data['data_ndt_apwht']['1'][$data['data_visual'][$value['id_joint']]['id_visual']]['result'];
					if($result_rt_2 == 3) {
						$result_rt_pwht	= "ACC";
					} elseif($result_rt_2 == 2) {
						$result_rt_pwht	= "REJECT";
					} else {
						$result_rt_pwht	= "N/A";
					}
				} else {
					$report_rt_pwht		= "";
					$date_rt_pwht			= "";
					$result_rt_pwht		= "";
				}


				// MAGNETIC PARTICLE NDT (PWHT OR NON PWHT)
					$report_magnetic_non_pwht	= $data['data_ndt']['2'][$data['data_visual'][$value['id_joint']]['id_visual']]['report_number'];
					$date_magnetic						=	$data['data_ndt']['2'][$data['data_visual'][$value['id_joint']]['id_visual']]['date_of_inspection'];

					if($date_magnetic) {
						$date_magnetic_non_pwht	= date('Y-m-d', strtotime($date_magnetic));
					} else {
						$date_magnetic_non_pwht	= '';
					}

					$result_magnetic_1				= $data['data_ndt']['2'][$data['data_visual'][$value['id_joint']]['id_visual']]['result'];
					if($result_magnetic_1 == 3) {
						$result_magnetic_non_pwht	= "ACC";
					} elseif($result_magnetic_1 == 2) {
						$result_magnetic_non_pwht	= "REJECT";
					} else {
						$result_magnetic_non_pwht	= "N/A";
					}

					if(isset($data['data_ndt_apwht']['2'][$data['data_visual'][$value['id_joint']]['id_visual']])) {
						$report_magnetic_pwht			= $data['data_ndt_apwht']['2'][$data['data_visual'][$value['id_joint']]['id_visual']]['report_number'];
						$date_magnetic						=	$data['data_ndt_apwht']['2'][$data['data_visual'][$value['id_joint']]['id_visual']]['date_of_inspection'];

						if($date_magnetic) {
							$date_magnetic_pwht	= date('Y-m-d', strtotime($date_magnetic));
						} else {
							$date_magnetic_pwht	= '';
						}

						$result_magnetic_2					= $data['data_ndt_apwht']['2'][$data['data_visual'][$value['id_joint']]['id_visual']]['result'];
						if($result_magnetic_2 == 3) {
							$result_magnetic_pwht	= "ACC";
						} elseif($result_magnetic_2 == 2) {
							$result_magnetic_pwht	= "REJECT";
						} else {
							$result_magnetic_pwht	= "N/A";
						}
					} else {
						$report_magnetic_pwht		= "";
						$date_magnetic_pwht			= "";
						$result_magnetic_pwht		= "";
					}

					// ULTRASONIC NDT (PWHT OR NON PWHT)
					$report_ut_non_pwht	= $data['data_ndt']['3'][$data['data_visual'][$value['id_joint']]['id_visual']]['report_number'];
					$date_ut						=	$data['data_ndt']['3'][$data['data_visual'][$value['id_joint']]['id_visual']]['date_of_inspection'];

					if($date_ut) {
						$date_ut_non_pwht	= date('Y-m-d', strtotime($date_ut));
					} else {
						$date_ut_non_pwht	= '';
					}

					$result_ut_1				= $data['data_ndt']['3'][$data['data_visual'][$value['id_joint']]['id_visual']]['result'];
					if($result_ut_1 == 3) {
						$result_ut_non_pwht	= "ACC";
					} elseif($result_ut_1 == 2) {
						$result_ut_non_pwht	= "REJECT";
					} else {
						$result_ut_non_pwht	= "N/A";
					}

					if(isset($data['data_ndt_apwht']['3'][$data['data_visual'][$value['id_joint']]['id_visual']])) {
						$report_ut_pwht			= $data['data_ndt_apwht']['3'][$data['data_visual'][$value['id_joint']]['id_visual']]['report_number'];
						$date_ut						=	$data['data_ndt_apwht']['3'][$data['data_visual'][$value['id_joint']]['id_visual']]['date_of_inspection'];

						if($date_ut) {
							$date_ut_pwht	= date('Y-m-d', strtotime($date_ut));
						} else {
							$date_ut_pwht	= '';
						}

						$result_ut_2					= $data['data_ndt_apwht']['3'][$data['data_visual'][$value['id_joint']]['id_visual']]['result'];
						if($result_ut_2 == 3) {
							$result_ut_pwht	= "ACC";
						} elseif($result_ut_2 == 2) {
							$result_ut_pwht	= "REJECT";
						} else {
							$result_ut_pwht	= "N/A";
						}
					} else {
						$report_ut_pwht		= "";
						$date_ut_pwht			= "";
						$result_ut_pwht		= "";
					}

					// HARDNESS NDT (PWHT OR NON PWHT)
					$report_hardness_non_pwht	= $data['data_ndt']['5'][$data['data_visual'][$value['id_joint']]['id_visual']]['report_number'];
					$date_hardness						=	$data['data_ndt']['5'][$data['data_visual'][$value['id_joint']]['id_visual']]['date_of_inspection'];

					if($date_hardness) {
						$date_hardness_non_pwht	= date('Y-m-d', strtotime($date_hardness));
					} else {
						$date_hardness_non_pwht	= '';
					}

					$result_hardness_1				= $data['data_ndt']['5'][$data['data_visual'][$value['id_joint']]['id_visual']]['result'];
					if($result_hardness_1 == 3) {
						$result_hardness_non_pwht	= "ACC";
					} elseif($result_hardness_1 == 2) {
						$result_hardness_non_pwht	= "REJECT";
					} else {
						$result_hardness_non_pwht	= "N/A";
					}


					// PENETRANT NDT (PWHT OR NON PWHT)
					$report_pt_non_pwht	= $data['data_ndt']['7'][$data['data_visual'][$value['id_joint']]['id_visual']]['report_number'];
					$date_pt						=	$data['data_ndt']['7'][$data['data_visual'][$value['id_joint']]['id_visual']]['date_of_inspection'];

					if($date_pt) {
						$date_pt_non_pwht	= date('Y-m-d', strtotime($date_pt));
					} else {
						$date_pt_non_pwht	= '';
					}

					$result_pt_1				= $data['data_ndt']['7'][$data['data_visual'][$value['id_joint']]['id_visual']]['result'];
					if($result_pt_1 == 3) {
						$result_pt_non_pwht	= "ACC";
					} elseif($result_pt_1 == 2) {
						$result_pt_non_pwht	= "REJECT";
					} else {
						$result_pt_non_pwht	= "N/A";
					}

					// PMI NDT (PWHT OR NON PWHT)
					$report_pmi_non_pwht	= $data['data_ndt']['8'][$data['data_visual'][$value['id_joint']]['id_visual']]['report_number'];
					$date_pmi						=	$data['data_ndt']['8'][$data['data_visual'][$value['id_joint']]['id_visual']]['date_of_inspection'];

					if($date_pmi) {
						$date_pmi_non_pwht	= date('Y-m-d', strtotime($date_pmi));
					} else {
						$date_pmi_non_pwht	= '';
					}

					$result_pmi_1				= $data['data_ndt']['8'][$data['data_visual'][$value['id_joint']]['id_visual']]['result'];
					if($result_pmi_1 == 3) {
						$result_pmi_non_pwht	= "ACC";
					} elseif($result_pmi_1 == 2) {
						$result_pmi_non_pwht	= "REJECT";
					} else {
						$result_pmi_non_pwht	= "N/A";
					}

					// PWHT NDT (PWHT OR NON PWHT)
					if(isset($data['data_ndt']['9'][$data['data_visual'][$value['id_joint']]['id_visual']])) {
						$status_pwht					= "YES";
						$report_pwht					= $data['data_ndt']['9'][$data['data_visual'][$value['id_joint']]['id_visual']]['report_number'];
						$date_pwht						=	$data['data_ndt']['9'][$data['data_visual'][$value['id_joint']]['id_visual']]['date_of_inspection'];

						if($date_pwht) {
							$date_pwht	= date('Y-m-d', strtotime($date_pwht));
						} else {
							$date_pwht	= '';
						}

						$result_pwht_1				= $data['data_ndt']['9'][$data['data_visual'][$value['id_joint']]['id_visual']]['result'];
						if($result_pwht_1 == 3) {
							$result_pwht	= "ACC";
						} elseif($result_pwht_1 == 2) {
							$result_pwht	= "REJECT";
						} else {
							$result_pwht	= "N/A";
						}
					} else {
						$status_pwht		= "NO";
						$report_pwht		= "";
						$date_pwht			= "";
						$result_pwht		= "";
					}

				$revision_category					= $value['revision_category'];
				$revision_no								= $value['revision'];
				$row->setCellValue('A'.$start, $number);
				$row->setCellValue('B'.$start, $data['data_template_joint'][$value['id_joint']]['drawing_no']);
				$row->setCellValue('C'.$start, $data['data_template_joint'][$value['id_joint']]['drawing_wm']);
				$row->setCellValue('D'.$start, $drawing_title);
				$row->setCellValue('E'.$start, $data['data_template_joint'][$value['id_joint']]['rev_wm']);
				$row->setCellValue('F'.$start, $data['data_template_joint'][$value['id_joint']]['joint_no']." ($revision_category$revision_no)");
				$row->setCellValue('G'.$start, $data['joint_type'][$data['data_template_joint'][$value['id_joint']]['joint_type']]);
				$row->setCellValue('H'.$start, $data['weld_type'][$data['data_template_joint'][$value['id_joint']]['weld_type']]);
				$row->setCellValue('I'.$start, $data['data_template_joint'][$value['id_joint']]['spool_no']);
				$row->setCellValue('J'.$start, $data['data_template_joint'][$value['id_joint']]['diameter']);
				$row->setCellValue('K'.$start, $data['data_template_joint'][$value['id_joint']]['thickness']);
				// POS 1
				$row->setCellValue('L'.$start, $data['data_template_joint'][$value['id_joint']]['pos_1']);
				$row->setCellValue('M'.$start, $data['data_template_piecemark'][$data['data_template_joint'][$value['id_joint']]['pos_1']]['item_code']);
				$row->setCellValue('N'.$start, $data['material'][$data['data_template_piecemark'][$data['data_template_joint'][$value['id_joint']]['pos_1']]['id']]['report_number']);
				$row->setCellValue('O'.$start, $data['material_grade'][$data['data_template_piecemark'][$data['data_template_joint'][$value['id_joint']]['pos_1']]['grade']]);
				$row->setCellValue('P'.$start, $data['qcs_material'][$data['mis_detail'][$data['material'][$data['data_template_piecemark'][$data['data_template_joint'][$value['id_joint']]['pos_1']]['id']]['id_mis']]['unique_no']]['unique_ident_no']);
				$row->setCellValue('Q'.$start, $data['qcs_material'][$data['mis_detail'][$data['material'][$data['data_template_piecemark'][$data['data_template_joint'][$value['id_joint']]['pos_1']]['id']]['id_mis']]['unique_no']]['heat_or_series_no']);
				$row->setCellValue('R'.$start, $data['data_template_piecemark'][$data['data_template_joint'][$value['id_joint']]['pos_1']]['sch']);

				// POS 2
				$row->setCellValue('S'.$start, $data['data_template_joint'][$value['id_joint']]['pos_2']);
				$row->setCellValue('T'.$start, $data['data_template_piecemark'][$data['data_template_joint'][$value['id_joint']]['pos_2']]['item_code']);
				$row->setCellValue('U'.$start, $data['material'][$data['data_template_piecemark'][$data['data_template_joint'][$value['id_joint']]['pos_2']]['id']]['report_number']);
				$row->setCellValue('V'.$start, $data['material_grade'][$data['data_template_piecemark'][$data['data_template_joint'][$value['id_joint']]['pos_2']]['grade']]);
				$row->setCellValue('W'.$start, $data['qcs_material'][$data['mis_detail'][$data['material'][$data['data_template_piecemark'][$data['data_template_joint'][$value['id_joint']]['pos_2']]['id']]['id_mis']]['unique_no']]['unique_ident_no']);
				$row->setCellValue('X'.$start, $data['qcs_material'][$data['mis_detail'][$data['material'][$data['data_template_piecemark'][$data['data_template_joint'][$value['id_joint']]['pos_2']]['id']]['id_mis']]['unique_no']]['heat_or_series_no']);
				$row->setCellValue('Y'.$start, $data['data_template_piecemark'][$data['data_template_joint'][$value['id_joint']]['pos_2']]['sch']);

				$row->setCellValue('Z'.$start, $value['report_number']);
				$row->setCellValue('AA'.$start, $fitup_date);
				$row->setCellValue('AB'.$start, $result_fitup);
				$row->setCellValue('AC'.$start, implode(", \n", $fitter_fitup_list));
				$row->setCellValue('AD'.$start, implode(", \n", $tack_weld_fitup_list));
				$row->setCellValue('AE'.$start, implode(", \n", $wps_list_fitup));
				$row->setCellValue('AF'.$start, $data['data_visual'][$value['id_joint']]['cons_lot_no']);
				$row->setCellValue('AG'.$start, $welded_date);
				$row->setCellValue('AH'.$start, implode(", \n", $welder_process_rh));
				$row->setCellValue('AI'.$start, implode(", \n", $welder_process_fc));
				$row->setCellValue('AJ'.$start, implode(", \n", $welder_id_rh_list));
				$row->setCellValue('AK'.$start, implode(", \n", $welder_id_fc_list));
				$row->setCellValue('AL'.$start, $data['data_visual'][$value['id_joint']]['report_number']);
				$row->setCellValue('AM'.$start, $visual_date);
				$row->setCellValue('AN'.$start, $result_visual);

				$row->setCellValue('AO'.$start, $report_magnetic_non_pwht);
				$row->setCellValue('AP'.$start, $date_magnetic_non_pwht);
				$row->setCellValue('AQ'.$start, $result_magnetic_non_pwht);

				$row->setCellValue('AR'.$start, $report_pt_non_pwht);
				$row->setCellValue('AS'.$start, $date_pt_non_pwht);
				$row->setCellValue('AT'.$start, $result_pt_non_pwht);

				$row->setCellValue('AU'.$start, $report_ut_non_pwht);
				$row->setCellValue('AV'.$start, $date_ut_non_pwht);
				$row->setCellValue('AW'.$start, $result_ut_non_pwht);

				$row->setCellValue('AX'.$start, $report_rt_non_pwht);
				$row->setCellValue('AY'.$start, $date_rt_non_pwht);
				$row->setCellValue('AZ'.$start, $result_rt_non_pwht);

				$row->setCellValue('BA'.$start, $report_pmi_non_pwht);
				$row->setCellValue('BB'.$start, $date_pmi_non_pwht);
				$row->setCellValue('BC'.$start, $result_pmi_non_pwht);

				$row->setCellValue('BD'.$start, $status_pwht == "YES" ? $status_pwht : "");
				$row->setCellValue('BE'.$start, $status_pwht == "NO" ? $status_pwht : "");

				$row->setCellValue('BF'.$start, $report_pwht);
				$row->setCellValue('BG'.$start, $date_pwht);
				$row->setCellValue('BH'.$start, $result_pwht);

				$row->setCellValue('BI'.$start, $report_magnetic_pwht);
				$row->setCellValue('BJ'.$start, $date_magnetic_pwht);
				$row->setCellValue('BK'.$start, $result_magnetic_pwht);

				$row->setCellValue('BL'.$start, $report_rt_pwht);
				$row->setCellValue('BM'.$start, $date_rt_pwht);
				$row->setCellValue('BN'.$start, $result_rt_pwht);

				$row->setCellValue('BO'.$start, $report_ut_pwht);
				$row->setCellValue('BP'.$start, $date_ut_pwht);
				$row->setCellValue('BQ'.$start, $result_ut_pwht);

				$row->setCellValue('BR'.$start, $report_hardness_non_pwht);
				$row->setCellValue('BS'.$start, $date_hardness_non_pwht);
				$row->setCellValue('BT'.$start, $result_hardness_non_pwht);

				$row->setCellValue('BU'.$start, $value);
				$row->setCellValue('BV'.$start, $data['data_template_joint'][$value['id_joint']]['test_pack_no']);
			
				$objPHPExcel->getActiveSheet()->getStyle('AC'.$start)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('AD'.$start)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('AE'.$start)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('AH'.$start)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('AI'.$start)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('AJ'.$start)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('AK'.$start)->getAlignment()->setWrapText(true);

				$objPHPExcel->getActiveSheet()->getStyle('E'.$start)->setQuotePrefix(true);
				$objPHPExcel->getActiveSheet()->getStyle('N'.$start)->setQuotePrefix(true);
				$objPHPExcel->getActiveSheet()->getStyle('U'.$start)->setQuotePrefix(true);
				$objPHPExcel->getActiveSheet()->getStyle('Z'.$start)->setQuotePrefix(true);
				$objPHPExcel->getActiveSheet()->getStyle('AL'.$start)->setQuotePrefix(true);

				$objPHPExcel->getActiveSheet()->getStyle('A'.$start.':BV'.$start)->applyFromArray($styleArray);
				unset($styleArray);

				$number++;
				$start++;
			}

			for ($i = 'A'; $i !== 'L'; $i++){
				$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
			}
			$objPHPExcel->getActiveSheet()->calculateColumnWidths();

			for ($i = 'A'; $i !== 'L'; $i++){
				$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(false);
			}

			for ($i = 'A'; $i !== 'L'; $i++){
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells($i.'4:'.$i.'6');
			}

			// MATERIAL TRACEABILITY
			for ($i = 'L'; $i !== 'AC'; $i++){
				$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
			}
			// FOR FITUP
			for ($i = 'Z'; $i !== 'AD'; $i++){
				$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
			}

			for ($i = 'AC'; $i !== 'BV'; $i++){
				$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
			}
			$objPHPExcel->getActiveSheet()->calculateColumnWidths();

			for ($i = 'AC'; $i !== 'BV'; $i++){
				$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(false);
			}

			for ($i = 'AC'; $i !== 'AH'; $i++){
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells($i.'4:'.$i.'6');
			}

			for ($i = 'BU'; $i !== 'BW'; $i++){
				$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
			}
			$objPHPExcel->getActiveSheet()->calculateColumnWidths();

			for ($i = 'BU'; $i !== 'BW'; $i++){
				$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(false);
			}

			for ($i = 'BU'; $i !== 'BW'; $i++){
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells($i.'4:'.$i.'6');
			}

			$objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(10);
			// for ($i = 'A'; $i !== 'BW'; $i++){
			// 	$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header("Content-Disposition: attachment;filename=Export Overall WTR Piping.xlsx");
			header('Cache-Control: max-age=0');
			header('Cache-Control: max-age=1');
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
			header ('Cache-Control: cache, must-revalidate'); 
			header ('Pragma: public'); // HTTP/1.0
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
			unset($objPHPExcel);
		} elseif($submit == "pdf") {

			$this->load->library('pdf');

			$html	 					= $this->load->view('wtr/wtr_piping_list_detail_overall', $data, true);
			$this->pdf->generate_pdf_landscape($html, "WTR-PIPING");
		}
		
	}

// ADDITIONAL FUNCTION

public function module_list_by_project() {
	$project_id									= $this->input->post('project_id');
	$where['project_id']				= $project_id;
	$data_module								= $this->general_mod->module($where);
	unset($where);

	echo json_encode($data_module);
}


public function wtr_list(){

		$data['post']   = $this->input->post();

		$datadb = $this->general_mod->material_grade();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$data["material_grade"][$value['id']] = $value;
		}	

		$datadb  = $this->general_mod->portal_user_get_db();
		foreach ($datadb as $value) {
			$user_list[$value['id_user']] = $value['full_name'];
			$data["user_list"][$value['id_user']] = $value['full_name'];
		}	
	
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

		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['mod_desc']] = $value;
			$data['module_code'][$value['mod_id']] = $value['mod_desc'];
		}
		$data['module_list'] = $module_list;

		$datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['project_code']] = $value;
			$data['project_code'][$value['id']] = $value['project_code'];
		}
		$data['project_list'] = $project_list;

		$datadb = $this->general_mod->drawing_type();
		$drawing_type_list = [];
		foreach ($datadb as $key => $value) {
			$drawing_type_list[$value['code']] = $value;
		}
		$data['drawing_type_list'] = $drawing_type_list;

		$datadb = $this->wtr_mod->warehouse_mis_mrir();
		foreach ($datadb as $key => $value) {
			$data['warehouse_mis_mrir'][$value['id_mis_det']] = $value;
		}

		$datadb = $this->wtr_mod->fitter_code();
		foreach ($datadb as $key => $value) {
			$data['fitter_code_arr'][$value['id_fitter']] = $value['fit_up_badge'];
		}

		$datadb = $this->wtr_mod->welder_code();
		foreach ($datadb as $key => $value) {
			$data['welder_code_arr'][$value['id_welder']] = $value['wel_code'];
		}

		$datadb = $this->wtr_mod->wps_code();
		foreach ($datadb as $key => $value) {
			$data['wps_code_arr'][$value['id_wps']] = $value['wps_code'];
		}

		$datadb = $this->wtr_mod->area_name();
		foreach ($datadb as $key => $value) {
			$area_name_list[$value['area_name']] = $value;
			$data['area_name_arr'][$value['id']] = $value['area_name'];
		}
		$data['area_name_list'] = $area_name_list;

		if(isset($data['post']['project']) AND !empty($data['post']['project'])){
		$where["project"] 	= $data['post']['project'];
		} else {
		$where["project"]  	= $this->user_cookie[10];
		}

		if(isset($data['post']['drawing_no']) AND !empty($data['post']['drawing_no'])){
		$where["drawing_no"]   		= $data['post']['drawing_no'];
		}

		if(isset($data['post']['discipline']) AND !empty($data['post']['discipline'])){
			$where["discipline"]  		= $data['post']['discipline'];
		} else {
			$where["discipline"]  		= "2";
		}

		if(isset($data['post']['module']) AND !empty($data['post']['module'])){
		$where["module"]   	   		= $data['post']['module'];
		}

		if(isset($data['post']['type_of_module']) AND !empty($data['post']['type_of_module'])){
		$where["type_of_module"]   	= $data['post']['type_of_module'];
		} else {
		$where["type_of_module IS NOT NULL"]   	= NULL;	
		}

		if(isset($data['post']['drawing_type']) AND !empty($data['post']['drawing_type'])){
		$where["drawing_type"]   	= $data['post']['drawing_type'];
		}

		$data['wtr_list']  = $this->wtr_mod->wtr_drawing_list($where);			

		$data['user_cookie'] 	 = $this->user_cookie;
		$data['user_permission'] = $this->permission_cookie;
		$data['meta_title']  	 = 'WTR Drawing List';
		$data['subview']     	 = 'wtr/wtr_list';
    	$data['sidebar']     	 = $this->sidebar;
		$this->load->view('index', $data);


	}

	public function wtr_list_detail($project,$drawing_no,$drawing_type,$discipline,$module,$type_of_module,$pdf = null){

		$project 		= $this->encryption->decrypt(strtr($project, '.-~', '+=/'));
		$drawing_no 	= $this->encryption->decrypt(strtr($drawing_no, '.-~', '+=/'));
		$drawing_type 	= $this->encryption->decrypt(strtr($drawing_type, '.-~', '+=/'));
		$discipline 	= $this->encryption->decrypt(strtr($discipline, '.-~', '+=/'));
		$module 		= $this->encryption->decrypt(strtr($module, '.-~', '+=/'));
		$type_of_module = $this->encryption->decrypt(strtr($type_of_module, '.-~', '+=/'));
		if(isset($pdf)){
			$pdf = $this->encryption->decrypt(strtr($pdf, '.-~', '+=/'));
		} else {
			$pdf = null;
		}

		
  		$datadb = $this->wtr_mod->module_list();
  		foreach ($datadb as $key => $value) {
  			$data['module_list'][$value['mod_id']] = $value;
  		}

		$datadb = $this->general_mod->material_grade();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$data["material_grade"][$value['id']] = $value;
		}	

		$datadb  = $this->general_mod->portal_user_get_db();
		foreach ($datadb as $value) {
			$user_list[$value['id_user']] = $value['full_name'];
			$data["user_list"][$value['id_user']] = $value['full_name'];
		}	
	
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

		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['mod_desc']] = $value;
			$data['module_code'][$value['mod_id']] = $value['mod_desc'];
		}
		$data['module_list'] = $module_list;

		$datadb = $this->general_mod->project();
		$project_list = [];
		foreach ($datadb as $key => $value) {
			$project_list[$value['project_code']] = $value;
			$data['project_code'][$value['id']]   = $value['project_code'];
			$data['project_name'][$value['id']]   = $value['project_name'];
			$data['project_client'][$value['id']] = $value['client'];
			$data['project_client_logo'][$value['id']] = $value['client_logo'];
			$data['project_client_description'][$value['id']] = $value['description'];
		}
		$data['project_list'] = $project_list;

		$datadb = $this->general_mod->drawing_type();
		$drawing_type_list = [];
		foreach ($datadb as $key => $value) {
			$drawing_type_list[$value['code']] = $value;
		}
		$data['drawing_type_list'] = $drawing_type_list;

		$datadb = $this->wtr_mod->warehouse_mis_mrir();
		foreach ($datadb as $key => $value) {
			$data['warehouse_mis_mrir'][$value['id_mis_det']] = $value;
		}

		$datadb = $this->wtr_mod->fitter_code();
		foreach ($datadb as $key => $value) {
			$data['fitter_code_arr'][$value['id_fitter']] = $value['fit_up_badge'];
		}

		$datadb = $this->general_mod->fitter_list();
		foreach ($datadb as $key => $value) {
			$master_fitter[$value['id_fitter']] = $value;
		}
		$data['master_fitter'] = $master_fitter;


		$datadb = $this->wtr_mod->welder_code();
		foreach ($datadb as $key => $value) {
			$data['welder_code_arr'][$value['id_welder']] = $value['wel_code'];
		}

		$datadb = $this->wtr_mod->wps_code();
		foreach ($datadb as $key => $value) {
			$data['wps_code_arr'][$value['id_wps']] = $value['wps_code'];
		}

		$datadb = $this->wtr_mod->area_name();
		foreach ($datadb as $key => $value) {
			$area_name_list[$value['area_name']] = $value;
			$data['area_name_arr'][$value['id']] = $value['area_name'];
		}
		$data['area_name_list'] = $area_name_list;

		$datadb = $this->general_mod->weld_type();
		foreach ($datadb as $key => $value) {
			$master_weld_type[$value['id']] = $value;
		}
		$data['master_weld_type'] = $master_weld_type;

		
		$datadb = $this->general_mod->welder_list();
		foreach ($datadb as $key => $value) {
			$master_welder[$value['id_welder']] = $value;
		}
		$data['master_welder'] = $master_welder;


		$where['project_id']   	 = $project;
		$where['discipline']  	 = $discipline;
		$where['module']	  	 = $module;
		$where['document_no'] 	 = $drawing_no;
		//$where['type_of_module'] = $type_of_module;
		$where['drawing_type'] 	 = $drawing_type;
		$datadb = $this->wtr_mod->data_drawing_list($where);
		unset($where);
		if (sizeof($datadb) > 0) {
			foreach ($datadb as $key => $value) {
				//$drawing_detail[$value['project_id']][$value['document_no']][$value['drawing_type']][$value['discipline']][$value['module']][$value['type_of_module']] = $value;
				$drawing_detail[$value['project_id']][$value['document_no']][$value['drawing_type']][$value['discipline']][$value['module']] = $value;
			}
			$data['drawing_detail'] = $drawing_detail;			
		} else {
			$data['drawing_detail'] = NULL;
		}

		$where_ndt["b.project_code"] 	= $project;	
		$where_ndt["b.drawing_no"]   	= $drawing_no;		
		$where_ndt["b.discipline"]  	= $discipline;	
		$where_ndt["b.module"]   	   	= $module;		
		$where_ndt["b.type_of_module"]  = $type_of_module;		
		$where_ndt["b.drawing_type"]   	= $drawing_type;

		$ndt = $this->wtr_mod->ndt_list_data_m($where_ndt);

		//$ndt = $this->wtr_mod->ndt_list(null);
  		foreach ($ndt as $key => $value) {
  			if($value['pwht_status']>0){
  				$data['ndt'][$value['id_visual']][$value['ndt_type']] = $value;
  			} else {
  				$data['ndt_apwht'][$value['id_visual']][$value['ndt_type']] = $value;
  			}
  		}
  		unset($where_ndt);
		
		$where["a.project"] 		= $project;	
		$where["a.drawing_no"]   	= $drawing_no;		
		$where["a.discipline"]  	= $discipline;	
		$where["a.module"]   	   	= $module;		
		$where["a.type_of_module"]  = $type_of_module;		
		$where["a.drawing_type"]   	= $drawing_type;

		$data['wtr_list']  = $this->wtr_mod->wtr_all_of_joint_list($where);	
		unset($where);
		
		$where["a.project"] 		= $project;
		$where["a.discipline"] 		= $discipline;
		$where["a.module"] 			= $module;
		$where["a.type_of_module"] 	= $type_of_module;
		// if($drawing_type == '1'){
		// 	$where["a.drawing_ga"] = $drawing_no;
		// } else { 
		// 	$where["a.drawing_as"] = $drawing_no;	
		// }
		$datadb  = $this->wtr_mod->piecemark_list_m($where);
		foreach ($datadb as $key => $value) {
			$data['status_piecemark'][$value['part_id']] = $value;
		}
		unset($where);

		$data["project"] 		 = $project;	
		$data["drawing_no"]   	 = $drawing_no;		
		$data["discipline"]  	 = $discipline;	
		$data["module"]   	   	 = $module;		
		$data["type_of_module"]  = $type_of_module;		
		$data["drawing_type"]    = $drawing_type;

		$data['user_cookie'] 	 = $this->user_cookie;
		$data['user_permission'] = $this->permission_cookie;
		$data['meta_title']  	 = 'WTR Drawing List';

		if(isset($pdf) AND $pdf == 'pdf'){

			$this->load->library('pdf');
			$html = $this->load->view('wtr/wtr_list_detail_pdf', $data, TRUE);
			$this->pdf->generate_pdf_A3_L($html, 'WTR-Piping');

			//$html = $this->load->view('wtr/wtr_list_detail_pdf', $data);
		} else {

			$data['subview']     	 = 'wtr/wtr_list_detail';
	    	$data['sidebar']     	 = $this->sidebar;
			$this->load->view('index', $data);

		}


	}

}