<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?> Workpack</h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form id="form_workpack" action="<?php echo base_url() ?>planning/workpack_excel_api" method="POST" target="_blank">
            <input type="hidden" name="type" value="1">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
                  <div class="col-md">
                    <select class="form-control" name="project" required>
                      <option value="">---</option>
                      <?php foreach ($project_list as $key => $value) : ?>
												<?php if (in_array($value['id'], $this->user_cookie[13])) : ?>
                      		<option value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : ($this->user_cookie[10] == $value['id'] ? 'selected' : '')) ?>><?php echo $value['project_name'] ?></option>
                      	<?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status</label>
                  <div class="col-md">
                    <select class="form-control" name="status">
                      <option value="">---</option>
                      <option value="1" <?php echo (@$get['status'] == "1" ? 'selected' : '') ?>>Draft</option>
                      <option value="8" <?php echo (@$get['status'] == "8" ? 'selected' : '') ?>>Pending Engineering</option>
                      <option value="2" <?php echo (@$get['status'] == "2" ? 'selected' : '') ?>>Pending Project / Construction Engineering (Issued)</option>
                      <option value="9" <?php echo (@$get['status'] == "9" ? 'selected' : '') ?>>Pending Construction Superintendent (Issued)</option>
                      <option value="3" <?php echo (@$get['status'] == "3" ? 'selected' : '') ?>>Issued</option>
                      <option value="6" <?php echo (@$get['status'] == "6" ? 'selected' : '') ?>>In Progress</option>
                      <option value="7" <?php echo (@$get['status'] == "7" ? 'selected' : '') ?>>Overdue</option>
                      <option value="10" <?php echo (@$get['status'] == "10" ? 'selected' : '') ?>>Pending Project / Construction Engineering (Returned)</option>
                      <option value="11" <?php echo (@$get['status'] == "11" ? 'selected' : '') ?>>Pending Construction Superintendent (Returned)</option>
                      <option value="4" <?php echo (@$get['status'] == "4" ? 'selected' : '') ?>>Completed</option>
                      <option value="5" <?php echo (@$get['status'] == "5" ? 'selected' : '') ?>>Rejected</option>
                      <option value="12" <?php echo (@$get['status'] == "12" ? 'selected' : '') ?>>Void</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
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
              <div class="col-6">
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
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Deck Elevation / Service Line</label>
                  <div class="col-md">
                    <select class="form-control" name="deck_elevation">
                      <option value="">---</option>
                      <?php foreach ($deck_elevation_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                  <div class="col-md">
                    <select class="form-control" name="discipline">
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Phase</label>
                  <div class="col-md">
                    <select class="form-control" name="phase">
                      <!-- <option value="">---</option> -->
                      <option value="PF" <?php echo (@$get['phase'] == "PF" ? 'selected' : '') ?>>PF - Pre-Fabrication</option>
                      <option value="FB" <?php echo (@$get['phase'] == "FB" ? 'selected' : '') ?>>FB - Fabrication</option>
                      <option value="AS" <?php echo (@$get['phase'] == "AS" ? 'selected' : '') ?>>AS - Assembly</option>
                      <option value="ER" <?php echo (@$get['phase'] == "ER" ? 'selected' : '') ?>>ER - Erection</option>
                      <option value="B&P" <?php echo (@$get['phase'] == "B&P" ? 'selected' : '') ?>>B&P - B&P</option>
                      <option value="ITR" <?php echo (@$get['phase'] == "ITR" ? 'selected' : '') ?>>ITR - Inspection & Test Record</option>
                      <option value="BAA" <?php echo (@$get['phase'] == "BAA" ? 'selected' : '') ?>>BAA - Bondstrand Adhesive Assembly</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Description Assy Code</label>
                  <div class="col-md">
                    <select class="form-control select2" name="desc_assy">
                      <option value="">---</option>
                      <?php foreach ($desc_assy_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['desc_assy'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Assigned Company</label>
                  <div class="col-md">
                    <select class="form-control select2" name="company_id">
                      <option value="">---</option>
                      <?php foreach ($company_list as $key => $value) : ?>
												<?php if($this->user_cookie[11] == 1 || $value['id_company'] == $this->user_cookie[11]): ?>
                          <option value="<?php echo $value['id_company'] ?>" <?php echo (@$get['company_id'] == $value['id_company'] ? 'selected' : ($this->user_cookie[11] == $value['id_company'] ? 'selected' : '')) ?>><?php echo $value['company_name'] ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Yard Company</label>
                  <div class="col-md">
                    <select class="form-control select2" name="company_yard">
                      <option value="">---</option>
                      <?php foreach ($company_list as $key => $value) : ?>
												<?php if(in_array($value['id_company'], $this->user_cookie[14])): ?>
                          <option value="<?php echo $value['id_company'] ?>" <?php echo (@$get['company_yard'] == $value['id_company'] ? 'selected' : ($this->user_cookie[11] == $value['id_company'] ? 'selected' : '')) ?>><?php echo $value['company_name'] ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Issued Date From</label>
                  <div class="col-xl">
                    <input name="date_from" type="date" class="form-control">
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Issued Date To</label>
                  <div class="col-xl">
                    <input name="date_to" type="date" class="form-control">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-right">
                <button class="mt-2 btn btn-sm btn-flat btn-success" name="submit" value="search"><i class="fas fa-export"></i> Export</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?> TimeSheet</h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="<?php echo base_url() ?>planning/workpack_timesheet_excel_new_process" method="GET">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Workpack No</label>
                  <div class="col-md">
                    <input type="text" class="form-control" name="workpack_no">
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Job No</label>
                  <div class="col-md">
                    <input type="text" class="form-control" name="job_no">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Date From</label>
                  <div class="col-md">
                    <input type="date" class="form-control" name="date_from" required>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Date To</label>
                  <div class="col-md">
                    <input type="date" class="form-control" name="date_to" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-right">
                <button class="mt-2 btn btn-sm btn-flat btn-success" name="submit" value="search"><i class="fas fa-export"></i> Export</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?> Workpack Activity</h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form id="form_workpack_activity" action="<?php echo base_url() ?>planning/workpack_activity_excel_api" method="POST" target="_blank">
            <input type="hidden" name="type" value="1">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
                  <div class="col-md">
                    <select class="form-control" name="project" required>
                      <option value="">---</option>
                      <?php foreach ($project_list as $key => $value) : ?>
												<?php if (in_array($value['id'], $this->user_cookie[13])) : ?>
                      		<option value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : ($this->user_cookie[10] == $value['id'] ? 'selected' : '')) ?>><?php echo $value['project_name'] ?></option>
                      	<?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Description Assy Code</label>
                  <div class="col-md">
                    <select class="form-control select2" name="desc_assy">
                      <option value="">---</option>
                      <?php foreach ($desc_assy_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['desc_assy'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
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
              <div class="col-6">
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
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Deck Elevation / Service Line</label>
                  <div class="col-md">
                    <select class="form-control" name="deck_elevation">
                      <option value="">---</option>
                      <?php foreach ($deck_elevation_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                  <div class="col-md">
                    <select class="form-control" name="discipline">
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Phase</label>
                  <div class="col-md">
                    <select id="phase_activity" class="form-control" name="phase">
                      <option value="">---</option>
                      <option value="PF" <?php echo (@$get['phase'] == "PF" ? 'selected' : '') ?>>PF - Pre-Fabrication</option>
                      <option value="FB" <?php echo (@$get['phase'] == "FB" ? 'selected' : '') ?>>FB - Fabrication</option>
                      <option value="AS" <?php echo (@$get['phase'] == "AS" ? 'selected' : '') ?>>AS - Assembly</option>
                      <option value="ER" <?php echo (@$get['phase'] == "ER" ? 'selected' : '') ?>>ER - Erection</option>
                      <option value="B&P" <?php echo (@$get['phase'] == "B&P" ? 'selected' : '') ?>>B&P - B&P</option>
                      <option value="ITR" <?php echo (@$get['phase'] == "ITR" ? 'selected' : '') ?>>ITR - Inspection & Test Record</option>
                      <option value="BAA" <?php echo (@$get['phase'] == "BAA" ? 'selected' : '') ?>>BAA - Bondstrand Adhesive Assembly</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Job Description</label>
                  <div class="col-md">
                    <select class="form-control select2" name="job_description">
                      <option value="">---</option>
                      <?php foreach ($job_description_list as $key => $value) : ?>
                        <option value="<?php echo $value['description'] ?>" data-chained="<?php echo $value['phase'] ?>"><?php echo $value['description'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Assigned Company</label>
                  <div class="col-md">
                    <select class="form-control select2" name="company_id">
                      <option value="">---</option>
                      <?php foreach ($company_list as $key => $value) : ?>
												<?php if($this->user_cookie[11] == 1 || $value['id_company'] == $this->user_cookie[11]): ?>
                          <option value="<?php echo $value['id_company'] ?>" <?php echo (@$get['company_id'] == $value['id_company'] ? 'selected' : ($this->user_cookie[11] == $value['id_company'] ? 'selected' : '')) ?>><?php echo $value['company_name'] ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Yard Company</label>
                  <div class="col-md">
                    <select class="form-control select2" name="company_yard">
                      <option value="">---</option>
                      <?php foreach ($company_list as $key => $value) : ?>
												<?php if(in_array($value['id_company'], $this->user_cookie[14])): ?>
                          <option value="<?php echo $value['id_company'] ?>" <?php echo (@$get['company_yard'] == $value['id_company'] ? 'selected' : ($this->user_cookie[11] == $value['id_company'] ? 'selected' : '')) ?>><?php echo $value['company_name'] ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Issued Date From</label>
                  <div class="col-xl">
                    <input name="date_from" type="date" class="form-control">
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Issued Date To</label>
                  <div class="col-xl">
                    <input name="date_to" type="date" class="form-control">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-right">
                <button class="mt-2 btn btn-sm btn-flat btn-success" name="submit" value="search"><i class="fas fa-export"></i> Export</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script>
  $("#form_workpack select[name=module]").chained("#form_workpack select[name=project]");
  $("#form_workpack_activity select[name=module]").chained("#form_workpack_activity select[name=project]");
  $("select[name=job_description]").chained("select#phase_activity");
</script>