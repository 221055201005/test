<style>
  th,
  td {
    vertical-align: middle !important;
  }

  a[aria-expanded=true] .fa-angle-double-down {
   display: none;
  }

  a[aria-expanded=false] .fa-angle-double-up {
    display: none;
  }
</style>

<div id="content">
  <div class="container-fluid">
    <div class="row">

    	<div class="col">
	      <div class="card shadow my-3 rounded tab-filter">
	        <div class="card-header">
	          <a class="btn btn-primary" data-toggle="collapse" href="#collapseButton" role="button" aria-expanded="false" aria-controls="collapseButton">Filter &nbsp; <i class="fas fa-angle-double-down"></i><i class="fas fa-angle-double-up"></i></a>
	        </div>
	        <div class="collapse show" id="collapseButton">
	          <div class="card-body bg-white overflow-auto">
	            <form action="" method="GET">
	              <div class="row">
	                <?php error_reporting(0) ?>

	                <div class="col-6">
	                  <div class="form-group row">
	                    <label class="col-md-4 col-lg-3 col-form-label text-muted ">Project ID</label>
	                    <div class="col-xl">
	                      <select class="form-control" name="project" id="project_js">
	                        <?php if($this->permission_cookie[0] == 1){ ?>
	                          <option value="">---</option>                       
	                          <?php foreach ($project_list as $key => $value) : ?>
	                          <option value="<?php echo $value['id'] ?>" <?= (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?= $value['project_name'] ?></option>
	                          <?php endforeach; ?>
	                        <?php } else { ?>
	                          <?php foreach ($project_list as $key => $value) : ?>
	                            <?php if(in_array($value['id'], $this->user_cookie[13])){ ?>
	                              <option value="<?= $value['id'] ?>" <?= (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?= $value['project_name'] ?></option>
	                            <?php } ?>
	                          <?php endforeach; ?>
	                        <?php } ?>
	                      </select>
	                      <script type="text/javascript">
	                        var project_js
	                        function save_project(){
	                          project_js = $('#project_js').val()
	                          console.log(project_js)
	                        }
	                      </script>
	                    </div>
	                  </div>
	                </div>
	                <div class="col-6">
	                  <div class="form-group row">
	                    <label class="col-md-4 col-lg-3 col-form-label text-muted ">Discipline</label>
	                    <div class="col-xl">
	                      <select class="form-control" name="discipline" id="discipline_js">
	                        <option value="">---</option>
	                        <?php foreach ($discipline_list as $key => $value) : ?>
	                        <option onclick="save_discipline()" value="<?php echo $value['id'] ?>" <?php echo (@$get['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
	                        <?php endforeach; ?>
	                      </select>
	                      <script type="text/javascript">
	                        var discipline_js
	                        function save_discipline(){
	                          discipline_js = $('#discipline_js').val()
	                          console.log(discipline_js)
	                        }
	                      </script>
	                    </div>
	                  </div>
	                </div>
	              </div>

	              <div class="row">
	                <div class="col-6">
	                  <div class="form-group row">
	                    <label class="col-md-4 col-lg-3 col-form-label text-muted ">Module</label>
	                    <div class="col-xl">
	                      <select class="form-control" name="module" id="module_js">
	                        <option value="">---</option>
	                        <?php foreach ($module_list as $key => $value) : ?>

	                        <option onclick="save_module()" value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$get['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
	                        <?php endforeach; ?>
	                      </select>
	                      <script type="text/javascript">
	                        var module_js
	                        function save_module(){
	                          module_js = $('#module_js').val()
	                          console.log(module_js)
	                        }
	                      </script>
	                    </div>
	                  </div>
	                </div>

	                <div class="col-6">
	                  <div class="form-group row">
	                    <label class="col-md-4 col-lg-3 col-form-label text-muted ">Type of Module</label>
	                    <div class="col-xl">
	                      <select class="form-control" name="type_of_module">
	                        <option value="">---</option>
	                        <?php foreach ($type_of_module_list as $key => $value) : ?>
	                        <option onclick="save_type_module()" value="<?php echo $value['id'] ?>" <?php echo (@$get['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
	                        <?php endforeach; ?>
	                      </select>
	                      <script type="text/javascript">
	                        var type_module_js
	                        function save_type_module(){
	                          type_module_js = $('#type_module_js').val()
	                          console.log(type_module_js)
	                        }
	                      </script>
	                    </div>
	                  </div>
	                </div>

	                <div class="col-6">
		                <div class="form-group row">
		                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Drawing Number</label>
		                  <div class="col-xl">
		                    <select class="form-control select2" name="drawing_no">
		                      <option value="">---</option>
		                      <?php foreach ($drawing_list as $key => $value) { ?>
		                        <option value="<?= $value['drawing_no'] ?>" <?= $get['drawing_no']==$value['drawing_no'] ? 'selected' : '' ?>><?= $value['drawing_no'] ?></option>
		                      <?php } ?>
		                    </select>
		                    <span style="color:red;font-weight: bold;font-style: italic;">Please choice Drawing Number for Submit Data</span>
		                  </div>
		                </div>
		              </div>

	                <div class="col-12 text-right">
	                  <hr>
	                  <button class="mt-2 btn btn-sm btn-flat btn-info" name="submit" value="search"><i class="fas fa-search"></i> Search</button>
	                </div>
	              </div>
	            </form>
	          </div>
	        </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="card rounded-0 shadow my-3">
          <div class="card-header">
            <h6 class="m-0"> Pending RFI List - <strong><?= $method ?></strong></h6>
          </div>
          <div class="card-body">
            <form method="POST" action="<?= base_url("ndt_live/submit_ndt") ?>">
            	<div class="form-group">
            		<div class="form-group row">
                  <label class="col-md-1 col-form-label font-weight-bold">Report No.</label>
                  <div class="col-md-4">
                  	<input type="text" class="form-control" name="report_no" placeholder="Ex. CHW-SMO-D1-PWHT-000001" required>
                  	<input type="hidden" name="ndt_type" value="<?= $method ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-1 col-form-label font-weight-bold">Date of Inspection</label>
                  <div class="col-md-2">
                  	<input type="date" class="form-control" name="date_of_inspection" required>
                  </div>
                  <div class="col-md-2">
                  	<input type="time" class="form-control" name="time_of_inspection" required>
                  </div>
                </div>
            	</div>
            	<br>
	            <div class="row">
	              <div class="col-md-12">
	                <div class="table-responsive overflow-auto">
	                  <table class="table table-hover text-center" style="width:100%" id="table_list">
	                    <thead class="bg-gray-table">
	                      <th>Project</th>
	                      <th>Yard</th>
	                      <th>Discipline</th>
	                      <th>Module</th>
	                      <th>Type of Module</th>
	                      <th>RFI No</th>
	                      <th>Drawing No.</th>
	                      <th>Drawing Weld Map No.</th>
	                      <th>Joint No.</th>

	                      <th>Vendor</th>
						  <?php if ($user_permission[208] == 1 && $main['status_inspection'] != 12) { ?>
							<th></th>
						  <?php } ?>
	                    </thead>
	                    <tbody>

	                    </tbody>
	                  </table>
	                </div>
	              </div>
	            </div>
	            <?php if($get['drawing_no']){ ?>
	            	<br>
			          <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Submit</button>
			        <?php } ?>
	        	</form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script>
	$("select[name=module]").chained("select[name=project]");
  $("#table_list").DataTable({
    order : [],
    processing : true,
    serverSide : true,
    <?php if($get['drawing_no']){ ?>
	    paging: false,
	  <?php } ?>
    ajax : {
      url : "<?= site_url($serverside) ?>",
      type : "POST",
      data : {
        method : "<?= $method ?>",

        project 		: "<?= $get['project'] ? $get['project'] : NULL ?>",
        discipline 		: "<?= $get['discipline'] ? $get['discipline'] : NULL ?>",
        module 			: "<?= $get['module'] ? $get['module'] : NULL ?>",
        type_of_module 	: "<?= $get['type_of_module'] ? $get['type_of_module'] : NULL ?>",
        drawing_no 		: "<?= $get['drawing_no'] ? $get['drawing_no'] : NULL ?>",
      }
    }
  })
</script>

<script>
	function void_row_db(btn) {
		let method = `<?= $method ?>`;
		var id_joint = $(btn).data(`id-joint`);
		var uniq_id_rfi = $(btn).data(`id-uniq-rfi`);

		$.ajax({
			url: "<?php echo base_url() ?>ndt_live/void_ndt_rfi",
			data: {
				id_joint,
				uniq_id_rfi,
				method,
			},
			type: 'post',
			success: function(data) {
				if (data.includes('Error')) {
					sweetalert("error", data);
				} else {
					sweetalert("success", "Void Data Success!");

					setTimeout(() => {
						location.reload()
					}, 1000);
				}
			},
			error: function(xhr, status, error) {
				sweetalert("error", "An error occurred: " + error);
			}
		});
	}
</script>