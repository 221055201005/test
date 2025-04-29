<style>
  th, td {
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
                      <?php $request_no_lis = array_unique(array_column($list, 'request_no')); ?>
                      <?php foreach ($request_no_lis as $key => $value){ if($value!=''){ ?>
                        <option value="<?= $value ?>" <?= $request_no==$value ? 'selected' : '' ?> data-chained="<?php echo $value ?>"><?= $value ?></option>
                      <?php }} ?>
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
                        <option value="<?= $value['id'] ?>" <?= $id_paint_system==$value['id'] ? 'selected' : '' ?>><?= $value['name'] ?></option>
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
                        <option value="<?= $value['id_activity'] ?>" <?= $id_activity==$value['id_activity'] ? 'selected' : '' ?> data-chained="<?php echo $value['id_paint_system'] ?>"><?= $value['description_of_activity'] ?></option>
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
                        <?php foreach ($area_v2 as $value_area) {?>
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
                        <?php foreach ($location_v2 as $value_location) {?>
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

                <div class="col-md-12"><hr></div>

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
                <table id="tbl_rfi_detail" class="table table-hover text-center">
                  <thead class="bg-info text-white">
                    <tr>
                      <th>Item / Tag Number</th>
                      <th>Item / Tag Description</th>
                      <th>Expected Time</th>
                      <th>ITP Intervention to Employer</th>
                      <th>Inspection Execution Result</th>
                      <?php if ($this->user_cookie[7] != 8) { ?>
                        <th><button type='button' class="btn btn-sm btn-primary" onclick="add_row_rfi()"><i class="fas fa-plus"></i></button></th>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($irn_tag as $key => $value) : ?>
                      <tr>
                        <td>
                          <input type='text' class='form-control' required name='tag_no[<?= $key ?>]' value='<?php echo $value["item_tag_no"] ?>'>
                          <input type="hidden" name="id_detail[<?= $key ?>]" value="<?php echo $value["id"] ?>">
                        </td>
                        <td>
                          <input type='text' class='form-control' required name='tag_description[<?= $key ?>]' value='<?php echo $value["item_tag_description"] ?>'>
                        </td>
                        <td>
                          <input type='text' class='form-control' required name='expected_time[<?= $key ?>]' value=''>
                        </td>
                        <td>
                          <select name="itp[<?= $key ?>][]" class="form-control select2" style="width:100%" required multiple="">
                            <option value="1">Hold Point</option>
                            <option value="2">Witness</option>
                            <option value="3">Monitoring</option>
                            <option value="4">Review</option>
                          </select>
                        </td>
                        <td>
                          <input type='text' class='form-control' required name='result[<?= $key ?>]' value=''>
                        </td>
                        <?php if ($this->user_cookie[7] != 8) { ?>
                          <td>
                            <button type='button' class='btn btn-danger' onclick='delete_row_rfi_detail(this, "<?php echo $value["id"] ?>")'>
                              <i class='fas fa-trash-alt'></i>
                            </button>
                          </td>
                        <?php } ?>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
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

            <div class="col-md-12">
              <span class="font-weight-bold text-info"><i class="fas fa-info-circle"></i> Filter Data First !</span>
              <br><br>
            </div>

            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th></th>
                    <th>Submission ID.</th>
                    <th>Workpack No.</th>
                    <th>Irn No.</th>
                    <th>Request No.</th>
                    <th>Drawing<br />Number</th>
                    <th>Piecemark<br />No.</th>

                    <!-- <th>Tag<br />Number</th> -->
                    <!-- <th>Drawing Assembly</th> -->

                    <th>Paint <br>System</th>
                    <th>Activity</th>

                    <th style='text-align:center;'>MRIR Attachment</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($list as $key => $value) : ?>
                  <?php 

                    $id_ps_det        = $value['id_detail_wp_paint_system'];
                    $unique_no        = $mis[$mv[$wp_ps[$id_ps_det]['id_template']]['id_mis']]['unique_no'];

                    $project_id               = strtr($this->encryption->encrypt($mv[$wp_ps[$id_ps_det]['id_template']]['project_code']), '+=/', '.-~');
                    $discipline               = strtr($this->encryption->encrypt($mv[$wp_ps[$id_ps_det]['id_template']]['discipline']), '+=/', '.-~');
                    $type_of_module           = strtr($this->encryption->encrypt($mv[$wp_ps[$id_ps_det]['id_template']]['type_of_module']), '+=/', '.-~');
                    $module                   = strtr($this->encryption->encrypt($mv[$wp_ps[$id_ps_det]['id_template']]['module']), '+=/', '.-~');
                    $report_no                = strtr($this->encryption->encrypt($mv[$wp_ps[$id_ps_det]['id_template']]['report_number']), '+=/', '.-~');
                    $report_no_rev            = strtr($this->encryption->encrypt($mv[$wp_ps[$id_ps_det]['id_template']]['report_no_rev']), '+=/', '.-~');
                    $submission_id            = strtr($this->encryption->encrypt($mv[$wp_ps[$id_ps_det]['id_template']]['submission_id']), '+=/', '.-~');

                    $data_workpack            = $workpack_list[$wp_ps[$id_ps_det]['id_workpack']];

                    $id_workpack_enc          = strtr($this->encryption->encrypt($data_workpack['id']), '+=/', '.-~');
                    $link_pdf_workpack        = site_url('planning/workpack_pdf_bnp/' . $id_workpack_enc);

                    $link_irn                 = "#";
                    $encrypt_irn_submission   = strtr($this->encryption->encrypt($irn_list[$data_workpack['irn_report_no']]['submission_id']), '+=/', '.-~');

                    if ($data_workpack['categories_irn'] == 1) {
                      $link_irn               = site_url('irn/show_irn_detail_material/' . $encrypt_irn_submission);
                    } else {
                      $link_irn               = site_url('irn/show_irn_detail/' . $encrypt_irn_submission);
                    }


                    if (isset($mv[$wp_ps[$id_ps_det]['id_template']]['status_inspection'])) {
                      if ($mv[$wp_ps[$id_ps_det]['id_template']]['status_inspection'] >= 3) {
                        if (isset($mv[$wp_ps[$id_ps_det]['id_template']]['report_number'])) {
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

                    if($unique_no){ 
                      if(isset($list_unique_data[$unique_no])){
                          $list_of_attachment = array(); 
                          foreach($list_unique_data[$unique_no] as $key => $vx){ 
                          $list_of_attachment[] = "<a target='_blank' href='https://www.smoebatam.com/warehouse_ori/file/mrir/cm/".$vx["document_file"]."'  style='display: inline-block !important;'>".$vx["document_name"]."</a>";
                          }
                          $show_attachment = implode("<br/><br/>",$list_of_attachment);
                      } else {
                          $show_attachment = "-";
                      }
                  } else {
                  $show_attachment = "-";
                  } 

                    
                    ?>
                    <tr>
                      <td>
                        <input type="checkbox" name="id[]" class="form-control <?= $class ?>" value="<?= $value['id_bnp'] ?>">
                      </td>
                      <td><?= $value['submission_id'] ?></td>
                      <td><a href="<?= $link_pdf_workpack ?>" target="_blank"><strong><i><?= $data_workpack['workpack_no'] ?></i></strong></a></td>

                      <td><a href="<?= $link_irn ?>" target="_blank"><strong><i>SOF-OCP-SMO-TS-STR-RFI-IRN-B&P-<?= $data_workpack['irn_report_no'] ?></i></strong></a></td>
                      <td><?= $value['request_no'] ?></td>

                      <td><?= $piecemark[$wp_ps[$id_ps_det]['id_template']]['drawing_ga'] ?></td>
                      <td><?= $piecemark[$wp_ps[$id_ps_det]['id_template']]['part_id'] ?></td>
                      <!-- <td><?= $piecemark[$wp_ps[$id_ps_det]['id_template']]['can_number'] ? $piecemark[$wp_ps[$id_ps_det]['id_template']]['can_number'] : '-' ?></td> -->
                      <!-- <td><?= $piecemark[$wp_ps[$id_ps_det]['id_template']]['drawing_as'] ?></td> -->

                      <td><?= $arr_paint_system[$value['id_paint_system']] ?></td>
                      <td><?= $arr_activity[$value['id_activity']] ?></td>

                      <td><strong><i><?= $show_attachment ?></i></strong></td>
                      <td>
                        <button type="button" onclick="return_data(this, <?= $value['id_detail_wp_paint_system'] ?>)" class="btn btn-info"><i class="fas fa-undo"></i> Return to PMT</button>
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

    <div class="col-md">
      <div class="text-right <?= $class ?>">
        <?php if ($workpack_detail[0]["status_approval"] == 0) { ?>
          <button type="submit" class="btn btn-sm btn-primary" name="status" value="0"><i class="fas fa-paper-plane"></i> Transmitt</button>
        <?php } ?>
      </div>
    </div>
  </form>

</div>
</div>
<script>

  var angka = "<?= COUNT($irn_tag) ?>"
  console.log(angka)
  function add_row_rfi() {
    var table;
    table = "<tr>" +
      "<td><input type='text' class='form-control' required name='tag_no["+angka+"]'><input type='hidden' name='id_detail[]'></td>" +
      "<td><input type='text' class='form-control' required name='tag_description["+angka+"]'></td>" +
      "<td><input type='text' class='form-control' required name='expected_time["+angka+"]'></td>" +
      // "<td><input type='text' class='form-control' required name='itp[]'></td>" +
      "<td><select name='itp["+angka+"][]' class='form-control select2' style='width:100%' required multiple='>"+
      "<option value='1'>Hold Point</option>"+
      "<option value='1'>Hold Point</option>"+
      "<option value='2'>Witness</option>"+
      "<option value='3'>Monitoring</option>"+
      "<option value='4'>Review</option>"+
      "</select></td>"+
      "<td><input type='text' class='form-control' required name='result["+angka+"]'></td>" +
      "<td><button type='button' class='btn btn-danger' onclick='delete_row_rfi_detail(this)'><i class='fas fa-trash-alt'></i></button></td>" +
      "<tr>";
    angka++
    $("#tbl_rfi_detail tbody").append(table);
    $(".select2").select2()
  }

  function delete_row_rfi_detail(btn) {
    $(btn).closest("tr").remove();
  }

  $("select[name=module]").chained("select[name=project]");

  $(document).ready(function() {
    $("#form_bnp").on('submit', function() {
      $('button[type=submit]').attr('disabled', true)
    })
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
      type : "warning",
      title : "RETURN DATA",
      text : "Are You Sure to Return this Data to PMT List ?",
      showCancelButton : true
    }).then((res) => {
      if(res.value) {
 
        $.ajax({
          url : "<?= site_url('planning_bnp/return_to_pmt_list') ?>",
          type : "POST",
          data : {
            id_detail : id_detail
          },
          dataType : "JSON",
          success : function(data) {
            if(data.success) {
              Swal.fire({
                type : "success",
                title : "Success",
                text : "Data Has Been Returned to PMT List",
                timer : 1000
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