<?php
  $num_complete = 0;

  function color_progress($progress){
    $color = "bg-danger";
    if($progress == 100){
      $color = "bg-success";
    }
    elseif($progress > 25){
      $color = "bg-warning";
    }
    return $color;
  }
?>
<div id="content" class="container-fluid">

  <div class="card shadow my-3 rounded-0">
    <div class="card-body bg-white overflow-auto">
      <hr>
      <h1 class="text-center font-weight-bold"><?php echo $workpack['workpack_no'] ?></h1>
      <hr>
    </div>
  </div>

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>
    <div class="card-body bg-white overflow-auto">
      <div class="overflow-auto">
        <?php if($workpack['phase'] == "PF"): ?>
        <table class="table table-hover text-center dataTable">
          <thead class="bg-green-smoe text-white text-nowrap">
            <tr>
              <!-- <th></th> -->
              <th>Drawing GA</th>
              <th>Rev GA</th>
              <th>Drawing AS</th>
              <th>Rev AS</th>
              <th>Piecemark</th>
              <th>Material</th>
              <th>Profile</th>
              <th>Grade</th>
              <th>Weight (kg)</th>
              <th>Remarks</th>
              <th>Surveyor MV By</th>
              <th>Surveyor MV Date</th>
              <th>Progress MV</th>
              <th>RFI Status MV</th>
							<?php foreach ($workpack_subactivity_list as $key => $subactivity_list): ?>
								<th><?= $key ?></th>
							<?php endforeach; ?>
            </tr>
          </thead>
          <tbody>
            <?php 
              foreach ($detail_list as $key => $value): 
                if($value['progress_mv'] == 100 || $value['manual_close'] == 1){
                  $num_complete++;
                  $value['progress_mv'] = 100;
                }
            ?>
            <tr>
              <!-- <td><input type='checkbox' class='checkbox-big' name="id[]" value='<?php echo $value['id'] ?>' onclick='save_checkbox(this)'></td> -->
              <td><?php echo $template_list[$value['id_template']]['drawing_ga'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['rev_ga'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['drawing_as'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['rev_as'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['part_id'] ?></td>
              <td><?php echo $template_list[$value['id_template']]["material"] ?></td>
              <td><?php echo $template_list[$value['id_template']]["profile"] ?></td>
              <td><?php echo @$material_grade_list[$template_list[$value['id_template']]["grade"]]['material_grade'] ?></td>
              <td><?php echo number_format((float)$template_list[$value['id_template']]["weight"], 2, '.', ''); ?></td>
              <td><?php echo $value['remarks'] ?></td>
              <?php if(@$user_list[@$mv_list[$value['id_template']][$value['id_workpack']]['surveyor_creator']] != ''): ?>
                <td><?php echo @$user_list[@$mv_list[$value['id_template']][$value['id_workpack']]['surveyor_creator']] ?></td>
                <td><?php echo @$mv_list[$value['id_template']][$value['id_workpack']]['surveyor_created_date'] ?></td>
              <?php else: ?>
                <td><?php echo @$user_list[$progress_list[$value['id_template']]['progress_by']] ?></td>
                <td><?php echo @$progress_list[$value['id_template']]['date_of_progress'] ?></td>
              <?php endif; ?>
              <td>
                <div class="progress">
                  <div class="progress-bar progress-bar-striped progress-bar-animated <?php echo color_progress($value['progress_mv']); ?>" role="progressbar" aria-valuenow="<?php echo $value['progress_mv'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $value['progress_mv'] ?>%"><b class="<?php echo ($value['progress_mv'] < 25 ? 'text-dark' : '') ?>"><?php echo $value['progress_mv'] ?>%<b></div>
                </div>
              </td>
              <td>
                <?php if(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == "0"): ?>
                  <span class="badge badge-pill badge-primary">Ready to Submit RFI</span>
                <?php elseif(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 1): ?>
                  <span class="badge badge-pill badge-info">Pending Approval QC</span>
                <?php elseif(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 2): ?>
                  <span class="badge badge-pill badge-danger">Rejected by QC</span>
                <?php elseif(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 3): ?>
                  <span class="badge badge-pill badge-success">Approved by QC</span>
                <?php elseif(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 4): ?>
                  <span class="badge badge-pill badge-secondary">Pending by QC</span>
                <?php elseif(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 5): ?>
                  <span class="badge badge-pill badge-info">Pending Approval Client</span>
                <?php elseif(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 6): ?>
                  <span class="badge badge-pill badge-danger">Rejected by Client</span>
                <?php elseif(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 7): ?>
                  <span class="badge badge-pill badge-success">Approved by Client</span>
                <?php elseif(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 8): ?>
                  <span class="badge badge-pill badge-warning">Request for Update</span>
                <?php elseif(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 9): ?>
                  <span class="badge badge-pill badge-primary">Client RFI - Accepted with Comment</span>
                <?php elseif(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 10): ?>
                  <span class="badge badge-pill badge-warning">Client RFI - Postponed</span>
                <?php elseif(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 11): ?>
                  <span class="badge badge-pill badge-warning">Client RFI - Re-Offer</span>
                <?php elseif(@$mv_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 12): ?>
                  <span class="badge badge-pill badge-dark">Void</span>
                <?php else: ?>
                  <span class="badge badge-pill badge-dark">Not Ready</span>
                <?php endif; ?>
              </td>
							<?php 
								foreach ($workpack_subactivity_list as $subactivity_list): 
									$subactivity = $subactivity_list[$value['id_template']];
							?>
								<td>
									<div class="progress">
										<div class="progress-bar progress-bar-striped progress-bar-animated <?php echo color_progress($subactivity['progress']); ?>" role="progressbar" aria-valuenow="<?php echo $subactivity['progress'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $subactivity['progress'] ?>%"><b class="<?php echo ($subactivity['progress'] < 25 ? 'text-dark' : '') ?>"><?php echo $subactivity['progress'] ?>%<b></div>
									</div>
								</td>
							<?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php elseif($workpack['phase'] == "ITR"): ?>
        <table class="table table-hover text-center dataTable">
          <thead class="bg-green-smoe text-white text-nowrap">
            <tr>
              <!-- <th></th> -->
              <th>Drawing GA</th>
              <th>Rev GA</th>
              <th>Drawing AS</th>
              <th>Rev AS</th>
              <th>Piecemark</th>
              <th>Material</th>
              <th>Profile</th>
              <th>Grade</th>
              <th>Weight (kg)</th>
              <th>Remarks</th>
              <th>Surveyor ITR By</th>
              <th>Surveyor ITR Date</th>
              <th>Progress ITR</th>
              <th>RFI Status ITR</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              foreach ($detail_list as $key => $value): 
                if($value['progress_itr'] == 100 || $value['manual_close'] == 1){
                  $num_complete++;
                  $value['progress_itr'] = 100;
                }
            ?>
            <tr>
              <!-- <td><input type='checkbox' class='checkbox-big' name="id[]" value='<?php echo $value['id'] ?>' onclick='save_checkbox(this)'></td> -->
              <td><?php echo $template_list[$value['id_template']]['drawing_ga'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['rev_ga'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['drawing_as'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['rev_as'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['part_id'] ?></td>
              <td><?php echo $template_list[$value['id_template']]["material"] ?></td>
              <td><?php echo $template_list[$value['id_template']]["profile"] ?></td>
              <td><?php echo @$material_grade_list[$template_list[$value['id_template']]["grade"]]['material_grade'] ?></td>
              <td><?php echo number_format((float)$template_list[$value['id_template']]["weight"], 2, '.', ''); ?></td>
              <td><?php echo $value['remarks'] ?></td>
              <?php if(@$user_list[@$itr_list[$value['id_template']][$value['id_workpack']]['surveyor_creator']] != ''): ?>
                <td><?php echo @$user_list[@$itr_list[$value['id_template']][$value['id_workpack']]['surveyor_creator']] ?></td>
                <td><?php echo @$itr_list[$value['id_template']][$value['id_workpack']]['surveyor_created_date'] ?></td>
              <?php else: ?>
                <td><?php echo @$user_list[$progress_list[$value['id_template']]['progress_by']] ?></td>
                <td><?php echo @$progress_list[$value['id_template']]['date_of_progress'] ?></td>
              <?php endif; ?>
              <td>
                <div class="progress">
                  <div class="progress-bar progress-bar-striped progress-bar-animated <?php echo color_progress($value['progress_itr']); ?>" role="progressbar" aria-valuenow="<?php echo $value['progress_itr'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $value['progress_itr'] ?>%"><b class="<?php echo ($value['progress_itr'] < 25 ? 'text-dark' : '') ?>"><?php echo $value['progress_itr'] ?>%<b></div>
                </div>
              </td>
              <td>
                <?php if(@$itr_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == "0"): ?>
                  <span class="badge badge-pill badge-primary">Ready to Submit RFI</span>
                <?php elseif(@$itr_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 1): ?>
                  <span class="badge badge-pill badge-info">Pending Approval QC</span>
                <?php elseif(@$itr_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 2): ?>
                  <span class="badge badge-pill badge-danger">Rejected by QC</span>
                <?php elseif(@$itr_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 3): ?>
                  <span class="badge badge-pill badge-success">Approved by QC</span>
                <?php elseif(@$itr_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 4): ?>
                  <span class="badge badge-pill badge-secondary">Pending by QC</span>
                <?php elseif(@$itr_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 5): ?>
                  <span class="badge badge-pill badge-info">Pending Approval Client</span>
                <?php elseif(@$itr_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 6): ?>
                  <span class="badge badge-pill badge-danger">Rejected by Client</span>
                <?php elseif(@$itr_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 7): ?>
                  <span class="badge badge-pill badge-success">Approved by Client</span>
                <?php elseif(@$itr_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 8): ?>
                  <span class="badge badge-pill badge-warning">Request for Update</span>
                <?php elseif(@$itr_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 9): ?>
                  <span class="badge badge-pill badge-primary">Client RFI - Accepted with Comment</span>
                <?php elseif(@$itr_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 10): ?>
                  <span class="badge badge-pill badge-warning">Client RFI - Postponed</span>
                <?php elseif(@$itr_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 11): ?>
                  <span class="badge badge-pill badge-warning">Client RFI - Re-Offer</span>
                <?php elseif(@$itr_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 12): ?>
                  <span class="badge badge-pill badge-dark">Void</span>
                <?php else: ?>
                  <span class="badge badge-pill badge-dark">Not Ready</span>
                <?php endif; ?>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php elseif($workpack['phase'] == "BAA"): ?>
        <table class="table table-hover text-center dataTable">
          <thead class="bg-green-smoe text-white text-nowrap">
            <tr>
              <!-- <th></th> -->
              <th>Drawing WM</th>
              <th>Rev WM</th>
              <th>Joint No.</th>
              <th>Piecemark#1</th>
              <th>Piecemark#2</th>
              <th>Phase</th>
              <th>Weld Type Code</th>
              <th>Thickness</th>
              <th>Diameter</th>
              <th>Schedule</th>
              <th>Length</th>
              <th>Weld Length</th>
              <th>Remarks</th>
              <th>Surveyor Boundstrand By</th>
              <th>Surveyor Boundstrand Date</th>
              <th>Progress Boundstrand</th>
              <th>RFI Status Boundstrand</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              foreach ($detail_list as $key => $value): 
                if(($value['progress_fu'] == 100 && $value['progress_vt'] == 100) || $value['manual_close'] == 1){
                  $num_complete++;
                  $value['progress_fu'] = 100;
                  $value['progress_vt'] = 100;
                }
            ?>
            <tr>
              <!-- <td><input type='checkbox' class='checkbox-big' name="id[]" value='<?php echo $value['id'] ?>' onclick='save_checkbox(this)'></td> -->
              <td><?php echo $template_list[$value['id_template']]['drawing_wm'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['rev_wm'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['joint_no'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['pos_1'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['pos_2'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['phase'] ?></td>
              <td><?php echo @$weld_type[$template_list[$value['id_template']]['weld_type']]['weld_type_code'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['thickness'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['diameter'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['sch'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['length'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['weld_length'] ?></td>
              <td><?php echo $value['remarks'] ?></td>
              <?php if(@$user_list[$baa_list[$value['id_template']][$value['id_workpack']]['surveyor_creator']] != ''): ?>
                <td><?php echo @$user_list[$baa_list[$value['id_template']][$value['id_workpack']]['surveyor_creator']] ?></td>
                <td><?php echo @$baa_list[$value['id_template']][$value['id_workpack']]['surveyor_created_date'] ?></td>
              <?php else: ?>
                <td><?php echo @$user_list[$progress_list[$value['id_template']][$array_process_update[$workpack['phase']][0]]['progress_by']] ?></td>
                <td><?php echo @$progress_list[$value['id_template']][$array_process_update[$workpack['phase']][0]]['date_of_progress'] ?></td>
              <?php endif; ?>
              <td>
                <div class="progress">
                  <div class="progress-bar progress-bar-striped progress-bar-animated <?php echo color_progress($value['progress_baa']); ?>" role="progressbar" aria-valuenow="<?php echo $value['progress_baa'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $value['progress_baa'] ?>%"><b class="<?php echo ($value['progress_baa'] < 25 ? 'text-dark' : '') ?>"><?php echo $value['progress_baa'] ?>%<b></div>
                </div>
              </td>
              <td>
                <?php if(@$baa_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == "0"): ?>
                  <span class="badge badge-pill badge-primary">Ready to Submit RFI</span>
                <?php elseif(@$baa_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 1): ?>
                  <span class="badge badge-pill badge-info">Pending Approval QC</span>
                <?php elseif(@$baa_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 2): ?>
                  <span class="badge badge-pill badge-danger">Rejected by QC</span>
                <?php elseif(@$baa_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 3): ?>
                  <span class="badge badge-pill badge-success">Approved by QC</span>
                <?php elseif(@$baa_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 4): ?>
                  <span class="badge badge-pill badge-secondary">Pending by QC</span>
                <?php elseif(@$baa_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 5): ?>
                  <span class="badge badge-pill badge-info">Pending Approval Client</span>
                <?php elseif(@$baa_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 6): ?>
                  <span class="badge badge-pill badge-danger">Rejected by Client</span>
                <?php elseif(@$baa_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 7): ?>
                  <span class="badge badge-pill badge-success">Approved by Client</span>
                <?php elseif(@$baa_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 8): ?>
                  <span class="badge badge-pill badge-warning">Request for Update</span>
                <?php elseif(@$baa_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 9): ?>
                  <span class="badge badge-pill badge-primary">Client RFI - Accepted with Comment</span>
                <?php elseif(@$baa_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 10): ?>
                  <span class="badge badge-pill badge-warning">Client RFI - Postponed</span>
                <?php elseif(@$baa_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 11): ?>
                  <span class="badge badge-pill badge-warning">Client RFI - Re-Offer</span>
                <?php elseif(@$baa_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 12): ?>
                  <span class="badge badge-pill badge-warning">Void</span>
                <?php else: ?>
                  <span class="badge badge-pill badge-dark">Not Ready</span>
                <?php endif; ?>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php else: ?>
        <table class="table table-hover text-center dataTable">
          <thead class="bg-green-smoe text-white text-nowrap">
            <tr>
              <!-- <th></th> -->
              <th>Drawing WM</th>
              <th>Rev WM</th>
              <th>Joint No.</th>
              <th>Piecemark#1</th>
              <th>Piecemark#2</th>
              <th>Phase</th>
              <th>Weld Type Code</th>
              <th>Thickness</th>
              <th>Diameter</th>
              <th>Schedule</th>
              <th>Length</th>
              <th>Weld Length</th>
              <th>Remarks</th>
              <th>Surveyor FU By</th>
              <th>Surveyor FU Date</th>
              <th>Progress FU</th>
              <th>RFI Status FU</th>
              <th>Surveyor VT By</th>
              <th>Surveyor VT Date</th>
              <th>Progress VT</th>
              <th>RFI Status VT</th>
							<?php foreach ($workpack_subactivity_list as $key => $subactivity_list): ?>
								<th><?= $key ?></th>
							<?php endforeach; ?>
            </tr>
          </thead>
          <tbody>
            <?php 
              foreach ($detail_list as $key => $value): 
                if(($value['progress_fu'] == 100 && $value['progress_vt'] == 100) || $value['manual_close'] == 1){
                  $num_complete++;
                  $value['progress_fu'] = 100;
                  $value['progress_vt'] = 100;
                }
            ?>
            <tr>
              <!-- <td><input type='checkbox' class='checkbox-big' name="id[]" value='<?php echo $value['id'] ?>' onclick='save_checkbox(this)'></td> -->
              <td><?php echo $template_list[$value['id_template']]['drawing_wm'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['rev_wm'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['joint_no'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['pos_1'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['pos_2'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['phase'] ?></td>
              <td><?php echo @$weld_type[$template_list[$value['id_template']]['weld_type']]['weld_type_code'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['thickness'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['diameter'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['sch'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['length'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['weld_length'] ?></td>
              <td><?php echo $value['remarks'] ?></td>
              <?php if(@$user_list[$fu_list[$value['id_template']][$value['id_workpack']]['surveyor_creator']] != ''): ?>
                <td><?php echo @$user_list[$fu_list[$value['id_template']][$value['id_workpack']]['surveyor_creator']] ?></td>
                <td><?php echo @$fu_list[$value['id_template']][$value['id_workpack']]['surveyor_created_date'] ?></td>
              <?php else: ?>
                <td><?php echo @$user_list[$progress_list[$value['id_template']][$array_process_update[$workpack['phase']][0]]['progress_by']] ?></td>
                <td><?php echo @$progress_list[$value['id_template']][$array_process_update[$workpack['phase']][0]]['date_of_progress'] ?></td>
              <?php endif; ?>
              <td>
                <div class="progress">
                  <div class="progress-bar progress-bar-striped progress-bar-animated <?php echo color_progress($value['progress_fu']); ?>" role="progressbar" aria-valuenow="<?php echo $value['progress_fu'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $value['progress_fu'] ?>%"><b class="<?php echo ($value['progress_fu'] < 25 ? 'text-dark' : '') ?>"><?php echo $value['progress_fu'] ?>%<b></div>
                </div>
              </td>
              <td>
                <?php if(@$fu_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == "0"): ?>
                  <span class="badge badge-pill badge-primary">Ready to Submit RFI</span>
                <?php elseif(@$fu_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 1): ?>
                  <span class="badge badge-pill badge-info">Pending Approval QC</span>
                <?php elseif(@$fu_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 2): ?>
                  <span class="badge badge-pill badge-danger">Rejected by QC</span>
                <?php elseif(@$fu_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 3): ?>
                  <span class="badge badge-pill badge-success">Approved by QC</span>
                <?php elseif(@$fu_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 4): ?>
                  <span class="badge badge-pill badge-secondary">Pending by QC</span>
                <?php elseif(@$fu_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 5): ?>
                  <span class="badge badge-pill badge-info">Pending Approval Client</span>
                <?php elseif(@$fu_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 6): ?>
                  <span class="badge badge-pill badge-danger">Rejected by Client</span>
                <?php elseif(@$fu_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 7): ?>
                  <span class="badge badge-pill badge-success">Approved by Client</span>
                <?php elseif(@$fu_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 8): ?>
                  <span class="badge badge-pill badge-warning">Request for Update</span>
                <?php elseif(@$fu_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 9): ?>
                  <span class="badge badge-pill badge-primary">Client RFI - Accepted with Comment</span>
                <?php elseif(@$fu_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 10): ?>
                  <span class="badge badge-pill badge-warning">Client RFI - Postponed</span>
                <?php elseif(@$fu_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 11): ?>
                  <span class="badge badge-pill badge-warning">Client RFI - Re-Offer</span>
                <?php elseif(@$fu_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 12): ?>
                  <span class="badge badge-pill badge-warning">Void</span>
                <?php else: ?>
                  <span class="badge badge-pill badge-dark">Not Ready</span>
                <?php endif; ?>
              </td>
              <?php if(@$user_list[$vt_list[$value['id_template']][$value['id_workpack']]['surveyor_creator']] != ''): ?>
                <td><?php echo @$user_list[$vt_list[$value['id_template']][$value['id_workpack']]['surveyor_creator']] ?></td>
                <td><?php echo @$vt_list[$value['id_template']][$value['id_workpack']]['surveyor_created_date'] ?></td>
              <?php else: ?>
              <td><?php echo @$user_list[$progress_list[$value['id_template']][$array_process_update[$workpack['phase']][1]]['progress_by']] ?></td>
              <td><?php echo @$progress_list[$value['id_template']][$array_process_update[$workpack['phase']][1]]['date_of_progress'] ?></td>
              <?php endif; ?>
              <td>
                <div class="progress">
                  <div class="progress-bar progress-bar-striped progress-bar-animated <?php echo color_progress($value['progress_vt']); ?>" role="progressbar" aria-valuenow="<?php echo $value['progress_vt'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $value['progress_vt'] ?>%"><b class="<?php echo ($value['progress_vt'] < 25 ? 'text-dark' : '') ?>"><?php echo $value['progress_vt'] ?>%<b></div>
                </div>
              </td>
              <td>
                <?php if(@$vt_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == "0"): ?>
                  <span class="badge badge-pill badge-primary">Ready to Submit RFI</span>
                <?php elseif(@$vt_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 1): ?>
                  <span class="badge badge-pill badge-info">Pending Approval QC</span>
                <?php elseif(@$vt_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 2): ?>
                  <span class="badge badge-pill badge-danger">Rejected by QC</span>
                <?php elseif(@$vt_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 3): ?>
                  <span class="badge badge-pill badge-success">Approved by QC</span>
                <?php elseif(@$vt_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 4): ?>
                  <span class="badge badge-pill badge-secondary">Pending by QC</span>
                <?php elseif(@$vt_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 5): ?>
                  <span class="badge badge-pill badge-info">Pending Approval Client</span>
                <?php elseif(@$vt_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 6): ?>
                  <span class="badge badge-pill badge-danger">Rejected by Client</span>
                <?php elseif(@$vt_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 7): ?>
                  <span class="badge badge-pill badge-success">Approved by Client</span>
                <?php elseif(@$vt_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 8): ?>
                  <span class="badge badge-pill badge-warning">Request for Update</span>
                <?php elseif(@$vt_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 9): ?>
                  <span class="badge badge-pill badge-primary">Client RFI - Accepted with Comment</span>
                <?php elseif(@$vt_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 10): ?>
                  <span class="badge badge-pill badge-warning">Client RFI - Postponed</span>
                <?php elseif(@$vt_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 11): ?>
                  <span class="badge badge-pill badge-warning">Client RFI - Re-Offer</span>
                <?php elseif(@$vt_list[$value['id_template']][$value['id_workpack']]['status_inspection'] == 12): ?>
                  <span class="badge badge-pill badge-warning">Void</span>
                <?php else: ?>
                  <span class="badge badge-pill badge-dark">Not Ready</span>
                <?php endif; ?>
              </td>
							<?php 
								foreach ($workpack_subactivity_list as $subactivity_list): 
									$subactivity = $subactivity_list[$value['id_template']];
							?>
								<td>
									<div class="progress">
										<div class="progress-bar progress-bar-striped progress-bar-animated <?php echo color_progress($subactivity['progress']); ?>" role="progressbar" aria-valuenow="<?php echo $subactivity['progress'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $subactivity['progress'] ?>%"><b class="<?php echo ($subactivity['progress'] < 25 ? 'text-dark' : '') ?>"><?php echo $subactivity['progress'] ?>%<b></div>
									<?= $subactivity['progress'] ?>
                  </div>
								</td>
							<?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php endif; ?>
      </div>
    </div>
  </div>

</div>
</div>