<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="card-title m-0">Update Deck Elevation / Service Line</h6>
          </div>
          <div class="card-body bg-white">
            <form action="<?= site_url('master/deck_elevation/proceed_update_deck_elevation') ?>" method="post">
              <input type="hidden" name="id" value="<?= $detail['id'] ?>">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> Deck Elevation / Service Line Code</label>
                    <div class="col-xl">
                      <input type="text" name="code" value="<?= $detail['code'] ?>" class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> Deck Elevation / Service Line Name</label>
                    <div class="col-xl">
                      <input type="text" name="name" value="<?= $detail['name'] ?>" class="form-control" required>
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
                    <a href="<?= site_url('master/deck_elevation/deck_elevation_list') ?>" class="btn btn-secondary"><i
                    class="fas fa-arrow-left"></i> Back</a>
                    <?php if($this->permission_cookie[0] == 1): ?>
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