<?php
  $draft = 1;
?>
<style type="text/css">
  .clone-column-table-wrap input {
    pointer-events: none;
  }
</style>
<div id="content" class="container-fluid">
  <form id="joint_form" method="POST" action="<?php echo base_url() ?>engineering/joint_<?php echo ($module == 'New' ? 'new' : 'update') ?>_process">
    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0"><?php echo $meta_title ?></h6>
          </div>
          <div class="card-body bg-white overflow-auto">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Drawing No</label>
                  <div class="col-xl">
                    <input type="text" class="form-control autocomplete_doc" name="drawing_no" value="<?php echo $get['drawing_no'] ?>" required>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Drawing Type</label>
                  <div class="col-xl">
                    <select class="form-control" name="drawing_type" required>
                      <option value="">---</option>
                      <option value="1" <?php echo ($get['drawing_type'] == '1' ? 'selected' : '') ?>>GA</option>
                      <option value="2" <?php echo ($get['drawing_type'] == '2' ? 'selected' : '') ?>>Assembly</option>
                      <option value="13" <?php echo ($get['drawing_type'] == '13' ? 'selected' : '') ?>>Isometric</option>
                      <option value="9" <?php echo (@$get['drawing_type'] == '9' ? 'selected' : '') ?>>Weldmap GA</option>
                      <option value="14" <?php echo (@$get['drawing_type'] == '14' ? 'selected' : '') ?>>Weldmap AS</option>
                      <option value="12" <?php echo (@$get['drawing_type'] == '12' ? 'selected' : '') ?>>Pipe Support</option>
                      <option value="7" <?php echo (@$get['drawing_type'] == '7' ? 'selected' : '') ?>>Method Statement</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
                  <div class="col-xl">
                    <select class="form-control" name="project" required>
                      <option value="">---</option>
                      <?php foreach ($project_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo ($get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                  <div class="col-xl">
                    <select class="form-control" name="discipline" required>
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo ($get['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type Of Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="type_of_module">
                      <option value="">---</option>
                      <?php foreach ($type_of_module_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Deck Elevation / Service Line</label>
                  <div class="col-md">
                    <select class="form-control" name="deck_elevation" required>
                      <option value="">---</option>
                      <?php foreach ($deck_elevation_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="module" required>
                      <option value="">---</option>
                      <?php foreach ($module_list as $key => $value) : ?>
                      <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo ($get['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Desc. Assembly</label>
                  <div class="col-xl">
                    <select class="form-control" name="description_assy" required>
                      <option value="">---</option>
                      <?php foreach ($desc_assy_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo ($get['description_assy'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code'].' - '.$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Drawing WM</label>
                  <div class="col-xl">
                    <input type="text" class="form-control" name="drawing_wm" value="<?php echo $get['drawing_wm'] ?>" required>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status Internal</label>
                  <div class="col-xl">
                    <select class="form-control" name="status_internal">
                      <option value="0" <?php echo @$get['status_internal'] == "0" ? "selected" : "" ?>>External</option>
                      <option value="1" <?php echo @$get['status_internal'] == "1" ? "selected" : "" ?>>Internal</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Is Bondstrand</label>
                  <div class="col-xl">
                    <select class="form-control" name="is_bondstrand">
                      <option value="0" <?php echo @$get['is_bondstrand'] == "0" ? "selected" : "" ?>>No</option>
                      <option value="1" <?php echo @$get['is_bondstrand'] == "1" ? "selected" : "" ?>>Yes</option>
                    </select>
                  </div>
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
            <h6 class="m-0"><?php echo $meta_title ?></h6>
          </div>
          <div class="card-body bg-white">
            <input type="hidden" name="method" value="<?php echo $method ?>">
            
            <h6 class="font-weight-bold text-info"><i class="fas fa-info-circle"></i> Drag the header to expand column.</h6>
            <div id="container_tbl_joint" class="overflow-auto freeze-table" style="max-height: 70vh;">
              <table id="tbl_joint" class="table table-th-sticky table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th class="text-nowrap bg-green-smoe"></th>
                    <th class="text-nowrap bg-green-smoe">GA/AS Rev</th>
                    <th class="text-nowrap bg-green-smoe">Weldmap Rev</th>
                    <th class="text-nowrap bg-green-smoe">Joint No.</th>
                    <!-- <th class="text-nowrap bg-green-smoe">GA/AS Reference#1</th> -->
                    <th class="text-nowrap bg-green-smoe">Piecemark#1</th> 
                    <!-- <th class="text-nowrap bg-green-smoe">GA/AS Reference#2</th> -->
                    <th class="text-nowrap bg-green-smoe">Piecemark#2</th> 
                    <th class="text-nowrap bg-green-smoe">Weld Type Code</th>
                    <th class="text-nowrap bg-green-smoe">Phase</th>
                    <th class="text-nowrap bg-green-smoe">Thickness</th>
                    <th class="text-nowrap bg-green-smoe">Diameter</th>
                    <th class="text-nowrap bg-green-smoe">Schedule</th>
                    <th class="text-nowrap bg-green-smoe">Length</th>
                    <th class="text-nowrap bg-green-smoe">Weld Length</th>
                    <th class="text-nowrap bg-green-smoe">Joint Type Code</th>
                    <th class="text-nowrap bg-green-smoe">Test Pack Number</th>
                    <th class="text-nowrap bg-green-smoe">Spool Number</th>
                    <th class="text-nowrap bg-green-smoe">Service Line</th>
                    <th class="text-nowrap bg-green-smoe">P&ID Drawing</th>
                    <th class="text-nowrap bg-green-smoe">Class Code</th>
                    <th class="text-nowrap bg-green-smoe">Row</th>
                    <th class="text-nowrap bg-green-smoe">Column</th>
                    <th class="text-nowrap bg-green-smoe">MT Req (%)</th>
                    <th class="text-nowrap bg-green-smoe">PT Req (%)</th>
                    <th class="text-nowrap bg-green-smoe">UT Req (%)</th>
                    <th class="text-nowrap bg-green-smoe">RT Req (%)</th>
                    <th class="text-nowrap bg-green-smoe">PWHT Req (%)</th>
                    <th class="text-nowrap bg-green-smoe">WPS</th>
                    <th class="text-nowrap bg-green-smoe">Remarks</th>
                    <th class="text-nowrap bg-green-smoe"></th>
                  </tr>
                </thead>
                <tbody>
                <input type="hidden" name="company_id" value='<?= isset($get['company_id']) && !empty($get['company_id']) ? $get['company_id'] : null ?>'>
                  <?php if($module == 'New'): ?>
                     <!-- new_process -->
                  <tr>
                    <td></td>
                    <td><input type="text" name="rev_no[]" value="01" class="form-control text-center"></td>
                    <td><input type="text" name="rev_wm[]" value="01" class="form-control text-center"></td>
                    <td>
                      <input type="text" name="joint_no[]" oninput="fill_joint_check(this)" onblur="fill_joint_check(this)" class="form-control text-center">
                      <input type="hidden" name="id[]">
                      
                    </td>
                    <!-- <td>
                      <input type="text" name="ref_1[]" class="form-control text-center autocomplete_doc no_get_drawing">
                    </td> -->
                    <td>
                      <select name="pos_1[0][]" class='pc_reference form-control' required multiple></select>
                      <!-- <input type="text" name="pos_1[]" oninput="fill_joint_check(this)" onchange="fill_joint_check(this)" onblur="fill_joint_check(this)" class="form-control text-center autocomplete_partid"> -->
                    </td>
                    <!-- <td><input type="text" name="thk_pos_1[]" class="form-control text-center" readonly></td> -->
                    <!-- <td><input type="text" name="ref_2[]" class="form-control text-center autocomplete_doc no_get_drawing"></td> -->
                    <td>
                      <select name="pos_2[0][]" class='pc_reference_2 form-control' required multiple></select>
                      <!-- <input type="text" name="pos_2[]" oninput="fill_joint_check(this)" onchange="fill_joint_check(this)" onblur="fill_joint_check(this)" class="form-control text-center autocomplete_partid"> --> 
                    </td>
                    <!-- <td><input type="text" name="thk_pos_2[]" class="form-control text-center" readonly></td> -->
                    <td>
                      <select class="form-control" name="weld_type[]">
                        <option value="">---</option>
                        <?php foreach ($weld_type_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>"><?php echo $value['weld_type_code'] ?> - <?php echo $value['weld_type'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    <td>
                      <select class="form-control" name="phase[]">
                        <option value="">---</option>
                        <option value="FB">FB - Fabrication</option>
                        <option value="AS">AS - Assembly</option>
                        <option value="ER">ER - Erection</option>
                        <option value="BAA">BAA - Bondstrand Adhesive Assembly</option>
                      </select>
                    </td>
                    <td><input type="text" name="thickness[]" class="form-control text-center"></td>
                    <td><input type="text" name="diameter[]" class="form-control text-center"></td>
                    <td><input type="text" name="sch[]" class="form-control text-center"></td>
                    <td><input type="number" name="length[]" step="0.01" class="form-control text-center"></td>
                    <td><input type="number" name="weld_length[]" step="0.01" class="form-control text-center"></td>
                    <td>
                      <select class="form-control" name="joint_type[]">
                        <option value="">---</option>
                        <?php foreach ($joint_type_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>"><?php echo $value['joint_type_code'] ?> - <?php echo $value['joint_type'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    <td><input type="text" name="test_pack_no[]" class="form-control text-center"></td>
                    <td><input type="text" name="spool_no[]" class="form-control text-center"></td>
                    <td><input type="text" name="service_line[]" class="form-control text-center"></td>
                    <td><input type="text" name="pid_drawing[]" class="form-control text-center"></td>
                    <td>
                      <select class="form-control" name="class[]">
                        <option value="">---</option>
                        <?php foreach ($class_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>"><?php echo $value['class_code'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    <td><input type="text" name="grid_row[]" class="form-control text-center"></td>
                    <td><input type="text" name="grid_column[]" class="form-control text-center"></td>
                    <td><input type="number" name="mt_percent_req[]" class="form-control text-center"></td>
                    <td><input type="number" name="pt_percent_req[]" class="form-control text-center"></td>
                    <td><input type="number" name="ut_percent_req[]" class="form-control text-center"></td>
                    <td><input type="number" name="rt_percent_req[]" class="form-control text-center"></td>
                    <td><input type="number" name="pwht_percent_req[]" class="form-control text-center"></td>
                    <td>
											<select name="wps[0][]" class="form-control select2-multiple-tags input-wps" multiple>
												<!-- <option></option> -->
												<?php foreach ($wps_list as $key => $value) : ?>
                          <!-- <option value='<?php echo $key ?>'><?php echo $value ?></option> -->
                        <?php endforeach; ?>
											</select>
										</td>
                    <td><input type="text" name="remarks[]" class="form-control text-center"></td>
                    <td></td>
                  </tr>

                  <!-- Update_process -->
                  <?php elseif($module == 'Update'): ?>
                    <?php 
                      foreach ($joint_list as $key_joint => $joint): 
                        if($joint['status'] == 1){
                          $draft = 0;
                        }
                    ?>
                  <tr>
                    <td>
                      <button type="button" class="btn btn-secondary btn-sm" onclick="open_history_log(<?php echo $joint['id'] ?>)"><i class="fas fa-history"></i></button>
                    </td>
                    <td><input type="text" name="rev_no[]" value="<?php echo $joint['rev_no'] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="rev_wm[]" value="<?php echo $joint['rev_wm'] ?>" class="form-control text-center"></td>
                    <td>
                      <input type="text" name="joint_no[]" oninput="fill_joint_check(this)" onblur="fill_joint_check(this)" class="form-control text-center" value="<?php echo $joint['joint_no'] ?>" <?php echo ($module == 'revise' ? 'readonly' : '') ?>>
                      <input type="hidden" name="id[]" value="<?php echo $joint['id'] ?>">
                    </td>
                    <!-- <td>
                      <input type="text" name="ref_1[]" value ="<?php echo $joint['ref_1'] ?>" class="form-control text-center autocomplete_doc no_get_drawing">
                    </td> -->
                    <td>
                      <!-- <input type="text" name="pos_1[]" value="<?php echo $joint['pos_1'] ?>" oninput="fill_joint_check(this)" onchange="fill_joint_check(this)" onblur="fill_joint_check(this)" class="form-control text-center autocomplete_partid">  -->
                      <?php $create_arr_p1 = explode(";",$joint['pos_1']);  ?>
                      <select name="pos_1[<?= $key_joint ?>][]" class='pc_ref_update form-control' required multiple>
                        <?php foreach($create_arr_p1 as $val){ ?>
                          <option selected value='<?= $val ?>'><?= $val ?></option>
                        <?php } ?>
                      </select>
                    </td>
                    <!-- <td><input type="number" name="thk_pos_1[]" value="<?php echo @$piecemark_list[$joint['pos_1']]['thickness'] ?>" class="form-control text-center" readonly></td> -->
                    <!-- <td><input type="text" name="ref_2[]" value ="<?php echo $joint['ref_2'] ?>" class="form-control text-center autocomplete_doc no_get_drawing"></td> -->
                    <td>
                      <!-- <input type="text" name="pos_2[]" value="<?php echo $joint['pos_2'] ?>" oninput="fill_joint_check(this)" onchange="fill_joint_check(this)" onblur="fill_joint_check(this)" class="form-control text-center autocomplete_partid"> -->
                      <?php $create_arr_p2 = explode(";",$joint['pos_2']);  ?>
                      <select name="pos_2[<?= $key_joint ?>][]" class='pc_ref_update form-control' required multiple>
                        <?php foreach($create_arr_p2 as $val2){ ?>
                          <option selected value='<?= $val2 ?>'><?= $val2 ?></option>
                        <?php } ?>
                      </select>
                    </td>
                    <!-- <td><input type="text" name="thk_pos_2[]" value="<?php echo @$piecemark_list[$joint['pos_2']]['thickness'] ?>" class="form-control text-center" readonly></td> -->
                    <td>
                      <select class="form-control" name="weld_type[]">
                        <option value="">---</option>
                        <?php foreach ($weld_type_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo ($joint['weld_type'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['weld_type_code'] ?> - <?php echo $value['weld_type'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    <td>
                      <select class="form-control" name="phase[]">
                        <option value="">---</option>
                        <option value="FB" <?php echo ($joint['phase'] == "FB" ? 'selected' : '') ?>>FB - Fabrication</option>
                        <option value="AS" <?php echo ($joint['phase'] == "AS" ? 'selected' : '') ?>>AS - Assembly</option>
                        <option value="ER" <?php echo ($joint['phase'] == "ER" ? 'selected' : '') ?>>ER - Erection</option>
                        <option value="BAA" <?php echo ($joint['phase'] == "BAA" ? 'selected' : '') ?>>BAA - Bondstrand Adhesive Assembly</option>
                      </select>
                    </td>
                    <td><input type="text" name="thickness[]" value="<?php echo $joint['thickness'] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="diameter[]" value="<?php echo $joint['diameter'] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="sch[]" value="<?php echo $joint['sch'] ?>" class="form-control text-center"></td>
                    <td><input type="number" name="length[]" value="<?php echo $joint['length'] ?>" step="0.01" class="form-control text-center"></td>
                    <td><input type="number" name="weld_length[]" value="<?php echo $joint['weld_length'] ?>" step="0.01" class="form-control text-center"></td>
                    <td>
                      <select class="form-control" name="joint_type[]">
                        <option value="">---</option>
                        <?php foreach ($joint_type_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo ($joint['joint_type'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['joint_type_code'] ?> - <?php echo $value['joint_type'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    <td><input type="text" name="test_pack_no[]" value="<?php echo $joint['test_pack_no'] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="spool_no[]" value="<?php echo $joint['spool_no'] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="service_line[]" value='<?php echo $joint['service_line'] ?>' class="form-control text-center"></td>
                    <td><input type="text" name="pid_drawing[]" value="<?php echo $joint['pid_drawing'] ?>" class="form-control text-center"></td>
                    <td>
                      <select class="form-control" name="class[]">
                        <option value="">---</option>
                        <?php foreach ($class_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo ($joint['class'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['class_code'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    <td><input type="text" name="grid_row[]" value="<?php echo $joint['grid_row'] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="grid_column[]" value="<?php echo $joint['grid_column'] ?>" class="form-control text-center"></td>
                    <td><input type="number" name="mt_percent_req[]" value="<?php echo $joint['mt_percent_req'] ?>" class="form-control text-center"></td>
                    <td><input type="number" name="pt_percent_req[]" value="<?php echo $joint['pt_percent_req'] ?>" class="form-control text-center"></td>
                    <td><input type="number" name="ut_percent_req[]" value="<?php echo $joint['ut_percent_req'] ?>" class="form-control text-center"></td>
                    <td><input type="number" name="rt_percent_req[]" value="<?php echo $joint['rt_percent_req'] ?>" class="form-control text-center"></td>
                    <td><input type="number" name="pwht_percent_req[]" value="<?php echo $joint['pwht_percent_req'] ?>" class="form-control text-center"></td>
                    <td>
											<?php
                        $wps = explode(";", $joint['wps']);
                      ?>
											<select name="wps[<?= $key_joint ?>][]" class="form-control select2-multiple-tags input-wps" multiple data-id="<?= $joint['id'] ?>">
												<?php foreach ($wps_list as $key => $value) : ?>
                          <!-- <option value='<?php echo $key ?>' <?php echo (in_array($key, $wps) ? 'selected' : '') ?>><?php echo $value ?></option> -->
                        <?php endforeach; ?>
											</select>
										</td>
                    <td><input type="text" name="remarks[]" value="<?php echo $joint['remarks'] ?>" class="form-control text-center"></td>
                    <td></td>
                  </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
            <div class="row">
              <div class="col-12 text-right">
              <?php if($method == ''): ?>
                <?php if($draft == 1): ?>
                  <button class="mt-2 btn btn-sm btn-flat btn-secondary" name="submit" value="draft" onclick="required_input_check()"><i class="fas fa-save"></i> Save as Draft</button>
                <?php endif; ?>
                <?php if($module == 'New' || $draft == 1): ?>
                  <button class="mt-2 btn btn-sm btn-flat btn-info" type="button" onclick="addrow()" <?php if($module != 'New'): ?>data-toggle="tooltip" data-placement="bottom" title="When you add more joint, you only can save it as draft" <?php endif ?>><i class="fas fa-plus"></i> Add row</button>
                <?php endif; ?>
                <button class="mt-2 btn btn-sm btn-flat btn-success" name="submit" value="submit" ><i class="fas fa-check"></i> Submit</button>
              <?php elseif($method == 'revise'): ?>
                <?php if($request_list['fabrication_type'] == '5'): ?>
                  <button class="mt-2 btn btn-sm btn-flat btn-success" name="submit" value="add"><i class="fas fa-check"></i> Complete</button>
                <?php elseif($request_list['fabrication_type'] == '11'): ?>
                  <button class="mt-2 btn btn-sm btn-flat btn-success" type="button" onclick="submit_form_request_approval_client()" value="add"><i class="fas fa-check"></i> Save</button>
                <?php endif; ?>
              <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<div class="modal fade" id="history_log" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >History Log</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
  var freeze_table_option = {
    'namespace': 'first-table',
    'scrollable': true,
    'fastMode': true,
    'columnNum': 3,
    'shadow': true,
    'freezeHead': false,
  };
  var added_joint = 0;
	let wps_element;
	let pc_element;
	let pc_element_2;
  // var freezeTable = new FreezeTable('.freeze-table', freeze_table_option);



  
  $(document).ready(async function(){  

    $(".pc_ref_update").select2({ 
        placeholder: 'Part ID# Search',
        allowClear: true,
        minimumInputLength: 3,  // Minimum characters to trigger the search
        ajax: {
            url: "<?php echo base_url() ?>engineering/autocomplete_piecemark_new",
            dataType: 'json',
            delay: 250,  // Delay for better UX
            data: function (params) {
                return {
                    q: params.term  // Search term sent to the server
                };
            },
            processResults: function (data) {
                return {
                    results: data  // Return the data in a format Select2 expects
                };
            },
            cache: true
        } 
    });

    <?php if($module == 'New'): ?>

      pc_element = $("#tbl_joint tbody tr:last .pc_reference").closest("td").html();
      await initialSelect2($("#tbl_joint tbody tr:last .pc_reference"));

      pc_element_2 = $("#tbl_joint tbody tr:last .pc_reference_2").closest("td").html();
      await initialSelect2($("#tbl_joint tbody tr:last .pc_reference_2"));

			wps_element = $("#tbl_joint tbody tr:last .input-wps").closest("td").html();  
			await select2_render($("#tbl_joint tbody tr:last .input-wps")); 
      
     
      var i;
      for (i = 0; i < 10; i++) {
        await addrow(); 
      }
    <?php elseif($module == 'Update'): ?>
      $("input[name=drawing_no], select[name=drawing_type], select[name=project], select[name=discipline], select[name=type_of_module], select[name=module]").attr("readonly", true);
      <?php if($method == 'revise'): ?>
        $("select[name=deck_elevation], select[name=description_assy]").attr("readonly", true);
      <?php endif; ?>
      $("input[name='joint_no[]']").each(function(){
        fill_joint_check(this);
      });
			await select2_render($("#tbl_joint tbody .input-wps"));

			<?php 
				foreach ($joint_list as $joint): 
					$wps = explode(";", $joint['wps']);
					$wps[] = -1;
			?>
				$('.input-wps[data-id=<?= $joint['id'] ?>]').val(["<?= join('", "', $wps) ?>"]).trigger('change');
			<?php endforeach; ?>
    <?php endif; ?>
    
    generate_tabindex("#tbl_joint input:not([type=hidden]), #tbl_joint select", 32)

    autocomplete_partid_build();

    $('#container_tbl_joint').scroll(function(e) { 
      var col_width = 0;
      var col_arr_no = [4, 6, 9];
      for (let index = 0; index < col_arr_no.length; index++) {
        const element = col_arr_no[index];
        $('#tbl_joint thead th:nth-child('+element+')').css("left", col_width); 
        $('#tbl_joint thead th:nth-child('+element+')').css("z-index", 3); 
        $('#tbl_joint tbody td:nth-child('+element+')').css("left", col_width); 
        $('#tbl_joint tbody td:nth-child('+element+')').css("z-index", 2); 
        $('#tbl_joint tbody td:nth-child('+element+')').css("position", 'sticky'); 
        $('#tbl_joint tbody td:nth-child('+element+')').css("background-color", 'white'); 
        col_width += $('#tbl_joint thead th:nth-child('+element+')').outerWidth();
      }
    });

		$('.input-wps').on("select2:unselecting", function (e) {
			if(e.params.args.data.id == -1){
				e.preventDefault();
			}
    });

  });

  function required_input_check() {
    $("[name='pos_1[]'], [name='pos_2[]'], [name='phase[]'], [name='grid_row[]'], [name='grid_column[]'], [name='rev_no[]'], [name='rev_wm[]'], [name='weld_type[]'], [name='thickness[]'], [name='diameter[]'], [name='length[]'], [name='weld_length[]'], [name='joint_type[]'], [name='class[]'], [name='mt_percent_req[]'], [name='pt_percent_req[]'], [name='ut_percent_req[]'], [name='rt_percent_req[]'], [name='pwht_percent_req[]']").prop("required", false);
  }

  function autocomplete_partid_build() {
    $(".autocomplete_partid").autocomplete({
      source: function( request, response ) {
        var drawing_type = $("#joint_form [name=drawing_type]").val();
        var drawing_no = $("#joint_form input[name=drawing_no]").val();
        var reference = this.element.closest("td").prev().find("input").val();
        $.ajax( {
          url: "<?php echo base_url() ?>engineering/autocomplete_piecemark",
          dataType: "json",
          data: {
            reference: reference,
            term: request.term,
            drawing_type: drawing_type,
            drawing_no: drawing_no,
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      select: function (event, ui) {
        var value = ui.item.value;
        if(value == 'No Data.'){
          ui.item.value = "";
        }
        else{
          var thk_input = $(this).closest('td').next().find('input');
          $.ajax( {
            url: "<?php echo base_url() ?>engineering/get_data_piecemark",
            dataType: "json",
            data: {
              part_id: value
            },
            success: function( result ) {
              $(thk_input).val(result.thickness);
            }
          });
        }
      }
    });

    $(".autocomplete_doc, .autocomplete_wm").autocomplete({
      source: function( request, response ) {
        var drawing_type;
        if($(this.element).hasClass("autocomplete_doc")){
          drawing_type = 1;//ga or as
        }
        else if($(this.element).hasClass("autocomplete_wm")){
          drawing_type = 2;
        }
        $.ajax( {
          url: "<?php echo base_url() ?>engineering/autocomplete_drawing",
          dataType: "json",
          data: {
            term: request.term,
            drawing_type: drawing_type,
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      select: function (event, ui) {
        var value = ui.item.value;
        if(value == 'No Data.'){
          ui.item.value = "";
        }
        else if(!$(this).hasClass("no_get_drawing")){
          get_data_drawing(ui.item.value);
        }
      }
    });
  }

  $("select[name=module]").chained("select[name=project]");

  function get_data_drawing(document_no) {
    // var module = $("select[name=module]").val();
    $.ajax( {
      url: "<?php echo base_url() ?>engineering/get_data_drawing",
      dataType: "json",
      data: {
        document_no: document_no,
        // module: module,
      },
      success: function(data) {
        console.log(data);
        $("select[name=project]").val(data.project).trigger('change');
        $("select[name=discipline]").val(data.discipline);
        if(data.drawing_type == 1 || data.drawing_type == 2 || data.drawing_type == 13){
          $("select[name=drawing_type]").val(data.drawing_type);
        }
        $("select[name=module]").val(data.module);
        $("select[name=type_of_module]").val(data.type_of_module);
        // $("select[name=deck_elevation]").val(data.deck_elevation);
      }
    });
  }
	
	let num_row = 0;
  async function addrow() { 
    var html = $("#tbl_joint tbody tr:last").html();

    $("#tbl_joint tbody").append("<tr>"+html+"</tr>");
    
    var delete_btn = '<button tabindex="-1" class="mt-2 btn btn-sm btn-flat btn-danger" type="button" onclick="deleterow(this)"><i class="fas fa-times"></i></button>';
    html = $("#tbl_joint tbody tr:last td:last").html(delete_btn);
    $("#tbl_joint tbody tr:last input").val(''); 
    $("#tbl_joint tbody tr:last select").val('').change();
    $("#tbl_joint tbody tr:last input[name='joint_no[]']").prop("readonly", false);
    $("#tbl_joint tbody tr:last input.is-valid").removeClass('is-valid');
    $("#tbl_joint tbody tr:last input.is-invalid").removeClass('is-invalid');
    $("#tbl_joint tbody tr:last .invalid-feedback").remove();

    $("#tbl_joint tbody tr:last .pc_reference").closest("td").html(pc_element);
    await initialSelect2($("#tbl_joint tbody tr:last .pc_reference"));

    $("#tbl_joint tbody tr:last .pc_reference_2").closest("td").html(pc_element_2);
    await initialSelect2($("#tbl_joint tbody tr:last .pc_reference_2"));

		$("#tbl_joint tbody tr:last .input-wps").closest("td").html(wps_element);
		await select2_render($("#tbl_joint tbody tr:last .input-wps"));
    
    
		// console.log($("#tbl_joint tbody tr:last .input-wps").closest("td").html(""))
    autocomplete_partid_build();
    generate_tabindex("#tbl_joint input:not([type=hidden]), #tbl_joint select", 32);
    // freezeTable.update();
    
		num_row++;
		$("#tbl_joint tbody tr:last .input-wps").each(function(i, fields){
			if($(fields).attr('name') !== undefined){
				if (/\[[^\]]*\]\[/.test($(fields).attr('name'))) {
					$(fields).attr('name', $(fields).attr('name').replace(/\[[^\]]*\]\[/, '['+(num_row)+']['));
				}
				else{
					$(fields).attr('name', $(fields).attr('name').replace(/\[[^\]]*\]/, '['+(num_row)+']'));
				}
			}
		}); 
    $("#tbl_joint tbody tr:last .pc_reference").each(function(i, fields){
			if($(fields).attr('name') !== undefined){
				if (/\[[^\]]*\]\[/.test($(fields).attr('name'))) {
					$(fields).attr('name', $(fields).attr('name').replace(/\[[^\]]*\]\[/, '['+(num_row)+']['));
				}
				else{
					$(fields).attr('name', $(fields).attr('name').replace(/\[[^\]]*\]/, '['+(num_row)+']'));
				}
			}
		}); 
    $("#tbl_joint tbody tr:last .pc_reference_2").each(function(i, fields){
			if($(fields).attr('name') !== undefined){
				if (/\[[^\]]*\]\[/.test($(fields).attr('name'))) {
					$(fields).attr('name', $(fields).attr('name').replace(/\[[^\]]*\]\[/, '['+(num_row)+']['));
				}
				else{
					$(fields).attr('name', $(fields).attr('name').replace(/\[[^\]]*\]/, '['+(num_row)+']'));
				}
			}
		});
    count_added_joint('add');
  }

  function deleterow(btn) {
    $(btn).closest("tr").remove();
    generate_tabindex("#tbl_joint input:not([type=hidden]), #tbl_joint select", 32);
    count_added_joint('substract');
  }

  function count_added_joint(param = '') {
    if(param == 'add'){
      added_joint++;
    }
    else if(param == 'substract'){
      added_joint--;
    }
    <?php if($module != 'New'): ?>
    if(added_joint > 0){
      $("button[name=submit][value='submit']").prop("disabled", true);
    }
    else{
      $("button[name=submit][value='submit']").prop("disabled", false);
    }
    <?php endif; ?>
  }

  function fill_joint_check(input) {
    if ($(input).closest("tr").find("[name='joint_no[]']").val() != '') {
      $('button[name=submit][value=submit]').prop("disabled", true);
    }
    var joint_no_elem = $(input).closest("tr").find("[name='joint_no[]']");
    var id_elem = $(input).closest("tr").find("[name='id[]']");
    var pos_1_elem = $(input).closest("tr").find("[name='pos_1[]']");
    var pos_2_elem = $(input).closest("tr").find("[name='pos_2[]']");
    var ref_1_elem = $(input).closest("tr").find("[name='ref_1[]']");
    var ref_2_elem = $(input).closest("tr").find("[name='ref_2[]']");
    var phase_elem = $(input).closest("tr").find("[name='phase[]']");
    var grid_row_elem = $(input).closest("tr").find("[name='grid_row[]']");
    var grid_column_elem = $(input).closest("tr").find("[name='grid_column[]']");
    if ($(joint_no_elem).val() != '') {
      $("[name='pos_1[]'], [name='pos_2[]'], [name='phase[]'], [name='grid_row[]'], [name='grid_column[]'], [name='rev_no[]'], [name='rev_wm[]'], [name='weld_type[]'], [name='thickness[]'], [name='diameter[]'], [name='length[]'], [name='weld_length[]'], [name='joint_type[]'], [name='class[]'], [name='mt_percent_req[]'], [name='pt_percent_req[]'], [name='ut_percent_req[]'], [name='rt_percent_req[]'], [name='pwht_percent_req[]']").prop("required", true);

      var joint_no = $(joint_no_elem).val();
      var pos_1 = $(pos_1_elem).val();
      var ref_1 = $(ref_1_elem).val();
      var pos_2 = $(pos_2_elem).val();
      var ref_2 = $(ref_2_elem).val();
      var id = $(id_elem).val();
      $.ajax({
        url: "<?php echo base_url() ?>engineering/checking_joint",
        type: "post",
        data: {
          module_list: "<php echo $module ?>",
          joint_no: joint_no,
          id: id,
          pos_1: pos_1,
          pos_2: pos_2,
          ref_1: ref_1,
          ref_2: ref_2,
          drawing_no: "<?php echo $get['drawing_no'] ?>",
          discipline: "<?php echo $get['discipline'] ?>",
          module: "<?php echo $get['module'] ?>",
          project: "<?php echo $get['project'] ?>",
          drawing_wm: $("input[name=drawing_wm]").val(),
          drawing_type: "<?php echo $get['drawing_type'] ?>",
          type_of_module: "<?php echo $get['type_of_module'] ?>",
          deck_elevation: "<?php echo $get['deck_elevation'] ?>",
        },
        success: function(data) {
          if(data.includes('Error') == true){
            $(joint_no_elem).add(pos_1_elem).add(pos_2_elem).removeClass('is-valid');
            $(joint_no_elem).add(pos_1_elem).add(pos_2_elem).addClass('is-invalid');
            $(input).closest("tr").find('.invalid-feedback').remove( ":contains('Error')" );
            $(input).after('<div class="invalid-feedback">'+data+'</div>');
          }
          else{
            $(input).closest("tr").find('.invalid-feedback').remove( ":contains('Error')" );
            $(joint_no_elem).add(pos_1_elem).add(pos_2_elem).removeClass('is-invalid');
            $(joint_no_elem).add(pos_1_elem).add(pos_2_elem).addClass('is-valid');
          }
          if (!$('.is-invalid').length) {
            $('button[name=submit][value=submit]').prop("disabled", false);
            count_added_joint();
          }
        }
      });
    }
    else{
      $("[name='pos_1[]'], [name='pos_2[]'], [name='phase[]'], [name='grid_row[]'], [name='grid_column[]'], [name='rev_no[]'], [name='rev_wm[]'], [name='weld_type[]'], [name='thickness[]'], [name='diameter[]'], [name='length[]'], [name='weld_length[]'], [name='joint_type[]'], [name='class[]'], [name='mt_percent_req[]'], [name='pt_percent_req[]'], [name='ut_percent_req[]'], [name='rt_percent_req[]'], [name='pwht_percent_req[]']").prop("required", false);
    }
  }

  function open_history_log(id) {
    $('#history_log').modal('show');
    $('#history_log .modal-body').html('<div class="text-center"><div class="spinner-border text-success" role="status"><span class="sr-only">Loading...</span></div></div>');
    $.ajax( {
      url: "<?php echo base_url() ?>engineering/get_table_history_log",
      type: "POST",
      data: {
        id_template: id,
        module: 2,
      },
      success: function(data) {
        $('#history_log .modal-body').html(data);
      }
    });
  }

  function submit_form_request_approval_client() {
    $('#joint_form').attr('action', '<?= base_url() ?>engineering/request_approval_client_process/<?= @$request_list['id'] ?>');
    $("#joint_form")[0].submit();
  }

	<?php
		$datadb = $wps_list;
		$wps_list = [[
			'id' => -1,
			'text' => '',
			'selected' => 'selected',
			'hidden' => true,
		]];
		foreach ($datadb as $key => $value) {
			$wps_list[] = [
				'id' => $key,
				'text' => $value,
				'selected' => false,
				'hidden' => true,
			];
		}
	?>
	let data_option = '<?= json_encode($wps_list) ?>';
	data_option = JSON.parse(data_option);
	function select2_render(e) {
		$(e).select2({
			allowClear: true,
			tokenSeparators: [';'],
			multiple: true,
			// tags: true,
			// selectOnClose: true,
			placeholder: {
				id: "-1",
				text:"Select...",
				selected:'selected'
			},
			data: data_option,
		});
	}
  
  function initialSelect2(e) {  
    $(e).select2({ 
        placeholder: 'Part ID# Search',
        allowClear: true,
        minimumInputLength: 3,  // Minimum characters to trigger the search
        ajax: {
            url: "<?php echo base_url() ?>engineering/autocomplete_piecemark_new",
            dataType: 'json',
            delay: 250,  // Delay for better UX
            data: function (params) {
                return {
                    q: params.term  // Search term sent to the server
                };
            },
            processResults: function (data) {
                return {
                    results: data  // Return the data in a format Select2 expects
                };
            },
            cache: true
        } 
    });
  }

  function safeDestroySelect2() {
    $('.pc_reference').each(function() {
        try {
            $(this).select2('destroy');
        } catch (e) {
            console.log('Select2 not initialized:', this);
        }
    });
  }

</script>