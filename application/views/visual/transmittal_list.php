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

  <?php
  error_reporting(0);
  ?>
  <div class="row d-none">
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
                        <option value="">---</option>
                        <?php if ($this->permission_cookie[0] == 1) { ?>
                          <?php foreach ($project_list as $key => $value) : ?>
                            <option value="<?php echo $value['id'] ?>" <?php echo (@$this->user_cookie[10] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                          <?php endforeach; ?>
                        <?php } else { ?>
                          <?php foreach ($project_list as $key => $value) : ?>
                            <?php if ($this->user_cookie[10] == $value['id']) { ?>
                              <option value="<?php echo $value['id'] ?>" <?php echo ($this->user_cookie[10] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                            <?php } ?>
                          <?php endforeach; ?>
                        <?php } ?>
                      </select>
                      <script type="text/javascript">
                        var project_js

                        function save_project() {
                          project_js = $('#project_js').val()
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
                      <select class="form-control reject_requi" name="discipline" id="discipline_js">
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
                        }
                      </script>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Module</label>
                    <div class="col-xl">
                      <select class="form-control reject_requi" name="module" id="module_js">
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
                      <select class="form-control reject_requi" name="type_of_module">
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
                        }
                      </script>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Document</label>
                    <div class="col-xl">
                      <input type="text" class="form-control autocomplete_doc reject_requi" name="drawing_no" value="<?php echo @$get['drawing_no'] ?>" required>
                      <span style="color:red;font-weight: bold;font-style: italic;">Please choice Drawing Number</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Weldmap</label>
                    <div class="col-xl">
                      <input type="text" class="form-control autocomplete_wm" name="drawing_wm" value="<?php echo @$get['drawing_wm'] ?>">
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status</label>
                    <div class="col-xl">
                      <select class="form-control" name="status_inspection" onclick="check_reject_transmit(this)">
                        <option value="">---</option>
                        <option value="3" <?= $get['status_inspection'] == 3 ? 'selected' : '' ?>>Ready</option>
                        <option value="6" <?= $get['status_inspection'] == 6 ? 'selected' : '' ?>>Rejected</option>
                        <option value="7" <?= $get['status_inspection'] == 7 ? 'selected' : '' ?>>Approved</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
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
                </div>
                <div class="col-6">
                  <script type="text/javascript">
                    function check_reject_transmit(ini) {
                      var setatus = $(ini).val()
                      if (setatus == 6) {
                        $('.report_number').removeClass('d-none')
                        $('.reject_requi').attr('required', true)
                        $('.reno').attr('disabled', false)
                      } else {
                        $('.report_number').addClass('d-none')
                        $('.reject_requi').attr('required', false)
                        $('.reno').attr('disabled', true)
                      }
                    }
                  </script>
                  <div class="form-group row <?= $get['status_inspection'] == 6 ? '' : 'd-none' ?> report_number">
                    <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Report Number</label>
                    <div class="col-xl">
                      <input type="text" name="report_number" class="form-control reject_requi reno" value="<?= $get['report_number'] ?>" placeholder="Only last 6 Digit Number">
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

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
          <?php if ($get['status_inspection'] != 6) { ?>
            <form method="POST" action="<?php echo base_url() ?>visual/submit_to_client" id="form_submit">
              <!-- Hidden data -->
              <input type="hidden" name="deck_elevation" class="form-control" value="<?= $deck ?>">
              <!-- =========== -->
              <div class="row">
                <div class="col-md-12">
                  <strong><i>Inspection Detail</i></strong>
                </div>
                <?php if ((($list[0]['discipline'] == 1 and in_array($this->user_cookie[0], $this->transmitter_smop))) and $list[0]['company_id'] == 13) { ?>
                  <div class="col-md-8 mt-2">
                    <div class="form-group row">
                      <label for="" class="col-xl-3 col-form-label text-muted">Report Number</label>
                      <div class="col-xl">
                        <input type="number" name="custom_report_number" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12"></div>
                <?php } ?>

                <div class="col-md-8 mt-2">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Inspector Name</label>
                    <div class="col-xl">
                      <select name="inspector_id" class="select2" style="width: 100%" required>
                        <option value="">---</option>
                        <?php foreach ($user_list as $key => $value) : ?>
                          <option value="<?= $value['id_user'] ?>"><?= $value['full_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-8">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Inspect Date</label>
                    <div class="col-xl">
                      <input type="date" name="inspect_date" class="form-control" value="<?= date('Y-m-d') ?>" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-8">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Inspect Time</label>
                    <div class="col-xl">
                      <input type="time" name="inspect_time" class="form-control" value="<?= date('H:i:s') ?>" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-8">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Invitation Type</label>
                    <div class="col-xl">
                      <select name="status_invitation" class="select2" style="width:100%" required onchange="validateTrans(this)">
                        <option>---</option>
                        <option value="0">Invitation Witness</option>
                        <option value="1">Notification Activity</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-8">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Legend Inspection Authority AS PER ITP</label>
                    <div class="col-xl">
                      <select name="legend_inspection_auth[]" class="form-control select2" style="width:100%" required multiple="">
                        <option value="1">Hold Point</option>
                        <option value="2">Witness</option>
                        <option value="3">Monitoring</option>
                        <option value="4">Review</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-12"></div>
                <div class="col-md-8">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">GA/AS Revision No.</label>
                    <div class="col-md-2">
                      <select name="document_rev_no" class="form-control select2" style="width:100%" required onchange="changeLink(this)">
                        <?php foreach ($revision_gaas as $key => $value) { ?>
                          <option value="<?= $value ?>"><?= $value ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"></label>
                    <div class="col-md-8">
                      <a href="<?= $link_revision_gaas[0]['link'] ?>" class="gaas_link"><?= $link_revision_gaas[0]['drawing_no'] . ' Rev. ' . $link_revision_gaas[0]['revision_no'] ?></a>
                    </div>
                    <script type="text/javascript">
                      function changeLink(thiss) {
                        var revi = $(thiss).val()
                        console.log(revi)

                        $(".gaas_link").attr("href", "<?= $link_revision_gaas[0]['link_buntung'] ?>" + revi)
                        $(".gaas_link").text("<?= $link_revision_gaas[0]['drawing_no'] ?> Rev. " + revi)
                      }
                    </script>
                  </div>
                </div>

                <div class="col-md-12"></div>
                <div class="col-md-8">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Weld Map Revision No.</label>
                    <div class="col-md-2">
                      <select name="weld_map_rev_no" class="form-control select2" style="width:100%" required onchange="changeLinkWM(this)">
                        <?php foreach ($revision_weldmap as $key => $value) { ?>
                          <option value="<?= $value ?>"><?= $value ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <?php //test_var($link_revision_weldmap); 
                  ?>
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"></label>
                    <div class="col-md-8">
                      <a href="<?= $link_revision_weldmap[0]['link'] ?>" class="wm_link"><?= $link_revision_weldmap[0]['drawing_no'] . ' Rev. ' . $link_revision_weldmap[0]['revision_no'] ?></a>
                    </div>
                    <script type="text/javascript">
                      function changeLinkWM(thiss) {
                        var revi = $(thiss).val()
                        console.log(revi)

                        $(".wm_link").attr("href", "<?= $link_revision_weldmap[0]['link_buntung'] ?>" + revi)
                        $(".wm_link").text("<?= $link_revision_weldmap[0]['drawing_no'] ?> Rev. " + revi)
                      }
                    </script>
                  </div>
                </div>

                <div class="col-md-12"></div>
                <div class="col-md-8">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Remarks</label>
                    <div class="col-xl">
                      <textarea name="invitation_remarks" class="form-control"></textarea>
                    </div>
                  </div>
                </div>

                <div class="col-md-12"></div>
                <div class="col-md-8 div_request_report_number">
                  <div class="form-group row d-none">
                    <label for="" class="col-xl-3 col-form-label text-muted"><b><i>Request Report Number Only</i></b></label>
                    <div class="col-xl">
                      <div class="form-check">
                        <input type="checkbox" name="request_report_number" style="width: 20px !important; height: 20px !important;" value="1" class="request_report_number" onclick="openDrawing(this)">

                        <span class="badge badge-warning">
                          These Joint will not be Transmitted, only receive Report Number for NDT Request!
                        </span>
                        <script type="text/javascript">
                          function openDrawing(event) {

                            var val = event.checked
                            // console.log(val)

                            if (val == true) {
                              $('.status_drawing_x').removeClass("d-none");
                              $('.status_drawing_x').prop("disabled", false);
                              $('.status_drawing_0').removeClass("d-none");
                              $('.status_drawing_0').prop("disabled", false);
                              $('.status_drawing_1').removeClass("d-none");
                              $('.status_drawing_1').prop("disabled", false);
                            } else {
                              $('.status_drawing_x').addClass("d-none");
                              $('.status_drawing_x').prop("disabled", true);
                              $('.status_drawing_0').addClass("d-none");
                              $('.status_drawing_0').prop("disabled", true);
                              $('.status_drawing_1').addClass("d-none");
                              $('.status_drawing_1').prop("disabled", true);
                            }

                          }
                        </script>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <br>
                  <span class="btn btn-primary" id="thicked">
                    <i class="fas fa-clipboard-check"></i><b> 0</b> Item thicked
                  </span><i><b class="text-danger">&nbsp;&nbsp;*Max 50 Item Thicked Allowed</b></i>
                </div>

              </div>
            <?php } else { ?>
              <form method="POST" action="<?php echo base_url() ?>visual/submit_to_client_repair">
                <div class="row">
                  <div class="col-md-12">
                    <?php //test_var($list, 1) 
                    ?>
                    <strong><i>Inspection Detail</i></strong>
                  </div>
                  <div class="col-md-4 mt-2">
                    <div class="form-group row">
                      <label for="" class="col-xl-3 col-form-label text-muted">Inspector Name</label>
                      <div class="col-xl">
                        <select name="inspector_id" class="select2" style="width: 100%">
                          <option value="">---</option>
                          <?php foreach ($user_list as $key => $value) : ?>
                            <option value="<?= $value['id_user'] ?>" <?= $value['id_user'] == $list[0]['inspector_id'] ? 'selected' : '' ?>><?= $value['full_name'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12"></div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label for="" class="col-xl-3 col-form-label text-muted">Inspect Date</label>
                      <div class="col-xl">
                        <input type="date" name="inspect_date" class="form-control" value="<?= DATE('Y-m-d', strtotime($list[0]['time_inspect'])) ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12"></div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label for="" class="col-xl-3 col-form-label text-muted">Inspect Time</label>
                      <div class="col-xl">
                        <input type="time" name="inspect_time" class="form-control" value="<?= DATE('H:i:s', strtotime($list[0]['time_inspect'])) ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12"></div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label for="" class="col-xl-3 col-form-label text-muted">Invitation Type</label>
                      <div class="col-xl">
                        <select name="status_invitation" class="select2" style="width:100%" onchange="validateTrans(this)">
                          <option>---</option>
                          <option value="0" <?= $list[0]['status_invitation'] == 0 ? 'selected' : '' ?>>Invitation Witness</option>
                          <option value="1" <?= $list[0]['status_invitation'] == 1 ? 'selected' : '' ?>>Notification Activity</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12"></div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label for="" class="col-xl-3 col-form-label text-muted">Legend Inspection Authority AS PER ITP</label>
                      <div class="col-xl">
                        <select name="legend_inspection_auth[]" class="form-control select2" style="width:100%" multiple="">
                          <option value="1" <?= in_array(1, (explode(';', $list[0]['legend_inspection_auth']))) ? 'selected' : '' ?>>Hold Point</option>
                          <option value="2" <?= in_array(2, (explode(';', $list[0]['legend_inspection_auth']))) ? 'selected' : '' ?>>Witness</option>
                          <option value="3" <?= in_array(3, (explode(';', $list[0]['legend_inspection_auth']))) ? 'selected' : '' ?>>Monitoring</option>
                          <option value="4" <?= in_array(4, (explode(';', $list[0]['legend_inspection_auth']))) ? 'selected' : '' ?>>Review</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>

              <hr>
              <style type="text/css">
                .warna-alert {
                  background-color: #FFF3CD !important;
                }
              </style>
              <div class="overflow-auto">
                <table class="table table-hover text-center dataTable" width="100%">
                  <thead class="bg-gray-table">
                    <tr>
                      <th rowspan="2"></th>
                      <th rowspan="2">Submission ID. / Report No.</th>

                      <!-- <th rowspan="2">Workpack No.</th> -->
                      <th rowspan="2">Company</th>

                      <?= $get['status_inspection'] == 6 ? '<th rowspan="2">Report No.</th>' : '' ?>
                      <th rowspan="2">Document No.</th>
                      <th rowspan="2">Drawing Weld Map</th>
                      <th rowspan="2">Joint No.</th>

                      <th rowspan="2">Deck Elevation / Service Line</th>
                      <th rowspan="2">Class</th>

                      <th rowspan="2">Weld Type</th>

                      <th rowspan="2">WPS No.</th>

                      <th rowspan="2">Cons/Lot No.</th><!-- input -->
                      <th rowspan="1" colspan="2">Weld Process</th><!-- input -->

                      <th rowspan="2">DIA (INCH)</th>
                      <th rowspan="2">THK (MM)</th>

                      <th rowspan="2" style="min-width: 80px !important">Weld Length (MM)</th><!-- input -->
                      <th rowspan="2">Weld Date</th><!-- input -->

                      <th rowspan="1" colspan="3">Inspection</th><!-- input -->

                      <!-- <th rowspan="1" colspan="4" style="min-width: 200px !important">NDT Req.</th> -->

                      <th rowspan="2">Status</th>
                      <th rowspan="2">Drawing Status</th>
                    </tr>
                    <tr>
                      <th>R/H</th>
                      <th>F/C</th>

                      <th>By</th>
                      <th>Date</th>
                      <th>Location</th>

                      <!-- <th>MT</th>
                  <th>UT</th>
                  <th>PT</th>
                  <th>RT</th> -->

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $juml = 0;
                    ?>
                    <?php foreach ($list as $key => $value) : ?>
                      <?php
                      if ($master_drawing_norev[$value['drawing_no']]['status'] == 2 and $master_drawing_norev[$value['drawing_wm']]['status'] == 2) {
                        $status_drawing = 0;
                      } elseif ($master_drawing_norev[$value['drawing_no']] and $master_drawing_norev[$value['drawing_wm']]) {
                        $status_drawing = 0;
                      } else {
                        $status_drawing = x;
                      }
                      ?>

                      <tr>
                        <td style="vertical-align: middle;">
                          <div class="custom-control custom-checkbox mr-sm-2 validate status_drawing_<?= $status_drawing ?>">
                            <input type="checkbox" class="validate custom-control-input cb<?= $key ?> id_<?= $value['drawing_no'] ?>_<?= $value['discipline'] ?>_<?= $value['module'] ?>_<?= $value['drawing_wm'] ?>_<?= $value['report_number'] ?> cball" id="customControlAutosizing<?= $key ?>" name="id[<?= $key ?>]" value='<?php echo $value['id_visual'] ?>' onclick='enable_edit("<?= $key ?>", this, "id_<?= $value['drawing_no'] ?>_<?= $value['discipline'] ?>_<?= $value['module'] ?>_<?= $value['drawing_wm'] ?>_<?= $value['report_number'] ?>")'>
                            <label class="custom-control-label" for="customControlAutosizing<?= $key ?>"></label>
                          </div>

                          <?php if ($value['status_inspection'] == 6) { ?>
                            <input type="hidden" name="reubmit_reject_client[<?= $key ?>]" value="1">
                          <?php } ?>
                        </td>

                        <td style="vertical-align: middle;">
                          <input type="hidden" name="report_number[<?= $key ?>]" value="<?= $value['report_number'] ?>">
                          <?= $value['submission_id'] ?>
                          <?php if ($value['report_number'] != '') { ?>
                            <hr>
                            <span class="badge badge-warning">
                              <?= 'SOF-OCP-SMO-' . strtoupper($type_of_module_list[$value['type_of_module']]['code']) . '-' . strtoupper($discipline_list[$value['discipline']]['initial']) . '-RFI-VIS-' . $value['report_number'] ?>
                            </span>
                            <b style="font-size: .7em !important"><i>Report Number Already Requested Before!</i></b>
                          <?php } ?>
                        </td>

                        <!-- <td style="vertical-align: middle;"><?= $workpack_arr[$value['id_workpack']]['workpack_no'] ?></td> -->
                        <td style="vertical-align: middle;"><?= $company_arr[$workpack_arr[$value['id_workpack']]['company_id']]['company_name'] ?></td>

                        <?php if ($get['status_inspection'] == 6) { ?>
                          <td style="vertical-align: middle;">
                            <?= 'SOF-OCP-SMO-' . strtoupper($type_of_module_list[$value['type_of_module']]['code']) . '-' . strtoupper($discipline_list[$value['discipline']]['initial']) . '-RFI-VIS-' . $value['report_number'] ?>
                          </td>
                        <?php } ?>

                        <td style="vertical-align: middle;">
                          <input type='hidden' name='id_joint_template[<?= $key ?>]' value='<?php echo $value['id_joint']; ?>'>
                          <?= $value['drawing_no'] . ' (Rev. ' . $value['rev_ga_template'] . ')' ?>
                        </td>

                        <td style="vertical-align: middle;">
                          <?php echo $value['drawing_wm'] . ' (Rev. ' . $value['rev_wm_template'] . ')' ?>
                        </td>

                        <td style="vertical-align: middle;">
                          <?php echo $value['joint_no'] . ($value['revision'] > 0 ? '(' . $value['revision_category'] . $value['revision'] . ')' : '') ?>
                        </td>

                        <td style="vertical-align: middle;">
                          <?php echo $deck_elevation_list[$value['deck_elevation']]['name'] ?>
                        </td>

                        <td style="vertical-align: middle;">
                          <?php echo $master_class[$value['class']] ?>
                        </td>

                        <td style="vertical-align: middle;">
                          <?= isset($master_weld_type[$value['weld_type']]['weld_type']) ? @$master_weld_type[$value['weld_type']]['weld_type'] : '-' ?>
                        </td>

                        <td style="vertical-align: middle;">

                          <?php
                          $arr_wpss = array_merge(explode(';', $value['wps_no_rh']), explode(';', $value['wps_no_fc']));
                          foreach ($arr_wpss as $key_wps => $value_wps) {
                            if ($value_wps) {
                              $arr_wps[] = $master_wps[$value_wps]['wps_no'];
                            }
                          }
                          ?>
                          <?= implode(', ', $arr_wps) ?>
                          <?php unset($arr_wpss, $arr_wps); ?>
                        </td>

                        <td style="min-width: 160px !important; vertical-align: middle;">
                          <textarea disabled class="form-control will_enable<?= $key ?>" type="text" name="cons_lot_no[<?= $key ?>]"><?= $value['cons_lot_no'] ?></textarea>
                        </td>

                        <td style="vertical-align: middle;">
                          <?php $wps_no_rh = array_filter(array_unique(explode(';', $value['wps_no_rh']))) ?>
                          <?php
                          foreach ($wps_no_rh as $key_wps_no_rh => $value_wps_no_rh) {
                            foreach ($wps_detail[$value_wps_no_rh] as $key_rh => $value_rh) {
                              echo $weld_process[$value_rh['id_weld_process']];
                            }
                          }
                          ?>
                        </td>
                        <td style="vertical-align: middle;">
                          <?php $wps_no_fc = array_filter(array_unique(explode(';', $value['wps_no_fc']))) ?>
                          <?php
                          foreach ($wps_no_fc as $key_wps_no_fc => $value_wps_no_fc) {
                            foreach ($wps_detail[$value_wps_no_fc] as $key_fc => $value_fc) {
                              echo $weld_process[$value_fc['id_weld_process']];
                            }
                          }
                          ?>
                        </td>

                        <td style="vertical-align: middle;"><?php echo number_format($value['diameter'], 2) ?></td>
                        <td style="vertical-align: middle;"><?php echo $value['thickness'] ?></td>

                        <td style="vertical-align: middle;">
                          <input type="number" name="length_of_weld[<?= $key ?>]" disabled class="form-control will_enable<?= $key ?>" value="<?= $value['length_of_weld'] ?>">
                        </td>

                        <td style="vertical-align: middle;">
                          <div class="before<?= $key ?>" style="vertical-align: middle;">
                            <?php echo DATE('d F, Y H:i:s', strtotime($value['weld_datetime'])) ?>
                          </div>
                          <div class="after<?= $key ?> fade" style="vertical-align: middle;">
                            <input type="date" name="weld_date[<?= $key ?>]" class="form-control" value="<?= DATE('Y-m-d', strtotime($value['weld_datetime'])) ?>">
                            <input type="time" name="weld_time[<?= $key ?>]" class="form-control" value="<?= DATE('H:i:s', strtotime($value['weld_datetime'])) ?>">
                          </div>
                        </td>

                        <td style="vertical-align: middle;"><?= $full_name[$value['inspection_by']] ?></td>
                        <td style="vertical-align: middle;"><?= DATE('d F, Y H:i A', strtotime($value['inspection_datetime'])) ?></td>

                        <td style="vertical-align: middle;">
                          <?php
                          if ($value['location_v2'] != '') {
                            echo $master_location_v2[$value['location_v2']]['name'];
                          } else {
                            echo $location_name[$value['location']];
                          }
                          ?>
                        </td>

                        <td style="vertical-align: middle;">
                          <?php
                          if (!isset($value['status_inspection'])) {
                            echo '<badge class="badge badge-xl badge-success">Ready</badge>';
                          } elseif ($value['status_inspection'] == 1) {
                            echo '<badge class="badge badge-xl badge-warning">Inspection</badge>';
                          } elseif ($value['status_inspection'] == 2) {
                            echo '<badge class="badge badge-xl badge-danger">Reject</badge>';
                          } elseif ($value['status_inspection'] == 3) {
                            echo '<badge class="badge badge-xl badge-success">Approved QC</badge>';
                          } elseif ($value['status_inspection'] == 4) {
                            echo '<badge class="badge badge-xl badge-warning">Comment By QC</badge>';
                          } elseif ($value['status_inspection'] == 5) {
                            echo '<badge class="badge badge-xl badge-warning">Transmitted</badge>';
                          } elseif ($value['status_inspection'] == 6) {
                            echo '<badge class="badge badge-xl badge-danger">Client Rejected</badge>';
                            echo "<br><b>- Rejected By: </b>" . $full_name[$value['inspection_client_by']];
                            echo "<br><b>- Rejected Date: </b>" . DATE('d F, Y', strtotime($value['inspection_client_datetime']));
                            echo "<br><b>- Rejected Remarks: </b>" . $value['client_remarks'];
                          }
                          ?>
                        </td>

                        <td style="vertical-align: middle;">
                          <strong>
                            <i><?= ($master_drawing_norev[$value['drawing_no']] and $master_drawing_norev[$value['drawing_wm']]) ? '-' : 'Drawing Still Not Issued for Construction!' ?></i>
                          </strong>
                        </td>
                      </tr>

                    <?php $juml++;
                    endforeach; ?>
                  </tbody>
                </table>
              </div>
              <br>
              <div class="col-md-4">
                <div class="row mb-1">
                  <div class="col-md-12 <?= $submit_class ?>">
                    <button type="submit" id="btn_submit" name="submit" value="draft" class="btn btn-primary tombom-submit" disabled><i class='fas fa-paper-plane'></i> Transmit</button>
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
<script>
  function validateTrans(e) {
    var invtype = $(e).val()
    console.log(invtype)

    if (invtype == 0) {
      $('.request_report_number').prop("disabled", true);
      $('.request_report_number').prop("checked", false);

      $('.div_request_report_number').addClass("d-none");

      $('.status_drawing_x').addClass("d-none");
      $('.status_drawing_x').prop("disabled", true);
      $('.status_drawing_0').removeClass("d-none");
      $('.status_drawing_0').prop("disabled", false);
      $('.status_drawing_1').removeClass("d-none");
      $('.status_drawing_1').prop("disabled", false);
    } else if (invtype == 1) {

      $('.div_request_report_number').removeClass("d-none");
      $('.request_report_number').prop("disabled", false);

      $('.status_drawing_x').addClass("d-none");
      $('.status_drawing_x').prop("disabled", true);
      $('.status_drawing_1').addClass("d-none");
      $('.status_drawing_1').prop("disabled", true);
      $('.status_drawing_0').removeClass("d-none");
      $('.status_drawing_0').prop("disabled", false);
    }
  }

  $("select[name=module]").chained("select[name=project]");

  var what_ga_is_selected
  var identic

  $('.dataTable').on('draw.dt', function() {
    console.log(what_ga_is_selected)
    if (typeof what_ga_is_selected !== "undefined") {
      lock_one_ga(what_ga_is_selected)
    }

    $('.select2').select2({
      theme: 'bootstrap'
    });
  });

  function lock_one_ga(identic) {
    var total = '<?= $juml ?>';
    var i;
    for (i = 0; i < total; i++) {
      if (!$('.cb' + i).hasClass(identic)) {
        $('.cb' + i).prop("disabled", true);
        $('.div_' + i).attr('title', 'Different GA/AS');
      }
    }
  }

  $('.dataTable').DataTable({
    order: [],
    paging: false,
    columnDefs: [{
      "targets": 0,
      "orderable": false,
    }]
  })

  $(".autocomplete_doc").autocomplete({
    source: function(request, response) {
      $.ajax({
        url: "<?php echo base_url() ?>visual/autocomplete_drawing",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: 1,

          project: $('#project_js').val(),
          discipline: discipline_js,
          module: module_js,
          type_of_module: type_module_js,
        },
        success: function(data) {
          response(data);
          get_data_drawing(ui.item.value);
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

  $(".autocomplete_wm").autocomplete({
    source: function(request, response) {
      $.ajax({
        url: "<?php echo base_url() ?>visual/autocomplete_drawing",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: 2,

          project: $('#project_js').val(),
          discipline: discipline_js,
          module: module_js,
          type_of_module: type_module_js,
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
    what_ga_is_selected = identic
    var module = $("select[name=module]").val();
    $.ajax({
      url: "<?php echo base_url() ?>engineering/get_data_drawing",
      dataType: "json",
      data: {
        document_no: document_no,
        module: module,
      },
      success: function(data) {
        if (data.drawing_type == 1 || data.drawing_type == 2) {
          $("select[name=project]").val(data.project).trigger('change');
          $("select[name=discipline]").val(data.discipline);
          $("select[name=drawing_type]").val(data.drawing_type);
          if (module == "") {
            $("select[name=module]").val(data.module);
          }
        }
      }
    });
  }

  $("#form_submit").on('submit', function() {
    Swal.fire({
      title: "PROCESSING ...",
      html: `Please Don't Close This Window`,
      onBeforeOpen() {
        Swal.showLoading()
      },
      allowOutsideClick: false
    })
  })

  var selecteds = 0


  function enable_edit(no, thiss, identic) {
    identic = identic
    what_ga_is_selected = identic
    $('.cball').removeAttr('disabled');

    if (thiss.checked == true) {
      selecteds++

      var total = '<?= $juml ?>';
      var i;

      for (i = 0; i < total; i++) {
        if (!$('.cb' + i).hasClass(identic)) {
          $('.cb' + i).prop("disabled", true);
          $('.div_' + i).attr('title', 'Different GA/AS');
        }
      }

      if (selecteds > 100) {
        Swal.fire('Only 100 joints allowed in each submission', '', 'warning')
        $(".tombom-submit").hide();
      } else {
        $(".tombom-submit").show();
        $('.tombom-submit').removeClass('disabled-effect')
      }
    } else {
      var total = '<?= $juml ?>';
      var i;
      selecteds--

      if (selecteds == 0) {
        for (i = 0; i < total; i++) {
          $('.cb' + i).removeAttr('disabled');
          $('.div_' + i).attr('title', '');
        }
      }

      if (selecteds > 100) {
        Swal.fire('Only 100 joints allowed in each submission', '', 'warning')
        $(".tombom-submit").hide();
      } else {
        $(".tombom-submit").show();
        $('.tombom-submit').removeClass('disabled-effect')
      }
    }

    if (selecteds > 0) {
      $("#btn_submit").removeAttr('disabled');
    } else {
      $("#btn_submit").attr('disabled', true);
    }

    $("#thicked b").text(' ' + selecteds)
  }
</script>