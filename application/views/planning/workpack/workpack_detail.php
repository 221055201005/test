<?php
$workpack = $workpack_list;
$total_weight = 0;
$num_piecemark = 0;
if (in_array($workpack['phase'], ['PF', 'ITR'])) {
  $piecemark_list = $template_list;
}
foreach ($piecemark_list as $key => $value) {
  $num_piecemark++;
  $total_weight += $value['weight'];
}

$receiver_workpack = '';
foreach ($workpack_pic_history_list as $subactivity_list) {
	if(isset($subactivity_list[0]) && $receiver_workpack == ''){
		$receiver_workpack = $subactivity_list[0];
	}
}
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
      <form id="form_workpack_update_process" method="POST" action="<?php echo base_url() ?>planning/workpack_update_process">
        <input type="hidden" class="form-control" name="id" value="<?php echo @$workpack['id'] ?>">
        <input type="hidden" class="form-control" name="project" value="<?php echo @$workpack['project'] ?>">
        <input type="hidden" class="form-control" name="method" value="<?php echo @$method ?>">
        <?php if ($workpack['status'] != 0) : ?>
          <input type="hidden" class="form-control" name="phase" value="<?php echo @$workpack['phase'] ?>">
        <?php endif; ?>

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

                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Drawing No.</label>
                      <div class="col-md">
                        <input type="text" class="form-control" name="drawing_no" value="<?php echo @$workpack['drawing_no'] ?>" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Test Pack No.</label>
                      <div class="col-md">
                        <input type="text" class="form-control" name="test_pack_no" value="<?php echo @$workpack['test_pack_no'] ?>" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Module</label>
                      <div class="col-md">
                        <select class="form-control" name="module" <?php echo ($workpack['status'] == 0 ? "" : "disabled") ?>>
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
                        <select class="form-control" name="type_of_module" <?php echo ($workpack['status'] == 0 ? "" : "disabled") ?>>
                          <option value="">---</option>
                          <?php foreach ($type_of_module_list as $key => $value) : ?>
                            <option value="<?php echo $value['id'] ?>" <?php echo (@$workpack['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code'] . " - " . $value['name'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Deck Elevation / Service Line</label>
                      <div class="col-md">
                        <select class="form-control" name="deck_elevation" <?php echo ($workpack['status'] == 0 ? "" : "disabled") ?>>
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
                        <select class="form-control" name="discipline" <?php echo ($workpack['status'] == 0 ? "" : "disabled") ?>>
                          <option value="">---</option>
                          <?php foreach ($discipline_list as $key => $value) : ?>
                            <option value="<?php echo $value['id'] ?>" <?php echo (@$workpack['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status Internal</label>
                      <div class="col-md-8 col-lg-9">
                        <select class="form-control" name="status_internal" <?php echo ($workpack['status'] == 0 ? "" : "disabled") ?>>
                          <option value="0" <?php echo @$workpack['status_internal'] == "0" ? "selected" : "" ?>>External</option>
                          <option value="1" <?php echo @$workpack['status_internal'] == "1" ? "selected" : "" ?>>Internal</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Phase</label>
                      <div class="col-md">
                        <select class="form-control" name="phase" <?php echo ($workpack['status'] == 0 ? "" : "disabled") ?>>
                          <option value="">---</option>
                          <option value="PF" <?php echo (@$workpack['phase'] == "PF" ? 'selected' : '') ?>>PF - Pre-Fabrication</option>
                          <option value="FB" <?php echo (@$workpack['phase'] == "FB" ? 'selected' : '') ?>>FB - Fabrication</option>
                          <option value="AS" <?php echo (@$workpack['phase'] == "AS" ? 'selected' : '') ?>>AS - Assembly</option>
                          <option value="ER" <?php echo (@$workpack['phase'] == "ER" ? 'selected' : '') ?>>ER - Erection</option>
                          <option value="ITR" <?php echo (@$workpack['phase'] == "ITR" ? 'selected' : '') ?>>ITR - Inspection & Test Record</option>
                          <option value="BAA" <?php echo (@$workpack['phase'] == "BAA" ? 'selected' : '') ?>>BAA - Bondstrand Adhesive Assembly</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Desc Assy</label>
                      <div class="col-md-8 col-lg-9">
                        <select class="form-control select2" name="desc_assy" <?php echo ($workpack['status'] == 0 ? "" : "disabled") ?>>
                          <option value="">---</option>
                          <?php foreach ($desc_assy_list as $key => $value) : ?>
                            <option value="<?php echo $value['id'] ?>" <?php echo (@$workpack['desc_assy'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code'] . " - " . $value['name'] ?></option>
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
														<?php if($this->user_cookie[11] == 1 || $value['id_company'] == $this->user_cookie[11]): ?>
                            	<option value="<?php echo $value['id_company'] ?>" <?php echo (@$workpack['company_id'] == $value['id_company'] ? 'selected' : '') ?>><?php echo $value['company_name'] ?></option>
														<?php endif; ?>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Piping Testing Category</label>
                      <div class="col-md">
                        <select class="form-control select2" name="piping_testing_category" <?php echo ($workpack['status'] == 0 ? "" : "disabled") ?> required>
                          <option value="">---</option>
                          <?php foreach ($piping_testing_category_list as $key => $value) : ?>
                            <option value="<?php echo $value['id'] ?>" <?php echo (@$workpack['piping_testing_category'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
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
														<?php if(in_array($value['id_company'], $this->user_cookie[14])): ?>
                            	<option value="<?php echo $value['id_company'] ?>" <?php echo (@$workpack['company_yard'] == $value['id_company'] ? 'selected' : '') ?>><?php echo $value['company_name'] ?></option>
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
                        <input type="text" class="form-control" name="description" value="<?php echo @$workpack['description'] ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
										<div class="form-group row">
											<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">WorkPack Rev No.</label>
											<div class="col-md">
												<input type="text" class="form-control" name="workpack_rev_no" readonly value="<?php echo $workpack['workpack_rev_no'] ?>">
											</div>
										</div>
                  </div>
                </div>
                <div class="row">
                  <?php if (@$workpack['type'] == 1) : ?>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Job No.</label>
                        <div class="col-md">
                          <!-- <input type="text" class="form-control" name="job_no" value="<?php echo @$workpack['job_no'] ?>" required> -->
                          <select class="form-control select2-multiple" name="job_no[]" multiple required>
                            <?php foreach ($job_register_list as $value) : ?>
                              <option value='<?php echo $value['job_no'] ?>' <?php echo (strpos(" " . @$workpack['job_no'] . " ", $value['job_no']) !== false ? 'selected' : '') ?>><?php echo $value['job_no'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  <?php endif; ?>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Remarks</label>
                      <div class="col-md">
                        <textarea class="form-control" name="remarks"><?php echo @$workpack['remarks'] ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <?php if (@$workpack['type'] == 1) : ?>
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
                        <label>
                          <input type="checkbox" class="checkbox-big" name="job_description[]" value="<?php echo $value['description'] ?>" <?php echo (in_array($value['description'], $job_description) ? "checked" : "") ?> onchange="change_jobdesc(this)">
                          <span class="ml-2 font-weight-bold text-dark"> <?php echo $value['description'] ?></span>
                        </label>
                      </div>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>
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
                    <input type="date" class="form-control" max="9999-12-31" name="plan_start_date" value="<?php echo $workpack['plan_start_date'] ?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-4 col-xl-4 col-form-label font-weight-bold text-nowrap">Plan Finish Date</label>
                  <div class="col-md">
                    <input type="date" class="form-control" max="9999-12-31" name="plan_finish_date" value="<?php echo $workpack['plan_finish_date'] ?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-4 col-xl-4 col-form-label font-weight-bold text-nowrap">Actual Start Date</label>
                  <div class="col-md">
                    <input type="date" class="form-control" name="actual_start_date" value="<?php //echo $workpack['actual_start_date'] 
                                                                                            ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-4 col-xl-4 col-form-label font-weight-bold text-nowrap">Actual Finish Date</label>
                  <div class="col-md">
                    <input type="date" class="form-control" name="actual_finish_date" value="<?php //echo $workpack['actual_finish_date'] 
                                                                                              ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-4 col-xl-4 col-form-label font-weight-bold text-nowrap">Issued Date</label>
                  <div class="col-md">
                    <input type="date" class="form-control" name="issued_date" value="<?php echo $workpack['issued_date'] ?>" readonly>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php if (in_array(@$workpack['type'], [1, 3])) : ?>
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
                            <?php if (($workpack['status'] == 0 && in_array($workpack['status_approval'], [0, 2, 4])) || $method == 'revise') : ?>
                              <button class='btn btn-sm btn-flat btn-danger' type='button' onclick='delete_manhours_db(this, <?php echo $value["id"] ?>)'><i class='fas fa-times'></i></button>
                          </td>
                        <?php endif; ?>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                  <div class="text-right">
                    <?php if (($workpack['status'] == 0 && in_array($workpack['status_approval'], [0, 2, 4])) || $method == 'revise') : ?>
                      <button type="button" class="btn btn-sm btn-flat btn-success" onclick="add_manhours();"><i class="fas fa-plus"></i> Add</button>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if (in_array(@$workpack['type'], [1, 3])) : ?>
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
                          <option value="<?php echo $value['id'] ?>" <?php echo (@$workpack['area_v2'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Location</label>
                    <div class="col-md">
                      <select class="form-control select2" name="location_v2" <?= ($workpack['type'] != '3' ? 'required' : '') ?>>
                        <option value="">---</option>
                        <?php foreach ($location_v2_list as $key => $value) : ?>
                          <option value="<?php echo $value['id'] ?>" <?php echo (@$workpack['location_v2'] == $value['id'] ? 'selected' : '') ?> data-chained="<?php echo $value['id_area'] ?>"><?php echo $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Total Weight</label>
                    <div class="col-md">
                      <input type="number" class="form-control" value="<?php echo $total_weight ?>" readonly>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Total <?php echo (in_array($workpack['phase'], ['PF', 'ITR']) ? "Piecemark" : "Joint") ?></label>
                    <div class="col-md">
                      <input type="number" class="form-control" value="<?php echo count($detail_list) ?>" readonly>
                    </div>
                  </div>
                  <?php //if($workpack['type'] == 2): 
                  ?>
                  <!-- <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Material Type</label>
                      <div class="col-md">
                        <select class="form-control select2" name="material_type">
                          <option value="">---</option>
                          <?php foreach ($catalog_category_list as $key => $value) : ?>
                            <option value="<?php echo $value['id'] ?>" <?php echo (@$workpack['material_type'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['catalog_category'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Total Area (M2)</label>
                      <div class="col-md">
                        <input type="text" class="form-control" name="total_area" value="<?php echo array_sum(array_column($detail_list, "area")); ?>" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Total Qty (PCS)</label>
                      <div class="col-md">
                        <input type="text" class="form-control" name="total_qty" value="<?php echo array_sum(array_column($detail_list, "qty")); ?>" readonly>
                      </div>
                    </div> -->
                  <?php //endif; 
                  ?>
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Budget manhours</label>
                    <div class="col-md">
                      <input type="number" class="form-control" name="budget_manhours" value="<?php echo $workpack['budget_manhours'] + 0 ?>" readonly>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if (@$workpack['type'] == 3) : ?>
            <div class="col-md-6">
              <div id="con_workpack_grade" class="card shadow my-3 rounded-0">
                <div class="card-header">
                  <h6 class="m-0">Grade</h6>
                </div>
                <div class="card-body bg-white overflow-auto">
                  <table id="tbl_grade" class="table table-bordered text-center">
                    <thead class="bg-green-smoe text-white">
                      <tr>
                        <th>Grade</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($workpack_grade_list as $key => $value) : ?>
                        <tr>
                          <td>
                            <select class='form-control select2' name='grade_name[]' required>
                              <option value=''>---</option>
                              <?php foreach ($material_grade_list as $grade) : ?>
                                <option value='<?php echo $grade['id'] ?>' <?php echo ($grade['id'] == $value['grade'] ? "selected" : "") ?>><?php echo $grade['material_grade'] ?></option>
                              <?php endforeach; ?>
                            </select>
                            <input type='hidden' value="<?php echo $value['id'] ?>" name='grade_id[]' required>
                          </td>
                          <td>
                            <?php if (($workpack['status'] == 0 && in_array($workpack['status_approval'], [0, 2, 4])) || $method == 'revise') : ?>
                              <button class='btn btn-sm btn-flat btn-danger' type='button' onclick='delete_grade_db(this, <?php echo $value["id"] ?>)'><i class='fas fa-times'></i></button>
                          </td>
                        <?php endif; ?>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                  <div class="text-right">
                    <?php if (($workpack['status'] == 0 && in_array($workpack['status_approval'], [0, 2, 4])) || $method == 'revise') : ?>
                      <button type="button" class="btn btn-sm btn-flat btn-success" onclick="add_grade();"><i class="fas fa-plus"></i> Add</button>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
					<div class="col-md-6">
						<div class="card shadow my-3 rounded-0">
							<div class="card-header">
								<h6 class="m-0">Additional Information</h6>
							</div>
							<div class="card-body bg-white overflow-auto">
								<div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project Engineering / Construction Engineering</label>
									<div class="col-md">
										<select name="approval_assigned" class="select2 form-control" required>
											<option value="">---</option>
											<?php foreach ($list_of_user as $key => $value) : ?>
												<option value="<?= $value['id_user'] ?>" <?= $value['id_user'] == $workpack['approval_assigned'] ? 'selected' : '' ?>><?= $value['full_name'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold"> Construction Superintendent</label>
									<div class="col-md">
										<select name="superintendent_assigned" class="select2 form-control" <?= $workpack['type'] == 1 ? 'required' : '' ?>>
											<option value="">---</option>
											<?php foreach ($list_of_user as $key => $value) : ?>
												<option value="<?= $value['id_user'] ?>" <?= $value['id_user'] == $workpack['superintendent_assigned'] ? 'selected' : '' ?>><?= $value['full_name'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<?php if ($workpack['type'] == 3) : ?>
									<div class="form-group row">
										<label for="" class="col-xl-3 col-form-label text-muted"> Supervisor Assign</label>
										<div class="col-xl">
											<select name="id_supervisor" class="select2" style="width:100%" required>
												<option value="">---</option>
												<?php foreach ($list_of_user as $key => $value) : ?>
													<option value="<?= $value['id_user'] ?>" <?= $value['id_user'] == $workpack['id_supervisor'] ? 'selected' : '' ?>><?= $value['full_name'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="" class="col-xl-3 col-form-label text-muted"> Is Equipment <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Will Need Third Party Approval in MIS"></i></label>
										<div class="col-xl">
											<select name="is_equipment" class="select2" styestyle="width:100%" onchange="change_is_equipment(this)" required>
												<option value="">---</option>
												<option value="0" <?= $workpack['is_equipment'] == "0" ? 'selected' : '' ?>>No</option>
												<option value="1" <?= $workpack['is_equipment'] == "1" ? 'selected' : '' ?>>Yes</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="" class="col-xl-3 col-form-label text-muted"> Third Party Company</label>
										<div class="col-xl">
											<select name="company_third_party" class="select2 tp_info" style="width:100%" onchange="change_id_third_party(this)" <?= $workpack['is_equipment'] == 1 ? '' : 'disabled' ?> required>
												<option value="">---</option>
												<?php foreach ($company_list as $key => $value) : ?>
													<option value="<?= $value['id_company'] ?>" <?= $value['id_company'] == $workpack['company_third_party'] ? 'selected' : '' ?>><?= $value['company_name'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="" class="col-xl-3 col-form-label text-muted"> Third Party User</label>
										<div class="col-xl">
											<select name="id_third_party" class="select2 tp_info" styestyle="width:100%" <?= $workpack['is_equipment'] == 1 ? '' : 'disabled' ?> required>
												<option value="">---</option>
												<?php if (isset($user_company[$workpack['company_third_party']])): ?> 
													<?php foreach ($user_company[$workpack['company_third_party']] as $key => $value): ?> 
													<option value="<?= $value['id_user'] ?>" <?= $value['id_user'] == $workpack['id_third_party'] ? 'selected' : '' ?>><?= $value['full_name'] ?></option>
													<?php endforeach; ?>
													<?php endif; ?>
												
											</select>
										</div>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					
        </div>

        <?php if ($workpack['type'] == 2) : ?>
          <div class="row">
            <div class="col">
              <div class="card shadow my-3 rounded-0">
                <div class="card-header">
                  <h6 class="m-0">Consumable</h6>
                </div>
                <div class="card-body bg-white overflow-auto">
                  <table id="tbl_cons" class="table table-bordered text-center">
                    <thead class="bg-green-smoe text-white">
                      <tr>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>UoM</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($consumable_list as $key => $value) : ?>
                        <tr>
                          <td>
                            <input type='text' class='form-control text-center' value="<?php echo $value['name'] ?>" name='cons_name[]' required>
                            <input type='hidden' value="<?php echo $value['id'] ?>" name='cons_id[]' required>
                          </td>
                          <td><input type='number' class='form-control text-center' value="<?php echo $value['qty'] ?>" name='cons_qty[]' required></td>
                          <td><input type='text' class='form-control text-center' value="<?php echo $value['uom'] ?>" name='cons_uom[]' required></td>
                          <td>
                            <?php if ($workpack['status'] == 0 && in_array($workpack['status_approval'], [0, 2, 4])) : ?>
                              <button class='btn btn-sm btn-flat btn-danger' type='button' onclick='delete_cons_db(this, <?php echo $value["id"] ?>)'><i class='fas fa-times'></i></button>
                            <?php endif; ?>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                  <div class="text-right">
                    <?php if ($workpack['status'] == 0 && in_array($workpack['status_approval'], [0, 2, 4])) : ?>
                      <button type="button" class="btn btn-sm btn-flat btn-success" onclick="add_cons();"><i class="fas fa-plus"></i> Add</button>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="card shadow my-3 rounded-0">
                <div class="card-header">
                  <h6 class="m-0">Painting Detail</h6>
                </div>
                <div class="card-body bg-white overflow-auto">
                  <table id="tbl_paint" class="table table-bordered text-center">
                    <thead class="bg-green-smoe text-white">
                      <tr>
                        <th>Material / Paint Specs.</th>
                        <th>Description</th>
                        <th>Area (M2)</th>
                        <th>VOLUME (LTR)</th>
                        <th>DFT</th>
                        <th>WFT</th>
                        <th>Remarks</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($painting_list as $key => $value) : ?>
                        <tr>
                          <td>
                            <input type='text' class='form-control text-center' value="<?php echo $value['material'] ?>" name='paint_material[]' required>
                            <input type='hidden' value="<?php echo $value['id'] ?>" name='paint_id[]' required>
                          </td>
                          <td><input type='text' class='form-control text-center' value="<?php echo $value['description'] ?>" name='paint_description[]'></td>
                          <td><input type='number' class='form-control text-center' value="<?php echo $value['area'] ?>" name='paint_area[]'></td>
                          <td><input type='number' class='form-control text-center' value="<?php echo $value['volume'] ?>" name='paint_volume[]'></td>
                          <td><input type='number' class='form-control text-center' value="<?php echo $value['dft'] ?>" name='paint_dft[]'></td>
                          <td><input type='number' class='form-control text-center' value="<?php echo $value['wft'] ?>" name='paint_wft[]'></td>
                          <td><input type='text' class='form-control text-center' value="<?php echo $value['remarks'] ?>" name='paint_remarks[]'></td>
                          <td>
                            <?php if ($workpack['status'] == 0 && in_array($workpack['status_approval'], [0, 2, 4])) : ?>
                              <button class='btn btn-sm btn-flat btn-danger' type='button' onclick='delete_paint_db(this, <?php echo $value["id"] ?>)'><i class='fas fa-times'></i></button>
                            <?php endif; ?>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                  <div class="text-right">
                    <?php if ($workpack['status'] == 0 && in_array($workpack['status_approval'], [0, 2, 4])) : ?>
                      <button type="button" class="btn btn-sm btn-flat btn-success" onclick="add_paint();"><i class="fas fa-plus"></i> Add</button>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <div class="row">
          <div class="col">
            <div class="card shadow my-3 rounded-0">
              <div class="card-header">
                <h6 class="m-0"><?php echo $meta_title ?></h6>
              </div>
              <div class="card-body bg-white">
                <div class="overflow-auto">
                  <?php if ($workpack['type'] == "1") : ?>
                    <?php if (in_array($workpack['phase'], ['PF'])) : ?>
                      <table class="table table-hover text-center" id="tbl_detail">
                        <thead class="bg-green-smoe text-white">
                          <tr>
                            <th>No.</th>
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
                            <th>Material ID</th>
                            <th>Remarks</th>
                            <th>Status Material</th>
                            <th>Remarks Material</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($detail_list as $key => $value) : ?>
                            <tr>
                              <input type="hidden" name="id_detail[]" class="form-control" value="<?php echo $value['id'] ?>">
                              <input type="hidden" name="id_template[]" class="form-control" value="<?php echo $value['id_template'] ?>">
                              <td><?php echo ($key + 1) ?></td>
                              <td><?php echo $template_list[$value['id_template']]['drawing_ga'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['rev_ga'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['drawing_as'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['rev_as'] ?></td>
                              <td>
                                <input type="text" class="form-control autocomplete_detail" value="<?php echo $template_list[$value['id_template']]['part_id'] ?>" readonly>
                              </td>
                              <td><?php echo $template_list[$value['id_template']]['drawing_cp'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['rev_cp'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['drawing_cl'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['rev_cl'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]["material"] ?></td>
                              <td><?php echo $template_list[$value['id_template']]["profile"] ?></td>
                              <td><?php echo @$material_grade_list[$template_list[$value['id_template']]["grade"]]['material_grade'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]["weight"] ?></td>
                              <td><?php echo $template_list[$value['id_template']]["length"] ?></td>
                              <td><?php echo $value['unique_no'] ?></td>
                              <td><?php echo $value['remarks'] ?></td>
                              <td>
                                <?php if ($value['material_status'] == '1') : ?>
                                  <span class="badge badge-success">Ready</span>
                                <?php else : ?>
                                  <span class="badge badge-danger">Not Ready</span>
                                <?php endif; ?>
                              </td>
                              <td><?php echo $value['material_remarks'] ?></td>
                              <td>
                                <?php if ($value['status'] == 1) : ?>
                                  <span class="badge badge-warning">Pending Approval Return by QC</span>
                                <?php elseif ($value['status'] == 3) : ?>
                                  <span class="badge badge-danger">Returned</span>
                                <?php elseif ($value['status'] == 4) : ?>
                                  <span class="badge badge-dark">Void</span>
                                <?php else : ?>
                                  <?php if ($value['progress_mv'] == 0 && (($workpack['status'] == 0 && in_array($workpack['status_approval'], [0, 2, 4])) || $method == 'revise')) : ?>
                                    <button class='btn btn-sm btn-flat btn-danger' type='button' onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Delete&nbsp;</b> this?', this, event, 'delete_detail_wp_db')" data-id="<?php echo $value['id'] ?>"><i class='fas fa-times'></i></button>
                                  <?php elseif ($value['progress_mv'] == 100 && $this->permission_cookie[15] == 1) : ?>
                                    <button class='btn btn-sm btn-flat btn-warning' type='button' onclick="sweetalert('confirm_remarks', 'Are you sure to <b class=&#34;text-warning&#34;>&nbsp;Return&nbsp;</b> this?', this, event, 'return_detail_wp_db')" data-id="<?php echo $value['id'] ?>"><i class="fas fa-undo-alt"></i></button>
                                  <?php endif; ?>
                                <?php endif; ?>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                      <div class="text-right">
                        <?php if (($workpack['status'] == 0 && in_array($workpack['status_approval'], [0, 2, 4]))) : ?>
                          <button type="button" class="btn btn-sm btn-flat btn-success" onclick="add_detail();"><i class="fas fa-plus"></i> Add</button>
                        <?php endif; ?>
                      </div>
                    <?php elseif (in_array($workpack['phase'], ['ITR'])) : ?>
                      <table class="table table-hover text-center" id="tbl_detail">
                        <thead class="bg-green-smoe text-white">
                          <tr>
                            <th>No.</th>
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
                            <th>Remarks</th>
                            <th>Status Material</th>
                            <th>Remarks Material</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($detail_list as $key => $value) : ?>
                            <tr>
                              <input type="hidden" name="id_detail[]" class="form-control" value="<?php echo $value['id'] ?>">
                              <input type="hidden" name="id_template[]" class="form-control" value="<?php echo $value['id_template'] ?>">
                              <td><?php echo ($key + 1) ?></td>
                              <td><?php echo $template_list[$value['id_template']]['drawing_ga'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['rev_ga'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['drawing_as'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['rev_as'] ?></td>
                              <td>
                                <input type="text" class="form-control autocomplete_detail" value="<?php echo $template_list[$value['id_template']]['part_id'] ?>" readonly>
                              </td>
                              <td><?php echo $template_list[$value['id_template']]['drawing_cp'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['rev_cp'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['drawing_cl'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['rev_cl'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]["material"] ?></td>
                              <td><?php echo $template_list[$value['id_template']]["profile"] ?></td>
                              <td><?php echo @$material_grade_list[$template_list[$value['id_template']]["grade"]]['material_grade'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]["weight"] ?></td>
                              <td><?php echo $template_list[$value['id_template']]["length"] ?></td>
                              <td><?php echo $value['remarks'] ?></td>
                              <td>
                                <?php if ($value['material_status'] == '1') : ?>
                                  <span class="badge badge-success">Ready</span>
                                <?php else : ?>
                                  <span class="badge badge-danger">Not Ready</span>
                                <?php endif; ?>
                              </td>
                              <td><?php echo $value['material_remarks'] ?></td>
                              <td>
                                <?php if ($value['status'] == 1) : ?>
                                  <span class="badge badge-warning">Pending Approval Return by QC</span>
                                <?php elseif ($value['status'] == 3) : ?>
                                  <span class="badge badge-danger">Returned</span>
                                <?php elseif ($value['status'] == 4) : ?>
                                  <span class="badge badge-dark">Void</span>
                                <?php else : ?>
                                  <?php if ($value['progress_itr'] == 0 && (($workpack['status'] == 0 && in_array($workpack['status_approval'], [0, 2, 4])))) : ?>
                                    <button class='btn btn-sm btn-flat btn-danger' type='button' onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Delete&nbsp;</b> this?', this, event, 'delete_detail_wp_db')" data-id="<?php echo $value['id'] ?>"><i class='fas fa-times'></i></button>
                                  <?php elseif ($value['progress_itr'] == 100 && $this->permission_cookie[15] == 1) : ?>
                                    <button class='btn btn-sm btn-flat btn-warning' type='button' onclick="sweetalert('confirm_remarks', 'Are you sure to <b class=&#34;text-warning&#34;>&nbsp;Return&nbsp;</b> this?', this, event, 'return_detail_wp_db')" data-id="<?php echo $value['id'] ?>"><i class="fas fa-undo-alt"></i></button>
                                  <?php endif; ?>
                                <?php endif; ?>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                      <div class="text-right">
                        <?php if (($workpack['status'] == 0 && in_array($workpack['status_approval'], [0, 2, 4]))) : ?>
                          <button type="button" class="btn btn-sm btn-flat btn-success" onclick="add_detail();"><i class="fas fa-plus"></i> Add</button>
                        <?php endif; ?>
                      </div>
                    <?php elseif ($workpack['phase'] != "") : ?>
                      <table id="tbl_detail" class="table table-hover text-center">
                        <thead class="bg-green-smoe text-white">
                          <tr>
                            <th>No.</th>
                            <th>Drawing WM</th>
                            <th>Rev WM</th>
                            <th>Joint No.</th>
                            <th>Piecemark#1</th>
                            <th>Piecemark#2</th>
                            <th>Weld Type Code</th>
                            <th>Thickness</th>
                            <th>Diameter</th>
                            <th>Schedule</th>
                            <th>Length</th>
                            <th>Weld Length</th>
                            <th>Remarks</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($detail_list as $key => $value) : ?>
                            <tr>
                              <input type="hidden" name="id_detail[]" class="form-control" value="<?php echo $value['id'] ?>">
                              <input type="hidden" name="id_template[]" class="form-control" value="<?php echo $value['id_template'] ?>">
                              <td><?php echo ($key + 1) ?></td>
                              <td><?php echo $template_list[$value['id_template']]['drawing_wm'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['rev_wm'] ?></td>
                              <td><input type="text" class="form-control autocomplete_detail" value="<?php echo $template_list[$value['id_template']]['joint_no'] ?>" readonly required></td>
                              <td><?php echo $template_list[$value['id_template']]['pos_1'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['pos_2'] ?></td>
                              <td><?php echo @$weld_type[$template_list[$value['id_template']]['weld_type']]['weld_type_code'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['thickness'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['diameter'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['sch'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['length'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['weld_length'] ?></td>
                              <td><?php echo $value['remarks'] ?></td>
                              <td>
                                <?php if ($value['status'] == 1) : ?>
                                  <span class="badge badge-warning">Pending Approval Return by QC</span>
                                <?php elseif ($value['status'] == 3) : ?>
                                  <span class="badge badge-danger">Returned</span>
                                <?php elseif ($value['status'] == 4) : ?>
                                  <span class="badge badge-dark">Void</span>
                                <?php else : ?>
                                  <?php if ($value['progress_fu'] == 0 && $value['progress_vt'] == 0 && (($workpack['status'] == 0 && in_array($workpack['status_approval'], [0, 2, 4])))) : ?>
                                    <button class='btn btn-sm btn-flat btn-danger' type='button' onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Delete&nbsp;</b> this?', this, event, 'delete_detail_wp_db')" data-id="<?php echo $value['id'] ?>"><i class='fas fa-times'></i></button>
                                  <?php endif; ?>
                                <?php endif; ?>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                      <div class="text-right">
                        <?php if (($workpack['status'] == 0 && in_array($workpack['status_approval'], [0, 2, 4]))) : ?>
                          <button type="button" class="btn btn-sm btn-flat btn-success" onclick="add_detail();"><i class="fas fa-plus"></i> Add</button>
                        <?php endif; ?>
                      </div>
                    <?php else : ?>
                      <table class="table table-hover text-center" id="tbl_detail">
                        <thead class="bg-green-smoe text-white">
                          <tr>
                            <th>No.</th>
                            <th>Drawing no.</th>
                            <th>Rev</th>
                            <th>Desc Material</th>
                            <th>Length</th>
                            <!-- <th>Size / Dia</th> -->
                            <!-- <th>Thickness</th>
                        <th>Width</th>
                        <th>Weight</th>
                        <th>Sch</th> -->
                            <th>Qty</th>
                            <th>Area</th>
                            <th>Remarks</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($detail_list as $key => $value) : ?>
                            <tr>
                              <input type="hidden" name="id_detail[]" class="form-control" value="<?php echo $value['id'] ?>">
                              <input type="hidden" name="id_template[]" class="form-control" value="<?php echo $value['id_template'] ?>">
                              <td><?php echo ($key + 1) ?></td>
                              <td><?php echo $value['drawing_no'] ?></td>
                              <td><?php echo @$template_list[$value['drawing_no']]['rev'] ?></td>
                              <td>
                                <input type="text" name="material[]" class="form-control autocomplete_detail" value="<?php echo @$material_catalog_list[$value['id_template']]['material'] ?>" readonly required>
                              </td>
                              <td><input type="text" name="length[]" class="form-control" value="<?php echo @$material_catalog_list[$value['id_template']]['length_m'] ?>" readonly required></td>
                              <!-- <td><?php echo @$material_catalog_list[$value['id_template']]['od'] ?></td> -->
                              <!-- <td><?php echo @$material_catalog_list[$value['id_template']]['thk_mm'] ?></td> -->
                              <!-- <td><?php echo @$material_catalog_list[$value['id_template']]['width_m'] ?></td> -->
                              <!-- <td><?php echo @$material_catalog_list[$value['id_template']]['weight'] ?></td> -->
                              <!-- <td><?php echo @$material_catalog_list[$value['id_template']]['sch'] ?></td> -->
                              <td>
                                <input type="number" name="qty[]" class="form-control" onchange="calc_qty_total()" value="<?php echo $value['qty'] ?>" required>
                              </td>
                              <td><input type="number" name="area[]" class="form-control" onchange="calc_area_total()" value="<?php echo $value['area'] ?>" required></td>
                              <td><?php echo $value['remarks'] ?></td>
                              <td>
                                <?php if ($workpack['status'] == 0 && in_array($workpack['status_approval'], [0, 2, 4])) : ?>
                                  <button class='btn btn-sm btn-flat btn-danger' type='button' onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Delete&nbsp;</b> this?', this, event, 'delete_detail_wp_db')" data-id="<?php echo $value['id'] ?>"><i class='fas fa-times'></i></button>
                                <?php endif; ?>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                      <div class="text-right">
                        <?php if ($workpack['status'] == 0 && in_array($workpack['status_approval'], [0, 2, 4])) : ?>
                          <button type="button" class="btn btn-sm btn-flat btn-success" onclick="add_detail();"><i class="fas fa-plus"></i> Add</button>
                        <?php endif; ?>
                      </div>
                    <?php endif; ?>
                  <?php endif; ?>
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
								
								<?php if($workpack['type'] == 1): ?>
									<table class="table table-sm table-borderless">
										<tr>
											<td width="25%"><b>Workpack Coordinator</b></td>
											<td width="25%"><b>Project Engineering / Construction Engineering</b></td>
											<td width="25%"><b>Construction Superintendent</b></td>
											<td width="25%"><b>Receiver / PIC</b></td>
										</tr>
										<tr>
											<td>
												<?php if($workpack['submitted_date']): ?>
													<img src="data:image/png;base64,<?= $user_list[$workpack['submitted_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
												<?php endif; ?>
											</td>
											<td>
												<?php if($workpack['status_approval'] == 1 && $workpack['approval_assigned'] == $this->user_cookie[0]): ?>
													<button type="button" class="btn btn-sm btn-flat btn-danger" onclick="sweetalert('confirm_remarks', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Reject&nbsp;</b> this?', this, event, 'reject_workpack')"><i class="fas fa-times"></i> Reject</button>
													<a href="<?php echo base_url() ?>planning/workpack_approval_process/<?php echo strtr($this->encryption->encrypt($workpack['id'] . ";3"), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-success" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Approve&nbsp;</b> this?', this, event)"><i class="fas fa-check"></i> Approve</a>
												<?php elseif($workpack['approval_date']): ?>
													<img src="data:image/png;base64,<?= $user_list[$workpack['approval_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
												<?php endif; ?>
											</td>
											<td>
												<?php if($workpack['status_approval'] == 3 && $workpack['superintendent_assigned'] == $this->user_cookie[0]): ?>
													<button type="button" class="btn btn-sm btn-flat btn-danger" onclick="sweetalert('confirm_remarks', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Reject&nbsp;</b> this?', this, event, 'reject_workpack_superintendent')"><i class="fas fa-times"></i> Reject</button>
													<a href="<?php echo base_url() ?>planning/workpack_approval_process/<?php echo strtr($this->encryption->encrypt($workpack['id'] . ";5"), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-success" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Approve&nbsp;</b> this?', this, event)"><i class="fas fa-check"></i> Approve</a>
												<?php elseif($workpack['superintendent_date']): ?>
													<img src="data:image/png;base64,<?= $user_list[$workpack['superintendent_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
												<?php endif; ?>
											</td>
											<td>
												<?php if($receiver_workpack['start_date']): ?>
													<img src="data:image/png;base64,<?= $user_list[$receiver_workpack['pic']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
												<?php endif; ?>
												<?php if($workpack['receiver_date']): ?>
													<!-- <img src="data:image/png;base64,<?= $user_list[$workpack['receiver_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' /> -->
												<?php elseif($workpack['status_approval'] == 5 && $workpack['pic_assigned'] == $this->user_cookie[0]): ?>
													<!-- <a href="<?php echo base_url() ?>planning/workpack_receive_process/<?php echo encrypt($workpack['id']) ?>" class="btn btn-sm btn-flat btn-success" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Approve&nbsp;</b> this?', this, event)"><i class="fas fa-check"></i> Receive</a> -->
													<!-- <select class="form-control select2-receiver" name="receiver_by"></select>
													<button type="button" class="btn btn-sm btn-flat btn-success" onclick="save_receiver()"><i class="fas fa-save"></i> Receive</button> -->
												<?php endif; ?>
											</td>
										</tr>
										<tr>
											<td><b><?= @$user_list[$workpack['submitted_by']]['full_name'] ?></b></td>
											<td><b><?= @$user_list[$workpack['approval_by']]['full_name'] ?></b></td>
											<td><b><?= @$user_list[$workpack['superintendent_by']]['full_name'] ?></b></td>
											<td><b><?= @$user_list[$receiver_workpack['pic']]['full_name'] ?></b></td>
										</tr>
										<tr>
											<td><b>Date : </b><?= @$workpack['submitted_date'] ?></td>
											<td><b>Date : </b><?= @$workpack['approval_date'] ?></td>
											<td><b>Date : </b><?= @$workpack['superintendent_date'] ?></td>
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
													foreach ($detail_list as $value) {
														if(($value['progress_mv'] != 100 && $workpack['phase'] == 'PF') || ($value['progress_fu'] != 100 && $value['progress_vt'] != 100 && $workpack['phase'] != 'PF')){
															$iscomplete = 0;
														}
													}
													foreach ($workpack_subactivity_list as $workpack_subactivity) {
														foreach ($workpack_subactivity as $value) {
															if(!in_array($value['activity'], $this->exception_activity) && $value['progress'] != 100){
																$iscomplete = 0;
															}
														}
													}
												?>
												<?php if($workpack['status_return'] == 0 AND $iscomplete == 1 && $this->permission_cookie[17] == 1): ?>
													<button type="button" class="btn btn-sm btn-flat btn-success" onclick="approval_return_cnc(1)">
														<i class="fas fa-check"></i> Return Workpack
													</button>
													<!-- <button type="button" class="btn btn-sm btn-flat btn-danger" onclick="approval_return_cnc(0)">
														<i class="fas fa-times"></i> Reject
													</button> -->
												<?php elseif($workpack['return_coor_date']): ?>
													<img src="data:image/png;base64,<?= $user_list[$workpack['return_coor_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
												<?php endif; ?>
											</td>
											<td>
												<?php if($workpack['status_return'] == 1 && $workpack['approval_assigned'] == $this->user_cookie[0]): ?>
													<button type="button" class="btn btn-sm btn-flat btn-success" onclick="approval_return_cnc(3)">
														<i class="fas fa-check"></i> Approve
													</button>
													<button type="button" class="btn btn-sm btn-flat btn-danger" onclick="approval_return_cnc(2)">
														<i class="fas fa-times"></i> Reject
													</button>
												<?php elseif($workpack['return_cons_date']): ?>
													<img src="data:image/png;base64,<?= $user_list[$workpack['return_cons_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
												<?php endif; ?>
											</td>
											<td>
												<?php if($workpack['status_return'] == 3 && $workpack['superintendent_assigned'] == $this->user_cookie[0]): ?>
													<button type="button" class="btn btn-sm btn-flat btn-success" onclick="approval_return_cnc(5)">
														<i class="fas fa-check"></i> Approve
													</button>
													<button type="button" class="btn btn-sm btn-flat btn-danger" onclick="approval_return_cnc(4)">
														<i class="fas fa-times"></i> Reject
													</button></a>
												<?php elseif($workpack['return_superin_date']): ?>
													<img src="data:image/png;base64,<?= $user_list[$workpack['return_superin_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
												<?php endif; ?>
											</td>
											<td>
											</td>
										</tr>
										<tr>
											<td><b><?= @$user_list[$workpack['return_coor_by']]['full_name'] ?></b></td>
											<td><b><?= @$user_list[$workpack['return_cons_by']]['full_name'] ?></b></td>
											<td><b><?= @$user_list[$workpack['return_superin_by']]['full_name'] ?></b></td>
											<td></td>
										</tr>
										<tr>
											<td><b>Date : </b><?= @$workpack['return_coor_date'] ?></td>
											<td><b>Date : </b><?= @$workpack['return_cons_date'] ?></td>
											<td><b>Date : </b><?= @$workpack['return_superin_date'] ?></td>
											<td></td>
										</tr>
									</table>
									<hr>
									
									<?php if($workpack['phase'] == 'PF'): ?>
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
												<?php if($workpack['sender_cnc_by']){ ?>
													<img src="data:image/png;base64,<?= $user_list[$workpack['sender_cnc_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
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
														if($receiver_workpack['start_date']){
															$receive = 1;
														}
														if($receive==1){ 
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
												<?php if(
													$workpack['status_receiver_cnc'] == 1
													AND (
														$workpack['receiver_cnc_by'] == $this->user_cookie[0]
														OR 
														$this->permission_cookie[0] == 1
													)
												): ?>
													<button type="button" class="btn btn-sm btn-flat btn-success" onclick="approval_receive_cnc(3)">
														<i class="fas fa-check"></i> Receive
													</button>
													<!-- <button type="button" class="btn btn-sm btn-flat btn-danger" onclick="approval_receive_cnc(2)">
														<i class="fas fa-times"></i> Reject
													</button> -->
												<?php elseif($workpack['receiver_cnc_date']): ?>
													<img src="data:image/png;base64,<?= $user_list[$workpack['receiver_cnc_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
												<?php endif; ?>
											</td>
											<td>
												<?php if(
													$workpack['status_receiver_excess_cnc'] == 1
													AND (
														$workpack['receiver_cnc_excess_by'] == $this->user_cookie[0]
														OR 
														$this->permission_cookie[0] == 1
													)
												): ?>
													<button type="button" class="btn btn-sm btn-flat btn-success" onclick="approval_receive_cnc_excess(3)">
														<i class="fas fa-check"></i> Receive
													</button>
													<!-- <button type="button" class="btn btn-sm btn-flat btn-danger" onclick="approval_receive_cnc(2)">
														<i class="fas fa-times"></i> Reject
													</button> -->
												<?php elseif($workpack['receiver_cnc_excess_date']): ?>
													<img src="data:image/png;base64,<?= $user_list[$workpack['receiver_cnc_excess_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
												<?php endif; ?>
											</td>
											<td></td>
										</tr>
										<tr>
											<td><b><?= @$user_list[$workpack['sender_cnc_by']]['full_name'] ?></b></td>
											<td><b><?= @$user_list[$workpack['receiver_cnc_by']]['full_name'] ?></b></td>
											<td><b><?= @$user_list[$workpack['receiver_cnc_excess_by']]['full_name'] ?></b></td>
											<td></td>
										</tr>
										<tr>
											<td><b>Date : </b><?= @$workpack['sender_cnc_date'] ?></td>
											<td><b>Date : </b><?= @$workpack['receiver_cnc_date'] ?></td>
											<td><b>Date : </b><?= @$workpack['receiver_cnc_excess_date'] ?></td>
											<td></td>
										</tr>
									</table>
									<?php endif; ?>
									<hr>
								<?php elseif($workpack['type'] == 3): ?>
									<table class="table table-sm table-borderless">
										<tr>
											<td width="25%"><b>Workpack Coordinator</b></td>
											<td width="25%"><b>Project Engineering / Construction Engineering</b></td>
											<?php if(@$workpack['superintendent_assigned'] != ''): ?>
											<td width="25%"><b>Construction Superintendent</b></td>
											<?php endif; ?>
										</tr>
										<tr>
											<td>
												<?php if($workpack['submitted_date']): ?>
													<img src="data:image/png;base64,<?= $user_list[$workpack['submitted_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
												<?php endif; ?>
											</td>
											<td>
												<?php if($workpack['status_approval'] == 1 && $workpack['approval_assigned'] == $this->user_cookie[0]): ?>
													<button type="button" class="btn btn-sm btn-flat btn-danger" onclick="sweetalert('confirm_remarks', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Reject&nbsp;</b> this?', this, event, 'reject_workpack')"><i class="fas fa-times"></i> Reject</button>
													<a href="<?php echo base_url() ?>planning/workpack_approval_process/<?php echo strtr($this->encryption->encrypt($workpack['id'] . ";3"), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-success" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Approve&nbsp;</b> this?', this, event)"><i class="fas fa-check"></i> Approvess</a>
												<?php elseif($workpack['approval_date']): ?>
													<img src="data:image/png;base64,<?= $user_list[$workpack['approval_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
												<?php endif; ?>
											</td>
											<?php if(@$workpack['superintendent_assigned'] != ''): ?>
											<td>
												<?php if($workpack['status_approval'] == 3 && $workpack['superintendent_assigned'] == $this->user_cookie[0]): ?>
													<button type="button" class="btn btn-sm btn-flat btn-danger" onclick="sweetalert('confirm_remarks', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Reject&nbsp;</b> this?', this, event, 'reject_workpack_superintendent')"><i class="fas fa-times"></i> Reject</button>
													<a href="<?php echo base_url() ?>planning/workpack_approval_process/<?php echo strtr($this->encryption->encrypt($workpack['id'] . ";5"), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-success" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Approve&nbsp;</b> this?', this, event)"><i class="fas fa-check"></i> Approves</a>
												<?php elseif($workpack['superintendent_date']): ?>
													<img src="data:image/png;base64,<?= $user_list[$workpack['superintendent_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
												<?php endif; ?>
											</td>
											<?php endif; ?>
										</tr>
										<tr>
											<td><b><?= @$user_list[$workpack['submitted_by']]['full_name'] ?></b></td>
											<td><b><?= @$user_list[$workpack['approval_by']]['full_name'] ?></b></td>
											<?php if(@$workpack['superintendent_assigned'] != ''): ?>
											<td><b><?= @$user_list[$workpack['superintendent_by']]['full_name'] ?></b></td>
											<?php endif; ?>
										</tr>
										<tr>
											<td><b>Date : </b><?= @$workpack['submitted_date'] ?></td>
											<td><b>Date : </b><?= @$workpack['approval_date'] ?></td>
											<?php if(@$workpack['superintendent_assigned'] != ''): ?>
											<td><b>Date : </b><?= @$workpack['superintendent_date'] ?></td>
											<?php endif; ?>
										</tr>
									</table>
									<hr>
								<?php endif; ?>

								<div class="row">
                  <div class="col-md-6">
										<div class="form-group">
											<label class="font-weight-bold">Reject Remarks</label>
											<textarea rows="3" class="form-control" readonly><?php echo $workpack['reject_remarks'] ?></textarea>
										</div>
									</div>
								</div>
								<hr>
                <div class="row">
                  <div class="col-md-auto">
                    <?php
                    if ($workpack['status_return'] == 5) {
                      echo " Status: <b class='font-weight-bold text-success'>Completed</b>";
                    } elseif ($workpack['status_return'] == 4) {
                      echo " Status: <b class='font-weight-bold text-success'>Rejected Construction Superintendent</b>";
                    } elseif ($workpack['status_return'] == 3) {
                      echo " Status: <b class='font-weight-bold text-success'>Pending Approval Construction Superintendent</b>";
                    } elseif ($workpack['status_return'] == 2) {
                      echo " Status: <b class='font-weight-bold text-success'>Rejected Project Engineering / Construction Engineering</b>";
                    } elseif ($workpack['status_return'] == 1) {
                      echo " Status: <b class='font-weight-bold text-success'>Pending Approval Project Engineering / Construction Engineering</b>";
                      
                    } elseif ($workpack['status_approval'] == 4) {
                      echo " Status: <b class='font-weight-bold text-danger'>Rejected Construction Superintendent</b>";
                    } elseif ($workpack['status_approval'] == 3) {
                      echo " Status: <b class='font-weight-bold text-primary'>Pending Approval Construction Superintendent</b>";
                    } elseif ($workpack['status_approval'] == 2) {
                      echo " Status: <b class='font-weight-bold text-danger'>Rejected Project Engineering / Construction Engineering</b>";
                    } elseif ($workpack['status_approval'] == 1) {
                      echo " Status: <b class='font-weight-bold text-primary'>Pending Approval Project Engineering / Construction Engineering</b>";
                    } elseif ($workpack['status_approval'] == 0) {
                      echo " Status: <b class='font-weight-bold text-secondary'>Draft</b>";
                    } elseif ($workpack['status'] == 1 || $workpack['status'] == 2) {
                      echo " Status: <b class='font-weight-bold text-info'>Issued</b>";
                    }
                    ?>
                  </div>
                  <div class="col-md">
                    <div class="text-right">
                      <?php if ($pdf == 1) : ?>
                        <?php
                        if ($this->user_cookie[12] == getenv('IP_FIREWALL_GATEWAY')) {
                          $url_pdf = getenv('LINK_WAREHOUSE_OUTSIDE');
                        } else {
                          $url_pdf = getenv('LINK_WAREHOUSE');
                        }
                        ?>
                        <?php if (in_array($workpack['phase'], ['PF', 'ITR'])) : ?>
                          <!-- <a target="_blank" href="<?php echo $url_pdf ?>/mb/mis_pdf/<?php echo strtr($this->encryption->encrypt($mis['uniq_data']), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt($mis['issued_status']), '+=/', '.-~') ?>?user=<?php echo strtr($this->encryption->encrypt($this->user_cookie[0]), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-dark"><i class="fas fa-file-pdf"></i> MIS PDF</a> -->
                        <?php endif; ?>
                        <a target="_blank" href="<?php echo base_url() ?>planning/workpack_pdf/<?php echo strtr($this->encryption->encrypt($workpack['id']), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-danger"><i class="fas fa-file-pdf"></i> Workpack PDF</a>
                      <?php endif; ?>

											<?php if ($workpack['transmit_eng_status'] == 0 && $this->permission_cookie[17] == 1) : ?>

												<?php if (in_array($workpack['status_approval'], [0, 2, 4])) : ?>
													<!-- <a href="<?php echo base_url() ?>planning/workpack_delete_process/<?php echo strtr($this->encryption->encrypt($workpack['id']), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-danger" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Delete&nbsp;</b> this?', this, event)"><i class="fas fa-trash"></i> Delete</a> -->
													<button type="submit" class="btn btn-sm btn-flat btn-success" name="status" value="0"><i class="fas fa-save"></i> Save as Draft</button>
													<?php if (($workpack['location_v2'] != "" && $workpack['type'] == 1) || ($workpack['description'] != "" && $workpack['type'] == 3)) : ?>
														<?php if (in_array($workpack['phase'], ['PF', 'ITR']) && $workpack['type'] == 1) : ?>
															<?php if (in_array($workpack['project'], [17])) : ?>
																<a href="<?php echo base_url() ?>planning/workpack_transmit_eng_process/1/<?php echo strtr($this->encryption->encrypt($workpack['id']), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-primary" onclick="sweetalert('confirm', 'Are you sure?', this, event)"><i class="fas fa-check"></i> Transmit to Engineering</a>
															<?php else : ?>
																<a href="<?php echo base_url() ?>planning/workpack_transmit_eng_process/2/<?php echo strtr($this->encryption->encrypt($workpack['id']), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-primary" onclick="sweetalert('confirm', 'Are you sure?', this, event)"><i class="fas fa-check"></i> Transmit to PE</a>
															<?php endif; ?>
														<?php endif; ?>
														<?php if(($workpack['return_from_eng_by'] != '' && $workpack['phase'] == 'PF') || ($workpack['phase'] != 'PF') || $workpack['type'] == 3): ?>
															<a href="<?php echo base_url() ?>planning/workpack_approval_process/<?php echo strtr($this->encryption->encrypt($workpack['id'] . ";1"), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-info" onclick="sweetalert('confirm', 'Are you sure?', this, event)"><i class="fas fa-check"></i> Request for Issueds</a>
														<?php endif; ?>
													<?php endif; ?>

												<?php elseif ($workpack["revise_id"] == "" && $workpack["status"] == 1) : ?>
													<?php if($workpack['phase'] == 'PF'): ?>
														<a href="<?php echo base_url() ?>planning/request_change_unique/<?php echo strtr($this->encryption->encrypt($workpack['id']), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-primary"><i class="fas fa-edit"></i> Request for Update Unique</a>
													<?php endif; ?>
													<button type="button" class="btn btn-sm btn-flat btn-info" onclick="sweetalert('confirm_remarks', 'Are you sure to <b class=&#34;text-info&#34;>&nbsp;Request&nbsp;</b> this?', this, event, 'request_update')"><i class="fas fa-edit"></i> Request for Update Workpack</button>
												<?php endif; ?>

												<?php if ($method == 'revise') : ?>
													<button type="submit" class="btn btn-sm btn-flat btn-warning" name="status" value="0"><i class="fas fa-edit"></i> Update</button>
												<?php endif; ?>
												<?php if (count($detail_list) == 0 && $workpack['status'] == 1 && in_array($workpack['phase'], ['PF', 'FB', 'AS', 'ER', 'ITR', 'BAA'])) : ?>
													<button type="button" class="btn btn-sm btn-flat btn-dark" onclick="sweetalert('confirm_remarks', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Void&nbsp;</b> this?', this, event, 'request_void')"><i class="fas fa-times"></i> Void Workpack</button>
												<?php endif; ?>

                      <?php else: ?>
												<b class='font-weight-bold text-info'>Waiting from <?= $workpack['transmit_eng_target'] == 2 ? 'PE' : 'Engineering' ?></b>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </form>
    </div>
		<?php if ($workpack['type'] == 1) : ?>
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
		<?php endif; ?>

    <?php if ($workpack['type'] == 3) : ?>
      <div class="tab-pane fade" id="pills-attachment" role="tabpanel" aria-labelledby="pills-attachment-tab">
        <div class="row">
          <div class="col-md-12">
            <div id="con_workpack_grade" class="card shadow my-3 rounded-0">
              <div class="card-header">
                <h6 class="m-0">Attachments</h6>
              </div>
              <div class="card-body bg-white overflow-auto">
                <form id="form_workpack_attachment_new_process" method="POST" action="<?php echo base_url() ?>planning/workpack_attachment_new_process" enctype="multipart/form-data">
                  <input form="form_workpack_attachment_new_process" type="hidden" class="form-control" name="id_workpack" value="<?php echo @$workpack['id'] ?>">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">File</label>
                        <div class="col-xl">
                          <div class="custom-file">
                            <input form="form_workpack_attachment_new_process" type="file" name="attachment_file" class="custom-file-input">
                            <label id="label_cp" class="custom-file-label">Choose file</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Remarks</label>
                        <div class="col-md">
                          <input form="form_workpack_attachment_new_process" type="text" class="form-control" name="attachment_remarks">
                        </div>
                      </div>
                    </div>
                  </div>
                  <input form="form_workpack_attachment_new_process" type="submit" class="btn btn-sm btn-flat btn-success" value="Upload">
                  <br>
                  <br>
                </form>
                <table id="tbl_grade" class="table table-bordered text-center">
                  <thead class="bg-green-smoe text-white">
                    <tr>
                      <th>File</th>
                      <th>Upload by</th>
                      <th>Upload Date</th>
                      <th>Remarks</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($workpack_attachment_list as $key => $value) : ?>
                      <tr>
                        <td><a href="<?php echo base_url() . 'planning/open_wo_atc/' . $value['attachment'] . '/' . $value['attachment'] ?>" target="_blank" class="btn btn-sm btn-flat btn-dark"><i class="fas fa-file-alt"></i></a></td>
                        <td><?php echo @$user_list[$value['created_by']]['full_name'] ?></td>
                        <td><?php echo $value['created_date'] ?></td>
                        <td><?php echo $value['remarks'] ?></td>
                        <td>
                          <?php if (($workpack['status'] == 0 && in_array($workpack['status_approval'], [0, 2, 4])) || $method == 'revise') : ?>
                            <a href="<?php echo base_url() ?>planning/workpack_attachment_delete_process/<?php echo strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-danger" onclick="sweetalert('confirm', 'Are you sure?', this, event)"><i class='fas fa-times'></i></a>
                          <?php endif; ?>
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
    <?php endif; ?>
  </div>

</div>
</div>
<script>

  function approval_return_cnc(status_return_cnc){
    var column = ''
    if(status_return_cnc==1){
      var title = 'Are you sure to Approve this Handover?'
      var column = 'return_coor'
    } else if(status_return_cnc==0){
      var title = 'Are you sure to Reject this Handover?'
      var column = 'return_coor'
    } else if(status_return_cnc==3){
      var title = 'Are you sure to Approve this Handover?'
      var column = 'return_cons'
    } else if(status_return_cnc==2){
      var title = 'Are you sure to Reject this Handover?'
      var column = 'return_cons'
    } else if(status_return_cnc==5){
      var title = 'Are you sure to Approve this Handover?'
      var column = 'return_superin'
    } else if(status_return_cnc==4){
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
            'id' : "<?= $workpack['id'] ?>", 
            'status_return': status_return_cnc,
            'column': column,
          },
          success: function(data){
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

  function approval_receive_cnc(status_receiver_cnc){
    if(status_receiver_cnc==3){
      var title = 'Are you sure to Approve this Handover?'
    } else {
      var title = 'Are you sure to Reject this Handover?'
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
          url: "<?= base_url('planning/approval_receive_cnc/') ?>",
          type: "post",
          data: {
            'receiver_cnc_by': $('.select2-receiver_cnc[name=receiver_cnc_by]').val(),
            'id' : "<?= $workpack['id'] ?>", 
            'status_receiver_cnc': status_receiver_cnc,
          },
          success: function(data){
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

	function approval_receive_cnc_excess(status_receiver_cnc){
    if(status_receiver_cnc==3){
      var title = 'Are you sure to Approve this Handover?'
    } else {
      var title = 'Are you sure to Reject this Handover?'
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
          url: "<?= base_url('planning/approval_receive_cnc_excess/') ?>",
          type: "post",
          data: {
            'receiver_cnc_by': $('.select2-receiver_cnc[name=receiver_cnc_excess_by]').val(),
            'id' : "<?= $workpack['id'] ?>", 
            'status_receiver_excess_cnc': status_receiver_cnc,
          },
          success: function(data){
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

  function send_from_cnc(){
		sweetalert('loading', 'Loading....');
    Swal.fire({
      title: 'Are you sure to Send this Workpack!',
      text: "Your Name Will Be Appear As Sender!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Update this date!'
    }).then((result) => {

      if (result.value) {
        $.ajax({
          url: "<?= base_url('planning/send_from_cnc/') ?>",
          type: "post",
          data: {
            'receiver_cnc_by': $('.select2-receiver_cnc[name=receiver_cnc_by]').val(),
            'receiver_cnc_excess_by': $('.select2-receiver_cnc[name=receiver_cnc_excess_by]').val(),
            'id' : "<?= $workpack['id'] ?>", 
            'status': status,
          },
          success: function(data){
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

	$(function() {
		$("select[name=module]").chained("select[name=project]");
	
		$('.dataTable').DataTable({
			order: [],
			columnDefs: [{
				"targets": 0,
				"orderable": false,
			}]
		})
	
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
		
		$('.select2-receiver').select2({
			ajax: {
				delay: 250,
				dataType: 'json',
				url: '<?= base_url() ?>planning/search_receiver',
				data: function (params) {
					var query = {
						search: params.term,
					}
					return query;
				}
			}
		});

    $('.select2-receiver_cnc').select2({
			placeholder: 'Select Receiver Part ID',
      ajax: {
        delay: 250,
        dataType: 'json',
        url: '<?= base_url() ?>planning/autocomplete_receiver_cnc',
        data: function (params) {
          var query = {
            search: params.term,
          }
          return query;
        },
        processResults: function (response) {
          return {
            results:response
          };
        },

      }
    });
	})

  $(document).ready(function() {
    $("select[name=location_v2]").chained("select[name=area_v2]");
    <?php if ($method == 'revise') : ?>
      // $('input[name="job_description[]"]').prop("disabled", true);
      // $('#con_work_date input').prop("disabled", true);
      // $('#con_manhours_budget').find('input, select, button').prop("disabled", true);
    <?php endif; ?>
  })

  var added_piecemark = [];

  function add_detail() {
    <?php if (in_array($workpack['phase'], ['PF', 'ITR'])) : ?>
      var html = "<tr>" +
        "<input type='hidden' name='id_detail[]' class='form-control' value=''>" +
        "<input type='hidden' name='id_template[]' class='form-control' value=''>" +
        "<td></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td><input type='text' class='form-control autocomplete_detail' value=''></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td><button class='btn btn-sm btn-flat btn-danger' type='button' onclick='$(this).closest(\"tr\").remove();'><i class='fas fa-times'></i></button></td>" +
        "</tr>";
    <?php elseif ($workpack['phase'] != "") : ?>
      var html = "<tr>" +
        "<input type='hidden' name='id_detail[]' class='form-control' value=''>" +
        "<input type='hidden' name='id_template[]' class='form-control' value=''>" +
        "<td></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td><input type='text' class='form-control autocomplete_detail' value=''></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td><button class='btn btn-sm btn-flat btn-danger' type='button' onclick='$(this).closest(\"tr\").remove();'><i class='fas fa-times'></i></button></td>" +
        "</tr>";
    <?php endif; ?>
    $("#tbl_detail tbody").append(html);

    $("#tbl_detail tbody tr:last .autocomplete_detail").autocomplete({
      source: function(request, response) {
        $.ajax({
          url: "<?php echo base_url() ?>planning/autocomplete_detail/",
          dataType: "json",
          data: {
            term: request.term,
            type: <?php echo $workpack["type"] ?>,
            phase: '<?php echo $workpack["phase"] ?>',
            discipline: <?php echo $workpack["discipline"] ?>,
            module: <?php echo $workpack["module"] ?>,
            project: <?php echo $workpack["project"] ?>,
            type_of_module: <?php echo $workpack["type_of_module"] ?>,
            deck_elevation: <?php echo @$workpack["deck_elevation"] + 0 ?>,
            drawing_no: '<?php echo $workpack["drawing_no"] ?>',
            test_pack_no: '<?php echo $workpack["test_pack_no"] ?>',
            desc_assy: <?php echo $workpack["desc_assy"] + 0 ?>,
            status_internal: <?php echo $workpack["status_internal"] ?>,
            piping_testing_category: <?php echo $workpack["piping_testing_category"] ?>,
            added_piecemark: added_piecemark.join(", "),
          },
          success: function(data) {
            response(data);
          }
        });
      },
      select: function(event, ui) {
        added_piecemark.push(ui.item.id);
        $(event.target).prop("readonly", true);
        $(event.target).closest("tr").find("input[name='id_template[]']").val(ui.item.id);
        $(event.target).closest("tr").find("input[name='length[]']").val(ui.item.length_m);
      }
    })
  }

  function delete_detail_wp(btn) {
    added_piecemark.splice($.inArray($(btn).closest("tr").find("input[name='id_template[]']").val(), added_piecemark), 1);
    $(btn).closest("tr").remove();
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
          sweetalert("success", "Delete Data Success!");
          $(btn).closest("tr").remove();
        }
      }
    });
  }

  function return_detail_wp_db(btn, remarks) {
    $.ajax({
      url: "<?php echo base_url() ?>planning/detail_return_process",
      data: {
        id: $(btn).data("id"),
        type: <?php echo $workpack['type'] ?>,
        phase: '<?php echo $workpack['phase'] ?>',
        remarks: remarks,
      },
      type: 'post',
      success: function(data) {
        if (data.includes('Error') == true) {
          sweetalert("error", data);
        } else {
          sweetalert("success", "Return Data Success!");
          $(btn).closest("td").html('<span class="badge badge-warning">Pending Approval Return by QC</span>');
        }
      }
    });
  }

  function reject_workpack(btn, remarks) {
    var link = '<?php echo base_url() ?>planning/wo_bnp_issued_process/<?php echo strtr($this->encryption->encrypt($workpack['id'] . ";2"), '+=/', '.-~') ?>'
    window.location = link + '?remarks=' + remarks;
  }

  function reject_workpack_superintendent(btn, remarks) {
    var link = '<?php echo base_url() ?>planning/wo_bnp_issued_process/<?php echo strtr($this->encryption->encrypt($workpack['id'] . ";4"), '+=/', '.-~') ?>'
    window.location = link + '?remarks=' + remarks;
  }

  function request_update(btn, remarks) {
    var link = '<?php echo base_url() ?>planning/revise_history_new_process/<?php echo strtr($this->encryption->encrypt($workpack['id'] . ";" . $workpack['workpack_no']), '+=/', '.-~') ?>'
    window.location = link + '?remarks=' + remarks;
  }

  function request_void(btn, remarks) {
    var link = '<?php echo base_url() ?>planning/void_request_process/<?php echo strtr($this->encryption->encrypt($workpack['id'] . ";" . $workpack['workpack_no']), '+=/', '.-~') ?>'
    window.location = link + '?remarks=' + remarks;
  }

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

  function add_paint() {
    var html = "<tr>" +
      "<td>" +
      "<input type='text' class='form-control text-center' value='' name='paint_material[]' required>" +
      "<input type='hidden' value='' name='paint_id[]' required>" +
      "</td>" +
      "<td><input type='text' class='form-control text-center' value='' name='paint_description[]'></td>" +
      "<td><input type='number' class='form-control text-center' value='' name='paint_area[]'></td>" +
      "<td><input type='number' class='form-control text-center' value='' name='paint_volume[]'></td>" +
      "<td><input type='number' class='form-control text-center' value='' name='paint_dft[]'></td>" +
      "<td><input type='number' class='form-control text-center' value='' name='paint_wft[]'></td>" +
      "<td><input type='text' class='form-control text-center' value='' name='paint_remarks[]'></td>" +
      "<td><button class='btn btn-sm btn-flat btn-danger' type='button' onclick='delete_paint(this)'><i class='fas fa-times'></i></button></td>" +
      "</tr>";
    $("#tbl_paint").append(html);
  }

  function delete_paint(btn) {
    $(btn).closest("tr").remove();
  }

  function delete_paint_db(btn, id) {
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
          url: "<?php echo base_url() ?>planning/painting_delete_process",
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

  function add_cons() {
    var html = "<tr>" +
      "<td><input type='text' class='form-control text-center' value='' name='cons_name[]' required></td>" +
      "<td><input type='number' class='form-control text-center' value='' name='cons_qty[]' required></td>" +
      "<td><input type='text' class='form-control text-center' value='' name='cons_uom[]' required></td>" +
      "<td><button class='btn btn-sm btn-flat btn-danger' type='button' onclick='delete_cons(this)'><i class='fas fa-times'></i></button></td>" +
      "</tr>";
    $("#tbl_cons").append(html);
  }

  function delete_cons(btn) {
    $(btn).closest("tr").remove();
  }

  function delete_cons_db(btn, id) {
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
          url: "<?php echo base_url() ?>planning/consumable_delete_process",
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

  function add_grade() {
    var html = "<tr>" +
      "<td>" +
      "<select class='form-control select2' name='grade_name[]' required>" +
      "<option value=''>---</option>" +
      <?php foreach ($material_grade_list as $key => $value) : ?> "<option value='<?php echo $value['id'] ?>'><?php echo $value['material_grade'] ?></option>" +
      <?php endforeach; ?> "</select>" +
      "</td>" +
      "<td><button class='btn btn-sm btn-flat btn-danger' type='button' onclick='delete_grade(this)'><i class='fas fa-times'></i></td>" +
      "</tr>";
    $("#tbl_grade").append(html);
    $('#tbl_grade select.select2').select2({
      theme: 'bootstrap'
    });
  }

  function delete_grade(btn) {
    $(btn).closest("tr").remove();
  }

  function delete_grade_db(btn, id) {
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
          url: "<?php echo base_url() ?>planning/workpack_grade_delete_process",
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

  function delete_manhours(btn) {
    $(btn).closest("tr").remove();
    calc_manhours_total();
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

  function calc_qty_total() {
    var total_all = 0;
    $("input[name='qty[]']").each(function(index) {
      total_all = total_all + parseInt($(this).val());
    })
    $("input[name=total_qty]").val(total_all);
  }

  function calc_area_total() {
    var total_all = 0;
    $("input[name='area[]']").each(function(index) {
      total_all = total_all + parseInt($(this).val());
    })
    $("input[name=total_area]").val(total_all);
  }

  function change_jobdesc(input) {
    if ($(input).val() == "Fitup" || $(input).val() == "Welding") {
      $("input[name='job_description[]'][value=Fitup], input[name='job_description[]'][value=Welding]").prop("checked", $(input).prop("checked"))
    }
  }

	function save_receiver() {
		const receiver = $('.select2-receiver').find(":selected").val();
		if(receiver !== undefined){
			sweetalert("loading", "Please Wait...");
			let link = '<?php echo base_url() ?>planning/save_receiver_process/<?php echo encrypt($workpack['id']) ?>/'+receiver;
			window.location = link;
		}
	}

  $("#form_workpack_update_process").submit(function(e) {
    sweetalert("loading", "Please Wait...");
    <?php if (@$workpack['type'] == 1) : ?>
      if ($("#form_workpack_update_process input[name='job_description[]']:checked").length == 0) {
        sweetalert("error", "Please tick one of job description");
        e.preventDefault();
      }
    <?php endif; ?>
  });

  $("#form_workpack_attachment_new_process").submit(function(e) {
    sweetalert("loading", "Please Wait...");
  });

  function change_is_equipment(select) {
    $('.tp_info').attr('disabled', true)
    $('.tp_info').val('').trigger('change')

    if(select.value == 1) {
      $('.tp_info').removeAttr('disabled')
    }

  }
  
  <?php if(isset($user_company_json)): ?>
    var user_third_party = <?= json_encode($user_company_json) ?>;
    
    function change_id_third_party(select) {

      $('select[name="id_third_party"]').html('<option value="">---</option>')
      if(typeof(user_third_party[select.value]) !== "undefined") {
        $('select[name="id_third_party"]').append(user_third_party[select.value])

      }
    }
  <?php endif; ?>
</script>