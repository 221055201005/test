<form action="<?= site_url('bondstrand/proceed_add_attachment') ?>" enctype="multipart/form-data" method="post">
<input type="hidden" name="transmittal_uniqid" value="<?= $transmittal_uniqid ?>">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="" class="text-muted"> Upload File</label>
        <br>
        <input type="file" name="attachment" required>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label for="" class="text-muted"> Description</label>
        <textarea name="description" class="form-control"></textarea>
      </div>
    </div>
    <div class="col-md-12 text-right">
      <hr>
      <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
      <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Submit</button>
    </div>
  </div>
</form>

<script>
  $('form').on('submit', function() {
   $("button[type=submit]").attr('disabled', true)
  })
</script>