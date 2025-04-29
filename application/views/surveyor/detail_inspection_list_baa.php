<?php

$main             = $list[0];
$report_no        = $main['submission_id'];

$location_name    = $area[$main['area']]['name'];
if ($main['location']) {
  $location_name  .= ', ' . $location[$main['location']]['name'];
}

$isometric_no     = $joint[$main['id_joint']]['drawing_no'] . ' Rev.' . $joint[$main['id_joint']]['rev_no'];

$total_approved     = 0;
$total_pending      = 0;
$total_reject      = 0;

$all_approved       = false;
foreach ($list as $value) {
  if ($value['status_inspection'] == 1) {
    $total_pending++;
  }

  if ($value['status_inspection'] >= 3) {
    $total_approved++;
  }

  if ($value['status_inspection'] >= 2) {
    $total_reject++;
  }
}

if (count($list) > 0 && count($list) == $total_approved) {
  $all_approved = true;
}

$drawing_ga_rev   = $joint[$main['id_joint']]['rev_no'];

$show_attachment_drawing = false;

if (isset($data_drawing[$joint[$main['id_joint']]['drawing_no']])) {
  $show_attachment_drawing = true;
  $links_atc        = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($data_drawing[$joint[$main['id_joint']]['drawing_no']]['id']), '+=/', '.-~') . '/' . $drawing_ga_rev . '/' . strtr($this->encryption->encrypt(1), '+=/', '.-~');
  $links_atc_cross  = base_url_ftp_eng() . "public_smoe/open_atc_cross/2/" . strtr($this->encryption->encrypt($data_drawing[$joint[$main['id_joint']]['drawing_no']]['document_no']), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt($data_drawing[$joint[$main['id_joint']]['drawing_no']]['id']), '+=/', '.-~') . '/' . $drawing_ga_rev . '/' . strtr($this->encryption->encrypt(1), '+=/', '.-~');
}


?>

<style>
  th,
  td {
    vertical-align: middle !important;
  }

  .input_width {
    width: 150px;
  }

  .qc_input {
    text-align: center;
  }
</style>
 

