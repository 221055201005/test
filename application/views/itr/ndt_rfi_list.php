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
        <div class="card shadow my-3">
          <div class="card-header">
            <h6 class="m-0">Filter</h6>
          </div>
          <div class="card-body">
            <form action="" method="post">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 text-muted col-form-label "> Project ID</label>
                    <div class="col-xl">
                      <select name="project_id" class="custom-select" onchange="find_module_by_project(this)">
                        <option value="">---</option>
                        <?php foreach ($project_list as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $this->input->post('project_id') ? 'selected' : '' ?>><?= $value['project_name'] ?></option>
                        <?php endforeach; ?>
                      </select>

                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 text-muted col-form-label "> Discipline</label>
                    <div class="col-xl">
                      <select name="discipline" class="custom-select">
                        <option value="">---</option>
                        <?php foreach ($discipline_list as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $this->input->post('discipline') ? 'selected' : '' ?>>
                            <?= $value['discipline_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 text-muted col-form-label "> Module</label>
                    <div class="col-xl">
                      <select name="module" class="custom-select module" <?= $this->input->post('project_id') ? '' : 'disabled' ?>>
                        <option value="">---</option>
                        <?php if ($this->input->post('project_id')) : ?>
                          <?php foreach ($module_list as $key => $value) : ?>
                            <option value="<?= $value['mod_id'] ?>" <?= $value['mod_id'] == $this->input->post('module') ? 'selected' : '' ?>>
                              <?= $value['mod_desc'] ?></option>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 text-muted col-form-label ">Type of Module</label>
                    <div class="col-xl">
                      <select name="type_of_module" class="custom-select">
                        <option value="">---</option>
                        <?php foreach ($type_of_module as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $this->input->post('type_of_module') ? 'selected' : '' ?>>
                            <?= $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 text-muted col-form-label ">Deck Elevation / Service Line</label>
                    <div class="col-xl">
                      <select name="deck_elevation" class="select2" style="width:100%">
                        <option value="">---</option>
                        <?php foreach ($deck_list as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $this->input->post('deck_elevation') ? 'selected' : '' ?>>
                            <?= $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 text-muted col-form-label">Vendor</label>
                    <div class="col-xl">
                      <select name="vendor_id" class="select2" style="width:100%">
                        <option value="">---</option>
                        <?php foreach ($company_list as $key => $value) : ?>
                          <option value="<?= $value['id_company'] ?>" <?= $this->input->post('vendor_id') == $value['id_company'] ? 'selected' : '' ?>><?= $value['company_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">NDT Method</label>
                    <div class="col-xl">
                      <select name="ndt_type" class="select2" style="width:100%">
                        <option value="">---</option>
                        <?php foreach ($ndt_method as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $this->input->post('ndt_type') ? 'selected' : '' ?>><?= $value['ndt_description'] ?> (<?= $value['ndt_initial'] ?>)</option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Attachment Status</label>
                    <div class="col-xl">
                      <select name="attachment_status" class="select2" style="width:100%">
                        <option value="">---</option>
                        <option value="pending" <?= $this->input->post('attachment_status') == 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="uploaded" <?= $this->input->post('attachment_status') == 'uploaded' ? 'selected' : '' ?>>Uploaded</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-12 text-right">
                  <hr>
                  <button class="mt-2 btn btn-sm btn-flat btn-info"><i class="fas fa-search"></i> Search</button>
                </div>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card shadow my-3">
          <div class="card-header">
            <h6 class="m-0">ITR NDT RFI List</h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive overflow-auto">
                  <table style="width:100%" class="table table-hover text-center" id="table_list">
                    <thead class="bg-green-smoe text-white">
                      <th>Project</th>
                      <th>ITR Report No.</th>
                      <th>NDT RFI No.</th>
                      <th>NDT Method</th>
                      <th>Vendor</th>
                      <th>Drawing Number</th>
                      <th>Discipline</th>
                      <th>Module</th>
                      <th>Type of Module</th>
                      <th>Deck Elevation / Service Line</th>
                      <th>Attachment Status</th>
                      <th>Transmitted By</th>
                      <th>Transmitted Date</th>
                      <th></th>
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

</div>
</div>

<script>

  function void_modal(ndt_rfi_no) {

    $('.modal-body').html(spinner())
    $("#modal").modal({
      show : true,
      keyboard: false,
      backdrop : "static"
    })

    $('.modal-dialog').addClass('modal-lg')
    $('.modal-title').text('ITR NDT - Void')

    var table = $('.dataTableX').DataTable();
    table.destroy();
    $('.dataTableX').DataTable({
      order: [],
    })

    $.ajax({
      url : "<?= site_url('itr/void_modal') ?>",
      type : "POST",
      data : {
        ndt_rfi_no : ndt_rfi_no
      },
      success : (data) => {
        $('.modal-body').html(data)
      }
    })
  }

  function spinner() {
    return `
    <div class="container text-center h-100">
      <div class="row align-items-center h-100">
        <div class="col-md-12">
          <div class="spinner-border text-success" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
      </div>
    </div>
  ` 
  }

  $("#table_list").DataTable({
    order: [],
    processing: true,
    serverSide: true,
    ajax: {
      url: "<?= site_url($serverside) ?>",
      type: "POST",
      data: {
        ndt_type: "<?= $this->input->post('ndt_type') ?>",
        attachment_status: "<?= $this->input->post('attachment_status') ?>",
        project_id          : "<?= $this->input->post('project_id') ?>",
        discipline          : "<?= $this->input->post('discipline') ?>",
        module              : "<?= $this->input->post('module') ?>",
        module_type         : "<?= $this->input->post('type_of_module') ?>",
        status_inspection   : "<?= $this->input->post('status_inspection') ?>",
        deck_elevation      : "<?= $this->input->post('deck_elevation') ?>",
        vendor_id           : "<?= $this->input->post('vendor_id') ?>",
      }
    }
  })

  function find_module_by_project(select, mod_id = null) {
    var project_id = $(select).val()
    if (project_id) {
      $('.module').removeAttr('disabled')
      $.ajax({
        url: "<?= site_url('material_verification/find_module_by_project') ?>",
        type: "POST",
        data: {
          project_id: project_id
        },
        dataType: "JSON",
        success: function(data) {
          var html = []
          html.push(`<option value="">---</option>`)
          data.map(function(v, i) {
            html.push(
              `<option value="${v.mod_id}" ${mod_id && mod_id == v.mod_id ? 'selected' : ''}>${v.mod_desc}</option>`
            )
          })
          $('.module').html(html)
        }
      })
    } else {
      $('.module').val('')
      $('.module').attr('disabled', true)
    }
  }

</script>