<style>
  th,
  td {
    vertical-align: middle !important;
  }

  .nav-link {
    color: #000;
  }

  .nav-pills .nav-link.active,
  .nav-pills .show>.nav-link {
    color: #007bff;
    background: #fff;
    border-bottom: 2px solid #007bff;
    border-radius: 0px;
  }
</style>

<div id="content" class="container-fluid">

  <form id="form_create_workpack" method="POST" action="<?php echo base_url() ?>planning/update_process_workpack_bnp">
    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0"><?php echo $meta_title ?></h6>
          </div>
          <div class="card-body bg-white">
            <input type="hidden" name="irn_report_no" value="<?php echo $irn_report_number ?>">
            <input type="hidden" name="template_id">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted"> Workpack No.</label>
                  <div class="col-xl">
                    <input type="text" value="<?= $wp_list[0]['workpack_no'] ?>" class="form-control" readonly>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted"> IRN No.</label>
                  <div class="col-xl">
                    <input type="text" value="SOF-OCP-SMO-TS-STR-RFI-IRN-B&P-<?= $wp_list[0]['irn_report_no'] ?>" class="form-control" readonly>
                  </div>
                </div>
              </div>

            </div>
            <hr>

            <div class="row">
              <div class="col-md-12">
                <ul class="nav nav-pills border-bottom border-gray" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detail List</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Attachment</a>
                  </li>

                </ul>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row mt-3">
                      <div class="col-md-12">
                        <div class="table-responsive overflow-auto">
                          <table class="table table-hover text-center dataTable" style="width:100%">
                            <thead class="bg-green-smoe text-white">
                              <tr>
                                <th rowspan='2'>Drawing<br />Number</th>
                                <th rowspan='2'>Tag<br />Number</th>
                                <th rowspan='2'>Drawing Assembly</th>
                                <th colspan='8' style='text-align:center;'>Material Traceability</th>
                                <th rowspan='2' style='text-align:center;'>MRIR Attachment</th>
                              </tr>
                              <tr>
                                <th>Piecemark<br />No.</th>
                                <th>Unique<br />No.</th>
                                <th>Profile</th>
                                <th>Size / Dia</th>
                                <th>Length</th>
                                <th>Area<br />m2</th>
                                <th>THK</th>
                                <th>Material<br />Status</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($list as $key => $value): ?>
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
                                 <td><?= $piecemark[$wp_ps[$id_ps_det]['id_template']]['drawing_ga'] ?></td>
                                 <td><?= $piecemark[$wp_ps[$id_ps_det]['id_template']]['can_number'] ? $piecemark[$wp_ps[$id_ps_det]['id_template']]['can_number'] : '-' ?></td>
                                 <td><?= $piecemark[$wp_ps[$id_ps_det]['id_template']]['drawing_as'] ?></td>
                                 <td><?= $piecemark[$wp_ps[$id_ps_det]['id_template']]['part_id'] ?></td>
                                 <td><?= $unique_no ?></td>
                                 <td><?= $piecemark[$wp_ps[$id_ps_det]['id_template']]['profile'] ?></td>
                                 <td><?= $piecemark[$wp_ps[$id_ps_det]['id_template']]['diameter'] ?></td>
                                 <td><?= $piecemark[$wp_ps[$id_ps_det]['id_template']]['length'] ?></td>
                                 <td><?= $piecemark[$wp_ps[$id_ps_det]['id_template']]['area'] ?></td>
                                 <td><?= $piecemark[$wp_ps[$id_ps_det]['id_template']]['thickness'] ?></td>
                                 <td><strong><i><?= $status_inspection_p1 ?></i></strong></td>
                                 <td><?= $show_attachment ?></td>

                               </tr>
                               <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row mt-3">
                      <div class="col-md-12">
                        <div class="table-responsive overflow-auto">
                          <table class="table table-hover text-center table_attachment">
                            <thead class="bg-info text-white">
                              <th>No</th>
                              <th>Attachment Name</th>
                              <th>Uploaded By</th>
                              <th>Uploaded Date</th>
                            </thead>
                            <tbody>
                                <?php $no = 1;foreach ($attachment_list as $key => $value): ?> 
                                 <tr>
                                   <td><?= $no++ ?></td>
                                   <td><a target="_blank" href="https://www.smoebatam.com/pcms_v2_photo/fab_img/<?= $value['filename'] ?>"> <?= $value['filename'] ?></a></td>
                                   <td><?= $user[$value['upload_by']]['full_name'] ?></td>
                                   <td><?= $value['upload_datetime'] ?></td>
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
    </div>

    <div class="col-md">
      <div class="text-right d-none">
        <?php if ($workpack_detail[0]["status_approval"] == 0) { ?>
          <a href="<?php echo base_url() ?>planning/workpack_approval_process_bnp/<?php echo strtr($this->encryption->encrypt($id_workpack), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-success" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Issued&nbsp;</b> this?', this, event)"><i class="fas fa-check"></i> Issued</a>
          <button type="submit" class="btn btn-sm btn-flat btn-warning" name="status" value="0"><i class="fas fa-edit"></i> Update</button>
        <?php } ?>
      </div>
    </div>

  </form>


</div>
</div>
<script>


  $("select[name=module]").chained("select[name=project]");

  $(document).ready(function() {
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


  $('.dataTable, .table_attachment').DataTable({
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
</script>