<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h6 class="card-title"><?= $meta_title ?></h6>
            <hr>
            <form action="<?= site_url('ndt_live/ndt_rt_import_preview') ?>" method="post" enctype="multipart/form-data">
              <div class="row">

                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Template File</label>
                    <div class="col-xl">
                      <button type="button" onclick="generate_template(this)" class="btn btn-green-smoe text-white"><i class="fas fa-cloud-download-alt"></i> Template File NDT RT</button>
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
                  <button class="btn btn-primary"><i class="fas fa-cloud-upload-alt"></i> Upload</button>
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

  function generate_template(btn) {
    window.location.href = "<?= site_url('ndt_live/ndt_rt_import_template/') ?>"
  }
</script>