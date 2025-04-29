<?php 
  error_reporting(0);
  $main_data      = $list_detail[0];
  if($discipline==1){
    $standard_code  = '-';
  } else {
    $standard_code  = 'DNV GL-CG-0051 / BS EN ISO 17640';
  }

  //test_var($list_detail[0]);

?>
<!DOCTYPE html>
<html>
<head>
  <title><?= $project[$list_detail[0]['project_code']]['project_ref'].'-OCP-SMO-'.strtoupper($type_of_module_list[$list_detail[0]['type_of_module']]['code']).'-'.strtoupper($discipline_list[$list_detail[0]['discipline']]['initial']).'-NDT-'.$initial.'-'.str_pad($list_detail[0]['report_number'],4,0, STR_PAD_LEFT) ?></title>
<style>
.valign-middle {
  vertical-align: middle !important;
}

.bg-grey {
  background-color: #ebebeb;
}

.ball-no-bottom {
  border-bottom: none !important;
}

.column-header {
  font-weight: bold;
}

.text-center {
  text-align: center;
}

body {
  top: 13.6cm;
  left: 0cm;
  right: 0cm;
  bottom: 6cm;

  margin-top: 13.6cm;
  margin-left: 0cm;
  margin-right: 0cm;
  margin-bottom: 6cm;

  font-family: "helvetica";
  font-size: 50% !important;
}

header {
  position: fixed;
  top: 0cm;
  left: 0cm;
  right: 0cm;
  height: 5cm;

}

footer {
  position: fixed;
  top: 23.15cm;
  left: 0cm;
  right: 0cm;
  height: 10cm;

  margin-top: 0cm;
  margin-left: 0cm;
  margin-right: 0cm;
  margin-bottom: 0cm;
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
  word-wrap: break-word;
}

table>thead>tr>td,
table>tbody>tr>td {
  vertical-align: top;
}

.table-bordered {
  border: 1px solid #dee2e6
}

.table-bordered td,
.table-bordered th {
  border: 1px solid #dee2e6
}

.table-bordered thead td,
.table-bordered thead th {
  border-bottom-width: 2px
}

.table {
  width: 100%;
  margin-bottom: 1rem;
  color: #212529
}

.table td,
.table th {
  padding: .20rem;
  vertical-align: top;
  border-top: 1px solid #dee2e6
}

.table thead th {
  vertical-align: bottom;
  border-bottom: 2px solid #dee2e6
}

.table tbody+tbody {
  border-top: 2px solid #dee2e6
}

.table-sm td,
.table-sm th {
  padding: .3rem
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
  word-wrap: break-word;
}

.tab {
  display: inline-block;
  width: 60px;
}

.tab2 {
  display: inline-block;
  width: 120px;
}

hr {
  border-top: 0px !important;
}

label {
  display: block;
  padding-left: 2;
  text-indent: -1;
}

input {
  width: 5px;
  height: 5px;
  padding: 0;
  margin: 0;
  vertical-align: bottom;
  position: relative;
  top: 0px;
  *overflow: hidden;
}

.checkmark {
  width: 100px !important;
}
</style>


