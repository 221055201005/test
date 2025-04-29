<?php
$status_internal_list = [
  1 => "Internal",
  0 => "External",
];
$is_itr_list = [
  1 => "Yes",
  0 => "No",
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
                    <th>Project</th>
                    <th>Module </th>
                    <th>Type Of Module</th>
                    <th>Discipline </th>
                    <th>Deck Elevation / Service Line</th>
                    <th>Desc. Assembly</th>
                    <th>Drawing GA</th>
                    <th>Drawing AS</th>
                    <th>Drawing SP</th>
                    <th>Part ID As</th>
                    <th>Profile</th>
                    <th>Material</th>
                    <th>Grade</th>
                    <th>Company</th>
                    <th>Report Material Verification</th>
                    <th>Submission No</th>
                    <th>Status Inspection</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $is_disabled = 0;
                  foreach ($data_piecemark as $key => $value) :
                    $report_no_pref = $report_no_format[$value['project']][$value['company_id']][$value['discipline']][$value['module']][$value['type_of_module']][$value['deck_elevation']]['mv_no']  . $data_material['report_numer'];
                  ?>
                    <tr style="background: <?php echo ($status != "" ? "#f8d7da" : "") ?>">
                      <td class='text-nowrap'>
                        <input type="hidden" class="form-control" value="<?php echo $value['id'] ?>" readonly name="id[]">
                        <input type="hidden" class="form-control" value="<?php echo $data_material[$value['id']]['status_inspection'] ?>" readonly name="status_inspection[]">
                        <?php echo $project_list[$value['project']]['project_name'] ?>
                      </td>
                      <td class='text-nowrap'><?php echo @$module_list[$value['module']]['mod_desc'] ?></td>
                      <td class='text-nowrap'><?php echo @$type_of_module_list[$value['type_of_module']]['name'] ?></td>
                      <td class='text-nowrap'><?php echo @$discipline_list[$value['discipline']]['discipline_name'] ?></td>
                      <td class='text-nowrap'><?php echo @$deck_elevation_list[$value['deck_elevation']]['name'] ?></td>
                      <td class='text-nowrap'><?php echo @$desc_assy_list[$value['desc_assy']]['name'] ?></td>

                      <td class='text-nowrap'><?php echo $value['drawing_ga'] ?></td>
                      <td class='text-nowrap'><?php echo $value['drawing_as'] ?></td>
                      <td class='text-nowrap'><?php echo $value['drawing_sp'] ?></td>
                      <td class='text-nowrap'><?php echo $value['part_id'] ?></td>
                      <td class='text-nowrap'><?php echo $value['profile'] ?></td>
                      <td class='text-nowrap'><?php echo $value['material'] ?></td>
                      <td class='text-nowrap'><?php echo @$material_grade_list[$value['grade']]['material_grade'] ?></td>
                      <td class='text-nowrap'><?php echo $company_list[$value['company_id']]['company_name'] ?></td>
                      <td class='text-nowrap'><?php echo $data_material[$value['id']]['report_number'] ?  $report_no_pref . '-' . $data_material[$value['id']]['report_number'] : "" ?> </td>
                      <td class='text-nowrap'><?php echo $data_material[$value['id']]['submission_id'] ?></td>
                      <?php
                      if ($data_material[$value['id']]['status_inspection'] == 0) {
                        $text_status = "Waiting Submit";
                      } else if ($data_material[$value['id']]['status_inspection'] == 1) {
                        $text_status = "Pending Approval QC";
                      } else if ($data_material[$value['id']]['status_inspection'] == 2) {
                        $text_status = "Rejected by QC";
                      } else if ($data_material[$value['id']]['status_inspection'] == 3) {
                        $text_status = "Approved by QC";
                      } else if ($data_material[$value['id']]['status_inspection'] == 4) {
                        $text_status = "Hold by QC";
                      } else if ($data_material[$value['id']]['status_inspection'] == 5) {
                        $text_status = "Pending Approval Client";
                      } else if ($data_material[$value['id']]['status_inspection'] == 6) {
                        $text_status = "Rejected by Client";
                      } else if ($data_material[$value['id']]['status_inspection'] == 7) {
                        $text_status = "Reviewed by Client";
                      } else if ($data_material[$value['id']]['status_inspection'] == 9) {
                        $text_status = "Accepted and Released with Comment";
                      } else if ($data_material[$value['id']]['status_inspection'] == 10) {
                        $text_status = "Postponed";
                      } else if ($data_material[$value['id']]['status_inspection'] == 11) {
                        $text_status = "Re-Offer";
                      } else if ($data_material[$value['id']]['status_inspection'] == 12) {
                        $text_status = "Void";
                      }
                      ?>
                      <td class='text-nowrap'><?php echo $text_status ?></td>
                    </tr>
                  <?php
                  endforeach;
                  ?>
                </tbody>
              </table>
            </div>
            <br>
            <div class="row">
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


<script>
  function submitConfirmation() {
    Swal.fire({
      title: 'Are you sure?',
      text: 'Do you want to void some of the Piecemark?',
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