 

<div id="content" class="container-fluid">
  <form action="<?php echo base_url(); ?>Wtr/insert_data_mwtr_signed" enctype="multipart/form-data" method='POST' id="form_submition"> 
  <input type='hidden' name='category_irn' value='0'> 
  <div class="row">
 
      

    <div class="col-md-12">     

        <div class="my-3 p-3 bg-white rounded shadow-sm">
          <h6 class="pb-2 mb-0">List Of Item Joint</h6>
            <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-gray">          
              <div class="container-fluid">


                <table class="table" width="100%" id='tableListJoint'>
                  <thead>
                    <tr>
                      <th>Drawing<br/>Number</th>
                      <th>Weld<br/>Map<br/>Drawing No.</th> 
                      <th>Item /<br/>Joint No</th>
                      <th>Remarks</th>
                      <th>Status</th> 
                    </tr>
                  </thead>

                  <tbody>
                  <?php foreach ($sheet as $key => $value) { if($key>1){?> 
                    <?php 
                      $error = 0;

                      if(!$allow[$value['A']][$value['B']][$value['C']]){
                        $error = 1;
                        $message[] = "Joint not listed on Registered Workpack"; 
                      }

                      if(in_array($allow[$value['A']][$value['B']][$value['C']], $id_joint_list)){
                        $error = 1;
                        $message[] = "Joint Duplicate on List, will not be inserted"; 
                      }

                      if(@$not_allow_data[$value['A']][$value['B']][$value['C']]){
                        $error = 1;
                        $message[] = "Joint Already Inserted to MWTR Signed";
                      }

                      if(isset($uniq_id) && !empty($uniq_id)){ 
                        if($drawing_no != $data_temp[$value['A']][$value['B']][$value['C']]['drawing_no']){

                          $error = 1;
                          $message[] = "Drawing Number not match! Should be ".$drawing_no;

                        }
                      }

                      $id_joint_list[] = $allow[$value['A']][$value['B']][$value['C']];
                    ?>
                    <tr class="row_<?= $key ?> <?= $error==1 ? 'alert-warning' : '' ?>">
                      
                      <td>
                        <?= $value['A'] ?>
                        <input <?= $error==1 ? 'disabled' : '' ?> type='hidden' name='uniq_id[]' value='<?= $uniq_id ?>'> 
                        <input <?= $error==1 ? 'disabled' : '' ?> type='hidden' name='drawing_no_val[]' value='<?= $drawing_no ?>'> 
                        <input <?= $error==1 ? 'disabled' : '' ?> type='hidden' name='id_joint[]' value='<?= $allow[$value['A']][$value['B']][$value['C']] ?>'> 
                        <input <?= $error==1 ? 'disabled' : '' ?> type='hidden' name='project' value='<?= $data_temp[$value['A']][$value['B']][$value['C']]['project'] ?>'>
                        <input <?= $error==1 ? 'disabled' : '' ?> type='hidden' name='discipline' value='<?= $data_temp[$value['A']][$value['B']][$value['C']]['discipline'] ?>'>
                        <input <?= $error==1 ? 'disabled' : '' ?> type='hidden' name='module' value='<?= $data_temp[$value['A']][$value['B']][$value['C']]['module'] ?>'>
                        <input <?= $error==1 ? 'disabled' : '' ?> type='hidden' name='type_of_module' value='<?= $data_temp[$value['A']][$value['B']][$value['C']]['type_of_module'] ?>'>
                        <input <?= $error==1 ? 'disabled' : '' ?> type='hidden' name='company_id' value='<?= $data_temp[$value['A']][$value['B']][$value['C']]['company_id_wp'] ?>'>
                        <input <?= $error==1 ? 'disabled' : '' ?> type='hidden' name='drawing_no[]' value='<?= $data_temp[$value['A']][$value['B']][$value['C']]['drawing_no'] ?>'>
                      </td>

                      <td><?= $value['B'] ?></td>

                      <td><?= $value['C'] ?></td>

                      <td>
                      	<input type="text" class="form-control" name="smoe_remarks[]" value="<?= $value['D'] ?>">
                      </td>

                      <td class="font-weight-bold">
                        <?= implode("<br>", $message) ?>
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
            <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">          
              <div class="container-fluid">    
                
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group row">                          
                        <div class="col-xl">
                        <?php if($error == 0 || !isset($error)){ ?>
                                <button type="submit" class="btn btn-secondary" name="submit" value='Draft' title="Draft">
                                    <i class="fas fa-save"></i> Draft  
                                </button>
                        <?php } else { ?>   
                            Oops.. Someting look still found error on the list.
                            <br/>
                            Please Fix Error on your excel file and re-upload again..
                            <br/>
                            <br/>
                            <?php if(isset($uniq_id)){ ?>
                              <a href='<?= base_url() ?>Wtr/import_joint/<?= $uniq_id ?>/<?= $drawing_no ?>' class='btn btn-warning'>Re-Upload</a>
                            <?php } else { ?>  
                              <a href='<?= base_url() ?>Wtr/import_joint' class='btn btn-warning'>Re-Upload</a>   
                            <?php } ?>    
                        <?php } ?>    
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
 

 




