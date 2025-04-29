<div id="content">
  <div class="container-fluid">
    <div class="row">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h6 class="card-title">Filter</h6>
            <hr>
            <form method="post">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Project</label>
                    <div class="col-xl">
                      <select name="project_id" class="custom-select" onchange="find_module_by_project(this)">
                        <option value="">---</option>
                        <?php foreach ($project_list as $key => $value): ?>
                        <option value="<?= $value['id'] ?>" <?= $value['id'] == $project_id ? 'selected' : '' ?>>
                          <?= $value['project_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Discipline</label>
                    <div class="col-xl">
                      <select name="discipline" class="custom-select">
                        <option value="">---</option>
                        <?php foreach ($discipline_list as $key => $value): ?>
                        <option value="<?= $value['id'] ?>" <?= $value['id'] == $discipline ? 'selected' : '' ?>>
                          <?= $value['discipline_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Module</label>
                    <div class="col-xl">
                      <select name="module" class="custom-select module" <?= $project_id ? '' : 'disabled' ?>>
                        <option value="">---</option>
                        <?php if ($project_id): ?>
                        <?php foreach ($module_list as $key => $value): ?>
                        <option value="<?= $value['mod_id'] ?>" <?= $value['mod_id'] == $module ? 'selected' : '' ?>>
                          <?= $value['mod_desc'] ?></option>
                        <?php endforeach; ?>
                        <?php endif; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Type Of Module</label>
                    <div class="col-xl">
                      <select name="type_of_module" class="custom-select">
                        <option value="">---</option>
                        <?php foreach ($type_of_module as $key => $value): ?>
                        <option value="<?= $value['id'] ?>" <?= $value['id'] == $module_type ? 'selected' : '' ?>>
                          <?= $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <hr>
                  <div class="float-right">
                    <button type='submit' class='btn btn-primary'><i class='fas fa-search'></i> Search</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h6 class="card-title">Request For Update List <b>- (<?= $text_status ?>)</b></h6>
            <hr>
            <div class="row">
              <div class="col-md-12">
                <div class="table table-responsive overflow-auto">
                  <table class="table table-hover text-center" id="table_request" style="width: 100%">
                    <thead class="bg-green-smoe text-white">
                      <th style="vertical-align: middle !important;">Project</th>
                      <th style="vertical-align: middle !important;">Drawing No</th>
                      <th style="vertical-align: middle !important;">Submission Id</th>
                      <th style="vertical-align: middle !important;">Discipline</th>
                      <th style="vertical-align: middle !important;">Module</th>
                      <th style="vertical-align: middle !important;">Type Of Module</th>
                      <th style="vertical-align: middle !important;">Request By / Date</th>
                      <th style="vertical-align: middle !important;">Request Reason</th>
                      <th style="vertical-align: middle !important;">Responsible Inspector</th>
                      <th style="vertical-align: middle !important;">Approved By / Date</th>
                      <th style="vertical-align: middle !important;">Updated By / Date</th>
                      <th style="vertical-align: middle !important;">Re-Approval By / Date</th>
                      <th style="vertical-align: middle !important;">Status</th>
                      <th style="vertical-align: middle !important; min-width:150px">Action</th>
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
$(document).ready(function() {

  $('#table_request').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: "<?= site_url($serverside) ?>",
      type: "POST",
      data: {
        status_revise: "<?= $status_request ?>",
        project_id : "<?= $project_id ?>",
        discipline : "<?= $discipline ?>",
        module : "<?= $module ?>",
        module_type : "<?= $module_type ?>",

      }
    }
  })
})

function approve_data(btn, id, submission_id, status_revise) {
  var title
  if (status_revise == 1) {
    title = `<b class="text-success font-weight-bold">APPROVE</b>`
  } else if (status_revise == 2) {
    title = `<b class="text-danger font-weight-bold">REJECT</b>`
  }

  Swal.fire({
    type: "warning",
    title: title,
    html: `Are You Sure To ${title} This Request ? `,
    showCancelButton: true
  }).then((res) => {
    if (res.value) {
      $.ajax({
        url: "<?= site_url('itr/proceed_approval_request_for_update') ?>",
        type: "POST",
        data: {
          id: id,
          submission_id: submission_id,
          status_revise: status_revise
        },
        dataType: "JSON",
        success: function(data) {
          if (data.success) {
            Swal.fire({
              type : "success",
              title : "SUCCESS",
              text : "Successfully Change Request Status",
              timer : 1000
            })

            setTimeout(() => {
              location.reload()
            }, 1000);
          }
        }
      })
    }
  })
}

function find_module_by_project(select, mod_id = null) {
  var project_id = $(select).val()
  if (project_id) {
    $('.module').removeAttr('disabled')
    $.ajax({
      url: "<?= site_url('material_verification/find_module_by_project') ?>",
      type: "POST",
      data: {
        project_id: project_id
      },
      dataType: "JSON",
      success: function(data) {
        var html = []
        html.push(`<option value="">---</option>`)
        data.map(function(v, i) {
          html.push(
            `<option value="${v.mod_id}" ${mod_id && mod_id == v.mod_id ? 'selected' : ''}>${v.mod_desc}</option>`
          )
        })
        $('.module').html(html)
      }
    })
  } else {
    $('.module').val('')
    $('.module').attr('disabled', true)
  }
}
</script>