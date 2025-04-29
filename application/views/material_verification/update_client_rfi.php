<?php

// if($main_data['ga_rev_no'] != '') {
//   $drawing_ga_rev     = $main_data['ga_rev_no'];
//   $rev_link           = $main_data['ga_rev_no'];
// } else {
//   $drawing_ga_rev     = $data_drawing[$main_data['drawing_no']]['last_revision_no'];
//   $rev_link           = $data_drawing[$main_data['drawing_no']]['last_revision_no'];
// }

// test_var($main_data);

if ($main_data['ga_rev_no'] != '') {
  $drawing_ga_rev     = $main_data['ga_rev_no'];
} else {
  $drawing_ga_rev     = $main_data['rev_ga'];
}


if ($main_data['drawing_as'] != '') {
  if ($main_data['as_rev_no'] != '') {
    $rev_link           = $main_data['as_rev_no'];
  } else {
    $rev_link           = $main_data['rev_as'];
  }
} else {
  $rev_link           = $drawing_ga_rev;
}

$rev_used             = $drawing_ga_rev;

if (isset($data_drawing[$main_data['drawing_no']])) {

  $show_attachment_drawing  = true;

  $links_atc_ga             = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($data_drawing[$main_data['drawing_no']]['id']), '+=/', '.-~') . '/' . $drawing_ga_rev . '/' . strtr($this->encryption->encrypt(1), '+=/', '.-~');
  $links_atc_cross_ga       = base_url_ftp_eng() . "public_smoe/open_atc_cross/2/" . strtr($this->encryption->encrypt($data_drawing[$main_data['drawing_no']]['document_no']), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt($data_drawing[$main_data['drawing_no']]['id']), '+=/', '.-~') . '/' . $drawing_ga_rev . '/' . strtr($this->encryption->encrypt(1), '+=/', '.-~');
}

$links_atc        = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($drawing_eng['id']), '+=/', '.-~');
$links_atc_cross  = base_url_ftp_eng() . "public_smoe/open_atc_cross/2/" . strtr($this->encryption->encrypt($drawing_eng['document_no']), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt($drawing_eng['id']), '+=/', '.-~');


if (in_array($main_data['project_code'], project_by_deck())) {
  $running_report = $report_no_format[$main_data['project_code']][$main_data['company_id']][$main_data['discipline']][$main_data['module']][$main_data['type_of_module']][$main_data['deck_elevation']]['mv_no'];
} else {
  $running_report = $report_no_format[$main_data['project_code']][$main_data['company_id']][$main_data['discipline']][$main_data['module']][$main_data['type_of_module']]['mv_no'];
}
if ($main_data['company_id'] == 13) {
  $running_report = $report_no_format[$main_data['project_code']][$main_data['discipline']][$main_data['module']][$main_data['type_of_module']]['mv_no_smop'];
}
$is_last_status_approve = false;
$item_revise_list       = [];
foreach ($detail_data as $v) {
  if ($v['status_inspection'] == 5 && $v['latest_inspection_status'] == 7) {
    $is_last_status_approve = true;

    $item_revise_list[]     = $v;
  }
}

?>

<head>
  <link rel="stylesheet" href="style.css">
