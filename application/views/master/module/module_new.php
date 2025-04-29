<div id="content" class="container-fluid">

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>

    <div class="card-body bg-white overflow-auto">
      <form action="<?php echo base_url() ?>master/module/module_<?php echo $mod_method ?>_process" method="POST">
        <input type="hidden" name="mod_id" value="<?php echo @$module['mod_id'] ?>">
        <div class="row">
          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
              <div class="col-md">
                <select class="form-control" name="project_id" required>
                  <option value="">---</option>
                  <?php foreach ($project_list as $key => $value) : ?>
                  <option value="<?php echo $value['id'] ?>" <?php echo (@$module['project_id'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Name</label>
              <div class="col-md">
                <input type="text" class="form-control" name="mod_desc" value="<?php echo @$module['mod_desc'] ?>" required>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status</label>
              <div class="col-md">
                <select class="form-control" name="status_delete">
                  <option value="1" <?php echo (@$module["status_delete"] == "1" ? "selected" : "") ?>>Active</option>
                  <option value="0" <?php echo (@$module["status_delete"] == "0" ? "selected" : "") ?>>Disabled</option>
                </select> 
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-right">
            <?php if($this->permission_cookie[0] == 1): ?>
              <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Submit</button>
            <?php endif; ?>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>
</div>