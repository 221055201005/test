<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h6 class="card-title">Update Ecodoc Number</h6>
            <hr>
            <form action="<?= site_url('material_verification/preview_update_ecodoc') ?>" method="post" enctype="multipart/form-data">
              <div class="row">

                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Deck Elevation / Service Line</label>
                    <div class="col-xl">
                      <select name="deck_elevation" class="select2" style="width:100%">
                        <option value="">---</option>
                        <?php foreach ($deck_list as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Template File</label>
                    <div class="col-xl">
                      <button type="button" onclick="generate_template(this)" class="btn btn-green-smoe text-white"><i class="fas fa-cloud-download-alt"></i> Template File Material Verification</button>
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
    let deck_elevation   = $('select[name="deck_elevation"]').val()
    window.location.href = "<?= site_url('material_verification/template_file_ecodoc/') ?>?deck_elevation=" + deck_elevation
  }
</script>