<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow my-3">
          <div class="card-header">
            <h6 class="m-0">Bondstrand Adhesive Assembly - <strong><?= $report_no ?></strong> </h6>
          </div>
          <div class="card-body">
            <form id="form_submition_fu" action="<?= site_url('planning/resubmit_save_update_to_baa') ?>" method="post">

              <input type='hidden' name='project_save' value="<?= $main['project'] ?>" >
              <input type='hidden' name='discipline_save' value="<?= $main['discipline'] ?>" >
              <input type='hidden' name='module_save' value="<?= $main['module'] ?>" >
              <input type='hidden' name='type_of_module_save' value="<?= $main['type_of_module'] ?>" >
              <input type='hidden' name='company_id_save' value="<?= $workpack[$main['id_workpack']]['company_id'] ?>" >

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Project</label>
                    <div class="col-xl">
                      <input type="text" name="" id="" class="form-control" value="<?= $project[$main['project']]['project_name'] ?>" disabled>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Company</label>
                    <div class="col-xl">
                      <input type="text" name="" id="" class="form-control" value="<?= $company[$workpack[$main['id_workpack']]['company_id']]['company_name'] ?>" disabled>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Product Series / Rating</label>
                    <div class="col-xl">
                      <input type="text" name="product_series_rating" id="" class="form-control" value="<?= $main['product_series_rating'] ?>" required>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Location</label>
                    <div class="col-xl">
                      <input type="text" name="" id="" class="form-control" value="<?= $location_name ?>" disabled>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Reference Procedure</label>
                    <div class="col-xl">
                      <input type="text" name="" id="" class="form-control" value="ASTM D2563 Level I,II,III & QC-04 (004238917-01)" disabled>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Date</label>
                    <div class="col-xl">
                      <input type="date" name="" id="" class="form-control" value="<?= date('Y-m-d', strtotime($main['submit_date'])) ?>" disabled>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Title</label>
                    <div class="col-xl">
                      <input type="text" name="" id="" class="form-control" value="<?= $data_drawing[$joint[$main['id_joint']]['drawing_no']]['title'] ?>" disabled>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"><?= $category == "submission" ? "Submission No." : "Report No" ?></label>
                    <div class="col-xl">
                      <input type="text" name="" id="" class="form-control" value="<?= $report_no ?>" disabled>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Isometric No.</label>
                    <div class="col-xl">
                      <input type="text" name="" id="" class="form-control" value="<?= $isometric_no ?>" disabled>
                      <?php if ($show_attachment_drawing) : ?>
                        <div class="mt-2">
                          <a target="_blank" href="<?= $links_atc ?>"><i class="fas fa-paperclip"></i> Open Drawing</a>
                          <a target="_blank" href="<?= $links_atc_cross ?>"><i class="ml-3 fas fa-cloud-download-alt"></i>
                            Download Drawing</a>
                        </div>
                      <?php endif; ?>

                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <?php if ($total_pending > 0) : ?>
                  <div class="col-md-12">
                    <div class="btn-group">
                      <button class="btn btn-outline-success" type="button" onclick="change_status(this, 3)">Approve All</button>
                      <button class="btn btn-outline-danger" type="button" onclick="change_status(this, 2)">Reject All</button>
                      <!-- <button class="btn btn-outline-info" type="button" onclick="change_status(this, 4)">Pending All</button> -->
                      <button class="btn btn-outline-secondary" type="button" onclick="change_status(this, 0)">Clear All</button>
                    </div>
                    <hr>
                  </div>
                <?php endif; ?>

                <?php if ($revise_status_inspection == 1) : ?>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input id="cb" name="use_current_date" value="1" type="checkbox" style="width: 20px; height:20px;float: left;">
                      <div style="margin-left: 30px; line-height: 1.5;">
                        <label><i><strong>Use Current Date as Approval Date?</strong></i></label>
                      </div>
                    </div>
                    <hr>
                  </div>
                <?php endif; ?>


                <div class="col-md-12">
                  <div class="table-responsive overflow-auto">
                    <table class="table table-bordered table-sm table-hover text-center" id="table_list">
                      <thead class="bg-info text-white">
                        <tr>
                          <th rowspan="3">NO</th>
                          <th colspan="3">ISOMETRIC</th>
                          <th rowspan="3">BONDER ID</th>
                          <th colspan="3">FIT UP & JOINT PREPARATION</th>
                          <th colspan="7">ADHESIVE BONDED JOINT</th>
                          <th colspan="3">JOINT CURING</th>
                          <th colspan="2">ENV</th>
                          <th rowspan="3">INSPECTION RESULT</th>
                          <th rowspan="3">REMARKS</th>
                        </tr>
                        <tr>
                          <th rowspan="2">JOINT NO</th>
                          <th rowspan="2">SPOOL NO</th>
                          <th rowspan="2">OD (INCH)</th>
                          <th rowspan="2">SANDING (40-60 GRIT)</th>
                          <th rowspan="2">CLEAN & DRY</th>
                          <th rowspan="2">ALIGNMENT</th>
                          <th colspan="2">BATCH NO OF ADHESIVE</th>
                          <th rowspan="2">ADHESIVE TYPE</th>
                          <th colspan="2">TIME</th>
                          <th colspan="2">INSERTION DEPTH</th>
                          <th rowspan="2">TEMP (DEG C)</th>
                          <th colspan="2">TIME</th>
                          <th rowspan="2">HUM</th>
                          <th rowspan="2">TEMP</th>
                        </tr>
                        <tr>
                          <th>R</th>
                          <th>H</th>
                          <th>START</th>
                          <th>FINISH</th>
                          <th>SPEC</th>
                          <th>ACTUAL</th>
                          <th>START</th>
                          <th>FINISH</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 1;
                        foreach ($list as $key => $value) : ?> 

                          <?php 
                            $allow_update = false;
                            if ($value['status_inspection'] == 1) {
                                $allow_update = true;
                            } else if($value['status_inspection'] == 2 && $value['status_delete'] == 1){
                                $allow_update = true;
                            } 
                          ?>
                          <tr>
                            <td>
                              <input type="hidden" name="id_baa[<?= $key ?>]" value="<?= $value['id_baa'] ?>">  
                              <input type='hidden' name='id_joint[<?= $key ?>]' value='<?= $value["id_joint"] ?>'>
                              <input type='hidden' name='id_wp_save[<?= $key ?>]' value='<?= $value["id_workpack"] ?>'>
                              <input type='hidden' name='drawing_no_save[<?= $key ?>]' value='<?= $joint[$main['id_joint']]['drawing_no'] ?>'> 
                              <input type='hidden' name='area' value='<?= $value["area"] ?>'> 
                              <input type='hidden' name='location' value='<?= $value["location"] ?>'> 

                                <?php if($value['status_inspection'] == 2 && $value['status_delete'] == 1){ ?>
                                    <input type='checkbox' class="checkbox-big" name='submit_id[<?php echo $key; ?>]' onclick='open_disabled_form(this,"<?php echo $key; ?>","0")'>
                                    <input type='hidden' name='filter_check[<?php echo $key; ?>]' value='0'>
                                <?php } else { ?> 
                                    <?= $no++ ?>
                                <?php } ?> 
                            </td>
                            <td><?= $joint[$value['id_joint']]['joint_no'] ?></td>
                            <td class="text-nowrap">
                              <?= $piecemark[$joint[$value['id_joint']]['pos_1']]['spool_no'] ?>
                              <hr style="margin:5px">
                              <?= $piecemark[$joint[$value['id_joint']]['pos_2']]['spool_no'] ?>
                            </td>
                            <td><?= $joint[$value['id_joint']]['diameter'] ?></td>
                            <td> 
                                <?php if ($allow_update) : ?>
                                    <select  class='select2_multiple_fitter' name='bonder_id[<?php echo $key; ?>][]' multiple required >
                                        <?php foreach (explode(";", $value['bonder_id']) as $v) { ?>
                                            <option value='<?php echo $v; ?>' selected><?php echo $bonder[$v]['bonder_id'] ?></option>
                                        <?php } ?>
                                    </select>
                                <?php else : ?> 
                                    <?php 
                                        $bonders  = [];
                                        foreach (explode(";", $value['bonder_id']) as $v) {
                                        $bonders[] = $bonder[$v]['bonder_id'];
                                        } 
                                    ?>
                                     <?= implode(',<br>', $bonders) ?>
                                <?php endif; ?> 
                            </td>
                            <td>
                                <?php if ($allow_update) : ?>
                                    <label><input type='radio' name='sanding_40_60[<?php echo $key; ?>]' value='OK' <?php if($value['sanding_40_60'] != "NO"){ ?> checked <?php } ?>> OK</label>
                                    <br/>
                                    <label><input type='radio' name='sanding_40_60[<?php echo $key; ?>]' value='NO'<?php if($value['sanding_40_60'] == "NO"){ ?> checked <?php } ?>> NO</label>
                                <?php else : ?> 
                                    <?= $value['sanding_40_60'] ?>
                                <?php endif; ?>
                               
                            </td>
                            <td>
                                <?php if ($allow_update) : ?>
                                    <label><input type='radio' name='clean_dry[<?php echo $key; ?>]' value='OK' <?php if($value['clean_dry'] != "NO"){ ?> checked <?php } ?>> OK</label>
                                    <br/>
                                    <label><input type='radio' name='clean_dry[<?php echo $key; ?>]' value='NO' <?php if($value['clean_dry'] == "NO"){ ?> checked <?php } ?>> NO</label>
                                <?php else : ?> 
                                    <?= $value['clean_dry'] ?>
                                <?php endif; ?> 
                            </td>

                            <td class="text-nowrap">
                              <?= $piecemark[$joint[$value['id_joint']]['pos_1']]['material'] ?>
                              <hr style="margin:5px">
                              <?= $piecemark[$joint[$value['id_joint']]['pos_2']]['material'] ?>
                            </td>
                            <td>
                              <?php if ($allow_update) : ?>
                                <input type="text" value="<?= $value['adhesive_r'] ?>" name="adhesive_r[<?= $key ?>]" class="form-control qc_input input_width">
                              <?php else : ?>
                                <input type="hidden" name="adhesive_r[<?= $key ?>]" value="<?= $value['adhesive_r'] ?>">
                                <?= $value['adhesive_r'] ?>
                              <?php endif; ?>
                            </td>
                            <td>
                              <?php if ($allow_update) : ?>
                                <input type="text" value="<?= $value['adhesive_h'] ?>" name="adhesive_h[<?= $key ?>]" class="form-control qc_input input_width">
                              <?php else : ?>
                                <input type="hidden" name="adhesive_h[<?= $key ?>]" value="<?= $value['adhesive_h'] ?>">
                                <?= $value['adhesive_h'] ?>
                              <?php endif; ?>
                            </td>

                            <td>
                              <?php if ($allow_update) : ?>
                                <input type="text" value="<?= $value['adhesive_type'] ?>" name="adhesive_type[<?= $key ?>]" class="form-control qc_input input_width">
                              <?php else : ?>
                                <input type="hidden" name="adhesive_type[<?= $key ?>]" value="<?= $value['adhesive_type'] ?>">
                                <?= $value['adhesive_type'] ?>
                              <?php endif; ?>
                            </td>
                            <td>
                              <?php if ($allow_update) : ?>
                                <input type="datetime-local" name= 'adhesive_time_start[<?php echo $key; ?>]' value='<?php echo $value["adhesive_time_start"]; ?>' required>
                              <?php else : ?>
                                <?= date('H:i', strtotime($value['adhesive_time_start'])) ?>
                              <?php endif; ?>
                                
                            </td>
                            <td>
                                <?php if ($allow_update) : ?>
                                    <input type="datetime-local"name= 'adhesive_time_stop[<?php echo $key; ?>]' value='<?php echo $value["adhesive_time_stop"]; ?>' required>
                                <?php else : ?>
                                    <?= date('H:i', strtotime($value['adhesive_time_stop'])) ?>
                                <?php endif; ?> 
                            </td>

                            <td>
                              <?php if ($allow_update) : ?>
                                <input type="text" value="<?= $value['depth_spec'] ?>" name="depth_spec[<?= $key ?>]" class="form-control qc_input input_width">
                              <?php else : ?>
                                <input type="hidden" name="depth_spec[<?= $key ?>]" value="<?= $value['depth_spec'] ?>">
                                <?= $value['depth_spec'] ?>
                              <?php endif; ?>
                            </td>
                            <td>
                              <?php if ($allow_update) : ?>
                                <input type="text" value="<?= $value['depth_actual'] ?>" name="depth_actual[<?= $key ?>]" class="form-control qc_input input_width">
                              <?php else : ?>
                                <input type="hidden" name="depth_actual[<?= $key ?>]" value="<?= $value['depth_actual'] ?>">
                                <?= $value['depth_actual'] ?>
                              <?php endif; ?>
                            </td>

                            <td>
                              <?php if ($allow_update) : ?>
                                <input type="text" value="<?= $value['curing_temp'] ?>" name="curing_temp[<?= $key ?>]" class="form-control qc_input input_width">
                              <?php else : ?>
                                <input type="hidden" name="curing_temp[<?= $key ?>]" value="<?= $value['curing_temp'] ?>">
                                <?= $value['curing_temp'] ?>
                              <?php endif; ?>
                            </td>

                            <td>
                              <?php if ($allow_update) : ?>
                                <input type="datetime-local" value="<?= $value['curing_start'] ?>" name="curing_start[<?= $key ?>]" class="form-control qc_input">
                              <?php else : ?>
                                <input type="hidden" name="curing_start[<?= $key ?>]" value="<?= $value['curing_start'] ?>">
                                <?= date('H:i', strtotime($value['curing_start'])) ?>
                              <?php endif; ?>
                            </td>

                            <td>
                              <?php if ($allow_update) : ?>
                                <input type="datetime-local" value="<?= $value['curing_finish'] ?>" name="curing_finish[<?= $key ?>]" class="form-control qc_input">
                              <?php else : ?>
                                <input type="hidden" name="curing_finish[<?= $key ?>]" value="<?= $value['curing_finish'] ?>">
                                <?= date('H:i', strtotime($value['curing_finish'])) ?>
                              <?php endif; ?>
                            </td>

                            <td>
                              <?php if ($allow_update) : ?>
                                <input type="text" value="<?= $value['env_hum'] ?>" name="env_hum[<?= $key ?>]" class="form-control qc_input input_width">
                              <?php else : ?>
                                <input type="hidden" name="env_hum[<?= $key ?>]" value="<?= $value['env_hum'] ?>">
                                <?= $value['env_hum'] ?>
                              <?php endif; ?>
                            </td>
                            <td>
                              <?php if ($allow_update) : ?>
                                <input type="text" value="<?= $value['env_temp'] ?>" name="env_temp[<?= $key ?>]" class="form-control qc_input input_width">
                              <?php else : ?>
                                <input type="hidden" name="env_temp[<?= $key ?>]" value="<?= $value['env_temp'] ?>">
                                <?= $value['env_temp'] ?>
                              <?php endif; ?>
                            </td>
                            <td>
                               
                              <?php if ($value['status_inspection'] == 2) : ?>
                                <span class="badge badge-danger badge badge-pill ml-4">Rejected by QC</span>
                              <?php elseif ($value['status_inspection'] == 3) : ?>
                                <span class="badge badge-success badge badge-pill ml-4">Approved by QC</span>
                              <?php elseif ($value['status_inspection'] == 4) : ?>
                                <span class="badge badge-info badge badge-pill ml-4">Pending by QC</span>
                              <?php elseif ($value['status_inspection'] == 12) : ?>
                                <span class="badge badge-dark badge badge-pill ml-4">Void</span>
                              <?php endif; ?>
                            </td>
                            <td>
                              <textarea name="remarks[<?= $key ?>]" class="form-control remarks input_width" ></textarea>
                            </td>

                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-12 text-right">
                  <hr>
                  <a href="<?= site_url('bondstrand/inspection_list') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>

                  <a target="_blank" href="<?= site_url('bondstrand/detail_inspection_list/' . $submission_enc . '/' . $category_enc . '/' . strtr($this->encryption->encrypt("pdf"), '+=/', '.-~')) ?>" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Report</a>

                  <?php if ($all_approved) : ?>

                    <?php if ($main['requested_for_update'] == 1) : ?>
                      <span class="btn btn-secondary"><i class="fas fa-hourglass-half"></i> Requested For
                        Update</span>
                    <?php else : ?>

                      <span class="btn btn-success"><i class="fas fa-check-circle"></i> All Data Has Been
                        Approved</span>
                      <button type="button" onclick="request_for_update(this, '<?= $main['submission_id'] ?>')" class="btn btn-warning"><i class="fas fa-edit"></i> Request For Update</button>
                    <?php endif; ?>
                  <?php endif; ?>

                  <?php if ($total_reject > 0) : ?>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
                  <?php endif; ?>
                </div>
              </div>
            </form>
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


