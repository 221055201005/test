<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Import Workpack Piecemark</h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form method="POST" action="<?php echo base_url(); ?>planning/import_workpack_piecemark_preview" enctype="multipart/form-data">
						<div class="form-group row">
							<label for="" class="col-xl-3 col-form-label text-muted"> Project</label>
							<div class="col-xl">
								<select class="form-control" name="project" required>
									<?php foreach ($project_list as $key => $value) : ?>
										<?php if(in_array($value['id'], $this->user_cookie[13])): ?>
											<option value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
										<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-xl-3 col-form-label text-muted"> Discipline</label>
							<div class="col-xl">
								<select name="discipline" class="form-control" style="width:100%">
									<option value="">---</option>
									<?php foreach ($discipline_list as $key => $value) : ?>
										<option value="<?= $value['id'] ?>"><?= $value['discipline_name'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Template Excel</label>
              <div class="col-xl col-form-label">
                <a target="_blank" href="#" onclick="generate_template_piecemark(this)">Template_Import_Workpack_Piecemark.xlsx</a>
                <!-- <a target="_blank" href="<?php echo base_url(); ?>planning/template_import_workpack_piecemark">Template_Import_Workpack_Piecemark.xlsx</a> -->
                <!-- <a target="_blank" href="<?php echo base_url(); ?>/file/planning/Template_Import_Workpack.xlsx?v=<?= date("YmdHis") ?>">Template_Import_Workpack.xlsx</a> -->
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Upload Template</label>
              <div class="col-xl">
                <div class="custom-file">
                  <input type="file" name="file" class="custom-file-input" required>
                  <label id="label_cp" class="custom-file-label">Choose file</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-right">
                <button class="mt-2 btn btn-sm btn-flat btn-info"><i class="fas fa-upload"></i> Upload</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Import Workpack Joint</h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form method="POST" action="<?php echo base_url(); ?>planning/import_workpack_joint_preview" enctype="multipart/form-data">
						<div class="form-group row">
							<label for="" class="col-xl-3 col-form-label text-muted"> Project</label>
							<div class="col-xl">
								<select class="form-control" name="project_joint" required>
									<?php foreach ($project_list as $key => $value) : ?>
										<?php if(in_array($value['id'], $this->user_cookie[13])): ?>
											<option value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
										<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-xl-3 col-form-label text-muted"> Discipline</label>
							<div class="col-xl">
								<select name="discipline_joint" class="form-control" style="width:100%">
									<option value="">---</option>
									<?php foreach ($discipline_list as $key => $value) : ?>
										<option value="<?= $value['id'] ?>"><?= $value['discipline_name'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Template Excel</label>
              <div class="col-xl col-form-label">
                <a target="_blank" href="#" onclick="generate_template_joint(this)">Template_Import_Workpack_Joint.xlsx</a>
                <!-- <a target="_blank" href="<?php echo base_url(); ?>planning/template_import_workpack_joint">Template_Import_Workpack_Joint.xlsx</a> -->
                <!-- <a target="_blank" href="<?php echo base_url(); ?>/file/planning/Template_Import_Workpack.xlsx?v=<?= date("YmdHis") ?>">Template_Import_Workpack.xlsx</a> -->
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Upload Template</label>
              <div class="col-xl">
                <div class="custom-file">
                  <input type="file" name="file" class="custom-file-input" required>
                  <label id="label_cp" class="custom-file-label">Choose file</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-right">
                <button class="mt-2 btn btn-sm btn-flat btn-info"><i class="fas fa-upload"></i> Upload</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script>
  function generate_template_piecemark(btn) {
    let project   = $('select[name="project"]').val()
    let discipline   = $('select[name="discipline"]').val()
    window.location.href = "<?= site_url('planning/template_import_workpack_piecemark/') ?>?project=" + project + "&discipline=" + discipline;
  }

  function generate_template_joint(btn) {
    let project   = $('select[name="project_joint"]').val()
    let discipline   = $('select[name="discipline_joint"]').val()
    window.location.href = "<?= site_url('planning/template_import_workpack_joint/') ?>?project=" + project + "&discipline=" + discipline;
  }
</script>