<?php
  error_reporting(0);

  $workpack = $workpack_list;
?>

<script type="text/javascript">
var _formConfirm_submitted = false;
var _formConfirm_submitted_vs = false;
</script>

<div id="content" class="container-fluid">

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
            <h6 class="m-0"><?php echo $meta_title ?></h6>
          </div>
          <div class="card-body bg-white overflow-auto">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Filter Joint Number</label>
                  <div class="col-md">
                    
                   
                    <div class="input-group">
                      <select  class='select2_filter_joint_number form-control'  name='filter_joint_number[]' multiple required placeholder='Input Joint Number'></select>
                      <br/><br/>                
                        <button type='button' class="btn btn-info" onclick="filter_joint_redirect();">
                          <i class="fa fa-search"></i> Search
                        </button>                      
                    </div>                  
                

                  </div>
                </div>
              </div> 

            </div>
             
          </div>
        </div>
      </div>
    </div> 

    

    <?php if(sizeof($joint_list) > 0){ ?>

      <form action="<?= site_url('planning/save_update_to_baa') ?>" method="post" id="form_submition_fu" onsubmit="if( _formConfirm_submitted == false ){ _formConfirm_submitted = true;return true }else{ alert('Please Wait, Server still busy, wait till process done, Thanks!'); return false;  }"  enctype="multipart/form-data" >

              <input type="hidden" name="wp_no" value="<?= $workpack['workpack_no'] ?>">
              <input type="hidden" name="wp_id" value="<?= @$joint_list[0]['workpack_id'] ?>">
              <input type="hidden" name="module_save" value="<?= $workpack['module'] ?>">
              <input type="hidden" name="project_save" value="<?= $workpack['project'] ?>">
              <input type="hidden" name="discipline_save" value="<?= $workpack['discipline'] ?>">
              <input type="hidden" name="type_of_module_save" value="<?= $workpack['type_of_module'] ?>">  
              <input type="hidden" name="drawing_type_save" value="<?= @$joint_list[0]['drawing_type_template'] ?>">
              <input type="hidden" class="form-control" name="id" value="<?php echo @$workpack['id'] ?>">
              <input type="hidden" name="company_id_save" value="<?= $workpack['company_id'] ?>">

      <div class="row">
        <div class="col">
          <div class="card shadow my-3 rounded-0">
            <div class="card-header">
              <h6 class="m-0"><?php echo $meta_title ?> - BONDSTRAND</h6>
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
                          <input type='text' name='company' class='form-control' value='<?= $company_name[$joint_list[0]['company_id']] ?>' readonly>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Area</label>
                      <div class="col-md-8 col-lg-9">
                      <select class="select2" name="area" required>
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
                      <select class="select2" name="location" required>
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
            <h6 class="m-0"><?php echo $meta_title ?> - BONDSTRAND Progress</h6>
          </div>
          <div class="card-body bg-white">
            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable" id='table_submission'>
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th style="width: 10px !important;">#</th>
                    <th style="width: 260px !important;">Weld Map Drawing Number</th>
                    <th style="width: 50px !important;">Joint No</th>
                    <th style="width: 50px !important;">OD (Inch)</th>
                    <th style="width: 50px !important;">Spool No</th>

                    <th style="width: 50px !important;">SANDING (40-60Grit)</th>
                    <th style="width: 50px !important;">Clean & Dry</th>

                    <th style="width: 155px !important;">Part ID</th>
                    <th style="width: 190px !important;">Unique ID Number</th>  

                    <th style="width: 120px !important;">Bonder ID</th>
                    <th style="width: 120px !important;">Time Start</th>
                    <th style="width: 120px !important;">Time Finish</th>

                    <th style="width: 200px !important;">Remarks</th>  
                    <th style="width: 200px !important;">Status Inspection</th>  
                    <th style="width: 200px !important;">Inspection By</th> 
                    <th style="width: 200px !important;">Inspection Date</th> 
                    <th style="width: 200px !important;">Status Surveyor</th>
                    <th style="width: 200px !important;">Evidence Of Progress</th> 
                    <th>Progress On (%)</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no=0; $total_progress=0;  foreach ($joint_list as $key => $value): ?>

                   

                    <?php 
                    

                    if(isset($value['status_inspection'])){
                      
                      $status_data = 2; 

                    } else {

                      $array_no_oke = array(0,1,2,4,12);

                      if(isset($status_piecemark[$value['pos_1']]['id_mis']) && isset($status_piecemark[$value['pos_1']]['id_mis'])){ 

                          if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '0' OR @$status_piecemark[$value['pos_2']]['status_inspection'] == '0'){
                             $status_data = 2; //red
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '1' OR @$status_piecemark[$value['pos_2']]['status_inspection'] == '1'){
                             $status_data = 2; //red
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '2' OR @$status_piecemark[$value['pos_2']]['status_inspection'] == '2'){ 
                             $status_data = 2; //green
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '3' OR @$status_piecemark[$value['pos_2']]['status_inspection'] == '7'){
                             $status_data = 3; //green 
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '7' OR @$status_piecemark[$value['pos_2']]['status_inspection'] == '3'){ 
                             $status_data = 3; //green
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '3' AND @$status_piecemark[$value['pos_2']]['status_inspection'] == '3'){ 
                             $status_data = 3; //green
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '4' OR @$status_piecemark[$value['pos_2']]['status_inspection'] == '4'){
                             $status_data = 0; //blue
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '5' OR @$status_piecemark[$value['pos_2']]['status_inspection'] == '5'){
                             $status_data = 3; //green
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '7' OR @$status_piecemark[$value['pos_2']]['status_inspection'] == '7'){ 
                             $status_data = 3; //green 
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '9' OR @$status_piecemark[$value['pos_2']]['status_inspection'] == '9'){ 
                             $status_data = 3; //green   
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '10' OR @$status_piecemark[$value['pos_2']]['status_inspection'] == '10'){ 
                             $status_data = 3; //green    
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '11' OR @$status_piecemark[$value['pos_2']]['status_inspection'] == '11'){ 
                             $status_data = 3; //green    
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '12' OR @$status_piecemark[$value['pos_2']]['status_inspection'] == '12'){ 
                              $status_data = 2; //green      
                          } else {
                             $status_data = 2; //red
                            //echo "8";
                          }

                      }  else {

                        $array_status = array();
                        if(isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])){

                          $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_1']]["ref_pos_1"]); 
                          foreach($data_multiple_piecemark_1 as $vaxx){ 

                            if(in_array($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['status_inspection'],$array_no_oke)){
                              $status_data = 2; 
                            } else {
                              $status_data = 3;
                            }

                            array_push($array_status,$status_data);

                          }

                        } else {
                          if(isset($status_piecemark[$value['pos_1']]['id_mis'])){
                            if(in_array($status_piecemark[$value['pos_1']]['status_inspection'],$array_no_oke)){
                              $status_data = 2;  
                            } else {
                              $status_data = 3;
                            } 
                            array_push($array_status,$status_data);
                          } else {
                            $status_data = 2; 
                            array_push($array_status,$status_data); 
                          }
                        }

                        if(isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])){

                          $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_2']]["ref_pos_1"]); 
                          foreach($data_multiple_piecemark_1 as $vaxx){ 

                            if(in_array($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['status_inspection'],$array_no_oke)){
                              $status_data = 2; 
                            } else {
                              $status_data = 3;
                            }

                            array_push($array_status,$status_data);

                          }

                        } else {  
                          if(isset($status_piecemark[$value['pos_2']]['id_mis'])){
                            if(in_array($status_piecemark[$value['pos_2']]['status_inspection'],$array_no_oke)){
                              $status_data = 2; 
                            } else {
                              $status_data = 3;
                            } 
                            array_push($array_status,$status_data);
                          } else {
                            $status_data = 2;  
                            array_push($array_status,$status_data);
                          }
                       }

                         if(in_array(2,$array_status)){
                          $status_data = 2;
                         } else {
                          $status_data = 3;
                         }
 
                      }

                    }
                    ?>
                  <tr>

                    <td>
                     
                      <?php if($value["progress_baa"] >= 100){ ?>
                      <?php

                        if($status_data == 0){
                          echo "<span style='font-weight:bold;font-size:25px;color:blue'>&#128504;</span>";
                        } else if($status_data == 2){
                          echo "<span style='font-weight:bold;font-size:20px;color:green'>&#128504;</span>";
                        } else if($status_data == 1){
                          echo "<span style='font-weight:bold;font-size:15px;color:green'>&#128504;</span>";
                        } else if($status_data == 3){
                          ?>
                          <input type='hidden' name='id_joint[<?php echo $no; ?>]' value='<?php echo $value['id_jn_temp']; ?>'>
                          <input type="text" name="drawing_no_save[<?php echo $no; ?>]" value="<?= $value['drawing_no_temp'] ?>">
                          <input type="hidden" name="id_wp_save[<?= $no ?>]" value="<?= $value['id_wp_main'] ?>">
                          <input type='checkbox' class="checkbox-big" name='submit_id[<?php echo $no; ?>]' onclick='open_disabled_form(this,"<?php echo $no; ?>","0")'>
                          <input type='hidden' name='filter_check[<?php echo $no; ?>]' value='0'>
                         <?php
                        } 
                      ?>
                      <?php } else { ?>
                        <span class='btn btn-danger' title="Waiting actual progress 100%"><i class="fas fa-times-circle"></i></span>
                      <?php } ?>               
                    </td>

                    <td><?php echo $value['drawing_wm'] ?> Rev.<?php echo $value['rev_wm'] ?></td>

                    <td>                      
                        <?php if(strlen($value['evidence_fu'])>1){ ?>
                          <!-- <a href="<?= $this->link_server  ?>/pcms_v2_photo/<?= $value['evidence_fu'] ?>"><?= $value['joint_no'] ?></a> -->
                            <?php  
                                $enc_redline = strtr($this->encryption->encrypt($value['evidence_fu']), '+=/', '.-~');
                                $enc_path   = strtr($this->encryption->encrypt('/PCMS/mobile/pcms_v2_mobile/pcms_v2_photo/'), '+=/', '.-~'); 
                            ?>
                            <a target='_blank' href='<?= site_url('irn/open_file/'.$enc_redline.'/'.$enc_path) ?>'><?= $value['joint_no'] ?></a>
                        <?php } else { ?>
                          <?php echo $value['joint_no'] ?>
                        <?php } ?>
                    </td>

                    <td>
                      <?php echo $value['jn_diameter'] ?>
                    </td>

                    
                    <td>
                      <?php echo (isset($value['jn_spool_no']) ? $value['jn_spool_no'] : "-")?>
                    </td>

                    <td>
                        <label><input type='radio' name='sanding_40_60[<?php echo $no; ?>]' value='OK' <?php if($value['sanding_40_60'] != "NO"){ ?> checked <?php } ?>> OK</label>
                        <br/>
                        <label><input type='radio' name='sanding_40_60[<?php echo $no; ?>]' value='NO'<?php if($value['sanding_40_60'] == "NO"){ ?> checked <?php } ?>> NO</label>
                    </td>
                    

                    <td>
                        <label><input type='radio' name='clean_dry[<?php echo $no; ?>]' value='OK' <?php if($value['clean_dry'] != "NO"){ ?> checked <?php } ?>> OK</label>
                        <br/>
                        <label><input type='radio' name='clean_dry[<?php echo $no; ?>]' value='NO' <?php if($value['clean_dry'] == "NO"){ ?> checked <?php } ?>> NO</label>
                    </td>

                    <td>
                      <span class='badge'><?php echo $value['pos_1'] ?></span>
                      <br/>
                      <?php if(isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])){ ?>
                        <?php 
                            $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_1']]["ref_pos_1"]); 
                            foreach($data_multiple_piecemark_1 as $vaxx){ 
                                 
                                echo  "<span class='badge'>".$status_piecemark_ref_1[$vaxx]["part_id"]."</span> <br/>";
                            }
                        ?>
                      <?php } ?>
                      <hr/>
                      <span class='badge'><?php echo $value['pos_2'] ?></span>
                      <br/>
                      <?php if(isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])){ ?>
                        <?php 
                            $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_2']]["ref_pos_1"]); 
                            foreach($data_multiple_piecemark_1 as $vaxx){  
                                echo  "<span class='badge'>".$status_piecemark_ref_1[$vaxx]["part_id"]."</span> <br/>";
                            }
                        ?>
                      <?php } ?>
                    </td>

                    <td>
                    <?php if(isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])){ ?>
                        <?php 
                            $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_1']]["ref_pos_1"]); 
                            foreach($data_multiple_piecemark_1 as $vaxx){ 
                              if(in_array($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['status_inspection'],$array_no_oke)){
                                echo "<span class='badge badge-warning'>Not Ready in MTR Verification</span>";
                              } else {
                                echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['unique_ident_no']."</span><br/>";
                              }
                            }
                        ?>
                      <?php } else { ?>
                    <?php 
                      if(isset($status_piecemark[$value['pos_1']]['id_mis'])){ 

                          if($status_piecemark[$value['pos_1']]['status_inspection'] == '0'){
                            echo "<span class='badge badge-warning'>Not Ready in MTR Verification</span>";
                          } else if($status_piecemark[$value['pos_1']]['status_inspection'] == '1'){
                            echo "<span class='badge badge-warning'>MTR Verification - Pending Approval</span>";
                          } else if($status_piecemark[$value['pos_1']]['status_inspection'] == '2'){
                            echo "<span class='badge badge-warning'>MTR Verification - Rejected</span>"; 
                          } else if($status_piecemark[$value['pos_1']]['status_inspection'] == '3'){
                            echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no']."</span>";
                          } else if($status_piecemark[$value['pos_1']]['status_inspection'] == '4'){
                            echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no']."</span>";
                          } else if($status_piecemark[$value['pos_1']]['status_inspection'] == '5'){
                            echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no']."</span>";   
                          } else if($status_piecemark[$value['pos_1']]['status_inspection'] == '7'){
                            echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no']."</span>";
                          } else if($status_piecemark[$value['pos_1']]['status_inspection'] == '9'){
                            echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no']."</span>";  
                          } else if($status_piecemark[$value['pos_1']]['status_inspection'] == '10'){
                            echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no']."</span>"; 
                          } else if($status_piecemark[$value['pos_1']]['status_inspection'] == '11'){
                            echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no']."</span>";            
                          } else if($status_piecemark[$value['pos_1']]['status_inspection'] == '12'){
                            echo "<span class='badge badge-secondary'>MTR Verification - Void</span>"; 
                          } 

                      } else {  
                           echo "<span class='badge badge-warning'>Not Ready in MTR Verification</span>";
                      } 
                    ?>
                    <?php } ?>
                    <hr/>
                    <?php if(isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])){ ?>
                        <?php 
                            $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_2']]["ref_pos_1"]); 
                            foreach($data_multiple_piecemark_1 as $vaxx){ 
                              if(in_array($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['status_inspection'],$array_no_oke)){
                                echo "<span class='badge badge-warning'>Not Ready in MTR Verification</span>";
                              } else {
                                echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['unique_ident_no']."</span><br/>";
                              }
                            }
                        ?>
                    <?php } else { ?>
                    <?php 
                      if(isset($status_piecemark[$value['pos_2']]['id_mis'])){ 

                          if($status_piecemark[$value['pos_2']]['status_inspection'] == '0'){

                            echo "<span class='badge badge-warning'>Not Ready in MTR Verification</span>";
                          } else if($status_piecemark[$value['pos_2']]['status_inspection'] == '1'){
                            echo "<span class='badge badge-warning'>MTR Verification - Pending Approval</span>";
                          } else if($status_piecemark[$value['pos_2']]['status_inspection'] == '2'){
                            echo "<span class='badge badge-warning'>MTR Verification - Rejected</span>"; 
                          } else if($status_piecemark[$value['pos_2']]['status_inspection'] == '3'){
                            echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";
                          } else if($status_piecemark[$value['pos_2']]['status_inspection'] == '4'){
                            echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";
                          } else if($status_piecemark[$value['pos_2']]['status_inspection'] == '5'){
                            echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";  
                          } else if($status_piecemark[$value['pos_2']]['status_inspection'] == '7'){
                            echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";  
                          } else if($status_piecemark[$value['pos_2']]['status_inspection'] == '9'){
                            echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no']."</span>";  
                          } else if($status_piecemark[$value['pos_2']]['status_inspection'] == '10'){
                            echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no']."</span>"; 
                          } else if($status_piecemark[$value['pos_2']]['status_inspection'] == '11'){
                            echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no']."</span>";   
                          } else if($status_piecemark[$value['pos_2']]['status_inspection'] == '12'){
                            echo "<span class='badge badge-secondary'>MTR Verification - Void</span>"; 
                          }  

                      } else {  

                          echo "<span class='badge badge-warning'>Not Ready in MTR Verification</span>";
                      } 
                    ?>  
                    <?php } ?>                 
                  </td>

                   

                    

                  <td>
                      <?php if(!isset($value['status_inspection'])){ ?>
                        <select  class='select2_multiple_fitter' name='bonder_id[<?php echo $no; ?>][]' multiple required disabled></select>
                      <?php 
                        } else {
                          $fitter_id_display = explode(";", $value['bonder_id']);
                          foreach ($fitter_id_display as $key => $val_fitter) {
                            if(isset($bonder_code_arr[$val_fitter])){
                              echo "<span class='badge'>".$bonder_code_arr[$val_fitter]."</span><br/>";
                            }
                          }
                        } 
                      ?>
                  </td>

                  <td> 
                    <input type="datetime-local" name= 'adhesive_time_start[<?php echo $no; ?>]' value='<?php echo $value["adhesive_time_start"]; ?>' required>
                  </td>
                      
                  <td>
                    <input type="datetime-local"name= 'adhesive_time_stop[<?php echo $no; ?>]' value='<?php echo $value["adhesive_time_stop"]; ?>' required>
                  </td>

                   
                  <td>
                    <?php if(!isset($value['status_inspection'])){ ?>
                        <textarea name='remarks[<?php echo $no; ?>]' placeholder="---" disabled></textarea>                    
                    <?php } else { ?>  
                        <?php if(!empty($value["remarks_baa"])){ echo $value["remarks_baa"]; } else { echo "-"; } ?>           
                    <?php } ?>                    
                  </td>

               

                  <td>
                    <?php if($value['status_inspection_svy'] == '0'){ ?>
                        <span class='btn btn-info'>Pending Transmit SMOE Inspection</span>
                    <?php } else if($value['status_inspection_svy'] == '1'){ ?>
                        <span class='btn btn-primary'>Pending SMOE Inspection</span>
                    <?php } else if($value['status_inspection_svy'] == '2'){ ?>
                        <span class='btn btn-danger'>Rejected SMOE Inspection</span>
                    <?php } else if($value['status_inspection_svy'] == '3'){ ?>
                        <span class='btn btn-success'>Approved SMOE Inspection</span>
                    <?php } else if($value['status_inspection_svy'] == '4'){ ?>
                        <span class='btn btn-primary'>Pending By SMOE QC</span>
                    <?php } else if($value['status_inspection_svy'] == '5'){ ?>
                        <span class='btn btn-primary'>Pending CLIENT Inspection</span>
                    <?php } else if($value['status_inspection_svy'] == '6'){ ?>
                        <span class='btn btn-danger'>Rejected CLIENT Inspection</span>
                    <?php } else if($value['status_inspection_svy'] == '7'){ ?>
                        <span class='btn btn-success'>Approved CLIENT Inspection</span>
                    <?php } else if($value['status_inspection_svy'] == '9'){ ?>
                        <span class='btn btn-success'>Approved & Released With Comment CLIENT Inspection</span>  
                    <?php } else if($value['status_inspection_svy'] == '10'){ ?>
                        <span class='btn btn-info'>Postponed CLIENT Inspection</span>     
                    <?php } else if($value['status_inspection_svy'] == '11'){ ?>
                        <span class='btn btn-info'>Postponed CLIENT Inspection</span>     
                    <?php } else { ?>
                        <span class='btn btn-secondary'>Pending Surveyor</span>
                    <?php } ?>
                  </td>

                  <td>
                    <?php if(isset($value['inspection_by_svy'])){ echo $user_list[$value['inspection_by_svy']]['full_name']; } else { echo "-"; } ?>
                  </td>

                  <td>
                    <?php if(isset($value['inspection_date_svy'])){ echo date("Y-m-d H:i:s",strtotime($value['inspection_date_svy'])); } else { echo "-"; } ?>
                  </td>

                  <td>
                    <?php $exlode_status_surveyor = explode(";",$value['status_surveyor']); ?>
                      <select name='status_surveyor[<?php echo $no; ?>][]' class='form-control select2_multiple_status_surveyor' required multiple>
                            <option value=''>~ Choose ~</option>
                            <?php foreach($surveyor_status as $key => $srvyr_status){ ?>
                              <option value='<?php echo $srvyr_status["id"] ?>' <?= in_array($srvyr_status["id"],$exlode_status_surveyor) ? "selected" : null ?>><?php echo $srvyr_status["description"] ?></option>
                            <?php } ?>
                      </select>
                    </td>

                  <td><input type="file" name="attachment_surveyor_fu[<?php echo $no; ?>]" required disabled></td>

                    <td>                     
                      <?php if($status_data == 3){ ?>
                        <select name='progress_on_percentage' onchange='update_percent_detail(this,<?php echo $value["id_wp_main"]; ?>,<?php echo $value["id_jn_temp"]; ?>,"progress_baa","<?php echo $workpack['phase']; ?>","<?php echo $value['pos_1']; ?>","<?php echo $value['pos_2']; ?>");'>
                          <option value='0' <?php if($value["progress_baa"] == 0 OR !isset($value["progress_baa"])){ echo "selected"; } ?>>0%</option>
                          <option value='25' <?php if($value["progress_baa"] == 25){ echo "selected"; } ?>>25%</option>
                          <option value='50' <?php if($value["progress_baa"] == 50){ echo "selected"; } ?>>50%</option>
                          <option value='75' <?php if($value["progress_baa"] == 75){ echo "selected"; } ?>>75%</option>
                          <option value='100' <?php if($value["progress_baa"] == 100){ echo "selected"; } ?>>100%</option>
                        </select>
                      <?php } else if($status_data == 2 AND $value['status_inspection'] == '0'){ ?>
                          <span class='btn btn-warning' title="Waiting RFI Submition List"  onclick="delete_fitup_data('<?php echo $value['id_fitup']; ?>');"><i class="fas fa-undo-alt"></i></span>
                       <?php } else if(isset($value['status_inspection']) AND $value['status_inspection'] != '0'){ ?>
                          <span class='btn btn-warning' title="RFI Submited!"><i class="fas fa-user-check"></i></span>    
                      <?php } else { ?>
                      <span class='btn btn-danger' title="Material still not ready.."><i class="fas fa-times-circle"></i></span>
                      <?php } ?>
                    </td>  

                  </tr>
                  <?php if($value["progress_baa"] >= 0){ $total_progress++; } $no++; endforeach; ?>
                </tbody>
              </table>
            </div>  
            <?php if($total_progress > 0){ ?> 
            <br>
            <br>
            <div class="text-right">
              <button type="submit" id="btn_submit" class="btn btn-success" disabled onclick="sweetalert('confirm', 'Are you sure?', this, event)">
                <i class="fas fa-check"></i> Submit
              </button>
            </div>
            <?php } ?>        
          </div>
        </div>
      </div>
    </div>
    
  </form>
    
  <?php } ?>  

