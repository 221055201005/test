<style>
  a[aria-expanded=true] .fa-angle-double-down {
   display: none;
  }

  a[aria-expanded=false] .fa-angle-double-up {
    display: none;
  }
</style>
<br/>
<div id="content">
  <div class="container-fluid">
    <div class="row">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm">
        <div class="card-header">
            <a class="btn btn-primary" data-toggle="collapse" href="#collapseButton" role="button" aria-expanded="false" aria-controls="collapseButton">Filter &nbsp; <i class="fas fa-angle-double-down"></i><i class="fas fa-angle-double-up"></i></a>
        </div>
        <div class="collapse <?= $this->input->post() ? 'show' : '' ?>" id="collapseButton"> 
          <div class="card-body">
            <h6 class="card-title">Filter</h6>
            <hr>
            <form method="post">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Project</label>
                    <div class="col-xl">
                      <select name="project_id" class="custom-select">
                      <?php if($this->is_admin == 1){ ?>
                        <option value="">---</option>
                      <?php } ?>
                      <?php foreach ($project_list as $key => $value) : ?>
                        <?php if($this->is_admin == 1){ ?>
                         <option value="<?php echo $value['id'] ?>" <?php echo (@$project_id == $value['id'] ? 'selected' : ($this->user_cookie[10] == $value['id'] ? 'selected' : '')) ?>><?php echo $value['project_name'] ?></option>
                        <?php } else { ?>
                          <?php if(in_array($value['id'], $this->user_cookie[13])){ ?>
                            <option value="<?php echo $value['id'] ?>" <?= @$project_id == $value['id'] ? 'selected' : '' ?>><?php echo $value['project_name'] ?></option>
                          <?php } ?>
                        <?php } ?> 
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
                    <label for="" class="col-xl-3 col-form-label "> Module</label>
                    <div class="col-xl">
                      <select name="module" class="custom-select">
                      <option value="">---</option>
                      <?php foreach ($module_list as $key => $value) : ?>
                      <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?= $value['mod_id'] == $module ? 'selected' : '' ?>><?php echo $value['mod_desc'] ?></option>
                      <?php endforeach; ?>
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
                    <thead class="bg-gray-table">
                      <th style="vertical-align: middle !important;">Project</th>
                      <th style="vertical-align: middle !important;">Drawing No</th>
                      <th style="vertical-align: middle !important;">Drawing Description</th>
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

  $("select[name=module]").chained("select[name=project_id]");

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
        url: "<?= site_url('fitup/proceed_approval_request_for_update') ?>",
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

</script>

