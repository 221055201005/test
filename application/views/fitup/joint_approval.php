<?php
error_reporting(0);

$allow_approval_date = false;

foreach ($joint_list as $value) {
  if ($value['status_inspection'] == 1) {
    $allow_approval_date = true;
  }
}

$fitup = $joint_list[0];
//print_r($fitup);exit;
?>
<style type="text/css">
  .table {
    font-size: 100% !important;
    padding: 2px !important;
  }

  .select2-container {
    font-size: 70% !important;
    width: 100px !important;
    height: 20px !important;
  }

  .big-col {
    width: 600px !important;
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

  .select2 {
    width: 100% !important;
  }

  input[type=checkbox] {
    /* Double-sized Checkboxes */
    -ms-transform: scale(1.5);
    /* IE */
    -moz-transform: scale(1.5);
    /* FF */
    -webkit-transform: scale(1.5);
    /* Safari and Chrome */
    -o-transform: scale(1.5);
    /* Opera */
    transform: scale(1.5);
    padding: 10px;
  }
</style>


<div id="content" class="container-fluid">

  <?php

  if ($approval_type == 'client_qc') {
    $status_inspection = array_filter(array_column($joint_list, 'status_inspection'));
    $counting_process  = array_count_values($status_inspection);
    $total_pending_revise_smoe = $counting_process['1'];
  } else {
    $total_pending_revise_smoe = 0;
  }

  ?>


  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Inspection Data</h6>
        </div>
        <div class="card-body bg-white overflow-auto">

          <div class="row">
            <div class="col-md">
              <div class="form-group">
                <label>Drawing No</label>
                <?php if ($approval_type != 'client_qc') { ?>
                  <input type="text" class="form-control" name="drawing_no" value="<?php echo $fitup['drawing_no'] ?> <?php echo "Rev." . $joint_list[0]['rev_no_drawing_asga_template']; ?>" readonly>
                  <?php if (isset($activity_eng[$joint_list[0]['drawing_no']]['id'])) { ?>
                    <?php
                    $rev_link_ga_as = $joint_list[0]['rev_no_drawing_asga_template'];
                    $links_atc = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($activity_eng[$joint_list[0]['drawing_no']]['id']), '+=/', '.-~') . "/" . $rev_link_ga_as;
                    $links_atc_cross = base_url_ftp_eng() . "public_smoe/open_atc_cross/2/" . strtr($this->encryption->encrypt($joint_list[0]['drawing_no']), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt($activity_eng[$joint_list[0]['drawing_no']]['id']), '+=/', '.-~') . "/" . $rev_link_ga_as;
                    ?>
                    <a target='_blank' href='<?= $links_atc ?>' title='Attachment'> <i class='fas fa-paperclip'></i> Open Drawing </a>
                    &nbsp;&nbsp;
                    <a target='_blank' href='<?= $links_atc_cross ?>' title='Attachment' download='<?= $joint_list[0]['drawing_no'] ?>.pdf'>
                      <i class='fas fa-cloud-download-alt'></i> Download Drawing
                    </a>
                  <?php } ?>
                <?php } else { ?>
                  <input type="text" class="form-control" name="drawing_no" value="<?php echo $fitup['drawing_no'] ?> <?php echo (isset($fitup['drawing_rev_no']) ? "Rev." . $fitup['drawing_rev_no'] : "Rev." . $joint_list[0]['rev_no_drawing_asga_template']); ?>" readonly>
                  <?php if (isset($activity_eng[$joint_list[0]['drawing_no']]['id'])) { ?>
                    <?php
                    if (isset($fitup['drawing_rev_no'])) {
                      $rev_link_ga_as = $fitup['drawing_rev_no'];
                    } else {
                      $rev_link_ga_as = $joint_list[0]['rev_no_drawing_asga_template'];
                    }
                    $links_atc = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($activity_eng[$joint_list[0]['drawing_no']]['id']), '+=/', '.-~') . "/" . $rev_link_ga_as . "/" . strtr($this->encryption->encrypt(1), '+=/', '.-~');
                    $links_atc_cross = base_url_ftp_eng() . "public_smoe/open_atc_cross/2/" . strtr($this->encryption->encrypt($joint_list[0]['drawing_no']), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt($activity_eng[$joint_list[0]['drawing_no']]['id']), '+=/', '.-~') . "/" . $rev_link_ga_as . "/" . strtr($this->encryption->encrypt(1), '+=/', '.-~');
                    ?>
                    <a target='_blank' href='<?= $links_atc ?>' title='Attachment'> <i class='fas fa-paperclip'></i> Open Drawing </a>
                    &nbsp;&nbsp;
                    <a target='_blank' href='<?= $links_atc_cross ?>' title='Attachment' download='<?= $joint_list[0]['drawing_no'] ?>.pdf'>
                      <i class='fas fa-cloud-download-alt'></i> Download Drawing
                    </a>
                  <?php } ?>
                <?php } ?>
              </div>
            </div>
            <div class="col-md">
              <div class="form-group">
                <label>Discipline</label>
                <input type="text" class="form-control" name="discipline" value="<?php echo (isset($discipline_name[$fitup['discipline']]) ? $discipline_name[$fitup['discipline']] : '-') ?>" disabled>
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-md">
              <div class="form-group">
                <label>Module</label>
                <input type="text" class="form-control" name="module" value="<?php echo (isset($module_code[$fitup['module']]) ? $module_code[$fitup['module']] : '-') ?>" disabled>
              </div>
            </div>
            <div class="col-md">
              <div class="form-group">
                <label>Type Of Module</label>
                <input type="text" class="form-control" name="type_of_module" value="<?php echo (isset($type_of_module_name[$fitup['type_of_module']]) ? $type_of_module_name[$fitup['type_of_module']] : '-') ?>" disabled>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md">
              <div class="form-group">
                <label>Requestor Company</label>
                <input type="text" class="form-control" name="company" value="<?php echo $fitup['company'] ?>" disabled>
              </div>
            </div>
            <div class="col-md">
              <div class="form-group">
                <label>Request Date</label>
                <input type="text" class="form-control" name="date_request" value="<?php echo date('d-F-y H:i:s', strtotime($fitup['date_request'])) ?>" disabled>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md">
              <div class="form-group">
                <label>Requestor Name</label>
                <input type="text" class="form-control" name="requestor" value="<?php echo $user_list[$fitup['requestor']] ?>" disabled>
              </div>
            </div>
            <div class="col-md">
              <div class="form-group">
                <label>Area</label>
                <select class="select2 will_enable" name="area" id='area_v2'>
                  <option value="">---</option>
                  <?php foreach ($area_name_list_v2 as $value_area) { ?>
                    <option value="<?= $value_area['id'] ?>" <?php if (isset($fitup['area_v2']) && $fitup['area_v2'] == $value_area['id']) {
                                                                echo "selected";
                                                              } ?>><?= $value_area['name'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md">
              <div class="form-group">
                <label>Location</label>
                <select class="select2 will_enable" name="location" onchange="change_area(this)" id="location_v2">
                  <option value="">---</option>
                  <?php foreach ($location_name_list_v2 as $value_location) { ?>
                    <option value="<?= $value_location['id'] ?>" data-chained="<?php echo $value_location['id_area'] ?>" <?php if (isset($fitup['location_v2']) && $fitup['location_v2'] == $value_location['id']) {
                                                                                                                            echo "selected";
                                                                                                                          } ?>><?= $value_location['name'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md">
              <div class="form-group">
                <label>Point</label>
                <select class="select2 will_enable" name="point" onchange="change_location(this)">
                  <option value="">---</option>
                  <?php foreach ($point_list as $value_point) { ?>
                    <option value="<?= $value_point['id'] ?>" data-chained="<?php echo $value_point['id_location'] ?>" <?php if (isset($fitup['point_v2']) && $fitup['point_v2'] == $value_point['id']) {
                                                                                                                          echo "selected";
                                                                                                                        } ?>><?= $value_point['name'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

          </div>


        </div>
      </div>
    </div>
  </div>


  <form method="POST" action="<?php echo base_url(); ?>fitup/process_approval" enctype="multipart/form-data">


    <input type="hidden" class="form-control" name="submission_id" value="<?php echo $joint_list[0]['submission_id'] ?>" required readonly>
    <input type="hidden" name="approval_code_log" value="FITUP/<?= $project_data_portal[0]["project_name"] ?>/<?= $report_number ?>/">

    <?php if ($approval_type == 'smoe_qc') { ?>
      <input type="hidden" name="param_inspection" value="qc">
    <?php } else { ?>
      <input type="hidden" name="param_inspection" value="client">
    <?php } ?>



    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Inspection Detail -
              <?php if ($approval_type == "smoe_qc") {
                echo "Submission ID : " . $joint_list[0]['submission_id'];
              } else if ($approval_type == "client_qc" && $joint_list[0]['project_code'] == 21) {
                echo "Report Number : " . $master_report_number_deck[$joint_list[0]['project_code']][$joint_list[0]['company_id']][$joint_list[0]['discipline']][$joint_list[0]['type_of_module']][$joint_list[0]['deck_elevation']]["fitup_report"] . $joint_list[0]['report_number'];
              } else {
                echo "Report Number : " . $master_report_number[$joint_list[0]['project_code']][$joint_list[0]['company_id']][$joint_list[0]['discipline']][$joint_list[0]['type_of_module']]["fitup_report"] . $joint_list[0]['report_number'];
              } ?>
            </h6>
          </div>
          <div class="card-body bg-white overflow-auto">

            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Inspector Name</label>
                  <div class="col-xl">
                    <input type="hidden" class="form-control" name="inspection_by" value="<?php echo $user_cookie['0'] ?>" required readonly>
                    <input type="text" class="form-control" name="inspector_name" value="<?php echo $user_cookie['1'] ?>" required readonly>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <input type="hidden" class="form-control" name="wp_company" value="<?= $fitup["wp_company"] ?>" required>

                  <?php if ($approval_type == 'smoe_qc' && $fitup['wp_company'] == '13' && $allow_approval_date) { ?>
                    <label class="col-md-4 col-lg-3 col-form-label ">Approval Date</label>
                    <div class="col-xl">
                      <input type="date" class="form-control" name="inspection_datetime" required>
                    </div>
                  <?php } else if ($approval_type == 'client_qc' && $fitup['wp_company'] == '13' && $fitup['status_inspection'] == 5) { ?>
                    <label class="col-md-4 col-lg-3 col-form-label ">Approval Date & Time</label>
                    <div class="col-xl">
                      <input type="date" class="form-control" name="inspection_datetime" required>
                    </div>
                  <?php } else { ?>
                    <label class="col-md-4 col-lg-3 col-form-label ">Approval Date & Time</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" name="inspection_datetime" value="<?php echo  date("d F Y H:i:s"); ?>" required readonly>
                    </div>
                  <?php } ?>



                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Joint Number List</h6>
          </div>
          <div class="card-body bg-white overflow-auto">
            <div class="radio-toolbar">
              <?php if (isset($dt_client) && $dt_client != 'client') { ?>
                <div class="row">
                  <div class="col-md-12 col-sm">
                    <div class="btn-group">
                      <?php
                      if (
                        !empty($activity_eng[$joint_list[0]['drawing_no']]['transmittal_no']) and
                        isset($activity_eng[$joint_list[0]['drawing_no']]['transmittal_no'])  and
                        $activity_eng[$joint_list[0]['drawing_no']]['transmittal_no'] !== ""  and
                        !empty($activity_eng[$joint_list[0]['drawing_wm']]['transmittal_no']) and
                        isset($activity_eng[$joint_list[0]['drawing_wm']]['transmittal_no'])  and
                        $activity_eng[$joint_list[0]['drawing_wm']]['transmittal_no'] !== ""
                      ) {
                      ?>

                        <button type='button' class="btn btn-outline-success" onclick="change_all_button('1')">Accept All</button>
                      <?php
                      }
                      ?>
                      <button type='button' class="btn btn-outline-danger" onclick="change_all_button('2')">Reject All</button>
                      <button type='button' class="btn btn-outline-primary" onclick="change_all_button('3')">Pending All</button>
                      <button type='button' class="btn btn-outline-secondary" onclick="change_all_button('4')">Clear All</button>
                    </div>
                  </div>
                </div>
              <?php } else { ?>
                <div class="row">
                  <div class="col-md-12 col-sm">
                    <div class="btn-group">

                      <?php if ($total_pending_revise_smoe <= 0) { ?>

                        <button type='button' class="btn btn-outline-success" onclick="change_all_button('7', 'accept')">Accept All</button>

                        <?php if (in_array($this->user_cookie[10], array(19, 21)) && in_array($joint_list[0]['project_code'], array(19, 21))) { ?>
                          <button type='button' class="btn btn-outline-success" onclick="change_all_button('7', 'witness')">Witness All</button>
                          <button type='button' class="btn btn-outline-success" onclick="change_all_button('7', 'review')">Review All</button>
                        <?php } ?>

                        <!-- <button type='button' class="btn btn-outline-primary" onclick="change_all_button('9')">Accepted And Released With Comment</button> -->
                        <button type='button' class="btn btn-outline-danger" onclick="change_all_button('6')">Reject All</button>
                        <button type='button' class="btn btn-outline-secondary" onclick="change_all_button('4')">Clear All</button>
                      <?php } ?>

                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
            <br />

            <div class="col-md-12">
              <br />
              <ul class="nav nav-pills border-bottom border-gray" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detail</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Revise History Log</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="Redline_attach-tab" data-toggle="tab" href="#Redline_attach" role="tab" aria-controls="Redline_attach" aria-selected="false">Supporting Document</a>
                </li>
              </ul>
              <br />
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <div class="row mt-3">
                    <div class="col-md-12">
                      <div class="table-responsive overflow-auto">

                        <?php if (isset($dt_client) && $dt_client != 'client') { ?>

                          <?php if (isset($joint_list[0]['inspection_datetime'])) {  ?>

                            <?php $status_inspection = array_column($joint_list, 'status_inspection'); ?>

                            <?php if (in_array(1, $status_inspection)) { ?>

                              <div class="form-check">
                                &nbsp;&nbsp;&nbsp;<input class="form-check-input" type="checkbox" name='ticked_report_date' value="1" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked"> <span style='font-weight:bold !important;'> Use Current Date as Approval Date? </span> </label>
                              </div>

                        <?php }
                          }
                        } ?>

                        <table class="table table-hover text-center overflow-auto dataTable">
                          <thead class="bg-gray-table">
                            <tr>
                              <th class="big-col">Status Inspection</th>
                              <th style="width: 260px !important;">Weld Map Drawing Number</th>
                              <th style="width: 50px !important;">Joint No</th>
                              <th style="width: 50px !important;">Surveyor Images</th>
                              <?php if ($dt_client == 'clientxxx') { ?>
                                <th style="width: 300px !important;">Attachment</th>
                              <?php } ?>
                              <th style="width: 155px !important;">Part ID</th>
                              <th style="width: 190px !important;">Unique ID Number</th>
                              <th style="width: 80px !important;">Heat Number</th>
                              <th style="width: 95px !important;">Material Grade</th>

                              <th style="width: 95px !important;">Joint Class</th>
                              <th style="width: 15px !important;">Dia/Size</th>
                              <th style="width: 15px !important;">Sch</th>
                              <th style="width: 15px !important;">Thk<br />(mm)</th>

                              <th style="width: 15px !important;">Weld<br />Length<br />(mm)</th>

                              <!-- <th style="width: 120px !important;">Fitter Code</th> -->
                              <th style="width: 120px !important;">WPS Code</th>

                              <th style="width: 200px !important;">Remarks</th>
                              <?php if ($this->user_cookie[7] != 8) { ?>
                                <th style="width: 200px !important;">Rejected Remarks</th>

                              <?php } ?>
                              <th style="width: 200px !important;">Client Remarks</th>
                              <?php if ($this->user_cookie[7] != 8) { ?>
                                <th style="width: 200px !important;">Action Update</th>
                              <?php } ?>
                            </tr>
                          </thead>
                          <tbody>


                            <?php $no = 0;
                            $no_pending = 0;
                            $no_approved_client = 0;
                            foreach ($joint_list as $key => $value) : ?>

                              <?php if ($duplicate_joint[$value['id_joint']]) {
                                continue;
                              }

                              $duplicate_joint[$value['id_joint']] = 1
                              ?>

                              <?php

                              if (isset($approval_type) and $approval_type == "smoe_qc") {
                                if ($value['status_inspection'] == 1) {
                                  $no_pending++;
                                }
                              } else {
                                if ($value['status_inspection'] == 5) {
                                  $no_pending++;
                                } else if ($value['status_inspection'] == 7) {
                                  $no_approved_client++;
                                }
                              }

                              ?>

                              <tr>
                                <td class="text-nowrap">

                                  <?php if ($approval_type == "smoe_qc") {   ?>

                                    <?php if (isset($value['inspection_datetime']) && isset($value['inspection_by'])) { ?>
                                      <input type="hidden" name="status_fresh[<?= $no ?>]" value="approval_document">
                                    <?php } else { ?>
                                      <input type="hidden" name="status_fresh[<?= $no ?>]" value="approval_inspection">
                                    <?php } ?>

                                  <?php } ?>


                                  <input type="hidden" name="report_no_validated[<?= $no ?>]" value="<?= @$value['report_number'] ?>">
                                  <input type="hidden" name="status_data[<?= $no ?>]" value="<?= $value['status_inspection'] ?>">
                                  <input type="hidden" name="drawing_rev_no" value="<?= $drawing_rev_no ?>">
                                  <input type="hidden" name="id_fitup[<?php echo $no ?>]" value="<?php echo $value['id_fitup']; ?>">

                                  <?php $arr_client = [5, 6, 7] ?>
                                  <?php if (in_array($value['status_inspection'], $arr_client) && $approval_type == "client_qc") {
                                    $mode_datashow = "client"; ?>
                                  <?php } else {
                                    $mode_datashow = "qc";
                                  } ?>

                                  <?php if ($value['status_inspection'] == '1' or $value['status_inspection'] == '5') { ?>

                                    <?php if ($value['status_inspection'] != '5' && $approval_type == "smoe_qc") { ?>

                                      <?php
                                      if (
                                        !empty($activity_eng[$value['drawing_no']]['transmittal_no']) and isset($activity_eng[$value['drawing_no']]['transmittal_no'])  and
                                        $activity_eng[$value['drawing_no']]['transmittal_no'] !== ""  and !empty($activity_eng[$value['drawing_wm']]['transmittal_no']) and
                                        isset($activity_eng[$value['drawing_wm']]['transmittal_no'])  and $activity_eng[$value['drawing_wm']]['transmittal_no'] !== ""
                                      ) { ?>


                                        <div class="form-check form-check-inline text-success">
                                          <input class="form-check-input approve" id='app_<?php echo $no; ?>' type="radio" name="approve[<?php echo $no ?>]" value="A <?= $value['id_fitup'] ?>" style="width: 17px; height: 17px" onclick="change_single_button('1', '<?= $no ?>')">
                                          <label class="form-check-label"><b>Approve</b></label>
                                        </div></br>

                                        <div class="form-check form-check-inline text-danger">
                                          <input class="form-check-input rejected" id="rjct_<?php echo $no; ?>" type="radio" name="approve[<?php echo $no ?>]" value="R <?= $value['id_fitup'] ?>" style="width: 17px; height: 17px" onclick="change_single_button('2', '<?= $no ?>')">
                                          <label class="form-check-label"><b>Reject</b></label>
                                        </div></br>

                                        <div class="form-check form-check-inline text-primary">
                                          <input class="form-check-input pending" id='pdg_<?php echo $no; ?>' type="radio" name="approve[<?php echo $no ?>]" value="P <?= $value['id_fitup'] ?>" style="width: 17px; height: 17px" onclick="change_single_button('3', '<?= $no ?>')">
                                          <label class="form-check-label"><b>Pending</b></label>
                                        </div><br />

                                      <?php } else { ?>

                                        <div class="form-check form-check-inline text-danger">
                                          <h5>
                                            <span class="badge badge-pill badge-secondary">
                                              <i class="fas fa-hourglass"></i>
                                              Waiting Drawing Release
                                            </span>
                                          </h5>
                                        </div>


                                        <div class="form-check form-check-inline text-danger">
                                          <input class="form-check-input rejected" id="rjct_<?php echo $no; ?>" type="radio" name="approve[<?php echo $no ?>]" value="R <?= $value['id_fitup'] ?>" style="width: 17px; height: 17px" onclick="change_single_button('2', '<?= $no ?>')">
                                          <label class="form-check-label"><b>Reject</b></label>
                                        </div></br>

                                        <div class="form-check form-check-inline text-primary">
                                          <input class="form-check-input pending" id='pdg_<?php echo $no; ?>' type="radio" name="approve[<?php echo $no ?>]" value="P <?= $value['id_fitup'] ?>" style="width: 17px; height: 17px" onclick="change_single_button('3', '<?= $no ?>')">
                                          <label class="form-check-label"><b>Pending</b></label>
                                        </div><br />



                                      <?php } ?>

                                    <?php } else if ($value['status_inspection'] == '5' and $this->user_cookie[7] == 8 && isset($value['report_number'])) { ?>

                                      <?php if ($total_pending_revise_smoe <= 0) { ?>

                                        <table>
                                          <?php if ($value['latest_inspection_status'] == 7) { ?>
                                            <tr>
                                              <td>
                                                <div class="form-check form-check-inline text-danger float-center">
                                                  <label class="form-check-label">
                                                    <span class="badge badge-pill badge-secondary">Revise Engineering Template :</span>
                                                  </label>
                                                </div>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <div class="form-check form-check-inline float-center">
                                                  <label class="form-check-label">
                                                    <?= @$revise_history_detail[$value["id_joint"]]["request_reason"] ?>
                                                  </label>
                                                </div>
                                              </td>
                                            </tr>
                                          <?php } ?>
                                          <tr>
                                            <td>
                                              <div class="form-check form-check-inline text-success float-left">
                                                <label class="form-check-label text-left">
                                                  <input class="form-check-input approve" id='app_clnt_<?php echo $no; ?>' type="radio" name="approve[<?php echo $no ?>]" value="A <?= $value['id_fitup'] ?>" style="width: 17px; height: 17px" onclick="change_single_button('7', '<?= $no ?>', 'accept')"><b>Approve</b>
                                                </label>
                                              </div>
                                            </td>
                                          </tr>
                                          <input type='hidden' id='add_comment_<?php echo $no; ?>' class='add_comment_status' name='add_comment[<?= $no ?>]' value=''>
                                          <?php if (in_array($this->user_cookie[10], array(19, 21))) { ?>
                                            <tr>
                                              <td>
                                                <div class="form-check form-check-inline text-success float-left">
                                                  <label class="form-check-label text-left">
                                                    <input class="form-check-input witness" id='witness_clnt_<?php echo $no; ?>' type="radio" name="approve[<?php echo $no ?>]" value="A <?= $value['id_fitup'] ?>" style="width: 17px; height: 17px" onclick="change_single_button('7', '<?= $no ?>', 'witness')"><b>Witness</b>
                                                  </label>
                                                </div>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <div class="form-check form-check-inline text-success float-left">
                                                  <label class="form-check-label text-left">
                                                    <input class="form-check-input review" id='review_clnt_<?php echo $no; ?>' type="radio" name="approve[<?php echo $no ?>]" value="A <?= $value['id_fitup'] ?>" style="width: 17px; height: 17px" onclick="change_single_button('7', '<?= $no ?>', 'review')"><b>Review</b>
                                                  </label>
                                                </div>
                                              </td>
                                            </tr>
                                          <?php } ?>
                                          <!-- <tr>
                                                  <td>
                                                    <div class="form-check form-check-inline text-primary float-left">
                                                        <label class="form-check-label">
                                                          <input class="form-check-input approve_with_comment" id='app_wc_<?php echo $no; ?>' type="radio" name="approve[<?php echo $no ?>]" value="AWC <?= $value['id_fitup'] ?>" style="width: 17px; height: 17px" onclick="change_single_button('9', '<?= $no ?>')">
                                                          <b>Accepted & Released With Comment</b>
                                                        </label>
                                                    </div>
                                                  </td>
                                                </tr> -->
                                          <tr>
                                            <td>
                                              <div class="form-check form-check-inline text-danger float-left">
                                                <label class="form-check-label">
                                                  <input class="form-check-input rejected" id="rjct_clnt_<?php echo $no; ?>" type="radio" name="approve[<?php echo $no ?>]" value="R <?= $value['id_fitup'] ?>" style="width: 17px; height: 17px" onclick="change_single_button('6', '<?= $no ?>')">
                                                  <b>Reject</b>
                                                </label>
                                              </div>
                                            </td>
                                          </tr>

                                          <?php if ($approval_type == 'client_qc' and $value['project'] == 14 and $key == 0) { ?>
                                            <tr>
                                              <td>
                                                <textarea disabled name="accepted_remarks" class="form-control d-none accepted_remarks" placeholder="Accepted Remarks"></textarea>
                                              </td>
                                            </tr>
                                          <?php } ?>

                                        </table>

                                      <?php } else { ?>

                                        <div class="my-3 p-3 bg-white rounded shadow-sm" style="margin-top: 0">
                                          <center><span class="badge badge-secondary" style="margin-top: 0cm">
                                              <h6 style="margin-top: 0cm !important"><b>On Revise Progress</b></h6>
                                            </span></center>
                                        </div>

                                      <?php } ?>

                                      <?php } else {

                                      if (isset($value["report_number"]) and $value['status_inspection'] == '1') {

                                      ?>
                                        <div class="my-3 p-3 bg-white rounded shadow-sm" style="margin-top: 0">
                                          <center><span class="badge badge-secondary" style="margin-top: 0cm">
                                              <h6 style="margin-top: 0cm !important"><b>On Revise Progress</b></h6>
                                            </span></center>
                                        </div>
                                    <?php

                                      }


                                      if ($value['status_inspection'] == '3' or $value['status_inspection'] == '7') {
                                        if (in_array($this->user_cookie[10], array(19, 21)) && in_array($value['project_code'], array(19, 21))) {
                                          echo "<span class='badge badge-success'>Witness</span><br/>";
                                        } else {
                                          echo "<span class='badge badge-success'>Approved</span><br/>";
                                        }
                                      } else if ($value['status_inspection'] == '2' or $value['status_inspection'] == '6') {
                                        echo "<span class='badge badge-danger'>Rejected</span><br/>";
                                      } else if ($value['status_inspection'] == '4') {
                                        echo "<span class='badge badge-primary'>Pending By QC</span><br/>";
                                      } else if ($value['status_inspection'] == '5') {
                                        echo "<span class='badge badge-primary'>Transmitted</span><br/>";
                                      } else if ($value['status_inspection'] == '9') {
                                        echo "<span class='badge badge-primary'>Approved & Released With Comment</span><br/>";
                                      } else if ($value['status_inspection'] == '10') {
                                        echo "<span class='badge badge-info'>Postponed</span><br/>";
                                      } else if ($value['status_inspection'] == '11') {
                                        echo "<span class='badge badge-warning'>Re-offer</span><br/>";
                                      } else if ($value['status_inspection'] == '12') {
                                        echo "<span class='badge badge-secondary'>Void</span><br/>";
                                      }

                                      if ($value['status_inspection'] == '7' || $value['status_inspection'] == '9' || $value['status_inspection'] == '10' || $value['status_inspection'] == '11') {
                                        echo "<span class='badge'>" . $user_list[$value['client_inspection_by']] . "</span><br/>";
                                        echo "<span class='badge'>" . date("d-F-y H:i:s", strtotime($value['client_inspection_date'])) . "</span><br/>";
                                      } else if ($value['status_inspection'] == '2' || $value['status_inspection'] == '3' || $value['status_inspection'] == '4') {
                                        echo "<span class='badge'>" . $user_list[$value['inspection_by']] . "</span><br/>";
                                        echo "<span class='badge'>" . date("d-F-y H:i:s", strtotime($value['inspection_datetime'])) . "</span><br/>";
                                      } else if ($value['status_inspection'] == '5') {
                                        echo "<span class='badge'>" . $user_list[$value['transmitted_by']] . "</span><br/>";
                                        echo "<span class='badge'>" . date("d-F-y H:i:s", strtotime($value['transmitted_date'])) . "</span><br/>";
                                      } else if ($value['status_inspection'] == '12') {
                                        echo "<span class='badge'>" . $user_list[$value['void_by']] . "</span><br/>";
                                        echo "<span class='badge'>" . date("d-F-y H:i:s", strtotime($value['void_date'])) . "</span><br/>";
                                      }

                                      if ($value['status_inspection'] == '3') {
                                        if (isset($value["inspection_remarks"]) and !empty($value["inspection_remarks"])) {
                                          echo "<br/><span style='font-size=5px !important;'><b>Inspector Remarks :</b><br/>" . $value["inspection_remarks"] . "</span>";
                                        }
                                      } else if ($value['status_inspection'] == '2') {
                                        if (isset($value["rejected_remarks"]) and !empty($value["rejected_remarks"])) {
                                          echo "<br/><span style='font-size=5px !important;'><b>Inspector Remarks :</b><br/>" . $value["rejected_remarks"] . "</span>";
                                        }
                                      } else if ($value['status_inspection'] == '4') {
                                        if (isset($value["pending_qc_remarks"]) and !empty($value["pending_qc_remarks"])) {
                                          echo "<br/><span style='font-size=5px !important;'><b>Inspector Remarks :</b><br/>" . $value["pending_qc_remarks"] . "</span>";
                                        }
                                      } else if ($value['status_inspection'] == '6') {
                                        if (isset($value["client_remarks"]) and !empty($value["client_remarks"])) {
                                          echo "<br/><span style='font-size=5px !important;'><b>Inspector Remarks :</b><br/>" . $value["client_remarks"] . "</span>";
                                        }
                                      } else if ($value['status_inspection'] == '12') {
                                        if (isset($value["void_remarks"]) and !empty($value["void_remarks"])) {
                                          echo "<br/><span style='font-size=5px !important;text-align:left !important;'><b>Void Remarks :</b><br/>" . $value["void_remarks"] . "</span>";
                                        }
                                      }
                                    }  ?>

                                  <?php } else {

                                    if ($value['status_inspection'] == '3') {
                                      echo "<span class='badge badge-success'>Approved</span><br/>";
                                    } else if ($value['status_inspection'] == '7' && $value['add_comment'] == '1') {
                                      echo "<span class='badge badge-success'>Approved</span><br/>";
                                    } else if ($value['status_inspection'] == '7' && $value['add_comment'] == '2') {
                                      echo "<span class='badge badge-success'>Witnessed</span><br/>";
                                    } else if ($value['status_inspection'] == '7' && $value['add_comment'] == '3') {
                                      echo "<span class='badge badge-success'>Reviewed</span><br/>";
                                    } else if ($value['status_inspection'] == '2' or $value['status_inspection'] == '6') {
                                      echo "<span class='badge badge-danger'>Rejected</span><br/>";

                                      if ($value['status_delete_fu'] == 1 and $value['status_resubmit'] > 0) {
                                        echo "<span class='badge badge-warning'>Resubmitted</span><br/>";
                                      } else {
                                        echo "<span class='badge badge-primary'>Pending Re-submission</span><br/>";
                                      }
                                    } else if ($value['status_inspection'] == '4') {
                                      echo "<span class='badge badge-primary'>Pending By QC</span><br/>";
                                    } else if ($value['status_inspection'] == '5') {
                                      echo "<span class='badge badge-primary'>Transmitted</span><br/>";
                                    } else if ($value['status_inspection'] == '9') {
                                      echo "<span class='badge badge-primary'>Approved & Released With Comment</span><br/>";
                                    } else if ($value['status_inspection'] == '10') {
                                      echo "<span class='badge badge-info'>Postponed</span><br/>";
                                    } else if ($value['status_inspection'] == '11') {
                                      echo "<span class='badge badge-warning'>Re-offer</span><br/>";
                                    } else if ($value['status_inspection'] == '12') {
                                      echo "<span class='badge badge-secondary'>Void</span><br/>";
                                    }

                                    if (in_array($value['status_inspection'], [6, 7, 9, 10, 11])) {
                                      echo "<span class='badge'>" . $user_list[$value['client_inspection_by']] . "</span><br/>";
                                      echo "<span class='badge'>" . date("d-F-y H:i:s", strtotime($value['client_inspection_date'])) . "</span><br/>";
                                    } else if ($value['status_inspection'] == '12') {
                                      echo "<span class='badge'>" . $user_list[$value['void_by']] . "</span><br/>";
                                      echo "<span class='badge'>" . date("d-F-y H:i:s", strtotime($value['void_date'])) . "</span><br/>";
                                    } else {
                                      echo "<span class='badge'>" . $user_list[$value['inspection_by']] . "</span><br/>";
                                      echo "<span class='badge'>" . date("d-F-y H:i:s", strtotime($value['inspection_datetime'])) . "</span><br/>";
                                    }

                                    if ($value['status_inspection'] == '3') {
                                      if (isset($value["inspection_remarks"]) and !empty($value["inspection_remarks"])) {
                                        echo "<br/><span style='font-size=5px !important;text-align:left !important;'><b>Inspector Remarks :</b><br/>" . $value["inspection_remarks"] . "</span>";
                                      }
                                    } else if ($value['status_inspection'] == '2') {
                                      if (isset($value["rejected_remarks"]) and !empty($value["rejected_remarks"])) {
                                        echo "<br/><span style='font-size=5px !important;text-align:left !important;'><b>Inspector Remarks :</b><br/>" . $value["rejected_remarks"] . "</span>";
                                      }
                                    } else if ($value['status_inspection'] == '4') {
                                      if (isset($value["pending_qc_remarks"]) and !empty($value["pending_qc_remarks"])) {
                                        echo "<br/><span style='font-size=5px !important;text-align:left !important;'><b>Inspector Remarks :</b><br/>" . $value["pending_qc_remarks"] . "</span>";
                                      }
                                    } else if ($value['status_inspection'] == '6') {
                                      if (isset($value["client_remarks"]) and !empty($value["client_remarks"])) {
                                        echo "<br/><span style='font-size=5px !important;text-align:left !important;'><b>Inspector Remarks :</b><br/>" . $value["client_remarks"] . "</span>";
                                      }
                                    } else if ($value['status_inspection'] == '9') {
                                      if (isset($value["approve_comment"]) and !empty($value["approve_comment"])) {
                                        echo "<br/><span style='font-size=5px !important;text-align:left !important;'><b>Inspector Remarks :</b><br/>" . $value["approve_comment"] . "</span>";
                                      }
                                    } else if ($value['status_inspection'] == '10') {
                                      if (isset($value["postpone_remarks"]) and !empty($value["postpone_remarks"])) {
                                        echo "<br/><span style='font-size=5px !important;text-align:left !important;'><b>Inspector Remarks :</b><br/>" . $value["postpone_remarks"] . "</span>";
                                      }
                                    } else if ($value['status_inspection'] == '11') {
                                      if (isset($value["reoffer_remarks"]) and !empty($value["reoffer_remarks"])) {
                                        echo "<br/><span style='font-size=5px !important;text-align:left !important;'><b>Inspector Remarks :</b><br/>" . $value["reoffer_remarks"] . "</span>";
                                      }
                                    } else if ($value['status_inspection'] == '12') {
                                      if (isset($value["void_remarks"]) and !empty($value["void_remarks"])) {
                                        echo "<br/><span style='font-size=5px !important;text-align:left !important;'><b>Void Remarks :</b><br/>" . $value["void_remarks"] . "</span>";
                                      }
                                    }
                                  } ?>

                                  <span class='inspection_remarks' id='inspection_remarks_<?php echo $no; ?>' style='display: none;'> Inspection Remarks : <br />
                                    <textarea name='inspection_remarks[<?php echo $no; ?>]' placeholder="---"></textarea>
                                  </span>

                                  <span class='reject_remarks' id='rjct_rmks_<?php echo $no; ?>' style='display: none;'> Rejected Remarks : <br />
                                    <textarea name='rejected_remarks[<?php echo $no; ?>]' placeholder="---"></textarea>
                                  </span>

                                  <span class='pending_remarks' id="pdg_rmks_<?php echo $no; ?>" style='display: none;'>
                                    Pending By QC Remarks : <br />
                                    <textarea name='pending_qc_remarks[<?php echo $no; ?>]' placeholder="---"></textarea>
                                  </span>


                                  <span class='approve_with_comment_remarks' id="approve_with_comment_remarks_<?php echo $no; ?>" style='display: none;'>
                                    Accepted & Released With Comment Remarks : <br />
                                    <textarea name='approve_with_comment_remarks[<?php echo $no; ?>]' placeholder="---"></textarea>
                                  </span>

                                  <span class='postponed_remarks' id="postponed_remarks_<?php echo $no; ?>" style='display: none;'>
                                    Postponed Remarks : <br />
                                    <textarea name='postponed_remarks[<?php echo $no; ?>]' placeholder="---"></textarea>
                                  </span>

                                  <span class='reoffer_remarks' id="reoffer_remarks_<?php echo $no; ?>" style='display: none;'>
                                    Re-Offer Remarks : <br />
                                    <textarea name='reoffer_remarks[<?php echo $no; ?>]' placeholder="---"></textarea>
                                  </span>

                                  <span class='client_remarks' id="clnt_rmks_<?php echo $no; ?>" style='display: none;'>
                                    Client Remarks : <br />
                                    <textarea name='client_remarks[<?php echo $no; ?>]' placeholder="---"></textarea>
                                  </span>

                                </td>
                                <td class="text-nowrap">

                                  <input type='hidden' name='latest_inspection_status[<?= $no ?>]' value='<?php echo $value['latest_inspection_status'] ?>' />

                                  <?php if ($value['status_inspection'] >= 3 && isset($value['drawing_wm_approved'])) { ?>
                                    <!-- <?php echo $value['drawing_wm_approved'] ?> Rev.<?php echo $value['drawing_wm_rev_approved'] ?> -->

                                    <input type='hidden' name='save_wm[<?= $no ?>]' value='<?= $value['drawing_wm'] ?>' />
                                    <input type='hidden' name='save_wm_rev[<?= $no ?>]' value='<?= $value['rev_wm'] ?>' />

                                    <input type='hidden' name='status_keep_drawing[<?= $no ?>]' value='1' />

                                  <?php } else { ?>

                                    <!-- <?php echo $value['drawing_wm'] ?> Rev.<?php echo $value['rev_wm'] ?> -->

                                    <input type='hidden' name='save_wm' value='<?= $value['drawing_wm'] ?>' />
                                    <input type='hidden' name='save_wm_rev' value='<?= $value['rev_wm'] ?>' />

                                    <input type='hidden' name='status_keep_drawing[<?= $no ?>]' value='0' />

                                  <?php } ?>
                                  <?php if ($approval_type != 'client_qc') { ?>
                                    <?php echo $value['drawing_wm'] ?> Rev.<?php echo $value['rev_wm'] . '<br>' . (!empty($value['spool_no']) ? 'Spool No : ' . $value['spool_no'] : ''); ?>
                                  <?php } else { ?>
                                    <?php echo $value['drawing_wm'] ?> Rev.<?php echo (isset($value['drawing_wm_rev_approved']) ? $value['drawing_wm_rev_approved'] : $value['rev_wm']) . '<br>' . (!empty($value['spool_no']) ? '<br>' . 'Spool No : ' . $value['spool_no'] : '') ?>
                                  <?php } ?>
                                </td>
                                <td>
                                  <?php echo $value['joint_no']
                                  ?>
                                </td>
                                <td>
                                  <?php if (isset($image_fu[$value['id_joint']])) { ?>
                                    <?php
                                    $enc_redline = strtr($this->encryption->encrypt($image_fu[$value['id_joint']]), '+=/', '.-~');
                                    $enc_path   = strtr($this->encryption->encrypt('/PCMS/mobile/pcms_v2_mobile/pcms_v2_photo/'), '+=/', '.-~');
                                    ?>
                                    <a target='_blank' href='<?= site_url('irn/open_file/' . $enc_redline . '/' . $enc_path) ?>'><span class='btn btn-primary'><i class="fas fa-images"></i></span></a>
                                    <!-- <img src="<?= $this->link_server ?>/pcms_v2_photo/<?= $image_fu[$value['id_joint']] ?>" style='width: 80px;' onclick="show_image(this, '<?= $image_fu[$value['id_joint']] ?>', 'surveyor')"/> -->
                                  <?php } else { ?>
                                    <img src="<?php echo base_url(); ?>/img/img_not_avai.png" style='width: 80px;'>
                                  <?php } ?>
                                  <span class='badge'><?= (isset($user_list[$value['surveyor_creator']]) ? $user_list[$value['surveyor_creator']] : $user_list[$value['requestor']]);  ?></span><br />
                                  <span class='badge'><?= (isset($value['surveyor_created_date']) ? $value['surveyor_created_date'] : $value['date_request']); ?></span>
                                </td>
                                <?php if ($dt_client == 'clientxxx') { ?>
                                  <td>


                                    <?php if (isset($attachment_history[$value['id_fitup']])) { ?>

                                      <div class="row mt-3">
                                        <div class="col-md-12">
                                          <div class="table-responsive">
                                            <table class="table table-bordered">
                                              <thead class="alert-success ">
                                                <th>No</th>
                                                <th>Attachment</th>
                                                <th>Uploaded By</th>
                                                <th>Uploaded Date</th>
                                              </thead>
                                              <tbody>
                                                <?php $no_attachment = 1;
                                                foreach ($attachment_history[$value['id_fitup']] as $v) : ?>
                                                  <tr>
                                                    <td><?= $no_attachment++ ?></td>
                                                    <td>

                                                      <?php
                                                      $enc_redline = strtr($this->encryption->encrypt($v['filename']), '+=/', '.-~');
                                                      $enc_path   = strtr($this->encryption->encrypt('/PCMS/mobile/pcms_v2_mobile/pcms_v2_photo/fab_img/'), '+=/', '.-~');
                                                      ?>
                                                      <a target='_blank' href='<?= site_url('irn/open_file/' . $enc_redline . '/' . $enc_path) ?>'><span class='btn btn-primary'><i class="fas fa-images"></i></span></a>

                                                      <!-- <img src="<?= $this->link_server ?>/pcms_v2_photo/fab_img/<?= $v['filename'] ?>" style='width: 80px;' onclick="show_image(this, '<?= $v['filename'] ?>', 'client')"/> -->

                                                      <!-- <button type="button" class="btn btn-info"  onclick="show_image(this, '<?= $v['filename'] ?>', 'client')"><i  class="fas fa-image"></i></button> -->

                                                    </td>
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

                                    <?php } else { ?>
                                      <img src="<?php echo base_url(); ?>/img/img_not_avai.png" style='width: 80px;'><br /><br />
                                    <?php } ?>
                                    <div class="form-check">
                                      <input type="file" name="attachment_client[<?php echo $no; ?>]">
                                    </div>
                                    <br />
                                  </td>
                                <?php } ?>
                                <td>
                                  <?php
                                  $pos_1  = explode(";", $value['pos_1']);
                                  foreach ($pos_1 as $pc1) {
                                    if (isset($activity_eng[$status_piecemark[$pc1]['drawing_sp']]['id'])) {
                                      $drawing_sp_rev_p1 = $status_piecemark[$pc1]['rev_sp'];
                                      $links_sp_p1 = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($activity_eng[$status_piecemark[$pc1]['drawing_sp']]['id']), '+=/', '.-~') . '/' . $drawing_sp_rev_p1;
                                    } else {
                                      $links_sp_p1 = null;
                                    }
                                    if (isset($links_sp_p1)) {
                                  ?>
                                      <a href='<?= $links_sp_p1 ?>' target='_blank' style='color:black !important;'>
                                        <span class='badge'><?php echo $pc1; ?></span>
                                      </a>
                                  <?php
                                    } else {
                                      echo "<span class='badge'>" . $pc1 . "</span><hr/>";
                                    }
                                  }
                                  ?>
                                  <?php
                                  $pos_2  = explode(";", $value['pos_2']);
                                  foreach ($pos_2 as $pc2) {
                                    if (isset($activity_eng[$status_piecemark[$pc2]['drawing_sp']]['id'])) {
                                      $drawing_sp_rev_p2 = $status_piecemark[$pc2]['rev_sp'];
                                      $links_sp_p2 = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($activity_eng[$status_piecemark[$pc2]['drawing_sp']]['id']), '+=/', '.-~') . '/' . $drawing_sp_rev_p2;
                                    } else {
                                      $links_sp_p2 = null;
                                    }

                                    if (isset($links_sp_p2)) {
                                  ?>
                                      <a href='<?= $links_sp_p2 ?>' target='_blank' style='color:black !important;'>
                                        <span class='badge'><?php echo $pc2; ?></span>
                                      </a>
                                  <?php
                                    } else {
                                      echo "<span class='badge'>" . $pc2 . "</span><hr/>";
                                    }
                                  }
                                  ?>
                                </td>
                                <td>
                                  <?php
                                  $pos_1  = explode(";", $value['pos_1']);
                                  foreach ($pos_1 as $pc1) {
                                    echo "<span class='badge'>" . (isset($warehouse_mis_mrir[$status_piecemark[$pc1]["id_mis"]]['unique_ident_no']) ? $warehouse_mis_mrir[$status_piecemark[$pc1]["id_mis"]]['unique_ident_no'] : "-") . "</span><hr/>";
                                  }
                                  $pos_2  = explode(";", $value['pos_2']);
                                  foreach ($pos_2 as $pc2) {
                                    echo "<span class='badge'>" . (isset($warehouse_mis_mrir[$status_piecemark[$pc2]["id_mis"]]['unique_ident_no']) ? $warehouse_mis_mrir[$status_piecemark[$pc2]["id_mis"]]['unique_ident_no'] : "-") . "</span><hr/>";
                                  }
                                  ?>
                                </td>
                                <td>
                                  <?php
                                  $pos_1  = explode(";", $value['pos_1']);
                                  foreach ($pos_1 as $pc1) {
                                    echo "<span class='badge'>" . (isset($warehouse_mis_mrir[$status_piecemark[$pc1]["id_mis"]]['unique_ident_no']) ? $warehouse_mis_mrir[$status_piecemark[$pc1]["id_mis"]]['heat_or_series_no'] : "-") . "</span><hr/>";
                                  }
                                  $pos_2  = explode(";", $value['pos_2']);
                                  foreach ($pos_2 as $pc2) {
                                    echo "<span class='badge'>" . (isset($warehouse_mis_mrir[$status_piecemark[$pc2]["id_mis"]]['unique_ident_no']) ? $warehouse_mis_mrir[$status_piecemark[$pc2]["id_mis"]]['heat_or_series_no'] : "-") . "</span><hr/>";
                                  }
                                  ?>
                                </td>
                                <td>
                                  <?php
                                  $pos_1  = explode(";", $value['pos_1']);
                                  foreach ($pos_1 as $pc1) {
                                    echo "<span class='badge'>" . (isset($material_grade[$status_piecemark[$pc1]["grade"]]['material_grade']) ? $material_grade[$status_piecemark[$pc1]["grade"]]['material_grade'] : "-") . "</span><hr/>";
                                  }
                                  $pos_2  = explode(";", $value['pos_2']);
                                  foreach ($pos_2 as $pc2) {
                                    echo "<span class='badge'>" . (isset($material_grade[$status_piecemark[$pc2]["grade"]]['material_grade']) ? $material_grade[$status_piecemark[$pc2]["grade"]]['material_grade'] : "-") . "</span><hr/>";
                                  }
                                  ?>
                                </td>
                                <td class="ball" style="vertical-align: middle;text-align: center;">
                                  <?php echo @$class_list[$value["class"]] ?>
                                </td>

                                <td>
                                  <?php
                                  $pos_1  = explode(";", $value['pos_1']);
                                  foreach ($pos_1 as $pc1) {
                                    echo "<span class='badge'>" . (isset($status_piecemark[$pc1]["diameter"]) ? $status_piecemark[$pc1]["diameter"] : "-") . "</span><hr/>";
                                  }
                                  $pos_2  = explode(";", $value['pos_2']);
                                  foreach ($pos_2 as $pc2) {
                                    echo "<span class='badge'>" . (isset($status_piecemark[$pc2]["diameter"]) ? $status_piecemark[$pc2]["diameter"] : "-") . "</span><hr/>";
                                  }
                                  ?>
                                </td>

                                <td>
                                  <?php
                                  $pos_1  = explode(";", $value['pos_1']);
                                  foreach ($pos_1 as $pc1) {
                                    echo "<span class='badge'>" . (isset($status_piecemark[$pc1]["sch"]) ? $status_piecemark[$pc1]["sch"] : "-") . "</span><hr/>";
                                  }
                                  $pos_2  = explode(";", $value['pos_2']);
                                  foreach ($pos_2 as $pc2) {
                                    echo "<span class='badge'>" . (isset($status_piecemark[$pc2]["sch"]) ? $status_piecemark[$pc2]["sch"] : "-") . "</span><hr/>";
                                  }
                                  ?>
                                </td>
                                <td>
                                  <?php
                                  $pos_1  = explode(";", $value['pos_1']);
                                  foreach ($pos_1 as $pc1) {
                                    echo "<span class='badge'>" . (isset($status_piecemark[$pc1]["thickness"]) ? $status_piecemark[$pc1]["thickness"] : "-") . "</span><hr/>";
                                  }
                                  $pos_2  = explode(";", $value['pos_2']);
                                  foreach ($pos_2 as $pc2) {
                                    echo "<span class='badge'>" . (isset($status_piecemark[$pc2]["thickness"]) ? $status_piecemark[$pc2]["thickness"] : "-") . "</span><hr/>";
                                  }
                                  ?>
                                </td>
                                <td><?php echo $value['weld_length']; ?></td>

                                <!-- <td class="text-nowrap">
                                        <?php
                                        $fitter_id_display = explode(";", $value['fitter_id']);
                                        foreach ($fitter_id_display as $key => $val_fitter) {
                                          if (isset($fitter_code_arr[$val_fitter])) {
                                            echo $fitter_code_arr[$val_fitter] . "<br/>";
                                          }
                                        }
                                        ?>
                                      </td> -->
                                <td>
                                  <?php
                                  $wps_no_display = explode(";", $value['wps_no']);
                                  foreach ($wps_no_display as $key => $val_wps) {
                                    if (isset($wps_no_arr[$val_wps])) {
                                      echo $wps_no_arr[$val_wps] . "<br/>";
                                    }
                                  }
                                  ?>
                                </td>

                                <td>
                                  <?php echo $value["remarks"]; ?>

                                  <?php
                                  if (isset($value["pending_qc_remarks"]) and $value['status_inspection'] == '4') {
                                    echo "<br/><span style='font-size:12px !important;'><b>Inspector Remarks :</b><br/>" . $value["pending_qc_remarks"] . "</span>";
                                  }
                                  ?>

                                  <?php
                                  if (isset($value["inspection_remarks"]) && !empty($value["inspection_remarks"])) {
                                    echo "<br/><span style='font-size:12px !important;'><b>Inspector Remarks :</b><br/>" . $value["inspection_remarks"] . "</span>";
                                  }
                                  ?>
                                </td>

                                <?php if ($this->user_cookie[7] != 8) { ?>

                                  <td>
                                    <?php echo $value["rejected_remarks"]; ?>
                                  </td>



                                <?php } ?>

                                <td>

                                  <?php
                                  if (!isset($value["reoffer_remarks"]) && empty($value["reoffer_remarks"]) && $value["reoffer_remarks"] != "-") {
                                    $where["id_joint"] = $value['id_joint'];
                                    $where["id_fitup <> " . $value['id_fitup']] = null;
                                    $re_offer_remarks = $this->fitup_mod->fitup_list_remarks($where);
                                    unset($where);

                                    echo (isset($re_offer_remarks[0]["reoffer_remarks"]) ? $re_offer_remarks[0]["reoffer_remarks"] : (isset($re_offer_remarks[0]["postpone_remarks"]) ? $re_offer_remarks[0]["postpone_remarks"] : "-"));
                                  } else {
                                  ?>

                                    <?php echo (isset($value["reoffer_remarks"]) ? $value["reoffer_remarks"] : (isset($value["postpone_remarks"]) ? $value["postpone_remarks"] : "-")); ?>
                                  <?php } ?>
                                </td>

                                <td>
                                  <?php if ($no_pending <= 0 && $no_approved_client <= 0) { ?>
                                    <?php if ($this->user_cookie[7] != 8) {  ?>
                                      <?php if (!in_array($value['status_inspection'], array(5, 6, 7, 12))) {  ?>
                                        <?php if ($value['requested_for_update'] == 1) : ?>
                                          <span class="btn btn-secondary"><i class="fas fa-hourglass-half"></i> Requested For Update</span>
                                        <?php else : ?>
                                          <button type="button" onclick="request_for_update(this, '<?= $value['submission_id'] ?>')" class="btn btn-warning"><i class="fas fa-edit"></i> Request For Update</button>
                                        <?php endif; ?>
                                      <?php } ?>
                                    <?php } ?>
                                  <?php } ?>
                                </td>

                              </tr>
                            <?php $no++;
                            endforeach; ?>
                          </tbody>
                        </table>


                      </div>
                    </div>
                    <div class="col-md-12">
                      <hr>
                      <div class="float-right">

                        <?php if ($no_pending > 0) { ?>
                          <?php if ($this->user_cookie[7] == 8 || $this->permission_cookie[239] == 1) { ?>
                            <?php if ($total_pending_revise_smoe <= 0) { ?>
                              <a href='#' class="btn btn-primary" id="btnApprovedwcomment"><i class="fas fa-history"></i> Approved & Released With Comment</a>
                              <a href='#' class="btn btn-info" id="btnPostponed"><i class="fas fa-history"></i> Postponed</a>
                              <a href='#' class="btn btn-warning" id="btnReoffer"><i class="fas fa-history"></i> Re-Offer</a>
                            <?php } ?>
                          <?php } ?>
                        <?php } ?>

                        &nbsp;&nbsp;

                        <?php if ($approval_type != 'client_qc') { ?>
                          <?php if (isset($activity_eng[$joint_list[0]['drawing_wm']]['id'])) { ?>
                            <?php
                            $links_atc = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($activity_eng[$joint_list[0]['drawing_wm']]['id']), '+=/', '.-~') . "/" . $joint_list[0]['rev_wm'];
                            $links_atc_cross = base_url_ftp_eng() . "public_smoe/open_atc_cross/2/" . strtr($this->encryption->encrypt($joint_list[0]['drawing_wm']), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt($activity_eng[$joint_list[0]['drawing_wm']]['id']), '+=/', '.-~') . "/" . $joint_list[0]['rev_wm'];
                            ?>

                            <a target='_blank' href='<?= $links_atc ?>' class='btn btn-primary' title='Attachment'> <i class='fas fa-paperclip'></i> File Drawing </a>
                            <a target='_blank' href='<?= $links_atc_cross ?>' class='btn btn-green-smoe text-white mr-5' title='Attachment' download='<?= $joint_list[0]['drawing_wm'] ?>.pdf'>
                              <i class='fas fa-cloud-download-alt'></i> Download Drawing
                            </a>
                          <?php } ?>
                        <?php } else { ?>
                          <?php if (isset($activity_eng[$joint_list[0]['drawing_wm']]['id'])) { ?>
                            <?php
                            $links_atc = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($activity_eng[$joint_list[0]['drawing_wm']]['id']), '+=/', '.-~') . "/" . (isset($joint_list[0]["drawing_wm_rev_approved"]) ? $joint_list[0]["drawing_wm_rev_approved"] : $joint_list[0]['rev_wm']) . "/" . strtr($this->encryption->encrypt(1), '+=/', '.-~');
                            $links_atc_cross = base_url_ftp_eng() . "public_smoe/open_atc_cross/2/" . strtr($this->encryption->encrypt($joint_list[0]['drawing_wm']), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt($activity_eng[$joint_list[0]['drawing_wm']]['id']), '+=/', '.-~') . "/" . (isset($joint_list[0]["drawing_wm_rev_approved"]) ? $joint_list[0]["drawing_wm_rev_approved"] : $joint_list[0]['rev_wm']) . "/" . strtr($this->encryption->encrypt(1), '+=/', '.-~');
                            ?>

                            <a target='_blank' href='<?= $links_atc ?>' class='btn btn-primary' title='Attachment'> <i class='fas fa-paperclip'></i> File Drawing </a>
                            <a target='_blank' href='<?= $links_atc_cross ?>' class='btn btn-green-smoe text-white mr-5' title='Attachment' download='<?= $joint_list[0]['drawing_wm'] ?>.pdf'>
                              <i class='fas fa-cloud-download-alt'></i> Download Drawing
                            </a>
                          <?php } ?>
                        <?php } ?>



                        <?php if ($this->user_cookie[7] == 8) { ?>
                          <a href="<?= site_url('fitup/client_list') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                        <?php } else { ?>
                          <a href="<?= site_url('fitup/inspection_list') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                        <?php } ?>

                        <?php if (isset($joint_list[0]['report_number']) and !empty($joint_list[0]['report_number']) && $dt_client == "client") { ?>

                          <a href='<?php echo  base_url(); ?>fitup/pdf_files_client/<?php echo strtr($this->encryption->encrypt($joint_list[0]['project_code']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['discipline']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['module']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['type_of_module']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['report_number']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['company_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['deck_elevation']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['postpone_reoffer_no']), '+=/', '.-~'); ?>' target='_blank'><button class='btn btn-success' type="button"><i class="fas fa-file-pdf"></i> RFI</button></a>
                          <a href='<?php echo  base_url(); ?>fitup/pdf_files/<?php echo strtr($this->encryption->encrypt($joint_list[0]['project_code']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['discipline']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['module']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['type_of_module']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['report_number']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['company_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['company_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['company_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['deck_elevation']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['postpone_reoffer_no']), '+=/', '.-~'); ?>' target='_blank'><button class='btn btn-danger' type="button"><i class="fas fa-file-pdf"></i> Report</button></a>

                          <!-- <?php if ($this->user_cookie[7] != 8 && $this->permission_cookie[0] == 1) { ?>

                                  <a href='<?php echo  base_url(); ?>fitup/pdf_files/<?php echo strtr($this->encryption->encrypt($joint_list[0]['project_code']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['discipline']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['module']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['type_of_module']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt('marz'), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['submission_id']), '+=/', '.-~'); ?>' target='_blank'>
                                  <button type="button" class='btn btn-danger'><i class="fas fa-file-pdf"></i> SMOE Inspection Report</button></a>

                                <?php } ?> -->

                        <?php } else { ?>

                          <a href='<?php echo  base_url(); ?>fitup/pdf_files/<?php echo strtr($this->encryption->encrypt($joint_list[0]['project_code']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['discipline']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['module']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['type_of_module']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt('marz'), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['submission_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['company_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['company_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['deck_elevation']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['postpone_reoffer_no']), '+=/', '.-~'); ?>' target='_blank'>
                            <button type="button" class='btn btn-danger'><i class="fas fa-file-pdf"></i> SMOE Inspection Report</button></a>

                        <?php } ?>



                        <?php if ($no_pending > 0  && $no_approved_client <= 0) { ?>
                          <?php if ($this->user_cookie[7] != 8) { ?>
                            <?php if ($this->permission_cookie[31] == 1) { ?>
                              <a href='<?= base_url(); ?>fitup/update_on_pending/<?= strtr($this->encryption->encrypt($joint_list[0]['submission_id']), '+=/', '.-~') ?>'><button type="button" class="btn btn-warning"><i class="fas fa-edit"></i> Update</button></a>
                            <?php } ?>
                          <?php } ?>
                        <?php } ?>


                        <?php if ($no_pending > 0) { ?>
                          <button type="submit" name="submit" class="btn btn-primary" title="Submit"><i class="fas fa-save"></i> Save</button>
                        <?php } ?>


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
                            <th>Weld Map Drawing No</th>
                            <th>Joint No</th>
                            <th>Item Updated</th>
                            <th>Data From</th>
                            <th>Data To</th>
                            <th>Updated By</th>
                            <th>Updated Date</th>
                          </thead>
                          <tbody>
                            <?php $no = 1;
                            foreach ($revision_log as $key => $value) : ?>
                              <tr>
                                <td><?= $no++ ?></td>
                                <td class="text-nowrap"><?php echo $joint_detail[$value['id_template']]['drawing_wm'] ?> Rev.<?php echo $joint_detail[$value['id_template']]['rev_wm'] ?></td>
                                <td> <?php echo $joint_detail[$value['id_template']]['joint_no'] ?> </td>
                                <td><?= $value['name'] ?></td>
                                <td><?= $value['data_before'] ?></td>
                                <td><?= $value['data_after'] ?></td>
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


                <div class="tab-pane fade" id="Redline_attach" role="tabpanel" aria-labelledby="Redline_attach-tab">
                  <div class="row mt-3">
                    <div class="col-md-12">
                      <div class="table-responsive overflow-auto">

                        <a href='#' class="btn btn-info" id="btnNewRedline"><i class="fas fa-plus-circle"></i> Add Red-Line</a>
                        <br /><br />

                        <table class="table table-hover text-center" id="table_revise">
                          <thead class="bg-secondary text-white">
                            <th>No</th>
                            <th>Drawing No</th>
                            <th>Submission ID</th>
                            <th>Report No</th>
                            <th>Revision No</th>
                            <th>Redline File</th>
                            <th>Redline Description</th>
                            <th>Upload By</th>
                            <th>Upload Date</th>
                            <th>Action</th>
                          </thead>
                          <tbody>
                            <?php if (sizeof($redline_attach) > 0) { ?>
                              <?php $no = 1;
                              foreach ($redline_attach as $key => $value) : ?>
                                <tr>
                                  <td><?= $no++ ?></td>
                                  <td><?php echo $value["drawing_no"] ?></td>
                                  <td><?php echo $value["submission_id"] ?> </td>
                                  <td><?= (isset($value['report_no']) && !empty($value['report_no']) ? $master_report_number[$joint_list[0]['project_code']][$joint_list[0]['company_id']][$joint_list[0]['discipline']][$joint_list[0]['type_of_module']]["fitup_report"] . $value['report_no'] : "-") ?></td>
                                  <td><?= $value['postpone_reoffer_no'] ?></td>
                                  <td>
                                    <!-- <a target='_blank' href='<?= $this->link_server ?>/pcms_v2_photo/fab_img/redline/<?= $value['filename'] ?>'>Links</a> -->
                                    <?php
                                    $enc_redline = strtr($this->encryption->encrypt($value['filename']), '+=/', '.-~');
                                    $enc_path   = strtr($this->encryption->encrypt('/PCMS/pcms_v2/redline_attachment/'), '+=/', '.-~');
                                    ?>
                                    <a target='_blank' href='<?= site_url('irn/open_file/' . $enc_redline . '/' . $enc_path) ?>'>Links</a>
                                  </td>
                                  <td><?= $value['description'] ?></td>
                                  <td><?= $user[$value['upload_by']]['full_name'] ?></td>
                                  <td><?= $value['upload_date'] ?></td>
                                  <td>
                                    <?php if ($this->permission_cookie[33] == 1) { ?>
                                      <a href='<?= base_url() ?>fitup/delete_redline_data/<?php echo strtr($this->encryption->encrypt($value["id_redline"]), '+=/', '.-~'); ?>'>
                                        <button type='button' class='btn btn-danger'><i class="fas fa-trash-alt"></i></button></a>
                                    <?php } ?>
                                  </td>
                                </tr>
                              <?php endforeach; ?>
                            <?php } else { ?>
                              <tr>
                                <td colspan='10'> No Data Available</td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
  </form>


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

</div>
</div>


<div class="modal fade" id="modalRedline" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>fitup/process_new_redline" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title">Add Attachment Redline</h4>
        </div>
        <div class="modal-body">

          <b><i>Drawing No :</i></b><br />
          <input type="text" name="drawing_no" class='form-control' value="<?php echo $fitup['drawing_no']; ?>" readonly><br />

          <b><i>Submission ID :</i></b><br />
          <input type="text" name="submission_id" class='form-control' value="<?php echo $fitup['submission_id']; ?>" readonly><br />

          <b><i>Report No :</i></b><br />
          <input type="text" name="report_no" class='form-control' value="<?php echo $report_number; ?>" readonly><br />

          <b><i>Revision No :</i></b><br />
          <input type="text" name="postpone_reoffer_no" class='form-control' value="<?php echo $fitup['postpone_reoffer_no']; ?>" readonly><br />

          <b><i>Red-Line File :</i></b><br />
          <input type="file" name="attach_line[]" accept="application/pdf" multiple required><br /><br />

          <b><i>Attachment Description :</i></b><br />
          <textarea name='description' class='form-control'></textarea><br /> <br />

          <input type="hidden" name="upload_by" value="<?php echo $this->user_cookie[0]; ?>">
          <input type="hidden" name="upload_date" value="<?php echo date("Y-m-d H:i:s"); ?>">

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
        </div>
      </form>
    </div>

  </div>
</div>


<div class="modal fade" id="modalApprovedwcomment" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>fitup/process_postpone_reapproval" method="POST">
        <div class="modal-header">
          <h4 class="modal-title">Postponed RFI</h4>
        </div>
        <div class="modal-body">

          <b><i>Accepted & Released With Comment - Remarks :</i></b> <br />
          <input type="hidden" name="status_inspection" value="9">
          <input type="hidden" name="drawing_no" value="<?php echo $fitup['drawing_no']; ?>">
          <input type="hidden" name="discipline" value="<?php echo $fitup['discipline']; ?>">
          <input type="hidden" name="module" value="<?php echo $fitup['module']; ?>">
          <input type="hidden" name="type_of_module" value="<?php echo $fitup['type_of_module']; ?>">
          <input type="hidden" name="report_number" value="<?php echo $fitup['report_number']; ?>">
          <textarea name='approve_comment' placeholder="---" class='form-control'></textarea>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>Close</button>
        </div>
      </form>
    </div>

  </div>
</div>


<div class="modal fade" id="modalPostponed" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>fitup/process_postpone_reapproval" method="POST">
        <div class="modal-header">
          <h4 class="modal-title">Postponed RFI</h4>
        </div>
        <div class="modal-body">

          <b><i>Postponed Remarks :</i></b> <br />
          <input type="hidden" name="status_inspection" value="10">
          <input type="hidden" name="drawing_no" value="<?php echo $fitup['drawing_no']; ?>">
          <input type="hidden" name="discipline" value="<?php echo $fitup['discipline']; ?>">
          <input type="hidden" name="module" value="<?php echo $fitup['module']; ?>">
          <input type="hidden" name="type_of_module" value="<?php echo $fitup['type_of_module']; ?>">
          <input type="hidden" name="report_number" value="<?php echo $fitup['report_number']; ?>">
          <textarea name='postponed_remarks' placeholder="---" class='form-control'></textarea>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>Close</button>
        </div>
      </form>
    </div>

  </div>
</div>

<div class="modal fade" id="modalReoffer" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>fitup/process_postpone_reapproval" method="POST">
        <div class="modal-header">
          <h4 class="modal-title">Re-Offer RFI</h4>
        </div>
        <div class="modal-body">


          <b><i>Re-Offer Remarks :</i></b> <br />
          <input type="hidden" name="status_inspection" value="11">
          <input type="hidden" name="drawing_no" value="<?php echo $fitup['drawing_no']; ?>">
          <input type="hidden" name="discipline" value="<?php echo $fitup['discipline']; ?>">
          <input type="hidden" name="module" value="<?php echo $fitup['module']; ?>">
          <input type="hidden" name="type_of_module" value="<?php echo $fitup['type_of_module']; ?>">
          <input type="hidden" name="report_number" value="<?php echo $fitup['report_number']; ?>">
          <textarea name='reoffer_remarks' placeholder="---" class='form-control'></textarea>


        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>Close</button>
        </div>
      </form>
    </div>

  </div>
</div>


<script type="text/javascript">
  $(document).ready(function() {
    $("#btnApprovedwcomment").click(function() {
      $("#modalApprovedwcomment").modal();
    });
    $("#btnPostponed").click(function() {
      $("#modalPostponed").modal();
    });
    $("#btnReoffer").click(function() {
      $("#modalReoffer").modal();
    });
    $("#btnNewRedline").click(function() {
      $("#modalRedline").modal();
    });
  });

  $("#mySelect").select2();

  $('.dataTable').DataTable({
    "paging": false,
    "ordering": false,
  })

  $("select[name=module]").chained("select[name=project]");

  function change_all_button(mode, add_comment) {

    if (mode == 7) {
      $('.accepted_remarks').removeClass('d-none')
      $('.accepted_remarks').removeAttr('disabled');
    } else {
      $('.accepted_remarks').addClass('d-none')
      $('.accepted_remarks').prop('disabled', true);
    }

    $(".approve").prop('checked', false);
    $(".rejected").prop('checked', false);
    $(".pending").prop('checked', false);
    $('.reject_remarks').css('display', 'none');
    $('.pending_remarks').css('display', 'none');
    $('.inspection_remarks').css('display', 'none');

    if (mode == '1') {

      console.log(mode);

      $(".approve").prop('checked', true);
      $(".rejected").prop('checked', false);
      $(".pending").prop('checked', false);

      $('.inspection_remarks').show();
      $('.reject_remarks').css('display', 'none');
      $('.pending_remarks').css('display', 'none');

    } else if (mode == '2') {
      console.log(mode);
      $(".rejected").prop('checked', true);
      $(".approve").prop('checked', false);
      $(".pending").prop('checked', false);

      $('.reject_remarks').show();
      $('.pending_remarks').css('display', 'none');

    } else if (mode == '3') {

      $(".pending").prop('checked', true);
      $(".approve").prop('checked', false);
      $(".rejected").prop('checked', false);

      $('.pending_remarks').show();
      $('.reject_remarks').css('display', 'none');

    } else if (mode == '6') {

      $(".add_comment_status").val(null);
      $(".rejected").prop('checked', true);
      $(".approve").prop('checked', false);
      $(".witness").prop('checked', false);
      $(".review").prop('checked', false);
      $(".approve_with_comment").prop('checked', false);
      $(".postponed").prop('checked', false);
      $(".reoffer").prop('checked', false);

      $('.client_remarks').show();
      $('.approve_with_comment_remarks').css('display', 'none');
      $('.postponed_remarks').css('display', 'none');
      $('.reoffer_remarks').css('display', 'none');
      $(".client_remarks textarea").prop('required', true);

    } else if (mode == '7' && add_comment == 'accept') {

      $(".add_comment_status").val('accept');
      $(".approve").prop('checked', true);
      $(".witness").prop('checked', false);
      $(".review").prop('checked', false);
      $(".rejected").prop('checked', false);
      $(".approve_with_comment").prop('checked', false);
      $(".postponed").prop('checked', false);
      $(".reoffer").prop('checked', false);

      $('.client_remarks').css('display', 'none');
      $('.approve_with_comment_remarks').css('display', 'none');
      $('.postponed_remarks').css('display', 'none');
      $('.reoffer_remarks').css('display', 'none');

    } else if (mode == '7' && add_comment == 'witness') {

      $(".add_comment_status").val('witness');
      $(".witness").prop('checked', true);
      $(".approve").prop('checked', false);
      $(".review").prop('checked', false);
      $(".rejected").prop('checked', false);
      $(".approve_with_comment").prop('checked', false);
      $(".postponed").prop('checked', false);
      $(".reoffer").prop('checked', false);

      $('.client_remarks').css('display', 'none');
      $('.approve_with_comment_remarks').css('display', 'none');
      $('.postponed_remarks').css('display', 'none');
      $('.reoffer_remarks').css('display', 'none');

    } else if (mode == '7' && add_comment == 'review') {

      $(".add_comment_status").val('review');
      $(".review").prop('checked', true);
      $(".approve").prop('checked', false);
      $(".witness").prop('checked', false);
      $(".rejected").prop('checked', false);
      $(".approve_with_comment").prop('checked', false);
      $(".postponed").prop('checked', false);
      $(".reoffer").prop('checked', false);

      $('.client_remarks').css('display', 'none');
      $('.approve_with_comment_remarks').css('display', 'none');
      $('.postponed_remarks').css('display', 'none');
      $('.reoffer_remarks').css('display', 'none');

    } else if (mode == '9') {

      $(".approve_with_comment").prop('checked', true);
      $(".approve").prop('checked', false);
      $(".rejected").prop('checked', false);
      $(".postponed").prop('checked', false);
      $(".reoffer").prop('checked', false);

      $('.client_remarks').css('display', 'none');
      $('.approve_with_comment_remarks').show();
      $('.postponed_remarks').css('display', 'none');
      $('.reoffer_remarks').css('display', 'none');

    } else if (mode == '10') {

      $(".postponed").prop('checked', true);
      $(".approve").prop('checked', false);
      $(".rejected").prop('checked', false);
      $(".approve_with_comment").prop('checked', false);
      $(".reoffer").prop('checked', false);

      $('.client_remarks').css('display', 'none');
      $('.approve_with_comment_remarks').css('display', 'none');
      $('.postponed_remarks').show();
      $('.reoffer_remarks').css('display', 'none');

    } else if (mode == '11') {

      $(".reoffer").prop('checked', true);
      $(".approve").prop('checked', false);
      $(".rejected").prop('checked', false);
      $(".approve_with_comment").prop('checked', false);
      $(".postponed").prop('checked', false);

      $('.client_remarks').css('display', 'none');
      $('.approve_with_comment_remarks').css('display', 'none');
      $('.postponed_remarks').css('display', 'none');
      $('.reoffer_remarks').show();

    } else {

      $(".add_comment_status").val(null);
      $(".approve").prop('checked', false);
      $(".witness").prop('checked', false);
      $(".review").prop('checked', false);
      $(".rejected").prop('checked', false);
      $(".pending").prop('checked', false);
      $(".approve_with_comment").prop('checked', false);
      $(".postponed").prop('checked', false);
      $(".reoffer").prop('checked', false);

      $('.inspection_remarks').css('display', 'none');
      $('.reject_remarks').css('display', 'none');
      $('.pending_remarks').css('display', 'none');
      $('.client_remarks').css('display', 'none');
      $('.approve_with_comment_remarks').css('display', 'none');
      $('.postponed_remarks').css('display', 'none');
      $('.reoffer_remarks').css('display', 'none');

    }

  }

  function change_single_button(mode, no, add_comment) {

    if (mode == 7) {
      $('.accepted_remarks').removeClass('d-none')
      $('.accepted_remarks').removeAttr('disabled');
    } else {
      $('.accepted_remarks').addClass('d-none')
      $('.accepted_remarks').prop('disabled', true);
    }

    $("#app_" + no).prop('checked', false);
    $("#rjct_" + no).prop('checked', false);
    $("#pdg_" + no).prop('checked', false);
    $('#rjct_rmks_' + no).css('display', 'none');
    $('#pdg_rmks_' + no).css('display', 'none');
    $('#inspection_remarks_' + no).css('display', 'none');

    if (mode == '1') {

      $("#app_" + no).prop('checked', true);
      $("#rjct_" + no).prop('checked', false);
      $("#pdg_" + no).prop('checked', false);

      $('#inspection_remarks_' + no).show();
      $('#rjct_rmks_' + no).css('display', 'none');
      $('#pdg_rmks_' + no).css('display', 'none');

    } else if (mode == '2') {

      $("#rjct_" + no).prop('checked', true);
      $("#app_" + no).prop('checked', false);
      $("#pdg_" + no).prop('checked', false);

      $('#rjct_rmks_' + no).show();
      $('#pdg_rmks_' + no).css('display', 'none');

    } else if (mode == '3') {

      $("#pdg_" + no).prop('checked', true);
      $("#rjct_" + no).prop('checked', false);
      $("#app_" + no).prop('checked', false);

      $('#pdg_rmks_' + no).show();
      $('#rjct_rmks_' + no).css('display', 'none');

    } else if (mode == '6') {

      $("#add_comment_" + no).val(null);
      $("#app_clnt_" + no).prop('checked', false);
      $("#app_wc_" + no).prop('checked', false);
      $("#rjct_clnt_" + no).prop('checked', true);
      $("#postponed_" + no).prop('checked', false);
      $("#reoffer_" + no).prop('checked', false);

      $('#clnt_rmks_' + no).show();
      $('#approve_with_comment_remarks_' + no).css('display', 'none');
      $('#postponed_remarks_' + no).css('display', 'none');
      $('#reoffer_remarks_' + no).css('display', 'none');
      $("textarea[name='client_remarks[" + no + "]']").prop('required', true);

    } else {
      $("textarea[name='client_remarks[" + no + "]']").prop('required', false);

      if (mode == '7' && add_comment == 'accept') {
        $("#add_comment_" + no).val('accept');
        $("#app_clnt_" + no).prop('checked', true);
        $("#app_wc_" + no).prop('checked', false);
        $("#rjct_clnt_" + no).prop('checked', false);
        $("#postponed_" + no).prop('checked', false);
        $("#reoffer_" + no).prop('checked', false);

        $('#clnt_rmks_' + no).css('display', 'none');
        $('#approve_with_comment_remarks_' + no).css('display', 'none');
        $('#postponed_remarks_' + no).css('display', 'none');
        $('#reoffer_remarks_' + no).css('display', 'none');

      } else if (mode == '7' && add_comment == 'witness') {

        $("#add_comment_" + no).val('witness');
        $("#witness_clnt_" + no).prop('checked', true);
        $("#app_wc_" + no).prop('checked', false);
        $("#rjct_clnt_" + no).prop('checked', false);
        $("#postponed_" + no).prop('checked', false);
        $("#reoffer_" + no).prop('checked', false);

        $('#clnt_rmks_' + no).css('display', 'none');
        $('#approve_with_comment_remarks_' + no).css('display', 'none');
        $('#postponed_remarks_' + no).css('display', 'none');
        $('#reoffer_remarks_' + no).css('display', 'none');

      } else if (mode == '7' && add_comment == 'review') {

        $("#add_comment_" + no).val('review')
        $("#review_clnt_" + no).prop('checked', true);
        $("#app_wc_" + no).prop('checked', false);
        $("#rjct_clnt_" + no).prop('checked', false);
        $("#postponed_" + no).prop('checked', false);
        $("#reoffer_" + no).prop('checked', false);

        $('#clnt_rmks_' + no).css('display', 'none');
        $('#approve_with_comment_remarks_' + no).css('display', 'none');
        $('#postponed_remarks_' + no).css('display', 'none');
        $('#reoffer_remarks_' + no).css('display', 'none');

      } else if (mode == '9') {

        $("#app_clnt_" + no).prop('checked', false);
        $("#app_wc_" + no).prop('checked', true);
        $("#rjct_clnt_" + no).prop('checked', false);
        $("#postponed_" + no).prop('checked', false);
        $("#reoffer_" + no).prop('checked', false);

        $('#clnt_rmks_' + no).css('display', 'none');
        $('#approve_with_comment_remarks_' + no).show();
        $('#postponed_remarks_' + no).css('display', 'none');
        $('#reoffer_remarks_' + no).css('display', 'none');

      } else if (mode == '10') {

        $("#app_clnt_" + no).prop('checked', false);
        $("#app_wc_" + no).prop('checked', false);
        $("#rjct_clnt_" + no).prop('checked', false);
        $("#postponed_" + no).prop('checked', true);
        $("#reoffer_" + no).prop('checked', false);

        $('#clnt_rmks_' + no).css('display', 'none');
        $('#approve_with_comment_remarks_' + no).css('display', 'none');
        $('#postponed_remarks_' + no).show();
        $('#reoffer_remarks_' + no).css('display', 'none');

      } else if (mode == '11') {

        $("#app_clnt_" + no).prop('checked', false);
        $("#app_wc_" + no).prop('checked', false);
        $("#rjct_clnt_" + no).prop('checked', false);
        $("#postponed_" + no).prop('checked', false);
        $("#reoffer_" + no).prop('checked', true);

        $('#clnt_rmks_' + no).css('display', 'none');
        $('#approve_with_comment_remarks_' + no).css('display', 'none');
        $('#postponed_remarks_' + no).css('display', 'none');
        $('#reoffer_remarks_' + no).show();
      }
    }
  }



  function request_for_update(btn, submission_id) {
    var url = "<?= site_url('fitup/request_for_update/') ?>" + submission_id;
    $("#modal").modal({
      show: true,
      keyboard: false,
      backdrop: "static"
    }).find('.modal-body').load(url)
    $('.modal-title').text("Request For Update - Submission ID : " + submission_id)
    $('.modal-dialog').addClass('modal-lg')
  }


  function show_image(btn, source, type) {

    if (type == "client") {
      var url = "<?= $this->link_server ?>/pcms_v2_photo/fab_img/" + source
    } else {
      var url = "<?= $this->link_server ?>/pcms_v2_photo/" + source

    }


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
    let area = $('#area_v2').val();
    var location = event.value;

    if (location != null && location != "") {

      Swal.fire({
        type: "warning",
        title: "Update Area",
        text: "Are You Sure To Update This Area ? ",
        allowOutsideClick: false,
        showCancelButton: true
      }).then((res) => {
        if (res.value) {
          $.ajax({
            url: "<?= site_url('fitup/update_area') ?>",
            type: "POST",
            data: {
              area: area,
              location: location,
              submission_id: "<?= $joint_list[0]['submission_id'] ?>"
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
                // location.reload();
              }
            }
          })
        } else {}
      })

    }

  }

  function change_location(event) {
    let location = $('#location_v2').val();
    var point = event.value;

    if (point != null && point != "") {

      Swal.fire({
        type: "warning",
        title: "Update Point",
        text: "Are You Sure To Update This Point ? ",
        allowOutsideClick: false,
        showCancelButton: true
      }).then((res) => {
        if (res.value) {
          $.ajax({
            url: "<?= site_url('fitup/update_location') ?>",
            type: "POST",
            data: {
              location: location,
              point: point,
              submission_id: "<?= $joint_list[0]['submission_id'] ?>"
            },
            dataType: "JSON",
            success: function(data) {
              if (data.success) {
                Swal.fire({
                  type: "success",
                  title: "Success",
                  text: "Success Update Point",
                  timer: 1000
                })
                // location.reload();
              }
            }
          })
        } else {}
      })

    }

  }
</script>

<script type="text/javascript">
  $("select[name=location]").chained("select[name=area]");
  $("select[name=point]").chained("select[name=location]");
</script>