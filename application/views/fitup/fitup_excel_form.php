<style type="text/css">
  .table {
    font-size: 100% !important;
    padding: 2px !important;
  }

  /*.select2-container {
    font-size: 70% !important;
    width: 100px !important;
    height: 20px !important;
  }

  .select2 {
    width:100%!important;
  }*/

  .big-checkbox {width: 20px; height: 20px;}
</style>
<div id="content" class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="<?php echo base_url(); ?>fitup/export_fitup" target="_blank" method="POST">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Project ID</label>
                  <div class="col-xl">
                    <select class="form-control" name="project" required>
                    <?php if($this->is_admin == 1){ ?>
                        <option value="">---</option>
                      <?php } ?>
                      <?php foreach ($project_list as $key => $value) : ?>
                        <?php if($this->is_admin == 1){ ?>
                         <option value="<?php echo $value['id'] ?>" <?php echo (@$post['project'] == $value['id'] ? 'selected' : ($this->user_cookie[10] == $value['id'] ? 'selected' : '')) ?>><?php echo $value['project_name'] ?></option>
                        <?php } else { ?>
                          <?php if(in_array($value['id'], $this->user_cookie[13])){ ?>
                            <option value="<?php echo $value['id'] ?>" <?= ($this->user_cookie[10] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                          <?php } ?>
                        <?php } ?> 
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Drawing Type</label>
                  <div class="col-xl">
                    <select class="form-control" name="drawing_type" >
                      <option value="">---</option>
                      <option value="1" <?php echo (@$get['drawing_type'] == '1' ? 'selected' : '') ?>>GA</option>
                      <option value="2" <?php echo (@$get['drawing_type'] == '2' ? 'selected' : '') ?>>Assembly</option> 
                      <option value="13" <?php echo (@$get['drawing_type'] == '13' ? 'selected' : '') ?>>Isometric</option>
                      <option value="9" <?php echo (@$get['drawing_type'] == '9' ? 'selected' : '') ?>>WM GA</option>
                      <option value="14" <?php echo (@$get['drawing_type'] == '14' ? 'selected' : '') ?>>WM AS</option>
                      <option value="12" <?php echo (@$get['drawing_type'] == '12' ? 'selected' : '') ?>>Pipe Support</option>
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
                    <select class="form-control" name="module" required>
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
                   <select class="form-control" name="type_of_module" required>
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
                    <select class="form-control" name="discipline" required>
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['discipline'] == $value['id'] || $value['id'] == 2 ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-xl-3 col-form-label ">Deck Elevation / Service Line</label>
                  <div class="col-xl">
                    <select name="deck_elevation" class="select2" style="width:100%">
                      <option value="">---</option>
                      <?php foreach ($deck_list as $key => $value): ?>
                      <option value="<?= $value['id'] ?>" <?= $value['id'] == @$get['deck_elevation'] ? 'selected' : '' ?>>
                        <?= $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              
            </div>

            <div class="row">
              
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Status Submission</label>
                  <div class="col-xl">
                    <select class="form-control" name="status_inspection">
                      <?php if($user_cookie[7] != 8){ ?>
                      <option value="" <?php echo (@$get['status_inspection'] == "-" ? 'selected' : '') ?>>---</option>
                      <option value="0" <?php echo (@$get['status_inspection'] == "0" ? 'selected' : '') ?>>Ready to Submit</option>
                      <option value="1" <?php echo (@$get['status_inspection'] == "1" ? 'selected' : '') ?>>Pending Approval</option>
                      <option value="2" <?php echo (@$get['status_inspection'] == "2" ? 'selected' : '') ?>>Rejected</option>
                      <option value="rwvd" <?php echo (@$get['status_inspection'] == "rwvd" ? 'selected' : '') ?>>Reviewed</option>
                      <option value="3" <?php echo (@$get['status_inspection'] == "3" ? 'selected' : '') ?>>Accepted By QC</option>
                      <option value="4" <?php echo (@$get['status_inspection'] == "4" ? 'selected' : '') ?>>Pending By QC</option>                         
                      <?php } ?> 
                      <option value="all_client" <?php echo (@$get['status_inspection'] == "all_client" ? 'selected' : ($user_cookie[7] == 8 ? 'selected' : '')) ?>>All Report</option>                 
                      <option value="5" <?php echo (@$get['status_inspection'] == "5" ? 'selected' : '') ?>>Pending Client</option>                 
                      <option value="5" <?php echo (@$get['status_inspection'] == "9" ? 'selected' : '') ?>>Approved and Released With Comment</option>                 
                      <option value="5" <?php echo (@$get['status_inspection'] == "10" ? 'selected' : '') ?>>Postponed</option>                 
                      <option value="5" <?php echo (@$get['status_inspection'] == "11" ? 'selected' : '') ?>>Re-Offer</option>                 
                      <option value="6" <?php echo (@$get['status_inspection'] == "6" ? 'selected' : '') ?>>Rejected CLient</option>                      
                      <option value="7" <?php echo (@$get['status_inspection'] == "7" ? 'selected' : '') ?>>Accepted By Client</option>                      
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label">Inspection Authority</label>
                  <div class="col-xl">
                    <select name="inspection_authority[]" class="select2" style="width:100%" multiple>
                      <option value="0" <?= @$arr_inspection_auth[0] == 1 ? 'selected' : '' ?>>Hold Point</option>
                      <option value="1" <?= @$arr_inspection_auth[1] == 1 ? 'selected' : '' ?>>Witness</option>
                      <option value="2" <?= @$arr_inspection_auth[2] == 1 ? 'selected' : '' ?>>Monitoring</option>
                      <option value="3" <?= @$arr_inspection_auth[3] == 1 ? 'selected' : '' ?>>Review</option>
                    </select>
                  </div>
                </div>
              </div>
            
            </div>


            <div class="row">
              
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Company</label>
                  <div class="col-xl">
                    <select class="form-control select2" name="company_id" >
                      <option value="999" selected>---</option>
                      <?php foreach($company_list as $key => $value){ 
                        if(in_array($value['id_company'], $this->user_cookie[14])){ ?>
                        <option value='<?= $value['id_company'] ?>' <?= ($value['id_company'] == @$get['company_id'] ? "selected" : "") ?>><?= $value['company_name'] ?></option>
                      <?php }} ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Yard</label>
                  <div class="col-xl">
                    <select class="form-control select2" name="company_yard" >
                      <option value="999" selected>---</option>
                      <?php foreach($company_list as $key => $value){ 
                        if(in_array($value['id_company'], $this->user_cookie[14])){ ?>
                        <option value='<?= $value['id_company'] ?>' <?= ($value['id_company'] == @$get['company_id'] ? "selected" : "") ?>><?= $value['company_name'] ?></option>
                      <?php }} ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group row">
                    <input type="hidden" class="form-control" name="drawing_no" >
                    <input type="hidden" class="form-control" name="drawing_wm" >
                  <?php if($this->user_cookie[7] != 8){ ?>
                    <label class="col-md-4 col-lg-3 col-form-label ">Joint View Type</label>
                  <?php } ?>
                  <div class="col-xl">
                  <?php if($this->user_cookie[7] != 8){ ?>
                    <select name="joint_view_type" class="select2" style="width:100%" required>
                        <option value='all'>All</option>
                        <option value='0'>External</option>
                        <option value='1'>Internal</option>
                    </select>
                    <?php } else { ?>  
                      <input type="hidden" class="form-control" name="joint_view_type" value='0' >
                    <?php } ?>  
                  </div> 
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label">Submission Date From</label>
                  <div class="col-xl">
                  <input type="date" name="date_request"  class="form-control" >
                  </div>
                </div>
              </div>

            </div>

            <div class="row">
              
              <div class="col-6">
                <div class="form-group row">                  
                  <div class="col-xl">
                  <label class="col-md-4 col-lg-3 "><input type='checkbox' name='history_included' class='big-checkbox' value='1' <?php if(isset($get['history_included'])){ echo  "selected"; } ?>> &nbsp;&nbsp; History Included</label>
                  </div>
                </div>
              </div>
            
              <div class="col-md-6">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label">Submission Date To</label>
                  <div class="col-xl">
                  <input type="date" name="date_request_to"  class="form-control" >
                  </div>
                </div>
              </div>

            </div>

            

            <div class="row">
              <div class="col-12 text-right">
                <!-- <button type="submit" name="submit" value="reject" class="mt-2 btn btn-sm btn-flat btn-danger"><i class="fas fa-file-excel"></i> Export Reject Summary</button> -->
                <button type="submit" name="submit" value="register" class="mt-2 btn btn-sm btn-flat btn-success"><i class="fas fa-file-excel"></i> Export Fitup</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>



  <script>

    
  $("select[name=module]").chained("select[name=project]");

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
           $("select[name=status_inspection]").val("-");
        }
      }
    });
  }

  $(document).ready(function() {
    $("#mySelect").select2();
  });

</script>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->
