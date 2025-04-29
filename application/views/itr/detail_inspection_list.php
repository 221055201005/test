<?php

if ($main_data['ga_rev_no'] != '') {
  $drawing_ga_rev     = $main_data['ga_rev_no'];
} else {
  // $drawing_ga_rev     = isset($shop_drawing[$main_data['drawing_no']]) ? $shop_drawing[$main_data['drawing_no']]['last_revision_no'] : (isset($data_drawing[$main_data['drawing_no']]['last_revision_no']) && $data_drawing[$main_data['drawing_no']]['last_revision_no'] == '' ? '01' : $data_drawing[$main_data['drawing_no']]['last_revision_no']);
  $drawing_ga_rev = $main_data['rev_ga'];
}


// $latest_ga_rev = isset($shop_drawing[$main_data['drawing_no']]) ? $shop_drawing[$main_data['drawing_no']]['last_revision_no'] : (isset($data_drawing[$main_data['drawing_no']]['last_revision_no']) && $data_drawing[$main_data['drawing_no']]['last_revision_no'] == '' ? '01' : $data_drawing[$main_data['drawing_no']]['last_revision_no']);

$latest_ga_rev = $drawing_ga_rev;

$show_attachment_drawing = false;

if (isset($drawing_eng[$main_data['drawing_no']])) {
  $show_attachment_drawing = true;
  $links_atc        = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($drawing_eng[$main_data['drawing_no']]['id']), '+=/', '.-~') . '/' . $drawing_ga_rev . '/' . strtr($this->encryption->encrypt(1), '+=/', '.-~');
  $links_atc_cross  = base_url_ftp_eng() . "public_smoe/open_atc_cross/2/" . strtr($this->encryption->encrypt($drawing_eng[$main_data['drawing_no']]['document_no']), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt($drawing_eng[$main_data['drawing_no']]['id']), '+=/', '.-~') . '/' . $drawing_ga_rev . '/' . strtr($this->encryption->encrypt(1), '+=/', '.-~');
}



?>

<style>
  td {
    vertical-align: middle !important;
  }

  .input_width {
    width: 200px !important
  }

  .nav-link {
    color: #000;
  }

  .nav-pills .nav-link.active,
  .nav-pills .show>.nav-link {
    color: #007bff;
    background: #fff;
    border-bottom: 2px solid #007bff;
    border-radius: 0px;
  }
