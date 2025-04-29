<?php 
    $current_date = date("Y-m-d H:i:s");
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=WPS_$current_date.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    error_reporting(0);
?>
          <table border='1px'>          
            <tr>
              <th><b>No</b></th>
              <th><b>WPS no</b></th>
              <th><b>WPS Company</b></th>
              <th><b>WPS Project</b></th>
              <th><b>WPS Revision</b></th>
              <th><b>Discipline</b></th>              
              <th><b>Process</b></th>
              <th><b>Material Grade</b></th>
              <th><b>Thickness Range (mm)</b></th>              
              <th><b>Diameter Range (mm)</b></th>              
              <th><b>Type Of Joint</b></th>        
              <th><b>Remarks</b></th>
              <!-- <th><b>Attachment</b></th> -->
              <th><b>Status</b></th>
            </tr>
            <?php $no=1; foreach ($wps_list as $key => $value): ?>
              <tr>
                <td valign="top"><?php echo $no ?></td>
                <td valign="top"><?php echo $value["wps_no"] ?></td>
                <td valign="top"><?php echo $company_list[$value["company_id"]]['company_name'] ?></td>
                
                <td valign="top"><?php echo $master_project[$value["project_id"]]['project_name'] ?></td>

                <td valign="top"><?php echo $value["wps_revision"] ?></td>
                <td valign="top"><?php echo @$discipline_list[$value["discipline"]]["discipline_name"] ?></td>

                <td valign="top">
                  <?php foreach($wps_detail_list[$value["id_wps"]] as $process){ 
                    echo $master_welder_process[$process['id_weld_process']]."<br style='mso-data-placement:same-cell;' />"; 
                  } ?></td>
                <!-- <td valign="top"><?php foreach($wps_detail_list[$value["id_wps"]] as $process){ echo $process['process']."<br style='mso-data-placement:same-cell;' />"; } ?></td> -->
                <td valign="top"><?php foreach($wps_detail_list[$value["id_wps"]] as $material_grade){ echo @$material_grade_list[$material_grade["material_grade"]]["material_grade"]."<br style='mso-data-placement:same-cell;'/>"; } ?></td>
                <td valign="top"><?php foreach($wps_detail_list[$value["id_wps"]] as $thickness){ echo $thickness['thickness']."<br style='mso-data-placement:same-cell;'/>"; } ?></td>
                <td valign="top"><?php foreach($wps_detail_list[$value["id_wps"]] as $diameter){ echo $diameter['diameter']."<br style='mso-data-placement:same-cell;'/>"; } ?></td>
                <td valign="top"><?php foreach($wps_detail_list[$value["id_wps"]] as $type_of_joint){ echo @$joint_type_list[$type_of_joint['type_of_joint']]["joint_type_code"]."<br style='mso-data-placement:same-cell;'/>"; } ?></td>             
                <td valign="top"><?php echo $value["remarks"] ?></td>    
                <!-- <td valign="top">
                  <?php if(isset($value["attachment"])){ ?>
                    <a href='https://www.smoebatam.com/pcms_v2_photo/wps_file/<?php echo $value["attachment"]; ?>' class="btn btn-success btn-sm">Attachement</i></a>
                  <?php } else { ?>
                    -
                  <?php } ?>
                </td>              -->
                <td valign="top">
                  <?php if($value["status_wps"] == 1): ?>
                    Actived
                  <?php else: ?>
                    Non-Actived
                  <?php endif; ?>
                </td>
              </tr>

            <?php $no++;  endforeach; ?>
        </table>
        <br/>
        <b>PCMS WPS Register - Download Date : <?php echo date("d-F-Y H:i:s"); ?></b>