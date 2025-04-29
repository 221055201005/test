<style type="text/css">
  .table {
    font-size: 100% !important;
    padding: 2px !important;
  }

  /* .select2-container {
    font-size: 70% !important;
    width: 100px !important;
    height: 20px !important;
  } */

  input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(1.5); /* Safari and Chrome */
  -o-transform: scale(1.5); /* Opera */
  padding: 10px;
}
</style>


<div id="content" class="container-fluid"> 

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <?php if($mode != 'transmittal'){ ?>
            <h6 class="m-0">Filter Data For Submission</h6>
          <?php } else { ?>
            <h6 class="m-0">Filter Data For Transmittal</h6>
          <?php } ?>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="" method="POST" id='form-update'>
            <div class="row">
               <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Project ID</label>
                  <div class="col-xl">
                    <select class="form-control" name="project" required disabled>
                      <option value="">---</option>
                      <?php foreach ($project_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : ($user_cookie[10] == $value['id'] ? 'selected' : '')) ?>><?php echo $value['project_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Drawing Type</label>
                  <div class="col-xl">
                    <select class="form-control" name="drawing_type" disabled>
                      <option value="">---</option>
                      <option value="1" <?php echo (@$get['drawing_type'] == '1' ? 'selected' : '') ?>>GA</option>
                      <option value="2" <?php echo (@$get['drawing_type'] == '2' ? 'selected' : '') ?>>Assembly</option>
                      <option value="3" <?php echo (@$get['drawing_type'] == '3' ? 'selected' : '') ?>>Weldmap</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row">

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="module" disabled>
                      <option value="">---</option>
                      <?php foreach ($module_list as $key => $value) : ?>
                      <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$get['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Type Of Module</label>
                  <div class="col-xl">
                   <select class="form-control" name="type_of_module" disabled>
                      <option value="">---</option>
                      <?php foreach ($type_of_module_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>             

            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Discipline</label>
                  <div class="col-xl">
                    <select class="form-control" name="discipline" disabled>
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Drawing Number</label>
                  <div class="col-xl">
                    <input type="text" class="form-control autocomplete_doc" name="drawing_no" value="<?php echo @$get['drawing_no'] ?>" required  <?php if(isset($status_client_rejected)){ ?> readonly <?php } ?>>
                    <span style="color:red;font-weight: bold;font-style: italic;">Please choice Drawing Number</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
                <div class="col-6">
                <div class="form-group row">
                 
                </div>
              </div>
             
              <div class="col-6">
                <div class="form-group row">
                  
                </div>
              </div>
            </div>

            <div class="row">
              
               <div class="col-6">
                <div class="form-group row">
                 <label class="col-md-4 col-lg-3 col-form-label ">Weld Map Number</label>
                  <div class="col-xl">
                    <input type="text" class="form-control autocomplete_wm" name="drawing_wm" value="<?php echo @$get['drawing_wm'] ?>" <?php if($mode == 'transmittal'){ ?> required <?php } ?> <?php if(isset($status_client_rejected)){ ?> readonly <?php } ?>>
                    <?php if($mode == 'transmittal'){ ?>
                    <span style="color:red;font-weight: bold;font-style: italic;">Please choice Weld Map Number</span>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>

            <?php if(!isset($status_client_rejected)){ ?>

            <div class="row">
             
                <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Joint Class</label>
                  <div class="col-xl">
                    <select class="form-control" name="joint_class">
                      <option value="">---</option>
                      <?php foreach ($list_of_class as $key => $value) { ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['joint_class'] == $value['id'] ? 'selected' : '') ?>><?php echo $value["class_name"]; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
               <div class="col-6">
                <div class="form-group row">
                 <label class="col-md-4 col-lg-3 col-form-label ">Workpack Number</label>
                  <div class="col-xl">
                    <select class="form-control" name="workpack_number">
                      <option value="">---</option>
                      <?php foreach($workpack_list as $value){ ?>
                        <option value="<?= $value['id'] ?>" <?php echo (@$get['workpack_number'] == $value['id'] ? 'selected' : '') ?>><?= $value['workpack_no'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>

          <?php } ?>

            <div class="row">
              <div class="col-12 text-right">
                <button id='button_search' class="mt-2 btn btn-sm btn-flat btn-info" disabled><i class="fas fa-search"></i> Search</button>
                <button type="button" class="mt-2 btn btn-sm btn-flat btn-warning" onclick="reset_form();"><i class="fas fa-sync-alt"></i> Reset</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>



  <?php if(isset($joint_list)){ ?>



      <form action="<?php echo base_url(); ?>fitup/update_data_fitup_ns" method='POST' id="form_submition">


  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Filter Data Result :</h6>
        </div>
        <div class="card-body bg-white">
        <?php if ($mode == "transmittal" && isset($drawing_fltr)): ?> 
              <div class="row">
                <div class="col-md-12">
                  <strong><i>Inspection Detail</i></strong>
                </div>
                <div class="col-md-6 mt-2">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Inspector Name</label>
                    <div class="col-xl">
                      <select name="inspector_id"  class="select2" style="width: 100%" required>
                        <option value="">---</option>
                        <?php foreach ($user_list_inspector as $key => $value): ?> 
                         <option value="<?= $value['id_user'] ?>"><?= $value['full_name'] ?></option>
                         <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Inspect Date</label>
                    <div class="col-xl">
                      <input type="date" name="inspect_date" class="form-control" value="<?= date('Y-m-d') ?>"
                        required>
                    </div>
                  </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Inspect Time</label>
                    <div class="col-xl">
                      <input type="time" name="inspect_time" class="form-control" value="<?= date('H:i:s') ?>"
                        required>
                    </div>
                  </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Inspect Location</label>
                    <div class="col-xl">
                      <select name="inspect_location" class="select2" style="width:100%" required>
                        <?php foreach ($area_list as $key => $value): ?>
                        <option value="<?= $value['id'] ?>"><?= $value['area_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Client Notification</label>
                    <div class="col-xl">
                      <select name="status_invitation" class="form-control" style="width:100%" required>
                          <option value="">~ Choice ~</option>
                          <option value="0">Notification - Client Invitation Witness</option>
                          <option value="1">Notification - SMOE Activity</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Legend Inspection Authority AS PER ITP</label>
                    <div class="col-xl">
                      <select name="legend_inspection_auth[]" class="select2" style="width:100%" multiple="" required>
                          <option value="">~ Choice ~</option>
                          <option value="0">Hold Point</option>
                          <option value="1">Witness</option>
                          <option value="2">Monitoring</option>
                          <option value="3">Review</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
             <?php endif; ?>

          <div class="overflow-auto">
            <?php if (isset($drawing_fltr)): ?> 
              <?php if (in_array(@$get['status_inspection'], array("-", "null", "2", "4"))){ ?>
              <b class="text-primary"><i class="fas fa-info-circle"></i> Checked <span id='total_data_checked'>0</span> Joint from maximum 30 Joint submission</b><br/><br/>
              <?php } ?>
              <?php if($mode == 'transmittal'){ ?>
                 <?php if(sizeof($joint_list) > 0){ ?>
                    <b class="text-primary"><i class="fas fa-info-circle"></i> Checked <span id='total_data_checked'>0</span> Joint from maximum 30 Joint submission</b><br/><br/>
                 <?php } ?>
              <?php } ?>

            <?php elseif (!isset($drawing_fltr)): ?>
                <?php if($mode == 'transmittal'){ ?>
                   <?php if(!isset($get['drawing_no']) OR !isset($get['drawing_wm'])){ ?>
                     <b class="text-primary"><i class="fas fa-info-circle"></i> You need to filter Drawing Number & Weld Map Number to start transmit RFI</b><br/><br/>
                  <?php } ?>
                <?php } else if($mode != 'transmittal'){ ?>
                  <?php if(!isset($get['drawing_no'])){ ?>
                     <b class="text-primary"><i class="fas fa-info-circle"></i> You need to filter drawing number to start submit RFI</b><br/><br/>
                  <?php } ?>
                <?php } ?>
            <?php endif; ?>

           
            <table class="table table-hover text-center dataTable">
              <thead class="bg-green-smoe text-white">
                <tr>
                  <?php if(isset($get['drawing_no'])){ ?>
                  <th style="width: 10px !important;">#</th>
                  <?php } ?>
                 
                  <th style="width: 260px !important;">Workpack No</th>
                  <th style="width: 260px !important;">Drawing Number</th>
                  <th style="width: 260px !important;">Weld Map Drawing Number</th>
                  <th style="width: 50px !important;">Joint No</th>
                  <th style="width: 200px !important;">Remarks</th>
                  <th style="width: 155px !important;">Part ID</th>
                  <th style="width: 190px !important;">Unique ID Number</th>
                  <th style="width: 80px !important;">Heat Number</th>
                  <th style="width: 95px !important;">Material Grade</th>
                  <th style="width: 95px !important;">Joint Class</th>
                  <th style="width: 15px !important;">Dia/Size</th>
                  <th style="width: 15px !important;">Sch</th>
                  <th style="width: 15px !important;">Thk<br/>(mm)</th>
                  
                  <th style="width: 15px !important;">Weld<br/>Length<br/>(mm)</th>
                  <th style="width: 120px !important;">Fitter Code</th>
                  <th style="width: 120px !important;">Tack Weld ID</th>
                  <th style="width: 250px !important;">WPS</th>
                   
                  <th style="width: 200px !important;">Area</th> 
                  <th style="width: 200px !important;">Images</th> 
                  <th>Status Submission</th>
                </tr>
              </thead>
              <tbody>
                <?php if(sizeof($joint_list) > 0){ ?>

                <?php $no=0; $no_fltr=0; foreach ($joint_list as $key => $value): ?>

                <?php 

                    if(isset($value['status_inspection'])){
                      
                      if($value['status_inspection'] == 1){
                        $status_data = 0; //blue
                      } else if($value['status_inspection'] == 2 AND @$get['status_inspection'] == '2'){
                        if($value['status_resubmit'] == 1){
                           $status_data = 0; //blue
                        } else {
                           $status_data = 3; //green
                        }
                      } else if($value['status_inspection'] == 9 AND $get['status_inspection'] == '9'){
                        $status_data = 3; //green  
                      } else if($value['status_inspection'] == 11 AND $get['status_inspection'] == '11'){
                        $status_data = 3; //green
                      } else if($value['status_inspection'] == 6 AND $get['status_inspection'] == '6'){
                          $status_data = 3; //green
                      } else if($value['status_inspection'] == 4 AND $get['status_inspection'] == '4'){
                        $status_data = 3; //green
                      } else if($value['status_inspection'] == 0){
                        $status_data = 3; //green
                      } else if($value['status_inspection'] == 3 OR $value['status_inspection'] == 5 OR $value['status_inspection'] == 7){
                        $status_data = 1; //green     
                      } else {
                         $status_data = 2; //red
                      }
                       
                    } else {

                      if(isset($status_piecemark[$value['pos_1']]['id_mis']) && isset($status_piecemark[$value['pos_1']]['id_mis'])){ 

                          if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '0' OR @$status_piecemark[$value['pos_2']]['status_inspection'] == '0'){
                              $status_data = 2; //red
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '1' OR @$status_piecemark[$value['pos_2']]['status_inspection'] == '1'){
                              $status_data = 2; //red
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '2' OR @$status_piecemark[$value['pos_2']]['status_inspection'] == '2'){ 
                              $status_data = 3; //green
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '3' AND @$status_piecemark[$value['pos_2']]['status_inspection'] == '3'){ 
                              $status_data = 3; //green
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '4' OR @$status_piecemark[$value['pos_2']]['status_inspection'] == '4'){
                              $status_data = 0; //blue
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '7' AND @$status_piecemark[$value['pos_2']]['status_inspection'] == '7'){ 
                              $status_data = 3; //green 
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '9' AND @$status_piecemark[$value['pos_2']]['status_inspection'] == '9'){ 
                            $status_data = 3; //green  
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '10' AND @$status_piecemark[$value['pos_2']]['status_inspection'] == '10'){ 
                            $status_data = 3; //green 
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '11' AND @$status_piecemark[$value['pos_2']]['status_inspection'] == '11'){ 
                            $status_data = 3; //green          
                          } else {
                             $status_data = 2; //red
                          }

                      }  else {
                         $status_data = 2; //red
                      }

                    }
                    ?>

                    <?php 
                      if(@$get['status_inspection'] == 'null' AND $status_data == '2'){ 
                        $no_fltr++;
                      } else if(@$get['status_inspection'] == 'x' AND $status_data == '3'){ 
                        $no_fltr++;
                      } 
                    ?>             
                <tr>
                
                <?php if(isset($get['drawing_no'])){ ?>
                  <td>      
                    <input type='hidden' name='id_joint[<?php echo $no; ?>]' value='<?php echo $value['id']; ?>'>
                    <input type='hidden' name='id_fitup_data[<?php echo $no; ?>]' value='<?php echo $value['id_fitup']; ?>'>
                    <input type='checkbox' name='submit_id[<?php echo $no; ?>]' onclick='open_disabled_form(this,"<?php echo $no; ?>")'>
                    <input type='hidden' name='filter_check[<?php echo $no; ?>]' value='0'>                                     
                  </td>
                  <?php } ?>
                 
                  <td><?php echo $value['workpack_no'] ?></td>
                  <td><?php echo $value['drawing_no'] ?></td>
                  <td><?php echo $value['drawing_wm'] ?> Rev.<?php echo $value['rev_wm'] ?></td>
                  <td><?php echo $value['joint_no'] ?></td>
                  <td>   
                      <?php if(@$get['drawing_no']){ ?>                                     
                      <textarea name='remarks[<?php echo $no; ?>]' placeholder="---" ><?php echo $value["remarks"]; ?></textarea> 
                      <?php } else { ?>
                        <?php echo $value["remarks"]; ?>
                      <?php } ?>
                  </td>
                  <td><span class='badge'><?php echo $value['pos_1'] ?></span><hr/><span class='badge'><?php echo $value['pos_2'] ?></span></td>                  
                  <td>
                    <?php 

                      if(isset($status_piecemark[$value['pos_1']]['id_mis'])){ 

                          if($status_piecemark[$value['pos_1']]['status_inspection'] == '0'){
                            echo "<span class='badge badge-warning'>Not Ready in MTR Verification1</span>";
                          } else if($status_piecemark[$value['pos_1']]['status_inspection'] == '1'){
                            echo "<span class='badge badge-warning'>MTR Verification - Pending Approval</span>";
                          } else if($status_piecemark[$value['pos_1']]['status_inspection'] == '2'){
                            //echo $status_piecemark[$value['pos_1']]['id_mis']."<br/>"; 
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
                            echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";
                          } else if($status_piecemark[$value['pos_1']]['status_inspection'] == '10'){
                            echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>"; 
                          } else if($status_piecemark[$value['pos_1']]['status_inspection'] == '11'){
                            echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";  
                          } 
                          

                      } else {  
                           echo "<span class='badge badge-warning'>Not Ready in MTR Verification2</span>";
                      } 
                    ?>
                    <hr/>
                    <?php 
                      if(isset($status_piecemark[$value['pos_2']]['id_mis'])){ 

                          if($status_piecemark[$value['pos_2']]['status_inspection'] == '0'){
                            echo "<span class='badge badge-warning'>Not Ready in MTR Verification3</span>";
                          } else if($status_piecemark[$value['pos_2']]['status_inspection'] == '1'){
                            echo "<span class='badge badge-warning'>MTR Verification - Pending Approval</span>";
                          } else if($status_piecemark[$value['pos_2']]['status_inspection'] == '2'){
                            echo $status_piecemark[$value['pos_2']]['id_mis']."<br/>"; 
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
                            echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";
                          } else if($status_piecemark[$value['pos_2']]['status_inspection'] == '10'){
                            echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>"; 
                          } else if($status_piecemark[$value['pos_2']]['status_inspection'] == '11'){
                            echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";        
                          } 

                      } else {  
                          echo "<span class='badge badge-warning'>Not Ready in MTR Verification</span>";
                      } 
                    ?>
                   
                  </td>
                  <td>
                    <?php 
                      if(isset($status_piecemark[$value['pos_1']]['id_mis'])){ 
                        echo $warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['heat_or_series_no'];
                      } else {
                        echo "-";
                      }
                    ?>
                    <hr/>
                    <?php 
                      if(isset($status_piecemark[$value['pos_2']]['id_mis'])){ 
                        echo $warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['heat_or_series_no'];
                      } else {
                        echo "-";
                      }
                    ?>
                  </td>
                  <td>
                    <span class='badge'>
                    <?php 
                      if(isset($status_piecemark[$value['pos_1']]['id_mis'])){ 
                        echo $material_grade[$status_piecemark[$value['pos_1']]['grade']]['material_grade'];
                      } else {
                        echo "-";
                      }
                    ?>
                    </span>
                    <hr/>
                    <span class='badge'>
                     <?php 
                      if(isset($status_piecemark[$value['pos_2']]['id_mis'])){ 
                        echo $material_grade[$status_piecemark[$value['pos_2']]['grade']]['material_grade'];
                      } else {
                        echo "-";
                      }
                    ?>
                    </span>
                  </td>

                  <td class="ball" style="vertical-align: middle;text-align: center;">
                    <?php echo @$class_list[$value["class"]]?>
                  </td>

                  <td class="ball" style="vertical-align: middle;text-align: center;">
                    <?php echo @$status_piecemark[$value['pos_1']]['diameter'] ?>
                    <hr/>
                    <?php echo @$status_piecemark[$value['pos_2']]['diameter'] ?>
                  </td>

                  <td class="ball" style="vertical-align: middle;text-align: center;">
                    <?php echo @$status_piecemark[$value['pos_1']]['sch'] ?>
                     <hr/>
                    <?php echo @$status_piecemark[$value['pos_2']]['sch'] ?>
                  </td>

                  <td class="ball" style="vertical-align: middle;text-align: center;">
                   <?php echo @$status_piecemark[$value['pos_1']]['thickness'] ?>
                    <hr/>
                    <?php echo @$status_piecemark[$value['pos_2']]['thickness'] ?>
                  </td>
                  
                  <td><?php echo $value['weld_length'] ?></td>

                  <td>
                      <?php
                          $fitter_id_display = explode(";", $value['fitter_id']);
                          foreach ($fitter_id_display as $key => $val_fitter) {
                            if(isset($fitter_code_arr[$val_fitter])){
                              echo $fitter_code_arr[$val_fitter]."<br/>";
                            }
                          }
                      ?>
                  </td>

                  <td>
                        <?php
                          $tack_weld_id_display = explode(";", $value['tack_weld_id']);
                           foreach ($tack_weld_id_display as $key => $val_tack_weld_id) {
                            if(isset($welder_code_arr[$val_tack_weld_id])){
                              echo $welder_code_arr[$val_tack_weld_id]."<br/>";
                            }
                          }
                        ?>  
                  </td>

                  <td>
                    <?php  
                          $wps_display = explode(";", $value['wps_no']);
                          foreach ($wps_display as $key => $wps_id) {
                            if(isset($wps_code_arr[$wps_id])){
                              echo $wps_code_arr[$wps_id]."<br/>";
                            }                             
                          }
                    ?>                    
                  </td>

                  <td>                   
                        <?php echo @$area_name_arr[$value["area"]]; ?>  
                  </td>

                  <td>
                      <?php if(isset($image_fu[$value['id_joint']])){ ?>
                        <?php  
                          $enc_redline = strtr($this->encryption->encrypt($image_fu[$value['id_joint']]), '+=/', '.-~');
                          $enc_path   = strtr($this->encryption->encrypt('/PCMS/mobile/pcms_v2_mobile/pcms_v2_photo/'), '+=/', '.-~'); 
                        ?>
                        <a target='_blank' href='<?= site_url('irn/open_file/'.$enc_redline.'/'.$enc_path) ?>'><span class='btn btn-primary'><i class="fas fa-images"></i></span></a>
                        <!-- <img src="https://10.5.252.116/pcms_v2_photo/<?= $image_fu[$value['id_joint']] ?>" style='width: 80px;' onclick="show_image(this, '<?= $image_fu[$value['id_joint']] ?>', 'surveyor')"/> -->
                      <?php } else { ?>
                          <img src="<?php echo base_url(); ?>/img/img_not_avai.png" style='width: 80px;'>
                      <?php } ?> <br/>
                      <span class='badge'><?= @$user_list[$value['requestor']];  ?></span><br/>
                      <span class='badge'><?= $value['date_request'];  ?></span>
                  </td>
                  <td  style="text-align: left !important;">
                    <?php 
                      if(!isset($value['status_inspection'])){ 
                          if(isset($status_piecemark[$value['pos_1']]['id_mis']) && isset($status_piecemark[$value['pos_2']]['id_mis'])){ 
                            echo "<span class='badge badge-success'>Ready</span>"; 
                          } else {
                            echo "<span class='badge badge-warning'>Not Ready</span>"; 
                          }
                      } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '0'){ 
                        echo "<span class='badge badge-success'>Ready</span>"; 
                      } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '1'){ 
                        echo "<span class='badge badge-info'>Pending Approval</span>";
                      } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '2'){ 
                        echo "<span class='badge badge-danger'>Rejected</span>"; 
                        echo "<span class='badge'>".$user_list[$value['inspection_by']]."</span><br/>";  
                        echo "<span class='badge'>".date("d-F-y H:i:s",strtotime($value['inspection_datetime']))."</span><br/>";
                         echo "<br/><span style='font-size:12px !important;'><b>Inspector Remarks :</b><br/>".$value["rejected_remarks"]."</span>";
                      } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '3'){ 
                        echo "<span class='badge badge-success'>Approved</span><br/>"; 
                        echo "<span class='badge'>".$user_list[$value['inspection_by']]."</span><br/>";  
                        echo "<span class='badge'>".date("d-F-y H:i:s",strtotime($value['inspection_datetime']))."</span><br/>";  
                      } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '4'){ 
                        echo "<span class='badge badge-primary'>Pending By QC</span>";
                        echo "<span class='badge'>".$user_list[$value['inspection_by']]."</span><br/>";  
                        echo "<span class='badge'>".date("d-F-y H:i:s",strtotime($value['inspection_datetime']))."</span><br/>";
                        echo "<br/><span style='font-size:12px !important;'><b>Inspector Remarks :</b><br/>".$value["pending_qc_remarks"]."</span>";
                      } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '5'){ 
                        echo "<span class='badge badge-success'>Transmitted</span><br/>";   
                      } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '9'){ 
                        echo "<span class='badge badge-primary'>Approved & Released with comment</span>";      
                      } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '11'){       
                        echo "<span class='badge badge-danger'>Re-Offer By Client</span><br/>"; 
                        echo "<span class='badge'>".$user_list[$value['client_inspection_by']]."</span><br/>";  
                        echo "<span class='badge'>".date("d-F-y H:i:s",strtotime($value['client_inspection_date']))."</span><br/>";
                        echo "<br/><span style='font-size:12px !important;'><b>Client Remarks :</b><br/>".$value["reoffer_remarks"]."</span>";
                      } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '6'){       
                        echo "<span class='badge badge-danger'>Rejected</span><br/>"; 
                        echo "<span class='badge'>".$user_list[$value['client_inspection_by']]."</span><br/>";  
                        echo "<span class='badge'>".date("d-F-y H:i:s",strtotime($value['client_inspection_date']))."</span><br/>";
                        echo "<br/><span style='font-size:12px !important;'><b>Client Remarks :</b><br/>".$value["client_remarks"]."</span>";
                      }
                    ?>

                    <input type='hidden' name='id_joint_template[<?php echo $no; ?>]' value='<?php echo $value['id']; ?>'>
                  </td>
                </tr>
                <?php $no++; endforeach; ?>
              <?php } ?>
                
              </tbody>
            </table>          
          </div>
         
            <?php if(@$get['drawing_no']){ ?>           
                <?php if(sizeof($joint_list) > 0){ ?>
                <div class="text-right mt-3">
                    <button type="submit" name="submit" class="btn btn-success" title="Submit">Submit</button>           
                </div>
                <?php } ?>
            <?php } ?>


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

