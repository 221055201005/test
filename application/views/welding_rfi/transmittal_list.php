<div id="content" class="container-fluid">

  <div class="card shadow my-3 rounded-0 d-none">
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
                  <option value="">---</option>
                  <?php foreach ($project_list as $key => $value) : ?>
                  <option value="<?php echo $value['id'] ?>" <?php echo ($this->input->get("project") == $value['id'] ? "selected" : "") ?>><?php echo $value['project_name'] ?></option>
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
            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Submit</button>
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
        <table id="table_rfi" class="table table-hover text-center dataTable">
          <thead class="bg-green-smoe text-white">
            <tr>
              <th><input type='checkbox' class='checkbox-big' name="check_all" onclick='checkall(this)'></th>
              <th>Project</th>
              <th>Category</th>
              <th>RFI No.</th>
              <th>Type of Inspection</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($rfi_list as $key => $value): ?>
              <tr>
                <td><input type='checkbox' class='checkbox-big' value='<?php echo $value['id'] ?>' onclick='save_checkbox(this)'></td>
                <td><?php echo @$project_list[$value["project"]]['project_name'] ?></td>
                <td><?php echo $value["category"] ?></td>
                <td><?php echo $value["rfi_no"] ?></td>
                <td><?php echo $value["type_of_inspection"] ?></td>
                <td><a href="<?php echo base_url() ?>welding_rfi/rfi_detail/<?php echo strtr($this->encryption->encrypt($value["id"]), '+=/', '.-~') ?>" class="btn btn-sm btn-secondary">Detail</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        
      </div>
      <div class="row">
        <div class="col-md-auto">
          <div class="font-weight-bold">
            You tick <span class="text-primary num_ticker">0</span> RFI to Transmit.<br>
          </div>
          <form method="POST" action="<?php echo base_url() ?>welding_rfi/rfi_transmit_process" onsubmit="save_id_checked(this)">
            <input type="hidden" name="id">
            <div class="row mb-1">
              <div class="col-md-12">
                <button type="submit" name="submit" value="delete" class="btn btn-primary"><i class='fas fa-check'></i> Transmit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
</div>
<script>
  $('.dataTable').DataTable({});

  var data_checkbox = [];
  function save_checkbox(input) {
    //console.log(data_checkbox);
    if($(input).prop("checked") == true && $.inArray($(input).val(), data_checkbox) == -1){
      data_checkbox.push($(input).val());
    }
    else if($(input).prop("checked") == false && $.inArray($(input).val(), data_checkbox) != -1){
      data_checkbox.splice( $.inArray($(input).val(), data_checkbox), 1 );
    }
    $(".num_ticker").html(data_checkbox.length)
  }

  function checkall(input) {
    $('#table_rfi tbody input[type=checkbox]').each(function(i, obj) {
      if($(input).prop("checked") == true && $(obj).prop("checked") == false){
        //console.log("all"+$(obj).val());
        $(obj).trigger("click");
      }
      else if($(input).prop("checked") == false && $(obj).prop("checked") == true){
        $(obj).trigger("click");
      }
    });
  }

  function save_id_checked(form) {
    $(form).find("input[name=id]").val(data_checkbox.join(", "));
  }
</script>