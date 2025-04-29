<div id="content" class="container-fluid">

	<div class="card shadow my-3 rounded-0">
		<div class="card-body bg-white overflow-auto">
			<hr>
			<h1 class="text-center font-weight-bold"><?= $workpack['workpack_no'] ?? $workpack['drawing_no'] ?></h1>
			<hr>
		</div>
	</div>

	<div class="card shadow my-3 rounded-0">
		<div class="card-header">
			<h6 class="m-0"><?= $meta_title ?></h6>
		</div>
		<div class="card-body bg-white overflow-auto">
			<div class="overflow-auto">
				<h6><strong>Raw</strong> : Using Available Balance From Warehouse (Will Create MIS Form)</h6>
				<h6><strong>Excess</strong> : Using Available Balance from Production</h6>
				<form action="<?= base_url() ?>planning/workpack_unique_update_process" method="POST">
					<input type="hidden" name="project" value="<?= $workpack['project'] ?>">
					<input type="hidden" name="discipline" value="<?= $workpack['discipline'] ?>">
					<input type="hidden" name="type_of_module" value="<?= $workpack['type_of_module'] ?>">
					<table class="table table-hover text-center dataTable">
						<thead class="bg-gray-table text-nowrap">
							<tr>
								<th>Drawing GA</th>
								<th>Rev GA</th>
								<th>Drawing AS</th>
								<th>Rev AS</th>
								<th>Piecemark</th>
								<th>Material</th>
								<th>Profile</th>
								<th>Grade</th>
								<th>Weight (kg)</th>
								<th>Remarks</th>
								<th>Material Type</th>
								<th style="min-width: 240px;">Unique No</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$disabled = 0;
							foreach ($detail_list as $key => $value) :
								$grade = @$material_grade_list[$template_list[$value['id_template']]["grade"]]['material_grade'];

								$error = '';
								if ($value['unique_no'] == '') {
									$error = 'Error: Unique No Is Blank';
								} elseif ($value['material_type'] == 0 && !in_array($value['unique_no'], $unique_no_list)) {
									$error = 'Error: Unique No Not Found';
								} elseif ($value['material_type'] == 1 && !in_array($value['unique_no'], $unique_no_excess_list)) {
									$error = 'Error: Unique No Not Found';
								} elseif ($grade != $unique_grade[$value['unique_no']]) {
									$error = 'Error: Different Grade';
								}
								if ($error != '' && !isset($mv_list[$value['id_template']])) {
									$disabled = 1;
								}
							?>
								<tr>
									<!-- <td><input type='checkbox' class='checkbox-big' name="id[]" value='<?= $value['id'] ?>' onclick='save_checkbox(this)'></td> -->
									<td><?= $template_list[$value['id_template']]['drawing_ga'] ?></td>
									<td><?= $template_list[$value['id_template']]['rev_ga'] ?></td>
									<td><?= $template_list[$value['id_template']]['drawing_as'] ?></td>
									<td><?= $template_list[$value['id_template']]['rev_as'] ?></td>
									<td><?= $template_list[$value['id_template']]['part_id'] ?></td>
									<td><?= $template_list[$value['id_template']]["material"] ?></td>
									<td><?= $template_list[$value['id_template']]["profile"] ?></td>
									<td>
										<?= $grade ?>
									</td>
									<td><?= number_format((float)$template_list[$value['id_template']]["weight"], 2, '.', ''); ?></td>
									<td><?= $value['remarks_request'] ?></td>
									<?php if (isset($mv_list[$value['id_template']])) : ?>
										<td colspan="2" class="text-right font-weight-bold text-success">Already Completed</td>
									<?php else : ?>
										<td>
											<select name="material_type[]" class="form-control">
												<option value="0" <?= ($value['material_type'] == 0 ? 'selected' : '') ?>>Raw</option>
												<option value="1" <?= ($value['material_type'] == 1 ? 'selected' : '') ?>>Excess</option>
											</select>
										</td>
										<td>
											<input type="hidden" name="grade[]" value="<?= $grade ?>">
											<input type="hidden" name="id[]" value="<?= $value['id'] ?>">
											<input type="hidden" name="id_template[]" value="<?= $value['id_template'] ?>">
											<!-- <input type="text" class="form-control autocomplete_unique" name="unique_no[]" data-grade="<?= $grade ?>" value="<?= $value['unique_no'] ?>"> -->
											<select class="form-control select2-ajax-unique" data-grade="<?= $grade ?>" name="unique_no[]">
												<option value="<?= $value['unique_no'] ?>" selected="selected"><?= $value['unique_no'] ?></option>
											</select>
											<div class="invalid-feedback d-block"><?= $error ?></div>
										</td>
									<?php endif ?>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<br>
					<div class="text-right">
						<button type="submit" class="btn btn-sm btn-flat btn-info" name="status" value="0"><i class="fas fa-save"></i> Save</button>
						<a href="<?= base_url() ?>planning/workpack_transmit_process/<?= encrypt($workpack['id']) ?>" class="btn btn-sm btn-flat btn-success <?= $disabled == 1 ? 'disabled' : '' ?>" onclick="sweetalert('confirm', 'Are you sure?', this, event)"><i class="fas fa-check"></i> Transmit</a>
					</div>
				</form>
			</div>
		</div>
	</div>

</div>
</div>
<script>
	$(function() {
		$('.select2-ajax-unique').select2({
			ajax: {
				url: '<?= base_url() ?>planning/autocomplete_unique_select',
				dataType: 'json',
				data: function(params) {
					let grade = $(this).data('grade');
					let material_type = $(this).closest('tr').find("select[name='material_type[]']").val();
					console.log(grade, material_type);
					var query = {
						term: params.term,
						grade: grade,
						material_type: material_type,
						project: '<?= $workpack['project'] ?>',
						discipline: '<?= $workpack['discipline'] ?>',
						type_of_module: '<?= $workpack['type_of_module'] ?>',
						company_id: '<?= $workpack['company_id'] ?>',
					}
					return query;
				},
			}
		});

		$(".autocomplete_unique").autocomplete({
			source: function(request, response) {
				let grade = $(this.element).data('grade');
				let material_type = $(this.element).closest('tr').find("select[name='material_type[]']").val();
				$.ajax({
					url: "<?= base_url() ?>planning/autocomplete_unique",
					dataType: "json",
					data: {
						term: request.term,
						grade: grade,
						material_type: material_type,
						project: '<?= $workpack['project'] ?>',
						discipline: '<?= $workpack['discipline'] ?>',
						type_of_module: '<?= $workpack['type_of_module'] ?>',
						company_id: '<?= $workpack['company_id'] ?>',
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
				}
			}
		});

	})
</script>