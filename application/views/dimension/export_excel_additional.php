<?php
  error_reporting(0);
  header("Content-type: application/vnd-ms-excel");
  $filename = $meta_title."_".date("YmdHis");
  header("Content-Disposition: attachment; filename=$filename.xls");
?>
<table border="1" style="width:100%; border-collapse: collapse;">
            <thead>
              <tr  > 
                <th>RFI Number</th>                
                <th>Report Number</th>                
                <th>Drawing Number</th> 
                <th>Discipline</th>
                <th>Module</th> 
                <th>Type Of Module</th>
                <th>Deck Elevation / Service Line</th> 
                <th>Submit By</th>  
                <th>Submit Date</th>   
              </tr>
            </thead>
            <tbody>
              <?php foreach($data_additional_report as $dc_list){ ?>
              <tr>                 
                <td><?= $dc_list['rfi_number'] ?></td>
                <td><?= $dc_list['report_number'] ?></td>
                <td><?= $dc_list['drawing_no'] ?></td> 
                <td><?php echo (isset($discipline_name[$dc_list['discipline']]) ? $discipline_name[$dc_list['discipline']] : '-') ?></td>
                <td><?php echo (isset($module_code[$dc_list['module']]) ? $module_code[$dc_list['module']] : '-') ?></td>
                <td><?php echo (isset($type_of_module_name[$dc_list['type_of_module']]) ? $type_of_module_name[$dc_list['type_of_module']] : '-') ?></td>                
                <td><?php echo (isset($deck_elevation_show[$dc_list['deck_elevation']]) ? $deck_elevation_show[$dc_list['deck_elevation']] : '-') ?></td>  
                <td><?php echo (isset($user_list[$dc_list['create_by']]) ? $user_list[$dc_list['create_by']] : '-') ?></td>
                <td><?= date('Y-m-d', strtotime($dc_list['created_date'])) ?></td>  
              </tr>
              <?php } ?>
            </tbody>
          </table>