<?php
  error_reporting(0);
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Workpack Register (".date("Y-m-d H:i:s").").xls");
?>

<table border="1" style="width:100%; border-collapse: collapse;">
  <?php if($get['phase'] == 'PF'): ?>
    <tr>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Project</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Module</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Type of Module</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Deck Elevation / Service Line</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Discipline</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Phase</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Desc Assy</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Company</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Workpack No.</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Description</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Plan Start Date</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Plan Finish Date</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Issued Date</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Finish Date</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Location</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Drawing GA</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Rev GA</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Drawing AS</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Rev AS</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Piecemark</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Cutting Plan</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Rev CP</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Cutting List</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Rev CL</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Material</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Profile</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Grade</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Weight</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Length</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Status</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Status Workpack</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Progress</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Status RFI MV</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Remarks</td>
    </tr>

    <?php $no = 1;foreach ($detail_list as $key => $value): ?> 
      <tr>
        <td style="vertical-align: middle; text-align: center;"><?= $project_list[$workpack_list[$value['id_workpack']]['project']]['project_name'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $module_list[$workpack_list[$value['id_workpack']]['module']]['mod_desc'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $type_of_module_list[$workpack_list[$value['id_workpack']]['type_of_module']]['name'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $deck_elevation_list[$workpack_list[$value['id_workpack']]['deck_elevation']]['name'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $discipline_list[$workpack_list[$value['id_workpack']]['discipline']]['discipline_name'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $workpack_list[$value['id_workpack']]['phase'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $desc_assy_list[$workpack_list[$value['id_workpack']]['desc_assy']]['name'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $company_list[$workpack_list[$value['id_workpack']]['company_id']]['company_name'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $workpack_list[$value['id_workpack']]['workpack_no'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $workpack_list[$value['id_workpack']]['description'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $workpack_list[$value['id_workpack']]['plan_start_date'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $workpack_list[$value['id_workpack']]['plan_finish_date'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $workpack_list[$value['id_workpack']]['issued_date'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $workpack_list[$value['id_workpack']]['actual_finish_date'] ?></td>
        <td style="vertical-align: middle; text-align: center;">
          <?php
            if($workpack_list[$value['id_workpack']]['location_v2'] != 0){
              echo @$area_v2_list[$location_v2_list[$workpack_list[$value['id_workpack']]['location_v2']]['id_area']]['name'].', '.@$location_v2_list[$workpack_list[$value['id_workpack']]['location_v2']]['name'];
            }
            else{
              echo @$location_list[$workpack_list[$value['id_workpack']]['location']]['location_name'];
            }
          ?>
        </td>
        <td style="vertical-align: middle; text-align: center;"><?= $template_list[$value['id_template']]['drawing_ga'] ?></td>
        <td style="vertical-align: middle; text-align: center;">="<?= $template_list[$value['id_template']]['rev_ga'] ?>"</td>
        <td style="vertical-align: middle; text-align: center;"><?= $template_list[$value['id_template']]['drawing_as'] ?></td>
        <td style="vertical-align: middle; text-align: center;">="<?= $template_list[$value['id_template']]['rev_as'] ?>"</td>
        <td style="vertical-align: middle; text-align: center;"><?= $template_list[$value['id_template']]['part_id'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $template_list[$value['id_template']]['drawing_cp'] ?></td>
        <td style="vertical-align: middle; text-align: center;">="<?= $template_list[$value['id_template']]['rev_cp'] ?>"</td>
        <td style="vertical-align: middle; text-align: center;"><?= $template_list[$value['id_template']]['drawing_cl'] ?></td>
        <td style="vertical-align: middle; text-align: center;">="<?= $template_list[$value['id_template']]['rev_cl'] ?>"</td>
        <td style="vertical-align: middle; text-align: center;"><?= $template_list[$value['id_template']]["material"] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $template_list[$value['id_template']]["profile"] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= @$material_grade_list[$template_list[$value['id_template']]["grade"]]['material_grade'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $template_list[$value['id_template']]["weight"] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $template_list[$value['id_template']]["length"] ?></td>
        <td style="vertical-align: middle; text-align: center;">
        <?php
          if($value['status'] == 3){
            echo "Returned";
          }
          elseif($workpack_list[$value['id_workpack']]['status'] == 1){
            echo "Issued";
          }
          elseif($workpack_list[$value['id_workpack']]['status'] == 2){
            echo "Completed";
          }
          elseif($workpack_list[$value['id_workpack']]['status_approval'] == 2){
            echo "Rejected";
          }
          elseif($workpack_list[$value['id_workpack']]['status_approval'] == 1){
            echo "Pending Approval";
          }
          elseif($workpack_list[$value['id_workpack']]['status_approval'] == 0){
            echo "Draft";
          }
        ?>
        </td>
        <td style="vertical-align: middle; text-align: center;">
        <?php
          if($value['status'] == 3){
            echo "-";
          }
          elseif($workpack_list[$value['id_workpack']]['status'] == 1){
            if($workpack_list[$value['id_workpack']]['plan_finish_date'] >= date("Y-m-d")){
              echo "In Progress";
            }
            elseif($workpack_list[$value['id_workpack']]['plan_finish_date'] < date("Y-m-d")){
              echo "Overdue";
            }
          }
          elseif($workpack_list[$value['id_workpack']]['status'] == 2){
            echo "Completed";
          }
          else{
            echo "-";
          }
        ?>
        </td>
        <td style="vertical-align: middle; text-align: center;"><?= $value['progress_mv'] ?>%</td>
        <td style="vertical-align: middle; text-align: center;">
        <?php
          if(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == "0"){
            echo "Ready to Submit RFI";
          }
          elseif(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 1){
            echo "Pending Approval QC";
          }
          elseif(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 2){
            echo "Rejected by QC";
          }
          elseif(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 3){
            echo "Approved by QC";
          }
          elseif(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 4){
            echo "Pending by QC";
          }
          elseif(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 5){
            echo "Pending Approval Client";
          }
          elseif(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 6){
            echo "Rejected by Client";
          }
          elseif(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 7){
            echo "Approved by Client";
          }
          elseif(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 8){
            echo "Request for Update";
          }
          elseif(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 9){
            echo "Client RFI - Accepted with Comment";
          }
          elseif(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 10){
            echo "Client RFI - Postponed";
          }
          elseif(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 11){
            echo "Client RFI - Re-Offer";
          }
          elseif(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 12){
            echo "Void";
          }
          else{
            echo "Not Ready";
          }
        ?>
        </td>
        <td style="vertical-align: middle; text-align: center;"><?= $value['remarks'] ?></td>
      </tr>
    <?php endforeach; ?>
  <?php else: ?>
    <tr>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Project</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Module</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Type of Module</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Deck Elevation / Service Line</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Discipline</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Phase</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Desc Assy</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Company</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Workpack No.</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Description</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Plan Start Date</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Plan Finish Date</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Issued Date</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Finish Date</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Location</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Drawing WM</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Rev WM</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Joint No.</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Piecemark#1</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Piecemark#2</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Weld Type Code</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Thickness</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Diameter</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Schedule</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Length</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Weld Length</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Status</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Status Workpack</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Progress FU</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Status RFI FU</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Progress VT</td>
      <td style="vertical-align: middle; font-weight: bold; text-align: center;">Status RFI VT</td>
    </tr>
    <?php $no = 1;foreach ($detail_list as $key => $value): ?> 
      <tr>
        <td style="vertical-align: middle; text-align: center;"><?= $project_list[$workpack_list[$value['id_workpack']]['project']]['project_name'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $module_list[$workpack_list[$value['id_workpack']]['module']]['mod_desc'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $type_of_module_list[$workpack_list[$value['id_workpack']]['type_of_module']]['name'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $deck_elevation_list[$workpack_list[$value['id_workpack']]['deck_elevation']]['name'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $discipline_list[$workpack_list[$value['id_workpack']]['discipline']]['discipline_name'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $workpack_list[$value['id_workpack']]['phase'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $desc_assy_list[$workpack_list[$value['id_workpack']]['desc_assy']]['name'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $company_list[$workpack_list[$value['id_workpack']]['company_id']]['company_name'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $workpack_list[$value['id_workpack']]['workpack_no'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $workpack_list[$value['id_workpack']]['description'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $workpack_list[$value['id_workpack']]['plan_start_date'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $workpack_list[$value['id_workpack']]['plan_finish_date'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $workpack_list[$value['id_workpack']]['issued_date'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?= $workpack_list[$value['id_workpack']]['actual_finish_date'] ?></td>
        <td style="vertical-align: middle; text-align: center;">
          <?php
            if($workpack_list[$value['id_workpack']]['location_v2'] != 0){
              echo @$area_v2_list[$location_v2_list[$workpack_list[$value['id_workpack']]['location_v2']]['id_area']]['name'].', '.@$location_v2_list[$workpack_list[$value['id_workpack']]['location_v2']]['name'];
            }
            else{
              echo @$location_list[$workpack_list[$value['id_workpack']]['location']]['location_name'];
            }
          ?>
        </td>
        <td style="vertical-align: middle; text-align: center;"><?php echo $template_list[$value['id_template']]['drawing_wm'] ?></td>
        <td style="vertical-align: middle; text-align: center;">="<?php echo $template_list[$value['id_template']]['rev_wm'] ?>"</td>
        <td style="vertical-align: middle; text-align: center;"><?php echo $template_list[$value['id_template']]['joint_no'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?php echo $template_list[$value['id_template']]['pos_1'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?php echo $template_list[$value['id_template']]['pos_2'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?php echo @$weld_type[$template_list[$value['id_template']]['weld_type']]['weld_type_code'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?php echo $template_list[$value['id_template']]['thickness'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?php echo $template_list[$value['id_template']]['diameter'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?php echo $template_list[$value['id_template']]['sch'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?php echo $template_list[$value['id_template']]['length'] ?></td>
        <td style="vertical-align: middle; text-align: center;"><?php echo $template_list[$value['id_template']]['weld_length'] ?></td>
        <td style="vertical-align: middle; text-align: center;">
        <?php
          if($workpack_list[$value['id_workpack']]['status'] == 1){
            echo "Issued";
          }
          elseif($workpack_list[$value['id_workpack']]['status'] == 2){
            echo "Completed";
          }
          elseif($workpack_list[$value['id_workpack']]['status_approval'] == 2){
            echo "Rejected";
          }
          elseif($workpack_list[$value['id_workpack']]['status_approval'] == 1){
            echo "Pending Approval";
          }
          elseif($workpack_list[$value['id_workpack']]['status_approval'] == 0){
            echo "Draft";
          }
        ?>
        </td>
        <td style="vertical-align: middle; text-align: center;">
        <?php
          if($workpack_list[$value['id_workpack']]['status'] == 1){
            if($workpack_list[$value['id_workpack']]['plan_finish_date'] >= date("Y-m-d")){
              echo "In Progress";
            }
            elseif($workpack_list[$value['id_workpack']]['plan_finish_date'] < date("Y-m-d")){
              echo "Overdue";
            }
          }
          elseif($workpack_list[$value['id_workpack']]['status'] == 2){
            echo "Completed";
          }
          else{
            echo "-";
          }
        ?>
        </td>
        <td style="vertical-align: middle; text-align: center;"><?= $value['progress_fu'] ?>%</td>
        <td style="vertical-align: middle; text-align: center;">
        <?php
          if(@$fu_list[$value['id_template']]['status_inspection'] == "0"){
            echo "Ready to Submit RFI";
          }
          elseif(@$fu_list[$value['id_template']]['status_inspection'] == 1){
            echo "Pending Approval QC";
          }
          elseif(@$fu_list[$value['id_template']]['status_inspection'] == 2){
            echo "Rejected by QC";
          }
          elseif(@$fu_list[$value['id_template']]['status_inspection'] == 3){
            echo "Approved by QC";
          }
          elseif(@$fu_list[$value['id_template']]['status_inspection'] == 4){
            echo "Pending by QC";
          }
          elseif(@$fu_list[$value['id_template']]['status_inspection'] == 5){
            echo "Pending Approval Client";
          }
          elseif(@$fu_list[$value['id_template']]['status_inspection'] == 6){
            echo "Rejected by Client";
          }
          elseif(@$fu_list[$value['id_template']]['status_inspection'] == 7){
            echo "Approved by Client";
          }
          elseif(@$fu_list[$value['id_template']]['status_inspection'] == 8){
            echo "Request for Update";
          }
          elseif(@$fu_list[$value['id_template']]['status_inspection'] == 9){
            echo "Client RFI - Accepted with Comment";
          }
          elseif(@$fu_list[$value['id_template']]['status_inspection'] == 10){
            echo "Client RFI - Postponed";
          }
          elseif(@$fu_list[$value['id_template']]['status_inspection'] == 11){
            echo "Client RFI - Re-Offer";
          }
          else{
            echo "Not Ready";
          }
        ?>
        </td>
        <td style="vertical-align: middle; text-align: center;"><?= $value['progress_vt'] ?>%</td>
        <td style="vertical-align: middle; text-align: center;">
        <?php
          if(@$vt_list[$value['id_template']]['status_inspection'] == "0"){
            echo "Ready to Submit RFI";
          }
          elseif(@$vt_list[$value['id_template']]['status_inspection'] == 1){
            echo "Pending Approval QC";
          }
          elseif(@$vt_list[$value['id_template']]['status_inspection'] == 2){
            echo "Rejected by QC";
          }
          elseif(@$vt_list[$value['id_template']]['status_inspection'] == 3){
            echo "Approved by QC";
          }
          elseif(@$vt_list[$value['id_template']]['status_inspection'] == 4){
            echo "Pending by QC";
          }
          elseif(@$vt_list[$value['id_template']]['status_inspection'] == 5){
            echo "Pending Approval Client";
          }
          elseif(@$vt_list[$value['id_template']]['status_inspection'] == 6){
            echo "Rejected by Client";
          }
          elseif(@$vt_list[$value['id_template']]['status_inspection'] == 7){
            echo "Approved by Client";
          }
          elseif(@$vt_list[$value['id_template']]['status_inspection'] == 8){
            echo "Request for Update";
          }
          elseif(@$fu_list[$value['id_template']]['status_inspection'] == 9){
            echo "Client RFI - Accepted with Comment";
          }
          elseif(@$fu_list[$value['id_template']]['status_inspection'] == 10){
            echo "Client RFI - Postponed";
          }
          elseif(@$fu_list[$value['id_template']]['status_inspection'] == 11){
            echo "Client RFI - Re-Offer";
          }
          else{
            echo "Not Ready";
          }
        ?>
        </td>
      </tr>
    <?php endforeach; ?>
  <?php endif; ?>
</table>