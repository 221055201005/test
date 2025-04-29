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

                <div class="col-md-6" >
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label text-muted ">Status Inspection</label>
                    <div class="col-xl">
                      <select name="status_inspection" class="form-control">
                        <option value="">All</option>
                        <?php if ($this->user_cookie[7] != 8) { ?>
                          <option value="0" <?= $this->input->get('status_inspection') == '0' ? 'selected' : '' ?>>Submitted</option>
                          <option value="1" <?= $this->input->get('status_inspection') == '1' ? 'selected' : '' ?>>Pending by QC (SEATRIUM)</option>
                          <option value="4" <?= $this->input->get('status_inspection') == '4' ? 'selected' : '' ?>>Approved by QC (SEATRIUM)</option>
                          <option value="13" <?= $this->input->get('status_inspection') == '13' ? 'selected' : '' ?>>Pending by QC (SUBCONT)</option>
                          <option value="15" <?= $this->input->get('status_inspection') == '15' ? 'selected' : '' ?>>Approve by QC (SUBCONT)</option>
                        <?php } ?>
                        <option value="5" <?= $this->input->get('status_inspection') == '5' ? 'selected' : '' ?>>Pending by Client</option>
                        <option value="6" <?= $this->input->get('status_inspection') == '6' ? 'selected' : '' ?>>Returned by Client</option>
                        <option value="7" <?= $this->input->get('status_inspection') == '7' ? 'selected' : '' ?>>Approve by Client</option>
                      </select>
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
          <h6 class="card-title m-0"> NDT List - <strong><?= $method ?></strong></h6>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive overflow-auto">
                <table class="table table-hover text-center" id="table_list" style="width:100%">
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
                    <!-- <th>Inspection Date</th> -->
                    <th>Status Inspection</th>
                    <th>Action</th>
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

<script>
  $("select[name=module]").chained("select[name=project]");
  $("#table_list").DataTable({
    order: [],
    processing: true,
    serverSide: true,
    ajax: {
      url: "<?= site_url($serverside) ?>",
      type: "POST",
      data: {
        method: "<?= $method ?>",
        project: "<?= $get['project'] ?>",
        discipline: "<?= $get['discipline'] ?>",
        module: "<?= $get['module'] ?>",
        type_of_module: "<?= $get['type_of_module'] ?>",
        status_inspection: "<?= $get['status_inspection'] ?>",
      }
    }
  })

  function returnReport(method, uniq_id_report) {
    Swal.fire({
      type: 'warning',
      title: 'Are You Sure to Return this Data?',

      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: 'Yes',
    }).then((result) => {
      console.log(result)
      /* Read more about isConfirmed, isDenied below */
      if (result.value == true) {
        $.ajax({
          url: "<?= base_url() ?>ndt_live/returnReport",
          type: "POST",
          data: {
            'method': method,
            'uniq_id_report': uniq_id_report,
          },
        })
        Swal.fire('Success!', '', 'success')
        location.reload()
      } else {
        Swal.fire('Changes are not saved', '', 'info')
      }
    })
  }
</script>