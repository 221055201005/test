<?php
$main = $list[0];
// test_var($main);
$input_class  = "w-100";


$company_id 			= $joint_list[$main["id_joint"]]['company_id'];
$deck_elevation		= $joint_list[$main["id_joint"]]['deck_elevation'];

$is_disabled 			= '';
$allow_update			= true;
$is_none					= '';

if ($this->user_cookie[7] == 8) {
	$is_disabled 	= "disabled";
	$allow_update = false;
	$is_none 			= 'hidden';
} else if (in_array($this->user_cookie[11], [1,2217]) || ($user_permission[218] == 1)) {
	if ($main['client_by']) {
		$is_disabled 	= "disabled";
		$allow_update = false;
	}
} else {
	if ($main['qc_by']) {
		$is_disabled 	= "disabled";
		$allow_update = false;
	}
}

$is_signable = true;
$check_sign_data = ['grade_material', 'part_name', 'size_part', 'sch', 'matl_type', 'matl_thk', 'unit_matl_thk', 'weld_thk', 'unit_weld_thk', 'reinforc_thk', 'unit_reinforc_thk', 'backing_ring', 'matl_type', 'manufacture', 'type_of_film', 'dimension', 'total_of_film', 'thickness', 'unit_thickness', 'geometric_unsharpness', 'technique_sketch', 'marker_placement', 'type_of_penetrameter', 'activity_kv', 'current_a', 'size_focal_spot', 'sfd', 'exposure_time', 'min_sod', 'min_dssof', 'block_thickness', 'isotope', 'technique', 'exposure', 'viewing', 'no_film_holder', 'type_of_penetrameter', 'wire_no', 'placement', 'marker_placement', 'use_back_scatter', 'technique_sketch'];
// $check_sign_data = ['grade_material', 'sc_as_welded', 'sc_brush_cleaned', 'sc_ground_flush', 'sc_others', 'es_after_weld', 'es_after_pwht', 'es_after_repair', 'part_name', 'size_part', 'sch', 'matl_type', 'matl_thk', 'unit_matl_thk', 'weld_thk', 'unit_weld_thk', 'reinforc_thk', 'unit_reinforc_thk', 'backing_ring', 'matl_type', 'manufacture', 'type_of_film', 'dimension', 'total_of_film', 'thickness', 'unit_thickness', 'geometric_unsharpness', 'technique_sketch', 'marker_placement', 'type_of_penetrameter', 'activity_kv', 'current_a', 'size_focal_spot', 'sfd', 'exposure_time', 'min_sod', 'min_dssof', 'block_thickness', 'isotope', 'technique', 'exposure', 'viewing', 'no_film_holder', 'type_of_penetrameter', 'wire_no', 'placement', 'marker_placement', 'use_back_scatter', 'technique_sketch'];
foreach ($check_sign_data as $key => $value) {
	if ($main[$value] == '') {
		$is_signable = false;
	}
}

$arr_delivery = [];
foreach ($mrir_list as $key => $value) {
	$arr_delivery[] = $value['delivery_condition'];
}
$arr_delivery   = array_unique(array_filter($arr_delivery));

