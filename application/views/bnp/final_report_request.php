<form method="POST" action="<?= base_url('planning_bnp/transmitt_request_final_report') ?>">
  <div class="form-group">
    <?php error_reporting(0) ?>
    <div class="row">
      <div class="col-md-12">
        <strong><i>Inspection Detail</i></strong>
      </div>
      <div class="col-md-12"><br></div>

      <div class="col-md-6">
        <div class="form-group row">
          <label for="" class="col-xl-3 col-form-label text-muted"><b>Trace Code</b></label>
          <div class="col-xl">
            <input type="text" name="report_number" class="form-control" <?= $disabled ?> required value="<?= $main[0]['report_number'] ?>">
            <input type="hidden" name="request_no" value="<?= $bnp[0]['request_no'] ?>">
            <input type="hidden" name="id_paint_system" value="<?= $bnp[0]['id_paint_system'] ?>">
            <input type="hidden" name="id_activity" value="<?= $bnp[0]['id_activity'] ?>">
          </div>
        </div>
      </div>
      <div class="col-md-12"><hr></div>

      <div class="col-md-6 mt-2">
        <div class="form-group row">
          <label for="" class="col-xl-3 col-form-label text-muted">Inspector Name</label>
          <div class="col-xl">
            <select name="inspector_id" class="form-control select2" style="width: 100%" required <?= $disabled ?>>
              <option value="">---</option>
              <?php foreach ($user_list as $key => $value) : ?>
                <option value="<?= $value['id_user'] ?>"><?= $value['full_name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </div>

      <div class="col-md-6 mt-2">
        <div class="form-group row">
          <label for="" class="col-xl-3 col-form-label text-muted">Company Assigned</label>
          <div class="col-xl">
            <select name="id_vendor" class="form-control select2" style="width: 100%" required <?= $disabled ?>>
              <option value="">---</option>
              <?php foreach ($company_list as $key => $value) : ?>
                <option value="<?= $value['id_company'] ?>" <?= $value['id_company']==$main[0]['id_vendor'] ? 'selected' : '' ?>><?= $value['company_name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group row">
          <label for="" class="col-xl-3 col-form-label text-muted">Submitted Date</label>
          <div class="col-xl">
            <input type="date" name="submitted_date" class="form-control" <?= $disabled ?> required value="<?= $main[0]['submitted_date'] ? DATE('Y-m-d', strtotime($main[0]['submitted_date'])) : '' ?>">
          </div>
        </div>
      </div>
      
      <div class="col-md-6">
        <div class="form-group row">
          <label for="" class="col-xl-3 col-form-label text-muted">Inspect Date from</label>
          <div class="col-xl">
            <input type="date" name="inspection_date" class="form-control" required <?= $disabled ?> value="<?= $main[0]['inspection_date'] ? DATE('Y-m-d', strtotime($main[0]['inspection_date'])) : '' ?>">
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group row">
          <label for="" class="col-xl-3 col-form-label text-muted">Inspect Date to</label>
          <div class="col-xl">
            <input type="date" name="inspection_date_to" class="form-control" required <?= $disabled ?> value="<?= $main[0]['inspection_date_to'] ? DATE('Y-m-d', strtotime($main[0]['inspection_date_to'])) : '' ?>">
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group row">
          <label for="" class="col-xl-3 col-form-label text-muted">Inspect Area</label>
          <div class="col-xl">
            <select class="select2 will_enable" name="area" <?= $disabled ?>>
              <option value="">---</option>
              <?php foreach ($area_v2 as $value_area) {?>
                <option value="<?= $value_area['id'] ?>" <?= $value_area['id']==$main[0]['area'] ? 'selected' : '' ?>><?= $value_area['name'] ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group row">
          <label for="" class="col-xl-3 col-form-label text-muted">Inspect Location</label>
          <div class="col-xl">
            <select class="select2 will_enable" name="location[]" multiple="" <?= $disabled ?>>
              <option value="">---</option>
              <?php foreach ($location_v2 as $value_location) {?>
                <option value="<?= $value_location['id'] ?>" data-chained="<?php echo $value_location['id_area'] ?>" <?= in_array($value_location['id'], explode(';', $main[0]['location'])) ? 'selected' : '' ?>><?= $value_location['name'] ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        $("select[name=location]").chained("select[name=area]");
      </script>
      
      <div class="col-md-6">
        <div class="form-group row">
          <label for="" class="col-xl-3 col-form-label text-muted">Inspect Qty</label>
          <div class="col-xl">
            <input type="text" name="qty" class="form-control" <?= $disabled ?> required value="<?= $main[0]['qty'] ?>">
          </div>
        </div>
      </div>

      <div class="col-md-12"><hr></div>
      <div class="col-md-6">
        <div class="form-group row">
          <label for="" class="col-xl-3 col-form-label text-muted">Expected Time</label>
          <div class="col-xl">
            <input type='text' class='form-control' name="expected_time" value="<?= $rfi_detail[0]['expected_time'] ?>">
          </div>
        </div>
      </div> 

      <div class="col-md-6">
        <div class="form-group row">
          <label for="" class="col-xl-3 col-form-label text-muted">ITP Intervention to Employer</label>
          <div class="col-xl">
            <select class="form-control select2" style="width:100%" name="itp[]" multiple="">
              <option value="1" <?= in_array(1, explode(';', $rfi_detail[0]['itp'])) ? 'selected' : '' ?>>Hold Point</option>
              <option value="2" <?= in_array(2, explode(';', $rfi_detail[0]['itp'])) ? 'selected' : '' ?>>Witness</option>
              <option value="3" <?= in_array(3, explode(';', $rfi_detail[0]['itp'])) ? 'selected' : '' ?>>Monitoring</option>
              <option value="4" <?= in_array(4, explode(';', $rfi_detail[0]['itp'])) ? 'selected' : '' ?>>Review</option>
            </select>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group row">
          <label for="" class="col-xl-3 col-form-label text-muted">Result</label>
          <div class="col-xl">
            <input type='text' class='form-control' name="result" value="<?= $rfi_detail[0]['result'] ?>">
          </div>
        </div>
      </div> 

      <div class="col-md-6 ">
        <div class="form-group row">
          <label for="" class="col-xl-3 col-form-label text-muted">Tag Description</label>
          <div class="col-xl">
            <textarea class='form-control' name="tag_description_pickling"><?= $rfi_detail[0]['tag_description'] ?></textarea>
            <small><i><strong>*Fill this Column for Item/Tag Description</strong></i></small>
          </div>
        </div>
      </div>

      <?php $paint_detail =$master_activity[$main[0]['id_paint_system']][$main[0]['id_activity']] ?>
      <div class="col-md-6 ">
        <div class="form-group row">
          <label for="" class="col-xl-3 col-form-label text-muted">Paint Product</label>
          <div class="col-xl">
            <input type="text" class="form-control special" name="special_product" value="<?= $main[0]['special']==0 ? $paint_detail['paint_product'] : $main[0]['special_product'] ?>" <?= $main[0]['special']==0 ? 'disabled' : '' ?>>
          </div>
        </div>
        <!-- <br> -->
        <input type="checkbox" name="special" value="1" onclick="checkCheck(this)" <?= $main[0]['special']==0 ? '' : 'checked' ?>><small><i><strong>*Tick if Using Special Paint</strong></i></small>
        <script type="text/javascript">
          function checkCheck(ini){
            var value = $(ini)
            console.log($(value)[0].checked);
            if($(value)[0].checked==true){
              $('.special').attr("disabled", false)
            } else {
              $('.special').attr("disabled", true)
            }
          }
        </script>
      </div>

      <div class="col-md-6 ">
        <div class="form-group row">
          <label for="" class="col-xl-3 col-form-label text-muted">Paint Color</label>
          <div class="col-xl">
            <input type="text" class="form-control special" name="special_color" value="<?= $main[0]['special']==0 ? $paint_detail['color'] : $main[0]['special_color'] ?>" <?= $main[0]['special']==0 ? 'disabled' : '' ?>>
          </div>
        </div>
      </div>

      <div class="col-md-12 ">
        <div class="form-group row">
          <!-- <label for="" class="col-xl-3 col-form-label text-muted"> </label> -->
          <div class="col-xl">
            <hr>
            <button class="btn btn-success" type="submit">Submit</button>
          </div>
        </div>
      </div>

      <script type="text/javascript">
        $('select.select2').select2({
          theme: 'bootstrap'
        });

        $('.select2-multiple').select2({
          allowClear: true,
          tokenSeparators: [', ', ' '],
          multiple: true,
          // selectOnClose: true,
          placeholder: 'select..'
        })
      </script>

    </div>
  </div>
</form>