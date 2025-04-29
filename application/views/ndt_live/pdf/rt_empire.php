<?php
$main = $list[0];
$input_class  = "w-100";
$company_id 			= $joint_list[$main["id_joint"]]['company_id'];
$deck_elevation		= $joint_list[$main["id_joint"]]['deck_elevation'];

$is_disabled = '';
if ($main['status_inspection'] > 0) {
	$is_disabled = "disabled";
}

$legend_inspection          = explode(";", $main["transmittal_inspection_authority"]);
if ((in_array(1, $legend_inspection)) == 1) {
	$checked_type             = "hold";
} elseif ((in_array(2, $legend_inspection)) == 1) {
	$checked_type             = "witness";
} elseif ((in_array(3, $legend_inspection)) == 1 || (in_array(4, $legend_inspection)) == 1) {
	$checked_type             = "review";
}

$arr_delivery = [];
foreach ($mrir_list as $key => $value) {
	$arr_delivery[] = $value['delivery_condition'];
}
$arr_delivery   = array_unique(array_filter($arr_delivery));
?>

<!DOCTYPE html>
<html lang="en">
<title><?= $main['report_no'] ?></title>

<head>
	<style type="text/css">
		@page {
			margin: 0cm 0cm;
		}

		body {
			top: 0cm;
			left: 0cm;
			right: 0cm;
			margin-top: 8.45cm;
			margin-left: 0.5cm;
			margin-right: 0.5cm;
			margin-bottom: 0.3cm;
			font-family: "helvetica";
			font-size: 50% !important;
		}

		header {
			position: fixed;
			top: 0cm;
			left: 0cm;
			right: 0cm;
			height: 1cm;
			margin-top: 0.5cm;
			margin-left: 0.5cm;
			margin-right: 0.5cm;
			border-collapse: collapse;

			/* padding-top: 0.5cm;
			padding-left: 0.5cm;
			padding-right: 0.5cm; */

		}
	</style>

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
			/* border-bottom: 0px; */
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
			white-space: nowrap !important;
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

		label {
			margin: 0px;
		}

		h4 {
			margin: 0;
		}

		.no-bx {
			border-left: 0px;
			border-right: 0px;
		}

		#id_tbl_main_information td {
			border: 0;
			border-top: 1px solid #212529;
			border-bottom: 1px solid #212529;
		}

		#id_tbl_main_information tr:last-child td {
			border-bottom: 0;
		}

		#id_tbl_main_information tr td:first-child {
			border-left: 1px solid #212529;
		}

		#id_tbl_main_information tr td:last-child {
			border-right: 1px solid #212529;
		}

		#id_tbl_main_information tr td:nth-child(3) {
			border-right: 1px solid #212529;
		}

		.text-top {
			vertical-align: top !important;
		}

		.text-left {
			text-align: left !important;
		}

		.text-center {
			text-align: center !important;
		}

		.text-right {
			text-align: right !important;
		}

		.w-100 {
			width: 100%;
		}

		.no-bb {
			border-bottom: 0 !important;
		}

		input[type=checkbox] {
			display: inline;
		}

		.image-sketch {
			width: 2cm;
		}

		.font-weight-bold {
			font-weight: bold;
		}
	</style>
</head>

