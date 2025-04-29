<div id="content" class="container-fluid">

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>
    
    <div class="card-body bg-white overflow-auto">
      <form action="" method="GET">
        <div class="row">
          <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
              <div class="col-md">

                <select class="form-control project <?= $this->permission_cookie[0]==1 ? '' : 'avoid-clicks' ?>" name="project" required="">
                  <?php foreach ($project_list as $key => $value) : ?>
											<?php if(in_array($value['id'], $this->user_cookie[13])): ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$this->input->get('project') == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </select> 

              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type Of Module</label>
              <div class="col-md">

                  <select class="form-control type_of_module" name="type_of_module">
                      <option value="">---</option>
                      <?php foreach ($type_of_module_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo ($this->input->get("type_of_module") == $value['id'] ? "selected" : "") ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                      <?php endforeach; ?>
                  </select>

              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
              <div class="col-md">

                <select class="form-control discipline" name="discipline" >
                  <option value="">---</option>
                  <?php foreach ($discipline_list as $key => $value) : ?>
                  <option value="<?php echo $value['id'] ?>" <?php echo ($this->input->get("discipline") == $value['id'] ? "selected" : "") ?>><?php echo $value['discipline_name'] ?></option>
                  <?php endforeach; ?>
                </select>

              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Phase</label>
              <div class="col-md">

                <select class="form-control phase" name="phase" >
                  <option value="">---</option>

                  <option value="FB" <?php echo ($this->input->get("phase") == "FB" ? "selected" : "") ?>>FB</option>
                  <option value="AS" <?php echo ($this->input->get("phase") == "AS" ? "selected" : "") ?>>AS</option>
                  <option value="ER" <?php echo ($this->input->get("phase") == "ER" ? "selected" : "") ?>>ER</option>

                </select>

              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">From</label>
              <div class="col-md">
                <input type="date" class="form-control" name="date_from" value="<?php echo ($this->input->get("date_from") ? $this->input->get("date_from") : "") ?>" required>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">To</label>
              <div class="col-md">
                <input type="date" class="form-control" name="date_to" value="<?php echo ($this->input->get("date_to") ? $this->input->get("date_to") : "") ?>" required>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-right">
            <button type="submit" class="btn btn-info btn-flat btn-sm"><i class="fa fa-search"></i> Filter</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>
    
    <div class="card-body bg-white">
      <div class="overflow-auto">
        <table class="table table-hover text-center dataTable">
          <thead class="bg-green-smoe text-white">
            <tr>
              <th>Week No</th>
              <th>Year</th>
              <th>From Date</th>
              <th>To Date</th>
              <th>Project</th>
              <th>Type Of Module</th>
              <th>Discipline</th>
              <th>Phase</th>
              <!-- <th>From</th> -->
              <!-- <th>To</th> -->
              <th>Plan Target</th>
              <!-- <th></th> -->
            </tr>
          </thead>
          <tbody>
            <?php 
              foreach ($plan_list as $key => $value): 
                $week_start = new DateTime();
                $week_start->setISODate($value["year_week"], $value["week_no"]);
                $week_start = $week_start->format('Y-m-d');
                $week_end = date("Y-m-d", strtotime($week_start." +6 days"));
            ?>
              <tr>
                <td><?php echo $value["week_no"] ?></td>
                <td><?php echo $value["year_week"] ?></td>
                <td><?php echo $week_start ?></td>
                <td><?php echo $week_end ?></td>
                <td><?php echo @$project_list[$value["project"]]['project_name'] ?></td>
                <td><?php echo @$type_of_module_list[$value["type_of_module"]]['name'] ?></td>
                <td><?php echo @$discipline_list[$value["discipline"]]['discipline_name'] ?></td>
                <td><?php echo $value["phase"] ?></td>
                <!-- <td><?php echo date("Y-m-d", strtotime("Last Monday ".$value["period"])) ?></td> -->
                <!-- <td><?php echo date("Y-m-d", strtotime("Next Sunday ".$value["period"])) ?></td> -->
                <td><?php echo $value["plan_target"] ?>%</td>
                <!-- <td><a></a></td> -->
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
</div>
<script>
  $('.dataTable').DataTable({"order" : []});
</script>