</head>
<body>
  <header>
    <table border="1px" style="border-collapse: collapse;" width="100%">
      <tr>
        <td colspan="19" class="text-center">
          <img src="img/header_report.png" style="width: 460px">
        </td>
      </tr>
      <tr>
        <td colspan="9" rowspan="2" class="text-center valign-middle">
          <span style="font-size: 21px;"><strong>ULTRASONIC EXAMINATION REPORT</strong></span>
        </td>
        <td class="valign-middle" colspan="2"><strong>REPORT NO.</strong></td>
        <td class="valign-middle" colspan="8"><?= $project[$list_detail[0]['project_code']]['project_ref'].'-OCP-SMO-'.strtoupper($type_of_module_list[$list_detail[0]['type_of_module']]['code']).'-'.strtoupper($discipline_list[$list_detail[0]['discipline']]['initial']).'-NDT-'.$initial.'-'.str_pad($list_detail[0]['report_number'],4,0, STR_PAD_LEFT) ?></td>
      </tr>
      <tr>
        <td class="valign-middle" colspan="2"><strong>DATE TESTED</strong></td>
        <td class="valign-middle" colspan="8"><?= DATE('d F Y', strtotime($list[0]['date_of_inspection'])); ?></strong>
        </td>
      </tr>
      <tr>
        <td class="valign-middle" colspan="2"><strong>CLIENT</strong></td>
        <td class="valign-middle" colspan="7"><?= $project[$main_data['project_code']]['client'] ?>
        </td>
        <td class="valign-middle" colspan="2"><strong>PAGE NO.</strong></td>
        <td class="valign-middle" colspan="8">
        </td>
      </tr>
      <tr>
        <td class="valign-middle" colspan="2"><strong>PROJECT</strong></td>
        <td class="valign-middle" colspan="7"><?= $project[$main_data['project_code']]['project_name'] ?>
        </td>
        <td class="valign-middle" colspan="2"><strong>RFI NO.</strong></td>
        <td class="valign-middle" colspan="8"><?= $project[$list_detail[0]['project_code']]['project_ref'].'-OCP-SMO-'.strtoupper($type_of_module_list[$list_detail[0]['type_of_module']]['code']).'-'.strtoupper($discipline_list[$list_detail[0]['discipline']]['initial']).'-NDT-RFI-'.$initial.'-'.str_pad($list_detail[0]['ndt_rfi'],4,0, STR_PAD_LEFT) ?></td>
      </tr>

      <tr>
        <td class="valign-middle" colspan="2"><strong>Standard / Code</strong></td>
        <td class="valign-middle" colspan="7"><?= $standard_code ?></td>
        <td class="valign-middle  text-nowrap" colspan="2"><strong>TESTING LOCATION</strong></td>
        <td class="valign-middle" colspan="8">

          <?php foreach ($master_location as $key => $value_loc) { ?>

          <?php if ($value_loc['id'] == $report_detail['testing_location']): ?>
          <?= $value_loc['location_name'] ?>
          <?php endif; ?>
          <?php } ?>

        </td>
      </tr>

      <tr>
        <td class="valign-middle" colspan="2" rowspan="2"><strong>Acceptance Criteria</strong></td>
        <td class="valign-middle" colspan="7">
          <?= 
            $list_detail[0]['class']==1 ?
              'ISO 5817 LEVEL B' :
              'ISO 5817 LEVEL C'
          ?>
        </td>
        <td class="valign-middle" colspan="2" rowspan="2"><strong>JOB NO.</strong></td>
        <td class="valign-middle" colspan="8" rowspan="2"><strong><?= @$report_detail['job_no'] ?></td>
      </tr>

      <tr>
        <td class="valign-middle" colspan="7">
          <?= 
            $list_detail[0]['class']==1 ?
            'ISO 11666 ACCEPTANCE LEVEL 2' :
            'ISO 11666 ACCEPTANCE LEVEL 3'
          ?>
        </td>
      </tr>

      <tr>
        <td class="valign-middle" colspan="2"><strong>Procedure No.</strong></td>
        <td class="valign-middle" colspan="7">SCM-SOF-SMOE-23-PR-0008</td>
        <td class="valign-middle" colspan="2"><strong>ITEM TESTED.</strong></td>
        <td class="valign-middle" colspan="8"><?= @$report_detail['item_tested'] ?></td>
      </tr>
      <tr>
        <td class="valign-middle text-nowrap" colspan="2"><strong>GA/ASSY/ISOMETRIC Drawing No.
          </strong>
        </td>
        <td class="valign-middle" colspan="4"><?= $list[0]['drawing_no'] ?></td>
        <td class="valign-middle"><strong>Rev.</strong></td>
        <td class="valign-middle" colspan="2"></td>
        <td class="valign-middle" colspan="2"><strong>PWHT Status</strong></td>
        <td class="valign-middle" colspan="8"><?= @$report_detail['pwht_status'] ?></td>
      </tr>
      <tr>
        <td class="valign-middle" rowspan="2" colspan="2">
          <strong>Job Description</strong>
        </td>
        <td class="valign-middle" rowspan="2" colspan="7">
          <?= @$report_detail['job_description'] ?>
        </td>
        <td class="valign-middle" colspan="2"><strong>Testing Personnel</strong></td>
        <td colspan="8"><?= @$report_detail['testing_personnel'] ?></td>
      </tr>
      <tr>
        <td colspan="2" class="valign-middle"><strong>Certificate No.</strong></td>
        <td colspan="8"><?= @$report_detail['certificate_no'] ?></td>
      </tr>
      <tr>
        <td colspan="19" class="bg-grey"><strong>SPECIMEN DATA : </strong></td>
      </tr>
      <tr>
        <td class="valign-middle ball-no-bottom" colspan="3"><strong>GRADE MATERIAL</strong></td>
        <td>:</td>
        <td colspan="15"><?= @$report_detail['grade_material'] ?></td>
      </tr>
      <tr>
        <td class="valign-middle text-nowrap" colspan="3"><strong>DELIVERY CONDITION</strong></td>
        <td>:</td>
        <td colspan="15"><?= @$report_detail['delivery_condition'] ?></td>
      </tr>
      <tr>
        <td class="valign-middle" colspan="3"><strong>Surface Condition</strong></td>
        <td>:</td>
        <td colspan="15"><?= @$report_detail['surface_condition'] ?></td>
      </tr>
      <tr>
        <td class="valign-middle" colspan="3"><strong>HOLDING TIME</strong></td>
        <td>:</td>
        <td colspan="15"><?= @$report_detail['holding_time'] ?></td>
      </tr>

      <tr>
        <td colspan="19" class="bg-grey"><strong>TEST EQUIPMENT AND CALIBRATION DETAILS : </strong></td>
      </tr>
      <tr style="height: 1.5cm">
        <td class="valign-middle text-center"><strong>Probes</strong></td>
        <td class="valign-middle text-center text-nowrap"><strong>Serial No.</strong></td>
        <td class="valign-middle text-center"><strong>Type</strong></td>
        <td class="valign-middle text-center"><strong>Size (mm)</strong></td>
        <td class="valign-middle text-center"><strong>Frequency</strong></td>
        <td class="valign-middle text-center" colspan="4"><strong>Reference (db)</strong></td>
        <td class="valign-middle text-center"><strong>TR Loss(db)</strong></td>
        <td class="valign-middle text-center" colspan="2"><strong>SCAN</strong></td>
        <td class="valign-middle text-center" colspan="7"><strong>Range /F.S.L</strong></td>
      </tr>

      <tr style="height: 1.5cm">
        <td class="valign-middle text-center">0&deg;</td>
        <td class="valign-middle text-center"><?= @$report_detail['serial_no_0'] ?>
        </td>
        <td class="valign-middle text-center"><?= @$report_detail['type_0'] ?></td>
        <td class="valign-middle text-center"><?= @$report_detail['size_0'] ?></td>
        <td class="valign-middle text-center"><?= @$report_detail['frequency_0'] ?>
        </td>
        <td class="valign-middle text-center" colspan="4"><?= @$report_detail['reference_0'] ?>
        </td>
        <td class="valign-middle text-center"><?= @$report_detail['tr_loss_0'] ?>
        </td>
        <td class="valign-middle text-center" colspan="2"><?= @$report_detail['scan_0'] ?>
        </td>
        <td class="valign-middle text-center" colspan="7"><?= @$report_detail['range_fsl_0'] ?>
        </td>
      </tr>

      <tr style="height: 1.5cm">
        <td class="valign-middle text-center">45&deg;</td>
        <td class="valign-middle text-center"><?= @$report_detail['serial_no_45'] ?>
        </td>
        <td class="valign-middle text-center"><?= @$report_detail['type_45'] ?></td>
        <td class="valign-middle text-center"><?= @$report_detail['size_45'] ?></td>
        <td class="valign-middle text-center"><?= @$report_detail['frequency_45'] ?>
        </td>
        <td class="valign-middle text-center" colspan="4"><?= @$report_detail['reference_45'] ?>
        </td>
        <td class="valign-middle text-center"><?= @$report_detail['tr_loss_45'] ?>
        </td>
        <td class="valign-middle text-center" colspan="2"><?= @$report_detail['scan_45'] ?>
        </td>
        <td class="valign-middle text-center" colspan="7"><?= @$report_detail['range_fsl_45'] ?>
        </td>
      </tr>

      <tr style="height: 1.5cm">
        <td class="valign-middle text-center">60&deg;</td>
        <td class="valign-middle text-center"><?= @$report_detail['serial_no_60'] ?>
        </td>
        <td class="valign-middle text-center"><?= @$report_detail['type_60'] ?></td>
        <td class="valign-middle text-center"><?= @$report_detail['size_60'] ?></td>
        <td class="valign-middle text-center"><?= @$report_detail['frequency_60'] ?>
        </td>
        <td class="valign-middle text-center" colspan="4"><?= @$report_detail['reference_60'] ?>
        </td>
        <td class="valign-middle text-center"><?= @$report_detail['tr_loss_60'] ?>
        </td>
        <td class="valign-middle text-center" colspan="2"><?= @$report_detail['scan_60'] ?>
        </td>
        <td class="valign-middle text-center" colspan="7"><?= @$report_detail['range_fsl_60'] ?>
        </td>
      </tr>

      <tr style="height: 1.5cm">
        <td class="valign-middle text-center">70&deg;</td>
        <td class="valign-middle text-center"><?= @$report_detail['serial_no_70'] ?>
        </td>
        <td class="valign-middle text-center"><?= @$report_detail['type_70'] ?></td>
        <td class="valign-middle text-center"><?= @$report_detail['size_70'] ?></td>
        <td class="valign-middle text-center"><?= @$report_detail['frequency_70'] ?>
        </td>
        <td class="valign-middle text-center" colspan="4"><?= @$report_detail['reference_70'] ?>
        </td>
        <td class="valign-middle text-center"><?= @$report_detail['tr_loss_70'] ?>
        </td>
        <td class="valign-middle text-center" colspan="2"><?= @$report_detail['scan_70'] ?>
        </td>
        <td class="valign-middle text-center" colspan="7"><?= @$report_detail['range_fsl_70'] ?>
        </td>
      </tr>


      <tr>
        <td colspan="3" class="valign-middle"><strong>COUPLANT</strong></td>
        <td class="text-right">:</td>
        <td colspan="6"><?= @$report_detail['couplant'] ?>
        </td>
        <td class="valign-middle"><strong>Brand</strong></td>
        <td class="text-left">:</td>
        <td colspan="7"><?= @$report_detail['brand'] ?></td>
      </tr>
      <tr>
        <td colspan="3" class="valign-middle"><strong>CALIBRATION BLOCK </strong></td>
        <td class="text-right">:</td>
        <td colspan="6"><?= @$report_detail['calibration_block'] ?></td>
        <td class="valign-middle"><strong>Model</strong></td>
        <td class="text-left">:</td>
        <td colspan="7"><?= @$report_detail['model'] ?></td>
      </tr>
      <tr>
        <td colspan="3" class="valign-middle"><strong>REFERENCE BLOCK S/N</strong></td>
        <td class="text-right">:</td>
        <td colspan="6"><?= @$report_detail['reference_block_sn'] ?></td>
        <td class="valign-middle"><strong>Serial No.</strong></td>
        <td class="text-left">:</td>
        <td colspan="7"><?= @$report_detail['reference_serial_no'] ?></td>
      </tr>

      <tr>
        <td colspan="3" class="valign-middle"><strong>Calibration Block Thickness </strong></td>
        <td class="text-right">:</td>
        <td colspan="15"><?= @$report_detail['calibration_block_thickness'] ?>
        </td>
      </tr>
      <tr>
        <td colspan="3"><strong>SENSITIVITY</strong></td>
        <td class="text-right">:</td>
        <td colspan="15"><?= @$report_detail['sensitivity'] ?></td>
      </tr>
      <tr>
        <td colspan="3" class="valign-middle"><strong>Evaluation Level</strong></td>
        <td class="text-right">:</td>
        <td colspan="15"><?= @$report_detail['evaluation_level'] ?></td>
      </tr>
      <tr>
        <td colspan="3" class="valign-middle"><strong>Recording Level</strong></td>
        <td class="text-right">:</td>
        <td colspan="15"><?= @$report_detail['recording_level'] ?></td>
      </tr>
      <tr>
        <td colspan="3" class="valign-middle"><strong>Scanning Technique</strong></td>
        <td class="text-right">:</td>
        <td colspan="15"><?= @$report_detail['scanning_technique'] ?></td>
      </tr>
    </table>  
  </header>
  <br>
  <footer>
    <table border="1px" style="border-collapse: collapse;" width="100%">
    <tr>
      <th>Tested By <br>NDT Level II</th>
      <th>QC Inspector</th>
      <th>Client Inspector</th>
      <th>3rd Party</th>
    </tr>
    <tr>
      <td style="height: 60px; vertical-align: middle; text-align: center" width="25%">
        <img style="max-width: 3.5cm" src="data:image/png;base64, <?= $user_list[$list_detail[0]['created_by']]['sign_approval'] ?>">
      </td>
      <td style="height: 60px; vertical-align: middle; text-align: center" width="25%">
        <img style="max-width: 3.5cm" src="data:image/png;base64, <?= $user_list[$list_detail[0]['smoe_approval_by']]['sign_approval'] ?>">
      </td>
      <td style="height: 60px; vertical-align: middle; text-align: center" width="25%">
        <img style="max-width: 3.5cm" src="data:image/png;base64, <?= $user_list[$list_detail[0]['client_approval_by']]['sign_approval'] ?>">
      </td>
      <td style="height: 60px; vertical-align: middle; text-align: center" width="25%">-</td>
    </tr>
    <tr>
      <td> Name / Signature : <?= $user_list[$list_detail[0]['created_by']]['full_name'] ?>
        <br> Date: <?= DATE('d F, Y h:i A',strtotime($list_detail[0]['created_date'])) ?>
      </td>
      
      <td> Name / Signature : <?= $user_list[$list_detail[0]['smoe_approval_by']]['full_name'] ?>
        <br> Date: <?= DATE('d F, Y h:i A',strtotime($list_detail[0]['smoe_approval_date'])) ?>
      </td>
      
      <td> Name / Signature : <?= $user_list[$list_detail[0]['client_approval_by']]['full_name'] ?>
        <br> Date: <?= DATE('d F, Y h:i A',strtotime($list_detail[0]['client_approval_date'])) ?>
      </td>
      
      <td> Name / Signature : -
        <br> Date: -
      </td>
    </tr>
  </table>
  </footer>
  <br>
  <table class="table table-bordered" style="border-collapse : collapse" id="table_report_ut">
  <thead>
  <tr>
    <td class="valign-middle text-center column-header" rowspan="2">S/N</td>
    <td class="valign-middle text-center column-header" rowspan="2">Weld Map Dwg / Line & Spool No.
    </td>
    <td class="valign-middle text-center column-header" rowspan="2">Joint No.</td>
    <td class="valign-middle text-center column-header" rowspan="2">Joint Type</td>
    <td class="valign-middle text-center column-header" rowspan="2">Total Length (mm)</td>
    <td class="valign-middle text-center column-header" rowspan="2">Tested Length (mm)</td>
    
    <td class="valign-middle text-center column-header" rowspan="2" style="width: 30px">
      <?php if($list_detail[0]['discipline']==1){
        echo "Size<br>(mm)";
      } else {
        echo "Dia<br>(inch)";
      } ?>
    </td>
    
    <td class="valign-middle text-center column-header" rowspan="2">Sch</td>
    <td class="valign-middle text-center column-header" rowspan="2">tdk (mm)</td>
    <td class="valign-middle text-center column-header" rowspan="2">Welder ID</td>
    <td class="valign-middle text-center column-header" colspan="2" rowspan="2" style="width: 30px">Welding Process</td>
    <td class="valign-middle text-center column-header" colspan="3">Defect Evaluation </td>
    <td class="valign-middle text-center column-header" rowspan="2">Result </td>
    <td class="valign-middle text-center column-header" rowspan="2">Inspection Category </td>
    <td class="valign-middle text-center column-header" colspan="2" rowspan="2">Inspection Remarks </td>
  </tr>
  <tr>
    <td class="valign-middle text-center column-header">Defect Length (mm) </td>
    <td class="valign-middle text-center column-header">Defect Depth (mm) </td>
    <td class="valign-middle text-center column-header">Defect Type </td>
  </tr>
  </thead>

  <?php $no = 1; foreach ($list_detail as $value): ?>
  <?php //$no = 1; foreach (range(1,30) as $value): ?>
  <?php //test_var($value); ?>

  <tr class="text-center">
    <td class="valign-middle"><?= $no++ ?></td>
    <td class="valign-middle"><?= $value['drawing_wm'] ?></td>
    <td class="valign-middle">
      <?= $value['joint_no'].$value['revision_category'].$value['revision'] ?>
    </td>
    <td class="valign-middle"><?= $joint_type[$value['joint_type']]['joint_type'] ?></td>
    <td class="valign-middle"><?= $value['total_length'] ?></td>
    <td class="valign-middle"><?= $value['tested_length'] ?></td>
    <td class="valign-middle"><?= $value['diameter'] ?></td>
    <td class="valign-middle"><?= $value['sch'] ? $value['sch'] : '-' ?></td>
    <td class="valign-middle"><?= $value['thk'] ? $value['thk'] : '-' ?></td>
    <td class="valign-middle">

      <?php if (isset($visual[$value['id_visual']]['welder_ref_rh'])): ?>
      <?php 
        $welder_rh_list = explode(";",$visual[$value['id_visual']]['welder_ref_rh']);  
      ?>

      <?php foreach ($welder_rh_list as $v): ?>
      <?= $weld_name[$v] ?>
      <br>

      <?php endforeach; ?>

      <?php endif; ?>

    </td>


    <td class="valign-middle" colspan="2">

      <?php if ($visual[$value['id_visual']]['process_gtaw_rh'] == 1): ?>
      GTAW
      <br>
      <?php endif; ?>

      <?php if ($visual[$value['id_visual']]['process_gmaw_rh'] == 1): ?>
      GMAW
      <br>
      <?php endif; ?>
      <?php if ($visual[$value['id_visual']]['process_smaw_rh'] == 1): ?>
      SMAW
      <br>
      <?php endif; ?>
      <?php if ($visual[$value['id_visual']]['process_fcaw_rh'] == 1): ?>
      FCAW
      <br>
      <?php endif; ?>
      <?php if ($visual[$value['id_visual']]['process_saw_rh'] == 1): ?>
      SAW
      <br>
      <?php endif; ?>

    </td>

    <td class="valign-middle"><?= $value['deffect_length'] ?></td>
    <td class="valign-middle">N/A</td>
    <td class="valign-middle"><?= $ctq_initial[$value['id_deffect']] ?></td>

    <td class="valign-middle">
      <?php if ($value['result'] == 3): ?>
      ACC
      <?php elseif($value['result'] == 2): ?>
      REJ
      <?php endif; ?>
    </td>
    <td class="valign-middle"><?= $class[$value['class']] ?></td>
    <td colspan="2" class="valign-middle"><?= $value['remarks'] ?></td>

  </tr>
  <?php endforeach; ?>
  <tr>
    <td class="valign-middle" class="valign-middle" colspan="2" style="height: 30px">Note :</td>
    <td class="valign-middle" colspan="17">
      <?= @$report_detail['note'] ?>
    </td>
  </tr>
</table>
<br>
</body>
</html>