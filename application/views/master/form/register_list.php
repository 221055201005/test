<?php
$enc_path = encrypt("/PCMS/quality_observation/form_register");

?>

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
            <h6 class="card-title m-0 font-weight-bold"> Form Register List</h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive overflow-auto">
                  <table class="table table-hover text-center" id="table_list">
                    <thead class="bg-gray-table">
                      <th>No.</th>
                      <th>Project</th>
                      <th>Form No.</th>
                      <th>Rev.</th>
                      <th>Description</th>
                      <th>Remarks</th>
                      <th>File</th>
                    </thead>
                    <tbody>
                      <?php $no = 1;
                      foreach ($list as $key => $value) : ?>
                        <?php
                        $enc_att                = encrypt($value['attachment_name']);
                        $link_att               = site_url('public_smoe/open_file_syn/' . $enc_att . '/' . $enc_path);

                        ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?= $project_list[$value['project_id']]['project_name'] ?></td>
                          <td><?= $value['form_no'] ?></td>
                          <td><?= $value['revision_no'] ?></td>
                          <td><?= $value['description'] ?></td>
                          <td><?= $value['remarks'] ? $value['remarks'] : '-' ?></td>
                          <td>
                            <a href="<?= $link_att ?>" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-paperclip"></i></a>
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
</script>