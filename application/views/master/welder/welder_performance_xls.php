<?php 
    $current_date = date("Y-m-d H:i:s");
    
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Welder_performance_$current_date.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    error_reporting(0);
?>
        <table border='1px'>
					<thead>
            <tr>
              <th rowspan='2'>Welder Code</th>
              <!-- <th rowspan='2'>Client Code</th> -->
              <th rowspan='2'>Company</th>
              <th rowspan='2'>Project</th>
              <th rowspan='2'>Employee ID</th>
              <th rowspan='2'>Welder Name</th>
              <th colspan='3'>Welder Qualification</th>
              <th colspan='6'>Number Of Weld Status</th>
              <th rowspan='2'>Rate %</th>
              <th colspan="<?= sizeof($master_ctq) ?>">Breakdown Of Defects Rejected</th>     
              <th rowspan='2'>SMOE STATUS</th>         
              <th rowspan='2'>KPI STATUS</th>         
              <th rowspan='2'>Data Audit</th>         
            </tr>      
            <tr>      
              <th>Process</th>              
              <th>F Number</th>             
              <th>Position</th> 
              <th>Joint Welded</th> 
              <th>Joint Tested</th> 
              <th>Joint Repaired</th>              
              <th>Welded (mm)</th> 
              <th>Tested (mm)</th> 
              <th>Rejected (mm)</th> 
              <?php foreach($master_ctq as $key => $value){ ?>
                <th><?= $value['ctq_initial'] ?></th>
              <?php } ?> 
            </tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($welder_list as $key => $value) : ?>

							<?php
							@$total_joint_welded += @$visual_data_welder[$value["id_welder"]]['joint_welded'] + 0 ;
							@$total_length_welded += @$visual_data_welder[$value["id_welder"]]['length_welded'] + 0 ;

							@$total_joint_tested += @$ndt_data_welder[$value["id_welder"]]['joint_tested'] + 0 ;
							@$total_length_tested += @$ndt_data_welder[$value["id_welder"]]['length_tested'] + 0 ;

							@$total_joint_reject += @$no_weld_status[$value["id_welder"]]['joint_repaired'] + 0 ;
							@$total_length_rejected += @$no_weld_status[$value["id_welder"]]['length_rejected'] + 0 ;

							?>

							<tr>

								<td><?php echo $value["welder_code"] ?></td>
								<!-- <td><?php echo $value["rwe_code"] ?></td> -->
								<td><?php echo @$company_list[$value["company_id"]]['company_name']; ?></td>
								<td><?php echo $project[$value["project_id"]]['project_name'] ?></td>
								<td><?php echo $value["welder_badge"] ?></td>
								<td><?php echo $value["welder_name"] ?></td>
								<td><?php foreach ($welder_detail_list[$value["id_welder"]] as $welder_process) {
											echo $welder_process_list[$welder_process['welder_process']]['name_process'] . "</br>";
										} ?></td>
								<td><?php foreach ($welder_detail_list[$value["id_welder"]] as $f_no) {
											echo $f_no['f_no'] . "</br>";
										} ?></td>
								<td><?php foreach ($welder_detail_list[$value["id_welder"]] as $welder_position) {
											echo $welder_position['welder_position'] . "</br>";
										} ?></td>


								<td><?= @$visual_data_welder[$value['id_welder']]['joint_welded']+0 ?></td>
								<td><?= @$ndt_data_welder[$value['id_welder']]['joint_tested']+0 ?></td>
								<td><?= @$no_weld_status[$value['id_welder']]['joint_repaired']+0 ?></td>
								<td><?= @$visual_data_welder[$value['id_welder']]['length_welded']+0 ?></td>
								<td><?= @$ndt_data_welder[$value['id_welder']]['length_tested']+0 ?></td>
								<td><?= @$no_weld_status[$value['id_welder']]['length_rejected']+0 ?></td>

								<td>
									<?php
									$var_joint_tested = @$ndt_data_welder[$value['id_welder']]['length_tested']+0;
									$var_joint_reject_ndt = @$no_weld_status[$value['id_welder']]['length_rejected']+0;

									if ($var_joint_reject_ndt > 0) {
										$total_rate = round(($var_joint_reject_ndt / $var_joint_tested) * 100, 2);
									?>
										<a target='_blank' href='<?= base_url(); ?>master/welder/welder_perform_audit/<?php echo strtr($this->encryption->encrypt($value["id_welder"]), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt($start_date), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt($end_date), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt($post['filter_date']), '+=/', '.-~') ?>'> <?php echo $total_rate . "%"; ?></a>
									<?php
									} else {
										$total_rate = 0;
										echo "0%";
									}
									?>
								</td>

								<?php foreach ($master_ctq as $keyx => $valuex) { ?>
									<?php
										@$total_reject[$keyx] += @$breakdown_defect[$value["id_welder"]][$valuex['id']] + 0;
									?>
									<td><?= round(@$breakdown_defect[$value["id_welder"]][$valuex['id']] + 0, 2) ?></td>
								<?php } ?>

								<td>
									<?php if ($value["status_actived"] == 1) : ?>
										<span class="badge badge-success">Active</span>
									<?php else : ?>
										<span class="badge badge-danger">Non-Active</span>
										<?php
										if (isset($value['remarks_auto_disabled'])) {
											echo "<span style='font-size:10px !important;font-weight:bold;font-style: italic;'>" . $value['remarks_auto_disabled'] . "</span><br/><span style='font-size:10px !important;font-weight:bold;font-style: italic;'>" . $value['auto_expired_date'] . "</span>";
										}
										?>
									<?php endif; ?>
								</td>

								<td>
									<?php if ($total_rate < 1) { ?>
										GOOD
									<?php } else if ($total_rate >= 1.8) { ?>
										TRAINING
									<?php } else if ($total_rate >= 1.5) { ?>
										MONITORING
									<?php } else if ($total_rate > 1) { ?>
										BRIEF
									<?php } ?>
								</td>
								<td>
									<?php if (isset($visual_data_welder[$value['id_welder']]['joint_welded'])) {  ?>
										<a target='_blank' href='<?= base_url(); ?>master/welder/welder_perform_audit/<?php echo strtr($this->encryption->encrypt($value["id_welder"]), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt($start_date), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt($end_date), '+=/', '.-~') ?>'>Audit</a>
									<?php } else { ?>
										-
									<?php } ?>
								</td>
							</tr>

						<?php $no++;
						endforeach; ?>

					</tbody>

          <tr>
						<td colspan='8'>Summary Of Calculation</td>
						<td><?= $total_joint_welded ?></td>
						<td><?= $total_joint_tested ?></td>
						<td><?= $total_joint_reject ?></td>
						<td><?= $total_length_welded ?></td>
						<td><?= $total_length_tested ?></td>
						<td><?= $total_length_rejected ?></td>
						<td><?= round(($total_length_rejected / $total_length_tested) * 100, 2) . "%"; ?></td>
						<?php foreach ($master_ctq as $keyx => $valuex) { ?>
							<td> <?= (isset($total_reject[$keyx]) ? $total_reject[$keyx] : 0) ?></td>
						<?php } ?>
					</tr>
        </table>
          
        <br/>
        <b>PCMS Welder Register - Download Date : <?php echo date("d-F-Y H:i:s"); ?></b>