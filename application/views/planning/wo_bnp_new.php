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

              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
                  <div class="col-md">
                    <select class="form-control" name="project" required>
                      <?php foreach ($project_list as $key => $value) : ?>
													<?php if(in_array($value['id'], $this->user_cookie[13])): ?>
                          <option value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
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
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Company</label>
                  <div class="col-md">
                    <select class="form-control select2" name="company_id" required>
                      <?php foreach ($company_list as $key => $value) : ?>
                        <option value="<?php echo $value['id_company'] ?>" <?php echo (@$get['company_id'] == $value['id_company'] ? 'selected' : '') ?>><?php echo $value['company_name'] ?></option>
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
    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0"><?php echo $meta_title ?></h6>
          </div>
          <div class="card-body bg-white">
            <form id="form_create_workpack" method="POST" action="<?php echo base_url() ?>planning/wo_bnp_new_process">
              <input type="hidden" name="project" value="<?php echo $get['project'] ?>">
              <input type="hidden" name="module" value="<?php echo $get['module'] ?>">
              <input type="hidden" name="type_of_module" value="<?php echo $get['type_of_module'] ?>">
              <input type="hidden" name="discipline" value="<?php echo $get['discipline'] ?>">
              <input type="hidden" name="company_id" value="<?php echo $get['company_id'] ?>">
              <input type="hidden" name="template_id">
              <div class="overflow-auto">
                <table class="table table-hover text-center dataTable">
                  <thead class="bg-green-smoe text-white">
                    <tr>
                      <th><input type='checkbox' class='checkbox-big' name="check_all" onclick='checkall(this)'></th>
                      <th>Unique No.</th>
                      <th>MRIR No.</th>
                      <th>DO / PL No.</th>
                      <th>Description</th>
                      <th>Qty</th>
                      <th>Thk (mm)</th>
                      <th>Width (mm)</th>
                      <th>Length (mm)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($detail_list as $key => $value): ?>
                      <tr>
                        <td><input type='checkbox' class='checkbox-big' value='<?php echo $value['mb_id'] ?>' onclick='save_checkbox(this)'></td>
                        <td><?= @$value['unique_ident_no'] ?></td>
                        <td><?= explode('/', @$value['report_no'])[1] ?></td>
                        <td><?= @$value['do_or_pl_no'] ?></td>
                        <td><?= @$value['description'] ?></td>
                        <td><?= @$value['bal_qty'] ?></td>
                        <td><?= @$value['thk'] ?></td>
                        <td><?= @$value['width'] ?></td>
                        <td><?= @$value['length'] ?></td>
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
  <?php endif; ?>
    

</div>
</div>
<script>
  $("select[name=module]").chained("select[name=project]");

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
    if(data_checkbox.length > 0){
      sweetalert("loading", "Please wait...!");
      $("#form_create_workpack input[name=template_id]").val(data_checkbox.join(", "));
      document.getElementById("form_create_workpack").submit();
    }
    else{
      sweetalert("error", "No item selected!");
    }
  }
</script>