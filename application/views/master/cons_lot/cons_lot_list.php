<div id="content" class="container-fluid">

	<div class="card shadow my-3 rounded-0">
		<div class="card-header">
			<h6 class="m-0"><?php echo $meta_title ?></h6>
		</div>

		<div class="card-body bg-white">

			<?php if ($this->permission_cookie[113] == '1') { ?>
				<a href="<?php echo base_url() ?>master/cons_lot/cons_lot_new" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add New</a>
			<?php } ?>

			<?php if ($this->permission_cookie[116] == '1') { ?>
				<a href="<?php echo base_url() ?>master/cons_lot/cons_lot_list/excel" class="btn btn-sm btn-success"><i class="far fa-file-excel"></i> Download Register</a>
			<?php } ?>

			<br>
			<br>

			<div class="overflow-auto">

				<table class="table table-hover text-center dataTable">
					<thead class="bg-gray-table">
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
							<th>ACTION</th>
						</tr>
					</thead>
					<tbody>
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
									<br>
									<strong><?= $catalog[$mrir[$value['batch_lot_no']]['catalog_id']]['spesification'] ?></strong>
								</td>
								<td> <?= $brand[$mrir[$value['batch_lot_no']]['brand']]['brand_name'] ?> </td>
								<td> <?= $catalog[$mrir[$value['batch_lot_no']]['catalog_id']]['size'] ?> </td>
								<td><?php echo $value["batch_lot_no"] ?></td>
								<td><?= $report_mrir ?></td>
								<td><?php echo $value["remarks"] ?></td>
								<td>
									<a href="<?php echo base_url() ?>master/cons_lot/cons_lot_update/<?php echo strtr($this->encryption->encrypt($value["id_lot"]), '+=/', '.-~') ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Update</a>
								</td>

							</tr>

						<?php $no++;
						endforeach; ?>

					</tbody>
				</table>



			</div>
		</div>
	</div>

</div>
</div>
<script>
	$('.dataTable').DataTable({
		"order": []
	});
</script>