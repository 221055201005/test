<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-5">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h6 class="card-title">Export RFI Register</h6>
            <hr>
            <form action="<?= site_url('rfi/export_data_rfi') ?>" method="post">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="" class="text-muted">Process</label>
                    <select name="process" class="custom-select">
                      <option value="">All</option>
                      <option value="mv">Material Verification</option>
                      <option value="ft">Fitup Inspection</option>
                      <option value="vs">Visual Testing</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <input id="cb" name="history_included" value="1" type="checkbox"
                      style="width: 20px; height:20px;float: left;">
                    <div style="margin-left: 30px; line-height: 1.3;">
                      <label><i><strong>History Included</strong></i></label>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 text-right">
                  <hr>
                  <button type="submit" class="btn btn-green-smoe text-white"><i class="fas fa-cloud-download-alt"></i>
                    RFI Register</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>