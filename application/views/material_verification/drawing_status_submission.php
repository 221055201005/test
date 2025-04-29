<?php
  error_reporting(0);

   header("Content-type: application/vnd-ms-excel");
   header("Content-Disposition: attachment; filename=Export Submission Drawing Status By Submission ID.xls");
?>
<table border="1" style="border-collapse: collapse; width:100%">
  <tr>
    <!-- <td><center><strong>Report Number</strong></center></td> -->
    <!-- <td><center><strong>Report Status</strong></center></td> -->
    <td><center><strong>Submission ID</strong></center></td>
    <td><center><strong>Drawing GA</strong></center></td>
    <td><center><strong>Drawing AS</strong></center></td>
    <td><center><strong>Drawing SP</strong></center></td>
    <td><center><strong>Drawing GA Status</strong></center> </td>
    <td><center><strong>Drawing AS Status</strong></center> </td>
    <td><center><strong>Drawing SP Status</strong></center> </td>
  </tr>
  <?php foreach ($list as $key => $value): ?>
  <tr>
    <!-- <td><center>'<?= $value['report_number'] ?></center></td> -->
    <!-- <td><center>
      <?php 

        if($value['status_inspection'] == 5) {
          $status_report = "Pending Approval Client";
        }
        if($value['status_inspection'] == 6) {
          $status_report = "Reject By Client";
        }
        if($value['status_inspection'] == 7) {
          $status_report = "Accepted By Client";
        }
        if($value['status_inspection'] == 9) {
          $status_report = "Accepted And Released With Comment";
        }
        if($value['status_inspection'] == 10) {
          $status_report = "Postponed By Client";
        }
        if($value['status_inspection'] == 11) {
          $status_report = "Re Offer Client";
        }
        if($value['status_inspection'] == 12) {
          $status_report = "Void";
        }
      
      ?>

      <?= $status_report ?>
    </center></td> -->
    <td><center><?= $value['submission_id'] ?></center></td>
    <td><center><?= $value['drawing_no'] ?></center></td>
    <td><center><?= $value['drawing_as'] ?></center></td>
    <td><center><?= $value['drawing_sp'] ?></center></td>
    <td>
      <center>
      <?php if ($value['drawing_no']): ?>
      <?php if (isset($dw[$value['drawing_no']])): ?>
      Released
      <?php else: ?>
      Not Released
      <?php endif; ?>

      <?php endif; ?>
      </center>
    </td>
    <td>
      <center>
      <?php if ($value['drawing_as']): ?>
      <?php if (isset($dw[$value['drawing_as']])): ?>
      Released
      <?php else: ?>
      Not Released
      <?php endif; ?>

      <?php endif; ?>
      </center>
    </td>

    <td>
      <center>
      <?php if ($value['drawing_sp']): ?>
      <?php if (isset($dw[$value['drawing_sp']])): ?>
      Released
      <?php else: ?>
      Not Released
      <?php endif; ?>

      <?php endif; ?>
      </center>
    </td>

  </tr>
  <?php endforeach; ?>
</table>