<?php } ?>

  <script>

    $("select[name=module]").chained("select[name=project]");

    $('.dataTable').DataTable({
        order: [],
    })

    // $('.dataTable').DataTable({
    //      "paging":   false,
    //      "ordering": false,
    //      "info":     false,
    // })

    

    function open_disabled_form(val,no) {

      var $checkboxes = $('#form_submition td input[type="checkbox"]');          
      $checkboxes.change(function(){
          var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
          $('#total_data_checked').text(countCheckedCheckboxes);            
          $('#total_data_checked_val').val(countCheckedCheckboxes);

          if(countCheckedCheckboxes <= 30){

            if($(val).prop("checked") == true){
           
               $('input[name="filter_check['+no+']"]').val(1);
            } else {
            
               $('input[name="filter_check['+no+']"]').val(0);
            }

          } else {

             alert("Sorry, Data checked has been maximum..");
           
             $('input[name="filter_check['+no+']"]').val(0);

          }
      });

      

    }


  

  $(".autocomplete_doc, .autocomplete_wm").autocomplete({
    source: function( request, response ) {

      var project         = $("select[name='project']").find('option:selected').val();  
      var drawing_type    = $("select[name='drawing_type']").find('option:selected').val(); 
      var discipline      = $("select[name='discipline']").find('option:selected').val(); 
      var module          = $("select[name='module']").find('option:selected').val(); 
      var type_of_module  = $("select[name='type_of_module']").find('option:selected').val(); 
      var drawing_wm      = $("input[name='drawing_wm']").val(); 
      var type_of_module  = $("select[name='type_of_module']").find('option:selected').val();  

      $.ajax( {
        url: "<?php echo base_url() ?>fitup/autocomplete_drawing_joint",
        type: "post",
        dataType: "json",
        data: {
          term: request.term,
          project: project,
          drawing_type: drawing_type,
          discipline: discipline,
          module: module,
          type_of_module: type_of_module,
          drawing_wm: drawing_wm,
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
 
     $.ajax( {
      url: "<?php echo base_url() ?>fitup/get_data_drawing",
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
          $("select[name=drawing_type]").val(data.drawing_type);
          if(module == ""){
            $("select[name=module]").val(data.module);            
          }
          $("select[name=type_of_module]").val(data.type_of_module);
          <?php if($mode == 'transmittal'){ ?>
             $("select[name=status_inspection]").change().val(3);
          <?php } else { ?>
             $("select[name=status_inspection]").change().val(0);
          <?php } ?>


          $("select[name=project]").prop("disabled", false);
          $("select[name=discipline]").prop("disabled", false);
          $("select[name=drawing_type]").prop("disabled", false);
          $("select[name=module]").prop("disabled", false);
          $("select[name=type_of_module]").prop("disabled", false);

          $("#button_search").prop("disabled", false);

        }
      }
    });
  }

  function get_fitter_code(no) {
    console.log(no);
      $.ajax({
        url: "<?php echo base_url();?>fitup/get_fitter_ajax",
        type: "post",
        success: function(data) {
              if(data.includes("Error")){
                $('.fitter_'+no).find('option').remove().end();
                Swal.fire(
                  'Warning',
                  'Sorry, No Fitter ID Available',
                  'warning'
                );
              } else {
                 $('.fitter_'+no).find('option').remove().end();
                  $.each(JSON.parse(data), function(i, obj){
                       $('.fitter_'+no).append($('<option>').text(obj.text).attr('value', obj.val));
                  });
              }
        }
      });  
  }
  
</script>

<script type="text/javascript">

  $(document).ready(function() {

     
      if($("input[name=drawing_no]").val() != ""){
          $("select[name=project]").prop("disabled", false);
          $("select[name=discipline]").prop("disabled", false);
          $("select[name=drawing_type]").prop("disabled", false);
          $("select[name=module]").prop("disabled", false);
          $("select[name=type_of_module]").prop("disabled", false);
           $("#button_search").prop("disabled", false);
      }

      $(".select2_multiple_fitter").select2({
        // tags: true,
        tokenSeparators: [',', ' '],
        ajax: {
              url: "<?php echo base_url();?>fitup/get_fitter_ajax",
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

      $(".select2_multiple_welder").select2({
        //tags: true,
        tokenSeparators: [',', ' '],
        ajax: {
              url: "<?php echo base_url();?>fitup/get_welder_ajax_version2",
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

      $(".select2_multiple_wps").select2({
        //tags: true,
        tokenSeparators: [',', ' '],
        ajax: {
              url: "<?php echo base_url();?>fitup/get_wps_ajax_version2",
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

  function show_image(btn, source, type) {

      if (type == "client") {
        var url = "https://10.5.252.116/pcms_v2_photo/fab_img/" + source
      } else {
        var url = "https://10.5.252.116/pcms_v2_photo/" + source

      }


      var image_content = `
        <div class="row">
          <div class="col-md-12">
            <img src="${url}" style="width : 100%">
          </div>
          <div class="col-md-12">
            <hr>
            <div class="float-right">
              <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
            </div>
          </div>
        </div>
      `

      $("#modal").modal({
        show: true,
        keyboard: false,
        backdrop: "static"
      }).find('.modal-body').html(image_content)
      $('.modal-title').text("Attachment")
      $('.modal-dialog').addClass('modal-lg')
      }

      function reset_form() {
        window.location.href = "<?= base_url() ?>fitup/update_remarks_ns_fs";
      }
</script>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->
