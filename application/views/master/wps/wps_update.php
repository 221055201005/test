<style>
	td.width_200 {
		min-width: 200px;
	}

	#content {
		overflow-x: hidden;
	}
</style>
<div id="content" class="container-fluid">

	<div class="card shadow my-3 rounded-0">
		<div class="card-header">
			<h6 class="m-0"><?php echo $meta_title ?></h6>
		</div>

		<?php if ($this->permission_cookie[114] == '1') { ?>

			<form action="<?php echo base_url() ?>master/wps/wps_update_process" enctype="multipart/form-data" method="POST">

				<div class="card-body bg-white">

					<a href='<?= base_url(); ?>master/wps/wps_list' class='btn btn-warning'><i class="fas fa-arrow-left"></i> Back</a>
					<br />
					<br />

					<div class="overflow-auto">
						<table class="table table-hover text-center ">
							<thead class="bg-green-smoe">
								<tr class="table-success">
									<th><center>No</center></th>
									<th><center>WPS No</center></th>
									<th><center>Client Doc No</center></th>
									<th><center>PQR No</center></th>
									<th><center>WPS Company</center></th>
									<th><center>WPS Project</center></th>
									<th><center>WPS Revision</center></th>
									<th><center>Discipline</center></th>
									<th><center>Requirement</center></th>
									<th><center>Position /  Welding progression</center></th>  
									<th><center>CTOD Requirement</center></th>  
									<th><center>Consumable Brand</center></th>  
									<th><center>Consumble classification</center></th>  
									<th><center>Document PWPS / WPS</center></th>  
									<th><center>Remarks</center></th>
									<th><center>Attachment</center></th>
									<th><center>WPS Status</center></th>
								</tr>
							</thead>
							<tbody id="table_list">
								<?php $no = 1;
								foreach ($wps_list as $key => $value) : ?>
									<input type="hidden" name="id_wps_main[<?php echo $no; ?>]" id="id_wps_main[<?php echo $no; ?>]" value="<?php echo $value['id_wps']; ?>">
									<tr>
										<td><?php echo $no ?></td>
										<td class="width_200">
											<input type='text' name='wps_no[<?php echo $no; ?>]' class="form-control" value='<?php echo $value["wps_no"] ?>' id="wps_no[<?php echo $no; ?>]" onblur="check_wps(<?php echo $no; ?>)" required>
											<span id="text_alert_wps<?php echo $no; ?>"></span>
										</td>
										<td class="width_200">
											<input type='text' name='client_doc_no[<?php echo $no; ?>]' class="form-control" value='<?php echo $value["client_doc_no"] ?>' id="client_doc_no[<?php echo $no; ?>]" required>
										</td>
										<td class="width_200">
											<input type='text' name='pqr_no[<?php echo $no; ?>]' class="form-control" value='<?php echo $value["pqr_no"] ?>' id="pqr_no[<?php echo $no; ?>]" required>
										</td>
										<td class="width_200">
											<select name="company_id[<?= $no ?>]" style="width:100%" class="select2" required>
												<option value="">---</option>
												<?php foreach ($company_list as $v) : ?>
													<option value="<?= $v['id_company'] ?>" <?= $v['id_company'] == $value['company_id'] ? 'selected' : '' ?>><?= $v['company_name'] ?></option>
												<?php endforeach; ?>
											</select>
										</td>

										<td class="width_200">
											<select name="project_id[<?= $no ?>]" style="width:100%" class="select2" required>
												<option value="">---</option>
												<?php foreach ($project_list as $v) : ?>
													<?php if (in_array($v['id'], $this->user_cookie[13])) : ?>
														<option value="<?= $v['id'] ?>" <?= $v['id'] == $value['project_id'] ? 'selected' : '' ?>><?= $v['project_name'] ?></option>
													<?php endif; ?>
												<?php endforeach; ?>
											</select>
										</td>

										<td class="width_200">
											<input type='text' name='wps_revision[<?php echo $no; ?>]' class="form-control" value='<?php echo $value["wps_revision"] ?>' required>
										</td>
										<td class="width_200">
											<select id="discipline<?php echo $no; ?>" class="form-control discipline" name="discipline[<?php echo $no; ?>]" required>
												<option value="">---</option>
												<?php foreach ($discipline_list as $key => $vd) : ?>
													<option value="<?php echo $vd['id'] ?>" <?php if ($value["discipline"] == $vd['id']) { ?> selected <?php } ?>><?php echo $vd['discipline_name'] ?></option>
												<?php endforeach; ?>
											</select>
										</td>

										<td class="align-middle">
											<table class="table table-borderless">
												<thead>
													<th>
														<center>Process</center>
													</th>
													<th>
														<center>Material Grade</center>
													</th>
													<th>
														<center>Thickness Range (mm)</center>
													</th>
													<th>
														<center>Diameter Range (mm)</center>
													</th>
													<th>
														<center>Type Of Joint</center>
													</th>
													<th>
														<center><button type="button" class="btn btn-primary btn-sm" onclick="add_row(this, <?php echo $no; ?>)"><i class="fas fa-plus-circle"></i></button></center>
													</th>
												</thead>
												<tbody id='row_detail'>
													<?php foreach ($wps_detail_list[$value["id_wps"]] as $k => $v) { ?>

														<tr>
															<td class="width_200">
																<input type="hidden" name="id_req[<?php echo $no; ?>][]" value="<?php echo $v['id_wps']; ?>">
																<select id="process<?php echo $no; ?>" class="form-control process" name="process[<?php echo $no; ?>][]" required>
																	<option value="">---</option>
																	<?php foreach ($master_weld_process as $keys => $values) { ?>
																		<option value="<?= $values['id'] ?>" <?= $v['id_weld_process'] == $values['id'] ? 'selected' : '' ?>><?= $values['name_process'] ?></option>
																	<?php } ?>
																	<!-- <option <?php if ($v['process'] == "SMAW (111)") {
																									echo "selected";
																								} ?>>SMAW (111)</option>
                                  <option <?php if ($v['process'] == "FCAW-GS (136)") {
																						echo "selected";
																					} ?>>FCAW-GS (136)</option>
                                  <option <?php if ($v['process'] == "GTAW (141)") {
																						echo "selected";
																					} ?>>GTAW (141)</option>
                                  <option <?php if ($v['process'] == "SAW (121)") {
																						echo "selected";
																					} ?>>SAW (121)</option>
                                  <option <?php if ($v['process'] == "FCAW-GS (136) Mechanized") {
																						echo "selected";
																					} ?>>FCAW-GS (136) Mechanized</option>
                                  <option <?php if ($v['process'] == "SMAW (111) + FCAW-GS (136)") {
																						echo "selected";
																					} ?>>SMAW (111) + FCAW-GS (136)</option>
                                  <option <?php if ($v['process'] == "FCAW(136) + SAW (121)") {
																						echo "selected";
																					} ?>>FCAW(136) + SAW (121)</option>
                                  <option <?php if ($v['process'] == "GTAW (141) + FCAW-GS (136)") {
																						echo "selected";
																					} ?>>GTAW (141) + FCAW-GS (136)</option>
                                  <option <?php if ($v['process'] == "SMAW (111) + SAW (121)") {
																						echo "selected";
																					} ?>>SMAW (111) + SAW (121)</option>
                                  <option <?php if ($v['process'] == "GTAW (141) + SMAW (111)") {
																						echo "selected";
																					} ?>>GTAW (141) + SMAW (111)</option>
                                  <option <?php if ($v['process'] == "GTAW(141) + SAW (121)") {
																						echo "selected";
																					} ?>>GTAW(141) + SAW (121)</option> -->
																</select>
															</td>
															<td class="width_200">
																<select id="material_grade<?php echo $no; ?>" class="form-control material_grade" name="material_grade[<?php echo $no; ?>][]" required>
																	<option value="">---</option>
																	<?php foreach ($material_grade_list as $vjt) : ?>
																		<option value="<?php echo $vjt['id'] ?>" <?php if ($v["material_grade"] == $vjt['id']) { ?> selected <?php } ?>>
																			<?php echo $vjt['material_grade'] ?>
																		</option>
																	<?php endforeach; ?>
																</select>
															</td>
															<td class="width_200">
																<input type="text" id="thickness<?php echo $no; ?>" class="form-control" name="thickness[<?php echo $no; ?>][]" value='<?php echo $v['thickness'] ?>' required placeholder="Input Thickness Range (mm)">
															</td>
															<td class="width_200">
																<input type="text" id="diameter<?php echo $no; ?>" class="form-control" name="diameter[<?php echo $no; ?>][]" value='<?php echo $v['diameter'] ?>' required placeholder="Input Diameter Range (mm)">
															</td>
															<td class="width_200">
																<select id="type_of_joint<?php echo $no; ?>" class="form-control type_of_joint" name="type_of_joint[<?php echo $no; ?>][]">
																	<option value="">---</option>
																	<?php foreach ($joint_type_list as $key => $jtl) : ?>
																		<option value="<?php echo $jtl['id'] ?>" <?php if ($v['type_of_joint'] == $jtl['id']) {
																																								echo "selected";
																																							} ?>><?php echo $jtl['joint_type_code'] ?></option>
																	<?php endforeach; ?>
																	<!-- <option <?php if ($v['type_of_joint'] == "CJP, PJP, Fillet") {
																									echo "selected";
																								} ?>>CJP, PJP, Fillet</option>
                                 <option <?php if ($v['type_of_joint'] == "Fillet") {
																						echo "selected";
																					} ?>>Fillet</option>
                                 <option <?php if ($v['type_of_joint'] == "Branch Con. (TKY)") {
																						echo "selected";
																					} ?>>Branch Con. (TKY)</option>
                                 <option <?php if ($v['type_of_joint'] == "All Configuration (Buttering/Touchup)") {
																						echo "selected";
																					} ?>>All Configuration (Buttering/Touchup)</option>
                                 <option <?php if ($v['type_of_joint'] == "All Configuration (Repair)") {
																						echo "selected";
																					} ?>>All Configuration (Repair)</option> -->
																</select>
															</td>
															<td>
																<button type="button" class="btn btn-danger btn-sm" onclick="delete_detail_wps(this, <?php echo $v['id_wps']; ?>)"><i class="fas fa-trash-alt"></i></button>
															</td>
														</tr>
													<?php } ?>
												</tbody>
											</table>

										</td>
										<td class="width_200">
											<input type='text' name='position_welding_progression[<?php echo $no; ?>]' class="form-control" value='<?php echo $value["position_welding_progression"] ?>' id="position_welding_progression[<?php echo $no; ?>]" required>
										</td>
										<td class="width_200">
											<select class="form-control" name="ctod_requirement[<?php echo $no; ?>]" required>
												<option value="">---</option>
												<option <?= $value["ctod_requirement"] == 'Yes' ? 'selected' : '' ?>>Yes</option> 
												<option <?= $value["ctod_requirement"] == 'No' ? 'selected' : '' ?>>No</option>  
											</select>
										</td>
										<td class="width_200">
											<input type='text' name='consumable_brand[<?php echo $no; ?>]' class="form-control" value='<?php echo $value["consumable_brand"] ?>' id="consumable_brand[<?php echo $no; ?>]" required>
										</td>
										<td class="width_200">
											<input type='text' name='consumable_classification[<?php echo $no; ?>]' class="form-control" value='<?php echo $value["consumable_classification"] ?>' id="consumable_classification[<?php echo $no; ?>]" required>
										</td>
										<td class="width_200">
											<select  class="form-control" name="document_pwps_wps[<?php echo $no; ?>]" required>
												<option value="">---</option>
												<option <?= $value["document_pwps_wps"] == 'Existing' ? 'selected' : '' ?>>Existing</option> 
												<option <?= $value["document_pwps_wps"] == 'New Qualification' ? 'selected' : '' ?>>New Qualification</option>  
											</select>
										</td>
										<td class="width_200">
											<select id="remarks<?php echo $no; ?>" class="form-control remarks" name="remarks[<?php echo $no; ?>]">
												<option value="">---</option>
												<option <?php if ($value['remarks'] == "CTOD") {
																	echo "selected";
																} ?>>CTOD</option>
												<option <?php if ($value['remarks'] == "N/A") {
																	echo "selected";
																} ?>>N/A</option>
											</select>
										</td>
										<td class="width_200">
											<?php if (isset($value["attachment"])) { ?>
												<!-- <a href='https://www.smoebatam.com/pcms_v2_photo/wps_file/<?php echo $value["attachment"]; ?>' class="btn btn-success btn-sm"><i class="fa fa-paperclip"></i></a> -->
												<?php
												$enc_redline = strtr($this->encryption->encrypt($value["attachment"]), '+=/', '.-~');
												$enc_path   = strtr($this->encryption->encrypt('/PCMS/pcms_v2/wps_attachment/'), '+=/', '.-~');
												?>
												<a target='_blank' href='<?= site_url('irn/open_file/' . $enc_redline . '/' . $enc_path) ?>'><span class='btn btn-primary'><i class="fas fa-images"></i></span></a>
												<br />
											<?php } else { ?>
												-
											<?php } ?>
											<br />
											<br />
											<input type="file" name="attachment_1[<?php echo $no; ?>]">
										</td>
										<td class="width_200">
											<select id="status_wps<?php echo $no; ?>" class="form-control" name="status_wps[<?php echo $no; ?>]">
												<option value="">---</option>
												<option value="1" <?php if ($value['status_wps'] == "1") {
																						echo "selected";
																					} ?>>Actived</option>
												<option value="0" <?php if ($value['status_wps'] == "0") {
																						echo "selected";
																					} ?>>Non-Actived</option>
											</select>
										</td>

									</tr>

								<?php $no++;
								endforeach; ?>

							</tbody>
						</table>
					</div>
					<div class="row">
						<div class="col-12 text-right">
							<button type="submit" class="btn btn-success" id='submitBtn' disabled><i class="fas fa-check"></i> Submit</button>
						</div>
					</div>
				</div>

	</div>

	</form>

<?php } ?>

