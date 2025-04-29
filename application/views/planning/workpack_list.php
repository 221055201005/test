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
                  <div class="col-md">
                    <select class="form-control" name="project" required>
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
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status</label>
                  <div class="col-md">
                    <select class="form-control" name="status">
                      <option value="">---</option>
                      <option value="1" <?php echo (@$get['status'] == "1" ? 'selected' : '') ?>>Draft</option>
                      <option value="8" <?php echo (@$get['status'] == "8" ? 'selected' : '') ?>>Pending Engineering</option>
                      <option value="2" <?php echo (@$get['status'] == "2" ? 'selected' : '') ?>>Pending Project / Construction Engineering (Issued)</option>
                      <option value="9" <?php echo (@$get['status'] == "9" ? 'selected' : '') ?>>Pending Construction Superintendent (Issued)</option>
                      <option value="3" <?php echo (@$get['status'] == "3" ? 'selected' : '') ?>>Issued</option>
                      <option value="6" <?php echo (@$get['status'] == "6" ? 'selected' : '') ?>>In Progress</option>
                      <option value="7" <?php echo (@$get['status'] == "7" ? 'selected' : '') ?>>Overdue</option>
                      <option value="10" <?php echo (@$get['status'] == "10" ? 'selected' : '') ?>>Pending Project / Construction Engineering (Returned)</option>
                      <option value="11" <?php echo (@$get['status'] == "11" ? 'selected' : '') ?>>Pending Construction Superintendent (Returned)</option>
                      <option value="4" <?php echo (@$get['status'] == "4" ? 'selected' : '') ?>>Completed</option>
                      <option value="5" <?php echo (@$get['status'] == "5" ? 'selected' : '') ?>>Rejected</option>
                      <option value="12" <?php echo (@$get['status'] == "12" ? 'selected' : '') ?>>Void</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Module</label>
                  <div class="col-md">
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
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type Of Module</label>
                  <div class="col-md">
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
                    <select class="form-control" name="deck_elevation">
                      <option value="">---</option>
                      <?php foreach ($deck_elevation_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                  <div class="col-md">
                    <select class="form-control" name="discipline">
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
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Phase</label>
                  <div class="col-md">
                    <select class="form-control" name="phase">
                      <option value="">---</option>
                      <option value="PF" <?php echo (@$get['phase'] == "PF" ? 'selected' : '') ?>>PF - Pre-Fabrication</option>
                      <option value="FB" <?php echo (@$get['phase'] == "FB" ? 'selected' : '') ?>>FB - Fabrication</option>
                      <option value="AS" <?php echo (@$get['phase'] == "AS" ? 'selected' : '') ?>>AS - Assembly</option>
                      <option value="ER" <?php echo (@$get['phase'] == "ER" ? 'selected' : '') ?>>ER - Erection</option>
                      <option value="ITR" <?php echo (@$get['phase'] == "ITR" ? 'selected' : '') ?>>ITR - Inspection & Test Record</option>
                      <option value="BAA" <?php echo (@$get['phase'] == "BAA" ? 'selected' : '') ?>>BAA - Bondstrand Adhesive Assembly</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Description Assy Code</label>
                  <div class="col-md">
                    <select class="form-control select2" name="desc_assy">
                      <option value="">---</option>
                      <?php foreach ($desc_assy_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['desc_assy'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Assigned Company</label>
                  <div class="col-md">
                    <select class="form-control select2" name="company_id">
                      <option value="">---</option>
                      <?php foreach ($company_list as $key => $value) : ?>
												<?php if($this->user_cookie[11] == 1 || $value['id_company'] == $this->user_cookie[11]): ?>
                          <option value="<?php echo $value['id_company'] ?>" <?php echo (@$get['company_id'] == $value['id_company'] ? 'selected' : '') ?>><?php echo $value['company_name'] ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Piping Testing Category</label>
                  <div class="col-md">
                    <select class="form-control select2" name="piping_testing_category">
                      <option value="">---</option>
                      <?php foreach ($piping_testing_category_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['piping_testing_category'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Yard Company</label>
                  <div class="col-md">
                    <select class="form-control select2" name="company_yard">
                      <option value="">---</option>
                      <?php foreach ($company_list as $key => $value) : ?>
												<?php if(in_array($value['id_company'], $this->user_cookie[14])): ?>
                          <option value="<?php echo $value['id_company'] ?>" <?php echo (@$get['company_yard'] == $value['id_company'] ? 'selected' : '') ?>><?php echo $value['company_name'] ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-right">
                <button class="mt-2 btn btn-sm btn-flat btn-success" name="submit" value="search"><i class="fas fa-search"></i> Search</button>
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
          <form method="POST" action="<?php echo base_url() ?>engineering/piecemark_update">
            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <!-- <th>Type</th> -->
                    <!-- <?php if(@$this->input->get('type') == 2): ?>
                    <th>IRN No.</th>
                    <?php else: ?>
                    <th>Drawing No</th>
                    <?php endif; ?> -->
                    
                    <th>Test Pack No</th>
                    <th>Drawing No</th>
                    <th>Workpack No.</th>
                    <th>Phase</th>
                    <th>Description</th>
                    <th>Assigned Company</th>
                    <th>Yard Company</th>
                    <th>Module</th>
                    <th>Type of Module</th>
                    <th>Discipline</th>
                    <th>Deck Elevation / Service Line</th>
                    <th>Assy Code</th>
                    <th>Piping Testing Category</th>
                    <th>Plan Start Date</th>
                    <th>Plan Finish Date</th>
                    <th>Progress</th>
                    <th>Status</th>
                    <!-- <th>MIS Status</th> -->
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
            </div>
            <br>
            <!-- <div class="col-md-4">
              <div class="row mb-1">
                <div class="col-md-12">
                  <button type="submit" name="submit" value="delete" class="btn btn-danger"><i class='fas fa-trash'></i> Delete selected item.</button>
                  <button type="submit" name="submit" value="edit" class="btn btn-warning"><i class='fas fa-edit'></i> Edit selected item.</button>
                </div>
              </div>
            </div> -->
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>

</div>
</div>
<script>
  $("select[name=module]").chained("select[name=project]");

  $('.dataTable').DataTable({
    order: [],
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": "<?php echo base_url();?>planning/workpack_list_datatable",
      "type": "POST",
      "data":{
          "page" : 'list',
          "type" : <?php echo (@$type == '' ? 1 : $type) ?>,
      <?php 
        if($this->input->get('submit')){
          echo '"submit": "'. $this->input->get('submit').'",';
          if($this->input->get('project')){
            echo '"project": '. $this->input->get('project').',';
          }
          if($this->input->get('status')){
            echo '"status": '. $this->input->get('status').',';
          }
          if($this->input->get('module')){
            echo '"module": '. $this->input->get('module').',';
          }
          if($this->input->get('type_of_module')){
            echo '"type_of_module": '. $this->input->get('type_of_module').',';
          }
          if($this->input->get('deck_elevation')){
            echo '"deck_elevation": '. $this->input->get('deck_elevation').',';
          }
          if($this->input->get('discipline')){
            echo '"discipline": '. $this->input->get('discipline').',';
          }
          if($this->input->get('phase')){
            echo '"phase": "'. $this->input->get('phase').'",';
          }
          if($this->input->get('desc_assy')){
            echo '"desc_assy": '. $this->input->get('desc_assy').',';
          }
          if($this->input->get('piping_testing_category')){
            echo '"piping_testing_category": '. $this->input->get('piping_testing_category').',';
          }
          // if($this->input->get('type')){
          //   echo '"type": '. $this->input->get('type').',';
          // }
          if($this->input->get('company_id')){
            echo '"company_id": '. $this->input->get('company_id').',';
          }
					if($this->input->get('company_yard')){
            echo '"company_yard": '. $this->input->get('company_yard').',';
          }
        }
      ?>
      }
    },
    // columnDefs: [{
    //   "targets": 11,
    //   "orderable": false,
    // }]
  })

  $(".autocomplete_ga, .autocomplete_as").autocomplete({
    source: function( request, response ) {
      var drawing_type;
      if($(this.element).hasClass("autocomplete_ga") || $(this.element).hasClass("autocomplete_as")){
        drawing_type = 1;//ga or as
      }
      $.ajax( {
        url: "<?php echo base_url() ?>engineering/autocomplete_drawing/1",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: drawing_type,
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
    console.log(document_no);
    console.log(module);
    $.ajax( {
      url: "<?php echo base_url() ?>engineering/get_data_drawing",
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
          if(module == ""){
            $("select[name=module]").val(data.module);
          }
        }
      }
    });
  }
</script>