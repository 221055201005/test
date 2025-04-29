<style type="text/css">
  .ctq_rejected {
    width: 10px !important;
  }
</style>

<style type="text/css">
  input[type="checkbox"][readonly] {
    pointer-events: none;
    /*outline: 1px solid red;*/
    opacity:0.3;
  }
</style>
<div id="content" class="container-fluid">
      <div class="row">

      <div class="col-md-12">
        <div class="my-3 p-3 bg-white rounded shadow-sm">
          <h6 class="pb-2 mb-0"><?php echo $meta_title.' Report' ?></h6>
          <div class="overflow-auto media text-muted pt-3 mt-1 border-top border-gray">
            <div class="container-fluid">
              <table width="100%" class="table table-bordered">
                <form method="POST" action="<?= base_url('ndt/insert_ndt_rfi/').$initial ?>">
                <thead>
                  <tr>
                    <th class="text-center align-middle" colspan="17"><img src="<?= base_url() ?>img/header_report.png"></th>
                  </tr>
                  <tr>
                    <th class="text-center align-middle" colspan="9" rowspan="3"><h3>DYE PENETRANT INSPECTION<br>REPORT</h3></th>
                    <th colspan="2">Report No.</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="5"><input class="form-control" type="text" name="" value="<?= $project[$list_detail[0]['project_code']]['project_ref'].'-OCP-SMO-'.strtoupper($type_of_module_list[$list_detail[0]['type_of_module']]['code']).'-'.strtoupper($discipline_list[$list_detail[0]['discipline']]['initial']).'-NDT-'.$initial.'-'.str_pad($list_detail[0]['report_number'],4,0, STR_PAD_LEFT) ?>" disabled></th>
                  </tr>
                  <tr>
                    <th colspan="2">Page No</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="5"><input class="form-control" type="text" name="" disabled=""></th>
                  </tr>
                  <tr>
                    <th colspan="2">RFI No.</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="5"><input class="form-control" type="text" name="" value="<?= $project[$list_detail[0]['project_code']]['project_ref'].'-OCP-SMO-'.strtoupper($type_of_module_list[$list_detail[0]['type_of_module']]['code']).'-'.strtoupper($discipline_list[$list_detail[0]['discipline']]['initial']).'-NDT-'.$initial.'-'.str_pad($list_detail[0]['ndt_rfi'],4,0, STR_PAD_LEFT) ?>" disabled></th>
                  </tr>
                  <tr>
                    <th colspan="3">Client</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="5"><input class="form-control" type="text" name="" value="<?= $project[$list_detail[0]['project_code']]['client'] ?>" disabled></th>

                    <th colspan="2">Date of Inspection</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="5"><input class="form-control" type="text" name="" value="<?= DATE('Y-m-d', strtotime($list_detail[0]['date_of_inspection'])) ?>" disabled></th>
                  </tr>
                  <tr>
                    <th colspan="3">Project</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="5"><input class="form-control" type="text" name="" value="<?= $project[$list_detail[0]['project_code']]['project_name'] ?>" disabled></th>
                    <th colspan="2">Testing Location</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="5">
                      <!-- <input class="form-control" type="text" name="testing_location" value="<?= @$report_detail['testing_location'] ?>"> -->
                      <select  class="select2" style="width:100%" name="testing_location">
                        <option>---</option>
                        <?php foreach ($master_location as $key => $value_loc) { ?>
                        <option value="<?= $value_loc['id'] ?>" <?= $value_loc['id']==$report_detail['testing_location'] ? 'selected' : '' ?>>
                          <?= $value_loc['location_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </th>
                  </tr>
                  <tr>
                    <th colspan="3">Standard / Code</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="5">
                      <input class="form-control" type="text" name="" disabled="" value="<?= $list[0]['discipline']==2 ? 'DNVGL-CG-0051 / BS EN ISO 17635' : 'ASME B31.3' ?>">
                    </th>
                    <th colspan="2">Job No.</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="5"><input class="form-control" type="text" name="job_no" value="<?= @$report_detail['job_no'] ?>"></th>
                  </tr>
                  <tr>
                    <th colspan="3" rowspan="2" class="align-middle">Acceptance Criteria</th>
                    <th colspan="1" rowspan="2" class="align-middle">:</th>
                    <th colspan="5">
                      <?php if($list[0]['discipline']==1){ ?>
                      <input class="form-control" type="text" name="acceptance_criteria" readonly="" value="ASME B31.3 Paragraph 344.4.2">
                      <?php } else { ?>
                      <select class="form-control" name="acceptance_criteria" readonly>
                        <option>---</option>
                        <option value="ISO 5817 LEVEL B" <?= $list_detail[0]['class']==1 ? 'selected' : '' ?>>ISO 5817 LEVEL B</option>
                        <option value="ISO 5817 LEVEL C" <?= in_array($list_detail[0]['class'], [2, 3]) ? 'selected' : '' ?>>ISO 5817 LEVEL C</option>             
                      </select>
                      <?php } ?>
                    </th>

                    <th colspan="2" rowspan="2" class="align-middle">Item Tested</th>
                    <th colspan="1" rowspan="2" class="align-middle">:</th>
                    <th colspan="5" rowspan="2" class="align-middle">
                      <!-- <input class="form-control" type="text" name="item_tested" value="<?= @$report_detail['item_tested'] ?>"> -->
                      <textarea class="form-control" name="item_tested"><?= @$report_detail['item_tested'] ?></textarea>
                    </th>
                  </tr>
                  <tr>
                    <th colspan="5">
                      <?php if($list[0]['discipline']==1){ ?>
                      <input class="form-control" type="text" name="acceptance_criteria" readonly="" value="ASME B31.3 Paragraph 344.4.2">
                      <?php } else { ?>
                      <select class="form-control" name="acceptance_criteria" readonly>
                        <option>---</option>
                        <option value="ISO 23277 ACCEPTANCE LEVEL 2X" <?= $list_detail[0]['class']==1 ? 'selected' : '' ?>>ISO 23277 ACCEPTANCE LEVEL 2X</option>
                        <option value="ISO 23277 ACCEPTANCE LEVEL 2X" <?= in_array($list_detail[0]['class'], [2, 3]) ? 'selected' : '' ?>>ISO 23277 ACCEPTANCE LEVEL 2X</option>             
                      </select>
                      <?php } ?>
                    </th>
                  </tr>
                  <tr>
                    <th colspan="3">Procedure No.</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="5"><input class="form-control" type="text" name="procedure_no" value="<?= $list[0]['discipline']==2 ? 'SCM-SOF-SMOE-23-PR-0010': 'SCM-SOF-SMOE-23-PR-0013' ?>" readonly></th>
                    <th colspan="2">Grade Material</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="5"><input class="form-control" type="text" name="grade_material" value="<?= @$report_detail['grade_material'] ?>"></th>
                  </tr>
                  <tr>
                    <th colspan="3">GA/ASSY/ISO Drawing No.</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="5"><input class="form-control" type="text" name="" disabled="" value="<?= $list[0]['drawing_no'] ?>"></th>
                    <th colspan="2">Delivery Condition</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="5"><input class="form-control" type="text" name="delivery_condition" value="<?= @$report_detail['delivery_condition'] ?>"></th>
                  </tr>
                  <tr>
                    <th colspan="3" rowspan="2" class="align-middle">Job Description</th>
                    <th colspan="1" rowspan="2" class="align-middle">:</th>
                    <th colspan="5" rowspan="2" class="align-middle">
                      <!-- <input class="form-control" type="text" name="job_description"> -->
                      <textarea class="form-control" name="job_description" rows="3"><?= @$report_detail['job_description'] ?></textarea>
                    </th>
                    <th colspan="2">Technician</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="5"><input class="form-control" type="text" name="technician" value="<?= @$report_detail['testing_personnel'] ?>"></th>
                  </tr>
                  <tr>
                    <th colspan="2">Certificate No.</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="5"><input class="form-control" type="text" name="certificate_no" value="<?= @$report_detail['certificate_no'] ?>"></th>
                  </tr>

                  <tr>
                    <th colspan="3">Penetrant System</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="13">
                      <input type="radio" name="penetrant_system" value="colored" <?= $report_detail['penetrant_system']=='colored' ? 'checked' : '' ?>>Colored &nbsp;&nbsp;&nbsp;
                      <input type="radio" name="penetrant_system" value="fluorescent" <?= $report_detail['penetrant_system']=='fluorescent' ? 'checked' : '' ?>>Fluorescent
                    </th>
                  </tr>
                  <tr>
                    <th colspan="3">Penetrant Type / Method</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="13">
                      <input type="radio" name="penetrant_type_method" value="visible" <?= $report_detail['penetrant_type_method']=='visible' ? 'checked' : '' ?>>Visible &nbsp;&nbsp;&nbsp;
                      <input type="radio" name="penetrant_type_method" value="solvent" <?= $report_detail['penetrant_type_method']=='solvent' ? 'checked' : '' ?>>Solvent Removable &nbsp;&nbsp;&nbsp;
                      <input type="radio" name="penetrant_type_method" value="other" <?= $report_detail['penetrant_type_method']=='other' ? 'checked' : '' ?>>Other
                      <input class="" type="text" name="penetrant_type_method_other" value="<?= $report_detail['penetrant_type_method_other'] ?>">
                    </th>
                  </tr>

                  <tr>
                    <th colspan="3">Brand's Name / Type</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="2">
                      <input class="form-control" type="text" name="brand_name" value="<?= @$report_detail['brand'] ?>"></th>

                    <th colspan="1">Penetrant</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="1">
                      <input class="form-control" type="text" name="penetrant" value="<?= @$report_detail['penetrant'] ?>"></th>

                    <th colspan="1">Cleaner</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="2">
                      <input class="form-control" type="text" name="cleaner" value="<?= @$report_detail['cleaner'] ?>"></th>

                    <th colspan="1">Developer</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="2">
                      <input class="form-control" type="text" name="developer" value="<?= @$report_detail['developer'] ?>"></th>
                  </tr>

                  <tr>
                    <th colspan="3">Batch Number</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="3"><input class="form-control" type="text" name="batch_number" value="<?= @$report_detail['batch_number'] ?>"></th>
                    <th colspan="10"></th>
                  </tr>

                  <tr>
                    <th colspan="3">Methods Pre-Cleaning</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="3"><input class="form-control" type="text" name="methods_pre_cleaning" value="<?= @$report_detail['methods_pre_cleaning'] ?>"></th>
                    <th colspan="10"></th>
                  </tr>

                   <tr>
                    <th colspan="3">Penetrant Applicable</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="3">
                      <input type="radio" name="penetrant_applicable" value="brush" <?= $report_detail['penetrant_applicable']=='brush' ? 'checked' : '' ?>>Brush &nbsp;&nbsp;&nbsp;
                    </th>
                    <th colspan="2">
                      <input type="radio" name="penetrant_applicable" value="spray" <?= $report_detail['penetrant_applicable']=='spray' ? 'checked' : '' ?>>Spray &nbsp;&nbsp;&nbsp;
                    </th>
                    <th colspan="9"></th>
                  </tr>

                  <tr>
                    <th colspan="3">Light Insensity</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="2"><input class="form-control" type="text" name="light_intensity" value="<?= @$report_detail['light_intensity'] ?>"></th>

                    <th colspan="1">Light Source</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="1"><input class="form-control" type="text" name="light_source" value="<?= @$report_detail['light_source'] ?>"></th>

                    <th colspan="1">Dwell Time</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="2"><input class="form-control" type="text" name="dwell_time" value="<?= @$report_detail['dwell_time'] ?>"></th>

                    <th colspan="1">Surface Temperature</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="2"><input class="form-control" type="text" name="surface_temperature" value="<?= @$report_detail['temperature'] ?>"></th>
                  </tr>

                  <tr>
                    <th colspan="3">Methode Removing Excess Penetrant</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="3"><input class="form-control" type="text" name="method_removing_excess_penetrant" value="<?= @$report_detail['method_removing_excess_penetrant'] ?>"></th>
                    <th colspan="10"></th>
                  </tr>

                  <tr>
                    <th colspan="3">Drying After Remove Excess Penetrant</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="3"><input class="form-control" type="text" name="drying_after_remove" value="<?= @$report_detail['drying_after_remove'] ?>"></th>
                    <th colspan="10"></th>
                  </tr>

                  <tr>
                    <th colspan="3">Surface Preparation / Cleaning</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="3">
                      <input type="radio" name="surface_preparation_cleaning" value="as_welded" <?= $report_detail['surface_preparation_cleaning']=='as_welded' ? 'checked' : '' ?>>As Welded
                    </th>
                    <th colspan="3">
                      <input type="radio" name="surface_preparation_cleaning" value="machining" <?= $report_detail['surface_preparation_cleaning']=='machining' ? 'checked' : '' ?>>Machining
                    </th>
                    <th colspan="3">
                      <input type="radio" name="surface_preparation_cleaning" value="grinding" <?= $report_detail['surface_preparation_cleaning']=='grinding' ? 'checked' : '' ?>>Grinding
                    </th>
                    <th colspan="4"></th>
                  </tr>

                  <tr>
                    <th colspan="3">Time of Examination</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="3">
                      <input type="radio" name="time_of_examination" value="after_welding" <?= $report_detail['time_of_examination']=='after_welding' ? 'checked' : '' ?>>After Welding
                    </th>
                    <th colspan="3">
                      <input type="radio" name="time_of_examination" value="after_hydro" <?= $report_detail['time_of_examination']=='after_hydro' ? 'checked' : '' ?>>After Hydro-Test
                    </th>
                    <th colspan="3">
                      <input type="radio" name="time_of_examination" value="after_pwht" <?= $report_detail['time_of_examination']=='after_pwht' ? 'checked' : '' ?>>After PWHT
                    </th>
                    <th colspan="4">
                      <input type="radio" name="time_of_examination" value="others" <?= $report_detail['time_of_examination']=='others' ? 'checked' : '' ?>>Others
                      <input type="text" name="time_of_examination_others" value="<?= @$report_detail['time_of_examination_others'] ?>">
                      <input type="hidden" name="submission_id" value="<?= $list[0]['submission_id'] ?>">
                      <input type="hidden" name="drawing_no" value="<?= $list[0]['drawing_no'] ?>">
                      <input type="hidden" name="report_number" value="<?= $list[0]['report_number'] ?>">
                    </th>
                  </tr>

                  <tr>
                    <th colspan="3">Scope Examination</th>
                    <th colspan="1" class="align-middle">:</th>
                    <th colspan="3">
                      <input type="radio" name="scope_examintaion" <?= $report_detail['scope_examintaion']=='base_metal' ? 'checked' : '' ?> value="base_metal">Base Metal
                    </th>
                    <th colspan="3">
                      <input type="radio" name="scope_examintaion" <?= $report_detail['scope_examintaion']=='edge_prop' ? 'checked' : '' ?> value="edge_prop">Edge Prep
                    </th>
                    <th colspan="3">
                      <input type="radio" name="scope_examintaion" <?= $report_detail['scope_examintaion']=='back_chipping' ? 'checked' : '' ?> value="back_chipping">Back Chipping
                    </th>
                    <th colspan="4"></th>
                  </tr>
                  <tr>
                    <th colspan="4"></th>
                    <th colspan="3">
                      <input type="radio" name="scope_examintaion" <?= $report_detail['scope_examintaion']=='weld_part' ? 'checked' : '' ?> value="weld_part">Weld Part
                    </th>
                    <th colspan="3">
                      <input type="radio" name="scope_examintaion" <?= $report_detail['scope_examintaion']=='repair_weld' ? 'checked' : '' ?> value="repair_weld">Repair Weld
                    </th>
                    <th colspan="7">
                      <input type="radio" name="scope_examintaion" <?= $report_detail['scope_examintaion']=='others' ? 'checked' : '' ?> value="others">Others
                      <input type="text" name="scope_examintaion_others" value="<?= @$report_detail['scope_examintaion_others'] ?>">
                    </th>
                  </tr>
                  <tr>
                    <th rowspan="2" class="align-middle text-center">S/N</th>
                    <th rowspan="2" class="align-middle text-center">Weld Map Dwg / Line & Spool No</th>
                    <th rowspan="2" class="align-middle text-center">Joint No</th>
                    <th rowspan="2" class="align-middle text-center">Joint Type</th>
                    
                    <th rowspan="2" class="align-middle text-center">
                    <?php if($list_detail[0]['discipline']==1){
                      echo "Size";
                    } else {
                      echo "Dia";
                    } ?>  
                    </th>
                    
                    <th rowspan="2" class="align-middle text-center">Sch</th>
                    <th rowspan="2" class="align-middle text-center">Thk (mm)</th>
                    <th rowspan="2" class="align-middle text-center">Total Length (mm)</th>
                    <th rowspan="2" class="align-middle text-center">Tested Length (mm)</th>
                    <th rowspan="2" class="align-middle text-center">Welding Process</th>
                    <th rowspan="2" class="align-middle text-center">Welder ID</th>
                    <th rowspan="2" class="align-middle text-center">Result</th>
                    <th colspan="3" class="align-middle text-center" rowspan="1">Type of Discontinuites</th>
                    <th rowspan="2" class="align-middle text-center">Inspection Category</th>
                    <th rowspan="2" class="align-middle text-center">Remarks</th>
                  </tr>

                  <tr>
                    <th rowspan="1" class="align-middle text-center">Deffect Length (mm)</th>
                    <th rowspan="1" class="align-middle text-center">Deffect Type</th>
                    <th rowspan="1" class="align-middle text-center">Distance from Datum (mm)</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; foreach ($joint_list as $key => $value) {?>
                  <tr>
                    <td rowspan="<?= count($value) ?>" class="align-middle text-center">
                      <?= $no++ ?>
                    </td>

                    <td rowspan="<?= count($value) ?>" class="align-middle text-center"><?= $value[0]['drawing_wm'] ?></td>
                    <td rowspan="<?= count($value) ?>" class="align-middle text-center"><?= $value[0]['joint_no'].$value[0]['revision_category'].$value[0]['revision'] ?></td>
                    <td rowspan="<?= count($value) ?>" class="align-middle text-center"><?= $joint_type[$value[0]['joint_type']] ?></td>
                    <td rowspan="<?= count($value) ?>" class="align-middle text-center"><?= $value[0]['diameter'] ?></td>
                    <td rowspan="<?= count($value) ?>" class="align-middle text-center"><?= $value[0]['sch'] ?></td>
                    <td rowspan="<?= count($value) ?>" class="align-middle text-center"><?= (int)$value[0]['thk'] ?></td>
                    <td rowspan="<?= count($value) ?>" class="align-middle text-center"><?= $value[0]['total_length'] ?></td>

                    <td rowspan="<?= count($value) ?>"class="align-middle text-center"><?= $value[0]['tested_length'] ?></td>

                    <td rowspan="<?= count($value) ?>"class="align-middle text-center">
                    <?php 
                      $value[0]['gtaw'] == 1 ? print_r(strtoupper("gtaw").', ') : '';
                      $value[0]['gmaw'] == 1 ? print_r(strtoupper("gmaw").', ') : '';
                      $value[0]['smaw'] == 1 ? print_r(strtoupper("smaw").', ') : '';
                      $value[0]['fcaw'] == 1 ? print_r(strtoupper("fcaw").', ') : '';
                      $value[0]['saw'] == 1 ? print_r(strtoupper("saw").', ') : '';
                    ?>    
                    </td>

                    <td rowspan="<?= count($value) ?>"class="align-middle text-center">
                      <?php  
                        $welder = explode(';', $value[0]['welder']);
                        foreach ($welder as $key => $value_welder) {
                          print_r($welder_id[$value_welder].', ');
                        }
                      ?>
                    </td>

                    <td rowspan="<?= count($value) ?>" class="align-middle text-center">
                      <?= $value[0]['result']==3 ? 'Approved' : ( $value[0]['result']==2 ? 'Rejected' : '-') ?>
                    </td>

                    <?php foreach($value as $d): ?>
                      <td class="align-middle text-center"><?= $d['deffect_length'] ?></td>
                      <td class="align-middle text-center"><?= $ctq_initial[$d['id_deffect']] ?></td>
                      <td class="align-middle text-center"><?= $d['datum'] ?></td>
                      <td class="align-middle text-center"><?= $class[$d['class']] ?></td>
                      <td class="align-middle text-center"></td>
                    </tr>
                  <?php endforeach; ?>

                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <div>
                <?php if(!in_array($list_detail[0]['smoe_approval_status'], [1,3])){ ?>
                  <textarea class="form-control" placeholder="Note" name="note_report"><?= $report_detail['note'] ?></textarea>
                  <br>
                <?php } ?>
              </div>

              <div class="text-right">
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
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>

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

      <?php if(!in_array($condition, ['approval_client', 'approval'])){ ?>
      <div class="col-md-12">
        <div class="my-3 p-3 bg-white rounded shadow-sm">
          <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
          <div class="overflow-auto media text-muted pt-3 mt-1 border-top border-gray">
            <div class="container-fluid">

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Drawing Number</label>
                    <input type="text" class="form-control" name="drawing_no" id="drawing_no" value="<?= $list[0]['drawing_no'] ?>" autocomplete="off" readonly>
                    <span id="text_alert"></span>
                  </div>
                </div>
              </div>

             
              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Discipline</label>
                    <input type="text" class="form-control" name="discipline_name" readonly required value="<?= $discipline_list[$list[0]['discipline']]['discipline_name'] ?>">
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Module</label>
                    <input type="text" class="form-control" name="module_name" readonly required value="<?= $module_list[$list[0]['module']]['mod_desc'] ?>">
                  </div>
                </div>
              </div>

              
              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Date of Inspection</label>
                    <input type="text" name="technique" class="form-control" value="<?= DATE('Y-m-d', strtotime($list[0]['date_of_inspection'])); ?>" readonly>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>NDT Report No</label>
                    <input type="text" name="ndt_report_number" class="form-control" value="<?= $project[$list_detail[0]['project_code']]['project_ref'].'-OCP-SMO-'.strtoupper($type_of_module_list[$list_detail[0]['type_of_module']]['code']).'-'.strtoupper($discipline_list[$list_detail[0]['discipline']]['initial']).'-NDT-'.$initial.'-'.str_pad($list_detail[0]['report_number'],4,0, STR_PAD_LEFT) ?>" required>
                  </div>
                </div>
              </div>

              <div class="row" style="margin-bottom: 0cm !important">
                <div class="col-md">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <table width="500px">
                        <tr>
                          <?php if(!in_array($list_detail[0]['smoe_approval_status'],[1,3])){ ?>
                          <td style="padding:10px;">Change Date of Inspection</td>
                          <td style="padding:10px;">:</td>
                          <td style="padding:10px;"><input type='date' name='approval_date' class="form-control" required="" value='<?= $date_of_inspection ?>' onchange="update_inspectiondate('<?= $list[0]['report_number'] ?>', '<?= $list[0]['drawing_no'] ?>')"></td>
                          <?php } ?>
                          <script type="text/javascript">
                            function update_inspectiondate(report_number,drawing_no){

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
                                    success: function(data){
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

                    <?php if(!in_array($list_detail[0]['smoe_approval_status'],[1,3])){ ?>
                    <!-- <button class="btn btn-warning font-weight-bold" onclick="update_report_number('<?= $list[0]['report_number'] ?>', '<?= $list[0]['drawing_no'] ?>')">Change Report Number</button> -->
                    <?php } ?>
                    <script type="text/javascript">
                      function update_report_number(last_rn, drawing_no){
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

                          if(result.value) {

                            $.ajax({
                              url: "<?= base_url('ndt/change_report_number/').$initial ?>",
                              type: "post",
                              data: {
                                'new_report_no': new_report_no,
                                'old_report_no': last_rn,
                                'drawing_no': drawing_no,
                                'submission_id': '<?= $list[0]['submission_id'] ?>'
                              },
                              success: function(data){
                                Swal.fire(
                                  'Report Number Has Been Updated !',
                                  '',
                                  'success'
                                ).then(function(){                
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
                    <input type="checkbox" name="" value="1" class="custom-control-input pwht_check" id="customCheck1" <?= $data_radiographic_joint[0]['pwht']==1 ? 'checked' : ''; ?>>
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
                        <button class="btn attachment_minimize text-white" type="button"><i class="fa fa-minus"></i></button>
                          Drawing Number : <span><?= $drawing_no ?></span>
                        </h6>
                        <!-- <div class="text-right p-3" name="<?php echo $drawing_no ?>_joint" id="tambahdrawingjoint">
                          <button type="button" class="btn btn-success" title="Add Attachment" onclick="add_attachment()"><i class="fa fa-plus"></i>&nbsp; Add Joint</button>
                        </div> -->
                      <div class="col-md-12">
                        <table class="table table-hover text-muted" id='table_attachment'>

                          <?php if(!in_array($list_detail[0]['smoe_approval_status'],[1,3])){ ?>
                          <div>
                            <br>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                              <i class="fas fa-plus"></i>
                               Add Joint
                            </button>
                            <br>
                            <br>
                          </div>
                          <?php } ?>

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
                              <td><?= $value['joint_no'].($value['revision']>0 ? '('.$value['revision_category'].$value['revision'].')' : '') ?></td>

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
                                  <?php if(!in_array($list_detail[0]['smoe_approval_status'],[1,3])){ ?>
                                  <div class="input-group mb-3">
                                    <select id='ctq_id_<?= $value["id"]; ?>' class="form-control">
                                      <option value="">-----</option>                                          
                                      <?php foreach ($master_data_ctq as $valuex) { ?>                                           
                                        <option value="<?php echo $valuex['id']; ?>"><?php echo $valuex["ctq_description"]; ?> ( <?php echo $valuex["ctq_initial"]; ?> )</option>                                            
                                      <?php } ?>                     
                                    </select>
                                    <input type='number' step='any'  class='form-control ctq_rejected' id='ctq_length_<?= $value["id"]; ?>' placeholder='Type Deffect Length'>
                                    <input type='number' step='any'  class='form-control ctq_rejected' id='ctq_datum_<?= $value["id"]; ?>' placeholder='Distance from Datum'>
                                    <input type="text" class='form-control welder_<?= $key ?>' name="welder" id='welder_<?= $value["id"]; ?>' placeholder='Welder' onfocus="welder_autocomplete('<?= $key ?>');">
                                    <select id='planarity_<?= $value["id"]; ?>' class="form-control planarity_<?= $value["id"]; ?>">
                                      <option value="0">Non-Planar</option>
                                      <option value="1">Planar</option>
                                    </select>

                                    <div class="input-group-prepend">
                                      <button type="button" class='btn btn-warning' onclick="add_ctq_in_process('<?= $value["id"] ?>')"><i class="fas fa-save"></i></button>
                                      <script type="text/javascript">
                                        function add_ctq_in_process(id_detail){

                                          var val_ctq_id_detail     = "ctq_id_"+id_detail;
                                          var val_ctq_length_detail = "ctq_length_"+id_detail;
                                          var val_ctq_datum_detail = "ctq_datum_"+id_detail;
                                          var val_ctq_wel = "welder_"+id_detail;
                                          var val_ctq_planar = "planarity_"+id_detail;

                                          var val_id_detail      = id_detail;
                                          var val_ctq_id         = $('#'+val_ctq_id_detail).val();
                                          var val_ndt_type       = '<?= $initial; ?>'; 
                                          var val_repair_length  = $('input[id='+val_ctq_length_detail+']').val();
                                          var val_datum          = $('input[id='+val_ctq_datum_detail+']').val();

                                          var val_welder         = $('input[id='+val_ctq_wel+']').val();
                                          var val_planar         = $('.'+val_ctq_planar).val();

                                          console.log(val_ctq_planar);
                                          console.log(val_ctq_wel);
                                          console.log(val_planar);
                                          console.log(val_welder);

                                          if(val_repair_length > 0 && val_ctq_id > 0){

                                            $.ajax({
                                                url: "<?php echo base_url();?>ndt/add_ctq_process",
                                                type: "post",
                                                data: {
                                                  ndt_type: val_ndt_type,
                                                  id_detail: val_id_detail,
                                                  ctq_id: val_ctq_id,
                                                  welder: val_welder,
                                                  repair_length: val_repair_length,
                                                  datum: val_datum,
                                                  planarity_status : val_planar,
                                                  submission_id : '<?= $list[0]['submission_id'] ?>',
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
                                  <?php } ?>
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
                                        <td>".$data_ctq['datum']." MM</td>
                                        <td>".(isset($data_ctq['welder']) ?  $weld_name[$data_ctq['welder']] :  "-").'</td>
                                        <td>'.($data_ctq['planarity']==1 ? 'Planar' : 'Non-Planar')."</td><td>"
                                        ;?>
                                          <?php if(!in_array($list_detail[0]['smoe_approval_status'],[1,3])){ ?>
                                          <button class="btn btn-danger" type="button" onclick='delete_ctq_data("<?= $data_ctq['id'] ?>")'><i class="fa fa-trash"></i></button>
                                          <?php } ?>
                                        <?php echo "</td>
                                        </tr>";
                                      }
                                    } 

                                    echo "</table>";                                  
                                  }
                                ?>  
                                <script type="text/javascript">
                                  function welder_autocomplete(no){
                                    $('.welder_'+no).autocomplete({
                                      source: function(request,response){
                                        $.post('<?php echo base_url(); ?>ndt/welder_autocomplete',{term: request.term}, response, 'json');
                                      },
                                      autoFocus: true,
                                      classes: {
                                        "ui-autocomplete": "highlight"
                                      }
                                    });
                                  }

                                  function delete_ctq_data(id){
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
                                <?php if(!in_array($list_detail[0]['smoe_approval_status'],[1,3])){ ?>
                                <button class="btn btn-danger" onclick="delete_joint_on_dtail('<?= $value["id"] ?>','<?= $value["submission_id"] ?>')">
                                  <i class="fas fa-trash"></i>
                                   Joint
                                </button>
                                <?php } ?>
                              </td>
                              <script type="text/javascript">
                                function delete_joint_on_dtail(id,uniq_data){
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
                                          if(data.includes("Error")){
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

                        <form action="<?php echo base_url('ndt/upload_new_attachment/').$ndt_code;?>" method="post" enctype="multipart/form-data">
                          <div class="row">
                            <div class="col-md">
                              <div class="form-group">
                                <label>Remarks Data :</label>
                                <textarea name='remarks' class='form-control' required=""></textarea>
                                <input type="hidden" class="form-control" name="submission_id" id="uniq_data" value="<?= $list[0]['submission_id'] ?>" autocomplete="off" readonly>
                                <input type="hidden" class="form-control" name="report_number" id="uniq_data" value="<?= $list[0]['report_number'] ?>" autocomplete="off" readonly>
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
                        <button class="btn attachment_minimize text-white" type="button"><i class="fa fa-minus"></i></button>
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
                                  <a href="<?= base_url('upload/ndt/').$value["filename"] ?>"><?php echo $value["filename"] ?></a>
                                </td>
                                <td><?php echo $user_list[$value["created_by"]]['full_name'] ?></td>
                                <td><?php echo $value["created_date"] ?></td>
                                <td><?php echo $value["remarks"] ?></td>
                                <td><button class="btn btn-danger" type="button" onclick="delete_attachment_on_update('<?= $value["id"] ; ?>','<?= $value["uniq_data"]; ?>')"><i class="fa fa-trash"></i></button></td>
                                </tr>
                              <?php } ?>
                              <script type="text/javascript">
                                function delete_attachment_on_update(id,uniq_data){
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
                                            ndt : '<?= $initial ?>',
                                            id: id,
                                            uniq_data: uniq_data,
                                          },
                                          success: function(data) {
                                          if(data.includes("Error")){
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
              <!-- <div class="row" id="add_drawing_container">
                <div class="col-md-12">
                  <div class="overflow-auto media text-muted">
                    <div class="container-fluid text-right p-0">
                      <a href="<?= base_url() ?>radiographic_list/request"><button class="btn btn-secondary" type="button"><i class="fa fa-arrow-left"></i></a> 
                    </div>
                  </div>
                </div>
              </div> -->

            </div>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>

  </div>
</div><!-- ini div dari sidebar yang class wrapper -->

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form action="<?= base_url('ndt/add_detail') ?>" method="POST">
    <input type="hidden" name="ndt_report_number" class="form-control" value="<?= $list[0]['report_number'] ?>" required>
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
                  <td><?= $valueh['joint_no'].($valueh['revision']>0 ? '('.$valueh['revision_category'].$valueh['revision'].')' : '') ?></td>
                  <td>
                    <div class="form-check form-check-inline">
                      <label class="form-check-label text-success font-weight-bold">
                        <input class="form-check-input approve" type="radio" title="Approve" name="result[<?= $key ?>]" value="3" style="width: 17px; height: 17px"  onclick="repair_length('disable',<?= $key ?>)"> Approved</label>
                    </div>
                    <br>
                    <div class="form-check form-check-inline">
                      <label class="form-check-label text-danger font-weight-bold"><input class="form-check-input reject" type="radio" title="Reject" name="result[<?= $key ?>]" value="2" style="width: 17px; height: 17px"  onclick="repair_length('enable',<?= $key ?>)"> Rejected</label>
                    </div>
                  </td>
                  <td>
                    <input type="checkbox" name="choosen[<?= $key ?>]" class="" value="1">
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

<script type="text/javascript">
  $('.table_modal').DataTable({

  });
</script>