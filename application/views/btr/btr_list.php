<style>
  th,
  td {
    vertical-align: middle !important;
  }
</style>
<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div id="accordion">
          <div class="card shadow rounded-0">
            <div class="card-header">
              <div class="row">
                <div class="col-md-6">
                  <h6 class="mt-2">Filter</h6>
                </div>
                <div class="col-md-6 text-right">
                  <button class="btn btn-sm btn-primary collapsed" data-toggle="collapse" data-target="#filter_coll" aria-expanded="false" aria-controls="filter_coll">
                    <i class="fas fa-angle-double-down"></i>
                  </button>
                </div>
              </div>
            </div>
            <div id="filter_coll" class="collapse <?= $this->input->get() ? 'show' : '' ?>" data-parent="#accordion">
              <div class="card-body">
                <form action="" method="get">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted"> Project</label>
                        <div class="col-xl">
                          <select name="project_id" class="select2" style="width:100%">
                            <option value="">---</option>
                            <?php foreach ($project_list as $key => $value) : ?>
                              <option value="<?= $value['id'] ?>" <?= $value['id'] == $this->input->get('project_id') ? 'selected' : '' ?>><?= $value['project_name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted"> Discipline</label>
                        <div class="col-xl">
                          <select name="discipline" class="select2" style="width:100%">
                            <option value="">---</option>
                            <?php foreach ($discipline_list as $key => $value) : ?>
                              <option value="<?= $value['id'] ?>" <?= $value['id'] == $this->input->get('discipline') ? 'selected' : '' ?>><?= $value['discipline_name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted"> Module</label>
                        <div class="col-xl">
                          <select name="module" class="select2" style="width:100%">
                            <option value="">---</option>
                            <?php foreach ($module_list as $key => $value) : ?>
                              <option value="<?= $value['mod_id'] ?>" <?= $value['mod_id'] == $this->input->get('module') ? 'selected' : '' ?>><?= $value['mod_desc'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted"> Type of Module</label>
                        <div class="col-xl">
                          <select name="type_of_module" class="select2" style="width:100%">
                            <option value="">---</option>
                            <?php foreach ($type_of_module_list as $key => $value) : ?>
                              <option value="<?= $value['id'] ?>" <?= $value['id'] == $this->input->get('type_of_module') ? 'selected' : '' ?>><?= $value['name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted"> Drawing No</label>
                        <div class="col-xl">
                          <input type="text" name="drawing_no" value="<?= $this->input->get('drawing_no') ?>" class="form-control">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12 text-right">
                      <hr>
                      <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                    </div>

                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow my-3">
          <div class="card-header">
            <h6 class="m-0">Drawing List</h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive overflow-auto">
                  <table style="width: 100%" class="table table-hover text-center" id="table_list">
                    <thead class="bg-green-smoe text-white">
                      <th>Project</th>
                      <th>Drawing No</th>
                      <th>Drawing Type</th>
                      <th>Test Package No.</th>
                      <th>Discipline</th>
                      <th>Module</th>
                      <th>Type of Module</th>
                      <th>Action</th>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script>
  $("#table_list").DataTable({
    order: [],
    processing: true,
    serverSide: true,
    ajax: {
      url: "<?= site_url($serverside) ?>",
      type: "POST",
      data: {
        project_id: "<?= $this->input->get('project_id') ?>",
        discipline: "<?= $this->input->get('discipline') ?>",
        module: "<?= $this->input->get('module') ?>",
        type_of_module: "<?= $this->input->get('type_of_module') ?>",
        drawing_no: "<?= $this->input->get('drawing_no') ?>",
      }
    }
  })
</script>