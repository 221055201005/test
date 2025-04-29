<?php
$range_probes = [0, 45, 60, 70];
$main         = $list[0];

$legend_inspection          = explode(";", $main["transmittal_inspection_authority"]);
if ((in_array(1, $legend_inspection)) == 1) {
  $checked_type             = "hold";
} elseif ((in_array(2, $legend_inspection)) == 1) {
  $checked_type             = "witness";
} elseif ((in_array(3, $legend_inspection)) == 1 || (in_array(4, $legend_inspection)) == 1) {
  $checked_type             = "review";
}
?>

<!DOCTYPE html>
<html lang="en">
<title><?= $main['report_no'] ?></title>

<head>
  <style type="text/css">
    @page {
      margin: 0cm 0cm;
    }

    body {
      top: 0cm;
      left: 0cm;
      right: 0cm;
      margin-top: 7.946cm;
      margin-left: 0.5cm;
      margin-right: 0.5cm;
      margin-bottom: 1cm;
      font-family: "helvetica";
      font-size: 60% !important;
    }

    header {
      position: fixed;
      top: 0cm;
      left: 0cm;
      right: 0cm;
      height: 2cm;
      padding-top: 0.5cm;
      padding-left: 0.5cm;
      padding-right: 0.5cm;

    }

    table {
      border-collapse: collapse !important;
      font-size: 8px !important;
    }

    footer {
      position: fixed;
      top: 28cm;
      left: 0cm;
      right: 0cm;
      height: 2cm;
      padding-top: 15px;
      padding-left: 1.4cm;
      padding-right: 1.5cm;

    }


    .titleHead {
      border: 1px #000 solid;
      border-collapse: collapse;
      text-align: center;
      vertical-align: middle;
      font-size: 25px;
      background-color: #a6ffa6;
      font-weight: bold;

    }

    .titleHeadMain {
      text-align: center;
      border-collapse: collapse;
      text-align: center;
      vertical-align: middle;
      font-size: 25px;
      font-weight: bold;
    }


    table.table td {
      font-size: 90%;
      border: 1px #000 solid;
      font-weight: bold;
      max-width: 150px;
      word-wrap: break-word !important;
      text-align: center;
    }

    .col_title {
      font-weight: bold;
    }

    .col_wrap {
      width: 1%;
      white-space: nowrap;
    }

    table>thead>tr>td,
    table>tbody>tr>td {
      vertical-align: middle !important;
    }

    .br_break {
      line-height: 15px;
    }

    .br_break_no_bold {
      line-height: 18px;
    }

    .br {
      border-right: 1px #000 solid;
    }

    .bl {
      border-left: 1px #000 solid;
    }

    .bt {
      border-top: 1px #000 solid;
    }

    .bb {
      border-bottom: 1px #000 solid;
    }

    .bx {
      border-left: 1px #000 solid;
      border-right: 1px #000 solid;
    }

    .by {
      border-top: 1px #000 solid;
      border-bottom: 1px #000 solid;
    }

    .ball {
      border-top: 1px #000 solid;
      border-bottom: 1px #000 solid;
      border-left: 1px #000 solid;
      border-right: 1px #000 solid;
    }



    label {
      display: block;
      padding-left: 3;
      text-indent: -1;
    }

    input {
      width: 15px;
      height: 15px;
      padding: 0;
      margin: 0;
      vertical-align: bottom;
      position: relative;
      top: 0px;
      *overflow: hidden;
    }

    .text-left {
      text-align: left;
    }

    .text-center {
      text-align: center;
    }

    .text-right {
      text-align: right;
    }

    .valign-middle {
      vertical-align: middle;
      word-wrap: break-word !important
    }

    .fs-10 {
      font-size: 8px !important;
    }

    .text-nowrap {
      white-space: nowrap;
    }
  </style>
</head>

