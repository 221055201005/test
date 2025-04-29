<?php

$show_check = false;

if (in_array($status, ["0", "ready_transmit"]) && $this->input->get('drawing_no')) {
  $show_check = true;
}

?>

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
        <div id="accordion">
          <div class="card shadow rounded-0">
            <div class="card-header">
              <div class="row">
                <div class="col-md-6">
                  <h6 class="mt-2">Filter</h6>
                </div>
                <div class="col-md-6 text-right">
                  <button class="btn btn-sm btn-primary collapsed" data-toggle="collapse" data-target="#filter_coll" aria-expanded="false" aria-controls="filter_coll">
                    <i class="fas fa-angle-double-down"></i>
                  </button>
                </div>
              </div>
            </div>
            <div id="filter_coll" class="collapse <?= $this->input->get() ? 'show' : '' ?>" data-parent="#accordion">
              <div class="card-body">
                <form action="" method="get">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted"> Project</label>
                        <div class="col-xl">
                          <select name="project_id" class="select2" style="width:100%">
                            <option value="">---</option>
                            <?php foreach ($project as $key => $value) : ?>
                              <option value="<?= $value['id'] ?>" <?= $value['id'] == $this->input->get('project_id') ? 'selected' : '' ?>><?= $value['project_name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted"> Discipline</label>
                        <div class="col-xl">
                          <select name="discipline" class="select2" style="width:100%">
                            <option value="">---</option>
                            <?php foreach ($discipline as $key => $value) : ?>
                              <option value="<?= $value['id'] ?>" <?= $value['id'] == $this->input->get('discipline') ? 'selected' : '' ?>><?= $value['discipline_name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted"> Module</label>
                        <div class="col-xl">
                          <select name="module" class="select2" style="width:100%">
                            <option value="">---</option>
                            <?php foreach ($module as $key => $value) : ?>
                              <option value="<?= $value['mod_id'] ?>" <?= $value['mod_id'] == $this->input->get('module') ? 'selected' : '' ?>><?= $value['mod_desc'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted"> Type of Module</label>
                        <div class="col-xl">
                          <select name="type_of_module" class="select2" style="width:100%">
                            <option value="">---</option>
                            <?php foreach ($type_of_module as $key => $value) : ?>
                              <option value="<?= $value['id'] ?>" <?= $value['id'] == $this->input->get('type_of_module') ? 'selected' : '' ?>><?= $value['name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted"> Drawing No</label>
                        <div class="col-xl">
                          <input type="text" name="drawing_no" value="<?= $this->input->get('drawing_no') ?>" class="form-control">
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
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 my-3">
        <div class="card shadow">
          <div class="card-header">
            <h6 class="card-title m-0"> BTR Approval List</h6>
          </div>
          <div class="card-body">
            <?php if ($status == "0") : ?>
              <form id="form_submit" action="<?= site_url('btr/submit_data_btr_signed') ?>" method="post">
              <?php else : ?>
                <form id="form_submit" action="<?= site_url('btr/transmit_data_btr_signed') ?>" method="post">
                <?php endif; ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive overflow-auto">
                      <table class="table table-hover text-center" id="table_list">
                        <thead class="bg-green-smoe text-white">

                          <?php if ($show_check) : ?>
                            <th>
                              <input type="checkbox" style="width:25px; height:25px;" onclick="check_item(this, 'all')">
                            </th>
                          <?php endif; ?>

                          <th><?= $status == 0 ? 'Draft' : 'RFI' ?> Number</th>
                          <th>Revision</th>
                          <th>Project</th>
                          <th>Drawing No</th>
                          <th>Test Package No.</th>
                          <th>Discipline</th>
                          <th>Module</th>
                          <th>Type of Module</th>
                          <th>Status Approval</th>
                          <th>Action</th>
                        </thead>
                        <tbody>
                          <?php foreach ($list as $key => $value) : ?>
                            <?php

                            $number = "Draft-" . $value['uniq_id'];
                            if ($value['status_inspection'] > 0) {
                              $number = $value['submission_id'];
                            }

                            ?>
                            <tr>
                              <?php if ($show_check) : ?>
                                <td>
                                  <input type="checkbox" class="check" name="checked_uniq[]" value="<?= $value['uniq_id'] ?>" style="width:25px; height:25px" onclick="check_item(this, 'detail')">
                                </td>
                              <?php endif; ?>
                              <td><?= $number ?></td>
                              <td><?= intval($value['postpone_reoffer_no']) ?></td>
                              <td><?= $project[$value['project']]['project_name'] ?></td>
                              <td><?= $value['drawing_no'] ?></td>
                              <td><?= $joint[$value['id_joint']]['test_pack_no'] ?></td>
                              <td><?= $discipline[$value['discipline']]['discipline_name'] ?></td>
                              <td><?= $module[$value['module']]['mod_desc'] ?></td>
                              <td><?= $type_of_module[$value['type_of_module']]['name'] ?></td>
                              <td>
                                <span class="badge badge-pill badge-<?= $this->status_list[$value['status_inspection']]['color'] ?>"><?= $this->status_list[$value['status_inspection']]['text'] ?></span>
                                <?php if (in_array($value['status_inspection'], [9, 10, 11])) : ?>
                                  <br>
                                  <small><strong>Remarks:</strong> <?= $value['client_remarks'] ?></small>
                                <?php endif; ?>
                              </td>
                              <td>
                                <div class="btn-group">
                                  <?php if ($value['status_inspection'] == 1 && in_array($this->user_cookie[0], $this->allowed_user)) : ?>
                                    <button type="button" onclick="return_btr(this, '<?= encrypt($value['submission_id']) ?>')" type="button" class="btn btn-warning"> <i class="fas fa-undo"></i> Return to Draft</button>
                                  <?php endif; ?>
                                  <a href="<?= site_url('btr/detail_btr_signed/' . encrypt($value['uniq_id'])) ?>" class="btn btn-primary"><i class="fas fa-list"></i> Detail</a>
                                </div>
                              </td>

                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <?php if ($show_check && $this->input->get('drawing_no')) : ?>
                    <div class="col-md-12 text-right">
                      <hr>
                      <button type="submit" class="btn btn-primary" id="btn_submit" disabled><i class="fas fa-check"></i> Submit <span class="badge badge-light text_total">0</span></button>
                    </div>
                  <?php endif; ?>
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
  $('#form_submit').on('submit', function() {
    $('#btn_submit').attr('disabled', true)
  })
  $("#table_list").DataTable({
    order: []
  })

  var checked_list = []

  function check_item(input, cat) {

    if (cat == "all") {
      checked_list = []
      if (input.checked) {
        $('.check').each(function() {
          this.checked = true
          checked_list.push(this.value)
        })
      } else {
        $('.check').each(function() {
          this.checked = false
          checked_list.splice($.inArray(this.value, checked_list), 1)
        })
      }
    } else {

      if (input.checked) {
        checked_list.push(input.value)
      } else {
        checked_list.splice($.inArray(input.value, checked_list), 1)
      }

    }

    $('.text_total').text(checked_list.length)
    if (checked_list.length > 0) {
      $("#btn_submit").removeAttr('disabled')
    } else {
      $("#btn_submit").attr('disabled', true)
    }
  }

  function return_btr(btn, enc_submission_id) {
    Swal.fire({
      type: "warning",
      title: "Return To Draft ?",
      showCancelButton: true,

    }).then((res) => {
      if (res.value) {

        $.ajax({
          url: "<?= site_url('btr/return_to_draft') ?>",
          type: "POST",
          data: {
            enc_submission_id: enc_submission_id
          },
          dataType: "JSON",
          success: (data) => {
            if (data.success) {
              Swal.fire({
                type: "success",
                title: "Data Has Been Returned to Draft",
                timer: 1000
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