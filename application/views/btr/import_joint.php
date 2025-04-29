<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-header">
            <h6 class="card-title m-0">BTR - Import Joint</h6>
          </div>
          <div class="card-body">

            <form action="<?= site_url('btr/preview_import_joint') ?>" enctype="multipart/form-data" method="post">
            <input type="hidden" name="drawing_no_btr" value="<?= $drawing_no_btr ?>">
            <input type="hidden" name="uniq_id_btr" value="<?= $uniq_id_btr ?>">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Template File</label>
                    <div class="col-xl">
                      <a href="<?= base_url() ?>file/irn/Template_import_btr.xlsx" class="btn btn-success"><i class="fas fa-file-excel"></i> Template Import Joint</a>
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