<?php
  error_reporting(0);
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Workpack TimeSheet Register (".date("Y-m-d H:i:s").").xls");
?>

<table border="1" style="width:100%; border-collapse: collapse;">
  <tr>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Project</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Module</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Type of Module</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Discipline</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Deck Elevation / Service Line</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Desc Asy</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Phase</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Workpack No.</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Location</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Job No.</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Date</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Employee Badge</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Section</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Manhours</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Remarks</td>
  </tr>

  <?php $no = 1;foreach ($workpack_timesheet_list as $key => $value): ?> 
    <tr>
      <td style="vertical-align: middle; text-align: center;"><?= $project_list[$workpack_list[$value['workpack_id']]['project']]['project_name'] ?></td>
      <td style="vertical-align: middle; text-align: center;"><?= $module_list[$workpack_list[$value['workpack_id']]['module']]['mod_desc'] ?></td>
      <td style="vertical-align: middle; text-align: center;"><?= $type_of_module_list[$workpack_list[$value['workpack_id']]['type_of_module']]['name'] ?></td>
      <td style="vertical-align: middle; text-align: center;"><?= $discipline_list[$workpack_list[$value['workpack_id']]['discipline']]['discipline_name'] ?></td>
      <td style="vertical-align: middle; text-align: center;"><?= @$deck_elevation_list[$workpack_list[$value['workpack_id']]['deck_elevation']]['name'] ?></td>
      <td style="vertical-align: middle; text-align: center;"><?= @$desc_assy_list[$workpack_list[$value['workpack_id']]['desc_assy']]['name'] ?></td>
      <td style="vertical-align: middle; text-align: center;"><?= @$workpack_list[$value['workpack_id']]['phase'] ?></td>
      <td style="vertical-align: middle; text-align: center;"><?= @$workpack_list[$value['workpack_id']]['workpack_no'] ?></td>
      <td style="vertical-align: middle; text-align: center;">
        <?php
          if($workpack_list[$value['workpack_id']]['location_v2'] != 0){
            echo @$area_v2_list[$location_v2_list[$workpack_list[$value['workpack_id']]['location_v2']]['id_area']]['name'].', '.@$location_v2_list[$workpack_list[$value['workpack_id']]['location_v2']]['name'];
          }
          else{
            echo @$location_list[$workpack_list[$value['workpack_id']]['location']]['location_name'];
          }
        ?>
      </td>
      <td style="vertical-align: middle; text-align: center;"><?= $value['job_no'] ?></td>
      <td style="vertical-align: middle; text-align: center;"><?= $value['date'] ?></td>
      <td style="vertical-align: middle; text-align: center;"><?= $value['badge'] ?></td>
      <td style="vertical-align: middle; text-align: center;"><?= @$workpack_section[$value['section']]['name'] ?></td>
      <td style="vertical-align: middle; text-align: center;"><?= $value['manhours'] ?></td>
      <td style="vertical-align: middle; text-align: center;"><?= $value['remarks'] ?></td>
    </tr>
  <?php endforeach; ?>
</table>