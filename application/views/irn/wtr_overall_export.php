<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h6 class="card-title">Export WTR Overall</h6>
            <hr>
            <form action="<?= site_url('wtr/proceed_export_wtr_overall') ?>" method="post">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="" class="col-xl-2 col-form-label text-muted"> Project</label>
                    <div class="col-xl">
                      <select name="project_code" class="custom-select" onchange="get_module_list(this)" required>
                        <option value="">---</option>
                         <?php if($this->permission_cookie[0] == 1){ ?>                          
                            <?php foreach ($project_list as $key => $value) : ?>
                            <option onclick="save_project()" value="<?php echo $value['id'] ?>" <?php echo (@$user_cookie[10] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                            <?php endforeach; ?>
                          <?php } else { ?>
                            <?php foreach ($project_list as $key => $value) : ?>
                              <?php if($this->user_cookie[10] == $value['id']){ ?>
                                <option onclick="save_project()" value="<?php echo $value['id'] ?>" <?php echo (@$user_cookie[10] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                              <?php } ?>
                            <?php endforeach; ?>
                          <?php } ?>
                        <!-- <?php foreach ($project_list as $key => $value): ?>
                        <option value="<?= $value['id'] ?>"><?= $value['project_name'] ?></option>
                        <?php endforeach; ?> -->
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="" class="col-xl-2 col-form-label text-muted"> Discipline</label>
                    <div class="col-xl">
                      <select name="discipline" class="custom-select" required>
                        <option value="">---</option>
                        <?php foreach ($discipline_list as $key => $value): ?>
                        <option value="<?= $value['id'] ?>"><?= $value['discipline_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="" class="col-xl-2 col-form-label text-muted" required> Type Of Module</label>
                    <div class="col-xl">
                      <select name="type_of_module" class="custom-select">
                        <option value="">---</option>
                        <?php foreach ($type_of_module as $key => $value): ?>
                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="" class="col-xl-2 col-form-label text-muted" required> Module</label>
                    <div class="col-xl">
                      <select name="module" class="custom-select">

                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <hr>
                  <div class="float-right">
                    <button type="submit" name="submit" value="excel" class="btn btn-green-smoe text-white"><i
                        class="fas fa-file-excel"></i> Export <b>- Excel</b></button>
                    <button type="submit" name="submit" value="pdf" class="btn btn-danger"><i
                        class="fas fa-file-pdf"></i> Export <b>- PDF</b></button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script>
function get_module_list(select) {
  var project_id = $(select).val()
  $.ajax({
    url           : "<?= site_url('wtr/module_list_by_project') ?>",
    type          : "POST",
    data          : {
      project_id  : project_id
    },
    dataType      : "JSON",
    success       : function(data) {
      var html    = []
      html.push(`<option value="">---</option>`)
      data.map(function(v, i) {
        html.push(`<option value="${v.mod_id}">${v.mod_desc}</option>`)
      })

      $('select[name=module]').html(html)
    }
  })
}
</script>