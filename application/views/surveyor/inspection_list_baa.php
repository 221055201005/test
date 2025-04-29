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
        <div class="card shadow my-3 rounded-0">

          <div class="card-header">
            <h6 class="m-0">Filter Data Inspection</h6>
          </div>
          <div class="card-body">
            <form action="" method="post">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 text-muted col-form-label "> Project ID</label>
                    <div class="col-xl">
                      <select name="project_id" class="custom-select" >
                        <?php foreach ($project_list as $key => $value) : ?>
													<?php if(in_array($value['id'], $this->user_cookie[13])): ?>
                          	<option value="<?= $value['id'] ?>" <?= $value['id'] == $this->input->post('project_id') ? 'selected' : '' ?>><?= $value['project_name'] ?></option>
													<?php endif; ?>
                        <?php endforeach; ?>
                      </select>

                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 text-muted col-form-label "> Discipline</label>
                    <div class="col-xl">
                      <select name="discipline" class="custom-select">
                        <option value="">---</option>
                        <?php foreach ($discipline_list as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $this->input->post('discipline') ? 'selected' : '' ?>>
                            <?= $value['discipline_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 text-muted col-form-label "> Module</label>
                    <div class="col-xl">
                      <select name="module" class="custom-select module" >
                        <option value="">---</option> 
                          <?php foreach ($module_list as $key => $value) : ?>
                            <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$post['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                          <?php endforeach; ?> 
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 text-muted col-form-label ">Type of Module</label>
                    <div class="col-xl">
                      <select name="type_of_module" class="custom-select">
                        <option value="">---</option>
                        <?php foreach ($type_of_module as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $this->input->post('type_of_module') ? 'selected' : '' ?>>
                            <?= $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 text-muted col-form-label ">Deck Elevation / Service Line</label>
                    <div class="col-xl">
                      <select name="deck_elevation" class="select2" style="width:100%">
                        <option value="">---</option>
                        <?php foreach ($deck_list as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $this->input->post('deck_elevation') ? 'selected' : '' ?>>
                            <?= $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 text-muted col-form-label "> Status Inspection</label>
                    <div class="col-xl">
                      <select name="status_inspection" class="custom-select">
                        <option value="1" <?= "1" == $this->input->post('status_inspection') ? 'selected' : '' ?>>Pending Approval</option>
                        <option value="2" <?= "2" == $this->input->post('status_inspection') ? 'selected' : '' ?>>Rejected By QC</option>
                        <option value="3" <?= "3" == $this->input->post('status_inspection') ? 'selected' : '' ?>>Approved By QC</option>
                        <option value="4" <?= "4" == $this->input->post('status_inspection') ? 'selected' : '' ?>>Pending By QC</option>
                      </select>
                    </div>
                  </div>
                </div>



                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 text-muted col-form-label">Company</label>
                    <div class="col-xl">
                      <select name="company_id" class="select2" style="width:100%">
                        <option value="">---</option>
                        <?php foreach ($company_list as $key => $value) : ?>
                          <option value="<?= $value['id_company'] ?>" <?= $this->input->post('company_id') == $value['id_company'] ? 'selected' : '' ?>><?= $value['company_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>



                <div class="col-md-12">
                  <div class="float-right">
                    <button class="mt-2 btn btn-sm btn-flat btn-info"><i class="fas fa-search"></i> Search</button>
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
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Inspection List <?= $rev_status == 1 ? '- <strong>Revision List</strong>' : '' ?></h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive overflow-auto">
                  <table id="table_material" class="table table-hover text-center" style="width:100%">
                    <thead class="bg-green-smoe text-white">
                      <th>Project</th>
                      <th>Workpack No.</th>
                      <th>Submission No.</th>
                      <th>Drawing No.</th>
                      <th>Discipline</th>
                      <th>Module</th>
                      <th>Type of Module</th>
                      <th>Deck Elevation / Service Line</th>
                      <th>Company</th>
                      <th>Requestor</th>
                      <th>Request Date</th>
                      <th>Resubmit Status</th>
                      <th>Inspection Status</th>
                      <th style="min-width: 150px;">Action</th>
                    </thead>
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

    $("#table_material").DataTable({
      processing: true,
      serverSide: true,
      order: [],
      ajax: {
        url: "<?= site_url($serverside) ?>",
        type: "POST",
        data: {
          project_id          : "<?= $this->input->post('project_id') ?>",
          discipline          : "<?= $this->input->post('discipline') ?>",
          module              : "<?= $this->input->post('module') ?>",
          module_type         : "<?= $this->input->post('type_of_module') ?>",
          status_inspection   : "<?= $this->input->post('status_inspection') ?>",
          deck_elevation      : "<?= $this->input->post('deck_elevation') ?>",
          company_id          : "<?= $this->input->post('company_id') ?>",
          revision_status     : "<?= $rev_status ?>"
        }
      }
    })
  })

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

  function changeReport(report_number, drawing_no, discipline) {

    Swal.fire({
      type: "warning",
      title: "Return Report",
      text: "Are you sure to return this report ?",
      showCancelButton: true,
    }).then((res) => {
      if (res.value) {
        $.ajax({
          url: "<?= base_url('material_verification/return_rfi/') ?>",
          type: "post",
          data: {
            'report_number': report_number,
            'drawing_no': drawing_no,
            'discipline': discipline,
            'backtopro': 'piping',
          },
          success: function(data) {
            if (data == 'Error') {
              Swal.fire(
                'Failed to Return Report Number!',
                '',
                'error'
              )
            } else {
              Swal.fire(
                'Data has been Returned!',
                '',
                'success'
              )
              $('#table_material').DataTable().ajax.reload();
            }
          }
        });
      }
    })

  }
</script>