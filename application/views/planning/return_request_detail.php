<div id="content" class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="<?php echo base_url() ?>planning/revise_history_list" method="GET">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Drawing No</label>
                  <label class="col-md col-form-label"><?php echo $report['drawing_no'] ?></label>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Workpack No</label>
                  <label class="col-md col-form-label"><?php echo $workpack_list[$report['id_workpack']]['workpack_no'] ?></label>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                  <label class="col-md col-form-label"><?php echo $discipline_list[$report['discipline']]['discipline_name'] ?></label>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
                  <label class="col-md col-form-label"><?php echo $project_list[$report['project_code']]['project_name'] ?></label>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Module</label>
                  <label class="col-md col-form-label"><?php echo $module_list[$report['module']]['mod_desc'] ?></label>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Company</label>
                  <label class="col-md col-form-label"><?php echo $report['company'] ?></label>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type Of Module</label>
                  <label class="col-md col-form-label"><?php echo $type_of_module_list[$report['type_of_module']]['name'] ?></label>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Area</label>
                  <label class="col-md col-form-label"><?php echo $area_list[$report['area']]['area_name'] ?></label>
                </div>
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
        <div class="card-body bg-white overflow-auto">
          <div class="overflow-auto">
            <table class="table table-hover text-center dataTable">
              <thead class="bg-green-smoe text-white">
                <tr>
                  <th>Drawing SP</th>
                  <th>Piecemark</th>
                  <th>Drawing AS</th>
                  <th>Unique No</th>
                  <th>Length</th>
                  <th>Thickness</th>
                  <th>Profile</th>
                  <th>SMOE Inspection Status</th>
                  <th>Client Inspection Status</th>
                  <th>Workpack Status</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($report_list as $key => $value): ?>
                  <tr>
                    <td><?php echo $piecemark_list[$value['id_piecemark']]['drawing_sp'] ?></td>
                    <td><?php echo $piecemark_list[$value['id_piecemark']]['part_id'] ?></td>
                    <td><?php echo $piecemark_list[$value['id_piecemark']]['drawing_as'] ?></td>
                    <td><?php echo $mis_det_list[$value['id_mis']]['unique_no'] ?></td>
                    <td><?php echo $piecemark_list[$value['id_piecemark']]['length'] ?></td>
                    <td><?php echo $piecemark_list[$value['id_piecemark']]['thickness'] ?></td>
                    <td><?php echo $piecemark_list[$value['id_piecemark']]['profile'] ?></td>
                    <td>
                      <?php if ($value['status_inspection'] == 0): ?>
                      <span class="badge badge-info badge-pill">Ready</span>
                      <?php elseif($value['status_inspection'] == 1): ?>
                      <span class="badge badge-info badge-pill">Pending Approval</span>
                      <?php elseif($value['status_inspection'] == 2): ?>
                      <span class="badge badge-danger badge-pill">Rejected</span>
                      <?php elseif($value['status_inspection'] == 4): ?>
                      <span class="badge badge-warning badge-pill">Pending</span>
                      <?php else: ?>
                      <span class="badge badge-success badge-pill">Approved</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if ($value['revision_status_inspection'] == 1 && $value['status_inspection'] == 1): ?>
                      <span class="badge badge-secondary badge-pill">Requested For Update</span>
                      <?php elseif ($value['status_inspection'] == 7): ?>
                      <span class="badge badge-pill badge-success">Accepted</span>
                      <?php elseif($value['status_inspection'] == 6): ?>
                      <span class="badge badge-pill badge-danger">Rejected</span>
                      <?php elseif($value['status_inspection'] == 9): ?>
                      <span class="badge badge-pill badge-primary">Accepted And Release With
                        Comment</span>
                      <?php elseif($value['status_inspection'] == 10): ?>
                      <span class="badge badge-pill badge-info">Postponed</span>
                      <?php elseif($value['status_inspection'] == 11): ?>
                      <span class="badge badge-pill badge-warning">Re-Offer</span>
                      <?php elseif($value['status_inspection'] == 5): ?>
                      <span class="badge badge-pill badge-warning">Pending Approval</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if ($detail_list[$value['id_piecemark']]['status'] == 0): ?>
                        <span class="badge badge-pill badge-secondary">No Action</span>
                      <?php elseif ($detail_list[$value['id_piecemark']]['status'] == 1): ?>
                        <span class="badge badge-pill badge-danger">Request to Return</span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <br>
            <?php
              $project_id_enc = strtr($this->encryption->encrypt($report['project_code']), '+=/', '.-~');
              $discipline_enc = strtr($this->encryption->encrypt($report['discipline']), '+=/', '.-~');
              $type_of_module_enc = strtr($this->encryption->encrypt($report['type_of_module']), '+=/', '.-~');
              $module_enc = strtr($this->encryption->encrypt($report['module']), '+=/', '.-~');
              $report_enc = strtr($this->encryption->encrypt($report['report_number']), '+=/', '.-~');
              $report_rev_enc = strtr($this->encryption->encrypt($report['report_no_rev']), '+=/', '.-~');
            ?>
            <?php
              $id_request_enc = strtr($this->encryption->encrypt($request['id']), '+=/', '.-~');
            ?>
          </div>
          <div class="row">
            <div class="col-md text-left">
              <a target="_blank" href="<?= site_url('material_verification/material_verification_pdf_client/'.$project_id_enc.'/'.$discipline_enc.'/'.$type_of_module_enc.'/'.$module_enc.'/'.$report_enc.'/'.$report_rev_enc) ?>" class="btn btn-sm btn-danger"><i class="fas fa-file-pdf"></i> Report</a>
              <a target="_blank" href="<?= site_url('material_verification/transmittal_verification_pdf/'.$report_enc.'/'.$report_rev_enc) ?>" class="btn btn-sm btn-success"><i class="fas fa-file-pdf"></i> RFI</a>
            </div>
            <div class="col-md text-right">
              <a href="<?= site_url('planning/return_request_approval_process/'.$id_request_enc.'/'.strtr($this->encryption->encrypt('3'), '+=/', '.-~')) ?>" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Approve</a>
              <a href="<?= site_url('planning/return_request_approval_process/'.$id_request_enc.'/'.strtr($this->encryption->encrypt('2'), '+=/', '.-~')) ?>" class="btn btn-sm btn-danger"><i class="fas fa-times"></i> Reject</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script>
</script>