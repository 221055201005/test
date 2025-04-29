<!doctype html>
<html lang="en">
  <head>
		<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="IT Developer SMOE">
    <title><?php echo $meta_title ?></title>
		<link rel="shortcut icon" href="<?php echo base_url();?>img/favicon.png"/>
	</head>
	<body>
		<style>
			th{
				white-space: nowrap;
				padding: 10px;
			}
			td{
				text-align: center;
			}
			td:nth-child(4){
				text-align: left;
			}
		</style>
		<div id="content" class="container-fluid">
			<?php foreach ($deck_elevation as $key_deck => $value_deck) { ?>
				<div>
					<br>
					<br>
					<div>
						<table style="border-collapse: collapse;" width="100%" border="1">
							<thead>
								<tr>
									<th colspan="6">MDB INDEX B (SPECIFIC) <?= strtoupper($value_deck['name']) ?></th>
								</tr>
								<tr>
									<th width="1%">S/N</th>
									<th width="1%">SECTION</th>
									<th width="1%">SUB SECTION </th>
									<th>DOCUMENT DESCRIPTION</th>
									<th width="1%">ECODOC NO</th>
									<th width="1%">BOOK / VOLUME</th>
								</tr>
							</thead>
							<tbody>
		
								<tr>
									<td>1</td>
									<td></td>
									<td></td>
									<td>TOPSIDE FABRICATION</td>
									<td></td>
									<td></td>
								</tr>
		
								<tr>
									<td></td>
									<td>A</td>
									<td></td>
									<td>STRUCTURE ENGINEERING DOSSIER</td>
									<td></td>
									<td></td>
								</tr>
		
								<tr>
									<td></td>
									<td></td>
									<td>A.1</td>
									<td>General Drawing</td>
									<td></td>
									<td></td>
								</tr>
		
								<tr>
									<td></td>
									<td></td>
									<td>A.2</td>
									<td>Shop Drawing (GA + Assembly Drawing)</td>
									<td></td>
									<td></td>
								</tr>
								<?php foreach ($shopdrawing_dossier['GA'] as $key => $value) : ?>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td>
											<a href="<?= $value['link'] ?>" target="_blank">
												A.2.<?= ($key+1) ?> <?= $value['report_number'] ?>
											</a>
										</td>
										<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
										<td><?= $value['book_volume'] ?></td>
									</tr>
								<?php endforeach; ?>
		
		
								<tr>
									<td></td>
									<td></td>
									<td>A.3</td>
									<td>Weld Map Drawings (WM GA + Assembly Drawing)</td>
									<td></td>
									<td></td>
								</tr>
								<?php foreach ($shopdrawing_dossier['WM'] as $key => $value) : ?>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td>
											<a href="<?= $value['link'] ?>" target="_blank">
												A.3.<?= ($key+1) ?> <?= $value['report_number'] ?>
											</a>
										</td>
										<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
										<td><?= $value['book_volume'] ?></td>
									</tr>
								<?php endforeach; ?>
		
		
		
								<tr>
									<td></td>
									<td>B</td>
									<td></td>
									<td>STRUCTURE FABRICATION DOSSIER</td>
									<td></td>
									<td></td>
								</tr>
		
								<tr>
									<td></td>
									<td></td>
									<td>B.1</td>
									<td>Material Verification Report</td>
									<td></td>
									<td></td>
								</tr>
								<?php if (isset($mv_dossier)) : ?>
									<?php foreach ($mv_dossier as $key => $value) : ?>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td>
												<a href="<?= $value['link'] ?>" target="_blank">
													<?= "B.1." . ($key + 1) . ' ' . $value['report_number'] ?>
												</a>
											</td>
											<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
											<td><?= $value['book_volume'] ?></td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
		
								<tr>
									<td></td>
									<td></td>
									<td>B.2</td>
									<td>Material &amp; Welding Traceability Report</td>
									<td></td>
									<td></td>
								</tr>
		
								<?php if (isset($wtr_dossier)) : ?>
									<?php foreach ($wtr_dossier as $key => $value) : ?>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td>
												<a href="<?= $value['link'] ?>" target="_blank">
													<?= "B.2." . ($key + 1) . ' ' . $value['report_number'] ?>
												</a>
											</td>
											<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
											<td><?= $value['book_volume'] ?></td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
								
		
		
								<tr>
									<td></td>
									<td></td>
									<td>B.3</td>
									<td>Fit-up Report</td>
									<td></td>
									<td></td>
								</tr>
		
								<?php if (isset($fitup_dossier)) : ?>
									<?php foreach ($fitup_dossier as $key => $value) : ?>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td>
												<a href="<?= $value['link'] ?>" target="_blank">
													<?= "B.1." . ($key + 1) . ' ' . $value['report_number'] ?>
												</a>
											</td>
											<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
											<td><?= $value['book_volume'] ?></td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
		
		
								<tr>
									<td></td>
									<td></td>
									<td>B.4</td>
									<td>Visual Report</td>
									<td></td>
									<td></td>
								</tr>
		
								<?php // VISUAL 
								?>
								<?php if (isset($visual_dossier[1])) {
									foreach ($visual_dossier[1] as $key_vis => $value_vis) { ?>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td>
												<a href="<?= $value_vis['link'] ?>" target="_blank">
													<?= "B.4." . ($key_vis + 1) . ' ' . $this->report[12][$value_vis['discipline']][60][1]['visual_report'.($value_vis['company_id']==13 ? '_13' : '')] . $value_vis['report_number'] ?>
												</a>
											</td>
											<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
											<td><?= $value['book_volume'] ?></td>
										</tr>
								<?php }
								} ?>
		
								<tr>
									<td></td>
									<td></td>
									<td>B.5</td>
									<td>Ultrasonic Test Reports</td>
									<td></td>
									<td></td>
								</tr>
								<?php // NDT UT => 3 
								?>
								<?php if (isset($ndt_dossier[1][3])) {
									foreach ($ndt_dossier[1][3] as $key_ut => $value_ut) { ?>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td>
												<a href="<?= $value_ut['link'] ?>" target="_blank">
													<?= "B.5." . ($key_ut + 1) . ' ' . $value_ut['report_number'] ?>
												</a>
											</td>
											<td><a target="_blank" href="<?= $value_ut['link_ecodoc'] ?>"><?= $value_ut['ecodoc_no'] ?></a></td>
											<td><?= $value_ut['book_volume'] ?></td>
										</tr>
								<?php }
								} ?>
		
								<tr>
									<td></td>
									<td></td>
									<td>B.6</td>
									<td>Radiography Test Report</td>
									<td></td>
									<td></td>
								</tr>
								<?php // NDT RT => 1 
								?>
								<?php if (isset($ndt_dossier[1][1])) {
									foreach ($ndt_dossier[1][1] as $key_rt => $value_rt) { ?>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td>
												<a href="<?= $value_rt['link'] ?>" target="_blank">
													<?= "B.6." . ($key_rt + 1) . ' ' . $value_rt['report_number'] ?>
												</a>
											</td>
											<td><a target="_blank" href="<?= $value_rt['link_ecodoc'] ?>"><?= $value_rt['ecodoc_no'] ?></a></td>
											<td><?= $value_rt['book_volume'] ?></td>
										</tr>
								<?php }
								} ?>
		
								<tr>
									<td></td>
									<td></td>
									<td>B.7</td>
									<td>Magnetic Particle Test Reports</td>
									<td></td>
									<td></td>
								</tr>
								<?php // NDT MT => 2 
								?>
								<?php if (isset($ndt_dossier[1][2])) {
									foreach ($ndt_dossier[1][2] as $key_mt => $value_mt) { ?>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td>
												<a href="<?= $value_mt['link'] ?>" target="_blank">
													<?= "B.7." . ($key_mt + 1) . ' ' . $value_mt['report_number'] ?>
												</a>
											</td>
											<td><a target="_blank" href="<?= $value_mt['link_ecodoc'] ?>"><?= $value_mt['ecodoc_no'] ?></a></td>
											<td><?= $value_mt['book_volume'] ?></td>
										</tr>
								<?php }
								} ?>
		
								<tr>
									<td></td>
									<td></td>
									<td>B.8</td>
									<td>Dye Penetrant Reports (if applicable)</td>
									<td></td>
									<td></td>
								</tr>
								<?php // NDT PT => 7 
								?>
								<?php if (isset($ndt_dossier[1][7])) {
									foreach ($ndt_dossier[1][7] as $key_pt => $value_pt) { ?>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td>
												<a href="<?= $value_pt['link'] ?>" target="_blank">
													<?= "B.8." . ($key_pt + 1) . ' ' . $value_pt['report_number'] ?>
												</a>
											</td>
											<td><a target="_blank" href="<?= $value_pt['link_ecodoc'] ?>"><?= $value_pt['ecodoc_no'] ?></a></td>
											<td><?= $value_pt['book_volume'] ?></td>
										</tr>
								<?php }
								} ?>
		
								<tr>
									<td></td>
									<td></td>
									<td>B.9</td>
									<td>Dimensional Report</td>
									<td></td>
									<td></td>
								</tr>
								<?php if (isset($dimension_dossier[1])) {
									foreach ($dimension_dossier[1] as $key_dc => $value_dc) { ?>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td>
												<a href="<?= $value_dc['link'] ?>" target="_blank">
													<?= "B.9.".($key_dc + 1).' '.$value_dc['report_number'] ?>
												</a>
											</td>
											<td><a target="_blank" href="<?= $value_dc['link_ecodoc'] ?>"><?= $value_dc['ecodoc_no'] ?></a></td>
											<td><?= $value_dc['book_volume'] ?></td>
										</tr>
								<?php }
								} ?>
		
								<tr>
									<td></td>
									<td></td>
									<td>B.10</td>
									<td>Inspection Release Note</td>
									<td></td>
								</tr>
								<?php if (isset($irn_dossier[1])) {
									foreach ($irn_dossier[1] as $key_irn => $value_irn) { ?>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td>
												<a href="<?= $value_irn['link'] ?>" target="_blank">
													<?= "B.10." . ($key_irn + 1) . ' ' . $this->report[12][$value_irn['discipline']][60][1]['irn_report'.($value_irn['company_id']==13 ? '_scm' : '')] . $value_irn['report_number'] ?>
												</a>
											</td>
											<td><a target="_blank" href="<?= $value_irn['link_ecodoc'] ?>"><?= $value_irn['ecodoc_no'] ?></a></td>
											<td><?= $value_irn['book_volume'] ?></td>
										</tr>
								<?php }
								} ?>
		
								<tr>
									<td></td>
									<td></td>
									<td>B.11</td>
									<td>Hardness Testing Reports (if applicable)</td>
									<td></td>
								</tr>
								<?php if (isset($ht_dossier[1])) {
									foreach ($ht_dossier[1] as $key_ht => $value_ht) { ?>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td>
												<a href="<?= $value_ht['link'] ?>" target="_blank">
													<?= "B.11.".($key_ht + 1).' '.$value_ht['report_number'] ?>
												</a>
											</td>
											<td><a target="_blank" href="<?= $value_ht['link_ecodoc'] ?>"><?= $value_ht['ecodoc_no'] ?></a></td>
											<td><?= $value_ht['book_volume'] ?></td>
										</tr>
								<?php }
								} ?>
		
								<tr>
									<td></td>
									<td></td>
									<td>B.12</td>
									<td>Positive Material Identification - PMI (if applicable)</td>
									<td></td>
									<td></td>
								</tr>
								<?php // NDT PMI => 8 
								?>
								<?php if (isset($ndt_dossier[1][8])) { 
									foreach ($ndt_dossier[1][8] as $key_pmi => $value_pmi) { ?>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td>
												<a href="<?= $value_pmi['link'] ?>" target="_blank">
													<?= "B.12." . ($key_pmi + 1) . ' ' . $value_pmi['report_number'] ?>
												</a>
											</td>
											<td><a target="_blank" href="<?= $value_pmi['link_ecodoc'] ?>"><?= $value_pmi['ecodoc_no'] ?></a></td>
											<td><?= $value_pmi['book_volume'] ?></td>
										</tr>
								<?php }
								} ?>
		
								<tr>
									<td></td>
									<td>C</td>
									<td></td>
									<td>SURFACE PROTECTION FABRICATION DOSSIER</td>
									<td></td>
									<td></td>
								</tr>
		
								<tr>
									<td></td>
									<td></td>
									<td>C.1</td>
									<td>Paint Material Certificates</td>
									<td></td>
									<td></td>
								</tr>
		
								<?php if (isset($additional_att["215"])) : ?>
									<?php foreach ($additional_att["215"] as $k => $v) : ?>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td>
												<a href="<?= $v['link'] ?>" target="_blank">C.1.<?= $k + 1 ?> <?= $v['file_name'] ?></a>
											</td>
											<td><a target="_blank" href="<?= $v['link_ecodoc'] ?>"><?= $v['ecodoc_no'] ?></a></td>
                      <td><?= $v['book_volume'] ?></td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
		
								<tr>
									<td></td>
									<td></td>
									<td>C.2</td>
									<td>Personnel &amp; Equipment Calibration Certificates</td>
									<td></td>
									<td></td>
								</tr>
		
								<?php if (isset($additional_att["216"])) : ?>
									<?php foreach ($additional_att["216"] as $k => $v) : ?>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td>
												<a href="<?= $v['link'] ?>" target="_blank">C.2.<?= $k + 1 ?> <?= $v['file_name'] ?></a>
											</td>
											<td><a target="_blank" href="<?= $v['link_ecodoc'] ?>"><?= $v['ecodoc_no'] ?></a></td>
                      <td><?= $v['book_volume'] ?></td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
		
		
								<tr>
									<td></td>
									<td></td>
									<td>C.3</td>
									<td>Coating Traceability Records</td>
									<td></td>
								</tr>
		
								<?php if (isset($additional_att["217"])) : ?>
									<?php foreach ($additional_att["217"] as $k => $v) : ?>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td>
												<a href="<?= $v['link'] ?>" target="_blank">C.3.<?= $k + 1 ?> <?= $v['file_name'] ?></a>
											</td>
											<td><a target="_blank" href="<?= $v['link_ecodoc'] ?>"><?= $v['ecodoc_no'] ?></a></td>
                      <td><?= $v['book_volume'] ?></td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
		
								<tr>
									<td></td>
									<td></td>
									<td>C.4</td>
									<td>Surface Preparation &amp; Painting Reports</td>
									<td></td>
									<td></td>
								</tr>
		
								<?php if (isset($additional_att["218"])) : ?>
									<?php foreach ($additional_att["218"] as $k => $v) : ?>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td>
												<a href="<?= $v['link'] ?>" target="_blank">C.4.<?= $k + 1 ?> <?= $v['file_name'] ?></a>
											</td>
											<td><a target="_blank" href="<?= $v['link_ecodoc'] ?>"><?= $v['ecodoc_no'] ?></a></td>
                      <td><?= $v['book_volume'] ?></td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
		
		
		
								<tr>
									<td></td>
									<td>D</td>
									<td></td>
									<td>PUNCHLIST</td>
									<td></td>
								</tr>
		
								<tr>
									<td></td>
									<td></td>
									<td>D.1</td>
									<td>Punchlist at loadout</td>
									<td></td>
									<td></td>
								</tr>
		
		
								<?php if (isset($additional_att["219"])) : ?>
									<?php foreach ($additional_att["219"] as $k => $v) : ?>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td>
												<a href="<?= $v['link'] ?>" target="_blank">D.1.<?= $k + 1 ?> <?= $v['file_name'] ?></a>
											</td>
											<td><a target="_blank" href="<?= $v['link_ecodoc'] ?>"><?= $v['ecodoc_no'] ?></a></td>
                      <td><?= $v['book_volume'] ?></td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
		
								<tr>
									<td></td>
									<td>E</td>
									<td></td>
									<td>LOAD TEST</td>
									<td></td>
								</tr>
		
								<tr>
									<td></td>
									<td></td>
									<td>E.1</td>
									<td>Load Test Report</td>
									<td></td>
									<td></td>
								</tr>
		
								<?php if (isset($additional_att["220"])) : ?>
									<?php foreach ($additional_att["220"] as $k => $v) : ?>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td>
												<a href="<?= $v['link'] ?>" target="_blank">E.1.<?= $k + 1 ?> <?= $v['file_name'] ?></a>
											</td>
											<td><a target="_blank" href="<?= $v['link_ecodoc'] ?>"><?= $v['ecodoc_no'] ?></a></td>
                      <td><?= $v['book_volume'] ?></td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
		
		
							</tbody>
						</table>
					</div>
				</div>
			<?php } ?>
		</div>
	</body>
</html>
