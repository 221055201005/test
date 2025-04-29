<form action="<?= site_url('master/welder/proceed_update_master_data') ?>" method="post">
<input type="hidden" name="id" value="<?= $id ?>">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="" class="text-muted"> Value</label>
        <input type="text" name="value"  class="form-control" value="<?= $detail[0]['value'] ?>" required>
      </div>
    </div>
    <div class="col-md-12 text-right">
      <hr>
      <button data-dismiss="modal" class="btn btn-danger"><i class="fas fa-times"></i> Close</button>
      <button type="submit" class="btn btn-warning"><i class="fas fa-edit"></i> Update</button>
    </div>
  </div>
</form>

<script>
  $('form').on('submit', function() {
    $('button[type=submit]').attr('disabled', true)
  })
</script>