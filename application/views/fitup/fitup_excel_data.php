
<?php
   $currendate= date("Y-m-d H:i:s");
   header("Content-type: application/vnd-ms-excel");
   header("Content-Disposition: attachment; filename=export_fitup_$currendate.xls");
?>

<table width="100%" border="1px">             
                <tr>
                  <th><b>No</b></th>
                  <th><b>Project</b></th>
                  <th><b>Company</b></th>
                  <th><b>Drawing Number</b></th>
                  <th><b>Discipline</b></th>
                  <th><b>Module</b></th>
                  <th><b>Type Of Module</b></th>
                  <th><b>Weld Map Drawing Number</b></th>
                  <th><b>Joint No</b></th>
                  <th><b>Type of Weld</b></th>
                  <th><b>Class</b></th>
                  <th><b>Weld Length(mm)</b></th>
                  <th><b>Thk(mm)</b></th>
                  <th><b>Dia(inch)</b></th>
                  <th><b>Sch</b></th>

                  <th><b>Part ID#1</b></th>
                  <th><b>Material Grade#1</b></th>
                  <th><b>Unique ID Number#1</b></th>
                  <th><b>Heat Number#1</b></th>

                  <th><b>Part ID#2</b></th>  
                  <th><b>Material Grade#2</b></th>                
                  <th><b>Unique ID Number#2</b></th>                  
                  <th><b>Heat Number#2</b></th>                  
                                     
                  <th><b>Fitter Code</b></th>
                  <th><b>Tack Weld ID</b></th>

                  <th><b>WPS</b></th>
                  <th><b>Area</b></th>
                  <th><b>Remarks</b></th>  
                  <th><b>Submit By</b></th>
                  <th><b>Submit Date/Time</b></th>
                  <th><b>Submission ID</b></th>
                  <th><b>Inspection By</b></th>
                  <th><b>Inspection Date/Time</b></th>

                  <th><b>Approval Document By</b></th>
                  <th><b>Approval Document Date/Time</b></th>

                  <th><b>Rejected Remarks</b></th>
                  <th><b>Pending By QC Remarks</b></th>
                  <th><b>Status Fitup by QC SMOE</b></th>
                  <th><b>Transmitted By</b></th>
                  <th><b>Transmitted Date/Time</b></th>
                  <th><b>Report No.</b></th>
                  <th><b>Client Inspection By</b></th>
                  <th><b>Client Inspection Date/Time</b></th>
                  <th><b>Status Fitup by Client</b></th>
                  <th><b>LEGEND : INSPECTION AUTHORITY AS PER ITP</b></th>
                </tr>
             
                <?php $no=1; foreach ($joint_list as $key => $value): ?>
                                               
                <tr>                 
                  <td><?php echo $no ?></td>
                  <td><?php echo $project_name[$value['project']] ?></td>
                  <td><?php echo $company_name[$value['company_id']] ?></td>
                  <td><?php echo $value['drawing_no_tmp'] ?></td>
                  <td><?php echo $discipline_name[$value['discipline_tmp']] ?></td>
                  <td><?php echo $module_code[$value['module_tmp']] ?></td>
                  <td><?php echo $type_of_module_name[$value['type_of_module_tmp']] ?></td>
                  
                  <td><?php echo $value['drawing_wm'] ?> Rev.<?php echo $value['rev_wm'] ?></td>
                  <td><?php echo $value['joint_no'] ?></td>
                  <td><?php echo @$weld_type_name[$value['weld_type']] ?></td>
                  <td><?php echo @$class_list[$value['class']] ?></td>
                  <td><?php echo $value['weld_length'] ?></td>
                  <td><?php echo $value['thickness'] ?></td>
                  <td><?php echo $value['diameter'] ?></td>
                  <td><?php echo $value['sch'] ?></td>

                  <td><?php echo htmlentities($value['pos_1']); ?></td>
                  <td>                    
                    <?php 
                      if(isset($status_piecemark[$value['pos_1']]['id_mis'])){ 
                        echo $material_grade[$status_piecemark[$value['pos_1']]['grade']]['material_grade'];
                      } else {
                        echo "&nbsp;";
                      }
                    ?>                    
                  </td>
                  <td>
                    <?php 
                      if(isset($status_piecemark[$value['pos_1']]['id_mis'])){ 

                           echo $warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no'];

                      } else {  
                           echo "&nbsp;";
                      } 
                    ?>
                    </td>
                  <td>
                    <?php 
                      if(isset($status_piecemark[$value['pos_1']]['id_mis'])){ 
                        echo $warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['heat_or_series_no'];
                      } else {
                        echo "&nbsp;";
                      }
                    ?>
                  </td>                   

                  <td><?php echo htmlentities($value['pos_2']); ?></td>
                  <td>                    
                     <?php 
                      if(isset($status_piecemark[$value['pos_2']]['id_mis'])){ 
                        echo $material_grade[$status_piecemark[$value['pos_2']]['grade']]['material_grade'];
                      } else {
                        echo "&nbsp;";
                      }
                    ?>                    
                  </td>
                  <td>
                    <?php 
                      if(isset($status_piecemark[$value['pos_2']]['id_mis'])){ 

                         echo $warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no'];

                      } else {  
                          echo "&nbsp;";
                      } 
                    ?>                   
                  </td>
                  <td>
                    <?php 
                      if(isset($status_piecemark[$value['pos_2']]['id_mis'])){ 
                        echo $warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['heat_or_series_no'];
                      } else {
                        echo "&nbsp;";
                      }
                    ?>
                  </td>    
                  
                  <td>
                      <?php 
                          $fitter_id_display = explode(";", $value['fitter_id']);
                          foreach ($fitter_id_display as $key => $val_fitter) {
                            if(isset($fitter_code_arr[$val_fitter])){
                              echo $fitter_code_arr[$val_fitter]."<br style='mso-data-placement:same-cell;'/>";
                           }    
                         }
                      ?>
                  </td>

                  <td>
                    <?php 
                          $tack_weld_id_display = explode(";", $value['tack_weld_id']);
                          foreach ($tack_weld_id_display as $key => $val_tack_weld_id) {
                            if(isset($welder_code_arr[$val_tack_weld_id])){
                                echo $welder_code_arr[$val_tack_weld_id]."<br style='mso-data-placement:same-cell;'/>";
                            }
                          }                        
                    ?>  
                  </td>

                  <td>
                    <?php 
                          $wps_display = explode(";", $value['wps_no']);
                          foreach ($wps_display as $key => $wps_id) {
                            if(isset($wps_code_arr[$wps_id])){
                              echo $wps_code_arr[$wps_id]."<br style='mso-data-placement:same-cell;'/>";
                            }                             
                          }                        
                    ?>                    
                  </td>
                  
                  <td>
                    <?php if(isset($value['area_v2']) && isset($value['location_v2'])){ ?>
                      <?php echo @$area_name_list_v2[$value['area_v2']].",".@$location_name_list_v2[$value['location_v2']] ?>                     
                    <?php } else { ?>
                      <?php if(isset($area_name_arr[$value['area']])){ echo $area_name_arr[$value["area"]]; } ?>
                    <?php } ?>
                  </td> 
                  <td><?php echo $value["remarks"]; ?></td> 
                  

                  <td><?php if(isset($user_list[$value['requestor']])){ echo $user_list[$value['requestor']]; } ?></td>
                  <td><?php if(isset($value['date_request'])){ echo  date("d-F-y H:i:s",strtotime($value['date_request'])); } ?></td>
                  <td><?php echo $value['submission_id'] ?></td>

                  <td><?php if(isset($user_list[$value['inspection_by']])){ echo $user_list[$value['inspection_by']]; } ?></td>
                  <td><?php if(isset($value['inspection_datetime'])){ echo  date("d-F-y H:i:s",strtotime($value['inspection_datetime'])); } ?></td>

                  <td><?php if(isset($user_list[$value['document_approval_by']])){ echo $user_list[$value['document_approval_by']]; } ?></td>
                  <td><?php if(isset($value['document_approval_date'])){ echo  date("d-F-y H:i:s",strtotime($value['document_approval_date'])); } ?></td>

                  <td><?php echo $value['rejected_remarks']; ?></td>
                  <td><?php echo $value['pending_qc_remarks']; ?></td>
                  <td  style="text-align: left !important;">
                    <?php 
                      if(isset($value['status_inspection'])){

                        if(isset($value['status_inspection']) AND $value['status_inspection'] == '0'){ 

                          if(isset($status_piecemark[$value['pos_1']]['id_mis']) && isset($status_piecemark[$value['pos_2']]['id_mis'])){ 
                            echo "Pending Submission";
                          } else {
                            echo "Material Not Ready"; 
                          }
                         
                        } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '1'){ 
                          echo "Pending Approval";
                        } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '2'){ 
                          echo "Rejected";
                        } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '3'){ 
                          echo "Approved"; 
                        } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '4'){ 
                          echo "Pending By QC";
                        }  else {
                          echo "Approved";
                        }

                      }
                    ?>
                  </td>

                  <td><?php if(isset($user_list[$value['transmitted_by']])){ echo $user_list[$value['transmitted_by']]; } ?></td>
                  <td><?php if(isset($value['transmitted_date'])){ echo  date("d-F-y H:i:s",strtotime($value['transmitted_date'])); } ?></td>
                  <td>
                    <?php if(isset($value['report_number'])){ ?>
                      <?php 
                        echo $master_report_number[$value['project']][$value['discipline_tmp']][$value['type_of_module_tmp']]['fitup_report'].$value['report_number'].(isset($value['postpone_reoffer_no']) ? " Rev :".$value['postpone_reoffer_no'] : "");
                      ?>
                    <?php } else { ?>
                      -
                    <?php } ?>
                  </td>

                  <td><?php if(isset($user_list[$value['client_inspection_by']])){ echo $user_list[$value['client_inspection_by']]; } ?></td>
                  <td><?php if(isset($value['client_inspection_date'])){ echo  date("d-F-y H:i:s",strtotime($value['client_inspection_date'])); } ?></td>

                   <td  style="text-align: left !important;">
                    <?php 

                      if(isset($value['status_inspection']) AND $value['status_inspection'] >= 5){

                        if(isset($value['status_inspection']) AND $value['status_inspection'] == '5'){ 
                          echo "Client Pending Approval"; 
                        } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '6'){ 
                          echo "Client Rejection"; 
                        } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '7'){ 
                          echo "Client Approved";  
                        } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '9'){ 
                          echo "Client Approved & Released With Comment";
                        } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '10'){ 
                          echo "Client Postponed";   
                        } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '11'){ 
                          echo "Client Re-Offer";                   
                        }

                      } ELSE {
                        echo "-";
                      }

                    ?>
                  </td>
                  <td>
                  <?php 
                    $legend_inspection_auth_data		= explode(";",$value['legend_inspection_auth']);    
                    
                    $arr_inspection_auth      = array();
	    
                    if($legend_inspection_auth_data[0] == 1) {
                      $arr_inspection_auth[0] = "Hold Point";
                    }
                    if($legend_inspection_auth_data[1] == 1) {
                      $arr_inspection_auth[1] = "Witness";
                    }
                    if($legend_inspection_auth_data[2] == 1) {
                      $arr_inspection_auth[2] = "Monitoring";
                    }
                    if($legend_inspection_auth_data[3] == 1) {
                      $arr_inspection_auth[3] = "Review";
                    }
              
                    $list_arr_inspection_authx = implode("/", $arr_inspection_auth);
                  ?>
                    <?php if(isset($value['legend_inspection_auth'])){ echo $list_arr_inspection_authx; } ?>
                  </td>

                </tr>
                <?php $no++; endforeach; ?>
            </table>        
     