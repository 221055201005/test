<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">RFI - <?= $rfi['rfi_no'] ?></h6>
        </div>
        <div class="card-body bg-white">
          <form id="form_rfi" method="POST" action="<?php echo base_url() ?>mechanical_completion/mechanical_completion_rfi_update_process/" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo strtr($this->encryption->encrypt($rfi['id']), '+=/', '.-~') ?>">
            <input type="hidden" name="id_mc" value="<?php echo strtr($this->encryption->encrypt($rfi['id_mc']), '+=/', '.-~') ?>">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">RFI No</label>
                  <div class="col-xl">
                    <input type="text" class="form-control" name="rfi_no" value="<?= $rfi['rfi_no'] ?>" required>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">RFI Category</label>
                  <div class="col-xl">
                    <select class="form-control" name="rfi_category" readonly>
                      <option value="PMT" <?= ($rfi['rfi_category'] == 'PMT' ? 'selected' : '') ?>>PMT</option>
                      <option value="QC" <?= ($rfi['rfi_category'] == 'QC' ? 'selected' : '') ?>>QC</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">RFI Status</label>
                  <div class="col-xl">
                    <select class="form-control" name="rfi_status">
                      <option value="1" data-chained="PMT" <?= ($rfi['rfi_status'] == '1' ? 'selected' : '') ?>>Submit to QC</option>
                      <option value="2" data-chained="PMT" <?= ($rfi['rfi_status'] == '2' ? 'selected' : '') ?>>Reject QC</option>
                      <option value="3" data-chained="PMT" <?= ($rfi['rfi_status'] == '3' ? 'selected' : '') ?>>Approve QC</option>
                      <option value="5" data-chained="QC" <?= ($rfi['rfi_status'] == '5' ? 'selected' : '') ?>>Submit to Client</option>
                      <option value="6" data-chained="QC" <?= ($rfi['rfi_status'] == '6' ? 'selected' : '') ?>>Rejected by Client</option>
                      <option value="7" data-chained="QC" <?= ($rfi['rfi_status'] == '7' ? 'selected' : '') ?>>Approved by Client</option>
                      <!-- <option value="8" data-chained="QC" <?= ($rfi['rfi_status'] == '8' ? 'selected' : '') ?>>Approved by Client with Comment</option> -->
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">New RFI Attachment</label>
                  <div class="col-xl">
                    <div class="custom-file">
                      <input type="file" name="attachment_file" class="custom-file-input" required>
                      <label id="label_cp" class="custom-file-label">Choose file</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Remarks</label>
                  <div class="col-xl">
                    <textarea name="remarks" class="form-control"><?= $rfi['remarks'] ?></textarea>
                  </div>
                </div>
              </div>
              <div class="col-md-12 text-right">
                <button class="mt-2 btn btn-sm btn-warning" name="submit" value="update"><i class="fas fa-edit"></i> Update</button>
              </div>
            </div>
          </form>
          <br>
          <div class="overflow-auto">
            <table class="table table-bordered text-center dataTable">
              <thead class="bg-green-smoe text-white">
                <tr>
                  <th>Attacment</th>
                  <th>Upload By</th>
                  <th>Upload Date</th>
                  <th>Status</th>
                  <th>Remarks</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($attachment_list as $key => $value): ?>
                <tr>
                  <td>
                    <a href="<?php echo base_url() . 'mechanical_completion/open_mechanical_completion_atc/' . $value['attachment'] . '/' . str_replace("&","",$rfi['rfi_no']) ?>" target="_blank" class="btn btn-sm btn-dark"><i class="fas fa-file-alt"></i></a>  
                  </td>
                  <td><?= @$user_list[$value['created_by']] ?></td>
                  <td><?= $value['created_date'] ?></td>
                  <td>
                    <?php
                      if ($value['status'] == 1) {
                        echo '<span class="badge badge-pill badge-warning">Submit to QC</span>';
                      }
                      elseif($value['status'] == 2){
                        echo '<span class="badge badge-pill badge-danger">Rejected by QC</span>';
                      }
                      elseif($value['status'] == 3){
                        echo '<span class="badge badge-pill badge-success">Approved by QC</span>';
                      } elseif ($value['status'] == 5) {
                        echo '<span class="badge badge-pill badge-warning">Submit to Client</span>';
                      } elseif ($value['status'] == 6) {
                        echo '<span class="badge badge-pill badge-danger">Rejected by Client</span>';
                      } elseif ($value['status'] == 7) {
                        echo '<span class="badge badge-pill badge-success">Approved by Client</span>';
                      } elseif ($value['status'] == 8) {
                        echo '<span class="badge badge-pill badge-success">Approved by Client with Comment</span>';
                      }
                    ?>
                  </td>
                  <td><?= $value['remarks'] ?></td>
                  <td>
                    <?php if($key > 0 && $this->permission_cookie[154] == 1): ?>
                      <a href="<?= base_url()."mechanical_completion/mechanical_completion_rfi_attachment_delete_process/".strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>" class="btn btn-sm btn-danger" onclick="sweetalert('confirm', 'Are you sure?', this, event)"><i class="fas fa-trash"></i></a>
                    <?php endif; ?>
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
</div><!-- ini div dari sidebar yang class wrapper -->
<script>
  $("select[name=module]").chained("select[name=project]");
  $("select[name=rfi_status]").chained("select[name=rfi_category]");

  $('.dataTable').DataTable({
    order: [],
  });

  $('.select2-multiple-tags').select2({
    tags: true,
    multiple: true,
    placeholder: 'Document Name'
  })
</script>