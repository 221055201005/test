<div id="content" class="container-fluid">
  <?php error_reporting(0);
  // test_var($inspection_detail);
  $overall_status = array_column($inspection_detail, 'status_inspection');
  $revision_status_inspection = array_column($inspection_detail, 'revision_status_inspection');
  ?>


  <?php
  $url_image = "10.5.252.116";
  if ($this->input->ip_address() == getenv('IP_FIREWALL_GATEWAY')) {
    $url_image = "www.smoebatam.com";
  }
  ?>

  <div class="modal fade" id="modalRedline" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <form action="<?php echo base_url(); ?>visual/process_new_redline" method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <h4 class="modal-title">Add Attachment Redline</h4>
          </div>
          <div class="modal-body">

            <b><i>Drawing No :</i></b><br />
            <input type="hidden" name="drawing_no" class='form-control' value="<?php echo $inspection_detail[0]['drawing_no']; ?>" readonly>
            <input type="text" name="drawing_noxxx" class='form-control' value="<?php echo $inspection_detail[0]['drawing_no'] . ($inspection_detail[0]['rev_ga_template'] != '' ? ' Rev. ' . $inspection_detail[0]['rev_ga_template'] : ''); ?>" readonly>
            <br />

            <b><i>Submission ID :</i></b><br />
            <input type="text" name="submission_id" class='form-control' value="<?php echo $inspection_detail[0]['submission_id']; ?>" readonly><br />

            <b><i>Report No :</i></b><br />
            <input type="text" name="" class='form-control' value="<?php echo strtoupper('SOF-OCP-SMO-' . $master_type_of_module[$inspection_detail[0]['type_of_module']]['code'] . '-' . $master_discipline[$inspection_detail[0]['discipline']]['initial'] . '-VIS-' . $inspection_detail[0]['report_number']); ?>" readonly><br />
            <input type="hidden" name="report_no" class='form-control' value="<?php echo $inspection_detail[0]['report_number']; ?>" readonly>

            <b><i>Revision No :</i></b><br />
            <input type="text" name="postpone_reoffer_no" class='form-control' value="<?php echo $inspection_detail[0]['postpone_reoffer_no']; ?>" readonly><br />

            <b><i>Red-Line File :</i></b><br />
            <input type="file" name="attach_line[]" multiple required><br /><br />

            <b><i>Attachment Description :</i></b><br />
            <textarea name='description' class='form-control'></textarea><br /> <br />

            <input type="hidden" name="upload_by" value="<?php echo $this->user_cookie[0]; ?>">
            <input type="hidden" name="upload_date" value="<?php echo date("Y-m-d H:i:s"); ?>">

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
          </div>
        </form>
      </div>

    </div>
  </div>
  <div class="row">
    <style type="text/css">
      .disabled-effect {
        pointer-events: none;
        opacity: 0.5;
      }
    </style>

    <input type="hidden" name="approval_code_log" value="VISUAL/<?= $project_data_portal[0]["project_name"] ?>/<?= $report_number ?>/">

    <div class="col-md-12">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0"><?= $meta_title ?></h6>
        <div class="overflow-auto media text-muted pt-3 mt-1 border-top border-gray">
          <div class="container-fluid">

            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label>Drawing Number</label>
                  <input type="hidden" class="form-control" name="drawing_no_for_view" value="<?= $inspection_detail[0]['drawing_no'] ?>" required="" oninput="checkdraw(this)" readonly>
                  <input type="text" name="drawing_noxxx" class='form-control' value="<?php echo $inspection_detail[0]['drawing_no'] . ($inspection_detail[0]['transmit_gaas_rev'] != '' ? ' Rev. ' . $inspection_detail[0]['transmit_gaas_rev'] : 'Rev. ' . $inspection_detail[0]['rev_ga_template']); ?>" readonly>

                  <input type="hidden" class="form-control" name="report_number_view" value="<?= $inspection_detail[0]['report_number'] ?>" required="" oninput="checkdraw(this)" readonly>
                  <?php
                  $gaat = MAX(array_column($inspection_detail, 'transmit_gaas_rev'));
                  if ($gaat != '') {
                    $transmit_gaas_rev = $gaat;
                  } else {
                    $transmit_gaas_rev = MAX(array_merge(array_column($inspection_detail, 'transmit_gaas_rev'), array_column($inspection_detail, 'rev_ga_template')));
                  }
                  ?>
                  <?php
                  $links_atc = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($drawing_val_2[$inspection_detail[0]['drawing_no']]['id']), '+=/', '.-~') . '/' . $transmit_gaas_rev . '/1e0e7b33a7be53e7c9957eb27914726c8df5a3127a78009723415681dce804ee076d678b2f809f42b8417bf8007fec6d58455b4beae15f6a17e384122be4fe71kbm4o296X67afS9s6puvP6qvwqy7y8TaO5sgWrvULiU-';
                  $links_atc_cross = base_url_ftp_eng() . "public_smoe/open_atc_cross/2/" . strtr($this->encryption->encrypt($inspection_detail[0]['drawing_no']), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt($drawing_val_2[$inspection_detail[0]['drawing_no']]['id']), '+=/', '.-~') . '/' . $transmit_gaas_rev . '/1e0e7b33a7be53e7c9957eb27914726c8df5a3127a78009723415681dce804ee076d678b2f809f42b8417bf8007fec6d58455b4beae15f6a17e384122be4fe71kbm4o296X67afS9s6puvP6qvwqy7y8TaO5sgWrvULiU-';
                  ?>
                  <a target='_blank' href='<?= $links_atc ?>' title='Attachment'> <i class='fas fa-paperclip'></i> Open Drawing </a>
                  &nbsp;&nbsp;
                  <a target='_blank' href='<?= $links_atc_cross ?>' title='Attachment' download='<?= $inspection_detail[0]['drawing_no'] ?>.pdf'>
                    <i class='fas fa-cloud-download-alt'></i> Download Drawing
                  </a>
                  <?php //} 
                  ?>
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <?php if ($condition == 'client_update') { ?>
                    <label><?= $enable_modify == 'client' ? 'Report No.' : 'Submission No.' ?></label>
                    <input type="text" id='submission_id' class="form-control" name="batch_no_only_view" value="<?= $reno_view ?>" readonly required="">
                  <?php } else { ?>
                    <label><?= $enable_modify == 'client' ? 'Report No.' : 'Submission No.' ?></label>
                    <input type="text" id='submission_id' class="form-control" name="batch_no_only_view" value="<?= $inspection_detail[0]['submission_id'] ?>" readonly required="">
                  <?php } ?>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label>Requestor </label>
                  <input type="text" class="form-control" name="requestor" value="<?= $user_list[$inspection_detail[0]['requestor']]['full_name'] ?>" disabled="" required="">
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label>Requestor Company</label>
                  <input type="text" class="form-control" name="requestor_company" value="<?= $inspection_detail[0]['company'] ?>" required="" disabled="">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label>Discipline</label>
                  <input type="text" class="form-control" name="discipline_name" value="<?= $master_discipline[$inspection_detail[0]['discipline']]['discipline_name'] ?>" disabled="" required="">
                  <input type="hidden" class="form-control" name="discipline" disabled="" value="2" required="">
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label>Module</label>
                  <input type="text" class="form-control" name="mod_id_name" value="<?= $master_module[$inspection_detail[0]['module']]['mod_desc'] ?>" disabled="" required="">
                </div>
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="col-md">
                <div class="form-group">

                  <input type='hidden' id='submission_id_update' name='submission_id_update' value='<?php echo $inspection_detail[0]['submission_id']; ?>'>
                  <input type='hidden' id='report_number_update' name='report_number_update' value='<?php echo $inspection_detail[0]['report_number']; ?>'>
                  <input type='hidden' id='discipline_update' name='discipline_update' value='<?php echo $inspection_detail[0]['discipline']; ?>'>
                  <input type='hidden' id='module_update' name='module_update' value='<?php echo $inspection_detail[0]['module']; ?>'>
                  <input type='hidden' id='type_of_module_update' name='type_of_module_update' value='<?php echo $inspection_detail[0]['type_of_module']; ?>'>
                  <input type='hidden' id='company_update' name='company_update' value='<?php echo $inspection_detail[0]['company']; ?>'>
                  <input type='hidden' id='project_code_update' name='project_code_update' value='<?php echo $inspection_detail[0]['project_code']; ?>'>
                  <input type='hidden' id='status_invitation_update' name='status_invitation_update' value='<?php echo $inspection_detail[0]['status_invitation']; ?>'>
                  <input type='hidden' id='legend_inspection_auth_update' name='legend_inspection_auth_update' value='<?php echo $inspection_detail[0]['legend_inspection_auth']; ?>'>
                  <input type='hidden' id='postpone_reoffer_no_update' name='postpone_reoffer_no_update' value='<?php echo $inspection_detail[0]['postpone_reoffer_no']; ?>'>
                  <input type='hidden' id='company_id_update' name='company_id_update' value='<?php echo $inspection_detail[0]['company_id']; ?>'>
                  <input type='hidden' id='drawing_no_update' name='drawing_no_update' value='<?php echo $inspection_detail[0]['drawing_no']; ?>'>


                  <?php if ($condition == 'client_update') { ?>

                    <label>Date Request Report</label>

                    <input type="date" class="form-control" id="date_request" name="date_request" required="" value="<?= $inspection_detail[0]['status_inspection'] >= 3 ? DATE('Y-m-d', strtotime($inspection_detail[0]['date_request'])) : null ?>" onchange='change_date_inspection_client(this)'>

                    <input type="hidden" class="form-control" id='date_request_from' name="date_from" required="" value="<?= $inspection_detail[0]['status_inspection'] >= 3 ? DATE('Y-m-d', strtotime($inspection_detail[0]['date_request'])) : null ?>">

                  <?php } else { ?>

                    <label>Date Request</label>

                    <input type="date" class="form-control" id="date_request" name="date_request" required="" value="<?= $inspection_detail[0]['status_inspection'] >= 3 ? DATE('Y-m-d', strtotime($inspection_detail[0]['date_request'])) : null ?>" onchange='change_date_inspection(this)'>

                    <input type="hidden" class="form-control" id='date_request_from' name="date_from" required="" value="<?= $inspection_detail[0]['status_inspection'] >= 3 ? DATE('Y-m-d', strtotime($inspection_detail[0]['date_request'])) : null ?>">

                  <?php } ?>
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <?php if ($condition == 'client_update') { ?>

                    <label>Inspection Date Report</label>

                    <input type="date" class="form-control" id='inspection_datetime' name="inspection_datetime" required="" value="<?= $inspection_detail[0]['status_inspection'] >= 3 ? DATE('Y-m-d', strtotime($inspection_detail[0]['inspection_datetime'])) : null ?>" onchange='change_date_inspection_client(this)'>

                    <input type="hidden" class="form-control" id='inspection_datetime_from' name="inspection_datetime_from" required="" value="<?= $inspection_detail[0]['status_inspection'] >= 3 ? DATE('Y-m-d', strtotime($inspection_detail[0]['inspection_datetime'])) : null ?>">

                  <?php } else { ?>

                    <label>Inspection Date</label>

                    <input type="date" class="form-control" id='inspection_datetime' name="inspection_datetime" required="" value="<?= $inspection_detail[0]['status_inspection'] >= 3 ? DATE('Y-m-d', strtotime($inspection_detail[0]['inspection_datetime'])) : null ?>" onchange='change_date_inspection(this)'>

                    <input type="hidden" class="form-control" id='inspection_datetime_from' name="inspection_datetime_from" required="" value="<?= $inspection_detail[0]['status_inspection'] >= 3 ? DATE('Y-m-d', strtotime($inspection_detail[0]['inspection_datetime'])) : null ?>">

                  <?php } ?>
                </div>
              </div>
            </div>
            <?php if ($condition == 'client_update') { ?>
              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>QC Approval By</label>
                    <select name="inspection_by" id='inspection_by' class="select2" style="width: 100%" required onchange='change_qc_approval(this)'>
                      <option value="">---</option>
                      <?php foreach ($user_list_inspector as $key => $value) : ?>
                        <option value="<?= $value['id_user'] ?>" <?= $value['id_user'] == $inspection_detail[0]["inspection_by"] ? "selected" : null ?>><?= $value['full_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">

                  </div>
                </div>
              </div>
            <?php } ?>

            <?php if ($condition == 'update') { ?>
              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>QC Approval By</label>
                    <select name="inspection_by" id='inspection_by' class="select2" style="width: 100%" required onchange='change_qc_approval_qc(this)'>
                      <option value="">---</option>
                      <?php foreach ($user_list_inspector as $key => $value) : ?>
                        <option value="<?= $value['id_user'] ?>" <?= $value['id_user'] == $inspection_detail[0]["inspection_by"] ? "selected" : null ?>><?= $value['full_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">

                  </div>
                </div>
              </div>
            <?php } ?>


            <!-- <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Area</label>
                    <select class="form-control select2 input_area" name="area_main" <?= $user_permission[40] == 1 ? '' : 'disabled' ?>>
                    <?php if ($inspection_detail[0]['area_v2'] != '') { ?>
                      <?php foreach ($master_area_v2 as $key => $value_area) { ?>
                        <option value="<?= $value_area['id'] ?>" <?= $inspection_detail[0]['area_v2'] == $value_area['id'] ? 'selected' : '' ?>><?= $value_area['name'] ?></option>
                      <?php } ?>
                    <?php } else { ?>
                    <?php $new_location = 'd-none'; ?>
                    <?php foreach ($master_area as $key => $value_area) { ?>
                      <option value="<?= $value_area['id'] ?>" <?= $inspection_detail[0]['area'] == $value_area['id'] ? 'selected' : '' ?>><?= $value_area['area_name'] ?></option>
                    <?php }
                    } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md <?= $new_location ?>">
                  <div class="form-group">
                    <label>Location</label>
                    <select class="form-control select2 input_location" name="location_main" <?= $user_permission[40] == 1 ? '' : 'disabled' ?>>
                    <?php if ($inspection_detail[0]['location_v2'] != '') { ?>
                      <?php foreach ($master_location_v2 as $key => $value_location) { ?>
                        <option value="<?= $value_location['id'] ?>" <?= $inspection_detail[0]['location_v2'] == $value_location['id'] ? 'selected' : '' ?> data-chained="<?php echo $value_location['id_area'] ?>"><?= $value_location['name'] ?></option>
                      <?php } ?>
                    <?php } else { ?>
                    <?php foreach ($master_location as $key => $value_location) { ?>
                      <option value="<?= $value_location['id'] ?>" <?= $inspection_detail[0]['location'] == $value_location['id'] ? 'selected' : '' ?>><?= $value_location['location_name'] ?></option>
                    <?php }
                    } ?>
                    </select>

                    <input type="hidden" name="submission_id_data" value="<?= $inspection_detail[0]['submission_id'] ?>">
                    
                  </div>
                </div>
              </div> -->

            <!-- <div class="row">
                <div class="col-md <?= $new_location ?>">
                  <label>Point</label>
                  <select class="form-control select2 input_point" name="point_main" <?= $user_permission[40] == 1 ? '' : 'disabled' ?>>
                    <?php foreach ($master_point_v2 as $key => $value_point) { ?>
                      <option value="<?= $value_point['id'] ?>" <?= $inspection_detail[0]['point_v2'] == $value_point['id'] ? 'selected' : '' ?> data-chained="<?php echo $value_point['id_location'] ?>"><?= $value_point['name'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-md" style="text-align: right !important; vertical-align: text-bottom !important;">
                  <span class="btn btn-warning" style="vertical-align: bottom !important;" onclick="changeLocation()">
                    <i class="fas fa-edit"></i> Update Location
                  </span>
                </div>
                <script type="text/javascript">
                  $("select[name=location_main]").chained("select[name=area_main]");
                  $("select[name=point_main]").chained("select[name=location_main]");
                  function changeLocation(){
                    const location = $('.input_location').val();
                    const area = $('.input_area').val()
                    const point = $('.input_point').val()
                    <?php //if($enable_modify=='client'){ 
                    ?>
                      // const identifier = 'report_number';
                      // const where = '<?= $inspection_detail[0]['report_number'] ?>';
                    <?php //} else { 
                    ?>
                      const identifier = 'submission_id';
                      const where = '<?= $inspection_detail[0]['submission_id'] ?>';
                    <?php //} 
                    ?>

                    $.ajax({
                      url: "<?= base_url('visual/change_area_3/') ?>",
                      type: "post",
                      data: {
                        area        : area,
                        location    : location,
                        point       : point,
                        identifier  : identifier,
                        where       : where,
                      },
                      success: function(data){
                        Swal.fire(
                          'Data Has Been Updated !',
                          '',
                          'success'
                        ).then(function() {
                          return false;
                        });
                      }
                    });
                  }
                </script>
              </div> -->

          </div>
          <div class="fl-scrolls fl-scrolls-hidden" data-orientation="horizontal" style="width: 1564px; left: 286px;">
            <div style="width: 1564px;"></div>
          </div>
        </div>
      </div>

      <?php if (in_array(1, $revision_status_inspection)) { ?>
        <div class="my-3 p-3 bg-white rounded shadow-sm form-group">
          <h6 class="pb-2 mb-0">Inspection Date Option</h6>
          <hr>

          <div class="row">

            <div class="col align-middle">
              <div class="form-check form-check-inline col">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1" name="ticked_report_date">
                <label class="form-check-label" for="inlineCheckbox1">
                  <b>Use Current Date as Approval Date?</b>
                </label>
              </div>
            </div>

            <div class="col align-middle d-none">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Current Date</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" value="<?= DATE('Y-m-d') ?>" readonly>
                </div>
              </div>
            </div>

            <div class="col align-middle d-none">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Last Date</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" value="<?= DATE('Y-m-d', strtotime($inspection_detail[0]['inspection_datetime'])) ?>" readonly>
                </div>
              </div>
            </div>
          </div>

        </div>
      <?php } ?>

      <!-- <br><br> -->
    </div>

    <div class="col-md-12">
      <div class="card">
        <ul class="nav nav-pills border-bottom border-gray" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="detail-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="detail" aria-selected="true" onclick="hidenDetail(1)">Detail</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" id="revise-tab" data-toggle="tab" href="#revise" role="tab" aria-controls="revise" aria-selected="false">Revise History Log</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" id="redline-tab" data-toggle="tab" href="#redline" role="tab" aria-controls="redline" aria-selected="false" onclick="hidenDetail(0)">Supporting Document</a>
          </li>
          <script type="text/javascript">
            function hidenDetail(angka) {
              if (angka == 0) {
                $('.tab-detail').addClass('d-none')
              } else {
                $('.tab-detail').removeClass('d-none')
              }
            }
          </script>
        </ul>
      </div>
    </div>

    <div class="col tab-content" id="myTabContent">
      <div class="tab-pane active" id="detail" role="tabpanel" aria-labelledby="detail-tab"></div>

      <!-- <div class="tab-pane fade" id="revise" role="tabpanel" aria-labelledby="revise-tab">
        <div class="col-md-12 card">
          <h3>1</h3>
        </div>
      </div> -->

      <div class="tab-pane fade" id="redline" role="tabpanel" aria-labelledby="redline-tab">
        <div class="col-md-12 card">
          <div class="row mt-3">
            <div class="col-md-12">
              <div class="table-responsive overflow-auto">

                <!-- <a href='#' class="btn btn-info" id="btnNewRedline"><i class="fas fa-plus-circle"></i> Add Red-Line</a> -->
                <button class="btn btn-info" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRedline">
                  <i class="fas fa-plus-circle"></i> Add Red-Line
                </button>
                <br /><br />

                <script type="text/javascript">
                  // $(document).ready(function(){
                  //   $("#btnNewRedline").click(function(){
                  //     $("#modalRedline").modal();
                  //   });
                  // });
                </script>

                <table class="table table-hover text-center">
                  <thead class="bg-secondary text-white">
                    <th>No</th>
                    <th>Drawing No</th>
                    <th>Submission ID</th>
                    <th>Report No</th>
                    <th>Revision No</th>
                    <th>Redline File</th>
                    <th>Redline Description</th>
                    <th>Upload By</th>
                    <th>Upload Date</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                    <?php if (sizeof($redline_attach) > 0) { ?>
                      <?php $no = 1;
                      foreach ($redline_attach as $key => $value) : ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?php echo $value["drawing_no"] ?></td>
                          <td><?php echo $value["submission_id"] ?> </td>
                          <td><?= $master_report_number[$joint_list[0]['project_code']][$joint_list[0]['discipline']][$joint_list[0]['type_of_module']]["fitup_report"] . $value['report_no'] ?></td>
                          <td><?= $value['postpone_reoffer_no'] ?></td>

                          <td>
                            <a href="<?= base_url('visual/open_atc/') . $value["filename"] . '/' . $value["filename"] ?>" target="_blank"> Links</a>
                          </td>

                          <td>
                            <?= $value['description'] ?>
                          </td>

                          <td><?= $user_list[$value['upload_by']]['full_name'] ?></td>
                          <td><?= $value['upload_date'] ?></td>
                          <td><a href='<?= base_url() ?>fitup/delete_redline_data/<?php echo strtr($this->encryption->encrypt($value["id_redline"]), '+=/', '.-~'); ?>'><button type='button' class='btn btn-danger'><i class="fas fa-trash-alt"></i></button></a></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php } else { ?>
                      <tr>
                        <td colspan='7'> No Data Available</td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <br>
        <hr><br>
      </div>


    </div>
  </div>

  <script type="text/javascript">
    function change_all_button(tombol) {
      if (tombol == 1) {
        $('.approve').prop("checked", true)
      } else if (tombol == 2) {
        $('.rejected').prop("checked", true)
      } else {
        $('.approve').prop("checked", false)
        $('.rejected').prop("checked", false)
      }
    }
  </script>

  <!-- <div class="col-12"> -->
  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <?php if ($condition != 'client_update') { ?>
      <h6 class="pb-2 mb-0"><?= $meta_title ?></h6>
    <?php } ?>
    <form method="POST" action="<?= base_url('visual/update_inspection_qc') ?>">
      <?php if ($condition == 'client_update') { ?>

        <div class="text-header">
          <h6 class="pb-2 mb-0">Inspection Detail</h6>
        </div>
        <div class="bg-white overflow-auto">

          <!-- <div class="col-md-12"></div>
          <div class="col-md-8">
            <div class="form-group row">
              <label for="" class="col-xl-3 col-form-label text-muted">QC Approval by </label>
              <div class="col-xl">
                <select name="inspector_id" class="select2" style="width: 100%">
                  <option value="0">---</option>
                  <?php foreach ($user_list as $key => $value) : ?>
                    <option value="<?= $value['id_user'] ?>" <?= $value['id_user'] == $inspection_detail_data['inspection_by'] ? 'selected' : '' ?>>
                      <?= $value['full_name'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div> -->

          <div class="col-md-12"></div>
          <div class="col-md-8">
            <div class="form-group row">
              <label for="" class="col-xl-3 col-form-label text-muted">RFI Inspection date</label>
              <div class="col-xl">
                <input type="date" name="inspect_date" class="form-control" value="<?= date('Y-m-d', strtotime($inspection_detail_data['time_inspect'])) ?>" required>
              </div>
            </div>
          </div>
          <div class="col-md-12"></div>
          <div class="col-md-8">
            <div class="form-group row">
              <label for="" class="col-xl-3 col-form-label text-muted">RFI Inspection Time</label>
              <div class="col-xl">
                <input type="time" name="inspect_time" class="form-control" value="<?= date('H:i', strtotime($inspection_detail_data['time_inspect'])) ?>" required>
              </div>
            </div>
          </div>

          <div class="col-md-12"></div>
          <div class="col-md-8">
            <div class="form-group row">
              <label for="" class="col-xl-3 col-form-label text-muted">Transmittal date</label>
              <div class="col-xl">
                <input type="date" name="transmittal_date" class="form-control" value="<?= date('Y-m-d', strtotime($inspection_detail_data['transmittal_datetime'])) ?>" required>
              </div>
            </div>
          </div>
          <div class="col-md-12"></div>
          <div class="col-md-8">
            <div class="form-group row">
              <label for="" class="col-xl-3 col-form-label text-muted">Transmittal Time</label>
              <div class="col-xl">
                <input type="time" name="transmittal_time" class="form-control" value="<?= date('H:i', strtotime($inspection_detail_data['transmittal_datetime'])) ?>" required>
              </div>
            </div>
          </div>

          <!-- <div class="col-md-12"></div>
<div class="col-md-8">
<div class="form-group row">
  <label for="" class="col-xl-3 col-form-label text-muted">Invitation Type</label>
  <div class="col-xl">
    <select name="status_invitation" class="select2" style="width:100%" required>
      <option value="1" <?= $inspection_detail_data['status_invitation'] == 1 ? 'selected' : '' ?>>Notification
        Activity</option>
      <option value="0" <?= $inspection_detail_data['status_invitation'] == 0 ? 'selected' : '' ?>>Invitation
        Witness
      </option>
    </select>
  </div>
</div>
</div>
<div class="col-md-12"></div>
<div class="col-md-8">
<div class="form-group row">
  <label for="" class="col-xl-3 col-form-label text-muted">Inspection Authority</label>
  <?php
        $inspection_auth_arr = explode(";", $inspection_detail_data['legend_inspection_auth']);
  ?>
  <div class="col-xl">
    <select name="inspection_authority[]" class="select2" style="width:100%" multiple required>
      <option value="0" <?= $inspection_auth_arr[0] == 1 ? 'selected' : '' ?>>Hold Point</option>
      <option value="1" <?= $inspection_auth_arr[1] == 1 ? 'selected' : '' ?>>Witness</option>
      <option value="2" <?= $inspection_auth_arr[2] == 1 ? 'selected' : '' ?>>Monitoring</option>
      <option value="3" <?= $inspection_auth_arr[3] == 1 ? 'selected' : '' ?>>Review</option>
    </select>
  </div>
</div>
</div> -->

        </div>
      <?php } ?> <form method="POST" action="<?= base_url('visual/update_inspection_qc') ?>">
        <div class="overflow-auto media text-muted pt-3 mt-1 border-top border-gray">
          <div class="container-fluid">
            <table class="table table-hover table-bordered">
              <thead class="bg-gray-table">
                <tr>
                  <th class="align-top text-center" rowspan="2">Status Inspection</th>
                  <th class="align-top text-center" rowspan="2">Weld Map No</th>
                  <th class="align-top text-center" rowspan="2">Joint No</th>
                  <th class="align-top text-center" rowspan="2">THK</th>
                  <th class="align-top text-center" rowspan="2">DIA</th>
                  <th class="align-top text-center" rowspan="2">Total Length</th>
                  <th class="align-top text-center" rowspan="2">Length of Weld</th>
                  <th class="align-top text-center" rowspan="2">Welding Date</th>
                  <th class="align-top text-center" rowspan="2">Cons. Lot No</th>
                  <th class="align-top text-center" rowspan="1" colspan="2">WPS</th>
                  <th class="align-top text-center" rowspan="1" colspan="2">Weld Process</th>
                  <th class="align-top text-center" rowspan="1" colspan="2">Welder</th>
                  <th class="align-top text-center" rowspan="2" style="min-width: 100px !important;">QC Remarks</th>
                </tr>
                <tr>
                  <th class="text-center" style="min-width: 200px !important;">R/H</th> <!-- Wps -->
                  <th class="text-center" style="min-width: 200px !important;">F/C</th>

                  <th class="text-center" style="min-width: 200px !important;">R/H</th> <!-- Weld Process -->
                  <th class="text-center" style="min-width: 200px !important;">F/C</th>

                  <th class="text-center" style="min-width: 350px !important;">R/H</th> <!-- Welder -->
                  <th class="text-center" style="min-width: 350px !important;">F/C</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($inspection_detail as $key => $value) { ?>
                  <?php //test_var($value); 
                  ?>
                  <tr>
                    <td class="text-nowrap text-center">
                      <input type="hidden" name="id_visual[<?= $key ?>]" value="<?= $value['id_visual'] ?>">
                    </td>
                    <td class="font-weight-bold"><?= $value['drawing_wm'] ?></td>
                    <td class="font-weight-bold">
                      <?= $value['joint_no'] . $value['revision_category'] . $value['revision'] ?>
                      <!-- <div class="input-group-prepend"> -->
                      <?php if (strlen($image_visual[$value['id_joint']]) > 1) { ?>
                        <a class="btn btn-primary" target="_blank" href="<?= base_url('visual/open_atc_surveypr/') . $image_visual[$value['id_joint']] . '/' . ($value['surveyor_attachment_revision'] ? $value['surveyor_attachment_revision'] : $image_visual[$value['id_joint']]) ?>"><i class="fas fa-camera"></i></a>
                      <?php } ?>
                      <!-- </div>     -->
                    </td>
                    <td class="font-weight-bold"><?= $value['thickness'] ?></td>
                    <td class="font-weight-bold"><?= $value['diameter'] ?></td>
                    <td class="font-weight-bold"><?= $value['length'] ?></td>
                    <td style="min-width: 100px !important;">
                      <input type="number" name="weld_length[<?= $key ?>]" class="form-control" value="<?= intval($value['revision']) > 0 ? $value['length_of_weld'] : $value['weld_length'] ?>" min='1' <?= intval($value['revision']) > 0 ? '' : 'readonly' ?>>
                    </td>
                    <td>
                      <input type="date" class="form-control" name="weld_date[<?= $key ?>]" value="<?= DATE("Y-m-d", strtotime($value['weld_datetime'])) ?>">
                      <input type="time" class="form-control" name="weld_time[<?= $key ?>]" value="<?= DATE("H:i:s", strtotime($value['weld_datetime'])) ?>">
                    </td>
                    <td style="min-width: 150px !important;">
                      <textarea class='form-control' name='cons_lot_no[<?= $key ?>]'><?= $value['cons_lot_no'] ?></textarea>
                    </td>
                    <td>
                      <?php
                      $opsi_wps = $wps_group2[$value['project_code']][$value['discipline']];

                      $opsi_wps_rh[$key][] = "<option value=''>---</option>";
                      $opsi_wps_fc[$key][] = "<option value=''>---</option>";
                      foreach ($opsi_wps as $key_opsi_rh => $value_opsi) {
                        // if($value['wps']){
                        //   if(in_array($value_opsi['id_wps'], explode(";", $value['wps']))){
                        //     $opsi_wps_rh[$key][] = "<option value='".$value_opsi['id_wps']."' ".(in_array($value_opsi['id_wps'], explode(";", $value['wps_no_rh'])) ? 'selected' : '').">".$value_opsi['wps_no']."</option>";
                        //     $opsi_wps_fc[$key][] = "<option value='".$value_opsi['id_wps']."' ".(in_array($value_opsi['id_wps'], explode(";", $value['wps_no_fc'])) ? 'selected' : '').">".$value_opsi['wps_no']."</option>";
                        //   }
                        // } else {
                        $opsi_wps_rh[$key][] = "<option value='" . $value_opsi['id_wps'] . "' " . (in_array($value_opsi['id_wps'], explode(";", $value['wps_no_rh'])) ? 'selected' : '') . ">" . $value_opsi['wps_no'] . "</option>";
                        $opsi_wps_fc[$key][] = "<option value='" . $value_opsi['id_wps'] . "' " . (in_array($value_opsi['id_wps'], explode(";", $value['wps_no_fc'])) ? 'selected' : '') . ">" . $value_opsi['wps_no'] . "</option>";
                        // }
                      }
                      ?>
                      <select style='width: 150px !important' class='form-control select2 form-control wps_select_rh_<?= $key ?>' multiple name='wps_rh[<?= $key ?>][]'>
                        <?php print_r($opsi_wps_rh[$key]); ?>
                      </select>
                    </td>
                    <td>
                      <select style='width: 150px !important' class='form-control select2 form-control wps_select_fc_<?= $key ?>' multiple name='wps_fc[<?= $key ?>][]'>
                        <?php print_r($opsi_wps_fc[$key]); ?>
                      </select>
                    </td>

                    <td>
                      <select class="form-control select2" multiple name="weld_process_rh[<?= $key ?>][]">
                        <option value="">---</option>
                        <!-- <option value="SMAW" <?= in_array('SMAW', explode(";", $value["weld_process_rh"])) ? 'selected' : '' ?>>SMAW</option> -->
                        <option value="GTAW" <?= in_array('GTAW', explode(";", $value["weld_process_rh"])) ? 'selected' : '' ?>>GTAW</option>
                        <option value="GMAW" <?= in_array('GMAW', explode(";", $value["weld_process_rh"])) ? 'selected' : '' ?>>GMAW</option>
                        <option value="SMAW" <?= in_array('SMAW', explode(";", $value["weld_process_rh"])) ? 'selected' : '' ?>>SMAW</option>
                        <option value="FCAW" <?= in_array('FCAW', explode(";", $value["weld_process_rh"])) ? 'selected' : '' ?>>FCAW</option>
                        <option value="SAW" <?= in_array('SAW', explode(";", $value["weld_process_rh"])) ? 'selected' : '' ?>>SAW</option>
                      </select>
                    </td>
                    <td>
                      <select class="form-control select2" multiple name="weld_process_fc[<?= $key ?>][]">
                        <option value="">---</option>
                        <!-- <option value="SMAW" <?= in_array('SMAW', explode(";", $value["weld_process_fc"])) ? 'selected' : '' ?>>SMAW</option> -->
                        <option value="GTAW" <?= in_array('GTAW', explode(";", $value["weld_process_fc"])) ? 'selected' : '' ?>>GTAW</option>
                        <option value="GMAW" <?= in_array('GMAW', explode(";", $value["weld_process_fc"])) ? 'selected' : '' ?>>GMAW</option>
                        <option value="SMAW" <?= in_array('SMAW', explode(";", $value["weld_process_fc"])) ? 'selected' : '' ?>>SMAW</option>
                        <option value="FCAW" <?= in_array('FCAW', explode(";", $value["weld_process_fc"])) ? 'selected' : '' ?>>FCAW</option>
                        <option value="SAW" <?= in_array('SAW', explode(";", $value["weld_process_fc"])) ? 'selected' : '' ?>>SAW</option>
                      </select>
                    </td>

                    <td>
                      <table class="table table-bordered" id="table_rh<?= $key ?>">
                        <thead class="bg-green-smoe text-white">
                          <th>Welder</th>
                          <th class="d-none">Welded Length</th>
                          <th>
                            <span class="btn btn-info" onclick="add_rh(<?= $key ?>, <?= $value['id_visual'] ?>)">
                              <i class="fas fa-plus"></i>
                            </span>
                          </th>
                        </thead>
                        <tbody>
                          <?php foreach ($visual_detail[$value['id_visual']][0] as $key_welder_rh => $value_welder_rh) { ?>
                            <tr class="rh_<?= $value_welder_rh['id_visual_detail_welder'] ?>">
                              <input type="hidden" name="rh_id_visual_detail_welder[<?= $key ?>][<?= $key_welder_rh ?>]" value="<?= $value_welder_rh['id_visual_detail_welder'] ?>">
                              <td><input class="" disabled type="text" name="" value="<?= $master_welder[$value_welder_rh["id_welder"]]['welder_code'] ?>"></td>
                              <td class="d-none"><input class="d-none welders_rh_<?= $key ?>" type="number" name="rh_length_welded[<?= $key ?>][<?= $key_welder_rh ?>]" value="<?= $value_welder_rh["length_welded"] ?>"></td>
                              <td>
                                <span class='btn btn-danger will_enable$key' onclick="removeWelder(<?= $value_welder_rh['id_visual_detail_welder'] ?>, this, 'rh')">
                                  <i class='fas fa-trash'></i>
                                </span>
                              </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </td>
                    <td>
                      <table class="table table-bordered" id="table_fc<?= $key ?>">
                        <thead class="bg-green-smoe text-white">
                          <th>Welder</th>
                          <th class="d-none">Welded Length</th>
                          <th>
                            <span class="btn btn-info" onclick="add_fc(<?= $key ?>, <?= $value['id_visual'] ?>)">
                              <i class="fas fa-plus"></i>
                            </span>
                          </th>
                        </thead>
                        <tbody>
                          <?php foreach ($visual_detail[$value['id_visual']][1] as $key_welder_fc => $value_welder_fc) { ?>
                            <tr class="fc_<?= $value_welder_fc['id_visual_detail_welder'] ?>">
                              <input type="hidden" name="fc_id_visual_detail_welder[<?= $key ?>][<?= $key_welder_fc ?>]" value="<?= $value_welder_fc['id_visual_detail_welder'] ?>">
                              <td><input class="" disabled type="text" name="" value="<?= $master_welder[$value_welder_fc["id_welder"]]['welder_code'] ?>"></td>
                              <td class="d-none"><input class="d-none welders_fc_<?= $key ?>" type="number" name="fc_length_welded[<?= $key ?>][<?= $key_welder_fc ?>]" value="<?= $value_welder_fc["length_welded"] ?>"></td>
                              <td>
                                <span class='btn btn-danger will_enable$key' onclick="removeWelder(<?= $value_welder_fc['id_visual_detail_welder'] ?>, this, 'fc')">
                                  <i class='fas fa-trash'></i>
                                </span>
                              </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </td>

                    <td>
                      <textarea name="remarks[<?= $key ?>]" class="form-control"><?= $value['inspection_remarks'] ?></textarea>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="overflow-auto media text-muted pt-3 mt-1 border-top border-gray">
          <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Update</button>
        </div>
      </form>
  </div>
  <!-- </div> -->

</div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Request for Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo base_url('visual/request_for_update') ?>">
          <div class="form-group">
            <label for="inspector_before">Last Inspector By</label>
            <input type="text" class="form-control" id="inspector_before" value="<?= $user_list[$inspection_detail[0]['inspection_by']]['full_name'] ?>" readonly>
            <input name="inspector_before" type="hidden" value="<?= $inspection_detail[0]['inspection_by'] ?>" readonly>
          </div>
          <div class="form-group">
            <label for="requestor">Request By</label>
            <input type="text" class="form-control" id="requestor" placeholder="" value="<?= $user_list[$user_cookie[0]]['full_name'] ?>" readonly>
            <input name="requestor" type="hidden" value="<?= $user_cookie[0] ?>" readonly>
            <input name="submission_id" type="hidden" value="<?= $inspection_detail[0]['submission_id'] ?>" readonly>
          </div>
          <div class="form-group">
            <label for="reason">Reason</label>
            <textarea class="form-control" id="reason" placeholder="Reasons for update" name="reason"></textarea>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>



</div>

<script type="text/javascript">
  var no = 0;

  function add_rh(key, id_visual) {
    no++;
    var input_length = 0
    var max_length = $("input[name='weld_length[" + key + "]']").val()

    var inputs = $('.welders_rh_' + key);
    for (var i = 0; i < inputs.length; i++) {
      input_length = parseInt(input_length) + parseInt($(inputs[i]).val())
    }

    var html = '<tr class="rh_' + no + '">';
    html += '<td><input type="text" placeholder="Welder Tag" class="auto_rh_' + no + ' form-control will_enable' + key + '" name="welder_rh[' + key + '][]" value="" onfocus="welder_autocomplete_rh(' + no + ', ' + key + ')"></td>'
    html += '<td class="d-none"><input type="number" placeholder="Length Welded" class="form-control will_enable' + key + ' welders_rh_' + key + '" name="length_welded_rh[' + key + '][]" value="0" max="' + (parseInt(max_length) - parseInt(input_length)) + '"></td>'
    html += '<td><span class="btn btn-danger" onclick="delete_rh(' + no + ')"><i class="fas fa-times"></i></span></td>'
    html += '</tr>'
    $('#table_rh' + key).append(html)

    input_length = 0 // RESET LAGI KE 0
  }

  function delete_rh(key) {
    $('.rh_' + key).remove()
  }


  function welder_autocomplete_rh(no, keyes) {
    var wps = $('.wps_select_rh_' + keyes).val();

    $('.auto_rh_' + no).autocomplete({
      source: function(request, response) {
        $.ajax({
          url: '<?php echo base_url(); ?>visual/welder_autocomplete',
          type: 'POST',
          dataType: 'json',
          data: {
            term: request.term,
            company_id: '<?= $inspection_detail[0]['company_id'] ?>',
            wps: wps,
          },
          success: function(data) {
            response(data);
          },
          error: function() {
            Swal.fire('Please Select WPS First', '', 'info');
          }
        });
      },
      autoFocus: true,
      classes: {
        "ui-autocomplete": "highlight"
      },
      select: function(event, ui) {
        $(this).val(ui.item.value);
      },
      change: function(event, ui) {
        if (!ui.item) {
          $(this).val('');
        }
      }
    });
  }

  function add_fc(key, id_visual) {
    no++;
    var input_length = 0
    var max_length = $("input[name='weld_length[" + key + "]']").val()

    var inputs = $('.welders_fc_' + key);
    for (var i = 0; i < inputs.length; i++) {
      input_length = parseInt(input_length) + parseInt($(inputs[i]).val())
    }

    var html = '<tr class="fc_' + no + '">';
    html += '<td><input type="text" placeholder="Welder Tag" class="auto_fc_' + no + ' form-control will_enable' + key + '" name="welder_fc[' + key + '][]" value="" onfocus="welder_autocomplete_fc(' + no + ', ' + key + ')"></td>'
    html += '<td class="d-none"><input type="number" placeholder="Length Welded" class="form-control will_enable' + key + ' welders_fc_' + key + '" name="length_welded_fc[' + key + '][]" value="0" max="' + (parseInt(max_length) - parseInt(input_length)) + '"></td>'
    html += '<td><span class="btn btn-danger" onclick="delete_fc(' + no + ')"><i class="fas fa-times"></i></span></td>'
    html += '</tr>'
    $('#table_fc' + key).append(html)

    input_length = 0 // RESET LAGI KE 0
  }

  function delete_fc(key) {
    $('.fc_' + key).remove()
  }

  function welder_autocomplete_fc(no, keyes) {
    var wps = $('.wps_select_fc_' + keyes).val();

    $('.auto_fc_' + no).autocomplete({
      source: function(request, response) {
        $.ajax({
          url: '<?php echo base_url(); ?>visual/welder_autocomplete',
          type: 'POST',
          dataType: 'json',
          data: {
            term: request.term,
            company_id: '<?= $inspection_detail[0]['company_id'] ?>',
            wps: wps,
          },
          success: function(data) {
            response(data);
          },
          error: function() {
            Swal.fire('Please Select WPS First', '', 'info');
          }
        });
      },
      autoFocus: true,
      classes: {
        "ui-autocomplete": "highlight"
      },
      select: function(event, ui) {
        $(this).val(ui.item.value);
      },
      change: function(event, ui) {
        if (!ui.item) {
          $(this).val('');
        }
      }
    });
  }

  function removeWelder(id_visual_detail_welder, ini, type) {
    var text = "<p> Do you want to <strong class='text-danger'>Delete</strong> the Welder Data? </p>"
    var types = "error"

    Swal.fire({
      type: types,
      title: text,
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: 'Yes',
    }).then((result) => {
      console.log(result)
      if (result.value == true) {
        $.ajax({
          url: "<?= base_url() ?>visual/remove_visual_detail_welder",
          type: "POST",
          data: {
            'id_visual_detail_welder': id_visual_detail_welder,
          },
        })
        Swal.fire('Success!', '', 'success')
        $('.' + type + '_' + id_visual_detail_welder).remove()
      } else {
        Swal.fire('Changes are not saved', '', 'info')
      }
    })
  }

  function required_remarks(no, thiss, con) {
    if (con == 6) {
      console.log('1')
      $('.client_remarks' + no).prop('required', true);
      $('.client_remarks' + no).removeAttr('disabled');
    } else if (con == 2 || con == 4) {
      console.log('2')
      $('.reject_pending_remarks' + no).prop('required', true);
      $('.reject_pending_remarks' + no).prop('disabled', false);
    } else {
      console.log('3')
      $('.client_remarks' + no).removeAttr('required');
      $('.client_remarks' + no).prop('disabled', true);
    }
  }
  $('.dataTable').DataTable({
    order: [],
    columnDefs: [{
      "targets": 0,
      "orderable": false,
    }]
  })
</script>

<script type="text/javascript">
  function openFlow(classnya, thissnya) {
    if (thissnya.checked == true) {
      $('.' + classnya).prop('disabled', false)
    } else {
      $('.' + classnya).prop('disabled', true)
    }
  }

  $(document).ready(function() {
    $(".chooser").select2({
      width: '50%'
    });
    // $(".chooser, ul.select2-selection__rendered").sortable({
    //   containment: 'parent'
    // });
    $(".chooser").on("select2:select", function(evt) {
      var element = evt.params.data.element;
      var $element = $(element);

      $element.detach();
      $(this).append($element);
      $(this).trigger("change");
    });
  });
</script>
<script type="text/javascript">
  function countS(thiss) {
    var anu = $(thiss).select2('data')
    for (let i = 0; i < anu.length; i++) {
      console.log(anu[i])
      var text = $('li:contains("' + anu[i].text + '")').text()
      $('li:contains("' + anu[i].text + '")').text(text.replace(anu[i].text, '(' + (i + 1) + ')' + anu[i].text))
    }

  }
</script>
<script type="text/javascript">
  function setSrc_surve(src) {
    console.log(src)
    $('.src').attr("src", "https://<?= $url_image ?>/pcms_v2_photo/" + src);
    $('#preview_surv').modal('show');
  }
</script>
<script type="text/javascript">
  function approve_request(submission_id, aksi) {
    Swal.fire({
      title: 'Are you sure to Reapproval this Update!',
      text: "This submission will reset to status pending approval!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Update this date!'
    }).then((result) => {

      if (result.value) {
        $.ajax({
          url: "<?= base_url('visual/approve_request/') ?>",
          type: "post",
          data: {
            'submission_id': submission_id,
            'status_revise': aksi,
          },
          success: function(data) {
            Swal.fire(
              'Data Has Been Updated !',
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

<script type="text/javascript">
  function change_date_inspection() {

    var submission_id = $("#submission_id").val();
    var drawing_no_update = $("#drawing_no_update").val();
    var date_request = $("#date_request").val();
    var date_request_from = $("#date_request_from").val();
    var inspection_datetime = $("#inspection_datetime").val();
    var inspection_datetime_from = $("#inspection_datetime_from").val();

    console.log(submission_id + " || " + date_request + " || " + date_request_from + " || " + inspection_datetime + " || " + inspection_datetime_from);

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
          url: "<?= base_url('visual/change_inspection_date/') ?>",
          type: "post",
          data: {
            'submission_id': submission_id,
            'drawing_no': drawing_no_update,
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

  function change_date_inspection_client() {

    var report_number = $("#report_number_update").val();
    var discipline = $("#discipline_update").val();
    var modulex = $("#module_update").val();
    var type_of_module = $("#type_of_module_update").val();
    var company = $("#company_update").val();
    var project_code = $("#project_code_update").val();
    var status_invitation = $("#status_invitation_update").val();
    var legend_inspection_auth = $("#legend_inspection_auth_update").val();
    var postpone_reoffer_no = $("#postpone_reoffer_no_update").val();
    var drawing_no = $("#drawing_no_update").val();
    var company_id = $("#company_id_update").val();

    var date_request = $("#date_request").val();
    var date_request_from = $("#date_request_from").val();
    var inspection_datetime = $("#inspection_datetime").val();
    var inspection_datetime_from = $("#inspection_datetime_from").val();

    Swal.fire({
      title: 'Are you sure to change inspection date?',
      text: "Data will be affected!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Update this date!'
    }).then((result) => {

      if (result.value) {
        $.ajax({
          url: "<?= base_url('visual/change_inspection_date_report/') ?>",
          type: "post",
          data: {
            'report_number': report_number,
            'discipline': discipline,
            'module': modulex,
            'type_of_module': type_of_module,
            'company': company,
            'project_code': project_code,
            'status_invitation': status_invitation,
            'legend_inspection_auth': legend_inspection_auth,
            'postpone_reoffer_no': postpone_reoffer_no,
            'drawing_no': drawing_no,
            'company_id': company_id,
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


  function change_qc_approval() {

    var report_number = $("#report_number_update").val();
    var discipline = $("#discipline_update").val();
    var modulex = $("#module_update").val();
    var type_of_module = $("#type_of_module_update").val();
    var company = $("#company_update").val();
    var project_code = $("#project_code_update").val();
    var status_invitation = $("#status_invitation_update").val();
    var legend_inspection_auth = $("#legend_inspection_auth_update").val();
    var postpone_reoffer_no = $("#postpone_reoffer_no_update").val();
    var drawing_no = $("#drawing_no_update").val();
    var company_id = $("#company_id_update").val();

    var date_request = $("#date_request").val();
    var date_request_from = $("#date_request_from").val();
    var inspection_datetime = $("#inspection_datetime").val();
    var inspection_datetime_from = $("#inspection_datetime_from").val();

    var inspection_by = $("#inspection_by").val();


    Swal.fire({
      title: 'Are you sure to change Inspector Name?',
      text: "Data will be affected!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Update this date!'
    }).then((result) => {

      if (result.value) {
        $.ajax({
          url: "<?= base_url('visual/change_visual_qc_inspector/') ?>",
          type: "post",
          data: {
            'report_number': report_number,
            'discipline': discipline,
            'module': modulex,
            'type_of_module': type_of_module,
            'company': company,
            'project_code': project_code,
            'status_invitation': status_invitation,
            'legend_inspection_auth': legend_inspection_auth,
            'postpone_reoffer_no': postpone_reoffer_no,
            'drawing_no': drawing_no,
            'company_id': company_id,
            'date_request': date_request,
            'date_request_from': date_request_from,
            'inspection_datetime': inspection_datetime,
            'inspection_datetime_from': inspection_datetime_from,
            'inspection_by': inspection_by,
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

  function change_qc_approval_qc() {

    var submission_id_update = $("#submission_id_update").val();
    var drawing_no_update = $("#drawing_no_update").val();
    var inspection_by = $("#inspection_by").val();

    Swal.fire({
      title: 'Are you sure to change Inspector Name?',
      text: "Data will be affected!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Update this date!'
    }).then((result) => {

      if (result.value) {
        $.ajax({
          url: "<?= base_url('visual/change_visual_qc_inspector_qc/') ?>",
          type: "post",
          data: {
            'submission_id': submission_id_update,
            'drawing_no': drawing_no_update,
            'inspection_by': inspection_by,
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
<script type="text/javascript">
  function relod() {
    location.reload()
  }
</script>