<div id="content" class="container-fluid">

  <style type="text/css">
    .disabled-effect {
      pointer-events: none;
      opacity:0.5;
    }
  </style>

  <?php error_reporting(0) ?>
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="" method="GET">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
                  <div class="col-xl">
                    <select class="form-control" name="project" required id="project_js">
                      <option value="">---</option>
                      <?php foreach ($project_list as $key => $value) : ?>
                      <option onclick="save_project()" value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    <script type="text/javascript">
                      var project_js
                      function save_project(){
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
                    <select class="form-control" name="drawing_type" id="drawing_type_js" required>
                      <option value="">---</option>
                      <option value="1" <?php echo (@$get['drawing_type'] == '1' ? 'selected' : '') ?> onclick="save_drawing_type()">GA</option>
                      <option value="2" <?php echo (@$get['drawing_type'] == '2' ? 'selected' : '') ?> onclick="save_drawing_type()">Assembly</option>
                      <option value="3" <?php echo (@$get['drawing_type'] == '3' ? 'selected' : '') ?> onclick="save_drawing_type()">Weldmap</option>
                      <option value="13" <?php echo (@$get['drawing_type'] == '13' ? 'selected' : '') ?> onclick="save_drawing_type()">ISO</option>
                    </select>
                    <script type="text/javascript">
                      var drawing_type_js
                      function save_drawing_type(){
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
                    <select class="form-control" name="discipline" id="discipline_js" required>
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option onclick="save_discipline()" value="<?php echo $value['id'] ?>" <?php echo (@$get['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    <script type="text/javascript">
                      var discipline_js
                      function save_discipline(){
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
                    <select class="form-control" name="module" required id="module_js">
                      <option value="">---</option>
                      <?php foreach ($module_list as $key => $value) : ?>
                      <option onclick="save_module()" value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$get['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    <script type="text/javascript">
                      var module_js
                      function save_module(){
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
                      <option onclick="save_type_module()" value="<?php echo $value['id'] ?>" <?php echo (@$get['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    <script type="text/javascript">
                      var type_module_js
                      function save_type_module(){
                        type_module_js = $('#type_module_js').val()
                        console.log(type_module_js)
                      }
                    </script>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Drawing No.</label>
                  <div class="col-xl">
                    <input type="text" class="form-control autocomplete_doc" name="drawing_no" value="<?php echo @$get['drawing_no'] ?>" required>
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
                <!-- <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status</label>
                  <div class="col-xl">
                    <select class="form-control" name="status_inspection">
                      <option value="">---</option>
                      <option value="1" <?= $filter_status_inspection==1 ? 'selected' : '' ?>>Submitted</option>
                      <option value="2" <?= $filter_status_inspection==2 ? 'selected' : '' ?>>Rejected</option>
                      <option value="3" <?= $filter_status_inspection==3 ? 'selected' : '' ?>>Approved</option>
                      <option value="4" <?= $filter_status_inspection==4 ? 'selected' : '' ?>>Pending By QC</option>
                      <option value="5" <?= $filter_status_inspection==5 ? 'selected' : '' ?>>Transmitted</option>
                    </select>
                  </div>
                </div> -->
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
  
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
          <form method="POST" action="<?php echo base_url() ?>ndt/send_to_vendor">
            <?php if($submitted!='submitted'){ ?>
              <div class="row">
              <div class="col-6">
              
              <input type="hidden" name="status_internal" class="form-control" value="<?= $status_internal ?>" required>

              <div class="col-md-12"></div>
              <div class="col mt-2">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Inspector Name</label>
                  <div class="col-xl">
                    <select name="inspector_id" class="select2" style="width: 100%" required>
                      <option value="">---</option>
                      <?php foreach ($user_list as $key => $value): ?>
                      <option value="<?= $value['id_user'] ?>"><?= $value['full_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-12"></div>
              <div class="col">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Inspect Date</label>
                  <div class="col-xl">
                    <input type="date" name="inspect_date" class="form-control" value="<?= date('Y-m-d') ?>" required>
                  </div>
                </div>
              </div>
              <div class="col-md-12"></div>
              <div class="col">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Inspect Time</label>
                  <div class="col-xl">
                    <input type="time" name="inspect_time" class="form-control" value="<?= date('H:i:s') ?>" required>
                  </div>
                </div>
              </div>

              <div class="col-md-12"></div>
              <div class="col">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Inspect Area</label>
                  <div class="col-xl">
                    <select class="select2 will_enable" name="area">
                      <option value="">---</option>
                      <?php foreach ($area_v2 as $value_area) {?>
                        <option value="<?= $value_area['id'] ?>"><?= $value_area['name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-12"></div>
              <div class="col">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Inspect Location</label>
                  <div class="col-xl">
                    <select class="select2 will_enable" name="location">
                      <option value="">---</option>
                      <?php foreach ($location_v2 as $value_location) {?>
                        <option value="<?= $value_location['id'] ?>" data-chained="<?php echo $value_location['id_area'] ?>"><?= $value_location['name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <script type="text/javascript">
                $("select[name=location]").chained("select[name=area]");
              </script>

              <div class="col-md-12"></div>
              <div class="col">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Invitation Type</label>
                  <div class="col-xl">
                    <select name="status_invitation" class="select2" style="width:100%" required>
                      <option value="0">Invitation Witness</option>
                      <option value="1">Notification Activity</option>
                    </select>
                  </div>
                </div>
              </div>

                <div class="col-md-12"></div>
                <div class="col">
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
                <div class="col">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Notes</label>
                    <div class="col-xl">
                      <textarea class="form-control" name="note"></textarea>
                    </div>
                  </div>
                </div>

            </div>

              <div class="col-6">
                <div class="row card">
                  <div class="col">
                    <span style="color:red;font-weight: bold;font-style: italic;">Please check NDT Methods</span>
                    <br>

                    <?php foreach ($master_ndt as $key => $value) { ?>
                    <div class="form-group row">
                      <div class="col-1">
                        <input style="width: 20px; height: 20px" onclick="validate(this, '<?= $value['id'] ?>')" class="form-control ndt_check" type="checkbox" name="ndt_type[<?= $value['id'] ?>]">
                      </div>
                      <label for="" class="col-1 col-form-label text-muted"><?= $value['ndt_initial'] ?></label>
                      <div class="col-10">
                        <select name="vendor[<?= $value['id'] ?>]" class="select2 vendor_<?= $value['id'] ?>" style="width: 100%">
                          <option value="">---</option>
                          <?php foreach ($vendor as $value_vendor) {?>
                            <option value="<?= $value_vendor['id_company'] ?>"><?= $value_vendor['company_name'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <?php } ?>

                  </div>
                </div>
                <script type="text/javascript">
                  function validate(ini, id_me){

                    // console.log($(ini).prop("checked"))

                    if($(ini).prop("checked") == true){
                      console.log('nge centang')
                      $('.vendor_'+id_me).prop('required', true)
                    } else {
                      console.log('nge un centang')
                      $('.vendor_'+id_me).prop('required', false)
                    }

                    $('.submit').removeClass('d-none')
                    if($('.ndt_check:checkbox:checked').length > 0){
                      console.log('ada')
                      $('.submit').prop("disabled", false)
                    } else {
                      console.log('gak ada')
                      $('.submit').prop("disabled", true)
                    }
                  }
                </script>
              </div>

            </div>

            <strong class="text-danger text-center">
              By Default Showing Joint Repair Only!
            </strong>

            <hr>
            <?php } ?>
            <style type="text/css">
              .blink_me {
                animation: blinker 2s linear infinite;
              }

              @keyframes blinker {
                50% {
                  opacity: 0;
                }
              }
            </style>
            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable" width="100%">
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th rowspan="2"></th>
                    <th rowspan="2">Visual Report Number</th>
                    <th rowspan="2">Drawing No.</th>
                    <th rowspan="2">Drawing Weld Map</th>
                    <th rowspan="2">Joint No.</th>
                    <th rowspan="2">Class</th>
                    <th rowspan="2">DIA (INCH)</th>
                    <th rowspan="2">THK (MM)</th>
                    <th rowspan="2">Weld Length (MM)</th><!-- input -->
                    <th rowspan="2">Weld Date</th><!-- input -->
                    <th rowspan="1" colspan="3">Inspection</th>
                    <?php if($submitted=='submitted'){ ?>
                      <th rowspan="2">Vendor Received Date</th>
                    <?php } ?>
                    <th rowspan="2">
                      NDT Req.
                      <br>
                      <small>
                        <i class="font-weight-bold">(Only for Reference, please tick on form above)</i>
                      </small>
                    </th>
                  </tr>
                  <tr>
                    <th rowspan="1">By</th>
                    <th rowspan="1">Date</th>
                    <th rowspan="1">Location</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($list as $key => $value): ?>

                  <?php $juml = count($list) ?>
                  <tr <?= $submitted=='submitted' ? (strtotime(DATE('Y-m-d H:i:s'))-strtotime($value['ndt_transmittal_datetime'])>43200 ? 'class=""' : '') : '' ?> >

                    <td style="vertical-align: middle;">

                      <?php if($submitted!='submitted'){ ?>

                        <?php //if($value['ndt_rt']>0 OR $value['ndt_mt']>0 OR $value['ndt_ut']>0 OR $value['ndt_pa_ut']>0 OR $value['ndt_ht']>0 OR $value['ndt_ft']>0 OR $value['ndt_pt']>0 OR $value['ndt_pmi']>0 OR $value['ndt_pwht']>0){ ?>
                          <div class="custom-control custom-checkbox mr-sm-2 div_<?= $key ?>">
                            <input type="checkbox" class="custom-control-input cb<?= $key ?> <?= $value['drawing_no'] ?>" id="customControlAutosizing<?= $key ?>" name="id[<?= $key ?>]" value='<?php echo $value['id_visual'] ?>' onclick='enable_edit("<?= $key ?>", this,"<?= $value['drawing_no'] ?>")'>
                            <label class="custom-control-label" for="customControlAutosizing<?= $key ?>"></label>
                          </div>
                        <?php //} else { ?>
                          <!-- <i class="fas fa-times text-danger fa-lg" title="Doesn't Have Any NDT Requirements"></i> -->
                        <?php //} ?>

                      <?php } else {?>
                        <i class="fas fa-check text-success fa-lg" title="Already Submitted"></i>
                        <?= $submitted=='submitted' && $value['result']==0 ? (strtotime(DATE('Y-m-d H:i:s'))-strtotime($value['ndt_transmittal_datetime'])>43200 ? '<i class="fas fa-lg fa-clock text-warning" title="Submitted More Than 12 Hours"></i>' : '') : '' ?>
                      <?php } ?>
                    </td>

                    <td class="align-middle">
                      <?= $project_list[$value['project_code']]['project_ref'].'-OCP-SMO-'.strtoupper($type_of_module_list[$value['type_of_module']]['code']).'-'.strtoupper($discipline_list[$value['discipline']]['initial']).'-RFI-VIS-'.$value['report_number'].' <b>Rev. '.str_pad($value['postpone_reoffer_no'], 2, 0, STR_PAD_LEFT).'</b>' ?>
                      <?php if($value['postpone_reoffer_no']>0){ ?>
                        <span class="btn btn-warning btn-sm blink_me" title="Please Make Sure this Joint Not Transmitted Yet!">
                          <i class="fas fa-info-circle"></i>
                        </span>
                      <?php } ?>
                      <?php  
                        if($value['status_inspection']==0){
                          $status_c = 'Production RFI';
                        } elseif($value['status_inspection']==1){
                          $status_c = 'Pending Approval QC';
                          if($value['revision_status_inspection']==1){
                            $status_c = 'Pending Approval (Template Revise)';
                          }
                        } elseif($value['status_inspection']==2){
                          $status_c = 'Rejected';
                        } elseif($value['status_inspection']==4){
                          $status_c = 'Pending by QC';
                        } elseif($value['status_inspection']==8){
                          $status_c = 'Request for Update';
                        } elseif($value['status_inspection']==3){
                          $status_c = 'Approved QC';
                        } elseif($value['status_inspection']==5){
                          $status_c = 'Pending Approval Client';
                        } elseif($value['status_inspection']==6){
                          $status_c = 'Rejected Client';
                        } elseif($value['status_inspection']==7){
                          if($value['status_invitation']==1){
                            $status_c = 'Reviewed Client';
                          } else {
                            $status_c = 'Accepted Client';
                          }
                        } elseif($value['status_inspection']==8){
                          $status_c = 'Request for Update';
                        } elseif($value['status_inspection']==9){
                          $status_c = 'Accepted and Release with Comment';
                        } elseif($value['status_inspection']==10){
                          $status_c = 'Postponed';
                        } elseif($value['status_inspection']==11){
                          $status_c = 'Re-Offer';
                        }
                      ?>
                        <br>
                        <span class="badge badge-info"><?= $status_c ?></span>
                    </td>

                    <td><?php echo $joint_list[$value['id_joint']]['drawing_no'] ?></td>

                    <td><?php echo $joint_list[$value['id_joint']]['drawing_wm'].' (Rev. '.number_format($joint_list[$value['id_joint']]['drawing_rev']).')' ?></td>

                    <td><?php echo $joint_list[$value['id_joint']]['joint_no'].($value['revision']>0 ? '('.$value['revision_category'].$value['revision'].')' : '') ?></td>

                    <td><?= $class[$joint_list[$value['id_joint']]['class']] ?></td>

                    <?php if($submitted=='submittedx'){ ?>
                      <td>
                        <select disabled class="select2 will_enable<?= $key ?>" name="welder_rh[<?= $key ?>][]" multiple>
                          <option value="">---</option>
                          <?php $arr_welder_rh[$key] = explode(';', $value['welder_ref_rh']) ?>
                          <?php foreach ($welder as $value_welder) {?>
                            <option value="<?= $value_welder['id_welder'] ?>" <?= in_array($value_welder['id_welder'], $arr_welder_rh[$key]) ? 'selected' : '' ?>><?= $value_welder['welder_code'] ?></option>
                          <?php } ?>
                        </select>
                      </td>
                      <td>
                        <select disabled class="select2 will_enable<?= $key ?>" name="welder_fc[<?= $key ?>][]" multiple>
                          <option value="">---</option>
                           <?php $arr_welder_fc[$key] = explode(';', $value['welder_ref_fc']) ?>
                          <?php foreach ($welder as $value_welder) {?>
                            <option value="<?= $value_welder['id_welder'] ?>" <?= in_array($value_welder['id_welder'], $arr_welder_fc[$key]) ? 'selected' : '' ?>><?= $value_welder['welder_code'] ?></option>
                          <?php } ?>
                        </select>
                      </td>
                    <?php } ?>

                    <td><?php echo $joint_list[$value['id_joint']]['diameter'] ?></td>
                    <td><?php echo $joint_list[$value['id_joint']]['sch'] ?></td>

                    <td style="min-width: 50px !important">
                      <input type="number" name="length_of_weld[<?= $key ?>]" disabled class="form-control will_enable<?= $key ?>" value="<?= (int)$value['length_of_weld'] ?>">  
                    </td>

                    <td>
                      <div class="before<?= $key ?>">
                        <?php echo DATE('d F, Y', strtotime($value['weld_datetime'])) ?>
                      </div>
                      <div class="after<?= $key ?> fade">
                        <input type="date" name="weld_date[<?= $key ?>]" class="form-control" value="<?= DATE('Y-m-d', strtotime($value['weld_datetime'])) ?>">
                        <input type="time" name="weld_time[<?= $key ?>]" class="form-control" value="<?= DATE('H:i:s', strtotime($value['weld_datetime'])) ?>">
                      </div>
                    </td>

                    <td><?= $user_list[$value['visual_inspection_by']]['full_name'] ?></td>
                    <td><?= $value['visual_inspection_date'] ?></td>
                    <td>
                      <?php if(isset($value["area_v2"])){ ?>
                        <?= $area_name_arr_v2[$value['area_v2']]?>,<?= $location_name_arr_v2[$value['location_v2']] ?>                        
                      <?php } else { ?>
                        <?= $location_list[$value['visual_location']]['location_name'] ?>
                      <?php } ?>
                    </td>

                    <?php if($submitted=='submitted'){ ?>
                      <td>
                        <?= DATE('d F, Y H:i a', strtotime($value['ndt_transmittal_datetime'])); ?>
                      </td>
                    <?php } ?>

                    <style type="text/css">
                      .disabled-select {
                        background-color: #d5d5d5;
                        opacity: 0.5;
                        border-radius: 3px;
                        cursor: not-allowed;
                        position: absolute;
                        top: 0;
                        bottom: 0;
                        right: 0;
                        left: 0;
                      }
                      select[readonly].select2-hidden-accessible + .select2-container {
                        pointer-events: none;
                        touch-action: none;
                      }

                      select[readonly].select2-hidden-accessible + .select2-container .select2-selection {
                        background: #eee;
                        box-shadow: none;
                      }

                      select[readonly].select2-hidden-accessible + .select2-container .select2-selection__arrow,
                      select[readonly].select2-hidden-accessible + .select2-container .select2-selection__clear {
                        display: none;
                      }
                    </style>
                    <td>
                      <?php if($submitted!='submitted'){ ?>
                        <select class="select2 form-control" multiple="" readonly>
                          <?= $value['ndt_rt']>0 ?
                                '<option name="xndt['.$key.'][]" value="RT" selected>RT</option>' :
                                 '<option name="xndt['.$key.'][]" value="RT">RT</option>' ?>
                          <?= $value['ndt_mt']>0 ?
                                '<option name="xndt['.$key.'][]" value="MT" selected>MT</option>' :
                                 '<option name="xndt['.$key.'][]" value="MT">MT</option>' ?>
                          <?= $value['ndt_ut']>0 ?
                                '<option name="xndt['.$key.'][]" value="UT" selected>UT</option>' :
                                 '<option name="xndt['.$key.'][]" value="UT">UT</option>' ?>
                          <?= $value['ndt_pa_ut']>0 ?
                             '<option name="xndt['.$key.'][]" value="PA-UT" selected>PA-UT</option>' :
                              '<option name="xndt['.$key.'][]" value="PA-UT">PA-UT</option>' ?>
                          <?= $value['ndt_ht']>0 ?
                                '<option name="xndt['.$key.'][]" value="HT" selected>HT</option>' :
                                 '<option name="xndt['.$key.'][]" value="HT">HT</option>' ?>
                          <?= $value['ndt_ft']>0 ?
                                '<option name="xndt['.$key.'][]" value="FT" selected>FT</option>' :
                                 '<option name="xndt['.$key.'][]" value="FT">FT</option>' ?>
                          <?= $value['ndt_pt']>0 ?
                                '<option name="xndt['.$key.'][]" value="PT" selected>PT</option>' :
                                 '<option name="xndt['.$key.'][]" value="PT">PT</option>' ?>
                          <?= $value['ndt_pmi']>0 ?
                               '<option name="xndt['.$key.'][]" value="PMI" selected>PMI</option>' :
                                '<option name="xndt['.$key.'][]" value="PMI">PMI</option>' ?>
                          <?= $value['ndt_pwht']>0 ?
                              '<option name="xndt['.$key.'][]" value="PWHT" selected>PWHT</option>' :
                               '<option name="xndt['.$key.'][]" value="PWHT">PWHT</option>' ?>
                        </select>
                      <?php } ?>
                      <div class="<?= $submitted=='submitted' ? '' : 'd-none' ?>">
                        <?php  
                          if($value['ndt_rt']>0 OR $value['ndt_mt']>0 OR $value['ndt_ut']>0 OR $value['ndt_pa_ut']>0 OR $value['ndt_ht']>0 OR $value['ndt_ft']>0 OR $value['ndt_pt']>0 OR $value['ndt_pmi']>0 OR $value['ndt_pwht']>0){
                        ?>
                          <?= $value['ndt_rt']>0 ? '-RT<hr style="margin-top: 0cm; margin-bottom: 0cm"><input type="hidden" name="ndt['.$key.'][]" value="RT">' : '' ?>
                          <?= $value['ndt_mt']>0 ? '-MT<hr style="margin-top: 0cm; margin-bottom: 0cm"><input type="hidden" name="ndt['.$key.'][]" value="MT">' : '' ?>
                          <?= $value['ndt_ut']>0 ? '-UT<hr style="margin-top: 0cm; margin-bottom: 0cm"><input type="hidden" name="ndt['.$key.'][]" value="UT">' : '' ?>
                          <?= $value['ndt_pa_ut']>0 ? '-PA-UT<hr style="margin-top: 0cm; margin-bottom: 0cm"><input type="hidden" name="ndt['.$key.'][]" value="PA-UT">' : '' ?>
                          <?= $value['ndt_ht']>0 ? '-HT<hr style="margin-top: 0cm; margin-bottom: 0cm"><input type="hidden" name="ndt['.$key.'][]" value="HT">' : '' ?>
                          <?= $value['ndt_ft']>0 ? '-FT<hr style="margin-top: 0cm; margin-bottom: 0cm"><input type="hidden" name="ndt['.$key.'][]" value="FT">' : '' ?>
                          <?= $value['ndt_pt']>0 ? '-PT<hr style="margin-top: 0cm; margin-bottom: 0cm"><input type="hidden" name="ndt['.$key.'][]" value="PT">' : '' ?>
                          <?= $value['ndt_pmi']>0 ? '-PMI<hr style="margin-top: 0cm; margin-bottom: 0cm"><input type="hidden" name="ndt['.$key.'][]" value="PMI">' : '' ?>
                          <?= $value['ndt_pwht']>0 ? '-PWHT<hr style="margin-top: 0cm; margin-bottom: 0cm"><input type="hidden" name="ndt['.$key.'][]" value="PWHT">' : '' ?>
                        <?php } else { 
                          echo "N/A";
                          $status_ndt = 'na';
                        }?>
                      </div>
                    </td>
                  </tr>
                  
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <br>
            <div class="col-md-4">
              <div class="row mb-1">
                <div class="col-md-12">
                  <?php if($submitted!='submitted'){ ?>
                    <button type="submit" name="submit" value="draft" class="btn btn-primary submit d-none"><i class='fas fa-paper-plane'></i> Send to Vendor</button>
                  <?php } ?>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php //endif; ?>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script>
  var what_ga_is_selected

  $("select[name=module]").chained("select[name=project]");

  $('.dataTable').on( 'draw.dt', function () {
    $('.select2').select2({
      theme: 'bootstrap'
    });
    console.log(what_ga_is_selected)
    if (typeof what_ga_is_selected !== "undefined") {
      lock_one_ga(what_ga_is_selected)
    }
  });

  $('.dataTable').DataTable({
    order: [],
    columnDefs: [{
      "targets": 0,
      "orderable": false,
    }]
  })

  $(".autocomplete_doc").autocomplete({
    source: function( request, response ) {
      $.ajax( {
        url: "<?php echo base_url() ?>visual/autocomplete_drawing",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: 1,

          project :project_js,
          discipline  :discipline_js,
          module  :module_js,
          type_of_module  :type_module_js,
        },
        success: function( data ) {
          response( data );
          get_data_drawing(ui.item.value);
        }
      });
    },
    select: function (event, ui) {
      var value = ui.item.value;
      if(value == 'No Data.'){
        ui.item.value = "";
      }
      else{
        get_data_drawing(ui.item.value);
      }
    }
  });

  $(".autocomplete_wm").autocomplete({
    source: function( request, response ) {
      console.log('wm autc')
      $.ajax( {
        url: "<?php echo base_url() ?>visual/autocomplete_drawing",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: 2,

          project :project_js,
          discipline  :discipline_js,
          module  :module_js,
          type_of_module  :type_module_js,
        },
        success: function( data ) {
          response( data );
          get_data_drawing(ui.item.value);
        }
      });
    },
    select: function (event, ui) {
      var value = ui.item.value;
      if(value == 'No Data.'){
        ui.item.value = "";
      }
      else{
        get_data_drawing(ui.item.value);
      }
    }
  });

  function get_data_drawing(document_no) {
    var module = $("select[name=module]").val();
    $.ajax( {
      url: "<?php echo base_url() ?>engineering/get_data_drawing",
      dataType: "json",
      data: {
        document_no: document_no,
        module: module,
      },
      success: function(data) {
        console.log(data);
        if(data.drawing_type == 1 || data.drawing_type == 2){
          $("select[name=project]").val(data.project).trigger('change');
          $("select[name=discipline]").val(data.discipline);
          $("select[name=drawing_type]").val(data.drawing_type);
          if(module == ""){
            $("select[name=module]").val(data.module);
          }
        }
      }
    });
  }

  var selecteds = 0
  var identic

  function lock_one_ga(dwg) {
    var total = '<?= $juml ?>';
    var i;
    for (i = 0; i < total; i++) {
      if (!$('.cb' + i).hasClass(dwg)) {
        $('.cb' + i).prop("disabled", true);
        $('.div_' + i).attr('title', 'Different GA/AS');
      }
    }
  }

  function enable_edit(no, thiss, dwg){
    console.log(dwg)
    if(thiss.checked==true){
      selecteds++

      what_ga_is_selected = dwg

      var total = '<?= $juml ?>';
      var i;

      for (i = 0; i < total; i++) {
        if (!$('.cb' + i).hasClass(dwg)) {
          $('.cb' + i).prop("disabled", true);
          $('.div_' + i).attr('title', 'Different GA/AS');
        }
      }
    } else {
      selecteds--

      var total = '<?= $juml ?>';
      var i;

      if (selecteds == 0) {
        for (i = 0; i < total; i++) {
          $('.cb' + i).prop("disabled", false);
          $('.div_' + i).attr('title', '');
        }
      }
    }
    
  }
</script>