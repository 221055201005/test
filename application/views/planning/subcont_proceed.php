
<?php
   $currendate= date("Y-m-d H:i:s");
   header("Content-type: application/vnd-ms-excel");
   header("Content-Disposition: attachment; filename=subcontractor_$currendate.xls");
?>

<table width="100%" border="1px">             
                <tr>
                  <th><b>No</b></th>
                  <th><b>Company</b></th>
                  <th><b>Project ID</b></th>
                  <th><b>Badge ID </b></th>
                  <th><b>Full Name</b></th>
                  <th><b>Position</b></th>
                </tr>
             
                <?php $no=1; foreach ($detail_list as $key => $value): ?>
                                               
                <tr>                 
                  <td><?php echo $no ?></td>
                  <td><?php echo $company_list[$value['company']]["company_name"] ?></td>      
                  <td><?php echo $project_list[$value['project_id']]["project_desc"] ?></td>
                  <td><?php echo $value['badge_id'] ?></td>
                  <td><?php echo $value['nama'] ?></td>
                  <td><?php echo $value['position'] ?></td>
                </tr>
                <?php $no++; endforeach; ?>
            </table>        
     