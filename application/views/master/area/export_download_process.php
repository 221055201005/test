<?php
  error_reporting(0);
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Workpack Register (".date("Y-m-d H:i:s").").xls");
?>

<table border="1" style="width:100%; border-collapse: collapse;">
  <tr>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Area</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Location</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Point</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Alocation</td>
  </tr>
  <?php foreach ($area_v2_list as $key => $value): ?>
  <tr>
    <td style="vertical-align: middle; text-align: center;"><?= $value['name'] ?></td>
    <td style="vertical-align: middle; text-align: center;"></td>
    <td style="vertical-align: middle; text-align: center;"></td>
    <td style="vertical-align: middle; text-align: center;"></td>
  </tr>
  <?php endforeach ?>
  <?php foreach ($location_v2_list as $key => $value): ?>
  <tr>
    <td style="vertical-align: middle; text-align: center;"><?= $area_v2_list[$value['id_area']]['name'] ?></td>
    <td style="vertical-align: middle; text-align: center;"><?= $value['name'] ?></td>
    <td style="vertical-align: middle; text-align: center;"></td>
    <td style="vertical-align: middle; text-align: center;"></td>
  </tr>
  <?php endforeach ?>
  <?php foreach ($point_list as $key => $value): ?>
  <tr>
    <td style="vertical-align: middle; text-align: center;"><?= $area_v2_list[$location_v2_list[$value['id_location']]['id_area']]['name'] ?></td>
    <td style="vertical-align: middle; text-align: center;"><?= $location_v2_list[$value['id_location']]['name'] ?></td>
    <td style="vertical-align: middle; text-align: center;"><?= $value['name'] ?></td>
    <td style="vertical-align: middle; text-align: center;"></td>
  </tr>
  <?php endforeach; ?>
  <?php foreach ($alocation_list as $key => $value): ?>
  <tr>
    <td style="vertical-align: middle; text-align: center;"><?= $area_v2_list[$location_v2_list[$point_list[$value['id_point']]['id_location']]['id_area']]['name'] ?></td>
    <td style="vertical-align: middle; text-align: center;"><?= $location_v2_list[$point_list[$value['id_point']]['id_location']]['name'] ?></td>
    <td style="vertical-align: middle; text-align: center;"><?= $point_list[$value['id_point']]['name'] ?></td>
    <td style="vertical-align: middle; text-align: center;"><?= $value['name'] ?></td>
  </tr>
  <?php endforeach; ?>
</table>