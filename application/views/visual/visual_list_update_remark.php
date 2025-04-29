<div id="content" class="container-fluid">

  <style type="text/css">
    .disabled-effect {
      pointer-events: none;
      opacity:0.5;
    }
  </style>

  <?php 
    error_reporting(0);
    // print_r($get['status_inspection']);
    if($get['status_inspection']!=0 && $get['status_inspection']!=2 && $get['status_inspection']!=4){
      $submit_none = 'd-none';
    }
  ?>
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
                    <select class="form-control" name="project" id="project_js">
                      <option value="">---</option>
                      <?php if($this->permission_cookie[0] == 1){ ?>                          
                        <?php foreach ($project_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$project_id == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                        <?php endforeach; ?>
                      <?php } else { ?>
                        <?php foreach ($project_list as $key => $value) : ?>
                          <?php if($this->user_cookie[10] == $value['id']){ ?>
                            <option value="<?php echo $value['id'] ?>" <?php echo ($this->user_cookie[10] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                          <?php } ?>
                        <?php endforeach; ?>
                      <?php } ?>
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
                    <select class="form-control" name="drawing_type" id="drawing_type_js">
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
                    <select class="form-control" name="discipline" id="discipline_js">
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
              <div class="col-6"><?php //test_var($module_list, 1) ?>
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="module" id="module_js">
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
                    <input required type="text" class="form-control autocomplete_doc" name="drawing_no" value="<?php echo @$get['drawing_no'] ?>">
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
                    <select class="form-control" name="status_inspection">
                      <option value="">---</option>
                      <option value="0" <?= $get['status_inspection']==0 ? 'selected' : '' ?>>Ready</option>
                      <option value="1" <?= $get['status_inspection']==1 ? 'selected' : '' ?>>Inspection</option>
                      <option value="2" <?= $get['status_inspection']==2 ? 'selected' : '' ?>>Rejected</option>
                      <option value="3" <?= $get['status_inspection']==3 ? 'selected' : '' ?>>Approved</option>
                      <option value="4" <?= $get['status_inspection']==4 ? 'selected' : '' ?>>Pending By QC</option>
                      <option value="5" <?= $get['status_inspection']==5 ? 'selected' : '' ?>>Transmitted</option>
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
                      <option value="">---</option>
                      <?php foreach ($class_list as $key => $value){?>
                        <option value="<?= $value['id'] ?>" <?= $value['id']==$get['class'] ? 'selected' : '' ?>><?= $value['class_code'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted"><strong>Workpack Number</strong></label>
                  <div class="col-xl">
                    <input type="text" name="workpack_no" class="form-control workpack_no" placeholder="Work Pack Number"
                      value="<?= $get['workpack_no'] ? $get['workpack_no'] : '' ?>">
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
  
  <?php //if(isset($get['submit'])): ?>
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
          <form method="POST" action="<?php echo base_url() ?>visual/submit_to_draft_update_remarks">
            
            <div class="row <?= $submit_none ?>">
              <div class="col">
                <span class="btn btn-primary" id="thicked">
                  <i class="fas fa-clipboard-check"></i><b> 0</b> Item thicked
                </span><b class="text-danger"> Max 30 Item Thicked Allowed</b>
              </div>
            </div>
            <br>
            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable" width="100%">
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th rowspan="2"><b>#</b></th>

                    <!-- <th rowspan="2">Workpack No.</th> -->
                    <th rowspan="2">Document No.</th>
                    <th rowspan="2">Drawing Weld Map</th>
                    <th rowspan="2">Joint No.</th>
                    <th rowspan="2">Class</th>
                    <th rowspan="2">Weld Type</th> 
                    <th rowspan="2">Cons/Lot No.</th><!-- input -->
                    <th rowspan="1" colspan="2">Weld Process</th><!-- input -->
                    <th rowspan="1" colspan="2" style="min-width: 300px !important">Welder ID</th><!-- input -->
                    <th rowspan="1" colspan="2" style="min-width: 300px !important">WPS</th><!-- input -->
                    <th rowspan="2">NDT REQ.</th>
                    <th rowspan="2">DIA (INCH)</th>
                    <th rowspan="2">THK (MM)</th>
                    <th rowspan="2">Location</th><!-- input -->
                    <th rowspan="2" style="min-width: 98px !important">Weld Length (MM)</th><!-- input -->
                    <th rowspan="2" style="min-width: 300px !important">Weld Date</th><!-- input -->

                    <th rowspan="2" class="d-none">Surveyor</th>

                    <th rowspan="2">Remarks</th>
                    <th rowspan="2">Status</th>
                  </tr>
                  <tr>
                    <th style="min-width: 150px !important">R/H</th>
                    <th style="min-width: 150px !important">F/C</th>

                    <th>R/H</th>
                    <th>F/C</th>

                    <th>R/H</th>
                    <th>F/C</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $juml = 0;
                  foreach ($joint_list as $key => $value): ?>
                  <tr>
                    <td style="vertical-align: middle;">
                      <div class="custom-control custom-checkbox mr-sm-2 div_<?= $key ?> <?= $user_permission[39]==1 ? '' : 'd-none' ?>">
                        <input type="checkbox" class="custom-control-input ini_checkbox cb<?= $key ?> id_<?= $value['drawing_no'] ?>_<?= $value['discipline'] ?>_<?= $value['module'] ?>" id="customControlAutosizing<?= $key ?>" name="id[<?= $key ?>]" value='<?php echo $value['id'] ?>' onclick='enable_edit("<?= $key ?>", this, "id_<?= $value['drawing_no'] ?>_<?= $value['discipline'] ?>_<?= $value['module'] ?>")' >
                        <input class="form-control will_enable<?= $key ?>" type="hidden" name="id_visual[<?= $key ?>]" value="<?= $value['id_visual'] ?>">
                        <label class="custom-control-label" for="customControlAutosizing<?= $key ?>"></label>
                      </div>
                    </td>

                    <!-- <td><?php echo $workpack[$value['id_joint']] ?></td> -->
                    <td><?php echo $value['drawing_no']?></td>

                    <td><?php echo $value['drawing_wm'].' (Rev. '.$value['rev_wm'].')' ?></td>

                    <td><?php echo $value['joint_no'].($value['revision']>0 ? (' ('.$value['revision_category'].$value['revision'].')') : '') ?></td>

                    <td><?php echo $master_class[$value['class']] ?></td>

                    <td><?php echo isset($weld_type[$value['weld_type']]['weld_type']) ? @$weld_type[$value['weld_type']]['weld_type'] : '-' ?></td>

                    <td><input disabled class="form-control will_enable<?= $key ?>" type="text" name="cons_lot_no[<?= $key ?>]" value="<?= $value['cons_lot_no'] ?>"></td>

                    <td>
                      <select disabled class="fwrh select2 will_enable<?= $key ?> all weld_process_rh_<?= $key ?>" name="weld_process_rh[<?= $key ?>][]" onclick='cekk(<?= $key ?>)' multiple>
                        <option value="GTAW" <?= $value['process_gtaw_rh']==1 ? 'selected' : '' ?>>GTAW</option>
                        <option value="GMAW" <?= $value['process_gmaw_rh']==1 ? 'selected' : '' ?>>GMAW</option>
                        <option value="SMAW" <?= $value['process_smaw_rh']==1 ? 'selected' : '' ?>>SMAW</option>
                        <option value="FCAW" <?= $value['process_fcaw_rh']==1 ? 'selected' : '' ?>>FCAW</option>
                        <option value="SAW" <?= $value['process_saw_rh']==1 ? 'selected' : '' ?>>SAW</option>
                      </select>
                    </td>
                    <script type="text/javascript">
                      $('.all').on('select2:unselecting', function (e) {
                          setTimeout(function(){ 
                              console.log($('.all').val())
                              // $(this).closest('tr').find('.auto_rh_999').val('')
                            }, 5000);
                      });
                    </script>
                    <td>
                      <select disabled class="select2 will_enable<?= $key ?> weld_process_fc_<?= $key ?>" name="weld_process_fc[<?= $key ?>][]" multiple>
                        <option value="GTAW" <?= $value['process_gtaw_fc']==1 ? 'selected' : '' ?>>GTAW</option>
                        <option value="GMAW" <?= $value['process_gmaw_fc']==1 ? 'selected' : '' ?>>GMAW</option>
                        <option value="SMAW" <?= $value['process_smaw_fc']==1 ? 'selected' : '' ?>>SMAW</option>
                        <option value="FCAW" <?= $value['process_fcaw_fc']==1 ? 'selected' : '' ?>>FCAW</option>
                        <option value="SAW" <?= $value['process_saw_fc']==1 ? 'selected' : '' ?>>SAW</option>
                      </select>
                    </td>

                    <td class="rh_welder">
                      <div id='table_rh<?= $key; ?>'>
                        <?php $arr_welder_rh[$key] = explode(';', $value['welder_ref_rh'])?>
                        <?php //test_var($arr_welder_rh[$key]) ?>
                          <?php foreach ($arr_welder_rh[$key] as $key_welder_rh => $value_welder_rh) {?> 
                            <div class="input-group mb-3 form-check form-check-inline">
                              <input type="text" class="form-control will_enable<?= $key ?> auto_rh_999 fwrh" onfocus="welder_autocomplete_rh('999', '<?= $key ?>')" name="welder_rh[<?= $key ?>][]" value='<?= $welders[$value_welder_rh]["rwe_code"] ?>' disabled>
                              <span class="btn btn-primary will_enable<?= $key ?> disabled-effect" onclick="add_rh('<?= $key ?>')" disabled>
                                <i class="fas fa-plus"></i>
                              </span>
                            </div>
                          <?php } ?>
                          <script type="text/javascript">
                            var no = 0;
                            function add_rh(key){
                              no++;
                              var html = '<div class="input-group mb-3 form-check form-check-inline ctq_row_rh_'+no+'">';
                              html += '<input type="text" placeholder="Welder Tag" class="auto_rh_'+no+' form-control will_enable'+key+'" name="welder_rh['+key+'][]" value="" onfocus="welder_autocomplete_rh('+no+', '+key+')">'
                              html += '<span class="btn btn-danger" onclick="delete_rh('+no+')"><i class="fas fa-times"></i></span>'
                              html += '</div>'
                              $('#table_rh'+key).append(html)
                            }
                            function delete_rh(key){
                              $('.ctq_row_rh_'+key).remove()
                            }
                            function welder_autocomplete_rh(no, keyes){
                              var link_welder_rh = $('.weld_process_rh_'+keyes).val()
                              console.log(link_welder_rh)
                              $('.auto_rh_'+no).autocomplete({
                                source: function(request,response){
                                  $.post('<?php echo base_url(); ?>ndt/welder_autocomplete',{term: request.term, process: link_welder_rh}, response, 'json');
                                },
                                autoFocus: true,
                                classes: {
                                  "ui-autocomplete": "highlight"
                                }
                              });
                            }
                          </script>
                      </div>
                    </td>

                    <td>
                      <div id='table_fc<?= $key; ?>'>
                        
                          <?php $arr_welder_fc[$key] = explode(';', $value['welder_ref_fc'])?>
                          <?php foreach ($arr_welder_fc[$key] as $key_welder_fc => $value_welder_fc) {?> 
                          <div class="input-group mb-3 form-check form-check-inline">
                            <input type="text" class="form-control will_enable<?= $key ?> auto_fc_999" onfocus="welder_autocomplete_fc('999', '<?= $key ?>')" name="welder_fc[<?= $key ?>][]" value='<?= $welders[$value_welder_fc]["rwe_code"] ?>' disabled>
                            <span class="btn btn-primary will_enable<?= $key ?> disabled-effect" onclick="add_fc('<?= $key ?>')" disabled>
                              <i class="fas fa-plus"></i>
                            </span>
                          </div>
                          <?php } ?>
                          <script type="text/javascript">
                            var no_fc = 0;
                            function add_fc(key){
                              no_fc++;
                              var html = '<div class="input-group mb-3 form-check form-check-inline ctq_row_fc_'+no_fc+'">';
                              html += '<input type="text" placeholder="Welder Tag" class="auto_fc_'+no_fc+' form-control will_enable'+key+'" name="welder_fc['+key+'][]" value="" onfocus="welder_autocomplete_fc('+no_fc+', '+key+')">'
                              html += '<span class="btn btn-danger" onclick="delete_fc('+no_fc+')"><i class="fas fa-times"></i></span>'
                              html += '</div>'
                              $('#table_fc'+key).append(html)
                            }
                            function delete_fc(key){
                              $('.ctq_row_fc_'+key).remove()
                            }
                            function welder_autocomplete_fc(no, keyes_rc){
                              var link_welder_fc = $('.weld_process_fc_'+keyes_rc).val()
                              $('.auto_fc_'+no).autocomplete({
                                source: function(request,response){
                                  $.post('<?php echo base_url(); ?>ndt/welder_autocomplete',{term: request.term, process: link_welder_fc}, response, 'json');
                                },
                                autoFocus: true,
                                classes: {
                                  "ui-autocomplete": "highlight"
                                }
                              });
                            }
                          </script>
                        
                      </div>
                    </td>

                    <td>
                      <div id='wps_rh<?= $key; ?>'>
                        <?php $arr_wps_rh[$key] = explode(';', $value['wps_no_rh'])?>
                        <?php foreach ($arr_wps_rh[$key] as $key_wps_rh => $value_wps_rh) {?> 
                        <div class="input-group mb-3 form-check form-check-inline">
                          <input type="text" class="fwrh form-control will_enable<?= $key ?> auto_wps_rh_999" onfocus="wps_autocomplete_rh('999', '<?= $key; ?>')" name="wps_rh[<?= $key ?>][]" value='<?= $wps_desc[$value_wps_rh]["wps_no"] ?>' disabled>
                          <span class="btn btn-primary will_enable<?= $key ?> disabled-effect" onclick="add_wps_rh('<?= $key ?>')" disabled>
                            <i class="fas fa-plus"></i>
                          </span>
                        </div>
                        <?php } ?>
                        <script type="text/javascript">
                          var no_rh = 0;
                          function add_wps_rh(key){
                            no_rh++;
                            var html = '<div class="input-group mb-3 form-check form-check-inline wps_row_rh_'+no_rh+'">';
                            html += '<input type="text" placeholder="WPS RH" class="auto_wps_rh_'+no_rh+' fwrh form-control will_enable'+key+'" name="wps_rh['+key+'][]" value="" onfocus="wps_autocomplete_rh('+no_rh+', '+key+')">'
                            html += '<span class="btn btn-danger" onclick="delete_wps_rh('+no_rh+')"><i class="fas fa-times"></i></span>'
                            html += '</div>'
                            $('#wps_rh'+key).append(html)
                          }
                          function delete_wps_rh(key){
                            $('.wps_row_rh_'+key).remove()
                          }
                          

                          function wps_autocomplete_rh(no, keyes){

                            var linkwps = $('.weld_process_rh_'+keyes).val()
                            console.log('linkwps')
                            console.log(linkwps)
                            linkwps = linkwps.join('/')

                            $('.auto_wps_rh_'+no).autocomplete({
                              source: function(request,response){
                                $.post('<?php echo base_url(); ?>visual/wps_autocomplete/',{term: request.term, linkwps: linkwps}, response, 'json');
                              },
                              autoFocus: true,
                              classes: {
                                "ui-autocomplete": "highlight"
                              }
                            });
                          }
                        </script>
                        
                      </div>
                    </td>

                    <td>

                      <div id='wps_fc<?= $key; ?>'>
                        <?php $arr_wps_fc[$key] = explode(';', $value['wps_no_fc'])?>
                        <?php foreach ($arr_wps_fc[$key] as $key_wps_fc => $value_wps_fc) {?> 
                        <div class="input-group mb-3 form-check form-check-inline">
                          <input type="text" class="form-control will_enable<?= $key ?> auto_wps_fc_999" onfocus="wps_autocomplete_fc('999', '<?= $key; ?>')" name="wps_fc[<?= $key ?>][]" value='<?= $wps_desc[$value_wps_fc]["wps_no"] ?>' disabled>
                          <span class="btn btn-primary will_enable<?= $key ?> disabled-effect" onclick="add_wps_fc('<?= $key ?>')" disabled>
                            <i class="fas fa-plus"></i>
                          </span>
                        </div>
                        <?php } ?>
                        <script type="text/javascript">
                          var no_fc = 0;
                          function add_wps_fc(key){
                            no_fc++;
                            var html = '<div class="input-group mb-3 form-check form-check-inline wps_row_fc_'+no_fc+'">';
                            html += '<input type="text" placeholder="WPS FC" class="auto_wps_fc_'+no_fc+' form-control will_enable'+key+'" name="wps_fc['+key+'][]" value="" onfocus="wps_autocomplete_fc('+no_fc+', '+key+')">'
                            html += '<span class="btn btn-danger" onclick="delete_wps_fc('+no_fc+')"><i class="fas fa-times"></i></span>'
                            html += '</div>'
                            $('#wps_fc'+key).append(html)
                          }
                          function delete_wps_fc(key){
                            $('.wps_row_fc_'+key).remove()
                          }
                          

                          function wps_autocomplete_fc(no, keyes){

                            var linkwps = $('.weld_process_fc_'+keyes).val()
                            console.log('linkwps')
                            console.log(linkwps)
                            linkwps = linkwps.join('/')

                            $('.auto_wps_fc_'+no).autocomplete({
                              source: function(request,response){
                                $.post('<?php echo base_url(); ?>visual/wps_autocomplete/',{term: request.term, linkwps: linkwps}, response, 'json');
                              },
                              autoFocus: true,
                              classes: {
                                "ui-autocomplete": "highlight"
                              }
                            });
                          }
                        </script>
                        
                      </div>
                    </td>

                    <td>
                      <select disabled class="select2 nowill_enable<?= $key ?>" name="ndt_req[<?= $key ?>][]" multiple>
                        <option value="">---</option>
                        <?php foreach ($master_ndt as $value_ndt) {?>
                          <option value="<?= $value_ndt['id'] ?>"><?= $value_ndt['ndt_initial'] ?></option>
                        <?php } ?>
                      </select>
                    </td>

                    <td><?php echo $value['diameter'] ?></td>
                    <td><?php echo $value['sch'] ?></td>

                    <td>
                      <select disabled class="select2 will_enable<?= $key ?>" name="location[<?= $key ?>]">
                        <option value="">---</option>
                        <?php foreach ($location as $value_location) {?>
                          <option value="<?= $value_location['id'] ?>" <?= $value_location['id']==$value['location'] ? 'selected' : '' ?>><?= $value_location['location_name'] ?></option>
                        <?php } ?>
                      </select>
                    </td>

                    <td><input disabled class="form-control will_enable<?= $key ?>" type="number" name="weld_length[<?= $key ?>]" value="<?= $value['weld_length'] ?>"></td>
                    <td>
                      <?php $weld_date_time = explode(' ', $value['weld_datetime']) ?>
                      <div class="row">
                        <div class="col-md-6">
                          <input disabled class="form-control will_enable<?= $key ?>" type="date" name="weld_date[<?= $key ?>]" value="<?= $weld_date_time[0] ?>">
                        </div>
                        <div class="col-md-6">
                          <input disabled class="form-control will_enable<?= $key ?>" type="time" name="weld_time[<?= $key ?>]" value="<?= $weld_date_time[1] ?>">
                        </div>
                      </div>
                    </td>

                    <!-- ==================================== -->
                    <td class="d-none">
                      <?php if(isset($survey[$value['id_joint']]['evidence_vt'])){ ?>
                        <img src="https://www.smoebatam.com/pcms_v2_photo/<?= $survey[$value['id_joint']]['evidence_vt'] ?>" style='width: 80px;' onclick="show_image(this, '<?= $survey[$value['id_joint']]['evidence_vt'] ?>', 'surveyor')"/>
                      <?php } else { ?>
                          <img src="<?php echo base_url(); ?>/img/img_not_avai.png" style='width: 80px;'>
                      <?php } ?>
                      <br>
                      <?= 'Action by <b>'.$user[$value['surveyor_creator']].'</b> on <b>'.DATE('d F, Y H:i:s', strtotime($value['surveyor_created_date'])).'</b>' ?>
                    </td>
                    <!-- ==================================== -->

                    <td>
                      <textarea disabled class="form-control remark_will_enable<?= $key ?>" type="text" name="inspection_remarks[<?= $key ?>]">
                        <?= $value['remarks'] ?></textarea>
                    </td>

                    <td>
                      <?php  
                        if(!isset($value['status_inspection'])){
                          echo '<badge class="badge badge-sm badge-success">Ready</badge>';
                        } elseif($value['status_inspection']==0){
                          echo '<badge class="badge badge-sm badge-info">Ready</badge>';
                        } elseif($value['status_inspection']==1){
                          echo '<badge class="badge badge-sm badge-info">Inspection</badge>';
                            if(isset($value['replacing_visual_id'])){
                              echo '<br><a href="'.base_url('visual/detail_inspection/').$value['submission_id'].'/resubmit/'.$value['replacing_visual_id'].'" class="badge badge-sm badge-danger"><i class="fas fa-exchange-alt"></i></a>';
                            }
                        } elseif($value['status_inspection']==2){
                          echo '<badge class="badge badge-sm badge-danger">Reject</badge>'; ?>
                          <input disabled class="form-control will_enable<?= $key ?>" type="hidden" name="status_inspection[<?= $key ?>]" value="<?= $value['status_inspection'] ?>">
                      <?php
                        } elseif($value['status_inspection']==3){
                          echo '<badge class="badge badge-sm badge-success">Approve</badge>';
                        } elseif($value['status_inspection']==4){
                          echo '<badge class="badge badge-sm badge-warning">Comment By QC</badge>';
                           ?>
                          <input disabled class="form-control will_enable<?= $key ?>" type="hidden" name="status_inspection[<?= $key ?>]" value="<?= $value['status_inspection'] ?>">
                      <?php
                        } elseif($value['status_inspection']==5){
                          echo '<badge class="badge badge-sm badge-warning">Transmitted</badge>';
                        } elseif($value['status_inspection']==6){
                          echo '<badge class="badge badge-sm badge-danger">Client Rejected</badge>';
                        } elseif($value['status_inspection']==7){
                          echo '<badge class="badge badge-sm badge-success">Client Approved</badge>';
                        }
                      ?>
                    </td>
                  </tr>
                  <?php 
                    $juml++;
                  endforeach; ?>
                </tbody>
              </table>
            </div>
            <br>
            <div class="col-md-12">
              <div class="row mb-1">
                <?php //if($user_permission[39]==1){ ?>
                <div class="col-md-3">
                  <button type="submit" name="submit" value="draft" class="btn btn-primary"><i class='fas fa-file-import'></i> <b>Save Remarks</b></button>
                </div>

                <?php //} ?>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php //endif; ?>

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
<script>
  $(".autocomplete_doc").autocomplete({
    source: function( request, response ) {
      $.ajax( {
        url: "<?php echo base_url() ?>visual/autocomplete_drawing",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: 1,

          project :$('#project_js').val(),
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

  $('.workpack_no').autocomplete({
    source: "<?php echo base_url(); ?>visual/autocomplete_workpack_no",
    autoFocus: true,
    classes: {
      "ui-autocomplete": "highlight"
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

          project :$('#project_js').val(),
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

  $("select[name=module]").chained("select[name=project]");

  $('.dataTable').DataTable({
    order: [],
    columnDefs: [{
      "targets": 0,
      "orderable": false,
    }]
  })

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

    $('.select2').select2({
        theme: 'bootstrap'
      });
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

      $('.remark_will_enable'+no).removeClass('disabled-effect');

      $('.remark_will_enable'+no).removeAttr('disabled');
      $('.nowill_enable'+no).removeAttr('disabled');
        
      $('.remark_will_enable'+no).prop('required', true);
      $('.fwrh').removeAttr('required')
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
      $('.nowill_enable'+no).prop('disabled', true);
      $('.will_enable'+no).removeAttr('required');
        // $('.fwrh').removeAttr('required')
      $('.will_enable'+no).addClass('disabled-effect');

      lock_one_ga_lef(identic)

      if(selecteds==0){
        console.log('sampai')
        for(i=0; i<total; i++){
          console.log(i)
          $('.cb'+i).removeAttr('disabled');
          $('.div_'+i).attr('title', '');
        }
      }

    }
    $("#thicked b").text(' '+selecteds)
  }

  function lock_one_ga_lef(identic){
    var total = '<?= $juml ?>';
    var i;

    for(i=0; i<total; i++){
      if($('.cb'+i).hasClass(identic) && $('.cb'+i).checked==true){
        console.log('benar')
        if(!$('.cb'+i).hasClass(identic)){
          $('.cb'+i).prop("disabled", true);
          $('.div_'+i).attr('title', 'Different GA/AS');
        }
      } else {
        console.log('salah')
        $('.cb'+i).removeAttr('disabled');
        $('.div_'+i).attr('title', '');
      }
    }
  }

  function show_image(btn, source, type) {

    if (type == "client") {
      var url = "https://www.smoebatam.com/pcms_v2_photo/fab_img/" + source
    } else {
      var url = "https://www.smoebatam.com/pcms_v2_photo/" + source

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


</script>