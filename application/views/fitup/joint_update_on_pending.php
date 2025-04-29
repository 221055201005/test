<?php
$fitup = $joint_list[0];
// test_var($fitup);
//print_r($fitup);exit;
?>
<style type="text/css">
  .table {
    font-size: 100% !important;
    padding: 2px !important;
  }

  .select2-container {
    font-size: 70% !important;
    width: 100px !important;
    height: 20px !important;
  }

  .select2 {
    width: 100% !important;
  }
</style>
<div id="content" class="container-fluid">

  <form method="POST" action="<?php echo base_url(); ?>fitup/proses_update_data_request_onpending" id='form_submition'>

    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Update Data - Inspection</h6>
          </div>
          <div class="card-body bg-white overflow-auto">

            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label>Drawing No</label>
                  <input type="text" class="form-control" name="drawing_no" value="<?php echo $fitup['drawing_no'] ?>" readonly>
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label>Discipline</label>
                  <input type="text" class="form-control" name="discipline_view" value="<?php echo (isset($discipline_name[$fitup['discipline']]) ? $discipline_name[$fitup['discipline']] : '-') ?>" readonly>

                  <input type="hidden" class="form-control" name="discipline" value="<?php echo $fitup['discipline']; ?>" readonly>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label>Module</label>
                  <input type="text" class="form-control" name="module_view" value="<?php echo (isset($module_code[$fitup['module']]) ? $module_code[$fitup['module']] : '-') ?>" readonly>
                  <input type="hidden" class="form-control" name="module" value="<?php echo $fitup['module']; ?>" readonly>
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label>Type Of Module</label>
                  <input type="text" class="form-control" name="type_of_module_view" value="<?php echo (isset($type_of_module_name[$fitup['type_of_module']]) ? $type_of_module_name[$fitup['type_of_module']] : '-') ?>" readonly>
                  <input type="hidden" class="form-control" name="type_of_module" value="<?php echo $fitup['type_of_module']; ?>" readonly>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label>Requestor Company</label>
                  <input type="text" class="form-control" name="company" value="<?php echo $fitup['company'] ?>" readonly>
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label>Submission ID</label>
                  <input type="text" class="form-control" id='submission_id' name="requestor" value="<?php echo $fitup['submission_id'] ?>" readonly>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label>Area</label>
                  <select class="select2 select_area" id='mySelect' disabled>
                    <?php foreach ($area_list as $key => $value) : ?>
                      <option value="<?= $value['id'] ?>" <?= $value['id'] == $fitup['area'] ? 'selected' : '' ?>><?= $value['area_name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md">
                <label>Request Date</label>
                <div class="form-group">
                  <input type="date" class="form-control" id="date_request" name="date_request" value="<?= $fitup['date_request'] ? DATE('Y-m-d', strtotime($fitup['date_request'])) : null ?>" onchange='change_date_inspection(this)'>
                  <input type="hidden" class="form-control" id='date_request_from' name="date_from" value="<?= $fitup['date_request'] ? DATE('Y-m-d', strtotime($fitup['date_request'])) : null ?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Inspection Date</label>
                  <input type="date" class="form-control" id='inspection_datetime' name="inspection_datetime" value="<?= $fitup['inspection_datetime'] ? DATE('Y-m-d', strtotime($fitup['inspection_datetime'])) : null ?>" onchange='change_date_inspection(this)'>
                  <input type="hidden" class="form-control" id='inspection_datetime_from' name="inspection_datetime_from" value="<?= $fitup['inspection_datetime'] ? DATE('Y-m-d', strtotime($fitup['inspection_datetime'])) : null ?>">
                </div>
              </div>
            </div>
            <?php if (isset($fitup["inspection_by"])) { ?>
              <hr />
              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>QC Approval By</label>
                    <select name="inspection_by" id='inspection_by' class="select2" style="width: 100%" required>
                      <option value="">---</option>
                      <?php foreach ($user_list_inspector as $key => $value) : ?>
                        <option value="<?= $value['id_user'] ?>" <?= $value['id_user'] == $fitup["inspection_by"] ? "selected" : null ?>><?= $value['full_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label> </label>

                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>



    <input type="hidden" class="form-control" name="submission_id" value="<?php echo $joint_list[0]['submission_id'] ?>" required readonly>

    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Joint Number List</h6>
          </div>
          <div class="card-body bg-white overflow-auto">

            <table class="table table-hover text-center overflow-auto dataTable">
              <thead class="bg-gray-table">
                <tr>
                  <th style="width: 100px !important;max-width: 100px !important;">#</th>
                  <th style="width: 260px !important;">Weld Map Drawing Number</th>
                  <th style="width: 50px !important;">Joint No</th>
                  <th style="width: 155px !important;">Part ID</th>


                  <th style="width: 15px !important;">Thk<br />(mm)</th>
                  <th style="width: 15px !important;">Dia<br />(inch)</th>
                  <th style="width: 15px !important;">Weld<br />Length<br />(mm)</th>
                  <th style="width: 155px !important;">WPS ID</th>
                  <!-- <th style="width: 120px !important;">Fitter Code</th> -->

                  <th style="width: 200px !important;">Remarks</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 0;
                $no_pending = 0;
                foreach ($joint_list as $key => $value) : ?>
                  <?php
                  if ($value['status_inspection'] == '1') {
                    $no_pending++;
                  }

                  if ($value['status_inspection'] == '5') {
                    $no_pending++;
                  }
                  ?>

                  <tr>
                    <td style="text-align: left !important;">
                      <?php if ($value["status_inspection"] == '1' || $value['status_inspection'] >= 3) { ?>
                        <center>
                          <input type="hidden" name="id_fitup[<?php echo $no ?>]" value="<?php echo $value['id_fitup']; ?>">
                          <input type='checkbox' name='submit_id[<?php echo $no; ?>]' onclick='open_disabled_form(this,"<?php echo $no; ?>","<?php echo $get['status_inspection']; ?>")'>
                          <input type='hidden' name='filter_check[<?php echo $no; ?>]' value='0'>
                        </center>
                      <?php } else {
                        echo "-";
                      } ?>
                    </td>
                    <td><?php echo $value['drawing_wm'] ?> Rev.<?php echo $value['rev_wm'] ?></td>
                    <td><?php echo $value['joint_no'] ?></td>
                    <td><span class='badge'><?php echo $value['pos_1'] ?></span>
                      <hr /><span class='badge'><?php echo $value['pos_2'] ?></span>
                    </td>


                    <td><?php echo $value['thickness'] ?></td>
                    <td><?php echo $value['diameter'] ?></td>
                    <td><?php echo $value['weld_length'] ?></td>
                    <td>
                      <select class='form-control select2' name='wps_no[<?php echo $no; ?>]' required disabled>
                        <option value="">---</option>
                        <?php
                        foreach ($wps_list as $key => $value_f) {
                          echo "<option value='" . $value_f['id_wps'] . "'" . ($value['wps_no'] == $value_f['id_wps'] ? "selected" : null) . ">" . $value_f['wps_no'] . "</option>";
                        }
                        ?>
                      </select>
                    </td>

                    <td>
                      <textarea name='remarks[<?php echo $no; ?>]' placeholder="---" disabled><?php echo $value["remarks"]; ?></textarea>
                      <?php
                      if (isset($value["pending_qc_remarks"]) and $value['status_inspection'] == '4') {
                        echo "<br/><span style='font-size:12px !important;'><b>Inspector Remarks :</b><br/>" . $value["pending_qc_remarks"] . "</span>";
                      }
                      ?>
                    </td>

                  </tr>
                <?php $no++;
                endforeach; ?>
              </tbody>
            </table>

            <div class="text-right mt-3">

              <button type="submit" name="submit" class="btn btn-success" title="Submit">Submit</button>

            </div>



          </div>
        </div>
      </div>
    </div>
  </form>


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


<script type="text/javascript">
  $(document).ready(function() {

    $(".select2_multiple_fitter").select2({
      tokenSeparators: [',', ' '],
      ajax: {
        url: "<?php echo base_url(); ?>fitup/get_fitter_ajax",
        type: "post",
        dataType: 'json',
        data: function(params) {
          var query = {
            search: params.term
          }
          return query;
        },
        processResults: function(data) {
          return {
            results: data
          }
        }
      }
    })

    $(".select2_multiple_welder").select2({
      tokenSeparators: [',', ' '],
      ajax: {
        url: "<?php echo base_url(); ?>fitup/get_welder_ajax_version2",
        type: "post",
        dataType: 'json',
        data: function(params) {
          var query = {
            search: params.term
          }
          return query;
        },
        processResults: function(data) {
          return {
            results: data
          }
        }
      }
    })

    $(".select2_multiple_wps").select2({
      tokenSeparators: [',', ' '],
      ajax: {
        url: "<?php echo base_url(); ?>fitup/get_wps_ajax_version2",
        type: "post",
        dataType: 'json',
        data: function(params) {
          var query = {
            search: params.term
          }
          return query;
        },
        processResults: function(data) {
          return {
            results: data
          }
        }
      }
    })

  });

  //  $('.dataTable').DataTable({
  //   order: [],
  //   columnDefs: [{
  //     "targets": 0,
  //     "orderable": false,
  //   }]
  // })

  $('.dataTable').DataTable({
    "paging": false,

  })

  $("select[name=module]").chained("select[name=project]");

  function change_all_button(mode) {

    $(".approve").removeAttr("checked");
    $(".rejected").removeAttr("checked");
    $(".pending").removeAttr("checked");
    $('.reject_remarks').css('display', 'none');
    $('.pending_remarks').css('display', 'none');

    if (mode == '1') {

      console.log(mode);

      $(".approve").attr("checked", "checked");
      $(".rejected").removeAttr("checked");
      $(".pending").removeAttr("checked");

      $('.reject_remarks').css('display', 'none');
      $('.pending_remarks').css('display', 'none');

    } else if (mode == '2') {
      console.log(mode);
      $(".rejected").attr("checked", "checked");
      $(".approve").removeAttr("checked");
      $(".pending").removeAttr("checked");

      $('.reject_remarks').show();
      $('.pending_remarks').css('display', 'none');

    } else if (mode == '3') {

      $(".pending").attr("checked", "checked");
      $(".approve").removeAttr("checked");
      $(".rejected").removeAttr("checked");

      $('.pending_remarks').show();
      $('.reject_remarks').css('display', 'none');

    } else if (mode == '6') {
      console.log(mode);
      $(".rejected").attr("checked", "checked");
      $(".approve").removeAttr("checked");
      $(".pending").removeAttr("checked");

      $('.client_remarks').show();

    } else if (mode == '7') {

      $(".approve").attr("checked", "checked");
      $(".rejected").removeAttr("checked");

      $('.client_remarks').css('display', 'none');

    } else {

      $(".approve").removeAttr("checked");
      $(".rejected").removeAttr("checked");
      $(".pending").removeAttr("checked");

      $('.reject_remarks').css('display', 'none');
      $('.pending_remarks').css('display', 'none');
      $('.client_remarks').css('display', 'none');

    }

  }

  function change_single_button(mode, no) {

    $("#app_" + no).removeAttr("checked");
    $("#rjct_" + no).removeAttr("checked");
    $("#pdg_" + no).removeAttr("checked");

    $('#rjct_rmks_' + no).css('display', 'none');
    $('#pdg_rmks_' + no).css('display', 'none');

    if (mode == '1') {

      $("#app_" + no).attr("checked", "checked");
      $("#rjct_" + no).removeAttr("checked");
      $("#pdg_" + no).removeAttr("checked");

      $('#rjct_rmks_' + no).css('display', 'none');
      $('#pdg_rmks_' + no).css('display', 'none');

    } else if (mode == '2') {

      $("#rjct_" + no).attr("checked", "checked");
      $("#app_" + no).removeAttr("checked");
      $("#pdg_" + no).removeAttr("checked");

      $('#rjct_rmks_' + no).show();
      $('#pdg_rmks_' + no).css('display', 'none');

    } else if (mode == '3') {

      $("#pdg_" + no).attr("checked", "checked");
      $("#rjct_" + no).removeAttr("checked");
      $("#app_" + no).removeAttr("checked");

      $('#pdg_rmks_' + no).show();
      $('#rjct_rmks_' + no).css('display', 'none');

    } else if (mode == '6') {

      $("#rjct_clnt_" + no).removeAttr("checked");
      $("#app_clnt_" + no).removeAttr("checked");

      $('#clnt_rmks_' + no).show();

    } else if (mode == '7') {

      $("#rjct_clnt_" + no).removeAttr("checked");
      $("#app_clnt_" + no).removeAttr("checked");

      $('#clnt_rmks_' + no).css('display', 'none');

    }

  }


  function request_for_update(btn, submission_id) {
    var url = "<?= site_url('fitup/request_for_update/') ?>" + submission_id;
    $("#modal").modal({
      show: true,
      keyboard: false,
      backdrop: "static"
    }).find('.modal-body').load(url)
    $('.modal-title').text("Request For Update")
    $('.modal-dialog').addClass('modal-lg')
  }


  function change_area(event) {
    let area = event.value;

    Swal.fire({
      type: "warning",
      title: "Update Area",
      text: "Are You Sure To Update This Area ? ",
      allowOutsideClick: false,
      showCancelButton: true
    }).then((res) => {
      if (res.value) {
        $.ajax({
          url: "<?= site_url('fitup/update_area') ?>",
          type: "POST",
          data: {
            area: area,
            submission_id: "<?= $joint_list[0]['submission_id'] ?>"
          },
          dataType: "JSON",
          success: function(data) {
            if (data.success) {
              Swal.fire({
                type: "success",
                title: "Success",
                text: "Success Update Area",
                timer: 1000
              })
              // location.reload();
            }
          }
        })
      } else {}
    })

  }

  function open_disabled_form(val, no, status_inspection) {

    var $checkboxes = $('#form_submition td input[type="checkbox"]');
    $checkboxes.change(function() {
      if ($(val).prop("checked") == true) {
        $('select[name="fitter_id[' + no + '][]"]').prop("disabled", false);
        $('select[name="wps_no[' + no + ']"]').prop("disabled", false);
        $('textarea[name="remarks[' + no + ']"]').prop("disabled", false);
        $('input[name="filter_check[' + no + ']"]').val(1);
      } else {
        $('select[name="fitter_id[' + no + '][]"]').prop("disabled", true);
        $('select[name="wps_no[' + no + ']"]').prop("disabled", true);
        $('textarea[name="remarks[' + no + ']"]').prop("disabled", true);
        $('input[name="filter_check[' + no + ']"]').val(0);
      }
    });

  }
</script>


<script>
  function change_date_inspection(input) {
    let inputUpdated = $(input).prop('name');
    let submission_id = $("#submission_id").val();
    let date_request = $("#date_request").val();
    let date_request_from = $("#date_request_from").val();
    let inspection_datetime = $("#inspection_datetime").val();
    let inspection_datetime_from = $("#inspection_datetime_from").val();
    
    Swal.fire({
      title: 'Are you sure to change date?',
      text: "Data will be affected!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Update this date!'
    }).then((result) => {

      if (result.value) {
        $.ajax({
          url: "<?= base_url('fitup/change_inspection_date/') ?>",
          type: "post",
          data: {
            'inputUpdated': inputUpdated,
            'submission_id': submission_id,
            'date_request': date_request,
            'date_request_from': date_request_from,
            'inspection_datetime': inspection_datetime,
            'inspection_datetime_from': inspection_datetime_from,
          },
          success: function(data) {
            Swal.fire(
              'Date Has Been Updated !',
              '',
              'success'
            ).then(function() {

              location.reload();
              return false;
            });
          }
        });

      }
    })
  }
</script>