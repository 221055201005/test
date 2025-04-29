<?php 
  $list = $list[0];
  // test_var($list);
?>
<form action="<?= site_url('itr/proceed_add_attachment_nde') ?>" enctype="multipart/form-data"
  method="post">
  <input type="hidden" name="ndt_itr_id" value="<?= $ndt_itr_id ?>">
  <input type="hidden" name="ndt_type" value="<?= $list['ndt_type'] ?>">
  <input type="hidden" name="discipline" value="<?= $detail['discipline'] ?>">
  <input type="hidden" name="module" value="<?= $detail['module'] ?>">
  <input type="hidden" name="type_of_module" value="<?= $detail['type_of_module'] ?>">
  <input type="hidden" name="submission_id" value="<?= $detail['transmittal_uniqid'] ?>">
  <input type="hidden" name="ndt_itr_rfi_no" value="<?= $list['ndt_rfi_no'] ?>">
  <input type="hidden" name="itr_status" value="1">
  <div class="row">

  <div class="col-md-12">
      <div class="form-group">
        <label for="" class="text-muted"> NDT Report Number</label>
        <input type="text" name="ndt_report_number" class="form-control" required>
      </div>
    </div>
    
    <div class="col-md-12">
      <div class="form-group">
        <label for="" class="text-muted"> NDT Result</label>
        <select class="select2" style="width:100%" name="ndt_itr_status" required>
          <option value="">---</option>
          <option value="3">Accepted</option>
          <option value="2">Rejected</option>
        </select>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label for="" class="text-muted"> Drawing No</label>
        <input type="text" name="drawing_no" value="<?= $detail['drawing_no'] ?>" class="form-control" disabled>
      </div>
    </div>
    <div class="col-md-12 d-none">
      <div class="form-group">
        <label for="" class="text-muted"> Report No</label>
        <input type="text" name="report_number" value="<?= $detail['report_number'] ?>" class="form-control"
          readonly>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label for="" class="text-muted"> NDT File</label>
        <div class="custom-file">
          <input type="file" name="attach_line[]" accept="application/pdf" required>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="form-group">
        <label for="" class="text-muted"> Attachment Remarks</label>
        <textarea name="remarks" class="form-control"></textarea>
      </div>
    </div>
    <div class="col-md-12 text-right">
      <hr>
      <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
      
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