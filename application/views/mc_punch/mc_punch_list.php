<?php
  $get = $this->input->get();
?>
<div id="content" class="container-fluid">
  <div class="row">
    <div class="col">
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
                  <div class="col-xl">
                    <select class="form-control" name="project" id='project_id'>
											<?php foreach ($project_list as $key => $value) : ?>
												<?php if(in_array($value['id'], $this->user_cookie[13])): ?>
                        	<option value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
												<?php endif; ?>
											<?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="module">
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
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                  <div class="col-xl">
                    <select class="form-control" name="discipline">
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['mc_code'] ?> (<?php echo $value['discipline_name'] ?>)</option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status</label>
                  <div class="col-xl">
                    <select class="form-control" name="status">
                      <option value="">---</option>
                      <option value="0" <?php echo (@$get['status'] == '0' ? 'selected' : '') ?>>Open</option>
                      <option value="1" <?php echo (@$get['status'] == '1' ? 'selected' : '') ?>>Drafting Document</option>
                      <option value="2" <?php echo (@$get['status'] == '2' ? 'selected' : '') ?>>Completed Work</option>
                      <option value="3" <?php echo (@$get['status'] == '3' ? 'selected' : '') ?>>Pending Inspection</option>
                      <option value="2|3" <?php echo (@$get['status'] == '2|3' ? 'selected' : '') ?>>Completed Work & Pending Inspection</option>
                      <option value="4" <?php echo (@$get['status'] == '4' ? 'selected' : '') ?>>Rejected Inspection</option>
                      <option value="5" <?php echo (@$get['status'] == '5' ? 'selected' : '') ?>>Approved Inspection</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Checklist</label>
                  <div class="col-xl">
                    <input type="text" class="form-control" name="checklist" value="<?php echo @$get['checklist'] ?>">
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">System</label>
                  <div class="col-xl">
                    <input type="text" class="form-control" name="system" value="<?php echo @$get['system'] ?>">
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">SubSystem</label>
                  <div class="col-xl">
                    <input type="text" class="form-control" name="subsystem" value="<?php echo @$get['subsystem'] ?>">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-right">
                <button class="mt-2 btn btn-sm btn-flat btn-info" name="submit" value="search"><i class="fas fa-search"></i> Search</button>
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
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
          <div class="overflow-auto">
            <table id="mc_punch_list" class="table table-hover text-center dataTable">
              <thead class="bg-green-smoe text-white">
                <tr>
                  <th><input type='checkbox' class='checkbox-big' name="check_all" onclick='checkall(this)'></th>
                  <th>Project</th>
                  <th>Module </th>
                  <th>Type Of Module</th>
                  <th>Discipline </th>
                  <th>Punch ID No</th>
                  <th>Event ID No</th>
                  <th>System</th>
                  <th>SubSystem</th>
                  <th>Checklist</th>
                  <th>Tag No</th>
                  <th>Description</th>
                  <th>Cat</th>
                  <th>Action by</th>
                  <th>Phase</th>
                  <th>Last Update</th>
                  <th>Progress</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>
          <br>
          <div class="row">
            <?php if($this->permission_cookie[153] == 1): ?>
              <div class="col-md-auto">
                <div class="font-weight-bold">
                  You tick <span class="text-danger num_ticker">0</span> Checklist to Delete.<br>
                </div>
                <form method="POST" action="<?php echo base_url() ?>mc_punch/mechanical_delete_process" onsubmit="save_id_checked(this)">
                  <input type="hidden" name="id">
                  <input type="hidden" name="action" value="delete">
                  <div class="row mb-1">
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-danger" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Delete&nbsp;</b> this?', this, event)"><i class='fas fa-trash'></i> Delete</button>
                    </div>
                  </div>
                </form>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script>
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
    $('#mc_punch_list tbody input[type=checkbox]').each(function(i, obj) {
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

  $('.dataTable').DataTable({
    order: [],
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": "<?php echo base_url();?>mc_punch/mc_punch_list_datatable",
      "type": "POST",
      "data":{
          "page" : 'list',
      <?php 
        if($this->input->get('submit')){
          echo '"submit": "'. $this->input->get('submit').'",';
          if($this->input->get('project')){
            echo '"project": '. $this->input->get('project').',';
          }
          if($this->input->get('module')){
            echo '"module": '. $this->input->get('module').',';
          }
          if($this->input->get('type_of_module')){
            echo '"type_of_module": '. $this->input->get('type_of_module').',';
          }
          if($this->input->get('discipline')){
            echo '"discipline": '. $this->input->get('discipline').',';
          }
          if($this->input->get('status') != ''){
            echo '"status": "'. $this->input->get('status').'",';
          }
          if($this->input->get('cert_id') !== ''){
            echo '"checklist": "'. $this->input->get('checklist').'",';
          }
          if($this->input->get('system') !== ''){
            echo '"system": "'. $this->input->get('system').'",';
          }
          if($this->input->get('subsystem') !== ''){
            echo '"subsystem": "'. $this->input->get('subsystem').'",';
          }
        }
      ?>
      }
    },
    columnDefs: [{
      "targets": 0,
      "orderable": false,
      "render": function ( data, type, row, meta ) {
        var return_text = '';
        if(jQuery.inArray(row[0], data_checkbox) != -1) {
          return_text += "<input type='checkbox' class='checkbox-big' value='"+ row[0] +"' onclick='save_checkbox(this)' checked>";
        } else {
          return_text += "<input type='checkbox' class='checkbox-big' value='"+ row[0] +"' onclick='save_checkbox(this)'>";
        }
        
        return return_text;
      }
    }]
  })
</script>