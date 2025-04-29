<style>
  th,
  td {
    vertical-align: middle !important;
  }
</style>
<style>
  a[aria-expanded=true] .fa-angle-double-down {
    display: none;
  }

  a[aria-expanded=false] .fa-angle-double-up {
    display: none;
  }
</style>
<br />
<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm">
          <div class="card-header">
            <a class="btn btn-primary" data-toggle="collapse" href="#collapseButton" role="button" aria-expanded="false" aria-controls="collapseButton">Filter &nbsp; <i class="fas fa-angle-double-down"></i><i class="fas fa-angle-double-up"></i></a>
          </div>
          <div class="collapse <?= $this->input->post() ? 'show' : '' ?>" id="collapseButton">
            <div class="card-body">
              <h6 class="card-title">Filter</h6>
              <hr>
              <form action="<?= site_url('material_verification/transmittal_rfi_pr') ?>" method="post">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label for="" class="col-xl-2 col-form-label text-muted"> Status</label>
                      <div class="col-xl">
                        <select name="status_inspection" class="custom-select">
                          <option value="6" <?= $this->input->post('status_inspection') == 6 ? 'selected' : '' ?>>Rejected by Client</option>
                          <option value="9" <?= $this->input->post('status_inspection') == 9 ? 'selected' : '' ?>>Accepted And Released With Comments</option>
                          <option value="10" <?= $this->input->post('status_inspection') == 10 ? 'selected' : '' ?>>Postponed</option>
                          <option value="11" <?= $this->input->post('status_inspection') == 11 ? 'selected' : '' ?>>Re - Offer</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <hr>
                    <div class="float-right">
                      <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card border-0 shadow">
          <div class="card-header">
            <h6 class="card-title m-0 font-weight-bold">Transmittal RFI <strong>(Re - Transmit List)</strong></h6>

          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive overflow-auto">
                  <table class="table table-hover text-center" id="table_list">
                    <thead class="bg-gray-table">
                      <th>Project</th>
                      <th>Report Number</th>
                      <th>Drawing Number</th>
                      <th>Discipline</th>
                      <th>Module</th>
                      <th>Module Type</th>
                      <th>Deck Elevation / Service Line</th>
                      <th>Transmitted By</th>
                      <th>Transmitted Date</th>
                      <th>Status Inspection</th>
                      <th>Client Remarks</th>
                      <th style="min-width: 210px;">Action</th>
                    </thead>
                    <tbody>
                      <?php foreach ($list as $key => $value) : ?>
                        <?php
                        $data_explode         = explode("_", $key);
                        $report_no            = $data_explode[0];
                        $discipline           = $data_explode[1];
                        $module               = $data_explode[2];
                        $type_of_module       = $data_explode[3];
                        $project_code         = $data_explode[4];
                        $status_inspection    = $data_explode[5];
                        if (in_array($project_code, project_by_deck())) {
                          $deck_elevation       = $data_explode[6];
                          $report_number        = $report_no_list[$project_code][$discipline][$type_of_module][$deck_elevation] . '-' . $report_no;
                        } else {
                          $report_number      = $report_no_list[$project_code][$discipline][$type_of_module] . '-' . $report_no;
                        }

                        $encrypt_project_id     = strtr($this->encryption->encrypt($value['project_code']), '+=/', '.-~');
                        $encrypt_discipline     = strtr($this->encryption->encrypt($value['discipline']), '+=/', '.-~');
                        $encrypt_type_of_module = strtr($this->encryption->encrypt($value['type_of_module']), '+=/', '.-~');
                        $encrypt_module         = strtr($this->encryption->encrypt($value['module']), '+=/', '.-~');
                        $encrypt_report_number  = strtr($this->encryption->encrypt($value['report_number']), '+=/', '.-~');
                        $encrypt_deck_elevation = strtr($this->encryption->encrypt($value['deck_elevation']), '+=/', '.-~');
                        $submission_id          = strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~');
                        $report_no_rev          = strtr($this->encryption->encrypt($value['report_no_rev']), '+=/', '.-~');
                        $drawing_no             = strtr($this->encryption->encrypt($value['drawing_no']), '+=/', '.-~');
                        $action                 = strtr($this->encryption->encrypt('update'), '+=/', '.-~');

                        ?>
                        <tr>

                          <td>
                            <?= $project[$value['project_code']] ?></td>
                          <td>
                            <?= $report_number ?>
                          </td>
                          <td><?= $value['drawing_no'] ?></td>
                          <td><?= $discipline_name[$value['discipline']] ?></td>
                          <td><?= $module_name[$value['module']] ?></td>
                          <td><?= $module_type_name[$value['type_of_module']] ?></td>
                          <td><?= $data_deck[$value['deck_elevation']] ?></td>

                          <td>
                            <?= $user[$value['transmittal_by']]['full_name'] ?>
                          </td>
                          <td>
                            <?= $value['transmittal_datetime'] ?>
                          </td>
                          <td>
                            <?php if ($value['status_inspection'] == 10) : ?>
                              <span class="badge badge-info badge-pill">Postponed</span>
                            <?php elseif ($value['status_inspection'] == 11) : ?>
                              <span class="badge badge-warning badge-pill">Re-Offer</span>
                            <?php elseif ($value['status_inspection'] == 9) : ?>
                              <span class="badge badge-primary badge-pill">Accepted And Release With Comments</span>
                            <?php else : ?>
                              <span class="badge badge-danger badge-pill">Rejected By Client</span>

                            <?php endif; ?>
                          </td>
                          <td><?= $remarks_client[$key] ?></td>
                          <td>
                            <div class="btn-group">
                              <!-- <button type="button"
                              onclick="re_transmit_data(this,'<?= $report_no ?>', <?= $discipline ?>,<?= $module ?>,<?= $type_of_module ?>,<?= $project_code ?>,<?= $status_inspection ?>,'<?= $report_number ?>')"
                              
                              class="btn btn-success"><i class="fas fa-paper-plane"></i> Re - Transmit</button> -->
                              <a target="_blank" href="<?= site_url('material_verification/detail_client_rfi/' . $encrypt_project_id . '/' . $encrypt_discipline . '/' . $encrypt_type_of_module . '/' . $encrypt_module . '/' . $encrypt_report_number . '/' . $report_no_rev . '/' . $action . '/' . $drawing_no . '/' . $encrypt_deck_elevation) ?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Update</a>
                            </div>
                          </td>

                        </tr>
                      <?php endforeach; ?>

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
  $('#table_list').DataTable({
    order: [],
  })

  function re_transmit_data(event, report_no, discipline, module, type_of_module, project, status_inspection,
    report_number_actual) {

    let url = "<?= site_url('material_verification/re_transmit_data/') ?>" + report_no + '/' + discipline + '/' + module +
      '/' + type_of_module + '/' + project + '/' + status_inspection

    $("#modal").modal({
      show: true,
      keyboard: false,
      backdrop: "static"
    }).find('.modal-body').load(url)
    $('.modal-title').html(`<strong>${report_number_actual} - </strong> Re - Transmit Data`)
    $('.modal-dialog').addClass('modal-lg')
  }
</script>