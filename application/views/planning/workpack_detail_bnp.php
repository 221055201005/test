<?php
// test_var($workpack_detail); 
$workpack = $workpack_detail[0];
?>
<div id="content" class="container-fluid">

	<div class="row">
		<div class="col">
			<div class="card shadow my-3 rounded-0">
				<div class="card-body bg-white px-4 pt-4 pb-0">
					<h1 class="font-weight-bold text-center"><?php echo ($workpack['workpack_no'] == "" ? "----" : $workpack['workpack_no']) ?></h1>
					<br>
					<div class="row" style="margin-left: -25px; margin-right: -25px;">
						<div class="col-md-12 p-0">
							<ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
								<li class="nav-item" role="presentation">
									<a class="rounded-0 nav-link active" id="pills-detail-tab" data-toggle="pill" href="#pills-detail" role="tab" aria-controls="pills-detail" aria-selected="true" title="Umum">Detail Information</a>
								</li>
								<?php if ($workpack['type'] == 1) : ?>
									<li class="nav-item" role="presentation">
										<a class="rounded-0 nav-link" id="pills-subactivity-tab" data-toggle="pill" href="#pills-subactivity" role="tab" aria-controls="pills-subactivity" aria-selected="false">Sub Activity</a>
									</li>
								<?php endif; ?>
								<?php if ($workpack['type'] == 3) : ?>
									<li class="nav-item" role="presentation">
										<a class="rounded-0 nav-link" id="pills-attachment-tab" data-toggle="pill" href="#pills-attachment" role="tab" aria-controls="pills-attachment" aria-selected="false">Attachment</a>
									</li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-detail" role="tabpanel" aria-labelledby="pills-detail-tab">
			<form id="form_create_workpack" method="POST" action="<?php echo base_url() ?>planning/update_process_workpack_bnp">

				<div class="row">
					<div class="col-md-12">
						<div id="con_work_date" class="card shadow my-3 rounded-0">
							<div class="card-header">
								<h6 class="m-0">Workpack Blasting & Painting</h6>
							</div>
							<div class="card-body bg-white overflow-auto">

								<div class="row">
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Workpack No.</label>
											<div class="col-md">
												<input type="hidden" class="form-control" name="id_workpack" value="<?php echo @$id_workpack ?>" readonly>
												<input type="hidden" class="form-control" name="id" value="<?php echo @$id_workpack ?>" readonly>
												<input type="text" class="form-control" name="workpack_no" value="<?php echo @$workpack_detail[0]['workpack_no'] ?>" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
											<div class="col-md">
												<select class="form-control" name="project" required>
													<option value="">---</option>
													<?php foreach ($project_list as $key => $value) : ?>
														<?php if (in_array($value['id'], $this->user_cookie[13])) : ?>
															<option value="<?php echo $value['id'] ?>" <?php echo (@$this->user_cookie[10] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
														<?php endif; ?>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Module</label>
											<div class="col-md">
												<select class="form-control" name="module" required>
													<option value="">---</option>
													<?php foreach ($module_list as $key => $value) : ?>
														<option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$workpack_detail[0]['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type Of Module</label>
											<div class="col-md">
												<select class="form-control" name="type_of_module" required>
													<option value="">---</option>
													<?php foreach ($type_of_module_list as $key => $value) : ?>
														<option value="<?php echo $value['id'] ?>" <?php echo (@$workpack_detail[0]['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code'] . " - " . $value['name'] ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Deck Elevation / Service Line</label>
											<div class="col-md">
												<select class="form-control" name="deck_elevation" required>
													<option value="">---</option>
													<?php foreach ($deck_elevation_list as $key => $value) : ?>
														<option value="<?php echo $value['id'] ?>" <?php echo (@$workpack_detail[0]['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code'] . " - " . $value['name'] ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
											<div class="col-md">
												<select class="form-control" name="discipline" required>
													<option value="">---</option>
													<?php foreach ($discipline_list as $key => $value) : ?>
														<option value="<?php echo $value['id'] ?>" <?php echo (@$workpack_detail[0]['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Phase</label>
											<div class="col-md">
												<select class="form-control" name="phase" required>
													<option value="B&P" <?php echo (@$workpack_detail[0]['phase'] == "B&P" ? 'selected' : '') ?>>B&P</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Description Assy Code</label>
											<div class="col-md-8 col-lg-9">
												<select class="form-control select2" name="desc_assy" required>
													<option value="">---</option>
													<?php foreach ($desc_assy_list as $key => $value) : ?>
														<option value="<?php echo $value['id'] ?>" <?php echo (@$workpack_detail[0]['desc_assy'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code'] . " - " . $value['name'] ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Assigned Company</label>
											<div class="col-md">
												<select class="form-control select2" name="company_id" required>
													<option value="">---</option>
													<?php foreach ($company_list as $key => $value) : ?>
														<?php if ($this->user_cookie[11] == 1 || $value['id_company'] == $this->user_cookie[11]) : ?>
															<option value="<?php echo $value['id_company'] ?>" <?php echo (@$workpack_detail[0]['company_id'] == $value['id_company'] ? 'selected' : '') ?>><?php echo $value['company_name'] ?></option>
														<?php endif; ?>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Yard Company</label>
											<div class="col-md">
												<select class="form-control select2" name="company_yard" required>
													<option value="">---</option>
													<?php foreach ($company_list as $key => $value) : ?>
														<?php if (in_array($value['id_company'], $this->user_cookie[14])) : ?>
															<option value="<?php echo $value['id_company'] ?>" <?php echo (@$workpack_detail[0]['company_yard'] == $value['id_company'] ? 'selected' : '') ?>><?php echo $value['company_name'] ?></option>
														<?php endif; ?>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Description</label>
											<div class="col-md">
												<input type="text" class="form-control" name="description" value="<?php echo @$workpack_detail[0]['description'] ?>" required>
											</div>
										</div>
									</div>
								</div>
								<div class="row">

									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Job No.</label>
											<div class="col-md">
												<select class="form-control select2-multiple" name="job_no[]" multiple required>
													<?php foreach ($job_register_list as $value) : ?>
														<option value='<?php echo $value['job_no'] ?>' <?php echo (strpos(" " . @$workpack_detail[0]['job_no'] . " ", $value['job_no']) !== false ? 'selected' : '') ?>><?php echo $value['job_no'] ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Remarks</label>
											<div class="col-md">
												<textarea class="form-control" name="remarks"><?php echo @$workpack_detail[0]['remarks'] ?></textarea>
											</div>
										</div>
									</div>
								</div>
								<?php
								$job_description = explode(";", @$workpack_detail[0]['job_description']);
								?>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Job Description</label>
										</div>
									</div>
									<?php foreach ($job_description_list as $key => $value) : ?>
										<div class="col-md-3">
											<label>
												<input type="checkbox" class="checkbox-big" name="job_description[]" value="<?php echo $value['description'] ?>" <?php echo (in_array($value['description'], $job_description) ? "checked" : "") ?> onchange="change_jobdesc(this)">
												<span class="ml-2 font-weight-bold text-dark"> <?php echo $value['description'] ?></span>
											</label>
										</div>
									<?php endforeach; ?>
								</div>
							</div>




						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div id="con_work_date" class="card shadow my-3 rounded-0">
							<div class="card-header">
								<h6 class="m-0">Work Date</h6>
							</div>
							<div class="card-body bg-white overflow-auto">
								<div class="form-group row">
									<label class="col-md-4 col-xl-4 col-form-label font-weight-bold text-nowrap">Plan Start Date</label>
									<div class="col-md">
										<input type="date" class="form-control" max="9999-12-31" name="plan_start_date" value="<?= $workpack_detail[0]["plan_start_date"] ?>" required>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-xl-4 col-form-label font-weight-bold text-nowrap">Plan Finish Date</label>
									<div class="col-md">
										<input type="date" class="form-control" max="9999-12-31" name="plan_finish_date" value="<?= $workpack_detail[0]["plan_finish_date"] ?>" required>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div id="con_manhours_budget" class="card shadow my-3 rounded-0">
							<div class="card-header">
								<h6 class="m-0">Manhours Budget</h6>
							</div>
							<div class="card-body bg-white overflow-auto">
								<table id="tbl_manhours" class="table table-bordered text-center">
									<thead class="bg-green-smoe text-white">
										<tr>
											<th style="min-width: 150px;">Trade</th>
											<th>Total Manpower</th>
											<th>Days</th>
											<th>Man Hours</th>
											<th>Total Manhours</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($budget_manhours_list as $key => $value) : ?>
											<tr>
												<td>
													<select class='form-control' name='manhours_name[]' required>
														<option value=''>---</option>
														<?php foreach ($workpack_section as $section) : ?>
															<option value='<?php echo $section['id'] ?>' <?php echo ($section['id'] == $value['name'] ? "selected" : "") ?>><?php echo $section['name'] ?></option>
														<?php endforeach; ?>
													</select>
													<input type='hidden' value="<?php echo $value['id'] ?>" name='manhours_id[]' required>
												</td>
												<td><input type='number' class='form-control text-center' value="<?php echo $value['manpower'] ?>" name='manhours_manpower[]' oninput='calc_manhours(this)' required></td>
												<td><input type='number' class='form-control text-center' value="<?php echo $value['day'] ?>" name='manhours_day[]' oninput='calc_manhours(this)' required></td>
												<td><input type='number' class='form-control text-center' value="<?php echo $value['manhours'] ?>" name='manhours_manhours[]' oninput='calc_manhours(this)' required></td>
												<td><span name='total'><?php echo ($value['manpower'] * $value['day'] * $value['manhours']) ?></span></td>
												<td>
													<button class='btn btn-sm btn-flat btn-danger' type='button' onclick='delete_manhours_db(this, <?php echo $value["id"] ?>)'><i class='fas fa-times'></i></button>
												</td>

											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
								<div class="text-right">
									<button type="button" class="btn btn-sm btn-flat btn-success" onclick="add_manhours();"><i class="fas fa-plus"></i> Add</button>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="card shadow my-3 rounded-0">
							<div class="card-header">
								<h6 class="m-0">Work Capacity</h6>
							</div>
							<div class="card-body bg-white overflow-auto">
								<div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Area</label>
									<div class="col-md">
										<select class="form-control select2" name="area_v2" required>
											<option value="">---</option>
											<?php foreach ($area_v2_list as $key => $value) : ?>
												<option value="<?php echo $value['id'] ?>" <?php echo (@$workpack_detail[0]['area_v2'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Location</label>
									<div class="col-md">
										<select class="form-control select2" name="location_v2" <?= ($workpack_detail[0]['type'] != '3' ? 'required' : '') ?>>
											<option value="">---</option>
											<?php foreach ($location_v2_list as $key => $value) : ?>
												<option value="<?php echo $value['id'] ?>" <?php echo (@$workpack_detail[0]['location_v2'] == $value['id'] ? 'selected' : '') ?> data-chained="<?php echo $value['id_area'] ?>"><?php echo $value['name'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Total Area</label>
									<div class="col-md">
										<input type="number" class="form-control" value="<?php echo $total_area ?>" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Total <?php echo ($workpack_detail[0]['phase'] == "PF" ? "Piecemark" : "Joint") ?></label>
									<div class="col-md">
										<input type="number" class="form-control" value="<?php echo count($show_data_irn_list) ?>" readonly>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Budget manhours</label>
									<div class="col-md">
										<input type="number" class="form-control" name="budget_manhours" value="<?php echo $workpack_detail[0]['budget_manhours'] + 0 ?>" readonly>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="card shadow my-3 rounded-0">
							<div class="card-header">
								<h6 class="m-0">Additional Information</h6>
							</div>
							<div class="card-body bg-white overflow-auto">
								<div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">IRN No.</label>
									<div class="col-md">
										
										<input type="text" class="form-control" name="drawing_no" value="<?php echo $report_no_irn[$workpack['project']][$workpack['discipline']][$workpack['type_of_module']]["irn_report"] . $workpack_detail[0]['irn_report_no'] ?>" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project Engineering / Construction Engineering</label>
									<div class="col-md">
										<select name="approval_assigned" class="select2 form-control" required>
											<option value="">---</option>
											<?php foreach ($list_of_user as $key => $value) : ?>
												<option value="<?= $value['id_user'] ?>" <?= $value['id_user'] == $workpack_detail[0]['approval_assigned'] ? 'selected' : '' ?>><?= $value['full_name'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold"> Construction Superintendent</label>
									<div class="col-md">
										<select name="superintendent_assigned" class="select2 form-control" <?= $workpack_detail[0]['type'] == 1 ? 'required' : '' ?>>
											<option value="">---</option>
											<?php foreach ($list_of_user as $key => $value) : ?>
												<option value="<?= $value['id_user'] ?>" <?= $value['id_user'] == $workpack_detail[0]['superintendent_assigned'] ? 'selected' : '' ?>><?= $value['full_name'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<div class="card shadow my-3 rounded-0">
							<div class="card-header">
								<h6 class="m-0">Company Assign - Paint System Activity</h6>
							</div>
							<div class="card-body bg-white">

								<div class="overflow-auto">

									<table class="table table-hover text-center dataTableActivity">
										<thead>
											<tr>
												<th>No</th>
												<th>Paint System</th>
												<th>Activity Description</th>
												<th>Company Assigned</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1;
											foreach ($list_of_activity as $key => $value) { ?>
												<tr>
													<td><?= $no ?></td>
													<td><?= $paint_system_data_list[$value["id_paint_system"]][$value["id_activity"]]["code"] ?></td>
													<td><?= $paint_system_data_list[$value["id_paint_system"]][$value["id_activity"]]["description_of_activity"] ?></td>
													<td>
														<select class="form-control select2" name="xxxxx[<?= $key ?>]" onchange="update_company_peractivity('<?= $value['id_workpack'] ?>','<?= $value['id_paint_system'] ?>','<?= $value['id_activity'] ?>',this)">
															<option value="">---</option>
															<?php foreach ($company_list as $keyx => $valx) : ?>
																<option value="<?php echo $valx['id_company'] ?>" <?php echo ($valx['id_company'] == $value['id_company'] ? 'selected' : (@$workpack_detail[0]['company_id'] == $valx['id_company'] ? 'selected' : '')) ?>><?php echo $valx['company_name'] ?></option>
															<?php endforeach; ?>
														</select>
													</td>
												</tr>
											<?php $no++;
											} ?>
										</tbody>
									</table>
								</div>

							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<div class="card shadow my-3 rounded-0">
							<div class="card-header">
								<h6 class="m-0"><?php echo $meta_title ?></h6>
							</div>
							<div class="card-body bg-white">

								<input type="hidden" name="irn_report_no" value="<?php echo @$workpack_detail[0]["irn_report_no"] ?>">

								<input type="hidden" name="template_id">

								<div class="overflow-auto">

									<table class="table table-hover text-center dataTable">
										<thead>
											<tr>
												<th rowspan='2'>Drawing<br />Number</th>
												<th rowspan='2'>Tag<br />Number</th>
												<th rowspan='2'>Drawing Assembly</th>
												<th colspan='10' style='text-align:center;'>Material Traceability</th>
												<th rowspan='2' style='text-align:center;'>Remarks</th>
											</tr>
											<tr>
												<th>Piecemark<br />No.</th>
												<th>Paint System</th>
												<th>Unique<br />No.</th>
												<th>Profile</th>
												<th>Grade</th>
												<th>Size / Dia</th>
												<th>Length</th>
												<th>Area<br />m2</th>
												<th>THK</th>
												<th>Material<br />Status</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 0;
											$no_of_validation = 0;
											foreach ($show_data_irn_list as $key => $value) { ?>

												<?php

												if (isset($value['drawing_as']) && !empty($value['drawing_as'])) {
													$weldmap_material = substr($value['drawing_as'], -13);
												} else {
													$weldmap_material = substr($value['drawing_ga'], -20);
												}

												if (isset($warehouse_mis_mrir[$status_piecemark[$value['part_id']]['id_mis']]['unique_ident_no'])) {
													$uniq_no_p1 = $warehouse_mis_mrir[$status_piecemark[$value['part_id']]['id_mis']]['unique_ident_no'];
												} else {
													$uniq_no_p1 = "-";
												}

												if ($uniq_no_p1 != "-") {
													if (isset($list_unique_data[$uniq_no_p1])) {
														$list_of_attachment = array();
														foreach ($list_unique_data[$uniq_no_p1] as $key => $vx) {
															$list_of_attachment[] = "<a target='_blank' href='" . $this->link_server . "/warehouse_ori/file/mrir/cm/" . $vx["document_file"] . "'  style='display: inline-block !important;'>" . $vx["document_name"] . "</a>";
														}
														$show_attachment = implode("<br/><br/>", $list_of_attachment);
													} else {
														$show_attachment = "-";
													}
												} else {
													$show_attachment = "-";
												}

												if (isset($status_piecemark[$value['part_id']]['profile'])) {
													$profile_p1 = $status_piecemark[$value['part_id']]['profile'];
												} else {
													$profile_p1 = "-";
												}

												if (isset($status_piecemark[$value['part_id']]['grade'])) {
													$grade_p1 = $status_piecemark[$value['part_id']]['grade'];
												} else {
													$grade_p1 = "-";
												}

												if (isset($status_piecemark[$value['part_id']]['diameter'])) {
													$diameter_p1 = $status_piecemark[$value['part_id']]['diameter'];
												} else {
													$diameter_p1 = "-";
												}

												if (isset($status_piecemark[$value['part_id']]['length'])) {
													$length_p1 = $status_piecemark[$value['part_id']]['length'];
												} else {
													$length_p1 = "-";
												}

												if (isset($status_piecemark[$value['part_id']]['area'])) {
													$area_p1 = $status_piecemark[$value['part_id']]['area'];
												} else {
													$area_p1 = "-";
												}

												if (isset($status_piecemark[$value['part_id']]['can_number'])) {
													$can_number = $status_piecemark[$value['part_id']]['can_number'];
												} else {
													$can_number = "-";
												}

												if (isset($status_piecemark[$value['part_id']]['thickness'])) {
													$thickness_p1 = $status_piecemark[$value['part_id']]['thickness'];
												} else {
													$thickness_p1 = "-";
												}

												$project_id               = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['project_code']), '+=/', '.-~');
												$discipline               = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['discipline']), '+=/', '.-~');
												$type_of_module           = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['type_of_module']), '+=/', '.-~');
												$module                   = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['module']), '+=/', '.-~');
												$report_no                = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['report_number']), '+=/', '.-~');
												$report_no_rev            = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['report_no_rev']), '+=/', '.-~');
												$submission_id            = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['submission_id']), '+=/', '.-~');

												if (isset($status_piecemark[$value['part_id']]['status_inspection'])) {
													if ($status_piecemark[$value['part_id']]['status_inspection'] >= 3) {
														if (isset($status_piecemark[$value['part_id']]['report_number'])) {
															$status_inspection_p1 = '<a target="_blank" href="' . base_url() . 'material_verification/material_verification_pdf_client/' . $project_id . '/' . $discipline . '/' . $type_of_module . '/' . $module . '/' . $report_no . '/' . $report_no_rev . '">COMPLETED</a>';
														} else {
															$status_inspection_p1 = '<a target="_blank" href="' . base_url() . 'material_verification/material_verification_pdf/' . $submission_id . '">COMPLETED</a>';
														}
													} else {
														$status_inspection_p1 = 'OS';
													}
												} else {
													$status_inspection_p1 = "-";
												}

												$status_fitup = "-";
												$status_visual = "-";
												$status_MT_show = "-";
												$status_PT_show = "-";
												$status_UT_show = "-";
												$status_RT_show = "-";
												?>
												<tr>
													<td><?= $value['drawing_ga'] ?></td>
													<td><?= $can_number ?></td>
													<td><?= $value['drawing_as'] ?></td>
													<td><?= $value['part_id'] ?></td>
													<td>



														<input type='hidden' name='id_template[<?= $no ?>]' value='<?= $value["id_template"] ?>'>
														<input type='hidden' name='categories_wp[<?= $no ?>]' value='1'>
														<input type='hidden' name='wp_id[<?= $no ?>]' value='<?= $value["id_workpack"] ?>'>
														<input type='hidden' name='wp_detail_id[<?= $no ?>]' value='<?= $value["wp_detail_id"] ?>'>
														<?php $array_paint_system[$no] = explode(";", $value["paint_system"]); ?>

														<select name='paint_system[<?= $value["wp_detail_id"] ?>][]' class='form-control select2_multiple_paint_system' multiple>
															<?php $nox_data = 0;
															foreach ($get_paint_system as $keyx => $valx) { ?>
																<?php
																if (isset($paint_system_capture[$value["wp_detail_id"]][$valx['id']]["id_workpack"])) {
																	$nox_data++;
																}
																?>
																<option value='<?= $valx['id'] ?>' <?= (isset($paint_system_capture[$value["wp_detail_id"]][$valx['id']]["id_workpack"]) ? "selected" : null) ?>><?= $valx['code'] ?></option>
															<?php } ?>
														</select>

														<?php
														if ($nox_data == 0) {
															$no_of_validation++;
														}
														?>
													</td>
													<td><?= $uniq_no_p1 ?> </td>
													<td><?= $profile_p1 ?> </td>
													<td><?= (isset($material_grade_list[$grade_p1]) ? $material_grade_list[$grade_p1]["material_grade"] : "-") ?> </td>
													<td><?= $diameter_p1 ?> </td>
													<td><?= $length_p1 ?> </td>
													<td><?= $value['area'] ?> </td>
													<td><?= $thickness_p1 ?> </td>
													<td><?= $status_inspection_p1 ?> </td>
													<td><textarea name='remarks_pc[<?= $no ?>]' class='form-control' placeholder='Remarks'><?= (isset($paint_system_remarks_template[$value["id_workpack"]][$value['id_template']]["remarks"]) ? $paint_system_remarks_template[$value["id_workpack"]][$value['id_template']]["remarks"] : null) ?></textarea></td>
													<td>
														<?php if ($workpack['status'] == 0 && in_array($workpack['status_approval'], [0, 2, 4])) : ?>
															<button class='btn btn-sm btn-flat btn-danger' type='button' onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Delete&nbsp;</b> this?', this, event, 'delete_detail_wp_db')" data-id="<?php echo $value['wp_detail_id'] ?>"><i class='fas fa-times'></i></button>
														<?php endif; ?>
													</td>
												</tr>
											<?php $no++;
											} ?>
										</tbody>
									</table>
								</div>

							</div>
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-md-6">
						<div class="card shadow my-3 rounded-0">
							<div class="card-header">
								<h6 class="m-0">Production Engineer Assign - Paint System</h6>
							</div>
							<div class="card-body bg-white">
								<div class="overflow-auto">
									<select name='assigned_to' class='form-control select2'>
										<option value=''>---</option>
										<?php foreach ($user_data as $key => $val_user) { ?>
											<option value='<?php echo $val_user['id_user'] ?>' <?php if ($workpack_detail[0]['assigned_to'] == $val_user['id_user']) {
																																						echo "selected";
																																					} ?>><?php echo $val_user['full_name'] ?> <?php if (isset($workpack_detail[0]['assigned_to'])) {
																																																											echo "( " . $workpack_detail[0]['assigned_date'] . " )";
																																																										} ?></option>
										<?php } ?>
									</select>


								</div>
							</div>
						</div>
					</div>
				</div>



				<?php $no_validate = 0;
				if (sizeof($budget_manhours_list) <= 0 or !isset($workpack_detail[0]["plan_start_date"]) or !isset($workpack_detail[0]["plan_finish_date"])) {
					$no_validate = 1;
				} ?>

				<?php
				$show_button = 0;
				if ($no_of_validation <= 0) {
					$show_button = 1;
				}
				?>



				<div class="row">
					<div class="col">
						<div class="card shadow my-3 rounded-0">
							<div class="card-header">
								<h6 class="m-0"><?php echo $meta_title ?></h6>
							</div>
							<div class="card-body bg-white">
								<?php //test_var($user_list, 1); 
								?>

								<?php if ($workpack_detail[0]['type'] == 1) : ?>
									<table class="table table-sm table-borderless">
										<tr>
											<td width="25%"><b>Workpack Coordinator</b></td>
											<td width="25%"><b>Project Engineering / Construction Engineering</b></td>
											<td width="25%"><b>Construction Superintendent</b></td>
											<td width="25%"><b>Receiver / PIC</b></td>
										</tr>
										<tr>
											<td>
												<?php if ($workpack_detail[0]['submitted_date']) : ?>
													<img src="data:image/png;base64,<?= $user_list[$workpack_detail[0]['submitted_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
												<?php endif; ?>
											</td>
											<td>
												<?php if ($workpack_detail[0]['status_approval'] == 1 && $workpack_detail[0]['approval_assigned'] == $this->user_cookie[0]) : ?>
													<button type="button" class="btn btn-sm btn-flat btn-danger" onclick="sweetalert('confirm_remarks', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Reject&nbsp;</b> this?', this, event, 'reject_workpack')"><i class="fas fa-times"></i> Reject</button>
													<a href="<?php echo base_url() ?>planning/workpack_approval_process/<?php echo strtr($this->encryption->encrypt($workpack_detail[0]['id'] . ";3"), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-success" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Approve&nbsp;</b> this?', this, event)"><i class="fas fa-check"></i> Approve</a>
												<?php elseif ($workpack_detail[0]['approval_date']) : ?>
													<img src="data:image/png;base64,<?= $user_list[$workpack_detail[0]['approval_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
												<?php endif; ?>
											</td>
											<td>
												<?php if ($workpack_detail[0]['status_approval'] == 3 && $workpack_detail[0]['superintendent_assigned'] == $this->user_cookie[0]) : ?>
													<button type="button" class="btn btn-sm btn-flat btn-danger" onclick="sweetalert('confirm_remarks', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Reject&nbsp;</b> this?', this, event, 'reject_workpack_superintendent')"><i class="fas fa-times"></i> Reject</button>
													<a href="<?php echo base_url() ?>planning/workpack_approval_process_bnp/<?php echo strtr($this->encryption->encrypt($id_workpack), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-success" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Approve&nbsp;</b> this?', this, event)"><i class="fas fa-check"></i> Approve</a>
													<!-- <a href="<?php echo base_url() ?>planning/workpack_approval_process/<?php echo strtr($this->encryption->encrypt($workpack_detail[0]['id'] . ";5"), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-success" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Approve&nbsp;</b> this?', this, event)"><i class="fas fa-check"></i> Approve</a> -->
												<?php elseif ($workpack_detail[0]['superintendent_date']) : ?>
													<img src="data:image/png;base64,<?= $user_list[$workpack_detail[0]['superintendent_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
												<?php endif; ?>
											</td>
											<td>
												<?php if ($receiver_workpack['start_date']) : ?>
													<img src="data:image/png;base64,<?= $user_list[$receiver_workpack['pic']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
												<?php endif; ?>
												<?php if ($workpack_detail[0]['receiver_date']) : ?>
													<!-- <img src="data:image/png;base64,<?= $user_list[$workpack_detail[0]['receiver_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' /> -->
												<?php elseif ($workpack_detail[0]['status_approval'] == 5 && $workpack_detail[0]['pic_assigned'] == $this->user_cookie[0]) : ?>
													<!-- <a href="<?php echo base_url() ?>planning/workpack_receive_process/<?php echo encrypt($workpack_detail[0]['id']) ?>" class="btn btn-sm btn-flat btn-success" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Approve&nbsp;</b> this?', this, event)"><i class="fas fa-check"></i> Receive</a> -->
													<!-- <select class="form-control select2-receiver" name="receiver_by"></select>
														<button type="button" class="btn btn-sm btn-flat btn-success" onclick="save_receiver()"><i class="fas fa-save"></i> Receive</button> -->
												<?php endif; ?>
											</td>
										</tr>
										<tr>
											<td><b><?= @$user_list[$workpack_detail[0]['submitted_by']]['full_name'] ?></b></td>
											<td><b><?= @$user_list[$workpack_detail[0]['approval_by']]['full_name'] ?></b></td>
											<td><b><?= @$user_list[$workpack_detail[0]['superintendent_by']]['full_name'] ?></b></td>
											<td><b><?= @$user_list[$receiver_workpack['pic']]['full_name'] ?></b></td>
										</tr>
										<tr>
											<td><b>Date : </b><?= @$workpack_detail[0]['submitted_date'] ?></td>
											<td><b>Date : </b><?= @$workpack_detail[0]['approval_date'] ?></td>
											<td><b>Date : </b><?= @$workpack_detail[0]['superintendent_date'] ?></td>
											<td><b>Date : </b><?= @$receiver_workpack['start_date'] ?></td>
										</tr>
									</table>
									<hr>

									<table class="table table-sm table-borderless">
										<tr>
											<td><strong><small>Workpack Return</small></strong></td>
										</tr>
										<tr>
											<td width="25%"><b>Workpack Coordinator</b></td>
											<td width="25%"><b>Project Engineering / Construction Engineering</b></td>
											<td width="25%"><b>Construction Superintendent</b></td>
											<td width="25%"><b></b></td>
										</tr>
										<tr>
											<td>
												<?php
												$iscomplete = 1;
												if ($workpack_detail[0]['workpack_no'] == '') {
													$iscomplete = 0;
												}
												// foreach ($detail_list as $value) {
												// 	if ($value['progress_mv'] != 100) {
												// 		$iscomplete = 0;
												// 	}
												// }
												foreach ($workpack_subactivity_list as $workpack_subactivity) {
													foreach ($workpack_subactivity as $value) {
														if (!in_array($value['activity'], $this->exception_activity) && $value['progress'] != 100) {
															$iscomplete = 0;
														}
													}
												}
												?>
												<?php if ($workpack_detail[0]['status_return'] == 0 and $iscomplete == 1 && $this->permission_cookie[17] == 1) : ?>
													<button type="button" class="btn btn-sm btn-flat btn-success" onclick="approval_return_cnc(1)">
														<i class="fas fa-check"></i> Return Workpack
													</button>
													<!-- <button type="button" class="btn btn-sm btn-flat btn-danger" onclick="approval_return_cnc(0)">
															<i class="fas fa-times"></i> Reject
														</button> -->
												<?php elseif ($workpack_detail[0]['return_coor_date']) : ?>
													<img src="data:image/png;base64,<?= $user_list[$workpack_detail[0]['return_coor_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
												<?php endif; ?>
											</td>
											<td>
												<?php if ($workpack_detail[0]['status_return'] == 1 && $workpack_detail[0]['approval_assigned'] == $this->user_cookie[0]) : ?>
													<button type="button" class="btn btn-sm btn-flat btn-success" onclick="approval_return_cnc(3)">
														<i class="fas fa-check"></i> Approve
													</button>
													<button type="button" class="btn btn-sm btn-flat btn-danger" onclick="approval_return_cnc(2)">
														<i class="fas fa-times"></i> Reject
													</button>
												<?php elseif ($workpack_detail[0]['return_cons_date']) : ?>
													<img src="data:image/png;base64,<?= $user_list[$workpack_detail[0]['return_cons_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
												<?php endif; ?>
											</td>
											<td>
												<?php if ($workpack_detail[0]['status_return'] == 3 && $workpack_detail[0]['superintendent_assigned'] == $this->user_cookie[0]) : ?>
													<button type="button" class="btn btn-sm btn-flat btn-success" onclick="approval_return_cnc(5)">
														<i class="fas fa-check"></i> Approve
													</button>
													<button type="button" class="btn btn-sm btn-flat btn-danger" onclick="approval_return_cnc(4)">
														<i class="fas fa-times"></i> Reject
													</button></a>
												<?php elseif ($workpack_detail[0]['return_superin_date']) : ?>
													<img src="data:image/png;base64,<?= $user_list[$workpack_detail[0]['return_superin_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
												<?php endif; ?>
											</td>
											<td>
											</td>
										</tr>
										<tr>
											<td><b><?= @$user_list[$workpack_detail[0]['return_coor_by']]['full_name'] ?></b></td>
											<td><b><?= @$user_list[$workpack_detail[0]['return_cons_by']]['full_name'] ?></b></td>
											<td><b><?= @$user_list[$workpack_detail[0]['return_superin_by']]['full_name'] ?></b></td>
											<td></td>
										</tr>
										<tr>
											<td><b>Date : </b><?= @$workpack_detail[0]['return_coor_date'] ?></td>
											<td><b>Date : </b><?= @$workpack_detail[0]['return_cons_date'] ?></td>
											<td><b>Date : </b><?= @$workpack_detail[0]['return_superin_date'] ?></td>
											<td></td>
										</tr>
									</table>
									<hr>

									<?php if ($workpack_detail[0]['phase'] == 'PF') : ?>
										<table class="table table-sm table-borderless">
											<tr>
												<td><strong><small>Workpack Handover From CNC</small></strong></td>
											</tr>
											<tr>
												<td width="25%"><b>Sender</b></td>
												<td width="25%"><b>Receiver Part ID</b></td>
												<td width="25%"><b>Receiver Excess Material</b></td>
												<td width="25%"></td>
											</tr>
											<tr>
												<td>
													<?php if ($workpack_detail[0]['sender_cnc_by']) { ?>
														<img src="data:image/png;base64,<?= $user_list[$workpack_detail[0]['sender_cnc_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
													<?php } else { ?>
														<?php
														$receive = 0;
														// foreach ($detail_list as $value) {
														// 	if($value['progress_mv'] != 100){
														// 		$receive = 0;
														// 	}
														// }
														// foreach ($workpack_subactivity_list as $workpack_subactivity) {
														// 	foreach ($workpack_subactivity as $value) {
														// 		if($value['progress'] != 100){
														// 			$receive = 0;
														// 		}
														// 	}
														// }
														if ($receiver_workpack['start_date']) {
															$receive = 1;
														}
														if ($receive == 1) {
														?>
															<select class="form-control select2-receiver_cnc" data-placeholder="Select Receiver Part ID" name="receiver_cnc_by" style="width: 60%;">
																<option value="">---</option>
															</select>
															<select class="form-control select2-receiver_cnc" data-placeholder="Select Receiver Material Excess" name="receiver_cnc_excess_by" style="width: 60%;">
																<option value="">---</option>
															</select>
															<button type="button" class="btn btn-sm btn-flat btn-success" onclick="send_from_cnc()">
																<i class="fas fa-save"></i> Send
															</button>
														<?php } ?>
													<?php } ?>
												</td>
												<td>
													<?php if (
														$workpack_detail[0]['status_receiver_cnc'] == 1
														and ($workpack_detail[0]['receiver_cnc_by'] == $this->user_cookie[0]
															or
															$this->permission_cookie[0] == 1
														)
													) : ?>
														<button type="button" class="btn btn-sm btn-flat btn-success" onclick="approval_receive_cnc(3)">
															<i class="fas fa-check"></i> Receive
														</button>
														<!-- <button type="button" class="btn btn-sm btn-flat btn-danger" onclick="approval_receive_cnc(2)">
															<i class="fas fa-times"></i> Reject
														</button> -->
													<?php elseif ($workpack_detail[0]['receiver_cnc_date']) : ?>
														<img src="data:image/png;base64,<?= $user_list[$workpack_detail[0]['receiver_cnc_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
													<?php endif; ?>
												</td>
												<td>
													<?php if (
														$workpack_detail[0]['status_receiver_excess_cnc'] == 1
														and ($workpack_detail[0]['receiver_cnc_excess_by'] == $this->user_cookie[0]
															or
															$this->permission_cookie[0] == 1
														)
													) : ?>
														<button type="button" class="btn btn-sm btn-flat btn-success" onclick="approval_receive_cnc_excess(3)">
															<i class="fas fa-check"></i> Receive
														</button>
														<!-- <button type="button" class="btn btn-sm btn-flat btn-danger" onclick="approval_receive_cnc(2)">
															<i class="fas fa-times"></i> Reject
														</button> -->
													<?php elseif ($workpack_detail[0]['receiver_cnc_excess_date']) : ?>
														<img src="data:image/png;base64,<?= $user_list[$workpack_detail[0]['receiver_cnc_excess_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
													<?php endif; ?>
												</td>
												<td></td>
											</tr>
											<tr>
												<td><b><?= @$user_list[$workpack_detail[0]['sender_cnc_by']]['full_name'] ?></b></td>
												<td><b><?= @$user_list[$workpack_detail[0]['receiver_cnc_by']]['full_name'] ?></b></td>
												<td><b><?= @$user_list[$workpack_detail[0]['receiver_cnc_excess_by']]['full_name'] ?></b></td>
												<td></td>
											</tr>
											<tr>
												<td><b>Date : </b><?= @$workpack_detail[0]['sender_cnc_date'] ?></td>
												<td><b>Date : </b><?= @$workpack_detail[0]['receiver_cnc_date'] ?></td>
												<td><b>Date : </b><?= @$workpack_detail[0]['receiver_cnc_excess_date'] ?></td>
												<td></td>
											</tr>
										</table>
									<?php endif; ?>
									<hr>

								<?php endif; ?>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="font-weight-bold">Reject Remarks</label>
											<textarea rows="3" class="form-control" readonly><?php echo $workpack_detail[0]['reject_remarks'] ?></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md">
					<div class="text-right">

						<a target="_blank" href="<?php echo base_url() ?>planning/workpack_pdf_bnp/<?php echo strtr($this->encryption->encrypt($workpack_detail[0]['id']), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-danger"><i class="fas fa-file-pdf"></i> Workpack PDF</a>

						<button type="submit" class="btn btn-sm btn-flat btn-warning" name="status" value="0"><i class="fas fa-edit"></i> Update</button>

						<?php if (in_array($workpack_detail[0]["status_approval"], [0, 2, 4])) { ?>
							<?php if ($no_validate == 0 && $show_button == 1) { ?>
								<?php if (isset($workpack_detail[0]["assigned_to"])) { ?>

									<!-- <a href="<?php echo base_url() ?>planning/workpack_approval_process_bnp/<?php echo strtr($this->encryption->encrypt($id_workpack), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-success" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Issued&nbsp;</b> this?', this, event)"><i class="fas fa-check"></i> Issued</a> -->
									<a href="<?php echo base_url() ?>planning/workpack_approval_process/<?php echo strtr($this->encryption->encrypt($id_workpack . ";1"), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-info" onclick="sweetalert('confirm', 'Are you sure?', this, event)"><i class="fas fa-check"></i> Request for Issued</a>

								<?php } ?>
							<?php } ?>
						<?php } ?>

					</div>
				</div>

			</form>
		</div>
		<div class="tab-pane fade" id="pills-subactivity" role="tabpanel" aria-labelledby="pills-subactivity-tab">
			<div class="row">
				<div class="col-md-12">
					
					<div class="card shadow my-3 rounded-0">
						<div class="card-header">
							<h6 class="m-0">Create Sub Activity</h6>
						</div>
						<div class="card-body bg-white overflow-auto">
							<form method="POST" action="<?php echo base_url() ?>planning/workpack_subactivity_new_process" enctype="multipart/form-data">
								<input type="hidden" class="form-control" name="id_workpack" value="<?php echo $workpack['id'] ?>">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Activity</label>
											<div class="col-xl">
												<select name="activity" class="form-control" required>
													<option>---</option>
													<?php foreach ($job_description as $value): ?>
														<?php if($value != 'Marking/Cutting'): ?>
															<option value="<?= $value ?>"><?= $value ?></option>
														<?php endif; ?>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">PIC / Supervisor</label>
											<div class="col-md">
												<select name="pic" class="select2 form-control" required>
													<option value="">---</option>
													<?php foreach ($list_of_user as $key => $value) : ?>
														<option value="<?= $value['id_user'] ?>"><?= $value['full_name'] ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
								</div>
								<button type="submit" class="btn btn-sm btn-flat btn-success"><i class="fas fa-plus"> Create</i></button>
							</form>
						</div>
					</div>
					
					<?php foreach ($workpack_subactivity_list as $activity => $workpack_subactivity): ?>
					<div class="card shadow my-3 rounded-0">
						<div class="card-header">
							<h6 class="m-0"><?= $activity ?></h6>
						</div>
						<div class="card-body bg-white overflow-auto">
							<form action="<?php echo base_url() ?>planning/workpack_subactivity_update_process" method="POST">
								<input type="hidden" name="id_workpack" value="<?php echo $workpack['id'] ?>">
								<input type="hidden" name="activity" value="<?php echo $activity ?>">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">PIC / Supervisor</label>
											<div class="col-md">
												<select name="pic" class="select2 form-control" required>
													<option value="">---</option>
													<?php foreach ($list_of_user as $key => $value) : ?>
														<option value="<?= $value['id_user'] ?>" <?= $value['id_user'] == $workpack_subactivity[0]['pic'] ? 'selected' : '' ?>><?= $value['full_name'] ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Workpack No</label>
											<div class="col-md">
												<input type="text" class="form-control" value="<?= $activity == 'Marking/Cutting' ? '-' : $workpack_subactivity[0]['workpack_no'] ?>" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Start Date</label>
											<div class="col-md">
												<input type="text" class="form-control" value="<?= $workpack_subactivity[0]['start_date'] ?>" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Finish Date</label>
											<div class="col-md">
												<input type="text" class="form-control" value="<?= $workpack_subactivity[0]['finish_date'] ?>" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Remarks</label>
											<div class="col-md">
												<input type="text" class="form-control" value="<?= $workpack_subactivity[0]['remarks'] ?>" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 text-right">
										<?php if($activity != 'Marking/Cutting'): ?>
											<a href="<?= base_url() ?>planning/workpack_subactivity_delete_process/<?= encrypt($workpack['id']) ?>/<?= encrypt($activity) ?>" class="btn btn-sm btn-flat btn-danger" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Delete&nbsp;</b> this?', this, event)"><i class="fas fa-trash"></i> Delete</a>
										<?php endif; ?>
										<button class="btn btn-sm btn-flat btn-success" type="submit" name="submit_btn" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Update&nbsp;</b> this?', this, event);" value="finish"><i class="fas fa-check"></i> Update</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<?php endforeach; ?>

				</div>
			</div>
		</div>
	</div>


