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
            <div id="filter_coll" class="collapse <?= $this->input->post() ? 'show' : '' ?>" data-parent="#accordion">
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
                              <option value="<?= $value['id'] ?>" <?= $value['id'] == $project_id ? 'selected' : '' ?>>
                                <?= $value['project_name'] ?></option>
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


                    <?php if ($type != "") : ?>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label for="" class="col-xl-3 text-muted col-form-label "> Status Inspection</label>
                          <div class="col-xl">
                            <select name="status_inspection" class="custom-select">

                              <option value="">---</option>
                              <!-- //updatemahmud1 -->
                              <?php if (in_array($this->user_cookie[10], array(19, 21))) { ?>
                                <option value="5" <?= $this->input->post('status_inspection') == 5 ? 'selected' : '' ?>>Waiting Witness/Review</option>
                              <?php } else { ?>
                                <option value="5" <?= $this->input->post('status_inspection') == 5 ? 'selected' : '' ?>>Pending
                                  Approval</option>
                              <?php }  ?>
                              <!-- //updatemahmud1 -->

                              <option value="6" <?= $this->input->post('status_inspection') == 6 ? 'selected' : '' ?>>Rejected</option>

                              <!-- //updatemahmud1 -->
                              <option value="7" <?= $this->input->post('status_inspection') == 7 ? 'selected' : '' ?>>Approved</option>
                              <?php if (in_array($this->user_cookie[10], array(19, 21))) { ?>
                                <option value="witnessed" <?= $this->input->post('status_inspection') == 'witnessed' ? 'selected' : '' ?>>Witnessed</option>
                                <option value="reviewed" <?= $this->input->post('status_inspection') == 'reviewed' ? 'selected' : '' ?>>Reviewed</option>
                              <?php } ?>
                              <!-- //updatemahmud1 -->

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
                      </div>
                    <?php endif; ?>

                    <div class="col-md-6">
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
                    </div>

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

                    <div class="col-6">
                      <div class="form-group row">
                        <label class="col-xl-3 text-muted col-form-label">Date From</label>
                        <div class="col-md">
                          <input type="date" class="form-control" name="date_from" value="<?php print_r($post['date_from']) ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row">
                        <label class="col-xl-3 text-muted col-form-label">Date To</label>
                        <div class="col-md">
                          <input type="date" class="form-control" name="date_to" value="<?php print_r($post['datr_to']) ?>">
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
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Client Document List <?= $type == "summary" ? "- Summary RFI" : "" ?></h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive overflow-auto">
                  <table id="table_material" class="table table-hover text-center" style="width:100%">
                    <thead class="bg-gray-table">
                      <th>Project</th>
                      <th>Report Number</th>
                      <th>Drawing Number</th>
                      <th>Discipline</th>
                      <th>Module</th>
                      <th>Type of Module</th>
                      <th>Deck Elevation / Service Line</th>
                      <th>Company</th>
                      <th>Rev No.</th>
                      <th>Inspection By</th>
                      <th>Inspection Date</th>
                      <th>Status Inspection</th>
                      <th>Status Invitation</th>
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

  <div class="modal fade" id="modalReoffer" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="<?php echo base_url(); ?>material_verification/process_postpone_reapproval" method="POST">
          <div class="modal-header">
            <h4 class="modal-title">Re-Offer RFI</h4>
          </div>
          <div class="modal-body">
            <b><i>Re-Offer - Remarks :</i></b> <br />
            <input type="hidden" name="status_inspection" value="11">
            <input type="hidden" name="project_id">
            <input type="hidden" name="deck_elevation">
            <input type="hidden" name="drawing_no">
            <input type="hidden" name="discipline">
            <input type="hidden" name="module">
            <input type="hidden" name="type_of_module">
            <input type="hidden" name="report_number">
            <textarea name='remarks' placeholder="---" class='form-control' required></textarea>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<script>
  function requestForUpdate(ini, enc_project_code, enc_discipline, enc_module, enc_type_of_module, enc_report_number, enc_company_id, status_inspection) {
    Swal.fire({
      title: "Reason Request for Update",
      input: "text",
      type: "warning",
      inputAttributes: {
        autocapitalize: "off"
      },
      showCancelButton: true,
      confirmButtonText: "Request",
      showLoaderOnConfirm: true,
    }).then((result) => {

      var remarks = result.value
      $.ajax({
        url: "<?php echo base_url() ?>material_verification/proceed_request_for_update_report",
        type: "POST",
        data: {
          enc_project_code: enc_project_code,
          enc_discipline: enc_discipline,
          enc_module: enc_module,
          enc_type_of_module: enc_type_of_module,
          enc_report_number: enc_report_number,
          enc_company_id: enc_company_id,
          remarks: remarks,
          status_inspection: status_inspection,
        },
        success: function(data) {
          console.log(data);
          Swal.fire({
            type: "success",
            title: "SUCCESS",
            text: "Successfully Request Update",
            timer: 1000
          })

          setTimeout(() => {
            location.reload()
          }, 1000);
        }
      });
    });
  }

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
          date_from: "<?= $this->input->post('date_from') ?>",
          date_to: "<?= $this->input->post('date_to') ?>",

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
</script>
<script>
  function handleReoffer(drawing_no, discipline, module, type_of_module, report_number, project_code, deck_elevation) {
    $("input[name='drawing_no']").val(drawing_no);
    $("input[name='discipline']").val(discipline);
    $("input[name='module']").val(module);
    $("input[name='type_of_module']").val(type_of_module);
    $("input[name='report_number']").val(report_number);
    $("input[name='project_id']").val(project_code);
    $("input[name='deck_elevation']").val(deck_elevation);

    console.log(report_number)
    $("#modalReoffer").modal();
  }
</script>