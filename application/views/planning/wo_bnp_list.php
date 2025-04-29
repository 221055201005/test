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
                  <div class="col-md">
                    <select class="form-control" name="project" required>
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
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status</label>
                  <div class="col-md">

                    <select class="form-control" name="status_filter">
                      <option value="all">---</option>
                      <option value="0" <?php echo (@$get['status_filter'] == "0" ? 'selected' : '') ?>>Draft</option>
                      <option value="1" <?php echo (@$get['status_filter'] == "1" ? 'selected' : '') ?>>Pending Approval Project Engineering / Construction Engineering</option>
                      <option value="3" <?php echo (@$get['status_filter'] == "3" ? 'selected' : '') ?>>Pending Approval Construction Superintendent</option>
                      <option value="5" <?php echo (@$get['status_filter'] == "5" ? 'selected' : '') ?>>Issued</option>
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
                    <select class="form-control" name="discipline">
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">&nbsp</label>
                  <div class="col-md">
                    &nbsp
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12 text-right">
                <button class="mt-2 btn btn-sm btn-flat btn-success" name="submit" value="search"><i class="fas fa-search"></i> Search</button>
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
                    <th>Workpack No.</th>
                    <th>Description</th>
                    <th>Discipline</th>
                    <th>Phase</th>
                    <th>Plan Start Date</th>
                    <th>Plan Finish Date</th>
                    <th>Remarks</th>
                    <th>Status</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
            <br>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
</div>
<script>
  $("select[name=module]").chained("select[name=project]");

  <?php
  $submit = $this->input->get('submit');
  $project = $this->input->get('project');
  $discipline = $this->input->get('discipline');
  $status_filter = $this->input->get('status_filter');
  if (!isset($project)) {
    $project = $this->user_cookie[10];
  }


  ?>

  $('.dataTable').DataTable({
    order: [],
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": "<?php echo base_url(); ?>planning/wo_list_datatable_bnp",
      "type": "POST",
      "data": {
        "page": 'list',
        "project": '<?= isset($project) && !empty($project) ? $project : "-" ?>',
        "discipline": '<?= isset($discipline) && !empty($discipline) ? $discipline : "-" ?>',
        "status_filter": '<?= isset($status_filter) && $status_filter !== "all" ? $status_filter : "-" ?>',
      }
    }
  })

  $(".autocomplete_ga, .autocomplete_as").autocomplete({
    source: function(request, response) {
      var drawing_type;
      if ($(this.element).hasClass("autocomplete_ga") || $(this.element).hasClass("autocomplete_as")) {
        drawing_type = 1; //ga or as
      }
      $.ajax({
        url: "<?php echo base_url() ?>engineering/autocomplete_drawing/1",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: drawing_type,
        },
        success: function(data) {
          response(data);
        }
      });
    },
    select: function(event, ui) {
      var value = ui.item.value;
      if (value == 'No Data.') {
        ui.item.value = "";
      } else {
        get_data_drawing(ui.item.value);
      }
    }
  });

  function get_data_drawing(document_no) {
    var module = $("select[name=module]").val();
    console.log(document_no);
    console.log(module);
    $.ajax({
      url: "<?php echo base_url() ?>engineering/get_data_drawing",
      dataType: "json",
      data: {
        document_no: document_no,
        module: module,
      },
      success: function(data) {
        console.log(data);
        if (data.drawing_type == 1 || data.drawing_type == 2) {
          $("select[name=project]").val(data.project).trigger('change');
          $("select[name=discipline]").val(data.discipline);
          if (module == "") {
            $("select[name=module]").val(data.module);
          }
        }
      }
    });
  }
</script>