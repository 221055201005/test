<?php


$status_checkbox = $submission_id ? '' : 'disabled';

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
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h6 class="card-title">Transmittal Submission</h6>
            <hr>
            <form action="" method="post">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> <strong>Drawing Number</strong></label>
                    <div class="col-xl">
                      <input type="text" name="drawing_no" class="form-control autocomplete_drawing" placeholder="Drawing No" value="<?= $drawing_no ? $drawing_no : '' ?>">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"><strong>Submission Number</strong></label>
                    <div class="col-xl">
                      <select name="submission_id[]" class="submission_number" style="width:100%" multiple>

                      </select>
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
                        <?php foreach ($project_list as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $project_id ? 'selected' : '' ?>>
                            <?= $value['project_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Drawing Type</label>
                    <div class="col-xl">
                      <select class="custom-select" name="drawing_type">
                        <option value="">---</option>
                        <?php foreach ($drawing_type_list as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $drawing_type ? 'selected' : '' ?>><?= $value['description'] ?></option>
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
                    <label for="" class="col-xl-3 col-form-label text-muted">Module</label>
                    <div class="col-xl">
                      <select name="module" class="custom-select module">
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
                    <label for="" class="col-xl-3 col-form-label text-muted">Type of Module</label>
                    <div class="col-xl">
                      <select name="type_of_module" class="custom-select">
                        <option value="">---</option>
                        <?php foreach ($type_of_module as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $type_module ? 'selected' : ''  ?>>
                            <?= $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Work Pack Number</label>
                    <div class="col-xl">
                      <input type="text" name="workpack_no" class="form-control workpack_no" onblur="validate_workpack_no(this)"
                        placeholder="Work Pack Number" value="<?= $workpack_no ? $workpack_no : '' ?>">
                    </div>
                  </div>
                </div> -->

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Submission Status</label>
                    <div class="col-xl">
                      <select name="submission_status" id="" class="custom-select">
                        <!-- <option value="">---</option> -->
                        <option value="ready_transmit" <?= $submission_status && $submission_status == 'ready_transmit' ? 'selected' : '' ?>>Ready
                        </option>
                        <!-- <option value="reject_client"
                          <?= $submission_status && $submission_status == 'reject_client' ? 'selected' : '' ?>>Reject By
                          Client</option> -->
                        <!-- <option value="postponed"
                          <?= $submission_status && $submission_status == 'postponed' ? 'selected' : '' ?>>Postponed</option>
                        <option value="reoffer"
                          <?= $submission_status && $submission_status == 'reoffer' ? 'selected' : '' ?>>Reoffer</option> -->
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
    <?php //if ($_POST): 
    ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h6 class="card-title">Transmittal RFI List</h6>
            <hr>
            <form id="form_transmit" action="<?= site_url('itr/proceed_transmit_itr_report') ?>" method="post">
              <input type="hidden" name="project_id" value="<?= $project_id ?>">
              <input type="hidden" name="discipline" value="<?= $discipline ?>">
              <input type="hidden" name="module" value="<?= $module ?>">
              <input type="hidden" name="type_of_module" value="<?= $type_module ?>">
              <input type="hidden" name="drawing_no" value="<?= $drawing_no ?>">
              <input type="hidden" name="submission_id" value='<?= json_encode($submission_id) ?>'>
              <input type="hidden" name="drawing_type" value="<?= $drawing_type ?>">
              <?php if ($submission_id) : ?>

                <div class="row">
                  <div class="col-md-12">
                    <strong><i>Inspection Detail</i></strong>
                  </div>
                  <div class="col-md-4 mt-2">
                    <div class="form-group row">
                      <label for="" class="col-xl-4 col-form-label text-muted">Inspector Name</label>
                      <div class="col-xl">
                        <select name="inspector_id" class="select2" style="width: 100%">
                          <option value="0">---</option>
                          <?php foreach ($user_list as $key => $value) : ?>
                            <option value="<?= $value['id_user'] ?>"><?= $value['full_name'] ?></option>
                          <?php endforeach; ?>
                        </select>
                        <!-- <input type="text" name="inspector_id" class="form-control" onfocus="autocomplete_inspector(this)"  required> -->
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12"></div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label for="" class="col-xl-4 col-form-label text-muted">Inspect Date</label>
                      <div class="col-xl">
                        <input type="date" name="inspect_date" class="form-control" value="<?= date('Y-m-d') ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12"></div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label for="" class="col-xl-4 col-form-label text-muted">Inspect Time</label>
                      <div class="col-xl">
                        <input type="time" name="inspect_time" class="form-control" value="<?= date('H:i:s') ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12"></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="text-muted">GA Revision No.</label>
                      <select name="ga_rev_no" class="select2" style="width: 100%;">
                        <?php foreach (array_unique($rev_list["1"]) as $key => $value) : ?>
                          <option value="<?= $value ?>"><?= $value ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="text-muted">AS Revision No.</label>
                      <select name="as_rev_no" class="select2" style="width: 100%;">
                        <?php foreach (array_unique($rev_list["2"]) as $key => $value) : ?>
                          <option value="<?= $value ?>"><?= $value ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                </div>
                <hr>
              <?php else : ?>
                <div class="row">
                  <div class="col-md-12">
                    <b class="text-danger"><i class="fas fa-info-circle"></i> Please Filter Drawing Number & Submission
                      Number First !</b>
                    <hr>
                  </div>
                </div>
              <?php endif; ?>


              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive overflow-auto">
                    <table class="table table-hover text-center" id="table_transmit" style="width:100%">
                      <thead class="bg-green-smoe text-white text-nowrap">
                        <th>
                          <input type="checkbox" name="" id="" class="check_all" style="width:20px; height:20px" <?= $submission_id ? '' : 'disabled' ?>>
                        </th>
                        <th>Project</th>
                        <th>Work Pack No</th>
                        <th>Submission Number</th>
                        <th>Drawing GA</th>
                        <th>Drawing AS</th>
                        <th>Drawing SP</th>
                        <th class="bg-info">SP Revision No</th>
                        <th>Company</th>
                        <th>Discipline</th>
                        <th>Module</th>
                        <th>Type Of Module</th>
                        <th>Part Id No</th>
                       
                        <th>Unique No</th>
                        <th>WPS</th>
                        <th>Consumable Lot No.</th>
                        <th>Welder ID</th>
                        <th>SMOE Inspector Name</th>
                        <th>SMOE Inspection Date Time</th>
                        <th>SMOE Inspection Area</th>
                        <th>SMOE Inspection Location</th>
                        <th>SMOE Inspection Point</th>
                        <th>SMOE Inspection Remarks</th>
                        
                        <th>Status</th>
                        <th>Drawing Status</th>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  </div>
                </div>
                <?php if ($submission_id) : ?>
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
    <?php //endif; 
    ?>
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
      processing: true,
      serverSide: true,
      paging: status_checkbox == '' ? false : true,
      "bFilter": status_checkbox == '' ? false : true,
      "bSort": status_checkbox,
      ajax: {
        url: "<?= site_url($serverside) ?>",
        type: "POST",
        data: {
          module: "<?= $module ?>",
          drawing_no: "<?= $drawing_no ?>",
          drawing_type: "<?= $drawing_type ?>",
          project_id: "<?= $project_id ?>",
          discipline: "<?= $discipline ?>",
          workpack_no: "<?= $workpack_no ?>",
          type_of_module: "<?= $type_module ?>",
          submission_id: <?= json_encode($submission_id) ?>,
        }
      },
      columnDefs: [{
        targets: 0,
        sortable: false,
        render: function(data, row, arr) {

          let is_checked = ''

          if ($.inArray(data, checked) !== -1) {
            is_checked = 'checked'
          }

          if (arr[25].length > 0) {
            return ''
          }

          return `<input type="checkbox" class="check" name="id[${arr[24]}]" value="${data}" style="width:20px; height:20px;" ${status_checkbox} ${is_checked}>`
        }
      }],
      createdRow: function(row, data, dataIndex) {

        if (data[25].length > 0) {
          $(row).addClass('warning-message')
        }
      }
    })

    $('#table_transmit').on('draw.dt', function() {
      $('.select_drawing').select2({
        theme: 'bootstrap'
      });
    });


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

  $('.autocomplete_drawing').autocomplete({
    source: function(request, response) {
      var drawing_type;
      drawing_type = 1;
      $.ajax({
        url: "<?php echo base_url() ?>material_verification/autocomplete_drawing",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: drawing_type,
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
</script>