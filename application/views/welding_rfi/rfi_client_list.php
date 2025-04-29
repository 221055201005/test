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
                <?php
                  if($this->input->get("project")){
                    $project_select = $this->input->get("project");
                  }
                  else{
                    $project_select = $this->user_cookie[10];
                  }
                ?>
                <select class="form-control project <?= $this->permission_cookie[0]==1 ? '' : 'avoid-clicks' ?>" name="project" required="">
                  <?php foreach ($project_list as $key => $value) : ?>
										<?php if(in_array($value['id'], $this->user_cookie[13])): ?>
                  		<option value="<?php echo $value['id'] ?>" <?php echo ($project_select == $value['id'] ? "selected" : "") ?>><?php echo $value['project_name'] ?></option>
										<?php endif; ?>
                  <?php endforeach; ?>
                </select> 

              </div>
            </div>
          </div>
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
        </div>
        <div class="row">
          <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status</label>
              <div class="col-md">

                <select class="form-control discipline" name="client_status" >
                  <option value="">---</option>
                  <!-- <option value="0" <?php echo ($this->input->get("client_status") == "0" ? "selected" : "")  ?>>Draft</option> -->
                  <option value="1" <?php echo ($this->input->get("client_status") == "1" ? "selected" : "")  ?>>Pending Approval</option>
                  <option value="2" <?php echo ($this->input->get("client_status") == "2" ? "selected" : "")  ?>>Rejected</option>
                  <option value="3" <?php echo ($this->input->get("client_status") == "3" ? "selected" : "")  ?>>Approved</option>
                </select>

              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Category</label>
              <div class="col-md">

                <select class="form-control discipline" name="category" >
                  <option value="">---</option>
                  <option value="WPQT" <?php echo ($this->input->get("category") == "WPQT" ? "selected" : "")  ?>>WPQT</option>
                  <option value="WQT" <?php echo ($this->input->get("category") == "WQT" ? "selected" : "")  ?>>WQT</option>
                </select>

              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-right">
            <button type="submit" class="btn btn-sm btn-info" name="submit" value="search"><i class="fa fa-search"></i> Filter</button>
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
              <th>Project</th>
              <th>Discipline</th>
              <th>Category</th>
              <th>RFI No.</th>
              <th>Type of Inspection</th>
              <th>Inspection Date</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($rfi_list as $key => $value): ?>
              <tr>
                <td><?php echo @$project_list[$value["project"]]['project_name'] ?></td>
                <td><?php echo @$discipline_list[$value["discipline"]]['discipline_name'] ?></td>
                <td><?php echo $value["category"] ?></td>
                <td><?php echo $value["rfi_no"] ?></td>
                <td><?php echo $value["type_of_inspection"] ?></td>
                <td><?php echo $value["inspection_date"] ?></td>
                <td>
                  <?php if($value["client_status"] == 0): ?>
                    <span class="badge badge-warning">Draft</span>
                  <?php elseif($value["client_status"] == 1): ?>
                    <span class="badge badge-primary">Pending for Approval</span>
                  <?php elseif($value["client_status"] == 2): ?>
                    <span class="badge badge-danger">Rejected</span>
                  <?php elseif($value["client_status"] == 3): ?>
                    <span class="badge badge-success">Approved</span>
                  <?php endif; ?>
                </td>
                <td><a href="<?php echo base_url() ?>welding_rfi/rfi_detail/<?php echo strtr($this->encryption->encrypt($value["id"]), '+=/', '.-~') ?>" class="btn btn-sm btn-secondary">Detail</a></td>
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
  $('.dataTable').DataTable({});
</script>