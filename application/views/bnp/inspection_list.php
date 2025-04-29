<style>
  th,
  td {
    vertical-align: middle !important;
  }
</style>
<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow">
          <div class="card-header">
            <h6 class="card-title m-0">Filter</h6>
          </div>
          <div class="card-body">
            <form action="" method="get">
              <div class="row">

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-2 col-form-label text-muted"> Discipline</label>
                    <div class="col-xl">
                      <select name="id_discipline" class="select2" style="width:100%">
                        <option value="">---</option>
                        <?php foreach ($discipline_list as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == @$get['id_discipline'] ? 'selected' : '' ?>><?= $value['discipline_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-2 col-form-label text-muted"> Paint System</label>
                    <div class="col-xl">
                      <select name="id_paint_system" class="select2" style="width:100%">
                        <option value="">---</option>
                        <?php foreach ($paint_system_list as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == @$get['id_paint_system'] ? 'selected' : '' ?>><?= $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-2 col-form-label text-muted"> Project</label>
                    <div class="col-xl">
                      <select name="project_id" class="select2" style="width:100%" >
                        <option value="">---</option>
                        <?php foreach ($project_list as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $this->input->get('project_id') ? 'selected' : '' ?>><?= $value['project_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-2 col-form-label text-muted"> Paint System</label>
                    <div class="col-xl">
                      <select name="id_paint_system" class="select2" style="width:100%" >
                        <option value="">---</option>
                        <?php foreach ($paint_system as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $this->input->get('id_paint_system') ? 'selected' : '' ?>><?= $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-2 col-form-label text-muted"> Activity</label>
                    <div class="col-xl">
                      <select name="id_activity" class="select2" style="width:100%" >
                        <option value="">---</option>
                        <?php foreach ($activity as $key => $value) : ?>
                          <option value="<?= $value['id_activity'] ?>" <?= $value['id_activity'] == $this->input->get('id_activity') ? 'selected' : '' ?>><?= $value['description_of_activity'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-12 text-right">
                  <hr>
                  <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card border-0 shadow">
          <div class="card-header">
            <h6 class="card-title m-0">Submission List</h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive overflow-auto">
                  <table class="table table-hover text-center" id="table_list" style="width:100%">
                    <thead class="bg-green-smoe text-white">
                      <th>Project</th>
                      <th>Submission Id</th>
                      <th>Paint System</th>
                      <th>Activity</th>
                      <th>Vendor</th>
                      <th>Created By</th>
                      <th>Created Date</th>
                      <th></th>
                    </thead>
                    <tbody>
                      <?php foreach ($list as $key => $value) : ?>
                        <?php
                        $paint_system_desc    = [];
                        $activity_desc        = [];

                        if ($value['id_paint_system']) {
                          $id_paint_system = explode(";", $value['id_paint_system']);

                          foreach ($id_paint_system as $v) {
                            $paint_system_desc[] = $paint_system[$v]['name'];
                          }
                        }

                        if ($value['id_activity']) {
                          $id_activity        = explode(";", $value['id_activity']);

                          foreach ($id_activity as $v) {
                            $activity_desc[] = $activity[$v]['description_of_activity'];
                          }
                        }

                        ?>
                        <tr>
                          <td><?= $project_list[$value['project_id']]['project_name'] ?></td>
                          <td><?= $value['submission_id'] ?></td>
                          <td class="text-nowrap">
                            <?= implode(', <br>', $paint_system_desc) ?>
                          </td>
                          <td class="text-nowrap">
                            <?= implode(', <br>', $activity_desc) ?>
                          </td>

                          <td><?= @$company_list[$value['id_vendor']]['company_name'] ? $company_list[$value['id_vendor']]['company_name'] : 'PT SMOE' ?></td>
                          
                          <td><?= $user[$value['transmittal_by']]['full_name'] ?></td>
                          <td><?= $value['transmittal_date'] ?></td>
                          <td>
                            <a class="btn btn-primary" href="<?= base_url('planning_bnp/inspection_detail/') . $value['submission_id'] ?>" target="_blank"><i class="fas fa-list"></i> Detail</a>
                          </td>
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