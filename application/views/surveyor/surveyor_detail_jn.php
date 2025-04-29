<?php
error_reporting(0);

$workpack = $workpack_list;
?>

<script type="text/javascript">
	var _formConfirm_submitted = false;
	var _formConfirm_submitted_vs = false;
</script>
<style>
	input.is_100 {
		display: inline-block;
	}

	input.is_not_100 {
		display: none;
	}

	span.is_100 {
		display: none;
	}

	span.is_not_100 {
		display: inline-block;
	}
</style>
<div id="content" class="container-fluid">

	<div class="row">
		<div class="col">
			<div class="card shadow my-3 rounded-0">
				<div class="card-header">
					<h6 class="m-0"><?php echo $meta_title ?></h6>
				</div>
				<div class="card-body bg-white overflow-auto">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Workpack No.</label>
								<div class="col-md">
									<input type="text" class="form-control" name="workpack_no" value="<?php echo @$workpack['workpack_no'] ?>" readonly>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Drawing No.</label>
								<div class="col-md">
									<input type="text" class="form-control" name="drawing_no" value="<?php echo @$workpack['drawing_no'] ?>" readonly>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Module</label>
								<div class="col-md">
									<select class="form-control" name="module" disabled>
										<option value="">---</option>
										<?php foreach ($module_list as $key => $value) : ?>
											<option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$workpack['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type Of Module</label>
								<div class="col-md">
									<select class="form-control" name="type_of_module" disabled>
										<option value="">---</option>
										<?php foreach ($type_of_module_list as $key => $value) : ?>
											<option value="<?php echo $value['id'] ?>" <?php echo (@$workpack['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code'] . " - " . $value['name'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Deck Elevation / Service Line</label>
								<div class="col-md">
									<select class="form-control" name="deck_elevation" disabled>
										<option value="">---</option>
										<?php foreach ($deck_elevation_list as $key => $value) : ?>
											<option value="<?php echo $value['id'] ?>" <?php echo (@$workpack['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code'] . " - " . $value['name'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
								<div class="col-md">
									<select class="form-control" name="discipline" disabled>
										<option value="">---</option>
										<?php foreach ($discipline_list as $key => $value) : ?>
											<option value="<?php echo $value['id'] ?>" <?php echo (@$workpack['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Phase</label>
								<div class="col-md">
									<select class="form-control" name="phase" disabled>
										<option value="PF" <?php echo (@$workpack['phase'] == "PF" ? 'selected' : '') ?>>Pre-Fabrication</option>
										<option value="FB" <?php echo (@$workpack['phase'] == "FB" ? 'selected' : '') ?>>Fabrication</option>
										<option value="AS" <?php echo (@$workpack['phase'] == "AS" ? 'selected' : '') ?>>Assembly</option>
										<option value="ER" <?php echo (@$workpack['phase'] == "ER" ? 'selected' : '') ?>>Erection</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Description Assy Code</label>
								<div class="col-md-8 col-lg-9">
									<select class="form-control select2" name="desc_assy" disabled>
										<option value="">---</option>
										<?php foreach ($desc_assy_list as $key => $value) : ?>
											<option value="<?php echo $value['id'] ?>" <?php echo (@$workpack['desc_assy'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code'] . " - " . $value['name'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Description</label>
								<div class="col-md">
									<input type="text" class="form-control" name="description" value="<?php echo @$workpack['description'] ?>" disabled>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Job No.</label>
								<div class="col-md">
									<input type="text" class="form-control" name="job_no" value="<?php echo @$workpack['job_no'] ?>" disabled>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Company</label>
								<div class="col-md">
									<input type="text" class="form-control" name="company_id" value="<?php echo @$company_name[$workpack['company_id']] ?>" disabled>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<div class="col-md">
								</div>
							</div>
						</div>
					</div>

					<?php
					$job_description = explode(";", $workpack['job_description']);
					?>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group row">
								<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Job Description</label>
							</div>
						</div>
						<?php foreach ($job_description_list as $key => $value) : ?>
							<div class="col-md-3">
								<label class="">
									<input type="checkbox" class="checkbox-big" name="job_description[]" value="<?php echo $value['description'] ?>" <?php echo (in_array($value['description'], $job_description) ? "checked" : "") ?> disabled>
									<span class="position-absolute ml-2 font-weight-bold text-dark"> <?php echo $value['description'] ?></span>
								</label>
							</div>
						<?php endforeach; ?>
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
				<div class="card-body bg-white overflow-auto">

					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Filter Joint Number</label>
								<div class="col-md">


									<div class="input-group">
										<select class='select2_filter_joint_number form-control' name='filter_joint_number[]' multiple required placeholder='Input Joint Number'></select>
										<br /><br />
										<button type='button' class="btn btn-info" onclick="filter_joint_redirect();">
											<i class="fa fa-search"></i> Search
										</button>
									</div>


								</div>
							</div>
						</div>

					</div>

				</div>
			</div>
		</div>
	</div>



	<?php if (sizeof($joint_list) > 0) { ?>

		<form action="<?= site_url('planning/save_update_to_fitup') ?>" method="post" id="form_submition_fu" onsubmit="if( _formConfirm_submitted == false ){ _formConfirm_submitted = true;return true }else{ alert('Please Wait, Server still busy, wait till process done, Thanks!'); return false;  }" enctype="multipart/form-data">

			<input type="hidden" name="wp_no" value="<?= $workpack['workpack_no'] ?>">
			<input type="hidden" name="wp_id" value="<?= @$joint_list[0]['workpack_id'] ?>">
			<input type="hidden" name="module_save" value="<?= $workpack['module'] ?>">
			<input type="hidden" name="project_save" value="<?= $workpack['project'] ?>">
			<input type="hidden" name="discipline_save" value="<?= $workpack['discipline'] ?>">
			<input type="hidden" name="type_of_module_save" value="<?= $workpack['type_of_module'] ?>">
			<input type="hidden" name="drawing_no_save" value="<?= $joint_list[0]['drawing_no_template'] ?>">
			<input type="hidden" name="drawing_type_save" value="<?= @$joint_list[0]['drawing_type_template'] ?>">
			<input type="hidden" class="form-control" name="id" value="<?php echo @$workpack['id'] ?>">
			<input type="hidden" name="company_id_save" value="<?= $workpack['company_id'] ?>">

			<div class="row">
				<div class="col">
					<div class="card shadow my-3 rounded-0">
						<div class="card-header">
							<h6 class="m-0"><?php echo $meta_title ?> - Fit Up</h6>
						</div>
						<div class="card-body bg-white">
							<div class="overflow-auto">

								<div class="row">
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Surveyor Name</label>
											<div class="col-md">
												<input type='text' name='full_name' class='form-control' value='<?= $this->user_cookie[1]; ?>' readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Company Assigned</label>
											<div class="col-md">
												<input type='text' name='company' class='form-control' value='<?= $company_name[$joint_list[0]['company_id']] ?>' readonly>
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Area</label>
											<div class="col-md-8 col-lg-9">
												<select class="select2" name="area" required>
													<option value="">---</option>
													<?php foreach ($area as $value_area) { ?>
														<option value="<?= $value_area['id'] ?>"><?= $value_area['name'] ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Date</label>
											<div class="col-md">
												<input type='text' name='dateview' class='form-control' value='<?= date("Y-m-d"); ?>' readonly>
											</div>
										</div>
									</div>

								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Location</label>
											<div class="col-md-8 col-lg-9">
												<select class="select2" name="location" required>
													<option value="">---</option>
													<?php foreach ($location as $value_location) { ?>
														<option value="<?= $value_location['id'] ?>" data-chained="<?php echo $value_location['id_area'] ?>"><?= $value_location['name'] ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">

										</div>
									</div>

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
							<h6 class="m-0"><?php echo $meta_title ?> - Fitup Progress</h6>
						</div>
						<div class="card-body bg-white">
							<div class="overflow-auto">
								<table class="table table-hover text-center dataTable" id='table_submission'>
									<thead class="bg-green-smoe text-white">
										<tr>
											<th style="width: 10px !important;">#</th>
											<th style="width: 260px !important;">Weld Map Drawing Number</th>
											<th style="width: 50px !important;">Joint No</th>
											<th style="width: 155px !important;">Part ID</th>
											<th style="width: 190px !important;">Unique ID Number</th>
											<th style="width: 80px !important;">Heat Number</th>
											<th style="width: 95px !important;">Material Grade</th>

											<th style="width: 95px !important;">Joint Class</th>
											<th style="width: 15px !important;">Dia/Size</th>
											<th style="width: 15px !important;">Sch</th>
											<th style="width: 15px !important;">Thk<br />(mm)</th>

											<th style="width: 15px !important;">Weld<br />Length<br />(mm)</th>
											<!-- <th style="width: 120px !important;">Fitter Code</th> -->
											<!-- <th style="width: 120px !important;">Tack Weld ID</th> -->
											<!-- <th style="width: 250px !important;">WPS</th> -->
											<th style="width: 200px !important;">Remarks</th>

											<th style="width: 200px !important;">Submission No</th>
											<th style="width: 200px !important;">Status Inspection</th>
											<th style="width: 200px !important;">Inspection By</th>
											<th style="width: 200px !important;">Inspection Date</th>
											<th style="width: 200px !important;">Client Inspection By</th>
											<th style="width: 200px !important;">Client Inspection Date</th>
											<th style="width: 200px !important;">Status Surveyor</th>
											<th style="width: 200px !important;">Evidence Of Progress</th>
											<th>Progress On (%)</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 0;
										$total_progress = 0;
										foreach ($joint_list as $key => $value) : ?>
											<?php

											if (isset($value['status_inspection'])) {

												$status_data = 2;
											} else {

												$array_no_oke = array(0, 1, 2, 4, 12);

												if (isset($status_piecemark[$value['pos_1']]['id_mis']) && isset($status_piecemark[$value['pos_2']]['id_mis'])) {

													if (@$status_piecemark[$value['pos_1']]['status_inspection'] == '0' or @$status_piecemark[$value['pos_2']]['status_inspection'] == '0') {
														$status_data = 2; //red
													} else if (@$status_piecemark[$value['pos_1']]['status_inspection'] == '1' or @$status_piecemark[$value['pos_2']]['status_inspection'] == '1') {
														$status_data = 2; //red
													} else if (@$status_piecemark[$value['pos_1']]['status_inspection'] == '2' or @$status_piecemark[$value['pos_2']]['status_inspection'] == '2') {
														$status_data = 2; //green
													} else if (@$status_piecemark[$value['pos_1']]['status_inspection'] == '3' or @$status_piecemark[$value['pos_2']]['status_inspection'] == '7') {
														$status_data = 3; //green 
													} else if (@$status_piecemark[$value['pos_1']]['status_inspection'] == '7' or @$status_piecemark[$value['pos_2']]['status_inspection'] == '3') {
														$status_data = 3; //green
													} else if (@$status_piecemark[$value['pos_1']]['status_inspection'] == '3' and @$status_piecemark[$value['pos_2']]['status_inspection'] == '3') {
														$status_data = 3; //green
													} else if (@$status_piecemark[$value['pos_1']]['status_inspection'] == '4' or @$status_piecemark[$value['pos_2']]['status_inspection'] == '4') {
														$status_data = 0; //blue
													} else if (@$status_piecemark[$value['pos_1']]['status_inspection'] == '5' or @$status_piecemark[$value['pos_2']]['status_inspection'] == '5') {
														$status_data = 3; //green
													} else if (@$status_piecemark[$value['pos_1']]['status_inspection'] == '7' or @$status_piecemark[$value['pos_2']]['status_inspection'] == '7') {
														$status_data = 3; //green 
													} else if (@$status_piecemark[$value['pos_1']]['status_inspection'] == '9' or @$status_piecemark[$value['pos_2']]['status_inspection'] == '9') {
														$status_data = 3; //green   
													} else if (@$status_piecemark[$value['pos_1']]['status_inspection'] == '10' or @$status_piecemark[$value['pos_2']]['status_inspection'] == '10') {
														$status_data = 3; //green    
													} else if (@$status_piecemark[$value['pos_1']]['status_inspection'] == '11' or @$status_piecemark[$value['pos_2']]['status_inspection'] == '11') {
														$status_data = 3; //green    
													} else if (@$status_piecemark[$value['pos_1']]['status_inspection'] == '12' or @$status_piecemark[$value['pos_2']]['status_inspection'] == '12') {
														$status_data = 2; //green      
													} else {
														$status_data = 2; //red
														//echo "8";
													}
												} else if (isset($status_piecemark_itr[$value['pos_1']]['id_mis']) || isset($status_piecemark_itr[$value['pos_2']]['id_mis'])) {

													if (
														@$status_piecemark[$value['pos_1']]['status_inspection'] >= 3 ||
														@$status_piecemark_itr[$value['pos_1']]['status_inspection'] >= 3 ||
														@$status_piecemark[$value['pos_2']]['status_inspection'] >= 3 ||
														@$status_piecemark_itr[$value['pos_2']]['status_inspection'] >= 3
													) {

														$status_data = 3; //green

													}
												} else {

													$array_status = array();
													if (isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])) {

														$data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_1']]["ref_pos_1"]);
														foreach ($data_multiple_piecemark_1 as $vaxx) {

															if (in_array($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['status_inspection'], $array_no_oke)) {
																$status_data = 2;
															} else {
																$status_data = 3;
															}

															array_push($array_status, $status_data);
														}
													} else {
														if (isset($status_piecemark[$value['pos_1']]['id_mis'])) {
															if (in_array($status_piecemark[$value['pos_1']]['status_inspection'], $array_no_oke)) {
																$status_data = 2;
															} else {
																$status_data = 3;
															}
															array_push($array_status, $status_data);
														} else {
															$status_data = 2;
															array_push($array_status, $status_data);
														}
													}

													if (isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])) {

														$data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);
														foreach ($data_multiple_piecemark_1 as $vaxx) {

															if (in_array($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['status_inspection'], $array_no_oke)) {
																$status_data = 2;
															} else {
																$status_data = 3;
															}

															array_push($array_status, $status_data);
														}
													} else {
														if (isset($status_piecemark[$value['pos_2']]['id_mis'])) {
															if (in_array($status_piecemark[$value['pos_2']]['status_inspection'], $array_no_oke)) {
																$status_data = 2;
															} else {
																$status_data = 3;
															}
															array_push($array_status, $status_data);
														} else {
															$status_data = 2;
															array_push($array_status, $status_data);
														}
													}

													if (in_array(2, $array_status)) {
														$status_data = 2;
													} else {
														$status_data = 3;
													}
												}
											}
											?>
											<tr>

												<td>
													<?php
													$not_completed = 0;
													$is_100 = 'is_not_100';
													if ($value["progress_fu"] >= 100) {
														if ($status_data == 3) {
															$not_completed = 1;
															$is_100 = 'is_100';
														}
													} else {
														$not_completed = 1;
													}
													?>

													<?php if ($not_completed == 1) : ?>
														<input type='hidden' name='id_joint[<?php echo $no; ?>]' value='<?php echo $value['id_jn_temp']; ?>'>
														<input type="hidden" name="id_wp_save[<?= $no ?>]" value="<?= $value['id_wp_main'] ?>">
														<input type='checkbox' class="checkbox-big <?= $is_100 ?>" name='submit_id[<?php echo $no; ?>]' onclick='open_disabled_form(this,"<?php echo $no; ?>","0")'>
														<input type='hidden' name='filter_check[<?php echo $no; ?>]' value='0'>
														<span class='btn btn-danger <?= $is_100 ?>' title="Waiting actual progress 100%"><i class="fas fa-times-circle"></i></span>
													<?php elseif ($status_data == 0) : ?>
														<span style='font-weight:bold;font-size:25px;color:blue'>&#128504;</span>
													<?php elseif ($status_data == 1) : ?>
														<span style='font-weight:bold;font-size:15px;color:green'>&#128504;</span>
													<?php elseif ($status_data == 2) : ?>
														<span style='font-weight:bold;font-size:15px;color:green'>&#128504;</span>
													<?php endif; ?>
												</td>

												<td><?php echo $value['drawing_wm'] ?> Rev.<?php echo $value['rev_wm'] ?></td>

												<td>
													<?php if (strlen($value['evidence_fu']) > 1) { ?>
														<!-- <a href="<?= $this->link_server  ?>/pcms_v2_photo/<?= $value['evidence_fu'] ?>"><?= $value['joint_no'] ?></a> -->
														<?php
														$enc_redline = strtr($this->encryption->encrypt($value['evidence_fu']), '+=/', '.-~');
														$enc_path   = strtr($this->encryption->encrypt('/PCMS/mobile/pcms_v2_mobile/pcms_v2_photo/'), '+=/', '.-~');
														?>
														<a target='_blank' href='<?= site_url('irn/open_file/' . $enc_redline . '/' . $enc_path) ?>'><?= $value['joint_no'] ?></a>
													<?php } else { ?>
														<?php echo $value['joint_no'] ?>
													<?php } ?>
												</td>

												<td>
													<span class='badge'><?php echo $value['pos_1'] ?></span>
													<br />
													<?php if (isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])) { ?>
														<?php
														$data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_1']]["ref_pos_1"]);
														foreach ($data_multiple_piecemark_1 as $vaxx) {
															if (isset($status_piecemark_ref_1[$vaxx]["part_id"])) {
																echo  "<span class='badge'>" . $status_piecemark_ref_1[$vaxx]["part_id"] . "</span> <br/>";
															} else {
																echo  "<span class='badge'>" . $status_piecemark_ref_1_itr[$vaxx]["part_id"] . "</span> <br/>";
															}
														}
														?>
													<?php } ?>
													<hr />
													<span class='badge'><?php echo $value['pos_2'] ?></span>
													<br />
													<?php if (isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])) { ?>
														<?php
														$data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);
														foreach ($data_multiple_piecemark_1 as $vaxx) {
															if (isset($status_piecemark_ref_1[$vaxx]["part_id"])) {
																echo  "<span class='badge'>" . $status_piecemark_ref_1[$vaxx]["part_id"] . "</span> <br/>";
															} else {
																echo  "<span class='badge'>" . $status_piecemark_ref_1_itr[$vaxx]["part_id"] . "</span> <br/>";
															}
														}
														?>
													<?php } ?>
												</td>

												<td>
													<?php if (isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])) { ?>
														<?php
														$data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_1']]["ref_pos_1"]);
														foreach ($data_multiple_piecemark_1 as $vaxx) {
															if (isset($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['status_inspection'])) {
																if (in_array($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['status_inspection'], $array_no_oke)) {
																	echo "<span class='badge badge-warning'>Not Ready in MTR Verification</span>";
																} else {
																	echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['unique_ident_no'] . "</span><br/>";
																}
															} else if (isset($status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['status_inspection'])) {
																if (in_array($status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['status_inspection'], $array_no_oke)) {
																	echo "<span class='badge badge-warning'>Not Ready in ITR Verification</span>";
																} else {
																	echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['id_mis']]['unique_ident_no'] . "</span><br/>";
																}
															}
														}
														?>
													<?php } else { ?>
														<?php
														if (isset($status_piecemark[$value['pos_1']]['id_mis'])) {

															if ($status_piecemark[$value['pos_1']]['status_inspection'] == '0') {
																echo "<span class='badge badge-warning'>Not Ready in MTR Verification</span>";
															} else if ($status_piecemark[$value['pos_1']]['status_inspection'] == '1') {
																echo "<span class='badge badge-warning'>MTR Verification - Pending Approval</span>";
															} else if ($status_piecemark[$value['pos_1']]['status_inspection'] == '2') {
																echo "<span class='badge badge-warning'>MTR Verification - Rejected</span>";
															} else if ($status_piecemark[$value['pos_1']]['status_inspection'] == '3') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark[$value['pos_1']]['status_inspection'] == '4') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark[$value['pos_1']]['status_inspection'] == '5') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark[$value['pos_1']]['status_inspection'] == '7') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark[$value['pos_1']]['status_inspection'] == '9') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark[$value['pos_1']]['status_inspection'] == '10') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark[$value['pos_1']]['status_inspection'] == '11') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark[$value['pos_1']]['status_inspection'] == '12') {
																echo "<span class='badge badge-secondary'>MTR Verification - Void</span>";
															}
														} else if (isset($status_piecemark_itr[$value['pos_1']]['id_mis'])) {

															if ($status_piecemark_itr[$value['pos_1']]['status_inspection'] == '0') {
																echo "<span class='badge badge-warning'>Not Ready in ITR Verification</span>";
															} else if ($status_piecemark_itr[$value['pos_1']]['status_inspection'] == '1') {
																echo "<span class='badge badge-warning'>ITR Verification - Pending Approval</span>";
															} else if ($status_piecemark_itr[$value['pos_1']]['status_inspection'] == '2') {
																echo "<span class='badge badge-warning'>ITR Verification - Rejected</span>";
															} else if ($status_piecemark_itr[$value['pos_1']]['status_inspection'] == '3') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark_itr[$value['pos_1']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark_itr[$value['pos_1']]['status_inspection'] == '4') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark_itr[$value['pos_1']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark_itr[$value['pos_1']]['status_inspection'] == '5') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark_itr[$value['pos_1']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark_itr[$value['pos_1']]['status_inspection'] == '7') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark_itr[$value['pos_1']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark_itr[$value['pos_1']]['status_inspection'] == '9') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark_itr[$value['pos_1']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark_itr[$value['pos_1']]['status_inspection'] == '10') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark_itr[$value['pos_1']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark_itr[$value['pos_1']]['status_inspection'] == '11') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark_itr[$value['pos_1']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark_itr[$value['pos_1']]['status_inspection'] == '12') {
																echo "<span class='badge badge-secondary'>ITR Verification - Void</span>";
															}
														} else {
															echo "<span class='badge badge-warning'>Material Not Ready</span>";
														}
														?>
													<?php } ?>
													<hr />
													<?php if (isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])) { ?>
														<?php
														$data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);
														foreach ($data_multiple_piecemark_1 as $vaxx) {
															if (isset($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['status_inspection'])) {
																if (in_array($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['status_inspection'], $array_no_oke)) {
																	echo "<span class='badge badge-warning'>Not Ready in MTR Verification</span>";
																} else {
																	echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['unique_ident_no'] . "</span><br/>";
																}
															} else if (isset($status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['status_inspection'])) {
																if (in_array($status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['status_inspection'], $array_no_oke)) {
																	echo "<span class='badge badge-warning'>Not Ready in ITR Verification</span>";
																} else {
																	echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['id_mis']]['unique_ident_no'] . "</span><br/>";
																}
															}
														}
														?>
													<?php } else { ?>
														<?php
														if (isset($status_piecemark[$value['pos_2']]['id_mis'])) {

															if ($status_piecemark[$value['pos_2']]['status_inspection'] == '0') {
																echo "<span class='badge badge-warning'>Not Ready in MTR Verification</span>";
															} else if ($status_piecemark[$value['pos_2']]['status_inspection'] == '1') {
																echo "<span class='badge badge-warning'>MTR Verification - Pending Approval</span>";
															} else if ($status_piecemark[$value['pos_2']]['status_inspection'] == '2') {
																echo "<span class='badge badge-warning'>MTR Verification - Rejected</span>";
															} else if ($status_piecemark[$value['pos_2']]['status_inspection'] == '3') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark[$value['pos_2']]['status_inspection'] == '4') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark[$value['pos_2']]['status_inspection'] == '5') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark[$value['pos_2']]['status_inspection'] == '7') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark[$value['pos_2']]['status_inspection'] == '9') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark[$value['pos_2']]['status_inspection'] == '10') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark[$value['pos_2']]['status_inspection'] == '11') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark[$value['pos_2']]['status_inspection'] == '12') {
																echo "<span class='badge badge-secondary'>MTR Verification - Void</span>";
															}
														} else if (isset($status_piecemark_itr[$value['pos_2']]['id_mis'])) {

															if ($status_piecemark_itr[$value['pos_2']]['status_inspection'] == '0') {
																echo "<span class='badge badge-warning'>Not Ready in ITR Verification</span>";
															} else if ($status_piecemark_itr[$value['pos_2']]['status_inspection'] == '1') {
																echo "<span class='badge badge-warning'>ITR Verification - Pending Approval</span>";
															} else if ($status_piecemark_itr[$value['pos_2']]['status_inspection'] == '2') {
																echo "<span class='badge badge-warning'>ITR Verification - Rejected</span>";
															} else if ($status_piecemark_itr[$value['pos_2']]['status_inspection'] == '3') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark_itr[$value['pos_2']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark_itr[$value['pos_2']]['status_inspection'] == '4') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark_itr[$value['pos_2']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark_itr[$value['pos_2']]['status_inspection'] == '5') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark_itr[$value['pos_2']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark_itr[$value['pos_2']]['status_inspection'] == '7') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark_itr[$value['pos_2']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark_itr[$value['pos_2']]['status_inspection'] == '9') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark_itr[$value['pos_1']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark_itr[$value['pos_2']]['status_inspection'] == '10') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark_itr[$value['pos_1']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark_itr[$value['pos_2']]['status_inspection'] == '11') {
																echo "<span class='badge badge-success'>" . $warehouse_mis_mrir[$status_piecemark_itr[$value['pos_1']]['id_mis']]['unique_ident_no'] . "</span>";
															} else if ($status_piecemark_itr[$value['pos_2']]['status_inspection'] == '12') {
																echo "<span class='badge badge-secondary'>ITR Verification - Void</span>";
															}
														} else {
															echo "<span class='badge badge-warning'>Material Not Ready</span>";
														}
														?>
													<?php } ?>
												</td>

												<td>
													<?php if (isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])) { ?>
														<?php
														$data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_1']]["ref_pos_1"]);
														foreach ($data_multiple_piecemark_1 as $vaxx) {
															if (isset($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]])) {
																echo "<span class='badge'>" . $warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['heat_or_series_no'] . "</span><br/>";
															} else  if (isset($status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]])) {
																echo "<span class='badge'>" . $warehouse_mis_mrir[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['id_mis']]['heat_or_series_no'] . "</span><br/>";
															}
														}
														?>
													<?php } else { ?>
														<?php
														if (isset($status_piecemark[$value['pos_1']]['id_mis'])) {
															echo $warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['heat_or_series_no'];
														} else  if (isset($status_piecemark_itr[$value['pos_1']]['id_mis'])) {
															echo $warehouse_mis_mrir[$status_piecemark_itr[$value['pos_1']]['id_mis']]['heat_or_series_no'];
														} else {
															echo "-";
														}
														?>
													<?php } ?>
													<hr />
													<?php if (isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])) { ?>
														<?php
														$data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);
														foreach ($data_multiple_piecemark_1 as $vaxx) {

															if (isset($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]])) {
																echo "<span class='badge'>" . $warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['heat_or_series_no'] . "</span><br/>";
															} else  if (isset($status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]])) {
																echo "<span class='badge'>" . $warehouse_mis_mrir[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['id_mis']]['heat_or_series_no'] . "</span><br/>";
															}
														}
														?>
													<?php } else { ?>
														<?php
														if (isset($status_piecemark[$value['pos_2']]['id_mis'])) {
															echo $warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['heat_or_series_no'];
														} else  if (isset($status_piecemark_itr[$value['pos_2']]['id_mis'])) {
															echo $warehouse_mis_mrir[$status_piecemark_itr[$value['pos_2']]['id_mis']]['heat_or_series_no'];
														} else {
															echo "-";
														}
														?>
													<?php } ?>
												</td>

												<td>
													<?php if (isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])) { ?>
														<?php
														$data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_1']]["ref_pos_1"]);
														foreach ($data_multiple_piecemark_1 as $vaxx) {
															if (isset($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]])) {
																echo "<span class='badge'>" . $material_grade[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['grade']]['material_grade'] . "</span><br/>";
															} else if (isset($status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]])) {
																echo "<span class='badge'>" . $material_grade[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['grade']]['material_grade'] . "</span><br/>";
															}
														}
														?>
													<?php } else { ?>
														<span class='badge'>
															<?php
															if (isset($status_piecemark[$value['pos_1']]['id_mis'])) {
																echo $material_grade[$status_piecemark[$value['pos_1']]['grade']]['material_grade'];
															} else if (isset($status_piecemark_itr[$value['pos_1']]['id_mis'])) {
																echo $material_grade[$status_piecemark_itr[$value['pos_1']]['grade']]['material_grade'];
															} else {
																echo "-";
															}
															?>
														</span>
													<?php } ?>
													<hr />
													<?php if (isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])) { ?>
														<?php
														$data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);
														foreach ($data_multiple_piecemark_1 as $vaxx) {
															if (isset($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]])) {
																echo "<span class='badge'>" . $material_grade[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['grade']]['material_grade'] . "</span><br/>";
															} else if (isset($status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]])) {
																echo "<span class='badge'>" . $material_grade[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['grade']]['material_grade'] . "</span><br/>";
															}
														}
														?>
													<?php } else { ?>
														<span class='badge'>
															<?php
															if (isset($status_piecemark[$value['pos_2']]['id_mis'])) {
																echo $material_grade[$status_piecemark[$value['pos_2']]['grade']]['material_grade'];
															} else if (isset($status_piecemark_itr[$value['pos_2']]['id_mis'])) {
																echo $material_grade[$status_piecemark_itr[$value['pos_2']]['grade']]['material_grade'];
															} else {
																echo "-";
															}
															?>
														</span>
													<?php } ?>
												</td>

												<td class="ball" style="vertical-align: middle;text-align: center;">
													<?php echo @$class_list[$value["class"]] ?>
												</td>

												<td>
													<?php if (isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])) { ?>
														<?php
														$data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_1']]["ref_pos_1"]);
														foreach ($data_multiple_piecemark_1 as $vaxx2) {
															if ($status_piecemark_ref_1[$vaxx2]) {
																echo "<span class='badge'>" . $status_piecemark_ref_1[$vaxx2]["diameter"] . "</span><br/>";
															} else  if ($status_piecemark_ref_1_itr[$vaxx2]) {
																echo "<span class='badge'>" . $status_piecemark_ref_1_itr[$vaxx2]["diameter"] . "</span><br/>";
															} else {
																echo "-";
															}
														}
														?>
													<?php } else { ?>
														<?php
														if (isset($status_piecemark[$value['pos_1']]['diameter'])) {
															echo @$status_piecemark[$value['pos_1']]['diameter'];
														} else if ($status_piecemark_itr[$value['pos_1']]['diameter']) {
															echo @$status_piecemark_itr[$value['pos_1']]['diameter'];
														} else {
															echo "-";
														}
														?>
													<?php } ?>
													<hr />
													<?php if (isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])) { ?>
														<?php
														$data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);
														foreach ($data_multiple_piecemark_1 as $vaxx2) {
															if ($status_piecemark_ref_1[$vaxx2]) {
																echo "<span class='badge'>" . $status_piecemark_ref_1[$vaxx2]["diameter"] . "</span><br/>";
															} else  if ($status_piecemark_ref_1_itr[$vaxx2]) {
																echo "<span class='badge'>" . $status_piecemark_ref_1_itr[$vaxx2]["diameter"] . "</span><br/>";
															} else {
																echo "-";
															}
														}
														?>
													<?php } else { ?>
														<?php
														if (isset($status_piecemark[$value['pos_2']]['diameter'])) {
															echo @$status_piecemark[$value['pos_2']]['diameter'];
														} else if ($status_piecemark_itr[$value['pos_2']]['diameter']) {
															echo @$status_piecemark_itr[$value['pos_2']]['diameter'];
														} else {
															echo "-";
														}
														?>
													<?php } ?>
												</td>

												<td>
													<?php if (isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])) { ?>
														<?php
														$data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_1']]["ref_pos_1"]);
														foreach ($data_multiple_piecemark_1 as $vaxx2) {
															if ($status_piecemark_ref_1[$vaxx2]) {
																echo "<span class='badge'>" . $status_piecemark_ref_1[$vaxx2]["sch"] . "</span><br/>";
															} else  if ($status_piecemark_ref_1_itr[$vaxx2]) {
																echo "<span class='badge'>" . $status_piecemark_ref_1_itr[$vaxx2]["sch"] . "</span><br/>";
															} else {
																echo "-";
															}
														}
														?>
													<?php } else { ?>
														<?php
														if (isset($status_piecemark[$value['pos_1']]['sch'])) {
															echo @$status_piecemark[$value['pos_1']]['sch'];
														} else if ($status_piecemark_itr[$value['pos_1']]['sch']) {
															echo @$status_piecemark_itr[$value['pos_1']]['sch'];
														} else {
															echo "-";
														}
														?>
													<?php } ?>
													<hr />
													<?php if (isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])) { ?>
														<?php
														$data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);
														foreach ($data_multiple_piecemark_1 as $vaxx2) {
															if ($status_piecemark_ref_1[$vaxx2]) {
																echo "<span class='badge'>" . $status_piecemark_ref_1[$vaxx2]["sch"] . "</span><br/>";
															} else  if ($status_piecemark_ref_1_itr[$vaxx2]) {
																echo "<span class='badge'>" . $status_piecemark_ref_1_itr[$vaxx2]["sch"] . "</span><br/>";
															} else {
																echo "-";
															}
														}
														?>
													<?php } else { ?>
														<?php
														if (isset($status_piecemark[$value['pos_2']]['sch'])) {
															echo @$status_piecemark[$value['pos_2']]['sch'];
														} else if ($status_piecemark_itr[$value['pos_2']]['sch']) {
															echo @$status_piecemark_itr[$value['pos_2']]['sch'];
														} else {
															echo "-";
														}
														?>
													<?php } ?>
												</td>

												<td>
													<?php if (isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])) { ?>
														<?php
														$data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_1']]["ref_pos_1"]);
														foreach ($data_multiple_piecemark_1 as $vaxx2) {
															if ($status_piecemark_ref_1[$vaxx2]) {
																echo "<span class='badge'>" . $status_piecemark_ref_1[$vaxx2]["thickness"] . "</span><br/>";
															} else  if ($status_piecemark_ref_1_itr[$vaxx2]) {
																echo "<span class='badge'>" . $status_piecemark_ref_1_itr[$vaxx2]["thickness"] . "</span><br/>";
															} else {
																echo "-";
															}
														}
														?>
													<?php } else { ?>
														<?php
														if (isset($status_piecemark[$value['pos_1']]['thickness'])) {
															echo @$status_piecemark[$value['pos_1']]['thickness'];
														} else if ($status_piecemark_itr[$value['pos_1']]['thickness']) {
															echo @$status_piecemark_itr[$value['pos_1']]['thickness'];
														} else {
															echo "-";
														}
														?>
													<?php } ?>
													<hr />
													<?php if (isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])) { ?>
														<?php
														$data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);
														foreach ($data_multiple_piecemark_1 as $vaxx2) {
															if ($status_piecemark_ref_1[$vaxx2]) {
																echo "<span class='badge'>" . $status_piecemark_ref_1[$vaxx2]["thickness"] . "</span><br/>";
															} else  if ($status_piecemark_ref_1_itr[$vaxx2]) {
																echo "<span class='badge'>" . $status_piecemark_ref_1_itr[$vaxx2]["thickness"] . "</span><br/>";
															} else {
																echo "-";
															}
														}
														?>
													<?php } else { ?>
														<?php
														if (isset($status_piecemark[$value['pos_2']]['thickness'])) {
															echo @$status_piecemark[$value['pos_2']]['thickness'];
														} else if ($status_piecemark_itr[$value['pos_2']]['thickness']) {
															echo @$status_piecemark_itr[$value['pos_2']]['thickness'];
														} else {
															echo "-";
														}
														?>
													<?php } ?>
												</td>

												<td><?php echo $value['weld_length'] ?></td>

												<!-- <td>
													<?php if (!isset($value['status_inspection'])) { ?>
														<select class='select2_multiple_fitter' name='fitter_id[<?php echo $no; ?>][]' multiple required disabled></select>
													<?php
													} else {
														$fitter_id_display = explode(";", $value['fitter_id']);
														foreach ($fitter_id_display as $key => $val_fitter) {
															if (isset($fitter_code_arr[$val_fitter])) {
																echo "<span class='badge'>" . $fitter_code_arr[$val_fitter] . "</span><br/>";
															}
														}
													}
													?>
												</td> -->

												<!-- <td>
                    <?php if (!isset($value['status_inspection'])) { ?>
                      <input type='hidden' name='id_fitup_reject[<?php echo $no; ?>]' value='x'> 
                      <input type='hidden' name='status_process[<?php echo $no; ?>]' value='new'>
                      <select  class='select2_multiple_welder' name='tack_weld_id[<?php echo $no; ?>][]' multiple required disabled></select>
                    <?php
											} else {
												$tack_weld_id_display = explode(";", $value['tack_weld_id']);
												foreach ($tack_weld_id_display as $key => $val_tack_weld_id) {
													if (isset($welder_code_arr[$val_tack_weld_id])) {
														echo "<span class='badge'>" . $welder_code_arr[$val_tack_weld_id] . "</span><br/>";
													}
												}
											}
					?>  
                  </td> -->

												<!-- <td>
                    <?php if (!isset($value['status_inspection'])) { ?>
                      <select  class='select2_multiple_wps' name='wps[<?php echo $no; ?>][]' multiple required disabled></select>
                    <?php
											} else {
												$wps_display = explode(";", $value['wps_no']);
												foreach ($wps_display as $key => $wps_id) {
													if (isset($wps_code_arr[$wps_id])) {
														echo "<span class='badge'>" . $wps_code_arr[$wps_id] . "</span><br/>";
													}
												}
											}
					?>                    
                  </td> -->

												<td>
													<?php if (!isset($value['status_inspection'])) { ?>
														<textarea name='remarks[<?php echo $no; ?>]' placeholder="---" disabled></textarea>
													<?php } else { ?>
														<?php if (!empty($value["remarks"])) {
															echo $value["remarks"];
														} else {
															echo "-";
														} ?>
													<?php } ?>
												</td>

												<td>
													<?php if (isset($value['submission_id'])) {
														echo $value['submission_id'];
													} else {
														echo "-";
													} ?>
												</td>

												<td>
													<?php if ($value['status_inspection_svy'] == '0') { ?>
														<span class='btn btn-info'>Pending Transmit SMOE Inspection</span>
													<?php } else if ($value['status_inspection_svy'] == '1') { ?>
														<span class='btn btn-primary'>Pending SMOE Inspection</span>
													<?php } else if ($value['status_inspection_svy'] == '2') { ?>
														<span class='btn btn-danger'>Rejected SMOE Inspection</span>
													<?php } else if ($value['status_inspection_svy'] == '3') { ?>
														<span class='btn btn-success'>Approved SMOE Inspection</span>
													<?php } else if ($value['status_inspection_svy'] == '4') { ?>
														<span class='btn btn-primary'>Pending By SMOE QC</span>
													<?php } else if ($value['status_inspection_svy'] == '5') { ?>
														<span class='btn btn-primary'>Pending CLIENT Inspection</span>
													<?php } else if ($value['status_inspection_svy'] == '6') { ?>
														<span class='btn btn-danger'>Rejected CLIENT Inspection</span>
													<?php } else if ($value['status_inspection_svy'] == '7') { ?>
														<span class='btn btn-success'>Approved CLIENT Inspection</span>
													<?php } else if ($value['status_inspection_svy'] == '9') { ?>
														<span class='btn btn-success'>Approved & Released With Comment CLIENT Inspection</span>
													<?php } else if ($value['status_inspection_svy'] == '10') { ?>
														<span class='btn btn-info'>Postponed CLIENT Inspection</span>
													<?php } else if ($value['status_inspection_svy'] == '11') { ?>
														<span class='btn btn-info'>Postponed CLIENT Inspection</span>
													<?php } else { ?>
														<span class='btn btn-secondary'>Pending Surveyor</span>
													<?php } ?>
												</td>

												<td>
													<?php if (isset($value['inspection_by_svy'])) {
														echo $user_list[$value['inspection_by_svy']]['full_name'];
													} else {
														echo "-";
													} ?>
												</td>

												<td>
													<?php if (isset($value['inspection_date_svy'])) {
														echo date("Y-m-d H:i:s", strtotime($value['inspection_date_svy']));
													} else {
														echo "-";
													} ?>
												</td>

												<td>
													<?php if (isset($value['client_inspection_by_svy'])) {
														echo $user_list[$value['client_inspection_by_svy']]['full_name'];
													} else {
														echo "-";
													} ?>
												</td>

												<td>
													<?php if (isset($value['client_inspection_date_svy'])) {
														echo date("Y-m-d H:i:s", strtotime($value['client_inspection_date_svy']));
													} else {
														echo "-";
													} ?>
												</td>

												<td>
													<?php $exlode_status_surveyor = explode(";", $value['status_surveyor']); ?>
													<select name='status_surveyor[<?php echo $no; ?>][]' class='form-control select2_multiple_status_surveyor' required multiple>
														<option value=''>~ Choose ~</option>
														<?php foreach ($surveyor_status as $key => $srvyr_status) { ?>
															<option value='<?php echo $srvyr_status["id"] ?>' <?= in_array($srvyr_status["id"], $exlode_status_surveyor) ? "selected" : null ?>><?php echo $srvyr_status["description"] ?></option>
														<?php } ?>
													</select>
												</td>

												<td><input type="file" name="attachment_surveyor_fu[<?php echo $no; ?>]" required disabled></td>

												<td>
													<?php if ($status_data == 3) { ?>
														<select name='progress_on_percentage' onchange='update_percent_detail(this,<?php echo $value["id_wp_main"]; ?>,<?php echo $value["id_jn_temp"]; ?>,"progress_fu","<?php echo $workpack["phase"]; ?>","<?php echo $value["pos_1"]; ?>","<?php echo $value["pos_2"]; ?>");'>
															<option value='0' <?php if ($value["progress_fu"] == 0 or !isset($value["progress_fu"])) {
																					echo "selected";
																				} ?>>0%</option>
															<option value='25' <?php if ($value["progress_fu"] == 25) {
																					echo "selected";
																				} ?>>25%</option>
															<option value='50' <?php if ($value["progress_fu"] == 50) {
																					echo "selected";
																				} ?>>50%</option>
															<option value='75' <?php if ($value["progress_fu"] == 75) {
																					echo "selected";
																				} ?>>75%</option>
															<option value='100' <?php if ($value["progress_fu"] == 100) {
																					echo "selected";
																				} ?>>100%</option>
														</select>
													<?php } else if ($status_data == 2 and $value['status_inspection'] == '0') { ?>
														<span class='btn btn-warning' title="Waiting RFI Submition List" onclick="delete_fitup_data('<?php echo $value['id_fitup']; ?>');"><i class="fas fa-undo-alt"></i></span>
													<?php } else if (isset($value['status_inspection']) and $value['status_inspection'] != '0') { ?>
														<span class='btn btn-warning' title="RFI Submited!"><i class="fas fa-user-check"></i></span>
													<?php } else { ?>
														<span class='btn btn-danger' title="Material still not ready.."><i class="fas fa-times-circle"></i></span>
													<?php } ?>
												</td>

											</tr>
										<?php if ($value["progress_fu"] >= 0) {
												$total_progress++;
											}
											$no++;
										endforeach; ?>
									</tbody>
								</table>
							</div>
							<?php if ($total_progress > 0) { ?>
								<br>
								<br>
								<div class="text-right">
									<button type="submit" id="btn_submit" class="btn btn-success" disabled onclick="sweetalert('confirm', 'Are you sure?', this, event)">
										<i class="fas fa-check"></i> Submit
									</button>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>

		</form>

	<?php } ?>

	<?php if (sizeof($joint_list_visual) > 0) { ?>

		<form action="<?= site_url('planning/save_update_to_visual') ?>" method="post" id="form_submition_vs" onsubmit="if( _formConfirm_submitted == false ){ _formConfirm_submitted_vs = true;return true }else{ alert('Please Wait, Server still busy, wait till process done, Thanks!'); return false;  }" enctype="multipart/form-data">


			<input type="hidden" name="wp_id_vs" value="<?= @$joint_list_visual[0]['workpack_id'] ?>">

			<input type="hidden" name="module_save" value="<?= $workpack['module'] ?>">
			<input type="hidden" name="project_save" value="<?= $workpack['project'] ?>">
			<input type="hidden" name="discipline_save" value="<?= $workpack['discipline'] ?>">
			<input type="hidden" name="type_of_module_save" value="<?= $workpack['type_of_module'] ?>">
			<input type="hidden" name="drawing_no_save" value="<?= @$joint_list[0]['drawing_no_template'] ?>">
			<input type="hidden" name="drawing_type_save" value="<?= @$joint_list[0]['drawing_type_template'] ?>">
			<input type="hidden" class="form-control" name="id" value="<?php echo @$workpack['id'] ?>">
			<input type="hidden" name="company_id_save" value="<?= $workpack['company_id'] ?>">


			<div class="row">
				<div class="col">
					<div class="card shadow my-3 rounded-0">
						<div class="card-header">
							<h6 class="m-0"><?php echo $meta_title ?> - Fit Up</h6>
						</div>
						<div class="card-body bg-white">
							<div class="overflow-auto">

								<div class="row">
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Surveyor Name</label>
											<div class="col-md">
												<input type='text' name='full_name' class='form-control' value='<?= $this->user_cookie[1]; ?>' readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Company Assigned</label>
											<div class="col-md">
												<input type='text' name='company' class='form-control' value='<?= $company_name[$joint_list[0]['company_id']] ?>' readonly>
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Area</label>
											<div class="col-md-8 col-lg-9">
												<select class="select2" name="area" required>
													<option value="">---</option>
													<?php foreach ($area as $value_area) { ?>
														<option value="<?= $value_area['id'] ?>"><?= $value_area['name'] ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Date</label>
											<div class="col-md">
												<input type='text' name='dateview' class='form-control' value='<?= date("Y-m-d"); ?>' readonly>
											</div>
										</div>
									</div>

								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Location</label>
											<div class="col-md-8 col-lg-9">
												<select class="select2" name="location" required>
													<option value="">---</option>
													<?php foreach ($location as $value_location) { ?>
														<option value="<?= $value_location['id'] ?>" data-chained="<?php echo $value_location['id_area'] ?>"><?= $value_location['name'] ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">

										</div>
									</div>

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
							<h6 class="m-0"><?php echo $meta_title ?> - Welding Progress</h6>
						</div>
						<div class="card-body bg-white overflow-auto">
							<table width='100%' class="table table-hover text-center dataTable" id='table_submission'>
								<thead class="bg-green-smoe text-white">
									<tr>
										<th rowspan="2">#</th>
										<th rowspan="2" style='width:300px !important;max-width: 300px !important;'>Drawing Weld Map</th>
										<th rowspan="2">Joint No.</th>
										<th rowspan="2">Weld Type</th>
										<th rowspan="2">Cons/Lot No.</th>
										<th rowspan="1" colspan="2" style='width:300px !important;max-width: 300px !important;'>WPS</th>
										<th rowspan="1" colspan="2" style='width:200px !important;max-width: 200px !important;'>Weld Process</th>
										<th rowspan="1" colspan="2" style='width:300px !important;max-width: 300px !important;'>Welder ID</th>
										<th rowspan="2">Dia (Inch)</th>
										<th rowspan="2">Thk (mm)</th>
										<!-- <th rowspan="2">Location</th> -->
										<th rowspan="2">Weld Length (mm)</th>
										<th rowspan="1" colspan="2" style='width:300px !important;max-width: 300px !important;'>Weld Date</th>
										<th rowspan="2">Remarks</th>

										<th rowspan="2" style="width: 200px !important;">Submission No</th>
										<th rowspan="2" style="width: 200px !important;">Status Inspection</th>
										<th rowspan="2" style="width: 200px !important;">Inspection By</th>
										<th rowspan="2" style="width: 200px !important;">Inspection Date</th>
										<th rowspan="2" style="width: 200px !important;">Client Inspection By</th>
										<th rowspan="2" style="width: 200px !important;">Client Inspection Date</th>
										<th rowspan="2" style="width: 200px !important;">Status Surveyor</th>
										<th rowspan="2" style="width: 200px !important;">Evidence Of Progress</th>

										<th rowspan="2">Progress On (%)</th>
									</tr>
									<tr>
										<th style='width:150px !important;max-width: 150px !important;'>R/H</th>
										<th style='width:150px !important;max-width: 150px !important;'>F/C</th>
										<th style='width:100px !important;max-width: 100px !important;'>R/H</th>
										<th style='width:100px !important;max-width: 100px !important;'>F/C</th>
										<th style='width:150px !important;max-width: 150px !important;'>R/H</th>
										<th style='width:150px !important;max-width: 150px !important;'>F/C</th>
										<th style='width:150px !important;max-width: 150px !important;'>Date</th>
										<th style='width:150px !important;max-width: 150px !important;'>Time</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 0;
									$total_progress = 0;
									foreach ($joint_list_visual as $key => $value) :
										// test_var($joint_list_visual)
									?>


										<?php
										$legend_fitup = $value["fitup_legend"];
										$legend_filter = explode(";", $legend_fitup);
										?>

										<?php
										$current_date           = new DateTime(date("Y-m-d H:i:s"));
										$fitup_approve_datetime = new DateTime($value["fitup_time_inspect"]);
										$diff = $fitup_approve_datetime->diff($current_date);
										$hours  = round($diff->s / 3600 + $diff->i / 60 + $diff->h + $diff->days * 24, 2);
										?>

										<tr>
											<td>
												<?php if ($value["fitup_status_inspection_svy"] >= 5 || $value['status_internal'] == 1) { ?>

													<?php if (($legend_filter[0] == 1 or $legend_filter[1] == 1) and $value["fitup_status_inspection_svy"] != 7 and $value["fitup_status_inspection_svy"] != 9 and $hours < 24) { ?>
														<span class='btn btn-danger' title="Waiting Client Approved on Hold Point Or Witness Fitup Submission..!"><i class="fas fa-times-circle"></i></span>
													<?php } else { ?>
														<?php
														if ($value["progress_vt"] >= 100) {
															if (isset($value["vs_status"])) {
																$not_completed = 0;
															} else {
																$not_completed = 1;
																$is_100 = 'is_100';
															}
														} else {
															$not_completed = 1;
															$is_100 = 'is_not_100';
														}
														?>

														<?php if ($not_completed == 1) : ?>
															<input type='hidden' name='id_joint[<?php echo $no; ?>]' value='<?php echo $value['id_jn_temp']; ?>'>
															<input type='checkbox' class="checkbox-big <?= $is_100 ?>" name='submit_id[<?php echo $no; ?>]' onclick='enable_edit("<?= $no ?>", this)'>
															<input type='hidden' name='filter_check[<?php echo $no; ?>]' value='0'>
															<input type="hidden" name="id_wp_save[<?= $no ?>]" value="<?= $value['id_wp_main'] ?>">
															<span class='btn btn-danger <?= $is_100 ?>' title="Waiting actual progress 100%"><i class="fas fa-times-circle"></i></span>
														<?php elseif ($not_completed == 0) : ?>
															<span style='font-weight:bold;font-size:15px;color:green'>&#128504;</span>
														<?php endif; ?>

													<?php } ?>

												<?php } else { ?>

													<span class='btn btn-danger' title="Waiting Fitup Transmitted to client.. To Define Legend Status Invitation.."><i class="fas fa-times-circle"></i></span>

												<?php } ?>
											</td>
											<td style='width:300px !important;max-width: 300px !important;'>
												<?php if ($value["fitup_status_inspection_svy"] >= 5 || $value['status_internal'] == 1) { ?>
													<?php echo $value['drawing_wm'] ?> Rev.<?php echo $value['rev_wm'] ?>
												<?php } else { ?>
													<span class='btn btn-danger'>Waiting Fit-Up Transmittal to client<br />Checking Legend Status Invitation</span>
												<?php } ?>
											</td>
											<td><?php echo $value['joint_no'] ?></td>
											<td><?php echo $weld_type_list[$value['weld_type']]['weld_type'] ?></td>
											<td>
												<input disabled class="will_enable<?= $no ?>" type="text" name="cons_lot_no[<?= $no ?>]" value="<?= $value['cons_lot_no'] ?>" style='max-width: 100px !important;'>
												<!-- <select name='cons_lot_no[<?= $no ?>]' class='form-control will_enable<?= $no ?>'>
													<option value=''>~ Choose ~</option>
													<?php foreach ($cons_lot_list as $cons_lot) { ?>
														<option value='<?= $cons_lot["batch_lot_no"] ?>' <?= $cons_lot["batch_lot_no"] == $value['cons_lot_no'] ? "selected" : null ?>><?= $cons_lot["batch_lot_no"] ?></option>
													<?php } ?>
												</select> -->
											</td>
											<!-- =======================================RH======================================================= -->
											<td>
												<?php if ($weld_type_list[$value['weld_type']]['weld_type_code'] != 'FW') { ?>
													<div id='wps_rh<?= $no; ?>'>
														<?php $arr_wps_rh = explode(';', $value['wps_no_rh']) ?>
														<div class="input-group mb-3 form-check form-check-inline">
															<select style='min-width: 75px' multiple onchange="showWProc(0, this, <?= $no ?>)" class="form-control select2 will_enable<?= $no; ?> wps_select_rh wps_select_rh_<?= $no; ?>" name="wps_rh[<?= $no ?>][]" disabled>
																<option value=''>---</option>
																<?php foreach ($wps_group[$value['company_id']][$value['project']][$value['discipline']] as $key_opsi_rh => $value_opsi) : ?>
																	<option value='<?= $value_opsi['id_wps'] ?>' <?= (in_array($value_opsi['id_wps'], $arr_wps_rh) ? 'selected' : '') ?>><?= $value_opsi['wps_no'] ?></option>
																<?php endforeach; ?>
															</select>
														</div>
													</div>
												<?php  } else { ?>
													<input type="hidden" class='form-control' name="wps_rh[<?= $no ?>][]" value='<?php echo null; ?>' readonly>
												<?php  } ?>
											</td>
											<!-- ================================================================================================= -->
											<!-- ===============================================FC================================================ -->
											<td>
												<div id='wps_fc<?= $no; ?>'>
													<?php $arr_wps_fc = explode(';', $value['wps_no_fc']) ?>
													<div class="input-group mb-3 form-check form-check-inline">
														<select style='min-width: 75px' multiple onchange="showWProc(1, this, <?= $no ?>)" class="form-control select2 will_enable<?= $no; ?> wps_select_fc wps_select_fc_<?= $no; ?>" name="wps_fc[<?= $no ?>][]" disabled>
															<option value=''>---</option>
															<?php foreach ($wps_group[$value['company_id']][$value['project']][$value['discipline']] as $key_opsi_fc => $value_opsi) : ?>
																<option value='<?= $value_opsi['id_wps'] ?>' <?= (in_array($value_opsi['id_wps'], $arr_wps_fc) ? 'selected' : '') ?>><?= $value_opsi['wps_no'] ?></option>
															<?php endforeach; ?>
														</select>
													</div>
												</div>
											</td>
											<!-- ================================================================================================ -->
											<?php if ($value["weld_process_rh"]) { ?>
												<td>
													<?php $data = str_replace(";", "<br>", $value["weld_process_rh"]) ?>
													<?= $data ?>
												</td>
											<?php }else{ ?>
												<td class="wps_rh_text">
													<i>~ Based on WPS RH Selected ~</i>
												</td>
											<?php } ?>
											<?php if ($value["weld_process_fc"]) { ?>
												<td>
													<?php $data = str_replace(";", "<br>", $value["weld_process_fc"]) ?>
													<?= $data ?>
												</td>
											<?php }else{ ?>
												<td class="wps_fc_text">
													<i>~ Based on WPS FC Selected ~</i>
												</td>
											<?php } ?>
											<td>
												<?php if ($weld_type_list[$value['weld_type']]['weld_type_code'] != 'FW') { ?>
													<div id='table_rh<?= $no; ?>'>
														<?php $arr_welder_rh[$no] = $visual_detail[$value['id_visual']][0] ?>
														<?php foreach ($arr_welder_rh[$no] ?? [''] as $key_welder_rh => $value_welder_rh) { ?>
															<div class="input-group mb-3 form-check form-check-inline">
																<input style='min-width: 75px' type="text" placeholder="Welder Tag" class="form-control will_enable<?= $no; ?>" onfocus="welder_autocomplete_rh('999', '<?= $no; ?>', '<?= $value['company_id'] ?>', this)" name="welder_rh[<?= $no; ?>][]" value='<?= @$welders[$value_welder_rh['id_welder']]["welder_code"] ?>' disabled>
																<input style='min-width: 75px !important' type='number' class='form-control will_enable<?= $no ?> rh_<?= $key_welder_rh ?>' name='length_welded_rh[<?= $no ?>][]' placeholder='Length Welded' max='<?= $value['weld_length'] ?>' value="<?= @$value_welder_rh['length_welded'] ?>" disabled>
																<span class="btn btn-primary will_enable<?= $no; ?> disabled-effect" onclick="add_rh('<?= $no; ?>')" disabled>
																	<i class="fas fa-plus"></i>
																</span>
															</div>
														<?php } ?>
														<script type="text/javascript">
															var no_rh = 0;

															function add_rh(key) {
																no_rh++;
																var html = '<div class="input-group mb-3 form-check form-check-inline ctq_row_rh_' + no_rh + '">';
																html += '<input type="text" placeholder="Welder Tag" class="auto_rh_' + no_rh + ' form-control will_enable' + key + '" name="welder_rh[' + key + '][]" value="" onfocus="welder_autocomplete_rh(' + no_rh + ', ' + key + ', <?= $value['company_id'] ?>, this)">'
																html += '<input  style="min-width: 75px !important"  type="number"  class="form-control will_enable' + key + ' rh_<?= $key_welder_rh ?>"  name="length_welded_rh[' + key + '][]" placeholder="Length Welded" max="<?= $value['weld_length'] ?>">';
																html += '<span class="btn btn-danger" onclick="delete_rh(' + no_rh + ')"><i class="fas fa-times"></i></span>'
																html += '</div>'
																$('#table_rh' + key).append(html)
															}

															function delete_rh(key) {
																$('.ctq_row_rh_' + key).remove()
															}

															function welder_autocomplete_rh(no, keyes, company_id, input) {
																var wps = $('.wps_select_rh_' + keyes).val()
																$(input).autocomplete({
																	source: function(request, response) {
																		console.log("welder autocomplete")
																		$.post('<?php echo base_url(); ?>visual/welder_autocomplete', {
																			term: request.term,
																			company_id: company_id,
																			wps: wps,
																		}, response, 'json');
																	},
																	autoFocus: true,
																	classes: {
																		"ui-autocomplete": "highlight"
																	}
																});
															}
														</script>

													</div>
												<?php  } else { ?>
													<input type="hidden" class='form-control' name="welder_rh[<?= $no; ?>][]" value='<?php echo null; ?>' readonly>
												<?php  } ?>
											</td>
											<td>
												<div id='table_fc<?= $no; ?>'>

													<?php $arr_welder_fc[$no] = $visual_detail[$value['id_visual']][1] ?>
													<?php foreach ($arr_welder_fc[$no] ?? [''] as $key_welder_fc => $value_welder_fc) { ?>
														<div class="input-group mb-3 form-check form-check-inline">
															<input style='min-width: 75px' type="text" placeholder="Welder Tag" class="form-control will_enable<?= $no; ?>" onfocus="welder_autocomplete_fc('999', '<?= $no; ?>', '<?= $value['company_id'] ?>', this)" name="welder_fc[<?= $no; ?>][]" value='<?= @$welders[$value_welder_fc['id_welder']]["welder_code"] ?>' disabled>
															<input style='min-width: 75px !important' type='number' class='form-control will_enable<?= $no ?> fc_<?= $key_welder_fc ?>' name='length_welded_fc[<?= $no ?>][]' placeholder='Length Welded' max='<?= $value['weld_length'] ?>' value="<?= @$value_welder_fc['length_welded'] ?>" disabled>
															<span class="btn btn-primary will_enable<?= $no; ?> disabled-effect" onclick="add_fc('<?= $no; ?>')" disabled>
																<i class="fas fa-plus"></i>
															</span>
														</div>
													<?php } ?>
													<script type="text/javascript">
														var no_fc = 0;

														function add_fc(key) {
															no_fc++;
															var html = '<div class="input-group mb-3 form-check form-check-inline ctq_row_fc_' + no_fc + '">';
															html += '<input type="text" placeholder="Welder Tag" class="auto_fc_' + no_fc + ' form-control will_enable' + key + '" name="welder_fc[' + key + '][]" value="" onfocus="welder_autocomplete_fc(' + no_fc + ', ' + key + ', <?= $value['company_id'] ?>, this)">'
															html += '<input  style="min-width: 75px !important"  type="number"  class="form-control will_enable' + key + ' fc_<?= $key_welder_fc ?>"  name="length_welded_fc[' + key + '][]" placeholder="Length Welded" max="<?= $value['weld_length'] ?>">';
															html += '<span class="btn btn-danger" onclick="delete_fc(' + no_fc + ')"><i class="fas fa-times"></i></span>'
															html += '</div>'
															$('#table_fc' + key).append(html)
														}

														function delete_fc(key) {
															$('.ctq_row_fc_' + key).remove()
														}

														function welder_autocomplete_fc(no, keyes, company_id, input) {
															var wps = $('.wps_select_fc_' + keyes).val()
															$(input).autocomplete({
																source: function(request, response) {
																	console.log("welder autocomplete")
																	$.post('<?php echo base_url(); ?>visual/welder_autocomplete', {
																		term: request.term,
																		company_id: company_id,
																		wps: wps,
																	}, response, 'json');
																},
																autoFocus: true,
																classes: {
																	"ui-autocomplete": "highlight"
																}
															});
														}
													</script>

												</div>
											</td>
											<td><?php echo $value['diameter'] ?></td>
											<td><?php echo $value['thickness'] ?></td>
											<!-- <td>

                      <select disabled class="select2 will_enable<?= $no ?>" name="location[<?= $no ?>]">
                        <option value="">---</option>
                        <?php foreach ($location as $value_location) { ?>
                          <option value="<?= $value_location['id'] ?>" <?= $value_location['id'] == $value['vs_location'] ? 'selected' : '' ?>><?= $value_location['location_name'] ?></option>
                        <?php } ?>
                      </select>
                    </td>                     -->
											<td>
												<?php if (!isset($value['status_inspection'])) { ?>
													<input disabled class="form-control will_enable<?= $no ?>" type="number" name="weld_length[<?= $no ?>]" value="<?= $value['weld_length'] ?>">
												<?php } else { ?>
													<?php echo $value['weld_length']; ?>
												<?php } ?>
											</td>
											<td>
												<?php if (!isset($value['status_inspection'])) { ?>
													<input disabled class="form-control will_enable<?= $no ?>" type="date" name="weld_date[<?= $no ?>]" min='<?= ($value["discipline"] != 1 ? date("Y-m-d", strtotime($value["fitup_inspection_datetime"])) : "2000-01-01")  ?>' max='<?= date("Y-m-d") ?>'>
												<?php } else { ?>
													<?php echo date("Y-m-d", strtotime($value['weld_datetime'])); ?>
												<?php } ?>
											</td>
											<td>
												<?php if (!isset($value['status_inspection'])) { ?>
													<input disabled class="form-control will_enable<?= $no ?>" type="time" name="weld_time[<?= $no ?>]">
												<?php } else { ?>
													<?php echo date("H:i:s", strtotime($value['weld_datetime'])); ?>
												<?php } ?>
											</td>
											<td>
												<?php if (!isset($value['status_inspection'])) { ?>
													<input disabled class="form-control will_enable<?= $no ?>" type="text" name="inspection_remarks[<?= $no ?>]" value="<?= $value['remarks'] ?>">
												<?php } else { ?>
													<?php echo $value['remarks']; ?>
												<?php } ?>
											</td>

											<td>
												<?php if (isset($value['submission_id'])) {
													echo $value['submission_id'];
												} else {
													echo "-";
												} ?>
											</td>

											<td>
												<?php if (($legend_filter[0] == 1 or $legend_filter[1] == 1) and $value["fitup_status_inspection_svy"] != 7 and $value["fitup_status_inspection_svy"] != 9 and $hours < 24) { ?>
													<span class='btn btn-danger'>Fitup Hold Point Or Witness Legend</span>

													<button type="button" class="badge btn btn-warning">
														Locking Open After <span class="badge badge-light"><?= round(24 - $hours, 2) ?> Hours</span>
													</button>

												<?php } else { ?>
													<?php if ($value['status_inspection_svy'] == '0') { ?>
														<span class='btn btn-info'>Pending Transmit SMOE Inspection</span>
													<?php } else if ($value['status_inspection_svy'] == '1') { ?>
														<span class='btn btn-primary'>Pending SMOE Inspection</span>
													<?php } else if ($value['status_inspection_svy'] == '2') { ?>
														<span class='btn btn-danger'>Rejected SMOE Inspection</span>
													<?php } else if ($value['status_inspection_svy'] == '3') { ?>
														<span class='btn btn-success'>Approved SMOE Inspection</span>
													<?php } else if ($value['status_inspection_svy'] == '4') { ?>
														<span class='btn btn-primary'>Pending By SMOE QC</span>
													<?php } else if ($value['status_inspection_svy'] == '5') { ?>
														<span class='btn btn-primary'>Pending CLIENT Inspection</span>
													<?php } else if ($value['status_inspection_svy'] == '6') { ?>
														<span class='btn btn-danger'>Rejected CLIENT Inspection</span>
													<?php } else if ($value['status_inspection_svy'] == '7') { ?>
														<span class='btn btn-success'>Approved CLIENT Inspection</span>
													<?php } else { ?>
														<span class='btn btn-secondary'>Pending Surveyor</span>
													<?php } ?>
												<?php } ?>

											</td>

											<td>
												<?php if (isset($value['inspection_by_svy'])) {
													echo $user_list[$value['inspection_by_svy']]['full_name'];
												} else {
													echo "-";
												} ?>
											</td>

											<td>
												<?php if (isset($value['inspection_date_svy'])) {
													echo date("Y-m-d H:i:s", strtotime($value['inspection_date_svy']));
												} else {
													echo "-";
												} ?>
											</td>

											<td>
												<?php if (isset($value['client_inspection_by_svy'])) {
													echo $user_list[$value['client_inspection_by_svy']]['full_name'];
												} else {
													echo "-";
												} ?>
											</td>

											<td>
												<?php if (isset($value['client_inspection_date_svy'])) {
													echo date("Y-m-d H:i:s", strtotime($value['client_inspection_date_svy']));
												} else {
													echo "-";
												} ?>
											</td>

											<td>
												<?php $exlode_status_surveyor = explode(";", $value['status_surveyor']); ?>
												<select name='status_surveyor[<?php echo $no; ?>][]' class='form-control select2_multiple_status_surveyor_vis  will_enable<?= $no ?>' multiple>
													<option value=''>~ Choose ~</option>
													<?php foreach ($surveyor_status as $key => $srvyr_status) { ?>
														<option value='<?php echo $srvyr_status["id"] ?>' <?= in_array($srvyr_status["id"], $exlode_status_surveyor) ? "selected" : null ?>><?php echo $srvyr_status["description"] ?></option>
													<?php } ?>
												</select>
											</td>

											<td><input type="file" disabled name="attachment_surveyor_vs[<?php echo $no; ?>]" required class='will_enable<?= $no ?>'></td>

											<td>

												<?php if ($value["fitup_status_inspection_svy"] >= 5 || $value['status_internal'] == 1) { ?>

													<?php if (($legend_filter[0] == 1 or $legend_filter[1] == 1) and $value["fitup_status_inspection_svy"] != 7 and $value["fitup_status_inspection_svy"] != 9 and $hours < 24) { ?>
														<span class='btn btn-danger' title="Waiting Client Approved on Hold Point Or Witness Fitup Submission..!"><i class="fas fa-times-circle"></i></span>
													<?php } else { ?>

														<?php if ($value["progress_vt"] <= 100 and $value['status_inspection'] != '0') { ?>
															<select name='progress_on_percentage' onchange='update_percent_detail(this,<?php echo $value["id_wp_main"]; ?>,<?php echo $value["id_jn_temp"]; ?>,"progress_vt","<?php echo $workpack["phase"]; ?>","<?php echo $value["pos_1"]; ?>","<?php echo $value["pos_2"]; ?>");'>
																<option value='0' <?php if ($value["progress_vt"] == 0 or !isset($value["progress_vt"])) {
																						echo "selected";
																					} ?>>0%</option>
																<option value='25' <?php if ($value["progress_vt"] == 25) {
																						echo "selected";
																					} ?>>25%</option>
																<option value='50' <?php if ($value["progress_vt"] == 50) {
																						echo "selected";
																					} ?>>50%</option>
																<option value='75' <?php if ($value["progress_vt"] == 75) {
																						echo "selected";
																					} ?>>75%</option>
																<option value='100' <?php if ($value["progress_vt"] == 100) {
																						echo "selected";
																					} ?>>100%</option>
															</select>
														<?php } else if ($value["progress_vt"] >= 100 and $value['vs_status'] == '0') { ?>
															<span class='btn btn-warning' title="Waiting RFI Submition List" onclick="delete_visual_data('<?php echo $value['id_visual']; ?>');"><i class="fas fa-undo-alt"></i></span>
														<?php } else if (isset($value['vs_status']) and $value['status_inspection'] != '0') { ?>
															<span class='btn btn-warning' title="RFI Submited!"><i class="fas fa-user-check"></i></span>
														<?php } else { ?>
															<span class='btn btn-danger' title="Joint Not Ready for Visual.."><i class="fas fa-times-circle"></i></span>
														<?php } ?>

													<?php } ?>

												<?php } else { ?>

													<span class='btn btn-danger' title="Waiting Fitup Transmitted to client.. To Define Legend Status Invitation.."><i class="fas fa-times-circle"></i></span>

												<?php } ?>

											</td>
										</tr>
									<?php if ($value["progress_vt"] >= 100) {
											$total_progress++;
										}
										$no++;
									endforeach; ?>
								</tbody>
							</table>

							<?php //if($total_progress > 0){ 
							?>
							<br>
							<br>
							<div class="text-right">
								<button type="submit" id="btn_submit" class="btn btn-success"><i class="fas fa-check"></i> Submit</button>
							</div>
							<?php //} 
							?>

						</div>

					</div>
				</div>
			</div>

		</form>

	<?php } ?>

</div>
</div>
<script>
	var checked = []
	$("#table_submission").on('click', '.check', function() {
		var editable = $(this).closest('tr').find('.editable')
		var value = $(this).val()
		if (this.checked) {
			editable.removeAttr('disabled')
			checked.push(value)
		} else {
			editable.removeClass('is-valid is-invalid');
			editable.attr('disabled', true)
			checked.splice($.inArray(value, checked), 1)
		}

		if (checked.length > 0) {
			if (checked.length > 30) {
				this.checked = false
				editable.attr('disabled', true)
				checked.splice($.inArray(value, checked), 1)

				Swal.fire({
					type: "warning",
					title: "Warning",
					text: "Only 30 Data Allowed In Each Submission"
				})

			} else {
				$("#btn_submit").removeAttr('disabled')
			}
		} else {
			$("#btn_submit").attr('disabled', true)
		}
	})

	function remove_disabledwelder(type, no) {
		if (type == 'rh') {
			var weld_process_rh = $("#weld_process_rh" + no).val();
			var total_weld_process_rh = weld_process_rh.length;
			if (total_weld_process_rh > 0) {
				$('.will_enable_after_processrh' + no).removeAttr('disabled');
			} else {
				$('.will_enable_after_processrh' + no).attr('disabled', true)
			}
		} else {
			var weld_process_fc = $("#weld_process_fc" + no).val();
			var total_weld_process_fc = weld_process_fc.length;
			if (total_weld_process_fc > 0) {
				$('.will_enable_after_processfc' + no).removeAttr('disabled');
			} else {
				$('.will_enable_after_processfc' + no).attr('disabled', true)
			}
		}
	}


	function validate_unique_no(input, workpack_no, grade) {

		var unique_no = $(input).val()
		var invalid_feedback = $(input).closest('tr').find('.invalid-feedback')
		var mrir = $(input).closest('tr').find('.mrir')
		var heat_no = $(input).closest('tr').find('.heat_no')
		var material_description = $(input).closest('tr').find('.material_description')
		var id_mis = $(input).closest('tr').find('.id_mis')

		$(input).removeClass('is-invalid')
		$(input).removeClass('is-valid')

		if ($.trim(unique_no) == "") {
			$(input).addClass('is-invalid')
			invalid_feedback.text("Unique No Cannot Be Empty")
			return false;
		}

		$.ajax({
			url: "<?= site_url('material_verification/validate_unique_number') ?>",
			type: "POST",
			data: {
				unique_no: unique_no,
				workpack_no: workpack_no,
				grade: grade
			},
			dataType: "JSON",
			success: function(data) {
				if (data.success) {

					$(input).addClass('is-valid')
					var report_no = data.result.report_no.split('/')
					mrir.val(report_no[1])
					id_mis.val(data.result.id_mis_det)
					heat_no.val(data.result.heat_or_series_no)
					material_description.val(data.result.catalog_category)

				} else {

					mrir.val('')
					id_mis.val('')
					heat_no.val('')
					material_description.val('')

					$(input).val('')
					$(input).addClass('is-invalid')
					invalid_feedback.text(data.text)

				}
			}
		})
	}


	function autocomplete_unique(input, workpack_no, grade) {
		$(input).autocomplete({
			source: "<?php echo base_url(); ?>material_verification/autocomplete_unique_no/" + workpack_no + "/" + grade,
			autoFocus: true,
			classes: {
				"ui-autocomplete": "highlight"
			}
		});
	}

	$("select[name=module]").chained("select[name=project]");

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


	// $('.dataTable').DataTable({
	//      "paging":   false,
	//      "ordering": false, 
	// })

	$(".autocomplete_ga, .autocomplete_as").autocomplete({
		source: function(request, response) {
			var drawing_type;
			if ($(this.element).hasClass("autocomplete_ga") || $(this.element).hasClass("autocomplete_as")) {
				drawing_type = 1; //ga or as
			}
			$.ajax({
				url: "<?php echo base_url() ?>engineering/autocomplete_drawing/1",
				dataType: "json",
				data: {
					term: request.term,
					drawing_type: drawing_type,
				},
				success: function(data) {
					response(data);
				}
			});
		},
		select: function(event, ui) {
			var value = ui.item.value;
			if (value == 'No Data.') {
				ui.item.value = "";
			} else {
				get_data_drawing(ui.item.value);
			}
		}
	});

	function get_data_drawing(document_no) {
		var module = $("select[name=module]").val();
		console.log(document_no);
		console.log(module);
		$.ajax({
			url: "<?php echo base_url() ?>engineering/get_data_drawing",
			dataType: "json",
			data: {
				document_no: document_no,
				module: module,
			},
			success: function(data) {
				console.log(data);
				if (data.drawing_type == 1 || data.drawing_type == 2) {
					$("select[name=project]").val(data.project).trigger('change');
					$("select[name=discipline]").val(data.discipline);
					if (module == "") {
						$("select[name=module]").val(data.module);
					}
				}
			}
		});
	}

	function add_manhours() {
		var html = "<tr>" +
			"<td><input type='text' class='form-control text-center' name='manhours_name[]' required></td>" +
			"<td><input type='number' class='form-control text-center' value='0' name='manhours_manpower[]' oninput='calc_manhours(this)' required></td>" +
			"<td><input type='number' class='form-control text-center' value='0' name='manhours_day[]' oninput='calc_manhours(this)' required></td>" +
			"<td><input type='number' class='form-control text-center' value='0' name='manhours_manhours[]' oninput='calc_manhours(this)' required></td>" +
			"<td><span name='total'>0</span></td>" +
			"<td><button class='btn btn-sm btn-flat btn-danger' type='button' onclick='delete_manhours(this)'><i class='fas fa-times'></i></td>" +
			"</tr>";
		$("#tbl_manhours").append(html);
	}

	function delete_manhours(btn) {
		$(btn).closest("tr").remove();
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
					}
				});
			}
		})
	}

	function calc_manhours(input) {
		var manpower = $(input).closest("tr").find("input[type=number]:eq(0)").val();
		var days = $(input).closest("tr").find("input[type=number]:eq(1)").val();
		var manhours = $(input).closest("tr").find("input[type=number]:eq(2)").val();
		$(input).closest("tr").find("span[name=total]").text(manpower * days * manhours);
		var total_all = 0;
		$("span[name=total]").each(function(index) {
			total_all = total_all + parseInt($(this).text());
		})
		$("input[name=budget_manhours]").val(total_all);
	}


	function update_status_workpack(btn, id, text) {
		Swal.fire({
			title: 'Are you sure to <b class="text-danger">&nbsp;' + text + '&nbsp;</b> this?',
			text: "You won't be able to revert this!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, ' + text + ' it!'
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
					}
				});
			}
		})
	}


	function update_percent_detail(input, wp_id, temp_id, progress, phase, pos_1, pos_2) {

		var percent_val = $(input).val();

		console.log(percent_val);

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
					url: "<?php echo base_url() ?>planning/save_update_to_percent",
					data: {
						wp_id: wp_id,
						temp_id: temp_id,
						percent_val: percent_val,
						progress: progress,
						phase: phase,
						pos_1: pos_1,
						pos_2: pos_2,
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
						// location.reload();
						swal.close();
						if (percent_val == 100) {
							$(input).closest('tr').find('.is_not_100').addClass('is_100');
							$(input).closest('tr').find('.is_not_100').removeClass('is_not_100');
						} else {
							$(input).closest('tr').find('.is_100').addClass('is_not_100');
							$(input).closest('tr').find('.is_100').removeClass('is_100');
						}
					}
				});
			}
		})

	}

	function delete_fitup_data(id_fitup) {

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
					url: "<?php echo base_url() ?>planning/delete_fitup_data",
					data: {
						id_fitup: id_fitup
					},
					type: 'post',
					success: function(data) {
						sweetalert("success", "Delete Data Success!");
						location.reload();
					}
				});
			}
		})

	}

	function delete_visual_data(id_visual) {

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
					url: "<?php echo base_url() ?>planning/delete_visual_data",
					data: {
						id_visual: id_visual
					},
					type: 'post',
					success: function(data) {
						sweetalert("success", "Delete Data Success!");
						location.reload();
					}
				});
			}
		})

	}



	function open_disabled_form(val, no, status_inspection) {

		var $checkboxes = $('#form_submition_fu td input[type="checkbox"]');
		$checkboxes.change(function() {
			var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
			$('#total_data_checked').text(countCheckedCheckboxes);
			$('#total_data_checked_val').val(countCheckedCheckboxes);

			if (countCheckedCheckboxes > 0) {
				$("#btn_submit").removeAttr('disabled');
			} else {
				$("#btn_submit").prop("disabled", true);
			}

			if (countCheckedCheckboxes <= 30) {

				if ($(val).prop("checked") == true) {
					$('input[name="attachment_surveyor_fu[' + no + ']"]').prop("disabled", false);
					// $('select[name="fitter_id[' + no + '][]"]').prop("disabled", false);
					$('select[name="tack_weld_id[' + no + '][]"]').prop("disabled", false);
					$('select[name="wps[' + no + '][]"]').prop("disabled", false);
					$('textarea[name="remarks[' + no + ']"]').prop("disabled", false);
					$('input[name="filter_check[' + no + ']"]').val(1);
				} else {
					// $('select[name="fitter_id[' + no + '][]"]').prop("disabled", true);
					$('select[name="tack_weld_id[' + no + '][]"]').prop("disabled", true);
					$('select[name="wps[' + no + '][]"]').prop("disabled", true);
					$('textarea[name="remarks[' + no + ']"]').prop("disabled", true);
					$('input[name="attachment_surveyor_fu[' + no + ']"]').prop("disabled", true);

					if (status_inspection != 2 && status_inspection != 4 && status_inspection != 6) {

						// $('select[name="fitter_id[' + no + '][]"]').find('option:selected').remove();
						$('select[name="tack_weld_id[' + no + '][]"]').find('option:selected').remove();
						$('select[name="wps[' + no + '][]"]').find('option:selected').remove();

					}

					$('input[name="filter_check[' + no + ']"]').val(0);
				}

			} else {

				alert("Sorry, Data checked has been maximum..");
				// $('select[name="fitter_id[' + no + '][]"]').prop("disabled", true);
				$('select[name="tack_weld_id[' + no + '][]"]').prop("disabled", true);
				$('select[name="wps[' + no + '][]"]').prop("disabled", true);
				$('textarea[name="remarks[' + no + ']"]').prop("disabled", true);
				$('input[name="attachment_surveyor_fu[' + no + ']"]').prop("disabled", true);

				if (status_inspection != 2 && status_inspection != 4) {

					// $('select[name="fitter_id[' + no + '][]"]').find('option:selected').remove();
					$('select[name="tack_weld_id[' + no + '][]"]').find('option:selected').remove();
					$('select[name="wps[' + no + '][]"]').find('option:selected').remove();

				}

				$('input[name="filter_check[' + no + ']"]').val(0);

			}
		});



	}
