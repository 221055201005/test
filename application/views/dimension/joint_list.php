<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="" method="GET">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
                  <div class="col-xl">
                    <select class="form-control" name="project" id='project_id' required>
											<?php foreach ($project_list as $key => $value) : ?>
												<?php if(in_array($value['id'], $this->user_cookie[13])): ?>
													<option value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
												<?php endif; ?>
											<?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                  <div class="col-xl">
                    <select class="form-control" name="discipline" required>
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Drawing No</label>
                  <div class="col-xl">
                    <input type="text" class="form-control autocomplete_doc" name="drawing_no" value="<?php echo @$get['drawing_no'] ?>" required>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Drawing Type</label>
                  <div class="col-xl">
                    <select class="form-control" name="drawing_type" required>
                      <option value="">---</option>
                      <option value="1" <?php echo (@$get['drawing_type'] == '1' ? 'selected' : '') ?>>GA</option>
                      <option value="2" <?php echo (@$get['drawing_type'] == '2' ? 'selected' : '') ?>>Assembly</option>
                      <!-- <option value="3" <?php echo (@$get['drawing_type'] == '3' ? 'selected' : '') ?>>Weldmap</option> -->
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type Of Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="type_of_module">
                      <option value="">---</option>
                      <?php foreach ($type_of_module_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Deck Elevation / Service Line</label>
                  <div class="col-md">
                    <select class="form-control" name="deck_elevation" required>
                      <option value="">---</option>
                      <?php foreach ($deck_elevation_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Module</label>
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
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Description Assembly</label>
                  <div class="col-xl">
                    <select class="form-control" name="description_assy" required>
                      <option value="">---</option>
                      <?php foreach ($desc_assy_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['description_assy'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code'].' - '.$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Weldmap</label>
                  <div class="col-xl">
                    <input type="text" class="form-control autocomplete_wm" name="drawing_wm" value="<?php echo @$get['drawing_wm'] ?>" required>
                  </div>
                </div>
              </div>
            <!-- </div>
            <div class="row"> -->
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status</label>
                  <div class="col-xl">
                    <select class="form-control" name="status">  
                      <option value="submitted" <?php echo @$get['status'] == "submitted" ? "selected" : "" ?>>Joint Submitted</option> 
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-right">
                <button class="mt-2 btn btn-sm btn-flat btn-info" name="submit" value="search" onclick="$(this).closest('form').find(' select').prop('required', false)"><i class="fas fa-search"></i> Search</button> 
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <?php if(isset($get['submit'])): ?>
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
        
          <div class="overflow-auto">
            <table id="table_joint_list" class="table table-hover text-center dataTable">
              <thead class="bg-green-smoe text-white">
                <tr>
                  <th><input type='checkbox' class='checkbox-big' name="check_all" onclick='checkall(this)'></th>
                  <th>Drawing GA/AS</th>
                  <th>Drawing WM</th>
                  <th>Rev WM</th>
                  <th>Joint No.</th>
                  <th>Piecemark#1</th>
                  <th>Piecemark#2</th> 
                  <th>Status Fitup</th>  
                  <th>Status Visual</th>  
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
           
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <div class="row">
            <div class="col-md-6">
              <?php if(@$get['drawing_no'] != ""): ?>
              
              <form method="POST" action="<?php echo base_url() ?>additional/submit_dimension_control/" onsubmit="save_id_checked(this)">
                <input type="hidden" name="id"> 
                 
                <div class="row mb-1">
                  <div class="col-md-12">
                    <button type="submit" name="submit" value="update_req" class="btn btn-primary"><i class='fas fa-check'></i> Submit <span class="text-warning num_ticker"><b>0</b></span> to Dimension Control</button>
                  </div>
                </div>
              </form>
              <?php else: ?>
              <div class="font-weight-bold text-info">
                You should filter by Drawing No to request update joint.
              </div>
              <?php endif; ?>
            </div>
          </div>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->
 
<script>
  $("select[name=module]").chained("select[name=project]");

  $('.dataTable').DataTable({
    processing: true,
    serverSide: true,
    order: [],
    ajax: {
      url: "<?php echo base_url();?>additional/joint_list_datatable",
      type: "POST",
      data:{
        page: 'list',
        <?php
          if(isset($get['submit'])){
            foreach ($get as $key => $value) {
              if($value != ""){
                $where[$key] = $value;
                echo "$key : '$value', \n";
              }
            }
          }
        ?>
      },
    },
    columnDefs: [{
      "targets": 0,
      "orderable": false,
      "render": function ( data, type, row, meta ) { 
          if(row[0] == 0){
            return '<i class="fas fa-flag" title="Already Requested"></i>';
          } else {
            if(jQuery.inArray(row[0], data_checkbox) != -1) {
              return "<input type='checkbox' class='checkbox-big' value='"+ row[0] +"' onclick='save_checkbox(this)' checked>";
            } else {
              return "<input type='checkbox' class='checkbox-big' value='"+ row[0] +"' onclick='save_checkbox(this)'>";
            }
          }
        }
    }]
  })

  $(".autocomplete_doc, .autocomplete_wm").autocomplete({
    source: function( request, response ) {
      var project_id = $("#project_id option:selected").val();
      var drawing_type;
      if($(this.element).hasClass("autocomplete_doc")){
        drawing_type = 1;//ga or as
      }
      else if($(this.element).hasClass("autocomplete_wm")){
        drawing_type = 2;
      }
      $.ajax( {
        url: "<?php echo base_url() ?>engineering/autocomplete_drawing",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: drawing_type,
          project_id: project_id,
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
      } else if (!$(this.element).hasClass("autocomplete_wm")) {
        get_data_drawing(ui.item.value);
      }
    }
  });

  function get_data_drawing(document_no) {
    console.log(document_no);
    $.ajax( {
      url: "<?php echo base_url() ?>engineering/get_data_drawing",
      dataType: "json",
      data: {
        document_no: document_no,
      },
      success: function(data) { 
        if(data.drawing_type == 1 || data.drawing_type == 2){
          $("select[name=project]").val(data.project).trigger('change');
          $("select[name=discipline]").val(data.discipline);
          $("select[name=drawing_type]").val(data.drawing_type);
          $("select[name=module]").val(data.module);
          $("select[name=type_of_module]").val(data.type_of_module);
          $("select[name=deck_elevation]").val(data.deck_elevation);
        }
      }
    });
  }

  var data_checkbox = [];
  function save_checkbox(input) { 
    if($(input).prop("checked") == true && $.inArray($(input).val(), data_checkbox) == -1){
      data_checkbox.push($(input).val());
    }
    else if($(input).prop("checked") == false && $.inArray($(input).val(), data_checkbox) != -1){
      data_checkbox.splice( $.inArray($(input).val(), data_checkbox), 1 );
    }

    if(data_checkbox.length > 0){
       var string = data_checkbox.length + " Joint's";
    } else {
      var string = data_checkbox.length + " Joint";
    }

    $(".num_ticker").html(string);     
  }

  function checkall(input) {
    $('#table_joint_list tbody input[type=checkbox]').each(function(i, obj) {
      if($(input).prop("checked") == true && $(obj).prop("checked") == false){
        $(obj).trigger("click"); 
      } else if($(input).prop("checked") == false && $(obj).prop("checked") == true){
        $(obj).trigger("click");
      }
    });
  }
  
  function save_id_checked(form) { 
    $(form).find("input[name=id]").val(data_checkbox.join(", "));
  }

  function open_history_log(id) {
    $('#history_log').modal('show');
    $('#history_log .modal-body').html('<div class="text-center"><div class="spinner-border text-success" role="status"><span class="sr-only">Loading...</span></div></div>');
    $.ajax( {
      url: "<?php echo base_url() ?>engineering/get_table_history_log",
      type: "POST",
      data: {
        id_template: id,
        module: 2,
      },
      success: function(data) {
        $('#history_log .modal-body').html(data);
      }
    });
  }
</script>