?>
<br />
<div id="content">
	<div class="container-fluid">
		<div class="row mt-3">
			<div class="col-md-auto">
				<ul class="p-1 bg-white shadow-sm text-left nav nav-pills nav-fill  font-weight-bold" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link <?= $tab == 'report' ? 'active' : '' ?>" data-toggle="tab" id="report-tab" href="#report" role="tab" aria-controls="report" aria-selected="true">Report</a>
					</li>

					<li class="nav-item">
						<a class="nav-link <?= $tab == 'deffect' ? 'active' : '' ?>" data-toggle="tab" id="deffect-tab" href="#deffect" role="tab" aria-controls="deffect" aria-selected="false">Deffect</a>
					</li>

					<li class="nav-item">
						<a class="nav-link <?= $tab == 'attachment' ? 'active' : '' ?>" data-toggle="tab" id="attachment-tab" href="#attachment" role="tab" aria-controls="attachment" aria-selected="false">Attachment</a>
					</li>

				</ul>
			</div>

			<div class="col-md-12">
				<br>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade <?= $tab == 'report' ? ' show active' : '' ?>" id="report" role="tabpanel" aria-labelledby="report-tab">
						<div class="card border-0 shadow">
							<div class="card-body p-0 overflow-auto">
								<form action="<?= site_url('ndt_live/ndt_rt_update_process') ?>" method="post">
									<input type="hidden" name="uniq_id_report" value="<?= $main['uniq_id_report'] ?>">
									<div id="report_rt">
										<style>
											#report_rt_content {
												border: 0px solid #000;
											}

											table {
												margin: 0;
												width: 100%;
												color: #212529;
												border-collapse: collapse;
											}

											table td {
												border: 1px solid #212529;
												border-bottom: 0px;
												padding: 0.3rem;
												vertical-align: top;
											}

											table input {
												vertical-align: middle;
											}

											table:last-child td {
												border: 1px solid #212529;
												border-bottom: 1px solid #212529;
											}

											thead td {
												font-weight: bold;
												vertical-align: middle;
											}

											.col-nowrap {
												width: 1%;
												white-space: nowrap;
											}

											.col-title {
												font-weight: bold;
											}

											.col-33 {
												width: 33.33%;
											}

											.col-table-inner {
												padding: 0px;
											}

											.col-table-inner table td,
											.col-table-inner table th {
												border: 0px;
											}

											.col-table-inner table {
												border-bottom: 1px solid #212529;
											}

											.col-table-inner table:last-child {
												border-bottom: 0px;
											}

											.col-table-inner.border-bottom table tr:not(:last-child) td {
												border-bottom: 1px solid #212529;
											}

											label {
												margin: 0px;
											}

											h4 {
												margin: 0;
											}
										</style>
										<div id="report_rt_content">
											<!-- HEADER -->
											<table>
												<tr>
													<td class="col-table-inner">
														<table>
															<thead>
																<tr>
																	<td width="25%" class="text-left">
																		<img style="width:5cm" src="<?= base_url() ?>img/seatrium-logo.png" alt="">
																	</td>
																	<td width="50%" class="text-center">
																		<h3><strong><?= $project[$main['id_project']]['description'] ?></strong></h3>
																	</td>

																	<td width="25%" class="text-right">
																		<img src="<?= $project[$main['id_project']]['client_logo'] ?>" style='width: 4.5cm; height:2cm;vertical-align: text-bottom !important;' />
																	</td>
																</tr>
															</thead>
														</table>
														<table>
															<thead>
																<tr>
																	<td class="col-title text-center">
																		<h4>RADIOGRAPHIC TEST REPORT</h4>
																	</td>
																</tr>
															</thead>
														</table>
													</td>
												</tr>
											</table>
											<!-- MAIN INFORMATION -->
											<table>
												<tbody>
													<tr>
														<td class="col-table-inner border-bottom">
															<table>
																<tr>
																	<td class="col-title col-nowrap">CLIENT</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><?= $project[$main['id_project']]['client'] ?></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Project Name</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><?= $project[$main['id_project']]['project_name'] ?></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Standard / Code</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><?= $acceptance_criteria_form[$main['id_project']][$joint_list[$main['id_joint']]['company_id']][$main['discipline']][$main['module']][$main['type_of_module']][$joint_list[$main['id_joint']]['class']]['ndt']['rt']['standard_code'] ?></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Acceptance Criteria</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><?= $acceptance_criteria_form[$main['id_project']][$joint_list[$main['id_joint']]['company_id']][$main['discipline']][$main['module']][$main['type_of_module']][$joint_list[$main['id_joint']]['class']]['ndt']['rt']['acceptance_criteria'] ?></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Procedure No.</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><?= $acceptance_criteria_form[$main['id_project']][$joint_list[$main['id_joint']]['company_id']][$main['discipline']][$main['module']][$main['type_of_module']][$joint_list[$main['id_joint']]['class']]['ndt']['rt']['procedure'] ?> Rev.<?= $acceptance_criteria_form[$main['id_project']][$joint_list[$main['id_joint']]['company_id']][$main['discipline']][$main['module']][$main['type_of_module']][$joint_list[$main['id_joint']]['class']]['ndt']['rt']['procedure_rev'] ?></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">GA/ASSY/ISOMETRIC Drawing No.</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><?= $main['drawing_no'] ?> Rev.<?= $main['drawing_rev_no'] ?><br>
																	<?php if (isset($data_drawing[$main['drawing_no']])) { ?>
																		<?php
																		$links_atc = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($data_drawing[$main['drawing_no']]['id']), '+=/', '.-~') . "/" . $main['drawing_rev_no'];
																		// test_var($data_drawing[$main['drawing_no']]['id'], 1);
																		?>
																		<a target='_blank' href='<?= $links_atc ?>' title='Attachment'> <i class='fas fa-paperclip'></i> ( Open Drawing )  </a>
																	<?php } ?>
																</td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Job Description</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><textarea rows="3" name="job_desc" class="<?= $input_class ?>" <?= $is_disabled ?>><?= $main['job_desc'] == '' ? $data_drawing[$main['drawing_no']]['title'] : $main['job_desc'] ?></textarea></td>
																</tr>
															</table>
														</td>
														<td class="col-table-inner border-bottom">
															<table>
																<tr>
																	<td class="col-title col-nowrap">REPORT NO.</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="report_no" class="<?= $input_class ?>" value="<?= $main['report_no'] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">RFI NO.</td>
																	<td class="col-title col-nowrap">:</td>
																	<td>
																		<?php

																		if (in_array($main['id_project'], project_by_deck())) {
																			$rfi_prefix = $report_form[$main['id_project']][$company_id][$main['discipline']][$main['module']][$main['type_of_module']][$deck_elevation];
																		} else {
																			$rfi_prefix = $report_form[$main['id_project']][$company_id][$main['discipline']][$main['module']][$main['type_of_module']];
																		}

																		?>
																		<?= $rfi_prefix . '-RT-' . str_pad($main['rfi_no'], 6, 0, STR_PAD_LEFT) ?>
																	</td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">PAGE NO.</td>
																	<td class="col-title col-nowrap">:</td>
																	<td>1 of 1</td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Date Of Inspection</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="date" name="date_of_inspection" class="<?= $input_class ?>" value="<?= date('Y-m-d', strtotime($main['date_of_inspection'])) ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Date Of RFI</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><?= date('Y-m-d', strtotime($main['transmittal_inspection_datetime'])) ?></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Testing Location</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="testing_location" class="<?= $input_class ?>" value="<?= $main['testing_location'] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Job No.</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="job_no" class="<?= $input_class ?>" value="<?= $main['job_no'] == "" ? "2013J310012" : $main['job_no'] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Grade Material</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="grade_material" class="<?= $input_class ?>" value="<?= $main['grade_material'] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Delivery Condition</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="delivery_condition" class="<?= $input_class ?>" value="<?= $main["delivery_condition"] == "" ? implode(", ", $arr_delivery) : $main["delivery_condition"] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">PWHT Status</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="status_pwht" class="<?= $input_class ?>" value="<?= $main['status_pwht'] == "" ? "N/A" : $main['status_pwht'] ?>" <?= $is_disabled ?>></td>
																</tr>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
											<!-- NDT RT DETAIL INFORMATION -->
											<table>
												<tbody>
													<tr>
														<td class="col-33 col-table-inner">
															<table>
																<tr>
																	<td class="col-title text-center">
																		Surface Condition
																	</td>
																</tr>
															</table>
															<table>
																<tr>
																	<td class="col-title col-nowrap">As Welded</td>
																	<td class="col-title col-nowrap">:</td>
																	<td>
																		<label>
																			<input type="checkbox" <?= $is_disabled ?> name="sc_as_welded" value="YES" <?= $main['sc_as_welded'] == "YES" ? 'checked' : '' ?>>
																		</label>
																	</td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Brush Cleaned</td>
																	<td class="col-title col-nowrap">:</td>
																	<td>
																		<label>
																			<input type="checkbox" <?= $is_disabled ?> name="sc_brush_cleaned" value="YES" <?= $main['sc_brush_cleaned'] == "YES" ? 'checked' : '' ?>>
																		</label>
																	</td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Ground Flush</td>
																	<td class="col-title col-nowrap">:</td>
																	<td>
																		<label>
																			<input type="checkbox" <?= $is_disabled ?> name="sc_ground_flush" value="YES" <?= $main['sc_ground_flush'] == "YES" ? 'checked' : '' ?>>
																		</label>
																	</td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Others</td>
																	<td class="col-title col-nowrap">:</td>
																	<td>
																		<label>
																			<input type="checkbox" <?= $is_disabled ?> name="sc_others" value="YES" <?= $main['sc_others'] == "YES" ? 'checked' : '' ?>>
																		</label>
																	</td>
																</tr>
															</table>
															<table>
																<tr>
																	<td class="col-title text-center">
																		Examination Stage
																	</td>
																</tr>
															</table>
															<table>
																<tr>
																	<td class="col-title col-nowrap">After Weld Completely Cooled</td>
																	<td class="col-title col-nowrap">:</td>
																	<td>
																		<label>
																			<input type="checkbox" <?= $is_disabled ?> name="es_after_weld" value="YES" <?= $main['es_after_weld'] == "YES" ? 'checked' : '' ?>>
																		</label>
																	</td>

																</tr>
																<tr>
																	<td class="col-title col-nowrap">After PWHT</td>
																	<td class="col-title col-nowrap">:</td>
																	<td>
																		<label>
																			<input type="checkbox" <?= $is_disabled ?> name="es_after_pwht" value="YES" <?= $main['es_after_pwht'] == "YES" ? 'checked' : '' ?>>
																		</label>
																	</td>

																</tr>
																<tr>
																	<td class="col-title col-nowrap">After Repair (Grinding)</td>
																	<td class="col-title col-nowrap">:</td>
																	<td>
																		<label>
																			<input type="checkbox" <?= $is_disabled ?> name="es_after_repair" value="YES" <?= $main['es_after_repair'] == "YES" ? 'checked' : '' ?>>
																		</label>
																	</td>

																</tr>
															</table>
															<table>
																<tr>
																	<td class="col-title text-center">
																		PART
																	</td>
																</tr>
															</table>
															<table>
																<tr>
																	<td class="col-title col-nowrap">Name</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="part_name" class="<?= $input_class ?>" value="<?= $main['part_name'] == "" ? "N/A" : $main['part_name'] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Size / ID / OD</td>
																	<td class="col-title col-nowrap">:</td>
																	<td class="col-table-inner">
																		<table>
																			<tr>
																				<td><input type="text" name="size_part" class="<?= $input_class ?>" value="<?= $main['size_part'] == "" ? $joint_list[$main['id_joint']]['diameter'] : $main['size_part'] ?>" <?= $is_disabled ?>></td>
																				<td class="col-nowrap">mm/inch</td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Sch</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="sch" class="<?= $input_class ?>" value="<?= $main['sch'] == "" ? $joint_list[$main['id_joint']]['sch'] : $main['sch'] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Mat'l Type</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="matl_type" class="<?= $input_class ?>" value="<?= $main['matl_type'] == "" ? "N/A" : $main['matl_type'] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Mat'l Thk.</td>
																	<td class="col-title col-nowrap">:</td>
																	<td class="col-table-inner">
																		<table>
																			<tr>
																				<td><input type="text" name="matl_thk" class="<?= $input_class ?>" value="<?= $main['matl_thk'] == "" ? "N/A" : $main['matl_thk'] ?>" <?= $is_disabled ?>></td>
																				<td class="col-nowrap">
																					<label>
																						<input type="radio" <?= $is_disabled ?> name="unit_matl_thk" value="1" <?= $main['unit_matl_thk'] == '1' ? 'checked' : '' ?>>
																						In
																					</label>
																					<label>
																						<input type="radio" <?= $is_disabled ?> name="unit_matl_thk" value="2" <?= $main['unit_matl_thk'] == '2' ? 'checked' : '' ?>>
																						mm
																					</label>
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Weld Thk.</td>
																	<td class="col-title col-nowrap">:</td>
																	<td class="col-table-inner">
																		<table>
																			<tr>
																				<td><input type="text" name="weld_thk" class="<?= $input_class ?>" value="<?= $main['weld_thk'] == "" ? $joint_list[$main['id_joint']]['thickness'] : $main['weld_thk'] ?>" <?= $is_disabled ?>></td>
																				<td class="col-nowrap">
																					<label>
																						<input type="radio" <?= $is_disabled ?> name="unit_weld_thk" value="1" <?= $main['unit_weld_thk'] == '1' ? 'checked' : '' ?>>
																						In
																					</label>
																					<label>
																						<input type="radio" <?= $is_disabled ?> name="unit_weld_thk" value="2" <?= $main['unit_weld_thk'] == '2' ? 'checked' : '' ?>>
																						mm
																					</label>
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Reinforc. Thk.</td>
																	<td class="col-title col-nowrap">:</td>
																	<td class="col-table-inner">
																		<table>
																			<tr>
																				<td><input type="text" name="reinforc_thk" class="<?= $input_class ?>" value="<?= $main['reinforc_thk'] == "" ? "N/A" : $main['reinforc_thk'] ?>" <?= $is_disabled ?>></td>
																				<td class="col-nowrap">
																					<label>
																						<input type="radio" <?= $is_disabled ?> name="unit_reinforc_thk" value="1" <?= $main['unit_reinforc_thk'] == '1' ? 'checked' : '' ?>>
																						In
																					</label>
																					<label>
																						<input type="radio" <?= $is_disabled ?> name="unit_reinforc_thk" value="2" <?= $main['unit_reinforc_thk'] == '2' ? 'checked' : '' ?>>
																						mm
																					</label>
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Backing Ring</td>
																	<td class="col-title col-nowrap">:</td>
																	<td>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="backing_ring" value="1" <?= $main['backing_ring'] == '1' ? 'checked' : '' ?>>
																			Yes
																		</label>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="backing_ring" value="2" <?= $main['backing_ring'] == '2' ? 'checked' : '' ?>>
																			No
																		</label>
																	</td>
																</tr>
															</table>
															<table>
																<tr>
																	<td class="col-title text-center">
																		FILM
																	</td>
																</tr>
															</table>
															<table>
																<tr>
																	<td class="col-title col-nowrap">Manufacture's</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="manufacture" class="<?= $input_class ?>" value="<?= $main['manufacture'] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Type of Film</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="type_of_film" class="<?= $input_class ?>" value="<?= $main['type_of_film'] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Dimension</td>
																	<td class="col-title col-nowrap">:</td>
																	<td class="col-table-inner">
																		<table>
																			<tr>
																				<td><input type="text" name="dimension" class="<?= $input_class ?>" value="<?= $main['dimension'] ?>" <?= $is_disabled ?>></td>
																				<td class="col-nowrap">In</td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Total of Film</td>
																	<td class="col-title col-nowrap">:</td>
																	<td class="col-table-inner">
																		<table>
																			<tr>
																				<td><input type="text" name="total_of_film" class="<?= $input_class ?>" value="<?= $main['total_of_film'] ?>" <?= $is_disabled ?>></td>
																				<td class="col-nowrap">Sheet(s)</td>
																			</tr>
																		</table>
																	</td>
																</tr>
															</table>
															<table>
																<tr>
																	<td class="col-title text-center">
																		SCREEN
																	</td>
																</tr>
															</table>
															<table>
																<tr>
																	<td class="col-title col-nowrap">Lead</td>
																	<td class="col-title col-nowrap">:</td>
																	<td>
																		<?php
																		$main_lead = explode("; ", $main['lead']);
																		?>
																		<label>
																			<input type="checkbox" <?= $is_disabled ?> name="lead[]" value="1" <?= (in_array('1', $main_lead) ? 'checked' : '') ?>>
																			Front
																		</label>
																		<label>
																			<input type="checkbox" <?= $is_disabled ?> name="lead[]" value="2" <?= (in_array('2', $main_lead) ? 'checked' : '') ?>>
																			Back
																		</label>
																	</td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Thickness</td>
																	<td class="col-title col-nowrap">:</td>
																	<td class="col-table-inner">
																		<table>
																			<tr>
																				<td><input type="text" name="thickness" class="<?= $input_class ?>" value="<?= $main['thickness'] == "" ? "N/A" : $main['thickness'] ?>" <?= $is_disabled ?>></td>
																				<td class="col-nowrap">
																					<label>
																						<input type="radio" <?= $is_disabled ?> name="unit_thickness" value="1" <?= $main['unit_thickness'] == '1' ? 'checked' : '' ?>>
																						In
																					</label>
																					<label>
																						<input type="radio" <?= $is_disabled ?> name="unit_thickness" value="2" <?= $main['unit_thickness'] == '2' ? 'checked' : '' ?>>
																						mm
																					</label>
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
															</table>
														</td>
														<td class="col-33 col-table-inner">
															<table>
																<tr>
																	<td class="col-title text-center">
																		RADIATION SOURCE
																	</td>
																</tr>
															</table>
															<table>
																<tr>
																	<td class="col-title col-nowrap">Isotope</td>
																	<td class="col-title col-nowrap">:</td>
																	<td>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="isotope" value="1" <?= $main['isotope'] == '1' ? 'checked' : '' ?>>
																			Ir-192
																		</label>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="isotope" value="2" <?= $main['isotope'] == '2' ? 'checked' : '' ?>>
																			Co-60
																		</label>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="isotope" value="4" <?= $main['isotope'] == '4' ? 'checked' : '' ?>>
																			Se-75
																		</label>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="isotope" value="3" <?= $main['isotope'] == '3' ? 'checked' : '' ?>>
																			Other
																		</label>
																		<input type="text" name="isotope_other" class="<?= $input_class ?>" value="<?= $main['isotope_other'] ?>" <?= $is_disabled ?> placeholder="Isotope(Other)">
																	</td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Activity</td>
																	<td class="col-title col-nowrap">:</td>
																	<td class="col-table-inner">
																		<table>
																			<tr>
																				<td class="col-nowrap">
																					<label>
																						<input type="checkbox" <?= $is_disabled ?> name="activity" value="1" <?= $main['activity'] == '1' ? 'checked' : '' ?>>
																						Ci
																					</label>
																				</td>
																				<td class="col-nowrap">Kv :</td>
																				<td><input type="text" name="activity_kv" class="<?= $input_class ?>" value="<?= $main['activity_kv'] ?>" <?= $is_disabled ?>></td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Current A</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="current_a" class="<?= $input_class ?>" value="<?= $main['current_a'] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Size / Focal Spot</td>
																	<td class="col-title col-nowrap">:</td>
																	<td class="col-table-inner">
																		<table>
																			<tr>
																				<td><input type="text" name="size_focal_spot" class="<?= $input_class ?>" value="<?= $main['size_focal_spot'] ?>" <?= $is_disabled ?>></td>
																				<td class="col-nowrap">mm</td>
																			</tr>
																		</table>
																	</td>
																</tr>
															</table>
															<table>
																<tr>
																	<td class="col-title text-center">
																		TECHNIQUE
																	</td>
																</tr>
															</table>
															<table>
																<tr>
																	<td colspan="3">
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="technique" value="1" <?= $main['technique'] == '1' ? 'checked' : '' ?>>
																			RT CLASS A
																		</label>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="technique" value="2" <?= $main['technique'] == '2' ? 'checked' : '' ?>>
																			RT CLASS B
																		</label>
																	</td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Geometric Unsharpness</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="geometric_unsharpness" class="<?= $input_class ?>" value="<?= $main['geometric_unsharpness'] == "" ? "N/A" : $main['geometric_unsharpness'] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">SFD</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="sfd" class="<?= $input_class ?>" value="<?= $main['sfd'] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Exposure</td>
																	<td class="col-title col-nowrap">:</td>
																	<td>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="exposure" value="1" <?= $main['exposure'] == '1' ? 'checked' : '' ?>>
																			Single Wall
																		</label>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="exposure" value="2" <?= $main['exposure'] == '2' ? 'checked' : '' ?>>
																			Double Wall
																		</label>
																	</td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Viewing</td>
																	<td class="col-title col-nowrap">:</td>
																	<td>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="viewing" value="1" <?= $main['viewing'] == '1' ? 'checked' : '' ?>>
																			Single Wall
																		</label>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="viewing" value="2" <?= $main['viewing'] == '2' ? 'checked' : '' ?>>
																			Double Wall
																		</label>
																	</td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Exposure Time</td>
																	<td class="col-title col-nowrap">:</td>
																	<td class="col-table-inner">
																		<table>
																			<tr>
																				<td><input type="text" name="exposure_time" class="<?= $input_class ?>" value="<?= $main['exposure_time'] ?>" <?= $is_disabled ?>></td>
																				<td class="col-nowrap">
																					<label>
																						Mnt
																						<input type="checkbox" <?= $is_disabled ?> name="exposure_time_ismnt" value="1" <?= $main['exposure_time_ismnt'] == '1' ? 'checked' : '' ?>>
																					</label>
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td class="col-table-inner" colspan="3">
																		<table>
																			<tr>
																				<td class="col-title col-nowrap">Min. SOD*</td>
																				<td class="col-title col-nowrap">:</td>
																				<td>
																					<table>
																						<tr>
																							<td><input type="text" name="min_sod" class="<?= $input_class ?>" value="<?= $main['min_sod'] == "" ? "N/A" : $main['min_sod'] ?>" <?= $is_disabled ?>></td>
																							<td class="col-nowrap">
																								mm
																							</td>
																						</tr>
																					</table>
																				</td>
																				<td class="col-title col-nowrap">DSSOF**</td>
																				<td class="col-title col-nowrap">:</td>
																				<td>
																					<table>
																						<tr>
																							<td><input type="text" name="min_dssof" class="<?= $input_class ?>" value="<?= $main['min_dssof'] == "" ? "N/A" : $main['min_dssof'] ?>" <?= $is_disabled ?>></td>
																							<td class="col-nowrap">
																								mm
																							</td>
																						</tr>
																					</table>
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">No of Film in Holder</td>
																	<td class="col-title col-nowrap">:</td>
																	<td>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="no_film_holder" value="1" <?= $main['no_film_holder'] == '1' ? 'checked' : '' ?>>
																			Single
																		</label>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="no_film_holder" value="2" <?= $main['no_film_holder'] == '2' ? 'checked' : '' ?>>
																			Multiple
																		</label>
																	</td>
																</tr>
															</table>
															<table>
																<tr>
																	<td class="col-title text-center">
																		IMAGE QUALITY INDICATOR ( IQI )
																	</td>
																</tr>
															</table>
															<table>
																<tr>
																	<td class="col-title col-nowrap">Type of Penetrameter</td>
																	<td class="col-title col-nowrap">:</td>
																	<td>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="type_of_penetrameter" value="1" <?= $main['type_of_penetrameter'] == '1' ? 'checked' : '' ?>>
																			ASTM
																		</label>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="type_of_penetrameter" value="2" <?= $main['type_of_penetrameter'] == '2' ? 'checked' : '' ?>>
																			EN/DIN
																		</label>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="type_of_penetrameter" value="3" <?= $main['type_of_penetrameter'] == '3' ? 'checked' : '' ?>>
																			ASTM IA
																		</label>
																	</td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">
																		<label>
																			Wire
																			<input type="checkbox" <?= $is_disabled ?> name="wire" value="1" <?= $main['wire'] == '1' ? 'checked' : '' ?>>
																		</label>
																	</td>
																	<td class="col-title col-nowrap">:</td>
																	<td>
																		<?php
																		$wire_no_list = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16];
																		foreach ($wire_no_list as $key => $value) :
																		?>
																			<label>
																				<input type="radio" <?= $is_disabled ?> name="wire_no" value="<?= $value ?>" <?= $main['wire_no'] == $value ? 'checked' : '' ?>>
																				<?= $value ?>
																			</label>
																		<?php endforeach; ?>
																	</td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Placement</td>
																	<td class="col-title col-nowrap">:</td>
																	<td>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="placement" value="1" <?= $main['placement'] == '1' ? 'checked' : '' ?>>
																			Source Side
																		</label>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="placement" value="2" <?= $main['placement'] == '2' ? 'checked' : '' ?>>
																			Film Side
																		</label>
																	</td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Block Thickness</td>
																	<td class="col-title col-nowrap">:</td>
																	<td class="col-table-inner">
																		<table>
																			<tr>
																				<td><input type="text" name="block_thickness" class="<?= $input_class ?>" value="<?= $main['block_thickness'] == "" ? "N/A" : $main['block_thickness'] ?>" <?= $is_disabled ?>></td>
																				<td class="col-nowrap">mm</td>
																			</tr>
																		</table>
																	</td>
																</tr>
															</table>
															<table>
																<tr>
																	<td class="col-title text-center">
																		MARKER PLACEMENT
																	</td>
																</tr>
															</table>
															<table>
																<tr>
																	<td colspan="3">
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="marker_placement" value="1" <?= $main['marker_placement'] == '1' ? 'checked' : '' ?>>
																			Source Side
																		</label>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="marker_placement" value="2" <?= $main['marker_placement'] == '2' ? 'checked' : '' ?>>
																			Film Side
																		</label>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="marker_placement" value="3" <?= $main['marker_placement'] == '3' ? 'checked' : '' ?>>
																			Inside
																		</label>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="marker_placement" value="4" <?= $main['marker_placement'] == '4' ? 'checked' : '' ?>>
																			Outside
																		</label>
																	</td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Use back scatter</td>
																	<td class="col-title col-nowrap">:</td>
																	<td>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="use_back_scatter" value="1" <?= $main['use_back_scatter'] == '1' ? 'checked' : '' ?>>
																			Yes
																		</label>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="use_back_scatter" value="2" <?= $main['use_back_scatter'] == '2' ? 'checked' : '' ?>>
																			No
																		</label>
																	</td>
																</tr>
															</table>
														</td>
														<td class="col-33 col-table-inner">
															<table>
																<tr>
																	<td class="col-title text-center">
																		EXPOSURE TECHNIQUE SKETCH
																	</td>
																</tr>
															</table>
															<table>
																<tr>
																	<td>
																		<?php
																		$id_ts = 1;
																		?>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="technique_sketch" value="<?= $technique_sketch_list['main'][$id_ts]['id'] ?>" <?= ($technique_sketch_list['main'][$id_ts]['id'] == $main['technique_sketch'] ? 'checked' : '') ?>>
																			<?= $technique_sketch_list['main'][$id_ts]['name'] ?>
																		</label>
																		<img width="100%" src="<?= base_url() ?>img/rt_technique_sketch/<?= $technique_sketch_list['main'][$id_ts]['picture'] ?>">
																	</td>
																	<td>
																		<?php
																		$id_ts = 2;
																		?>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="technique_sketch" value="<?= $technique_sketch_list['main'][$id_ts]['id'] ?>" <?= ($technique_sketch_list['main'][$id_ts]['id'] == $main['technique_sketch'] ? 'checked' : '') ?>>
																			<?= $technique_sketch_list['main'][$id_ts]['name'] ?>
																		</label>
																		<img width="100%" src="<?= base_url() ?>img/rt_technique_sketch/<?= $technique_sketch_list['main'][$id_ts]['picture'] ?>">
																	</td>
																</tr>
																<tr>
																	<td>
																		<?php
																		$id_ts = 3;
																		?>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="technique_sketch" value="<?= $technique_sketch_list['main'][$id_ts]['id'] ?>" <?= ($technique_sketch_list['main'][$id_ts]['id'] == $main['technique_sketch'] ? 'checked' : '') ?>>
																			<?= $technique_sketch_list['main'][$id_ts]['name'] ?>
																		</label>
																		<img width="100%" src="<?= base_url() ?>img/rt_technique_sketch/<?= $technique_sketch_list['main'][$id_ts]['picture'] ?>">
																	</td>
																	<td>
																		<?php
																		$id_ts = 4;
																		?>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="technique_sketch" value="<?= $technique_sketch_list['main'][$id_ts]['id'] ?>" <?= ($technique_sketch_list['main'][$id_ts]['id'] == $main['technique_sketch'] ? 'checked' : '') ?>>
																			<?= $technique_sketch_list['main'][$id_ts]['name'] ?>
																		</label>
																		<img width="100%" src="<?= base_url() ?>img/rt_technique_sketch/<?= $technique_sketch_list['main'][$id_ts]['picture'] ?>">
																	</td>
																</tr>
																<tr>
																	<td>
																		<?php
																		$id_ts = 5;
																		?>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="technique_sketch" value="<?= $technique_sketch_list['main'][$id_ts]['id'] ?>" <?= ($technique_sketch_list['main'][$id_ts]['id'] == $main['technique_sketch'] ? 'checked' : '') ?>>
																			<?= $technique_sketch_list['main'][$id_ts]['name'] ?>
																		</label>
																		<img width="100%" src="<?= base_url() ?>img/rt_technique_sketch/<?= $technique_sketch_list['main'][$id_ts]['picture'] ?>">
																	</td>
																	<td>
																		<?php
																		$id_ts = 6;
																		?>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="technique_sketch" value="<?= $technique_sketch_list['main'][$id_ts]['id'] ?>" <?= ($technique_sketch_list['main'][$id_ts]['id'] == $main['technique_sketch'] ? 'checked' : '') ?>>
																			<?= $technique_sketch_list['main'][$id_ts]['name'] ?>
																		</label>
																		<img width="100%" src="<?= base_url() ?>img/rt_technique_sketch/<?= $technique_sketch_list['main'][$id_ts]['picture'] ?>">
																	</td>
																</tr>
																<tr>
																	<td>
																		<?php
																		$id_ts = 7;
																		?>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="technique_sketch" value="<?= $technique_sketch_list['main'][$id_ts]['id'] ?>" <?= ($technique_sketch_list['main'][$id_ts]['id'] == $main['technique_sketch'] ? 'checked' : '') ?>>
																			<?= $technique_sketch_list['main'][$id_ts]['name'] ?>
																		</label>
																		<img width="100%" src="<?= base_url() ?>img/rt_technique_sketch/<?= $technique_sketch_list['main'][$id_ts]['picture'] ?>">
																	</td>
																	<td>
																		<label>
																			<input type="radio" <?= $is_disabled ?> name="technique_sketch" value="999999" <?= (isset($technique_sketch_list['other'][$main['technique_sketch']]) ? 'checked' : '') ?>>
																			Other
																		</label>
																		<select class="w-100" name="technique_sketch_other">
																			<option value="" data-picture="">---</option>
																			<?php foreach ($technique_sketch_list['other'] as $key => $value) : ?>
																				<option value="<?= $value['id'] ?>" data-picture="<?= $value['picture'] ?>" <?= ($value['id'] == $main['technique_sketch'] ? 'selected' : '') ?>><?= $value['name'] ?></option>
																			<?php endforeach; ?>
																		</select>
																	</td>
																</tr>
															</table>
															<table>
																<tr>
																	<td>
																		<b>Notes for Sketch</b>
																		<ol>
																			<li><b>SWSV</b> = Single Wall Single Viewing</li>
																			<li><b>DWSV</b> = Double Wall Single Viewing</li>
																			<li><b>DWDV</b> = Double Wall Double Viewing</li>
																			<li><b>Other</b> = Other than listed ( Please Sketch )</li>
																		</ol>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
											<!-- JOINT INFORMATION -->
											<table class="text-center">
												<thead>
													<tr>
														<td rowspan="2">S/N</td>
														<td rowspan="2">Weld Map Dwg / Line & Spool No.</td>
														<td rowspan="2">Joint No.</td>
														<td rowspan="2">Location</td>
														<td rowspan="2">Inspection Category</td>
														<td rowspan="2">Total Length(mm)</td>
														<td rowspan="2">Tested Length(mm)</td>
														<td rowspan="2">Welding Process</td>
														<td rowspan="2">Welder ID</td>
														<td colspan="2">Result</td>
														<td colspan="3">Density</td>
														<td rowspan="2">Sensitivity</td>
														<td rowspan="2">Discontinuities Type</td>
														<td rowspan="2">Remark</td>
													</tr>
													<tr>
														<td>ACC</td>
														<td>REJ</td>
														<td>IQI</td>
														<td>Max</td>
														<td>Min</td>
													</tr>
												</thead>
												<tbody>
													<?php
													$no = 0;
													$cek = [];
													$key_no = -1;
													$prev_joint = 0;
													foreach ($list as $key => $value) :
														// test_var($list);
														if (in_array($value['id_joint'], $cek)) {
															continue;
														}
														$cek[] = $value['id_joint'];

														$is_first_joint = true;
														foreach ($film_list[$value['id_rt']] ?? [[]] as $film) :
															$no++;
															$key_no++;
															if ($prev_joint == $value['id_joint']) {
																$is_first_joint = false;
															}
															$prev_joint = $value['id_joint'];
													?>
															<tr class="<?= 'joint' . $value['id_joint'] ?>">
																<input type="hidden" name="id_joint[<?= $no ?>]" value="<?= $value['id_joint'] ?>">
																<input type="hidden" name="id_rt[<?= $no ?>]" value="<?= $value['id_rt'] ?>">
																<input type="hidden" name="id_film[<?= $no ?>]" value="<?= $film['id'] ?>">
																<td><?= $no ?>
																	<?php if ($user_permission[217] == 1) { ?>
																		<button type="button" data-id="<?= $main['id_rt'] ?>" data-uniq_id_report="<?= $main['uniq_id_report'] ?>" data-id_joint="<?= $value['id_joint'] ?>" data-ndt_type="1" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Return&nbsp;</b> this Joint?', this, event, 'return_joint')" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> </button>
																	<?php } ?>
																</td>



																<td>
																	<?= $joint_list[$value['id_joint']]['discipline'] == 1 ? ($joint_list[$value['id_joint']]['spool_no'] ? $joint_list[$value['id_joint']]['drawing_wm'] . ' Rev.' . $joint_list[$value['id_joint']]['rev_wm'] . ' / ' . $joint_list[$value['id_joint']]['spool_no'] : $joint_list[$value['id_joint']]['drawing_wm'] . 'Rev .' . $joint_list[$value['id_joint']]['rev_wm'])  : $joint_list[$value['id_joint']]['drawing_wm'] . ' Rev.' . $joint_list[$value['id_joint']]['rev_wm'] ?> <br> 
																	<?php if (isset($joint_list[$value['id_joint']]['drawing_wm'])) { ?>
																		<?php
																		$links_atc = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($data_drawing_wm[$joint_list[$value['id_joint']]['drawing_wm']]['id']), '+=/', '.-~') . "/" . $data_drawing_wm[$joint_list[$value['id_joint']]['drawing_wm']]['rev_wm'];
																		// test_var($data_drawing_wm[$joint_list[$value['id_joint']]['drawing_wm']]['id'], 1);
																		?>
																		<a target='_blank' href='<?= $links_atc ?>' title='Attachment'> <i class='fas fa-paperclip'></i> ( Open Drawing )  </a>
																	<?php } ?>
																</td>
																<td>
																	<?= $joint_list[$value['id_joint']]['joint_no'] . ($visual_rev[$value['id_visual']]['revision'] > 0 ? '(' . $visual_rev[$value['id_visual']]['revision_category'] . $visual_rev[$value['id_visual']]['revision'] . ')' : '') ?></td>
																<td>
																	<input type="text" name="rt_item_location[<?= $no ?>]" class="<?= $input_class ?>" value="<?= $film['location'] ?>" <?= $is_disabled ?>>
																	<?php if ($is_first_joint) : ?>
																		<button type="button" class="btn btn-sm btn-flat btn-block btn-success btn-add-row mt-1" <?= $is_none ?> onclick="add_row(this, '<?= $value['id_joint'] ?>')" title="Add Row"><i class="fas fa-plus"></i></button>
																	<?php else : ?>
																		<button type="button" class="btn btn-sm btn-flat btn-block btn-danger btn-delete-row mt-1" <?= $is_none ?> onclick="delete_row_db(this, <?= @$film['id'] ?>)" title="Delete Row"><i class="fas fa-trash"></i></button>
																	<?php endif; ?>
																</td>
																<td>
																	<input type="text" name="rt_item_inspection_category[<?= $no ?>]" class="<?= $input_class ?> inspection_category<?= $value['id_joint'] ?>" oninput="change_all_input(this, 'inspection_category', '<?= $value['id_joint'] ?>')" value="<?= $film['inspection_category'] == '' ? $class_list[$joint_list[$value['id_joint']]['class']] : $film['inspection_category'] ?>" <?= $is_disabled ?>>
																</td>
																<td><?= ($visual[$value['id_visual']]['revision'] > 0) ? $visual[$value['id_visual']]['length_of_weld'] : $joint[$value['id_joint']]['weld_length']  ?></td>
																<td>
																	<input type="number" name="rt_item_tested_length[<?= $no ?>]" class="<?= $input_class ?> tested_length<?= $value['id_joint'] ?>" value="<?= $film['tested_length'] == '' ? $value['transmittal_request_tested_length'] : $film['tested_length'] ?>" <?= $is_disabled ?> max="<?= $value['transmittal_request_tested_length'] ?>">
																</td>

																<?php
																$wp_rh    = explode(";", $visual_list[$value["id_visual"]]["weld_process_rh"]);
																$wp_fc    = explode(";", $visual_list[$value["id_visual"]]["weld_process_fc"]);
																$wprocess = array_unique(array_merge($wp_rh, $wp_fc));
																?>
																<td><?= implode("<br>", $wprocess) ?></td>
																<td>
																	<?php
																	$list_welder  = [];
																	if (isset($welder_per_joint[$value['id_joint']])) : ?>
																		<?php foreach ($welder_per_joint[$value['id_joint']] as $v) : ?>
																			<?php

																			$list_welder[] = $welder[$v]['welder_code'];

																			?>
																		<?php endforeach; ?>
																	<?php endif; ?>
																	<?= implode(", ", $list_welder) ?>
																	<?php
																	$drawing_wm = $joint_list[$value['id_joint']]['drawing_wm'];
																	$report_no = $main['report_no'];
																	$joint_no = $joint_list[$value['id_joint']]['joint_no'];
																	echo ch_button_shortcut_search_joint_welder($method, $drawing_wm, $report_no, $joint_no);
																	?>
																</td>

																<td>
																	<input type="radio" name="rt_item_result[<?= $no ?>]" <?= $is_disabled ?> value="1" <?= $film['result'] == 1 ? 'checked' : '' ?>> ACC
																</td>
																<td>
																	<input type="radio" name="rt_item_result[<?= $no ?>]" <?= $is_disabled ?> value="2" <?= $film['result'] == 2 ? 'checked' : '' ?>> REJ
																</td>

																<td><input type="text" name="rt_item_density_iqi[<?= $no ?>]" class="<?= $input_class ?>" value="<?= $film['density_iqi'] == "" ? "N/A" : $film['density_iqi'] ?>" <?= $is_disabled ?>></td>
																<td><input type="text" name="rt_item_density_iqi_max[<?= $no ?>]" class="<?= $input_class ?>" value="<?= $film['density_iqi_max'] ?>" <?= $is_disabled ?>></td>
																<td><input type="text" name="rt_item_density_iqi_min[<?= $no ?>]" class="<?= $input_class ?>" value="<?= $film['density_iqi_min'] ?>" <?= $is_disabled ?>></td>
																<td><input type="text" name="rt_item_sensitivity[<?= $no ?>]" class="<?= $input_class ?>" value="<?= $film['sensitivity'] ?>" <?= $is_disabled ?>></td>
																<td><input type="text" name="rt_item_discontinuities_type[<?= $no ?>]" class="<?= $input_class ?>" value="<?= $film['discontinuities_type'] ?>" <?= $is_disabled ?>></td>
																<td><input type="text" name="rt_item_remarks[<?= $no ?>]" class="<?= $input_class ?>" value="<?= $film['remarks'] ?>" <?= $is_disabled ?>></td>
															</tr>
														<?php endforeach; ?>
													<?php endforeach; ?>
												</tbody>
											</table>
											<!-- SIGN -->
											<table>
												<tbody>
													<tr>
														<td class="col-table-inner">

															<?php if ($visual[$joint_list[$main["id_joint"]]["id"]]["company_id"] == 5) { ?>

																<table>
																	<tr class="font-weight-bold">
																		<td>Tested By :</td>
																		<td>NDT/QC Inspector (DSAW) :</td>
																		<td>NDT/QC Inspector (SEATRIUM)</td>
																		<td>Client Inspector</td>
																		<td>3rd Party</td>
																	</tr>
																	<tr>
																		<td>NDT Level II</td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	<tr>

																		<td>
																			<?php if ($main['tested_by']) : ?>
																				<img src="data:image/png;base64,<?= $user[$main['tested_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
																			<?php else : ?>
																				<div style='height:3cm;'>
																					<br>
																					<?php if ($main['status_inspection'] == 0 && $is_signable) : ?>
																						<button type="button" onclick="approval_data(this, 13, 'tested')" class="btn btn-outline-success"><i class="fas fa-signature"></i> Digital Sign</button>
																					<?php endif; ?>
																				</div>
																			<?php endif; ?>
																		</td>
																		<td>
																			<?php if ($main['qc_subcont_by']) : ?>
																				<img src="data:image/png;base64,<?= $user[$main['qc_subcont_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
																			<?php else : ?>
																				<div style='height:3cm;'>
																					<br>
																					<?php if ($main['status_inspection'] == 13 && $is_signable) : ?>
																						<button type="button" onclick="approval_data(this, 15, 'qc_subcont')" class="btn btn-outline-success"><i class="fas fa-signature"></i> Digital Sign</button>
																					<?php endif; ?>
																				</div>
																			<?php endif; ?>
																		</td>
																		<td>
																			<?php if ($main['qc_by']) : ?>
																				<img src="data:image/png;base64,<?= $user[$main['qc_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
																			<?php else : ?>
																				<div style='height:3cm;'>
																					<br>
																					<?php if ($main['status_inspection'] == 1 or $main['status_inspection'] == 15) : ?>
																						<button type="button" onclick="approval_data(this, 3, 'qc')" class="btn btn-outline-success"><i class="fas fa-signature"></i> Digital Sign</button>
																					<?php endif; ?>
																				</div>
																			<?php endif; ?>
																		</td>
																		<td>
																			<?php if ($main['client_by'] && $this->user_cookie[7] == 8) : ?>
																				<img src="data:image/png;base64,<?= $user[$main['client_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
																			<?php else : ?>
																				<div style='height:3cm;'>
																					<br>
																					<?php if ($main['status_inspection'] == 5) : ?>
																						<button type="button" onclick="approval_data(this, 7, 'client')" class="btn btn-outline-success"><i class="fas fa-signature"></i> Digital Sign</button>
																						<button type="button" onclick="return_data(this, 6, 'rt')" class="btn btn-outline-danger"><i class="fas fa-undo"></i>  Return Client</button>
																					<?php endif; ?>
																				</div>
																			<?php endif; ?>
																		</td>
																		<td>
																			<?php if ($main['third_party_approval_status'] == 0 && $main['status_inspection'] == 7 && $this->user_cookie[7] != 8) { ?>
																				<h6>-- Click the button below --</h6>
																				<button type="button" onclick="sign_third_party(this)" class="btn btn-info"><i class="fas fa-exchange-alt"></i> Sign Document </button>
																			<?php } else { ?>
																				<?php if ($main['third_party_approval_by']) { ?>
																					<img src="data:image/png;base64,<?= $user[$main['third_party_approval_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
																				<?php } ?>
																			<?php  } ?>
																		</td>
																	</tr>
																	<tr class="font-weight-bold">
																		<td><?= @$user[$main['tested_by']]['full_name'] ?? 'Name / Signature' ?></td>
																		<td><?= @$user[$main['qc_subcont_by']]['full_name'] ?? 'Name / Signature' ?></td>
																		<td><?= @$user[$main['qc_by']]['full_name'] ?? 'Name / Signature' ?></td>
																		<td><?= @$user[$main['client_by']]['full_name'] ?? 'Name / Signature' ?></td>
																		<td><?= @$user[$main['third_party_approval_by']]['full_name'] ?? 'Name / Signature' ?></td>
																	</tr>
																	<tr class="font-weight-bold">
																		<td>Date : <?= $main['tested_date'] ?></td>
																		<td>Date : <?= $main['qc_subcont_date'] ?></td>
																		<td>Date : <?= $main['qc_date'] ?></td>
																		<td>Date : <?= $main['client_date'] ?></td>
																		<td>Date : <?= $main['third_party_approval_date'] ?></td>
																	</tr>
																</table>

															<?php } else { ?>

																<table>
																	<tr class="font-weight-bold">
																		<td>Tested By :</td>
																		<td>NDT/QC Inspector</td>
																		<td>Client Inspector</td>
																		<td>3rd Party</td>
																	</tr>
																	<tr>
																		<td>NDT Level II</td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	<tr>
																		<td>
																			<?php if ($main['tested_by']) : ?>
																				<img src="data:image/png;base64,<?= $user[$main['tested_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
																			<?php else : ?>
																				<div style='height:3cm;'>
																					<br>
																					<?php if ($main['status_inspection'] == 0) : ?>
																						<button type="button" onclick="approval_data(this, 1, 'tested')" class="btn btn-outline-success"><i class="fas fa-signature"></i> Digital Sign</button>
																					<?php endif; ?>
																				</div>
																			<?php endif; ?>
																		</td>
																		<td>
																			<?php if ($main['qc_by']) : ?>
																				<img src="data:image/png;base64,<?= $user[$main['qc_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
																			<?php else : ?>
																				<div style='height:3cm;'>
																					<br>
																					<?php if ($main['status_inspection'] == 1) : ?>
																						<button type="button" onclick="approval_data(this, 3, 'qc')" class="btn btn-outline-success"><i class="fas fa-signature"></i> Digital Sign</button>
																					<?php endif; ?>
																				</div>
																			<?php endif; ?>
																		</td>
																		<td>
																			<?php if ($main['client_by']) : ?>
																				<img src="data:image/png;base64,<?= $user[$main['client_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
																			<?php else : ?>
																				<div style='height:3cm;'>
																					<br>
																					<?php if ($main['status_inspection'] == 5 && ($this->user_cookie[7] == 8 || $user_permission[0] == 1)) : ?>
																						<button type="button" onclick="approval_data(this, 7, 'client')" class="btn btn-outline-success"><i class="fas fa-signature"></i> Digital Sign</button>
																						<button type="button" onclick="return_data(this, 6, 'rt')" class="btn btn-outline-danger"><i class="fas fa-undo"></i>  Return Client</button>
																					<?php endif; ?>
																				</div>
																			<?php endif; ?>
																		</td>
																		<td>
																			<?php if ($main['third_party_approval_status'] == 0 && $main['status_inspection'] == 7 && $this->user_cookie[7] != 8) { ?>
																				<h6>-- Click the button below --</h6>
																				<button type="button" onclick="sign_third_party(this)" class="btn btn-info"><i class="fas fa-exchange-alt"></i> Sign Document </button>
																			<?php } else { ?>
																				<?php if ($main['third_party_approval_by']) { ?>
																					<img src="data:image/png;base64,<?= $user[$main['third_party_approval_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
																				<?php } ?>
																			<?php  } ?>
																		</td>
																	</tr>
																	<tr class="font-weight-bold">
																		<td><?= @$user[$main['tested_by']]['full_name'] ?? 'Name / Signature' ?></td>
																		<td><?= @$user[$main['qc_by']]['full_name'] ?? 'Name / Signature' ?></td>
																		<td><?= @$user[$main['client_by']]['full_name'] ?? 'Name / Signature' ?></td>
																		<td><?= @$user[$main['third_party_approval_by']]['full_name'] ?? 'Name / Signature' ?></td>
																	</tr>
																	<tr class="font-weight-bold">
																		<td>Date : <?= $main['tested_date'] ?></td>
																		<td>Date : <?= $main['qc_date'] ?></td>
																		<td>Date : <?= $main['client_date'] ?></td>
																		<td>Date : <?= $main['third_party_approval_date'] ?></td>
																	</tr>
																</table>
															<?php } ?>
														</td>
													</tr>
												</tbody>
											</table>
											<!-- FOOTER -->
											<table>
												<tbody>
													<tr class="font-weight-bold">
														<td>
															Note : *) SOD = Source to Object Distance, **) DSSOF = Distance from Source Side of Object to the Film at the minimum Source to Object Distance<br>
															IF = Incomplete Fusion, IP = Incomplete Penetration, RC = Root Concavity, RUC = Root Undercut, P = Porosity, Incl = Inclusion, Crk = Crack, ND = No Defect<br>
														</td>
													</tr>
													<?php if ($main['status_inspection'] == 6) : ?>
														<tr>
															<td>
																<span style="display: inline-block; width: 180px; font-weight: bold; color: red;">Client Returned By</span>: <?= @$user[$main['returned_client_by']]['full_name'] ?><br>
																<span style="display: inline-block; width: 180px; font-weight: bold; color: red;">Client Returned Date</span>: <?= date("d F Y H:i", strtotime($main['returned_client_date'])) ?><br>
																<span style="display: inline-block; width: 180px; font-weight: bold; color: red;">Client Returned Remarks</span>: <?= $main['client_reject_remarks'] ?>
															</td>
														</tr>
													<?php endif; ?>
												</tbody>
											</table>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-md-12 text-center p-2">
										<?php if (($allow_update && $main['status_inspection'] != 12) && $this->user_cookie[7] != 8) : ?>
												<button type="submit" class="btn btn-warning"><i class="fas fa-edit"> </i> Update</button>
											<?php endif; ?>
											<?php if ($main['status_inspection'] == 3) : ?>
												<button type="button" onclick="approval_data(this, 5, 'invite_client')" class="btn btn-info"><i class="fas fa-exchange-alt"></i> Transmit to Client</button>
											<?php endif; ?>
											<?php if ($user_permission[208] == 1 && $main['status_inspection'] != 12) { ?>
												<button type="button" data-uniq_id_report="<?= $main['uniq_id_report'] ?>" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Void&nbsp;</b> this?', this, event, 'void_row_db')" class="btn btn-secondary"><i class="fa fa-exclamation-triangle"></i> Void</button>
											<?php } ?>
											<?php 

												$enc_uniq_id_report = encrypt($value['uniq_id_report']);
												$enc_pdf = encrypt("pdf");

												$detail_link = site_url("ndt_live/ndt_detail_" . strtolower($method) . "/" . $enc_uniq_id_report);

											?>

												<a target="_blank" href="<?= $detail_link . '/' . $enc_pdf ?>" class="btn btn-danger">
													<i class="fas fa-file-pdf"></i> PDF
												</a>

											<?php if ($main['status_inspection'] == 6 && $this->user_cookie[7] != 8) { ?>
												<button type="button" onclick="retransmit_to_client(this, 5, 'rt')" class="btn btn-primary"><i class="fa fa-arrow-right"></i></i></i> Transmit to Client</button>
											<?php } ?>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>

					<div class="tab-pane fade <?= $tab == 'deffect' ? ' show active' : '' ?>" id="deffect" role="tabpanel" aria-labelledby="deffect-tab">
						<div class="row mt-3">
							<div class="col-md-12">
								<div class="card border-0 shadow-sm">
									<div class="card-body">
										<form action="<?= site_url('ndt_live/add_deffect') ?>" method="post">
											<input type="hidden" name="ndt_type" value="1">
											<div class="row">
												<div class="col-md-12">
													<div class="table-responsive overflow-auto">
														<table class="table table-sm text-center table-bordered table-hover tr_ctq">
															<thead class="bg-gray-table">
																<th>Joint/Welder</th>
																<th>Deffect Type</th>
																<th>Deffect Length</th>
																<th>Distance from Datum</th>
																<th>Deffect Depth</th>
																<th>Planarity</th>
																<th>Type</th>
																<th><button <?= $is_none ?> type="button" class="btn btn-sm btn-info" onclick="addCTQ()"><i class="fas fa-plus"></i></button></th>
															</thead>
															<tbody>
																<?php foreach ($ctq as $key => $value) { ?>
																	<tr class="row_<?= $value['id'] ?>">
																		<td><?= $welder[$value['welder']]['welder_code'] . ' (Joint No. ' . $joint_list[$array_detail[$value['ndt_id']]['id_joint']]['joint_no'] . ')' ?></td>
																		<td><?= $deffect[$value['ctq_id']]['ctq_description'] ?></td>
																		<td><?= $value['length'] ?></td>
																		<td><?= $value['datum'] ?></td>
																		<td><?= $value['depth'] ?></td>
																		<td><?= $value['planarity'] == 0 ? 'Non-Planar' : 'Planar' ?></td>
																		<td><?= $value['type'] == 0 ? 'R/H' : 'F/C' ?></td>
																		<td><button <?= $is_none ?> type="button" class="btn btn-sm btn-danger" onclick="removeCTQ(<?= $value['id'] ?>)"><i class="fas fa-trash"></i></button></td>
																	<tr>
																	<?php } ?>
															</tbody>
														</table>
													</div>

												</div>
												<div class="col-md-12 text-right">
													<hr>
													<button <?= $is_none ?> type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Save</button>
												</div>
											</div>

										</form>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="tab-pane fade <?= $tab == 'attachment' ? ' show active' : '' ?>" id="attachment" role="tabpanel" aria-labelledby="attachment-tab">
						<div class="row mt-3">
							<div class="col-md-12">
								<div class="card border-0 shadow-sm">
									<div class="card-body">
										<div class="row">
											<div class="col-md-6">
												<form action="<?php echo base_url('ndt_live/upload_new_attachment/1'); ?>" method="post" enctype="multipart/form-data">
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label>Remarks Data :</label>
																<textarea <?= $is_disabled ?> name='remarks' class='form-control' required="" style="height: 100px !important"></textarea>
																<input type="hidden" class="form-control" name="submission_id" id="uniq_data" value="<?= $main['uniq_id_report'] ?>" autocomplete="off" readonly>
																<input type="hidden" class="form-control" name="report_number" id="uniq_data" value="<?= $main['report_no'] ?>" autocomplete="off" readonly>
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<label>Revision No :</label>
																<input class="form-control" type="number" <?= $is_disabled ?> name="revision">
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<label>Select File to upload :</label>
																<input type="file" class="form-control" <?= $is_disabled ?> name="file_attachment" id="file_attachment" required="">
															</div>
														</div>
													</div>
													<button <?= $is_none ?> type="submit" class="btn btn-secondary"> Upload</button>
												</form>
											</div>
											<div class="col-md-12">
												<table class="table text-muted">
													<thead class="bg-gray-table">
														<tr>
															<th>ATTACHMENT</th>
															<th>REVISION</th>
															<th>UPLOAD BY</th>
															<th>UPLOAD DATE</th>
															<th>REMARKS</th>
															<th></th>
														</tr>
													</thead>
													<tbody>

														<?php foreach ($data_attachment as  $value) { ?>
															<tr>
																<td>
																	<a target="_blank" href="<?= base_url('ndt/open_atc/') . $value["filename"] . '/' . $value["filename"] ?>"><?php echo $value["filename"] ?></a>
																</td>
																<td><?= $value['revision'] ? $value['revision'] : '-' ?></td>
																<td><?php echo $user[$value["created_by"]]['full_name'] ?></td>
																<td><?php echo $value["created_date"] ?></td>
																<td><?php echo $value["remarks"] ?></td>
																<td><button <?= $is_none ?> class="btn btn-danger" type="button" onclick="delete_attachment_on_update('<?= $value["id"]; ?>','<?= $value["uniq_data"]; ?>')"><i class="fa fa-trash"></i></button></td>
															</tr>
														<?php } ?>
														<script type="text/javascript">
															function delete_attachment_on_update(id, uniq_data) {
																Swal.fire({
																	title: 'Are you sure to <b class="text-warning">&nbsp;Delete&nbsp;</b> this?',
																	text: "This Attachment will permanent deleted!",
																	type: 'warning',
																	showCancelButton: true,
																	confirmButtonColor: '#3085d6',
																	cancelButtonColor: '#d33',
																	confirmButtonText: 'Yes, Delete it!'
																}).then((result) => {
																	if (result.value) {
																		$.ajax({
																			url: "<?php echo base_url(); ?>ndt_live/delete_attachment_with_status",
																			type: "post",
																			data: {
																				ndt: '<?= $initial ?>',
																				id: id,
																				uniq_data: uniq_data,
																			},
																			success: function(data) {
																				if (data.includes("Error")) {
																					Swal.fire(
																						'Ops..',
																						data,
																						'error'
																					);
																				} else {
																					Swal.fire(
																						'Success',
																						'Your data has been Updated!',
																						'success'
																					);
																					location.reload();
																				}
																			}
																		});
																	}
																})
															}
														</script>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<script>
	$(function() {
		check_isotope_other();
		$("input[name=isotope]").on('change', check_isotope_other);

		check_technique_sketch();
		$("input[name=technique_sketch]").on('change', check_technique_sketch);

		check_technique_sketch_other();
		$("select[name=technique_sketch_other]").on('change', check_technique_sketch_other);
	})

	function check_isotope_other() {
		let isotope = $("input[name=isotope]:checked").val();
		$('input[name=isotope_other]').prop('disabled', true);
		if (isotope == 3) {
			<?php if (!$is_disabled) : ?>
				$('input[name=isotope_other]').prop('disabled', false);
			<?php endif; ?>
		}
	}

	function check_technique_sketch() {
		let technique_sketch = $("input[name=technique_sketch]:checked").val();
		$('select[name=technique_sketch_other]').prop('disabled', true);
		if (technique_sketch == 999999) {
			<?php if (!$is_disabled) : ?>
				$('select[name=technique_sketch_other]').prop('disabled', false);
			<?php endif; ?>
		}
	}

	function check_technique_sketch_other() {
		let elem = $("select[name=technique_sketch_other");
		let picture = $(elem).find(':selected').data('picture');
		$(".pic-technique-sketch-other").remove();
		if (picture != '') {
			let td = $(elem).closest('td');
			$(td).append('<img class="pic-technique-sketch-other" width="100%" src="<?= base_url() ?>img/rt_technique_sketch/' + picture + '">')
		}
	}

	function sign_third_party(btn) {
		Swal.fire({
			type: "warning",
			title: "A Sign Document",
			text: "Are you sure to sign this document ?",
			showCancelButton: true
		}).then((res) => {

			if (res.value) {
				Swal.fire({
					title: 'Processing...',
					allowOutsideClick: false,
					onBeforeOpen: () => {
						Swal.showLoading()
					},
				})

				$.ajax({
					url: "<?= site_url('ndt_live/proccess_sign_third_party') ?>",
					type: "POST",
					data: {
						uniq_id_report: "<?= encrypt($main['uniq_id_report']) ?>",
						method: "rt"
					},
					dataType: "JSON",
					success: (data) => {
						if (data.success) {
							Swal.fire({
								type: "success",
								title: "Successfully sign This Document !!",
								timer: 1000
							})

							setTimeout(() => {
								location.reload()
							}, 1000);
						}
					},
					error: (data) => {
						Swal.fire({
							type: "error",
							title: "Something Went Wrong !!",
							timer: 1000
						})
					}
				})
			}
		})
	}

	function approval_data(btn, status, role) {
		Swal.fire({
			type: "warning",
			title: "Sign Document",
			text: "Are you sure to " + (role != 'invite_client' ? 'Sign' : 'Send Invitation of') + " this document ?",
			showCancelButton: true
		}).then((res) => {

			if (res.value) {
				Swal.fire({
					title: 'Processing...',
					allowOutsideClick: false,
					onBeforeOpen: () => {
						Swal.showLoading()
					},
				})

				$.ajax({
					url: "<?= site_url('ndt_live/sign_document_rt') ?>",
					type: "POST",
					data: {
						uniq_id_report: "<?= encrypt($main['uniq_id_report']) ?>",
						status: status,
						role: role
					},
					dataType: "JSON",
					success: (data) => {
						if (data.success) {
							Swal.fire({
								type: "success",
								title: "Successfully Sign This Document !!",
								timer: 1000
							})

							setTimeout(() => {
								location.reload()
							}, 1000);
						}
					},
					error: (data) => {
						Swal.fire({
							type: "error",
							title: "Something Went Wrong !!",
							timer: 1000
						})
					}
				})
			}
		})

	}

	let no_key = <?= $no ?>;

	function add_row(btn, id_joint) {
		let val_result = $(btn).closest('tr').find('input[type=radio]:checked').val();

		let html = $(btn).closest('tr').html();
		$(btn).closest('tbody').find('tr.joint' + id_joint + ':last').after("<tr>" + html + "</tr>");

		let new_row = $(btn).closest('tbody').find('tr.joint' + id_joint + ':last').next();
		let delete_row_btn = '<button type="button" class="btn btn-sm btn-flat btn-block btn-danger btn-delete-row mt-1" onclick="delete_row(this)" title="Delete Row"><i class="fas fa-times"></i></button>'
		$(new_row).find('.btn-add-row').closest('td').append(delete_row_btn);
		$(new_row).find('.btn-add-row').remove();

		no_key++;
		$(new_row).find('input').each(function() {
			const currentName = $(this).attr("name").split("[")[0];
			const newIndex = no_key;
			const newName = `${currentName}[${newIndex}]`;
			$(this).attr("name", newName);
		});
		// $(new_row).find('td:first').html(no_key);
		$(new_row).find('input[type=radio]:checked').prop('checked', false);
		$(new_row).find("input[name='id_film[" + no_key + "]']").val('');

		if (typeof val_result !== "undefined") {
			$(btn).closest('tr').find('input[type=radio][value="' + val_result + '"]').prop('checked', true);
		}
	}

	function delete_row(btn) {
		$(btn).closest('tr').remove();
	}

	function delete_row_db(btn, id) {
		Swal.fire({
			title: 'Are you sure to <b class="text-danger">&nbsp;Delete&nbsp;</b> this?',
			text: "You won't be able to revert this!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, Delete it!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: "<?php echo base_url() ?>ndt_live/ndt_rt_film_delete_process",
					data: {
						id: id,
					},
					type: 'post',
					success: function(data) {
						sweetalert("success", "Delete Data Success!");
						$(btn).closest('tr').remove();
					}
				});
			}
		})

	}

	// CTQ PART

	var no = 0

	function addCTQ() {
		no++;

		let html = `
      <tr id="row_${no}">
      <td>
        <select class="custom-select" name="ndt_id[${no}]" required>
        <option value="">---</option>
        <?php foreach ($list as $key => $value_1) : ?> 
        	<?php //if($value_1['result'] == 2) : 
			?> 
          	<option value="<?= $value_1['id_rt'] ?>"><?= $welder[$value_1['id_welder']]['welder_code'] ?> (Joint No. <?= $joint_list[$value_1['id_joint']]['joint_no'] ?>)</option>
         	<?php //endif; 
				?>
         <?php endforeach; ?>
         </select>
      </td>
      <td>
        <select class="custom-select" name="ctq_id[${no}]" required>
        <option value="">---</option>
        <?php foreach ($master_data_ctq as $key => $value_2) : ?> 
          <option value="<?= $value_2['id'] ?>"><?= $value_2['ctq_description'] ?> (<?= $value_2["ctq_initial"] ?>)</option>
         <?php endforeach; ?>
         </select>
      </td>
      <td><input name="length[${no}]" type="number" step="any" class="form-control" placeholder="Length" required></td>
      <td><input name="datum[${no}]" type="text" step="any" class="form-control" placeholder="Datum" required></td>
      <td><input name="depth[${no}]" type="text" step="any" class="form-control" placeholder="Depth" required></td>
      <td>
        <select class="custom-select" name="planarity[${no}]" required>
          <option value="">---</option>
          <option value="0">Non-Planar</option>
          <option value="1">Planar</option>
        </select>
      </td>

      <td>
        <select class="custom-select" name="type[${no}]" required>
          <option value="">---</option>
          <option value="0">R/H</option>
          <option value="1">F/C</option>
        </select>
      </td>

      <td><button type="button" class="btn btn-sm btn-danger" onclick="removeCTQ_row(${no})"><i class="fas fa-trash"></i></button></td>
      </tr>
    `
		$('.tr_ctq').append(html)
	}

	function removeCTQ_row(no) {
		$('#row_' + no).remove()
	}

	function removeCTQ(id) {
		Swal.fire({
			type: 'warning',
			title: 'Are You Sure to Remove this Data?',
			// input: 'tel',
			showDenyButton: true,
			showCancelButton: true,
			confirmButtonText: 'Yes',
		}).then((result) => {
			console.log(result)
			/* Read more about isConfirmed, isDenied below */
			if (result.value == true) {
				$.ajax({
					url: "<?= base_url() ?>ndt_live/removeCTQ",
					type: "POST",
					data: {
						'id': id,
					},
				})
				Swal.fire('Success!', '', 'success')
				// location.reload()
				$('.row_' + id).remove()
			} else {
				Swal.fire('Changes are not saved', '', 'info')
			}
		})
	}

	function change_all_input(input, name, id_joint) {
		$('.' + name + id_joint).val($(input).val());
	}
