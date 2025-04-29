<div id="content" class="container-fluid">

  <style type="text/css">
    .disabled-effect {
      pointer-events: none;
      opacity: 0.5;
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

  <?php error_reporting(0) ?>
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <a class="btn btn-primary" data-toggle="collapse" href="#collapseButton" role="button" aria-expanded="false" aria-controls="collapseButton">Filter &nbsp; <i class="fas fa-angle-double-down"></i><i class="fas fa-angle-double-up"></i></a>
        </div>
        <div class="collapse <?= $this->input->get() ? 'show' : '' ?>" id="collapseButton">
          <div class="card-body bg-white overflow-auto">
            <form action="" method="GET">
              <div class="row">
                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
                    <div class="col-xl">
                      <select class="form-control" name="project" id="project_js">
                        <?php if ($this->permission_cookie[0] == 1) { ?>
                          <option value="">---</option>
                          <?php foreach ($project_list as $key => $value) : ?>
                            <option value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                          <?php endforeach; ?>
                        <?php } else { ?>
                          <?php foreach ($project_list as $key => $value) : ?>
                            <?php if (in_array($value['id'], $this->user_cookie[13])) { ?>
                              <option value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                            <?php } ?>
                          <?php endforeach; ?>
                        <?php } ?>
                      </select>
                      <script type="text/javascript">
                        var project_js

                        function save_project() {
                          project_js = $('#project_js').val()
                          console.log(project_js)
                        }
                      </script>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Drawing Type</label>
                    <div class="col-xl">
                      <select class="form-control" name="drawing_type" id="drawing_type_js">
                        <option value="">---</option>
                        <option value="1" <?php echo (@$get['drawing_type'] == '1' ? 'selected' : '') ?> onclick="save_drawing_type()">GA</option>
                        <option value="2" <?php echo (@$get['drawing_type'] == '2' ? 'selected' : '') ?> onclick="save_drawing_type()">Assembly</option>
                        <option value="3" <?php echo (@$get['drawing_type'] == '3' ? 'selected' : '') ?> onclick="save_drawing_type()">Weldmap</option>
                      </select>
                      <script type="text/javascript">
                        var drawing_type_js

                        function save_drawing_type() {
                          drawing_type_js = $('#drawing_type_js').val()
                          console.log(drawing_type_js)
                        }
                      </script>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                    <div class="col-xl">
                      <select class="form-control" name="discipline" id="discipline_js">
                        <option value="">---</option>
                        <?php foreach ($discipline_list as $key => $value) : ?>
                          <option onclick="save_discipline()" value="<?php echo $value['id'] ?>" <?php echo (@$get['discipline'] == $value['id'] ? 'selected' : '') ?>>
                            <?php echo $value['discipline_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                      <script type="text/javascript">
                        var discipline_js

                        function save_discipline() {
                          discipline_js = $('#discipline_js').val()
                          console.log(discipline_js)
                        }
                      </script>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Module</label>
                    <div class="col-xl">
                      <select class="form-control" name="module" id="module_js">
                        <option value="">---</option>
                        <?php foreach ($module_list as $key => $value) : ?>
                          <option onclick="save_module()" value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$get['module'] == $value['mod_id'] ? 'selected' : '') ?>>
                            <?php echo $value['mod_desc'] ?></option>
                        <?php endforeach; ?>
                      </select>
                      <script type="text/javascript">
                        var module_js

                        function save_module() {
                          module_js = $('#module_js').val()
                          console.log(module_js)
                        }
                      </script>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type Module</label>
                    <div class="col-xl">
                      <select class="form-control" name="type_of_module">
                        <option value="">---</option>
                        <?php foreach ($type_of_module_list as $key => $value) : ?>
                          <option onclick="save_type_module()" value="<?php echo $value['id'] ?>" <?php echo (@$get['type_of_module'] == $value['id'] ? 'selected' : '') ?>>
                            <?php echo $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                      <script type="text/javascript">
                        var type_module_js

                        function save_type_module() {
                          type_module_js = $('#type_module_js').val()
                          console.log(type_module_js)
                        }
                      </script>
                    </div>
                  </div>
                </div>
                <div class="col-6 d-none">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Document</label>
                    <div class="col-xl">
                      <input type="text" class="form-control autocomplete_doc" name="drawing_no" value="<?php echo @$get['drawing_no'] ?>">
                    </div>
                  </div>
                </div>

                <div class="col-6 d-none">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Weldmap</label>
                    <div class="col-xl">
                      <input type="text" class="form-control autocomplete_wm" name="drawing_wm" value="<?php echo @$get['drawing_wm'] ?>">
                    </div>
                  </div>
                </div>
                <!-- <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status</label>
                    <div class="col-xl">
                      <select class="form-control" name="status_inspection">
                        <option value="">---</option>
                        <option value="3" <?= $get['status_inspection'] == 3 ? 'selected' : '' ?>>Ready</option>
                        <option value="6" <?= $get['status_inspection'] == 6 ? 'selected' : '' ?>>Rejected</option>
                        <option value="7" <?= $get['status_inspection'] == 7 ? 'selected' : '' ?>>Approved</option>
                      </select>
                    </div>
                  </div>
                </div> -->
              </div>

              <div class="row">
                <!-- <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Class</label>
                    <div class="col-xl">
                      <select class="form-control" name="class">
                        <option>---</option>
                        <?php foreach ($class_list as $key => $value) { ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $get['class'] ? 'selected' : '' ?>><?= $value['class_code'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div> -->
                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Company</label>
                    <div class="col-xl">
                      <select class="form-control" name="id_company">
                        <option value="">---</option>
                        <?php foreach ($company as $key => $value) : ?>
                          <option value="<?php echo $value['id_company'] ?>" <?php echo (@$get['id_company'] == $value['id_company'] ? 'selected' : '') ?>><?php echo $value['company_name'] ?></option>
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
  </div>

  <?php //if(isset($get['submit'])): 
  ?>
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
          <form method="POST" action="<?php echo base_url() ?>visual/submit_to_client_postponereoffer">

            <div class="row d-none">
              <div class="col-md-12">
                <strong><i>Inspection Detail</i></strong>
              </div>
              <div class="col-md-4 mt-2">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Inspector Name</label>
                  <div class="col-xl">
                    <select name="inspector_id" class="select2" style="width: 100%">
                      <option value="">---</option>
                      <?php foreach ($user_list as $key => $value) : ?>
                        <option value="<?= $value['id_user'] ?>"><?= $value['full_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    <!-- <input type="text" name="inspector_id" class="form-control" onfocus="autocomplete_inspector(this)"  > -->
                  </div>
                </div>
              </div>
              <div class="col-md-12"></div>
              <div class="col-md-4">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Inspect Date</label>
                  <div class="col-xl">
                    <input type="date" name="inspect_date" class="form-control" value="<?= date('Y-m-d') ?>">
                  </div>
                </div>
              </div>
              <div class="col-md-12"></div>
              <div class="col-md-4">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Inspect Time</label>
                  <div class="col-xl">
                    <input type="time" name="inspect_time" class="form-control" value="<?= date('H:i:s') ?>">
                  </div>
                </div>
              </div>

            </div>
            <hr class="d-none">

            <div class="overflow-auto">
              <table class="table table-hover text-center" width="100%" id="table_client">
                <thead class="bg-gray-table">
                  <tr>
                    <th>Project</th>
                    <th>Company</th>
                    <th>Report No.</th>
                    <th>Drawing</th>
                    <th>Discipline</th>
                    <th>Module</th>
                    <th>Type of Module</th>
                    <th>Deck Elevation</th>
                    <th>Status</th>
                    <th>Invitation Type</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $juml = 0;
                  foreach ($list as $key => $value) :
                  ?>
                    <tr>
                      <td><?= $project_list[$value['project_code']]['project_name'] ?></td>
                      <td><?= $company_arr[$value['company_id']]['company_name'] ?></td>
                      <td>
                        <?php if ($value["project_code"] == 21) { ?>
                          <?php echo $master_report_number_deck[$value['project_code']][$value["company_id"]][$value['discipline']][$value['type_of_module']][$value["deck_elevation"]]['visual_report'] . $value['report_number']; ?>
                        <?php } else { ?>
                          <?php echo $master_report_number[$value['project_code']][$value["company_id"]][$value['discipline']][$value['type_of_module']]['visual_report'] . $value['report_number']; ?>
                        <?php } ?>
                      </td>
                      <td class="text-center align-middle">
                        <?= $value['drawing_no'] ?>
                      </td>
                      <td class="text-center align-middle">
                        <?= $master_discipline[$value['discipline']]['discipline_name'] ?>
                      </td>
                      <td class="text-center align-middle">
                        <?= $master_module[$value['module']]['mod_desc'] ?>
                      </td>
                      <td class="text-center align-middle">
                        <?= $master_type_of_module[$value['type_of_module']]['code'] ?>
                      </td>
                      <td class="text-center align-middle">
                        <?= $deck_elevation_list[$value['deck_elevation']]['name'] ?>
                      </td>
                      <?php
                      $text_status            = '';
                      if ($value['total_reject_client'] > 0 && $value['total_pending_client'] == 0) {
                        $text_status          = '<span class="badge badge-pill badge-danger">Rejected By Client</span>';
                      } elseif ($value['total_rejected_client']) {
                        $text_status          = '<span class="badge badge-pill badge-danger">Rejected By Client</span>';
                      } elseif ($value['total_acc_comment_client']) {
                        $text_status          = '<span class="badge badge-pill badge-primary">Accepted & Release With Comments</span>';
                      } elseif ($value['total_postpone_client']) {
                        $text_status          = '<span class="badge badge-pill badge-info">Postponed By Client</span>';
                      } elseif ($value['total_reoffer_client']) {
                        $text_status          = '<span class="badge badge-pill badge-warning">Re-Offer By Client</span>';
                      } elseif ($value['total_returned'] > 0 && $value['total_returned']) {
                        $text_status          = '<span class="badge badge-pill badge-dark">Void</span>';
                      } elseif ($value['total_returned'] > 0 && $value['total_returned'] != $value['total_joint']) {
                        $text_status          = '<span class="badge badge-pill badge-warning">Re-Offer By Client</span>';
                      } elseif ($value["requested_for_update"] == 1) {
                        $text_status          = '<span class="badge badge-pill badge-info">On Revise Progress</span>';
                      } else {
                        $text_status          = '<span class="badge badge-pill badge-warning">Pending QC Approval</span>';
                      }
                      ?>
                      <td class="text-center align-middle"><?= $text_status ?></td>
                      <td class="text-center align-middle">
                        <?php
                        if ($value['status_invitation'] == 0) {
                          echo "<span class='badge badge-primary'>Invitation Witness</span>";
                        } elseif ($value['status_invitation'] == 1) {
                          echo "<span class='badge badge-info'>Notification Activity</span>";
                        }
                        ?>
                      </td>
                      <td class="text-center align-middle">
                        <div class="btn-group">
                          <?php if ($value["project_code"] == 21) { ?>
                            <?php $renox = $master_report_number_deck[$value['project_code']][$value["company_id"]][$value['discipline']][$value['type_of_module']][$value["deck_elevation"]]['visual_report'] . $value['report_number'] . ' Rev.' . str_pad($value['postpone_reoffer_no'], 2, 0, STR_PAD_LEFT); ?>
                          <?php } else { ?>
                            <?php $renox = $master_report_number[$value['project_code']][$value["company_id"]][$value['discipline']][$value['type_of_module']]['visual_report'] . $value['report_number'] . ' Rev.' . str_pad($value['postpone_reoffer_no'], 2, 0, STR_PAD_LEFT); ?>
                          <?php } ?>
                          <button type="button" onclick="re_transmit_data(this,'<?= $value['report_number'] ?>', <?= $value['discipline'] ?>,<?= $value['module'] ?>,<?= $value['type_of_module'] ?>,<?= $this->user_cookie[8] ?>,<?= $value['postpone_reoffer_no'] ?>,'<?= $renox ?>', '<?=
                                                                                                                                                                                                                                                                                          $value['drawing_no'] . '_' .
                                                                                                                                                                                                                                                                                            $value['discipline'] . '_' .
                                                                                                                                                                                                                                                                                            $value['module'] . '_' .
                                                                                                                                                                                                                                                                                            $value['type_of_module'] . '_' .
                                                                                                                                                                                                                                                                                            $value['report_number'] . '_' .
                                                                                                                                                                                                                                                                                            $value['status_inspection_min'] . '_' .
                                                                                                                                                                                                                                                                                            $value['postpone_reoffer_no']
                                                                                                                                                                                                                                                                                          ?>',<?= $value['deck_elevation'] ?>)" class="btn btn-success" <?= !in_array($value['status_inspection_min'], [6, 9, 10, 11]) ? 'disabled title="On Revise Progress"' : '' ?>><i class="fas fa-paper-plane"></i> Re - Transmit</button>
                          <a target="_blank" href="<?= site_url('visual/detail_inspection/' . $value['report_number'] . '/client_reoffer/' . $value['drawing_no'] . '/NULL/' . $value['postpone_reoffer_no']) ?>" class="btn btn-primary"><i class="fas fa-list"></i> Detail</a>
                        </div>
                      </td>
                    </tr>

                  <?php $juml++;
                  endforeach; ?>
                </tbody>
              </table>
            </div>
            <br>
            <div class="col-md-4 d-none">
              <div class="row mb-1">
                <div class="col-md-12">
                  <button type="submit" name="submit" value="draft" class="btn btn-primary"><i class='fas fa-paper-plane'></i> Transmit</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php //endif; 
  ?>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $("#table_client").DataTable()
  })

  function re_transmit_data(event, report_no, discipline, module, type_of_module, project, status_inspection, report_number_actual, identifier, deck_elevation) {
    let url = "<?= site_url('visual/re_transmit_data/') ?>" + report_no + '/' + discipline + '/' + module + '/' + type_of_module + '/' + project + '/' + status_inspection + '/' + identifier + '/' + deck_elevation

    $("#modal").modal({
      show: true,
      keyboard: false,
      backdrop: "static"
    }).find('.modal-body').load(url)
    $('.modal-title').html(`<strong>${report_number_actual} - </strong> Re - Transmit Data`)
    $('.modal-dialog').addClass('modal-lg')
  }
  $("select[name=module]").chained("select[name=project]");
</script>