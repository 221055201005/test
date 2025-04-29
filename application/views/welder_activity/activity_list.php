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
                  <h6 class="mt-2">Filter Transmittal</h6>
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
                        <label for="" class="col-xl-3 col-form-label text-muted"> Supervisor</label>
                        <div class="col-xl">
                          <select name="id_spv" style="width:100%" class="select2">
                            <option value="">---</option>
                            <?php foreach ($supervisor_list as $key => $value) : ?>
                              <option value="<?= $value['id_spv'] ?>" <?= $this->input->get('id_spv') == $value['id_spv'] ? 'selected' : '' ?>><?= $user[$value['id_spv']]['full_name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted"> Foreman</label>
                        <div class="col-xl">
                          <select name="id_foreman" style="width:100%" class="select2">
                            <option value="">---</option>
                            <?php foreach ($foreman_list as $key => $value) : ?>
                              <option value="<?= $value['created_by'] ?>" <?= $this->input->get('id_foreman') == $value['created_by'] ? 'selected' : '' ?>><?= $user[$value['created_by']]['full_name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted"> Status Progress</label>
                        <div class="col-xl">
                          <select name="status_complete" class="custom-select">
                            <option value="">---</option>
                            <option value="0" <?= $this->input->get('status_complete') == "0" ? "selected" : "" ?>>On Progress</option>
                            <option value="1" <?= $this->input->get('status_complete') == "1" ? "selected" : "" ?>>Completed</option>
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
        <div class="card rounded-0 shadow-sm">
          <div class="card-header">
            <h6 class="m-0 card-title">Welder Activity List</h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive overflow-auto">
                  <table class="table table-hover text-center" style="width:100%" id="table_list">
                    <thead class="bg-green-smoe text-white">
                      <th>Activity Date</th>
                      <th>Supervisor</th>
                      <th>Foreman</th>
                      <th>Welder Badge</th>
                      <th>Welder Stamp</th>
                      <th>Welder Name</th>
                      <th>Weld Category</th>
                      <th>Workpack No.</th>
                      <th>Job No.</th>
                      <th>Weld Map</th>
                      <th>Joint No.</th>
                      <th>Activity Description</th>

                      <th>Total Length (MM)</th>
                      <th>Status</th>
                      <!-- <th>Action</th> -->
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

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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
        id_spv: "<?= $this->input->get('id_spv') ?>",
        id_foreman: "<?= $this->input->get('id_foreman') ?>",
        status_complete: "<?= $this->input->get('status_complete') ?>",

      }
    }
  })

  function show_detail(btn, id_enc) {
    $("#modal").modal({
      show: true,
      keyboard: false,
      backdrop: "static"
    })
    $('.modal-dialog').addClass('modal-lg')
    $('.modal-title').text("Detail Welder Activity")

    $.ajax({
      url: "<?= site_url('welder_activity/show_weld_detail/') ?>",
      type: "POST",
      data: {
        id_enc: id_enc
      },
      success: (data) => {
        $('.modal-body').html(data)
      }
    })
  }
</script>