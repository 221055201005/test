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
              <!-- <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status</label>
                  <div class="col-md">
										<select class="form-control" name="status_foreman">
                      <option value="1" <?php echo (@$get['status_foreman'] == "1" ? 'selected' : '') ?>>Booked by Me</option>
                      <option value="2" <?php echo (@$get['status_foreman'] == "2" ? 'selected' : '') ?>>Not Booked</option>
                    </select>
                  </div>
                </div>
              </div> -->
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

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
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
        </div>
      </div>
    </div>
  </div>

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
          "status_foreman" : 1,
          "type" : <?php echo (@$type == '' ? 1 : $type) ?>,
				<?php 
					if($get['submit']){
						echo '"submit": "'. $get['submit'].'",';
						if($get['project']){
							echo '"project": '. $get['project'].',';
						}
						// if($get['status_foreman']){
						// 	echo '"status_foreman": '. $get['status_foreman'].',';
						// }
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