<!-- <div id="content"> -->
<div id="content" class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm my-3">
          <div class="card-body">
            <h6 class="card-title">Update Fitup by Excel</h6>
            <hr>
            <form action="<?= site_url('fitup/preview_update_fitup') ?>" method="post" enctype="multipart/form-data">
              <div class="row">

              <div class="col-md-12">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Drawing Number</label>
                    <div class="col-xl">
                      <select name="drawing_no" class="select2 drawing_no" style="width:100%">
                        <option value="">---</option>
                        <?php foreach ($drawing_list as $key => $value) : ?>
                          <option value="<?= $value['drawing_no'] ?>"><?= $value['drawing_no'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Template File</label>
                    <div class="col-xl">
                      <button type="button" onclick="generate_template(this)" class="btn btn-green-smoe text-white"><i class="fas fa-cloud-download-alt"></i> Template File Fit-Up Inspection</button>
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
<!-- </div> -->
</div>

<script>
  $('form').on('submit', function() {
    $('button[type=submit]').attr('disabled', true)
  })

  function generate_template(btn) {
    var drawing_no = $('.drawing_no').val()
    if (drawing_no == '') {
      Swal.fire(
        'Warning',
        'Drawing Number cannot be Empty!',
        'warning'
      );
      return
    }
    window.location.href = "<?= site_url('fitup/template_file_fitup/') ?>"+drawing_no
  }
</script>