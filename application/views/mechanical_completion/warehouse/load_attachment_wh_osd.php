<div class="table-responsive overflow-auto">
  <table class="table table-hover text-center" id="table_list">
    <thead class="bg-green-smoe text-white">
      <th>No</th>
      <th>Project</th>
      <th>OS & D No.</th>
      <th>Attachment Name</th>
      <th>Uploaded By</th>
      <th>Uploaded Date</th>
    </thead>
    <tbody>
      <?php $no = 1;
      foreach ($attachment_list as $key => $value) : ?>
        <?php
        $encrypt_name       = strtr($this->encryption->encrypt($value['attachment_name']), '+=/', '.-~');
        $encrypt_remote_loc = strtr($this->encryption->encrypt('/PCMS/warehouse/osd'), '+=/', '.-~');
        $download_file      = site_url('irn/open_file/' . $encrypt_name . '/' . $encrypt_remote_loc . '/download');

        $attachment_link    = '<a target="_blank" href="' . $download_file . '">' . $value['attachment_name'] . '</a>';
        ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $project[$value['project_id']]['project_name'] ?></td>
          <td><?= $value['osd_no'] ?></td>
          <td><?= $attachment_link ?></td>
          <td><?= $user[$value['created_by']]['full_name'] ?></td>
          <td><?= $value['created_date'] ?></td>
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