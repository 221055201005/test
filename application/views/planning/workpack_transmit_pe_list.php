<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
					<div class="overflow-auto">
						<table class="table table-hover text-center dataTable">
							<thead class="bg-gray-table">
								<tr>
									<th>Test Pack No</th>
									<th>Drawing No</th>
									<th>Workpack No.</th>
									<th>Description</th>
									<th>Assigned Company</th>
									<th>Yard Company</th>
									<th>Module</th>
									<th>Type of Module</th>
									<th>Discipline</th>
									<th>Deck Elevation / Service Line</th>
									<th>Assy Code</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($workpack_list as $key => $workpack): ?>
									<tr>
										<td><?= $workpack['test_pack_no'] ?></td>
										<td><?= $workpack['drawing_no'] ?></td>
										<td><?= $workpack['workpack_no'] ?></td>
										<td><?= $workpack['description'] ?></td>
										<td><?= @$company_list[$workpack['company_id']] ?></td>
										<td><?= @$company_list[$workpack['company_yard']] ?></td>
										<td><?= @$module_list[$workpack['module']] ?></td>
										<td><?= @$type_of_module_list[$workpack['type_of_module']] ?></td>
										<td><?= @$discipline_list[$workpack['discipline']] ?></td>
										<td><?= @$deck_elevation_list[$workpack['deck_elevation']] ?></td>
										<td><?= @$desc_assy_list[$workpack['desc_assy']] ?></td>
										<td class="text-nowrap">
											<a target="_blank" href="<?php echo base_url() ?>planning/workpack_unique_update/<?php echo encrypt($workpack['id']) ?>" class="btn btn-sm btn-warning text-nowrap"><i class="fas fa-edit"></i> Update</a>
											<a target="_blank" href="<?php echo base_url() ?>planning/workpack_pdf/<?php echo encrypt($workpack['id']) ?>?user=<?php echo encrypt($this->user_cookie[0]) ?>" class="btn btn-sm btn-danger text-nowrap"><i class="fas fa-file-pdf"></i> Workpack PDF</a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
        </div>
      </div>
    </div>
  </div>

</div>
</div>
<script>
	$(function() {
		$('.dataTable').DataTable({
			order: [],
		})
	})
</script>