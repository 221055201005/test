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
<div id="content" class="container-fluid">
   
      <div class="card border-0 shadow-sm">

        <div class="card-header">
          <h6 class="m-0">Client Document List</h6>
        </div>
        <div class="card-body">

        <div class="table-responsive">
          <div class="container-fluid">
          <a href='<?= base_url() ?>fitup/summary_report_no_drawing_no/excel' class='btn btn-success'><i class="fas fa-file-excel"></i> Export Excel</a>

            <table class="table table-hover text-center dataTable" width="100%">
              <thead class="bg-green-smoe text-white ">
                <tr>  
                  <th>Report Number</th>                            
                  <th>Project</th>                 
                  <th>Drawing Number</th>
                  <th>Drawing WM</th>
                  <th>Discipline</th>
                  <th>Module</th>
                  <th>Module Type</th>
                  <th>Rev No</th>
                  <th>Inspection By</th>
                  <th>Inspection Date</th>                  
                  <th>Status Inspection</th>
                  <th>Re-Offer Remarks</th>
                  <th>Status Invitation</th>
                  <th width="150px;">Action</th>
                </tr>
              </thead>   
              <tbody>
                
                <?php 

                  foreach ($client_list as $key => $value) { 

                    if(!isset($activity_eng[$value['drawing_no']]['id']) OR  !isset($activity_eng[$value['drawing_wm']]['id'])){
                    
                    $where_status['report_number'] = $value['report_number'];
                    $where_status['status_retransmitted'] = 0;
                    $data_material = $this->fitup_mod->fitup_list($where_status);
                    unset($where_status);

                    $total_data          = sizeof($data_material);
                    $total_data_all      = array_column($data_material,"status_inspection");
                    $counts              = array_count_values($total_data_all);
                    $total_pending_qc    = $counts[1];
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


                    if(isset($total_pending_qc)){
                      $status_inspection = '<span class="badge badge-pill badge-warning">Pending QC Approval</span>';
                    } else if(isset($total_pending_arr)){
                      $status_inspection = '<span class="badge badge-pill badge-warning">Pending Approval</span>';
                    } else if(isset($total_postponed_arr)){
                      $status_inspection = '<span class="badge badge-pill badge-info">Postponed By Client</span>';
                    } else if(isset($total_reoffer_arr)){
                      $status_inspection = '<span class="badge badge-pill badge-warning">Re-Offer By Client</span>';  
                    } else if(isset($total_reject_arr)){
                      $status_inspection = '<span class="badge badge-pill badge-danger">Rejected By Client</span>';
                    } else if(isset($total_awc)){
                      $status_inspection = '<span class="badge badge-pill badge-primary">Accepted & Release With Comments</span>'; 
                    } else {
                      if($legend_output[2] == 1 OR $legend_output[3] == 1) {
                        $status_inspection = '<span class="badge badge-pill badge-success">Reviewed</span>';
                      } else {
                        $status_inspection = '<span class="badge badge-pill badge-success">Accepted By Client</span>';
                      }
                    }

                    $list_arr_inspection_authx = implode(" / ", $arr_inspection_auth);

                    if($value['status_inspection'] == 5 && $value['postpone_reoffer_no'] > 0){
                      $val_resubmit = "<br/><span class='badge badge-pill badge-secondary'>Re-Submit</span>";
                    } else {
                      $val_resubmit = null;
                    }

                  ?>
                 <tr> 
                  <td><?php echo @$master_report_number[$value['project_code']][$value['discipline']][$value['type_of_module']]['fitup_report'].$value['report_number']; ?></td>                             
                  <td><?= @$project_name[$value['project_code']] ?></td>                  
                  <td>
                      <?php echo $value['drawing_no']; ?>
                      <?php if(isset($activity_eng[$value['drawing_no']]['id'])){ ?> 
                        <?php  
                            $links_atc = base_url_ftp_eng()."public_smoe/open_atc/2/".strtr($this->encryption->encrypt($activity_eng[$value['drawing_no']]['id']), '+=/', '.-~');   
                        ?>  
                      <br/><br/><a target='_blank' href='<?= $links_atc ?>'  title='Attachment'> <i class='fas fa-paperclip'></i> Open Drawing </a> 
                      <?php } else { ?> 
                         <br/><br/><b>Waiting Drawing Released</b>
                      <?php } ?> 
                  </td>
                  <td>
                      <?php echo $value['drawing_wm']; ?>
                      <?php if(isset($activity_eng[$value['drawing_wm']]['id'])){ ?> 
                        <?php  
                            $links_atc = base_url_ftp_eng()."public_smoe/open_atc/2/".strtr($this->encryption->encrypt($activity_eng[$value['drawing_wm']]['id']), '+=/', '.-~');   
                        ?>  
                      <br/><br/><a target='_blank' href='<?= $links_atc ?>'  title='Attachment'> <i class='fas fa-paperclip'></i> Open Drawing </a> 
                      <?php } else { ?> 
                         <br/><br/><b>Waiting Drawing Released</b>
                      <?php } ?> 
                  </td>
                  <td><?php echo $discipline_name[$value['discipline']]; ?></td>
                  <td><?php echo $module_code[$value['module']]; ?></td>
                  <td><?php echo $type_of_module_name[$value['type_of_module']]; ?></td>
                  <td><?php echo $value["postpone_reoffer_no"]; ?></td>
                  <td><?php if(isset($total_pending_qc)){ echo "-"; } else { ?><?php echo $user_list[$value['inspection_by']]; ?><?php } ?></td>
                  <td><?php if(isset($total_pending_qc)){ echo "-"; } else { ?><?php echo $value['inspection_datetime']; ?><?php } ?></td>  
                  <td><?php echo $status_inspection; ?><?= $val_resubmit ?></td> 
                  <td><?php echo $value['reoffer_remarks']; ?></td> 
                  <td><?php echo $status_inv."<br/><span style='font-size:12px;'><b><i>".$list_arr_inspection_authx."</i></b>"; ?></td> 
                  <td>
                  <div class="btn-group">                                      
                    <a href='<?php echo  base_url(); ?>fitup/pdf_files_client/<?php echo strtr($this->encryption->encrypt($value['project_code']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['discipline']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['module']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['type_of_module']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['report_number']),'+=/', '.-~'); ?>' class="btn btn-success text-nowrap" target='_blank'><i class="fas fa-file-pdf"></i> RFI</a>
                    <a href='<?php echo  base_url(); ?>fitup/pdf_files/<?php echo strtr($this->encryption->encrypt($value['project_code']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['discipline']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['module']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['type_of_module']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['report_number']),'+=/', '.-~'); ?>' class="btn btn-danger text-nowrap" target='_blank'><i class="fas fa-file-pdf"></i> Report</a>
                  </div>
                  </td>
                </tr>
              <?php }  }?>             
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

//    $('.dataTable').DataTable({
//     order: [1,"asc"],
//     columnDefs: [{
//       "targets": 0,
//       "orderable": false,
//     }]
//   })

$('.dataTable').DataTable({
        "paging":   false, 
        
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
