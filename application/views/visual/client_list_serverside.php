<style>
  a[aria-expanded=true] .fa-angle-double-down {
    display: none;
  }

  a[aria-expanded=false] .fa-angle-double-up {
    display: none;
  }
</style>
<div id="content" class="container-fluid">
  <?php error_reporting(0) ?>
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <a class="btn btn-primary" data-toggle="collapse" href="#collapseButton" role="button" aria-expanded="false" aria-controls="collapseButton">Filter &nbsp; <i class="fas fa-angle-double-down"></i><i class="fas fa-angle-double-up"></i></a>
        </div>
        <div class="collapse <?= $this->input->get() ? 'show' : '' ?>" id="collapseButton">
          <div class="card-body bg-white overflow-auto">
            <form action="" method="GET">
              <div class="row">
                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label ">Project ID</label>
                    <div class="col-xl">
                      <select class="form-control" name="project">
                        <?php // if($this->permission_cookie[0] == 1){ 
                        ?>
                        <option value="">---</option>
                        <?php // } else { 
                        ?>
                        <?php foreach ($project_list as $key => $value) : ?>
                          <?php if (in_array($value['id'], $this->user_cookie[13])) { ?>
                            <option value="<?php echo $value['id'] ?>" <?= (@$project_id == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                          <?php } ?>
                        <?php endforeach; ?>
                        <?php // } 
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label ">Discipline</label>
                    <div class="col-xl">
                      <select class="form-control" name="discipline">
                        <option value="">---</option>
                        <?php foreach ($discipline_list as $key => $value) : ?>
                          <option value="<?php echo $value['id'] ?>" <?php echo (@$discipline == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label ">Module</label>
                    <div class="col-xl">
                      <select class="form-control" name="module">
                        <option value="">---</option>
                        <?php foreach ($module_list as $key => $value) : ?>
                          <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$module == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label ">Module Type</label>
                    <div class="col-xl">
                      <select class="form-control" name="type_of_module">
                        <option value="">---</option>
                        <?php foreach ($type_of_module as $key => $value) : ?>
                          <option value="<?php echo $value['id'] ?>" <?= $module_type == $value['id'] ? 'selected' : '' ?>><?php echo $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label ">Deck Elevation / Service Line</label>
                    <div class="col-xl">
                      <select class="form-control" name="deck_elevation">
                        <option value="">---</option>
                        <?php foreach ($deck_list as $key => $value) : ?>
                          <option value="<?php echo $value['id'] ?>" <?= $deck_elevation == $value['id'] ? 'selected' : '' ?>><?php echo $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group row">
                    <label for="" class="col-md-4 col-lg-3 col-form-label">Inspection Authority</label>
                    <div class="col-xl">
                      <select name="inspection_authority[]" class="form-control select2" style="width:100%" multiple="">
                        <option value="1" <?= in_array(1, $inspection_authority) ? 'selected' : '' ?>>Hold Point</option>
                        <option value="2" <?= in_array(2, $inspection_authority) ? 'selected' : '' ?>>Witness</option>
                        <option value="3" <?= in_array(3, $inspection_authority) ? 'selected' : '' ?>>Monitoring</option>
                        <option value="4" <?= in_array(4, $inspection_authority) ? 'selected' : '' ?>>Review</option>
                      </select>
                    </div>
                  </div>
                </div>
                <?php if ($type) { ?>
                  <div class="col-6">
                    <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label ">Status Inspection </label>
                      <div class="col-xl">
                        <select name="status_inspection" class="custom-select">
                          <option value=""> --- </option>
                          <?php if (in_array($this->user_cookie[10], array(19, 21))) { ?>
                            <option value="5" <?= $this->input->get('status_inspection') == 5 ? 'selected' : '' ?>>Waiting Witness/Review</option>
                          <?php } else { ?>
                            <option value="5" <?= $this->input->get('status_inspection') == 5 ? 'selected' : '' ?>>Pending Approval</option>
                          <?php }  ?>
                          <option value="6" <?= $this->input->get('status_inspection') == 6 ? 'selected' : '' ?>>Rejected</option>
                          <option value="7" <?= $this->input->get('status_inspection') == 7 ? 'selected' : '' ?>>Approved</option>
                          <?php if (in_array($this->user_cookie[10], array(19, 21))) { ?>
                            <option value="witnessed" <?= $this->input->get('status_inspection') == 'witnessed' ? 'selected' : '' ?>>Witnessed</option>
                            <option value="reviewed" <?= $this->input->get('status_inspection') == 'reviewed' ? 'selected' : '' ?>>Reviewed</option>
                          <?php } ?>
                          <option value="9" <?= $this->input->get('status_inspection') == 9 ? 'selected' : '' ?>>Accepted& Release With Comment</option>
                          <option value="10" <?= $this->input->get('status_inspection') == 10 ? 'selected' : '' ?>>Postponed</option>
                          <option value="11" <?= $this->input->get('status_inspection') == 11 ? 'selected' : '' ?>>Re-Offered</option>
                          <option value="12" <?= $this->input->get('status_inspection') == 12 ? 'selected' : '' ?>>Void</option>
                        </select>
                      </div>
                    </div>
                  </div>
                <?php } ?>
                <?php if ($this->user_cookie[7] == 1 or $this->user_cookie[11] == 1) { ?>
                  <div class="col-6">
                    <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label ">Company</label>
                      <div class="col-xl">
                        <select class="form-control" name="company">
                          <option value="0">---</option>
                          <?php foreach ($company_list as $key => $value) : ?>
                            <option value="<?php echo $value['id_company'] ?>" <?= $company == $value['id_company'] ? 'selected' : '' ?>><?php echo $value['company_name'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                <?php } ?>

                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Inspection Client Date From</label>
                    <div class="col-md">
                      <input type="date" class="form-control" name="date_from" value="<?= $_GET['date_from'] ?>">
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Inspection Client Date To</label>
                    <div class="col-md">
                      <input type="date" class="form-control" name="date_to" value="<?= $_GET['date_to'] ?>">
                    </div>
                  </div>
                </div>

              </div>
              <div class="row">
                <div class="col-12 text-right">
                  <button class="mt-2 btn btn-sm btn-flat btn-info" name="submit" value="search"><i class="fas fa-search"></i> Search</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Client Document List</h6>
        </div>
        <div class="card-body bg-white">
          <div class="overflow-auto">
            <table class="table table-hover text-center dataTable" id="table_client" width="100%">
              <thead class="bg-gray-table">
                <tr>
                  <th>Project</th>
                  <th>Company</th>
                  <th>Report No.</th>
                  <th>Drawing No.</th>
                  <th>Discipline</th>
                  <th>Module</th>
                  <th>Module Type</th>
                  <th>Deck Elevation / Service Line</th>

                  <th>Rev No</th>

                  <th>Inspection By</th>
                  <th>Inspection Date</th>
                  <th>Status Inspection</th>
                  <th>Status Invitation</th>
                  <!-- <th>Transmittal Status</th> -->
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
          <br>
          <div class="col-md-4">
            <div class="row mb-1">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php //endif; 
  ?>

  <div class="modal fade" id="modalReoffer" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="<?php echo base_url(); ?>visual/process_postpone_reapproval" method="POST">
          <div class="modal-header">
            <h4 class="modal-title">Re-Offer RFI</h4>
          </div>
          <div class="modal-body">
            <b><i>Re-Offer - Remarks :</i></b> <br />
            <input type="hidden" name="status_inspection" value="11">
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
</div><!-- ini div dari sidebar yang class wrapper -->
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
        url: "<?php echo base_url() ?>visual/proceed_request_for_update_report",
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

  function changeReport(report_number, drawing_no) {
    $.ajax({
      url: "<?= base_url('visual/return_rfi/') ?>",
      type: "post",
      data: {
        'report_number': report_number,
        'drawing_no': drawing_no,
        'backtopro': 'piping',
      },
      success: function(data) {
        console.log(data)
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
          ).then(function() {
            return false;
          });
        }
      }
    });
  }

  $(document).ready(function() {
    $("#table_client").DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: "<?= site_url($serverside) ?>",
        type: "POST",
        data: {
          project_id: "<?= $project_id ?>",
          discipline: "<?= $discipline ?>",
          module: "<?= $module ?>",
          module_type: "<?= $module_type ?>",
          status_inspection: "<?= $status_inspection_data ?>",
          deck_elevation: "<?= $deck_elevation ?>",
          inspection_authority: "<?= "'" . implode(';', $inspection_authority) . "'" ?>",
          company: "<?= $company ?>",
          date_from: "<?= $this->input->get('date_from') ?>",
          date_to: "<?= $this->input->get('date_to') ?>",
          type: "<?= $type ?>",
        }
      }
    })
  })

  $("select[name=module]").chained("select[name=project]");

  $(".autocomplete_doc").autocomplete({
    source: function(request, response) {
      $.ajax({
        url: "<?php echo base_url() ?>visual/autocomplete_drawing",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: 1,

          project: project_js,
          discipline: discipline_js,
          module: module_js,
          type_of_module: type_module_js,
        },
        success: function(data) {
          response(data);
          get_data_drawing(ui.item.value);
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

  $(".autocomplete_wm").autocomplete({
    source: function(request, response) {
      console.log('wm autc')
      $.ajax({
        url: "<?php echo base_url() ?>visual/autocomplete_drawing",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: 2,

          project: project_js,
          discipline: discipline_js,
          module: module_js,
          type_of_module: type_module_js,
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
    console.log(document_no);
    console.log(module);
    $.ajax({
      url: "<?php echo base_url() ?>engineering/get_data_drawing",
      dataType: "json",
      data: {
        document_no: document_no,
        module: module,
      },
      success: function(data) {
        console.log(data);
        if (data.drawing_type == 1 || data.drawing_type == 2) {
          $("select[name=project]").val(data.project).trigger('change');
          $("select[name=discipline]").val(data.discipline);
          $("select[name=drawing_type]").val(data.drawing_type);
          if (module == "") {
            $("select[name=module]").val(data.module);
          }
        }
      }
    });
  }

  function return_rfi(report_number, drawing_no, backtopro) {
    console.log(report_number);
    Swal.fire({
      title: 'Are you sure want to Return this RFI ?',
      text: "",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Return it!'
    }).then((result) => {
      console.log(result)
      console.log('jawabanya')
      if (result.value) {
        $.ajax({
          url: "<?= base_url('visual/return_rfi') ?>",
          type: "post",
          data: {
            'backtopro': backtopro,
            'report_number': report_number,
            'drawing_no': drawing_no,
          },
          success: function(data) {
            Swal.fire(
              'RFI has been returned!',
              '',
              'success'
            ).then(function() {

              location.reload();
              return false;
            });
          },
          error: function(data) {
            Swal.fire(
              'RFI failed to return!',
              '',
              'error'
            ).then(function() {

              location.reload();
              return false;
            });
          }
        });
      }
    })

  }

  var selecteds = 0


  function enable_edit(no, thiss, identic) {
    identic = identic
    if (thiss.checked == true) {
      selecteds++
      console.log(selecteds)
      console.log('yes')

      var total = '<?= $juml ?>';
      var i;

      for (i = 0; i < total; i++) {
        if (!$('.cb' + i).hasClass(identic)) {
          $('.cb' + i).prop("disabled", true);
          $('.div_' + i).attr('title', 'Different GA/AS');
        }
      }


      $('.will_enable' + no).removeAttr('disabled');
      $('.will_enable' + no).prop('required', true);
      if (selecteds >= 30) {
        $('.checkbox-big').addClass('disabled-effect')
      }
    } else {
      var total = '<?= $juml ?>';
      var i;
      selecteds--
      console.log('not')
      console.log(selecteds)
      $('.will_enable' + no).prop('disabled', true);
      $('.will_enable' + no).removeAttr('required');

      if (selecteds == 0) {
        console.log('sampai')
        for (i = 0; i < total; i++) {
          console.log(i)
          $('.cb' + i).removeAttr('disabled');
          $('.div_' + i).attr('title', 'Different GA/AS');
        }
      }

    }
    $("#thicked b").text(' ' + selecteds)
  }
</script>
<script>
  function handleReoffer(drawing_no, discipline, module, type_of_module, report_number) {
    $("input[name='drawing_no']").val(drawing_no);
    $("input[name='discipline']").val(discipline);
    $("input[name='module']").val(module);
    $("input[name='type_of_module']").val(type_of_module);
    $("input[name='report_number']").val(report_number);

    $("#modalReoffer").modal();
  }
</script>