</style>
<?php
error_reporting(0);
?>
<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h6 class="card-title">ITR Inspection Detail - <strong><?= $main_data['submission_id'] ?></strong></h6>
            <hr>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Drawing GA</label>
                  <div class="col-xl">
                    <input type="text" class="form-control" value="<?= $main_data['drawing_no'] ?> Rev. <?= $drawing_ga_rev ?>" disabled>
                    <?php if ($show_attachment_drawing) : ?>
                      <div class="mt-2">
                        <a target="_blank" href="<?= $links_atc ?>"><i class="fas fa-paperclip"></i> Open Drawing</a>
                        <a target="_blank" href="<?= $links_atc_cross ?>"><i class="ml-3 fas fa-cloud-download-alt"></i>
                          Download Drawing</a>
                      </div>
                    <?php endif; ?>

                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Workpack Number</label>
                  <div class="col-xl">
                    <input type="text" class="form-control" value="<?= $main_data['workpack_no'] ?>" disabled>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Discipline</label>
                  <div class="col-xl">
                    <input type="text" class="form-control" value="<?= $discipline_name[$main_data['discipline']] ?>" disabled>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Project Name</label>
                  <div class="col-xl">
                    <input type="text" class="form-control" value="<?= $project_name[$main_data['project_code']] ?>" disabled>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Module</label>
                  <div class="col-xl">
                    <input type="text" class="form-control" value="<?= $mod_desc[$main_data['module']] ?>" disabled>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Company</label>
                  <div class="col-xl">
                    <input type="text" class="form-control" value="<?= $company_name[$main_data['company_id']] ?>" disabled>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Type Of Module</label>
                  <div class="col-xl">
                    <input type="text" class="form-control" value="<?= $module_type[$main_data['type_of_module']] ?>" disabled>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <hr>
              </div>

              <div class="col-md-6">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Area</label>
                  <div class="col-xl">

                    <?php if ($user_permission[22] == 1) : ?>
                      <select class="select2 select_area" name="area_v2" onchange="get_location_list(this)" style="width:100%" <?= $user_permission[22] == 1 ? '' : 'disabled' ?>>
                        <option value="">---</option>
                        <?php foreach ($area_v2 as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $main_data['area_v2'] ? 'selected' : '' ?>>
                            <?= $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    <?php else : ?>

                      <?php if ($main_data['area_v2']) : ?>
                        <select class="select2 select_area" style="width:100%" <?= $user_permission[22] == 1 ? 'disabled' : 'disabled' ?>>
                          <?php foreach ($area_v2 as $key => $value) : ?>
                            <option value="<?= $value['id'] ?>" <?= $value['id'] == $main_data['area_v2'] ? 'selected' : '' ?>>
                              <?= $value['name'] ?></option>
                          <?php endforeach; ?>
                        </select>

                      <?php else : ?>

                        <select class="select2 select_area" style="width:100%" <?= $user_permission[22] == 1 ? 'disabled' : 'disabled' ?>>
                          <?php foreach ($area_list as $key => $value) : ?>
                            <option value="<?= $value['id'] ?>" <?= $value['id'] == $main_data['area'] ? 'selected' : '' ?>>
                              <?= $value['area_name'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      <?php endif; ?>

                    <?php endif; ?>



                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-xl-3 col-form-label text-muted"> Location</label>
                  <div class="col-xl">
                    <select name="location_v2" onchange="get_point_list(this) " class="select2" style="width: 100%;" <?= $user_permission[22] == 1 ? '' : 'disabled' ?>>
                      <option value="">---</option>
                      <?php foreach ($location_v2 as $key => $value) : ?>
                        <option value="<?= $value['id'] ?>" <?= $value['id'] == $main_data['location_v2'] ? 'selected' : '' ?>><?= $value['name'] ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-xl-3 col-form-label text-muted"> Point</label>
                  <div class="col-xl">
                    <select name="point_v2" class="select2" style="width: 100%;" <?= $user_permission[22] == 1 ? '' : 'disabled' ?>>
                      <option value="0">---</option>
                      <?php foreach ($point_list as $key => $value) : ?>
                        <option value="<?= $value['id'] ?>" <?= $value['id'] == $main_data['point_v2'] ? 'selected' : '' ?>><?= $value['name'] ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="float-right">
                  <button type="button" onclick="update_data(this)" class="btn btn-warning"><i class="fas fa-edit"></i>
                    Update Location</button>
                </div>
              </div>

            </div>
            <hr>
            <?php if ($action == "detail") : ?>
              <div class="row">
                <div class="col-md-12 col-sm">
                  <div class="btn-group">
                    <?php if ($allow_approval) : ?>
                      <button class="btn btn-outline-success" onclick="change_status(this, 3)">Approve All</button>
                    <?php endif; ?>

                    <button class="btn btn-outline-danger" onclick="change_status(this, 2)">Reject All</button>
                    <!-- <button class="btn btn-outline-info" onclick="change_status(this, 4)">Pending All</button> -->

                    <button class="btn btn-outline-secondary" onclick="change_status(this, 0)">Clear All</button>
                  </div>
                </div>
              </div>
              <hr>
            <?php endif; ?>
            <?php if ($action == "detail") : ?>
              <form action="<?= site_url('itr/proceed_approval_inspection') ?>" method="post">
              <?php else : ?>
                <form action="<?= site_url('itr/proceed_update_inspection') ?>" method="post">
                <?php endif; ?>

                <input type="hidden" name="submission_id_data" value="<?= $detail_data[0]['submission_id'] ?>">
                <input type="hidden" name="submission_id" value="<?= $main_data['submission_id'] ?>">
                <input type="hidden" name="project_code" value="<?= $main_data['project_code'] ?>">
                <input type="hidden" name="discipline" value="<?= $main_data['discipline'] ?>">
                <input type="hidden" name="module" value="<?= $main_data['module'] ?>">
                <input type="hidden" name="type_of_module" value="<?= $main_data['type_of_module'] ?>">
                <input type="hidden" name="legend_inspection_auth" value="<?= $main_data['legend_inspection_auth'] ?>">
                <input type="hidden" name="ga_rev_no" value="<?= $drawing_ga_rev ?>">
                <input type="hidden" name="latest_ga_rev_no" value="<?= $latest_ga_rev ?>">
                <div class="row">

                  <?php if ($revise_status_inspection == 1) : ?>
                    <div class="col-md-12">
                      <div class="form-group">
                        <input id="cb" name="use_current_date" value="1" type="checkbox" style="width: 20px; height:20px;float: left;">
                        <div style="margin-left: 30px; line-height: 1.5;">
                          <label><i><strong>Use Current Date as Approval Date?</strong></i></label>
                        </div>
                      </div>
                      <hr>
                    </div>
                  <?php endif; ?>

                  <?php if ($main_data['company_id'] == 13) : ?>
                    <div class="col-md-5">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted"> Approval Date</label>
                        <div class="col-xl">
                          <input type="date" name="manual_approval_date" class="form-control" required>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12"></div>
                    <div class="col-md-5">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted"> Approval Time</label>
                        <div class="col-xl">
                          <input type="time" name="manual_approval_time" class="form-control" required>
                        </div>
                      </div>
                    </div>

                  <?php endif; ?>

                  <div class="col-md-12">
                    <ul class="nav nav-pills border-bottom border-gray" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detail</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Revise History Log</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row mt-3">
                          <div class="col-md-12">
                            <div class="table-responsive overflow-auto">
                              <table class="table table-hover text-center">
                                <thead class="bg-info text-white text-nowrap">
                                  <th>No</th>
                                  <th>Piece Mark / Tag No</th>
                                  <th>Unique No</th>
                                  <th>Spec / Grade</th>
                                  <th>Heat No</th>
                                  <th>Length</th>
                                  <th>Thickness</th>
                                  <th>Sch</th>
                                  <th>Profile</th>
                                  <th>MRIR No.</th>
                                  <th>WPS</th>
                                  <th>Consumable Lot No.</th>
                                  <th>Welder ID</th>
                                  <th class="text-left">Inspection Status</th>
                                  <th>Client Status</th>
                                  <th class="bg-primary">Surveyor</th>
                                  <th>Remarks</th>
                                </thead>
                                <tbody>


                                  <?php $no = 1;
                                  $total_already_in_client = 0;
                                  foreach ($detail_data as $key => $value) : ?>
                                    <?php

                                    if ($value['status_inspection'] == 4) {
                                      $remarks  = $value['pending_qc_remarks'];
                                    } elseif ($value['status_inspection'] == 2) {
                                      $remarks  = $value['rejected_remarks'];
                                    } else {
                                      $remarks  = $value['inspection_remarks'];
                                    }

                                    if ($value['status_inspection'] > 3) {
                                      $total_already_in_client++;
                                    }

                                    $unique_no   = $detail_mis[$value['id_mis']]['unique_no'];

                                    $mrir_id_enc = strtr($this->encryption->encrypt($mrir_detail[$unique_no]['mrir_id']), '+=/', '.-~');
                                    $action_enc  = strtr($this->encryption->encrypt("detail"), '+=/', '.-~');
                                    $status_enc  = strtr($this->encryption->encrypt($mrir_detail[$unique_no]['status']), '+=/', '.-~');
                                    $partial_report_no = strtr($this->encryption->encrypt($mrir_detail[$unique_no]['partial_report_no']), '+=/', '.-~');

                                    $link_mrir_det = wh_base_url() . 'mrir/detail_mrir_cs/?id=' . $mrir_id_enc . '&action=' . $action_enc . '&status=' . $status_enc . '&partial_report_no=' . $partial_report_no . '&user=' . $id_user_enc;

                                    $report_no  = explode('/', $detail_mis[$value['id_mis']]['report_no']);
                                    $report_no  = $report_no[1] . '-' . $detail_mis[$value['id_mis']]['partial_report_no'];


                                    ?>
                                    <tr>
                                      <td>
                                        <input type="hidden" name="id_itr[<?= $key ?>]" value="<?= $value['id_itr'] ?>">
                                        <input type="hidden" name="report_number[<?= $key ?>]" value="<?= $value['report_number'] ?>">
                                        <input type="hidden" name="report_no_rev[<?= $key ?>]" value="<?= $value['report_no_rev'] ?>">

                                        <input type="hidden" name="inspection_by[<?= $key ?>]" value="<?= $value['inspection_by'] ?>">

                                        <input type="hidden" name="inspection_datetime[<?= $key ?>]" value="<?= $value['inspection_datetime'] ?>">

                                        <input type="hidden" name="latest_inspection_status[<?= $key ?>]" value="<?= $value['latest_inspection_status'] ?>">

                                        <?= $no++ ?>
                                      </td>
                                      <td>
                                        <?= $value['part_id'] ?>

                                        <?php if ($piecemark_photo[$value['id_piecemark']]['evidence_itr'] != null) : ?>
                                          <?php

                                          $url_image = base_url();
                                          $enc_img              = strtr($this->encryption->encrypt($piecemark_photo[$value['id_piecemark']]['evidence_itr']), '+=/', '.-~');
                                          $enc_location         = strtr($this->encryption->encrypt('/PCMS/mobile/pcms_v2_mobile/pcms_v2_photo'), '+=/', '.-~');
                                          $open_img             = site_url('irn/open_file/' . $enc_img . '/' . $enc_location . '/download');

                                          ?>


                                          <a href="<?= $open_img ?>" target="_blank" class="btn btn-primary"><i class="fas fa-image"></i></a>
                                        <?php else : ?>

                                        <?php endif; ?>
                                      </td>

                                      <td><?= $detail_mis[$value['id_mis']]['unique_no'] ?></td>
                                      <td><?= $grade[$value['grade']] ?></td>
                                      <td><?= $detail_mis[$value['id_mis']]['heat_or_series_no'] ?></td>
                                      <td><?= $value['length'] ?></td>
                                      <td><?= $value['thickness'] ?></td>
                                      <td><?= $value['sch'] ?></td>
                                      <td><?= $value['profile'] ?></td>
                                      <td><a href="<?= $link_mrir_det ?>" target="_blank"><?= $report_no ?></a></td>
                                      <td>

                                        <?php

                                        $list_wps     = [];
                                        $list_wps_id  = [];
                                        foreach (explode(";", $value['wps_id']) as $v) {
                                          $list_wps[]     = $wps[$v]['wps_no'];
                                          $list_wps_id[]  = $v;
                                        }

                                        ?>

                                        <?php if ($action == "detail") : ?>
                                          <?php if ($value['wps_id']) : ?>
                                            <?= implode(',<br>', $list_wps) ?>
                                          <?php else : ?>
                                            -
                                          <?php endif; ?>
                                        <?php else : ?>

                                          <select name="wps_id[<?= $key ?>][]" class="select2" style="width:100%" required multiple>
                                            <option value="">---</option>
                                            <?php foreach ($wps as $v) : ?>
                                              <option value="<?= $v['id_wps'] ?>" <?= in_array($v['id_wps'], $list_wps_id) ? 'selected' : '' ?>><?= $v['wps_no'] ?></option>
                                            <?php endforeach; ?>
                                          </select>
                                        <?php endif; ?>

                                      </td>
                                      <td>
                                        <?php if ($action == "detail") : ?>
                                          <?= implode(',<br>', explode(';', $value['cons_lot_no'])) ?>
                                        <?php else : ?>

                                          <input type="text" name="cons_lot_no[<?= $key ?>]" value="<?= $value['cons_lot_no'] ?>" class="form-control">
                                        <?php endif; ?>

                                      </td>
                                      <td>

                                        <?php

                                        $list_welder = [];
                                        $list_welder_id = [];
                                        foreach (explode(";", $value['welder_id']) as $v) {
                                          $list_welder[]    = $welder[$v]['rwe_code'];
                                          $list_welder_id[] = $v;
                                        }

                                        ?>

                                        <?php if ($action == "detail") : ?>
                                          <?php if ($value['welder_id']) : ?>
                                            <?= implode(',<br>', $list_welder) ?>
                                          <?php else : ?>
                                            -
                                          <?php endif; ?>
                                        <?php else : ?>
                                          <select name="welder_id[<?= $key ?>][]" class="select2" required multiple>
                                            <option value="">---</option>
                                            <?php foreach ($welder as $v) : ?>
                                              <option value="<?= $v['id_welder'] ?>" <?= in_array($v['id_welder'], $list_welder_id) ? 'selected' : '' ?>><?= $v['rwe_code'] ?></option>
                                            <?php endforeach; ?>
                                          </select>
                                        <?php endif; ?>

                                      </td>

                                      <td class="text-left">
                                        <?php if ($value['status_inspection'] == 3 || $value['status_inspection'] >= 5 && $value['status_inspection'] != 12) : ?>
                                          <span class="badge badge-success badge badge-pill ml-4">Approved by QC</span>
                                        <?php elseif ($value['status_inspection'] == 2) : ?>
                                          <span class="badge badge-danger badge badge-pill ml-4">Rejected by QC</span>
                                        <?php elseif ($value['status_inspection'] == 4) : ?>
                                          <span class="badge badge-info badge badge-pill ml-4">Pending by QC</span>
                                        <?php elseif ($value['status_inspection'] == 12) : ?>
                                          <span class="badge badge-dark badge badge-pill ml-4">Void</span>
                                        <?php else : ?>
                                          <?php if ($action == "detail") : ?>
                                            <input type="hidden" name="status_data[<?= $key ?>]" value="<?= $value['status_inspection'] ?>">
                                            <?php if ($allow_approval) : ?>
                                              <div class="form-check">
                                                <label class="form-check-label">
                                                  <input type="radio" class="form-check-input radio_button approve" name="approval[<?= $key ?>]" value="3" style="transform: scale(1.3);"><b class="text-success">Approve</b>
                                                </label>
                                              </div>
                                            <?php else : ?>
                                              <h5><span class="badge badge-pill badge-secondary"><i class="fas fa-hourglass"></i>
                                                  Waiting Drawing Release</span></h5>
                                            <?php endif; ?>

                                            <div class="form-check">
                                              <label class="form-check-label">
                                                <input type="radio" class="form-check-input radio_button reject" name="approval[<?= $key ?>]" value="2" style="transform: scale(1.3);"><b class="text-danger">Reject</b>
                                              </label>
                                            </div>
                                          <?php else : ?>
                                            <span class="badge badge-primary badge badge-pill ml-4">Pending Approval by QC</span>
                                          <?php endif; ?>


                                        <?php endif; ?>

                                        <?php if ($value['inspection_datetime']) : ?>
                                          <br>
                                          <table class="table table-borderless table-sm" style="font-size: 11px;">
                                            <tbody>
                                              <tr>
                                                <td class="text-nowrap"><strong><i>Last Inspection By</i></strong></td>
                                                <td class="text-nowrap">:</td>
                                                <td class="text-nowrap"><?= $user[$value['inspection_by']]['full_name'] ?></td>
                                              </tr>
                                              <tr>
                                                <td class="text-nowrap"><strong><i>Last Inspection Date</i></strong></td>
                                                <td class="text-nowrap">:</td>
                                                <td class="text-nowrap"><?= $value['inspection_datetime'] ?></td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        <?php endif; ?>
                                      </td>
                                      <td>
                                        <?php if ($value['status_inspection'] == 5) : ?>
                                          <span class="badge badge-warning badge-pill">Pending Approval By Client</span>
                                        <?php elseif ($value['status_inspection'] == 6) : ?>
                                          <span class="badge badge-danger badge-pill">Rejected By Client</span>
                                        <?php elseif ($value['status_inspection'] == 7) : ?>
                                          <span class="badge badge-success badge-pill">Accepted By Client</span>
                                        <?php elseif ($value['status_inspection'] == 9) : ?>
                                          <span class="badge badge-primary badge-pill">Accepted And Release With
                                            Comments</span>
                                        <?php elseif ($value['status_inspection'] == 10) : ?>
                                          <span class="badge badge-info badge-pill">Postponed By Client</span>
                                        <?php elseif ($value['status_inspection'] == 11) : ?>
                                          <span class="badge badge-warning badge-pill">Re-Offer By Client</span>
                                        <?php else : ?>
                                          -
                                        <?php endif; ?>
                                      </td>
                                      <td class="text-nowrap">
                                        <table class="table table-sm text-left table-borderless" style="font-size: 11px;">
                                          <tbody>
                                            <tr>
                                              <td><i><strong>Action By</strong></i></td>
                                              <td>:</td>
                                              <td><i><?= $user[$value['surveyor_creator']]['full_name'] ?></i></td>
                                            </tr>
                                            <tr>
                                              <td><i><strong>Action Date</strong></i></td>
                                              <td>:</td>
                                              <td><i><?= $value['surveyor_created_date'] ?></i></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                      <td>
                                        <textarea name="remarks[<?= $key ?>]" class="form-control input_width"><?= $remarks ?></textarea>
                                      </td>
                                    </tr>
                                  <?php endforeach; ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <hr>
                            <div class="float-right">

                              <?php


                              ?>

                              <a href="<?= site_url('itr/inspection_list') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                              <a href="<?= site_url('itr/itr_pdf/submission/' . $submission_enc) ?>" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Report</a>
                              <?php if ($total_approved == $total_data) : ?>
                                <span class="btn btn-success"><i class="fas fa-check-circle"></i> All Data Has Been
                                  Approved</span>
                                <?php if ($main_data['requested_for_update'] == 1) : ?>
                                  <span class="btn btn-secondary"><i class="fas fa-hourglass-half"></i> Requested For
                                    Update</span>
                                <?php else : ?>
                                  <?php if ($total_already_in_client <= 0) : ?>
                                    <button type="button" onclick="request_for_update(this, '<?= $main_data['submission_id'] ?>')" class="btn btn-warning"><i class="fas fa-edit"></i> Request For Update</button>
                                  <?php endif; ?>


                                <?php endif; ?>
                              <?php else : ?>
                                <?php if ($action == "detail") : ?>
                                  <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                                <?php else : ?>
                                  <button type="submit" class="btn btn-warning"><i class="fas fa-edit"></i> Update</button>

                                <?php endif; ?>
                              <?php endif; ?>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row mt-3">
                          <div class="col-md-12">
                            <div class="table-responsive overflow-auto">
                              <table class="table table-hover text-center" id="table_revise">
                                <thead class="bg-secondary text-white">
                                  <th>No</th>
                                  <th>Part Id</th>
                                  <th>Updated Column</th>
                                  <th>Data From</th>
                                  <th>Data To</th>
                                  <th>Request Reason</th>
                                  <th>Updated By</th>
                                  <th>Updated Date</th>
                                </thead>
                                <tbody>
                                  <?php $no = 1;
                                  foreach ($revision_log as $key => $value) : ?>
                                    <?php if ($value['created_date'] > date("Y-m-d", strtotime($detail_piecemark[$value['id_template']]['date_request']))) { ?>
                                      <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $detail_piecemark[$value['id_template']]['part_id'] ?></td>
                                        <td><?= $value['name'] ?></td>
                                        <td>

                                          <?php if ($value['name'] == "Grade") : ?>
                                            <?= $grade[$value['data_before']] ?>
                                          <?php else : ?>
                                            <?= $value['data_before'] ?>
                                          <?php endif; ?>

                                        </td>
                                        <td>
                                          <?php if ($value['name'] == "Grade") : ?>
                                            <?= $grade[$value['data_after']] ?>
                                          <?php else : ?>
                                            <?= $value['data_after'] ?>
                                          <?php endif; ?></td>
                                        <td><?= $revise_history[$value['id_request_update']]['request_reason'] ?></td>
                                        <td><?= $user[$value['created_by']]['full_name'] ?></td>
                                        <td><?= $value['created_date'] ?></td>
                                      </tr>
                                    <?php } ?>
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
                </form>
          </div>
        </div>
      </div>
    </div>
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
  $(document).ready(function() {
    $('form').on('submit', function() {
      $('button[type=submit]').attr('disabled', true)
    })

    $("#table_revise").DataTable({
      order: []
    })

    $('.radio_button').change(function() {
      var val = $(this).val()
      var textarea = $(this).closest('tr').find('textarea')
      if (this.checked) {
        if (val == 2 || val == 4) {
          textarea.attr('required', true)
          // textarea.removeAttr('disabled')
        } else {
          // textarea.attr('disabled', true)
          textarea.removeAttr('required')
        }
      }
    })

  })

  function change_status(btn, status) {
    $('.radio_button').prop('checked', false)
    if (status == 3) {
      $('.approve').val(3)
      $('.approve').prop('checked', true)

    } else if (status == 2) {
      $('.reject').val(2)
      $('.reject').prop('checked', true)

    } else if (status == 4) {
      $('.pending').val(4)
      $('.pending').prop('checked', true)

    } else if (status == 0) {
      $('.pending').val('')
      $('.radio_button').prop('checked', false)
    }

    if (status == 2 || status == 4) {
      console.log(status)
      $('textarea').attr('required', true)
      // $('textarea').removeAttr('disabled')
    } else {
      // $('textarea').attr('disabled', true)
      $('textarea').removeAttr('required')
    }

  }

  function request_for_update(btn, submission_id) {
    var url = "<?= site_url('itr/request_for_update/') ?>" + submission_id
    $("#modal").modal({
      show: true,
      keyboard: false,
      backdrop: "static"
    }).find('.modal-body').load(url)
    $('.modal-title').text("Request For Update")
    $('.modal-dialog').addClass('modal-lg')
  }

  function show_image(btn, source) {

    var link_image = "<?= base_url() ?>"

    var url = `${link_image}file/` + source
    console.log(url)

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

  function change_area(event) {
    let original_area = "<?= $main_data['area'] ?>"
    let area = event.value

    Swal.fire({
      type: "warning",
      title: "Update Area",
      text: "Are You Sure To Update This Area ? ",
      allowOutsideClick: false,
      showCancelButton: true
    }).then((res) => {
      if (res.value) {
        $.ajax({
          url: "<?= site_url('material_verification/update_area') ?>",
          type: "POST",
          data: {
            area: area,
            submission_id: "<?= $main_data['submission_id'] ?>"
          },
          dataType: "JSON",
          success: function(data) {
            if (data.success) {
              Swal.fire({
                type: "success",
                title: "Success",
                text: "Success Update Area",
                timer: 1000
              })
            }
          }
        })
      } else {}
    })

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

  function update_data(btn) {
    let submission_id = "<?= $main_data['submission_id'] ?>"
    let area_v2 = $('select[name="area_v2"]').val()
    let location_v2 = $('select[name="location_v2"]').val()
    let point_v2 = $('select[name="point_v2"]').val()

    let msg

    if (!area_v2) {
      msg = "Area"
    } else if (!location_v2) {
      msg = "Location"
    }

    if (!area_v2 || !location_v2) {
      Swal.fire({
        type: "error",
        title: `${msg} Cannot Be Empty`,
        timer: 1000
      })

      return
    }

    $.ajax({
      url: "<?= site_url('itr/update_data_location') ?>",
      type: "POST",
      data: {
        submission_id: submission_id,
        area_v2: area_v2,
        location_v2: location_v2,
        point_v2: point_v2,
      },
      dataType: "JSON",
      success: function(data) {
        if (data.success) {
          Swal.fire({
            type: "success",
            title: "Data Has Been Updated",
            timer: 1000
          })

          setTimeout(() => {
            location.reload()
          }, 1000);
        }
      }
    })

  }
</script>