</script>

<script type="text/javascript">
	$(document).ready(function() {

		$(".select2_multiple_status_surveyor").select2({
			tokenSeparators: [',', ' '],
		})

		$(".select2_multiple_status_surveyor_vis").select2({
			tokenSeparators: [',', ' '],
		})


		$(".select2_multiple_fitter").select2({
			//tags: true,
			tokenSeparators: [',', ' '],
			ajax: {
				url: "<?php echo base_url(); ?>fitup/get_fitter_ajax",
				type: "post",
				dataType: 'json',
				data: function(params) {
					var query = {
						search: params.term
					}
					return query;
				},
				processResults: function(data) {
					return {
						results: data
					}
				}
			}
		})

		$(".select2_multiple_welder").select2({
			//tags: true,
			tokenSeparators: [',', ' '],
			ajax: {
				url: "<?php echo base_url(); ?>fitup/get_welder_ajax_version2",
				type: "post",
				dataType: 'json',
				data: function(params) {
					var query = {
						search: params.term
					}
					return query;
				},
				processResults: function(data) {
					return {
						results: data
					}
				}
			}
		})


		$(".select2_multiple_wps").select2({
			//tags: true,
			tokenSeparators: [',', ' '],
			ajax: {
				url: "<?php echo base_url(); ?>fitup/get_wps_ajax_version2",
				type: "post",
				dataType: 'json',
				data: function(params) {
					var query = {
						search: params.term
					}
					return query;
				},
				processResults: function(data) {
					return {
						results: data
					}
				}
			}
		})

		$(".select2_filter_joint_number").select2({
			ajax: {
				url: "<?php echo base_url(); ?>planning/get_joint_number/<?= $workpack_id_data ?>",
				type: "post",
				dataType: 'json',
				data: function(params) {
					var query = {
						search: params.term
					}
					return query;
				},
				processResults: function(data) {
					return {
						results: data
					}
				}
			}
		})

		$('.wps_select_rh').each(function(i, obj) {
			showWProc(0, obj);
		});

		$('.wps_select_fc').each(function(i, obj) {
			showWProc(1, obj);
		});

	});



	var selecteds = 0

	function enable_edit(no, thiss) {
		if (thiss.checked == true) {
			selecteds++
			console.log(selecteds)
			console.log('yes')
			$('.will_enable' + no).removeAttr('disabled');
			$('.will_enable' + no).prop('required', true);
			if (selecteds >= 30) {
				$('.checkbox-big').addClass('disabled-effect')
			}
		} else {
			selecteds--
			console.log('not')
			console.log(selecteds)
			$('.will_enable' + no).prop('disabled', true);
			$('.will_enable' + no).removeAttr('required');
		}
		$("#thicked b").text(' ' + selecteds);

		if ($(thiss).prop("checked") == true) {
			$('input[name="filter_check[' + no + ']"]').val(1);
		} else {
			$('input[name="filter_check[' + no + ']"]').val(0);
		}
	}


	function filter_joint_redirect() {

		var link_current = "<?= base_url(); ?>planning/surveyor_detail_jn/<?= strtr($this->encryption->encrypt($workpack_id_data), '+=/', '.-~') ?>";
		var arrayJointNumber = $('.select2_filter_joint_number').val();
		var forLink = arrayJointNumber.join("-");

		var fullLink = "<?= base_url(); ?>planning/surveyor_detail_jn/<?= strtr($this->encryption->encrypt($workpack_id_data), '+=/', '.-~') ?>/" + forLink;
		location.href = fullLink;

	}

	function showWProc(type, ini, keyes) {
		var id_wps = $(ini).val()
		$.ajax({
			url: "<?php echo base_url() ?>visual/find_detail_wps",
			type: "POST",
			data: {
				id_wps: id_wps,
			},
			success: function(data) {
				if (data && id_wps) {
					if (type == 0) {
						let weld_list = data.split(", ")
						let select_weld = `<select class="select3" multiple name="wps_rh_text[`+keyes+`][]" required">
							${
								weld_list.map(function(v) {
								return `<option value="${v}">${v}</option>`
								}).join('')
							}
						 </select>`

						// $(ini).closest('tr').find('.wps_rh_text').text(data)
						$(ini).closest('tr').find('.wps_rh_text').html(select_weld)
					} else if (type == 1) {
						let weld_list = data.split(", ")
						let select_weld = `<select class="select3" multiple name="wps_fc_text[`+keyes+`][]" required">
							${
								weld_list.map(function(v) {
								return `<option value="${v}">${v}</option>`
								}).join('')
							}
						 </select>`

						// $(ini).closest('tr').find('.wps_fc_text').text(data)
						$(ini).closest('tr').find('.wps_fc_text').html(select_weld)
					}
					$('.select3').select2()
				}
			}
		});
	}
</script>

<script type="text/javascript">
	$("select[name=location]").chained("select[name=area]");
</script>