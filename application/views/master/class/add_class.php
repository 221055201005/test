<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="card-title m-0">Add New Class</h6>
          </div>
          <div class="card-body bg-white">
            <form action="<?= site_url('master/class_data/proceed_add_class') ?>" method="post">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> Class Code</label>
                    <div class="col-xl">
                      <input type="text" name="class_code" class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> Class Name</label>
                    <div class="col-xl">
                      <input type="text" name="class_name" class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <hr>
                  <div class="float-right">
                    <a href="<?= site_url('master/class_data/class_list') ?>" class="btn btn-secondary"><i
                        class="fas fa-arrow-left"></i> Back</a>
                    <?php if($this->permission_cookie[0] == 1): ?>
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