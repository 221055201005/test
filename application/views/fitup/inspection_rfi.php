<style>
th {
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
<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow my-3 rounded-0">
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
                        <option value=''>---</value>
                        <?php foreach ($project_list as $key => $value): ?>
                        <option value="<?= $value['id'] ?>"
                          <?= ($project_id == $value['id'] ? 'selected' : "") ?>>
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
                    <label for="" class="col-xl-3 col-form-label text-muted"> Type of Module</label>
                    <div class="col-xl">
                      <?php //test_var($type_of_module); ?>
                      <select name="type_of_module" class="custom-select">
                        <option value="">---</option>
                        <?php foreach ($type_of_module_list as $key => $value): ?>
                        <option value="<?= $value['id'] ?>" <?= $value['id'] == $type_of_module ? 'selected' : '' ?>>
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

                 
                <div class="col-md-6 d-none">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label text-muted">Workpack Number</label>
                    <div class="col-xl">
                      <input type="text" name="workpack_no" class="form-control workpack_no"
                        placeholder="Work Pack Number" value="<?= @$workpack_no ? @$workpack_no : '' ?>">
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-xl-3 col-form-label text-muted">Deck Elevation / Service Line</label>
                    <div class="col-xl">
                    <select class="form-control" name="deck_elevation" >
                      <option value="">---</option>
                      <?php foreach($deck_list as $key => $value){ ?>
                        <option value="<?= $value['id']; ?>" <?= ($value['id'] == @$deck_elevation ? "selected" : "") ?>><?= $value['name']; ?></option>
                      <?php } ?>
                    </select>
                    </div>
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Company </label>
                    <div class="col-xl">
                      <select class="form-control select2" name="company_id"   onchange='autofilter(this);'>
                        <option value=''>~ Choose ~</option>
                        <?php foreach($company_list as $key => $value){ ?>
                          <?php if(in_array($value['id_company'], $this->user_cookie[14])){ ?>

                            <option value='<?= $value['id_company'] ?>' <?= ($value['id_company'] == @$company_id ? 'selected' : '') ?>><?= $value['company_name'] ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">

                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <div class="col-xl">
                      <?php if(!$revision_status){ ?>
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
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Fit-Up | Inspection RFI List</h6>
            <?php //test_var($get, 1) ?>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive overflow-auto">
                  <table id="table_material" class="table table-hover text-center" style="width:100%">
                  <thead class="bg-gray-table">
                      <th>Project</th>

                      <!-- SUBLIME IS GOOD -->
                      <!-- <th>Workpack No.</th> -->
                      <th>Submission No.</th>
                      <th>Drawing No.</th>

                      <th>Test Package No.</th>


                      <th>Discipline</th>
                      <th>Module</th>
                      <th>Type of Module</th>
                      <th>Company</th>
                      <th>Deck Elevation / Service Line</th>
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

    $('#total_pending').load('<?= base_url(); ?>fitup/load_status_submission/<?= 
      strtr($this->encryption->encrypt((isset($project_id) 
        ? $project_id 
        : 999)),'+=/', '.-~') 
      ?>/<?= strtr($this->encryption->encrypt("1"),'+=/', '.-~') ?>/<?= 
      strtr($this->encryption->encrypt($this->user_cookie[11]),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt($mode),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt($mode),'+=/', '.-~') ?>');

    $('#total_approved').load('<?= base_url(); ?>fitup/load_status_submission/<?= 
      strtr($this->encryption->encrypt((isset($project_id) 
        ? $project_id 
        : 999)),'+=/', '.-~') 
      ?>/<?= strtr($this->encryption->encrypt("3"),'+=/', '.-~') ?>/<?= 
      strtr($this->encryption->encrypt($this->user_cookie[11]),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt($mode),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt($mode),'+=/', '.-~') ?>');

    $('#total_rejected').load('<?= base_url(); ?>fitup/load_status_submission/<?= 
      strtr($this->encryption->encrypt((isset($project_id) 
        ? $project_id 
        : 999)),'+=/', '.-~') 
      ?>/<?= strtr($this->encryption->encrypt("2"),'+=/', '.-~') ?>/<?= 
      strtr($this->encryption->encrypt($this->user_cookie[11]),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt($mode),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt($mode),'+=/', '.-~') ?>');

    $('#total_reject_pending_resubmit').load('<?= base_url(); ?>fitup/load_status_submission/<?= 
      strtr($this->encryption->encrypt((isset($project_id) 
        ? $project_id 
        : 999)),'+=/', '.-~') 
      ?>/<?= strtr($this->encryption->encrypt("2"),'+=/', '.-~') ?>/<?= 
      strtr($this->encryption->encrypt($this->user_cookie[11]),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt("pending"),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt($mode),'+=/', '.-~') ?>');

  $('.workpack_no').autocomplete({
    source: "<?php echo base_url(); ?>fitup/autocomplete_workpack_no",
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
        revise: "<?= $revise ?>",
        project_id: "<?= $project_id ?>",
        discipline: "<?= $discipline ?>",
        module: "<?= $module ?>",
        module_type: "<?= $type_of_module ?>",
        revision_status: "<?= $revision_status ?>",
        status_inspection: "<?= $status_inspection ?>",
        submission_id: "<?= $submission_id ?>",
        company_id: "<?= $company_id ?>",
        workpack_no: "<?= $workpack_no ?>",
        mode: "<?= $mode ?>",
        deck_elevation: "<?= $deck_elevation ?>",
      }
    }
  })
})

function find_module_by_project(select, mod_id = null) {
  var project_id = $(select).val()
  if (project_id) {
    $('.module').removeAttr('disabled')
    $.ajax({
      url: "<?= site_url('fitup/find_module_by_project') ?>",
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