<div id="content" class="container-fluid">

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>
    
    <div class="card-body bg-white overflow-auto">
      <form action="<?php echo base_url() ?>planning/job_no_register_<?php echo $method ?>_process" method="POST">
        <input type="hidden" name="id" value="<?php echo @$job_no['id'] ?>">
        
        <div class="row">
          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
              <div class="col-md">
                <select class="form-control" name="discipline">
                  <option value="">---</option>
                  <?php foreach ($discipline_list as $key => $value) : ?>
                  <option value="<?php echo $value['id'] ?>" <?php echo (@$job_no['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Deck Elevation / Service Line</label>
              <div class="col-md">
                <select class="form-control" name="deck_elevation">
                  <option value="">---</option>
                  <?php foreach ($deck_elevation_list as $key => $value) : ?>
                    <option value="<?php echo $value['id'] ?>" <?php echo (@$job_no['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Phase</label>
              <div class="col-md">
                <select class="form-control" name="phase">
                  <option value="">---</option>
                  <option value="PF" <?php echo (@$job_no['phase'] == "PF" ? 'selected' : '') ?>>Pre-Fabrication</option>
                  <option value="FB" <?php echo (@$job_no['phase'] == "FB" ? 'selected' : '') ?>>Fabrication</option>
                  <option value="AS" <?php echo (@$job_no['phase'] == "AS" ? 'selected' : '') ?>>Assembly</option>
                  <option value="ER" <?php echo (@$job_no['phase'] == "ER" ? 'selected' : '') ?>>Erection</option>
                  <option value="ITR" <?php echo (@$job_no['phase'] == "ITR" ? 'selected' : '') ?>>Inspection & Test Record</option>
                  <option value="BAA" <?php echo (@$job_no['phase'] == "BAA" ? 'selected' : '') ?>>Bondstrand Adhesive Assembly</option>
                  <option value="B&P" <?php echo (@$job_no['phase'] == "B&P" ? 'selected' : '') ?>>Blasting & Painting</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Job Number</label>
              <div class="col-md">
                <input type="text" class="form-control" name="job_no" value="<?php echo @$job_no['job_no'] ?>" required <?php echo ($method == 'update' ? 'readonly' : '')  ?>>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Description</label>
              <div class="col-md">
                <input type="text" class="form-control" name="description" value="<?php echo @$job_no['description'] ?>" required>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status</label>
              <div class="col-md">
                <select class="form-control" name="status_delete">
                  <option value="1" <?php echo (@$job_no["status_delete"] == "1" ? "selected" : "") ?>>Active</option>
                  <option value="0" <?php echo (@$job_no["status_delete"] == "0" ? "selected" : "") ?>>Disabled</option>
                </select> 
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-right">
            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>
</div>
<script>
  // $("select[name=phase]").chained("select[name=discipline]");
</script>