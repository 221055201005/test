<?php 
  $get = $this->input->get();
?>

<style>
    [data-tooltip] {
      position: relative;
      z-index: 2;
      cursor: pointer;
    }

    /* Hide the tooltip content by default */
    [data-tooltip]:before,
    [data-tooltip]:after {
      visibility: hidden;
      -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
      filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=0);
      opacity: 0;
      pointer-events: none;
    }

    /* Position tooltip above the element */
    [data-tooltip]:before {
      position: absolute;
      bottom: 150%;
      left: 50%;
      margin-bottom: 5px;
      margin-left: -80px;
      padding: 7px;
      width: 160px;
      -webkit-border-radius: 3px;
      -moz-border-radius: 3px;
      border-radius: 3px;
      background-color: #000;
      background-color: hsla(0, 0%, 20%, 0.9);
      color: #fff;
      content: attr(data-tooltip);
      text-align: center;
      font-size: 14px;
      line-height: 1.2;
    }

    /* Triangle hack to make tooltip look like a speech bubble */
    [data-tooltip]:after {
      position: absolute;
      bottom: 150%;
      left: 50%;
      margin-left: -5px;
      width: 0;
      border-top: 5px solid #000;
      border-top: 5px solid hsla(0, 0%, 20%, 0.9);
      border-right: 5px solid transparent;
      border-left: 5px solid transparent;
      content: " ";
      font-size: 0;
      line-height: 0;
    }

    /* Show tooltip content on hover */
    [data-tooltip]:hover:before,
    [data-tooltip]:hover:after {
      visibility: visible;
      -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
      filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=100);
      opacity: 1;
    }

    .badge-approved_comment {
      color: #ffffff;
      background-color: #2c7008;
    }

    .badge-pending_client {
      color: #ffffff;
      background-color: #b80762;
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
<div id="content" class="container-fluid">
  <div class="row">
    <div class="col-md-12">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <a class="btn btn-primary" data-toggle="collapse" href="#collapseButton" role="button" aria-expanded="false" aria-controls="collapseButton">Filter &nbsp; <i class="fas fa-angle-double-down"></i><i class="fas fa-angle-double-up"></i></a>
        </div>
        <div class="collapse <?= $this->input->post() ? 'show' : '' ?>" id="collapseButton">
	        <div class="card-body bg-white overflow-auto">
	          <form action="" method="GET">
	            <div class="row">
	              <div class="col-6">
	                <div class="form-group row">
	                  <label class="col-md-4 col-lg-3 col-form-label ">IRN No.</label>
	                  <div class="col-xl">
	                    <select class="form-control" name="report_no">
	                      <option value="">All</option>
	                      <?php foreach ($data_report_no as $key => $value) { ?>
	                        <option value="<?= $value['report_no'] ?>" <?= ($value['report_no'] == @$get['report_no'] ? 'selected' : '') ?> ><?= $value['name'] ?></option>
	                      <?php } ?>
	                    </select>
	                  </div>
	                </div>
	              </div>

	              <div class="col-md-6">
	                <div class="form-group row">
	                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
	                  <div class="col-xl">
	                    <select class="form-control" name="project" id='project_id' required>
	                       <?php if($this->permission_cookie[0] == 1){ ?>
	                        <option value="">---</option>
	                        <?php foreach ($data_project as $key => $value) : ?>
	                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
	                        <?php endforeach; ?>
	                      <?php } else { ?>
	                        <?php foreach ($data_project as $key => $value) : ?>
	                          <?php if($this->user_cookie[10] == $value['id']){ ?>
	                            <option value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
	                          <?php } ?>
	                        <?php endforeach; ?>
	                      <?php } ?>
	                    </select>
	                  </div>
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group row">
	                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
	                  <div class="col-xl">
	                    <select class="form-control" name="discipline" required>
	                      <option value="">---</option>
	                      <?php foreach ($data_discipline as $key => $value) : ?>
	                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
	                      <?php endforeach; ?>
	                    </select>
	                  </div>
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group row">
	                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Module</label>
	                  <div class="col-xl">
	                    <select class="form-control" name="module" required>
	                      <option value="">---</option>
	                      <?php foreach ($data_module as $key => $value) : ?>
	                      <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$get['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
	                      <?php endforeach; ?>
	                    </select>
	                  </div>
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group row">
	                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type Of Module</label>
	                  <div class="col-xl">
	                    <select class="form-control" name="type_of_module" required>
	                      <option value="">---</option>
	                      <?php foreach ($data_type_of_module as $key => $value) : ?>
	                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
	                      <?php endforeach; ?>
	                    </select>
	                  </div>
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group row">
	                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Company</label>
	                  <div class="col-xl">
	                    <select class="form-control select2" name="company">
	                      <option value="">---</option>
	                      <?php foreach ($data_company as $key => $value) : ?>
	                        <option value="<?php echo $value['id_company'] ?>" <?php echo (@$get['company'] == $value['id_company'] ? 'selected' : '') ?>><?php echo $value['company_name'] ?></option>
	                      <?php endforeach; ?>
	                    </select>
	                  </div>
	                </div>
	              </div>


	            </div> 

	            <div class="row">
	                <div class="col-6">
	                <div class="form-group row">
	                 
	                </div>
	              </div>
	             
	              <div class="col-6">
	                <div class="form-group row">
	                  
	                </div>
	              </div>
	            </div>

	            <div class="row">
	              <div class="col-12 text-right">
	                <button class="mt-2 btn btn-sm btn-flat btn-info"><i class="fas fa-search"></i> Search</button>
	              </div>
	            </div>
	          </form>
	        </div>
	      </div>
      </div>
    </div>
  </div>
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">

            <form action='<?php echo base_url(); ?>irn_approval_mv/submit_approval_client' method='POST'>
              <input type="hidden" name="check_all" value="0">

              <input type="hidden" name="exclude" value="">
              <input type="hidden" name="include" value="">
 
            <table class="table table-hover text-center dataTable" width="100%">
              <thead class="bg-gray-table">
                <tr>
                  <th>
                    <input type="checkbox" id="checkall" style="width: 20px; height: 20px;">
                  </th>
                  <th>Report Number</th>
                  <th>IRN Name / Remarks</th>
                  <th>Discipline</th>
                  <th>Module</th>
                  <th>Type Of Module</th>
                  <th>Drawing Number</th>
                  <!-- <th>Tag Number</th> -->
                  <th>Weld Map Drawing No.</th>
                  <!-- <th>Item / Joint No.</th> -->
                  <th>Piecemark No.</th>
                  <th>Unique No.</th>
                  <th>Profile</th>
                  <th>Size / Dia</th>
                  <th>Length</th>
                  <th>Area (m2)</th>
                  <th>THK</th>
                  <th>Status Inspection</th>
                </tr>
              </thead>
              <tbody>       
              </tbody>           
            </table>
            <button type='submit' class='btn btn-primary'> <i class="fas fa-paper-plane"></i> Submit</button>      
            </form>
         

          </div>
        </div>
      </div>
  </div>
  </div>
</div>
</div>
<script type="text/javascript"> 

  datatable();

  // $("select[name=module]").chained("select[name=project]");

  function datatable(){
    var _table = $(".dataTable").DataTable({
      destroy: true,
      stateSave: true,
      columnDefs: [{
        targets: 0,
        orderable: false
      }],
      processing: true,
      serverSide: true,
      ajax: {
        url: "<?= base_url($serverside) ?>",
        type: "POST",
        data: {
          'report_no': '<?= @$get['report_no'] ?>',
          'project': '<?= @$get['project'] ?>',
          'discipline': '<?= @$get['discipline'] ?>',
          'module': '<?= @$get['module'] ?>',
          'type_of_module': '<?= @$get['type_of_module'] ?>',
          'company': '<?= @$get['company'] ?>',

          'status_inspection': '<?= $status_inspection ?>',
          'check_all': $('input[name="check_all"]').val(),
          'exclude': $('input[name="exclude"]').val(),
          'include': $('input[name="include"]').val(),
        }
      }
    })
  }

  $('#checkall').change(function () {

    if(this.checked == true){
      $('input[name="check_all"]').val(1);
    } else {
      $('input[name="check_all"]').val(0);
    }

    $('input[name="include"]').val('');
    $('input[name="exclude"]').val('');

    $('.cb-element').prop('checked',this.checked);

    datatable();

  });

  function checkbox_change(input){
    var _val = $(input).is(':checked');

    var _check_all = $('input[name="check_all"]').val();

    var _include = $('input[name="include"]').val().split(';');
    var _exclude = $('input[name="exclude"]').val().split(';');

    var id = $(input).closest('tr').find('input[name="id"]').val();

    if(_check_all == 1){

      if(_val == true){
        _exclude.splice($.inArray(id, _exclude), 1);
      } 

      else {
        _exclude.push(id);
      }

    } 

    else {

      if(_val == true){
        _include.push(id);
      } 

      else {
        _include.splice($.inArray(id, _include), 1);
      }

    } 


    _include = _include.join(';');
    _exclude = _exclude.join(';');

    $('input[name="include"]').val(_include);
    $('input[name="exclude"]').val(_exclude);

    datatable();

  }

</script>

<script>

function return_to_draft(btn, remarks) { 
    console.log(btn); 
    $.ajax({
      url: "<?php echo base_url() ?>irn/reset_report_number",
      data: {
        report_number: $(btn).data("report_number"),
        project: $(btn).data("project"),
        discipline: $(btn).data("discipline"),
        submission_id: $(btn).data("submission_id"),
        remarks: remarks,
      },
      type: 'post',
      success: function(data) {
        if (data.includes('Error') == true) {
          sweetalert("error", data);
        } else {
          sweetalert("success", "Return Data Success!"); 
          location.reload();
        }
      }
    });
  }

  function return_to_qc(btn, remarks) { 
    console.log(btn); 
    $.ajax({
      url: "<?php echo base_url() ?>irn/reset_client_inspection",
      data: {
        report_number: $(btn).data("report_number"),
        project: $(btn).data("project"),
        discipline: $(btn).data("discipline"),
        submission_id: $(btn).data("submission_id"),
        remarks: remarks,
      },
      type: 'post',
      success: function(data) {
        if (data.includes('Error') == true) {
          sweetalert("error", data);
        } else {
          sweetalert("success", "Return Data Success!"); 
          location.reload();
        }
      }
    });
  }
</script>

<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.chained.min.js"></script>
<script>
    $("select[name=module]").chained("select[name=project]");  
</script>
