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
            <h6 class="card-title m-0">Add New Bonder</h6>
          </div>
          <div class="card-body bg-white">
            <form action="<?= site_url('master/bonder/proceed_add_bonder') ?>" enctype="multipart/form-data" method="post">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> Employee</label>
                    <div class="col-xl">
                      <select class="form-control badge_patient_select2 badge" name="id_bank_data" style="width: 100%" required>
                        <option value="">---</option>
                      </select>
                      <script type="text/javascript">
                        $(document).ready(function() {
                          $(".badge_patient_select2").select2({
                            ajax: {
                              url: "<?php echo base_url(); ?>master/bonder/bankdata_sdelect2_ajax",
                              type: "post",
                              dataType: 'json',
                              data: function(params) {
                                var query = {
                                  search: params.term
                                }
                                return query;
                              },
                              processResults: function(data) {
                                return {
                                  results: data
                                }
                              }
                            }
                          })
                        })
                      </script>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> Bonder ID</label>
                    <div class="col-xl">
                      <input type="text" name="bonder_id" class="form-control" required>
                    </div>
                  </div>
                </div>
                <!-- <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> Client Code</label>
                    <div class="col-xl">
                      <input type="text" name="rwe_code" class="form-control" required>
                    </div>
                  </div>
                </div> -->
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> Company</label>
                    <div class="col-xl">
                      <select class="form-control select2" name="company">
                        <option value="">---</option>
                        <?php foreach ($company_list as $key => $value) { ?>
                          <option value="<?= $value['id_company'] ?>"><?= $value['company_name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> Project</label>
                    <div class="col-xl">
                      <select class="form-control select2" name="project">
                        <option value="">---</option>
                        <?php foreach ($project_list as $key => $value) { ?>
                          <option value="<?= $value['id'] ?>"><?= $value['project_name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> Discipline</label>
                    <div class="col-xl">
                      <select class="form-control select2" name="discipline">
                        <option value="">---</option>
                        <?php foreach ($discipline_list as $key => $value) { ?>
                          <option value="<?= $value['id'] ?>"><?= $value['discipline_name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> Process</label>
                    <div class="col-xl">
                      <select class="form-control select2" name="process">
                        <option value="">---</option>
                        <?php foreach ($master_bonding_process as $key => $value) { ?>
                          <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> VSD</label>
                    <div class="col-xl">
                      <input type="date" name="vsd" class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> VED</label>
                    <div class="col-xl">
                      <input type="date" name="ved" class="form-control" required>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <hr>
                  <h6 class="card-title"> <i><strong>Certificate File</strong></i></h6>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive overflow-auto">
                        <table class="table table-bordered table-sm text-center">
                          <thead class="bg-green-smoe text-white">
                            <th>Certificate File</th>
                            <th>Description</th>
                            <th></th>
                          </thead>
                          <tbody id="row_att">
                            <tr>
                              <td><input type="file" name="attachment[]" accept="application/pdf" class="inputable" required></td>
                              <td><textarea name="description[]" class="form-control inputable"></textarea></td>
                              <td><button type="button" class="btn btn-success btn-sm" onclick="add_row(this)"><i class="fas fa-plus"></i></button></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <hr>
                  <div class="float-right">
                    <a href="<?= site_url('master/class_data/class_list') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                    <?php if ($this->permission_cookie[0] == 1) : ?>
                      <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Submit</button>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script>
  $('form').on('submit', function() {
    $('button[type=submit]').attr('disabled', true)
  })

  function add_row(btn) {

    $(btn).closest('tr').clone().insertAfter($(btn).closest('tbody').find('tr:last'))
    $(btn).closest('tbody').find('tr:last').find('td:last').html(
      '<button type="button" class="btn btn-danger btn-sm" onclick="delete_row(this)"><i class="fas fa-minus"></i></button>'
    )
    $(btn).closest('tbody').find('tr:last').find('.inputable').val('')
  }

  function delete_row(btn) {
    $(btn).closest('tr').remove()
  }
</script>