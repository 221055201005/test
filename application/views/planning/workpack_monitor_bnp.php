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
        <table class="table table-hover text-center dataTable">
          <thead class="bg-green-smoe text-white text-nowrap">
            <tr>
							<th>Drawing Number</th>
							<th>Drawing Assembly</th>
							<th>Piecemark No.</th>
							<th>Profile</th> 
							<th>Grade</th> 
							<th>Size / Dia</th> 
							<th>Length</th> 
							<th>Area m2</th> 
							<th>THK</th> 
							<th>Paint System</th>
							<th>Activity Description</th>
							<th>Company Assigned</th>
							<?php foreach ($workpack_subactivity_list as $key => $subactivity_list): ?>
								<th><?= $key ?></th>
							<?php endforeach; ?>
							<th>Status B&P</th>
						</tr>
          </thead>
          <tbody>
            	<?php foreach ($paint_system_list as $paint_system): ?>
							<tr>
								<td><?php echo $piecemark_list[$paint_system['id_template']]['drawing_ga'] ?></td>
								<td><?php echo $piecemark_list[$paint_system['id_template']]['drawing_as'] ?></td>
								<td><?php echo $piecemark_list[$paint_system['id_template']]['part_id'] ?></td>
								<td><?php echo $piecemark_list[$paint_system['id_template']]['profile'] ?></td>
								<td><?php echo $material_grade_list[$piecemark_list[$paint_system['id_template']]['grade']]["material_grade"] ?></td>
								<td><?php echo $piecemark_list[$paint_system['id_template']]['diameter'] ?></td>
								<td><?php echo $piecemark_list[$paint_system['id_template']]['length'] ?></td>
								<td><?php echo $piecemark_list[$paint_system['id_template']]['area'] ?></td>
								<td><?php echo $piecemark_list[$paint_system['id_template']]['thickness'] ?></td>
								<td><?php echo $paint_system_data_list[$paint_system["id_paint_system"]][$paint_system["id_activity"]]["code"] ?></td>
								<td><?php echo $paint_system_data_list[$paint_system["id_paint_system"]][$paint_system["id_activity"]]["description_of_activity"] ?></td>
								<td><?php echo $company_list[$paint_system['id_company']]['company_name'] ?></td>
								<?php 
								foreach ($workpack_subactivity_list as $subactivity_list): 
									$subactivity = $subactivity_list[$paint_system['id_template']];
								?>
									<td>
										<div class="progress">
											<div class="progress-bar progress-bar-striped progress-bar-animated <?php echo color_progress($subactivity['progress']); ?>" role="progressbar" aria-valuenow="<?php echo $subactivity['progress'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $subactivity['progress'] ?>%"><b class="<?php echo ($subactivity['progress'] < 25 ? 'text-dark' : '') ?>"><?php echo $subactivity['progress'] ?>%<b></div>
										</div>
									</td>
								<?php endforeach; ?>
								<td>
									<?php if($paint_system['status_submited_bp'] == 0): ?>
									<span class="badge badge-pill badge-dark">Not Submitted</span>
									<?php elseif($paint_system['status_submited_bp'] == 1): ?>
									<span class="badge badge-pill badge-info">Submitted</span>
									<?php endif; ?>
								</td>
							</tr>
            	<?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
</div>