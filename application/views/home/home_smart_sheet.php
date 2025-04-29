<?php
$dummy_number = 983545;
?>
<style>
	.font-7 {
		font-size: 0.7rem;
	}

	button.font-7 {
		padding: 0.1rem 0.2rem;
	}

	h1.num_fabrication_high {
		text-align: center;
		font-size: 3rem;
		color: #535c68;
		font-weight: bold;
		white-space: nowrap;
	}

	.num_fabrication_subtitle {
		width: 100%;
		text-align: center;
		color: #535c68;
		font-size: 9px;
	}

	.table td,
	.table th {
		padding: 0.25rem;
	}

	.table thead {
		position: sticky;
		top: 0;
	}

	.bg-success-dashboard {
		background-color: #20bf6b;
	}

	.num_fabrication_witness {
		background-color: #2bcbba;
		color: white;
		font-weight: bold;
		padding: 2px;
	}

	.num_fabrication_activity {
		background-color: #4b7bec;
		color: white;
		font-weight: bold;
		padding: 2px;
	}

	.num_fabrication_ndt {
		font-weight: bold;
		padding: 2px;
		border: 1px solid #778ca3;
	}

	.nav-pills .nav-link {
		color: #000;
		border-bottom: 2px solid #007bff;
		border-radius: 0px;
		min-width: 200px;
		text-align: center;
		box-shadow: inset 0 0 0 0 #007bff;
		-webkit-transition: ease-out 0.2s;
		-moz-transition: ease-out 0.2s;
		transition: ease-out 0.2s;
	}

	.nav-pills .nav-link:hover {
		color: #fff;
		box-shadow: inset 0 -100px 0 0 #007bff;
	}

	.nav-pills .nav-link.active,
	.nav-pills .show>.nav-link {
		color: #fff;
		background: #007bff;
		border-bottom: 2px solid #007bff;
		border-radius: 0px;
	}
