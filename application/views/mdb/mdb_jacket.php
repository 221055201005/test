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
			th {
				white-space: nowrap;
				padding: 10px;
			}

			td {
				text-align: center;
			}

			td:nth-child(4) {
				text-align: left;
			}
		</style>

		<table border="1" style="width:100%; border-collapse: collapse">
			<tr>
				<th width="1%">VOLUME</th>
				<th width="1%">SECTION</th>
				<th width="1%">SUB SECTION </th>
				<th>DOCUMENT DESCRIPTION</th>
				<th width="1%">ECODOC NO</th>
				<th width="1%">BOOK VOLUME</th>
			</tr>
			<tr>
				<td>2</td>
				<td></td>
				<td></td>
				<td>JACKET FABRICATION </td>
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
				<td>General Drawing </td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>A.1.1</td>
				<td>General Notes</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>A.2</td>
				<td>Shop Drawing (GA + AS Drawing)</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>A.2.1</td>
				<td>Jacket Primary Steel</td>
				<td></td>
				<td></td>
			</tr>
			<?php foreach ($shopdrawing_dossier['GA'][6] as $key => $value) : ?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="<?= $value['link'] ?>" target="_blank">
							A.2.1.<?= ($key+1) ?> <?= $value['report_number'] ?>
						</a>
					</td>
					<td><?= $value['ecodoc_no'] ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td></td>
				<td></td>
				<td>A.2.2</td>
				<td>Mudmat</td>
				<td></td>
				<td></td>
			</tr>
			<?php foreach ($shopdrawing_dossier['GA'][29] as $key => $value) : ?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="<?= $value['link'] ?>" target="_blank">
							A.2.2.<?= ($key+1) ?> <?= $value['report_number'] ?>
						</a>
					</td>
					<td><?= $value['ecodoc_no'] ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td></td>
				<td></td>
				<td>A.2.3</td>
				<td>J-Tube</td>
				<td></td>
				<td></td>
			</tr>
			<?php foreach ($shopdrawing_dossier['GA'][19] as $key => $value) : ?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="<?= $value['link'] ?>" target="_blank">
							A.2.3.<?= ($key+1) ?> <?= $value['report_number'] ?>
						</a>
					</td>
					<td><?= $value['ecodoc_no'] ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td></td>
				<td></td>
				<td>A.2.4</td>
				<td>Anodes</td>
				<td></td>
				<td></td>
			</tr>
			<?php foreach ($shopdrawing_dossier['GA'][34] as $key => $value) : ?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="<?= $value['link'] ?>" target="_blank">
							A.2.4.<?= ($key+1) ?> <?= $value['report_number'] ?>
						</a>
					</td>
					<td><?= $value['ecodoc_no'] ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td></td>
				<td></td>
				<td>A.2.5</td>
				<td>Caisson</td>
				<td></td>
				<td></td>
			</tr>
			<?php foreach ($shopdrawing_dossier['GA'][46] as $key => $value) : ?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="<?= $value['link'] ?>" target="_blank">
							A.2.5.<?= ($key+1) ?> <?= $value['report_number'] ?>
						</a>
					</td>
					<td><?= $value['ecodoc_no'] ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td></td>
				<td></td>
				<td>A.2.6</td>
				<td>Boat Landing</td>
				<td></td>
				<td></td>
			</tr>
			<?php foreach (array_merge($shopdrawing_dossier['GA'][26], $shopdrawing_dossier['GA'][10]) as $key => $value) : ?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="<?= $value['link'] ?>" target="_blank">
							A.2.6.<?= ($key+1) ?> <?= $value['report_number'] ?>
						</a>
					</td>
					<td><?= $value['ecodoc_no'] ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td></td>
				<td></td>
				<td>A.2.7</td>
				<td>Pile To Leg Fixation</td>
				<td></td>
				<td></td>
			</tr>
			<?php foreach (array_merge($shopdrawing_dossier['GA'][22], $shopdrawing_dossier['GA'][27]) as $key => $value) : ?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="<?= $value['link'] ?>" target="_blank">
							A.2.7.<?= ($key+1) ?> <?= $value['report_number'] ?>
						</a>
					</td>
					<td><?= $value['ecodoc_no'] ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td></td>
				<td></td>
				<td>A.2.8</td>
				<td>Trunnion</td>
				<td></td>
				<td></td>
			</tr>
			<?php foreach ($shopdrawing_dossier['GA'][12] as $key => $value) : ?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="<?= $value['link'] ?>" target="_blank">
							A.2.8.<?= ($key+1) ?> <?= $value['report_number'] ?>
						</a>
					</td>
					<td><?= $value['ecodoc_no'] ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td></td>
				<td></td>
				<td>A.2.9</td>
				<td>Grillage</td>
				<td></td>
				<td></td>
			</tr>
			<?php foreach ($shopdrawing_dossier['GA'][13] as $key => $value) : ?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="<?= $value['link'] ?>" target="_blank">
							A.2.9.<?= ($key+1) ?> <?= $value['report_number'] ?>
						</a>
					</td>
					<td><?= $value['ecodoc_no'] ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td></td>
				<td></td>
				<td>A.3</td>
				<td>Weld Map Drawing (WM GA + WM AS Drawing)</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>A.3.1</td>
				<td>Jacket Primary Steel</td>
				<td></td>
				<td></td>
			</tr>
			<?php foreach ($shopdrawing_dossier['WM'][6] as $key => $value) : ?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="<?= $value['link'] ?>" target="_blank">
							A.3.1.<?= ($key+1) ?> <?= $value['report_number'] ?>
						</a>
					</td>
					<td><?= $value['ecodoc_no'] ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td></td>
				<td></td>
				<td>A.3.2</td>
				<td>Mudmat</td>
				<td></td>
				<td></td>
			</tr>
			<?php foreach ($shopdrawing_dossier['WM'][29] as $key => $value) : ?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="<?= $value['link'] ?>" target="_blank">
							A.3.2.<?= ($key+1) ?> <?= $value['report_number'] ?>
						</a>
					</td>
					<td><?= $value['ecodoc_no'] ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td></td>
				<td></td>
				<td>A.3.3</td>
				<td>J-Tube</td>
				<td></td>
				<td></td>
			</tr>
			<?php foreach ($shopdrawing_dossier['WM'][19] as $key => $value) : ?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="<?= $value['link'] ?>" target="_blank">
							A.3.3.<?= ($key+1) ?> <?= $value['report_number'] ?>
						</a>
					</td>
					<td><?= $value['ecodoc_no'] ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td></td>
				<td></td>
				<td>A.3.4</td>
				<td>Anodes</td>
				<td></td>
				<td></td>
			</tr>
			<?php foreach ($shopdrawing_dossier['WM'][34] as $key => $value) : ?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="<?= $value['link'] ?>" target="_blank">
							A.3.4.<?= ($key+1) ?> <?= $value['report_number'] ?>
						</a>
					</td>
					<td><?= $value['ecodoc_no'] ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td></td>
				<td></td>
				<td>A.3.5</td>
				<td>Caisson</td>
				<td></td>
				<td></td>
			</tr>
			<?php foreach ($shopdrawing_dossier['WM'][46] as $key => $value) : ?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="<?= $value['link'] ?>" target="_blank">
							A.3.5.<?= ($key+1) ?> <?= $value['report_number'] ?>
						</a>
					</td>
					<td><?= $value['ecodoc_no'] ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td></td>
				<td></td>
				<td>A.3.6</td>
				<td>Boat Landing</td>
				<td></td>
				<td></td>
			</tr>
			<?php foreach (array_merge($shopdrawing_dossier['WM'][26], $shopdrawing_dossier['WM'][10]) as $key => $value) : ?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="<?= $value['link'] ?>" target="_blank">
							A.3.6.<?= ($key+1) ?> <?= $value['report_number'] ?>
						</a>
					</td>
					<td><?= $value['ecodoc_no'] ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td></td>
				<td></td>
				<td>A.3.7</td>
				<td>Pile To Leg Fixation</td>
				<td></td>
				<td></td>
			</tr>
			<?php foreach (array_merge($shopdrawing_dossier['WM'][22], $shopdrawing_dossier['WM'][27]) as $key => $value) : ?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="<?= $value['link'] ?>" target="_blank">
							A.3.7.<?= ($key+1) ?> <?= $value['report_number'] ?>
						</a>
					</td>
					<td><?= $value['ecodoc_no'] ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td></td>
				<td></td>
				<td>A.3.8</td>
				<td>Trunnion</td>
				<td></td>
				<td></td>
			</tr>
			<?php foreach ($shopdrawing_dossier['WM'][12] as $key => $value) : ?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="<?= $value['link'] ?>" target="_blank">
							A.3.8.<?= ($key+1) ?> <?= $value['report_number'] ?>
						</a>
					</td>
					<td><?= $value['ecodoc_no'] ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td></td>
				<td></td>
				<td>A.3.9</td>
				<td>Grillage</td>
				<td></td>
				<td></td>
			</tr>
			<?php foreach ($shopdrawing_dossier['WM'][13] as $key => $value) : ?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="<?= $value['link'] ?>" target="_blank">
							A.3.9.<?= ($key+1) ?> <?= $value['report_number'] ?>
						</a>
					</td>
					<td><?= $value['ecodoc_no'] ?></td>
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

			<?php if (isset($mv_structure)) : ?>
				<?php foreach ($mv_structure as $key => $value) : ?>
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

			<?php if (isset($wtr_structure)) : ?>
				<?php foreach ($wtr_structure as $key => $value) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $value['link'] ?>" target="_blank">
								<?= "B.2." . ($key + 1) . ' ' . $value['drawing_no'] ?>
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
			<?php if (isset($fitup_structure)) : ?>
				<?php foreach ($fitup_structure as $key => $value) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $value['link'] ?>" target="_blank">
								<?= "B.3." . ($key + 1) . ' ' . $value['report_number'] ?>
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
			<?php if (isset($visual_structure)) : ?>
				<?php foreach ($visual_structure as $key => $value) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $value['link'] ?>" target="_blank">
								<?= "B.4." . ($key + 1) . ' ' . $value['report_number'] ?>
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
				<td>B.5</td>
				<td>Ultrasonic Test Reports</td>
				<td></td>
				<td></td>
			</tr>
			<?php 
				// NDT UT => 3
			?>
			<?php if (isset($ndt_structure[3])) {
				foreach ($ndt_structure[3] as $key => $value) { ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $value['link'] ?>" target="_blank">
								<?= "B.5." . ($key + 1) . ' ' . $value['report_number'] ?>
							</a>
						</td>
						<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
						<td><?= $value['book_volume'] ?></td>
					</tr>
			<?php } } ?>

			<tr>
				<td></td>
				<td></td>
				<td>B.6</td>
				<td>Radiography Test Report</td>
				<td></td>
				<td></td>
			</tr>
			<?php 
				// NDT RT => 1
			?>
			<?php if (isset($ndt_structure[1])) {
				foreach ($ndt_structure[1] as $key => $value) { ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $value['link'] ?>" target="_blank">
								<?= "B.6." . ($key + 1) . ' ' . $value['report_number'] ?>
							</a>
						</td>
						<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
						<td><?= $value['book_volume'] ?></td>
					</tr>
			<?php } } ?>

			<tr>
				<td></td>
				<td></td>
				<td>B.7</td>
				<td>Magnetic Particle Test Reports</td>
				<td></td>
				<td></td>
			</tr>
			<?php 
				// NDT MT => 2
			?>
			<?php if (isset($ndt_structure[2])) {
				foreach ($ndt_structure[2] as $key => $value) { ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $value['link'] ?>" target="_blank">
								<?= "B.7." . ($key + 1) . ' ' . $value['report_number'] ?>
							</a>
						</td>
						<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
						<td><?= $value['book_volume'] ?></td>
					</tr>
			<?php } } ?>

			<tr>
				<td></td>
				<td></td>
				<td>B.8</td>
				<td>Dye Penetrant Reports (if applicable)</td>
				<td></td>
				<td></td>
			</tr>
			<?php 
				// NDT PT => 7
			?>
			<?php if (isset($ndt_structure[7])) {
				foreach ($ndt_structure[7] as $key => $value) { ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $value['link'] ?>" target="_blank">
								<?= "B.8." . ($key + 1) . ' ' . $value['report_number'] ?>
							</a>
						</td>
						<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
						<td><?= $value['book_volume'] ?></td>
					</tr>
			<?php } } ?>

			<tr>
				<td></td>
				<td></td>
				<td>B.9</td>
				<td>Dimensional Report</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>B.10</td>
				<td>Inspection Release Note</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>B.11</td>
				<td>Hydrotest Report</td>
				<td></td>
				<td></td>
			</tr>

			<?php if (isset($additional_att["221"])) : ?>
				<?php foreach ($additional_att["221"] as $k => $v) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $v['link'] ?>" target="_blank">B.11.<?= $k + 1 ?> <?= $v['file_name'] ?></a>
						</td>
						<td><a target="_blank" href="<?= $v['link_ecodoc'] ?>"><?= $v['ecodoc_no'] ?></a></td>
                      <td><?= $v['book_volume'] ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>

			<tr>
				<td></td>
				<td></td>
				<td>B.12</td>
				<td>Weight Report</td>
				<td></td>
				<td></td>
			</tr>

			<?php if (isset($additional_att["222"])) : ?>
				<?php foreach ($additional_att["222"] as $k => $v) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $v['link'] ?>" target="_blank">B.12.<?= $k + 1 ?> <?= $v['file_name'] ?></a>
						</td>
						<td><a target="_blank" href="<?= $v['link_ecodoc'] ?>"><?= $v['ecodoc_no'] ?></a></td>
                      <td><?= $v['book_volume'] ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>

			<tr>
				<td></td>
				<td>C</td>
				<td></td>
				<td>J-TUBE FABRICATION &amp; CERTIFICATION DOSSIER</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>C.1</td>
				<td>Material Verification Report</td>
				<td></td>
				<td></td>
			</tr>

			<?php if (isset($mv_dossier["19"])) : ?>
				<?php foreach ($mv_dossier["19"] as $key => $value) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $value['link'] ?>" target="_blank">
								<?= "C.1." . ($key + 1) . ' ' . $value['report_number'] ?>
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
				<td>C.2</td>
				<td>Material &amp; Welding Traceability Report</td>
				<td></td>
				<td></td>
			</tr>

			<?php if (isset($wtr_dossier["19"])) : ?>
				<?php foreach ($wtr_dossier["19"] as $key => $value) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $value['link'] ?>" target="_blank">
								<?= "C.2." . ($key + 1) . ' ' . $value['drawing_no'] ?>
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
				<td>C.3</td>
				<td>Fit-up Report</td>
				<td></td>
				<td></td>
			</tr>
			<?php if (isset($fitup_dossier["19"])) : // J-TUBE ?>
				<?php foreach ($fitup_dossier["19"] as $key => $value) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $value['link'] ?>" target="_blank">
								<?= "C.3." . ($key + 1) . ' ' . $value['report_number'] ?>
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
				<td>C.4</td>
				<td>Visual Report</td>
				<td></td>
				<td></td>
			</tr>
			<?php if (isset($visual_dossier["19"])) : // J-TUBE ?>
				<?php foreach ($visual_dossier["19"] as $key => $value) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $value['link'] ?>" target="_blank">
								<?= "C.4." . ($key + 1) . ' ' . $value['report_number'] ?>
							</a>
						</td>
						<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
						<td><?= $value['book_volume'] ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>

			<!-- NDT START -->
				<tr>
					<td></td>
					<td></td>
					<td>C.5</td>
					<td>Ultrasonic Test Reports</td>
					<td></td>
				</tr>
				<?php 
					// NDT UT => 3
					// 19 => J-TUBE
				?>
				<?php if (isset($ndt_dossier[19][3])) {
					foreach ($ndt_dossier[19][3] as $key => $value) { ?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td>
								<a href="<?= $value['link'] ?>" target="_blank">
									<?= "C.5." . ($key + 1) . ' ' . $value['report_number'] ?>
								</a>
							</td>
							<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
							<td><?= $value['book_volume'] ?></td>
						</tr>
				<?php } } ?>
				<tr>
					<td></td>
					<td></td>
					<td>C.6</td>
					<td>Radiography Test Report</td>
					<td></td>
				</tr>
				<?php 
					// NDT RT => 1
					// 19 => J-TUBE
				?>
				<?php if (isset($ndt_dossier[19][1])) {
					foreach ($ndt_dossier[19][1] as $key => $value) { ?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td>
								<a href="<?= $value['link'] ?>" target="_blank">
									<?= "C.6." . ($key + 1) . ' ' . $value['report_number'] ?>
								</a>
							</td>
							<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
							<td><?= $value['book_volume'] ?></td>
						</tr>
				<?php } } ?>
				<tr>
					<td></td>
					<td></td>
					<td>C.7</td>
					<td>Magnetic Particle Test Reports</td>
					<td></td>
				</tr>
				<?php 
					// NDT MT => 2
					// 19 => J-TUBE
				?>
				<?php if (isset($ndt_dossier[19][2])) {
					foreach ($ndt_dossier[19][2] as $key => $value) { ?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td>
								<a href="<?= $value['link'] ?>" target="_blank">
									<?= "C.7." . ($key + 2) . ' ' . $value['report_number'] ?>
								</a>
							</td>
							<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
							<td><?= $value['book_volume'] ?></td>
						</tr>
				<?php } } ?>
				<tr>
					<td></td>
					<td></td>
					<td>C.8</td>
					<td>Dye Penetrant Reports (if applicable)</td>
					<td></td>
				</tr>
				<?php 
					// NDT PT => 7
					// 19 => J-TUBE
				?>
				<?php if (isset($ndt_dossier[19][7])) {
					foreach ($ndt_dossier[19][7] as $key => $value) { ?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td>
								<a href="<?= $value['link'] ?>" target="_blank">
									<?= "C.8." . ($key + 7) . ' ' . $value['report_number'] ?>
								</a>
							</td>
							<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
							<td><?= $value['book_volume'] ?></td>
						</tr>
				<?php } } ?>
			<!-- NDT END -->

			<tr>
				<td></td>
				<td></td>
				<td>C.9</td>
				<td>Boroscope Report </td>
				<td></td>
				<td></td>
			</tr>

			<?php if (isset($additional_att["223"])) : ?>
				<?php foreach ($additional_att["223"] as $k => $v) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $v['link'] ?>" target="_blank">C.9.<?= $k + 1 ?> <?= $v['file_name'] ?></a>
						</td>
						<td><a target="_blank" href="<?= $v['link_ecodoc'] ?>"><?= $v['ecodoc_no'] ?></a></td>
                      <td><?= $v['book_volume'] ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>

			<tr>
				<td></td>
				<td></td>
				<td>C.10</td>
				<td>Inspection Gauging Test Report</td>
				<td></td>
				<td></td>
			</tr>

			<?php if (isset($additional_att["224"])) : ?>
				<?php foreach ($additional_att["224"] as $k => $v) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $v['link'] ?>" target="_blank">C.10.<?= $k + 1 ?> <?= $v['file_name'] ?></a>
						</td>
						<td><a target="_blank" href="<?= $v['link_ecodoc'] ?>"><?= $v['ecodoc_no'] ?></a></td>
                      <td><?= $v['book_volume'] ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>

			<tr>
				<td></td>
				<td></td>
				<td>C.11</td>
				<td>Dimensional Report</td>
				<td></td>
				<td></td>
			</tr>

			<?php if (isset($additional_att["225"])) : ?>
				<?php foreach ($additional_att["225"] as $k => $v) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $v['link'] ?>" target="_blank">C.11.<?= $k + 1 ?> <?= $v['file_name'] ?></a>
						</td>
						<td><a target="_blank" href="<?= $v['link_ecodoc'] ?>"><?= $v['ecodoc_no'] ?></a></td>
                      <td><?= $v['book_volume'] ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>

			<tr>
				<td></td>
				<td></td>
				<td>C.12</td>
				<td>Inspection Release Note</td>
				<td></td>
				<td></td>
			</tr>
			<?php if (isset($irn_dossier[19])) : ?>
				<?php foreach ($irn_dossier[19] as $key => $value) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $value['link'] ?>" target="_blank">C.12.<?= $key + 1 ?> <?= $value['report_number'] ?></a>
						</td>
						<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
						<td><?= $value['book_volume'] ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>

			<tr>
				<td></td>
				<td>D</td>
				<td></td>
				<td>GROUTING SYSTEM FABRICATION DOSSIER</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>D.1</td>
				<td>Material Verification Report</td>
				<td></td>
				<td></td>
			</tr>

			<?php if (isset($mv_dossier["22"])) : ?>
				<?php foreach ($mv_dossier["22"] as $key => $value) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $value['link'] ?>" target="_blank">
								<?= "D.1." . ($key + 1) . ' ' . $value['report_number'] ?>
							</a>
						</td>
						<td><?= $value['ecodoc_no'] ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>

			<tr>
				<td></td>
				<td></td>
				<td>D.2</td>
				<td>Material &amp; Welding Traceability Report</td>
				<td></td>
				<td></td>
			</tr>

			<?php if (isset($wtr_dossier["22"])) : ?>
				<?php foreach ($wtr_dossier["22"] as $key => $value) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $value['link'] ?>" target="_blank">
								<?= "D.2." . ($key + 1) . ' ' . $value['drawing_no'] ?>
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
				<td>D.3</td>
				<td>Fit-up Report</td>
				<td></td>
				<td></td>
			</tr>
			<?php if (isset($fitup_dossier["22"])) : // GROUTING ?>
				<?php foreach ($fitup_dossier["22"] as $key => $value) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $value['link'] ?>" target="_blank">
								<?= "D.3." . ($key + 1) . ' ' . $value['report_number'] ?>
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
				<td>D.4</td>
				<td>Visual Report</td>
				<td></td>
				<td></td>
			</tr>
			<?php if (isset($visual_dossier["22"])) : // GROUTING ?>
				<?php foreach ($visual_dossier["22"] as $key => $value) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $value['link'] ?>" target="_blank">
								<?= "D.4." . ($key + 1) . ' ' . $value['report_number'] ?>
							</a>
						</td>
						<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
						<td><?= $value['book_volume'] ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>

			<!-- NDT START -->
				<tr>
					<td></td>
					<td></td>
					<td>D.5</td>
					<td>Ultrasonic Test Reports</td>
					<td></td>
				</tr>
				<?php 
					// NDT UT => 3
					// 22 => GROUTING
				?>
				<?php if (isset($ndt_dossier[22][3])) {
					foreach ($ndt_dossier[22][3] as $key => $value) { ?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td>
								<a href="<?= $value['link'] ?>" target="_blank">
									<?= "D.5." . ($key + 1) . ' ' . $value['report_number'] ?>
								</a>
							</td>
							<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
							<td><?= $value['book_volume'] ?></td>
						</tr>
				<?php } } ?>
				<tr>
					<td></td>
					<td></td>
					<td>D.6</td>
					<td>Radiography Test Report</td>
					<td></td>
				</tr>
				<?php 
					// NDT RT => 1
					// 22 => GROUTING
				?>
				<?php if (isset($ndt_dossier[22][1])) {
					foreach ($ndt_dossier[22][1] as $key => $value) { ?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td>
								<a href="<?= $value['link'] ?>" target="_blank">
									<?= "D.6." . ($key + 1) . ' ' . $value['report_number'] ?>
								</a>
							</td>
							<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
							<td><?= $value['book_volume'] ?></td>
						</tr>
				<?php } } ?>
				<tr>
					<td></td>
					<td></td>
					<td>D.7</td>
					<td>Magnetic Particle Test Reports</td>
					<td></td>
				</tr>
				<?php 
					// NDT MT => 2
					// 22 => GROUTING
				?>
				<?php if (isset($ndt_dossier[22][2])) {
					foreach ($ndt_dossier[22][2] as $key => $value) { ?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td>
								<a href="<?= $value['link'] ?>" target="_blank">
									<?= "D.7." . ($key + 2) . ' ' . $value['report_number'] ?>
								</a>
							</td>
							<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
							<td><?= $value['book_volume'] ?></td>
						</tr>
				<?php } } ?>
				<tr>
					<td></td>
					<td></td>
					<td>D.8</td>
					<td>Dye Penetrant Reports (if applicable)</td>
					<td></td>
				</tr>
				<?php 
					// NDT PT => 7
					// 22 => GROUTING
				?>
				<?php if (isset($ndt_dossier[22][7])) {
					foreach ($ndt_dossier[22][7] as $key => $value) { ?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td>
								<a href="<?= $value['link'] ?>" target="_blank">
									<?= "D.8." . ($key + 7) . ' ' . $value['report_number'] ?>
								</a>
							</td>
							<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
							<td><?= $value['book_volume'] ?></td>
						</tr>
				<?php } } ?>
			<!-- NDT END -->

			<tr>
				<td></td>
				<td></td>
				<td>D.9</td>
				<td>Dimensional Report</td>
				<td></td>
				<td></td>
			</tr>

			<?php if (isset($additional_att["226"])) : ?>
				<?php foreach ($additional_att["226"] as $k => $v) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $v['link'] ?>" target="_blank">D.9.<?= $k + 1 ?> <?= $v['file_name'] ?></a>
						</td>
						<td><a target="_blank" href="<?= $v['link_ecodoc'] ?>"><?= $v['ecodoc_no'] ?></a></td>
                      <td><?= $v['book_volume'] ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>


			<tr>
				<td></td>
				<td></td>
				<td>D.10</td>
				<td>Inspection Release Note</td>
				<td></td>
				<td></td>
			</tr>
			<?php if (isset($irn_dossier[22])) : ?>
				<?php foreach ($irn_dossier[22] as $key => $value) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $value['link'] ?>" target="_blank">D.10.<?= $key + 1 ?> <?= $value['report_number'] ?></a>
						</td>
						<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
						<td><?= $value['book_volume'] ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>

			<tr>
				<td></td>
				<td></td>
				<td>D.11</td>
				<td>Pressure Testing Report</td>
				<td></td>
				<td></td>
			</tr>

			<?php if (isset($additional_att["227"])) : ?>
				<?php foreach ($additional_att["227"] as $k => $v) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $v['link'] ?>" target="_blank">D.11.<?= $k + 1 ?> <?= $v['file_name'] ?></a>
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
				<td>MUDMAT FABRICATION DOSSIER</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>E.1</td>
				<td>Material Verification Report</td>
				<td></td>
				<td></td>
			</tr>

			<?php if (isset($mv_dossier["29"])) : ?>
				<?php foreach ($mv_dossier["29"] as $key => $value) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $value['link'] ?>" target="_blank">
								<?= "E.1." . ($key + 1) . ' ' . $value['report_number'] ?>
							</a>
						</td>
						<td><?= $value['ecodoc_no'] ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>

			<tr>
				<td></td>
				<td></td>
				<td>E.2</td>
				<td>Material &amp; Welding Traceability Report</td>
				<td></td>
				<td></td>
			</tr>

			<?php if (isset($wtr_dossier["29"])) : ?>
				<?php foreach ($wtr_dossier["29"] as $key => $value) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $value['link'] ?>" target="_blank">
								<?= "E.2." . ($key + 1) . ' ' . $value['drawing_no'] ?>
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
				<td>E.3</td>
				<td>Fit-up Report</td>
				<td></td>
				<td></td>
			</tr>
			<?php if (isset($fitup_dossier["29"])) : // MUDMAT ?>
				<?php foreach ($fitup_dossier["29"] as $key => $value) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $value['link'] ?>" target="_blank">
								<?= "E.3." . ($key + 1) . ' ' . $value['report_number'] ?>
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
				<td>E.4</td>
				<td>Visual Report</td>
				<td></td>
				<td></td>
			</tr>
			<?php if (isset($visual_dossier["29"])) : // MUDMAT ?>
				<?php foreach ($visual_dossier["29"] as $key => $value) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $value['link'] ?>" target="_blank">
								<?= "E.4." . ($key + 1) . ' ' . $value['report_number'] ?>
							</a>
						</td>
						<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
						<td><?= $value['book_volume'] ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>

			<!-- NDT START -->
				<tr>
					<td></td>
					<td></td>
					<td>E.5</td>
					<td>Ultrasonic Test Reports</td>
					<td></td>
				</tr>
				<?php 
					// NDT UT => 3
					// 29 => MUDMAT
				?>
				<?php if (isset($ndt_dossier[29][3])) {
					foreach ($ndt_dossier[29][3] as $key => $value) { ?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td>
								<a href="<?= $value['link'] ?>" target="_blank">
									<?= "E.5." . ($key + 1) . ' ' . $value['report_number'] ?>
								</a>
							</td>
							<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
							<td><?= $value['book_volume'] ?></td>
						</tr>
				<?php } } ?>
				<tr>
					<td></td>
					<td></td>
					<td>E.6</td>
					<td>Radiography Test Report</td>
					<td></td>
				</tr>
				<?php 
					// NDT RT => 1
					// 29 => MUDMAT
				?>
				<?php if (isset($ndt_dossier[29][1])) {
					foreach ($ndt_dossier[29][1] as $key => $value) { ?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td>
								<a href="<?= $value['link'] ?>" target="_blank">
									<?= "E.6." . ($key + 1) . ' ' . $value['report_number'] ?>
								</a>
							</td>
							<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
							<td><?= $value['book_volume'] ?></td>
						</tr>
				<?php } } ?>
				<tr>
					<td></td>
					<td></td>
					<td>E.7</td>
					<td>Magnetic Particle Test Reports</td>
					<td></td>
				</tr>
				<?php 
					// NDT MT => 2
					// 29 => MUDMAT
				?>
				<?php if (isset($ndt_dossier[29][2])) {
					foreach ($ndt_dossier[29][2] as $key => $value) { ?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td>
								<a href="<?= $value['link'] ?>" target="_blank">
									<?= "E.7." . ($key + 2) . ' ' . $value['report_number'] ?>
								</a>
							</td>
							<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
							<td><?= $value['book_volume'] ?></td>
						</tr>
				<?php } } ?>
				<tr>
					<td></td>
					<td></td>
					<td>E.8</td>
					<td>Dye Penetrant Reports (if applicable)</td>
					<td></td>
				</tr>
				<?php 
					// NDT PT => 7
					// 29 => MUDMAT
				?>
				<?php if (isset($ndt_dossier[29][7])) {
					foreach ($ndt_dossier[29][7] as $key => $value) { ?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td>
								<a href="<?= $value['link'] ?>" target="_blank">
									<?= "E.8." . ($key + 7) . ' ' . $value['report_number'] ?>
								</a>
							</td>
							<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
							<td><?= $value['book_volume'] ?></td>
						</tr>
				<?php } } ?>
			<!-- NDT END -->

			<tr>
				<td></td>
				<td></td>
				<td>E.9</td>
				<td>Dimensional Report</td>
				<td></td>
				<td></td>
			</tr>

			<?php if (isset($additional_att["228"])) : ?>
				<?php foreach ($additional_att["228"] as $k => $v) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $v['link'] ?>" target="_blank">E.9.<?= $k + 1 ?> <?= $v['file_name'] ?></a>
						</td>
						<td><a target="_blank" href="<?= $v['link_ecodoc'] ?>"><?= $v['ecodoc_no'] ?></a></td>
                      <td><?= $v['book_volume'] ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>

			<tr>
				<td></td>
				<td></td>
				<td>E.10</td>
				<td>Inspection Release Note</td>
				<td></td>
				<td></td>
			</tr>
			<?php if (isset($irn_dossier[29])) : ?>
				<?php foreach ($irn_dossier[29] as $key => $value) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $value['link'] ?>" target="_blank">E.10.<?= $key + 1 ?> <?= $value['report_number'] ?></a>
						</td>
						<td><a target="_blank" href="<?= $value['link_ecodoc'] ?>"><?= $value['ecodoc_no'] ?></a></td>
						<td><?= $value['book_volume'] ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>

			<tr>
				<td></td>
				<td>F</td>
				<td></td>
				<td>SURFACE PROTECTION FABRICATION DOSSIER</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>F.1</td>
				<td>Paint &amp; Abrasive Material Certificates</td>
				<td></td>
				<td></td>
			</tr>

			<?php if (isset($additional_att["229"])) : ?>
				<?php foreach ($additional_att["229"] as $k => $v) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $v['link'] ?>" target="_blank">F.1.<?= $k + 1 ?> <?= $v['file_name'] ?></a>
						</td>
						<td><a target="_blank" href="<?= $v['link_ecodoc'] ?>"><?= $v['ecodoc_no'] ?></a></td>
                      <td><?= $v['book_volume'] ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>

			<tr>
				<td></td>
				<td></td>
				<td>F.2</td>
				<td>Personnel &amp; Equipment Calibration Certificates</td>
				<td></td>
				<td></td>
			</tr>

			<?php if (isset($additional_att["230"])) : ?>
				<?php foreach ($additional_att["230"] as $k => $v) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $v['link'] ?>" target="_blank">F.2.<?= $k + 1 ?> <?= $v['file_name'] ?></a>
						</td>
						<td><a target="_blank" href="<?= $v['link_ecodoc'] ?>"><?= $v['ecodoc_no'] ?></a></td>
                      <td><?= $v['book_volume'] ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>

			<tr>
				<td></td>
				<td></td>
				<td>F.3</td>
				<td>Coating Traceability Records</td>
				<td></td>
				<td></td>
			</tr>

			<?php if (isset($additional_att["231"])) : ?>
				<?php foreach ($additional_att["231"] as $k => $v) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $v['link'] ?>" target="_blank">F.3.<?= $k + 1 ?> <?= $v['file_name'] ?></a>
						</td>
						<td><a target="_blank" href="<?= $v['link_ecodoc'] ?>"><?= $v['ecodoc_no'] ?></a></td>
                      <td><?= $v['book_volume'] ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>

			<tr>
				<td></td>
				<td></td>
				<td>F.4</td>
				<td>Surface Preparation &amp; Painting Reports</td>
				<td></td>
				<td></td>
			</tr>

			<?php if (isset($additional_att["232"])) : ?>
				<?php foreach ($additional_att["232"] as $k => $v) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $v['link'] ?>" target="_blank">F.4.<?= $k + 1 ?> <?= $v['file_name'] ?></a>
						</td>
						<td><a target="_blank" href="<?= $v['link_ecodoc'] ?>"><?= $v['ecodoc_no'] ?></a></td>
                      <td><?= $v['book_volume'] ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>

			<tr>
				<td></td>
				<td>G</td>
				<td></td>
				<td>OTHER RELEVANT JACKET FABRICATION DOSSIER</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>H.1</td>
				<td>Load testing Report</td>
				<td></td>
				<td></td>
			</tr>

			<?php if (isset($additional_att["233"])) : ?>
				<?php foreach ($additional_att["233"] as $k => $v) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $v['link'] ?>" target="_blank">H.1.<?= $k + 1 ?> <?= $v['file_name'] ?></a>
						</td>
						<td><a target="_blank" href="<?= $v['link_ecodoc'] ?>"><?= $v['ecodoc_no'] ?></a></td>
                      <td><?= $v['book_volume'] ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>

			<tr>
				<td></td>
				<td></td>
				<td>H.2</td>
				<td>Lifting Report</td>
			</tr>

			<?php if (isset($additional_att["234"])) : ?>
				<?php foreach ($additional_att["234"] as $k => $v) : ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a href="<?= $v['link'] ?>" target="_blank">H.2.<?= $k + 1 ?> <?= $v['file_name'] ?></a>
						</td>
						<td><a target="_blank" href="<?= $v['link_ecodoc'] ?>"><?= $v['ecodoc_no'] ?></a></td>
                      <td><?= $v['book_volume'] ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>

		</table>
	</body>
</html>