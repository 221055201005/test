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
    <tr>
      <td colspan="10" rowspan="3">
        <p style="font-size: 12px !important; font-weight: bold; text-align: center;">DYE PENETRANT INSPECTION REPORT</p>
      </td>

      <td colspan="2" style="font-weight: bold; border-left: none !important; border-right: none !important; text-align: left !important; width: 80px !important;">Report No.</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; width: 30px !important;">:</td>
      <td colspan="4" style="border-left: none !important; border-right: none !important; text-align: left !important;"><?= $main["report_no"] ?></td>
    </tr>

    <tr>
      <td colspan="2" style="font-weight: bold; border-left: none !important; border-right: none !important; ">Page No</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; ">:</td>
      <td colspan="4" style="border-left: none !important; border-right: none !important; ">1 OF 1</td>
    </tr>

    <tr>
      <td colspan="2" style="font-weight: bold; border-left: none !important; border-right: none !important; ">RFI No.</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; ">:</td>
      <td colspan="4" style="border-left: none !important; border-right: none !important; "><?= $main["rfi_no"] ?></td>
    </tr>

    <tr>
      <td colspan="3" style="font-weight: bold; border-right: none !important; width: 150px !important;">Client</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; ">:</td>
      <td colspan="6" style="border-left: none !important; "><?= $project['client'] ?></td>

      <td colspan="2" style="font-weight: bold; border-right: none !important; ">Date of Inspection</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; ">:</td>
      <td colspan="4" style="border-left: none !important; border-right: none !important; "><?= DATE("Y-m-d", strtotime($main["date_of_inspection"])) ?></td>
    </tr>

    <tr>
      <td colspan="3" style="font-weight: bold; border-right: none !important; ">Project</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; ">:</td>
      <td colspan="6" style="border-left: none !important; "><?= $project['project_name'] ?></td>

      <td colspan="2" style="font-weight: bold; border-right: none !important; ">Testing Location</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; ">:</td>
      <td colspan="4" style="border-left: none !important; border-right: none !important; "><?= $main["rfi_no"] ?></td>
    </tr>

    <tr>
      <td colspan="3" style="font-weight: bold; border-right: none !important; ">Standard / Code</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; ">:</td>
      <td colspan="6" style="border-left: none !important; "><?= $acceptance_criteria_form[$main['id_project']][$joint[$main['id_joint']]['company_id']][$main['discipline']][$main['module']][$main['type_of_module']][$joint[$main['id_joint']]['class']]['ndt']['pt']['standard_code'] ?></td>

      <td colspan="2" style="font-weight: bold; border-right: none !important; ">Job No.</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; ">:</td>
      <td colspan="4" style="border-left: none !important; border-right: none !important; "><?= $main["job_no"] ?></td>
    </tr>

    <tr>
      <td colspan="3" style="font-weight: bold; border-right: none !important; ">Acceptance Criteria</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; ">:</td>
      <td colspan="6" style="border-left: none !important; "><?= $acceptance_criteria_form[$main['id_project']][$joint[$main['id_joint']]['company_id']][$main['discipline']][$main['module']][$main['type_of_module']][$joint[$main['id_joint']]['class']]['ndt']['pt']['acceptance_criteria'] ?></td>

      <td colspan="2" style="font-weight: bold; border-right: none !important; ">Item Tested</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; ">:</td>
      <td colspan="4" style="border-left: none !important; border-right: none !important; "><?= $main["item_tested"] ?></td>
    </tr>

    <tr>
      <td colspan="3" style="font-weight: bold; border-right: none !important; ">Procedure No.</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; ">:</td>
      <td colspan="6" style="border-left: none !important; "><?= $acceptance_criteria_form[$main['id_project']][$joint[$main['id_joint']]['company_id']][$main['discipline']][$main['module']][$main['type_of_module']][$joint[$main['id_joint']]['class']]['ndt']['pt']['procedure'] ?></td>

      <td colspan="2" style="font-weight: bold; border-right: none !important; ">Grade Material</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; ">:</td>
      <td colspan="4" style="border-left: none !important; border-right: none !important; "><?= $main["grade_material"] ?></td>
    </tr>

    <tr>
      <td colspan="3" style="font-weight: bold; border-right: none !important; ">GA/ASSY/ISO Drawing No.</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; ">:</td>
      <td colspan="6" style="border-left: none !important; "><?= $master_joint[0]['drawing_no'] . ' Rev. ' . intval($master_joint[0]['transmit_gaas_rev']) ?></td>

      <td colspan="2" style="font-weight: bold; border-right: none !important; ">Delivery Condition</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; ">:</td>
      <td colspan="4" style="border-left: none !important; border-right: none !important; "><?= $main["delivery_condition"] ?></td>
    </tr>

    <tr>
      <td colspan="3" rowspan="2" style="font-weight: bold; border-right: none !important; ">Job Description</td>
      <td colspan="1" rowspan="2" style="border-left: none !important; border-right: none !important; ">:</td>
      <td colspan="6" rowspan="2" style="border-left: none !important; "><?= $main["job_description"] ?></td>

      <td colspan="2" style="font-weight: bold; border-right: none !important; ">Technician</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; ">:</td>
      <td colspan="4" style="border-left: none !important; border-right: none !important; "><?= $main["technichian"] ?></td>
    </tr>

    <tr>
      <td colspan="2" style="font-weight: bold; border-right: none !important; ">Certificate No.</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; ">:</td>
      <td colspan="4" style="border-left: none !important; border-right: none !important; "><?= $main["certificate_no"] ?></td>
    </tr>

    <!--  -->

    <tr>
      <td colspan="3" style="font-weight: bold; border-right: none !important; border-bottom: none !important; border-top: none !important;">Penetrant System</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">:</td>
      <td colspan="5" style="font-weight: bold; border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;"><input type="checkbox" style="font-size: 12px !important;" value="1" name="penetrant_system" <?= $main["penetrant_system"] == 1 ? 'checked' : '' ?>>Coloured</td>
      <td colspan="8" style="font-weight: bold; border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;"><input type="checkbox" style="font-size: 12px !important;" value="2" name="penetrant_system" <?= $main["penetrant_system"] == 2 ? 'checked' : '' ?>>Fluorescent</td>
    </tr>

    <tr>
      <td colspan="3" style="font-weight: bold; border-right: none !important; border-bottom: none !important; border-top: none !important;">Penetrant Type / Method</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">:</td>
      <td colspan="5" style="font-weight: bold; border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;"><input type="checkbox" style="font-size: 12px !important;" value="1" name="penetrant_type[]" <?= in_array(1, explode(";", $main["penetrant_type"])) ? 'checked' : '' ?>>Visible</td>
      <td colspan="3" style="font-weight: bold; border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;"><input type="checkbox" style="font-size: 12px !important;" value="2" name="penetrant_type[]" <?= in_array(2, explode(";", $main["penetrant_type"])) ? 'checked' : '' ?>>Solvent Removable</td>
      <td colspan="5" style="font-weight: bold; border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;"><input type="checkbox" style="font-size: 12px !important;" value="3" name="penetrant_type[]" <?= in_array(3, explode(";", $main["penetrant_type"])) ? 'checked' : '' ?>>Other <?= $main['penetrand_type_other'] ?></td>
    </tr>

    <tr>
      <td colspan="3" style="font-weight: bold; border-right: none !important; border-bottom: none !important; border-top: none !important;">Brand's Name / Type</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">:</td>
      <td colspan="4" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;"><?= $main["brand_name"] ?></td>

      <td colspan="1" style="font-weight: bold; border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important; width: 55px !important;">Penetrant</td>

      <td colspan="2" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">: <?= $main["penetran"] ?></td>
      <td colspan="1" style="font-weight: bold; border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">Cleaner</td>
      <td colspan="2" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">: <?= $main["cleaner"] ?></td>
      <td colspan="1" style="font-weight: bold; border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important; width: 36px !important">Developer</td>
      <td colspan="2" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">: <?= $main["developer"] ?></td>
    </tr>

    <tr>
      <td colspan="3" style="font-weight: bold; border-right: none !important; border-bottom: none !important; border-top: none !important;">Batch Number</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">:</td>
      <td colspan="13" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;"><?= $main['batch_number'] ?></td>
    </tr>

    <tr>
      <td colspan="3" style="font-weight: bold; border-right: none !important; border-bottom: none !important; border-top: none !important;">Method's Pre-Cleaning</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">:</td>
      <td colspan="13" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;"><input type="checkbox" style="font-size: 12px !important;" name="method_precleaning" <?= $main['method_precleaning'] == 1 ? 'checked' : '' ?>></td>
    </tr>

    <tr>
      <td colspan="3" style="font-weight: bold; border-right: none !important; border-bottom: none !important; border-top: none !important;">Penetrant Applicable</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">:</td>
      <td colspan="5" style="font-weight: bold; border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;"><input type="checkbox" style="font-size: 12px !important;" value="1" name="penetran_applicable" <?= $main['penetran_applicable'] == 1 ? 'checked' : '' ?>>Brush</td>
      <td colspan="8" style="font-weight: bold; border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;"><input type="checkbox" style="font-size: 12px !important;" value="2" name="penetran_applicable" <?= $main['penetran_applicable'] == 2 ? 'checked' : '' ?>>Spry</td>
    </tr>

    <tr>
      <td colspan="3" style="font-weight: bold; border-right: none !important; border-bottom: none !important; border-top: none !important;">Light Intensity</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">:</td>
      <td colspan="4" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;"><?= $main['light_intensity'] ?> Lux</td>
      <td colspan="1" style="font-weight: bold; border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">Light Sourch</td>
      <td colspan="2" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">: <?= $main['light_source'] ?></td>
      <td colspan="1" style="font-weight: bold; border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">Dwell Time</td>
      <td colspan="2" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">: <?= $main['dwell_time'] ?></td>
      <td colspan="1" style="font-weight: bold; border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">Surface Temperature</td>
      <td colspan="2" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">: <?= $main['surface_temp'] ?></td>
    </tr>

    <tr>
      <td colspan="3" style="font-weight: bold; border-right: none !important; border-bottom: none !important; border-top: none !important;">Methode Removing Excess Penetrant</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;"></td>
      <td colspan="13" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">:<?= $main['method_remove_excess_penetran'] ?></td>
    </tr>

    <tr>
      <td colspan="3" style="font-weight: bold; border-right: none !important; border-bottom: none !important; border-top: none !important;">Drying After Remove Excess Penetrant</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;"></td>
      <td colspan="4" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">:</td>
      <td colspan="1" style="font-weight: bold; border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">Developer App</td>
      <td colspan="3" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">: <input type="checkbox" style="font-size: 12px !important;" name="developer_app" <?= $main['developer_app'] == 1 ? 'checked' : '' ?> value="1">Spray</td>
      <td colspan="5" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;"><b>Developing Time</b> : <?= $main['developing_time'] ?></td>
    </tr>

    <tr>
      <td colspan="3" style="font-weight: bold; border-right: none !important; border-bottom: none !important; border-top: none !important;">Batch No. Of</td>
      <td colspan="1" style="font-weight: bold; border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">Penetrant</td>
      <td colspan="4" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">: <?= $main['batch_no_of_penetrant'] ?></td>
      <td colspan="1" style="font-weight: bold; border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">Cleaner</td>
      <td colspan="3" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">: <?= $main['batch_no_of_cleaner'] ?></td>
      <td colspan="1" style="font-weight: bold; border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">Developer</td>
      <td colspan="4" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;"> : <?= $main['batch_no_of_developer'] ?></td>
    </tr>

    <!-- ========================================== -->

    <tr>
      <td colspan="3" style="font-weight: bold; border-right: none !important; border-bottom: none !important;">Surface Preparation / Cleaning</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; border-bottom: none !important;">:</td>
      <td colspan="3" style="border-left: none !important; border-right: none !important; border-bottom: none !important;">&nbsp;&nbsp;
        <input type="checkbox" style="font-size: 12px !important;" name="surface_preparation[]" value="1" <?= in_array(1, explode(";", $main['surface_preparation'])) ? 'checked' : '' ?>>&nbsp;&nbsp;As Welded
      </td>

      <td colspan="3" style="border-left: none !important; border-right: none !important; border-bottom: none !important;">&nbsp;&nbsp;
        <input type="checkbox" style="font-size: 12px !important;" name="surface_preparation[]" value="2" <?= in_array(2, explode(";", $main['surface_preparation'])) ? 'checked' : '' ?>>&nbsp;&nbsp;Machining
      </td>
      <td colspan="3" style="border-left: none !important; border-right: none !important; border-bottom: none !important;">&nbsp;&nbsp;
        <input type="checkbox" style="font-size: 12px !important;" name="surface_preparation[]" value="3" <?= in_array(3, explode(";", $main['surface_preparation'])) ? 'checked' : '' ?>>&nbsp;&nbsp;Grinding
      </td>
      <td colspan="4" style="border-left: none !important; border-right: none !important; border-bottom: none !important;"></td>
    </tr>

    <tr>
      <td colspan="3" style="font-weight: bold; border-right: none !important; border-top: none !important; border-bottom: none !important;">Time of Examination</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; border-top: none !important; border-bottom: none !important;">:</td>
      <td colspan="3" style="border-left: none !important; border-right: none !important; border-top: none !important; border-bottom: none !important;">&nbsp;&nbsp;
        <input type="checkbox" style="font-size: 12px !important;" name="time_of_examination" value="1" <?= $main['time_of_examination'] == '1' ? 'checked' : '' ?>>&nbsp;&nbsp;After Welding
      </td>

      <td colspan="3" style="border-left: none !important; border-right: none !important; border-top: none !important; border-bottom: none !important;">&nbsp;&nbsp;
        <input type="checkbox" style="font-size: 12px !important;" name="time_of_examination" value="2" <?= $main['time_of_examination'] == '2' ? 'checked' : '' ?>>&nbsp;&nbsp;After Hydro-Test
      </td>
      <td colspan="3" style="border-left: none !important; border-right: none !important; border-top: none !important; border-bottom: none !important;">&nbsp;&nbsp;
        <input type="checkbox" style="font-size: 12px !important;" name="time_of_examination" value="3" <?= $main['time_of_examination'] == '3' ? 'checked' : '' ?>>&nbsp;&nbsp;After PWHT
      </td>
      <td colspan="4" style="border-left: none !important; border-right: none !important; border-top: none !important; border-bottom: none !important;">&nbsp;&nbsp;
        <input type="checkbox" style="font-size: 12px !important;" name="time_of_examination" value="4" <?= $main['time_of_examination'] == '4' ? 'checked' : '' ?>>&nbsp;&nbsp;Others&nbsp;&nbsp;
      </td>
    </tr>

    <tr>
      <td colspan="3" style="font-weight: bold; border-right: none !important; border-bottom: none !important; border-top: none !important;">Scope Examination</td>
      <td colspan="1" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">:</td>
      <td colspan="3" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">&nbsp;&nbsp;
        <input type="checkbox" style="font-size: 12px !important;" name="scope_examination" <?= $main['scope_examination'] == '1' ? 'checked' : '' ?> value="1">&nbsp;&nbsp;Base Metal
      </td>

      <td colspan="3" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">&nbsp;&nbsp;
        <input type="checkbox" style="font-size: 12px !important;" name="scope_examination" <?= $main['scope_examination'] == '2' ? 'checked' : '' ?> value="2">&nbsp;&nbsp;Edge Prep
      </td>
      <td colspan="3" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;">&nbsp;&nbsp;
        <input type="checkbox" style="font-size: 12px !important;" name="scope_examination" <?= $main['scope_examination'] == '3' ? 'checked' : '' ?> value="3">&nbsp;&nbsp;Back Chipping
      </td>
      <td colspan="4" style="border-left: none !important; border-right: none !important; border-bottom: none !important; border-top: none !important;"></td>
    </tr>

    <tr>
      <td colspan="4" style="border-right: none !important; border-top: none !important;"></td>
      <td colspan="3" style="border-left: none !important; border-right: none !important; border-top: none !important;">&nbsp;&nbsp;
        <input type="checkbox" style="font-size: 12px !important;" name="scope_examination" <?= $main['scope_examination'] == '4' ? 'checked' : '' ?> value="4">&nbsp;&nbsp;Weld Part
      </td>
      <td colspan="3" style="border-left: none !important; border-right: none !important; border-top: none !important;">&nbsp;&nbsp;
        <input type="checkbox" style="font-size: 12px !important;" name="scope_examination" <?= $main['scope_examination'] == '5' ? 'checked' : '' ?> value="5">&nbsp;&nbsp;Repair Weld
      </td>

      <td colspan="7" style="border-left: none !important; border-right: none !important; border-top: none !important;">&nbsp;&nbsp;
        <input type="checkbox" style="font-size: 12px !important;" name="scope_examination" <?= $main['scope_examination'] == '6' ? 'checked' : '' ?> value="6">&nbsp;&nbsp;Others&nbsp;&nbsp;
      </td>
    </tr>

    <tr>
      <td rowspan="2" style="text-align:center;">S/N</td>
      <td rowspan="2" style="text-align:center;">Weld Map Dwg / Line & Spool No</td>
      <td rowspan="2" style="text-align:center;">Joint No</td>
      <td rowspan="2" style="text-align:center;">Joint Type</td>

      <td rowspan="2" style="text-align:center;">Size/Dia</td>

      <td rowspan="2" style="text-align:center;">Sch</td>
      <td rowspan="2" style="text-align:center;">Thk (mm)</td>
      <td rowspan="2" style="text-align:center;">Total Length (mm)</td>
      <td rowspan="2" style="text-align:center;">Tested Length (mm)</td>
      <td rowspan="2" style="text-align:center;">Welding Process</td>
      <td rowspan="2" style="text-align:center;">Welder ID</td>
      <td rowspan="2" style="text-align:center;">Result</td>
      <td colspan="3" style="text-align:center;" rowspan="1">Type of Discontinuites</td>
      <td rowspan="2" style="text-align:center;">Inspection Category</td>
      <td rowspan="2" style="text-align:center;">Remarks</td>
    </tr>

    <tr>
      <td rowspan="1" style="text-align:center;">Deffect Length (mm)</td>
      <td rowspan="1" style="text-align:center; width: 50px !important">Deffect Type</td>
      <td rowspan="1" style="text-align:center;">Distance from Datum (mm)</td>
    </tr>

    <?php
    $cek = [];
    foreach ($detail as $key => $value) {
    ?>
      <?php
      if (in_array($value['id_joint'], $cek)) {
        continue;
      }
      $cek[] = $value['id_joint'];
      ?>
      <tr style="text-align: center; vertical-align: middle;">
        <td><?= $key + 1 ?></td>
        <td><strong style="font-weight: normal; <?= $value['id_joint'] == $detail[($key - 1)]['id_joint'] ? 'color: white' : '' ?>"><?= $joint[$value['id_joint']]['drawing_wm'] ?></strong></td>
        <td><?= $value['id_joint'] == $detail[($key - 1)]['id_joint'] ? "" : $joint[$value['id_joint']]['joint_no'] ?></td>
        <td><?= $value['id_joint'] == $detail[($key - 1)]['id_joint'] ? "" : $mas_weld_type[$joint[$value['id_joint']]['weld_type']] ?></td>
        <td><?= $value['id_joint'] == $detail[($key - 1)]['id_joint'] ? "" : $joint[$value['id_joint']]['diameter'] ?></td>
        <td><?= $value['id_joint'] == $detail[($key - 1)]['id_joint'] ? "" : $joint[$value['id_joint']]['sch'] ?></td>
        <td><?= $value['id_joint'] == $detail[($key - 1)]['id_joint'] ? "" : $joint[$value['id_joint']]['thickness'] ?></td>
        <td><?= $value['id_joint'] == $detail[($key - 1)]['id_joint'] ? "" : $joint[$value['id_joint']]['weld_length'] ?></td>
        <td><?= $value['tested_length'] ?></td>
        <td>
          <?php
          $wp_rh    = explode(";", $joint[$value["id_joint"]]["weld_process_rh"]);
          $wp_fc    = explode(";", $joint[$value["id_joint"]]["weld_process_fc"]);
          $wprocess = array_unique(array_merge($wp_rh, $wp_fc));
          ?>
          <?= implode("<br>", $wprocess) ?>
        </td>
        <td>
          <?php
          $list_welder  = [];
          if (isset($welder_joint[$value['id_joint']])) : ?>
            <?php foreach ($welder_joint[$value['id_joint']] as $v) : ?>
              <?php $list_welder[] = $welder[$v]['welder_code']; ?>
            <?php endforeach; ?>
          <?php endif; ?>
          <?= implode(", ", $list_welder) ?>
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
      <td colspan="17" style="height: 10px !important;">
        Note:
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
            <img src="data:image/png;base64,<?= $user[$main['tested_by']]['sign_approval'] ?>" style='width: 3cm; height: 2cm' />
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
            <img src="data:image/png;base64,<?= $user[$main['qc_by']]['sign_approval'] ?>" style='width: 3cm; height: 2cm;' />
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
                    <td><input type="checkbox" style="margin-bottom: 8px" <?= $checked_type == 'review' ? 'checked' : '' ?>></td>
                  </tr>
                  <tr>
                    <td width="40%" class="valign_middle">Witness</td>
                    <td><input type="checkbox" style="margin-bottom: 8px" <?= $checked_type == 'hold' or $checked_type == 1 ? 'witness' : '' ?>></td>
                  </tr>
                  <tr>
                    <td width="40%" class="valign_middle">Inspect</td>
                    <td><input type="checkbox" style="margin-bottom: 8px" <?= $checked_type == 'hold' ? 'checked' : '' ?>></td>
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
                <img src="data:image/png;base64,<?= $user[$main['client_by']]['sign_approval'] ?>" style='width: 3.5cm;vertical-align: text-bottom !important;' />
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