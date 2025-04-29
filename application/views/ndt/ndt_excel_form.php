<style type="text/css">
  .table {
    font-size: 100% !important;
    padding: 2px !important;
  }
</style>
<div id="content" class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="<?php echo base_url(); ?>ndt_live/ndt_export_cc/<?= encrypt($method) ?>" method="POST">
            <div class="row">
               <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Project ID</label>
                  <div class="col-xl">
                    <select class="form-control" name="project" id="project_js" required>
                      
                      <?php if($this->permission_cookie[0] == 1 || in_array($this->user_cookie[11], [4, 25])){ ?>    
                        <option value="">---</option>                      
                        <?php foreach ($project_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$project_id == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                        <?php endforeach; ?>
                      <?php } else { ?>
                        <?php foreach ($project_list as $key => $value) : ?>
                          <?php if(in_array($value['id'], $this->user_cookie[13])){ ?>
                            <option value="<?php echo $value['id'] ?>" <?php echo ($this->user_cookie[10] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                          <?php } ?>
                        <?php endforeach; ?>
                      <?php } ?>
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
                      <option value="3" <?php echo (@$get['drawing_type'] == '3' ? 'selected' : '') ?>>Weldmap</option>
                      <option value="13" <?php echo (@$get['drawing_type'] == '13' ? 'selected' : '') ?> onclick="save_drawing_type()">ISO</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="module">
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
                   <select class="form-control" name="type_of_module" >
                      <option value="">---</option>
                      <?php foreach ($type_of_module_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>             

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Discipline</label>
                  <div class="col-xl">
                    <select class="form-control" name="discipline" >
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
                  <label class="col-md-4 col-lg-3 col-form-label ">Document Number</label>
                  <div class="col-xl">
                    <input type="text" class="form-control autocomplete_doc" name="drawing_no" value="<?php echo @$get['drawing_no'] ?>" >
                  </div>
                </div>
              </div>
            
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label">Deck Elevation / Service Line</label>
                  <div class="col-xl">
                    <select class="form-control" name="deck_elevation">
                      <option value="">---</option>
                      <?php foreach ($deck_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Status Inspection</label>
                  <div class="col-xl">
                    <select class="form-control" name="status_inspection">
                      <option value="-" <?php echo (@$get['status_inspection'] == "-" ? 'selected' : '') ?>>---</option>
                      <option value="0" <?php echo (@$get['status_inspection'] == "0" ? 'selected' : '') ?>>Pending Approval</option>
                      <option value="1" <?php echo (@$get['status_inspection'] == "3" ? 'selected' : '') ?>>Approved</option>
                      <option value="2" <?php echo (@$get['status_inspection'] == "2" ? 'selected' : '') ?>>Rejected</option>                    
                    </select>
                  </div>
                </div>
              </div>
            
               <div class="col-6">
                <div class="form-group row">
                 <label class="col-md-4 col-lg-3 col-form-label ">Weld Map Number</label>
                  <div class="col-xl">
                    <input type="text" class="form-control autocomplete_wm" name="drawing_wm" value="<?php echo @$get['drawing_wm'] ?>">
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Requestor Company</label>
                  <div class="col-xl">
                    <select class="form-control select2" name="company_id" style="<?= $this->user_cookie[11]==1 ? '' : 'pointer-events: none;' ?>">
                      <?php if($this->user_cookie[11]==1 OR $this->user_cookie[7]==8){ ?>
                        <option value="">---</option>
                      <?php } elseif(!in_array($this->user_cookie[11], $vendor_rfi)){ ?>
                        <option value="">---</option>
                      <?php } ?>
                      <?php foreach ($company as $key => $value){ ?>
                        <?php if( in_array($this->user_cookie[11], $vendor_rfi) AND $this->user_cookie[11]!=1 ){ ?>
                          <?php if($this->user_cookie[11]==$value['id_company']){ ?>
                            <option value="<?php echo $value['id_company'] ?>" <?= $this->user_cookie[11]==$value['id_company'] ? 'selected' : '' ?>>
                              <?php echo $value['company_name'] ?>    
                            </option>
                          <?php } ?>
                        <?php } else { ?>
                          <option value="<?php echo $value['id_company'] ?>" <?= $this->user_cookie[11]==$value['id_company'] ? 'selected' : '' ?>>
                            <?php echo $value['company_name'] ?>    
                          </option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Company Yard</label>
                  <div class="col-xl">
                    <select class="form-control select2" name="company_yard" style="<?= $this->user_cookie[11]==1 ? '' : 'pointer-events: none;' ?>">
                      <?php if($this->user_cookie[11]==1 OR $this->user_cookie[7]==8){ ?>
                        <option value="">---</option>
                      <?php } elseif(!in_array($this->user_cookie[11], $vendor_rfi)){ ?>
                        <option value="">---</option>
                      <?php } ?>
                      <?php foreach ($company as $key => $value){ ?>
                        <?php if( in_array($this->user_cookie[11], $vendor_rfi) AND $this->user_cookie[11]!=1 ){ ?>
                          <?php if($this->user_cookie[11]==$value['id_company']){ ?>
                            <option value="<?php echo $value['id_company'] ?>" <?= $this->user_cookie[11]==$value['id_company'] ? 'selected' : '' ?>>
                              <?php echo $value['company_name'] ?>    
                            </option>
                          <?php } ?>
                        <?php } else { ?>
                          <option value="<?php echo $value['id_company'] ?>" <?= $this->user_cookie[11]==$value['id_company'] ? 'selected' : '' ?>>
                            <?php echo $value['company_name'] ?>    
                          </option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Vendor</label>
                  <div class="col-xl">
                    <select class="form-control select2" name="vendor" style="<?= $this->user_cookie[11]==1 ? '' : 'pointer-events: none;' ?>">
                        <option value="">---</option>
                      <?php foreach ($vendor as $key => $value){ ?>
                        <option value="<?php echo $value['id_company'] ?>"><?php echo $value['company_name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <script type="text/javascript">
                  $('.select2').select2();
                </script>
              </div>
            </div>

            <div class="row">
              <!-- <div class="col-6">
                <div class="form-group row">                  
                  <div class="col">
                  <label class="col-md-4 col-lg-3 "><input type="checkbox" name="history_included" class="big-checkbox" value="true"> &nbsp;&nbsp; History Included</label>
                  </div>
                </div>
              </div> -->
            
              <div class="col-6">
                <div class="form-group row">
                  <div class="col-xl">
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12 text-right">
                <button type="submit" name="submit" value="register" class="mt-2 btn btn-sm btn-flat btn-success"><i class="fas fa-file-excel"></i> Export NDT <?= $initial ?></button>
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

    
</script>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->
