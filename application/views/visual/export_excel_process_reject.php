<?php
  error_reporting(0);
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Reject Remarks History Visual Inspection.xls");
?>

<table border="1" style="width:100%; border-collapse: collapse;" style="width:100%">
  <tr>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">No</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Project</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Drawing No</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Drawing Weld Map</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Discipline</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Type Of Module</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Module</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Joint No</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Status</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Reject By</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Reject Date</td>
    <td style="vertical-align: middle; font-weight: bold; text-align: center;">Reject Remarks</td>
  </tr>

  <?php $no = 1;foreach ($reject_list as $key => $value): ?> 
    <tr>
    <td style="vertical-align: middle; text-align: center;"><?= $no++ ?></td>
    <td style="vertical-align: middle; text-align: center;"><?= $project[$detail_visual[$value['id_process']]['project_code']] ?></td>
    <td style="vertical-align: middle; text-align: center;"><?= $detail_visual[$value['id_process']]['drawing_no'] ?></td>
    <td style="vertical-align: middle; text-align: center;"><?= $joint[$detail_visual[$value['id_process']]['id_joint']]['drawing_wm']  ?></td>
    <td style="vertical-align: middle; text-align: center;"><?= $discipline_name[$detail_visual[$value['id_process']]['discipline']] ?></td>
    <td style="vertical-align: middle; text-align: center;"><?= $module_type_name[$detail_visual[$value['id_process']]['type_of_module']] ?></td>
    <td style="vertical-align: middle; text-align: center;"><?= $module_name[$detail_visual[$value['id_process']]['module']] ?></td>
    <td style="vertical-align: middle; text-align: center;"><?= $joint[$detail_visual[$value['id_process']]['id_joint']]['joint_no'] ?>
    <?php if ($detail_visual[$value['id_process']]['revision'] > 0): ?> 
     (<?= $detail_visual[$value['id_process']]['revision_category'] ?><?= $detail_visual[$value['id_process']]['revision'] ?>)
     <?php endif; ?>
  </td>
    <td style="vertical-align: middle; text-align: center;"><span style="color:red">Rejected</span></td>
    <td style="vertical-align: middle; text-align: center;"><?= $user_name[$value['created_by']] ?></td>
    <td style="vertical-align: middle; text-align: center;"><?= $value['created_date'] ?></td>
    <td style="vertical-align: middle; text-align: center;"><?= $value['remarks'] ?></td>
  </tr>
   <?php endforeach; ?>
</table>