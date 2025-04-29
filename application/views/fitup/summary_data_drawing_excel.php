<?php
   $currendate= date("Y-m-d H:i:s");
   header("Content-type: application/vnd-ms-excel");
   header("Content-Disposition: attachment; filename=export_fitup_Report_number_$currendate.xls");
?>

            <table border='1px' width='100%'>
               
                <tr>  
                  <th>Report Number</th>                            
                  <th>Project</th>                 
                  <th>Drawing Number</th>
                  <th>Link - Drawing Number</th>
                  <th>Drawing WM</th>
                  <th>Link - Drawing WM</th>
                  <th>Discipline</th>
                  <th>Module</th>
                  <th>Module Type</th>
                  <th>Rev No</th>
                  <th>Inspection By</th>
                  <th>Inspection Date</th>                  
                  <th>Status Inspection</th>
                  <th>Re-Offer Remarks</th>
                  <th>Status Invitation</th> 
                </tr>
             
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
                      $val_resubmit = "(<span class='badge badge-pill badge-secondary'>Re-Submit</span>)";
                    } else {
                      $val_resubmit = null;
                    }

                  ?>
                 <tr> 
                  <td><?php echo @$master_report_number[$value['project_code']][$value['discipline']][$value['type_of_module']]['fitup_report'].$value['report_number']; ?></td>                             
                  <td><?= @$project_name[$value['project_code']] ?></td>                  
                  <td>
                      <?php echo $value['drawing_no']; ?>                      
                  </td>
                  <td>
                      <?php if(isset($activity_eng[$value['drawing_no']]['id'])){ ?> 
                        <?php  
                            $links_atc = public_smoe/open_atc()."production/open_atc/2/".strtr($this->encryption->encrypt($activity_eng[$value['drawing_no']]['id']), '+=/', '.-~');   
                        ?>  
                      <a target='_blank' href='<?= $links_atc ?>'  title='Attachment'> <i class='fas fa-paperclip'></i> Open Drawing </a> 
                      <?php } else { ?> 
                         <b>Waiting Drawing Released</b>
                      <?php } ?> 
                  </td>

                  <td>
                      <?php echo $value['drawing_wm']; ?>                     
                  </td>

                  <td> 
                      <?php if(isset($activity_eng[$value['drawing_wm']]['id'])){ ?> 
                        <?php  
                            $links_atc = public_smoe/open_atc()."production/open_atc/2/".strtr($this->encryption->encrypt($activity_eng[$value['drawing_wm']]['id']), '+=/', '.-~');   
                        ?>  
                      <a target='_blank' href='<?= $links_atc ?>'  title='Attachment'> <i class='fas fa-paperclip'></i> Open Drawing </a> 
                      <?php } else { ?> 
                        <b>Waiting Drawing Released</b>
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
                  <td><?php echo $status_inv." ( <span style='font-size:12px;'><b><i>".$list_arr_inspection_authx."</i></b></span> )"; ?></td> 
                   
                </tr>
              <?php }  }?>             
                       
            </table> 