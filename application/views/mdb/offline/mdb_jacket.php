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
			table {
				width: 100%;
				border-collapse: separate; /* Don't collapse */
				border-spacing: 0;
			}

			table thead th {
				background-color: #edecec;
			}


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
			a:visited{
				color: blue;
			}
		</style>
		<div id="content" class="container-fluid">
			<div>
				<br>
				<br>
				<table id="table_mdb" style="border-collapse: collapse;" width="100%" border="1" class="">
					<thead>
						<tr>
							<th colspan="6">MDB INDEX B (SPECIFIC) JACKET</th>
						</tr>
						<tr>
							<th width='1%'>S/N</th>
							<th width='1%'>SECTION</th>
							<th width='1%'>SUBSECTION</th>
							<th>DOCUMENT DESCRIPTION</th>
							<th width='1%'>ECODOC NO</th>
							<th width='1%'>BOOK / VOLUME</th>
						</tr>
					</thead>
					<tbody>
						<!-- Volume -->
						<tr>
							<td>2</td>
							<td></td>
							<td></td>
							<td>JACKET FABRICATION</td>
							<td></td>
							<td></td>
						</tr>
						<?php foreach ($mdb_general_volume_list as $volume) : ?>
							<tr>
								<td></td>
								<td><?= $volume['volume'] ?></td>
								<td></td>
								<td><?= $volume['document_description'] ?></td>
								<td></td>
								<td><?= $volume['book_volume'] ?></td>
							</tr>

							<!-- Section -->
							<?php foreach ($mdb_general_section_list[$volume['volume']] ?? [] as $section) : ?>
								<tr>
									<td></td>
									<td></td>
									<td>
										<?php if($section['var_code'] != '' && @count($file_list[$section['var_code']]) > 0): ?>
											<!-- <a href="#" class="toggler" data-prod-cat="<?= $section['var_code'] ?>"> -->
												<?= $section['volume'] ?>.<?= $section['section'] ?>
											<!-- <a> -->
										<?php else: ?>
											<?= $section['volume'] ?>.<?= $section['section'] ?>
										<?php endif; ?>
										
									</td>
									<td class="<?= ($section['var_code'] != '' && @count($file_list[$section['var_code']]) > 0 ? 'has_var_code' : '') ?>">
										<?= $section['document_description'] ?>
									</td>
									<td>
										<a href="<?= base_url_ftp_mdr()."public_smoe/open_atc_mdr_ecodoc/".strtr($this->encryption->encrypt($section['ecodoc_no']), '+=/', '.-~') ?>" target="_blank"><?= $section['ecodoc_no'] ?></a>
									</td>
									<td><?= $section['book_volume'] ?></td>
								</tr>

								<!-- Section Ecodoc File -->
								<?php foreach ($file_list[$section['var_code']] ?? [] as $key => $file) : ?>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td>
                    	<a href="<?= $params['link_'.$section['var_code']].'/'.$file['att_link'] ?>" target="_blank"><?= $section['volume'] ?>.<?= $section['section'] ?>.<?= $key + 1 ?> <?= $file['att_link'] ?></a>
                    </td>
										<td>
											<!-- <a href="<?= $file['link_ecodoc'] ?>" target="_blank"><?= $file['ecodoc_no'] ?></a> -->
											<a href="<?= $this->ecodoc_no_list[$file['ecodoc_no']] ?>" target="_blank"><?= $file['ecodoc_no'] ?></a>
										</td>
										<td><?= $file['book_volume'] ?></td>
									</tr>
								<?php endforeach; ?>
								
								<!-- Subsection -->
								<?php foreach ($mdb_general_subsection_list[$section['volume']][$section['section']] ?? [] as $subsection) : ?>
									<tr>
										<td></td>
										<td></td>
										<td class="<?= ($subsection['var_code'] != '' && @count($file_list[$subsection['var_code']]) > 0 ? 'has_var_code' : '') ?>">
											<?php if($subsection['var_code'] != '' && @count($file_list[$subsection['var_code']]) > 0): ?>
												<!-- <a href="#" class="toggler" data-prod-cat="<?= $subsection['var_code'] ?>"> -->
													<?= $subsection['volume'] ?>.<?= $subsection['section'] ?>.<?= $subsection['subsection'] ?>
												<!-- <a> -->
											<?php else: ?>
												<?= $subsection['volume'] ?>.<?= $subsection['section'] ?>.<?= $subsection['subsection'] ?>
											<?php endif; ?>
										</td>
										<td><?= $subsection['document_description'] ?></td>
										<td></td>
										<td><?= $subsection['book_volume'] ?></td>
									</tr>

									<!-- Subsection File -->
									<?php foreach ($file_list[$subsection['var_code']] ?? [] as $key => $file) : ?>
										<tr class="cat_toggling cat_<?= $subsection['var_code'] ?>">
											<td></td>
											<td></td> 
											<td></td>
											<td><a href="<?= $params['link_'.$subsection['var_code']].'/'.$file['att_link'] ?>" target="_blank"><?= $subsection['volume'] ?>.<?= $subsection['section'] ?>.<?= $subsection['subsection'] ?>.<?= $key + 1 ?> <?= $file['report_number'] ?></a></td>
											<!-- <td><a href="<?= $file['link_ecodoc'] ?>" target="_blank"><?= $file['ecodoc_no'] ?></a></td> -->
              				<td><a href="<?= $this->ecodoc_no_list[$file['ecodoc_no']] ?>" target="_blank"><?= $file['ecodoc_no'] ?></a></td>

											<td><?= $file['book_volume'] ?></td>
										</tr>
									<?php endforeach; ?>
								<?php endforeach; ?>
							<?php endforeach; ?>
						<?php endforeach; ?>

					</tbody>
				</table>
			</div>
		</div>
		<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/jquery-3.4.1.min.js"></script>
		<script>
			$(document).ready(function(){
				$(".toggler").click(function(e){
					console.log('asdasd')
					e.preventDefault();
					$('.cat_'+$(this).attr('data-prod-cat')).toggle();
				});

				var heighthead = 0-1;
				$('#table_mdb thead tr:nth-child(1)').css("top", heighthead);
				$('#table_mdb thead tr:nth-child(1)').css("position", 'sticky');
				$('#table_mdb thead tr:nth-child(1)').css("background-color", 'white');
				$('#table_mdb thead tr:nth-child(1)').css("z-index", 2);
				// $('#table_mdb thead tr:nth-child(1)').css("box-shadow", "inset 0 1px 0 black, inset 0 -1px 0 black;");
				heighthead += $('#table_mdb thead tr:nth-child(1)').innerHeight()-1;

				$('#table_mdb thead tr:nth-child(2)').css("top", heighthead);
				$('#table_mdb thead tr:nth-child(2)').css("position", 'sticky');
				$('#table_mdb thead tr:nth-child(2)').css("background-color", 'white');
				$('#table_mdb thead tr:nth-child(2)').css("z-index", 2);
				// $('#table_mdb thead tr:nth-child(2)').css("box-shadow", "inset 0 1px 0 black, inset 0 -1px 0 black;");
				heighthead += $('#table_mdb thead tr:nth-child(2)').innerHeight()-1;

				$('#table_mdb tbody tr').filter(function(){
					return $(this).find('td:nth-child(1), td.has_var_code').text() !== '';
				}).each(function(){
					$(this).css("top", heighthead);
					$(this).css("position", 'sticky');
					$(this).css("background-color", 'white');
					$(this).css("z-index", 2);
				});
			});
		</script>
	</body>
</html>