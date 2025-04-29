<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="" method="GET">
            <input type="hidden" name="type" value="<?php echo $type ?>">
            <div class="row">

              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
                  <div class="col-md">
                    <select class="form-control" name="project" id='project_id' required>
											<?php foreach ($project_list as $key => $value) : ?>
												<?php if(in_array($value['id'], $this->user_cookie[13])): ?>
													<option value="<?php echo $value['id'] ?>" <?= (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
												<?php endif; ?>
											<?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Drawing GA / AS / CP / CL</label>
                  <div class="col-md">
                    <input type="text" class="form-control autocomplete_ga" name="drawing_ga" value="<?php echo @$get['drawing_ga'] ?>">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Test Pack Number</label>
                  <div class="col-md">
                    <input type="text" class="form-control" name="test_pack_no" value="<?php echo @$get['test_pack_no'] ?>">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Module</label>
                  <div class="col-md">
                    <select class="form-control" name="module" required>
                      <option value="">---</option>
                      <?php foreach ($module_list as $key => $value) : ?>
                      <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$get['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type Of Module</label>
                  <div class="col-md">
                    <select class="form-control" name="type_of_module" required>
                      <option value="">---</option>
                      <?php foreach ($type_of_module_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Deck Elevation / Service Line</label>
                  <div class="col-md">
                    <select class="form-control" name="deck_elevation" <?php echo ($type == 1 ? 'required' : 'readonly') ?>>
                      <option value="">---</option>
                      <?php foreach ($deck_elevation_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                  <div class="col-md">
                    <select class="form-control" name="discipline" required>
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Phase</label>
                  <div class="col-md">
                    <select class="form-control" name="phase" <?php echo ($type == 1 ? 'required' : 'readonly') ?>>
                      <option value="">---</option>
                      <option value="PF" <?php echo (@$get['phase'] == "PF" || $type == 3 ? 'selected' : '') ?>>Pre - Fabrication (PF)</option>
                      <option value="FB" <?php echo (@$get['phase'] == "FB" ? 'selected' : '') ?>>Fabrication (FB)</option>
                      <option value="AS" <?php echo (@$get['phase'] == "AS" ? 'selected' : '') ?>>Assembly (AS)</option>
                      <option value="ER" <?php echo (@$get['phase'] == "ER" ? 'selected' : '') ?>>Erection (ER)</option>
                      <option value="ITR" <?php echo (@$get['phase'] == "ITR" ? 'selected' : '') ?>>Inspection & Test Record (ITR)</option>
                      <option value="BAA" <?php echo (@$get['phase'] == "BAA" ? 'selected' : '') ?>>Bondstrand Adhesive Assembly (BAA)</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Description Assy Code</label>
                  <div class="col-md">
                    <select class="form-control <?php echo ($type == 1 ? 'select2' : '') ?>" name="desc_assy" <?php echo ($type == 1 ? 'required' : 'readonly') ?>>
                      <option value="">---</option>
                      <?php foreach ($desc_assy_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['desc_assy'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Assigned Company</label>
                  <div class="col-md">
                    <select class="form-control select2" name="company_id" required>
                      <?php foreach ($company_list as $key => $value) : ?>
												<?php if($this->user_cookie[11] == 1 || $value['id_company'] == $this->user_cookie[11]): ?>
                        	<option value="<?php echo $value['id_company'] ?>" <?php echo (@$get['company_id'] == $value['id_company'] ? 'selected' : (1 == $value['id_company'] ? 'selected' : '')) ?>><?php echo $value['company_name'] ?></option>
												<?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status Internal</label>
                  <div class="col-md">
                    <select class="form-control" name="status_internal" <?php echo ($type == 1 ? 'required' : 'readonly') ?>>
                      <option value="0" <?php echo @$get['status_internal'] == "0" ? "selected" : "" ?>>External</option>
                      <option value="1" <?php echo @$get['status_internal'] == "1" ? "selected" : "" ?>>Internal</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Yard Company</label>
                  <div class="col-md">
                    <select class="form-control select2" name="company_yard" required>
                      <?php foreach ($company_list as $key => $value) : ?>
												<?php if(in_array($value['id_company'], $this->user_cookie[14])): ?>
                        	<option value="<?php echo $value['id_company'] ?>" <?php echo (@$get['company_yard'] == $value['id_company'] ? 'selected' : (1 == $value['id_company'] ? 'selected' : '')) ?>><?php echo $value['company_name'] ?></option>
                      	<?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Piping Testing Category</label>
                  <div class="col-md">
                    <select class="form-control" name="piping_testing_category" required>
                      <option value="">---</option>
                      <?php foreach ($piping_testing_category_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['piping_testing_category'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-12 text-right">
                <button class="mt-2 btn btn-sm btn-flat btn-success" name="submit" value="search"><i class="fas fa-search"></i> Search</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php if(isset($get['submit'])): ?>
    <?php if($get['type'] == "1"): ?>
      <?php if(in_array(@$get['phase'], ['PF', 'ITR'])): ?>
      <div class="row">
        <div class="col">
          <div class="card shadow my-3 rounded-0">
            <div class="card-header">
              <h6 class="m-0"><?php echo $meta_title ?></h6>
            </div>
            <div class="card-body bg-white">
              <form id="form_create_workpack" method="POST" action="<?php echo base_url() ?>planning/workpack_new_process">
                <input type="hidden" name="test_pack_no" value="<?php echo $get['test_pack_no'] ?>">
                <input type="hidden" name="drawing_ga" value="<?php echo $get['drawing_ga'] ?>">
                <input type="hidden" name="project" value="<?php echo $get['project'] ?>">
                <input type="hidden" name="module" value="<?php echo $get['module'] ?>">
                <input type="hidden" name="type_of_module" value="<?php echo $get['type_of_module'] ?>">
                <input type="hidden" name="deck_elevation" value="<?php echo $get['deck_elevation'] ?>">
                <input type="hidden" name="discipline" value="<?php echo $get['discipline'] ?>">
                <input type="hidden" name="phase" value="<?php echo $get['phase'] ?>">
                <input type="hidden" name="desc_assy" value="<?php echo $get['desc_assy'] ?>">
                <input type="hidden" name="type" value="<?php echo @$get['type'] ?>">
                <input type="hidden" name="company_id" value="<?php echo $get['company_id'] ?>">
                <input type="hidden" name="company_yard" value="<?php echo $get['company_yard'] ?>">
                <input type="hidden" name="status_internal" value="<?php echo $get['status_internal'] ?>">
                <input type="hidden" name="piping_testing_category" value="<?php echo $get['piping_testing_category'] ?>">
                <input type="hidden" name="template_id">
                <div class="overflow-auto">
                  <table class="table table-hover text-center dataTable">
                    <thead class="bg-green-smoe text-white">
                      <tr>
                        <th><input type='checkbox' class='checkbox-big' name="check_all" onclick='checkall(this)'></th>
                        <th>Drawing GA</th>
                        <th>Rev GA</th>
                        <th>Drawing AS</th>
                        <th>Rev AS</th>
                        <th>Drawing SP</th>
                        <th>Rev SP</th>
                        <th>Part ID As</th>
                        <th>Cutting Plan</th>
                        <th>Cutting List</th>
                        <th>Profile</th>
                        <th>Material</th>
                        <th>Grade</th>
                        <th>Diameter</th>
                        <th>Thickness</th>
                        <th>Schedule</th>
                        <th>Length (mm)</th>
                        <th>Width</th>
                        <th>Weight (kg)</th>
                        <th>Area (m<sup>2</sup>)</th>
                        <th>Can Number</th>
                        <th>Test Pack Number</th>
                        <th>Remarks</th>
                        <th>Item Code (Piping Material)</th>
                        <th>Spool No</th>
                        <th>Beam/Channel (Thk)</th>
                        <th>Strain Age Test (D/T)</th>
                        <th>Strain Age Test (Yes/No)</th>
                        <th>Through Thickness</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($detail_list as $key => $value): ?>
                      <tr>
                        <td><input type='checkbox' class='checkbox-big' value='<?php echo $value['id'] ?>' onclick='save_checkbox(this)'></td>
                        <td><?php echo $value['drawing_ga'] ?></td>
                        <td><?php echo $value['rev_ga'] ?></td>
                        <td><?php echo $value['drawing_as'] ?></td>
                        <td><?php echo $value['rev_as'] ?></td>
                        <td><?php echo $value['drawing_sp'] ?></td>
                        <td><?php echo $value['rev_sp'] ?></td>
                        <td><?php echo $value['part_id'] ?></td>
                        <td><?php echo $value["drawing_cp"] ?></td>
                        <td><?php echo $value["drawing_cl"] ?></td>
                        <td><?php echo $value["profile"] ?></td>
                        <td><?php echo $value["material"] ?></td>
                        <td><?php echo @$material_grade_list[$value["grade"]]['material_grade'] ?></td>
                        <td><?php echo $value["diameter"] ?></td>
                        <td><?php echo $value["thickness"] ?></td>
                        <td><?php echo $value["sch"] ?></td>
                        <td><?php echo $value["length"] ?></td>
                        <td><?php echo $value["width"] ?></td>
                        <td><?php echo $value["weight"] ?></td>
                        <td><?php echo $value["area"] ?></td>
                        <td><?php echo $value["can_number"] ?></td>
                        <td><?php echo $value["test_pack_no"] ?></td>
                        <td><?php echo $value["remarks"] ?></td>
                        <td><?php echo $value["item_code"] ?></td>
                        <td><?php echo $value["spool_no"] ?></td>
                        <td><?php echo $value["beam_chnl_thk"] ?></td>
                        <td><?php echo $value["strain_age_test_dt"] ?></td>
                        <td><?php echo $value["strain_age_test_yn"] ?></td>
                        <td><?php echo $value["through_thickness"] ?></td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
                <br>
                <div class="col-md-4">
                  <div class="font-weight-bold">
                    You tick <span class="text-success num_ticker">0</span> piecemark to create workpack.<br>
                  </div>
                  <div class="row mb-1">
                    <div class="col-md-12">
                      <button type="button" class="btn btn-flat btn-success" onclick="create_workpack()"><i class='fas fa-check'></i> Create Workpack.</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php elseif(@$get['phase'] != ""): ?>
      <div class="row">
        <div class="col">
          <div class="card shadow my-3 rounded-0">
            <div class="card-header">
              <h6 class="m-0"><?php echo $meta_title ?></h6>
            </div>
            <div class="card-body bg-white">
              <form id="form_create_workpack" method="POST" action="<?php echo base_url() ?>planning/workpack_new_process">
                <input type="hidden" name="drawing_ga" value="<?php echo $get['drawing_ga'] ?>">
                <input type="hidden" name="test_pack_no" value="<?php echo $get['test_pack_no'] ?>">
                <input type="hidden" name="project" value="<?php echo $get['project'] ?>">
                <input type="hidden" name="module" value="<?php echo $get['module'] ?>">
                <input type="hidden" name="type_of_module" value="<?php echo $get['type_of_module'] ?>">
                <input type="hidden" name="deck_elevation" value="<?php echo $get['deck_elevation'] ?>">
                <input type="hidden" name="discipline" value="<?php echo $get['discipline'] ?>">
                <input type="hidden" name="phase" value="<?php echo $get['phase'] ?>">
                <input type="hidden" name="desc_assy" value="<?php echo $get['desc_assy'] ?>">
                <input type="hidden" name="type" value="<?php echo @$get['type'] ?>">
                <input type="hidden" name="company_id" value="<?php echo $get['company_id'] ?>">
                <input type="hidden" name="company_yard" value="<?php echo $get['company_yard'] ?>">
                <input type="hidden" name="status_internal" value="<?php echo $get['status_internal'] ?>">
                <input type="hidden" name="piping_testing_category" value="<?php echo $get['piping_testing_category'] ?>">
                <input type="hidden" name="template_id">
                <div class="overflow-auto">
                  <table class="table table-hover text-center dataTable">
                    <thead class="bg-green-smoe text-white">
                      <tr>
                        <th><input type='checkbox' class='checkbox-big' name="check_all" onclick='checkall(this)'></th>
                        <th>Drawing WM</th>
                        <th>Rev WM</th>
                        <th>Joint No.</th>
                        <th>Piecemark#1</th>
                        <th>Piecemark#2</th>
                        <th>Weld Type Code</th>
                        <th>Thickness</th>
                        <th>Diameter</th>
                        <th>Schedule</th>
                        <th>Length</th>
                        <th>Weld Length</th>
                        <th>Joint Type Code</th>
                        <th>Test Pack Number</th>
                        <th>Spool Number</th>
                        <th>Service Line</th>
                        <th>Class Code</th>
                        <th>Remarks</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($detail_list as $key => $value): ?>
                      <tr>
                        <td><input type='checkbox' class='checkbox-big' value='<?php echo $value['id'] ?>' onclick='save_checkbox(this)'></td>
                        <td><?php echo $value['drawing_wm'] ?></td>
                        <td><?php echo $value['rev_wm'] ?></td>
                        <td><?php echo $value['joint_no'] ?></td>
                        <td><?php echo $value['pos_1'] ?></td>
                        <td><?php echo $value['pos_2'] ?></td>
                        <td><?php echo @$weld_type[$value['weld_type']]['weld_type_code'] ?></td>
                        <td><?php echo $value['thickness'] ?></td>
                        <td><?php echo $value['diameter'] ?></td>
                        <td><?php echo $value['sch'] ?></td>
                        <td><?php echo $value['length'] ?></td>
                        <td><?php echo $value['weld_length'] ?></td>
                        <td><?php echo @$joint_type[$value['joint_type']]['joint_type_code'] ?></td>
                        <td><?php echo $value['test_pack_no'] ?></td>
                        <td><?php echo $value['spool_no'] ?></td>
                        <td><?php echo $value['service_line'] ?></td>
                        <td><?php echo $value['class'] ?></td>
                        <td><?php echo $value['remarks'] ?></td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
                <br>
                <div class="col-md-4">
                  <div class="font-weight-bold">
                    You tick <span class="text-success num_ticker">0</span> joint to create workpack.<br>
                  </div>
                  <div class="row mb-1">
                    <div class="col-md-12">
                      <button type="button" class="btn btn-flat btn-success" onclick="create_workpack()"><i class='fas fa-check'></i> Create Workpack.</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>
    <?php elseif($get['type'] == "2"): ?>
      <div class="row">
        <div class="col">
          <div class="card shadow my-3 rounded-0">
            <div class="card-header">
              <h6 class="m-0"><?php echo $meta_title ?></h6>
            </div>
            <div class="card-body bg-white">
              <form id="form_create_workpack" method="POST" action="<?php echo base_url() ?>planning/workpack_new_process">
                <input type="hidden" name="drawing_ga" value="<?php echo @$get['drawing_ga'] ?>">
                <input type="hidden" name="project" value="<?php echo $get['project'] ?>">
                <input type="hidden" name="module" value="<?php echo $get['module'] ?>">
                <input type="hidden" name="type_of_module" value="<?php echo $get['type_of_module'] ?>">
                <input type="hidden" name="deck_elevation" value="<?php echo $get['deck_elevation'] ?>">
                <input type="hidden" name="discipline" value="<?php echo $get['discipline'] ?>">
                <input type="hidden" name="phase" value="<?php echo @$get['phase'] ?>">
                <input type="hidden" name="desc_assy" value="<?php echo @$get['desc_assy'] ?>">
                <input type="hidden" name="type" value="<?php echo @$get['type'] ?>">
                <input type="hidden" name="company_id" value="<?php echo $get['company_id'] ?>">
                <input type="hidden" name="company_yard" value="<?php echo $get['company_yard'] ?>">
                <input type="hidden" name="piping_testing_category" value="<?php echo $get['piping_testing_category'] ?>">
                <input type="hidden" name="template_id">
                <div class="overflow-auto">
                  <table class="table table-hover text-center dataTable">
                    <thead class="bg-green-smoe text-white">
                      <tr>
                        <th><input type='checkbox' class='checkbox-big' name="check_all" onclick='checkall(this)'></th>
                        <!-- <th>Code Material</th> -->
                        <th>Material</th>
                        <th>Length</th>
                        <!-- <th>Thickness</th> -->
                        <!-- <th>Width</th> -->
                        <!-- <th>Weight</th> -->
                        <!-- <th>OD</th> -->
                        <!-- <th>Sch</th> -->
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($detail_list as $key => $value): ?>
                      <tr>
                        <td><input type='checkbox' class='checkbox-big' value='<?php echo $value['id'] ?>' onclick='save_checkbox(this)'></td>
                        <!-- <td><?php echo $value['code_material'] ?></td> -->
                        <td><?php echo $value['material'] ?></td>
                        <td><?php echo $value['length_m'] ?></td>
                        <!-- <td><?php echo $value['thk_mm'] ?></td> -->
                        <!-- <td><?php echo $value['width_m'] ?></td> -->
                        <!-- <td><?php echo $value['weight'] ?></td> -->
                        <!-- <td><?php echo $value['od'] ?></td> -->
                        <!-- <td><?php echo $value['sch'] ?></td> -->
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
                <br>
                <div class="col-md-4">
                  <div class="font-weight-bold">
                    You tick <span class="text-success num_ticker">0</span> material to create workpack.<br>
                  </div>
                  <div class="row mb-1">
                    <div class="col-md-12">
                      <button type="button" class="btn btn-flat btn-success" onclick="create_workpack()"><i class='fas fa-check'></i> Create Workpack.</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php elseif($get['type'] == "3"): ?>
      <div class="row">
        <div class="col">
          <div class="card shadow my-3 rounded-0">
            <div class="card-header">
              <h6 class="m-0"><?php echo $meta_title ?></h6>
            </div>
            <div class="card-body bg-white">
              <form id="form_create_workpack" method="POST" action="<?php echo base_url() ?>planning/workpack_new_process">
                <input type="hidden" name="drawing_ga" value="<?php echo @$get['drawing_ga'] ?>">
                <input type="hidden" name="project" value="<?php echo $get['project'] ?>">
                <input type="hidden" name="module" value="<?php echo $get['module'] ?>">
                <input type="hidden" name="type_of_module" value="<?php echo $get['type_of_module'] ?>">
                <input type="hidden" name="deck_elevation" value="<?php echo $get['deck_elevation'] ?>">
                <input type="hidden" name="discipline" value="<?php echo $get['discipline'] ?>">
                <input type="hidden" name="phase" value="<?php echo @$get['phase'] ?>">
                <input type="hidden" name="desc_assy" value="<?php echo @$get['desc_assy'] ?>">
                <input type="hidden" name="type" value="<?php echo @$get['type'] ?>">
                <input type="hidden" name="company_id" value="<?php echo $get['company_id'] ?>">
                <input type="hidden" name="company_yard" value="<?php echo $get['company_yard'] ?>">
                <input type="hidden" name="status_internal" value="<?php echo $get['status_internal'] ?>">
                <input type="hidden" name="piping_testing_category" value="<?php echo $get['piping_testing_category'] ?>">
                <input type="hidden" name="template_id">
                <div class="col-md-4">
                  <div class="row mb-1">
                    <div class="col-md-12">
                      <button type="button" class="btn btn-flat btn-success" onclick="create_workpack()"><i class='fas fa-check'></i> Create Workpack.</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  <?php endif; ?>

</div>
</div>
<script>
  $("select[name=module]").chained("select[name=project]");
  
  $(document).ready(function() {
    // change_type_workpack($("select[name=type]"));
    <?php if($type == 3): ?>
      $("[name=drawing_ga]").prop("required", false);
      $("[name=desc_assy]").prop("required", false);
    <?php endif; ?>
  })

  function change_type_workpack(input) {
    // $("[name=drawing_ga], [name=project], [name=module], [name=type_of_module], [name=deck_elevation], [name=discipline], [name=phase], [name=desc_assy]")
    // if($(input).val() == '2'){
    //   $("[name=drawing_ga], [name=phase], [name=desc_assy]").prop("disabled", true);
    // }
    // else{
    //   $("[name=drawing_ga], [name=phase], [name=desc_assy]").prop("disabled", false);
    // }
  }

  $('.dataTable').DataTable({
    order: [],
    columnDefs: [{
      "targets": 0,
      "orderable": false,
    }]
  })

  var data_checkbox = [];
  function save_checkbox(input) {
    console.log(data_checkbox);
    if($(input).prop("checked") == true && $.inArray($(input).val(), data_checkbox) == -1){
      data_checkbox.push($(input).val());
    }
    else if($(input).prop("checked") == false && $.inArray($(input).val(), data_checkbox) != -1){
      data_checkbox.splice( $.inArray($(input).val(), data_checkbox), 1 );
    }
    $(".num_ticker").html(data_checkbox.length)
  }

  function checkall(input) {
    $('#form_create_workpack input[type=checkbox]').each(function(i, obj) {
      if($(input).prop("checked") == true && $(obj).prop("checked") == false){
        $(obj).trigger("click");
        console.log("all"+$(obj).val());
      }
      else if($(input).prop("checked") == false && $(obj).prop("checked") == true){
        $(obj).trigger("click");
      }
    });
  }

  function create_workpack() {
    <?php if($type == 1): ?>
    if(data_checkbox.length > 0){
      sweetalert("loading", "Please wait...!");
      $("#form_create_workpack input[name=template_id]").val(data_checkbox.join(", "));
      document.getElementById("form_create_workpack").submit();
    }
    else{
      sweetalert("error", "No item selected!");
    }
    <?php elseif($type == 3): ?>
      sweetalert("loading", "Please wait...!");
      $("#form_create_workpack input[name=template_id]").val(data_checkbox.join(", "));
      document.getElementById("form_create_workpack").submit();
    <?php endif; ?>
  }

  $(".autocomplete_ga, .autocomplete_as").autocomplete({
    source: function( request, response ) {
      var project_id = $("#project_id option:selected").val();
      var drawing_type = 4;
      $.ajax( {
        url: "<?php echo base_url() ?>engineering/autocomplete_drawing",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: drawing_type,
          project_id: project_id,
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
        get_data_drawing(ui.item.value);
      }
    }
  });

  function get_data_drawing(document_no) {
    // var module = $("select[name=module]").val();
    console.log(document_no);
    // console.log(module);
    $.ajax( {
      url: "<?php echo base_url() ?>engineering/get_data_drawing",
      dataType: "json",
      data: {
        document_no: document_no,
        // module: module,
      },
      success: function(data) {
        console.log(data);
        // if(data.drawing_type == 1 || data.drawing_type == 2){
          $("select[name=project]").val(data.project).trigger('change');
          $("select[name=discipline]").val(data.discipline);
          $("select[name=module]").val(data.module);
          $("select[name=type_of_module]").val(data.type_of_module);
          $("select[name=deck_elevation]").val(data.deck_elevation);
        // }
      }
    });
  }
</script>