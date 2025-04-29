<?php

if (is_array($project_id)) {
  $project_filter = json_encode($project_id);
} else {
  $project_filter = $project_id;
}

if (is_array($company_id)) {
  $company_filter = json_encode($company_id);
} else {
  $company_filter = $company_id;
}

?>

<style>
  tr td input[type=text] {
    width: 300px !important;
  }

  th,
  td {
    vertical-align: middle !important;
  }

  #detail_card {
    font-size: 12px;
    margin-bottom: 5px;
  }

  .card-box {
    position: relative;
    color: #fff;
    padding: 1px 5px 2px;
    margin: 10px 0px;
    text-align: left;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  }

  .card-box:hover {
    text-decoration: none;
    color: #f1f1f1;
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
  }

  .card-box:hover .icon i {
    font-size: 100px;
    transition: 1s;
    -webkit-transition: 1s;
  }

  .card-box .inner {
    padding: 5px 10px 0 10px;
  }

  .card-box h3 {
    font-size: 17px;
    font-weight: bold;
    margin: 0 0 1px 0;
    white-space: nowrap;
    padding: 0;
    text-align: left;
  }

  .card-box p {
    font-size: 11px;
  }

  .card-box {
    border-radius: 3%;
  }

  table thead {
    position: sticky;
    top: 0;
    z-index: 999;
  }

  .card-box .icon {
    position: absolute;
    top: auto;
    bottom: 5px;
    right: 5px;
    z-index: 0;
    font-size: 50px;
    color: rgba(0, 0, 0, 0.15);
  }

  .card-box .card-box-footer {
    position: absolute;
    left: 0px;
    bottom: 0px;
    text-align: center;
    padding: 3px 0;
    color: rgba(255, 255, 255, 0.8);
    background: rgba(0, 0, 0, 0.1);
    width: 100%;
    text-decoration: none;
  }

  .card-box:hover .card-box-footer {
    background: rgba(0, 0, 0, 0.3);
  }

  .bg-blue {
    background-color: #0031d1 !important;
  }

  .bg-green {
    background-color: #00a65a !important;
  }

  .bg-orange {
    background-color: #f39c12 !important;
  }

  .bg-red {
    background-color: #d9534f !important;
  }

  .bg-red-2 {
    background-color: #b80000 !important;
  }

  table thead {
    position: sticky;
    top: 0;
    z-index: 999;
  }
</style>

<style>
  a[aria-expanded=true] .fa-angle-double-down {
    display: none;
  }

  a[aria-expanded=false] .fa-angle-double-up {
    display: none;
  }
