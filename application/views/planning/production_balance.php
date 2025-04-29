<style>
  th,
  td {
    vertical-align: middle !important;
  }

  .btn_filter[aria-expanded=true] .fa-angle-double-down {
  display: none;
}

.btn_filter[aria-expanded=false] .fa-angle-double-up {
  display: none;
}


</style>
<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div id="accordion">
          <div class="card border-0 shadow">
            <div class="card-header">
              <button class="btn_filter btn btn-primary" data-toggle="collapse" data-target="#filter" aria-expanded="false" aria-controls="filter">Filter &nbsp; <i class="fas fa-angle-double-down"></i><i class="fas fa-angle-double-up"></i> </button>
            </div>
            <div id="filter" class="collapse <?= $this->input->post() ? 'show' : '' ?>" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">
                <form action="" method="post">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-2 col-form-label text-muted"> Discipline</label>
                        <div class="col-xl">
                          <select name="discipline" class="select2" style="width:100%">
                            <option value="">---</option>
                            <?php foreach ($discipline as $key => $value) : ?>
                              <option value="<?= $value['id'] ?>" <?= $value['id'] == $this->input->post('discipline') ? 'selected' : '' ?>>
                                <?= $value['discipline_name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-2 col-form-label text-muted"> Category</label>
                        <div class="col-xl">
                          <select name="category" class="select2" style="width:100%">
                            <option value="">---</option>
                            <?php foreach ($category as $key => $value) : ?>
                              <option value="<?= $value['id'] ?>" <?= $value['id'] == $this->input->post('category') ? 'selected' : '' ?>>
                                <?= $value['catalog_category'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-2 col-form-label text-muted"> Spec / Grade</label>
                        <div class="col-xl">
                          <select name="spec" class="select2" style="width:100%">
                            <option value="">---</option>
                            <?php foreach ($grade_list as $key => $value) : ?>
                              <option value="<?= $value['material_grade'] ?>" <?= $value['material_grade'] == $this->input->post('spec') ? 'selected' : '' ?>>
                                <?= $value['material_grade'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <!-- <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-2 col-form-label text-muted"> All Balance</label>
                        <div class="col-xl">
                          <select name="all_balance" class="select2" style="width:100%">
                            <option value="1" <?= $this->input->post('all_balance') == 1 ? 'selected' : ''; ?>>No</option>
                            <option value="2" <?= $this->input->post('all_balance') == 2 ? 'selected' : ''; ?>>Yes</option>
                          </select>
                        </div>
                      </div>
                    </div> -->



                    <div class="col-md-12 text-right">
                      <hr>
                      <button type="submit" name="submit" value="search" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                      <!-- <button type="submit" name="submit" value="download" class="btn btn-green-smoe text-white"><i class="fas fa-cloud-download-alt"></i> Download</button> -->
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
        <div class="card border-0 shadow">
          <div class="card-header">
            <h6 class="card-title m-0 font-weight-bold">Production Balance List</h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive overflow-auto">
                  <table class="cell-border hover table row-border text-center" id="table_list">
                    <thead class="bg-gray-table">
                      <tr>
                        <th rowspan="2">Project</th>
                        <th rowspan="2">Discipline</th>
                        <th rowspan="2">Unique No</th>
                        <th rowspan="2">Supply Type</th>
                        <th colspan="2">Balance</th>
                        <!-- <th colspan="2">Issued</th> -->
                        <th rowspan="2">Item Description</th>
                        <th rowspan="2">UoM</th>
                        <th rowspan="2">Category</th>
                        <th colspan="6" class="align-middle">Raw Size (In mm)</th>
                        <th rowspan="2" class="align-middle">Spec / Grade</th>
                        <th rowspan="2" class="align-middle">Spec Category</th>
                        <th rowspan="2" class="align-middle">Heat Number</th>
                        <th rowspan="2" class="align-middle">Mill Cert No</th>
                        <th rowspan="2" class="align-middle">Plate / Tag No</th>
                        <th rowspan="2" class="align-middle">MRIR No.</th>
                      </tr>
                      <tr>
                        <!-- <th class="bg-info text-nowrap">Qty (Pcs)</th> -->
                        <th>Length (mm)</th>
                        <th>Weight (Kg)</th>

                        <!-- <th class="bg-success text-nowrap">Qty (Pcs)</th> -->
                        <!-- <th>Length (mm)</th>
                        <th>Weight (Kg)</th> -->

                        <th>Length</th>
                        <th>Width</th>
                        <th>Weight</th>
                        <th>OD</th>
                        <th>Thk</th>
                        <th>Sch</th>

                      </tr>

                    </thead>
                    <tbody>
                      <?php foreach ($list as $key => $value) : ?>
                        <?php

                        $report_no = explode("/", $value['report_no'])[1];

                        ?>
                        <tr>
                          <td class="text-nowrap"><?= $project[$value['project_id']]['project_name'] ?></td>
                          <td class="text-nowrap"><?= $discipline[$value['discipline']]['discipline_name'] ?></td>
                          <td class="text-nowrap"><?= $value['unique_no'] ?></td>
                          <td class="text-nowrap"><?= $value['category'] == "CS" ? 'Client Supply' : 'SMOE Supply' ?></td>
                          <!-- <td><?= number_format($value['bal_qty'], 2) ?></td> -->
                          <td><?= number_format($value['bal_length'], 2) ?></td>
                          <td><?= number_format($value['bal_weight'], 2) ?></td>
                          <!-- <td><?= number_format($value['iss_qty'], 2) ?></td> -->
                          <!-- <td><?= number_format($value['iss_length'], 2) ?></td>
                          <td><?= number_format($value['iss_weight'], 2) ?></td> -->
                          <td><?= $value['material'] ?></td>
                          <td><?= $uom[$value['uom']] ?></td>
                          <td><?= $category[$value['catalog_category_id']]['catalog_category'] ?></td>
                          <td><?= $value['length_m'] ? $value['length_m'] : '-' ?></td>
                          <td><?= $value['width_m'] ? $value['width_m'] : '-' ?></td>
                          <td><?= $value['weight'] ? $value['weight'] : '-' ?></td>
                          <td><?= $value['od'] ? $value['od'] : '-' ?></td>
                          <td><?= $value['thk_mm'] ? $value['thk_mm'] : '-' ?></td>
                          <td><?= $value['sch'] ? $value['sch'] : '-' ?></td>
                          <td><?= $value['spec'] ?></td>
                          <td><?= $value['spec_category'] ?></td>
                          <td><?= $value['heat_or_series_no'] ?></td>
                          <td><?= $value['mill_cert_no'] ?></td>
                          <td><?= $value['plate_or_tag_no'] ? $value['plate_or_tag_no'] : '-' ?></td>
                          <td class="text-nowrap"><?= $report_no ?></td>

                        </tr>
                      <?php endforeach; ?>
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
    order: []
  })
</script>