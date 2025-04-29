
<?php
   header("Content-type: application/vnd-ms-excel");
   header("Content-Disposition: attachment; filename=NDT_Technichian_Register.xls");
?>
        <table width='100%' border='1px'> 
            <tr>
              <th rowspan='2'>No</th>
              <th rowspan='2'>Project Name</th>
              <th rowspan='2'>Personel Name</th>
              <th rowspan='2'>Designation</th>
              <th rowspan='2'>Qualification</th>
              <th rowspan='2'>Certificate Number</th>
              <th rowspan='2'>PCN Number</th>
              <th rowspan='2'>Certificate<br/> Date Of Issued</th>
              <th rowspan='2'>Certificate<br/> Date Of Expired</th>
              <th rowspan='2'>Certificate File</th>
              <th colspan='5'>Mockup Test Result</th>
              <th rowspan='2'>Status</th>
              <th rowspan='2'>SIP No.</th>
              <th rowspan='2'>Company</th>
              <th rowspan='2'>Issued Date</th>
              <th rowspan='2'>Expired Date</th>
              <th rowspan='2'>Remarks</th>
              <th rowspan='2'>Action</th>
            </tr>
            <tr>
              <th>PLATE</th>
              <th>PIPE</th>
              <th>TJOINT</th>
              <th>NOZZLE</th>
              <th>NODE</th>              
            </tr> 
            <?php $no=1; foreach ($personnel_list as $key => $value): ?>

              <?php 
                if(isset($value['mock_up_test_result'])){
                  $mockup = explode(";",$value['mock_up_test_result']);
                  for($x=0;$x<5;$x++){ 
                    if($mockup[$x] == 1){
                      $show_mockup[$x] = "Pass";
                    } else if($mockup[$x] == 2){
                      $show_mockup[$x] = "Fail"; 
                    } else if($mockup[$x] == 3){
                      $show_mockup[$x] = "N/A"; 
                    } else {
                      $show_mockup[$x] = null;
                    }
                  } 
                }  
              ?>

              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo @$project_name[$value["project_id"]] ?></td>
                <td><?php echo $value["personel_name"] ?></td> 
                <td><?php echo @$designation_name[$value["designation"]]?></td> 
                <td><?php echo @$qualification_name[$value["qualification"]] ?></td> 
                <td><?php echo $value["certificate_number"] ?></td> 
                <td><?php echo $value["pcn_number"] ?></td> 
                <td><?php echo $value["date_of_issue"] ?></td> 
                <td><?php echo $value["date_of_expired"] ?></td> 
                <td>
                  <?php if(isset($value["attachment"]) && !empty($value["attachment"])){ ?>
                  <a href="<?php echo base_url_ftp(); ?>upload/ndt_personnel/<?php echo $value["attachment"] ?>" class="btn btn-sm btn-flat btn-dark"><i class="fas fa-file-download"></i></a>
                  <?php } else { ?>
                    -
                  <?php } ?>
                </td> 
                <?php for($y=0;$y<5;$y++){ ?>
                <td><?php echo $show_mockup[$y] ?></td>
                <?php } ?> 
                <td><?php echo ($value["status"] == 0 ? "Active" : "Non-Active") ?></td> 
                <td><?php echo $value["sip_no"] ?></td> 
                <td><?php echo @$company_name[$value["company"]] ?></td> 
                <td><?php echo $value["issue_date"] ?></td> 
                <td><?php echo $value["expired_date"] ?></td> 
                <td><?php echo $value["remarks"] ?></td> 
                <td><a href="<?php echo base_url() ?>master/ndter/personnel_new/<?php echo strtr($this->encryption->encrypt($value["id"]), '+=/', '.-~') ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Update</a></td> 
              </tr>
            <?php $no++; endforeach; ?> 
        </table> 
        
        <br/> 
        <br/>
        Download on Date : <?php echo date("Y-m-d H:i:s") ?>