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
            <h6 class="m-0"><b>Filter Data Summary</b></h6>
          </div>
          <div class="card-body">
            <form action="" method="get">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 text-muted col-form-label "> Project ID</label>
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
                    <label for="" class="col-xl-3 text-muted col-form-label "> Discipline</label>
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
                    <label for="" class="col-xl-3 text-muted col-form-label "> Module</label>
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
                    <label for="" class="col-xl-3 text-muted col-form-label ">Type of Module</label>
                    <div class="col-xl">
                      <select name="type_of_module" class="custom-select">
                        <option value="">---</option>
                        <?php foreach ($type_of_module as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $get['type_of_module'] ? 'selected' : '' ?>>
                            <?= $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 text-muted col-form-label ">Status Inspection</label>
                    <div class="col-xl">
                      <select name="status_inspection" class="custom-select">
                        <option value="">---</option>
                        <option value="5" <?= $get['status_inspection'] == 5 ? 'selected' : '' ?>>Pending Approval</option>
                        <option value="7" <?= $get['status_inspection'] == 7 ? 'selected' : '' ?>>Reviewed</option>
                        <option value="6" <?= $get['status_inspection'] == 6 ? 'selected' : '' ?>>Rejected</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 text-muted col-form-label ">Third Party Status Inspection</label>
                    <div class="col-xl">
                      <select name="thirdparty_inspection_status" class="custom-select">
                        <option value="">---</option>
                        <option value="0" <?= $get['thirdparty_inspection_status'] == '0' ? 'selected' : '' ?>>Pending Approval</option>
                        <option value="2" <?= $get['thirdparty_inspection_status'] == 2 ? 'selected' : '' ?>>Reviewed</option>
                        <option value="1" <?= $get['thirdparty_inspection_status'] == 1 ? 'selected' : '' ?>>Rejected</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="float-right">
                    <button class="mt-2 btn btn-sm btn-flat btn-info" name="search" value="search"><i class="fas fa-search"></i> Search</button>
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
            <h6 class="m-0"><b><?= $meta_title ?> List</b></h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive overflow-auto">
                  <table class="table table-hover text-center" id="table_btr" style="width:100%">
                    <thead class="bg-green-smoe text-white">
                      <th>Project</th>
                      <th>Report Number</th>
                      <th>Drawing Number</th>
                      <th>Discipline</th>
                      <th>Module</th>
                      <th>Type of Module</th>
                      <th>Company</th>
                      <th>Inspection By</th>
                      <th>Inspection Date</th>
                      <th>Status Inspection</th>
                      <th style="min-width: 210px;">Action</th>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($list as $key => $value) : ?>
                        <?php 

                          $enc_report_no = strtr($this->encryption->encrypt($value['report_number']), '+=/', '.-~');
                          $enc_pdf      = strtr($this->encryption->encrypt("pdf"), '+=/', '.-~');
                        
                        ?>
                          <tr>
                            <td><?=$project[$value['project']]['project_name']?></td>
                            <td><?=$value['report_number']?></td>
                            <td><?=$value['drawing_no']?></td>
                            <td><?=$discipline[$value['discipline']]['discipline_name']?></td>
                            <td><?=$module[$value['module']]['mod_desc']?></td>
                            <td><?=$type_of_module[$value['type_of_module']]['name']?></td>
                            <td><?=$company[$value['company']]['company_name']?></td>
                            <td><?=$user[$value['inspection_by']]['full_name'];?></td>
                            <td><?=$value['inspection_date'];?></td>
														<td>
															<?php if(@$value['status_inspection'] == 5): ?>
																<span class="badge badge-pill bg-warning">Pending Approval</span>
																<?php if(@$value['thirdparty_inspection_status'] == 0): ?>
																<br><span class="badge badge-pill bg-warning">Third Party : Pending Approval</span>
																<?php elseif(@$value['thirdparty_inspection_status'] == 2): ?>
																<br><span class="badge badge-pill bg-success text-white">Third Party : Approved</span>
																<?php endif; ?>
															<?php elseif(@$value['status_inspection'] == 6): ?>
																<span class="badge badge-pill badge-danger">Rejected</span>
															<?php elseif(@$value['status_inspection'] == 7): ?>
																<span class="badge badge-pill bg-success text-white">Reviewed</span>
															<?php elseif(@$value['status_inspection'] == 8): ?>
																<span class="badge badge-pill badge-warning">Request for Update</span>
															<?php elseif(@$value['status_inspection'] == 9): ?>
																<span class="badge badge-pill bg-orange text-white">Client RFI - Accepted with Comment</span>
															<?php elseif(@$value['status_inspection'] == 10): ?>
																<span class="badge badge-pill bg-orange text-white">Client RFI - Postponed</span>
															<?php elseif(@$value['status_inspection'] == 11): ?>
																<span class="badge badge-pill bg-orange text-white">Client RFI - Re-Offer</span>
															<?php elseif(@$value['status_inspection'] == 12): ?>
																<span class="badge badge-pill badge-dark">Void</span>
															<?php else: ?>
																<span class="badge badge-pill badge-dark">Not Ready</span>
															<?php endif; ?>
                            </td>
                            <td>
                             <a class="btn btn-danger" href="<?php echo base_url('bondstrand/detail_summary_list/'.$enc_report_no."/".$enc_pdf); ?>"><i class="fas fa-file-pdf"></i> Report</a></a>
                              <a class="btn btn-primary" href="<?php echo base_url('bondstrand/detail_summary_list/'.$enc_report_no); ?>"><i class="fas fa-list"></i> Detail</a></a>
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

    $("#table_btr").DataTable({
        paging: true,
        ordering: true,
        info: true,    })

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

    $('#table_btr').on('click', '.check', function() {
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

    $('#table_btr').on('click', '.check_all', function(e) {
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

  $("select[name=module]").chained("select[name=project_id]");

</script>
