<div id="content" class="container-fluid">
  <div class="row">
    <div class="col-md">
      <div class="card my-2 border-0 shadow">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white p-2">
          <div class="row mb-1">
            <div class="col-md">
              <a href="<?= base_url() ?>home/dashboard_sector_location_detail/<?= strtr($this->encryption->encrypt($get['deck_elevation']), '+=/', '.-~') ?>/<?= $get['sector'] ?>/<?= $get['type'] ?>/1" class="btn btn-sm btn-success btn-flat" target="_blank"><i class="fas fa-download"></i> Download</a>
            </div>
          </div>
          <table id="table_piecemark_list" class="table table-hover text-center dataTable">
            <thead class="bg-green-smoe text-white">
              <tr>
                <th>Drawing GA/AS</th>
                <th>Drawing WM</th>
                <th>Joint No.</th>
                <th>Grid</th>
                <th>Column</th>
                <?php if($get['type'] == 'fabrication'): ?>
                  <th>Fitup Status</th>
                  <th>Visual Status</th>
                <?php elseif($get['type'] == 'ndt'): ?>
                  <th>RT Status</th>
                  <th>MT Status</th>
                  <th>UT Status</th>
                <?php endif; ?>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($joint_list as $key => $value): ?>
                <?php
                  $status_final = 0;
                  if($get['type'] == 'fabrication'){
                    if(!in_array(@$status_list[$key]['visual']['status_inspection'], [0, 1, 2, 4, 6, 8, 12])){
                      $status_final = 1;
                    }
                  }
                  elseif($get['type'] == 'ndt'){

                  }
                ?>
                <tr>
                  <td><?= $value['drawing_no'] ?></td>
                  <td><?= $value['drawing_wm'] ?></td>
                  <td><?= $value['joint_no'] ?></td>
                  <td><?= $value['grid_row'] ?></td>
                  <td><?= $value['grid_column'] ?></td>
                  <?php if($get['type'] == 'fabrication'): ?>
                    <td>
                      <?php if(@$status_list[$key]['fitup']['status_inspection'] == "0"): ?>
                        <?php if(@$status_list[$key]['fitup']['status_surveyor'] == 3): ?>
                          <span class="badge badge-pill badge-primary">Ready to Submit RFI</span>
                        <?php else: ?>
                          <!-- <span class="badge badge-pill badge-dark">Not Ready</span><br> -->
                          <span class="badge badge-pill badge-dark"><?= $surveyor_status_list[$status_list[$key]['fitup']['status_surveyor']]['description'] ?></span>
                        <?php endif; ?>
                      <?php elseif(@$status_list[$key]['fitup']['status_inspection'] == 1): ?>
                        <span class="badge badge-pill badge-info">Pending Approval QC</span>
                      <?php elseif(@$status_list[$key]['fitup']['status_inspection'] == 2): ?>
                        <span class="badge badge-pill badge-danger">Rejected by QC</span>
                      <?php elseif(@$status_list[$key]['fitup']['status_inspection'] == 3): ?>
                        <span class="badge badge-pill badge-success">Approved by QC</span>
                      <?php elseif(@$status_list[$key]['fitup']['status_inspection'] == 4): ?>
                        <span class="badge badge-pill badge-secondary">Pending by QC</span>
                      <?php elseif(@$status_list[$key]['fitup']['status_inspection'] == 5): ?>
                        <span class="badge badge-pill badge-info">Pending Approval Client</span>
                      <?php elseif(@$status_list[$key]['fitup']['status_inspection'] == 6): ?>
                        <span class="badge badge-pill badge-danger">Rejected by Client</span>
                      <?php elseif(@$status_list[$key]['fitup']['status_inspection'] == 7): ?>
                        <span class="badge badge-pill badge-success">Approved by Client</span>
                      <?php elseif(@$status_list[$key]['fitup']['status_inspection'] == 8): ?>
                        <span class="badge badge-pill badge-warning">Request for Update</span>
                      <?php elseif(@$status_list[$key]['fitup']['status_inspection'] == 9): ?>
                        <span class="badge badge-pill badge-primary">Client RFI - Accepted with Comment</span>
                      <?php elseif(@$status_list[$key]['fitup']['status_inspection'] == 10): ?>
                        <span class="badge badge-pill badge-warning">Client RFI - Postponed</span>
                      <?php elseif(@$status_list[$key]['fitup']['status_inspection'] == 11): ?>
                        <span class="badge badge-pill badge-warning">Client RFI - Re-Offer</span>
                      <?php elseif(@$status_list[$key]['fitup']['status_inspection'] == 12): ?>
                        <span class="badge badge-pill badge-warning">Void</span>
                      <?php else: ?>
                        <span class="badge badge-pill badge-dark">Not Ready</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if(@$status_list[$key]['visual']['status_inspection'] == "0"): ?>
                        <?php if(@$status_list[$key]['visual']['status_surveyor'] == 3): ?>
                          <span class="badge badge-pill badge-primary">Ready to Submit RFI</span>
                        <?php else: ?>
                          <!-- <span class="badge badge-pill badge-dark">Not Ready</span><br> -->
                          <span class="badge badge-pill badge-dark"><?= $surveyor_status_list[$status_list[$key]['visual']['status_surveyor']]['description'] ?></span>
                        <?php endif; ?>
                      <?php elseif(@$status_list[$key]['visual']['status_inspection'] == 1): ?>
                        <span class="badge badge-pill badge-info">Pending Approval QC</span>
                      <?php elseif(@$status_list[$key]['visual']['status_inspection'] == 2): ?>
                        <span class="badge badge-pill badge-danger">Rejected by QC</span>
                      <?php elseif(@$status_list[$key]['visual']['status_inspection'] == 3): ?>
                        <span class="badge badge-pill badge-success">Approved by QC</span>
                      <?php elseif(@$status_list[$key]['visual']['status_inspection'] == 4): ?>
                        <span class="badge badge-pill badge-secondary">Pending by QC</span>
                      <?php elseif(@$status_list[$key]['visual']['status_inspection'] == 5): ?>
                        <span class="badge badge-pill badge-info">Pending Approval Client</span>
                      <?php elseif(@$status_list[$key]['visual']['status_inspection'] == 6): ?>
                        <span class="badge badge-pill badge-danger">Rejected by Client</span>
                      <?php elseif(@$status_list[$key]['visual']['status_inspection'] == 7): ?>
                        <span class="badge badge-pill badge-success">Approved by Client</span>
                      <?php elseif(@$status_list[$key]['visual']['status_inspection'] == 8): ?>
                        <span class="badge badge-pill badge-warning">Request for Update</span>
                      <?php elseif(@$status_list[$key]['visual']['status_inspection'] == 9): ?>
                        <span class="badge badge-pill badge-primary">Client RFI - Accepted with Comment</span>
                      <?php elseif(@$status_list[$key]['visual']['status_inspection'] == 10): ?>
                        <span class="badge badge-pill badge-warning">Client RFI - Postponed</span>
                      <?php elseif(@$status_list[$key]['visual']['status_inspection'] == 11): ?>
                        <span class="badge badge-pill badge-warning">Client RFI - Re-Offer</span>
                      <?php elseif(@$status_list[$key]['visual']['status_inspection'] == 12): ?>
                        <span class="badge badge-pill badge-warning">Void</span>
                      <?php else: ?>
                        <span class="badge badge-pill badge-dark">Not Ready</span>
                      <?php endif; ?>
                    </td>
                  <?php elseif($get['type'] == 'ndt'): ?>
                    <td>
                      <?php if(@$status_list[$key]['1'] == ''): ?>
                        <?php $status_final += 1; ?>
                        -
                      <?php elseif(@$status_list[$key]['1'] == '-2'): ?>
                        <span class="badge badge-pill badge-dark">Fab Not Finished</span>
                      <?php elseif(@$status_list[$key]['1'] == '-1'): ?>
                        <span class="badge badge-pill badge-info">Not Requested Yet</span>
                      <?php elseif(@$status_list[$key]['1'] == '0'): ?>
                        <span class="badge badge-pill badge-warning">Pending</span>
                      <?php elseif(@$status_list[$key]['1'] == '2'): ?>
                        <span class="badge badge-pill badge-danger">Reject</span>
                      <?php elseif(@$status_list[$key]['1'] == '3'): ?>
                        <?php $status_final += 1; ?>
                        <span class="badge badge-pill badge-success">Approved</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if(@$status_list[$key]['2'] == ''): ?>
                        <?php $status_final += 1; ?>
                        -
                      <?php elseif(@$status_list[$key]['2'] == '-2'): ?>
                        <span class="badge badge-pill badge-dark">Fab Not Finished</span>
                      <?php elseif(@$status_list[$key]['2'] == '-1'): ?>
                        <span class="badge badge-pill badge-info">Not Requested Yet</span>
                      <?php elseif(@$status_list[$key]['2'] == '0'): ?>
                        <span class="badge badge-pill badge-warning">Pending</span>
                      <?php elseif(@$status_list[$key]['2'] == '2'): ?>
                        <span class="badge badge-pill badge-danger">Reject</span>
                      <?php elseif(@$status_list[$key]['2'] == '3'): ?>
                        <?php $status_final += 1; ?>
                        <span class="badge badge-pill badge-success">Approved</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if(@$status_list[$key]['3'] == ''): ?>
                        <?php $status_final += 1; ?>
                        -
                      <?php elseif(@$status_list[$key]['3'] == '-2'): ?>
                        <span class="badge badge-pill badge-dark">Fab Not Finished</span>
                      <?php elseif(@$status_list[$key]['3'] == '-1'): ?>
                        <span class="badge badge-pill badge-info">Not Requested Yet</span>
                      <?php elseif(@$status_list[$key]['3'] == '0'): ?>
                        <span class="badge badge-pill badge-warning">Pending</span>
                      <?php elseif(@$status_list[$key]['3'] == '2'): ?>
                        <span class="badge badge-pill badge-danger">Reject</span>
                      <?php elseif(@$status_list[$key]['3'] == '3'): ?>
                        <?php $status_final += 1; ?>
                        <span class="badge badge-pill badge-success">Approved</span>
                      <?php endif; ?>
                    </td>
                    <?php $status_final = $status_final/3; ?>
                  <?php endif; ?>
                  <td>
                    <?php if(@$status_final == 1): ?>
                      <span class="badge badge-pill badge-success">Complete</span>
                    <?php else: ?>
                      <span class="badge badge-pill badge-warning">In Progress</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <a href="<?= base_url() ?>engineering/search_joint?drawing_wm=<?= $value['drawing_wm'] ?>&joint_no=<?= $value['joint_no'] ?>" class="btn btn-sm btn-info btn-flat" target="_blank"><i class="fas fa-search"></i> Search</a>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script>
  $('.dataTable').DataTable();
</script>