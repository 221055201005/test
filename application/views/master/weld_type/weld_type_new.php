<div id="content" class="container-fluid">

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>

    <div class="card-body bg-white overflow-auto">
      <form action="<?php echo base_url() ?>master/weld_type/weld_type_<?php echo $module ?>_process" method="POST">
        <input type="hidden" name="id" value="<?php echo @$weld_type['id'] ?>">
        <div class="row">
          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Code</label>
              <div class="col-md">
                <input type="text" class="form-control" name="weld_type_code" value="<?php echo @$weld_type['weld_type_code'] ?>" required>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Name</label>
              <div class="col-md">
                <input type="text" class="form-control" name="weld_type" value="<?php echo @$weld_type['weld_type'] ?>" required>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status</label>
              <div class="col-md">
                <select class="form-control" name="status_delete">
                  <option value="1" <?php echo (@$weld_type["status_delete"] == "1" ? "selected" : "") ?>>Active</option>
                  <option value="0" <?php echo (@$weld_type["status_delete"] == "0" ? "selected" : "") ?>>Disabled</option>
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