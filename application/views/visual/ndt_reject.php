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
          <h6 class="m-0"><?= $meta_title ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="" method="GET">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
                  <div class="col-xl">
                    <select class="form-control" name="project" id="project_js">
                      <?php foreach ($project_list as $key => $value) : ?>
                        <?php if(in_array($value['id'], $this->user_cookie[13])){ ?>
                          <option value="<?= $value['id'] ?>" <?= ($get['project'] == $value['id'] ? 'selected' : '') ?>><?= $value['project_name'] ?></option>
                        <?php } ?>
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
                    <select class="form-control" name="drawing_type" id="drawing_type_js">
                      <option value="">---</option>
                      <option value="1" <?= (@$get['drawing_type'] == '1' ? 'selected' : '') ?> onclick="save_drawing_type()">GA</option>
                      <option value="2" <?= (@$get['drawing_type'] == '2' ? 'selected' : '') ?> onclick="save_drawing_type()">Assembly</option>
                      <option value="3" <?= (@$get['drawing_type'] == '3' ? 'selected' : '') ?> onclick="save_drawing_type()">Weldmap</option>
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

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                  <div class="col-xl">
                    <select class="form-control" name="discipline" id="discipline_js">
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option onclick="save_discipline()" value="<?= $value['id'] ?>" <?= (@$get['discipline'] == $value['id'] ? 'selected' : '') ?>><?= $value['discipline_name'] ?></option>
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
                    <select class="form-control" name="module" id="module_js">
                      <option value="">---</option>
                      <?php foreach ($module_list as $key => $value) : ?>
                      <option onclick="save_module()" value="<?= $value['mod_id'] ?>" data-chained="<?= $value['project_id'] ?>" <?= (@$get['module'] == $value['mod_id'] ? 'selected' : '') ?>><?= $value['mod_desc'] ?></option>
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

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="type_of_module">
                      <option value="">---</option>
                      <?php foreach ($type_of_module_list as $key => $value) : ?>
                      <option onclick="save_type_module()" value="<?= $value['id'] ?>" <?= (@$get['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?= $value['name'] ?></option>
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
                    <input type="text" class="form-control autocomplete_doc" name="drawing_no" value="<?= @$get['drawing_no'] ?>">
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Weldmap</label>
                  <div class="col-xl">
                    <input type="text" class="form-control autocomplete_wm" name="drawing_wm" value="<?= @$get['drawing_wm'] ?>">
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Company</label>
                  <div class="col-xl">
                    <select class="form-control" name="company">
                      <?php foreach ($company_list as $key => $value) : ?>
                        <option value="<?= $value['id_company'] ?>" <?= $get['company']==$value['id_company'] ? 'selected' : '' ?>><?= $value['company_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
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
          <h6 class="m-0"><?= $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
          <form method="POST" action="<?= base_url() ?>visual/raise_joint_ndt_reject" id="form_submition">
            <br>
            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable" width="100%">
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th rowspan="2"></th>

                    <th rowspan="2">Project</th>
                    <th rowspan="2">Company</th>

                    <th rowspan="2">Document No.</th>

                    <th rowspan="2">Drawing Weld Map</th>
                    <th rowspan="2">Joint No.</th>

                    <th rowspan="2" class="d-none">Cons/Lot No.</th>

                    <th rowspan="1" colspan="2" class="d-none">Weld Process</th>
                    <th rowspan="1" colspan="2" class="d-none">Welder ID</th>
                    <th rowspan="1" colspan="2" class="d-none">WPS</th>

                    <th rowspan="2" class="d-none">Weld Length (MM)</th>
                    <th rowspan="2" class="d-none">Weld Date</th>

                    <th rowspan="2" class="d-none">Remarks</th>
                    <th rowspan="2" style="width: 200px !important">Action</th>
                  </tr>
                  <tr>
                    <th class="d-none">R/H</th>
                    <th class="d-none">F/C</th>

                    <th class="d-none">R/H</th>
                    <th class="d-none">F/C</th>

                    <th class="d-none">R/H</th>
                    <th class="d-none">F/C</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($joint_list as $key => $value): 
                    $juml = count($joint_list); 
                  ?>
                  <tr>
                    <td style="vertical-align: middle;">
                      <div class="custom-control custom-checkbox mr-sm-2 div_<?= $key ?>">
                        <input type="checkbox" class="custom-control-input ini_checkbox cb<?= $key ?> id_<?= $value['drawing_no'] ?>_<?= $value['discipline'] ?>_<?= $value['module'] ?>" id="customControlAutosizing<?= $key ?>" name="id[<?= $key ?>]" value='<?= $value['id_visual'] ?>' onclick='enable_edit("<?= $key ?>", this, "id_<?= $value['drawing_no'] ?>_<?= $value['discipline'] ?>_<?= $value['module'] ?>")'>
                        <input disabled class="form-control will_enable<?= $key ?>" type="hidden" name="id_visual[<?= $key ?>]" value="<?= $value['id_visual'] ?>">
                        <input disabled class="form-control will_enable<?= $key ?>" type="hidden" name="weld_type[<?= $key ?>]" value="<?= $value['weld_type'] ?>">
                        <label class="custom-control-label" for="customControlAutosizing<?= $key ?>"></label>
                      </div>
                    </td>

                    <td><?= $project_list[$value['project']]["project_name"] ?></td>
                    <td><?= $company_list[$value['company_id']]["company_name"] ?></td>

                    <td><?= $value['drawing_no'] ?></td>

                    <td><?= $value['drawing_wm'].' (Rev. '.$value['rev_wm'].')' ?></td>

                    <td><?= $value['joint_no'].($value['revision']>0 ? '('.$value['revision_category'].$value['revision'].')' : '') ?></td>

                    <td class="d-none"><input disabled class="form-control will_enable<?= $key ?>" type="text" name="cons_lot_no[<?= $key ?>]" value="<?= $value['cons_lot_no'] ?>"></td>

                    <td class="d-none">
                      <div class="form-check text-left">
                        <input name="weld_process_rh[<?= $key ?>][]" <?= $value['process_gtaw_rh']==1 ? 'checked' : '' ?> type="checkbox" class="form-check-input  all weld_process_rh_<?= $key ?> " id="gtaw_rh<?= $key ?>" value='GTAW'>
                        <label class="form-check-label" for="gtaw_rh<?= $key ?>">GTAW</label>
                      </div>
                      <div class="form-check text-left">
                        <input name="weld_process_rh[<?= $key ?>][]" <?= $value['process_gmaw_rh']==1 ? 'checked' : '' ?> type="checkbox" class="form-check-input  all weld_process_rh_<?= $key ?> " id="gmaw_rh<?= $key ?>" value='GMAW'>
                        <label class="form-check-label" for="gmaw_rh<?= $key ?>">GMAW</label>
                      </div>
                      <div class="form-check text-left">
                        <input name="weld_process_rh[<?= $key ?>][]" <?= $value['process_smaw_rh']==1 ? 'checked' : '' ?> type="checkbox" class="form-check-input  all weld_process_rh_<?= $key ?> " id="smaw_rh<?= $key ?>" value='SMAW'>
                        <label class="form-check-label" for="smaw_rh<?= $key ?>">SMAW</label>
                      </div>
                      <div class="form-check text-left">
                        <input name="weld_process_rh[<?= $key ?>][]" <?= $value['process_fcaw_rh']==1 ? 'checked' : '' ?> type="checkbox" class="form-check-input  all weld_process_rh_<?= $key ?> " id="fcaw_rh<?= $key ?>" value='FCAW'>
                        <label class="form-check-label" for="fcaw_rh<?= $key ?>">FCAW</label>
                      </div>
                      <div class="form-check text-left">
                        <input name="weld_process_rh[<?= $key ?>][]" <?= $value['process_saw_rh']==1 ? 'checked' : '' ?> type="checkbox" class="form-check-input  all weld_process_rh_<?= $key ?> " id="saw_rh<?= $key ?>" value='SAW'>
                        <label class="form-check-label" for="saw_rh<?= $key ?>">SAW</label>
                      </div>

                      <!-- <select disabled class="select2 <?= $value['weld_type'] != 25 ? 'will_enable'.$key : '' ?>" name="weld_process_rh[<?= $key ?>][]" multiple>
                        <option value="GTAW" <?= $value['process_gtaw_rh']==1 ? 'selected' : '' ?>>GTAW</option>
                        <option value="GMAW" <?= $value['process_gmaw_rh']==1 ? 'selected' : '' ?>>GMAW</option>
                        <option value="SMAW" <?= $value['process_smaw_rh']==1 ? 'selected' : '' ?>>SMAW</option>
                        <option value="FCAW" <?= $value['process_fcaw_rh']==1 ? 'selected' : '' ?>>FCAW</option>
                        <option value="SAW" <?= $value['process_saw_rh']==1 ? 'selected' : '' ?>>SAW</option>
                      </select> -->
                    </td>

                    <td class="d-none">
                      <div class="form-check text-left">
                        <input name="weld_process_fc[<?= $key ?>][]" <?= $value['process_gtaw_fc']==1 ? 'checked' : '' ?> type="checkbox" class="form-check-input  all weld_process_fc_<?= $key ?> " id="gtaw_fc<?= $key ?>" value='GTAW'>
                        <label class="form-check-label" for="gtaw_fc<?= $key ?>">GTAW</label>
                      </div>
                      <div class="form-check text-left">
                        <input name="weld_process_fc[<?= $key ?>][]" <?= $value['process_gmaw_fc']==1 ? 'checked' : '' ?> type="checkbox" class="form-check-input  all weld_process_fc_<?= $key ?> " id="gmaw_fc<?= $key ?>" value='GMAW'>
                        <label class="form-check-label" for="gmaw_fc<?= $key ?>">GMAW</label>
                      </div>
                      <div class="form-check text-left">
                        <input name="weld_process_fc[<?= $key ?>][]" <?= $value['process_smaw_fc']==1 ? 'checked' : '' ?> type="checkbox" class="form-check-input  all weld_process_fc_<?= $key ?> " id="smaw_fc<?= $key ?>" value='SMAW'>
                        <label class="form-check-label" for="smaw_fc<?= $key ?>">SMAW</label>
                      </div>
                      <div class="form-check text-left">
                        <input name="weld_process_fc[<?= $key ?>][]" <?= $value['process_fcaw_fc']==1 ? 'checked' : '' ?> type="checkbox" class="form-check-input  all weld_process_fc_<?= $key ?> " id="fcaw_fc<?= $key ?>" value='FCAW'>
                        <label class="form-check-label" for="fcaw_fc<?= $key ?>">FCAW</label>
                      </div>
                      <div class="form-check text-left">
                        <input name="weld_process_fc[<?= $key ?>][]" <?= $value['process_saw_fc']==1 ? 'checked' : '' ?> type="checkbox" class="form-check-input  all weld_process_fc_<?= $key ?> " id="saw_fc<?= $key ?>" value='SAW'>
                        <label class="form-check-label" for="saw_fc<?= $key ?>">SAW</label>
                      </div>

                      <!-- <select disabled class="select2 will_enable<?= $key ?>" name="weld_process_fc[<?= $key ?>][]" multiple>
                        <option value="GTAW" <?= $value['process_gtaw_fc']==1 ? 'selected' : '' ?>>GTAW</option>
                        <option value="GMAW" <?= $value['process_gmaw_fc']==1 ? 'selected' : '' ?>>GMAW</option>
                        <option value="SMAW" <?= $value['process_smaw_fc']==1 ? 'selected' : '' ?>>SMAW</option>
                        <option value="FCAW" <?= $value['process_fcaw_fc']==1 ? 'selected' : '' ?>>FCAW</option>
                        <option value="SAW" <?= $value['process_saw_fc']==1 ? 'selected' : '' ?>>SAW</option>
                      </select> -->
                    </td>

                    <td class="d-none">
                      <?php $arr_welder_rh[$key] = explode(';', $value['welder_ref_rh']) ?>
                      <select disabled class="select23 <?= $value['weld_type'] != 25 ? 'will_enable'.$key : '' ?>" name="welder_rh[<?= $key ?>][]" multiple>
                        <option value="">---</option>
                        <?php foreach ($welder as $value_welder) {?>
                          <option value="<?= $value_welder['id_welder'] ?>" <?= in_array($value_welder['id_welder'], $arr_welder_rh[$key]) ? 'selected' : '' ?> ><?= $value_welder['welder_code'] ?></option>
                        <?php } ?>
                      </select>
                    </td>

                    <td class="d-none">
                      <?php $arr_welder_fc[$key] = explode(';', $value['welder_ref_fc']) ?>
                      <select disabled class="select23 will_enable<?= $key ?>" name="welder_fc[<?= $key ?>][]" multiple>
                        <option value="">---</option>
                        <?php foreach ($welder as $value_welder) {?>
                          <option value="<?= $value_welder['id_welder'] ?>" <?= in_array($value_welder['id_welder'], $arr_welder_fc[$key]) ? 'selected' : '' ?> ><?= $value_welder['welder_code'] ?></option>
                        <?php } ?>
                      </select>
                    </td>

                    <td class="d-none">
                      <?php $arr_wps_rh[$key] = explode(';', $value['wps_no_rh']) ?>
                      <select disabled class="select23 <?= $value['weld_type'] != 25 ? 'will_enable'.$key : '' ?>" name="wps_rh[<?= $key ?>][]" multiple>
                        <option value="">---</option>
                        <?php foreach ($master_wps as $value_wps) {?>
                          <option value="<?= $value_wps['id_wps'] ?>" <?= in_array($value_wps['id_wps'], $arr_wps_rh[$key]) ? 'selected' : '' ?> ><?= $value_wps['wps_no'] ?></option>
                        <?php } ?>
                      </select>
                    </td>

                    <td class="d-none">
                      <?php $arr_wps_fc[$key] = explode(';', $value['wps_no_fc']) ?>
                      <select disabled class="select23 will_enable<?= $key ?>" name="wps_fc[<?= $key ?>][]" multiple>
                        <option value="">---</option>
                        <?php foreach ($master_wps as $value_wps) {?>
                          <option value="<?= $value_wps['id_wps'] ?>" <?= in_array($value_wps['id_wps'], $arr_wps_fc[$key]) ? 'selected' : '' ?> ><?= $value_wps['wps_no'] ?></option>
                        <?php } ?>
                      </select>
                    </td>

                    <td class="d-none">
                      <input disabled class="form-control will_enable<?= $key ?>" type="number" name="weld_length[<?= $key ?>]" value="<?= $value['weld_length'] ?>" style="min-width: 100px !important"></td>
                    <td style="min-width: 300px !important" class="d-none">
                      <?php $weld_date_time = explode(' ', $value['weld_datetime']) ?>
                      <div class="row">
                        <div class="col-md-6">
                          <input disabled class="form-control will_enable<?= $key ?>" type="date" name="weld_date[<?= $key ?>]" value="<?= $weld_date_time[0] ?>" style="min-width: 140px !important">
                        </div>
                        <div class="col-md-6">
                          <input disabled class="form-control will_enable<?= $key ?>" type="time" name="weld_time[<?= $key ?>]" value="<?= $weld_date_time[1] ?>" style="min-width: 140px !important">
                        </div>
                      </div>
                    </td>

                    <td style="min-width: 200px !important" class="d-none">
                      <textarea disabled class="form-control will_enable<?= $key ?>" name="inspection_remarks[<?= $key ?>]"><?= isset($value['inspection_remarks']) ? $value['inspection_remarks'] : '-' ?></textarea>
                      <!-- <input disabled class="form-control will_enable<?= $key ?>" type="text" name="inspection_remarks[<?= $key ?>]" value="<?= isset($value['inspection_remarks']) ? $value['inspection_remarks'] : '-' ?>"> -->
                    </td>

                    <td style="min-width: 93px !important">
                      <select name="action[<?= $key ?>]" class="form-control">
                        <option>Repair</option>
                        <option>Rework</option>
                        <option>No Action</option>
                      </select>
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
                  <button type="submit" name="submit" value="draft" class="btn btn-primary"><i class='fas fa-paper-plane'></i> Submit</button>
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
      $.ajax( {
        url: "<?= base_url() ?>visual/autocomplete_drawing",
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

  $(".autocomplete_wm").autocomplete({
    source: function( request, response ) {
      console.log('wm autc')
      $.ajax( {
        url: "<?= base_url() ?>visual/autocomplete_drawing",
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

  function get_data_drawing(document_no) {
    var module = $("select[name=module]").val();
    console.log(document_no);
    console.log(module);
    $.ajax( {
      url: "<?= base_url() ?>engineering/get_data_drawing",
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

  function enable_edit(no, thiss, identic){
    what_ga_is_selected = identic
    if(thiss.checked==true){
      selecteds++
      console.log(selecteds)
      console.log('yes')

      var total = '<?= $juml ?>';
      var i;

      // for(i=0; i<total; i++){
      //   if(!$('.cb'+i).hasClass(identic)){
      //     $('.cb'+i).prop("disabled", true);
      //     $('.div_'+i).attr('title', 'Different GA/AS');
      //   }
      // }

      $('.will_enable'+no).removeClass('disabled-effect');

      $('.will_enable'+no).removeAttr('disabled');
      // $('.will_enable'+no).prop('required', true);
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

      // if(selecteds==0){
      //   console.log('sampai')
      //   for(i=0; i<total; i++){
      //     console.log(i)
      //     $('.cb'+i).removeAttr('disabled');
      //     $('.div_'+i).attr('title', 'Different GA/AS');
      //   }
      // }

    }
    $("#thicked b").text(' '+selecteds)
  }

  $("#form_submition").on('submit', function() {
    Swal.fire({
      title: "PROCESSING ...",
      html: `Please Don't Close This Window`,
      onBeforeOpen() {
        Swal.showLoading()
      },
      allowOutsideClick: false
    })
  })

</script>