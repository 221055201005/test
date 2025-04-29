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
				<form action="<?= base_url() ?>planning/request_change_unique_process" method="POST">
					<input type="hidden" name="project" value="<?= $workpack['project'] ?>">
					<input type="hidden" name="discipline" value="<?= $workpack['discipline'] ?>">
					<input type="hidden" name="type_of_module" value="<?= $workpack['type_of_module'] ?>">
					<input type="hidden" name="id" value="<?= $workpack['id'] ?>">
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
								<!-- <th>Material Type</th> -->
								<th>Unique No</th>
								<th>Remarks Request</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$disabled = 0;
								foreach ($detail_list as $key => $value): 
									$grade = @$material_grade_list[$template_list[$value['id_template']]["grade"]]['material_grade'];
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
								<!-- <td>
									<?= $value['material_type'] == 0 ? 'Raw' : 'Excess' ?>
								</td> -->
								<td>
									<?= $value['unique_no'] ?>
								</td>
								<td>
									<?php if(isset($mv_list[$value['id_template']])): ?>
										<span class="font-weight-bold text-success">Already Completed</span>
									<?php else: ?>
										<input type="hidden" name="id_detail[]" value="<?= $value['id'] ?>">
										<textarea class="form-control" name="remarks_request[]"></textarea>
									<?php endif; ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<br>
					<div class="text-right">
						<button type="submit" class="btn btn-sm btn-flat btn-success" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Request&nbsp;</b> this?', this, event)"><i class='fas fa-check'></i> Submit</button>
					</div>
				</form>
      </div>
    </div>
  </div>

</div>
</div>
<script>
	$(function(){
		
	})
</script>