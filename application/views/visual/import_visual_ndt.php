<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h6 class="card-title">Import Visual & NDT Data</h6>
            <hr>
            <form action="<?= site_url('visual/preview_update_visual_ndt') ?>" method="post" enctype="multipart/form-data">
              <div class="row">

                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Drawing No</label>
                    <div class="col-xl">
                      <select name="drawing_no" class="select2" style="width:100%">
                        <option value="">---</option>
                        <?php foreach ($drawing_list as $key => $value) { ?>
                            <option value="<?= $value['drawing_no'] ?>" <?= $get['drawing_no']==$value['drawing_no'] ? 'selected' : '' ?>><?= $value['drawing_no'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Template File</label>
                    <div class="col-xl">
                      <button type="button" onclick="generate_template(this)" class="btn btn-green-smoe text-white"><i class="fas fa-cloud-download-alt"></i> Template File Visual & NDT</button>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Method</label>
                    <div class="col-xl">
                      <select name="ndt_type" class="select2" style="width:100%" required>
                        <option value="">---</option>
                        <option value="999999">Update Visual Data Only</option>
                        <?php foreach ($master_ndt_type as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>" <?= $get['ndt_type']==$value['id'] ? 'selected' : '' ?>><?= $value['ndt_description'] ?></option>
                        <?php } ?>
                      </select>
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
    let drawing_no   = $('select[name="drawing_no"]').val()
    let ndt_type   = $('select[name="ndt_type"]').val()
    if(drawing_no == ''){
      sweetalert('error', 'Drawing Not Selected');
    }
    else{
      window.location.href = "<?= site_url('visual/template_file_visual_ndt/') ?>?drawing_no=" + drawing_no + "&ndt_type=" + ndt_type;
    }
  }
</script>