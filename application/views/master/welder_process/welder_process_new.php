<div id="content" class="container-fluid">

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>

    <div class="card-body bg-white overflow-auto">
      <form action="<?php echo base_url() ?>master/welder_process/welder_process_<?php echo $module ?>_process" method="POST">
        <input type="hidden" name="id" value="<?php echo @$welder_process['id'] ?>">
        <div class="row">
          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Code</label>
              <div class="col-md">
                <input type="text" class="form-control" name="name_process" value="<?php echo @$welder_process['name_process'] ?>" placeholder='Welder Process, Ex : SMAW' required>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status</label>
              <div class="col-md">
                <select class="form-control" name="status">
                  <option value="1" <?php echo (@$welder_process["status"] == "1" ? "selected" : "") ?>>Active</option>
                  <option value="0" <?php echo (@$welder_process["status"] == "0" ? "selected" : "") ?>>Disabled</option>
                </select> 
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-right">.
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