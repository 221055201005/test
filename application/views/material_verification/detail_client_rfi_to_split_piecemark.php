<?php

// if($main_data['ga_rev_no'] != '') {
//   $drawing_ga_rev     = $main_data['ga_rev_no'];
//   $rev_link           = $main_data['ga_rev_no'];
// } else {
//   $drawing_ga_rev     = $data_drawing[$main_data['drawing_no']]['last_revision_no'];
//   $rev_link           = $data_drawing[$main_data['drawing_no']]['last_revision_no'];
// }

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

$running_report = $running_report . '-' . $main_data['report_number'];

if ($main_data['report_no_rev'] > 0) {
  $running_report = $running_report . ' Rev.' . $main_data['report_no_rev'];
}

$is_last_status_approve = false;
$item_revise_list       = [];
foreach ($detail_data as $v) {
  if ($v['status_inspection'] == 5 && $v['latest_inspection_status'] == 7) {
    $is_last_status_approve = true;

    $item_revise_list[]     = $v;
  }
}

$wh_link = wh_base_url();

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
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h6 class="card-title">Material Inspection Detail - <strong><?= $running_report ?></strong></h6>
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
                </div>
              </div>

              <!-- <div class="col-md-6">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Revision</label>
                  <div class="col-xl">

                    <input type="text" class="form-control" value="<?= $main_data['report_no_rev'] ?>" disabled>
                  </div>
                </div>
              </div> -->
            </div>


            <form action="<?= site_url('material_verification/split_report') ?>" enctype="multipart/form-data" method="post">
              <div class="row">
                <div class="col-md-12">
                  <hr>
                  <strong><i>Inspection Detail</i></strong>
                </div>
                <div class="col-md-4 mt-2">
                  <div class="form-group row">
                    <label for="" class="col-xl-4 col-form-label text-muted">Transmit by</label>
                    <div class="col-xl">
                      <select name="transmittal_by" class="select2" style="width: 100%">
                        <option value="0">---</option>
                        <?php foreach ($user_list as $key => $value) : ?>
                          <option value="<?= $value['id_user'] ?>" <?= $value['id_user'] == $main_data['transmittal_by'] ? 'selected' : '' ?>>
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
                    <label for="" class="col-xl-4 col-form-label text-muted">Transmit Date</label>
                    <div class="col-xl">
                      <input type="date" name="transmittal_date" class="form-control" value="<?= date('Y-m-d', strtotime($main_data['transmittal_datetime'])) ?>" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-4">
                  <div class="form-group row">
                    <label for="" class="col-xl-4 col-form-label text-muted">Transmit Time</label>
                    <div class="col-xl">
                      <input type="time" name="transmittal_time" class="form-control" value="<?= date('H:i:s', strtotime($main_data['transmittal_datetime'])) ?>" required>
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
                        <option value=""> --- </option>
                        <option value="1" <?= $main_data['status_invitation'] == 1 ? 'selected' : '' ?>>Notification Activity</option>
                        <option value="0" <?= $main_data['status_invitation'] == 0 ? 'selected' : '' ?>>Invitation Witness
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
                    $text_legend = explode(";", $main_data['legend_inspection_auth']);
                    ?>
                    <div class="col-xl">
                      <select name="inspection_authority[]" class="select2" style="width:100%" multiple required>
                        <option value="1" <?= in_array('1', $text_legend) ? "selected" : "" ?>>Hold Point</option>
                        <option value="2" <?= in_array('2', $text_legend) ? "selected" : "" ?>>Witness</option>
                        <option value="3" <?= in_array('3', $text_legend) ? "selected" : "" ?>>Monitoring</option>
                        <option value="4" <?= in_array('4', $text_legend) ? "selected" : "" ?>>Review</option>

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
              </div>


              <!-- <input type="hidden" name="approval_code_log" value="MV/<?= $project_name[$main_data['project_code']] ?>/<?= $main_data['report_number'] ?>/"> -->

              <hr>
              <div class="col-md-12">
                <ul class="nav nav-pills border-bottom border-gray" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detail</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row mt-3">
                      <div class="col-md-12">
                        <div class="table-responsive overflow-auto">
                          <table class="table table-hover text-center">
                            <thead class="bg-info text-white text-nowrap">
                              <th>#</th>
                              <th>No</th>
                              <th>Drawing SP</th>
                              <th>Piece Mark No</th>
                              <th>Drawing AS</th>
                              <th>Drawing CP</th>
                              <th>Can No</th>
                              <th>Unique No</th>
                              <th>Spec / Grade</th>
                              <th>Heat No</th>
                              <th>Length</th>
                              <th>Thickness</th>
                              <th>Sch</th>
                              <th>Profile</th>
                              <!-- <th>Material Description</th> -->
                              <th style="min-width: 200px;">MRIR No</th>
                              <th>Mill Certificate No</th>
                            </thead>
                            <tbody>
                              <?php

                              $total_revise_template  = 0;
                              $total_pending          = 0;
                              $no                     = 1;

                              foreach ($detail_data as $key => $value) :
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
                                      <div class="custom-control custom-checkbox mr-sm-2">
                                        <style>
                                          .cek-checkbox {
                                            transform: scale(1.5);
                                            margin: 10px;
                                          }
                                        </style>

                                        <input type="checkbox" class="cek-checkbox" name="id_split[<?= $key ?>]" value="<?= $value['id_material'] ?>">
                                        <input type="input" hidden name="id_mis[<?= $key ?>]" class="id_mis" value="<?= $value['id_mis'] ?>">
                                        <input type="input" hidden name="revision_status_inspection[<?= $key ?>]" value="<?= $value['revision_status_inspection'] ?>">

                                        <!-- Data Main to submit -->
                                        <input type="input" hidden name="drawing_no[<?= $key ?>]" value="<?= $value['drawing_no'] ?>">
                                        <input type="input" hidden name="drawing_sp[<?= $key ?>]" value="<?= $value['drawing_sp'] ?>">
                                        <input type="input" hidden name="id_piecemark[<?= $key ?>]" value="<?= $value['id_piecemark'] ?>">
                                        <input type="input" hidden name="drawing_as[<?= $key ?>]" value="<?= $value['drawing_as'] ?>">
                                        <input type="input" hidden name="drawing_cp[<?= $key ?>]" value="<?= $value['drawing_cp'] ?>">
                                        <input type="input" hidden name="can_number[<?= $key ?>]" value="<?= $value['can_number'] ?>">
                                        <input type="input" hidden name="id_mis[<?= $key ?>]" value="<?= $value['id_mis'] ?>">
                                        <input type="input" hidden name="grade[<?= $key ?>]" value="<?= $value['grade'] ?>">

                                        <input type="input" hidden name="length[<?= $key ?>]" value="<?= $value['length'] ?>">
                                        <input type="input" hidden name="thickness[<?= $key ?>]" value="<?= $value['thickness'] ?>">
                                        <input type="input" hidden name="sch[<?= $key ?>]" value="<?= $value['sch'] ?>">
                                        <input type="input" hidden name="profile[<?= $key ?>]" value="<?= $value['profile'] ?>">
                                        <input type="input" hidden name="inspection_remarks[<?= $key ?>]" value="<?= $value['profile'] ?>">
                                        <input type="input" hidden name="status_inspection[<?= $key ?>]" value="<?= $value['status_inspection'] ?>">
                                        <input type="input" hidden name="report_number[<?= $key ?>]" value="<?= $value['report_number'] ?>">
                                        <input type="input" hidden name="report_no_rev[<?= $key ?>]" value="<?= $value['report_no_rev'] ?>">

                                        <input type="input" hidden name="company_id" value="<?= $value['company_id'] ?>">
                                        <input type="input" hidden name="project_code" value="<?= $value['project_code'] ?>">
                                        <input type="input" hidden name="discipline" value="<?= $value['discipline'] ?>">
                                        <input type="input" hidden name="module" value="<?= $value['module'] ?>">
                                        <input type="input" hidden name="type_of_module" value="<?= $value['type_of_module'] ?>">
                                        <input type="input" hidden name="deck_elevation" value="<?= $value['deck_elevation'] ?>">
                                        <input type="input" hidden name="total_data_material" value="<?= count($detail_data) ?>">
                                        <input type="input" hidden name="ga_rev_no" value="<?= $drawing_ga_rev ?>">
                                    </td>
                                    <td>
                                      <?= $no++ ?>
                                      <?php //test_var($value, 1) 
                                      ?>
                                    </td>
                                    <td>
                                      <?php if ($value['drawing_sp']) : ?>
                                        <a href="<?= $links_sp ?>" target="_blank">
                                          <?= $value['drawing_sp'] ?> Rev. <?= $drawing_sp_rev ?></a>
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
                                        $enc_img              = encrypt($piecemark_photo[$value['id_piecemark']]['evidence_mv']);
                                        $enc_location         = encrypt('/PCMS/mobile/pcms_v2_mobile/pcms_v2_photo');
                                        $open_img             = site_url('public_smoe/open_file_syn/' . $enc_img . '/' . $enc_location);

                                        ?>

                                        <br>
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
                                    <td class="text-nowrap">
                                      <?php if ($action == "update") : ?>

                                        <?php if ($value['piping_testing_category'] == 1) : ?>
                                          <?php foreach (explode(";", $value['id_mis_piping']) as $k => $v) : ?>
                                            <input type="text" class="form-control input_width" value="<?= $detail_mis[$v]['unique_no'] ?>" onfocus="autocomplete_unique(this, '<?= $main_data['workpack_no'] ?>', <?= $value['grade'] ?>, <?= $value['id_workpack'] ?>)" onblur="validate_unique_no_2(this, '<?= $main_data['workpack_no'] ?>', <?= $value['grade'] ?>, <?= $value['id_workpack'] ?>, <?= $k ?>)" required>
                                            <div class="invalid-feedback"></div>
                                            <br>
                                            <input type="hidden" name="id_mis_piping_input[<?= $value['id_material'] ?>][]" class="id_mis_pip_input" value="<?= $v ?>">
                                          <?php endforeach; ?>
                                        <?php else : ?>
                                          <input type="text" class="form-control input_width" value="<?= $detail_mis[$value['id_mis']]['unique_no'] ?>" onfocus="autocomplete_unique(this, '<?= $main_data['workpack_no'] ?>', <?= $value['grade'] ?>, <?= $value['id_workpack'] ?>)" onblur="validate_unique_no(this, '<?= $main_data['workpack_no'] ?>', <?= $value['grade'] ?>, <?= $value['id_workpack'] ?>)" required>
                                          <div class="invalid-feedback"></div>
                                        <?php endif; ?>

                                      <?php else : ?>

                                        <?php if ($value['piping_testing_category'] == 1) : ?>
                                          <?php foreach (explode(";", $value['id_mis_piping']) as $v) : ?>
                                            <?= $detail_mis[$v]['unique_no'] ?>
                                            <br>
                                          <?php endforeach; ?>
                                        <?php else : ?>
                                          <?= $detail_mis[$value['id_mis']]['unique_no'] ?>
                                        <?php endif; ?>

                                      <?php endif; ?>
                                    </td>
                                    <td><?= $grade[$value['grade']] ?></td>
                                    <td>
                                      <?php if ($action == "update") : ?>

                                        <?php if ($value['piping_testing_category'] == 1) : ?>
                                          <?php foreach (explode(";", $value['id_mis_piping']) as $k => $v) : ?>
                                            <input type="text" value="<?= $detail_mis[$v]['heat_or_series_no'] ?>" class="form-control heat_no_piping_<?= $k ?> input_width" disabled>
                                            <br>
                                          <?php endforeach; ?>
                                        <?php else : ?>
                                          <input type="text" value="<?= $detail_mis[$value['id_mis']]['heat_or_series_no'] ?>" class="form-control heat_no input_width" disabled>
                                        <?php endif; ?>


                                      <?php else : ?>
                                        <?php if ($value['piping_testing_category'] == 1) : ?>
                                          <?php foreach (explode(";", $value['id_mis_piping']) as $v) : ?>
                                            <?= $detail_mis[$v]['heat_or_series_no'] ?>
                                            <br>
                                          <?php endforeach; ?>
                                        <?php else : ?>
                                          <?= $detail_mis[$value['id_mis']]['heat_or_series_no'] ?>
                                        <?php endif; ?>
                                      <?php endif; ?>
                                    </td>
                                    <td><?= $value['length'] ?></td>
                                    <td><?= $value['thickness'] ?></td>
                                    <td><?= $value['sch'] ?></td>
                                    <td><?= $value['profile'] ?></td>
                                    <td>
                                      <?php

                                      $detail_mrir            = $mrir_detail[$detail_mis[$value['id_mis']]['unique_ident_no']];
                                      $unique_disc            = $detail_mis[$value['id_mis']]['discipline'];


                                      $mrir_id                = strtr($this->encryption->encrypt($detail_mrir['mrir_id']), '+=/', '.-~');
                                      $status                 = strtr($this->encryption->encrypt($detail_mrir['status']), '+=/', '.-~');
                                      $partial_report_no      = strtr($this->encryption->encrypt($detail_mrir['partial_report_no']), '+=/', '.-~');
                                      $action_enc             = strtr($this->encryption->encrypt("detail"), '+=/', '.-~');

                                      $user_id_enc      = strtr($this->encryption->encrypt($user_cookie[0]), '+=/', '.-~');

                                      // $link_mrir              = $wh_link . "mrir/detail_mrir_cs/?id=" . $mrir_id . '&action=' . strtr($this->encryption->encrypt('detail'), '+=/', '.-~') . '&status=' . $status . '&partial_report_no=' . $partial_report_no . '&user_id=' . $user_id_enc;

                                      $link_mrir = $wh_link . 'mb/detail_mrir_cs/' . $unique_disc . '/?id=' . $mrir_id . '&action=' . $action_enc . '&status=' . $status . '&partial_report_no=' . $partial_report_no . '&user=' . $user_id_enc;

                                      ?>

                                      <?php if ($value['piping_testing_category'] == 1) : ?>
                                        <?php foreach (explode(";", $value['id_mis_piping']) as $v) : ?>
                                          <?php
                                          $detail_mrir            = $mrir_detail[$detail_mis[$v]['unique_ident_no']];

                                          $mrir_id                = strtr($this->encryption->encrypt($detail_mrir['mrir_id']), '+=/', '.-~');
                                          $status                 = strtr($this->encryption->encrypt($detail_mrir['status']), '+=/', '.-~');
                                          $partial_report_no      = strtr($this->encryption->encrypt($detail_mrir['partial_report_no']), '+=/', '.-~');

                                          $user_id_enc      = strtr($this->encryption->encrypt($user_cookie[0]), '+=/', '.-~');

                                          $link_wh        = "warehouse";
                                          if (ENVIRONMENT == "development") {
                                            $link_wh = "warehouse_v2";
                                          }

                                          $url_mrir         = getenv('IP_SERVER_WAREHOUSE');
                                          if ($this->user_cookie[12] == getenv('IP_FIREWALL_GATEWAY')) {
                                            $url_mrir         = getenv('IP_SERVER_WAREHOUSE_OUTSIDE');;
                                          }

                                          $link_mrir              = "https://" . $url_mrir . "/$link_wh/public_smoe/detail_mrir_cs/?id=" . $mrir_id . '&action=' . strtr($this->encryption->encrypt('detail'), '+=/', '.-~') . '&status=' . $status . '&partial_report_no=' . $partial_report_no . '&user_id=' . $user_id_enc;

                                          $report_no      = explode('/', $detail_mis[$v]['report_no']);
                                          $report_no      = $report_no[1] . '-' . $detail_mis[$v]['partial_report_no'];

                                          ?>
                                          <a href="<?= $link_mrir ?>" target="_blank"><?= $report_no ?></a>
                                          <br>
                                        <?php endforeach; ?>
                                      <?php else : ?>
                                        <a href="<?= $link_mrir ?>" target="_blank"><?= $report_no ?></a>
                                      <?php endif; ?>



                                    </td>

                                    <td>
                                      <?php if ($value['piping_testing_category'] == 1) : ?>
                                        <?php foreach (explode(";", $value['id_mis_piping']) as $v) : ?>
                                          <?= $detail_mis[$v]['mill_cert_no'] ?>
                                          <br>
                                        <?php endforeach; ?>
                                      <?php else : ?>
                                        <?= $detail_mis[$value['id_mis']]['mill_cert_no'] ?>
                                      <?php endif; ?>
                                    </td>

                                  </tr>
                                <?php endif; ?>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                      </div>

                      <?php if ($main_data['project_code'] == 14) : ?>
                        <div class="col-md-12">
                          <hr>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="" class="text-muted"> <strong>Accepted Remarks</strong></label>
                            <textarea name="accepted_remarks" id="" rows="4" class="form-control" <?= $total_pending > 0 ? '' : 'disabled' ?>><?= $main_data['accepted_remarks'] ?></textarea>
                          </div>
                        </div>
                      <?php endif; ?>
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
                          <?php if (count($detail_data) == $total_approve) : ?>
                            <span class="btn btn-success"><i class="fas fa-check-circle"></i> All Data Has Been
                              Approved</span>
                          <?php else : ?>

                            <?php if ($action == "update") : ?>

                              <?php if ($total_revise_template > 0) : ?>
                                <span class="btn btn-secondary"><i class="fas fa-hourglass-half"></i> On Progress
                                  Revise</span>
                              <?php else : ?>
                                <?php if ($main_data['report_resubmit_status'] == 0) : ?>
                                  <!-- <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Re -
                                    Transmit</button> -->
                                <?php endif; ?>
                              <?php endif; ?>

                            <?php else : ?>
                              <?php if ($total_pending > 0) : ?>
                                <?php if ($total_revise_template > 0) : ?>
                                  <span class="btn btn-secondary"><i class="fas fa-hourglass-half"></i> On Progress Revise</span>
                                <?php else : ?>
                                  <button type="submit" class="btn btn-primary" name="tombol_submit" value="Split"><i class="fas fa-save"></i> Split</button>
                                  <button type="submit" class="btn btn-warning" name="tombol_submit" value="Return"><i class="fas fa-undo"></i> Return</button>
                                <?php endif; ?>
                              <?php endif; ?>
                            <?php endif; ?>
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
      </div>
    </div>
  </div>
