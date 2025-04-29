<?php
	$direct_status = [
		0 => 'Direct',
		1 => 'Indirect',
		2 => 'Team Support',
	];
?>
<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
          <h6 class="font-weight-bold text-info"><i class="fas fa-info-circle"></i> Drag the header to expand column.</h6>
          <form method="POST" action="<?php echo base_url() ?>planning/workpack_timesheet_import_process">
						<input type="hidden" name="workpack_id" value="<?php echo $workpack['id'] ?>">
            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white text-nowrap">
                  <tr>
										<th>DATE</th>
										<th>BADGE</th>
										<th>NAME</th>
										<th>EMPLOYEE STATUS</th>
										<th>SECTION</th>
										<th>MANHOUS</th>
										<th>JOB NO</th>
										<th>REMARKS</th>
										<th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  foreach ($sheet as $key => $value) : 
										$status = "";
										if($key == 1) continue;
										if($value['F']!= "" && !isset($job_no_list[$value['F']])){
											$status = "Job No Not Found!";
										}
										elseif(!isset($employee_list[$value['C']])){
											$status = "Employee Not Found!";
										}
										elseif(isset($timesheet_list[$value['B']][$value['C']])){
											$status = "Duplicate Data!";
										}
										$timesheet_list[$value['B']][$value['C']] = $value;
                  ?>
                  <tr style="background: <?= ($status != "" ? "#f8d7da" : "") ?>">
										<td>
											<input type="date" class="form-control" value="<?= $value['B'] ?>" <?= ($status != "" ? "disabled" : "readonly" ) ?> name="date[]">
										</td>
										<td>
											<input type="text" class="form-control" value="<?= $value['C'] ?>" <?= ($status != "" ? "disabled" : "readonly" ) ?> name="badge[]">
										</td>
										<td><?= $employee_list[$value['C']]['name'] ?></td>
										<td>
                      <select class='form-control' name='direct_status[]' <?= ($status != "" ? "disabled" : "required" ) ?>>
                        <option value=''>---</option>
                        <option value='0' <?= ($employee_list[$value['C']]['direct_status'] == 0 ? 'selected' : '') ?>>Direct</option>
                        <option value='1' <?= ($employee_list[$value['C']]['direct_status'] == 1 ? 'selected' : '') ?>>Indirect</option>
                        <option value='2' <?= ($employee_list[$value['C']]['direct_status'] == 2 ? 'selected' : '') ?>>Team Support</option>
                      </select>
										</td>
										<td>
											<select name="section[]" class="form-control" <?= ($status != "" ? "disabled" : "required" ) ?>>
												<?php foreach ($workpack_section as $section): ?>
													<option value="<?= $section['id'] ?>" <?= ($section['name'] == $value['D'] ? 'selected' : '') ?>><?= $section['name'] ?></option>
												<?php endforeach; ?>
											</select>
										</td>
										<td>
											<input type="text" class="form-control" value="<?= $value['E'] ?>" <?= ($status != "" ? "disabled" : "readonly" ) ?> name="manhours[]">
										</td>
										<td>
											<input type="text" class="form-control" value="<?= $value['F'] ?>" <?= ($status != "" ? "disabled" : "readonly" ) ?>>
											<input type="hidden" value="<?= $job_no_list[$value['F']] ?>" <?= ($status != "" ? "disabled" : "readonly" ) ?> name="job_no[]">
										</td>
										<td>
											<input type="text" class="form-control" value="<?= $value['G'] ?>" <?= ($status != "" ? "disabled" : "readonly" ) ?> name="remarks[]">
										</td>
										<td class="font-weight-bold"><?= $status ?></td>
                  </tr>
                  <?php 
                  endforeach; 
                  ?>
                </tbody>
              </table>
            </div>
            <br>
            <div class="row">
              <div class="col-12 text-right">
                <button class="mt-2 btn btn-sm btn-flat btn-success"><i class="fas fa-check"></i> Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->