<header>
  <table border="1" width="100%" cellpadding="2">
    <tr>
      <td colspan="17">
        <table style="width:100%">
          <tr>
            <td width="23%" class="text-left valign-middle">
              <img style="width:3cm" src="img/seatrium-logo.png">
            </td>
            <td width="50%" class="text-center valign-middle">
              <span style="font-size: 15px !important"><strong><?= $main['id_project'] == '17' ? 'Changhua 2204 Offshore Windfarm Project' : $project[$main['id_project']]['description'] ?></strong></span>
            </td>

            <td width="23%" class="text-right valign-middle">
              <img src="<?= $project[$main['id_project']]['client_logo'] ?>" style='width: 2.5cm;' />
            </td>

          </tr>
        </table>
      </td>
    </tr>

    <tr>
      <td class="col_title text-center" rowspan="2" colspan="9">
        <span style="font-size: 12px !important">ULTRASONIC EXAMINATION REPORT</span>
      </td>
      <td class="col_title" colspan="2">REPORT NO.</td>
      <td colspan="6"><?= $main['report_no'] ?></td>
    </tr>

    <tr>
      <td class="col_title" colspan="2">DATE TESTED</td>
      <td colspan="2"><?= $main['date_of_inspection'] ? date('Y-m-d', strtotime($main['date_of_inspection']))  : '' ?></td>

      <td class="col_title" colspan="2">Examination Stage</td>
      <td colspan="2">
        <?= $main['examination_stage'] ?>
      </td>

    </tr>

    <tr>
      <td class="col_title" colspan="2">CLIENT</td>
      <td colspan="7"><?= $project[$main['id_project']]['client'] ?></td>
      <td class="col_title" colspan="2">PAGE NO.</td>
      <td colspan="6"><?= $main['page_no'] ?></td>
    </tr>

    <tr>
      <td class="col_title" colspan="2">PROJECT</td>
      <td colspan="7"><?= $project[$main['id_project']]['project_name'] ?></td>
      <td class="col_title" colspan="2">RFI NO.</td>
      <td colspan="2" class="text-nowrap"><?= $report_form[$main['id_project']][$main['discipline']][$main['module']][$main['type_of_module']] . '-UT-' . str_pad($main['rfi_no'], 6, 0, STR_PAD_LEFT) ?></td>

      <td class="col_title" colspan="2">Date Of RFI</td>
      <td colspan="2">
        <?= $main['date_of_rfi'] ? date('Y-m-d', strtotime($main['date_of_rfi']))  : '' ?>
      </td>
    </tr>

    <tr>
      <td class="col_title" colspan="2">Standard / Code</td>
      <td colspan="7"><?= $acceptance_criteria_form[$main['id_project']][$joint[$main['id_joint']]['company_id']][$main['discipline']][$main['module']][$main['type_of_module']][$joint[$main['id_joint']]['class']]['ndt']['ut']['standard_code'] ?></td>
      <td class="col_title col_wrap" colspan="2">TESTING LOCATION</td>
      <td colspan="6"><?= $main['testing_location'] ?></td>
    </tr>

    <tr>
      <td class="col_title" colspan="2">Acceptance Criteria </td>
      <td colspan="7">
        Acceptance Criteria :
        <br>
        <?= $acceptance_criteria_form[$main['id_project']][$joint[$main['id_joint']]['company_id']][$main['discipline']][$main['module']][$main['type_of_module']][$joint[$main['id_joint']]['class']]['ndt']['ut']['acceptance_criteria'] ?>
      </td>
      <td class="col_title" colspan="2">JOB NO.</td>
      <td colspan="6"><?= $main['job_no'] ?></td>
    </tr>

    <tr>
      <td class="col_title" colspan="2">Procedure No.</td>
      <td colspan="7"><?= $acceptance_criteria_form[$main['id_project']][$joint[$main['id_joint']]['company_id']][$main['discipline']][$main['module']][$main['type_of_module']][$joint[$main['id_joint']]['class']]['ndt']['ut']['procedure'] ?></td>
      <td class="col_title" colspan="2">ITEM TESTED</td>
      <td colspan="6"><?= $main['item_tested'] ?></td>
    </tr>

    <tr>
      <td class="col_title col_wrap" colspan="2">GA/ASSY/ISOMETRIC Drawing No.</td>
      <td colspan="7"><?= $main['drawing_no'] ?> Rev. <?= $main['drawing_rev'] ?></td>
      <td class="col_title" colspan="2">PWHT Status</td>
      <td colspan="6"><?= $main['pwht_status'] ?></td>
    </tr>

    <tr>
      <td class="col_title" rowspan="2" colspan="2">Job Description</td>
      <td colspan="7" rowspan="2" style="height:10px"><?= $main['job_desc'] ?></td>
      <td class="col_title" colspan="2">Testing Personnel</td>
      <td colspan="6"><?= $pcn_number[$main['testing_personnel']] ?></td>
    </tr>

    <tr>
      <td class="col_title" colspan="2">Certificate No.</td>
      <td colspan="6"><?= $main['certificate_no'] ?></td>
    </tr>
  </table>
</header>