</script>

<script>
	function void_row_db(btn) {
		var uniq_id_report = $(btn).data("uniq_id_report");
		console.log("uniq_id_report:", uniq_id_report);

		$.ajax({
			url: "<?php echo base_url() ?>ndt_live/delete_void_rt_empire",
			data: {
				uniq_id_report: uniq_id_report,
			},
			type: 'post',
			success: function(data) {
				if (data.includes('Error')) {
					sweetalert("error", data);
				} else {
					sweetalert("success", "Void Data Success!");

					setTimeout(() => {
						location.reload()
					}, 1000);
				}
			},
			error: function(xhr, status, error) {
				sweetalert("error", "An error occurred: " + error);
			}
		});
	}
</script>



<script>
	function return_joint(btn) {
		var uniq_id_report = $(btn).data("uniq_id_report");
		var joint_no = $(btn).data("id_joint");
		var ndt_type = $(btn).data("ndt_type");
		var id_rt = $(btn).data("id");


		$.ajax({
			url: "<?php echo base_url() ?>ndt_live/return_joint_to_joint_list",
			data: {
				uniq_id_report: uniq_id_report,
				id_joint: joint_no,
				ndt_type: ndt_type,
				id: id_rt,
			},
			type: 'post',
			success: function(data) {
				if (data.includes('Error')) {
					sweetalert("error", data);
				} else {
					sweetalert("success", "Return joint is Succesfully!");

					setTimeout(() => {
						location.reload()
					}, 1000);
				}
			},
			error: function(xhr, status, error) {
				sweetalert("error", "An error occurred: " + error);
			}
		});
	}

	function return_data(btn, status, method) {
		Swal.fire({
			type: "warning",
			title: "Return Document",
			html: "<p>Are you sure to Return this document?</p><textarea id='return_remarks' class='swal2-textarea' placeholder='Return remarks ...'></textarea>",
			showCancelButton: true,
			preConfirm: () => {
				const remarks = document.getElementById('return_remarks').value;
				if (!remarks) {
					Swal.showValidationMessage('Remarks is required');
					return false;
				}
				return remarks;
			}
		}).then((res) => {

			if (res.value) {
				Swal.fire({
					title: 'Processing...',
					allowOutsideClick: false,
					onBeforeOpen: () => {
						Swal.showLoading()
					},
				})

				$.ajax({
					url: "<?= site_url('ndt_live/return_client') ?>",
					type: "POST",
					data: {
						uniq_id_report: "<?= encrypt($main['uniq_id_report']) ?>",
						status: status,
						method: method,
						remarks: res.value
					},
					dataType: "JSON",
					success: (data) => {
						if (data.success) {
							Swal.fire({
								type: "success",
								title: "Successfully Retruned This Document !!",
								timer: 1000
							})

							setTimeout(() => {
								location.reload()
							}, 1000);
						}
					},
					error: (data) => {
						Swal.fire({
							type: "error",
							title: "Something Went Wrong !!",
							timer: 1000
						})
					}
				})
			}
		})

	}

	function retransmit_to_client(btn, status, method) {
		Swal.fire({
			type: "warning",
			title: "Transmit to Client",
			text: "Are you sure to transmit this document ?",
			showCancelButton: true
		}).then((res) => {

			if (res.value) {
				Swal.fire({
					title: 'Processing...',
					allowOutsideClick: false,
					onBeforeOpen: () => {
						Swal.showLoading()
					},
				})

				$.ajax({
					url: "<?= site_url('ndt_live/retransmit_to_client') ?>",
					type: "POST",
					data: {
						uniq_id_report: "<?= encrypt($main['uniq_id_report']) ?>",
						status: status,
						method: method
					},
					dataType: "JSON",
					success: (data) => {
						if (data.success) {
							Swal.fire({
								type: "success",
								title: "Successfully Transmited This Document !!",
								timer: 1000
							})

							setTimeout(() => {
								location.reload()
							}, 1000);
						}
					},
					error: (data) => {
						Swal.fire({
							type: "error",
							title: "Something Went Wrong !!",
							timer: 1000
						})
					}
				})
			}
		})

	}

</script>