</div>
</div>
<script>
var checked = []
  $("#table_submission").on('click', '.check', function() {
    var editable = $(this).closest('tr').find('.editable')
    var value = $(this).val()
    if (this.checked) {
      editable.removeAttr('disabled')
      checked.push(value)
    } else {
      editable.removeClass('is-valid is-invalid');
      editable.attr('disabled', true)
      checked.splice($.inArray(value, checked), 1)
    }

    if (checked.length > 0) {
      if (checked.length > 30) {
        this.checked = false
        editable.attr('disabled', true)
        checked.splice($.inArray(value, checked), 1)

        Swal.fire({
          type: "warning",
          title: "Warning",
          text: "Only 30 Data Allowed In Each Submission"
        })

      } else {
        $("#btn_submit").removeAttr('disabled')
      }
    } else {
      $("#btn_submit").attr('disabled', true)
    }
  })

  function remove_disabledwelder(type,no){
    if(type == 'rh'){
      var weld_process_rh = $("#weld_process_rh"+no).val();
      var total_weld_process_rh = weld_process_rh.length;
      if(total_weld_process_rh > 0){
        $('.will_enable_after_processrh'+no).removeAttr('disabled');
      } else {
        $('.will_enable_after_processrh'+no).attr('disabled', true)
      }
    } else {
       var weld_process_fc = $("#weld_process_fc"+no).val();
       var total_weld_process_fc = weld_process_fc.length;
      if(total_weld_process_fc > 0){
        $('.will_enable_after_processfc'+no).removeAttr('disabled');
      } else {  
        $('.will_enable_after_processfc'+no).attr('disabled', true)
      }
    }
  }


  function validate_unique_no(input, workpack_no, grade) {

    var unique_no            = $(input).val()
    var invalid_feedback     = $(input).closest('tr').find('.invalid-feedback')
    var mrir                 = $(input).closest('tr').find('.mrir')
    var heat_no              = $(input).closest('tr').find('.heat_no')
    var material_description = $(input).closest('tr').find('.material_description')
    var id_mis               = $(input).closest('tr').find('.id_mis')

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


function autocomplete_unique(input, workpack_no, grade){
  $(input).autocomplete({
    source: "<?php echo base_url(); ?>material_verification/autocomplete_unique_no/"+workpack_no+"/"+grade,
    autoFocus: true,
    classes: {
      "ui-autocomplete": "highlight"
    }
  });
}

  $("select[name=module]").chained("select[name=project]");

  $('.dataTable').DataTable({
      lengthMenu: [ [ -1], [ "All"] ],
      // pageLength: 10,
      order: [],
      columnDefs: [{
        "targets": 0,
        "pageLength": 10
        //"orderable": false,
      }]
  })


    // $('.dataTable').DataTable({
    //      "paging":   false,
    //      "ordering": false, 
    // })

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


  function update_percent_detail(input,wp_id, temp_id, progress,phase,pos_1,pos_2) {

    var percent_val = $(input).val();

    console.log(percent_val);

    Swal.fire({
      title: 'Are you sure to <b class="text-danger">&nbsp;Update&nbsp;</b> this?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Update it!',
     
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
            pos_1: pos_1,
            pos_2: pos_2,
          },          
          type: 'post',
          beforeSend: function() {
            Swal.fire({
                title: 'Please Wait !',
                html: 'Processing Data',// add html attribute if you want or remove
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            });
          },
          success: function(data) {
            sweetalert("success", "Update Data Success!");
            location.reload();
            swal.close();
          }
        });
      }
    })

  }

  function delete_fitup_data(id_fitup) {

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
          url: "<?php echo base_url() ?>planning/delete_fitup_data",
          data: {
            id_fitup: id_fitup
          },
          type: 'post',
          success: function(data) {
            sweetalert("success", "Delete Data Success!");
            location.reload();
          }
        });
      }
    })

  }

   function delete_visual_data(id_visual) {

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
          url: "<?php echo base_url() ?>planning/delete_visual_data",
          data: {
            id_visual: id_visual
          },
          type: 'post',
          success: function(data) {
            sweetalert("success", "Delete Data Success!");
            location.reload();
          }
        });
      }
    })

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
               $('input[name="attachment_surveyor_fu['+no+']"]').prop("disabled", false);
               $('select[name="bonder_id['+no+'][]"]').prop("disabled", false); 
               $('textarea[name="remarks['+no+']"]').prop("disabled", false);
               $('input[name="filter_check['+no+']"]').val(1);
            } else {
               $('select[name="bonder_id['+no+'][]"]').prop("disabled", true); 
               $('textarea[name="remarks['+no+']"]').prop("disabled", true);
               $('input[name="attachment_surveyor_fu['+no+']"]').prop("disabled", true);

               if(status_inspection != 2 && status_inspection != 4 && status_inspection != 6){

                 $('select[name="bonder_id['+no+'][]"]').find('option:selected').remove(); 

               }

               $('input[name="filter_check['+no+']"]').val(0);
            }

          } else {

             alert("Sorry, Data checked has been maximum..");
             $('select[name="bonder_id['+no+'][]"]').prop("disabled", true); 
             $('textarea[name="remarks['+no+']"]').prop("disabled", true);
             $('input[name="attachment_surveyor_fu['+no+']"]').prop("disabled", true);

             if(status_inspection != 2 && status_inspection != 4){

               $('select[name="fitter_id['+no+'][]"]').find('option:selected').remove(); 

             }

             $('input[name="filter_check['+no+']"]').val(0);

          }
      });

      

    }


