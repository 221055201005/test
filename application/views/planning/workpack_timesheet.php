<?php
  $workpack = $workpack_list;

	$progress_manhours = 0;
	foreach ($timesheet_list as $date => $value){
		foreach ($manpower_list as $manpower){
			$manhours = $value[$manpower['badge']];
			$progress_manhours += $manhours['manhours'];
		}
	}

	$date_input = date("Y-m-d");
	if ($this->input->get("date") != null) {
		$date_input = $this->input->get("date");
	}
?>
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
              <div class="form-group row mb-0">
                <label class="col-md-4 col-lg-3 col-form-label pb-0 font-weight-bold">Workpack No.</label>
                <label class="col-md col-form-label pb-0"><?php echo @$workpack['workpack_no'] ?></label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row mb-0">
                <label class="col-md-4 col-lg-3 col-form-label pb-0 font-weight-bold">Drawing No.</label>
                <label class="col-md col-form-label pb-0"><?php echo @$workpack['drawing_no'] ?></label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row mb-0">
                <label class="col-md-4 col-lg-3 col-form-label pb-0 font-weight-bold">Module</label>
                <label class="col-md col-form-label pb-0"><?php echo @$module_list[@$workpack['module']]['mod_desc'] ?></label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row mb-0">
                <label class="col-md-4 col-lg-3 col-form-label pb-0 font-weight-bold">Type Of Module</label>
                <label class="col-md col-form-label pb-0"><?php echo @$type_of_module_list[@$workpack['type_of_module']]['name'] ?></label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row mb-0">
                <label class="col-md-4 col-lg-3 col-form-label pb-0 font-weight-bold">Deck Elevation / Service Line</label>
                <label class="col-md col-form-label pb-0"><?php echo @$deck_elevation_list[@$workpack['deck_elevation']]['name'] ?></label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row mb-0">
                <label class="col-md-4 col-lg-3 col-form-label pb-0 font-weight-bold">Discipline</label>
                <label class="col-md col-form-label pb-0"><?php echo @$discipline_list[@$workpack['discipline']]['discipline_name'] ?></label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row mb-0">
                <label class="col-md-4 col-lg-3 col-form-label pb-0 font-weight-bold">Phase</label>
                <label class="col-md col-form-label pb-0"><?php echo @$workpack['phase'] ?></label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row mb-0">
                <label class="col-md-4 col-lg-3 col-form-label pb-0 font-weight-bold">Description Assy Code</label>
                <label class="col-md col-form-label pb-0"><?php echo @$desc_assy_list[@$workpack['desc_assy']]['name'] ?></label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row mb-0">
                <label class="col-md-4 col-lg-3 col-form-label pb-0 font-weight-bold">Description</label>
                <label class="col-md col-form-label pb-0"><?php echo @$workpack['description'] ?></label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row mb-0">
                <label class="col-md-4 col-lg-3 col-form-label pb-0 font-weight-bold">Job No.</label>
                <label class="col-md col-form-label pb-0"><?php echo @$workpack['job_no'] ?></label>
              </div>
            </div>
          </div>
          <?php
            $job_description = explode(";", $workpack['job_description']);
          ?>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row mb-0">
                <label class="col-md-4 col-lg-3 col-form-label pb-0 font-weight-bold">Job Description</label>
                <label class="col-md col-form-label pb-0"><?php echo join(", ", $job_description) ?></label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <form method="POST" action="<?php echo base_url() ?>planning/workpack_timesheet_import_preview" enctype="multipart/form-data">
    <input type="hidden" name="workpack_id" value="<?php echo $workpack['id'] ?>">
    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <div class="row">
              <div class="col-sm">
                <h6 class="m-0">Import Timesheet</h6>
              </div>
              <div class="col-sm-auto">
                <a class="btn btn-sm btn-secondary" data-toggle="collapse" href="#collapse_import" role="button" aria-expanded="false" aria-controls="collapse_import">
                  <i class="fas fa-angle-double-down"></i> Show
                </a>
              </div>
            </div>
          </div>
          <div class="card-body bg-white collapse" id="collapse_import">
						<div class="form-group row">
							<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Template Excel</label>
							<div class="col-xl col-form-label">
								<a target="_blank" href="<?php echo base_url(); ?>planning/template_import_timesheet/<?= encrypt($workpack['id']) ?>">Template_Import_Timesheet.xlsx</a>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Upload Template</label>
							<div class="col-xl">
								<div class="custom-file">
									<input type="file" name="file" class="custom-file-input" required>
									<label id="label_cp" class="custom-file-label">Choose file</label>
								</div>
							</div>
						</div>
						<div class="text-right">
							<button type="submit" name="submit" class="btn btn-sm btn-flat btn-success"><i class="fas fa-save"></i> Save</button>
						</div>
          </div>
        </div>
      </div>
    </div>
  </form>
  
  <form method="POST" action="<?php echo base_url() ?>planning/workpack_manpower_update_process">
    <input type="hidden" name="workpack_id" value="<?php echo $workpack['id'] ?>">
    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <div class="row">
              <div class="col-sm">
                <h6 class="m-0">Manpower</h6>
              </div>
              <div class="col-sm-auto">
                <a class="btn btn-sm btn-secondary" data-toggle="collapse" href="#collapse_document_register" role="button" aria-expanded="false" aria-controls="collapse_document_register">
                  <i class="fas fa-angle-double-down"></i> Show
                </a>
              </div>
            </div>
          </div>
          <div class="card-body bg-white collapse <?= (count($manpower_list) == 0 ? 'show' : '') ?>" id="collapse_document_register">
            <div class="overflow-auto" style="max-height: 70vh; overflow-y: auto;">
              <table id="tbl_manpower" class="table table-hover table-th-sticky text-center">
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th class="text-nowrap bg-green-smoe">Employee</th>
                    <th class="text-nowrap bg-green-smoe">Name</th>
                    <th class="text-nowrap bg-green-smoe">Employee Status</th>
                    <th class="text-nowrap bg-green-smoe">Section</th>
                    <th class="text-nowrap bg-green-smoe"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($manpower_list as $key => $value): ?>
                  <tr>
                    <td>
                      <input type="text" name="progress_badge[]" value="<?php echo $value['badge'] ?>" oninput="fill_employee_check(this)" class="form-control text-center">
                      <input type="hidden" name="progress_id[]" value="<?php echo $value['id'] ?>">
                    </td>
                    <td><input type="text" name="progress_name[]" value="<?php //echo @$badge[$value['badge']] ?>" class="form-control text-center" readonly></td>
                    <td>
                      <select class='form-control' name='progress_direct_status[]'>
                        <option value=''>---</option>
                        <option value='0' <?php echo ($value['direct_status'] == '0' ? "selected" : "") ?>>Direct</option>
                        <option value='1' <?php echo ($value['direct_status'] == '1' ? "selected" : "") ?>>Indirect</option>
                        <option value='2' <?php echo ($value['direct_status'] == '2' ? "selected" : "") ?>>Team Support</option>
                      </select>
                    </td>
                    <td>
                      <select class='form-control' name='progress_section[]'>
                        <option value=''>---</option>
                        <?php foreach ($workpack_section_list as $section): ?>
                        <option value='<?php echo $section['id'] ?>' <?php echo ($section['id'] == $value['section'] ? "selected" : "") ?>><?php echo $section['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    <td><button class='btn btn-sm btn-flat btn-danger' type='button' onclick='delete_manpower_db(this, <?php echo $value["id"] ?>)'><i class='fas fa-times'></i></button></td>
                  </tr>
                  <?php endforeach; ?>
                  <tr>
                    <td><input type="text" name="progress_badge[]" value="" oninput="fill_employee_check(this)" class="form-control text-center" ></td>
                    <td><input type="text" name="progress_name[]" value="" class="form-control text-center" readonly></td>
                    <td>
                      <select class='form-control' name='progress_direct_status[]'>
                        <option value=''>---</option>
                        <option value='0'>Direct</option>
                        <option value='1'>Indirect</option>
                        <option value='2'>Team Support</option>
                      </select>
                    </td>
                    <td>
                      <select class='form-control' name='progress_section[]'>
                        <option value=''>---</option>
                        <?php foreach ($workpack_section_list as $section): ?>
                        <option value='<?php echo $section['id'] ?>'><?php echo $section['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <br>
            <br>
            <div class="text-right">
              <button type="submit" name="submit" class="btn btn-sm btn-flat btn-success"><i class="fas fa-save"></i> Save</button>
              <button class="btn btn-sm btn-flat btn-info" type="button" onclick="addrow()"><i class="fas fa-plus"></i> Add row</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  
	<?php if(count($manpower_list) > 0): ?>
  <form method="POST" action="<?php echo base_url() ?>planning/workpack_timesheet_update_process">
    <input type="hidden" name="workpack_id" value="<?php echo $workpack['id'] ?>">
    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Manhours</h6>
          </div>
          <div class="card-body bg-white">
            <div class="row">
              <div class="col-md">
                <div class="form-group row">
                  <label class="col-md-5 col-lg-4 col-form-label font-weight-bold">Date</label>
                  <div class="col-md">
                    <input type="date" class="form-control" name="progress_date" value="<?php echo $date_input ?>" title="<?php echo $date_input ?>" onblur="change_date(this)">
                  </div>
                </div>
              </div>
              <div class="col-md">
                <div class="form-group row">
                  <label class="col-md-5 col-lg-4 col-form-label font-weight-bold">Manhours Balance</label>
                  <div class="col-md">
                    <input type="number" class="form-control" name="manhours_balance" value="<?php echo $workpack['budget_manhours'] - $progress_manhours ?>" readonly>
                  </div>
                </div>
              </div>
            </div>
            <div class="overflow-auto" style="max-height: 70vh; overflow-y: auto;">
              <table id="tbl_manhours" class="table table-hover table-th-sticky text-center">
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th class="text-nowrap bg-green-smoe" width='1%'>Employee</th>
                    <th class="text-nowrap bg-green-smoe">Name</th>
                    <th class="text-nowrap bg-green-smoe" width='1%'>Employee Status</th>
                    <th class="text-nowrap bg-green-smoe" width='1%'>Section</th>
                    <th class="text-nowrap bg-green-smoe" width='1%' style="min-width: 200px">Manhours</th>
                    <th class="text-nowrap bg-green-smoe">Job No.</th>
                    <th class="text-nowrap bg-green-smoe" width='1%' style="min-width: 200px">Remarks</th>
                  </tr>
                </thead>
                <tbody>
									<?php 
										foreach ($manpower_list as $key => $manpower): 
											$manhours = $manhours_list[$manpower['badge']];
									?>
										<tr>
                    	<td>
												<?= $manpower['badge'] ?>
												<input type="hidden" name="progress_badge[]" value="<?php echo $manpower['badge'] ?>">
												<input type="hidden" name="progress_id[]" value="<?php echo $manhours['id'] ?>">
											</td>
                    	<td><?= @$user_list[$manpower['badge']]['name'] ?></td>
                    	<td>
												<?php
													if($manpower['direct_status'] == '0'){
														echo 'Direct';
													}
													elseif($manpower['direct_status'] == '1'){
														echo 'Indirect';
													}
													elseif($manpower['direct_status'] == '2'){
														echo 'Team Support';
													}
												?>
												<input type="hidden" name="progress_direct_status[]" value="<?php echo $manpower['direct_status'] ?>">
											</td>
                    	<td>
												<?= @$workpack_section_list[$manpower['section']]['name'] ?>
												<input type="hidden" name="progress_section[]" value="<?php echo $manpower['section'] ?>">
											</td>
                    	<td><input type="number" name="progress_manhours[]" value="<?php echo $manhours['manhours'] ?>" class="form-control text-center"></td>
                    	<td>
												<select class="form-control select2" name="progress_job_no[]">
													<option value="">---</option>
													<?php foreach ($job_register_list as $value): ?>
													<option value='<?php echo $value['job_no'] ?>' <?= $manhours['job_no'] == $value['job_no'] ? 'selected' : '' ?>><?php echo $value['job_no']." (".$value['description'].")" ?></option>
													<?php endforeach; ?>
												</select>
											</td>
                    	<td><input type="text" name="progress_remarks[]" value="<?php echo $manhours['remarks'] ?>" class="form-control text-center"></td>
										</tr>
									<?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <br>
            <br>
            <div class="text-right">
              <button type="submit" name="submit" class="btn btn-sm btn-flat btn-success"><i class="fas fa-save"></i> Save</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
	<?php endif; ?>

	<div class="row">
		<div class="col">
			<div class="card shadow my-3 rounded-0">
				<div class="card-header">
					<h6 class="m-0">Timesheet </h6>
				</div>
				<div class="card-body bg-white">
					<div class="overflow-auto" style="max-height: 70vh; overflow-y: auto;">
						<table class="table table-hover table-th-sticky text-center dataTable">
							<thead class="bg-green-smoe text-white">
								<tr>
									<th class="text-nowrap bg-green-smoe">Date</th>
									<th class="text-nowrap bg-green-smoe">Badge</th>
									<th class="text-nowrap bg-green-smoe">Name</th>
									<th class="text-nowrap bg-green-smoe">Employee Status</th>
									<th class="text-nowrap bg-green-smoe">Section</th>
									<th class="text-nowrap bg-green-smoe">Manhours</th>
									<th class="text-nowrap bg-green-smoe">Job No.</th>
									<th class="text-nowrap bg-green-smoe">Remarks</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$direct_status = ['Direct','Indirect','Team Support'];
									foreach ($timesheet_list as $date => $value): 
										foreach ($manpower_list as $manpower): 
											$manhours = $value[$manpower['badge']];
								?>
								<tr>
									<td><?= $date ?></td>
									<td><?= $manpower['badge'] ?></td>
									<td><?= @$user_list[$manpower['badge']]['name'] ?></td>
									<td><?= @$direct_status[$manpower['direct_status']] ?></td>
									<td><?= @$workpack_section_list[$manpower['section']]['name'] ?></td>
									<td><?= $manhours['manhours'] ?></td>
									<td><?= $manhours['job_no'] ?></td>
									<td><?= $manhours['remarks'] ?></td>
								</tr>
									<?php endforeach; ?>
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
  $('.dataTable').DataTable({
    order: [],
    columnDefs: [{
      "targets": 0,
      "orderable": false,
    }]
  })

  $(document).ready(function(){
    generate_tabindex("#tbl_manpower input:not([type=hidden], [readonly]), #tbl_manpower select:not(.select2)", 3);
    generate_tabindex("#tbl_manhours input:not([type=hidden], [readonly]), #tbl_manpower select:not(.select2)", 2);
    $("#tbl_manpower input[name='progress_badge[]']").each(function(){
      if(this.value != ''){
				console.log(this);
        fill_employee_check(this, false);
      }
    });
  });

  function addrow() {
    var html = $("#tbl_manpower tbody tr:last").html();
    $("#tbl_manpower tbody").append("<tr>"+html+"</tr>");
    var delete_btn = '<button tabindex="-1" class="mt-2 btn btn-sm btn-flat btn-danger" type="button" onclick="deleterow(this)"><i class="fas fa-times"></i></button>';
    $("#tbl_manpower tbody tr:last td:last").html(delete_btn);
    var select2_elem =  '<select class="form-control select2" name="progress_job_no[]" required>'+
                          '<option value="">---</option>'+
                          <?php foreach ($job_register_list as $value): ?>
                          '<option value="<?php echo $value['job_no'] ?>"><?php echo $value['job_no']." (".$value['description'].")" ?></option>'+
                          <?php endforeach; ?>
                        '</select>';
    $("#tbl_manpower tbody tr:last td:nth(5)").html(select2_elem);
    $('select.select2').select2({
      theme: 'bootstrap'
    });
    generate_tabindex("#tbl_manpower input:not([type=hidden], [readonly]), #tbl_manpower select:not(.select2)", 3);
  }

  function deleterow(btn) {
    $(btn).closest("tr").remove();
    generate_tabindex("#tbl_manpower input:not([type=hidden], [readonly]), #tbl_manpower select:not(.select2)", 3);
  }

  function fill_employee_check(input, wait_delay = true) {
    if ($(input).val() != '') {
      $(input).closest("tr").find("input[type=text], input[type=number], select:not(.select2)").prop("required", true);
      employee_check(input, wait_delay)
    }
    else{
      $(input).closest("tr").find("input[type=text], input[type=number], select:not(.select2)").prop("required", false);
    }
  }

  var delayTimer;
  function employee_check(input, wait_delay) {
    var badge = $(input).val();
    if(wait_delay == true){
      clearTimeout(delayTimer);
    }
    delayTimer = setTimeout(function() {
      $.ajax({
        url: "<?php echo base_url();?>planning/employee_check/",
        type: "post",
        data: {
          badge: badge,
        },
        success: function(data) {
          $(input).closest("tr").find("[name='progress_direct_status[]']").attr("readonly", false).attr("aria-disabled", false);
          $(input).closest("tr").find("[name='progress_section[]']").attr("readonly", false).attr("aria-disabled", false);
          if(data.includes('Error') == true){
            $(input).removeClass('is-valid');
            $(input).addClass('is-invalid');
            $('.invalid-feedback').remove( ":contains('Error')" );
            $(input).after('<div class="invalid-feedback">'+data+'</div>');
            $('button[name=submit]').prop("disabled", true);
          }
          else{
            data = JSON.parse(data);
            $('.invalid-feedback').remove( ":contains('Error')" );
            $(input).removeClass('is-invalid');
            $(input).addClass('is-valid');

            $(input).closest("tr").find("[name='progress_name[]']").val(data.name);
            if(wait_delay == true){
              $(input).closest("tr").find("[name='progress_direct_status[]']").val(data.direct_status);
              $(input).closest("tr").find("[name='progress_section[]']").val(data.section);
            }
            if(data.direct_status != ''){
              $(input).closest("tr").find("[name='progress_direct_status[]']").attr("readonly", true).prop("tabindex", "-1").attr("aria-disabled", true);
            }
            if(data.section !== null){
              $(input).closest("tr").find("[name='progress_section[]']").attr("readonly", true).prop("tabindex", "-1").attr("aria-disabled", true);
            }
          }
          if (!$('.is-invalid').length) {
            $('button[name=submit]').prop("disabled", false);
          }
        }
      });
    }, 500);
  }

  function delete_manpower_db(btn, id) {
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
        $.ajax( {
          url: "<?php echo base_url() ?>planning/workpack_manpower_delete_process",
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

  function change_date(input) {
    if($(input).prop('title') != $(input).val()){
      sweetalert('loading', 'Please wait...');
      window.location = '<?php echo base_url() ?>planning/workpack_timesheet/<?php echo strtr($this->encryption->encrypt($workpack['id']), '+=/', '.-~') ?>?date='+$(input).val()
    }
  }
</script>