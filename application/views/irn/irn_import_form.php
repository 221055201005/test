
<style>
    .hide_tr {
      display: none;
    }
</style>

<script type="text/javascript">
  var arrIdTemplateJoint = [];
</script>
<div id="content" class="container-fluid">
  <form action="<?php echo base_url(); ?>irn/submit_irn_fab" enctype="multipart/form-data" method='POST' id="form_submition"> 
  <input type='hidden' name='category_irn' value='0'> 
  <div class="row">
 
    <div class="col-md-12">

       <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">Submit to IRN</h6>
         <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
  
            <div class="container-fluid">
              <?php //test_var($post, 1) ?>
              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Project List :</label>
                    <div class="col-xl">
                       <select class="form-control project2" name="project_joint" id="project2" required="" onchange="populateModuleChained();">
                        <option value="">---</option>
                          <?php foreach($active_project as $project){ ?>                                          
                              <option value="<?= $project['id'] ?>"
                                <?= $project['id']==$post['project_joint'] ? 'selected' : '' ?>
                              ><?= $project['project_name'] ?></option>
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
                      <?php //test_var($active_module) ?>
                      <select class="form-control select2class module2" name="module_joint" id="module" required>
                        <option value="">---</option>
                          <?php foreach($active_module as $module){ ?>   

                            <option value="<?= $module['mod_id'] ?>"
                              <?= $module['mod_id']==$post['module_joint'] ? 'selected' : '' ?>
                            ><?= $module['mod_desc'] ?></option>
                          <?php } ?>
                        </select>                                        
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
                                <option value="<?php echo $value['id'] ?>"
                                  <?= $value['id']==$post['type_of_module_joint'] ? 'selected' : '' ?>
                                ><?php echo $value['code']." - ".$value['name'] ?></option>
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
                          <option value="<?php echo $value['id'] ?>" 
                            <?= $value['id']==$post['discipline_joint'] ? 'selected' : '' ?>
                          ><?php echo $value['discipline_name'] ?></option>
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

                      <!-- <a href="<?= base_url("irn/import_joint_irn") ?>" class="btn btn-success"><i class="fas fa-file-excel"></i> Import Joint</a> -->

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
                      <th>Drawing<br/>Number</th>
                      <th>Weld<br/>Map<br/>Drawing No.</th> 
                      <th>Item /<br/>Joint No</th>
                      <th>Status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <?php //test_var($sheet) ?>
                  <tbody>
                  <?php foreach ($sheet as $key => $value) { if($key>1){?>
                    <?php
                      error_reporting(0);

                      $error = 0;

                      if(@$not_allow[$value['A']][$value['B']][$value['C']]){
                        $error = 1;
                        $message[] = "Joint Already Inserted to IRN";
                      }
                      if(!$allow[$value['A']][$value['B']][$value['C']]){
                        $error = 1;
                        $message[] = "Joint not listed on Registered Workpack"; 
                      }

                      if(in_array($allow[$value['A']][$value['B']][$value['C']], $id_joint_list)){
                        $error = 1;
                        $message[] = "Joint Duplicate on List, will not be inserted"; 
                      }
                      $id_joint_list[] = $allow[$value['A']][$value['B']][$value['C']];
                    ?>
                    <tr class="row_<?= $key ?> <?= $error==1 ? 'alert-warning' : '' ?>">

                      <input <?= $error==1 ? 'disabled' : '' ?> type='hidden' name='id_joint[]' value='<?= $allow[$value['A']][$value['B']][$value['C']] ?>'> 
                      <input <?= $error==1 ? 'disabled' : '' ?> type='hidden' name='project' value='<?= $post['project_joint'] ?>'>
                      <input <?= $error==1 ? 'disabled' : '' ?> type='hidden' name='discipline' value='<?= $post['discipline_joint'] ?>'>
                      <input <?= $error==1 ? 'disabled' : '' ?> type='hidden' name='module' value='<?= $post['module_joint'] ?>'>
                      <input <?= $error==1 ? 'disabled' : '' ?> type='hidden' name='type_of_module' value='<?= $post['type_of_module_joint'] ?>'>
                      <input <?= $error==1 ? 'disabled' : '' ?> type='hidden' name='type_of_search' value='PDF'>

                      <td><?= $value['A'] ?></td>
                      <td><?= $value['B'] ?></td>
                      <td><?= $value['C'] ?></td>
                      <td class="font-weight-bold">
                        <?= implode("<br>", $message) ?>
                      </td>
                      <td>
                        <button class='delRowBtn btn btn-danger'>Delete</button>
                      </td>
                    </tr>
                  <?php unset($message);}} ?>             
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
                    <div class="col-1">
                      <div class="form-group row">                          
                        <div class="col-xl">
                          <button type="submit" class="btn btn-secondary" name="submit" value='Draft' title="Draft">
                            <i class="fas fa-save"></i> Draft
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
    
  </div>  
  </form>
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
                                 
                    <td>${res[23]}</td>              
                    <td>${res[27]}</td>              
                    <td>${res[28]}</td>              
                    <td>${res[29]}</td>              
                    <td>${res[30]}</td>              
                    <td>${res[31]}</td>               
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

<script type="text/javascript">
  $("select[name=location_v2]").chained("select[name=area_v2]");
</script>

 