</script>

<script type="text/javascript">

  $(document).ready(function() {

      $(".select2_multiple_status_surveyor").select2({
        tokenSeparators: [',', ' '],
      })

      $(".select2_multiple_status_surveyor_vis").select2({
        tokenSeparators: [',', ' '],
      })


      $(".select2_multiple_fitter").select2({
        //tags: true,
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
 
 

  var selecteds = 0

  function enable_edit(no, thiss){
    if(thiss.checked==true){
      selecteds++
      console.log(selecteds)
      console.log('yes')
      $('.will_enable'+no).removeAttr('disabled');
      $('.will_enable'+no).prop('required', true);
      if(selecteds>=30){
        $('.checkbox-big').addClass('disabled-effect')
      }
    } else {
      selecteds--
      console.log('not')
      console.log(selecteds)
      $('.will_enable'+no).prop('disabled', true);
      $('.will_enable'+no).removeAttr('required');
    }
    $("#thicked b").text(' '+selecteds);
    
    if($(thiss).prop("checked") == true){ 
        $('input[name="filter_check['+no+']"]').val(1);
      } else { 
        $('input[name="filter_check['+no+']"]').val(0);
      } 
  }


  function filter_joint_redirect(){

    var link_current = "<?= base_url(); ?>planning/surveyor_detail_baa/<?= strtr($this->encryption->encrypt($workpack_id_data), '+=/', '.-~') ?>";
    var arrayJointNumber = $('.select2_filter_joint_number').val();
    var forLink = arrayJointNumber.join("-");

    var fullLink = "<?= base_url(); ?>planning/surveyor_detail_baa/<?= strtr($this->encryption->encrypt($workpack_id_data), '+=/', '.-~') ?>/"+forLink;
    location.href = fullLink; 

  }



</script>

<script type="text/javascript">
  $("select[name=location]").chained("select[name=area]");
</script>