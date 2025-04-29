<style type="text/css">
	.hide {
		display: none
	}
</style>

<script type="text/javascript">
	$(document).ready(function() {
		$('span.more_ut').click(function() {
			$('div.list_ut').slideToggle("slow");
		});

		$('span.more_rt').click(function() {
			$('div.list_rt').slideToggle("slow");
		});
	});
</script>

<div id="content" class="container-fluid">

	<div class='row'>
		<div class="col-4">

			<div class="card shadow my-3 rounded-0">
				<div class="card-header">
					<h6 class="m-0">Welder Details</h6>
				</div>

				<div class="card-body bg-white">
					<div class="overflow-auto">
						<table class="table">

							<tr>
								<td>Full Name</td>
								<td> :</td>
								<td> <?= $welder_list[0]['welder_name'] ?></td>
							</tr>

							<tr>
								<td>Welder Code</td>
								<td> :</td>
								<td> <?= $welder_list[0]['welder_code'] ?></td>
							</tr>

							<!-- <tr>
                    <td>Client Code</td>    
                    <td> :</td>    
                    <td> <?= $welder_list[0]['rwe_code'] ?></td>    
                    </tr> -->

							<tr>
								<td>Company</td>
								<td> :</td>
								<td> <?php echo @$company_list[$welder_list[0]["company_id"]]['company_name']; ?></td>
							</tr>

							<tr>
								<td>Project</td>
								<td> :</td>
								<td><?php echo $project[$welder_list[0]["project_id"]]['project_name'] ?></td>
							</tr>

							<tr>
								<td>Welder Badge</td>
								<td> :</td>
								<td><?php echo $welder_list[0]["welder_badge"] ?></td>
							</tr>

							<tr>
								<td>Electrode</td>
								<td> :</td>
								<td>
									<?php

									$current_date = date('Y-m-d');
									$enc_user_id  = strtr($this->encryption->encrypt($this->user_cookie[0]), '+=/', '.-~');

									?>
									<?php if ($electrode[0]['total_qty'] > 0) : ?>
										<a href="<?= wh_base_url() ?>consumable/consumable_transaction?date_from=2001-01-01&date_to=<?= $current_date ?>&category=3&badge=<?= $prefix_bd ?>&user=<?= $enc_user_id ?>" target="_blank"><?= $electrode[0]['total_qty'] ?> Kg</a>
									<?php else : ?>
										0 Kg
									<?php endif; ?>
								</td>
							</tr>

						</table>

					</div>
				</div>
			</div>

		</div>

		<div class="col-4">

			<div class="card shadow my-3 rounded-0">
				<div class="card-header">
					<h6 class="m-0">Welder Performance</h6>
				</div>

				<div class="card-body bg-white">
					<div class="overflow-auto">

						<figure class="highcharts-figure">
							<div id="weld_rate"></div>
						</figure>

					</div>
				</div>
			</div>

		</div>

		<div class="col-4">

			<div class="card shadow my-3 rounded-0">
				<div class="card-header">
					<h6 class="m-0">NDT Defect</h6>
				</div>

				<div class="card-body bg-white">
					<div class="overflow-auto">

						<figure class="highcharts-figure">
							<div id="ndt_rejection"></div>
						</figure>

					</div>
				</div>
			</div>

		</div>


		<div class="col-12">

			<div class="card shadow my-3 rounded-0">
				<div class="card-header">
					<h6 class="m-0"><span class="more_ut btn btn-info"><i class="fas fa-arrow-circle-down"></i></span> Details - NDT Ultrasonic </h6>
				</div>

				<div class="card-body list_ut bg-white hide">
					<div class="overflow-auto">

						<table class="table">
							<tr>
								<th>Submission ID</th>
								<th>Report Number</th>
								<th>Drawing No</th>
								<th>Discipline</th>
								<th>Module</th>
								<th>Type Of Module</th>
								<th>Joint No</th>
								<th>Revision No</th>
								<th>Welder Ref RH<br />(SMOE Code)</th>
								<!-- <th>Welder Ref RH<br/>(Client Code)</th> -->
								<th>Welder Ref FC<br />(SMOE Code)</th>
								<!-- <th>Welder Ref FC<br/>(Client Code)</th> -->
								<th>Weld Length</th>
								<!-- <th>Length Affected</th> -->
								<th>Tested Length</th>
								<th>Rejected Length</th>
								<th>NDT Evidence</th>
								<th>Rate %</th>
							</tr>
							<?php
							$total_joint = 0;
							$data_length = array();
							$data_length_aff = array();
							$data_tested_length = array();
							$data_tested_length_rejected = array();
							foreach ($loop_ut as $key => $value) {
								$total_joint++;

							?>
								<?php

								// if (isset($value["welder_ref_rh"])) {
								// 	$weld_rh = $value["welder_ref_rh"];
								// } else {
								// 	$weld_rh = null;
								// }

								// if (isset($value["welder_ref_fc"])) {
								// 	$weld_fc = $value["welder_ref_fc"];
								// } else {
								// 	$weld_fc = null;
								// }

								// if (isset($weld_rh)) {
								// 	$welder = $weld_rh . ";" . $weld_fc;
								// } else {
								// 	$welder = $weld_fc;
								// }
								// $welder_explode = explode(";", $welder);

								// $remove_zero_welder = array_filter($welder_explode);
								// $total_welder       = count($remove_zero_welder);

                $weld_rh = $welder_ref[$value['id_visual']]["0"];
                $weld_fc = $welder_ref[$value['id_visual']]["1"];

                // ADDED BY IQBAL TOTAL WELDER

                $total_welder       = $total_welder_vis[$value['id_visual']];

								$length_divide = round($value["length_of_weld"] / $total_welder, 0);

								// ------------------------- Test Data ----------------------------- //

								if (isset($tested_length['3'][$value["id_visual"]][$value['id']])) {
									$length_divide_tested_ut = round($tested_length['3'][$value["id_visual"]][$value['id']], 0);
								} else {
									$length_divide_tested_ut = 0;
								}

								if (!isset($data_tested_length[$welder_id])) {
									$data_tested_length[$welder_id] = 0;
								}
								$data_tested_length[$welder_id] += $length_divide_tested_ut;

								// ------------------------- Test Data ----------------------------- //

								// ------------------------- Test Data Reject ----------------------------- //

								if (isset($joint_reject_ndt['3'][$welder_id][$value["id_visual"]][$value['id']]['total_length'])) {
									$length_divide_rejected_length_ut = $joint_reject_ndt['3'][$welder_id][$value["id_visual"]][$value['id']]['total_length'];
								} else {
									$length_divide_rejected_length_ut = 0;
								}

								if (!isset($data_tested_length_rejected[$welder_id])) {
									$data_tested_length_rejected[$welder_id] = 0;
								}
								$data_tested_length_rejected[$welder_id] += $length_divide_rejected_length_ut;

								// ------------------------- Test Data Reject ----------------------------- //

								// ------------------------- Data Length Of Weld ----------------------------- //

								if (!isset($data_length[$welder_id])) {
									$data_length[$welder_id] = 0;
								}
								$data_length[$welder_id] += $value["length_of_weld"];

								if (!isset($data_length_aff[$welder_id])) {
									$data_length_aff[$welder_id] = 0;
								}
								$data_length_aff[$welder_id] += $length_divide;

								// ------------------------- Data Length Of Weld ----------------------------- //

								if ($length_divide_rejected_length_ut > 0 and $length_divide_tested_ut > 0) {
									$rate_data = round(($length_divide_rejected_length_ut / $length_divide_tested_ut) * 100, 2);
								} else {
									$rate_data = "0";
								}

								?>
								<tr>
									<td>
                  <?= $value["submisison_visual"] ?></td>
									<td><?= (!empty($value["report_number"]) ? $value["report_number"] : "-") ?></td>
									<td><?= $value["drawing_no"] ?></td>
									<td><?= $discipline_list_data[$temp_joint[$value["id_joint"]]["discipline"]]['discipline_name'] ?></td>
									<td><?= @$module_code[$temp_joint[$value["id_joint"]]["module"]] ?></td>
									<td><?= @$type_of_module_code[$temp_joint[$value["id_joint"]]["type_of_module"]] ?></td>
									<td><?= $temp_joint[$value["id_joint"]]['joint_no'] ?></td>
									<td><?= $value["postpone_reoffer_no"] ?></td>
									<td>
										<?php
										if (isset($weld_rh)) {
											$weld_rh_exp =  $weld_rh;
											foreach ($weld_rh_exp as $kx => $vx) {
												echo @$master_welder[$vx]['welder_code'] . "<br/>";
											}
										} else {
											echo "-";
										}
										?>
									</td>

									<td>
										<?php

										if (isset($weld_fc)) {
											$weld_fc_exp =  $weld_fc;
											foreach ($weld_fc_exp as $k => $v) {
												echo @$master_welder[$v]['welder_code'] . "<br/>";
											}
										} else {
											echo "-";
										}
										?>
									</td>
									
									<td><?= $value["length_of_weld"] ?></td>
									<!-- <td><?= round($length_divide, 2) ?></td> -->
									<td><?= round($length_divide_tested_ut, 2) ?></td>
									<td><?= round($length_divide_rejected_length_ut, 2) ?></td>
									<td>
                    <!-- <?= (isset($ndt_attach_file[3][$value['id_visual']][$value['id']]) ?  "<a href='" . base_url() . "upload/ndt/" . $ndt_attach_file[3][$value['id_visual']][$value['id']] . "' target='_blank'>" . $ndt_report_no[3][$value['id_visual']][$value['id']] . "</a>" : (isset($ndt_report_no[3][$value['id_visual']][$value['id']]) ? $ndt_report_no[3][$value['id_visual']][$value['id']] : "-")) ?> -->

                    <a href="<?= site_url('ndt_live/ndt_detail_ut/'.encrypt($ndt_detail["3"][$value['id_visual']]['uniq_id_report'])).'/'.encrypt("pdf") ?>" target="_blank">
                    <?= $ndt_detail["3"][$value['id_visual']]['report_number'] ?>
                    </a>

                </td>
									<td><?= $rate_data . "%" ?></td>

								</tr>
							<?php } ?>
							<tr>
								<td colspan='6'>
									<h5>Summary Of Ultrasonic</h5>
								</td>
								<td>
									<h5><?= $total_joint ?>Joint</h5>
								</td>
								<td> </td>
								<td> </td>
								<td> </td>
								<!-- <td> </td>
								<td> </td> -->
								<td>
									<h5><?= $data_length[$welder_id] ?>mm</h5>
								</td>
								<!-- <td><h5><?= $data_length_aff[$welder_id] ?>mm</h5></td> -->
								<td>
									<h5><?= $data_tested_length[$welder_id] ?>mm</h5>
								</td>
								<td>
									<h5><?= $data_tested_length_rejected[$welder_id] ?>mm</h5>
								</td>
								<td> </td>
								<td>
									<h5><?= ($data_tested_length[$welder_id] > 0 ? round(($data_tested_length_rejected[$welder_id] / $data_tested_length[$welder_id]) * 100, 2) : 0) ?>%</h5>
								</td>
						</table>

					</div>
				</div>
			</div>

		</div>

		<div class="col-12">

			<div class="card shadow my-3 rounded-0">
				<div class="card-header">
					<h6 class="m-0"><span class="more_rt btn btn-info"><i class="fas fa-arrow-circle-down"></i></span> Details - NDT Radiographic </h6>
				</div>

				<div class="card-body list_rt bg-white hide">
					<div class="overflow-auto">

						<table class="table">
							<tr>
								<th>Submission ID</th>
								<th>Report Number</th>
								<th>Drawing No</th>
								<th>Discipline</th>
								<th>Module</th>
								<th>Type Of Module</th>
								<th>Joint No</th>
								<th>Revision No</th>
								<th>Welder Ref RH<br />(SMOE Code)</th>
								<!-- <th>Welder Ref RH<br/>(Client Code)</th> -->
								<th>Welder Ref FC<br />(SMOE Code)</th>
								<!-- <th>Welder Ref FC<br/>(Client Code)</th> -->
								<th>Weld Length</th>
								<!-- <th>Length Affected</th> -->
								<th>Tested Length</th>
								<th>Rejected Length</th>
								<th>NDT Evidence</th>
								<th>Rate %</th>
							</tr>
							<?php
							$total_joint = 0;
							$data_length = array();
							$data_length_aff = array();
							$data_tested_length = array();
							$data_tested_length_rejected = array();
							foreach ($loop_rt as $key => $value) {
								$total_joint++;

							?>
								<?php

								// if (isset($value["welder_ref_rh"])) {
								// 	$weld_rh = $value["welder_ref_rh"];
								// } else {
								// 	$weld_rh = null;
								// }

								// if (isset($value["welder_ref_fc"])) {
								// 	$weld_fc = $value["welder_ref_fc"];
								// } else {
								// 	$weld_fc = null;
								// }

								// if (isset($weld_rh)) {
								// 	$welder = $weld_rh . ";" . $weld_fc;
								// } else {
								// 	$welder = $weld_fc;
								// }

								// $welder_explode = explode(";", $welder);
								// $remove_zero_welder       = array_filter($welder_explode);
								// $total_welder = count($remove_zero_welder);

                $weld_rh = $welder_ref[$value['id_visual']]["0"];
                $weld_fc = $welder_ref[$value['id_visual']]["1"];

                $total_welder       = $total_welder_vis[$value['id_visual']];
								$length_divide = round($value["length_of_weld"] / $total_welder, 0);

								// ------------------------- Test Data ----------------------------- //

								if (isset($tested_length['1'][$value["id_visual"]][$value['id']])) {
									// $length_divide_tested = round($tested_length['1'][$value["id_visual"]][$value['id']]/$total_welder,0);
									$length_divide_tested = round($tested_length['1'][$value["id_visual"]][$value['id']], 0);
								} else {
									$length_divide_tested = 0;
								}

								if (!isset($data_tested_length[$welder_id])) {
									$data_tested_length[$welder_id] = 0;
								}
								$data_tested_length[$welder_id] += $length_divide_tested;

								// ------------------------- Test Data ----------------------------- //

								// ------------------------- Test Data Reject ----------------------------- //

								if (isset($joint_reject_ndt['1'][$welder_id][$value["id_visual"]][$value['id']]['total_length'])) {
									$length_divide_rejected_length = $joint_reject_ndt['1'][$welder_id][$value["id_visual"]][$value['id']]['total_length'];
								} else {
									$length_divide_rejected_length = 0;
								}

								if (!isset($data_tested_length_rejected[$welder_id])) {
									$data_tested_length_rejected[$welder_id] = 0;
								}
								$data_tested_length_rejected[$welder_id] += $length_divide_rejected_length;

								// ------------------------- Test Data Reject ----------------------------- //

								// ------------------------- Data Length Of Weld ----------------------------- //

								if (!isset($data_length[$welder_id])) {
									$data_length[$welder_id] = 0;
								}
								$data_length[$welder_id] += $value["length_of_weld"];

								if (!isset($data_length_aff[$welder_id])) {
									$data_length_aff[$welder_id] = 0;
								}
								$data_length_aff[$welder_id] += $length_divide;

								// ------------------------- Data Length Of Weld ----------------------------- //

								if ($length_divide_rejected_length > 0 and $length_divide_tested > 0) {
									$rate_data = round(($length_divide_rejected_length / $length_divide_tested) * 100, 2);
								} else {
									$rate_data = "0";
								}

								?>
								<tr>
									<td><?= $value["submisison_visual"] ?></td>
									<td><?= (!empty($value["report_number"]) ? $value["report_number"] : "-") ?></td>
									<td><?= $value["drawing_no"] ?></td>
									<td><?= $discipline_list_data[$temp_joint[$value["id_joint"]]["discipline"]]['discipline_name'] ?></td>
									<td><?= @$module_code[$temp_joint[$value["id_joint"]]["module"]] ?></td>
									<td><?= @$type_of_module_code[$temp_joint[$value["id_joint"]]["type_of_module"]] ?></td>
									<td><?= $temp_joint[$value["id_joint"]]['joint_no'] ?></td>
									<td><?= $value["postpone_reoffer_no"] ?></td>
									<td>
										<?php
										if (isset($weld_rh)) {
											$weld_rh_exp =  $weld_rh;
											foreach ($weld_rh_exp as $kx => $vx) {
												echo @$master_welder[$vx]['welder_code'] . "<br/>";
											}
										} else {
											echo "-";
										}
										?>
									</td>

									<td>
										<?php

										if (isset($weld_fc)) {
											$weld_fc_exp =  explode(";", $weld_fc);
											foreach ($weld_fc_exp as $k => $v) {
												echo @$master_welder[$v]['welder_code'] . "<br/>";
											}
										} else {
											echo "-";
										}
										?>
									</td>
									
									<td><?= $value["length_of_weld"] ?></td>
									<!-- <td><?= round($length_divide, 2) ?></td> -->
									<td><?= round($length_divide_tested, 2) ?></td>
									<td><?= round($length_divide_rejected_length, 2) ?></td>
									<td>
                    <!-- <?= (isset($ndt_attach_file[1][$value['id_visual']]) ?  "<a href='" . base_url() . "upload/ndt/" . $ndt_attach_file[1][$value['id_visual']] . "' target='_blank'>" . $ndt_report_no[1][$value['id_visual']] . "</a>" : (isset($ndt_report_no[1][$value['id_visual']]) ? $ndt_report_no[1][$value['id_visual']] : "-")) ?> -->

                    <a href="<?= site_url('ndt_live/ndt_detail_ut/'.encrypt($ndt_detail["1"][$value['id_visual']]['uniq_id_report'])).'/'.encrypt("pdf") ?>" target="_blank">
                    <?= $ndt_detail["1"][$value['id_visual']]['report_number'] ?>
                    </a>

                  </td>
									<td><?= $rate_data . "%" ?></td>

								</tr>
							<?php } ?>
							<tr>
								<td colspan='6'>
									<h5>Summary Of Radiographic</h5>
								</td>
								<td>
									<h5><?= $total_joint ?>Joint</h5>
								</td>
								<td> </td>
								<td> </td>
								<td> </td>
								<!-- <td> </td>
								<td> </td> -->
								<td>
									<h5><?= $data_length[$welder_id] ?>mm</h5>
								</td>
								<!-- <td><h5><?= $data_length_aff[$welder_id] ?>mm</h5></td> -->
								<td>
									<h5><?= $data_tested_length[$welder_id] ?>mm</h5>
								</td>
								<td>
									<h5><?= $data_tested_length_rejected[$welder_id] ?>mm</h5>
								</td>
								<td> </td>
								<td>
									<h5><?= ($data_tested_length[$welder_id] > 0 ? round(($data_tested_length_rejected[$welder_id] / $data_tested_length[$welder_id]) * 100, 2) : 0) ?>%</h5>
								</td>
						</table>

					</div>
				</div>
			</div>

		</div>




		<div class="col-12">

			<div class="card shadow my-3 rounded-0">
				<div class="card-header">
					<h6 class="m-0">Details Of Summary</h6>
				</div>

				<div class="card-body bg-white">
					<div class="overflow-auto">

						<table class="table">
							<tr>
								<th>Submission ID</th>
								<th>Report Number</th>
								<th>Drawing No</th>
								<th>Discipline</th>
								<th>Module</th>
								<th>Type Of Module</th>
								<th>Joint No</th>
								<th>Revision No</th>
								<th>Welder Ref RH<br />(SMOE Code)</th>
								<!-- <th>Welder Ref RH<br/>(Client Code)</th> -->
								<th>Welder Ref FC<br />(SMOE Code)</th>
								<!-- <th>Welder Ref FC<br/>(Client Code)</th> -->
								<th>Weld Length</th>
								<!-- <th>Length Affected</th> -->
								<th>Tested Length<br />(UT+RT)</th>
								<th>Rejected Length<br />(UT+RT)</th>
								<th>Rate %<br />(UT+RT)</th>
							</tr>
							<?php
							$total_joint = 0;
							$data_length = array();
							$data_length_aff = array();
							$data_tested_length = array();
							$data_tested_length_rejected = array();
							foreach ($visual_data as $key => $value) {
								$total_joint++;

							?>
								<?php

                $weld_rh = $welder_ref[$value['id_visual']]["0"];
                $weld_fc = $welder_ref[$value['id_visual']]["1"];

								// if (isset($value["welder_ref_rh"])) {
								// 	$weld_rh = $value["welder_ref_rh"];
								// } else {
								// 	$weld_rh = null;
								// }

								// if (isset($value["welder_ref_fc"])) {
								// 	$weld_fc = $value["welder_ref_fc"];
								// } else {
								// 	$weld_fc = null;
								// }

								// if (isset($weld_rh)) {
								// 	$welder = $weld_rh . ";" . $weld_fc;
								// } else {
								// 	$welder = $weld_fc;
								// }

								// $welder_explode = explode(";", $welder);
								// $remove_zero_welder       = array_filter($welder_explode);
								// $total_welder = count($remove_zero_welder);

                $total_welder       = $total_welder_vis[$value['id_visual']];
								$length_divide = round($value["length_of_weld"] / $total_welder, 0);

								// ------------------------- Data Length Of Weld ----------------------------- //

								if (!isset($data_lengthx[$welder_id])) {
									$data_lengthx[$welder_id] = 0;
								}
								$data_lengthx[$welder_id] += $value["length_of_weld"];

								if (!isset($data_length_affx[$welder_id])) {
									$data_length_affx[$welder_id] = 0;
								}
								$data_length_affx[$welder_id] += $length_divide;

								// ------------------------- Data Length Of Weld ----------------------------- //


								// ------------------------- Test Data UT ----------------------------- //

								if (isset($tested_length['3'][$value["id_visual"]][$value['id']])) {
									$length_divide_tested_ut = round($tested_length['3'][$value["id_visual"]][$value['id']], 0);
								} else {
									$length_divide_tested_ut = 0;
								}

								if (!isset($data_tested_length_ut[$welder_id])) {
									$data_tested_length_ut[$welder_id] = 0;
								}
								$data_tested_length_ut[$welder_id] += $length_divide_tested_ut;

								// ------------------------- Test Data UT ----------------------------- //

								// ------------------------- Test Data Reject UT ----------------------------- //

								if (isset($joint_reject_ndt['3'][$welder_id][$value["id_visual"]][$value['id']]['total_length'])) {
									$length_divide_rejected_length_ut = $joint_reject_ndt['3'][$welder_id][$value["id_visual"]][$value['id']]['total_length'];
								} else {
									$length_divide_rejected_length_ut = 0;
								}

								if (!isset($data_tested_length_rejected_ut[$welder_id])) {
									$data_tested_length_rejected_ut[$welder_id] = 0;
								}
								$data_tested_length_rejected_ut[$welder_id] += $length_divide_rejected_length_ut;

								// ------------------------- Test Data Reject UT----------------------------- //


								// ------------------------- Test Data RT----------------------------- //

								if (isset($tested_length['1'][$value["id_visual"]][$value['id']])) {
									//$length_divide_tested_rt = round($tested_length['1'][$value["id_visual"]][$value['id']]/$total_welder,0);
									$length_divide_tested_rt = round($tested_length['1'][$value["id_visual"]][$value['id']], 0);
								} else {
									$length_divide_tested_rt = 0;
								}

								if (!isset($data_tested_length_rt[$welder_id])) {
									$data_tested_length_rt[$welder_id] = 0;
								}
								$data_tested_length_rt[$welder_id] += $length_divide_tested_rt;

								// ------------------------- Test Data RT ----------------------------- //

								// ------------------------- Test Data Reject RT ----------------------------- //

								if (isset($joint_reject_ndt['1'][$welder_id][$value["id_visual"]][$value['id']]['total_length'])) {
									$length_divide_rejected_length_rt = $joint_reject_ndt['1'][$welder_id][$value["id_visual"]][$value['id']]['total_length'];
								} else {
									$length_divide_rejected_length_rt = 0;
								}

								if (!isset($data_tested_length_rejected_rt[$welder_id])) {
									$data_tested_length_rejected_rt[$welder_id] = 0;
								}
								$data_tested_length_rejected_rt[$welder_id] += $length_divide_rejected_length_rt;

								// ------------------------- Test Data Reject RT ----------------------------- //

								$length_divide_tested_all = $length_divide_tested_ut + $length_divide_tested_rt;
								$length_divide_rejected_length_all = $length_divide_rejected_length_ut + $length_divide_rejected_length_rt;

								$overall_tested_length = $data_tested_length_ut[$welder_id] + $data_tested_length_rt[$welder_id];
								$overall_reject_length = $data_tested_length_rejected_ut[$welder_id] + $data_tested_length_rejected_rt[$welder_id];

								?>
								<tr>
									<td><?= $value["submisison_visual"] ?></td>
									<td><?= (!empty($value["report_number"]) ? $value["report_number"] : "-") ?></td>
									<td><?= $value["drawing_no"] ?></td>
									<td><?= $discipline_list_data[$temp_joint[$value["id_joint"]]["discipline"]]['discipline_name'] ?></td>
									<td><?= @$module_code[$temp_joint[$value["id_joint"]]["module"]] ?></td>
									<td><?= @$type_of_module_code[$temp_joint[$value["id_joint"]]["type_of_module"]] ?></td>
									<td><?= $temp_joint[$value["id_joint"]]['joint_no'] ?></td>
									<td><?= $value["postpone_reoffer_no"] ?></td>
									<td>
										<?php
										if (isset($weld_rh)) {
											$weld_rh_exp =  $weld_rh;
											foreach ($weld_rh_exp as $kx => $vx) {
												echo @$master_welder[$vx]['welder_code'] . "<br/>";
											}
										} else {
											echo "-";
										}
										?>
									</td>

									<td>
										<?php

										if (isset($weld_fc)) {
											$weld_fc_exp =  $weld_fc;
											foreach ($weld_fc_exp as $k => $v) {
												echo @$master_welder[$v]['welder_code'] . "<br/>";
											}
										} else {
											echo "-";
										}
										?>
									</td>

									<td><?= $value["length_of_weld"] ?></td>
									<!-- <td><?= round($length_divide, 2) ?></td> -->
									<td><?= round($length_divide_tested_all, 2) ?></td>
									<td><?= round($length_divide_rejected_length_all, 2) ?></td>
									<td><?= ($length_divide_tested_all > 0 ? round(($length_divide_rejected_length_all / $length_divide_tested_all) * 100, 2) : 0) ?>%</td>

								</tr>
							<?php } ?>
							<tr>
								<td colspan='6'>
									<h5>Summary Of Calculation</h5>
								</td>
								<td>
									<h5><?= $total_joint ?>Joint</h5>
								</td>
								<td> </td>
								<td> </td>
								<td> </td>
								<!-- <td> </td>
								<td> </td> -->

								<td>
									<h5><?= $data_lengthx[$welder_id] ?>mm</h5>
								</td>
								<!-- <td><h5><?= $data_length_affx[$welder_id] ?>mm</h5></td> -->
								<td>
									<h5> <?= round($overall_tested_length, 2) ?> mm</h5>
								</td>
								<td>
									<h5> <?= round($overall_reject_length, 2) ?> mm</h5>
								</td>
								<td>
									<h5> <?= ($overall_tested_length > 0 ? round(($overall_reject_length / $overall_tested_length) * 100, 2) : 0) ?>%</h5>
								</td>
						</table>

						<?php $rate_chart = ($overall_tested_length > 0 ? round(($overall_reject_length / $overall_tested_length) * 100, 2) : 0) . "%"; ?>
						<?php $rejection_length_chart = $overall_reject_length; ?>
						<?php $tested_length_chart = $overall_tested_length; ?>
					</div>
				</div>
			</div>

		</div>

		<div class="col-12">

			<div class="card shadow my-3 rounded-0">
				<div class="card-header">
					<h6 class="m-0">NDT Rejection Data</h6>
				</div>

				<div class="card-body bg-white">
					<div class="overflow-auto">
						<table class="table">
							<tr>
								<?php foreach ($master_ctq as $key => $value) { ?>
									<th><?= $value['ctq_initial'] ?><br />(mm)</th>
								<?php } ?>
								<th>
									Total<br />(mm)
								</th>
							</tr>
							<tr>
								<?php foreach ($master_ctq as $key => $value) { ?>
									<?php
									if (isset($ctq_length_data[$welder_id][$value['id']]["total_length"])) {
										@$total_sumx += $ctq_length_data[$welder_id][$value['id']]["total_length"];
									}
									?>
									<td><?= (isset($ctq_length_data[$welder_id][$value['id']]["total_length"]) ? @$ctq_length_data[$welder_id][$value['id']]["total_length"] : 0) ?></td>
								<?php } ?>
								<td><?= $total_sumx ?></td>
							</tr>
						</table>

					</div>
				</div>
			</div>

		</div>

	</div>
