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
          <div class="card rounded-0 shadow">
            <div class="card-header">
              <div class="row">
                <div class="col-md-6">
                  <h6 class="mt-2">Filter </h6>
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
                        <label for="" class="col-xl-3 col-form-label text-muted"> Start Date</label>
                        <div class="col-xl">
                          <input type="date" name="start_date" value="<?= $this->input->get('start_date') ?>" class="form-control">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted"> End Date</label>
                        <div class="col-xl">
                          <input type="date" name="end_date" value="<?= $this->input->get('end_date') ? $this->input->get('end_date') : date('Y-m-d') ?>" class="form-control">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted"> Requestor</label>
                        <div class="col-xl">
                          <select name="id_requestor" style="width:100%" class="select2">
                            <option value="">---</option>
                            <?php foreach ($requestor_list as $key => $value) : ?>
                              <option value="<?= $value['created_by'] ?>" <?= $this->input->get('id_requestor') == $value['created_by'] ? 'selected' : '' ?>><?= $user[$value['created_by']]['full_name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted"> Welder Stamp</label>
                        <div class="col-xl">
                          <select name="id_welder" style="width:100%" class="select2">
                            <option value="">---</option>
                            <?php foreach ($welder_list as $key => $value) : ?>
                              <option value="<?= $value['id_welder'] ?>" <?= $this->input->get('id_welder') == $value['id_welder'] ? 'selected' : '' ?>>
                                <?= $value['welder_code'] ?> / <?= $value['welder_badge'] ?> / <?= $value['welder_name'] ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted"> Status Request</label>
                        <div class="col-xl">
                          <select name="status" class="custom-select">
                            <option value="">---</option>
                            <option value="1" <?= $this->input->get('status') == "1" ? "selected" : "" ?>>Pending Approval</option>
                            <option value="2" <?= $this->input->get('status') == "2" ? "selected" : "" ?>>Rejected</option>
                            <option value="3" <?= $this->input->get('status') == "3" ? "selected" : "" ?>>Approved</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 text-right">
                      <hr>
                      <button type="submit" name="submit" value="search" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                      <button type="submit" name="submit" value="download" class="btn btn-green-smoe text-white"><i class="fas fa-cloud-download-alt"></i> Download</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card rounded-0 shadow">
          <div class="card-header">
            <h6 class="m-0 card-title">Transfer Welder List</h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive overflow-auto">
                  <table class="table table-hover text-center" style="width:100%" id="table_list">
                    <thead class="bg-green-smoe text-white">
                      <th>Requested By</th>
                      <th>Requested Date</th>
                      <th>Foreman From</th>
                      <th>Foreman To</th>
                      <th>Reason</th>
                      <th>Welder Badge</th>
                      <th>Welder Stamp</th>
                      <th>Welder Name</th>
                      <th>Status Request</th>

                    </thead>
                    <tbody>

                    </tbody>
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
        start_date: "<?= $this->input->get('start_date') ?>",
        end_date: "<?= $this->input->get('end_date') ?>",
        id_requestor: "<?= $this->input->get('id_requestor') ?>",
        id_welder: "<?= $this->input->get('id_welder') ?>",
        status_request: "<?= $this->input->get('status') ?>"
      }
    }
  })
</script>