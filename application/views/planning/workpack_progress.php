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
              <th>Drawing AS</th>
              <th>Rev AS</th>
              <th>Piecemark</th>
              <th>Material</th>
              <th>Profile</th>
              <th>Grade</th>
              <th>Weight (kg)</th>
              <th>Remarks</th>
              <th>Progress MV</th>
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
              <td><?php echo $template_list[$value['id_template']]['drawing_as'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['rev_as'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['part_id'] ?></td>
              <td><?php echo $template_list[$value['id_template']]["material"] ?></td>
              <td><?php echo $template_list[$value['id_template']]["profile"] ?></td>
              <td><?php echo @$material_grade_list[$template_list[$value['id_template']]["grade"]]['material_grade'] ?></td>
              <td><?php echo $template_list[$value['id_template']]["weight"] ?></td>
              <td><?php echo $value['remarks'] ?></td>
              <td>
                <div class="progress">
                  <div class="progress-bar progress-bar-striped progress-bar-animated <?php echo color_progress($value['progress_mv']); ?>" role="progressbar" aria-valuenow="<?php echo $value['progress_mv'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $value['progress_mv'] ?>%"><b class="<?php echo ($value['progress_mv'] < 25 ? 'text-dark' : '') ?>"><?php echo $value['progress_mv'] ?>%<b></div>
                </div>
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
              <th>Weld Type Code</th>
              <th>Thickness</th>
              <th>Diameter</th>
              <th>Schedule</th>
              <th>Length</th>
              <th>Weld Length</th>
              <th>Remarks</th>
              <th>Progress FU</th>
              <th>Progress VT</th>
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
              <td><?php echo @$weld_type[$template_list[$value['id_template']]['weld_type']]['weld_type_code'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['thickness'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['diameter'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['sch'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['length'] ?></td>
              <td><?php echo $template_list[$value['id_template']]['weld_length'] ?></td>
              <td><?php echo $value['remarks'] ?></td>
              <td>
                <div class="progress">
                  <div class="progress-bar progress-bar-striped progress-bar-animated <?php echo color_progress($value['progress_fu']); ?>" role="progressbar" aria-valuenow="<?php echo $value['progress_fu'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $value['progress_fu'] ?>%"><b class="<?php echo ($value['progress_fu'] < 25 ? 'text-dark' : '') ?>"><?php echo $value['progress_fu'] ?>%<b></div>
                </div>
              </td>
              <td>
                <div class="progress">
                  <div class="progress-bar progress-bar-striped progress-bar-animated <?php echo color_progress($value['progress_vt']); ?>" role="progressbar" aria-valuenow="<?php echo $value['progress_vt'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $value['progress_vt'] ?>%"><b class="<?php echo ($value['progress_vt'] < 25 ? 'text-dark' : '') ?>"><?php echo $value['progress_vt'] ?>%<b></div>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php endif; ?>
      </div>
      <br>
      <br>
      <?php if($num_complete < count($detail_list)): ?>
      <form method="POST" action="<?php echo base_url() ?>planning/workpack_progress_complete_process">
        <input type="hidden" name="id" value="<?php echo $workpack['id'] ?>">
        <input type="hidden" name="remarks" value="">

        <div class="text-right">
          <!-- <button type="submit" class="btn btn-sm btn-flat btn-success" name="status" value="1" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Complete&nbsp;</b> this?', this, event);"><i class="fas fa-check"></i> Manual Complete</button> -->
        </div>
      </form>
      <?php endif; ?>
    </div>
  </div>

</div>
</div>