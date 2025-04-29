<div id="content" class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
          <form method="post" action="<?php echo base_url() ?>engineering/drawing_detail_process">
            <input type="hidden" name="id" value="<?php echo $drawing['id'] ?>">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Document No</label>
                  <div class="col-xl">
                    <input class="form-control" value="<?php echo $drawing['document_no'] ?>" disabled>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Title</label>
                  <div class="col-xl">
                    <input class="form-control" value="<?php echo $drawing['title'] ?>" disabled>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
                  <div class="col-xl">
                    <select class="form-control" name="project" id='project_id' disabled>
											<option value="">---</option>
											<?php foreach ($project_list as $key => $value) : ?>
												<?php if(in_array($value['id'], $this->user_cookie[13])): ?>
													<option value="<?php echo $value['id'] ?>" <?php echo (@$drawing['project_id'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
												<?php endif; ?>
											<?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                  <div class="col-xl">
                    <select class="form-control" name="discipline" disabled>
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$drawing['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Piecemark Data</label>
                  <div class="col-xl">
                    <label class="form-control">
                      <input type="checkbox" name="temp_piecemark_status" <?php echo ($drawing['temp_piecemark_status'] == 1 ? "checked" : "") ?>> Not Available
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Joint Data</label>
                  <div class="col-xl">
                    <label class="form-control">
                      <input type="checkbox" name="temp_joint_status" <?php echo ($drawing['temp_joint_status'] == 1 ? "checked" : "") ?>> Not Available
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-12 text-right">
                <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Update</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Total Piecemark & Joint</h6>
        </div>
        <div class="card-body bg-white">
          <form method="post" action="<?php echo base_url() ?>engineering/update_total_template_drawing_process">
            <input type="hidden" name="id" value="<?php echo $drawing['id'] ?>">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Total Piecemark on Drawing</label>
                  <div class="col-xl">
                    <input class="form-control" type="number" name="total_piecemark" value="<?= $drawing['total_piecemark'] ?>">
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Total Joint on Drawing</label>
                  <div class="col-xl">
                    <input class="form-control" type="number" name="total_joint" value="<?= $drawing['total_joint'] ?>">
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Total Piecemark on PCMS</label>
                  <div class="col-xl">
                    <input class="form-control" value="<?php echo $total_piecemark ?>" disabled>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Total Joint on PCMS</label>
                  <div class="col-xl">
                    <input class="form-control" value="<?php echo $total_joint ?>" disabled>
                  </div>
                </div>
              </div>
              <div class="col-12 text-right">
                <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Update</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
          <div class="overflow-auto">
            <table class="table table-hover text-center dataTable">
              <thead class="bg-green-smoe text-white">
                <tr>
                  <th>Document No</th>
                  <th>Rev No</th>
                  <th>Transmitted Date</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($rev_list as $key => $value): ?>
                  <tr>
                    <td><?php echo $value['document_no'] ?></td>
                    <td><?php echo $value['last_revision_no'] ?></td>
                    <td><?php echo $value['transmittal_date'] ?></td>
                    <td>
                      <?php if($value['status'] == 1): ?>
                        <span class="badge badge-danger">Returned</span>
                      <?php else: ?>
                        <span class="badge badge-info">Transmitted</span>
                      <?php endif; ?>
                    </td>
                    <td><a href="<?php echo base_url_ftp_eng()."public_smoe/open_atc/2/".strtr($this->encryption->encrypt($value['id_activity']), '+=/', '.-~') ?>" target="_blank" class="btn btn-sm btn-flat btn-dark"><i class='fas fa-paperclip'></i></a></td>
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