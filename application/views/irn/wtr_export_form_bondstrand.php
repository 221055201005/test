
<style>
    .hide_tr {
      display: none;
    }
</style>

<form action="<?php echo base_url(); ?>irn/submit_irn_fab" enctype="multipart/form-data" method='POST' id="form_submition"> 

<?php if(isset($submission_id)){ ?>
  <input type='hidden' name='submission_id' value='<?= $submission_id ?>' />
<?php } ?>

<input type='hidden' name='category_irn' value='0'> 

<script type="text/javascript">
  var arrIdTemplateJoint = [];
</script>
<div id="content" class="container-fluid">
  <div class="row">
 
    <div class="col-md-12">

       <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">Submit to IRN <?= $is_bondstrand==1 ? 'Bondstrand' : '' ?></h6>
         <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
  
            <div class="container-fluid">

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Project List :</label>
                    <div class="col-xl">
                       <select class="form-control project2" name="project_joint" id="project2" required="" onchange="populateModuleChained();">
                        <?php if($this->permission_cookie[0] == 1){ ?>
                          <option value="">---</option>                          
                          <?php foreach ($project_chain as $key => $value) : ?>
                          <option <?= $show_pcms_irn[0]['project_id']==$value['id'] ? 'selected' : '' ?> value="<?php echo $value['id'] ?>" <?php echo (@$project_id == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                          <?php endforeach; ?>
                        <?php } else { ?>
                          <?php foreach ($project_chain as $key => $value) : ?>
                            <?php if(in_array($value['id'], $this->user_cookie[13])){ ?>
                              <option <?= $show_pcms_irn[0]['project_id']==$value['id'] ? 'selected' : '' ?> value="<?php echo $value['id'] ?>" <?php echo ($this->user_cookie[10] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                            <?php } ?>
                          <?php endforeach; ?>
                        <?php } ?>
                        </select> 
                    </div>
                  </div>
                </div>
              </div> 

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Module / Jacket List :</label>
                    <div class="col-xl">
                       <select class="form-control select2class module2" name="module_joint" id="module" required onchange="openDrawingByjoint();">
                        <option value="">---</option>                                        
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Type Of Module :</label>
                    <div class="col-xl">
                        <select class="form-control" name="type_of_module_joint" required>
                            <option value="">---</option>
                            <?php foreach ($type_of_module_list as $key => $value) : ?>
                                <option <?= $show_pcms_irn[0]['type_of_module']==$value['id'] ? 'selected' : '' ?> value="<?php echo $value['id'] ?>" <?php echo (@$post['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Discipline List :</label>
                    <div class="col-xl">
                      <select class="custom-select select2class" name="discipline_joint" required="" id="disciplinex" onchange="openDrawingByjoint();">
                        <?php foreach ($discipline_list as $key => $value) : ?>
                        <option <?= $show_pcms_irn[0]['discipline']==$value['id'] ? 'selected' : '' ?> value="<?php echo $value['id'] ?>" ><?php echo $value['discipline_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Drawing Number :</label>
                    <div class="col-xl">
                      <input type='text' name="drawing_joint" class="form-control" onkeydown="autodrawingByjoint(this);" placeholder="Type Drawing" id="drawing" disabled="">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Weld Map Number :</label>
                    <div class="col-xl">
                      <input type='text' name="drawing_wm" class="form-control" onkeydown="autodrawingByjointWM(this);" placeholder="Type Drawing WM" id="drawing" disabled="">
                    </div>
                  </div>
                </div>
              </div>

              <!-- <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Joint Number :</label>
                    <div class="col-xl">
                      <input type='text' name="joint_number" class="form-control" onkeydown="auto_joint_number(this);" placeholder="Type Joint Number" id="joint_no" disabled=""> 
                      <input type='hidden' name="joint_number_array" class="form-control" id='id_joint_list'> 
                    </div>
                  </div>
                </div>
              </div> -->

              <div class="row">
              <div class="col-md">
                <div class="form-group row">
                  <label class="col-xl-3 col-form-label"> Joint Number :</label>
                  <div class="col-xl">
                    <select  class='select2_multiple_itr' name='joint_number[]' id='joint_number' multiple > 
                    </select> 
                    <input type='hidden' name="joint_number_array" class="form-control" id='id_joint_list'> 
                  </div>
                </div>
              </div>
            </div>

              <div class="row">                   
                <div class="col-md">
                  <div class="form-group row">
                    <div class="col-xl text-left">
                      <button type='button' class="btn btn-primary" title="Submit" id="addRowBtn">
                        <i class="fas fa-plus"></i>
                         Add
                      </button>

                      <?php if($is_bondstrand!=1){ ?>
                        <a href="<?= base_url("irn/import_joint_irn") ?>" class="btn btn-success"><i class="fas fa-file-excel"></i> Import Joint</a>
                      <?php } ?>

                    </div>
                  </div>
                </div>
              </div>
          </div>
      </div>
    </div>
    </div> 


    <div class="col-md-12">     

        <div class="my-3 p-3 bg-white rounded shadow-sm">
          <h6 class="pb-2 mb-0">List Of Item Joint / Piecemark</h6>
            <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-gray">          
              <div class="container-fluid">


                <table class="table" width="100%" id='tableListJoint'>
                  <thead>
                      <tr>
                        <th rowspan='2'>Drawing<br/>Number</th>
                        <th rowspan='2'>Weld<br/>Map<br/>Drawing No.</th> 
                        <th rowspan='2'>Item /<br/>Joint No</th>
                        <th colspan='8' style='text-align:center;'>Material Traceability</th>
                        <th rowspan='2'>Bondstrand<br/>Status</th>
                        <th rowspan='2'>Action</th>
                      </tr>
                      <tr>
                        <th>Piecemark<br/>No.</th>
                        <th>Unique<br/>No.</th> 
                        <th>Profile</th> 
                        <th>Size / Dia</th> 
                        <th>Length</th> 
                        <th>Area<br/>m2</th> 
                        <th>THK</th> 
                        <th>Material<br/>Status</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($data_joint_list)){ ?>
                      
                       <?php foreach($data_joint_list as $key => $value){ ?>
                        <?php  
                            // test_var($value);
                            if(isset($warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no'])){
                              $uniq_no_p1 = $warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no'];
                            } else {
                              $uniq_no_p1 = "-";
                            }
                        
                            if(isset($warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no'])){
                              $uniq_no_p2 = $warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no'];
                            } else {
                              $uniq_no_p2 = "-";
                            }
                        
                            if(isset($status_piecemark[$value['pos_1']]['profile'])){
                              $profile_p1 = $status_piecemark[$value['pos_1']]['profile'];
                            } else {
                              $profile_p1 = "-";
                            }
                        
                            if(isset($status_piecemark[$value['pos_2']]['profile'])){
                              $profile_p2 = $status_piecemark[$value['pos_2']]['profile'];
                            } else {
                              $profile_p2 = "-";
                            }
                        
                            if(isset($status_piecemark[$value['pos_1']]['diameter'])){
                              $diameter_p1 = $status_piecemark[$value['pos_1']]['diameter'];
                            } else {
                              $diameter_p1 = "-";
                            }
                        
                            if(isset($status_piecemark[$value['pos_2']]['diameter'])){
                              $diameter_p2 = $status_piecemark[$value['pos_2']]['diameter'];
                            } else {
                              $diameter_p2 = "-";
                            }
                        
                            if(isset($status_piecemark[$value['pos_1']]['length'])){
                              $length_p1 = $status_piecemark[$value['pos_1']]['length'];
                            } else {
                              $length_p1 = "-";
                            }
                        
                            if(isset($status_piecemark[$value['pos_2']]['length'])){
                              $length_p2 = $status_piecemark[$value['pos_2']]['length'];
                            } else {
                              $length_p2 = "-";
                            }
                        
                            if(isset($status_piecemark[$value['pos_1']]['area'])){
                              $area_p1 = $status_piecemark[$value['pos_1']]['area'];
                            } else {
                              $area_p1 = "-";
                            }
                        
                            if(isset($status_piecemark[$value['pos_2']]['area'])){
                              $area_p2 = $status_piecemark[$value['pos_2']]['area'];
                            } else {
                              $area_p2 = "-";
                            }
                        
                            if(isset($status_piecemark[$value['pos_1']]['thickness'])){
                              $thickness_p1 = $status_piecemark[$value['pos_1']]['thickness'];
                            } else {
                              $thickness_p1 = "-";
                            }
                        
                            if(isset($status_piecemark[$value['pos_2']]['thickness'])){
                              $thickness_p2 = $status_piecemark[$value['pos_2']]['thickness'];
                            } else {
                              $thickness_p2 = "-";
                            }
                        
                            if(isset($status_piecemark[$value['pos_1']]['status_inspection'])){
                              if($status_piecemark[$value['pos_1']]['status_inspection'] == 7){
                                $status_inspection_p1 ="COMPLETED";
                              } else {
                                $status_inspection_p1 ='OS';	
                              }
                              
                            } else {
                              $status_inspection_p1 = "-";
                            }
                        
                            if(isset($status_piecemark[$value['pos_2']]['status_inspection'])){
                              if($status_piecemark[$value['pos_2']]['status_inspection'] == 7){
                                $status_inspection_p2 = "COMPLETED";
                              } else {
                                $status_inspection_p2 ='OS';	
                              }
                            } else {
                              $status_inspection_p2 = "-";
                            }

                            if($value['status_inspection_baa'] == 3){
                              $status_baa = "COMPLETED";
                            } else {
                              $status_baa = 'OS';  
                            }
                        ?>
                          <tr>
                            <td><?= $value['drawing_no'] ?></td>
                            <td><?= $value['drawing_wm'] ?></td>
                            <td><?= $value['joint_no'].(
                              (in_array($value['joint_type'], [8, 9]) AND $value['discipline']==1) 
                              ? $master_joint_type[$value['joint_type']]['joint_type_code'] 
                              : ''
                            ) ?></td>
                            <td><?= $value['pos_1'] ?><hr/><?= $value['pos_2'] ?></td>
                            <td><?= $uniq_no_p1 ?><hr/><?= $uniq_no_p2 ?></td>
                            <td><?= $profile_p1 ?><hr/><?= $profile_p2 ?></td>
                            <td><?= $diameter_p1 ?><hr/><?= $diameter_p2 ?></td>
                            <td><?= $length_p1 ?><hr/><?= $length_p2 ?></td>
                            <td><?= $area_p1 ?><hr/><?= $area_p2 ?></td>
                            <td><?= $thickness_p1 ?><hr/><?= $thickness_p2 ?></td>
                            <td><?= $status_inspection_p1 ?><hr/><?= $status_inspection_p2 ?></td>
                            <td><?= $status_baa ?></td>
                            <td>
                                <a onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Delete&nbsp;</b> this?', this, event)" href='<?php echo base_url(); ?>irn/delete_data_draft/<?php echo strtr($this->encryption->encrypt($value['id_irn']),'+=/', '.-~') ; ?>'>
                                  <span class='btn btn-danger'>Delete</span>
                                </a>
                            </td>
                          </tr>                    
                       <?php } }  else { ?>
                        <tr class='show_data'>
                          <td colspan='19' style='text-align:center;font-weight:bold;'> ~ No Data ~</td> 
                        </tr>                     
                       <?php } ?>                     
                  </tbody>
                </table> 
                                           
              </div>
            </div>
        </div>
     </div>


    <div class="col-md-12"> 
        <div class="my-3 p-3 bg-white rounded shadow-sm">
          <h6 class="pb-2 mb-0">RFI Form - Details</h6>
            <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">          
              <div class="container-fluid"> 

             
   
              <div class="row">
                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label "> RFI Date </label>
                    <div class="col-xl">
                        <input type='text' name='rfi_date' class='form-control' id='datepicker' placeholder='RFI Date' value='<?php echo $show_pcms_irn_description[0]['rfi_date'] ?>'>
                    </div>
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
                    <label class="col-md-4 col-lg-3 col-form-label "> Area </label>
                    <div class="col-xl">
                        <select class="select2 will_enable" name="area_v2" required>
                          <option value="">---</option>
                          <?php foreach ($area_name_list_v2 as $value_area) {?>
                            <option value="<?= $value_area['id'] ?>" <?php if($show_pcms_irn[0]['area_v2'] == $value_area['id']){ echo "selected"; } ?>><?= $value_area['name'] ?></option>
                          <?php } ?>
                        </select> 
                    </div>
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
                  <label class="col-md-4 col-lg-3 col-form-label "> Location </label>
                    <div class="col-xl">
                        <select class="select2 will_enable" name="location_v2" required>
                          <option value="">---</option>
                          <?php foreach ($location_name_list_v2 as $value_location) {?>
                            <option value="<?= $value_location['id'] ?>" data-chained="<?php echo $value_location['id_area'] ?>" <?php if($show_pcms_irn[0]['location_v2'] == $value_location['id']){ echo "selected"; } ?>><?= $value_location['name'] ?></option>
                          <?php } ?>
                        </select>
                    </div>
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
                  <label class="col-md-4 col-lg-3 col-form-label "> IRN Name / Remarks</label>
                    <div class="col-xl">
                        <textarea name='irn_description' class='form-control' placeholder='IRN Name / Remarks' required><?= $show_pcms_irn[0]['irn_description'] ?></textarea>
                    </div>
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
                  <label class="col-md-4 col-lg-3 col-form-label "> Room</label>
                    <div class="col-xl">
                      <!-- <input type="text" name="room" class="form-control" placeholder="Room"> -->
                      <input type="text" name="room" class="form-control" placeholder="Room" value="<?= $show_pcms_irn_description[0]['room'] ?>">
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group row">                          
                  </div>
                </div> 
              </div>
             
                <div class="row">
                  
                <table class="table" width="100%" id='tableListRfi'>
                  <thead>
                      <tr>
                        <th>Item/Tag Number</th>
                        <th>Item/Tag Description</th>
                        <th>Expected Date/Time</th>
                        <th><button type="button" class="btn btn-primary" title="Delete Row"  onclick="addrow_rfi()"><i class="fas fa-plus-circle"></i></button></th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php if(isset($show_pcms_irn_description)){ ?>
                     <?php foreach($show_pcms_irn_description as $key => $value){ ?>
                      <tr>
                        <td><?= $value['item_tag_no'] ?></td>
                        <td><?= $value['item_tag_description'] ?></td>
                        <td><?= $value['expected_time'] ?></td>
                        <td>
                            <a onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Delete&nbsp;</b> this?', this, event)" href='<?php echo base_url(); ?>irn/delete_data_irn_description/<?php echo strtr($this->encryption->encrypt($value['id_description']),'+=/', '.-~') ; ?>'>
                              <span class='btn btn-danger'><i class="fa fa-trash"></i></span>
                            </a>
                         </td>
                     </tr>
                     <?php } } else { ?>
                      <tr>
                      <tr class='show_rfi'>
                          <td colspan='4' style='text-align:center;font-weight:bold;'> ~ No Data ~</td> 
                        </tr> 
                     </tr>
                     <?php } ?>
                  </tbody>
                </table>                
                </div>
              </div>
            </div>
        </div>
    </div> 

    <div class="col-md-12">

        <div class="my-3 p-3 bg-white rounded shadow-sm">
          <h6 class="pb-2 mb-0">Submit IRN - Dimentional Control</h6>
            <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">          
              <div class="container-fluid">
              
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Filter Dimension Control Report</label>
                      <div class="col-md"> 
                        <div class="input-group">
                          <select  class='select2_dimension_control form-control'  name='filter_dimension[]' multiple placeholder='Input Dimension Report Number'></select>
                          <br/><br/>                
                              <span class="btn btn-primary"  id="addRowDimension">
                                <i class="fas fa-plus"></i>
                                 Add
                              </span>              
                        </div>      
                      </div>
                    </div>
                  </div>   
                </div>

                <table class="table" width="100%" id='tableDimension'>
                  <thead>
                      <tr>
                        <th><center>Report Number</center></th>
                        <th><center>File</center></th>
                        <th><center>Action</center></th>
                      </tr>
                  </thead>
                  <tbody> 
                    <?php if(isset($show_pcms_irn_dc)){ ?>
                      <?php foreach($show_pcms_irn_dc as $key => $value){ ?>   
                        <tr>
                          <td><center><?= $data_dc_show[$value['id_detail_dimension']]['detail_report_number'] ?></center></td>
                            <td>
                              <center>
                                <?php   
                                  $enc_redline = strtr($this->encryption->encrypt($data_dc_show[$value['id_detail_dimension']]['attachment']), '+=/', '.-~'); 
                                  $enc_path   = strtr($this->encryption->encrypt('/PCMS/pcms_v2/additional_attachment/dimension_control/'), '+=/', '.-~');  
                                ?> 
                                <a target='_blank' href='<?= site_url('irn/open_file/'.$enc_redline.'/'.$enc_path) ?>'><?= $data_dc_show[$value['id_detail_dimension']]['attachment'] ?></a> 
                                <!-- <a href='https://www.smoebatam.com/pcms_v2_photo/dimension_control/<?= $data_dc_show[$value['id_detail_dimension']]['attachment'] ?>'>
                                  <?= $data_dc_show[$value['id_detail_dimension']]['attachment'] ?>
                                </a> -->
                              </center>
                            </td>
                          <td>
                            <center>
                              <a onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Delete&nbsp;</b> this?', this, event)" href='<?php echo base_url(); ?>irn/delete_data_irn_dc_data/<?php echo strtr($this->encryption->encrypt($value['id_irn_dc']),'+=/', '.-~') ; ?>'>
                                <span class='btn btn-danger'><i class="fa fa-trash"></i></span>
                              </a>
                            </center>  
                          </td>
                        </tr>                      
                      <?php } ?>                         
                    <?php } ?>                         
                  </tbody>
                </table>                            
              </div>
            </div>
        </div>

    </div>

    <div class="col-md-12">

        <div class="my-3 p-3 bg-white rounded shadow-sm">
          <h6 class="pb-2 mb-0">Submit IRN - Punchlist</h6>
            <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">          
              <div class="container-fluid">
              
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Filter Punchlist Report</label>
                      <div class="col-md"> 
                        <div class="input-group">
                          <select  class='select2_punchlist form-control'  name='filter_punchlist[]' multiple placeholder='Input Punchlist Report Number'></select>
                          <br/><br/>                
                              <span class="btn btn-primary"  id="addRowPunchlist">
                                <i class="fas fa-plus"></i>
                                 Add
                              </span>              
                        </div>      
                      </div>
                    </div>
                  </div>   
                </div>

                <table class="table" width="100%" id='tablePunchlist'>
                  <thead>
                      <tr>
                        <th><center>Report Number</center></th>
                        <th><center>File</center></th>
                        <th><center>Action</center></th>
                      </tr>
                  </thead>
                  <tbody> 
                    <?php if(isset($show_pcms_irn_pnc)){ ?>
                      <?php foreach($show_pcms_irn_pnc as $key => $value){ ?>   
                        <tr>
                          <td><center><?= $data_punc_show[$value['id_detail_dimension']]['report_number'] ?></center></td>
                          <td>
                            <center>
                              <?php $link_add = getenv('LINK_PCMS_PUNCHLIST')."/punchlist/view_client_punchlist_rfi/".strtr($this->encryption->encrypt($data_punc_show[$value['id_detail_dimension']]['submission_id']),'+=/', '.-~')."/".strtr($this->encryption->encrypt($data_punc_show[$value['id_detail_dimension']]['discipline_id']),'+=/', '.-~') ."/".strtr($this->encryption->encrypt($data_punc_show[$value['id_detail_dimension']]['module']),'+=/', '.-~')."/".strtr($this->encryption->encrypt($data_punc_show[$value['id_detail_dimension']]['type_of_module']),'+=/', '.-~')."/viewer"; ?>
                              <a href='<?= $link_add ?>'>
                                <span class='btn btn-warning'><i class="fas fa-file-pdf"></i></span>
                              </a>
                            </center>
                          </td>
                          <td>
                            <center>
                              <a onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Delete&nbsp;</b> this?', this, event)" href='<?php echo base_url(); ?>irn/delete_data_irn_dc_data/<?php echo strtr($this->encryption->encrypt($value['id_irn_dc']),'+=/', '.-~') ; ?>'>
                                <span class='btn btn-danger'><i class="fa fa-trash"></i></span>
                              </a>
                            </center>  
                          </td>
                        </tr>                      
                      <?php } ?>                         
                    <?php } ?>                         
                  </tbody>
                </table>                            
              </div>
            </div>
        </div>

    </div> 

    <div class="col-md-12">

        <div class="my-3 p-3 bg-white rounded shadow-sm">
          <h6 class="pb-2 mb-0">Submit IRN - Additional Attachment</h6>
            <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-gray">          
              <div class="container-fluid">
                <table class="table" width="100%" style='text-align:center;' id='table_pnc'>
                  <thead>
                      <tr>
                        <th><center>Description</center></th>
                        <th><center>File Attachment</center></th>
                        <th><button type="button" class="btn btn-primary" title="Delete Row"  onclick="addrow_pnc()"><i class="fas fa-plus-circle"></i></button></th>
                      </tr>
                  </thead>
                  <tbody> 
                    <?php if(isset($show_pcms_irn_punchlist)){ ?>
                    <?php foreach($show_pcms_irn_punchlist as $key => $value){ ?>   
                      <tr>
                        <td><?= $value['pnc_desc'] ?></td>
                        <td>
                            <!-- <a href='https://www.smoebatam.com/pcms_v2_photo/punchlist_file/<?= $value['pnc_attachment'] ?>'>
                              <span class='btn btn-primary'><i class="fas fa-file-pdf"></i></span>
                            </a>  -->
                            <?php  
                              $enc_redline = strtr($this->encryption->encrypt($value['pnc_attachment']), '+=/', '.-~');
                              $enc_path    = strtr($this->encryption->encrypt('/PCMS/pcms_v2/irn_punchlist'), '+=/', '.-~'); 
                            ?>
                            <a href='<?= site_url('irn/open_file/'.$enc_redline.'/'.$enc_path) ?>'>
                              <span class='btn btn-primary'><i class="fas fa-file-pdf"></i></span>
                            </a>
                        </td> 
                        <td>
                            <a onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Delete&nbsp;</b> this?', this, event)" href='<?php echo base_url(); ?>irn/delete_data_irn_punchlist/<?php echo strtr($this->encryption->encrypt($value['id_irn_pnc']),'+=/', '.-~') ; ?>'>
                              <span class='btn btn-danger'><i class="fa fa-trash"></i></span>
                            </a>
                        </td>
                      </tr>                      
                    <?php } ?>                         
                    <?php } ?>                       
                  </tbody>
                </table>  
              </div>
            </div>
        </div>
      </div>

      <div class="col-md-12">

        <div class="my-3 p-3 bg-white rounded shadow-sm"> 
            <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">          
              <div class="container-fluid">    
                
                  <div class="row">

                  <?php if($data_joint_list[0]['status_inspection_irn'] == 0){ ?>

                    <div class="col-1">
                      <div class="form-group row">                          
                        <div class="col-xl">
                          <button type="submit" class="btn btn-secondary" name="submit" value='Draft' title="Draft">
                            <i class="fas fa-save"></i> Draft
                          </button>
                        </div>
                      </div>
                    </div>

                    <?php } else { ?>

                    <div class="col-1">
                      <div class="form-group row">                          
                        <div class="col-xl">
                          <input type='hidden' name='irn_report_number' value='<?= $data_joint_list[0]['report_number_irn'] ?>' >
                          <input type='hidden' name='irn_status_inspection' value='<?= $data_joint_list[0]['status_inspection_irn'] ?>' >

                          <input type='hidden' name='smoe_approval_by' value='<?= $get_data_for_update[0]['smoe_approval_by'] ?>' >
                          <input type='hidden' name='smoe_approval_date' value='<?= $get_data_for_update[0]['smoe_approval_date'] ?>' >
                          <input type='hidden' name='smoe_remarks' value='<?= $get_data_for_update[0]['smoe_remarks'] ?>' > 
                          <input type='hidden' name='client_approval_by' value='<?= $get_data_for_update[0]['client_approval_by'] ?>' >
                          <input type='hidden' name='client_approval_date' value='<?= $get_data_for_update[0]['client_approval_date'] ?>' >
                          <input type='hidden' name='client_remarks' value='<?= $get_data_for_update[0]['client_remarks'] ?>' >
                          <input type='hidden' name='transmittal_by' value='<?= $get_data_for_update[0]['transmittal_by'] ?>' >
                          <input type='hidden' name='transmittal_date' value='<?= $get_data_for_update[0]['transmittal_date'] ?>' >

                          <input type='hidden' name='timestamp' value='<?= $data_joint_list[0]['status_inspection_irn'] ?>' >
                          <button type="submit" class="btn btn-warning" name="submit" value='Update' title="Update">
                            <i class="fas fa-save"></i> Save
                          </button>
                        </div>
                      </div>
                    </div>

                    <?php } ?> 

                  </div>
             
              </div>
            </div>
        </div>
      </div>

  

    </div>
  </div>  
</div>
</div><!-- ini div dari sidebar yang class wrapper -->

<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.chained.min.js"></script>
<script charset=utf-8>
  $(function(){
    $("#modulex").chained("#projectx");  
  });  
</script>

<script type="text/javascript">

$(document).ready(function() {

      $(".select2_dimension_control").select2({
        ajax: {
              url: "<?php echo base_url();?>irn/get_dimension_report/",
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

      $(".select2_punchlist").select2({
        ajax: {
              url: "<?php echo base_url();?>irn/get_punchlist_report/",
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

     

      $(".select2_multiple_itr").select2({ 
          tokenSeparators: [',', ' '],
          ajax: {
                url: "<?php echo base_url();?>irn/display_joint_number_select2",
                type: "post",
                dataType       : 'json',
                data: function (params) {
                  var query = {
                    search: params.term,
                    drawing_no:  $("input[name='drawing_joint']").val(), 
                    drawing_wm: $("input[name='drawing_wm']").val(), 
                    module: $("select[name='module_joint']").find('option:selected').val(),  
                    type_of_module: $("select[name='type_of_module_joint']").find('option:selected').val(),            
                    discipline: $("select[name='discipline_joint']").find('option:selected').val(),   
                    id_joint:  $("input[id='id_joint_list']").val(),  
                    is_bondstrand: "<?= $is_bondstrand==1 ? 1 : 0 ?>",
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

    jQuery(document).ready(function(){ 
      addrow_pnc();
      populateModuleChained();
      addrow_rfi();
    	$( "#datepicker" ).datepicker({ 
        format: 'yyyy-mm-dd', 
        changeMonth: true,
        changeYear: true, 
        yearRange: "-100:+0",
        orientation: 'auto bottom' 
      }); 
    });

  function openDrawingByjoint(){

    var module_value     = $("select[name='module_joint']").find('option:selected').val();  
    var discipline_value = $("select[name='discipline_joint']").find('option:selected').val();

    if(module_value !== "" && discipline_value !== ""){
      $("input[name='drawing_joint']").prop("disabled", false);
      $("input[name='drawing_wm']").prop("disabled", false);
      $("input[name='joint_number']").prop("disabled", false);
    } else {
      $("input[name='drawing_joint']").prop("disabled", true);
      $("input[name='drawing_wm']").prop("disabled", false);
      $("input[name='joint_number']").prop("disabled", true);
    }

  }

    function autodrawingByjoint(input){
        var module_value     = $("select[name='module_joint']").find('option:selected').val();  
        var discipline_value = $("select[name='discipline_joint']").find('option:selected').val();

        $(input).autocomplete({
          source: function(request,response){
            $.post('<?php echo base_url(); ?>wtr/display_drawing',{term: request.term ,module_value:module_value, discipline_value:discipline_value }, response, 'json');
          },
          autoFocus: true,
          classes: {
            "ui-autocomplete": "highlight"
          },
          select: function(event, ui){
            var badge = ui.item.value.split(" - ");
          }
        });
    }

    function autodrawingByjointWM(input){
        var drawing_joint_value = $("input[name='drawing_joint']").val();  
        var module_value        = $("select[name='module_joint']").find('option:selected').val();  
        var discipline_value    = $("select[name='discipline_joint']").find('option:selected').val();

        console.log(drawing_joint_value);

        $(input).autocomplete({
          source: function(request,response){
            $.post('<?php echo base_url(); ?>wtr/display_drawing',{term: request.term ,module_value:module_value, discipline_value:discipline_value, drawing_ga: drawing_joint_value }, response, 'json');
          },
          autoFocus: true,
          classes: {
            "ui-autocomplete": "highlight"
          },
          select: function(event, ui){
            var badge = ui.item.value.split(" - ");
          }
        });
    }

</script>

  <script type="text/javascript">
  function populateModuleChained(){

           var project     = $("select[name='project_joint']").find('option:selected').val(); 

            $.ajax({
            url: "<?php echo base_url();?>wtr/populate_module_chained",
            type: "post",
            data: {
              project_id: project
            },
            success: function(data) {

              if(data.includes("Error")){
                $('#module').find('option').remove().end();
                Swal.fire(
                  'Warning',
                  'Sorry, Module / Jacket ID not Found for selected Project Name',
                  'warning'
                );

              } else {
                 $('#module').find('option').remove().end();
                  $.each(JSON.parse(data), function(i, obj){
                       $('#module').append($('<option>').text(obj.text).attr('value', obj.val));
                       openDrawingByjoint();
                  });

              }

            }

          });       

}


function auto_joint_number(input){     

    var drawing_no       = $("input[name='drawing_joint']").val();  
    var drawing_wm       = $("input[name='drawing_wm']").val();  
    var module_value     = $("select[name='module_joint']").find('option:selected').val();  
    var discipline_value = $("select[name='discipline_joint']").find('option:selected').val();
    var joint_no         = $("input[name='joint_number']").val(); 
    var id_joint         = $("input[id='id_joint_list']").val(); 
  
    $(input).autocomplete({
      source: function(request,response){
        $.post('<?php echo base_url(); ?>irn/display_joint_number',{term: request.term, drawing_no:drawing_no, drawing_wm:drawing_wm, module:module_value, discipline:discipline_value, id_joint:id_joint}, response, 'json');
      },
      autoFocus: true,
      classes: {
        "ui-autocomplete": "highlight"
      },
      select: function(event, ui){
        var badge = ui.item.value.split(" - ");
      }
    });
}

$(function(){
   
    var tbl = $("#tableListJoint");

    var no = 0;
    
    $("#addRowBtn").click(function(){

       var project_joint         = $("select[name='project_joint']").find('option:selected').val();  
       var drawing_wm            = $("input[name='drawing_wm']").val();  
       var drawing_joint_val     = $("input[name='drawing_joint']").val();  
       var module_joint_val      = $("select[name='module_joint']").find('option:selected').val();  
       var type_of_module_val    = $("select[name='type_of_module_joint']").find('option:selected').val();  
       var discipline_joint_val  = $("select[name='discipline_joint']").find('option:selected').val(); 
       var module_joint_text     = $("select[name='module_joint']").find('option:selected').text();  
       var discipline_joint_text = $("select[name='discipline_joint']").find('option:selected').text(); 

       var joint_number_val          = $("#joint_number").val();

          if(drawing_joint_val === ""){
             alert("Please Type Drawing Number..");
             return false;
          } else if(drawing_wm === ""){
             alert("Please Type Drawing WM..");
             return false;   
          } else if(module_joint_val === ""){
             alert("Please Choice Module / Jacket ID..");
             return false;
          } else if(type_of_module_val === ""){
             alert("Please choose Type of Module");
             return false;
          } else if(discipline_joint_val === ""){
             alert("Please Choice Discipline..");
             return false;
          } else if(joint_number_val === ""){
             alert("Please type joint number..");
             return false;   
          } else {

            $("select[name='module_joint']").attr("readonly", true)
            $("select[name='type_of_module_joint']").attr("readonly", true)
            $("select[name='discipline_joint']").attr("readonly", true)
            $("select[name='module_joint']").attr("readonly", true)
            $("select[name='discipline_joint']").attr("readonly", true)
            $("select[name='project_joint']").attr("readonly", true)

            $.ajax({
            url: "<?php echo base_url();?>irn/validated_joint_number_new",
            type: "post",
            data: {
              drawing_no: drawing_joint_val,
              drawing_wm: drawing_wm,
              discipline: discipline_joint_val,
              module: module_joint_val,
              type_of_module: type_of_module_val,
              joint_no: joint_number_val,
              submission_id: "<?= (isset($submission_id) ? $submission_id : null ) ?>",
            },
            success: function(data) { 

              if(data.includes("Error")){

                Swal.fire(
                    'Warning',
                    'Sorry, '+ data,
                    'warning'
                  );

              } else {

              var data_all = JSON.parse(data);  
 
              for (var i = 0; i <= data_all.length; i++) {
   
                $(".select2_multiple_itr").val('').trigger('change');
                $('.show_data').hide();

                var res = data_all[i].split(";");

                var get_joint_array_val = $("input[name='joint_number_array']").val();
                if(!get_joint_array_val){ 
                  var fill_joint_array_val = res[0];                  
                } else {
                  var fill_joint_array_val = get_joint_array_val+";"+res[0];
                }
               
                $("input[name='joint_number_array']").val(fill_joint_array_val);
                

                var html = `
                  <tr>
                    <td>
                      ${res[1]}
                      <input type='hidden' name='id_joint[]' value='${res[0]}'> 
                      <input type='hidden' name='project' value='${project_joint}'>
                      <input type='hidden' name='discipline' value='${discipline_joint_val}'>
                      <input type='hidden' name='module' value='${res[32]}''>
                      <input type='hidden' name='type_of_module' value='${res[33]}''>
                      <input type='hidden' name='type_of_search' value='PDF'>
                    </td>
                    <td>${res[2]}</td>
                    <td>${res[3]}</td>              
                    <td>${res[4]}<hr/>${res[5]}</td>              
                    <td>${res[6]}<hr/>${res[7]}</td>              
                    <td>${res[8]}<hr/>${res[9]}</td>              
                    <td>${res[10]}<hr/>${res[11]}</td>              
                    <td>${res[12]}<hr/>${res[13]}</td>              
                    <td>${res[14]}<hr/>${res[15]}</td>              
                    <td>${res[16]}<hr/>${res[17]}</td>              
                    <td>${res[18]}<hr/>${res[19]}</td>
                    <td>${res[34]}</td>                           
                                               
                    <td><button class='delRowBtn btn btn-danger'>Delete</button></td>
                  </tr>               
                `;
                $(html).appendTo(tbl);    

              }

            }

            }

          });

            
          }   
    });
        
    $(document.body).delegate(".delRowBtn", "click", function(){
        $(this).closest("tr").remove();        
    });    
    
});


$(function(){
   
   var tbl_dm = $("#tableDimension");
   var no_dm = 0;   
   $("#addRowDimension").click(function(){

      var id_dimension_detail      = $("select[name='filter_dimension[]']").val();   
      
        if(id_dimension_detail === ""){
            alert("Please Choice Dimension Control Report..");
            return false; 
         } else {


           $.ajax({
           url: "<?php echo base_url();?>irn/validated_report_dimension",
           type: "post",
           data: {
             id_dimension_detail: id_dimension_detail,
           },
           success: function(data) {

             
                          
             if(data.includes("Error")){

               Swal.fire(
                 'Warning',
                 'Sorry, '+data,
                 'warning'
               );

             } else {

              no_dm++; 

              $(".select2_dimension_control").val("");

              var success      = $.parseJSON(data);
              var array_length = success.length; 
              
                for(var i = 0;i<array_length;i++){
                  var html_dm = `
                    <tr>
                      <td>
                        <center>
                        ${success[i].report_number_detail}
                        <input type='hidden' name='no_dm[${i}]' value='${i}'>  
                        <input type='hidden' name='id_detail_dimension[${i}]' value='${success[i].id_detail_dimension}'>  
                        </center>
                      </td>
                      <td><center>${success[i].link_report}</center></td>   
                      <td><center><button class='delRowBtndimension btn btn-danger'>Delete</button></center></td>
                    </tr>               
                  `; 
                  $(html_dm).appendTo(tbl_dm);  
                } 

             }

           }

         });

           
         }   
   });
       
   $(document.body).delegate(".delRowBtndimension", "click", function(){
       $(this).closest("tr").remove();        
   });    

   //---------------------------------------------------------------------------------//

   var tbl_pnc = $("#tablePunchlist");
   var no_pnc = 0;   
   $("#addRowPunchlist").click(function(){

      var id_dimension_detail = $("select[name='filter_punchlist[]']").val();   
      
        if(id_dimension_detail === ""){

            alert("Please Choice Punchlist Report..");
            return false; 

         } else {

           $.ajax({
           url: "<?php echo base_url();?>irn/validated_report_punchlist",
           type: "post",
           data: {
             id_dimension_detail: id_dimension_detail,
           },
           success: function(data) {

            
                          
             if(data.includes("Error")){

               Swal.fire(
                 'Warning',
                 'Sorry, '+data,
                 'warning'
               );

             } else {

              no_pnc++; 

              $(".select2_punchlist").val("");

              var success      = $.parseJSON(data);
              var array_length = success.length; 
              
                for(var i = 0;i<array_length;i++){
                  var html_pnc = `
                    <tr>
                      <td>
                        <center>
                        ${success[i].report_number_detail}
                        <input type='hidden' name='no_pnc[${i}]' value='${i}'> 
                        <input type='hidden' name='id_main_punchlist[${i}]' value='${success[i].id}'>  
                        </center>
                      </td>
                      <td><center>${success[i].link_report}</center></td>   
                      <td><center><button class='delRowBtnPunchlist btn btn-danger'>Delete</button></center></td>
                    </tr>               
                  `; 
                  $(html_pnc).appendTo(tbl_pnc);  
                } 

             }

           }

         });

           
         }   
   });
       
   $(document.body).delegate(".delRowBtnPunchlist", "click", function(){
       $(this).closest("tr").remove();        
   });
   
});

var count_data_rfi = 0;
  function addrow_rfi() {
    $('.show_rfi').hide();
  var html = `
    <tr id="remove_rfi${count_data_rfi}">

      <td class="align-middle">
        <center>    
          <textarea name='item_tag_no[${count_data_rfi}]' class='form-control' placeholder='Item Tag Number'></textarea> 
        </center>    
      </td>

      <td class="align-middle">
        <center>    
          <textarea name='item_tag_description[${count_data_rfi}]' class='form-control' placeholder='Item Tag Description'></textarea> 
        </center>
      </td>

      <td class="align-middle">
        <center>    
          <textarea name='expected_time[${count_data_rfi}]' class='form-control' placeholder='Expected Time'></textarea> 
        </center>
      </td>

      <td class="align-middle"><button type="button" class="btn btn-danger" title="Delete Row" onclick="deleterow_rfi(this,${count_data_rfi});"><i class="fa fa-trash"></i></button></td>
  
    </tr>`;
    
    $("#tableListRfi").append(html);
    count_data_rfi++;
  }

  function deleterow_rfi(input, index) {
    console.log(index);
    $(input).closest('tr').remove();
    $('table#tableListRfi tr#remove_rfi'+index).remove();
  } 
  
  var count_data_pnc = 0;
  function addrow_pnc() {
    var html = `
      <tr id="remove_pnc${count_data_pnc}">
        <td class="align-middle">
          <input type="text" class="form-control" name="pnc_desc[${count_data_pnc}]" id="pnc_desc[${count_data_pnc}]" placeholder='Punchlist Description' >
        </td>

        <td class="align-middle">
          <center>      
            <input type="file" name="pnc_attachment[${count_data_pnc}]">
          </center>  
        </td>

        <td class="align-middle"><button type="button" class="btn btn-danger" title="Delete Row" onclick="deleterow_pnc(this,${count_data_pnc});"><i class="fa fa-trash"></i></button></td>
     </tr>`;
    
     $("#table_pnc").append(html);
     count_data_pnc++;
  }

  function deleterow_pnc(input, index) {
    $(input).closest('tr').remove();
    $('table#table_pnc tr#remove_pnc'+index).remove();
  }

  </script>


</form>

<script type="text/javascript">
  $("select[name=location_v2]").chained("select[name=area_v2]");
</script>

 




