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
  <style>
    input[type="checkbox"] {
      transform: scale(1.5);
      /* Scale it to make the checkbox bigger */
      margin-right: 10px;
      /* Space between checkbox and text */
      vertical-align: middle;
      /* Align it properly with text */
    }
  </style>
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

  <?php if ($enable_modify != "client_split_record") : ?>
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
                    <label><?= $enable_modify == 'client' ? 'Report No.' : 'Submission No.' ?></label>
                    <input type="text" class="form-control" name="batch_no_only_view" value="<?= $enable_modify == 'client' ? $reno_view : $inspection_detail[0]['submission_id'] ?>" readonly required="">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Requestor</label>
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

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Date of Offer</label>
                    <input type="date" class="form-control" name="date_of_offer" required="" value="<?= DATE('Y-m-d', strtotime($inspection_detail[0]['date_request'])) ?>" disabled>
                  </div>
                </div>
                <div class="col-md"></div>
              </div>

              <div class="row">
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
              </div>

              <div class="row">
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

                  function changeLocation() {
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
                        area: area,
                        location: location,
                        point: point,
                        identifier: identifier,
                        where: where,
                      },
                      success: function(data) {
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
              </div>

            </div>
            <div class="fl-scrolls fl-scrolls-hidden" data-orientation="horizontal" style="width: 1564px; left: 286px;">
              <div style="width: 1564px;"></div>
            </div>
          </div>
        </div>
        <?php if ($enable_modify == "client_split_record") : ?>
          <form method="POST" action="<?= base_url('visual/split_report/') . $enable_modify ?>">
          <?php else : ?>
            <form method="POST" action="<?= base_url('visual/approval_inspection_qc/') . $enable_modify ?>">
            <?php endif; ?>
            <?php if (in_array(1, $revision_status_inspection) and in_array($revision_detail['status_revise'], [1, 2, 3])) { ?>
              <div class="my-3 p-3 bg-white rounded shadow-sm form-group">
                <h6 class="pb-2 mb-0">Inspection Date Option</h6>
                <hr>
                <input type="hidden" name="status_revise" value="4">
                <div class="row">

                  <div class="col align-middle">
                    <div class="form-check form-check-inline col">
                      <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1" name="ticked_report_date">
                      <input type="hidden" class="form-control" name="submission_id" value="<?= $inspection_detail[0]['submission_id'] ?>">

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

    <?php if ($action != "third_party") : ?>
      <div class="col-md-12">
        <div class="my-3 p-3 bg-white rounded shadow-sm radio-toolbar tab-detail text-center row">
          <div class="btn-group">

            <button type='button' class="btn btn-outline-success" onclick="change_all_button('1','accept')">Approve All</button>

            <?php if (in_array($this->user_cookie[10], array(19, 21)) && in_array($inspection_detail[0]['project_code'], array(19, 21)) && $condition == "client") { ?>
              <button type='button' class="btn btn-outline-success" onclick="change_all_button('1','witness')">Witness All</button>
              <button type='button' class="btn btn-outline-success" onclick="change_all_button('1','review')">Review All</button>


            <?php } ?>
            <button type='button' class="btn btn-outline-danger" onclick="change_all_button('2')">Reject All</button>
            <button type='button' class="btn btn-outline-secondary" onclick="change_all_button('4')">Clear All</button>
          </div>
        </div>
      </div>
    <?php endif; ?>
  <?php endif; ?>

  <?php if ($condition == "client" && $condition == "client_split_record") : ?>
    <div class="col-md-12">
      <div class="my-3 p-3 bg-white rounded shadow-sm radio-toolbar tab-detail text-center row">
        <?php // if ($main_data['company_id'] == 13) : 
        ?>
        <div class="col-md-5">
          <div class="form-group row">
            <label for="" class="col-xl-3 col-form-label text-muted"> Approval Date</label>
            <div class="col-xl">
              <input type="date" id="manual_approval_date" name="manual_approval_date" class="form-control" required>
            </div>
          </div>
        </div>

        <div class="col-md-12"></div>
        <div class="col-md-5">
          <div class="form-group row">
            <label for="" class="col-xl-3 col-form-label text-muted"> Approval Time</label>
            <div class="col-xl">
              <input type="time" name="manual_approval_time" class="form-control" required>
            </div>
          </div>
        </div>
        <?php // endif; 
        ?>
      </div>
    </div>
  <?php endif; ?>


  <script type="text/javascript">
    var inputDate = document.getElementById('manual_approval_date');
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;

    inputDate.setAttribute('max', today);

    function change_all_button(tombol, add_comment) {
      console.log(add_comment);
      var remarks = $('.client_remarks textarea');

      if (tombol == 1 && add_comment == 'accept') {
        $('.approve').prop("checked", true)
        $('.client_remarks').css('display', 'none');
        remarks.prop('required', false).val('')
      } else if (tombol == 1 && add_comment == 'witness') {
        $('.witness').prop("checked", true)
        $('.client_remarks').css('display', 'none');
        remarks.prop('required', false).val('')
      } else if (tombol == 1 && add_comment == 'review') {
        $('.review').prop("checked", true)
        $('.client_remarks').css('display', 'none');
        remarks.prop('required', false).val('')
      } else if (tombol == 2) {
        $('.rejected').prop("checked", true)
        $('.client_remarks').show();
        remarks.prop('required', true);
      } else {
        $('.approve').prop("checked", false)
        $('.witness').prop("checked", false)
        $('.review').prop("checked", false)
        $('.rejected').prop("checked", false)
        $('.client_remarks').css('display', 'none');
        remarks.prop('required', false).val('')
      }
    }
  </script>

  <!-- <div class="col-12"> -->
  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="pb-2 mb-0"><?= $meta_title ?> - <?= $reno_view ?></h6>
    <?php if ($enable_modify == "client_split_record") : ?>
      <form method="POST" action="<?= base_url('visual/split_report/') . $enable_modify ?>">
      <?php else : ?>
        <form method="POST" action="<?= base_url('visual/approval_inspection_qc/') . $enable_modify ?>">
        <?php endif; ?>
        <?php if ($condition == "client_split_record") : ?>
          <div class="text-muted pt-3 mt-1 border-top border-gray">
            <div class="col-md-8 mt-2">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted">Transmit By</label>
                <div class="col-xl">
                  <select name="transmittal_by" class="select2" style="width: 100%" required>
                    <option value="">---</option>
                    <?php foreach ($user_list as $key => $value) : ?>
                      <option value="<?= $value['id_user'] ?>" <?= $value['id_user'] == $inspection_detail_data['transmittal_by'] ? "selected" : "" ?>><?= $value['full_name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-12"></div>
            <?php
            $transmit_date = explode(' ', $inspection_detail_data['transmittal_datetime']);
            ?>
            <div class="col-md-8">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted">Transmit Date</label>
                <div class="col-xl">
                  <input type="date" name="transmittal_date" class="form-control" value="<?= $transmit_date[0] ?>" required>
                </div>
              </div>
            </div>
            <div class="col-md-12"></div>
            <div class="col-md-8">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted">Inspect Time</label>
                <div class="col-xl">
                  <input type="time" name="transmittal_time" class="form-control" value="<?= $transmit_date[1] ?>" required>
                </div>
              </div>
            </div>
            <div class="col-md-12"></div>
            <div class="col-md-8">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted">Invitation Type</label>
                <div class="col-xl">
                  <select name="status_invitation" class="select2" style="width:100%" required onchange="validateTrans(this)">
                    <option>---</option>
                    <option value="0" <?= $inspection_detail_data['status_invitation'] == 0 ? "selected" : "" ?>>Invitation Witness</option>
                    <option value="1" <?= $inspection_detail_data['status_invitation'] == 1 ? "selected" : "" ?>>Notification Activity</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-12"></div>

            <?php $text_legend = explode(';', $inspection_detail_data['legend_inspection_auth']) ?>
            <div class="col-md-8">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted">Legend Inspection Authority AS PER ITP</label>
                <div class="col-xl">
                  <select name="legend_inspection_auth[]" class="form-control select2" style="width:100%" required multiple="">
                    <option value="1" <?= in_array('1', $text_legend) ? "selected" : "" ?>>Hold Point</option>
                    <option value="2" <?= in_array('2', $text_legend) ? "selected" : "" ?>>Witness</option>
                    <option value="3" <?= in_array('3', $text_legend) ? "selected" : "" ?>>Monitoring</option>
                    <option value="4" <?= in_array('4', $text_legend) ? "selected" : "" ?>>Review</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-12"></div>
            <div class="col-md-8">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted">GA/AS Revision No.</label>
                <div class="col-md-2">
                  <select name="document_rev_no" class="form-control select2" style="width:100%" required onchange="changeLink(this)">
                    <?php foreach ($revision_gaas as $key => $value) { ?>
                      <option value="<?= $value ?>"><?= $value ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted"></label>
                <div class="col-md-8">
                  <a href="<?= $link_revision_gaas[0]['link'] ?>" class="gaas_link"><?= $link_revision_gaas[0]['drawing_no'] . ' Rev. ' . $link_revision_gaas[0]['revision_no'] ?></a>
                </div>
                <script type="text/javascript">
                  function changeLink(thiss) {
                    var revi = $(thiss).val()
                    console.log(revi)

                    $(".gaas_link").attr("href", "<?= $link_revision_gaas[0]['link_buntung'] ?>" + revi)
                    $(".gaas_link").text("<?= $link_revision_gaas[0]['drawing_no'] ?> Rev. " + revi)
                  }
                </script>
              </div>
            </div>

            <div class="col-md-12"></div>
            <div class="col-md-8">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted">Weld Map Revision No.</label>
                <div class="col-md-2">
                  <select name="weld_map_rev_no" class="form-control select2" style="width:100%" required onchange="changeLinkWM(this)">
                    <?php foreach ($revision_weldmap as $key => $value) { ?>
                      <option value="<?= $value ?>"><?= $value ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <?php //test_var($link_revision_weldmap); 
              ?>
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted"></label>
                <div class="col-md-8">
                  <a href="<?= $link_revision_weldmap[0]['link'] ?>" class="wm_link"><?= $link_revision_weldmap[0]['drawing_no'] . ' Rev. ' . $link_revision_weldmap[0]['revision_no'] ?></a>
                </div>
                <script type="text/javascript">
                  function changeLinkWM(thiss) {
                    var revi = $(thiss).val()
                    console.log(revi)

                    $(".wm_link").attr("href", "<?= $link_revision_weldmap[0]['link_buntung'] ?>" + revi)
                    $(".wm_link").text("<?= $link_revision_weldmap[0]['drawing_no'] ?> Rev. " + revi)
                  }
                </script>
              </div>
            </div>

            <div class="col-md-12"></div>
            <div class="col-md-8">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted">Remarks</label>
                <div class="col-xl">
                  <textarea name="invitation_remarks" class="form-control"></textarea>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <div class="overflow-auto media text-muted pt-3 mt-1 border-top border-gray">
          <div class="container-fluid">
            <table class="table table-hover">
              <thead class="bg-gray-table">
                <tr>
                  <?php if ($condition == "client_split_record") { ?>
                    <th class="align-middle text-center" rowspan="2">#</th>
                  <?php  } ?>
                  <?php if ($condition != "client_split_record") { ?>
                    <th class="align-middle text-center" rowspan="2">Status Inspection</th>
                  <?php  } ?>
                  <th class="align-middle text-center" rowspan="2">Weld Map No</th>
                  <th class="align-middle text-center" rowspan="2">Joint No</th>
                  <th class="align-middle text-center" rowspan="2">THK</th>
                  <th class="align-middle text-center" rowspan="2">DIA</th>
                  <th class="align-middle text-center" rowspan="2">Total Length</th>
                  <th class="align-middle text-center" rowspan="2">Length of Weld</th>
                  <th class="align-middle text-center" rowspan="2">Welding Date</th>
                  <th class="align-middle text-center" rowspan="2">Cons. Lot No</th>
                  <th class="align-middle text-center" rowspan="1" colspan="2">WPS</th>
                  <th class="align-middle text-center" rowspan="1" colspan="2">Welder</th>
                  <th class="align-middle text-center" rowspan="2">QC Remarks</th>
                </tr>
                <tr>
                  <th class="text-center">R/H</th> <!-- Wps -->
                  <th class="text-center">F/C</th>

                  <th class="text-center">R/H</th> <!-- Welder -->
                  <th class="text-center">F/C</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($inspection_detail as $key => $value) {
                  // test_var($value);
                ?>
                  <tr>
                    <td class="font-weight-bold text-center">
                      <?php if ($condition == "client_split_record") { ?>
                        <div class="custom-control custom-checkbox mr-sm-2">
                          <input type="checkbox" name="id_split[<?= $key ?>]" value="<?= $value['id_visual'] ?>"> <!-- Id Visual -->

                          <!-- End data main -->
                          <input type="input" hidden name="total_data_visual" value="<?= count($inspection_detail) ?>">
                          <input hidden type="input" name="discipline" value="<?= $value['discipline'] ?>">
                          <input hidden type="input" name="module" value="<?= $value['module'] ?>">
                          <input hidden type="input" name="type_of_module" value="<?= $value['type_of_module'] ?>">
                          <input hidden type="input" name="project_code" value="<?= $value['project_code'] ?>">
                          <input hidden type="input" name="company_id" value="<?= $value['company_id'] ?>">
                          <input hidden type="input" name="deck_elevation" value="<?= $value['deck_elevation'] ?>">

                          <!-- End to get data -->
                          <input type="input" hidden name="total_data_joint" value="<?= count($inspection_detail) ?>">
                          <input hidden type="input" name="report_number[<?= $key ?>]" value="<?= $value['report_number'] ?>">
                          <input hidden type="input" name="drawing_no[<?= $key ?>]" value="<?= $value['drawing_no'] ?>">
                          <input hidden type="input" name="joint_no[<?= $key ?>]" value="<?= $value['id_joint'] ?>">
                          <input hidden type="input" name="thickness[<?= $key ?>]" value="<?= $value['thickness'] ?>">
                          <input hidden type="input" name="diameter[<?= $key ?>]" value="<?= $value['diameter'] ?>">
                          <input hidden type="input" name="length_of_weld[<?= $key ?>]" value="<?= ($value['revision'] > 0 ? $value['length_of_weld'] : $value['weld_length']) ?>">
                          <input hidden type="date" name="weld_date[<?= $key ?>]" value="<?= DATE("Y-m-d", strtotime($value['weld_datetime'])) ?>">
                          <input hidden type="time" name="weld_time[<?= $key ?>]" value="<?= DATE("H:i:s", strtotime($value['weld_datetime'])) ?>">
                          <input hidden type="input" name="cons_lot_no[<?= $key ?>]" value="<?= $value['cons_lot_no'] ?>">
                          <input hidden type="input" name="wps_no_rh[<?= $key ?>]" value="<?= $value['wps_no_rh'] ?>">
                          <input hidden type="input" name="wps_no_fc[<?= $key ?>]" value="<?= $value['wps_no_fc'] ?>">
                          <input hidden type="input" name="id_joint[<?= $key ?>]" value="<?= $value['id_joint'] ?>">
                          <?php foreach ($visual_detail[$value['id_visual']][0] as $key_welder_rh => $value_welder_rh) { ?>
                            <input hidden type="input" name="welder_rh[<?= $key ?>]" value="<?= $master_welder[$value_welder_rh["id_welder"]]['id_welder'] ?>">
                            <!-- <td><input disabled class="" hidden type="number" name="" value="<?= $value_welder_rh["length_welded"] ?>"></td> -->
                          <?php } ?>
                          <?php foreach ($visual_detail[$value['id_visual']][1] as $key_welder_fc => $value_welder_fc) { ?>
                            <input hidden type="input" name="welder_fc[<?= $key ?>]" value="<?= $master_welder[$value_welder_fc["id_welder"]]['id_welder'] ?>">

                          <?php } ?>
                          <input hidden type="input" name="remarks[<?= $key ?>]" value="<?= $value['inspection_remarks'] ?>">
                        </div>
                      <?php  } ?>
                      <?php if ($condition != "client_split_record") { ?>
                        <?php if ($value['status_inspection'] == 1) { // APPROVAL 
                        ?>
                          <input type="hidden" name="id_visual[<?= $key ?>]" value="<?= $value['id_visual'] ?>">
                          <div class="form-check form-check-inline text-success">
                            <input class="form-check-input approve" id="app_<?= $key ?>" type="radio" name="approve[<?= $key ?>]" value="3" style="width: 17px; height: 17px">
                            <label class="form-check-label"><b>Approve</b></label>
                          </div><br>

                          <div class="form-check form-check-inline text-danger">
                            <input class="form-check-input rejected" id="rjct_<?= $key ?>" type="radio" name="approve[<?= $key ?>]" value="2" style="width: 17px; height: 17px">
                            <label class="form-check-label"><b>Reject</b></label>
                          </div><br>
                          <?php } else {
                          if ($value['status_inspection'] == 3 or ($value['status_inspection'] == 7 and $condition == 'qc')) { ?>
                            <span class='badge badge-success'>Approved</span><br />
                            <small style="font-style: italic;"><?= $user_list[$value['inspection_by']]['full_name'] ?></small>
                            <br>
                            <small style="font-style: italic;"><?= $value['inspection_datetime'] ?></small>
                            <br /><span style='font-size=5px !important;'><b>Inspector Remarks :</b><br /><?= $value["inspection_remarks"] ?></span>
                          <?php
                          }
                          if ($value['status_inspection'] == 7 and $condition != 'qc') { ?>
                            <?php //test_var($value) 
                            ?>

                            <?php if ($value['status_inspection'] == 7 && $value['add_comment'] == 1) { ?>
                              <span class='badge badge-success'>Approved</span><br />
                            <?php } else if ($value['status_inspection'] == 7 && $value['add_comment'] == 2) { ?>
                              <span class='badge badge-success'>Witnessed</span><br />
                            <?php } else { ?>
                              <span class='badge badge-success'>Reviewed</span><br />
                            <?php } ?>

                            <small style="font-style: italic;"><?= $user_list[$value['inspection_client_by']]['full_name'] ?></small>
                            <br>
                            <small style="font-style: italic;"><?= $value['inspection_client_datetime'] ?></small>
                            <br />
                          <?php
                          }
                          if ($value['status_inspection'] == 2) { ?>
                            <span class='badge badge-danger'>Rejected</span><br />
                            <small style="font-style: italic;"><?= $user_list[$value['inspection_by']]['full_name'] ?></small>
                            <br>
                            <small style="font-style: italic;"><?= $value['inspection_datetime'] ?></small>
                            <br /><span style='font-size=5px !important;'><b>Inspector Remarks :</b><br /><?= $value["inspection_remarks"] ?></span>
                          <?php // APPROVAL
                          }
                          if ($value['status_inspection'] == 5 and  $user_cookie[7] == 8) { ?>
                            <input type="hidden" name="id_visual[<?= $key ?>]" value="<?= $value['id_visual'] ?>">

                            <div class="form-check form-check-inline text-success">
                              <input class="form-check-input approve" id="app_<?= $key ?>" type="radio" name="approve[<?= $key ?>]" value="7" style="width: 17px; height: 17px" onclick="change_single_button(this, '<?= $key ?>')"> <label class="form-check-label"><b>Approve</b></label>
                            </div><br>

                            <?php if (in_array($this->user_cookie[10], array(19, 21)) && in_array($inspection_detail[0]['project_code'], array(19, 21))) { ?>

                              <div class="form-check form-check-inline text-success">
                                <input class="form-check-input witness" id="witness_<?= $key ?>" type="radio" name="approve[<?= $key ?>]" value="witness" style="width: 17px; height: 17px" onclick="change_single_button(this, '<?= $key ?>')"> <label class="form-check-label"><b>Witness</b></label>
                              </div><br>

                              <div class="form-check form-check-inline text-success">
                                <input class="form-check-input review" id="review_<?= $key ?>" type="radio" name="approve[<?= $key ?>]" value="review" style="width: 17px; height: 17px" onclick="change_single_button(this, '<?= $key ?>')"> <label class="form-check-label"><b>Review</b></label>
                              </div><br>

                            <?php } ?>


                            <div class="form-check form-check-inline text-danger">
                              <input class="form-check-input rejected" id="rjct_<?= $key ?>" type="radio" name="approve[<?= $key ?>]" value="6" style="width: 17px; height: 17px" onclick="change_single_button(this, '<?= $key ?>')">
                              <label class="form-check-label"><b>Reject</b></label>
                            </div><br>
                            <span class='client_remarks' id="clnt_rmks_<?php echo $key; ?>" style='display: none;'>
                              Client Remarks : <br />
                              <textarea name='client_remarks[<?php echo $key; ?>]' placeholder="---"></textarea>
                            </span>
                          <?php
                          }

                          if ($value['status_inspection'] == '9') { ?>
                            <span class='badge badge-primary'>Approved & Released With Comment</span><br />
                            <small style="font-style: italic;"><?= $user_list[$value['inspection_client_by']]['full_name'] ?></small>
                            <br>
                            <small style="font-style: italic;"><?= $value['inspection_client_datetime'] ?></small>
                            <br /><span style='font-size=5px !important;'><b>Client Remarks :</b><br /><?= $value["client_remarks"] ?></span>
                          <?php
                          }
                          if ($value['status_inspection'] == '10') { ?>
                            <span class='badge badge-info'>Postponed</span><br />
                            <small style="font-style: italic;"><?= $user_list[$value['inspection_client_by']]['full_name'] ?></small>
                            <br>
                            <small style="font-style: italic;"><?= $value['inspection_client_datetime'] ?></small>
                            <br /><span style='font-size=5px !important;'><b>Client Remarks :</b><br /><?= $value["client_remarks"] ?></span>
                          <?php
                          }
                          if ($value['status_inspection'] == '11') { ?>
                            <span class='badge badge-warning'>Re-offer</span><br />
                            <small style="font-style: italic;"><?= $user_list[$value['inspection_client_by']]['full_name'] ?></small>
                            <br>
                            <small style="font-style: italic;"><?= $value['inspection_client_datetime'] ?></small>
                            <br /><span style='font-size=5px !important;'><b>Client Remarks :</b><br /><?= $value["client_remarks"] ?></span>
                          <?php
                          }
                          if ($value['status_inspection'] == '12') { ?>
                            <span class='badge badge-secondary'>Void</span><br />
                          <?php
                          }
                          if ($value['status_inspection'] == '8') { ?>
                            <span class='badge badge-warning'>Request for Update</span><br />
                          <?php
                          } else if ($value['status_inspection'] == '6') { ?>
                            <span class='badge badge-danger'>Reject</span><br />
                            <small style="font-style: italic;"><?= $user_list[$value['inspection_client_by']]['full_name'] ?></small>
                            <br>
                            <small style="font-style: italic;"><?= $value['inspection_client_datetime'] ?></small>
                            <br /><span style='font-size=5px !important;'><b>Client Remarks :</b><br /><?= $value["client_remarks"] ?></span>
                        <?php
                          }
                        }
                        ?>
                    </td>
                  <?php  } ?>
                  <td class="font-weight-bold text-center"><?= $value['drawing_wm'] . '<br>' . (!empty($value['spool_no']) ? 'Spool No : ' . $value['spool_no'] : '') ?></td>
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
                  <td>
                    <input width="100%" type="number" disabled name="" class="" value="<?= ($value['revision'] > 0 ? $value['length_of_weld'] : $value['weld_length']) ?>">
                  </td>
                  <td>
                    <input type="date" disabled class="form-control" name="" value="<?= DATE("Y-m-d", strtotime($value['weld_datetime'])) ?>">
                    <input type="time" disabled class="form-control" name="" value="<?= DATE("H:i:s", strtotime($value['weld_datetime'])) ?>">
                  </td>

                  <td>
                    <?= $value['cons_lot_no'] ?>
                  </td>

                  <td>
                    <?php
                    $wps = explode(";", $value['wps_no_rh']);
                    foreach ($wps as $key_wps => $value_wps) {
                      echo $master_wps[$value_wps]['wps_no'] . '<br>';
                    }
                    // $master_wps[$value['wps_no_rh']]['wps_no']; 
                    ?>
                  </td>
                  <td>
                    <?php
                    $wps = explode(";", $value['wps_no_fc']);
                    foreach ($wps as $key_wps => $value_wps) {
                      echo $master_wps[$value_wps]['wps_no'] . '<br>';
                    }
                    // $master_wps[$value['wps_no_fc']]['wps_no']; 
                    ?>
                  </td>

                  <td>
                    <table class="table table-bordered">
                      <thead class="bg-green-smoe text-white">
                        <th>Welder</th>
                        <!-- <th>Welded Length</th> -->
                      </thead>
                      <tbody>
                        <?php foreach ($visual_detail[$value['id_visual']][0] as $key_welder_rh => $value_welder_rh) { ?>
                          <tr>
                            <td><input disabled class="" type="text" name="" value="<?= $master_welder[$value_welder_rh["id_welder"]]['welder_code'] ?>"></td>
                            <!-- <td><input disabled class="" type="number" name="" value="<?= $value_welder_rh["length_welded"] ?>"></td> -->
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </td>
                  <td>
                    <table class="table table-bordered">
                      <thead class="bg-green-smoe text-white">
                        <th>Welder</th>
                        <!-- <th>Welded Length</th> -->
                      </thead>
                      <tbody>
                        <?php foreach ($visual_detail[$value['id_visual']][1] as $key_welder_fc => $value_welder_fc) { ?>
                          <tr>
                            <td><input disabled class="" type="text" name="" value="<?= $master_welder[$value_welder_fc["id_welder"]]['welder_code'] ?>"></td>
                            <!-- <td><input disabled class="" type="number" name="" value="<?= $value_welder_fc["length_welded"] ?>"></td> -->
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
        <div class="col-md-12">
          <hr>
          <div></div>
          <div class="text-right">

            <?php if (($enable_modify == 'client' || $this->permission_cookie[240] == 1) and in_array(5, array_column($inspection_detail, 'status_inspection'))) { ?>

              <a href="#" class="btn btn-primary" id="btnApprovedwcomment"><i class="fas fa-history"></i> Approved &amp; Released With Comment</a>
              <a href="#" class="btn btn-info" id="btnPostponed"><i class="fas fa-history"></i> Postponed</a>
              <a href="#" class="btn btn-warning" id="btnReoffer"><i class="fas fa-history"></i> Re-Offer</a>
              &nbsp;&nbsp;
            <?php } ?>
            <?php
            $wmat = MAX(array_column($inspection_detail, 'transmit_wm_rev'));
            if ($wmat != '') {
              $transmit_wm_rev = $wmat;
            } else {
              $transmit_wm_rev = MAX(array_merge(array_column($inspection_detail, 'transmit_wm_rev'), array_column($inspection_detail, 'rev_wm_template')));
            }
            // test_var($transmit_wm_rev);
            ?>
            <?php
            $links_atc = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($drawing_val_2[$inspection_detail[0]['drawing_wm']]['id']), '+=/', '.-~') . '/' . $transmit_wm_rev . '/1e0e7b33a7be53e7c9957eb27914726c8df5a3127a78009723415681dce804ee076d678b2f809f42b8417bf8007fec6d58455b4beae15f6a17e384122be4fe71kbm4o296X67afS9s6puvP6qvwqy7y8TaO5sgWrvULiU-';
            $links_atc_cross = base_url_ftp_eng() . "public_smoe/open_atc_cross/2/" . strtr($this->encryption->encrypt($inspection_detail[0]['drawing_wm']), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt($drawing_val_2[$inspection_detail[0]['drawing_wm']]['id']), '+=/', '.-~') . '/' . $transmit_wm_rev . '/1e0e7b33a7be53e7c9957eb27914726c8df5a3127a78009723415681dce804ee076d678b2f809f42b8417bf8007fec6d58455b4beae15f6a17e384122be4fe71kbm4o296X67afS9s6puvP6qvwqy7y8TaO5sgWrvULiU-';
            ?>

            <a target="_blank" href="<?= $links_atc ?>" class="btn btn-primary" title="Attachment"> <i class="fas fa-paperclip"></i> Open Drawing (WM)</a>
            <a target="_blank" href="<?= $links_atc_cross ?>" class="btn btn-green-smoe text-white mr-5" title="Attachment" download="2013J310008-41-SPS-0010-0051-ISO-0001.pdf">
              <i class="fas fa-cloud-download-alt"></i> Download Drawing (WM)
            </a>

            <?php
            $url_back = base_url() . 'visual/client_rfi_serverside';
            if ($action == "third_party") {
              $url_back = base_url() . 'visual/third_party_list';
            }
            ?>
            <a href="<?= $url_back ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
            <a href="<?= base_url('visual/visual_client_rfi/') . ($inspection_detail[0]['report_number'] != '' ? $inspection_detail[0]['report_number'] . '/client/' . $inspection_detail[0]['drawing_no'] . '/' . (int)$inspection_detail[0]['postpone_reoffer_no'] : $inspection_detail[0]['submission_id'] . '/qc/' . $inspection_detail[0]['drawing_no'] . '/' . (int)$inspection_detail[0]['postpone_reoffer_no'])  ?>" target="_blank"><button class="btn btn-success" type="button"><i class="fas fa-file-pdf"></i> RFI</button></a>
            <a href="<?= base_url('visual/visual_pdf/') .
                        ($inspection_detail[0]['report_number'] != '' ? $inspection_detail[0]['report_number'] . '/client/' . $inspection_detail[0]['drawing_no'] . '/' . (int)$inspection_detail[0]['postpone_reoffer_no'] : $inspection_detail[0]['submission_id'] . '/qc/' . $inspection_detail[0]['drawing_no'] . '/' . (int)$inspection_detail[0]['postpone_reoffer_no'])
                      ?>" target="_blank"><button class="btn btn-danger" type="button"><i class="fas fa-file-pdf"></i> Report</button></a>

            <?php if ($action == "third_party") : ?>
              <?php if ($inspection_detail[0]['third_party_approval_status'] == 0) : ?>
                <button onclick="sign_document(this, 'third_party')" type="button" class="btn btn-success"><i class="fas fa-check"> </i> Sign This Document <strong>(Third Party)</strong></button>
              <?php endif; ?>

            <?php else : ?>
              <?php if ($enable_modify == "client_split_record") { ?>
                <button type="submit" class="btn btn-primary" name="tombol_submit" value="Split"><i class="fas fa-save"></i> Split</button>
                <button type="submit" class="btn btn-warning" name="tombol_submit" value="Return"><i class="fas fa-undo"></i> Return</button>
              <?php } else { ?>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
              <?php } ?>

            <?php endif; ?>

            <?php if ($user_permission[41] == 1 and in_array(1, array_column($inspection_detail, "status_inspection"))) { ?>
              <?php if (!in_array($revision_detail['status_revise'], [1, 2, 3])) { ?>
                <badge name="submit_visual" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-edit"></i> Request for Update</badge>
              <?php } ?>
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

<div class="modal fade" id="modalPostponed" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>visual/process_postpone_reapproval" method="POST">
        <div class="modal-header">
          <h4 class="modal-title">Postponed RFI</h4>
        </div>
        <div class="modal-body">
          <b><i>Postpone - Remarks :</i></b> <br />
          <input type="hidden" name="status_inspection" value="10">
          <input type="hidden" name="drawing_no" value="<?php echo $inspection_detail[0]['drawing_no']; ?>">
          <input type="hidden" name="discipline" value="<?php echo $inspection_detail[0]['discipline']; ?>">
          <input type="hidden" name="module" value="<?php echo $inspection_detail[0]['module']; ?>">
          <input type="hidden" name="type_of_module" value="<?php echo $inspection_detail[0]['type_of_module']; ?>">
          <input type="hidden" name="report_number" value="<?php echo $inspection_detail[0]['report_number']; ?>">
          <textarea name='remarks' placeholder="---" class='form-control'></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="modalReoffer" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>visual/process_postpone_reapproval" method="POST">
        <div class="modal-header">
          <h4 class="modal-title">Re-Offer RFI</h4>
        </div>
        <div class="modal-body">
          <b><i>Re-Offer - Remarks :</i></b> <br />
          <input type="hidden" name="status_inspection" value="11">
          <input type="hidden" name="drawing_no" value="<?php echo $inspection_detail[0]['drawing_no']; ?>">
          <input type="hidden" name="discipline" value="<?php echo $inspection_detail[0]['discipline']; ?>">
          <input type="hidden" name="module" value="<?php echo $inspection_detail[0]['module']; ?>">
          <input type="hidden" name="type_of_module" value="<?php echo $inspection_detail[0]['type_of_module']; ?>">
          <input type="hidden" name="report_number" value="<?php echo $inspection_detail[0]['report_number']; ?>">
          <textarea name='remarks' placeholder="---" class='form-control'></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="modalApprovedwcomment" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>visual/process_postpone_reapproval" method="POST">
        <div class="modal-header">
          <h4 class="modal-title">Acc. with Comment RFI</h4>
        </div>
        <div class="modal-body">
          <b><i>Accepted & Released With Comment - Remarks :</i></b> <br />
          <input type="hidden" name="status_inspection" value="9">
          <input type="hidden" name="drawing_no" value="<?php echo $inspection_detail[0]['drawing_no']; ?>">
          <input type="hidden" name="discipline" value="<?php echo $inspection_detail[0]['discipline']; ?>">
          <input type="hidden" name="module" value="<?php echo $inspection_detail[0]['module']; ?>">
          <input type="hidden" name="type_of_module" value="<?php echo $inspection_detail[0]['type_of_module']; ?>">
          <input type="hidden" name="report_number" value="<?php echo $inspection_detail[0]['report_number']; ?>">
          <textarea name='remarks' placeholder="---" class='form-control'></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>Close</button>
        </div>
      </form>
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
            <textarea class="form-control" id="reason" placeholder="Reason for update" name="reason"></textarea>
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

  function change_single_button(ini, key) {
    var mode = $(ini).val()
    var remarks = $('#clnt_rmks_' + key + ' textarea');

    if (mode == '6') {

      $('#clnt_rmks_' + key).show();
      remarks.prop('required', true);

    } else {
      $('#clnt_rmks_' + key).css('display', 'none');
      remarks.prop('required', false).val('')
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
  function relod() {
    location.reload()
  }
  $(document).ready(function() {
    $("#btnApprovedwcomment").click(function() {
      $("#modalApprovedwcomment").modal();
    });
    $("#btnPostponed").click(function() {
      $("#modalPostponed").modal();
    });
    $("#btnReoffer").click(function() {
      $("#modalReoffer").modal();
    });
  })

  function sign_document(btn) {
    Swal.fire({
      type: "warning",
      title: "Are You Sure to Sign This Document ?",
      html: "<i>You Will Not Able to Revert After Signing it !!</i>",
      showCancelButton: true,

    }).then((res) => {
      if (res.value) {
        $.ajax({
          url: "<?= site_url('visual/additional_sign_visual') ?>",
          type: "POST",
          data: {
            report_number: "<?= $inspection_detail[0]['report_number'] ?>",
            drawing_no: "<?= $inspection_detail[0]['drawing_no'] ?>",
            postpone_reoffer_no: "<?= $inspection_detail[0]['postpone_reoffer_no'] ?>",
          },
          dataType: "JSON",
          success: (data) => {
            if (data.success) {
              Swal.fire({
                type: "success",
                title: data.message,
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


  function removeDisable(id_visual) {
    console.log(id_visual);

    console.log($(".cb_visual_" + id_visual))

    if ($(".cb_visual_" + id_visual)[0].checked == true) {
      $('.id_visual_' + id_visual).removeAttr('disabled');

      $('.select2_' + id_visual).select2({
        theme: 'bootstrap'
      })

      $('.fc_required_' + id_visual).prop('required', true);
      selecteds++
    } else {
      $('.id_visual_' + id_visual).prop('disabled', true);
      $('.fc_required_' + id_visual).prop('required', false);
      selecteds--
    }

    if (selecteds > 300) {
      Swal.fire({
        type: "warning",
        title: "Warning",
        text: "Only 300 Data Allowed In Each Submission"
      })
      $(".submit_btn").prop('disabled', true);
    } else {
      $(".submit_btn").show();
      $(".submit_btn").removeAttr('disabled');
    }

    $("#thicked b").text(' ' + selecteds)
  }
</script>