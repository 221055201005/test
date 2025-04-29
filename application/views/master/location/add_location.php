<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="card-title m-0">Add New Location</h6>
          </div>
          <div class="card-body bg-white">
            <form action="<?= site_url('master/location/proceed_add_location') ?>" method="post">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted">Area</label>
                    <div class="col-xl">
                      <select class="form-control select2" name="area_v2" required>
                        <option value="">---</option>
                        <?php foreach ($area_v2_list as $key => $value) : ?>
                          <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted">Location Name</label>
                    <div class="col-xl">
                      <input type="text" name="name" class="form-control" required>
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
                          <option value="<?php echo $key ?>"><?php echo $value ?></option>
                        <?php endforeach; ?>
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
                      <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Submit</button>
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