<style>
  [data-tooltip] {
    position: relative;
    z-index: 2;
    cursor: pointer;
  }

  /* Hide the tooltip content by default */
  [data-tooltip]:before,
  [data-tooltip]:after {
    visibility: hidden;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=0);
    opacity: 0;
    pointer-events: none;
  }

  /* Position tooltip above the element */
  [data-tooltip]:before {
    position: absolute;
    bottom: 150%;
    left: 50%;
    margin-bottom: 5px;
    margin-left: -80px;
    padding: 7px;
    width: 160px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    background-color: #000;
    background-color: hsla(0, 0%, 20%, 0.9);
    color: #fff;
    content: attr(data-tooltip);
    text-align: center;
    font-size: 14px;
    line-height: 1.2;
  }

  /* Triangle hack to make tooltip look like a speech bubble */
  [data-tooltip]:after {
    position: absolute;
    bottom: 150%;
    left: 50%;
    margin-left: -5px;
    width: 0;
    border-top: 5px solid #000;
    border-top: 5px solid hsla(0, 0%, 20%, 0.9);
    border-right: 5px solid transparent;
    border-left: 5px solid transparent;
    content: " ";
    font-size: 0;
    line-height: 0;
  }

  /* Show tooltip content on hover */
  [data-tooltip]:hover:before,
  [data-tooltip]:hover:after {
    visibility: visible;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
    filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=100);
    opacity: 1;
  }

  .badge-approved_comment {
    color: #ffffff;
    background-color: #2c7008;
  }

  .badge-pending_client {
    color: #ffffff;
    background-color: #b80762;
  }
</style>
<style>
  a[aria-expanded=true] .fa-angle-double-down {
    display: none;
  }

  a[aria-expanded=false] .fa-angle-double-up {
    display: none;
  }
