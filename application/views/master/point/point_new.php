<div id="content" class="container-fluid">

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>

    <div class="card-body bg-white overflow-auto">
      <form action="<?php echo base_url() ?>master/point/point_<?php echo $module ?>_process" method="POST">
        <input type="hidden" name="id" value="<?php echo @$point['id'] ?>">
        <div class="row">
          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Area</label>
              <div class="col-md">
                <select class="form-control select2" name="area_v2" required>
                  <option value="">---</option>
                  <?php foreach ($area_v2_list as $key => $value) : ?>
                    <option value="<?php echo $value['id'] ?>" <?php echo (@$location_v2_list[$point['id_location']]['id_area'] == $value['id'] ? 'selected' : (@$this->input->get('area_v2') == $value['id'] ? 'selected' : '')) ?>><?php echo $value['name'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Location</label>
              <div class="col-md">
                <select class="form-control select2" name="location_v2" required>
                  <option value="">---</option>
                  <?php foreach ($location_v2_list as $key => $value) : ?>
                    <option value="<?php echo $value['id'] ?>" <?php echo (@$point['id_location'] == $value['id'] ? 'selected' : (@$this->input->get('location_v2') == $value['id'] ? 'selected' : '')) ?> data-chained="<?php echo $value['id_area'] ?>"><?php echo $value['name'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Name</label>
              <div class="col-md">
                <input type="text" class="form-control" name="name" value="<?php echo @$point['name'] ?>" required>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status</label>
              <div class="col-md">
                <select class="form-control" name="status_delete">
                  <option value="1" <?php echo (@$point["status_delete"] == "1" ? "selected" : "") ?>>Active</option>
                  <option value="0" <?php echo (@$point["status_delete"] == "0" ? "selected" : "") ?>>Disabled</option>
                </select> 
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-right">
            <?php if($this->user_cookie[7] == 1): ?>
              <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Submit</button>
            <?php endif; ?>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>
</div>
<script>
  $(document).ready(function() {
    $("select[name=location_v2]").chained("select[name=area_v2]");
  })
</script>