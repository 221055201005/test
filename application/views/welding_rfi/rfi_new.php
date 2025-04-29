<div id="content" class="container-fluid">

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>

    <div class="card-body bg-white overflow-auto">
      <form action="<?php echo base_url() ?>welding_rfi/rfi_new_process" method="POST">
        <div class="row">
          <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
              <div class="col-md">
                <select class="form-control project" name="project" required>
                  <option value="">---</option>
                  <?php foreach ($project_list as $key => $value) : ?>
										<?php if(in_array($value['id'], $this->user_cookie[13])): ?>
                  		<option value="<?php echo $value['id'] ?>"><?php echo $value['project_name'] ?></option>
										<?php endif; ?>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Category</label>
              <div class="col-md">
                <select class="form-control type_of_module" name="category" required>
                  <option value="">---</option>
                  <option value="WPQT">WPQT</option>
                  <option value="WQT">WQT</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
              <div class="col-md">
                <select class="form-control" name="discipline" required>
                  <option value="">---</option>
                  <?php foreach ($discipline_list as $key => $value) : ?>
                  <option value="<?php echo $value['id'] ?>"><?php echo $value['discipline_name'] ?></option>
                  <?php endforeach; ?>
                </select> 
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Document Ref</label>
              <div class="col-md">
                <input type="text" class="form-control" name="document_ref" required>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">RFI No.</label>
              <div class="col-md">
                <input type="text" class="form-control" name="rfi_no" required>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type of Inspection</label>
              <div class="col-md">
                <input type="text" class="form-control" name="type_of_inspection" required>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Contractor</label>
              <div class="col-md">
                <input type="text" class="form-control" name="contractor" required>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Location</label>
              <div class="col-md">
                <input type="text" class="form-control" name="location" required>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Submitted Date</label>
              <div class="col-md">
                <input type="date" class="form-control" name="submit_date" required>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Inspection Date</label>
              <div class="col-md">
                <input type="date" class="form-control" name="inspection_date" required>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Remarks</label>
              <div class="col-md">
                <textarea class="form-control" name="remarks" rows="3"></textarea>
              </div>
            </div>
          </div>
          <div class="col-6">
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-right">
            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>
</div>