<style>
  a[aria-expanded=true] .fa-angle-double-down {
   display: none;
  }

  a[aria-expanded=false] .fa-angle-double-up {
    display: none;
  }
</style>
<div id="content" class="container-fluid">
  <?php error_reporting(0) ?>
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
            <a class="btn btn-primary" data-toggle="collapse" href="#collapseButton" role="button" aria-expanded="false" aria-controls="collapseButton">Filter &nbsp; <i class="fas fa-angle-double-down"></i><i class="fas fa-angle-double-up"></i></a>
        </div>
        <div class="collapse <?= $this->input->get() ? 'show' : '' ?>" id="collapseButton"> 
        <div class="card-body bg-white overflow-auto">
          <form action="" method="GET">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <?php //test_var($get, 1) ?>
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
                  <div class="col-xl">
                    <select class="form-control" name="project">
                      <option value="">---</option>
                      <?php if($this->permission_cookie[0] == 1){ ?>                          
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
                <thead class="bg-gray-table">
                  <tr>
                    <th>Project</th>
                    <th>Company</th>

                    <th>Submission No.</th>
                    <th>Drawing No.</th>
                    <th>Discipline</th>
                    <th>Module</th>
                    <th>Request By</th>
                    <th>Request Date</th>
                    <th>Reason</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($list as $key => $value): ?>
                  <tr>
                    <td><?= $project_list[$value['project_code']]['project_name'] ?></td>
                    <td><?= $company_list[$value['company_id']]['company_name'] ?></td>

                    <td><?= $category==2 ? explode(";", $value['submission_id'])[4] : $value['submission_id'] ?></td>
                    <td><?= $value['drawing_no'] ?></td>
                    <td><?= $discipline_list[$value['discipline']]['discipline_name'] ?></td>
                    <td><?= $module_list[$value['module']]['mod_desc'] ?></td>
                    <td><?= $user_list[$value['request_by']]['full_name'] ?></td>
                    <td><?= $value['request_date'] ?></td>
                    <td><?= $value['request_reason'] ?></td>
                    <td>
                      <?php if($status_revise=='approved'){ ?>
	                      <?php if($category==2){ ?>
	                      	<a class="mt-2 btn btn-sm btn-primary" href="<?= base_url('visual/detail_inspection_request_for_update_report/').(strtr($this->encryption->encrypt($value['submission_id']),'+=/', '.-~')).'/revise/'.(strtr($this->encryption->encrypt($value['submission_id']),'+=/', '.-~')).'/'.$value['id'] ?>">
	                          <i class="fas fa-list"></i> Update
	                        </a>
	                      <?php } else { ?>
	                        <a class="mt-2 btn btn-sm btn-primary" href="<?= base_url('visual/detail_inspection_request_for_update/').$value['submission_id'].'/revise/'.$value['submission_id'].'/'.$value['id'] ?>">
	                          <i class="fas fa-list"></i> Update
	                        </a>
	                      <?php } ?>
                      <?php } elseif ($status_revise=='submited') {?>
                        <button class="btn btn-success" onclick="approve_request('<?= $value['submission_id'] ?>', 'approve','<?= $value['id'] ?>')">
                          <i class="fas fa-check"></i>
                        </button>
                        <button class="btn btn-danger">
                          <i class="fas fa-times" onclick="approve_request('<?= $value['submission_id'] ?>', 'reject','<?= $value['id'] ?>')"></i>
                        </button>
                      <?php } elseif ($status_revise=='reapproval') { ?>
                        <a href="<?= site_url('visual/detail_inspection/'.$value['submission_id'].'/qc/'.$value['submission_id'].'/1') ?>" class="btn btn-primary"><i class="fas fa-list"></i> Detail</a>
                        </a>
                      <?php } ?>
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
  function approve_request(submission_id, aksi, id){

    // 1 Approve, 2 Reject, 3 Reapproval/Closed

    if(aksi=='approve'){
      var kalimat = 'Are you sure to Approved this request ?!'
      var status_revise = 1
    } else {
      var kalimat = 'Are you sure to Declined this request ?!'
      var status_revise = 2
    }

    Swal.fire({
      title: kalimat,
      text: "",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Update this data!'
    }).then((result) => {

      if (result.value) {
        $.ajax({
          url: "<?= base_url('visual/approve_request/') ?>",
          type: "post",
          data: {
            'submission_id': submission_id,
            'status_revise': 1,
            'id'      : id,
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

</script>