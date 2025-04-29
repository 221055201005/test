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
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h6 class="card-title">Filter</h6>
            <hr>
            <form action="" method="get">
              <div class="row">

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-2 col-form-label text-muted"> Project</label>
                    <div class="col-xl">
                      <select name="project_id" class="select2" style="width:100%" required>
                        <option value="">---</option>
                        <?php foreach ($project_list as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $this->input->get('project_id') ? 'selected' : '' ?>><?= $value['project_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-12 text-right">
                  <hr>
                  <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h6 class="card-title"><?= $meta_title ?></h6>
            <hr>
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive overflow-auto">
                  <table class="table table-hover text-center" id="table_list" style="width:100%">
                    <thead class="bg-green-smoe text-white">
                      <th>Project</th>
                      <th>Request No.</th>
                      <th>Trace Code</th>
                      <th>Workpack No</th>
                      <th>IRN No.</th>
                      <th>Paint System</th>
                      <th>Activity</th>
                      <th>Vendor</th>
                      <th>Released By</th>
                      <th>Released Date</th>
                      <th><?= $status_invitation==0 ? 'Invitation' : 'Attachment' ?> Status</th>
                      <th></th>
                    </thead>
                    <tbody>
                      <?php foreach ($list as $key => $value) : ?>
                        <?php
                        $paint_system_desc    = [];
                        $activity_desc        = [];

                        if ($value['id_paint_system']) {
                          $id_paint_system = explode(";", $value['id_paint_system']);

                          foreach ($id_paint_system as $v) {
                            $paint_system_desc[] = $paint_system[$v]['name'];
                          }
                        }

                        if ($value['id_activity']) {
                          $id_activity        = explode(";", $value['id_activity']);

                          foreach ($id_activity as $v) {
                            $activity_desc[] = $activity[$v]['description_of_activity'];
                          }
                        }

                        $subm_enc   = strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~');
                        $id_paint_system_enc   = strtr($this->encryption->encrypt($value['id_paint_system']), '+=/', '.-~');
                        $id_activity_enc   = strtr($this->encryption->encrypt($value['id_activity']), '+=/', '.-~');

                        ?>
                        <tr>
                          <td><?= $project_list[$value['project_id']]['project_name'] ?></td>
                          <td>
                            <?= $value['request_no'] ?>
                          </td>
                          <td>
                            <?php if(!$value['report_number']){ ?>
                              <span class="badge badge-warning badge-pill"> Pending Report Number</span>
                            <?php } else { ?>
                              <b>
                                <?= "SOF-OCP-SMO-".$type_of_module[$value['type_of_module']]['code']."-".strtoupper($discipline[$value['discipline']]['initial_for_report'])."-COPP-".strtoupper($value['report_number']) ?>
                              </b>
                            <?php } ?>
                          </td>
                          
                          <td><?= $workpack_list[$wp_ps[$value['id_detail_wp_paint_system']]['id_workpack']]['workpack_no'] ?></td>
                          <td>SOF-OCP-SMO-TS-STR-RFI-IRN-B&P-<?= $workpack_list[$wp_ps[$value['id_detail_wp_paint_system']]['id_workpack']]['irn_report_no'] ?></td>
                          <td class="text-nowrap">
                            <?= implode(', <br>', $paint_system_desc) ?>
                          </td>
                          <td class="text-nowrap">
                            <?= implode(', <br>', $activity_desc) ?>
                          </td>

                          <td><?= @$company_list[$value['id_vendor']]['company_name'] ? $company_list[$value['id_vendor']]['company_name'] : 'PT SMOE' ?></td>

                          <td><?= isset($user[$value['invitation_by']]) ? $user[$value['invitation_by']]['full_name'] : '-' ?></td>
                          <td><?= $value['invitation_datetime'] ? $value['invitation_datetime'] : '-' ?></td>
                          <td>
                            <?php if ($value[$column] == 0){ ?> 
                              <span class="badge badge-danger badge-pill"> Pending <?= $status_invitation==0 ? 'Invitation' : 'Attachment' ?></span>
                            <?php } else { ?>
                              <span class="badge badge-success badge-pill"> Completed <?= $status_invitation==0 ? 'Invitation' : 'Attachment' ?></span>
                              <?php if($value['invitation_by']!=''){ ?>
                                <small style="font-size: 7.5pt !important">
                                  <b><i>
                                    by 
                                    <?php 
                                      if($status_invitation==0){
                                        echo $user[$value['invitation_by']]['full_name'].' on '.$value['invitation_datetime'];
                                      } else {
                                        echo $user[$attachment[$value['transmittal_uniqid']]['upload_by']]['full_name'].' on '.$attachment[$value['transmittal_uniqid']]['upload_datetime'];
                                      }
                                    ?>
                                  </i></b>
                                </small>
                              <?php } ?>
                            <?php } ?>
                          </td>
                          <td>
                            <div class="btn-group">
                              <?php if($value['status_invitation']==0){ ?>
                                <!-- <span class="btn btn-info" onclick="returnReport('<?= $value["transmittal_uniqid"] ?>')"><i class="fas fa-sync"></i> Return</span> -->
                              <?php } ?>
                                <!-- <a class="btn btn-secondary" href="<?= base_url('planning_bnp/rfi_detail/').$value['transmittal_uniqid'] ?>" target="_blank"><i class="fas fa-list"></i> Detail</a> -->
                                <a class="btn btn-secondary" href="<?= base_url('planning_bnp/rfi_detail_new/').$subm_enc.'/'.$id_paint_system_enc.'/'.$id_activity_enc ?>" target="_blank"><i class="fas fa-list"></i> Detail</a>
                            </div>
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
  </div>
</div>
</div>

<script>
  $("#table_list").DataTable({
    order: []
  })
  function returnReport(transmittal_uniqid){
    Swal.fire({
      title: 'Are you sure to Return this Report?',
      text: "",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Send!'
    }).then((result) => {

      if (result.value) {
        $.ajax({
          url: "<?php echo base_url() ?>planning_bnp/returnReport",
          dataType: "json",
          data: {
            transmittal_uniqid: transmittal_uniqid,
          },
          success: function( data ) {
            Swal.fire({
              type: "success",
              title: "SUCCESS",
              text: "Report Has Been Returned!"
            });
            location.reload(); 
          }
        });
      }
    })
  }
</script>