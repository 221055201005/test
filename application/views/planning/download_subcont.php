<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="<?= base_url() ?>planning/subcont_download" method="GET">
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Company ID</label>
                    <div class="col-md">
                        <select class="form-control select2" name="company_id" required>
                        <option value=""> ~ Choose ~ </option>
                        <?php foreach ($company_list as $key => $value) : ?>
                            <?php if($value['id_company'] != 1){ ?>
                                <option value="<?php echo $value['id_company'] ?>" <?php echo (@$get['company_id'] == $value['id_company'] ? 'selected' : '') ?>><?php echo $value['company_name'] ?></option>
                            <?php } ?>   
                        <?php endforeach; ?>
                        </select>
                    </div>
                    </div>
                </div>
     
                <div class="col-md-6">
                    <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project ID</label>
                    <div class="col-md">
                        <select class="form-control" name="project_id" id='project_id' required>
                        <option value=""> ~ Choose ~ </option>                        
                            <?php foreach ($project_list as $key => $value) : ?>
                                <?php if(!in_array($value['project_id'],array("4","15"))){ ?>
                                <option value="<?php echo $value['project_id'] ?>" <?php echo (@$get['project_id'] == $value['project_id'] ? 'selected' : (@$project_default == $value['project_id'] ? 'selected' : '')) ?>><?php echo $value['project_desc'] ?></option>
                                <?php } ?>    
                            <?php endforeach; ?>
                        
                        </select>
                    </div>
                    </div>
                </div>

            </div>

            <div class="row">
              <div class="col-12 text-right">
                <button class="mt-2 btn btn-sm btn-flat btn-success" name="submit" value="search"><i class="fas fa-file-excel"></i> Download</button>
              </div>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </div>

  

</div>
</div>
