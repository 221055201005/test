<?php
error_reporting(0);

$workpack = $workpack_list;
?>

<script type="text/javascript">
	var _formConfirm_submitted = false;
	var _formConfirm_submitted_vs = false;


	function reset_pages() {
		if ("<?php echo $type; ?>" == "fu") {
			var link = "<?php echo site_url('planning/submited_list/' . strtr($this->encryption->encrypt('fu'), '+=/', '.-~')); ?>";
		} else {
			var link = "<?php echo site_url('planning/submited_list/' . strtr($this->encryption->encrypt('vs'), '+=/', '.-~')); ?>";
		}
		window.location.replace(link);
	}

	function show_image(btn, source, type, drawing_wm, joint_no) {


		if (type == "client") {
			var url = "<?= $this->link_server  ?>/pcms_v2_photo/fab_img/" + source
		} else {
			var url = "<?= $this->link_server  ?>/pcms_v2_photo/" + source
		}

		var image_content = `
            <div class="row">
                <div class="col-md-12">
                 <table style='padding: 10px;font-weight:bold;font-style:italic;'>
                    <tr><td>Drawing Weld Map</td><td> : </td><td>${drawing_wm}</td></tr>
                    <tr><td>Joint Number</td><td> : </td><td>${joint_no}</td></tr>
                 </table>
                <br/>
                <img src="${url}" style="width : 100%">
                </div>
                <div class="col-md-12">
                <hr>
                <div class="float-right">
                    <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                </div>
                </div>
            </div>
        `

		$("#modal").modal({
			show: true,
			keyboard: false,
			backdrop: "static"
		}).find('.modal-body').html(image_content)
		$('.modal-title').text("Attachment")
		$('.modal-dialog').addClass('modal-lg')
	}
</script>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			</div>
		</div>
	</div>
</div>

