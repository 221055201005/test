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
        <div class="card border-0 shadow">
          <div class="card-header">
            <h6 class="card-title m-0">Filter</h6>
          </div>
          <div class="card-body">

            <form action="" method="get">
              <div class="row">

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Project</label>
                    <div class="col-xl">
                      <select name="project_id" class="select2" style="width:100%" required>
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
                    <label for="" class="col-xl-3 col-form-label text-muted"> Workpack No</label>
                    <div class="col-xl">
                      <select name="workpack_no[]" class="select2" style="width:100%" required multiple>
                        <option value="">---</option>
                        <?php foreach ($workpack_list as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>" <?= @in_array($value['id'], $this->input->get('workpack_no'))  ? 'selected' : '' ?>><?= $value['workpack_no'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Paint System</label>
                    <div class="col-xl">
                      <select name="paint_system" class="select2" style="width:100%" onchange="get_list_activity(this)" required>
                        <option value="">---</option>
                        <?php foreach ($paint_system as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $this->input->get('paint_system') ? 'selected' : '' ?>><?= $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Description Activity</label>
                    <div class="col-xl">
                      <select name="activity" class="select2" style="width:100%" required>
                        <option value="">---</option>
                        <?php if ($this->input->get('paint_system')) : ?>
                          <?php foreach ($activity_desc as $key => $value) : ?>
                            <option value="<?= $value['id_activity'] ?>" <?= $value['id_activity'] == $this->input->get('activity') ? 'selected' : '' ?>><?= $value['description_of_activity'] ?></option>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </select>
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
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card border-0 shadow">
          <div class="card-header">
            <h6 class="card-title m-0">Create New</h6>
          </div>
          <div class="card-body">
            <form action="<?= site_url('planning_bnp/submit_data_rfi') ?>" id="form_submit" enctype="multipart/form-data" method="post">
              <div class="row">
                <?php if ($this->input->get()) : ?>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-xl-2 col-form-label text-muted" for="">Area</label>
                      <div class="col-xl">
                        <select name="area_v2" onchange="get_location_list(this)" class="custom-select select2" style="width:100%" required>
                          <option value="">---</option>
                          <?php foreach ($area_list as $value) : ?>
                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12"></div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-xl-2 col-form-label text-muted" for="">Location</label>
                      <div class="col-xl">
                        <select name="location_v2" onchange="get_point_list(this)" class="select2" required>
                          <option value="">---</option>

                          <?php if (isset($location_list)) : ?>
                            <?php foreach ($location_list as $key => $value) : ?>
                              <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                            <?php endforeach; ?>
                          <?php endif; ?>

                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12"></div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-xl-2 col-form-label text-muted" for="">Point <span style="font-size: 10px;"><strong><i>(Optional)</i></strong></span></label>
                      <div class="col-xl">
                        <select name="point_v2" class="select2">
                          <option value="0">---</option>

                          <?php if (isset($point_list)) : ?>
                            <?php foreach ($point_list as $key => $value) : ?>
                              <option value="<?= $value['id'] ?>" <?= $value['id'] == $data_piecemark[0]['point_v2'] ? 'selected' : '' ?>><?= $value['name'] ?></option>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12"></div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-xl-2 col-form-label text-muted" for="">Request No</label>
                      <div class="col-xl">
                        <input type="text" name="request_no" class="form-control" required>
                      </div>
                    </div>
                  </div>

                  <!-- <div class="col-md-12">
                    <div class="form-group row">
                      <label for="" class="col-xl-1 col-form-label text-muted"> Attachment</label>
                      <div class="col-xl">
                        <input type="file" name="attachment[]" accept="application/pdf" multiple>
                        <br>
                        <span style="font-size: 11px;" class="font-weight-bold"><i>* Can Upload Multiple Attachment</i></span>
                      </div>
                    </div>
                  </div> -->
                  <div class="col-md-12">
                    <hr>
                  </div>


                <?php else : ?>
                  <div class="col-md-12">
                    <span class="font-weight-bold text-info"><i class="fas fa-info-circle"></i> Filter Data First !</span>
                  </div>

                <?php endif; ?>
                <input type="hidden" name="project_id" value="<?= $this->input->get('project_id') ?>">
                <div class="col-md-12">
                  <div class="table-responsive overflow-auto">
                    <table class="table table-hover text-center" id="table_list" style="width: 100%">
                      <thead class="bg-green-smoe text-white">
                        <tr>
                          <th rowspan="2"></th>
                          <th rowspan="2">Workpack No</th>
                          <th rowspan="2">IRN No</th>
                          <th rowspan="2">Project</th>
                          <th rowspan="2">Drawing No</th>
                          <th rowspan="2">Drawing AS</th>
                          <th rowspan="2">Drawing SP</th>
                          <th rowspan="2">Paint System</th>
                          <th rowspan="2">Description Activity</th>
                          <th rowspan="2">Tag No</th>
                          <th colspan="8">Material Traceability</th>
                          <th rowspan="2">Status</th>

                        </tr>
                        <tr>
                          <th>Piecemark No</th>
                          <th>Unique No</th>
                          <th>Profile</th>
                          <th>Size / Dia</th>
                          <th>Length</th>
                          <th>Area (m2)</th>
                          <th>Thk</th>
                          <th>Material Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($list as $key => $value) : ?>
                          <?php

                          $link_irn                 = "#";
                          $encrypt_irn_submission   = strtr($this->encryption->encrypt($irn[$value['irn_report_no']]['submission_id']), '+=/', '.-~');

                          if ($value['categories_irn'] == 1) {
                            $link_irn               = site_url('irn/show_irn_detail_material/' . $encrypt_irn_submission);
                          } else {
                            $link_irn               = site_url('irn/show_irn_detail/' . $encrypt_irn_submission);
                          }

                          $project_id               = strtr($this->encryption->encrypt($mv[$value['id_template']]['project_code']), '+=/', '.-~');
                          $discipline               = strtr($this->encryption->encrypt($mv[$value['id_template']]['discipline']), '+=/', '.-~');
                          $type_of_module           = strtr($this->encryption->encrypt($mv[$value['id_template']]['type_of_module']), '+=/', '.-~');
                          $module                   = strtr($this->encryption->encrypt($mv[$value['id_template']]['module']), '+=/', '.-~');
                          $report_no                = strtr($this->encryption->encrypt($mv[$value['id_template']]['report_number']), '+=/', '.-~');
                          $report_no_rev            = strtr($this->encryption->encrypt($mv[$value['id_template']]['report_no_rev']), '+=/', '.-~');
                          $submission_id            = strtr($this->encryption->encrypt($mv[$value['id_template']]['submission_id']), '+=/', '.-~');

                          if (isset($mv[$value['id_template']]['status_inspection'])) {
                            if ($mv[$value['id_template']]['status_inspection'] >= 3) {
                              if (isset($mv[$value['id_template']]['report_number'])) {
                                $status_inspection_p1 = '<a target="_blank" href="' . base_url() . 'material_verification/material_verification_pdf_client/' . $project_id . '/' . $discipline . '/' . $type_of_module . '/' . $module . '/' . $report_no . '/' . $report_no_rev . '">COMPLETED</a>';
                              } else {
                                $status_inspection_p1 = '<a target="_blank" href="' . base_url() . 'material_verification/material_verification_pdf/' . $submission_id . '">COMPLETED</a>';
                              }
                            } else {
                              $status_inspection_p1 = 'OS';
                            }
                          } else {
                            $status_inspection_p1 = "-";
                          }

                          $unique_no              = $mis[$mv[$value['id_template']]['id_mis']]['unique_no'];

                          $id_workpack_enc        = strtr($this->encryption->encrypt($value['id_workpack']), '+=/', '.-~');
                          $link_pdf_workpack      = site_url('planning/workpack_pdf_bnp/' . $id_workpack_enc);

                          ?>
                          <tr>
                            <td class="text-nowrap">
                              <?php if ($this->input->get()) : ?>
                                <input type="checkbox" name="checked_id[<?= $key ?>]" class="check" value="<?= $value['id'] ?>" style="width:25px; height:25px">
                                <input type="hidden" name="id_wp[<?= $key ?>]" value="<?= $value['id_wp'] ?>">
                              <?php endif; ?>
                            </td>
                            <td class="text-nowrap"><a target="_blank" href="<?= $link_pdf_workpack ?>"><strong><i><?= $value['workpack_no'] ?></i></strong></a></td>
                            <td class="text-nowrap"><strong><i><a target="_blank" href="<?= $link_irn ?>">SOF-OCP-SMO-TS-STR-RFI-IRN-B&P-<?= $value['irn_report_no'] ?></a></i></strong></td>
                            <td class="text-nowrap"><?= $project_list[$value['project']]['project_name'] ?></td>
                            <td class="text-nowrap"><?= $piecemark[$value['id_template']]['drawing_ga'] ?></td>
                            <td class="text-nowrap"><?= $piecemark[$value['id_template']]['drawing_as'] ? $piecemark[$value['id_template']]['drawing_as'] : '-' ?></td>
                            <td class="text-nowrap"><?= $piecemark[$value['id_template']]['drawing_sp'] ? $piecemark[$value['id_template']]['drawing_sp'] : '-' ?></td>
                            <td class="text-nowrap">
                              <input type="hidden" name="paint_system_id[<?= $key ?>]" value="<?= $value['id_paint_system'] ?>">

                              <input type="hidden" name="discipline[<?= $key ?>]" value="<?= $value['discipline'] ?>">
                              <input type="hidden" name="module[<?= $key ?>]" value="<?= $value['module'] ?>">
                              <input type="hidden" name="type_of_module[<?= $key ?>]" value="<?= $value['type_of_module'] ?>">
                              <?= $paint_system[$value['id_paint_system']]['name'] ?>
                            </td>
                            <td class="text-nowrap">
                              <input type="hidden" name="activity_id[<?= $key ?>]" value="<?= $value['id_activity'] ?>">
                              <?= $activity_desc[$value['id_activity']]['description_of_activity'] ?>
                            </td>
                            <td class="text-nowrap"><?= $piecemark[$value['id_template']]['can_number'] ? $piecemark[$value['id_template']]['can_number'] : '-' ?></td>
                            <td class="text-nowrap"><?= $piecemark[$value['id_template']]['part_id'] ?></td>
                            <td class="text-nowrap"><?= $unique_no ?></td>
                            <td class="text-nowrap"><?= $piecemark[$value['id_template']]['profile'] ? $piecemark[$value['id_template']]['profile'] : '-' ?></td>
                            <td class="text-nowrap"><?= $piecemark[$value['id_template']]['diameter'] ? $piecemark[$value['id_template']]['diameter'] : '-' ?></td>
                            <td class="text-nowrap"><?= $piecemark[$value['id_template']]['length'] ? $piecemark[$value['id_template']]['length'] : '-' ?></td>
                            <td class="text-nowrap"><?= $piecemark[$value['id_template']]['area'] ? $piecemark[$value['id_template']]['area'] : '-' ?></td>
                            <td class="text-nowrap"><?= $piecemark[$value['id_template']]['thickness'] ? $piecemark[$value['id_template']]['thickness'] : '-' ?></td>
                            <td class="text-nowrap"><strong><i><?= $status_inspection_p1 ?></i></strong></td>
                            <td class="text-nowrap"><span class="badge badge-info badge-pill">Ready</span></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-12 text-right">
                  <hr>
                  <button type="submit" id="button_submit" class="btn btn-primary" disabled><i class="fas fa-check"></i> Submit Data <span class="badge badge-light text_checked">0</span></button>
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
  console.log(list_activity_id)
  $("#form_submit").on('submit', function() {
    $('button[type=submit]').attr('disabled', true)

    Swal.fire({
      title: 'Processing...',
      allowOutsideClick: false,
      onBeforeOpen: () => {
        Swal.showLoading()
      },
    });

  })
  $("#table_list").DataTable({
    order: [],
    paging: false
  })

  function get_location_list(select) {
    $('select[name="location_v2"]').html(`<option value="">---</option>`)
    $('select[name="point_v2"]').html(`<option value="0">---</option>`)

    let area_id = select.value
    $.ajax({
      url: "<?= site_url('material_verification/location_list_ajax') ?>",
      type: "POST",
      data: {
        area_id: area_id
      },
      dataType: "JSON",
      success: function(data) {
        let html = []

        html.push(`<option value="">---</option>`)
        data.map(function(v) {
          html.push(`<option value="${v.id}">${v.name}</option>`)
        })

        $('select[name="location_v2"]').html(html)
      }
    })
  }

  function get_point_list(select) {
    $('select[name="point_v2"]').html(`<option value="0">---</option>`)

    let location_id = select.value
    $.ajax({
      url: "<?= site_url('material_verification/point_list_ajax') ?>",
      type: "POST",
      data: {
        location_id: location_id
      },
      dataType: "JSON",
      success: function(data) {
        let html = []

        html.push(`<option value="">---</option>`)
        data.map(function(v) {
          html.push(`<option value="${v.id}">${v.name}</option>`)
        })

        $('select[name="point_v2"]').html(html)
      }
    })
  }

  var checked_list = []
  var checked_key = []

  $('#table_list').on('click', '.check', function() {
    let wp_detail_id = this.value
    let paint_id = $(this).closest('tr').find('input[name="paint_system_id[]"]').val()
    let activity_id = $(this).closest('tr').find('input[name="activity_id[]"]').val()

    let key_data = paint_id + '_' + activity_id

    if (this.checked) {

      if (checked_key.length > 0) {
        if (key_data != checked_key[0]) {
          this.checked = false
          Swal.fire({
            type: "warning",
            title: "Different Paint System And Activity",
            text: "Cannot Submit Multiple Paint System And Activity"
          })

          return
        }

      }

      checked_list.push(wp_detail_id)
      checked_key.push(key_data)
    } else {
      checked_list.splice($.inArray(wp_detail_id, checked_list), 1)
      checked_key.splice($.inArray(key_data, checked_key), 1)
    }

    if (checked_list.length > 0) {
      $("#button_submit").removeAttr('disabled')
    } else {
      $("#button_submit").attr('disabled', true)
    }

    $('.text_checked').text(checked_list.length)

  })

  var list_activity_id = <?= json_encode($activity) ?>;

  function get_list_activity(select) {
    let id_paint_system = select.value

    let html = []
    html.push(`<option value="">---</option>`)

    if (id_paint_system) {
      list_activity_id[id_paint_system].map(function(v, i) {
        html.push(`<option value="${v.id_activity}">${v.description_of_activity}</option>`)
      })
    }

    $('select[name="activity"]').html(html)

  }
</script>