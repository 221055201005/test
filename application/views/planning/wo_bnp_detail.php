<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-body bg-white px-4 pt-4 pb-0">
          <h1 class="font-weight-bold text-center"><?php echo ($workpack['workpack_no'] == "" ? "----" : $workpack['workpack_no']) ?></h1>
          <br>
          <?php if ($workpack['type'] == 3) : ?>
            <div class="row" style="margin-left: -25px; margin-right: -25px;">
              <div class="col-md-12 p-0">
                <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <a class="rounded-0 nav-link active" id="pills-detail-tab" data-toggle="pill" href="#pills-detail" role="tab" aria-controls="pills-detail" aria-selected="true" title="Umum">Detail Information</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="rounded-0 nav-link" id="pills-attachment-tab" data-toggle="pill" href="#pills-attachment" role="tab" aria-controls="pills-attachment" aria-selected="false">Attachment</a>
                  </li>
                </ul>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-detail" role="tabpanel" aria-labelledby="pills-detail-tab">
      <form id="form_workpack_update_process" method="POST" action="<?php echo base_url() ?>planning/wo_bnp_update_process">
        <input type="hidden" class="form-control" name="id" value="<?php echo @$workpack['id'] ?>">
        <input type="hidden" class="form-control" name="project" value="<?php echo @$workpack['project'] ?>">
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
                      <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Assigned Company</label>
                      <div class="col-md">
                        <select class="form-control select2" name="company_id" required>
                          <option value="">---</option>
                          <?php foreach ($company_list as $key => $value) : ?>
                            <?php if ($this->user_cookie[11] == 1 || $value['id_company'] == $this->user_cookie[11]) : ?>
                              <option value="<?php echo $value['id_company'] ?>" <?php echo (@$workpack['company_id'] == $value['id_company'] ? 'selected' : '') ?>><?php echo $value['company_name'] ?></option>
                            <?php endif; ?>
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
                            <?php if (in_array($value['id_company'], $this->user_cookie[14])) : ?>
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
                      <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Remarks</label>
                      <div class="col-md">
                        <textarea class="form-control" name="remarks"><?php echo @$workpack['remarks'] ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
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
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Budget manhours</label>
                  <div class="col-md">
                    <input type="number" class="form-control" name="budget_manhours" value="<?php echo $workpack['budget_manhours'] + 0 ?>" readonly>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- ADDITIONAL INFORMATION -->
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
              </div>
            </div>
          </div>
          <!-- END ADDITIONAL INFORMATION -->

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
                          <button class='btn btn-sm btn-flat btn-danger' type='button' onclick='delete_manhours_db(this, <?php echo $value["id"] ?>)'><i class='fas fa-times'></i></button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                <div class="text-right">
                  <button type="button" class="btn btn-sm btn-flat btn-success" onclick="add_manhours();"><i class="fas fa-plus"></i> Add</button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card shadow my-3 rounded-0">
              <div class="card-header">
                <h6 class="m-0">Activity List</h6>
              </div>
              <div class="card-body bg-white overflow-auto">
                <table class="table table-bordered text-center dataTable">
                  <thead class="bg-green-smoe text-white">
                    <tr>
                      <th>Paint System</th>
                      <th>Activity Description</th>
                      <th>Company Assigned</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($wo_activity_list as $key => $value) : ?>
                      <tr>
                        <td><?= $paint_system[$value['id_paint_system']]['code'] ?></td>
                        <td><?= $master_bnp_activity_list[$value['id_activity']]['description_of_activity'] ?></td>
                        <td>
                          <select class="form-control" onchange="update_company_peractivity('<?= $workpack['id'] ?>','<?= $value['id_paint_system'] ?>','<?= $value['id_activity'] ?>',this)">
                            <option value="">---</option>
                            <?php foreach ($company_list as $keyx => $valx) : ?>
                              <option value="<?php echo $valx['id_company'] ?>" <?php echo ($valx['id_company'] == $value['id_company'] ? 'selected' : (@$value['id_company'] == $valx['id_company'] ? 'selected' : '')) ?>><?php echo $valx['company_name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card shadow my-3 rounded-0">
              <div class="card-header">
                <h6 class="m-0">Material List</h6>
              </div>
              <div class="card-body bg-white overflow-auto">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <div class="col-md">
                        <select class="form-control js-data-example-ajax" name="add_unique_no[]" multiple>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                  </div>
                </div>
                <table class="table table-bordered text-center">
                  <thead class="bg-green-smoe text-white">
                    <tr>
                      <th>Unique No.</th>
                      <th>MRIR No.</th>
                      <th>DO / PL No.</th>
                      <th>Description</th>
                      <th>Paint System</th>
                      <th>Qty</th>
                      <th>Thk (mm)</th>
                      <th>Width (mm)</th>
                      <th>Length (mm)</th>
                      <th>Plate / Tag No.</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($material_list as $key => $value) : ?>
                      <tr>
                        <td><?= @$mb_list[$value['id_template']]['unique_ident_no'] ?></td>
                        <td><?= explode('/', @$mb_list[$value['id_template']]['report_no'])[1] ?></td>
                        <td><?= @$mb_list[$value['id_template']]['do_or_pl_no'] ?></td>
                        <td><?= @$mb_list[$value['id_template']]['description'] ?></td>
                        <td>
                          <select name='paint_system[<?= $value["id_template"] ?>][]' class='form-control select2_multiple_paint_system' multiple required>
                            <?php foreach ($paint_system as $key1 => $value1) : ?>
                              <option value='<?= $value1['id'] ?>' <?= in_array($value1['id'], $material_paint_system_list[$value["id_template"]]) ? 'selected' : '' ?>><?= $value1['code'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </td>
                        <td><input type='number' name='qty[<?= $value["id_template"] ?>]' class='form-control' value="<?= @$value['qty'] ?>" min="1" max="<?= (@$mb_list[$value['id_template']]['bal_qty'] + 0 > 0 ? @$mb_list[$value['id_template']]['bal_qty'] + 0 : 1) ?>" required></td>
                        <td><?= @$mb_list[$value['id_template']]['thk'] ?></td>
                        <td><?= @$mb_list[$value['id_template']]['width'] ?></td>
                        <td><?= @$mb_list[$value['id_template']]['length'] ?></td>
                        <td><?= @$mb_list[$value['id_template']]['plate_or_tag_no'] ?></td>
                        <td>
                          <a href="<?php echo base_url() ?>planning/wo_bnp_detail_delete_process/<?php echo strtr($this->encryption->encrypt($workpack['id']), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt($value['id_template']), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-danger" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Delete&nbsp;</b> this?', this, event)"><i class='fas fa-times'></i></a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- ASSIGN FORM -->
        <div class="col-md-12">
          <div class="row">
            <div class="col">
              <div class="card shadow my-3 rounded-0">
                <div class="card-header">
                  <h6 class="m-0"><?php echo $meta_title ?></h6>
                </div>
                <div class="card-body bg-white">
                  <table class="table table-sm table-borderless">
                    <tr>
                      <td width="25%"><b>Workpack Coordinator</b></td>
                      <td width="25%"><b>Project Engineering / Construction Engineering</b></td>
                      <td width="25%"><b>Construction Superintendent</b></td>
                    </tr>
                    <tr>
                      <td>
                        <?php if ($workpack['submitted_date']) : ?>
                          <img src="data:image/png;base64,<?= $user_list[$workpack['submitted_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
                        <?php endif; ?>
                      </td>
                      <td>
                        <?php if ($workpack['status_approval'] == 1 && $workpack['approval_assigned'] == $this->user_cookie[0]) : ?>
                          <button type="button" class="btn btn-sm btn-flat btn-danger" onclick="sweetalert('confirm_remarks', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Reject&nbsp;</b> this?', this, event, 'reject_workpack')"><i class="fas fa-times"></i> Reject</button>
                          <a href="<?php echo base_url() ?>planning/wo_bnp_issued_process/<?php echo strtr($this->encryption->encrypt($workpack['id'] . ";3"), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-success" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Approve&nbsp;</b> this?', this, event)"><i class="fas fa-check"></i> Approve</a>
                        <?php elseif ($workpack['approval_date']) : ?>
                          <img src="data:image/png;base64,<?= $user_list[$workpack['approval_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
                        <?php endif; ?>
                      </td>
                      <?php if (@$workpack['superintendent_assigned'] != '') : ?>
                        <td>
                          <?php if ($workpack['status_approval'] == 3 && $workpack['superintendent_assigned'] == $this->user_cookie[0]) : ?>
                            <button type="button" class="btn btn-sm btn-flat btn-danger" onclick="sweetalert('confirm_remarks', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Reject&nbsp;</b> this?', this, event, 'reject_workpack_superintendent')"><i class="fas fa-times"></i> Reject</button>
                            <a href="<?php echo base_url() ?>planning/wo_bnp_issued_process/<?php echo strtr($this->encryption->encrypt($workpack['id'] . ";5"), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-success" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Approve&nbsp;</b> this?', this, event)"><i class="fas fa-check"></i> Approve</a>
                          <?php elseif ($workpack['superintendent_date']) : ?>
                            <img src="data:image/png;base64,<?= $user_list[$workpack['superintendent_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
                          <?php endif; ?>
                        </td>
                      <?php endif; ?>
                    </tr>
                    <tr>
                      <td><b><?= @$user_list[$workpack['submitted_by']]['full_name'] ?></b></td>
                      <td><b><?= @$user_list[$workpack['approval_by']]['full_name'] ?></b></td>
                      <td><b><?= @$user_list[$workpack['superintendent_by']]['full_name'] ?></b></td>
                    </tr>
                    <tr>
                      <td><b>Date : </b><?= @$workpack['submitted_date'] ?></td>
                      <td><b>Date : </b><?= @$workpack['approval_date'] ?></td>
                      <td><b>Date : </b><?= @$workpack['superintendent_date'] ?></td>
                    </tr>
                  </table>
                  <hr>
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
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr>
        </div>
        <!-- END ASSIGN FORM -->
        <div class="text-right">
          <?php if ($workpack['status_approval'] == 0) : ?>
            <button type="submit" class="btn btn-sm btn-flat btn-warning" name="submit" value="0"><i class="fas fa-edit"></i> Update</button>
          <?php endif; ?>
          <?php if ($workpack['status_approval'] == 0 || $workpack['status_approval'] == 2 || $workpack['status_approval'] == 4) : ?>
            <a href="<?php echo base_url() ?>planning/wo_bnp_issued_process/<?php echo strtr($this->encryption->encrypt($workpack['id'] . ";1"), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-success" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Issued&nbsp;</b> this?', this, event)"><i class="fas fa-check"></i> Request for Issued</a>
          <?php endif; ?>
          <?php if ($workpack['status'] != 0) : ?>
            <a target='_blank' href="<?php echo base_url() ?>planning/wo_bnp_pdf/<?php echo strtr($this->encryption->encrypt($workpack['id']), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-danger"><i class="fas fa-file-pdf"></i> PDF</a>
          <?php endif; ?>
        </div>
      </form>
    </div>
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
                        <td><?php echo @$user_list[$value['created_by']] ?></td>
                        <td><?php echo $value['created_date'] ?></td>
                        <td><?php echo $value['remarks'] ?></td>
                        <td>
                          <a href="<?php echo base_url() ?>planning/workpack_attachment_delete_process/<?php echo strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-danger" onclick="sweetalert('confirm', 'Are you sure?', this, event)"><i class='fas fa-times'></i></a>
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
  $("select[name=module]").chained("select[name=project]");

  $('.dataTable').DataTable({
    order: [],
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

  $(document).ready(function() {
    $("select[name=location_v2]").chained("select[name=area_v2]");

    $('.js-data-example-ajax').select2({
      placeholder: 'Add New Unique No',
      ajax: {
        url: '<?= base_url() ?>planning/search_unique_no',
        data: function(params) {
          var query = {
            search: params.term,
            project_id: <?= $workpack['project'] ?>,
            discipline: <?= $workpack['discipline'] ?>,
            type_of_module: <?= $workpack['type_of_module'] ?>,
          }
          return query;
        },
        dataType: 'json',
      }
    });

    $(".select2_multiple_paint_system").select2({
      allowClear: true,
      tokenSeparators: [', ', ' '],
    })
  })

  var added_piecemark = [];

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

  function change_jobdesc(input) {
    if ($(input).val() == "Fitup" || $(input).val() == "Welding") {
      $("input[name='job_description[]'][value=Fitup], input[name='job_description[]'][value=Welding]").prop("checked", $(input).prop("checked"))
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

    if (select.value == 1) {
      $('.tp_info').removeAttr('disabled')
    }
  }

  function update_company_peractivity(id_workpack, id_paint_system, id_activity, input) {

    var id_company = $(input).val();

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
          url: "<?php echo base_url() ?>planning/save_update_company",
          data: {
            id_workpack: id_workpack,
            id_paint_system: id_paint_system,
            id_activity: id_activity,
            id_company: id_company,
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
          }
        });
      }
    })

  }
</script>