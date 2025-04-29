<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-header">
            <h6 class="card-title m-0">MTS - Import Piecemark</h6>
          </div>
          <div class="card-body">

            <form action="<?= site_url('mts/preview_import_mts') ?>" enctype="multipart/form-data" method="post">
            <input type="hidden" name="drawing_no_mts" value="<?= $drawing_no_mts ?>">
            <input type="hidden" name="uniq_id_mts" value="<?= $uniq_id_mts ?>">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Template File</label>
                    <div class="col-xl">
                      <a href="<?= site_url('mts/template_import_mts') ?>" class="btn btn-success"><i class="fas fa-file-excel"></i> Template Import Piecemark MTS</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Upload File</label>
                    <div class="col-xl">
                      <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" required>
                        <label id="label_cp" class="custom-file-label">Choose file</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 text-right">
                  <hr>
                  <button type="submit" class="btn btn-primary"><i class="fas fa-cloud-upload-alt"></i> Upload</button>
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