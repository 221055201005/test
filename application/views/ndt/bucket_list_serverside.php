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
              <table class="table table-hover text-center dataTable" width="100%" id="serverSide">
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
  $(document).ready(function() {
    $("#serverSide").DataTable({
      processing: true,
      serverSide: true,
      orderable: true,
      ajax: {
        url: "<?= site_url($serverside) ?>",
        type: "POST",
        data: {
        }
      }
    })
  })

  var what_ga_is_selected
  $("select[name=module]").chained("select[name=project]");
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