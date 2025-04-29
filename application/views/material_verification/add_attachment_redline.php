<form action="<?= site_url('material_verification/proceed_add_attachment_redline') ?>" enctype="multipart/form-data"
  method="post">
  <input type="hidden" name="submission_id" value="<?= $detail['submission_id'] ?>">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="" class="text-muted"> Drawing No</label>
        <input type="text" name="drawing_no" value="<?= $detail['drawing_no'] ?>" class="form-control" readonly>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label for="" class="text-muted"> Report No</label>
        <input type="text" name="report_no" value="<?= $detail['report_number'] ?>" class="form-control" readonly>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label for="" class="text-muted"> Revision No</label>
        <input type="text" name="postpone_reoffer_no" value="<?= $detail['report_no_rev'] ?>" class="form-control"
          readonly>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label for="" class="text-muted"> Red-Line File</label>
        <div class="custom-file">
          <input type="file" name="attach_line[]" accept="application/pdf" multiple required>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="form-group">
        <label for="" class="text-muted"> Attachment Description</label>
        <textarea name="description" class="form-control"></textarea>
      </div>
    </div>
    <div class="col-md-12 text-right">
      <hr>
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
      <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
    </div>

  </div>
</form>

<script>
$(document).ready(function() {
  $('form').on('submit', function() {
    $('button[type=submit]').attr('disabled', true)
  })
})
</script>