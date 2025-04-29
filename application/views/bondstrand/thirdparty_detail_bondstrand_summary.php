<?php

$main             = $list[0];
// test_var($main);
$report_no        = $main['report_number'];
$report_no_enc    = strtr($this->encryption->encrypt($report_no), '+=/', '.-~');

$location_name    = $area[$main['area']]['name'];
if ($main['location']) {
  $location_name  .= ', ' . $location[$main['location']]['name'];
}


$total_pending    = 0;
foreach ($list as $value) {
  if ($value['thirdparty_inspection_status'] == 0) {
    $total_pending++;
  }
}

$drawing_ga_rev   = $joint[$main['id_joint']]['rev_no'];

$show_attachment_drawing = false;

if (isset($data_drawing[$joint[$main['id_joint']]['drawing_no']])) {

  $drawing_ga_rev   = $data_drawing[$joint[$main['id_joint']]['drawing_no']]['last_revision_no'];

  $show_attachment_drawing = true;
  $links_atc        = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($data_drawing[$joint[$main['id_joint']]['drawing_no']]['id']), '+=/', '.-~') . '/' . $drawing_ga_rev . '/' . strtr($this->encryption->encrypt(1), '+=/', '.-~');
  $links_atc_cross  = base_url_ftp_eng() . "public_smoe/open_atc_cross/2/" . strtr($this->encryption->encrypt($data_drawing[$joint[$main['id_joint']]['drawing_no']]['document_no']), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt($data_drawing[$joint[$main['id_joint']]['drawing_no']]['id']), '+=/', '.-~') . '/' . $drawing_ga_rev . '/' . strtr($this->encryption->encrypt(1), '+=/', '.-~');
}

$isometric_no     = $joint[$main['id_joint']]['drawing_no'] . ' Rev.' . $joint[$main['id_joint']]['rev_no'];

$view_report_num = $report_number_format[$main['project']][$main['discipline']][$main['module']][$main['type_of_module']]['bonstrand_report'];
// test_var($report_no_format);

if ($main['company_id'] == 13) {
  $view_report_num = $report_number_format[$main['project']][$main['discipline']][$main['module']][$main['type_of_module']]['bonstrand_rfi_report_scm'];
}

$view_report_num = $view_report_num . $main['report_number'];

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

