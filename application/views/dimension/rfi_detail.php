<div id="content" class="container-fluid">

	<form method="POST" action="<?= base_url('dimension/update_rfi_process') ?>" enctype="multipart/form-data">
		<input type="hidden" name="id_dc" class="form-control" value="<?= $dc['id'] ?>" required>
		<input type="hidden" name="id_dc_atc" class="form-control" value="<?= $dc_atc['id'] ?>" required>
		<input type="hidden" name="id_rfi" class="form-control" value="<?= $rfi['id'] ?>" required>

		<div class="col-12">
			<div class="card shadow my-3 rounded-0">
				<div class="card-header">
					<h6 class="m-0">RFI - INSPECTION NOTIFICATION</h6>
				</div>
				<div class="card-body bg-white">
					<div class="col-12 <?= $class ?>">
						<div class="form-group">
							<div class="row">

								<div class="col-md-6">
									<div class="form-group row">
										<label for="" class="col-xl-3 col-form-label text-muted font-weight-bold">RFI No.</label>
										<div class="col-xl">
											<input type="text" name="rfi_no" class="form-control" value="<?= $rfi['rfi_no'] ?>" required>
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group row">
										<label for="" class="col-xl-3 col-form-label text-muted font-weight-bold">Drawing No.</label>
										<div class="col-xl">
											<input type="text" name="drawing_no" class="form-control autocomplete_drawing" value="<?= $rfi['drawing_no'] ?>" readonly>
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group row">
										<label for="" class="col-xl-3 col-form-label text-muted font-weight-bold">Project</label>
										<div class="col-xl">
											<select id="project_id" name="project_id" class="select2" style="width: 100%" required>
												<option value="">---</option>
												<?php foreach ($project_list as $key => $value) : ?>
													<option value="<?= $value['id'] ?>" <?= $value['id'] == $rfi['project'] ? 'selected' : '' ?>><?= $value['project_name'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group row">
										<label for="" class="col-xl-3 col-form-label text-muted font-weight-bold">Discipline</label>
										<div class="col-xl">
											<select name="discipline" class="select2" style="width: 100%" required>
												<option value="">---</option>
												<?php foreach ($discipline_list as $key => $value) : ?>
													<option value="<?= $value['id'] ?>" <?= $value['id'] == $rfi['discipline'] ? 'selected' : '' ?>><?= $value['discipline_name'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group row">
										<label class="col-xl-3 col-form-label text-muted font-weight-bold">Module</label>
										<div class="col-xl">
											<select class="select2" style="width: 100%" name="module" required>
												<option value="">---</option>
												<?php foreach ($module_list as $key => $value) : ?>
													<option value="<?php echo $value['mod_id'] ?>" <?= $value['mod_id'] == $rfi['module'] ? 'selected' : '' ?> data-chained="<?php echo $value['project_id'] ?>"><?php echo $value['mod_desc'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group row">
										<label class="col-xl-3 col-form-label text-muted font-weight-bold">Type Of Module</label>
										<div class="col-xl">
											<select class="select2" style="width: 100%" name="type_of_module" required>
												<option value="">---</option>
												<?php foreach ($type_of_module_list as $key => $value) : ?>
													<option value="<?php echo $value['id'] ?>" <?= $value['id'] == $rfi['type_of_module'] ? 'selected' : '' ?>><?php echo $value['code'] . " - " . $value['name'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group row">
										<label class="col-xl-3 col-form-label text-muted font-weight-bold">Deck Elevation / Service Line</label>
										<div class="col-xl">
											<select class="select2" style="width: 100%" name="deck_elevation" required>
												<option value="">---</option>
												<?php foreach ($deck_elevation_list as $key => $value) : ?>
													<option value="<?php echo $value['id'] ?>" <?= $value['id'] == $rfi['deck_elevation'] ? 'selected' : '' ?>><?php echo $value['code'] . " - " . $value['name'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>

								<div class="col-md-6 mt-2">
									<div class="form-group row">
										<label for="" class="col-xl-3 col-form-label text-muted font-weight-bold">Company</label>
										<div class="col-xl">
											<select name="company" class="select2" style="width: 100%" required>
												<option value="">---</option>
												<?php foreach ($company_list as $key => $value) : ?>
													<option value="<?= $value['company_name'] ?>"  <?= $value['company_name'] == $rfi['company_id'] ? 'selected' : '' ?>><?= $value['company_name'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group row">
										<label for="" class="col-xl-3 col-form-label text-muted font-weight-bold">Report No.</label>
										<div class="col-xl">
											<input type="text" name="report_no" class="form-control" value="<?= $dc_atc['report_number'] ?>" required>
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group row">
										<label for="" class="col-xl-3 col-form-label text-muted font-weight-bold">Status Report</label>
										<div class="col-xl">
											<select name='status_report' class='form-control' required>
												<option value=''>---</option>
												<option value='1' <?= '1' == $dc_atc['dc_status'] ? 'selected' : '' ?>>Before Welding</option>
												<option value='2' <?= '2' == $dc_atc['dc_status'] ? 'selected' : '' ?>>After Welding</option>
												<option value='3' <?= '3' == $dc_atc['dc_status'] ? 'selected' : '' ?>>Final Inspection</option>
											</select>
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group row">
										<label for="" class="col-xl-3 col-form-label text-muted font-weight-bold">Report Attachment</label>
										<div class="col-xl">
											<div class="custom-file">
												<input type="file" name="attachment" class="custom-file-input">
												<label class="custom-file-label">Choose file</label>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group row">
										<label for="" class="col-xl-3 col-form-label text-muted">Remarks</label>
										<div class="col-xl">
											<input type="text" name="remarks" class="form-control" value="<?= $dc_atc['remarks'] ?>">
										</div>
									</div>
								</div>
								
								<div class="col-md-12">
									<hr>
								</div>

								<div class="col-md-6 mt-2">
									<div class="form-group row">
										<label for="" class="col-xl-3 col-form-label text-muted">Inspector Name</label>
										<div class="col-xl">
											<select name="inspector_id" class="select2" style="width: 100%">
												<option value="">---</option>
												<?php foreach ($user_list as $key => $value) : ?>
														<option value="<?= $value['id_user'] ?>" <?= $value['id_user'] == $rfi['inspector_id'] ? 'selected' : '' ?>><?= $value['full_name'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group row">
										<label for="" class="col-xl-3 col-form-label text-muted">Submitted Date</label>
										<div class="col-xl">
											<input type="date" name="submitted_date" class="form-control" value="<?= date("Y-m-d", strtotime($rfi['submitted_date'])) ?>">
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group row">
										<label for="" class="col-xl-3 col-form-label text-muted">Inspect Date from</label>
										<div class="col-xl">
											<input type="date" name="inspection_date" class="form-control" value="<?= $rfi['inspection_date'] ? date("Y-m-d", strtotime($rfi['inspection_date'])) : '' ?>">
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group row">
										<label for="" class="col-xl-3 col-form-label text-muted">Inspect Date to</label>
										<div class="col-xl">
											<input type="date" name="inspection_date_to" class="form-control" value="<?= $rfi['inspection_date_to'] ? date("Y-m-d", strtotime($rfi['inspection_date_to'])) : '' ?>">
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group row">
										<label for="" class="col-xl-3 col-form-label text-muted">Inspect Area</label>
										<div class="col-xl">
											<select class="select2 will_enable" name="area">
												<option value="">---</option>
												<?php foreach ($area_v2_list as $value_area) { ?>
													<option value="<?= $value_area['id'] ?>" <?= $value_area['id'] == $rfi['area'] ? 'selected' : '' ?>><?= $value_area['name'] ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group row">
										<label for="" class="col-xl-3 col-form-label text-muted">Inspect Location</label>
										<div class="col-xl">
											<select class="select2 will_enable" name="location">
												<option value="">---</option>
												<?php foreach ($location_v2_list as $value_location) { ?>
													<option value="<?= $value_location['id'] ?>" <?= $value_location['id'] == $rfi['location'] ? 'selected' : '' ?> data-chained="<?php echo $value_location['id_area'] ?>"><?= $value_location['name'] ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group row">
										<label for="" class="col-xl-3 col-form-label text-muted">ITP Intervention to Client</label>
										<div class="col-xl">
											<?php
												$itp_authority = explode(";", $rfi['itp_authority']);
											?>
											<select class="form-control select2" style="width:100%" name="itp[]" multiple="">
												<option value="1" <?= in_array("1", $itp_authority) ? 'selected' : '' ?>>Hold Point</option>
												<option value="2" <?= in_array("2", $itp_authority) ? 'selected' : '' ?>>Witness</option>
												<option value="3" <?= in_array("3", $itp_authority) ? 'selected' : '' ?>>Monitoring</option>
												<option value="4" <?= in_array("4", $itp_authority) ? 'selected' : '' ?>>Review</option>
											</select>
										</div>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group row">
										<label class="col-md-4 col-lg-3 col-form-label">Type of Inspection</label>
									</div>

									<div class="row">
										<?php
											$toi_rfi = explode(";", $rfi['type_of_inspection']);
										?>
										<?php foreach ($type_of_inspection_list as $key => $value) : ?>
                      <div class="col-md-3">
                        <label>
                          <input type="checkbox" class="checkbox-big" name="type_of_inspection[]" value="<?php echo $value['id'] ?>" <?= in_array($value['id'], $toi_rfi) ?  'checked' : '' ?>>
                          <span class="ml-2 text-dark"> <?php echo $value['name'] ?></span>
                        </label>
                      </div>
                    <?php endforeach; ?>
									</div>
								</div>

							</div>
						</div>
					</div>
					
					<table class="table table-bordered table-hover" id="tbl_rfi_detail">
						<thead>
							<tr class="bg-gray-table">
								<th>
									<center>ITEM / TAG NUMBER</center>
								</th>
								<th>
									<center>ITEM / TAG DESCRIPTION</center>
								</th>
								<th>
									<center>EXPECTED TIME</center>
								</th>
								<th>
									Action
								</th>
							</tr>
						</thead>

						<tbody>
							<?php foreach ($rfi_detail_list as $key => $value) : ?>
								<tr>
									<input type='hidden' class='form-control' name='id_rfi_item[]' value="<?= $value['id'] ?>">
									<td><input type='text' class='form-control' name='tag_no[]' value="<?= $value['tag_no'] ?>"></td>
									<td><input type='text' class='form-control' name='tag_description[]' value="<?= $value['tag_description'] ?>"></td>
									<td><input type='text' class='form-control' name='expected_time[]' value="<?= $value['expected_time'] ?>"></td>
									<td>
										<a href="<?= base_url() ?>dimension/rfi_detail_delete_process/<?= encrypt($value['id']) ?>" class="btn btn-sm btn-flat btn-danger" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Delete&nbsp;</b> this?', this, event)"><i class="fas fa-trash"></i></a>
									</td>
								</tr>
							<?php endforeach; ?>
							<tr>
								<td><input type='text' class='form-control' name='tag_no[]'></td>
								<td><input type='text' class='form-control' name='tag_description[]'></td>
								<td><input type='text' class='form-control' name='expected_time[]'></td>
								<td><button type='button' class="btn btn-sm btn-flat btn-primary" onclick="add_row_rfi()"><i class="fas fa-plus"></i></button></td>
							</tr>
						</tbody>

					</table>
					
					<div class="row">
						<div class="col-md">
							<button type="submit" class="btn btn-sm btn-flat btn-primary"><i class="fas fa-save"></i> Save RFI</button>
							<a target="_blank" href="<?= base_url() ?>dimension/rfi_pdf/<?= strtr($this->encryption->encrypt($dc_atc['id']), '+=/', '.-~') ?>" title='RFI PDF' class='btn btn-sm btn-flat btn-dark'><i class="fa fa-file-pdf"></i> RFI PDF</a>
						</div>
						<div class="col-md text-right">
							<?php
								$is_sendmail_disable = '';
								$disable_text = 'Send Mail RFI Invitation';
								$itp_authority = explode(";", $rfi['itp_authority']);
								if($rfi['send_notif_date'] != ''){
									if(in_array(3, $itp_authority) || in_array(4, $itp_authority)){
										$send_notif_time = strtotime($rfi['send_notif_date']);
										$noon_today = strtotime('today noon');
										$noon_yesterday = strtotime('yesterday noon');
										if ($send_notif_time >= $noon_yesterday && $send_notif_time < $noon_today) {
											$is_sendmail_disable = 'disabled';
											$disable_text = "Will be send at 12PM";
										}
										elseif ($send_notif_time >= $noon_today && $send_notif_time < $noon_today + (24 * 3600)) {
											$is_sendmail_disable = 'disabled';
											$disable_text = "Will be send at 12PM";
										}
									}
									else{
										if(date('Y-m-d', strtotime($rfi['send_notif_date'])) == date('Y-m-d')){
											// $is_sendmail_disable = 'disabled';
											// $disable_text = "Already sent email!";
										}
									}
								}
							?>
							<a target="_blank" href="<?= base_url() ?>dimension/send_mail_notif_process/<?= strtr($this->encryption->encrypt($dc_atc['id']), '+=/', '.-~') ?>" title='Delete' class='btn btn-sm btn-flat btn-warning <?= $is_sendmail_disable ?>' onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-warning&#34;>&nbsp;Send&nbsp;</b> this?', this, event)"><i class="fa fa-envelope"></i> <?= $disable_text ?></a>
						</div>
					</div>

				</div>
			</div>
		</div>
	</form>

</div>
</div>



<script>
	$(document).ready(function () {
		
	})

	function add_row_rfi() {
		let html = $("#tbl_rfi_detail tbody tr:last").html();
		$("#tbl_rfi_detail tbody").append("<tr>"+html+"</tr>");
		var delete_btn = '<button tabindex="-1" class="btn btn-sm btn-flat btn-danger" type="button" onclick="delete_row_rfi_detail(this)"><i class="fas fa-times"></i></button>';
    html = $("#tbl_rfi_detail tbody tr:last td:last").html(delete_btn);
	}

	function delete_row_rfi_detail(btn) {
		$(btn).closest("tr").remove();
	}

	$("select[name=module]").chained("select[name=project]");
	$("select[name=id_activity]").chained("select[name=id_paint_system]");

	$(".autocomplete_drawing").autocomplete({
		source: function(request, response) {
			console.log('asdasd');
			var project_id = $("#project_id option:selected").val();
			$.ajax({
				url: "<?php echo base_url() ?>dimension/autocomplete_drawing",
				dataType: "json",
				data: {
					term: request.term,
					project_id: project_id,
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
    $.ajax( {
      url: "<?php echo base_url() ?>engineering/get_data_drawing",
      dataType: "json",
      data: {
        document_no: document_no,
      },
      success: function(data) {
        console.log(data);
				$("select[name=project_id]").val(data.project).trigger('change');
				$("select[name=discipline]").val(data.discipline).trigger('change');
				$("select[name=module]").val(data.module).trigger('change');
				if(data.type_of_module != 0){
					$("select[name=type_of_module]").val(data.type_of_module).trigger('change');
				}
				$("select[name=deck_elevation]").val(data.deck_elevation).trigger('change');
      }
    });
  }

	$("select[name=module]").chained("select[name=project_id]");
	$("select[name=location]").chained("select[name=area]");
</script>