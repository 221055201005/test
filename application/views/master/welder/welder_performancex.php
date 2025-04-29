          <table border='1px'>          
            <tr>
              <th><b>No</b></th>
              <th><b>Welder Code</b></th>
              <!-- <th><b>Client Code</b></th> -->
              <th><b>Company</b></th>
              <th><b>Project</b></th>
              <th><b>Welder Badge</b></th>
              <th><b>Welder Name</b></th>
              <th><b>Class Material</b></th>              
              <th><b>Discipline</b></th>              
              <th><b>Process</b></th>
              <th><b>F Number</b></th>               
              <th><b>Position</b></th>
              <th><b>Position Range</b></th>   
              <th><b>Diameter Range</b></th>   
              <th><b>Thickness Range</b></th>   
              <th><b>Backing</b></th> <!-- 
              <?php if($this->permission_cookie[110] == '1'){ ?>
              <th><b>Certificate<b></th>    
              <?php } ?>   -->         
              <th><b>Validity Start Date</b></th>        
              <th><b>Validity End Date</b></th>    
              <th><b>Status</b></th>
            </tr>
            <?php $no=1; foreach ($welder_list as $key => $value): ?>
              <tr>
                <td valign="top"><?php echo $no ?></td>
                <td valign="top"><?php echo $value["welder_code"] ?></td>
                <!-- <td valign="top"><?php echo $value["rwe_code"] ?></td> -->
                <td valign="top"><?php echo @$company_list[$value["company_id"]]['company_name']; ?></td>
                <td valign="top"><?php echo @$project[$value["project_id"]]['project_name'] ?></td>
                <td valign="top"><?php echo $value["welder_badge"] ?></td>
                <td valign="top"><?php echo $value["welder_name"] ?></td>
                <td valign="top"><?php echo $value["cwm"] ?></td>
                <td valign="top"><?php echo @$discipline_list[$value["discipline"]]["discipline_name"] ?></td>                
                <td valign="top"><?php foreach($welder_detail_list[$value["id_welder"]] as $welder_process){ echo $welder_process_list[$welder_process['welder_process']]['name_process']."<br style='mso-data-placement:same-cell;' />"; } ?></td>
                <td valign="top"><?php foreach($welder_detail_list[$value["id_welder"]] as $f_no){ echo $f_no['f_no']."<br style='mso-data-placement:same-cell;' />"; } ?></td>
                <td valign="top"><?php foreach($welder_detail_list[$value["id_welder"]] as $welder_position){ echo $welder_position['welder_position']."<br style='mso-data-placement:same-cell;' />"; } ?></td>
                <td valign="top"><?php foreach($welder_detail_list[$value["id_welder"]] as $position_range){ echo $position_range['position_range']."<br style='mso-data-placement:same-cell;' />"; } ?></td>
                <td valign="top"><?php foreach($welder_detail_list[$value["id_welder"]] as $diameter_range){ if(isset($diameter_range['diameter_range']) AND !empty($diameter_range['diameter_range'])){ echo $diameter_range['diameter_range']."<br style='mso-data-placement:same-cell;' />"; } else { echo "- <br style='mso-data-placement:same-cell;' />"; } } ?></td>
                <td valign="top"><?php foreach($welder_detail_list[$value["id_welder"]] as $thickness_range){ echo $thickness_range['thickness_range']."<br style='mso-data-placement:same-cell;' />"; } ?></td>
                <td valign="top"><?php foreach($welder_detail_list[$value["id_welder"]] as $backing){ echo $backing['backing']."<br style='mso-data-placement:same-cell;' />"; } ?></td>
                <!-- <?php if($this->permission_cookie[110] == '1'){ ?>
                <td valign="top">
                    <?php foreach($welder_detail_list[$value["id_welder"]] as $welder_certificate){ if(isset($welder_certificate["attachment"])){ ?>  <a href='https://www.smoebatam.com/pcms_v2_photo/welder_file/<?php echo $welder_certificate["attachment"]; ?>'>file</a> &nbsp;&nbsp; <?php } else { echo "- <br style='mso-data-placement:same-cell;' />"; } } ?></td>
                    <?php } ?> -->
                <td valign="top"><?php echo $value["vsd"] ?></td>
                <td valign="top"><?php echo $value["ved"] ?></td> 
                <td valign="top">
                  <?php if($value["status_actived"] == 1): ?>
                    Actived
                  <?php else: ?>
                    Non-Actived
                  <?php endif; ?>
                </td>
              </tr>

            <?php $no++;  endforeach; ?>
        </table>
        <br/>
        <b>PCMS Welder Register - Download Date : <?php echo date("d-F-Y H:i:s"); ?></b>