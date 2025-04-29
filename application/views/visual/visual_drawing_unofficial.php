<?php
  error_reporting(0);
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=".$th." - Drawing Not Ready.xls");
?>

<table border="1" style="width:100%; border-collapse: collapse;">
  <tr>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">No</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;"><?= $th ?></td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Drawing No</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Drawing WM</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Status Inspection</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Engineering Status</td>
  </tr>

  <?php 
    $no = 1;
    foreach ($foreach as $key => $value): 
  ?> 
  <tr>
    <td style="vertical-align: middle; text-align: center;"><?= $no++ ?></td>
    <td style="vertical-align: middle; text-align: center;"><?= $value[$column] ?></td>
    <td style="vertical-align: middle; text-align: center;"><?= $value['drawing_no'] ?></td>
    <td style="vertical-align: middle; text-align: center;"><?= $value['drawing_wm'] ?></td>
    <td style="vertical-align: middle; text-align: center;">
      <?php
        if($column=='submission_id'){
          if($value['status_inspection']==1){
            $status = 'Pending Approval QC';
          } elseif($value['status_inspection']==2){
            $status = 'Rejected by QC';
          } elseif($value['status_inspection']==4){
            $status = 'Pending by QC';
          } elseif($value['status_inspection']==8){
            $status = 'Request for Update';
          } elseif($value['status_inspection']>=3){
            $status = 'Approved by QC';
          } 
        } else {
          if($value['status_inspection']==5){
            $status = 'Pending Approval Client';
          } elseif($value['status_inspection']==6){
            $status = 'Reject Client';
          } elseif($value['status_inspection']==7){
            $status = 'Approved Client';
          } elseif($value['status_inspection']==9){
            $status = 'Approved & Release with Comment';
          } elseif($value['status_inspection']==10){
            $status = 'Postponed Client';
          } elseif($value['status_inspection']==11){
            $status = 'Re-Offered Client';
          } else {
            $status = 'Revise';
          }
        }

        echo $status;
      ?>
    </td>
    <td style="vertical-align: middle; text-align: center;"><?= $value['not_ready'] ?></td>
  </tr>
   <?php endforeach; ?>
</table>