</div>
</div>
<script>
	$('.dataTable').DataTable({
		"paging": false,

		"info": false
	});

	$(".select2").select2({
		allowClear: true,
		tokenSeparators: [', ', ' '],
	})
</script>
<script>
	Highcharts.setOptions({
		colors: Highcharts.map(Highcharts.getOptions().colors, function(color) {
			return {
				radialGradient: {
					cx: 0.5,
					cy: 0.3,
					r: 0.7
				},
				stops: [
					[0, color],
					[1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
				]
			};
		})
	});

	// Build the chart
	Highcharts.chart('weld_rate', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie',
			height: 280,
		},
		title: {
			text: 'Rejection Rate <?= $rate_chart ?> '
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.y:.1f} mm</b>'
		},
		accessibility: {
			point: {
				valueSuffix: '%'
			}
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b>: {point.y:.1f} mm',
					connectorColor: 'silver'
				}
			}
		},
		series: [{
			name: 'Share',
			data: [{
					name: 'Tested Length',
					y: <?= round($tested_length_chart, 2) ?>
				},
				{
					name: 'Rejection Length',
					y: <?= round($rejection_length_chart, 2) ?>
				},
			]
		}]
	});
</script>

<script>
	Highcharts.chart('ndt_rejection', {
		chart: {
			type: 'column',
			height: 280,
		},
		title: {
			text: 'Defect Break Down'
		},
		xAxis: {
			categories: [
				<?php foreach ($master_ctq as $key => $value) { ?> "<?= $value['ctq_initial'] ?>",
				<?php } ?>
			],
			crosshair: true
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Defect Length (mm)'
			}
		},
		tooltip: {
			headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
			pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
				'<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
			footerFormat: '</table>',
			shared: true,
			useHTML: true
		},
		plotOptions: {
			column: {
				pointPadding: 0.2,
				borderWidth: 0
			}
		},
		exporting: {
			fallbackToExportServer: false
		},
		series: [{
			showInLegend: false,
			data: [
				<?php foreach ($master_ctq as $key => $value) { ?>
					<?= (isset($ctq_length_data[$welder_id][$value['id']]["total_length"]) ? @$ctq_length_data[$welder_id][$value['id']]["total_length"] : 0) ?>,
				<?php } ?>
			]
		}]
	});
</script>