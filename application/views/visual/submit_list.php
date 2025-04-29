<div id="content" class="container-fluid">
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
                    <select class="form-control" name="project">
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
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                  <div class="col-xl">
                    <select class="form-control" name="discipline">
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="module">
                      <option value="">---</option>
                      <?php foreach ($module_list as $key => $value) : ?>
                      <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$get['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Module Type</label>
                  <div class="col-xl">
                    <select class="form-control" name="type_of_module">
                      <option value="">---</option>
                      <?php foreach ($type_module_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                      <?php endforeach; ?>
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
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
          <!-- <form method="POST" action="<?php echo base_url() ?>visual/submit_to_draft"> -->
            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <?php if($rfi_status=='client'){ ?>
                      <th>Report No.</th>
                    <?php } ?>
                    <th>Drawing No.</th>
                    <th>Discipline</th>
                    <th>Module</th>
                    <?php if($rfi_status!='client'){ ?>
                      <th>Requestor</th>
                      <th>Request Date</th>
                      <th>Status</th>
                    <?php } ?>
                    <th>Company</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($list as $key => $value): ?>
                    <?php //test_var($value); ?>
                  <tr>
                    <?php if($rfi_status=='client'){ ?>
                      <td><?php echo $value['report_number'] ?></td>
                    <?php } ?>
                    <td><?php echo $value['drawing_no'] ?></td>
                    <td><?php echo $discipline_list[$value['discipline']]['discipline_name'] ?></td>
                    <td><?php echo $module_list[$value['module']]['mod_desc'].' ('.$type_module_list[$value['type_of_module']]['code'].')' ?></td>

                    <?php if($rfi_status!='client'){ ?>
                      <td><?php echo $user_list[$value['requestor']]['full_name'] ?></td>
                      <td><?php echo $value['date_request'] ?></td>
                      <td>
                        <?php
                          if($value['total_reject']==$value['total_joint']){
                            echo "<span class='badge badge-danger'>Rejected</span>";
                          } elseif($value['total_approve']==$value['total_joint']){
                            echo "<span class='badge badge-success'>Approved</span>";
                          } elseif($value['total_pending']==$value['total_joint']){
                            echo "<span class='badge badge-warning text-white'>Pending Approval</span>";
                          } 
                            elseif($value['total_approve_client']==$value['total_joint']){
                              echo "<span class='badge badge-success'>Approved By Client</span>";
                            } elseif($value['total_reject_client']==$value['total_joint']){
                              echo "<span class='badge badge-danger'>Rejected By Client</span>";
                            } 
                          elseif(($value['total_approve']!=$value['total_joint'] AND $value['total_approve']>0) OR ($value['total_reject']!=$value['total_joint'] AND $value['total_reject']>0)){
                            echo "<span class='badge badge-primary'>Partial Approval</span>";
                          }
                        ?>
                      </td>
                    <?php } ?>
                    
                    <td>
                      <?php echo $value['company'] ?>
                    </td>
                    <td width="10%">
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <a class="mt-2 btn btn-sm btn-primary" href="<?= base_url('visual/detail_inspection/').($rfi_status=='client' ? $value['report_number'] : $value['submission_id']).'/'.$rfi_status.($rfi_status=='client' ? '/'.$value['drawing_no'] : '/'.$value['submission_id']) ?>">
                          <i class="fas fa-list"></i> Detail
                        </a>
                        <?php if($rfi_status=='client'){ ?>
                        <a class="mt-2 btn btn-sm btn-danger" href="<?= base_url('visual/visual_pdf/').$value['report_number'].'/client/'.$value['drawing_no']?>">
                          <i class="fas fa-file-pdf"></i> Report
                        </a>
                        <button class="mt-2 btn btn-sm btn-info" onclick="return_rfi('<?= $value["report_number"]?>', '<?= $value["drawing_no"]?>')">
                          <i class="fas fa-undo"></i> Return
                        </button>
                        <?php } else {?>
                        <button class="mt-2 btn btn-sm btn-info" onclick="return_rfi('<?= $value["submission_id"]?>', '<?= $value["drawing_no"]?>', 'return_to_pro')">
                          <i class="fas fa-undo"></i> Return
                        </button>
                        <?php } ?>
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
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  <?php //endif; ?>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script>
  $("select[name=module]").chained("select[name=project]");

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

  function return_rfi(report_number,drawing_no, backtopro){
    console.log(report_number);
    Swal.fire({
      title: 'Are you sure want to Return this RFI ?',
      text: "",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Return it!'
    }).then((result) => {
      console.log(result)
      console.log('jawabanya')
      if (result.value) {
        $.ajax({
          url: "<?= base_url('visual/return_rfi') ?>",
          type: "post",
          data: {
          'backtopro' : backtopro,
          'report_number': report_number,
          'drawing_no': drawing_no,
          },
          success: function(data){
            Swal.fire(
              'RFI has been returned!',
              '',
              'success'
            ).then(function() {
                
                location.reload();
                return false;
            });
          },
          error: function(data){
            Swal.fire(
              'RFI failed to return!',
              '',
              'error'
            ).then(function() {
                
                location.reload();
                return false;
            });
          }
        });
      }
    })

  }

  var selecteds = 0


  function enable_edit(no, thiss, identic){
    identic = identic
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