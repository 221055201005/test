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
                  <label class="col-md-4 col-lg-3 col-form-label ">Project ID</label>
                  <div class="col-xl">
                    <select class="form-control" name="project"  id="project_js">
                      
                      <?php if($this->permission_cookie[0] == 1){ ?>
                        <option value="">---</option>                       
                        <?php foreach ($project_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?= (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                        <?php endforeach; ?>
                      <?php } else { ?>
                        <?php foreach ($project_list as $key => $value) : ?>
                          <?php if(in_array($value['id'], $this->user_cookie[13])){ ?>
                            <option value="<?php echo $value['id'] ?>" <?= (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
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
                  <label class="col-md-4 col-lg-3 col-form-label ">Discipline</label>
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
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Module</label>
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
                  <label class="col-md-4 col-lg-3 col-form-label ">Module Type</label>
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
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Deck Elevation / Service Line</label>
                  <div class="col-xl">
                    <select class="form-control" name="deck_elevation">
                      <option value="">---</option>
                      <?php foreach ($deck_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?= $get['deck_elevation'] == $value['id'] ? 'selected' : '' ?>><?php echo $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">NDT Method</label>
                  <div class="col-xl">
                    <select class="form-control" name="ndt_method">
                      <option value="">---</option>
                      <?php foreach ($master_ndt as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['ndt_method'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['ndt_initial'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Company</label>
                  <div class="col-xl">
                    <?php // test_var($company) ?>
                    <select class="form-control select2" name="id_company">
                      <option value="">---</option>
                      <?php foreach ($company as $key => $value) : ?>
                      <option value="<?php echo $value['id_company'] ?>" <?php echo (@$get['id_company'] == $value['id_company'] ? 'selected' : '') ?>><?php echo $value['company_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
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

          <div class="overflow-auto">
            <table class="table table-hover text-center " width="100%" id="serverSide">
              <thead class="bg-green-smoe text-white">
                <tr>

                  <th class="text-nowrap">Project</th>
                  <th class="text-nowrap">Company</th>

                  <th style="min-width: 200px !important" class="text-nowrap">RFI No.</th>

                  <th class="text-nowrap">GA/ASSY Drawing No.</th>
                  <th class="text-nowrap">Weldmap Drawing No.</th>
                  <th class="text-nowrap">Test Package No.</th>
                  <th class="text-nowrap">Discipline</th>
                  <th class="text-nowrap">Module</th>
                  <th class="text-nowrap">Module Type</th>
                  <th class="text-nowrap">Deck Elevation / Service Line</th>
                  <th class="text-nowrap">NDT</th>
                  <th>Vendor</th>
                  <th style="min-width: 400px !important">Transmittal Info.</th>
                  <th>Status Invitation</th>
                  <th></th>
                </tr>
              </thead>

            </table>
          </div>
          <br>
        </div>
      </div>
    </div>
  </div>
  <?php //endif; ?>

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
    $("#serverSide").DataTable({
      processing: true,
      serverSide: true,
      orderable: true,
      ajax: {
        url: "<?= site_url($serverside) ?>",
        type: "POST",
        data: {
          project : '<?= $get['project'] ?>', 
          discipline  : '<?= $get['discipline'] ?>', 
          module  : '<?= $get['module'] ?>', 
          type_of_module  : '<?= $get['type_of_module'] ?>', 
          deck_elevation  : '<?= $get['deck_elevation'] ?>', 
          id_company  : '<?= $get['id_company'] ?>', 
        }
      }
    })
  })

  function changeVendor(ndt_type, visual_transmittal_no, thiss){
    var ndt_type = ndt_type
    var visual_transmittal_no = visual_transmittal_no
    var id_vendor = $(thiss).val()

    Swal.fire({
      title: 'Are you sure to Update this Report?',
      text: "",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Update!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "<?= base_url('ndt/change_vendor_rfi/') ?>",
          type: "post",
          data: {
            'ndt_type': ndt_type,
            'visual_transmittal_no': visual_transmittal_no,
            'id_vendor': id_vendor,
          },
          success: function(data){
            Swal.fire(
              'Data Has Been Updated !',
              '',
              'success'
            ).then(function() {
                location.reload();
                return false;
            });
          }
        });
      }
    })
  }

  function resend_notif(event, ndt_type, visual_transmittal_no){
    Swal.fire({
      title: 'Are you sure to Re-Send Notification for this Report?',
      text: "",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Send!'
    }).then((result) => {

      if (result.value) {
        $.ajax({
          url: "<?= base_url('ndt/resend_notif/') ?>",
          type: "post",
          data: {
            'ndt_type': ndt_type,
            'visual_transmittal_no': visual_transmittal_no,
          },
          success: function(data){
            Swal.fire(
              'Data Has Been Updated !',
              '',
              'success'
            ).then(function() {
                
                // location.reload();
                // return false;
            });
          }
        });
      }
    })
  }

  function request_void_data(event, ndt_type, visual_transmittal_no, discipline, type_of_module, project) {
    let url   = "<?= site_url('ndt/request_void_data/') ?>"+ndt_type+'/'+visual_transmittal_no+'/'+discipline+'/'+type_of_module+'/'+project
    var table = $('.dataTableX').DataTable();
    table.destroy();

    $("#modal").modal({
      show : true,
      keyboard : false,
      backdrop : "static"
    }).find('.modal-body').load(url)
    $('.modal-title').html(`<strong> ${visual_transmittal_no} - </strong> Void Data`)
    $('.modal-dialog').addClass('modal-lg')

    $('.dataTableX').DataTable({
      order: [],
    })
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