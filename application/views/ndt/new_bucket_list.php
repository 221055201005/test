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
                    <select class="form-control" name="project"  id="project_js">
                      
                      <?php if($this->permission_cookie[0] == 1){ ?>
                        <option value="">---</option>                       
                        <?php foreach ($project_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                        <?php endforeach; ?>
                      <?php } else { ?>
                        <?php foreach ($project_list as $key => $value) : ?>
                          <?php if(in_array($value['id'], $this->user_cookie[13])){ ?>
                            <option value="<?php echo $value['id'] ?>" <?php echo ($get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
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
                    <select class="form-control" name="drawing_type" id="drawing_type_js" >
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

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                  <div class="col-xl">
                    <select class="form-control" name="discipline" id="discipline_js" >
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
                    <select class="form-control" name="module"  id="module_js">
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
                    <input type="text" class="form-control autocomplete_doc" name="drawing_no" value="<?php echo @$get['drawing_no'] ?>" >
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Company</label>
                  <div class="col-xl">
                    <?php // test_var($company) ?>
                    <select class="form-control select2" name="id_company">
                      <option value="">---</option>
                      <?php foreach ($company_list as $key => $value) : ?>
                      <option value="<?php echo $value['id_company'] ?>" <?php echo (@$get['id_company'] == $value['id_company'] ? 'selected' : '') ?>><?php echo $value['company_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-12 text-right">
                <!-- <span class="mt-2 btn btn-sm btn-flat btn-secondary" name="button" value="search" onclick="resetPage()"><i class="fas fa-sync"></i> Reset</span> -->
                <button class="mt-2 btn btn-sm btn-flat btn-info" name="submit" value="search"><i class="fas fa-search"></i> Search</button>
                <script type="text/javascript">
                  function resetPage(){
                    window.location.href = "<?= base_url('ndt/new_bucket_list/') ?>";
                  }
                </script>
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
          <div class="overflow-auto">
            <table class="table table-hover text-center" width="100%" id="tableVisualbyDrawing">
              <thead class="bg-green-smoe text-white">
                <tr>
                  <th>Project</th>
                  <th>Company</th>
                  <th>Drawing No.</th>
                  <th>Drawing Type</th>
                  <th>Project</th>
                  <th>Discipline</th>
                  <th>Module</th>
                  <th>Type of Module</th>
                  
                  <th></th>

                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php //endif; ?>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script>

  $(document).ready(function() {
    $("#tableVisualbyDrawing").DataTable({
      processing: true,
      serverSide: false,
      orderable: true,
      ajax: {
        url: "<?= site_url($serverside) ?>",
        type: "POST",
        data: {
          project : "<?= $get['project'] ?>",
          drawing_type : "<?= $get['drawing_type'] ?>",
          discipline : "<?= $get['discipline'] ?>",
          module : "<?= $get['module'] ?>",
          type_of_module : "<?= $get['type_of_module'] ?>",
          drawing_no : "<?= $get['drawing_no'] ?>",
          company : "<?= $get['id_company'] ?>",
        }
      }
    })
  })

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