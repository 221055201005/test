<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="card-title m-0">Update Location</h6>
          </div>
          <div class="card-body bg-white">
            <form action="<?= site_url('master/location/proceed_update_location') ?>" method="post">
              <input type="hidden" name="id" value="<?= $detail['id'] ?>">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> Area</label>
                    <div class="col-xl">
                      <select class="form-control select2" name="area_v2" required>
                        <option value="">---</option>
                        <?php foreach ($area_v2_list as $key => $value) : ?>
                          <option value="<?php echo $value['id'] ?>" <?php echo (@$detail['id_area'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> Location Name</label>
                    <div class="col-xl">
                      <input type="text" name="name" class="form-control" value="<?= $detail['name'] ?>"
                        required>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted">Category</label>
                    <div class="col-xl">
                      <select class="form-control select2" name="category" required>
                        <option value="">---</option>
                        <?php foreach ($category_list as $key => $value) : ?>
                          <option value="<?php echo $key ?>" <?php echo (@$detail['id_area'] == $key ? 'selected' : '') ?>><?php echo $value ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> Status</label>
                    <div class="col-xl">
                      <select name="status_delete" class="custom-select">
                        <option value="1" <?= $detail['status_delete'] == 1 ? 'selected' : '' ?>> Active</option>
                        <option value="0" <?= $detail['status_delete'] == 0 ? 'selected' : '' ?>> Disabled</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <hr>
                  <div class="float-right">
                    <a href="<?= site_url('master/location/location_list') ?>" class="btn btn-secondary"><i
                        class="fas fa-arrow-left"></i> Back</a>
                    <?php if($this->user_cookie[7] == 1): ?>
                      <button type="submit" class="btn btn-warning"><i class="fas fa-edit"></i> Update</button>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script>
$('form').on('submit', function() {
  $('button[type=submit]').attr('disabled', true)
})
</script>