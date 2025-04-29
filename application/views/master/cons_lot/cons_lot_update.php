<div id="content" class="container-fluid">

	<div class='col-md-6 offset-3'>

		<div class="card shadow my-3 rounded-0">
			<div class="card-header">
				<h6 class="m-0"><?php echo $meta_title ?></h6>
			</div>

			<div class="card-body bg-white overflow-auto">

				<a href='<?= base_url(); ?>master/cons_lot' class='btn btn-warning'><i class="fas fa-arrow-left"></i> Back</a>


				<form action="<?php echo base_url() ?>master/cons_lot/cons_lot_update_process" method="POST">
					<input type='hidden' name='id_lot' value='<?= $cons_lot['id_lot'] ?>'>

					<div class="overflow-auto media text-muted py-3 border-bottom border-gray">

						<div class="container-fluid">

							<div class="card-body">

								<div class="form-group">
									<label for="weld_process">Project ID</label>
									<select name='project_id' class='form-control' required>
										<option value=''>---</option>
										<?php foreach ($project as $key => $value) { ?>
											<?php if(in_array($value['id'], $this->user_cookie[13])): ?>
												<option value='<?php echo  $value['id'] ?>' <?= ($value['id'] == $cons_lot['project_id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
											<?php endif; ?>
										<?php } ?>
									</select>
								</div>

								<div class="form-group">
									<label for="weld_process">Welding Process</label>
									<select name='weld_process' class='form-control' required>
										<option value=''>---</option>
										<?php foreach ($welding_process as $key => $value) { ?>
											<option value='<?php echo  $value['id'] ?>' <?= ($value['id'] == $cons_lot['weld_process'] ? 'selected' : '') ?>><?php echo $value['name_process'] ?></option>
										<?php } ?>
									</select>
								</div>

								<div class="form-group">
									<label for="weld_process">Item Description</label>
									<input class="form-control" type="text" name="item_description" placeholder="Item Description" value="<?= $cons_lot['item_description'] ?>" required/>
								</div>

								<div class="form-group">
									<label for="consumable_strengh">Consumable Strength</label>
									<input class="form-control" type="text" name="consumable_strengh" placeholder="Consumable Strength" value="<?= $cons_lot['consumable_strengh'] ?>" required/>
								</div>

								<div class="form-group">
									<label for="remarks">Remarks</label>
									<input class="form-control" type="text" name="remarks" placeholder="Remarks" value="<?= $cons_lot['remarks'] ?>" required/>
								</div>

								<div class="form-group">
									<label for="batch_lot_no">Batch Lot Number</label>
									<input class="form-control" type="text" name="batch_lot_no" value="<?= $cons_lot['batch_lot_no'] ?>" disabled placeholder="Item Description" />
								</div>

							</div>

							<div class="card-body">
								<table class="table table-hover text-center dataTable table_list_cons">
									<thead class="bg-gray-table">
										<tr>
											<th>LOT NUMBER</th>
											<th>BRAND TRADE NAME & CLASSIFICATION</th>
											<th>MANUFACTURER</th>
											<th>DIAMETER SIZE (mm)</th>
											<th>MRIR</th>
										</tr>
									</thead>
									<tbody id="tbody_list_cons_lot">
										<?= $output ?>
									</tbody>
								</table>

							</div>


						</div>
					</div>

					<br />
					<div class="row">
						<div class="col-12 text-right">
							<button type="submit" name="submit" value="update_req" class="btn btn-success"><i class='fas fa-check'></i> Submit</button>
						</div>
					</div>
				</form>


			</div>
		</div>

	</div>
</div>
</div>
<script>
</script>