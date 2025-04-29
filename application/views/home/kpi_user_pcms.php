<?php
  error_reporting(0);
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=KPI User PCMSv2 (".date("Y-m-d H:i:s").").xls");
?>

<table border="1" style="width:100%; border-collapse: collapse;">
  <tr>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Badge</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">User</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Date</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Input Piecemark</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Revise Piecemark</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Input Joint</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Revise Joint</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Input Progress MV</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Input Progress FU</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Input Progress VT</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Input Progress ITR</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Submit RFI MV</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Submit RFI FU</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Submit RFI VT</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Update RFI MV</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Update RFI FU</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Update RFI VT</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Inspection MV</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Inspection FU</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Inspection VT</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Transmit RFI Client MV</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Transmit RFI Client FU</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Transmit RFI Client VT</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Mechanical Input Data</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Mechanical Upload Attachment</td>
  </tr>
  <?php $no = 1;foreach ($data_list as $date => $users): ?> 
    <?php $no = 1;foreach ($users as $id_user => $value): ?> 
      <tr>
        <td style="vertical-align: middle; text-align: center;"><?= @$user_list[$id_user]['badge_no'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= @$user_list[$id_user]['full_name'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $date ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= @$value['num_pc']+0 ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= @$value['num_r_pc']+0 ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= @$value['num_jt']+0 ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= @$value['num_r_jt']+0 ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= @$value['num_progress_mv']+0 ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= @$value['num_progress_fu']+0 ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= @$value['num_progress_vt']+0 ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= @$value['num_progress_itr']+0 ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= @$value['num_mv']+0 ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= @$value['num_fu']+0 ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= @$value['num_vt']+0 ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= @$value['num_r_mv']+0 ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= @$value['num_r_fu']+0 ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= @$value['num_r_vt']+0 ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= @$value['num_inspect_mv']+0 ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= @$value['num_inspect_fu']+0 ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= @$value['num_inspect_vt']+0 ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= @$value['num_transmit_mv']+0 ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= @$value['num_transmit_fu']+0 ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= @$value['num_transmit_vt']+0 ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= @$value['num_mc_data']+0 ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= @$value['num_mc_attachment']+0 ?></td>
      </tr>
    <?php endforeach; ?>
  <?php endforeach; ?>
</table>

<!-- <table border="1" style="width:100%; border-collapse: collapse;">
  <tr>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">User</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Month</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Progress Fitup</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Progress Visual</td>
  </tr>
  <?php $no = 1;foreach ($data_list as $key => $value): ?> 
    <tr>
      <td style="vertical-align: middle; text-align: center;"><?= @$user_list[$value['surveyor_creator']] ?></td>
      <td style="vertical-align: middle; text-align: center;"><?= $value['month'] ?></td>
      <td style="vertical-align: middle; text-align: center;"><?= $value['num_ft'] ?></td>
      <td style="vertical-align: middle; text-align: center;"><?= $value['num_vt'] ?></td>
    </tr>
  <?php endforeach; ?>
</table> -->