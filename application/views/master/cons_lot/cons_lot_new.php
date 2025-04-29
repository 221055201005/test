<div id="content" class="container-fluid">

	<div class='col-md-6 offset-3'>

		<div class="card shadow my-3 rounded-0">
			<div class="card-header">
				<h6 class="m-0"><?php echo $meta_title ?></h6>
			</div>

			<div class="card-body bg-white overflow-auto">

				<a href='<?= base_url(); ?>master/cons_lot' class='btn btn-warning'><i class="fas fa-arrow-left"></i> Back</a>


				<form action="<?php echo base_url() ?>master/cons_lot/cons_lot_new_process" method="POST">

					<div class="overflow-auto media text-muted py-3 border-bottom border-gray">

						<div class="container-fluid">

							<div class="card-body">

								<div class="form-group">
									<label for="weld_process">Project ID</label>
									<select name='project_id' class='form-control' required>
										<option value=''>---</option>
										<?php foreach ($project as $key => $value) { ?>
											<option value='<?php echo  $value['id'] ?>'><?php echo $value['project_name'] ?></option>
										<?php } ?>
									</select>
								</div>

								<div class="form-group">
									<label for="weld_process">Welding Process</label>
									<select name='weld_process' class='form-control' required>
										<option value=''>---</option>
										<?php foreach ($welding_process as $key => $value) { ?>
											<option value='<?php echo  $value['id'] ?>'><?php echo $value['name_process'] ?></option>
										<?php } ?>
									</select>
								</div>

								<div class="form-group">
									<label for="weld_process">Item Description</label>
									<input class="form-control" type="text" name="item_description" placeholder="Item Description" required/>
								</div>

								<div class="form-group">
									<label for="consumable_strengh">Consumable Strength</label>
									<input class="form-control" type="text" name="consumable_strengh" placeholder="Consumable Strength" required/>
								</div>

								<div class="form-group">
									<label for="remarks">Remarks</label>
									<input class="form-control" type="text" name="remarks" placeholder="Remarks" required/>
								</div>
								<br>
								<br>
								<div class="form-group">
									<label for="batch_lot_no">Batch Lot Number</label>
									<input class="form-control" type="text" name="batch_lot_no" onfocus="autopiecemark(this)" placeholder="Item Description" />
								</div>
								<div class="form-group text-right">
									<button type="button" class="btn btn-sm btn-info" onclick="add_item()"><i class="fas fa-plus"></i> Add</button>
								</div>

							</div>

							<div class="card-body">
								<div class="font-weight-bold">
                  Total: <span class="text-success num_ticker">0</span> Lot Number.<br>
                </div>
								<table class="table table-hover text-center dataTable table_list_cons">
									<thead class="bg-gray-table">
										<tr>
											<th>LOT NUMBER</th>
											<th>BRAND TRADE NAME & CLASSIFICATION</th>
											<th>MANUFACTURER</th>
											<th>DIAMETER SIZE (mm)</th>
											<th>MRIR</th>
											<th>ACTION</th>
										</tr>
									</thead>
									<tbody id="tbody_list_cons_lot">
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
	function autopiecemark(input) {
		$(input).autocomplete({
			source: function(request, response) {
				$.post('<?php echo base_url(); ?>master/cons_lot/cons_lot_wh_autocomplete', {
					term: request.term
				}, response, 'json');
			},
			autoFocus: true,
			classes: {
				"ui-autocomplete": "highlight",
				"z-index": 100
			}
		});
	}

	let data_cons_lot = [];
	function add_item() {
		let batch_lot_no = $('input[name=batch_lot_no]').val();
		if(batch_lot_no == ''){
			sweetalert('error', 'Batch Lot Number is Empty!');
		}
		else if($.inArray(batch_lot_no, data_cons_lot) != -1){
			sweetalert('error', 'Duplicate Lot Number!');
      // data_cons_lot.splice( $.inArray($(batch_lot_no).val(), data_cons_lot), 1 );
    }
		else{
			$.ajax({
				url: "<?php echo base_url() ?>master/cons_lot/cons_lot_wh_check",
				type: "POST",
				data: {
					batch_lot_no: batch_lot_no,
				},
				success: function(data) {
					if(data.includes('Error:')){
						sweetalert('error', data);
					}
					else{
						let res = $.parseJSON(data);
						$("#tbody_list_cons_lot").append(res.output);
						data_cons_lot.push(res.batch_lot_no);
						$(".num_ticker").html(data_cons_lot.length);
					}
				}
			});
		}
	}

	function delete_item(input) {
		let batch_lot_no = $(input).data('lotno');
		data_cons_lot.splice( $.inArray($(batch_lot_no).val(), data_cons_lot), 1);
		$(".num_ticker").html(data_cons_lot.length);
		$(input).closest("tr").remove();
	}
</script>