<style>
  a[aria-expanded=true] .fa-angle-double-down {
   display: none;
  }

  a[aria-expanded=false] .fa-angle-double-up {
    display: none;
  }
</style>
<div id="content" class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <a class="btn btn-primary" data-toggle="collapse" href="#collapseButton" role="button" aria-expanded="false" aria-controls="collapseButton">Filter &nbsp; <i class="fas fa-angle-double-down"></i><i class="fas fa-angle-double-up"></i></a>
        </div>
        <div class="collapse show" id="collapseButton">
	        <div class="card-body bg-white overflow-auto">          
	          <form action="" method="GET">
	            <div class="row">
	              <div class="col-6">
	                <div class="form-group row">
	                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
	                  <div class="col-md">
	                    <select class="form-control" name="project" required>
	                      <?php if($this->permission_cookie[0] == 1){ ?>                          
	                        <?php foreach ($project_list as $key => $value) : ?>
	                          <option value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
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
	                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status</label>
	                  <div class="col-md">
	                    <select class="form-control" name="status">
	                      <option value="">---</option>
	                      <option value="1" <?php echo (@$get['status'] == "1" ? 'selected' : '') ?>>Draft</option>
	                      <option value="2" <?php echo (@$get['status'] == "2" ? 'selected' : '') ?>>Pending Approval</option>
	                      <option value="3" <?php echo (@$get['status'] == "3" ? 'selected' : '') ?>>Issued</option>
	                      <option value="6" <?php echo (@$get['status'] == "6" ? 'selected' : '') ?>>In Progress</option>
	                      <option value="7" <?php echo (@$get['status'] == "7" ? 'selected' : '') ?>>Overdue</option>
	                      <option value="4" <?php echo (@$get['status'] == "4" ? 'selected' : '') ?>>Completed</option>
	                      <option value="5" <?php echo (@$get['status'] == "5" ? 'selected' : '') ?>>Rejected</option>
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
                <thead class="bg-gray-table">
                  <tr> 
                    <th>Workpack No.</th>
                    <th>IRN No</th>
                    <th>Phase</th> 
                    <th>Plan Start Date</th>
                    <th>Plan Finish Date</th>  
                    <th></th>
                  </tr>
                </thead>
              </table>
            </div>
            <br>
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
      "url": "<?php echo base_url();?>planning_bnp/workpack_list_datatable_bnp",
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
          // if($this->input->get('type')){
          //   echo '"type": '. $this->input->get('type').',';
          // }
          if($this->input->get('company_id')){
            echo '"company_id": '. $this->input->get('company_id').',';
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