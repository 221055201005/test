<form action="<?= site_url('bondstrand/proceed_request_for_update') ?>" method="post">
  <input type="hidden" name="request_by" value="<?= $user_cookie[0] ?>">
  <input type="hidden" name="submission_id" value="<?= $list['submission_id'] ?>">
  <input type="hidden" name="last_inspect_by" value="<?= $list['inspection_by'] ?>">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="">Request By</label>
        <input type="text" class="form-control" value="<?= $user_cookie[1] ?>" disabled>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label for="">Resonsible Inspector</label>
        <input type="text" class="form-control" value="<?= $inspector[0]['full_name'] ?>" disabled>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label for="">Request Reason</label>
        <textarea name="request_reason" class="form-control" required></textarea>
        <br>
        <span class="text-danger font-weight-bold">* Please Fill The Correct Reason.</span>
      </div>
    </div>
    <div class="col-md-12">
      <hr>
      <div class="float-right">
        <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
        <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Request For Update</button>
      </div>
    </div>
  </div>
</form>
<script>
  $(document).ready(function(){ 
    $('form').on('submit', function() {
      $('button[type=submit]').attr('disabled', true)
    }) 
   })
</script>