<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow my-3">
          <div class="card-header">
            <h6 class="m-0">Bondstrand - <strong><?= $view_report_num ?></strong> </h6>

          </div>
          <div class="card-body">
            <form action="<?= site_url('bondstrand/thirdparty_approval_process') ?>" method="post">
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
                      <input type="text" name="product_series_rating" id="" class="form-control" value="<?= $main['product_series_rating'] ?>" disabled>
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
                    <label for="" class="col-xl-3 col-form-label text-muted">Inspection Date</label>
                    <div class="col-xl">
                      <input type="date" name="" id="" class="form-control" value="<?= date('Y-m-d', strtotime($main['inspection_date'])) ?>" disabled>
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
                      <input type="text" name="" id="" class="form-control" value="<?= $view_report_num ?>" disabled>
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
                <hr>

                <div class="col-md-12">
                  <ul class="nav nav-pills border-bottom border-gray" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="detail-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="detail" aria-selected="true">Detail</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="att-tab" data-toggle="tab" href="#att" role="tab" aria-controls="att" aria-selected="false">Additional Attachment</a>
                    </li>
                  </ul>

                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
											<div class="row mt-3">
												<div class="col-md-12 col-sm">
													<div class="btn-group">
																							
														<?php if( $total_pending > 0 ){ ?>
															<button type='button' class="btn btn-outline-success" onclick="change_all_button('7')">Accept All</button>
															<!-- <button type='button' class="btn btn-outline-primary" onclick="change_all_button('9')">Accepted And Released With Comment</button> -->
															<button type='button' class="btn btn-outline-danger" onclick="change_all_button('6')">Reject All</button>
															<button type='button' class="btn btn-outline-secondary" onclick="change_all_button('4')">Clear All</button> 
														<?php } ?>  

													</div>
												</div>
											</div>  
                      <div class="row mt-3">
                        <div class="col-md-12">
                          <div class="table-responsive overflow-auto">
                            <table class="table table-bordered table-sm table-hover text-center">
                              <thead class="bg-info text-white">
                                <tr>
                                  <th rowspan="3">Status Inspection</th>
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
                                  <tr>
                                    <td>
																			<?php if($value['thirdparty_inspection_status'] == 0 && $this->permission_cookie[158] == 1): ?>
																				<input type="hidden" name="id_baa[<?php echo $key ?>]" value="<?= $value['id_baa'] ?>">
																				<div class="form-check form-check-inline text-success">
																					<label class="form-check-label text-left text-nowrap">
																						<input class="form-check-input approved" id='app_clnt_<?php echo $key; ?>' type="radio" name="approve[<?php echo $key ?>]" value="A" style="width: 17px; height: 17px" onclick="change_single_button('7', '<?= $key ?>')">
																						<b>Approve</b>
																					</label>
																				</div>
																				<div class="form-check form-check-inline text-danger">
																					<label class="form-check-label text-left text-nowrap">
																						<input class="form-check-input rejected" id="rjct_clnt_<?php echo $key; ?>" type="radio" name="approve[<?php echo $key ?>]" value="R" style="width: 17px; height: 17px" onclick="change_single_button('6', '<?= $key ?>')">
																						<b>Reject</b>
																					</label>
																				</div>
																				<br>
																				<div class='thirdparty_inspection_remarks d-none' id="clnt_rmks_<?php echo $key; ?>">
																					Third Party Remarks : <br/>
																					<textarea name='thirdparty_inspection_remarks[<?php echo $key; ?>]' placeholder="---"></textarea>
																				</div>
																			<?php endif; ?>
																		</td>
                                    <td>
                                      <?= $no++ ?>
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
                                    <td><?= $value['adhesive_r'] ?></td>
                                    <td><?= $value['adhesive_h'] ?></td>

                                    <td><?= $value['adhesive_type'] ?> </td>
                                    <td><?= date('h:i A', strtotime($value['adhesive_time_start'])) ?></td>
                                    <td><?= date('h:i A', strtotime($value['adhesive_time_stop'])) ?></td>

                                    <td><?= $value['depth_spec'] ?></td>
                                    <td><?= $value['depth_actual'] ?></td>

                                    <td><?= $value['curing_temp'] ?></td>

                                    <td><?= date('h:i A', strtotime($value['curing_start'])) ?></td>

                                    <td><?= date('h:i A', strtotime($value['curing_finish'])) ?></td>

                                    <td><?= $value['env_hum'] ?> </td>
                                    <td>
                                      <?= $value['env_temp'] ?>
                                    </td>
                                    <td>
																			<?php if(@$value['thirdparty_inspection_status'] == 0): ?>
																				<span class="badge badge-pill bg-warning">Pending Approval</span>
																			<?php elseif(@$value['thirdparty_inspection_status'] == 1): ?>
																				<span class="badge badge-pill badge-danger">Rejected</span>
																			<?php elseif(@$value['thirdparty_inspection_status'] == 2): ?>
																				<span class="badge badge-pill bg-success text-white">Reviewed</span>
																			<?php endif; ?>
                                    </td>
                                    <td><?= $value['inspection_remarks'] ?></td>

                                  </tr>
                                <?php endforeach; ?>
                              </tbody>

                            </table>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane fade" id="att" role="tabpanel" aria-labelledby="att-tab">
                      <div class="row mt-3">
                        <div class="col-md-12">
                          <button type="button" onclick="add_attachment(this)" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add Attachment</button>
                          <hr>
                        </div>
                        <div class="col-md-12">
                          <div class="table-responsive overflow-auto">
                            <table class="table table-hover text-center" id="table_att">
                              <thead class="bg-secondary text-white">
                                <th>No.</th>
                                <th>Attachment</th>
                                <th>Description</th>
                                <th>Uploaded By</th>
                                <th>Uploaded Date</th>
                                <th>Action</th>
                              </thead>
                              <tbody>
                                <?php $no = 1;
                                foreach ($attachment as $key => $value) : ?>
                                  <?php

                                  $enc_redline = strtr($this->encryption->encrypt($value['filename']), '+=/', '.-~');
                                  $enc_path   = strtr($this->encryption->encrypt('/PCMS/pcms_v2/redline_attachment/'), '+=/', '.-~');

                                  ?>

                                  <tr>
                                    <td><?= $no++ ?></td>
                                    <td><a target="_blank" href="<?= site_url('irn/open_file/' . $enc_redline . '/' . $enc_path) ?>"><?= $value['filename'] ?></a></td>
                                    <td><?= $value['description'] ?></td>
                                    <td><?= $user[$value['upload_by']]['full_name'] ?></td>
                                    <td><?= $value['upload_date'] ?></td>
                                    <td><button class="btn btn-danger" type="button" onclick="delete_attachment_redline(this, <?= $value['id_redline'] ?>)"><i class="fas fa-trash"></i></button></td>
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



                <div class="col-md-12 text-right">
                  <hr>
                  <a href="<?= site_url('bondstrand/bondstrand_summary') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>

                  <a target="_blank" href="<?= site_url('bondstrand/detail_summary_list/' . $report_no_enc . '/' . strtr($this->encryption->encrypt("pdf"), '+=/', '.-~')) ?>" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Report</a>
									<?php if( $total_pending > 0 ){ ?>
										<button type="submit" name="submit" class="btn btn-primary" title="Submit"><i class="fas fa-save"></i> Save</button>
									<?php } ?>
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

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
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
  $("#table_att").DataTable({
    order: []
  })
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

  function add_attachment(btn) {
    var transmittal_uniqid = "<?= $main['transmittal_uniqid'] ?>"
    $('#modal').modal({
      show: true,
      keyboard: false,
      backdrop: "static"
    })

    $('.modal-body').html(spinner())
    $('.modal-dialog').addClass('modal-lg')
    $('.modal-title').html(`Add Attachment - <?= $view_report_num ?>`)

    $.ajax({
      url: "<?= site_url('bondstrand/add_attachment') ?>",
      type: "POST",
      data: {
        transmittal_uniqid: transmittal_uniqid,
      },
      success: (data) => {
        $('.modal-body').html(data)
      }
    })
  }


  function delete_attachment_redline(btn, id) {
    Swal.fire({
      type: "warning",
      title: "Delete",
      text: "Are You Sure To Delete This ?",
      showCancelButton: true
    }).then((res) => {
      if (res.value) {
        $.ajax({
          url: "<?= site_url('material_verification/delete_attachment_redline') ?>",
          type: "POST",
          data: {
            id: id
          },
          dataType: "JSON",
          success: function(data) {
            if (data.success) {
              Swal.fire({
                type: "success",
                title: "Data Has Been Deleted",
                timer: 1000
              })

              $(btn).closest('tr').remove()
            }
          }
        })
      }
    })
  }

  function update_inspection_detail() {
    Swal.fire({
      type : "warning",
      title : "Update Inspection Datetime ?",
      showCancelButton : true,
    }).then((res) => {
      if(res.value) {
        let transmittal_uniqid = "<?= $main['transmittal_uniqid'] ?>"
        let inspection_date    = $('input[name="inspection_date"]').val()
        let inspection_time    = $('input[name="inspection_time"]').val()

        $.ajax({
          url : "<?= site_url('bondstrand/update_inspection_datetime_report') ?>",
          type : "POST",
          data : {
            transmittal_uniqid : transmittal_uniqid,
            inspection_date : inspection_date,
            inspection_time : inspection_time,
          },
          dataType : "JSON",
          success : (data) => {
            if(data.success) {
              Swal.fire({
                type : "success",
                title : "Data Has Been Updated !!"
              })
            }
          }
        })

      }
    })
  }


  function spinner() {
    return `
  <div class="container text-center h-100">
    <div class="row align-items-center h-100">
      <div class="col-md-12">
        <div class="spinner-border text-success" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
    </div>
  </div>
  `
  }

	function change_single_button(mode,no){
		if(mode==6){
      $("#clnt_rmks_"+no).removeClass('d-none');
      $("textarea[name='thirdparty_inspection_remarks["+no+"]']").prop('disabled', false);
    } else {
      $("#clnt_rmks_"+no).addClass('d-none')
      $("textarea[name='thirdparty_inspection_remarks["+no+"]']").prop('disabled', true);
    }
	}

function change_all_button(mode){
	console.log(mode);
	if(mode==6){
		$(".approved").prop('checked', false);
		$(".rejected").prop('checked', true);
		$(".thirdparty_inspection_remarks").removeClass('d-none');
		$(".thirdparty_inspection_remarks textarea").prop('disabled', false);
	} else if(mode==7){
		$(".rejected").prop('checked', false);
		$(".approved").prop('checked', true);
		$(".thirdparty_inspection_remarks").addClass('d-none');
		$(".thirdparty_inspection_remarks textarea").prop('disabled', true);
	} else {
		$(".approved").prop('checked', false);
		$(".rejected").prop('checked', false);
		$(".thirdparty_inspection_remarks").addClass('d-none');
		$(".thirdparty_inspection_remarks textarea").prop('disabled', true);
	}
}
</script>