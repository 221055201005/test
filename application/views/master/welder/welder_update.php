<style>
  th {
    vertical-align: middle !important;
  }

  /* .select2 {
    width: 150px !important;
  } */

  .select2_company {
    width: 200px !important;
  }

  .c {
    position: relative;
  }

  .input_width {
    width: 400px;
  }
</style>

<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card rounded-0 shadow-sm">
          <div class="card-header">
            <h6 class="m-0"> Welder Update</h6>
          </div>
          <div class="card-body">
            <form action="<?= site_url('master/welder/welder_update_process') ?>" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive overflow-auto">
                    <table class="table text-center">
                      <thead class="bg-gray-table">
                        <th>Welder Code</th>
                        <!-- <th>Client Code</th> -->
                        <th>Company</th>
                        <th>Project</th>
                        <th>Welder Badge</th>
                        <th>QR Badge</th>
                        <th>Welder Name</th>
                        <th>Discipline</th>
                        <th width="30%">Requirement</th>
                        <th>Welder WPS</th>

                        <th width="10%">Status</th>
                        <th>NDT of The Validity<br />(6 Months)<br />1</th>
                        <th>NDT of The Validity<br />(6 Months)<br />2</th>
                        <th>NDT of The Validity<br />(6 Months)<br />3</th>
                      </thead>
                      <?php $no = 1;
                      foreach ($welder_list as $key => $value) : ?>

                        <input type="hidden" name="id_welder_main[<?php echo $no; ?>]" id="id_welder_main[<?php echo $no; ?>]" value="<?php echo $value['id_welder']; ?>">

                        <tr>

                          <td class="align-middle">
                            <input type='text' name='welder_code[<?php echo $no; ?>]' class="form-control input_width" value='<?php echo $value["welder_code"] ?>' id="welder_no[<?php echo $no; ?>]" onblur="check_welder(<?php echo $no; ?>)" required>
                            <span id="text_alert_welder<?php echo $no; ?>"></span>
                            <input type="hidden" id="no_detail_row<?php echo $no; ?>" name="no_detail_row[<?php echo $no; ?>]" value="<?php echo sizeof($welder_detail_list[$value["id_welder"]]); ?>">
                          </td>

                          <!-- <td class="align-middle">
                            <input type='text' name='rwe_code[<?php echo $no; ?>]' class="form-control input_width" value='<?php echo $value["rwe_code"] ?>' id="rwe_code[<?php echo $no; ?>]" required>
                          </td> -->

                          <td class="align-middle">
                            <select class="custom-select input_width select2_company" name="company[<?php echo $no; ?>]" required>
                              <option value="">---</option>
                              <?php foreach ($company_list as $key => $company_val) { ?>
                                <option value='<?php echo $company_val['id_company']; ?>' <?= ($value["company_id"] == $company_val['id_company'] ? "selected" : "") ?>><?php echo $company_val['company_name']; ?></option>
                              <?php } ?>
                            </select>
                          </td>

                          <td class="align-middle">
                            <select id="project_id<?php echo $no; ?>" class="custom-select input_width discipline" name="project_id[<?php echo $no; ?>]" required>
                              <option value="">---</option>
                              <?php foreach ($project_list as $project_val) : ?>
                                <option value="<?= $project_val['id'] ?>" <?php if ($value["project_id"] == $project_val['id']) { ?> selected <?php } ?>><?= $project_val['project_name'] ?></option>
                              <?php endforeach; ?>
                            </select>
                          </td>

                          <td class="align-middle">
                            <input type="text" class="form-control input_width" name="welder_badge[<?php echo $no; ?>]" placeholder="Input Welder Badge" value='<?php echo $value["welder_badge"] ?>' id="welder_badge[<?php echo $no; ?>]" onblur="check_welder_badge(<?php echo $no; ?>)" required>
                            <span id="text_alert_welder_badge<?php echo $no; ?>"></span>
                          </td>

                          <td class="align-middle">
                            <input type="text" class="form-control input_width" name="bank_data_badge[<?php echo $no; ?>]" placeholder="Input Welder Badge" value='<?php echo $value["bank_data_badge"] ?>' required>
                          </td>

                          <td class="align-middle">
                            <input type="text" class="form-control input_width" name="welder_name[<?php echo $no; ?>]" placeholder="Input Welder Name" value='<?php echo $value["welder_name"] ?>' required>
                          </td>

                          <td class="align-middle">
                            <select id="discipline<?php echo $no; ?>" class="custom-select input_width discipline" name="discipline[<?php echo $no; ?>]" required>
                              <option value="">---</option>
                              <?php foreach ($discipline_list as $v) : ?>
                                <option value="<?= $v['id'] ?>" <?= $v['id'] == $value['discipline'] ? 'selected' : '' ?>><?= $v['discipline_name'] ?></option>
                              <?php endforeach; ?>
                            </select>
                          </td>

                          <td class="align-middle">
                            <center>

                              <table class="table table-borderless">
                                <tbody id='row_detail'>
                                  <?php $nod = 1; ?>
                                  <?php foreach ($welder_detail_list[$value["id_welder"]] as $k => $v) { ?>

                                    <tr>
                                      <td>


                                        <table class="table table-borderless" style='border-collapse:collapse;border: 1px solid #cccccc;padding:10px;'>
                                          <tr>
                                            <th>
                                              <center>Welder Process</center>
                                            </th>
                                            <th style="width:90px !important;">
                                              <center>Welder Position</center>
                                            </th>
                                            <th style="width:90px !important;">
                                              <center>F Number</center>
                                            </th>
                                            <th>
                                              <center>Welder Certificate</center>
                                            </th>
                                          </tr>
                                          <tr>
                                            <td>
                                              <input type="hidden" name="id_req[<?php echo $no; ?>][]" value="<?php echo $v['id_welder_detail']; ?>">
                                              <select class="custom-select input_width" name="welder_process[<?php echo $no; ?>][]" required>
                                                <option value="">---</option>
                                                <?php foreach ($welder_process_list as $key => $w_process) { ?>
                                                  <option value='<?php echo $w_process['id']; ?>' <?php if ($w_process["id"] == $v['welder_process']) { ?> selected <?php } ?>><?php echo $w_process['name_process']; ?></option>
                                                <?php } ?>
                                              </select>
                                            </td>
                                            <td>
                                              <select class="custom-select input_width select2_multiple_position" name="welder_position[<?php echo $no; ?>][<?php echo $nod; ?>][]" required multiple>
                                                <option value="">---</option>
                                                <?php
                                                $weld_position_arr = explode(",", $v['welder_position']);
                                                ?>

                                                <?php foreach ($master_req['welder_position'] as $d) : ?>
                                                  <option value="<?= $d['value'] ?>" <?= in_array($d['value'], $weld_position_arr) ? 'selected' : '' ?>><?= $d['value'] ?></option>
                                                <?php endforeach; ?>
                                              </select>
                                            </td>
                                            <td>
                                              <select class="custom-select input_width select2_multiple_fno" name="f_no[<?php echo $no; ?>][<?php echo $nod; ?>][]" required multiple>
                                                <option value="">---</option>
                                                <?php
                                                $welder_fnumber_display = explode(",", $v['f_no']);
                                                ?>
                                                <?php foreach ($master_req['f_no'] as $d) : ?>
                                                  <option value="<?= $d['value'] ?>" <?= in_array($d['value'], $welder_fnumber_display) ? 'selected' : '' ?>><?= $d['value'] ?></option>
                                                <?php endforeach; ?>
                                                ?>
                                              </select>
                                            </td>
                                            <td class="align-middle">
                                              <center>
                                                <table>
                                                  <?php if (isset($v['attachment'])) { ?>
                                                    <tr>
                                                      <td>
                                                        <center>
                                                          <!-- <a href='https://www.smoebatam.com/pcms_v2_photo/welder_file/<?php echo $v["attachment"]; ?>'>File Certificate</i></a><br/><br/> -->
                                                          <?php
                                                          $enc_redline = strtr($this->encryption->encrypt($v["attachment"]), '+=/', '.-~');
                                                          $enc_path    = strtr($this->encryption->encrypt('/PCMS/pcms_v2/welder_attachment/'), '+=/', '.-~');
                                                          ?>
                                                          <a target='_blank' href='<?= site_url('irn/open_file/' . $enc_redline . '/' . $enc_path) ?>'><span class='btn btn-primary'><i class="fas fa-images"></i> File</span></a><br />
                                                          <br />
                                                        </center>
                                                      </td>
                                                      <td>
                                                        <center>
                                                          <button type="button" class="btn btn-danger btn-sm" onclick="delete_detail_attachment(this, '<?php echo $v['id_welder_detail']; ?>','<?php echo $v['attachment']; ?>')"><i class="fas fa-trash-alt"></i></button>
                                                        </center>
                                                      </td>
                                                    </tr>
                                                  <?php } ?>
                                                  <tr>
                                                    <td colspan="2">
                                                      <input type="file" name="attachment_detail[<?php echo $no; ?>][]">
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <th>
                                                      <span class='c'>Class Of Material</span>
                                                    </th>

                                                  </tr>
                                                  <tr>
                                                    <td>
                                                      <span class='c'>
                                                        <select id="cwm<?php echo $no; ?>" class="custom-select input_width cwm" name="cwm[<?php echo $no; ?>][]" required>
                                                          <option value="">---</option>
                                                          <?php foreach ($master_req['cwm'] as $d) : ?>
                                                            <option value="<?= $d['value'] ?>" <?= $d['value'] ==  $v['cwm'] ? 'selected' : '' ?>> <?= $d['value'] ?></option>
                                                          <?php endforeach; ?>
                                                        </select>
                                                      </span>
                                                    </td>


                                                  </tr>
                                                </table>
                                              </center>
                                            </td>

                                          </tr>
                                        </table>
                                        <table class="table table-borderless" style='border-collapse:collapse;border: 1px solid #cccccc;padding:10px;'>
                                          <tr>
                                            <th>
                                              <center>Position Range Qualification</center>
                                            </th>
                                            <th>
                                              <center>Diameter Range</center>
                                            </th>
                                            <th>
                                              <center>Thickness Range</center>
                                            </th>
                                            <th>
                                              <center>Backing</center>
                                            </th>
                                          </tr>
                                          <tr>
                                            <td>
                                              <select class="custom-select input_width" name="position_range[<?php echo $no; ?>][]" required>
                                                <option value="">---</option>
                                                <?php foreach ($master_req['position_range'] as $d) : ?>
                                                  <option value="<?= $d['value'] ?>" <?= $d['value'] == $v['position_range'] ? 'selected' : '' ?>> <?= $d['value'] ?></option>
                                                <?php endforeach; ?>

                                              </select>
                                            </td>
                                            <td>
                                              <select class="custom-select input_width" name="diameter_range[<?php echo $no; ?>][]" required>
                                                <option value="">---</option>

                                                <?php foreach ($master_req['diameter_range'] as $d) : ?>
                                                  <option value='<?= $d['value'] ?>' <?= $d['value'] == $v['diameter_range'] ? 'selected' : '' ?>> <?= $d['value'] ?></option>
                                                <?php endforeach; ?>

                                              </select>
                                            </td>
                                            <td>
                                              <select class="custom-select input_width" name="thickness_range[<?php echo $no; ?>][]" required>
                                                <option value="">---</option>

                                                <?php foreach ($master_req['thickness_range'] as $d) : ?>
                                                  <option value="<?= $d['value'] ?>" <?= $d['value'] ==  $v['thickness_range'] ? 'selected' : '' ?>> <?= $d['value'] ?></option>
                                                <?php endforeach; ?>

                                              </select>
                                            </td>
                                            <td>
                                              <select class="custom-select input_width" name="backing[<?php echo $no; ?>][]" required>
                                                <option value="">---</option>
                                                <?php foreach ($master_req['backing'] as $d) : ?>
                                                  <option value="<?= $d['value'] ?>" <?= $d['value'] ==  $v['backing'] ? 'selected' : '' ?>> <?= $d['value'] ?></option>
                                                <?php endforeach; ?>
                                              </select>
                                            </td>
                                          </tr>
                                        </table>

                                        <table class="table table-borderless" style='border-collapse:collapse;border: 1px solid #cccccc;padding:10px;'>
                                          <tr>
                                            <th>
                                              <center>Validity Start Date</center>
                                            </th>
                                            <th>
                                              <center>Validity End Date</center>
                                            </th>
                                          </tr>
                                          <tr>
                                            <td>
                                              <input type="date" value="<?= $v['validity_start_date'] ?>" class="form-control form-control-sm" name="validity_start_date[<?= $no ?>][]">
                                            </td>
                                            <td>
                                              <input type="date" value="<?= $v['validity_end_date'] ?>" class="form-control form-control-sm" name="validity_end_date[<?= $no ?>][]">
                                            </td>
                                          </tr>
                                        </table>

                                      </td>
                                      <td>
                                        <?php if ($nod == 1) { ?>
                                          <button type="button" class="btn btn-primary btn-sm" onclick="add_row_attachment_2(this, <?php echo $no; ?>, sessionStorage.nodata)"><i class="fas fa-plus-circle"></i></button>
                                        <?php } else { ?>
                                          <button type="button" class="btn btn-danger btn-sm" onclick="delete_detail_welder(this, <?php echo $v['id_welder_detail']; ?>)"><i class="fas fa-trash-alt"></i></button>
                                        <?php } ?>
                                      </td>

                                    </tr>
                                  <?php $nod++;
                                  } ?>
                                </tbody>
                              </table>

                            </center>
                          </td>

                          <td class="align-middle">
                            <select class="custom-select input_width select2" name="wps_welder[<?= $no ?>][]" multiple required>
                              <option value="">---</option>
                              <?php foreach ($wps_list as $k => $v) : ?>
                                <?php 
                                  
                                  $arr_wps_welder = explode(";", $value['wps_welder'])
                                  
                                ?>
                                <option value="<?= $v['id_wps'] ?>" <?= in_array($v['id_wps'], $arr_wps_welder) ? 'selected' : '' ?>><?= $v['wps_no'] ?></option>
                              <?php endforeach; ?>
                            </select>
                          </td>

                          <td class="align-middle">
                            <select id="status_actived<?php echo $no; ?>}" class="custom-select input_width" name="status_actived[<?php echo $no; ?>]" required>
                              <option value="">---</option>
                              <?php foreach ($master_req['status_actived'] as $d) : ?>
                                <option value="<?= $d['value'] ?>" <?= $d['value'] ==  $value['status_actived'] ? 'selected' : '' ?>> <?= $d['display_text'] ?></option>
                              <?php endforeach; ?>

                            </select>
                            <br /> Affected On Date : </br>
                            <input type="date" class="form-control input_width" name="non_active_date[<?php echo $no; ?>]" placeholder="Choice Date" value='<?php echo date("Y-m-d", strtotime($value['non_active_date'])) ?>' required>
                          </td>

                          <td class="align-middle">
                            <center>
                              <table>
                                <?php if (isset($value['ndt_val_1'])) { ?>
                                  <tr>
                                    <td>
                                      <center>
                                        <!-- <a href='https://www.smoebatam.com/pcms_v2_photo/welder_file/ndt_validity/<?php echo $value["ndt_val_1"]; ?>'>File Certificate</i></a><br/><br/> -->
                                        <?php
                                        $enc_redline = strtr($this->encryption->encrypt($value["ndt_val_1"]), '+=/', '.-~');
                                        $enc_path    = strtr($this->encryption->encrypt('/PCMS/pcms_v2/welder_attachment/ndt_validity/'), '+=/', '.-~');
                                        ?>
                                        <a target='_blank' href='<?= site_url('irn/open_file/' . $enc_redline . '/' . $enc_path) ?>'><span class='btn btn-primary'><i class="fas fa-images"></i> File</span></a><br />
                                        <br />
                                      </center>
                                    </td>
                                    <td>
                                      <center>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="delete_ndt_validity('1', '<?php echo $value['id_welder']; ?>','<?php echo $value['ndt_val_1']; ?>')"><i class="fas fa-trash-alt"></i></button>
                                      </center>
                                    </td>
                                  </tr>
                                <?php } ?>
                                <tr>
                                  <td colspan="2">
                                    <input type="file" name="ndt_val_1[<?php echo $no; ?>]">
                                  </td>
                                </tr>
                              </table>
                            </center>
                          </td>

                          <td class="align-middle">
                            <center>
                              <table>
                                <?php if (isset($value['ndt_val_2'])) { ?>
                                  <tr>
                                    <td>
                                      <center>
                                        <!-- <a href='https://www.smoebatam.com/pcms_v2_photo/welder_file/ndt_validity/<?php echo $value["ndt_val_2"]; ?>'>File Certificate</i></a><br/><br/> -->
                                        <?php
                                        $enc_redline = strtr($this->encryption->encrypt($value["ndt_val_2"]), '+=/', '.-~');
                                        $enc_path    = strtr($this->encryption->encrypt('/PCMS/pcms_v2/welder_attachment/ndt_validity/'), '+=/', '.-~');
                                        ?>
                                        <a target='_blank' href='<?= site_url('irn/open_file/' . $enc_redline . '/' . $enc_path) ?>'><span class='btn btn-primary'><i class="fas fa-images"></i> File</span></a><br />
                                        <br />
                                      </center>
                                    </td>
                                    <td>
                                      <center>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="delete_ndt_validity('2', '<?php echo $value['id_welder']; ?>','<?php echo $value['ndt_val_2']; ?>')"><i class="fas fa-trash-alt"></i></button>
                                      </center>
                                    </td>
                                  </tr>
                                <?php } ?>
                                <tr>
                                  <td colspan="2">
                                    <input type="file" name="ndt_val_2[<?php echo $no; ?>]">
                                  </td>
                                </tr>
                              </table>
                            </center>
                          </td>

                          <td class="align-middle">
                            <center>
                              <table>
                                <?php if (isset($value['ndt_val_3'])) { ?>
                                  <tr>
                                    <td>
                                      <center>
                                        <!-- <a href='https://www.smoebatam.com/pcms_v2_photo/welder_file/ndt_validity/<?php echo $value["ndt_val_3"]; ?>'>File Certificate</i></a><br/><br/> -->
                                        <?php
                                        $enc_redline = strtr($this->encryption->encrypt($value["ndt_val_3"]), '+=/', '.-~');
                                        $enc_path    = strtr($this->encryption->encrypt('/PCMS/pcms_v2/welder_attachment/ndt_validity/'), '+=/', '.-~');
                                        ?>
                                        <a target='_blank' href='<?= site_url('irn/open_file/' . $enc_redline . '/' . $enc_path) ?>'><span class='btn btn-primary'><i class="fas fa-images"></i> File</span></a><br />
                                        <br />
                                      </center>
                                    </td>
                                    <td>
                                      <center>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="delete_ndt_validity('3', '<?php echo $value['id_welder']; ?>','<?php echo $value['ndt_val_3']; ?>')"><i class="fas fa-trash-alt"></i></button>
                                      </center>
                                    </td>
                                  </tr>
                                <?php } ?>
                                <tr>
                                  <td colspan="2">
                                    <input type="file" name="ndt_val_3[<?php echo $no; ?>]">
                                  </td>
                                </tr>
                              </table>
                            </center>
                          </td>

                        </tr>

                      <?php $no++;
                      endforeach; ?>

                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-12 text-right">
                  <hr>
                  <a href="<?= site_url('master/welder/welder_list') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                  <button type="submit" class="btn btn-warning"><i class="fas fa-edit"></i> Update</button>
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

