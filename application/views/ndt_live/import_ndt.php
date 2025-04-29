<?php
$lower_method   = strtolower($method);
$upload_link    = "ndt_live/preview_import_$lower_method";
$template_link  = "ndt_live/template_$lower_method";
if ($method == "RT") {
  $upload_link    = "ndt_live/ndt_rt_import_preview";
  $template_link  = "ndt_live/ndt_rt_import_template";
}
?>

<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card rounded-0 shadow">
          <div class="card-header">
            <h6 class="m-0">Import NDT <?= $method ?></h6>
          </div>
          <div class="card-body">
            <form action="<?= site_url($upload_link) ?>" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Template File</label>
                    <div class="col-xl">
                      <a href="<?= site_url($template_link) ?>" class="btn btn-success"><i class="fas fa-file-excel"></i> Template Import NDT <?= $method ?></a>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Upload Template</label>
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
                  <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Submit</button>
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