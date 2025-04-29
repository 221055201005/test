<?php

$range_probes = [0, 45, 60, 70];
$input_class  = "form-control form-control-sm";
$is_disabled  = "";
$allow_update = true;

$main         = $list[0];

if ($main['status_inspection'] > 0) {
  $is_disabled  = "disabled";
  $allow_update = false;
}

$current_url    = $_SERVER['PATH_INFO'];

$tab1           = encrypt("report");
$tab2           = encrypt("deffect");
$tab3           = encrypt("attachment");
?>

<style>
  th,
  td {
    vertical-align: middle !important;
  }

  .col_title {
    font-weight: bold;
  }

  input,
  textarea {
    width: 100%;
  }

  .col_wrap {
    width: 1%;
    white-space: nowrap;
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
<div id="content">
  <div class="container-fluid">

    <div class="row mt-3">
      <div class="col-md-3">
        <ul class="p-1 bg-white shadow-sm text-left nav nav-pills nav-fill  font-weight-bold" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link <?= $tab == 'report' ? 'active bg-seatrium-blue text-white' : '' ?>" id="report-tab" href="<?= site_url($url_detail . '?tab=' . $tab1) ?>" role="tab" aria-controls="report" aria-selected="true">Report</a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?= $tab == 'deffect' ? 'active bg-seatrium-blue text-white' : '' ?>" id="deffect-tab" href="<?= site_url($url_detail . '?tab=' . $tab2) ?>" role="tab" aria-controls="deffect" aria-selected="false">Deffect</a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?= $tab == 'attachment' ? 'active bg-seatrium-blue text-white' : '' ?>" id="deffect-tab" href="<?= site_url($url_detail . '?tab=' . $tab3) ?>" role="tab" aria-controls="deffect" aria-selected="false">Attachment</a>
          </li>

        </ul>
      </div>

      <div class="col-md-12">
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade <?= $tab == 'report' ? ' show active' : '' ?>" id="report" role="tabpanel" aria-labelledby="report-tab">
            <div class="row">
              <div class="col-md-12 mt-3">
                <div class="card border-0 shadow">
                  <div class="card-body p-0">
                    <form action="<?= site_url('ndt_live/update_ndt_ut') ?>" method="post">
                      <input type="hidden" name="uniq_id_report" value="<?= $main['uniq_id_report'] ?>">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="table-responsive overflow-auto">
                            <table class="table-sm" border="2">
                              <tr>
                                <td colspan="17">
                                  <table style="width:100%">
                                    <tr>
                                      <td width="25%" class="text-left">
                                        <img style="width:5cm" src="<?= base_url() ?>img/seatrium-logo.png" alt="">
                                      </td>
                                      <td width="50%" class="text-center">
                                        <h3><strong><?= $project[$main['id_project']]['description'] ?></strong></h3>
                                      </td>

                                      <td width="25%" class="text-right">
                                        <img src="<?= $project[$main['id_project']]['client_logo'] ?>" style='width: 4.5cm; height:2cm;vertical-align: text-bottom !important;' />
                                      </td>

                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              <!-- <tr>
                        <td colspan="17" class="text-center">
                          <img style="width:100%" src="<?= base_url() ?>img/header_report_2.png">
                        </td>
                      </tr> -->
                              <tr>
                                <td class="col_title text-center" rowspan="2" colspan="9">
                                  <h4>ULTRASONIC EXAMINATION REPORT</h4>
                                </td>
                                <td class="col_title" colspan="2">REPORT NO.</td>
                                <td colspan="6">
                                  <input type="text" name="report_no" class="<?= $input_class ?>" value="<?= $main['report_no'] ?>" <?= $is_disabled ?>>
                                </td>
                              </tr>

                              <tr>
                                <td class="col_title" colspan="2">DATE TESTED</td>
                                <td colspan="2">
                                  <input type="date" name="date_of_inspection" class="<?= $input_class ?>" value="<?= $main['date_of_inspection'] ? date('Y-m-d', strtotime($main['date_of_inspection'])) : '' ?>" <?= $is_disabled ?>>
                                </td>

                                <td class="col_title" colspan="2">Examination Stage</td>
                                <td colspan="2">
                                  <input type="text" name="examination_stage" class="<?= $input_class ?>" value="<?= $main['examination_stage'] ?>" <?= $is_disabled ?>>
                                </td>
                              </tr>

                              <tr>
                                <td class="col_title" colspan="2">CLIENT</td>
                                <td colspan="7"><?= $project[$main['id_project']]['client'] ?></td>
                                <td class="col_title" colspan="2">PAGE NO.</td>
                                <td colspan="6">
                                  <input type="text" name="page_no" class="<?= $input_class ?>" value="<?= $main['page_no'] ?>" <?= $is_disabled ?>>
                                </td>
                              </tr>

                              <tr>
                                <td class="col_title" colspan="2">PROJECT</td>
                                <td colspan="7"><?= $project[$main['id_project']]['project_name'] ?></td>

                                <td class="col_title" colspan="2">RFI NO.</td>
                                <td colspan="2" class="text-nowrap"><?= $report_form[$main['id_project']][$main['discipline']][$main['module']][$main['type_of_module']] . '-UT-' . str_pad($main['rfi_no'], 6, 0, STR_PAD_LEFT) ?></td>

                                <td class="col_title" colspan="2">Date Of RFI</td>
                                <td colspan="2">
                                  <input type="date" name="date_of_rfi" class="<?= $input_class ?>" value="<?= $main['date_of_rfi'] ? date('Y-m-d', strtotime($main['date_of_rfi'])) : '' ?>" <?= $is_disabled ?>>
                                </td>
                              </tr>

                              <tr>
                                <td class="col_title" colspan="2">Standard / Code</td>
                                <td colspan="7">
                                <?= $acceptance_criteria_form[$main['id_project']][$joint[$main['id_joint']]['company_id']][$main['discipline']][$main['module']][$main['type_of_module']][$joint[$main['id_joint']]['class']]['ndt']['ut']['standard_code'] ?>

                                  <!-- <input type="text" name="standart_code" class="<?= $input_class ?>" value="<?= $main['standart_code'] ?>" <?= $is_disabled ?>> -->
                                </td>
                                <td class="col_title col_wrap" colspan="2">TESTING LOCATION</td>
                                <td colspan="6">
                                  <input type="text" name="testing_location" class="<?= $input_class ?>" value="<?= $main['testing_location'] ?>" <?= $is_disabled ?>>
                                </td>
                              </tr>

                              <tr>
                                <td class="col_title" colspan="2">Acceptance Criteria </td>
                                <td colspan="7">
                                  Acceptance Criteria : <br>
                                  <?= $acceptance_criteria_form[$main['id_project']][$joint[$main['id_joint']]['company_id']][$main['discipline']][$main['module']][$main['type_of_module']][$joint[$main['id_joint']]['class']]['ndt']['ut']['acceptance_criteria'] ?>

                                </td>
                                <td class="col_title" colspan="2">JOB NO.</td>
                                <td colspan="6" style="height:100px">
                                  <textarea name="job_no" style="height:100% !important;" class="<?= $input_class ?>" <?= $is_disabled ?>><?= $main['job_no'] ?></textarea>
                                </td>
                              </tr>

                              <tr>
                                <td class="col_title" colspan="2">Procedure No.</td>
                                <td colspan="7">
                                <?= $acceptance_criteria_form[$main['id_project']][$joint[$main['id_joint']]['company_id']][$main['discipline']][$main['module']][$main['type_of_module']][$joint[$main['id_joint']]['class']]['ndt']['ut']['procedure'] ?>

                                  <!-- <input type="text" name="procedure_no" class="<?= $input_class ?>" value="<?= $main['procedure_no'] ?>" <?= $is_disabled ?>> -->
                                </td>
                                <td class="col_title" colspan="2">ITEM TESTED</td>
                                <td colspan="6">
                                  <input type="text" name="item_tested" class="<?= $input_class ?>" value="<?= $main['item_tested'] ?>" <?= $is_disabled ?>>
                                </td>
                              </tr>

                              <tr>
                                <td class="col_title col_wrap" colspan="2">GA/ASSY/ISOMETRIC Drawing No.</td>
                                <td colspan="7"><?= $main['drawing_no'] ?> Rev. <?= $main['drawing_rev_no'] ?></td>
                                <td class="col_title" colspan="2">PWHT Status</td>
                                <td colspan="6">
                                  <input type="text" name="pwht_status" class="<?= $input_class ?>" value="<?= $main['pwht_status'] ?>" <?= $is_disabled ?>>
                                </td>
                              </tr>

                              <tr>
                                <td class="col_title" rowspan="2" colspan="2">Job Description</td>
                                <td colspan="7" rowspan="2" style="height:10px">
                                  <textarea name="job_desc" style="height:100% !important;" class="<?= $input_class ?>" <?= $is_disabled ?>><?= $main['job_desc'] ?></textarea>

                                </td>
                                <td class="col_title" colspan="2">Testing Personnel</td>
                                <td colspan="6">
                                  <select class="form-control select2" name="testing_personnel">
                                    <option value="">---</option>
                                    <?php foreach ($testing_personnel as $key => $value) : ?>
                                      <option value="<?= $value['id'] ?>" <?= $value['id'] == $main['testing_personnel'] ? 'selected' : '' ?>>
                                        <?= $value['personel_name'] ?>
                                      </option>
                                    <?php endforeach; ?>
                                  </select>
                                  <!-- <input type="text" name="testing_personnel" class="<?= $input_class ?>" value="<?= $main['testing_personnel'] ?>" <?= $is_disabled ?>> -->
                                </td>
                              </tr>

                              <tr>
                                <td class="col_title" colspan="2">Certificate No.</td>
                                <td colspan="6">
                                  <input type="text" name="certificate_no" class="<?= $input_class ?>" value="<?= $main['certificate_no'] ?>" <?= $is_disabled ?>>
                                </td>
                              </tr>

                              <tr>
                                <td class="col_title" colspan="17">SPECIMENT DATA : </td>
                              </tr>
                              <tr>
                                <td colspan="17">
                                  <table class="table table-borderless table-sm">
                                    <tr>
                                      <td class="col_title"> GRADE MATERIAL</td>
                                      <td style="width:1%">:</td>
                                      <td>
                                        <input type="text" name="grade_material" class="<?= $input_class ?>" value="<?= $main['grade_material'] ?>" <?= $main['status_return'] > 0  ? "disabled" : ""; ?>>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="col_title" style="width:230px"> DELIVERY CONDITION</td>
                                      <td style="width:1%">:</td>
                                      <td>
                                        <input type="text" name="delivery_condition" class="<?= $input_class ?>" value="<?= $main['delivery_condition'] ?>" <?= $main['status_return'] > 0  ? "disabled" : ""; ?>>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="col_title"> Surface Condition</td>
                                      <td style="width:1%">:</td>
                                      <td>
                                        <input type="text" name="surface_condition" class="<?= $input_class ?>" value="<?= $main['surface_condition'] ?>" <?= $main['status_return'] > 0  ? "disabled" : ""; ?>>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="col_title"> TEMPERATURE</td>
                                      <td style="width:1%">:
                                      <td>
                                        <input type="text" name="temperature" class="<?= $input_class ?>" value="<?= $main['temperature'] ?>" <?= $main['status_return'] > 0  ? "disabled" : ""; ?>>
                                      </td>
                                    </tr>

                                    <!-- <tr>
                                      <td class="col_title"> HOLDING TIME</td>
                                      <td style="width:1%">:</td>
                                      <td>
                                        <input type="text" name="holding_time" class="<?= $input_class ?>" value="<?= $main['holding_time'] ?>" <?= $main['status_return'] > 0  ? "disabled" : ""; ?>>
                                      </td>
                                    </tr> -->

                                  </table>
                                </td>
                              </tr>

                              <tr>
                                <td class="col_title" colspan="17">TEST EQUIPMENT AND CALIBRATION DETAILS : </td>
                              </tr>

                              <tr>
                                <td class="col_title text-center">Probes</td>
                                <td class="col_title text-center">Serial No.</td>
                                <td class="col_title text-center">Type</td>
                                <td class="col_title text-center">Size (mm)</td>
                                <td class="col_title text-center">Frequency</td>
                                <td class="col_title text-center" colspan="4">Reference (db)</td>
                                <td class="col_title text-center">TR Loss</td>
                                <td class="col_title text-center" colspan="2">SCAN</td>
                                <td class="col_title text-center" colspan="5">Range /F.S.L</td>
                              </tr>

                              <?php foreach ($range_probes as $value) : ?>
                                <tr>
                                  <td class="col_title text-center"><?= $value ?> &deg;</td>
                                  <td class="col_title text-center">
                                    <input type="text" name="serial_no_<?= $value ?>" class="<?= $input_class ?>" value="<?= $main["serial_no_$value"] ?>" <?= $main['status_return'] > 0  ? "disabled" : ""; ?>>
                                  </td>
                                  <td class="col_title text-center">
                                    <input type="text" name="type_<?= $value ?>" class="<?= $input_class ?>" value="<?= $main["type_$value"] ?>" <?= $main['status_return'] > 0  ? "disabled" : ""; ?>>
                                  </td>

                                  <td class="col_title text-center">
                                    <input type="text" name="size_<?= $value ?>" class="<?= $input_class ?>" value="<?= $main["size_$value"] ?>" <?= $main['status_return'] > 0  ? "disabled" : ""; ?>>
                                  </td>
                                  <td class="col_title text-center">
                                    <input type="text" name="frequency_<?= $value ?>" class="<?= $input_class ?>" value="<?= $main["frequency_$value"] ?>" <?= $main['status_return'] > 0  ? "disabled" : ""; ?>>
                                  </td>
                                  <td class="col_title text-center" colspan="4">
                                    <input type="text" name="reference_<?= $value ?>" class="<?= $input_class ?>" value="<?= $main["reference_$value"] ?>" <?= $main['status_return'] > 0  ? "disabled" : ""; ?>>
                                  </td>

                                  <td class="col_title text-center">
                                    <input type="text" name="tr_loss_<?= $value ?>" class="<?= $input_class ?>" value="<?= $main["tr_loss_$value"] ?>" <?= $main['status_return'] > 0  ? "disabled" : ""; ?>>
                                  </td>

                                  <td class="col_title text-center" colspan="2">
                                    <input type="text" name="scan_<?= $value ?>" class="<?= $input_class ?>" value="<?= $main["scan_$value"] ?>" <?= $main['status_return'] > 0  ? "disabled" : ""; ?>>
                                  </td>
                                  <td class="col_title text-center" colspan="5">
                                    <input type="text" name="range_fsl_<?= $value ?>" class="<?= $input_class ?>" value="<?= $main["range_fsl_$value"] ?>" <?= $main['status_return'] > 0  ? "disabled" : ""; ?>>
                                  </td>
                                </tr>
                              <?php endforeach; ?>

                              <tr>
                                <td colspan="17">
                                  <table class="table table-borderless table-sm">
                                    <tr>
                                      <td class="col_title"> COUPLANT</td>
                                      <td style="width:1%">:</td>
                                      <td>
                                        <input type="text" name="couplant" class="<?= $input_class ?>" value="<?= $main["couplant"] ?>" <?= $main['status_return'] > 0  ? "disabled" : ""; ?>>
                                      </td>

                                      <td class="col_title"> BRAND</td>
                                      <td style="width:1%">:</td>
                                      <td>
                                        <input type="text" name="brand" class="<?= $input_class ?>" value="<?= $main["brand"] ?>" <?= $main['status_return'] > 0  ? "disabled" : ""; ?>>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="col_title" style="width:230px"> CALIBRATION BLOCK</td>
                                      <td style="width:1%">:</td>
                                      <td>
                                        <input type="text" name="calibration_block" class="<?= $input_class ?>" value="<?= $main["calibration_block"] ?>" <?= $main['status_return'] > 0  ? "disabled" : ""; ?>>
                                      </td>
                                      <td class="col_title" style="width:230px"> MODEL</td>
                                      <td style="width:1%">:</td>
                                      <td>
                                        <input type="text" name="model" class="<?= $input_class ?>" value="<?= $main["model"] ?>" <?= $main['status_return'] > 0  ? "disabled" : ""; ?>>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="col_title"> REFERENCE BLOCK S/N</td>
                                      <td style="width:1%">:</td>
                                      <td>
                                        <input type="text" name="reference_block" class="<?= $input_class ?>" value="<?= $main["reference_block"] ?>" <?= $main['status_return'] > 0  ? "disabled" : ""; ?>>

                                      </td>

                                      <td class="col_title" style="width:230px"> Serial No.</td>
                                      <td style="width:1%">:</td>
                                      <td>
                                        <input type="text" name="calibration_serial_no" class="<?= $input_class ?>" value="<?= $main["calibration_serial_no"] ?>" <?= $main['status_return'] > 0  ? "disabled" : ""; ?>>

                                      </td>

                                    </tr>
                                    <tr>
                                      <td class="col_title"> Calibration Block Thickness </td>
                                      <td style="width:1%">:</td>
                                      <td>
                                        <input type="text" name="calibration_block_thickness" class="<?= $input_class ?>" value="<?= $main["calibration_block_thickness"] ?>" <?= $main['status_return'] > 0  ? "disabled" : ""; ?>>

                                      </td>
                                    </tr>

                                    <tr>
                                      <td class="col_title"> SENSITIVITY</td>
                                      <td style="width:1%">:</td>
                                      <td>
                                        <input type="text" name="sensitivity" class="<?= $input_class ?>" value="<?= $main["sensitivity"] ?>" <?= $main['status_return'] > 0  ? "disabled" : ""; ?>>

                                      </td>
                                    </tr>

                                    <tr>
                                      <td class="col_title"> Evaluation Level</td>
                                      <td style="width:1%">:</td>
                                      <td>
                                        <input type="text" name="evaluation_level" class="<?= $input_class ?>" value="<?= $main["evaluation_level"] ?>" <?= $main['status_return'] > 0  ? "disabled" : ""; ?>>

                                      </td>
                                    </tr>

                                    <tr>
                                      <td class="col_title"> Recording Level</td>
                                      <td style="width:1%">:</td>
                                      <td>
                                        <input type="text" name="recording_level" class="<?= $input_class ?>" value="<?= $main["recording_level"] ?>" <?= $main['status_return'] > 0  ? "disabled" : ""; ?>>

                                      </td>
                                    </tr>

                                    <tr>
                                      <td class="col_title"> Scanning Technique</td>
                                      <td style="width:1%">:</td>
                                      <td>
                                        <input type="text" name="scanning_technique" class="<?= $input_class ?>" value="<?= $main["scanning_technique"] ?>" <?= $main['status_return'] > 0  ? "disabled" : ""; ?>>
                                      </td>
                                    </tr>

                                  </table>
                                </td>
                              </tr>

                              <tr class="text-center">
                                <td class="col_title" rowspan="2">S/N</td>
                                <td class="col_title" rowspan="2">Weld Map Dwg / Line & Spool No.</td>
                                <td class="col_title" rowspan="2">Joint No.</td>
                                <td class="col_title" rowspan="2">Joint Type</td>
                                <td class="col_title" rowspan="2">Total Length <br> (mm)</td>
                                <td class="col_title" rowspan="2">Tested length <br> (mm)</td>
                                <td class="col_title" rowspan="2">Size / Dia</td>
                                <td class="col_title" rowspan="2">Sch</td>
                                <td class="col_title" rowspan="2">Thk <br> (mm)</td>
                                <td class="col_title" rowspan="2">Welder ID</td>
                                <td class="col_title" rowspan="2">Welding <br> Process</td>
                                <td class="col_title" colspan="3">Defect Evaluation</td>
                                <td class="col_title" rowspan="2">Result</td>
                                <td class="col_title" rowspan="2">Inspection Category</td>
                                <td class="col_title" rowspan="2">Remarks</td>
                              </tr>
                              <tr class="text-center">
                                <td class="col_title">Defect <br> Length <br> (mm)</td>
                                <td class="col_title">Defect <br> depth <br> (mm)</td>
                                <td class="col_title">Defect <br> type <br> (mm)</td>
                              </tr>

                              <?php
                              $no         = 1;
                              $check_id   = [];

                              foreach ($list as $key => $value) : ?>
                                <?php

                                if (in_array($value['id_joint'], $check_id)) {
                                  continue;
                                }
                                $check_id[]   = $value['id_joint'];
                                $list_welder  = [];

                                $wp_rh    = explode(";", $joint[$value["id_joint"]]["weld_process_rh"]);
                                $wp_fc    = explode(";", $joint[$value["id_joint"]]["weld_process_fc"]);
                                $wprocess = array_unique(array_merge($wp_rh, $wp_fc));

                                ?>
                                <tr class="text-center">
                                  <td>
                                    <?= $no++ ?></td>
                                  <td><?= $joint[$value['id_joint']]['drawing_wm'] ?></td>
                                  <td><?= $joint[$value['id_joint']]['joint_no'] . ($visual[$value['id_visual']]['revision'] > 0 ? '(' . $visual[$value['id_visual']]['revision_category'] . $visual[$value['id_visual']]['revision'] . ')' : '') ?></td>
                                  <td><?= $weld_type[$joint[$value['id_joint']]['weld_type']]['weld_type_code'] ?></td>
                                  <td><?= ($visual[$value['id_visual']]['revision'] > 0) ? $visual[$value['id_visual']]['length_of_weld'] : $joint[$value['id_joint']]['weld_length']  ?></td>
                                  <td>
                                    <?php if ($allow_update) : ?>
                                      <input type="hidden" name="id_joint[<?= $key ?>]" value="<?= $value['id_joint'] ?>">

                                      <input type="number" step="any" name="tested_length[<?= $key ?>]" class="<?= $input_class ?>" value="<?= $value['tested_length'] ? $value['tested_length'] : $value['transmittal_request_tested_length'] ?>" required max="<?= ($visual[$value['id_visual']]['revision'] > 0) ? $visual[$value['id_visual']]['length_of_weld'] : $joint[$value['id_joint']]['weld_length'] ?>">
                                    <?php else : ?>
                                      <?= $value['tested_length'] ?>
                                    <?php endif; ?>
                                  </td>
                                  <td><?= $joint[$value['id_joint']]['diameter'] ?></td>
                                  <td><?= $joint[$value['id_joint']]['sch'] ?></td>
                                  <td><?= $joint[$value['id_joint']]['thickness'] ?></td>
                                  <td>
                                    <?php if (isset($welder_per_joint[$value['id_joint']])) : ?>
                                      <?php foreach ($welder_per_joint[$value['id_joint']] as $v) : ?>
                                        <?php

                                        $list_welder[] = $welder[$v]['welder_code'];

                                        ?>
                                      <?php endforeach; ?>
                                    <?php endif; ?>
                                    <?= implode(", ", $list_welder) ?></td>
                                  <td><?= implode("<br>", $wprocess) ?></td>
                                  <td>
                                    <?php if ($allow_update) : ?>
                                      <input type="number" step="any" value="<?= $value['defect_length'] ?>" name="defect_length[<?= $key ?>]" class="<?= $input_class ?>">
                                    <?php else : ?>
                                      <?= @$value['defect_length'] ?>
                                    <?php endif; ?>
                                  </td>
                                  <td>
                                    <?php if ($allow_update) : ?>
                                      <input type="text" step="any" value="<?= $value['defect_depth'] ?>" name="defect_depth[<?= $key ?>]" class="<?= $input_class ?>">
                                    <?php else : ?>
                                      <?= @$value['defect_depth'] ?>
                                    <?php endif; ?>
                                  </td>

                                  <td>
                                    <?php if ($allow_update) : ?>
                                      <select name="defect_type[<?= $key ?>]" class="custom-select custom-select-sm">
                                        <option value="">---</option>
                                        <?php foreach ($deffect_list as $v) : ?>
                                          <option value="<?= $v['id'] ?>" <?= $v['id'] == $value['defect_type'] ? 'selected' : '' ?>><?= $v['ctq_initial'] ?> - <?= $v['ctq_description'] ?></option>
                                        <?php endforeach; ?>
                                      </select>
                                    <?php else : ?>
                                      <?= @$deffect_list[$value['defect_type']]['ctq_initial'] ?>
                                    <?php endif; ?>
                                  </td>
                                  <td>

                                    <div class="text-justify">
                                      <div class="form-check text-success">
                                        <input <?= $main['status_inspection'] > 0  ? "disabled" : ""; ?> class="form-check-input input_radio approve" type="radio" name="result[<?= $key ?>]" value="1" style="width: 17px; height: 17px" <?= $value['result'] == 1 ? 'checked' : '' ?> required>
                                        <label class="form-check-label"><strong>ACC</strong></label>
                                      </div>
                                      <div class="form-check text-danger">
                                        <input <?= $main['status_inspection'] > 0  ? "disabled" : ""; ?> class="form-check-input input_radio reject" type="radio" name="result[<?= $key ?>]" value="2" style="width: 17px; height: 17px" <?= $value['result'] == 2 ? 'checked' : '' ?> required>
                                        <label class="form-check-label"><strong>REJ</strong></label>
                                      </div>
                                    </div>
                                  </td>

                                  <td>
                                    <?php if ($allow_update) : ?>
                                      <input type="text" name="inspection_cat[<?= $key ?>]" class="<?= $input_class ?>" value="<?= $value['inspection_cat'] ?>" required>
                                    <?php else : ?>
                                      <?= $value['inspection_cat'] ?>
                                    <?php endif; ?>
                                  </td>

                                  <td>
                                    <?php if ($allow_update) : ?>
                                      <textarea name="remarks[<?= $key ?>]" style="height:100% !important;" class="<?= $input_class ?>" <?= $is_disabled ?>><?= $value['remarks'] ?></textarea>
                                    <?php else : ?>
                                      <?= $value['remarks'] ?>
                                  </td>
                                <?php endif; ?>

                                </tr>
                              <?php endforeach; ?>

                              <tr>
                                <td colspan="17">
                                  Note :
                                  <br>
                                  <textarea name="note" style="height:100% !important;" class="<?= $input_class ?>" <?= $main['status_inspection'] > 4  ? "readonly" : ""; ?>><?= $main['note'] ?></textarea>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="17">
                                  <table class="table table-borderless table-sm">
                                    <tr>
                                      <td class="col_title col_wrap"> ACC</td>
                                      <td style="width:1%">:</td>
                                      <td>Acceptable</td>
                                    </tr>

                                    <tr>
                                      <td class="col_title col_wrap"> Rej</td>
                                      <td style="width:1%">:</td>
                                      <td>Reject</td>
                                    </tr>

                                    <tr>
                                      <td class="col_title col_wrap"> db</td>
                                      <td style="width:1%">:</td>
                                      <td>Decible</td>
                                    </tr>

                                    <tr>
                                      <td class="col_title col_wrap"> NAD</td>
                                      <td style="width:1%">:</td>
                                      <td>Not Appearance Discontinuity</td>
                                    </tr>

                                  </table>
                                </td>
                              </tr>
                            </table>
                            <table border="2" style="margin-top: -2px; width:100%;">
                              <tr>
                                <td width="25%">
                                  <table class="table table-borderless table-sm" style="font-size: 11px">
                                    <tr>
                                      <td class="col_wrap">Tested by</td>
                                      <td style="width:1%">:</td>
                                      <td></td>
                                    </tr>
                                    <tr>
                                      <td colspan="3">PCN UT Level II</td>
                                    </tr>
                                    <tr>
                                      <td colspan="3" class="text-center">
                                        <?php if ($main['tested_by']) : ?>
                                          <img src="data:image/png;base64,<?= $user[$main['tested_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
                                        <?php else : ?>
                                          <div style='height:3cm;'>
                                            <br>
                                            <?php if ($this->user_cookie[7] != 8) : ?>
                                              <?php if ($main['status_inspection'] == 0) : ?>
                                                <button type="button" onclick="approval_data(this, 1, 'tested')" class="btn btn-outline-success"><i class="fas fa-signature"></i> Digital Sign</button>
                                              <?php endif; ?>
                                            <?php endif; ?>
                                          </div>
                                        <?php endif; ?>

                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="col_title">PCN No.</td>
                                      <td style="width:1%"></td>
                                      <td><?= $main['tested_by'] ? $pcn_number[$main['testing_personnel']] : "" ?></td>
                                    </tr>
                                    <tr>
                                      <td class="col_title">Name</td>
                                      <td style="width:1%">:</td>
                                      <td><?= $main['tested_by'] ? $user[$main['tested_by']]['full_name'] : "" ?></td>
                                    </tr>
                                    <tr>
                                      <td class="col_title">Date</td>
                                      <td style="width:1%">:</td>
                                      <td><?= $main['date_tested_by'] ? date('d-M-Y', strtotime($main['date_tested_by'])) : "" ?></td>
                                    </tr>
                                  </table>
                                </td>
                                <td width="25%">
                                  <table class="table table-borderless table-sm" style="font-size: 11px">
                                    <tr>
                                      <td class="col_wrap">Review by</td>
                                      <td style="width:1%">:</td>
                                      <td></td>
                                    </tr>
                                    <tr>
                                      <td colspan="3">QC Inspector</td>
                                    </tr>
                                    <tr>

                                      <td colspan="3" class="text-center">
                                        <?php if ($main['qc_by']) : ?>
                                          <img src="data:image/png;base64,<?= $user[$main['qc_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
                                        <?php else : ?>
                                          <div style='height:3cm;'>
                                            <br>
                                            <?php if ($this->user_cookie[7] != 8) : ?>
                                              <?php if ($main['status_inspection'] == 1 and in_array(17, $this->user_cookie[13])) : ?>
                                                <button type="button" onclick="approval_data(this, 3, 'qc')" class="btn btn-outline-success"><i class="fas fa-signature"></i> Digital Sign</button>
                                                <?php if ($user_permission[193] == 1) :  ?>
                                                  <button type="button" di class="btn btn-danger" onclick="sweetalert('confirm_remarks', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Return&nbsp;</b> this?', this, event, 'return_data')"><i class="fas fa-history"></i> Return </button>
                                                <?php endif; ?>
                                              <?php endif; ?>
                                            <?php endif; ?>
                                          </div>
                                        <?php endif; ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="col_title">Name</td>
                                      <td style="width:1%">:</td>
                                      <td><?= $main['qc_by'] ? $user[$main['qc_by']]['full_name'] : "" ?></td>
                                    </tr>
                                    <tr>
                                      <td class="col_title">Date</td>
                                      <td style="width:1%">:</td>
                                      <td><?= $main['date_qc_by'] ? date('d-M-Y', strtotime($main['date_qc_by'])) : "" ?></td>
                                    </tr>
                                  </table>

                                </td>
                                <td width="25%">

                                  <table class="table table-borderless table-sm" style="font-size: 11px">
                                    <tr>
                                      <td class="col_wrap">Review by</td>
                                      <td style="width:1%">:</td>
                                      <td></td>
                                    </tr>
                                    <tr>
                                      <td colspan="3">Client Inspector</td>
                                    </tr>
                                    <tr>
                                      <td colspan="3" class="text-center">
                                        <?php if ($main['client_by']) : ?>
                                          <img src="data:image/png;base64,<?= $user[$main['client_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
                                        <?php else : ?>
                                          <div style='height:3cm;'>
                                            <br>
                                            <?php if ($main['status_inspection'] == 4) : ?>
                                              <button type="button" onclick="approval_data(this, 7, 'client')" class="btn btn-outline-success"><i class="fas fa-signature"></i> Digital Sign</button>
                                              <?php if ($user_permission[193] == 1) :  ?>
                                                <button type="button" di class="btn btn-danger" onclick="sweetalert('confirm_remarks', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Return&nbsp;</b> this?', this, event, 'return_data')"><i class="fas fa-history"></i> Return </button>
                                              <?php endif; ?>
                                            <?php endif; ?>
                                          </div>
                                        <?php endif; ?>

                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="col_title">Name</td>
                                      <td style="width:1%">:</td>
                                      <td><?= $main['client_by'] ? $user[$main['client_by']]['full_name'] : "" ?></td>
                                    </tr>
                                    <tr>
                                      <td class="col_title">Date</td>
                                      <td style="width:1%">:</td>
                                      <td><?= $main['date_client_by'] ? date('d-M-Y', strtotime($main['date_client_by'])) : "" ?></td>
                                    </tr>
                                  </table>
                                </td>
                                <td width="25%">
                                  <table class="table table-borderless table-sm" style="font-size: 11px">
                                    <tr>
                                      <td class="col_wrap">Reviewed by</td>
                                      <td style="width:1%">:</td>
                                    </tr>
                                    <tr>
                                      <td colspan="3">3rd Party</td>
                                    </tr>
                                    <tr>
                                      <td colspan="3" class="text-center">
                                        <div style='height:3cm;'>
                                          <?php if ($main['third_party_approval_status'] == 0 && $main['status_inspection'] == 7 && $this->user_cookie[7] != 8) { ?>
                                            <h6>-- Click the button below --</h6>
                                            <button type="button" onclick="sign_third_party(this)" class="btn btn-info"><i class="fas fa-exchange-alt"></i> Sign Document </button>
                                          <?php } else { ?>
                                            <?php if ($main['third_party_approval_by']) : ?>
                                              <img src="data:image/png;base64,<?= $user[$main['third_party_approval_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
                                            <?php endif; ?>
                                          <?php  } ?>
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="col_title">Name</td>
                                      <td style="width:1%">:</td>
                                      <td><?= $main['third_party_approval_by'] ? $user[$main['third_party_approval_by']]['full_name'] : "" ?></td>
                                    </tr>
                                    <tr>
                                      <td class="col_title">Date</td>
                                      <td style="width:1%">:</td>
                                      <td><?= $main['third_party_approval_date'] ? date('d-M-Y', strtotime($main['third_party_approval_date'])) : "" ?></td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 text-center p-2">
                          <?php if ($main['status_inspection'] == 0 || $main['status_return'] == 0) : ?>
                            <?php if ($user_permission[194] == 1) :  ?>
                              <button type="submit" class="btn btn-warning"><i class="fas fa-edit"> </i> Update</button>
                            <?php endif; ?>
                          <?php endif; ?>
                          <?php if ($user_permission[208] == 1 && $main['status_inspection'] != 12) { ?>
                            <button type="button" data-uniq_id_report="<?= $main['uniq_id_report'] ?>" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Void&nbsp;</b> this?', this, event, 'void_row_db')" class="btn btn-danger btn-sm"><i class="fa fa-exclamation-triangle"></i> Void</button>
                          <?php } ?>
                          <?php if ($main['status_inspection'] == 3) : ?>
                            <button type="button" onclick="transmit_to_client(this)" class="btn btn-info"><i class="fas fa-exchange-alt"></i> Transmit to Client</button>
                          <?php endif; ?>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade <?= $tab == 'deffect' ? ' show active' : '' ?>" id="deffect" role="tabpanel" aria-labelledby="deffect-tab">
            <div class="row mt-3">
              <div class="col-md-12">
                <div class="card border-0 shadow-sm">
                  <div class="card-body">
                    <form action="<?= site_url('ndt_live/add_deffect') ?>" method="post">
                      <input type="hidden" name="ndt_type" value="3">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="table-responsive overflow-auto">
                            <table class="table table-sm text-center table-bordered table-hover tr_ctq">
                              <thead class="bg-gray-table">
                                <th>Joint/Welder</th>
                                <th>Deffect Type</th>
                                <th>Deffect Length</th>
                                <th>Distance from Datum</th>
                                <th>Deffect Depth</th>
                                <th>Planarity</th>
                                <th>Type</th>
                                <th><button type="button" class="btn btn-sm btn-info" onclick="addCTQ()"><i class="fas fa-plus"></i></button></th>
                              </thead>
                              <tbody>
                                <?php foreach ($ctq as $key => $value) { ?>
                                  <tr class="row_<?= $value['id'] ?>">
                                    <td><?= $welder[$value['welder']]['welder_code'] . ' (Joint No. ' . $joint[$array_detail[$value['ndt_id']]['id_joint']]['joint_no'] . ')' ?></td>
                                    <td><?= $deffect[$value['ctq_id']]['ctq_description'] ?></td>
                                    <td><?= $value['length'] ?></td>
                                    <td><?= $value['datum'] ?></td>
                                    <td><?= $value['depth'] ?></td>
                                    <td><?= $value['planarity'] == 0 ? 'Non-Planar' : 'Planar' ?></td>
                                    <td><?= $value['type'] == 0 ? 'R/H' : 'F/C' ?></td>
                                    <td><button type="button" class="btn btn-sm btn-danger" onclick="removeCTQ(<?= $value['id'] ?>)"><i class="fas fa-trash"></i></button></td>
                                  <tr>
                                  <?php } ?>
                              </tbody>
                            </table>
                          </div>

                        </div>
                        <div class="col-md-12 text-right">
                          <hr>
                          <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Save</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade <?= $tab == 'attachment' ? ' show active' : '' ?>" id="attachment" role="tabpanel" aria-labelledby="attachment-tab">
            <div class="row mt-3">
              <div class="col-md-12">
                <div class="card border-0 shadow-sm">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <form action="<?php echo base_url('ndt_live/upload_new_attachment/3'); ?>" method="post" enctype="multipart/form-data">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Remarks Data :</label>
                                <textarea name='remarks' class='form-control' required="" style="height: 100px !important"></textarea>
                                <input type="hidden" class="form-control" name="submission_id" id="uniq_data" value="<?= $main['uniq_id_report'] ?>" autocomplete="off" readonly>
                                <input type="hidden" class="form-control" name="report_number" id="uniq_data" value="<?= $main['report_no'] ?>" autocomplete="off" readonly>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Revision No :</label>
                                <input class="form-control" type="number" name="revision">
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Select File to upload :</label>
                                <input type="file" class="form-control" name="file_attachment" id="file_attachment" required="">
                              </div>
                            </div>
                          </div>
                          <button type="submit" class="btn btn-secondary"> Upload</button>
                        </form>
                      </div>
                      <div class="col-md-12">
                        <table class="table text-muted">
                          <thead class="bg-gray-table">
                            <tr>
                              <th>ATTACHMENT</th>
                              <th>REVISION</th>
                              <th>UPLOAD BY</th>
                              <th>UPLOAD DATE</th>
                              <th>REMARKS</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php foreach ($data_attachment as  $value) { ?>
                              <tr>
                                <td>
                                  <a target="_blank" href="<?= base_url('ndt/open_atc/') . $value["filename"] . '/' . $value["filename"] ?>"><?php echo $value["filename"] ?></a>
                                </td>
                                <td><?= $value['revision'] ? $value['revision'] : '-' ?></td>
                                <td><?php echo $user[$value["created_by"]]['full_name'] ?></td>
                                <td><?php echo $value["created_date"] ?></td>
                                <td><?php echo $value["remarks"] ?></td>
                                <td><button class="btn btn-danger" type="button" onclick="delete_attachment_on_update('<?= $value["id"]; ?>','<?= $value["uniq_data"]; ?>')"><i class="fa fa-trash"></i></button></td>
                              </tr>
                            <?php } ?>
                            <script type="text/javascript">
                              function delete_attachment_on_update(id, uniq_data) {
                                Swal.fire({
                                  title: 'Are you sure to <b class="text-warning">&nbsp;Delete&nbsp;</b> this?',
                                  text: "This Attachment will permanent deleted!",
                                  type: 'warning',
                                  showCancelButton: true,
                                  confirmButtonColor: '#3085d6',
                                  cancelButtonColor: '#d33',
                                  confirmButtonText: 'Yes, Delete it!'
                                }).then((result) => {
                                  if (result.value) {
                                    $.ajax({
                                      url: "<?php echo base_url(); ?>ndt_live/delete_attachment_with_status",
                                      type: "post",
                                      data: {
                                        ndt: '<?= $initial ?>',
                                        id: id,
                                        uniq_data: uniq_data,
                                      },
                                      success: function(data) {
                                        if (data.includes("Error")) {
                                          Swal.fire(
                                            'Ops..',
                                            data,
                                            'error'
                                          );
                                        } else {
                                          Swal.fire(
                                            'Success',
                                            'Your data has been Updated!',
                                            'success'
                                          );
                                          location.reload();
                                        }
                                      }
                                    });
                                  }
                                })
                              }
                            </script>
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
  </div>
</div>
</div>

<script>
  function approval_data(btn, status, role) {

    Swal.fire({
      type: "warning",
      title: "Sign Document",
      text: "Are you sure to sign this document ?",
      showCancelButton: true
    }).then((res) => {

      if (res.value) {
        Swal.fire({
          title: 'Processing...',
          allowOutsideClick: false,
          onBeforeOpen: () => {
            Swal.showLoading()
          },
        })

        $.ajax({
          url: "<?= site_url('ndt_live/sign_document_ut') ?>",
          type: "POST",
          data: {
            uniq_id_report: "<?= encrypt($main['uniq_id_report']) ?>",
            status: status,
            role: role
          },
          dataType: "JSON",
          success: (data) => {
            if (data.success) {
              Swal.fire({
                type: "success",
                title: "Successfully Sign This Document !!",
                timer: 1000
              })

              setTimeout(() => {
                location.reload()
              }, 1000);
            }
          },
          error: (data) => {
            Swal.fire({
              type: "error",
              title: "Something Went Wrong !!",
              timer: 1000
            })
          }
        })
      }
    })

  }

  function transmit_to_client(btn) {
    Swal.fire({
      type: "warning",
      title: "Transmit Document",
      text: "Are you sure to transmit this document ?",
      showCancelButton: true
    }).then((res) => {

      if (res.value) {
        Swal.fire({
          title: 'Processing...',
          allowOutsideClick: false,
          onBeforeOpen: () => {
            Swal.showLoading()
          },
        })

        $.ajax({
          url: "<?= site_url('ndt_live/transmit_to_client_ut') ?>",
          type: "POST",
          data: {
            uniq_id_report: "<?= encrypt($main['uniq_id_report']) ?>",
          },
          dataType: "JSON",
          success: (data) => {
            if (data.success) {
              Swal.fire({
                type: "success",
                title: "Successfully Transmit This Document !!",
                timer: 1000
              })

              setTimeout(() => {
                location.reload()
              }, 1000);
            }
          },
          error: (data) => {
            Swal.fire({
              type: "error",
              title: "Something Went Wrong !!",
              timer: 1000
            })
          }
        })
      }
    })
  }

  function sign_third_party(btn) {
    Swal.fire({
      type: "warning",
      title: "A Sign Document",
      text: "Are you sure to sign this document ?",
      showCancelButton: true
    }).then((res) => {

      if (res.value) {
        Swal.fire({
          title: 'Processing...',
          allowOutsideClick: false,
          onBeforeOpen: () => {
            Swal.showLoading()
          },
        })

        $.ajax({
          url: "<?= site_url('ndt_live/proccess_sign_third_party') ?>",
          type: "POST",
          data: {
            uniq_id_report: "<?= encrypt($main['uniq_id_report']) ?>",
            method: "ut"
          },
          dataType: "JSON",
          success: (data) => {
            if (data.success) {
              Swal.fire({
                type: "success",
                title: "Successfully sign This Document !!",
                timer: 1000
              })

              setTimeout(() => {
                location.reload()
              }, 1000);
            }
          },
          error: (data) => {
            Swal.fire({
              type: "error",
              title: "Something Went Wrong !!",
              timer: 1000
            })
          }
        })
      }
    })
  }

  // CTQ PART

  var no = 0

  function addCTQ() {
    no++;

    let html = `
      <tr id="row_${no}">
      <td>
        <select class="custom-select" name="ndt_id[${no}]" required>
        <option value="">---</option>
        <?php foreach ($list as $key => $value_1) : ?> 
          <option value="<?= $value_1['id_ut'] ?>"><?= $welder[$value_1['id_welder']]['welder_code'] ?> (Joint No. <?= $joint[$value_1['id_joint']]['joint_no'] ?>)</option>
         <?php endforeach; ?>
         </select>
      </td>
      <td>
        <select class="custom-select" name="ctq_id[${no}]" required>
        <option value="">---</option>
        <?php foreach ($master_data_ctq as $key => $value_2) : ?> 
          <option value="<?= $value_2['id'] ?>"><?= $value_2['ctq_description'] ?> (<?= $value_2["ctq_initial"] ?>)</option>
         <?php endforeach; ?>
         </select>
      </td>
      <td><input name="length[${no}]" type="number" step="any" class="form-control" placeholder="Length" required></td>
      <td><input name="datum[${no}]" type="text" step="any" class="form-control" placeholder="Datum" required></td>
      <td><input name="depth[${no}]" type="text" step="any" class="form-control" placeholder="Depth" required></td>
      <td>
        <select class="custom-select" name="planarity[${no}]" required>
          <option value="">---</option>
          <option value="0">Non-Planar</option>
          <option value="1">Planar</option>
        </select>
      </td>

      <td>
        <select class="custom-select" name="type[${no}]" required>
          <option value="">---</option>
          <option value="0">R/H</option>
          <option value="1">F/C</option>
        </select>
      </td>

      <td><button type="button" class="btn btn-sm btn-danger" onclick="removeCTQ_row(${no})"><i class="fas fa-trash"></i></button></td>
      </tr>
    `
    $('.tr_ctq').append(html)
  }

  function removeCTQ_row(no) {
    $('#row_' + no).remove()
  }

  function removeCTQ(id) {
    Swal.fire({
      type: 'warning',
      title: 'Are You Sure to Remove this Data?',
      // input: 'tel',
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: 'Yes',
    }).then((result) => {
      console.log(result)
      /* Read more about isConfirmed, isDenied below */
      if (result.value == true) {
        $.ajax({
          url: "<?= base_url() ?>ndt_live/removeCTQ",
          type: "POST",
          data: {
            'id': id,
          },
        })
        Swal.fire('Success!', '', 'success')
        // location.reload()
        $('.row_' + id).remove()
      } else {
        Swal.fire('Changes are not saved', '', 'info')
      }
    })
  }

  function return_data(btn, remarks) {
    var link = '<?php echo base_url() ?>ndt_live/return_data/<?= strtr($this->encryption->encrypt('ut'), '+=/', '.-~') . '/' . strtr($this->encryption->encrypt($main['uniq_id_report']), '+=/', '.-~') ?>'
    window.location = link + '?note=' + remarks;
  }
</script>

<script>
	function void_row_db(btn) {
		var uniq_id_report = $(btn).data("uniq_id_report");
		console.log("uniq_id_report:", uniq_id_report);

		$.ajax({
			url: "<?php echo base_url() ?>ndt_live/delete_void_ut",
			data: {
				uniq_id_report: uniq_id_report,
			},
			type: 'post',
			success: function(data) {
				if (data.includes('Error')) {
					sweetalert("error", data);
				} else {
					sweetalert("success", "Void Data Success!");

          setTimeout(() => {
            location.reload()
          }, 1000);
				}
			},
			error: function(xhr, status, error) {
				sweetalert("error", "An error occurred: " + error);
			}
		});
	}
</script>