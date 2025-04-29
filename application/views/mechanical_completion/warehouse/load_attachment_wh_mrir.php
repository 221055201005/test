<div class="table-responsive overflow-auto">
  <table class="table table-hover text-center" style="width:100%" id="table_list">
    <thead class="bg-green-smoe text-white">
      <th>Project</th>
      <th>MRIR No</th>
      <th>Company</th>
      <th>Discipline</th>
      <th>Module Allocation</th>
      <th>Unique No.</th>
      <th>Tag Number</th>
      <th>Heat Number</th>
      <th>Mill Cert Number</th>
      <th>Attachment Name</th>
      <th>Remarks</th>
      <th>Created By</th>
      <th>Created Date</th>
    </thead>
    <tbody>
      <!-- <?php $no = 1;
      foreach ($attachment_list as $key => $value) : ?>
        <?php
        $encrypt_name       = strtr($this->encryption->encrypt($value['document_file']), '+=/', '.-~');
        $encrypt_remote_loc = strtr($this->encryption->encrypt('/PCMS/warehouse/mrir'), '+=/', '.-~');
        $download_file      = site_url('irn/open_file/' . $encrypt_name . '/' . $encrypt_remote_loc . '/download');

        $attachment_link    = '<a target="_blank" href="' . $download_file . '">' . $value['document_name'] . '</a>';
        ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $project[$value['project_id']]['project_name'] ?></td>
          <td><?= explode("/",$value['report_no'])[1] ?></td>
          <td><?= $company[$value['company_id']]['company_name'] ?></td>
          <td><?= $discipline[$value['discipline']]['discipline_name'] ?></td>
          <td><?= $type_of_module[$value['material_allocation']]['name'] ?></td>
          <td><?= $value['unique_ident_no'] ?></td>
          <td><?= $value['plate_or_tag_no'] ? $value['plate_or_tag_no'] : '-' ?></td>
          <td><?= $value['heat_or_series_no'] ? $value['heat_or_series_no'] : '-' ?></td>
          <td><?= $value['mill_cert_no'] ? $value['mill_cert_no'] : '-' ?></td>

          <td><?= $attachment_link ?></td>
          <td><?= $value['remarks'] ? $value['remarks'] : '-' ?></td>
          <td><?= $user[$value['upload_by']]['full_name'] ?></td>
          <td><?= $value['timestamp'] ?></td>
        </tr>
      <?php endforeach; ?> -->
    </tbody>
  </table>
</div>

<script>
  $("#table_list").DataTable({
    order: [],
    serverSide : true,
    processing : true,
    ajax : {
      url : "<?= site_url($serverside) ?>",
      type : "POST"
    } 
  })
</script>