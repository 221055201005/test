<?php
  $workpack = $workpack_list;
  $total_weight = 0;
  $num_piecemark = 0;
  foreach ($piecemark_list as $key => $value){
    $num_piecemark++;
    $total_weight += $value['weight'];
  }
?>

<script type="text/javascript">
var _formConfirm_submitted = false;
</script>

<div id="content" class="container-fluid">

  <form action="<?= site_url('planning/save_to_material') ?>" method="post" onsubmit="if( _formConfirm_submitted == false ){ _formConfirm_submitted = true;return true }else{ alert('Please Wait, Server still busy, wait till process done, Thanks!'); return false;  }" enctype="multipart/form-data" >

    <input type="hidden" name="module_save" value="<?= $workpack['module'] ?>">
    <input type="hidden" name="project_save" value="<?= $workpack['project'] ?>">
    <input type="hidden" name="discipline_save" value="<?= $workpack['discipline'] ?>">
    <input type="hidden" name="type_of_module_save" value="<?= $workpack['type_of_module'] ?>">

    <input type="hidden" class="form-control" name="wp_id" value="<?php echo @$workpack['id'] ?>">

    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0"><?php echo $meta_title ?></h6>
          </div>
          <div class="card-body bg-white overflow-auto">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Workpack No.</label>
                  <div class="col-md">
                    <input type="text" class="form-control" name="workpack_no" value="<?php echo @$workpack['workpack_no'] ?>" readonly>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Drawing No.</label>
                  <div class="col-md">
                    <input type="text" class="form-control" name="drawing_no" value="<?php echo @$workpack['drawing_no'] ?>" readonly>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Module</label>
                  <div class="col-md">
                    <select class="form-control" name="module" disabled>
                      <option value="">---</option>
                      <?php foreach ($module_list as $key => $value) : ?>
                      <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$workpack['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type Of Module</label>
                  <div class="col-md">
                    <select class="form-control" name="type_of_module" disabled>
                      <option value="">---</option>
                      <?php foreach ($type_of_module_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$workpack['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Deck Elevation / Service Line</label>
                  <div class="col-md">
                    <select class="form-control" name="deck_elevation" disabled>
                      <option value="">---</option>
                      <?php foreach ($deck_elevation_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$workpack['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                  <div class="col-md">
                    <select class="form-control" name="discipline" disabled>
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$workpack['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Phase</label>
                  <div class="col-md">
                    <select class="form-control" name="phase" disabled>
                      <option value="PF" <?php echo (@$workpack['phase'] == "PF" ? 'selected' : '') ?>>Pre-Fabrication</option>
                      <option value="FB" <?php echo (@$workpack['phase'] == "FB" ? 'selected' : '') ?>>Fabrication</option>
                      <option value="AS" <?php echo (@$workpack['phase'] == "AS" ? 'selected' : '') ?>>Assembly</option>
                      <option value="ER" <?php echo (@$workpack['phase'] == "ER" ? 'selected' : '') ?>>Erection</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Description Assy Code</label>
                  <div class="col-md-8 col-lg-9">
                    <select class="form-control select2" name="desc_assy" disabled>
                      <option value="">---</option>
                      <?php foreach ($desc_assy_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$workpack['desc_assy'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Description</label>
                  <div class="col-md">
                    <input type="text" class="form-control" name="description" value="<?php echo @$workpack['description'] ?>" disabled>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Job No.</label>
                  <div class="col-md">
                    <input type="text" class="form-control" name="job_no" value="<?php echo @$workpack['job_no'] ?>" disabled>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Company</label>
                  <div class="col-md">
                    <input type="text" class="form-control" name="company_id" value="<?php echo @$company_name[$workpack['company_id']] ?>" disabled>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row"> 
                  <div class="col-md"> 
                  </div>
                </div>
              </div>
            </div>
            
            <?php
              $job_description = explode(";", $workpack['job_description']);
            ?>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Job Description</label>
                </div>
              </div>
              <?php foreach ($job_description_list as $key => $value): ?>
              <div class="col-md-3">
                <label class="">
                  <input type="checkbox" class="checkbox-big" name="job_description[]" value="<?php echo $value ?>" <?php echo (in_array($value, $job_description) ? "checked" : "") ?> disabled> 
                  <span class="position-absolute ml-2 font-weight-bold text-dark"> <?php echo $value ?></span>
                </label>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
        <div class="col">
          <div class="card shadow my-3 rounded-0">
            <div class="card-header">
              <h6 class="m-0"><?php echo $meta_title ?> - Material Verification</h6>
            </div>
            <div class="card-body bg-white">
              <div class="overflow-auto">  

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Surveyor Name</label>
                      <div class="col-md">
                          <input type='text' name='full_name' class='form-control' value='<?= $this->user_cookie[1]; ?>' readonly>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Company Assigned</label>
                      <div class="col-md">
                          <input type='text' name='company' class='form-control' value='<?= $company_name[$piecemark_list[0]['company_id']] ?>' readonly>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Area</label>
                      <div class="col-md-8 col-lg-9">
                      <select class="select2 will_enable" name="area" required>
                        <option value="">---</option>
                        <?php foreach ($area as $value_area) {?>
                          <option value="<?= $value_area['id'] ?>"><?= $value_area['name'] ?></option>
                        <?php } ?>
                      </select>                        
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Date</label>
                      <div class="col-md">
                          <input type='text' name='dateview' class='form-control' value='<?= date("Y-m-d"); ?>' readonly>
                      </div>
                    </div>
                  </div>
                  
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Location</label>
                      <div class="col-md-8 col-lg-9">
                      <select class="select2 will_enable" name="location" required>
                        <option value="">---</option>
                        <?php foreach ($location as $value_location) {?>
                          <option value="<?= $value_location['id'] ?>" data-chained="<?php echo $value_location['id_area'] ?>"><?= $value_location['name'] ?></option>
                        <?php } ?>
                      </select>                   
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                    
                    </div>
                  </div>
                  
                </div>

              </div>
            </div>   
          </div>
        </div>
      </div>
    
    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0"><?php echo $meta_title ?></h6>
          </div>
          <div class="card-body bg-white">
            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable" id='table_submission'>
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th>#</th>
                    <th>Drawing GA</th>
                    <th>Drawing AS</th>
                    <th>Rev AS</th>
                    <th>Piecemark</th>
                    <th>Unique Material Id</th>
                    <th>Heat No</th>
                    <th>Material</th>
                    <th>Profile</th>
                    <th>Grade</th>
                    <th>Thickness</th>
                    <th>Weight (kg)</th>
                    <th>Evidence Of Progress</th> 
                    <th>Progress On (%)</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no_submitted = 0; foreach ($piecemark_list as $key => $value):  if(!isset($value['id_piecemark'])){ $no_submitted++; }  if($value['report_resubmit_status'] == 0 OR !isset($value['report_resubmit_status'])){ ?>
                  <tr>
                    <td>
                        <?php if($value["progress_mv"] >= 75){ ?>

                          <?php if (!isset($value['id_piecemark'])): ?>

                          <input type="hidden" name="id_mis[<?= $key ?>]" class="id_mis">
                          <input type="hidden" name="id_mis_material[<?= $key ?>]" value="<?= $value['id_mis'] ?>">
                       
                          <input type="hidden" name="drawing_no[<?= $key ?>]" value="<?= $value['drawing_ga'] ?>">                        

                          <input type="hidden" name="id_material[<?= $key ?>]" value="<?= $value['id_material'] ?>">
                          <input type="hidden" name="status_inspection[<?= $key ?>]" value="<?= $value['status_inspection'] ?>">
                          <input type="hidden" name="id_wp_save[<?= $key ?>]" value="<?= $value['id_wp_main'] ?>">
                          <input type="checkbox" class="checkbox-big check" name="id[<?= $key ?>]" value="<?= $value['id_pc_temp'] ?>"
                            style="zoom : 1.5;">
                            
                          <?php else: ?>
                          <i class="fas fa-check"></i>
                          <?php endif; ?>

                        <?php } else { ?>

                          <span class='btn btn-danger'><i class="fas fa-times-circle"></i></span>
                          
                        <?php } ?>
                    </td>
                    <td><?php echo @$value['drawing_ga'] ?></td>
                    <td><?php echo @$value['drawing_as'] ?></td>
                    <td><?php echo $value['rev_as'] ?></td>
                    <td>
                        <?php if(strlen($value['evidence_mv'])>1){ ?>
                          <a href="<?= $this->link_server  ?>/pcms_v2_photo/<?= $value['evidence_mv'] ?>"><?= $value['part_id'] ?></a>
                        <?php } else { ?>
                          <?= $value['part_id'] ?>
                        <?php } ?>
                    </td>
                    <td>   
                    <?php if($value["progress_mv"] >= 75){ ?>                  
                      <input type="text" name="unique_no[<?= $key ?>]" class="form-control editable" onfocus="autocomplete_unique(this, '<?= $value['workpack_no'] ?>', <?= $value['grade'] ?>, <?= $workpack['id'] ?>)" placeholder="Unique Number" value="<?= isset($mis_detail[$value['id_mis']]) ? $mis_detail[$value['id_mis']]['unique_no'] : '' ?>" onblur="validate_unique_no(this, '<?= $value['workpack_no'] ?>', <?= $value['grade'] ?>, <?= $workpack['id'] ?>)" onkeydown="validate_unique_no(this, '<?= $value['workpack_no'] ?>', <?= $value['grade'] ?>, <?= $workpack['id'] ?>)" onmousedown="validate_unique_no(this, '<?= $value['workpack_no'] ?>', <?= $value['grade'] ?>, <?= $workpack['id'] ?>)" required disabled>
                      <div class="invalid-feedback"></div>
                    <?php } else { ?>  
                      <span class='btn btn-danger'><i class="fas fa-times-circle"></i> Waiting Actual Progress Minimum 75%</span>
                    <?php } ?>  
                    </td>
                    <td><input type="text" class="form-control heat_no" placeholder="Heat Number"
                        value="<?= isset($mis_detail[$value['id_mis']]) ? $mis_detail[$value['id_mis']]['heat_or_series_no'] : '-' ?>"
                        disabled></td>
                    <td><?php echo $value["material"] ?></td>
                    <td><?php echo $value["profile"] ?></td>
                    <td><?php echo @$material_grade_list[$value["grade"]]['material_grade'] ?></td>
                    <td><?php echo $value["thickness"] ?></td>
                    <td><?php echo round($value["weight"],2); ?></td>                   
                    <td>
                        <input type="file" disabled name="attachment_surveyor_mv[<?php echo $key; ?>]" required class='editable'>
                    </td>                   
                    <td>
                      <?php if($value["progress_mv"] < 75){ ?>
                        <?php if($value['phase'] == 'PF'){ ?>
                        <select name='progress_on_percentage' onchange='update_percent_detail(this,<?php echo $value["id_wp_main"]; ?>,<?php echo $value["id_pc_temp"]; ?>,"progress_mv","<?php echo $workpack['phase']; ?>");'>
                          <option value='0' <?php if($value["progress_mv"] == 0 OR !isset($value["progress_mv"])){ echo "selected"; } ?>>0%</option>
                          <option value='25' <?php if($value["progress_mv"] == 25){   echo "selected"; } ?>>25%</option>
                          <option value='50' <?php if($value["progress_mv"] == 50){   echo "selected"; } ?>>50%</option>
                          <option value='75' <?php if($value["progress_mv"] == 75){   echo "selected"; } ?>>75%</option>
                          <option value='100' <?php if($value["progress_mv"] == 100){ echo "selected"; } ?>>100%</option>
                        </select>
                        <?php }  ?>
                      <?php } else { ?>
                        <span class="btn btn-success">Completed</span>
                      <?php } ?>  
                    </td>                   
                  </tr>
                  <?php } endforeach; ?>
                </tbody>
              </table>
            </div>  
            
            <br>
            <br>
            <div class="text-right">
              <?php if($no_submitted > 0){ ?>
              <button type="submit" id="btn_submit" class="btn btn-success" disabled><i class="fas fa-check"></i>
                      Submit</button>
              <?php } ?>
            </div>
                  
          </div>
        </div>
      </div>
    </div>

  </form>

</div>
</div>
<script>
var checked = []
  $("#table_submission").on('click', '.check', function() {
    var editable = $(this).closest('tr').find('.editable')
    var value = $(this).val()
    if (this.checked) {
      editable.removeAttr('disabled')
      checked.push(value)
    } else {
      editable.removeClass('is-valid is-invalid');
      editable.attr('disabled', true)
      checked.splice($.inArray(value, checked), 1)
    }

    if (checked.length > 0) {
      if (checked.length > 30) {
        this.checked = false
        editable.attr('disabled', true)
        checked.splice($.inArray(value, checked), 1)

        Swal.fire({
          type: "warning",
          title: "Warning",
          text: "Only 30 Data Allowed In Each Submission"
        })

      } else {
        $("#btn_submit").removeAttr('disabled')
      }
    } else {
      $("#btn_submit").attr('disabled', true)
    }
  })


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
      grade : grade
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


function autocomplete_unique(input, workpack_no, grade, id_workpack){
  $(input).autocomplete({
    source: "<?php echo base_url(); ?>material_verification/autocomplete_unique_no/"+workpack_no+"/"+grade + '/' + id_workpack,
    autoFocus: true,
    classes: {
      "ui-autocomplete": "highlight"
    }
  });
}

  $("select[name=module]").chained("select[name=project]");

  $('.dataTable').DataTable({
     lengthMenu: [ [10, 25, 50, 100, 200, 500, -1], [10, 25, 50, 100, 200, 500, "All"] ],
    pageLength: 200,
    order: [],
    columnDefs: [{
      "targets": 0,
      "orderable": false,
    }]
  })

  $(".autocomplete_ga, .autocomplete_as").autocomplete({
    source: function( request, response ) {
      var drawing_type;
      if($(this.element).hasClass("autocomplete_ga") || $(this.element).hasClass("autocomplete_as")){
        drawing_type = 1;//ga or as
      }
      $.ajax( {
        url: "<?php echo base_url() ?>engineering/autocomplete_drawing/1",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: drawing_type,
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
        get_data_drawing(ui.item.value);
      }
    }
  });

  function get_data_drawing(document_no) {
    var module = $("select[name=module]").val();
    console.log(document_no);
    console.log(module);
    $.ajax( {
      url: "<?php echo base_url() ?>engineering/get_data_drawing",
      dataType: "json",
      data: {
        document_no: document_no,
        module: module,
      },
      success: function(data) {
        console.log(data);
        if(data.drawing_type == 1 || data.drawing_type == 2){
          $("select[name=project]").val(data.project).trigger('change');
          $("select[name=discipline]").val(data.discipline);
          if(module == ""){
            $("select[name=module]").val(data.module);
          }
        }
      }
    });
  }

  function add_manhours() {
    var html = "<tr>"+
                  "<td><input type='text' class='form-control text-center' name='manhours_name[]' required></td>"+
                  "<td><input type='number' class='form-control text-center' value='0' name='manhours_manpower[]' oninput='calc_manhours(this)' required></td>"+
                  "<td><input type='number' class='form-control text-center' value='0' name='manhours_day[]' oninput='calc_manhours(this)' required></td>"+
                  "<td><input type='number' class='form-control text-center' value='0' name='manhours_manhours[]' oninput='calc_manhours(this)' required></td>"+
                  "<td><span name='total'>0</span></td>"+
                  "<td><button class='btn btn-sm btn-flat btn-danger' type='button' onclick='delete_manhours(this)'><i class='fas fa-times'></i></td>"+
                "</tr>";
    $("#tbl_manhours").append(html);
  }

  function delete_manhours(btn) {
    $(btn).closest("tr").remove();
  }

  function delete_manhours_db(btn, id) {
    Swal.fire({
      title: 'Are you sure to <b class="text-danger">&nbsp;Delete&nbsp;</b> this?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Delete it!'
    }).then((result) => {
      if (result.value) {
        $.ajax( {
          url: "<?php echo base_url() ?>planning/budget_manhours_delete_process",
          data: {
            id: id,
          },
          type: 'post',
          success: function(data) {
            sweetalert("success", "Delete Data Success!");
            $(btn).closest("tr").remove();
          }
        });
      }
    })
  }

  function calc_manhours(input) {
    var manpower = $(input).closest("tr").find("input[type=number]:eq(0)").val();
    var days = $(input).closest("tr").find("input[type=number]:eq(1)").val();
    var manhours = $(input).closest("tr").find("input[type=number]:eq(2)").val();
    $(input).closest("tr").find("span[name=total]").text(manpower*days*manhours);
    var total_all = 0;
    $("span[name=total]").each(function(index) {
      total_all = total_all + parseInt($(this).text());
    })
    $("input[name=budget_manhours]").val(total_all);
  }


  function update_status_workpack(btn, id,text) {
    Swal.fire({
      title: 'Are you sure to <b class="text-danger">&nbsp;'+text+'&nbsp;</b> this?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, '+text+' it!'
    }).then((result) => {
      if (result.value) {
        $.ajax( {
          url: "<?php echo base_url() ?>planning/budget_manhours_delete_process",
          data: {
            id: id,
          },
          type: 'post',
          success: function(data) {
            sweetalert("success", "Delete Data Success!");
            $(btn).closest("tr").remove();
          }
        });
      }
    })
  }


  function update_percent_detail(input,wp_id, temp_id, progress, phase) {

    var percent_val = $(input).val();

    Swal.fire({
      title: 'Are you sure to <b class="text-danger">&nbsp;Update&nbsp;</b> this?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Update it!'
    }).then((result) => {
      if (result.value) {
        $.ajax( {
          url: "<?php echo base_url() ?>planning/save_update_to_percent",
          data: {
            wp_id: wp_id,
            temp_id: temp_id,
            percent_val: percent_val,
            progress: progress,
            phase: phase,
            pos_1: "N/A",
            pos_2: "N/A",
          },
          type: 'post',
          success: function(data) {
            sweetalert("success", "Update Data Success!");
            location.reload();
          }
        });
      }
    })

  }
</script>

<script type="text/javascript">
  $("select[name=location]").chained("select[name=area]");
</script>