<div id="content" class="container-fluid">

	<?php if ($type == "fu") { ?>

		<div class="row">
			<div class="col">
				<div class="card shadow my-3 rounded-0">
					<div class="card-header">
						<h6 class="m-0">Fit-Up | Filter Joint for Submission</h6>
					</div>
					<div class="card-body bg-white overflow-auto">
						<form action="" method="POST" id='form-filter'>

							<div class="row">

								<div class="col-6">
									<div class="form-group row">
										<label class="col-md-4 col-lg-3 col-form-label text-muted ">Project ID</label>
										<div class="col-xl">
											<select class="form-control" name="project" required>
												<?php foreach ($project_list as $key => $value) : ?>
													<?php if (in_array($value['id'], $this->user_cookie[13])) : ?>
														<option value="<?php echo $value['id'] ?>" <?php echo (@$post['project'] == $value['id'] ? 'selected' : ($this->user_cookie[10] == $value['id'] ? 'selected' : '')) ?>><?php echo $value['project_name'] ?></option>
													<?php endif; ?>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>

								<div class="col-6">
									<div class="form-group row">
										<label class="col-md-4 col-lg-3 col-form-label text-muted ">Discipline</label>
										<div class="col-xl">
											<select class="form-control" name="discipline">
												<option value="">---</option>
												<?php foreach ($discipline_list as $key => $value) : ?>
													<option value="<?php echo $value['id'] ?>" <?php echo (@$post['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>

							</div>

							<div class="row">

								<div class="col-6">
									<div class="form-group row">
										<label class="col-md-4 col-lg-3 col-form-label text-muted ">Deck Elevation / Service Line</label>
										<div class="col-xl">
											<select type="text" class="form-control select2" name="deck_elevation">
												<option value=''>~ Choose ~</option>
												<?php foreach ($deck_list as $key => $value) { ?>
													<option value='<?php echo $value["id"] ?>' <?= ($post["deck_elevation"] == $value["id"] ? "selected" : null) ?>><?php echo $value["name"] ?></option>
												<?php } ?>
												<select>
										</div>
									</div>
								</div>

								<div class="col-6">
									<div class="form-group row">
										<label class="col-md-4 col-lg-3 col-form-label text-muted ">Joint No</label>
										<div class="col-xl">
											<select type="text" class="form-control select2_multiple_joint" name="joint_no_filter[]" multiple>
												<option value=''>~ Choose ~</option>
												<?php foreach ($joint_no_list as $key => $value) { ?>
													<option value='<?php echo $value ?>' <?= (in_array($value, $joint_no) ? "selected" : null) ?>><?php echo $value ?></option>
												<?php } ?>
												<select>
										</div>
									</div>
								</div>



							</div>


							<div class="row">

								<div class="col-6">
									<div class="form-group row">
										<label class="col-md-4 col-lg-3 col-form-label text-muted ">Weld Map Number</label>
										<div class="col-xl">
											<select type="text" class="form-control select2_multiple_weldmap" name="drawing_wm_filter[]" multiple required>
												<option value=''>~ Choose ~</option>
												<?php foreach ($drawing_wm_list as $key => $value) { ?>
													<option value='<?php echo $value ?>' <?= (in_array($value, $drawing_wm) ? "selected" : null) ?>><?php echo $value ?></option>
												<?php } ?>
												<select>
										</div>
									</div>
								</div>

								<div class="col-6">
									<div class="form-group row">
										<label class="col-md-4 col-lg-3 col-form-label text-muted ">Status Surveyor</label>
										<div class="col-xl">
											<select type="text" class="form-control select2_multiple_weldmap" name="surveyor_status_filter[]" multiple required>
												<option value='not_update' <?= (in_array("not_update", @$post["surveyor_status_filter"]) ? "selected" : null) ?>>No Status Surveyor</option>
												<?php foreach ($surveyor_status as $key => $value) { ?>
													<option value='<?php echo $value["id"] ?>' <?= (in_array($value["id"], @$post["surveyor_status_filter"]) ? "selected" : null) ?>><?php echo $value["description"] ?></option>
												<?php } ?>
												<select>
										</div>
									</div>
								</div>

							</div>

							<div class="row">

								<div class="col-6">
									<div class="form-group row">
										<label class="col-md-4 col-lg-3 col-form-label text-muted ">Grid Row</label>
										<div class="col-xl">
											<select type="text" class="form-control select2" name="grid_row_filter" onchange='autofilter(this);'>
												<option value=''>~ Choose ~</option>
												<?php foreach ($grid_row_list as $key => $value) { ?>
													<option value='<?php echo $value ?>' <?= ($post["grid_row_filter"] == $value ? "selected" : null) ?>><?php echo $value ?></option>
												<?php } ?>
												<select>
										</div>
									</div>
								</div>

								<div class="col-6">
									<div class="form-group row">
										<label class="col-md-4 col-lg-3 col-form-label text-muted ">Grid Column</label>
										<div class="col-xl">
											<select type="text" class="form-control select2" name="grid_column_filter" onchange='autofilter(this);'>
												<option value=''>~ Choose ~</option>
												<?php foreach ($grid_column_list as $key => $value) { ?>
													<option value='<?php echo $value ?>' <?= ($post["grid_column_filter"] == $value ? "selected" : null) ?>><?php echo $value ?></option>
												<?php } ?>
												<select>
										</div>
									</div>
								</div>

							</div>

							<div class="row">
								<div class="col-12 text-right">
									<hr>
									<?php //if(!isset($post) OR empty($post)){ 
									?>
									<button id='button_search' class="mt-2 btn btn-sm btn-flat btn-info"><i class="fas fa-search"></i> Search</button>
									<?php //} 
									?>
									<button type="button" class="mt-2 btn btn-sm btn-flat btn-warning" onclick="reset_pages();"><i class="fas fa-sync-alt"></i> Reset</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<?php if (isset($post) && !empty($post)) { ?>

			<form action="<?= site_url('planning/process_update_fitup') ?>" method="post" id="form_submition_fu" onsubmit="if( _formConfirm_submitted == false ){ _formConfirm_submitted = true;return true }else{ alert('Please Wait, Server still busy, wait till process done, Thanks!'); return false;  }" enctype="multipart/form-data">


				<input type="hidden" name="wp_id" value="<?= @$joint_list[0]['workpack_id'] ?>">


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
												<th style="width: 95px !important;">Deck Elevation / Service Line</th>

												<th style="width: 95px !important;">Joint Class</th>
												<th style="width: 15px !important;">Dia/Size</th>
												<th style="width: 15px !important;">Sch</th>
												<th style="width: 15px !important;">Thk<br />(mm)</th>

												<th style="width: 15px !important;">Weld<br />Length<br />(mm)</th>
												<!-- <th style="width: 120px !important;">Fitter Code</th> -->
												<th style="width: 120px !important;">Tack Weld ID</th>
												<th style="width: 250px !important;">WPS</th>
												<th style="width: 200px !important;">Remarks</th>
												<th style="width: 200px !important;">Surveyor Status</th>
												<th style="width: 200px !important;">Evidence Of Progress</th>
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

													if (isset($status_piecemark[$value['pos_1']]['id_mis']) && isset($status_piecemark[$value['pos_1']]['id_mis'])) {

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
													} else {

														$status_data = 2; //red
														//echo "9";

													}
												}
												?>
												<tr>
													<td>
														<?php if (isset($post) && !empty($post)) { ?>
															<input type='hidden' name='id_joint[<?php echo $no; ?>]' value='<?php echo $value['id_joint']; ?>'>
															<input type="hidden" name="id_wp_save[<?= $no ?>]" value="<?= $value['workpack_id'] ?>">
															<input type='hidden' name='id_fitup[<?php echo $no; ?>]' value='<?php echo $value['id_fitup']; ?>'>
															<input type='checkbox' class="checkbox-big" name='submit_id[<?php echo $no; ?>]' onclick='open_disabled_form(this,"<?php echo $no; ?>","0")'>
															<input type='hidden' class='form-control' name='filter_check[<?php echo $no; ?>]' value='0'>
														<?php } else { ?>
															<span class='btn btn-danger'><i class="fas fa-times-circle"></i></span>
														<?php } ?>
													</td>

													<td><?php echo $value['drawing_wm'] ?> Rev.<?php echo $value['rev_wm'] ?></td>

													<td> <?php echo $value['joint_no'] ?> </td>

													<td><span class='badge'><?php echo $value['pos_1'] ?></span>
														<hr /><span class='badge'><?php echo $value['pos_2'] ?></span>
													</td>

													<td>
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
														} else {
															echo "<span class='badge badge-warning'>Not Ready in MTR Verification</span>";
														}
														?>
														<hr />
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
														} else {
															echo "<span class='badge badge-warning'>Not Ready in MTR Verification</span>";
														}
														?>
													</td>

													<td>
														<?php
														if (isset($status_piecemark[$value['pos_1']]['id_mis'])) {
															echo $warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['heat_or_series_no'];
														} else {
															echo "-";
														}
														?>
														<hr />
														<?php
														if (isset($status_piecemark[$value['pos_2']]['id_mis'])) {
															echo $warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['heat_or_series_no'];
														} else {
															echo "-";
														}
														?>
													</td>

													<td>
														<span class='badge'>
															<?php
															if (isset($status_piecemark[$value['pos_1']]['id_mis'])) {
																echo $material_grade[$status_piecemark[$value['pos_1']]['grade']]['material_grade'];
															} else {
																echo "-";
															}
															?>
														</span>
														<hr />
														<span class='badge'>
															<?php
															if (isset($status_piecemark[$value['pos_2']]['id_mis'])) {
																echo $material_grade[$status_piecemark[$value['pos_2']]['grade']]['material_grade'];
															} else {
																echo "-";
															}
															?>
														</span>
													</td>

													<td>
														<span class='badge'>
															<?php echo $show_deck_details[$value["deck_elevation"]]["name"] ?>
															<hr />
															Row : <?php echo $value["grid_row"] ?> Column : <?php echo $value["grid_column"] ?>
														</span>
													</td>

													<td class="ball" style="vertical-align: middle;text-align: center;">
														<?php echo @$class_list[$value["class"]] ?>
													</td>

													<td>
														<?php echo @$status_piecemark[$value['pos_1']]['diameter'] ?>
														<hr />
														<?php echo @$status_piecemark[$value['pos_2']]['diameter'] ?>
													</td>

													<td>
														<?php echo @$status_piecemark[$value['pos_1']]['sch'] ?>
														<hr />
														<?php echo @$status_piecemark[$value['pos_2']]['sch'] ?>
													</td>

													<td>
														<?php echo @$status_piecemark[$value['pos_1']]['thickness'] ?>
														<hr />
														<?php echo @$status_piecemark[$value['pos_2']]['thickness'] ?>
													</td>

													<td><?php echo $value['weld_length'] ?></td>

													<!-- <td>

														<?php
														$fitter_id_display = explode(";", $value['fitter_id']);

														?>
														<select class='select2_multiple_fitter' name='fitter_id[<?php echo $no; ?>][]' multiple required>
															<?php
															foreach ($fitter_id_display as $key => $val_fitter) {
																echo "<option value='" . $val_fitter . "' selected>" . $fitter_code_arr[$val_fitter] . "</option>";
															}
															?>
														</select>
													</td> -->

													<td>

														<?php
														$tack_weld_id_display = explode(";", $value['tack_weld_id']);
														?>

														<select class='select2_multiple_welder' name='tack_weld_id[<?php echo $no; ?>][]' multiple required>
															<?php
															foreach ($tack_weld_id_display as $key => $val_tack_weld_id) {
																echo "<option value='" . $val_tack_weld_id . "' selected>" . $welder_code_arr[$val_tack_weld_id] . "</option>";
															}
															?>
														</select>


													<td>
														<?php $wps_display = explode(";", $value['wps_no']); ?>
														<select class='select2_multiple_wps' name='wps[<?php echo $no; ?>][]' multiple required>
															<?php
															foreach ($wps_display as $key => $wps_id) {
																echo "<option value='" . $wps_id . "' selected>" . $wps_code_arr[$wps_id] . "</option>";
															}
															?>
														</select>

													</td>
													<td><textarea name='remarks[<?php echo $no; ?>]' placeholder="---"><?php echo $value["remarks"]; ?></textarea></td>
													<td>
														<?php $exlode_status_surveyor = explode(";", $value['status_surveyor']); ?>
														<select name='status_surveyor[<?php echo $no; ?>][]' class='form-control select2_multiple_status_surveyor' required multiple>
															<option value=''>~ Choose ~</option>
															<?php foreach ($surveyor_status as $key => $srvyr_status) { ?>
																<option value='<?php echo $srvyr_status["id"] ?>' <?= in_array($srvyr_status["id"], $exlode_status_surveyor) ? "selected" : null ?>><?php echo $srvyr_status["description"] ?></option>
															<?php } ?>
														</select>
													</td>
													<td>
														<?php if (isset($image_fu[$value['id_joint']])) { ?>
															<!-- <span class='btn btn-primary' onclick="show_image(this, '<?= $image_fu[$value['id_joint']] ?>', 'surveyor', '<?= $value['drawing_wm'] ?>', '<?= $value['joint_no'] ?>',)"><i class="fas fa-image"></i></span>  -->
															<?php
															$enc_redline = strtr($this->encryption->encrypt($image_fu[$value['id_joint']]), '+=/', '.-~');
															$enc_path   = strtr($this->encryption->encrypt('/PCMS/mobile/pcms_v2_mobile/pcms_v2_photo/'), '+=/', '.-~');
															?>
															<a target='_blank' href='<?= site_url('irn/open_file/' . $enc_redline . '/' . $enc_path) ?>'><span class='btn btn-primary'><i class="fas fa-images"></i></span></a>
														<?php } else { ?>
															<img src="<?php echo base_url(); ?>/img/img_not_avai.png" style='width: 30px;'>
														<?php } ?>
														<br />
														<span class='badge'><?= (isset($user_list[$value['surveyor_creator']]) ? "Submit By : " . $user_list[$value['surveyor_creator']] : $user_list[$value['requestor']]);  ?></span><br />
														<span class='badge'><?= (isset($value['surveyor_created_date']) ? "Submit Date : " . $value['surveyor_created_date'] : $value['date_request']); ?></span> <br />
														<br />
														<?php
														if (isset($value['status_surveyor'])) {
															$exlode_status_surveyor = explode(";", $value['status_surveyor']);
															foreach ($exlode_status_surveyor as $valx) {
																if (isset($surveyor_status_show[$valx])) {
																	echo "<span class='badge'>" . $surveyor_status_show[$valx]['description'] . "</span><br/>";
																}
															}
														}
														?>
														<span class='badge'><?= (isset($value['status_surveyor']) ? "Update By : " .   $user_list[$value['last_surveyor_update_by']] : "-"); ?></span><br />
														<span class='badge'><?= (isset($value['status_surveyor']) ? "Update date : " . $value['last_surveyor_update_date'] : "-"); ?></span>
														<br /> <br />
														<input type="file" name="attachment_surveyor_fu[<?php echo $no; ?>]" <?php if (!isset($image_fu[$value['id_joint']])) { ?>required<?php } ?>>
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
										<button type="submit" id="btn_submit" class="btn btn-success" disabled>
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

	<?php } ?>

	<?php if ($type == "vs") { ?>


		<div class="row">
			<div class="col">
				<div class="card shadow my-3 rounded-0">
					<div class="card-header">
						<h6 class="m-0">Visual | Filter Joint for Submission</h6>
					</div>
					<div class="card-body bg-white overflow-auto">
						<form action="" method="POST" id='form-filter'>

							<div class="row">

								<div class="col-6">
									<div class="form-group row">
										<label class="col-md-4 col-lg-3 col-form-label text-muted ">Project ID</label>
										<div class="col-xl">
											<select class="form-control" name="project" required>
												<?php foreach ($project_list as $key => $value) : ?>
													<?php if (in_array($value['id'], $this->user_cookie[13])) : ?>
														<option value="<?php echo $value['id'] ?>" <?php echo (@$post['project'] == $value['id'] ? 'selected' : ($this->user_cookie[10] == $value['id'] ? 'selected' : '')) ?>><?php echo $value['project_name'] ?></option>
													<?php endif; ?>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>

								<div class="col-6">
									<div class="form-group row">
										<label class="col-md-4 col-lg-3 col-form-label text-muted ">Discipline</label>
										<div class="col-xl">
											<select class="form-control" name="discipline">
												<option value="">---</option>
												<?php foreach ($discipline_list as $key => $value) : ?>
													<option value="<?php echo $value['id'] ?>" <?php echo (@$post['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>

							</div>

							<div class="row">

								<div class="col-6">
									<div class="form-group row">
										<label class="col-md-4 col-lg-3 col-form-label text-muted ">Deck Elevation / Service Line</label>
										<div class="col-xl">
											<select type="text" class="form-control select2" name="deck_elevation">
												<option value=''>~ Choose ~</option>
												<?php foreach ($deck_list as $key => $value) { ?>
													<option value='<?php echo $value["id"] ?>' <?= ($post["deck_elevation"] == $value["id"] ? "selected" : null) ?>><?php echo $value["name"] ?></option>
												<?php } ?>
												<select>
										</div>
									</div>
								</div>

								<div class="col-6">
									<div class="form-group row">
										<label class="col-md-4 col-lg-3 col-form-label text-muted ">Joint No</label>
										<div class="col-xl">
											<select type="text" class="form-control select2_multiple_joint" name="joint_no_filter[]" multiple>
												<option value=''>~ Choose ~</option>
												<?php foreach ($joint_no_list as $key => $value) { ?>
													<option value='<?php echo $value ?>' <?= (in_array($value, $joint_no) ? "selected" : null) ?>><?php echo $value ?></option>
												<?php } ?>
												<select>
										</div>
									</div>
								</div>



							</div>


							<div class="row">

								<div class="col-6">
									<div class="form-group row">
										<label class="col-md-4 col-lg-3 col-form-label text-muted ">Weld Map Number</label>
										<div class="col-xl">
											<select type="text" class="form-control select2_multiple_weldmap" name="drawing_wm_filter[]" multiple required>
												<option value=''>~ Choose ~</option>
												<?php foreach ($drawing_wm_list as $key => $value) { ?>
													<option value='<?php echo $value ?>' <?= (in_array($value, $drawing_wm) ? "selected" : null) ?>><?php echo $value ?></option>
												<?php } ?>
												<select>
										</div>
									</div>
								</div>

								<div class="col-6">
									<div class="form-group row">
										<label class="col-md-4 col-lg-3 col-form-label text-muted ">Status Surveyor</label>
										<div class="col-xl">
											<select type="text" class="form-control select2_multiple_weldmap" name="surveyor_status_filter[]" multiple required>
												<option value='not_update' <?= (in_array("not_update", @$post["surveyor_status_filter"]) ? "selected" : null) ?>>No Status Surveyor</option>
												<?php foreach ($surveyor_status as $key => $value) { ?>
													<option value='<?php echo $value["id"] ?>' <?= (in_array($value["id"], @$post["surveyor_status_filter"]) ? "selected" : null) ?>><?php echo $value["description"] ?></option>
												<?php } ?>
												<select>
										</div>
									</div>
								</div>

							</div>

							<div class="row">

								<div class="col-6">
									<div class="form-group row">
										<label class="col-md-4 col-lg-3 col-form-label text-muted ">Grid Row</label>
										<div class="col-xl">
											<select type="text" class="form-control select2" name="grid_row_filter" onchange='autofilter(this);'>
												<option value=''>~ Choose ~</option>
												<?php foreach ($grid_row_list as $key => $value) { ?>
													<option value='<?php echo $value ?>' <?= ($post["grid_row_filter"] == $value ? "selected" : null) ?>><?php echo $value ?></option>
												<?php } ?>
												<select>
										</div>
									</div>
								</div>

								<div class="col-6">
									<div class="form-group row">
										<label class="col-md-4 col-lg-3 col-form-label text-muted ">Grid Column</label>
										<div class="col-xl">
											<select type="text" class="form-control select2" name="grid_column_filter" onchange='autofilter(this);'>
												<option value=''>~ Choose ~</option>
												<?php foreach ($grid_column_list as $key => $value) { ?>
													<option value='<?php echo $value ?>' <?= ($post["grid_column_filter"] == $value ? "selected" : null) ?>><?php echo $value ?></option>
												<?php } ?>
												<select>
										</div>
									</div>
								</div>

							</div>

							<div class="row">
								<div class="col-12 text-right">
									<hr>
									<?php //if(!isset($post) OR empty($post)){ 
									?>
									<button id='button_search' class="mt-2 btn btn-sm btn-flat btn-info"><i class="fas fa-search"></i> Search</button>
									<?php //} 
									?>
									<button type="button" class="mt-2 btn btn-sm btn-flat btn-warning" onclick="reset_pages();"><i class="fas fa-sync-alt"></i> Reset</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<?php if (isset($post) && !empty($post)) { ?>

			<form action="<?= site_url('planning/process_update_visual_surveyor') ?>" method="post" id="form_submition_vs" onsubmit="if( _formConfirm_submitted == false ){ _formConfirm_submitted_vs = true;return true }else{ alert('Please Wait, Server still busy, wait till process done, Thanks!'); return false;  }" enctype="multipart/form-data">


				<input type="hidden" name="wp_id_vs" value="<?= @$joint_list_visual[0]['workpack_id'] ?>">

				<input type="hidden" name="drawing_type_save" value="<?= @$joint_list[0]['drawing_type_template'] ?>">


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
											<th rowspan="2">Deck Elevation / Service Line</th>
											<th rowspan="1" colspan="2" style='width:200px !important;max-width: 200px !important;'>Weld Process</th>
											<th rowspan="1" colspan="2" style='width:300px !important;max-width: 300px !important;'>Welder ID</th>
											<th rowspan="1" colspan="2" style='width:300px !important;max-width: 300px !important;'>WPS</th>
											<th rowspan="2">Dia (Inch)</th>
											<th rowspan="2">Thk (mm)</th>
											<!-- <th rowspan="2">Location</th> -->
											<th rowspan="2">Weld Length (mm)</th>
											<th rowspan="1" colspan="2" style='width:300px !important;max-width: 300px !important;'>Weld Date</th>
											<th rowspan="2">Remarks</th>
											<th rowspan="2" style="width: 200px !important;">Surveyor Status</th>

											<th rowspan="2" style="width: 200px !important;">Evidence Of Progress</th>

										</tr>
										<tr>
											<th style='width:100px !important;max-width: 100px !important;'>R/H</th>
											<th style='width:100px !important;max-width: 100px !important;'>F/C</th>
											<th style='width:150px !important;max-width: 150px !important;'>R/H</th>
											<th style='width:150px !important;max-width: 150px !important;'>F/C</th>
											<th style='width:150px !important;max-width: 150px !important;'>R/H</th>
											<th style='width:150px !important;max-width: 150px !important;'>F/C</th>
											<th style='width:150px !important;max-width: 150px !important;'>Date</th>
											<th style='width:150px !important;max-width: 150px !important;'>Time</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 0;
										$total_progress = 0;
										foreach ($joint_list_visual as $key => $value) : ?>

											<?php
											$current_date           = new DateTime(date("Y-m-d H:i:s"));
											$fitup_approve_datetime = new DateTime($value["fitup_time_inspect"]);
											$diff = $fitup_approve_datetime->diff($current_date);
											$hours  = round($diff->s / 3600 + $diff->i / 60 + $diff->h + $diff->days * 24, 2);
											?>

											<tr>

												<td>
													<?php if (isset($post) && !empty($post)) { ?>
														<input type='hidden' name='id_joint[<?php echo $no; ?>]' value='<?php echo $value['id_jn_temp']; ?>'>
														<input type='hidden' name='id_visual[<?php echo $no; ?>]' value='<?php echo $value['id_visual']; ?>'>
														<input type='checkbox' class="checkbox-big" name='submit_id[<?php echo $no; ?>]' onclick='enable_edit("<?= $no ?>", this)'>
														<input type='hidden' name='filter_check[<?php echo $no; ?>]' value='0'>
														<input type="hidden" name="id_wp_save[<?= $no ?>]" value="<?= $value['id_wp_main'] ?>">
													<?php } else { ?>
														<span class='btn btn-danger'><i class="fas fa-times-circle"></i></span>
													<?php } ?>
												</td>

												<td style='width:300px !important;max-width: 300px !important;'> <?php echo $value['drawing_wm'] ?> Rev.<?php echo $value['rev_wm'] ?> </td>
												<td><?php echo $value['joint_no'] ?></td>
												<td><?php echo $weld_type_list[$value['weld_type']]['weld_type'] ?></td>
												<td>
													<!-- <input class="will_enable<?= $no ?>" type="text" name="cons_lot_no[<?= $no ?>]" value="<?= $value['cons_lot_no'] ?>" style='max-width: 100px !important;'> -->
													<select name='cons_lot_no[<?= $no ?>]' class='form-control will_enable<?= $no ?>'>
													<option value=''>~ Choose ~</option>
													<?php foreach ($cons_lot_list as $cons_lot) { ?>
														<option value='<?= $cons_lot["batch_lot_no"] ?>' <?= $cons_lot["batch_lot_no"] == $value['cons_lot_no'] ? "selected" : null ?>><?= $cons_lot["batch_lot_no"] ?></option>
													<?php } ?>
												</select>
												</td>
												<td>
													<span class='badge'>
														<?php echo $show_deck_details[$value["deck_elevation"]]["name"] ?>
														<hr />
														Row : <?php echo $value["grid_row"] ?> Column : <?php echo $value["grid_column"] ?>
													</span>
												</td>

												<td>
													<?php if ($weld_type_list[$value['weld_type']]['weld_type_code'] != 'FW') { ?>
														<select class="select2 will_enable<?= $no ?> weld_process_rh_<?= $no ?>" id='weld_process_rh<?= $no ?>' name="weld_process_rh[<?= $no ?>][]" multiple onchange="remove_disabledwelder('rh',<?= $no ?>)">
															<option value="GTAW" <?= $value['process_gtaw_rh'] == 1 ? 'selected' : '' ?>>GTAW</option>
															<option value="GMAW" <?= $value['process_gmaw_rh'] == 1 ? 'selected' : '' ?>>GMAW</option>
															<option value="SMAW" <?= $value['process_smaw_rh'] == 1 ? 'selected' : '' ?>>SMAW</option>
															<option value="FCAW" <?= $value['process_fcaw_rh'] == 1 ? 'selected' : '' ?>>FCAW</option>
															<option value="SAW" <?= $value['process_saw_rh'] == 1 ? 'selected' : '' ?>>SAW</option>
														</select>
													<?php  } else { ?>
														<input type="hidden" class='form-control' name="weld_process_rh[<?= $no ?>][]" value='<?php echo null; ?>' readonly>
													<?php  } ?>
												</td>

												<td>
													<select class="select2 will_enable<?= $no ?> weld_process_fc_<?= $no ?>" id='weld_process_fc<?= $no ?>' name="weld_process_fc[<?= $no ?>][]" multiple onchange="remove_disabledwelder('fc',<?= $no ?>)">
														<option value="GTAW" <?= $value['process_gtaw_fc'] == 1 ? 'selected' : '' ?>>GTAW</option>
														<option value="GMAW" <?= $value['process_gmaw_fc'] == 1 ? 'selected' : '' ?>>GMAW</option>
														<option value="SMAW" <?= $value['process_smaw_fc'] == 1 ? 'selected' : '' ?>>SMAW</option>
														<option value="FCAW" <?= $value['process_fcaw_fc'] == 1 ? 'selected' : '' ?>>FCAW</option>
														<option value="SAW" <?= $value['process_saw_fc'] == 1 ? 'selected' : '' ?>>SAW</option>
													</select>
												</td>
												<td>
													<?php if ($weld_type_list[$value['weld_type']]['weld_type_code'] != 'FW') { ?>
														<div id='table_rh<?= $no; ?>'>
															<?php $arr_welder_rh[$no] = explode(';', $value['welder_ref_rh']) ?>
															<?php foreach ($arr_welder_rh[$no] as $key_welder_rh => $value_welder_rh) { ?>
																<div class="input-group mb-3 form-check form-check-inline">
																	<input type="text" class="form-control  auto_rh_999 will_enable_after_processrh<?= $no; ?>" onfocus="welder_autocomplete_rh('999', '<?= $no; ?>')" name="welder_rh[<?= $no; ?>][]" value='<?= $welders[$value_welder_rh]["welder_code"] ?>'>
																	<span class="btn btn-primary will_enable<?= $no; ?> disabled-effect" onclick="add_rh('<?= $no; ?>')" disabled>
																		<i class="fas fa-plus"></i>
																	</span>
																</div>
															<?php } ?>
															<script type="text/javascript">
																var no = 0;

																function add_rh(key) {
																	no++;
																	var html = '<div class="input-group mb-3 form-check form-check-inline ctq_row_rh_' + no + '">';
																	html += '<input type="text" placeholder="Welder Tag" class="auto_rh_' + no + ' form-control will_enable' + key + '" name="welder_rh[' + key + '][]" value="" onfocus="welder_autocomplete_rh(' + no + ', ' + key + ')">'
																	html += '<span class="btn btn-danger" onclick="delete_rh(' + no + ')"><i class="fas fa-times"></i></span>'
																	html += '</div>'
																	$('#table_rh' + key).append(html)
																}

																function delete_rh(key) {
																	$('.ctq_row_rh_' + key).remove()
																}

																function welder_autocomplete_rh(no, keyes) {
																	var link_welder_rh = $('#weld_process_rh' + keyes).val()
																	$('.auto_rh_' + no).autocomplete({
																		source: function(request, response) {
																			$.post('<?php echo base_url(); ?>ndt/welder_autocomplete', {
																				term: request.term,
																				process: link_welder_rh
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

														<?php $arr_welder_fc[$no] = explode(';', $value['welder_ref_fc']) ?>
														<?php foreach ($arr_welder_fc[$no] as $key_welder_fc => $value_welder_fc) { ?>
															<div class="input-group mb-3 form-check form-check-inline">
																<input type="text" class="form-control  auto_fc_999 will_enable_after_processfc<?= $no; ?>" onfocus="welder_autocomplete_fc('999', '<?= $no; ?>')" name="welder_fc[<?= $no; ?>][]" value='<?= $welders[$value_welder_fc]["welder_code"] ?>'>
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
																html += '<input type="text" placeholder="Welder Tag" class="auto_fc_' + no_fc + ' form-control will_enable' + key + '" name="welder_fc[' + key + '][]" value="" onfocus="welder_autocomplete_fc(' + no_fc + ', ' + key + ')">'
																html += '<span class="btn btn-danger" onclick="delete_fc(' + no_fc + ')"><i class="fas fa-times"></i></span>'
																html += '</div>'
																$('#table_fc' + key).append(html)
															}

															function delete_fc(key) {
																$('.ctq_row_fc_' + key).remove()
															}

															function welder_autocomplete_fc(no, keyes) {
																var link_welder_fc = $('#weld_process_fc' + keyes).val()
																$('.auto_fc_' + no).autocomplete({
																	source: function(request, response) {
																		$.post('<?php echo base_url(); ?>ndt/welder_autocomplete', {
																			term: request.term,
																			process: link_welder_fc
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
												<td>
													<?php if ($weld_type_list[$value['weld_type']]['weld_type_code'] != 'FW') { ?>
														<div id='wps_rh<?= $no; ?>'>
															<?php $arr_wps_rh[$no] = explode(';', $value['wps_no_rh']) ?>
															<?php foreach ($arr_wps_rh[$no] as $no_wps_rh => $value_wps_rh) { ?>
																<div class="input-group mb-3 form-check form-check-inline">
																	<input type="text" class="form-control auto_wps_rh_999 will_enable_after_processrh<?= $no; ?>" onfocus="wps_autocomplete_rh('999', '<?= $no; ?>')" name="wps_rh[<?= $no ?>][]" value='<?= $wps_desc[$value_wps_rh]["wps_no"] ?>'>
																	<span class="btn btn-primary will_enable<?= $no ?> disabled-effect" onclick="add_wps_rh('<?= $no ?>')" disabled>
																		<i class="fas fa-plus"></i>
																	</span>
																</div>
															<?php } ?>
															<script type="text/javascript">
																var no_rh = 0;

																function add_wps_rh(key) {
																	no_rh++;
																	var html = '<div class="input-group mb-3 form-check form-check-inline wps_row_rh_' + no_rh + '">';
																	html += '<input type="text" placeholder="WPS RH" class="auto_wps_rh_' + no_rh + ' form-control will_enable' + key + '" name="wps_rh[' + key + '][]" value="" onfocus="wps_autocomplete_rh(' + no_rh + ', ' + key + ')">'
																	html += '<span class="btn btn-danger" onclick="delete_wps_rh(' + no_rh + ')"><i class="fas fa-times"></i></span>'
																	html += '</div>'
																	$('#wps_rh' + key).append(html)
																}

																function delete_wps_rh(key) {
																	$('.wps_row_rh_' + key).remove()
																}


																function wps_autocomplete_rh(no, keyes) {

																	var linkwps = $('.weld_process_rh_' + keyes).val()
																	console.log('linkwps')
																	console.log(linkwps)
																	linkwps = linkwps.join('/')

																	$('.auto_wps_rh_' + no).autocomplete({
																		source: function(request, response) {
																			$.post('<?php echo base_url(); ?>visual/wps_autocomplete/', {
																				term: request.term,
																				linkwps: linkwps
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
														<input type="hidden" class='form-control' name="wps_rh[<?= $no ?>][]" value='<?php echo null; ?>' readonly>
													<?php  } ?>
												</td>
												<td>
													<div id='wps_fc<?= $no; ?>'>
														<?php $arr_wps_fc[$no] = explode(';', $value['wps_no_fc']) ?>
														<?php foreach ($arr_wps_fc[$no] as $no_wps_fc => $value_wps_fc) { ?>
															<div class="input-group mb-3 form-check form-check-inline">
																<input type="text" class="form-control auto_wps_fc_999 will_enable_after_processfc<?= $no; ?>" onfocus="wps_autocomplete_fc('999', '<?= $no; ?>')" name="wps_fc[<?= $no ?>][]" value='<?= $wps_desc[$value_wps_fc]["wps_no"] ?>'>
																<span class="btn btn-primary will_enable<?= $no ?> disabled-effect" onclick="add_wps_fc('<?= $no ?>')" disabled>
																	<i class="fas fa-plus"></i>
																</span>
															</div>
														<?php } ?>
														<script type="text/javascript">
															var no_fc = 0;

															function add_wps_fc(key) {
																no_fc++;
																var html = '<div class="input-group mb-3 form-check form-check-inline wps_row_fc_' + no_fc + '">';
																html += '<input type="text" placeholder="WPS FC" class="auto_wps_fc_' + no_fc + ' form-control will_enable' + key + '" name="wps_fc[' + key + '][]" value="" onfocus="wps_autocomplete_fc(' + no_fc + ', ' + key + ')">'
																html += '<span class="btn btn-danger" onclick="delete_wps_fc(' + no_fc + ')"><i class="fas fa-times"></i></span>'
																html += '</div>'
																$('#wps_fc' + key).append(html)
															}

															function delete_wps_fc(key) {
																$('.wps_row_fc_' + key).remove()
															}


															function wps_autocomplete_fc(no, keyes) {

																var linkwps = $('.weld_process_fc_' + keyes).val()
																console.log('linkwps')
																console.log(linkwps)
																linkwps = linkwps.join('/')

																$('.auto_wps_fc_' + no).autocomplete({
																	source: function(request, response) {
																		$.post('<?php echo base_url(); ?>visual/wps_autocomplete/', {
																			term: request.term,
																			linkwps: linkwps
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

												<td>
													<?php if (!isset($value['status_inspection'])) { ?>
														<input disabled class="form-control will_enable<?= $no ?>" type="number" name="weld_length[<?= $no ?>]" value="<?= $value['weld_length'] ?>">
													<?php } else { ?>
														<?php echo $value['weld_length']; ?>
													<?php } ?>
												</td>

												<td>
													<input class="form-control will_enable<?= $no ?>" type="date" name="weld_date[<?= $no ?>]" value='<?php echo date("Y-m-d", strtotime($value['weld_datetime'])); ?>' min='<?= date("Y-m-d", strtotime($value["fitup_inspection_datetime"])) ?>' max='<?= date("Y-m-d") ?>'>
												</td>
												<td>
													<input class="form-control will_enable<?= $no ?>" type="time" name="weld_time[<?= $no ?>]" value='<?php echo date("H:i:s", strtotime($value['weld_datetime'])); ?>'>
												</td>

												<td>
													<textarea class="form-control" type="text" name="inspection_remarks[<?= $no ?>]"><?= $value['remarks'] ?></textarea>
												</td>
												<td>
													<?php $exlode_status_surveyor = explode(";", $value['status_surveyor']); ?>
													<select name='status_surveyor[<?php echo $no; ?>][]' class='form-control select2_multiple_status_surveyor_vis' required multiple>
														<option value=''>~ Choose ~</option>
														<?php foreach ($surveyor_status as $key => $srvyr_status) { ?>
															<option value='<?php echo $srvyr_status["id"] ?>' <?= in_array($srvyr_status["id"], $exlode_status_surveyor) ? "selected" : null ?>><?php echo $srvyr_status["description"] ?></option>
														<?php } ?>
													</select>
												</td>
												<td>
													<?php if (isset($value["evidence_vt"])) { ?>
														<!-- <span class='btn btn-primary' onclick="show_image(this, '<?= $value['evidence_vt'] ?>', 'surveyor', '<?= $value['drawing_wm'] ?>', '<?= $value['joint_no'] ?>',)"><i class="fas fa-image"></i></span>  -->
														<?php
														$enc_redline = strtr($this->encryption->encrypt($value['evidence_vt']), '+=/', '.-~');
														$enc_path   = strtr($this->encryption->encrypt('/PCMS/mobile/pcms_v2_mobile/pcms_v2_photo/'), '+=/', '.-~');
														?>
														<a target='_blank' href='<?= site_url('irn/open_file/' . $enc_redline . '/' . $enc_path) ?>'><span class='btn btn-primary'><i class="fas fa-images"></i></span></a>
													<?php } else { ?>
														<img src="<?php echo base_url(); ?>/img/img_not_avai.png" style='width: 30px;'>
													<?php } ?>
													<br />
													<span class='badge'><?= (isset($user_list[$value['surveyor_creator']]) ? "Submit By : " . $user_list[$value['surveyor_creator']] : $user_list[$value['requestor']]);  ?></span><br />
													<span class='badge'><?= (isset($value['surveyor_created_date']) ? "Submit Date : " . $value['surveyor_created_date'] : $value['date_request']); ?></span> <br />
													<br />

													<?php
													if (isset($value['status_surveyor'])) {
														$exlode_status_surveyor = explode(";", $value['status_surveyor']);
														foreach ($exlode_status_surveyor as $valx) {
															if (isset($surveyor_status_show[$valx])) {
																echo "<span class='badge'>" . $surveyor_status_show[$valx]["description"] . "</span><br/>";
															}
														}
													}
													?>
													<span class='badge'><?= (isset($value['status_surveyor']) ? "Update By : " .   $user_list[$value['last_surveyor_update_by']] : "-"); ?></span><br />
													<span class='badge'><?= (isset($value['status_surveyor']) ? "Update date : " . $value['last_surveyor_update_date'] :  "-"); ?></span>
													<br /> <br />

													<input type="file" name="attachment_surveyor_vs[<?php echo $no; ?>]" <?php if (!isset($value["evidence_vt"])) { ?> required <?php } ?> class='will_enable'>

												</td>

											</tr>
										<?php if ($value["progress_vt"] >= 100) {
												$total_progress++;
											}
											$no++;
										endforeach; ?>
									</tbody>
								</table>

								<?php if ($total_progress > 0) { ?>
									<br>
									<br>
									<div class="text-right">
										<button type="submit" id="btn_submit" class="btn btn-success"><i class="fas fa-check"></i> Submit</button>
									</div>
								<?php } ?>

							</div>

						</div>
					</div>
				</div>

			</form>

		<?php } ?>

	<?php } ?>

</div>
</div>
<script>
	function autofilter() {
		$('#form-filter').submit();
	}

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
						location.reload();
						swal.close();
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


			if ($(val).prop("checked") == true) {
				$('input[name="filter_check[' + no + ']"]').val(1);
			} else {
				$('input[name="filter_check[' + no + ']"]').val(0);
			}


		});



	}
</script>

<script type="text/javascript">
	$(document).ready(function() {




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

		$(".select2_multiple_weldmap").select2({
			tokenSeparators: [',', ' '],
		})

		$(".select2_multiple_status_surveyor").select2({
			tokenSeparators: [',', ' '],
		})

		$(".select2_multiple_status_surveyor_vis").select2({
			tokenSeparators: [',', ' '],
		})

		$(".select2_multiple_joint").select2({
			tokenSeparators: [',', ' '],
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
</script>

<script type="text/javascript">
	$("select[name=location]").chained("select[name=area]");
</script>