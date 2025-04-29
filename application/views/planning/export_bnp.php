<?php  
 
  header("Content-type: application/vnd-ms-excel"); 
  header("Content-Disposition: attachment; filename=PCMS-B&P-List-".date('YmdHis').".xls"); 
  header("Pragma: no-cache"); 
  header("Expires: 0");  
 
?>                     
                    <table width="100%" border="1px"> 
                      <thead> 
                        <tr>                           
                          <th>Project</th>  
                          <th>Module</th>  
                          <th>Type of Module</th>  
                          <th>Deck Elevation / Service Line	</th>  
                          <th>Discipline</th>  
                          <th>Phase</th>  
                          <th>Company</th>  
                          <th>Workpack No.	</th>  
                          <th>Paint System</th>  
                          <th>Activity</th>  
                          <th>Plan Start Date</th>  
                          <th>Plan Finish Date</th>  
                          <th>Issued Date</th>   
                          <th>Location</th>
                          <th>Drawing GA</th> 
                          <th>Drawing AS</th> 
                          <th>Drawing SP</th> 
                          <th>Piecemark</th>
                          <th>Unique No</th> 
                          <th>Profile</th>
                          <th>Length</th>
                          <th>Grade</th>
                          <th>Weight</th>
                          <th>Area</th>
                          <th>Status Workpack</th> 
                          <th>Remarks</th>
                      </thead> 
                      <tbody> 
                        <?php foreach ($bnp_data as $value): ?> 
                        <tr>  
                          <td><?= isset($project_list[$value['project']]) ? $project_list[$value['project']]["project_name"] : null ?></td>  
                          <td><?= isset($module_list[$value['module']]) ? $module_list[$value['module']]["mod_desc"] : null ?></td>  
                          <td><?= (isset($type_of_module_list[$value['type_of_module']]) ? $type_of_module_list[$value['type_of_module']]['name'] : null) ?></td>  
                          <td><?= (isset($deck_elevation_list[$value['deck_elevation']]) ? $deck_elevation_list[$value['deck_elevation']]['name'] : null) ?></td>  
                          <td><?= (isset($discipline_list[$value['discipline']]) ? $discipline_list[$value['discipline']]['discipline_name'] : null) ?></td>  
                          <td><?= $value['phase'] ?></td>  
                          <td><?= (isset($company_list[$value['company_id']]) ? $company_list[$value['company_id']]['company_name'] : null) ?></td>  
                          <td><?= $value['workpack_no'] ?></td>  
                          <td><?= (isset($paint_system[$value['id_paint_system']]) ? $paint_system[$value['id_paint_system']]['name'] : null ) ?></td>  
                          <td><?= (isset($paint_activity[$value['id_activity']]) ? $paint_activity[$value['id_activity']]['description_of_activity'] : null ) ?></td>  
                          <td><?= $value['plan_start_date'] ?></td>  
                          <td><?= $value['plan_finish_date'] ?></td>  
                          <td><?= $value['approval_date'] ?></td>   
                          <td><?= $area_v2_list[$value['area_v2']]['name'].", ".$location_v2_list[$value['location_v2']]['name'] ?></td>  
                          <td><?php if(isset($value['drawing_ga']) && !empty($value['drawing_ga'])){ ?><?= $value['drawing_ga'] ?> Rev. <?= $value['rev_ga'] ?><?php } else { echo "-"; } ?></td>  
                          <td><?php if(isset($value['drawing_as']) && !empty($value['drawing_as'])){ ?><?= $value['drawing_as'] ?> Rev. <?= $value['rev_as'] ?><?php } else { echo "-"; } ?></td>   
                          <td><?php if(isset($value['drawing_sp']) && !empty($value['drawing_sp'])){ ?><?= $value['drawing_sp'] ?> Rev. <?= $value['rev_sp'] ?><?php } else { echo "-"; } ?></td>   
                          <td><?= $value['part_id'] ?></td>   
                          <td><?= isset($warehouse_mis_mrir[$value['id_mis']]['unique_ident_no']) ? $warehouse_mis_mrir[$value['id_mis']]['unique_ident_no'] : null ?></td>   
                          <td><?= $value['profile'] ?></td>   
                          <td><?= $value['length'] ?></td>   
                          <td><?= (isset($material_grade_list[$value['grade']]) ? $material_grade_list[$value['grade']]['material_grade'] : null ) ?></td>   
                          <td><?= $value['weight'] ?></td>   
                          <td><?= $value['total_area'] ?></td>   
                          <td>
                            <?php if($value['status_approval'] == 0){ ?>
                              Draft
                            <?php } else if($value['status_approval'] == 1){ ?>
                              Submitted
                            <?php } else if($value['status_approval'] == 2){ ?>
                              Rejected
                            <?php } else if($value['status_approval'] == 3){ ?>
                              Approved  
                            <?php } else { ?>
                            <?php } ?>
                          </td>  
                          <td><?= $value['bnp_remark'] ?></td>   
                        </tr> 
                        <?php endforeach; ?> 
 
                    </tbody> 
              </table> 