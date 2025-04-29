<form action="<?= site_url('material_verification/proceed_re_transmit_data') ?>" method="post">
  <input type="hidden" name="report_no" value="<?= $report_no ?>">
  <input type="hidden" name="discipline" value="<?= $discipline ?>">
  <input type="hidden" name="module" value="<?= $module ?>">
  <input type="hidden" name="type_of_module" value="<?= $type_of_module ?>">
  <input type="hidden" name="project_code" value="<?= $project_code ?>">
  <input type="hidden" name="status_inspection" value="<?= $status_inspection ?>">
  <div class="row">
    <div class="col-md-12 mt-2">
      <div class="form-group row">
        <label for="" class="col-xl-4 col-form-label text-muted">Inspector Name</label>
        <div class="col-xl">
          <select name="inspector_id" class="select2" style="width: 100%">
            <option value="0">---</option>
            <?php foreach ($user_list as $key => $value): ?>
            <option value="<?= $value['id_user'] ?>"><?= $value['full_name'] ?></option>
            <?php endforeach; ?>
          </select>
          <!-- <input type="text" name="inspector_id" class="form-control" onfocus="autocomplete_inspector(this)"  required> -->
        </div>
      </div>
    </div>
    <div class="col-md-12"></div>
    <div class="col-md-12">
      <div class="form-group row">
        <label for="" class="col-xl-4 col-form-label text-muted">Inspect Date</label>
        <div class="col-xl">
          <input type="date" name="inspect_date" class="form-control" value="<?= date('Y-m-d') ?>" required>
        </div>
      </div>
    </div>
    <div class="col-md-12"></div>
    <div class="col-md-12">
      <div class="form-group row">
        <label for="" class="col-xl-4 col-form-label text-muted">Inspect Time</label>
        <div class="col-xl">
          <input type="time" name="inspect_time" class="form-control" value="<?= date('H:i:s') ?>" required>
        </div>
      </div>
    </div>
    <div class="col-md-12"></div>
    <div class="col-md-12">
      <div class="form-group row">
        <label for="" class="col-xl-4 col-form-label text-muted">Inspect Location</label>
        <div class="col-xl">
          <select name="inspect_location" class="select2" style="width:100%" required>
            <?php foreach ($area_list as $key => $value): ?>
            <option value="<?= $value['id'] ?>"><?= $value['area_name'] ?></option>
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
            <option value="1">Notification Activity</option>
            <option value="0">Invitation Witness</option>
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
            <option value="0">Hold Point</option>
            <option value="1">Witness</option>
            <option value="2">Monitoring</option>
            <option value="3">Review</option>
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-12 text-right">
      <hr>
      <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
      <button type="submit" class="btn btn-warning"><i class="fas fa-paper-plane"></i> Re - Transmit</button>
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