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
        <div class="card shadow my-3 rounded-0">

          <div class="card-header">
            <h6 class="m-0">Filter Data <?= $meta_title ?></h6>
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
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $discipline ? 'selected' : '' ?>>
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
                      <select name="module" class="custom-select module" <?= $project_id ? '' : 'disabled' ?>>
                        <option value="">---</option>
                        <?php if ($project_id) : ?>
                          <?php foreach ($module_list as $key => $value) : ?>
                            <option value="<?= $value['mod_id'] ?>" <?= $value['mod_id'] == $module ? 'selected' : '' ?>>
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
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $module_type ? 'selected' : '' ?>>
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
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $deck_elevation ? 'selected' : '' ?>>
                            <?= $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>


                <!-- <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 text-muted col-form-label "> Status Inspection</label>
                    <div class="col-xl">
                      <select name="status_inspection" class="custom-select">
                        <option value="5" <?= $this->input->post('status_inspection') == 5 ? 'selected' : '' ?>>Pending
                          Approval</option>
                        <option value="6" <?= $this->input->post('status_inspection') == 6 ? 'selected' : '' ?>>Rejected
                        </option>
                        <option value="7" <?= $this->input->post('status_inspection') == 7 ? 'selected' : '' ?>>Reviewed
                        </option>
                        <option value="9" <?= $this->input->post('status_inspection') == 9 ? 'selected' : '' ?>>Accepted
                          & Release With Comment</option>
                        <option value="10" <?= $this->input->post('status_inspection') == 10 ? 'selected' : '' ?>>
                          Postponed</option>
                        <option value="11" <?= $this->input->post('status_inspection') == 11 ? 'selected' : '' ?>>
                          Re-Offered</option>
                        <option value="12" <?= $this->input->post('status_inspection') == 12 ? 'selected' : '' ?>>Void
                        </option>
                      </select>
                    </div>
                  </div>
                </div> -->

                <!-- <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 text-muted col-form-label">Inspection Authority</label>
                    <div class="col-xl">
                      <select name="inspection_authority[]" class="select2" style="width:100%" multiple>
                        <option value="0" <?= $arr_inspection_auth[0] == 1 ? 'selected' : '' ?>>Hold Point</option>
                        <option value="1" <?= $arr_inspection_auth[1] == 1 ? 'selected' : '' ?>>Witness</option>
                        <option value="2" <?= $arr_inspection_auth[2] == 1 ? 'selected' : '' ?>>Monitoring</option>
                        <option value="3" <?= $arr_inspection_auth[3] == 1 ? 'selected' : '' ?>>Review</option>
                      </select>
                    </div>
                  </div>
                </div> -->

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 text-muted col-form-label">Company</label>
                    <div class="col-xl">
                      <select name="company_id" class="select2" style="width:100%">
                        <option value="">---</option>
                        <?php foreach ($company_list as $key => $value) : ?>
                          <option value="<?= $value['id_company'] ?>" <?= $this->input->post('company_id') == $value['id_company'] ? 'selected' : '' ?>><?= $value['company_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>



                <div class="col-md-12">
                  <div class="float-right">
                    <button class="mt-2 btn btn-sm btn-flat btn-info"><i class="fas fa-search"></i> Search</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0"><?= $meta_title ?> List</h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive overflow-auto">
                  <table id="table_material" class="table table-hover text-center" style="width:100%">
                    <thead class="bg-green-smoe text-white">
                      <th>Project</th>
                      <th>Report Number</th>
                      <th>Drawing Number</th>
                      <th>Discipline</th>
                      <th>Module</th>
                      <th>Type of Module</th>
                      <th>Deck Elevation / Service Line</th>
                      <th>Company</th>
                      <th>Inspection By</th>
                      <th>Inspection Date</th>
                      <th>Status Inspection</th>
                      <th style="min-width: 210px;">Action</th>
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
  $(document).ready(function() {
    $("#table_material").DataTable({
      processing: true,
      serverSide: true,
      order: [],
      ajax: {
        url: "<?= site_url($serverside) ?>",
        type: "POST",
        data: {
          project_id: "<?= $project_id ?>",
          discipline: "<?= $discipline ?>",
          module: "<?= $module ?>",
          module_type: "<?= $module_type ?>",
          legend_inspection_auth: '<?= implode(";", $arr_inspection_auth) ?>',
          type: "<?= $type ?>",
          status_inspection: "<?= $this->input->post('status_inspection') ?>",
          deck_elevation: "<?= $this->input->post('deck_elevation') ?>",
          company_id: "<?= $this->input->post('company_id') ?>",
          view_type: "<?= $view_type ?>"
        }
      }
    })
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

  function changeReport(report_number, drawing_no, discipline) {

    Swal.fire({
      type: "warning",
      title: "Return Report",
      text: "Are you sure to return this report ?",
      showCancelButton: true,
    }).then((res) => {
      if (res.value) {
        $.ajax({
          url: "<?= base_url('material_verification/return_rfi/') ?>",
          type: "post",
          data: {
            'report_number': report_number,
            'drawing_no': drawing_no,
            'discipline': discipline,
            'backtopro': 'piping',
          },
          success: function(data) {
            if (data == 'Error') {
              Swal.fire(
                'Failed to Return Report Number!',
                '',
                'error'
              )
            } else {
              Swal.fire(
                'Data has been Returned!',
                '',
                'success'
              )
              $('#table_material').DataTable().ajax.reload();
            }
          }
        });
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

  $('.dataTable').DataTable({
    order: [],
  })

  function transmit_ndt(btn, transmittal_uniqid) {

    $('.modal-body').html(spinner())
    $("#modal").modal({
      show: true,
      keyboard: false,
      backdrop: "static"
    })

    $('.modal-dialog').addClass('modal-lg')
    $('.modal-title').text('ITR NDT Transmittal')

    var table = $('.dataTableX').DataTable();
    table.destroy();
    $('.dataTableX').DataTable({
      order: [],
    })

    $.ajax({
      url: "<?= site_url('itr/transmit_ndt') ?>",
      type: "POST",
      data: {
        transmittal_uniqid: transmittal_uniqid
      },
      success: (data) => {
        $('.modal-body').html(data)
      }
    })

  }
</script>