<?php
  function color_progress($progress){
    $color = "bg-danger";
    if($progress == 100){
      $color = "bg-success";
    }
    elseif($progress > 25){
      $color = "bg-warning";
    }
    return $color;
  }
?>
<div id="content" class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card shadow my-3 rounded-0">
				<div class="card-header">
					<h6 class="m-0"><?= $meta_title ?></h6>
				</div>
				<div class="card-body bg-white overflow-auto">
					<form method="POST" action="<?php echo base_url() ?>planning/surveyor_detail_subactivity_process/" onsubmit="save_id_checked(this)" enctype="multipart/form-data">>
						<input type="hidden" name="id">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Workpack No.</label>
									<div class="col-md-8 col-lg-9">
										<input type="text" class="form-control" readonly value='<?= $workpack_sub['workpack_no']; ?>'>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">PIC</label>
									<div class="col-md-8 col-lg-9">
										<input type="text" class="form-control" readonly value='<?= @$user_list[$workpack_sub['pic']]; ?>'>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Activity</label>
									<div class="col-md-8 col-lg-9">
										<input type="text" class="form-control" readonly value='<?= @$workpack_sub['activity']; ?>'>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Total Checked</label>
									<label class="col-md-8 col-lg-9 col-form-label font-weight-bold"><label class="text-primary num_ticker">0</label> Items</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Progress</label>
									<div class="col-md-8 col-lg-9">
										<select class="form-control" name="progress" required>
											<option value="0">0%</option>
											<option value="25">25%</option>
											<option value="50">50%</option>
											<option value="75">75%</option>
											<option value="100">100%</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Evidence</label>
									<div class="col-md-8 col-lg-9">
										<div class="custom-file">
											<input type="file" name="attachment_file" class="custom-file-input">
											<label id="label_cp" class="custom-file-label">Choose file</label>
										</div>
									</div>
								</div>
							</div> 
							<div class="col-md-12 text-right">
								<br>
								<button type="submit" name="submit" value="submit" class="btn btn-success"><i class='fas fa-check'></i> Submit</button>
							</div>
						</div> 
					</form>
				</div>
			</div>
		</div>
		<div class="col-12">
			<div class="card shadow my-3 rounded-0">
				<div class="card-header">
					<h6 class="m-0"><?= $meta_title ?></h6>
				</div>
				<div class="card-body bg-white overflow-auto">
					<div class="overflow-auto">
						<table class="table table-hover text-center">
							<thead class="bg-green-smoe text-white">
								<tr>
									<th></th>
									<th>Drawing GA</th>
									<th>Rev</th>
									<th>Drawing AS</th>
									<th>Rev</th>
									<th>Piecemark</th>
									<th>Cutting Plan</th>
									<th>Rev</th>
									<th>Cutting List</th>
									<th>Rev</th>
									<th>Material</th>
									<th>Profile</th>
									<th>Grade</th>
									<th>Weight (kg)</th>
									<th>Length (mm)</th>
									<th>Progress</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($workpack_subactivity_list as $key => $value) : ?>
									<tr>
										<td>
											<input type='checkbox' class='checkbox-big' value='<?= $value['id'] ?>' onclick='save_checkbox(this)'>
										</td>
										<td><?php echo $template_list[$value['id_template']]['drawing_ga'] ?></td>
										<td><?php echo $template_list[$value['id_template']]['rev_ga'] ?></td>
										<td><?php echo $template_list[$value['id_template']]['drawing_as'] ?></td>
										<td><?php echo $template_list[$value['id_template']]['rev_as'] ?></td>
										<td><?php echo $template_list[$value['id_template']]['part_id'] ?></td>
										<td><?php echo $template_list[$value['id_template']]['drawing_cp'] ?></td>
										<td><?php echo $template_list[$value['id_template']]['rev_cp'] ?></td>
										<td><?php echo $template_list[$value['id_template']]['drawing_cl'] ?></td>
										<td><?php echo $template_list[$value['id_template']]['rev_cl'] ?></td>
										<td><?php echo $template_list[$value['id_template']]["material"] ?></td>
										<td><?php echo $template_list[$value['id_template']]["profile"] ?></td>
										<td><?php echo @$material_grade_list[$template_list[$value['id_template']]["grade"]]['material_grade'] ?></td>
										<td><?php echo $template_list[$value['id_template']]["weight"] ?></td>
										<td><?php echo $template_list[$value['id_template']]["length"] ?></td>
										<td>
											<div class="progress">
												<div class="progress-bar progress-bar-striped progress-bar-animated <?php echo color_progress($value['progress']); ?>" role="progressbar" aria-valuenow="<?php echo $value['progress'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $value['progress'] ?>%"><b class="<?php echo ($value['progress'] < 25 ? 'text-dark' : '') ?>"><?php echo $value['progress'] ?>%<b></div>
											</div>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div> 
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<script>
	var data_checkbox = [];
  function save_checkbox(input) {
    if($(input).prop("checked") == true && $.inArray($(input).val(), data_checkbox) == -1){
      data_checkbox.push($(input).val());
    }
    else if($(input).prop("checked") == false && $.inArray($(input).val(), data_checkbox) != -1){
      data_checkbox.splice( $.inArray($(input).val(), data_checkbox), 1 );
    }
    $(".num_ticker").html(data_checkbox.length)
    // console.log(data_checkbox);
  }

	function save_id_checked(form) {
    $(form).find("input[name=id]").val(data_checkbox.join(", "));
  }
</script>