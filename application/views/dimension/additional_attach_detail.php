 
<div id="content" class="container-fluid">
<div class="row">
  <div class="col-md-12">

  <!-- START FILTER -->
  <?php if($this->permission_cookie[131]){ ?>  
  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="pb-2 mb-0">Filter Drawing</h6>
    <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
      <div class="container-fluid">    
            <form id="form_filter" method="POST" action="">

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label">Project :</label>
                    <div class="col-xl">
                      <select class="form-control" name="project" required disabled>
                        <option value="">---</option>
                        <?php foreach ($project_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$data_additional_report[0]['project'] == $value['id'] ? 'selected' : ($this->user_cookie[10] == $value['id'] ? 'selected' : '')) ?>><?php echo $value['project_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label">Discipline :</label>
                    <div class="col-xl">
                      <select class="custom-select" name="discipline" disabled>
                        <option value="">---</option>
                        <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$data_additional_report[0]['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label">Module :</label>
                    <div class="col-xl">
                        <select class="form-control" name="module" disabled>
                          <option value="">---</option>
                          <?php foreach ($module_list as $key => $value) : ?>
                          <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$data_additional_report[0]['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                          <?php endforeach; ?>
                        </select>  
                    </div>
                  </div>
                </div> 
                <div class="col-md">
                  <div class="form-group row"> 

                    <label class="col-xl-2 col-form-label">Type Of Module :</label>
                    <div class="col-xl">
                      <select class="form-control" name="type_of_module" disabled>
                        <option value="">---</option>
                        <?php foreach ($type_of_module_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$data_additional_report[0]['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select> 
                    </div>
                    
                  </div>
                </div>                    
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">                 
                      <label class="col-xl-2 col-form-label">Deck Elevation / Service Line :</label>
                      <div class="col-xl">
                            <select name="deck_elevation" class="select2" style="width:100%" disabled>
                              <option value="">---</option>
                              <?php foreach ($deck_list as $key => $value): ?>
                              <option value="<?= $value['id'] ?>" <?= $value['id'] == @$data_additional_report[0]['deck_elevation'] ? 'selected' : '' ?>>
                                <?= $value['name'] ?></option>
                              <?php endforeach; ?>
                            </select> 
                      </div> 
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label">Drawing Number :</label>
                    <div class="col-xl">
                        <input type="text" class="form-control autocomplete_doc" name="drawing_no" value="<?php echo @$data_additional_report[0]['drawing_no'] ?>" disabled> 
                    </div>                          
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">                 
                  <label class="col-xl-2 col-form-label">Drawing Weldmap :</label>
                      <div class="col-xl">
                        <input type="text" class="form-control autocomplete_wm" name="drawing_wm" value="<?php echo @$data_additional_report[0]['drawing_wm'] ?>" disabled> 
                      </div> 
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label"> </label>
                    <div class="col-xl">
                         
                    </div>                          
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row m-0">
                    <div class="col-xl text-right">
                    <button type="submit" name='submit' value='filter' class="btn btn-primary" title="Update"><i class="fa fa-search"></i> Filter</button> 
                  </div>
                  </div>
                </div>
              </div>
            </form>
      </div>
    </div>
  </div>
  <?php } ?>
  <!-- END FILTER -->
   

      <form id="form_filter" method="POST" action="<?= base_url() ?>additional/update_additional_report" enctype="multipart/form-data">

        <input type='hidden' name='submission_id' class='form-control' value='<?php echo @$data_additional_report[0]['submission_id'] ?>'>

      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">RFI Details</h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">   
                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-2 col-form-label">RFI Number</label>
                        <div class="col-xl">
                            <input type='text' name='rfi_number' class='form-control' reqired value="<?php echo @$data_additional_report[0]['rfi_number'] ?>" >
                        </div>
                      </div>
                    </div> 
                    <div class="col-md">
                      <div class="form-group row">  
                        <label class="col-xl-2 col-form-label"> </label>
                        <div class="col-xl"> 
                        </div> 
                      </div>
                    </div>                    
                  </div>  
                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-2 col-form-label">Report Number</label>
                        <div class="col-xl">
                            <input type='text' name='report_number' class='form-control' reqired value="<?php echo @$data_additional_report[0]['report_number'] ?>" >
                        </div>
                      </div>
                    </div> 
                    <div class="col-md">
                      <div class="form-group row">  
                        <label class="col-xl-2 col-form-label"> </label>
                        <div class="col-xl"> 
                        </div> 
                      </div>
                    </div>                    
                  </div> 
                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-2 col-form-label">Date Of Inspection</label>
                        <div class="col-xl">
                            <input type='date' name='date_of_inspection' class='form-control' value="<?php echo date("Y-m-d", strtotime($data_additional_report[0]['date_of_inspection'])); ?>"   >
                        </div>
                      </div>
                    </div> 
                    <div class="col-md">
                      <div class="form-group row">  
                        <label class="col-xl-2 col-form-label"> </label>
                        <div class="col-xl"> 
                        <input type='hidden' name='type_of_report' class='form-control' value="<?= $type_of_report ?>"  >
                        </div> 
                      </div>
                    </div>                    
                  </div> 
                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-2 col-form-label">Attachment File</label>
                        <div class="col-xl">
                        <input type='file' name='attachment_file' class='form-control' reqired><br/>
                        <a target="_blank" href="<?= base_url() ?>additional/open_atc/<?php echo @$data_additional_report[0]['attachment_file'] ?>"> <img width="50" height="50" src="<?= base_url() ?>img/pdf.svg"></a>
                        </div>
                      </div>
                    </div> 
                    <div class="col-md">
                      <div class="form-group row">  
                        <label class="col-xl-2 col-form-label"> </label>
                        <div class="col-xl"> 
                        </div> 
                      </div>
                    </div>                    
                  </div> 
          </div>
        </div>
      </div>

    <div class="my-3 p-3 bg-white rounded shadow-sm">
      <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
      <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
        <div class="container-fluid">
          <table class="table table-hover datatables">
            <thead>
              <tr bgcolor="#008060" style="color: white; text-align: center;">  
                 
                <th>Drawing Number</th> 
                <th>Drawing WM</th> 
                <th>Discipline</th>
                <th>Module</th> 
                <th>Type Of Module</th>
                <th>Deck Elevation / Service Line</th>  
                <th>Joint Number</th>  
                <!-- <th>Part #ID</th>    -->
                <th>Weld Length</th>   
                <th>Weld Date</th>   
              </tr>
            </thead>
            <tbody>
              <?php foreach($data_additional_report as $key => $dc_list){ ?>
              <tr style='text-align:center;'>   
                 
                <td><?= $dc_list['drawing_no'] ?></td> 
                <td><?= $dc_list['drawing_wm'] ?></td> 
                <td><?php echo (isset($discipline_name[$dc_list['discipline']]) ? $discipline_name[$dc_list['discipline']] : '-') ?></td>
                <td><?php echo (isset($module_code[$dc_list['module']]) ? $module_code[$dc_list['module']] : '-') ?></td>
                <td><?php echo (isset($type_of_module_name[$dc_list['type_of_module']]) ? $type_of_module_name[$dc_list['type_of_module']] : '-') ?></td>                
                <td><?php echo (isset($deck_elevation_show[$dc_list['deck_elevation']]) ? $deck_elevation_show[$dc_list['deck_elevation']] : '-') ?></td> 
                <td><?= $dc_list["joint_no"] ?></td> 
                <!-- <td><?= $dc_list["pos_1"] ?><br/><?= $dc_list["pos_2"] ?></td>  -->
                <td><?= $dc_list["weld_length"] ?></td> 
                <td><?= $dc_list["weld_datetime"] ?></td> 
              </tr>
              <?php } ?>
            </tbody>
          </table>
              
          <br/> 
          <div class="col-xl text-right">
            <button type="submit" name='submit' id='submit_button' class="btn btn-primary" title="Submit Data" >  Submit</button> 
          </div>

        </div>
        
      </div>
               
    </div>

    
    </form> 

  </div>
</div>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->

<script type="text/javascript">

$('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    orientation: "bottom auto",
    autoclose: true,
    todayHighlight: true
});

$(document).ready(function() {
  $('.datatables').DataTable({
      lengthMenu: [ [ -1], [ "All"] ],
      // pageLength: 10,
      order: [],
      columnDefs: [{
        "targets": 0,
        "pageLength": 10
        //"orderable": false,
      }]
  })
} ); 

</script>

 
<script>
 $("select[name=module]").chained("select[name=project]");
</script> 