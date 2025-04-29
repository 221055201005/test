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
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h6 class="card-title">Approved For Update Material Detail - <strong><?= $main_data['submission_id'] ?></strong></h6>
            <hr>
            <form action="<?= $action == "update" ? site_url('material_verification/proceed_update_material_verification') : site_url('material_verification/proceed_re_approval_material_verification') ?>" method="post">
              <input type="hidden" name="submission_id" value="<?= $main_data['submission_id'] ?>">
              <input type="hidden" name="id_revise" value="<?= $id_revise ?>">
              <input type="hidden" name="status_revise" value="<?= $action == "update" ? '3' : '4' ?>">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Drawing Number</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" value="<?= $main_data['drawing_no'] ?>" disabled>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Workpack Number</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" value="<?= $workpack['workpack_no'] ?>" disabled>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Disicpline</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" value="<?= $discipline_name[$main_data['discipline']] ?>" disabled>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Project Name</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" value="<?= $project_name[$main_data['project_code']] ?>" disabled>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Module</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" value="<?= $module_name[$main_data['module']] ?>" disabled>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Company</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" value="<?= $main_data['company'] ?>" disabled>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Type Of Module</label>
                    <div class="col-xl">
                      <input type="text" class="form-control" value="<?= $type_module[$main_data['type_of_module']] ?>" disabled>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Area</label>
                    <div class="col-xl">
                      <select name="area_v2" style="width:100%" onchange="get_location_list(this)" class="select2" <?= $action == "update" ? 'required' : 'disabled' ?>>
                        <option value="">---</option>
                        <?php foreach ($area_v2 as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $main_data['area_v2'] ? 'selected' : '' ?>>
                            <?= $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label text-muted" for="">Location</label>
                    <div class="col-xl">
                      <select name="location_v2" onchange="get_point_list(this)" class="select2" <?= $action == "update" ? 'required' : 'disabled' ?>>
                        <option value="">---</option>
                        <?php foreach ($location_v2 as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $main_data['location_v2'] ? 'selected' : '' ?>><?= $value['name'] ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label text-muted" for="">Point <span style="font-size: 10px;"><strong><i>(Optional)</i></strong></span></label>
                    <div class="col-xl">
                      <select name="point_v2" class="select2" <?= $action == "update" ? '' : 'disabled' ?>>
                        <option value="0">---</option>
                        <?php foreach ($point_list as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $main_data['point_v2'] ? 'selected' : '' ?>><?= $value['name'] ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>


              </div>
              <hr>
              <?php if ($action == "approval") : ?>
                <div class="row">
                  <div class="col-md-12 col-sm">
                    <div class="btn-group">
                      <button type="button" class="btn btn-outline-success" onclick="change_status(this, 3)">Approve
                        All</button>
                      <button type="button" class="btn btn-outline-danger" onclick="change_status(this, 2)">Reject
                        All</button>
                      <button type="button" class="btn btn-outline-info" onclick="change_status(this, 4)">Pending
                        All</button>
                      <button type="button" class="btn btn-outline-secondary" onclick="change_status(this, 0)">Clear
                        All</button>
                    </div>
                  </div>
                </div>
                <hr>
              <?php endif; ?>

              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive overflow-auto">
                    <table class="table table-hover text-center text-nowrap">
                      <thead class="bg-info text-white">
                        <th>No</th>
                        <th>Piece Mark No</th>
                        <th>Can No</th>
                        <th>Unique No</th>
                        <th>Spec / Grade</th>
                        <th>Thickness</th>
                        <th>Profile</th>
                        <th>Heat No</th>
                        <th>Material Description</th>
                        <th>MRIR No</th>
                        <th>Inspection Remarks</th>
                        <?php if ($action == "approval") : ?>
                          <th>Inspection Status</th>
                          <th>Remarks</th>
                        <?php endif; ?>
                      </thead>
                      <tbody>
                        <?php $no = 1;
                        foreach ($detail_material as $key => $value) : ?>
                          <?php
                          $report_no  = explode('/', $detail_mis[$value['id_mis']]['report_no']);
                          $report_no  = $report_no[1];
                          ?>
                          <tr>
                            <input type="hidden" name="id_mis[<?= $key ?>]" value="<?= $value['id_mis'] ?>" class="id_mis">
                            <input type="hidden" name="id_material[<?= $key ?>]" value="<?= $value['id_material'] ?>">
                            <td><?= $no++ ?></td>
                            <td><?= $value['part_id'] ?></td>
                            <td><?= $value['can_number'] ? $value['can_number'] : '-' ?></td>
                            <td>

                              <?php if ($action == "update") : ?>

                                <?php if ($value['piping_testing_category'] == 1) : ?>

                                  <?php foreach (explode(";", $value['id_mis_piping']) as $k => $v) : ?>
                                    <input type="text" class="form-control" value="<?= $detail_mis[$v]['unique_no'] ?>" onfocus="autocomplete_unique(this, '<?= $workpack['workpack_no'] ?>', <?= $value['grade'] ?>, <?= $value['id_workpack'] ?>)" onblur="validate_unique_no_2(this, '<?= $workpack['workpack_no'] ?>', <?= $value['grade'] ?>, <?= $value['id_workpack'] ?>, <?= $k ?>)" required>
                                    <div class="invalid-feedback"></div>
                                    <br>
                                    <input type="hidden" name="id_mis_piping_input[<?= $key ?>][]" class="id_mis_pip_input" value="<?= $v ?>">
                                  <?php endforeach; ?>

                                <?php else : ?>
                                  <input type="text" class="form-control" value="<?= $detail_mis[$value['id_mis']]['unique_no'] ?>" onfocus="autocomplete_unique(this, '<?= $workpack['workpack_no'] ?>', <?= $value['grade'] ?>, <?= $value['id_workpack'] ?>)" onblur="validate_unique_no(this, '<?= $workpack['workpack_no'] ?>', <?= $value['grade'] ?>, <?= $value['id_workpack'] ?>)" required>
                                  <div class="invalid-feedback"></div>
                                <?php endif; ?>

                              <?php else : ?>

                                <?php if ($value['piping_testing_category'] == 1) : ?>
                                  <?php foreach (explode(";", $value['id_mis_piping']) as $k => $v) : ?>
                                    <?= $detail_mis[$v]['unique_no'] ?>
                                    <br>
                                  <?php endforeach; ?>
                                <?php else : ?>
                                  <?= $detail_mis[$value['id_mis']]['unique_no'] ?>
                                <?php endif; ?>

                              <?php endif; ?>

                            </td>
                            <td><?= $grade[$value['grade']] ?></td>
                            <td><?= $value['thickness'] ?></td>
                            <td><?= $value['profile'] ?></td>
                            <td>

                              <?php if ($action == "update") : ?>

                                <?php if ($value['piping_testing_category'] == 1) : ?>

                                  <?php foreach (explode(";", $value['id_mis_piping']) as $k => $v) : ?>
                                    <input type="text" class="form-control heat_no_piping_<?= $k ?>" value="<?= $detail_mis[$v]['heat_or_series_no'] ?>" disabled>
                                    <br>
                                  <?php endforeach; ?>

                                <?php else : ?>
                                  <input type="text" class="form-control heat_no" value="<?= $detail_mis[$value['id_mis']]['heat_or_series_no'] ?>" disabled>
                                <?php endif; ?>

                              <?php else : ?>

                                <?php if ($value['piping_testing_category'] == 1) : ?>
                                  <?php foreach (explode(";", $value['id_mis_piping']) as $k => $v) : ?>
                                    <?= $detail_mis[$v]['heat_or_series_no'] ?>
                                    <br>
                                  <?php endforeach; ?>
                                <?php else : ?>
                                  <?= $detail_mis[$value['id_mis']]['heat_or_series_no'] ?>
                                <?php endif; ?>

                              <?php endif; ?>
                            </td>
                            <td>
                              <?= $value['profile'] ?>
                            </td>
                            <td>

                              <?php if ($action == "update") : ?>

                                <?php if ($value['piping_testing_category'] == 1) : ?>

                                  <?php foreach (explode(";", $value['id_mis_piping']) as $k => $v) : ?>
                                    <?php
                                    $report_no  = explode('/', $detail_mis[$v]['report_no']);
                                    $report_no  = $report_no[1];

                                    ?>
                                    <input type="text" class="form-control mrir_piping_<?= $k ?>" value="<?= $report_no ?>" disabled>
                                    <br>
                                  <?php endforeach; ?>

                                <?php else : ?>
                                  <input type="text" class="form-control mrir" value="<?= $detail_mis[$value['id_mis']]['heat_or_series_no'] ?>" disabled>
                                <?php endif; ?>

                              <?php else : ?>

                                <?php if ($value['piping_testing_category'] == 1) : ?>
                                  <?php foreach (explode(";", $value['id_mis_piping']) as $k => $v) : ?>
                                    <?php
                                    $report_no  = explode('/', $detail_mis[$v]['report_no']);
                                    $report_no  = $report_no[1];

                                    ?>
                                    <?= $report_no ?>
                                    <br>
                                  <?php endforeach; ?>
                                <?php else : ?>
                                  <?= $report_no ?>
                                <?php endif; ?>

                              <?php endif; ?>
                            </td>
                            </td>
                            <td>
                              <?= $value['rejected_remarks'] ? $value['rejected_remarks'] : '-' ?>
                            </td>
                            <?php if ($action == "approval") : ?>
                              <td class="text-left">
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="radio" class="form-check-input radio_button approve" name="approval[<?= $key ?>]" value="3" style="transform: scale(1.3);"><b class="text-success">Approve</b>
                                  </label>
                                </div>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="radio" class="form-check-input radio_button reject" name="approval[<?= $key ?>]" value="2" style="transform: scale(1.3);"><b class="text-danger">Reject</b>
                                  </label>
                                </div>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="radio" class="form-check-input radio_button pending" name="approval[<?= $key ?>]" value="4" style="transform: scale(1.3);"><b class="text-info">Pending By QC</b>
                                  </label>
                                </div>
                              </td>
                              <td>
                                <textarea name="remarks[<?= $key ?>]" class="form-control" disabled></textarea>
                              </td>
                            <?php endif; ?>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <hr>
                  <div class="float-right">
                    <a href="<?= site_url('material_verification/request_for_update_list/' . strtr($this->encryption->encrypt($action == "update" ? 'approved_for_update' : 're_approval'), '+=/', '.-~')); ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                    <?php if ($action == "update") : ?>
                      <button type="submit" class="btn btn-warning"><i class="fas fa-edit"></i> Update</button>
                    <?php elseif ($action == "approval") : ?>
                      <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Approve</button>
                    <?php endif; ?>
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
  $(document).ready(function() {
    $('form').on('submit', function() {
      $('button[type=submit]').attr('disabled', true)
    })

    $('.radio_button').change(function() {
      var val = $(this).val()
      var textarea = $(this).closest('tr').find('textarea')
      if (this.checked) {
        if (val == 2 || val == 4) {
          textarea.attr('required', true)
          textarea.removeAttr('disabled')
        } else {
          textarea.attr('disabled', true)
          textarea.removeAttr('required')
        }

      }
    })
  })

  function validate_unique_no_2(input, workpack_no, grade, id_workpack, key) {
    var unique_no = $(input).val()
    var invalid_feedback = $(input).closest('tr').find('.invalid-feedback')
    var mrir = $(input).closest('tr').find(`.mrir_piping_${key}`)
    var heat_no = $(input).closest('tr').find(`.heat_no_piping_${key}`)
    var id_mis = $(input).closest('tr').find('.id_mis_pip_input')

    $(input).removeClass('is-invalid')
    $(input).removeClass('is-valid')

    if ($.trim(unique_no) == "") {
      $(input).addClass('is-invalid')
      invalid_feedback.text("Unique No Cannot Be Empty")
      return false;
    }

    $.ajax({
      url: "<?= site_url('material_verification/validate_unique_number') ?>",
      type: "POST",
      data: {
        unique_no: unique_no,
        workpack_no: workpack_no,
        id_workpack: id_workpack,
        grade: grade
      },
      dataType: "JSON",
      success: function(data) {
        if (data.success) {
          $(input).addClass('is-valid')
          var report_no = data.result.report_no.split('/')
          mrir.val(report_no[1])
          id_mis.val(data.result.id_mis_det)
          heat_no.val(data.result.heat_or_series_no)
        } else {

          mrir.val('')
          id_mis.val('')
          heat_no.val('')

          $(input).val('')
          $(input).addClass('is-invalid')
          invalid_feedback.text(data.text)
        }
      }
    })
  }

  function validate_unique_no(input, workpack_no, grade, id_workpack) {
    var unique_no = $(input).val()
    var invalid_feedback = $(input).closest('tr').find('.invalid-feedback')
    var mrir = $(input).closest('tr').find('.mrir')
    var heat_no = $(input).closest('tr').find('.heat_no')
    var material_description = $(input).closest('tr').find('.material_description')
    var id_mis = $(input).closest('tr').find('.id_mis')

    $(input).removeClass('is-invalid')
    $(input).removeClass('is-valid')

    if ($.trim(unique_no) == "") {
      $(input).addClass('is-invalid')
      invalid_feedback.text("Unique No Cannot Be Empty")
      return false;
    }

    $.ajax({
      url: "<?= site_url('material_verification/validate_unique_number') ?>",
      type: "POST",
      data: {
        unique_no: unique_no,
        workpack_no: workpack_no,
        id_workpack: id_workpack,
        grade: grade
      },
      dataType: "JSON",
      success: function(data) {
        console.log(data)
        if (data.success) {
          $(input).addClass('is-valid')
          var report_no = data.result.report_no.split('/')
          mrir.val(report_no[1])
          id_mis.val(data.result.id_mis_det)
          heat_no.val(data.result.heat_or_series_no)
          material_description.val(data.result.catalog_category)
        } else {

          mrir.val('')
          id_mis.val('')
          heat_no.val('')
          material_description.val('')

          $(input).val('')
          $(input).addClass('is-invalid')
          invalid_feedback.text(data.text)
        }
      }
    })
  }

  function change_status(btn, status) {
    $('.radio_button').prop('checked', false)
    if (status == 3) {
      $('.approve').val(3)
      $('.approve').prop('checked', true)

    } else if (status == 2) {
      $('.reject').val(2)
      $('.reject').prop('checked', true)

    } else if (status == 4) {
      $('.pending').val(4)
      $('.pending').prop('checked', true)

    } else if (status == 0) {
      $('.pending').val('')
      $('.radio_button').prop('checked', false)
    }

    if (status == 2 || status == 4) {
      console.log(status)
      $('textarea').attr('required', true)
      $('textarea').removeAttr('disabled')
    } else {
      $('textarea').attr('disabled', true)
      $('textarea').removeAttr('required')
    }

  }

  function autocomplete_unique(input, workpack_no, grade, id_workpack) {
    $(input).autocomplete({
      source: "<?php echo base_url(); ?>material_verification/autocomplete_unique_no/" + workpack_no + "/" + grade + '/' + id_workpack,
      autoFocus: true,
      classes: {
        "ui-autocomplete": "highlight"
      }
    });
  }

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
</script>