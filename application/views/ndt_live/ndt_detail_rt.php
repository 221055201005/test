<?php
$main = $list[0];
$input_class  = "w-100";

$is_disabled = '';
if ($main['status_inspection'] > 0) {
	$is_disabled = "disabled";
}
// test_var($main);
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
																	<!-- <td><input type="text" name="standart_code" class="<?= $input_class ?>" value="<?= $main['standart_code'] ?>" <?= $is_disabled ?>></td> -->
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Acceptance Criteria</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><?= $acceptance_criteria_form[$main['id_project']][$joint_list[$main['id_joint']]['company_id']][$main['discipline']][$main['module']][$main['type_of_module']][$joint_list[$main['id_joint']]['class']]['ndt']['rt']['acceptance_criteria'] ?></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Procedure No.</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><?= $acceptance_criteria_form[$main['id_project']][$joint_list[$main['id_joint']]['company_id']][$main['discipline']][$main['module']][$main['type_of_module']][$joint_list[$main['id_joint']]['class']]['ndt']['rt']['procedure'] ?></td>
																	<!-- <td><input type="text" name="report_no" class="<?= $input_class ?>" value="<?= $main['report_no'] ?>" <?= $is_disabled ?>></td> -->
																</tr>
																<tr>
																	<td class="col-title col-nowrap">GA/ASSY/ISOMETRIC Drawing No.</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><?= $main['drawing_no'] ?> Rev.<?= $main['drawing_rev_no'] ?></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Job Description</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><textarea rows="3" name="job_desc" class="<?= $input_class ?>" <?= $is_disabled ?>><?= $main['job_desc'] ?></textarea></td>
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
																	<td><?= $main['rfi_no'] ?></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">PAGE NO.</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="page_no" class="<?= $input_class ?>" value="<?= $main['page_no'] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Date Of Inspection</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="date" name="date_of_inspection" class="<?= $input_class ?>" value="<?= date('Y-m-d', strtotime($main['date_of_inspection'])) ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Date Of RFI</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="date" name="date_of_rfi" class="<?= $input_class ?>" value="<?= date('Y-m-d', strtotime($main['date_of_rfi'])) ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Testing Location</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="testing_location" class="<?= $input_class ?>" value="<?= $main['testing_location'] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Job No.</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="job_no" class="<?= $input_class ?>" value="<?= $main['job_no'] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Grade Material</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="grade_material" class="<?= $input_class ?>" value="<?= $main['grade_material'] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Delivery Condition</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="delivery_condition" class="<?= $input_class ?>" value="<?= $main['delivery_condition'] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">PWHT Status</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="status_pwht" class="<?= $input_class ?>" value="<?= $main['status_pwht'] ?>" <?= $is_disabled ?>></td>
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
																	<td><input type="text" name="sc_as_welded" class="<?= $input_class ?>" value="<?= $main['sc_as_welded'] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Brush Cleaned</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="sc_brush_cleaned" class="<?= $input_class ?>" value="<?= $main['sc_brush_cleaned'] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Ground Flush</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="sc_ground_flush" class="<?= $input_class ?>" value="<?= $main['sc_ground_flush'] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Others</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="sc_others" class="<?= $input_class ?>" value="<?= $main['sc_others'] ?>" <?= $is_disabled ?>></td>
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
																	<td><input type="text" name="es_after_weld" class="<?= $input_class ?>" value="<?= $main['es_after_weld'] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">After PWHT</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="es_after_pwht" class="<?= $input_class ?>" value="<?= $main['es_after_pwht'] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">After Repair (Grinding)</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="es_after_repair" class="<?= $input_class ?>" value="<?= $main['es_after_repair'] ?>" <?= $is_disabled ?>></td>
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
																	<td><input type="text" name="part_name" class="<?= $input_class ?>" value="<?= $main['part_name'] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Size / ID / OD</td>
																	<td class="col-title col-nowrap">:</td>
																	<td class="col-table-inner">
																		<table>
																			<tr>
																				<td><input type="text" name="size_part" class="<?= $input_class ?>" value="<?= $main['size_part'] ?>" <?= $is_disabled ?>></td>
																				<td class="col-nowrap">mm/inch</td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Sch</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="sch" class="<?= $input_class ?>" value="<?= $main['sch'] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Mat'l Type</td>
																	<td class="col-title col-nowrap">:</td>
																	<td><input type="text" name="matl_type" class="<?= $input_class ?>" value="<?= $main['matl_type'] ?>" <?= $is_disabled ?>></td>
																</tr>
																<tr>
																	<td class="col-title col-nowrap">Mat'l Thk.</td>
																	<td class="col-title col-nowrap">:</td>
																	<td class="col-table-inner">
																		<table>
																			<tr>
																				<td><input type="text" name="matl_thk" class="<?= $input_class ?>" value="<?= $main['matl_thk'] ?>" <?= $is_disabled ?>></td>
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
																				<td><input type="text" name="weld_thk" class="<?= $input_class ?>" value="<?= $main['weld_thk'] ?>" <?= $is_disabled ?>></td>
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
																				<td><input type="text" name="reinforc_thk" class="<?= $input_class ?>" value="<?= $main['reinforc_thk'] ?>" <?= $is_disabled ?>></td>
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
																				<td><input type="text" name="thickness" class="<?= $input_class ?>" value="<?= $main['thickness'] ?>" <?= $is_disabled ?>></td>
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
																	<td><input type="text" name="geometric_unsharpness" class="<?= $input_class ?>" value="<?= $main['geometric_unsharpness'] ?>" <?= $is_disabled ?>></td>
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
																							<td><input type="text" name="min_sod" class="<?= $input_class ?>" value="<?= $main['min_sod'] ?>" <?= $is_disabled ?>></td>
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
																							<td><input type="text" name="min_dssof" class="<?= $input_class ?>" value="<?= $main['min_dssof'] ?>" <?= $is_disabled ?>></td>
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
																			$wire_no_list = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
																			foreach ($wire_no_list as $key => $value): 
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
																				<td><input type="text" name="block_thickness" class="<?= $input_class ?>" value="<?= $main['block_thickness'] ?>" <?= $is_disabled ?>></td>
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
													foreach ($list as $key => $value) :
														// test_var($list);
														$no++;
														$key_no++;
														if (in_array($value['id_joint'], $cek)) {
															continue;
														}
														$cek[] = $value['id_joint'];
													?>
														<tr>
															<input type="hidden" name="id_joint[<?= $key ?>]" value="<?= $value['id_joint'] ?>">
															<td><?= $no ?></td>
															<td><?= $joint_list[$value['id_joint']]['drawing_wm'] ?></td>
															<td><?= $joint_list[$value['id_joint']]['joint_no'] ?></td>
															<td><input type="text" name="rt_item_inspection_category[<?= $key ?>]" class="<?= $input_class ?>" value="<?= $value['inspection_category'] ?>" <?= $is_disabled ?>></td>
															<td><?= $visual_list[$value['id_visual']]['length_of_weld'] ?></td>
															<td>
																<input type="number" name="rt_item_tested_length[<?= $key ?>]" class="<?= $input_class ?>" value="<?= $value['tested_length'] ?>" <?= $is_disabled ?> max="<?= $value['transmittal_request_tested_length'] ?>">
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
															</td>

															<td>
																<input type="radio" name="rt_item_result[<?= $key ?>]" <?= $is_disabled ?> value="1" <?= $value['result'] == 1 ? 'checked' : '' ?>> ACC
															</td>
															<td>
																<input type="radio" name="rt_item_result[<?= $key ?>]" <?= $is_disabled ?> value="2" <?= $value['result'] == 2 ? 'checked' : '' ?>> REJ
															</td>

															<td><input type="text" name="rt_item_density_iqi[<?= $key ?>]" class="<?= $input_class ?>" value="<?= $value['density_iqi'] ?>" <?= $is_disabled ?>></td>
															<td><input type="text" name="rt_item_density_iqi_max[<?= $key ?>]" class="<?= $input_class ?>" value="<?= $value['density_iqi_max'] ?>" <?= $is_disabled ?>></td>
															<td><input type="text" name="rt_item_density_iqi_min[<?= $key ?>]" class="<?= $input_class ?>" value="<?= $value['density_iqi_min'] ?>" <?= $is_disabled ?>></td>
															<td><input type="text" name="rt_item_sensitivity[<?= $key ?>]" class="<?= $input_class ?>" value="<?= $value['sensitivity'] ?>" <?= $is_disabled ?>></td>
															<td><input type="text" name="rt_item_discontinuities_type[<?= $key ?>]" class="<?= $input_class ?>" value="<?= $value['discontinuities_type'] ?>" <?= $is_disabled ?>></td>
															<td><input type="text" name="rt_item_remarks[<?= $key ?>]" class="<?= $input_class ?>" value="<?= $value['remarks'] ?>" <?= $is_disabled ?>></td>
														</tr>
													<?php endforeach; ?>
												</tbody>
											</table>
											<!-- SIGN -->
											<table>
												<tbody>
													<tr>
														<td class="col-table-inner">

															<table>
																<tr class="font-weight-bold">
																	<td>Tested By :</td>
																	<td>QC Inspector</td>
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
																				<?php if ($this->user_cookie[7] != 8) : ?>
																					<?php if ($main['status_inspection'] == 0) : ?>
																						<button type="button" onclick="approval_data(this, 1, 'tested')" class="btn btn-outline-success"><i class="fas fa-signature"></i> Digital Sign</button>
																					<?php endif; ?>
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
																				<?php if ($this->user_cookie[7] != 8) : ?>
																					<?php if ($main['status_inspection'] == 1) : ?>
																						<button type="button" onclick="approval_data(this, 3, 'qc')" class="btn btn-outline-success"><i class="fas fa-signature"></i> Digital Sign</button>
																					<?php endif; ?>
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
																				<?php if ($main['status_inspection'] == 5) : ?>
																					<button type="button" onclick="approval_data(this, 7, 'client')" class="btn btn-outline-success"><i class="fas fa-signature"></i> Digital Sign</button>
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
												</tbody>
											</table>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-md-12 text-center p-2">
											<?php if ($main['status_inspection'] == 0) : ?>
												<button type="submit" class="btn btn-warning"><i class="fas fa-edit"> </i> Update</button>
											<?php endif; ?>
											<?php if ($main['status_inspection'] == 3) : ?>
												<button type="button" onclick="approval_data(this, 5, 'invite_client')" class="btn btn-info"><i class="fas fa-exchange-alt"></i> Transmit to Client</button>
											<?php endif; ?>
											<?php if ($user_permission[208] == 1 && $main['status_inspection'] != 12) { ?>
												<button type="button" data-uniq_id_report="<?= $main['uniq_id_report'] ?>" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Void&nbsp;</b> this?', this, event, 'void_row_db')" class="btn btn-danger btn-sm"><i class="fa fa-exclamation-triangle"></i> Void</button>
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
																<th><button type="button" class="btn btn-sm btn-info" onclick="addCTQ()"><i class="fas fa-plus"></i></button></th>
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
																		<td><button type="button" class="btn btn-sm btn-danger" onclick="removeCTQ(<?= $value['id'] ?>)"><i class="fas fa-trash"></i></button></td>
																	<tr>
																	<?php } ?>
															</tbody>
														</table>
													</div>

												</div>
												<div class="col-md-12 text-right">
													<hr>
													<button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Save</button>
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
																<textarea name='remarks' class='form-control' required="" style="height: 100px !important"></textarea>
																<input type="hidden" class="form-control" name="submission_id" id="uniq_data" value="<?= $main['uniq_id_report'] ?>" autocomplete="off" readonly>
																<input type="hidden" class="form-control" name="report_number" id="uniq_data" value="<?= $main['report_no'] ?>" autocomplete="off" readonly>
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<label>Revision No :</label>
																<input class="form-control" type="number" name="revision">
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<label>Select File to upload :</label>
																<input type="file" class="form-control" name="file_attachment" id="file_attachment" required="">
															</div>
														</div>
													</div>
													<button type="submit" class="btn btn-secondary"> Upload</button>
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
																<td><button class="btn btn-danger" type="button" onclick="delete_attachment_on_update('<?= $value["id"]; ?>','<?= $value["uniq_data"]; ?>')"><i class="fa fa-trash"></i></button></td>
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
</script>

<script>
	function void_row_db(btn) {
		var uniq_id_report = $(btn).data("uniq_id_report");
		console.log("uniq_id_report:", uniq_id_report);

		$.ajax({
			url: "<?php echo base_url() ?>ndt_live/delete_void_rt",
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