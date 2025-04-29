<form action="<?= site_url('mechanical_completion/send_invitation') ?>" method="post">
  <?php  ?>
  <?php error_reporting(0) ?>
  <input type="hidden" name="id" value="<?= $detail_data['id'] ?>">

  <div class="row">
    <div class="col-md-12 mt-2">
      <div class="form-group row">
        <label for="" class="col-xl-4 col-form-label text-muted">Inspector Name</label>
        <div class="col-xl">
          <select name="inspector_id" class="select2" style="width: 100%" required>
            <option value="">---</option>
            <?php foreach ($user_list as $key => $value): ?>
            <option value="<?= $value['id_user'] ?>" <?= $value['id_user']==$detail_data['inspector_id'] ? 'selected' : '' ?>><?= $value['full_name'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-12"></div>
    <div class="col-md-12">
      <div class="form-group row">
        <label for="" class="col-xl-4 col-form-label text-muted">Inspect Date</label>
        <div class="col-xl">
          <input type="date" name="inspect_date" class="form-control" value="<?= DATE('Y-m-d') ?>" required>
        </div>
      </div>
    </div>
    <div class="col-md-12"></div>
    <div class="col-md-12">
      <div class="form-group row">
        <label for="" class="col-xl-4 col-form-label text-muted">Inspect Time</label>
        <div class="col-xl">
          <input type="time" name="inspect_time" class="form-control" value="<?= DATE('H:i:s') ?>" required>
        </div>
      </div>
    </div>

    <div class="col-md-12"></div>
    <div class="col-md-12">
      <div class="form-group row">
        <label for="" class="col-xl-4 col-form-label text-muted">Inspect Location</label>
        <div class="col-xl">
          <select name="inspect_location" class="select2" style="width:100%" required>
            <option value="">---</option>
            <?php foreach ($area_list as $key => $value): ?>
            <option value="<?= $value['id'] ?>" <?= $value['id']==$detail_data['location_inspect'] ? 'selected' : '' ?>><?= $value['name'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-12"></div>
    <div class="col-md-12">
      <div class="form-group row">
        <label for="" class="col-xl-4 col-form-label text-muted">Invitation Type</label>
        <div class="col-xl">
          <select name="status_invitation" class="select2" style="width:100%" required>
            <option value="">---</option>
            <option value="1" <?= $detail_data['status_invitation']==1 ? 'selected' : '' ?>>Notification Activity</option>
            <option value="0" <?= $detail_data['status_invitation']==0 ? 'selected' : '' ?>>Invitation Witness</option>
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-12"></div>
    <div class="col-md-12">
      <div class="form-group row">
        <label for="" class="col-xl-4 col-form-label text-muted">Inspection Authority</label>
        <div class="col-xl">
          <select name="inspection_authority[]" class="select2" style="width:100%" multiple required>
            <option value="">---</option>
            <option value="1" <?= in_array(1, explode(';', $detail_data['legend_inspection_auth'])) ? 'selected' : '' ?>>Hold Point</option>
            <option value="2" <?= in_array(2, explode(';', $detail_data['legend_inspection_auth'])) ? 'selected' : '' ?>>Witness</option>
            <option value="3" <?= in_array(3, explode(';', $detail_data['legend_inspection_auth'])) ? 'selected' : '' ?>>Monitoring</option>
            <option value="4" <?= in_array(4, explode(';', $detail_data['legend_inspection_auth'])) ? 'selected' : '' ?>>Review</option>
          </select>
        </div>
      </div>
    </div>

    <div class="col-md-12"></div>

    <div class="col-md-12 text-right">
      <hr>
      <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
      <button type="submit" class="btn btn-warning"><i class="fas fa-paper-plane"></i> Send Invitation</button>
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