</div>
</div>
<script>
	$("select[name=module]").chained("select[name=project]");

	$(document).ready(function() {
		selectRefresh();
	});

	function selectRefresh() {
		$(".select2_multiple_activity").select2({
			allowClear: true,
			tokenSeparators: [', ', ' '],
		})
		$(".select2_multiple_paint_system").select2({
			allowClear: true,
			tokenSeparators: [', ', ' '],
		})
	}


	$('.dataTable').DataTable({
		lengthMenu: [
			[-1],
			["All"]
		],
		// pageLength: 10,
		order: [],
		columnDefs: [{
			"targets": 0,
			"pageLength": 10
			//"orderable": false,
		}]
	})


	$('.dataTableActivity').DataTable({
		lengthMenu: [100, 200, 500],
		pageLength: 100,
		order: [],
		columnDefs: [{
			"targets": 0,
			"orderable": false,
		}]
	})

	var data_checkbox = [];

	function save_checkbox(input) {
		console.log(data_checkbox);
		if ($(input).prop("checked") == true && $.inArray($(input).val(), data_checkbox) == -1) {
			data_checkbox.push($(input).val());
		} else if ($(input).prop("checked") == false && $.inArray($(input).val(), data_checkbox) != -1) {
			data_checkbox.splice($.inArray($(input).val(), data_checkbox), 1);
		}
		$(".num_ticker").html(data_checkbox.length)
	}

	function checkall(input) {
		$('#form_create_workpack input[type=checkbox]').each(function(i, obj) {
			if ($(input).prop("checked") == true && $(obj).prop("checked") == false) {
				$(obj).trigger("click");
				console.log("all" + $(obj).val());
			} else if ($(input).prop("checked") == false && $(obj).prop("checked") == true) {
				$(obj).trigger("click");
			}
		});
	}

	function create_workpack() {
		if (data_checkbox.length > 0) {
			sweetalert("loading", "Please wait...!");
			$("#form_create_workpack input[name=template_id]").val(data_checkbox.join(", "));
			document.getElementById("form_create_workpack").submit();
		} else {
			sweetalert("error", "No item selected!");
		}
	}

	$(".autocomplete_irn_approved").autocomplete({
		source: function(request, response) {
			var project_id = $("#project_id option:selected").val();
			var drawing_type = 3;
			$.ajax({
				url: "<?php echo base_url() ?>planning/autocomplete_irn_approved",
				dataType: "json",
				data: {
					term: request.term,
					drawing_type: drawing_type,
					project_id: project_id,
				},
				success: function(data) {
					response(data);
				}
			});
		},
		// select: function (event, ui) {
		//   var value = ui.item.value;
		//   if(value == 'No Data.'){
		//     ui.item.value = "";
		//   }
		//   else{
		//     get_data_drawing(ui.item.value);
		//   }
		// }
	});

	function add_manhours() {
		var html = "<tr>" +
			"<td>" +
			"<select class='form-control' name='manhours_name[]' required>" +
			"<option value=''>---</option>" +
			<?php foreach ($workpack_section as $key => $value) : ?> "<option value='<?php echo $value['id'] ?>'><?php echo $value['name'] ?></option>" +
			<?php endforeach; ?> "</select>" +
			"</td>" +
			"<td><input type='number' class='form-control text-center' value='0' name='manhours_manpower[]' oninput='calc_manhours(this)' required></td>" +
			"<td><input type='number' class='form-control text-center' value='0' name='manhours_day[]' oninput='calc_manhours(this)' required></td>" +
			"<td><input type='number' class='form-control text-center' value='0' name='manhours_manhours[]' oninput='calc_manhours(this)' required></td>" +
			"<td><span name='total'>0</span></td>" +
			"<td><button class='btn btn-sm btn-flat btn-danger' type='button' onclick='delete_manhours(this)'><i class='fas fa-times'></i></td>" +
			"</tr>";
		$("#tbl_manhours").append(html);
	}

	function delete_manhours_db(btn, id) {
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
					url: "<?php echo base_url() ?>planning/budget_manhours_delete_process",
					data: {
						id: id,
					},
					type: 'post',
					success: function(data) {
						sweetalert("success", "Delete Data Success!");
						$(btn).closest("tr").remove();
						calc_manhours_total();
					}
				});
			}
		})
	}

	function delete_manhours(btn) {
		$(btn).closest("tr").remove();
		calc_manhours_total();
	}

	function calc_manhours(input) {
		var manpower = $(input).closest("tr").find("input[type=number]:eq(0)").val();
		var days = $(input).closest("tr").find("input[type=number]:eq(1)").val();
		var manhours = $(input).closest("tr").find("input[type=number]:eq(2)").val();
		$(input).closest("tr").find("span[name=total]").text(manpower * days * manhours);
		calc_manhours_total();
	}

	function calc_manhours_total() {
		var total_all = 0;
		$("span[name=total]").each(function(index) {
			total_all = total_all + parseInt($(this).text());
		})
		$("input[name=budget_manhours]").val(total_all);
	}

	$("select[name=module]").chained("select[name=project]");


	function update_company_peractivity(id_workpack, id_paint_system, id_activity, input) {

		var id_company = $(input).val();

		Swal.fire({
			title: 'Are you sure to <b class="text-danger">&nbsp;Update&nbsp;</b> this?',
			text: "You won't be able to revert this!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, Update it!',

		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: "<?php echo base_url() ?>planning/save_update_company",
					data: {
						id_workpack: id_workpack,
						id_paint_system: id_paint_system,
						id_activity: id_activity,
						id_company: id_company,
					},
					type: 'post',
					beforeSend: function() {
						Swal.fire({
							title: 'Please Wait !',
							html: 'Processing Data', // add html attribute if you want or remove
							allowOutsideClick: false,
							onBeforeOpen: () => {
								Swal.showLoading()
							},
						});
					},
					success: function(data) {
						sweetalert("success", "Update Data Success!");
						location.reload();
						swal.close();
					}
				});
			}
		})

	}



	function approval_return_cnc(status_return_cnc) {
		var column = ''
		if (status_return_cnc == 1) {
			var title = 'Are you sure to Approve this Handover?'
			var column = 'return_coor'
		} else if (status_return_cnc == 0) {
			var title = 'Are you sure to Reject this Handover?'
			var column = 'return_coor'
		} else if (status_return_cnc == 3) {
			var title = 'Are you sure to Approve this Handover?'
			var column = 'return_cons'
		} else if (status_return_cnc == 2) {
			var title = 'Are you sure to Reject this Handover?'
			var column = 'return_cons'
		} else if (status_return_cnc == 5) {
			var title = 'Are you sure to Approve this Handover?'
			var column = 'return_superin'
		} else if (status_return_cnc == 4) {
			var title = 'Are you sure to Reject this Handover?'
			var column = 'return_superin'
		}
		Swal.fire({
			title: title,
			text: "This Process Can't be Returned!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, Proceed!'
		}).then((result) => {

			if (result.value) {
				$.ajax({
					url: "<?= base_url('planning/approval_return_cnc/') ?>",
					type: "post",
					data: {
						'id': "<?= $workpack['id'] ?>",
						'status_return': status_return_cnc,
						'column': column,
					},
					success: function(data) {
						Swal.fire(
							'Data Has Been Updated !',
							'',
							'success'
						).then(function() {
							location.reload();
							return false;
						});
					}
				});
			}
		})
	}

	function delete_detail_wp_db(btn) {
    $.ajax({
      url: "<?php echo base_url() ?>planning/detail_delete_process",
      data: {
        id: $(btn).data("id"),
        type: <?php echo $workpack['type'] ?>,
        phase: '<?php echo $workpack['phase'] ?>',
      },
      type: 'post',
      success: function(data) {
        if (data.includes('Error') == true) {
          sweetalert("error", data);
        } else {
          // sweetalert("success", "Delete Data Success!");
          // $(btn).closest("tr").remove();
					// location.reload();
        }
      }
    });
  }

	function reject_workpack(btn, remarks) {
		var link = '<?php echo base_url() ?>planning/workpack_approval_process/<?php echo strtr($this->encryption->encrypt($workpack['id'] . ";2"), '+=/', '.-~') ?>'
		window.location = link + '?remarks=' + remarks;
	}
	
	function reject_workpack_superintendent(btn, remarks) {
    var link = '<?php echo base_url() ?>planning/workpack_approval_process/<?php echo strtr($this->encryption->encrypt($workpack['id'] . ";4"), '+=/', '.-~') ?>'
    window.location = link + '?remarks=' + remarks;
  }
</script>