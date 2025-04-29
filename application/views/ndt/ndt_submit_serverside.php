<div id="content" class="container-fluid">

  <style type="text/css">
    .disabled-effect {
      pointer-events: none;
      opacity:0.5;
    }
  </style>

  <?php error_reporting(0) ?>
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Filter Data NDT <?= $initial ?> Document</h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="" method="GET">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Project ID</label>
                  <div class="col-xl">
                    <select class="form-control" name="project" <?= $this->permission_cookie[0]==1 ? '' : 'required' ?> id="project_js">
                      
                      <?php if($this->permission_cookie[0] == 1){ ?>   
                          <option value="">---</option>                       
                          <?php foreach ($project_list as $key => $value) : ?>
                            <option onclick="save_project()" value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                          <?php endforeach; ?>
                          <?php } else { ?>
                            <?php foreach ($project_list as $key => $value) : ?>
                              <?php if(in_array($value['id'], $this->user_cookie[13])){ ?>
                                <option onclick="save_project()" value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
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
                  <label class="col-md-4 col-lg-3 col-form-label ">Discipline</label>
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
                  <label class="col-md-4 col-lg-3 col-form-label ">Module</label>
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
                  <label class="col-md-4 col-lg-3 col-form-label ">Module Type</label>
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
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Status Inspection</label>
                  <div class="col-xl">
                    <select class="form-control" name="result">
                      <option value="">---</option>
                      <option value="3" <?= $get['result']==3 ? 'selected' : '' ?>>Accepted</option>
                      <option value="2" <?= $get['result']==2 ? 'selected' : '' ?>>Rejected</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
              </div>
            </div>
            
            <div class="row">
              <div class="col-12 text-right">
                <button class="mt-2 btn btn-sm btn-flat btn-info" name="submit" value="search"><i class="fas fa-search"></i> Search</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <?php //if(isset($get['submit'])): ?>
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">NDT <?= $initial ?> Document List</h6>
        </div>
        <div class="card-body bg-white">
          <div class="overflow-auto">
            <table class="table table-hover text-center" width="100%" id="serverSide">
              <thead class="bg-green-smoe text-white">
                <tr>
                  <th>Project</th>
                  <th>Report No.</th>
                  <th>Drawing No.</th>
                  <th>Test Package No.</th>
                  <th>Discipline</th>
                  <th>Module</th>
                  <th>Module Type</th>
                  <th>Vendor</th>
                  <th>Submit By</th>
                  <th>Inspection Date</th>
                  <th>Status Inspection</th>
                  <th>Attachment Status</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script>
  $("select[name=module]").chained("select[name=project]");

  $(document).ready(function() {
    $("#serverSide").DataTable({
      processing: true,
      serverSide: true,
      orderable: true,
      order: [],
      ajax: {
        url: "<?= site_url($serverside) ?>",
        type: "POST",
        data: {
          project : "<?= intval($get['project'])+0 ?>",
          discipline : "<?= intval($get['discipline'])+0 ?>",
          module : "<?= intval($get['module'])+0 ?>",
          type_of_module : "<?= intval($get['type_of_module'])+0 ?>",
          result : "<?= intval($get['result'])+0 ?>",
        }
      }
    })
  })
</script>