</head>
<style>
  th,
  td {
    vertical-align: middle !important;
  }

  .bg-postponed {
    background-color: #dff4f5;
  }

  .bg-reoffer {
    background-color: #fffdf0;
  }

  .input_width {
    width: 250px
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

  .bg-accepted-release {
    background-color: #deeaff;
  }
</style>
<?php error_reporting(0); ?>
<div id="content">
  <div class="container-fluid">
    <form action="<?= site_url('material_verification/proceed_update_client_rfi') ?>" enctype="multipart/form-data" method="post">
      <input type="hidden" name="project_code" value="<?= $main_data['project_code'] ?>">
      <input type="hidden" name="current_report" value="<?= $main_data['report_number'] ?>">
      <input type="hidden" name="drawing_no" value="<?= $main_data['drawing_no'] ?>">
      <input type="hidden" name="report_no_rev" value="<?= $main_data['report_no_rev'] ?>">
      <input type="hidden" name="report_no_rev" value="<?= $main_data['report_no_rev'] ?>">
      <input type="hidden" name="discipline" value="<?= $main_data['discipline'] ?>">
      <input type="hidden" name="module" value="<?= $main_data['module'] ?>">
      <input type="hidden" name="type_of_module" value="<?= $main_data['type_of_module'] ?>">
      <input type="hidden" name="company_id" value="<?= $main_data['company_id'] ?>">
      <div class="row">
        <div class="col-md-12">
          <div class="card border-0 shadow-sm">
            <div class="card-body">
              <h6 class="card-title">Material Inspection Update - <strong><?= $running_report ?>-<?= $main_data['report_number'] ?></strong></h6>
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Drawing GA</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" value="<?= $main_data['drawing_no'] ?> Rev. <?= $drawing_ga_rev ?>" disabled>
                      <?php if ($show_attachment_drawing) : ?>
                        <div class="mt-2">
                          <a target="_blank" href="<?= $links_atc_ga ?>"><i class="fas fa-paperclip"></i> Open Drawing</a>
                          <a target="_blank" href="<?= $links_atc_cross_ga ?>"><i class="ml-3 fas fa-cloud-download-alt"></i>
                            Download Drawing</a>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <!-- <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Workpack Number</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" value="<?= $main_data['workpack_no'] ?>" disabled>
                    </div>
                  </div>
                </div> -->
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
                    <label for="" class="col-xl-3 col-form-label text-muted">Deck Elevation / Service Line</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" value="<?= $deck_elevation[$main_data['deck_elevation']] ?>" disabled>
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
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Area</label>
                    <div class="col-xl">
                      <?php

                      if ($main_data['area_v2']) {
                        $data_area = $area_v2[$main_data['area_v2']]['name'];
                      } else {
                        $data_area = $area_name[$main_data['area']];
                      }
                      ?>
                      <input type="text" class="form-control" value="<?= $data_area ?>" disabled>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Location</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" value="<?= $location_v2[$main_data['location_v2']]['name'] ? $location_v2[$main_data['location_v2']]['name'] : '-' ?>" disabled>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Point</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" value="<?= $point_v2[$main_data['point_v2']]['name'] ? $point_v2[$main_data['point_v2']]['name'] : '-' ?>" disabled>
                    </div>
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Report Number</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" value="<?= $running_report ?>" disabled>
                    </div>
                    <div class="col-xl">
                      <input type="number" name="report_number_manual" class="form-control" value="<?= intval($main_data['report_number']) ?>">
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Inspection Client By</label>
                    <div class="col-xl">
                      <select name="inspection_client_by" id="" class="select2">
                        <option value="">---</option>
                        <?php foreach ($user_list as $key => $value) : ?>
                          <option value="<?= $value['id_user'] ?>" <?= $value['id_user'] == $main_data['inspection_client_by'] ? 'selected' : '' ?>><?= $value['full_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Inspection Client Date</label>
                    <div class="col-xl">
                      <input type="date" name="inspection_client_datetime" class="form-control" value="<?= $main_data['inspection_client_datetime'] ?>">
                    </div>

                  </div>
                </div>




              </div>

              <hr>

              <div class="row">

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Request Date</label>
                    <div class="col-xl">
                      <input type="date" name="date_request" class="form-control" value="<?= date("Y-m-d", strtotime($main_data['date_request'])) ?>">
                    </div>
                  </div>
                </div>

              </div>




              <?php if ($action == "detail") : ?>
                <hr>
                <div class="row">
                  <div class="col-md-12 col-sm">
                    <div class="btn-group">
                      <button type="button" class="btn btn-outline-success" onclick="change_status(this, 7)">Accept
                        All</button>
                      <button type="button" class="btn btn-outline-danger" onclick="change_status(this, 6)">Reject
                        All</button>

                      <button type="button" class="btn btn-outline-secondary" onclick="change_status(this, 0)">Clear
                        All</button>
                    </div>

                    <?php if ($no_pending > 0) { ?>
                      <?php if ($this->user_cookie[7] == 8 || $this->permission_cookie[219] == 1) { ?>
                        <?php if ($total_pending_revise_smoe <= 0) { ?>
                          <div class="ml-3 btn-group">
                            <button type="button" class="btn btn-primary" onclick="change_status(this, 9)"><i class="fas fa-sync-alt"></i>
                              Accepted And Released
                              With
                              Comment</button>

                            <button type="button" class="btn btn-info" onclick="change_status(this, 10)"><i class="fas fa-sync-alt"></i>
                              Postpone</button>
                            <button type="button" class="btn btn-warning" onclick="change_status(this, 11)"><i class="fas fa-sync-alt"></i>
                              Re-Offer</button>

                          </div>
                        <?php } ?>
                      <?php } ?>
                    <?php } ?>

                    <span class="ml-3 postponed_reoffer font-weight-bold"></span>
                  </div>

                  <?php if ($main_data['company_id'] == 13) : ?>
                    <div class="col-md-5 mt-3">
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

                </div>
              <?php else : ?>


                <div class="row">
                  <div class="col-md-12">
                    <hr>
                    <strong><i>Inspection Detail</i></strong>
                  </div>
                  <div class="col-md-4 mt-2">
                    <div class="form-group row">
                      <label for="" class="col-xl-4 col-form-label text-muted">Inspector Name</label>
                      <div class="col-xl">
                        <select name="inspector_id" class="select2" style="width: 100%">
                          <option value="0">---</option>
                          <?php foreach ($user_list as $key => $value) : ?>
                            <option value="<?= $value['id_user'] ?>" <?= $value['id_user'] == $main_data['inspector_id'] ? 'selected' : '' ?>>
                              <?= $value['full_name'] ?></option>
                          <?php endforeach; ?>
                        </select>
                        <!-- <input type="text" name="inspector_id" class="form-control" onfocus="autocomplete_inspector(this)"  required> -->
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12"></div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label for="" class="col-xl-4 col-form-label text-muted">Inspect Date</label>
                      <div class="col-xl">
                        <input type="date" name="inspect_date" class="form-control" value="<?= date('Y-m-d', strtotime($main_data['time_inspect'])) ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12"></div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label for="" class="col-xl-4 col-form-label text-muted">Inspect Time</label>
                      <div class="col-xl">
                        <input type="time" name="inspect_time" class="form-control" value="<?= date('H:i:s', strtotime($main_data['time_inspect'])) ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12"></div>
                  <!-- <div class="col-md-4">
                    <div class="form-group row">
                      <label for="" class="col-xl-4 col-form-label text-muted">Inspect Location</label>
                      <div class="col-xl">
                        <select name="inspect_location" class="select2" style="width:100%" required>
                          <?php foreach ($area_list as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>"
                            <?= $value['id'] == $main_data['location_inspect'] ? 'selected' : '' ?>>
                            <?= $value['area_name'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div> -->
                  <div class="col-md-12"></div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label for="" class="col-xl-4 col-form-label text-muted">Invitation Type</label>
                      <div class="col-xl">
                        <select name="status_invitation" class="select2" style="width:100%" required>
                          <option value="1" <?= $main_data['status_invitation'] == 1 ? 'selected' : '' ?>>Notification
                            Activity</option>
                          <option value="0" <?= $main_data['status_invitation'] == 0 ? 'selected' : '' ?>>Invitation
                            Witness
                          </option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12"></div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label for="" class="col-xl-4 col-form-label text-muted">Inspection Authority</label>
                      <?php
                      $inspection_auth_arr = explode(";", $main_data['legend_inspection_auth']);
                      ?>
                      <div class="col-xl">
                        <select name="inspection_authority[]" class="select2" style="width:100%" multiple required>
                          <option value="1" <?= $inspection_auth_arr[0] == 1 ? "selected" : "" ?>>Hold Point</option>
                          <option value="2" <?= $inspection_auth_arr[1] == 1 ? "selected" : "" ?>>Witness</option>
                          <option value="3" <?= $inspection_auth_arr[2] == 1 ? "selected" : "" ?>>Monitoring</option>
                          <option value="4" <?= $inspection_auth_arr[3] == 1 ? "selected" : "" ?>>Review</option>
                        </select>
                      </div>
                    </div>
                  </div>


                </div>
                <hr>
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="text-muted">GA Revision No.</label>
                      <select name="ga_rev_no_tr" class="select2" style="width: 100%;">
                        <?php foreach (array_unique($rev_list["1"]) as $key => $value) : ?>
                          <option value="<?= $value ?>" <?= $value == $drawing_ga_rev ? 'selected' : '' ?>><?= $value ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="text-muted">AS Revision No.</label>
                      <select name="as_rev_no_tr" class="select2" style="width: 100%;">
                        <?php foreach (array_unique($rev_list["2"]) as $key => $value) : ?>
                          <option value="<?= $value ?>" <?= $value == $main_data['as_rev_no'] ? 'selected' : '' ?>><?= $value ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <!-- <div class="col-md-2">
                      <div class="form-group">
                        <label class="text-muted">SP Revision No.</label>
                        <select name="sp_rev_no_tr" class="select2" style="width: 100%;">
                          <?php foreach (array_unique($rev_list["3"]) as $key => $value) : ?>
                            <option value="<?= $value ?>" <?= $value == $main_data['sp_rev_no'] ? 'selected' : '' ?>><?= $value ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div> -->
                </div>
              <?php endif; ?>

              <hr>
              <div class="col-md-12">
                <ul class="nav nav-pills border-bottom border-gray" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detail</a>
                  </li>
                  <!-- <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Revise History Log</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" id="red_line-tab" data-toggle="tab" href="#red_line" role="tab" aria-controls="red_line" aria-selected="false">Supporting Document</a>
                    </li> -->

                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row mt-3">




                      <div class="col-md-12">
                        <div class="table-responsive overflow-auto">
                          <table class="table table-hover text-center">
                            <thead class="bg-info text-white text-nowrap">
                              <th>No</th>
                              <th>Drawing SP</th>
                              <?php if ($action == "update") : ?>
                                <th class="bg-green-smoe">SP revision No.</th>
                              <?php endif; ?>
                              <th>Piece Mark No</th>
                              <th>Drawing AS</th>
                              <th>Drawing CP</th>
                              <th>Can No</th>
                              <th>Unique No</th>
                              <th>Spec / Grade</th>
                              <th>Heat No</th>
                              <th>Length</th>
                              <th>Thickness</th>
                              <th>Profile</th>
                              <!-- <th>Material Description</th> -->
                              <th style="min-width: 200px;">MRIR No</th>
                              <th>Mill Certificate No</th>
                              <th class="text-left">SMOE Inspection Status</th>
                              <th class="text-left">SMOE Inspection Remarks</th>
                              <th class="text-left">Client Status</th>
                              <th>Attachment</th>
                              <th>Remarks</th>
                            </thead>

                            <tbody>
                              <?php

                              $total_revise_template  = 0;
                              $total_pending          = 0;
                              $no                     = 1;

                              foreach ($detail_data as $key => $value) : ?>
                                <?php


                                ?>
                                <?php if ($value['status_delete_mv'] == 0) : ?>
                                  <?php

                                  if ($value['revision_status_inspection'] > 0) {
                                    $total_revise_template++;
                                  }
                                  $report_no      = explode('/', $detail_mis[$value['id_mis']]['report_no']);
                                  $report_no      = $report_no[1] . '-' . $detail_mis[$value['id_mis']]['partial_report_no'];

                                  $remarks  = $value['rejected_client_remarks'];

                                  if ($value['status_inspection'] == 5) {
                                    $total_pending++;
                                  }

                                  if ($value['sp_rev_no'] != '') {
                                    $drawing_sp_rev = $value['sp_rev_no'];
                                  } else {
                                    $drawing_sp_rev = $value['rev_sp'];
                                  }

                                  $links_sp = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($data_drawing[$value['drawing_sp']]['id']), '+=/', '.-~') . '/' . $drawing_sp_rev . '/' . strtr($this->encryption->encrypt(1), '+=/', '.-~');

                                  ?>
                                  <tr class="tr_row">
                                    <td>
                                      <input type="hidden" name="id_material[<?= $key ?>]" value="<?= $value['id_material'] ?>">
                                      <input type="hidden" name="id_mis[<?= $value['id_material'] ?>]" class="id_mis" value="<?= $value['id_mis'] ?>">
                                      <input type="hidden" name="revision_status_inspection[<?= $key ?>]" value="<?= $value['revision_status_inspection'] ?>">
                                      <?= $no++ ?>
                                      <?php //test_var($value, 1) 
                                      ?>
                                    </td>
                                    <td>
                                      <?php if ($value['drawing_sp']) : ?>
                                        <a href="<?= $links_sp ?>" target="_blank">
                                          <?= $value['drawing_sp'] ?> Rev.
                                          <?php if ($action == "update_report") : ?>
                                        </a>
                                        <select name="rev_drawing_sp[<?= $value['id_material'] ?>]" class="select2 editable" style="width:100%">
                                          <?php if (isset($rev_sp[$value['drawing_sp']])) : ?>
                                            <?php foreach ($rev_sp[$value['drawing_sp']] as $v) : ?>
                                              <option value="<?= $v ?>" <?= $v == $value['sp_rev_no'] ? 'selected' : '' ?>><?= $v ?></option>
                                            <?php endforeach; ?>
                                          <?php else : ?>
                                            <option value="">---</option>
                                          <?php endif; ?>
                                        </select>
                                      <?php else : ?>
                                        <?= $drawing_sp_rev ?>
                                        </a>
                                      <?php endif; ?>
                                    <?php endif; ?>
                                    </td>

                                    <?php if ($action == "update") : ?>
                                      <td>
                                        <select name="rev_drawing_sp[<?= $value['id_material'] ?>]" class="select2 editable" style="width:100%">
                                          <?php if (isset($rev_sp[$value['drawing_sp']])) : ?>
                                            <?php foreach ($rev_sp[$value['drawing_sp']] as $v) : ?>
                                              <option value="<?= $v ?>" <?= $v == $value['sp_rev_no'] ? 'selected' : '' ?>><?= $v ?></option>
                                            <?php endforeach; ?>
                                          <?php else : ?>
                                            <option value="">---</option>
                                          <?php endif; ?>
                                        </select>
                                      </td>
                                    <?php endif; ?>
                                    <td>
                                      <?= $value['part_id'] ?>
                                      <?php if ($piecemark_photo[$value['id_piecemark']]['evidence_mv'] != null) : ?>
                                        <?php

                                        $url_image = base_url();
                                        $enc_img              = strtr($this->encryption->encrypt($piecemark_photo[$value['id_piecemark']]['evidence_mv']), '+=/', '.-~');
                                        $enc_location         = strtr($this->encryption->encrypt('/PCMS/mobile/pcms_v2_mobile/pcms_v2_photo'), '+=/', '.-~');
                                        $open_img             = site_url('irn/open_file/' . $enc_img . '/' . $enc_location . '/download');

                                        ?>


                                        <a href="<?= $open_img ?>" target="_blank" class="btn btn-primary"><i class="fas fa-image"></i></a>

                                      <?php endif; ?>
                                    </td>
                                    <td>

                                      <?php

                                      if ($value['as_rev_no'] != '') {
                                        $drawing_as_rev = $value['as_rev_no'];
                                      } else {
                                        $drawing_as_rev = $value['rev_as'];
                                      }





                                      ?>
                                      <?php if ($value['drawing_as']) : ?>
                                        <?php

                                        $rev_used = $drawing_ga_rev;

                                        ?>
                                        <input type="hidden" name="as_rev_no[<?= $key ?>]" value="<?= $drawing_as_rev ?>">
                                        <?= $value['drawing_as'] ?> Rev. <?= $drawing_as_rev ?>
                                      <?php endif; ?>
                                    </td>
                                    <td>
                                      <?php
                                      if (@$value['cp_rev_no'] != '') {
                                        $drawing_cp_rev = $value['cp_rev_no'];
                                      } else {
                                        $drawing_cp_rev = $value['rev_cp'];
                                      }

                                      $links_cp = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($data_drawing[$value['drawing_cp']]['id']), '+=/', '.-~') . '/' . $drawing_cp_rev . '/' . strtr($this->encryption->encrypt(1), '+=/', '.-~');
                                      ?>
                                      <?php if ($value['drawing_cp']) : ?>
                                        <?php
                                        $rev_used = $drawing_ga_rev;
                                        ?>
                                        <a href="<?= $links_cp ?>" target="_blank">
                                          <?= $value['drawing_cp'] ?> Rev. <?= $drawing_cp_rev ?></a>
                                      <?php endif; ?>
                                    </td>
                                    <td><?= $value['can_number'] ? $value['can_number'] : '-' ?></td>
                                    <td>
                                      <input type="text" class="form-control" value="<?= $detail_mis[$value['id_mis']]['unique_no'] ?>" onfocus="autocomplete_unique(this, '<?= $main_data['workpack_no'] ?>', <?= $value['grade'] ?>, <?= $value['project_code'] ?>)" onblur="validate_unique_no(this, '<?= $main_data['workpack_no'] ?>', <?= $value['grade'] ?>, <?= $value['project_code'] ?>)" required>
                                    </td>
                                    <td><?= $grade[$value['grade']] ?></td>
                                    <td>
                                      <?php if ($action == "update") : ?>
                                        <input type="text" value="<?= $detail_mis[$value['id_mis']]['heat_or_series_no'] ?>" class="form-control heat_no input_width" disabled>
                                      <?php else : ?>
                                        <?= $detail_mis[$value['id_mis']]['heat_or_series_no'] ?>
                                      <?php endif; ?>
                                    </td>
                                    <td><?= $value['length'] ?></td>
                                    <td><?= $value['thickness'] ?></td>
                                    <td><?= $value['profile'] ?></td>

                                    <td>
                                      <!-- <?php if ($action == "update") : ?>
                                    <input type="text" value="<?= $report_no ?>"
                                      class="form-control report_no input_width" disabled>
                                    <?php else : ?>
                                    <?= $report_no ?>
                                    <?php endif; ?> -->

                                      <?php

                                      $detail_mrir            = $mrir_detail[$detail_mis[$value['id_mis']]['unique_ident_no']];

                                      $mrir_id                = strtr($this->encryption->encrypt($detail_mrir['mrir_id']), '+=/', '.-~');
                                      $status                 = strtr($this->encryption->encrypt($detail_mrir['status']), '+=/', '.-~');
                                      $partial_report_no      = strtr($this->encryption->encrypt($detail_mrir['partial_report_no']), '+=/', '.-~');

                                      $user_id_enc      = strtr($this->encryption->encrypt($user_cookie[0]), '+=/', '.-~');

                                      $link_wh        = "warehouse";
                                      if (ENVIRONMENT == "development") {
                                        $link_wh = "warehouse_v2";
                                      }

                                      $url_mrir         = getenv('IP_SERVER_WAREHOUSE');
                                      if ($this->input->ip_address() == getenv('IP_FIREWALL_GATEWAY')) {
                                        $url_mrir         = getenv('IP_SERVER_WAREHOUSE_OUTSIDE');
                                      }

                                      $link_mrir              = "https://" . $url_mrir . "/$link_wh/public_smoe/detail_mrir_cs/?id=" . $mrir_id . '&action=' . strtr($this->encryption->encrypt('detail'), '+=/', '.-~') . '&status=' . $status . '&partial_report_no=' . $partial_report_no . '&user_id=' . $user_id_enc;

                                      ?>

                                      <a href="<?= $link_mrir ?>" target="_blank"><?= $report_no ?></a>
                                    </td>

                                    <td><?= $detail_mis[$value['id_mis']]['mill_cert_no'] ?></td>

                                    <td>
                                      <?php if ($value['status_inspection'] < 5) : ?>
                                        <?php if ($value['status_inspection'] == 1) : ?>
                                          <span class="badge badge-pill badge-primary">Pending Approval</span>

                                        <?php elseif ($value['status_inspection'] == 2) : ?>
                                          <span class="badge badge-pill badge-danger">Rejected</span>

                                        <?php elseif ($value['status_inspection'] == 3) : ?>
                                          <span class="badge badge-pill badge-success">Approved</span>

                                        <?php elseif ($value['status_inspection'] == 4) : ?>
                                          <span class="badge badge-pill badge-info">Hold By QC</span>

                                        <?php endif; ?>
                                      <?php else : ?>
                                        <span class="badge badge-pill badge-success">Approved</span>

                                      <?php endif; ?>
                                    </td>
                                    <td>
                                      <?= $value['inspection_remarks'] ? $value['inspection_remarks'] : '-' ?>
                                    </td>
                                    <td class="text-left text-nowrap">
                                      -

                                    </td>
                                    <td class="bg-white">
                                      <?php if (isset($attachment_history[$value['id_material']])) : ?>

                                        <div class="row mt-3">
                                          <div class="col-md-12">
                                            <div class="table-responsive">
                                              <table class="table table-bordered">
                                                <thead class="alert-success ">
                                                  <th>No</th>
                                                  <th>Attachment</th>
                                                  <th>Remarks</th>
                                                  <th>Uploaded By</th>
                                                  <th>Uploaded Date</th>
                                                </thead>
                                                <tbody>
                                                  <?php $no_attachment = 1;
                                                  foreach ($attachment_history[$value['id_material']] as $v) : ?>
                                                    <tr>
                                                      <td><?= $no_attachment++ ?></td>
                                                      <td>

                                                        <?php if (@getimagesize("https://www.smoebatam.com/pcms_v2_photo/fab_img/" . $v['filename'])) : ?>

                                                          <img onclick="show_image(this, '<?= $v['filename'] ?>', 'client')" src="https://www.smoebatam.com/pcms_v2_photo/fab_img/<?= $v['filename'] ?>" style="width: 100px">

                                                        <?php else : ?>
                                                          <a target="_blank" href="https://www.smoebatam.com/pcms_v2_photo/fab_img/<?= $v['filename'] ?>"><?= $v['filename'] ?></a>

                                                        <?php endif; ?>
                                                      </td>
                                                      <td><?= $v['remarks'] ?></td>
                                                      <td>
                                                        <?= isset($uploader[$v['created_by']]) ? $uploader[$v['created_by']]['full_name'] : '-' ?>
                                                      </td>
                                                      <td><?= $v['created_date'] ?></td>
                                                    </tr>
                                                  <?php endforeach; ?>
                                                </tbody>
                                              </table>
                                            </div>
                                          </div>
                                        </div>

                                      <?php endif; ?>
                                      <?php if ($value['status_inspection'] != 6) : ?>
                                        <div class="custom-file">
                                          <input type="file" onclick="delete_attachment(this)" onchange="change_label_attachment(this)" class="custom-file-input attachment_client input_width" id="customFile" name="attachment_client[<?= $key ?>]" disabled>
                                          <label class="custom-file-label text-left" for="customFile">Choose file</label>
                                        </div>
                                      <?php endif; ?>
                                    </td>
                                    <td>
                                      <textarea name="reject_client_remarks[<?= $key ?>]" class="form-control input_width" <?= $value['status_inspection'] != 0 ? 'disabled' : '' ?>><?= $remarks ?></textarea>
                                    </td>
                                  </tr>
                                <?php endif; ?>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <hr>
                        <div class="float-right">



                          <a target="_blank" href="<?= $links_atc . '/' . $rev_link . '/' . strtr($this->encryption->encrypt(1), '+=/', '.-~') ?>" class="btn btn-primary"><i class="fas fa-paperclip"></i>
                            File Drawing</a>
                          <a target="_blank" href="<?= $links_atc_cross . '/' . $rev_link . '/' . strtr($this->encryption->encrypt(1), '+=/', '.-~') ?>" class="btn btn-green-smoe text-white mr-5" download='<?= $drawing_eng['document_no'] ?>.pdf'><i class="fas fa-cloud-download-alt"></i>
                            Download
                            Drawing</a>

                          <a href="<?= site_url('material_verification/client_rfi') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                          <a href="<?= site_url('material_verification/transmittal_verification_pdf/' . $project_id_enc . '/' . $discipline_enc . '/' . $type_of_module_enc . '/' . $module_enc . '/' . $report_enc . '/' . $report_rev_enc . '/' . $drawing_no_enc . '/' . encrypt($main_data['company_id']) . '/' . encrypt($main_data['deck_elevation'])) ?>" class="btn btn-success"><i class="fas fa-file-pdf"></i> RFI</a>

                          <a href="<?= site_url('material_verification/material_verification_pdf_client/' . $project_id_enc . '/' . $discipline_enc . '/' . $type_of_module_enc . '/' . $module_enc . '/' . $report_enc . '/' . $report_rev_enc . '/' . $drawing_no_enc . '/' . encrypt($main_data['company_id']) . '/' . encrypt($main_data['deck_elevation'])) ?>" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Report</a>
                          <button type="submit" class="btn btn-warning"><i class="fas fa-edit"></i> Update</button>
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
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane fade" id="red_line" role="tabpanel" aria-labelledby="red_line-tab">
                    <div class="row mt-3">
                      <div class="col-md-12">
                        <button class="btn btn-info" onclick="add_attachment_redline_modal(this, <?= $main_data['id_material'] ?>)" type="button"><i class="fas fa-plus-circle"></i> Add Red-Line</button>
                      </div>
                      <div class="col-md-12 mt-2">
                        <div class="table-responsive overflow-auto">
                          <table class="table table-hover text-center" id="table_attachment">
                            <thead class="bg-secondary text-white">
                              <th>No</th>
                              <th>Drawing No</th>
                              <th>Redline File</th>
                              <th>Upload By</th>
                              <th>Upload Date</th>
                              <th>Remarks</th>
                              <th>Action</th>
                            </thead>
                            <tbody>
                              <?php $no = 1;
                              foreach ($attachment_list as $key => $value) : ?>
                                <tr>
                                  <td><?= $no++ ?></td>
                                  <td><?= $value['drawing_no'] ?></td>
                                  <td>

                                    <?php

                                    $enc_redline = strtr($this->encryption->encrypt($value['filename']), '+=/', '.-~');
                                    $enc_path   = strtr($this->encryption->encrypt('/PCMS/pcms_v2/redline_attachment/'), '+=/', '.-~');

                                    ?>
                                    <a target='_blank' href='<?= site_url('irn/open_file/' . $enc_redline . '/' . $enc_path) ?>'>Links</a>
                                  </td>
                                  <td><?= $user[$value['upload_by']]['full_name'] ?></td>
                                  <td><?= $value['upload_date'] ?></td>
                                  <td><?= $value['description'] ?></td>
                                  <td><button class="btn btn-danger" type="button" onclick="delete_attachment_redline(this, <?= $value['id_redline'] ?>)"><i class="fas fa-trash"></i></button></td>
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
      order: [],
    })

    $("#table_attachment").DataTable({
      order: [],
    })

    $('.radio_button').change(function() {
      var val = $(this).val()
      var textarea = $(this).closest('tr').find('textarea')
      var attachment_client = $(this).closest('tr').find('.attachment_client')

      if (this.checked) {
        attachment_client.removeAttr('disabled')
        attachment_client.removeAttr('required')
        console.log(val)
        if (val != 7) {
          textarea.removeAttr('disabled')
          textarea.attr('required', true)

          if (val == 6) {
            attachment_client.attr('required', true)
          }

        } else {
          textarea.removeAttr('required')
          textarea.attr('disabled', true)
          attachment_client.removeAttr('required')
        }
      } else {
        attachment_client.attr('disabled', true)
        attachment_client.removeAttr('required')
      }
    })

  })

  function change_status(btn, status) {
    $('.radio_button').prop('checked', false)
    $('.tr_row').removeClass('bg-postponed bg-reoffer bg-accepted-release')
    $('.editable').removeAttr('disabled')
    $('.postponed_reoffer').html('')
    $('.postponed_reoffer').removeClass('text-info text-warning')


    if (status == 7) {
      $('.approve').val(7)
      $('.approve').prop('checked', true)
      $('.attachment_client').removeAttr('disabled')
      $('.attachment_client').removeAttr('required')

    } else if (status == 6) {
      $('.reject').val(6)
      $('.reject').prop('checked', true)
      $('.attachment_client').removeAttr('disabled')
      $('.attachment_client').attr('required', true)


    } else if (status == 9) {
      $('.tr_row').addClass('bg-accepted-release')
      $('.approve_comment').val(9)
      $('.editable').attr('disabled', true)
      $('.approve_comment').prop('checked', true)
      $('.attachment_client').removeAttr('disabled')
      $('.attachment_client').removeAttr('required')

      $('.postponed_reoffer').addClass('text-primary')
      $('.postponed_reoffer').html(`
      <i class="fas fa-info-circle"></i> <i>This RFI Will Be Accepted And Release With Comment </i>
    `)


    } else if (status == 10) {
      $('.tr_row').addClass('bg-postponed')
      $('.editable').attr('disabled', true)
      $('.postponed_reoffer').addClass('text-info')
      $('.postponed_reoffer').html(`
      <i class="fas fa-info-circle"></i> <i>This RFI Will Be Postponed </i>
    `)

      $('.postponed').val(10)
      $('.postponed').prop('checked', true)
      $('.attachment_client').removeAttr('disabled')
      $('.attachment_client').removeAttr('required')

    } else if (status == 11) {
      $('.tr_row').addClass('bg-reoffer')
      $('.editable').attr('disabled', true)

      $('.postponed_reoffer').addClass('text-warning')
      $('.postponed_reoffer').html(`
      <i class="fas fa-info-circle"></i> <i>This RFI Will Be Re-Offered </i>
    `)

      $('.reoffer').val(11)
      $('.reoffer').prop('checked', true)
      $('.attachment_client').removeAttr('disabled')
      $('.attachment_client').removeAttr('required')

    } else if (status == 4) {
      $('.pending').val(4)
      $('.pending').prop('checked', true)

    } else if (status == 0) {
      $('.pending').val('')
      $('.radio_button').prop('checked', false)
      $('.attachment_client').attr('disabled', true)
      $('.attachment_client').removeAttr('required')

    }

    if (status != 7 && status != 0) {
      $('textarea').removeAttr('disabled')
      $('textarea').attr('required', true)
    } else {
      $('textarea').removeAttr('required')
      $('textarea').attr('disabled', true)
    }

  }

  function delete_attachment(input) {
    $(input).val('')
  }

  function change_label_attachment(input) {
    var val = $(input).val()
    var split = val.split('\\')
    var label = $(input).closest('.custom-file').find('label')
    label.text(split[split.length - 1])

  }

  function show_image(btn, source, type) {

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

  function autocomplete_unique(input, workpack_no, grade, id_workpack) {

    $(input).autocomplete({
      source: "<?php echo base_url(); ?>material_verification/autocomplete_unique_no/" + grade + '/' + id_workpack,
      autoFocus: true,
      classes: {
        "ui-autocomplete": "highlight"
      }
    });
  }

  function validate_unique_no(input, workpack_no, grade, id_workpack) {
    var unique_no = $(input).val()
    var invalid_feedback = $(input).closest('tr').find('.invalid-feedback')
    var mrir = $(input).closest('tr').find('.mrir')
    var heat_no = $(input).closest('tr').find('.heat_no')
    var material_description = $(input).closest('tr').find('.material_description')
    var id_mis = $(input).closest('tr').find('.id_mis')

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
        console.log(data)
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

  function add_attachment_redline_modal(btn, id_material) {

    let url = "<?= site_url('material_verification/add_attachment_redline/') ?>" + id_material

    $("#modal").modal({
      show: true,
      keyboard: false,
      backdrop: "static"
    }).find('.modal-body').load(url)
    $('.modal-title').text("Add Attachment Red-Line")
    $('.modal-dialog').addClass('modal-lg')

  }

  function delete_attachment_redline(btn, id) {
    Swal.fire({
      type: "warning",
      title: "Delete",
      text: "Are You Sure To Delete This ?",
      showCancelButton: true
    }).then((res) => {
      if (res.value) {
        $.ajax({
          url: "<?= site_url('material_verification/delete_attachment_redline') ?>",
          type: "POST",
          data: {
            id: id
          },
          dataType: "JSON",
          success: function(data) {
            if (data.success) {
              Swal.fire({
                type: "success",
                title: "Data Has Been Deleted",
                timer: 1000
              })

              $(btn).closest('tr').remove()
            }
          }
        })
      }
    })
  }

  // $(document).ready(function() {
  //   setTimeout(() => {
  //     $.ajax({
  //       url: "<?= site_url('material_verification/unlink_file') ?>",
  //       type: "POST",
  //       data: {
  //         attachment_list: <?= json_encode($list_photo) ?>
  //       },
  //       success: function(data) {}
  //     })
  //   }, 10000);
  // })
</script>