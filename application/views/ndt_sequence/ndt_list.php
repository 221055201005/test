<div id="content" class="container-fluid">

  <style type="text/css">
    .disabled-effect {
      pointer-events: none;
      opacity:0.5;
    }
    .bg-warning-alert {
      background-color: #fff3cd !important;
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
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Document</label>
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
  
  <?php //if(isset($get['submit'])): ?>
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
          <form method="POST" id="sendAsRepor" action="<?php echo base_url() ?>ndt/send_as_report">

            <div class="row" style="margin-bottom: 10px !important">
              <div class="col">
                <div class="row">
                  <div class="col">
                    <label><b>Report No.&nbsp;&nbsp;&nbsp;</b></label>
                    <input style="width: 350px" type="text" name="report_number" class="form-control report_number" placeholder="SOF-OCP-SMO-TS-STR-RFI-NDT-<?= $ndt_inital ?>-000001" required>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="row">
                  <div class="col">
                    <label><b>Date of Inspection&nbsp;&nbsp;&nbsp;</b></label>
                    <input style="width: 350px" type="date" name="date_of_inspection" class="form-control report_number" required value="<?= DATE('Y-m-d') ?>">
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="row">
                  <div class="custom-control custom-checkbox mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing" name="pwht_status" value='1'>
                    <label class="custom-control-label" for="customControlAutosizing"><b>APWHT</b></label>
                  </div>
                </div>
              </div>
            </div>
            <br><br>

            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable" width="100%">
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th></th>
                    <th class="text-nowrap">RFI No.</th>
                    <th class="text-nowrap">Drawing No.</th>
                    <th class="text-nowrap">Drawing Weld Map</th>
                    <th class="text-nowrap">Joint No.</th>

                    <!-- <th>DIA (INCH)</th>
                    <th>THK (MM)</th> -->

                    <th class="text-nowrap">Weld Length (MM)</th>
                    <th class="text-nowrap">Tested Length (MM)</th>

                    <th class="text-nowrap">Weld Date</th><!-- input -->
                    <th class="text-nowrap">Received</th>
                    <th class="text-nowrap">Result</th>

                    <th class="text-nowrap">Total Reject Length R/H (MM)<br><strong class="badge badge-warning"><i>(if any)</i></strong></th>
                    <th class="text-nowrap">Total Reject Length F/C (MM)<br><strong class="badge badge-warning"><i>(if any)</i></strong></th>

                    <th class="repl text-nowrap" style="min-width: 1100px !important">Repaired Length</th>
                    <th class="text-nowrap">Remarks</th>
                  </tr>
                </thead>
                <tbody>
                  <div class="modal fade" id="rerequestModal_0" tabindex="-1" role="dialog" aria-labelledby="rerequestModalLabel" aria-hidden="true">
                    <input type="hidden" name="ndt_report_number" class="form-control" value="<?= $list[0]['report_number'] ?>" required>
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="rerequestModalLabel">Next NDT Sequence</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">

                          <div class="row"> 
                            <div class="col-md-12 mt-2">
                              <div class="form-group row">
                                <label for="" class="col-xl-3 col-form-label text-muted">Vendor</label>
                                <div class="col-xl">
                                  <select name="vendor[]" class="select2" style="width: 100%" required>
                                    <option value="">---</option>
                                    <?php foreach ($vendor as $value_vendor) {?>
                                      <option value="<?= $value_vendor['id_company'] ?>"><?= $value_vendor['company_name'] ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12"></div>
                            <div class="col-md-12 mt-2">
                              <div class="form-group row">
                                <label for="" class="col-xl-3 col-form-label text-muted">Inspector Name</label>
                                <div class="col-xl">
                                  <select name="inspector_id[]" class="select2" style="width: 100%" required>
                                    <option value="">---</option>
                                    <?php foreach ($user_list as $keyu => $valueu): ?>
                                    <option value="<?= $valueu['id_user'] ?>"><?= $valueu['full_name'] ?></option>
                                    <?php endforeach; ?>
                                  </select>
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
                            <div class="col-md-12"></div>
                            <div class="col">
                              <div class="form-group row">
                                <label for="" class="col-xl-3 col-form-label text-muted">Inspect Point</label>
                                <div class="col-xl">
                                  <select class="select2 will_enable" name="point">
                                    <option value="">---</option>
                                    <?php foreach ($point_v2 as $value_point) {?>
                                      <option value="<?= $value_point['id'] ?>" data-chained="<?php echo $value_point['id_location'] ?>"><?= $value_point['name'] ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <script type="text/javascript">
                              $("select[name=location]").chained("select[name=area]");
                              $("select[name=point]").chained("select[name=location]");
                            </script>
                            <div class="col-md-12"></div>
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label for="" class="col-xl-3 col-form-label text-muted">Inspect Date</label>
                                <div class="col-xl">
                                  <input type="date" name="inspect_date[]" class="form-control" value="<?= date('Y-m-d') ?>" required>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12"></div>
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label for="" class="col-xl-3 col-form-label text-muted">Inspect Time</label>
                                <div class="col-xl">
                                  <input type="time" name="inspect_time[]" class="form-control" value="<?= date('H:i:s') ?>" required>
                                </div>
                              </div>
                            </div>

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
                              <div class="col-md-12">
                                <div class="form-group row">
                                  <label for="" class="col-xl-3 col-form-label text-muted">Notes</label>
                                  <div class="col-xl">
                                    <textarea class="form-control" name="note[]"></textarea>
                                  </div>
                                </div>
                              </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" onclick="clicked()">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <?php foreach ($list as $key => $value): ?>
                  <?php $juml = count($list) ?>

                  <tr class="align-middle tr_<?= $key ?>">
                    <td style="vertical-align: middle;" class="text-nowrap">
                      
                      <?php if($value['re_request']==1){ ?>
                          <i class="fas fa-info-circle text-warning" title="Re-Request Joint!"></i>
                      <?php } ?>

                      <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input cb<?= $key ?> id_<?= $value['drawing_no'] ?>_<?= $value['discipline'] ?>_<?= $value['module'] ?>" id="checkbox_nde<?= $key ?>" name="id[<?= $key ?>]" value='<?php echo $value['id_ndt'] ?>' 
                        onclick='enable_edit("<?= $key ?>", this, "id_<?= $value['drawing_no'] ?>_<?= $value['discipline'] ?>_<?= $value['module'] ?>")'>
                        <label class="custom-control-label" for="checkbox_nde<?= $key ?>"></label>
                      </div>

                      <input type="hidden" name="ndt_type" value="<?= $ndt_type ?>">

                      <input class="id_joint_<?= $key ?> " type="hidden" name="id_joint[<?= $key ?>]" value="<?= $value['id_joint'] ?>">

                      <input type="hidden" name="ndt_initial" value="<?= $ndt_inital ?>">
                      <input type="hidden" name="drawing_no_ndt" value="<?= $value['drawing_no'] ?>">
                      <?php if($value['status_inspection']==6){ ?>
                        <input type="hidden" name="reubmit_reject_client[<?= $key ?>]" value="1">
                      <?php } ?>
                    </td>

                    <td class="text-nowrap align-middle"><?= $project_list[$value['project_code']]['project_ref'].'-OCP-SMO-'.strtoupper($type_of_module_list[$value['type_of_module']]['code']).'-'.strtoupper($discipline_list[$value['discipline']]['initial']).'-RFI-NDT-'.$ndt_inital.'-'.str_pad($value['visual_transmittal_no'], 4, 0, STR_PAD_LEFT ) ?></td>


                    <td class="text-nowrap align-middle"><?php echo $value['drawing_no'] ?></td>

                    <td class="text-nowrap align-middle"><?php echo $value['drawing_wm'] ?></td>

                    <td class="text-nowrap align-middle"><?php echo $value['joint_no'].($value['revision']>0 ? '('.$value['revision_category'].$value['revision'].')' : '') ?></td>

                    <td class="text-nowrap align-middle">

                      <?= $value['revision']=='' ? $value['weld_length'] : $value['length_of_weld'] ?>    
                    </td>

                    <td class="text-nowrap align-middle">
                      <input onkeyup="checkTotalLength(this, '<?= $value['ndt_type'] ?>', '<?= $value['id_visual'] ?>', '<?= $key ?>')" type="number" name="length_of_weld[<?= $key ?>]" disabled class="form-control will_enable<?= $key ?> tested_length_<?= $key ?>" value="0">  
                    </td>

                    <td class="text-nowrap align-middle">
                      <div class="before<?= $key ?>">
                        <?php echo DATE('d F, Y', strtotime($value['weld_datetime'])) ?>
                      </div>
                    </td>
                    <td class="text-nowrap align-middle">
                      <?= DATE('d F, Y H:i a', strtotime($value['submit_to_vendor_date'])); ?>
                    </td>
                    
                    <td class="text-nowrap align-middle">
                      <div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label text-success font-weight-bold">
                            <input class="form-check-input approve will_enable<?= $key ?>" type="radio" title="Approve" name="result[<?= $key ?>]" value="3" style="width: 17px; height: 17px"  onclick="repair_length('disable',<?= $key ?>)"> Approved</label>
                        </div>
                        <br>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label text-danger font-weight-bold">
                            <input class="form-check-input reject will_enable<?= $key ?>" type="radio" title="Reject" name="result[<?= $key ?>]" value="2" style="width: 17px; height: 17px"  onclick="repair_length('enable',<?= $key ?>)"> Rejected</label>
                        </div>
                      </div>
                    </td>

                    <td class="text-nowrap align-middle">
                      <input type="number" name="total_reject_length_rh[<?= $key ?>]" disabled class="form-control ctq_button_<?= $key ?> reject_length_<?= $key ?>">  
                    </td>
                    <td class="text-nowrap align-middle">
                      <input type="number" name="total_reject_length_fc[<?= $key ?>]" disabled class="form-control ctq_button_<?= $key ?> reject_length_<?= $key ?>">  
                    </td>

                    <script type="text/javascript">
                      function repair_length(param, key){
                        if(param=='enable'){
                          $('.ctq_button_'+key).removeAttr('disabled');
                          $('.repl').css('width', '744px');

                          checkRadio = 0
                        } else {
                          $('.ctq_button_'+key).prop('disabled', true);
                          $('.repl').css('width', 'auto');

                          checkRadio = 1
                        }
                      }
                    </script>
                    <td class="text-nowrap align-middle">
                      <div id='tablectq<?= $key; ?>'>
                        <div class="input-group mb-3 form-check form-check-inline"> 
                          <div>
                            <u>Deffect Type</u>
                            <br>
                            <select class="form-control ctq_button_<?= $key; ?>" name="ctq_id[<?= $key ?>][]" disabled>
                              <option value="">-----</option>                                          
                              <?php foreach ($master_data_ctq as $valuex) { ?>                                           
                                <option value="<?php echo $valuex['id']; ?>"><?php echo $valuex["ctq_description"]; ?> ( <?php echo $valuex["ctq_initial"]; ?> )</option>
                              <?php } ?>                     
                            </select>
                          </div>
                          <div>
                            <u>Deffect Length</u>
                            <br>
                            <input disabled type='number' step='any' name='ctq_length[<?= $key ?>][]' class='form-control ctq_rejected ctq_button_<?= $key; ?> length_<?= $key; ?>' id='ctq_length_<?= $value["id"]; ?>' placeholder='Type Deffect Length' onkeyup="check_length(<?= $key ?>)">
                          </div>
                          <div>
                            <u>Distance from Datum</u>
                            <br>
                            <input disabled type='text' step='any' name='ctq_datum[<?= $key ?>][]' class='form-control ctq_rejected ctq_button_<?= $key; ?>' id='ctq_datum_<?= $value["id"]; ?>' placeholder='Distance from Datum'>
                          </div>
                          <div>
                            <u>Defect Depth</u>
                            <br>
                            <input disabled type='text' step='any' name='ctq_depth[<?= $key ?>][]' class='form-control ctq_rejected ctq_button_<?= $key; ?>' id='ctq_depth_<?= $value["id"]; ?>' placeholder='Deffect Depth'>
                            <script type="text/javascript">
                              function check_length(kunci){
                                var tested_length = Number($('.tested_length_'+kunci).val());

                                var input = document.getElementsByName('ctq_length['+kunci+'][]');
                                var total = []
                                var total_length = 0
                                for (var i = 0; i < input.length; i++) {
                                  var a = input[i];
                                  total[i] = Number(a.value)
                                  total_length += parseInt(Number(a.value));
                                }

                                if(total_length>tested_length){
                                  var html =  '<div class="warning_'+kunci+'">';
                                      html+=  " <span class='badge badge-warning'>";
                                      html+=  "   Reject Length reach the limit (Tested Length)";
                                      html+=  " </span>";
                                      html+=  "</div>"; 
                                  $('#tablectq'+kunci).append(html)
                                  $('.tr_'+kunci).addClass('bg-warning-alert')
                                  $('.tombol_submit').addClass('d-none')
                                } else {
                                  $('.warning_'+kunci).remove()
                                  $('.tr_'+kunci).removeClass('bg-warning-alert')
                                  $('.tombol_submit').removeClass('d-none')
                                }

                              }
                            </script>
                          </div>
                          <div>
                            <u>Affected Welder</u>
                            <br>
                            <select disabled class='form-control welder_<?= $key ?> ctq_button_<?= $key; ?> select2s' name="ctq_welder[<?= $key ?>][0][]" id='welder_<?= $value["id"]; ?>' multiplex>
                              <option>---</option>
                              <?php foreach ($welder_per_visual[$value['id_visual']] as $valuew) { ?>
                                <option value="<?= $valuew['id'] ?>"><?= $valuew['name'] ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div>
                            <u>Planarity</u>
                            <br>
                            <select disabled id='planarity_<?= $value["id"]; ?>' name="ctq_planarity[<?= $key ?>][]" class="form-control planarity_<?= $value["id"]; ?> ctq_button_<?= $key; ?>">
                              <option value="0">Non-Planar</option>
                              <option value="1">Planar</option>
                            </select>
                          </div>
                            <div class="input-group-prepend">
                              <button disabled type="button" class='btn btn-primary ctq_button_<?= $key; ?> rounded' onclick="add_ctq<?= $key ?>('<?= $key ?>')"><i class="fas fa-plus"></i></button>

                              <script type="text/javascript">
                                var no = 0;
                                function add_ctq<?= $key ?>(key){

                                  no++;
                                  var html = '<div class="input-group mb-3 form-check form-check-inline ctq_row_'+no+'">';
                                  html+=  "<select id='ctq_id_<?= $value["id"]; ?>' class='form-control' name='ctq_id["+key+"][]'>";
                                  html+=      '<option value="">-----</option>';                                       
                                  <?php foreach ($master_data_ctq as $valuex) { ?>                                           
                                  html+=       '<option value="<?php echo $valuex['id']; ?>"><?php echo $valuex["ctq_description"]; ?> ( <?php echo $valuex["ctq_initial"]; ?> )</option>';                                            
                                  <?php } ?>                     
                                  html+=    "</select>";
                                  html+=    "<input type='number' step='any' name='ctq_length["+key+"][]' class='form-control ctq_rejected length_"+key+"' id='ctq_length_<?= $value["id"]; ?>' placeholder='Type Deffect Length' onkeyup='check_length("+key+")'>";

                                  html+= "<input type='text' step='any' name='ctq_datum["+key+"][]' class='form-control ctq_rejected ' id='ctq_datum_<?= $value["id"]; ?>' placeholder='Distance from Datum'>"

                                  html+= "<input type='text' step='any' name='ctq_depth["+key+"][]' class='form-control ctq_rejected ' id='ctq_depth_<?= $value["id"]; ?>' placeholder='Deffect Depth'>"

                                  html+= "<select class='form-control welder_"+no+" ctq_button_"+no+" select2s' name='ctq_welder["+key+"]["+no+"][]' id='welder_"+no+"' multiplex><option>---</option>"
                                  <?php foreach ($welder_per_visual[$value['id_visual']] as $keyw => $valueww) { ?>
                                    html+= "<option value='<?= $valueww['id'] ?>''><?= $valueww['name'] ?></option>"
                                  <?php } ?>
                                  html+= "</select>"

                                  html+=        "<select id='planarity_<?= $value["id"]; ?>' class='form-control planarity_<?= $value["id"]; ?>' name='ctq_planarity["+key+"][]'>";
                                  html+=          "<option value='0'>Non-Planar</option>";
                                  html+=          "<option value='1'>Planar</option>";
                                  html+=        "</select>";
                                  html+=        "<button type='button' class='btn btn-danger' onclick='remove_ctq("+no+")'><i class='fas fa-trash'></i></button>";
                                  html+=        "</div>";
                                  $('#tablectq'+key).append(html)

                                  $('.select2').select2({
                                    theme: 'bootstrap'
                                  });
                                  
                                }
                                function remove_ctq(key){
                                  $('.ctq_row_'+key).remove()
                                }
                                function welder_autocomplete(no, key){
                                  var idoin = $(".id_joint_"+key).val();
                                  console.log(idoin)
                                  $('.welder_'+no).autocomplete({
                                    source: function(request,response){
                                      $.post('<?php echo base_url(); ?>ndt/welder_autocomplete',{term: request.term, id_joint: idoin}, response, 'json');
                                    },
                                    autoFocus: true,
                                    classes: {
                                      "ui-autocomplete": "highlight"
                                    }
                                  });
                                }
                              </script>
                          </div>
                        </div>
                      </div>
                    </td>

                    <td>
                      <textarea name="remarks[?= $key ?>]" class="form-control">
                        -
                      </textarea>
                    </td>
                  </tr>
                  
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <br>
            </form>
            <div class="col-md-4">
              <div class="row mb-1">
                <div class="col-md-12">
                  <!-- <button type="submit" name="submit" value="draft" class="btn btn-primary tombol_submit d-none" onclick="clicked()">
                    <i class='fas fa-paper-plane'></i> Submit as Report
                  </button> -->
                  <!-- <button class="btn btn-primary tombol_submit" data-toggle="modal" data-target="#rerequestModal_0"> -->
                    <button class="btn btn-primary tombol_submit" onclick="showModal(this)">
                    <i class="fas fa-paper-plane"></i>
                     Submit as Report
                  </button>
                </div>
              </div>
            </div>
          <!-- </form> -->
        </div>
      </div>
    </div>
  </div>
  <?php //endif; ?>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script>
  var checkRadio
  function showModal(){
    if(checkRadio == 1){
      $("#rerequestModal_0").modal({
        show : true,
      })
    } else {
      $('#sendAsRepor').submit();
    }
  }

  function clicked() {
    $('#sendAsRepor').submit();
  }

  function checkTotalLength(thiss, ndt_type, id_visual, keynya){
    $.ajax({
      url: "<?php echo base_url() ?>ndt/checkTotalLength",
      type: "post",
      dataType: "json",
      data: {
        ndt_type: ndt_type,
        id_visual: id_visual,
      },
      success: function(data) {
        console.log(data.tested_length_inserted)
        $(thiss).attr({
          "max" : data.tested_length_inserted,        // substitute your own
          // "min" : 1          // values (or variables) here
        });
      }
    });
  }
  $(document).ready(
    function() {
      $(".select_multiple_pic").select2({
        theme: 'bootstrap',
        ajax: {
          url: "<?php echo base_url();?>ndt/get_welder_ajax_select",
          type: "post",
          dataType: "json",
          data: function (params) {
            var query = {
              search: params.term,
              department: $('select[name=assigned_dept] option').filter(':selected').val(),
            }
            return query;
          },
          processResults: function (data) {
            return {
              results: data
            }
          }
        }
      })
    }
  )

  function select_multiple_pic(noo){
    console.log('klik')
    $(".welder_"+noo).select2({
        theme: 'bootstrap',
        ajax: {
          url: "<?php echo base_url();?>ndt/get_welder_ajax_select",
          type: "post",
          dataType: "json",
          data: function (params) {
            var query = {
              search: params.term,
              department: $('select[name=assigned_dept] option').filter(':selected').val(),
            }
            return query;
          },
          processResults: function (data) {
            return {
              results: data
            }
          }
        }
      })
  }
  

  $("select[name=module]").chained("select[name=project]");

  $('.dataTable').on( 'draw.dt', function () {
    $('.select2').select2({
        theme: 'bootstrap'
      });
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
      console.log('ga as autc')
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
        }
      });
    },
  })

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
    console.log(document_no);
    console.log(module);
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

  var what_ga_is_selected
  $('.dataTable').on( 'draw.dt', function () {
    
    if(typeof what_ga_is_selected !== "undefined"){
      lock_one_ga(what_ga_is_selected)
    }

    });

  function lock_one_ga(identic){
    var total = '<?= $juml ?>';
    var i;

    for(i=0; i<total; i++){
      if(!$('.cb'+i).hasClass(identic)){
        $('.cb'+i).prop("disabled", true);
        $('.div_'+i).attr('title', 'Different GA/AS');
      }
    }
  }

  var selecteds = 0
  
  function enable_edit(no, thiss, identic){
    what_ga_is_selected = identic
    if(thiss.checked==true){
      selecteds++
      console.log(selecteds)
      console.log('yes')

      var total = '<?= $juml ?>';
      var i;

      for(i=0; i<total; i++){
        if(!$('.cb'+i).hasClass(identic)){
          $('.cb'+i).prop("disabled", true);
          $('.div_'+i).attr('title', 'Different GA/AS');
        }
      }

      $('.will_enable'+no).removeClass('disabled-effect');

      $('.will_enable'+no).removeAttr('disabled');
      $('.will_enable'+no).prop('required', true);
      if(selecteds>=30){
        $('.checkbox-big').addClass('disabled-effect')
      }
    } else {
      var total = '<?= $juml ?>';
      var i;
      selecteds--
      console.log('not')
      console.log(selecteds)
      $('.will_enable'+no).prop('disabled', true);
      $('.will_enable'+no).removeAttr('required');

      $('.will_enable'+no).addClass('disabled-effect');

      if(selecteds==0){
        console.log('sampai')
        for(i=0; i<total; i++){
          console.log(i)
          $('.cb'+i).removeAttr('disabled');
          $('.div_'+i).attr('title', 'Different GA/AS');
        }
      }

    }
    $("#thicked b").text(' '+selecteds)

    

  }
</script>