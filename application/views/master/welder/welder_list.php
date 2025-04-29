<style>
  th,
  td {
    vertical-align: middle !important;
  }

  td:nth-child(7),
  td:nth-child(8),
  td:nth-child(10),
  td:nth-child(11),
  td:nth-child(12),
  td:nth-child(13),
  td:nth-child(14),
  td:nth-child(15),
  td:nth-child(16) {
    white-space: nowrap !important;
  }
</style>

<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div id="accordion">
          <div class="card rounded-0 shadow">
            <div class="card-header">
              <div class="row">
                <div class="col-md-6">
                  <h6 class="mt-2">Filter</h6>
                </div>
                <div class="col-md-6 text-right">
                  <button class="btn btn-sm btn-primary collapsed" data-toggle="collapse" data-target="#filter_coll" aria-expanded="false" aria-controls="filter_coll">
                    <i class="fas fa-angle-double-down"></i>
                  </button>
                </div>
              </div>
            </div>
            <div id="filter_coll" class="collapse <?= $this->input->get() ? 'show' : '' ?>" data-parent="#accordion">
              <div class="card-body">
                <form action="" method="get">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted"> Project</label>
                        <div class="col-xl">
                          <select name="project" style="width:100%" class="select2">
                            <?php foreach ($project_list as $key => $value) : ?>
															<?php if(in_array($value['id'], $this->user_cookie[13])): ?>
                              	<option value="<?= $value['id'] ?>" <?= ($this->input->get('project') == $value['id'] ? 'selected' : ($this->user_cookie[10] == $value['id'] ? 'selected' : '')) ?>><?= $value['project_name'] ?></option>
															<?php endif; ?>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted"> Company</label>
                        <div class="col-xl">
                          <select name="company" style="width:100%" class="select2">
                            <option value="">---</option>
                            <?php foreach ($company_list as $key => $value) : ?>
                              <option value="<?= $value['id_company'] ?>" <?= ($this->input->get('company') == $value['id_company'] ? 'selected' : '') ?>><?= $value['company_name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12 text-right">
                      <hr>
                      <button type="submit" name="submit" value="search" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                      <button type="submit" name="submit" value="download" class="btn btn-green-smoe text-white"><i class="fas fa-cloud-download-alt"></i> Download</button>
                    </div>

                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card rounded-0 shadow">
          <div class="card-header">
            <h6 class="m-0"> Welder Register List</h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive overflow-auto">
                  <table class="table table-hover text-center" id="table_list">
                    <thead class="bg-gray-table">
                      <th>Welder Code</th>
                      <!-- <th>Client Code</th> -->
                      <th>Company</th>
                      <th>Project</th>
                      <th>Welder Badge</th>
                      <th>Welder Name</th>
                      <!-- <th>Qualification WPS</th> -->
                      <th>Class Material</th>
                      <th>Discipline</th>
                      <th>Process</th>
                      <th>F Number</th>
                      <th>Position</th>
                      <th>Position Range</th>
                      <th>Diameter Range</th>
                      <th>Thickness Range</th>
                      <th>Backing</th>
                      <th>
                        <?php if ($this->permission_cookie[110] == '1') { ?>
                          Certificate
                        <?php } ?>
                      </th>
                      <th>Validity Start Date</th>
                      <th>Validity End Date</th>
                      <th>Status</th>
                      <th>
                        <?php if ($this->permission_cookie[114] == '1') { ?>
                        <?php } ?>
                      </th>
                      <th>QR Code</th>
                      <th>NDT of The Validity<br />(6 Months)<br />1</th>
                      <th>NDT of The Validity<br />(6 Months)<br />2</th>
                      <th>NDT of The Validity<br />(6 Months)<br />3</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


<script>
  $("#table_list").DataTable({
    order: [],
    processing: true,
    serverSide: true,
    ajax: {
      url: "<?= site_url($serverside) ?>",
      type: "POST",
      data: {
        project: "<?= $this->input->get('project') ?>",
        company_id: "<?= $this->input->get('company') ?>",
      }
    }
  })
</script>