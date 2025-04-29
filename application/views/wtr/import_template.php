<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Import Joint - MWTR</h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form method="POST" action="<?php echo base_url(); ?>wtr/import_joint_preview" enctype="multipart/form-data">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Template Excel</label>
              <div class="col-xl col-form-label">
                <a target="_blank" href="<?php echo base_url(); ?>/file/irn/Template_Import_Irn.xlsx?v=<?= date("YmdHis") ?>">Template_Import_Joint.xlsx</a>
              </div>
            </div>

            <input type='hidden' name='uniq_id' value='<?= $uniq_id ?>'>
            <input type='hidden' name='drawing_no' value='<?= $drawing_no ?>'>
              

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
    </div>
  </div>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.chained.min.js"></script>
<script>
  
  $(function(){
    // $("#modulex").chained("#projectx");  
    // $("select[name=module]").chained("select[name=project]");
  });  
  $("select[name=module_joint]").chained("select[name=project_joint]");
  $('.dataTable').DataTable({
    order: [],
  })
</script>