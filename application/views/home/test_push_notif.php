<div id="content" class="container-fluid">
	<div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">
					<form action="<?= base_url() ?>public_smoe/test_push_notif_process" method="POST">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Title</label>
									<div class="col-md">
										<input type="text" class="form-control" name="title">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Message</label>
									<div class="col-md">
										<input type="text" class="form-control" name="message">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Link</label>
									<div class="col-md">
										<input type="text" class="form-control" name="link">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Token</label>
									<div class="col-md">
										<input type="text" class="form-control" name="token">
									</div>
								</div>
							</div>
							<div class="col-md-12 text-right">
                <button class="mt-2 btn btn-sm btn-flat btn-success" name="submit" value="search"><i class="fas fa-check"></i> Send</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>