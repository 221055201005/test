<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Import IRN</h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form method="POST" action="<?php echo base_url(); ?>irn/import_joint_preview" enctype="multipart/form-data">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Template Excel</label>
              <div class="col-xl col-form-label">
                <a target="_blank" href="<?php echo base_url(); ?>/file/irn/Template_Import_Irn.xlsx?v=<?= date("YmdHis") ?>">Template_Import_Piecemark.xlsx</a>
              </div>
            </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Project List :</label>
                    <div class="col-xl">
                       <select class="form-control project2" name="project_joint" id="project2" required="">
                        <option value="">---</option>
                          <?php if($this->permission_cookie[0] == 1){ ?>
                            <option value="">---</option>                          
                            <?php foreach ($project_chain as $key => $value) : ?>
                            <option value="<?php echo $value['id'] ?>" <?php echo (@$project_id == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                            <?php endforeach; ?>
                          <?php } else { ?>
                            <?php foreach ($project_chain as $key => $value) : ?>
                              <?php if($this->user_cookie[10] == $value['id']){ ?>
                                <option value="<?php echo $value['id'] ?>" <?php echo ($this->user_cookie[10] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                              <?php } ?>
                            <?php endforeach; ?>
                          <?php } ?>
                        </select> 
                    </div>
                  </div>
                </div>
              </div> 

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Module / Jacket List :</label>
                    <div class="col-xl">
                      <?php //test_var($module_joint) ?>
                      <select class="form-control select2class module2" name="module_joint" id="module" required>
                        <option value="">---</option>
                          <?php foreach ($module_joint as $key => $value) : ?>
                            <option onclick="save_module()" value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$get['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                          <?php endforeach; ?>
                        </select>                                        
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Type Of Module :</label>
                    <div class="col-xl">
                        <select class="form-control" name="type_of_module_joint" required>
                            <option value="">---</option>
                            <?php foreach ($type_of_module_list as $key => $value) : ?>
                                <option value="<?php echo $value['id'] ?>" <?php echo (@$post['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label">Discipline List :</label>
                    <div class="col-xl">
                      <select class="custom-select select2class" name="discipline_joint" required="" id="disciplinex" onchange="openDrawingByjoint();">
                        <?php foreach ($discipline_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" ><?php echo $value['discipline_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Upload Template</label>
              <div class="col-xl">
                <div class="custom-file">
                  <input type="file" name="file" class="custom-file-input" required>
                  <label id="label_cp" class="custom-file-label">Choose file</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-right">
                <button class="mt-2 btn btn-sm btn-flat btn-info"><i class="fas fa-upload"></i> Upload</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col">
    </div>
  </div>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.chained.min.js"></script>
<script>
  
  $(function(){
    // $("#modulex").chained("#projectx");  
    // $("select[name=module]").chained("select[name=project]");
  });  
  $("select[name=module_joint]").chained("select[name=project_joint]");
  $('.dataTable').DataTable({
    order: [],
  })
</script>