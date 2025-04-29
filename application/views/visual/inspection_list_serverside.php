<style>
  a[aria-expanded=true] .fa-angle-double-down {
   display: none;
  }

  a[aria-expanded=false] .fa-angle-double-up {
    display: none;
  }
</style>
<br/>
<div id="content" class="container-fluid">
  <?php error_reporting(0) ?>
  <div class="row">
    <div class="col">

      <!-- <button class="btn alert-secondary btn-filter" onclick="showFilter()"><i class="fas fa-angle-double-up icon-filter"></i> <strong>Filter</strong></button> -->

      <div class="card shadow my-3 rounded tab-filter">
        <div class="card-header">
            <a class="btn btn-primary" data-toggle="collapse" href="#collapseButton" role="button" aria-expanded="false" aria-controls="collapseButton">Filter &nbsp; <i class="fas fa-angle-double-down"></i><i class="fas fa-angle-double-up"></i></a>
        </div>
        <div class="collapse <?= $this->input->get() ? 'show' : '' ?>" id="collapseButton"> 
        <div class="card-body bg-white overflow-auto">
          <form action="" method="GET" enctype="multipart/form-data">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Project ID</label>
                  <div class="col-xl">
                    <select class="form-control" name="project">
                      <?php if($this->permission_cookie[0] == 1){ ?>
                        <option value="">---</option>                  
                        <?php foreach ($project_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$project_id == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                        <?php endforeach; ?>
                      <?php } else { ?>
                        <?php foreach ($project_list as $key => $value) : ?>
                          <?php if(in_array($value['id'], $this->user_cookie[13])){ ?>
                            <option value="<?php echo $value['id'] ?>" <?php echo ($project_id == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                          <?php } ?>
                        <?php endforeach; ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Discipline</label>
                  <div class="col-xl">
                    <select class="form-control" name="discipline">
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$discipline == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="module">
                      <option value="">---</option>
                      <?php foreach ($module_list as $key => $value) : ?>
                      <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$module == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Type of Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="type_of_module">
                      <option value="">---</option>
                      <?php foreach ($type_module_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$module_type == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Deck Elevation / Service Line</label>
                  <div class="col-xl">
                    <select class="form-control" name="deck_elevation">
                      <option value="">---</option>
                      <?php foreach ($deck_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$deck_elevation == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Company</label>
                  <div class="col-xl">
                    <select class="form-control" name="id_company">
                      <option value="">---</option>
                      <?php foreach ($company_list as $key => $value) : ?>
                      <option value="<?php echo $value['id_company'] ?>" <?php echo (@$id_company == $value['id_company'] ? 'selected' : '') ?>><?php echo $value['company_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Status Submission</label>
                  <div class="col-xl">
                    <select class="form-control" name="status_inspection">
                      <option value="777" <?= (@$status_inspection == 777 ? 'selected' : '') ?>>---</option>
                      <option value="1" <?= (@$status_inspection == 1 ? 'selected' : '') ?>>Pending Approval by QC</option>
                      <option value="212" <?= (@$status_inspection == 212 ? 'selected' : '') ?>>Rejected (History)</option>
                      <option value="2" <?= (@$status_inspection == 2 ? 'selected' : '') ?>>Rejected by QC</option>
                      <option value="3" <?= (@$status_inspection == 3 ? 'selected' : '') ?>>Approved by QC</option>
                      <option value="4" <?= (@$status_inspection == 4 ? 'selected' : '') ?>>Pending by QC</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- ============ -->
              <!-- <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted">Workpack Number</label>
                  <div class="col-xl">
                    <input type="text" name="workpack_no" class="form-control workpack_no" placeholder="Work Pack Number"
                      value="<?= $workpack_no ? $workpack_no : '' ?>">
                  </div>
                </div>
              </div> -->
            </div>
          <div class="row">
      <style>
	      [type="checkbox"], label > span{
	        vertical-align:middle;
	      }
	      .card-box {
			    position: relative;
			    color: #fff;
			    padding: 1px 5px 2px;
			    margin: 10px 0px;
			    text-align: left;
			    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
			}

			.card-box:hover {
			    text-decoration: none;
			    color: #f1f1f1;
			    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
			}

			.card-box:hover .icon i {
			    font-size: 100px;
			    transition: 1s;
			    -webkit-transition: 1s;
			}

			.card-box .inner {
			    padding: 5px 10px 0 10px;
			}

			.card-box h3 {
			    font-size: 17px;
			    font-weight: bold;
			    margin: 0 0 1px 0;
			    white-space: nowrap;
			    padding: 0;
			    text-align: left;
			}

			.card-box p {
			    font-size: 11px;
			}

			.card-box .icon {
			    position: absolute;
			    top: auto;
			    bottom: 5px;
			    right: 5px;
			    z-index: 0;
			    font-size: 50px;
			    color: rgba(0, 0, 0, 0.15);
			}

			.card-box .card-box-footer {
			    position: absolute;
			    left: 0px;
			    bottom: 0px;
			    text-align: center;
			    padding: 3px 0;
			    color: rgba(255, 255, 255, 0.8);
			    background: rgba(0, 0, 0, 0.1);
			    width: 100%;
			    text-decoration: none;
			}

		  .card-box:hover .card-box-footer {
		      background: rgba(0, 0, 0, 0.3);
		  }
	      #content{
	        overflow: auto;
	      }
	      .bg-white{
	        background: white;
	      }
	      .bg-aqua{
	        background: #00c0ef;
	      }
	      .bg-yellow{
	        background: #f39c12;
	      }
	      .bg-orange {
	        background-color: #FF851B !important;
	      }
	      .btn-flat{
	        border-radius: 0px;
	      }
	      .dropdown-toggle.collapsed::after{
	        border-left: .3em solid;
	        border-top: .3em solid transparent;
	        border-right: 0;
	        border-bottom: .3em solid transparent;
	      }
	      .font-size-9{
	        font-size: 0.9rem;
	      }
	      .checkbox-big{
	        width: 1.2rem;
	        height: 1.2rem;
	      }
	      .table-min-width-200 th:not(.dismiss-200){
	        min-width: 200px;
	        white-space: nowrap!important;
	      }
	      table th.resizing {
	        cursor: col-resize !important;
	      }
	      table th{
	        -webkit-touch-callout: none; /* iOS Safari */
	        -webkit-user-select: none; /* Safari */
	        -khtml-user-select: none; /* Konqueror HTML */
	        -moz-user-select: none; /* Old versions of Firefox */
	        -ms-user-select: none; /* Internet Explorer/Edge */
	        user-select: none; /* Non-prefixed version, currently supported by Chrome, Edge, Opera and Firefox */
	      }
	      .select2 {
	        width:100%!important;
	      }
	      .table-th-sticky th { 
	        position: sticky; top: 0; z-index: 10;
	      }
	      .bg-alert-warning{
	        background-color: #fff3cd!important;
	        color: #856404!important;
	      }
	      .bg-alert-danger{
	        background-color: #f8d7da!important;
	        color: #721c24!important;
	      }

	      .select2-container--default .select2-selection--multiple .select2-selection__choice{
	        margin-right: 2px;
	      }

      

      
      </style>

<style>
  a[aria-expanded=true] .fa-angle-double-down {
   display: none;
  }

  a[aria-expanded=false] .fa-angle-double-up {
    display: none;
  }
</style> 

            <div class="col-8">
              <div class="form-group row">                  
                <div class="col-xl">
                       
                    <div class="container text-right">
                      <div class="row">                      
                        <div class="col-lg-3">
                            <div class="card-box bg-blue">
                                <div class="inner">
                                    <h3><span id='total_pending'>Please Wait ...</span></h3>
                                    <span id='detail_card'>Pending Approval</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card-box bg-red">
                                <div class="inner">
                                <h3><span id='total_rejected'>Please Wait ...</span></h3>
                                <span id='detail_card'>Rejected</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card-box bg-red-2">
                                <div class="inner">
                                <h3><span id='total_reject_pending_resubmit'>Please Wait ...</span></h3>
                                  <span id='detail_card'>Pending Re-submission</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card-box bg-green">
                                <div class="inner">
                                <h3><span id='total_approved'>Please Wait ...</span></h3>
                                  <span id='detail_card'>Approved</span>
                                </div>
                            </div>
                        </div>                          
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <hr>
                <div class="float-right">
                  <button type='submit' class='btn btn-info btn-flat'><i class='fas fa-search'></i> Search</button>
                </div>
              </div>

            </div>
          </form>
        </div>
      </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">

      <div class="card shadow my-3 rounded">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable" id="table_inspection" style="width:100%">
                <thead class="bg-gray-table">
                  <tr>
                    <th>Project</th>
                    <!-- <th>Workpack No.</th> -->
                    <?php if($rfi_status=='client'){ ?>
                      <th>Report No.</th>
                    <?php } else { ?>
                      <th>Submission No.</th>
                    <?php } ?>
                    <th>Drawing No.</th>
                    <th>Test Package No.</th>
                    <th>Discipline</th>
                    <th>Module</th>
                    <th>Type of Module</th>
                    <th>Deck Elevation / Service Line</th>
                    <th>Company</th>
                    <?php if($rfi_status!='client'){ ?>
                      <th>Requestor</th>
                      <th>Request Date</th>
                      <th>Resubmit Status</th>
                      <th>Inspection Status</th>
                    <?php } ?>
                    <th style="min-width: 150px;">Action</th>
                  </tr>
                </thead>
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

  $(document).ready(
    function() {

      $('.workpack_no').autocomplete({
        source: "<?php echo base_url(); ?>visual/autocomplete_workpack_no",
        autoFocus: true,
        classes: {
          "ui-autocomplete": "highlight"
        }
      });
      $("#table_inspection").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "<?= site_url($serverside) ?>",
          type: "POST",
          data: {
            workpack_no: "<?= $workpack_no ?>",
            project_id: "<?= $project_id ?>",
            discipline: "<?= $discipline ?>",
            module: "<?= $module ?>",
            module_type: "<?= $module_type ?>",
            status_inspection: "<?= $status_inspection ?>",
            deck_elevation: "<?= $deck_elevation ?>",
            id_company: "<?= $id_company ?>"
          }
        }
      })
      $.ajax({
        url: "<?php echo base_url() ?>visual/loadcountinginspec",
        type: "post",
        dataType: "json",
        data: {
          workpack_no: "<?= $workpack_no ?>",
          project_id: "<?= $project_id ?>",
          discipline: "<?= $discipline ?>",
          module: "<?= $module ?>",
          module_type: "<?= $module_type ?>",
          status_inspection: "<?= $status_inspection ?>",
          deck_elevation: "<?= $deck_elevation ?>",
          id_company: "<?= $id_company ?>"
        },
        success: function( data ) {
          console.log(data)

          $('#total_pending').text(data['pending']+' Joints')
          $('#total_rejected').text(data['reject']+' Joints') // All Data Reject (include historical)
          $('#total_reject_pending_resubmit').text(data['reject_fresh']+' Joints') // All Data Reject Fresh (Pending Resubm)
          $('#total_approved').text(data['approve']+' Joints')
        }
      });
    }

  )

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