</div>
</div>
</div>

<script>
  $(document).ready(function() {
    $('form').on('submit', function() {
      // $('button[type=submit]').attr('disabled', true)
      Swal.fire({
        title: 'Submitting...',
        allowOutsideClick: false,
        onBeforeOpen: () => {
          Swal.showLoading()
        },
      });
    })

    $("#table_revise").DataTable({
      order: [],
    })

    $("#table_attachment").DataTable({
      order: [],
    })

    $('.radio_button').change(function() {
      var val = $(this).val()
      var textarea = $(this).closest('tr').find('.remarks_pc')
      var attachment_client = $(this).closest('tr').find('.attachment_client')

      if (this.checked) {
        attachment_client.removeAttr('disabled')
        attachment_client.removeAttr('required')
        console.log(val)
        if (val != 7) {
          textarea.removeAttr('disabled')
          textarea.attr('required', true)

          if (val == 6) {
            // attachment_client.attr('required', true)
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

  //updatemahmud1
  function add_comment_stat(status, no) {
    $('input[name="add_comment[' + no + ']"]').val(status);
  }
  //updatemahmud1
  //updatemahmud1
  function change_status(btn, status, add_comment) {
    //updatemahmud1
    $('.radio_button').prop('checked', false)
    $('.tr_row').removeClass('bg-postponed bg-reoffer bg-accepted-release')
    $('.editable').removeAttr('disabled')
    $('.postponed_reoffer').html('')
    $('.postponed_reoffer').removeClass('text-info text-warning')

    //updatemahmud1
    if (status == 7 && add_comment == "accept") {
      //updatemahmud1

      $('.approve').val(7)
      //updatemahmud1
      $('.add_comment_status').val('accept')
      //updatemahmud1
      $('.approve').prop('checked', true)
      $('.attachment_client').removeAttr('disabled')
      $('.attachment_client').removeAttr('required')

      //updatemahmud1
    } else if (status == 7 && add_comment == "witness") {
      //updatemahmud1

      $('.witness').val(7)
      //updatemahmud1
      $('.add_comment_status').val('witness')
      //updatemahmud1
      $('.witness').prop('checked', true)
      $('.attachment_client').removeAttr('disabled')
      $('.attachment_client').removeAttr('required')

      //updatemahmud1
    } else if (status == 7 && add_comment == "review") {
      //updatemahmud1

      $('.review').val(7)
      //updatemahmud1
      $('.add_comment_status').val('review')
      //updatemahmud1
      $('.review').prop('checked', true)
      $('.attachment_client').removeAttr('disabled')
      $('.attachment_client').removeAttr('required')

    } else if (status == 6) {
      $('.reject').val(6)
      //updatemahmud1
      $('.add_comment_status').val("")
      //updatemahmud1
      $('.reject').prop('checked', true)
      $('.attachment_client').removeAttr('disabled')
      // $('.attachment_client').attr('required', true)


    } else if (status == 9) {
      $('.tr_row').addClass('bg-accepted-release')
      $('.approve_comment').val(9)
      //updatemahmud1
      $('.add_comment_status').val("")
      //updatemahmud1
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
      //updatemahmud1
      $('.add_comment_status').val("")
      //updatemahmud1
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
      //updatemahmud1
      $('.add_comment_status').val("")
      //updatemahmud1
      $('.reoffer').prop('checked', true)
      $('.attachment_client').removeAttr('disabled')
      $('.attachment_client').removeAttr('required')

    } else if (status == 4) {
      $('.pending').val(4)
      $('.pending').prop('checked', true)

    } else if (status == 0) {
      $('.pending').val('')
      //updatemahmud1
      $('.add_comment_status').val("")
      //updatemahmud1
      $('.radio_button').prop('checked', false)
      $('.attachment_client').attr('disabled', true)
      $('.attachment_client').removeAttr('required')

    }

    if (status != 7 && status != 0) {
      $('.remarks_pc').removeAttr('disabled')
      $('.remarks_pc').attr('required', true)
    } else {
      $('.remarks_pc').removeAttr('required')
      $('.remarks_pc').attr('disabled', true)
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
      source: "<?php echo base_url(); ?>material_verification/autocomplete_unique_no/" + workpack_no + "/" + grade + '/' + id_workpack,
      autoFocus: true,
      classes: {
        "ui-autocomplete": "highlight"
      }
    });
  }

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