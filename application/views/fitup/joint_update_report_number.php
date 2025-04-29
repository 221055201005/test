<?php
$fitup = $joint_list[0];
//print_r($fitup);exit;
?>
<style type="text/css">
  .table {
    font-size: 100% !important;
    padding: 2px !important;
  }

  .select2-container {
    font-size: 70% !important;
    width: 100px !important;
    height: 20px !important;
  }

  .select2 {
    width: 100% !important;
  }
</style>
<script>
  $(function() {
    $("#datepicker").datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });
    $("#datepicker_1").datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });
    $("#datepicker_2").datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });
  });
</script>
<div id="content" class="container-fluid">

  <form method="POST" action="<?php echo base_url(); ?>fitup/proses_update_report_number" id='form_submition'>
    <input type="hidden" name="deck_elevation" value="<?= $fitup['deck_elevation'] ?>">
    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Update Data - Inspection</h6>

          </div>
          <div class="card-body bg-white overflow-auto">



            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label>Drawing No</label>
                  <input type="text" class="form-control" name="drawing_no" value="<?php echo $fitup['drawing_no'] ?>" readonly>
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label>Discipline</label>
                  <input type="text" class="form-control" name="discipline_view" value="<?php echo (isset($discipline_name[$fitup['discipline']]) ? $discipline_name[$fitup['discipline']] : '-') ?>" readonly>
                  <input type="hidden" class="form-control" name="discipline" value="<?php echo $fitup['discipline']; ?>" readonly>
                  <input type="hidden" class="form-control" name="project" value="<?php echo $fitup['project_code']; ?>" readonly>
                  <input type="hidden" class="form-control" name="company_id" value="<?php echo $fitup['company_id']; ?>" readonly>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label>Module</label>
                  <input type="text" class="form-control" name="module_view" value="<?php echo (isset($module_code[$fitup['module']]) ? $module_code[$fitup['module']] : '-') ?>" readonly>
                  <input type="hidden" class="form-control" name="module" value="<?php echo $fitup['module']; ?>" readonly>
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label>Type Of Module</label>
                  <input type="text" class="form-control" name="type_of_module_view" value="<?php echo (isset($type_of_module_name[$fitup['type_of_module']]) ? $type_of_module_name[$fitup['type_of_module']] : '-') ?>" readonly>
                  <input type="hidden" class="form-control" name="type_of_module" value="<?php echo $fitup['type_of_module']; ?>" readonly>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label>Requestor Company</label>
                  <input type="text" class="form-control" name="company" value="<?php echo $fitup['company'] ?>" readonly>
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label>Report Number</label>
                  <?php
                  $array_user_allowed = array(1, 1000367, 1000129);
                  if ($fitup['discipline'] == 1 && in_array($this->user_cookie[0], $array_user_allowed)) {
                  ?>
                    <input type="hidden" class="form-control" name="report_number_old" max='999999' value="<?php echo $joint_list[0]["report_number"] ?>">
                    <input type="number" class="form-control" name="report_number" max='999999' value="<?php echo (int)$joint_list[0]["report_number"] ?>">
                  <?php } else { ?>
                    <input type="hidden" class="form-control" name="report_number_old" max='999999' value="<?php echo $joint_list[0]["report_number"] ?>" readonly>
                    <input type="text" class="form-control" name="report_number" max='999999' value="<?php echo $joint_list[0]["report_number"] ?>" readonly>
                  <?php } ?>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label>Requestor Name</label>
                  <input type="text" class="form-control" name="requestor" value="<?php echo $user_list[$fitup['requestor']] ?>" readonly>
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label>Area</label>
                  <select class="select2 select_area" id='mySelect' disabled>
                    <?php foreach ($area_list as $key => $value) : ?>
                      <option value="<?= $value['id'] ?>" <?= $value['id'] == $fitup['area'] ? 'selected' : '' ?>><?= $value['area_name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label>Request Date</label>
                  <input type="text" id="datepicker" class="form-control" name="date_request" value="<?php echo date('Y-m-d', strtotime($joint_list[0]["date_request"])) ?>">
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label>Inspection Date</label>
                  <input type="text" id="datepicker_1" class="form-control" name="inspection_datetime" value="<?php echo date('Y-m-d', strtotime($joint_list[0]["inspection_datetime"])) ?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label>QC Approval By</label>
                  <select name="inspection_by" class="select2" style="width: 100%" required>
                    <option value="">---</option>
                    <?php foreach ($user_list_inspector as $key => $value) : ?>
                      <option value="<?= $value['id_user'] ?>" <?= $value['id_user'] == $joint_list[0]["inspection_by"] ? "selected" : null ?>><?= $value['full_name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label>Transmitted Date</label>
                  <input type="text" id="datepicker_2" class="form-control" name="transmitted_date" value="<?php echo date('Y-m-d', strtotime($joint_list[0]["transmitted_date"])) ?>">
                </div>
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label>Update Remarks</label>
                  <textarea name='latest_update_remarks' class='form-control' placeholder='Remarks For Update' required><?php echo $joint_list[0]["latest_update_remarks"]; ?></textarea>
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
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
            <h6 class="m-0">Drawing Rev Update List</h6>
          </div>
          <div class="card-body bg-white overflow-auto">

            <div class="col-md-12"></div>
            <div class="col-md-8">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted">Drawing GA/AS - Rev No : </label>
                <div class="col-xl">
                  <input type='hidden' name='drawing_no' value='<?= $joint_list[0]['drawing_no'] ?>'>
                  <input type='hidden' name='drawing_wm_transmitted' value='<?= $joint_list[0]['drawing_wm'] ?>'>
                  <select name="drawing_rev_no_new" class="select2" style="width:100%" onchange='append_drawing_links(this,0)'>
                    <option value="">~ Choice ~</option>
                    <?php foreach ($list_revision_ga_as as $key => $value) { ?>
                      <option value='<?= $value ?>' <?= ($joint_list[0]["drawing_rev_no"] == $value ? "selected" : null) ?>><?= $value ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-12"></div>
            <div class="col-md-8">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted"></label>
                <div class="col-xl">
                  <span class='add_drawing_ga_as'>-</span>
                </div>
              </div>
            </div>

            <div class="col-md-12"></div>
            <div class="col-md-8">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted">Drawing Weld Map - Rev No : </label>
                <div class="col-xl">
                  <select name="drawing_wm_rev_approved_new" class="select2" style="width:100%" onchange='append_drawing_links(this,1)'>
                    <option value="">~ Choice ~</option>
                    <?php foreach ($list_revision_wm as $key => $value) { ?>
                      <option value='<?= $value ?>' <?= ($joint_list[0]["drawing_wm_rev_approved"] == $value ? "selected" : null) ?>><?= $value ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-12"></div>
            <div class="col-md-8">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted"></label>
                <div class="col-xl">
                  <span class='add_drawing_ga_wm'>-</span>
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
            <h6 class="m-0">Inspection Detail</h6>
          </div>
          <div class="card-body bg-white overflow-auto">

            <div class="col-md-12"></div>
            <div class="col-md-8">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted">RFI Inspection date</label>
                <div class="col-xl">
                  <input type="date" name="inspect_date" class="form-control" value="<?= date('Y-m-d', strtotime($main_data['time_inspect'])) ?>" required>
                </div>
              </div>
            </div>
            <div class="col-md-12"></div>
            <div class="col-md-8">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted">RFI Inspection Time</label>
                <div class="col-xl">
                  <input type="time" name="inspect_time" class="form-control" value="<?= date('H:i', strtotime($main_data['time_inspect'])) ?>" required>
                </div>
              </div>
            </div>

            <div class="col-md-12"></div>
            <div class="col-md-8">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted">Transmittal date</label>
                <div class="col-xl">
                  <input type="date" name="transmittal_date" class="form-control" value="<?= date('Y-m-d', strtotime($main_data['transmitted_date'])) ?>" required>
                </div>
              </div>
            </div>
            <div class="col-md-12"></div>
            <div class="col-md-8">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted">Transmittal Time</label>
                <div class="col-xl">
                  <input type="time" name="transmittal_time" class="form-control" value="<?= date('H:i', strtotime($main_data['transmitted_date'])) ?>" required>
                </div>
              </div>
            </div>

            <!-- <div class="col-md-12"></div>
            <div class="col-md-8">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted">Invitation Type</label>
                <div class="col-xl">
                  <select name="status_invitation" class="select2" style="width:100%" required>
                    <option value="1" <?= $main_data['status_invitation'] == 1 ? 'selected' : '' ?>>Notification
                      Activity</option>
                    <option value="0" <?= $main_data['status_invitation'] == 0 ? 'selected' : '' ?>>Invitation
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
                $inspection_auth_arr = explode(";", $main_data['legend_inspection_auth']);
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
        </div>
      </div>
    </div>

    <input type="hidden" class="form-control" name="submission_id" value="<?php echo $joint_list[0]['submission_id'] ?>" required readonly>
    <input type="hidden" class="form-control" name="discipline_save" value="<?php echo $joint_list[0]['discipline'] ?>" required readonly>
    <input type="hidden" class="form-control" name="module_save" value="<?php echo $joint_list[0]['module'] ?>" required readonly>
    <input type="hidden" class="form-control" name="type_of_module_save" value="<?php echo $joint_list[0]['type_of_module'] ?>" required readonly>
    <input type="hidden" class="form-control" name="report_number_save" value="<?php echo $joint_list[0]['report_number'] ?>" required readonly>

    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Joint Number List</h6>
          </div>
          <div class="card-body bg-white overflow-auto">

            <table class="table table-hover text-center overflow-auto dataTable">
              <thead class="bg-gray-table">
                <tr>
                  <th style="width: 100px !important;max-width: 100px !important;">#</th>
                  <th style="width: 260px !important;">Weld Map Drawing Number</th>
                  <th style="width: 50px !important;">Joint No</th>
                  <!-- <th style="width: 155px !important;">Part ID</th>
                  <th style="width: 190px !important;">Unique ID Number</th>
                  <th style="width: 80px !important;">Heat Number</th>
                  <th style="width: 95px !important;">Material Grade</th> -->
                  <th style="width: 15px !important;">Thk<br />(mm)</th>
                  <th style="width: 15px !important;">Dia<br />(inch)</th>
                  <th style="width: 15px !important;">Weld<br />Length<br />(mm)</th>
                  <th style="width: 120px !important;">WPS No</th>

                  <th style="width: 200px !important;">Remarks</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 0;
                $no_pending = 0;
                foreach ($joint_list as $key => $value) : ?>
                  <?php
                  if ($value['status_inspection'] == '1') {
                    $no_pending++;
                  }

                  if ($value['status_inspection'] == '5') {
                    $no_pending++;
                  }
                  ?>

                  <tr>
                    <td style="text-align: left !important;">
                      <center>
                        <input type="hidden" name="id_fitup[<?php echo $no ?>]" value="<?php echo $value['id_fitup']; ?>">
                        <input type='checkbox' name='submit_id[<?php echo $no; ?>]' onclick='open_disabled_form(this,"<?php echo $no; ?>","<?php echo $value['status_inspection']; ?>")'>
                        <input type='hidden' name='filter_check[<?php echo $no; ?>]' value='0'>
                      </center>
                    </td>
                    <td>
                      <?php
                      if ($value['status_inspection'] >= 5 && isset($value['drawing_wm_approved'])) {
                        echo $value['drawing_wm_approved'] . ' Rev.' . $value['drawing_wm_rev_approved'] . ' (' . $client_doc_no[$value['drawing_wm_approved']] . ')';
                      } else {
                        $text = ($value['drawing_wm']) . " Rev." . ($value['rev_wm']) . " (" . ($client_doc_no[$value['drawing_wm']]) . ")";
                        echo $text;
                      }
                      ?>
                    </td>
                    <td><?php echo $value['joint_no'] ?></td>
                    <!-- <td><span class='badge'><?php echo $value['pos_1'] ?></span><hr/><span class='badge'><?php echo $value['pos_2'] ?></span></td>
                  <td>
                    <?php
                    echo "<span class='badge badge-primary'>" . $warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no'] . "</span>";
                    ?>
                    <hr/>
                    <?php
                    echo "<span class='badge badge-primary'>" . $warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no'] . "</span>";
                    ?>                   
                  </td>
                  <td>
                    <?php
                    if (isset($status_piecemark[$value['pos_1']]['id_mis'])) {
                      echo $warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['heat_or_series_no'];
                    } else {
                      echo "-";
                    }
                    ?>
                    <hr/>
                    <?php
                    if (isset($status_piecemark[$value['pos_2']]['id_mis'])) {
                      echo $warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['heat_or_series_no'];
                    } else {
                      echo "-";
                    }
                    ?>
                  </td>
                  <td>
                    <span class='badge'>
                    <?php
                    if (isset($status_piecemark[$value['pos_1']]['id_mis'])) {
                      echo $material_grade[$status_piecemark[$value['pos_1']]['grade']]['material_grade'];
                    } else {
                      echo "-";
                    }
                    ?>
                    </span>
                    <hr/>
                    <span class='badge'>
                     <?php
                      if (isset($status_piecemark[$value['pos_2']]['id_mis'])) {
                        echo $material_grade[$status_piecemark[$value['pos_2']]['grade']]['material_grade'];
                      } else {
                        echo "-";
                      }
                      ?>
                    </span>
                  </td> -->
                    <td><?php echo $value['thickness'] ?></td>
                    <td><?php echo $value['diameter'] ?></td>
                    <td><?php echo $value['weld_length'] ?></td>
                    <td>
                      <select class='form-control select2' name='wps_no[<?php echo $no; ?>]' required disabled>
                        <option value="">---</option>
                        <?php
                        foreach ($wps_list as $key => $value_f) {
                          echo "<option value='" . $value_f['id_wps'] . "'" . ($value['wps_no'] == $value_f['id_wps'] ? "selected" : null) . ">" . $value_f['wps_no'] . "</option>";
                        }
                        ?>
                      </select>
                    </td>

                    <td>
                      <textarea name='remarks[<?php echo $no; ?>]' placeholder="---" disabled><?php echo $value["remarks"]; ?></textarea>
                      <?php
                      if (isset($value["pending_qc_remarks"]) and $value['status_inspection'] == '4') {
                        echo "<br/><span style='font-size:12px !important;'><b>Inspector Remarks :</b><br/>" . $value["pending_qc_remarks"] . "</span>";
                      }
                      ?>
                    </td>

                  </tr>
                <?php $no++;
                endforeach; ?>
              </tbody>
            </table>

            <div class="text-right mt-3">
              <!-- <a href='<?php echo  base_url(); ?>fitup/pdf_files_client/<?php echo strtr($this->encryption->encrypt($joint_list[0]['project_code']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['discipline']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['module']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['type_of_module']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['report_number']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['company_id']), '+=/', '.-~'); ?>' target='_blank'><button class='btn btn-primary' type="button"><i class="fas fa-file-pdf"></i> RFI</button></a>
                  <a href='<?php echo  base_url(); ?>fitup/pdf_files/<?php echo strtr($this->encryption->encrypt($joint_list[0]['project_code']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['discipline']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['module']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['type_of_module']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['report_number']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['company_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['company_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['company_id']), '+=/', '.-~'); ?>/<?= encrypt($joint_list[0]['deck_elevation']) ?>' target='_blank'><button class='btn btn-danger' type="button"><i class="fas fa-file-pdf"></i> Report</button></a>    -->

              <button type="submit" name="submit" class="btn btn-success" title="Submit">Submit</button>
            </div>



          </div>
        </div>
      </div>
    </div>
  </form>


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

</div>
</div>


<script type="text/javascript">
  $(document).ready(function() {

    $(".select2_multiple_fitter").select2({
      tokenSeparators: [',', ' '],
      ajax: {
        url: "<?php echo base_url(); ?>fitup/get_fitter_ajax",
        type: "post",
        dataType: 'json',
        data: function(params) {
          var query = {
            search: params.term
          }
          return query;
        },
        processResults: function(data) {
          return {
            results: data
          }
        }
      }
    })

    $(".select2_multiple_welder").select2({
      tokenSeparators: [',', ' '],
      ajax: {
        url: "<?php echo base_url(); ?>fitup/get_welder_ajax_version2",
        type: "post",
        dataType: 'json',
        data: function(params) {
          var query = {
            search: params.term
          }
          return query;
        },
        processResults: function(data) {
          return {
            results: data
          }
        }
      }
    })

    $(".select2_multiple_wps").select2({
      tokenSeparators: [',', ' '],
      ajax: {
        url: "<?php echo base_url(); ?>fitup/get_wps_ajax_version2",
        type: "post",
        dataType: 'json',
        data: function(params) {
          var query = {
            search: params.term
          }
          return query;
        },
        processResults: function(data) {
          return {
            results: data
          }
        }
      }
    })

  });

  $('.dataTable').DataTable({
    "paging": false,

  })

  $("select[name=module]").chained("select[name=project]");

  function change_all_button(mode) {

    $(".approve").removeAttr("checked");
    $(".rejected").removeAttr("checked");
    $(".pending").removeAttr("checked");
    $('.reject_remarks').css('display', 'none');
    $('.pending_remarks').css('display', 'none');

    if (mode == '1') {

      console.log(mode);

      $(".approve").attr("checked", "checked");
      $(".rejected").removeAttr("checked");
      $(".pending").removeAttr("checked");

      $('.reject_remarks').css('display', 'none');
      $('.pending_remarks').css('display', 'none');

    } else if (mode == '2') {
      console.log(mode);
      $(".rejected").attr("checked", "checked");
      $(".approve").removeAttr("checked");
      $(".pending").removeAttr("checked");

      $('.reject_remarks').show();
      $('.pending_remarks').css('display', 'none');

    } else if (mode == '3') {

      $(".pending").attr("checked", "checked");
      $(".approve").removeAttr("checked");
      $(".rejected").removeAttr("checked");

      $('.pending_remarks').show();
      $('.reject_remarks').css('display', 'none');

    } else if (mode == '6') {
      console.log(mode);
      $(".rejected").attr("checked", "checked");
      $(".approve").removeAttr("checked");
      $(".pending").removeAttr("checked");

      $('.client_remarks').show();

    } else if (mode == '7') {

      $(".approve").attr("checked", "checked");
      $(".rejected").removeAttr("checked");

      $('.client_remarks').css('display', 'none');

    } else {

      $(".approve").removeAttr("checked");
      $(".rejected").removeAttr("checked");
      $(".pending").removeAttr("checked");

      $('.reject_remarks').css('display', 'none');
      $('.pending_remarks').css('display', 'none');
      $('.client_remarks').css('display', 'none');

    }

  }

  function change_single_button(mode, no) {

    $("#app_" + no).removeAttr("checked");
    $("#rjct_" + no).removeAttr("checked");
    $("#pdg_" + no).removeAttr("checked");

    $('#rjct_rmks_' + no).css('display', 'none');
    $('#pdg_rmks_' + no).css('display', 'none');

    if (mode == '1') {

      $("#app_" + no).attr("checked", "checked");
      $("#rjct_" + no).removeAttr("checked");
      $("#pdg_" + no).removeAttr("checked");

      $('#rjct_rmks_' + no).css('display', 'none');
      $('#pdg_rmks_' + no).css('display', 'none');

    } else if (mode == '2') {

      $("#rjct_" + no).attr("checked", "checked");
      $("#app_" + no).removeAttr("checked");
      $("#pdg_" + no).removeAttr("checked");

      $('#rjct_rmks_' + no).show();
      $('#pdg_rmks_' + no).css('display', 'none');

    } else if (mode == '3') {

      $("#pdg_" + no).attr("checked", "checked");
      $("#rjct_" + no).removeAttr("checked");
      $("#app_" + no).removeAttr("checked");

      $('#pdg_rmks_' + no).show();
      $('#rjct_rmks_' + no).css('display', 'none');

    } else if (mode == '6') {

      $("#rjct_clnt_" + no).removeAttr("checked");
      $("#app_clnt_" + no).removeAttr("checked");

      $('#clnt_rmks_' + no).show();

    } else if (mode == '7') {

      $("#rjct_clnt_" + no).removeAttr("checked");
      $("#app_clnt_" + no).removeAttr("checked");

      $('#clnt_rmks_' + no).css('display', 'none');

    }

  }


  function request_for_update(btn, submission_id) {
    var url = "<?= site_url('fitup/request_for_update/') ?>" + submission_id;
    $("#modal").modal({
      show: true,
      keyboard: false,
      backdrop: "static"
    }).find('.modal-body').load(url)
    $('.modal-title').text("Request For Update")
    $('.modal-dialog').addClass('modal-lg')
  }


  function change_area(event) {
    let area = event.value;

    Swal.fire({
      type: "warning",
      title: "Update Area",
      text: "Are You Sure To Update This Area ? ",
      allowOutsideClick: false,
      showCancelButton: true
    }).then((res) => {
      if (res.value) {
        $.ajax({
          url: "<?= site_url('fitup/update_area') ?>",
          type: "POST",
          data: {
            area: area,
            submission_id: "<?= $joint_list[0]['submission_id'] ?>"
          },
          dataType: "JSON",
          success: function(data) {
            if (data.success) {
              Swal.fire({
                type: "success",
                title: "Success",
                text: "Success Update Area",
                timer: 1000
              })
              // location.reload();
            }
          }
        })
      } else {}
    })

  }

  function open_disabled_form(val, no, status_inspection) {

    var $checkboxes = $('#form_submition td input[type="checkbox"]');
    $checkboxes.change(function() {
      if ($(val).prop("checked") == true) {
        $('select[name="fitter_id[' + no + '][]"]').prop("disabled", false);
        $('select[name="wps_no[' + no + ']"]').prop("disabled", false);
        $('textarea[name="remarks[' + no + ']"]').prop("disabled", false);
        $('input[name="filter_check[' + no + ']"]').val(1);
      } else {
        $('select[name="fitter_id[' + no + '][]"]').prop("disabled", true);
        $('select[name="wps_no[' + no + ']"]').prop("disabled", true);
        $('textarea[name="remarks[' + no + ']"]').prop("disabled", true);
        $('input[name="filter_check[' + no + ']"]').val(0);
      }
    });

  }

  function append_drawing_links(rev, drawing_type) {

    var rev_oke = $(rev).val();

    if (drawing_type == 0) {
      $(".add_drawing_ga_as").text("");
      var links = "<?= base_url_ftp_eng() ?>public_smoe/open_atc/2/<?= strtr($this->encryption->encrypt(@$activity_eng[@$joint_list[0]['drawing_no']]['id']), '+=/', '.-~') ?>/" + rev_oke;
      $(".add_drawing_ga_as").append('<a target="_blank" href="' + links + '"><?= @$joint_list[0]['drawing_no'] ?> (Rev. ' + rev_oke + ')</a>');
    } else if (drawing_type == 1) {
      $(".add_drawing_ga_wm").text("");
      var links = "<?= base_url_ftp_eng() ?>public_smoe/open_atc/2/<?= strtr($this->encryption->encrypt(@$activity_eng[@$joint_list[0]['drawing_wm']]['id']), '+=/', '.-~') ?>/" + rev_oke;
      $(".add_drawing_ga_wm").append('<a target="_blank" href="' + links + '"><?= @$joint_list[0]['drawing_wm'] ?> (Rev. ' + rev_oke + ')</a>');
    }


  }
</script>