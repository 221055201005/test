<form action="<?= site_url('visual/submit_to_client_postponereoffer') ?>" method="post">
  <?php  ?>
  <input type="hidden" name="report_no" value="<?= $report_no ?>">
  <input type="hidden" name="discipline" value="<?= $discipline ?>">
  <input type="hidden" name="module" value="<?= $module ?>">
  <input type="hidden" name="type_of_module" value="<?= $type_of_module ?>">
  <input type="hidden" name="identifier" value="<?= $identifier ?>">
  <input type="hidden" name="deck_elevation" value="<?= $deck_elevation ?>">

  <div class="row">
    <div class="col-md-12 mt-2">
      <div class="form-group row">
        <label for="" class="col-xl-4 col-form-label text-muted">Inspector Name</label>
        <div class="col-xl">
          <select name="inspector_id" class="select2" style="width: 100%" required>
            <option value="">---</option>
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

    <div class="col-md-12 d-none"></div>
    <div class="col-md-12 d-none">
      <div class="form-group row">
        <label for="" class="col-xl-4 col-form-label text-muted">Inspect Location</label>
        <div class="col-xl">
          <select name="inspect_location" class="select2" style="width:100%" >
            <?php foreach ($area_list as $key => $value): ?>
            <option value="<?= $value['id'] ?>"><?= $value['area_name'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-12 d-none"></div>
    <div class="col-md-12 d-none">
      <div class="form-group row">
        <label for="" class="col-xl-4 col-form-label text-muted">Invitation Type</label>
        <div class="col-xl">
          <select name="status_invitation" class="select2" style="width:100%" >
            <option value="1">Notification Activity</option>
            <option value="0">Invitation Witness</option>
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-12 d-none"></div>
    <div class="col-md-12 d-none">
      <div class="form-group row">
        <label for="" class="col-xl-4 col-form-label text-muted">Inspection Authority</label>
        <div class="col-xl">
          <select name="inspection_authority[]" class="select2" style="width:100%" multiple >
            <option value="0">Hold Point</option>
            <option value="1">Witness</option>
            <option value="2">Monitoring</option>
            <option value="3">Review</option>
          </select>
        </div>
      </div>
    </div>

    <div class="col-md-12"></div>
    <div class="col-md-12">
      <div class="form-group row">
        <label for="" class="col-xl-4 col-form-label text-muted">GA/AS Revision No.</label>
        <div class="col-xl">
          <select name="document_rev_no" class="form-control " style="width:100%" required onchange="changeLink(this)">
            <?php foreach ($revision_gaas as $key => $value) { ?>
              <option value="<?= $value ?>" <?= ($value==$detail_visual['rev_ga_template'] OR $value==$detail_visual['transmit_gaas_rev']) ? 'selected' : '' ?>><?= $value ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="" class="col-xl-4 col-form-label text-muted"></label>
        <div class="col-xl">
          <a href="<?= $link_revision_gaas[0]['link'] ?>" class="gaas_link"><?= $link_revision_gaas[0]['drawing_no'].' Rev. '.$link_revision_gaas[0]['revision_no'] ?></a>
        </div>
        <script type="text/javascript">
          function changeLink(thiss){
            var revi = $(thiss).val()
            console.log(revi)

            $(".gaas_link").attr("href", "<?= $link_revision_gaas[0]['link_buntung'] ?>"+revi)
            $(".gaas_link").text("<?= $link_revision_gaas[0]['drawing_no'] ?> Rev. "+revi)
          }
        </script>
      </div>
    </div>

    <div class="col-md-12"></div>
    <div class="col-md-12">
      <div class="form-group row">
        <label for="" class="col-xl-4 col-form-label text-muted">Weld Map Revision No.</label>
        <div class="col-xl">
          <select name="weld_map_rev_no" class="form-control " style="width:100%" required onchange="changeLinkWM(this)">
            <?php foreach ($revision_weldmap as $key => $value) { ?>
              <option value="<?= $value ?>" <?= ($value==$detail_visual['rev_wm_template'] OR $value==$detail_visual['transmit_wm_rev']) ? 'selected' : '' ?> ><?= $value ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="" class="col-xl-4 col-form-label text-muted"></label>
        <div class="col-xl">
          <a href="<?= $link_revision_weldmap[0]['link'] ?>" class="wm_link"><?= $link_revision_weldmap[0]['drawing_no'].' Rev. '.$link_revision_weldmap[0]['revision_no'] ?></a>
        </div>
        <script type="text/javascript">
          function changeLinkWM(thiss){
            var revi = $(thiss).val()
            console.log(revi)

            $(".wm_link").attr("href", "<?= $link_revision_weldmap[0]['link_buntung'] ?>"+revi)
            $(".wm_link").text("<?= $link_revision_weldmap[0]['drawing_no'] ?> Rev. "+revi)
          }
        </script>
      </div>
    </div>
    
              
    <div class="col-md-12"></div>
    <div class="col-md-12">
      <div class="form-group row">
        <label for="" class="col-xl-4 col-form-label text-muted">Remarks</label>
        <div class="col-xl">
          <textarea name="invitation_remarks" class="form-control"></textarea>
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