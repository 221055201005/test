<?php
  error_reporting(0);
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Workpack Register (".date("Y-m-d H:i:s").").xls");
?>

<table border="1" style="width:100%; border-collapse: collapse;">
  <tr>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Drawing No</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Title</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Rev No</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Project</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Module</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Discipline</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Drawing Status</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Piecemark Status</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Joint Status</td>
  </tr>

  <?php $no = 1;foreach ($data_excel as $row): ?> 
    <tr>
      <?php $no = 1;foreach ($row as $key => $value): ?> 
      <td style="vertical-align: middle; text-align: center;"><?= convert2utf8($value) ?></td>
      <?php endforeach; ?>
    </tr>
  <?php endforeach; ?>
</table>