</style>
<br />
<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div id="accordion">
          <div class="card shadow rounded-0">
            <div class="card-header">
              <a class="btn btn-primary" data-toggle="collapse" href="#collapseButton" role="button" aria-expanded="false" aria-controls="collapseButton">Filter - <?= $status_internal == 0 ? 'External' : 'Internal' ?> &nbsp; <i class="fas fa-angle-double-down"></i><i class="fas fa-angle-double-up"></i></a>
            </div>

            <div class="collapse <?= $this->input->post() ? 'show' : '' ?>" id="collapseButton">
              <div class="card-body">
                <form action="" id='form-filter' method="post">
                  <div class="row">

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted" required> Drawing Number (GA)</label>
                        <div class="col-xl">
                          <input type="text" name="drawing_no" class="form-control autocomplete_drawing" placeholder="Drawing No" value="<?= $drawing_no ? $drawing_no : '' ?>" >
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <hr>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted">Project ID</label>
                        <div class="col-xl">
                          <select name="project_id" class="custom-select" onchange="find_module_by_project(this)" required>
                            <option value="">---</option>
                            <?php foreach ($project_list as $key => $value) : ?>
                              <option value="<?= $value['id'] ?>" <?= $value['id'] == $project_id ? 'selected' : '' ?>>
                                <?= $value['project_name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted">Discipline</label>
                        <div class="col-xl">
                          <select name="discipline" class="custom-select">
                            <option value="">---</option>
                            <?php foreach ($discipline_list as $key => $value) : ?>
                              <option value="<?= $value['id'] ?>" <?= $value['id'] == $discipline ? 'selected' : '' ?>>
                                <?= $value['discipline_name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted">Module</label>
                        <div class="col-xl">
                          <select name="module" class="custom-select module">
                            <option value="">---</option>
                            <?php if (isset($module_list[$project_id])) : ?>
                              <?php foreach ($module_list[$project_id] as $key => $value) : ?>
                                <option value="<?= $value['mod_id'] ?>" <?= $value['mod_id'] == $module ? 'selected' : '' ?>>
                                  <?= $value['mod_desc'] ?></option>
                              <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted">Type of Module</label>
                        <div class="col-xl">
                          <select name="type_of_module" class="custom-select">
                            <option value="">---</option>
                            <?php foreach ($type_of_module as $key => $value) : ?>
                              <option value="<?= $value['id'] ?>" <?= $value['id'] == $type_module ? 'selected' : ''  ?>>
                                <?= $value['name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted">Drawing Type</label>
                        <div class="col-xl">
                          <select class="custom-select" name="drawing_type">
                            <option value="">---</option>
                            <?php foreach ($drawing_type_list as $key => $value) : ?>
                              <option value="<?= $value['id'] ?>" <?= $value['id'] == $drawing_type ? 'selected' : '' ?>><?= $value['description'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>


                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted">Submission Status</label>
                        <div class="col-xl">
                          <select name="status_submission" id="" class="custom-select" >
                            <option value="" <?= $status_submission == 0 ? 'selected' : '' ?>>---</option>
                            <option value="ready" <?= $status_submission && $status_submission == "ready" ? 'selected' : '' ?>>Ready</option>
                            <option value="rejected" <?= $status_submission && $status_submission == "rejected" ? 'selected' : '' ?>>Rejected
                            </option>
                            <option value="pending_by_qc" <?= $status_submission && $status_submission == "pending_by_qc" ? 'selected' : '' ?>>Pending
                              By QC</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <?php if ($this->user_cookie[11] == 1) { ?>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label for="" class="col-xl-3 col-form-label text-muted">Company</label>
                          <div class="col-xl">
                            <select name="company_id" class="select2" style="width:100%" onchange='autofilter(this);'>
                              <option value="" <?= $company_id == 0 ? 'selected' : '' ?>>---</option>
                              <?php foreach ($company_list as $key => $value) { ?>
                                <option value="<?= $value['id_company'] ?>" <?= $company_id == $value['id_company'] ? 'selected' : '' ?>><?= $value['company_name'] ?>
                                </option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                    <div class="col-md-6"></div>
                    <div class="col-md-12"></div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <div class="col-xl">

                          <div class=" text-right">
                            <div class="row">
                              <div class="col-lg-3">
                                <div class="card-box bg-green">
                                  <div class="inner">
                                    <h3><span id='total_ready'>0 Piecemark</span></h3>
                                    <span id='detail_card'>Ready</span>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-3">
                                <div class="card-box bg-blue">
                                  <div class="inner">
                                    <h3><span id='total_pending'>0 Piecemark</span></h3>
                                    <span id='detail_card'>Pending QC</span>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-3">
                                <div class="card-box bg-red">
                                  <div class="inner">
                                    <h3><span id='total_reject'>0 Piecemark</span></h3>
                                    <span id='detail_card'>Rejected QC</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>

                    <div class="col-md-12">
                      <hr>
                      <div class="float-right">
                        <button type="submit" class="btn btn-flat btn-info"><i class="fas fa-search"></i> Search</button>
                      </div>
                    </div>

                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php //if ($_POST): 
    ?>
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Material Verification | Piece Mark for Submission <strong>- <?= $status_internal == 0 ? 'Production' : 'Internal' ?></strong></h6>
          </div>
          <div class="card-body">
            <form action="<?= site_url('material_verification/proceed_submit_material_verification') ?>" method="post">
              <input type="hidden" name="module" value="<?= @$module ?>">
              <input type="hidden" name="module_name" value="<?= @$module_name[$module] ?>">
              <input type="hidden" name="project" value="<?= @$project_id ?>">
              <input type="hidden" name="discipline" value="<?= @$discipline ?>">
              <input type="hidden" name="drawing_type" value="<?= @$drawing_type ?>">
              <input type="hidden" name="discipline_name" value="<?= @$discipline_alias[$discipline] ?>">
              <input type="hidden" name="type_of_module" value="<?= @$type_module ?>">
              <input type="hidden" name="type_of_module_name" value="<?= @$module_type[$type_module] ?>">

              <div class="row">
                <?php if ($_POST) : ?>
                  <?php if ($drawing_no && count($data_piecemark) > 0) : ?>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label text-muted" for="">Area Name</label>
                        <div class="col-xl">
                          <select name="area_v2" onchange="get_location_list(this)" class="custom-select select2" style="width:100%" required>
                            <option value="">---</option>
                            <?php foreach ($area_list as $value) : ?>
                              <option value="<?= $value['id'] ?>" <?= $value['id'] == $data_piecemark[0]['area_v2'] ? 'selected' : '' ?>><?= $value['name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label text-muted" for="">Company Name</label>
                        <div class="col-xl">
                          <input type="text" name="company" value="PT SMOE" class="form-control" readonly>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label text-muted" for="">Location</label>
                        <div class="col-xl">
                          <select name="location_v2" onchange="get_point_list(this)" class="select2" required>
                            <option value="">---</option>

                            <?php if (isset($location_list)) : ?>
                              <?php foreach ($location_list as $key => $value) : ?>
                                <option value="<?= $value['id'] ?>" <?= $value['id'] == $data_piecemark[0]['location_v2'] ? 'selected' : '' ?>><?= $value['name'] ?></option>
                              <?php endforeach; ?>
                            <?php endif; ?>

                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6"></div>



                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label text-muted" for="">Point</label>
                        <div class="col-xl">
                          <select name="point_v2" class="select2">
                            <option value="0">---</option>

                            <?php if (isset($point_list)) : ?>
                              <?php foreach ($point_list as $key => $value) : ?>
                                <option value="<?= $value['id'] ?>" <?= $value['id'] == $data_piecemark[0]['point_v2'] ? 'selected' : '' ?>><?= $value['name'] ?></option>
                              <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6"></div>


                    <div class="col-md-12">
                      <b class="text-info"><i class="fas fa-info-circle"></i> Only 300 Data Allowed Per Submission</b>
                      <hr>
                    </div>
                  <?php endif; ?>
                <?php else : ?>
                  <div class="col-md-12">
                    <b class="text-danger"><i class="fas fa-info-circle"></i> Please Filter by Project First !</b>
                  </div>
                <?php endif; ?>
              </div>
              <div class="row">
              <?php if ($_POST) : ?>
                <?php // if ($drawing_no && count($data_piecemark) > 0) : ?>
                <?php  if ($project || $drawing_no  && count($data_piecemark) > 0) : ?>
                <div class="col-md-12">
                  <div class="table-responsive overflow-auto" style="max-height: 80vh; overflow: scroll;">
                    <table id="table_submission" class="table table-hover text-center" style="width:100%">
                      <thead class="bg-gray-table text-nowrap">
                        <th></th>
                        <th>Project</th>
                        <th>Company</th>
                        <!-- <th>Work Pack No</th> -->
                        <th>Drawing GA</th>
                        <th>Drawing AS</th>
                        <th>Deck Elevation / Service Line</th>
                        <th>Discipline</th>
                        <th>Module</th>
                        <th>Type Of Module</th>
                        <th>Part Id No</th>
                        <th>Thickness</th>
                        <th>Length</th>
                        <th>Profile</th>
                        <th>Spec / Grade</th>
                        <th>Unique No</th>
                        <th>Heat / No</th>
                        <th>Material Description</th>
                        <th>MRIR</th>
                        <th>Surveyor</th>
                        <th>Status</th>
                        <th>Submission Remarks</th>
                        <th>Inspection Remarks</th>
                      </thead>
                      <tbody>
                        <?php foreach ($data_piecemark as $key => $value) : ?>
                          <?php
                          if ($value['status_inspection'] == 4) {
                            $remarks  = $value['pending_qc_remarks'];
                          } elseif ($value['status_inspection'] == 2) {
                            $remarks  = $value['rejected_remarks'];
                          } else {
                            $remarks  = "";
                          }
                          ?>
                          <tr>
                            <td class="text-nowrap">
                              <?php if (isset($drawing_no)) { ?>
                                <?php if ($value['status_inspection'] == 2 || $value['status_inspection'] == 4 ||  $value['status_inspection'] == 0) : ?>
                                  <input type="hidden" name="id_mis[<?= $key ?>]" class="id_mis">
                                  <input type="hidden" name="id_mis_piping[<?= $key ?>]" class="id_mis_piping">
                                  <input type="hidden" name="id_mis_material[<?= $key ?>]" value="<?= $value['id_mis'] ?>">

                                  <input type="hidden" name="id_mis_piping_material[<?= $key ?>]" value="<?= $value['id_mis_piping'] ?>">

                                  <input type="hidden" name="drawing_no[<?= $key ?>]" value="<?= $value['drawing_ga'] ?>">
                                  <input type="hidden" name="id_material[<?= $key ?>]" value="<?= $value['id_material'] ?>">
                                  <input type="hidden" name="status_inspection[<?= $key ?>]" value="<?= $value['status_inspection'] ?>">
                                  <?php if (isset($drawing_no) && !empty($drawing_no)) { ?>
                                    <input type="checkbox" class="check" name="id[<?= $key ?>]" value="<?= $value['id'] ?>" style="width:20px; height:20px" <?= $_POST ? '' : 'disabled' ?>>
                                  <?php } ?>
                                <?php else : ?>
                                  <i class="fas fa-check"></i>
                                <?php endif; ?>
                              <?php } ?>
                            </td>
                            <td class="text-nowrap"><?= $project[$value['project']] ?></td>
                            <td class="text-nowrap"><?= $company_name[$value['company_id']] ?></td>
                            <!-- <td class="text-nowrap"><?= $value['workpack_no'] ?></td> -->
                            <td class="text-nowrap" style="background-color: <?= $drawing_color[$value['drawing_ga']] ?>;">
                              <?= $value['drawing_ga'] ?></td>
                            <td class="text-nowrap"><?= $value['drawing_as'] ?></td>
                            <td class="text-nowrap"><?= $deck_elevation_list[$value['deck_elevation']]['name'] ?></td>
                            <td class="text-nowrap"><?= $discipline_name[$value['discipline']] ?></td>
                            <td class="text-nowrap"><?= $module_name[$value['module']] ?></td>
                            <td class="text-nowrap"><?= $module_type_name[$value['type_of_module']] ?></td>
                            <td class="text-nowrap"><?= $value['part_id'] ?></td>
                            <td class="text-nowrap"><?= $value['thickness'] ?></td>
                            <td class="text-nowrap"><?= $value['length'] ?></td>
                            <td class="text-nowrap"><?= $value['profile'] ?></td>
                            <td class="text-nowrap"><?= $grade[$value['grade']] ?></td>
                            <td class="text-nowrap">

                              <?php if ($value['piping_testing_category'] == 1) : ?>

                                <?php foreach (explode(";", $value['id_mis_piping']) as $k => $v) : ?>
                                  <input type="text" name="unique_no_piping[<?= $key ?>]" class="form-control editable" onfocus="autocomplete_unique(this, '<?= $value['workpack_no'] ?>', <?= $value['grade'] ?>, <?= $value['id_workpack'] ?>, <?= $value['project'] ?>)" placeholder="Unique Number" value="<?= isset($detail_mis[$v]) ? $detail_mis[$v]['unique_no'] : '' ?>" onblur="validate_unique_no_2(this, '<?= $value['workpack_no'] ?>', <?= $value['grade'] ?>, <?= $value['id_workpack'] ?>, <?= $k ?>)" required disabled>
                                  <div class="invalid-feedback"></div>

                                  <input type="hidden" name="id_mis_piping_input[<?= $key ?>][]" class="id_mis_pip_input" value="<?= $v ?>">
                                  <br>
                                <?php endforeach; ?>

                              <?php else : ?>
                                <input type="text" name="unique_no[<?= $key ?>]" class="form-control editable" onfocus="autocomplete_unique(this, '<?= $value['workpack_no'] ?>', <?= $value['grade'] ?>, <?= $value['id_workpack'] ?>, <?= $value['project'] ?>)" placeholder="Unique Number" value="<?= isset($detail_mis[$value['id_mis']]) ? $detail_mis[$value['id_mis']]['unique_no'] : '' ?>" onblur="validate_unique_no(this, '<?= $value['workpack_no'] ?>', <?= $value['grade'] ?>, <?= $value['id_workpack'] ?>)" required disabled>
                                <div class="invalid-feedback"></div>
                              <?php endif; ?>


                            </td>
                            <td class="text-nowrap">
                              <?php if ($value['piping_testing_category'] == 1) : ?>
                                <?php foreach (explode(";", $value['id_mis_piping']) as $k => $v) : ?>
                                  <input type="text" class="form-control heat_no_piping_<?= $k ?>" placeholder="Heat Number" value="<?= isset($detail_mis[$v]) ? $detail_mis[$v]['heat_or_series_no'] : '-' ?>" disabled>
                                  <br>
                                <?php endforeach; ?>

                              <?php else : ?>
                                <input type="text" class="form-control heat_no" placeholder="Heat Number" value="<?= isset($detail_mis[$value['id_mis']]) ? $detail_mis[$value['id_mis']]['heat_or_series_no'] : '-' ?>" disabled>
                              <?php endif; ?>
                            </td>
                            <td class="text-nowrap">
                              <?= $value['profile'] ?>
                            </td>

                            <td class="text-nowrap">
                              <?php if ($value['piping_testing_category'] == 1) : ?>
                                <?php foreach (explode(";", $value['id_mis_piping']) as $k => $v) : ?>
                                  <input type="text" class="form-control mrir_piping_<?= $k ?>" placeholder="MRIR Number" value="<?= isset($detail_mis[$v]) ? explode('/', $detail_mis[$v]['report_no'])[1] : '-' ?>" disabled>
                                  <br>
                                <?php endforeach; ?>

                              <?php else : ?>
                                <input type="text" class="form-control mrir" placeholder="MRIR Number" value="<?= isset($detail_mis[$value['id_mis']]) ? explode('/', $detail_mis[$value['id_mis']]['report_no'])[1] : '-' ?>" disabled>
                              <?php endif; ?>
                            </td>

                            <td class="text-nowrap">

                              <?php if (isset($survey[$value['id_piecemark']]['evidence_mv'])) { ?>

                                <!-- <button type="button" class="btn btn-info btn-sm"><i class="fas fa-paperclip"></i>
                              Evidence</button> -->

                                <?php

                                $url_image = base_url();
                                $enc_img              = encrypt($survey[$value['id_piecemark']]['evidence_mv']);
                                $enc_location         = encrypt('/PCMS/mobile/pcms_v2_mobile/pcms_v2_photo');
                                $open_img             = site_url('public_smoe/open_file_syn/' . $enc_img . '/' . $enc_location);

                                ?>


                                <a href="<?= $open_img ?>" target="_blank" class="btn btn-primary"><i class="fas fa-image"></i></a>
                                <br>
                              <?php } else { ?>
                                <img class="mb-2" src="<?php echo base_url(); ?>/img/img_not_avai.png" style='width:60px;;'>
                              <?php } ?>
                              <span style="font-size: 11px;">
                                <?php if ($value['surveyor_creator']) { ?>
                                  <?= 'Action by <b>' . $user[$value['surveyor_creator']]['full_name'] . '</b> on <b>' ?>
                                  <br>
                                  <?php if ($value['surveyor_created_date'] != '') : ?>
                                    <?= DATE('d F, Y H:i:s', strtotime($value['surveyor_created_date'])) ?>
                                  <?php endif; ?>
                                <?php } else { ?>
                                  <?= 'Action by <b>' . $user[$value['requestor']]['full_name'] . '</b> on <b>' ?>
                                  <br>
                                  <?php if ($value['date_request'] != '') : ?>
                                    <?= DATE('d F, Y H:i:s', strtotime($value['date_request'])) ?>
                                  <?php endif; ?>
                                <?php } ?>
                              </span>
                            </td>
                            <td class="text-nowrap">
                              <?php if (isset($value['id_piecemark'])) : ?>
                                <?php if ($value['status_inspection'] == 0) : ?>
                                  <span class="badge badge-info badge-pill">Ready</span>
                                <?php elseif ($value['status_inspection'] == 1) : ?>
                                  <span class="badge badge-info badge-pill">Inspection</span>
                                <?php elseif ($value['status_inspection'] == 2) : ?>
                                  <span class="badge badge-danger badge-pill">Rejected By QC</span>
                                <?php elseif ($value['status_inspection'] == 3) : ?>
                                  <span class="badge badge-success badge-pill">Approved By QC</span>
                                <?php elseif ($value['status_inspection'] == 4) : ?>
                                  <span class="badge badge-warning badge-pill">Pending By QC</span>
                                <?php elseif ($value['status_inspection'] == 5) : ?>
                                  <span class="badge badge-warning badge-pill">Transmitted</span>
                                <?php elseif ($value['status_inspection'] == 7) : ?>
                                  <span class="badge badge-success badge-pill">Accepted By Client</span>
                                <?php elseif ($value['status_inspection'] == 9) : ?>
                                  <span class="badge badge-primary badge-pill">Accepted And Release With Comments</span>
                                <?php elseif ($value['status_inspection'] == 10) : ?>
                                  <span class="badge badge-info badge-pill">Postponed By Client</span>
                                <?php elseif ($value['status_inspection'] == 11) : ?>
                                  <span class="badge badge-warning badge-pill">Re-Offer By Client</span>
                                <?php endif; ?>

                              <?php else : ?>
                                <span class="badge badge-info badge-pill">Ready</span>
                              <?php endif; ?>

                              <?php if (in_array($value['status_inspection'], [2, 4])) : ?>
                                <table class="table table-borderless table-sm text-left " style="font-size: 10px">
                                  <tbody>
                                    <tr>
                                      <td><strong><i>Inspection By</i></strong></td>
                                      <td><?= $user[$value['inspection_by']]['full_name'] ?></td>
                                    </tr>
                                    <tr>
                                      <td><strong><i>Inspection Date</i></strong></td>
                                      <td><?= $value['inspection_datetime'] ?></td>
                                    </tr>
                                    <tr>
                                      <td><strong><i>Remarks</i></strong></td>
                                      <td><?= $value['rejected_remarks'] ?></td>
                                    </tr>
                                  </tbody>
                                </table>
                              <?php endif; ?>
                            </td>
                            <td>
                              <textarea name="remarks[<?= $key ?>]" class="form-control editable" disabled><?= $value['remarks'] ?></textarea>
                            </td>
                            <td>
                              <?= $remarks ?>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <?php endif; ?>
                <?php endif; ?>
                <?php if ($_POST) : ?>
                  <?php if (isset($drawing_no) && !empty($drawing_no)) { ?>
                  <div class="col-md-12 text-right">
                    <hr>
                    <strong><i class="fas fa-check-circle"></i> Thicked <span class="text_total_checked text-danger">0</span> Item(s)</strong>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" id="btn_submit" class="btn btn-primary" disabled><i class="fas fa-file-import"></i>
                      Submit Inspection</button>
                  </div>
                  <?php } ?>
                <?php endif; ?>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php //endif; 
    ?>
  </div>
</div>
</div>

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


<script>
  function autofilter() {
    $('#form-filter').submit();
  }

  load_data_card()

  function load_data_card() {
    $.ajax({
      url: "<?= site_url('material_verification/data_card_production_rfi') ?>",
      type: "POST",
      data: {
        project_id: "<?= strtr($this->encryption->encrypt($project_filter), '+=/', '.-~') ?>",
        company_id: "<?= strtr($this->encryption->encrypt($company_filter), '+=/', '.-~') ?>",
        status_internal: "<?= strtr($this->encryption->encrypt($status_internal), '+=/', '.-~') ?>",
      },
      dataType: "JSON",
      success: function(data) {

        $("#total_ready").text(data.total_ready_submit + ' Piecemark(s)')
        $("#total_pending").text(data.total_hold_qc + ' Piecemark(s)')
        $("#total_reject").text(data.total_rejected + ' Piecemark(s)')
      }
    })
  }

  $(document).ready(function() {

    var checked = []
    var checked_drawing = []
    var checked_ga = []
    $("#table_submission").DataTable({
      order: [],
      paging: false,
    })

    $("#table_submission").on('click', '.check', function() {

      var closest_as = $(this).closest('tr').find('td:nth-child(6)').text()
      var closest_ga = $(this).closest('tr').find('td:nth-child(5)').text()

      var editable = $(this).closest('tr').find('.editable')

      if (checked_drawing.length > 0) {
        if (checked_drawing[0] != closest_as) {
          this.checked = false
          Swal.fire({
            type: "warning",
            title: "Different Drawing",
            text: "Cannot Submit Multiple Drawing AS In One Submission"
          })

          return
        }

        if (checked_ga[0] != closest_ga) {
          this.checked = false
          Swal.fire({
            type: "warning",
            title: "Different Drawing",
            text: "Cannot Submit Multiple Drawing GA In One Submission"
          })

          return
        }
      }

      var value = $(this).val()
      if (this.checked) {
        editable.removeAttr('disabled')
        checked.push(value)
        checked_drawing.push(closest_as)
        checked_ga.push(closest_ga)

      } else {
        editable.removeClass('is-valid is-invalid');
        editable.attr('disabled', true)
        checked.splice($.inArray(value, checked), 1)
        checked_drawing.splice($.inArray(closest_as, checked_drawing), 1)
        checked_ga.splice($.inArray(closest_ga, checked_ga), 1)
      }

      if (checked.length > 0) {
        if (checked.length > 300) {
          this.checked = false
          editable.attr('disabled', true)
          checked.splice($.inArray(value, checked), 1)

          Swal.fire({
            type: "warning",
            title: "Warning",
            text: "Only 300 Data Allowed In Each Submission"
          })

        } else {
          $("#btn_submit").removeAttr('disabled')
        }
      } else {
        $("#btn_submit").attr('disabled', true)
      }

      $('.text_total_checked').text(checked.length)
    })

    $('.workpack_no').autocomplete({
      source: "<?php echo base_url(); ?>material_verification/autocomplete_workpack_no",
      autoFocus: true,
      classes: {
        "ui-autocomplete": "highlight"
      },
      select: function(event, ui) {
        var value = ui.item.value;
        if (value == 'No Data.') {
          ui.item.value = "";
        } else {
          validate_workpack_no(ui.item.value, this);
        }
      }
    });

    $('form').on('submit', function() {
      $('#btn_submit').attr('disabled', true)
    })

  })

  function validate_unique_no_2(input, workpack_no, grade, id_workpack, key) {
    var unique_no = $(input).val()
    var invalid_feedback = $(input).closest('tr').find('.invalid-feedback')
    var mrir = $(input).closest('tr').find(`.mrir_piping_${key}`)
    var heat_no = $(input).closest('tr').find(`.heat_no_piping_${key}`)
    var id_mis = $(input).closest('tr').find('.id_mis_pip_input')

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
        id_workpack: id_workpack,
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
        } else {

          mrir.val('')
          id_mis.val('')
          heat_no.val('')

          $(input).val('')
          $(input).addClass('is-invalid')
          invalid_feedback.text(data.text)
        }
      }
    })
  }

  function validate_unique_no(input, workpack_no, grade, id_workpack) {
    var unique_no = $(input).val()
    var invalid_feedback = $(input).closest('tr').find('.invalid-feedback')
    var mrir = $(input).closest('tr').find('.mrir')
    var heat_no = $(input).closest('tr').find('.heat_no')
    var material_description = $(input).closest('tr').find('.material_description')
    var id_mis = $(input).closest('tr').find('.id_mis')

    console.log(grade)

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
        id_workpack: id_workpack,
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

  // function find_module_by_project(select, mod_id = null) {
  //   var project_id = $(select).val()
  //   $.ajax({
  //     url: "<?= site_url('material_verification/find_module_by_project') ?>",
  //     type: "POST",
  //     data: {
  //       project_id: project_id
  //     },
  //     dataType: "JSON",
  //     success: function(data) {
  //       var html = []
  //       html.push(`<option value="">---</option>`)
  //       data.map(function(v, i) {
  //         html.push(
  //           `<option value="${v.mod_id}" ${mod_id && mod_id == v.mod_id ? 'selected' : ''}>${v.mod_desc}</option>`
  //         )
  //       })
  //       $('.module').html(html)
  //     }
  //   })
  // }


  var module_list_json = <?= json_encode($module_list) ?>;

  function find_module_by_project(select, mod_id = null) {
    let value = select.value
    let html = [`<option value="">---</option>`]

    console.log(value)

    if (typeof(module_list_json[value]) !== "undefined") {
      module_list_json[value].map((v, i) => {
        html.push(`<option value="${v.mod_id}">${v.mod_desc}</option>`)
      })
    }
    $('.module').html(html)

  }

  $('.autocomplete_drawing').autocomplete({
    source: function(request, response) {
      var drawing_type = $("select[name=drawing_type]").val();
      console.log(drawing_type)
      $.ajax({
        url: "<?php echo base_url() ?>material_verification/autocomplete_drawing",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: 1,
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

    $.ajax({
      url: "<?php echo base_url() ?>material_verification/get_data_drawing",
      dataType: "json",
      data: {
        document_no: document_no,
        module: module,
      },
      success: function(data) {
        console.log(data);
        if (data.drawing_type == 1 || data.drawing_type == 2) {
          $("select[name=project_id]").val(data.project).trigger('change');
          // find_module_by_project($("select[name=project_id]"), data.module)
          $("select[name=discipline]").val(data.discipline);
          $("select[name=drawing_type]").val(data.drawing_type);
          // if (module == "") {
          $("select[name=module]").val(data.module);
          // }
          $("select[name=type_of_module]").val(data.type_of_module);
          $("select[name=status_submission]").change().val('ready');
          $("select[name=status_inspection]").val(0);
        }
      }
    });
  }

  function autocomplete_unique(input, workpack_no, grade, id_wokrpack, project) {
    $(input).autocomplete({
      source: "<?php echo base_url(); ?>material_verification/autocomplete_unique_no/"+ grade + '/' +project,
      autoFocus: true,
      classes: {
        "ui-autocomplete": "highlight"
      }
    });
  }

  function validate_workpack_no(workpack_no, input) {
    var module = $("select[name=module]").val();
    $.ajax({
      url: "<?= site_url('material_verification/detail_workpack') ?>",
      type: "POST",
      data: {
        workpack_no: workpack_no
      },
      dataType: "JSON",
      success: function(data) {
        if (data.success) {
          var data = data.data
          $("select[name=project_id]").val(data.project).trigger('change');
          // find_module_by_project($("select[name=project_id]"), data.module)
          $("select[name=discipline]").val(data.discipline);
          $("select[name=drawing_type]").val(data.drawing_type);
          $("input[name=drawing_no]").val(data.drawing_no);
          $("select[name=module]").val(data.module)
          $("select[name=type_of_module]").val(data.type_of_module);
        }
      }
    })
  }

  function show_image(btn, source, type) {

    var link_image = "<?= base_url() ?>"


    var url = `${link_image}file/` + source

    var image_content = `
  <div class="row">
    <div class="col-md-12">
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

  function get_location_list(select) {
    $('select[name="location_v2"]').html(`<option value="">---</option>`)
    $('select[name="point_v2"]').html(`<option value="0">---</option>`)

    let area_id = select.value
    $.ajax({
      url: "<?= site_url('material_verification/location_list_ajax') ?>",
      type: "POST",
      data: {
        area_id: area_id
      },
      dataType: "JSON",
      success: function(data) {
        let html = []

        html.push(`<option value="">---</option>`)
        data.map(function(v) {
          html.push(`<option value="${v.id}">${v.name}</option>`)
        })

        $('select[name="location_v2"]').html(html)
      }
    })
  }

  function get_point_list(select) {
    $('select[name="point_v2"]').html(`<option value="0">---</option>`)

    let location_id = select.value
    $.ajax({
      url: "<?= site_url('material_verification/point_list_ajax') ?>",
      type: "POST",
      data: {
        location_id: location_id
      },
      dataType: "JSON",
      success: function(data) {
        let html = []

        html.push(`<option value="">---</option>`)
        data.map(function(v) {
          html.push(`<option value="${v.id}">${v.name}</option>`)
        })

        $('select[name="point_v2"]').html(html)
      }
    })
  }
</script>