<div id="content" class="container-fluid">

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>

    <div class="card-body bg-white overflow-auto">
      <form action="<?php echo base_url() ?>master/phase/phase_<?php echo $module ?>_process" method="POST">
        <input type="hidden" name="id" value="<?php echo @$phase['id'] ?>">
        <div class="row">
          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Code</label>
              <div class="col-md">
                <input type="text" class="form-control" name="phase_code" value="<?php echo @$phase['phase_code'] ?>" required>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Name</label>
              <div class="col-md">
                <input type="text" class="form-control" name="phase_name" value="<?php echo @$phase['phase_name'] ?>" required>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
              <div class="col-md">
                <select class="form-control discipline" name="discipline" >
                  <option value="">---</option>
                  <?php foreach ($discipline_list as $key => $value) : ?>
                  <option value="<?php echo $value['id'] ?>" <?php echo (@$phase["discipline"] == $value['id'] ? "selected" : "") ?>><?php echo $value['discipline_name'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status</label>
              <div class="col-md">
                <select class="form-control" name="status_delete">
                  <option value="1" <?php echo (@$phase["status_delete"] == "1" ? "selected" : "") ?>>Active</option>
                  <option value="0" <?php echo (@$phase["status_delete"] == "0" ? "selected" : "") ?>>Disabled</option>
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