<!DOCTYPE html>
<html lang="en">
<?php
$legend_inspection          = explode(";", $main["transmittal_inspection_authority"]);
if ((in_array(1, $legend_inspection)) == 1) {
  $checked_type             = "hold";
} elseif ((in_array(2, $legend_inspection)) == 1) {
  $checked_type             = "witness";
} elseif ((in_array(3, $legend_inspection)) == 1 || (in_array(4, $legend_inspection)) == 1) {
  $checked_type             = "review";
}
?>
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
      margin-top: 0.5cm;
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
      padding-top: 1.4cm;
      padding-left: 1.4cm;
      padding-right: 1.5cm;
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
  </style>
</head>

<body>

  <table border="0px" style="border-collapse: collapse !important;padding:10px;" width="100%">
    <tr colspan="17">
      <td style="text-align: left; width: 20% !important;vertical-align: middle !important;">
        <img src="img/seatrium-logo.png" style="width: 170px; zoom: 2;">
      </td>
      <td style="text-align: center; width: 60% !important;vertical-align: middle !important;">
        <p style="font-size: 20px !important; font-weight: bold"><?= $main['id_project'] == '17' ? 'Changhua 2204 Offshore Windfarm Project' : $project['description'] ?></p>
      </td>
      <td style="text-align: right; width: 20% !important;vertical-align: middle !important;">
        <img src="<?= $project['client_logo'] ?>" style="width: 120px;">
      </td>
    </tr>
  </table>

  <table border="1px" style="border-collapse: collapse !important;padding:10px !important;" width="100%">
    <!-- panjang row 22 -->
    <tr>
      <td colspan="9" rowspan="2" style="font-weight: bold; text-align:center; padding-bottom: 4px; font-size: 13px !important;">MAGNETIC PARTICLE INSPECTION REPORT</td>

      <td colspan="2" style="font-weight: bold; text-align:left; padding-bottom: 4px; width: 120px !important;">Report No</td>
      <td colspan="6" style="text-align:left; padding-bottom: 4px; "><?= $main['report_no'] ?></td>
    </tr>
    <tr>
      <td colspan="2" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Page No</td>
      <td colspan="6" style="text-align:left; padding-bottom: 4px; "><?= $main['page_no'] ?></td>
    </tr>
    <tr>
      <td colspan="3" style="font-weight: bold; text-align:left; padding-bottom: 4px; width: 150px !important;">Client</td>
      <td colspan="6" style="text-align:left; padding-bottom: 4px; "><?= $project['client'] ?></td>

      <td colspan="2" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">RFI No.</td>
      <td colspan="6" style="text-align:left; padding-bottom: 4px; "><?= $report_form[$main['id_project']][$main['discipline']][$main['module']][$main['type_of_module']] . '-MT-' . str_pad($main['rfi_no'], 6, 0, STR_PAD_LEFT) ?></td>
    </tr>
    <tr>
      <td colspan="3" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Project Name</td>
      <td colspan="6" style="text-align:left; padding-bottom: 4px; "><?= $project['project_name'] ?></td>

      <td colspan="2" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Date of Inspection</td>
      <td colspan="6" style="text-align:left; padding-bottom: 4px; "><?= DATE("Y-m-d", strtotime($main['date_of_inspection'])) ?></td>
    </tr>
    <tr>
      <td colspan="3" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Standard / Code</td>
      <td colspan="6" style="text-align:left; padding-bottom: 4px; "><?= $acceptance_criteria_form[$main['id_project']][$joint[$main['id_joint']]['company_id']][$main['discipline']][$main['module']][$main['type_of_module']][$joint[$main['id_joint']]['class']]['ndt']['mt']['standard_code'] ?></td>

      <td colspan="2" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Testing Location</td>
      <td colspan="6" style="text-align:left; padding-bottom: 4px; "><?= $main['testing_location'] ?></td>
    </tr>
    <tr>
      <td colspan="3" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Procedure No.</td>
      <td colspan="6" style="text-align:left; padding-bottom: 4px; "><?= $acceptance_criteria_form[$main['id_project']][$joint[$main['id_joint']]['company_id']][$main['discipline']][$main['module']][$main['type_of_module']][$joint[$main['id_joint']]['class']]['ndt']['mt']['procedure'] ?></td>

      <td colspan="2" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">PWHT</td>
      <td colspan="6" style="text-align:left; padding-bottom: 4px; "><?= $main['pwht'] ?></td>
    </tr>
    <tr>
      <td colspan="3" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">GA/ASSY/ISOMETRIC Drawing No.</td>
      <?php //test_var($master_joint) 
      ?>
      <td colspan="6" style="text-align: left; padding-bottom: 4px; ">
        <?= $master_joint[0]['drawing_no'] . ' Rev. ' . intval($master_joint[0]['transmit_gaas_rev']) ?>
      </td>

      <td colspan="2" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Job No.</td>
      <td colspan="6" style="text-align:left; padding-bottom: 4px; "><?= $main['job_no'] ?></td>
    </tr>
    <tr>
      <td colspan="3" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Job Description</td>
      <td colspan="6" style="text-align:left; padding-bottom: 4px; "><?= $main['job_desc'] ?></td>

      <td colspan="2" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Item Tested</td>
      <td colspan="6" style="text-align:left; padding-bottom: 4px; "><?= $main['item_tested'] ?></td>
    </tr>

    <tr>
      <td colspan="2" rowspan="4" style="vertical-align: middle; font-weight: bold; text-align:center; padding-bottom: 4px; width: 90px !important;">Type of Magnetization <br> Equipment Used</td>
      <td colspan="1" rowspan="1" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Brand</td>
      <td colspan="6" rowspan="1" style="text-align:left; padding-bottom: 4px; "><?= $main['brand'] ?></td>

      <td colspan="2" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Viewing Condition</td>
      <td colspan="2" style="text-align:left; padding-bottom: 4px; "><?= $main['viewing_condition'] ?></td>

      <td colspan="2" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Examination Stage</td>
      <td colspan="2" style="text-align:center; padding-bottom: 4px; "><?= $main['examination_stage'] ?></td>
    </tr>
    <tr>
      <td colspan="1" rowspan="1" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Model</td>
      <td colspan="6" rowspan="1" style="text-align:left; padding-bottom: 4px; "><?= $main['model'] ?></td>

      <td colspan="2" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Surface Condition</td>
      <td colspan="2" style="text-align:left; padding-bottom: 4px; "><?= $main['surface_condition'] ?></td>

      <td colspan="2" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Lifting Capacity</td>
      <td colspan="2" style="text-align:center; padding-bottom: 4px; "><?= $main['lifting_capacity'] ?></td>
    </tr>
    <tr>
      <td colspan="1" rowspan="1" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Serial No</td>
      <td colspan="6" rowspan="1" style="text-align:left; padding-bottom: 4px; "><?= $main['serial_no'] ?></td>

      <td colspan="2" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Surface Temperature</td>
      <td colspan="2" style="text-align:left; padding-bottom: 4px; "><?= $main['surface_temperature'] ?></td>

      <td colspan="2" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Direction of Field</td>
      <td colspan="2" style="text-align:center; padding-bottom: 4px; "><?= $main['direction_of_field'] ?></td>
    </tr>

    <tr>
      <td colspan="1" rowspan="1" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Sensitivity</td>
      <td colspan="6" rowspan="1" style="text-align:left; padding-bottom: 4px; "><?= $main['sensivity'] ?></td>

      <td colspan="2" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Applying Current</td>
      <td colspan="6" style="text-align:left; padding-bottom: 4px; ">
        Continious <input type="checkbox" <?= $main['applying_current'] == 1 ? 'checked' : '' ?> name="applying_current" value="1" style="font-size: 12px !important;">
        Residual <input type="checkbox" <?= $main['applying_current'] == 2 ? 'checked' : '' ?> name="applying_current" value="2" style="font-size: 12px !important;">
      </td>
    </tr>
    <tr>
      <td colspan="3" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Grade Material</td>
      <td colspan="6" style="text-align:left; padding-bottom: 4px; "><?= $main['grade_material'] ?></td>

      <td colspan="2" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Magnetic Current</td>
      <td colspan="6" style="text-align:left; padding-bottom: 4px; ">
        AC <input type="checkbox" <?= $main['magnetic_current'] == 1 ? 'checked' : '' ?> name="magnetic_current" value="1" style="font-size: 12px !important;">
        DC <input type="checkbox" <?= $main['magnetic_current'] == 2 ? 'checked' : '' ?> name="magnetic_current" value="2" style="font-size: 12px !important;">
      </td>
    </tr>
    <tr>
      <td colspan="3" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Testing Personnel</td>
      <td colspan="6" style="text-align:left; padding-bottom: 4px; "><?= $main['testing_personel'] ?></td>

      <td colspan="2" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Consumable Brand</td>
      <td colspan="6" style="text-align:left; padding-bottom: 4px; "><?= $main['consumable_brand'] ?></td>
    </tr>
    <tr>
      <td colspan="3" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Certificate No.</td>
      <td colspan="6" style="text-align:left; padding-bottom: 4px; "><?= $main['certificate_no'] ?></td>

      <td colspan="2" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Batch Number</td>
      <td colspan="6" style="text-align:left; padding-bottom: 4px; "><?= $main['batch_number'] ?></td>
    </tr>
    <tr>
      <td rowspan="5" colspan="3" style="font-weight: bold; text-align:center; padding-bottom: 4px; ">Acceptable to Specification</td>
      <td colspan="6" rowspan="5" style="text-align: left !important">
      <?= $acceptance_criteria_form[$main['id_project']][$joint[$main['id_joint']]['company_id']][$main['discipline']][$main['module']][$main['type_of_module']][$joint[$main['id_joint']]['class']]['ndt']['mt']['acceptance_criteria'] ?>

      </td>

      <td colspan="2" style="font-weight: bold; text-align:left; padding-bottom: 4px; ">Medium</td>
      <td colspan="6" style="text-align:left; padding-bottom: 4px; "><?= $main['medium'] ?></td>
    </tr>

    <tr>
      <td colspan="2" style="text-align: left; font-weight: bold">Background</td>
      <td colspan="6" rowspan="1"><?= $main['background'] ?></td>
    </tr>

    <tr>
      <td colspan="2" style="text-align: left; font-weight: bold">Demagnetization</td>

      <td colspan="6" style="text-align:left; padding-bottom: 4px; ">
        YES <input type="checkbox" <?= $main['demagnetization'] == 1 ? 'checked' : '' ?> name="demagnetization" value="1" style="font-size: 12px !important;">
        NO <input type="checkbox" <?= $main['demagnetization'] == 2 ? 'checked' : '' ?> name="demagnetization" value="2" style="font-size: 12px !important;">
      </td>
    </tr>

    <tr>
      <td colspan="2" style="text-align: left; font-weight: bold">Applicable Partcicle</td>
      <td colspan="6" style="text-align: left; ">
        YES <input type="checkbox" <?= $main['applicable_particle'] == 1 ? 'checked' : '' ?> name="applicable_particle" value="1" style="font-size: 12px !important;">
        NO <input type="checkbox" <?= $main['applicable_particle'] == 2 ? 'checked' : '' ?> name="applicable_particle" value="2" style="font-size: 12px !important;">
      </td>
    </tr>

    <tr>
      <td colspan="2" style="border-right: none; font-weight: bold;">Yoke Expire Calibration Date</td>
      <td colspan="6" style="text-align:center; padding-bottom: 4px; border-left: none;">
        <?= DATE('Y-m-d', strtotime($main['yoke_expired_calibration_date'])) ?>
      </td>
    </tr>

    <tr>
      <td rowspan="2" style="text-align:center; vertical-align: middle; width: 10px !important;">S/N</td>
      <td rowspan="2" style="text-align:center; vertical-align: middle; ">Weld Map Dwg / Line & Spool No</td>
      <td rowspan="2" style="text-align:center; vertical-align: middle; ">Joint No</td>
      <td rowspan="2" style="text-align:center; vertical-align: middle; ">Joint Type</td>

      <td rowspan="2" style="text-align:center; vertical-align: middle; ">Size/Dia</td>

      <td rowspan="2" style="text-align:center; vertical-align: middle; ">Sch</td>
      <td rowspan="2" style="text-align:center; vertical-align: middle; ">Thk (mm)</td>
      <td rowspan="2" style="text-align:center; vertical-align: middle; ">Total Length (mm)</td>
      <td rowspan="2" style="text-align:center; vertical-align: middle; ">Tested Length (mm)</td>
      <td rowspan="2" style="text-align:center; vertical-align: middle; ">Welding Process</td>
      <td rowspan="2" style="text-align:center; vertical-align: middle; ">Welder ID</td>
      <td rowspan="2" style="text-align:center; vertical-align: middle; ">Result</td>
      <td colspan="3" style="text-align:center; vertical-align: middle; " rowspan="1">Type of Discontinuites</td>
      <td rowspan="2" style="text-align:center; vertical-align: middle; ">Inspection Category</td>
      <td rowspan="2" style="text-align:center; vertical-align: middle; ">Remarks</td>
    </tr>

    <tr>
      <td rowspan="1" style="text-align:center; vertical-align: middle; ">Deffect Length (mm)</td>
      <td rowspan="1" style="text-align:center; vertical-align: middle; ">Deffect Type</td>
      <td rowspan="1" style="text-align:center; vertical-align: middle; ">Distance from Datum (mm)</td>
    </tr>
    <?php $no = 1; ?>
    <?php foreach ($detail as $key => $value) {
      $welders_by_joint[$value['id_joint']][] = $value['id_welder'];
    } ?>
    <?php foreach ($detail as $key => $value) {

      $wp_rh = explode(";", $joint[$value["id_joint"]]["weld_process_rh"]);
      $wp_fc = explode(";", $joint[$value["id_joint"]]["weld_process_fc"]);
      $wprocess = array_unique(array_merge($wp_rh, $wp_fc));

      $joint_before = $detail[($key - 1)]['id_joint'];
      if ($joint_before == $value["id_joint"]) {
        $no++;
        continue;
      }

    ?>
      <tr style="text-align: center; vertical-align: middle;">
        <td><?= $no ?></td>
        <td><strong style="font-weight: normal; <?= $value['id_joint'] == $detail[($key - 1)]['id_joint'] ? 'color: white' : '' ?>"><?= $joint[$value['id_joint']]['drawing_wm'] ?></td>
        <td><?= $value['id_joint'] == $detail[($key - 1)]['id_joint'] ? "" : $joint[$value['id_joint']]['joint_no'] . ($value['revision'] > 0 ? '(' . $value['revision_category'] . $value['revision'] . ')' : '') ?></td>
        <td><?= $value['id_joint'] == $detail[($key - 1)]['id_joint'] ? "" : $mas_weld_type[$joint[$value['id_joint']]['weld_type']] ?></td>
        <td><?= $value['id_joint'] == $detail[($key - 1)]['id_joint'] ? "" : $joint[$value['id_joint']]['diameter'] ?></td>
        <td><?= $value['id_joint'] == $detail[($key - 1)]['id_joint'] ? "" : $joint[$value['id_joint']]['sch'] ?></td>
        <td><?= $value['id_joint'] == $detail[($key - 1)]['id_joint'] ? "" : $joint[$value['id_joint']]['thickness'] ?></td>
        <td><?= $value['id_joint'] == $detail[($key - 1)]['id_joint'] ? "" : $joint[$value['id_joint']]['weld_length'] ?></td>
        <td><?= $value['tested_length'] ?></td>

        <td><?= implode("<br>", $wprocess) ?></td>
        <td>
          <?php
          foreach ($welders_by_joint[$value['id_joint']] as $key_welders => $value_welders) {
            echo $welder[$value_welders]['welder_code'] . "<br>";
          }
          ?>
        </td>

        <td style="vertical-align: middle;">
          <?php
          if ($value['result'] == 1) {
            echo 'ACC';
          } elseif ($value['result'] == 2) {
            echo 'REJ';
          } else {
            echo '-';
          }
          ?>
        </td>
        <td>
          <?php if ($value['result'] == 2) { ?>
            <?= $value['deffect_length'] ?>
          <?php } else {
            echo "-";
          } ?>
        </td>
        <td>
          <?php if ($value['result'] == 2) { ?>
            <?= $deffect[$value['deffect_type']]['ctq_initial'] ?>
          <?php } else {
            echo "-";
          } ?>
        </td>
        <td>
          <?php if ($value['result'] == 2) { ?>
            <?= $value['datum'] ?>
          <?php } else {
            echo "-";
          } ?>
        </td>

        <td><?= $value['id_joint'] == $detail[($key - 1)]['id_joint'] ? "" : $value['inspection_cat'] ?></td>
        <td><?= $value['id_joint'] == $detail[($key - 1)]['id_joint'] ? "" : $value['remarks'] ?></td>
      </tr>
    <?php } ?>
    <tr>
      <td colspan="17">
        Note: <br>
        &nbsp;&nbsp;&nbsp;&nbsp;<?= $main["remarks_vendor"] ?>
      </td>
    </tr>
  </table>
  <table border="1px" style="margin-top: -2px !important; border-collapse: collapse !important;padding:10px !important;" width="100%">
    <tr>
      <td width="25%" style="vertical-align: top !important;">
        Tested By :
        <br>
        PCN Level II
        <br>
        <br>
        <?php if ($main['tested_by']) : ?>
          <center>
            <img src="data:image/png;base64,<?= $user[$main['tested_by']]['sign_approval'] ?>" style='width: 3cm; ' />
          </center>
        <?php else : ?>
          <div style='height:1.98cm;'>

          </div>
        <?php endif; ?>
        <br>
        <strong>Name : </strong> <?= $main['tested_by'] ? $user[$main['tested_by']]['full_name'] : "" ?>
        <br>
        <strong>Date &nbsp;&nbsp;: </strong> <?= $main['tested_date'] ? date('d-M-Y', strtotime($main['tested_date'])) : "" ?>
      </td>
      <td width="25%" style="vertical-align: top !important;">
        Review By :
        <br>
        QC Inspector
        <br>
        <br>
        <?php if ($main['qc_by']) : ?>
          <center>
            <img src="data:image/png;base64,<?= $user[$main['qc_by']]['sign_approval'] ?>" style='width: 3cm; ;' />
          </center>
        <?php else : ?>
          <div style='height:1.98cm;'>

          </div>
        <?php endif; ?>
        <br>
        <strong>Name : </strong> <?= $main['qc_by'] ? $user[$main['qc_by']]['full_name'] : "" ?>
        <br>
        <strong>Date &nbsp;&nbsp;: </strong> <?= $main['qc_date'] ? date('d-M-Y', strtotime($main['qc_date'])) : "" ?>
      </td>
      <td width="25%" style="vertical-align: top !important;">
        Review By :
        <br>
        Client Inspector
        <br>
        <br>
        <center>
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
                Date : <?= $main['client_date'] ? date('Y-m-d', strtotime($main['client_date'])) : space(15) ?>
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
                <img src="data:image/png;base64,<?= $user[$main['client_by']]['sign_approval'] ?>" style='width: 3cm;  ' />
              <?php } ?>
            <?php endif; ?>
          </div>
        </center>
        <br>
        <strong>Name : </strong> <?= $main['client_by'] ? $user[$main['client_by']]['full_name'] : "" ?>
        <br>
        <strong>Date &nbsp;&nbsp;: </strong> <?= $main['client_date'] ? date('d-M-Y', strtotime($main['client_date'])) : "" ?>
      </td>

      <td width="25%" style="vertical-align: top !important;">
        Reviewed By :
        <br>
        Third Party
        <br>
        <br>
        <div style='height:1.98cm;'>
          <?php if ($main['third_party_approval_by']) : ?>
            <img src="data:image/png;base64,<?= $user[$main['third_party_approval_by']]['sign_approval'] ?>" style='width: 3cm; height: 2cm;vertical-align: text-bottom !important;' />
          <?php endif; ?>
        </div>
        <br>
        <strong>Name : </strong> <?= @$user[$main['third_party_approval_by']]['full_name'] ?>
        <br>
        <strong>Date &nbsp;&nbsp;: </strong> <?= $main['third_party_approval_date'] ? date('d-M-Y', strtotime($main['third_party_approval_date'])) : '' ?>
      </td>
    </tr>
    <tr>
      <td colspan="4" style="border-bottom: none;">
        Legend:
      </td>
    </tr>
    <tr>
      <td style="border-right: none; border-bottom: none; border-top: none; font-weight: bold;">LI</td>
      <td style="border-left: none; border-right: none; border-bottom: none; border-top: none;">: Linear - Lack of Penetration/Lack of Fusion/Crack</td>

      <td style="border-left: none; border-right: none; border-bottom: none; border-top: none; font-weight: bold;">Acc</td>
      <td style="border-left: none; border-right: none; border-bottom: none; border-top: none;">: Accept</td>
    </tr>
    <tr>
      <td style="border-right: none; border-bottom: none; border-top: none; font-weight: bold;">R</td>
      <td style="border-left: none; border-right: none; border-bottom: none; border-top: none;">: Rounded - Slag of Inclusion/Porosity</td>

      <td style="border-left: none; border-right: none; border-bottom: none; border-top: none; font-weight: bold;">Rej</td>
      <td style="border-left: none; border-right: none; border-bottom: none; border-top: none;">: Reject</td>
    </tr>
    <tr>
      <td style="border-right: none; border-bottom: none; border-top: none;"></td>

      <td style="border-left: none; border-right: none; border-bottom: none; border-top: none;"></td>
      <td style="border-left: none; border-right: none; border-bottom: none; border-top: none; font-weight: bold;">NAD</td>
      <td style="border-left: none; border-right: none; border-bottom: none; border-top: none;">: Not Appearance Discontinuity</td>
    </tr>

  </table>

</body>

</html>