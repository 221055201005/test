
<style>
.hide_tr {
  display: none;
}
</style>

<form id='form-submit' action="<?php echo base_url(); ?>irn/submit_irn_fab" enctype="multipart/form-data" method='POST' id="form_submition"> 

<input type='hidden' name='submission_itr' value='itr_data'>

<?php if(isset($submission_id) && !EMPTY($submission_id)){ ?>
<input type='hidden' name='submission_id' value='<?= $submission_id ?>' />
<?php } ?>

<input type='hidden' name='category_irn' value='1'> 

<script type="text/javascript">
var arrIdTemplateJoint = [];
</script>
<div id="content" class="container-fluid">
<div class="row">

        <div class="col-md-12">

           <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="pb-2 mb-0">Submit to IRN</h6>
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
                              <label class="col-xl-3 col-form-label">Discipline List :</label>
                              <div class="col-xl">
                                <select class="custom-select select2class" name="discipline_joint" required="" id="disciplinex">
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
                              <label class="col-xl-3 col-form-label">Module :</label>
                              <div class="col-xl">
                                 <select class="form-control select2class module2" name="module_joint" id="module" required>
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
                              <label class="col-xl-3 col-form-label">Company :</label>
                              <div class="col-xl">
                                <select class="form-control select2" name="company_id_joint">
                                    <option value=''>~ Choose ~</option>
                                    <?php foreach($company_list as $key => $value){ ?>
                                      <?php if(in_array($value['id_company'], $this->user_cookie[14])){ ?>
                                        <option value='<?= $value['id_company'] ?>' <?= ($value['id_company'] == @$post['company_id'] ? "selected" : ($value['id_company'] == $this->user_cookie[11] ? "selected" : "")) ?>><?= $value['company_name'] ?></option>
                                      <?php } ?>
                                    <?php } ?>
                                </select>            
                              </div>
                            </div>
                          </div>
                        </div>

                       
                        <!-- <div class="row">
                          <div class="col-md">
                            <div class="form-group row">
                              <label class="col-xl-3 col-form-label"> ITR Number :</label>
                              <div class="col-xl">
                                <input type='text' name="drawing_joint" class="form-control" onkeydown="auto_filter_itr_number(this);" placeholder="Type ITR Number" id="itr_number" disabled="">
                              </div>
                            </div>
                          </div>
                        </div> -->

                        <div class="row">
                          <div class="col-md">
                            <div class="form-group row">
                              <label class="col-xl-3 col-form-label"> ITR Number :</label>
                              <div class="col-xl">
                                <select  class='select2_multiple_itr' name='itr_number[]' id='itr_number' multiple > 
                                </select>
                                <input type='hidden' name='submited_part' id='submited_part'>
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
                          <th rowspan='2'>Tag<br/>Number</th>
                          <th rowspan='2'>Weld<br/>Map<br/>Drawing No.</th> 
                          <th rowspan='2'>Item /<br/>Joint No</th>
                          <th colspan='7' style='text-align:center;'>Material Traceability</th> 
                          <th rowspan='2'>ITR Report</th> 
                          <th rowspan='2'>MRIR Attachment</th> 
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
                        </tr>
                    </thead>
                    <tbody>
                    
                                <?php if(isset($data_piecemark_list)){ ?>  
                                    
                                    <?php foreach($data_piecemark_list as $key => $value){   ?>

                                        <script>
                                          var get_old_val = $("#submited_part").val(); 
                                          var change_val = get_old_val+';'+<?php echo $value['id_piecemark'] ?>; 
                                          $("#submited_part").val(change_val); 
                                        </script>

                                 <?php

                                        if(isset($value['drawing_as']) && !empty($value['drawing_as'])){
                                            $weldmap_material = substr($value['drawing_as'],-13);
                                        } else {
                                            $weldmap_material = substr($value['drawing_ga'],-20);
                                        } 

                                        if(isset($warehouse_mis_mrir[$status_piecemark[$value['part_id']]['id_mis']]['unique_ident_no'])){
                                            $uniq_no_p1 = $warehouse_mis_mrir[$status_piecemark[$value['part_id']]['id_mis']]['unique_ident_no'];
                                        } else {
                                            $uniq_no_p1 = "-";
                                        }
                                        $certificate_name     = '';
                                        $certificate_link     = '';
                                        if($uniq_no_p1 != "-"){ 
                                          if(isset($list_unique_data[$uniq_no_p1])){
                                            $unique_ident_no    = $list_unique_data[$uniq_no_p1][0];
                                            if($unique_ident_no['category'] == "CS") {
                                              $certificate_name   = $unique_ident_no['mill_cert_no'];
                                              $receiving_id       = $rec_detail_cs[$unique_ident_no['receiving_detail_id']]['receiving_id'];
                      
                                              if(isset($certificate_attachment_cs[$receiving_id][$certificate_name])) {
                                                $certificate_name = $certificate_attachment_cs[$receiving_id][$certificate_name];
                                              }
                                            }
                      
                                            if($unique_ident_no['category'] == "SS") {
                                              $certificate_name   = $unique_ident_no['mill_cert_no'];
                                              $receiving_id       = $rec_detail_ss[$unique_ident_no['receiving_detail_id']]['receiving_id'];
                      
                                              if(isset($certificate_attachment_ss[$receiving_id][$certificate_name])) {
                                                $certificate_name = $certificate_attachment_ss[$receiving_id][$certificate_name];
                                              }
                                            }
                      
                                            $encrypt_certif       = strtr($this->encryption->encrypt($certificate_name), '+=/', '.-~');
                                            $encrypt_remote_loc   = strtr($this->encryption->encrypt('/PCMS/warehouse/receiving'), '+=/', '.-~');
                                            $download_certif      = site_url('irn/open_file/'.$encrypt_certif.'/'.$encrypt_remote_loc.'/download');
                      
                                            $certificate_link     = '<a target="_blank" href="'.$download_certif.'">'.$unique_ident_no['mill_cert_no'].'</a>';


                                            $list_of_attachment = array(); 
                                            foreach($list_unique_data[$uniq_no_p1] as $key => $vx){ 
                                              $encrypt_filename     = strtr($this->encryption->encrypt($vx["document_file"]), '+=/', '.-~');
                                              $encrypt_remote_loc   = strtr($this->encryption->encrypt('/PCMS/warehouse/mrir'), '+=/', '.-~');
                                              $download_attach      = site_url('irn/open_file/'.$encrypt_filename.'/'.$encrypt_remote_loc.'/download');

                                            $list_of_attachment[] = "<a target='_blank' href='".$download_attach."'  style='display: inline-block !important;'>".$vx["document_name"]."</a>";
                                            }
                                            $show_attachment = implode("<br/>",$list_of_attachment);
                                          } else {
                                            $show_attachment = "-";
                                          }
                                        } else {
                                          $show_attachment = "-";
                                        } 

                                        if(isset($status_piecemark[$value['part_id']]['profile'])){
                                            $profile_p1 = $status_piecemark[$value['part_id']]['profile'];
                                        } else {
                                            $profile_p1 = "-";
                                        }

                                        if(isset($status_piecemark[$value['part_id']]['diameter'])){
                                            $diameter_p1 = $status_piecemark[$value['part_id']]['diameter'];
                                        } else {
                                            $diameter_p1 = "-";
                                        }

                                        if(isset($status_piecemark[$value['part_id']]['can_number'])){
                                          $can_number = $status_piecemark[$value['part_id']]['can_number'];
                                        } else {
                                            $can_number = "-";
                                        }

                                        if(isset($status_piecemark[$value['part_id']]['length'])){
                                            $length_p1 = $status_piecemark[$value['part_id']]['length'];
                                        } else {
                                            $length_p1 = "-";
                                        }


                                        if(isset($status_piecemark[$value['part_id']]['area'])){
                                            $area_p1 = $status_piecemark[$value['part_id']]['area'];
                                        } else {
                                            $area_p1 = "-";
                                        }


                                        if(isset($status_piecemark[$value['part_id']]['thickness'])){
                                            $thickness_p1 = $status_piecemark[$value['part_id']]['thickness'];
                                        } else {
                                            $thickness_p1 = "-";
                                        }

                                        

                                        $project_id               = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['project_code']),'+=/', '.-~');
                                        $discipline               = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['discipline']),'+=/', '.-~');
                                        $type_of_module           = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['type_of_module']),'+=/', '.-~');
                                        $module                   = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['module']),'+=/', '.-~');
                                        $report_no                = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['report_number']),'+=/', '.-~');
                                        $report_no_rev            = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['report_no_rev']),'+=/', '.-~');
                                        $submission_id            = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['submission_id']),'+=/', '.-~');

                                        if(isset($status_piecemark[$value['part_id']]['status_inspection'])){
                                            if($status_piecemark[$value['part_id']]['status_inspection'] >= 3){
                                              if(isset($status_piecemark[$value['part_id']]['report_number'])){
                                                $status_inspection_p1 = '<a target="_blank" href="'.base_url().'material_verification/material_verification_pdf_client/'.$project_id.'/'.$discipline.'/'.$type_of_module.'/'.$module.'/'.$report_no.'/'.$report_no_rev.'">COMPLETED</a>';
                                              } else {
                                                $status_inspection_p1 = '<a target="_blank" href="'.base_url().'material_verification/material_verification_pdf/'.$submission_id.'">COMPLETED</a>';
                                              }                                               
                                            } else {
                                            $status_inspection_p1 ='OS';	
                                            }
                                            
                                        } else {
                                            $status_inspection_p1 = "-";
                                        }


                                        
                                            $status_fitup = "-";
                                        
                                            $status_visual ="-";
                                       

                                        $status_MT_show = "-";
                                        $status_PT_show = "-";
                                        $status_UT_show = "-";
                                        $status_RT_show = "-";

                                    ?>

                                    <tr>
                                        <td><?= $value['drawing_ga'] ?></td>
                                        <td><?= $can_number ?></td>
                                        <td><?= $value['drawing_as'] ?></td>
                                        <td><?= $weldmap_material ?></td>
                                        <td><?= $value['part_id'] ?></td>
                                        <td><?= $uniq_no_p1 ?> </td>
                                        <td><?= $profile_p1 ?> </td>
                                        <td><?= $diameter_p1 ?> </td>
                                        <td><?= $length_p1 ?> </td>
                                        <td><?= $area_p1 ?> </td>
                                        <td><?= $thickness_p1 ?> </td> 
                                        <td>
                                        <?= $certificate_link ?>
                                        <br>  
                                        <br>  
                                        <?= $show_attachment ?></td>
                                        <td>
                                            <a href='<?php echo base_url(); ?>irn/delete_data_draft/<?php echo strtr($this->encryption->encrypt($value['id_irn']),'+=/', '.-~') ; ?>'>
                                                <span class='btn btn-danger'>Delete</span>
                                            </a>
                                        </td>
                                    </tr>

                                    <?php } ?> 
                                    
                                    <?php } else { ?>

                                      <tr class='show_data'>
                                          <td colspan='19' style='text-align:center;font-weight:bold;'> ~ No Data ~ </td> 
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
	                    <label class="col-md-4 col-lg-3 col-form-label font-weight-bold"> IRN Type </label>
	                    <div class="col-xl">
	                       <select class="select2 form-control" name="irn_type" required>
	                       	<option value="">---</option>

	                       	<option value="1" <?= $show_pcms_irn[0]['irn_type']==1 ? 'selected' : '' ?>>Installation</option>
	                       	<option value="2" <?= $show_pcms_irn[0]['irn_type']==2 ? 'selected' : '' ?>>Blasting & Painting</option>
	                       	<option value="3" <?= $show_pcms_irn[0]['irn_type']==3 ? 'selected' : '' ?>>Galvanized</option>
	                       	<option value="4" <?= $show_pcms_irn[0]['irn_type']==4 ? 'selected' : '' ?>>Erection</option>
	                       </select>
	                    </div>
	                  </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label "> RFI Date </label>
                      <div class="col-xl">
                          <input type='text' name='rfi_date' class='form-control' id='datepicker' placeholder='RFI Date' value='<?php echo @$show_pcms_irn_description[0]['rfi_date'] ?>'>
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
                              <a href='<?php echo base_url(); ?>irn/delete_data_irn_description/<?php echo strtr($this->encryption->encrypt($value['id_description']),'+=/', '.-~') ; ?>'>
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
            <h6 class="pb-2 mb-0"> Additional Attachment</h6>
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
                                  <?php  
                                    $enc_redline = strtr($this->encryption->encrypt($value['pnc_attachment']), '+=/', '.-~');
                                    $enc_path    = strtr($this->encryption->encrypt('/PCMS/pcms_v2/irn_punchlist'), '+=/', '.-~'); 
                                  ?>
                                  <a href='<?= site_url('irn/open_file/'.$enc_redline.'/'.$enc_path) ?>'>
                                    <span class='btn btn-primary'><i class="fas fa-file-pdf"></i></span>
                                  </a>
                          </td> 
                          <td>
                              <a href='<?php echo base_url(); ?>irn/delete_data_irn_punchlist/<?php echo strtr($this->encryption->encrypt($value['id_irn_pnc']),'+=/', '.-~') ; ?>'>
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
        <?php if($data_piecemark_list[0]['irn_status_inspection'] == 0){ ?>
        
        <!-- <div class="col-md-12"> 

          <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="pb-2 mb-0">Manual Report Number</h6>
              <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-gray">          
                <div class="container-fluid"> 
                  <div class="col-md-6"> 
                    <input type='text' name='irn_report_number' class='form-control' value='<?= $data_piecemark_list[0]['irn_report_number'] ?>'   onkeyup='check_report_number(this);' placeholder='Manual IRN Report Number. Ex : 10'>
                    <input type='hidden' name='irn_status_inspection' value='<?= $data_piecemark_list[0]['irn_status_inspection'] ?>' >
                  </div>
                </div>
              </div>
          </div>
        </div> -->

        <?php } ?>


        <div class="col-md-12">

          <div class="my-3 p-3 bg-white rounded shadow-sm"> 
              <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">          
                <div class="container-fluid">    
                  
                    <div class="row">

                      <?php if($data_piecemark_list[0]['irn_status_inspection'] == 0){ ?>

                        <div class="col-1">
                          <div class="form-group row">                          
                            <div class="col-xl">
                              <button type="submit" class="btn btn-secondary" name="submit" value='Draft' title="Draft">
                                <i class="fas fa-save"></i> Draft
                              </button>
                            </div>
                          </div>
                        </div>

                        <!-- <div class="col-1">
                          <div class="form-group row">                          
                            <div class="col-xl">
                              <button type="submit" class="btn btn-primary" name="submit" value='submit' title="Submit">
                                <i class="fas fa-share"></i> Submit
                              </button>
                            </div>
                          </div>
                        </div>  -->

                      <?php } else { ?>

                        <div class="col-1">
                          <div class="form-group row">                          
                            <div class="col-xl">
                              <input type='hidden' name='irn_report_number' value='<?= $data_piecemark_list[0]['irn_report_number'] ?>' >
                              <input type='hidden' name='irn_status_inspection' value='<?= $data_piecemark_list[0]['irn_status_inspection'] ?>' >
                              <input type='hidden' name='smoe_approval_by' value='<?= $data_joint_list[0]['smoe_approval_by_irn'] ?>' >

                              <input type='hidden' name='smoe_approval_date' value='<?= $data_joint_list[0]['smoe_approval_date_irn'] ?>' >
                              <input type='hidden' name='smoe_remarks' value='<?= $data_joint_list[0]['smoe_remarks_irn'] ?>' > 
                              <input type='hidden' name='client_approval_by' value='<?= $data_joint_list[0]['client_approval_by_irn'] ?>' >
                              <input type='hidden' name='client_approval_date' value='<?= $data_joint_list[0]['client_approval_date_irn'] ?>' >
                              <input type='hidden' name='client_remarks' value='<?= $data_joint_list[0]['client_remarks_irn'] ?>' >
                              
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
 

jQuery(document).ready(function(){
    // addrow_dc();
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

    $(".select2_multiple_itr").select2({ 
        tokenSeparators: [',', ' '],
        ajax: {
              url: "<?php echo base_url();?>irn/display_search_itr_select2",
              type: "post",
              dataType       : 'json',
              data: function (params) {
                var query = {
                    search: params.term,
                    project_joint: $("select[name='project_joint']").find('option:selected').val(), 
                    discipline_value: $("select[name='discipline_joint']").find('option:selected').val(), 
                    module_value: $("select[name='module_joint']").find('option:selected').val(), 
                    type_of_module_joint: $("select[name='type_of_module_joint']").find('option:selected').val(),            
                    company_id_joint: $("select[name='company_id_joint']").find('option:selected').val(),    
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

function openDrawingByjoint(){

var module_value     = $("select[name='module_joint']").find('option:selected').val();  
var discipline_value = $("select[name='discipline_joint']").find('option:selected').val();

if(module_value !== "" && discipline_value !== ""){
  $("input[name='drawing_joint']").prop("disabled", false);
  $("input[name='part_id']").prop("disabled", false);
} else {
  $("input[name='drawing_joint']").prop("disabled", true);
  $("input[name='part_id']").prop("disabled", true);
}

}
 

function auto_filter_itr_number(input){
    var project_joint         = $("select[name='project_joint']").find('option:selected').val();  
    var module_value          = $("select[name='module_joint']").find('option:selected').val();  
    var type_of_module_joint  = $("select[name='type_of_module_joint']").find('option:selected').val();  
    var discipline_value      = $("select[name='discipline_joint']").find('option:selected').val();
    var company_id_joint      = $("select[name='company_id_joint']").find('option:selected').val();

    $(input).autocomplete({
      source: function(request,response){
        $.post('<?php echo base_url(); ?>irn/display_search_itr', {
            term: request.term ,
            project_joint: project_joint, 
            discipline_value: discipline_value, 
            module_value: module_value, 
            type_of_module_joint: type_of_module_joint,            
            company_id_joint: company_id_joint,            
        }, response, 'json');
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


function auto_part_id(input){     

var drawing_no       = $("input[name='drawing_joint']").val();  
var module_value     = $("select[name='module_joint']").find('option:selected').val();  
var discipline_value = $("select[name='discipline_joint']").find('option:selected').val();
var part_id          = $("input[name='part_id']").val(); 
var id_joint         = $("input[id='id_joint_list']").val(); 

$(input).autocomplete({
  source: function(request,response){
    $.post('<?php echo base_url(); ?>irn/display_part_id',{term: request.term, drawing_no:drawing_no, module:module_value, discipline:discipline_value, id_joint:id_joint}, response, 'json');
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
    var module_value          = $("select[name='module_joint']").find('option:selected').val();  
    var type_of_module_joint  = $("select[name='type_of_module_joint']").find('option:selected').val();  
    var discipline_value      = $("select[name='discipline_joint']").find('option:selected').val();
    var company_id_joint      = $("select[name='company_id_joint']").find('option:selected').val();
    var itr_number            = $('#itr_number').val(); 
    var submited_list         = $('#submited_part').val(); 
    

      if(project_joint === ""){
         alert("Please Choose Project..");
         return false;
      } else if(module_value === ""){
         alert("Please Choice Module..");
         return false;
      } else if(type_of_module_joint === ""){
         alert("Please Choice Type Of Module..");
         return false;
      } else if(discipline_value === ""){
         alert("Please Choose Discipline..");
         return false; 
      } else if(company_id_joint === ""){
         alert("Please Choose Company ID..");
         return false;    
      } else if(itr_number === ""){
         alert("Please Choose ITR Number..");
         return false;        
      } else {

        $("select[name='project_joint']").attr("readonly", true)
        $("select[name='module_joint']").attr("readonly", true)
        $("select[name='type_of_module_joint']").attr("readonly", true)
        $("select[name='discipline_joint']").attr("readonly", true)

        $.ajax({
        url: "<?php echo base_url();?>irn/validated_part_id_itr",
        type: "post",
        data: {
            project_joint: project_joint, 
            discipline_value: discipline_value, 
            module_value: module_value, 
            type_of_module_joint: type_of_module_joint,            
            company_id_joint: company_id_joint,  
            itr_number: itr_number,  
            submited_list: submited_list,  
        },
        success: function(data) { 

          if(data.includes("Error")){

            Swal.fire(
              'Warning',
              'Sorry, '+ message,
              'warning'
            );

          } else {

            var data_all = JSON.parse(data);
            

            for (var i = 0; i < data_all.length; i++) { 

              var get_old_val = $("#submited_part").val();
               
                $('.show_data').hide();
                var res = data_all[i].split(";");  

                var change_val = get_old_val+';'+res[0]; 
                $("#submited_part").val(change_val);

                var html = `
                  <tr>
                    <td>
                      ${res[7]}
                      <input type='hidden' name='id_piecemark[${i}]' value='${res[0]}'> 
                      <input type='hidden' name='project' value='${project_joint}'>
                      <input type='hidden' name='discipline' value='${discipline_value}'>
                      <input type='hidden' name='module' value='${res[2]}'>
                      <input type='hidden' name='type_of_module' value='${res[3]}'>
                      <input type='hidden' name='type_of_search' value='PDF'>
                    </td>
                    <td>${res[34]}</td>
                    <td>${res[9]}</td>
                    <td>${res[6]}</td>              
                    <td>${res[15]}</td>              
                    <td>${res[20]}</td>              
                    <td>${res[21]}</td>              
                    <td>${res[22]}</td>   
                    <td>${res[23]}</td> 
                    <td>${res[24]}</td>             
                    <td>${res[25]}</td>     
                    <td>${res[33]}</td>                   
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


var count_data_dc = 0;
function addrow_dc() {
var html = `
<tr id="remove_dc${count_data_dc}">
  <td class="align-middle">
    <input type="text" class="form-control" name="dc_desc[${count_data_dc}]" id="dc_desc[${count_data_dc}]" placeholder='DC Description' >
  </td>

  <td class="align-middle">
    <center>      
      <input type="file" name="dc_attachment[${count_data_dc}]">
    </center>  
  </td>

  <td class="align-middle"><button type="button" class="btn btn-danger" title="Delete Row" onclick="deleterow_dc(this,${count_data_dc});"><i class="fa fa-trash"></i></button></td>
</tr>`;

$("#table_dc").append(html);
count_data_dc++;
}

function deleterow_dc(input, index) {
console.log(index);
$(input).closest('tr').remove();
$('table#table_dc tr#remove_dc'+index).remove();
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

function check_report_number(input) {
var text = $(input).val(); 
$.ajax({
  url: "<?php echo base_url();?>irn/check_report_number/",
  type: "post",
  data: {
    'report_number': text, 
  },
  success: function(data) {         
    if(data.includes("Error")){          
      $(input).addClass('is-invalid');
      $('.invalid-feedback').remove( ":contains('Error')" );
      $('.valid-feedback').remove( ":contains('Success')" ); 
      $(input).after('<div class="invalid-feedback">'+data+'</div>');
      $('button[name=submit]').prop("disabled", true);         
    } else {
      var res = data.split(";"); 
      $('.invalid-feedback').remove( ":contains('Error')" );
      $('.valid-feedback').remove( ":contains('Success')" );
      $(input).removeClass('is-invalid');
      $(input).addClass('is-valid');   
      $(input).after('<div class="valid-feedback">'+data+'</div>');
      $('button[name=submit]').prop("disabled", false);         
    } 
  }
});
}

$('#form-submit').on('keyup keypress', function(e) {
var keyCode = e.keyCode || e.which;
if (keyCode === 13) { 
  e.preventDefault();
  return false;
}
});


</script>


</form>

<script type="text/javascript">
$("select[name=location_v2]").chained("select[name=area_v2]");
</script>






