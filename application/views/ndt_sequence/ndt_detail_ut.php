<?php 
  
  $main_data      = $list_detail[0];
  // test_var($main_data);
  if($discipline==1){
    $standard_code  = '-';
  } else {
    $standard_code  = 'DNV GL-CG-0051 / BS EN ISO 17640';
  }
  
?>

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
</style>
<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <form method="POST" action="<?= base_url('ndt/insert_ndt_rfi/').$initial ?>">
              <input type="hidden" name="submission_id" value="<?= $list[0]['submission_id'] ?>">
              <input type="hidden" name="drawing_no" value="<?= $list[0]['drawing_no'] ?>">
              <input type="hidden" name="report_number" value="<?= $list[0]['report_number'] ?>">
              <div class="row">
                <div class="col-md-12">
                  <h6 class="card-title"> NDT - <strong>Ultrasonic</strong></h6>
                  <hr>
                </div>
                <div class="col-md-12 ">
                  <div class="table-responsive" id="content">
                    <table class="table table-bordered table-sm" id="table_report_ut">
                      <tr>
                        <td colspan="18" class="text-center">
                          <img src="<?= base_url() ?>img/header_report.png">
                        </td>
                      </tr>
                      <tr>
                        <td colspan="9" rowspan="2" class="text-center valign-middle">
                          <span style="font-size: 18px;"><strong>ULTRASONIC EXAMINATION REPORT</strong></span>
                        </td>
                        <td class="valign-middle" colspan="2"><strong>REPORT NO.</strong></td>
                        <td class="valign-middle" colspan="8"><strong><input type="text"
                              value="<?= $project[$list_detail[0]['project_code']]['project_ref'].'-OCP-SMO-'.strtoupper($type_of_module_list[$list_detail[0]['type_of_module']]['code']).'-'.strtoupper($discipline_list[$list_detail[0]['discipline']]['initial']).'-NDT-'.$initial.'-'.str_pad($list_detail[0]['report_number'],4,0, STR_PAD_LEFT) ?>" class="form-control" disabled></strong></td>
                      </tr>
                      <tr>
                        <td class="valign-middle" colspan="2"><strong>DATE TESTED</strong></td>
                        <td class="valign-middle" colspan="8">
                          <strong><input type="text"
                              value="<?= DATE('d F Y', strtotime($list[0]['date_of_inspection'])); ?>"
                              class="form-control" disabled></strong>
                        </td>
                      </tr>
                      <tr>
                        <td class="valign-middle" colspan="2"><strong>CLIENT</strong></td>
                        <td class="valign-middle" colspan="7"><strong><input type="text"
                              value="<?= $project[$main_data['project_code']]['client'] ?>" class="form-control"
                              disabled></strong>
                        </td>
                        <td class="valign-middle" colspan="2"><strong>PAGE NO.</strong></td>
                        <td class="valign-middle" colspan="8"><strong><input type="text" name="" class="form-control"
                              disabled></strong></td>
                      </tr>
                      <tr>
                        <td class="valign-middle" colspan="2"><strong>PROJECT</strong></td>
                        <td class="valign-middle" colspan="7"><strong><input type="text"
                              value="<?= $project[$main_data['project_code']]['project_name'] ?>" class="form-control"
                              disabled></strong></td>
                        <td class="valign-middle" colspan="2"><strong>RFI NO.</strong></td>
                        <td class="valign-middle" colspan="8"><strong><input type="text" name="" class="form-control"
                              value="<?= $project[$list_detail[0]['project_code']]['project_ref'].'-OCP-SMO-'.strtoupper($type_of_module_list[$list_detail[0]['type_of_module']]['code']).'-'.strtoupper($discipline_list[$list_detail[0]['discipline']]['initial']).'-NDT-RFI-'.$initial.'-'.str_pad($list_detail[0]['ndt_rfi'],4,0, STR_PAD_LEFT) ?>" disabled></strong></td>
                      </tr>

                      <tr>
                        <td class="valign-middle" colspan="2"><strong>Standard / Code</strong></td>
                        <td class="valign-middle" colspan="7"><strong><input type="text" name="standard_code"
                              value="<?= $standard_code ?>" class="form-control" readonly></strong></td>
                        <td class="valign-middle  text-nowrap" colspan="2"><strong>TESTING LOCATION</strong></td>
                        <td class="valign-middle" colspan="8">

                          <select class="select2" style="width:100%" name="testing_location">
                            <option value="0">---</option>
                            <?php foreach ($master_location as $key => $value_loc) { ?>
                            <option value="<?= $value_loc['id'] ?>"
                              <?= $value_loc['id'] == $report_detail['testing_location'] ? 'selected' : '' ?>>
                              <?= $value_loc['location_name'] ?>
                            </option>
                            <?php } ?>
                          </select>

                        </td>
                      </tr>
                      <tr>
                        <td class="valign-middle" colspan="2" rowspan="2"><strong>Acceptance Criteria</strong></td>
                        <td class="valign-middle" colspan="7">
                          <select name="acceptance_criteria" class="custom-select" disabled="">
                            <option value="ISO 5817 LEVEL B"
                              <?= $list_detail[0]['class']==1 ? 'selected' : '' ?>>ISO 5817 LEVEL B</option>
                            <option value="ISO 5817 LEVEL C"
                              <?= in_array($list_detail[0]['class'], [2, 3]) ? 'selected' : '' ?>>ISO 5817 LEVEL C</option>
                          </select>
                        </td>
                        <td class="valign-middle" colspan="2" rowspan="2"><strong>JOB NO.</strong></td>
                        <td class="valign-middle" colspan="8" rowspan="2"><strong><input class="form-control" type="text"
                              name="job_no" value="<?= @$report_detail['job_no'] ?>"></strong></td>
                      </tr>

                      <tr>
                        <td class="valign-middle" colspan="7">
                          <select name="acceptance_criteria" class="custom-select" disabled="">
                            <option value="ISO 11666 ACCEPTANCE LEVEL 2"
                              <?= $list_detail[0]['class']==1 ? 'selected' : '' ?>>ISO 11666 ACCEPTANCE LEVEL 2</option>
                            <option value="ISO 11666 ACCEPTANCE LEVEL 3"
                              <?= in_array($list_detail[0]['class'], [2, 3]) ? 'selected' : '' ?>>ISO 11666 ACCEPTANCE LEVEL 3</option>
                          </select>
                        </td>  
                      </tr>

                      <tr>
                        <td class="valign-middle" colspan="2"><strong>Procedure No.</strong></td>
                        <td class="valign-middle" colspan="7"><strong><input type="text" name=""
                              value="SCM-SOF-SMOE-23-PR-0008" class="form-control" disabled></strong></td>
                        <td class="valign-middle" colspan="2"><strong>ITEM TESTED.</strong></td>
                        <td class="valign-middle" colspan="8"><textarea class="form-control"
                            name="item_tested"><?= @$report_detail['item_tested'] ?></textarea></td>
                      </tr>

                      <tr>
                        <td class="valign-middle text-nowrap" colspan="2"><strong>GA/ASSY/ISOMETRIC Drawing No.
                          </strong>
                        </td>
                        <td class="valign-middle" colspan="4"><input type="text" name="" class="form-control"
                            value="<?= $list[0]['drawing_no'] ?>" disabled></td>
                        <td class="valign-middle"><strong>Rev.</strong></td>
                        <td class="valign-middle" colspan="2"><input type="text" name="" class="form-control"></td>
                        <td class="valign-middle" colspan="2"><strong>PWHT Status</strong></td>
                        <td class="valign-middle" colspan="8"><strong><input type="text" name="pwht_status"
                              value="<?= @$report_detail['pwht_status'] ?>" class="form-control"></strong></td>
                      </tr>
                      <tr>
                        <td class="valign-middle" rowspan="2" colspan="2">
                          <strong>Job Description</strong>
                        </td>
                        <td class="valign-middle" rowspan="2" colspan="7">
                          <textarea class="form-control" name="job_description"
                            rows="3"><?= @$report_detail['job_description'] ?></textarea>
                        </td>
                        <td class="valign-middle" colspan="2"><strong>Testing Personnel</strong></td>
                        <td colspan="8"><input class="form-control" type="text" name="technician"
                            value="<?= @$report_detail['testing_personnel'] ?>"></td>
                      </tr>
                      <tr>
                        <td colspan="2" class="valign-middle"><strong>Certificate No.</strong></td>
                        <td colspan="8"><input class="form-control" type="text" name="certificate_no"
                            value="<?= @$report_detail['certificate_no'] ?>"></td>
                      </tr>
                      <tr>
                        <td colspan="18" class="bg-grey"><strong>SPECIMEN DATA : </strong></td>
                      </tr>
                      <tr>
                        <td class="valign-middle ball-no-bottom" colspan="2"><strong>GRADE MATERIAL</strong></td>
                        <td>:</td>
                        <td colspan="15"><input class="form-control" type="text" name="grade_material"
                            value="<?= @$report_detail['grade_material'] ?>"></td>
                      </tr>
                      <tr>
                        <td class="valign-middle text-nowrap" colspan="2"><strong>DELIVERY CONDITION</strong></td>
                        <td>:</td>
                        <td colspan="15"><input class="form-control" type="text" name="delivery_condition"
                            value="<?= @$report_detail['delivery_condition'] ?>"></td>
                      </tr>
                      <tr>
                        <td class="valign-middle" colspan="2"><strong>Surface Condition</strong></td>
                        <td>:</td>
                        <td colspan="15"><input class="form-control" type="text" name="surface_condition"
                            value="<?= @$report_detail['surface_condition'] ?>"></td>
                      </tr>
                      <tr>
                        <td class="valign-middle" colspan="2"><strong>HOLDING TIME</strong></td>
                        <td>:</td>
                        <td colspan="15"><input class="form-control" type="text" name="holding_time"
                            value="<?= @$report_detail['holding_time'] ?>"></td>
                      </tr>

                      <tr>
                        <td colspan="18" class="bg-grey"><strong>TEST EQUIPMENT AND CALIBRATION DETAILS : </strong></td>
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
                        <td class="valign-middle text-center" colspan="6"><strong>Range /F.S.L</strong></td>
                      </tr>

                      <tr style="height: 1.5cm">
                        <td class="valign-middle text-center">0&deg;</td>
                        <td class="valign-middle text-center"><input type="text" name="serial_no_0"
                            value="<?= @$report_detail['serial_no_0'] ?>" class="form-control">
                        </td>
                        <td class="valign-middle text-center"><input type="text" name="type_0"
                            value="<?= @$report_detail['type_0'] ?>" class="form-control"></td>
                        <td class="valign-middle text-center"><input type="text" name="size_0"
                            value="<?= @$report_detail['size_0'] ?>" class="form-control"></td>
                        <td class="valign-middle text-center"><input type="text" name="frequency_0"
                            value="<?= @$report_detail['frequency_0'] ?>" class="form-control">
                        </td>
                        <td class="valign-middle text-center" colspan="4"><input type="text" name="reference_0"
                            value="<?= @$report_detail['reference_0'] ?>" class="form-control">
                        </td>
                        <td class="valign-middle text-center"><input type="text" name="tr_loss_0"
                            value="<?= @$report_detail['tr_loss_0'] ?>" class="form-control">
                        </td>
                        <td class="valign-middle text-center" colspan="2"><input type="text" name="scan_0"
                            value="<?= @$report_detail['scan_0'] ?>" class="form-control">
                        </td>
                        <td class="valign-middle text-center" colspan="6"><input type="text" name="range_fsl_0"
                            value="<?= @$report_detail['range_fsl_0'] ?>" class="form-control">
                        </td>
                      </tr>

                      <tr style="height: 1.5cm">
                        <td class="valign-middle text-center">45&deg;</td>
                        <td class="valign-middle text-center"><input type="text" name="serial_no_45"
                            value="<?= @$report_detail['serial_no_45'] ?>" class="form-control">
                        </td>
                        <td class="valign-middle text-center"><input type="text" name="type_45"
                            value="<?= @$report_detail['type_45'] ?>" class="form-control"></td>
                        <td class="valign-middle text-center"><input type="text" name="size_45"
                            value="<?= @$report_detail['size_45'] ?>" class="form-control"></td>
                        <td class="valign-middle text-center"><input type="text" name="frequency_45"
                            value="<?= @$report_detail['frequency_45'] ?>" class="form-control">
                        </td>
                        <td class="valign-middle text-center" colspan="4"><input type="text" name="reference_45"
                            value="<?= @$report_detail['reference_45'] ?>" class="form-control">
                        </td>
                        <td class="valign-middle text-center"><input type="text" name="tr_loss_45"
                            value="<?= @$report_detail['tr_loss_45'] ?>" class="form-control">
                        </td>
                        <td class="valign-middle text-center" colspan="2"><input type="text" name="scan_45"
                            value="<?= @$report_detail['scan_45'] ?>" class="form-control">
                        </td>
                        <td class="valign-middle text-center" colspan="6"><input type="text" name="range_fsl_45"
                            value="<?= @$report_detail['range_fsl_45'] ?>" class="form-control">
                        </td>
                      </tr>

                      <tr style="height: 1.5cm">
                        <td class="valign-middle text-center">60&deg;</td>
                        <td class="valign-middle text-center"><input type="text" name="serial_no_60"
                            value="<?= @$report_detail['serial_no_60'] ?>" class="form-control">
                        </td>
                        <td class="valign-middle text-center"><input type="text" name="type_60"
                            value="<?= @$report_detail['type_60'] ?>" class="form-control"></td>
                        <td class="valign-middle text-center"><input type="text" name="size_60"
                            value="<?= @$report_detail['size_60'] ?>" class="form-control"></td>
                        <td class="valign-middle text-center"><input type="text" name="frequency_60"
                            value="<?= @$report_detail['frequency_60'] ?>" class="form-control">
                        </td>
                        <td class="valign-middle text-center" colspan="4"><input type="text" name="reference_60"
                            value="<?= @$report_detail['reference_60'] ?>" class="form-control">
                        </td>
                        <td class="valign-middle text-center"><input type="text" name="tr_loss_60"
                            value="<?= @$report_detail['tr_loss_60'] ?>" class="form-control">
                        </td>
                        <td class="valign-middle text-center" colspan="2"><input type="text" name="scan_60"
                            value="<?= @$report_detail['scan_60'] ?>" class="form-control">
                        </td>
                        <td class="valign-middle text-center" colspan="6"><input type="text" name="range_fsl_60"
                            value="<?= @$report_detail['range_fsl_60'] ?>" class="form-control">
                        </td>
                      </tr>

                      <tr style="height: 1.5cm">
                        <td class="valign-middle text-center">70&deg;</td>
                        <td class="valign-middle text-center"><input type="text" name="serial_no_70"
                            value="<?= @$report_detail['serial_no_70'] ?>" class="form-control">
                        </td>
                        <td class="valign-middle text-center"><input type="text" name="type_70"
                            value="<?= @$report_detail['type_70'] ?>" class="form-control"></td>
                        <td class="valign-middle text-center"><input type="text" name="size_70"
                            value="<?= @$report_detail['size_70'] ?>" class="form-control"></td>
                        <td class="valign-middle text-center"><input type="text" name="frequency_70"
                            value="<?= @$report_detail['frequency_70'] ?>" class="form-control">
                        </td>
                        <td class="valign-middle text-center" colspan="4"><input type="text" name="reference_70"
                            value="<?= @$report_detail['reference_70'] ?>" class="form-control">
                        </td>
                        <td class="valign-middle text-center"><input type="text" name="tr_loss_70"
                            value="<?= @$report_detail['tr_loss_70'] ?>" class="form-control">
                        </td>
                        <td class="valign-middle text-center" colspan="2"><input type="text" name="scan_70"
                            value="<?= @$report_detail['scan_70'] ?>" class="form-control">
                        </td>
                        <td class="valign-middle text-center" colspan="6"><input type="text" name="range_fsl_70"
                            value="<?= @$report_detail['range_fsl_70'] ?>" class="form-control">
                        </td>
                      </tr>


                      <tr>
                        <td colspan="3" class="valign-middle"><strong>COUPLANT</strong></td>
                        <td class="text-right">:</td>
                        <td colspan="6"><input type="text" name="couplant" value="<?= @$report_detail['couplant'] ?>"
                            class="form-control"></td>
                        <td class="valign-middle"><strong>Brand</strong></td>
                        <td class="text-left">:</td>
                        <td colspan="7"><input type="text" name="brand" value="<?= @$report_detail['brand'] ?>"
                            class="form-control"></td>
                      </tr>
                      <tr>
                        <td colspan="3" class="valign-middle"><strong>CALIBRATION BLOCK </strong></td>
                        <td class="text-right">:</td>
                        <td colspan="6"><input type="text" name="calibration_block"
                            value="<?= @$report_detail['calibration_block'] ?>" class="form-control"></td>
                        <td class="valign-middle"><strong>Model</strong></td>
                        <td class="text-left">:</td>
                        <td colspan="7"><input type="text" name="model" value="<?= @$report_detail['model'] ?>"
                            class="form-control"></td>
                      </tr>
                      <tr>
                        <td colspan="3" class="valign-middle"><strong>REFERENCE BLOCK S/N</strong></td>
                        <td class="text-right">:</td>
                        <td colspan="6"><input type="text" name="reference_block_sn"
                            value="<?= @$report_detail['reference_block_sn'] ?>" class="form-control"></td>
                        <td class="valign-middle"><strong>Serial No.</strong></td>
                        <td class="text-left">:</td>
                        <td colspan="7"><input type="text" name="reference_serial_no"
                            value="<?= @$report_detail['reference_serial_no'] ?>" class="form-control"></td>
                      </tr>

                      <tr>
                        <td colspan="3" class="valign-middle"><strong>Calibration Block Thickness </strong></td>
                        <td class="text-right">:</td>
                        <td colspan="14"><input type="text" name="calibration_block_thickness"
                            value="<?= @$report_detail['calibration_block_thickness'] ?>" class="form-control">
                        </td>
                      </tr>
                      <tr>
                        <td colspan="3"><strong>SENSITIVITY</strong></td>
                        <td class="text-right">:</td>
                        <td colspan="14"><input type="text" name="sensitivity"
                            value="<?= @$report_detail['sensitivity'] ?>" class="form-control"></td>
                      </tr>
                      <tr>
                        <td colspan="3" class="valign-middle"><strong>Evaluation Level</strong></td>
                        <td class="text-right">:</td>
                        <td colspan="14"><input type="text" name="evaluation_level"
                            value="<?= @$report_detail['evaluation_level'] ?>" class="form-control"></td>
                      </tr>
                      <tr>
                        <td colspan="3" class="valign-middle"><strong>Recording Level</strong></td>
                        <td class="text-right">:</td>
                        <td colspan="14"><input type="text" name="recording_level"
                            value="<?= @$report_detail['recording_level'] ?>" class="form-control"></td>
                      </tr>
                      <tr>
                        <td colspan="3" class="valign-middle"><strong>Scanning Technique</strong></td>
                        <td class="text-right">:</td>
                        <td colspan="14"><input type="text" name="scanning_technique"
                            value="<?= @$report_detail['scanning_technique'] ?>" class="form-control"></td>
                      </tr>
                      <tr>
                        <td class="valign-middle text-center column-header" rowspan="2">S/N</td>
                        <td class="valign-middle text-center column-header" rowspan="2">Weld Map Dwg / Line & Spool No.
                        </td>
                        <td class="valign-middle text-center column-header" rowspan="2">Joint No.</td>
                        <td class="valign-middle text-center column-header" rowspan="2">Joint Type</td>
                        <td class="valign-middle text-center column-header" rowspan="2">Total Length (mm)</td>
                        <td class="valign-middle text-center column-header" rowspan="2">Tested Length (mm)</td>
                        <td class="valign-middle text-center column-header" rowspan="2">Size / Dia</td>
                        <td class="valign-middle text-center column-header" rowspan="2">Sch</td>
                        <td class="valign-middle text-center column-header" rowspan="2">Thk (mm)</td>
                        <td class="valign-middle text-center column-header" rowspan="2">Welder ID</td>
                        <td class="valign-middle text-center column-header" colspan="2" rowspan="2">Welding Process</td>
                        <td class="valign-middle text-center column-header" colspan="3">Defect Evaluation </td>
                        <td class="valign-middle text-center column-header" rowspan="2">Result </td>
                        <td class="valign-middle text-center column-header" rowspan="2">Inspection Category </td>
                        <td class="valign-middle text-center column-header" rowspan="2">Inspection Remarks </td>
                      </tr>
                      <tr>
                        <td class="valign-middle text-center column-header">Defect Length (mm) </td>
                        <td class="valign-middle text-center column-header">Defect Depth (mm) </td>
                        <td class="valign-middle text-center column-header">Defect Type </td>
                      </tr>

                      <?php $no = 1; foreach ($list_detail as $key => $value): ?>
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

                        <td>
                          <?php if ($value['result'] == 3): ?>
                          ACC
                          <?php elseif($value['result'] == 2): ?>
                          REJ
                          <?php endif; ?>
                        </td>
                        <td><?= $class[$value['class']] ?></td>
                        <td></td>

                      </tr>
                      <?php endforeach; ?>
                      <tr>
                        <td class="valign-middle" class="valign-middle">Note :</td>
                        <td class="valign-middle" colspan="17">
                          <textarea name="note" class="form-control"><?= @$report_detail['note'] ?></textarea>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="col-md-12 text-right">
                  <?php if($condition=='approval_client'){ ?>
                  <?php if($list_detail[0]['client_approval_status']==1){ ?>
                  <button type="submit" name="approval_client" class="btn btn-success" value="3">
                    <i class="fas fa-check"></i>
                    Approve
                  </button>
                  <button type="submit" name="approval_client" class="btn btn-danger" value="2">
                    <i class="fas fa-times"></i>
                    Reject
                  </button>
                  <br>
                  <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                      <textarea class="form-control" placeholder="Remarks" style="right: 0px !important" name="client_approval_remarks"><?= $list_detail[0]['client_approval_remarks'] ?></textarea>
                    </div>
                  </div>
                  <?php } else {
                    if($list_detail[0]['client_approval_status']==3){
                      echo "<span class='btn btn-success'><b>Approved</b></span><br><br>";
                    } else {
                      echo "<span class='btn btn-danger'><b>Rejected</b></span><br><br>";
                    }
                  } ?>
                <?php } elseif($condition=='approval'){ ?>
                <?php if($list_detail[0]['smoe_approval_status']==1){ ?>
                <button type="submit" name="approval" class="btn btn-success" value="3">
                  <i class="fas fa-check-square"></i>
                  Approve
                </button>
                <button type="submit" name="approval" class="btn btn-danger" value="2">
                  <i class="fas fa-times"></i>
                  Reject
                </button>
                <br>
                <div class="row">
                  <div class="col-md-8"></div>
                  <div class="col-md-4">
                    <textarea class="form-control" placeholder="Remarks" style="right: 0px !important"
                      name="smoe_approval_remarks"><?= $list_detail['smoe_approval_remarks'] ?></textarea>
                  </div>
                </div>
                <?php } else { 
                    if($list_detail[0]['smoe_approval_status']==3){
                      echo "<span class='btn btn-success'><b>Approved</b></span><br><br>";
                    } else {
                      echo "<span class='btn btn-danger'><b>Rejected</b></span><br><br>";
                    }
                  } ?>
                  <a href="<?= $_SERVER[REDIRECT_URL].'/pdf' ?>" class="btn btn-danger">
                    <i class="fas fa-file-pdf"></i> Report
                  </a>
                <?php } elseif($condition=='update'){ ?>
                  <button type="submit" name="submit" class="btn btn-info" value="update">
                    <i class="fas fa-check-square"></i>
                    Save & Closed
                  </button>
                  <a href="<?= $_SERVER[REDIRECT_URL].'/pdf' ?>" class="btn btn-danger">
                    <i class="fas fa-file-pdf"></i> Report
                  </a>
                <?php } else { ?>
                <?php if(!in_array($list_detail[0]['smoe_approval_status'], [1,3])){ ?>
                  <button type="submit" name="submit" class="btn btn-info" value="save">
                    <i class="fas fa-check-square"></i>
                    Save
                  </button>
                  <button type="submit" name="submit" class="btn btn-success" value="send">
                    <i class="fas fa-upload"></i>
                    Submit
                  </button>
                  <a href="<?= $_SERVER[REDIRECT_URL].'/pdf' ?>" class="btn btn-danger">
                    <i class="fas fa-file-pdf"></i> Report
                  </a>
                <?php } else {?>
                  <?php if($list_detail[0]['client_approval_status']<=1){ ?>
                    <badge name="submit_visual" class="btn btn-warning" data-toggle="modal" data-target="#reqforupdateModal"><i class="fa fa-edit"></i> <b>Request for Update</b></badge>
                  <?php } ?>
                  <a href="<?= $_SERVER[REDIRECT_URL].'/pdf' ?>" class="btn btn-danger">
                    <i class="fas fa-file-pdf"></i> Report
                  </a>
                <?php } ?>
                <?php } ?>

                </div>
              </div>
            </form>
            <!-- ======================================= -->
            <div class="modal fade" id="reqforupdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="POST" action="<?php echo base_url('ndt/request_for_update') ?>">
                      <div class="form-group">
                        <label for="inspector_before">Last Inspector By</label>
                        <input type="text" class="form-control" id="inspector_before" value="<?= $user_list[$list_detail[0]['smoe_approval_by']]['full_name'] ?>" readonly>
                        <input name="inspector_before" type="hidden" value="<?= $list_detail[0]['smoe_approval_by'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label for="requestor">Request By</label>
                        <input type="text" class="form-control" id="requestor" placeholder="" value="<?= $user_list[$this->user_cookie[0]]['full_name'] ?>" readonly>
                        <input name="requestor" type="hidden" value="<?= $this->user_cookie[0] ?>" readonly>
                        <input name="submission_id" type="hidden" value="<?= $initial ?>" readonly>
                        <input name="id_data" type="hidden" value="<?= $list_detail[0]['report_number'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label for="reason">Reason</label>
                        <textarea class="form-control" id="reason" placeholder="Reasons for update" name="reason"></textarea>
                      </div>
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- ======================================= -->
            <hr>
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md">
                    <div class="form-group">
                      <label>Drawing Number</label>
                      <input type="text" class="form-control" name="drawing_no" id="drawing_no"
                        value="<?= $list[0]['drawing_no'] ?>" autocomplete="off" readonly>
                      <span id="text_alert"></span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md">
                    <div class="form-group">
                      <label>Discipline</label>
                      <input type="text" class="form-control" name="discipline_name" readonly required
                        value="<?= $discipline_list[$list[0]['discipline']]['discipline_name'] ?>">
                    </div>
                  </div>
                  <div class="col-md">
                    <div class="form-group">
                      <label>Module</label>
                      <input type="text" class="form-control" name="module_name" readonly required
                        value="<?= $module_list[$list[0]['module']]['mod_desc'] ?>">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md">
                    <div class="form-group">
                      <label>Date of Inspection</label>
                      <input type="text" name="technique" class="form-control"
                        value="<?= DATE('Y-m-d', strtotime($list[0]['date_of_inspection'])); ?>" readonly>
                    </div>
                  </div>
                  <div class="col-md">
                    <div class="form-group">
                      <label>NDT Report No</label>
                      <input type="text" name="ndt_report_number" class="form-control"
                        value="<?= $project[$list_detail[0]['project_code']]['project_ref'].'-OCP-SMO-'.strtoupper($type_of_module_list[$list_detail[0]['type_of_module']]['code']).'-'.strtoupper($discipline_list[$list_detail[0]['discipline']]['initial']).'-NDT-'.$initial.'-'.str_pad($list_detail[0]['report_number'],4,0, STR_PAD_LEFT) ?>" required>
                    </div>
                  </div>
                </div>

                <div class="row" style="margin-bottom: 0cm !important">
                  <div class="col-md">
                    <div class="form-group">
                      <div class="form-row">
                        <div class="form-group col-md-12">
                          <table width="500px">
                            <tr class="d-none">
                              <td style="padding:10px;">Change Date of Inspection</td>
                              <td style="padding:10px;">:</td>
                              <td style="padding:10px;"><input type='date' name='approval_date' class="form-control"
                                  required="" value='<?= $date_of_inspection ?>'
                                  onchange="update_inspectiondate('<?= $list[0]['report_number'] ?>', '<?= $list[0]['drawing_no'] ?>')">
                              </td>
                              <script type="text/javascript">
                              function update_inspectiondate(report_number, drawing_no) {

                                var new_doi = $('input[name=approval_date]').val();

                                Swal.fire({
                                  title: 'Are you sure want to change date of inspection ?',
                                  text: "",
                                  type: 'warning',
                                  showCancelButton: true,
                                  confirmButtonColor: '#3085d6',
                                  cancelButtonColor: '#d33',
                                  confirmButtonText: 'Yes, Update this date!'
                                }).then((result) => {

                                  if (result.value) {
                                    $.ajax({
                                      url: "<?= base_url('ndt/change_date_of_inspection/').$initial ?>",
                                      type: "post",
                                      data: {
                                        'report_no': report_number,
                                        'drawing_no': drawing_no,
                                        'date_of_inspection': new_doi,
                                      },
                                      success: function(data) {
                                        Swal.fire(
                                          'Approval Date Has Been Updated !',
                                          '',
                                          'success'
                                        ).then(function() {

                                          location.reload();
                                          return false;
                                        });
                                      }
                                    });
                                  }
                                })

                              }
                              </script>
                            </tr>
                            <?php if($list[0]['pwht_status']==1){ ?>
                            <tr>
                              <td>
                                <b style="padding:10px;">APWHT:</b>
                                <i class="fas fa-check-square text-success fa-lg"></i>
                              </td>
                            </tr>
                            <?php } ?>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md">
                    <div class="form-group">
                      <button class="btn btn-warning font-weight-bold d-none"
                        onclick="update_report_number('<?= $list[0]['report_number'] ?>', '<?= $list[0]['drawing_no'] ?>')">Change
                        Report Number</button>
                      <script type="text/javascript">
                      function update_report_number(last_rn, drawing_no) {
                        var new_report_no = $('input[name=ndt_report_number]').val();
                        Swal.fire({
                          title: 'Are you sure want to resubmit ?',
                          text: "",
                          type: 'warning',
                          showCancelButton: true,
                          confirmButtonColor: '#3085d6',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Yes, Update this Report No!'
                        }).then((result) => {

                          if (result.value) {

                            $.ajax({
                              url: "<?= base_url('ndt/change_report_number/').$initial ?>",
                              type: "post",
                              data: {
                                'new_report_no': new_report_no,
                                'old_report_no': last_rn,
                                'drawing_no': drawing_no,
                                'submission_id': '<?= $list[0]['submission_id'] ?>'
                              },
                              success: function(data) {
                                Swal.fire(
                                  'Report Number Has Been Updated !',
                                  '',
                                  'success'
                                ).then(function() {
                                  location.reload();
                                  return false;
                                });
                              }
                            });

                          }

                        })

                      }
                      </script>
                    </div>
                  </div>
                </div>
                <?php if($data_radiographic_joint[0]['pwht']==1){ ?>
                <div class="row" style="margin-top: 0cm !important">
                  <div class="col-md-4 pl-3">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="" value="1" class="custom-control-input pwht_check" id="customCheck1"
                        <?= $data_radiographic_joint[0]['pwht']==1 ? 'checked' : ''; ?>>
                      <label class="custom-control-label">PWHT</label>
                    </div>
                  </div>
                </div>
                <?php } ?>

                <div class="container col-md-12">

                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#joint_detail">Joint Details</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#menu1">Attachment</a>
                    </li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div id="joint_detail" class="container tab-pane  col-md-12 active"><br>
                      <div class="row" name="<?php echo $drawing_no ?>">
                        <div class="col-md-12">
                          <h6 class="mt-3 px-3 py-3 mb-0 bg-success text-white">
                            <button class="btn attachment_minimize text-white" type="button"><i
                                class="fa fa-minus"></i></button>
                            Drawing Number : <span><?= $drawing_no ?></span>
                          </h6>
                          <!-- <div class="text-right p-3" name="<?php echo $drawing_no ?>_joint" id="tambahdrawingjoint">
                          <button type="button" class="btn btn-success" title="Add Attachment" onclick="add_attachment()"><i class="fa fa-plus"></i>&nbsp; Add Joint</button>
                        </div> -->
                          <div class="col-md-12">
                            <table class="table table-hover text-muted" id='table_attachment'>

                              <div>
                                <br>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                  <i class="fas fa-plus"></i>
                                  Add Joint
                                </button>
                                <br>
                                <br>
                              </div>

                              <thead>
                                <tr>
                                  <th width="100">Weld Map</th>
                                  <th>JOINT NUMBER</th>
                                  <th>TEST RESULT</th>
                                  <th>Type Deffect</th>
                                  <th>REMARKS</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($list as $key => $value) {?>
                                <?php //test_var($value); ?>
                                <tr>
                                  <td><?= $value['drawing_wm'] ?></td>
                                  <td>
                                    <?= $value['joint_no'].($value['revision']>0 ? '('.$value['revision_category'].$value['revision'].')' : '') ?>
                                  </td>

                                  <td>
                                    <?php 
                                  if($value['result']==2){
                                    echo '<span class="badge badge-danger">Rejected</span>';
                                  } elseif($value['result']==3){
                                    echo '<span class="badge badge-success">Approved</span>';
                                  }
                                ?>
                                  </td>

                                  <td>
                                    <?php if($value['result']==2){ ?>
                                    <div class="input-group mb-3">
                                      <select id='ctq_id_<?= $value["id"]; ?>' class="form-control">
                                        <option value="">-----</option>
                                        <?php foreach ($master_data_ctq as $valuex) { ?>
                                        <option value="<?php echo $valuex['id']; ?>">
                                          <?php echo $valuex["ctq_description"]; ?> (
                                          <?php echo $valuex["ctq_initial"]; ?> )</option>
                                        <?php } ?>
                                      </select>
                                      <input type='number' step='any' class='form-control ctq_rejected'
                                        id='ctq_length_<?= $value["id"]; ?>' placeholder='Type Deffect Length'>
                                      <input type="text" class='form-control welder_<?= $key ?>' name="welder"
                                        id='welder_<?= $value["id"]; ?>' placeholder='Welder'
                                        onfocus="welder_autocomplete('<?= $key ?>');">
                                      <select id='planarity_<?= $value["id"]; ?>'
                                        class="form-control planarity_<?= $value["id"]; ?>">
                                        <option value="0">Non-Planar</option>
                                        <option value="1">Planar</option>
                                      </select>

                                      <div class="input-group-prepend">
                                        <button type="button" class='btn btn-warning'
                                          onclick="add_ctq_in_process('<?= $value["id"] ?>')"><i
                                            class="fas fa-save"></i></button>
                                        <script type="text/javascript">
                                        function add_ctq_in_process(id_detail) {

                                          var val_ctq_id_detail = "ctq_id_" + id_detail;
                                          var val_ctq_length_detail = "ctq_length_" + id_detail;
                                          var val_ctq_wel = "welder_" + id_detail;
                                          var val_ctq_planar = "planarity_" + id_detail;

                                          var val_id_detail = id_detail;
                                          var val_ctq_id = $('#' + val_ctq_id_detail).val();
                                          var val_ndt_type = '<?= $initial; ?>';
                                          var val_repair_length = $('input[id=' + val_ctq_length_detail + ']').val();

                                          var val_welder = $('input[id=' + val_ctq_wel + ']').val();
                                          var val_planar = $('.' + val_ctq_planar).val();

                                          console.log(val_ctq_planar);
                                          console.log(val_ctq_wel);
                                          console.log(val_planar);
                                          console.log(val_welder);

                                          if (val_repair_length > 0 && val_ctq_id > 0) {

                                            $.ajax({
                                              url: "<?php echo base_url();?>ndt/add_ctq_process",
                                              type: "post",
                                              data: {
                                                ndt_type: val_ndt_type,
                                                id_detail: val_id_detail,
                                                ctq_id: val_ctq_id,
                                                welder: val_welder,
                                                repair_length: val_repair_length,
                                                planarity_status: val_planar,
                                                submission_id: '<?= $list[0]['submission_id'] ?>',
                                                report_number: '<?= $list[0]['report_number'] ?>'
                                              },
                                              success: function(data) {
                                                Swal.fire(
                                                  'Success',
                                                  'Your data has been Updated!',
                                                  'success'
                                                );
                                                location.reload();
                                              }
                                            });

                                          } else {
                                            Swal.fire(
                                              'Warning',
                                              'Please Choice CTQ & Fill Up Rejected Length',
                                              'warning'
                                            );
                                          }

                                        }
                                        </script>
                                      </div>
                                    </div>
                                    <?php                            
                                  if(sizeof($data_ctq_db) > 0){
                                    echo "<table width='100%'>";
                                    foreach ($data_ctq_db as $data_ctq) {
                                      if($data_ctq['ndt_id']==$value['id'])
                                      {
                                       echo "
                                       <tr>
                                        <td>".$ctq_description[$data_ctq['ctq_id']]."( ".$ctq_initial[$data_ctq['ctq_id']]." )</td>
                                        <td>".$data_ctq['length']." MM</td>
                                        <td>".(isset($data_ctq['welder']) ?  $weld_name[$data_ctq['welder']] :  "-").'</td>
                                        <td>'.($data_ctq['planarity']==1 ? 'Planar' : 'Non-Planar')."</td><td>"
                                        ;?>
                                    <button class="btn btn-danger" type="button"
                                      onclick='delete_ctq_data("<?= $data_ctq['id'] ?>")'><i
                                        class="fa fa-trash"></i></button><?php echo "</td>
                                        </tr>";
                                      }
                                    } 

                                    echo "</table>";                                  
                                  }
                                ?>
                                    <script type="text/javascript">
                                    function welder_autocomplete(no) {
                                      $('.welder_' + no).autocomplete({
                                        source: function(request, response) {
                                          $.post('<?php echo base_url(); ?>ndt/welder_autocomplete', {
                                            term: request.term
                                          }, response, 'json');
                                        },
                                        autoFocus: true,
                                        classes: {
                                          "ui-autocomplete": "highlight"
                                        }
                                      });
                                    }

                                    function delete_ctq_data(id) {
                                      Swal.fire({
                                        title: 'Are you sure to <b class="text-warning">&nbsp;Delete&nbsp;</b> this?',
                                        text: "This item will permanent deleted!",
                                        type: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Yes, Delete it!'
                                      }).then((result) => {
                                        if (result.value) {
                                          $.ajax({
                                            url: "<?php echo base_url();?>ndt/delete_ctq_data",
                                            type: "post",
                                            data: {
                                              id: id,
                                            },
                                            success: function(data) {

                                              Swal.fire(
                                                'Success',
                                                'Your data has been Updated!',
                                                'success'
                                              );
                                              location.reload();
                                            }
                                          });
                                        }
                                      })

                                    }
                                    </script>
                                    <?php } else { ?>
                                    -
                                    <?php } ?>
                                  </td>

                                  <td><?= $value['remarks'] ?></td>
                                  <td>
                                    <button class="btn btn-danger"
                                      onclick="delete_joint_on_dtail('<?= $value["id"] ?>','<?= $value["submission_id"] ?>')">
                                      <i class="fas fa-trash"></i>
                                      Joint
                                    </button>
                                  </td>
                                  <script type="text/javascript">
                                  function delete_joint_on_dtail(id, uniq_data) {
                                    console.log(id)
                                    console.log(uniq_data)
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
                                          url: "<?php echo base_url();?>ndt/remove_joint_from_report",
                                          type: "post",
                                          data: {
                                            id: id,
                                            submission_id: uniq_data,
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
                                </tr>
                                <?php } ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div id="menu1" class="container tab-pane col-md-12 fade"><br>
                      <div class="col-md-12">

                        <form action="<?php echo base_url('ndt/upload_new_attachment/').$ndt_code;?>" method="post"
                          enctype="multipart/form-data">
                          <div class="row">
                            <div class="col-md">
                              <div class="form-group">
                                <label>Remarks Data :</label>
                                <textarea name='remarks' class='form-control' required=""></textarea>
                                <input type="hidden" class="form-control" name="submission_id" id="uniq_data"
                                  value="<?= $list[0]['submission_id'] ?>" autocomplete="off" readonly>
                                <input type="hidden" class="form-control" name="report_number" id="uniq_data"
                                  value="<?= $list[0]['report_number'] ?>" autocomplete="off" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md">
                              <div class="form-group">
                                <label>Select File to upload :</label>
                                <input type="file" name="file_attachment" id="file_attachment" required="">
                              </div>
                            </div>
                          </div>
                          <input type="submit" value="Upload File" name="submit" class='btn btn-secondary'>
                        </form>

                        <h6 class="mt-3 px-3 py-3 mb-0 bg-success text-white">
                          <button class="btn attachment_minimize text-white" type="button"><i
                              class="fa fa-minus"></i></button>
                          Drawing Number : <span><?= $drawing_no ?></span>
                        </h6>
                        <div class="col-md-12">
                          <table class="table text-muted">
                            <thead>
                              <tr>
                                <th>ATTACHMENT</th>
                                <th>UPLOAD BY</th>
                                <th>UPLOAD DATE</th>
                                <th>REMARKS</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>

                              <?php foreach ($data_attachment as  $value){ ?>
                              <tr>
                                <td>
                                  <!-- <a href='http://<?= $ftpsrc[0]["destination_source"] ?>/upload/ndt/<?= $name_process ?>/<?php echo $value["attachment_filename"] ?>'><?php echo $value["attachment_filename"] ?></a> -->
                                  <a
                                    href="<?= base_url('upload/ndt/').$value["filename"] ?>"><?php echo $value["filename"] ?></a>
                                </td>
                                <td><?php echo $user_list[$value["created_by"]]['full_name'] ?></td>
                                <td><?php echo $value["created_date"] ?></td>
                                <td><?php echo $value["remarks"] ?></td>
                                <td><button class="btn btn-danger" type="button"
                                    onclick="delete_attachment_on_update('<?= $value["id"] ; ?>','<?= $value["uniq_data"]; ?>')"><i
                                      class="fa fa-trash"></i></button></td>
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
                                      url: "<?php echo base_url();?>ndt/ndt_valid/delete_attachment",
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

                <br>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <form action="<?= base_url('ndt/add_detail') ?>" method="POST">
    <input type="hidden" name="ndt_report_number" class="form-control" value="<?= $list[0]['report_number'] ?>"
      required>
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Joint List</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table_modal">
            <thead class="bg-green-smoe text-white">
              <tr>
                <th>Drawing No.</th>
                <th>Drawing Weld Map</th>
                <th>Joint No.</th>
                <th>Result</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($ready_list as $key => $valueh) {?>
              <tr>
                <td><?= $valueh['drawing_no'] ?></td>
                <td><?= $valueh['drawing_wm'] ?></td>
                <td>
                  <?= $valueh['joint_no'].($valueh['revision']>0 ? '('.$valueh['revision_category'].$valueh['revision'].')' : '') ?>
                </td>
                <td>
                  <div class="form-check form-check-inline">
                    <label class="form-check-label text-success font-weight-bold">
                      <input class="form-check-input approve" type="radio" title="Approve" name="result[<?= $key ?>]"
                        value="3" style="width: 17px; height: 17px" onclick="repair_length('disable',<?= $key ?>)">
                      Approved</label>
                  </div>
                  <br>
                  <div class="form-check form-check-inline">
                    <label class="form-check-label text-danger font-weight-bold"><input class="form-check-input reject"
                        type="radio" title="Reject" name="result[<?= $key ?>]" value="2"
                        style="width: 17px; height: 17px" onclick="repair_length('enable',<?= $key ?>)">
                      Rejected</label>
                  </div>
                </td>
                <td>
                  <input type="checkbox" name="choosen[<?= $key ?>]" class="form-control" value="1">
                  <input type="hidden" name="id[<?= $key ?>]" value="<?= $valueh['id'] ?>">

                  <input type="hidden" name="initial" class="form-control" value="<?= $initial ?>">
                  <input type="hidden" name="drawing_no" class="form-control" value="<?= $valueh['drawing_no'] ?>">
                  <input type="hidden" name="pwht_status" value="<?= $list[0]['pwht_status'] ?>">
                  <input type="hidden" name="date_of_inspection" value="<?= $list[0]['date_of_inspection'] ?>">
                  <input type="hidden" name="submission_id" value="<?= $list[0]['submission_id'] ?>">
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </form>
</div>

<script>

</script>