</div>
</div>


<script type="text/javascript">
	function delete_detail_wps(btn, id_wps) {
		Swal.fire({
			type: "warning",
			title: `<span class="text-danger">DELETE</span>`,
			html: `<i>Are you sure..?</i>`,
			showCancelButton: true
		}).then((res) => {
			if (res.value) {
				$.ajax({
					url: "<?= site_url('master/wps/delete_detail_wps') ?>",
					type: "POST",
					data: {
						id_wps: id_wps
					},
					dataType: "JSON",
					success: function(data) {
						if (data.success) {
							Swal.fire({
								type: "success",
								title: "SUCCESS",
								text: "Success Delete Data",
								timer: 1000
							})

							$(btn).closest('tr').remove()

						}
					}
				})
			}
		})
	}


	function add_row(input, index) {
		var html = `<tr>
                <td class="width_200">
                  <input type="hidden" name="id_req[${index}][]" value="new_row">
                  <select id="process${index}" class="form-control process" name="process[${index}][]" required>
                    <option value="">---</option>
                    <?php foreach ($master_weld_process as $key => $value) { ?>
                      <option value="<?= $value['id'] ?>"><?= $value['name_process'] ?></option>
                    <?php } ?>
                  </select>                                    
                </td>
               <td class="width_200">
                 <select id="material_grade${index}" class="form-control material_grade" name="material_grade[${index}][]" required>
                     <option value="">---</option>
                     <option>S460 x S460</option>
                     <option>S460 x S355</option>
                     <option>S355 x S355</option>
                     <option>S355 x S275</option>
                     <option>S275 x S275</option>
                     <option>SS x SS</option>
                     <option>CS x CS</option>
                     <option>SS x CS</option>
                 </select>
               </td>
               <td class="width_200">
                 <input type="text" id="thickness${index}" class="form-control" name="thickness[${index}][]" required placeholder="Input Thickness Range (mm)">
               </td>
               <td class="width_200">
                 <input type="text" id="diameter${index}" class="form-control" name="diameter[${index}][]" required placeholder="Input Diameter Range (mm)">
               </td>
               <td class="width_200">
                 <select id="type_of_joint${index}" class="form-control type_of_joint" name="type_of_joint[${index}][]">
                   <option value="">---</option>
                   <option>CJP, PJP, Fillet</option>
                   <option>Fillet</option>
                   <option>Branch Con. (TKY)</option>
                   <option>All Configuration (Buttering/Touchup)</option>
                   <option>All Configuration (Repair)</option>
                 </select>
               </td>
               <td class="width_200">
                 <button type="button" class="btn btn-danger  btn-sm" onclick="delete_attachment_row_2(this, ${index})"><i class="fas fa-trash-alt"></i></button>
               </td>
             </tr>`;
		$("#row_detail").append(html);
	}

	function delete_attachment_row_2(input, index) {
		$(input).closest('tr').remove()
	}
