<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow">
          <div class="card-header">
            <h6 class="card-title m-0 font-weight-bold"> Export MTS</h6>
          </div>
          <div class="card-body">
            <form action="<?= site_url('mts/proceed_export_mts') ?>" method="post">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Project</label>
                    <div class="col-xl">
                      <select name="project_id"  onchange="get_module(this)" class="select2" style="width:100%" required>
                        <option value="">---</option>
                        <?php foreach ($project_list as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>"><?= $value['project_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Drawing No.</label>
                    <div class="col-xl">
                      <input type="text" name="drawing_no" class="form-control">
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Discipline</label>
                    <div class="col-xl">
                      <select name="discipline" class="select2" style="width:100%">
                        <option value="">---</option>
                        <?php foreach ($discipline_list as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>"><?= $value['discipline_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Module</label>
                    <div class="col-xl">
                      <select name="module" id="module" class="select2" style="width:100%">
                        <option value="">---</option>
                        <?php foreach ($module_list as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>"><?= $value['mod_desc'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Type of Module</label>
                    <div class="col-xl">
                      <select name="type_of_module" class="select2" style="width:100%">
                        <option value="">---</option>
                        <?php foreach ($type_of_module_list as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Deck Elevation</label>
                    <div class="col-xl">
                      <select name="deck_elevation" class="select2" style="width:100%">
                        <option value="">---</option>
                        <?php foreach ($deck_list as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-12 text-right">
                  <hr>
                  <button type="submit" class="btn btn-green-smoe text-white"> <i class="fas fa-file-excel"></i> Export - <strong>Excel</strong></button>
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
  var module_list = <?= json_encode($module_list) ?>;

  function get_module(select) {
    let project_id = select.value
    let html = [`<option value="">---</option>`]

    if (typeof(module_list[project_id]) !== "undefined") {
      module_list[project_id].map((v, i) => {
        html.push(`<option value="${v.mod_id}">${v.mod_desc}</option>`)
      })
    }

    $("#module").html(html)
  }
</script>