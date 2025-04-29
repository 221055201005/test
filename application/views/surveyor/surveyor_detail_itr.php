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

  <form action="<?= site_url('planning/save_to_pcms_itr') ?>" method="post" onsubmit="if( _formConfirm_submitted == false ){ _formConfirm_submitted = true;return true }else{ alert('Please Wait, Server still busy, wait till process done, Thanks!'); return false;  }" enctype="multipart/form-data" >

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
                      <option value="ITR" <?php echo (@$workpack['phase'] == "ITR" ? 'selected' : '') ?>>Inspection & Test Record</option>
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
                  <input type="checkbox" class="checkbox-big" name="job_description[]" value="<?php echo $value['description'] ?>" <?php echo (in_array($value['description'], $job_description) ? "checked" : "") ?> disabled> 
                  <span class="position-absolute ml-2 font-weight-bold text-dark"> <?php echo $value['description'] ?></span>
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
              <h6 class="m-0"><?php echo $meta_title ?> - Inspection & Test Record</h6>
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
                      <select class="select2 will_enable" name="area" id='area' required>
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
                      <select class="select2 will_enable" name="location" id='location' required>
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
                    <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Percentage</label>
                      <div class="col-md-8 col-lg-9">
                        <select name='progress_on_percentage' id='percentage_data' class='form-control'>
                          <option value='0'>0%</option> 
                          <option value='100'>100%</option>
                        </select>
                      </div>
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
                    
                    <th>Consumable Lot No.</th>
                    <th style='width:100px !important;'>WPS</th>
                    <th style='width:100px !important;'>Welder ID</th>
                    <th>Evidence Of Progress</th> 
                    <th>Progress</th> 
                  </tr>
                </thead>
                <tbody>
                  <?php  $no_submitted = 0; foreach ($piecemark_list as $key => $value):  if(!isset($value['id_piecemark'])){ $no_submitted++; }  if($value['report_resubmit_status'] == 0 OR !isset($value['report_resubmit_status'])){ ?>
                  <tr>
                    <td> 
                      <?php if (!isset($value['id_piecemark'])): ?> 
                        <input type="hidden" name="id_mis[<?= $key ?>]" class="id_mis">
                        <input type="hidden" name="id_mis_material[<?= $key ?>]" value="<?= $value['id_mis'] ?>"> 
                        <input type="hidden" name="drawing_no[<?= $key ?>]" value="<?= $value['drawing_ga'] ?>">   
                        <input type="hidden" name="id_material[<?= $key ?>]" value="<?= $value['id_itr'] ?>"> 
                        <input type="hidden" name="status_inspection[<?= $key ?>]" value="<?= $value['status_inspection'] ?>">
                        <input type="hidden" name="id_wp_save[<?= $key ?>]" value="<?= $value['id_wp_main'] ?>">
                        <input type="hidden" name="company_for_submission_id" value="<?= $value['company_id'] ?>">
                        <input type="checkbox" class="checkbox-big check" name="id[<?= $key ?>]" value="<?= $value['id_pc_temp'] ?>" style="zoom : 1.5;"> 
                      <?php else: ?>
                        <i class="fas fa-check"></i>
                      <?php endif; ?>  
                    </td>
                    <td><?php echo @$value['drawing_ga'] ?></td>
                    <td><?php echo @$value['drawing_as'] ?></td>
                    <td><?php echo $value['rev_as'] ?></td>
                    <td>
                        <?php if(strlen($value['evidence_itr'])>1){ ?>
                          <!-- <a href="<?= $this->link_server  ?>/pcms_v2_photo/<?= $value['evidence_itr'] ?>"><?= $value['part_id'] ?></a> -->
                            <?php  
                                $enc_redline = strtr($this->encryption->encrypt($value['evidence_itr']), '+=/', '.-~');
                                $enc_path   = strtr($this->encryption->encrypt('/PCMS/mobile/pcms_v2_mobile/pcms_v2_photo/'), '+=/', '.-~'); 
                            ?>
                            <a target='_blank' href='<?= site_url('irn/open_file/'.$enc_redline.'/'.$enc_path) ?>'><?= $value['part_id'] ?></a>
                        <?php } else { ?>
                          <?= $value['part_id'] ?>
                        <?php } ?>
                    </td>
                    <td>   
                              
                      <input type="text" name="unique_no[<?= $key ?>]" class="form-control editable" onfocus="autocomplete_unique(this, '<?= $value['workpack_no'] ?>', <?= $value['grade'] ?>, <?= $workpack['id'] ?>)" placeholder="Unique Number" value="<?= isset($mis_detail[$value['id_mis']]) ? $mis_detail[$value['id_mis']]['unique_no'] : '' ?>" onblur="validate_unique_no(this, '<?= $value['workpack_no'] ?>', <?= $value['grade'] ?>, <?= $workpack['id'] ?>)" required disabled>
                      <div class="invalid-feedback"></div> 
                    </td>
                    <td>
                      <input type="text" class="form-control heat_no" placeholder="Heat Number"  value="<?= isset($mis_detail[$value['id_mis']]) ? $mis_detail[$value['id_mis']]['heat_or_series_no'] : '-' ?>"
                        disabled>
                      </td> 
                    
                    <td>    
                        <?php
                            if(isset($value['cons_lot_no']) && !empty($value['cons_lot_no'])){
                                $cons_lot = explode(";", $value['cons_lot_no']); 
                            } else {
                                $cons_lot = array(); 
                            }
                        ?>
                        <select class="form-control select2-multiple-tags editable" name="cons_lot_no[<?php echo $key; ?>][]" multiple required disabled>
                            <?php 
                                foreach ($cons_lot as $key => $cons) { 
                                    echo "<option selected>".$cons."</option>";
                                }
                            ?>
                        </select>
                    </td>   
                    <td>
                        <?php if(!isset($value['status_inspection'])){ ?>
                        <select  class='select2_multiple_wps  editable' name='wps_id[<?php echo $key; ?>][]' multiple required disabled></select>
                        <?php 
                            } else {
                                $wps_id = explode(";", $value['wps_id']); 
                                foreach ($wps_id as $key => $wps_id) {
                                    if(isset($wps_code_arr[$wps_id])){
                                    echo "<span class='badge'>".$wps_code_arr[$wps_id]."</span><br/>";
                                    }                             
                                }
                            } 
                        ?>                      
                    </td>  
                    <td>
                        <?php if(!isset($value['status_inspection'])){ ?>  
                            <select  class='select2_multiple_welder  editable' name='welder_id[<?php echo $key; ?>][]' multiple required disabled></select>
                        <?php 
                            } else {
                            $tack_weld_id_display = explode(";", $value['welder_id']);
                            foreach ($tack_weld_id_display as $key => $val_tack_weld_id) {
                                if(isset($welder_code_arr[$val_tack_weld_id])){
                                echo "<span class='badge'>".$welder_code_arr[$val_tack_weld_id]."</span><br/>";
                                }
                            }
                            } 
                        ?>  
                    </td>           
                    <td>
                        <input type="file" disabled name="attachment_surveyor_itr[<?php echo $key; ?>]" required class='editable'>
                    </td>   
                    <td>
                      <?php
                      if(isset($value["progress_itr"])){
                        $progress = number_format($value["progress_itr"], 2);
                      } else{
                        $progress = number_format(0, 2);
                      }
                        
                      $color = "bg-danger";
                      if($progress == 100){
                        $color = "bg-success";
                      }
                      elseif($progress > 25){
                        $color = "bg-info";
                      }
                      ?>
                      <div class="progress">
                          <div class="progress-bar progress-bar-striped progress-bar-animated <?= $color ?>" role="progressbar" aria-valuenow="<?= $progress ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $progress ?>%">
                          <b class="<?= ($progress < 25 ? 'text-dark' : '') ?>"><?= $progress?>%<b>
                          </div>
                      </div>
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
              <button type="submit" id="btn_submit" class="btn btn-success" disabled onclick="sweetalert('confirm', 'Are you sure?', this, event)"><i class="fas fa-check"></i>
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

$(document).ready(function() {

    $(".select2_multiple_wps").select2({ 
        tokenSeparators: [',', ' '],
        ajax: {
              url: "<?php echo base_url();?>fitup/get_wps_ajax_version2",
              type: "post",
              dataType       : 'json',
              data: function (params) {
                var query = {
                  search: params.term
                }
                return query;
              },
              processResults: function (data) {
                return {
                  results: data
                }
              }
        }
    })

    $(".select2_multiple_welder").select2({ 
        tokenSeparators: [',', ' '],
        ajax: {
              url: "<?php echo base_url();?>fitup/get_welder_ajax_version2",
              type: "post",
              dataType       : 'json',
              data: function (params) {
                var query = {
                  search: params.term
                }
                return query;
              },
              processResults: function (data) {
                return {
                  results: data
                }
              }
            }
    })

    
});

var checked = []
  $("#table_submission").on('click', '.check', function() { 

    var editable = $(this).closest('tr').find('.editable');
    var value = $(this).val(); 
    var percentage_data = $('#percentage_data').find(":selected").val(); 

    if (this.checked) { 
      if(percentage_data < 100){     
        console.log("test");   
        editable.removeAttr('required');
        editable.removeAttr('disabled');
        $('#area').removeAttr('required');
        $('#location').removeAttr('required');
        checked.push(value);       
      }  else {
        editable.removeAttr('disabled');
        $('#area').attr('required', true);
        $('#location').attr('required', true);
        checked.push(value);  
      } 
    } else {
      editable.removeClass('is-valid is-invalid');
      editable.attr('disabled', true);
      editable.attr('required', true);
      checked.splice($.inArray(value, checked), 1);
    }

    if (checked.length > 0) {
      if(checked.length > 30) {
        this.checked = false;
        editable.attr('disabled', true);
        editable.attr('required', true);
        checked.splice($.inArray(value, checked), 1);
        Swal.fire({
          type: "warning",
          title: "Warning",
          text: "Only 30 Data Allowed In Each Submission"
        }) 
      } else {
        $("#btn_submit").removeAttr('disabled');
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

  $('.select2-multiple-tags').select2({
    tags: true,
    multiple: true,
    placeholder: 'Consumable Lot No.'
  })
</script>

<script type="text/javascript">
  $("select[name=location]").chained("select[name=area]");
</script>