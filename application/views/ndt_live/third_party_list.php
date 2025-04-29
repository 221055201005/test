<style>
  th,
  td {
    vertical-align: middle !important;
  }
</style>
<div id="content" class="container-fluid">

  <style>
    a[aria-expanded=true] .fa-angle-double-down {
      display: none;
    }

    a[aria-expanded=false] .fa-angle-double-up {
      display: none;
    }
  </style>
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded tab-filter">
        <div class="card-header">
          <a class="btn btn-primary" data-toggle="collapse" href="#collapseButton" role="button" aria-expanded="false" aria-controls="collapseButton">Filter &nbsp; <i class="fas fa-angle-double-down"></i><i class="fas fa-angle-double-up"></i></a>
        </div>
        <div class="collapse show" id="collapseButton">
          <div class="card-body bg-white overflow-auto">
            <form action="" method="GET">
              <div class="row">
                <?php error_reporting(0) ?>

                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label text-muted ">Project ID</label>
                    <div class="col-xl">
                      <select class="form-control" name="project" id="project_js">
                        <?php if ($this->permission_cookie[0] == 1) { ?>
                          <option value="">---</option>
                          <?php foreach ($project_list as $key => $value) : ?>
                            <option value="<?php echo $value['id'] ?>" <?= (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?= $value['project_name'] ?></option>
                          <?php endforeach; ?>
                        <?php } else { ?>
                          <?php foreach ($project_list as $key => $value) : ?>
                            <?php if (in_array($value['id'], $this->user_cookie[13])) { ?>
                              <option value="<?= $value['id'] ?>" <?= (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?= $value['project_name'] ?></option>
                            <?php } ?>
                          <?php endforeach; ?>
                        <?php } ?>
                      </select>
                      <script type="text/javascript">
                        var project_js

                        function save_project() {
                          project_js = $('#project_js').val()
                          console.log(project_js)
                        }
                      </script>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label text-muted ">Discipline</label>
                    <div class="col-xl">
                      <select class="form-control" name="discipline" id="discipline_js">
                        <option value="">---</option>
                        <?php foreach ($discipline_list as $key => $value) : ?>
                          <option onclick="save_discipline()" value="<?php echo $value['id'] ?>" <?php echo (@$get['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                      <script type="text/javascript">
                        var discipline_js

                        function save_discipline() {
                          discipline_js = $('#discipline_js').val()
                          console.log(discipline_js)
                        }
                      </script>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label text-muted ">Module</label>
                    <div class="col-xl">
                      <select class="form-control" name="module" id="module_js">
                        <option value="">---</option>
                        <?php foreach ($module_list as $key => $value) : ?>

                          <option onclick="save_module()" value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$get['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                        <?php endforeach; ?>
                      </select>
                      <script type="text/javascript">
                        var module_js

                        function save_module() {
                          module_js = $('#module_js').val()
                          console.log(module_js)
                        }
                      </script>
                    </div>
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label text-muted ">Type of Module</label>
                    <div class="col-xl">
                      <select class="form-control" name="type_of_module">
                        <option value="">---</option>
                        <?php foreach ($type_of_module_list as $key => $value) : ?>
                          <option onclick="save_type_module()" value="<?php echo $value['id'] ?>" <?php echo (@$get['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                      <script type="text/javascript">
                        var type_module_js

                        function save_type_module() {
                          type_module_js = $('#type_module_js').val()
                          console.log(type_module_js)
                        }
                      </script>
                    </div>
                  </div>
                </div>

                <div class="col-12 text-right">
                  <hr>
                  <button class="mt-2 btn btn-sm btn-flat btn-info" name="submit" value="search"><i class="fas fa-search"></i> Search</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-12">
      <div class="card rounded-0 shadow">
        <div class="card-header">
          <h6 class="card-title m-0"> NDT Third Party List - <strong><?= $method ?></strong></h6>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive overflow-auto">
                <table class="table table-hover text-center" id="table_list">
                  <thead class="bg-gray-table">
                    <th>Project</th>
                    <th>Report No.</th>
                    <th>Drawing No.</th>
                    <th>Discipline</th>
                    <th>Module</th>
                    <th>Type of Module</th>
                    <th>Vendor</th>
                    <th>Submit By</th>
                    <th>Submit Date</th>
                    <th>Status Inspection</th>
                    <th>Third Party Status</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                    <?php foreach ($ndt_list as $key => $value) : ?>
                      <tr>
                        <td><?php echo $project_list[$value["id_project"]]['project_name'] ?></td>
                        <td><?php echo $value["report_no"] ?></td>
                        <td><?php echo $value["drawing_no"] ?></td>
                        <td><?php echo $discipline_list[$value["discipline"]]['discipline_name'] ?></td>
                        <td><?php echo $module_list[$value['module']]['mod_desc'] ?></td>
                        <td><?php echo $type_of_module_list[$value['type_of_module']]['name'] ?></td>
                        <td><?php echo isset($value['id_vendor']) ? $company[$value['id_vendor']]['company_name'] : ''; ?></td>
                        <td><?php echo $user[$value['import_by']]['full_name'] ?></td>
                        <td><?php echo $value["import_date"] ?></td>
                        <td>
                          <?php if ($value['status_inspection'] == 7) : ?>
                            <span class="badge badge-pill badge-success">Approved by Client</span>
                          <?php endif; ?>
                        </td>
                        <td>
                          <?php if ($value['third_party_approval_status'] == 0) : ?>
                            <span class="badge badge-primary badge-pill">Pending Review</span>
                          <?php else : ?>
                            <span class="badge badge-success badge-pill">Reviewed</span>
                          <?php endif; ?>
                        </td>
                        <td>
                          <div class="btn-group">
                            <a target="_blank" href="<?= site_url("ndt_live/ndt_detail_" . strtolower($method) . "/" . encrypt($value['uniq_id_report'])) ?>" class="btn btn-primary col-auto"><i class="fas fa-list"></i> Detail</a>
                            <?php if ($method != 'PWHT') : ?>
                              <a target="_blank" href="<?= site_url("ndt_live/ndt_detail_" . strtolower($method) . "/" . encrypt($value['uniq_id_report']) . '/' . encrypt("pdf")) ?>" class="btn btn-danger col-auto ml-2"><i class="fas fa-file-pdf"></i> PDF</a>
                            <?php endif; ?>
                            <?php if ($this->user_cookie[4] == 1 && !in_array($value["status_inspection"], [6, 7, 8])) : ?>
                              <button onclick="returnReport('<?= strtolower($method) ?>', '<?= encrypt($value['uniq_id_report']) ?>')" class="btn btn-secondary col-auto ml-2"><i class="fas fa-redo"></i> Return</button>
                            <?php endif; ?>
                          </div>
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


<script>
  $(document).ready(function() {
    $('#table_list').DataTable({
      "order": [],
      "responsive": true
    });
  });
</script>