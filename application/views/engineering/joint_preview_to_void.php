<?php
$status_internal_list = [
  "Internal" => 1,
  "External" => 0,
];
$is_itr_list = [
  "Yes" => 1,
  "No" => 0,
];
?>
<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
          <h6 class="font-weight-bold text-info"><i class="fas fa-info-circle"></i> Drag the header to expand column.</h6>
          <form method="POST" id="myForm" action="<?php echo base_url() ?>engineering/process_piecemark_joint_preview_to_void">
            <input type="hidden" class="form-control" value="<?= $_POST['fabrication_type'] ?>" name="fabrication_type">
            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white text-nowrap">
                  <tr>
                    <th colspan="14" class="bg-secondary">GENERAL</th>
                    <th colspan="3" class="bg-green">FITUP</th>
                    <th colspan="3" class="bg-primary">VISUAL</th>
                    <th colspan="1" class="bg-warning">NDT</th>
                  </tr>
                  <tr>
                    <th>Project</th>
                    <th>Module</th>
                    <th>Type Of Module</th>
                    <th>Discipline</th>
                    <th>Deck Elevation / Service Line</th>
                    <th>Desc. Assy</th>
                    <th>Drawing No</th>
                    <th>Drawing WM</th>
                    <th>Joint No</th>
                    <th>Piecemark#1</th>
                    <th>Piecemark#2</th>
                    <th>Weld Type</th>
                    <th>Phase</th>
                    <th>Company</th>

                    <th>Report No</th>
                    <th>Submission</th>
                    <th>Status Inspection</th>

                    <th>Report No</th>
                    <th>Submission</th>
                    <th>Status Inspection</th>

                    <th>RFI No | Status Inspection</th>

                  </tr>

                </thead>
                <tbody>
                  <?php
                  $no_arr = 0;
                  foreach ($data_joint as $key => $value) :
                    $report_no_pref_ft = $master_report_ft[$value['project']][$value['company_id']][$value['discipline']][$value['module']][$value['type_of_module']][$value['deck_elevation']]['fitup_report'] . $data_ft[$value['id']]['report_number'];

                    $report_no_pref_vt = $master_report_vt[$value['project']][$value['company_id']][$value['discipline']][$value['module']][$value['type_of_module']][$value['deck_elevation']]['visual_report'] . $data_vt[$value['id']]['report_number'];

                    $rfi_ndt = $master_rfi_ndt[$value['project']][$value['company_id']][$value['discipline']][$value['module']][$value['type_of_module']][$value['deck_elevation']];
                  ?>
                    <tr>

                      <td class='text-nowrap'>
                        <input type="hidden" class="form-control" value="<?php echo $value['id'] ?>" readonly name="id[]">
                        <input type="hidden" class="form-control" value="<?php echo $data_ft[$value['id']]['status_inspection'] ?>" readonly name="status_inspection_ft[]">
                        <input type="hidden" class="form-control" value="<?php echo $data_vt[$value['id']]['status_inspection'] ?>" readonly name="status_inspection_vt[]">
                        <?php echo @$project_list[$value['project']]['project_name'] ?>
                      </td>
                      <td class='text-nowrap'><?php echo @$module_list[$value['module']]['mod_desc'] ?> </td>
                      <td class='text-nowrap'><?php echo @$type_of_module_list[$value['type_of_module']]['name'] ?></td>
                      <td class='text-nowrap'><?php echo @$discipline_list[$value['discipline']]['discipline_name'] ?></td>
                      <td class='text-nowrap'><?php echo @$deck_elevation_list[$value['deck_elevation']]['name'] ?></td>
                      <td class='text-nowrap'><?php echo @$desc_assy_list[$value['desc_assy']]['name'] . ' - ' . @$desc_assy_list[$value['F']]['name'] ?></td>
                      <td class='text-nowrap'><?php echo $value['drawing_no'] ?> </td>
                      <td class='text-nowrap'><?php echo $value['drawing_wm'] ?></td>
                      <td class='text-nowrap'><?php echo $value['joint_no'] ?></td>
                      <td class='text-nowrap'><?php echo $value['pos_1'] ?></td>
                      <td class='text-nowrap'><?php echo $value['pos_2'] ?> </td>
                      <td class='text-nowrap'><?php echo $type_of_weld_list[$value['weld_type']]['weld_type'] ?> </td>
                      <td class='text-nowrap'><?php echo $value['phase'] ?></td>
                      <td class='text-nowrap'><?php echo $company_list[$value['company_id']]['company_name'] ?></td>

                      <?php
                      if ($data_ft[$value['id']]['status_inspection'] == 0) {
                        $text_status_ft = "Waiting Submit";
                      } else if ($data_ft[$value['id']]['status_inspection'] == 1) {
                        $text_status_ft = "Pending Approval QC";
                      } else if ($data_ft[$value['id']]['status_inspection'] == 2) {
                        $text_status_ft = "Rejected by QC";
                      } else if ($data_ft[$value['id']]['status_inspection'] == 3) {
                        $text_status_ft = "Approved by QC";
                      } else if ($data_ft[$value['id']]['status_inspection'] == 4) {
                        $text_status_ft = "Hold by QC";
                      } else if ($data_ft[$value['id']]['status_inspection'] == 5) {
                        $text_status_ft = "Pending Approval Client";
                      } else if ($data_ft[$value['id']]['status_inspection'] == 6) {
                        $text_status_ft = "Rejected by Client";
                      } else if ($data_ft[$value['id']]['status_inspection'] == 7) {
                        $text_status_ft = "Reviewed by Client";
                      } else if ($data_ft[$value['id']]['status_inspection'] == 9) {
                        $text_status_ft = "Accepted and Released with Comment";
                      } else if ($data_ft[$value['id']]['status_inspection'] == 10) {
                        $text_status_ft = "Postponed";
                      } else if ($data_ft[$value['id']]['status_inspection'] == 11) {
                        $text_status_ft = "Re-Offer";
                      } else if ($data_ft[$value['id']]['status_inspection'] == 12) {
                        $text_status_ft = "Void";
                      }

                      if ($data_vt[$value['id']]['status_inspection'] == 0) {
                        $text_status_vt = "Waiting Submit";
                      } else if ($data_vt[$value['id']]['status_inspection'] == 1) {
                        $text_status_vt = "Pending Approval QC";
                      } else if ($data_vt[$value['id']]['status_inspection'] == 2) {
                        $text_status_vt = "Rejected by QC";
                      } else if ($data_vt[$value['id']]['status_inspection'] == 3) {
                        $text_status_vt = "Approved by QC";
                      } else if ($data_vt[$value['id']]['status_inspection'] == 4) {
                        $text_status_vt = "Hold by QC";
                      } else if ($data_vt[$value['id']]['status_inspection'] == 5) {
                        $text_status_vt = "Pending Approval Client";
                      } else if ($data_vt[$value['id']]['status_inspection'] == 6) {
                        $text_status_vt = "Rejected by Client";
                      } else if ($data_vt[$value['id']]['status_inspection'] == 7) {
                        $text_status_vt = "Reviewed by Client";
                      } else if ($data_vt[$value['id']]['status_inspection'] == 9) {
                        $text_status_vt = "Accepted and Released with Comment";
                      } else if ($data_vt[$value['id']]['status_inspection'] == 10) {
                        $text_status_vt = "Postponed";
                      } else if ($data_vt[$value['id']]['status_inspection'] == 11) {
                        $text_status_vt = "Re-Offer";
                      } else if ($data_vt[$value['id']]['status_inspection'] == 12) {
                        $text_status_vt = "Void";
                      }
                      ?>

                      <!-- FOR FITUP -->
                      <td class='text-nowrap'><?php echo $data_ft[$value['id']]['report_number'] ?  $report_no_pref_ft : "" ?></td>
                      <td class='text-nowrap'><?php echo $data_ft[$value['id']]['submission_id'] ?> </td>
                      <td class='text-nowrap'><?php echo $text_status_ft ?></td>
                      <!-- FOR VISUAL -->
                      <td class='text-nowrap'><?php echo $data_vt[$value['id']]['report_number'] ?  $report_no_pref_vt : "" ?> </td>
                      <td class='text-nowrap'><?php echo $data_vt[$value['id']]['submission_id'] ?></td>
                      <td class='text-nowrap'><?php echo $text_status_vt ?> </td>

                      <!-- FOR NDT -->
                      <td class='text-nowrap'>
                        <?php
                        foreach ($ndt_data[$value['id']] as $ndt_type => $ndt) :
                          if ($ndt['status_inspection'] == 0) {
                            $text_status_ndt = "Submited";
                          } else if ($ndt['status_inspection'] == 1) {
                            $text_status_ndt = "Pending by QC (SEATRIUM)";
                          } else if ($ndt['status_inspection'] == 2) {
                            $text_status_ndt = "Rejected by QC (SEATRIUM)";
                          } else if ($ndt['status_inspection'] == 3) {
                            $text_status_ndt = "Approved by QC (SEATRIUM)";
                          } else if ($ndt['status_inspection'] == 4) {
                            $text_status_ndt = "Pending by Client";
                          } else if ($ndt['status_inspection'] == 5) {
                            $text_status_ndt = "Pending by Client";
                          } else if ($ndt['status_inspection'] == 6) {
                            $text_status_ndt = "Rejected by Client";
                          } else if ($ndt['status_inspection'] == 7) {
                            $text_status_ndt = "Approved by Client";
                          } else if ($ndt['status_inspection'] == 8) {
                            $text_status_ndt = "Re-Offer Client";
                          } else if ($ndt['status_inspection'] == 9) {
                            $text_status_ndt = "Not Active";
                          } else if ($ndt['status_inspection'] == 12) {
                            $text_status_ndt = "Void";
                          } else if ($ndt['status_inspection'] == 13) {
                            $text_status_ndt = "Pending by QC (SUBCONT)";
                          } else if ($ndt['status_inspection'] == 14) {
                            $text_status_ndt = "Rejected by QC (SUBCONT)";
                          } else if ($ndt['status_inspection'] == 15) {
                            $text_status_ndt = "Approved by QC (SUBCONT)";
                          }
                        ?>
                          <?= $rfi_ndt . '-' . $ndt['rfi_no'] ?> | <?= $text_status_ndt ?><br>
                        <?php endforeach ?>
                      </td>
                    </tr>
                  <?php
                    $no_arr++;
                  endforeach;
                  ?>
                </tbody>
              </table>
            </div>
            <br>
            <div class="row <?= $status == '' ? '' : 'd-none' ?>">
              <div class="col-12 text-right">
                <button type="button" class="mt-2 btn btn-sm btn-flat btn-success" onclick="submitConfirmation()">
                  <i class="fas fa-check"></i> Submit
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->


<script type="text/javascript">
  $(document).ready(function() {
    // addrow();
    selectRefresh();
  });

  function selectRefresh() {
    $(".select2_multiple_wps").select2({
      allowClear: true,
      tokenSeparators: [', ', ' '],
    })


  }


  function submitConfirmation() {
    Swal.fire({
      title: 'Are you sure?',
      text: 'Do you want to void some of the joint?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Yes, void it!',
      cancelButtonText: 'No, cancel!',
    }).then((result) => {
      if (result.value) {
        Swal.fire(
          'Voided!',
          'Your process has been successfully.',
          'success'
        ).then(() => {
          // Setelah konfirmasi sukses, submit form
          console.log('test')
          document.getElementById("myForm").submit();
        });
      } else {
        Swal.fire(
          'Cancelled',
          'Your process has been cancelled.',
          'error'
        );
      }
    });
  }
</script>