<form id="form_rfi" method="POST" action="<?php echo base_url() ?>mechanical_completion/mechanical_completion_rfi_resubmit_process/" enctype="multipart/form-data">
  <?php error_reporting(0) ?>
  <div class="row">
    
    <div class="card-body bg-white">

      <input type="hidden" name="id_mc" value="<?php echo strtr($this->encryption->encrypt($detail_data['id_mc']), '+=/', '.-~') ?>">
      <input type="hidden" name="resubmit_id" value="<?php echo strtr($this->encryption->encrypt($detail_data['id']), '+=/', '.-~') ?>">

      <div class="row">
        <div class="col-md-6">
          <div class="form-group row">
            <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">RFI No</label>
            <div class="col-xl">
              <input type="text" class="form-control" name="rfi_no" value="" required>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group row">
            <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">RFI Category</label>
            <div class="col-xl">
              <select class="form-control" name="rfi_category">
                <option value="PMT">PMT</option>
              </select>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group row">
            <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">RFI Status</label>
            <div class="col-xl">
              <select class="form-control" name="rfi_status">
                <option value="1" data-chained="PMT">Submit to QC</option>
              </select>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group row">
            <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">RFI Attachment</label>
            <div class="col-xl">
              <div class="custom-file">
                <input type="file" name="attachment_file" class="custom-file-input" required>
                <label id="label_cp" class="custom-file-label">Choose file</label>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group row">
            <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Remarks</label>
            <div class="col-xl">
              <textarea name="remarks" class="form-control"></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12 text-right">
      <hr>
      <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
      <button type="submit" class="btn btn-info"><i class="fas fa-plus"></i> Create</button>
    </div>
  </div>
</form>

<script>
  $('.select2').select2({
    theme : 'bootstrap'
  })
$(document).ready(function() {
  $('form').on('submit', function() {
    $('button[type=submit]').attr('disabled', true)
  })
})
</script>