<script type="text/javascript">
  console.log(<?php echo $nod; ?>);

  $(document).ready(function() {
    selectRefresh();

  });

  function selectRefresh() {
    $(".select2_multiple_position").select2({
      tags: true,
      allowClear: true,
      tokenSeparators: [', ', ' '],
    })
    $(".select2_multiple_fno").select2({
      tags: true,
      allowClear: true,
      tokenSeparators: [', ', ' '],
    })
    $(".select2_company").select2();
  }


  function delete_detail_welder(btn, id_welder_detail) {
    Swal.fire({
      type: "warning",
      title: `<span class="text-danger">DELETE</span>`,
      html: `<i>Are you sure..?</i>`,
      showCancelButton: true
    }).then((res) => {
      if (res.value) {
        $.ajax({
          url: "<?= site_url('master/welder/delete_detail_welder') ?>",
          type: "POST",
          data: {
            id_welder_detail: id_welder_detail
          },
          dataType: "JSON",
          success: function(data) {
            if (data.success) {
              Swal.fire({
                type: "success",
                title: "SUCCESS",
                text: "Success Delete Data",
                timer: 1000
              })

              $(btn).closest('tr').remove()

            }
          }
        })
      }
    })
  }

  function delete_detail_attachment(btn, id_welder_detail, filename) {
    Swal.fire({
      type: "warning",
      title: `<span class="text-danger">DELETE</span>`,
      html: `<i>Are you sure..?</i>`,
      showCancelButton: true
    }).then((res) => {
      if (res.value) {
        $.ajax({
          url: "<?= site_url('master/welder/delete_detail_attachment') ?>",
          type: "POST",
          data: {
            id_welder_detail: id_welder_detail,
            filename: filename,
          },
          dataType: "JSON",
          success: function(data) {
            if (data.success) {
              Swal.fire({
                type: "success",
                title: "SUCCESS",
                text: "Success Delete Data",
                timer: 1000
              })

              $(btn).closest('tr').remove()

            }
          }
        })
      }
    })
  }

  function delete_ndt_validity(btn, id_welder, filename) {
    Swal.fire({
      type: "warning",
      title: `<span class="text-danger">DELETE</span>`,
      html: `<i>Are you sure..?</i>`,
      showCancelButton: true
    }).then((res) => {
      if (res.value) {
        $.ajax({
          url: "<?= site_url('master/welder/delete_ndt_validity') ?>",
          type: "POST",
          data: {
            col_id: btn,
            id_welder: id_welder,
            filename: filename,
          },
          dataType: "JSON",
          success: function(data) {
            if (data.success) {
              Swal.fire({
                type: "success",
                title: "SUCCESS",
                text: "Success Delete Data",
                timer: 1000
              })

              location.reload();

            }
          }
        })
      }
    })
  }


  function add_row_attachment_2(input, index) {

    var noplusCal = $("#no_detail_row" + index).val();
    var storage = Number(noplusCal) + 1;
    $("#no_detail_row" + index).val(storage)

    var noplus = $("#no_detail_row" + index).val();

    var nodata = noplus;
    var table = $(input).closest('tbody');

    var html = `
        <tr>
            <td>
              <table class="table table-borderless" style='border-collapse:collapse;border: 1px solid #cccccc;padding:10px;'>
                  <tr>
                    <th><center>Welder Process</center></th>
                    <th style="width:90px !important;"><center>Welder Position</center></th> 
                    <th style="width:90px !important;"><center>F Number</center></th>                
                    <th><center>Welder Certificate</center></th>  
                  </tr>  
                  <tr>
                    <td>
                      <input type="hidden" name="id_req[${index}][]" value="new_row">
                        <select class="custom-select input_width" name="welder_process[${index}][]" required>
                          <option value="">---</option>
                          <?php foreach ($welder_process_list as $key => $w_process) { ?>
                            <option value='<?php echo $w_process['id']; ?>'><?php echo $w_process['name_process']; ?></option>
                          <?php } ?>
                        </select>                                     
                    </td>
                   <td>
                      <select class="custom-select input_width select2_multiple_position" name="welder_position[${index}][${nodata}][]" required multiple>
                           <option value="">---</option>
                           <?php foreach ($master_req['welder_position'] as $d) : ?>
                              <option value="<?= $d['value'] ?>"> <?= $d['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                     </td>
                     <td>                
                        <select class="custom-select input_width select2_multiple_fno" name="f_no[${index}][${nodata}][]" required multiple>
                          <option value="">---</option>
                          <?php foreach ($master_req['f_no'] as $d) : ?>
                            <option value="<?= $d['value'] ?>"> <?= $d['value'] ?></option>
                          <?php endforeach; ?>
                        </select>                                     
                      </td>
                      <td class="align-middle">
                        <center>      
                          <input type="file" name="attachment_detail[${index}][]">
                        </center>  
                      </td>
                      
                   </tr>
                   <tr>
                    <th>
                        <span class='c'>Class Of Material</span>
                    </th>
                    <th>
                      <span class='c'> Qualification WPS</span>
                    </th>
                  </tr>
                    <tr>
                      <td>
                        <span class='c'>
                          <select id="cwm" class="custom-select input_width cwm" name="cwm[${index}][]" required>
                            <option value="">---</option>
                            <?php foreach ($master_req['cwm'] as $d) : ?>
                            <option value="<?= $d['value'] ?>"> <?= $d['value'] ?></option>
                          <?php endforeach; ?>
                          </select>
                        </span>  
                      </td>

                      <td>
                      <select id="welder_wps${index}" class="custom-select input_width " name="welder_wps[${index}][]" required>
                      <option value="">---</option>

                        <?php foreach ($wps_list as $key => $value) : ?>
                          <option value="<?php echo $value['id_wps'] ?>"><?php echo $value['wps_no'] ?></option>
                        <?php endforeach; ?>
                      </select>
                      </td>

                    </tr>
               </table>
               <table class="table table-borderless" style='border-collapse:collapse;border: 1px solid #cccccc;padding:10px;'>
                  <tr>
                    <th><center>Position Range Qualification</center></th>             
                    <th><center>Diameter Range</center></th>             
                    <th><center>Thickness Range</center></th>             
                    <th><center>Backing</center></th>
                  </tr>
                  <tr>
                    <td>                
                      <select class="custom-select input_width" name="position_range[${index}][]" required>
                        <option value="">---</option>
                        <?php foreach ($master_req['position_range'] as $d) : ?>
                            <option value="<?= $d['value'] ?>"> <?= $d['value'] ?></option>
                          <?php endforeach; ?>
                      </select>                                     
                    </td>
                    <td>                
                      <select class="custom-select input_width" name="diameter_range[${index}][]" required>
                        <option value="">---</option>
                        <?php foreach ($master_req['diameter_range'] as $d) : ?>
                            <option value='<?= $d['value'] ?>'> <?= $d['value'] ?></option>
                          <?php endforeach; ?>
                      </select>                                     
                    </td>
                    <td>                
                      <select class="custom-select input_width" name="thickness_range[${index}][]" required>
                        <option value="">---</option>
                        <?php foreach ($master_req['thickness_range'] as $d) : ?>
                            <option value="<?= $d['value'] ?>"> <?= $d['value'] ?></option>
                          <?php endforeach; ?>           
                      </select>                                     
                    </td>
                    <td>                
                      <select class="custom-select input_width" name="backing[${index}][]" required>
                        <option value="">---</option>
                        <?php foreach ($master_req['backing'] as $d) : ?>
                            <option value="<?= $d['value'] ?>"> <?= $d['value'] ?></option>
                          <?php endforeach; ?>
                      </select>                                     
                    </td>
                  </tr>
               </table>

               <table class="table table-borderless" style='border-collapse:collapse;border: 1px solid #cccccc;padding:10px;'>
                <tr>
                  <th><center>Validity Start Date</center></th>             
                  <th><center>Validity End Date</center></th>             
                </tr>
                <tr>
                  <td>                
                    <input type="date" class="form-control form-control-sm" name="validity_start_date[${index}][]">                              
                  </td>
                  <td>                
                    <input type="date" class="form-control form-control-sm" name="validity_end_date[${index}][]">                              
                  </td>
                </tr>
             </table>
           </td>
           <td>
            <button type="button" class="btn btn-danger  btn-sm" onclick="delete_attachment_row_2(this, ${index})"><i class="fas fa-trash-alt"></i></button>
          </td>
         </tr> `;

    table.append(html);
    selectRefresh();
    console.log(nodata);
  }


  function delete_attachment_row_2(input, index) {
    var noplusCal = $("#no_detail_row" + index).val();
    var storage = Number(noplusCal) - 1;
    $("#no_detail_row" + index).val(storage)
    $(input).closest('tr').remove()
  }
