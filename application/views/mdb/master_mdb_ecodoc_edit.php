<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="card-title m-0"><?= $meta_title ?></h6>
          </div>
          <div class="card-body bg-white">
            <form action="<?= site_url('mdb/master_mdb_ecodoc_edit_process') ?>" method="post">
							<input type="hidden" name="id" value="<?= strtr($this->encryption->encrypt($mdb_list['id']), '+=/', '.-~') ?>" class="form-control" required>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted">Category</label>
                    <div class="col-xl">
                      <input type="text" name="category" value="<?= $mdb_list['category'] ?>" class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted">Volume</label>
                    <div class="col-xl">
                      <input type="number" name="volume" value="<?= $mdb_list['volume'] ?>" class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted">Section</label>
                    <div class="col-xl">
                      <input type="number" name="section" value="<?= $mdb_list['section'] ?>" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted">Subsection</label>
                    <div class="col-xl">
                      <input type="number" name="subsection" value="<?= $mdb_list['subsection'] ?>" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted">Description</label>
                    <div class="col-xl">
                      <input type="text" name="document_description" value="<?= $mdb_list['document_description'] ?>" class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted">Ecodoc No</label>
                    <div class="col-xl">
                      <input type="text" name="ecodoc_no" value="<?= $mdb_list['ecodoc_no'] ?>" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted">Book \ Volume</label>
                    <div class="col-xl">
                      <input type="text" name="book_volume" value="<?= $mdb_list['book_volume'] ?>" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> Status</label>
                    <div class="col-xl">
                      <select name="status_delete" class="custom-select">
                        <option value="1" <?= $mdb_list['status_delete'] == 1 ? 'selected' : '' ?>> Active</option>
                        <option value="0" <?= $mdb_list['status_delete'] == 0 ? 'selected' : '' ?>> Disabled</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <hr>
                  <div class="float-right">
                    <a href="<?= site_url('mdb/master_mdb_ecodoc_list') ?>" class="btn btn-secondary"><i
                        class="fas fa-arrow-left"></i> Back</a>
                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Submit</button>
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