<body>

  <table style="width:100%;" border="1">
    <tr>
      <td class="col_title" colspan="17">SPECIMENT DATA : </td>
    </tr>
    <tr>
      <td colspan="17">
        <table style="width:100%">
          <tr>
            <td class="col_title"> GRADE MATERIAL</td>
            <td style="width:1%">:</td>
            <td><?= $main['grade_material'] ?></td>
          </tr>
          <tr>
            <td class="col_title" style="width:129px"> DELIVERY CONDITION</td>
            <td style="width:1%">:</td>
            <td><?= $main['delivery_condition'] ?></td>
          </tr>
          <tr>
            <td class="col_title"> Surface Condition</td>
            <td style="width:1%">:</td>
            <td><?= $main['surface_condition'] ?></td>
          </tr>
          <tr>
            <td class="col_title"> TEMPERATURE</td>
            <td style="width:1%">:
            <td><?= $main['temperature'] ?></td>
          </tr>
          <!-- <tr>
            <td class="col_title"> HOLDING TIME</td>
            <td style="width:1%">:</td>
            <td><?= $main['holding_time'] ?></td>
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
      <td class="col_title text-center" colspan="2" style=" word-wrap: break-word;">Frequency</td>
      <td class="col_title text-center" colspan="3">Reference (db)</td>
      <td class="col_title text-center">TR Loss</td>
      <td class="col_title text-center" colspan="2">SCAN</td>
      <td class="col_title text-center" colspan="5">Range /F.S.L</td>
    </tr>

    <?php foreach ($range_probes as $value) : ?>
      <tr>

        <td class="text-center"><?= $value ?> &deg;</td>

        <td class="text-center"><?= $main["serial_no_$value"] ?></td>
        <td class="text-center"><?= $main["type_$value"] ?></td>

        <td class="text-center"><?= $main["size_$value"] ?></td>
        <td class="text-center" colspan="2" style=" word-wrap: break-word;"><?= $main["frequency_$value"] ?></td>
        <td class="text-center" colspan="3"><?= $main["reference_$value"] ?></td>

        <td class="text-center"><?= $main["tr_loss_$value"] ?></td>

        <td class="text-center" colspan="2"><?= $main["scan_$value"] ?></td>
        <td class="text-center" colspan="5"><?= $main["range_fsl_$value"] ?></td>

      </tr>
    <?php endforeach; ?>

    <tr>
      <td colspan="17">
        <table width="100%">
          <tr>
            <td class="col_title"> COUPLANT</td>
            <td style="width:1%">:</td>
            <td><?= $main["couplant"] ?></td>

            <td class="col_title"> BRAND</td>
            <td style="width:1%">:</td>
            <td><?= $main["brand"] ?></td>

          </tr>
          <tr>
            <td class="col_title" style="width:129px"> CALIBRATION BLOCK</td>
            <td style="width:1%">:</td>
            <td><?= $main["calibration_block"] ?></td>

            <td class="col_title" style="width:129px"> MODEL</td>
            <td style="width:1%">:</td>
            <td><?= $main["model"] ?></td>

          </tr>
          <tr>
            <td class="col_title"> REFERENCE BLOCK S/N</td>
            <td style="width:1%">:</td>
            <td><?= $main["reference_block"] ?> </td>

            <td class="col_title"> Serial No.</td>
            <td style="width:1%">:</td>
            <td><?= $main["calibration_serial_no"] ?></td>

          </tr>
          <tr>
            <td class="col_title"> Calibration Block Thickness </td>
            <td style="width:1%">:</td>
            <td><?= $main["calibration_block_thickness"] ?></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

          <tr>
            <td class="col_title"> SENSITIVITY</td>
            <td style="width:1%">:</td>
            <td><?= $main["sensitivity"] ?></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

          <tr>
            <td class="col_title"> Evaluation Level</td>
            <td style="width:1%">:</td>
            <td><?= $main["evaluation_level"] ?></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

          <tr>
            <td class="col_title"> Recording Level</td>
            <td style="width:1%">:</td>
            <td><?= $main["recording_level"] ?></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

          <tr>
            <td class="col_title"> Scanning Technique</td>
            <td style="width:1%">:</td>
            <td><?= $main["scanning_technique"] ?></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
  <table border="1" cellpadding="2" style="width: 100%; margin-top: -2px;">
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
      <td class="col_title" rowspan="2" style=" word-wrap: break-word;">Remarks</td>
    </tr>
    <tr class="text-center">
      <td class="col_title">Defect <br> Length <br> (mm)</td>
      <td class="col_title">Defect <br> depth <br> (mm)</td>
      <td class="col_title">Defect <br> type <br> (mm)</td>
    </tr>

    <?php
    $no         = 1;
    $min_row    = 15;
    $blank_row  = 0;
    $check_id   = [];

    if (count($list) < $min_row) {
      $blank_row = $min_row - count($list);
    }

    if (count($list) == 1) {
      $blank_row  = 0;
    }

    $check_id = [];

    foreach ($list as $key => $value) : ?>
      <?php
      if (in_array($value['id_joint'], $check_id)) {
        $blank_row++;
        continue;
      }
      $check_id[]   = $value['id_joint'];
      $list_welder  = [];
      $wp_rh    = explode(";", $joint[$value["id_joint"]]["weld_process_rh"]);
      $wp_fc    = explode(";", $joint[$value["id_joint"]]["weld_process_fc"]);
      $wprocess = array_unique(array_merge($wp_rh, $wp_fc));


      ?>
      <tr class="text-center">
        <td><?= $no++ ?></td>
        <td><?= $joint[$value['id_joint']]['drawing_wm'] ?></td>
        <td><?= $joint[$value['id_joint']]['joint_no'] . ($visual[$value['id_visual']]['revision'] > 0 ? '(' . $visual[$value['id_visual']]['revision_category'] . $visual[$value['id_visual']]['revision'] . ')' : '')?></td>
        <td><?= $weld_type[$joint[$value['id_joint']]['weld_type']]['weld_type_code'] ?></td>
        <td><?= $visual[$value['id_visual']]['length_of_weld'] ?></td>
        <td><?= $value['tested_length'] ?></td>
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
          <?= implode(", <br>", $list_welder) ?></td>
        </td>
        <td><?= implode("<br>", $wprocess) ?></td>
        <td><?= $value['defect_length'] ?></td>
        <td><?= $value['defect_depth'] ?></td>
        <td>
          <?= @$deffect_list[$value['defect_type']]['ctq_initial'] ?>
        </td>
        <td>
          <?php if ($value['result'] == 1) : ?>
            ACC
          <?php elseif ($value['result'] == 2) : ?>
            REJ
          <?php endif; ?>
        </td>
        <td><?= $value['inspection_cat'] ?></td>
        <td style=" word-wrap: break-word;"><?= $value['remarks'] ?></td>

      </tr>
    <?php endforeach; ?>
    <?php if ($blank_row > 0) : ?>
      <?php foreach (range(1, $blank_row) as $row) : ?>
        <tr class="text-center">
          <?php foreach (range(1, 17) as $td) : ?>
            <td style="height:20px"><?= $td == 1 ? $no++ : '' ?></td>
          <?php endforeach; ?>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>

    <tr>
      <td colspan="17">
        Note :
        <br>
        <br>
        <?= $main['note'] ?>
      </td>
    </tr>
    <tr>
      <td colspan="17">
        <table border="0" width="100%">
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
  <table border="1" style="margin-top: -1px; width:100%;">
    <tr>
      <td width="25%" style="vertical-align: top !important;">
        Tested By :
        <br>
        PCN UT Level II
        <br>
        <br>
        <?php if ($main['tested_by']) : ?>
          <center>
            <img src="data:image/png;base64,<?= $user[$main['tested_by']]['sign_approval'] ?>" style='width: 3cm; height: 2cm' />
          </center>
        <?php else : ?>
          <div style='height:1.98cm;'>

          </div>
        <?php endif; ?>
        <br>
        <strong>PCN No. </strong> <?= $main['tested_by'] ? $pcn_number[$main['testing_personnel']] : "" ?>
        <br>
        <strong>Name : </strong> <?= $main['tested_by'] ? $user[$main['tested_by']]['full_name'] : "" ?>
        <br>
        <strong>Date &nbsp;&nbsp;: </strong> <?= $main['date_tested_by'] ? date('d-M-Y', strtotime($main['date_tested_by'])) : "" ?>
      </td>
      <td width="25%" style="vertical-align: top !important;">
        Review By :
        <br>
        QC Inspector
        <br>
        <br>
        <?php if ($main['qc_by']) : ?>
          <center>
            <img src="data:image/png;base64,<?= $user[$main['qc_by']]['sign_approval'] ?>" style='width: 3cm; height: 2cm;' />
          </center>
        <?php else : ?>
          <div style='height:1.98cm;'>

          </div>
        <?php endif; ?>
        <br>
        <br>
        <strong>Name : </strong> <?= $main['qc_by'] ? $user[$main['qc_by']]['full_name'] : "" ?>
        <br>
        <strong>Date &nbsp;&nbsp;: </strong> <?= $main['date_qc_by'] ? date('d-M-Y', strtotime($main['date_qc_by'])) : "" ?>
      </td>
      <td width="25%" style="vertical-align: top !important;">
        Review By :
        <br>
        Client Inspector
        <br>
        <br>
        <?php //if ($main['client_by']) : 
        ?>
        <center>
          <!-- <img src="data:image/png;base64,<?= $user[$main['client_by']]['sign_approval'] ?>" style='width: 3cm; height: 2cm ' /> -->
          <div style="page-break-inside: avoid;">
            <?php if ($main['id_project'] == 17) : ?>
              <style type="text/css">
                .color_stamp {
                  color: rgba(63, 72, 204, 255) !important;
                }

                .check_stamp {
                  -ms-transform: scale(1.7) !important;
                  -moz-transform: scale(1.7) !important;
                  -webkit-transform: scale(1.7) !important;
                  -o-transform: scale(1.7) !important;
                  transform: scale(1.7) !important;
                }

                .border_stamp {
                  border: 3px solid rgba(63, 72, 204, 255) !important;
                }

                .box_stamp {
                  padding: 4px;
                  font-weight: bold;
                  z-index: 99 !important;
                  width: 140px;
                }

                .valign_middle {
                  vertical-align: middle !important;
                }
              </style>
              <div class="box color_stamp border_stamp box_stamp">
                <center>
                  <img src="img/orsted_stamp.png" style="width:35px">
                  <br>
                  <strong>CHW 2204 OSS Project</strong>
                </center>
                <table cellpadding="0" style="width:100%; border-bottom: none !important">
                  <tr>
                    <td width="40%" class="valign_middle">Review</td>
                    <td><input type="checkbox" style="margin-bottom: 1px" <?= $checked_type == 'review' ? 'checked' : '' ?>></td>
                  </tr>
                  <tr>
                    <td width="40%" class="valign_middle">Witness</td>
                    <td><input type="checkbox" style="margin-bottom: 1px" <?= $checked_type == 'hold' or $checked_type == 1 ? 'witness' : '' ?>></td>
                  </tr>
                  <tr>
                    <td width="40%" class="valign_middle">Inspect</td>
                    <td><input type="checkbox" style="margin-bottom: 1px" <?= $checked_type == 'hold' ? 'checked' : '' ?>></td>
                  </tr>
                </table>
                <br>
                Date : <?= $main['date_client_by'] ? date('Y-m-d', strtotime($main['date_client_by'])) : space(15) ?>
                &nbsp;
                <span style="z-index: 99 !important;">Signature :</span>

              </div>
              <div class="text-right" style="padding-right: 5px; padding-bottom:3px;">
                <?php if ($main['client_by']) { ?>
                  <img src="data:image/png;base64, <?= $user[$main['client_by']]['sign_approval'] ?>" style='width: 70px !important; position: absolute !important; margin-left: 70px !important; margin-top: -70px !important; z-index: -99 !important; 
/*		                  	border: 5px solid #555;*/
		                  	' />
                <?php } ?>
              </div>
            <?php else : ?>
              <?php if ($main['client_by']) { ?>
                <img src="data:image/png;base64,<?= $user[$main['client_by']]['sign_approval'] ?>" style='width: 3.5cm;vertical-align: text-bottom !important;' />
              <?php } ?>
            <?php endif; ?>
          </div>
        </center>
        <br>
        <br>
        <strong>Name : </strong> <?= $main['client_by'] ? $user[$main['client_by']]['full_name'] : "" ?>
        <br>
        <strong>Date &nbsp;&nbsp;: </strong> <?= $main['date_client_by'] ? date('d-M-Y', strtotime($main['date_client_by'])) : "" ?>
      </td>

      <td width="25%" style="vertical-align: top !important;">
        Reviewed By :
        <br>
        Third Party
        <br>
        <br>
        <div style='height:3cm;'>
          <?php if ($main['third_party_approval_by']) : ?>
            <img src="data:image/png;base64,<?= $user[$main['third_party_approval_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
          <?php endif; ?>
        </div>
        <br>
        <br>
        <strong>Name : </strong> <?= $main['third_party_approval_by'] ? $user[$main['third_party_approval_by']]['full_name'] : "" ?>
        <br>
        <strong>Date &nbsp;&nbsp;: </strong> <?= $main['third_party_approval_date'] ? date('d-M-Y', strtotime($main['third_party_approval_date'])) : "" ?>
      </td>
    </tr>
  </table>
</body>

</html>