</script>


<script type="text/javascript">
  function check_welder(no) {
    $("#text_alert_welder" + no).removeAttr("hidden");
    var id_welder_main = $("input[id='id_welder_main[" + no + "]']").val();
    var r_no = $("input[id='welder_no[" + no + "]']").val();
    var welder_no_without_space = r_no.replace(/\s/g, "");

    if (welder_no_without_space == "") {
      $("input[id='welder_no[" + no + "]']").val(welder_no_without_space);
      document.getElementById("text_alert_welder" + no).style.color = "red";
      $('#text_alert_welder' + no).text('Error: Welder No is Required');
      $("#submitBtn").attr("disabled", true);

    } else {

      $("input[id='welder_no[" + no + "]']").val(welder_no_without_space);

      $.ajax({
        url: "<?= base_url() ?>master/welder/check_welder_register/" + r_no + "/" + id_welder_main,
        type: "post",
        success: function(data) {
          if (data == 0) {
            document.getElementById("text_alert_welder" + no).style.color = "green";
            $('#text_alert_welder' + no).text('Success: Welder Code Available');
            $('#submitBtn').removeAttr("disabled");
          } else {
            document.getElementById("text_alert_welder" + no).style.color = "red";
            $('#text_alert_welder' + no).text('Error: Double Welder No Code');
            $("#submitBtn").attr("disabled", true);
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
      });
    }
  }

  function check_welder_badge(no) {
    $("#text_alert_welder_badge" + no).removeAttr("hidden");
    var welder_no = $("input[id='welder_no[" + no + "]']").val();
    var id_welder_main = $("input[id='id_welder_main[" + no + "]']").val();
    var r_no = $("input[id='welder_badge[" + no + "]']").val();
    var welder_no_without_space = r_no.replace(/\s/g, "");

    if (welder_no_without_space == "") {
      $("input[id='welder_badge[" + no + "]']").val(welder_no_without_space);
      document.getElementById("text_alert_welder_badge" + no).style.color = "red";
      $('#text_alert_welder_badge' + no).text('Error: Welder Badge is Required');
      $("#submitBtn").attr("disabled", true);

    } else {

      $("input[id='welder_badge[" + no + "]']").val(welder_no_without_space);

      $.ajax({
        url: "<?= base_url() ?>master/welder/check_welder_badge/" + r_no + "/" + id_welder_main + "/" + welder_no,
        type: "post",
        success: function(data) {
          if (data == 0) {
            document.getElementById("text_alert_welder_badge" + no).style.color = "green";
            $('#text_alert_welder_badge' + no).text('Success: Welder Badge Available');
            $('#submitBtn').removeAttr("disabled");
          } else {
            document.getElementById("text_alert_welder_badge" + no).style.color = "red";
            $('#text_alert_welder_badge' + no).text('Error: Double Welder Badge');
            $("#submitBtn").attr("disabled", true);
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
      });
    }
  }
</script>