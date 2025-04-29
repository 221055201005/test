<?php 
  $main_data      = $list_detail[0];
  
  if($main_data['discipline']==1){
    $standard_code  = 'ASME B31.3';
  } else {
    $standard_code  = 'DNVGL-CG-0051 / BS EN ISO 17636-1';  
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

td {
  vertical-align: middle !important;
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
                  <h6 class="card-title"> NDT - <strong>Radiographic</strong></h6>
                  <hr>
                </div>
                <div class="col-md-12 ">
                  <div class="table-responsive" id="content">
                    <table class="table table-bordered table-sm">
                      <tr>
                        <td colspan="16" class="text-center">
                          <img src="<?= base_url() ?>img/header_report.png">
                        </td>
                      </tr>
                      <tr>
                        <td colspan="16" class="text-center valign-middle">
                          <span style="font-size: 18px;"><strong>RADIOGRAPHIC TEST REPORT</strong></span>
                        </td>

                      </tr>
                      <tr>
                        <td class="valign-middle" colspan="3"><strong>CLIENT</strong></td>
                        <td class="valign-middle text-center" colspan="1"><strong>:</strong></td>
                        <td class="valign-middle" colspan="6"><strong><input type="text"
                              value="<?= $project[$main_data['project_code']]['client'] ?>" class="form-control"
                              disabled></strong>
                        </td>
                        <td class="valign-middle" colspan="3"><strong>REPORT NO.</strong></td>
                        <td class="valign-middle text-center" colspan="1"><strong>:</strong></td>
                        <td class="valign-middle" colspan="2"><strong><input type="text"
                              value="<?= $project[$list_detail[0]['project_code']]['project_ref'].'-OCP-SMO-'.strtoupper($type_of_module_list[$list_detail[0]['type_of_module']]['code']).'-'.strtoupper($discipline_list[$list_detail[0]['discipline']]['initial']).'-NDT-'.$initial.'-'.str_pad($list_detail[0]['report_number'],4,0, STR_PAD_LEFT) ?>" class="form-control" disabled></strong></td>
                      </tr>

                      <tr>
                        <td class="valign-middle" colspan="3"><strong>Project Name</strong></td>
                        <td class="valign-middle text-center" colspan="1"><strong>:</strong></td>
                        <td class="valign-middle" colspan="6"><strong><input type="text"
                              value="<?= $project[$main_data['project_code']]['project_name'] ?>" class="form-control"
                              disabled></strong>
                        </td>
                        <td class="valign-middle" colspan="3"><strong>RFI NO.</strong></td>
                        <td class="valign-middle text-center" colspan="1"><strong>:</strong></td>
                        <td class="valign-middle" colspan="2"><input type="text" name="" class="form-control"
                            value="<?= $project[$list_detail[0]['project_code']]['project_ref'].'-OCP-SMO-'.strtoupper($type_of_module_list[$list_detail[0]['type_of_module']]['code']).'-'.strtoupper($discipline_list[$list_detail[0]['discipline']]['initial']).'-NDT-RFI-'.$initial.'-'.str_pad($list_detail[0]['ndt_rfi'],4,0, STR_PAD_LEFT) ?>" disabled></td>
                      </tr>

                      <tr>
                        <td class="valign-middle" colspan="3"><strong>Standard / Code</strong></td>
                        <td class="valign-middle text-center" colspan="1"><strong>:</strong></td>
                        <td class="valign-middle" colspan="6"><strong><input type="text" value="<?= $standard_code ?>"
                              class="form-control" disabled></strong>
                        </td>
                        <td class="valign-middle" colspan="3"><strong>Date Of Inspection</strong></td>
                        <td class="valign-middle text-center" colspan="1"><strong>:</strong></td>
                        <td class="valign-middle" colspan="2"><input type="text"
                            value="<?= DATE('d F Y', strtotime($list[0]['date_of_inspection'])); ?>"
                            class="form-control" disabled></td>
                      </tr>

                      <tr>
                        <td class="valign-middle" colspan="3" rowspan="2"><strong>Acceptance Criteria</strong></td>
                        <td class="valign-middle text-center" colspan="1" rowspan="2"><strong>:</strong></td>
                        <td class="valign-middle" colspan="6">
                          <?php if($list[0]['discipline']==1){ ?>
                            <input class="form-control" type="text" name="acceptance_criteria" readonly="" value="ASME B31.3 Table 344.4.2">
                          <?php } else { ?>
                          <select class="form-control" name="acceptance_criteria" readonly>
                            <option>---</option>
                            <option value="ISO 5817 LEVEL B" <?= $list_detail[0]['class']==1 ? 'selected' : '' ?>>ISO 5817 LEVEL B</option>
                            <option value="ISO 5817 LEVEL C" <?= in_array($list_detail[0]['class'], [2, 3]) ? 'selected' : '' ?>>ISO 5817 LEVEL C</option>             
                          </select>
                          <?php } ?>
                        </td>
                        <td class="valign-middle" colspan="3" rowspan="2"><strong>Testing Location</strong></td>
                        <td class="valign-middle text-center" colspan="1" rowspan="2"><strong>:</strong></td>
                        <td class="valign-middle" colspan="2" rowspan="2"><select class="select2" style="width:100%"
                            name="testing_location">
                            <option value="0">---</option>
                            <?php foreach ($master_location as $key => $value_loc) { ?>
                            <option value="<?= $value_loc['id'] ?>"
                              <?= $value_loc['id'] == $report_detail['testing_location'] ? 'selected' : '' ?>>
                              <?= $value_loc['location_name'] ?>
                            </option>
                            <?php } ?>
                          </select></td>
                      </tr>

                      <tr>
                        <td class="valign-middle" colspan="6">
                          <?php if($list[0]['discipline']==1){ ?>
                            <input class="form-control" type="text" name="acceptance_criteria" readonly="" value="ASME B31.3 Table 344.4.2">
                          <?php } else { ?>
                          <select class="form-control" name="acceptance_criteria" readonly>
                            <option>---</option>
                            <option value="ISO 10675-1 ACCEPTANCE LEVEL 1" <?= $list_detail[0]['class']==1 ? 'selected' : '' ?>>ISO 10675-1 ACCEPTANCE LEVEL 1</option>
                            <option value="ISO 10675-1 ACCEPTANCE LEVEL 2" <?= in_array($list_detail[0]['class'], [2, 3]) ? 'selected' : '' ?>>ISO 10675-1 ACCEPTANCE LEVEL 2</option>             
                          </select>
                          <?php  } ?>
                        </td>
                      </tr>

                      <tr>
                        <td class="valign-middle" colspan="3"><strong>Procedure No.</strong></td>
                        <td class="valign-middle text-center" colspan="1"><strong>:</strong></td>
                        <td class="valign-middle" colspan="6"><strong><input type="text" value="SCM-SOF-SMOE-23-PR-0009"
                              class="form-control" disabled></strong>
                        </td>
                        <td class="valign-middle" colspan="3"><strong>Job No.</strong></td>
                        <td class="valign-middle text-center" colspan="1"><strong>:</strong></td>
                        <td class="valign-middle" colspan="2"><input class="form-control" type="text" name="job_no"
                            value="<?= @$report_detail['job_no'] ?>"></td>
                      </tr>

                      <tr>
                        <td class="valign-middle" colspan="3"><strong>GA/ASSY/ISOMETRIC Drawing No.</strong></td>
                        <td class="valign-middle text-center" colspan="1"><strong>:</strong></td>
                        <td class="valign-middle" colspan="4"><strong><input type="text" name="" class="form-control"
                              value="<?= $list[0]['drawing_no'] ?>" disabled></strong>
                        </td>
                        <td class="valign-middle"><strong>Rev.</strong></td>
                        <td class="valign-middle" colspan="1"><input type="text" name="" class="form-control"></td>
                        </td>
                        <td class="valign-middle" colspan="3"><strong>Grade Material</strong></td>
                        <td class="valign-middle text-center" colspan="1"><strong>:</strong></td>
                        <td class="valign-middle" colspan="2"><input class="form-control" type="text"
                            name="grade_material" value="<?= @$report_detail['grade_material'] ?>"></td>
                      </tr>

                      <tr>
                        <td class="valign-middle" rowspan="2" colspan="3">
                          <strong>Job Description</strong>
                        </td>
                        <td class="valign-middle text-center" rowspan="2" colspan="1"><strong>:</strong></td>

                        <td class="valign-middle" rowspan="2" colspan="6">
                          <textarea class="form-control" name="job_description"
                            rows="3"><?= @$report_detail['job_description'] ?></textarea>
                        </td>
                        <td class="valign-middle" colspan="3"><strong>Delivery Condition</strong></td>
                        <td class="valign-middle text-center" colspan="1"><strong>:</strong></td>
                        <td class="valign-middle" colspan="2"><input class="form-control" type="text"
                            name="delivery_condition" value="<?= @$report_detail['delivery_condition'] ?>"></td>
                      </tr>
                      <tr>
                        <td class="valign-middle" colspan="3"><strong>PWHT Status</strong></td>
                        <td class="valign-middle text-center" colspan="1"><strong>:</strong></td>
                        <td class="valign-middle" colspan="2"><input class="form-control" type="text"
                            name="pwht_status" value="<?= @$report_detail['pwht_status'] ?>"></td>
                      </tr>
                      <tr>
                        <td class="text-center" colspan="6" style="background-color: white;">
                          
                        </td>

                        <td class="text-center" colspan="5"><strong>RADIATION SOURCE</strong></td>
                        <td class="text-center" colspan="6"><strong>EXPOSURE TECHNIQUE SKETCH</strong></td>
                      </tr>
                      <tr>
                        <?php  
                          $isotop_op = explode(';', $report_detail['isotope']);
                          //test_var($isotop_op);
                        ?>
                        <td colspan="6" rowspan="4" style="background-color: white;"></td>
                        <td><strong>Isotope</strong></td>
                        <td class="text-center">:</td>
                        <td>Ir-192 <input type="checkbox" name="isotope_1" value="Ir-192" <?= in_array('Ir-192', $isotop_op) ? 'checked' : ''; ?>></td>
                        <td></td>
                        <td>Co-60 <input type="checkbox" name="isotope_2" value="Co-60" <?= in_array('Co-60', $isotop_op) ? 'checked' : ''; ?>></td>

                        <td rowspan="6" colspan="3">
                          <img src="<?= base_url() ?>img/Panoramic - SWSV.jpg">
                          <br>
                          Panoramic / SWSV<input type="checkbox" name="image_radio[]" value='IMAGE_1' <?= in_array('IMAGE_1',explode(';', $report_detail['image_radio'])) ? 'checked' : '' ?>></td>

                        <td rowspan="6" colspan="3">
                          <img src="<?= base_url() ?>img/SWSV-2.jpg">
                          <br>
                          SWSV <input type="checkbox" name="image_radio[]" value='IMAGE_2' <?= in_array('IMAGE_2',explode(';', $report_detail['image_radio'])) ? 'checked' : '' ?>></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td>Other <input type="checkbox" name="isotope_3" value="Other" <?= in_array('Other', $isotop_op) ? 'checked' : ''; ?>></td>
                        <td colspan="2"><input type="text" name="isotope_other" class="form-control isotope_other" value="<?= @$report_detail['isotope_other'] ?>"></td>
                      </tr>
                      <tr>
                        <td><strong>Activity</strong></td>
                        <td class="text-center">:</td>
                        <td>Ci <input type="checkbox" name="ci" value="ci" <?= @$report_detail['ci']=='ci' ? 'checked' : '' ?>></td>
                        <td colspan="2">
                          <div class="form-group row">
                            <label for="" class="col-xl-2 col-form-label"> Kv : </label>
                            <div class="col-xl">
                              <input type="text" name="kv" class="form-control float-right" value="<?= @$report_detail['kv'] ?>">
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td><strong>Current A</strong></td>
                        <td class="text-center">:</td>
                        <td colspan="3"><input type="text" name="current_a" class="form-control" value="<?= @$report_detail['current_a'] ?>"></td>
                      </tr>
                      <tr>
                        <td class="text-center" colspan="6" rowspan="2"><strong>PART</strong></td>
                        <td><strong>Size / Focal Spot</strong></td>
                        <td class="text-center">:</td>
                        <td colspan="2">
                          <input type="text" name="size_focal_spot" value="<?= @$report_detail['size_focal_spot'] ?>" class="form-control">
                        </td>
                        <td>mm </td>
                      </tr>
                      <tr>
                        <td class="text-center" colspan="5" rowspan="2"><strong>TECHNIQUE</strong></td>
                      </tr>
                      <tr>
                        <td colspan="2"><strong>Name</strong></td>
                        <td class="text-center">:</td>
                        <td colspan="2"><input type="text" name="part_name" class="form-control" value="<?= @$report_detail['part_name'] ?>"></td>
                        <td></td>
                        <td rowspan="7" colspan="3">
                          <img src="<?= base_url() ?>img/SWSV.jpg">
                          <br>
                          SWSV <input type="checkbox" name="image_radio[]" value='IMAGE_3' <?= in_array('IMAGE_3',explode(';', $report_detail['image_radio'])) ? 'checked' : '' ?>></td>
                        <td rowspan="7" colspan="3">
                          <img src="<?= base_url() ?>img/DWSV-1.jpg">
                          <br>
                          DWSV <input type="checkbox" name="image_radio[]" value='IMAGE_4' <?= in_array('IMAGE_4',explode(';', $report_detail['image_radio'])) ? 'checked' : '' ?>></td>
                      </tr>

                      <tr>
                        <td colspan="6"></td>
                        <?php  
                          $rt_kelas = explode(';', $report_detail['rt_class']);
                        ?>
                        <td>
                          <strong>RT CLASS A</strong> <input type="checkbox" name="rt_class_a" value="A" <?= in_array('A',$rt_kelas) ? 'checked' : '' ?>>
                        </td>
                        <td class="text-nowrap">
                          <strong>RT CLASS B</strong> <input type="checkbox" name="rt_class_b" value="B" <?= in_array('B',$rt_kelas) ? 'checked' : '' ?>>
                        </td>
                        <td colspan="3"></td>
                      </tr>

                      <tr>
                        <td colspan="2"><strong>Size / ID / OD</strong></td>
                        <td class="text-center">:</td>
                        <td colspan="2">
                          <input type="text" name="part_size" class="form-control" value="<?= @$report_detail['part_size'] ?>"></td>
                        <td><strong>mm/inch</strong></td>
                        <td><strong>Geometric Unsharpness</strong></td>
                        <td class="text-center">:</td>
                        <td colspan="3">
                          <input type="text" name="geometric_unsharpness" class="form-control" value="<?= @$report_detail['geometric_unsharpness'] ?>"></td>
                      </tr>

                      <tr>
                        <td colspan="6"></td>
                        <td><strong>SFD</strong></td>
                        <td class="text-center">:</td>
                        <td colspan="3"><input type="text" name="sfd" class="form-control" value="<?= @$report_detail['sfd'] ?>"></td>
                      </tr>

                      <tr>
                        <td colspan="2"><strong>Sch</strong></td>
                        <td class="text-center">:</td>
                        <td colspan="2"><input type="text" name="part_sch" class="form-control" value="<?= @$report_detail['part_sch'] ?>"></td>
                        <td></td>
                        <td colspan="5" rowspan="2"></td>


                      </tr>

                      <tr>
                        <td colspan="6"></td>
                      </tr>

                      <tr>
                        <td colspan="2"><strong>Mat'l Type</strong></td>
                        <td class="text-center">:</td>
                        <td colspan="2"><input type="text" name="part_mat_type" class="form-control" value="<?= @$report_detail['part_mat_type'] ?>"></td>
                        <td></td>
                        <td><strong>Exposure</strong></td>
                        <td class="text-center">:</td>
                        <td colspan="3">
                          <?php $exposures = explode(';', $report_detail['exposure']) ?>
                          <strong>Single Wall</strong> <input type="checkbox" name="exposure_1" value="Single Wall" <?= in_array('Single Wall', $exposures) ? 'checked' : '' ?>>
                          <strong>Double Wall</strong> <input type="checkbox" name="exposure_2" value="Double Wall" <?= in_array('Double Wall', $exposures) ? 'checked' : '' ?>>
                        </td>
                      </tr>

                      <tr>
                        <td colspan="6"></td>
                        <td colspan="5"></td>
                        <td rowspan="6" colspan="3">
                          <img src="<?= base_url() ?>img/DWSV.jpg">
                          <br>
                          DWSV <input type="checkbox" name="image_radio[]" value='IMAGE_5' <?= in_array('IMAGE_5',explode(';', $report_detail['image_radio'])) ? 'checked' : '' ?>></td>
                        <td rowspan="6" colspan="3">
                          <img src="<?= base_url() ?>img/DWDV.jpg">
                          <br>
                          DWDV <input type="checkbox" name="image_radio[]" value='IMAGE_6' <?= in_array('IMAGE_6',explode(';', $report_detail['image_radio'])) ? 'checked' : '' ?>></td>
                      </tr>

                      <tr>
                        <td colspan="2"><strong>Mat'l Thk</strong></td>
                        <td class="text-center">:</td>
                        <td colspan="2"><input type="text" name="part_mat_thk" class="form-control" value="<?= @$report_detail['part_mat_thk'] ?>"></td>
                        <td class="text-nowrap">
                          <strong>In</strong> <input type="radio" name="part_mat_thk_uom" value="In" <?= $report_detail['part_mat_thk_uom']=='In' ? 'checked' : '' ?>>
                          <strong>mm</strong> <input type="radio" name="part_mat_thk_uom" value="mm" <?= $report_detail['part_mat_thk_uom']=='mm' ? 'checked' : '' ?>>
                        </td>

                        <td><strong>Viewing</strong></td>
                        <td class="text-center">:</td>
                        <td colspan="3">
                          <?php //test_var($report_detail['viewing_condition'], 1) ?>
                          <strong>Single Wall</strong> <input type="checkbox" name="viewing_condition[]" value="Single" <?= in_array('Single',explode(';', $report_detail['viewing_condition'])) ? 'checked' : '' ?>>
                          <strong>Double Wall</strong> <input type="checkbox" name="viewing_condition[]" value="Double" <?= in_array('Double',explode(';', $report_detail['viewing_condition'])) ? 'checked' : '' ?>>
                        </td>




                      </tr>

                      <tr>
                        <td colspan="6"></td>
                        <td colspan="5"></td>

                      </tr>

                      <tr>
                        <td colspan="2"><strong>Weld Thk</strong></td>
                        <td class="text-center">:</td>
                        <td colspan="2"><input type="text" name="part_weld_thk" class="form-control" value="<?= @$report_detail['part_weld_thk'] ?>"></td>
                        <td class="text-nowrap">
                          <strong>In</strong> <input type="radio" name="part_weld_thk_uom" value="In" <?= $report_detail['part_weld_thk_uom']=='In' ? 'checked' : '' ?>>
                          <strong>mm</strong> <input type="radio" name="part_weld_thk_uom" value="mm" <?= $report_detail['part_weld_thk_uom']=='mm' ? 'checked' : '' ?>>
                        </td>

                        <td><strong>Exposure Time</strong></td>
                        <td class="text-center">:</td>
                        <td colspan="2">
                          <input type="text" name="exposure_time" class="form-control" value="<?= @$report_detail['exposure_time'] ?>">
                        </td>
                        <td>
                          Mnt 
                          <!-- <input type="radio" name="mnt" value="mnt"> -->
                        </td>


                      </tr>

                      <tr>
                        <td colspan="6"></td>
                        <td colspan="5"></td>

                      </tr>

                      <tr>
                        <td colspan="2"><strong>Reinforc Thk</strong></td>
                        <td class="text-center">:</td>
                        <td colspan="2"><input type="text" name="part_reinforce_thk" class="form-control" value="<?= @$report_detail['part_reinforce_thk'] ?>"></td>
                        <td class="text-nowrap">
                          <strong>In</strong> <input type="radio" name="part_reinforce_thk_uom" value="In" <?= $report_detail['part_reinforce_thk_uom']=='In' ? 'checked' : '' ?>>
                          <strong>mm</strong> <input type="radio" name="part_reinforce_thk_uom" value="mm" <?= $report_detail['part_reinforce_thk_uom']=='mm' ? 'checked' : '' ?>>
                        </td>

                        <td><strong>Min. SOD*</strong></td>
                        <td class="text-center">:</td>
                        <td colspan="1">
                          <input type="text" name="min_sod" class="form-control" value="<?= @$report_detail['min_sod'] ?>">
                        </td>
                        <td><strong>Min. DDSOF** : </strong></td>
                        <td colspan="1">

                          <div class="form-group form-inline">
                            <input type="text" name="min_ddsof" class="form-control" style="width:80%" value="<?= @$report_detail['min_ddsof'] ?>">
                            <label> mm</label>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="6"></td>
                        <td colspan="5"></td>
                        <td rowspan="6" colspan="3">
                          <img src="<?= base_url() ?>img/Superimpose.png">
                          <br>
                          DWDV <input type="checkbox" name="image_radio[]" value='IMAGE_7' <?= in_array('IMAGE_7',explode(';', $report_detail['image_radio'])) ? 'checked' : '' ?>></td>
                        <td rowspan="6" colspan="3">Others <input type="checkbox" name="image_radio[]" value='IMAGE_8' <?= in_array('IMAGE_8',explode(';', $report_detail['image_radio'])) ? 'checked' : '' ?>></td>
                      </tr>

                      <tr>
                        <td colspan="2"><strong>Backing Ring</strong></td>
                        <td class="text-center">:</td>
                        <td colspan="2">
                        <td class="text-nowrap">
                          <strong>Yes</strong> <input type="radio" name="backing_ring" value="Yes" <?= $report_detail['backing_ring']=='Yes' ? 'checked' : '' ?>>
                          <strong>No</strong> <input type="radio" name="backing_ring" value="No" <?= $report_detail['backing_ring']=='No' ? 'checked' : '' ?>>
                        </td>

                        <td><strong>No of Film in Holder</strong></td>
                        <td class="text-center">:</td>
                        <td colspan="3">

                          <strong>Single </strong> <input type="checkbox" name="film_in_holder[]" value="Single" <?= in_array('Single',explode(';', $report_detail['film_in_holder'])) ? 'checked' : '' ?>>
                          <strong>Multiple </strong> <input type="checkbox" name="film_in_holder[]" value="Multiple" <?= in_array('Multiple',explode(';', $report_detail['film_in_holder'])) ? 'checked' : '' ?>>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center" colspan="6"><strong>FILM</strong></td>

                        <td class="text-center" colspan="5"><strong>IMAGE QUALITY INDICATOR ( IQI )</strong>
                        </td>
                      </tr>

                      <tr>
                        <td colspan="2"><strong>Manufacture's</strong></td>
                        <td>:</td>
                        <td colspan="2"><input type="text" name="film_manufacture" class="form-control" value="<?= @$report_detail['film_manufacture'] ?>"></td>
                        <td></td>
                        <td colspan="5"><strong>Type of Penetrameter</strong></td>
                      </tr>

                      <tr>
                        <td colspan="2"><strong>Type of Film</strong></td>
                        <td>:</td>
                        <td colspan="2"><input type="text" name="film_type" class="form-control" value="<?= @$report_detail['film_type'] ?>"></td>
                        <td></td>
                        <td colspan="1">
                          <strong>ASTM </strong> <input type="checkbox" name="penetrant[]" value="ASTM" <?= in_array('ASTM',explode(';', $report_detail['penetrant'])) ? 'checked' : '' ?>>
                        </td>
                        <td colspan="4">
                          <strong>EN / DIN </strong> <input type="checkbox" name="penetrant[]" value="EN / DIN" <?= in_array('EN / DIN',explode(';', $report_detail['penetrant'])) ? 'checked' : '' ?>>
                        </td>
                      </tr>

                      <tr>
                        <td colspan="2"><strong>Dimension</strong></td>
                        <td>:</td>
                        <td><input type="text" name="film_dimension_1" class="form-control" value="<?= @$report_detail['film_dimension_1'] ?>"></td>
                        <td>x</td>
                        <td><input type="text" name="film_dimension_2" class="form-control" value="<?= @$report_detail['film_dimension_2'] ?>"></td>
                        <td colspan="1">
                          <strong>Wire </strong> <input type="checkbox" name="wire_no[]" value="0" <?= in_array('0',explode(';', $report_detail['wire_no'])) ? 'checked' : '' ?>>
                        </td>
                        <td colspan="4">
                          <strong>No : </strong>
                          <strong>1</strong> <input type="checkbox" name="wire_no[]" value="1" <?= in_array('1',explode(';', $report_detail['wire_no'])) ? 'checked' : '' ?>>
                          &nbsp;&nbsp;
                          <strong>2</strong> <input type="checkbox" name="wire_no[]" value="2" <?= in_array('2',explode(';', $report_detail['wire_no'])) ? 'checked' : '' ?>>
                          &nbsp;&nbsp;
                          <strong>3</strong> <input type="checkbox" name="wire_no[]" value="3" <?= in_array('3',explode(';', $report_detail['wire_no'])) ? 'checked' : '' ?>>
                          &nbsp;&nbsp;
                          <strong>4</strong> <input type="checkbox" name="wire_no[]" value="4" <?= in_array('4',explode(';', $report_detail['wire_no'])) ? 'checked' : '' ?>>
                          &nbsp;&nbsp;
                          <strong>5</strong> <input type="checkbox" name="wire_no[]" value="5" <?= in_array('5',explode(';', $report_detail['wire_no'])) ? 'checked' : '' ?>>
                          &nbsp;&nbsp;
                          <strong>6</strong> <input type="checkbox" name="wire_no[]" value="6" <?= in_array('6',explode(';', $report_detail['wire_no'])) ? 'checked' : '' ?>>
                        </td>


                      <tr>
                        <td colspan="2"><strong>Type of Film</strong></td>
                        <td>:</td>
                        <td colspan="2"><input type="text" name="film_type_2" class="form-control" value="<?= @$report_detail['film_type_2'] ?>"></td>
                        <td></td>
                        <td colspan="5">
                        </td>
                        <td colspan="6">
                        </td>

                      </tr>

                      <tr>
                        <td colspan="2"><strong>Total of Film</strong></td>
                        <td>:</td>
                        <td colspan="2"><input type="text" name="film_total" class="form-control" value="<?= @$report_detail['film_total'] ?>"></td>
                        <td><strong>Sheet(s)</strong></td>
                        <td colspan="5">
                        </td>
                        <td colspan="6" class="text-center">
                          <strong>Notes For Sketch :</strong>
                        </td>

                      </tr>

                      <tr>
                        <td class="text-center" colspan="6" rowspan="2"><strong>SCREEN</strong></td>
                        <td><strong>Placement</strong></td>
                        <td class="text-center">:</td>
                        <td colspan="3">

                          <strong>Source Side</strong> <input type="checkbox" name="placement[]" value="Source Side" <?= in_array('Source Side',explode(';', $report_detail['placement'])) ? 'checked' : '' ?>>
                          &nbsp;&nbsp;&nbsp;&nbsp;
                          <strong>Film Side</strong> <input type="checkbox" name="placement[]" value="Film Side" <?= in_array('Film Side',explode(';', $report_detail['placement'])) ? 'checked' : '' ?>>
                        </td>
                        <td>1)</td>
                        <td class="text-nowrap"><strong>SWSV =</strong></td>
                        <td colspan="3"><strong></strong> Single Wall Single Viewing</td>

                      </tr>

                      <tr>
                        <td><strong>Block Thickness</strong></td>
                        <td class="text-center">:</td>
                        <td colspan="2">
                          <input type="text" name="block_thickness" class="form-control" value="<?= @$report_detail['block_thickness'] ?>">

                        </td>
                        <td><strong>mm</strong></td>
                        <td>2)</td>
                        <td class="text-nowrap"><strong>DWSV =</strong></td>
                        <td colspan="3"><strong></strong> Double Wall Single Viewing</td>
                      </tr>

                      <tr>
                        <td colspan="2"><strong>Lead</strong></td>
                        <td colspan="2">
                          <strong>Front</strong> <input type="radio" name="screen_lead" value="Front" <?= $report_detail['screen_lead']=='Front' ? 'checked' : '' ?>>
                        </td>
                        <td colspan="2">
                          <strong>Back</strong> <input type="radio" name="screen_lead" value="Back" <?= $report_detail['screen_lead']=='Back' ? 'checked' : '' ?>>
                        </td>
                        <td class="text-center" colspan="5" rowspan="2">
                          MARKER PLACEMENT
                        </td>
                        <td>3)</td>
                        <td class="text-nowrap"><strong>DWDV =</strong></td>
                        <td colspan="3"><strong></strong> Double Wall Double Viewing</td>
                      </tr>

                      <tr>
                        <td colspan="6"></td>

                        <td>4)</td>
                        <td class="text-nowrap"><strong>Other =</strong></td>
                        <td colspan="3"><strong></strong> Other than listed ( Please Sketch )</td>
                      </tr>

                      <tr>
                        <td colspan="2"><strong>Thickness</strong></td>
                        <td colspan="2">
                          <strong>In</strong> <input type="radio" name="screen_thickness" value="In" <?= $report_detail['screen_thickness']=='In' ? 'checked' : '' ?>>
                        </td>
                        <td colspan="2">
                          <strong>mm</strong> <input type="radio" name="screen_thickness" value="mm" <?= $report_detail['screen_thickness']=='mm' ? 'checked' : '' ?>>
                        </td>
                        <td colspan="1">
                        </td>
                        <td colspan="2">
                          <strong>Source Side</strong>
                          <input type="checkbox" name="marker_side[]" value="Source Side" <?= in_array('Source Side',explode(';', $report_detail['marker_side'])) ? 'checked' : '' ?>>
                        </td>
                        <td colspan="2">
                          <strong>Film Side</strong>
                          <input type="checkbox" name="marker_side[]" value="Film Side" <?= in_array('Film Side',explode(';', $report_detail['marker_side'])) ? 'checked' : '' ?>>
                        </td>

                        <td></td>
                        <td class="text-nowrap"><strong style="float: right"> =</strong></td>
                        <td colspan="3"><strong></strong> </td>

                      </tr>

                      <tr>
                        <td colspan="6"></td>
                        <td><strong>Use back scatter</strong></td>
                        <td colspan="2">
                          <strong>Yes</strong>
                          <input type="radio" name="use_back_scatter" value="Yes" <?= $report_detail['use_back_scatter']=='Yes' ? 'checked' : '' ?>>
                        </td>
                        <td colspan="2">
                          <strong>No</strong>
                          <input type="radio" name="use_back_scatter" value="No" <?= $report_detail['use_back_scatter']=='No' ? 'checked' : '' ?>>
                        </td>
                        <td colspan="5"></td>
                      </tr>
                      <tr>
                        <th class="text-center align-middle" rowspan="2"><strong>S/N</strong></th>
                        <th class="text-center align-middle" rowspan="2"><strong>Weld Map Dwg / Line & Spool No.</strong></th>
                        <th class="text-center align-middle" rowspan="2"><strong>Joint No.</strong></th>
                        <th class="text-center align-middle" rowspan="2"><strong>Inspection Category</strong></th>
                        <th class="text-center align-middle" rowspan="2"><strong>Total Length (mm)</strong></th>
                        <th class="text-center align-middle" rowspan="2"><strong>Tested Length (mm)</strong></th>
                        <th class="text-center align-middle" rowspan="2"><strong>Welding Process</strong></th>
                        <th class="text-center align-middle" rowspan="2"><strong>Welder ID</strong></th>
                        <th class="text-center align-middle" colspan="2"><strong>Result</strong></th>
                        <th class="text-center align-middle" colspan="3"><strong>Density</strong></th>
                        <th class="text-center align-middle" rowspan="2"><strong>Sensitivity</strong></th>
                        <th class="text-center align-middle" rowspan="2"><strong>Discontinuities Type</strong></th>
                        <th class="text-center align-middle" rowspan="2"><strong>Remark</strong></th>
                      </tr>
                      <tr>
                        <th class="text-center align-middle">ACC</th>
                        <th class="text-center align-middle">REJECT</th>
                        <th class="text-center align-middle">IQI</th>
                        <th class="text-center align-middle">MAX</th>
                        <th class="text-center align-middle">MIN</th>
                      </tr>
                      <tbody>
                      <?php $no=0;foreach ($joint_list as $key => $value) { ?>
                        <?php //test_var($joint_list); ?>
                        <tr>
                          <td class="text-center align-middle"><?= $no+1 ?></td>
                          <td class="text-center align-middle"><?= $value[0]['drawing_wm'] ?></td>
                          <td class="text-center align-middle">
                            <?= $value[0]['joint_no'].($value[0]['revision']>0 ? '('.$value[0]['revision_category'].$value[0]['revision'].')' : '') ?>
                          </td>
                          <td class="text-center align-middle"><?= $class[$value[0]['class']] ?></td>
                          <td class="text-center align-middle"><?= number_format($value[0]['total_length'], 2) ?></td>
                          <td class="text-center align-middle"><?= number_format($value[0]['tested_length'], 2) ?></td>
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
                            <?= $value[0]['result']==3 ? 'Approved' : '-' ?>
                          </td>
                          <td rowspan="<?= count($value) ?>" class="align-middle text-center">
                            <?= $value[0]['result']==2 ? 'Rejected' : '-' ?>
                          </td>

                          <td class="text-center align-middle">
                            <input type="text" name="density_iqi[]" value="<?= $value[0]['density_iqi'] ?>" class="form-control">
                            <input type="hidden" name="id_ndt[]" value="<?= $value[0]['id'] ?>" class="form-control">
                          </td>
                          
                          <td class="text-center align-middle">
                            <input type="number" name="density_max[]" value="<?= $value[0]['density_max'] ?>" class="form-control">
                          </td>
                          
                          <td class="text-center align-middle">
                            <input type="number" name="density_min[]" value="<?= $value[0]['density_min'] ?>" class="form-control">
                          </td>
                          
                          <td class="text-center align-middle">
                            <input type="number" name="sensitivity[]" value="<?= $value[0]['sensitivity'] ?>" class="form-control">
                          </td>
                          
                          <td class="text-center align-middle">
                            <input type="text" name="discontinue_type[]" value="<?= $value[0]['discontinue_type'] ?>" class="form-control"></td>
                          <td><?= $value[0]['remarks'] ?></td>

                        </tr>
                      <?php } ?>
                        <tr>
                          <td colspan="16">
                            <textarea class="form-control" placeholder="Notes :" name="note"><?= @$report_detail['note'] ?></textarea>
                          </td>
                        </tr>
                      </tbody>
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
                        value="<?= $project[$list_detail[0]['project_code']]['project_ref'].'-OCP-SMO-'.strtoupper($type_of_module_list[$list_detail[0]['type_of_module']]['code']).'-'.strtoupper($discipline_list[$list_detail[0]['discipline']]['initial']).'-NDT-RFI-'.$initial.'-'.str_pad($list_detail[0]['report_number'],4,0, STR_PAD_LEFT) ?>" required>
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
                  <div class="col-md d-none">
                    <div class="form-group">
                      <button class="btn btn-warning font-weight-bold"
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