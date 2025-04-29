<?php

$main             = $list[0];
$report_no        = $main['submission_id'];

$location_name    = $area[$main['area']]['name'];
if ($main['location']) {
  $location_name  .= ', ' . $location[$main['location']]['name'];
}


$total_approved     = 0;
$total_pending      = 0;

$all_approved       = false;
foreach ($list as $value) {
  if ($value['status_inspection'] == 1) {
    $total_pending++;
  }

  if ($value['status_inspection'] >= 3) {
    $total_approved++;
  }
}

if (count($list) > 0 && count($list) == $total_approved) {
  $all_approved = true;
}

$drawing_ga_rev   = $joint[$main['id_joint']]['rev_no'];

$show_attachment_drawing = false;

if (isset($data_drawing[$joint[$main['id_joint']]['drawing_no']])) {

  $drawing_ga_rev   = $data_drawing[$joint[$main['id_joint']]['drawing_no']]['last_revision_no'];
  
  $show_attachment_drawing = true;
  $links_atc        = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($data_drawing[$joint[$main['id_joint']]['drawing_no']]['id']), '+=/', '.-~') . '/' . $drawing_ga_rev . '/' . strtr($this->encryption->encrypt(1), '+=/', '.-~');
  $links_atc_cross  = base_url_ftp_eng() . "public_smoe/open_atc_cross/2/" . strtr($this->encryption->encrypt($data_drawing[$joint[$main['id_joint']]['drawing_no']]['document_no']), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt($data_drawing[$joint[$main['id_joint']]['drawing_no']]['id']), '+=/', '.-~') . '/' . $drawing_ga_rev . '/' . strtr($this->encryption->encrypt(1), '+=/', '.-~');
}

$isometric_no     = $joint[$main['id_joint']]['drawing_no'] . ' Rev.' . $drawing_ga_rev;



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
            <form action="<?= site_url('bondstrand/proceed_update_bondstrand') ?>" method="post">
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
                    <label for="" class="col-xl-3 col-form-label text-muted">Submitted Date</label>
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

                  <div class="col-md-5">
                    <div class="form-group row">
                      <label for="" class="col-xl-3 col-form-label text-muted"> Inspection Date</label>
                      <div class="col-xl">
                        <input type="date" name="inspection_date" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12"></div>
                  <div class="col-md-5">
                    <div class="form-group row">
                      <label for="" class="col-xl-3 col-form-label text-muted"> Inspection Time</label>
                      <div class="col-xl">
                        <input type="time" name="inspection_time" class="form-control" required>
                      </div>
                    </div>
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
                          <th rowspan="3">Surveyor Image</th>
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
                          <th rowspan="2">HUM (%)</th>
                          <th rowspan="2">TEMP (DEG C)</th>
                        </tr>
                        <tr>
                          <th>R</th>
                          <th>H</th>
                          <th>START</th>
                          <th>FINISH</th>
                          <th>SPEC (MM)</th>
                          <th>ACTUAL (MM)</th>
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
                          }

                          ?>
                          <tr>
                            <td>
                              <input type="hidden" name="id_baa[<?= $key ?>]" value="<?= $value['id_baa'] ?>">
                              <?= $no++ ?>
                            </td>
                            <td>
															<?php if(@$wp_detail[$value['id_joint']]['evidence_baa'] != ''): ?>
																	<?php  
																			$enc_redline = encrypt($wp_detail[$value['id_joint']]['evidence_baa']);
																			$enc_path   = encrypt('/PCMS/mobile/pcms_v2_mobile/pcms_v2_photo/bondstrand/');
																	?>
																	<a target='_blank' href='<?= site_url('irn/open_file/'.$enc_redline.'/'.$enc_path) ?>'><span class='btn btn-primary'><i class="fas fa-images"></i></span></a>
															<?php endif; ?>
                            </td>
                            <td><?= $joint[$value['id_joint']]['joint_no'] ?></td>
                            <td class="text-nowrap">
                              <?= $piecemark[$joint[$value['id_joint']]['pos_1']]['spool_no'] ?>
                              <hr style="margin:5px">
                              <?= $piecemark[$joint[$value['id_joint']]['pos_2']]['spool_no'] ?>
                            </td>
                            <td><?= $joint[$value['id_joint']]['diameter'] ?></td>
                            <td>
                              <?php

                              $bonders  = [];
                              foreach (explode(";", $value['bonder_id']) as $v) {
                                $bonders[] = $bonder[$v]['bonder_id'];
                              }

                              ?>

                              <?= implode(',<br>', $bonders) ?>
                            </td>
                            <td><?= $value['sanding_40_60'] ?></td>
                            <td><?= $value['clean_dry'] ?></td>
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
                                <?= date('h:i A', strtotime($value['curing_start'])) ?>
                              <?php endif; ?>
                            </td>

                            <td>
                              <?php if ($allow_update) : ?>
                                <input type="datetime-local" value="<?= $value['curing_finish'] ?>" name="curing_finish[<?= $key ?>]" class="form-control qc_input">
                              <?php else : ?>
                                <input type="hidden" name="curing_finish[<?= $key ?>]" value="<?= $value['curing_finish'] ?>">
                                <?= date('h:i A', strtotime($value['curing_finish'])) ?>
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
                              <?php if ($allow_update) : ?>
                                <div class="text-left">
                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input radio_button approve" name="approval[<?= $key ?>]" value="3" style="transform: scale(1.3);"><b class="text-success">Approve</b>
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input radio_button reject" name="approval[<?= $key ?>]" value="2" style="transform: scale(1.3);"><b class="text-danger">Reject</b>
                                    </label>
                                  </div>
                                </div>
                              <?php elseif ($value['status_inspection'] == 2) : ?>
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
                              <textarea name="inspection_remarks[<?= $key ?>]" class="form-control remarks input_width" <?= $allow_update ? '' : 'disabled' ?>><?= $value['inspection_remarks'] ?></textarea>
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

                  <?php if ($total_approved > 0) : ?>

                    <?php if ($main['requested_for_update'] == 1) : ?>
                      <span class="btn btn-secondary"><i class="fas fa-hourglass-half"></i> Requested For
                        Update</span>
                    <?php else : ?>

                      <span class="btn btn-success"><i class="fas fa-check-circle"></i> All Data Has Been
                        Approved</span>
                      <button type="button" onclick="request_for_update(this, '<?= $main['submission_id'] ?>')" class="btn btn-warning"><i class="fas fa-edit"></i> Request For Update</button>
                    <?php endif; ?>
                  <?php endif; ?>

                  <?php if ($total_pending > 0) : ?>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
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
</script>