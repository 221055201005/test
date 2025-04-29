<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Import Piecemark</h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form method="POST" action="<?php echo base_url(); ?>engineering/import_piecemark_preview" enctype="multipart/form-data">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Template Excel</label>
              <div class="col-xl col-form-label">
                <a target="_blank" href="<?php echo base_url(); ?>/file/engineering/Template_Import_Piecemark.xlsx?v=<?= date("YmdHis") ?>">Template_Import_Piecemark.xlsx</a>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Upload Template</label>
              <div class="col-xl">
                <div class="custom-file">
                  <input type="file" name="file" class="custom-file-input" required>
                  <label id="label_cp" class="custom-file-label">Choose file</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-right">
                <button class="mt-2 btn btn-sm btn-flat btn-info"><i class="fas fa-upload"></i> Upload</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col">
      <?php if (in_array(21, $this->user_cookie[13]) || $this->user_cookie[11] == 5) : ?>
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Import Joint</h6>
          </div>
          <div class="card-body bg-white overflow-auto">
            <form method="POST" action="<?php echo base_url(); ?>engineering/import_joint_preview" enctype="multipart/form-data">
              <div class="form-group row">
                <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Template Excel</label>
                <div class="col-xl col-form-label">
                  <a href="<?php echo base_url(); ?>/file/engineering/Template_Import_Joint.xlsx?v=<?= date("YmdHis") ?>" download="Template_Import_Joint.xlsx">Template_Import_Joint.xlsx</a>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Upload Template</label>
                <div class="col-xl">
                  <div class="custom-file">
                    <input type="file" name="file" class="custom-file-input" required>
                    <label id="label_cp" class="custom-file-label">Choose file</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 text-right">
                  <button class="mt-2 btn btn-sm btn-flat btn-info"><i class="fas fa-upload"></i> Upload</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      <?php endif ?>
    </div>
  </div>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script>
  $("select[name=module]").chained("select[name=project]");

  $('.dataTable').DataTable({
    order: [],
  })
</script>