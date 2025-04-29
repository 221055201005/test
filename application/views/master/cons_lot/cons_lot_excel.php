<?php
$current_date = date("Y-m-d H:i:s");
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Consumable_Lot_Register_$current_date.xls");
header("Pragma: no-cache");
header("Expires: 0");
error_reporting(0);
?>
<table border='1px'>

	<tr>
		<th>NO</th>
		<th>ITEM DESCRIPTION</th>
		<th>WELDING PROCESS</th>
		<th>CONSUMABLE STRENGH</th>
		<th>BRAND TRADE NAME & CLASSIFICATION</th>
		<th>MANUFACTURER</th>
		<th>DIAMETER SIZE (mm)</th>
		<th>LOT NUMBER</th>
		<th>MRIR</th>
		<th>REMARKS</th>
	</tr>
	<?php $no = 1;
	foreach ($cons_lot_list as $key => $value) : ?>
		<?php

		$report_mrir = $mrir_main[$mrir[$value['batch_lot_no']]['mrir_id']]['report_no'];
		$report_mrir = explode("/", $report_mrir)[1];

		?>

		<tr>
			<td><?php echo $no ?></td>
			<td><?php echo $value["item_description"] ?></td>
			<td><?php echo $master_welder_process[$value["weld_process"]] ?></td>
			<td><?php echo $value["consumable_strengh"] ?></td>
			<td>
				<?= $catalog[$mrir[$value['batch_lot_no']]['catalog_id']]['material'] ?>
				<br style="mso-data-placement:same-cell;" />
				<strong><?= $catalog[$mrir[$value['batch_lot_no']]['catalog_id']]['spesification'] ?></strong>
			</td>
			<td> <?= $brand[$mrir[$value['batch_lot_no']]['brand']]['brand_name'] ?> </td>
			<td> <?= $catalog[$mrir[$value['batch_lot_no']]['catalog_id']]['size'] ?> </td>
			<td><?php echo $value["batch_lot_no"] ?></td>
			<td><?= $report_mrir ?></td>
			<td><?php echo $value["remarks"] ?></td>

		</tr>

	<?php $no++;
	endforeach; ?>

</table>
<br />
<b>PCMS Consumable Lot Register - Download Date : <?php echo date("d-F-Y H:i:s"); ?></b>