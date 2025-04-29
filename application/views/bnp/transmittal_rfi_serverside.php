<style>
  th,
  td {
    vertical-align: middle !important;
  }
</style>
<div id="content" class="container-fluid">

  <form id="form_create_workpack" method="POST">
    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0"><?php echo $meta_title ?></h6>
          </div>
          <div class="card-body bg-white">
            <div class="row">

              <div class="col-md-6">
                <div class="form-group row">
                  <label for="" class="col-xl-2 col-form-label text-muted"> Request Number</label>
                  <div class="col-xl">
                    <select name="request_no" class="select2 actv" style="width:100%" required>
                      <option value="">---</option>
                      <?php foreach ($request_no_lis as $key => $value) {
                        if ($value['request_no'] != '') { ?>
                          <option value="<?= $value['request_no'] ?>" <?= $request_no == $value['request_no'] ? 'selected' : '' ?> data-chained="<?php echo $value['request_no'] ?>"><?= $value['request_no'] ?></option>
                      <?php }
                      } ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group row">
                  <label for="" class="col-xl-2 col-form-label text-muted"> Paint System</label>
                  <div class="col-xl">
                    <select name="paint_system" class="select2 psystem" style="width:100%" required>
                      <option value="">---</option>
                      <?php foreach ($paint_system as $key => $value) : ?>
                        <option value="<?= $value['id'] ?>" <?= $id_paint_system == $value['id'] ? 'selected' : '' ?>><?= $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group row">
                  <label for="" class="col-xl-2 col-form-label text-muted"> Activity</label>
                  <div class="col-xl">
                    <select name="activity" class="select2 actv" style="width:100%" required>
                      <option value="">---</option>
                      <?php foreach ($activity as $key => $value) : ?>
                        <option value="<?= $value['id_activity'] ?>" <?= $id_activity == $value['id_activity'] ? 'selected' : '' ?> data-chained="<?php echo $value['id_paint_system'] ?>"><?= $value['description_of_activity'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-12 text-right">
                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-search"></i> Search
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

  <form id="form_bnp" method="POST" action="<?php echo base_url() ?>planning_bnp/transmitt_to_client">
    <div class="row">

      <div class="col-12 <?= $class ?>">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Transmittal Form</h6>
          </div>
          <div class="card-body bg-white">
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <strong><i>Inspection Detail</i></strong>
                </div>
                <div class="col-md-6 mt-2">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Inspector Name</label>
                    <div class="col-xl">
                      <select name="inspector_id" class="select2" style="width: 100%" required>
                        <option value="">---</option>
                        <?php foreach ($user_list as $key => $value) : ?>
                          <option value="<?= $value['id_user'] ?>"><?= $value['full_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 mt-2">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Company Assigned</label>
                    <div class="col-xl">
                      <select name="id_vendor" class="select2" style="width: 100%" required>
                        <option value="">---</option>
                        <?php foreach ($company_list as $key => $value) : ?>
                          <option value="<?= $value['id_company'] ?>"><?= $value['company_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Inspect Date from</label>
                    <div class="col-xl">
                      <input type="date" name="inspection_date" class="form-control" required>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Inspect Date to</label>
                    <div class="col-xl">
                      <input type="date" name="inspection_date_to" class="form-control" required>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Inspect Area</label>
                    <div class="col-xl">
                      <select class="select2 will_enable" name="area">
                        <option value="">---</option>
                        <?php foreach ($area_v2 as $value_area) { ?>
                          <option value="<?= $value_area['id'] ?>"><?= $value_area['name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Inspect Location</label>
                    <div class="col-xl">
                      <select class="select2 will_enable" name="location[]" multiple="">
                        <option value="">---</option>
                        <?php foreach ($location_v2 as $value_location) { ?>
                          <option value="<?= $value_location['id'] ?>" data-chained="<?php echo $value_location['id_area'] ?>"><?= $value_location['name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <script type="text/javascript">
                  $("select[name=location]").chained("select[name=area]");
                </script>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Inspect Qty</label>
                    <div class="col-xl">
                      <input type="text" name="qty" class="form-control" required>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <hr>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"><b>Trace Code</b></label>
                    <div class="col-xl">
                      <input type="text" name="report_number" class="form-control" required>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Submitted Date</label>
                    <div class="col-xl">
                      <input type="date" name="submitted_date" class="form-control" required>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <hr>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Expected Time</label>
                    <div class="col-xl">
                      <textarea class="form-control" required name='expected_time[]'></textarea>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">ITP Intervention to Employer</label>
                    <div class="col-xl">
                      <select name="itp[0][]" class="form-control select2" style="width:100%" required multiple="">
                        <option value="1">Hold Point</option>
                        <option value="2">Witness</option>
                        <option value="3">Monitoring</option>
                        <option value="4">Review</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Inspection Execution Result</label>
                    <div class="col-xl">
                      <textarea class='form-control' required name='result[]'> </textarea>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 <?= $class ?>">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Transmittal Form</h6>
          </div>
          <div class="card-body bg-white">
            <div class="form-group">
              <div class="overflow-auto">
                <table id="tbl_rfi_detail" class="table table-hover text-center table-bordered">
                  <thead class="bg-info text-white">
                    <tr>
                      <?php if ($this->user_cookie[7] != 8) { ?>
                        <th><button type='button' class="btn btn-sm btn-primary" onclick="add_row_rfi()"><i class="fas fa-plus"></i></button></th>
                      <?php } ?>
                      <th>Item / Tag Number</th>
                      <th>Item / Tag Description</th>
                      <!-- <th>Expected Time</th>
                      <th>ITP Intervention to Employer</th>
                      <th>Inspection Execution Result</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($irn_tag as $key => $value) : ?>
                      <tr>
                        <?php if ($this->user_cookie[7] != 8) { ?>
                          <td class="align-top">
                            <button type='button' class='btn btn-danger' onclick='delete_row_rfi_detail(this, "<?php echo $value["id_description"] ?>")'>
                              <i class='fas fa-trash-alt'></i>
                            </button>
                          </td>
                        <?php } ?>
                        <td class="row_<?= $value['id_description'] ?>">
                          <textarea class="form-control" required name='tag_no[<?= $key ?>]'><?php echo $value["item_tag_no"] ?></textarea>
                          <input type="hidden" name="id_detail[<?= $key ?>]" value="<?php echo $value["id_description"] ?>">
                        </td>

                        <td class="row_<?= $value['id_description'] ?>">
                          <textarea class="form-control" required name='tag_description[<?= $key ?>]'><?php echo $value["item_tag_description"] ?></textarea>
                        </td>
                        <!-- <?php if($key==0){ ?>
                          <td rowspan="<?= COUNT($irn_tag) ?>" class="align-top anu">
                            <textarea class="form-control" required name='expected_time[<?= $key ?>]'></textarea>
                          </td>
                          <td rowspan="<?= COUNT($irn_tag) ?>" class="align-top anu">
                            <select name="itp[<?= $key ?>][]" class="form-control select2" style="width:100%" required multiple="">
                              <option value="1">Hold Point</option>
                              <option value="2">Witness</option>
                              <option value="3">Monitoring</option>
                              <option value="4">Review</option>
                            </select>
                          </td>
                          <td rowspan="<?= COUNT($irn_tag) ?>" class="align-top anu">
                            <textarea class='form-control' required name='result[<?= $key ?>]'> </textarea>
                          </td>
                        <?php } ?> -->
                        
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 <?= $class ?>">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Paint System Details</h6>
          </div>
          <div class="card-body bg-white">
            <div class="form-group">
              <div class="overflow-auto">
                        <table style='width: 500px !important;' class="table table-hover text-center table-bordered">
                          <tr>
                            <th>Paint System</th>
                            <th>:</th>
                            <td><?= (isset($master_paint_system_details[$id_paint_system]["code"]) ? $master_paint_system_details[$id_paint_system]["code"] : "-" ) ?></td>
                          </tr>
                          <tr>
                            <th>Activity Details</th>
                            <th>:</th>
                            <td><?= (isset($master_activity[$id_paint_system][$id_activity]) ? $master_activity[$id_paint_system][$id_activity]["description_of_activity"] : "-" ) ?></td>
                          </tr>
                          <tr>
                            <th>Generic</th>
                            <th>:</th>
                            <td><?= (isset($master_activity[$id_paint_system][$id_activity]) ? $master_activity[$id_paint_system][$id_activity]["generic"] : "-" ) ?></td>
                          </tr>
                          <tr>
                            <th>Paint Product</th>
                            <th>:</th>
                            <td><?= (isset($master_activity[$id_paint_system][$id_activity]) ? $master_activity[$id_paint_system][$id_activity]["paint_product"] : "-" ) ?></td>
                          </tr>
                          <tr>
                            <th>Colour</th>
                            <th>:</th>
                            <td><?= (isset($master_activity[$id_paint_system][$id_activity]) ? $master_activity[$id_paint_system][$id_activity]["color"] : "-" ) ?></td>
                          </tr>
                        </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0"><?php echo $meta_title ?></h6>
          </div>
          <div class="card-body bg-white">

            <?php if (!$request_no) : ?>
              <div class="col-md-12">
                <span class="font-weight-bold text-info"><i class="fas fa-info-circle"></i> Filter Data First !</span>
                <br><br>
              </div>
            <?php endif; ?>

            <div class="overflow-auto">
              <table class="table table-hover text-center" id="tableASDF" style="width:100%">
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th></th>
                    <th>Submission ID.</th>
                    <th>Workpack No.</th>
                    <th>Irn No.</th>
                    <th>Request No.</th>
                    <th>Drawing<br />Number</th>
                    <th>Piecemark<br />No.</th>
                    <th>Paint <br>System</th>
                    <th>Activity</th>
                    <!-- <th style='text-align:center;'>MRIR Attachment</th> -->
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="col-md">
      <div class="text-right <?= $class ?>">

        <button type="button" onclick="return_multiple_to_pmt(this)" class="btn btn-sm btn-info btn_action" disabled><i class="fas fa-undo"></i> Return Selected to PMT <span class="badge badge-light text_total">0</span></button>

        <button type="submit" class="btn btn-sm btn-primary btn_action" name="status" value="0" disabled><i class="fas fa-paper-plane"></i> Transmit Data <span class="badge badge-light text_total">0</span></button>
      </div>
    </div>
  </form>

</div>
</div>
<script type="text/javascript">
  $(document).ready(function() {

    $("#form_bnp").on('submit', function() {
      $('button[type=submit]').attr('disabled', true)
    })


    var request_no = "<?= $request_no ?>"
    var status_dt = request_no ? false : true

    $("#tableASDF").DataTable({
      processing: true,
      serverSide: true,
      bFilter: status_dt,
      lengthChange: status_dt,
      paging: status_dt,
      ordering: status_dt,

      ajax: {
        url: "<?= base_url('planning_bnp/serverside_qc_list') ?>",
        type: "POST",
        data: {
          id_paint_system: "<?= $id_paint_system ?>",
          id_activity: "<?= $id_activity ?>",
          request_no: "<?= $request_no ?>",
          class: "<?= $class ?>"
        }
      }
    })
  })

  var angka = "<?= COUNT($irn_tag) ?>"
  console.log(angka)

  function add_row_rfi() {
    var table;
    table = "<tr>" +
      "<td><button type='button' class='btn btn-danger btn-sm' onclick='delete_row_rfi_detail(this)'><i class='fas fa-trash-alt'></i></button></td>" +
      "<td>"+
      "<textarea class='form-control' required name='tag_no[" + angka + "]'></textarea>" +
      "<input type='hidden' name='id_detail[]'></td>" +
      "<td>"+
      "<textarea class='form-control' required name='tag_description[" + angka + "]'></textarea>" +
      "</td>" +
      "<tr>";
    angka++
    $("#tbl_rfi_detail tbody").append(table);
    $(".select2").select2()

    $(".anu").attr("rowspan", angka+10)
  }

  function delete_row_rfi_detail(btn, ideh) {
    
    console.log(ideh)
    // if(ideh){
    //   $('.row_'+ideh).remove()
    // } else {
      $(btn).closest("tr").remove();
    // }
    
  }

  $("select[name=module]").chained("select[name=project]");

  $(document).ready(function() {
    $("select[name=activity]").chained("select[name=paint_system]");
    selectRefresh();
  });

  function selectRefresh() {
    $(".select2_multiple_activity").select2({
      allowClear: true,
      tokenSeparators: [', ', ' '],
    })
    $(".select2_multiple_paint_system").select2({
      allowClear: true,
      tokenSeparators: [', ', ' '],
    })
  }


  $('.dataTable').DataTable({
    order: [],
    columnDefs: [{
      "targets": 0,
      "orderable": false,
    }]
  })

  var data_checkbox = [];

  function save_checkbox(input) {
    console.log(data_checkbox);
    if ($(input).prop("checked") == true && $.inArray($(input).val(), data_checkbox) == -1) {
      data_checkbox.push($(input).val());
    } else if ($(input).prop("checked") == false && $.inArray($(input).val(), data_checkbox) != -1) {
      data_checkbox.splice($.inArray($(input).val(), data_checkbox), 1);
    }
    $(".num_ticker").html(data_checkbox.length)
  }

  function checkall(input) {
    $('#form_create_workpack input[type=checkbox]').each(function(i, obj) {
      if ($(input).prop("checked") == true && $(obj).prop("checked") == false) {
        $(obj).trigger("click");
        console.log("all" + $(obj).val());
      } else if ($(input).prop("checked") == false && $(obj).prop("checked") == true) {
        $(obj).trigger("click");
      }
    });
  }

  function create_workpack() {
    if (data_checkbox.length > 0) {
      sweetalert("loading", "Please wait...!");
      $("#form_create_workpack input[name=template_id]").val(data_checkbox.join(", "));
      document.getElementById("form_create_workpack").submit();
    } else {
      sweetalert("error", "No item selected!");
    }
  }

  $(".autocomplete_irn_approved").autocomplete({
    source: function(request, response) {
      var project_id = $("#project_id option:selected").val();
      var drawing_type = 3;
      $.ajax({
        url: "<?php echo base_url() ?>planning/autocomplete_irn_approved",
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
    // select: function (event, ui) {
    //   var value = ui.item.value;
    //   if(value == 'No Data.'){
    //     ui.item.value = "";
    //   }
    //   else{
    //     get_data_drawing(ui.item.value);
    //   }
    // }
  });

  function return_data(btn, id_detail) {
    Swal.fire({
      type: "warning",
      title: "RETURN DATA",
      text: "Are You Sure to Return this Data to PMT List ?",
      showCancelButton: true
    }).then((res) => {
      if (res.value) {

        $.ajax({
          url: "<?= site_url('planning_bnp/return_to_pmt_list') ?>",
          type: "POST",
          data: {
            id_detail: id_detail
          },
          dataType: "JSON",
          success: function(data) {
            if (data.success) {
              Swal.fire({
                type: "success",
                title: "Success",
                text: "Data Has Been Returned to PMT List",
                timer: 1000
              })

              setTimeout(() => {
                location.reload()
              }, 1000);
            }
          }
        })

      }
    })
  }

  // FUNCTION RETURN MULTIPLE DATA TO PMT LIST

  var checked_id = []

  $("#tableASDF").on('click', '.check', function() {
    if (this.checked) {
      checked_id.push(this.value)
    } else {
      checked_id.splice($.inArray(this.value, checked_id), 1)
    }

    if (checked_id.length > 0) {
      $(".btn_action").removeAttr('disabled')
    } else {
      $(".btn_action").attr('disabled', true)
    }

    $('.text_total').text(checked_id.length)

  })

  function return_multiple_to_pmt(btn) {
    Swal.fire({
      type: "warning",
      title: "RETURN SELECTED DATA",
      text: "Are You Sure to Return Selected Data to PMT List ?",
      showCancelButton: true
    }).then((res) => {
      if (res.value) {

        $.ajax({
          url: "<?= site_url('planning_bnp/return_to_pmt_list_multiple') ?>",
          type: "POST",
          data: {
            checked_id: checked_id
          },
          dataType: "JSON",
          success: function(data) {
            if (data.success) {
              Swal.fire({
                type: "success",
                title: "Success",
                text: "Data Has Been Returned to PMT List",
                timer: 1000
              })

              setTimeout(() => {
                location.reload()
              }, 1000);
            }
          }
        })

      }
    })
  }
</script>