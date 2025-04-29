<style>
  th,
  td {
    vertical-align: middle !important;
  }

  td:nth-child(13) {
    white-space: nowrap !important;
  }

  #detail_card {
    font-size: 12px;
  }

  .card-box {
    position: relative;
    color: #fff;
    padding: 1px 5px 2px;
    margin: 10px 0px;
    text-align: left;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  }

  .card-box:hover {
    text-decoration: none;
    color: #f1f1f1;
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
  }

  .card-box:hover .icon i {
    font-size: 100px;
    transition: 1s;
    -webkit-transition: 1s;
  }

  .card-box .inner {
    padding: 5px 10px 0 10px;
  }

  .card-box h3 {
    font-size: 15px;
    font-weight: bold;
    margin: 0 0 1px 0;
    white-space: nowrap;
    padding: 0;
    text-align: left;
  }

  .card-box p {
    font-size: 11px;
  }

  .card-box .icon {
    position: absolute;
    top: auto;
    bottom: 5px;
    right: 5px;
    z-index: 0;
    font-size: 50px;
    color: rgba(0, 0, 0, 0.15);
  }

  .card-box .card-box-footer {
    position: absolute;
    left: 0px;
    bottom: 0px;
    text-align: center;
    padding: 3px 0;
    color: rgba(255, 255, 255, 0.8);
    background: rgba(0, 0, 0, 0.1);
    width: 100%;
    text-decoration: none;
  }

  .card-box:hover .card-box-footer {
    background: rgba(0, 0, 0, 0.3);
  }

  .bg-blue {
    background-color: #0031d1 !important;
  }

  .bg-green {
    background-color: #00a65a !important;
  }

  .bg-orange {
    background-color: #f39c12 !important;
  }

  .bg-red {
    background-color: #d9534f !important;
  }

  .bg-red-2 {
    background-color: #b80000 !important;
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
<br/>
<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div id="accordion">
          <div class="card shadow rounded-0">
            <div class="card-header">
              <a class="btn btn-primary" data-toggle="collapse" href="#collapseButton" role="button" aria-expanded="false" aria-controls="collapseButton">Filter &nbsp; <i class="fas fa-angle-double-down"></i><i class="fas fa-angle-double-up"></i></a>
            </div>
            <div class="collapse <?= $this->input->post() ? 'show' : '' ?>" id="collapseButton">
              <div class="card-body">
                <form action="" method="post" id='form-filter'>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted"> Project ID</label>
                        <div class="col-xl">
                          <select name="project_id" class="custom-select" onchange="find_module_by_project(this)">
                            <option value="">---</option>
                            <?php

                            foreach ($project_list as $key => $value) : ?>
                              <option value="<?= $value['id'] ?>" <?= $value['id'] == $project_id ? 'selected' : ($this->user_cookie[10] == $value['id'] ? 'selected' : '') ?>>
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
                            <?php foreach ($discipline_list as $key => $value) : ?>
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
                            <?php if ($project_id) : ?>
                              <?php foreach ($module_list as $key => $value) : ?>
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
                        <label for="" class="col-xl-3 col-form-label text-muted"> Type of Module</label>
                        <div class="col-xl">
                          <select name="type_of_module" class="custom-select">
                            <option value="">---</option>
                            <?php foreach ($type_of_module as $key => $value) : ?>
                              <option value="<?= $value['id'] ?>" <?= $value['id'] == $module_type ? 'selected' : '' ?>>
                                <?= $value['name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted"> Deck Elevation / Service Line</label>
                        <div class="col-xl">
                          <select name="deck_elevation" class="select2" style="width:100%">
                            <option value="">---</option>
                            <?php foreach ($deck_elevation as $key => $value) : ?>
                              <option value="<?= $value['id'] ?>" <?= $value['id'] == $this->input->post('deck_elevation') ? 'selected' : '' ?>>
                                <?= $value['name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="" class="col-xl-3 col-form-label text-muted"> Status Inspection</label>
                        <div class="col-xl">
                          <select name="status_inspection" class="custom-select">
                            <option value="">---</option>
                            <option value="1" <?= "1" == $status_inspection ? 'selected' : '' ?>>Pending Approval</option>
                            <option value="2" <?= "2" == $status_inspection ? 'selected' : '' ?>>Rejected By QC</option>
                            <option value="3" <?= "3" == $status_inspection ? 'selected' : '' ?>>Approved By QC</option>
                            <option value="4" <?= "4" == $status_inspection ? 'selected' : '' ?>>Pending By QC</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <!-- <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"> Submission Number</label>
                    <div class="col-xl">
                     <input type='text' name='submission_id' class='form-control search_submission_id' value='<?= $submission_id ?>' placeholder='Type Submission No'>
                    </div>
                  </div>
                </div> -->
                    <?php if ($this->user_cookie[11] == 1) { ?>
                      <!-- <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Company</label>
                    <div class="col-xl">
                      <select name="company_id" class="select2" style="width:100%" onchange='autofilter(this);'>
                        <option value="" <?= $company_id == 0 ? 'selected' : '' ?>>---</option>
                        <?php foreach ($company_list as $key => $value) { ?>
                          <option value="<?= $value['id_company'] ?>" <?= $company_id == $value['id_company'] ? 'selected' : '' ?>><?= $value['company_name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div> -->
                    <?php } ?>
                    <!-- <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label text-muted">Workpack Number</label>
                        <div class="col-xl">
                          <input type="text" name="workpack_no" class="form-control workpack_no" placeholder="Work Pack Number" value="<?= @$workpack_no ? @$workpack_no : '' ?>">
                        </div>
                      </div>
                    </div> -->

                    <div class="col-md-12">

                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <div class="col-xl">
                          <?php if ($revision_status != 1) { ?>
                            <div class="container text-right">
                              <div class="row">
                                <div class="col-md-3">
                                  <div class="card-box bg-blue">
                                    <div class="inner">
                                      <h3><span id='total_pending'>0</span></h3>
                                      <span id='detail_card'>Pending Approval</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="card-box bg-red">
                                    <div class="inner">
                                      <h3><span id='total_rejected'>0</span></h3>
                                      <span id='detail_card'>Rejected</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="card-box bg-red-2">
                                    <div class="inner">
                                      <h3><span id='total_reject_pending_resubmit'>0</span></h3>
                                      <span id='detail_card'>Pending Re-submission</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="card-box bg-green">
                                    <div class="inner">
                                      <h3><span id='total_approved'>0</span></h3>
                                      <span id='detail_card'>Approved</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <hr>
                      <div class="float-right">
                        <button type='submit' class='btn btn-info btn-flat'><i class='fas fa-search'></i> Search</button>
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
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Material Verification | Inspection RFI List <strong>- <?= $text_inspection ?></strong></h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive overflow-auto">
                  <table id="table_material" class="table table-hover text-center" style="width:100%">
                    <thead class="bg-gray-table">
                      <th>Project</th>
                      <!-- <th>Workpack No.</th> -->
                      <th>Submission No.</th>
                      <th>Drawing No.</th>
                      <th>Test Package No.</th>
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
  function autofilter() {
    $('#form-filter').submit();
  }
  $(document).ready(function() {

    $('.workpack_no').autocomplete({
      source: "<?php echo base_url(); ?>material_verification/autocomplete_workpack_no",
      autoFocus: true,
      classes: {
        "ui-autocomplete": "highlight"
      }
    });

    find_module_by_project($("select[name=project_id]"), '<?= $this->user_cookie[10] ?>')

    $("#table_material").DataTable({
      processing: true,
      serverSide: true,
      order: [],
      ajax: {
        url: "<?= site_url($serverside) ?>",
        type: "POST",
        data: {
          project_id: "<?= $project_id ?>",
          discipline: "<?= $discipline ?>",
          module: "<?= $module ?>",
          module_type: "<?= $module_type ?>",
          revision_status: "<?= $revision_status ?>",
          status_inspection: "<?= $status_inspection ?>",
          submission_id: "<?= $submission_id ?>",
          company_id: "<?= $company_id ?>",
          workpack_no: "<?= $workpack_no ?>",
          deck_elevation: "<?= $this->input->post('deck_elevation') ?>"
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

  $('.search_submission_id').autocomplete({
    source: "<?php echo base_url(); ?>material_verification/autocomplete_submission_id",
    autoFocus: true,
    classes: {
      "ui-autocomplete": "highlight"
    }
  });

  function load_card_info() {

    $.ajax({
      url: "<?= site_url('material_verification/detail_submission_ajax') ?>",
      type: "POST",
      dataType: "JSON",
      data: {
        status_internal: "<?= $revision_status ?>"
      },
      success: function(data) {
        $("#total_pending").text(`${data.data.total_pending} Piecemark(s)`)
        $("#total_rejected").text(`${data.data.total_rejected} Piecemark(s)`)
        $("#total_reject_pending_resubmit").text(`${data.data.total_pending_resubmit} Piecemark(s)`)
        $("#total_approved").text(`${data.data.total_approved} Piecemark(s)`)
      }
    })
  }

  load_card_info()
</script>