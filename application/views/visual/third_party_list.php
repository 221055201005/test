<style>
  th,
  td {
    vertical-align: middle !important;
  }
</style>

<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow">
          <div class="card-header">
            <h6 class="card-title m-0 font-weight-bold"> Visual - Third Party List</h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive overflow-auto">
                  <table class="table table-hover text-center" id="table_list">
                    <thead class="bg-gray-table">
                      <th>Project</th>
                      <th>Company</th>
                      <th>Report No.</th>
                      <th>Drawing No.</th>
                      <th>Discipline</th>
                      <th>Module</th>
                      <th>Module Type</th>
                      <th>Deck Elevation / Service Line</th>
                      <th>Rev No</th>
                      <th>Inspection By</th>
                      <th>Inspection Date</th>
                      <th>Status Inspection</th>
                      <th>Status Third Party</th>
                      <th>Status Invitation</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php foreach ($list as $key => $value) : ?>
                        <?php
                        $legen = explode(';', $value['legend_inspection_auth']);
                        if (in_array(1, $legen)) {
                          $inspection_authority[] = 'Hold Point ';
                          $approval_text       = 'Accepted';
                        }
                        if (in_array(2, $legen)) {
                          $inspection_authority[] = 'Witness ';
                          $approval_text       = 'Accepted';
                        }
                        if (in_array(3, $legen)) {
                          $inspection_authority[] = 'Monitoring ';
                          $approval_text       = 'Reviewed';
                        }
                        if (in_array(4, $legen)) {
                          $inspection_authority[] = 'Review ';
                          $approval_text       = 'Reviewed';
                        }

                        if ($value['status_invitation'] == 1) {
                          $status_inv =  "<span class='badge badge-info'>Notification Activity</span>";
                          $status_inv .= '<br><i style="font-size:12px !important;"><b>' . implode('/ ', $inspection_authority) . '</b></i>';
                        } elseif ($value['status_invitation'] == 0) {
                          $status_inv =  "<span class='badge badge-primary'>Invitation Witness</span>";
                          $status_inv .= '<br><i style="font-size:12px !important;"><b>' . implode('/ ', $inspection_authority) . '</b></i>';
                        }
                        unset($inspection_authority);
                        $count = 0;
                        if ($value['total_pending_client'] > 0) {
                          $status = "<span class='badge badge-warning'>Pending Approval</span>";
                          if ($value['postpone_reoffer_no'] > 0) {
                            $status .= "<br><span class='badge badge-secondary'>Re-Submit</span>";
                          }
                          $count = 1;
                        } elseif ($value['total_postpone_client'] > 0) { // NEW
                          $status = "<span class='badge badge-info'>Postponed</span>";
                        } elseif ($value['total_reoffer_client'] > 0) { // NEW
                          $status = "<span class='badge badge-warning'>Re-Offer</span>";
                        } elseif ($value['total_reject_client'] > 0) {
                          $status = "<span class='badge badge-danger'>Rejected</span>";
                        } elseif ($value['total_acc_comment_client'] > 0) { // NEW
                          $status = "<span class='badge badge-primary'>Accepted & Release with Comment</span>";
                        } elseif ($value['total_approve_client'] > 0) {
                          $status = "<span class='badge badge-success'>" . $approval_text . "</span>";
                        } else {
                          $status = "<span class='badge badge-warning'>Pending Approval</span>";
                          $count = 1;
                        }

                        $button    = '<div class="btn-group">';

                        $button   .= '<a class="btn btn-success text-nowrap" href=' . base_url('visual/visual_client_rfi/') . $value['report_number'] . '/client/' . $value['drawing_no'] . '/' . $value['postpone_reoffer_no'] . '><i class="fas fa-file-pdf"></i> RFI</a>';
                        $button   .= '<a class="btn btn-danger text-nowrap" href=' . base_url('visual/visual_pdf/') . $value['report_number'] . '/client/' . $value['drawing_no'] . '/' . $value['postpone_reoffer_no'] . '><i class="fas fa-file-pdf"></i> Report</a>';
                        $button   .= '<a href=' . site_url('visual/detail_inspection/' . $value['report_number'] . '/client/' . $value['drawing_no'] . '/NULL/' . $value['postpone_reoffer_no']) . '/third_party' . ' class="btn btn-primary text-nowrap"><i class="fas fa-list"></i> Detail</a>';
                        $button    .= '</div>';

                        ?>
                        <tr>
                          <td><?= $master_project[$value['project_code']]['project_name'] ?></td>
                          <td>
                            <?= $company_detail[$value['company_id']]['company_name'] ?>
                          </td>
                          <?php if ($value['project_code'] == 21) { ?>
                            <td><?= $this->master_report_no[$value['project_code']][$value['company_id']][$value['discipline']][$value['module']][$value['type_of_module']][$value['deck_elevation']]['visual_report' . ($value['company_id'] == 13 ? '_13' : '')] . $value['report_number'];; ?></td>
                          <?php } else { ?>
                            <td><?= $this->master_report_no[$value['project_code']][$value['company_id']][$value['discipline']][$value['module']][$value['type_of_module']]['visual_report' . ($value['company_id'] == 13 ? '_13' : '')] . $value['report_number'];; ?></td>
                          <?php } ?>
                          <td><?= $value['drawing_no'] ?></td>
                          <td><?= $discipline_name[$value['discipline']] ?></td>
                          <td><?= $module_name[$value['module']] ?></td>
                          <td><?= $master_type_of_module[$value['type_of_module']]['name'] ?></td>
                          <td><?= $deck_elevation_lis[$value['deck_elevation']]['name'] ?></td>
                          <td><?= str_pad($value['postpone_reoffer_no'], 1, 0, STR_PAD_LEFT) ?></td>
                          <td><?= $user[$value['inspection_by']]['full_name'] ?></td>
                          <td><?= $value['time_inspect'] ?></td>
                          <td><?= $status ?></td>
                          <td>
                            <?php if ($value['third_party_approval_status'] == 0) : ?>
                              <span class="badge badge-primary badge-pill"> Pending Review</span>
                            <?php else : ?>
                              <span class="badge badge-success badge-pill"> Reviewed</span>
                            <?php endif; ?>
                          </td>
                          <td><?= $status_inv ?></td>
                          <td><?= $button ?></td>
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
  </div>
</div>
</div>

<script>
  $("#table_list").DataTable({
    order: []
  })
</script>