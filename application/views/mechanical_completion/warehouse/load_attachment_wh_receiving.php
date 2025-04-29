<div class="table-responsive overflow-auto">
  <table class="table table-hover text-center" id="table_list">
    <thead class="bg-green-smoe text-white">
      <th>No</th>
      <th>Shipment No</th>
      <th>Project</th>
      <th>Vendor Name</th>
      <th>Receiving Company</th>
      <th>Attachment Name</th>
      <th>Certificate Number</th>
      <th>Qty Material</th>
      <th>Uploaded By</th>
      <th>Uploaded Date</th>
    </thead>
    <tbody>
      <?php $no = 1;
      foreach ($attachment_list as $key => $value) : ?>
        <?php
        $encrypt_name       = strtr($this->encryption->encrypt($value['attachment_name']), '+=/', '.-~');
        $encrypt_remote_loc = strtr($this->encryption->encrypt('/PCMS/warehouse/receiving'), '+=/', '.-~');
        $download_file      = site_url('irn/open_file/' . $encrypt_name . '/' . $encrypt_remote_loc . '/download');

        $attachment_link    = '<a target="_blank" href="' . $download_file . '">' . $value['attachment_name'] . '</a>';
        ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $value['shipment_no'] ?></td>
          <td><?= $project[$value['project']]['project_name'] ?></td>
          <td><?= $vendor[$value['id_vendor']]['vendor_name'] ?></td>
          <td><?= $company[$value['receiving_company']]['company_name'] ?></td>
          <td><?= $attachment_link ?></td>
          <td><?= $value['certificate_number'] ? $value['certificate_number'] : '-' ?></td>
          <td><?= $value['qty_material'] ? $value['qty_material'] : '-' ?></td>
          <td><?= $user[$value['uploaded_by']]['full_name'] ?></td>
          <td><?= $value['uploaded_date'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<script>
  $("#table_list").DataTable({
    order: []
  })
</script>