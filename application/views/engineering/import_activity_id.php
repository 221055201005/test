<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Import Activity ID</h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form method="POST" action="<?php echo base_url(); ?>engineering/import_activity_id_preview" enctype="multipart/form-data">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Template Excel</label>
              <div class="col-xl col-form-label">
                <a target='_blank' href="<?php echo base_url(); ?>engineering/export_excel_process?project=12&discipline=&module=&type_of_module=&deck_elevation=&submit=piecemark">Template_Import_Piecemark.xlsx</a>
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
      <!-- <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Import Joint</h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <div class="form-group row">
            <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Template Excel</label>
            <div class="col-xl col-form-label">
              <a href="<?php echo base_url(); ?>/file/engineering/Template_Import_Joint.xlsx" download="Template_Import_Joint.xlsx">Template_Import_Joint.xlsx</a>
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
        </div>
      </div> -->
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