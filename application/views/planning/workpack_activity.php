<div id="content" class="container-fluid">

  <div class="row">
		<div class="col-12">
			<div class="card shadow my-3 rounded-0">
				<div class="card-body bg-white px-4 py-4">
					<h1 class="font-weight-bold text-center"><?php echo ($workpack['workpack_no'] == "" ? "----" : $workpack['workpack_no']) ?></h1>
				</div>
			</div>
		</div>
		<?php if(count($workpack_subactivity_list) == 0): ?>
			<div class="col-12">
				<div class="card shadow my-3 rounded-0">
					<div class="card-body bg-white overflow-auto">
						No Activity Registered
					</div>
				</div>
			</div>
		<?php endif; ?>
		<?php 
			$next = true;
			foreach ($workpack_subactivity_list as $activity): 
		?>
    <div class="col-12">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?= $activity['activity'] ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="<?php echo base_url() ?>planning/workpack_activity_process" method="POST">
						<input type="hidden" name="id_workpack" value="<?php echo @$workpack['id'] ?>">
						<input type="hidden" name="activity" value="<?php echo @$activity['activity'] ?>">
            <div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Assigned PIC</label>
									<div class="col-md">
										<input type="text" class="form-control" value="<?= @$user_list[$activity['pic']] ?>" readonly>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Remarks</label>
									<div class="col-md">
										<input type="text" class="form-control" value="<?= $activity['remarks'] ?>" readonly>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Start Date</label>
									<div class="col-md">
										<input type="text" class="form-control" value="<?= $activity['start_date'] ?>" readonly>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Finish Date</label>
									<div class="col-md">
										<input type="text" class="form-control" value="<?= $activity['finish_date'] ?>" readonly>
									</div>
								</div>
							</div>
              <div class="col-12">
                <hr>
              </div>
              <div class="col-12">
								<table id="tbl_grade" class="table table-bordered text-center">
                  <thead class="bg-green-smoe text-white">
                    <tr>
                      <th>PIC</th>
                      <th>Start Date</th>
                      <th>Finish Date</th>
                      <th>Finish By</th>
                      <th>Remarks</th>
                    </tr>
                  </thead>
                  <tbody>
										<?php foreach ($workpack_pic_history_list[$activity['activity']] as $pic_history): ?>
											<tr>
												<td><?= @$user_list[$pic_history['pic']]; ?></td>
												<td><?= $pic_history['start_date']; ?></td>
												<td><?= $pic_history['finish_date']; ?></td>
												<td><?= @$user_list[$pic_history['finish_by']]; ?></td>
												<td><?= $pic_history['remarks']; ?></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
								<br>
								<?php if($next && $activity['finish_date'][$activity['activity']] == NULL): ?>
									<?php if(!isset($workpack_pic_history_list[$activity['activity']][$this->user_cookie[0]])): ?>
										<input type="hidden" name="submit_button" value="start">
										<button type="submit" class="mt-2 btn btn-sm btn-flat btn-success" name="submit_btn" value="start" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Start&nbsp;</b> this activity?', this, event);"><i class="fas fa-check"></i> Start</button>
									<?php else: ?>
										<div class="row">
											<div class="col-6">
												<div class="form-group row">
													<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Remarks</label>
													<div class="col-md">
														<input type="text" class="form-control" name="remarks" value=''>
													</div>
												</div>
											</div>
										</div>
										<input type="hidden" name="submit_button" value="finish">
										<button class="mt-2 btn btn-sm btn-flat btn-danger" type="submit" name="submit_btn" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Complete&nbsp;</b> this activity?', this, event);" value="finish"><i class="fas fa-check"></i> Finish</button>
									<?php endif; ?>
								<?php endif; ?>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
		<?php 
			if($activity['finish_date'] == NULL){
				$next = false;
			}
			endforeach; 
		?>
  </div>


</div>
</div>
<script>
	
</script>