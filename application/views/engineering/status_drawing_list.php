<?php
$get = $this->input->get();
?>
<div id="content" class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="" method="GET">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
                  <div class="col-xl">
                    <select class="form-control" name="project" id='project_id'>
                      <option value="">---</option>
                      <?php foreach ($project_list as $key => $value) : ?>
                        <?php if (in_array($value['id'], $this->user_cookie[13])) : ?>
                          <option value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="module">
                      <option value="">---</option>
                      <?php foreach ($module_list as $key => $value) : ?>
                        <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$get['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <!-- <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type Of Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="type_of_module">
                      <option value="">---</option>
                      <?php foreach ($type_of_module_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code'] . " - " . $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div> -->
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                  <div class="col-xl">
                    <select class="form-control" name="discipline">
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <!-- <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Deck Elevation / Service Line</label>
                  <div class="col-xl">
                    <select class="form-control" name="deck_elevation">
                      <option value="">---</option>
                      <?php foreach ($deck_elevation_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code'] . " - " . $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div> -->
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Drawing Type</label>
                  <div class="col-xl">
                    <select class="form-control" name="drawing_type">
                      <option value="">---</option>
                      <option value="1" <?php echo (@$get['drawing_type'] == '1' ? 'selected' : '') ?>>GA</option>
                      <option value="2" <?php echo (@$get['drawing_type'] == '2' ? 'selected' : '') ?>>Assembly</option>
                      <option value="13" <?php echo (@$get['drawing_type'] == '13' ? 'selected' : '') ?>>Isometric</option>
                      <option value="9" <?php echo (@$get['drawing_type'] == '9' ? 'selected' : '') ?>>Weldmap GA</option>
                      <option value="14" <?php echo (@$get['drawing_type'] == '14' ? 'selected' : '') ?>>Weldmap AS</option>
                      <option value="12" <?php echo (@$get['drawing_type'] == '12' ? 'selected' : '') ?>>Pipe Support</option>
                      <option value="7" <?php echo (@$get['drawing_type'] == '7' ? 'selected' : '') ?>>Method Statement</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Company</label>
                  <div class="col-xl">
                    <select class="form-control" name="company_id">
                      <option value="">---</option>
                      <?php foreach ($company_list as $key => $value) : ?>
                        <?php if (in_array($value['id_company'], $this->user_cookie[14])) : ?>
                          <option value="<?php echo $value['id_company'] ?>" <?php echo (@$get['company_id'] == $value['id_company'] ? 'selected' : '') ?>><?php echo $value['company_name'] ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-right">
                <button class="mt-2 btn btn-sm btn-flat btn-info" name="submit" value="search"><i class="fas fa-search"></i> Search</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
          <form method="POST" action="<?php echo base_url() ?>engineering/piecemark_update">
            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th></th>
                    <th>Drawing No</th>
                    <th>Title</th>
                    <th>Rev No</th>
                    <th>Project</th>
                    <th>Module</th>
                    <th>Discipline</th>
                    <th>Drawing Status</th>
                    <th>Piecemark Status</th>
                    <th>Joint Status</th>
                    <th>Total Piecemark</th>
                    <th>Total Joint</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script>
  $('.dataTable').DataTable({
    lengthMenu: [10, 25, 30, 50, 100],
    order: [],
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": "<?php echo base_url(); ?>engineering/status_drawing_list_datatable",
      "type": "POST",
      "data": {
        "page": 'list',
        <?php
        if ($this->input->get('submit')) {
          echo '"submit": "' . $this->input->get('submit') . '",';
          if ($this->input->get('project')) {
            echo '"project": ' . $this->input->get('project') . ',';
          }
          if ($this->input->get('module')) {
            echo '"module": ' . $this->input->get('module') . ',';
          }
          if ($this->input->get('type_of_module')) {
            echo '"type_of_module": ' . $this->input->get('type_of_module') . ',';
          }
          if ($this->input->get('discipline')) {
            echo '"discipline": ' . $this->input->get('discipline') . ',';
          }
          if ($this->input->get('deck_elevation')) {
            echo '"deck_elevation": ' . $this->input->get('deck_elevation') . ',';
          }
          if ($this->input->get('drawing_type')) {
            echo '"drawing_type": "' . $this->input->get('drawing_type') . '",';
          }
          if ($this->input->get('company_id')) {
            echo '"company": "' . $this->input->get('company_id') . '",';
          }
        }
        ?>
      }
    },
    columnDefs: [{
      "targets": 9,
      "className": "text-nowrap",
    }]
  })

  function notif_template_clicked(notif, id_activity) {
    $(notif).html('<i class="fas fa-spinner fa-pulse"></i>');
    $.ajax({
      url: "<?php echo base_url(); ?>engineering/notif_template_clicked/",
      type: "post",
      data: {
        'id_activity': id_activity,
      },
      success: function(data) {
        $(notif).remove();
      }
    });
  }
</script>