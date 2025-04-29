<?php
  $get = $this->input->get();
?>
<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="" method="GET">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">IRN No.</label>
                  <div class="col-xl">
                    <input type="text" class="form-control autocomplete_irn" name="irn_no" value="<?php echo @$get['irn_no'] ?>" required>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
                  <div class="col-xl">
                    <select class="form-control" name="project" id='project_id' required>
                       <?php if($this->permission_cookie[0] == 1){ ?>
                        <option value="">---</option>
                        <?php foreach ($project_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                        <?php endforeach; ?>
                      <?php } else { ?>
                        <?php foreach ($project_list as $key => $value) : ?>
                          <?php if($this->user_cookie[10] == $value['id']){ ?>
                            <option value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                          <?php } ?>
                        <?php endforeach; ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                  <div class="col-xl">
                    <select class="form-control" name="discipline" required>
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="module" required>
                      <option value="">---</option>
                      <?php foreach ($module_list as $key => $value) : ?>
                      <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$get['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type Of Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="type_of_module" required>
                      <option value="">---</option>
                      <?php foreach ($type_of_module_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Company</label>
                  <div class="col-xl">
                    <select class="form-control select2" name="company">
                      <option value="">---</option>
                      <?php foreach ($company_list as $key => $value) : ?>
                        <option value="<?php echo $value['id_company'] ?>" <?php echo (@$get['company'] == $value['id_company'] ? 'selected' : '') ?>><?php echo $value['company_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
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

  <?php if($this->input->get('submit')): ?>
    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Joint Fitup List on IRN No. <?= $get['irn_no'] ?></h6>
          </div>
          <div class="card-body bg-white overflow-auto">
            <div class="overflow-auto">
              <table id="table_fitup_list" class="table table-hover text-center dataTable">
                <thead class="bg-gray-table">
                  <tr>
                    <th><input type='checkbox' class='checkbox-big' name="check_all" onclick='checkall(this)'></th>
                    <th>Submission</th>
                    <th>Drawing No.</th>
                    <th>Drawing Wm.</th>
                    <th>Joint No.</th>
                    <th>Surveyor</th>
                    <th>Part ID</th>
                    <th>Unique ID Number</th>
                    <th>Heat Number</th>
                    <th>Grade</th>
                    <th>Dia/Size</th>
                    <th>Sch</th>
                    <th>Thk (mm)</th>
                    <th>Joint Class</th>
                    <th>Weld Length (mm)</th>
                    <th>Fiter Code</th>
                    <th>Tack Weld ID</th>
                    <th>WPS</th>
                    <th>Remarks</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($fitup_list as $key => $value): ?>
                    <?php
                      $pos_1 = $piecemark_list[$joint_list[$value["id_joint"]]['pos_1']];
                      $pos_2 = $piecemark_list[$joint_list[$value["id_joint"]]['pos_2']];

                      $enc_redline = strtr($this->encryption->encrypt($surveyor_list[$value['id_joint']]), '+=/', '.-~');
                      $enc_path   = strtr($this->encryption->encrypt('/PCMS/mobile/pcms_v2_mobile/pcms_v2_photo/'), '+=/', '.-~');
                      $link_image = site_url('irn/open_file/'.$enc_redline.'/'.$enc_path);
                    ?>
                    <tr>
                      <td><input type='checkbox' class='checkbox-big' value='<?= $value["id_fitup"] ?>' onclick='save_checkbox(this)'></td>
                      <td><?= $value["submission_id"] ?></td>
                      <td><?= $value["drawing_no"] ?></td>
                      <td><?= $joint_list[$value["id_joint"]]['drawing_wm'] ?></td>
                      <td><?= $joint_list[$value["id_joint"]]['joint_no'] ?></td>
                      <td>
                        <?php if(isset($surveyor_list[$value['id_joint']])): ?>
                          <a target="_blank" href="<?= $link_image ?>" class="btn btn-sm btn-primary"><i class="fas fa-images"></i></a><br>
                        <?php else: ?>
                          <img src="<?php echo base_url(); ?>/img/img_not_avai.png" style='width: 50px;'>
                        <?php endif; ?>
                        <span class="badge"><?= $user_list[$value["surveyor_creator"]] ?></span><br>
                        <span class="badge"><?= $value["surveyor_created_date"] ?></span>
                      </td>
                      <td>
                        <span class="badge"><?= $joint_list[$value["id_joint"]]['pos_1'] ?></span>
                        <hr>
                        <span class="badge"><?= $joint_list[$value["id_joint"]]['pos_2'] ?></span>
                      </td>
                      <td>
                        <span class="badge badge-primary"><?= $warehouse_mis_mrir[$pos_1['id_mis']]['unique_ident_no'] ?></span>
                        <hr>
                        <span class="badge badge-primary"><?= $warehouse_mis_mrir[$pos_2['id_mis']]['unique_ident_no'] ?></span>
                      </td>
                      <td>
                        <span class="badge"><?= $warehouse_mis_mrir[$pos_1['id_mis']]['heat_or_series_no'] ?></span>
                        <hr>
                        <span class="badge"><?= $warehouse_mis_mrir[$pos_2['id_mis']]['heat_or_series_no'] ?></span>
                      </td>
                      <td>
                        <span class="badge"><?= $material_grade_list[$pos_1['grade']]['material_grade'] ?></span>
                        <hr>
                        <span class="badge"><?= $material_grade_list[$pos_2['grade']]['material_grade'] ?></span>
                      </td>
                      <td>
                        <span class="badge"><?= $pos_1['diameter'] ?></span>
                        <hr>
                        <span class="badge"><?= $pos_2['diameter'] ?></span>
                      </td>
                      <td>
                        <span class="badge"><?= $pos_1['sch'] ?></span>
                        <hr>
                        <span class="badge"><?= $pos_2['sch'] ?></span>
                      </td>
                      <td>
                        <span class="badge"><?= $pos_1['thickness'] ?></span>
                        <hr>
                        <span class="badge"><?= $pos_2['thickness'] ?></span>
                      </td>
                      <td><?= $class_list[$joint_list[$value["id_joint"]]['class']]['class_code'] ?></td>
                      <td><?= $joint_list[$value["id_joint"]]['weld_length'] ?></td>
                      <td>
                        <?php
                          $fitter_id_display = explode(";", $value['fitter_id']);
                          foreach ($fitter_id_display as $key => $val_fitter) {
                            if(isset($fitter_code_list[$val_fitter])){
                              echo $fitter_code_list[$val_fitter]."<br/>";
                            }
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          $tack_weld_id_display = explode(";", $value['tack_weld_id']);
                          foreach ($tack_weld_id_display as $key => $val_tack_weld_id) {
                            if(isset($welder_code_list[$val_tack_weld_id])){
                              echo $welder_code_list[$val_tack_weld_id]."<br/>";
                            }
                          }
                        ?>
                      </td>
                      <td>
                        <?php
                          $wps_display = explode(";", $value['wps_no']); 
                          foreach ($wps_display as $key => $wps_id) { 
                            if(isset($wps_code_list[$wps_id])){ 
                              echo $wps_code_list[$wps_id]."<br/>"; 
                            } 
                          } 
                        ?>
                      </td>
                      <td><?= $value["remarks"] ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <br>
            <div class="row">
              <div class="col-md-12">
                <div class="font-weight-bold">
                  You tick <span class="text-success num_ticker">0</span> Joint to Approve.<br>
                </div>
                <form method="POST" action="<?php echo base_url() ?>irn/fitup_qc_approval_process" onsubmit="save_id_checked(this)">
                  <input type="hidden" name="id">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-form-label font-weight-bold">Inspector Name</label>
                        <input type="text" class="form-control" value="<?= $this->user_cookie[1] ?>" disabled>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-form-label font-weight-bold">Inspection Date</label>
                        <input type="text" class="form-control" value="<?= date("d F Y H:i:s"); ?>" disabled>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-form-label font-weight-bold">Inspection Remarks</label>
                        <textarea name="inspection_remarks" rows="3" class="form-control"></textarea>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <button type="submit" name="submit" value="approve" class="btn btn-success"><i class='fas fa-check'></i> Approve</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

</div>
</div>
<script>
  $("select[name=module]").chained("select[name=project]");
  const table_fitup_list = $('.dataTable').DataTable({
    "order" : [],
    "paging" : false,
  });
  
  let data_checkbox = [];
  function save_checkbox(input) {
    //console.log(data_checkbox);
    if($(input).prop("checked") == true && $.inArray($(input).val(), data_checkbox) == -1){
      data_checkbox.push($(input).val());
    }
    else if($(input).prop("checked") == false && $.inArray($(input).val(), data_checkbox) != -1){
      data_checkbox.splice( $.inArray($(input).val(), data_checkbox), 1 );
    }
    $(".num_ticker").html(data_checkbox.length)
  }

  function checkall(input) {
    $('#table_fitup_list tbody input[type=checkbox]').each(function(i, obj) {
      if($(input).prop("checked") == true && $(obj).prop("checked") == false){
        //console.log("all"+$(obj).val());
        $(obj).trigger("click");
      }
      else if($(input).prop("checked") == false && $(obj).prop("checked") == true){
        $(obj).trigger("click");
      }
    });
  }

  function save_id_checked(form) {
    table_fitup_list.search('').draw();
    $(form).find("input[name=id]").val(data_checkbox.join(", "));
  }

  $(".autocomplete_irn").autocomplete({
    delay: 500,
    source: function( request, response ) {
      $.ajax({
        url: "<?php echo base_url() ?>irn/autocomplete_irn_no",
        dataType: "json",
        data: {
          term: request.term,
          type: 'qc',
          project: $("select[name=project]").val(),
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    select: function (event, ui) {
      var value = ui.item.value;
      if(value == 'No Data.'){
        ui.item.value = "";
      }
      else{
        console.log(ui.item)
        $("select[name=project]").val(ui.item.data.project_id).change();
        $("select[name=discipline]").val(ui.item.data.discipline).change();
        $("select[name=module]").val(ui.item.data.module).change();
        $("select[name=type_of_module]").val(ui.item.data.type_of_module).change();
      }
    }
  });
</script>