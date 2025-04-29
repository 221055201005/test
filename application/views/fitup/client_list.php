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
                  <label class="col-md-4 col-lg-3 col-form-label ">Project ID </label>
                  <div class="col-xl">
                    <select class="form-control" name="project" required>
                      <option value="">---</option>
                        <?php if($this->permission_cookie[0] == 1){ ?>                          
                          <?php foreach ($project_list as $key => $value) : ?>
                          <option value="<?php echo $value['id'] ?>" <?php echo ($user_cookie[10] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                          <?php endforeach; ?>
                        <?php } else { ?>
                          <?php foreach ($project_list as $key => $value) : ?>
                            <?php if($this->user_cookie[10] == $value['id']){ ?>
                              <option value="<?php echo $value['id'] ?>" <?php echo ($user_cookie[10] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                            <?php } ?>
                          <?php endforeach; ?>
                        <?php } ?>

                      <!-- <?php foreach ($project_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo ($user_cookie[10] == $value['id'] ? 'selected' : '') ?> ><?php echo $value['project_name'] ?></option>
                      <?php endforeach; ?> -->
                      
                    </select>
                  </div>
                </div>
              </div>
            
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Discipline</label>
                  <div class="col-xl">
                    <select class="form-control" name="discipline" >
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$post['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row">

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="module" >
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
                  <label class="col-md-4 col-lg-3 col-form-label ">Module Type</label>
                  <div class="col-xl">
                   <select class="form-control" name="type_of_module" >
                      <option value="">---</option>
                      <?php foreach ($type_of_module_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$post['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>             

            </div>

            <!-- <div class="row"> -->
              <!-- <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Discipline</label>
                  <div class="col-xl">
                    <select class="form-control" name="discipline" >
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$post['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div> -->
              <!-- <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Document Number</label>
                  <div class="col-xl">
                    <input type="text" class="form-control autocomplete_doc" name="drawing_no" value="<?php echo @$post['drawing_no'] ?>"  >
                    <input type="hidden" class="form-control autocomplete_doc" name="drawing_wm" required >
                  </div>
                </div>
              </div> -->
            <!-- </div> -->

            <div class="row">

            <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label ">Deck Elevation / Service Line</label>
                    <div class="col-xl">
                      <select name="deck_elevation" class="select2" style="width:100%">
                        <option value="">---</option>
                        <?php foreach ($deck_list as $key => $value): ?>
                        <option value="<?= $value['id'] ?>" <?= $value['id'] == $deck_ele ? 'selected' : '' ?>>
                          <?= $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Status Inspection</label>
                  <div class="col-xl">
                    <select class="form-control" name="status_inspection">
                    <option value="">---</option>
                      <option value="5" <?php echo (@$status_inspection == 5 ? 'selected' : '') ?>>Pending Approval</option>
                      <option value="6" <?php echo (@$status_inspection == 6 ? 'selected' : '') ?>>Rejected</option>
                      <option value="7" <?php echo (@$status_inspection == 7 ? 'selected' : '') ?>>Accepted</option>
                      <option value="rwvd" <?php echo (@$status_inspection == "rwvd" ? 'selected' : '') ?>>Reviewed</option>
                      <option value="9" <?php echo (@$status_inspection == 9 ? 'selected' : '') ?>>Accepted & Release with Comment</option>
                      <option value="10" <?php echo (@$status_inspection == 10 ? 'selected' : '') ?>>Postponed</option>
                      <option value="11" <?php echo (@$status_inspection == 11 ? 'selected' : '') ?>>Re-Offered</option>
                    </select>
                  </div>
                </div>
              </div>
              
            </div>

            <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label for="" class="col-xl-3 col-form-label">Inspection Authority</label>
                      <div class="col-xl">
                        <select name="inspection_authority[]" class="select2" style="width:100%" multiple>
                          <option value="0" <?= $arr_inspection_auth[0] == 1 ? 'selected' : '' ?>>Hold Point</option>
                          <option value="1" <?= $arr_inspection_auth[1] == 1 ? 'selected' : '' ?>>Witness</option>
                          <option value="2" <?= $arr_inspection_auth[2] == 1 ? 'selected' : '' ?>>Monitoring</option>
                          <option value="3" <?= $arr_inspection_auth[3] == 1 ? 'selected' : '' ?>>Review</option>
                        </select>
                      </div>
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
      <?php //if(sizeof($post) > 0){ ?>
      <div class="card border-0 shadow-sm">

        <div class="card-header">
          <h6 class="m-0">Client Document List</h6>
        </div>
        <div class="card-body">

        <div class="table-responsive">
          <div class="container-fluid">
            <table class="table table-hover text-center dataTable" width="100%">
              <thead class="bg-gray-table">
                <tr>                              
                  <th>Project</th>
                  <th>Report Number</th>
                  <th>Drawing Number</th>
                  <th>Discipline</th>
                  <th>Module</th>
                  <th>Module Type</th>
                  <th>Deck Elevation / Service Line</th>
                  <th>Rev No</th>
                  <th>Inspection By</th>
                  <th>Inspection Date</th>                  
                  <th>Status Inspection</th>
                  <th>Status Invitation</th>
                  <th width="150px;">Action</th>
                </tr>
              </thead>   
              <tbody>
                
                <?php 

                  foreach ($client_list as $key => $value) { 

                    
                    $where_status['report_number'] = $value['report_number'];
                    $where_status["status_retransmitted"]  = 0;
                    $where_status["status_resubmit <> 1"]  = null;                     
                    $data_material = $this->fitup_mod->fitup_list($where_status);
                    unset($where_status);

                    $total_data          = sizeof($data_material);
                    $total_data_all      = array_column($data_material,"status_inspection");
                    $counts              = array_count_values($total_data_all);
                    $total_pass_arr      = $counts[7];
                    $total_reject_arr    = $counts[6];
                    $total_pending_arr   = $counts[5];
                    $total_awc           = $counts[9];
                    $total_postponed_arr = $counts[10];
                    $total_reoffer_arr   = $counts[11];

                   
                   
                    // ECHO $balance;

                    if($value['status_invitation'] == 1){
                        $status_inv = "<span class='badge badge-info'>Notification Activity</span>";
                    } else if($value['status_invitation'] == 0){
                        $status_inv = "<span class='badge badge-primary'>Invitation Witness</span>";
                    }

                    $legend_output = explode(";",$value['legend_inspection_auth']);

                    $arr_inspection_auth      = array();
      
                    if($legend_output[0] == 1) {
                      $arr_inspection_auth[0] = "Hold Point";
                    }

                    if($legend_output[1] == 1) {
                      $arr_inspection_auth[1] = "Witness";
                    }

                    if($legend_output[2] == 1) {
                      $arr_inspection_auth[2] = "Monitoring";
                    }

                     if($legend_output[3] == 1) {
                      $arr_inspection_auth[3] = "Review";
                    }

                    $list_arr_inspection_authx = implode(" / ", $arr_inspection_auth);

                    if($value['status_inspection'] == 5 && $value['postpone_reoffer_no'] > 0){
                      $val_resubmit = "<br/><span class='badge badge-pill badge-secondary'>Re-Submit</span>";
                    } else {
                      $val_resubmit = null;
                    }

                    if(isset($total_pending_arr)){
                      $status_inspection = '<span class="badge badge-pill badge-warning">Pending Approval</span>';
                    } else if(isset($total_postponed_arr)){
                      $status_inspection = '<span class="badge badge-pill badge-info">Postponed By Client</span>';
                    } else if(isset($total_reoffer_arr)){
                      $status_inspection = '<span class="badge badge-pill badge-warning">Re-Offer By Client</span>';  
                    } else if(isset($total_reject_arr)){
                      $status_inspection = '<span class="badge badge-pill badge-danger">Rejected By Client</span>';
                    } else if(isset($total_awc)){
                      $status_inspection = '<span class="badge badge-pill badge-primary">Accepted & Release With Comments</span><br/><span style="font-weight:bold !important;font-size:12px !important;">'.$user_list[$value['client_inspection_by']].'</span><br/><span style="font-weight:bold !important;font-size:12px !important;">'.$value['client_inspection_date'].'</span>'; 
                    } else {
                      // $status_inspection = '<span class="badge badge-pill badge-success">Accepted By Client</span>';
                      if($legend_output[2] == 1 OR $legend_output[3] == 1) {
                        $status_inspection = '<span class="badge badge-pill badge-success">Reviewed</span><br/><span style="font-weight:bold !important;font-size:12px !important;">'.$user_list[$value['client_inspection_by']].'</span><br/><span style="font-weight:bold !important;font-size:12px !important;">'.$value['client_inspection_date'].'</span>';
                      } else {
                        $status_inspection = '<span class="badge badge-pill badge-success">Accepted By Client</span><br/><span style="font-weight:bold !important;font-size:12px !important;">'.$user_list[$value['client_inspection_by']].'</span><br/><span style="font-weight:bold !important;font-size:12px !important;">'.$value['client_inspection_date'].'</span>';
                      }
                    }

                  ?>
                 <tr>                              
                  <td><?= @$project_name[$value['project_code']] ?></td>
                  <td><?php echo @$master_report_number[$value['project_code']][$value['discipline']][$value['type_of_module']]['fitup_report'].$value['report_number']; ?></td>
                  <td><?php echo $value['drawing_no']; ?></td>
                  <td><?php echo $discipline_name[$value['discipline']]; ?></td>
                  <td><?php echo $module_code[$value['module']]; ?></td>
                  <td><?php echo $type_of_module_name[$value['type_of_module']]; ?></td>
                  <td><?php echo $deck_elevation_name[$value['deck_elevation']]['name']; ?></td>
                  <td><?php echo $value["postpone_reoffer_no"]; ?></td>
                  <td><?php echo $user_list[$value['inspection_by']]; ?></td>
                  <td><?php echo $value['inspection_datetime']; ?></td>  
                  <td><?php echo $status_inspection; ?><?= $val_resubmit ?></td> 
                  <td><?php echo $status_inv."<br/><span style='font-size:12px;'><b><i>".$list_arr_inspection_authx."</i></b>"; ?></td> 
                  <td>
                  <div class="btn-group">
                                      
                    <a href='<?php echo  base_url(); ?>fitup/pdf_files_client/<?php echo strtr($this->encryption->encrypt($value['project_code']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['discipline']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['module']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['type_of_module']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['report_number']),'+=/', '.-~'); ?>' class="btn btn-success text-nowrap" target='_blank'><i class="fas fa-file-pdf"></i> RFI</a>

                    <a href='<?php echo  base_url(); ?>fitup/pdf_files/<?php echo strtr($this->encryption->encrypt($value['project_code']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['discipline']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['module']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['type_of_module']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['report_number']),'+=/', '.-~'); ?>' class="btn btn-danger text-nowrap" target='_blank'><i class="fas fa-file-pdf"></i> Report</a>

                    <a href='<?php echo  base_url(); ?>fitup/client_inspection/<?php echo strtr($this->encryption->encrypt($value['project_code']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['discipline']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['module']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['type_of_module']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['report_number']),'+=/', '.-~'); ?>' class="btn btn-primary text-nowrap" target='_blank'><i class="fas fa-list"></i> Detail</a>

                  </div>
                  </td>
                </tr>
              <?php } ?>             
              </tbody>           
            </table>
          </div>
        </div>
      </div>
      </div>
    <?php //} ?>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">

   $('.dataTable').DataTable({
    order: [],
    columnDefs: [{
      "targets": 0,
      "orderable": false,
    }]
  })

  $("select[name=module]").chained("select[name=project]");

  $(".autocomplete_doc, .autocomplete_wm").autocomplete({
    source: function( request, response ) {

      var project         = $("select[name='project']").find('option:selected').val();  
      var drawing_type    = $("select[name='drawing_type']").find('option:selected').val(); 
      var discipline      = $("select[name='discipline']").find('option:selected').val(); 
      var module          = $("select[name='module']").find('option:selected').val(); 
      var type_of_module  = $("select[name='type_of_module']").find('option:selected').val(); 
      var drawing_wm      = $("input[name='drawing_wm']").val(); 
      var type_of_module  = $("select[name='type_of_module']").find('option:selected').val();  

      $.ajax( {
        url: "<?php echo base_url() ?>fitup/autocomplete_drawing_joint",
        type: "post",
        dataType: "json",
        data: {
          term: request.term,
          project: project,
          drawing_type: drawing_type,
          discipline: discipline,
          module: module,
          type_of_module: type_of_module,
          drawing_wm: drawing_wm,
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
 
     $.ajax( {
      url: "<?php echo base_url() ?>fitup/get_data_drawing",
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
          $("select[name=type_of_module]").val(data.type_of_module);
          $("select[name=status_inspection]").val(5);
        }
      }
    });
  }
</script>