</script>

<script type="text/javascript">
	function check_wps(no) {

		$("#text_alert_wps" + no).removeAttr("hidden");
		var r_no = $("input[id='wps_no[" + no + "]']").val();
		var id_wps_main = $("input[id='id_wps_main[" + no + "]']").val();
		var wps_no_without_space = r_no.replace(/\s/g, "");

		if (wps_no_without_space == "") {
			$("input[id='wps_no[" + no + "]']").val(wps_no_without_space);
			document.getElementById("text_alert_wps" + no).style.color = "red";
			$('#text_alert_wps' + no).text('Error: WPS No is Required');
			$("#submitBtn").attr("disabled", true);

		} else {

			$("input[id='wps_no[" + no + "]']").val(wps_no_without_space);

			$.ajax({
				url: "<?= base_url() ?>master/wps/check_wps_register/" + r_no + "/" + id_wps_main,
				type: "post",
				success: function(data) {
					if (data == 0) {
						document.getElementById("text_alert_wps" + no).style.color = "green";
						$('#text_alert_wps' + no).text('Success: WPS Code Available');
						$('#submitBtn').removeAttr("disabled");
					} else {
						document.getElementById("text_alert_wps" + no).style.color = "red";
						$('#text_alert_wps' + no).text('Error: Double WPS No Code');
						$("#submitBtn").attr("disabled", true);
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
		}
	}
</script>