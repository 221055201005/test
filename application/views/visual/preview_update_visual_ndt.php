<?php
  $invitaion_type_list = [
    'Invitation Witness' => 0,
    'Notification Activity' => 1,
  ];
  $itp_list = [
    'Hold Point' => 1,
    'Witness' => 2,
    'Monitoring' => 3,
    'Review' => 4,
  ];
?>
<style>
  th,
  td {
    vertical-align: middle !important;
  }
</style>

<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h6 class="card-title"><?= $meta_title ?></h6>
            <hr>
            <form action="<?= site_url('visual/proceed_update_visual_ndt') ?>" method="post">
              <input type="hidden" name="ndt_type" value='<?= $post['ndt_type'] ?>' <?= $disabled ? 'disabled' : 'required' ?>>
              <input type="hidden" name="drawing_no" value='<?= $post['drawing_no'] ?>' <?= $disabled ? 'disabled' : 'required' ?>>
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive overflow-auto">
                    <table class="table table-hover text-center">
                      <thead class="bg-gray-table">
                        <th class="text-nowrap">No</th>
                        <th class="text-nowrap">Status</th>
                        <th class="text-nowrap">Drawing No</th>
                        <th class="text-nowrap">Drawing WM</th>
                        <th class="text-nowrap">Joint No</th>
                        <th class="text-nowrap bg-info">Cons/Lot No</th>
                        <th class="text-nowrap bg-info">WPS R/H</th>
                        <th class="text-nowrap bg-info">WPS F/C</th>
                        <th class="text-nowrap bg-info">Weld Process R/H</th>
                        <th class="text-nowrap bg-info">Weld Process F/C</th>
                        <th class="text-nowrap bg-info">Welder R/H</th>
                        <th class="text-nowrap bg-info">Welder F/C</th>
                        <th class="text-nowrap bg-info">Weld Length</th>
                        <th class="text-nowrap bg-info">Welding Date</th>
                        <th class="text-nowrap bg-primary">Inspector Name</th>
                        <th class="text-nowrap bg-primary">Inspect Date</th>
                        <th class="text-nowrap bg-primary">Inspect Time</th>
                        <th class="text-nowrap bg-primary">Area</th>
                        <th class="text-nowrap bg-primary">Location</th>
                        <th class="text-nowrap bg-primary">Invitation Type</th>
                        <th class="text-nowrap bg-primary">Legend Inspection Authority AS PER ITP</th>
                        <th class="text-nowrap bg-primary">Notes</th>
                        <th class="text-nowrap bg-primary">Vendor</th>
                        <th class="text-nowrap bg-primary">Request Tested Length</th>
                        <th class="text-nowrap bg-primary">Company Assigned</th>
                        <th class="text-nowrap bg-primary">Inspect QTY</th>
                        <th class="text-nowrap bg-primary">Expected Time</th>
                        <th class="text-nowrap bg-primary">Tag Description</th>
                        <th class="text-nowrap bg-primary">Result</th>
                      </thead>
                      <tbody>
                        <?php foreach ($sheet as $key => $value) : ?>
                          <?php if ($key > 1) : ?>

                            <?php

                            $error_list   = [];
                            $disabled     = false;
                            $key_data     = decrypt($value['A']);
                            $key_data = preg_replace("/[^0-9,.]/", "", $key_data);
                            
                            $project = $joint_list[$visual_list[$key_data]['id_joint']]['project'];
                            $discipline = $joint_list[$visual_list[$key_data]['id_joint']]['discipline'];
                            $company_id = $joint_list[$visual_list[$key_data]['id_joint']]['company_id'];
                            $company_id = $company_id == 2472 ? 2217 : $company_id;

                            if (!$key_data) {
                              $error_list[] = "Missing ID Visual. Please Re Update Excel File";
                              $disabled     = true;
                            }
                            if(!isset($visual_list[$key_data])){
                              $error_list[] = "Visual Not Found";
                              $disabled     = true;
                            }
                            if($value['E'] == ''){
                              // $error_list[] = "CONS/LOT NO is Blank";
                              // $disabled     = true;
                            }
                            if($value['F'] == ''){
                              // $error_list[] = "WPS R/H is Blank";
                              // $disabled     = true;
                            }
                            else{
                              $wps_rh_list = explode(";", $value['F']);

                              foreach ($wps_rh_list as $wps_rh) {
                                if(!isset($wps_check[$project][$company_id][$discipline][$wps_rh])){
                                  $error_list[] = "WPS R/H $wps_rh is Not Found";
                                  $disabled     = true;
                                }
                              }
                            }

                            if($value['G'] == ''){
                              $error_list[] = "WPS F/C is Blank";
                              $disabled     = true;
                            }
                            else{
                              $wps_fc_list = explode(";", $value['G']);

                              foreach ($wps_fc_list as $wps_fc) {
                                if(!isset($wps_check[$project][$company_id][$discipline][$wps_fc])){
                                  $error_list[] = "WPS F/C $wps_fc is Not Found";
                                  $disabled     = true;
                                }
                              }
                            }
                            if($value['H'] == ''){
                              // $error_list[] = "WELD PROCESS R/H is Blank";
                              // $disabled     = true;
                            } else {
                              foreach (explode(";", $value["H"]) as $key_j => $value_j) {
                                foreach (explode(";", $value['F']) as $key_f => $value_f) {
                                  if(@$welder_wps_cek[$value_f]['weld_process'][$value_j] != 1){
                                    $error_list[] = "Weld Process $value_j Not Match with WPS $value_f";
                                    $disabled     = true;
                                  }
                                }
                              }
                            }
                            if($value['I'] == ''){
                              $error_list[] = "WELD PROCESS F/C is Blank";
                              $disabled     = true;
                            } else {
                              foreach (explode(";", $value["I"]) as $key_j => $value_j) {
                                foreach (explode(";", $value['G']) as $key_f => $value_f) {
                                  if(@$welder_wps_cek[$value_f]['weld_process'][$value_j] != 1){
                                    $error_list[] = "Weld Process $value_j Not Match with WPS $value_f";
                                    $disabled     = true;
                                  }
                                }
                              }
                            }
                            if($value['J'] == ''){
                              // $error_list[] = "WELDER ID R/H is Blank";
                              // $disabled     = true;
                            } else {
                              // foreach (explode(";", $value["J"]) as $key_j => $value_j) {
                              //   foreach (explode(";", $value['F']) as $key_f => $value_f) {
                              //     if(@$welder_wps_cek[$value_f]['welder'][$value_j] != 1){
                              //       $error_list[] = "Welder $value_j Not Match with WPS $value_f";
                              //       $disabled     = true;
                              //     }
                              //   }
                              // }
                              foreach (explode(";", $value["J"]) as $key_j => $value_j) {
                                foreach (explode(";", $value['F']) as $key_f => $value_f) {
                                  if(!in_array($value_f, $welder_wps_array_cek[$value_j])){
                                    $error_list[] = "Welder $value_j Not Match with WPS $value_f";
                                    $disabled     = true;
                                  }
                                }
                              }
                            }
                            if($value['K'] == ''){
                              $error_list[] = "WELDER ID F/C is Blank";
                              $disabled     = true;
                            } else {
                              // foreach (explode(";", $value["K"]) as $key_j => $value_j) {
                              //   foreach (explode(";", $value['G']) as $key_f => $value_f) {
                              //     if(@$welder_wps_cek[$value_f]['welder'][$value_j] != 1){
                              //       $error_list[] = "Welder $value_j Not Match with WPS $value_f";
                              //       $disabled     = true;
                              //     }
                              //   }
                              // }
                              foreach (explode(";", $value["K"]) as $key_j => $value_j) {
                                foreach (explode(";", $value['G']) as $key_f => $value_f) {
                                  if(!in_array($value_f, $welder_wps_array_cek[$value_j])){
                                    $error_list[] = "Welder $value_j Not Match with WPS $value_f";
                                    $disabled     = true;
                                  }
                                }
                              }
                            }
                            if($value['L'] == ''){
                              $error_list[] = "WELD LENGTH is Blank";
                              $disabled     = true;
                            }
                            if($value['M'] == ''){
                              $error_list[] = "WELD DATE is Blank";
                              $disabled     = true;
                            }

                            $length_of_weld = (float)$joint_list[$visual_list[$key_data]['id_joint']]['weld_length'];
                            if($visual_list[$key_data]['revision_category'] != ''){
                              $length_of_weld = (float)$value['L'];
                            }
                            if($length_of_weld > (float)$joint_list[$visual_list[$key_data]['id_joint']]['weld_length']){
                              $error_list[] = "WELD LENGTH is more higher that original";
                              $disabled     = true;
                            }

                            if($post['ndt_type'] != 999999){//klo pilih transmit ndt
                              foreach (['N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB'] as $column) {
                                if(!in_array($column, ['U', 'AB']) && $value[$column] == ''){
                                  $error_list[] = $sheet[1][$column]." is Blank";
                                  $disabled     = true;
                                }
                                if(!in_array($column, ['W']) && $value[$column] != $sheet[2][$column]){
                                  $error_list[] = $sheet[1][$column]." Not Same with First Row.";
                                  $disabled     = true;
                                }
                              }

                              if(!isset($master_user[decrypt($value['N'])])){
                                $error_list[] = "Inspector Name Not Found";
                                $disabled     = true;
                              }
                              if(!isset($area[decrypt($value['Q'])])){
                                $error_list[] = "Area Not Found";
                                $disabled     = true;
                              }
                              if(!isset($location[decrypt($value['R'])])){
                                $error_list[] = "Location Not Found";
                                $disabled     = true;
                              }
                              if(!isset($invitaion_type_list[$value['S']])){
                                $error_list[] = "Invitation Type Not Found";
                                $disabled     = true;
                              }
                              if(!isset($company_list[decrypt($value['V'])])){
                                $error_list[] = "Vendor Not Found";
                                $disabled     = true;
                              }
                              $itp = explode(';', $value['T']);
                              $itp_value = [];
                              foreach ($itp as $itpsearch) {
                                if(!isset($itp_list[$itpsearch])){
                                  $error_list[] = "Legend Inspection Authority Not Found";
                                  $disabled     = true;
                                }
                                else{
                                  $itp_value[] = $itp_list[$itpsearch];
                                }
                              }

                              if((float)$value['W'] > $length_of_weld){
                                $error_list[] = "Request Tested Length is more higher than weld length";
                                $disabled     = true;
                              }
                              if(!isset($company_list[decrypt($value['X'])])){
                                $error_list[] = "Company Assigned Not Found";
                                $disabled     = true;
                              }
                              if(in_array($key_data, $cek_ndt_data)){
                                $error_list[] = "Joint Already Transmitted";
                                $disabled     = true;
                              }
                            }

                            ?>
                            <tr class="<?= $disabled ? 'alert-warning' : '' ?>">

                              <td><?= $key ?></td>
                              <td>
                                <ul>
                                  <?php foreach ($error_list as $v) : ?>
                                    <li class="text-danger font-weight-bold text-nowrap text-left"><?= $v ?></li>
                                  <?php endforeach; ?>
                                </ul>
                              </td>

                              <td>
                                <input type="hidden" name="key_data[<?= $key ?>]" value='<?= $key_data ?>' <?= $disabled ? 'disabled' : 'required' ?>>
                                <?= $joint_list[$visual_list[$key_data]['id_joint']]['drawing_no'] ?>
                              </td>

                              <td>
                              <?= $joint_list[$visual_list[$key_data]['id_joint']]['drawing_wm'] ?>
                              </td>

                              <td>
                                <?= $joint_list[$visual_list[$key_data]['id_joint']]['joint_no'].$visual_list[$key_data]['revision_category'].$visual_list[$key_data]['revision'] ?>
                              </td>

                              <td>
                                <input type="text" class="form-control" name="cons_lot_no[<?= $key ?>][]" value="<?php echo $value['E'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                              </td>

                              <td>
                                <select class="custom-select input_width" name="visual_wps_rh[<?= $key ?>][]" <?php echo ($status != "" ? "disabled" : "readonly") ?> multiple>
                                  <?php foreach ($wps_list as $keys => $value_wps) : ?>
                                    <?php if (in_array($value_wps['wps_no'], explode(";", $value["F"]))) : ?>
                                      <option selected value="<?= $value_wps['id_wps'] ?>"><?= $value_wps['wps_no'] ?></option>
                                    <?php endif; ?>
                                  <?php endforeach; ?>
                                </select>
                              </td>

                              <td>
                                <select class="custom-select input_width" name="visual_wps_fc[<?= $key ?>][]" <?php echo ($status != "" ? "disabled" : "readonly") ?> multiple>
                                  <?php foreach ($wps_list as $keys => $value_wps) : ?>
                                    <?php if (in_array($value_wps['wps_no'], explode(";", $value["G"]))) : ?>
                                      <option selected value="<?= $value_wps['id_wps'] ?>"><?= $value_wps['wps_no'] ?></option>
                                    <?php endif; ?>
                                  <?php endforeach; ?>
                                </select>
                              </td>

                              <td>
                                <select class="custom-select input_width" name="visual_weld_process_rh[<?= $key ?>][]" <?php echo ($status != "" ? "disabled" : "readonly") ?> multiple>
                                  <option <?= in_array('GTAW', explode(";", $value["H"])) ? 'selected' : '' ?> value="GTAW"><?= 'GTAW' ?></option>
                                  <option <?= in_array('SMAW', explode(";", $value["H"])) ? 'selected' : '' ?> value="SMAW"><?= 'SMAW' ?></option>
                                  <option <?= in_array('FCAW', explode(";", $value["H"])) ? 'selected' : '' ?> value="FCAW"><?= 'FCAW' ?></option>
                                  <option <?= in_array('SAW', explode(";", $value["H"])) ? 'selected' : '' ?> value="SAW"><?= 'SAW' ?></option>
                                  <option <?= in_array('GMAW', explode(";", $value["H"])) ? 'selected' : '' ?> value="GMAW"><?= 'GMAW' ?></option>
                                </select>
                              </td>

                              <td>
                                <select class="custom-select input_width" name="visual_weld_process_fc[<?= $key ?>][]" <?php echo ($status != "" ? "disabled" : "readonly") ?> multiple>
                                  <option <?= in_array('GTAW', explode(";", $value["I"])) ? 'selected' : '' ?> value="GTAW"><?= 'GTAW' ?></option>
                                  <option <?= in_array('SMAW', explode(";", $value["I"])) ? 'selected' : '' ?> value="SMAW"><?= 'SMAW' ?></option>
                                  <option <?= in_array('FCAW', explode(";", $value["I"])) ? 'selected' : '' ?> value="FCAW"><?= 'FCAW' ?></option>
                                  <option <?= in_array('SAW', explode(";", $value["I"])) ? 'selected' : '' ?> value="SAW"><?= 'SAW' ?></option>
                                  <option <?= in_array('GMAW', explode(";", $value["I"])) ? 'selected' : '' ?> value="GMAW"><?= 'GMAW' ?></option>
                                </select>
                              </td>

                              <td>
                                <select class="custom-select input_width" name="visual_welder_rh[<?= $key ?>][]" <?php echo ($status != "" ? "disabled" : "readonly") ?> multiple>
                                  <?php foreach ($welder as $keys => $value_welder) : ?>
                                    <?php if (in_array($value_welder['welder_code'], explode(";", $value["J"]))) : ?>
                                      <option selected value="<?= $value_welder['id_welder'] ?>"><?= $value_welder['welder_code'] ?></option>
                                    <?php endif; ?>
                                  <?php endforeach; ?>
                                </select>
                              </td>

                              <td>
                                <select class="custom-select input_width" name="visual_welder_fc[<?= $key ?>][]" <?php echo ($status != "" ? "disabled" : "readonly") ?> multiple>
                                  <?php foreach ($welder as $keys => $value_welder) : ?>
                                    <?php if (in_array($value_welder['welder_code'], explode(";", $value["K"]))) : ?>
                                      <option selected value="<?= $value_welder['id_welder'] ?>"><?= $value_welder['welder_code'] ?></option>
                                    <?php endif; ?>
                                  <?php endforeach; ?>
                                </select>
                              </td>

                              <td>
                                <input type="number" class="form-control" name="length_of_weld[<?= $key ?>][]" value="<?php echo $length_of_weld ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                              </td>
                              <td>
                                <input type="date" class="form-control" required name="weld_datetime[<?= $key ?>][]" value="<?php echo $value['M'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                              </td>

                              <td>
                                <?= @$master_user[decrypt($value['N'])] ?? '-' ?>
                                <input type="hidden" value="<?php echo decrypt($value['N']) ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="inspector_id[<?= $key ?>][]">
                              </td>

                              <td>
                                <input type="date" class="form-control" required name="inspection_date[<?= $key ?>][]" value="<?php echo $value['O'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                              </td>
                              <td>
                                <input type="time" class="form-control" required name="inspection_time[<?= $key ?>][]" value="<?php echo date("H:i:s", strtotime($value['P'])) ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                              </td>

                              <td>
                                <?= @$area[decrypt($value['Q'])]['name'] ? $area[decrypt($value['Q'])]['name'] : '-' ?>
                                <input type="hidden" value="<?php echo $area[decrypt($value['Q'])]['id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="area[<?= $key ?>][]">
                              </td>

                              <td>
                                <?= @$location[decrypt($value['R'])]['name'] ? $location[decrypt($value['R'])]['name'] : '-' ?>
                                <input type="hidden" value="<?php echo $location[decrypt($value['R'])]['id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="location[<?= $key ?>][]">
                              </td>
                              <td>
                                <?= $value['S'] ?>
                                <input type="hidden" name="status_invitation[<?= $key ?>][]" value="<?php echo @$invitaion_type_list[$value['S']] ?> " <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                              </td>
                              <td>
                                <?= $value['T'] ?>
                                <input type="hidden" name="legend_inspection_auth[<?= $key ?>][]" value="<?php echo @join(";", $itp_value) ?> " <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                              </td>
                              <td>
                                <input type="text" class="form-control" name="note[<?= $key ?>][]" value="<?php echo $value['U'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                              </td>
                              <td>
                                <?php echo @$company_list[decrypt($value['V'])]['company_name'] ?>
                                <input type="hidden" class="form-control" value="<?php echo $company_list[decrypt($value['V'])]['id_company'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="vendor[<?= $key ?>][]">
                              </td>
                              <td>
                                <input type="number" class="form-control" name="transmittal_request_tested_length[<?= $key ?>][]" value="<?php echo (float)$value['W'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                              </td>
                              <td>
                                <?php echo @$company_list[decrypt($value['X'])]['company_name'] ?>
                                <input type="hidden" class="form-control" value="<?php echo $company_list[decrypt($value['X'])]['id_company'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="rfi_company_assigned[<?= $key ?>][]">
                              </td>
                              <td>
                                <input type="text" class="form-control" name="qty[<?= $key ?>][]" value="<?php echo $value['Y'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                              </td>
                              <td>
                                <input type="text" class="form-control" name="expected_time[<?= $key ?>][]" value="<?php echo $value['Z'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                              </td>
                              <td>
                                <input type="text" class="form-control" name="tag_description_pickling[<?= $key ?>][]" value="<?php echo $value['AA'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                              </td>
                              <td>
                                <input type="text" class="form-control" name="result[<?= $key ?>][]" value="<?php echo $value['AB'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                              </td>
                            </tr>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-12 text-right">
                  <hr>
                  <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Submit</button>
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

<script>
  $('form').on('submit', function() {
    $('button[type=submit]').attr('disabled', true)
  })
</script>