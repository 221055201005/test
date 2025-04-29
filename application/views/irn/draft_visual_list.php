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
	          <form action="" method="POST">
	            <div class="row">

	              <div class="col-6">
	                <div class="form-group row">
	                  <label class="col-md-4 col-lg-3 col-form-label ">IRN No.</label>
	                  <div class="col-xl">
	                    <?php //test_var($list); ?>
	                    <select class="form-control select2" name="report_no" >
	                      <option value="">---</option>
	                      <?php foreach ($list as $key => $value) : ?>
	                      <option value="<?php echo $value['report_number'] ?>" <?php echo (@$post['report_no'] == $value['report_number'] ? 'selected' : '') ?>><?php echo $value['report_number'] ?></option>
	                      <?php endforeach; ?>
	                    </select>
	                  </div>
	                </div>
	              </div>

	              <div class="col-6">
	                <div class="form-group row">
	                  <label class="col-md-4 col-lg-3 col-form-label ">Project ID</label>
	                  <div class="col-xl">
	                    <select class="form-control select2" name="project" required>
	                      <?php if($this->permission_cookie[0] == 1){ ?> 
	                        <option value="">---</option>                         
	                        <?php foreach ($project_list as $key => $value) : ?>
	                        <option value="<?php echo $value['id'] ?>" <?php echo (@$user_cookie[10] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
	                        <?php endforeach; ?>
	                      <?php } else { ?>
	                        <?php foreach ($project_list as $key => $value) : ?>
	                          <?php if($this->user_cookie[10] == $value['id']){ ?>
	                            <option value="<?php echo $value['id'] ?>" <?php echo (@$user_cookie[10] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
	                          <?php } ?>
	                        <?php endforeach; ?>
	                      <?php } ?>
	                    </select>
	                  </div>
	                </div>
	              </div>

	              <div class="col-6">
	                <div class="form-group row">
	                  <label class="col-md-4 col-lg-3 col-form-label ">Module</label>
	                  <div class="col-xl">
	                    <select class="form-control select2" name="module" >
	                      <option value="">---</option>
	                      <?php foreach ($module_list as $key => $value) : ?>
	                      <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$post['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
	                      <?php endforeach; ?>
	                    </select>
	                  </div>
	                </div>
	              </div>

	              <div class="col-6">
	                <div class="form-group row">
	                  <label class="col-md-4 col-lg-3 col-form-label ">Type Of Module</label>
	                  <div class="col-xl">
	                   <select class="form-control select2" name="type_of_module" >
	                      <option value="">---</option>
	                      <?php foreach ($type_of_module_list as $key => $value) : ?>
	                      <option value="<?php echo $value['id'] ?>" <?php echo (@$post['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
	                      <?php endforeach; ?>
	                    </select>
	                  </div>
	                </div>
	              </div>  

	              <div class="col-6">
	                <div class="form-group row">
	                  <label class="col-md-4 col-lg-3 col-form-label ">Discipline</label>
	                  <div class="col-xl">
	                    <select class="form-control select2" name="discipline" >
	                      <option value="">---</option>
	                      <?php foreach ($discipline_list as $key => $value) : ?>
	                      <option value="<?php echo $value['id'] ?>" <?php echo (@$post['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
	                      <?php endforeach; ?>
	                    </select>
	                  </div>
	                </div>
	              </div>

	              <div class="col-6">
	                <div class="form-group row">
	                  <label class="col-md-4 col-lg-3 col-form-label ">Company</label>
	                  <div class="col-xl">
	                    <select class="form-control select2" name="company_id" >
	                      <option value="">---</option>
	                      <?php foreach ($company_list as $key => $value) : ?>
	                      <option value="<?php echo $value['id_company'] ?>" <?php echo (@$post['company_id'] == $value['id_company'] ? 'selected' : '') ?>><?php echo $value['company_name'] ?></option>
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
 
            <table class="table table-hover text-center dataTable" width="100%">
              <thead class="bg-gray-table">
                <tr>
                  <th>Report No.</th>
                  <th>Project</th>
                  <th>Discipline</th>
                  <th>Module</th>
                  <th>Type of Module</th>
                  <th>Company</th>

                  <th>Action</th>
                </tr>
              </thead>   
              <tbody>               
                <?php $no = 1; foreach ($list as $key => $value) { ?>
                 <tr> 
                  <td><?= $master_report_number[$value['project_id']][$value['discipline']][$value['type_of_module']]['irn_report'.($value['company_id']==1 ? '' : '_scm')].$value['report_number'] ?></td>
                  <td><?= $project_code[$value['project_id']] ?></td>
                  <td><?= $discipline_name[$value['discipline']] ?></td>
                  <td><?= $module_code[$value['module']] ?></td>
                  <td><?= $type_of_module_name[$value['type_of_module']] ?></td>
                  <td><?= $company_name[$value['company_id']] ?></td>

                  <td>
                    <a href="<?= base_url('irn/detail_draft_visual_list/').$inspector.'/'.
                      $value['report_number'].'/'.
                      $value['project_id'].'/'.
                      $value['discipline'].'/'.
                      $value['module'].'/'.
                      $value['type_of_module'].'/'.
                      $value['company_id']
                    ?>" target="_blank" class="btn btn-primary"><i class="fas fa-list"></i> Detail</a>
                  </td>
                 </tr>
                <?php  $no++; } ?>            
              </tbody>           
            </table>
         
          </div>
        </div>
      </div>
  </div>
  </div>
</div>
</div>
<script type="text/javascript"> 
 
  $('.dataTable').DataTable({
    order: [1,"asc"], 
  })   

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
