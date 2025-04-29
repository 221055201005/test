<?php


$status_checkbox = $submission_id ? '' : 'disabled';
// test_var($get);
?>
<style>
  tr td input[type=text] {
    width: 300px !important
  }

  th,
  td {
    vertical-align: middle !important;
  }

  .warning-message {
    background-color: #fff7c4 !important;
  }
</style>
<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow my-3">
          <div class="card-header">
            <h6 class="card-title m-0">Transmittal Submission</h6>
          </div>
          <div class="card-body">

            <form action="" method="get">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> <strong>Drawing Number</strong></label>
                    <div class="col-xl">
                      <input type="text" class="form-control autocomplete_doc" name="drawing_no" value="<?php echo @$get['drawing_no'] ?>" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <hr>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Project</label>
                    <div class="col-xl">
                      <select name="project_id" class="custom-select" onchange="find_module_by_project(this)">
                        <option value="">---</option>
                        <?php foreach ($project as $key => $value) : ?>
													<?php if(in_array($value['id'], $this->user_cookie[13])): ?>
                            <option value="<?= $value['id'] ?>" <?= $value['id'] == $get['project_id'] ? 'selected' : '' ?>>
                            <?= $value['project_name'] ?></option>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Discipline</label>
                    <div class="col-xl">
                      <select name="discipline" class="custom-select">
                        <option value="">---</option>
                        <?php foreach ($discipline as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $get['discipline'] ? 'selected' : '' ?>>
                            <?= $value['discipline_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Module</label>
                    <div class="col-xl">
                      <select name="module" class="custom-select module">
                        <option value="">---</option>
                        <?php foreach ($module as $key => $value) : ?>
                          <option value="<?= $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?= $value['mod_id'] == $get['module'] ? 'selected' : '' ?>>
                            <?= $value['mod_desc'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Type of Module</label>
                    <div class="col-xl">
                      <select name="type_of_module" class="custom-select">
                        <option value="">---</option>
                        <?php foreach ($type_of_module as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $get['type_of_module'] ? 'selected' : ''  ?>>
                            <?= $value['name'] ?></option>
                        <?php endforeach; ?>
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

          </div>
          </form>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card shadow my-3">
          <div class="card-header">
            <h6 class="card-title m-0">Transmittal RFI List</h6>
          </div>
          <div class="card-body">
            <form id="form_transmit" action="<?= site_url('bondstrand/proses_transmit') ?>" method="post">
              <input type="hidden" name="project_id" value="<?= $get['project_id'] ?>">
              <input type="hidden" name="discipline" value="<?= $get['discipline'] ?>">
              <input type="hidden" name="module" value="<?= $get['module'] ?>">
              <input type="hidden" name="type_of_module" value="<?= $get['type_of_module'] ?>">
              <input type="hidden" name="drawing_no" value="<?= $get['drawing_no'] ?>">
              <?php if ($get['drawing_no']) : ?>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label for="" class="col-xl-3 col-form-label text-muted font-weight-bold"> Type Report No. </label>
                      <div class="col-xl">
                        <input type="number" name="manual_report_no" id="" class="form-control" placeholder="(Number Only. Ex : 1)" required>
                      </div>
                    </div>
                  </div>
                </div>
              <?php else : ?>
                <div class="row">
                  <div class="col-md-12">
                    <h6><b class="text-danger"><i class="fas fa-info-circle"></i> Please Filter Drawing Number First!</b></h6>
                    <hr>
                  </div>
                </div>
              <?php endif; ?>

              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive overflow-auto">
                    <table class="table table-hover text-center" id="table_transmit" style="width:100%">
                      <thead class="bg-green-smoe text-white text-nowrap">
                        <tr>
                          <th rowspan="3">
                            <input type="checkbox" name="" id="" class="check_all" style="width:20px; height:20px" <?= $get['drawing_no'] ? '' : 'disabled' ?>>
                          </th>
                          <th rowspan="3">NO</th>
                          <th rowspan="3">PROJECT</th>
                          <th rowspan="3">WORK PACK NO</th>
                          <th rowspan="3">SUBMISSION NUMBER</th>
                          <th rowspan="3">DRAWING NO</th>
                          <th colspan="3">ISOMETRIC</th>
                          <th rowspan="3">BONDER ID</th>
                          <th colspan="3">FIT UP & JOINT PREPARATION</th>
                          <th colspan="7">ADHESIVE BONDED JOINT</th>
                          <th colspan="3">JOINT CURING</th>
                          <th colspan="2">ENV</th>
                          <th rowspan="3">SMOE INSPECTOR NAME</th>
                          <th rowspan="3">SMOE INSPECTOR DATE TIME</th>
                          <th rowspan="3">SMOE INSPECTOR AREA</th>
                          <th rowspan="3">SMOE INSPECTOR LOCATION</th>
                          <!-- <th rowspan="3">SMOE INSPECTOR POINT</th> -->
                          <!-- <th rowspan="3">SMOE INSPECTOR REMARKS</th> -->
                          <th rowspan="3">INSPECTION RESULT</th>
                          <th rowspan="3">REMARKS</th>
                        </tr>
                        <tr>
                          <th rowspan="2">JOINT NO</th>
                          <th rowspan="2">SPOOL NO</th>
                          <th rowspan="2">OD (INCH)</th>
                          <th rowspan="2">SANDING (40-60 GRIT)</th>
                          <th rowspan="2">CLEAN & DRY</th>
                          <th rowspan="2">ALIGNMENT</th>
                          <th colspan="2">BATCH NO OF ADHESIVE</th>
                          <th rowspan="2">ADHESIVE TYPE</th>
                          <th colspan="2">TIME</th>
                          <th colspan="2">INSERTION DEPTH</th>
                          <th rowspan="2">TEMP (DEG C)</th>
                          <th colspan="2">TIME</th>
                          <th rowspan="2">HUM</th>
                          <th rowspan="2">TEMP</th>
                        </tr>
                        <tr>
                          <th>R</th>
                          <th>H</th>
                          <th>START</th>
                          <th>FINISH</th>
                          <th>SPEC</th>
                          <th>ACTUAL</th>
                          <th>START</th>
                          <th>FINISH</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 1;
                        foreach ($list as $key => $value) : ?>
                          <tr>
                            <td>
                              <input type="checkbox" name="id_baa[<?= $key ?>]" value="<?= $value['id_baa'] ?>" class="check" style="width:20px; height:20px" <?= $get['drawing_no'] ? '' : 'disabled' ?>>
                              <input type="hidden" name="company[<?= $key ?>]" value="<?= $value['company'] ?>">
                            </td>
                            <td>
                              <?= $no++ ?>
                            </td>
                            <td><?= $project[$value['project']]['project_name'] ?></td>
                            <td><?= $workpack[$value['id_workpack']]['workpack_no'] ?></td>
                            <td><?= $value['submission_id'] ?></td>
                            <td><?= $value['drawing_no'] ?></td>
                            <td><?= $joint[$value['id_joint']]['joint_no'] ?></td>
                            <td class="text-nowrap">
                              <?= $piecemark[$joint[$value['id_joint']]['pos_1']]['spool_no'] ?>
                              <hr style="margin:5px">
                              <?= $piecemark[$joint[$value['id_joint']]['pos_2']]['spool_no'] ?>
                            </td>
                            <td><?= $joint[$value['id_joint']]['diameter'] ?></td>
                            <td>
                              <?php

                              $bonders  = [];
                              foreach (explode(";", $value['bonder_id']) as $v) {
                                $bonders[] = $bonder[$v]['bonder_id'];
                              }

                              ?>

                              <?= implode(',<br>', $bonders) ?>
                            </td>
                            <td><?= $value['sanding_40_60'] ?></td>
                            <td><?= $value['clean_dry'] ?></td>
                            <td class="text-nowrap">
                              <?= $piecemark[$joint[$value['id_joint']]['pos_1']]['material'] ?>
                              <hr style="margin:5px">
                              <?= $piecemark[$joint[$value['id_joint']]['pos_2']]['material'] ?>
                            </td>
                            <td><?= $value['adhesive_r'] ?></td>
                            <td><?= $value['adhesive_h'] ?></td>

                            <td><?= $value['adhesive_type'] ?> </td>
                            <td><?= $value['adhesive_time_start'] ?></td>
                            <td><?= $value['adhesive_time_stop'] ?></td>

                            <td><?= $value['depth_spec'] ?></td>
                            <td><?= $value['depth_actual'] ?></td>

                            <td><?= $value['curing_temp'] ?></td>

                            <td><?= $value['curing_start'] ?></td>

                            <td><?= $value['curing_finish'] ?></td>

                            <td><?= $value['env_hum'] ?> </td>
                            <td>
                              <?= $value['env_temp'] ?>
                            </td>
                            <td><?= $user[$value['inspection_by']]['full_name']; ?></td>
                            <td><?= $value['inspection_date']; ?></td>
                            <td><?= isset($area[$value['area']]) ? $area[$value['area']]['name'] : '-'; ?></td>

                            <td><?= isset($location[$value['location']]) ? $location[$value['location']]['name'] : '-'; ?></td>
                            <!-- <td></td> -->
                            <td><?= $value['status_inspection'] == '1' ? '<span class="badge badge-pill badge-warning">Pending Approval</span>' : ($value['status_inspection'] == '3' ? '<span class="badge badge-pill badge-success">Approved</span>' : ($value['status_inspection'] == '2' ? '<span class="badge badge-pill badge-danger">Reject</span>' : '')) ?>
                            </td>
                            <td><?= $value['inspection_remarks'] ?></td>

                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>

                  </div>
                </div>
                <?php if ($get['drawing_no']) : ?>
                  <div class="col-md-12 text-right">
                    <hr>
                    <strong><i class="fas fa-check-circle"></i> Ticked <span class="text_total_checked text-danger">0</span> Item(s)</strong>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" id="btn_submit" class="btn btn-primary" disabled><i class="fas fa-paper-plane"></i>
                      Transmit</button>
                  </div>
                <?php endif; ?>
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
    var checked = []
    var checked_drawing = []

    var status_checkbox = "<?= $status_checkbox ?>"

    $("#table_transmit").DataTable({
      order: [],
      paging: status_checkbox == '' ? false : true,
      "bFilter": status_checkbox == '' ? false : true,
      "bSort": status_checkbox,
    })

    $(".submission_number").select2({
      // tags: true,
      multiple: true,
      theme: 'bootstrap',
      tokenSeparators: [',', ' '],
      minimumInputLength: 1,
      ajax: {
        url: "<?= site_url('itr/list_approved_submission_id') ?>",
        dataType: "json",
        type: "GET",
        data: function(params) {

          var queryParameters = {
            term: params.term,
            project_code: $('select[name=project_id]').val(),
            discipline: $('select[name=discipline]').val(),
            module: $('select[name=module]').val(),
            type_of_module: $('select[name=type_of_module]').val(),
            drawing_no: $('input[name=drawing_no]').val(),
          }
          return queryParameters;
        },
        processResults: function(data) {
          return {
            results: $.map(data, function(item) {
              return {
                text: item.submission_id,
                id: item.submission_id
              }
            })
          };
        }
      }
    });

    $('#table_transmit').on('click', '.check', function() {
      var editable = $(this).closest('tr').find('.editable')
      var value = $(this).val()

      console.log(value)

      var closest_as = $(this).closest('tr').find('td:nth-child(6)').text()
      var editable = $(this).closest('tr').find('.editable')

      console.log(closest_as)

      if (checked_drawing.length > 0) {
        if (checked_drawing[0] != closest_as) {
          this.checked = false
          Swal.fire({
            type: "warning",
            title: "Different Drawing",
            text: "Cannot Submit Multiple Drawing AS In One Submission"
          })

          return
        }
      }

      if (this.checked) {
        checked.push(value)
        editable.removeAttr('disabled')
        checked_drawing.push(closest_as)
      } else {
        editable.attr('disabled', true)
        checked.splice($.inArray(value, checked), 1)
        checked_drawing.splice($.inArray(closest_as, checked_drawing), 1)
      }

      if (checked.length > 0) {
        $("#btn_submit").removeAttr('disabled')
      } else {
        $("#btn_submit").attr('disabled', true)
      }

      $('.text_total_checked').text(checked.length)
      console.log(checked)

    })

    $('#table_transmit').on('click', '.check_all', function(e) {
      checked = []
      checked_drawing = []

      if (this.checked) {
        $('.check').each(function() {
          this.checked = true
          var value = $(this).val()
          var closest_as = $(this).closest('tr').find('td:nth-child(6)').text()

          if (checked_drawing.length > 0) {
            if (checked_drawing[0] != closest_as) {
              this.checked = false
              Swal.fire({
                type: "warning",
                title: "Different Drawing",
                text: "Cannot Submit Multiple Drawing AS In One Submission"
              })

              return
            }
          }

          checked.push(value)
          checked_drawing.push(closest_as)

          var editable = $(this).closest('tr').find('.editable')
          editable.removeAttr('disabled')
        })
      } else {
        $('.check').each(function() {
          this.checked = false
          var closest_as = $(this).closest('tr').find('td:nth-child(5)').text()
          var value = $(this).val()

          checked.splice($.inArray(value, checked), 1)
          checked_drawing.splice($.inArray(closest_as, checked_drawing), 1)

          var editable = $(this).closest('tr').find('.editable')
          editable.attr('disabled', true)
        })
      }
      if (checked.length > 0) {
        $("#btn_submit").removeAttr('disabled')
      } else {
        $("#btn_submit").attr('disabled', true)
      }

      $('.text_total_checked').text(checked.length)
      console.log(checked)
    })

    $('.workpack_no').autocomplete({
      source: "<?php echo base_url(); ?>material_verification/autocomplete_workpack_no",
      autoFocus: true,
      classes: {
        "ui-autocomplete": "highlight"
      }
    });

    $('#btn_submit').on('click', function(e) {
      e.preventDefault()
      Swal.fire({
        type: "warning",
        title: "TRANSMIT",
        text: "Are you sure to transmit selected data ?",
        allowOutsideClick: () => !Swal.isLoading(),
        showCancelButton: true
      }).then((res) => {
        if (res.value) {
          Swal.fire({
            title: "PROCESSING ...",
            html: `Please Don't Close This Window`,
            onBeforeOpen() {
              Swal.showLoading()
            },
            allowOutsideClick: false
          })
          $('#form_transmit').submit()
        }
      })
    })

  })

  function find_module_by_project(select, mod_id = null) {
    var project_id = $(select).val()
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
  }

  $(".autocomplete_doc").autocomplete({
    source: function(request, response) {
      var project_id = $("#project_id option:selected").val();
      var drawing_type = 1;
      $.ajax({
        url: "<?php echo base_url() ?>engineering/autocomplete_drawing",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: drawing_type,
          project_id: project_id,
        },
        success: function(data) {
          response(data);
        }
      });
    },
    select: function(event, ui) {
      var value = ui.item.value;
      if (value == 'No Data.') {
        ui.item.value = "";
      } else {
        get_data_drawing(ui.item.value);
      }
    }
  });

  function get_data_drawing(document_no) {
    var module = $("select[name=module]").val();
    $.ajax({
      url: "<?php echo base_url() ?>material_verification/get_data_drawing",
      dataType: "json",
      data: {
        document_no: document_no,
        module: ''
      },
      success: function(data) {
        console.log(data);
        if (data.drawing_type == 1 || data.drawing_type == 2) {
          $("select[name=project_id]").val(data.project);
          find_module_by_project("select[name=project_id]", data.module);
          $("select[name=discipline]").val(data.discipline);
          $("select[name=drawing_type]").val(data.drawing_type);
          $("select[name=type_of_module]").val(data.type_of_module);
          $("select[name=module]").removeAttr('disabled', true);
        }
      },
      error: function(err) {
        console.log(err)
      }
    });
  }

  function validate_unique_no(input, workpack_no, grade, id_workpack) {
    var unique_no = $(input).val()
    var invalid_feedback = $(input).closest('tr').find('.invalid-feedback')
    var mrir = $(input).closest('tr').find('.mrir')
    var heat_no = $(input).closest('tr').find('.heat_no')
    var material_description = $(input).closest('tr').find('.material_description')
    var id_mis = $(input).closest('tr').find('.id_mis')

    console.log(grade)

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

  function autocomplete_unique(input, workpack_no, grade, id_workpack) {
    $(input).autocomplete({
      source: "<?php echo base_url(); ?>material_verification/autocomplete_unique_no/" + workpack_no + '/' + grade + '/' + id_workpack,
      autoFocus: true,
      classes: {
        "ui-autocomplete": "highlight"
      }
    });
  }

  function autocomplete_inspector(input) {
    $(input).autocomplete({
      source: "<?php echo base_url(); ?>material_verification/autocomplete_inspector/",
      autoFocus: true,
      classes: {
        "ui-autocomplete": "highlight"
      }
    });
  }

  function validate_workpack_no(input) {
    var workpack_no = $(input).val()
    var module = $("select[name=module]").val();
    $.ajax({
      url: "<?= site_url('material_verification/detail_workpack') ?>",
      type: "POST",
      data: {
        workpack_no: workpack_no
      },
      dataType: "JSON",
      success: function(data) {
        console.log(data)
        var data = data.data
        $("select[name=project_id]").val(data.project);
        find_module_by_project($("select[name=project_id]"), data.module)
        $("select[name=discipline]").val(data.discipline);
        $("select[name=drawing_type]").val(data.drawing_type);
        $("input[name=drawing_no]").val(data.drawing_no);
        // $("select[name=module]").val(data.module)
        $("select[name=type_of_module]").val(data.type_of_module);
      }
    })
  }

  function filter_status(select) {
    let status = select.value

    let url = "<?= site_url('material_verification/transmittal_rfi/') ?>"

    window.location.href = url + status
  }

  $("select[name=module]").chained("select[name=project_id]");
</script>