</style>
<div id="content" class="container-fluid">

	<div class="bg-white p-3 shadow-sm">
		<h4 class="text-center font-weight-bold mt-0 mb-3">Production & Quality Dashboard</h4>
		<?= $tabmenu ?>
	</div>
	<br />

	<div class="row">
		<div class="col-md-12">

			<div class="row mt-30">
				<div class="col-md-12">
					<div class="card border-0 shadow-sm">
						<div class="row bg-dark m-0">
							<div class="col-md-auto p-0">
								<h6 class="card-header text-left text-white rounded-0" style='font-size:12px !important;'>Overall</h6>
							</div>
							<div class="col-md text-right py-2 px-3">
								<select class="border-0 my-1 mx-2" onchange="change_week_base(this)">
									<option value="0" <?= ($week_based == '0' ? 'selected' : '') ?>>by NDT Testing Date</option>
									<option value="1" <?= ($week_based == '1' ? 'selected' : '') ?>>by Welding Date</option>
								</select>
								<select class="border-0 my-1 mx-2" onchange="change_tom_base(this)">
									<option value="0" <?= ($type_of_module == '0' ? 'selected' : '') ?>>Overall</option>
									<option value="1" <?= ($type_of_module == '1' ? 'selected' : '') ?>>Top Side</option>
									<option value="2" <?= ($type_of_module == '2' ? 'selected' : '') ?>>Jacket</option>
								</select>
							</div>
						</div>
						<div class="card-body bg-white text-center p-2">
							<div class="chart-wrapper mx-auto" style="height:30vh; position:relative">
								<div id="container_row_2_1" style="height: 100%; width: 100%;">
									<div class="text-center loading mt-4">
										<div class="spinner-border" role="status"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row mt-30">
				<div class="col-md-12">
					<div class="card border-0 shadow-sm">
						<h6 class="card-header text-left bg-dark text-white rounded-0" style='font-size:12px !important;'>Rejection Rate - Analysis per Deck</h6>
						<div class="card-body bg-white text-center p-2">
							<div class="chart-wrapper mx-auto" style="height:30vh; position:relative">
								<div id="container_row_2_2" style="height: 100%; width: 100%;">
									<div class="text-center loading mt-4">
										<div class="spinner-border" role="status"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row mt-30">
				<div class="col-md-12">
					<div class="card border-0 shadow-sm">
						<div class="row bg-dark m-0">
							<div class="col-md-auto p-0">
								<h6 class="card-header text-left text-white rounded-0" style='font-size:12px !important;'>Rejection Rate - Based On Class Code</h6>
							</div>

							<div class="col-md text-right py-2 px-3">
								<select class="border-0 my-1 mx-2" onchange="change_week_base(this)">
									<option value="0" <?= ($week_based == '0' ? 'selected' : '') ?>>by NDT Testing Date</option>
									<option value="1" <?= ($week_based == '1' ? 'selected' : '') ?>>by Welding Date</option>
								</select>
								<select class="border-0 my-1 mx-2" onchange="change_class_base(this)">
									<option value="1" <?= ($class_code == '1' ? 'selected' : '') ?>>Class I</option>
									<option value="2" <?= ($class_code == '2' ? 'selected' : '') ?>>Class II</option>
									<option value="3" <?= ($class_code == '3' ? 'selected' : '') ?>>Class III</option>
								</select>
							</div>
						</div>
						<div class="card-body bg-white text-center p-2">
							<div class="chart-wrapper mx-auto" style="height:30vh; position:relative">
								<div id="container_row_2_3" style="height: 100%; width: 100%;">
									<div class="text-center loading mt-4">
										<div class="spinner-border" role="status"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row mt-30">

				<div class="col-md-2">
					<div class="card border-0 shadow-sm">
						<h6 class="card-header text-left bg-dark text-white rounded-0" style='font-size:12px !important;'>All Deck - Cumulative to Date</h6>
						<div class="card-body bg-white text-center p-2">
							<div class="chart-wrapper mx-auto" style="position:relative" id="container_alldeck_cum">
								<table class="w-100 text-left table-striped">
									<tr>
										<td>Weld Length (mm)</td>
										<td><b><?= array_sum($array_deck_length_sum) + 0 ?><b></td>
									</tr>
									<tr>
										<td>Length Tested (mm)</td>
										<td><b><?= array_sum($array_deck_tested_length_sum) + 0 ?><b></td>
									</tr>
									<tr>
										<td>Weld Defect Length (mm)</td>
										<td><b><?= array_sum($array_deck_defect_length_sum) + 0 ?><b></td>
									</tr>
									<tr>
										<td>Defect %</td>
										<td><b><?= round(array_sum($array_deck_defect_length_sum) / array_sum($array_deck_tested_length_sum) * 100, 2) ?><b></td>
									</tr>
									<tr>
										<td>Successful Rate</td>
										<td><b><?= 100 - round(array_sum($array_deck_defect_length_sum) / array_sum($array_deck_tested_length_sum) * 100, 2) ?><b></td>
									</tr>
									<tr>
										<td>NDT % Completed</td>
										<td><b><?= round(array_sum($array_deck_tested_length_sum) / array_sum($array_deck_length_sum) * 100, 2) ?><b></td>
									</tr>
									<tr>
										<td>No of Joint Made</td>
										<td><b><?= array_sum($array_deck_total_joint_made) + 0 ?><b></td>
									</tr>
									<tr>
										<td>No of Joint Tested</td>
										<td><b><?= array_sum($array_deck_total_joint_tested) + 0 ?><b></td>
									</tr>
									<tr>
										<td>Total Joint Repair</td>
										<td><b><?= $total_data_repaired ?><b></td>
									</tr>
									<tr>
										<td>% of Joint Tested</td>
										<td><b><?= round(array_sum($array_deck_total_joint_tested) / array_sum($array_deck_total_joint_made) * 100, 2) ?><b></td>
									</tr>
									<?php foreach ($calculate_all_defect_by_deck as $key => $valuex) { ?>
										<tr>
											<td>No of <?= $key ?></td>
											<td><b><?= array_sum($valuex) + 0 ?><b></td>
										</tr>
									<?php } ?>
									<tr>
										<td>RFI Time Min</td>
										<?php
										$min_rfi = 1;
										if (min($array_deck_total_days_rfi_min) > 0) {
											$min_rfi = min($array_deck_total_days_rfi_min);
										}
										?>
										<td><b><?= $min_rfi + 0 ?><b></td>
									</tr>
									<tr>
										<td>RFI Time Max</td>
										<td><b><?= max($array_deck_total_days_rfi_max) + 0 ?><b></td>
									</tr>
									<tr>
										<td>RFI Time Avg</td>
										<td><b><?= ceil(array_sum($rfi_average_time_deck) / count($rfi_average_time_deck)) + 0 ?><b></td>
									</tr>
									<tr>
										<td>Weld to NDT Time Max</td>
										<td><b><?= max($array_deck_total_days_ndt_max) + 0 ?><b></td>
									</tr>
									<tr>
										<td>Weld to NDT Time Avg</td>
										<td><b><?= ceil(array_sum($ndt_average_time_deck) / count($ndt_average_time_deck)) + 0 ?><b></td>
									</tr>
									<tr>
										<td><b><i>* Data Calculation By NDT Joint</i></b></td>
										<td></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>


				<div class="col-md-10">
					<div class="row">
						<div class="col-md-12">
							<div class="card border-0 shadow-sm">
								<div class="row bg-dark m-0">
									<div class="col-md-auto p-0">
										<h6 class="card-header text-left text-white rounded-0" style='font-size:12px !important;'>Weekly NDT Rejection Rate for All Deck</h6>
									</div>
									<div class="col-md text-right py-2 px-3">
										<select class="border-0 my-1 mx-2" onchange="change_week_base(this)">
											<option value="0" <?= ($week_based == '0' ? 'selected' : '') ?>>by NDT Testing Date</option>
											<option value="1" <?= ($week_based == '1' ? 'selected' : '') ?>>by Welding Date</option>
										</select>
										<select class="border-0 my-1 mx-2" onchange="change_ndttype_base(this)">
											<option value="3" <?= ($d_ndt_type == '3' ? 'selected' : '') ?>>by NDT UT</option>
											<option value="1" <?= ($d_ndt_type == '1' ? 'selected' : '') ?>>by NDT RT</option>
											<?php if (in_array($main_source[0]['project'], [19,21])) { ?>
												<option value="13" <?= ($d_ndt_type == '13' ? 'selected' : '') ?>>by NDT UTCC</option>
												<option value="15" <?= ($d_ndt_type == '15' ? 'selected' : '') ?>>by NDT RTCC</option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="card-body bg-white text-center p-2">
									<div class="chart-wrapper mx-auto" style="height:30vh; position:relative">
										<div id="container_weekly_reject_rate_all_deck" style="height: 100%; width: 100%;">
											<div class="text-center loading mt-4">
												<div class="spinner-border" role="status"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

			<!-- <div class="row mt-30">
				<div class="col-md-12">
					<div class="card border-0 shadow-sm">

						<div class="row bg-dark m-0">
							<div class="col-md-auto p-0">
								<h6 class="card-header text-left text-white rounded-0" style='font-size:12px !important;'>CONWEEKLY INSPECTION PROGRESS "OVERALL"</h6>
							</div>

							<div class="col-md text-right py-2 px-3">
								<select class="border-0 my-1 mx-2" name="discipline_kpi" onchange="load_all_qc_kpi()">
									<?php foreach ($discipline as $key => $value) : ?>
										<option value="<?= $value['id'] ?>" <?= $value['id'] == 2 ? 'selected' : '' ?>><?= $value['discipline_name'] ?></option>
									<?php endforeach; ?>
								</select>

								<select class="border-0 my-1 mx-2 week_kpi_select" name="week_kpi" onchange="load_all_qc_kpi()">
									<option value="">Overall</option>
									<?php foreach ($week_list_kpi as $key => $value) : ?>
										<option value="<?= $key ?>">Week - <?= $value ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>


						<div class="card-body bg-white text-center p-2">
							<div class="row">
								<div class="col-md-12 text-center">
									<ul class="nav nav-pills justify-content-center font-weight-bold" id="myTab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="by_joint-tab" data-toggle="tab" href="#by_joint" role="tab" aria-controls="by_joint" aria-selected="true">BY JOINT</a>
										</li>

										<li class="nav-item">
											<a class="nav-link" id="by_length-tab" data-toggle="tab" href="#by_length" role="tab" aria-controls="by_length" aria-selected="true">BY LENGTH</a>

										</li>
									</ul>
								</div>
								<div class="col-md-12">
									<div class="tab-content" id="myTabContent">
										<div class="tab-pane fade show active" id="by_joint" role="tabpanel" aria-labelledby="by_joint-tab">
											<div class="row mt-3">
												<div class="col-md-12 text-left">
													<?php
													$period =  date('W');
													?>
													<h6><strong>By Joint <span class="week_kpi_text">Overall</span></strong></h6>
												</div>
												<div class="col-md-12 mt-2">
													<div id="kpi_by_joint_special"></div>
												</div>
												<div class="col-md-12 mt-2">
													<div id="kpi_by_joint_primary"></div>
												</div>
												<div class="col-md-12">
													<div id="kpi_by_joint_secondary"></div>
												</div>
												<div class="col-md-12">
													<div id="kpi_by_joint_second_to_primer"></div>
												</div>

											</div>
										</div>

										<div class="tab-pane fade " id="by_length" role="tabpanel" aria-labelledby="by_length-tab">
											<div class="row mt-3">
												<div class="col-md-12 text-left">
													<h6><strong>By Length <span class="week_kpi_text">Overall</span></strong></h6>
												</div>
												<div class="col-md-12 mt-2">
													<div id="kpi_by_length_special"></div>
												</div>
												<div class="col-md-12 mt-2">
													<div id="kpi_by_length_primary"></div>
												</div>
												<div class="col-md-12">
													<div id="kpi_by_length_secondary"></div>
												</div>
												<div class="col-md-12">
													<div id="kpi_by_length_second_to_primer"></div>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>

						</div>
					</div>
				</div>

			</div> -->



		</div>
	</div>

</div>
</div>

<script>
	$(document).ready(function() {

		$("#container_weekly_reject_rate_all_deck").closest(".chart-wrapper").css("height", $("#container_alldeck_cum").outerHeight() + "px")
		$("#container_row_2_1").closest(".chart-wrapper").css("height", $("#container_alldeck_cum").outerHeight() + "px")
		$("#container_row_2_2").closest(".chart-wrapper").css("height", $("#container_alldeck_cum").outerHeight() + "px")
		$("#container_row_2_3").closest(".chart-wrapper").css("height", $("#container_alldeck_cum").outerHeight() + "px")

		Highcharts.chart('container_weekly_reject_rate_all_deck', {
			chart: {
				scrollablePlotArea: {
					minWidth: <?= count($week_list) * 75 ?>,
					scrollPositionX: 1
				},
				marginBottom: 50,
			},
			colors: ['#26de81', '#45aaf2', '#778ca3', '#fed330', '#a55eea'],
			title: {
				text: ''
			},
			subtitle: {
				text: ''
			},
			credits: {
				enabled: false,
			},
			legend: {
				layout: 'horizontal',
				align: 'center',
				verticalAlign: 'top',
			},
			plotOptions: {
				series: {
					marker: {
						enabled: false
					},
					dataLabels: {
						enabled: true,
					},
				}
			},
			xAxis: {
				categories: [
					<?php foreach ($week_list as $week) : ?> "<?= $week ?>",
					<?php endforeach ?>
				],
			},
			yAxis: {
				title: {
					enabled: false
				}
			},
			series: [{
					name: "Length Welded (mm)",
					data: [
						<?php foreach ($week_list as $week) : ?>
							<?= $data_cum_all_deck[$week]['weld_length'] + 0 ?>,
						<?php endforeach ?>
					],
				},
				{
					name: "Length Tested (mm)",
					data: [
						<?php foreach ($week_list as $week) : ?>
							<?= $data_cum_all_deck[$week]['tested_length'] + 0 ?>,
						<?php endforeach ?>
					],
				},
				{
					name: "% Tested",
					data: [
						<?php foreach ($week_list as $week) : ?>
							<?= (is_nan($data_cum_all_deck[$week]['tested_length'] / $data_cum_all_deck[$week]['weld_length']) ? 0 : round(($data_cum_all_deck[$week]['tested_length'] / $data_cum_all_deck[$week]['weld_length']) * 100, 2)) ?>,
						<?php endforeach ?>
					],
					dataLabels: {
						enabled: true,
						format: '{point.y}%'
					},
				},
				{
					name: "Defect Length (mm)",
					data: [
						<?php foreach ($week_list as $week) : ?>
							<?= $data_cum_all_deck[$week]['defect_length'] + 0 ?>,
						<?php endforeach ?>
					],
				},
				{
					name: "% Weekly Rejection Rate",
					data: [
						<?php foreach ($week_list as $week) : ?>
							<?= (is_nan($data_cum_all_deck[$week]['defect_length'] / $data_cum_all_deck[$week]['tested_length']) ? 0 : round($data_cum_all_deck[$week]['defect_length'] / $data_cum_all_deck[$week]['tested_length'] * 100, 2)) ?>,
						<?php endforeach ?>
					],
					dataLabels: {
						enabled: true,
						format: '{point.y}%'
					},
				},
			],
		}, function(chart) {});



		Highcharts.chart('container_row_2_1', {
			chart: {
				scrollablePlotArea: {
					minWidth: <?= count($week_list) * 75 ?>,
					scrollPositionX: 1,
				},
				height: $("#container_alldeck_cum").outerHeight() + "px",
				marginBottom: 50,
			},
			colors: ['#26de81', '#2bcbba', '#45aaf2', '#4b7bec', '#a55eea', '#d1d8e0', '#778ca3', '#fed330', '#fd9644', '#fc5c65', '#20bf6b', '#0fb9b1'],
			title: {
				text: ''
			},
			subtitle: {
				text: ''
			},
			credits: {
				enabled: false,
			},
			legend: {
				layout: 'horizontal',
				align: 'center',
				verticalAlign: 'top',
			},
			plotOptions: {
				line: {
					marker: {
						enabled: false
					},
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: true,
						format: '{point.y}'
					},
					showInLegend: true
				},
			},
			xAxis: {
				categories: [
					<?php foreach ($week_list as $key => $value) { ?> "<?= $value ?>",
					<?php } ?>
				],
			},
			yAxis: {
				title: {
					enabled: false
				},
			},
			series: [

				{
					name: "Length Welded (mm)",
					data: [
						<?php foreach ($week_list as $key => $value) { ?>
							<?= (isset($array_week_length_sum[$value]) ? $array_week_length_sum[$value] : 0) ?>,
						<?php } ?>
					],
				},
				{
					name: "Length Tested (mm)",
					data: [
						<?php foreach ($week_list as $key => $value) { ?>
							<?= (isset($array_week_tested_length_sum[$value]) ? $array_week_tested_length_sum[$value] : 0) ?>,
						<?php } ?>
					],
				},
				{
					name: "% Tested",
					data: [
						<?php foreach ($week_list as $key => $value) { ?>
							<?= (isset($percent_week[$value]) ? ($percent_week[$value]  < 100 ? $percent_week[$value]  : 100) : 0) ?>,
						<?php } ?>
					],
					dataLabels: {
						enabled: true,
						format: '{point.y}%'
					},
				},
				{
					name: "Defect Length (mm)",
					data: [
						<?php foreach ($week_list as $key => $value) { ?>
							<?= (isset($array_week_defect_length_sum[$value]) ? $array_week_defect_length_sum[$value] : 0) ?>,
						<?php } ?>
					],
				},
				{
					name: "% Weekly Rejection Rate",
					data: [
						<?php foreach ($week_list as $key => $value) { ?>
							<?= (isset($percent_rate_week[$value]) && $percent_rate_week[$value] > 0 ? $percent_rate_week[$value] : 0) ?>,
						<?php } ?>
					],
					dataLabels: {
						enabled: true,
						format: '{point.y}%'
					},
				},

				{
					name: "Cumulative Length Welded (mm)",
					data: [
						<?php foreach ($week_list as $key => $value) {
							$key_bf = $key - 1 ?>
							<?= 0 + (isset($array_week_com_length_sum[$value]) ? $array_week_com_length_sum[$value] : $array_week_com_length_sum[$week_list[$key_bf]]) ?>,
						<?php } ?>
					],
				},
				{
					name: "Cumulative Length Tested (mm)",
					data: [
						<?php foreach ($week_list as $key => $value) {
							$key_bf = $key - 1; ?>
							<?= 0 + (isset($array_week_tested_com_length_sum[$value]) ? $array_week_tested_com_length_sum[$value] : $array_week_tested_com_length_sum[$week_list[$key_bf]]) ?>,
						<?php } ?>
					],
				},
				{
					name: "Cumulative Defect Length (mm)",
					data: [
						<?php foreach ($week_list as $key => $value) {
							$key_bf = $key - 1; ?>
							<?= 0 + (isset($array_week_defect_com_length_sum[$value]) ? $array_week_defect_com_length_sum[$value] : $array_week_defect_com_length_sum[$week_list[$key_bf]]) ?>,
						<?php } ?>
					],
				},
				{
					name: "% Tested Cumulative",
					data: [
						<?php foreach ($week_list as $key => $value) {
							$key_bf = $key - 1; ?>
							<?= 0 + (isset($percent_tested_comulative[$value]) ? ($percent_tested_comulative[$value] < 100 ? $percent_tested_comulative[$value] : 100) : $percent_tested_comulative[$week_list[$key_bf]]) ?>,
						<?php } ?>
					],
					dataLabels: {
						enabled: true,
						format: '{point.y}%'
					},
				},
				{
					name: "% Rejection Rate Cumulative",
					data: [
						<?php foreach ($week_list as $key => $value) {
							$key_bf = $key - 1; ?>
							<?= 0 + (isset($percent_defect_comulative[$value]) && $percent_defect_comulative[$value] > 0 ? $percent_defect_comulative[$value] : $percent_defect_comulative[$week_list[$key_bf]]) ?>,
						<?php } ?>
					],
					dataLabels: {
						enabled: true,
						format: '{point.y}%'
					},
				},
				{
					name: "NDT Average Time (Days)",
					data: [
						<?php foreach ($week_list as $key => $value) { ?>
							<?= 0 + (isset($ndt_average_time[$value]) ? $ndt_average_time[$value] : 0) ?>,
						<?php } ?>
					],
				},
				{
					name: "Cumulative NDT Average Time (Days)",
					data: [
						<?php foreach ($week_list as $key => $value) {
							$key_bf = $key - 1; ?>
							<?= 0 + (isset($ndt_average_time_all[$value]) ? $ndt_average_time_all[$value] : $ndt_average_time_all[$week_list[$key_bf]]) ?>,
						<?php } ?>
					],
				},
			],
		});

		Highcharts.chart('container_row_2_2', {
			chart: {
				height: $("#container_alldeck_cum").outerHeight() + "px",
			},
			colors: ['#26de81', '#2bcbba', '#45aaf2', '#4b7bec', '#a55eea', '#d1d8e0', '#778ca3', '#fed330', '#fd9644', '#fc5c65', '#20bf6b', '#0fb9b1'],
			title: {
				text: ''
			},
			subtitle: {
				text: ''
			},
			credits: {
				enabled: false,
			},
			legend: {
				layout: 'horizontal',
				align: 'center',
				verticalAlign: 'top',
			},
			plotOptions: {
				series: {
					marker: {
						enabled: false
					},
					dataLabels: {
						enabled: true,
					},
				}
			},
			xAxis: {
				categories: [
					<?php foreach ($unique_deck as $key => $value) { ?> "<?= @$array_deck_name[$value['deck_elevation']] ?>",
					<?php } ?>
				],
			},
			yAxis: {
				title: {
					enabled: false
				}
			},
			series: [

				{
					name: "Length Welded (mm)",
					data: [
						<?php foreach ($unique_deck as $key => $value) { ?>
							<?= (isset($array_deck_length_sum[$value['deck_elevation']]) ? $array_deck_length_sum[$value['deck_elevation']] : 0) ?>,
						<?php } ?>
					],
				},
				{
					name: "Length Tested (mm)",
					data: [
						<?php foreach ($unique_deck as $key => $value) { ?>
							<?= (isset($array_deck_tested_length_sum[$value['deck_elevation']]) ? $array_deck_tested_length_sum[$value['deck_elevation']] : 0) ?>,
						<?php } ?>
					],
				},
				{
					name: "Weld Defect Length (mm)",
					data: [
						<?php foreach ($unique_deck as $key => $value) { ?>
							<?= (isset($array_deck_defect_length_sum[$value['deck_elevation']]) ? $array_deck_defect_length_sum[$value['deck_elevation']] : 0) ?>,
						<?php } ?>
					],
				},
				{
					name: "Defect (%)",
					data: [
						<?php foreach ($unique_deck as $key => $value) { ?>
							<?= (isset($percent_defect_deck[$value['deck_elevation']]) ? $percent_defect_deck[$value['deck_elevation']] : 0) ?>,
						<?php } ?>
					],
					dataLabels: {
						enabled: true,
						format: '{point.y}%'
					},
				},
				{
					name: "NDT (%) Completed",
					data: [
						<?php foreach ($unique_deck as $key => $value) { ?>
							<?= (isset($percent_ndt_completed_deck[$value['deck_elevation']]) ? ($percent_ndt_completed_deck[$value['deck_elevation']] > 100 ? 100 : $percent_ndt_completed_deck[$value['deck_elevation']]) : 0) ?>,
						<?php } ?>
					],
					dataLabels: {
						enabled: true,
						format: '{point.y}%'
					},
				},
				{
					name: "No of Joints Made",
					data: [
						<?php foreach ($unique_deck as $key => $value) { ?>
							<?= (isset($array_deck_total_joint_made[$value['deck_elevation']]) ? $array_deck_total_joint_made[$value['deck_elevation']] : 0) ?>,
						<?php } ?>
					],
				},
				{
					name: "No of Joints Tested",
					data: [
						<?php foreach ($unique_deck as $key => $value) { ?>
							<?= (isset($array_deck_total_joint_tested[$value['deck_elevation']]) ? $array_deck_total_joint_tested[$value['deck_elevation']] : 0) ?>,
						<?php } ?>
					],
				},
				<?php foreach ($calculate_all_defect_by_deck as $key => $valuex) { ?> {
						name: "No of " + "<?= $key ?>",
						data: [
							<?php foreach ($unique_deck as $key => $value) { ?>
								<?= (isset($valuex[$value['deck_elevation']]) ? round($valuex[$value['deck_elevation']], 2) : 0) ?>,
							<?php } ?>
						],
					},
				<?php } ?> {
					name: "Weld To NDT Time Avg ( Days )",
					data: [
						<?php foreach ($unique_deck as $key => $value) { ?>
							<?= (isset($ndt_average_time_deck[$value['deck_elevation']]) ? $ndt_average_time_deck[$value['deck_elevation']] : 0) ?>,
						<?php } ?>
					],
				},
				{
					name: "Weld To NDT Time Avg ( All Deck / Days )",
					data: [
						<?php foreach ($unique_deck as $key => $value) { ?>
							<?= (isset($ndt_average_time_all_deck[$value['deck_elevation']]) ? $ndt_average_time_all_deck[$value['deck_elevation']] : 0) ?>,
						<?php } ?>
					],
				},
			],
		}, function(chart) {

		});

		Highcharts.chart('container_row_2_3', {
			chart: {
				scrollablePlotArea: {
					minWidth: <?= count($week_list) * 75 ?>,
					scrollPositionX: 1,
				},
				height: $("#container_alldeck_cum").outerHeight() + "px",
				marginBottom: 50,
			},
			colors: ['#26de81', '#2bcbba', '#45aaf2', '#4b7bec', '#a55eea', '#d1d8e0', '#778ca3', '#fed330', '#fd9644', '#fc5c65', '#20bf6b', '#0fb9b1'],
			title: {
				text: ''
			},
			subtitle: {
				text: ''
			},
			credits: {
				enabled: false,
			},
			legend: {
				layout: 'horizontal',
				align: 'center',
				verticalAlign: 'top',
			},
			plotOptions: {
				line: {
					marker: {
						enabled: false
					},
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: true,
						format: '{point.y}'
					},
					showInLegend: true
				},
			},
			xAxis: {
				categories: [
					<?php foreach ($week_list as $key => $value) { ?> "<?= $value ?>",
					<?php } ?>
				],
			},
			yAxis: {
				title: {
					enabled: false
				},
			},
			series: [

				{
					name: "Length Welded (mm)",
					data: [
						<?php foreach ($week_list as $key => $value) { ?>
							<?= (isset($array_week_length_sum_class[$class_code][$value]) ? $array_week_length_sum_class[$class_code][$value] : 0) ?>,
						<?php } ?>
					],
				},
				{
					name: "Length Tested (mm)",
					data: [
						<?php foreach ($week_list as $key => $value) { ?>
							<?= (isset($array_week_tested_length_sum_class[$class_code][$value]) ? $array_week_tested_length_sum_class[$class_code][$value] : 0) ?>,
						<?php } ?>
					],
				},
				{
					name: "% Tested",
					data: [
						<?php foreach ($week_list as $key => $value) { ?>
							<?= (isset($percent_week_class[$class_code][$value]) ? ($percent_week_class[$class_code][$value] <= 100 ? $percent_week_class[$class_code][$value] : 100) : 0) ?>,
						<?php } ?>
					],
					dataLabels: {
						enabled: true,
						format: '{point.y}%'
					},
				},
				{
					name: "Defect Length (mm)",
					data: [
						<?php foreach ($week_list as $key => $value) { ?>
							<?= (isset($array_week_defect_length_sum_class[$class_code][$value]) ? $array_week_defect_length_sum_class[$class_code][$value] : 0) ?>,
						<?php } ?>
					],
				},
				{
					name: "% Weekly Rejection Rate",
					data: [
						<?php foreach ($week_list as $key => $value) { ?>
							<?= (isset($percent_rate_week_class[$class_code][$value]) && $percent_rate_week_class[$class_code][$value] > 0 ? $percent_rate_week_class[$class_code][$value] : 0) ?>,
						<?php } ?>
					],
					dataLabels: {
						enabled: true,
						format: '{point.y}%'
					},
				},
				{
					name: "Cumulative Length Welded (mm)",
					data: [
						<?php foreach ($week_list as $key => $value) {
							$key_1 = $key - 1;
							$key_2 = $key - 2;
							$key_3 = $key - 3;
							$key_4 = $key - 4;
							$key_5 = $key - 5;
							$key_6 = $key - 6;
							$key_7 = $key - 7;
							$key_8 = $key - 8;
							$key_9 = $key - 9;
							$key_10 = $key - 10;
						?>
							<?=
							(isset($array_week_com_length_sum_class[$class_code][$value]) ? $array_week_com_length_sum_class[$class_code][$value] : ($array_week_com_length_sum_class[$class_code][$week_list[$key_1]] > 0 ? $array_week_com_length_sum_class[$class_code][$week_list[$key_1]] : ($array_week_com_length_sum_class[$class_code][$week_list[$key_2]] > 0 ? $array_week_com_length_sum_class[$class_code][$week_list[$key_2]] : ($array_week_com_length_sum_class[$class_code][$week_list[$key_3]] > 0 ? $array_week_com_length_sum_class[$class_code][$week_list[$key_3]] : ($array_week_com_length_sum_class[$class_code][$week_list[$key_4]] > 0 ? $array_week_com_length_sum_class[$class_code][$week_list[$key_4]] : ($array_week_com_length_sum_class[$class_code][$week_list[$key_5]] > 0 ? $array_week_com_length_sum_class[$class_code][$week_list[$key_5]] : ($array_week_com_length_sum_class[$class_code][$week_list[$key_6]] > 0 ? $array_week_com_length_sum_class[$class_code][$week_list[$key_6]] : ($array_week_com_length_sum_class[$class_code][$week_list[$key_7]] > 0 ? $array_week_com_length_sum_class[$class_code][$week_list[$key_7]] : ($array_week_com_length_sum_class[$class_code][$week_list[$key_8]] > 0 ? $array_week_com_length_sum_class[$class_code][$week_list[$key_8]] : ($array_week_com_length_sum_class[$class_code][$week_list[$key_9]] > 0 ? $array_week_com_length_sum_class[$class_code][$week_list[$key_9]] : ($array_week_com_length_sum_class[$class_code][$week_list[$key_10]] > 0 ? $array_week_com_length_sum_class[$class_code][$week_list[$key_10]] : 0
																	)))))))))))
							?>,
						<?php } ?>
					],
				},
				{
					name: "Cumulative Length Tested (mm)",
					data: [
						<?php foreach ($week_list as $key => $value) {
							$key_1 = $key - 1;
							$key_2 = $key - 2;
							$key_3 = $key - 3;
							$key_4 = $key - 4;
							$key_5 = $key - 5;
							$key_6 = $key - 6;
							$key_7 = $key - 7;
							$key_8 = $key - 8;
							$key_9 = $key - 9;
							$key_10 = $key - 10;
						?>
							<?=
							(isset($array_week_tested_com_length_sum_class[$class_code][$value]) ? $array_week_tested_com_length_sum_class[$class_code][$value] : ($array_week_tested_com_length_sum_class[$class_code][$week_list[$key_1]] > 0 ? $array_week_tested_com_length_sum_class[$class_code][$week_list[$key_1]] : ($array_week_tested_com_length_sum_class[$class_code][$week_list[$key_2]] > 0 ? $array_week_tested_com_length_sum_class[$class_code][$week_list[$key_2]] : ($array_week_tested_com_length_sum_class[$class_code][$week_list[$key_3]] > 0 ? $array_week_tested_com_length_sum_class[$class_code][$week_list[$key_3]] : ($array_week_tested_com_length_sum_class[$class_code][$week_list[$key_4]] > 0 ? $array_week_tested_com_length_sum_class[$class_code][$week_list[$key_4]] : ($array_week_tested_com_length_sum_class[$class_code][$week_list[$key_5]] > 0 ? $array_week_tested_com_length_sum_class[$class_code][$week_list[$key_5]] : ($array_week_tested_com_length_sum_class[$class_code][$week_list[$key_6]] > 0 ? $array_week_tested_com_length_sum_class[$class_code][$week_list[$key_6]] : ($array_week_tested_com_length_sum_class[$class_code][$week_list[$key_7]] > 0 ? $array_week_tested_com_length_sum_class[$class_code][$week_list[$key_7]] : ($array_week_tested_com_length_sum_class[$class_code][$week_list[$key_8]] > 0 ? $array_week_tested_com_length_sum_class[$class_code][$week_list[$key_8]] : ($array_week_tested_com_length_sum_class[$class_code][$week_list[$key_9]] > 0 ? $array_week_tested_com_length_sum_class[$class_code][$week_list[$key_9]] : ($array_week_tested_com_length_sum_class[$class_code][$week_list[$key_10]] > 0 ? $array_week_tested_com_length_sum_class[$class_code][$week_list[$key_10]] : 0
																	)))))))))))
							?>,
						<?php } ?>
					],
				},
				{
					name: "Cumulative Defect Length (mm)",
					data: [
						<?php foreach ($week_list as $key => $value) {
							$key_1 = $key - 1;
							$key_2 = $key - 2;
							$key_3 = $key - 3;
							$key_4 = $key - 4;
							$key_5 = $key - 5;
							$key_6 = $key - 6;
							$key_7 = $key - 7;
							$key_8 = $key - 8;
							$key_9 = $key - 9;
							$key_10 = $key - 10;
						?>
							<?=
							(isset($array_week_defect_com_length_sum_class[$class_code][$value]) ? $array_week_defect_com_length_sum_class[$class_code][$value] : ($array_week_defect_com_length_sum_class[$class_code][$week_list[$key_1]] > 0 ? $array_week_defect_com_length_sum_class[$class_code][$week_list[$key_1]] : ($array_week_defect_com_length_sum_class[$class_code][$week_list[$key_2]] > 0 ? $array_week_defect_com_length_sum_class[$class_code][$week_list[$key_2]] : ($array_week_defect_com_length_sum_class[$class_code][$week_list[$key_3]] > 0 ? $array_week_defect_com_length_sum_class[$class_code][$week_list[$key_3]] : ($array_week_defect_com_length_sum_class[$class_code][$week_list[$key_4]] > 0 ? $array_week_defect_com_length_sum_class[$class_code][$week_list[$key_4]] : ($array_week_defect_com_length_sum_class[$class_code][$week_list[$key_5]] > 0 ? $array_week_defect_com_length_sum_class[$class_code][$week_list[$key_5]] : ($array_week_defect_com_length_sum_class[$class_code][$week_list[$key_6]] > 0 ? $array_week_defect_com_length_sum_class[$class_code][$week_list[$key_6]] : ($array_week_defect_com_length_sum_class[$class_code][$week_list[$key_7]] > 0 ? $array_week_defect_com_length_sum_class[$class_code][$week_list[$key_7]] : ($array_week_defect_com_length_sum_class[$class_code][$week_list[$key_8]] > 0 ? $array_week_defect_com_length_sum_class[$class_code][$week_list[$key_8]] : ($array_week_defect_com_length_sum_class[$class_code][$week_list[$key_9]] > 0 ? $array_week_defect_com_length_sum_class[$class_code][$week_list[$key_9]] : ($array_week_defect_com_length_sum_class[$class_code][$week_list[$key_10]] > 0 ? $array_week_defect_com_length_sum_class[$class_code][$week_list[$key_10]] : 0
																	)))))))))))
							?>,
						<?php } ?>
					],
				},
				{
					name: "% Tested Cumulative",
					data: [
						<?php foreach ($week_list as $key => $value) {
							$key_1 = $key - 1;
							$key_2 = $key - 2;
							$key_3 = $key - 3;
							$key_4 = $key - 4;
							$key_5 = $key - 5;
							$key_6 = $key - 6;
							$key_7 = $key - 7;
							$key_8 = $key - 8;
							$key_9 = $key - 9;
							$key_10 = $key - 10;
						?>
							<?=
							(isset($percent_tested_comulative_class[$class_code][$value]) ? $percent_tested_comulative_class[$class_code][$value] : ($percent_tested_comulative_class[$class_code][$week_list[$key_1]] > 0 ? $percent_tested_comulative_class[$class_code][$week_list[$key_1]] : ($percent_tested_comulative_class[$class_code][$week_list[$key_2]] > 0 ? $percent_tested_comulative_class[$class_code][$week_list[$key_2]] : ($percent_tested_comulative_class[$class_code][$week_list[$key_3]] > 0 ? $percent_tested_comulative_class[$class_code][$week_list[$key_3]] : ($percent_tested_comulative_class[$class_code][$week_list[$key_4]] > 0 ? $percent_tested_comulative_class[$class_code][$week_list[$key_4]] : ($percent_tested_comulative_class[$class_code][$week_list[$key_5]] > 0 ? $percent_tested_comulative_class[$class_code][$week_list[$key_5]] : ($percent_tested_comulative_class[$class_code][$week_list[$key_6]] > 0 ? $percent_tested_comulative_class[$class_code][$week_list[$key_6]] : ($percent_tested_comulative_class[$class_code][$week_list[$key_7]] > 0 ? $percent_tested_comulative_class[$class_code][$week_list[$key_7]] : ($percent_tested_comulative_class[$class_code][$week_list[$key_8]] > 0 ? $percent_tested_comulative_class[$class_code][$week_list[$key_8]] : ($percent_tested_comulative_class[$class_code][$week_list[$key_9]] > 0 ? $percent_tested_comulative_class[$class_code][$week_list[$key_9]] : ($percent_tested_comulative_class[$class_code][$week_list[$key_10]] > 0 ? $percent_tested_comulative_class[$class_code][$week_list[$key_10]] : 0
																	)))))))))))
							?>, <?php } ?>
					],
					dataLabels: {
						enabled: true,
						format: '{point.y}%'
					},
				},
				{
					name: "% Rejection Rate Cumulative",
					data: [
						<?php foreach ($week_list as $key => $value) {

							$key_1 = $key - 1;
							$key_2 = $key - 2;
							$key_3 = $key - 3;
							$key_4 = $key - 4;
							$key_5 = $key - 5;
							$key_6 = $key - 6;
							$key_7 = $key - 7;
							$key_8 = $key - 8;
							$key_9 = $key - 9;
							$key_10 = $key - 10;

						?>
							<?=
							(isset($percent_defect_comulative_class[$class_code][$value]) ? $percent_defect_comulative_class[$class_code][$value] : ($percent_defect_comulative_class[$class_code][$week_list[$key_1]] > 0 ? $percent_defect_comulative_class[$class_code][$week_list[$key_1]] : ($percent_defect_comulative_class[$class_code][$week_list[$key_2]] > 0 ? $percent_defect_comulative_class[$class_code][$week_list[$key_2]] : ($percent_defect_comulative_class[$class_code][$week_list[$key_3]] > 0 ? $percent_defect_comulative_class[$class_code][$week_list[$key_3]] : ($percent_defect_comulative_class[$class_code][$week_list[$key_4]] > 0 ? $percent_defect_comulative_class[$class_code][$week_list[$key_4]] : ($percent_defect_comulative_class[$class_code][$week_list[$key_5]] > 0 ? $percent_defect_comulative_class[$class_code][$week_list[$key_5]] : ($percent_defect_comulative_class[$class_code][$week_list[$key_6]] > 0 ? $percent_defect_comulative_class[$class_code][$week_list[$key_6]] : ($percent_defect_comulative_class[$class_code][$week_list[$key_7]] > 0 ? $percent_defect_comulative_class[$class_code][$week_list[$key_7]] : ($percent_defect_comulative_class[$class_code][$week_list[$key_8]] > 0 ? $percent_defect_comulative_class[$class_code][$week_list[$key_8]] : ($percent_defect_comulative_class[$class_code][$week_list[$key_9]] > 0 ? $percent_defect_comulative_class[$class_code][$week_list[$key_9]] : ($percent_defect_comulative_class[$class_code][$week_list[$key_10]] > 0 ? $percent_defect_comulative_class[$class_code][$week_list[$key_10]] : 0
																	)))))))))))
							?>, <?php } ?>
					],
					dataLabels: {
						enabled: true,
						format: '{point.y}%'
					},
				},
				{
					name: "NDT Average Time (Days)",
					data: [
						<?php foreach ($week_list as $key => $value) { ?>
							<?= (isset($ndt_average_time_class[$class_code][$value]) ? $ndt_average_time_class[$class_code][$value] : 0) ?>,
						<?php } ?>
					],
				},
				{
					name: "Cumulative NDT Average Time (Days)",
					data: [
						<?php foreach ($week_list as $key => $value) {
							$key_1 = $key - 1;
							$key_2 = $key - 2;
							$key_3 = $key - 3;
							$key_4 = $key - 4;
							$key_5 = $key - 5;
							$key_6 = $key - 6;
							$key_7 = $key - 7;
							$key_8 = $key - 8;
							$key_9 = $key - 9;
							$key_10 = $key - 10;
						?>
							<?=
							(isset($ndt_average_time_all_class[$class_code][$value]) ? $ndt_average_time_all_class[$class_code][$value] : ($ndt_average_time_all_class[$class_code][$week_list[$key_1]] > 0 ? $ndt_average_time_all_class[$class_code][$week_list[$key_1]] : ($ndt_average_time_all_class[$class_code][$week_list[$key_2]] > 0 ? $ndt_average_time_all_class[$class_code][$week_list[$key_2]] : ($ndt_average_time_all_class[$class_code][$week_list[$key_3]] > 0 ? $ndt_average_time_all_class[$class_code][$week_list[$key_3]] : ($ndt_average_time_all_class[$class_code][$week_list[$key_4]] > 0 ? $ndt_average_time_all_class[$class_code][$week_list[$key_4]] : ($ndt_average_time_all_class[$class_code][$week_list[$key_5]] > 0 ? $ndt_average_time_all_class[$class_code][$week_list[$key_5]] : ($ndt_average_time_all_class[$class_code][$week_list[$key_6]] > 0 ? $ndt_average_time_all_class[$class_code][$week_list[$key_6]] : ($ndt_average_time_all_class[$class_code][$week_list[$key_7]] > 0 ? $ndt_average_time_all_class[$class_code][$week_list[$key_7]] : ($ndt_average_time_all_class[$class_code][$week_list[$key_8]] > 0 ? $ndt_average_time_all_class[$class_code][$week_list[$key_8]] : ($ndt_average_time_all_class[$class_code][$week_list[$key_9]] > 0 ? $ndt_average_time_all_class[$class_code][$week_list[$key_9]] : ($ndt_average_time_all_class[$class_code][$week_list[$key_10]] > 0 ? $ndt_average_time_all_class[$class_code][$week_list[$key_10]] : 0
																	)))))))))))
							?>,
						<?php } ?>
					],
				},
			],
		});


	});

	function change_week_base(input) {
    window.location = '<?= base_url() ?>home/home_dashboard_rate/' + $(input).val() + '/<?= $class_code ?>/' + <?= $type_of_module ?> + '/' + <?= $d_ndt_type ?> + '?project=<?= $this->input->get('project') ?? $this->user_cookie[10] ?>&company=<?= $this->input->get('company') ?? $this->user_cookie[11] ?>';
}

	function change_class_base(input) {
		window.location = '<?= base_url() ?>home/home_dashboard_rate/' + <?= $week_based ?> + '/' + $(input).val() + '/' + <?= $type_of_module ?> + '/' + <?= $d_ndt_type ?> + '?project=<?= ($this->input->get('project') ?? $this->user_cookie[10]) ?>&company=<?= $this->input->get('company') ?? $this->user_cookie[11] ?>';
	}

	function change_tom_base(input) {
		window.location = '<?= base_url() ?>home/home_dashboard_rate/' + <?= $week_based ?> + '/' + <?= $class_code ?> + '/' + $(input).val() + '/' + <?= $d_ndt_type ?> + '?project=<?= ($this->input->get('project') ?? $this->user_cookie[10]) ?>&company=<?= $this->input->get('company') ?? $this->user_cookie[11] ?>';
	}

	function change_ndttype_base(input) {
		window.location = '<?= base_url() ?>home/home_dashboard_rate/' + <?= $week_based ?> + '/' + <?= $class_code ?> + '/' + <?= $type_of_module ?> + '/' + $(input).val() + '?project=<?= ($this->input->get('project') ?? $this->user_cookie[10]) ?>&company=<?= $this->input->get('company') ?? $this->user_cookie[11] ?>';
	}

	function spinner() {
		return `
      <div class="container text-center h-100">
        <div class="row align-items-center h-100">
          <div class="col-md-12">
            <div class="spinner-border text-success" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
        </div>
      </div>
    `
	}

	// KPI BY JOINT



	load_all_qc_kpi()

	<?php //if ($this->user_cookie[11] == 1): 
	?>

	function load_all_qc_kpi() {
		let week_value = $(".week_kpi_select option:selected").text()
		let period_text = `#${week_value}`

		$('.week_kpi_text').text(period_text)
		load_kpi_by_joint()
		load_kpi_by_length()
	}

	<?php //endif; 
	?>

	function load_kpi_by_joint() {
		$("#kpi_by_joint_special").html(spinner())
		$("#kpi_by_joint_primary").html(spinner())
		$("#kpi_by_joint_secondary").html(spinner())
		$("#kpi_by_joint_second_to_primer").html(spinner())
		fetch_kpi_by_joint("special", "#kpi_by_joint_special")
		fetch_kpi_by_joint("primary", "#kpi_by_joint_primary")
		fetch_kpi_by_joint("secondary", "#kpi_by_joint_secondary")
		fetch_kpi_by_joint("second_to_primer", "#kpi_by_joint_second_to_primer")
	}

	function fetch_kpi_by_joint(category, container) {
		let discipline = $('select[name="discipline_kpi"]').val()
		let week_val = $('select[name="week_kpi"]').val()
		$.ajax({
			url: "<?= site_url('home/fetch_kpi_by_joint') ?>",
			type: "GET",
			data: {
				category: category,
				discipline: discipline,
				week_val: week_val,
				project: <?= ($this->input->get('project') ?? $this->user_cookie[10]) ?>,
			},
			success: (data) => {
				$(container).html(data)
			}
		})
	}

	// KPI BY LENGTH

	function load_kpi_by_length() {
		$("#kpi_by_length_special").html(spinner())
		$("#kpi_by_length_primary").html(spinner())
		$("#kpi_by_length_secondary").html(spinner())
		$("#kpi_by_length_second_to_primer").html(spinner())
		fetch_kpi_by_length("special", "#kpi_by_length_special")
		fetch_kpi_by_length("primary", "#kpi_by_length_primary")
		fetch_kpi_by_length("secondary", "#kpi_by_length_secondary")
		fetch_kpi_by_length("second_to_primer", "#kpi_by_length_second_to_primer")
	}

	function fetch_kpi_by_length(category, container) {
		let discipline = $('select[name="discipline_kpi"]').val()
		let week_val = $('select[name="week_kpi"]').val()

		$.ajax({
			url: "<?= site_url('home/fetch_kpi_by_length') ?>",
			type: "GET",
			data: {
				category: category,
				discipline: discipline,
				week_val: week_val,
				project: <?= ($this->input->get('project') ?? $this->user_cookie[10]) ?>,
			},
			success: (data) => {
				$(container).html(data)
			}
		})
	}
</script>