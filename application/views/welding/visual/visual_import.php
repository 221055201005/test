<style type="text/css">
  .blink_me {
  animation: blinker 2s linear infinite;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}
</style>
<div id="content" class="container-fluid">

   <a href="<?php echo base_url(); ?>welding_rfi/rfi_detail/<?php echo strtr($this->encryption->encrypt($rfi_id_list), '+=/', '.-~') ?>" class='btn btn-warning'><i class="fas fa-arrow-left"></i> Back</a>

  <div class="row">

    <div class="col-md-12">

      <form method="POST" action="<?php echo base_url(); ?>we_dept/visual_import_preview/<?php echo strtr($this->encryption->encrypt($rfi_id_list), '+=/', '.-~') ?>" enctype="multipart/form-data">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">Import - Visual Inspection - Fabrication Mode</h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Template Excel</label>
              <div class="col-sm-10 col-form-label">
                <a href="<?php echo base_url(); ?>file/welding/Template_Visual_Inspection_Rev00.xlsx" class='btn btn-primary'><i class="fas fa-file-excel"></i> Template_Visual_Inspection_Rev00.xlsx</a>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Upload</label>
              <div class="col-sm-10">
                <div class="custom-file">
                  <input type="file" name='file' class="custom-file-input" onChange="$('#label2.custom-file-label').html($(this).val())">
                  <label id="label2" class="custom-file-label">Choose file</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="text-right mt-3">
          <button type="submit" name='submit' id='submitBtn'  value='submit' class="btn btn-success " title="Submit">
            <i class="fa fa-check"></i> Submit
          </button>
        </div>
      </div>
      </form>
    </div>

  </div>

  
</div>
</div><!-- ini div dari sidebar yang class wrapper -->