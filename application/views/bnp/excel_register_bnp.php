<?php 

  error_reporting(0);
  // header("Content-type: application/vnd-ms-excel");
  // header("Content-Disposition: attachment; filename=BNP Register.xls");

?>

<style>
  .format { mso-number-format:\@; }
</style>

<table border="1" style="width:100%; border-collapse: collapse; text-align: center;">
  <tr>
    <td style="vertical-align: middle !important;" rowspan="2"><center><strong>TRACE CODE</strong></center></td>
    <!-- <td style="vertical-align: middle !important;" rowspan="2"><center><strong></strong></center></td> -->
    <td style="vertical-align: middle !important;" rowspan="2"><center><strong>REPORT NO</strong></center></td>
    <td style="vertical-align: middle !important;" rowspan="2"><center><strong>DESCRIPTION ACTIVITY</strong></center></td>
    <td style="vertical-align: middle !important;" rowspan="2"><center><strong>INSPECTION RELEASE</strong></center></td>
    <td style="vertical-align: middle !important;" rowspan="2"><center><strong>ITEM DESCRIPTION</strong></center></td>
    <td style="vertical-align: middle !important;" rowspan="2"><center><strong>LOCATION</strong></center></td>
    <td style="vertical-align: middle !important;" rowspan="2"><center><strong>PAINT SYSTEM</strong></center></td>
    <td style="vertical-align: middle !important;" rowspan="2"><center><strong>QTY</strong></center></td>
    <td style="vertical-align: middle !important;" colspan="5"><center><strong>TOTAL ACTUAL PIECEMARK PAINTED</strong></center></td>
    <td style="vertical-align: middle !important;" rowspan="2"><center><strong>RFI STATUS</strong></center></td>
    <td style="vertical-align: middle !important;" rowspan="2"><center><strong>REPORT STATUS</strong></center></td>
    <td style="vertical-align: middle !important;" rowspan="2"><center><strong>QC IN CHARGE</strong></center></td>
    <td style="vertical-align: middle !important;" rowspan="2"><center><strong>RWE APPROVAL</strong></center></td>
  </tr>
  <tr>
    <td style="vertical-align: middle !important;"><center><strong>A</strong></center></td>
    <td style="vertical-align: middle !important;"><center><strong>B</strong></center></td>
    <td style="vertical-align: middle !important;"><center><strong>C</strong></center></td>
    <td style="vertical-align: middle !important;"><center><strong>D</strong></center></td>
    <td style="vertical-align: middle !important;"><center><strong>E</strong></center></td>
  </tr>
  <?php foreach ($list as $key => $value): ?>
  <?php 
    
    $split_list       = explode("_", $key);
    $project_id       = $split_list[0];
    $discipline       = $split_list[1];
    $module           = $split_list[2];
    $type_of_module   = $split_list[3];
    $report_no        = $split_list[4];

    $format_report    = "SOF-OCP-SMO-STR-COPP";

    $location_desc    = "";

    if(isset($area[$value['area']])) {
      $location_desc .= $area[$value['area']]['name'];

      if(isset($location[$value['location']])) {
        $location_desc .= ', '.$location[$value['location']]['name'];

        if(isset($point[$value['point']])) {
          $location_desc .= ', '.$point[$value['point']]['name'];
        }

      }
    }
    
  ?> 
   <tr>
     <td style="vertical-align: middle !important;" class="format"><center><?= $report_no ?></center></td>
     <!-- <td style="vertical-align: middle !important;"><center><?= $format_report ?></center></td> -->
     <td style="vertical-align: middle !important;"><center><?= $format_report ?>-<?= $report_no ?></center></td>
     <td style="vertical-align: middle !important;"><center><?= $activity[$value['id_activity']]['description_of_activity'] ?></center></td>
     <td style="vertical-align: middle !important;"><center><?= $value['transmittal_date'] ?></center></td>
     <td style="vertical-align: middle !important;"><center>
       <?= implode(',<br>', $item_desc[$value['transmittal_uniqid']]) ?>
     </center></td>
     <td style="vertical-align: middle !important;"><center><?= $location_desc ?></center></td>
     <td style="vertical-align: middle !important;"><center><?= $paint_system[$value['id_paint_system']]['name'] ?></center></td>
     <td style="vertical-align: middle !important;" class="format"><center><?= $value['qty'] ?></center></td>
     <td><center></center></td>
     <td><center></center></td>
     <td><center></center></td>
     <td><center></center></td>
     <td><center></center></td>
     <td style="vertical-align: middle !important;"><center><?= $value['status_inspection'] == 1 ? 'RELEASED' : 'ACCEPTED' ?></center></td>
     
     <td style="vertical-align: middle !important;"><center><?= $value['attachment_status'] == 1 ? 'Attachment Uploaded' : 'Pending Attachment' ?></center></td>
     <td style="vertical-align: middle !important;"><center><?= $user[$value['inspector_id']]['full_name'] ?></center></td>
     <td style="vertical-align: middle !important;"><center><?= $user[$bnp_detail[$value['transmittal_uniqid']]['client_inspection_by']]['full_name'] ?></center></td>

   </tr>
   <?php endforeach; ?>
</table>