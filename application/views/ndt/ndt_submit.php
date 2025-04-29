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
          <h6 class="m-0">Filter Data NDT <?= $initial ?> Document</h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="" method="GET">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Project ID</label>
                  <div class="col-xl">
                    <select class="form-control" name="project" <?= $this->permission_cookie[0]==1 ? '' : 'required' ?> id="project_js">
                      <option value="">---</option>
                       <?php if($this->permission_cookie[0] == 1 || in_array($this->user_cookie[11], [4, 25])){ ?>                          
                            <?php foreach ($project_list as $key => $value) : ?>
                            <option onclick="save_project()" value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                            <?php endforeach; ?>
                          <?php } else { ?>
                            <?php foreach ($project_list as $key => $value) : ?>
                              <?php if($this->user_cookie[10] == $value['id']){ ?>
                                <option onclick="save_project()" value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
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
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Module</label>
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
                  <label class="col-md-4 col-lg-3 col-form-label ">Status Inspection</label>
                  <div class="col-xl">
                    <select class="form-control" name="result">
                      <option value="">---</option>
                      <option value="3" <?= $get['result']==3 ? 'selected' : '' ?>>Accepted</option>
                      <option value="2" <?= $get['result']==2 ? 'selected' : '' ?>>Rejected</option>
                    </select>
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
          <h6 class="m-0">NDT <?= $initial ?> Document List</h6>
        </div>
        <div class="card-body bg-white">
          <form method="POST" action="<?php echo base_url() ?>ndt/send_as_report">

            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable" width="100%">
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th>Project</th>
                    <th>Report No.</th>
                    <th>Drawing No.</th>
                    <th>Discipline</th>
                    <th>Module</th>
                    <th>Module Type</th>
                    <th>Submit By</th>
                    <th>Inspection Date</th>
                    <th>Status Inspection</th>
                    <th>Attachment Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($list as $key => $value): ?>
                  <tr>
                    <td class="text-center align-middle"><?= $project[$value['project_code']]['project_name'] ?></td>
                    <td class="text-center align-middle">
                      <?= $value['report_number'] ?>
                      <?php if(strpos(substr($value['report_number'], -2), '-') !== false){ ?>
                        <span class="badge badge-warning">
                          Extended.
                        </span>
                      <?php } ?>
                      <?php if($value['status_revise']){ ?>
                        <span class="badge badge-warning">
                          <i class="fas fa-clock"></i>
                          Under Request for Update
                        </span>
                      <?php } ?>
                    </td>
                    <td class="text-center align-middle"><?= $value['drawing_no'] ?></td>
                    <td class="text-center align-middle"><?= $discipline_list[$value['discipline']]['discipline_name'] ?></td>
                    <td class="text-center align-middle"><?= $module_list[$value['module']]['mod_desc'] ?></td>
                    <td class="text-center align-middle"><?= $type_of_module_list[$value['type_of_module']]['name'] ?></td>
                    <td class="text-center align-middle">
                      <?= '<b>'.$vendor_desc[$value['id_vendor']].'</b><hr>'.$user_list[$value['vendor_created_by']]['full_name'].' on '.DATE('d F, Y', strtotime($value['vendor_created_datetime'])) ?>
                    </td>
                    <td class="text-center align-middle"><?= DATE('d F, Y', strtotime($value['date_of_inspection'])) ?></td>
                    <td class="text-center align-middle">
                      <?php  
                        if($value['result']==3){
                          echo "<span class='badge badge-success'>Accepted</span>";
                        } 
                        elseif($value['result']==2){
                          echo "<span class='badge badge-danger'>Rejected</span>";
                        } else {
                          echo "<span class='badge badge-warning'>Pending Approval</span>";
                        }
                      ?>
                      <br>
                      <small>
                        <strong>
                          <i>
                            <?= $value['total_item'].' Joints' ?>
                          </i>
                        </strong>
                      </small>
                    </td>
                    <td class="text-center align-middle">
                    <?php
                      if($attachment[$value['submission_id']]){ ?>
                        <span class='badge badge-success'>Completed</span><br>
                        <small>
                          <strong>
                            <i>
                              <?= $user_list[$attachment[$value['submission_id']]['created_by']]['full_name'].' / '.DATE('Y-m-d', strtotime($attachment[$value['submission_id']]['created_date'])) ?>
                            </i>
                          </strong>
                        </small>
                    <?php } else { ?>
                        <span class='badge badge-danger'>Not Complete</span>
                    <?php }
                    ?>
                    </td>
                    <td class="text-center align-middle">
                      <div class="btn-group btn-sm" role="group" aria-label="Basic example">
                        <a href="<?= base_url('ndt/ndt_detail/').$initial.'/'.$value['drawing_no'].'/'.$value['report_number'].'/'.$value['submission_id'] ?>" class="btn btn-primary text-nowrap">
                          <i class="fas fa-list"></i>
                          Detail
                        </a>
                      </div>
                    </td>
                  </tr>
                  
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <br>
        </div>
      </div>
    </div>
  </div>

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

  var selecteds = 0

  function enable_edit(no, thiss){
    
    if(thiss.checked==true){
      selecteds++
      console.log(selecteds)
      console.log('yes')
      $('.will_enable'+no).removeAttr('disabled');
      $('.after'+no).removeClass('fade');
      $('.before'+no).addClass('fade');
      $('.before'+no).addClass('d-none');
      $('.report_number').prop('disabled', true);
      if(selecteds>=30){
        //$('.checkbox-big').addClass('disabled-effect')
      }
    } else {
      selecteds--
      console.log('not')
      console.log(selecteds)
      $('.after'+no).addClass('fade');
      $('.before'+no).removeClass('fade');
      $('.before'+no).removeClass('d-none');
      $('.will_enable'+no).prop('disabled', true);
      $('.report_number').removeAttr('disabled');
    }
    
  }
</script>