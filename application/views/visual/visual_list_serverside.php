<div id="content" class="container-fluid">

  <style type="text/css">
    .disabled-effect {
      pointer-events: none;
      opacity: 0.5;
    }
  </style>

  <style>
    .card-box {
      position: relative;
      color: #fff;
      padding: 10px 5px 10px;
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
      font-size: 27px;
      font-weight: bold;
      margin: 0 0 8px 0;
      white-space: nowrap;
      padding: 0;
      text-align: left;
    }

    .card-box p {
      font-size: 15px;
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
      background-color: #00c0ef !important;
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
  </style>

  <style>
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
      font-size: 17px;
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
  <br />
  <?php
  error_reporting(0);
  // print_r($get['status_inspection']);
  if ($get['status_inspection'] != 0 && $get['status_inspection'] != 2 && $get['status_inspection'] != 4) {
    $submit_none = 'd-none';
  }
  ?>
  <div class="row">
    <div class="col">

      <div class="card shadow my-3 rounded tab-filter">
        <div class="card-header">
          <a class="btn btn-primary" data-toggle="collapse" href="#collapseButton" role="button" aria-expanded="false" aria-controls="collapseButton">Filter &nbsp; <i class="fas fa-angle-double-down"></i><i class="fas fa-angle-double-up"></i></a>
        </div>
        <div class="collapse  <?= $this->input->get() ? 'show' : '' ?>" id="collapseButton">
          <div class="card-body bg-white overflow-auto">
            <form action="" method="GET">
              <div class="row">

                <div class="col-md-6 d-none">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted text-muted"><strong>Workpack Number</strong></label>
                    <div class="col-xl">
                      <input type="text" name="workpack_no" class="form-control workpack_no" placeholder="Work Pack Number" value="<?= $get['workpack_no'] ? $get['workpack_no'] : '' ?>">
                    </div>
                  </div>
                </div>
                <div class="col-12"></div>

                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label text-muted ">Project ID</label>
                    <div class="col-xl">
                      <select class="form-control" name="project" id="project_js" onchange="find_deck_by_project(this)" required>
                        <option value="">---</option>
                        <?php if ($this->permission_cookie[0] == 1) { ?>
                          <?php foreach ($project_list as $key => $value) : ?>
                            <option value="<?php echo $value['id'] ?>" <?= (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?= $value['project_name'] ?></option>
                          <?php endforeach; ?>
                        <?php } else { ?>
                          <?php foreach ($project_list as $key => $value) : ?>
                            <?php if (in_array($value['id'], $this->user_cookie[13])) { ?>
                              <option value="<?= $value['id'] ?>" <?= (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?= $value['project_name'] ?></option>
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
                    <label class="col-md-4 col-lg-3 col-form-label text-muted ">Discipline</label>
                    <div class="col-xl">
                      <select class="form-control" name="discipline" id="discipline_js">
                        <option value="">---</option>
                        <?php foreach ($discipline_list as $key => $value) : ?>
                          <option onclick="save_discipline()" value="<?php echo $value['id'] ?>" <?php echo (@$get['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
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
              </div>

              <div class="row">
                <div class="col-6"><?php //test_var($module_list, 1) 
                                    ?>
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label text-muted ">Module</label>
                    <div class="col-xl">
                      <select class="form-control" name="module" id="module_js">
                        <option value="">---</option>
                        <?php foreach ($module_list as $key => $value) : ?>

                          <option onclick="save_module()" value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$get['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
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

                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label text-muted ">Type of Module</label>
                    <div class="col-xl">
                      <select class="form-control" name="type_of_module">
                        <option value="">---</option>
                        <?php foreach ($type_of_module_list as $key => $value) : ?>
                          <option onclick="save_type_module()" value="<?php echo $value['id'] ?>" <?php echo (@$get['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
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

                <!-- <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label text-muted ">Deck Elevation / Service Line</label>
                    <div class="col-xl">
                      <select class="form-control" name="deck_elevation">
                        <option value="">---</option>
                        <?php foreach ($deck_list as $key => $value) : ?>
                          <option value="<?php echo $value['id'] ?>" <?php echo (@$get['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div> -->

                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label text-muted ">Drawing Type</label>
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
                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label text-muted ">Drawing Number</label>
                    <div class="col-xl">
                      <select class="form-control select2" name="drawing_no">
                        <option value="">---</option>
                        <?php foreach ($drawing_lis as $key => $value) { ?>
                          <option value="<?= $value['drawing_no'] ?>" <?= $get['drawing_no'] == $value['drawing_no'] ? 'selected' : '' ?>><?= $value['drawing_no'] ?></option>
                        <?php } ?>
                      </select>
                      <span style="color:red;font-weight: bold;font-style: italic;">Please choice Drawing Number for Submit Data</span>
                    </div>
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label text-muted ">Weld Map Number</label>
                    <div class="col-xl">
                      <input type="text" class="form-control autocomplete_wm" name="drawing_wm" value="<?php echo @$get['drawing_wm'] ?>">
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label text-muted ">Joint Class</label>
                    <div class="col-xl">
                      <select class="form-control" name="class">
                        <option value="">---</option>
                        <?php foreach ($class_list as $key => $value) { ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $get['class'] ? 'selected' : '' ?>><?= $value['class_code'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label text-muted ">Submission Status</label>
                    <div class="col-xl">
                      <select class="form-control" name="status_inspection" onchange="checkPendingByQC(this)">
                        <option value="">---</option>
                        <option value="0" <?= $get['status_inspection'] == 0 ? 'selected' : '' ?>>Ready</option>
                        <option value="2" <?= $get['status_inspection'] == 2 ? 'selected' : '' ?>>Rejected</option>
                        <option value="4" <?= $get['status_inspection'] == 4 ? 'selected' : '' ?>>Pending By QC</option>
                      </select>
                      <script type="text/javascript">
                        function checkPendingByQC(ini) {
                          var value = $(ini).val()
                          console.log(value)
                          if (value == 4) {
                            $('.form_subm').removeClass('d-none')
                          } else {
                            $('.form_subm').addClass('d-none')
                            $('.form_subm_inp').prop('required', false)
                            $('.form_subm_inp').val('')
                          }
                        }
                      </script>
                    </div>
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label text-muted ">Status Surveyor</label>
                    <div class="col-xl">
                      <select name="status_surveyor" class="form-control select2" required="">
                        <option value="">---</option>
                        <option value="999" <?= $get['status_surveyor'] == '999' ? 'selected' : '' ?>>No Status Surveyor</option>
                        <?php foreach ($surveyor_status as $key => $value) { ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $get['status_surveyor'] ? 'selected' : '' ?>><?= $value['description'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label text-muted ">Company</label>
                    <div class="col-xl">
                      <select name="company[]" class="form-control select2" multiple="">

                        <!-- =================== -->
                        <?php if ($this->permission_cookie[0] == 1) { ?>
                          <option value="">---</option>
                          <?php foreach ($company_list as $key => $value) { ?>
                            <option value="<?= $value['id_company'] ?>" <?= in_array($value['id_company'], $get['company']) ? 'selected' : '' ?>><?= $value['company_name'] ?></option>
                          <?php } ?>
                        <?php } else { ?>
                          <?php foreach ($company_list as $key => $value) : ?>
                            <?php if (in_array($value['id_company'], $this->user_cookie[14])) { ?>
                              <option value="<?php echo $value['id_company'] ?>" <?= in_array($value['id_company'], $get['company']) ? 'selected' : '' ?>><?php echo $value['company_name'] ?></option>
                            <?php } ?>
                          <?php endforeach; ?>
                        <?php } ?>
                        <!-- =================== -->

                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-6 <?= $get['status_inspection'] == 4 ? '' : 'd-none' ?> form_subm">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label text-muted ">Submission ID</label>
                    <div class="col-xl">
                      <input type="text" class="form-control form_subm_inp" name="submission_id" value="<?php echo @$get['submission_id'] ?>" <?= $get['status_inspection'] == 4 ? 'required' : '' ?>>
                    </div>
                  </div>
                </div>

                <div class="col-6 <?= $get['project'] == 21 ? null : 'd-none' ?>" id="div_deck">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label text-muted">Deck Elevation / Service Line</label>
                    <div class="col-xl">
                      <select class="form-control" name="deck_elevation" id="deck_change" onchange='autofilter(this);' <?= $this->input->get('project') == 21 ? 'required' : '' ?>>
                        <option value="">---</option>
                        <?php foreach ($deck_list as $key => $value) { ?>
                          <option value="<?= $value['id']; ?>" <?= ($value['id'] == @$get['deck_elevation'] ? "selected" : "") ?>><?= $value['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-8 d-none">
                  <div class="form-group row">
                    <div class="col-xl">
                      <div class="container text-right">
                        <div class="row">
                          <div class="col-lg-3">
                            <div class="card-box bg-green">
                              <div class="inner">
                                <h3 class="kotak_1">Please Wait ...</h3>
                                <p> Ready </p>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-3">
                            <div class="card-box bg-blue">
                              <div class="inner">
                                <h3 class="kotak_2">Please Wait ...</h3>
                                <p> Pending QC</p>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-3">
                            <div class="card-box bg-red">
                              <div class="inner">
                                <h3 class="kotak_3">Please Wait ...</h3>
                                <p> Rejected QC</p>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-3">
                            <div class="card-box bg-secondary">
                              <div class="inner">
                                <h3 class="kotak_4">Please Wait ...</h3>
                                <p> All Status (Except Ready)</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-8">
                  <div class="form-group row">
                    <div class="col-xl">
                      <?php if ($mode != 'transmittal') { ?>
                        <div class="container  text-right">
                          <div class="row d-none">
                            <div class="col-lg-3">
                              <div class="card-box bg-green">
                                <div class="inner">
                                  <h3 id="kotak_1">Please Wait ...</h3>
                                  <span id='detail_card'>Ready</span>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-3">
                              <div class="card-box bg-blue">
                                <div class="inner">
                                  <h3 id="kotak_2">Please Wait ...</h3>
                                  <span id='detail_card'>Pending QC</span>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-3">
                              <div class="card-box bg-red">
                                <div class="inner">
                                  <h3 id="kotak_3">Please Wait ...</h3>
                                  <span id='detail_card'>Rejected QC</span>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-3">
                              <div class="card-box bg-secondary">
                                <div class="inner">
                                  <h3 id="kotak_4">Please Wait ...</h3>
                                  <span id='detail_card'>All Status (Except Ready)</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <script type="text/javascript">
                          // $( document ).ready(function loadloadajax() {
                          //   $.ajax({
                          //     url: "<?php echo base_url() ?>visual/production_rfi_count",
                          //     type: "post",
                          //     dataType: "json",
                          //     data: {
                          //     },
                          //     success: function( data ) {
                          //       console.log(data)

                          //       $('#kotak_1').text(data['pending']+' Joints')
                          //       $('#kotak_2').text(data['pending_qc']+' Joints')
                          //       $('#kotak_3').text(data['reject']+' Joints')
                          //       $('#kotak_4').text(data['all_without_readytoinspect']+' Joints')
                          //       setTimeout(function(){loadloadajax();}, 30000);
                          //     }
                          //   });
                          // })
                        </script>
                      <?php } ?>
                    </div>
                  </div>
                </div>

                <div class="col-12 text-right">
                  <hr>
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
      <div class="card shadow my-3 rounded">
        <div class="card-header">
          <h6 class="m-0">Visual Testing | Joint for Submission</h6>
        </div>
        <div class="card-body bg-white">
          <?php if (isset($get['drawing_no'])) : ?>

            <?php if ($get['status_inspection'] != 2) { ?>
              <form method="POST" action="<?php echo base_url() ?>visual/new_submit_to_draft/<?= $get['status_inspection'] == 4 ? '1' : '' ?>" id="formsubmite" enctype="multipart/form-data">
              <?php } else { ?>
                <form method="POST" action="<?php echo base_url() ?>visual/new_submit_to_draft_reject" id="formsubmite" enctype="multipart/form-data">
                <?php } ?>
                <?php if ($get['drawing_no'] != '') { ?>
                  <input type="hidden" name="deck_post" value="<?= $this->input->get('deck_elevation') ?>">
                  <div class="row <?= $submit_none ?>" style="margin-bottom: 10px !important">
                    <div class="col">
                      <label><b>Requestor Company</b></label>
                      <input type="text" name="company" class="form-control" value="<?= $company[$this->user_cookie[11]]['company_name'] ?>">
                    </div>
                    <div class="col">
                      <label><b>Area</b></label>
                      <select class="select3 form-control will_enable" name="area" required="">
                        <option value="">---</option>
                        <?php foreach ($area as $value_area) { ?>
                          <option value="<?= $value_area['id'] ?>" <?= $data_area_v2 == $value_area['id'] ? 'selected' : '' ?>><?= $value_area['name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col">
                      <label><b>Location</b></label>
                      <select class="select3 form-control will_enable" name="location" required="">
                        <option value="">---</option>
                        <?php foreach ($location as $value_location) { ?>
                          <option value="<?= $value_location['id'] ?>" <?= $data_location_v2 == $value_location['id'] ? 'selected' : '' ?> data-chained="<?php echo $value_location['id_area'] ?>"><?= $value_location['name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col">
                      <label><b>Point</b></label>
                      <select class="select3 form-control will_enable" name="point">
                        <option value="">---</option>
                        <?php foreach ($point as $value_point) { ?>
                          <option value="<?= $value_point['id'] ?>" <?= $data_point_v2 == $value_point['id'] ? 'selected' : '' ?> data-chained="<?php echo $value_point['id_location'] ?>"><?= $value_point['name'] ?></option>
                        <?php } ?>
                      </select>

                      <div class="text-center">
                        <small class="text-danger"><b><i>Point not Required!</i></b></small>
                      </div>
                    </div>
                    <script type="text/javascript">
                      $("select[name=location]").chained("select[name=area]");
                      $("select[name=point]").chained("select[name=location]");
                    </script>
                  </div>

                  <div class="row <?= $submit_none ?>">
                    <div class="col">
                      <br>
                      <span class="btn btn-primary" id="thicked">
                        <i class="fas fa-clipboard-check"></i><b> 0</b> Item thicked
                      </span><i><b class="text-danger">&nbsp;&nbsp;*Max 300 Item Thicked Allowed</b></i>
                    </div>
                  </div>
                <?php } ?>

                <br>
                <div class="overflow-auto rounded">
                  <table class="table table-hover text-center" width="100%" id="tableASDF">
                    <thead class="bg-secondary text-white">
                      <tr>
                        <th style="vertical-align: middle;" rowspan="2"><b>#</b></th>
                        <?php if ($get['status_inspection'] == 4) { ?>
                          <th style="vertical-align: middle;" rowspan="2">Submission ID</th>
                        <?php } ?>
                        <th style="vertical-align: middle;" rowspan="2">Project</th>
                        <th style="vertical-align: middle;" rowspan="2">Company</th>
                        <!-- <th style="vertical-align: middle;" rowspan="2">Workpack No.</th> -->
                        <th style="vertical-align: middle;" rowspan="2">Document No.</th>
                        <th style="vertical-align: middle;" rowspan="2">Drawing Weld Map</th>
                        <th style="vertical-align: middle;" rowspan="2">Joint No.</th>
                        <th style="vertical-align: middle;" rowspan="2">Deck Elevation / Service Line</th>
                        <th style="vertical-align: middle;" rowspan="2">Class</th>
                        <th style="vertical-align: middle;" rowspan="2">Weld Type</th>
                        <th style="vertical-align: middle;" rowspan="2">Cons/Lot No.</th><!-- input -->

                        <th style="vertical-align: middle;" rowspan="1" colspan="2" style="min-width: 300px !important">WPS</th>
                        <th style="vertical-align: middle;" rowspan="1" colspan="2" style="min-width: 300px !important">Welder ID</th>
                        <th style="vertical-align: middle;" rowspan="1" colspan="2">Weld Process</th>

                        <!-- <th style="vertical-align: middle;" rowspan="2">WPS Fit Up</th> -->

                        <th style="vertical-align: middle;" rowspan="2">NDT REQ.</th>
                        <th style="vertical-align: middle;" rowspan="2">DIA (INCH)</th>
                        <th style="vertical-align: middle;" rowspan="2">THK (MM)</th>

                        <th style="vertical-align: middle;" rowspan="2">GRADE</th>

                        <th style="vertical-align: middle;" rowspan="2" style="width: 150px !important">Weld Length (MM)</th><!-- input -->
                        <th style="vertical-align: middle;" rowspan="2" style="width: 600px !important">Weld Date</th><!-- input -->

                        <th style="vertical-align: middle;" rowspan="2">Surveyor</th>

                        <th style="vertical-align: middle;" rowspan="2">Remarks</th>
                        <th style="vertical-align: middle;" rowspan="2">Status</th>
                      </tr>
                      <tr>
                        <th style="vertical-align: middle;" style="min-width: 150px !important">R/H</th>
                        <th style="vertical-align: middle;" style="min-width: 150px !important">F/C</th>

                        <th style="vertical-align: middle;">R/H</th>
                        <th style="vertical-align: middle;">F/C</th>

                        <th style="vertical-align: middle;">R/H</th>
                        <th style="vertical-align: middle;">F/C</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
                <br>
                <div class="col-md-12">
                  <div class="row">
                    <?php if ($user_permission[39] == 1 and $get['drawing_no'] != '') { ?>
                      <div class="col <?= $status_submit ?> <?= ($get['status_inspection'] == 4 and !$get['submission_id']) ? 'd-none' : '' ?>" style="max-width: 190px !important">
                        <button type="submit" name="submit" value="draft" class="btn btn-primary <?= $submit_none ?> submit_btn" onclick="setBlank('0')"><i class='fas fa-paper-plane'></i> Submit Inspection</button>
                      </div>

                      <div class="col d-none">
                        <button type="submit" name="submit" value="preview" class="btn btn-danger <?= $submit_none ?>" onclick="setBlank('1')"><i class='fas fa-file-pdf'></i> Preview Inspection</button>
                      </div>
                    <?php } ?>
                  </div>
                </div>
                </form>
              <?php else : ?>
                <div class="col-md-12">
                  <b class="text-danger"><i class="fas fa-info-circle"></i> Please Filter by Project First !</b>
                </div>
              <?php endif; ?>

        </div>
      </div>
    </div>
  </div>

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
</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script type="text/javascript">
  function showWProc(type, id_visual, ini, keyini) {
    var id_wps = $(ini).val()

    $.ajax({
      url: "<?php echo base_url() ?>visual/find_detail_wps",
      type: "POST",
      data: {
        id_wps: id_wps ? id_wps : 0,
      },
      success: function(data) {
        console.log(data)
        if (data && id_wps) {
          // if(type==0){
          //   $('.wps_rh_text_'+id_visual).text(data)
          // } else if(type==1){
          //   $('.wps_fc_text_'+id_visual).text(data)
          // }

          if (type == 0) {
            let weld_list = data.split(", ")
            let select_weld = `<select class="select3" multiple name="weld_process_rh[` + keyini + `][]" required">
							${
								weld_list.map(function(v) {
								return `<option value="${v}">${v}</option>`
								}).join('')
							}
						 </select>`

            // $(ini).closest('tr').find('.wps_rh_text').text(data)
            $(ini).closest('tr').find('.wps_rh_text').html(select_weld)
          } else if (type == 1) {
            let weld_list = data.split(", ")
            let select_weld = `<select class="select3" multiple name="weld_process_fc[` + keyini + `][]" required">
							${
								weld_list.map(function(v) {
								return `<option value="${v}">${v}</option>`
								}).join('')
							}
						 </select>`

            // $(ini).closest('tr').find('.wps_fc_text').text(data)
            $(ini).closest('tr').find('.wps_fc_text').html(select_weld)
          }

          $('.select3').select2()

        }
      }
    });
  }

  $(document).ready(function() {
    $("#tableASDF").DataTable({
      processing: true,
      serverSide: true,
      <?php if ($get['drawing_no'] != '') { ?>
        bFilter: false,
        lengthChange: false,
        paging: false,
        ordering: false,
      <?php } ?>
      ajax: {
        url: "<?= base_url('visual/visual_list_serverside') ?>",
        type: "POST",
        data: {
          workpack_no: "<?= $get['workpack_no'] ?>",
          project: "<?= $get['project'] ?>",
          company: "<?= implode(', ', $get['company']) ?>",
          discipline: "<?= $get['discipline'] ?>",
          type_of_module: "<?= $get['type_of_module'] ?>",
          deck_elevation: "<?= $get['deck_elevation'] ?>",
          drawing_type: "<?= $get['drawing_type'] ?>",
          drawing_no: "<?= $get['drawing_no'] ?>",
          drawing_wm: "<?= $get['drawing_wm'] ?>",
          class: "<?= $get['class'] ?>",
          status_inspection: "<?= $get['status_inspection'] ?>",
          status_surveyor: "<?= $get['status_surveyor'] ?>",
          status_internal: "<?= $get['status_internal'] ?>",
          submission_id: "<?= $get['submission_id'] ?>",
        },
        // drawCallback: function ( settings ) {
        //   return settings.json;
        //   $('.select2x').select2({
        //     theme: 'bootstrap'
        //   })
        // }
      }
    })
  })

  var no = 0;

  function add_rh(key, company_id) {
    no++;
    var input_length = 0
    var max_length = $("input[name='weld_length[" + key + "]']").val()

    var inputs = $('.welders_rh_' + key);
    for (var i = 0; i < inputs.length; i++) {
      input_length = parseInt(input_length) + parseInt($(inputs[i]).val())
    }

    var html = '<div class="input-group mb-3 form-check form-check-inline ctq_row_rh_' + no + '">';
    html += '<input type="text" placeholder="Welder Tag" class="auto_rh_' + no + ' form-control will_enable' + key + '" name="welder_rh[' + key + '][]" value="" onfocus="welder_autocomplete_rh(' + no + ', ' + key + ', ' + company_id + ')">'
    // html += '<input type="number" placeholder="Length Welded" class="form-control will_enable'+key+' welders_rh_'+key+'" name="length_welded_rh['+key+'][]" value="" max="'+(parseInt(max_length)-parseInt(input_length))+'">'
    html += '<span class="btn btn-danger" onclick="delete_rh(' + no + ')"><i class="fas fa-times"></i></span>'
    html += '</div>'
    $('#table_rh' + key).append(html)

    input_length = 0 // RESET LAGI KE 0
  }

  function removeRH(keythis) {
    console.log(keythis)
    $('.rh_' + keythis).remove()
  }

  function removeRH_v2(keythis, id_visual_detail_welder) {
    console.log(id_visual_detail_welder)

    var text = "<p> Do you want to <strong class='text-danger'>Delete</strong> the Welder Data? </p>"
    var types = "error"

    Swal.fire({
      type: types,
      title: text,
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: 'Yes',
    }).then((result) => {
      console.log(result)
      if (result.value == true) {
        $.ajax({
          url: "<?= base_url() ?>visual/remove_visual_detail_welder",
          type: "POST",
          data: {
            'id_visual_detail_welder': id_visual_detail_welder,
          },
        })
        Swal.fire('Success!', '', 'success')
        $('.rh_' + keythis).remove()
      } else {
        Swal.fire('Changes are not saved', '', 'info')
      }
    })
  }

  function delete_rh(key) {
    $('.ctq_row_rh_' + key).remove()
  }


  function welder_autocomplete_rh(no, keyes, company_id) {
    var wps = $('.wps_select_rh_' + keyes).val();

    $('.auto_rh_' + no).autocomplete({
      source: function(request, response) {
        $.ajax({
          url: '<?php echo base_url(); ?>visual/welder_autocomplete',
          type: 'POST',
          dataType: 'json',
          data: {
            term: request.term,
            company_id: company_id,
            wps: wps,
          },
          success: function(data) {
            response(data);
          },
          error: function() {
            Swal.fire('Please Select WPS First', '', 'info');
          }
        });
      },
      autoFocus: true,
      classes: {
        "ui-autocomplete": "highlight"
      },
      select: function(event, ui) {
        $(this).val(ui.item.value);
      },
      change: function(event, ui) {
        if (!ui.item) {
          $(this).val('');
        }
      }
    });
  }
</script>
<script type="text/javascript">
  var no_fc = 0;

  function removeFC(keythis) {
    $('.fc_' + keythis).remove()
    // $(thiss).remove()
  }

  function add_fc(key, company_id) {
    no_fc++;
    var input_length = 0
    var max_length = $("input[name='weld_length[" + key + "]']").val()

    var inputs = $('.welders_fc_' + key);
    for (var i = 0; i < inputs.length; i++) {
      input_length = parseInt(input_length) + parseInt($(inputs[i]).val())
    }

    var html = '<div class="input-group mb-3 form-check form-check-inline ctq_row_fc_' + no_fc + '">';
    html += '<input type="text" placeholder="Welder Tag" class="auto_fc_' + no_fc + ' form-control will_enable' + key + '" name="welder_fc[' + key + '][]" value="" onfocus="welder_autocomplete_fc(' + no_fc + ', ' + key + ', ' + company_id + ')" required>'
    // html += '<input type="number" placeholder="Length Welded" class="form-control will_enable'+key+'" name="length_welded_fc['+key+'][]" value="" max="'+(parseInt(max_length)-parseInt(input_length))+'">'
    html += '<span class="btn btn-danger" onclick="delete_fc(' + no_fc + ')"><i class="fas fa-times"></i></span>'
    html += '</div>'
    $('#table_fc' + key).append(html)

    input_length = 0 // RESET LAGI KE 0
  }

  function delete_fc(key) {
    $('.ctq_row_fc_' + key).remove()
  }

  function welder_autocomplete_fc(no, keyes, company_id) {
    var wps = $('.wps_select_fc_' + keyes).val();

    $('.auto_fc_' + no).autocomplete({
      source: function(request, response) {
        $.ajax({
          url: '<?php echo base_url(); ?>visual/welder_autocomplete',
          type: 'POST',
          dataType: 'json',
          data: {
            term: request.term,
            company_id: company_id,
            wps: wps,
          },
          success: function(data) {
            response(data);
          },
          error: function() {
            Swal.fire('Please Select WPS First', '', 'info');
          }
        });
      },
      autoFocus: true,
      classes: {
        "ui-autocomplete": "highlight"
      },
      select: function(event, ui) {
        $(this).val(ui.item.value);
      },
      change: function(event, ui) {
        if (!ui.item) {
          $(this).val('');
        }
      }
    });
  }

  var no_rh = 0;

  function removeWpsRh(keythis, thiss) {
    $('.wrh_' + keythis).remove()
    $(thiss).remove()
  }

  function add_wps_rh(key, company_id) {
    no_rh++;
    var html = '<div class="input-group mb-3 form-check form-check-inline wps_row_rh_' + no_rh + '">';
    html += '<input type="text" placeholder="WPS RH" class="auto_wps_rh_' + no_rh + ' fwrh form-control will_enable' + key + '" name="wps_rh[' + key + '][]" value="" onfocus="wps_autocomplete_rh(' + no_rh + ', ' + key + ', ' + company_id + ')">'
    html += '<span class="btn btn-danger" onclick="delete_wps_rh(' + no_rh + ')"><i class="fas fa-times"></i></span>'
    html += '</div>'
    $('#wps_rh' + key).append(html)
  }

  function delete_wps_rh(key) {
    $('.wps_row_rh_' + key).remove()
  }


  function wps_autocomplete_rh(no, keyes, company_id) {

    // var linkwps = $('.weld_process_rh_'+keyes).val()
    var linkwps = []
    var inputs = $('.weld_process_rh_' + keyes)
    for (var i = 0; i < inputs.length; i++) {
      if ($(inputs[i])[0].checked == true) {
        linkwps.push($(inputs[i]).val())
      }
    }
    linkwps = linkwps.join('/')

    $('.auto_wps_rh_' + no).autocomplete({
      source: function(request, response) {
        $.post('<?php echo base_url(); ?>visual/wps_autocomplete/', {
          term: request.term,
          linkwps: linkwps,
          company_id: company_id
        }, response, 'json');
      },
      autoFocus: true,
      classes: {
        "ui-autocomplete": "highlight"
      }
    });
  }

  var no_fc = 0;

  function removeWpsfc(keythis, thiss) {
    $('.wfc_' + keythis).remove()
    $(thiss).remove()
  }

  function add_wps_fc(key, company_id) {
    no_fc++;
    var html = '<div class="input-group mb-3 form-check form-check-inline wps_row_fc_' + no_fc + '">';
    html += '<input type="text" placeholder="WPS FC" class="auto_wps_fc_' + no_fc + ' fwrh form-control will_enable' + key + '" name="wps_fc[' + key + '][]" value="" onfocus="wps_autocomplete_fc(' + no_fc + ', ' + key + ', ' + company_id + ')">'
    html += '<span class="btn btn-danger" onclick="delete_wps_fc(' + no_fc + ')"><i class="fas fa-times"></i></span>'
    html += '</div>'
    $('#wps_fc' + key).append(html)
  }

  function delete_wps_fc(key) {
    $('.wps_row_fc_' + key).remove()
  }


  function wps_autocomplete_fc(no, keyes, company_id) {

    var linkwps = []
    var inputs = $('.weld_process_rh_' + keyes)
    for (var i = 0; i < inputs.length; i++) {
      if ($(inputs[i])[0].checked == true) {
        linkwps.push($(inputs[i]).val())
      }
    }
    linkwps = linkwps.join('/')

    $('.auto_wps_fc_' + no).autocomplete({
      source: function(request, response) {
        $.post('<?php echo base_url(); ?>visual/wps_autocomplete/', {
          term: request.term,
          linkwps: linkwps,
          company_id: company_id
        }, response, 'json');
      },
      autoFocus: true,
      classes: {
        "ui-autocomplete": "highlight"
      }
    });
  }
</script>
<script type="text/javascript">
  function setBlank(kondisi) {
    if (kondisi == 1) {
      $("form").attr("target", "_blank");
    } else {
      $("form").removeAttr("target");
    }
  }
</script>
<script type="text/javascript">
  $('.all').on('select2:unselecting', function(e) {
    setTimeout(function() {
      console.log($('.all').val())
      // $(this).closest('tr').find('.auto_rh_999').val('')
    }, 5000);
  });
</script>
<script>
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

  $('.workpack_no').autocomplete({
    source: "<?php echo base_url(); ?>visual/autocomplete_workpack_no",
    autoFocus: true,
    classes: {
      "ui-autocomplete": "highlight"
    }
  });

  $(".autocomplete_wm").autocomplete({
    source: function(request, response) {
      console.log('wm autc')
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

  $("select[name=module]").chained("select[name=project]");



  function get_data_drawing(document_no) {
    var module = $("select[name=module]").val();
    console.log(document_no);
    console.log(module);
    $.ajax({
      url: "<?php echo base_url() ?>engineering/get_data_drawing",
      dataType: "json",
      data: {
        document_no: document_no,
        module: module,
      },
      success: function(data) {
        console.log(data);
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
  var what_ga_is_selected
  $('.dataTable').on('draw.dt', function() {

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

  var selecteds = 0

  function removeDisable(id_visual) {

    console.log($(".cb_visual_" + id_visual))

    if ($(".cb_visual_" + id_visual)[0].checked == true) {
      $('.id_visual_' + id_visual).removeAttr('disabled');

      $('.select2_' + id_visual).select2({
        theme: 'bootstrap'
      })

      $('.fc_required_' + id_visual).prop('required', true);
      selecteds++
    } else {
      $('.id_visual_' + id_visual).prop('disabled', true);
      $('.fc_required_' + id_visual).prop('required', false);
      selecteds--
    }

    if (selecteds > 300) {
      Swal.fire({
            type: "warning",
            title: "Warning",
            text: "Only 300 Data Allowed In Each Submission"
          })
      $(".submit_btn").prop('disabled', true);
    } else {
      $(".submit_btn").show();
      $(".submit_btn").removeAttr('disabled');
    }

    $("#thicked b").text(' ' + selecteds)
  }

  function enable_edit(no, thiss, identic) {
    what_ga_is_selected = identic
    if (thiss.checked == true) {
      selecteds++
      console.log(selecteds)
      console.log('yes')

      var total = '<?= $juml ?>';
      var i;

      for (i = 0; i < total; i++) {
        if (!$('.cb' + i).hasClass(identic)) {
          $('.cb' + i).prop("disabled", true);
          $('.div_' + i).attr('title', 'Different GA/AS');
        }
      }

      $('.will_enable' + no).removeClass('disabled-effect');

      $('.will_enable' + no).removeAttr('disabled');
      $('.nowill_enable' + no).removeAttr('disabled');

      $('.will_enable' + no).prop('required', true);
      $('.fwrh').removeAttr('required')
      if (selecteds >= 30) {
        $('.checkbox-big').addClass('disabled-effect')
      }
    } else {
      var total = '<?= $juml ?>';
      var i;
      selecteds--
      console.log('not')
      console.log(selecteds)
      $('.will_enable' + no).prop('disabled', true);
      $('.nowill_enable' + no).prop('disabled', true);
      $('.will_enable' + no).removeAttr('required');
      // $('.fwrh').removeAttr('required')
      $('.will_enable' + no).addClass('disabled-effect');

      lock_one_ga_lef(identic)

      if (selecteds == 0) {
        console.log('sampai')
        for (i = 0; i < total; i++) {
          console.log(i)
          $('.cb' + i).removeAttr('disabled');
          $('.div_' + i).attr('title', '');
        }
      }

    }
    $("#thicked b").text(' ' + selecteds)
  }

  function lock_one_ga_lef(identic) {
    var total = '<?= $juml ?>';
    var i;

    for (i = 0; i < total; i++) {
      if ($('.cb' + i).hasClass(identic) && $('.cb' + i).checked == true) {
        console.log('benar')
        if (!$('.cb' + i).hasClass(identic)) {
          $('.cb' + i).prop("disabled", true);
          $('.div_' + i).attr('title', 'Different GA/AS');
        }
      } else {
        console.log('salah')
        $('.cb' + i).removeAttr('disabled');
        $('.div_' + i).attr('title', '');
      }
    }
  }

  function show_image(btn, source, type) {

    <?php
    $url_image = "10.5.252.116";
    if ($this->input->ip_address() == getenv('IP_FIREWALL_GATEWAY')) {
      $url_image = "www.smoebatam.com";
    }
    ?>

    if (type == "client") {
      var url = "https://<?= $url_image ?>/pcms_v2_photo/fab_img/" + source
    } else {
      var url = "https://<?= $url_image ?>/pcms_v2_photo/" + source

    }


    var image_content = `
      <div class="row">
        <div class="col-md-12">
          <img src="${url}" style="width : 100%">
        </div>
        <div class="col-md-12">
          <hr>
          <div class="float-right">
            <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
          </div>
        </div>
      </div>
    `

    $("#modal").modal({
      show: true,
      keyboard: false,
      backdrop: "static"
    }).find('.modal-body').html(image_content)
    $('.modal-title').text("Attachment")
    $('.modal-dialog').addClass('modal-lg')
  }

  function find_deck_by_project(select) {
    var project_id = $(select).val()
    if (project_id != 21) {
      $("#deck_change").removeAttr('required');
      $("#div_deck").addClass('d-none');
    } else {
      $("#div_deck").removeClass('d-none');
      $("#deck_change").attr('required', true);
    }
  }
</script>