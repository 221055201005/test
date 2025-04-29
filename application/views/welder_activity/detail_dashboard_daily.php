
<style>
  th, td {
    vertical-align: middle !important;
  }
</style>

<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h6 class="card-title">Detail Welder - <strong><?= date('d, F Y', strtotime($date_activity)) ?></strong></h6>
            <hr>
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive overflow-auto">
                  <table class="table table-hover text-center" id="table_list">
                    <thead class="bg-green-smoe text-white">
                      <th>Company</th>
                      <th>Project</th>
                      <th>Welder Stamp</th>
                      <th>Welder Badge</th>
                      <th>Welder Name</th>
                      <th>Status Welder</th>
                      <th>Status Attendance</th>
                      <th>Status Assigned</th>
                      <th>Time In</th>
                      <th>Time Out</th>
                    </thead>
                    <tbody>
                      <?php foreach ($list as $key => $value): ?>
                        <?php 
                          
                          if($status_view == "welder_available") {
                            if($value['status_attendance'] == 1) {
                              continue;
                            }
                          }

                          if($status_view == "welder_assigned") {
                            if(!isset($activity[$value['badge']])) {
                              continue;
                            }
                          }

                          if($status_view == "welder_not_assigned") {
                            if(isset($activity[$value['badge']]) && $value['status_attendance'] == 0) {
                              continue;
                            }

                            if($value['status_attendance'] == 1) {
                              continue;
                            }
                          }

                          $id_welder_enc    = strtr($this->encryption->encrypt($welder[$value['badge']]['id_welder']), '+=/', '.-~');

                        ?> 
                        <tr>
                          <td><?= $company[$value['company_id']]['company_name'] ?></td>
                          <td><?= $project[$value['project_id']]['project_name'] ?></td>
                          <td><a href="<?= site_url('master/welder/welder_perform_audit/'. $id_welder_enc) ?>" target="_blank"><?= $welder[$value['badge']]['welder_code'] ?></a></td>
                          <td><?= $value['badge'] ?></td>
                          <td><?= $welder[$value['badge']]['welder_name'] ?></td>
                          <td><span class="badge badge-success badge-pill">Active</span></td>
                          <td>
                            <?php if ($value['status_attendance'] == 0): ?> 
                             <span class="badge badge-info badge-pill">Available</span>
                             <?php elseif ($value['status_attendance'] == 1): ?> 
                             <span class="badge badge-danger badge-pill">Not Available</span>
                             <?php endif; ?>
                          </td>
                          <td>
                            <?php if (isset($activity[$value['badge']])): ?> 
                             <span class="badge badge-primary badge-pill">Assigned</span>
                             <?php else: ?> 
                             <span class="badge badge-danger badge-pill">Not Assigned</span>
                             <?php endif; ?>
                          </td>
                          <td><?= $value['time_in'] ? $value['time_in'] : '-' ?></td>
                          <td><?= $value['time_out'] ? $value['time_out'] : '-' ?></td>
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