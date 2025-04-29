<style type="text/css">
  .select2_multiple_fno {
    width: 150px !important;
  }

  .select2_company {
    width: 200px !important;
  }

  th,
  td {
    vertical-align: middle !important;
  }

  .input_width {
    width: 200px !important;
  }
</style>

<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card rounded-0 shadow">
          <div class="card-header">
            <h6 class="m-0"> New Welder</h6>
          </div>
          <div class="card-body">
            <form action="<?= site_url('master/welder/welder_save_process_import') ?>" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive overflow-auto">
                    <table class="table text-center" id='form-submit'>
                      <thead class="bg-info text-white">
                        <tr>
                          <th>Welder Code</th>
                          <th>Company</th>
                          <th>Project</th>
                          <th>Welder Badge</th>
                          <th>QR Badge</th>
                          <th>Welder Name</th>
                          <th>Discipline</th>
                          <th>Requirement</th>
                          <th>Welder WPS</th>
                          <!-- <th>Status</th> -->
                          <!-- <th>NDT of The Validity<br />(6 Months)<br />1</th>
                          <th>NDT of The Validity<br />(6 Months)<br />2</th>
                          <th>NDT of The Validity<br />(6 Months)<br />3</th> -->
                          <!-- <th><button type="button" class="btn btn-primary" title="Add Row" onclick="addrow();"><i class="fa fa-plus"></i></button></th> -->
                          <th>Messages</th>
                        </tr>
                      </thead>
                      <tbody id="table_list">
                        <?php $key = 0; ?>
                        <?php $error = 0; ?>
                        <?php foreach ($sheet as $key_uniq => $value) {
                          if ($key > 0 && $value['A'] != "") { ?>
                            <?php
                            $messages = "";
                            $errow = 0;
                            if ($welder_list[$value['C']]) {
                              $error++;
                              $errow = 1;
                              $messages = "Welder Exist on System!";
                            }
                            if (!$value['C'] or !$value['D'] or !$value['E']) {
                              $error++;
                              $errow = 1;
                              $messages = "Welder Information is Mandatory!";
                            }

                            $arr_wps = explode(";", $value['F']);
                            ?>
                            <tr class="<?= $errow > 0 ? "bg-alert-warning" : "" ?>">
                              <td class="align-middle">
                                <input type="text" class="form-control input_width" name="welder_code[<?= $key ?>]" placeholder="Input Welder Code" id="welder_no[<?= $key ?>]" onblur="check_welder(<?= $key ?>)" value="<?= $value['C'] ?>" required>
                                <span id="text_alert_welder<?= $key ?>"></span>

                                <input type="hidden" id="no_detail_row<?= $key ?>" name="no_detail_row[<?= $key ?>]" value="<?= $key ?>">

                              </td>

                              <!--<td class="align-middle"> <input type="text" class="form-control input_width" name="rwe_code[<?= $key ?>]" placeholder="Input Client Code" id="rwe_code[<?= $key ?>]" required> </td>-->

                              <td class="align-middle">
                                <select class="input_width select2_company" name="company[<?= $key ?>]" required>
                                  <option value="">---</option>
                                  <?php foreach ($company_list as $keys => $company_val) { ?>
                                    <option value='<?php echo $company_val['id_company']; ?>' <?= $company_val['id_company'] == decrypt($value['Q']) ? 'selected' : '' ?>><?php echo $company_val['company_name']; ?></option>
                                  <?php } ?>
                                </select>
                              </td>

                              <td class="align-middle">
                                <select id="project_id<?= $key ?>" class="custom-select input_width project_id" name="project_id[<?= $key ?>]" required>
                                  <option value="">---</option>
                                  <?php foreach ($project_list as $keys => $project_val) { ?>
                                    <?php if (in_array($project_val['id'], $this->user_cookie[13])) : ?>
                                      <option value='<?php echo $project_val['id']; ?>' <?= $value["A"] == $project_val["project_code"] ? 'selected' : '' ?>><?php echo $project_val['project_name']; ?></option>
                                    <?php endif; ?>
                                  <?php } ?>
                                </select>
                              </td>

                              <td class="align-middle">
                                <input type="text" class="form-control input_width" name="welder_badge[<?= $key ?>]" placeholder="Input Welder Badge" id="welder_badge[<?= $key ?>]" onblur="check_welder_badge(<?= $key ?>)" required value="<?= $value["D"] ?>">
                                <span id="text_alert_welder_badge<?= $key ?>"></span>
                              </td>

                              <td class="align-middle">
                                <input type="text" class="form-control input_width" name="bank_data_badge[<?= $key ?>]" placeholder="Bank Data Welder Badge" value="<?= $value["D"] ?>" required>
                              </td>

                              <td class="align-middle">
                                <input type="text" class="form-control input_width" name="welder_name[<?= $key ?>]" placeholder="Input Welder Name" value="<?= $value["E"] ?>" required>
                              </td>

                              <td class="align-middle">
                                <select id="discipline<?= $key ?>" class="custom-select input_width discipline" name="discipline[<?= $key ?>]" required>
                                  <option value="">---</option>
                                  <?php foreach ($discipline_list as $keys => $value_disc) : ?>
                                    <option value="<?php echo $value_disc['id'] ?>" <?= strtoupper($value_disc['initial']) == strtoupper($value["B"]) ? 'selected' : '' ?>><?php echo $value_disc['discipline_name'] ?></option>
                                  <?php endforeach; ?>
                                </select>
                              </td>

                              <td class="align-middle">
                                <?php
                                $no_keys = 0;
                                foreach ($sheet_detail[$key_uniq] as $keyz => $value_detail) { ?>
                                  <?php //test_var($keyz, 1) 
                                  ?>
                                  <center>

                                    <table class="table table-borderless">
                                      <tbody>
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
                                                  <input type="hidden" name="id_req[<?= $key ?>][]" value="new_row">
                                                  <select class="custom-select input_width" name="welder_process[<?= $key ?>][]" required>
                                                    <option value="">---</option>
                                                    <?php foreach ($welder_process_list as $keys => $w_process) { ?>
                                                      <option value='<?php echo $w_process['id']; ?>' <?= $w_process["id"] == $value_detail["G"] ? "selected" : "" ?>><?php echo $w_process['name_process']; ?></option>
                                                    <?php } ?>
                                                  </select>
                                                </td>
                                                <td>
                                                  <select class="custom-select input_width select2_multiple_position" name="welder_position[<?= $key ?>][<?= $no_keys ?>][]" required multiple>
                                                    <?php foreach ($master_req['welder_position'] as $keys => $value_mr_1) : ?>
                                                      <option <?= in_array($value_mr_1['value'], explode(";", $value_detail["H"])) ? 'selected' : '' ?> value="<?= $value_mr_1['value'] ?>"><?= $value_mr_1['value'] ?></option>
                                                    <?php endforeach; ?>
                                                  </select>
                                                </td>
                                                <td>
                                                  <select class="custom-select input_width select2_multiple_fno" name="f_no[<?= $key ?>][<?= $no_keys ?>][]" required multiple>
                                                    <?php foreach ($master_req['f_no'] as $keys => $value_mr_2) : ?>
                                                      <option <?= in_array($value_mr_2['value'], explode(";", $value_detail["I"])) ? 'selected' : '' ?> value="<?= $value_mr_2['value'] ?>"><?= $value_mr_2['value'] ?></option>
                                                    <?php endforeach; ?>
                                                  </select>
                                                  <?php $no_keys++; ?>
                                                </td>
                                                <td class="align-middle">
                                                  <center>
                                                    <input type="file" name="attachment_detail[<?= $key ?>][]">
                                                  </center>
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
                                                    <select id="cwm" class="custom-select input_width cwm" name="cwm[<?= $key ?>][]" required>
                                                      <option value="">---</option>
                                                      <?php foreach ($master_req['cwm'] as $keys => $value_mr_3) : ?>
                                                        <option <?= $value_mr_3["value"] == $value_detail["N"] ? "selected" : "" ?> value="<?= $value_mr_3['value'] ?>"><?= $value_mr_3['value'] ?></option>
                                                      <?php endforeach; ?>
                                                    </select>
                                                  </span>
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
                                                  <select class="custom-select input_width" name="position_range[<?= $key ?>][]" required>
                                                    <option value="">---</option>
                                                    <?php foreach ($master_req['position_range'] as $keys => $values) : ?>
                                                      <option <?= $values["value"] == $value_detail["J"] ? "selected" : "" ?> value="<?= $values['value'] ?>"><?= $values['value'] ?></option>
                                                    <?php endforeach; ?>
                                                  </select>
                                                </td>
                                                <td>
                                                  <select class="custom-select input_width" name="diameter_range[<?= $key ?>][]" required>
                                                    <option value="">---</option>
                                                    <?php foreach ($master_req['diameter_range'] as $keys => $values) : ?>
                                                      <option <?= is_int(strpos($values["value"], $value_detail["K"])) == 1 ? "selected" : "" ?> value='<?= $values['value'] ?>'><?= $values["value"] ?></option>
                                                    <?php endforeach; ?>
                                                  </select>
                                                </td>
                                                <td>
                                                  <select class="custom-select input_width" name="thickness_range[<?= $key ?>][]" required>
                                                    <option value="">---</option>
                                                    <?php foreach ($master_req['thickness_range'] as $keys => $values) : ?>
                                                      <option <?= $values["value"] == $value_detail["L"] ? "selected" : "" ?> value="<?= $values['value'] ?>"><?= $values['value'] ?></option>
                                                    <?php endforeach; ?>
                                                  </select>
                                                </td>
                                                <td>
                                                  <select class="custom-select input_width" name="backing[<?= $key ?>][]" required>
                                                    <option value="">---</option>
                                                    <?php foreach ($master_req['backing'] as $keys => $values) : ?>
                                                      <option <?= $values["value"] == $value_detail["M"] ? "selected" : "" ?> value="<?= $values['value'] ?>"><?= $values['value'] ?></option>
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
                                                  <input type="date" class="form-control form-control-sm" name="validity_start_date[<?= $key ?>][]" value="<?= $value_detail["O"] ?>">
                                                </td>
                                                <td>
                                                  <input type="date" class="form-control form-control-sm" name="validity_end_date[<?= $key ?>][]" value="<?= $value_detail["P"] ?>">
                                                </td>
                                              </tr>
                                            </table>

                                          </td>
                                          <td>
                                            <button type="button" class="btn btn-primary btn-sm" onclick="add_row_attachment_2(this, <?= $key ?>)"><i class="fas fa-plus-circle"></i></button>
                                          </td>

                                        </tr>

                                      </tbody>
                                    </table>
                                  </center>
                                <?php } ?>
                              </td>

                              <td class="align-middle">
                                <select class="custom-select input_width select2" name="wps_welder[<?= $key ?>][]" multiple>
                                  <option value="">---</option>
                                  <?php foreach ($wps_list as $k => $v) : ?>
                                    <option value="<?= $v['id_wps'] ?>" <?= in_array($v['wps_no'], $arr_wps) ? 'selected' : '' ?>><?= $v['wps_no'] ?></option>
                                  <?php endforeach; ?>
                                </select>
                              </td>


                              <!-- <td class="align-middle">
										      <select id="status_actived<?= $key ?>" class="custom-select input_width" name="status_actived[<?= $key ?>]" required> 
										        <option value="">---</option>
										        <?php foreach ($master_req['status_actived'] as $keys => $valuex) : ?> 
										          <option value="<?= $valuex['value'] ?>" <?= $valuex['value'] == 1 ? 'selected' : '' ?>><?= $valuex['display_text'] ?></option>
										        <?php endforeach; ?>  
										      </select>  -->
                              <!-- <br/> Affected On Date : </br>      
										      <input type="date" class="form-control input_width" name="non_active_date[<?= $key ?>]" placeholder="Choice Date" required> -->

                              <!-- </td> -->

                              <!-- <td class="align-middle">
										        <center>      
										          <input type="file" name="ndt_val_1[<?= $key ?>]">
										        </center> 
										    </td>

										    <td class="align-middle">
										        <center>      
										          <input type="file" name="ndt_val_2[<?= $key ?>]">
										        </center> 
										    </td>

										    <td class="align-middle">
										        <center>      
										          <input type="file" name="ndt_val_3[<?= $key ?>]">
										        </center> 
										    </td> -->

                              <!-- <td class="align-middle"><button type="button" class="btn btn-danger" title="Delete Row" onclick="deleterow(this,${count_data_row});"><i class="fa fa-trash"></i></button></td> -->
                              <td>
                                <strong>
                                  <?= @$messages; ?>
                                </strong>
                              </td>
                            </tr>
                        <?php }
                          $key++;
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-12 text-right">
                  <hr>
                  <a href="<?= site_url('master/welder/welder_list') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                  <?php if ($error == 0) { ?>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Submit</button>
                  <?php } else { ?>
                    <span class="btn btn-danger">
                      <i class="fas fa-times"></i>
                      Please Check Error Messages!
                    </span>
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

<script type="text/javascript">
  $(document).ready(function() {
    // addrow();
    selectRefresh();

    $('form').on('submit', function() {
      $('button[type=submit]').attr('disabled', true)
    })
  });

  function selectRefresh() {
    $(".select2_multiple_position").select2({
      allowClear: true,
      tokenSeparators: [', ', ' '],
    })

    $(".select2_multiple_fno").select2({

      allowClear: true,
      tokenSeparators: [', ', ' '],
    })

    $(".select2_company").select2({
      theme: 'bootstrap'
    });


  }

  var count_data_row = 0;

  function addrow() {

    sessionStorage.nodata = 1;

    var html = `
    <tr id="remove${count_data_row}">

    <td class="align-middle">
      <input type="text" class="form-control input_width" name="welder_code[${count_data_row}]" placeholder="Input Welder Code" id="welder_no[${count_data_row}]" onblur="check_welder(${count_data_row})"required>
      <span id="text_alert_welder${count_data_row}"></span>

      <input type="hidden" id="no_detail_row${count_data_row}"  name="no_detail_row[${count_data_row}]" value="1"> 

    </td>

    <!--<td class="align-middle"> <input type="text" class="form-control input_width" name="rwe_code[${count_data_row}]" placeholder="Input Client Code" id="rwe_code[${count_data_row}]" required> </td>-->

    <td class="align-middle">
      <select class="input_width select2_company" name="company[${count_data_row}]" required>
        <option value="">---</option>
        <?php foreach ($company_list as $key => $company_val) { ?>
            <option value='<?php echo $company_val['id_company']; ?>'><?php echo $company_val['company_name']; ?></option>
        <?php } ?>
      </select>  
    </td>

    <td class="align-middle">
        <select id="project_id${count_data_row}" class="custom-select input_width project_id" name="project_id[${count_data_row}]" required>
          <option value="">---</option>
					<?php foreach ($project_list as $key => $project_val) { ?>
						<?php if (in_array($project_val['id'], $this->user_cookie[13])) : ?>
            	<option value='<?php echo $project_val['id']; ?>'><?php echo $project_val['project_name']; ?></option>
						<?php endif; ?>
					<?php } ?>
        </select>
    </td>

    <td class="align-middle">
      <input type="text" class="form-control input_width" name="welder_badge[${count_data_row}]" placeholder="Input Welder Badge" id="welder_badge[${count_data_row}]" onblur="check_welder_badge(${count_data_row})" required>
      <span id="text_alert_welder_badge${count_data_row}"></span>
    </td>

    <td class="align-middle">
      <input type="text" class="form-control input_width" name="bank_data_badge[${count_data_row}]" placeholder="Bank Data Welder Badge" required>
    </td>

    <td class="align-middle">
      <input type="text" class="form-control input_width" name="welder_name[${count_data_row}]" placeholder="Input Welder Name" required>
    </td>

   
    
    <td class="align-middle">
        <select id="discipline${count_data_row}" class="custom-select input_width discipline" name="discipline[${count_data_row}]" required>
          <option value="">---</option>
          <?php foreach ($discipline_list as $key => $value) : ?>
            <option value="<?php echo $value['id'] ?>"><?php echo $value['discipline_name'] ?></option>
          <?php endforeach; ?>
        </select>
    </td>

    <td class="align-middle"><center>

        <table class="table table-borderless" >
        <tbody>
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
                      <input type="hidden" name="id_req[${count_data_row}][]" value="new_row">
                      <select class="custom-select input_width" name="welder_process[${count_data_row}][]" required>
                        <option value="">---</option>
                        <?php foreach ($welder_process_list as $key => $w_process) { ?>
                            <option value='<?php echo $w_process['id']; ?>'><?php echo $w_process['name_process']; ?></option>
                        <?php } ?>
                      </select>                                     
                  </td>
                 <td>
                    <select class="custom-select input_width select2_multiple_position" name="welder_position[${count_data_row}][1][]" required multiple>
                      <?php foreach ($master_req['welder_position'] as $key => $value) : ?> 
                        <option value="<?= $value['value'] ?>"><?= $value['value'] ?></option>
                      <?php endforeach; ?>                    
                      </select>
                   </td>
                   <td>                
                      <select class="custom-select input_width select2_multiple_fno" name="f_no[${count_data_row}][1][]" required multiple>
                      <?php foreach ($master_req['f_no'] as $key => $value) : ?> 
                        <option value="<?= $value['value'] ?>"><?= $value['value'] ?></option>
                      <?php endforeach; ?>  
                      </select>                                     
                    </td>
                    <td class="align-middle">
                      <center>      
                        <input type="file" name="attachment_detail[${count_data_row}][]">
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
                        <select id="cwm" class="custom-select input_width cwm" name="cwm[${count_data_row}][]" required>
                          <option value="">---</option>
                          <?php foreach ($master_req['cwm'] as $key => $value) : ?> 
                        <option value="<?= $value['value'] ?>"><?= $value['value'] ?></option>
                      <?php endforeach; ?>  
                        </select>
                      </span>  
                    </td>
                    <td>
                      <select id="welder_wps${count_data_row}" class="custom-select input_width " name="welder_wps[${count_data_row}][]"  required>
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
                    <select class="custom-select input_width" name="position_range[${count_data_row}][]" required>
                      <option value="">---</option>
                      <?php foreach ($master_req['position_range'] as $key => $value) : ?> 
                        <option value="<?= $value['value'] ?>"><?= $value['value'] ?></option>
                      <?php endforeach; ?>  
                    </select>                                     
                  </td>
                  <td>                
                    <select class="custom-select input_width" name="diameter_range[${count_data_row}][]" required>
                      <option value="">---</option>
                      <?php foreach ($master_req['diameter_range'] as $key => $value) : ?> 
                        <option value='<?= $value['value'] ?>'><?= $value['value'] ?></option>
                      <?php endforeach; ?>  
                    </select>                                     
                  </td>
                  <td>                
                    <select class="custom-select input_width" name="thickness_range[${count_data_row}][]" required>
                      <option value="">---</option>
                      <?php foreach ($master_req['thickness_range'] as $key => $value) : ?> 
                        <option value="<?= $value['value'] ?>"><?= $value['value'] ?></option>
                      <?php endforeach; ?>      
                    </select>                                     
                  </td>
                  <td>                
                    <select class="custom-select input_width" name="backing[${count_data_row}][]" required>
                      <option value="">---</option>
                      <?php foreach ($master_req['backing'] as $key => $value) : ?> 
                        <option value="<?= $value['value'] ?>"><?= $value['value'] ?></option>
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
                    <input type="date" class="form-control form-control-sm" name="validity_start_date[${count_data_row}][]">                              
                  </td>
                  <td>                
                    <input type="date" class="form-control form-control-sm" name="validity_end_date[${count_data_row}][]">                              
                  </td>
                </tr>
             </table>

         </td>
          <td>
           <button type="button" class="btn btn-primary btn-sm" onclick="add_row_attachment_2(this, ${count_data_row})"><i class="fas fa-plus-circle"></i></button>
          </td>

         </tr>

         </tbody>
         </table>
    </center>
    </td>

  
    <td class="align-middle">
      <select id="status_actived${count_data_row}" class="custom-select input_width" name="status_actived[${count_data_row}]" required> 
        <option value="">---</option>
        <?php foreach ($master_req['status_actived'] as $key => $value) : ?> 
          <option value="<?= $value['value'] ?>"><?= $value['display_text'] ?></option>
        <?php endforeach; ?>  
      </select> 
      <br/> Affected On Date : </br>      
      <input type="date" class="form-control input_width" name="non_active_date[${count_data_row}]" placeholder="Choice Date" required>
           
    </td>

    <td class="align-middle">
        <center>      
          <input type="file" name="ndt_val_1[${count_data_row}]">
        </center> 
    </td>

    <td class="align-middle">
        <center>      
          <input type="file" name="ndt_val_2[${count_data_row}]">
        </center> 
    </td>

    <td class="align-middle">
        <center>      
          <input type="file" name="ndt_val_3[${count_data_row}]">
        </center> 
    </td>
   
    <td class="align-middle"><button type="button" class="btn btn-danger" title="Delete Row" onclick="deleterow(this,${count_data_row});"><i class="fa fa-trash"></i></button></td>

   </tr>`;


    $("#table_list").append(html);
    selectRefresh();
    count_data_row++;
  }

  function change_label(input) {
    var value = $(input).val()
    var label = $(input).closest('.custom-file').find('label')
    var split = value.split('\\')

    label.text(split[split.length - 1])
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
                           <?php foreach ($master_req['welder_position'] as $key => $value) : ?> 
                            <option value="<?= $value['value'] ?>"><?= $value['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                     </td>
                     <td>                
                        <select class="custom-select input_width select2_multiple_fno" name="f_no[${index}][${nodata}][]" required multiple>
                        <?php foreach ($master_req['f_no'] as $key => $value) : ?> 
                        <option value="<?= $value['value'] ?>"><?= $value['value'] ?></option>
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
                        <span class='c'>Qualification WPS</span>
                    </th>
                  </tr>
                  <tr>
                    <td>
                      <span class='c'>
                        <select id="cwm" class="custom-select input_width cwm" name="cwm[${index}][]" required>
                          <option value="">---</option>
                          <?php foreach ($master_req['cwm'] as $key => $value) : ?> 
                        <option value="<?= $value['value'] ?>"><?= $value['value'] ?></option>
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
                      <?php foreach ($master_req['position_range'] as $key => $value) : ?> 
                        <option value="<?= $value['value'] ?>"><?= $value['value'] ?></option>
                      <?php endforeach; ?>  
                      </select>                                     
                    </td>
                    <td>                
                      <select class="custom-select input_width" name="diameter_range[${index}][]" required>
                        <option value="">---</option>
                        <?php foreach ($master_req['diameter_range'] as $key => $value) : ?> 
                        <option value='<?= $value['value'] ?>'><?= $value['value'] ?></option>
                      <?php endforeach; ?>  
                      </select>                                     
                    </td>
                    <td>                
                      <select class="custom-select input_width" name="thickness_range[${index}][]" required>
                        <option value="">---</option>
                        <?php foreach ($master_req['thickness_range'] as $key => $value) : ?> 
                        <option value="<?= $value['value'] ?>"><?= $value['value'] ?></option>
                      <?php endforeach; ?>  
                      </select>                                     
                    </td>
                    <td>                
                      <select class="custom-select input_width" name="backing[${index}][]" required>
                        <option value="">---</option>
                        <?php foreach ($master_req['backing'] as $key => $value) : ?> 
                        <option value="<?= $value['value'] ?>"><?= $value['value'] ?></option>
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
  }

  function delete_attachment_row_2(input, index) {
    var noplusCal = $("#no_detail_row" + index).val();
    var storage = Number(noplusCal) - 1;
    $("#no_detail_row" + index).val(storage)
    $(input).closest('tr').remove()
  }

  function deleterow(btn, no) {
    $(btn).closest('tr').remove();
    $('table#form-submit tr#remove' + no).remove();
  }
</script>

<script type="text/javascript">
  function check_welder(no) {
    $("#text_alert_welder" + no).removeAttr("hidden");
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
        url: "<?= base_url() ?>master/welder/check_welder_register/" + r_no,
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
        url: "<?= base_url() ?>master/welder/check_welder_badge/" + r_no + welder_no,
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