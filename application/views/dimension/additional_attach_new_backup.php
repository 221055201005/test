 
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
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$post['project'] == $value['id'] ? 'selected' : ($this->user_cookie[10] == $value['id'] ? 'selected' : '')) ?>><?php echo $value['project_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label">Discipline :</label>
                    <div class="col-xl">
                      <select class="custom-select" name="discipline">
                        <option value="">---</option>
                        <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$post['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
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
                        <select class="form-control" name="module"  >
                          <option value="">---</option>
                          <?php foreach ($module_list as $key => $value) : ?>
                          <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$post['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                          <?php endforeach; ?>
                        </select>  
                    </div>
                  </div>
                </div> 
                <div class="col-md">
                  <div class="form-group row"> 

                    <label class="col-xl-2 col-form-label">Type Of Module :</label>
                    <div class="col-xl">
                      <select class="form-control" name="type_of_module" >
                        <option value="">---</option>
                        <?php foreach ($type_of_module_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$post['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
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
                            <select name="deck_elevation" class="select2" style="width:100%">
                              <option value="">---</option>
                              <?php foreach ($deck_list as $key => $value): ?>
                              <option value="<?= $value['id'] ?>" <?= $value['id'] == @$post['deck_elevation'] ? 'selected' : '' ?>>
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
                        <input type="text" class="form-control autocomplete_doc" name="drawing_no" value="<?php echo @$post['drawing_no'] ?>" required>
                        <span style="color:red;font-weight: bold;font-style: italic;">Please choice Drawing Number</span>
                    </div>                          
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">                 
                  <label class="col-xl-2 col-form-label">Drawing Weldmap :</label>
                      <div class="col-xl">
                        <input type="text" class="form-control autocomplete_wm" name="drawing_wm" value="<?php echo @$post['drawing_wm'] ?>">
                        <span style="color:red;font-weight: bold;font-style: italic;">Please choice Weld Map Number</span> 
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
  <?php if($this->permission_cookie[131]){ ?>       
    
    <?php if(!empty($post["drawing_no"]) && !empty($post["drawing_wm"])){ ?>

      <form id="form_filter" method="POST" action="<?= base_url() ?>additional/save_additional_report" enctype="multipart/form-data">

      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">RFI Details</h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">   
                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-2 col-form-label">RFI Number</label>
                        <div class="col-xl">
                            <input type='text' name='rfi_number' class='form-control' required>
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
                            <input type='text' name='report_number' class='form-control' required>
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
                            <input type='date' name='date_of_inspection' class='form-control' value="<?= date("Y-m-d") ?>"  required>
                        </div>
                      </div>
                    </div> 
                    <div class="col-md">
                      <div class="form-group row">  
                        <label class="col-xl-2 col-form-label"> </label>
                        <div class="col-xl"> 
                        <input type='hidden' name='type_of_report' class='form-control' value="<?= $type_of_report ?>" required>
                        </div> 
                      </div>
                    </div>                    
                  </div> 
                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-2 col-form-label">Attachment File</label>
                        <div class="col-xl">
                            <input type='file' name='attachment_file' class='form-control' required>
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
                <th>
                  <input type='checkbox' class='form-control' style='width:20px !important;' onchange='checklist_all();'>
                  <input type='hidden' name='check_status_all' id='check_status' class='form-control' value='0'>
                  <input type='hidden' name='count_checked' class='form-control' value='0'>
                </th> 
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
                <td>
                  <input type='checkbox' name='check[<?= $key ?>]' id='check' class='form-control' style='width:20px !important;' onchange='checklist(this,"<?= $key ?>");'>
                  <input type='hidden' name='check_status[<?= $key ?>]' id='check_status' class='form-control' value='0'>
                  <input type='hidden' name='id_joint_temp[<?= $key ?>]' class='form-control' value='<?= $dc_list["id"] ?>'>                  
                </td> 
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
            <button type="submit" name='submit' id='submit_button' class="btn btn-primary" title="Submit Data" disabled>  Submit</button> 
          </div>

        </div>
        
      </div>
               
    </div>

    
    </form>
    <?php } ?>  
    <?php } ?>  

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


function checklist(input,key){
  var input = $(input).val();
  var input_checlist = $("input[name='check_status["+key+"]']").val();

  var total_checked = $("input[name='count_checked']").val();

  if(input_checlist == 0){
    $("input[name='check_status["+key+"]']").val(1);
    var final_total = Number(total_checked) + 1;
    $("input[name='count_checked']").val(final_total);
  } else {
    $("input[name='check_status["+key+"]']").val(0);
    var final_total = Number(total_checked) - 1;
    $("input[name='count_checked']").val(final_total);
  } 
  check_disabled()
}

function checklist_all(input,key){
  var input = $(input).val();
  var input_checlist = $("input[name='check_status_all']").val();

  if(input_checlist == 0){
    $("input[id='check']").prop('checked',true);
    $("input[id='check_status']").val(1);
    var final_total = "<?= isset($data_additional_report) ? sizeof($data_additional_report) : 0 ?>";
    $("input[name='count_checked']").val(final_total);
  } else {
    $("input[id='check']").prop('checked',false);
    $("input[id='check_status']").val(0); 
    $("input[name='count_checked']").val(0);
  } 
  check_disabled();
}

function check_disabled(){

  var total_checked = $("input[name='count_checked']").val();
 
  if(Number(total_checked) > 0){ 
    $("button[id='submit_button']").prop('disabled',false);
    $("button[id='submit_button']").removeAttr('disabled');
  } else {
    $("button[id='submit_button']").prop('disabled',true);
    $("button[id='submit_button']").attr('disabled','disabled');
  }
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
</script>

 
<script>
 $("select[name=module]").chained("select[name=project]");
</script> 