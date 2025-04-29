<?php
   $currendate= date("Y-m-d H:i:s");
   header("Content-type: application/vnd-ms-excel");
   header("Content-Disposition: attachment; filename=export_fitup_Submission_id_$currendate.xls");
?>

<table border='1px' width='100%'>
              
                <tr>  
                  <th>Submisison No.</th>
                  <th>Project</th>
                  <th>Workpack No.</th>  
                  <th>Drawing Number</th>
                  <th>Link - Drawing Number</th>
                  <th>Drawing WM</th>
                  <th>Link - Drawing WM</th>
                  <th>Discipline</th>
                  <th>Module</th>
                  <th>Type of Module</th>
                  <th>Company</th>
                  <th>Requestor</th>
                  <th>Request Date</th>
                  <th>Resubmit Status</th>
                  <th>Inspection Status</th> 
                </tr> 
                <?php 
                  foreach ($inspection_list as $key => $value) { 

                    if(!isset($activity_eng[$value['drawing_no']]['id']) OR  !isset($activity_eng[$value['drawing_wm']]['id'])){

                    $where_status['submission_id'] = $value['submission_id'];
                    $where_status['status_retransmitted'] = 0;
                    if(isset($revise)){
                      $where_status['revision_status_inspection'] = 1;
                    } else {
                      $where_status['revision_status_inspection'] = 0;
                    }
                    $data_material = $this->fitup_mod->fitup_list($where_status);
                    unset($where_status);

                    $total_data       = sizeof($data_material);
                    $total_data_all   = array_column($data_material,"status_inspection");
                    $counts           = array_count_values($total_data_all);
                    $total_pass_arr     = $counts[3];
                    $total_reject_arr   = $counts[2];
                    $total_pending_arr  = $counts[1];

                    if(isset($total_pending_arr)){
                      $status_inspection = "<span class='badge badge-warning'>Pending Approval</span>";
                      $resubmit_show = 1;
                      $status_reject = 0;
                    } else if(isset($total_reject_arr)){
                      $status_inspection = "<span class='badge badge-danger'>Rejected</span>";
                      $resubmit_show = 0;
                      $status_reject = 1;
                    } else {
                      $status_inspection = "<span class='badge badge-success'>Approved</span>";
                      $resubmit_show = 0;
                      $status_reject = 0;
                    }
                 
                      if($value['status_resubmit'] == 2 && $resubmit_show == 1){
                        $status_submission = "<span class='btn btn-warning'><i><b>Re-submited</b></i></span>";
                      } else if($value['status_resubmit'] == 1){
                        $status_submission = "<span class='btn btn-info'><i><b>Has been Re-Submit</b></i></span>";
                      } else if($value['status_resubmit'] == 0 && $status_reject === 1){
                        $status_submission = "<span class='btn btn-danger'><i><b>Pending Re-submission</b></i></span>";
                      } else if($value['status_resubmit'] == 2 && $status_reject === 1){
                        $status_submission = "<span class='btn btn-danger'><i><b>Pending Re-submission</b></i></span>";    
                      } else {
                        $status_submission = "-";
                      }
                   
                    if($value['status_resubmit'] != 1){    

                ?>
                <tr>
                  <td><?php echo $value['submission_id']; ?></td>
                  <td><?php echo $project_name[$value['project_code']]; ?></td> 
                  <td><?php echo $value['workpack_no']; ?></td>  
                  <td>
                      <?php echo $value['drawing_no']; ?>                      
                  </td>
                  <td> 
                      <?php if(isset($activity_eng[$value['drawing_no']]['id'])){ ?> 
                        <?php  
                            $links_atc = base_url_ftp_eng()."public_smoe/open_atc/2/".strtr($this->encryption->encrypt($activity_eng[$value['drawing_no']]['id']), '+=/', '.-~');   
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
                            $links_atc = base_url_ftp_eng()."public_smoe/open_atc/2/".strtr($this->encryption->encrypt($activity_eng[$value['drawing_wm']]['id']), '+=/', '.-~');   
                        ?>  
                       <a target='_blank' href='<?= $links_atc ?>'  title='Attachment'> <i class='fas fa-paperclip'></i> Open Drawing </a>                       
                      <?php } else { ?> 
                         <b>Waiting Drawing Released</b>
                      <?php } ?> 
                  </td>
                  <td><?php echo $discipline_name[$value['discipline']]; ?></td>
                  <td><?php echo $module_code[$value['module']]; ?></td>
                  <td><?php echo $type_of_module_name[$value['type_of_module']]; ?></td>
                  <td><?php echo @$company_name[$value['wp_company']]; ?></td>
                  <td><?php echo $user_list[$value['requestor']]; ?></td>
                  <td><?php echo $value['date_request']; ?></td>
                  <td><?= $status_submission ?></td>                 
                  <td><?= $status_inspection ?></td>              
                   
                </tr>
                <?php 
                    } 
                 } 
                }
                ?>
             
            </table>
           
