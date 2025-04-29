<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h6 class="card-title">Export - <strong>ITR</strong></h6>
            <hr>
            <form action="" target="_blank" method="post">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Project</label>
                    <div class="col-xl">
                      <select name="project_id" class="custom-select" onchange="get_module(this)">
                        <?php if ($this->permission_cookie[0] == 1): ?> 
                          <option value="">---</option>
                         <?php endif; ?>
                        <?php foreach ($project_list as $key => $value): ?>
                        <option value="<?= $value['id'] ?>"><?= $value['project_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Drawing Type</label>
                    <div class="col-xl">
                      <select name="drawing_type" class="custom-select">
                        <option value="">---</option>
                        <?php foreach ($drawing_type as $key => $value): ?> 
                         <option value="<?= $value['id'] ?>"><?= $value['description'] ?></option>
                         <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Discipline</label>
                    <div class="col-xl">
                      <select name="discipline" class="custom-select">
                        <option value="">---</option>
                        <?php foreach ($discipline_list as $key => $value): ?>
                        <option value="<?= $value['id'] ?>"><?= $value['discipline_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Module</label>
                    <div class="col-xl">
                      <select name="module" class="custom-select module" <?= $this->permission_cookie[0] == 1 ? 'disabled' : '' ?>>
                        <option value="">---</option>
                        <?php if ($this->permission_cookie[0] != 1): ?> 
                         <?php foreach ($module_list[$this->user_cookie[10]] as $key => $value): ?> 
                          <option value="<?= $value['mod_id'] ?>"><?= $value['mod_desc'] ?></option>
                          <?php endforeach; ?>
                         <?php endif; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Type Of Module</label>
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

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Deck Elevation / Service Line</label>
                    <div class="col-xl">
                      <select name="deck_elevation" class="select2" style="width:100%">
                        <option value="">---</option>
                        <?php foreach ($deck_elevation as $key => $value): ?>
                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Status Submission</label>
                    <div class="col-xl">
                      <select name="status_inspection[]" class="select2" style="width: 100%" multiple>
                        <option value="">---</option>
                        <option value="0">Ready</option>
                        <option value="1">Pending Approval QC</option>
                        <option value="2">Rejected By QC</option>
                        <option value="3">Approved By QC</option>
                        <option value="4">Hold By QC</option>
                      </select>
                    </div>
                  </div>
                </div>

                <?php if($this->user_cookie[11] == 1){ ?>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Company</label>
                    <div class="col-xl">
                      <select name="company_id" class="select2" style="width:100%">
                        <?php if ($this->permission_cookie[0] == 1): ?> 
                          <option value="" <?= $this->input->post('company_id') == 0 ? 'selected' : '' ?>>---</option>
                         <?php endif; ?>
                        <?php foreach($company_list as $key => $value){ ?>
                        <option value="<?= $value['id_company'] ?>"
                          <?= $this->input->post('company_id') == $value['id_company'] ? 'selected' : '' ?>>
                          <?= $value['company_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <?php } ?>


                <div class="col-md-12">

                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <input id="cb" name="history_included" value="1" type="checkbox" style="width: 20px; height:20px;float: left;">
                    <div style="margin-left: 30px; line-height: 1.3;">
                      <label><i><strong>History Included</strong></i></label>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <hr>
                  <div class="float-right">
                    <!-- <button type="submit" name="submit" value="reject" class="btn btn-danger text-white"><i class="fas fa-cloud-download-alt"></i>
                      Export Reject Summary</button> -->
                    <button type="submit" name="submit" value="register" class="btn btn-green-smoe text-white"><i
                        class="fas fa-cloud-download-alt"></i>
                      Export ITR</button>
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
function get_module(select) {
  var project_id = $(select).val()
  $.ajax({
    url: "<?= site_url('material_verification/find_module_by_project') ?>",
    data: {
      project_id: project_id
    },
    type: "POST",
    dataType: "JSON",
    success: function(data) {
      var html = []
      html.push(`<option value="">---</option>`)
      data.map(function(v, i) {
        html.push(`<option value="${v.mod_id}">${v.mod_desc}</option>`)
      })

      $('.module').html(html)
      $('.module').removeAttr('disabled')
    }
  })
}
</script>