</style>
<div id="content" class="container-fluid">
  <div class="row">
    <div class="col-md-12">

      <div class="row">
        <div class="col">
          <div class="card shadow my-3 rounded-0">
            <div class="card-header">
              <a class="btn btn-primary" data-toggle="collapse" href="#collapseButton" role="button" aria-expanded="false" aria-controls="collapseButton">Filter &nbsp; <i class="fas fa-angle-double-down"></i><i class="fas fa-angle-double-up"></i></a>
            </div>
            <div class="collapse <?= $this->input->post() ? 'show' : '' ?>" id="collapseButton">
              <div class="card-body bg-white overflow-auto">
                <form action="" method="POST">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row">
                        <label class="col-md-4 col-lg-3 col-form-label ">Project ID</label>
                        <div class="col-xl">
                          <select class="form-control" name="project" required>
                            <?php if ($this->permission_cookie[0] == 1) { ?>
                              <option value="">---</option>
                              <?php foreach ($project_list as $key => $value) : ?>
                                <option onclick="save_project()" value="<?php echo $value['id'] ?>" <?php echo (@$post['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                              <?php endforeach; ?>
                            <?php } else { ?>
                              <?php foreach ($project_list as $key => $value) : ?>
                                <?php if (in_array($value['id'], $this->user_cookie[13])) { ?>
                                  <option onclick="save_project()" value="<?php echo $value['id'] ?>" <?php echo (@$post['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                                <?php } ?>
                              <?php endforeach; ?>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group row">
                        <label class="col-md-4 col-lg-3 col-form-label "> </label>
                        <div class="col-xl">

                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">

                    <div class="col-6">
                      <div class="form-group row">
                        <label class="col-md-4 col-lg-3 col-form-label ">Module</label>
                        <div class="col-xl">
                          <select class="form-control" name="module">
                            <option value="">---</option>
                            <?php foreach ($module_list as $key => $value) : ?>
                              <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$post['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group row">
                        <label class="col-md-4 col-lg-3 col-form-label ">Type Of Module</label>
                        <div class="col-xl">
                          <select class="form-control" name="type_of_module">
                            <option value="">---</option>
                            <?php foreach ($type_of_module_list as $key => $value) : ?>
                              <option value="<?php echo $value['id'] ?>" <?php echo (@$post['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row">
                        <label class="col-md-4 col-lg-3 col-form-label ">Discipline</label>
                        <div class="col-xl">
                          <select class="form-control" name="discipline">
                            <option value="">---</option>
                            <?php foreach ($discipline_list as $key => $value) : ?>
                              <option value="<?php echo $value['id'] ?>" <?php echo (@$post['discipline'] == $value['id'] ? 'selected' : null) ?>><?php echo $value['discipline_name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row">
                        <label class="col-md-4 col-lg-3 col-form-label ">Drawing No</label>
                        <div class="col-xl">
                          <input type="text" class="form-control autocomplete_doc" name="drawing_no" value="<?php echo @$post['drawing_no'] ?>">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row">

                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group row">

                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-12 text-right">
                      <button class="mt-2 btn btn-sm btn-flat btn-info" id="searchButton" onclick="toggleForm()"><i class="fas fa-search"></i> Search</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div>
      <?php if ($status_inspection == 0) { ?>
        <form action="" method="POST" id="secondForm">
        <?php } ?>
        <div class="col-12">
          <div class="card shadow my-3 rounded-0">
            <div class="card-header">
              <h6 class="m-0">RFI - INSPECTION NOTIFICATION</h6>
            </div>
            <div class="card-body bg-white">
              <div class="col-12 <?= $class ?>">
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6 mt-2">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted">Inspector Name</label>
                        <div class="col-xl">
                          <select name="inspector_id" class="select2" style="width: 100%" required <?= $disabled ?>>
                            <option value="">---</option>
                            <?php foreach ($user_list as $key => $value) : ?>
                              <option value="<?= $value['id_user'] ?>" <?= $value['id_user'] == $main[0]['inspector_id'] ? 'selected' : '' ?>><?= $value['full_name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 mt-2">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted">Company Assigned</label>
                        <div class="col-xl">
                          <select name="id_vendor" class="select2" style="width: 100%" required <?= $disabled ?>>
                            <option value="">---</option>
                            <option value="1" <?= $main[0]['id_vendor'] == 1 ? 'selected' : '' ?>>PT SMOE</option>
                            <?php foreach ($company_list as $key => $value) : ?>
                              <option value="<?= $value['id_company'] ?>" <?= $value['id_company'] == $main[0]['id_vendor'] ? 'selected' : '' ?>><?= $value['company_name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted">Submitted Date</label>
                        <div class="col-xl">
                          <input type="date" name="submitted_date" class="form-control" <?= $disabled ?> required value="<?= $main[0]['submitted_date'] ? DATE('Y-m-d', strtotime($main[0]['submitted_date'])) : '' ?>">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted">Inspect Date from</label>
                        <div class="col-xl">
                          <input type="date" name="inspection_date" class="form-control" required <?= $disabled ?> value="<?= $main[0]['inspection_date'] ? DATE('Y-m-d', strtotime($main[0]['inspection_date'])) : '' ?>">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted">Inspect Date to</label>
                        <div class="col-xl">
                          <input type="date" name="inspection_date_to" class="form-control" required <?= $disabled ?> value="<?= $main[0]['inspection_date_to'] ? DATE('Y-m-d', strtotime($main[0]['inspection_date_to'])) : '' ?>">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted">Inspect Area</label>
                        <div class="col-xl">
                          <select class="select2 will_enable" name="area" <?= $disabled ?>>
                            <option value="">---</option>
                            <?php foreach ($area_v2 as $value_area) { ?>
                              <option value="<?= $value_area['id'] ?>" <?= $value_area['id'] == $main[0]['area'] ? 'selected' : '' ?>><?= $value_area['name'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted">Inspect Location</label>
                        <div class="col-xl">
                          <select class="select2 will_enable" name="location[]" multiple="" <?= $disabled ?>>
                            <option value="">---</option>
                            <?php foreach ($location_v2 as $value_location) { ?>
                              <option value="<?= $value_location['id'] ?>" data-chained="<?php echo $value_location['id_area'] ?>" <?= in_array($value_location['id'], explode(';', $main[0]['location'])) ? 'selected' : '' ?>><?= $value_location['name'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <script type="text/javascript">
                      $("select[name=location]").chained("select[name=area]");
                    </script>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted">Inspect Qty</label>
                        <div class="col-xl">
                          <input type="text" name="qty" class="form-control" <?= $disabled ?> required value="<?= $main[0]['qty'] ?>">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <hr>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted">Expected Time</label>
                        <div class="col-xl">
                          <input type='text' class='form-control' name="expected_time" value="<?= $rfi_detail[0]['expected_time'] ?>">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted">ITP Intervention to Employer</label>
                        <div class="col-xl">
                          <select class="form-control select2" style="width:100%" name="itp[]" multiple="">
                            <option value="1" <?= in_array(1, explode(';', $rfi_detail[0]['itp'])) ? 'selected' : '' ?>>Hold Point</option>
                            <option value="2" <?= in_array(2, explode(';', $rfi_detail[0]['itp'])) ? 'selected' : '' ?>>Witness</option>
                            <option value="3" <?= in_array(3, explode(';', $rfi_detail[0]['itp'])) ? 'selected' : '' ?>>Monitoring</option>
                            <option value="4" <?= in_array(4, explode(';', $rfi_detail[0]['itp'])) ? 'selected' : '' ?>>Review</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted">Result</label>
                        <div class="col-xl">
                          <input type='text' class='form-control' name="result" value="<?= $rfi_detail[0]['result'] ?>">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 ">
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </form>
    </div>

    <div class="my-3 p-3 bg-white rounded shadow-sm">
      <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
      <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
        <div class="container-fluid">

          <?php if ($status_inspection == 0) { ?>
            <form action='<?php echo base_url(); ?>wtr/submit_multiple_draft_mwtr' method='POST'>
            <?php } else if ($status_inspection == 3) { ?>
              <form action='<?php echo base_url(); ?>wtr/submit_multiple_transmit_mwtr' method='POST'>
              <?php } ?>


              <table class="table table-hover text-center dataTable" width="100%">
                <thead class="bg-gray-table">
                  <tr>
                    <?php if (($status_inspection == 0 || $status_inspection == 3) && $status_inspection != "summary_rfi") { ?>
                      <th>#</th>
                    <?php } ?>
                    <th>Project</th>
                    <th>Company</th>
                    <?php if ($status_inspection != 0 || $status_inspection == "summary_rfi") { ?>
                      <th>RFI Number</th>
                    <?php } else { ?>
                      <th>Draft Number</th>
                    <?php } ?>
                    <th>Drawing No</th>
                    <th>Test Package No</th>
                    <th>Discipline</th>
                    <th>Module</th>
                    <th>Type Of Module</th>
                    <th>Status Approval</th>
                    <th width="150px;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1;
                  foreach ($wtr_list as $key => $value) { ?>
                    <tr>
                      <?php if (($status_inspection == 0 || $status_inspection == 3) && $status_inspection != "summary_rfi") { ?>
                        <td>
                          <input type='checkbox' class='form-control' name='submit_multiple[]' value='<?= $value['uniq_id'] ?>'>
                          <input type='hidden' class='form-control' name='project[]' value='<?= $value['project'] ?>'>
                          <input type='hidden' class='form-control' name='discipline[]' value='<?= $value['discipline'] ?>'>
                          <input type='hidden' class='form-control' name='module[]' value='<?= $value['module'] ?>'>
                          <input type='hidden' class='form-control' name='type_of_module[]' value='<?= $value['type_of_module'] ?>'>
                          <input type='hidden' class='form-control' name='company_id_wp[]' value='<?= $value['company_id_wp'] ?>'>
                          <input type='hidden' class='form-control' name='submission_id[]' value='<?= $value['submission_id'] ?>'>
                          <input type='hidden' class='form-control' name='drawing_no[]' value='<?= $value['drawing_no'] ?>'>
                        </td>
                      <?php } ?>

                      <td><?= $project_name[$value['project']] ?></td>
                      <td><?= $company_name[$value['company_id']] ?></td>

                      <?php if ($status_inspection != 0 || $status_inspection == "summary_rfi") { ?>
                        <td><?php echo $value['submission_id'] . '<strong> Rev. ' . intval($value['postpone_reoffer_no']) . '</strong>'; ?></td>
                      <?php } else { ?>
                        <td><?php echo "Draft-" . $value['uniq_id']; ?></td>
                      <?php } ?>
                      <td><?php echo $value['drawing_no']; ?></td>
                      <td><?= $value['test_pack_no'] ? $value['test_pack_no'] : '-' ?></td>

                      <td><?php echo $discipline_name[$value['discipline']]; ?></td>
                      <td><?php echo $module_code[$value['module']]; ?></td>
                      <td><?php if (isset($type_of_module_name[$value['type_of_module']])) {
                            echo $type_of_module_name[$value['type_of_module']];
                          } else {
                            echo "-";
                          } ?></td>
                      <td>
                        <?php if ($value['status_inspection'] == 0) { ?>
                          <span class="badge badge-primary">Draft</span>
                        <?php } else if ($value['status_inspection'] == 1) { ?>
                          <span class="badge badge-primary">Pending QC SMOE</span>
                        <?php } else if ($value['status_inspection'] == 2) { ?>
                          <span class="badge badge-danger">Rejected QC SMOE</span>
                        <?php } else if ($value['status_inspection'] == 3) { ?>
                          <span class="badge badge-success">Approved By QC</span>
                        <?php } else if ($value['status_inspection'] == 4) { ?>
                          <span class="badge badge-primary">Pending Process By QC</span>
                        <?php } else if ($value['status_inspection'] == 5) { ?>
                          <span class="badge badge-pending_client">Pending By Client</span>
                        <?php } else if ($value['status_inspection'] == 6) { ?>
                          <span class="badge badge-danger">Reject By Client</span>
                        <?php } else if ($value['status_inspection'] == 7) { ?>
                          <span class="badge badge-success">Approved By Client</span>
                        <?php } else if ($value['status_inspection'] == 8) { ?>
                          <span class="badge badge-info">Requested For Update</span>
                        <?php } else if ($value['status_inspection'] == 9) { ?>
                          <span class="badge badge-approved_comment">Approve & Release With Comment</span>
                        <?php } else if ($value['status_inspection'] == 10) { ?>
                          <span class="badge badge-info">Postponed</span>
                        <?php } else if ($value['status_inspection'] == 11) { ?>
                          <span class="badge badge-warning">Re-Offer</span>
                        <?php } else if ($value['status_inspection'] == 12) { ?>
                          <span class="badge badge-secondary">Void</span>
                        <?php } ?>
                        <?php if (in_array($value['status_inspection'], [5, 9, 10, 11]) and isset($value['client_remarks'])) : ?>
                          <br>
                          <small><strong>Remarks:</strong> <?= $value['client_remarks'] ?></small>
                        <?php endif; ?>
                      </td>
                      <td>
                        <?php if ($value['discipline'] == 1) { ?>
                          <a target='_blank' href='<?= base_url() ?>wtr/show_irn_detail_wtr_signed_piping/<?= strtr($this->encryption->encrypt($value['uniq_id']), '+=/', '.-~') ?>'><span class='btn btn-primary'><i class="fas fa-book"></i></span></a>
                        <?php } else { ?>
                          <a target='_blank' href='<?= base_url() ?>wtr/show_irn_detail_wtr_signed/<?= strtr($this->encryption->encrypt($value['uniq_id']), '+=/', '.-~') ?>'><span class='btn btn-primary'><i class="fas fa-book"></i></span></a>
                        <?php } ?>

                        <?php if ($value["status_inspection"] == 1 and in_array($this->user_cookie[0], $this->allow_return)) { ?>
                          <button type="button" onclick="return_btr(this, '<?= encrypt($value['submission_id']) ?>')" type="button" class="btn btn-warning"> <i class="fas fa-undo"></i> </button>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php $no++;
                  } ?>
                </tbody>
              </table>
              <br />
              <?php if (($status_inspection == 0 || $status_inspection == 3) && isset($post["drawing_no"])) { ?>

                <button type='submit' class='btn btn-primary'> <i class="fas fa-paper-plane"></i> Submit</button>
              <?php  } ?>

              </form>

        </div>
      </div>
    </div>

  </div>
</div>
</div>
</div>

<script type="text/javascript">
  function return_btr(btn, enc_submission_id) {
    Swal.fire({
      type: "warning",
      title: "Return To Draft ?",
      showCancelButton: true,

    }).then((res) => {
      if (res.value) {

        $.ajax({
          url: "<?= site_url('wtr/return_to_draft') ?>",
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

  function open_disabled_form(val, no) {
    console.log(no);

    var $checkboxes = $('#form_submition td input[type="checkbox"]');
    $checkboxes.change(function() {
      var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
      $('#total_data_checked').text(countCheckedCheckboxes);
      $('#total_data_checked_val').val(countCheckedCheckboxes);

      if (countCheckedCheckboxes <= 10) {
        if ($(val).prop("checked") == true) {
          $('input[name="filter_check[' + no + ']"]').val(1);
        } else {
          $('input[name="filter_check[' + no + ']"]').val(0);
        }
      } else {
        alert("Sorry, Data checked has been maximum..");
        $('input[name="filter_check[' + no + ']"]').val(0);
      }
    });

  }

  $('.dataTable').DataTable({
    order: [],
    columnDefs: [{
      "targets": 0,
      "orderable": false,
    }]
  })
</script>

<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.chained.min.js"></script>
<script>
  $("select[name=module]").chained("select[name=project]");

  function toggleForm() {
    var form = document.getElementById("secondForm");
    if (form.style.display === "none") {
      form.style.display = "block";
    } else {
      form.style.display = "none";
    }
  }
</script>