<!-- HEADER -->
<header>
	<table>
		<tr>
			<td class="col-table-inner">
				<table>
					<thead>
						<tr>
							<td width="23%" class="text-left valign-middle">
								<img style="width:3cm" src="img/seatrium-logo.png">
							</td>
							<td width="50%" class="text-center valign-middle">
								<span style="font-size: 15px !important"><strong><?= $main['id_project'] == '17' ? 'Changhua 2204 Offshore Windfarm Project' : $project[$main['id_project']]['description'] ?></strong></span>
							</td>

							<td width="23%" class="text-right valign-middle">
								<img src="<?= $project[$main['id_project']]['client_logo'] ?>" style='width: 2.5cm;' />
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
				<!-- MAIN INFORMATION -->
			<table id="id_tbl_main_information" style="padding-top: -1px;">
				<thead>
					<tr>
						<td class="col-title col-nowrap">COMPANY</td>
						<td class="col-title col-nowrap">:</td>
						<td><?= $project[$main['id_project']]['client'] ?></td>
						<td class="col-title col-nowrap">REPORT NO.</td>
						<td class="col-title col-nowrap">:</td>
						<td><?= $main['report_no'] ?></td>
					</tr>
					<tr>
						<td class="col-title col-nowrap">Project Name</td>
						<td class="col-title col-nowrap">:</td>
						<td><?= $project[$main['id_project']]['project_name'] ?></td>
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
						<td class="col-title col-nowrap">Standard / Code</td>
						<td class="col-title col-nowrap">:</td>
						<td><?= $acceptance_criteria_form[$main['id_project']][$joint_list[$main['id_joint']]['company_id']][$main['discipline']][$main['module']][$main['type_of_module']][$joint_list[$main['id_joint']]['class']]['ndt']['rt']['standard_code'] ?></td>
						<td class="col-title col-nowrap">Page No</td>
						<td class="col-title col-nowrap">:</td>
						<td></td>

					</tr>
					<tr>
						<td class="col-title col-nowrap">Acceptance Criteria</td>
						<td class="col-title col-nowrap">:</td>
						<td><?= $acceptance_criteria_form[$main['id_project']][$joint_list[$main['id_joint']]['company_id']][$main['discipline']][$main['module']][$main['type_of_module']][$joint_list[$main['id_joint']]['class']]['ndt']['rt']['acceptance_criteria'] ?></td>
						<td class="col-title col-nowrap">Date Of Inspection</td>
						<td class="col-title col-nowrap">:</td>
						<td><?= date('Y-m-d', strtotime($main['date_of_inspection'])) ?></td>
					</tr>
					<tr>
						<td class="col-title col-nowrap">Procedure No.</td>
						<td class="col-title col-nowrap">:</td>
						<td><?= $acceptance_criteria_form[$main['id_project']][$joint_list[$main['id_joint']]['company_id']][$main['discipline']][$main['module']][$main['type_of_module']][$joint_list[$main['id_joint']]['class']]['ndt']['rt']['procedure'] ?> Rev.<?= $acceptance_criteria_form[$main['id_project']][$joint_list[$main['id_joint']]['company_id']][$main['discipline']][$main['module']][$main['type_of_module']][$joint_list[$main['id_joint']]['class']]['ndt']['rt']['procedure_rev'] ?></td>
						<td class="col-title col-nowrap">Date Of RFI</td>
						<td class="col-title col-nowrap">:</td>
						<td><?= date('Y-m-d', strtotime($main['transmittal_inspection_datetime'])) ?></td>
					</tr>
					<tr>
						<td class="col-title col-nowrap">GA/ASSY/ISOMETRIC Drawing No.</td>
						<td class="col-title col-nowrap">:</td>
						<td><?= $main['drawing_no'] ?> Rev.<?= $main['drawing_rev_no'] ?></td>
						<td class="col-title col-nowrap">Testing Location</td>
						<td class="col-title col-nowrap">:</td>
						<td><?= $main['testing_location'] ?></td>
					</tr>
					<tr>
						<td rowspan="4" class="col-title col-nowrap no-bb">Job Description</td>
						<td rowspan="4" class="col-title col-nowrap no-bb">:</td>
						<td rowspan="4" class="no-bb"><?= $main['job_desc'] == '' ? $data_drawing[$main['drawing_no']]['title'] : $main['job_desc'] ?></td>
						<td class="col-title col-nowrap">Job No.</td>
						<td class="col-title col-nowrap">:</td>
						<td><?= $main['job_no'] == "" ? "2013J310012" : $main['job_no'] ?></td>

					</tr>
					<tr>
						<td class="col-title col-nowrap">Grade Material</td>
						<td class="col-title col-nowrap">:</td>
						<td><?= $main['grade_material'] ?></td>
					</tr>
					<tr>
						<td class="col-title col-nowrap">Delivery Condition</td>
						<td class="col-title col-nowrap">:</td>
						<td><?= $main["delivery_condition"] == "" ? implode(", ", $arr_delivery) : $main["delivery_condition"] ?></td>
					</tr>
					<tr>
						<td class="col-title col-nowrap">PWHT Status</td>
						<td class="col-title col-nowrap">:</td>
						<td><?= $main['status_pwht'] == "" ? "N/A" : $main['status_pwht'] ?></td>
					</tr>

				</thead>
			</table>
			</td>
		</tr>
	</table>
</header>