<script type="text/javascript">

  $(document).ready(function() {

      $(".select2_multiple_fitter").select2({ 
        tokenSeparators: [',', ' '],
        ajax: {
              url: "<?php echo base_url();?>planning/get_bonstrand_ajax",
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
 

      $(".select2_filter_joint_number").select2({
        ajax: {
              url: "<?php echo base_url();?>planning/get_joint_number/<?= $workpack_id_data ?>",
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

</script>


<script>
  $('form').on('submit', function() {
    $('button[type=submit]').attr('disabled', true)
  })

  $('.radio_button').change(function() {
    var val = $(this).val()
    var textarea = $(this).closest('tr').find('.remarks')
    if (this.checked) {
      $(this).closest('tr').find('.qc_input').attr('required', true)
      if (val == 2 || val == 4) {
        textarea.attr('required', true)
      } else {
        textarea.removeAttr('required')
      }
    } else {
      $(this).closest('tr').find('.qc_input').removeAttr('required')
    }
  })


  function change_status(btn, status) {
    $('.radio_button').prop('checked', false)
    if (status == 3) {
      $('.approve').val(3)
      $('.approve').prop('checked', true)

    } else if (status == 2) {
      $('.reject').val(2)
      $('.reject').prop('checked', true)

    } else if (status == 4) {
      $('.pending').val(4)
      $('.pending').prop('checked', true)

    } else if (status == 0) {
      $('.pending').val('')
      $('.radio_button').prop('checked', false)
      $('.qc_input').removeAttr('required')

    }

    if (status != 0) {
      $('.qc_input').attr('required', true)
    }



    if (status == 2 || status == 4) {
      console.log(status)
      $('.remarks').attr('required', true)
    } else {
      $('.remarks').removeAttr('required')
    }

  }

  function request_for_update(btn, submission_id) {
    var url = "<?= site_url('bondstrand/request_for_update/') ?>" + submission_id
    $("#modal").modal({
      show: true,
      keyboard: false,
      backdrop: "static"
    }).find('.modal-body').load(url)
    $('.modal-title').text("Request For Update")
    $('.modal-dialog').addClass('modal-lg')
  }


  function open_disabled_form(val,no,status_inspection) {

var $checkboxes = $('#form_submition_fu td input[type="checkbox"]');          
$checkboxes.change(function(){
    var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
    $('#total_data_checked').text(countCheckedCheckboxes);            
    $('#total_data_checked_val').val(countCheckedCheckboxes);

    if(countCheckedCheckboxes > 0){
       $("#btn_submit").removeAttr('disabled');
    } else {
      $("#btn_submit").prop("disabled", true);
    }

    if(countCheckedCheckboxes <= 30){

      if($(val).prop("checked") == true){
         $('input[name="filter_check['+no+']"]').val(1);
      } else {
         $('input[name="filter_check['+no+']"]').val(0);
      }

    } else {

       alert("Sorry, Data checked has been maximum..");
       $('input[name="bonder_id['+no+']"]').val(0);

    }
});



}


</script>

