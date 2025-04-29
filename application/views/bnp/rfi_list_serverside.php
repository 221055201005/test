<style>
  th,
  td {
    vertical-align: middle !important;
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
<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm">
        	<div class="card-header">
            <a class="btn btn-primary" data-toggle="collapse" href="#collapseButton" role="button" aria-expanded="false" aria-controls="collapseButton">Filter &nbsp; <i class="fas fa-angle-double-down"></i><i class="fas fa-angle-double-up"></i></a>
	        </div>
	        <div class="collapse <?= $this->input->get() ? 'show' : '' ?>" id="collapseButton"> 
	          <div class="card-body">
	            <h6 class="card-title">Filter</h6>
	            <hr>
	            <form action="" method="get">
	              <div class="row">

	                <div class="col-md-6">
	                  <div class="form-group row">
	                    <label for="" class="col-xl-2 col-form-label text-muted"> Discipline</label>
	                    <div class="col-xl">
	                      <select name="id_discipline" class="select2" style="width:100%">
	                        <option value="">---</option>
	                        <?php foreach ($discipline_list as $key => $value) : ?>
	                          <option value="<?= $value['id'] ?>" <?= $value['id'] == @$get['id_discipline'] ? 'selected' : '' ?>><?= $value['discipline_name'] ?></option>
	                        <?php endforeach; ?>
	                      </select>
	                    </div>
	                  </div>
	                </div>

	                <div class="col-md-6">
	                  <div class="form-group row">
	                    <label for="" class="col-xl-2 col-form-label text-muted"> Paint System</label>
	                    <div class="col-xl">
	                      <select name="id_paint_system" class="select2" style="width:100%">
	                        <option value="">---</option>
	                        <?php foreach ($paint_system_list as $key => $value) : ?>
	                          <option value="<?= $value['id'] ?>" <?= $value['id'] == @$get['id_paint_system'] ? 'selected' : '' ?>><?= $value['name'] ?></option>
	                        <?php endforeach; ?>
	                      </select>
	                    </div>
	                  </div>
	                </div>


	                <div class="col-md-6">
	                  <div class="form-group row">
	                    <label for="" class="col-xl-2 col-form-label text-muted"> Vendor</label>
	                    <div class="col-xl">
	                      <select name="id_vendor" class="select2" style="width:100%">
	                        <option value="">---</option>
	                        <?php foreach ($company_list as $key => $value) : ?>
	                          <option value="<?= $value['id_company'] ?>" <?= $value['id_company'] == @$get['id_vendor'] ? 'selected' : '' ?>><?= $value['company_name'] ?></option>
	                        <?php endforeach; ?>
	                      </select>
	                    </div>
	                  </div>
	                </div>

	                <div class="col-md-6">
	                  <div class="form-group row">
	                    <label for="" class="col-xl-2 col-form-label text-muted"> Request No</label>
	                    <div class="col-xl">
	                      <input type='text' class='form-control' name='request_no' value='<?php echo  @$get['request_no'] ?>'>
	                    </div>
	                  </div>
	                </div>

	                <div class="col-md-6">
	                  <div class="form-group row">
	                    <label for="" class="col-xl-2 col-form-label text-muted"> Trace Code</label>
	                    <div class="col-xl">
	                      <input type='text' class='form-control' name='report_number' value='<?php echo  @$get['report_number'] ?>'>
	                    </div>
	                  </div>
	                </div>


	                <div class="col-md-6 d-none">
	                  <div class="form-group row">
	                    <label for="" class="col-xl-2 col-form-label text-muted"> Status</label>
	                    <div class="col-xl">
	                      <select name="status" class="select2" style="width:100%">
	                        <option value="">---</option>
	                        <option value="0">Pending</option>
	                        <option value="1">Complete</option>
	                      </select>
	                    </div>
	                  </div>
	                </div>

	                <div class="col-md-12 text-right">
	                  <hr> 
	                  <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
	                </div>
	              </div>
	            </form>
	          </div>
	        </div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h6 class="card-title"><?= $meta_title ?></h6>
            <hr>
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive overflow-auto">
                  <table class="table table-hover text-center" id="table" style="width:100%">
                    <thead class="bg-gray-table">
                      <th>Project</th>
                      <th>Company</th>
                      <th>Request No.</th>
                      <th>Trace Code</th>
                      <th>Workpack No / WO No</th>
                      <th>IRN No.</th>
                      <th>Discipline</th>
                      <th>Paint System</th>
                      <th>Activity</th>
                      <th>Vendor</th>
                      <th>Released By</th>
                      <th>Released Date</th>
                      <th><?= $status_invitation==0 ? 'Invitation' : 'Attachment' ?> Status</th>
                      <th></th>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

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
  function request_final_report(event, submission_id, id_paint_system, id_activity) {
    let url = "<?= site_url('planning_bnp/request_final_report/') ?>"+submission_id+'/'+id_paint_system+'/'+id_activity

    $("#modal").modal({
      show : true,
      keyboard : false,
      backdrop : "static"
    }).find('.modal-body').load(url)
    $('.modal-title').html(`Request Final Report`)
    $('.modal-dialog').addClass('modal-lg')
  }

  $( document ).ready(function() {
    $("#table").DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: "<?= base_url().$serverside ?>",
        type: "POST",
        data: {
          <?php if(isset($get['id_vendor']) && !empty($get['id_vendor'])){ ?>
            id_vendor: "<?= $get['id_vendor'] ?>", 
          <?php } ?>
          <?php if(isset($get['request_no']) && !empty($get['request_no'])){ ?>
            request_no: "<?= $get['request_no'] ?>",
          <?php } ?>
          <?php if(isset($get['report_number']) && !empty($get['report_number'])){ ?>
            report_number: "<?= $get['report_number'] ?>",
          <?php } ?> 
          <?php if(isset($get['id_discipline']) && !empty($get['id_discipline'])){ ?>
            id_discipline: "<?= $get['id_discipline'] ?>",
          <?php } ?> 
          <?php if(isset($get['id_paint_system']) && !empty($get['id_paint_system'])){ ?>
            id_paint_system: "<?= $get['id_paint_system'] ?>",
          <?php } ?>  
        }
      }
    })
  })

  function returnReport(transmittal_uniqid){
    Swal.fire({
      title: 'Are you sure to Return this Report?',
      text: "",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Send!'
    }).then((result) => {

      if (result.value) {
        $.ajax({
          url: "<?php echo base_url() ?>planning_bnp/returnReport",
          dataType: "json",
          data: {
            transmittal_uniqid: transmittal_uniqid,
          },
          success: function( data ) {
            Swal.fire({
              type: "success",
              title: "SUCCESS",
              text: "Report Has Been Returned!"
            });
            location.reload(); 
          }
        });
      }
    })
  }
</script>