<body>
	<div id="report_rt">
		<div id="report_rt_content">
			<!-- <table>
				<tr>
					<td class="col-table-inner">
						<table>
							<thead>
								<tr>
									<td width="23%" class="text-left valign-middle">
										<img style="width:3cm" src="img/seatrium-logo.png">
									</td>
									<td width="50%" class="text-center valign-middle">
										<span style="font-size: 15px !important"><strong><?= $project[$main['id_project']]['description'] ?></strong></span>
									</td>

									<td width="23%" class="text-right valign-middle">
										<img src="<?= $project[$main['id_project']]['client_logo'] ?>" style='width: 2.5cm;' />
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
			</table> -->
			
			<!-- NDT RT DETAIL INFORMATION -->
			<table>
				<tbody>
					<tr>
						<td class="col-table-inner text-top" style="width: 35%;">
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
									<td> <label>
											<input type="checkbox" <?= $is_disabled ?> name="exposure" value="YES" <?= $main['sc_as_welded'] == 'YES' ? 'checked' : '' ?>>
										</label>
									</td>
								</tr>
								<tr>
									<td class="col-title col-nowrap">Brush Cleaned</td>
									<td class="col-title col-nowrap">:</td>
									<td>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="sc_brush_cleaned" value="YES" <?= $main['sc_brush_cleaned'] == 'YES' ? 'checked' : '' ?>>
										</label>
									</td>
								</tr>
								<tr>
									<td class="col-title col-nowrap">Ground Flush</td>
									<td class="col-title col-nowrap">:</td>
									<td>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="sc_ground_flush" value="YES" <?= $main['sc_ground_flush'] == 'YES' ? 'checked' : '' ?>>
										</label>
									</td>
								</tr>
								<tr>
									<td class="col-title col-nowrap">Others</td>
									<td class="col-title col-nowrap">:</td>
									<td>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="sc_others" value="YES" <?= $main['sc_others'] == 'YES' ? 'checked' : '' ?>>
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
											<input type="checkbox" <?= $is_disabled ?> name="es_after_weld" value="YES" <?= $main['es_after_weld'] == 'YES' ? 'checked' : '' ?>>
										</label>
									</td>
								</tr>
								<tr>
									<td class="col-title col-nowrap">After PWHT</td>
									<td class="col-title col-nowrap">:</td>
									<td>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="es_after_pwht" value="YES" <?= $main['es_after_pwht'] == 'YES' ? 'checked' : '' ?>>
										</label>
									</td>
								</tr>
								<tr>
									<td class="col-title col-nowrap">After Repair (Grinding)</td>
									<td class="col-title col-nowrap">:</td>
									<td>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="es_after_repair" value="YES" <?= $main['es_after_repair'] == 'YES' ? 'checked' : '' ?>>
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
									<td><i>N/A</i></td>
								</tr>
								<tr>
									<td class="col-title col-nowrap">Size / ID / OD</td>
									<td class="col-title col-nowrap">:</td>
									<td class="col-table-inner">
										<table>
											<tr>
												<td><?= $main['size_part'] ?></td>
												<td class="col-nowrap">mm/inch</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td class="col-title col-nowrap">Sch</td>
									<td class="col-title col-nowrap">:</td>
									<td><?= $main['sch'] == "" ? $joint_list[$main['id_joint']]['sch'] : $main['sch'] ?></td>
								</tr>
								<tr>
									<td class="col-title col-nowrap">Mat'l Type</td>
									<td class="col-title col-nowrap">:</td>
									<td><i>N/A</i></td>
								</tr>
								<tr>
									<td class="col-title col-nowrap">Mat'l Thk.</td>
									<td class="col-title col-nowrap">:</td>
									<td class="col-table-inner">
										<table>
											<tr>
												<td class="col-nowrap"><?= $main['matl_thk'] ?></td>
												<td class="col-nowrap">
													<label>
														<input type="checkbox" <?= $is_disabled ?> name="unit_matl_thk" value="1" <?= $main['unit_matl_thk'] == '1' ? 'checked' : '' ?>>
														In
													</label>
													<label>
														<input type="checkbox" <?= $is_disabled ?> name="unit_matl_thk" value="2" <?= $main['unit_matl_thk'] == '2' ? 'checked' : '' ?>>
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
												<td class="col-nowrap"><?= $main['weld_thk'] == "" ? $joint_list[$main['id_joint']]['thickness'] : $main['weld_thk'] ?></td>
												
												<td class="col-nowrap">
													<label>
														<input type="checkbox" <?= $is_disabled ?> name="unit_weld_thk" value="1" <?= $main['unit_weld_thk'] == '1' ? 'checked' : '' ?>>
														In
													</label>
													<label>
														<input type="checkbox" <?= $is_disabled ?> name="unit_weld_thk" value="2" <?= $main['unit_weld_thk'] == '2' ? 'checked' : '' ?>>
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
												<td class="col-nowrap"><?= $main['reinforc_thk'] ?></td>
												<td class="col-nowrap">
													<label>
														<input type="checkbox" <?= $is_disabled ?> name="unit_reinforc_thk" value="1" <?= $main['unit_reinforc_thk'] == '1' ? 'checked' : '' ?>>
														In
													</label>
													<label>
														<input type="checkbox" <?= $is_disabled ?> name="unit_reinforc_thk" value="2" <?= $main['unit_reinforc_thk'] == '2' ? 'checked' : '' ?>>
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
											<input type="checkbox" <?= $is_disabled ?> name="backing_ring" value="1" <?= $main['backing_ring'] == '1' ? 'checked' : '' ?>>
											Yes
										</label>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="backing_ring" value="2" <?= $main['backing_ring'] == '2' ? 'checked' : '' ?>>
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
									<td><?= $main['manufacture'] ?></td>
								</tr>
								<tr>
									<td class="col-title col-nowrap">Type of Film</td>
									<td class="col-title col-nowrap">:</td>
									<td><?= $main['type_of_film'] ?></td>
								</tr>
								<tr>
									<td class="col-title col-nowrap">Dimension</td>
									<td class="col-title col-nowrap">:</td>
									<td class="col-table-inner">
										<table>
											<tr>
												<td><?= $main['dimension'] ?></td>
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
												<td><?= $main['total_of_film'] ?></td>
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
												<td class="col-nowrap"><?= $main['thickness'] ?></td>
												<td class="col-nowrap">
													<label>
														<input type="checkbox" <?= $is_disabled ?> name="unit_thickness" value="1" <?= $main['unit_thickness'] == '1' ? 'checked' : '' ?>>
														In
													</label>
													<label>
														<input type="checkbox" <?= $is_disabled ?> name="unit_thickness" value="2" <?= $main['unit_thickness'] == '2' ? 'checked' : '' ?>>
														mm
													</label>
												</td>
												<td><i>N/A</i></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
						<td class="col-table-inner text-top" style="width: 35%;">
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
											<input type="checkbox" <?= $is_disabled ?> name="isotope" value="1" <?= $main['isotope'] == '1' ? 'checked' : '' ?>>
											Ir-192
										</label>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="isotope" value="2" <?= $main['isotope'] == '2' ? 'checked' : '' ?>>
											Co-60
										</label>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="isotope" value="4" <?= $main['isotope'] == '4' ? 'checked' : '' ?>>
											Se-75
										</label><br>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="isotope" value="3" <?= $main['isotope'] == '3' ? 'checked' : '' ?>>
											Other <u><?= $main['isotope_other'] ?></u>
										</label>
									</td>
								</tr>
								<tr>
									<td class="col-title col-nowrap">Activity</td>
									<td class="col-title col-nowrap">:</td>
									<td class="col-table-inner">
										<table>
											<tr>
												<td class="col-nowrap">
													<input type="checkbox" <?= $is_disabled ?> name="activity" value="1" <?= $main['activity'] == '1' ? 'checked' : '' ?>> Ci
												</td>
												<td class="col-nowrap">Kv :</td>
												<td><?= $main['activity_kv'] ?></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td class="col-title col-nowrap">Current A</td>
									<td class="col-title col-nowrap">:</td>
									<td><?= $main['current_a'] ?></td>
								</tr>
								<tr>
									<td class="col-title col-nowrap">Size / Focal Spot</td>
									<td class="col-title">:</td>
									<td class="col-table-inner">
										<table>
											<tr>
												<td><?= $main['size_focal_spot'] ?></td>
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
									<td>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="technique" value="1" <?= $main['technique'] == '1' ? 'checked' : '' ?>>
											RT CLASS A
										</label>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="technique" value="2" <?= $main['technique'] == '2' ? 'checked' : '' ?>>
											RT CLASS B
										</label>
									</td>
								</tr>
								<tr>
									<td class="col-nowrap"><b>Geometric Unsharpness</b> : <?= $main['geometric_unsharpness'] == "" ? "<i>N/A</i>" : $main['geometric_unsharpness'] ?></td>
								</tr>
								<tr>
									<td class="col-nowrap"><b>SFD</b> : <?= $main['sfd'] ?></td>
								</tr>
								<tr>
									<td class="col-nowrap"><b>Exposure</b> :
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="exposure" value="1" <?= $main['exposure'] == '1' ? 'checked' : '' ?>>
											Single Wall
										</label>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="exposure" value="2" <?= $main['exposure'] == '2' ? 'checked' : '' ?>>
											Double Wall
										</label>
									</td>
								</tr>
								<tr>
									<td class="col-nowrap"><b>Viewing</b> :
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="viewing" value="1" <?= $main['viewing'] == '1' ? 'checked' : '' ?>>
											Single Wall
										</label>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="viewing" value="2" <?= $main['viewing'] == '2' ? 'checked' : '' ?>>
											Double Wall
										</label>
									</td>
								</tr>
								<tr>
									<td class="col-nowrap"><b>Exposure Time</b> : Mnt <input type="checkbox" <?= $is_disabled ?> name="exposure_time_ismnt" value="1" <?= $main['exposure_time_ismnt'] == '1' ? 'checked' : '' ?>>
									</td>
								</tr>
								<tr>
									<td class="col-nowrap"><b>Min. SOD*</b> : <?= $main['min_sod'] ?> mm <b>DSSOF**</b> : <?= $main['min_dssof'] ?> mm</td>
								</tr>
								<tr>
									<td class="col-nowrap"><b>No of Film in Holder</b> :
										<input type="checkbox" <?= $is_disabled ?> name="no_film_holder" value="1" <?= $main['no_film_holder'] == '1' ? 'checked' : '' ?>>
										Single
										<input type="checkbox" <?= $is_disabled ?> name="no_film_holder" value="2" <?= $main['no_film_holder'] == '2' ? 'checked' : '' ?>>
										Multiple
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
									<td class="col-nowrap"><b>Type of Penetrameter</b> :
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="type_of_penetrameter" value="1" <?= $main['type_of_penetrameter'] == '1' ? 'checked' : '' ?>>
											ASTM
										</label>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="type_of_penetrameter" value="2" <?= $main['type_of_penetrameter'] == '2' ? 'checked' : '' ?>>
											EN/DIN
										</label>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="type_of_penetrameter" value="3" <?= $main['type_of_penetrameter'] == '3' ? 'checked' : '' ?>>
											ASTM IA
										</label>
									</td>
								</tr>
								<tr>
									<td class="col-nowrap">
										<label>
											<b>Wire </b>
											<input type="checkbox" <?= $is_disabled ?> name="wire" value="1" <?= $main['wire'] == '1' ? 'checked' : '' ?>>
										</label>
										:
										<?php
												$wire_no_list = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16];
												foreach ($wire_no_list as $key => $value) :
												?>
											<label>
												<input type="checkbox" <?= $is_disabled ?> name="wire_no" value="<?= $value ?>" <?= $main['wire_no'] == $value ? 'checked' : '' ?>>
												<?= $value ?>
											</label>
										<?php endforeach; ?>
									</td>
								</tr>
								<tr>
									<td class="col-nowrap"><b>Placement</b> :
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="placement" value="1" <?= $main['placement'] == '1' ? 'checked' : '' ?>>
											Source Side
										</label>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="placement" value="2" <?= $main['placement'] == '2' ? 'checked' : '' ?>>
											Film Side
										</label>
									</td>
								</tr>
								<tr>
									<td class="col-nowrap"><b>Block Thickness</b> : <?= $main['block_thickness'] ?> mm</td>
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
											<input type="checkbox" <?= $is_disabled ?> name="marker_placement" value="1" <?= $main['marker_placement'] == '1' ? 'checked' : '' ?>>
											Source Side
										</label>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="marker_placement" value="2" <?= $main['marker_placement'] == '2' ? 'checked' : '' ?>>
											Film Side
										</label>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="marker_placement" value="3" <?= $main['marker_placement'] == '3' ? 'checked' : '' ?>>
											Inside
										</label>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="marker_placement" value="4" <?= $main['marker_placement'] == '4' ? 'checked' : '' ?>>
											OutSide
										</label>
									</td>
								</tr>
								<tr>
									<td class="col-title col-nowrap">Use back scatter</td>
									<td class="col-title col-nowrap">:</td>
									<td>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="use_back_scatter" value="1" <?= $main['use_back_scatter'] == '1' ? 'checked' : '' ?>>
											Yes
										</label>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="use_back_scatter" value="2" <?= $main['use_back_scatter'] == '2' ? 'checked' : '' ?>>
											No
										</label>
									</td>
								</tr>
							</table>
						</td>
						<td class="col-table-inner text-top" style="width: 30%;">
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
											<input type="checkbox" <?= $is_disabled ?> name="technique_sketch" value="<?= $technique_sketch_list['main'][$id_ts]['id'] ?>" <?= ($technique_sketch_list['main'][$id_ts]['id'] == $main['technique_sketch'] ? 'checked' : '') ?>>
											<?= $technique_sketch_list['main'][$id_ts]['name'] ?>
										</label>
										<br>
										<img class="image-sketch" src="img/rt_technique_sketch/<?= $technique_sketch_list['main'][$id_ts]['picture'] ?>">
									</td>
									<td>
										<?php
										$id_ts = 2;
										?>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="technique_sketch" value="<?= $technique_sketch_list['main'][$id_ts]['id'] ?>" <?= ($technique_sketch_list['main'][$id_ts]['id'] == $main['technique_sketch'] ? 'checked' : '') ?>>
											<?= $technique_sketch_list['main'][$id_ts]['name'] ?>
										</label>
										<br>
										<img class="image-sketch" src="img/rt_technique_sketch/<?= $technique_sketch_list['main'][$id_ts]['picture'] ?>">
									</td>
								</tr>
								<tr>
									<td>
										<?php
										$id_ts = 3;
										?>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="technique_sketch" value="<?= $technique_sketch_list['main'][$id_ts]['id'] ?>" <?= ($technique_sketch_list['main'][$id_ts]['id'] == $main['technique_sketch'] ? 'checked' : '') ?>>
											<?= $technique_sketch_list['main'][$id_ts]['name'] ?>
										</label>
										<br>
										<img class="image-sketch" src="img/rt_technique_sketch/<?= $technique_sketch_list['main'][$id_ts]['picture'] ?>">
									</td>
									<td>
										<?php
										$id_ts = 4;
										?>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="technique_sketch" value="<?= $technique_sketch_list['main'][$id_ts]['id'] ?>" <?= ($technique_sketch_list['main'][$id_ts]['id'] == $main['technique_sketch'] ? 'checked' : '') ?>>
											<?= $technique_sketch_list['main'][$id_ts]['name'] ?>
										</label>
										<br>
										<img class="image-sketch" src="img/rt_technique_sketch/<?= $technique_sketch_list['main'][$id_ts]['picture'] ?>">
									</td>
								</tr>
								<tr>
									<td>
										<?php
										$id_ts = 5;
										?>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="technique_sketch" value="<?= $technique_sketch_list['main'][$id_ts]['id'] ?>" <?= ($technique_sketch_list['main'][$id_ts]['id'] == $main['technique_sketch'] ? 'checked' : '') ?>>
											<?= $technique_sketch_list['main'][$id_ts]['name'] ?>
										</label>
										<br>
										<img class="image-sketch" src="img/rt_technique_sketch/<?= $technique_sketch_list['main'][$id_ts]['picture'] ?>">
									</td>
									<td>
										<?php
										$id_ts = 6;
										?>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="technique_sketch" value="<?= $technique_sketch_list['main'][$id_ts]['id'] ?>" <?= ($technique_sketch_list['main'][$id_ts]['id'] == $main['technique_sketch'] ? 'checked' : '') ?>>
											<?= $technique_sketch_list['main'][$id_ts]['name'] ?>
										</label>
										<br>
										<img class="image-sketch" src="img/rt_technique_sketch/<?= $technique_sketch_list['main'][$id_ts]['picture'] ?>">
									</td>
								</tr>
								<tr>
									<td>
										<?php
										$id_ts = 7;
										?>
										<label>
											<input type="checkbox" <?= $is_disabled ?> name="technique_sketch" value="<?= $technique_sketch_list['main'][$id_ts]['id'] ?>" <?= ($technique_sketch_list['main'][$id_ts]['id'] == $main['technique_sketch'] ? 'checked' : '') ?>>
											<?= $technique_sketch_list['main'][$id_ts]['name'] ?>
										</label>
										<br>
										<img class="image-sketch" src="img/rt_technique_sketch/<?= $technique_sketch_list['main'][$id_ts]['picture'] ?>">
									</td>
									<td>
										<?php if (isset($technique_sketch_list['other'][$main['technique_sketch']])) : ?>
											<?php
											$technique_sketch = $technique_sketch_list['other'][$main['technique_sketch']];
											?>
											<label>
												<input type="checkbox" checked>
												<?= $technique_sketch['name'] ?>
											</label>
											<br>
											<img class="image-sketch" src="img/rt_technique_sketch/<?= $technique_sketch['picture'] ?>">
										<?php else : ?>
											<label>
												<input type="checkbox">
												Other
											</label>
										<?php endif; ?>
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
					$cek = [];
					$no = 0;
					foreach ($list as $key => $value) :
						if (in_array($value['id_joint'], $cek)) {
							continue;
						}
						$cek[] = $value['id_joint'];

						foreach ($film_list[$value['id_rt']] ?? [[]] as $film) :
							$no++;
					?>
							<tr>
								<input type="hidden" name="id_rt[]" value="<?= $value['id_rt'] ?>">
								<td><?= $no ?></td>
								<td><?= $joint_list[$value['id_joint']]['discipline'] == 1 ? ($joint_list[$value['id_joint']]['spool_no'] ? $joint_list[$value['id_joint']]['drawing_wm'] . ' Rev.' . $joint_list[$value['id_joint']]['rev_wm'] . ' / ' . $joint_list[$value['id_joint']]['spool_no'] : $joint_list[$value['id_joint']]['drawing_wm'])  : $joint_list[$value['id_joint']]['drawing_wm'] . ' Rev.' . $joint_list[$value['id_joint']]['rev_wm'] ?></td>
								<td><?= $joint_list[$value['id_joint']]['joint_no'] . ($visual_rev[$value['id_visual']]['revision'] > 0 ? '(' . $visual_rev[$value['id_visual']]['revision_category'] . $visual_rev[$value['id_visual']]['revision'] . ')' : '') ?></td>
								<td><?= $film['location'] ?></td>
								<td><?= $master_class[$joint_list[$value['id_joint']]['class']]['class_code'] ?></td>


								<td><?= ($visual[$value['id_visual']]['revision'] > 0) ? $visual[$value['id_visual']]['length_of_weld'] : $joint[$value['id_joint']]['weld_length'] ?></td>
								<td><?= $film['tested_length'] ?></td>

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
								</td>
								<?php
								if ($film['result'] == 1) { ?>
									<td>ACC</td>
									<td>-</td>
								<?php } elseif ($film['result'] == 2) { ?>
									<td>-</td>
									<td>REJ</td>
								<?php } else { ?>
									<td>-</td>
									<td>-</td>
								<?php } ?>
								<td><?= $film['density_iqi'] ?></td>
								<td><?= $film['density_iqi_max'] ?></td>
								<td><?= $film['density_iqi_min'] ?></td>
								<td><?= $film['sensitivity'] ?></td>
								<td><?= $film['discontinuities_type'] ?></td>
								<td><?= $film['remarks'] ?></td>
							</tr>
						<?php endforeach; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
			<!-- SIGN -->
			<?php if ($visual[$joint_list[$main["id_joint"]]["id"]]["company_id"] == 5) { ?>
				<table>
					<tbody>
						<tr>
							<td class="col-table-inner">

								<table>
									<tr class="font-weight-bold">
										<td style="width: 25%">Tested By :</td>
										<td style="width: 25%">NDT/QC Inspector(DSAW)</td>
										<td style="width: 25%">NDT/QC Inspector(SEATRIUM)</td>
										<td style="width: 25%">Client Inspector</td>
										<td style="width: 25%">3rd Party</td>
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
												<img src="data:image/png;base64,<?= $user[$main['tested_by']]['sign_approval'] ?>" style='width: 3cm; height: 2cm;vertical-align: text-bottom !important;' />
											<?php endif; ?>
										</td>
										<td>
											<?php if ($main['qc_subcont_by']) : ?>
												<img src="data:image/png;base64,<?= $user[$main['qc_subcont_by']]['sign_approval'] ?>" style='width: 3cm; height: 2cm;vertical-align: text-bottom !important;' />
											<?php endif; ?>
										</td>
										<td>
											<?php if ($main['qc_by']) : ?>
												<img src="data:image/png;base64,<?= $user[$main['qc_by']]['sign_approval'] ?>" style='width: 3cm; height: 2cm;vertical-align: text-bottom !important;' />
											<?php endif; ?>
										</td>
										<td>
											<?php // if ($main['client_by']) : 
											?>
											<div style="page-break-inside: avoid;">
												<?php if ($main['id_project'] == 17) : ?>
													<style type="text/css">
														.color_stamp {
															color: rgba(63, 72, 204, 255) !important;
														}

														.check_stamp {
															-ms-transform: scale(1.7) !important;
															-moz-transform: scale(1.7) !important;
															-webkit-transform: scale(1.7) !important;
															-o-transform: scale(1.7) !important;
															transform: scale(1.7) !important;
														}

														.border_stamp {
															border: 3px solid rgba(63, 72, 204, 255) !important;
														}

														.box_stamp {
															padding: 4px;
															font-weight: bold;
															z-index: 99 !important;
															width: 140px;
														}

														.valign_middle {
															vertical-align: middle !important;
														}
													</style>
													<div class="box color_stamp border_stamp box_stamp">
														<center>
															<img src="img/orsted_stamp.png" style="width:35px">
															<br>
															<strong>CHW 2204 OSS Project</strong>
														</center>
														<table cellpadding="0" style="width:100%; border-bottom: none !important">
															<tr>
																<td width="40%" class="valign_middle">Review</td>
																<td><input type="checkbox" style="margin-bottom: 1px" <?= $checked_type == 'review' ? 'checked' : '' ?>></td>
															</tr>
															<tr>
																<td width="40%" class="valign_middle">Witness</td>
																<td><input type="checkbox" style="margin-bottom: 1px" <?= $checked_type == 'hold' or $checked_type == 1 ? 'witness' : '' ?>></td>
															</tr>
															<tr>
																<td width="40%" class="valign_middle">Inspect</td>
																<td><input type="checkbox" style="margin-bottom: 1px" <?= $checked_type == 'hold' ? 'checked' : '' ?>></td>
															</tr>
														</table>
														<br>
														Date : <?= $main['client_date'] ? date('Y-m-d', strtotime($main['client_date'])) : space(15) ?>
														&nbsp;
														<span style="z-index: 99 !important;">Signature :</span>

													</div>
													<div class="text-right" style="padding-right: 5px; padding-bottom:3px;">
														<?php if ($main['client_by']) { ?>
															<img src="data:image/png;base64, <?= $user[$main['client_by']]['sign_approval'] ?>" style='width: 70px !important; position: absolute !important; margin-left: 70px !important; margin-top: -70px !important; z-index: -99 !important; 
                                /*		                  	border: 5px solid #555;*/
		                  	' />
														<?php } ?>
													</div>
												<?php else : ?>
													<?php if ($main['client_by']) { ?>
														<img src="data:image/png;base64,<?= $user[$main['client_by']]['sign_approval'] ?>" style='width: 3.5cm;vertical-align: text-bottom !important;' />
													<?php } ?>
												<?php endif; ?>
											</div>

											<!-- <img src="data:image/png;base64,<?= $user[$main['client_by']]['sign_approval'] ?>" style='width: 3cm; height: 2cm;vertical-align: text-bottom !important;' /> -->
											<?php // endif; 
											?>
										</td>
										<td>
											<?php if ($main['third_party_approval_by']) : ?>
												<img src="data:image/png;base64,<?= $user[$main['third_party_approval_by']]['sign_approval'] ?>" style='width: 3cm; height: 2cm;vertical-align: text-bottom !important;' />
											<?php endif; ?>
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
										<td>Date : <?= $main['tested_date'] ? date('Y-m-d', strtotime($main['tested_date'])) : '' ?></td>
										<td>Date : <?= $main['qc_subcont_date'] ? date('Y-m-d', strtotime($main['qc_subcont_date'])) : '' ?></td>
										<td>Date : <?= $main['qc_date'] ? date('Y-m-d', strtotime($main['qc_date'])) : '' ?></td>
										<td>Date : <?= $main['client_date'] ? date('Y-m-d', strtotime($main['client_date'])) : '' ?></td>
										<td>Date : <?= $main['third_party_approval_date'] ? date('d-M-Y', strtotime($main['third_party_approval_date'])) : '' ?></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>

			<?php } else { ?>

				<table>
					<tbody>
						<tr>
							<td class="col-table-inner">

								<table>
									<tr class="font-weight-bold">
										<td style="width: 25%">Tested By :</td>
										<td style="width: 25%">NDT/QC Inspector</td>
										<td style="width: 25%">Client Inspector</td>
										<td style="width: 25%">3rd Party</td>
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
												<img src="data:image/png;base64,<?= $user[$main['tested_by']]['sign_approval'] ?>" style='width: 3cm; height: 2cm;vertical-align: text-bottom !important;' />
											<?php endif; ?>
										</td>
										<td>
											<?php if ($main['qc_by']) : ?>
												<img src="data:image/png;base64,<?= $user[$main['qc_by']]['sign_approval'] ?>" style='width: 3cm; height: 2cm;vertical-align: text-bottom !important;' />
											<?php endif; ?>
										</td>
										<td>
											<?php // if ($main['client_by']) : 
											?>
											<div style="page-break-inside: avoid;">
												<?php if ($main['id_project'] == 17) : ?>
													<style type="text/css">
														.color_stamp {
															color: rgba(63, 72, 204, 255) !important;
														}

														.check_stamp {
															-ms-transform: scale(1.7) !important;
															-moz-transform: scale(1.7) !important;
															-webkit-transform: scale(1.7) !important;
															-o-transform: scale(1.7) !important;
															transform: scale(1.7) !important;
														}

														.border_stamp {
															border: 3px solid rgba(63, 72, 204, 255) !important;
														}

														.box_stamp {
															padding: 4px;
															font-weight: bold;
															z-index: 99 !important;
															width: 140px;
														}

														.valign_middle {
															vertical-align: middle !important;
														}
													</style>
													<div class="box color_stamp border_stamp box_stamp">
														<center>
															<img src="img/orsted_stamp.png" style="width:35px">
															<br>
															<strong>CHW 2204 OSS Project</strong>
														</center>
														<table cellpadding="0" style="width:100%; border-bottom: none !important">
															<tr>
																<td width="40%" class="valign_middle">Review</td>
																<td><input type="checkbox" style="margin-bottom: 1px" <?= $checked_type == 'review' ? 'checked' : '' ?>></td>
															</tr>
															<tr>
																<td width="40%" class="valign_middle">Witness</td>
																<td><input type="checkbox" style="margin-bottom: 1px" <?= $checked_type == 'hold' or $checked_type == 1 ? 'witness' : '' ?>></td>
															</tr>
															<tr>
																<td width="40%" class="valign_middle">Inspect</td>
																<td><input type="checkbox" style="margin-bottom: 1px" <?= $checked_type == 'hold' ? 'checked' : '' ?>></td>
															</tr>
														</table>
														<br>
														Date : <?= $main['client_date'] ? date('Y-m-d', strtotime($main['client_date'])) : space(15) ?>
														&nbsp;
														<span style="z-index: 99 !important;">Signature :</span>

													</div>
													<div class="text-right" style="padding-right: 5px; padding-bottom:3px;">
														<?php if ($main['client_by']) { ?>
															<img src="data:image/png;base64, <?= $user[$main['client_by']]['sign_approval'] ?>" style='width: 70px !important; position: absolute !important; margin-left: 70px !important; margin-top: -70px !important; z-index: -99 !important; 
                                /*		                  	border: 5px solid #555;*/
		                  	' />
														<?php } ?>
													</div>
												<?php else : ?>
													<?php if ($main['client_by']) { ?>
														<img src="data:image/png;base64,<?= $user[$main['client_by']]['sign_approval'] ?>" style='width: 3.5cm;vertical-align: text-bottom !important;' />
													<?php } ?>
												<?php endif; ?>
											</div>

											<!-- <img src="data:image/png;base64,<?= $user[$main['client_by']]['sign_approval'] ?>" style='width: 3cm; height: 2cm;vertical-align: text-bottom !important;' /> -->
											<?php // endif; 
											?>
										</td>
										<td>
											<?php if ($main['third_party_approval_by']) : ?>
												<img src="data:image/png;base64,<?= $user[$main['third_party_approval_by']]['sign_approval'] ?>" style='width: 3cm; height: 2cm;vertical-align: text-bottom !important;' />
											<?php endif; ?>
										</td>
									</tr>
									<tr class="font-weight-bold">
										<td><?= @$user[$main['tested_by']]['full_name'] ?? 'Name / Signature' ?></td>
										<td><?= @$user[$main['qc_by']]['full_name'] ?? 'Name / Signature' ?></td>
										<td><?= @$user[$main['client_by']]['full_name'] ?? 'Name / Signature' ?></td>
										<td><?= @$user[$main['third_party_approval_by']]['full_name'] ?? 'Name / Signature' ?></td>
									</tr>
									<tr class="font-weight-bold">
										<td>Date : <?= $main['tested_date'] ? date('Y-m-d', strtotime($main['tested_date'])) : '' ?></td>
										<td>Date : <?= $main['qc_date'] ? date('Y-m-d', strtotime($main['qc_date'])) : '' ?></td>
										<td>Date : <?= $main['client_date'] ? date('Y-m-d', strtotime($main['client_date'])) : '' ?></td>
										<td>Date : <?= $main['third_party_approval_date'] ? date('d-M-Y', strtotime($main['third_party_approval_date'])) : '' ?></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>

			<?php } ?>


			<!-- FOOTER -->
			<table>
				<tbody>
					<tr class="font-weight-bold">
						<td>
							Note : *) SOD = Source to Object Distance, **) DSSOF = Distance from Source Side of Object to the Film at the minimum Source to Object Distance<br>
							IF = Incomplete Fusion, IP = Incomplete Penetration, RC = Root Concavity, RUC = Root Undercut, P = Porosity, Incl = Inclusion, Crk = Crack, ND = No Defect<br>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</body>

</html>